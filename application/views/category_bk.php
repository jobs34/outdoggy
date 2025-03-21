<?php 
    $user_id = isset($this->user['id']) ? $this->user['id'] : 0;
    $data['paid_quizes_array'] = $paid_quizes_array;
    $data['paid_s_m_array'] = $paid_s_m_array;
    $category_img_dir = base_url("assets/images/category_image/");
    $category_image = $category_data->category_image ? $category_data->category_image : "default.jpg";
    $category_image = $category_img_dir.$category_image;
    $parent_category = $category_data->parent_category;
    $category_gubun = "";
    if($category_data->gubun =="KE"){
    $category_gubun = "국가전문자격";
    }
    else if($category_data->gubun =="KT"){
    $category_gubun = "국가기술자격";
    }
    else if($category_data->gubun =="CZ"){
    $category_gubun = "공인민간자격";
    }     
  ?>

<div class="min-h-100vh">
    <!-- Bg cover -->
    <div class="py-6 bg-primary"></div>
    <!-- <div class="py-6 " style="background: linear-gradient(270deg, #9D4EFF 0%, #782AF4 100%);"></div> -->
    <!-- Page header -->
    <div class="bg-white shadow-sm">
        <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-12">
            <div class="d-md-flex align-items-center justify-content-between bg-white  pt-3 pb-3 pb-lg-5">
                <div class="d-md-flex align-items-center text-lg-left text-center ">
                <div class="mr-3 mt-n8">
                    <img src="<?php echo xss_clean($category_image); ?>" class="avatar-xxl rounded border p-3 bg-white">
                </div>
                <div class="mt-3 mt-md-0">
                    <h1 class="mb-0 font-weight-bold mr-3"><?php echo $category_data->category_title; ?></h1>
            </h1>
                </div>
                <div>
                    <span class="mr-2 font-size-sm"><span class="text-dark-gray font-weight-medium"><?php echo $category_gubun; ?></span>
                </div>
                </div>
                <!-- Dropdown -->
                <div class="mt-3 mt-lg-0 text-lg-left text-center">
                    <!-- <a href="#!" class="text-muted btn-icon btn-light rounded-circle fe fe-bookmark font-size-md"
                    data-toggle="tooltip" data-placement="top" title="Add Bookmarked"></a> -->
                    
                </div>
            </div>

            </div>
        </div>
        </div>
    </div>

  <!-- Content -->
  <div class="py-6 bg-light-gray">
    <div class="container">
      <div class="row">
          <!--### 내용 Left Side Start### -->
          <div class="col-lg-8 col-md-7 col-12 pr-0 pr-md-2">
            <!-- /// 자격증 내용 card S /// -->
            <div class="card mb-4 border">     
                <!-- card header -->
                <div class="card-header px-3 px-lg-5 pt-5 pb-1">
                    <p class="lead mb-0 display-7">자격증 주요 정보</p>
                </div>                           
                <div class="py-3 px-3 px-lg-5 course-container">
                    <?php echo $category_data->category_description; ?>
                </div>
            </div>
            <!-- /// 자격증 내용 card E /// -->  
            <!-- /// 연관 포스트 card S /// -->
            <?php
              if($rel_post_data)
                { ?>
                    <div class="card mb-4 border">   
                        <div class="card-header px-3 px-lg-5 pt-5 pb-1">
                            <p class="lead mb-0 display-7">자격증 연관 콘텐츠</p>
                        </div>                           
                        <div class="row pt-4 pb-0 px-3">
                            <?php
                            $data['blog_list_data'] = $rel_post_data;
                            $this->load->view('small_blog_list',$data);        
                            ?>
                        </div>
                    </div>
            <?php 
                } ?> 
            <!-- /// 관련 포스트 card E /// -->                        
            <!-- /// 강의 card S /// -->
            <?php
              if($category_study_material_data)
                { ?>
                  <div class="card mb-4 border">
                    <!-- card header -->
                    <div class="card-header px-3 px-lg-5 pt-5 pb-1">
                        <p class="lead mb-0 display-7">브리핀 클래스</p>
                    </div> 
                    <!-- card body -->
                    <div class="card-body px-2 py-2">
                        <div class="row mt-1 mb-1">
                        <?php 
                            $data['study_material_list_data'] = $category_study_material_data;
                            $this->load->view('open_material_list',$data); 
                        ?>
                        </div>
                      </div>
                  </div>
            <?php 
                } ?> 
            <!-- /// 강의 card E /// --> 
            <!--////  광고-국비지원강좌 card S //// -->
            <?php
              if($ad_course_list_data)
                { ?>
                  <div class="card mb-4 border">
                    <!-- card header -->
                    <div class="card-header px-3 px-lg-5 pt-5 pb-1">
                        <p class="lead mb-0 display-7">국민내일배움카드 국비지원</p>
                    </div> 
                    <!-- card body -->
                    <div class="card-body px-2 px-lg-4">
                        <div class="mt-1 mb-1">
                        <?php 
                            //이동을 위한 구분값
                            $gubun_param ="category";
                            $data = array('gubun_param' => $gubun_param, 'ad_course_list_data' => $ad_course_list_data);
                            $this->load->view('adcourse_list',$data); 
                        ?>
                        </div>
                      </div>
                    </div>
                <?php 
                } ?>
            <!--////  광고-국비지원강좌 card E //// -->           
            <!--////  무료강좌 card S //// -->
            <?php
              if($free_course_list_data)
                { ?>
                  <div class="card mb-4 border">
                    <!-- card header -->
                    <div class="card-header px-3 px-lg-5 pt-5 pb-1">
                        <p class="lead mb-0 display-7"><?php echo $category_data->category_title; ?> 무료 강의</p>
                    </div> 
                    <!-- card body -->
                    <div class="card-body px-2 px-lg-4">
                        <div class="mt-1 mb-1">
                        <?php 
                            //이동을 위한 구분값
                            $gubun_param ="category";
                            $data = array('gubun_param' => $gubun_param, 'free_course_list_data' => $free_course_list_data);
                            $this->load->view('freecourse_list',$data); 
                        ?>
                        </div>
                      </div>
                    </div>
                <?php 
                } ?>
            <!--////  무료강좌 card E //// -->                    
            <!--////  퀴즈 card S //// -->
            <?php
            if($quiz_data)
            { ?>
                <div class="card mb-4 border">
                <!-- card header -->
                <div class="card-header px-3 px-lg-5 pt-5 pb-1">
                    <p class="lead mb-0 display-7"><?php echo $category_data->category_title; ?> 기출문제</p>
                </div> 
                <!-- card body -->
                <div class="card-body px-2 px-lg-4">
                    <div class="mt-1 mb-1">
                    <?php
                        $data['quiz_list_data'] = $quiz_data;
                        $this->load->view('play_data_list',$data);  
                        ?>
                    </div>
                    </div>
                </div>
            <?php 
            } ?>
            <!--////  퀴즈 card E //// -->
          </div>
          <!--### 내용 Left Side End### -->
          <!--### 사이드 콘텐츠 Right Side Start ### -->
          <div class="col-lg-4 col-md-5 col-12 mt-6 mt-md-0 pl-0 pl-md-2">        
            <!-- ////  자격증 card S //// -->
            <div class="card mb-4 mx-1 border">
                <!-- card header -->
                <div class="card-header px-3 px-lg-5 pt-5 pb-1">
                    <p class="lead mb-0 display-7">주목할만한 자격증</p>
                </div>                  
                <!-- card body -->
                <div class="card-body px-3 px-lg-5 py-4">
                    <div class="mt-1 mb-1">
                    <?php
                        $data['sub_category_data'] = $sub_category_data;
                        $this->load->view('parentcategory_side',$data);        
                        ?>
                    </div>
                </div>
            </div>
            <!-- ////  자격증 card E //// -->
            <!-- ////  오른쪽 사각 광고 card S //// -->
            <div class="card mb-4 mx-1 border-0">
                <div class="card-body px-1 px-lg-2 py-4">
                    <?php $this->load->view('ad_r_square');?>
                </div>
            </div>
            <!-- ////  오른쪽 사각 광고 card E //// -->    
          </div>
          <!--### 사이드 콘텐츠 Right Side End ### -->
      </div>
    </div>
  </div>

</div>  