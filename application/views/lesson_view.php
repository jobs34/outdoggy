<?php 
  $study_content_type = $study_material_content_data->type;
  $study_material_id = $study_material_content_data->study_material_id;
  $study_material_content_id = $study_material_content_data->id;
  $study_material_content_title = $study_material_content_data->title;
  $study_material_content_value = $study_material_content_data->value;
  $study_material_content_pluscontents = $study_material_content_data->plus_contents;
  ?>
<link rel="stylesheet" href="/assets/css/lmsclass.css">
<div class="col-12">
    <div class="bg-white">
            <div class="py-1 px-0">
               <span class="text-black display-7 mb-2 font-weight-bold"><?php echo $study_material_content_title ?></span>
            </div>
            <div class="pt-1 pb-4 px-0 course-container">
                <?php
                if ($study_content_type == "content") 
                {
                ?>
                    <hr class="mx-1 mt-2 mb-0">
                    <div class="py-3 px-1 px-lg-3 content">
                        <?php echo $study_material_content_value; ?>
                    </div>
                    <hr class="mx-1 mt-2 mb-2">
                    <div class="py-2 px-2 content">
                        <?php echo $study_material_content_pluscontents; ?>
                    </div>
                <?php
                } 
                else 
                {
                ?>
                    <!------------- PLYR.IO ------------>
                    <hr class="mx-1 mt-2 mb-2">
                    <div class="py-2 px-2 content">
                        <?php echo $study_material_content_pluscontents; ?>
                    </div>
                    <div class="py-3 px-2 content">
                        <a href="/preview-material/<?php echo $study_material_id; ?>/<?php echo $study_material_content_id; ?>" target="_blank"><img src='/assets/images/go_lesson_detail.png' class='w-100'/></a>
                    </div>
                    <div class="py-0 px-0 content">
                        <div class="px-3 py-1">
                            <div class="text-medium-gray font-weight-normal">이미지를 클릭하면 새 창으로 이동합니다.</div>
                        </div>
                    </div>  
                    <!------------- PLYR.IO ------------>
                <?php
                }   
                ?> 
            </div>
        </div>   
   </div>    