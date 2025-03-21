<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends Admin_Controller {
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
        $this->load->model('DashboardModel');
    }
    /**
     * Dashboard
     */
    function index() {
        
        $api_url = "https://projects.ishalabs.com/updates/api/"; 
        $update_info_value  = get_setting_value_by_name('update_info');
        $update_info_json = $update_info_value ? $update_info_value : json_encode(array());
        $update_info_obj = json_decode($update_info_json);
        $update_info_array = json_decode(json_encode($update_info_obj), true);

        if ($update_info_obj->purchase_code_updated) 
        {
            $up_info_site_update_token = $update_info_array['purchase_code'];
            $update_version_url = $api_url."verify_purchase_code.php?purchase_token=$up_info_site_update_token&project_slug=quiz";
            $api_response = array();
            $api_response_json = get_web_page($update_version_url);
            $api_response = json_decode($api_response_json);

            if($api_response && is_object($api_response))
            {
                $update_info_array['purchase_code_updated'] = FALSE;
                $update_info_array['last_updated'] = date("Y-m-d H:i:s");
                $update_info_array['is_verified'] = $api_response->is_verify;
                $update_info_array['message'] = $api_response->message;
            } else
            {
                $update_info_array['purchase_code_updated'] = FALSE;
                $update_info_array['last_updated'] = date("Y-m-d H:i:s");
                $update_info_array['is_verified'] = FALSE;
                $update_info_array['message'] = lang("Purchase code not verified!");
            }

            $setting_update_info['value'] = json_encode($update_info_array);
            $this->db->where('name','update_info')->update('settings',$setting_update_info);
        }

        // setup page header data
        $this->set_title(lang('admin_dashboard'));
        $data = $this->includes;
        $data['products'] = 400;
        $data['market'] = 30;
        $data['brands'] = 20;
        $data['category'] = $this->DashboardModel->categories_count();
        $data['users'] = $this->DashboardModel->user_count();
        $data['pages'] = $this->DashboardModel->pages_count();
        $data['quiz'] = $this->DashboardModel->quiz_count();
        $data['study_material'] = $this->DashboardModel->study_material_count();
        $data['blog_post'] = $this->DashboardModel->blog_count();
        $data['payment_total'] = $this->DashboardModel->payment_count();
        $data['langues_count'] = $this->DashboardModel->langues_count();
        
        // load views
        $data['content'] = $this->load->view('admin/dashboard', $data, TRUE);
        $this->load->view($this->template, $data);
        
    }
}
