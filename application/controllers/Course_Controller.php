<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Course_Controller extends Lms_Controller {

    /**
     * Constructor  
     */
    function __construct() 
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('HomeModel');
        $this->load->model('PaymentModel');
        $this->load->model('MembershipModel');
        $this->load->model('TestModel');
        $this->load->model('StudyModel');
        $this->add_css_theme('quiz_box.css');
        $this->add_css_theme('set2.css');
        $this->add_css_theme('table-main.css');
        $this->load->library('Ratting');
        $this->add_js_theme('study.js');
    }

    function index($purchases_type,$study_material_id = NULL)
    {

        $study_data = $this->StudyModel->get_study_material_and_file_by_id($study_material_id);
        
        if(empty($study_data))
        {
           $this->session->set_flashdata('error', lang('invalid_id')); 
           redirect(base_url());
        }
        
        $study_m_title = $study_data->title;
        $real_url = base_url('study-material/').slugify_string($study_m_title)."-$study_material_id";
        return redirect($real_url);
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

        $page_title = "복지시설 종사자 실무 클래스";
        $this->set_title($page_title);

        $content_data = array('page_title' => $category_data->category_title, 'category_data' => $category_data,'lecture_data' => $lecture_data);
        $data = $this->includes;
        $data['content'] = $this->load->view('lecture', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }    


    function parentcategory($slug=NULL)
    {
        $category_slug = $slug;
        $category_data = $this->HomeModel->get_category_by_slug($category_slug);
        if(empty($category_data))
        {
            return redirect(base_url("404_override"));
        }
        $category_child_data = $this->HomeModel->get_child_category($category_data->id);

        $page_title = "사회복지 관련 자격증 추천";
        $this->set_title($page_title);    

        $content_data = array('page_title' => $page_title,'category_child_data' => $category_child_data,'category_data' => $category_data);

        $data = $this->includes;
        $data['content'] = $this->load->view('parentcategory', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

    function category($id=NULL)
    {
        $category_id = $id;
        $category_data = $this->HomeModel->get_category_by_id($category_id);
        if(empty($category_data))
        {
            return redirect(base_url("404_override"));
        }

        $this->add_css_theme('sweetalert.css');
        $this->add_js_theme('sweetalert-dev.js');
        $this->add_js_theme('quiz.js');

        $quiz_data = $this->HomeModel->get_quiz_by_category($category_id);
        $free_course_list_data = $this->HomeModel->get_subcate_free_course($category_id);
        $rel_post_data = $this->HomeModel->get_category_rel_post($category_id);
        $sub_category_data = $this->HomeModel->get_sub_category_data($category_data->parent_category);
        
        $page_title = "사회복지 관련 자격증 추천 - ". $category_data->category_title;
        $this->set_title($page_title);

        $content_data = array('Page_message' => $page_title, 'page_title' => $page_title , 'category_data' => $category_data, 'quiz_data' => $quiz_data,'sub_category_data'=>$sub_category_data, 'free_course_list_data' => $free_course_list_data, 'rel_post_data' => $rel_post_data );

        $data = $this->includes;
        $data['content'] = $this->load->view('category', $content_data, TRUE);
        $this->load->view($this->template, $data);


    }

    function study_details_show($study_material_slug)
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
        // ########## 로그인을 한 경우에만 해당 항목 체크함 S
         if($user_id)
        {  
           //-----------   해당 강좌가 신청이 꼭 필요한 경우라면 S 
            if($study_data->is_registered == 1)
            {
                $is_enrolled =  $this->PaymentModel->get_last_enroll_status($study_material_id);
                //++++++ Enroll 체크하기 S
                if($is_enrolled){
                    //아래 상태로 액션 구분 
                    $is_user_enrolled = TRUE;
                 } 
                 else {    
                    //#### 유료 상품 일 때 신청한 내역이 있는지 체크합니다. S
                    if($study_data->price > 0) {
                        $pending_s_m_array = $this->PaymentModel->get_payment_pending_status($study_material_id,$user_id,$purchases_type);
                        if($pending_s_m_array){
                            $is_pending = TRUE; 
                        }     
                    }
                   //#### 유료 상품 일 때 신청한 내역이 있는지 체크합니다. E 
                } 
                //++++++ Enroll 체크하기 E  
            }
           //-----------   해당 강좌가 신청이 꼭 필요한 경우라면 E
        }
        // ########## 로그인을 한 경우에만 해당 항목 체크함 E
        
        $meta_data = array('meta_title' => $study_data->meta_title, 'meta_keyword' => $study_data->meta_keywords, 'meta_description' =>  $study_data->meta_description, 'title' => $study_data->title,'description' => $study_data->description,'image' => "",);

 
         //--- (강좌 소개 페이지 확인한 사람들 데이터 : 사용하지 않음)
        //$study_m_user_data = $this->db->where('id',$study_data->user_id)->get('users')->row();
        //$savedata = array();
        //$savedata['study_material_id'] = $study_data->id;
        //$savedata['ip_address'] = $this->input->ip_address();
        //$savedata['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
        //$study_view_data = $this->StudyModel->get_study_view($study_data->id,$this->input->ip_address(),$current_date);        
        //if(empty($study_view_data))
        //{
        //   $inserted_data = $this->StudyModel->save_study_view_data($savedata);
        //}       

        $title = $study_data->title;
        $page_title = "클래스 : ".$title;
    	$this->set_title($page_title);

        $content_data = array('page_title' => lang('front_study_material_detail'),'study_material_id' => $study_material_id,'study_data'=>$study_data,'purchases_type'=>$purchases_type,'study_m_user_data' => $study_m_user_data,'study_material_section_data' => $study_material_section_data, 'is_user_enrolled' => $is_user_enrolled, 'is_pending' => $is_pending);

        $data = $this->includes;

        $data['content'] = $this->load->view('study_material_detail_show', $content_data, TRUE);
        $data['meta_data'] = $meta_data;
        $this->load->view($this->template, $data);
    }



    function study_details($study_material_slug, $study_material_content_id = NULL)
    {
        $purchases_type = "material";
        if(empty($study_material_slug))
        {
            $this->session->set_flashdata('error', '잘못된 접근입니다!');
            return redirect(base_url()); 
        }
        $study_material_id = $study_material_slug;

        $user_id = (isset($this->user['id']) && $this->user['id']) ? $this->user['id'] : NULL;

        $study_data = $this->StudyModel->get_study_material_and_file_by_id($study_material_id);
        if(empty($study_data))
        {
           $this->session->set_flashdata('error', '잘못된 접근입니다!'); 
           return redirect(base_url());
        }

        $study_material_section_data = $this->StudyModel->get_study_material_section_by_study_material_id($study_material_id);
        $study_section_ids = array();
        if($study_material_section_data)
        {   
            $study_material_section_data_array = json_decode(json_encode($study_material_section_data), true);
            $study_section_ids = array_column($study_material_section_data_array,"id");
        }

        $s_m_completed_data = $this->StudyModel->get_user_completed_s_m_contant($study_material_id,$user_id);
        $s_m_completed_content_ids = array();
        if($s_m_completed_data && count($s_m_completed_data))
        {
            $s_m_completed_content_ids = array_column($s_m_completed_data,"s_m_contant_id");
        }

        $study_material_content_data = $this->StudyModel->get_study_material_content_by_ids($study_material_id,$study_material_content_id);
        if(empty($study_material_content_data))
        {
            $this->session->set_flashdata('error', lang('invalid_uri_arguments_or_study_material_has_no_contant')); 
            return redirect(base_url("study-content/$study_material_slug"));
        }

        $next_study_material_content_data = false;
        if($study_material_content_data)
        {
            $next_study_material_content_data = $this->StudyModel->get_next_study_material_content_by_ids($study_material_content_data,$study_material_content_data->section_id);
            if(empty($next_study_material_content_data))
            {
                    foreach ($study_section_ids as $array_study_section_id) 
                    {
                        if($array_study_section_id > $study_material_content_data->section_id)
                        {
                            $next_study_material_content_data = $this->StudyModel->get_next_study_material_content_by_ids($study_material_content_data,$array_study_section_id);
                            break;
                        }
                    }
                   
            }
        }
        $now_section_data = $this->StudyModel->get_study_section_info($study_material_content_data->section_id); 

        $course_title = $study_data->title;
        $now_section_title = $now_section_data->title;
        $study_material_content_title = $study_material_content_data->title;

        $page_title = $course_title." > ".$study_material_content_title;
    	$this->set_title($page_title);

        $meta_data = array('meta_title' => $page_title, 'meta_keyword' => $study_data->meta_keywords, 'meta_description' =>  $study_data->meta_description, 'title' => $page_title,'description' => $study_data->description,'image' => "",);
   
        $content_data = array('page_title' => $study_material_content_title,'study_material_id' => $study_material_id,'study_data'=>$study_data,'study_material_content_data'=>$study_material_content_data,'study_m_user_data' => $study_m_user_data,'study_material_section_data' => $study_material_section_data,'s_m_completed_data' => $s_m_completed_data,'s_m_completed_content_ids' => $s_m_completed_content_ids,'next_study_material_content_data'=>$next_study_material_content_data,'study_material_content_id' => $study_material_content_id,'now_section_data' => $now_section_data, 'study_material_slug'=>$study_material_slug);

        $data = $this->includes;
        $data['content'] = $this->load->view('lesson_detail', $content_data, TRUE);
        $data['meta_data'] = $meta_data;
        $this->load->view($this->template, $data);
    }

   function preview_details($study_material_slug, $study_material_content_id = NULL)
    {
        if(empty($study_material_slug))
        {
            $this->session->set_flashdata('error', '잘못된 접근입니다!');
            return redirect(base_url()); 
        }

        $study_material_id = $study_material_slug;

        $study_data = $this->StudyModel->get_study_material_and_file_by_id($study_material_id);
        if(empty($study_data))
        {
           $this->session->set_flashdata('error', '잘못된 접근입니다!'); 
           return redirect(base_url());
       }
        
        $study_material_section_data = $this->StudyModel->get_study_material_section_by_study_material_id($study_material_id);
        
        $study_material_content_data = $this->StudyModel->get_study_material_content_by_ids($study_material_id,$study_material_content_id);
        if(empty($study_material_content_data))
        {
            $this->session->set_flashdata('error', '강좌에 학습할 내용이 없습니다.'); 
            return redirect(base_url("study-content/$study_material_slug"));
        }

        $now_section_data = $this->StudyModel->get_study_section_info($study_material_content_data->section_id);  

        $meta_data = array('meta_title' => $study_material_content_data->title, 'meta_keyword' => $study_data->meta_keywords, 'meta_description' =>  $study_data->meta_description, 'title' => $study_data->title,'description' => $study_data->description,'image' => "",);

        $title = $study_data->title;
        $page_title = "미리보기:".$title;
    	$this->set_title($page_title);   
        
        $content_data = array('page_title' => $study_material_content_data->title,'study_material_id' => $study_material_id,'study_data'=>$study_data,'study_material_content_data'=>$study_material_content_data,'study_material_section_data' => $study_material_section_data,
        'study_material_content_id' => $study_material_content_id,
        'now_section_data' => $now_section_data,'study_material_slug'=>$study_material_slug);

        $data = $this->includes;
        $data['content'] = $this->load->view('preview_detail', $content_data, TRUE);
        $data['meta_data'] = $meta_data;
        //비로그인 템플릿 사용 (따로 구분했으나 지금은 구분없이 LMS템플릿 사용)
        //$this->template = "../../{$this->settings->themes_folder}/{$this->settings->theme}/previewtemplate.php";
        $this->load->view($this->template, $data);
    }  
    
    
    function lesson_view()
    {
        $study_material_id = $_POST['study_material_id'];
        $study_material_content_data = $this->StudyModel->get_material_content_by_id($study_material_id);
        if(empty($study_material_content_data))
        {
            $this->session->set_flashdata('error', '강좌에 학습할 내용이 없습니다.'); 
            return redirect(base_url("study-content/$study_material_slug"));
        }

        $next_study_material_content_data = false;
        
        $content_data = array('study_material_id' => $study_material_id,'study_data'=>$study_data,'study_material_content_data'=>$study_material_content_data);
    
        $data = $this->includes;
        // load views
        $modal_data = $this->load->view('lesson_view', $content_data, TRUE);
        echo json_encode($modal_data);
    }
    
    
}