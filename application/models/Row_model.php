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
    
    
    function getByEdition($edition)
    {
        $this->db->where('editieId', $edition->id);
        $this->db->order_by('starttijd', 'asc');
        $query = $this->db->get('planningRij');
        return $query->result();
    }


    function getByDate($edition, $date)
    {
        $this->db->where('date(starttijd)', $date);
        $this->db->where('editieId', $edition->id);
        return $this->db->get('planningRij')->result();
    }

    function deleteById($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('planningRij');
    }

    function insert($row)
    {
        $this->db->insert('planningRij', $row);
        return $this->db->insert_id();
    }
}
?>