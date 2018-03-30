<?php
class Wishanswerlist_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }

    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('wensAntwoordLijst');
        return $query->row();
    }
    
    function getAnswersByQuestion($answerId){
        $this->db->where('wensVraagId', $answerId);
        $query = $this->db->get('wensAntwoordLijst');
        return $query->result();
    }
}
?>