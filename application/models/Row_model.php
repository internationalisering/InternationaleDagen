<?php
class Row_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }

    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('planningRij');
        return $query->row();
    }
    
    
    function getByEdition($edition)
    {
        $this->db->where('editieId', $edition->id);
        $this->db->order_by('starttijd', 'asc');
        $query = $this->db->get('planningRij');
        return $query->result();
        
    }
}
?>