<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Home_Controller extends Open_Controller {
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
        $this->add_js_theme('home.js');
        $this->add_css_theme('quiz_box.css');        
        $this->load->library('form_validation');
        $this->load->model('HomeModel');
        $this->load->model('BlogModel');
        $this->load->model('StudyModel');
        $this->load->model('AdvertismentModel');
        $this->load->model('ExtModel');
    }

    function index()
    {
        $title = "아웃도기 - 행복한 애견동반 캠핑 & 여행 정보";
        $meta_title = "애견동반 캠핑,글램핑,차박,펜션,피크닉 등의 아웃도어 정보";
        $meta_keywords = "애견동반캠핑장,애견동반글램핑장,애견동반캠핑,애견동반숙소,강아지펜션,애견캠핑장,애견동반펜션";
        $meta_description = "행복한 애견동반 아웃도어 라이프 지침서, 아웃도기입니다.";
        $page_title = $title;
        $this->set_title($page_title);

        $meta_data = array('meta_title' => $meta_title, 'meta_keyword' => $meta_keywords, 'meta_description' =>  $meta_description);
        
        $blog_data = $this->HomeModel->get_last8_postall();  
        $adv_data = $this->AdvertismentModel->get_adv_by_position('common_before_footer');
   
        $content_data = array('page_title' => $page_title, 'blog_data' => $blog_data, 'adv_data' => $adv_data);

        $data = $this->includes;
        $data['content'] = $this->load->view('home', $content_data, TRUE);
        $data['meta_data'] = $meta_data;
        $this->load->view($this->template, $data);
    }    

}
