<?php
/**
 * @class WishAnswer_model
 * Model-klasse voor alle wishanswers (antwoorden op vragen)
 */
class WishAnswer_model extends CI_Model {
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
    }
    /**
     * Geeft terug het antwoord met id=$id uit de tabel WishAnswer
     * @param $id Het opgegeven id
     * @return Het opgevraagde Antwoord
     */
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
    
    function deleteAllAnswersByUser($userId){
        $a = new stdClass();
        $a->verwijderd = 1;
        $this->db->where('gebruikerId', $userId);
        $this->db->update('wensAntwoord', $a);
    }
    
    function insertAnswer($userId, $wensvraagId, $resultaat){
        $this->load->model('edition_model');
        
        $a = new stdClass();
        $a->gebruikerId = $userId;
        $a->wensVraagId = $wensvraagId;
        $a->resultaat = $resultaat;
        $a->editieId = $this->edition_model->getLastEdition()->id;
        
        $this->db->insert('wensAntwoord', $a);
    }
}
?>