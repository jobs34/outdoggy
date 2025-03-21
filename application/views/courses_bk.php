<!-- =======================
Page Banner START -->
<section class="pt-0 px-0 pb-0 mb-8">
    <div class="bg-black position-relative overflow-hidden" style="background-image:url(/assets/images/courses_bg.jpg); background-position: center; background-size: cover;">
    <div class="bg-overlay bg-dark opacity-5"></div>
        <div class="container z-index-9 position-relative">
            <div class="mx-auto position-relative">
                <div class="row align-items-center">
                    <div class="col-12 mx-auto text-center py-8">
                        <!-- Title -->
                        <h1 class="display-4 py-0 my-0 text-white font-weight-bolder">캠핑스쿨</h1>
                        <p class="mb-0 lead text-light-warning">초보 캠퍼를 위한 안내</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =======================
Page Banner END -->
<!-- =======================
Page content START -->
<section class="pt-2 pb-6 min-h-100vh">
	<div class="container px-2">
		<div class="row">
			<!-- Main content START -->
			<div class="col-lg-8 col-md-12 col-12 pt-0 mb-4 px-0">
				<!-- Course list START -->
				<div class="row g-4">
                    <?php if($lecture_data)
                        { ?>
                        <!--////  강좌 card S //// -->
                        <div class="col-12 mb-0 px-0">
                            <div class="p-0">
                                <div class="row mb-1">
                                <?php
                                    $data['lecture_data'] = $lecture_data;
                                    $this->load->view('lecture_list',$data);  
                                    ?>
                                </div>
                            </div>
                        </div>
                        <!--////  강좌 card E //// -->   
                    <?php } ?> 
				</div>
				<!-- Course list END -->
			</div>
			<!-- Main content END -->
            <div class="col-lg-4 col-md-12 col-12 pt-0">    
                <!-- ////  오른쪽 광고 card S  //// -->
                <div class="card border-0 mb-4 mx-1 px-3 py-4">
                    <div class="px-1 py-1 text-center">
                        <?php $this->load->view('ad_r_square');?>
                    </div>
                </div>
                <!-- ////  오른쪽 광고 card E  //// -->   
            </div>

		</div><!-- Row END -->
	</div>
</section>
<!-- =======================
Page content END -->