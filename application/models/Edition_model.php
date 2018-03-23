<?php
class Edition_model extends CI_Model {
    
    function __construct(){
        parent::__construct();
    }
    
    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('editie');
        return $query->row();
    }
    
    function getLastEdition(){
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('editie');
        return $query->row();
    }
}
?>