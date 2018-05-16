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

    /**
     * Geeft een true terug als iemand zich ingeschreven heeft voor een sessie, een false voor niet ingeschreven personen
     * @param $columnId = id van de kolom
     * @param $userId = id van de gebruiker
     */
    function isEnrolled($columnId, $userId)
    {
    	$this->db->where('planningKolomId', $columnId);
    	$this->db->where('gebruikerId', $userId);

    	$result = $this->db->get('aanwezigheid')->row();
        
    	return (isset($result) ? true : false);
    }

    /**
     * Schrijft een student in bij een bepaalde sessie en gaat na of de gebruiker een surveillant is of niet. 
     * @param $columnId = id van de kolom
     * @param $userId = id van de gebruiker
     * @param $isSurveillant = gaat na of de gebruiker een surveillant is of niet
     */
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

    /**
     * Schrijft een gebruiker uit voor een sessie. 
     * @param $columnId = id van de kolom
     * @param $userId = id van de gebruiker
     */

    function withdraw($columnId, $userId)
    {
        $this->db->where('gebruikerId', $userId);
        $this->db->where('planningKolomId', $columnId);
        $this->db->delete('aanwezigheid');
    }

    /**
     * Haalt enkel het aantal studenten op 
     * @param $columnId = id van de kolom
     */

    function getColumnCount($columnId)
    {
        $this->db->where('planningKolomId', $columnId);
        $this->db->where('surveillant', 0);
        return $this->db->count_all_results('aanwezigheid');  
    }

    /**
     * Haalt de status op van een gebruiker en kijkt na of de gebruiker is ingeschreven
     * @param $columnId = id van de kolom
     * @param $userId = id van de gebruiker
     */
    
    function getEnrolledStatus($columnId, $userId)
    {
        $this->db->where('planningKolomId', $columnId);
        $this->db->where('gebruikerId', $userId);

        return $this->db->get('aanwezigheid')->row();
    }


    /**
     * Haalt het aantal studenten op die ingeschreven zijn voor een sessie
     * @param $columnId = id van de kolom
     */
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

    /**
     * Beheerder kan hier de desbetreffende kolom verwijderen waarbij $columnId = id van de kolom
     * @param $columnId = id van de kolom
     * 
     */

    function deleteByColumnId($columnId)
    {
        $this->db->where('planningKolomId', $columnId);

        $this->db->delete('aanwezigheid');
    }

    /**
     * Beheerder kan een aanwezigheid toevoegen 
     * @param $presence = aanwezigheid van een gebruiker
     */

    function insert($presence)
    {
        $this->db->insert('aanwezigheid', $presence);
        return $this->db->insert_id();
    }
}
?>