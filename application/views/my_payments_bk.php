<?php 
  $user_id = isset($this->user['id']) ? $this->user['id'] : 0;
  $data['user_id'] = $user_id;
?>
<!-- Page Content -->
<div class="pt-4 pb-4 bg-light-gray min-h-100vh">
    <div class="container">
        <div class="row mt-0 mt-md-4">
            <!-- Left 사이드 바/모바일에서는 상단 바 S-->
            <div class="col-lg-3 col-md-4 col-12">
                <nav class="navbar navbar-expand-md navbar-light shadow-sm mb-4 mb-lg-0 sidenav">
                     <!-- 모바일 Menu 명-->
                    <a class="d-xl-none d-lg-none d-md-none text-inherit font-weight-bold" href="#!">마이 페이지</a>
                    <!-- Button -->
                    <button class="navbar-toggler d-md-none icon-shape icon-sm rounded bg-primary text-light" type="button" data-toggle="collapse" data-target="#sidenav" aria-controls="sidenav" aria-expanded="false" aria-label="Toggle navigation"><span class="fe fe-menu"></span></button>
                    <!-- Collapse navbar -->
                    <div class="collapse navbar-collapse mt-1" id="sidenav">
                        <div class="navbar-nav flex-column">
                            <!-- PC Menu 명-->
                            <div class=" d-lg-block d-md-block d-sm-none"><p class="mb-1 display-7"><?php echo $this->user['first_name']; ?></p><h6 class="mb-4 text-light-gray"><?php echo $this->user['email']; ?></h6></div>
                            <!-- List -->
                            <ul class="list-unstyled ml-n2 mb-4">
                                <!-- Nav item -->
                                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('my/study')?>"><i class="fe fe-star nav-icon mr-2"></i>나의 강좌</a></li>
                                <li class="nav-item active"><a class="nav-link" href="<?php echo base_url('my/payments')?>"><i class="fe fe-credit-card nav-icon mr-2"></i>결제 내역</a></li>
                                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('profile')?>"><i class="fe fe-user nav-icon mr-2"></i><?php echo lang('user_profile') ?></a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <!-- Left 사이드 바/모바일에서는 상단 바 E-->
            <!-- Right 내용 보여주기 S-->
            <div class="col-lg-9 col-md-8 col-12">
                <!-- Card -->
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <h3 class="mb-0">결제 내역</h3>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                    <?php
                        if($user_payments_history)  
                        { 
                    ?>
                        <!-- List group -->
                        <ul class="list-group list-group-flush">
                            
                        <?php
                            foreach ($user_payments_history as $history_array) 
                            {
                                $show_bankinfo = FALSE;
                                $show_invoice = FALSE;
                                $created_date = $history_array->created;
                                $item_name = $history_array->item_name;
                                $item_price = $history_array->item_price;
                                
                                if($history_array->payment_gateway == "bank") 
                                {
                                    $payment_gateway = "무통장 입금";
                                    if ($history_array->payment_status == "succeeded") {
                                        $payment_status = "결제 완료";
                                        $show_invoice = TRUE;
                                    }
                                    elseif($history_array->payment_status == "pending"){
                                        $payment_status = "입금 확인 전";
                                        $show_bankinfo = TRUE;
                                    }
                                    elseif ($history_array->payment_status == "fail") {
                                        $payment_status = "결제 취소";
                                    }
                                    
                                    else
                                    {
                                        $payment_status = "미확인";
                                    }
                                }
                                else {
                                    $payment_gateway = "신용 카드";
                                     if ($history_array->payment_status == "succeeded") {
                                        $payment_status = "결제 완료";
                                        $show_invoice = TRUE;
                                    }
                                    elseif ($history_array->payment_status == "fail") {
                                        $payment_status = "결제 취소";
                                    }
                                    else{
                                        $payment_status = "미확인";
                                    }
                                }
                                
                                
                                ?>
                                    <!-- // 아이템 영역 S//-->
                                     <!-- List group item -->
                                    <li class="list-group-item px-0 py-3">         
                                        <div class="col-12 px-1 px-lg-3 text-black">
                                            <div class="mb-3">
                                                <span class="badge badge-success mr-2"><?php echo $payment_status; ?></span><span class="mb-0 font-size-sm"><?php echo $created_date; ?></span>
                                            </div>
                                            <div class="px-1">
                                                <h5 class="mb-3"><?php echo $item_name; ?></h5>
                                                <p class="mb-1 font-size-sm text-dark-gray"><span class="mr-4">결제 금액</span><span class="font-weight-semi-bold"><?php echo $item_price; ?>원</span></p>
                                                <p class="mb-2 font-size-sm text-dark-gray"><span class="mr-4">결제 수단</span><span class="font-weight-semi-bold"><?php echo $payment_gateway; ?></span></p>
                                                <?php if($show_bankinfo) { ?>
                                                    <div class="mb-1 font-size-sm text-dark-gray px-3 pt-3 pb-4 mr-4 mb-2 bg-light-gray">
                                                <?php echo $this->settings->bank_transfer;?>
                                                </div>
                                                <?php }?>
                                            </div>
                                        </div>
                                    </li>                                   
                                    <!-- // 아이템 영역 E//-->     
                                <?php 
                            } ?>
                        </ul>
                    <?php    
                        } ?>  
                    </div>
                </div>                
            </div>
            <!-- Right 내용 보여주기 E-->
        </div>
    </div>
</div>