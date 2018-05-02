<?php
/**
 * @class Column_model
 * Model-klasse voor alle columns (kolommen in de planning)
 */
class Column_model extends CI_Model {
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
    }
    /**
     * Geeft terug de column met id=$id uit de tabel column
     * @param $id Het opgegeven id
     * @return De opgevraagde column
     */
    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('planningKolom');
        return $query->row();
    }
    
    function getByRowId($rowId)
    {
        $this->db->where('planningRijId', $rowId);
        return $this->db->get('planningKolom')->result();
        
    }
}
?>