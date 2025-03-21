<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Contents_Controller extends Public_Controller {
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
        $this->add_js_theme('home.js');
        $this->add_css_theme('quiz_box.css');        
        $this->load->library('form_validation');
        $this->load->model('HomeModel');
        $this->load->model('StudyModel');
        $this->load->model('ExtModel');
        $this->load->model('AdProductModel');
    }

    function campground($slug=NULL)
    {
        $category_slug = $slug;
        $category_data = $this->HomeModel->get_category_by_slug($category_slug);      
        if(empty($category_data))
        {
            return redirect(base_url("404_override"));
        }      
        $free_course_list_data = $this->ExtModel->get_category_cground($category_data->id);

        if($category_slug=="camping_area")
        {
            $page_title = "추천하는 애견동반 캠핑장,글램핑장 정보";
        }
        else{
            $page_title = "추천하는 애견동반 펜션 등의 숙소 정보";
        }
        $this->set_title($page_title);

        $content_data = array('page_title' => $page_title, 'category_data' => $category_data, 'free_course_list_data' => $free_course_list_data );

        $data = $this->includes;
        $data['content'] = $this->load->view('campground', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

    function lecture_subcate($slug=NULL)
    {
        $category_slug = $slug;
        $category_data = $this->HomeModel->get_category_by_slug($category_slug);   
        if(empty($category_data))
        {
            return redirect(base_url("404_override"));
        }    
        $lecture_data = $this->HomeModel->get_category_study_material($category_data->id);    

        $page_title = "캠핑 스쿨";
        $this->set_title($page_title);

        $content_data = array('page_title' => $category_data->category_title, 'category_data' => $category_data,'lecture_data' => $lecture_data);
        $data = $this->includes;
        $data['content'] = $this->load->view('courses', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }    

    function serieses($study_material_slug)
    {
        $purchases_type = "material";
        if(empty($study_material_slug) or !is_numeric($study_material_slug))
        {
            $this->session->set_flashdata('error', lang('invalid_uri_arguments!'));
            return redirect(base_url()); 
        }
        $study_material_id = $study_material_slug;
            
        $study_data = $this->StudyModel->get_study_material_and_file_by_id($study_material_id);                
        if(empty($study_data))
        {
           $this->session->set_flashdata('error', lang('invalid_uri_arguments')); 
           return redirect(base_url());
        }

        $current_date = date('Y-m-d');
        $study_material_section_data = $this->StudyModel->get_study_material_section_by_study_material_id($study_material_id);
        
        $user_id = (isset($this->user['id']) && $this->user['id']) ? $this->user['id'] : 0;
        $is_user_enrolled = FALSE;
        $is_pending = FALSE;

        $page_title = "캠핑스쿨 - ".$study_data->title;
        $this->set_title($page_title);

        $meta_data = array('meta_title' => $study_data->meta_title, 'meta_keyword' => $study_data->meta_keywords, 'meta_description' =>  $study_data->meta_description, 'title' => $study_data->title,'description' => $study_data->description,'image' => "",);
           
        $content_data = array('page_title' => $page_title,'study_material_id' => $study_material_id,'study_data'=>$study_data,'study_material_section_data' => $study_material_section_data);

        $data = $this->includes;

        $data['content'] = $this->load->view('serieses', $content_data, TRUE);
        $data['meta_data'] = $meta_data;
        $this->load->view($this->template, $data);
    }

    function cgrounds($ext_course_id,$gubun_id=NULL)
    {
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
        $nav_slug = $category_data->category_slug;
        $page_title = "추천 캠핑장 : ". $ext_course_data->title ." - " .$category_data->category_title;
    	$this->set_title($page_title);

        $inst_data = $this->ExtModel->get_institution_by_id($ext_course_data->instute_id);    
        $tag_data = $this->ExtModel->get_courses_by_ext_course_id($ext_course_id); 
        //사용할 필요 없는 것 같아서 일시적으로 중지 (퍼포먼스 유지 차원)
        //$content_data = $this->ExtModel->get_ext_course_content($ext_course_id);   

        $instute_id = $ext_course_data->instute_id;
        if (isset($instute_id) && !empty($instute_id)){
            $adproduct_data = $this->AdProductModel->get_inst_product($instute_id);
            $related_cground = $this->ExtModel->get_related_cground($instute_id, $ext_course_data->id);
        }  

        $content_data = array('page_title' => $page_title, 'ext_course_id' => $ext_course_id,'ext_course_data'=>$ext_course_data,'category_data'=>$category_data, 'nav_slug' => $nav_slug, 'inst_data'=>$inst_data, 'tag_data' => $tag_data, 'adproduct_data' => $adproduct_data,'related_cground' => $related_cground);
        $data = $this->includes;
        $data['content'] = $this->load->view('cground_show', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

}
