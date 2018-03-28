<?php
class Presence_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }

    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('aanwezigheid');
        return $query->row();
    }

    function isIngeschreven($kolomId, $gebruikerId)
    {
    	$this->db->where('planningKolomId', $kolomId);
    	$this->db->where('gebruikerId', $gebruikerId);

    	$result = $this->db->get('aanwezigheid')->row();

    	return (isset($result) ? true : false);

    }
}
?>