(function ($) {
	"use strict";

	$(document).ready(function () {

		$(".like-quiz i").on("click", function (e) {
			var quiz_id = $(this).data("quiz_id");
			var element = $(this);
			if ($(this).hasClass("text-muted")) {
				$.ajax({
					url: BASE_URL + "like/like_quiz",
					type: "POST",
					data: {
						quiz_id: quiz_id
					},
					success: function (result) {
						result = JSON.parse(result);
						if (result.success) {
							element.removeClass("text-muted");
							element.addClass("text-success");
							$(".like-quiz-count-" + quiz_id).html(result.success.total_like);
						} 
						else if (result.status == "redirect") 
						{
							swal("Error","로그인을 하셔야 테스트를 찜할 수 있습니다.", "error");
						}
						else if (result.error == "unsuccessfull") 
						{
							swal("Error","오류가 발생했습니다.", "error");
						}
					},
					error: function (e) {
						console.log(e);
					},
				});
			} else {
				$.ajax({
					url: BASE_URL + "dislike/like_quiz_delete",
					type: "POST",
					data: {
						quiz_id: quiz_id
					},
					success: function (result) {
						result = JSON.parse(result);
						if (result.success) {
							element.removeClass("text-success");
							element.addClass("text-muted");
							$(".like-quiz-count-" + quiz_id).html(result.success.total_like);
						} else if (result.status == "redirect") 
						{
							swal("Error","로그인을 하셔야 테스트를 찜할 수 있습니다.", "error");
						} 
						else if (result.error == "unsuccessfull") 
						{
							swal("Error","오류가 발생했습니다.", "error");

						}
					},
					error: function (e) {
						console.log(e);
					},
				});
			}
		});
		/* 1. Visualizing things on Hover - See next part for action on click */
		$("#stars li").on("mouseover", function () {
			var onStar = parseInt($(this).data("value"), 10); // The star currently mouse on

			// Now highlight all the stars that's not after the current hovered star
			$(this)
				.parent()
				.children("li.star")
				.each(function (e) {
					if (e < onStar) {
						$(this).addClass("hover");
					} else {
						$(this).removeClass("hover");
					}
				});
		}).on("mouseout", function () {
			$(this)
				.parent()
				.children("li.star")
				.each(function (e) {
					$(this).removeClass("hover");
				});
		});

		/* 2. Action to perform on click */
		$("#stars li").on("click", function () {

			var onStar = parseInt($(this).data("value")); // The star currently selected
			var stars = $(this).parent().children("li.star");
			var hidd = $('.rate').val(onStar);

			for (var i = 0; i < stars.length; i++) {

				$(stars[i]).removeClass("selected");

			}

			for (var i = 0; i < onStar; i++) {
				$(stars[i]).addClass("selected");
			}

			// JUST RESPONSE (Not needed)
			var ratingValue = parseInt(
				$("#stars li.selected").last().data("value"),
				10
			);
			var msg = "";
			if (ratingValue > 1) {
				msg = "Thanks! You rated this " + ratingValue + " stars.";
			} else {
				msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
			}
			responseMessage(msg);
		});
	});

	function responseMessage(msg) {
		$(".success-box").fadeIn(200);
		$(".success-box div.text-message").html("<span>" + msg + "</span>");
	}

	//like and disklike product review
	$(document).on('click','.thumbs-up i',function(e){
		var element = $(this);
		var rel_type = $(this).data('rel_type');
		if($(this).hasClass('review-not-visit'))
		{
			var ids = $(this).data('review_id');
			$.ajax({
		        url: BASE_URL+"Quiz_Controller/review_like_insert",
		        type: "POST",
		        data:{review_id:ids,rel_type:rel_type},
		        success:function(result)
		        {
		        	result = JSON.parse(result);
		        	console.log(result.success);

		        	if(result.success)
		        	{
		        		$('#change-color_'+ids).removeClass('review-not-visit');
		        		$('#change-color_'+ids).addClass('review-like');
		        		 
		        		element.next('.total-likes').html(result.success.total_like);
		        	}
		        	else if(result.status == 'redirect')
		        	{
		        		window.location.href = BASE_URL+'login';
		        	}
		        	else if(result.error == 'unsuccessfull')
		        	{
		    			swal("Error","Something happen wrong", "error");  		
		        	}
		        },
		        error:function(e)
		        {
		        	console.log(e)
		        },        
	      	});
		}
		else
		{
			var ids = $(this).data('review_id');
			var element = $(this)
			$.ajax({
				url: BASE_URL+"Quiz_Controller/review_delete",
				type: "POST",
				data: {review_id:ids,rel_type:rel_type},
				success:function(result)
				{
					result = JSON.parse(result);
					if(result.successfull)
					{
						$('#change-color_'+ids).removeClass('review-like');
		        		$('#change-color_'+ids).addClass('review-not-visit');
		        		
		        		{	
		        			element.next('.total-likes').html(result.successfull.total_like);
		        		}
					}
					else if(result.status == 'redirect')
		        	{
		        		window.location.href = BASE_URL+'login';
		        	}
		        	else if(result.error == 'unsuccessfull')
		        	{
		    			swal("Error","Something happen wrong", "error");   		
		        	}
				},
				error:function(e)
				{
					console.log(e);
				},
			});
		}
	});

	$(".no_quiz_start").on("click", function (e) { 
    var link = $(this).attr("href");

    if (login_user_id == 0 && ad_active_quiz == "") {
      e.preventDefault();
      swal({
          title: "성함을 입력해주세요",
          type: "input",
          showCancelButton: true,
          closeOnConfirm: false,
          inputPlaceholder: "이름 입력",
		  confirmButtonText : "진행",
		  cancelButtonText : "취소",
        },
        function (inputValue) {
          if (inputValue === false) return false;
          if (inputValue === "") {
            swal.showInputError("성함을 입력하셔야 테스트가 가능합니다");
            return false;
          } else {
            var base_url = $("#main_base_url").val();

            $.ajax({
              type: "POST",
              url: BASE_URL + "quiz_Controller/set_leader_bord_user_name",
              data: {
                inputValue: inputValue,
              },

              success: function (response) {
                if (response) {
                  response = JSON.parse(response);
                  if (response.status != "error") {
                    window.location.href = link;
                  } else {
                    swal("Error",response.msg, "error");
                    location.reload();
                  }
                } else {
                  swal("Error","오류가 발생했습니다.", "error");
                }
              },
              error: function (e) {
                console.log(e);
              },
            });
          }
        }
      );
    } else {
      location.reload();
    }
  });

})(jQuery);