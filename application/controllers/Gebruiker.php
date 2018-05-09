<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @class Gebruiker
 * @author Brend Simons
 * 
 * Controller-klasse voor het beheren en bekijken van gebruikers
 */
class Gebruiker extends CI_Controller {

	public function __construct(){
        parent::__construct();
    }
    
    /**
     * Laat de beheerder een lijst zien van alle gebruikers. Deze worden opgehaalt via getAllUsers().
     * 
     * @see beheerder_gebruiker_lijst.php
     * @see login-beheerder/template_menu.php
     * @see User_model::getAllUsers
     * @see Authex
     * @see template.master.php
     */
	public function index(){
		if($this->authex->checkLoginRedirectByType(4)){
		    $this->load->model('user_model');

			$data['titel'] = 'International Days';
			$data['users'] = $this->user_model->getAllUsers();
			$partials = array('template_menu' => 'login-beheerder/template_menu', 'template_pagina' => 'login-beheerder/beheerder_gebruiker_lijst');

			$this->template->load('template/template_master', $partials, $data);
		}
	}
	
	/**
     * Laat de beheerder een gebruiker bekijken.
     * 
     * @param id Het id van de gebruiker die bekeken moet worden.
     * @see beheerder_gebruiker_bekijk.php
     * @see login-beheerder/template_menu.php
     * @see User_model::get
     * @see WishQuestion_model::getAllQuestionsVisibleWithAllQuestionAnswers
     * @see WishAnswer_model::getAnswersByUser
     * @see Session_model::getAllSessionsByUser
     * @see Authex
     * @see template.master.php
     */
	public function view($id){
	    if($this->authex->checkLoginRedirectByType(4)){
		    $this->load->model('user_model');
		    $this->load->model('wishquestion_model');
		    $this->load->model('wishanswer_model');
		    $this->load->model('session_model');
		    
		    $user = $this->user_model->get($id);

    	    if(isset($user->id)){
    	    	$data['titel'] = 'International Days';
	    	    $data['user'] = $user;
	    	    $data['wishQuestions'] = $this->wishquestion_model->getAllQuestionsVisibleWithAllQuestionAnswers();
				$data['myAnswers'] = $this->wishanswer_model->getAnswersByUser($id);
				$data['lectures'] = $this->session_model->getAllSessionsByUser($id);
	    		$partials = array('template_menu' => 'login-beheerder/template_menu', 'template_pagina' => 'login-beheerder/beheerder_gebruiker_bekijk');

	    		$this->template->load('template/template_master', $partials, $data);
    	    }else{
    	    	redirect('/gebruiker');
    	    }
		}
	}
	
	/**
     * Laat de beheerder een gebruiker bewerken.
     * 
     * @param id Het id van de gebruiker die bewerkt moet worden.
     * @see beheerder_gebruiker_bewerk.php
     * @see login-beheerder/template_menu.php
     * @see User_model::get
     * @see User_model::update
     * @see GebruikerType_model::getAllTypes
     * @see Authex
     * @see template.master.php
     */
	public function edit($id){
		if($this->authex->checkLoginRedirectByType(4)){
		    $this->load->model('user_model');
		    $this->load->model('gebruikertype_model');

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
			    	    $data['types'] = $this->gebruikertype_model->getAllTypes();
			    	    $data['user'] = $user;
			    	    $data['h1'] = "New User";
			    		$partials = array('template_menu' => 'login-beheerder/template_menu', 'template_pagina' => 'login-beheerder/beheerder_gebruiker_bewerk');

			    		$this->template->load('template/template_master', $partials, $data);
					}
			    }else{
			    	$data['titel'] = 'International Days';
		    	    $data['types'] = $this->gebruikertype_model->getAllTypes();
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
	
	/**
     * Laat de beheerder een gebruiker verwijderen.
     * 
     * @param id Het id van de gebruiker die verwijderd moet worden.
     * @see beheerder_gebruiker_verwijder.php
     * @see login-beheerder/template_menu.php
     * @see User_model::get
     * @see User_model::update
     * @see Authex
     * @see template.master.php
     */
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

	/**
     * Laat de beheerder gebruikers importeren vanuit een csv.
     * 
     * @see beheerder_gebruiker_import.php
     * @see login-beheerder/template_menu.php
     * @see Csv_model::get_gebruikers
     * @see GebruikerType_model::getAllTypes
     * @see Authex
     * @see template.master.php
     */
	public function import(){
		if($this->authex->checkLoginRedirectByType(4)){
			$this->load->model('csv_model');
			$this->load->model('gebruikertype_model');

			$data['titel'] = 'International Days';
			$data['h1'] = 'Please upload a file in CSV format';

			$data['gebruiker'] = $this->csv_model->get_gebruikers();
			$data['type'] = $this->gebruikertype_model->getAllTypes();

			$partials = array('template_menu' => 'login-beheerder/template_menu', 'template_pagina' => 'login-beheerder/beheerder_gebruiker_import');

	    	$this->template->load('template/template_master', $partials, $data);
		}
	}
	
	/**
     * Laat de beheerder een gebruiker toevoegen.
     * 
     * @see beheerder_gebruiker_bewerk.php
     * @see login-beheerder/template_menu.php
     * @see User_model::insert
     * @see GebruikerType_model::getAllTypes
     * @see Authex
     * @see template.master.php
     */
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
		    	    $data['types'] = $this->gebruikertype_model->getAllTypes();
		    	    $data['user'] = $user;
		    	    $data['h1'] = "New User";
		    		$partials = array('template_menu' => 'login-beheerder/template_menu', 'template_pagina' => 'login-beheerder/beheerder_gebruiker_bewerk');

		    		$this->template->load('template/template_master', $partials, $data);
				}
		    }else{
		    	$this->load->model('gebruikertype_model');

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
	    	    $data['types'] = $this->gebruikertype_model->getAllTypes();
	    	    $data['user'] = $user;
	    	    $data['h1'] = "New User";
	    		$partials = array('template_menu' => 'login-beheerder/template_menu', 'template_pagina' => 'login-beheerder/beheerder_gebruiker_bewerk');

	    		$this->template->load('template/template_master', $partials, $data);
			}
		}
	}
}
