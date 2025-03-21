<div class="min-h-100vh grayBg">
  <!-- Page header -->
  <div class="pt-2 pb-2">
    <div class="container">
      <!-- row -->
      <div class="row align-items-center no-gutters">   
          <!-- heading -->
          <div class="col-12 text-center pb-2 pb-lg-1">
            <div class="text-white display-5 title_circle_layout">기출</br>문제</div>
            <div class="text-medium-gray display-7">기출문제를 풀어보고 그 자리에서 해설과 관련 강의 보기</div>
          </div>
      </div>
    </div>
</div>  
  <!-- Content -->
  <div class="py-6 bg-light-gray">
    <div class="container">
      <div class="row">
          <div class="col-12">
              <!--////  퀴즈 card S //// -->
              <?php
              if($quiz_data)
                { ?>
                <div class="mb-1">
                  <?php
                    $data['prevexam_data'] = $quiz_data;
                    $this->load->view('prevexam_list',$data);  
                    ?>
                </div>
                <div class="mb-2 px-3 px-lg-5 py-2">
                    <?php echo xss_clean($pagination) ?>
                </div>
                <?php 
                } ?>
              <!--////  퀴즈 card E //// -->
          </div>
      </div>
    </div>
  </div>

</div>  