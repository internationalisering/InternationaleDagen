<?php
/**
 * @class Class_model
 * Model-klasse voor alle classes (klassen)
 */
class Class_model extends CI_Model {
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
    }
    /**
     * Geeft terug de klas met id=$id uit de tabel class
     * @param $id Het opgegeven id
     * @return De opgevraagde klas
     */
    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('Class');
        return $query->row();
    }
}
?>