<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @class Wensen
 * @author Brend Simons
 * 
 * Controller-klasse voor het beheren en invullen van wensen
 */
class Wensen extends CI_Controller {

	public function __construct(){
        parent::__construct();
        
        $this->load->model('wishquestion_model');
        $this->load->model('formuliertype_model');
        $this->load->model('wishanswer_model');
    }
    
    /**
     * Verstuur de beheerder door naar een beheer pagina en de spreker naar een invul pagina.
     * 
     * @see Authex
     * @see template.master.php
     */
	public function index(){
		if($this->authex->checkLoginRedirectByType(3, 4)){
			if($this->authex->getUserInfo()->typeId == 3){
			    redirect('/wensen/invullen');
			}else if($this->authex->getUserInfo()->typeId == 4){
			    redirect('/wensen/beheer');
			}
		}
	}
	
	/**
     * Toont een pagina waarop de spreker zijn wensen kan invullen.
     * 
     * @see spreker_wensen_invullen.php
     * @see login-beheerder/template_menu.php
     * @see WishAnswer_model::deleteAllAnswersByUser
     * @see WishAnswer_model::insertAnswer
     * @see WishAnswer_model::getAnswersByUser
     * @see WishQuestion_model::getAllQuestionsVisible
     * @see Authex
     * @see template.master.php
     */
	public function invullen(){
		if($this->authex->checkLoginRedirectByType(3)){
			$submit = $this->input->post('submit');
    		
		    if($submit == "submit"){
		    	$this->wishanswer_model->deleteAllAnswersByUser($this->authex->getUserInfo()->id);
		    	
		    	foreach($this->input->post() as $key => $value){
		    		$split = explode("-", $key);
		    		
		    		if($split[0] == "qa"){
		    			$this->wishanswer_model->insertAnswer($this->authex->getUserInfo()->id, $split[1], $value);
		    		}
		    	}
		    	
		    	$this->notifications->createNotification("Your wishes are succesfully changed!", "success", false);
		    }
		    
			$data['titel'] = 'International Days';
			$data['wishQuestions'] = $this->wishquestion_model->getAllQuestionsVisible();
			$data['myAnswers'] = $this->wishanswer_model->getAnswersByUser($this->authex->getUserInfo()->id);
			$data['verantwoordelijke'] = 'Brend Simons';
			$partials = array('template_menu' => 'login-spreker/template_menu', 'template_pagina' => 'login-spreker/spreker_wensen_invullen');
			
			$this->template->load('template/template_master', $partials, $data);
		}
	}
	
	/**
     * Toont een pagina waarop de beheerdere de wensen kan beheren.
     * 
     * @see beheerder_wensen_beheren.php
     * @see login-beheerder/template_menu.php
     * @see WishQuestion_model::getAllQuestions
     * @see FormulierType_model::getAllTypes
     * @see Authex
     * @see template.master.php
     */
	public function beheer(){
		if($this->authex->checkLoginRedirectByType(4)){
		    $data['titel'] = 'International Days';
			$data['wishQuestions'] = $this->wishquestion_model->getAllQuestions();
			$data['wishTypes'] = $this->formuliertype_model->getAllTypes();
			$data['verantwoordelijke'] = 'Brend Simons';
			$partials = array('template_menu' => 'login-beheerder/template_menu', 'template_pagina' => 'login-beheerder/beheerder_wensen_beheren.php');
			
			$this->template->load('template/template_master', $partials, $data);
		}
	}
	
	/**
     * Slaat het aangepaste formulier van de beheerder op.
     * 
     * @see Wensen::removeQuestionsFromDB
     * @see Wensen::addAndUpdateQuestionsToDB
     * @see beheerder_wensen_beheren.php
     * @see login-beheerder/template_menu.php
     * @see WishQuestion_model::getAllQuestions
     * @see FormulierType_model::getAllTypes
     * @see Authex
     * @see template.master.php
     */
	public function beheeropslaan(){
		if($this->authex->checkLoginRedirectByType(4)){
		    $data['titel'] = 'International Days';
			$data['wishQuestions'] = $this->wishquestion_model->getAllQuestions();
			$data['wishTypes'] = $this->formuliertype_model->getAllTypes();
			$data['verantwoordelijke'] = 'Brend Simons';
			$partials = array('template_menu' => 'login-beheerder/template_menu', 'template_pagina' => 'login-beheerder/beheerder_wensen_beheren.php');
			
			$dbQuestions = $this->wishquestion_model->getAllQuestions();
			$inQuestions = $this->input->post('questions');
			
			$this->removeQuestionsFromDB($dbQuestions, $inQuestions);
			$this->addAndUpdateQuestionsToDB($inQuestions);
			
			//$this->template->load('template/template_master', $partials, $data);
		}
	}
	
	/**
     * Zoekt een bepaalde question in een array via het id.
     * 
     * @return Question object
     */
	private function getInQuestionByID($inQuestions, $id){
		foreach($inQuestions as $inq){
			if($inq['id'] == $id){
				return $inq;
			}
		}
		
		return null;
	}
	
	/**
	 * Verwijderd een lijst met questions uit de database.
     * 
     * @see Wensen::getInQuestionByID
     * @see WishQuestion_model::deleteQuestion
     */
	private function removeQuestionsFromDB($dbQuestions, $inQuestions){
		foreach($dbQuestions as $dbq){
			if($this->getInQuestionByID($inQuestions, $dbq->id) == null){
				$this->wishquestion_model->deleteQuestion($dbq->id);
			}
		}
	}
	
	/**
	 * Voegt een question toe of past een question aan in de dabatase.
     * 
     * @see WishQuestion_model::insertQuestion
     * @see WishQuestion_model::updateQuestion
     */
	private function addAndUpdateQuestionsToDB($inQuestions){
		$order = 0;
		
		foreach($inQuestions as $inq){
			$q = new stdClass();
        	$q->naam = $inq['question'];
        	$q->formulierTypeId = $inq['type'];
        	$q->actief = $inq['active'] == "true" ? 1 : 0;
        	$q->answers = isset($inq['options']) ? $inq['options'] : [];
        	$q->order = $order++;
        	
			if(strpos($inq['id'], 'n') === 0){
				$this->wishquestion_model->insertQuestion($q);
			}else{
				$q->id = $inq['id'];
				$this->wishquestion_model->updateQuestion($q);
			}
		}
	}
}