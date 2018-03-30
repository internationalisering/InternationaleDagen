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
                } else {
                    $data['lecture'] = NULL;
                }
                    $this->load->model('language_model');
                    $talen = $this->language_model->getAll();
                    $data['talen'] = $talen;
                  
                $partials = array('template_menu' => 'login-spreker/template_menu', 'template_pagina' => 'lectures/edit_lecture');
		$this->template->load('template/template_master', $partials, $data);
	}
        public function change(){
            $this->load->model("edition_model");
            $editie = $this->edition_model->getLastEdition();
            $id = $this->input->post('id');
            $titel = $this->input->post('titel');
            $studiegebied = $this->input->post('studiegebied');
            $duur = $this->input->post('duur');
            $inhoud = $this->input->post('inhoud');
            $taalId = $this->input->post('taal');
            $user = $this->authex->getUserInfo();
            
            $sessie = new stdClass();
            $sessie->titel = $titel;
            $sessie->studieGebied = $studiegebied;
            $sessie->duur = $duur;
            $sessie->inhoud = $inhoud;
            $sessie->editieId = $editie->id;
            $sessie->taalId = $taalId;
            $sessie->gebruikerId = $user->id;
            if ($id == "new"){
                $this->load->model("session_model");
                $this->session_model->insert($sessie);
            }else{
                $this->load->model("session_model");
                $sessie->id = $id;
                $this->session_model->update($sessie);
            }
            redirect('/lectures');
        }
}