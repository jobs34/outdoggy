<?php
    foreach($related_post as $like_post_key => $like_post_value)
    {
        $post_img = (isset($like_post_value->post_image) && !empty($like_post_value->post_image) ? base_url('assets/images/blog_image/post_image/'.$like_post_value->post_image) : base_url('assets/images/blog_default.jpg'));
        if (!next($related_post)){
            $dashbar="px-4";
        }
        else{
            $dashbar="dash_btmbar";
        }
        ?>
        <div class="row mt-2 mb-3 <?php echo $dashbar?>">
            <div class="col-3">
                <a href="<?php echo  base_url('blog/').$like_post_value->post_slug ?>"><img src="<?php echo $post_img?>" alt="" class="w-100 img-fluid text-end"></a>
            </div>
            <div class="col-9 pl-2 pt-0">
                <a href="<?php echo  base_url('blog/').$like_post_value->post_slug ?>" class="text-black"><p class="font-size-sm lead lh-sm text-truncate-line-2"><?php echo xss_clean($like_post_value->post_title);  ?></p></a>
            </div>

        </div>
    <?php 
    } 
?>