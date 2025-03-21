<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$base_image_url = base_url("assets/images/")."lime_payments_error.png";
$enroll_message = "무통장 입금 신청이</br>실패했습니다.";
$direct_url = base_url('study-content/').$item_id;
$direct_btn_name = "다시 신청하기";
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
                                <div class="pt-4 pb-1">
                                    <p class="display-5 text-center"><?php echo $enroll_message; ?></p>
                                </div>
                            </div>
                        </div>         
                        <div class="col-12 px-7 mb-1">
                              <div class="row  justify-content-center list_title_btmbar">
                                  <div class="mt-1 mb-2">
                                    <p class="mb-1 text-primary text-center">무통장 입금 신청에 조금 문제가 있었습니다. </br>번거롭지만 다시 한번 시도해주세요.</p>
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