<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $update = isset($article_id) && $article_id ? '_update' : '' ?> 
<div class="row page">
  <div class="col-12 col-md-12 col-lg-12">
    <div class="card">
      <div class="card-body"> 
        <?php echo form_open_multipart('', array('role'=>'form','novalidate'=>'novalidate')); ?> 
        <div class="row">

          <div class="col-6">
            <div class="form-group <?php echo form_error('title') ? ' has-error' : ''; ?>">
              <?php echo  form_label(lang('admin_title'), 'title'); ?> 
              <span class="required">*</span>
              <?php 
                $populateData = $this->input->post('title') ? $this->input->post('title') : (isset($institution_data->title) ? $institution_data->title :  '' );
              ?>

              <input type="text" name="title" id="title" class="form-control" value="<?php echo xss_clean($populateData);?>">
              <span class="small form-error"> <?php echo strip_tags(form_error('title')); ?> </span>
            </div>
          </div>


          <div class="col-6">
            <div class="form-group <?php echo form_error('logo_error') ? ' has-error' : ''; ?>">
              <?php echo  form_label('이미지', 'logo'); ?>

              <span class="required">*</span>

              <?php 
                $populateData = isset($institution_data->logo) && $institution_data->logo ? $institution_data->logo :  ''; 
              ?> 

              <input type="file" name="logo" id="logo" class="form-control" value="<?php echo xss_clean($populateData);?>">
              <span class="small form-error"> <?php echo strip_tags(form_error('logo_error')); ?> </span> 
              <?php 
                if($populateData)
                {
              ?> 
                  <div class="">
                    <img class="image_preview popup" src="<?php echo base_url('assets/images/institution/').$populateData; ?>">
                  </div>
              <?php
                }
              ?>

            </div>
          </div>

          <div class="clearfix"></div>

          <div class="col-12">
            <div class="form-group <?php echo form_error('address') ? ' has-error' : ''; ?>">
              <?php echo  form_label('멋진 한줄 요약', 'address'); ?>
              <span class="required">*</span>
              <?php
                $populateData = $this->input->post('address') ? $this->input->post('address') : (isset($institution_data->address) ? $institution_data->address :  '' );
              ?>
              <textarea name="address" id="address" class="form-control address" rows="5" ><?php echo xss_clean($populateData);?></textarea>
              <span class="small form-error"> <?php echo strip_tags(form_error('address')); ?> </span>
            </div>
          </div>

          <div class="clearfix"></div>

          <div class="col-12">
            <div class="form-group <?php echo form_error('description') ? ' has-error' : ''; ?>">
              <?php echo  form_label(lang('description'), 'description'); ?>
              <span class="required">*</span>
              <?php
                $populateData = $this->input->post('description') ? $this->input->post('description') : (isset($institution_data->description) ? $institution_data->description :  '' );
              ?>
              <textarea name="description" id="p_desc" class="form-control editor" rows="5" ><?php echo xss_clean($populateData);?></textarea>
              <span class="small form-error"> <?php echo strip_tags(form_error('description')); ?> </span>
            </div>
          </div>

          <div class="clearfix"></div>
          <hr />

          <div class="col-12"> 
            <h2 class="text-center"><?php echo lang('seo_heading');?></h2>
          </div>

          <div class="clearfix"></div>
          <hr />




          <div class="col-12">
            <?php $saveUpdate = isset($institution_id) ? lang('core_button_update') : lang('core_button_save'); ?>
            <input type="submit"  value="<?php echo ucfirst($saveUpdate);?>" class="btn btn-primary px-5">
            <a href="<?php echo base_url('admin/institution');?>" class="btn btn-dark px-5"><?php echo lang('core_button_cancel'); ?></a>
          </div>
          <div class="clearfix"></div>
        </div>
        <?php echo form_close();?>
      </div>
    </div>
  </div>
</div>
