<?php 
   foreach($study_material_list_data as  $study_array)
   {
    $study_title = $study_array->title;
    $s_m_id = $study_array->id;
    $view_real_url = base_url('study-content/').$s_m_id;
    $course_image = (isset($study_array->image) && !empty($study_array->image) ? base_url('assets/images/studymaterial/'.$study_array->image) : base_url('assets/images/studymaterial/default.jpg'));
    ?>
    <div class="d-flex align-items-center mb-4">
        <div class="position-relative">
            <a href="<?php echo xss_clean($view_real_url); ?>"><img src="<?php echo xss_clean($course_image);?>" class="extbox_5r">
            </a>
        </div>
        <div class="ml-3">
                <a href="<?php echo xss_clean($view_real_url); ?>"><p class="category_blog_side mb-0"><?php echo $study_title; ?></p>
                </a>
        </div>
    </div>
<?php 
    } 
?>
