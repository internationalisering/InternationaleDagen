<?php
class WishAnswer_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }

    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('WishAnswer');
        return $query->row();
    }
}
?>