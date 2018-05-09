<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @class Login
 * @author Brend Simons
 * 
 * Controller-klasse voor het inloggen
 */
class Login extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
    }
	
	public function index(){
		if($this->authex->checkLoginRedirectToHome()){
			$data['titel'] = 'International Days';
			$partials = array('template_menu' => 'logout/template_menu', 'template_pagina' => 'logout/logout_login');
			
			$login = $this->input->post('login');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			
			if($login != null){
				if($email == null && $password == null){
					$error = "Fill in an email and password!";
				}else if($email == null){
					$error = "Fill in an email!";
				}else if($password == null){
					$error = "Fill in a password!";
				}else{
					$loginStatus = $this->authex->login($email, $password);
					
					if($loginStatus == 1){
						redirect('/home/' . strtolower($this->authex->getUserInfo()->type->name));
					}else if($loginStatus == -1){
						$error = "Wrong email and password combination!";
					}else if($loginStatus == -2){
						$error = "You have to activate your account first!<br>You should have received an email that you can use to activate your account.";
					}
				}
				
				if (isset($error)) {
					$data['error'] = $error;
					$this->template->load('template/template_master', $partials, $data);
				}
			} else {
				$this->template->load('template/template_master', $partials, $data);
			}
		}
	}
}