<?php 
  $user_id = isset($this->user['id']) ? $this->user['id'] : 0;
  $data['user_id'] = $user_id;
?>
<!-- Page Content -->
<div class="pt-4 pb-4 bg-light-gray min-h-100vh">
    <div class="container">
        <div class="row mt-0 mt-md-4">
            <!-- Left 사이드 바/모바일에서는 상단 바 S-->
            <div class="col-lg-3 col-md-4 col-12">
                <nav class="navbar navbar-expand-md navbar-light shadow-sm mb-4 mb-lg-0 sidenav">
                     <!-- 모바일 Menu 명-->
                    <a class="d-xl-none d-lg-none d-md-none text-inherit font-weight-bold" href="#!">마이 페이지</a>
                    <!-- Button -->
                    <button class="navbar-toggler d-md-none icon-shape icon-sm rounded bg-primary text-light" type="button" data-toggle="collapse" data-target="#sidenav" aria-controls="sidenav" aria-expanded="false" aria-label="Toggle navigation"><span class="fe fe-menu"></span></button>
                    <!-- Collapse navbar -->
                    <div class="collapse navbar-collapse mt-1" id="sidenav">
                        <div class="navbar-nav flex-column">
                            <!-- PC Menu 명-->
                            <div class=" d-lg-block d-md-block d-sm-none"><p class="mb-1 display-7"><?php echo $this->user['first_name']; ?></p><h6 class="mb-4 text-light-gray"><?php echo $this->user['email']; ?></h6></div>
                            <!-- List -->
                            <ul class="list-unstyled ml-n2 mb-4">
                                <!-- Nav item -->
                                <li class="nav-item active"><a class="nav-link" href="<?php echo base_url('my/study')?>"><i class="fe fe-star nav-icon mr-2"></i>수강중 클래스</a></li>
                                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('my/payments')?>"><i class="fe fe-credit-card nav-icon mr-2"></i>결제 내역</a></li>
                                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('profile')?>"><i class="fe fe-user nav-icon mr-2"></i><?php echo lang('user_profile') ?></a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <!-- Left 사이드 바/모바일에서는 상단 바 E-->
            <!-- Right 내용 보여주기 S-->
            <div class="col-lg-9 col-md-8 col-12">
                <!-- Card -->
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <h3 class="mb-0">수강중 클래스</h3>
                    </div>
                    <!-- Card body -->
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
                </div>
            </div>
            <!-- Right 내용 보여주기 E-->
        </div>
    </div>
</div>