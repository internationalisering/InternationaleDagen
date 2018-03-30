<?php
class Feedback_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }

  
    function get($sessionId, $userId)
    {
    	
    	$this->db->where('sessieId', $sessionId);
    	$this->db->where('gebruikerId', $userId);
    	return $this->db->get('feedback')->row();
    }

    function exists($sessionId, $userId)
    {
    	$this->db->where('sessieId', $sessionId);
    	$this->db->where('gebruikerId', $userId);
    	
    	$result = $this->db->where('feedback')->row();

    	if($result == null)
    	{

    	}

    	return $result;
    }

    function set($sessionId, $userId, $feedback)
    {
    	$this->db->where('sessieId', $sessionId);
    	$this->db->where('gebruikerId', $userId);
    		echo "feedback ";


    	if($this->feedback_model->exists($sessionId, $userId))
    	{
    		echo "feedback besta";
    		// $this->db->update();
    	} else {
    		echo "feedback besta ni";
    		///$this->db->insert('feedback');
    	}

    }
}
?>