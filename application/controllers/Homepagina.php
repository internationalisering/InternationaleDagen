<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepagina extends CI_Controller {

	public function __construct(){
        parent::__construct();
    }
	
	public function index() {
	    if($this->authex->checkLoginRedirectByType(4)){
			$this->load->model('edition_model');
			 
			$data['titel'] = 'Webpagina aanpassen';
			
			
			$data['edition'] = $this->edition_model->getLastEdition();
			$data['verantwoordelijke'] = 'Vincent Duchateau';
			$partials = array('template_menu' => 'homepagina_bewerken/homepagina_bewerk_menu', 
			'template_pagina' => 'homepagina_bewerken/homepagina_bewerk_home');
			
			$this->template->load('template/template_master', $partials, $data);
		}
	    
	}
	
	public function edit() {
		
	}
}