<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @class Certificates
 * @author Vincent Duchateau
 * 
 * Controller-klasse voor het afdrukken van aanwezigheidscertificaten voor de sprekers.
 */
class Certificates extends CI_Controller {

	public function __construct(){
        parent::__construct();
    }

    /**
     * Zendt de beheerder door naar een pagina met alle aanwezigheidscertificaten. Daarna heeft hij of zij de kans om deze certificaten af te drukken. 
     * 
     * @see login-beheerder/beheerder_certificaten.php
     * @see User_model::getAllUsersSortByName
     * @see Edition_model::getLastEdition
     * @see template_master.php
     * 
     */
    
	public function index(){
        if($this->authex->checkLoginRedirectByType(4)) {
            $this->load->model('user_model');
            $this->load->model('gebruikertype_model');
            $this->load->model('edition_model');

            $data['titel'] = 'Print certificates';
            $users = $this->user_model->getAllUsersSortByName();
            $types = $this->gebruikertype_model->getAllTypes();
            $edition = $this->edition_model->getLastEdition();

            $data['edition'] = $edition;
            $data['verantwoordelijke'] = 'Vincent Duchateau';
            $data['users'] = $users;
            $data['types'] = $types;

            $partials = array('template_menu' => 'login-beheerder/template_menu', 'template_pagina' => 'login-beheerder/beheerder_certificaten');
			$this->template->load('template/template_master', $partials, $data);

        }
    }
}