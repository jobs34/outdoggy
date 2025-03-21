<?php defined('BASEPATH') OR exit('No direct script access allowed');

  $currency =  get_admin_setting('currency_code');
  $currency_code =  get_currency_symbol($currency);
  $data['is_premium_member'] = $is_premium_member;
  $data['paid_quizes_array'] = $paid_quizes_array;
?>
<!-- Page Content -->
	<div class="pt-5 pb-5 bg-light-gray min-h-100vh">
		<div class="container">
				<!-- User info -->
			<div class="row align-items-center">
				<div class="col-xl-12 col-lg-12 col-md-12 col-12">
					<!-- Bg -->
					<div class="pt-8 rounded-top" style="
								background: url(<?php echo base_url()?>assets/images/profile-bg.jpg) no-repeat;
								background-size: cover;
							"></div>
					<div
						class="d-flex align-items-end justify-content-between bg-white px-4 pt-2 pb-4 rounded-none  shadow-sm">
						<div class="d-flex align-items-center">
							<div class="position-relative d-flex justify-content-end align-items-end mt-2">
                        <h2><i class="fe fe-user nav-icon ml-1 mr-3 "></i></h2>
							</div>
							<div class="lh-1">
								<h3 class="mb-0">
                        <?php echo $user['first_name']; ?><span class="small"> / </span><?php echo $user['username']; ?>
								</h3>
							</div>
						</div>
						<div>
							<a href="<?php echo base_url('my/history')?>" class="btn btn-outline-primary btn-sm d-none d-md-block">지난 테스트 내역</a>
						</div>
					</div>
				</div>
			</div>
	   <!-- Content -->
		<div class="row">
        <div class="col-12 mb-4 mb-xl-0">
          <!-- Card -->
          <div class="card mb-5">
            <!-- Nav tabs -->
            <ul class="nav nav-lt-tab" id="tab" role="tablist">
               <!-- Nav item -->
              <li class="nav-item">
                <a class="nav-link active" id="profile-tab" data-toggle="pill" href="#profile" role="tab"
                  aria-controls="profile" aria-selected="false"><?php echo lang('profile_user'); ?></a>
              </li>
              <!-- Nav item -->
              <li class="nav-item">
                <a class="nav-link" id="quiz-like-tab" data-toggle="pill" href="#quiz-like" role="tab"
                  aria-controls="quiz-like" aria-selected="false"><?php echo lang('like_quiz'); ?></a>
              </li>
              <!-- Nav item -->
              <li class="nav-item">
                <a class="nav-link" id="post-like-tab" data-toggle="pill" href="#post-like" role="tab" aria-controls="post-like"
                  aria-selected="false"><?php echo lang('like_post'); ?></a>
              </li>        
            </ul>
          </div>
          <!-- Card -->
          <div class="card rounded-lg">
            <!-- Card body -->
            <div class="card-body">
              <!-- #########  탭 몸뚱아리 S ########--> 
              <div class="tab-content" id="tabContent">
                  <!-- Tab 1 : 프로필-->
                  <div class="tab-pane fade show active" id="profile" role="tabpanel"
                     aria-labelledby="profile-tab">
                    <div class="mb-4">
                        <div>
                            <h3 class="mb-2"><?php echo lang('profile_user'); ?></h3>
                            <hr class="mb-4">                          
                            <div class="card-body" id="registration_form">
                              <?php echo form_open_multipart('', array('role'=>'form')); ?>
                              <?php // username ?>
                              <div class="row">
                                 <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2"> 
                                    <div class="row">
                                       <div class="form-group col-12 col-lg-8<?php echo form_error('username') ? ' has-error' : ''; ?>">
                                          <?php echo form_label(lang('username'), 'username', array('class'=>'control-label')); ?>
                                          <span class="required"> * </span>
                                          <?php echo form_input(array('name'=>'username', 'id'=>'username','value'=>set_value('username', (isset($user['username']) ? $user['username'] : '')), 'class'=>'form-control','readonly'=>'true')); ?>
                                          <span class="small text-danger"> <?php echo strip_tags(form_error('username')); ?> </span>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <?php // first name ?>    
                                       <div class="form-group col-12 col-lg-8<?php echo form_error('first_name') ? ' has-error' : ''; ?>">
                                          <?php echo form_label(lang('front_first_name'), 'first_name', array('class'=>'control-label')); ?>
                                          <span class="required">*</span>
                                          <?php echo form_input(array('name'=>'first_name','id'=>'first_name', 'value'=>set_value('first_name', (isset($user['first_name']) ? $user['first_name'] : '')), 'class'=>'form-control')); ?>
                                          <span class="small text-danger"> <?php echo strip_tags(form_error('first_name')); ?> </span>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <?php // email ?>
                                       <div class="form-group col-12 col-lg-8<?php echo form_error('email') ? ' has-error' : ''; ?>">
                                          <?php echo form_label(lang('front_email'), 'email', array('class'=>'control-label')); ?>
                                          <span class="required">*</span>
                                          <?php echo form_input(array('name'=>'email', 'value'=>set_value('email', (isset($user['email']) ? $user['email'] : '')), 'class'=>'form-control', 'type'=>'email')); ?>
                                          <span class="small text-danger"> <?php echo strip_tags(form_error('email')); ?> </span>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <?php // password ?>
                                       <div class="form-group col-12 col-lg-8<?php echo form_error('password') ? ' has-error' : ''; ?>">
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
                                       <div class="form-group col-12 col-lg-8<?php echo form_error('password_repeat') ? ' has-error' : ''; ?>">
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
                  <!-- Tab 2 : 퀴즈 구매-->
                  <div class="tab-pane fade" id="quiz-purchased" role="tabpanel" aria-labelledby="quiz-purchased-tab">
                     <div class="mb-4">
                     <h3 class="mb-2">quiz-purchased</h3>
                     </div>
                  </div>
                  <!-- Tab 3 : 좋아하는 테스트-->
                  <div class="tab-pane fade" id="quiz-like" role="tabpanel" aria-labelledby="quiz-like-tab">
                     <div class="mb-4">
                     <h3 class="mb-2"><?php echo lang('like_quiz'); ?></h3>
                     <hr class="mb-4">    
                        <div class="row">
                              <?php 
                                 $data['quiz_list_data'] = $quiz_data;
                                 $this->load->view('quiz_data_list',$data); 
                              ?>   
                        </div>
                     </div>
                  </div>
                  <!-- Tab 4 : 좋아하는 포스트-->                
                  <div class="tab-pane fade" id="post-like" role="tabpanel" aria-labelledby="post-like-tab">
                     <div class="mb-4">
                     <h3 class="mb-2"><?php echo lang('like_post'); ?></h3>
                     <hr class="mb-4">    
                     <div class="row">
                           <?php 
                              $data['blog_list_data'] = $like_post;
                              $this->load->view('common_blog_list',$data);
                           ?>
                        </div>  
                     </div>
                  </div>
                  <!-- Tab 5 : 프로필-->
                  <div class="tab-pane fade" id="payment-list" role="tabpanel" aria-labelledby="payment-list-tab">
                     <div class="mb-4">
                     <h3 class="mb-2">payment-list</h3>
                     </div>
                  </div>
              </div>
              <!-- #########  탭 몸뚱아리 E ########-->              
            </div>
          </div>
        </div>

      </div>
		</div>
	</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="myModalLabel">Payment Detail</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 

            </div>
            <div class="modal-body payment-data"></div>
            <div class="modal-footer">
                <a target="_blank" class="btn btn-info invoice-bill"><?php echo lang('invoice');?></a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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