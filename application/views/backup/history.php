<div class="pt-5 pb-5 bg-light-gray min-h-100vh">
		<div class="container">
				<!-- User info -->
			<div class="row align-items-center">
				<div class="col-xl-12 col-lg-12 col-md-12 col-12">
					<!-- Bg -->
					<div class="pt-8 rounded-top" style="
								background: url(<?php echo base_url()?>assets/images/profile-bg.jpg) no-repeat;
								background-size: cover;
							"></div>
					<div
						class="d-flex align-items-end justify-content-between bg-white px-4 pt-2 pb-4 rounded-none  shadow-sm">
						<div class="d-flex align-items-center">
							<div class="position-relative d-flex justify-content-end align-items-end mt-2">
                        <h3><i class="fe fe-user nav-icon ml-1 mr-3 "></i></h3>
							</div>
							<div class="lh-1">
								<h4 class="mb-0">
                나의 지난 <?php echo lang('quiz_history'); ?>
								</h4>
							</div>
						</div>
						<div>
							<a href="<?php echo base_url('profile')?>" class="btn btn-outline-primary btn-sm d-none d-md-block">사용자 정보 수정</a>
						</div>
					</div>
				</div>
			</div>
	   <!-- Content -->
	</div>

  <div class="container">
    <div class="row">
      <?php 
        if($my_quiz_history)
        {
      ?>
        <div class="col-12 text-center pt-6"><h2 class="font-weight-bold text-medium-gray"><?php echo lang('quiz_history'); ?></h2></div>      
          <div class="col-12 mt-4 mb-10">
            <div class="table100 ver1 m-b-110">
              <div class="table100-head ">
                <table>
                  <thead>
                    <tr class="row100 head">
                      <th class="cell100 his-column1 py-3 bg-dark"><?php echo lang('title'); ?></th>
                      <th class="cell100 his-column2 py-3 bg-dark"><?php echo lang('questions'); ?></th>
                      <th class="cell100 his-column3 py-3 bg-dark"><?php echo lang('attended'); ?></th>
                      <th class="cell100 his-column4 py-3 bg-dark"><?php echo lang('correct'); ?></th>
                      <th class="cell100 his-column6 py-3 bg-dark"><?php echo lang('quiz_date'); ?></th>
                      <th class="cell100 his-column7 py-3 bg-dark"><i class="fas fa-info-circle"></i></th>
                    </tr>
                  </thead>
                </table>
              </div>
            
              <div class="table100-body js-pscroll ps ps--active-y">
                <table>
                  <tbody>
                    <?php
                      foreach ($my_quiz_history as  $quiz_array) 
                      {
                        $quiz_id = $quiz_array->quiz_id; 
                        $started = get_date_or_time_formate($quiz_array->started);
                        $date_of_quiz = get_date_formate($quiz_array->started);
                        $duration_min = $quiz_array->duration_min;
                        $completed_time = $quiz_array->completed;
                        if($completed_time)
                        {          
                          $completed = get_date_or_time_formate($completed_time);
                        }
                        else
                        {
                          $complete_count = strtotime("+$duration_min minutes", strtotime($started));
                          $completed = date("d M Y , h:i:s", $complete_count);
                          $completed = get_date_or_time_formate($completed);

                        }
                        $total_attemp = $quiz_array->total_attemp;
                        $total_attemp = $total_attemp ? $total_attemp : 0;
                    ?>
                      <tr class="row100 body">
                      <?php 
                          $encrypted_id = encrypt_decrypt('encrypt',$quiz_array->id);
                        ?> 
                        <td class="cell100 his-column1 py-4"><a href="<?php echo base_url("my/test/summary/$encrypted_id") ?>"><?php echo xss_clean($quiz_array->quiz_title); ?></a></td>
                        <td class="cell100 his-column2 py-4"><?php echo xss_clean($quiz_array->questions); ?></td>
                        <td class="cell100 his-column3 py-4"><?php echo xss_clean($total_attemp); ?></td>
                        <td class="cell100 his-column4 py-4"><?php echo xss_clean($quiz_array->correct); ?></td>
                        <td class="cell100 his-column6 py-4"><?php echo xss_clean($date_of_quiz); ?></td>
                        <td class="cell100 his-column7"><a href="<?php echo base_url("my/test/summary/$encrypted_id") ?>"><i class="fas fa-eye"></i></a></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="col-12 text-right history_page"><?php echo xss_clean($pagination);  ?></div>
          <?php
            }
            else
            {
          ?>
            <div class="col-12 text-center"> 
              <div class="row align-items-center justify-content-center no-gutters py-lg-16 py-12">
                  <div class="col-12 text-center">
                      <p class="mb-5 lead display-6 font-weight-semi-bold text-sunglow">테스트를 진행하신 기록이 없습니다.</p>
                  </div>
                  <div class="col-12 mt-4 mb-4" id="article_body">
                      <img src="<?php echo base_url()?>assets/images/empty_lime.png" alt="" class="px-16 px-lg-8" />
                  </div>       
              </div>
            </div>
          <?php
            }
          ?>
    </div>
  </div>
</div>