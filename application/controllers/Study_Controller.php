<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Study_Controller extends Public_Controller {

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

    function index()
    {
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
        
        $this->set_title(lang('front_study_material_detail'));             
        $content_data = array('page_title' => lang('front_study_material_detail'),'study_material_id' => $study_material_id,'study_data'=>$study_data,'purchases_type'=>$purchases_type,'study_m_user_data' => $study_m_user_data,'study_material_section_data' => $study_material_section_data, 'is_user_enrolled' => $is_user_enrolled, 'is_pending' => $is_pending);

        $data = $this->includes;

        $data['content'] = $this->load->view('serieses', $content_data, TRUE);
        $data['meta_data'] = $meta_data;
        $this->load->view($this->template, $data);
    }

    function complete_sm_contant()
    {
        $response['status'] = 'error';
        $response['action'] = '';
        $response['message'] = lang('something_went_wrong');
        $response['complete_count'] = 0;
        $response['s_m_s_complete_count'] = 0;

        $s_m_contant_id = $this->input->post('s_m_contant_id');
        $s_m_id = $this->input->post('s_m_id');
        $s_m_section_id = $this->input->post('s_m_section_id');
        if(empty($s_m_contant_id) OR empty($s_m_id) OR empty($s_m_section_id))
        {
            echo json_encode($response);
            exit;
        }
        $user_id = (isset($this->user['id']) && $this->user['id']) ? $this->user['id'] : NULL;
        if(empty($user_id))
        {
            $response['message'] = lang('please_login_first');
            echo json_encode($response);
            exit;
        }

        $is_completed = $this->db->where('user_id',$user_id)->where('s_m_id',$s_m_id)->where('s_m_contant_id',$s_m_contant_id)->get('study_material_user_history')->row();

        if($is_completed)
        {
            $this->db->where('user_id',$user_id)->where('s_m_id',$s_m_id)->where('s_m_contant_id',$s_m_contant_id)->delete('study_material_user_history');
            $status =  $this->db->affected_rows();
            if($status)
            {
                $total = $this->db->select('count(id) as total')->where('user_id',$user_id)->where('s_m_id',$s_m_id)->get('study_material_user_history')->row('total');
                $response['status'] = 'success';
                $response['action'] = 'uncomplete';
                $response['message'] = lang('uncomplete_section_contant');
                $response['complete_count'] = $total;
                $s_m_s_complete_arr = get_user_completed_s_m_section_contant($s_m_id,$s_m_section_id,$user_id);
                $s_m_s_complete_count = $s_m_s_complete_arr ? count($s_m_s_complete_arr) : 0;
                $response['s_m_s_complete_count'] = $s_m_s_complete_count;
            }
            else
            {
                $response['message'] = lang('error_during_unmark_completed');
            }
            echo json_encode($response);
            exit;

        }
        else
        {

            $db_data_array = array();
            $db_data_array['s_m_id'] = $s_m_id;
            $db_data_array['s_m_contant_id'] = $s_m_contant_id;
            $db_data_array['s_m_section_id'] = $s_m_section_id;
            $db_data_array['user_id'] = $user_id;
            $db_data_array['comlete_on'] = date("Y-m-d H:i:s");
            $this->db->insert('study_material_user_history',$db_data_array);
            $new_id = $this->db->insert_id();

            if($new_id)
            {
                $total = $this->db->select('count(id) as total')->where('user_id',$user_id)->where('s_m_id',$s_m_id)->get('study_material_user_history')->row('total');
                $response['status'] = 'success';
                $response['action'] = 'complete';
                $response['message'] = lang('complete_section_contant');
                $response['complete_count'] = $total;
                $s_m_s_complete_arr = get_user_completed_s_m_section_contant($s_m_id,$s_m_section_id,$user_id);
                $s_m_s_complete_count = $s_m_s_complete_arr ? count($s_m_s_complete_arr) : 0;
                $response['s_m_s_complete_count'] = $s_m_s_complete_count;

            }
            else
            {
                $response['message'] = lang('error_during_mark_complete');
            }
            echo json_encode($response);
            exit;
        }

        echo json_encode($response);
        exit;
    }

    function complete_sm_contant_and_go_to_next()
    {
        $response['status'] = 'error';
        $response['message'] = lang('something_went_wrong');
        $response['action'] = '';

        $s_m_contant_id = $this->input->post('s_m_contant_id');
        $s_m_id = $this->input->post('s_m_id');
        $s_m_section_id = $this->input->post('s_m_section_id');
        if(empty($s_m_contant_id) OR empty($s_m_id) OR empty($s_m_section_id))
        {
            echo json_encode($response);
            exit;
        }
        $user_id = (isset($this->user['id']) && $this->user['id']) ? $this->user['id'] : NULL;
        if(empty($user_id))
        {
            $response['message']    = lang('please_login_first');
            $response['action']     = 'jump_to_next';
            echo json_encode($response);
            exit;
        }

        $is_completed = $this->db->where('user_id',$user_id)->where('s_m_id',$s_m_id)->where('s_m_contant_id',$s_m_contant_id)->get('study_material_user_history')->row();

        if($is_completed)
        {
            $response['status'] = 'success';
            $response['message'] = lang('already_complete_section_contant');
            echo json_encode($response);
            exit;

        }
        else
        {

            $db_data_array = array();
            $db_data_array['s_m_id'] = $s_m_id;
            $db_data_array['s_m_contant_id'] = $s_m_contant_id;
            $db_data_array['s_m_section_id'] = $s_m_section_id;
            $db_data_array['user_id'] = $user_id;
            $db_data_array['comlete_on'] = date("Y-m-d H:i:s");
            $this->db->insert('study_material_user_history',$db_data_array);
            $new_id = $this->db->insert_id();

            if($new_id)
            {
                $response['status'] = 'success';
                $response['message'] = lang('complete_section_contant');
            }
            else
            {
                $response['message'] = lang('error_during_mark_complete');
            }
            echo json_encode($response);
            exit;
        }

        echo json_encode($response);
        exit;
    }

    function like_study()
    {
        $response['status'] = 'error';
        $response['action'] = '';
        $response['message'] = lang('something_went_wrong');
        $response['like_count'] = 0;


        $user_id = (isset($this->session->userdata('logged_in')['id']) && $this->session->userdata('logged_in')['id']) ? $this->session->userdata('logged_in')['id'] : 0;
    	$user_id = $user_id ? $user_id : 0;
    	$study_id = (isset($_POST['study_id']) && $_POST['study_id']) ? $_POST['study_id'] : 0;
		if($study_id)
		{
	        if($user_id) 
	        {
	            $study_material_like = $this->db->where('study_material_id',$study_id)->where('user_id',$user_id)->get('study_material_like')->row();

	            if($study_material_like)
	            {
		            $delete_data = $this->HomeModel->delete_like_study_through_studyid($study_id, $user_id);
		            $get_count_of_likes = $this->HomeModel->get_count_likes_through_study_id($_POST['study_id']);

	            	$response['action'] = 'unlike';
		            if($delete_data)
		            {
		                $response['status'] = 'success';
		                $response['message'] = lang('unlike');
	        			$response['like_count'] = $get_count_of_likes;
		            }
		            else
		            {
		                $response['message'] = lang('error_durning_unlike');
		            }
	            }
	            else
	            {
		            $save_study_like['study_material_id'] = $study_id;
		            $save_study_like['user_id'] = $user_id;
		            $inserted_data = $this->HomeModel->insert_study_like($save_study_like);
		            $get_count_of_likes = $this->HomeModel->get_count_likes_through_study_id($study_id);

		            $response['action'] = 'like';
		            if($inserted_data)
		            {
	                    $response['status'] = 'success';
		                $response['message'] = lang('like');
	        			$response['like_count'] = $get_count_of_likes;;
		            }
		            else
		            {
		               $response['message'] = lang('error_durning_like');
		            }
			    }
			}
	        else
	        {
		        $response['message'] = lang('please_login_first');
	        }
	    }
        echo json_encode($response);
        exit;
    }



    function like_study_delete()
    {
        $response = [];
        if($this->session->userdata('logged_in')) 
        {
            $study_id = $_POST['study_id'];
            $user_id = isset($this->user['id']) ? $this->user['id'] : 0;
            
            $delete_data = $this->HomeModel->delete_like_study_through_studyid($study_id, $user_id);
            $get_count_of_likes = $this->HomeModel->get_count_likes_through_study_id($_POST['study_id']);
            
            if($delete_data)
            {
                $response['success'] = $get_count_of_likes;
            }
            else
            {
                $response['error'] = 'unsuccessfull';
            }
        }
        else
        {
            $response['status'] = 'redirect';
        }
        echo json_encode($response);
    }

    function submit_rating($rel_type = false)
    {
         $save = $this->ratting->save_ratting($rel_type);
         if($save == true)
         {
            $this->session->set_flashdata('message', lang('ratting_added_successfully'));
            redirect($_SERVER['HTTP_REFERER']); 
         }
         else
         {
            $this->session->set_flashdata('error', lang('eroor_during_ratting_added')); 
            redirect($_SERVER['HTTP_REFERER']); 
         }
    }

    function review_like_insert()
    {

        $response = $this->ratting->insert_review_like();

        echo json_encode($response);
    }

    function review_delete()
    {
       $response = $this->ratting->dislike_review_like();

       echo json_encode($response);   
    }
    
}