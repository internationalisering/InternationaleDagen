<?php
/**
 * @class GebruikerType_model
 * Model-klasse voor alle gebruikertypes
 */
class GebruikerType_model extends CI_Model {
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
    }
    /**
     * Geeft terug het gebruikertype met id=$id uit de tabel gebruikerType
     * @param $id Het opgegeven id
     * @return Het opgevraagde gebruikerType
     */
    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('gebruikerType');
        return $query->row();
    }
    
    /**
     * @author Quinten Van Casteren
     * 
     * Geeft terug alle gebruikertypes uit de tabel gebruikerType
     * @return Alle gebruikertypes
     */
    function getAllTypes(){
        $query = $this->db->get('gebruikerType');
        return $query->result();
    }
}
?>