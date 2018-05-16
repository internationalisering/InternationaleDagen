<?php
/**
 * @class Row_model
 * Model-klasse voor alle rows (rijen in de planning)
 */
class Row_model extends CI_Model {
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
    }
    /**
     * Geeft terug de rij met id=$id uit de tabel planningRij
     * @param $id Het opgegeven id
     * @return De opgevraagde rij
     */
    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('planningRij');
        return $query->row();
    }
    
    /**
     * Haalt de rijen bij een bepaalde editie.
     * 
     * @param $edition De editie
     * @return De rijen
     */
    function getByEdition($edition)
    {
        $this->db->where('editieId', $edition->id);
        $this->db->order_by('starttijd', 'asc');
        $query = $this->db->get('planningRij');
        return $query->result();
    }
    
    /**
     * Haalt de rijen bij een bepaalde editie en datum.
     * 
     * @param $edition De editie
     * @param $date De datum
     * @return De rijen
     */
    function getByDate($edition, $date)
    {
        $this->db->where('date(starttijd)', $date);
        $this->db->where('editieId', $edition->id);
        return $this->db->get('planningRij')->result();
    }
    
    /**
     * Delete een rij door middel van een id
     * 
     * @param $id Id van de rij
     */
    function deleteById($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('planningRij');
    }
    
    /**
     * Voeg een nieuwe rij toe
     * 
     * @param $row Object met alle parameters
     * @return Id van de toegevoegde rij
     */
    function insert($row)
    {
        $this->db->insert('planningRij', $row);
        return $this->db->insert_id();
    }
}
?>