<?php
    switch ( $page_slug ) {
        case "longterm":
            $view_inc_file = "inc_longterm.php";
            break;
        case "homecare":
            $view_inc_file = "inc_homecare.php";
            break;
        case "facil":
            $view_inc_file = "inc_facil.php";
            break;                    
        default:
            $view_inc_file = "inc_basic_senservice.php";
    }
?>
<!-- Page content-->
<div class="pb-4 min-h-100vh">
    <div class="container">
        <div class="row px-3">
            <?php 
                include($view_inc_file); 
                //-- 연관 포스트
                if($rel_post_data)
                { ?>  
                    <div class="card-header px-2 pt-8 pb-4">
                        <p class="lead mb-0 display-6 font-weight-bolder">연관 콘텐츠</p>
                    </div>                           
                    <div class="row pt-3 pb-0 pr-0 pl-3">
                        <?php
                        $data['blog_list_data'] = $rel_post_data;
                        $this->load->view('small_blog_list',$data);        
                        ?>
                    </div>
                <?php 
                } 
            ?> 
            <!-- /// 관련 포스트 card E /// -->
            </div> 
        </div>
    </div>
</div>