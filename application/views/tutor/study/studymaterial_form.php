<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row"> 
	<div class="col-12 col-md-12 col-lg-12">
		<div class="card">
			<?php
				if(isset($study_material_id) && !empty($study_material_id)) {
    				$data['tab_study_material_id'] = $study_material_id;
    		 		$this->load->view('tutor/study/common_tab_list',$data);
    		 	}
    		?>
			<div class="card-body">
				<?php echo form_open_multipart('', array('role'=>'form','novalidate'=>'novalidate')); ?>
					<div class="row mt-3">
						

						<div class="col-12">
							<div class="form-group <?php echo form_error('category_id') ? ' has-error' : ''; ?>">
				              <?php echo  form_label(lang('quiz_category_name'), 'category_id'); ?>
				              <span class="required">*</span>
				              <?php 
				                $populateData = $this->input->post('category_id') ? $this->input->post('category_id') : (isset($study_material_data->category_id) ? $study_material_data->category_id :  '' );                     
				                echo form_dropdown('category_id', $category_data, $populateData, 'id="category_id" class="form-control select_dropdown"'); 
				              ?> 
				              <span class="small form-error"> <?php echo strip_tags(form_error('category_id')); ?> </span>  
				            </div>
						</div>


						<div class="col-6">
				            <div class="form-group <?php echo form_error('title') ? ' has-error' : ''; ?>">
				              <?php echo  form_label(lang('admin_title'), 'title'); ?> 
				              <span class="required">*</span>
				              <?php 
				                $populateData = $this->input->post('title') ? $this->input->post('title') : (isset($study_material_data->title) ? $study_material_data->title :  '' );
				              ?>
				              <input type="text" name="title" id="title" class="form-control" value="<?php echo xss_clean($populateData);?>">
				              <span class="small form-error"> <?php echo strip_tags(form_error('title')); ?> </span>
				            </div>
				        </div>

				        

				          <div class="col-6">
				            <div class="form-group <?php echo form_error('image') ? ' has-error' : ''; ?>">
				              <?php echo  form_label(lang('image'), 'image'); ?>

				              <span class="required">*</span>
				              <?php 
				                $populateData = isset($study_material_data->image) && $study_material_data->image ? $study_material_data->image :  ''; 
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


						<div class="clearfix"></div>


			          	<?php 
			              	$populateData = $this->input->post('status') ? $this->input->post('status') : (isset($study_material_data->status) ? $study_material_data->status : 0 );
			              	$is_status_active = $populateData == 1 ? 1 : 0;
			              	$is_status_checked = $is_status_active == 1 ? "checked" : "";
			          	?>

				        <div class="col-3">
				            <div class="form-group togle_button">
				              <?php echo  form_label(lang('status'), 'status'); ?>
				              <label class="custom-switch form-control">
				                <input type="checkbox" name="status" value="1" <?php echo xss_clean($is_status_checked); ?> class="custom-switch-input status"  data-size="sm">
				                <span class="custom-switch-indicator"></span>
				              </label>
				            </div>
				        </div>



			          	<?php 
			              	$populateData = $this->input->post('is_registered') ? $this->input->post('is_registered') : (isset($study_material_data->is_registered) ? $study_material_data->is_registered : 0 );
			              	$is_registered = $populateData == 1 ? 1 : 0;
			              	$is_registered_checked = $is_registered == 1 ? "checked" : "";
			          	?>

				        <div class="col-3">
				            <div class="form-group togle_button">
				              <?php echo  form_label(lang('available_for_registered_only'), 'is_registered'); ?>
				              <label class="custom-switch form-control">
				                <input type="checkbox" name="is_registered" value="1" <?php echo $is_registered_checked; ?> class="custom-switch-input is_registered"  data-size="sm">
				                <span class="custom-switch-indicator"></span>
				              </label>
				            </div>
			          	</div>


			          	<?php 
			              	$populateData = $this->input->post('is_premium') ? $this->input->post('is_premium') : (isset($study_material_data->is_premium) ? $study_material_data->is_premium : 0 );
			              	$is_premium = $populateData == 1 ? 1 : 0;
			              	$is_premium_checked = $is_premium == 1 ? "checked" : "";
			              	$price_readonly = $is_premium == 1 ? 'readonly="true"' : '';
			          	?>

				        <div class="col-3">
				            <div class="form-group togle_button">
				              <?php echo  form_label(lang('is_premium'), 'is_premium'); ?>
				              <label class="custom-switch form-control">
				                <input type="checkbox" name="is_premium" value="1" <?php echo $is_premium_checked; ?> class="custom-switch-input is_premium"  data-size="sm">
				                <span class="custom-switch-indicator"></span>
				              </label>
				            </div>
				        </div>



				        <div class="col-3 ">
			              <div class="form-group <?php echo form_error('price') ? ' has-error' : ''; ?>">
			                 <?php echo  form_label(lang('price'), 'price'); ?>
			                 <?php 
			                 $populateData = $this->input->post('price') ? $this->input->post('price') : (isset($study_material_data->price) ? $study_material_data->price :  0 );
			                 ?>
			                 <input type="number" <?php echo $price_readonly; ?> name="price" id="price" class="form-control input_price" value="<?php echo $populateData;?>">
			                 <span class="small form-error"> <?php echo strip_tags(form_error('price')); ?> </span>
			              </div>
			           </div>



			           <div class="clearfix"></div>
			          
			          <div class="clearfix"></div>
			          <div class="col-12">
			            <div class="form-group <?php echo form_error('description') ? ' has-error' : ''; ?>">
			              <?php echo  form_label(lang('description'), 'description'); ?>
			              <?php
			                $populateData = $this->input->post('description') ? $this->input->post('description') : (isset($study_material_data->description) ? $study_material_data->description :  '' );
			              ?>
			              <span class="required">*</span>
			              <textarea name="description" id="quiz_instruction" class="form-control editor" rows="5" ><?php echo xss_clean($populateData);?></textarea>
			              <span class="small form-error"> <?php echo strip_tags(form_error('description')); ?> </span>
			            </div>
			          </div>

			          <div class="clearfix"></div>
			          <div class="col-12"> 
			            <h2 class="text-center"><?php echo lang('seo_heading');?></h2>
			          </div>

			          <div class="col-12">
			            <div class="form-group <?php echo form_error('meta_title') ? ' has-error' : ''; ?>">
			              <?php echo  form_label(lang('meta_title'), 'metatitle'); ?> 
			              <?php 
			                $populateData = $this->input->post('metatitle') ? $this->input->post('metatitle') : (isset($study_material_data->meta_title) ? $study_material_data->meta_title :  '' );
			              ?>
			              <input type="text" name="metatitle" id="metatitle" class="form-control" value="<?php echo xss_clean($populateData);?>">
			              <span class="small form-error"> <?php echo strip_tags(form_error('metatitle')); ?> </span>
			            </div>
			          </div>

			          <div class="col-12">
			            <div class="form-group <?php echo form_error('meta_kewords') ? ' has-error' : ''; ?>">
			              <?php echo  form_label(lang('meta_kewords'), 'metakeywords'); ?>
			              <?php
			                $populateData = $this->input->post('metakeywords') ? $this->input->post('metakeywords') : (isset($study_material_data->meta_keywords) ? $study_material_data->meta_keywords :  '' );
			              ?>
			              <input type="text" name="metakeywords" id="metakeywords" class="form-control" value="<?php echo $populateData;?>" data-role="tagsinput">
			            </div>
			          </div>

			          <div class="col-12">
			            <div class="form-group <?php echo form_error('meta_description') ? ' has-error' : ''; ?>">
			              <?php echo  form_label(lang('meta_description'), 'metadescription'); ?>
			              <?php
			                $populateData = $this->input->post('metadescription') ? $this->input->post('metadescription') : (isset($study_material_data->meta_description) ? $study_material_data->meta_description :  '' );
			              ?>
			              <textarea name="metadescription" id="metadescription" class="form-control " rows="5" ><?php echo xss_clean($populateData);?></textarea>
			              <span class="small form-error"> <?php echo strip_tags(form_error('metadescription')); ?> </span>
			            </div>
			          </div>

			          <div class="col-12">
			            <?php $saveUpdate = isset($study_material_id) && !empty($study_material_id) ? lang('core_button_update') : lang('core_button_save'); ?>
			            <input type="submit"  value="<?php echo ucfirst($saveUpdate);?>" class="btn btn-primary px-5">
			            <a href="<?php echo base_url('tutor/study');?>" class="btn btn-dark px-5"><?php echo lang('core_button_cancel'); ?></a>
			          </div>
			          <div class="clearfix"></div>

					</div>
				<?php echo form_close();?>
			</div>
		</div>
	</div>
</div>