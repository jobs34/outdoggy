<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Ext_Controller extends Lms_Controller {

    /**
     * Constructor  
     */
    function __construct() 
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('HomeModel');
        $this->load->model('ExtModel');
        $this->load->model('AdCourseModel');
        $this->load->model('AdvertismentModel');
        $this->add_css_theme('quiz_box.css');
        $this->add_css_theme('set2.css');
        $this->add_css_theme('table-main.css');
        $this->load->library('Ratting');
        $this->add_js_theme('study.js');
    }

    function index($ext_course_id = NULL)
    {

    }

    function ad_course_show($ad_course_id,$gubun_id=NULL)
    {
        $gubun_param = ($gubun_id) ? $gubun_id : "category";
        if(empty($ad_course_id) or !is_numeric($ad_course_id))
        {
            $this->session->set_flashdata('error', lang('invalid_uri_arguments!'));
            return redirect(base_url()); 
        }
        $ad_course_data = $this->AdCourseModel->get_ad_course_by_id($ad_course_id);        
        if(empty($ad_course_data))
        {
           $this->session->set_flashdata('error', lang('invalid_uri_arguments')); 
           return redirect(base_url());
        }

        $category_id = $ad_course_data->category_id;
        $category_data = $this->ExtModel->get_category_by_id($category_id); 
        $page_title = $category_data->category_title." 국민내일배움카드 국비지원 강의 - ". $ad_course_data->title;
    	$this->set_title($page_title);

        $inst_data = $this->AdCourseModel->get_institution_by_id($ad_course_data->instute_id);      

        $content_data = array('page_title' => $page_title, 'gubun_param' => $gubun_param, 'ad_course_id' => $ad_course_id,'ad_course_data'=>$ad_course_data,'category_data'=>$category_data,'inst_data'=>$inst_data);
        $data = $this->includes;
        $data['content'] = $this->load->view('ad_course_show', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

    function ext_course_show($ext_course_id,$gubun_id=NULL)
    {
        $gubun_param = ($gubun_id) ? $gubun_id : "category";
        if(empty($ext_course_id) or !is_numeric($ext_course_id))
        {
            $this->session->set_flashdata('error', lang('invalid_uri_arguments!'));
            return redirect(base_url()); 
        }
            
        $ext_course_data = $this->ExtModel->get_ext_course_by_id($ext_course_id);        
        if(empty($ext_course_data))
        {
           $this->session->set_flashdata('error', lang('invalid_uri_arguments')); 
           return redirect(base_url());
        }
        $category_id = $ext_course_data->category_id;
        $category_data = $this->ExtModel->get_category_by_id($category_id); 
        $page_title = "추천 캠핑장 : ". $ext_course_data->title.$category_data->category_title;
    	$this->set_title($page_title);

        $inst_data = $this->ExtModel->get_institution_by_id($ext_course_data->instute_id);    
        //$free_course_list_data = $this->HomeModel->get_subcate_free_course($category_id);
        $content_data = $this->ExtModel->get_ext_course_content($ext_course_id); 
        $adv_data = $this->AdvertismentModel->get_adv_by_position('home_page_below_category');

        $content_data = array('page_title' => $page_title, 'gubun_param' => $gubun_param, 'ext_course_id' => $ext_course_id,'ext_course_data'=>$ext_course_data,'category_data'=>$category_data,'inst_data'=>$inst_data,'content_data'=>$content_data, 'adv_data' => $adv_data);
        $data = $this->includes;
        $data['content'] = $this->load->view('ext_course_show', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
    
}