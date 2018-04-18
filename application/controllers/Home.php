<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
        parent::__construct();
    }

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

	public function student(){
		if($this->authex->checkLoginRedirectByType(1)){
			$data['titel'] = 'International Days';
			$partials = array('template_menu' => 'login-student/template_menu', 'template_pagina' => 'login-student/student_home');

			$this->template->load('template/template_master', $partials, $data);
		}
	}

	public function docent(){
		if($this->authex->checkLoginRedirectByType(2)){
			$data['titel'] = 'International Days';
			$partials = array('template_menu' => 'login-docent/template_menu', 'template_pagina' => 'login-docent/docent_home');

			$this->template->load('template/template_master', $partials, $data);
		}
	}

	public function spreker(){
		if($this->authex->checkLoginRedirectByType(3)){
			$data['titel'] = 'International Days';
			$partials = array('template_menu' => 'login-spreker/template_menu', 'template_pagina' => 'login-spreker/spreker_home');
			
			$this->template->load('template/template_master', $partials, $data);
		}
	}

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

			$partials = array('template_menu' => 'login-beheerder/homepagina_bewerk_menu',
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

			$data['homepagina'] = $this->input->post('homepagina');

			$this->load->view('login-beheerder/homepagina_bewerk_succes.php', $data);

		}
	}
}
