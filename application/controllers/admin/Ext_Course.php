<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Ext_Course extends Admin_Controller {
    function __construct() 
    {
        parent::__construct();
        $this->add_css_theme('all.css');
        $this->add_js_theme('jquery-ui.min.js');
        $this->add_js_theme('jquery.multi-select.min.js');
        $this->add_js_theme('extcourse.js');

        $this->add_js_theme('plugin/taginput/bootstrap-tagsinput.min.js');
        $this->add_css_theme('plugin/taginput/bootstrap-tagsinput.css');
        // load the category model
        $this->load->model('ExtModel');    
        //load the form validation
        $this->load->library('form_validation');
        // set constants
        define('REFERRER', "referrer");
        define('THIS_URL', base_url('admin/extcourse'));
        define('DEFAULT_LIMIT', 10);
        define('DEFAULT_OFFSET', 0);
        define('DEFAULT_SORT', "last_name");
        define('DEFAULT_DIR', "asc");
        $this->add_css_theme('sweetalert.css')->add_js_theme('sweetalert-dev.js')->add_js_theme('bootstrap-notify.min.js');
    }


    function index()
    {
        $this->set_title("캠핑장 추천");
        $data = $this->includes;
        $content_data = array();
        // load views
        $data['content'] = $this->load->view('admin/extcourse/list', $content_data, TRUE);
        $this->load->view($this->template, $data);       
    }


    function list() 
    {
        $data = array();
        $list = $this->ExtModel->get_ext_course();

        $no = $_POST['start'];
        foreach ($list as $ext_course) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = ucfirst($ext_course->title);
            $row[] = ucfirst($ext_course->category_title);
            $button = '<a href="' . base_url("admin/extcourse/update/". $ext_course->id) . '" data-toggle="tooltip"  title="'.lang("admin_edit_record").'" class="btn btn-primary btn-action mr-1"><i class="fas fa-pencil-alt"></i></a>';

            $button.= '<a href="' . base_url("admin/extcourse/copy/" . $ext_course->id) . '" data-toggle="tooltip"  title="'.lang("admin_copy_record").'" class="common_copy_record btn btn-warning mr-1"><i class="far fa-copy"></i></a>';
        

            $button.= '<a href="' . base_url("admin/extcourse/delete/" . $ext_course->id) . '" data-toggle="tooltip"  title="'.lang("admin_delete_record").'" class="btn btn-danger btn-action mr-1 common_delete"><i class="fas fa-trash"></i></a>';


            $row[] = $button;
            $data[] = $row;
        }
        $output = array("draw" => $_POST['draw'], "recordsTotal" => $this->ExtModel->count_all(), "recordsFiltered" => $this->ExtModel->count_filtered(), "data" => $data,);
        
        //output to json format
        echo json_encode($output);
    }


    function add($ext_course_id = false) 
    { 
        $category_data = array(); 
        $category_array = $this->ExtModel->get_ctp02_category();

        foreach ($category_array as $category_data_array) 
        {
            $category_data[''] = '위치 선택';
            $category_data[$category_array['id']] = $category_array['name'];
            $category_data[$category_data_array->id] = $category_data_array->category_title;
        }

        $instute_data = array(); 
        $instute_array = $this->ExtModel->get_all_institution();

        foreach ($instute_array as $instute_data_array) 
        {
            $instute_data[''] = '테마 선택';
            $instute_data[$instute_array['id']] = $instute_array['name'];
            $instute_data[$instute_data_array->id] = $instute_data_array->title;
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
        $instute_courses_array = $this->input->post('instute_courses',TRUE);

        if(empty($instute_courses_array))
        {
	        $this->form_validation->set_rules('instute_courses', '태그', 'required|trim');
        }   

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
            $is_premium = $this->input->post('is_premium',TRUE) ? 1 : 0;
            $price = $this->input->post('price',TRUE) ? $this->input->post('price',TRUE) : 0;
            $status = $this->input->post('status',TRUE) ? 1 : 0;

            $ext_course_content = array();
            $ext_course_content['category_id'] = $this->input->post('category_id',TRUE);
            $ext_course_content['title'] = $this->input->post('title',TRUE);
            $ext_course_content['url'] = $this->input->post('url',TRUE);
            $ext_course_content['is_premium'] = $is_premium;
            $ext_course_content['price'] = $price;
            $ext_course_content['description'] = $this->input->post('description',FALSE);
            $ext_course_content['image'] =  $upload_file_name;
            $ext_course_content['status'] = $status;
            $ext_course_content['orders'] = $this->input->post('orders',TRUE);
            $ext_course_content['instute_id'] = $this->input->post('instute_id',TRUE);

            if($upload_file_name)
            {
                $ext_course_content['image'] =  $upload_file_name;
            }


            $ext_course_id = $this->ExtModel->insert_ext_course($ext_course_content);
            if($ext_course_id)
            {

            	if($instute_courses_array && is_array($instute_courses_array))
                {	
                	foreach ($instute_courses_array as $course_id) 
                	{
                		$institution_courses_content = array();
                		$institution_courses_content['course_id'] = $course_id;
                		$institution_courses_content['instute_id'] = $ext_course_id;
    		            $institution_id = $this->ExtModel->insert_institution_courses($institution_courses_content);
                	}

                }

                $this->session->set_flashdata('message', lang('admin_record_added_successfully'));   
            }
            else
            {
                $this->session->set_flashdata('error', lang('admin_error_adding_record')); 
            }

            redirect(base_url('admin/extcourse'));
        }

        $this->set_title("캠핑장 추가");
        $data = $this->includes;

        $all_courses = $this->ExtModel->get_all_courses();      

        $content_data = array('category_data'=>$category_data, 'instute_data'=>$instute_data, 'ext_course_id'=>$ext_course_id, 'all_courses' => $all_courses);
        // load views
        $data['content'] = $this->load->view('admin/extcourse/form', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

    function update($ext_course_id = NULL)
    {

        if(empty($ext_course_id))
        {
            $this->session->set_flashdata('error', lang('invalid_url')); 
            redirect(base_url('admin/extcourse'));
        }
        $ext_course_data = $this->ExtModel->get_ext_course_by_id($ext_course_id);

        if(empty($ext_course_data))
        {
            $this->session->set_flashdata('error', lang('admin_invalid_id')); 
            redirect(base_url('admin/extcourse'));
        }

        $category_data = array(); 
        $category_array = $this->ExtModel->get_ctp02_category();

        foreach ($category_array as $category_data_array) 
        {
            $category_data[''] = '위치 선택';
            $category_data[$category_array['id']] = $category_array['name'];
            $category_data[$category_data_array->id] = $category_data_array->category_title;
        }

        $instute_data = array(); 
        $instute_array = $this->ExtModel->get_all_institution();

        foreach ($instute_array as $instute_data_array) 
        {
            $instute_data[''] = '테마 선택';
            $instute_data[$instute_array['id']] = $instute_array['name'];
            $instute_data[$instute_data_array->id] = $instute_data_array->title;
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
                if(empty($ext_course_data->title))
                {
                    $this->form_validation->set_message('error', 'Please upload File First.');
                    $this->form_validation->set_rules('image', 'Matiral File ', 'required');                    
                }
            }
        }


        $title_unique = $this->input->post('title')  != $ext_course_data->title ? '|is_unique[ext_course.title]' : '';
        $this->form_validation->set_rules('category_id', 'Category Name', 'required|numeric|trim');
        $this->form_validation->set_rules('title', 'Title', 'required|trim'.$title_unique);
        $this->form_validation->set_rules('url', 'Url', 'required|trim');
        //$this->form_validation->set_rules('description', 'Description', 'required|trim');
        $instute_courses_array = $this->input->post('instute_courses',TRUE);

        if(empty($instute_courses_array))
        {
	        $this->form_validation->set_rules('instute_courses', '태그', 'required|trim');
        }        

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
            $is_premium = $this->input->post('is_premium',TRUE) ? 1 : 0;
            $price = $this->input->post('price',TRUE) ? $this->input->post('price',TRUE) : 0;
            $status = $this->input->post('status',TRUE) ? 1 : 0;

            $ext_course_content = array();
            $ext_course_content['category_id'] = $this->input->post('category_id',TRUE);
            $ext_course_content['title'] = $this->input->post('title',TRUE);
            $ext_course_content['url'] = $this->input->post('url',TRUE);
            $ext_course_content['is_premium'] = $is_premium;
            $ext_course_content['price'] = $price;
            $ext_course_content['description'] = $this->input->post('description',FALSE);
            $ext_course_content['status'] = $status;
            $ext_course_content['orders'] = $this->input->post('orders',TRUE);
            $ext_course_content['instute_id'] = $this->input->post('instute_id',TRUE);            
            
            if($upload_file_name)
            {
                $ext_course_content['image'] =  $upload_file_name;
            }

            $ext_course_status = $this->ExtModel->update_ext_course($ext_course_id, $ext_course_content);

            if($instute_courses_array && is_array($instute_courses_array))
            {	
                $this->ExtModel->delete_courses_by_institution_id($ext_course_id);
                foreach ($instute_courses_array as $course_id) 
                {
                    $institution_courses_content = array();
                    $institution_courses_content['course_id'] = $course_id;
                    $institution_courses_content['instute_id'] = $ext_course_id;
                    $institution_id = $this->ExtModel->insert_institution_courses($institution_courses_content);
                }

            }

            if($ext_course_status or $institution_id)
            {
                $this->session->set_flashdata('message', lang('admin_record_updated_successfully'));
            }
            else
            {
                $this->session->set_flashdata('error', lang('admin_error_during_update_record')); 
            }

            redirect(base_url('admin/extcourse'));
        }

        $this->set_title("캠핑장 정보 수정");
        $data = $this->includes;

        $all_courses = $this->ExtModel->get_all_courses();
        $institution_course_array = $this->ExtModel->get_courses_by_institution_id($ext_course_id);         

        $content_data = array('category_data'=>$category_data,'instute_data'=>$instute_data, 'ext_course_id'=>$ext_course_id,'ext_course_data'=>$ext_course_data,'institution_course_array' => $institution_course_array, 'all_courses' => $all_courses);
        // load views
        $data['content'] = $this->load->view('admin/extcourse/form', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

    function copy($ext_course_id = NULL)
    {

        action_not_permitted();
        if(empty($ext_course_id))
        {
            $this->session->set_flashdata('error', lang('invalid_url')); 
            redirect(base_url('admin/extcourse'));
        }
        $ext_course_data = $this->ExtModel->get_ext_course_by_id($ext_course_id);

        if(empty($ext_course_data))
        {
            $this->session->set_flashdata('error', lang('admin_invalid_id')); 
            redirect(base_url('admin/extcourse'));
        }     

        $ext_course_content = array();
        $ext_course_content['category_id'] = $ext_course_data->category_id;
        $ext_course_content['title'] = $ext_course_data->title.'-copy';
        $ext_course_content['url'] = $ext_course_data->url;
        $ext_course_content['price'] = $ext_course_data->price;
        $ext_course_content['is_premium'] = $ext_course_data->is_premium;
        $ext_course_content['description'] = $ext_course_data->description;
        $ext_course_content['status'] = $ext_course_data->status;
        $ext_course_content['orders'] = $ext_course_data->orders;
        $ext_course_content['instute_id'] = $ext_course_data->instute_id;

        $ext_course_id = $this->ExtModel->insert_ext_course($ext_course_content);
        if($ext_course_id)
        {
            $this->session->set_flashdata('message', lang('record_copied_successfully'));   
        }
        else
        {
            $this->session->set_flashdata('error', lang('admin_error_during_copying_record')); 
        }

        redirect(base_url('admin/extcourse'));       
    }   

    function delete($ext_course_id = NULL)
    {
        action_not_permitted();
        $status = $this->ExtModel->delete_ext_course($ext_course_id); 

        if ($status) 
        {
            $delete_course_status = $this->ExtModel->delete_courses_by_institution_id($ext_course_id); 
            $this->session->set_flashdata('message', lang('admin_record_delete_successfully'));
        }
        else
        {
            $this->session->set_flashdata('error', lang('admin_error_during_delete_record')); 
        }
        redirect(base_url('admin/extcourse'));
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

    function material_file($ext_course_id = NULL)
    {
        action_not_permitted();

        if(empty($ext_course_id))
        {
            $this->session->set_flashdata('error', lang('invalid_url')); 
            redirect(base_url('admin/extcourse'));
        }

        $ext_course_data = $this->ExtModel->get_ext_course_by_id($ext_course_id);

        if(empty($ext_course_data))
        {
            $this->session->set_flashdata('error', lang('admin_invalid_id')); 
            redirect(base_url('admin/extcourse'));
        }  

        $ext_lesson_list = $this->ExtModel->get_ext_course_content($ext_course_id);
        $content_data = array('ext_course_id' => $ext_course_id,'ext_lesson_list' => $ext_lesson_list);

        // load views
        $data = $this->includes;
        $data['content'] = $this->load->view('admin/extcourse/material_file_list', $content_data, TRUE);
        $this->load->view($this->template, $data);       
    }

    function contents_delete($ext_course_id)
    {
        $this->db->where('ext_course_id',$ext_course_id)->delete('ext_course_content');
        $contents_status =  $this->db->affected_rows();
        if($contents_status)
        {
            $this->session->set_flashdata('message', lang('record_deleted_successfully'));   
        }
        else
        {
            $this->session->set_flashdata('error', lang('error_during_delete_record')); 
        }
        redirect(base_url('admin/extcourse/material-file/'.$ext_course_id));
    }


}