<?php defined('BASEPATH') OR exit('No direct script access allowed');
class History_Controller extends Public_Controller {

    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('HomeModel');
        $this->load->model('PaymentModel');
        $this->load->model('StudyModel');        
        $this->load->model('TestModel');
        $this->add_css_theme('quiz_box.css');
        $this->add_js_theme('perfect-scrollbar.min.js');
        $this->add_css_theme('table-main.css');
        $this->add_css_theme('perfect-scrollbar.css');
        $this->add_css_theme('set2.css');
        $this->add_js_theme('study.js');       
        $this->load->library('encrypt'); 
    }
    
    public function mypage()
    {
        $user_id = (isset($this->user['id']) && $this->user['id']) ? $this->user['id'] : NULL;
        if(empty($user_id))
        {
            $this->session->set_flashdata('error', lang('please_login_first'));
            return redirect(base_url());
        }
        $user_study_material_data = $this->db->where('user_id',$user_id)->get('study_material_user_histry')->result_array();
        $user_study_material_ids = array(); 
        if($user_study_material_data)
        {
            $user_study_material_ids = array_column($user_study_material_data,"study_material_id");
            
            $sm_data_array = $this->HomeModel->get_study_material_count_by_ids($user_study_material_ids);
            $count_sm = count($sm_data_array); 
            $this->load->library('pagination');
        
            $config['base_url'] = base_url('mypage');
            $config['total_rows'] = $count_sm;
            $config['per_page'] = 10;
            $config['uri_segment'] = 3;
            $config['use_page_numbers'] = TRUE;
            $config['page_query_string'] = FALSE;
            $config['reuse_query_string'] = TRUE;
            $config['first_link'] = 'First';
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['attributes'] = ['class' => 'page-link'];
            $config['first_link'] = false;
            $config['last_link'] = false;
            $config['first_tag_open'] = '<li class="page-item">';
            $config['first_tag_close'] = '</li>';
            $config['prev_link'] = '&laquo';
            $config['prev_tag_open'] = '<li class="page-item">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = '&raquo';
            $config['next_tag_open'] = '<li class="page-item">';
            $config['next_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li class="page-item">';
            $config['last_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
            $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
            $config['num_tag_open'] = '<li class="page-item">';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $pro_per_page = $config['per_page'];
            $page = $this->uri->segment(2) > 0 ? (($this->uri->segment(2) - 1) * $pro_per_page) : $this->uri->segment(2);
            $page_links = $this->pagination->create_links();
            
            $study_material_data = $this->HomeModel->get_users_study_material_per_page($user_study_material_ids, $pro_per_page, $page);       
        }
        if(empty($count_sm)) 
        {
            $count_sm = 0;
        }
        $page_title = "마이페이지";
        $this->set_title($page_title); 
        
            $content_data = array('page_title' => $page_title , 'class_data' => $count_sm, 'study_material_data' => $study_material_data, 'pagination' => $page_links);    
    
        $data = $this->includes;
        $data['content'] = $this->load->view('mypage', $content_data, TRUE);
        $this->load->view($this->template, $data); 
    } 

    public function user_payment_data()
    {
        $user_id = (isset($this->user['id']) && $this->user['id']) ? $this->user['id'] : NULL;
        if(empty($user_id))
        {
            $this->session->set_flashdata('error', lang('please_login_first'));
            return redirect(base_url());
        }
        $purchases_type = "material";
        $user_payments_history = $this->PaymentModel->get_user_payment_history($user_id, $purchases_type);
        $content_data = array('user_payments_history' => $user_payments_history,'my_quiz_history' => $my_quiz_history);    
    
        $data = $this->includes;
        $data['content'] = $this->load->view('my_payments', $content_data, TRUE);
        $this->load->view($this->template, $data);
        
    }        
    
    
    function history($page_no=NULL) 
    {
        $session_quiz_id = 0;
        if($this->session->quiz_session)
        {
            $session_quiz_id = $this->session->quiz_session['quiz_data']['id'];
        }

        $user_id = isset($this->user['id']) ? $this->user['id'] : 0;

        if(empty($user_id))
        {
            $this->session->set_flashdata('error', lang('login_or_view_history'));
            redirect(base_url());
        }

        $my_quiz_history_count = $this->TestModel->my_quiz_history_count($user_id,$session_quiz_id);

        $this->load->library('pagination');

        $config['base_url'] = base_url('my/history');
        $config['total_rows'] = $my_quiz_history_count;
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['use_page_numbers'] = TRUE;
        $config['page_query_string'] = FALSE;
        $config['reuse_query_string'] = TRUE;
        $config['first_link'] = 'First';
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['attributes'] = ['class' => 'page-link'];
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">'; 
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $pro_per_page = $config['per_page'];
        $page = $this->uri->segment(3) > 0 ? (($this->uri->segment(3) - 1) * $pro_per_page) : $this->uri->segment(3);
        $page_links = $this->pagination->create_links();

        $my_quiz_history = $this->TestModel->my_quiz_history($user_id,$session_quiz_id, $pro_per_page, $page);
        $page_links = $this->pagination->create_links();

        $this->set_title(lang('quiz_history'), $this->settings->site_name);
        $content_data = array('Page_message' => lang('quiz_history'), 'page_title' => lang('quiz_history'),'my_quiz_history' => $my_quiz_history,'pagination'=>$page_links);

        $data = $this->includes;
        $data['content'] = $this->load->view('history', $content_data, TRUE);        
        $this->load->view($this->template, $data);
    }

    public function user_study_data()
    {
        $user_id = (isset($this->user['id']) && $this->user['id']) ? $this->user['id'] : NULL;
        if(empty($user_id))
        {
            $this->session->set_flashdata('error', lang('please_login_first'));
            return redirect(base_url());
        }
        $this->add_css_theme('sweetalert.css');
        $this->add_js_theme('sweetalert-dev.js');
        $this->add_js_theme('quiz.js');
        $user_study_material_data = $this->db->where('user_id',$user_id)->get('study_material_user_histry')->result_array();
        $user_study_material_ids = array(); 
        if($user_study_material_data)
        {
            $user_study_material_ids = array_column($user_study_material_data,"study_material_id");
            
            $sm_data_array = $this->HomeModel->get_study_material_count_by_ids($user_study_material_ids);
            $count_sm = count($sm_data_array); 
            $this->load->library('pagination');
        
            $config['base_url'] = base_url('my/study');
            $config['total_rows'] = $count_sm;
            $config['per_page'] = 10;
            $config['uri_segment'] = 3;
            $config['use_page_numbers'] = TRUE;
            $config['page_query_string'] = FALSE;
            $config['reuse_query_string'] = TRUE;
            $config['first_link'] = 'First';
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['attributes'] = ['class' => 'page-link'];
            $config['first_link'] = false;
            $config['last_link'] = false;
            $config['first_tag_open'] = '<li class="page-item">';
            $config['first_tag_close'] = '</li>';
            $config['prev_link'] = '&laquo';
            $config['prev_tag_open'] = '<li class="page-item">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = '&raquo';
            $config['next_tag_open'] = '<li class="page-item">';
            $config['next_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li class="page-item">';
            $config['last_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
            $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
            $config['num_tag_open'] = '<li class="page-item">';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $pro_per_page = $config['per_page'];
            $page = $this->uri->segment(2) > 0 ? (($this->uri->segment(2) - 1) * $pro_per_page) : $this->uri->segment(2);
            $page_links = $this->pagination->create_links();
            
            $study_material_data = $this->HomeModel->get_users_study_material_per_page($user_study_material_ids, $pro_per_page, $page);            
        }
        
        
        $page_title = lang('my_study_materials');
        $this->set_title(lang('my_study_materials')); 
        
            $content_data = array('Page_message' =>  $page_title, 'page_title' => $page_title , 'study_material_data' => $study_material_data, 'pagination' => $page_links);    
    
    
        $data = $this->includes;
        $data['content'] = $this->load->view('my_study_materials', $content_data, TRUE);
        $this->load->view($this->template, $data);
        
    }    


}