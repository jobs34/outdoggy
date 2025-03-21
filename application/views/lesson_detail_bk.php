<input type="hidden" id="is_contant_reasing_page" value="<?php echo lang('yes'); ?>">
<input type="hidden" id="active_study_matrial_id" value="<?php echo $study_material_id ?>">
<input type="hidden" id="url_study_material_content_id" value="<?php echo $study_material_content_id ?>">
<?php 
  $s_m_id = $study_data->id;
  $current_url = current_url();                    
  $complete_count = $s_m_completed_content_ids ? count($s_m_completed_content_ids) : 0;
  $serieses_page = base_url('serieses/').$study_material_slug;
  $display_none_for_guest = $user_id ? "" : "d-none";
  
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
<!-- 빵조각 -->
<div class="container-lg px-3 pt-2 pt-lg-3 pb-3 pb-lg-4">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/" class="bread-anc">홈</a></li>
        <li class="breadcrumb-item"><a href="/courses/ctp03" class="bread-anc">캠핑스쿨</a></li>
        <li class="breadcrumb-item"><a href="<?php echo $serieses_page; ?>" class="bread-anc">레슨 목록</a></li>
        <li class="breadcrumb-item active" aria-current="page">Lesson</li>
      </ol>
    </nav>
</div>
<!-- Page content-->
<div class="pb-4 min-h-100vh">
    <div class="container px-0">
        <div class="detail-content row">
            <div class="course-detail col-lg-8 col-md-12 col-12 pt-0 pt-lg-3 mb-4 mb-lg-0 pl-0 pr-0 pr-lg-6">
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
                            <!-- 강의명 모바일 -->
                            <div class="mb-2 px-3 pt-3 d-block d-md-none">
                                <div class="pt-0 pb-2">
                                <span class="badge badge-dark py-2 px-2">Lesson <?php echo $now_section_order."-".$material_order; ?></span>  
                                </div>
                                <div class="pb-2">
                                    <span class="text-black display-6 mb-2 font-weight-bold"><?php echo $study_material_content_title ?></span>
                                </div>  
                                <div class="pb-2">
                                    <span class="font-size-sm pt-1 mb-2 text-medium-gray font-weight-medium">섹션<?php echo $now_section_order.". ".$now_section_title; ?></span>
                                </div>                               
                            </div> 
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
                            <!-- 강의명 모바일 -->
                            <div class="mb-2 px-3 pt-3 d-block d-md-none">
                                <div class="pt-0 pb-2">
                                <span class="badge badge-dark py-2 px-2">Lesson <?php echo $now_section_order."-".$material_order; ?></span>  
                                </div>
                                <div class="pb-2">
                                    <span class="text-black display-6 mb-2 font-weight-bold"><?php echo $study_material_content_title ?></span>
                                </div>  
                                <div class="pb-2">
                                    <span class="font-size-sm pt-1 mb-2 text-medium-gray font-weight-medium">섹션<?php echo $now_section_order.". ".$now_section_title; ?></span>
                                </div>                               
                            </div> 
                            
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
                            <!-- 강의명 모바일 -->
                            <div class="mb-2 px-3 pt-3 d-block d-md-none">
                                <div class="pt-0 pb-2">
                                <span class="badge badge-dark py-2 px-2">Lesson <?php echo $now_section_order."-".$material_order; ?></span>  
                                </div>
                                <div class="pb-2">
                                    <span class="text-black display-6 mb-2 font-weight-bold"><?php echo $study_material_content_title ?></span>
                                </div>  
                                <div class="pb-2">
                                    <span class="font-size-sm pt-1 mb-2 text-medium-gray font-weight-medium">섹션<?php echo $now_section_order.". ".$now_section_title; ?></span>
                                </div>                               
                            </div> 
                            
                        <?php
                        } 
                        elseif ($study_content_type == "content") 
                        {
                        ?>
                            <div class="px-3 lesson_title list_title_btmbar">
                                <div class="text-black py-2 font-weight-bold"><?php echo $study_material_content_title ?></div>  
                            </div>
                            <div class="py-4 px-3 content">
                                <?php echo $study_material_content_value; ?>
                            </div>
                        <?php
                        }    
                        ?> 
                    
                    <div class="py-0 py-lg-4 px-3 pluscontents">
                        <?php echo $study_material_content_pluscontents; ?>
                    </div>
                </div>

            </div>
            <div class="col-lg-4 col-md-12 col-12 pt-3" id="courseAccordion">
                <!-- Card S-->
                <div class="card mb-4 mx-2 mx-md-0">
                    <!-- Card body S-->
                    <div class="card-body pt-4 pb-2"> 
                        <div class="pt-0 pb-2 list_title_btmbar d-none d-md-block"> 
                            <div class="pt-0 pb-2">
                                <span class="badge badge-dark py-2 px-2">Lesson <?php echo $now_section_order."-".$material_order; ?></span>  
                            </div>
                            <div class="pb-2">
                                <p class="text-black display-6 mb-2"><?php echo $study_material_content_title ?></p>
                                <p class="font-size-sm pt-1 mb-2 text-medium-gray font-weight-medium">섹션<?php echo $now_section_order.". ".$now_section_title; ?></p>
                            </div>
                        </div>
                        <div class="pb-2">
                            <p class="pl-1 mt-4 mb-2 text-dark-gray display-8">커리큘럼</p>
                            <p class="pl-1 text-dark-gray mb-2 font-size-sm"><a href="<?php echo $serieses_page; ?>" class="int_link"><?php echo $study_data->title; ?><i class="mdi mdi-arrow-right-circle-outline ml-1"></i></a></p>
                        </div>
                        <div class="pt-3 pb-4">
                            <!-- 차시 목록 S -->
                            <ul class="list-group list-group-flush course-list">
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
                                    <!-- Toggle -->
                                    <a class="d-flex align-items-center text-inherit text-decoration-none h5 mb-0" data-toggle="collapse"
                                      href="#course<?php echo $s_m_section_data->id; ?>" role="button" aria-expanded="<?php echo $collapsed; ?>" aria-controls="course<?php echo $s_m_section_data->id; ?>">
                                      <div class="mr-auto"><?php echo $i.". "; ?><?php echo $s_m_section_data->title; ?></div>
                                      <!-- Chevron -->
                                      <span class="chevron-arrow  ml-4">
                                        <i class="fe fe-chevron-down font-size-lg"></i>
                                      </span>
                                    </a>
                                    <!-- Row -->
                                    <!-- Collapse -->
                                    <div class="collapse <?php echo $show; ?>" id="course<?php echo $s_m_section_data->id; ?>" data-parent="#courseAccordion">
                                      <div class="py-4 nav" id="course-tabOne" role="tablist" aria-orientation="vertical"
                                        style="display: inherit;">
                                        
                                          <?php
                                            if($section_contant_data)
                                            {
                                                $j = 0;
                                                $active_contant_section = "";
                                                foreach ($section_contant_data as $data_section_contant) 
                                                { 
                                                    $study_m_title = $study_data->title;
                                                    $this_contant_url = base_url("study-material/").$study_material_id."/".$data_section_contant->id;
                                                    $type = $data_section_contant->type;
                                                    
                                                    switch($type){
                                                       case "video":
                                                            $ico_type = "fe fe-video";
                                                            break;
                                                        case "youtube-embed-code":
                                                            $ico_type = "fe fe-youtube";
                                                            break;
                                                        case "vimeo-embed-code":
                                                            $ico_type = "fe fe-video";
                                                            break;
                                                        default :
                                                            $ico_type = "fe fe-file-text";
                                                            break;    
                                                        }
                
                                                    $j++;
                                                    $active_contant_section = "text-black";
                                                    $contant_color = "badge-light-secondary";

                                                    if($active_contant_id)
                                                    {
                                                        if($active_contant_id == $data_section_contant->id)
                                                        {
                                                            $active_contant_section = "text-black font-weight-semi-bold";
                                                            $contant_color = "badge-secondary";
                                                        }
                                                    }
                                                    else
                                                    {
                                                        if($j == 1)
                                                        {
                                                            $active_contant_section = "text-black font-weight-bold";
                                                            $contant_color = "badge-secondary";
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
</div>