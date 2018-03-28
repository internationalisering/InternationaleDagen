<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gebruiker extends CI_Controller {
    
	public function __construct(){
        parent::__construct();
    }
    
	public function index(){
		if($this->authex->checkLoginRedirectByType(4)){
		    $this->load->model('user_model');
		    
			$data['titel'] = 'International Days';
			$data['users'] = $this->user_model->getAllUsers();
			$partials = array('template_menu' => 'login-beheerder/template_menu', 'template_pagina' => 'login-beheerder/beheerder_gebruiker_lijst');
			
			$this->template->load('template/template_master', $partials, $data);
		}
	}
	
	public function view($id){
	    if($this->authex->checkLoginRedirectByType(4)){
		    $this->load->model('user_model');
		    
		    $user = $this->user_model->get($id);
		    
    	    if(isset($user->id)){
    	    	$data['titel'] = 'International Days';
	    	    $data['user'] = $user;
	    		$partials = array('template_menu' => 'login-beheerder/template_menu', 'template_pagina' => 'login-beheerder/beheerder_gebruiker_bekijk');
	    		
	    		$this->template->load('template/template_master', $partials, $data);
    	    }else{
    	    	redirect('/gebruiker');
    	    }
		}
	}
	
	public function edit($id){
		if($this->authex->checkLoginRedirectByType(4)){
		    $this->load->model('user_model');
		    $this->load->model('type_model');
		    
		    $user = $this->user_model->get($id);
		    
    	    if(isset($user->id)){
	    		$submit = $this->input->post('submit');
	    		
			    if($submit == "submit"){
				    $user->voornaam = $this->input->post('voornaam');
				    $user->achternaam = $this->input->post('achternaam');
				    $user->email = $this->input->post('email');
				    $user->gender = $this->input->post('gender');
				    $user->titel = $this->input->post('titel');
				    $user->institutie = $this->input->post('institutie');
				    $user->mobiel = $this->input->post('mobiel');
				    $user->biografie = $this->input->post('biografie');
				    $user->positie = $this->input->post('positie');
				    $user->tmContact = $this->input->post('tmContact');
				    $user->studieGebied = $this->input->post('studieGebied');
				    $user->land = $this->input->post('land');
				    $user->typeId = $this->input->post('typeId');
					
					$update = $this->user_model->update($user);
					
					if($update >= 1){
						$this->notifications->createNotification("The user <b>$user->voornaam $user->achternaam</b> is succesfully changed!");
						
						redirect('/gebruiker');
					}else{
						if($update == -1){
							$this->notifications->createNotification("You must submit at least a first name, last name and email!", "danger", false);
						}else if($update == -2){
							$this->notifications->createNotification("The email adres is already used by another user!", "danger", false);
						}
						
						$data['titel'] = 'International Days';
			    	    $data['types'] = $this->type_model->getAllTypes();
			    	    $data['user'] = $user;
			    	    $data['h1'] = "New User";
			    		$partials = array('template_menu' => 'login-beheerder/template_menu', 'template_pagina' => 'login-beheerder/beheerder_gebruiker_bewerk');
			    		
			    		$this->template->load('template/template_master', $partials, $data);
					}
			    }else{
			    	$data['titel'] = 'International Days';
		    	    $data['types'] = $this->type_model->getAllTypes();
		    	    $data['user'] = $user;
		    	    $data['h1'] = "Edit User";
		    		$partials = array('template_menu' => 'login-beheerder/template_menu', 'template_pagina' => 'login-beheerder/beheerder_gebruiker_bewerk');
		    		
		    		$this->template->load('template/template_master', $partials, $data);
				}
    	    }else{
    	    	redirect('/gebruiker');
    	    }
		}
	}
	
	public function remove($id){
		if($this->authex->checkLoginRedirectByType(4)){
			$submit = $this->input->post('submit');
			
		    if($submit == "submit"){
		    	$user = $this->user_model->get($id);
			    
				if(isset($user->id)){
			    	$this->notifications->createNotification("The user <b>$user->voornaam $user->achternaam</b> is succesfully deleted!");
			    	
			    	$user->actief = 0;
			    	$this->user_model->update($user);
				}
				
				redirect('/gebruiker');
		    }else{
		    	$this->load->model('user_model');
		    	
			    $user = $this->user_model->get($id);
			    
				if(isset($user->id)){
					$data['titel'] = 'International Days';
					$data['user'] = $user;
					$partials = array('template_menu' => 'login-beheerder/template_menu', 'template_pagina' => 'login-beheerder/beheerder_gebruiker_verwijder');
					
					$this->template->load('template/template_master', $partials, $data);
				}else{
					redirect('/gebruiker');
				}
			}
		}
	}
	
	public function import(){
		if($this->authex->checkLoginRedirectByType(4)){
			
		}
	}
	
	public function create(){
		if($this->authex->checkLoginRedirectByType(4)){
			$submit = $this->input->post('submit');
			
		    if($submit == "submit"){
		    	$user = new stdClass();
			    $user->voornaam = $this->input->post('voornaam');
			    $user->achternaam = $this->input->post('achternaam');
			    $user->email = $this->input->post('email');
			    $user->gender = $this->input->post('gender');
			    $user->titel = $this->input->post('titel');
			    $user->institutie = $this->input->post('institutie');
			    $user->mobiel = $this->input->post('mobiel');
			    $user->biografie = $this->input->post('biografie');
			    $user->positie = $this->input->post('positie');
			    $user->tmContact = $this->input->post('tmContact');
			    $user->studieGebied = $this->input->post('studieGebied');
			    $user->land = $this->input->post('land');
			    $user->typeId = $this->input->post('typeId');
				
				$insert = $this->user_model->insert($user);
				
				if($insert >= 1){
					$this->notifications->createNotification("The user <b>$user->voornaam $user->achternaam</b> is succesfully created!");
					
					redirect('/gebruiker');
				}else{
					if($insert == -1){
						$this->notifications->createNotification("You must submit at least a first name, last name and email!", "danger", false);
					}else if($insert == -2){
						$this->notifications->createNotification("The email adres is already used by another user!", "danger", false);
					}
					
					$data['titel'] = 'International Days';
		    	    $data['types'] = $this->type_model->getAllTypes();
		    	    $data['user'] = $user;
		    	    $data['h1'] = "New User";
		    		$partials = array('template_menu' => 'login-beheerder/template_menu', 'template_pagina' => 'login-beheerder/beheerder_gebruiker_bewerk');
		    		
		    		$this->template->load('template/template_master', $partials, $data);
				}
		    }else{
		    	$this->load->model('type_model');
		    	
			    $user = new stdClass();
			    $user->voornaam = "";
			    $user->achternaam = "";
			    $user->email = "";
			    $user->gender = 0;
			    $user->titel = "";
			    $user->institutie = "";
			    $user->mobiel = "";
			    $user->biografie = "";
			    $user->positie = "";
			    $user->tmContact = "";
			    $user->studieGebied = "";
			    $user->land = "";
			    $user->typeId = 1;
			    
	    	    $data['titel'] = 'International Days';
	    	    $data['types'] = $this->type_model->getAllTypes();
	    	    $data['user'] = $user;
	    	    $data['h1'] = "New User";
	    		$partials = array('template_menu' => 'login-beheerder/template_menu', 'template_pagina' => 'login-beheerder/beheerder_gebruiker_bewerk');
	    		
	    		$this->template->load('template/template_master', $partials, $data);
			}
		}
	}
}