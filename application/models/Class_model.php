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

    /**
     * @author Quinten Van Casteren
     * 
     * Voegt de klas $template toe aan de tabel klas.
     * @param $template De opgegeven klas
     * @return Een True signaal
     */
    function insert($template){
        $this->db->insert('klas', $template);
        return 1;
    }
    
    /**
     * @author Quinten Van Casteren
     * 
     * Verandert de klas waar id=$template->id in de tabel klas.
     * @param $template De opgegeven klas
     * @return Een True signaal
     */
    function update($template){
        $this->db->where('id', $template->id);
        $this->db->update('klas', $template);
        return 1;
    }
    
    /**
     * @author Quinten Van Casteren
     * 
     * Verwijdert de klas waar id=$id in de tabel klas.
     * @param $id Het id van de te verwijderen klas.
     * @return Een True signaal
     */
    function remove($id){
        $this->db->where('id', $id);
        $this->db->delete('klas');
        return 1;
    }
    

    /**
     * Zoekt naar desbetreffende klasse in de tabel
     * @param $text is de zoekterm
     * @param $previousEditions kan men aanvinken om te zoeken in vorige edities
     * @param $columns zoekt naar de kolommen van de tabel kolom
     * @return Verschillende zoekresultaten
     */
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