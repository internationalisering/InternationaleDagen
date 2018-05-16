<?php
/**
 * @class FormulierType_model
 * Model-klasse voor alle formuliertypes
 */
class FormulierType_model extends CI_Model {
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
    }
    /**
     * Geeft terug het formuliertype met id=$id uit de tabel formulierType
     * @param $id Het opgegeven id
     * @return Het opgevraagde formuliertype
     */
    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('formulierType');
        return $query->row();
    }
    
    /**
     * Geeft alle types van formulieren terug
     * @author Brend Simons
     */
    function getAllTypes(){
        $query = $this->db->get('formulierType');
        return $query->result();
    }
}
?>