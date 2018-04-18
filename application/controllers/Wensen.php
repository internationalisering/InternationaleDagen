<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wensen extends CI_Controller {

	public function __construct(){
        parent::__construct();
        
        $this->load->model('wishquestion_model');
        $this->load->model('formtype_model');
    }
    
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
		    
		}
	}
	
	public function beheer(){
		if($this->authex->checkLoginRedirectByType(4)){
		    $data['titel'] = 'International Days';
			$data['wishQuestions'] = $this->wishquestion_model->getAllQuestions();
			$data['wishTypes'] = $this->formtype_model->getAllTypes();
			$data['verantwoordelijke'] = 'Brend Simons';
			$partials = array('template_menu' => 'login-beheerder/template_menu', 'template_pagina' => 'login-beheerder/beheerder_wensen_beheren.php');
			
			$this->template->load('template/template_master', $partials, $data);
		}
	}
	
	public function beheeropslaan(){
		if($this->authex->checkLoginRedirectByType(4)){
		    $data['titel'] = 'International Days';
			$data['wishQuestions'] = $this->wishquestion_model->getAllQuestions();
			$data['wishTypes'] = $this->formtype_model->getAllTypes();
			$data['verantwoordelijke'] = 'Brend Simons';
			$partials = array('template_menu' => 'login-beheerder/template_menu', 'template_pagina' => 'login-beheerder/beheerder_wensen_beheren.php');
			
			//$this->template->load('template/template_master', $partials, $data);
			
			echo print_r($this->input->post('questions'));
		}
	}
}