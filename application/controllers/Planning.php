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

			$data['titel'] = 'Calendar | International Days';
			
			
			$data['edition'] = $this->edition_model->getLastEdition();
			
			
			$data['rows'] = $this->row_model->getByEdition( $data['edition'] );
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
					}
				}
			}
			
			
			$partials = array('template_menu' => 'planning/planning_menu', 'template_pagina' => 'planning/planning_home');
			
		
			
			$this->template->load('template/template_master', $partials, $data);
		}
	}

	public function viewColumn($columnId=null)
	{
		if($columnId == null) die;
		$this->load->model('column_model');
		$this->load->model('session_model');
		$this->load->model('presence_model');


		$data = array();

		$data['column'] = $this->column_model->get($columnId);
		$data['column']->sessie = $this->session_model->get($data['column']->sessieId);
		

		$data['ingeschreven'] = $this->presence_model->isIngeschreven( $data['column']->id, $data['column']->sessie->id);

		$this->load->view('planning/planning_ajax_student.php', $data);
	}
}