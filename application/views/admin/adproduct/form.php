<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row"> 
	<div class="col-12 col-md-12 col-lg-12">
		<div class="card">
			<div class="card-body">
				<?php echo form_open_multipart('', array('role'=>'form','novalidate'=>'novalidate')); ?>
					<div class="row mt-3">
						<div class="col-5">
							<div class="form-group <?php echo form_error('category_id') ? ' has-error' : ''; ?>">
				              <?php echo  form_label('카테고리', 'category_id'); ?>
				              <span class="required">*</span>
				              <?php 
				                $populateData = $this->input->post('category_id') ? $this->input->post('category_id') : (isset($ad_product_data->category_id) ? $ad_product_data->category_id :  '' );                     
				                echo form_dropdown('category_id', $category_data, $populateData, 'id="category_id" class="form-control select_dropdown"'); 
				              ?> 
				              <span class="small form-error"> <?php echo strip_tags(form_error('category_id')); ?> </span>  
				            </div>
						</div>
						<?php 
			              	$populateData = $this->input->post('status') ? $this->input->post('status') : (isset($ad_product_data->status) ? $ad_product_data->status : 0 );
			              	$is_status = $populateData == 1 ? 1 : 0;
			              	$is_status_checked = $is_status == 1 ? "checked" : "";
			          	?>						
						<div class="col-2">
				            <div class="form-group togle_button">
							<?php echo  form_label('상태', 'status'); ?>
				              <label class="custom-switch form-control">
				                <input type="checkbox" name="status" value="1" <?php echo $is_status_checked; ?> class="custom-switch-input is_premium"  data-size="sm">
				                <span class="custom-switch-indicator"></span>
				              </label>
				            </div>
							
				        </div>

						<div class="col-5">
							<div class="form-group <?php echo form_error('inst_id') ? ' has-error' : ''; ?>">
			                 <?php echo  form_label('캠핑장의 테마', 'inst_id'); ?>
							<?php 
				                $populateData = $this->input->post('inst_id') ? $this->input->post('inst_id') : (isset($ad_product_data->inst_id) ? $ad_product_data->inst_id :  '' );                     
				                echo form_dropdown('inst_id', $inst_data, $populateData, 'id="inst_id" class="form-control select_dropdown"'); 
				              ?> 
			                 <span class="small form-error"> <?php echo strip_tags(form_error('inst_id')); ?> </span>
			              	</div>


			           </div>
					   <div class="clearfix"></div>
				          <div class="col-4">
				            <div class="form-group">
				              <?php echo  form_label(lang('image'), 'image'); ?>
				              <?php 
				                $populateData = isset($ad_product_data->image) && $ad_product_data->image ? $ad_product_data->image :  ''; 
				              ?> 

				              <input type="file" name="image" id="image" class="form-control">
				              <?php 
				                if($populateData)
				                {
				              		?> 
				                  <img  class="image_preview mt-2 popup img_thumb" id="popup" src="<?php echo base_url('assets/images/advertisment/').$populateData; ?>">
				              		<?php
				                }
				              ?>
  				              <span class="small form-error"> <?php echo strip_tags(form_error('image')); ?> </span> 
				            </div>
				          </div>
						  <div class="col-8">
				            <div class="form-group <?php echo form_error('title') ? ' has-error' : ''; ?>">
				              <?php echo  form_label(lang('admin_title'), 'title'); ?> 
				              <span class="required">*</span>
				              <?php 
				                $populateData = $this->input->post('title') ? $this->input->post('title') : (isset($ad_product_data->title) ? $ad_product_data->title :  '' );
				              ?>
				              <input type="text" name="title" id="title" class="form-control" value="<?php echo xss_clean($populateData);?>">
				              <span class="small form-error"> <?php echo strip_tags(form_error('title')); ?> </span>
				            </div>
				        </div>
			          
			          <div class="clearfix"></div>
					  <div class="col-12">
				            <div class="form-group <?php echo form_error('url') ? ' has-error' : ''; ?>">
				              <?php echo  form_label('링크 Url', 'url'); ?> 
				              <span class="required">*</span>
				              <?php 
				                $populateData = $this->input->post('url') ? $this->input->post('url') : (isset($ad_product_data->url) ? $ad_product_data->url :  '' );
				              ?>
				              <input type="text" name="url" id="url" class="form-control" value="<?php echo xss_clean($populateData);?>">
				              <span class="small form-error"> <?php echo strip_tags(form_error('url')); ?> </span>
				            </div>
				        </div>
					  <div class="clearfix"></div>
			          <div class="col-12">
			            <div class="form-group <?php echo form_error('description') ? ' has-error' : ''; ?>">
			              <?php echo  form_label(lang('description'), 'description'); ?>
			              <?php
			                $populateData = $this->input->post('description') ? $this->input->post('description') : (isset($ad_product_data->description) ? $ad_product_data->description :  '' );
			              ?>
			              <span class="required">*</span>
			              <textarea name="description" id="quiz_instruction" class="form-control editor" rows="5" ><?php echo xss_clean($populateData);?></textarea>
			              <span class="small form-error"> <?php echo strip_tags(form_error('description')); ?> </span>
			            </div>
			          </div>

			          <div class="col-12">
			            <?php $saveUpdate = isset($ad_product_id) && !empty($ad_product_id) ? lang('core_button_update') : lang('core_button_save'); ?>
			            <input type="submit"  value="<?php echo ucfirst($saveUpdate);?>" class="btn btn-primary px-5">
			            <a href="<?php echo base_url('admin/adproduct');?>" class="btn btn-dark px-5"><?php echo lang('core_button_cancel'); ?></a>
			          </div>
			          <div class="clearfix"></div>

					</div>
				<?php echo form_close();?>
			</div>
		</div>
	</div>
</div>