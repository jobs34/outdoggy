<!-- **************** MAIN CONTENT START **************** -->
<main>
<!-- =======================
Page Banner START -->
<section class="bg-dark align-items-center d-flex" style="background:url(/assets/images/pattern/04.png) no-repeat center center; background-size:cover;">
	<!-- Main banner background image -->
	<div class="container px-3">
		<div class="row">
			<div class="col-12">
				<!-- Title -->
				<h1 class="text-white">복지실무 교육</h1>
				<!-- Breadcrumb -->
				<div class="d-flex pl-1">
					<nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/" class="bread-anc">홈</a></li>
                            <li class="breadcrumb-item active" aria-current="page">복지실무 교육</li>
                        </ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- =======================
Page Banner END -->
<!-- =======================
Page content START -->
<section class="pb-0 py-sm-5 min-h-100vh">
	<div class="container px-3">
		<div class="row">
			<!-- Main content START -->
			<div class="col-xl-9 col-xxl-8">
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
			<!-- Right sidebar START -->
			<div class="col-lg-3 col-xxl-4">





			</div>
			<!-- Right sidebar END -->

		</div><!-- Row END -->
	</div>
</section>
<!-- =======================
Page content END -->
</main>
<!-- **************** MAIN CONTENT END **************** -->