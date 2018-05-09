<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @class Home
 * @author Brend Simons
 * 
 * Controller-klasse voor het bekijken van de homepagina voor elke gebruiker
 */
class Home extends CI_Controller {

	public function __construct(){
        parent::__construct();
    }
    
    /**
     * Toont de homepagina van een gebruiker die niet ingelogd is. Als de gebruiker werl ingelogd is, zal deze doorverwezen worden naar een andere homepagina.
     * 
     * @see logout_home.php
     * @see logout/template_menu.php
     * @see Edition_model::getLastEdition
     * @see Authex
     * @see template.master.php
     */
	public function index(){
		if($this->authex->checkLoginRedirectToHome()){
			$this->load->model('edition_model');

			$data['titel'] = 'International Days';
			$data['edition'] = $this->edition_model->getLastEdition();
			$data['verantwoordelijke'] = 'Brend Simons';
			$partials = array('template_menu' => 'logout/template_menu',
			'template_pagina' => 'logout/logout_home');

			$this->template->load('template/template_master', $partials, $data);
		}
	}
	
	/**
     * Toont de homepagina van een student die ingelogd is.
     * 
     * @see student_home.php
     * @see login-student/template_menu.php
     * @see Authex
     * @see template.master.php
     */
	public function student(){
		if($this->authex->checkLoginRedirectByType(1)){
			$data['titel'] = 'International Days';
			$partials = array('template_menu' => 'login-student/template_menu', 'template_pagina' => 'login-student/student_home');

			$this->template->load('template/template_master', $partials, $data);
		}
	}
	
	/**
     * Toont de homepagina van een docent die ingelogd is.
     * 
     * @see docent_home.php
     * @see login-docent/template_menu.php
     * @see Authex
     * @see template.master.php
     */
	public function docent(){
		if($this->authex->checkLoginRedirectByType(2)){
			$data['titel'] = 'International Days';
			$partials = array('template_menu' => 'login-docent/template_menu', 'template_pagina' => 'login-docent/docent_home');

			$this->template->load('template/template_master', $partials, $data);
		}
	}
	
	/**
     * Toont de homepagina van een spreker die ingelogd is.
     * 
     * @see spreker_home.php
     * @see login-spreker/template_menu.php
     * @see Authex
     * @see template.master.php
     */
	public function spreker(){
		if($this->authex->checkLoginRedirectByType(3)){
			$data['titel'] = 'International Days';
			$partials = array('template_menu' => 'login-spreker/template_menu', 'template_pagina' => 'login-spreker/spreker_home');

			$this->template->load('template/template_master', $partials, $data);
		}
	}
	
	/**
     * Toont de homepagina van een beheerder die ingelogd is.
     * 
     * @see beheerder_home.php
     * @see login-beheerder/template_menu.php
     * @see Authex
     * @see template.master.php
     */
	public function beheerder(){
		if($this->authex->checkLoginRedirectByType(4)){
			$data['titel'] = 'International Days';
			$partials = array('template_menu' => 'login-beheerder/template_menu', 'template_pagina' => 'login-beheerder/beheerder_home');

			$this->template->load('template/template_master', $partials, $data);
		}
	}

	public function homepagina_lijst() {
		if($this->authex->checkLoginRedirectByType(4)){
			$this->load->model('edition_model');

			$data['titel'] = 'Lijst van edities';

			$data['edition'] = $this->edition_model->getAllEditions();
			$data['verantwoordelijke'] = 'Vincent Duchateau';

			$partials = array('template_menu' => 'login-beheerder/template_menu',
			'template_pagina' => 'login-beheerder/beheerder_editie_lijst');

			$this->template->load('template/template_master', $partials, $data);
		}
	}

	public function homepagina_view($id) {
	    if($this->authex->checkLoginRedirectByType(4)){
			$this->load->model('edition_model');
			$edition = $this->edition_model->get($id);

			$data['edition'] = $edition;
			$data['titel'] = 'Editie bewerken';
			$data['verantwoordelijke'] = 'Vincent Duchateau';

			$partials = array('template_menu' => 'login-beheerder/template_menu',
			'template_pagina' => 'login-beheerder/homepagina_bewerk_home');

			$this->template->load('template/template_master', $partials, $data);
		}
	}

	public function homepagina_update() {
		if($this->authex->checkLoginRedirectByType(4)){
			$this->load->model('edition_model');

			$data = array();
			$data['homepagina'] = trim($this->input->post('homepagina'));
			$data['editionID'] = $this->input->post('edition');

			$this->edition_model->wijzigPagina($data['editionID'], $data['homepagina']);

			$this->load->view('login-beheerder/homepagina_bewerk_succes.php', $data);
		}
	}

	public function editieToevoegen() {
		new StdClass();

		
	}
	
}
