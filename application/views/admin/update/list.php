<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row updates">

  <div class="col-12 col-md-12 col-lg-12">
      <div class="card">
         <div class="card-body">

               <div class="row text-center">
                  
                  <?php 
                  if($purchase_code_is_verified) 
                  {
                        if($next_version_name)
                        { ?>

                           <div class="col-6">
                              <!-- <h4>Current Version <?php //echo $response->client_version; ?></h4> -->
                              <h4> Current Version <?php echo $this->settings->site_version; ?> </h4>
                           </div>

                           <div class="col-6">
                              <h4>Latest Version  <?php echo $next_version_name; ?></h4>
                           </div>

                           <div class="col-12 text-center h-100">
                              <?php echo $next_version_description;  ?>
                           </div>


                           <?php
                           if($is_copy_working)
                           { 
                              echo form_open_multipart('', array('role'=>'form','novalidate'=>'novalidate' ,'class'=>'w-100')); ?> 
                              <div class="col-12 my-5 text-center w-100">
                                 <input type="submit" name="download" value="Upgrade To latest Version" class="btn btn-primary">
                              </div>
                              <?php echo form_close();
                           }
                           else
                           { ?>

                              <div class="col-12 my-5">
                                 <h6 class="text-center text-danger"> Please download the latest version from below link, than extract and upload on project's root directory.</h6>
                                 <div class="text-danger text-center">
                                    *** Imp: Always keep maintenance mode active while uploading the files. 
                                 </div>
                                 
                              </div>
                              <?php 
                              $download = $next_version_all_in_one_zip ? "download" : "#";
                              $next_version_all_in_one_zip = $next_version_all_in_one_zip ? $next_version_all_in_one_zip : "#";
                              ?>

                              <div class="col-12 my-5 text-center w-100">
                                 <a href="<?php echo $next_version_all_in_one_zip; ?>" <?php echo $download; ?>  class="btn btn-primary">Download Update</a>
                                 
                              </div>
                              <?php
                           }
                        }
                        else
                        {
                           echo "<div class='col-12 text-center>'><h4 class='text-success'>".lang('You are On Latest Version !')."</h4></div>"; 
                        }            
                  }
                  else
                  {
                     echo "<div class='col-12 text-center>'><h4 class='text-danger'>".$update_info_message."</h4></div>"; 
                  }
                  ?>
                  <div class="clearfix"></div>

            </div>
         </div>
      </div>
   </div>
</div>
