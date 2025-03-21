<?php 
  $s_m_id = $study_data->id;
  $current_url = current_url();                    
  $serieses_page = base_url('serieses/').$study_material_slug;
  $material_order = $study_material_content_data->material_order;
  $now_section_title = $now_section_data->title;
  $now_section_order = $now_section_data->order;
  $study_content_type = $study_material_content_data->type;
  $study_material_content_title = $study_material_content_data->title;
  $study_material_content_value = $study_material_content_data->value;
  $study_material_content_pluscontents = $study_material_content_data->plus_contents;
  $attachment_dir = "./assets/uploads/study_material";
  $attachment_dir_link = base_url("assets/uploads/study_material/");
  $active_contant_id = isset($study_material_content_data->id) ? $study_material_content_data->id : NULL;
  $active_section_id = isset($study_material_content_data->section_id) ? $study_material_content_data->section_id : NULL;
  ?>
<!-- Page content-->
<div class="container px-3 pt-2 pt-lg-3 pb-3 pb-lg-4 min-h-100vh">
    <div class="detail-content row">
        <div class="course-detail col-lg-8 col-md-12 col-12 pt-0 mb-4 mb-lg-0 pl-0 pr-0 pr-lg-4">
            <div class="pt-2 pb-2 text-primary">
                <span class="badge badge-dark-success py-2 px-2">섹션 <?php echo $now_section_order.". &nbsp;".$now_section_title; ?></span>  
            </div>
            <div class="pb-0">
                <h1 class="text-black display-4 mb-2"><?php echo $material_order.". ".$study_material_content_title ?></h1>
            </div>
            <!-- 강의 내용 -->
            <div class="pt-0 pb-6 px-0 course-container">
            <?php
                if($study_content_type == "video")
                {
                    $real_attachment_name = $study_material_content_value ; 
                    $attachment = $attachment_dir_link.$real_attachment_name;
                    if(!is_file(FCPATH."assets/uploads/study_material/".$real_attachment_name))
                    {
                        $attachment = base_url('assets/default/default.mp4');
                    } 

                        $ext = pathinfo($real_attachment_name, PATHINFO_EXTENSION);
                        $audio_source_type = "video/mp4";
                        if(strtolower($ext) == "mp4")
                        {
                        $audio_source_type = "video/mp4";
                        }
                        else if(strtolower($ext) == "webm")
                        {
                        $audio_source_type = "video/webm";
                        }
                    ?>
                    <!------------- PLYR.IO ------------>
                    <link rel="stylesheet" href="<?php echo base_url();?>assets/libs/plyr/plyr.css">
                    <video id="player" playsinline controls data-poster="/path/to/poster.jpg">
                        <source src="<?php echo $attachment; ?>" type="<?php echo $audio_source_type; ?>" />
                    </video>
                    <script src="<?php echo base_url();?>assets/libs/plyr/plyr.js"></script>
                    <script>const player = new Plyr('#player');</script>
                    <!------------- PLYR.IO ------------>

                <?php
                }
                elseif ($study_content_type == "vimeo-embed-code") 
                {
                ?>
                    <!------------- PLYR.IO ------------>
                    <link rel="stylesheet" href="<?php echo base_url();?>assets/libs/plyr/plyr.css">
                    <div class="border border-1 shadow-sm">
                        <div class="plyr__video-embed" id="player">
                            <iframe height="500" src="https://player.vimeo.com/video/<?php echo $study_material_content_value; ?>?loop=false&amp;byline=false&amp;portrait=false&amp;title=false&amp;speed=true&amp;transparent=0&amp;gesture=media" allowfullscreen allowtransparency allow="autoplay"></iframe>
                        </div>
                    </div>
                    <script src="<?php echo base_url();?>assets/libs/plyr/plyr.js"></script>
                    <script>const player = new Plyr('#player');</script>
                    <!------------- PLYR.IO ------------>
                    
                <?php
                } 
                elseif ($study_content_type == "youtube-embed-code") 
                {
                ?>
                    <!------------- PLYR.IO ------------>
                    <link rel="stylesheet" href="<?php echo base_url();?>assets/libs/plyr/plyr.css">
                    <div class="border border-1 shadow-sm">
                        <div class="plyr__video-embed" id="player">
                            <iframe height="500" src="https://www.youtube.com/embed/<?php echo $study_material_content_value; ?>?iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1" allowfullscreen allowtransparency allow="autoplay"></iframe>
                        </div>
                    </div>
                    <script src="<?php echo base_url();?>assets/libs/plyr/plyr.js"></script>
                    <script>const player = new Plyr('#player');</script>
                    <!------------- PLYR.IO ------------>
                    
                <?php
                } 
                elseif ($study_content_type == "content") 
                {
                ?>
                    <div class="pt-3 pb-6 px-3 content">
                        <?php echo $study_material_content_value; ?>
                    </div>
                <?php
                }    
                ?> 
                <div class="py-0 py-lg-4 px-3 pluscontents">
                    <?php echo $study_material_content_pluscontents; ?>
                </div>
                <!-- BackList/BookMark -->
                <div class="mt-6 px-2 mb-6">
                    <a href="<?php echo $serieses_page; ?>" class="btn btn-outline-secondary py-2"><span class="px-0">&lt;&lt; <?php echo $study_data->title; ?></span></a> 
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-12 pt-3">
            <!-- Card S-->
            <div class="card mb-4 mx-2 mx-md-0">
                <!-- Card body S-->
                <div class="card-body pt-2 pb-2"> 
                    <div class="pt-2 pb-3">
                        <!-- 차시 목록 S -->
                        <ul class="list-group list-group-flush">
                        <?php 
                            if($study_material_section_data)
                            {
                            $i = 0;
                            foreach ($study_material_section_data as $s_m_section_data) 
                            { 
                                $s_m_section_id = $s_m_section_data->id;
                                $section_contant_data = get_study_section_contant($s_m_id,$s_m_section_id);
                                $this_section_has_completed_contant_ids = get_user_completed_s_m_section_contant($study_material_id,$s_m_section_id,$user_id);
                                $complete_count = $this_section_has_completed_contant_ids ? count($this_section_has_completed_contant_ids) : 0;
                                $section_contant_data_arra = $section_contant_data ? json_decode(json_encode($section_contant_data), true) : array();
                                $total_contant_count = count($section_contant_data_arra);
            
                                $i++;
                                $ariaexpanded = "false";
                                $show = "";
            
                                if($active_section_id)
                                {
                                    if($active_section_id == $s_m_section_data->id)
                                    {
                                        $ariaexpanded = "true";
                                        $show = "show";
                                    }
                                }
                                else
                                {
                                    if($i == 1)
                                    {
                                        $ariaexpanded = "true";
                                        $show = "show";
                                    }
                                }
                                ?>
                                <li class="list-group-item px-2">
                                    <div class="mr-auto h4 pt-2">
                                        <?php echo $i.". "; ?><?php echo $s_m_section_data->title; ?>
                                    </div>
                                    <!-- Row -->
                                    <!-- Collapse -->
                                    <div class="pt-2 nav">
                                        <div class="py-1 text-truncate">
                                        
                                            <?php
                                            if($section_contant_data)
                                            {
                                                $j = 0;
                                                $active_contant_section = "";
                                                foreach ($section_contant_data as $data_section_contant) 
                                                { 
                                                    $study_m_title = $study_data->title;
                                                    $this_contant_url = base_url("study-material/").$study_material_id."/".$data_section_contant->id;
                
                                                    $j++;
                                                    $active_contant_section = "text-black";
                                                    $contant_color = "badge-light-secondary";

                                                    if($active_contant_id)
                                                    {
                                                        if($active_contant_id == $data_section_contant->id)
                                                        {
                                                            $active_contant_section = "text-primary font-weight-bold";
                                                            $contant_color = "badge-dark-success";
                                                        }
                                                    }
                                                    else
                                                    {
                                                        if($j == 1)
                                                        {
                                                            $active_contant_section = "text-primary font-weight-bold";
                                                            $contant_color = "badge-dark-success";
                                                        }
                                                    }
                
                                                    ?>
                                                    <a href="<?php echo $this_contant_url; ?>" class="mb-2 d-flex justify-content-between align-items-center text-decoration-none">
                                                        <div class="text-truncate pr-1 <?php echo $active_contant_section; ?>">
                                                            <span class="badge <?php echo $contant_color; ?> py-1 px-2 mr-1"><?php echo $data_section_contant->material_order; ?></span>
                                                            <span class="font-size-md "><?php echo $data_section_contant->title; ?></span>
                                                        </div>
                                                    </a>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        
                                        </div>
                                    </div>
                                </li>                  
                                <?php
                                }
                            }
                            ?>
                            </ul>
                        
                        
                        <!-- 차시 목록 E -->                                 
                    </div>
                    
                </div>
                    <!-- Card body E-->
            </div>
            <!-- Card E-->
        </div>
    </div>
</div>