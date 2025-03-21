<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Default Public Template
*/
?>
<!DOCTYPE html>
<?php
$is_rtl = '';
$rtl_dir = '';
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
  <title><?php echo xss_clean($page_title); ?> - <?php echo xss_clean($meta_title); ?></title>
  <?php
   $disable_right_click = get_admin_setting('disable_right_click');
   $disable_print_screen = get_admin_setting('disable_print_screen');
   $disable_cut_copy_paste = get_admin_setting('disable_copy_paste_click');
   $hader_logo_height = get_admin_setting('header_logo_height');
   $hader_logo_height = $hader_logo_height > 1 ? $hader_logo_height : 65;

  $flash_error_msg =  str_replace("'","`",$this->session->flashdata('error'));
  $flash_success_msg =  str_replace("'","`",$this->session->flashdata('message'));
  ?>
  <!-- Libs CSS -->
  <link href="<?php echo base_url('/assets/fonts/feather/'); ?>feather.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>assets/libs/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>assets/libs/dragula/dist/dragula.min.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>assets/libs/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>assets/libs/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
  <!-- Theme CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/theme.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/lmsclass.css">
</head>

<body class="bg-white">

  <!-- #################  콘텐츠 영역 ################# -->
  <div class="min-h-100vh">
  <?php echo ($content) ?>
  </div>
  <!-- footer -->

  <?php // Javascript files ?>
      <?php if (isset($js_files) && is_array($js_files)) : ?>
        <?php foreach ($js_files as $js) : ?>
        <?php if ( ! is_null($js)) : ?>
          <?php $separator = (strstr($js, '?')) ? '&' : '?'; ?>
          <?php echo "\n"; ?><script type="text/javascript" src="<?php echo xss_clean($js); ?><?php echo xss_clean($separator); ?>v = <?php echo xss_clean($this->settings->site_version); ?>"></script><?php echo "\n"; ?>
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
    <script src="<?php echo base_url(); ?>assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/libs/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/libs/dragula/dist/dragula.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/libs/@popperjs/core/dist/umd/popper.min.js"></script>

  <!-- Theme JS -->
  <script src="<?php echo base_url(); ?>assets/js/theme.min.js"></script>
  <script type="text/javascript">
      <?php if(!empty(get_admin_setting('footer_javascript'))) { echo html_entity_decode(get_admin_setting('footer_javascript')); } ?>
  </script>

</body>
</html>
<?php
$this->load->view('add_analyc');  
?>