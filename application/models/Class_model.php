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
        $query = $this->db->get('klas');
        return $query->row();
    }
        
    function getAll()
    {
        return $this->db->get('klas')->result();
    }

    function search($text, $previousEditions, $columns){
        $this->db->from('klas');
        
        $first = true;
        
        foreach($columns as $column){
            if($first){
                $first = false;
                
                $this->db->like($column, $text);
            }else{
                $this->db->or_like($column, $text);
            }
        }
        
        $query = $this->db->get();
        return $query->result();
    }
}
?>