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
    
    function getAllAnswersByQuestion($questionId){
        $this->db->where('wensVraagId', $questionId);
        $query = $this->db->get('wensAntwoordLijst');
        return $query->result();
    }
    
    function getAnswersByQuestion($questionId){
        $this->db->where('wensVraagId', $questionId);
        $this->db->where('verwijderd', '0');
        $query = $this->db->get('wensAntwoordLijst');
        return $query->result();
    }
    
    function insertAnswer($a){
        $this->db->insert('wensAntwoordLijst', $a);
        return $this->db->insert_id();
    }
    
    function deleteAllAnswersByQuestion($questionId){
        $a = new stdClass();
        $a->verwijderd = 1;
        $this->db->where('wensVraagId', $questionId);
        $this->db->update('wensAntwoordLijst', $a);
    }
}
?>