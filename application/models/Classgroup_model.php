<?php
/**
 * @class Classgroup_model
 * Model-klasse voor alle classgroups (klassen gebonden aan sessiemomenten)
 */
class Classgroup_model extends CI_Model {
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
    }
    /**
     * Geeft terug de classgroup met id=$id uit de tabel classgroup
     * @param $id Het opgegeven id
     * @return De opgevraagde classgroup
     */
    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('Classgroup');
        return $query->row();
    }
}
?>