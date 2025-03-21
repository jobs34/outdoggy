<?php defined('BASEPATH') OR exit('No direct script access allowed');
class ReportModel extends CI_Model 
{
	var $table = 'participants';
    var $column_order = array(NULL, 'first_name','email', 'questions', 'total_attemp', 'correct' , 'wrong', 'started', NULL);
    var $column_search = array('first_name', 'started','questions');
    var $order = array('participants.id' => 'DESC');

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query() {
        $this->db->select('participants.*,quizes.id as quiz_id, duration_min,first_name,last_name,users.email as user_email, (total_attemp - correct) as wrong');
        $this->db->from($this->table);
        $this->db->join('users', 'users.id = participants.user_id', 'left');
        $this->db->join("quizes", "quizes.id = participants.quiz_id", "left");
        // $this->db->where('is_quiz_active',1);

        $logged_in_user = $this->session->userdata('logged_in');
        if($logged_in_user['role'] == "tutor")
        {
            $this->db->where('participants.user_id', $logged_in_user['id']);
        }
        
        $i = 0;
        foreach ($this->column_search as $item) {
            // if datatable send POST for search
            if ($_POST['search']['value']) {
                // first loop
                if ($i === 0) {
                    // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                // last loop
                if (count($this->column_search) - 1 == $i) {    
                    // close bracket
                    $this->db->group_end();
                }
            }
            $i++;
        }
        // here order processing
        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order) ]);
        }
    }

    function count_filtered($quiz_id) {
        $this->_get_datatables_query();
        $query = $this->db->where('quiz_id',$quiz_id)->get();
        return $query->num_rows();
    }
    
    function count_all($quiz_id) {
        $this->db->from($this->table)->where('quiz_id',$quiz_id);
        $logged_in_user = $this->session->userdata('logged_in');
        if($logged_in_user['role'] == "tutor")
        {
            $this->db->where('participants.user_id', $logged_in_user['id']);
        }
        return $this->db->count_all_results();
    }


    function get_quiz_history($quiz_id) { 
        $this->_get_datatables_query();
        if ($_POST['length'] != - 1) 
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->where('participants.quiz_id',$quiz_id)
        ->order_by('participants.id', 'desc')
        ->get();
        return $query->result();
    }

    function get_participant_by_id($participant_id) 
	{
	    return $this->db->where('id',$participant_id)->get('participants')->row_array();
	}
	function get_user_question_by_participant_id($participant_id)
	{
        return $this->db->select('user_questions.*,(select solution from questions where questions.id = user_questions.question_id) as solution, (select solution_image from questions where questions.id = user_questions.question_id) as solution_image')->where('participant_id',$participant_id)->order_by('question_id','asc')->get('user_questions')->result_array();
	    
	}

	function get_quiz_by_id($quiz_id) 
    {
        return $this->db->where('deleted','0')->where('id',$quiz_id)->where('is_quiz_active',1)->order_by('id','asc')->get('quizes')->row();
    }

    function get_quiz_id_by_participant_id($participant_id)
    {
        return $this->db->select('user_id,quiz_id')->where('id',$participant_id)->get('participants')->row();
    }

    function delete_quiz_result($participant_id,$quiz_id) 
    {
        
        $this->db->where('quiz_id', $quiz_id)->where('id',$participant_id)->delete('participants');
        return $this->db->affected_rows();
    }

    function delete_quiz_from_user_question($participant_id) 
    {
        
        $this->db->where_in('participant_id',$participant_id)->delete('user_questions');
        return $this->db->affected_rows();
    }
}