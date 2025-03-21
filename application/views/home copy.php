<!-- Google 레이어 SEO -->
<h1 class="blind">즐거운2막</h1>
<!-- =======================
Action box START-->
<section class="pt-2 px-2 pb-3">
	<div class="container mb-4 mb-md-3">
		<div class="row px-0">
			<div class="col-12">
				<div class="bg-black p-3 p-md-5 rounded-4 position-relative overflow-hidden" style="background-image:url(/assets/images/intro/intro_bg_outdoor.jpg); background-position: bottom; background-size: cover;">
				<div class="bg-overlay bg-dark opacity-5"></div>
					<div class="container z-index-9 position-relative">
						<div class="col-11 mx-auto position-relative">
							<div class="row align-items-center">
								<!-- Title -->
								<div class="col-lg-7 text-white font-weight-bold py-2 py-md-4">
									<span class="badge badge-primary rounded-pill mb-2 font-weight-bold px-3">Outdoor Life</span>
									<p class="display-3 mb-2">아웃도어</p>
									<p class="mb-3 lead">캠핑, 차박, 등산, 여행 등</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</section>
<!-- =======================
Action box END-->
<!-- 최근 콘텐츠(아웃도어)-->
<?php if($blog_data01) {
?>
<div class="pt-0 pb-2 mb-0">
    <div class="container row px-2">
        <div class="col-12 pl-2 mb-3">
            <a href="/blog/list/leisure" class="display-6 lead text-black">아웃도어 관련정보 &nbsp;&gt;</a>
        </div>  
        <?php        
        foreach($blog_data01 as $like_post_key => $like_post_value)
        {
        ?>
        <div class="col-lg-3 col-6 px-0 pb-3">
            <!-- Card -->
            <div class="mb-3 mx-2">
            	<a href="<?php echo  base_url('blog/').$like_post_value->post_slug ?>">
                <!-- Img  -->
                <?php
                $blog_post_image = (isset($like_post_value->post_image) && !empty($like_post_value->post_image) ? base_url('assets/images/blog_image/post_image/'.$like_post_value->post_image) : base_url('assets/images/blog_image/default.jpg'));
                ?>
                <img src="<?php echo xss_clean($blog_post_image);?>" class="w-100 rounded-3 border border-light-secondary" alt=""></a>
				<!-- Card body -->
				<div class="px-1 py-2 min-h-60px">
					<!-- 글 표시 영역-->
					<div class="pt-0 no-gutters lh-sm">
					<a href="<?php echo  base_url('blog/').$like_post_value->post_slug ?>" class="text-black font-weight-medium "><?php echo xss_clean($like_post_value->post_title); ?></a>
					</div>
				</div>
            </div>
        </div>
        <?php 
        } 
        ?>
    </div>
</div>    
<?php     
} 
?>
<!-- =======================
Action box START-->
<section class="pt-2 px-2 pb-3">
	<div class="container mb-4 mb-md-3">
		<div class="row px-0">
			<div class="col-12">
				<div class="bg-black p-3 p-md-5 rounded-4 position-relative overflow-hidden" style="background-image:url(/assets/images/intro/intro_bg_health.jpg); background-position: center; background-size: cover;">
				<div class="bg-overlay bg-dark opacity-5"></div>
					<div class="container z-index-9 position-relative">
						<div class="col-11 mx-auto position-relative">
							<div class="row align-items-center">
								<!-- Title -->
								<div class="col-lg-7 text-white font-weight-bold py-2 py-md-4">
									<span class="badge badge-primary rounded-pill mb-2 font-weight-bold px-3">Health for All</span>
									<p class="display-3 mb-2">헬스</p>
									<p class="mb-3 lead">건강정보, 걷기, 러닝, 홈트레이닝 등</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- =======================
Action box END-->
<!-- 최근 콘텐츠(헬스 소식)-->
<?php if($blog_data02) {
?>
<div class="pt-0 pb-2 mb-0">
    <div class="container row px-2">
        <div class="col-12 pl-2 mb-3">
            <a href="/blog/list/health" class="display-6 lead text-black">헬스 관련 정보&nbsp;&gt;</a>
        </div>  
        <?php        
        foreach($blog_data02 as $like_post_key => $like_post_value)
        {
        ?>
        <div class="col-lg-3 col-6 px-0 pb-3">
            <!-- Card -->
            <div class="mb-3 mx-2">
            	<a href="<?php echo  base_url('blog/').$like_post_value->post_slug ?>">
                <!-- Img  -->
                <?php
                $blog_post_image = (isset($like_post_value->post_image) && !empty($like_post_value->post_image) ? base_url('assets/images/blog_image/post_image/'.$like_post_value->post_image) : base_url('assets/images/blog_image/default.jpg'));
                ?>
                <img src="<?php echo xss_clean($blog_post_image);?>" class="w-100 rounded-3 border border-light-secondary" alt=""></a>
				<!-- Card body -->
				<div class="px-1 py-2 min-h-60px">
					<!-- 글 표시 영역-->
					<div class="pt-0 no-gutters lh-sm">
					<a href="<?php echo  base_url('blog/').$like_post_value->post_slug ?>" class="text-black font-weight-medium"><?php echo xss_clean($like_post_value->post_title); ?></a>
					</div>
				</div>
            </div>
        </div>
        <?php 
        } 
        ?>
    </div>
</div>    
<?php     
} 
?>
<!-- =======================
Action box START-->
<section class="pt-2 px-2 pb-3">
	<div class="container mb-4 mb-md-3">
		<div class="row px-0">
			<div class="col-12">
				<div class="bg-black p-3 p-md-5 rounded-4 position-relative overflow-hidden" style="background-image:url(/assets/images/intro/intro_bg_culture.jpg); background-position: bottom; background-size: cover;">
				<div class="bg-overlay bg-dark opacity-5"></div>
					<div class="container z-index-9 position-relative">
						<div class="col-11 mx-auto position-relative">
							<div class="row align-items-center">
								<!-- Title -->
								<div class="col-lg-7 text-white font-weight-bold py-2 py-md-4">
									<span class="badge badge-primary rounded-pill mb-2 font-weight-bold px-3">Happy Life</span>
									<p class="display-3 mb-2">라이프</p>
									<p class="mb-3 lead">취미, 음악, 영화, 레트로, 일상의 여유 등</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</section>
<!-- =======================
Action box END-->
<!-- 최근 콘텐츠(라이프 소식)-->
<?php if($blog_data03) {
?>
<div class="pt-0 pb-2 mb-0">
    <div class="container row px-2">
        <div class="col-12 pl-2 mb-3">
            <a href="/blog/list/romanlife" class="display-6 lead text-black">라이프 관련 정보&nbsp;&gt;</a>
        </div>  
        <?php        
        foreach($blog_data03 as $like_post_key => $like_post_value)
        {
        ?>
        <div class="col-lg-3 col-6 px-0 pb-3">
            <!-- Card -->
            <div class="mb-3 mx-2">
            	<a href="<?php echo  base_url('blog/').$like_post_value->post_slug ?>">
                <!-- Img  -->
                <?php
                $blog_post_image = (isset($like_post_value->post_image) && !empty($like_post_value->post_image) ? base_url('assets/images/blog_image/post_image/'.$like_post_value->post_image) : base_url('assets/images/blog_image/default.jpg'));
                ?>
                <img src="<?php echo xss_clean($blog_post_image);?>" class="w-100 rounded-3 border border-light-secondary" alt=""></a>
				<!-- Card body -->
				<div class="px-1 py-2 min-h-60px">
					<!-- 글 표시 영역-->
					<div class="pt-0 no-gutters lh-sm">
					<a href="<?php echo  base_url('blog/').$like_post_value->post_slug ?>" class="text-black font-weight-medium"><?php echo xss_clean($like_post_value->post_title); ?></a>
					</div>
				</div>
            </div>
        </div>
        <?php 
        } 
        ?>
    </div>
</div>    
<?php     
} 
?>

<!-- 메인 광고 -->
<div class="col-12 text-center mt-4 mb-6">
	<?php echo $adv_data->google_ad_code ?>
</div>