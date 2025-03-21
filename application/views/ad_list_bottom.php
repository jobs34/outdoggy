<?php
    foreach($adproduct_data as $like_post_key => $like_post_value)
    {
        $product_img = (isset($like_post_value->image) && !empty($like_post_value->image) ? base_url('assets/images/advertisment/'.$like_post_value->image) : base_url('assets/images/blog_default.jpg'));
        if (!next($adproduct_data)){
            $dashbar="px-3";
        }
        else{
            $dashbar="px-0 dash_btmbar";
        }
        ?>
        <div class="row mt-0 mb-3 <?php echo $dashbar?>">
            <div class="col-6">
                <a href="<?php echo  $like_post_value->url ?>" target="_blank"><img src="<?php echo $product_img?>" alt="" class="w-100 img-fluid text-end"></a>
            </div>
            <div class="col-6  pl-2 pl-md-4 pt-2 pt-md-3">
                <div class="font-weight-bold display-7 lh-sm mb-3 py-0">
                    <a href="<?php echo  $like_post_value->url ?>" class="text-black" target="_blank">📦 <?php echo xss_clean($like_post_value->title); ?></a>
                </div>
                <div class="lh-sm mb-5 py-0">
                    <a href="<?php echo  $like_post_value->url ?>" class="text-black" target="_blank"><?php echo $like_post_value->description; ?></a>
                </div>     
                <div class="lh-sm mb-0 py-0">
                    <a href="<?php echo  $like_post_value->url ?>" class="ext_link font-size-sm" target="_blank">상품 정보 확인하기</a>
                </div>                          
            </div>
        </div>
    <?php 
    } 
?>