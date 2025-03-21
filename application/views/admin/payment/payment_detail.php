<div class="row">
    <div class="col-md-12 col-xl-12 col-sm-12 mt-3">
            상품명: <strong><?php echo $payment_data->item_name;?></strong>
    </div>
    <hr class="w-100">
    <div class="col-md-6 col-xl-6 col-sm-12 mt-2">
        <div>
            <label>이름:</label> <strong><?php echo $payment_data->first_name?></strong>
        </div>
    </div>
    <div class="col-md-6 col-xl-6 col-sm-12 mt-2">
        <div>
            <label>메일:</label> <?php echo $payment_data->email;?>
        </div>
    </div>
    <hr class="w-100">
    <div class="col-md-12 col-xl-12 col-sm-12 mt-2">
        <?php $payment_gateway = ($payment_data->payment_gateway == "card") ? "신용카드" : "무통장 입금" ;?>    
        <div>
            <label>결제 방법 :</label> <strong><?php echo $payment_gateway;?></strong> / 입금자명 : <?php echo $payment_data->payer_name;?>
        </div>         
    </div>
    <div class="col-md-6 col-xl-6 col-sm-12 mt-2">
        <div>
            <label>결제 금액 :</label> <strong><?php echo $payment_data->item_price;?>원</strong>
        </div> 
    </div>
    <div class="col-md-6 col-xl-6 col-sm-12 mt-2">
            <?php 
                if($payment_data->payment_status == 'succeeded')
                {
                    $status = '입금 완료';
                }
                elseif($payment_data->payment_status == 'fail')
                {
                    $status = '취소';
                }
                elseif($payment_data->payment_status == 'pending')
                {
                    $status = '입금 전';
                }
                else
                {
                    $status = '';   
                }
            ?>
            결제 상태 : <strong><?php echo $status;?></strong>      
    </div>
    <hr class="w-100">
    <div class="col-md-12 col-xl-12 col-sm-12 mt-3">
        <div>
            <label>신청일 : </label> <span class=""><?php echo get_date_or_time_formate($payment_data->created);?></span> 
        </div> 
    </div>
    
</div>    