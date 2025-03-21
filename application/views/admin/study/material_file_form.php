<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row"> 
	<div class="col-12 col-md-12 col-lg-12">
		<div class="card">
			<?php
				if(isset($study_material_id)) {
    				$data['tab_study_material_id'] = $study_material_id;
    				$data['contant_type'] = $contant_type;
    		 		$this->load->view('admin/study/common_tab_list',$data);
    		 	}
    			?>
    		<div class="card-body">
				
				<?php echo form_open_multipart('', array('role'=>'form','novalidate'=>'novalidate')); ?>
					
					<div class="row mt-3">
						
				        <div class="col-4">
				            <div class="form-group <?php echo form_error('section_id') ? ' has-error' : ''; ?>">
				              <?php echo  form_label(lang('section'), 'section_id'); ?> 
				              <span class="required">*</span>
				              <?php 
				                $populateData = $this->input->post('section_id') ? $this->input->post('section_id') : (isset($study_material_content_data->section_id) ? $study_material_content_data->section_id :  '' );
				              ?>
				              <select name="section_id" class="form-control section_id" id="section_id">
				              	<?php
				              		foreach ($study_material_section_data as $key => $section_obj) 
				              		{
				              			$selected = $populateData == $section_obj->id ? "selected" : "";
				              			echo "<option $selected value='$section_obj->id'>$section_obj->title</option>";
				              		}
				              	?>
				              </select>
				              <?php 

				              ?>
				              
				              <span class="small form-error"> <?php echo strip_tags(form_error('section_id')); ?> </span>
				            </div>
				        </div>


				        <div class="col-4">
				            <div class="form-group <?php echo form_error('title') ? ' has-error' : ''; ?>">
				              <?php echo  form_label(lang('admin_title'), 'title'); ?> 
				              <span class="required">*</span>
				              <?php 
				                $populateData = $this->input->post('title') ? $this->input->post('title') : (isset($study_material_content_data->title) ? $study_material_content_data->title :  '' );
				              ?>
				              <input type="text" name="title" id="title" class="form-control" value="<?php echo xss_clean($populateData);?>">
				              <span class="small form-error"> <?php echo strip_tags(form_error('title')); ?> </span>
				            </div>
				        </div>

				        <div class="col-2">
				            <div class="form-group <?php echo form_error('duration') ? ' has-error' : ''; ?>">
				              시간(sec)
				              <span class="required">*</span>
				              <?php 
				                $populateData = $this->input->post('duration') ? $this->input->post('duration') : (isset($study_material_content_data->duration) ? $study_material_content_data->duration :  '' );
				              ?>
				              <input type="text" name="duration" id="duration" class="form-control" value="<?php echo xss_clean($populateData);?>">
				              <span class="small form-error"> <?php echo strip_tags(form_error('duration')); ?> </span>
				            </div>
				        </div>
                        
                                                        <?php 
			              	$populateData = $this->input->post('example') ? $this->input->post('example') : (isset($study_material_content_data->example) ? $study_material_content_data->example : 0 );
			              	$is_status_active = $populateData == 1 ? 1 : 0;
			              	$is_status_checked = $is_status_active == 1 ? "checked" : "";
			          	        ?>

				        <div class="col-2">
				            <div class="form-group togle_button">
				              샘플
				              <label class="custom-switch form-control">
				                <input type="checkbox" name="example" value="1" <?php echo xss_clean($is_status_checked); ?> class="custom-switch-input status"  data-size="sm">
				                <span class="custom-switch-indicator"></span>
				              </label>
				            </div>
				        </div>
                        
			           
			           
			           <div class="col-12">
			           		<div class="form-group  <?php echo (form_error('file_upload') OR form_error('embed_code_contant')) ? ' has-error' : ''; ?>">
			           		
			               <?php 
			               if($contant_type == 'image')
			               	{
				           		if(isset($study_material_content_data->value) && !empty($study_material_content_data->value))
				               	{ ?>
				               		<a href="<?php echo base_url('assets/uploads/study_material/'.$study_material_content_data->value);?>" target="_blank"><?php echo $study_material_content_data->value;?></a>	
				               		<br/>
				               		<?php 
				               	} 

				               	echo form_label(lang('admin_upload_image'), 'file_upload'); ?>
				               	<span class="text-danger"> * <span class="text-warning">  <?php echo lang("upload_max_file_size") ." ". ini_get('upload_max_filesize')."B";?></span></span>
				               	<br/>
				               	<input type="file" name="file" id="categoryimage" class="form-control" accept="image/*">
				               	<span class="small form-error w-100"> <?php echo strip_tags(form_error('file_upload')); ?> </span>
				               	<div class="clearfix"></div>

				           	   	<?php $allowed_formate = 'gif, jpg, png, bmp, jpeg'; ?>
				           	   	<label class="mt-2">Allowed File Type: <?php echo $allowed_formate; ?></label>
				           	   <?php  
			           		}
			           		elseif ($contant_type == "video") 
			           		{
				           		if(isset($study_material_content_data->value) && !empty($study_material_content_data->value))
				               	{ ?>
				               		<a href="<?php echo base_url('assets/uploads/study_material/'.$study_material_content_data->value);?>" target="_blank"><?php echo $study_material_content_data->value;?></a>	
				               		<br/>
				               		<?php 
				               	} 

				               	echo form_label(lang('admin_upload_image'), 'file_upload'); ?>
				               	<span class="text-danger"> * <span class="text-warning">  <?php echo lang("upload_max_file_size") ." ". ini_get('upload_max_filesize')."B";?></span></span>
				               	<br/>
				               	<input type="file" name="file" id="categoryimage" class="form-control" accept="video/*">
				               	<span class="small form-error w-100"> <?php echo strip_tags(form_error('file_upload')); ?> </span>
				               	<div class="clearfix"></div>

				           	   	<?php $allowed_formate = 'flv, wma, avi, wmv, mp4, wav, mov, avchd, webm, mkv'; ?>
				           	   	<label class="mt-2">Allowed File Type: <?php echo $allowed_formate; ?></label>
				           	   <?php 

			           		}			            
			           		elseif ($contant_type == "audio") 
			           		{
				           		if(isset($study_material_content_data->value) && !empty($study_material_content_data->value))
				               	{ ?>
				               		<a href="<?php echo base_url('assets/uploads/study_material/'.$study_material_content_data->value);?>" target="_blank"><?php echo $study_material_content_data->value;?></a>	
				               		<br/>
				               		<?php 
				               	} 

				               	echo form_label(lang('admin_upload_image'), 'file_upload'); ?>
				               	<span class="text-danger"> * <span class="text-warning">  <?php echo lang("upload_max_file_size") ." ". ini_get('upload_max_filesize')."B";?></span></span>
				               	<br/>
				               	<input type="file" name="file" id="categoryimage" class="form-control" accept="audio/*">
				               	<span class="small form-error w-100"> <?php echo strip_tags(form_error('file_upload')); ?> </span>
				               	<div class="clearfix"></div>
				           	   
				           	   	<?php $allowed_formate = 'ogg, aac, mp3, mpeg, amr'; ?>
				           	   	<label class="mt-2">Allowed File Type: <?php echo $allowed_formate; ?></label>
				           	   <?php 

			           		}			            
			           		elseif ($contant_type == "pdf") 
			           		{
				           		if(isset($study_material_content_data->value) && !empty($study_material_content_data->value))
				               	{ ?>
				               		<a href="<?php echo base_url('assets/uploads/study_material/'.$study_material_content_data->value);?>" target="_blank"><?php echo $study_material_content_data->value;?></a>	
				               		<br/>
				               		<?php 
				               	} 

				               	echo form_label(lang('admin_upload_image'), 'file_upload'); ?>
				               	<span class="text-danger"> * <span class="text-warning">  <?php echo lang("upload_max_file_size") ." ". ini_get('upload_max_filesize')."B";?></span></span>
				               	<br/>
				               	<input type="file" name="file" id="categoryimage" class="form-control" accept="application/pdf">
				               	<span class="small form-error w-100"> <?php echo strip_tags(form_error('file_upload')); ?> </span>
				               	<div class="clearfix"></div>
				           	   				           	   
				           	   	<?php $allowed_formate = 'pdf'; ?>
				           	   	<label class="mt-2">Allowed File Type: <?php echo $allowed_formate; ?></label>
				           	   <?php 

			           		}			            
			           		elseif ($contant_type == "doc") 
			           		{
				           		if(isset($study_material_content_data->value) && !empty($study_material_content_data->value))
				               	{ ?>
				               		<a href="<?php echo base_url('assets/uploads/study_material/'.$study_material_content_data->value);?>" target="_blank"><?php echo $study_material_content_data->value;?></a>	
				               		<br/>
				               		<?php 
				               	} 

				               	echo form_label(lang('admin_upload_image'), 'file_upload'); ?>
				               	<span class="text-danger"> * <span class="text-warning">  <?php echo lang("upload_max_file_size") ." ". ini_get('upload_max_filesize')."B";?></span></span>
				               	<br/>
				               	<input type="file" name="file" id="categoryimage" class="form-control" accept=".xlsx,.xls,.doc, .docx,.ppt, .pptx, .odt, .rtf, .xps, .csv, .ods ">
				               	<span class="small form-error w-100"> <?php echo strip_tags(form_error('file_upload')); ?> </span>
				               	<div class="clearfix"></div>				           	   
				           	   
				           	   	<?php $allowed_formate = 'doc, docx, odt, rtf, xps, csv, ods, xls, xlsx, ppt, pptx'; ?>
				           	   	<label class="mt-2">Allowed File Type: <?php echo $allowed_formate; ?></label>
				           	   <?php 

			           		}
			           		elseif ($contant_type == "youtube-embed-code") 
			           		{
								$populateData = (isset($study_material_content_data->value) && $study_material_content_data->value) ? $study_material_content_data->value : "";
				               	echo form_label(lang('youtube_embed_code'), 'embed_code_contant'); ?>
				               	<span class="text-danger"> *</span>
				               	<br/>
				               	<input type="text" name="embed_code_contant" id="embed_code_contant" class="form-control embed_code_contant" required="true" value="<?php echo xss_clean($populateData);?>">
				               	<span class="small form-error w-100"> <?php echo strip_tags(form_error('embed_code_contant')); ?> </span>
				           	   	<div class="clearfix"></div>
				           	   <?php 
			           		}
			           		elseif ($contant_type == "vimeo-embed-code") 
			           		{
			           			$populateData = (isset($study_material_content_data->value) && $study_material_content_data->value) ? $study_material_content_data->value : "";
				               	echo form_label(lang('vimeo_embed_code'), 'embed_code_contant'); ?>
				               	<span class="text-danger"> *</span>
				               	<br/>
				               	<input type="text" name="embed_code_contant" id="embed_code_contant" class="form-control embed_code_contant" required="true" value="<?php echo xss_clean($populateData);?>">
				               	<span class="small form-error w-100"> <?php echo strip_tags(form_error('embed_code_contant')); ?> </span>
				           	   	<div class="clearfix"></div>
				           	   <?php 
			           		}
			           		elseif ($contant_type == "content") 
			           		{
			           			$populateData = (isset($study_material_content_data->value) && $study_material_content_data->value) ? $study_material_content_data->value : "";
				               	echo form_label(lang('contaet_or_embed_code'), 'embed_code_contant'); ?>
				               	<span class="text-danger"> *</span>
				               	<br/>
				               	<textarea required="true" name="embed_code_contant" id="embed_code_contant" class="form-control editor" rows="5" ><?php echo xss_clean($populateData);?></textarea>
				               	<span class="small form-error w-100"> <?php echo strip_tags(form_error('embed_code_contant')); ?> </span>
				           	   	<div class="clearfix"></div>
				           	   <?php 
			           		}
                            
                            
                                                            $PlusData = (isset($study_material_content_data->plus_contents) && $study_material_content_data->plus_contents) ?$study_material_content_data->plus_contents : "";
			           		?>
				               	<br/>
                                                                        <span>추가 콘텐츠</span>
				               	<br/>
				               	<textarea required="true" name="plus_code_contant" id="plus_code_contant" class="form-control editor" rows="5" ><?php echo xss_clean($PlusData);?></textarea>
				               	<span class="small form-error w-100"> <?php echo strip_tags(form_error('plus_code_contant')); ?> </span>
				           	   	<div class="clearfix"></div>
			           		</div>
			           </div>
			           
			           <div class="clearfix"></div>


				        <div class="col-12">
				            <?php $saveUpdate = (isset($study_material_id) && !empty($study_material_id) && isset($study_material_content_id) && !empty($study_material_content_id) ? lang('core_button_update') : lang('core_button_save')); ?>
				            <input type="submit"  value="<?php echo $saveUpdate;?>" class="btn btn-primary px-5">
				            <a href="<?php echo base_url('admin/study/material-file/'.$study_material_id);?>" class="btn btn-dark px-5"><?php echo lang('core_button_cancel'); ?></a>
				        </div>

					</div>

				<?php echo form_close();?>

			</div>

    	</div>
    </div>
</div>