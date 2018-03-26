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
					} else {
                                            $this->load->model('user_model');
					
                                            $user = $this->user_model->getUserFromEmail($email);
        
                                            if($user == null){
                                                $error = "Email is incorrect!";
                                            } else {
                                                $code = bin2hex(openssl_random_pseudo_bytes(64));
                                                $user->pwdCode = $code;
                                                $this->user_model->update($user);
                                                //sendEmail();
                                                $error = $code;
                                            }
                                        }
			if (isset($error)) {
                                        $data['titel'] = 'International Days';
					$partials = array('template_menu' => 'reset-password/template_menu', 'template_pagina' => 'reset-password/reset_email');
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
                        $data['titel'] = 'International Days';
                        $data['code'] = $code;
			$partials = array('template_menu' => 'reset-password/template_menu', 'template_pagina' => 'reset-password/reset_pass');
			$this->template->load('template/template_master', $partials, $data);
	}
        
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
                                                $this->notifications->createNotification("Your password has been changed!");
                                    }
                                }
                        
                        } else {
				$error = "Fill in a password!";
			}
				
			if (isset($error)) {
				$data['error'] = $error;
                                $data['code'] = $code;
                                $partials = array('template_menu' => 'reset-password/template_menu', 'template_pagina' => 'reset-password/reset_pass');
				$this->template->load('template/template_master', $partials, $data);
			} else {
                            $partials = array('template_menu' => 'reset-password/template_menu', 'template_pagina' => 'reset-password/reset_succes');
                            $this->template->load('template/template_master', $partials, $data);
                        }
                       
	}
}