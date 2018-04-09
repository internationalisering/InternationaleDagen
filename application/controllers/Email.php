<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @class Email
 * @author Quinten van Casteren
 * 
 * Controller-klasse voor het beheren en verzenden van emails
 */
class Email extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
    }
    
        /**
         * Zendt de beheerder door naar een pagina met alle emailtemplates. Deze worden opgehaalt via getAllTemplates().
         * 
         * @see show_templates.php
         * @see beheerder_template_menu.php
         * @see Mailtype_model::getAllTemplates
         * @see Authex
         */
	public function index(){
		if($this->authex->isLoggedIn()){
			$data['titel'] = 'International Days';
                        
                        $this->load->model('mailtype_model');
                        $templates = $this->mailtype_model->getAllTemplates();
                        
			$data['templates'] = $templates;
			$partials = array('template_menu' => 'login-beheerder/template_menu', 'template_pagina' => 'email/show_templates');
			$this->template->load('template/template_master', $partials, $data);
		} 
	}
        
        /**
         * Zendt de beheerder door naar een pagina waarin hij zijn emailtemplate kan aanpassen in een form. Dit template wordt opgehaalt via get(().
         * 
         * @param $code De Id van het geselecteerde template. Dit is "new" voor een nieuw template.
         * @see beheerder_template_menu.php
         * @see edit_template.php
         * @see Mailtype_model::get
         */
        public function edit($code){
		
		$data['titel'] = 'International Days';
                
                if($code != "new"){
                    $this->load->model('mailtype_model');
                    $template = $this->mailtype_model->get($code);
                        
                    $data['template'] = $template;
                } else {
                    $data['template'] = NULL;
                }
                $partials = array('template_menu' => 'login-beheerder/template_menu', 'template_pagina' => 'email/edit_template');
		$this->template->load('template/template_master', $partials, $data);
	}
        
        /**
         * Past het template aan dat id als id heeft. Als id="new" zal er een nieuw template aangemaakt worden. Hierna word men verdergestuurt naar Email.
         * 
         * @see Mailtype_model::insert
         * @see Mailtype_model::update
         */
        public function change(){
            $id = $this->input->post('id');
            $naam = $this->input->post('naam');
            $inhoud = $this->input->post('inhoud');
            $onderwerp = $this->input->post('onderwerp');
            
            $template = new stdClass();
            $template->inhoud = $inhoud;
            $template->naam = $naam;
            $template->onderwerp = $onderwerp;
            if ($id == "new"){
                $this->load->model("mailtype_model");
                $this->mailtype_model->insert($template);
            }else{
                $this->load->model("mailtype_model");
                $template->id = $id;
                $this->mailtype_model->update($template);
            }
            redirect('/email');
        }
        
        /**
         * Verwijdert het aangeduide template. Hierna word men verdergestuurt naar Email.
         * 
         * @param $code De id van het template dat we verwijderen.
         * @see Mailtype_model::remove
         */
        public function remove($code){
                    $this->load->model('mailtype_model');
                    $this->mailtype_model->remove($code);
                    redirect('/email');
        }
        
        /**
         * Zendt de beheerder door naar een pagina waar hij een email kan samenstellen. 
         * 
         * @see beheerder_template_menu.php
         * @see send_templates.php
         * @see Mailtype_model::getAllTemplates
         * @see User_model::getAllUsers
         */
        public function send(){
                        $data['titel'] = 'International Days';
                        
                        $this->load->model('mailtype_model');
                        $templates = $this->mailtype_model->getAllTemplates();
                        
			$data['templates'] = $templates;
                        
                        $this->load->model('user_model');
                        $users = $this->user_model->getAllUsers();
                        
			$data['users'] = $users;
                        
			$partials = array('template_menu' => 'login-beheerder/template_menu', 'template_pagina' => 'email/send_templates');
			$this->template->load('template/template_master', $partials, $data);
        }
}