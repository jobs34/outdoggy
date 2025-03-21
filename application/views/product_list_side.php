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
        <div class="row mt-2 mb-3 <?php echo $dashbar?>">
            <div class="col-8 pr-2 pt-0">
                <a href="<?php echo  base_url('blog/').$like_post_value->post_slug ?>" class="text-black"><p class="font-size-sm lead lh-sm text-truncate-line-2"><?php echo xss_clean($like_post_value->post_title);  ?></p></a>
            </div>
            <div class="col-4">
                <a href="<?php echo  base_url('blog/').$like_post_value->post_slug ?>"><img src="<?php echo $post_img?>" alt="" class="rounded-3 w-100 img-fluid text-end"></a>
            </div>
        </div>
    <?php 
    } 
?>