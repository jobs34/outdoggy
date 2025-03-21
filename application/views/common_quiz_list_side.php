<?php 
   foreach($quiz_list_data as  $quiz_array)
   {
    $quiz_title = $quiz_array->title;
    $quiz_array_id = $quiz_array->id;
    $quiz_slug_url = base_url('quiz/').$quiz_array_id;
    ?>
    <div class="align-items-center pl-1 mb-3">
        <div class="font-size-sm">
            <a href="<?php echo $quiz_slug_url; ?>" class="text-dark-gray"><i class="far fa-list-alt mr-2"></i><?php echo xss_clean($quiz_title); ?></a>
        </div>
    </div>     
    <?php     
} ?>      