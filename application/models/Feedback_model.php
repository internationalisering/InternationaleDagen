<?php
/**
 * @class Feedback_model
 * Model-klasse voor alle feedback
 */
class Feedback_model extends CI_Model {
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
    }
    /**
     * Geeft terug de feedback met id=$id uit de tabel feedback
     * @author Tom Van Den Rul
     * @param $id Het opgegeven id
     * @return De opgevraagde feedback
     */
    function get($sessieId, $gebruikerId)
    {
    	$this->db->where('sessieId', $sessieId);
    	$this->db->where('gebruikerId', $gebruikerId);
    	return $this->db->get('feedback')->row();
    }

    /**
     * Gaat na of feedback al gegeven is of niet 
     * @author Tom Van Den Rul
     * @param $sessieId = id van de sessie
     * @param $gebruikerId = id van de gebruiker
     */

    function exists($sessieId, $gebruikerId)
    {
    	$this->db->where('sessieId', $sessieId);
    	$this->db->where('gebruikerId', $gebruikerId);
    	
    	return $this->db->get('feedback')->row();
    }

    /**
     * Maakt nieuwe feedback aan 
     * @author Tom Van Den Rul
     * @param $sessieId = id van de huidige sessie 
     * @param $gebruikerId= id van de gebruiker
     * @param $feedback = feedback die gegeven wordt
     */

    function set($sessieId, $gebruikerId, $feedback)
    {
    	
    	if($this->feedback_model->exists($sessieId, $gebruikerId)) 
    	{
            // Persoon heeft al feedback ooit ingevuld, update deze
    		$this->update($sessieId, $gebruikerId, $feedback);
    	} else {
            // Persoon heeft nog nooit feedback ingevuld, maak deze aan
            $this->create($sessieId, $gebruikerId, $feedback);
    	}
    }

    /**
     * Update de desbetreffende feedback
     * @author Tom Van Den Rul  
     * @param $sessieId = id van de sessie
     * @param $gebruiker = id van de gebruiker
     * @param $feedback = gegeven feedback
     */

    function update($sessieId, $gebruikerId, $feedback)
    {
        $this->db->where('sessieId', $sessieId);
        $this->db->where('gebruikerId', $gebruikerId);
        $data = array('inhoud'=>$feedback);

        $this->db->update('feedback', $data);
    }

    /**
     * Creeërt nieuwe feedback voor een sessie
     * @author Tom Van Den Rul
     * @param $sessieId = id van de sessie
     * @param $gebruikerId = id van de gebruiker
     * @param $feedback = inhoud van de feedback
     */

    function create($sessieId, $gebruikerId, $feedback)
    {
        $data = array('sessieId'=>$sessieId, 'gebruikerId'=>$gebruikerId, 'inhoud'=>$feedback);

        $this->db->insert('feedback', $data);
    }

    /**
     * Verwijdert huidige feedback
     * @author Tom Van Den Rul
     * @param $sessieId = id van de sessie 
     * @param $gebruikerId = id van de gebruiker
     */

    function clear($sessieId, $gebruikerId)
    {
        $this->db->where('sessieId', $sessieId);
        $this->db->where('gebruikerId', $gebruikerId);
        $this->db->delete('feedback');
    }


}
?>