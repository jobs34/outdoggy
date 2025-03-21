<?php
foreach ($ad_course_list_data as  $study_array) 
{	
    $s_m_id = $study_array->id;
    $study_title = $study_array->title;
    $view_real_url = base_url('ad-course/')."$s_m_id/".$gubun_param;
    $course_image = (isset($study_array->image) && !empty($study_array->image) ? base_url('assets/images/studymaterial/'.$study_array->image) : base_url('assets/images/studymaterial/default_ext_course.jpg'));
    $default_image_path = base_url('assets/images/quiz/');
    $lesson_type = ($study_array->lesson_type=="1" ? "집체(오프라인) 강좌" : "온라인 강좌");
    $origin_price = number_format($study_array->origin_price)."원";
    $real_price = $study_array->real_price;
    $ins_title = $study_array->ins_title;
    $ins_image = (isset($study_array->ins_logo) && !empty($study_array->ins_logo) ? base_url('assets/images/institution/'.$study_array->ins_logo) : base_url('assets/images/institution/default_logo.jpg'));
    ?>
    <div class="col-12 px-2 mb-4 mb-md-3">  
        <!--카드 강좌 S-->
        <div class="mt-3 mb-2 mx-1">
            <a href="<?php echo xss_clean($view_real_url); ?>">
            <div class="row no-gutters">
                <div class="col-3">
                    <div class="text-center">
                        <a href="<?php echo xss_clean($view_real_url); ?>"><img src="<?php echo xss_clean($course_image);?>" alt="" class="img-fluid w-100"></a>
                    </div>
                </div>
                <div class="col-9">
                    <div class="pt-0 pt-md-1 pl-3 pl-md-4 pr-2 pb-0"> 
                        <div class="mt-0 mb-0">
                        <a href="<?php echo xss_clean($view_real_url); ?>" class="product_title_small mt-1"><?php echo $study_title; ?></a>
                        </div>  
                        <div class="mt-1 mb-0">
                            <span class="badge badge-light-primary">광고</span> <span class="ml-1 font-size-sm text-medium-gray"><?php echo $ins_title; ?></span>
                        </div> 
                        <div class="mt-1 mb-0 font-size-xs text-medium-gray d-none d-md-block">
                            훈련비<span class="ml-2 text-dark-gray"><?php echo $origin_price; ?></span>
                            <span class="ml-6">국비지원액</span>
                            <span class="ml-2 text-dark-gray"><?php echo $real_price; ?></span>
                        </div> 
                        
                    </div>
                </div>                    
            </div>
            </a>
        </div>
        <!--카드 강좌 E-->               
    </div>
<?php 
} 
?>
