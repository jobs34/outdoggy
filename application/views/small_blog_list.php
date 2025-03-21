<?php if($blog_list_data) {
   foreach($blog_list_data as $like_post_key => $like_post_value)
   {
    $text = strip_tags($like_post_value->post_description);
    $strim = mb_strimwidth($text, '0', '80', '..', 'utf-8');
    $updated = $like_post_value->updated;
    $added = date('Y.m.d',strtotime($like_post_value->added));
    $post_slug = $like_post_value->post_slug;
    $post_title = $like_post_value->post_title;

  ?>
  <!-- Card item START -->
  <div class="col-lg-3 col-6 px-2 pb-2">
  <a href="<?php echo  base_url('blog/').$post_slug ?>">
    <div class="card bg-transparent border-0">
      <div class="overflow-hidden rounded-3">
        <!-- Img  --> 
          <?php
           $blog_post_image = (isset($like_post_value->post_image) && !empty($like_post_value->post_image) ? base_url('assets/images/blog_image/post_image/'.$like_post_value->post_image) : base_url('assets/images/blog_image/default.jpg'));
          ?>
          <img src="<?php echo xss_clean($blog_post_image);?>" class="card-img mb-0" alt="course image">
        <!-- Overlay -->
        <div class="bg-overlay bg-dark opacity-2"></div>
        <div class="card-img-overlay d-flex align-items-start p-3">
        </div>
      </div>
      <!-- Card body -->
      <div class="card-body p-3">
        <!-- Title -->
        <p class="card-title font-weight-medium"><?php echo xss_clean($post_title); ?></p>
      </div>
    </div>
  </a>
  </div>
  <!-- Card item END -->

<?php } }
	else {
?>
  <div class="col-12 text-center"> 
            <div class="row align-items-center justify-content-center no-gutters py-3">
                <div class="col-12 text-center">
                    <p class="mb-2 lead font-weight-semi-bold text-medium-gray">포스트가 존재하지 않습니다.</p>
                </div>
                <div class="col-10 col-md-8 col-lg-6 mt-2 mb-4"  id="article_body">
                    <img src="<?php echo base_url()?>assets/images/empty_lime.png" alt="" class="px-14" />
                </div>       
            </div>
    </div>
<?php } ?>
