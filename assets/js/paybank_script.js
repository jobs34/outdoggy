(function ($) {
      $("#save_bankpay").on("click", function()
      {
        var event = $(this);
        var quiz_id = $('.quiz_id').val();
        var purchases_type = $('.purchases_type').val();
        var transaction_no = $('.transaction_no').val();
        var payer_name = $('#payer_name').val();
          $.ajax({ 
                url:BASE_URL+"apply/bank-transfer-insert",
                type:"POST",
                data:{quiz_id:quiz_id,transaction_no:transaction_no,payer_name:payer_name,purchases_type:purchases_type},
                success: function (response)
                {
                    response = JSON.parse(response);
                    //console.log(response);
                    if(response.status == 'success')
                    {window.location.href = BASE_URL+('apply/bank-transfer-success/'+purchases_type+'/'+quiz_id);}
                    else
                    {window.location.href = BASE_URL+('apply/bank-transfer-error/'+purchases_type+'/'+quiz_id);}
                    //{swal("Error",response.msg, "error");}
                },
                error: function(e)
                {
                    console.log(e);
                }
          });
      });
  })(jQuery);  
