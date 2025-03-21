<?php
if($quiz_list_data)  
{ 
?>
<div class="col-12 px-2 pt-2 pb-4">
    <?php
    foreach ($quiz_list_data as  $quiz_array) 
    {
        $quiz_id = $quiz_array->id;
        
        $lang_id = get_language_data_by_language($this->session->userdata('language'));
        $translate_quiz_title = get_translated_column_value($lang_id,'quizes',$quiz_id,'title');
        $quiz_title = $translate_quiz_title ? $translate_quiz_title : $quiz_array->title;
        $average = 0;
        if ($quiz_array->leader_board > 0 )
        {
            $quiz_slug_url = base_url('practice/').$quiz_id;
        }  
        else{
            $quiz_slug_url = base_url('play/').$quiz_id;
        }   
        ?>
        <!-- // 아이템 영역 S//-->
        <div class="pt-1 mt-2 mb-3 d-flex">
            <div class="col-12 pl-2 dash_btmbar">
                <div class="row">
                    <div class="col pr-4">
                        <a href="<?php echo xss_clean($quiz_slug_url); ?>" target="_blank" class="product_title_small"><img src="<?php echo base_url("assets/images/svg/edit3_gray.svg");  ?>" class="mr-3"/><?php echo xss_clean($quiz_title); ?></a> 
                    </div>
                    <div class="flexibar_center col-auto text-right pr-1 pr-lg-2">
                        <a href="<?php echo xss_clean($quiz_slug_url); ?>" target="_blank" class="btn btn-sm btn-primary py-2"><span class="px-0 font-size-sm">바로 풀기</span></a>   
                    </div>
                </div>         
            </div>
        </div>
        <!-- // 아이템 영역 E//--> 
        <?php 
    } ?>
</div>
<?php    
} ?>      