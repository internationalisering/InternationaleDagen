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
     * @param $id Het opgegeven id
     * @return De opgevraagde feedback
     */
    function get($sessieId, $gebruikerId)
    {
    	$this->db->where('sessieId', $sessieId);
    	$this->db->where('gebruikerId', $gebruikerId);
    	return $this->db->get('feedback')->row();
    }

    function exists($sessieId, $gebruikerId)
    {
    	$this->db->where('sessieId', $sessieId);
    	$this->db->where('gebruikerId', $gebruikerId);
    	
    	return $this->db->get('feedback')->row();
    }

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

    function update($sessieId, $gebruikerId, $feedback)
    {
        $this->db->where('sessieId', $sessieId);
        $this->db->where('gebruikerId', $gebruikerId);
        $data = array('inhoud'=>$feedback);

        $this->db->update('feedback', $data);
    }

    function create($sessieId, $gebruikerId, $feedback)
    {
        $data = array('sessieId'=>$sessieId, 'gebruikerId'=>$gebruikerId, 'inhoud'=>$feedback);

        $this->db->insert('feedback', $data);
    }

    function clear($sessieId, $gebruikerId)
    {
        $this->db->where('sessieId', $sessieId);
        $this->db->where('gebruikerId', $gebruikerId);
        $this->db->delete('feedback');
    }


}
?>