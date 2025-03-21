<?php
foreach ($free_course_list_data as  $study_array) 
{	
    $s_m_id = $study_array->id;
    $study_title = $study_array->title;
    $category_title = $study_array->category_title;
    $description = $study_array->url;
    $view_real_url = base_url('cgrounds/').$s_m_id;
    $course_image = (isset($study_array->image) && !empty($study_array->image) ? base_url('assets/images/studymaterial/'.$study_array->image) : base_url('assets/images/studymaterial/default_ext_course.jpg'));
    $default_image_path = base_url('assets/images/quiz/');
    ?>
        <!-- Card item START -->
        <div class="col-lg-3 col-6 px-2 py-2 py-md-3 m-0">
            <div class="card">
                <div class="overflow-hidden">
                    <a href="<?php echo xss_clean($view_real_url); ?>"><img src="<?php echo xss_clean($course_image);?>"></a>
                </div>
                <!-- Card body -->
                <div class="card-body px-3 pt-3 pb-2">
                    <!-- Title -->
                    <div class="mt-0 mb-2 min-h-100px">
                        <div class="mb-2 post-title"><a href="<?php echo xss_clean($view_real_url); ?>" class="text-black"><?php echo $study_title; ?></a></div>
                        <div class="pt-1 text-medium-gray lead font-size-sm lh-sm text-truncate-line-2"><?php echo $description; ?></div>
                    </div> 
                    <div class="text-primary lead font-size-md"><?php echo $category_title; ?></div>  
                </div>
            </div>
        </div>
        <!-- Card item END -->
<?php 
} 
?>