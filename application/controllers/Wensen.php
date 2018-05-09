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
	
	private function getInQuestionByID($inQuestions, $id){
		foreach($inQuestions as $inq){
			if($inq['id'] == $id){
				return $inq;
			}
		}
		
		return null;
	}
	
	private function removeQuestionsFromDB($dbQuestions, $inQuestions){
		foreach($dbQuestions as $dbq){
			if($this->getInQuestionByID($inQuestions, $dbq->id) == null){
				$this->wishquestion_model->deleteQuestion($dbq->id);
			}
		}
	}
	
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