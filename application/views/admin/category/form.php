<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="row">
   <div class="col-12 col-md-12 col-lg-12">
      <div class="card">
         <div class="card-body">
            <?php echo form_open_multipart('', array('role'=>'form')); ?>
            <div class="row">
               <div class="col-4">
                  <div class="form-group <?php echo form_error('title') ? ' has-error' : ''; ?>">
                     <?php echo form_label(lang('admin_title'), 'title'); ?>  
                     <span class="required">*</span>
                     <?php $populateData = (!empty($this->input->post('title')) ? $this->input->post('title') : (!empty($editData['category_title']) && isset($editData['category_title']) ? $editData['category_title'] : '' )); ?>
                     <input type="text" name="title" id="title" class="form-control" value="<?php echo xss_clean($populateData);?>">
                     <span class="small form-error"> <?php echo strip_tags(form_error('title')); ?> </span>  
                  </div>
               </div>
               <div class="col-4">
                  <div class="form-group <?php echo form_error('category_slug') ? ' has-error' : ''; ?>">
                     <?php echo form_label('Slug', 'category_slug'); ?>  
                     <span class="required">*</span>
                     <?php $populateData = (!empty($this->input->post('category_slug')) ? $this->input->post('category_slug') : (!empty($editData['category_slug']) && isset($editData['category_slug']) ? $editData['category_slug'] : '' )); ?>
                     <input type="text" name="category_slug" id="category_slug" class="form-control" value="<?php echo xss_clean($populateData);?>">
                     <span class="small form-error"> <?php echo strip_tags(form_error('category_slug')); ?> </span>  
                  </div>
               </div>
               <div class="col-4">
                  <div class="form-group">
                     <?php echo form_label(lang('admin_parent_category'), 'parentcategory'); ?>
                     <?php $populateData = (!empty($editData['parent_category']) && isset($editData['parent_category']) ? $editData['parent_category'] : (!empty($this->input->post('parentcat')) ? $this->input->post('parentcat') : '' )); ?> 
                     <select class="select_dropdown form-control" name="parentcat">
                        <option value=""><?php echo lang('admin_select_one'); ?></option>
                        <?php
                        foreach($cat_title as $key=>$parentCategory)
                        {
                           $selected = ($parentCategory['id'] == $populateData) ? "selected" : ''; 
                           ?>
                           <option <?php echo xss_clean($selected);?> value="<?php echo xss_clean($parentCategory['id']);?>"><?php echo xss_clean($parentCategory['category_title']);?>   </option>
                        <?php } ?>
                     </select>
                  </div>
               </div>              
            </div>
            <div class="form-group">
               <?php echo form_label('한줄요약', 'categoryext'); ?>
               
               <?php $populateData = (!empty($this->input->post('ext')) ? $this->input->post('ext') : (!empty($editData['category_ext']) && isset($editData['category_ext']) ? $editData['category_ext'] : '' )); ?>
               <textarea name="ext" id="categoryext" rows="3" class="form-control"><?php echo $populateData;?></textarea>
            </div>
            <div class="row">
               <div class="col-6">
                  <div class="form-group <?php echo form_error('order') ? ' has-error' : ''; ?>">
                     <?php echo form_label('구분 (PAR:구분없음, ctp01:배우기, ctp02:미정)', 'gubun'); ?>  
                     <?php $populateData = (!empty($this->input->post('gubun')) ? $this->input->post('gubun') : (!empty($editData['gubun']) && isset($editData['gubun']) ? $editData['gubun'] : '' )); ?>
                     <input type="text" name="gubun" id="gubun" class="form-control" value="<?php echo xss_clean($populateData);?>">
                     <span class="small form-error"> <?php echo strip_tags(form_error('gubun')); ?> </span>  
                  </div>
               </div>
               <?php
               $checked = $this->input->post('display_on_home') ? 'checked' : (isset($editData['display_on_home']) && $editData['display_on_home'] == 1 ? 'checked' : '');
               ?>
               <div class="col-3">
                  <div class="form-group <?php echo form_error('order') ? ' has-error' : ''; ?>">
                     <?php echo form_label(lang('order'), 'order'); ?>  
                     <span class="required">*</span>
                     <?php $populateData = (!empty($this->input->post('order')) ? $this->input->post('order') : (!empty($editData['order']) && isset($editData['order']) ? $editData['order'] : '' )); ?>
                     <input type="text" name="order" id="order" class="form-control" value="<?php echo xss_clean($populateData);?>">
                     <span class="small form-error"> <?php echo strip_tags(form_error('order')); ?> </span>  
                  </div>
               </div>
               <?php
               $checked = $this->input->post('display_on_home') ? 'checked' : (isset($editData['display_on_home']) && $editData['display_on_home'] == 1 ? 'checked' : '');
               ?>
               <div class="col-3">
                  <div class="form-group">
                     <div class="control-label">추천 카테고리</div>
                     <label class="custom-switch mt-2 form-control">
                        <input type="checkbox" <?php echo xss_clean($checked); ?> name="display_on_home" value="1" class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description">추천 여부</span>
                     </label>
                  </div>
               </div>
            </div>                             
            <div class="form-group">
               <?php echo form_label(lang('description'), 'categorydesc'); ?>
               <?php $populateData = (!empty($this->input->post('description')) ? $this->input->post('description') : (!empty($editData['category_description']) && isset($editData['category_description']) ? $editData['category_description'] : '' )); ?>
               <textarea name="description" id="categorydesc" rows="5" class="form-control editor"><?php echo xss_clean($populateData);?></textarea>

            </div>
            <div class="form-group">
               <?php echo form_label(lang('admin_upload_image'), 'categoryimage'); ?>
               <input type="file" name="image" id="categoryimage" class="form-control">
               <?php 
               if(!empty($editData['id']) && isset($editData['id']))
               {
                  $populateData = (!empty($editData['category_image']) && isset($editData['category_image']) ? base_url('assets\images\category_image\\'.$editData['category_image']) : (empty($editData['category_image']) ? base_url('assets/images/category_image/default_category.jpg') : ''));
                  ?>
                  <img src="<?php echo xss_clean($populateData);?>" class="img_thumb mt-2 popup">
               <?php } ?>
            </div>                 
            <?php 
            $populateData = isset($editData['id']) && $editData['id'] ? lang('core_button_update') : lang('core_button_save'); ?>
            <input type="submit" name="<?php echo xss_clean($populateData);?>" value="<?php echo ucfirst($populateData);?>" class="btn btn-primary btn-lg">
            <a href="<?php echo base_url("admin/category");?>" class="btn btn-dark btn-lg"><?php echo lang('core_button_cancel'); ?></a>
            <?php echo form_close(); ?>
         </div>
      </div>
   </div>
</div>