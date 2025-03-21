<?php
$user_id = isset($this->user['id']) ? $this->user['id'] : NULL; 
	
if($study_material_list_data)  
{
    foreach ($study_material_list_data as  $study_array) 
    {	
        $price = $study_array->price > 0 ? $study_array->price.'원' : ' '.lang('free');	
        $s_m_id = $study_array->id;

        $is_s_m_amout_payed = (isset($paid_s_m_array[$s_m_id]) && $paid_s_m_array[$s_m_id]) ? TRUE : FALSE;

        $price_ribbon = ($study_array->price > 0) ? get_admin_setting('paid_currency') ." " .$study_array->price : ($study_array->is_premium == 1 ? "Premium" : 'Free');
        $ribbon_label = ($study_array->price > 0  OR $study_array->is_premium == 1 ) ? 'paid' : 'free';

        $study_btn_name = $study_array->price > 0 ? lang('pay_now') : lang('study_material_show');
        $study_m_title = $study_array->title;
        $real_url = base_url('study-material/').$s_m_id;
        $view_real_url = base_url('study-content/').$s_m_id;
        $course_image = (isset($study_array->image) && !empty($study_array->image) ? base_url('assets/images/studymaterial/'.$study_array->image) : base_url('assets/images/studymaterial/default.jpg'));
        $total_file = $study_array->total_file;
        $random_bg_color = substr($s_m_id,-1);
        $default_image_path = base_url('assets/images/quiz/');
        $random_bg_image = $default_image_path.$random_bg_img[$random_bg_color];        

        $is_s_m_amout_payed = (isset($paid_s_m_array[$s_m_id]) && $paid_s_m_array[$s_m_id]) ? TRUE : FALSE;

        if($user_id == $study_array->user_id)
        {
            $is_s_m_amout_payed = TRUE;
            $is_premium_member = TRUE;
        }

        //$study_title = strlen($study_array->title) > 40 ? substr($study_array->title,0,40)."..." : $study_array->title;
        $study_title = $study_array->title;
        $study_user_name = $study_array->full_name;
        $study_user_name = strlen($study_user_name) > 20 ? substr($study_user_name,0,20)."..." : $study_user_name;


        $average = 0;
        if($study_array->total_rating > 0 && $study_array->rating > 0)
        {
            $average = $study_array->total_rating / $study_array->rating;
        }  
        $complete_count = get_study_material_user_progress($s_m_id);
        $complete_percentage = 0;
        
        if($complete_count)
        {
            $complete_percentage = round((100 * $complete_count) /$study_array->total_file);   
        }
        
        $box_to_show_on_md_row = isset($box_to_show_on_row) ? $box_to_show_on_row : 4;
        $box_to_show_on_lg_row = isset($box_to_show_on_row) ? $box_to_show_on_row+1 : 3;
        
        ?>
		
        <div class="col-lg-4 col-6 mb-2 px-1">
            <!-- Card -->
            <div class="mb-2 mx-1 mx-lg-2">
                <a href="<?php echo xss_clean($real_url); ?>" class="w-100"><img src="<?php echo xss_clean($course_image);?>" class="w-100"></a>
                <!-- Card body -->
                <div class="p-2 min-h-90px">
                    <h5 class="mt-1 mb-4 text-truncate-line-2 "><a href="<?php echo xss_clean($real_url); ?>" class="text-black"><?php echo $study_title; ?></a></h5>
                </div>
            </div>
        </div>

<?php 
    } 
} 
else 
{
    ?>
    <div class="col-12 text-center"> 
            <div class="row align-items-center justify-content-center no-gutters py-lg-8 py-6">
                <div class="col-12 text-center">
                    <p class="mb-5 display-5 text-medium-gray">강좌가 없습니다.</p>
                </div>
                <div class="col-6 mt-2 mb-4"  id="article_body">
                    <img src="<?php echo base_url()?>assets/images/empty_lime.png" alt="" class="px-4 px-lg-12" />
                </div>       
            </div>
    </div>

    <?php 
} ?>
