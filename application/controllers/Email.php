<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @class Email
 * @author Quinten van Casteren
 * Controller-klasse voor het beheren en verzenden van emails
 */
class Email extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
    }
    
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
        public function remove($code){
                    $this->load->model('mailtype_model');
                    $this->mailtype_model->remove($code);
                    redirect('/email');
        }
}