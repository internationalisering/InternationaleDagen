<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @class Activation
 * @author Quinten van Casteren
 * 
 * Controller-klasse voor het activeren van een gebruiker
 */
class Activation extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
    }
	/**
         * Zendt de gebruiker door naar de pagina om hun wachtwoord te resetten met een aangepast reset_menu om terug te gaan naar inloggen.
         * @see activate_user.php
         * @see reset_menu.php
         * @see Authex
         */
	public function index(){
		if($this->authex->checkLoginRedirectToHome()){
			$data['titel'] = 'International Days';
			$partials = array('template_menu' => 'reset-password/reset_menu', 'template_pagina' => 'activate/activate_user');
			$this->template->load('template/template_master', $partials, $data);
		}
	}
        
        /**
         * Activeert de gebruiker en geeft hem zijn wachtwoord.
         * 
         * @see activate_user.php
         * @see reset_menu.php
         * @see User_model::getUserFromEmail
         * @see User_model::update
         */
        public function finish(){
                        $data['titel'] = 'International Days';
			$password = $this->input->post('password');
                        $confirmPassword = $this->input->post('confirmpassword');
			$email = $this->input->post('email');
                        
			if($password != null){
				if($confirmPassword !=  $password){
					$error = "Passwords do not match!";
                                } else {
                                    $this->load->model('user_model');
                                    $user = $this->user_model->getUserFromEmail($email);
        
                                    if($user == null){
                                                $error = "Invalid Email!";
                                    } else {
                                        if($user->actief == 0){
                                                $hash = password_hash("$password", PASSWORD_DEFAULT);
                                                $user->pwdCode = null;
                                                $user->wachtwoord = $hash;
                                                $user->actief = 1;
                                                $this->user_model->update($user);
                                    } else {
                                        $error = "User already activated!";
                                    }
                                }}} else {
				$error = "Fill in a password!";
			}
				
			if (isset($error)) {
				$data['error'] = $error;
                                $partials = array('template_menu' => 'reset-password/reset_menu', 'template_pagina' => 'activate/activate_user');
				$this->template->load('template/template_master', $partials, $data);
			} else {
                            redirect('/home');
                        }
                       
	}
}