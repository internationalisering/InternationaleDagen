<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Zoeken extends CI_Controller {

	public function __construct(){
        parent::__construct();
        
        //$this->load->model('wishquestion_model');
        //$this->load->model('formuliertype_model');
        //$this->load->model('wishanswer_model');
    }
	
	public function index(){
		if($this->authex->checkLoginRedirectByType(4)){
		    $data['titel'] = 'International Days';
			//$data['wishQuestions'] = $this->wishquestion_model->getAllQuestions();
			//$data['wishTypes'] = $this->formuliertype_model->getAllTypes();
			$data['verantwoordelijke'] = 'Brend Simons';
			$partials = array('template_menu' => 'login-beheerder/template_menu', 'template_pagina' => 'login-beheerder/beheerder_zoeken.php');
			
			$this->template->load('template/template_master', $partials, $data);
		}
	}
}