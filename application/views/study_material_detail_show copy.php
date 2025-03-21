<input type="hidden" id="active_study_matrial_id" value="<?php echo $study_material_id ?>">
<input type="hidden" id="url_study_material_content_id" value="">
<?php 
    $s_m_id = $study_data->id;
    $user_id = isset($this->user['id']) ? $this->user['id'] : NULL;

    $category_id = $study_data->category_id;
    $category_det_url = base_url("subcate/").$category_id;
    $category_title = $study_data->category_title;

    $current_sm_image = $study_data->image ? $study_data->image : "default.jpg";
    $current_detail_image = base_url("assets/images/studymaterial/").$current_sm_image;
    
    if(!is_file(FCPATH."assets/images/studymaterial/".$current_sm_image))
    {
        $current_detail_image = base_url("assets/default/quiz.png"); 
    } 
    
    $total_section = count($study_material_section_data);
    $total_file = $study_data->total_file;

    $price = number_format($study_data->price)."원";
    $price_tag = ($study_data->price > 1) ? "유료 수강신청" : "누구나 무료로 신청 가능";
    $price_sub_tag = ($study_data->price > 1) ? "수강 신청을 하면 전체 내용을 볼 수 있어요." : "신청만 하면 지금 바로 전체 내용을 볼 수 있어요.";
    $current_url = current_url();                    
    $study_m_title = $study_data->title;
    $return_url = "study-content/".$s_m_id;
    $real_url = base_url('serieses/').$s_m_id;
    //$enroll_now_url = base_url('study-content/').$s_m_id."?enroll=1";
    $enroll_now_url = base_url('apply/free-enroll/').$s_m_id;
    //$is_s_m_amout_payed = (isset($paid_s_m_array[$s_m_id]) && $paid_s_m_array[$s_m_id]) ? TRUE : FALSE;

    if($user_id == $study_data->user_id)
    {
        $is_user_enrolled = TRUE;
        $is_premium_member = TRUE;
    }
    $is_preview = TRUE;
    $preview_level = ($study_data->is_registered == 1) ? "SOME" : "FULL";    
    $preview_url = base_url("preview-material/$s_m_id");
    
    if(empty($user_id))
    {
        //$action_url = base_url("login?returnUrl=$return_url");
        $action_url = "javascript:alert('수강신청은 로그인 후  가능합니다');";
        $action_btn_color = "btn-primary";
        $action_btn_name = "수강신청";
    }
    else
    {
        if($is_user_enrolled)
        {
            $is_preview = FALSE;
            $action_url = $real_url;
            $action_btn_color = "btn-dark";
            $action_btn_name = "클래스 바로가기";
        }
        else
        {
            if($study_data->price > 0)
            {
                if($is_pending == TRUE){
                    //--- 구매내역으로 이동
                    $is_preview = FALSE;
                    $action_url = base_url("my/payments");
                    $action_btn_color = "btn-secondary";
                    $action_btn_name = "입금 확인";                    
                }
                else {
                    //--- 유료 결제로 이동
                    $action_url = base_url("apply/payment-mode/material/$s_m_id");
                    $action_btn_color = "btn-primary";
                    $action_btn_name = "수강신청";                    
                }
            }            
            else if($study_data->is_premium == 1 && $is_premium_member == FALSE)
            {
                $action_url = base_url("membership");
                $action_btn_name = lang('get_membership');
            }                      
            else
            {
                //--- 무료 신청으로 이동
                $action_url = $enroll_now_url;
                $action_btn_color = "btn-primary";
                $action_btn_name = "수강신청";                 
            }
        }           
    }

    $attachment_dir = "./assets/uploads/study_material";
    $attachment_dir_link = base_url("assets/uploads/study_material/");

?>
<!-- Page content-->
<div class="pt-2 pt-lg-3 pb-4 min-h-100vh">
    <div class="container px-0">
        <div class="detail-content row">
            <div class="course-detail col-lg-8 col-md-12 col-12 pt-0 pt-lg-3 mb-4 mb-lg-0 pl-0 pr-0 pr-lg-6">
                <!-- 강의 이미지 -->
                <div class="mb-2">
                    <img src="<?php echo $current_detail_image; ?>" alt="" class="w-100"/>
                </div>
                <!-- 강의명 모바일 -->
                <div class="mb-1 px-3 d-block d-md-none">
                    <div class="py-1 font-weight-semi-bold text-dark-gray font-size-sm">클래스</div>
                    <div class="pb-2">
                        <h1 class="text-black display-6 mb-2 font-weight-bold"><?php echo $study_data->title; ?></h1>
                    </div>
                    <div class="pt-0 pb-4 list_title_btmbar">
                        <span class="badge badge-success py-2"><?php echo $category_title; ?> </span>
                    </div>
                </div>                
                <!-- Description -->
                <div class="mb-4 pt-4 px-3 course-info-page">
                    <div class="pt-0 pb-2">
                        <span class="display-7 font-weight-bold">클래스 소개</span>
                    </div>
                    <div class="mb-2 list_title_btmbar">    
                        <?php echo $study_data->description; ?>
                    </div>                 
                </div>
                <?php 
                    if($study_material_section_data)
                    {
                        $i = 0;
                        ?>
                        <div class="px-3 mt-2 mb-2 mb-lg-3 pb-4 pb-lg-6">
                            <div class="pt-3 pb-4">
                                <span class="display-7 font-weight-bold">커리큘럼</span>
                            </div>
                            <!-- Card -->
                            <div class="accordion" id="courseAccordion">
                                <div class="card">
                                    <!-- List group -->
                                    <ul class="list-group list-group-flush">    
                                    <?php
                                        foreach ($study_material_section_data as $s_m_section_data) 
                                        { 
                                            $s_m_section_id = $s_m_section_data->id;
                                            $section_contant_data = get_study_section_contant($s_m_id,$s_m_section_id);
                                            $section_contant_data_arra = $section_contant_data ?json_decode(json_encode($section_contant_data), true) : array();
                                            $total_contant_count = count($section_contant_data_arra);
            
                                            $i++;
                                            $ariaexpanded = "false";
                                            $show = "";
                                            $active = "";
                                            if($i == 1)
                                            {
                                                $ariaexpanded = "true";
                                                $show = "show";
                                                $active = "active";
                                            }
                                            ?>
                                            <li class="list-group-item px-3">
                                                <!-- Toggle -->
                                                <a class="text-black d-flex align-items-center text-inherit text-decoration-none <?php echo $active; ?>" data-toggle="collapse" href="#course<?php echo $s_m_section_data->id; ?>" aria-expanded="<?php echo $collapsed; ?>" aria-controls="course<?php echo $s_m_section_data->id; ?>">
                                                    <div class="mr-auto">
                                                        <div class="font-weight-medium d-flex">
                                                            <div class="mr-2">
                                                                <img src="<?php echo base_url("assets/images/svg/folder-plus.svg");  ?>" class="w-100"/>
                                                            </div>
                                                            <div class="pt-1">
                                                            섹션<?php echo $i.". "; ?><?php echo $s_m_section_data->title; ?> 
                                                            </div>
                                                        </div>     
                                                    </div>
                                                    <!-- Chevron -->
                                                    <span class="chevron-arrow pt-2 ml-2"><i class="fe fe-chevron-down font-size-lg font-weight-bolder"></i></span>
                                                </a>
                                                <!-- Row -->
                                                <!-- Collapse -->
                                                <div class="collapse <?php echo $show; ?>" id="course<?php echo $s_m_section_data->id; ?>" data-parent="#courseAccordion">
                                                    <div class="pt-3 pb-2">
                                                    <?php
                                                    if($section_contant_data)
                                                    {
                                                        $j = 0;
                                                        $active_contant_section = "";
                                                        $chech_box_checked = "";
                                                        foreach ($section_contant_data as $data_section_contant) 
                                                        { 
                                                            $this_contant_url = $data_section_contant->id;
                                                            
                                                            $type = $data_section_contant->type;
                                                            switch($type){
                                                                case "video":
                                                                    $ico_type = "fe fe-video";
                                                                    $duration = gmdate("i:s", $data_section_contant->duration);
                                                                    break;
                                                                case "vimeo-embed-code":
                                                                    $ico_type = "fe fe-video";
                                                                    $duration = gmdate("i:s", $data_section_contant->duration);
                                                                    break;                                                                            
                                                                case "youtube-embed-code":
                                                                    $ico_type = "fe fe-youtube";
                                                                    $duration = gmdate("i:s", $data_section_contant->duration);
                                                                    break;
                                                                default :
                                                                    $ico_type = "fe fe-file-text";
                                                                    $duration = "약 ". floor(($data_section_contant->duration / 60) % 60)."분";
                                                                    break;    
                                                                }
                                                            $example = $data_section_contant->example;
                                                            $j++;
                                                            ?>
                                                            <div class="d-flex justify-content-between align-items-center mt-1 mb-3">
                                                                <div class="text-truncate">
                                                                    <span class="icon-shape bg-light icon-sm rounded-circle mr-2"><i class="<?php echo $ico_type; ?>"></i></span>
                                                                    <?php if($example) 
                                                                    { ?>
                                                                        <a href="<?php echo $preview_url; ?>/<?php echo $data_section_contant->id; ?>" class="p-0 font-weight-medium text-black">
                                                                        <span class="badge badge-primary lead mr-2">미리보기</span><span class="font-size-md"><?php echo $data_section_contant->title; ?></span>
                                                                        </a>
                                                                    <?php }
                                                                    else{
                                                                    ?>
                                                                        <span class="font-size-md font-weight-medium text-dark-gray"><?php echo $data_section_contant->title; ?></span>
                                                                    <?php  
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="text-truncate d-none d-lg-block">
                                                                    <span class="text-dark-gray lead font-size-sm"><i class="fe fe-clock mr-1"></i><?php echo $duration; ?></span>
                                                                </div>
                                                                
                                                                 <!-- 샘플강의 일 때 E-->
                                                             </div>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
            
                                                    </div>
                                                </div>
                                            </li>
                                            
                                        <?php
                                        }
                                    ?>
                                    </ul>
                                </div>
                            </div>         
                        </div>
                    <?php
                    }
                    ?>

            </div>
            <div class="course-sidebar col-lg-4 col-md-12 col-12 pt-3">
                <!-- Card S-->
                <div class="card mb-4 mx-2 mx-md-0">
                    <!-- Card header S-->
                    <div class="card-header pt-3 pb-2 d-none d-md-block">
                        <span class="py-2 font-weight-semi-bold text-dark-gray font-size-sm">클래스</span>
                    </div>
                     <!-- Card header E-->
                    <!-- Card body S-->
                    <div class="card-body pt-0 pb-2"> 
                        <div class="pb-2 d-none d-md-block">
                            <h1 class="text-black display-6 mb-2 font-weight-bold"><?php echo $study_data->title; ?></h1>
                        </div>
                        <div class="pt-0 pb-4 list_title_btmbar d-none d-md-block">
                            <span class="badge badge-success py-2"><?php echo $category_title; ?> </span>
                        </div>
                        <div class="pt-4 pb-4 list_title_btmbar">
                            <!-- 클래스 소개 항목 S -->
                            <div class="d-flex mt-1 mb-3 text-black font-weight-medium">
                                <div class="ml-1 mr-3">
                                    <img src="<?php echo base_url("assets/images/svg/users.svg");  ?>" class="w-90"/>
                                </div>
                                <div class="d-grid">
                                    <span class="text-black"><?php echo $price_tag; ?></span>
                                    <small class="text-medium-gray"><?php echo $price_sub_tag; ?></small>
                                </div>
                            </div>
                             <div class="d-flex mt-1 mb-3 text-black font-weight-medium">
                                <div class="ml-1 mr-3">
                                    <img src="<?php echo base_url("assets/images/svg/calendar.svg");  ?>" class="w-90"/>
                                </div>
                                <div class="d-grid">
                                    <span class="text-black">무제한 학습 가능</span>
                                </div>
                            </div>      
                            <div class="d-flex mt-1 mb-3 text-black font-weight-medium">
                                <div class="ml-1 mr-3">
                                    <img src="<?php echo base_url("assets/images/svg/list.svg");  ?>" class="w-90"/>
                                </div>
                                <div class="d-grid">
                                    <span class="text-black"><?php echo $total_section; ?>개 섹션 / <?php echo $total_file; ?>개 레슨 구성</span>
                                    <small class="text-medium-gray"><?php echo $price_sub_tag; ?></small>
                                </div>
                            </div>                                      
                             <div class="d-flex mt-1 mb-1 text-black font-weight-medium">
                                <div class="ml-1 mr-3">
                                    <img src="<?php echo base_url("assets/images/svg/monitor.svg");  ?>" class="w-90"/>
                                </div>
                                <div class="d-grid">
                                    <span class="text-black">PC, 모바일 모두 지원</span>
                                </div>
                            </div>
                            <!-- 클래스 소개 항목 E -->                                 
                        </div>
                        <div class="pt-0 pb-4">
                            <!-- 결제 정보 -->
                            <div class="col-12 pt-2 pb-2">
                                <div class="row pl-0">
                                    <div class="col">
                                        <div class="text-dark-gray font-weight-bold h5 mt-2">결제 금액</div>
                                    </div>
                                    <div class="flexibar_end col-auto">
                                    <span class="text-black font-weight-bold h3"><?php echo $price; ?></span>
                                    </div>
                                </div>
                            </div>
                             <?php
                            if($is_pending)
                            {?>
                            <div class="col-12 pt-2 px-3">
                                무통장 입금으로 신청 후 입금이 완료되지 않았습니다.
                            </div>    
                          <?php
                            }?>                
                            <div class="col-12 pt-2 px-3 pb-2">
                                <a href="<?php echo $action_url; ?>" id="study_data_contant_btn" class="btn <?php echo $action_btn_color; ?> btn-block"><?php echo lang($action_btn_name); ?></a>
                            </div>     
                            
                        </div>
                    </div>
                     <!-- Card body E-->
                </div>
                <!-- Card E-->
            </div>
        </div>                
    </div>
</div>