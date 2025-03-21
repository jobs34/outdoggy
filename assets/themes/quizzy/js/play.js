function go_quiz(param){
    $("input:radio[name='answerList']").prop('checked',false);
    i = param;
    if($("#quiz_info").css("display") == "block"){
    	$('#quiz_info').fadeOut(500);
    } 
    if($("#quizExplain").css("display") == "block"){
    	$('#quizExplain').fadeOut(500);
    } 	
    $('.quizQNo').text('');
    $('.quizQNo').text('').append('<span class="badge badge-pill badge-secondary px-3 py-2">'+(param+1)+'</span>');	
    $('.quizQTxt').text('');
    $('.quizQTxt').text('').append('<p>'+questionsList[i]+'</p>');	
    $('.quizImages').text('');
    if (imgList[i].length > 0){
        $('.quizImages').text('').append('<img src="/assets/images/questions/'+imgList[i]+'"></img>');
    } 
    $('#item1').text('').append(selectList[i][0]);
    $('#item2').text('').append(selectList[i][1]);
    $('#item3').text('').append(selectList[i][2]);
    $('#item4').text('').append(selectList[i][3]);
    if (bogi_count == 5){
        $('#item5').text('').append(selectList[i][4]);
    }
    $('.quiz_indicNo').text('');
    $('.quiz_indicNo').text('').append(param+1);
}

function go_practicequiz(param){
    i = param;
    if($("#quiz_info").css("display") == "block"){
    	$('#quiz_info').fadeOut(500);
    } 
    if($("#quizExplain").css("display") == "block"){
    	$('#quizExplain').fadeOut(500);
    } 	
    $('.quizQNo').text('');
    $('.quizQNo').text('').append('<span class="badge badge-pill badge-secondary px-3 py-2">'+(param+1)+'</span>');	
    $('.quizQTxt').text('');
    $('.quizQTxt').text('').append('<p>'+questionsList[i]+'</p>');	
    $('.quizImages').text('');
    if (imgList[i].length > 0){
        $('.quizImages').text('').append('<img src="/assets/images/questions/'+imgList[i]+'"></img>');
    } 
    $('.quiz_indicNo').text('');
    $('.quiz_indicNo').text('').append(param+1);
}

function quizStart(){
	go_quiz(0);
	$('#quiz_info').fadeOut(500);
}

function practiceStart(){
	go_practicequiz(0);
	$('#quiz_info').fadeOut(500);
}

function AnswerCheck_new1(){
    AnswerCheck(1);
}
function AnswerCheck_new2(){
    AnswerCheck(2);
}
function AnswerCheck_new3(){
    AnswerCheck(3);
}
function AnswerCheck_new4(){
    AnswerCheck(4);
}
function AnswerCheck_new5(){
    AnswerCheck(5);
}

function AnswerCheck(paramx){
    var check = paramx;
    next_no = i+1;
    $('.explainComment').text('');
    $('.explainBtn').text('');
    var solution_item = solutionList[i];
    
    if (check==answerList[i])
    {
        document.getElementById('quizExplain').className += ' bg-correct';
        var correct_item = correct_choice[i];
        $('.correctArea').text('').append('<img src="/assets/images/quiz/quiz_correct.png">');
        $('.explainComment').text('').append('<p class="display-4 mb-4 font-weight-bolder text-medium-gray">정답입니다</p><p id="correctAnswer"><span class="badge badge-success py-1 px-2 mr-2">정답</span>'+correct_item+'</p><p id="addcomment">'+solution_item+'</p>');    

        if(solvedList[i]=='yet'){
            solvedList[i] = 'cor';
            unsolved_count = unsolved_count-1;
            $('#unsolved_count').text('');
            $('#unsolved_count').text('').append(unsolved_count);        
            correct_count = correct_count+1;
            $('#quiz_correct').text('');
            $('#quiz_correct').text('').append(correct_count);
        }
        else if (solvedList[i]=='incor') {
            solvedList[i] = 'cor';
            incorrect_count = incorrect_count-1;
            $('#quiz_incorrect').text('');
            $('#quiz_incorrect').text('').append(incorrect_count);
            correct_count = correct_count+1;
            $('#quiz_correct').text('');
            $('#quiz_correct').text('').append(correct_count);
        }
    }
    else{
        document.getElementById('quizExplain').className += ' bg-incorrect';
        var correct_item = correct_choice[i];
        $('.correctArea').text('').append('<img src="/assets/images/quiz/quiz_incorrect.png">');
        $('.explainComment').text('').append('<p class="display-4 mb-4 font-weight-bolder text-medium-gray">오답입니다</p><p id="correctAnswer"><span class="badge badge-success py-1 px-2 mr-2">정답</span>'+correct_item+'</p><p id="addcomment">'+solution_item+'</p>');
        
        if(solvedList[i]=='yet'){
            solvedList[i] = 'incor';
            unsolved_count = unsolved_count-1;
            $('#unsolved_count').text('');
            $('#unsolved_count').text('').append(unsolved_count);        
            incorrect_count = incorrect_count+1;
            $('#quiz_incorrect').text('');
            $('#quiz_incorrect').text('').append(incorrect_count);
        }
        else if (solvedList[i]=='cor') {
            solvedList[i] = 'incor';
            correct_count = correct_count-1;
            $('#quiz_correct').text('');
            $('#quiz_correct').text('').append(correct_count);
            incorrect_count = incorrect_count+1;
            $('#quiz_incorrect').text('');
            $('#quiz_incorrect').text('').append(incorrect_count);
        }  

    }    
    
    if(addtypeList[i]==1){
       var lesson_id = addvalueList[i];
       $('.explainBtn').text('').append('<div onclick="LectureBtnClick('+lesson_id+')" class="GoExplainButton btn btn-outline-dark font-size-sm">이 문제에 관한 클래스 레슨 보기</div>');
    }    
    $('.againQuiz').text('').append('<div onclick="nextQuiz('+i+')" class="btn btn-outline-dark px-2 px-lg-4"><i class="mdi mdi-alarm-panel-outline ml-0 mr-1 text-medium-gray"></i>다시 풀어보기</div>'); 
    i=i+1;
    if(i==maxquestions)
    {
        $('.nextQuiz').text('').append('<idv onclick="exit_play()" class="btn btn-dark-pink">기출문제 풀이 종료</div>');
    }else{
        $('.nextQuiz').text('').append('<div onclick="nextQuiz('+i+')" class="btn btn-dark px-4 px-lg-6">다음 문제 풀기</div>'); 
    }
    $('#quizExplain').fadeIn(150);
    document.getElementById("goquiz").value = '999';
}

function PracticeAnswerCheck(){
    next_no = i+1;
    $('.explainComment').text('');
    $('.explainBtn').text('');
    var solution_item = solutionList[i];
    var solution_image = solutionImgList[i];
    
    document.getElementById('quizExplain').className += ' bg-correct';
    if (solutionImgList[i].length > 0){
        $('.explainComment').text('').append('<div class="mb-4"><p id="addcomment">'+solution_item+'</p></div><div><img src="/assets/images/questions/solution/'+solution_image+'"></img></div>');
    } 
    else{
        $('.explainComment').text('').append('<p id="addcomment">'+solution_item+'</p>');    
    }
    solvedList[i] = 'cor';
    unsolved_count = unsolved_count-1;
    $('#unsolved_count').text('');
    $('#unsolved_count').text('').append(unsolved_count);        
    solved_count = solved_count+1;
    $('#solved_count').text('');
    $('#solved_count').text('').append(solved_count);
    
    if(addtypeList[i]==1){
       var lesson_id = addvalueList[i];
       $('.explainBtn').text('').append('<div onclick="LectureBtnClick('+lesson_id+')" class="GoExplainButton btn btn-outline-dark font-size-sm">이 문제에 관한 클래스 레슨 보기</div>');
    }    
    $('.againQuiz').text('').append('<div onclick="nextQuiz('+i+')" class="btn btn-outline-secondary px-2 px-lg-4"><i class="mdi mdi-alarm-panel-outline ml-0 mr-1 text-medium-gray"></i>다시 보기</div>'); 
    i=i+1;
    if(i==maxquestions)
    {
        $('.nextQuiz').text('').append('<idv onclick="exit_play()" class="btn btn-dark-pink">기출문제 확인 종료</div>');
    }else{
        $('.nextQuiz').text('').append('<div onclick="nextQuiz('+i+')" class="btn btn-primary px-4 px-lg-6">다음 문제 보기</div>'); 
    }
    $('#quizExplain').fadeIn(150);
    document.getElementById("goquiz").value = '999';
}

function nextQuiz(param){
            document.getElementById('quizExplain').classList.remove('bg-correct','bg-incorrect');
	$('#quizExplain').hide();
	$('.quizAnswers').delay(700).fadeIn(1000);
	go_quiz(param);
}

function LectureBtnClick(param) { 

    var study_material_id = param;
    $.ajax({
            url:BASE_URL+"lesson-view",
            type:"POST",
            data:{study_material_id:study_material_id},
            success: function (response)
            {
                response = JSON.parse(response);
                $('#myModal').modal('show');
                $('.payment-data').html(response);
            },
            error: function(e)
            {
               console.log(e);
            }
    });
}

function VodCommentBtnClick(param) { 
    $.magnificPopup.open({ 
		items: {
				//src: param
				src: "https://www.youtube.com/watch?v="+param
		},
		type: 'iframe',
		closeOnContentClick : true, 
	}); 
}