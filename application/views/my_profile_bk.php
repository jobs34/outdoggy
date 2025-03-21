<?php defined('BASEPATH') OR exit('No direct script access allowed');

  $currency =  get_admin_setting('currency_code');
  $currency_code =  get_currency_symbol($currency);
  $data['is_premium_member'] = $is_premium_member;
  $data['paid_quizes_array'] = $paid_quizes_array;
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
                                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('my/payments')?>"><i class="fe fe-credit-card nav-icon mr-2"></i>결제 내역</a></li>
                                <li class="nav-item active"><a class="nav-link" href="<?php echo base_url('profile')?>"><i class="fe fe-user nav-icon mr-2"></i><?php echo lang('user_profile') ?></a></li>
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
                        <h3 class="mb-0"><?php echo lang('user_profile') ?></h3>
                    </div>
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
            </div>
            <!-- Right 내용 보여주기 E-->
        </div>
    </div>
</div>