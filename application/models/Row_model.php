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
}
?>