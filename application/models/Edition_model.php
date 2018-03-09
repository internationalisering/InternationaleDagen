<?php
class Edition_model extends CI_Model {
    
    function __construct(){
        parent::__construct();
    }
    
    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('Edition');
        return $query->row();
    }
    
    function getCurrentEdition(){
        $this->db->where('startdate <= CURDATE()');
        $this->db->where('enddate >= CURDATE()');
        $query = $this->db->get('Edition');
        return $query->row();
    }
}
?>