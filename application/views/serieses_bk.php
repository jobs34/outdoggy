<?php 
    $s_m_id = $study_data->id;
    $user_id = isset($this->user['id']) ? $this->user['id'] : NULL;

    $det_url = base_url("my/study");

    $current_sm_image = $study_data->image ? $study_data->image : "default.jpg";
    $current_detail_image = base_url("assets/images/studymaterial/").$current_sm_image;
    
    if(!is_file(FCPATH."assets/images/studymaterial/".$current_sm_image))
    {
        $current_detail_image = base_url("assets/default/quiz.png"); 
    } 

    $study_title = $study_data->title;
    $total_section = count($study_material_section_data);
    $total_file = $study_data->total_file;

    $category_det_url = base_url("subcate/").$category_id;
    $category_title = $study_data->category_title;

    $current_url = current_url();                    
    $return_url = "study-content/".$s_m_id;
    $real_url = base_url('study-material/').$s_m_id;

    $attachment_dir = "./assets/uploads/study_material";
    $attachment_dir_link = base_url("assets/uploads/study_material/");

?>

<!-- Page content-->
<div class="pt-2 pb-4 min-h-100vh">
    <div class="container px-0">
        <div class="row detail-content pt-0 pt-lg-3 pb-4 list_title_btmbar">
            <!-- 강의 이미지 -->
            <div class="col-12 col-md-4 px-0 pr-md-4 mb-2">
                <img src="<?php echo $current_detail_image; ?>" alt="" class="w-100"/>
            </div>
            <div class="col-12 col-md-8 px-3">               
                <div class="pt-1">
                    <span class="text-black display-5 mb-2 font-weight-bold"><?php echo $study_title; ?></span>
                </div>
                <div class="pt-1">
                    <!-- 클래스 소개 항목 S -->    
                    <div class="d-flex mt-2 mb-2 text-dark-gray font-weight-medium ">
                        <div class="ml-1">
                            <img src="<?php echo base_url("assets/images/svg/folder-plus.svg");  ?>" class="w-80"/>
                        </div>
                        <div class="ml-0">
                            <span class=""><?php echo $total_section; ?>개 섹션</span>
                        </div>
                        <div class="ml-5">
                            <img src="<?php echo base_url("assets/images/svg/file-text.svg");  ?>" class="w-80"/>
                        </div>
                        <div class="ml-0">
                            <span class="">(전체)<?php echo $total_file; ?>개 레슨</span>
                        </div>    
                    </div>       
                    <!-- 클래스 소개 항목 E -->  
                </div>
                <div class="pt-2 text-medium-gray pl-0 pl-md-2">
                    <?php echo $study_data->meta_description; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container px-3">
        <div class="row justify-content-sm-center detail-content pt-0 pt-lg-2 px-0">
            <div class="col-12 col-lg-9 px-0">
                <div class="course-detail col-12 pt-0 pt-lg-3 px-0"> 
                <?php 
                if($study_material_section_data)
                {
                    $i = 0;
                    ?>
                    <div class="mt-2 mb-2 mb-lg-3 pb-4 pb-lg-6">
                        <div class="px-1 pt-2 pb-4">
                            <span class="display-6">내용 보기</span>
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
                                            <a class="text-black h4 d-flex align-items-center text-inherit text-decoration-none <?php echo $active; ?>" data-toggle="collapse" href="#course<?php echo $s_m_section_data->id; ?>" aria-expanded="<?php echo $collapsed; ?>" aria-controls="course<?php echo $s_m_section_data->id; ?>">
                                                <div class="mr-auto">
                                                    <div class="font-weight-medium d-flex">
                                                        <div class="mr-1 mr-md-3">
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
                                                <div class="pt-2 pb-2">
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
                                                                $duration = gmdate("i : s", $data_section_contant->duration);
                                                                break;
                                                            case "vimeo-embed-code":
                                                                $ico_type = "fe fe-video";
                                                                $duration = gmdate("i : s", $data_section_contant->duration);
                                                                break;                                                                            
                                                            case "youtube-embed-code":
                                                                $ico_type = "fe fe-youtube";
                                                                $duration = gmdate("i : s", $data_section_contant->duration);
                                                                break;
                                                            default :
                                                                $ico_type = "fe fe-file-text";
                                                                $duration = "약 ". floor(($data_section_contant->duration / 60) % 60)."분";
                                                                break;    
                                                            }
                                                        $j++;
                                                        ?>
                                                        <div class="d-flex justify-content-between align-items-center mt-1 mb-2">
                                                            <div class="text-truncate">
                                                            <a href="<?php echo $real_url; ?>/<?php echo $data_section_contant->id; ?>" class="mb-2 d-flex justify-content-between align-items-center text-black font-weight-medium">
                                                            <span class="badge badge-secondary py-1 px-2 ml-1 ml-md-3"><?php echo $data_section_contant->material_order; ?></span>
                                                            <span class="ml-1 ml-md-3"><?php echo $data_section_contant->title; ?></span>
                                                             </a>

                                                            </div>
                                                            <div class="text-truncate d-none d-lg-block">
                                                                <span class="text-medium-gray lead"><i class="<?php echo $ico_type; ?> mr-2"></i><?php echo $duration; ?></span>
                                                            </div>
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
            </div>
        </div>
    </div>
</div>