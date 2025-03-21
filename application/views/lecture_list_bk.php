<?php
if($lecture_data)  
{
    foreach ($lecture_data as  $study_array) 
    {	
    	$s_m_id = $study_array->id;

        $is_s_m_amout_payed = (isset($paid_s_m_array[$s_m_id]) && $paid_s_m_array[$s_m_id]) ? TRUE : FALSE;

        $pay_tag = ($study_array->price > 0) ? "유료 클래스" : "무료 클래스";
        $price = ($study_array->price > 0) ? number_format($study_array->price)."원" : ( ' '.lang('free'));

        $study_title = $study_array->title;
        $study_user_name = $study_array->full_name;
        $study_user_name = strlen($study_user_name) > 20 ? substr($study_user_name,0,20)."..." : $study_user_name;

        $meta_description = $study_array->meta_description;
        $view_real_url = base_url('serieses/').$s_m_id;
        $course_image = (isset($study_array->image) && !empty($study_array->image) ? base_url('assets/images/studymaterial/'.$study_array->image) : base_url('assets/images/studymaterial/default.jpg'));
        ?>
		
		<!-- Card list START -->
		<div class="col-12 px-5 pb-4">
			<div class="card shadow overflow-hidden p-2">
				<div class="row g-0">
					<div class="col-md-6 overflow-hidden">
                        <a href="<?php echo xss_clean($view_real_url); ?>"><img src="<?php echo xss_clean($course_image);?>" class="rounded-2" alt="Card image"></a>
					</div>
					<div class="col-md-6">
						<div class="card-body pt-3 px-4 pb-3">
							<!-- Title -->
							<h2 class="post-title pb-0 mb-3"><a href="<?php echo xss_clean($view_real_url); ?>" class="font-weight-bold text-black font-size-lg"><?php echo $study_title; ?></a></h2>
							<p class="text-truncate-3 d-none d-lg-block pb-0 mb-0"><?php echo $meta_description; ?></p>

						</div>
					</div>
				</div>
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
