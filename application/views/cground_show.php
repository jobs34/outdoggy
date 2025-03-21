<?php 
    $s_m_id = $ext_course_data->id;
    $category_id = $category_data->id;
    $category_title = $category_data->category_title;
    $category_slug = $category_data->category_slug;
    $theme_name = $inst_data->title;
    $meta_description = $ext_course_data->url;
    $description = $ext_course_data->description;

    $category_url = base_url("/campground/").$category_slug;
    
    $current_sm_image = $ext_course_data->image ? $ext_course_data->image : "default_ext_course.jpg";
    $current_detail_image = base_url("assets/images/studymaterial/").$current_sm_image;
    if(!is_file(FCPATH."assets/images/studymaterial/".$current_sm_image))
    {
        $current_detail_image = base_url("assets/images/studymaterial/default_ext_course.jpg"); 
    }  
    $study_m_title = $ext_course_data->title;
    $is_premium = ($ext_course_data->is_premium=="1" ? "링크 모음" : "장소 안내");
    $view_real_url = $ext_course_data->url;
?>
<!-- Page content-->
<script async src="https://platform.instagram.com/en_US/embeds.js"></script>
<div class="pb-4 min-h-100vh">
    <div class="container">
        <div class="row px-2 pt-6">
            <div class="col-lg-8 col-md-12 col-12 pt-0 mb-4 px-0">
                <div class="card border-0 pb-0 mb-0 px-1 px-lg-3 pt-0 pb-2" id="content_body">
                    <!-- 소개 이미지 -->
                    <!--PC--> 
                    <div class="bg-dark d-none d-md-block">
                        <div class="row no-gutters">
                            <div class="col-6 px-3 py-3">
                                <img src="<?php echo $current_detail_image; ?>" alt="" class="w-100 rounded"/>
                            </div>
                            <div class="col-6">
                                <div class="py-3 px-3">
                                    <div class="pt-1 pb-2 text-light-warning">
                                        <?php echo $category_title; ?>
                                    </div>  
                                    <div class="pb-3 pr-2 text-white display-6" style="word-break:keep-all;">
                                        <?php echo $study_m_title; ?>
                                    </div>
                                    <div class="pb-4">
                                        <span class="badge badge-primary badge-pill text-white px-3 py-2"><?php echo $theme_name; ?></span>
                                    </div> 
                                    <div class="pb-4 text-light-gray">
                                    <?php 
                                        if($tag_data)
                                        {
                                            foreach ($tag_data as $courses_obj) 
                                            {
                                    ?>
                                            <span class="pl-1 pr-2">#<?php echo $courses_obj->title; ?></span>
                                    <?php
                                            }
                                        }
                                    ?>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--모바일--> 
                    <div class="bg-dark d-block d-md-none">
                        <div class="row no-gutters">
                            <div class="col-12 px-3 py-3">
                                <img src="<?php echo $current_detail_image; ?>" alt="" class="w-100 rounded"/>
                                <div class="mb-0 pt-3 px-1">  
                                    <div class="pt-1 pb-2 text-light-warning">
                                        <?php echo $category_title; ?>
                                    </div>  
                                    <div class="pb-3 pr-2 text-white display-6" style="word-break:keep-all;">
                                        <?php echo $study_m_title; ?>
                                    </div>
                                    <div class="pb-4">
                                        <span class="badge badge-primary badge-pill text-white px-3 py-2"><?php echo $theme_name; ?></span>
                                    </div> 
                                    <div class="pb-4 text-light-warning">
                                    <?php 
                                        if($tag_data)
                                        {
                                            foreach ($tag_data as $courses_obj) 
                                            {
                                    ?>
                                            <span class="pr-3">#<?php echo $courses_obj->title; ?></span>
                                    <?php
                                            }
                                        }
                                    ?>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Meta Description -->
                    <div class="mb-0 pt-4 px-2">      
                        <div class="mb-4 px-3">
                            <p class="category_start">
                                <span class="text-dark-warning display-6 lead font-weight-bolder"><?php echo $meta_description; ?></span>
                            </p>
                        </div>                                
                        <!-- Descriptions -->
                        <div class="min-h-400px px-3">
                            <?php echo $description;; ?>
                        </div>
                    </div>          
                    <!-- List -->
                    <?php
                    if($content_data)
                        { ?>
                        <div class="mb-2 pt-4 px-2">
                            <div class="card mb-0 mx-0 border">    
                                <div class="pt-3 pb-1">
                                    <?php 
                                    $j = 0;
                                    foreach ($content_data as $data_section_contant) 
                                    { 
                                        $this_contant_url = $content_data->value;
                                        $j++;
                                        if(!next($content_data)) {
                                            $bt_bar = "";
                                        }
                                        else{
                                            $bt_bar = "dash_btmbar";
                                        }
                                        ?>
                                        <div class="d-flex justify-content-between align-items-center mt-2 mb-3 mx-3 pb-2 <?php echo $bt_bar; ?>">
                                            <div class="text-truncate">
                                                <a href="<?php echo $data_section_contant->value; ?>" target="_blank" class="mb-2 d-flex justify-content-between align-items-center text-black font-weight-medium"><span class="px-2 ml-1">🔗</span><span class="ml-1 ml-md-2"><?php echo $data_section_contant->title; ?></span></a>
                                            </div>
                                            <div class="text-truncate d-none d-lg-block pr-2">
                                                <a href="<?php echo $data_section_contant->value; ?>" target="_blank" class="mb-2 d-flex justify-content-between align-items-center text-black font-weight-medium"><span class="btn btn-primary btn-sm py-2 px-2 ml-1 ml-md-3">내용 보기</span></a>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>                    
                            </div>
                        </div>  
                    <?php
                        }
                    ?> 
                    <!-- Etc -->
                    <div class="mb-6 pt-0 px-4">
                        <div class="bg-light-gray pt-5 pb-4 px-2">
                            <div class="mb-0 text-medium-gray font-size-sm">    
                                <ul class="pb-0 mb-0">
                                    <li>본 페이지에 소개된 내용은 단순 하이퍼 링크를 통해서만 연결됩니다.</li>
                                    <li>소유권 및 저작권은 서비스되는 해당 사이트에 있습니다.</li>
                                </ul>
                            </div>
                            <div class="pb-0 mb-0">
                                <a href="<?php echo $category_url; ?>" class="pl-4 font-size-sm"><span class="px-0">&lt; 목록으로 돌아가기</span></a> 
                            </div>
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
            </div>
            <div class="col-lg-4 col-md-12 col-12 pt-0" id="side_body">
                <!-- ////  오른쪽 연관 포스트 S //// -->
                <div class="card border-1 mb-3 mx-1 px-3 py-2">
                    <!-- card header -->
                    <div class="card-header px-2 pt-2 pb-0">
                        <p class="mb-2 font-size-mid-lg font-weight-semi-bold text-dark-gray">📍 다른 <?php echo $theme_name; ?></p>
                    </div>  
                    <div class="card-body px-1 py-2">
                        <?php
                            $data['related_post'] = $related_post;
                            $this->load->view('cground_list_side',$data);        
                            ?>
                    </div>
                </div>                 
                <!-- ////  오른쪽 카테고리 상품 광고 card S //// -->
                <div class="card border-1 mb-3 mx-1 px-1 pt-3 pb-2">
                    <div class="px-1 py-0 text-center">
                        <?php echo $category_data->category_ext ?>
                    </div>
                </div>
                <!-- ////  오른쪽 연관 상품 광고 card E //// --> 
            </div>            
        </div>
    </div>
    <div class="container">
        <div class="row px-2 pt-6">
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
            <div class="col-lg-4 col-md-12 col-12 pt-3">   
            </div>            
        </div>
    </div>    
</div>