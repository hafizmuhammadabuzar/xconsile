<?php

class Home_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function getRecord($table, $data) {
        $query = $this->db->get_where($table, $data);
        return $query->row();
    }
    
    function getAllRecords($table, $select=null, $where=null, $order=null, $group=null) {
        if(!empty($select)){
            $this->db->select($select);
        }
        if(is_array($where)){
            foreach ($where as $key => $field) {
                $this->db->where($key, $field);
            }
        }
        if(!empty($order)){
            $this->db->order_by($order);
        }
        if(!empty($group)){
            $this->db->group_by($group);
        }
        $query = $this->db->get($table);
        return $query->result_array();
    }

    function saveRecord($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    function updateRecord($table, $where_fields, $data) {
        foreach ($where_fields as $key => $field) {
            $this->db->where($key, $field);
        }
        $this->db->update($table, $data);
        return $this->db->affected_rows();
    }

    function deleteRecord($table, $where_fields) {
        foreach ($where_fields as $key => $field) {
            $this->db->where($key, $field);
        }
        $this->db->delete($table);
        return $this->db->affected_rows();
    }
    
    function getReceiptGraph(){
        
        $this->db->query('select * from receipts ');
    }
      
}
