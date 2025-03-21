<?php
if($ext_course_list_data)  
{ ?>
<div class="col-12 pl-3">
    <h2 class="lead display-7 pb-0 mb-1"><?php echo $category_data->category_title; ?> 무료 강의</h2>
    <h4 class="lead display-8 mb-4 font-weight-normal">학습자들에게 도움이 되는 무료 강의를 소개해드립니다</h4>
</div>
<?php
foreach ($ext_course_list_data as  $study_array) 
    {	
        $s_m_id = $study_array->id;
        $study_title = $study_array->title;
        $study_description = $study_array->meta_description;
        //$view_real_url = base_url('ext-course/')."$gubun_param/".$s_m_id;
        $view_real_url = base_url('ext-course/')."$s_m_id/".$gubun_param;
        $course_image = (isset($study_array->image) && !empty($study_array->image) ? base_url('assets/images/studymaterial/'.$study_array->image) : base_url('assets/images/studymaterial/default_ext_course.jpg'));
        $default_image_path = base_url('assets/images/quiz/');
        $is_premium = ($study_array->is_premium=="1" ? "내일배움카드 국비지원" : "무료 강좌");
        $badge_color = ($study_array->is_premium=="1" ? "badge-primary" : "badge-dark");
        ?>
        <div class="col-12 col-md-6 px-3 mb-2 mb-md-0">  
            <!--카드 강좌 S-->
            <div class="card mb-4 card-hover mx-1">
                <a href="<?php echo xss_clean($view_real_url); ?>">
                <div class="row no-gutters">
                    <div class="col-3 col-md-2">
                        <div class="text-center">
                            <a href="<?php echo xss_clean($view_real_url); ?>"><img src="<?php echo xss_clean($course_image);?>" alt="" class="img-fluid w-100"></a>
                        </div>
                    </div>
                    <div class="col-9 col-md-10">
                        <div class="pt-2 pl-3 pr-2 pb-0">
                            <div class="mt-0 mb-1">
                                <span class="badge <?php echo $badge_color; ?> py-2"><?php echo $is_premium; ?> </span>
                            </div>  
                            <div class="mt-0 mb-0">
                                 <a href="<?php echo xss_clean($view_real_url); ?>" class="product_title_small"><?php echo $study_title; ?></a>
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
} 
?>
