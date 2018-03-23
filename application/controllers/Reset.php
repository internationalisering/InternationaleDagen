<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reset extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
    }
	
	public function index(){
		if($this->authex->checkLoginRedirectToHome()){
			$data['titel'] = 'International Days';
			$partials = array('template_menu' => 'reset-password/template_menu', 'template_pagina' => 'reset-password/reset_email');
			$this->template->load('template/template_master', $partials, $data);
		}
	}
	
	public function email(){
		$email = $this->input->post('email');
			
			if($email == null){
					$error = "Fill in an email!";
					$data['titel'] = 'International Days';
					$partials = array('template_menu' => 'reset-password/template_menu', 'template_pagina' => 'reset-password/reset_email');
			} else {
					$this->load->model('user_model');
					if ($this->user_model->checkUserEmail($email) == null) {
						$error = "Email is incorrect!";
						$data['titel'] = 'International Days';
						$partials = array('template_menu' => 'reset-password/template_menu', 'template_pagina' => 'reset-password/reset_email');
					}
			}
			
			if (isset($error)) {
					$data['error'] = $error;
					$this->template->load('template/template_master', $partials, $data);
				}
			else {
				$this->load->model('edition_model');
				$data['titel'] = 'International Days';
				$data['edition'] = $this->edition_model->getLastEdition();
				$data['verantwoordelijke'] = '';
				$partials = array('template_menu' => 'logout/template_menu', 
				'template_pagina' => 'logout/logout_home');
			
				$this->template->load('template/template_master', $partials, $data);
			}
	}
	
	public function reset($code){
		
	}
}