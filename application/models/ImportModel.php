<?php defined('BASEPATH') OR exit('No direct script access allowed');
class ImportModel extends CI_Model 
{

    function insert_question($data) 
    {
        $this->db->insert('questions', $data);
        return $this->db->insert_id();
    }

    function insert_bulk_question($data)
    {
        return $this->db->insert_batch('questions', $data);
    } 

    function get_all_quiz() {
        // ->where('is_quiz_active',1)
        return $this->db->where('deleted',0)->order_by('title','asc')->get('quizes')->result();
    }   

    function get_all_study_material_name() {
        return $this->db->where('status',1)->order_by('title','asc')->get('study_material')->result();
    }

    function get_all_ext_course() {
        return $this->db->where('status',1)->order_by('title','asc')->get('ext_course')->result();
    }

    function insert_bulk_ext_course_lesson($data)
    {
        return $this->db->insert_batch('ext_course_content', $data);
    } 

    function delete_question_by_quiz_id($quiz_id)
    {
        $this->db->where('quiz_id',$quiz_id);
        $this->db->delete('questions');
        return $this->db->affected_rows();
    }

}
