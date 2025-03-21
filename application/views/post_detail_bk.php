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
<!-- 빵조각 -->
<div class="container-lg px-4 py-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/" class="bread-anc">홈</a></li>
        <li class="breadcrumb-item"><a href="/blog/list/all" class="bread-anc">매거진</a></li>
        <li class="breadcrumb-item"><a href="/blog/list/<?php echo $category_slug?>" class="bread-anc"><?php echo $category_title?></a></li>
        <li class="breadcrumb-item active" aria-current="page">내용 보기</li>
      </ol>
    </nav>
</div>
<!-- Page content-->
<div class="pb-4 min-h-100vh">
    <div class="container">
        <div class="row px-2">
            <div class="col-lg-8 col-md-12 col-12 pt-0 mb-4 px-0" id="article_body">
                <div class="card border-0 pb-0 mb-0 px-1 px-lg-3 pt-0 pb-6">
                    <!-- 콘텐츠명 -->
                    <div class="pb-0 mb-0 px-0">
                        <h1 class="pb-0 px-1 mb-3">
                            <?php echo xss_clean($post_detail_data->post_title); ?>
                        </h1>
                    </div> 
                    <!-- 추가 날짜 -->
                    <div class="mb-4 px-3 font-size-xs text-medium-gray">
                        <span class="mr-2">Updated.</span> <span class="font-weight-bold"><?php echo $updated_date; ?></span>
                    </div>
                    <!-- 요약 내용 -->
                    <div class="mb-2 px-3">
                        <p class="lead text-black font-weight-medium category_start">
                            <?php echo $meta_description; ?>
                        </p>
                    </div>                                
                    <!-- Image -->
                    <div class="mb-6 px-2">
                        <img src="<?php echo $header_background?>" alt="" class="img-fluid rounded-lg">
                    </div>
                    <!-- Descriptions -->
                    <div class="min-h-400px px-3">
                        <?php echo $post_description; ?>
                    </div>
                </div>    
                <!-- ////  관련 콘텐츠 S //// -->
                <?php
                if ($related_post) {
                ?>
                <div class="card border-0 my-4 mx-0 px-1 px-lg-4 py-2 py-lg-4">
                    <!-- card header -->
                    <div class="px-2 pt-3 pb-0">
                        <p class="lead mb-4 display-5">다른 콘텐츠 보기</p>
                    </div>                  
                    <!-- card body -->
                    <div class="card-body px-3 py-3">
                        <div class="mt-1 mb-1">
                        <?php
                            $data['related_post'] = $related_post;
                            $this->load->view('common_blog_list_bottom',$data);        
                            ?>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
            <div class="col-lg-4 col-md-12 col-12 pt-0">    
                <!-- ////  오른쪽 연관 상품 광고 card S //// -->
                <div class="card border-1 mb-3 mx-1 px-1 pt-3 pb-2">
                    <div class="px-1 py-0 text-center">
                        <?php echo $lecture_category->category_ext ?>
                    </div>
                </div>
                <!-- ////  오른쪽 연관 상품 광고 card E //// --> 
                <!-- ////  오른쪽 카테고리 최신 포스트 S //// -->
                <div class="card border-1 mb-3 mx-1 px-3 py-2">
                    <!-- card header -->
                    <div class="card-header px-2 pt-3 pb-0">
                        <p class="display-8 mb-4">카테고리 최신 포스트</p>
                    </div>  
                    <div class="card-body px-1 py-2">
                        <?php
                            $data['new_post'] = $new_post;
                            $this->load->view('new_blog_list_side',$data);        
                            ?>
                    </div>
                </div>
                <!-- ////  오른쪽 인기 포스트 1 E //// -->   
                <!-- ////  오른쪽 광고 card 사용안함
                <div class="card border-0 mb-4 mx-1 px-3 py-4">
                    <div class="px-1 py-1 text-center">
                        <?php //$this->load->view('ad_r_square');?>
                    </div>
                </div>
                 ////  오른쪽 광고 card E  //// -->   
            </div>
        </div>                
    </div>
</div>