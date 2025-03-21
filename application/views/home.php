<!-- #################  Header NavBar 영역 ################# -->
<!-- Header START -->
<header class="navbar-light navbar-transparent" id="home-navar">
	<!-- Logo Nav START -->
	<nav class="navbar navbar-expand-lg">
		<div class="container">
			<!-- Logo START -->
			<a class="navbar-brand" href="<?php echo base_url()?>">
				<img class="light-mode-item navbar-brand-item" src="<?php echo base_url('/assets/images/'); ?>logo_white.png">
			</a>
			<!-- Logo END -->
			<!-- Responsive navbar toggler -->
			<button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-animation">
					<span></span>
					<span></span>
					<span></span>
				</span>
			</button>
			<!-- Main navbar START -->
			<div class="navbar-collapse collapse" id="navbarCollapse">
				<!-- Nav Search END -->
				<ul class="navbar-nav navbar-nav-scroll ms-auto">
					<!-- Nav item 1 -->
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url('campground/camping_area')?>">애견동반 캠핑</a></li>
					<!-- Nav item 2 -->
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url('campground/accom_area')?>">애견동반 숙소</a></li>					
					<!-- Nav item 3-->
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url('courses/ctp03')?>">캠핑스쿨</a></li>
					<!-- Nav item 4-->
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url('blog/list/all')?>">매거진</a></li>
				</ul>
			</div>
			<!-- Main navbar END -->
		</div>
	</nav>
	<!-- Logo Nav END -->
</header>
<!-- Header END --> 
<!-- Google 레이어 SEO -->
<h1 class="blind">아웃도기</h1>
<!-- == Main Banner START -->
<div class="banner-bg text-center" style="background-image:url(/assets/images/intro/banner_camping_bgimg.jpg); background-position: right; background-size: cover;">
  <video muted autoplay loop>
    <source src="assets/images/intro/intro_banner02.mp4" type="video/mp4">
  </video>
  <div class="banner-text">
  	<div class="container position-relative mt-0 mt-sm-5 pt-2">
		<div class="row align-items-center">
			<div class="col-12 px-4 py-0">
				<!-- Title -->
				<h6 class="mb-1 pt-3 pb-0 display-7 text-warning lead d-md-none text-center opacity-5">행복한 애견동반 아웃도어 라이프</h6>
				<h1 class="mb-0 font-weight-bolder text-dark-success lead d-md-none text-center opacity-7" style="font-size:3rem; line-height: 1.0;">OUTDOGGY</h1>
				<h6 class="mb-0 pl-2 pt-0 pb-1 display-3 text-warning d-none d-md-block text-center opacity-5">행복한 애견동반 아웃도어 라이프</h6>
				<h1 class="mb-0 pl-2 font-weight-bolder text-dark-success d-none d-md-block text-center opacity-5" style="font-size:6rem; line-height: 0.9;">OUTDOGGY</h1>
			</div>
		</div>
	</div>
  </div>
</div>
<!-- == Main Banner END -->
<section class="pt-6 px-2 pb-0 bg-very-light-green">
	<div class="container">
		<div class="row px-0">
			<div class="col-12 pt-6 text-center">
				<span class="badge badge-pill badge-primary font-weight-bold font-size-lg px-4 py-2">댕댕이와 함께</span>
			</div>
			<div class="col-12 pt-2 text-center">
				<h2 class="text-primary display-5 font-weight-bolder">반려견 동반 캠핑 & 여행</h2>
			</div>
		</div>
	</div>
</section>
<section class="pt-0 px-2 pb-4 bg-very-light-green">
	<div class="container mb-4 mb-md-3">
		<div class="row px-0">
			<div class="col-12 py-4 px-4 px-2">
				<div class="container position-relative">
					<div class="row align-baseline">
						<!-- Title -->
						<div class="col-md-6 p-3">
							<div class="bg-white rounded-4 p-5">
								<div class="text-center">
									<!-- Image -->
									<a href="/campground/camping_area"><img src="/assets/images/intro/img_home_camping_area.png" class="w-75" alt="애견동반 캠핑장•글램핑장"></a>
								</div>
								<div class="text-center pt-4">
									<h2 class="text-black display-7 font-weight-bolder">애견동반 캠핑장•글램핑장</h2>
								</div>
							</div>
						</div>
						<div class="col-md-6 p-3 text-center">
							<div class="bg-white rounded-4 p-5">
								<div class="text-center">
									<!-- Image -->
									<a href="/campground/accom_area"><img src="/assets/images/intro/img_home_accom_area.png" class="w-75" alt="전국의 추천 캠핑장"></a>
								</div>
								<div class="text-center pt-4">
									<h2 class="text-black display-7 font-weight-bolder">애견동반 펜션•기타 숙소</h2>
								</div>							
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="pt-0 px-2 pb-0 bg-primary">
	<div class="container mb-4 mb-md-3">
		<div class="row px-0">
			<div class="col-12 pt-8 text-center">
				<!-- Image -->
				<a href="/courses/ctp03"><img src="/assets/images/intro/ico_campingschool.png" class="w-75 px-0 px-md-6" alt="전국의 추천 캠핑장"></a>
			</div>			
			<div class="col-12 pt-2 pb-6 text-center">
				<!-- Button -->
				<a href="/courses/ctp03" class="btn btn-primary font-weight-bolder px-5">✏ 초보를 위한 캠핑스쿨</a>
			</div>
		</div>
	</div>
</section>
<!-- 최근 매거진 콘텐츠-->
<?php if($blog_data) {
?>
<div class="pt-6 pb-2 mb-0">
    <div class="container row px-2">
        <div class="col-12 pl-2 mb-3">
            <a href="/blog/list/all" class="display-5 lead text-black">매거진 &nbsp;&gt;</a>
        </div>  
        <?php        
        foreach($blog_data as $like_post_key => $like_post_value)
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
					<a href="<?php echo  base_url('blog/').$like_post_value->post_slug ?>" class="text-primary font-weight-bold"><?php echo xss_clean($like_post_value->post_title); ?></a>
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