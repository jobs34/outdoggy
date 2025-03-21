<?php
    $category_img_dir = base_url("assets/images/category_image/");
?>          
<div class="pt-8 pb-10 pt-lg-12 pb-lg-18 bg-light">
    <div class="container min-h-100vh">
      <div class="row mb-8 justify-content-center">
        <div class="col-lg-8 col-md-12 col-12 text-center">
          <!-- caption -->
          <span class="text-primary mb-1 d-block text-uppercase font-weight-semi-bold ls-xl">certificate guide</span>
          <h1 class="mb-2 display-4 font-weight-bold"><?php echo lang('categories') ?></h1>
        </div>
      </div>
      <!-- row -->
      <div class="row">
        <?php 
          if($category_vip_data)
          { 
            foreach ($category_vip_data as $category_array) 
            {
              $category_image = $category_array->category_image ? $category_array->category_image : "default.jpg";
              $category_image_name = $category_image ; 
              $category_image = $category_img_dir.$category_image;

              if(!is_file(FCPATH."assets/images/category_image/".$category_image_name))
              {
                $category_image = base_url('assets/default/default.jpg');
              }
              $category_url = base_url('subcate/').$category_array->id;
              $category_description = $category_array->category_description;
              $display_on_home = $category_array->display_on_home;

              ?>
              <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                <!-- Card -->
                <div class="card mb-8 shadow-lg">
                  <div class="row no-gutters">
                    <!-- Image -->
                    <a href="<?php echo $category_url; ?>" class="col-lg-6 col-md-12 col-12 bg-primary img-left-rounded pl-3 pl-lg-10 pt-6 pt-lg-14" style="background: url(<?php echo base_url()?>assets/images/profile-bg.jpg) no-repeat;background-size: inherit;background-position-x: right;">
                      <img src="<?php echo xss_clean($category_image); ?>" class="px-5 px-lg-0 img-fluid-test-result"></a>
                    <div class="col-lg-6 col-md-12 col-12">
                      <!-- Card body -->
                      <div class="card-body p-4 p-lg-6">
                         <a href="<?php echo $category_url; ?>" class="text-inherit"><h1 class="font-weight-bold mt-3 mb-4"><?php echo xss_clean($category_array->category_title);?></h1>
                          </a>
                        <p><?php echo iconv_substr(strip_tags($category_array->category_description),0, 80, "utf-8");?>...</p>
                        <a href="<?php echo $category_url; ?>" class="btn btn-outline-primary px-4 py-2 mt-2 mb-2">자격증 정보</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          <?php 
            }
          }
          if($category_data)
          { 
            foreach ($category_data as $category_array) 
            {
              $category_image = $category_array->category_image ? $category_array->category_image : "default.jpg";
              $category_image_name = $category_image ; 
              $category_image = $category_img_dir.$category_image;

              if(!is_file(FCPATH."assets/images/category_image/".$category_image_name))
              {
                $category_image = base_url('assets/default/default.jpg');
              }
              $category_url = base_url('subcate/').$category_array->id;
              $category_description = $category_array->category_description;
              $display_on_home = $category_array->display_on_home;
              ?>

                <div class="col-xl-4 col-lg-6 col-md-6 col-12">
                  <!-- Card -->
                  <div class="card mb-4 card-hover">
                    <div class="d-flex justify-content-between align-items-center p-4">
                      <div class="d-flex">
                        <a href="<?php echo $category_url; ?>">
                          <!-- Img -->
                          <img src="<?php echo xss_clean($category_image); ?>" alt="" class="bg-sunglow icon-shape icon-xxl rounded-circle" /></a>
                        <div class="ml-3">
                          <a href="<?php echo $category_url; ?>" class="text-inherit"><h3 class="font-weight-bold mt-1 mb-1"><?php echo xss_clean($category_array->category_title);?></h3>
                          </a>
                          <a href="<?php echo $category_url; ?>" class="btn btn-outline-primary btn-sm px-3 py-2 mt-1">자격증 정보</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>                

              <?php 
            }
          }
          else
          { ?>

            <div class="col-12 text-center mt-5">
              <h3 class="text-danger mt-5"><?php echo lang('no_category_found_in')." "; ?>
              <span class="text-warning"><?php echo $category_data->category_title; ?></span>
                
              </h3>
            </div>

            <?php
          }?> 

      </div>
    </div>
  </div>