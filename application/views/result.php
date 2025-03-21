<script>
history.pushState(null, null, location.href);
    window.onpopstate = function () {
        history.go(1);
};
</script>

<input type="hidden" class="not-attemp" value="<?php echo xss_clean($total_question) - xss_clean($total_attemp); ?>">
<input type="hidden" class="correct" value="<?php echo xss_clean($correct); ?>">
<input type="hidden" class="wrong-answer" value="<?php echo xss_clean($total_attemp) - xss_clean($correct); ?>">

<?php 
          $quiz_title = $quiz_data->title;
          $difficulty_star = get_category_stars($quiz_data->category_id, $participant_data['user_id']);

          $marks_for_correct_answer = $participant_data['marks_for_correct_answer'];
          $marks_for_correct_answer = $marks_for_correct_answer > 0 ? $marks_for_correct_answer : 1;

          $wrong_answer = $total_attemp - $correct;
          $total_marks = $total_question * $marks_for_correct_answer;
          $negative_marking_percentage = isset($participant_data['negative_marking_percentage']) ? $participant_data['negative_marking_percentage'] : 0;
          $incorrect_marks = round($negative_marking_percentage * $marks_for_correct_answer * $wrong_answer / 100,2);
          $correct_marks = $correct * $marks_for_correct_answer;
          $marks_achived = $correct_marks - $incorrect_marks;
          $percent_marks = round(($marks_achived / $total_marks)*100,2);
    
          $result = "FAIL";
          if($quiz_data->passing <= $percent_marks)
          { 
            $result_status =  "도전과제 성공";
            $result = "PASS";
            $lime_img = "test_pass.png";
          }
          else
          { 
            $result_status =  "도전과제 실패";    
            $result = "FAIL";
            $lime_img = "test_nopass.png";
          } 
          $quiz_slug_url = base_url('quiz/').$quiz_data->id;
          
?> 

  <!-- Section -->
  <div class="pt-6">
    <div class="container">
      <!-- Card -->
      <div class="card mb-4">
        <div class="d-lg-flex justify-content-between align-items-center card-header bg-dark">
          <div class="mb-3 mb-lg-0">
            <h4 class="mb-0 text-white"><?php echo $quiz_title;?></h4>
          </div>
          <div>
            <a href="<?php echo xss_clean($quiz_slug_url); ?>" class="btn btn-outline-primary btn-sm">테스트 상세 정보</a>
          </div>
        </div>

      </div>
    </div>
  </div>

  <div class="pt-6">
    <div class="container">
      <div class="row mb-6 align-items-center justify-content-center">
        <div class="col-md-10">
          <div class="row align-items-center ">
            <div class="col-xl-6 col-lg-7 col-md-12 col-12 order-1 text-center text-lg-left ">
              <!-- caption -->
              <span class="text-primary display-6 mb-2 d-block text-uppercase font-weight-semi-bold ls-xl">테스트 결과</span>
              <h2 class="display-2 text-dark font-weight-bold pl-1 mb-2"><?php echo $percent_marks;?>점</h2>

              <hr class="my-3">
                <!-- Counter -->
              <div class="row pl-2 text-dark">
                <div class="col-sm mb-3 mb-lg-0">
                <span class="badge-pill badge-primary font-weight-semi-bold"><?php echo $result_status; ?></span>
                </div>
                <div class="col-sm mb-3 mb-lg-0">
                  <h2 class="h2 font-weight-bold mb-0 ls-xs"><?php echo xss_clean($total_question); ?></h2>
                  <p class="mb-0"><?php echo lang('total_question'); ?></p>
                </div>
                <div class="col-sm mb-3 mb-lg-0">
                  <h2 class="h2 font-weight-bold mb-0 ls-xs"><?php echo xss_clean($correct); ?></h2>
                  <p class="mb-0"><?php echo lang('correct_answer'); ?></p>
                </div>               
              </div>
            </div>
              <!-- Img -->
            <div class="offset-xl-1 col-xl-5 col-lg-5 col-12 mb-6 mb-lg-0 order-lg-2 text-center ">
              <img src="<?php echo base_url()?>assets/images/<?php echo $lime_img?>" alt="" class="img-fluid-test-result">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="py-2 py-lg-4">
    <div class="container-lg">
					<!-- Card -->
					<div class="card border-0">
						<!-- 제목 -->
						<div class="pl-3 py-2 bg-medium-gray">
								<span class="my-0 font-weight-bold text-dark-gray">풀이 상세 내역</span>
						</div>
						<!-- Card body -->
						<div class="card-body pb-6">

            <?php 
            $l = 0;
            foreach ($user_question_data as  $question_data) 
            {
              $question_type_is_match = $question_data['question_type_is_match'];
              $given_correct_choice = json_decode($question_data['correct_choice']);
              
              if($question_type_is_match == "YES")
              {
                $actual_correct_choices = json_decode(json_encode($given_correct_choice), true);
                $display_order_array = isset($given_correct_choice->display_order_array) ? $given_correct_choice->display_order_array : array();
                $araay_to_display_match = isset($given_correct_choice->araay_to_display_match) ? $given_correct_choice->araay_to_display_match : array();
                $arr_is_correct = isset($given_correct_choice->arr_is_correct) ? $given_correct_choice->arr_is_correct : array();
                $submit_answer_array = isset($given_correct_choice->submit_answer_array) ? $given_correct_choice->submit_answer_array : array();
                $arr_is_correct = json_decode(json_encode($arr_is_correct), true);
                $araay_to_display_match = json_decode(json_encode($araay_to_display_match), true);
                $display_order_array = json_decode(json_encode($display_order_array), true);
                $submit_answer_array = json_decode(json_encode($submit_answer_array), true);

                $given_correct_choice = $arr_is_correct;
                $given_correct_choice_string = implode(',', $arr_is_correct);
                $user_answer_string = implode(',', $submit_answer_array);
              }
              $l++;
              ?>


              <div class="border-bottom pt-3 pb-1">
								<div class="row mt-2 mb-1">
									<div class="col-lg-9 col-md-12 col-12 mb-2 mb-lg-0">
										<span class="d-block">

                      <?php
                        if($question_data['is_correct'] == 1)
                        {
                          ?>
                          <span class="badge-pill badge-success font-weight-semi-bold py-1 mr-1">O</span> 
                        <?php
                        }
                        else
                        {
                        ?>
                          <span class="badge-pill badge-danger font-weight-semi-bold py-1 mr-1">X</span>
                        <?php
                        }
                        ?>
                  
											<span class="h4"><?php echo sprintf("%03d", $l); ?>. <?php echo mb_strimwidth(htmlspecialchars(($question_data['question'])),'0','90','...','utf-8'); ?></span>
                    </span>
										<p class="mt-2 ml-3 mb-2 font-size-xs">
                      정답 : 
                      <?php 
                        if($question_type_is_match == "YES")
                        {
                          echo $given_correct_choice_string;
                        }
                        else
                        {
                          $given_correct_choice = json_decode($question_data['correct_choice']);
                        

                          if($given_correct_choice)
                          {
                            $given_correct_choice = json_decode(json_encode($given_correct_choice), true);
                            $correct_choice_string = implode(',', $given_correct_choice);
                            ?>
                              <?php echo mb_strimwidth(htmlspecialchars(($correct_choice_string)),'0','90','...','utf-8');?>
                            <?php 
                          }
                          else
                          {
                            echo " - ";
                          }
                        }
                        ?> 
                    </p>                  
									</div>
									<div class="col-lg-3 col-md-12 col-12 d-lg-flex align-items-start justify-content-end">
										<a class="btn btn-outline-dark btn-sm mt-1 mr-1 mb-2" data-toggle="modal" data-target="#Modal_<?php echo xss_clean($question_data['id']); ?>">자세히 보기</a>
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

  <div class="pt-6 pb-10">
	<!-- Container -->
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xl-10 col-lg-10 col-12">
				<!-- Card -->
					<div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <h4 class="my-0">관련 내용 더 알아보기</h4>
                </div>
                <!-- Card body -->
                <div class="card-body">
                    <!-- 관련 포스트 -->
                    <div class="mb-5 d-md-flex">
                        <div class="mt-2">
                            <i class="fav_icon fas fa-map fa-3x ml-2 mr-5 text-light-gray"></i>
                        </div>
                        <div class="mt-2">
                            <p>관련 자격증 정보</p>
                            <a href="<?php echo base_url('category/'.$quiz_data->category_id);?>" class="btn btn-outline-primary btn-sm"><?php echo $category_title; ?> 더 보러 가기</a>
                        </div>
                    </div>

                </div>
            </div>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
      </div>
    </div>
  </div>
</div>

<?php foreach ($user_question_data as  $question_data) {  ?>
  <div class="modal fade bd-example-modal-lg" id="Modal_<?php echo xss_clean($question_data['id']); ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">

      <div class="modal-dialog modal-lg modal-custom modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle"><?php echo lang('question_detail'); ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            
              <?php if(isset($question_data['question']) && !empty($question_data['question'])) { ?>
                <div class="question-area">
                  <h3><?php echo $question_data['question']; ?></h3>
                </div>
              <?php } ?>
              <?php 
                $question_img = isset($question_data['image']) ? $question_data['image'] : NULL;
                if($question_img)
                {
                  ?>
                  <div class="questions_img">
                    <img src="<?php echo base_url('assets/images/questions/').$question_img; ?>" class="image">
                  </div>
                  <?php
                }
              ?>
              <label class="result">
                  <?php
                    if($question_data['is_correct'] == 1)
                    {
                      ?>
                      <span class="badge badge-success py-1">맞은 문제</span> 
                    <?php
                    }
                    else
                    {
                    ?>
                      <span class="badge badge-danger py-1">틀린 문제</span>
                    <?php
                    }
                    ?>

              </label>

              <ul class="py-4">
                <?php 
                  $choices_arr = json_decode($question_data['choices']);
                  $correct_choice = json_decode($question_data['correct_choice']);
                  $given_answer = json_decode($question_data['given_answer']);
                  $question_status = lang('not_attempted_this_questions');
                  foreach ($choices_arr as  $choices_val) 
                  {
                ?>
                  <li>                  
                    <?php

                    if($question_data['is_correct'] == 1)
                    { 
                      $checked = '';
                      $text_color = '';
                      $right_answer_tag = '';

                      foreach ($correct_choice as  $valueee) 
                      {
                        if(empty($checked))
                        {                        
                          $checked = $choices_val == $valueee ? 'checked' : '';
                          $text_color = $choices_val == $valueee ? 'text-success font-weight-semi-bold' : '';
                          $right_answer_tag = $choices_val == $valueee ? ' (정답)' : '';
                        }
                      }
                      ?>
                        <div class="custom-bogi-control custom-checkbox right_answer">
                          <input type="checkbox" class="custom-control-input" id="question_<?php echo xss_clean($question_data['id']); ?>" <?php echo xss_clean($checked); ?> disabled>
                          <label class="custom-control-label <?php echo xss_clean($text_color); ?>" for="question_<?php echo (xss_clean($question_data['id'])); ?>"> <?php echo htmlspecialchars($choices_val); ?> <?php echo $right_answer_tag; ?></label>
                        </div>

                      <?php
                    }
                    elseif($given_answer && $question_data['is_correct'] == 0)
                    { 
                      $checked = '';
                      $text_color01 = '';
                      $text_color02 = '';
                      $wrong_checked = '';
                      $right_answer_tag = '';
                      $wrong_choice_tag = '';

                      foreach ($given_answer as $valueee) 
                      {
                        if(empty($wrong_checked))
                        {                        
                          $wrong_checked = $choices_val == $valueee ? 'checked' : '';
                          $text_color01 = $choices_val == $valueee ? 'my_wrong_check' : '';
                          $wrong_choice_tag = $choices_val == $valueee ? ' (제출답안)' : '';
                        }
                      }

                      foreach ($correct_choice as $valueee) 
                      {
                        if(empty($checked))
                        {
                          $text_color02 = $choices_val == $valueee ? 'text-success font-weight-semi-bold' : '';
                          $right_answer_tag = $choices_val == $valueee ? ' (정답)' : '';
                        }
                      }
                      ?>
                        <div class="custom-bogi-control custom-checkbox wrong_answer">
                          <input type="checkbox" class="custom-control-input" id="question_<?php echo xss_clean($question_data['id']); ?>"  <?php echo xss_clean($wrong_checked); ?> disabled>
                          <label class="custom-control-label <?php echo xss_clean($text_color01); ?> <?php echo xss_clean($text_color02); ?>" for="question_<?php echo (xss_clean($question_data['id'])); ?>"> <?php echo htmlspecialchars($choices_val); ?><?php echo $wrong_choice_tag; ?><?php echo $right_answer_tag; ?></label>
                        </div>
                      <?php
                    }
                    else
                    { 
                      $checked = '';
                      $text_color = '';
                      $wrong_checked = '';
                      $right_answer_tag = '';
                      $wrong_choice_tag = '';                                            

                      foreach ($correct_choice as  $valueee) 
                      {
                        if(empty($checked))
                        {
                          $text_color = $choices_val == $valueee ? 'text-success font-weight-semi-bold' : '';
                          $right_answer_tag = $choices_val == $valueee ? ' (정답)' : '';
                        }
                      }
                      ?>
                        <div class="custom-bogi-control custom-checkbox notanswer">
                          <input type="checkbox" class="custom-control-input" id="question_<?php echo xss_clean($question_data['id']); ?>" disabled>
                          <label class="custom-control-label <?php echo xss_clean($text_color); ?>" for="question_<?php echo (xss_clean($question_data['id'])); ?>"> <?php echo htmlspecialchars($choices_val); ?> <?php echo $right_answer_tag; ?></label>
                        </div>
                      <?php
                    }
                    ?>
                  </li>
                    <?php
                } ?>
              </ul>

            <?php if($question_data['solution']) { ?>
              <label class="result w-100">
                <hr class="py-2">
                <h3 class="py-1"><?php echo lang('question_solution'); ?></h3>
                <div class="solution-area">
                  <?php echo $question_data['solution']; ?>
                </div>
              </label>
            <?php } ?>
            <?php 
              $solution_img = isset($question_data['solution_image']) ? $question_data['solution_image'] : NULL;
              
              if($solution_img)
              {
                ?>
                <div class="questions_img">
                  <img src="<?php echo base_url('assets/images/questions/solution/').$solution_img; ?>" alt="><?php echo $question_data['solution']; ?>" class="image">
                </div>
                <?php
              }
            ?>        

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
          </div>
        </div>
      </div>


  </div>
  <?php
} ?>