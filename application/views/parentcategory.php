<?php
    $category_img_dir = base_url("assets/images/category_image/");
?>
<!-- Bg cover -->
<div class="bg-light" style="background:url(/assets/images/pattern/05.png) no-repeat center center; background-size:cover;">
  <div class="container">
    <!-- Hero Section -->
    <div class="row align-items-center no-gutters">
        <div class="col-lg-6 col-md-12 text-center text-lg-left">
            <div class="pt-8 pb-4 pt-lg-0 px-4">
                <h1 class="text-black display-4 font-weight-bold">이제 자기계발의 시간
                </h1>
                <p class="text-black display-8 mb-2 lead px-1">
                  취업과 승진, 이직에 도움이 되는 자격증에 한번 도전해보세요.
                </p>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 text-center pt-5 pb-3">
            <img src="/assets/images/element/category-2.svg" alt="" class="img-fluid w-50" />
        </div>
    </div>
  </div>
</div>
<div class="pt-6 pb-10">
  <div class="container min-h-60vh">
    <div class="row mb-0 py-2">
      <div class="col-12 pl-3">
        <h2 class="lead display-7 pb-0 mb-1">자격증 종류</h2>
        <h4 class="lead display-8 mb-4 font-weight-normal">정보를 알고 싶은 자격증을 선택하세요.</h4>
      </div>
    </div>
    <!-- row -->
    <div class="row mb-4 py-0">
      <?php 
        if($category_child_data)
        { 
          foreach ($category_child_data as $category_array) 
          {
            $category_image = $category_array->category_image ? $category_array->category_image : "default.jpg";
            $category_image_name = $category_image ; 
            $category_image = $category_img_dir.$category_image;

            if(!is_file(FCPATH."assets/images/category_image/".$category_image_name))
            {
              $category_image = base_url('assets/default/default.jpg');
            }
            $category_url = base_url('category/').$category_array->id;          
            $display_on_home = $category_array->display_on_home;
            $category_ext = $category_array->category_ext;
            ?>

            <!-- Action box item -->
            <div class="col-lg-6 position-relative overflow-hidden mt-0 mb-6">
              <div class="bg-primary bg-opacity-10 rounded-3 pt-6 pb-0 pl-8 pr-0 mx-2 h-100">
                <!-- Image -->
                <div class="position-absolute bottom-3 end-0 me-5">
                  <img src="<?php echo xss_clean($category_image);?>" class="h-100px" alt="">
                </div>	
                <!-- Content -->
                <div class="row">
                  <div class="col-sm-6 position-relative">
                    <span class="mb-1 display-6 font-weight-bolder"><?php echo xss_clean($category_array->category_title);?></span>
                    <p class="mb-3 h5 fw-light lead"><?php echo xss_clean($category_ext);?></p>
                    <a href="<?php echo $category_url; ?>" class="btn btn-sm btn-primary mb-6">자세히 알아보기</a>
                  </div>
                </div>
              </div>
            </div>
            <?php 
          }
        }?> 
    </div>
  </div>
</div>