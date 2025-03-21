<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<?php
    $login_user_id = isset($this->user['id']) ? $this->user['id'] : 0;
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, minimum-scale=1">
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="ko" />
    <?php $meta_title = (isset($meta_data['meta_title']) && !empty($meta_data['meta_title']) ? $meta_data['meta_title'] : $this->settings->site_name); ?>
    <?php $page_title_pre = (isset($page_title) && !empty($page_title)) ? xss_clean($page_title) : ""; ?>
    <?php $title_bar_shape = (isset($page_title) && !empty($page_title)) ? " :: " : ""; ?>
    <?php $page_title_post = (isset($page_title) && !empty($page_title)) ? xss_clean($meta_title) : ""; ?>
    <title><?php echo $page_title_pre; ?><?php echo $title_bar_shape; ?><?php echo $page_title_post; ?></title>
    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('/assets/images/logo/favicon.png');?>" />
    <!-- 메타 태그 영역 -->
    <meta name="keywords" content="<?php echo $this->settings->meta_keywords; ?>">
    <meta name="description" content="<?php echo $this->settings->meta_description; ?>">    
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;700&family=Roboto:wght@400;500;700&display=swap">
    
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
        var session_time = '<?php echo xss_clean($session_time);?>';
        <?php if(get_admin_setting('header_javascript')) { echo html_entity_decode(get_admin_setting('header_javascript')); } ?>
    </script>
    <!-- Google Ads -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6532110474704209" crossorigin="anonymous"></script>    

    <!-- Plugins CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/fonts/feather/'); ?>feather.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendor/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendor/glightbox/css/glightbox.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendor/choices/css/choices.min.css">

    <!-- Theme CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/theme.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/lmsclass.css">

</head>

<body class="bg-very-light-gray">
<!-- #################  Header NavBar 영역 ################# -->
    <!-- Header START -->
    <header class="navbar-light navbar-sticky">
    <!-- Nav START -->
    <nav class="navbar navbar-expand-lg z-index-9 py-1">
      <div class="container">
        <!-- Logo START -->
        <a class="navbar-brand " href="<?php echo base_url()?>"> <img class="light-mode-item navbar-brand-item" src="<?php echo base_url('/assets/images/'); ?>logo_default.png"></a>
        <!-- Logo END -->
    
        <!-- Responsive navbar toggler -->
        <!-- Button -->
        <button class="navbar-toggler ms-auto mt-2 mr-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-animation">
            <span></span>
            <span></span>
            <span></span>
          </span>
        </button>
        
        <!-- Main navbar START -->
        <div class="navbar-collapse collapse" id="navbarCollapse">
          <!-- Nav Main menu START -->
          <ul class="navbar-nav navbar-nav-scroll">
            <!-- Nav item 1 Demos -->
            <li class="nav-item pr-4">
              <a class="h4 pt-4 nav-link <?php echo (substr(uri_string(), 10, 7) == 'outdoor') ? 'active' : ''; ?>" href="<?php echo base_url('blog/list/outdoor')?>">아웃도어</a>
            </li>
            <!-- Nav item 2 Pages -->
            <li class="nav-item pr-4">
              <a class="h4 pt-4 nav-link <?php echo (substr(uri_string(), 10, 6) == 'sports') ? 'active' : ''; ?>" href="<?php echo base_url('blog/list/sports')?>">생활체육</a>
            </li> 
            <!-- Nav item 3 Pages -->
            <li class="nav-item pr-4">
              <a class="h4 pt-4 nav-link <?php echo (substr(uri_string(), 10, 7) == 'culture') ? 'active' : ''; ?>" href="<?php echo base_url('blog/list/culture')?>">문화생활</a>
            </li>                        
            <!-- Nav item 4 Pages -->
            <li class="nav-item">
              <a class="h4 pt-4 nav-link <?php echo (substr(uri_string(), 8, 5) == 'ctp01') ? 'active' : ''; ?>" href="<?php echo base_url('courses/ctp01')?>">취미강좌</a>
            </li>  
          </ul>
          <!-- Nav Main menu END -->
        </div>
        <!-- Main navbar END -->

        <!-- Mypage and Etc START -->
        <ul class="nav flex-row align-items-center list-unstyled ms-xl-auto pt-2">
          <!-- Mypage  START -->
          <li class="nav-item ms-2">
          <?php
            if ($user_id){ 
              if ($is_admin == 'Administrator')
                {?>
                  <a href="<?php echo base_url("admin/settings");?>">
                  <button class="btn btn-xs btn-danger py-1 mb-0">관리자</button>
                  </a>
              <?php
                }?>
                <a href="<?php echo base_url("mypage");?>">
                <button class="btn btn-xs btn-primary py-1 mb-0">마이페이지</button>
                </a>
              <?php
              } 
            else {?>
              <a href="<?php echo base_url('login'); ?>"><button class="btn btn-xs btn-dark py-1 mb-0 ml-1 mr-1"><i class="bi bi-power me-2"></i>로그인</button></a>
          <?php
              }?>
          </li>
        </ul>
        <!-- Profile and notification END -->
      </div>
    </nav>
    <!-- Nav END -->

  </header>
  <!-- Header END -->


  <!-- #################  콘텐츠 영역 ################# -->
  <div class="min-h-100vh px-1">
  <?php echo ($content) ?>
  </div>
  <!-- #################  푸터 영역 ################# -->
    <div class="pt-4 px-3 footer">
        <div class="container">
          <div class="row">
            <div class="col-12">
                  <!-- about company -->
              <div class="mb-2">
                <div class="mt-0 text-light-gray font-size-sm">
                  <p class="mb-1">에이블러닝 <span class="pl-2 font-size-xs text-medium-gray">서울시 강서구 마곡중앙로 59-11 엠비즈타워 #801,#802</span></p>
                  <p class="mb-3">사업자등록번호 : 409-30-61889 | 통신판매업신고 : 2016-서울동작-0140</p>
                  <p class="mb-1">[이메일]<span class="pl-1">steve@able-learn.co.kr</span></p>
                  <p class="mb-3">[전화] <span class="pl-1">02-814-0109</span><span class="pl-3 font-size-xs text-medium-gray">평일 오전 10:00 ~ 오후 6:00</span></p>
                  <!-- social media -->
                  <div class="font-size-lg">
                    <a href="https://www.youtube.com/channel/UCd9SYsRyPixaOZw9E5la1CA" class="mdi mdi-youtube text-muted mr-2" target="_blank"></a>
                    <a href="https://www.instagram.com/heroclass_official/" class="mdi mdi-instagram text-muted " target="_blank"></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row align-items-center no-gutters border-top py-2 mt-1">
            <!-- Desc -->
            <div class="col-12 pb-1">
                <span class="font-size-xs text-medium-gray">Able Learning. All Rights Reserved</span>
            </div>
        </div>
        </div>
      </div>
  <!-- footer -->

  <!-- Back to top -->
  <div class="back-top"><i class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"></i></div>

  <!-- Bootstrap JS -->
  <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Vendors -->
  <script src="<?php echo base_url(); ?>assets/vendor/glightbox/js/glightbox.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/choices/js/choices.min.js"></script>

  <!-- Template Functions -->
  <script src="<?php echo base_url(); ?>assets/js/functions.js"></script>

</body>
</html>
<?php
$this->load->view('add_analyc');  
?>