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
        $this->load->model("formuliertype_model");
        $this->load->model("wishanswerlist_model");
        
        $this->db->order_by('order', 'ASC');
        $this->db->where('verwijderd', 0);
        $query = $this->db->get('wensVraag');
        $result = $query->result();
        
        foreach ($result as $r){
            $r->type = $this->formuliertype_model->get($r->formulierTypeId);
            $r->answerList = $this->wishanswerlist_model->getAnswersByQuestion($r->id);
        }
        
        return $result;
    }
    
    function getAllQuestionsVisible(){
        $this->load->model("formuliertype_model");
        $this->load->model("wishanswerlist_model");
        
        $this->db->order_by('order', 'ASC');
        $this->db->where('verwijderd', 0);
        $this->db->where('actief', 1);
        $query = $this->db->get('wensVraag');
        $result = $query->result();
        
        foreach ($result as $r){
            $r->type = $this->formuliertype_model->get($r->formulierTypeId);
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
        $question->formulierTypeId = $q->formulierTypeId;
        $question->actief = $q->actief;
        $question->order = $q->order;
        $this->db->where('id', $q->id);
        $this->db->update('wensVraag', $question);
    }
    
    function insertQuestion($q){
        $question = new stdClass();
        $question->naam = $q->naam;
        $question->formulierTypeId = $q->formulierTypeId;
        $question->actief = $q->actief;
        $question->order = $q->order;
        
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