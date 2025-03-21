<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Page content -->
<div class="container-fluid d-flex flex-column bg-medium-gray min-h-100vh">
    <div class="row align-items-center justify-content-center">
        <div class="col-12 col-xl-4 col-md-6 pt-10 pb-16 pt-xl-12 pb-xl-18">
            <!-- Card -->
            <div class="card shadow">
                <!-- Card body -->
                <div class="card-body p-8" id="registration_form"> 
                    <div class="mb-4">
                        <h1 class="mb-1 font-weight-bold"><?php echo lang('front_register') ?></h1>
                    </div>
                    <!-- Form -->
                    <?php echo form_open_multipart('', array('role'=>'form')); ?>
                    <!-- 아이디 -->
                    <div class="row">  
                        <div class="form-group col-12<?php echo form_error('username') ? ' has-error' : ''; ?>">
                            <?php echo form_label(lang('username'), 'username', array('class'=>'control-label')); ?>                       
                            <?php echo form_input(array('name'=>'username', 'id'=>'username','value'=>set_value('username', (isset($user['username']) ? $user['username'] : '')), 'class'=>'form-control')); ?>
                            <span class="small text-danger"> <?php echo strip_tags(form_error('username')); ?> </span>                           
                        </div>
                    </div>                        
                    <!-- 이름 -->
                    <div class="row">  
                        <div class="form-group col-12<?php echo form_error('first_name') ? ' has-error' : ''; ?>">   
                            <?php echo form_label(lang('front_first_name'), 'first_name', array('class'=>'control-label')); ?>
                            <?php echo form_input(array('name'=>'first_name','id'=>'first_name', 'value'=>set_value('first_name', (isset($user['first_name']) ? $user['first_name'] : '')), 'class'=>'form-control')); ?>
                            <span class="small text-danger"> <?php echo strip_tags(form_error('first_name')); ?> </span>                                                   
                        </div>
                    </div>                    
            
                    <!-- 비밀번호 -->
                    <div class="row">  
                        <div class="form-group col-12<?php echo form_error('password') ? ' has-error' : ''; ?>">
                            <?php echo form_label(lang('password'), 'password', array('class'=>'control-label')); ?>
                            <?php echo form_password(array('name'=>'password', 'value'=>'', 'class'=>'form-control', 'autocomplete'=>'off')); ?>
                            <span class="small text-danger"> <?php echo strip_tags(form_error('password')); ?> </span>
                        </div>
                    </div>
                    <!-- 비밀번호 확인-->
                    <div class="row">  
                        <div class="form-group col-12<?php echo form_error('password_repeat') ? ' has-error' : ''; ?>">
                            <?php echo form_label(lang('front_password_repeat'), 'password_repeat', array('class'=>'control-label')); ?>
                            <?php echo form_password(array('name'=>'password_repeat', 'value'=>'', 'class'=>'form-control', 'autocomplete'=>'off')); ?>
                            <span class="small text-danger"> <?php echo strip_tags(form_error('password_repeat')); ?> </span>
                        </div>
                    </div> 
                    <!-- Email -->  
                    <div class="row">  
                        <div class="form-group col-12<?php echo form_error('email') ? ' has-error' : ''; ?>">
                            <?php echo form_label(lang('front_email'), 'email', array('class'=>'control-label')); ?>
                            <?php echo form_input(array('name'=>'email', 'value'=>set_value('email', (isset($user['email']) ? $user['email'] : '')), 'class'=>'form-control', 'type'=>'email')); ?>
                            <span class="small text-danger"> <?php echo strip_tags(form_error('email')); ?> </span>
                        </div>
                    </div> 
                    <!-- 전화번호 -->  
                    <div class="row">  
                        <div class="form-group col-12<?php echo form_error('cel_num') ? ' has-error' : ''; ?>">
                            <?php echo form_label('전화번호(-없이 숫자만 작성하세요)', 'cel_num', array('class'=>'control-label')); ?>
                            <?php echo form_input(array('name'=>'cel_num', 'value'=>set_value('cel_num', (isset($user['cel_num']) ? $user['cel_num'] : '')), 'class'=>'form-control')); ?>
                            <span class="small text-danger"> <?php echo strip_tags(form_error('cel_num')); ?> </span>
                        </div>
                    </div>                     
                    <!-- 버튼 -->
                    <div class="row ">
                        <div class="form-group col-12 mt-3"> 
                            <?php if ($this->session->userdata('logged_in')) : ?>
                            <button type="submit" name="submit" class="btn btn-block btn-success"><span class="glyphicon glyphicon-save"></span> <?php echo lang('core_button_save'); ?></button>
                            <?php else : ?>
                            <button type="submit" name="submit" class="btn btn-block btn-primary btn-lg"><?php echo lang('users_register'); ?></button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php echo form_close(); ?>                   
                    <div class="mt-2 mb-2 justify-content-center text-center">
                        <span>회원이신가요?
                        <a href="<?php echo base_url('login'); ?>" class="ml-1"><?php echo lang('login') ?></a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
  if ($this->session->userdata('logged_in')) : 
     if(uri_string() == 'user/register')
     {
        return redirect(base_url('profile'));
     }
  endif;
?>

