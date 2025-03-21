<?php
    $quiz_id = $quiz_data->id;
    $category_id = $quiz_data->category_id;
    $category_main_url = base_url("all-categories/");
    $category_det_url = base_url("category/").$category_id;
    $category_img_dir = base_url("assets/images/category_image/");
    $category_image = $quiz_data->category_image ? $quiz_data->category_image : "default.jpg";
    $category_image_name = $category_image ; 
    $category_image = $category_img_dir.$category_image;
    //결제 임시 테스트
    $action_url = base_url("apply/payment-mode/quiz/$quiz_id");

    if(!is_file(FCPATH."assets/images/category_image/".$category_image_name))
    {
      $category_image = base_url('assets/default/default.jpg');
    }

    $user_id = isset($this->user['id']) ? $this->user['id'] : NULL;

    $like_or_not_i = (isset($quiz_data->like_id) && !empty($quiz_data->like_id) ? 'text-primary' : 'text-medium-gray');
    $like_or_not = (isset($quiz_data->like_id) && !empty($quiz_data->like_id) ? 'text-primary' : 'text-medium-gray');
    $like_or_not_word = (isset($quiz_data->like_id) && !empty($quiz_data->like_id) ? '북마크 됨' : '북마크');

    $price = ($quiz_data->price > 1) ? $this->settings->paid_currency." " .$quiz_data->price : (($quiz_data->is_premium == 1) ? " ".lang('premium') : ' '.lang('free'));
    $start_quiz_link = $quiz_data->price > 1 ? '원'.$quiz_data->price : ' '.lang('free');
    $is_quiz_amout_payed = (isset($paid_quizes_array[$quiz_id]) && $paid_quizes_array[$quiz_id]) ? TRUE : FALSE;
    $current_url = current_url();
    $play_url = base_url("play/$quiz_id");

    $category_quiz_data = $rel_quiz_data_array;
    $category_study_material_data = $rel_material_data_array;

    if($quiz_data->is_sheduled_test == 1)
    {
        $start_date_time_code = $quiz_data->start_date_time;
        $end_date_time_code = $quiz_data->end_date_time;

        if($end_date_time_code < strtotime(date("Y-m-d H:i:s")))
        {
            //continue;
        }
    }

    $quiz_running = lang('quiz_running');
    $session_quiz_id = NULL;
    $quiz_running_btn = NULL;

    if($session_quiz_data && $session_quiz_question_data)
    {
        $quiz_running = 'quiz_running';
        $session_quiz_id = $session_quiz_data['id'];
        echo "<input type='hidden' value='".$session_quiz_id."' class='session_quiz_id'>";
    }

    if($session_quiz_id && $session_quiz_id == $quiz_id)
    {
        $quiz_running_btn = $quiz_running;
        $quiz_url = base_url("test/$session_quiz_id/1");
        $quiz_btn_name = lang('resume_test');
        $quiz_action_icon = '<i class="fab fa-rev"></i>';
    }
    else
    {
        if(empty($user_id))
        {
            if($quiz_data->price > 0 OR $quiz_data->is_premium == 1 OR $quiz_data->is_registered == 1)
            {
                $quiz_running_btn = "";
                $quiz_url = base_url("login");
                //$quiz_btn_name = lang('login_please');
                $quiz_btn_name = "모의 시험";
                $quiz_action_icon = '<i class="fas fa-user"></i>';
            }
            else
            {
                $quiz_running_btn = "no_quiz_start";
                $quiz_url = base_url("instruction/quiz/$quiz_id");
                //$quiz_btn_name = lang("start_now");
                $quiz_btn_name = "모의 시험";
                $quiz_action_icon = '<i class="far fa-play-circle"></i>';
            }
        }
        else
        {
            $quiz_running_btn = "";
            if($quiz_data->price > 0 && $is_quiz_amout_payed == FALSE)
            {
                $quiz_url = base_url("quiz-pay/payment-mode/quiz/$quiz_id");
                $quiz_btn_name = lang('pay_now');
                $quiz_action_icon = '<i class="fas fa-money-bill"></i>';
                $quiz_lock_icons = '<i class="fas fa-lock "></i>';
                $quiz_action_btn_class = 'btn-info';
            }
            else if($quiz_data->is_premium == 1 && $is_premium_member == FALSE)
            {
                $quiz_url = base_url("membership");
                $quiz_btn_name = lang('get_membership');
                $quiz_action_icon = '<i class="fas fa-user-shield"></i>';
            }
            else
            {
                $quiz_url = base_url("instruction/quiz/$quiz_id");
                //$quiz_btn_name = lang("start_quiz");
                $quiz_btn_name = "모의 시험";
                $quiz_action_icon = '<i class="far fa-play-circle"></i>';
            }

        }
    }

?>
<div class="mt-0 pt-6 pb-8 bg-light-gray min-h-100vh">
    <div class="container">
        <!-- Content -->
        <div class="row">
            <div class="col-xl-8 col-lg-12 col-md-12 col-12 mb-4 mb-xl-0">
                <!-- Card -->
                <div class="card mb-5">
                    <!-- Card body -->
                    <div class="card-body p-3 p-lg-4">
                        <div class="d-flex justify-content-between">
                            <div class="mt-1 mb-2 text-medium-gray font-size-sm lead">
                                <a href="<?php echo $category_main_url; ?>" class="text-dark-gray">자격증</a> &gt; <a href="<?php echo $category_det_url; ?>" class="text-dark-gray"><?php echo $quiz_data->category_title; ?></a> &gt; 기출 문제
                            </div>
                            <div class="mt-1 mb-2">
                                <a href="javascript:void(0)" class="btn btn-outline-light-secondary btn-xs bookmark text-decoration-none like_unlike_quiz" data-quiz_id="<?php echo $quiz_id;?>" data-toggle="tooltip" title="" data-original-title="북마크 추가"><i class="fav_icon fe fe-bookmark a like_quiz_view_i_<?php echo $quiz_id;?> <?php echo ($like_or_not_i);?>" ></i>&nbsp; <span class="value like_quiz_view_span_<?php echo $quiz_id;?> <?php echo $like_or_not ;?>"><?php echo $like_or_not_word ;?></span></a>
                            </div>
                        </div>
                        <div class="align-items-center mt-2 mb-3 pl-0 pl-lg-2">
                            <p class="text-dark display-6 font-weight-semi-bold lead"><?php echo $quiz_data->title; ?></p>
                        </div>
                        <div class="mb-6 pl-1 pl-lg-3">
                            <ul class="list-unstyled">
                                <li class="mb-1"><i class="far fa-question-circle text-primary mr-2 lh-lg"></i>문제의 갯수 : 총 <?php echo xss_clean($quiz_data->number_questions); ?> 문항
                                </li>
                                <li class="mb-1"><i class="far fa-clock text-primary mr-2 lh-lg"></i>시간 제한 : <?php echo xss_clean($quiz_data->duration_min); ?> 분 (모의 시험)</li>
                                <li class="mb-1">
                                <a href="<?php echo $action_url; ?>" id="study_data_contant_btn" class="btn btn-dark-pink btn-block">임시결제</a>
                                </li>
                            </ul>
                        </div>
                        <div class="mb-3 pl-0 pl-lg-2">
                            <a href="<?php echo $play_url; ?>"class="btn btn-primary mr-1 font-weight-bold">한 문제 씩 바로 풀기</a> <a href="<?php echo $quiz_url; ?>" class="btn btn-outline-light-secondary text-medium-gray <?php echo $quiz_running_btn; ?>"><?php echo $quiz_btn_name; ?> </a>
                        </div>
                    </div>
                </div>
                <!-- Card -->
                <div class="card rounded-lg">
                    <!-- Card body -->
                    <div class="card-body p-3 p-lg-5">
                            <!-- 디스크립션 -->
                            <div class="p-2 p-lg-4 mb-4">
                                <p class="font-size-md"><?php echo $quiz_data->description; ?></p>
                            </div>
                            <!-- 테스트 기본 매뉴얼-->
                            <div class="card-footer text-dark-gray p-3 p-lg-5">
                                <div class="mt-2">
                                    <h5 class="font-weight-bold">바로 풀기</h5>
                                    <p class="font-size-md">답안과 해설을 그 자리에서 바로 확인할 수 있습니다. </br>공부를 시작하시는 단계라면 지난 기출 문제를 시간 제한 없이 고심하고 풀고 정답과 해설을 꼼꼼이 살펴보는 것이 좋습니다.</p>
                                    <!-- 테스트 시작 버튼-->
                                    <a href="<?php echo $play_url; ?>"class="btn btn-outline-primary btn-sm">한 문제 씩 바로 풀기</a>
                                </div>
                                <div class="mt-6 mb-2">
                                    <h5 class="font-weight-bold">모의 시험</h5>
                                    <p class="font-size-md">제한된 시간 내에 전체 문제를 풀고 답안을 제출하면 자동으로 채점이 됩니다.</br>어느 정도 기본적인 이론 공부가 된 단계라면 실제 시험과 비슷한 환경에서 실력을 점검하기에 좋습니다.</p>
                                    <!-- 테스트 시작 버튼-->
                                    <a href="<?php echo $quiz_url; ?>" class="btn btn-sm btn-outline-secondary <?php echo $quiz_running_btn; ?>"><?php echo $quiz_btn_name; ?> </a>
                                </div>                              
                            </div>

                    </div>
                </div>
            </div>
            <!--///////////////////// SideBar .S////////////////////////-->
            <div class="col-lg-4 col-md-12 col-12">
            <!--===== 사이드바 표시 영역========-->
                <!-- Card -->
                <div class="card mb-4">
                    <div>
                        <!-- card body -->
                        <div class="card-body px-3 px-lg-5 py-4">
                            <div class="d-flex align-items-center">
                                <div class="col-10 px-0">
                                    <a href="<?php echo $category_det_url; ?>" class="font-size-xs"><p class="text-medium-gray mb-0">현재 자격증</p><h5 class="text-dark-gray"><?php echo $quiz_data->category_title; ?></h5></a>
                                </div>
                                <div class="col-2 px-0">
                                    <img src="<?php echo xss_clean($category_image); ?>" class="bg-gradient-peacock-blue-crome-yellow icon-shape icon-lg rounded-circle"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                if($category_quiz_data)
                    { ?>                
                        <!-- Card -->
                        <div class="card mb-4">
                            <div>
                                <!-- Card header -->
                                <div class="card-header px-3 px-lg-5 pt-3 pb-2">
                                    <p class="lead mb-0 font-size-md font-weight-bold">다른 기출문제 </p>
                                </div>   
                                <!-- card body -->
                                <div class="card-body px-3 px-lg-5 py-4">
                                    <div class="mt-1 mb-1">
                                        <?php
                                        $data['quiz_list_data'] = $category_quiz_data;
                                        $this->load->view('common_quiz_list_side',$data);   
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php 
                    } ?> 
                <?php
                if($category_study_material_data)
                    { ?>                
                        <!-- Card -->
                        <div class="card mb-4">
                            <div>
                                <!-- Card header -->
                                <div class="card-header px-3 px-lg-5 pt-3 pb-2">
                                    <p class="lead mb-0 font-size-md font-weight-bold">관련 강의</p>
                                </div>   
                                <!-- card body -->
                                <div class="card-body px-3 px-lg-5 py-5">
                                    <div class="mt-1 mb-1">
                                        <?php
                                        $data['study_material_list_data'] = $category_study_material_data;
                                        $this->load->view('common_material_list_side',$data);   
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php 
                    } ?> 


                    <?php
                        if($user_id && isset($this->user['role']) && ($this->user['role'] == 'admin' OR $this->user['role'] == 'subadmin'))
                        {
                            ?>
                            <!-- Card -->
                            <div class="card mb-4">
                                <!-- Card body -->
                                <div class="card-body">
                                    <a href="<?php echo base_url('admin/quiz/update/').$quiz_id; ?>" class="btn btn-outline-primary btn-block"><?php echo lang('manage_quiz'); ?> </a>
                                </div>
                            </div>
                            <?php
                        }
                        if($user_id && $user_id == $quiz_data->user_id && isset($this->user['role']) && $this->user['role'] == 'tutor')
                        {
                            ?>
                            <!-- Card -->
                            <div class="card mb-4">
                                <!-- Card body -->
                                <div class="card-body">
                                    <a href="<?php echo base_url('tutor/quiz/update/').$quiz_id; ?>" class="btn btn-outline-primary btn-block"><?php echo lang('manage_quiz'); ?> </a>
                                </div>
                            </div>
                            <?php
                        }
                        ?>    
                <!--===== 사이드바 표시 영역========-->
                </div>
            <!--///////////////////// SideBar .E////////////////////////-->
        </div>
    </div>
</div>