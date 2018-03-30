<?php
class WishQuestion_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }

    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('wensVraag');
        return $query->row();
    }
    
    function getAllQuestions(){
        $this->load->model("formtype_model");
        $this->load->model("wishanswerlist_model");
        
        $query = $this->db->get('wensVraag');
        $result = $query->result();
        
        foreach ($result as $r){
            $r->type = $this->formtype_model->get($r->formTypeId);
            $r->answerList = $this->wishanswerlist_model->getAnswersByQuestion($r->id);
        }
        
        return $result;
    }
}
?>