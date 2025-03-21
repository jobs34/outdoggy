<?php
    foreach($new_post as $like_post_key => $like_post_value)
    {
        $post_img = (isset($like_post_value->post_image) && !empty($like_post_value->post_image) ? base_url('assets/images/blog_image/post_image/'.$like_post_value->post_image) : base_url('assets/images/blog_default.jpg'));
        if (!next($new_post)){
            $dashbar="px-3";
        }
        else{
            $dashbar="px-0 dash_btmbar";
        }
        ?>
        <div class="row mt-0 mb-3 <?php echo $dashbar?>">
            <div class="col-5 col-md-3">
                <a href="<?php echo  base_url('blog/').$like_post_value->post_slug ?>"><img src="<?php echo $post_img?>" alt="" class="w-100 img-fluid text-end"></a>
            </div>
            <div class="col-7 col-md-9 pl-1 pl-md-4 pt-0 pt-md-2">
                <a href="<?php echo  base_url('blog/').$like_post_value->post_slug ?>" class="text-black"><p class="lead font-weight-bold lh-sm"><?php echo xss_clean($like_post_value->post_title);  ?></p></a>
            </div>

        </div>
    <?php 
    } 
?>