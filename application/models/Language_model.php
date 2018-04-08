<?php
/**
 * @class Language_model
 * Model-klasse voor alle languages (talen)
 */
class Language_model extends CI_Model {
    
     /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
    }
    /**
     * @author Brend Simons
     * 
     * Geeft terug de taal met id=$id uit de tabel taal
     * @param $id Het opgegeven id
     * @return De opgevraagde taal
     */
    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('taal');
        return $query->row();
    }
    
    /**
     * @author Quinten Van Casteren
     * 
     * Geeft alle talen terug uit de tabel taal
     * @return Alle talen
     */
    function getAll(){
        $query = $this->db->get('taal');
        $result = $query->result();
        return $result;
    }
}
?>