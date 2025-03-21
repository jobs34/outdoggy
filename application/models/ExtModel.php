<?php defined('BASEPATH') OR exit('No direct script access allowed');
class ExtModel extends CI_Model {
	
   public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function count_all($login_user_id = NULL) {
        $this->db->from($this->table);
        if($login_user_id)
        {
            $this->db->where('user_id',$login_user_id);   
        }
        return $this->db->count_all_results();
    }
    
    private function _get_datatables_query($login_user_id) 
    {
        $this->db->from($this->table);
        if($login_user_id)
        {
            $this->db->where('user_id',$login_user_id);   
        }
        $this->db->join('category', 'ext_course.category_id = category.id', 'left');
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
    
    function get_all_category() {
        return $this->db->where('category_is_delete',0)->where('category_status',1)->order_by('category_title','asc')->get('category')->result();
    }

    function get_ctp02_category() {
        return $this->db->where('category_is_delete',0)->where('gubun','ctp02')->order_by('order','asc')->get('category')->result();
    }    

    function get_category_cground($category_id)
    {
        return $this->db->select("ext_course.*, (select title from institutions where institutions.id = ext_course.instute_id) as theme_name")
        ->where('status',1)
        ->where('category_id',$category_id)    
        ->order_by("id", "desc")        
        ->get('ext_course')
        ->result();        
    }   

    function get_cground_all($category_gubun)
    {
        return $this->db->select("ext_course.*, category.category_title, category.order as category_order, (select title from institutions where institutions.id = ext_course.instute_id) as theme_name")
        ->join('category', 'category.id = ext_course.category_id')
        ->where('status',1)
        ->order_by("id", "desc")        
        ->get('ext_course')
        ->result();        
    }  


    function get_all_institution() {
        return $this->db->order_by('id','asc')->get('institutions')->result();
    }    

    function get_all_ext_course() 
    {
        return $this->db->where('status',1)->order_by('id','asc')->get('ext_course')->result();
    }

    function get_all_users() {
        return $this->db->where('deleted','0')->where('status','1')->order_by('first_name','asc')->get('users')->result();
    }

    function insert_ext_course($data)
    {
    	$this->db->insert('ext_course',$data);
    	return $this->db->insert_id();
    }

    var $table = 'ext_course';
    var $column_order = array(null, 'title', 'category_title', NULL);
    var $column_search = array('title', 'category_title');
    var $order = array('ext_course.id' => 'DESC');

    function get_ext_course($login_user_id = NULL) 
    {
        $this->_get_datatables_query($login_user_id);  
        if ($_POST['length'] != - 1) 
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->select('ext_course.*,category_title')
        ->order_by('ext_course.orders', 'asc')
        ->order_by('ext_course.id', 'desc')
        ->get();
        return $query->result();
        
    }
    
    function count_filtered($login_user_id = NULL) {
        $this->_get_datatables_query($login_user_id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_institution_by_id($institution_id)
    {
        return $this->db->where('id', $institution_id)     
        ->get('institutions')
        ->row();   
    }    
    
    function get_ext_course_by_id($ext_course_id)
    {
        return $this->db->where('id', $ext_course_id)     
        ->get('ext_course')
        ->row();   
    }
    function get_category_by_id($category_id)
    {
        return $this->db->where('id', $category_id)     
        ->get('category')
        ->row();   
    }

    function update_ext_course($ext_course_id, $data) 
	{
	    $this->db->set($data)->where('id', $ext_course_id)->update('ext_course');
    	$return = $this->db->affected_rows();
        return $return;
	}

    function delete_ext_course($ext_course_id,$login_user_id = NULL)
	{
		$this->db->where('id', $ext_course_id);
        if($login_user_id)
        {
           $this->db->where('user_id',$login_user_id); 
        }
        $this->db->delete('ext_course');
    	$return = $this->db->affected_rows();
        return $return;
	}

    function get_ext_course_content($ext_course_id) 
    {
        return $this->db->where('ext_course_id',$ext_course_id)
        ->order_by('material_order','asc')
        ->get('ext_course_content')
        ->result();
    }

    function insert_institution_courses($data) 
    {
        $this->db->insert('instute_courses', $data);
        return $this->db->insert_id();
    }

    function get_all_courses()
    {
        return $this->db->get('courses')->result();
    }    


    function get_all_courses_by_ids($courses_ids)
    {
        return $this->db->where_in('id',$courses_ids)->get('courses')->result();
    }

    function get_courses_by_ext_course_id($ext_course_id)
    {
        return $this->db->select("courses.title, instute_courses.id, instute_courses.course_id")
        ->join('courses', 'courses.id = instute_courses.course_id')
        ->where('instute_id',$ext_course_id)
        ->order_by("courses.id", "asc")        
        ->get('instute_courses')
        ->result(); 

    }

    function get_courses_by_institution_id($ext_course_id)
    {
        $result_array =  $this->db->where('instute_id',$ext_course_id)->get('instute_courses')->result_array();
        $ids_array = array();
        if($result_array)
        {
        	$ids_array = array_column($result_array,"course_id");
        }
        return $ids_array;
    }

    function get_institutions_by_courses_id($course_id)
    {
        $result_array =  $this->db->where('course_id',$course_id)->get('instute_courses')->result_array();
        $ids_array = array();
        if($result_array)
        {
            $ids_array = array_column($result_array,"instute_id");
        }
        return $ids_array;
    }


    function delete_courses_by_institution_id($ext_course_id)
    {
        return $this->db->where('instute_id',$ext_course_id)->delete('instute_courses');
    }    

    function get_related_cground($instute_id,$post_id)
    {
        return $this->db->select('id, title, image, (select category.category_title from category where category.id = ext_course.category_id) as category_title')
            ->where('instute_id',$instute_id)
            ->where('id !=', $post_id)
            ->where('status',1)
            ->limit(10)
            ->order_by('id', "desc")
            ->get('ext_course')
            ->result();
    }    

    }