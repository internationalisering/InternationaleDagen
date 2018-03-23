<?php
class Row_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }

    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('rij');
        return $query->row();
    }
    
    
    function getByEdition($edition)
    {
        $this->db->where('editieId', $edition->id);
        $query = $this->db->get('rij');
        return $query->result();
        
    }
}
?>