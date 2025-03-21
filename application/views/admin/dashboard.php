<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">

   <?php
   if(is_loged_in_user_is_subadmin() == FALSE)
   { ?>

      <div class="col-lg-3 col-md-6 col-sm-6 col-12"> 
         <div class="card card-statistic-1">
            <div class="card-icon bg-primary"><i class="far fa-user"></i></div>
            <div class="card-wrap">
               <div class="card-header">
                  <h4>
                     <a  href="<?php echo base_url('admin/users') ?>"><?php echo lang('dashboard_user'); ?> (<?php echo xss_clean($users->count); ?>) </a>
                  </h4>
               </div>
            </div>
         </div>
      </div>
         <?php 
      } ?>

   <?php
   if(is_loged_in_user_is_subadmin() == FALSE)
   { ?>
   <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
         <div class="card-icon bg-primary">
            <i class="fas fa fa-list-alt" aria-hidden="true"></i>
         </div>
         <div class="card-header">
            <h4>
               <a  href="<?php echo base_url('admin/category') ?>"><?php echo lang('dashboard_categories'); ?> (<?php echo xss_clean($category->count); ?>) </a>
            </h4>
         </div>
      </div>
   </div>
   <?php
   } ?>
   <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
         <div class="card-icon bg-primary">
            <i class="fas fa-newspaper"></i>
         </div>
         <div class="card-wrap">
            <div class="card-header">
               <h4>
                  <a  href="<?php echo base_url('admin/quiz') ?>"><?php echo lang('dashboard_quiz'); ?> (<?php echo xss_clean($quiz->count); ?>) </a>
               </h4>
            </div>
         </div>
      </div>
   </div>


   <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
         <div class="card-icon bg-primary">
            <i class="fas fa-book"></i>
         </div>
         <div class="card-wrap">
            <div class="card-header">
               <h4>
                  <a  href="<?php echo base_url('admin/study') ?>"><?php echo lang('study_material'); ?> (<?php echo xss_clean($study_material->count); ?>) </a>
               </h4>
            </div>
         </div>
      </div>
   </div>

   <?php
   if(is_loged_in_user_is_subadmin() == FALSE)
   { ?>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
         <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
               <i class="fas fa-file" aria-hidden="true"></i>
            </div>
            <div class="card-header">
               <h4>
                  <a  href="<?php echo base_url('admin/pages') ?>"><?php echo lang('dashboard_pages'); ?> (<?php echo xss_clean($pages->count); ?>) </a>
               </h4>
            </div>
         </div>
      </div>


   <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
         <div class="card-icon bg-primary">
            <i class="fas fa-newspaper"></i>
         </div>
         <div class="card-header">
            <h4>
               <a  href="<?php echo base_url('admin/blog/post') ?>"><?php echo lang('dashboard_blog_post'); ?>  (<?php echo xss_clean($blog_post->count); ?>) </a>
            </h4>
         </div>
      </div>
   </div>

   <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
         <div class="card-icon bg-primary">
            <i class="fas fa-hand-holding-usd"></i>
         </div>
         <div class="card-header">
            <h4>
               <a  href="<?php echo base_url('admin/payment') ?>"><?php echo lang('dashboard_payment'); ?>  (<?php echo xss_clean($payment_total->count); ?>) </a>
                  <a href="javascript:void(0)" class="py-15"><?php echo lang('success'); ?>(<?php echo xss_clean($payment_total->price); ?>)</a>
            </h4>
         </div>
      </div>
   </div>


         <?php 
   } ?>


</div>