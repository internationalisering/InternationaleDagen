<?php
/**
 * @class Edition_model
 * Model-klasse voor alle editions (edities)
 */
class Edition_model extends CI_Model {
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
    }
    
    /**
     * Geeft terug de editie met id=$id uit de tabel editie
     * @param $id Het opgegeven id
     * @return De opgevraagde editie
     */

    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('editie');
        return $query->row();
    }
    
    function getLastEdition(){
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('editie');
        return $query->row();
    }

    function getAllEditions(){
        $this->db->select('*');
        $this->db->from('editie');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();

    }

    function wijzigPagina($id, $inhoud){

        $array = array ('homepagina' => $inhoud);

        $this->db->set($array);
        $this->db->where('id', $id);
        $this->db->update('editie');
    }

    function insert($edition) {
        $this->db->insert('editie', $edition);
        return 1;
    }
    
    function search($text, $previousEditions, $columns){
        $this->db->from('editie');
        
        $first = true;
        
        foreach($columns as $column){
            if($first){
                $first = false;
                
                $this->db->like($column, $text);
            }else{
                $this->db->or_like($column, $text);
            }
        }
        
        if(!$previousEditions){
            $this->db->order_by('id', 'DESC');
            $this->db->limit(1);
        }
        
        $query = $this->db->get();
        return $query->result();
    }

    function setPlanned($editionId, $bool)
    {
        $bool = (int) $bool;

        $edition = new stdClass();
        $edition->gepland = $bool;


        $this->db->where('id', $editionId);

        $this->db->update('editie', $edition);
    }
}
?>