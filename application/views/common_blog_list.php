<?php 
if($blog_list_data) {
   foreach($blog_list_data as $like_post_key => $like_post_value)
   {
    $meta_description = $like_post_value->meta_description;
    $post_description = strip_tags($like_post_value->post_description);
    if(empty($meta_description))
    {
      $strim = mb_strimwidth($post_description, '0', '140', '..', 'utf-8');
    }
    else{
      $strim = mb_strimwidth($meta_description, '0', '140', '..', 'utf-8');
    }
    $added = date('Y.m.d',strtotime($like_post_value->added));
    $updated = date('Y.m.d',strtotime($like_post_value->updated));
    $post_slug = $like_post_value->post_slug;
    $post_title = $like_post_value->post_title;
    $blog_category_id = $like_post_value->blog_category_id;
    $category_title = $like_post_value->title;
    $rel_name = $like_post_value->rel_name;
    $auth_name = $like_post_value->first_name;
  ?>
  <!-- Card item START -->
  <div class="col-12 col-md-4 px-3 pb-6">
    <div class="card bg-transparent border-0">
      <a href="<?php echo  base_url('blog/').$post_slug ?>">
      <div class="overflow-hidden rounded-3">
        <!-- Img  --> 
          <?php
           $blog_post_image = (isset($like_post_value->post_image) && !empty($like_post_value->post_image) ? base_url('assets/images/blog_image/post_image/'.$like_post_value->post_image) : base_url('assets/images/blog_image/default.jpg'));
          ?>
          <img src="<?php echo xss_clean($blog_post_image);?>" class="card-img" alt="course image">
        <!-- Overlay -->
        <div class="bg-overlay bg-dark opacity-2"></div>
        <div class="card-img-overlay d-flex align-items-start p-4">
          <!-- badge -->
          <span class="badge badge-dark font-weight-bolder font-size-md text-white px-3 px-md-4 opacity-7"><?php echo $category_title; ?></span>
        </div>
      </div>
      </a>
      <!-- Card body -->
      <div class="card-body py-3 px-2">
        <!-- Title -->
        <h2 class="post-title mb-2 mb-md-3"><a href="<?php echo  base_url('blog/').$post_slug ?>" class="font-weight-bold text-black"><?php echo xss_clean($post_title); ?></a></h2>
        <p class="text-truncate-2 no-gutters lh-sm font-size-sm text-dark-gray"><?php echo xss_clean($strim); ?></p>
        <!-- Info -->
        <div class="d-flex justify-content-between">
          <span class="font-size-xs text-dark-gray mb-0">Updated</span>
          <span class="font-size-xs text-dark-gray font-weight-bold"><?php echo $updated; ?></span>
        </div>
      </div>
    </div>
  </div>
  <!-- Card item END -->

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