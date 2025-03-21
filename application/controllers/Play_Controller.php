<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Play_Controller extends Open_Controller {

    /**
     * Constructor
     */
    function __construct() 
    {
        parent::__construct(); 
        $this->load->model('PlayModel');
        $this->load->library('session');
        $this->add_js_theme('autogrow.js');
        $this->add_js_theme('test.js');
        $this->add_js_theme('jquery.simple.timer.js');
        $this->add_js_theme('dojo.js');
        $this->add_js_theme('notify.min.js');
        $this->add_css_theme('sweetalert.css');
        $this->add_js_theme('sweetalert-dev.js'); 
        $this->load->library('form_validation'); 
        $this->load->library('session');
        $this->add_js_theme('perfect-scrollbar.min.js');
        $this->add_css_theme('table-main.css');
        $this->add_css_theme('perfect-scrollbar.css');       
    }

    function play($quiz_id) 
    {
        $quiz_data = $this->PlayModel->get_quiz_by_id($quiz_id);
        $category_id = $quiz_data->category_id;
        $bogy_type = $quiz_data->is_premium;
        if($bogy_type==1){
            $bogi_count = 5;
          }
          else{
            $bogi_count = 4;
          }
        $quiz_data = json_decode(json_encode($quiz_data), true);
        $total_question = $quiz_data['number_questions'];
        $title = $quiz_data['title'];

        $quiz_question_data = $this->PlayModel->get_question_by_quiz_id($quiz_id,$total_question);
        $quiz_question_data = json_decode(json_encode($quiz_question_data), true);
        $temp_quiz_question_data = array();
        $question_no = 1;
        foreach ($quiz_question_data as $key => $quiz_question_val_array) 
        {
            $new_quiz_question_data = array();
            $new_quiz_question_data['id'] = $quiz_question_val_array['id'];
            $new_quiz_question_data['question_no'] = $question_no;
            $new_quiz_question_data['title'] = $quiz_question_val_array['title'];
            $new_quiz_question_data['solution'] = $quiz_question_val_array['solution'];
            $new_quiz_question_data['image'] = $quiz_question_val_array['image'];
            $new_quiz_question_data['choices'] = $quiz_question_val_array['choices'];
            $new_quiz_question_data['correct_choice'] = $quiz_question_val_array['correct_choice'];
            $new_quiz_question_data['addon_type'] = $quiz_question_val_array['addon_type'];
            $new_quiz_question_data['addon_value'] = $quiz_question_val_array['addon_value'];
            $temp_quiz_question_data[] = $new_quiz_question_data;
            $question_no = $question_no + 1;
        }
        $quiz_question_data = $temp_quiz_question_data;

        $category_data = $this->PlayModel->get_category_by_id($category_id); 
        $page_title = $category_data->category_title." 기출문제 - ". $title;
    	$this->set_title($page_title);

        $content_data = array('page_title' => $page_title, 'quiz_id' => $quiz_id, 'bogi_count' => $bogi_count, 'play_total_question' => $total_question,'play_title' => $title, 'play_quiz_question_data' =>$quiz_question_data);

        $data = $this->includes;
        $data['content'] = $this->load->view('play', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

    function practice($quiz_id) 
    {
        $quiz_data = $this->PlayModel->get_quiz_by_id($quiz_id);
        $category_id = $quiz_data->category_id;
        $quiz_data = json_decode(json_encode($quiz_data), true);
        $total_question = $quiz_data['number_questions'];
        $title = $quiz_data['title'];

        $quiz_question_data = $this->PlayModel->get_question_by_quiz_id($quiz_id,$total_question);
        $quiz_question_data = json_decode(json_encode($quiz_question_data), true);
        $temp_quiz_question_data = array();
        $question_no = 1;
        foreach ($quiz_question_data as $key => $quiz_question_val_array) 
        {
            $new_quiz_question_data = array();
            $new_quiz_question_data['id'] = $quiz_question_val_array['id'];
            $new_quiz_question_data['question_no'] = $question_no;
            $new_quiz_question_data['title'] = $quiz_question_val_array['title'];
            $new_quiz_question_data['solution'] = $quiz_question_val_array['solution'];
            $new_quiz_question_data['image'] = $quiz_question_val_array['image'];
            $new_quiz_question_data['solution_image'] = $quiz_question_val_array['solution_image'];
            $new_quiz_question_data['addon_type'] = $quiz_question_val_array['addon_type'];
            $new_quiz_question_data['addon_value'] = $quiz_question_val_array['addon_value'];
            $temp_quiz_question_data[] = $new_quiz_question_data;
            $question_no = $question_no + 1;
        }
        $quiz_question_data = $temp_quiz_question_data;

        $category_data = $this->PlayModel->get_category_by_id($category_id); 
        $page_title = $category_data->category_title." 기출문제 - ". $title;
    	$this->set_title($page_title);

        $content_data = array('page_title' => $page_title, 'quiz_id' => $quiz_id, 'category_id' => $category_id, 'play_total_question' => $total_question, 'play_title' => $title, 'play_quiz_question_data' =>$quiz_question_data);

        $data = $this->includes;
        $data['content'] = $this->load->view('practice', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

}
