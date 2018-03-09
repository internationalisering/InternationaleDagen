<?php
class Mailtype_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }

    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('Mailtype');
        return $query->row();
    }
}
?>