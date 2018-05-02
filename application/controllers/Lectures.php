<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @class Lectures
 * @author Quinten van Casteren
 * 
 * Controller-klasse voor het aanpassen van een sprekers lectures
 */
class Lectures extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
    }
        
        /**
         * Zendt de spreker door naar een pagina met al zijn eigen lectures. Deze worden opgehaalt door getAllSessionsByUser().
         * 
         * @see spreker_template_menu.php
         * @see show_lectures.php
         * @see Session_model::getAllSessionsByUser
         * @see Authex
         */
	public function index(){
		if($this->authex->checkLoginRedirectByType(3)){
			$data['titel'] = 'International Days';
                        $user = $this->authex->getUserInfo();
                        
                        $this->load->model('session_model');
                        $lectures = $this->session_model->getAllSessionsByUser($user->id);
                        
			$data['lectures'] = $lectures;
			$partials = array('template_menu' => 'login-spreker/template_menu', 'template_pagina' => 'lectures/show_lectures');
			$this->template->load('template/template_master', $partials, $data);
		} 
	}
        
        /**
         * Zendt de spreker door naar een pagina waar hij een sessie kan aanpassen of aanmaken. De gegevens hiervoor worden opgehaald via $code en dan doorgestuurd naar edit_lectures.php.
         * 
         * @param $code De code van de sessie die aangepast moet worden. Indien deze "new" is, is dit een nieuwe sessie.
         * @see spreker_template_menu.php
         * @see edit_lecture.php
         * @see Session_model::get
         * @see Language_model::getAll
         */
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
        
        /**
         * @brief Verandert of maakt de sessie aan.
         * 
         * Eerst laad de funcie alle gegevens. Als de Id "new" is zal een nieuwe sessie aangemaakt worden. Anders wordt de sessie verandert bij de waarde van de Id. Hierna wordt men verdergestuurt naar Lectures.
         * 
         * @see Session_model::insert
         * @see Session_model::update
         * @see Edition_model::getLastEdition
         */
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