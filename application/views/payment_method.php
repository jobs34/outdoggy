<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if ($payment_pending_status){
    $this->session->set_flashdata('error', "이미 신청하신 강좌입니다.");
   return redirect(base_url("study-content/$quiz_id"));
}
$item_id = $quiz_id;
$purchases_type = "material";
$product_name = $item_data->title;
$product_price = $item_data->price;
$customer_name = (isset($this->user['first_name']) && !empty($this->user['first_name']) ? $this->user['first_name']: "");
$token_value = date('Y-mdHis');
$card_image_url = base_url("assets/images/")."card_common.png";
?>

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
              <h3 class="mb-0 text-white font-weight-bold">결제하기</h3>
            </div>
            <!-- Card body -->
            <div class="card-body">
                <div class="col-12 px-2 mb-1">
                      <div class="row px-3 pb-3 list_title_btmbar">
                          <div class="mt-1 mb-0">
                              <p class="text-primary font-weight-semi-bold mb-1">신청 강좌</p>
                                <p class="text-black font-weight-semi-bold mb-1"><?php echo $item_data->title; ?></p>
                          </div>
                      </div>
                      <div class="row px-3 pt-2 pb-3 list_title_btmbar">
                          <div class="mt-1 mb-0">
                              <p class="text-primary font-weight-semi-bold mb-1">결제 금액</p>
                              <p class="text-black pl-1 h4 font-weight-semi-bold mb-1"><?php echo number_format($item_data->price)."원"; ?></p>
                          </div>
                      </div>                         
                </div>
                <div class="col-12 px-2 mb-1">                 
                      <div class="row px-3 pt-3 pb-0">
                        <p class="text-primary font-weight-semi-bold mb-1">결제 수단</p>
                      </div>         
                     <div class="row pl-0 pt-4 pb-2">
                        <div class="col-12 col-lg-6">
                            <span class="btn btn-block btn-outline-dark mb-3" data-toggle="modal" data-target="#ModalCard" title="신용카드">신용카드</span>
                        </div>
                        <div class="col-12 col-lg-6">
                            <span class="btn btn-block btn-outline-dark mb-3" data-toggle="modal" data-target="#ModalBank" title="무통장 입금">무통장 입금</span>
                        </div>
                          
                      </div>    
                  </div>                
            </div>
        </div>
        <div class="col-md-3"> </div>
      </div>
  </div> 
</div>  

<input type="hidden" class="transaction_no" value="<?php echo $token_value;?>">
<input type="hidden" class="quiz_id" value="<?php echo $item_id;?>">
<input type="hidden" class="purchases_type" value="<?php echo $purchases_type;?>">
<input type="hidden" class="customer_name" value="<?php echo $customer_name;?>">

<div class="modal fade" id="ModalBank" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">무통장 입금 선택</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="px-3 pt-3 pb-4 mb-2 bg-light-info">
          <?php echo $this->settings->bank_transfer;?>
        </div>   
        <div class="px-2 form-group">
          <label class="col-form-label">입금자 명:</label>
          <input type="text" class="form-control" name="payer_name" id="payer_name" value="<?php echo $customer_name;?>" placeholder="입금자명을 기입해주세요">
        </div>
      </div>
      <div class="modal-footer justify-content-center">
        <input type="submit" id="save_bankpay" value="무통장 입금 진행" name="save_bankpay" class="btn btn-dark-pink save-data">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">결제 취소</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="ModalCard" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">신용 카드 선택</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body justify-content-center">
        <div class="px-3 pt-3 pb-2 mb-1 text-center">
          <div class="justify-content-center position-relative"><img src="<?php echo $card_image_url; ?>" class="mb-1"/></div>
           <h3 class="mb-1 font-weight-bold">신용카드로 신청 - 최종 확인</h3>
           <p class="mb-0">다음 단계로 이동합니다.</p>
        </div>   
        <div class="px-2 form-group">
            
        </div>
      </div>
      <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">취소하기</button>
          <input type="submit" id="save_cardpay" name="save_cardpay" value="다음 단계로 이동 >" class="btn btn-success save-data">
      </div>
    </div>
  </div>
</div>