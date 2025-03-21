<?php defined('BASEPATH') OR exit('No direct script access allowed');

  $currency =  get_admin_setting('currency_code');
  $currency_code =  get_currency_symbol($currency);
  $data['is_premium_member'] = $is_premium_member;
  $data['paid_quizes_array'] = $paid_quizes_array;
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
                    <span class="mt-0 display-6"><i class="bi bi-pencil-square fa-fw me-1"></i> 사용자 정보 변경</span> <sapn class="pl-2 mt-0 pb-2 font-weight-bold text-light-gray">Edit Information</span>
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
								<a class="list-group-item" href="<?php echo base_url('my/payments')?>"><i class="bi bi-credit-card  fa-fw me-2"></i>결제 내역</a>
								<a class="list-group-item active" href="<?php echo base_url('profile')?>"><i class="bi bi-pencil-square fa-fw me-2"></i>사용자 정보 변경</a>
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
               <div class="card-body" id="registration_form">
                  <div class="row px-2 px-lg-4">
                        <?php echo form_open_multipart('', array('role'=>'form')); ?>
                        <?php // username ?>
                        <div class="row px-0 px-lg-4">
                           <div class="col-12"> 
                              <div class="row">
                                 <div class="form-group col-12 <?php echo form_error('username') ? ' has-error' : ''; ?>">
                                    <?php echo form_label(lang('username'), 'username', array('class'=>'control-label')); ?>
                                    <span class="required"> * </span>
                                    <?php echo form_input(array('name'=>'username', 'id'=>'username','value'=>set_value('username', (isset($user['username']) ? $user['username'] : '')), 'class'=>'form-control','readonly'=>'true')); ?>
                                    <span class="small text-danger"> <?php echo strip_tags(form_error('username')); ?> </span>
                                 </div>
                              </div>
                              <div class="row">
                                 <?php // first name ?>    
                                 <div class="form-group col-12 <?php echo form_error('first_name') ? ' has-error' : ''; ?>">
                                    <?php echo form_label(lang('front_first_name'), 'first_name', array('class'=>'control-label')); ?>
                                    <span class="required">*</span>
                                    <?php echo form_input(array('name'=>'first_name','id'=>'first_name', 'value'=>set_value('first_name', (isset($user['first_name']) ? $user['first_name'] : '')), 'class'=>'form-control')); ?>
                                    <span class="small text-danger"> <?php echo strip_tags(form_error('first_name')); ?> </span>
                                 </div>
                              </div>
                              <div class="row">
                                 <?php // password ?>
                                 <div class="form-group col-12 <?php echo form_error('password') ? ' has-error' : ''; ?>">
                                    <?php echo form_label(lang('password'), 'password', array('class'=>'control-label')); ?>
                                    <?php if ($password_required) : ?>
                                    <span class="required">* </span>
                                    <?php endif; ?>
                                    <?php echo form_password(array('name'=>'password', 'value'=>'', 'class'=>'form-control', 'autocomplete'=>'off')); ?>
                                    <span class="small text-danger"> <?php echo strip_tags(form_error('password')); ?> </span>
                                 </div>
                              </div>
                              <div class="row">
                                 <?php // password repeat ?>
                                 <div class="form-group col-12 <?php echo form_error('password_repeat') ? ' has-error' : ''; ?>">
                                    <?php echo form_label(lang('front_password_repeat'), 'password_repeat', array('class'=>'control-label')); ?>
                                    <?php if ($password_required) : ?>
                                    <span class="required">* </span>
                                    <?php endif; ?>
                                    <?php echo form_password(array('name'=>'password_repeat', 'value'=>'', 'class'=>'form-control', 'autocomplete'=>'off')); ?>
                                    <span class="small text-danger"> <?php echo strip_tags(form_error('password_repeat')); ?> </span>
                                 </div>
                                 <?php if ( ! $password_required) : ?>
                                 <div class="col-12 mb-3">
                                    <span class="help-block text-warning"><?php echo lang('help_passwords'); ?></span>
                                 </div>
                                 <?php endif; ?>
                              </div>
                              <div class="row">
                                 <?php // email ?>
                                 <div class="form-group col-12 <?php echo form_error('email') ? ' has-error' : ''; ?>">
                                    <?php echo form_label(lang('front_email'), 'email', array('class'=>'control-label')); ?>
                                    <span class="required">*</span>
                                    <?php echo form_input(array('name'=>'email', 'value'=>set_value('email', (isset($user['email']) ? $user['email'] : '')), 'class'=>'form-control', 'type'=>'email')); ?>
                                    <span class="small text-danger"> <?php echo strip_tags(form_error('email')); ?> </span>
                                 </div>
                              </div>
                              <div class="row">  
                                    <?php // 전화번호 ?>
                                    <div class="form-group col-12<?php echo form_error('cel_num') ? ' has-error' : ''; ?>">
                                       <?php echo form_label('전화번호(-없이 숫자만 작성하세요)', 'cel_num', array('class'=>'control-label')); ?>
                                       <?php echo form_input(array('name'=>'cel_num', 'value'=>set_value('cel_num', (isset($user['cel_num']) ? $user['cel_num'] : '')), 'class'=>'form-control')); ?>
                                       <span class="small text-danger"> <?php echo strip_tags(form_error('cel_num')); ?> </span>
                                    </div>
                              </div>     
                              <?php // buttons ?>
                              <div class="row ">
                                 <div class="form-group col-12 mt-3"> 
                                    <?php if ($this->session->userdata('logged_in')) : ?>
                                    <button type="submit" name="submit" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-save"></span> <?php echo lang('core_button_save'); ?></button>
                                    <?php else : ?>
                                    <button type="submit" name="submit" class="btn btn-block btn-primary btn-lg"><?php echo lang('users_register'); ?></button>
                                    <?php endif; ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <?php echo form_close(); ?>                    
                        
                  </div>                        
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