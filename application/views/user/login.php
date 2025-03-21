<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container-fluid d-flex flex-column bg-medium-gray min-h-100vh">
    <div class="row align-items-center justify-content-center">
        <div class="col-12 col-xl-4 col-md-6 pt-10 pb-16 pt-xl-20 pb-xl-18">
            <!-- Card -->
            <div class="card shadow ">
                <!-- Card body -->
                <div class="card-body px-6 pt-6 pb-10">
                    <div class="mb-8">
                        <h1 class="mb-3 font-weight-bold"><?php echo lang('login') ?></h1>
                        <span>아직 회원이 아니신가요?<a href="<?php echo base_url('user/register'); ?>" class="ml-1"><?php echo lang('user_link_register_account') ?></a></span>
                    </div>
                    <!-- Form -->
                    <?php echo form_open('', array('class'=>'form-signin formlogin')); ?>
                    <!-- 아이디 -->
                    <div class="form-group">
                        <?php echo form_input(array('name'=>'username', 'id'=>'username', 'class'=>'form-control', 'placeholder'=>lang('user_username_email'), 'maxlength'=>256)); ?>
                        <span class="small text-danger"> <?php echo strip_tags(form_error('username')); ?> </span>
                    </div>
                    <!-- 비밀번호 -->
                    <div class="form-group">
                        <?php echo form_password(array('name'=>'password', 'id'=>'password', 'class'=>'form-control', 'placeholder'=>lang('password'), 'maxlength'=>72, 'autocomplete'=>'off')); ?>
                        <span class="small text-danger"> <?php echo strip_tags(form_error('password')); ?> </span>
                    </div>
                    <!-- 비밀번호 찾기 -->
                    <div class="mb-8">
                        <div>
                            <a href="<?php echo base_url('user/forgot'); ?>"><?php echo lang('user_forgot_password'); ?></a>
                        </div>
                    </div>
                <!-- Button -->
                <?php echo form_submit(array('name'=>'submit', 'class'=>'btn btn-primary btn-lg btn-block'), lang('core_button_login')); ?>
                </div>
                <?php echo form_close(); ?> 
                </div>
            </div>
        </div>
    </div>
</div>