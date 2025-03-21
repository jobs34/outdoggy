<?php 
foreach($sub_category_data as  $study_array)
{
    $s_m_id = $study_array->id;
    //-- 지금 보는 카테고리는 제외하기
    if ($s_m_id!=$category_data->id){
        $study_title = $study_array->category_title;
        $view_real_url = base_url('category/').$s_m_id;
        $course_image = (isset($study_array->category_image) && !empty($study_array->category_image) ? base_url('assets/images/category_image/'.$study_array->category_image) : base_url('assets/images/category_image/default.jpg'));
        $category_gubun_side = "";
        if($study_array->gubun =="KE"){
            $category_gubun_side = "국가전문자격";
        }
        else if($study_array->gubun =="KT"){
            $category_gubun_side = "국가기술자격";
        }
        else if($study_array->gubun =="CZ"){
            $category_gubun_side = "공인민간자격";
        }   
        ?>
        <div class="d-flex align-items-center mb-4">
            <div class="col-auto mr-2">
                <a href="<?php echo xss_clean($view_real_url); ?>"><img src="<?php echo xss_clean($course_image);?>" class="icon-shape icon-sm">
                </a>
            </div>  
            <div class="col">
                <a href="<?php echo xss_clean($view_real_url); ?>">
                <div class="py-0">
                    <span class="mb-0 text-black font-weight-bold"><?php echo $study_title; ?></span><span class="pl-1 text-medium-gray font-size-xs"> <?php echo $category_gubun_side; ?></span>
                </div>
                </a>
            </div>
        </div>
<?php 
    }
} 
?>