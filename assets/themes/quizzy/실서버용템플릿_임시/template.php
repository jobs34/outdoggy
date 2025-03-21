<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<?php
    $login_user_id = isset($this->user['id']) ? $this->user['id'] : 0;
    $disable_right_click = get_admin_setting('disable_right_click');
    $disable_print_screen = get_admin_setting('disable_print_screen');
    $disable_cut_copy_paste = get_admin_setting('disable_copy_paste_click');
    $hader_logo_height = get_admin_setting('header_logo_height');
    $hader_logo_height = $hader_logo_height > 1 ? $hader_logo_height : 65;
        
    $flash_error_msg =  str_replace("'","`",$this->session->flashdata('error'));
    $flash_success_msg =  str_replace("'","`",$this->session->flashdata('message'));
    $user_id = isset($this->user['id']) ? $this->user['id'] : NULL;
    $full_name_of_user = isset($this->user['first_name']) ? $this->user['first_name']. ' '.$this->user['last_name'] : '';
    $is_admin = (isset($this->user['is_admin']) && $this->user['is_admin']==1) ? "Administrator" : "User";
    $is_tutor = (isset($this->user['role']) && $this->user['role']=="tutor") ? TRUE : FALSE;
    $name_of_user = (strlen($full_name_of_user) > 15) ? substr($full_name_of_user, 0, 10).'...' : $full_name_of_user ;
    $profile_url = "profile";
    $margin_auto = 'mr-auto';
    $order_two = NULL;
?>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="ko" />
    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('/assets/images/logo/favicon.png');?>" />
    <!-- 메타 태그 영역 -->
    <meta name="keywords" content="<?php echo $this->settings->meta_keywords; ?>">
    <meta name="description" content="<?php echo $this->settings->meta_description; ?>">    
    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,500,700|Work+Sans:400,700" rel="stylesheet">
    <?php $meta_title = (isset($meta_data['meta_title']) && !empty($meta_data['meta_title']) ? $meta_data['meta_title'] : $this->settings->site_name); ?>
    <title><?php echo xss_clean($page_title); ?>::<?php echo xss_clean($meta_title); ?></title>
    <!-- 필요한 스크립트-->
    <script>
        var BASE_URL = '<?php echo base_url(); ?>';
        var csrf_Name = '<?php echo $this->security->get_csrf_token_name() ?>';
        var csrf_Hash = '<?php echo $this->security->get_csrf_hash(); ?>';
        var rtl_dir = "<?php echo xss_clean($rtl_dir); ?>";
        var flash_message = '<?php echo $flash_success_msg; ?>';
        var flash_error = '<?php echo $flash_error_msg; ?>';
        var error_report = '<?php echo xss_clean($this->error); ?>';
        var login_user_id = <?php echo xss_clean($login_user_id); ?>;
        login_user_id = parseInt(login_user_id);
        var disable_right_click = '<?php echo xss_clean($disable_right_click); ?>';
        var disable_print_screen = '<?php echo xss_clean($disable_print_screen); ?>';
        var disable_cut_copy_paste = '<?php echo xss_clean($disable_cut_copy_paste); ?>';
        var session_time = '<?php echo xss_clean($session_time);?>';
        <?php if(get_admin_setting('header_javascript')) { echo html_entity_decode(get_admin_setting('header_javascript')); } ?>
    </script>
    <!-- CSS -->
    <?php if (isset($css_files) && is_array($css_files)) : ?>
        <?php foreach ($css_files as $css) : ?>
            <?php if ( ! is_null($css)) : ?>
              <?php $separator = (strstr($css, '?')) ? '&' : '?'; ?>
              <link rel="stylesheet" href="<?php echo xss_clean($css); ?><?php echo xss_clean($separator); ?>v=<?php echo xss_clean($this->settings->site_version); ?>"><?php echo "\n"; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
    <style type="text/css">
        <?php if((get_admin_setting('custom_css'))) { echo html_entity_decode(get_admin_setting('custom_css'));} ?>
    </style>
    <link href="<?php echo base_url('/assets/fonts/feather/'); ?>feather.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/libs/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/libs/dragula/dist/dragula.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/libs/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/libs/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/theme.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/lmsclass.css">
</head>

<body class="bg-white">

<!-- #################  Header NavBar 영역 ################# -->

 <!-- Navbar -->
 <nav class="navbar navbar-expand-lg navbar-default bg-dark-purple">
   <div class="container-lg px-0">
   <a class="navbar-brand" href="<?php echo base_url()?>"><img src="<?php echo base_url('/assets/images/'); ?>logo_default.png" style="height:45px;"></a>
   <!-- Mobile view nav wrap -->
   <?php
   if ($user_id)
   { ?>
   <ul class="navbar-nav navbar-right-wrap ml-auto d-lg-none d-flex nav-top-wrap">
     <li class="dropdown ml-2 mr-2">
       <a
         class="rounded-circle"
         href="#!"
         role="button"
         id="dropdownUser"
         data-toggle="dropdown"
         aria-haspopup="true"
         aria-expanded="false"
       >
         <div class="avatar avatar-sm avatar-indicators avatar-online">
           <img
             alt="avatar"
             src="<?php echo base_url()?>assets/images/avatar_common01.png"
             class="rounded-circle"
           />
         </div>
       </a>
       <div
         class="dropdown-menu dropdown-menu-right shadow"
         aria-labelledby="dropdownUser"
       >
         <div class="dropdown-item">
          <div>
            <div class="lh-1">
              <h5 class="mb-1"><?php echo xss_clean($name_of_user); ?></h5>
            </div>
          </div>
        </div>
        <div class="dropdown-divider"></div>


          <ul class="list-unstyled">

                     <li>
                       <a class="dropdown-item" href="<?php echo base_url('my/study')?>">
                         <i class="fe fe-star mr-2"></i>나의 강좌
                       </a>
                     </li>                       
                     <li>
                       <a class="dropdown-item" href="<?php echo base_url('my/payments')?>">
                         <i class="fe fe-star mr-2"></i>결제 내역
                       </a>
                   </li>         
                      <li>
                       <a class="dropdown-item" href="<?php echo base_url($profile_url);?>">
                         <i class="fe fe-user mr-2"></i><?php echo lang('user_profile') ?>
                       </a>
                   </li>                   
            
            <?php if ($is_admin == 'Administrator')
            {
              if(is_loged_in_user_is_subadmin() == FALSE)
              { ?>
                <li>
                  <a class="dropdown-item" href="<?php echo base_url("admin/settings");?>">
                    <i class="fe fe-settings mr-2"></i><?php echo lang('admin_admin_settings') ?>
                  </a>
                </li>

             <?php
              }
              else
              {
                ?>
                <li>
                  <a class="dropdown-item" href="<?php echo base_url("admin/dashboard");?>">
                    <i class="fe fe-settings mr-2"></i><?php echo lang('dashboard') ?>
                  </a>
                </li>
             <?php
              }
            } ?>

            <?php
            if ($is_tutor == TRUE)
            { ?>
              <a class="dropdown-item" href="<?php echo base_url("tutor");?>">
                <i class="dropdown-icon fas fa-fire <?php echo $rtl_icon;?>"></i><?php echo lang('dashboard') ?>
              </a>
              <li>
                <a class="dropdown-item" href="<?php echo base_url("tutor");?>">
                  <i class="fe fe-settings mr-2"></i><?php echo lang('dashboard') ?>
                </a>
              </li>

              <?php
            } ?>

          </ul>
          <div class="dropdown-divider"></div>
          <ul class="list-unstyled">
            <li>
              <a class="dropdown-item" href="<?php echo base_url("logout");?>">
                <i class="fe fe-power mr-2"></i><?php echo lang('sign_out') ?>
              </a>
            </li>
          </ul>



       </div>
     </li>
   </ul>
   <?php
  } ?>
   <!-- Button -->
   <button
     class="navbar-toggler collapsed"
     type="button"
     data-toggle="collapse"
     data-target="#navbar-default"
     aria-controls="navbar-default"
     aria-expanded="false"
     aria-label="Toggle navigation"
   >
     <span class="icon-bar top-bar mt-0"></span>
     <span class="icon-bar middle-bar"></span>
     <span class="icon-bar bottom-bar"></span>
   </button>
   <!-- Collapse -->
       <div class="collapse navbar-collapse py-4 py-lg-0" id="navbar-default">
         <ul class="navbar-nav">
            <li class="nav-item pr-2">
              <a class="nav-link <?php echo (uri_string() == 'lecture/1') ? 'active_link' : 'a_link'; ?>" href="<?php echo base_url('lecture/1')?>">실무 강좌</a>
            </li> 
            <li class="nav-item pr-4">
              <a class="nav-link <?php echo (substr(uri_string(), 0, 4) == 'blog') ? 'active_link' : 'a_link'; ?>" href="<?php echo base_url('blogs')?>">콘텐츠</a>
            </li>
         </ul>
         <?php
         if ($user_id)
         { ?>
             <ul class="navbar-nav navbar-right-wrap ml-auto d-none d-lg-block">
               <li class="dropdown ml-2 mr-2 d-inline-block">
                 <a
                   class="rounded-circle"
                   href="#!"
                   role="button"
                   id="dropdownUserProfile"
                   data-toggle="dropdown"
                   aria-haspopup="true"
                   aria-expanded="false"
                 >
                   <div class="avatar avatar-sm avatar-indicators avatar-online">
                     <img
                       alt="avatar"
                       src="<?php echo base_url()?>assets/images/avatar_common01.png"
                       class="rounded-circle"
                     />
                   </div>
                 </a>
                 <div
                   class="dropdown-menu dropdown-menu-right"
                   aria-labelledby="dropdownUserProfile"
                 >
                   <div class="dropdown-item">
                        <div>
                            <div class="lh-1">
                                <h5 class="mb-1"><?php echo xss_clean($name_of_user); ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                   <ul class="list-unstyled">
                     <li>
                       <a class="dropdown-item" href="<?php echo base_url('my/study')?>">
                         <i class="fe fe-star mr-2"></i>나의 강좌
                       </a>
                     </li>                       
                     <li>
                       <a class="dropdown-item" href="<?php echo base_url('my/payments')?>">
                         <i class="fe fe-star mr-2"></i>결제 내역
                       </a>
                   </li>         
                      <li>
                       <a class="dropdown-item" href="<?php echo base_url($profile_url);?>">
                         <i class="fe fe-user mr-2"></i><?php echo lang('user_profile') ?>
                       </a>
                   </li>        

                     <?php if ($is_admin == 'Administrator')
                     {
                       if(is_loged_in_user_is_subadmin() == FALSE)
                       { ?>
                         <li>
                           <a class="dropdown-item" href="<?php echo base_url("admin/settings");?>">
                             <i class="fe fe-settings mr-2"></i><?php echo lang('admin_admin_settings') ?>
                           </a>
                         </li>

                      <?php
                       }
                       else
                       {
                         ?>
                         <li>
                           <a class="dropdown-item" href="<?php echo base_url("admin/dashboard");?>">
                             <i class="fe fe-settings mr-2"></i><?php echo lang('dashboard') ?>
                           </a>
                         </li>
                      <?php
                       }
                     } ?>

                     <?php
                     if ($is_tutor == TRUE)
                     { ?>
                       <a class="dropdown-item" href="<?php echo base_url("tutor");?>">
                         <i class="dropdown-icon fas fa-fire <?php echo $rtl_icon;?>"></i><?php echo lang('dashboard') ?>
                       </a>
                       <li>
                         <a class="dropdown-item" href="<?php echo base_url("tutor");?>">
                           <i class="fe fe-settings mr-2"></i><?php echo lang('dashboard') ?>
                         </a>
                       </li>

                       <?php
                     } ?>

                   </ul>
                   <div class="dropdown-divider"></div>
                   <ul class="list-unstyled mt-5 mt-lg-0">
                     <li>
                       <a class="dropdown-item" href="<?php echo base_url("logout");?>">
                         <i class="fe fe-power mr-2"></i><?php echo lang('sign_out') ?>
                       </a>
                     </li>
                   </ul>
                 </div>
               </li>
             </ul>

             <?php
               }
               else
               {
                 ?>
                 <div class="ml-auto mt-5 mt-lg-0">
                   <a href="<?php echo base_url('login'); ?>" class="btn btn-sm btn-light ml-1">로그인</a>
                   <a href="<?php echo base_url('user/register'); ?>" class="btn btn-sm btn-outline-light  ml-1 mr-1">회원가입</a>
                 </div>
                 <?php
               } ?>
       </div>
   </div>
 </nav>


  <!-- #################  콘텐츠 영역 ################# -->
  <div class="min-h-100vh">
  <?php echo ($content) ?>
  </div>
  <!-- #################  푸터 영역 ################# -->
    <div class="pt-5 footer">
        <div class="container">
          <div class="row">
            <div class="col-12">
                  <!-- about company -->
              <div class="mb-4">
                <img src="<?php echo base_url('/assets/images/'); ?>logo_white.png" style="height:60px;">
                <div class="mt-1">
                <p>에이블러닝  / 서울시 금천구 가산디지털2로 34 G밸리 더리브스마트타워 #1410</p>
                     <!-- social media -->
                  <div class="font-size-lg">
                    <a href="https://www.facebook.com/heroclass.official" class="mdi mdi-facebook text-muted mr-2" target="_blank"></a>
                    <a href="https://www.youtube.com/channel/UCd9SYsRyPixaOZw9E5la1CA" class="mdi mdi-youtube text-muted mr-2" target="_blank"></a>
                    <a href="https://www.instagram.com/heroclass_official" class="mdi mdi-instagram text-muted " target="_blank"></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row align-items-center no-gutters border-top py-2 mt-6">
            <!-- Desc -->
            <div class="col-12">
                <span>Able Learning. All Rights Reserved</span>
            </div>
        </div>
        </div>
      </div>
  <!-- footer -->

  <?php // Javascript files ?>
      <?php if (isset($js_files) && is_array($js_files)) : ?>
        <?php foreach ($js_files as $js) : ?>
        <?php if ( ! is_null($js)) : ?>
          <?php $separator = (strstr($js, '?')) ? '&' : '?'; ?>
          <?php echo "\n"; ?><script type="text/javascript" src="<?php echo xss_clean($js); ?>"></script><?php echo "\n"; ?>
        <?php endif; ?>
        <?php endforeach; ?>
      <?php endif; ?>

      <?php if (isset($js_files_i18n) && is_array($js_files_i18n)) : ?>
        <?php foreach ($js_files_i18n as $js) : ?>
          <?php if ( ! is_null($js)) : ?>
            <?php echo "\n"; ?><script type="text/javascript"><?php echo "\n" . $js . "\n"; ?></script><?php echo "\n"; ?>
          <?php endif; ?>
        <?php endforeach; ?>
      <?php endif; ?>

      <!-- Libs JS -->
    <script src="<?php echo base_url(); ?>assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/libs/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/libs/dragula/dist/dragula.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/libs/@popperjs/core/dist/umd/popper.min.js"></script>

  <!-- Theme JS -->
  <script src="<?php echo base_url(); ?>assets/js/theme.js"></script>
  <script type="text/javascript">
      <?php if(!empty(get_admin_setting('footer_javascript'))) { echo html_entity_decode(get_admin_setting('footer_javascript')); } ?>
  </script>

</body>
</html>
<?php
$this->load->view('add_analyc');  
?>