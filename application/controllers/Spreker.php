<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spreker extends CI_Controller {

	public function __construct(){
        parent::__construct();
    }
    
	public function index(){
		if($this->authex->checkLoginRedirectToHome()){
			$this->load->model('edition_model');
			
			$data['titel'] = 'International Days';
			$data['edition'] = $this->edition_model->getLastEdition();
			$partials = array('template_menu' => 'logout/template_menu', 'template_pagina' => 'logout/logout_home');
			
			$this->template->load('template/template_master', $partials, $data);
		}
	}

	
	
	
}