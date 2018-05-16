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
    
    /**
     * @author Quinten Van Casteren
     * 
     * Voegt het gebruikertype $template toe aan de tabel mailtype.
     * @param $template Het opgegeven gebruikertype
     * @return Een True signaal
     */
    function insert($template){
        $this->db->insert('gebruikerType', $template);
        return 1;
    }
    
    /**
     * @author Quinten Van Casteren
     * 
     * Verandert het gebruikertype waar id=$template->id in de tabel gebruikerType.
     * @param $template Het opgegeven gebruikertype
     * @return Een True signaal
     */
    function update($template){
        $this->db->where('id', $template->id);
        $this->db->update('gebruikerType', $template);
        return 1;
    }
    
    
    function search($text, $previousEditions, $columns){
        $this->db->from('gebruikerType');
        
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