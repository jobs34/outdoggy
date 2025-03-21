<?php
$header_background = (isset($post_detail_data->post_image) && !empty($post_detail_data->post_image) ? base_url('assets/images/blog_image/post_image/'.$post_detail_data->post_image) : base_url('assets/images/blog_default.jpg'));
$category_slug = $post_detail_data->category_slug;
$category_title = $post_detail_data->title;
$author_name = $post_detail_data->first_name."".$post_detail_data->last_name;
$added_date = date('Y.m.d',strtotime($post_detail_data->added));
$updated_date = date('Y.m.d',strtotime($post_detail_data->updated));
$auth_avatar = (isset($post_detail_data->avatar) && !empty($post_detail_data->avatar) ? base_url('assets/images/user_image/'.$post_detail_data->avatar) : base_url('assets/images/avatar_common01.png'));
$post_description = $post_detail_data->post_description;
$meta_description = $post_detail_data->meta_description;
?>
<!-- Page content-->
<div class="pb-4 min-h-100vh">
    <div class="container">
        <div class="row px-2 pt-6">
            <div class="col-lg-8 col-md-12 col-12 pt-0 mb-4 px-0">
                <div class="card border-0 pb-0 mb-0 px-1 px-lg-3 pt-0 pb-2" id="article_body">
                    <!-- Image -->
                    <div class="mb-4 px-2">
                        <img src="<?php echo $header_background?>" alt="" class="img-fluid rounded-lg">
                    </div> 
                    <!-- 카테고리 -->
                    <div class="mb-2 px-2">
                        <a href="/blog/list/<?php echo $category_slug?>"><span class="badge badge-light-secondary badge-pill px-3 py-2"><?php echo $category_title; ?></span></a>
                    </div>                                        
                    <!-- 콘텐츠명 -->
                    <div class="pb-0 mb-0 px-0">
                        <h1 class="pb-0 px-1 mb-4">
                            <?php echo xss_clean($post_detail_data->post_title); ?>
                        </h1>
                    </div> 
                    <!-- 추가 날짜 -->
                    <div class="mb-3 px-3 font-size-sm text-medium-gray">
                        <span class="mr-1">📅</span><span class="mr-2">Updated.</span><span><?php echo $updated_date; ?></span>
                    </div>
                    <!-- 요약 내용 -->
                     <?php if ($meta_description) {?>
                        <div class="mt-2 mb-0 px-3">
                            <p class="lead text-black font-weight-medium category_start">
                                <?php echo $meta_description; ?>
                            </p>
                        </div>   
                     <?php   }?> 
                                              
                    <!-- Descriptions -->
                    <div class="dash_btmbar mb-4"></div>    
                    <div class="min-h-400px px-3">
                        <?php echo $post_description; ?>
                    </div>
                </div>
                <!-- 상품 광고 -->
                <?php
                if ($adproduct_data) {
                ?>
                <div class="card border-0 pb-0 mb-0 px-1 px-lg-3 pt-0 pb-2">        
                    <!-- Descriptions -->
                    <div class="dash_btmbar mb-4"></div>    
                    <div class="px-3">
                        <?php
                            $data['adproduct_data'] = $adproduct_data;
                            $this->load->view('ad_list_bottom',$data);    
                            ?>
                    </div>
                </div>
                <?php
                }
                ?>                 
            </div>
            <div class="col-lg-4 col-md-12 col-12 pt-0" id="side_body">    
                <!-- ////  오른쪽 연관 포스트 S //// -->
                <div class="card border-1 mb-3 mx-1 px-3 py-2">
                    <!-- card header -->
                    <div class="card-header px-2 pt-2 pb-0">
                        <p class="mb-2 font-size-mid-lg font-weight-semi-bold text-dark-gray">📝 비슷한 주제의 글</p>
                    </div>  
                    <div class="card-body px-1 py-2">
                        <?php
                            $data['related_post'] = $related_post;
                            $this->load->view('rel_blog_list_side',$data);        
                            ?>
                    </div>
                </div>                 
                <!-- ////  오른쪽 카테고리 상품 광고 card S //// -->
                <div class="card border-1 mb-3 mx-1 px-1 pt-3 pb-2">
                    <div class="px-1 py-0 text-center">
                        <?php echo $lecture_category->category_ext ?>
                    </div>
                </div>
                <!-- ////  오른쪽 연관 상품 광고 card E //// --> 
            </div>
        </div>                
    </div>
    <div class="container">
        <div class="row px-2 pt-0">
            <div class="col-lg-8 col-md-12 col-12 pt-0 mb-4 px-0">
                <!-- ////  관련 콘텐츠 S //// -->
                <?php
                if ($related_post) {
                ?>
                <div class="card border-0 my-4 mx-0 px-1 px-lg-6 py-2" id="contents_body">
                    <!-- card header -->
                    <div class="dash_btmbar mb-4"></div>   
                    <div class="px-2 pt-0 pb-0">
                        <p class="lead mb-4 display-7">최신 콘텐츠</p>
                    </div>                  
                    <!-- card body -->
                    <div class="card-body px-3 py-3">
                        <div class="mt-1 mb-1">
                        <?php
                            $data['new_post'] = $new_post;
                            $this->load->view('new_blog_list_bottom',$data);        
                            ?>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
            <div class="col-lg-4 col-md-12 col-12 pt-0">
            </div>
        </div>                
    </div>    
</div>