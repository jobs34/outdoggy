<div class="container-lg px-4">
  <div class="row">
    <div class="col-12 mb-2 px-1">
      <div class="mt-4">
        <div class="mb-2">
          <div class="row quiz_timer">
              <div class="col-md-8 col-xl-8 col-sm-12 pl-3 text-left">
                <h2 class="heading my-1 font-weight-bold text-medium-gray">
                    <?php 
                    $lang_id = get_language_data_by_language($this->session->userdata('language'));
                    $translate_quiz_title = get_translated_column_value($lang_id,'quizes',$quiz_data['id'],'title');
                    $quiz_title = $translate_quiz_title ? $translate_quiz_title : $quiz_data['title'];
                    echo ucwords($quiz_title);
                    ?>
                </h2>

              </div>
              <?php if($quiz_data['duration_min'] > 0) 
              { ?>
                <div class="col-md-4 col-xl-4 col-sm-12 pl-3 pl-lg-5 text-left">  
                  <h2 class="card-titlee timer heading my-1">
                    <span class="float-left ml-1 mr-2"> <i class="far fa-clock mr-1 text-medium-gray"></i> </span>
                    <span class="font-weight-bold text-dark-gray timerrr" data-seconds-left=<?php echo xss_clean($left_time); ?> > &nbsp; </span>
                    <section class='actions'></section>
                  </h2>

                  <?php 
                  $loged_in_user_data = $this->session->userdata('logged_in');
                  $time_accommodation = (isset($loged_in_user_data['time_accommodation']) && $loged_in_user_data['time_accommodation'] > 0) ? $loged_in_user_data['time_accommodation'] : 0;


                  $quiz_time_assign = $quiz_data['duration_min'];
                  if($time_accommodation > 1)
                  {
                     $quiz_time_with_time_accommodation = round(($quiz_time_assign * $time_accommodation) * 60);
                     
                     $quiz_time_assign_sec = $quiz_time_assign * 60;

                     $time_accommodation_in_sec = $quiz_time_with_time_accommodation - $quiz_time_assign_sec;
                      $_hours = floor($time_accommodation_in_sec / 3600);
                      $_mins = floor($time_accommodation_in_sec / 60 % 60);
                      $_secs = floor($time_accommodation_in_sec % 60);
                     echo "<p class='w-100 p-1 mt-2 text-secondary'> Time Accommodation : ".sprintf('%02d:%02d:%02d', $_hours, $_mins, $_secs)."</p>";
                  }


                   ?>
                </div>
                <?php 
              } ?>
          </div>
        </div>
      </div>
    </div>

    <?php $question_type_is_match = isset($question_data['question_type_is_match']) ? $question_data['question_type_is_match'] : "NO";
    ?>



  <div class="page-header">
    <?php 
      $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
      );
    ?>
  </div>

  <div class="clearfix"></div>
  <?php
  if($is_evaluation_test == "YES")
  {
    ?>
   <input type="hidden" class="current_question_json" value='<?php echo $current_question_json; ?>'>
   <input type="hidden" class="current_question_answers_string" value='<?php echo $current_question_answers_string; ?>'>
   <input type="hidden" class="current_question_answers_string_keys" value='<?php echo $current_question_answers_string_keys; ?>'>
    <?php
  }
  ?>
  <input type="hidden" class="is_evaluation_test" value="<?php echo $is_evaluation_test; ?>">
  <input type="hidden" class="question_type_is_match_value" value="<?php echo $question_type_is_match; ?>">


  <input type="hidden" class="is_last_question" value="<?php echo $last_question; ?>">
  <input type="hidden" class="is_first_question" value="<?php echo $is_first_question; ?>">
  <input type="hidden" class="is_last_question_answerd" value="<?php echo $is_last_question_answerd; ?>">


  <form action="" method="POST" class="running_quiz_question_form w-100" id="myform" class="container" >
    <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
    <input type="hidden" name="running_quiz_id" value="<?php echo $quiz_id; ?>" />

    <div class="row">



    <?php 
    $section_name_array = array();

    foreach ($quiz_question_data as $array_key => $question_section_array) 
    {

      $section_question_id = $array_key + 1;
      $section_name_array[$question_section_array['question_section_id']] = array(
        'question_section_name' => $question_section_array['question_section_name'],
        'question_section_id' => $question_section_array['question_section_id'],
        'question_id' => $section_question_id
      );
    }
    $count_section_name = count($section_name_array);
    ?>

      <div class="col-lg-8">

        <?php
        if ($count_section_name > 1) 
        { ?>

            <div class="row">
              <div class="col-md-12">

                <ul class="nav nav-tabs  mx-0 mb-3 border-0">
                  <?php

                  foreach ($section_name_array as $key => $section_array) 
                  { 
                    $section_question_id = $section_array['question_id'];
                    $active = $section_array['question_id'] == $question_id ? "active" : "";
                    $active_section = $section_array['question_id'] == $question_id ? "btn-success" : "btn-primary";

                    foreach ($quiz_question_data as $temp_key => $temp_value) 
                    {
                      if($temp_value['question_section_id'] == $key)
                      {
                        $section_question_id = $temp_key + 1;
                        break;
                      }
                    }
                    ?>
                      <li class="nav-item lo <?php echo $active; ?> p-0 mr-1">
                          <a class="btn <?php echo $active_section; ?>" id="section<?php echo $section_array['question_section_id']; ?>-tab" href="<?php echo base_url('test/').$quiz_id.'/'.$section_question_id; ?>"><?php echo strtoupper(lang($section_array['question_section_name'])); ?></a>
                      </li>

                    <?php
                  }
                  ?>                 
                </ul> 

                <div class="clearfix"></div>
              </div>
            </div>
                <?php
        } ?>
              
              

        
        <div class="card">
          
          <div class="card-body">
            <div class="container-fluid w-100">
              <div class="row">
                <div class="col-md-12 mb-1">
                  <div class="card-options">
                    <div>
                      <span class="text-dark-gray display-7 pt-1"><?php echo lang('question_no'); ?> <?php echo xss_clean($question_id); ?></span>
                    </div> 
                    <div class="ml-auto">
                      <button type="Submit" name="next_quiz" value="Next" class="btn btn-sm btn-light mr-3 text-gray next_quiz">건너뛰기 <i class="fe fe-chevron-right"></i>
                    </button>
                    </div> 
                  </div>

                  <hr> 
                </div>
              </div>
              <?php 
                $question_paragraph = isset($question_data['question_paragraph_text']) ? $question_data['question_paragraph_text'] : NULL;

                if($question_paragraph)
                { ?>

                  <div class="row w-100">
                    <div class="col-md-12 mb-2">
                      <?php echo $question_paragraph;  ?>
                    </div>
                    <hr>    
                  </div>
                  <?php
                }
              ?>
              <div class="row">
                <div class="col-md-12">
                  <?php
                    $translate_question_title = get_translated_column_value($lang_id,'questions',$question_data['id'],'title');
                    $translate_question_title = $translate_question_title ? $translate_question_title : $question_data['title'];
                    ?>
                    <?php if(isset($translate_question_title) && !empty($translate_question_title)) 
                    { ?>
                      <div class="w-100 pb-2">
                          <p class="text-black" id="quiz_question_body"><?php echo $translate_question_title; ?></p>
                      </div>
                      <?php 
                    } ?> 


                  <?php 
                    $question_attachment = isset($question_data['image']) ? $question_data['image'] : NULL;
                    $question_attach_type = isset($question_data['upload_type']) ? $question_data['upload_type'] : 'image';
                    if($question_attachment)
                    {

                      $ext = pathinfo($question_attachment, PATHINFO_EXTENSION);
                      $audio_source_type = "audio/mpeg";
                      if(strtolower($ext) == "mp3")
                      {
                        $audio_source_type = "audio/mpeg";
                      }
                      else if(strtolower($ext) == "ogg")
                      {
                        $audio_source_type = "audio/ogg";
                      }
                      else if(strtolower($ext) == "wav")
                      {
                        $audio_source_type = "audio/wav";
                      }
                      else if(strtolower($ext) == "m4a")
                      {
                        $audio_source_type = "audio/mp4";
                      }

                      if($question_attach_type == "audio")
                      { ?>

                        <audio controls class="w-100 no_underline">
                            <source src="<?php echo base_url("assets/images/questions/").$question_attachment; ?>" type="<?php echo $audio_source_type; ?>">
                            Your browser does not support the audio element.
                        </audio>

                        <?php
                      }
                      else
                      {  ?>
                        <div class="questions_img mt-1">
                          <img src="<?php echo base_url('assets/images/questions/').$question_attachment; ?>" class="image">
                        </div>
                      
                        <?php
                      }
                    }
                    ?>



                </div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="selectgroup selectgroup-pills w-100 mb-2">
              <?php 
                $translate_question_choies = $question_data['choices'];

                if($question_type_is_match != "YES")
                {  
                  $translate_question_choies = get_translated_column_value($lang_id,'questions',$question_data['id'],'choices');
                }
                $translate_question_choies = $translate_question_choies ? $translate_question_choies : $question_data['choices'];

                $translate_question_choies_data = json_decode($translate_question_choies); 
                $question_choies = json_decode(json_encode($translate_question_choies_data), true);               


                $display_order_array = array();
                $araay_to_display_match = array();
                $arr_is_correct = array();



                if($question_type_is_match == "YES")
                {  

                  $question_choies_count = COUNT($question_choies);
 
                  $correct_choice = json_decode($question_data['correct_choice']); 
                  $display_order_array = isset($correct_choice->display_order_array) ? $correct_choice->display_order_array : array();
                  $araay_to_display_match = isset($correct_choice->araay_to_display_match) ? $correct_choice->araay_to_display_match : array();
                  $arr_is_correct = isset($correct_choice->arr_is_correct) ? $correct_choice->arr_is_correct : array();
                  

                  $araay_to_display_match = json_decode(json_encode($araay_to_display_match), true);
                  $arr_is_correct = json_decode(json_encode($arr_is_correct), true);
                  $display_order_array = json_decode(json_encode($display_order_array), true);
                  $q_answer = isset($question_data['answer'])  ?  $question_data['answer'] : array();

                  ?>


                  <div class="w-100 quiz_running_mark_coorect_block text-center">
                    <div class="row">
                      <div class="col-md-9 col-sm-9 col-xs-9">
                        <h6 class="bg-info text-white py-4 mb-3">A</h6>
                        <?php
                        $index = 0;
                        foreach ($question_choies as $key => $value) 
                        { 
                          $index ++;
                          $choices_second = isset($araay_to_display_match[$key]) ? $araay_to_display_match[$key] : ""; 
                          $answerd_choies_val = isset($q_answer[$key]) ? $q_answer[$key] : "";
                          ?>
                            <div class="form-group d-flex w-100 mb-2">
                              <h6 class="choies1 form-control border border-light"><?php echo $value; ?></h6>
                            </div>
                            <?php
                        } ?>
                      </div>

                      <div class="col-md-3 col-sm-3 col-xs-3">
                        <h6 class="bg-info text-white py-4 mb-3">Answer Box</h6>
                        <?php
                        $index = 0;
                        foreach ($question_choies as $key => $value) 
                        { 
                          $index ++;
                          $choices_second = isset($araay_to_display_match[$key]) ? $araay_to_display_match[$key] : ""; 
                          $answerd_choies_val = isset($q_answer[$key]) ? $q_answer[$key] : "";
                          ?>
                             <div class="form-group mb-2 d-flex w-100 padding_zero_for_desktop">
                                <input type="number" name="answer[<?php echo $key; ?>]" class="answer_input_box form-control border border-info correct_match_index float-left " data-value="<?php echo $value;?>" width="50" value="<?php echo $answerd_choies_val; ?>">
                              </div>
                            <?php
                        } ?>
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-md-12">
                        <h6 class="bg-info text-white py-4 mb-3">B</h6>
                        <?php
                        $index = 0;
                        foreach ($question_choies as $key => $value) 
                        { 
                          $index ++;
                          $choices_second = isset($araay_to_display_match[$key]) ? $araay_to_display_match[$key] : ""; 
                          $answerd_choies_val = isset($q_answer[$key]) ? $q_answer[$key] : "";
                          ?>
                            <div class="form-group d-flex w-100 multi_choice_question_number_section mb-2">
                              <h6 class="choies2 question_choies2 form-control border border-light"><span class="badge badge-dark  question_match_index"><?php echo $index; ?></span><?php echo $choices_second; ?></h6>
                            </div>
                            <?php
                        } ?>
                      </div>

                    </div>
                  </div>

                  <?php
                }
                else
                {

                  $question_choies_count = COUNT($question_choies);
                  $checked = '';
                  $chk = 'DUE';
                  $p = 0;
                  
                  foreach ($question_choies as $key =>  $question_choice) 
                  { 

                    $p++;              
                    $q_answer = isset($question_data['answer'])  ?  $question_data['answer'] : array();
                    foreach ($q_answer as  $value) 
                    {
                      if($question_choice == $value)
                      {
                        $checked = 'checked';
                        $chk = 'DONE';
                      }
                    }
                    $is_multiple = $question_data['is_multiple'] == 1 ? 'checkbox' : 'radio';
                    $is_multiple_border = $question_data['is_multiple'] == 1 ? 'multiple-choise' : '';
                    ?>

                    <label class="selectgroup-item btn-block">
                      <input <?php echo xss_clean($checked) ;?> type="<?php echo xss_clean($is_multiple); ?>" name="answer[]" value="<?php echo htmlspecialchars(xss_clean($question_choice)); ?>" class="selectgroup-input answer_input" >

                      <div class="selectgroup-button <?php echo $is_multiple_border;?>">
                        <?php echo htmlspecialchars(xss_clean($translate_question_choies_data[$key])); ?>
                      </div>
                    </label>
                    <?php 
                    $checked = '';               
                  }
                  if($question_data['is_multiple'] == 1) 
                  { ?>
                    <div class="w-100 text-right text-warning"><?php echo lang('multiple_choice_question');?></div>
                    <?php 
                  } 
                } ?>  

            </div>

          </div>

          <div class="card-footer pt-4 pb-6">
            <div class="card-options">
              <div class="pl-1">
                <button type="Submit" name="save_or_next_quiz" value="Save & Next" class="btn btn-primary answer_given save_or_next_quiz">
                    <i class="fe fe-save"></i> <?php echo lang('save_and_next'); ?>
                </button>
              </div> 
              <div class="ml-auto">
                <button type="Submit" name="mark_or_next_quiz" value="<?php echo lang('Mark for Review and Next'); ?>" class="btn btn-light mr-3 ml-auto answer_given mark_or_next_quiz">
                  <i class="fe fe-check-circle"></i>
                </button>
              </div> 
            </div>
          </div>

        </div>
      </div>

      <div class="col-lg-4 order-lg-1 mb-4">
        <div class="card">
          <div class="card-header timerrrrrr d-none">
            <h3 class="card-title "><span class="float-left mr-3"> <?php echo lang('count_down'); ?>: </span>
               <span class="text-danger timerrr" data-seconds-left=<?php echo xss_clean($left_time); ?> > &nbsp; </span>
              <section class='actions'></section>
            </h3>
          </div>

          <div class="card-body">
            <p class="mb-3 text-medium-gray"><?php echo lang('question_palette'); ?></p>
            <?php 
              $i = 0;
              foreach($quiz_question_data as $quiz_question_array) 
              { 
                $i++;
                $attemp = isset($quiz_question_array['status']) ? $quiz_question_array['status'] : 'btn-light-secondary';
                $attemp = $attemp == 'visited' ? 'btn-dark-pink' : ($attemp == 'mark' ? 'btn-light-warning ' : ($attemp=='answer' ? 'btn-primary ' : ($attemp == 'mark-answer' ? 'btn-yellow':'btn-light-secondary')));
              ?>
                <a href="<?php echo base_url('test/').$quiz_data['id'].'/'.$i; ?>" class="btn btn-sm <?php echo xss_clean($attemp); ?> ml-2 mb-2 question_no" > <?php echo xss_clean($i) ?></a>
            <?php 
              } 
            ?>
          </div>
          <div class="card-body">
            <div class="card-options">
              <div class="col-6">
                <span class="tag tag-light-secondary mr-2 mb-2"><?php echo xss_clean($runn_not_visited); ?> </span> <span class="small"><?php echo lang('not_visited_tag'); ?></span>
              </div>
              <div class="col-6">
                <span class="tag tag-primary mr-2 mb-2"><?php echo xss_clean($runn_answered); ?> </span> <span class="small"><?php echo lang('answered_tag'); ?></span>
              </div>
            </div>
            <div class="card-options">
              <div class="col-6">
                <span class="tag tag-light-warning mr-2 mb-2"><?php echo xss_clean($runn_mark); ?> </span> <span class="small"><?php echo lang('mark_for_review'); ?> </span>
              </div>
              <div class="col-6">
                <span class="tag tag-dark-pink mr-2 mb-2"><?php echo xss_clean($runn_visited); ?>  </span> <span class="small"><?php echo lang('not_answered_tag'); ?> </span>
              </div>
            </div>            
          </div>

          <div class="card-footer">
            <div class="card-options">
              <a href="javascript:void(0)" class="btn btn-dark-pink btn-block stop_this_quiz"> <?php echo lang('Stop This Quiz'); ?> </a> 
            </div>
          </div>
        
        </div>
      </div>

    </div>
  </form>

</div>
