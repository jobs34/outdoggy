<?php
if($lecture_data)  
{
    foreach ($lecture_data as  $study_array) 
    {	
    	$s_m_id = $study_array->id;
        $study_title = $study_array->title;

        $meta_description = $study_array->meta_description;
        $view_real_url = base_url('serieses/').$s_m_id;
        $course_image = (isset($study_array->image) && !empty($study_array->image) ? base_url('assets/images/studymaterial/'.$study_array->image) : base_url('assets/images/studymaterial/default.jpg'));
        ?>
		
		<!-- Card list START -->
		<div class="col-12 col-md-6 px-3 pb-6">
            <div class="overflow-hidden">
                <a href="<?php echo xss_clean($view_real_url); ?>">
                    <div class="overflow-hidden">
                        <img src="<?php echo xss_clean($course_image);?>" class="rounded-3">
                    </div>
                    <!-- Overlay -->
                    <div class="bg-overlay bg-dark opacity-2"></div>
                    <div class="card-img-overlay p-4">
                        <div class="row align-items-center">
                            <!-- Main content START -->
                            <div class="col-11 pt-2 pt-md-8 mx-auto text-center">
                                <div class="p-0 mb-0 mb-md-2 text-danger font-weight-bolder">
                                    Camping School
                                </div>
                                <div class="pt-0 pb-0 min-h-120px">
                                    <h1 class="display-3 text-white"><?php echo $study_title; ?></h1>
                                </div>
                            </div>
                            <!--PC만 보이기--> 
                            <div class="min-h-120px d-none d-md-block">&nbsp;</div>
                            <div class="col-11 pb-3 mx-auto text-center align-content-end">
                                <div class="p-0 mb-1 mb-md-2 text-white min-h-70px align-content-end">
                                    <?php echo $meta_description; ?>
                                </div>
                                <div class="pt-0 pb-0 align-content-end font-size-sm">
                                    <span class="btn btn-danger rounded-5 px-3 py-1 py-md-2">내용 자세히 보기</span>
                                </div>
                            </div>                                
                        </div>
                    </div>
                </a>
            </div>
		</div>
		<!-- Card list END -->
<?php 
    } 
} 
else 
{
    ?>
    <div class="col-12 text-center"> 
            <div class="row align-items-center justify-content-center no-gutters py-lg-8 py-6">
                <div class="col-12 text-center">
                    <p class="mb-5 lead font-weight-semi-bold text-medium-gray">강의가 없습니다.</p>
                </div>
                <div class="col-12 mt-2 mb-4"  id="article_body">
                    <img src="<?php echo base_url()?>assets/images/empty_lime.png" alt="" class="px-16 px-lg-8" />
                </div>       
            </div>
    </div>

    <?php 
} ?>
