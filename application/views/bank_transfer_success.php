<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    
$base_image_url = base_url("assets/images/")."lime_payments_success.png";
$enroll_message = "무통장 입금 신청 완료";
$direct_url = base_url('my/payments');
$direct_btn_name = "결제 내역으로 이동";
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
                                        <p class="text-black mb-1"><?php echo $item_data->title; ?></p>
                                  </div>
                              </div>
                              <div class="row pl-1 py-1 list_title_btmbar">
                                  <div class="mt-1 mb-2">
                                      <p class="text-primary font-weight-semi-bold mb-1">입금액</p>
                                        <p class="h4 text-danger font-weight-bold mb-1"><?php echo number_format($item_data->price)."원"; ?></p>
                                  </div>
                              </div>                             
                        </div> 
                        <div class="col-12 px-7 mb-1">
                              <div class="row pl-1 py-1 list_title_btmbar">
                                  <div class="mt-3 mb-2">
                                    <p class="text-primary font-weight-semi-bold mb-3">아래의 계좌로 입금해주세요</p>
                                    <p class="mb-4 text-dark-gray"><?php echo $this->settings->bank_transfer;?></p>
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