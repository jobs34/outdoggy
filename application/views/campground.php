<!-- =======================
Page Banner START -->
<section class="pt-0 px-0 pb-0  mb-8">
    <div class="bg-black position-relative overflow-hidden" style="background-image:url(/assets/images/campground_bg.jpg); background-position: center; background-size: cover;">
    <div class="bg-overlay bg-dark opacity-5"></div>
        <div class="container z-index-9 position-relative">
            <div class="mx-auto position-relative">
                <div class="row align-items-center">
                    <div class="col-12 mx-auto text-center py-8">
                        <!-- Title -->
                        <h1 class="display-4 py-0 my-0 text-white font-weight-bolder"><?php echo $category_data->category_title; ?></h1>
                        <p class="mb-0 lead text-light-warning"><?php echo $page_title; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- =======================
Page Banner END -->

<!-- Page content-->
<div class="pb-4">
    <div class="course-detail">
        <!-- Content -->
        <div class="container px-0">
            <!--////  리스트 S //// -->
            <?php
            if($free_course_list_data)
                { ?>
                <div class="mb-4">
                    <!-- card body -->
                    <div class="row px-3">
                    <?php 
                        $data = array('gubun_param' => $gubun_param, 'free_course_list_data' => $free_course_list_data);
                        $this->load->view('campground_list',$data); 
                    ?>
                    </div>
                    </div>
                <?php 
                } ?>
            <!--////  리스트 E //// -->                    
        </div>         
    </div>

</div>