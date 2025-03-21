<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
  <div class="col-12 col-md-12 col-lg-12">
    <div class="card">
      <?php
				if(isset($ext_course_id) && !empty($ext_course_id)) {
          $data['tab_ext_course_id'] = $ext_course_id;
           $this->load->view('admin/extcourse/common_tab_list',$data);
         }
      ?>
    </div>
    <hr>  

      <?php echo form_open_multipart('', array('role'=>'form','novalidate'=>'novalidate')); ?>
      <div class="row">

        <div class="col-6">
          <div class="form-group <?php echo form_error('ext_course_id') ? ' has-error' : ''; ?>">
            <?php echo  form_label('캠핑장', 'ext_course_id'); ?>

            <span class="required">*</span>

            <?php 
            $populateData = $this->input->post('ext_course_id') ? $this->input->post('ext_course_id') : (isset($question_data['ext_course_id']) ? $question_data['ext_course_id'] :  '' ); 
            $populateData = $ext_course_id ? $ext_course_id : $populateData;

            echo form_dropdown('ext_course_id', $extcourse_name_array, $populateData, 'id="ext_course_id" class="form-control select_dropdown"'); 
            ?> 
            <span class="small form-error"> <?php echo strip_tags(form_error('ext_course_id')); ?> </span>  

          </div>
        </div>

        <div class="col-6">
          <div class="form-group">
            <?php echo  form_label( lang('upload_excel_file'), 'excel_file'); ?> <span class="required text-danger">*</span>
            <input type="File" name="excel_file" class="form-control excel_file" id="excel_file">
            <span class="small text-danger form-error"> <?php echo strip_tags(form_error('excel_file')); ?> </span>  
          </div>
        </div>

        <?php 
        $populateData = $this->input->post('over_write') == 1 ? 'checked' : (isset($quiz_data['over_write']) && $quiz_data['over_write'] == 1 ? 'checked' :  '' );
        ?>

        
        <div class="col-12 my-2">
          <a target="_blank" href="<?php echo base_url('assets/import-demo/ext_demo.xlsx'); ?>"><?php echo lang('downlod_sample_file');?>  </a>
        </div>

        <div class="clearfix"></div>

        <div class="col-12 mt-5 text-center">
          <input type="Submit" class="btn btn-success mr-5" value="<?php echo lang('admin_upload_image');?>">
          <a href="<?php echo base_url('admin') ?>" class="btn btn-dark"><?php echo lang('core_button_cancel'); ?></a>
        </div>
      </div>
      <?php echo form_close();?>
  </div>
</div>