<?php
/**
 * @class WishAnswerList_model
 * Model-klasse voor alle wishanswerlists (mogelijke antwoorden op vragen)
 */
class Wishanswerlist_model extends CI_Model {
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
    }
    
    /**
     * Geeft terug het antwoord met id=$id uit de tabel wensAntwoordLijst
     * @param $id Het opgegeven id
     * @return Het opgevraagde antwoord
     */
    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('wensAntwoordLijst');
        return $query->row();
    }
    
    /**
     * Haal alle antwoorden op die bij een bepaalde vraag horen.
     * 
     * @param $questionId Id van de vraag.
     */
    function getAllAnswersByQuestion($questionId){
        $this->db->where('wensVraagId', $questionId);
        $query = $this->db->get('wensAntwoordLijst');
        return $query->result();
    }
    
    /**
     * Haal alle niet verwijderde antwoorden op die bij een bepaalde vraag horen.
     * 
     * @param $questionId Id van de vraag.
     */
    function getAnswersByQuestion($questionId){
        $this->db->where('wensVraagId', $questionId);
        $this->db->where('verwijderd', '0');
        $query = $this->db->get('wensAntwoordLijst');
        return $query->result();
    }
    
    /**
     * Voeg een nieuw antwoord toe aan de database.
     * 
     * @param $a Object met alle parameters.
     */
    function insertAnswer($a){
        $this->db->insert('wensAntwoordLijst', $a);
        return $this->db->insert_id();
    }
    
    /**
     * Verwijder alle antwoorden die bij een bepaalde vraag horen.
     * 
     * @param $questionId Id van de vraag.
     */
    function deleteAllAnswersByQuestion($questionId){
        $a = new stdClass();
        $a->verwijderd = 1;
        $this->db->where('wensVraagId', $questionId);
        $this->db->update('wensAntwoordLijst', $a);
    }
}
?>