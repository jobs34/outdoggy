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
        $study_description = strip_tags($study_array->description);
        $study_description = mb_strimwidth($study_description, '0', '60', '..', 'utf-8');

        $view_real_url = base_url('ext-course/')."$s_m_id/".$gubun_param;
        $course_image = (isset($study_array->image) && !empty($study_array->image) ? base_url('assets/images/studymaterial/'.$study_array->image) : base_url('assets/images/studymaterial/default_ext_course.jpg'));
        $default_image_path = base_url('assets/images/quiz/');
        $badge_color = ($study_array->is_premium=="1" ? "badge-primary" : "badge-dark");

        $ins_title = $study_array->ins_title;
        $ins_image = (isset($study_array->logo) && !empty($study_array->logo) ? base_url('assets/images/institution/'.$study_array->logo) : base_url('assets/images/institution/default_logo.jpg'));
        ?>
        <div class="col-6 col-md-3 pl-2 pl-md-0 pr-2 pr-md-3 mb-2 mb-md-0">  
            <!--카드 강좌 S-->
            <div class="card mb-4 card-hover mx-0">
                <a href="<?php echo xss_clean($view_real_url); ?>">
                <div class="row no-gutters">
                    <div class="col-12">
                        <div class="pt-3 pl-3">
                            <img src="<?php echo xss_clean($course_image);?>" alt="" class="icon-shape icon-xxl rounded-circle">
                        </div>
                        <div class="pt-3 pl-3 pr-2 pb-0 min-h-100px lh-sm">
                            <div class="mt-0 mb-2 lead font-weight-bold text-black">
                                 <?php echo $study_title;?>
                            </div> 
                            <div class="mt-0 mb-2 lead font-size-sm text-medium-gray">
                                 <?php echo $study_description; ?>
                            </div>  
                        </div>
                        <div class="row pt-1 pl-2 pr-2 pb-2 font-size-xs">
                            <div class="col-auto mt-0 mb-2 lead text-black">
                                <img src="<?php echo xss_clean($ins_image);?>" alt="" class="logo-sm">
                            </div> 
                            <div class="col-auto mt-0 mb-2 lead text-dark-gray">
                                <?php echo $ins_title;?>
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
