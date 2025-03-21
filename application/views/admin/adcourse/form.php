<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row"> 
	<div class="col-12 col-md-12 col-lg-12">
		<div class="card">
			<div class="card-body">
				<?php echo form_open_multipart('', array('role'=>'form','novalidate'=>'novalidate')); ?>
					<div class="row mt-3">
						<div class="col-4">
							<div class="form-group <?php echo form_error('category_id') ? ' has-error' : ''; ?>">
				              <?php echo  form_label(lang('quiz_category_name'), 'category_id'); ?>
				              <span class="required">*</span>
				              <?php 
				                $populateData = $this->input->post('category_id') ? $this->input->post('category_id') : (isset($ad_course_data->category_id) ? $ad_course_data->category_id :  '' );                     
				                echo form_dropdown('category_id', $category_data, $populateData, 'id="category_id" class="form-control select_dropdown"'); 
				              ?> 
				              <span class="small form-error"> <?php echo strip_tags(form_error('category_id')); ?> </span>  
				            </div>
						</div>
						<?php 
			              	$populateData = $this->input->post('lesson_type') ? $this->input->post('lesson_type') : (isset($ad_course_data->lesson_type) ? $ad_course_data->lesson_type : 0 );
			              	$lesson_type = $populateData == 1 ? 1 : 0;
			              	$is_lesson_type_checked = $lesson_type == 1 ? "checked" : "";
			          	?>

				        <div class="col-2">
				            <div class="form-group togle_button">
							<?php echo  form_label('오프라인', 'lesson_type'); ?>
				              <label class="custom-switch form-control">
				                <input type="checkbox" name="lesson_type" value="1" <?php echo $is_lesson_type_checked; ?> class="custom-switch-input is_premium"  data-size="sm">
				                <span class="custom-switch-indicator"></span>
				              </label>
				            </div>
				        </div>

						<?php 
			              	$populateData = $this->input->post('status') ? $this->input->post('status') : (isset($ad_course_data->status) ? $ad_course_data->status : 0 );
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

						<div class="col-4">
			              <div class="form-group <?php echo form_error('orders') ? ' has-error' : ''; ?>">
			                 <?php echo  form_label('순서', 'orders'); ?>
			                 <?php 
			                 $populateData = $this->input->post('orders') ? $this->input->post('orders') : (isset($ad_course_data->orders) ? $ad_course_data->orders :  0 );
			                 ?>
			                 <input type="number" name="orders" id="orders" class="form-control input_price" value="<?php echo $populateData;?>">
			                 <span class="small form-error"> <?php echo strip_tags(form_error('orders')); ?> </span>
			              </div>
			           </div>
					   <div class="clearfix"></div>
					   <div class="col-2">
			              <div class="form-group <?php echo form_error('origin_price') ? ' has-error' : ''; ?>">
			                 <?php echo  form_label('훈련비용(원가)', 'origin_price'); ?>
			                 <?php 
			                 $populateData = $this->input->post('origin_price') ? $this->input->post('origin_price') : (isset($ad_course_data->origin_price) ? $ad_course_data->origin_price :  0 );
			                 ?>
			                 <input type="number" name="origin_price" id="origin_price" class="form-control input_price" value="<?php echo $populateData;?>">
			                 <span class="small form-error"> <?php echo strip_tags(form_error('origin_price')); ?> </span>
			              </div>
			           </div>
					   <div class="col-6">
			              <div class="form-group <?php echo form_error('real_price') ? ' has-error' : ''; ?>">
			                 <?php echo  form_label('실제 판매가', 'real_price'); ?>
			                 <?php 
			                 $populateData = $this->input->post('real_price') ? $this->input->post('real_price') : (isset($ad_course_data->real_price) ? $ad_course_data->real_price :  '' );
			                 ?>
			                 <input type="text" name="real_price" id="real_price" class="form-control input_price" value="<?php echo $populateData;?>">
			                 <span class="small form-error"> <?php echo strip_tags(form_error('real_price')); ?> </span>
			              </div>
			           </div>
					
						<div class="col-4">
							<div class="form-group <?php echo form_error('instute_id') ? ' has-error' : ''; ?>">
			                 <?php echo  form_label('학원ID', 'instute_id'); ?>
			                 <?php 
			                 $populateData = $this->input->post('instute_id') ? $this->input->post('instute_id') : (isset($ad_course_data->instute_id) ? $ad_course_data->instute_id :  '' );
			                 ?>
			                 <input type="text" name="instute_id" id="instute_id" class="form-control input_price" value="<?php echo $populateData;?>">
			                 <span class="small form-error"> <?php echo strip_tags(form_error('instute_id')); ?> </span>
			              	</div>
				        </div>
						<div class="clearfix"></div>
				          <div class="col-4">
				            <div class="form-group">
				              <?php echo  form_label(lang('image'), 'image'); ?>
				              <?php 
				                $populateData = isset($ad_course_data->image) && $ad_course_data->image ? $ad_course_data->image :  ''; 
				              ?> 

				              <input type="file" name="image" id="image" class="form-control">
				              <?php 
				                if($populateData)
				                {
				              		?> 
				                  <img  class="image_preview mt-2 popup img_thumb" id="popup" src="<?php echo base_url('assets/images/studymaterial/').$populateData; ?>">
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
				                $populateData = $this->input->post('title') ? $this->input->post('title') : (isset($ad_course_data->title) ? $ad_course_data->title :  '' );
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
				                $populateData = $this->input->post('url') ? $this->input->post('url') : (isset($ad_course_data->url) ? $ad_course_data->url :  '' );
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
			                $populateData = $this->input->post('description') ? $this->input->post('description') : (isset($ad_course_data->description) ? $ad_course_data->description :  '' );
			              ?>
			              <span class="required">*</span>
			              <textarea name="description" id="quiz_instruction" class="form-control editor" rows="5" ><?php echo xss_clean($populateData);?></textarea>
			              <span class="small form-error"> <?php echo strip_tags(form_error('description')); ?> </span>
			            </div>
			          </div>

			          <div class="col-12">
			            <?php $saveUpdate = isset($ad_course_id) && !empty($ad_course_id) ? lang('core_button_update') : lang('core_button_save'); ?>
			            <input type="submit"  value="<?php echo ucfirst($saveUpdate);?>" class="btn btn-primary px-5">
			            <a href="<?php echo base_url('admin/adcourse');?>" class="btn btn-dark px-5"><?php echo lang('core_button_cancel'); ?></a>
			          </div>
			          <div class="clearfix"></div>

					</div>
				<?php echo form_close();?>
			</div>
		</div>
	</div>
</div>