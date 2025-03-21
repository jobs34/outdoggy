<?php
$user_id = isset($this->user['id']) ? $this->user['id'] : NULL; 
	
if($study_material_list_data)  
{
?>
<?php
    foreach ($study_material_list_data as  $study_array) 
    {	
        $s_m_id = $study_array->id;
        $study_title = $study_array->title;
        $study_description = $study_array->meta_description;
        $view_real_url = base_url('study-content/').$s_m_id;
        $course_image = (isset($study_array->image) && !empty($study_array->image) ? base_url('assets/images/studymaterial/'.$study_array->image) : base_url('assets/images/studymaterial/default.jpg'));
        $random_bg_color = substr($s_m_id,-1);
        $default_image_path = base_url('assets/images/quiz/');    
        ?>
        <div class="col-12 mb-5 mb-md-0">  
            <div class="card border-0 mb-2 mb-md-6 mx-2">
                <div style="background-image: linear-gradient(to bottom, #f0ecff, #f6f4ff);">
                    <div class="row no-gutters">
                        <div class="col-12 col-md-5">
                            <div class="text-center pt-4 pb-4 px-1">
                                <a href="<?php echo xss_clean($view_real_url); ?>"><img src="<?php echo xss_clean($course_image);?>" alt="" class="img-fluid w-75"></a>
                            </div>
                        </div>
                        <div class="col-12 col-md-7 pt-1 pt-md-4 pl-0 pr-2 text-center text-md-left">
                            <!--PC--> 
                            <div class="mt-2 mb-2 d-none d-md-block">
                                <a href="<?php echo xss_clean($view_real_url); ?>" class="display-7 text-dark-gray lead"><?php echo $study_title; ?></a>
                            </div>
                            <div class="mt-0 mb-4 d-none d-md-block">
                                <a href="<?php echo xss_clean($view_real_url); ?>" class="btn btn-primary py-2"><span class="px-0">클래스 상세 정보</span></a>   
                            </div>  
                            <!--모바일-->
                            <div class="px-4 mt-0 mb-2 d-block d-md-none">
                                <a href="<?php echo xss_clean($view_real_url); ?>" class="display-8 font-weight-bold text-black lead"><?php echo $study_title; ?></a>
                            </div>
                            <div class="px-8 mt-0 mb-4 d-block d-md-none">
                                <a href="<?php echo xss_clean($view_real_url); ?>" class="btn btn-primary btn-block py-2"><span class="px-0 font-size-sm">클래스 상세 정보</span></a>   
                            </div>                                  
                        </div>
                    </div>
                </div>
            </div>        
        </div>
<?php 
    } 
} 
?>
