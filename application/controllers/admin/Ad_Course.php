<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Ad_Course extends Admin_Controller {
    function __construct() 
    {
        parent::__construct();
        $this->add_css_theme('all.css');
        $this->add_js_theme('jquery-ui.min.js');
        $this->add_js_theme('jquery.multi-select.min.js');
        $this->add_js_theme('adcourse.js');

        $this->add_js_theme('plugin/taginput/bootstrap-tagsinput.min.js');
        $this->add_css_theme('plugin/taginput/bootstrap-tagsinput.css');
        // load the language files 
        $this->load->model('AdCourseModel');
        //load the form validation
        $this->load->library('form_validation');
        // set constants
        define('REFERRER', "referrer");
        define('THIS_URL', base_url('admin/adcourse'));
        define('DEFAULT_LIMIT', 10);
        define('DEFAULT_OFFSET', 0);
        define('DEFAULT_SORT', "last_name");
        define('DEFAULT_DIR', "asc");
        $this->add_css_theme('sweetalert.css')->add_js_theme('sweetalert-dev.js')->add_js_theme('bootstrap-notify.min.js');
    }


    function index()
    {
        $this->set_title("판매 상품 링크");
        $data = $this->includes;
        $content_data = array();
        // load views
        $data['content'] = $this->load->view('admin/adcourse/list', $content_data, TRUE);
        $this->load->view($this->template, $data);       
    }


    function list() 
    {
        $data = array();
        $list = $this->AdCourseModel->get_ad_course();

        $no = $_POST['start'];
        foreach ($list as $ad_course) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = ucfirst($ad_course->title);
            $row[] = ucfirst($ad_course->category_title);
            $row[] = ucfirst($ad_course->instute_id);
            $button = '<a href="' . base_url("admin/adcourse/update/". $ad_course->id) . '" data-toggle="tooltip"  title="'.lang("admin_edit_record").'" class="btn btn-primary btn-action mr-1"><i class="fas fa-pencil-alt"></i></a>';

            $button.= '<a href="' . base_url("admin/adcourse/copy/" . $ad_course->id) . '" data-toggle="tooltip"  title="'.lang("admin_copy_record").'" class="common_copy_record btn btn-warning mr-1"><i class="far fa-copy"></i></a>';
        

            $button.= '<a href="' . base_url("admin/adcourse/delete/" . $ad_course->id) . '" data-toggle="tooltip"  title="'.lang("admin_delete_record").'" class="btn btn-danger btn-action mr-1 common_delete"><i class="fas fa-trash"></i></a>';


            $row[] = $button;
            $data[] = $row;
        }
        $output = array("draw" => $_POST['draw'], "recordsTotal" => $this->AdCourseModel->count_all(), "recordsFiltered" => $this->AdCourseModel->count_filtered(), "data" => $data,);
        
        //output to json format
        echo json_encode($output);
    }


    function add($ad_course_id = false) 
    { 
        $category_data = array(); 
        $this->load->model('CategoryModel');
        $newarray = $this->CategoryModel->allcategory();
        $res =  generatePageTree($newarray, 0, 0, '|--> &nbsp; ');
        $newCats = explode("||~LB~||", $res);

        foreach($newCats as $cat) {
            if(trim($cat) !='' ) {
                $nArray = explode('|~CB~|', $cat);

                $catArray[$nArray[1]] = array(
                    'depth' => $nArray[0], 
                    'id' => $nArray[1], 
                    'name' => get_parent_category_with_comma($nArray[1], ' >> '), 
                    'slug' => $nArray[3], 
                    'icon' => $nArray[4], 
                    'image' => $nArray[5], 
                    'status' => $nArray[6]
                );
            }
        }

        foreach ($catArray as $category_array) 
        {
            $category_data[''] = lang('select_category');
            $category_data[$category_array['id']] = $category_array['name'];
        }

        $upload_file_name = NULL;
        $file_link = NULL;

        if($this->input->post('title'))
        {
            if(isset($_FILES['image']['name']) && $_FILES['image']['name'])
            {   
                $allowed_formate = 'gif|jpg|png|bmp|jpeg';
                $allowed_max_upload_size = 26000000;
                $path = "./assets/images/studymaterial";
                $material_file_upload = $this->do_upload_file('image',$path,$allowed_formate,$allowed_max_upload_size);
                if($material_file_upload['status'] == 'success')
                {
                    $upload_file_name = $material_file_upload['upload_data']['file_name'];
                    $file_link = $path.$upload_file_name;
                }
                else
                {
                    $this->session->set_flashdata('error', $material_file_upload['error']); 
                    $this->form_validation->set_rules('image', 'Matiral File', 'required');
                }
                
            }
            else
            {
               // $this->form_validation->set_message('error', 'Please upload File First.');
              //  $this->form_validation->set_rules('image', 'Matiral File ', 'required');
            }
        }

        $this->form_validation->set_rules('category_id', 'Category Name', 'required|numeric|trim');
        $this->form_validation->set_rules('title', 'Title', 'required|trim|is_unique[ext_course.title]');
        $this->form_validation->set_rules('url', 'Url', 'required|trim');
        $this->form_validation->set_rules('description', 'Description', 'required|trim');

        if ($this->form_validation->run() == false)  
        {

            if($upload_file_name && $file_link && file_exists($file_link))
            {
                unlink($file_link);
            }
            $this->form_validation->error_array();
        }
        else
        {
            $lesson_type = $this->input->post('lesson_type',TRUE) ? 1 : 0;
            $origin_price = $this->input->post('origin_price',TRUE) ? $this->input->post('origin_price',TRUE) : 0;
            $real_price = $this->input->post('real_price',TRUE) ? $this->input->post('real_price',TRUE) : 0;
            $status = $this->input->post('status',TRUE) ? 1 : 0;
            
            $ad_course_content = array();
            $ad_course_content['category_id'] = $this->input->post('category_id',TRUE);
            $ad_course_content['title'] = $this->input->post('title',TRUE);
            $ad_course_content['url'] = $this->input->post('url',TRUE);
            $ad_course_content['lesson_type'] = $lesson_type;
            $ad_course_content['origin_price'] = $origin_price;
            $ad_course_content['real_price'] = $real_price;
            $ad_course_content['description'] = $this->input->post('description',FALSE);
            $ad_course_content['image'] =  $upload_file_name;
            $ad_course_content['title'] = $this->input->post('title',TRUE);
            $ad_course_content['url'] = $this->input->post('url',TRUE);
            $ad_course_content['status'] = $status;
            $ad_course_content['orders'] = $this->input->post('orders',TRUE);
            $ad_course_content['instute_id'] = $this->input->post('instute_id',TRUE);

            $ad_course_id = $this->AdCourseModel->insert_ad_course($ad_course_content);
            if($ad_course_id)
            {
                $this->session->set_flashdata('message', lang('admin_record_added_successfully'));   
            }
            else
            {
                $this->session->set_flashdata('error', lang('admin_error_adding_record')); 
            }

            redirect(base_url('admin/adcourse'));
        }

        $this->set_title("새 판매 상품 링크");
        $data = $this->includes;

        $content_data = array('category_data'=>$category_data,'ad_course_id'=>$ad_course_id,);
        // load views
        $data['content'] = $this->load->view('admin/adcourse/form', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

    function update($ad_course_id = NULL)
    {

        if(empty($ad_course_id))
        {
            $this->session->set_flashdata('error', lang('invalid_url')); 
            redirect(base_url('admin/adcourse'));
        }
        $ad_course_data = $this->AdCourseModel->get_ad_course_by_id($ad_course_id);

        if(empty($ad_course_data))
        {
            $this->session->set_flashdata('error', lang('admin_invalid_id')); 
            redirect(base_url('admin/adcourse'));
        }

        $category_data = array(); 
        $this->load->model('CategoryModel');
        $newarray = $this->CategoryModel->allcategory();
        $res =  generatePageTree($newarray, 0, 0, '|--> &nbsp; ');
        $newCats = explode("||~LB~||", $res);

        foreach($newCats as $cat) {
            if(trim($cat) !='' ) {
                $nArray = explode('|~CB~|', $cat);

                $catArray[$nArray[1]] = array(
                    'depth' => $nArray[0], 
                    'id' => $nArray[1], 
                    'name' => get_parent_category_with_comma($nArray[1], ' >> '), 
                    'slug' => $nArray[3], 
                    'icon' => $nArray[4], 
                    'image' => $nArray[5], 
                    'status' => $nArray[6]
                );
            }
        }

        foreach ($catArray as $category_array) 
        {
            $category_data[''] = lang('select_category');
            $category_data[$category_array['id']] = $category_array['name'];
        }

        $upload_file_name = NULL;
        $file_link = NULL;

        if($this->input->post('title'))
        {
            if(isset($_FILES['image']['name']) && $_FILES['image']['name'])
            {   
                $allowed_formate = 'gif|jpg|png|bmp|jpeg';
                $allowed_max_upload_size = 26000000;
                $path = "./assets/images/studymaterial";
                $material_file_upload = $this->do_upload_file('image',$path,$allowed_formate,$allowed_max_upload_size);
                if($material_file_upload['status'] == 'success')
                {
                    $upload_file_name = $material_file_upload['upload_data']['file_name'];
                    $file_link = $path.$upload_file_name;
                }
                else
                {
                    $this->session->set_flashdata('error', $material_file_upload['error']); 
                    $this->form_validation->set_rules('image', 'Matiral File', 'required');
                }
                
            }
            else
            {
                if(empty($ad_course_data->title))
                {
                    $this->form_validation->set_message('error', 'Please upload File First.');
                    $this->form_validation->set_rules('image', 'Matiral File ', 'required');                    
                }
            }
        }


        $title_unique = $this->input->post('title')  != $ad_course_data->title ? '|is_unique[ad_course.title]' : '';
        $this->form_validation->set_rules('category_id', 'Category Name', 'required|numeric|trim');
        $this->form_validation->set_rules('title', 'Title', 'required|trim'.$title_unique);
        $this->form_validation->set_rules('url', 'Url', 'required|trim');
        $this->form_validation->set_rules('description', 'Description', 'required|trim');

        if ($this->form_validation->run() == false) 
        {
            if($upload_file_name && $file_link && file_exists($file_link))
            {
                unlink($file_link);     
            }
            $this->form_validation->error_array();
        } 
        else 
        {
            $lesson_type = $this->input->post('lesson_type',TRUE) ? 1 : 0;
            $origin_price = $this->input->post('origin_price',TRUE) ? $this->input->post('origin_price',TRUE) : 0;
            $real_price = $this->input->post('real_price',TRUE) ? $this->input->post('real_price',TRUE) : 0;
            $status = $this->input->post('status',TRUE) ? 1 : 0;

            $ad_course_content = array();
            $ad_course_content['category_id'] = $this->input->post('category_id',TRUE);
            $ad_course_content['title'] = $this->input->post('title',TRUE);
            $ad_course_content['url'] = $this->input->post('url',TRUE);
            $ad_course_content['lesson_type'] = $lesson_type;
            $ad_course_content['origin_price'] = $origin_price;
            $ad_course_content['real_price'] = $real_price;
            $ad_course_content['description'] = $this->input->post('description',FALSE);
            $ad_course_content['title'] = $this->input->post('title',TRUE);
            $ad_course_content['url'] = $this->input->post('url',TRUE);
            $ad_course_content['status'] = $status;
            $ad_course_content['orders'] = $this->input->post('orders',TRUE);
            $ad_course_content['instute_id'] = $this->input->post('instute_id',TRUE);

            if($upload_file_name)
            {
                $ad_course_content['image'] =  $upload_file_name;
            }

            $course_update_status = $this->AdCourseModel->update_ad_course($ad_course_id, $ad_course_content);

            
                $this->session->set_flashdata('message', lang('admin_record_updated_successfully'));
            
                redirect(base_url('admin/adcourse'));
        }

        $this->set_title("판매상품 링크 수정");
        $data = $this->includes;

        $content_data = array('category_data'=>$category_data,'ad_course_id'=>$ad_course_id,'ad_course_data'=>$ad_course_data,);
        // load views
        $data['content'] = $this->load->view('admin/adcourse/form', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

    function copy($ad_course_id = NULL)
    {

        action_not_permitted();
        if(empty($ad_course_id))
        {
            $this->session->set_flashdata('error', lang('invalid_url')); 
            redirect(base_url('admin/adcourse'));
        }
        $ad_course_data = $this->AdCourseModel->get_ad_course_by_id($ad_course_id);

        if(empty($ad_course_data))
        {
            $this->session->set_flashdata('error', lang('admin_invalid_id')); 
            redirect(base_url('admin/adcourse'));
        }     

        $ad_course_content = array();
        $ad_course_content['category_id'] = $ad_course_data->category_id;
        $ad_course_content['title'] = $ad_course_data->title.'-copy';
        $ad_course_content['url'] = $ad_course_data->url;
        $ad_course_content['lesson_type'] = $ad_course_data->lesson_type;

        $ad_course_content['origin_price'] = $ad_course_data->origin_price;
        $ad_course_content['real_price'] = $ad_course_data->real_price;
        $ad_course_content['description'] = $ad_course_data->description;
        $ad_course_content['status'] = $ad_course_data->status;
        $ad_course_content['orders'] = $ad_course_data->orders;
        $ad_course_content['instute_id'] = $ad_course_data->instute_id;

        $ad_course_id = $this->AdCourseModel->insert_ad_course($ad_course_content);
        if($ad_course_id)
        {
            $this->session->set_flashdata('message', lang('record_copied_successfully'));   
        }
        else
        {
            $this->session->set_flashdata('error', lang('admin_error_during_copying_record')); 
        }

        redirect(base_url('admin/adcourse'));       
    }   

    function delete($ad_course_id = NULL)
    {
        action_not_permitted();
        $status = $this->AdCourseModel->delete_ad_course($ad_course_id); 

        if ($status) 
        {
            $this->session->set_flashdata('message', lang('admin_record_delete_successfully'));
        }
        else
        {
            $this->session->set_flashdata('error', lang('admin_error_during_delete_record')); 
        }
        redirect(base_url('admin/adcourse'));
    }

    function do_upload_file($filename, $path,$allowed_formate,$allowed_max_upload_size)
    {
        if (!is_dir($path)) 
        {
            mkdir($path, 0777, TRUE);
        }
        $max_server_upload_limit = convertBytes(ini_get('upload_max_filesize'));
        if($max_server_upload_limit < $allowed_max_upload_size)
        {
            $allowed_max_upload_size = $max_server_upload_limit;
        }
        
        $new_name = time().$_FILES[$filename]['name'];
        $config['upload_path']          = $path;
        $config['allowed_types']        = $allowed_formate;
        $config['max_size']             = $allowed_max_upload_size;
        $config['max_width']            = 400000;
        $config['max_height']           = 300000;
        $config['file_name']            = $new_name;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload($filename))
        {
            $respons = array('status' => 'error','error' => strip_tags($this->upload->display_errors()));
        }
        else
        {
            $respons = array('status' => 'success','upload_data' => $this->upload->data());
        }
        return $respons;
    }



}