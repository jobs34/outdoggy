<?php
if($lecture_data)  
{
    foreach ($lecture_data as  $study_array) 
    {	
    	$s_m_id = $study_array->id;

        $is_s_m_amout_payed = (isset($paid_s_m_array[$s_m_id]) && $paid_s_m_array[$s_m_id]) ? TRUE : FALSE;

        $price = ($study_array->price > 0) ? number_format($study_array->price)."원" : ( ' '.lang('free'));

        $study_title = $study_array->title;
        $study_user_name = $study_array->full_name;
        $study_user_name = strlen($study_user_name) > 20 ? substr($study_user_name,0,20)."..." : $study_user_name;

        $meta_description = $study_array->meta_description;
        $view_real_url = base_url('study-content/').$s_m_id;
        $course_image = (isset($study_array->image) && !empty($study_array->image) ? base_url('assets/images/studymaterial/'.$study_array->image) : base_url('assets/images/studymaterial/default.jpg'));
        ?>
		
        <div class="col-lg-3 col-md-3 col-6 p-1">
            <!-- Card -->
            <div class="card p-0 mx-0 mx-lg-2 mb-2 mb-lg-4">
                <a href="<?php echo xss_clean($view_real_url); ?>"><img src="<?php echo xss_clean($course_image);?>" alt=""
                    class="w-100"></a>
                <!-- Card body -->
                <div class="card-body px-2 px-lg-3 py-3">
                    <p class="mt-1 mb-2 product_title_small"><a href="<?php echo xss_clean($view_real_url); ?>" class="text-black"><?php echo $study_title; ?></a></p>
                    <p class="mb-3 product_text text-truncate-line-2"><?php echo $meta_description; ?></p>
                </div>
                <!-- Card footer -->
                <div class="card-footer py-3">
                        <p class="product_title_small text-right mb-1 text-dark-gray font-weight-semi-bold"><?php echo $price; ?></p>
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
                    <p class="mb-2 display-4 lead font-weight-semi-bold text-medium-gray">강의가 없습니다.</p>
                </div> 
            </div>
    </div>

    <?php 
} ?>
