<?php defined('BASEPATH') OR exit('No direct script access allowed');
   if($this->session->flashdata('success')) {
      echo '<div class="alert alert-success alert-dismissible">
      <button type="button" class="close" aria-label="close" data-dismiss="alert">&times;</button>
      <strong>Success!</strong> '.$this->session->flashdata("success").'
      </div>';
   }
?>
<div class="card">
   <?php
      $data['tab_ext_course_id'] = $ext_course_id;
      $this->load->view('admin/extcourse/common_tab_list',$data);
   ?>
</div>   

<div class="panel panel-default">
   
   <a href="<?php echo base_url('admin/extcourse/contents-delete/'.$ext_course_id); ?>" class="btn btn-primary cat float-right mr-2" >홀라당 지우기</a>

   <div class="clearfix"></div>
   <hr>
   
      <div class="card">
         <div class="card-body">
            <div class="row mt-3">
               <div class="col-12">

                    <div class="row contant_main_section">
                        <?php 
                            if($ext_lesson_list)
                            {
                                foreach ($ext_lesson_list as $section_contant_data) 
                                { 
                                ?>
                                <div class="col-12 contant_section border-bottom-1 py-2">
                                    <div class="row">
                                        <div class="col-7 my-auto">
                                            <h6 class="small"><?php echo $section_contant_data->material_order; ?>. <?php echo $section_contant_data->title; ?></h6>
                                        </div>
                                        <div class="col-3  my-auto">
                                            <h6 class="small">  <?php echo $section_contant_data->value; ?></h6>
                                        </div>
                                    </div>
                                    
                                </div>

                                <?php
                                }
                            }
                            else
                            {
                                ?>
                                <div class="col-12 text-center text-danger py-2">
                                <label>아직 콘텐츠가 엄네여...</label>
                                </div>
                                <?php
                            }
                        ?>                                       
                    </div>

               </div>
            </div>
         </div>
      </div>
</div>
