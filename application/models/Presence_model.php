<?php
/**
 * @class Presence_model
 * Model-klasse voor alle presences (aanwezigheden)
 */
class Presence_model extends CI_Model {
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
    }
    /**
     * Geeft terug de aanwezigheid met id=$id uit de tabel aanwezigheid
     * @param $id Het opgegeven id
     * @return De opgevraagde aanwezigheid
     */
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



    function enroll($columnId, $userId, $isSurveillant=false)
    {
        $data = array(
            'id'=>null,
            'gebruikerId'=>$userId,
            'planningKolomId'=>$columnId,
            'surveillant'=>$isSurveillant,
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

    function getEnrolledStudents($columnId)
    {
        
        $this->db->where('planningKolomId', $columnId);
        $list = array();

        foreach($this->db->get('aanwezigheid')->result() as $aanwezigheid)
        {
            $list[] = (int)$aanwezigheid->gebruikerId;
        }
        return $list;
    }
}
?>