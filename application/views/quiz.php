<?php 
    $user_id = isset($this->user['id']) ? $this->user['id'] : 0;
    $data['is_premium_member'] = $is_premium_member;
    $data['paid_quizes_array'] = $paid_quizes_array;
    $data['paid_s_m_array'] = $paid_s_m_array;
    $category_img_dir = base_url("assets/images/category_image/");
    $category_image = $category_data->category_image ? $category_data->category_image : "default.jpg";
    $category_image_name = $category_image ; 
    $category_image = $category_img_dir.$category_image;
    $category_main_url = base_url("all-categories/");
  ?>
<div class="min-h-100vh">
  <!-- Page header -->
  <div class="bg-primary">
    <div class="container">
      <!-- row -->
      <div class="row align-items-center no-gutters">
        <div class="col-xl-5 col-lg-5 col-md-12">
          <!-- heading -->
          <div class="pt-8 pt-lg-0 text-lg-left text-center">
            <p class="text-white-50 font-size-sm mb-0 lead pl-lg-1">
            <a href="<?php echo $category_main_url; ?>" class="text-white">자격증</a> &gt; <?php echo $category_data->category_title; ?>
            </p>
            <h1 class="text-white font-weight-bold pr-lg-8"><?php echo $category_data->category_title; ?>
            </h1>
          </div>
        </div>
        <!-- img -->
        <div class=" col-xl-7 col-lg-7 col-md-12 text-center pt-6">
          <img src="<?php echo xss_clean($category_image); ?>" alt="" class="avatar-monster">
        </div>
      </div>
    </div>
  </div>
  <!-- Content -->
  <div class="py-6 bg-light-gray">
    <div class="container">
      <div class="row">
          <!--### 내용 Left Side Start### -->
          <div class="col-lg-8 col-md-7 col-12">
              <!--////  퀴즈 card S //// -->
              <?php
              if($quiz_data)
                { ?>
                  <div class="card mb-4 border">
                    <!-- card header -->
                    <div class="card-header px-3 px-lg-5 pt-3 pb-2">
                        <p class="lead mb-0 display-7">기출문제</p>
                      </div>
                    <!-- card body -->
                    <div class="card-body px-2 px-lg-3">
                        <div class="mb-1">
                          <?php
                            $data['quiz_list_data'] = $quiz_data;
                            $this->load->view('quiz_data_list',$data);  
                            ?>
                        </div>
                        <div class="mb-2 px-3 px-lg-5 py-2">
                            <?php echo xss_clean($pagination) ?>
                        </div>
                      </div>
                    </div>
                <?php 
                } ?>
              <!--////  퀴즈 card E //// -->
              <!-- /// 강의 card S /// -->
              <?php
              if($category_study_material_data)
                { ?>
                  <div class="card mb-4 border">
                    <!-- card header -->
                    <div class="card-header px-3 px-lg-5 pt-3 pb-2">
                        <p class="lead mb-0 display-7">강의</p>
                      </div>
                    <!-- card body -->
                    <div class="card-body px-3 px-lg-5 py-5">
                        <div class="row mt-1 mb-1">
                          <?php 
                            $data['study_material_list_data'] = $category_study_material_data;
                            $this->load->view('study_material_data_list',$data); 
                          ?>
                          </div>

                      </div>
                  </div>
              <?php 
                  } ?> 
              <!-- /// 강의 card E /// -->            
              <!-- /// 자격증 내용 card S /// -->
              <div class="card mb-4 border">
                <div class="row py-6 pl-4 pr-4 pl-lg-6 pr-lg-6" id="category_body">
                  <?php echo $category_data->category_description; ?>
                </div>
              </div>
              <!-- /// 자격증 내용 card E /// -->
          </div>
          <!--### 내용 Left Side End### -->
          <!--### 사이드 콘텐츠 Right Side Start ### -->
          <div class="col-lg-4 col-md-5 col-12 mt-6 mt-md-0">
              <!-- ////  포스트 card S //// -->
              <div class="card mb-4 border">
                <!-- card header -->
                <div class="card-header px-3 px-lg-5 pt-3 pb-2">
                    <p class="lead mb-0 display-7">포스트</p>
                  </div>                   
                <!-- card body -->
                <div class="card-body px-3 px-lg-5 py-5">
                  <div class="mt-1 mb-1">
                    <?php
                      $data['blog_list_data'] = $rel_post_data;
                      $this->load->view('common_blog_list_side',$data);        
                      ?>
                  </div>
                </div>
              </div>
              <!-- ////  포스트 card E //// -->
              <!-- ////  광고 card S //// -->
              <?php 
              if($category_data->category_ext) {
                ?>
                  <div class="card mb-4 border">
                    <!-- card body -->
                    <div class="card-body px-3 px-lg-5 py-5">
                      <div class="mt-1 mb-1">
                        <?php echo $category_data->category_ext; ?>
                      </div>
                    </div>
                  </div>
              <?php  
                }
                ?>
              <!-- ////  광고 card E //// -->
          </div>
          <!--### 사이드 콘텐츠 Right Side End ### -->
      </div>
    </div>
  </div>

</div>  