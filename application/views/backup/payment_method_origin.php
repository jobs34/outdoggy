<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
	<div class="row">	
        <div class="col-md-4"> </div>
        <div class="col-md-4">  
            <div class="card mt-5">
                <div class="card-header bg-success text-white"><?php echo $item_data->title; ?> (<?php echo $this->settings->paid_currency ." ". $item_data->price; ?>)</div>
                <div class="card-body bg-light">
                    
                    
                    <?php 
                    if(!empty($this->settings->paypal_key) && !empty($this->settings->paypal_secret_key) && !empty($this->settings->paid_currency))
                    { ?>

                        <div class="mb-3">
                            <?php echo form_open(base_url("paypal/payment/quiz-pay/$purchases_type/$quiz_id"), array('role'=>'form')); ?>
                                <input type="hidden" name="plan_name" value="<?php echo $item_data->title; ?>" /> 
                                <input type="hidden" name="plan_description" value="<?php echo $item_data->description; ?>" />
                                <input type="submit" name="subscribe" value="<?php echo lang('paypal_payment_getway') ?>" class="btn-subscribe btn btn-primary btn-block" />
                            <?php echo form_close();  ?>
                        </div>

                        <?php 
                    } ?>



                    <?php     
                    if(!empty($this->settings->stripe_key) && !empty($this->settings->stripe_secret_key) && !empty($this->settings->paid_currency))
                    { ?>        
                        <a href="<?php echo base_url("stripe/pay-now/$purchases_type/$quiz_id"); ?>" class="btn   btn-block btn-warning mb-3"><?php echo lang('stripe_payment_getway'); ?></a>  
                        <?php 
                    }   ?>

                    <?php
                    if($this->settings->instamojo_apikey && $this->settings->instamojo_token && $this->settings->paid_currency && $this->settings->paid_currency == "INR")
                    { ?>
                        <a href="<?php echo base_url("instamojo/$purchases_type/$quiz_id"); ?>" class="btn btn-block btn-dark mb-3"><?php echo lang('instamojo_payment_getway'); ?></a>
                        <?php 
                    } ?> 


                    <?php
                    if(!empty($this->settings->razorpay_key) && !empty($this->settings->razorpay_secret_key) && !empty($this->settings->paid_currency))
                    { ?>
                        <a href="<?php echo base_url("razorpay/checkout/$purchases_type/$quiz_id"); ?>" class="btn btn-block btn-danger mb-3"><?php echo lang('razorpay_payment_getway'); ?></a>  
                        <?php 
                    } ?>

                    <?php

                    if(!empty(strip_tags($this->settings->bank_transfer)) && !empty($this->settings->paid_currency)) 
                    { ?>
                        <span class="btn btn-block btn-info mb-3" data-toggle="modal" data-target="#myModal" title="<?php echo lang('pay_by_bank_transfer'); ?>"><?php echo lang('pay_by_bank_transfer'); ?></span>
                        <?php 
                    } ?>

                </div>
            </div>      
        </div>

        <div class="col-md-4"> </div>
        <div class="clearfix"></div>
    </div>
</div> 

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Bank Transfer Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

       <?php //echo form_open('',array('role'=>'form')); ?>  

            <div class="modal-body">
                <?php echo $this->settings->bank_transfer;

                ?>   
                  <div class="form-group">
                    <label for="transaction-no" class="col-form-label">Reference No / Transaction No.:</label>
                    
                    <?php $token_value = (isset($payment_pending_status->token_no) && !empty($payment_pending_status->token_no) ? $payment_pending_status->token_no : "");?>
                    <input type="text" class="form-control" name="transaction_no" id="transaction-no" value="<?php echo $token_value;?>" placeholder="Enter your transaction/reference number">
                    <span class="bank text-danger"></span>
                    <input type="hidden" class="quiz_id" value="<?php echo $quiz_id;?>">
                    <input type="hidden" class="purchases_type" value="<?php echo $purchases_type;?>">
                    <input type="hidden" class="item-price" value="<?php echo $item_data->price;?>">
                  </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <?php $save_update = (isset($token_value) && !empty($token_value) ? 'update-data' : 'save-data');?>
                <input type="submit" name="save" class="btn btn-primary <?php echo $save_update;?>">
            </div>

      <?php //echo form_close();?>    

    </div>
  </div>
</div>
