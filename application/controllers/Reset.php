<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @class Reset
 * @author Quinten van Casteren
 * 
 * Controller-klasse voor het resetten van een wachtwoord
 */
class Reset extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
    }
	/**
         * Zendt de gebruiker door naar de pagina om hun wachtwoord te resetten met een aangepast reset_menu om terug te gaan naar inloggen.
         * @see reset_email.php
         * @see reset_menu.php
         * @see Authex
         */
	public function index(){
		if($this->authex->checkLoginRedirectToHome()){
			$data['titel'] = 'International Days';
			$partials = array('template_menu' => 'reset-password/reset_menu', 'template_pagina' => 'reset-password/reset_email');
			$this->template->load('template/template_master', $partials, $data);
		}
	}
        
	/**
         * @brief Checkt of het opgegeven email correct is en verstuurt een email
         * 
         * Eerst wordt er gecheckt of er email opgegeven is en of dit email bestaat via. Zo niet krijgt men een error. Deze error wordt dan terug doorverwezen naar reset_email.php.
         * Indien er geen error is zal er een code aangemaakt worden. Er wordt gecheckt of deze code al bestaat en vanaf er een ongebruikte code is zal deze code worden weggeschreven bij de gebruiker van het opgegeven email.
         * Ten slotte wordt er een persoonlijke email verzonden via onze email helper en wordt de gebruiker doorverwezen naar de homepagina.
         * 
         * @see reset_email.php
         * @see reset_menu.php
         * @see User_model::getUserFromEmail
         * @see User_model::getUserFromPwdCode
         * @see User_model::update
         * @see my_email_helper
         * @see Home
         */
	public function email(){
		$email = $this->input->post('email');
			
			if($email == null){
					$error = "Fill in an email!";
			} else {
                                        $this->load->model('user_model');
					
                                        $user = $this->user_model->getUserFromEmail($email);
        
                                        if($user == null){
                                                $error = "Email is incorrect!";
                                        } else {
                                                $code = bin2hex(openssl_random_pseudo_bytes(64));
                                                $codeUser = $this->user_model->getUserFromPwdCode($code);
                                                while($codeUser != null){
                                                    $code = bin2hex(openssl_random_pseudo_bytes(64));
                                                    $codeUser = $this->user_model->getUserFromPwdCode($code);
                                                }
                                                    $user->pwdCode = $code;
                                                    $this->user_model->update($user);
                                                    sendEmail($email, "Reset Password International Days" , "Please use this verificationlink to change your password: https://intdays.brendsimons.be//reset/reset/" . $code);
                                                    
                                        }
                                }
			if (isset($error)) {
                                        $data['titel'] = 'International Days';
					$partials = array('template_menu' => 'reset-password/reset_menu', 'template_pagina' => 'reset-password/reset_email');
					$data['error'] = $error;
					$this->template->load('template/template_master', $partials, $data);
				}
			else {  
                                redirect('/home');
			}
	}
        
	/**
         * Stuurt de gebruiker verder naar zijn persoonlijke reset pagina.
         * 
         * @param $code De persoonlijke code om een wachtwoord te resetten
         * @see reset_menu.php
         * @see reset_pass.php
         */
	public function reset($code){
                        $data['titel'] = 'International Days';
                        $data['code'] = $code;
			$partials = array('template_menu' => 'reset-password/reset_menu', 'template_pagina' => 'reset-password/reset_pass');
			$this->template->load('template/template_master', $partials, $data);
	}
        
        /**
         * @brief Verandert het wachtwoord van een gebruiker.
         * 
         * Eerst wordt er gecheckt of de twee wachtwoorden hetzelfde zijn en of de paswordcode correct is. Als dit niet zo is zal er een error verschijnen op reset_pass.php.
         * Hierna wordt de code teruggezet naar null en het wachtwoord als versleuteld opgeslagen. Ten slotte wordt men dan verdergestuurd naar reset_succes.php.
         * 
         * @see reset_menu.php
         * @see reset_pass.php
         * @see reset_succes.php
         * @see User_model::getUserFromPwdCode
         * @see User_model::update
         */
        public function pass(){
                        $data['titel'] = 'International Days';
			$password = $this->input->post('password');
                        $confirmPassword = $this->input->post('confirmpassword');
			$code = $this->input->post('code');
                        
			if($password != null){
				if($confirmPassword !=  $password){
					$error = "Passwords do not match!";
                                } else {
                                    $this->load->model('user_model');
                                    $user = $this->user_model->getUserFromPwdCode($code);
        
                                    if($user == null){
                                                $error = "Invalid secure link!";
                                    } else {
                                                $hash = password_hash("$password", PASSWORD_DEFAULT);
                                                $user->pwdCode = null;
                                                $user->wachtwoord = $hash;
                                                $this->user_model->update($user);
                                    }
                                }
                        
                        } else {
				$error = "Fill in a password!";
			}
				
			if (isset($error)) {
				$data['error'] = $error;
                                $data['code'] = $code;
                                $partials = array('template_menu' => 'reset-password/reset_menu', 'template_pagina' => 'reset-password/reset_pass');
				$this->template->load('template/template_master', $partials, $data);
			} else {
                            $partials = array('template_menu' => 'reset-password/reset_menu', 'template_pagina' => 'reset-password/reset_succes');
                            $this->template->load('template/template_master', $partials, $data);
                        }
                       
	}
}