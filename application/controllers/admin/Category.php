<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Category extends Admin_Controller {
    function __construct() {
        parent::__construct();
        $this->add_css_theme('all.css');
        $this->add_js_theme('jquery.multi-select.min.js');
        $this->add_js_theme('category_custome_script.js');
        // load the language files
        // load the category model
        $this->load->model('CategoryModel');
        //load the form validation
        $this->load->library('form_validation');
        // set constants
        define('REFERRER', "referrer");
        define('THIS_URL', base_url('admin/category'));
        define('DEFAULT_LIMIT', 10000);
        define('DEFAULT_OFFSET', 0);
        define('DEFAULT_SORT', "last_name");
        define('DEFAULT_DIR', "asc");
        
    }
    function index() {
        $this->add_css_theme('sweetalert.css')->add_js_theme('sweetalert-dev.js')->add_js_theme('bootstrap-notify.min.js')->set_title(lang('category_list'));
        $data = $this->includes;
        $content_data = array();
        // load views
        $data['content'] = $this->load->view('admin/category/list', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
    function form($id = null) 
    { 
        $parentcat = $this->CategoryModel->allcategory($id);
        $editData = "";
        if ($id) {
            $editData = $this->CategoryModel->getfetch($id);
        }
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('order', 'order', 'trim|required');
        if ($this->form_validation->run() != false) 
        {
            action_not_permitted();
            $content = array();
            $display_on_home = $this->input->post('display_on_home', TRUE) ? 1 : 0;
            $content['category_title'] = $this->input->post('title', TRUE);
            /*
            if ($this->input->post(lang('core_button_save'), TRUE)) 
            {
                $content['category_slug'] = "CT" . date('y') . date('m') . date('d') . date('H') . date('i') . date('s') ;
            }
            */
            $content['category_slug'] = $this->input->post('category_slug', TRUE);
            $content['parent_category'] = $this->input->post('parentcat', TRUE);
            $content['category_description'] = $this->input->post('description', false);
            $content['category_ext'] = $this->input->post('ext', false);
            $content['order'] = $this->input->post('order', TRUE);
            $content['gubun'] = $this->input->post('gubun', TRUE);
            $content['display_on_home'] = $display_on_home;
            $name = $_FILES['image']['name'];
            if ($name) 
            {
                $checkImg = $this->CategoryModel->getImage($id);
                if ($checkImg) {
                    $path = "./assets/images/category_image/" . $checkImg;
                    unlink($path);
                }
                $config['upload_path'] = "./assets/images/category_image/";
                $config['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('image')) {
                    $error = array('error' => $this->upload->display_errors());
                    $this->session->set_flashdata('error', $error['error']);
                }
                $file = $this->upload->data();
                $content['category_image'] = $file['file_name'];
            }
            if ($this->input->post(lang('core_button_save'), TRUE)) 
            {
                $this->CategoryModel->insert($content);
                $this->session->set_flashdata('message', lang('admin_record_added_successfully'));
                redirect(base_url('admin/category'));
            }
            
            if ($this->input->post(lang('core_button_update'), TRUE)) 
            {
                $this->CategoryModel->update($content, $id);
                $this->session->set_flashdata('message', lang('admin_record_updated_successfully'));
                redirect(base_url('admin/category'));
            }
        } 
        else 
        {
            $fielderror = $this->form_validation->error_array();
        }
        $this->add_js_theme('bootstrap-iconpicker.bundle.min.js');
        $this->add_js_theme('bootstrap.bundle.min.js');
        $this->add_css_theme('bootstrap-iconpicker.min.css');
        if ($id) {
            $this->set_title(lang('category_title_category_edit'));
        } else {
            $this->set_title(lang('add_category'));
        }
        $data = $this->includes;
        $content_data = array('editData' => $editData, 'cat_title' => $parentcat);
        // load views
        $data['content'] = $this->load->view('admin/category/form', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

    function category_list() 
    {
        $list = $this->CategoryModel->get_category();
        $list = json_decode(json_encode($list), true);

        // $newarray = $this->CategoryModel->allcategory();
        $newarray = $list;
        // $tree = $this->buildTree($newarray);        
        $res =  generatePageTree($newarray);
        $newCats = explode("||~LB~||", $res);
        // p($newarray);

        $data = array();
        $no = $_POST['start'];

        foreach($newCats as $cat) {
            if(trim($cat) !='' ) {
                $nArray = explode('|~CB~|', $cat);

                $catArray[$nArray[1]] = array(
                    'depth' => $nArray[0], 
                    'id' => $nArray[1], 
                    'name' => $nArray[2], 
                    'slug' => $nArray[3], 
                    'icon' => $nArray[4], 
                    'image' => $nArray[5], 
                    'status' => $nArray[6]
                );

                $no++;
                $row = array();
                $row[] = $no;
                $row[] = ucfirst($nArray[2]);
                // $row[] = get_parent_category_url_list($nArray[1]);

                $category_img_dir = base_url('assets/images/category_image/');
                $category_image = $nArray[5] ? $nArray[5] : "default.jpg";
                $category_image_name = $category_image ; 
                $category_image = $category_img_dir.$category_image;
                if(!is_file(FCPATH."assets/images/category_image/".$category_image_name))
                {
                  $category_image = base_url('assets/default/default.jpg');
                } 

              
                $row[] = "<img src='" . $category_image . "' class='listing_img'>";
               
                $row[] = '';
                $checkvalue = ($nArray[6] == 1 ? 'checked="checked"' : "");
                $row[] = '<label class="custom-switch mt-2">
                <input type="checkbox" data-id="' . $nArray[1] . '" name="custom-switch-checkbox"  class="custom-switch-input togle_switch" ' . $checkvalue . '>
                <span class="custom-switch-indicator indication"></span>
                </label>';
                $row[] = '<a href="' . base_url("admin/category/form/" . $nArray[1]) . '" data-toggle="tooltip" title="'.lang("admin_edit_record").'" class="btn btn-primary btn-action mr-1"><i class="fas fa-pencil-alt"></i></a>
    
                <a href="' . base_url("admin/category/delete/" . $nArray[1]) . '" data-toggle="tooltip"  title="'.lang("admin_delete_record").'" class="btn btn-danger btn-action mr-1 cat_delete"><i class="fas fa-trash"></i></a>';
                $data[] = $row;
            }
        }

        $output = array("draw" => $_POST['draw'], "recordsTotal" => count($data), "recordsFiltered" => count($data), "data" => $data);
        //output to json format
        echo json_encode($output);
    }
    function update_status() {
        $id = $_POST['category_id'];
        $status = $_POST['status'];
        $this->CategoryModel->updatestatus($id, $status);
        $success = array('status' => $status, 'messages' => lang('admin_category_status_updated_successfully'));
        echo json_encode($success);
    }
    function delete($id = NULL) {
        action_not_permitted();
        $findImage = $this->CategoryModel->deleteimage($id);
        if (!empty($findImage)) {
            $path = "./assets/images/category_image/$findImage";
            unlink($path);
        }
        $this->CategoryModel->delete($id);
        $this->session->set_flashdata('message', lang('admin_record_delete_successfully'));
        redirect(base_url('admin/category'));
    }
}
