<?php 
    $s_m_id = $ext_course_data->id;
    $category_id = $category_data->id;
    $category_title = $category_data->category_title;

    $category_url = base_url('courses/ctp01');
    
    $current_sm_image = $ext_course_data->image ? $ext_course_data->image : "default_ext_course.jpg";
    $current_detail_image = base_url("assets/images/studymaterial/").$current_sm_image;
    if(!is_file(FCPATH."assets/images/studymaterial/".$current_sm_image))
    {
        $current_detail_image = base_url("assets/images/studymaterial/default_ext_course.jpg"); 
    } 
    $price = number_format($ext_course_data->price)."원";    
    $study_m_title = $ext_course_data->title;
    $is_premium = ($ext_course_data->is_premium=="1" ? "Youtube 영상 모음" : "무료 강의");
    $view_real_url = $ext_course_data->url;
    $ins_title = $inst_data->title;
    $ins_image = (isset($inst_data->logo) && !empty($inst_data->logo) ? base_url('assets/images/institution/'.$inst_data->logo) : base_url('assets/images/institution/default_logo.jpg'));
    $ins_address = $inst_data->address;
    $ins_description = $inst_data->description;
?>
<!-- 빵조각 -->
<div class="container-lg px-1 pt-2 pt-lg-3 pb-3 pb-lg-4">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/" class="bread-anc">홈</a></li>
        <li class="breadcrumb-item"><a href="<?php echo $category_url; ?>" class="bread-anc">취미강좌</a></li>
        <li class="breadcrumb-item active" aria-current="page">강좌 소개</li>
      </ol>
    </nav>
</div>
<!-- Page content-->
<div class="container detail-content row px-0">

    <div class="course-detail col-lg-8 col-md-12 col-12 pt-0 pt-lg-3 mb-4 mb-lg-0 pl-0 pr-0 pr-lg-6">
        <!-- 강의 이미지 -->
        <div class="bg-dark-secondary">
            <div class="row no-gutters">
                <div class="col-4 px-3 px-md-5 py-3">
                    <img src="<?php echo $current_detail_image; ?>" alt="" class="w-90 rounded"/>
                </div>
                <div class="col-8">
                    <!--PC--> 
                    <div class="mb-1 pt-3 px-1 d-none d-md-block">
                        <div class="pt-2 pb-1 text-light-gray">
                            <?php echo $is_premium; ?>
                        </div>  
                        <div class="pt-0 pb-3 pr-2 text-white display-6" style="word-break:keep-all;">
                            <?php echo $study_m_title; ?>
                        </div>
                    </div>
                    <!--모바일--> 
                    <div class="mb-0 pt-3 px-1 d-block d-md-none">  
                        <div class="pt-0 pb-0 text-light-gray">
                            <?php echo $is_premium; ?>
                        </div> 
                        <div class="pb-3 pr-2 text-white display-8">
                            <?php echo $study_m_title; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Description -->
        <div class="mb-4 pt-4 px-2">     
            <div class="pt-3 pb-2">
                <span class="display-7 font-weight-bold">강의 소개</span>
            </div>
            <div class="course-info-page">    
                <?php echo $ext_course_data->description; ?>
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
                                    <a href="<?php echo $data_section_contant->value; ?>" target="_blank" class="mb-2 d-flex justify-content-between align-items-center text-black font-weight-medium"><span class="badge badge-light py-2 px-2 ml-1 ml-md-2"><?php echo $data_section_contant->material_order; ?></span><span class="ml-1 ml-md-3"><?php echo $data_section_contant->title; ?></span></a>
                                </div>
                                <div class="text-truncate d-none d-lg-block pr-2">
                                    <a href="<?php echo $data_section_contant->value; ?>" target="_blank" class="mb-2 d-flex justify-content-between align-items-center text-black font-weight-medium"><span class="btn btn-primary btn-sm py-2 px-2 ml-1 ml-md-3">강의 보기</span></a>
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
            <div class="pt-0 pb-4">
                <span class="display-7 font-weight-bold">서비스 제공</span>
            </div>
            <div class="row mb-6 pb-4 dash_btmbar">    
                <div class="col-12 col-md-6">    
                    <div class="row">    
                        <div class="col-auto mr-2">    
                            <img src="<?php echo $ins_image; ?>" alt="<?php echo $ins_title; ?>" class="p-3 card" style="max-width:95px;"/>
                        </div>
                        <div class="col text-medium-gray font-size-sm">
                            <div class="pt-0 pb-0 text-dark-gray font-weight-bold">
                                <?php echo $ins_title; ?>
                            </div>  
                            <div class="pt-0 pb-1">
                                <?php echo $ins_address; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 text-left text-md-right">
                    <div class="pt-4 pt-md-0 pb-0 text-white">
                            <a href="<?php echo xss_clean($view_real_url); ?>" target="_blank" class="btn btn-secondary py-1 py-md-2 px-4"><span class="px-0">강좌 보러가기</span><span class="ml-2 mdi mdi-open-in-new"></span></a> 
                    </div>                           
                </div> 
            </div>                

            
            <div class="pt-0 pb-3">
                <span class="display-7 text-medium-gray font-weight-bold">확인해주세요</span>
            </div>
            <div class="mb-2 text-medium-gray font-size-sm">    
                <ul>
                    <li>본 사이트에서는 학습자들에게 도움이 되는 외부의 강좌를 소개해드립니다.</li>
                    <li>본 페이지에 소개된 강좌는 단순 하이퍼 링크를 통해서만 연결됩니다.</li>
                    <li>소유권 및 저작권은 강좌가 서비스되는 해당 사이트에 있습니다.</li>
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
        <!-- ////  오른쪽 연관 상품 광고 card S //// -->
        <div class="mb-3 mx-2">
            <div class="px-1 py-0 text-center">
                <?php echo $adv_data->google_ad_code ?>
            </div>
        </div>
        <!-- ////  오른쪽 연관 상품 광고 card E //// -->  
        <!-- ////  검색 위젯 S //// -->
        <div class="mb-3 mx-2">
            <div class="px-6 pt-0 pb-1 text-center">
                <iframe src="https://coupa.ng/ce4asF" width="100%" height="36" frameborder="0" scrolling="no" referrerpolicy="unsafe-url" browsingtopics></iframe>
            </div>
        </div>
        <!-- ////  검색 위젯 E //// -->          
        
        <!-- ////  오른쪽 Google 광고 card S //// -->
        <div class="mb-4 mx-2">
            <div class="px-1 py-1 text-center">
                <?php $this->load->view('ad_r_square');?>
            </div>
        </div>
        <!-- ////  오른쪽 Google 광고 card E //// -->      
    </div>            
</div>