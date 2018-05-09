<?php
/**
 * @class Session_model
 * Model-klasse voor alle sessions (sessies)
 */
class Session_model extends CI_Model {
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
    }
    /**
     * Geeft terug de sessie met id=$id uit de tabel sessie
     * @param $id Het opgegeven id
     * @return De opgevraagde sessie
     */
    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('sessie');
        return $query->row();
    }
    
    /**
     * @author Quinten Van Casteren
     * 
     * Geeft terug de alle sessies van de gebruiker met gebruikerId=$id en editieId=getLastEdition() uit de tabel sessie.
     * Hierna voegt het een taal toe van de taal horende bij taalId.
     * 
     * @param $id Het opgegeven id van de gebruiker
     * @return De opgevraagde sessies
     * @see edition_model->getLastEdition
     * @see language_model->get
     */
    function getAllSessionsByUser($id) {
        $this->load->model("edition_model");
        $editie = $this->edition_model->getLastEdition();
        $this->load->model("language_model");
        $this->db->where('gebruikerId', $id);
        $this->db->where('editieId', $editie->id);
        $query = $this->db->get('sessie');
        $result = $query->result();
        
         foreach ($result as $r){
            $r->taal = $this->language_model->get($r->taalId);
        }
        
        return $result;
    }
    
    /**
     * @author Quinten Van Casteren
     * 
     * Voegt de sessie $sessie toe aan de tabel sessie.
     * @param $sessie De opgegeven sessie
     * @return Een True signaal
     */
    function insert($sessie){
        $this->db->insert('sessie', $sessie);
        return 1;
    }
    
    /**
     * @author Quinten Van Casteren
     * 
     * Verandert de sessie waar id=$sessie->id in de tabel sessie.
     * @param $sessie De opgegeven sessie
     * @return Een True signaal
     */
    function update($sessie){
        $this->db->where('id', $sessie->id);
        $this->db->update('sessie', $sessie);
        return 1;
    }
    
    function search($text, $previousEditions, $columns){
         if(!$previousEditions){
             $this->load->model("edition_model");
            $lastEdition = $this->edition_model->getLastEdition();
        }
        
        $this->db->from('sessie');
        if($text != '*')
        {
        $first = true;
        
        $this->db->group_start();
        
        foreach($columns as $column){
            if($first){
                $first = false;
                
                $this->db->like($column, $text);
            }else{
                $this->db->or_like($column, $text);
            }
        }
        
        $this->db->group_end();
        }
        if(isset($lastEdition)){
            $this->db->where('editieId', $lastEdition->id);
        }
        
        $query = $this->db->get();
        return $query->result();
    }
}
?>