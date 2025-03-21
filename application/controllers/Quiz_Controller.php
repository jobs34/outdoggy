<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Quiz_Controller extends Public_Controller {

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('HomeModel');
        $this->load->model('PaymentModel');
        $this->load->model('TestModel');
        $this->load->model('MembershipModel');
        $this->add_css_theme('quiz_box.css');
        $this->add_css_theme('set2.css');
        $this->load->library('Ratting');
        $this->add_js_theme('perfect-scrollbar.min.js');
        $this->add_css_theme('table-main.css');
        $this->add_css_theme('perfect-scrollbar.css');
    }

    public function set_leader_bord_user_name()
    {
        $response['status'] = 'error';
        $response['msg'] = 'Invalid Response';
        if($this->input->post('inputValue'))
        {
            $response['status'] = 'success';
            $response['name'] = $this->input->post('inputValue');
            $response['msg'] = 'Thanks ! '.$this->input->post('inputValue');
            $this->session->set_userdata('leader_bord_user_name', $this->input->post('inputValue'));
        }
        echo json_encode($response);
    }

    function instruction($purchases_type,$quiz_id)
    {

        $quiz_data = $this->TestModel->get_quiz_by_id($quiz_id);

        if(empty($quiz_data))
        {
           $this->session->set_flashdata('error', lang('Invalid Uri Arguments'));
           redirect(base_url());
        }


        if(isset($this->session->quiz_session) && $this->session->quiz_session)
        {
            $session_quiz_id = $this->session->quiz_session['quiz_data']['id'];
            return redirect(base_url("test/$session_quiz_id/1"));
        }



        if($quiz_data->is_sheduled_test == 1)
        {
            $start_date_time_code = $quiz_data->start_date_time;
            $end_date_time_code = $quiz_data->end_date_time;

            if($end_date_time_code < strtotime(date("Y-m-d H:i:s")))
            {
                $this->session->set_flashdata('error', lang('Sorry This Quiz Has Been Expired  ..!'));
                return redirect(base_url("quiz-detail/quiz/$quiz_id"));
            }

            if($start_date_time_code > strtotime(date("Y-m-d H:i:s")))
            {
                $this->session->set_flashdata('error', lang('This Quiz Start From '.date("Y-m-d H:i",$start_date_time_code)));
                return redirect(base_url("quiz-detail/quiz/$quiz_id"));
            }
        }



        $user_id = (isset($this->user['id']) && $this->user['id']) ? $this->user['id'] : 0;
        $user_is_prime = $this->TestModel->user_is_prime($user_id);
        $user_membership_payment_user_id = (isset($user_is_prime->user_id) && $user_is_prime->user_id) ? $user_is_prime->user_id : NULL;

        $check_quiz_multiple_attemp_by_category = $this->TestModel->check_quiz_multiple_attemp_by_category($quiz_data->category_id,$user_id);

        $login_user_id = isset($this->user['id']) ? $this->user['id'] : NULL;
        $loged_in_user_data = $this->db->where('id',$user_id)->get('users')->row();
        $is_admin = (isset($loged_in_user_data->is_admin) && $loged_in_user_data->is_admin == 1 ) ? TRUE : FALSE;

        if($is_admin == FALSE && $login_user_id != $quiz_data->user_id)
        {
            foreach($check_quiz_multiple_attemp_by_category as $multiple_attemp_array)
            {

                if($multiple_attemp_array->id == $quiz_id && $multiple_attemp_array->attempt > 0)
                {
                    // $is_passed = $this->TestModel->is_quiz_already_given_or_pass($quiz_id, $user_id);
                    $quiz_passing_count = $this->TestModel->number_of_time_quiz_pass_by_user($quiz_id, $user_id);
                    if($quiz_passing_count >= $multiple_attemp_array->attempt)
                    {
                        $this->session->set_flashdata('error', lang('Sorry You Already Pass This Quiz So Multiple Attemp Is Not Allowed ..!'));
                        return redirect(base_url("quiz-detail/quiz/$quiz_id"));
                    }
                }
            }

            if($quiz_data->difficulty_level > 1)
            {

                $quiz_child_difficulty_level = $this->TestModel->get_quiz_with_child_difficulty_level($quiz_data->category_id,$quiz_data->difficulty_level,$user_id);

                foreach ($quiz_child_difficulty_level as $child_difficulty_level)
                {
                    $correct = $child_difficulty_level->correct > 0 ? $child_difficulty_level->correct : 0;
                    $test_has_questions = $child_difficulty_level->test_has_questions > 0 ? $child_difficulty_level->test_has_questions : 1;
                    $user_test_percentage =  ($correct/$test_has_questions)*100;
                    if($child_difficulty_level->quiz_passing_percentage > $user_test_percentage OR empty($child_difficulty_level->correct))
                    {
                        $this->session->set_flashdata('error', lang('category_related_quiz_clear'));
                        return redirect($_SERVER['HTTP_REFERER']);
                    }
                }

                $get_quiz_difficulty_result = $this->TestModel->get_quiz_with_difficulty_level_result($quiz_data->id,$user_id);
                foreach ($get_quiz_difficulty_result as $difficulty_result_array)
                {

                    if( empty($user_is_prime) && $difficulty_result_array->difficulty_level == 3 && $difficulty_result_array->id == $quiz_id)
                    {
                        $this->session->set_flashdata('error', lang('Sorry You Are Not Premiu Member..!'));
                        return redirect($_SERVER['HTTP_REFERER']);
                    }

                    $correct = $difficulty_result_array->correct > 0 ? $difficulty_result_array->correct : 0;
                    $test_has_questions = $difficulty_result_array->test_has_questions > 0 ? $difficulty_result_array->test_has_questions : 1;

                    $user_test_percentage =  ($correct/$test_has_questions)*100;
                }
            }
        }

        //check quiz is premium start
        if($quiz_data->is_premium == 1 && $login_user_id != $quiz_data->user_id)
        {

            $get_logged_in_user_membership = $this->TestModel->get_user_membership($user_id);
            if($get_logged_in_user_membership)
            {
                $membership_session = $this->session->userdata('membership');
                $this->session->unset_userdata('membership');
                $membership_session['validity'] = $get_logged_in_user_membership->validity;
                $this->session->set_userdata(array('membership'=>$membership_session));

                if($this->session->userdata('membership') && $this->session->userdata('membership')['validity'] < date('Y-m-d'))
                {
                    $this->session->set_flashdata('error', lang('renew_your_membership'));
                    return redirect(base_url("quiz-detail/quiz/$quiz_id"));
                }
            }
            else
            {
                $this->session->set_flashdata('error', lang('please_take_membership'));
                return redirect(base_url("quiz-detail/quiz/$quiz_id"));
            }
        }



        $test_taken = $this->TestModel->get_test_taken($quiz_id,$login_user_id);

        if($quiz_data->is_registered == 1 && empty($login_user_id))
        {
            $this->session->set_flashdata('error', 'Plz Login First');
            return redirect(base_url("quiz-detail/quiz/$quiz_id"));
        }

        if($quiz_data->is_registered == 1 && $quiz_data->attempt > 0 && ($quiz_data->attempt == $test_taken['count']) && $login_user_id != $quiz_data->user_id)
        {
            $this->session->set_flashdata('error', lang('test_already_given'));
            return redirect(base_url("quiz-detail/quiz/$quiz_id"));
        }

        $leader_bord_user_name = $this->session->leader_bord_user_name;

        if(empty($leader_bord_user_name) && empty($login_user_id))
        {
           $this->session->set_flashdata('error', lang('user_required'));
           return redirect(base_url("quiz-detail/quiz/$quiz_id"));
        }

        if($quiz_data->price > 0 && $login_user_id != $quiz_data->user_id)
        {
            $quiz_last_paymetn_status = $this->Payment_model->get_quiz_last_paymetn_status($purchases_type,$quiz_id);


            if(empty($quiz_last_paymetn_status) && empty($quiz_last_paypal_status) )
            {
                $this->session->set_flashdata('error', lang('You Need To Buy This Quiz  Before Start Quiz ...'));
                //return redirect(base_url("quiz-pay/payment-mode/$purchases_type/$quiz_id"));
                return redirect(base_url("quiz-detail/quiz/$quiz_id"));
            }
        }

        if(empty($quiz_data->quiz_instruction))
        {
            return redirect(base_url("start-test/").$quiz_data->id);
        }

        $this->set_title(lang('front_quiz_instruction'), $this->settings->site_name);
        $content_data = array('Page_message' => lang('front_quiz_instruction'), 'page_title' => lang('front_quiz_instruction'),'quiz_id' => $quiz_id,'quiz_data' => $quiz_data);

        $data = $this->includes;
        $data['content'] = $this->load->view('instruction', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

    
     function category($id=NULL, $page_no=NULL)
    {
        $user_id = isset($this->user['id']) ? $this->user['id'] : 0;
        $quiz_filter = $this->input->get('most') ? $this->input->get('most') : '';
        $session_quiz_data = array();
        $session_quiz_question_data = array();

        if($this->session->quiz_session)
        {
            $get_quiz_session = $this->session->quiz_session;
            $session_quiz_data = $get_quiz_session['quiz_data'];
            $session_quiz_question_data = $get_quiz_session['quiz_question_data'];
        }

        //$category_slug = urldecode($category_slug);
        $category_id = $id;
        $category_data = $this->HomeModel->get_category_by_id($category_id);
        if(empty($category_data))
        {
            return redirect(base_url("404_override"));
        }

        $this->add_css_theme('sweetalert.css');
        $this->add_js_theme('sweetalert-dev.js');
        $this->add_js_theme('quiz.js');


        $quiz_data_array = $this->HomeModel->get_quiz_by_category($category_data->id);

        $count_quiz = count($quiz_data_array);
        $this->load->library('pagination');

        $config['base_url'] = base_url('category/') . $category_id;
        $config['total_rows'] = $count_quiz;
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

        $filter_by = 'difficulty_level';
        if($quiz_filter=='recent')
        {
            $filter_by = 'added';
        }
        elseif($quiz_filter=='liked')
        {
            $filter_by = 'total_like';
        }
        elseif($quiz_filter=='attended')
        {
            $filter_by ='total_view';
        }

        $is_premium_member = FALSE;
        $get_logged_in_user_membership = $this->MembershipModel->get_user_membership($user_id);
        if($get_logged_in_user_membership)
        {
            $is_premium_member = ($get_logged_in_user_membership->validity && $get_logged_in_user_membership->validity >= date('Y-m-d')) ? TRUE : FALSE;
        }

        $paid_quizes_array = $this->Payment_model->get_user_paid_quiz_obj($user_id);
        $quiz_data = $this->HomeModel->get_category_quiz_per_page($category_data->id, $pro_per_page, $page, $filter_by);
       // $sub_category_data = $this->HomeModel->get_sub_category_data($category_data->id);
        $category_study_material_data = $this->HomeModel->get_category_study_material($category_data->id);
        //$paid_s_m_array = $this->PaymentModel->get_user_paid_study_material_obj($user_id);
        $rel_post_data = $this->HomeModel->get_category_rel_post($category_data->id);

        $this->set_title($category_data->category_title);

        $content_data = array('Page_message' =>  $category_data->category_title, 'page_title' => $category_data->category_title , 'category_data' => $category_data, 'quiz_data' => $quiz_data,'session_quiz_data' => $session_quiz_data, 'session_quiz_question_data' => $session_quiz_question_data, 'pagination' => $page_links,'sub_category_data'=>$sub_category_data, 'category_study_material_data' => $category_study_material_data,'rel_post_data' => $rel_post_data, 'is_premium_member' => $is_premium_member,'paid_quizes_array'=>$paid_quizes_array,'paid_s_m_array'=>$paid_s_m_array);

        $data = $this->includes;
        $data['content'] = $this->load->view('quiz', $content_data, TRUE);
        $this->load->view($this->template, $data);

        }
    
    function difficulty_level($category_slug=NULL)
    {

        $session_quiz_data = array();
        $session_quiz_question_data = array();

        if($this->session->quiz_session)
        {
            $get_quiz_session = $this->session->quiz_session;
            $session_quiz_data = $get_quiz_session['quiz_data'];
            $session_quiz_question_data = $get_quiz_session['quiz_question_data'];
        }
        $category_data = $this->HomeModel->get_category_by_slug($category_slug);
        if(empty($category_data))
        {
            $response['status'] = 'error';
            $response['message'] = "Invalid Category Slug";
            $response['html'] = FALSE;
            echo json_encode($response);
            return json_encode($response);
            exit;
        }

        $filter_by = 'difficulty_level';
        $pro_per_page = 3;
        $page = 1;
        $quiz_data = $this->HomeModel->get_category_quiz_per_page($category_data->id, $pro_per_page, $page, $filter_by);

        $sub_category_data = $this->HomeModel->get_sub_category_data($category_data->id);

        $category_study_material_data = array();


        $this->set_title($category_data->category_title);

        $content_data = array('Page_message' =>  $category_data->category_title, 'page_title' => $category_data->category_title , 'category_data' => $category_data, 'quiz_data' => $quiz_data,'session_quiz_data' => $session_quiz_data, 'session_quiz_question_data' => $session_quiz_question_data,'sub_category_data'=>$sub_category_data, 'category_study_material_data' => $category_study_material_data,);


        $view = $this->load->view('quiz_modal_view', $content_data, TRUE);

        $response['status'] = 'success';
        $response['message'] = "success";
        $response['title'] = $category_data->category_title;
        $response['action'] = base_url('category/').$category_data->category_slug;
        $response['html'] = $view;
        echo json_encode($response);
        return json_encode($response);
        exit;
    }

    function like_quiz()
    {

        $response['status'] = 'error';
        $response['action'] = '';
        $response['message'] = lang('something_went_wrong');
        $response['like_count'] = 0;


        $user_id = (isset($this->session->userdata('logged_in')['id']) && $this->session->userdata('logged_in')['id']) ? $this->session->userdata('logged_in')['id'] : 0;
        $user_id = $user_id ? $user_id : 0;
        $quiz_id = (isset($_POST['quiz_id']) && $_POST['quiz_id']) ? $_POST['quiz_id'] : 0;
        if($quiz_id)
        {
            if($user_id)
            {
                $quiz_like_data = $this->db->where('quiz_id',$quiz_id)->where('user_id',$user_id)->get('quiz_like')->row();

                if($quiz_like_data)
                {
                    $delete_data = $this->HomeModel->delete_like_quiz_through_quizid($quiz_id, $user_id);
                    $get_count_of_likes = $this->HomeModel->get_count_likes_through_quiz_id($quiz_id);

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
                    $save_quiz_like['quiz_id'] = $quiz_id;
                    $save_quiz_like['user_id'] = $user_id;

                    $inserted_data = $this->HomeModel->insert_quiz_like($save_quiz_like);
                    $get_count_of_likes = $this->HomeModel->get_count_likes_through_quiz_id($quiz_id);

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

    function like_quizx()
    {

        $response = [];
        if($this->session->userdata('logged_in'))
        {
            $save_quiz_like['quiz_id'] = $_POST['quiz_id'];
            $save_quiz_like['user_id'] = $this->session->userdata('logged_in')['id'];
            $inserted_data = $this->HomeModel->insert_quiz_like($save_quiz_like);
            $get_count_of_likes = $this->HomeModel->get_count_likes_through_quiz_id($_POST['quiz_id']);

            if($inserted_data)
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



    function like_quiz_delete()
    {
        $response = [];
        if($this->session->userdata('logged_in'))
        {
            $quiz_id = $_POST['quiz_id'];
            $user_id = isset($this->user['id']) ? $this->user['id'] : 0;

            $delete_data = $this->HomeModel->delete_like_quiz_through_quizid($quiz_id, $user_id);
            $get_count_of_likes = $this->HomeModel->get_count_likes_through_quiz_id($_POST['quiz_id']);

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

    function quiz_detail($rel_type = false,$quiz_id = false)
    {
        $quiz_data = $this->HomeModel->get_quiz_by_id($quiz_id);

        if(empty($quiz_data))
        {
            $this->session->set_flashdata('error', lang('Invalid Uri Arguments...!'));
            return redirect(base_url());
        }
        $user_id = isset($this->user['id']) ? $this->user['id'] : 0;

        $user_quiz_data = $this->db->where('id',$quiz_data->user_id)->get('users')->row();
        $paid_quizes_array = $this->Payment_model->get_user_paid_quiz_obj($user_id);

        $is_premium_member = FALSE;
        $get_logged_in_user_membership = $this->MembershipModel->get_user_membership($user_id);
        if($get_logged_in_user_membership)
        {
            $is_premium_member = ($get_logged_in_user_membership->validity && $get_logged_in_user_membership->validity >= date('Y-m-d')) ? TRUE : FALSE;
        }

        $session_quiz_data = array();
        $session_quiz_question_data = array();

        $session_quiz_id = 0;

        if($this->session->quiz_session)
        {
            $get_quiz_session = $this->session->quiz_session;
            $session_quiz_data = $get_quiz_session['quiz_data'];
            $session_quiz_question_data = $get_quiz_session['quiz_question_data'];
            $session_quiz_id = $this->session->quiz_session['quiz_data']['id'];

        }

        $comments_exist_quizid_userid = $this->HomeModel->get_comment_through_quizid_userid_reltype($rel_type,$quiz_id,$user_id);

        $quiz_comments = $this->HomeModel->get_quiz_comment($quiz_id,$rel_type);

        $total_comments = count($quiz_comments);

        $average = 0;
        if($quiz_data->total_rating > 0 && $quiz_data->rating > 0)
        {
            $average = $quiz_data->total_rating / $quiz_data->rating;
        }

        $average_rating = ($average > 0) ? $average : 5 ;
        $average_rating =  number_format((float)$average_rating, 1, '.', '');

    //    $leader_board_quiz_history = $this->TestModel->leader_board_quiz_history($quiz_id, $session_quiz_id);

    //    $site_phone_number = $this->settings->site_phone_number;

        $meta_data = array('meta_title' => $quiz_data->meta_title, 'meta_keyword' => $quiz_data->meta_keywords, 'meta_description' =>  $quiz_data->meta_description, 'title' => $quiz_data->title, 'description' => $quiz_data->description,'image' => $quiz_data->featured_image);


        $this->set_title(lang('front_quiz_detail'));

        $this->add_js_theme('quiz_detail.js');
        $content_data = array('page_title' => lang('front_quiz_detail'),'quiz_id' => $quiz_id, 'quiz_data' => $quiz_data, 'comments_exist_quizid_userid' => $comments_exist_quizid_userid,'quiz_comments' => $quiz_comments,'average'=>$average,'session_quiz_data'=>$session_quiz_data,'session_quiz_question_data'=>$session_quiz_question_data,'rel_type'=>$rel_type,'user_quiz_data' => $user_quiz_data,'average_rating' => $average_rating,'paid_quizes_array' => $paid_quizes_array,'is_premium_member' => $is_premium_member);

        $data = $this->includes;
        $data['content'] = $this->load->view('quiz_detail', $content_data, TRUE);
        $data['meta_data'] = $meta_data;
        $this->load->view($this->template, $data);
    }

    function quiz_detail_by_slug($quiz_slug = false)
    {
        $rel_type = "quiz";
        if(empty($quiz_slug))
        {
            $this->session->set_flashdata('error', lang('Invalid Uri Arguments...!'));
            return redirect(base_url());
        }
        if(is_numeric($quiz_slug))
        {
            $quiz_id = $quiz_slug;
        }
        else
        {
            $slug_parts = explode("-", $quiz_slug);
            $quiz_id = end($slug_parts);
        }

        $quiz_data = $this->HomeModel->get_quiz_by_id($quiz_id);

        if(empty($quiz_data))
        {
            $this->session->set_flashdata('error', lang('Invalid Uri Arguments...!'));
            return redirect(base_url());
        }
        $user_id = isset($this->user['id']) ? $this->user['id'] : 0;

        $user_quiz_data = $this->db->where('id',$quiz_data->user_id)->get('users')->row();
        $paid_quizes_array = $this->Payment_model->get_user_paid_quiz_obj($user_id);

        $is_premium_member = FALSE;
        $get_logged_in_user_membership = $this->MembershipModel->get_user_membership($user_id);
        if($get_logged_in_user_membership)
        {
            $is_premium_member = ($get_logged_in_user_membership->validity && $get_logged_in_user_membership->validity >= date('Y-m-d')) ? TRUE : FALSE;
        }

        $session_quiz_data = array();
        $session_quiz_question_data = array();
        $session_quiz_id = 0;

        if($this->session->quiz_session)
        {
            $get_quiz_session = $this->session->quiz_session;
            $session_quiz_data = $get_quiz_session['quiz_data'];
            $session_quiz_question_data = $get_quiz_session['quiz_question_data'];
            $session_quiz_id = $this->session->quiz_session['quiz_data']['id'];
        }
        /*
        $comments_exist_quizid_userid = $this->HomeModel->get_comment_through_quizid_userid_reltype($rel_type,$quiz_id,$user_id);

        $quiz_comments = $this->HomeModel->get_quiz_comment($quiz_id,$rel_type);

        $total_comments = count($quiz_comments);

        $average = 0;
        if($quiz_data->total_rating > 0 && $quiz_data->rating > 0)
        {
            $average = $quiz_data->total_rating / $quiz_data->rating;
        }

        $average_rating = ($average > 0) ? $average : 5 ;
        $average_rating =  number_format((float)$average_rating, 1, '.', '');
        */
        // 연관 기출문제 불러오기
        $rel_quiz_data_array = $this->HomeModel->get_rel_quiz_by_category($quiz_data->category_id,$quiz_id);
        // 연관 강의 불러오기
        $rel_material_data_array = $this->HomeModel->get_category_study_material($quiz_data->category_id);

        $meta_data = array('meta_title' => $quiz_data->meta_title, 'meta_keyword' => $quiz_data->meta_keywords, 'meta_description' =>  $quiz_data->meta_description, 'title' => $quiz_data->title,'description' => $quiz_data->description,'image' => $quiz_data->featured_image,);


        $this->set_title(lang('front_quiz_detail'));

        $this->add_js_theme('quiz_detail.js');
        $content_data = array('page_title' => lang('front_quiz_detail'),'quiz_id' => $quiz_id, 'quiz_data' => $quiz_data, 'session_quiz_data'=>$session_quiz_data,'session_quiz_question_data'=>$session_quiz_question_data,'rel_type'=>$rel_type,'user_quiz_data' => $user_quiz_data,'paid_quizes_array' => $paid_quizes_array,'is_premium_member' => $is_premium_member, 'rel_quiz_data_array' => $rel_quiz_data_array, 'rel_material_data_array' => $rel_material_data_array);

        $data = $this->includes;
        $data['content'] = $this->load->view('quiz_detail', $content_data, TRUE);
        $data['meta_data'] = $meta_data;
        $this->load->view($this->template, $data);
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


    function all_category()
    {
        $category_vip_data = $this->HomeModel->get_vip_category();
        $category_data = $this->HomeModel->get_all_categories();

        $content_data = array('Page_message' => lang('all_categories'), 'page_title' => lang('all_categories'),'category_vip_data' => $category_vip_data,'category_data' => $category_data,'user_id' => $user_id);

        $data = $this->includes;

        $data['content'] = $this->load->view('categories', $content_data, TRUE);

        $this->load->view($this->template, $data);

    }


}
