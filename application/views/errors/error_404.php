<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div>
 <div class="container d-flex flex-column">
  <div class="row align-items-center justify-content-center no-gutters py-lg-22 py-10">
   <!-- Docs -->
   <div class="col-xl-6 col-lg-6 col-md-12 col-12 pl-xl-8 pl-lg-6 text-center text-lg-left">
    <h1 class="display-1 mb-3">404</h1>

    <p class="mb-5 lead"> <?php echo lang('core_error_page_not_found'); ?></p>
    <a type="button" class="btn btn-primary btn-lg" href="<?php echo base_url(); ?>"><?php echo lang('core_return_home'); ?></a>
   </div>
   <!-- img -->
   <div class="col-xl-6 col-lg-6 col-md-12 col-12 mt-8 mt-lg-0">
    <img src="<?php echo base_url()?>assets/images/error_404.png" alt="" class="w-100 px-8 px-md-20 px-lg-6" />
   </div>
  </div>
 </div>
</div>