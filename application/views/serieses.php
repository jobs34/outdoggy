<?php 
    $s_m_id = $study_data->id;
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
        <div class="row detail-content pt-0 pt-lg-3 pb-4 px-1 px-md-4 list_title_btmbar">
            <!-- 강의 이미지 -->
            <div class="col-3 col-md-2 px-0 pr-md-4 mb-2">
                <img src="<?php echo $current_detail_image; ?>" alt="" class="w-100"/>
            </div>
            <div class="col-9 col-md-10 px-3">               
                <div class="pt-1">
                    <h1 class="text-black display-5 mb-2 font-weight-bold"><?php echo $study_title; ?></h1>
                </div>
                <!--클래스 소개 항목 / PC만 보이기--> 
                <div class="pt-1 d-none d-md-block"> 
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
                                        ?>
                                        <li class="list-group-item px-3">
                                            <div class="pl-0 pl-md-4 pt-0 pt-md-2 pb-2">
                                                <div class="font-weight-medium d-flex">
                                                    <div class="mr-2 mr-md-3 pt-1">
                                                        <img src="<?php echo base_url("assets/images/svg/folder-plus.svg");  ?>" class="w-100"/>
                                                    </div>
                                                    <div class="pt-1">
                                                    <h2 class="text-black display-7 m-0 p-0  font-weight-medium">섹션 <?php echo $i.". "; ?><?php echo $s_m_section_data->title; ?></h2>
                                                    </div>
                                                </div>     
                                            </div>
                                            <!-- Row -->
                                            <div class="pt-2 pb-2 pl-0 pl-md-4">
                                                <?php
                                                if($section_contant_data)
                                                {
                                                    $j = 0;
                                                    $active_contant_section = "";
                                                    $chech_box_checked = "";
                                                    foreach ($section_contant_data as $data_section_contant) 
                                                    { 
                                                        $this_contant_url = $data_section_contant->id;
                                                        $j++;
                                                        ?>
                                                        <div class="d-flex justify-content-between align-items-center mt-1 mb-2">
                                                            <div class="text-truncate">
                                                                <a href="<?php echo $real_url; ?>/<?php echo $data_section_contant->id; ?>" class="mb-2 d-flex justify-content-between align-items-center text-black font-weight-medium">
                                                                <span class="badge badge-secondary py-1 px-2 ml-1 ml-md-3"><?php echo $data_section_contant->material_order; ?></span>
                                                                <span class="ml-1 ml-md-3"><?php echo $data_section_contant->title; ?></span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                                ?>
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