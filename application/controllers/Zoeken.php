<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @class Zoeken
 * @author Brend Simons
 * 
 * Controller-klasse voor het zoeken in alle tabellen
 */
class Zoeken extends CI_Controller {

	public function __construct(){
        parent::__construct();
    }
	
	public function index(){
		if($this->authex->checkLoginRedirectByType(4)){
		    $data['titel'] = 'International Days';
			$data['verantwoordelijke'] = 'Brend Simons';
			$partials = array('template_menu' => 'login-beheerder/template_menu', 'template_pagina' => 'login-beheerder/beheerder_zoeken.php');
			
			$this->template->load('template/template_master', $partials, $data);
		}
	}
	
	public function zoek(){
		if($this->authex->checkLoginRedirectByType(4)){
			$data['models'] = $this->search($this->input->get("text"), $this->input->get("previousEditions") == "1");
			
			$this->load->view('login-beheerder/beheerder_zoeken_resultaten.php', $data);
		}
	}
	
	private function search($text, $previousEditions){
		$models = array(
			array(
				"name" => "Edition",
				"modelName" => "edition_model",
				"url" => base_url() . "/home/homepagina_view/{id}",
				"columns" => array(
					"maxHoeveelheid",
					"homepagina"
				),
				"text" => "
					<h3><a href='{url}'>{startdatum} / {einddatum}</a> <span class='badge badge-secondary'>{modelName}</span></h3>
					<p>
						<b>Max amount of students</b>: {maxHoeveelheid}
					</p>
				"
			),
			array(
				"name" => "User Type",
				"modelName" => "gebruikerType_model",
				"url" => base_url() . "/blabla/blabla/{id}", // <-----------------------------------------------------------
				"columns" => array(
					"naam"
				),
				"text" => "
					<h3><a href='{url}'>{naam}</a> <span class='badge badge-secondary'>{modelName}</span></h3>
				"
			),
			array(
				"name" => "User",
				"modelName" => "user_model",
				"url" => base_url() . "/gebruiker/view/{id}",
				"columns" => array(
					"voornaam",
					"achternaam",
					"email",
					"titel",
					"institutie",
					"mobiel",
					"biografie",
					"positie",
					"tmContact",
					"studieGebied",
					"land"
				),
				"text" => "
					<h3><a href='{url}'>{voornaam} {achternaam}</a> <span class='badge badge-secondary'>{modelName}</span></h3>
					<p>
						<b>Title</b>: {titel}<br>
						<b>Email</b>: {email}<br>
						<b>Institution</b>: {institutie}<br>
						<b>Study Field</b>: {studieGebied}
					</p>
				"
			),
			array(
				"name" => "Class",
				"modelName" => "class_model",
				"url" => base_url() . "/blabla/blabla/{id}", // <-----------------------------------------------------------
				"columns" => array(
					"klasgroep"
				),
				"text" => "
					<h3><a href='{url}'>{klasgroep}</a> <span class='badge badge-secondary'>{modelName}</span></h3>
				"
			),
			array(
				"name" => "Email Templates",
				"modelName" => "mailtype_model",
				"url" => base_url() . "/email/edit/{id}",
				"columns" => array(
					"naam",
					"inhoud",
					"onderwerp"
				),
				"text" => "
					<h3><a href='{url}'>{naam}</a> <span class='badge badge-secondary'>{modelName}</span></h3>
					<p>
						<b>Subject</b>: {onderwerp}
					</p>
				"
			),
			array(
				"name" => "Session",
				"modelName" => "session_model",
				"url" => base_url() . "/gebruiker/view/{gebruikerId}",
				"columns" => array(
					"titel",
					"inhoud",
					"studieGebied"
				),
				"text" => "
					<h3><a href='{url}'>{titel}</a> <span class='badge badge-secondary'>{modelName}</span></h3>
					<p>
						<b>Study Field</b>: {studieGebied}<br>
						<b>Content</b>: {inhoud}
					</p>
				"
			),
			array(
				"name" => "Language",
				"modelName" => "language_model",
				"url" => base_url() . "/blabla/blabla/{id}", // <-----------------------------------------------------------
				"columns" => array(
					"naam"
				),
				"text" => "
					<h3><a href='{url}'>{naam}</a> <span class='badge badge-secondary'>{modelName}</span></h3>
				"
			),
			array(
				"name" => "Wish Question",
				"modelName" => "wishquestion_model",
				"url" => base_url() . "/wensen/beheer",
				"columns" => array(
					"naam"
				),
				"text" => "
					<h3><a href='{url}'>{naam}</a> <span class='badge badge-secondary'>{modelName}</span></h3>
				"
			)
		);
		
		foreach($models as &$model){
			$modelName = $model['modelName'];
			
			$this->load->model($modelName);
			$model['results'] = $this->$modelName->search($text, $previousEditions, $model['columns']);
		}
		
		return $models;
	}
}