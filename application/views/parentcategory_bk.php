<?php
    $category_img_dir = base_url("assets/images/category_image/");
?>
<!-- Bg cover -->
<div class="bg-primary">
  <div class="container">
    <!-- Hero Section -->
    <div class="row align-items-center no-gutters">
        <div class="col-lg-6 col-md-12 text-center text-lg-left">
            <div class="pt-8 pb-4 pt-lg-0 px-4">
                <h1 class="text-white display-4 font-weight-bold">이제 자기계발의 시간
                </h1>
                <p class="text-white display-8 mb-2 lead px-1">
                  취업과 승진, 이직에 도움이 되는 자격증에 한번 도전해보세요.
                </p>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 text-center p-4">
            <img src="/assets/images/intro/newbg02.png" alt="" class="img-fluid w-75" />
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
            $category_gubun = "";
            if($category_array->gubun =="KE"){
              $category_gubun = "국가전문자격";
            }
            else if($category_array->gubun =="KT"){
              $category_gubun = "국가기술자격";
            }
            else if($category_array->gubun =="CZ"){
              $category_gubun = "공인민간자격";
            }              
            $display_on_home = $category_array->display_on_home;
            ?>
              <div class="col-6 col-lg-3 mb-3 mb-md-0">  
                  <div class="card border-light-secondary mb-2 mb-md-6 mx-2">
                    <a href="<?php echo $category_url; ?>">
                      <div class="bg-soft-warning">
                          <div class="text-center pt-4 pb-2">
                            <img src="<?php echo xss_clean($category_image);?>" alt="" class="border border-light-secondary icon-shape icon-xxl rounded-circle bg-white p-2">
                          </div>
                          <div class="text-center pt-0 pb-2 m-0">
                            <div class="mt-2 mb-1 display-8 text-black lead">
                              <?php echo xss_clean($category_array->category_title);?>
                            </div>    
                            <div class="pt-0 mb-2 font-weight-bold font-size-sm text-dark-gray lead">
                              <?php echo xss_clean($category_gubun);?>
                            </div>                                
                          </div>
                      </div>
                    </a>
                  </div>        
              </div>
            <?php 
          }
        }?> 
    </div>
  </div>
</div>