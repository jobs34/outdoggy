<?php 
  $user_id = isset($this->user['id']) ? $this->user['id'] : 0;
  $data['user_id'] = $user_id;
?>
<!-- Page Content -->
<!-- **************** MAIN CONTENT START **************** -->
<main>
<!-- =======================
Page Banner START -->
<section class="pt-3 pb-2">
	<div class="container mt-1 px-1">
		<div class="row">
			<div class="col-12">
				<div class="pb-2 px-2 mt-1 mt-sm-0">
                    <span class="mt-0 display-6"><i class="bi bi-credit-card fa-fw me-1"></i> 결제 내역</span> <sapn class="pl-2 mt-0 pb-2 font-weight-bold text-light-gray">My payments</span>
				</div>
				<!-- Advanced filter responsive toggler START -->
				<!-- Divider -->
				<hr class="d-xl-none">
				<div class="col-12 col-xl-3 px-3 d-flex justify-content-between align-items-center">
					<a class="h5 mb-0 fw-bold d-xl-none" href="#">마이페이지 메뉴</a>
					<button class="btn btn-primary d-xl-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
						<i class="fas fa-sliders-h"></i>
					</button>
				</div>
				<!-- Advanced filter responsive toggler END -->
			</div>
		</div>
	</div>
</section>
<!-- =======================
Page Banner END -->

<!-- =======================
Page content START -->
<section class="pt-0">
	<div class="container">
		<div class="row">
			<!-- Left sidebar START -->
			<div class="col-xl-3">
				<!-- Responsive offcanvas body START -->
				<div class="offcanvas-xl offcanvas-end" tabindex="-1" id="offcanvasSidebar">
					<!-- Offcanvas header -->
					<div class="offcanvas-header bg-light">
						<h5 class="offcanvas-title" id="offcanvasNavbarLabel">마이 페이지 메뉴</h5>
						<button  type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#offcanvasSidebar" aria-label="Close">X</button>
					</div>
					<!-- Offcanvas body -->
					<div class="offcanvas-body p-3 p-xl-0">
						<div class="bg-dark border rounded-3 p-3 w-100">
							<!-- Dashboard menu -->
							<div class="list-group list-group-dark list-group-borderless collapse-list">
								<a class="list-group-item" href="<?php echo base_url("mypage");?>"><i class="bi bi-ui-checks-grid fa-fw me-2"></i>마이 페이지</a>
								<a class="list-group-item" href="<?php echo base_url('my/study')?>"><i class="bi bi-laptop fa-fw me-2"></i>수강중인 클래스</a>
								<a class="list-group-item active" href="<?php echo base_url('my/payments')?>"><i class="bi bi-credit-card  fa-fw me-2"></i>결제 내역</a>
								<a class="list-group-item" href="<?php echo base_url('profile')?>"><i class="bi bi-pencil-square fa-fw me-2"></i>사용자 정보 변경</a>
								<a class="list-group-item text-danger bg-danger-soft-hover" href="<?php echo base_url("logout");?>"><i class="fas fa-sign-out-alt fa-fw me-2"></i>로그아웃</a>
							</div>
						</div>
					</div>
				</div>
				<!-- Responsive offcanvas body END -->
			</div>
			<!-- Left sidebar END -->

			<!-- Main content START -->
			<div class="col-xl-9">
                <!-- Card -->
                <div class="card mx-3">
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
			<!-- Main content END -->
			</div><!-- Row END -->
		</div>
	</div>	
</section>
<!-- =======================
Page content END -->
</main>
<!-- **************** MAIN CONTENT END **************** -->