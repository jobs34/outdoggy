<?php defined('BASEPATH') OR exit('No direct script access allowed');
class AdvertismentModel extends CI_Model 
{
    var $table = 'advertisment';
    var $column_order = array(null, 'title', 'url', NULL,'position','status',NULL );
    var $column_search = array('title','position');
    var $order = array('id' => 'DESC');

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query() 
    {
        $this->db->from($this->table);
        $i = 0;
        foreach ($this->column_search as $item) {
            // if datatable send POST for search
            if ($_POST['search']['value']) 
            {
                // first loop
                if ($i === 0) 
                {
                    // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } 
                else 
                {
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

    function get_advertisment() 
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != - 1)
        {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->select($this->table.'.*')
        ->get();
        return $query->result();
    }

    function count_filtered() 
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    function count_all() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function insert_advertisment($data) 
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }


    function get_advertisment_by_id($advertisment_id)
    {
        return $this->db->where('id',$advertisment_id)->get($this->table)->row();
    }

    function get_adv_by_position($position)
    {
        return $this->db->where('position',$position)
               ->where('status',1)
               ->order_by('id','desc')
               ->limit(1)
               ->get('advertisment')->row();
    }

    function update_advertisment($advertisment_id, $data) 
    {
        $this->db->set($data)->where('id', $advertisment_id)->update($this->table);
        return $this->db->affected_rows();
    }

    function delete_advertisment($advertisment_id) 
    {
        $this->db->where('id', $advertisment_id)->delete($this->table);
        return $this->db->affected_rows();
    }

}
