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
    
    function getAnswersByUser($userid){
        $this->db->where('gebruikerId', $userid);
        $this->db->where('verwijderd', '0');
        $query = $this->db->get('wensAntwoord');
        return $query->result();
    }
}
?>