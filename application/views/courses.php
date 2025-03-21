<!-- Title START -->
<section class="pt-2 pb-2">
	<div class="container p-0">
		<div class="row align-items-center">
			<!-- Main content START -->
			<div class="col-12 mx-auto text-center px-2 px-md-10 py-4">
                <img src="<?php echo base_url('/assets/images/'); ?>campingschhol_logo.png" class="w-75 w-md-50">
			</div>
		</div><!-- Row END -->
	</div>
</section>
<!-- Title END -->
<!-- =======================
Page content START -->
<section class="pt-2 pb-6 min-h-100vh">
	<div class="container px-4">
        <!-- Course list START -->
        <div class="row">
            <?php if($lecture_data)
                { ?>
                <!--////  강좌 card S //// -->
                <div class="col-12 mb-0 px-4">
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
</section>
<!-- =======================
Page content END -->