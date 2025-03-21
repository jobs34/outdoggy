(function ($) {
      $("#save_cardpay").on("click", function()
      {
        var event = $(this);
        var quiz_id = $('.quiz_id').val();
        var purchases_type = $('.purchases_type').val();
        var transaction_no = $('.transaction_no').val();
        var payer_name = $('.customer_name').val();
          $.ajax({ 
                url:BASE_URL+"apply/card-pay",
                type:"POST",
                data:{quiz_id:quiz_id,transaction_no:transaction_no,payer_name:payer_name,purchases_type:purchases_type},
                success: function (response)
                {
                    response = JSON.parse(response);
                    if(response.status == 'success')
                    {
                        var payment_id = response.payment_id;
                        window.location.href = BASE_URL+('apply/card-proc/'+payment_id+'/'+transaction_no);
                    }
                    else
                    {
                        var payment_id = '0';
                        window.location.href = BASE_URL+('apply/card-proc/'+payment_id+'/'+transaction_no);
                    }
                },
                error: function(e)
                {
                    console.log(e);
                }
          });
      });
  })(jQuery);  
