<!-- Google 레이어 SEO -->
<h1 class="blind">캠핑2막 글 모음 - <?php echo $page_title;?></h1>
<!-- =======================
Page Banner START -->
<section class="pt-0 px-0 pb-0 mb-8">
    <div class="bg-black position-relative overflow-hidden" style="background-image:url(/assets/images/blog_bg.jpg); background-position: center; background-size: cover;">
    <div class="bg-overlay bg-dark opacity-5"></div>
        <div class="container z-index-9 position-relative">
            <div class="mx-auto position-relative">
                <div class="row align-items-center">
                    <div class="col-12 mx-auto text-center py-8">
                        <!-- Title -->
                        <h1 class="display-4 py-0 my-0 text-white font-weight-bolder"><?php echo $page_title;?></h1>
						<p class="mb-0 lead text-light-warning">캠핑.아웃도어 정보</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- =======================
Page Banner END -->
<!-- Page Content -->
<div class="pb-12">
	<div class="container min-h-100vh">
		<div class="row px-1">
			<?php
			$data['blog_list_data'] = $blog_post_data;
			$this->load->view('common_blog_list',$data);
			?>
			<!-- 페이징 -->
			<div class="col-xl-12 col-lg-12 col-md-12 col-12 text-center px-4 mt-6">
				<?php echo xss_clean($pagination) ?>
			</div>
		</div>
		<div class="row px-1">
			<!-- 메인 광고 -->
			<div class="col-xl-12 col-lg-12 col-md-12 col-12 text-center mt-4">
				<?php echo $blog_category_data->description ?>
			</div>
		</div>		
	</div>
</div>