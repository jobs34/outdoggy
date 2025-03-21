<?php defined('BASEPATH') OR exit('No direct script access allowed');
class AdProduct extends Admin_Controller {
    function __construct() 
    {
        parent::__construct();
        $this->add_css_theme('all.css');
        $this->add_js_theme('jquery-ui.min.js');
        $this->add_js_theme('jquery.multi-select.min.js');
        $this->add_js_theme('adproduct.js');

        $this->add_js_theme('plugin/taginput/bootstrap-tagsinput.min.js');
        $this->add_css_theme('plugin/taginput/bootstrap-tagsinput.css');
        // load the language files 
        $this->load->model('AdProductModel');
        //load the form validation
        $this->load->library('form_validation');
        // set constants
        define('REFERRER', "referrer");
        define('THIS_URL', base_url('admin/adproduct'));
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
        $data['content'] = $this->load->view('admin/adproduct/list', $content_data, TRUE);
        $this->load->view($this->template, $data);       
    }


    function list() 
    {
        $data = array();
        $list = $this->AdProductModel->get_ad_product();

        $no = $_POST['start'];
        foreach ($list as $ad_product) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = ucfirst($ad_product->title);
            $row[] = ucfirst($ad_product->category_title);
            $row[] = ucfirst($ad_product->inst_id);
            $button = '<a href="' . base_url("admin/adproduct/update/". $ad_product->id) . '" data-toggle="tooltip"  title="'.lang("admin_edit_record").'" class="btn btn-primary btn-action mr-1"><i class="fas fa-pencil-alt"></i></a>';

            $button.= '<a href="' . base_url("admin/adproduct/copy/" . $ad_product->id) . '" data-toggle="tooltip"  title="'.lang("admin_copy_record").'" class="common_copy_record btn btn-warning mr-1"><i class="far fa-copy"></i></a>';
        

            $button.= '<a href="' . base_url("admin/adproduct/delete/" . $ad_product->id) . '" data-toggle="tooltip"  title="'.lang("admin_delete_record").'" class="btn btn-danger btn-action mr-1 common_delete"><i class="fas fa-trash"></i></a>';


            $row[] = $button;
            $data[] = $row;
        }
        $output = array("draw" => $_POST['draw'], "recordsTotal" => $this->AdProductModel->count_all(), "recordsFiltered" => $this->AdProductModel->count_filtered(), "data" => $data,);
        
        //output to json format
        echo json_encode($output);
    }


    function add($ad_product_id = false) 
    { 
        $category_data = array(); 
        $category_array = $this->AdProductModel->get_ctp01_category();

        foreach ($category_array as $category_data_array) 
        {
            $category_data[''] = '위치 선택';
            $category_data[$category_array['id']] = $category_array['name'];
            $category_data[$category_data_array->id] = $category_data_array->category_title;
        }

        $inst_data = array(); 
        $instute_array = $this->AdProductModel->get_all_institution();

        foreach ($instute_array as $instute_data_array) 
        {
            $inst_data[''] = '테마 선택';
            $inst_data[$instute_array['id']] = $instute_array['name'];
            $inst_data[$instute_data_array->id] = $instute_data_array->title;
        }

        $upload_file_name = NULL;
        $file_link = NULL;

        if($this->input->post('title'))
        {
            if(isset($_FILES['image']['name']) && $_FILES['image']['name'])
            {   
                $allowed_formate = 'gif|jpg|png|bmp|jpeg';
                $allowed_max_upload_size = 26000000;
                $path = "./assets/images/advertisment";
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
            $status = $this->input->post('status',TRUE) ? 1 : 0;
            
            $ad_product_content = array();
            $ad_product_content['category_id'] = $this->input->post('category_id',TRUE);
            $ad_product_content['title'] = $this->input->post('title',TRUE);
            $ad_product_content['url'] = $this->input->post('url',TRUE);
            $ad_product_content['description'] = $this->input->post('description',FALSE);
            $ad_product_content['image'] =  $upload_file_name;
            $ad_product_content['status'] = $status;
            $ad_product_content['inst_id'] = $this->input->post('inst_id',TRUE);

            $ad_product_id = $this->AdProductModel->insert_ad_product($ad_product_content);
            if($ad_product_id)
            {
                $this->session->set_flashdata('message', lang('admin_record_added_successfully'));   
            }
            else
            {
                $this->session->set_flashdata('error', lang('admin_error_adding_record')); 
            }

            redirect(base_url('admin/adproduct'));
        }

        $this->set_title("새 판매 상품 링크");
        $data = $this->includes;

        $content_data = array('category_data'=>$category_data,'inst_data'=>$inst_data,'ad_product_id'=>$ad_product_id,);
        // load views
        $data['content'] = $this->load->view('admin/adproduct/form', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

    function update($ad_product_id = NULL)
    {

        if(empty($ad_product_id))
        {
            $this->session->set_flashdata('error', lang('invalid_url')); 
            redirect(base_url('admin/adproduct'));
        }
        $ad_product_data = $this->AdProductModel->get_ad_product_by_id($ad_product_id);

        if(empty($ad_product_data))
        {
            $this->session->set_flashdata('error', lang('admin_invalid_id')); 
            redirect(base_url('admin/adproduct'));
        }

        $category_data = array(); 
        $category_array = $this->AdProductModel->get_ctp01_category();

        foreach ($category_array as $category_data_array) 
        {
            $category_data[''] = '위치 선택';
            $category_data[$category_array['id']] = $category_array['name'];
            $category_data[$category_data_array->id] = $category_data_array->category_title;
        }

        $inst_data = array(); 
        $instute_array = $this->AdProductModel->get_all_institution();

        foreach ($instute_array as $instute_data_array) 
        {
            $inst_data[''] = '테마 선택';
            $inst_data[$instute_array['id']] = $instute_array['name'];
            $inst_data[$instute_data_array->id] = $instute_data_array->title;
        }

        $upload_file_name = NULL;
        $file_link = NULL;

        if($this->input->post('title'))
        {
            if(isset($_FILES['image']['name']) && $_FILES['image']['name'])
            {   
                $allowed_formate = 'gif|jpg|png|bmp|jpeg';
                $allowed_max_upload_size = 26000000;
                $path = "./assets/images/advertisment";
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
                if(empty($ad_product_data->title))
                {
                    $this->form_validation->set_message('error', 'Please upload File First.');
                    $this->form_validation->set_rules('image', 'Matiral File ', 'required');                    
                }
            }
        }


        $title_unique = $this->input->post('title')  != $ad_product_data->title ? '|is_unique[ad_product.title]' : '';
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
            $status = $this->input->post('status',TRUE) ? 1 : 0;

            $ad_product_content = array();
            $ad_product_content['category_id'] = $this->input->post('category_id',TRUE);
            $ad_product_content['title'] = $this->input->post('title',TRUE);
            $ad_product_content['url'] = $this->input->post('url',TRUE);
            $ad_product_content['description'] = $this->input->post('description',FALSE);
            $ad_product_content['status'] = $status;
            $ad_product_content['inst_id'] = $this->input->post('inst_id',TRUE);

            if($upload_file_name)
            {
                $ad_product_content['image'] =  $upload_file_name;
            }

            $course_update_status = $this->AdProductModel->update_ad_product($ad_product_id, $ad_product_content);

            
                $this->session->set_flashdata('message', lang('admin_record_updated_successfully'));
            
                redirect(base_url('admin/adproduct'));
        }

        $this->set_title("판매상품 링크 수정");
        $data = $this->includes;

        $content_data = array('category_data'=>$category_data, 'inst_data'=>$inst_data, 'ad_product_id'=>$ad_product_id,'ad_product_data'=>$ad_product_data,);
        // load views
        $data['content'] = $this->load->view('admin/adproduct/form', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

    function copy($ad_product_id = NULL)
    {

        action_not_permitted();
        if(empty($ad_product_id))
        {
            $this->session->set_flashdata('error', lang('invalid_url')); 
            redirect(base_url('admin/adproduct'));
        }
        $ad_product_data = $this->AdProductModel->get_ad_product_by_id($ad_product_id);

        if(empty($ad_product_data))
        {
            $this->session->set_flashdata('error', lang('admin_invalid_id')); 
            redirect(base_url('admin/adproduct'));
        }     

        $ad_product_content = array();
        $ad_product_content['category_id'] = $ad_product_data->category_id;
        $ad_product_content['title'] = $ad_product_data->title.'-copy';
        $ad_product_content['url'] = $ad_product_data->url;
        $ad_product_content['description'] = $ad_product_data->description;
        $ad_product_content['status'] = $ad_product_data->status;
        $ad_product_content['instute_id'] = $ad_product_data->instute_id;

        $ad_product_id = $this->AdCourseModel->insert_ad_product($ad_product_content);
        if($ad_product_id)
        {
            $this->session->set_flashdata('message', lang('record_copied_successfully'));   
        }
        else
        {
            $this->session->set_flashdata('error', lang('admin_error_during_copying_record')); 
        }

        redirect(base_url('admin/adproduct'));       
    }   

    function delete($ad_product_id = NULL)
    {
        action_not_permitted();
        $status = $this->AdProductModel->delete_ad_product($ad_product_id); 

        if ($status) 
        {
            $this->session->set_flashdata('message', lang('admin_record_delete_successfully'));
        }
        else
        {
            $this->session->set_flashdata('error', lang('admin_error_during_delete_record')); 
        }
        redirect(base_url('admin/adproduct'));
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