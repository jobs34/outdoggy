<?php
    foreach($related_cground as $like_post_key => $like_post_value)
    {
        $cg_img = (isset($like_post_value->image) && !empty($like_post_value->image) ? base_url('assets/images/studymaterial/'.$like_post_value->image) : base_url('assets/images/blog_default.jpg'));
        if (!next($related_cground)){
            $dashbar="px-3";
        }
        else{
            $dashbar="px-0 dash_btmbar";
        }
        ?>
        <div class="row mt-2 mb-3 <?php echo $dashbar?>">
            <div class="col-8 pr-4 pt-1">
                <a href="<?php echo  base_url('cgrounds/').$like_post_value->id ?>" class="text-dark-gray"><p class="lh-sm font-weight-semi-bold py-0 mt-0 mb-1"><?php echo xss_clean($like_post_value->title);  ?></p>
                <p class="text-medium-gray font-size-xs lead py-0 my-0"><?php echo xss_clean($like_post_value->category_title);  ?></p>
            </a>
            </div>
            <div class="col-4 relative image-box">
                <a href="<?php echo  base_url('cgrounds/').$like_post_value->id ?>"><img src="<?php echo $cg_img?>" alt="" class="image-thumbnail rounded float-end"></a>
            </div>
        </div>
    <?php 
    } 
?>