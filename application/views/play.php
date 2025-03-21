<?php
$play_title_name = $play_title;
$bogi_count = 5;
?>
<script language=javascript> 
var i=0;
var maxquestions = parseInt(<?php echo $play_total_question ?>);
var bogi_count = <?php echo $bogi_count ?>;
var quiz_id = <?php echo $quiz_id ?>;
var qNoList = []; 
var questionsList = []; 
var imgList = []; 
var answerList = []; 
var selectList= [];
var correct_choice= [];
var solutionList = [];
var addtypeList = [];
var addvalueList = [];
//var solution_ok = [];
var solvedList = [];
var unsolved_count = maxquestions;
var correct_count = 0;
var incorrect_count = 0;


function OnChange(){      
        // var gubun = document.getElementById("category").options[document.getElementById("category").selectedIndex].value;
        var selectList = document.getElementById("goquiz");
        var gubun = Number(selectList.options[selectList.selectedIndex].value);
        if(gubun<999){
            go_quiz(gubun);
        }
}

function exit_play(){
  window.close();
}	

<?php 
$tmp_data_04arr = array();
$i = 0;
while ( $i<=$play_total_question-1 )
{
  $tmp_data_01 = $play_quiz_question_data[$i][question_no];
  echo "qNoList[$i]='$tmp_data_01';\n";
  $tmp_data_02 = $play_quiz_question_data[$i][title];
  $tmp_data_02 = preg_replace("/[\&\;,'\"`<>\[\]]/i", "", $tmp_data_02);
  echo "questionsList[$i]='$tmp_data_02';\n";
  
  $tmp_data_03 = $play_quiz_question_data[$i][image];
  echo "imgList[$i]='$tmp_data_03';\n";

  $tmp_data_04arr = $play_quiz_question_data[$i][correct_choice];

  $correct_choice_arr = json_decode($tmp_data_04arr); 
  $correct_choice = $correct_choice_arr[0];
  $correct_choice = preg_replace("/[\&\;,'\"`<>\[\]]/i", "", $correct_choice);
  $correct_choice= str_replace("\r\n", "<br>", $correct_choice);
  $correct_choice = str_replace("\n", "<br>", $correct_choice);
  echo "correct_choice[$i]='$correct_choice' ;\n";

  $tmp_data_04 = str_replace ('["','', $tmp_data_04arr);
  $tmp_data_04 = str_replace ('"]','', $tmp_data_04);
  
  $tmp_data_05arr = $play_quiz_question_data[$i][choices];
  $tmp_data_05 = str_replace ('["','', $tmp_data_05arr);
  $tmp_data_05 = str_replace ('"]','', $tmp_data_05);
  $tmp_data_array = explode('","', $tmp_data_05);

  if ($tmp_data_04 == $tmp_data_array[0]){
    echo "answerList[$i]='1';\n";
 }
 elseif ($tmp_data_04 == $tmp_data_array[1]){
    echo "answerList[$i]='2';\n";
 }
 elseif ($tmp_data_04 == $tmp_data_array[2]){
    echo "answerList[$i]='3';\n";
}
elseif ($tmp_data_04 == $tmp_data_array[3]){
    echo "answerList[$i]='4';\n";
}
elseif ($tmp_data_04 == $tmp_data_array[4]){
    echo "answerList[$i]='5';\n";
}
 else {
      echo "answerList[$i]='0';\n";
 }
  $tmp_data_05arr = json_decode($tmp_data_05arr); 
  $tmp_data_05arr = str_replace("\r\n", "<br>", $tmp_data_05arr);
  $tmp_data_05arr = str_replace("\n", "<br>", $tmp_data_05arr);
  //$tmp_data_05arr = nl2br($tmp_data_05arr);
  $tmp_data_05arr = json_encode($tmp_data_05arr, JSON_UNESCAPED_UNICODE);
  echo "selectList[$i]=$tmp_data_05arr ;\n";
  
  $tmp_data_06 = $play_quiz_question_data[$i][solution];
  $tmp_data_06 = preg_replace("/[\&\;,'\"`<>\[\]]/i", "", $tmp_data_06);
  echo "solutionList[$i]='$tmp_data_06';\n";
  
  $tmp_data_07 = intval($play_quiz_question_data[$i][addon_type]);
  echo "addtypeList[$i]='$tmp_data_07';\n";
  
  $tmp_data_08 = $play_quiz_question_data[$i][addon_value];
  echo "addvalueList[$i]='$tmp_data_08';\n";
  
  echo "solvedList[$i]='yet';\n";  
  $i++;
}
?>

</script>
<?php 
//-- 테스트 부분
?>
<section>
    <div class="py-3 px-3">
        <div class="container">
            <div class="row">
                <?php //------  문제 영역 ----?>
                <div class="col-lg-8 col-12">
                    <div class="row pl-1 pr-lg-2 px-2">
                        <div class="card border-0 mb-1" id="quizArea">
                            <?php //##  퀴즈의 표지?>
                            <div id="quiz_info" class="px-4">
                                <div class="qinfo_top_section">
                                    <div class="LayoutContainer pt-7 pt-lg-10 font-weight-semi-bold text-light-gray">
                                        <p class="display-6 py-0 mb-0">준비되셨으면</p>
                                        <p class="display-5 py-0 mb-2">[시작] 버튼을 눌러주세요</p>
                                    </div>
                                    
                                </div>
                                <div class="qinfo_bottom_section">
                                    <div class="LayoutContainer">
                                        <div class="quizStartButton" onclick="quizStart();"></div>
                                    </div>
                                </div> 
                            </div>                            
                            <?php //##  퀴즈 실제 내용?>
                            <div class="card-body">             
                                <div class="quizQuestions d-flex pt-2 pb-4 pb-lg-5">
                                    <div class="quizQNo mr-2 ml-n1" id="itemx"></div>
                                    <div class="quizQTxt pt-1"></div>
                                </div>
                                <div class="quizImages pl-1 pb-4"></div>
                                <div class="quizAnswers">
                                      
                                    <div class="bogigroup bogigroup-pills w-100 mb-2">
                                        <label class="bogigroup-item btn-block">
                                            <div class="bogigroup-button" id="item1" onclick="AnswerCheck_new1()"></div>
                                        </label>
                                        <label class="bogigroup-item btn-block">
                                            <div class="bogigroup-button" id="item2" onclick="AnswerCheck_new2()"></div>
                                        </label>
                                        <label class="bogigroup-item btn-block">
                                            <div class="bogigroup-button" id="item3" onclick="AnswerCheck_new3()"></div>
                                        </label>
                                        <label class="bogigroup-item btn-block">
                                            <div class="bogigroup-button" id="item4" onclick="AnswerCheck_new4()"></div>
                                        </label>
                                        <?php 
                                        if ($bogi_count == 5)
                                        {
                                        ?>
                                            <label class="bogigroup-item btn-block">
                                                <div class="bogigroup-button" id="item5" onclick="AnswerCheck_new5()"></div>
                                            </label>                              
                                        <?php 
                                        }
                                        ?> 
                                    </div>
                                    
                                </div>
                            </div>
                            <?php //##  퀴즈 해설?>
                            <div id="quizExplain" class="pt-3 pt-lg-4 px-3 px-lg-4">
                                <div class="correctArea align-middle"></div>
                                <div class="explainArea pt-2 pt-lg-4 pl-3  pl-lg-4 pr-2">
                                    <div class="explainComment align-middle mb-2"></div>
                                    <div class="explainBtn"></div>
                                </div>
                                <div class="BtnArea row align-middle">
                                        <div class="againQuiz text-right align-middle col-6 pr-4"></div>
                                        <div class="nextQuiz text-left align-middle col-6 pl-1"></div>
                                </div>                                
                            </div>                    

                        </div>
                    </div>
                </div>
                <?php //------  문제이동 및 광고 영역 ----?>
                <div class="col-lg-4 col-12 mt-2 mt-md-0 px-2">       
                    <div class="card">
                        <div class="card-body">
                            <div class="row pt-1 pt-lg-2 list_title_btmbar">
                                <div class="col">
                                    <div class="quiz_indic_sector">
                                        <span class="quiz_indicNo">1</span>/<?php echo $play_total_question ?>
                                    </div>
                                </div>
                                <div class="flexibar_end col-auto pt-1">
                                    <span class="font-size-sm text-medium-gray mr-2">바로 가기</span>
                                    <select  id= "goquiz" name="goquiz" onchange="OnChange()">
                                    <option value="999" > -- 문제 선택 -- </option>
                                    <?php 
                                        $i = 0;
                                        foreach($play_quiz_question_data as $quiz_question_array) 
                                        { 
                                          $qno_tmp = $i+1;
                                        ?>
                                          <option value="<?php echo $i; ?>"> <?php echo $qno_tmp?>번 문제</option>
                                    <?php 
                                          $i++;
                                            } 
                                        ?>
                                    </select>       
                                </div>
                            </div>                            
                            <div class="col-12 mb-1">
                                <div class="row pt-2">
                                    <div class="col px-0">
                                        <div class="font-size-sm text-black mt-1"><span class="text-medium-gray mr-4">맞은 문제</span>총 <span id="quiz_correct">0</span> 문제</div>
                                        <div class="font-size-sm text-black mt-1"><span class="text-medium-gray mr-4">틀린 문제</span>총 <span id="quiz_incorrect">0</span> 문제</div>
                                        <div class="font-size-sm text-black mt-1"><span class="text-medium-gray mr-4">안푼 문제</span>총 <span id="unsolved_count"><?php echo $play_total_question ?></span> 문제</div>
                                    </div>
                            
                                </div>
                            </div>

                        </div>                        
                        <div class="card-footer">
                            <div class="card-options justify-content-end pr-2">
                            <img src="<?php echo base_url('/assets/images/logo_default.png'); ?>" style="height: 30px;" class="mb-2">
                            </div>
                        </div>
                    </div>      
                <!-- 이후 추가할 card 영역은 여기-->
                </div>            
            </div>
        </div>
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-custom modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header px-2 px-lg-4 py-2 bg-gray">
               <span class="modal-title pt-1 pl-2 display-7 text-light-gray" id="myModalLabel">클래스 관련 레슨</span>
                <button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body payment-data"></div>
            <div class="modal-footer px-2 px-lg-4 py-2 py-lg-3 bg-gray">
                <button type="button" class="btn btn-primary py-2" data-dismiss="modal">창 닫기</button>
            </div>
        </div>
    </div>
</div>