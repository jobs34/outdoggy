<?php defined('BASEPATH') OR exit('No direct script access allowed');
class AdProductModel extends CI_Model {
	
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
        $this->db->join('category', 'ad_product.category_id = category.id', 'left');
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

    function get_ctp01_category() {
        return $this->db->where('category_is_delete',0)->where('gubun','ctp01')->order_by('order','asc')->get('category')->result();
    }        

    function insert_ad_product($data)
    {
    	$this->db->insert('ad_product',$data);
    	return $this->db->insert_id();
    }

    var $table = 'ad_product';
    var $column_order = array(null, 'title', 'category_title', NULL);
    var $column_search = array('title', 'category_title');
    var $order = array('ad_product.id' => 'DESC');

    function get_ad_product($login_user_id = NULL) 
    {
        $this->_get_datatables_query($login_user_id);  
        if ($_POST['length'] != - 1) 
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->select('ad_product.*,category_title')
        ->order_by('ad_product.id', 'desc')
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

    function get_all_institution() {
        return $this->db->order_by('id','asc')->get('institutions')->result();
    }    

    function get_ad_product_by_id($ad_product_id, $login_user_id = NULL)
    {
        $this->_get_datatables_query($login_user_id);  
        $query = $this->db->select('ad_product.*,category_title')->where('ad_product.id',$ad_product_id)->get();
        return $query->row();
    }

    function update_ad_product($ad_product_id, $data) 
	{
	    $this->db->set($data)->where('id', $ad_product_id)->update('ad_product');
	    return $this->db->affected_rows();
	}

	function delete_ad_product($ad_product_id,$login_user_id = NULL)
	{
		$this->db->where('id', $ad_product_id);
        $this->db->delete('ad_product');
    	$return = $this->db->affected_rows();
        return $return;
	}

    function get_inst_product($instute_id)
    {
        return $this->db->select("*")
        ->where('status',1)
        ->where('inst_id',$instute_id)    
        ->order_by("id", "desc")        
        ->get('ad_product')
        ->result();        
    }  

    function get_category_product($rel_study)
    {
        return $this->db->select("*")
        ->where('status',1)
        ->where('category_id',$rel_study)    
        ->order_by("id", "desc")        
        ->get('ad_product')
        ->result();        
    } 


    }