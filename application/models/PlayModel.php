<?php defined('BASEPATH') OR exit('No direct script access allowed');
class PlayModel extends CI_Model 
{
    function get_category_by_id($category_id)
    {
        return $this->db->where('id', $category_id)     
        ->get('category')
        ->row();   
    }

    function get_quiz_by_id($quiz_id) 
    {
        return $this->db->select('category_id,number_questions,title,is_premium')->where('deleted','0')->where('id',$quiz_id)->order_by('id','asc')->where('is_quiz_active',1)->get('quizes')->row();
    }

    function get_question_by_quiz_id($quiz_id,$number_questions) 
    {
        return $this->db->select('id,title,solution,image,solution_image,choices,correct_choice,addon_type,addon_value')
        ->where('deleted','0')->where('quiz_id',$quiz_id)->order_by('id','asc')->limit($number_questions)->get('questions')->result();
    }

    function get_question_by_question_id($quiz_id, $question_id) 
    {
        return $this->db->where('deleted','0')->where('quiz_id',$quiz_id)->where('id',$question_id)->order_by('id','asc')->get('questions')->row();
    }

    function save_quiz_view_data($data)
    {
        $this->db->insert('quiz_count',$data);
        return $this->db->insert_id();
    }

    
}
