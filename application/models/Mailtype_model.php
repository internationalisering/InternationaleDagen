<?php
class Mailtype_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }

    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('mailtype');
        return $query->row();
    }
    function getAllTemplates() {
        $query = $this->db->get('mailtype');
        $result = $query->result();
        return $result;
    }
    function insert($template){
        $this->db->insert('mailtype', $template);
        return 1;
    }
    
    function update($template){
        $this->db->where('id', $template->id);
        $this->db->update('mailtype', $template);
        return 1;
    }
    function remove($id){
        $this->db->where('id', $id);
        $this->db->delete('mailtype');
        return 1;
    }
}
?>