<?php
class Feedback_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }

  
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
    	
    	$result = $this->db->get('feedback')->row();

    	

    	return $result;
    }

    function set($sessieId, $gebruikerId, $feedback)
    {
    	//$this->db->where('sessieId', $sessionId);
    	//$this->db->where('gebruikerId', $gebruikerId);


    	if($this->feedback_model->exists($sessieId, $gebruikerId))
    	{

    		$this->update($sessieId, $gebruikerId, $feedback);
    	} else {
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