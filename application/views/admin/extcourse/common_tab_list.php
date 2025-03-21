<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav"> 
    <ul class="navbar-nav">
    	<?php 
          $sm_slug_url = base_url('cgrounds/').$tab_ext_course_id;
          $study_material_active = $material_file = "";
          $import_active = "";
          if(uri_string() == "admin/extcourse/update/".$tab_ext_course_id)
          {
            
            $study_material_active = "active";
          }
          if(uri_string() == "admin/extcourse/material-file/".$tab_ext_course_id)
          {
            $material_file = "active";
          }

          if(uri_string() == "admin/extcourse/import/".$tab_ext_course_id)
          {
            $import_active = "active";  
          }

      ?>          
      <li class="nav-item <?php echo $study_material_active;?>">
        <a class="nav-link " href="<?php echo base_url('admin/extcourse/update/'.$tab_ext_course_id);?>">정보 편집</a>
      </li>
      
      <li class="nav-item <?php echo $material_file;?>">
        <a class="nav-link " href="<?php echo base_url('admin/extcourse/material-file/'.$tab_ext_course_id);?>">콘텐츠 목록</a>
      </li>

      <li class="nav-item <?php echo $import_active;?>">
        <a class="nav-link" href="<?php echo base_url('admin/extcourse/import/').$tab_ext_course_id;?>">불러오기</a>
      </li>

      <li class="nav-item ">
        <a class="nav-link" href="<?php echo $sm_slug_url;?>" target="_blank">미리보기</a>
      </li>
    </ul>
  </div>
</nav>