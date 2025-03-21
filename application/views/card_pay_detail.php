<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// 필요한 정보 뽑아 오기
$item_id = $item_data->relation_id;
$item_name = $item_data->item_name;
$item_price = $item_data->item_price;
$order_fin_date = $item_data->modified;
$invoice_no = $item_data->invoice_no;
$customer_id = $item_data->customer_id;

if ($success_status){
    $base_image_url = base_url("assets/images/")."lime_payments_success.png";
    $enroll_message = "강좌 신청 완료";
    $direct_url = base_url('my/study');
    $direct_btn_name = "나의 강좌로 이동";
}    
else {
    $base_image_url = base_url("assets/images/")."lime_payments_error.png";
    $enroll_message = "신청이</br>실패했습니다.";
    $direct_url = base_url('study-content/').$item_id;
    $direct_btn_name = "다시 신청하기";
}

?>
<!-- Content -->
<div class="py-6 payments_bg_common min-h-100vh">
    <div class="container">
        <div class="row">	
                <div class="col-md-3"> </div>
                <div class="col-md-6 pt-4">  
                    <div class="d-flex justify-content-center position-relative"><img src="<?php echo $base_image_url; ?>" class="mb-0"/></div>
                  <!-- Card -->
                  <div class="card  mb-4">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="col-12 mb-1">
                            <div class="row justify-content-center">
                                <div class="pt-3 pb-2">
                                    <p class="display-6 text-center"><?php echo $enroll_message; ?></p>
                                </div>
                            </div>
                        </div>         
                        <div class="col-12 px-7 mb-1">
                              <div class="row pl-1 py-1 list_title_btmbar">
                                  <div class="mt-1 mb-2">
                                      <p class="text-primary font-weight-semi-bold mb-1">주문 내역</p>
                                        <p class="text-black mb-1"><?php echo $item_name; ?></p>
                                  </div>
                              </div>
                              <div class="row pl-1 py-1 list_title_btmbar">
                                  <div class="mt-1 mb-2">
                                      <p class="text-primary font-weight-semi-bold mb-1">금액</p>
                                        <p class="h4 text-danger font-weight-bold mb-1"><?php echo number_format($item_price)."원"; ?></p>
                                  </div>
                              </div>                             
                        </div> 
                        <div class="col-12 px-7 mb-1">
                              <div class="row pl-1 py-1 list_title_btmbar">
                                  <div class="mt-3 mb-2">
                                      <p class="text-primary font-weight-semi-bold mb-1">카드 결제 정보</p>
                                      <p class="h5 text-dark-gray mb-1">결제 시간 : <?php echo $order_fin_date; ?></p>
                                      <p class="h5 text-dark-gray mb-1">카드 결제 식별 ID : <?php echo $customer_id; ?></p>
                                  </div>
                              </div>
                        </div>                 
                        <div class="col-12 mt-4 mb-4">
                          <a href="<?php echo $direct_url;?>"><span class="btn btn-block btn-primary mb-4" title="<?php echo $direct_btn_name; ?>"><?php echo $direct_btn_name; ?></span></a>
                        </div>            
                    </div>
                </div>
                <div class="col-md-3"> </div>        
        </div>
    </div> 
</div>