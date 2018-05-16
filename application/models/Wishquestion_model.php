<?php
/**
 * @class Wishquestion_model
 * Model-klasse voor alle wishquestions (vragen i.v.m. wensen)
 */
class WishQuestion_model extends CI_Model {
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
    }
    
    /**
     * Haal de vraag met een bepaald id op.
     * @param $id Het opgegeven id
     * @return De opgevraagde vraag
     */
    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('wensVraag');
        return $query->row();
    }
    
    /**
     * Haal alle vragen op.
     * 
     * @return Alle vragen uit de database.
     */
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
    
    /**
     * Haal alle vragen op die zichtbaar zijn voor de spreker.
     * 
     * @return Alle zichtbare vragen.
     */
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
    
    /**
     * Haal alle vragen op die zichtbaar zijn voor de spreker met de bijbehorende antwoorden.
     * 
     * @return Alle zichtbare vragen met antwoorden.
     */
    function getAllQuestionsVisibleWithAllQuestionAnswers(){
        $this->load->model("formuliertype_model");
        $this->load->model("wishanswerlist_model");
        
        $this->db->order_by('order', 'ASC');
        $this->db->where('verwijderd', 0);
        $this->db->where('actief', 1);
        $query = $this->db->get('wensVraag');
        $result = $query->result();
        
        foreach ($result as $r){
            $r->type = $this->formuliertype_model->get($r->formulierTypeId);
            $r->answerList = $this->wishanswerlist_model->getAllAnswersByQuestion($r->id);
        }
        
        return $result;
    }
    
    /**
     * Verwijder een vraag.
     * 
     * @param $id Id van de te verwijderen vraag.
     */
    function deleteQuestion($id){
        $q = new stdClass();
        $q->verwijderd = 1;
        $this->db->where('id', $id);
        $this->db->update('wensVraag', $q);
    }
    
    /**
     * Pas een vraag aan in de database.
     * 
     * @param $q Vraag object met alle parameters voor in de database.
     */
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
    
    /**
     * Voeg een vraag toe aan de database
     * 
     * @param $q Vraag object met alle parameters voor in de database.
     */
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
    
    /**
     * Zoekt naar desbetreffende klasse in de tabel
     * @param $text is de zoekterm
     * @param $previousEditions kan men aanvinken om te zoeken in vorige edities
     * @param $columns zoekt naar de kolommen van de tabel kolom
     * @return Verschillende zoekresultaten
     */
    function search($text, $previousEditions, $columns){
        $this->db->from('wensVraag');
        
        $first = true;
        
        foreach($columns as $column){
            if($first){
                $first = false;
                
                $this->db->like($column, $text);
            }else{
                $this->db->or_like($column, $text);
            }
        }
        
        $query = $this->db->get();
        return $query->result();
    }
}
?>