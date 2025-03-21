<?php if($blog_list_data) {
   foreach($blog_list_data as $like_post_key => $like_post_value)
   {
?>
  <div class="col-lg-3 col-6 p-1 pb-3">
    <!-- Card -->
    <div class="mb-3 mb-lg-5 mx-1 mx-lg-2">
      <a href="<?php echo  base_url('blog/').$like_post_value->post_slug ?>">
        <!-- Img  -->
        <?php
           $blog_post_image = (isset($like_post_value->post_image) && !empty($like_post_value->post_image) ? base_url('assets/images/blog_image/post_image/'.$like_post_value->post_image) : base_url('assets/images/blog_image/default.jpg'));
        ?>
        <img src="<?php echo xss_clean($blog_post_image);?>" class="card w-100" alt=""></a>
      <!-- Card body -->
      <div class="px-1 px-md-2 py-3 py-md-2">

        <!-- 글 표시 영역-->
        <div class="row d-none d-md-block no-gutters">
          <a href="<?php echo  base_url('blog/list/').$like_post_value->blog_category_slug ?>" class="font-size-sm text-sunglow"><?php echo xss_clean($like_post_value->title);  ?></a>
        </div>
        <div class="row min-h-80px pt-2 no-gutters">
          <h5><a href="<?php echo  base_url('blog/').$like_post_value->post_slug ?>" class="text-inherit">
              <?php echo xss_clean($like_post_value->post_title);  ?>
            </a>
          </h5>
        </div>
      </div>
    </div>
  </div>

<?php } }
	else {
?>
  <div class="col-12 text-center"> 
            <div class="row align-items-center justify-content-center no-gutters py-lg-8 py-6">
                <div class="col-12 text-center">
                    <p class="mb-5 lead font-weight-semi-bold text-medium-gray">포스트가 존재하지 않습니다.</p>
                </div>
                <div class="col-10 col-md-8 col-lg-6 mt-2 mb-4"  id="article_body">
                    <img src="<?php echo base_url()?>assets/images/empty_lime.png" alt="" class="px-12" />
                </div>       
            </div>
    </div>
<?php } ?>
