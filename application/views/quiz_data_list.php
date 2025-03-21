<?php
$quiz_running = 'no_quiz_start';
$session_quiz_id = NULL;
$quiz_running_btn = NULL;
$user_id = isset($this->user['id']) ? $this->user['id'] : NULL; 

if($session_quiz_data && $session_quiz_question_data) 
{ 
    $quiz_running = 'quiz_running';
    $session_quiz_id = $session_quiz_data['id'];
    echo "<input type='hidden' value='".$session_quiz_id."' class='session_quiz_id'>";        
}
if($quiz_list_data)  
{ 
?>
<div class="col-12 px-2 pt-2 pb-4">
    <?php
    foreach ($quiz_list_data as  $quiz_array) 
    {
        if($quiz_array->is_sheduled_test == 1) 
        {
            $start_date_time_code = $quiz_array->start_date_time;
            $end_date_time_code = $quiz_array->end_date_time;
            if($end_date_time_code < strtotime(date("Y-m-d H:i:s")))
            {
                //continue;
            }
        }
        $price = $quiz_array->price > 1 ? '₹ '.$quiz_array->price : ' '.lang('free');
        $start_quiz_link = $quiz_array->price > 1 ? get_admin_setting('paid_currency') ." ".$quiz_array->price : ' '.lang('free');
        $quiz_id = $quiz_array->id;
        $is_quiz_amout_payed = (isset($paid_quizes_array[$quiz_id]) && $paid_quizes_array[$quiz_id]) ? TRUE : FALSE;
        $ribbon_label = ($quiz_array->price > 0  OR $quiz_array->is_premium == 1 ) ? 'paid' : lang('free');
        $quiz_price_ribbon = ($quiz_array->price > 0) ? get_admin_setting('paid_currency') ." " .$quiz_array->price : ($quiz_array->is_premium == 1 ? "Premium" : lang('free'));

        $login_user_id = isset($this->user['id']) ? $this->user['id'] : NULL;
        
        if($login_user_id == $quiz_array->user_id)
        {
            $is_quiz_amout_payed =  true;
            $is_premium_member =true;
        }
        if($session_quiz_id && $session_quiz_id == $quiz_id)
        {
            $quiz_running_btn = $quiz_running;
            $quiz_url = base_url("test/$session_quiz_id/1");
            $quiz_btn_name = lang('resume_test');
            $quiz_action_icon = '<i class="fab fa-rev"></i>';
            $quiz_lock_icons = '<i class="fas fa-unlock-alt"></i>';
            $quiz_action_btn_class = 'btn-danger';
        }
        else
        {
            if(empty($user_id))
            {
                if($quiz_array->price > 0 OR $quiz_array->is_premium == 1 OR $quiz_array->is_registered == 1)
                {
                    $quiz_running_btn = "";
                    $quiz_url = base_url("login");
                    $quiz_btn_name = lang('login_please');
                    $quiz_action_icon = '<i class="fas fa-user"></i>';
                    $quiz_lock_icons = '<i class="fas fa-lock "></i>';                  
                    $quiz_action_btn_class = 'btn-danger';

                }
                else
                {
                    $quiz_running_btn = "no_quiz_start";
                    $quiz_url = base_url("instruction/quiz/$quiz_id");
                    $quiz_btn_name = lang("start_quiz");
                    $quiz_action_icon = '<i class="far fa-play-circle"></i>';
                    $quiz_lock_icons = '<i class="fas fa-unlock-alt"></i>';                 
                    $quiz_action_btn_class = 'btn-primary';
                }
            }
            else
            {
                $quiz_running_btn = "";
                if($quiz_array->price > 0 && $is_quiz_amout_payed == FALSE)
                {
                    $quiz_url = base_url("quiz-pay/payment-mode/quiz/$quiz_id");
                    $quiz_btn_name = lang('pay_now');
                    $quiz_action_icon = '<i class="fas fa-money-bill"></i>';
                    $quiz_lock_icons = '<i class="fas fa-lock "></i>';
                    $quiz_action_btn_class = 'btn-info';
                }
                else if($quiz_array->is_premium == 1 && $is_premium_member == FALSE)
                {
                    $quiz_url = base_url("membership");
                    $quiz_btn_name = lang('get_membership');
                    $quiz_action_icon = '<i class="fas fa-user-shield"></i>';
                    $quiz_lock_icons = '<i class="fas fa-lock "></i>';
                    $quiz_action_btn_class = 'btn-warning';
                }
                else
                {
                    $quiz_url = base_url("instruction/quiz/$quiz_id");
                    $quiz_btn_name = lang("start_quiz");
                    $quiz_action_icon = '<i class="far fa-play-circle"></i>';
                    $quiz_lock_icons = '<i class="fas fa-unlock-alt"></i>';
                    $quiz_action_btn_class = 'btn-primary';
                    
                }
            }
        }

        $lang_id = get_language_data_by_language($this->session->userdata('language'));
        $translate_quiz_title = get_translated_column_value($lang_id,'quizes',$quiz_id,'title');
        $quiz_title = $translate_quiz_title ? $translate_quiz_title : $quiz_array->title;
        $quiz_user_name = $quiz_array->first_name.' '.$quiz_array->last_name;
        $quiz_user_name = strlen($quiz_user_name) > 20 ? substr($quiz_user_name,0,20)."..." : $quiz_user_name;
        $quiz_user_name = trim($quiz_user_name) ? trim($quiz_user_name) : "Admin";

        $like_or_not = (isset($quiz_array->like_id) && $quiz_array->like_id ) ? 'text-dark-pink' : 'text-light-gray';
        $total_like = (isset($quiz_array->total_like) && $quiz_array->total_like) ? $quiz_array->total_like : 0;
        $average = 0;
        if($quiz_array->total_rating > 0 && $quiz_array->rating > 0)
        {
            $average = $quiz_array->total_rating / $quiz_array->rating;
        }  

        $random_bg_color = substr($quiz_id,-1);
        $default_image_path = base_url('assets/images/quiz/');
        $random_bg_image = $default_image_path.$random_bg_img[$random_bg_color];

        $box_to_show_on_md_row = isset($box_to_show_on_row) ? $box_to_show_on_row : 4;
        $box_to_show_on_lg_row = isset($box_to_show_on_row) ? $box_to_show_on_row+1 : 3;

        ?>
            <!-- // 아이템 영역 S//-->
            <?php
                $quiz_slug_url = base_url('quiz/').$quiz_id;
             ?>
                <div class="mb-4 d-none d-lg-flex">
                    <div class="col-12 list_title_btmbar">
                        <a href="<?php echo xss_clean($quiz_slug_url); ?>"><i class="far fa-list-alt mr-3"></i><span class="mb-0 text-black"><?php echo xss_clean($quiz_title); ?></span>
                            </a>
                    </div>
                </div>
                <div class="align-items-center mb-4 d-flex d-lg-none">
                    <div class="col-12 list_title_btmbar">
                        <a href="<?php echo xss_clean($quiz_slug_url); ?>"><i class="far fa-list-alt mr-2"></i><span class="mb-0 text-black"><?php echo xss_clean($quiz_title); ?></span>
                            </a>
                    </div>
                </div>                
            <!-- // 아이템 영역 E//-->     
        <?php 
    } ?>
</div>
<?php    
}
else 
{
    ?>
    <div class="col-12 text-center"> 
            <div class="row align-items-center justify-content-center no-gutters py-lg-8 py-6">
                <div class="col-12 text-center">
                    <p class="mb-5 lead font-weight-semi-bold text-medium-gray">찜해두신 테스트가 없습니다.</p>
                </div>
                <div class="col-10 col-md-8 col-lg-6 mt-2 mb-4"  id="article_body">
                    <img src="<?php echo base_url()?>assets/images/empty_lime.png" alt="" class="px-12" />
                </div>       
            </div>
    </div>
    <?php 
} ?>      