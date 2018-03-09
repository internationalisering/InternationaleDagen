<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Planning extends CI_Controller {

	public function __construct(){
        parent::__construct();
    }
    
	public function index(){
		if($this->authex->checkLoginRedirectToHome()){
			$this->load->model('class_model');
			$this->load->model('classgroup_model');
			$this->load->model('row_model');
			$this->load->model('session_model');
			$this->load->model('class_model');
			$this->load->model('edition_model');
			$this->load->model('column_model');
			
			$data['titel'] = 'Calendar | International Days';
			
			
			$data['edition'] = $this->edition_model->getLastEdition();
			
			
			$partials = array('template_menu' => 'planning/planning_menu', 'template_pagina' => 'planning/planning_home');
			
			
			
			$this->template->load('template/template_master', $partials, $data);
		}
	}
}