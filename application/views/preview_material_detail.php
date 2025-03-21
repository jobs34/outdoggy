<input type="hidden" id="is_contant_reasing_page" value="<?php echo lang('yes'); ?>">
<input type="hidden" id="active_study_matrial_id" value="<?php echo $study_material_id ?>">
<input type="hidden" id="url_study_material_content_id" value="<?php echo $study_material_content_id ?>">
<?php 
  $s_m_id = $study_data->id;
  $current_url = current_url();                    

  $complete_count = $s_m_completed_content_ids ? count($s_m_completed_content_ids) : 0;
  $study_material_detail_page = base_url('study-content/').$study_material_slug;
  $display_none_for_guest = $user_id ? "" : "d-none";
  $study_content_type = $study_material_content_data->type;
  $study_material_content_title = $study_material_content_data->title;
  $study_material_content_value = $study_material_content_data->value;
  $study_material_content_pluscontents = $study_material_content_data->plus_contents;
  $attachment_dir = "./assets/uploads/study_material";
  $attachment_dir_link = base_url("assets/uploads/study_material/");
  $active_contant_id = isset($study_material_content_data->id) ? $study_material_content_data->id : NULL;
  $active_section_id = isset($study_material_content_data->section_id) ? $study_material_content_data->section_id : NULL;
?>
<div class="container-fluid bg-light-gray">
    <!-- Contents-->
    <div class="row course-container" id ="lesson-container">
        <div class="col-lg-9  order-md-1 p-0 bg-white" id="video_player_area">
            <div class="py-3 px-2 px-lg-4 course-sidebar-header border border-top-0 border-left-0 border-bottom-1 border-right-0">
                <a href="<?php echo $study_material_detail_page;?>" class="text-dark-gray display-8 font-weight-semi-bold"><i class="mdi mdi-arrow-left-circle-outline mr-2"></i><?php echo $study_data->title; ?></a>
            </div>
            <div class="pt-0 pt-lg-2 pb-6 px-0 px-lg-3">
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
                        <div class="mt-0 pt-4 pb-3 px-2 px-lg-5 display-8 bg-dark-gray">
                            <span class="font-weight-semi-bold text-purple"><?php echo $study_material_content_title; ?></span>
                        </div>
                    <?php
                    }
                    elseif ($study_content_type == "vimeo-embed-code") 
                    {
                    ?>
                        <!------------- PLYR.IO ------------>
                        <link rel="stylesheet" href="<?php echo base_url();?>assets/libs/plyr/plyr.css">
                        <div class="plyr__video-embed" id="player">
                            <iframe height="500" src="https://player.vimeo.com/video/<?php echo $study_material_content_value; ?>?loop=false&amp;byline=false&amp;portrait=false&amp;title=false&amp;speed=true&amp;transparent=0&amp;gesture=media" allowfullscreen allowtransparency allow="autoplay"></iframe>
                        </div>
        
                        <script src="<?php echo base_url();?>assets/libs/plyr/plyr.js"></script>
                        <script>const player = new Plyr('#player');</script>
                        <!------------- PLYR.IO ------------>
                        <div class="mt-0 pt-4 pb-3 px-2 px-lg-5 display-8 bg-dark-gray">
                            <span class="font-weight-semi-bold text-purple"><?php echo $study_material_content_title; ?></span>
                        </div>
                    <?php
                    } 
                    elseif ($study_content_type == "youtube-embed-code") 
                    {
                    ?>
                        <!------------- PLYR.IO ------------>
                        <link rel="stylesheet" href="<?php echo base_url();?>assets/libs/plyr/plyr.css">
                        <div class="plyr__video-embed" id="player">
                            <iframe height="500" src="https://www.youtube.com/embed/<?php echo $study_material_content_value; ?>?iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1" allowfullscreen allowtransparency allow="autoplay"></iframe>
                        </div>
                        <script src="<?php echo base_url();?>assets/libs/plyr/plyr.js"></script>
                        <script>const player = new Plyr('#player');</script>
                        <!------------- PLYR.IO ------------>
                        <div class="mt-0 pt-4 pb-3 px-2 px-lg-5 display-8 bg-dark-gray">
                            <span class="font-weight-semi-bold text-purple"><?php echo $study_material_content_title; ?></span>
                        </div>
                    <?php
                    } 
                    elseif ($study_content_type == "content") 
                    {
                    ?>
                        <div class="pt-4 pb-1 px-2">
                            <span class="lesson_title text-primary herofont_M"><?php echo $study_material_content_title; ?></span>
                        </div>
                        <hr class="mx-1 mt-3 mb-0">
                        <div class="py-2 px-2 px-lg-4 content">
                            <?php echo $study_material_content_value; ?>
                        </div>
                    <?php
                    }    
                    ?> 
                <hr class="mx-2 mt-1 mb-2">
                <div class="py-2 px-2 px-lg-4 content">
                    <?php echo $study_material_content_pluscontents; ?>
                </div>
            </div>
        </div>
        <div class="col-lg-3 order-md-2 pt-0 px-2 px-lg-3 course-sidebar border border-top-0 border-left-1 border-bottom-0 border-right-0" id="courseAccordion">
            <div class="py-3 px-2 px-lg-4 course-sidebar-header">
                <span class="font-weight-semi-bold text-dark-gray display-8">학습목차</span>
            </div>
            <!-- List group -->
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
                  <li class="list-group-item">
                    <!-- Toggle -->
                    <a class="d-flex align-items-center text-inherit text-decoration-none h5 mb-0" data-toggle="collapse"
                      href="#course<?php echo $s_m_section_data->id; ?>" role="button" aria-expanded="<?php echo $collapsed; ?>" aria-controls="course<?php echo $s_m_section_data->id; ?>">
                      <div class="mr-auto"><?php echo "섹션 ".$i.". "; ?><?php echo $s_m_section_data->title; ?></div>
                      <!-- Chevron -->
                      <span class="chevron-arrow  ml-4">
                        <i class="fe fe-chevron-down font-size-md"></i>
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

                                    if($active_contant_id)
                                    {
                                        if($active_contant_id == $data_section_contant->id)
                                        {
                                            $active_contant_section = "text-purple font-weight-semi-bold";
                                        }
                                    }
                                    else
                                    {
                                        if($j == 1)
                                        {
                                            $active_contant_section = "text-primary font-weight-semi-bold";
                                        }
                                    }

                                    ?>

                                        <div class="text-truncate pr-1 py-2">
                                            <span class="icon-shape bg-light icon-sm  rounded-circle mr-2"><i class="font-size-sm <?php echo $ico_type; ?>"></i></span>
                                            <span class="font-size-sm <?php echo $active_contant_section; ?>"><?php echo $data_section_contant->title; ?></span>
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
              }
              ?>
            </ul>
        </div>
    </div>
    </div>