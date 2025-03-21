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
			<div class="card-body">
				<?php echo form_open_multipart('', array('role'=>'form','novalidate'=>'novalidate')); ?>
					<div class="row mt-3">
						<div class="col-4">
							<div class="form-group <?php echo form_error('category_id') ? ' has-error' : ''; ?>">
				              <?php echo  form_label('카테고리', 'category_id'); ?>
				              <span class="required">*</span>
				              <?php 
				                $populateData = $this->input->post('category_id') ? $this->input->post('category_id') : (isset($ext_course_data->category_id) ? $ext_course_data->category_id :  '' );                     
				                echo form_dropdown('category_id', $category_data, $populateData, 'id="category_id" class="form-control select_dropdown"'); 
				              ?> 
				              <span class="small form-error"> <?php echo strip_tags(form_error('category_id')); ?> </span>  
				            </div>
						</div>
						<?php 
			              	$populateData = $this->input->post('is_premium') ? $this->input->post('is_premium') : (isset($ext_course_data->is_premium) ? $ext_course_data->is_premium : 0 );
			              	$is_premium = $populateData == 1 ? 1 : 0;
			              	$is_premium_checked = $is_premium == 1 ? "checked" : "";
			          	?>

				        <div class="col-2">
				            <div class="form-group togle_button">
							<?php echo  form_label('Youtube', 'is_premium'); ?>
				              <label class="custom-switch form-control">
				                <input type="checkbox" name="is_premium" value="1" <?php echo $is_premium_checked; ?> class="custom-switch-input is_premium"  data-size="sm">
				                <span class="custom-switch-indicator"></span>
				              </label>
				            </div>
				        </div>

						<?php 
			              	$populateData = $this->input->post('status') ? $this->input->post('status') : (isset($ext_course_data->status) ? $ext_course_data->status : 0 );
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
			              <div class="form-group <?php echo form_error('price') ? ' has-error' : ''; ?>">
			                 <?php echo  form_label(lang('price'), 'price'); ?>
			                 <?php 
			                 $populateData = $this->input->post('price') ? $this->input->post('price') : (isset($ext_course_data->price) ? $ext_course_data->price :  0 );
			                 ?>
			                 <input type="number" name="price" id="price" class="form-control input_price" value="<?php echo $populateData;?>">
			                 <span class="small form-error"> <?php echo strip_tags(form_error('price')); ?> </span>
			              </div>
			           </div>


				          <div class="col-4">
				            <div class="form-group">
				              <?php echo  form_label(lang('image'), 'image'); ?>
				              <?php 
				                $populateData = isset($ext_course_data->image) && $ext_course_data->image ? $ext_course_data->image :  ''; 
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
				                $populateData = $this->input->post('title') ? $this->input->post('title') : (isset($ext_course_data->title) ? $ext_course_data->title :  '' );
				              ?>
				              <input type="text" name="title" id="title" class="form-control" value="<?php echo xss_clean($populateData);?>">
				              <span class="small form-error"> <?php echo strip_tags(form_error('title')); ?> </span>
				            </div>
				        </div>
			          
			          <div class="clearfix"></div>
					  <div class="col-6">
			              <div class="form-group <?php echo form_error('orders') ? ' has-error' : ''; ?>">
			                 <?php echo  form_label('순서', 'orders'); ?>
			                 <?php 
			                 $populateData = $this->input->post('orders') ? $this->input->post('orders') : (isset($ext_course_data->orders) ? $ext_course_data->orders :  0 );
			                 ?>
			                 <input type="number" name="orders" id="orders" class="form-control input_price" value="<?php echo $populateData;?>">
			                 <span class="small form-error"> <?php echo strip_tags(form_error('orders')); ?> </span>
			              </div>
			           </div>
					   <div class="col-6">
							<div class="form-group <?php echo form_error('instute_id') ? ' has-error' : ''; ?>">
			                 <?php echo  form_label('캠핑장의 테마', 'instute_id'); ?>

							<?php 
				                $populateData = $this->input->post('instute_id') ? $this->input->post('instute_id') : (isset($ext_course_data->instute_id) ? $ext_course_data->instute_id :  '' );                     
				                echo form_dropdown('instute_id', $instute_data, $populateData, 'id="instute_id" class="form-control select_dropdown"'); 
				              ?> 
			                 <span class="small form-error"> <?php echo strip_tags(form_error('instute_id')); ?> </span>
			              	</div>
				        </div>
					  <div class="clearfix"></div>
					  <div class="col-12">
				            <div class="form-group <?php echo form_error('url') ? ' has-error' : ''; ?>">
				              <?php echo  form_label('멋진 한줄 요약', 'url'); ?> 
				              <span class="required">*</span>
				              <?php 
				                $populateData = $this->input->post('url') ? $this->input->post('url') : (isset($ext_course_data->url) ? $ext_course_data->url :  '' );
				              ?>
				              <input type="text" name="url" id="url" class="form-control" value="<?php echo xss_clean($populateData);?>">
				              <span class="small form-error"> <?php echo strip_tags(form_error('url')); ?> </span>
				            </div>
				        </div>
						<div class="clearfix"></div>

						<div class="col-12">
						<div class="form-group <?php echo form_error('instute_courses') ? ' has-error' : ''; ?>">
							<?php echo  form_label('태그', 'instute_courses'); ?>
							<span class="required">*</span>
							<?php
							$populateData = $this->input->post('instute_courses');
							$post_populateData = ($populateData && is_array($populateData)) ? $populateData : $institution_course_array;

							?>

							<div class="form-control h-100">
							
							<?php 
							if($all_courses)
							{
								foreach ($all_courses as $courses_obj) 
								{
									$is_selected = in_array($courses_obj->id, $post_populateData) ? 'checked' : '';
									?>
									<div class="form-check form-check-inline">
										<input <?php echo $is_selected; ?> class="form-check-input" name="instute_courses[]" type="checkbox" id="inlineCheckbox_<?php echo $courses_obj->id; ?>" value="<?php echo $courses_obj->id; ?>">
										<label class="form-check-label" for="inlineCheckbox_<?php echo $courses_obj->id; ?>"><?php echo $courses_obj->title; ?></label>
									</div>
									<?php
								}
							}
							else
							{
								?>
								<label class="form-label text-danger w-100 text-center m-0"><?php echo lang('please_add_course_first'); ?></label>
								<?php
							}
							?>
							
							</div>

							<span class="small form-error"> <?php echo strip_tags(form_error('instute_courses')); ?> </span>
						</div>
						</div>

					  <div class="clearfix"></div>
			          <div class="col-12">
			            <div class="form-group">
			              <?php echo  form_label(lang('description'), 'description'); ?>
			              <?php
			                $populateData = $this->input->post('description') ? $this->input->post('description') : (isset($ext_course_data->description) ? $ext_course_data->description :  '' );
			              ?>
			              <span class="required">*</span>
			              <textarea name="description" id="quiz_instruction" class="form-control editor" rows="5" ><?php echo $populateData;?></textarea>
			              
			            </div>
			          </div>

			          <div class="col-12">
			            <?php $saveUpdate = isset($ext_course_id) && !empty($ext_course_id) ? lang('core_button_update') : lang('core_button_save'); ?>
			            <input type="submit"  value="<?php echo ucfirst($saveUpdate);?>" class="btn btn-primary px-5">
			            <a href="<?php echo base_url('admin/extcourse');?>" class="btn btn-dark px-5"><?php echo lang('core_button_cancel'); ?></a>
			          </div>
			          <div class="clearfix"></div>

					</div>
				<?php echo form_close();?>
			</div>
		</div>
	</div>
</div>