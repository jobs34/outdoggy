<?php
if($prevexam_data)  
{ 
?>
<div class="col-12 px-2 pt-2 pb-4">
    <?php
    foreach ($prevexam_data as  $quiz_array) 
    {
        $quiz_slug_url = base_url('play/').$quiz_array->id;
        $lang_id = get_language_data_by_language($this->session->userdata('language'));
        $translate_quiz_title = get_translated_column_value($lang_id,'quizes',$quiz_array->id,'title');
        $quiz_title = $translate_quiz_title ? $translate_quiz_title : $quiz_array->title;
        ?>
            <!-- // 아이템 영역 S//-->
          <div class="card quizgroup-button mb-4 border">
              <a href="<?php echo xss_clean($quiz_slug_url); ?>" target="_blank">
                <div class="mb-3 d-lg-flex">
                    <div class="col-12 pt-4 pb-2">
                        <div class="row pl-1 pl-lg-4">
                            <div class="col pr-4 pr-lg-6">
                                <div class="h4 text-black titlecommon"><?php echo xss_clean($quiz_title); ?></div>
                                <div class="font-size-sm text-dark-gray mt-2">
                                    <i class="mdi mdi-comment-question-outline ml-0 mr-1" ></i>
                                    총 <?php echo xss_clean($quiz_array->number_questions); ?>문항
                                    <i class="mdi mdi-clock-outline ml-4 mr-1 "></i>
                                    <?php echo xss_clean($quiz_array->duration_min); ?>분
                                </div>
                            </div>
                            <div class="flexibar_center col-auto text-right pr-3 pr-lg-4">
                                <div class="btn btn-outline-primary">바로 풀기</div>
                            </div>
                        </div>
                    </div>
                </div>    
              </a>  
            </div>                  
            <!-- // 아이템 영역 E//-->     
        <?php 
    } ?>
</div>
<?php    
} ?>      