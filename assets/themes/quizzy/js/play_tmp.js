function go_quiz(param){
	$(".radio_item").removeAttr("checked") ;
	$("input:radio[name='answerList']").prop('checked',false);
	i = param;
	if($("#quiz_info").css("display") == "block"){
		$('#quiz_info').fadeOut(500);
	} 
	if($("#quizExplain").css("display") == "block"){
		$('#quizExplain').fadeOut(500);
	} 	
	$('.quizQuestions').text('');
	$('.quizQuestions').text('').append('<p><span class="badge badge-pill badge-light py-1 px-3 mr-2">'+(param+1)+'.</span><span class="question_title">'+questionsList[i]+'</span></p>');	
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
}
function quizStart(){
	go_quiz(0);
	$('#quiz_info').fadeOut(500);
}	

function AnswerCheck(){
	var check = $(".radio_item:checked").val();
	if(check){
		if (check==answerList[i])
		{
			$('#quizExplain').fadeIn(100);
			$('.explainOXArea').text('').append('<img src="/assets/images/quiz/quizfeed_o.png">');
			$('.explainCorrect').text('');
			$('.explainCorrect').text('').append('<p id="addcomment">정답입니다!!</p>');
			i=i+1;
			if(i==maxquestions)
			{
				$('.explainButtonArea').text('').append('<div class="GoExplainButton" data-toggle="modal" data-target="#Modal_'+i+'"></div><div class="exitPlay"><button onclick="exit_play()" class="btn btn-danger mt-2"> 빠져나가기</button></div>');	
			}else{
				$('.explainButtonArea').text('').append('<div class="GoExplainButton" data-toggle="modal" data-target="#Modal_'+i+'"></div><div class="nextQuizButton" onclick="nextQuiz('+i+')"></div>');	
			}	
		}
		else{
			$('#quizExplain').fadeIn(100);
			if (okayAnswer==1)
			{
				var correct_item = correct_choice[i];
				$('.explainOXArea').text('').append('<img src="/assets/images/quiz/quizfeed_x.png">');
				$('.explainCorrect').text('');
				$('.explainCorrect').text('').append('<p id="addcomment">[정답] '+correct_item+'</p>');
				i=i+1;
				if(i==maxquestions)
				{
					$('.explainButtonArea').text('').append('<div class="GoExplainButton" data-toggle="modal" data-target="#Modal_'+i+'"></div><div class="exitPlay"><button onclick="exit_play()" class="btn btn-danger mt-2"> 빠져나가기</button></div>');	
				}else{
				$('.explainButtonArea').text('').append('<div class="GoExplainButton" data-toggle="modal" data-target="#Modal_'+i+'"></div><div class="nextQuizButton" onclick="nextQuiz('+i+')"></div>');
				}	
			}
			else{
				$('.explainOXArea').text('').append('<img src="/assets/images/quiz/quizfeed_x.png">');
				$('.explainCorrect').text('');
				$('.explainCorrect').text('').append('<p id="addcomment">문제를 다시 한 번 풀어보세요.</p>');
				$('.explainButtonArea').text('').append('<div class="againQuizButton" onclick="againQuiz()"></div>');	
				okayAnswer=okayAnswer+1;
			}
		}
	}
	else{
		alert("답을 체크해주세요.");
	}
}

function againQuiz(){
	$(".radio_item").removeAttr("checked") ;
	$('#quizExplain').fadeOut(100);
}

function nextQuiz(param){
	okayAnswer=0;
	$(".radio_item").removeAttr("checked") ;
	$('#quizExplain').hide();
	go_quiz(param);
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