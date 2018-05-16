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

    /**
     * Geeft de laatste editie weer uit de tabel editie
     * @return De opgevraagde editie
     */
    
    function getLastEdition(){
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('editie');
        return $query->row();
    }

    /**
     * Geeft alle edities terug
     * @return Alle edities
     */

    function getAllEditions(){
        $this->db->select('*');
        $this->db->from('editie');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Wijzigt de pagina-inhoud waarbij id=$id en inhoud van de pagina=$inhoud uit te tabel editie
     * @author Vincent Duchateau
     * @return Een gewijzigde pagina 
     */

    function wijzigPagina($id, $inhoud){

        $array = array ('homepagina' => $inhoud);

        $this->db->set($array);
        $this->db->where('id', $id);
        $this->db->update('editie');
    }

    /**
     * Voegt een nieuwe editie toe aan de tabel editie
     * @author Vincent Duchateau
     * @return Een nieuwe editie
     */

    function insert($edition) {
        $this->db->insert('editie', $edition);
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

    /**
     * Slaat de planning definitief op voor de huidge editie 
     * @author Tom Van Den Rul
     * @param $bool geeft een int 1 of 0 terug 
     * @param $editionId = id van de huidige editions
     * 
     */

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