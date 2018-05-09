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


}
?>