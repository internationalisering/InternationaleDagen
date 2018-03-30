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

    function isEnrolled($columnId, $userId)
    {
    	$this->db->where('planningKolomId', $columnId);
    	$this->db->where('gebruikerId', $userId);

    	$result = $this->db->get('aanwezigheid')->row();
        


    	return (isset($result) ? true : false);
    }



    function enroll($columnId, $userId)
    {
        $data = array(
            'id'=>null,
            'gebruikerId'=>$userId,
            'planningKolomId'=>$columnId,
            'surveillant'=>0,
            'geselecteerd'=>0
            );

        $this->db->insert('aanwezigheid', $data);


        //$this->db
    }

    function withdraw($columnId, $userId)
    {
        $this->db->where('gebruikerId', $userId);
        $this->db->where('planningKolomId', $columnId);
        $this->db->delete('aanwezigheid');
    }

    function getColumnCount($columnId)
    {
        $this->db->where('planningKolomId', $columnId);
        return $this->db->count_all_results('aanwezigheid');  
    }
}
?>