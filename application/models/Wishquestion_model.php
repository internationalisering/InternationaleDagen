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
        
        $this->db->where('verwijderd', 0);
        $query = $this->db->get('wensVraag');
        $result = $query->result();
        
        foreach ($result as $r){
            $r->type = $this->formtype_model->get($r->formTypeId);
            $r->answerList = $this->wishanswerlist_model->getAnswersByQuestion($r->id);
        }
        
        return $result;
    }
    
    function deleteQuestion($id){
        $q = new stdClass();
        $q->verwijderd = 1;
        $this->db->where('id', $id);
        $this->db->update('wensVraag', $q);
    }
    
    function updateQuestion($q){
        $this->wishanswerlist_model->deleteAllAnswersByQuestion($q->id);
        
        foreach($q->answers as $answer){
            $a = new stdClass();
            $a->wensVraagId = $q->id;
            $a->antwoord = $answer;
            $a->verwijderd = 0;
            
            $this->wishanswerlist_model->insertAnswer($a);
        }
        
        $question = new stdClass();
        $question->naam = $q->naam;
        $question->formTypeId = $q->formTypeId;
        $question->actief = $q->actief;
        $this->db->where('id', $q->id);
        $this->db->update('wensVraag', $question);
    }
    
    function insertQuestion(){
        $question = new stdClass();
        $question->naam = $q->naam;
        $question->formTypeId = $q->formTypeId;
        $question->actief = $q->actief;
        
        $this->db->insert('wensVraag', $question);
        $id = $this->db->insert_id();
        
        foreach($q->answers as $answer){
            $a = new stdClass();
            $a->wensVraagId = $id;
            $a->antwoord = $answer;
            $a->verwijderd = 0;
            
            $this->wishanswerlist_model->insertAnswer($a);
        }
    }
}
?>