<?php
    foreach($related_post as $like_post_key => $like_post_value)
    {
        $post_img = (isset($like_post_value->post_image) && !empty($like_post_value->post_image) ? base_url('assets/images/blog_image/post_image/'.$like_post_value->post_image) : base_url('assets/images/blog_default.jpg'));
        if (!next($related_post)){
            $dashbar="px-3";
        }
        else{
            $dashbar="px-0 dash_btmbar";
        }
        ?>
        <div class="row mt-2 mb-3 <?php echo $dashbar?>">
            <div class="col-9 pr-2 pt-0">
                <a href="<?php echo  base_url('blog/').$like_post_value->post_slug ?>" class="text-dark-gray"><p class="font-size-sm lead lh-sm text-truncate-sm-line-2 font-weight-semi-bold py-0 mt-0 mb-1"><?php echo xss_clean($like_post_value->post_title);  ?></p>
                <p class="text-medium-gray font-size-xs lead py-0 my-0">아티클</p>
            </a>
            </div>
            <div class="col-3 relative image-box">
                <a href="<?php echo  base_url('blog/').$like_post_value->post_slug ?>"><img src="<?php echo $post_img?>" alt="" class="image-thumbnail rounded float-end"></a>
            </div>
        </div>
    <?php 
    } 
?>