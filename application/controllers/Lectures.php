<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lectures extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
    }
    
	public function index(){
		if($this->authex->isLoggedIn()){
			$data['titel'] = 'International Days';
                        $user = $this->authex->getUserInfo();
                        
                        $this->load->model('session_model');
                        $lectures = $this->session_model->getAllSessionsByUser($user->id);
                        
			$data['lectures'] = $lectures;
			$partials = array('template_menu' => 'login-spreker/template_menu', 'template_pagina' => 'lectures/show_lectures');
			$this->template->load('template/template_master', $partials, $data);
		} 
	}
        public function edit($code){
		
		$data['titel'] = 'International Days';
                
                if($code != "new"){
                    $this->load->model('session_model');
                    $lecture = $this->session_model->get($code);
                        
                    $data['lecture'] = $lecture;
                }
                $partials = array('template_menu' => 'login-spreker/template_menu', 'template_pagina' => 'lectures/edit_lecture');
		$this->template->load('template/template_master', $partials, $data);
	}
}