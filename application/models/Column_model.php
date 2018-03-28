<?php
class Column_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }

    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('planningKolom');
        return $query->row();
    }
    
    function getByRowId($rowId)
    {
        $this->db->where('planningRijId', $rowId);
        return $this->db->get('planningKolom')->result();
        
    }
}
?>