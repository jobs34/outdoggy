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
<script async src="//www.instagram.com/embed.js"></script>
<!-- 빵조각 -->
<div class="container-lg px-1 pt-2 pt-lg-3 pb-3 pb-lg-4">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/" class="bread-anc">홈</a></li>
        <li class="breadcrumb-item"><a href="<?php echo $category_url; ?>" class="bread-anc"><?php echo $category_title; ?></a></li>
        <li class="breadcrumb-item active" aria-current="page">장소 안내</li>
      </ol>
    </nav>
</div>
<!-- Page content-->
<div class="container detail-content row px-0">
    <div class="col-lg-8 col-md-12 col-12 pt-0 pt-lg-3 mb-4 mb-lg-0 pl-0 pr-0 pr-lg-6" id="content_body">
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

        <!-- Description -->
        <div class="mb-4 pt-4 px-2">      
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
            <div class="mb-4 pt-4 px-2">
                <div class="card mb-4 mx-0 border">    
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
        <!-- Etc-->
        <div class="mb-4 pt-4 px-2 list_title_btmbar">
            <div class="pt-0 pb-3">
                <span class="display-7 text-medium-gray font-weight-bold">확인해주세요</span>
            </div>
            <div class="mb-2 text-medium-gray font-size-sm">    
                <ul>
                    <li>본 페이지에 소개된 내용은 단순 하이퍼 링크를 통해서만 연결됩니다.</li>
                    <li>소유권 및 저작권은 서비스되는 해당 사이트에 있습니다.</li>
                </ul>
            </div>
        </div>
        <!-- BackList/BookMark -->
        <div class="px-2 mb-6">
            <div class="pt-2 pb-2">
                <a href="<?php echo $category_url; ?>" class="btn btn-outline-secondary py-2"><span class="px-0">&lt; 목록으로 돌아가기</span></a> 
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-12 col-12 pt-3">   
 
        <!-- ////  오른쪽 Google 광고 card S //// -->
        <div class="mb-4 mx-2">
            <div class="px-1 py-1 text-center">
                <?php $this->load->view('ad_r_square');?>
            </div>
        </div>
        <!-- ////  오른쪽 Google 광고 card E //// -->      
    </div>            
</div>