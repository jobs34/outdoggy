<?php 
    $user_id = isset($this->user['id']) ? $this->user['id'] : 0;
    $data['paid_quizes_array'] = $paid_quizes_array;
    $data['paid_s_m_array'] = $paid_s_m_array;
    $category_img_dir = base_url("assets/images/category_image/");
    $category_image = $category_data->category_image ? $category_data->category_image : "default.jpg";
    $category_image = $category_img_dir.$category_image;
  ?>
<!-- Page header -->
<div class="bg-dark-slate-blue">
    <div class="container pt-8 pb-2 pl-0 pr-0 pr-md-8">
        <!-- Heading -->
        <div class="text-center mb-9">
            <h1 class="text-light-gray display-3"><?php echo $category_data->category_title; ?></h1>
        </div>
        <!-- End Heading -->
        <div class="row mb-2 mb-md-4">
          <div class="col-md-5 mb-5 mb-md-0">
            <div class="text-center">
              <img src="<?php echo xss_clean($category_image); ?>" alt="" class="img-fluid pt-2 px-6 mb-3" style="max-width: 15rem;">
                <div class="mb-4 text-primary font-weight-bold display-4">기출문제</div>
            </div>
            
          </div>
          <!-- End Col -->
          <div class="col-md-7">
            <?php
              if($quiz_data)
              { ?>
                <div class="mt-1 mb-1">
                  <?php
                    $data['quiz_list_data'] = $quiz_data;
                    $this->load->view('play_data_list',$data);  
                    ?>
                </div>
                <?php 
                } ?>
          </div>
          <!-- End Col -->
        </div>
        <!-- End Row -->
    </div>
</div>
  
<!-- Content 1. 클래스-->
<?php if($category_study_material_data)
    { ?>
    <div class="pt-6 pb-2 bg-dark-slate-blue">
        <div class="container">
            <div class="row mt-1 mb-1">
              <?php 
                $data['study_material_list_data'] = $category_study_material_data;
                $this->load->view('open_material_list',$data); 
              ?>
              </div>
          </div>
      </div>
<?php } ?> 
<!-- Content 2. 국비지원/무료 강좌-->
<?php if($ext_course_list_data)
    { ?>
    <div class="pt-6 pb-2">
        <div class="container">
            <div class="row mt-1 mb-1">
              <?php 
                //이동을 위한 구분값
                $gubun_param ="subcate";
                //$data['ext_course_list_data'] = $ext_course_list_data;
                $data = array('gubun_param' => $gubun_param, 'ext_course_list_data' => $ext_course_list_data);
                $this->load->view('extcourse_list',$data); 
              ?>
              </div>
          </div>
      </div>
<?php } ?> 
<!-- Content 3. 안내-->
<div class="pt-6 pb-2 px-3 px-lg-0">
    <div class="container">
        <div class="row justify-content-sm-center" id="category_body">
            <div class="col-sm-12 col-md-10 col-lg-8">
                <!-- <h2 class="text-black font-weight-bold">시험안내 / 준비방법</h2>-->
                <?php echo $category_data->category_description; ?>
            </div>
        </div>
    </div>
</div>
<!-- Content 4. 연관 포스팅-->
<div class="pt-8 pb-8">
    <div class="container">
        <div class="row mt-1 mb-1">
            <?php
              $data['blog_list_data'] = $rel_post_data;
              $this->load->view('common_blog_list',$data);        
              ?>
          </div>
    </div>
</div>