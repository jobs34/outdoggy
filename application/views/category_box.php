    <?php 
    $user_id = isset($this->user['id']) ? $this->user['id'] : 0;
    $category_img_dir = base_url("assets/images/category_image/");
    if($category_data)
    {  
      $i = 0;
      foreach ($category_data as $category_array) 
      {
        $i++;
        $difficulty_star =  get_category_stars($category_array->id,$user_id); 
        $category_image = $category_array->category_image ? $category_array->category_image : "default.jpg";
        $category_image_name = $category_image ; 
        $category_image = $category_img_dir.$category_image;
        if(!is_file(FCPATH."assets/images/category_image/".$category_image_name))
        {
          $category_image = base_url('assets/default/default.jpg');
        }


        ?>

        <div class="col-md-4 col-xl-4 col-xs-12 col-sm-6 category_data_section" > 
          <div class="grid">
            <figure class="effect-ming">
              <img src="<?php echo xss_clean($category_image); ?>" alt="img09"/>
              <figcaption>
                

                <?php 
                $category_url = base_url('category/').$category_array->category_slug;
                $category_class = "";
                if($user_id > 0 && $difficulty_star) 
                { 
                  $category_url = "javascript:void(0)";
                  $category_class = "difficulty_level_model";
                } ?>

                
                <a href="<?php echo $category_url; ?>" class="<?php echo $category_class; ?>" data-category_slug='<?php echo $category_array->category_slug; ?>'>&nbsp;</a>
                  <div class="row">
                    <div class="col-12 mb-3">
                      <h2 class="category_name"><?php echo xss_clean($category_array->category_title);?></h2>
                    </div>
                    <?php
                    if($user_id > 0 && $difficulty_star) 
                    { 
                      $easy_star = ($difficulty_star['d_l_1'] == 1) ? "gold-star" : "";
                      $medium_star = ($difficulty_star['d_l_2'] == 2) ? "gold-star" : "";
                      $hard_star = ($difficulty_star['d_l_3'] == 3) ? "gold-star" : "";
                      ?>
                      <div class="col-12">
                        <span><i class="fa fa-star level-star <?php echo $easy_star;?>"></i></span>
                        <span><i class="fa fa-star level-star <?php echo $medium_star;?>"></i></span>
                        <span><i class="fa fa-star level-star <?php echo $hard_star;?>"></i></span>
                      </div>
                      <?php 
                    } ?>                  
                  </div>
                
                  
              </figcaption>     
            </figure>
          </div>
        </div>

        <?php 
        if($i == 6 OR $i > 6) { break;}
      }

      if($i == 6 OR $i > 6)
      { ?>
        
        <div class="col-md-12 col-xl-12 col-sm-12 text-center my-5"> 
          <a href="<?php echo base_url('all-categories'); ?>" class="btn btn-success btn-lg mt-5"><?php echo lang("view_all_categories") ?></a>
        </div>

        <?php
      } 
    }
    else
    { ?>

      <div class="col-12 text-center mt-5">
        <h3 class="text-danger mt-5"><?php echo lang('no_category_found_in')." "; ?>   </h3>

      </div>
      <?php
    } ?>  
