<?php 
  $user_id = isset($this->user['id']) ? $this->user['id'] : 0;
  $data['user_id'] = $user_id;
?>
<!-- Page Content -->
<!-- **************** MAIN CONTENT START **************** -->
<main>
<!-- =======================
Page Banner START -->
<section class="pt-3 pb-2">
	<div class="container mt-1 px-1">
		<div class="row">
			<div class="col-12">
				<div class="pb-2 px-2 mt-1 mt-sm-0">
                    <span class="mt-0 display-6"><i class="bi bi-ui-checks-grid fa-fw me-1"></i> 마이 페이지</span> <sapn class="pl-2 mt-0 pb-2 font-weight-bold text-light-gray">My Page</span>
				</div>
				<!-- Advanced filter responsive toggler START -->
				<!-- Divider -->
				<hr class="d-xl-none">
				<div class="col-12 col-xl-3 px-3 d-flex justify-content-between align-items-center">
					<a class="h5 mb-0 fw-bold d-xl-none" href="#">마이페이지 메뉴</a>
					<button class="btn btn-primary d-xl-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
						<i class="fas fa-sliders-h"></i>
					</button>
				</div>
				<!-- Advanced filter responsive toggler END -->
			</div>
		</div>
	</div>
</section>
<!-- =======================
Page Banner END -->

<!-- =======================
Page content START -->
<section class="pt-0">
	<div class="container">
		<div class="row">
			<!-- Left sidebar START -->
			<div class="col-xl-3">
				<!-- Responsive offcanvas body START -->
				<div class="offcanvas-xl offcanvas-end" tabindex="-1" id="offcanvasSidebar">
					<!-- Offcanvas header -->
					<div class="offcanvas-header bg-light">
						<h5 class="offcanvas-title" id="offcanvasNavbarLabel">마이 페이지 메뉴</h5>
						<button  type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#offcanvasSidebar" aria-label="Close">X</button>
					</div>
					<!-- Offcanvas body -->
					<div class="offcanvas-body p-3 p-xl-0">
						<div class="bg-dark border rounded-3 p-3 w-100">
							<!-- Dashboard menu -->
							<div class="list-group list-group-dark list-group-borderless collapse-list">
								<a class="list-group-item active" href="<?php echo base_url("mypage");?>"><i class="bi bi-ui-checks-grid fa-fw me-2"></i>마이 페이지</a>
								<a class="list-group-item" href="<?php echo base_url('my/study')?>"><i class="bi bi-laptop fa-fw me-2"></i>수강중인 클래스</a>
								<a class="list-group-item" href="<?php echo base_url('my/payments')?>"><i class="bi bi-credit-card  fa-fw me-2"></i>결제 내역</a>
								<a class="list-group-item" href="<?php echo base_url('profile')?>"><i class="bi bi-pencil-square fa-fw me-2"></i>사용자 정보 변경</a>
								<a class="list-group-item text-danger bg-danger-soft-hover" href="<?php echo base_url("logout");?>"><i class="fas fa-sign-out-alt fa-fw me-2"></i>로그아웃</a>
							</div>
						</div>
					</div>
				</div>
				<!-- Responsive offcanvas body END -->
			</div>
			<!-- Left sidebar END -->

			<!-- Main content START -->
			<div class="col-xl-9">

				<!-- Counter boxes START -->
				<div class="row mb-4 px-5">
					<!-- Counter item -->
					<div class="col-12 px-4 pt-4 pb-3 bg-orange bg-opacity-15 rounded-3">
						<!-- Profile info -->
						<div class="col d-sm-flex justify-content-between align-items-center">
							<div class="mb-2">
								<span class="display-6"><i class="bi bi-person me-1"></i><?php echo $this->user['first_name']; ?></span>
                                <span class="pl-2 text-gray"><?php echo $this->user['email']; ?></span>
							</div>
							<!-- Button -->
							<div class="mt-0 pr-1">
								<a href="<?php echo base_url('profile')?>" class="mb-2">
                                <button class="btn btn-sm btn-success me-1 mb-1 mb-x;-0"><i class="bi bi-pencil-square fa-fw me-2"></i>사용자 정보 변경</button></a>
							</div>
						</div>
					</div>
				</div>
				<!-- Counter boxes END -->

				<div class="card bg-transparent border rounded-3 mb-4 mx-3">
					<!-- Card header START -->
					<div class="card-header bg-transparent border-bottom">
                    <span class="h3"><i class="bi bi-laptop fa-fw me-2"></i></span> <span class="h5">현재 <?php echo $class_data ?>개의 클래스를 수강중입니다.</span>
					</div>
					<!-- Card header END -->

					<!-- Card body START -->
					<div class="card-body">
                    <div class="row">
                        <?php
                            $data['user_study_history'] = true;
                            $data['study_material_list_data'] = $study_material_data;
                            if($study_material_data)  
                            {
                                foreach ($study_material_data as  $study_array) 
                                {	
                                    $s_m_id = $study_array->id;
                                    $study_title = $study_array->title;
                                    $real_url = base_url('serieses/').$s_m_id;
                                    $view_url = base_url('study-content/').$s_m_id;
                                    $course_image = (isset($study_array->image) && !empty($study_array->image) ? base_url('assets/images/studymaterial/'.$study_array->image) : base_url('assets/images/studymaterial/default.jpg'));
                                    $default_image_path = base_url('assets/images/quiz/');     
                                    $box_to_show_on_md_row = isset($box_to_show_on_row) ? $box_to_show_on_row : 4;
                                    $box_to_show_on_lg_row = isset($box_to_show_on_row) ? $box_to_show_on_row+1 : 3;
                                    
                                    ?>
                                    
                                    <div class="col-lg-4 col-6 mb-2 px-1">
                                        <!-- Card -->
                                        <div class="mb-2 mx-1 mx-lg-2">
                                            <a href="<?php echo xss_clean($real_url); ?>" class="w-100"><img src="<?php echo xss_clean($course_image);?>" class="w-100"></a>
                                            <!-- Card body -->
                                            <div class="p-2 min-h-90px">
                                                <h5 class="mt-1 mb-4 text-truncate-line-2 "><a href="<?php echo xss_clean($real_url); ?>" class="text-black"><?php echo $study_title; ?></a></h5>
                                            </div>
                                        </div>
                                    </div>

                            <?php 
                                } 
                            } 
                            else 
                            {
                                ?>
                                <div class="col-12 text-center"> 
                                        <div class="row align-items-center justify-content-center no-gutters py-lg-8 py-6">
                                            <div class="col-12 text-center">
                                                <p class="mb-5 display-5 text-medium-gray">강좌가 없습니다.</p>
                                            </div>
                                            <div class="col-6 mt-2 mb-4"  id="article_body">
                                                <img src="<?php echo base_url()?>assets/images/empty_lime.png" alt="" class="px-4 px-lg-12" />
                                            </div>       
                                        </div>
                                </div>

                                <?php 
                            } ?>

                            <div class="col-12 my-5">
                              <?php echo xss_clean($pagination) ?>
                            </div>
                        </div>    
					</div>
					<!-- Card body START -->
				</div>
			<!-- Main content END -->
			</div><!-- Row END -->
		</div>
	</div>	
</section>
<!-- =======================
Page content END -->
</main>
<!-- **************** MAIN CONTENT END **************** -->