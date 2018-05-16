<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @class Tables
 * @author Quinten van Casteren
 * 
 * Controller-klasse voor het aanpassen van de hulptabellen
 */
class Tables extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
    }
        
        /**
         * Zendt de beheerder door naar een pagina met alle hulptabellen>
         * 
         * @see login-beheerder/template_menu.php
         * @see show_tables.php
         * @see Gebruikertype_model::getAllTypes
         * @see Class_model::getAll
         * @see Language_model::getAll
         * @see Authex
         * @see template.master.php
         */
	public function index(){
		if($this->authex->checkLoginRedirectByType(4)){
			$data['titel'] = 'International Days';
                        
                        $this->load->model('class_model');
                        $classes = $this->class_model->getAll();
			$data['classes'] = $classes;
                        $this->load->model('gebruikertype_model');
                        $types = $this->gebruikertype_model->getAllTypes();
			$data['types'] = $types;
                        $this->load->model('language_model');
                        $languages = $this->language_model->getAll();
			$data['languages'] = $languages;
                        $this->load->model('edition_model');
                        $editions = $this->edition_model->getAllEditions();
			$data['editions'] = $editions;
                        
			$partials = array('template_menu' => 'login-beheerder/template_menu', 'template_pagina' => 'tables/show_tables');
			$this->template->load('template/template_master', $partials, $data);
		} 
	}
        
        /**
         * Zendt de beheerder door naar een pagina waarin hij zijn class kan aanpassen in een form.
         * 
         * @param $code De Id van de geselecteerde class. Dit is "new" voor een nieuwe class.
         * @see login-beheerder/template_menu.php
         * @see edit_tables.php
         * @see Class_model::get
         * @see template.master.php
         */
        public function editclass($code){
		
		$data['titel'] = 'International Days';
                
                if($code != "new"){
                    $this->load->model('class_model');
                    $template = $this->class_model->get($code);
                        
                    $data['template'] = $template;
                } else {
                    $data['template'] = NULL;
                }
                
                $data['type'] = "Class";
                
                $partials = array('template_menu' => 'login-beheerder/template_menu', 'template_pagina' => 'tables/edit_tables');
		$this->template->load('template/template_master', $partials, $data);
	}
        
        /**
         * Zendt de beheerder door naar een pagina waarin hij zijn type kan aanpassen in een form.
         * 
         * @param $code De Id van het geselecteerde type. Dit is "new" voor een nieuw type.
         * @see login-beheerder/template_menu.php
         * @see edit_tables.php
         * @see Gebruikertype_model::get
         * @see template.master.php
         */
        public function edittype($code){
		
		$data['titel'] = 'International Days';
                
                if($code != "new"){
                    $this->load->model('gebruikertype_model');
                    $template = $this->gebruikertype_model->get($code);
                        
                    $data['template'] = $template;
                } else {
                    $data['template'] = NULL;
                }
                
                $data['type'] = "Type";
                
                $partials = array('template_menu' => 'login-beheerder/template_menu', 'template_pagina' => 'tables/edit_tables');
		$this->template->load('template/template_master', $partials, $data);
	}
        
        /**
         * Zendt de beheerder door naar een pagina waarin hij zijn language kan aanpassen in een form.
         * 
         * @param $code De Id van de geselecteerde language. Dit is "new" voor een nieuwe language.
         * @see login-beheerder/template_menu.php
         * @see edit_tables.php
         * @see Language_model::get
         * @see template.master.php
         */
        public function editlanguage($code){
		
		$data['titel'] = 'International Days';
                
                if($code != "new"){
                    $this->load->model('language_model');
                    $template = $this->language_model->get($code);
                        
                    $data['template'] = $template;
                } else {
                    $data['template'] = NULL;
                }
                
                $data['type'] = "Language";
                
                $partials = array('template_menu' => 'login-beheerder/template_menu', 'template_pagina' => 'tables/edit_tables');
		$this->template->load('template/template_master', $partials, $data);
	}
        
        /**
         * Past het type aan dat id als id heeft. Als id="new" zal er een nieuw type aangemaakt worden. Hierna word men verdergestuurt naar Tables.
         * 
         * @see Gebruikertype_model::insert
         * @see Gebruikertype_model::update
         */
        public function changeType(){
            $id = $this->input->post('id');
            $naam = $this->input->post('naam');
            
            $template = new stdClass();
            $template->naam = $naam;
            if ($id == "new"){
                $this->load->model("gebruikertype_model");
                $this->gebruikertype_model->insert($template);
            }else{
                $this->load->model("gebruikertype_model");
                $template->id = $id;
                $this->gebruikertype_model->update($template);
            }
            redirect('/tables');
        }
        
        /**
         * Past de language aan dat id als id heeft. Als id="new" zal er een nieuwe language aangemaakt worden. Hierna word men verdergestuurt naar Tables.
         * 
         * @see Language_model::insert
         * @see Language_model::update
         */
        public function changeLanguage(){
            $id = $this->input->post('id');
            $naam = $this->input->post('naam');
            
            $template = new stdClass();
            $template->naam = $naam;
            if ($id == "new"){
                $this->load->model("language_model");
                $this->language_model->insert($template);
            }else{
                $this->load->model("language_model");
                $template->id = $id;
                $this->language_model->update($template);
            }
            redirect('/tables');
        }
        
        /**
         * Past de class aan dat id als id heeft. Als id="new" zal er een nieuwe class aangemaakt worden. Hierna word men verdergestuurt naar Tables.
         * 
         * @see Class_model::insert
         * @see Class_model::update
         * @see Edition_model::getLastEdition
         */
        public function changeClass(){
             $this->load->model("edition_model");
            $id = $this->input->post('id');
            $naam = $this->input->post('naam');
            $editie = $this->edition_model->getLastEdition();
            
            $template = new stdClass();
            $template->klasgroep = $naam;
            $template->editieId = $editie->id;
            if ($id == "new"){
                $this->load->model("class_model");
                $this->class_model->insert($template);
            }else{
                $this->load->model("class_model");
                $template->id = $id;
                $this->class_model->update($template);
            }
            redirect('/tables');
        }
        
        /**
         * Verwijdert de aangeduide class. Hierna word men verdergestuurt naar Tables.
         * 
         * @param $code De id van de class dat we verwijderen.
         * @see Class_model::remove
         */
        public function removeclass($code){
                    $this->load->model('class_model');
                    $this->class_model->remove($code);
                    redirect('/tables');
        }
        
        /**
         * Verwijdert de aangeduide language. Hierna word men verdergestuurt naar Tables.
         * 
         * @param $code De id van de language dat we verwijderen.
         * @see Language_model::remove
         */
        public function removelanguage($code){
                    $this->load->model('language_model');
                    $this->language_model->remove($code);
                    redirect('/tables');
        }
}