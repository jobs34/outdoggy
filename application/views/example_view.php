<?php 
  $study_content_type = $study_material_content_data->type;
  $study_material_content_title = $study_material_content_data->title;
  $study_material_content_value = $study_material_content_data->value;
  $study_material_content_pluscontents = $study_material_content_data->plus_contents;
  $attachment_dir = "./assets/uploads/study_material";
  $attachment_dir_link = base_url("assets/uploads/study_material/");
  ?>
<div class="col-12">
    <div class="bg-white" id="video_player_area">
            <div class="py-1 px-0 h3">
               <?php echo $study_material_content_title; ?>
            </div>
            <div class="pt-2 pb-4 px-0">
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
                        <div class="plyr__video-embed" id="player">
                            <iframe height="500" src="https://player.vimeo.com/video/<?php echo $study_material_content_value; ?>?loop=false&amp;byline=false&amp;portrait=false&amp;title=false&amp;speed=true&amp;transparent=0&amp;gesture=media" allowfullscreen allowtransparency allow="autoplay"></iframe>
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
                        <div class="plyr__video-embed" id="player">
                            <iframe height="500" src="https://www.youtube.com/embed/<?php echo $study_material_content_value; ?>?iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1" allowfullscreen allowtransparency allow="autoplay"></iframe>
                        </div>
                        <script src="<?php echo base_url();?>assets/libs/plyr/plyr.js"></script>
                        <script>const player = new Plyr('#player');</script>
                        <!------------- PLYR.IO ------------>
                    <?php
                    } 
                    elseif ($study_content_type == "content") 
                    {
                    ?>
                        <hr class="mx-1 mt-3 mb-0">
                        <div class="py-2 px-2 px-lg-4 content">
                            <?php echo $study_material_content_value; ?>
                        </div>
                    <?php
                    }    
                    ?> 
                <hr class="mx-2 mt-1 mb-2">
                <div class="py-2 px-2 content">
                    <?php echo $study_material_content_pluscontents; ?>
                </div>
            </div>
        </div>   
    </div>    