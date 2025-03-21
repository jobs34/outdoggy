<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if($enroll_status){
    $base_image_url = base_url("assets/images/")."lime_payments_success.png";
    $enroll_message = "수강신청이 완료되었습니다.";
    $direct_url = base_url('study-material/').$item_id;
    $direct_btn_name = "강좌로 바로 이동";
}
else{
    $base_image_url = base_url("assets/images/")."lime_payments_error.png";
    $enroll_message = "수강신청이 실패했습니다.";
    $direct_url = base_url('study-content/').$item_id;
    $direct_btn_name = "돌아가기";
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
                                    <div class="pt-3 pb-4">
                                        <p class="display-5 text-center"><?php echo $enroll_message; ?></p>
                                    </div>
                                </div>
                            </div>         
                            <div class="col-12 px-7 mb-1">
                                  <div class="row pl-1 py-1 list_title_btmbar">
                                      <div class="mt-1 mb-0">
                                          <p class="text-primary mb-1">신청 강좌</p>
                                            <p class="text-black font-weight-semi-bold mb-1"><?php echo $item_data->title; ?></p>
                                      </div>
                                  </div>
                                  <div class="row pl-1 py-1 list_title_btmbar">
                                      <div class="mt-1 mb-0">
                                          <p class="text-primary mb-1">결제 금액</p>
                                            <p class="text-black font-weight-semi-bold mb-1"><?php echo number_format($item_data->price)."원 (무료)"; ?></p>
                                      </div>
                                  </div> 
                                   <div class="row pl-1 py-1 list_title_btmbar">
                                      <div class="mt-1 mb-0">
                                          <p class="text-primary mb-1">신청 일자</p>
                                            <p class="text-black font-weight-semi-bold mb-1"><?php echo $enroll_date; ?></p>
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