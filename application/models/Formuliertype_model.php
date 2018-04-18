<?php
class FormulierType_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }

    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('formulierType');
        return $query->row();
    }
    
    function getAllTypes(){
        $query = $this->db->get('formulierType');
        return $query->result();
    }
}
?>