<?php
/**
 * @class Language_model
 * Model-klasse voor alle languages (talen)
 */
class Language_model extends CI_Model {
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
    }
    /**
     * Geeft terug de taal met id=$id uit de tabel taal
     * @param $id Het opgegeven id
     * @return De opgevraagde taal
     */
    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('taal');
        return $query->row();
    }
    
    /**
     * @author Quinten Van Casteren
     * 
     * Geeft alle talen terug uit de tabel taal
     * @return Alle talen
     */
    function getAll(){
        $query = $this->db->get('taal');
        $result = $query->result();
        return $result;
    }
    
    /**
     * @author Quinten Van Casteren
     * 
     * Voegt de taal $template toe aan de tabel taal.
     * @param $template De opgegeven taal
     * @return Een True signaal
     */
    function insert($template){
        $this->db->insert('taal', $template);
        return 1;
    }
    
    /**
     * @author Quinten Van Casteren
     * 
     * Verandert de taal waar id=$template->id in de tabel taal.
     * @param $template De opgegeven taal
     * @return Een True signaal
     */
    function update($template){
        $this->db->where('id', $template->id);
        $this->db->update('taal', $template);
        return 1;
    }
    
    /**
     * @author Quinten Van Casteren
     * 
     * Verwijdert de taal waar id=$id in de tabel taal.
     * @param $id Het id van de te verwijderen taal.
     * @return Een True signaal
     */
    function remove($id){
        $this->db->where('id', $id);
        $this->db->delete('taal');
        return 1;
    }
    
    function search($text, $previousEditions, $columns){
        $this->db->from('taal');
        
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