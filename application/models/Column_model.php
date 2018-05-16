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
    
    /**
     * Geeft een enkele rij terug van de tabel kolom waarbij $rowId=id van de rij
     * @param $rowId de id van de rij
     * @return Een rij van de kolom
     */
    function getByRowId($rowId)
    {
        $this->db->where('planningRijId', $rowId);
        return $this->db->get('planningKolom')->result();
    }
    /**
     * Verwijdert een kolom waarbij $id=id van de kolom
     * @param $id de id van een kolom
     * @return Verwijdert een kolom waarbij $id=id van de kolom
     */
    function deleteById($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('planningKolom');
    }
    /**
     * Voegt een kolom toe waarbij $column=id van de kolom
     * @param $column de id van een kolom
     * @return Voegt een kolom toe waarbij $column=id van de kolom
     */
    function insert($column)
    {
        $this->db->insert('planningKolom', $column);
        return $this->db->insert_id();

    }
}
?>