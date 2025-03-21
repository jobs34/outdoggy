<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$item_id= $item_data->relation_id;
$purchases_type = $item_data->purchases_type;
$buyer_email = $item_data->email;
$buyer_name = $item_data->payer_name;
$product_name = $item_data->item_name;
$product_price = $item_data->item_price;
$card_image_url = base_url("assets/images/")."card_sec.png";
$cancel_url = base_url("apply/cancel-card/").$payment_id."/".$item_id."/".$transaction_no;
?>
<!-- jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js" ></script>
<!-- iamport.payment.js -->
<script type="text/javascript" src="https://cdn.iamport.kr/js/iamport.payment-1.2.0.js"></script>
<script>
var IMP = window.IMP; 
IMP.init('imp08919864'); // 가맹점 식별코드

function requestPay() {
        IMP.request_pay({
            pg : 'html5_inicis',
            pay_method : 'card',
            merchant_uid : '<?php echo $transaction_no; ?>',
            name : '<?php echo $product_name; ?>',
            amount : <?php echo $product_price; ?>,
            buyer_name : '<?php echo $buyer_name; ?>',
            buyer_email: '<?php echo $buyer_email; ?>',
            buyer_tel : '02-814-0109'
        }, function (rsp) { // callback
            //Payment ID
            var payment_id = <?php echo $payment_id; ?>;
            if (rsp.success) { // 결제 성공 시
                //아임포트 고유 결제번호
                var imp_id = rsp.imp_uid;
                //가맹점 고유 주문번호 
                var merchant_id = rsp.merchant_uid;
                window.location.href = BASE_URL+('apply/card-pay-success/'+payment_id+'/'+merchant_id+'/'+imp_id);
            } else {
                alert("결제에 실패하였습니다. 에러 내용: " +  rsp.error_msg);
                window.location.href = BASE_URL+('apply/card-pay-error/<?php echo $payment_id; ?>/<?php echo $transaction_no; ?>/<?php echo $item_id; ?>');
            }
        });
    }
</script>
<!-- Content -->
<div class="py-6 payments_bg_common min-h-100vh">
  <div class="container">
    <div class="row">	
        <div class="col-md-3"> </div>
        <div class="col-md-6">  

          <!-- Card -->
          <div class="card mt-4 mt-lg-8 mb-4">
            <!-- Card header -->
            <div class="card-header bg-primary py-4">
              <h3 class="mb-0 text-white font-weight-bold">신용카드 결제 진행</h3>
            </div>
            <!-- Card body -->
            <div class="card-body">
                <div class="col-12">
                    <div class="px-4 pt-2 pb-2 mb-2 text-center">
                      <div class="justify-content-center position-relative px-6 px-lg-16 pt-2 pt-lg-4 pb-2"><img src="<?php echo $card_image_url; ?>" class="w-100"/></div>
                       <h3 class="mb-1 font-weight-bold">신용카드 결제 최종 진행</h3>
                        <p class="mb-0">[결제정보 입력] 버튼을 눌러 신용카드 정보를 입력합니다.</p>
                   </div>   
                </div>
                <div class="col-12 px-2 mb-6 justify-content-center">                    
                     <div class="pt-4 pb-2 text-center ">
                        <span class= "btn btn-dark-pink" id="iamportPayment" onclick="requestPay()">결제정보 입력</span>
                        <a href="<?php echo $cancel_url;?>"><span class= "btn btn-secondary">결제 취소</span></a>
                      </div>    
                  </div>                
            </div>
        </div>
        <div class="col-md-3"> </div>
      </div>
  </div> 
</div>  