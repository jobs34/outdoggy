<!-- Page header -->
<div class="pt-6 pb-6">
    <div class="container px-3">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12 col-12">
                <div class="text-center mb-1">
                    <p class="text-black lead display-4">콘텐츠</p>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-2">
                    <ul class="nav"> 
                    <?php if($category_slug == 'all' OR $category_slug =='ALL')
                    {
                    ?>
                        <li class="nav-item pr-3"> <div class="badge badge-pill badge-dark py-2 px-3"><span class="lead font-size-md font-weight-semi-bold">전체</span></div> </li> 
                    <?php 
                    }
                    else{
                    ?>
                        <li class="nav-item pr-3"> <div class="badge badge-pill badge-light py-2 px-3"><a class="text-dark-gray" href="<?php echo base_url('blog/list/all');?>"><span class="lead font-size-md font-weight-semi-bold">전체</span></a></div></li> 
                    <?php
                    }
                    ?>
                    <?php 
                    if($blog_category)
                    {
                        foreach($blog_category as $blog_category_key => $blog_category_value)
                        { 
                        ?>
                        <?php
                            if($category_slug == $blog_category_value->slug){
                            ?>
                                <li class="nav-item pr-3"><div class="badge badge-pill badge-dark py-2 px-3"><span class="lead font-size-md font-weight-semi-bold"><?php echo $blog_category_value->title;?></span></div></li> 
                            <?php
                             }
                             else{
                            ?>
                                <li class="nav-item pr-3"> <div class="badge badge-pill badge-light py-2 px-3"><a class="text-dark-gray" href="<?php echo base_url('blog/list/'.$blog_category_value->slug);?>"><span class="lead font-size-md font-weight-semi-bold"><?php echo $blog_category_value->title;?></span></a></div></li> 
                            <?php
                             }
                        }
                    } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Page Content -->
<div class="pb-12">
<div class="container min-h-100vh">
<div class="row px-1">
<?php
$data['blog_list_data'] = $blog_post_data;
$this->load->view('common_blog_list',$data);
?>
<!-- 페이징 -->
<div class="col-xl-12 col-lg-12 col-md-12 col-12 text-center mt-6">
<?php echo xss_clean($pagination) ?>
</div>
</div>
</div>
</div>
