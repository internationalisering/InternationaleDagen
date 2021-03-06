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
        $query = $this->db->get('klasgroep');
        return $query->row();
    }
    
    /**
     * Verwijderd alle klasgroepen bij een kolom id.
     * 
     * @param $columnId Het id van de te verwijderen kolom
     */
    function deleteByColumnId($columnId)
    {
        $this->db->where('planningKolomId', $columnId);
        $this->db->delete('klasgroep');
    }
    
    /**
     * Geeft alle klasgroepen met een bepaalde kolom id.
     * 
     * @param $columnId Het id van de te zoeken kolom
     * @return De opgevraagde kolommen
     */
    function getByColumnId($columnId){
       $this->db->where('planningKolomId', $columnId);
       return $this->db->get('klasgroep')->result();
    }
    
    /**
     * Voegt een klasgroep toe aan de database.
     * 
     * @param $$classgroup De toe te voegen klasgroep.
     * @return Het id van de toegevoegde klasgroep.
     */
    function insert($classgroup){
        $this->db->insert('klasgroep', $classgroup);
        return $this->db->insert_id();
    }
}
?>