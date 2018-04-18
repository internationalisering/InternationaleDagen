<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Planning extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
    }
    
	public function index(){
		if($this->authex->isLoggedIn()){
			$this->load->model('class_model');
			$this->load->model('classgroup_model');
			$this->load->model('row_model');
			$this->load->model('session_model');
			$this->load->model('class_model');
			$this->load->model('edition_model');
			$this->load->model('column_model');
			$this->load->model('user_model');
			$this->load->model('presence_model');

			$data['titel'] = 'Calendar | International Days';
			$data['edition'] = $this->edition_model->getLastEdition();
			$data['rows'] = $this->row_model->getByEdition( $data['edition'] );


			$user = $this->authex->getUserInfo();


			foreach($data['rows'] as $row)
			{
				 // alle kolommen ophalen
				$row->columns = $this->column_model->getByRowId($row->id);
				  
				// Voor elke kolom de sessie ophalen, indien deze ingevuld is
				foreach($row->columns as $kolom)
				{
					if($kolom->sessieId != null)
					{
						$kolom->session = $this->session_model->get($kolom->sessieId);

						// Voor elke sessie de gebruiker ophalen 
						$kolom->session->gebruiker = $this->user_model->get($kolom->session->gebruikerId);

						// Voor elke sessie kijken of de ingelogde gebruiker ingeschreven is voor deze sessie
						$kolom->ingeschreven = $this->presence_model->isEnrolled($kolom->id, $user->id);

					}
				}
			}
			
			
			$partials = array('template_menu' => 'login-student/template_menu.php', 'template_pagina' => 'planning/planning_home');
			$data['verantwoordelijke'] = 'Tom Van den Rul';
			$this->template->load('template/template_master', $partials, $data);
		} else die('Niet ingelogd');
	}

	public function viewColumn($columnId=null)
	{
		if($this->authex->isLoggedIn())
		{
			if($columnId == null) die;
			$this->load->model('column_model');
			$this->load->model('session_model');
			$this->load->model('presence_model');
			$this->load->model('feedback_model');


			$data = array();
			$user = $this->authex->getUserInfo();



			$data['column'] = $this->column_model->get($columnId);
			$data['column']->sessie = $this->session_model->get($data['column']->sessieId);
			

			$data['ingeschreven'] 		= $this->presence_model->isEnrolled( $data['column']->id, $user->id);
			$data['aantalIngeschreven'] = $this->presence_model->getColumnCount($data['column']->id);

			$data['feedback'] 			= $this->feedback_model->get($data['column']->sessie->id, $user->id);
			$this->load->view('planning/planning_ajax_student.php', $data);
		}
	}

	public function enroll($columnId=null)
	{
		$this->load->model('presence_model');

		if($this->authex->isLoggedIn())
		{
			$user = $this->authex->getUserInfo();
			
			if($this->presence_model->isEnrolled($columnId, $user->id))
			{
				die("0");

			} else 
			{
				// Hier nog nakijken of student zich wel mag inschrijven !!

				$this->presence_model->enroll($columnId, $user->id);
				die("1");


			}



		}
	}

	public function withdraw($columnId)
	{
		$this->load->model('presence_model');

		if($this->authex->isLoggedIn())
		{
			$user = $this->authex->getUserInfo();

			$this->presence_model->withdraw($columnId, $user->id);
			die("1");
		}
	}

	public function feedback($sessionId)
	{



		$userId = $this->authex->getUserInfo()->id;
		$this->load->model('feedback_model');
		if($this->authex->isLoggedIn())
		{
			$feedback = $this->input->post('feedback');
			
			if($feedback != null && trim($feedback) != "")
			{
				$this->feedback_model->set($sessionId, $userId, $feedback);
				die($feedback);
			} else 
				$this->feedback_model->clear($sessionId, $userId);


			

		}  
			
	}
}
