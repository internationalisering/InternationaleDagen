<?php
class Session_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }

    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('sessie');
        return $query->row();
    }
    
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
}
?>