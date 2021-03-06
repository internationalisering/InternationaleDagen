<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @class Planning
 * @author Tom Van den Rul
 * 
 * Controller klasse voor het beheren en het bekijken van de planning
 */

class Planning extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
    }
    /**
     * Laat de student, de docent en de spreker de planning bekijken.
     * @author Tom Van den Rul
     * @see login-student/template_menu.php
     * @see login-docent/template_menu.php
     * @see login-spreker/template_menu.php
     * @see Class_model::get
     * @see Row_model::getByEdition
     * @see Session_model::get
     * @see Class_model::get 
     * @see Edition_model::getLastEdition
     * @see Column_model::getByRowId
     * @see User_model::get
     * @see Presence_model::isEnrolled
     * @see Authex 
     * @see template.master
     * 
     */
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

			$data['isDocent'] = $this->authex->isDocent();


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

						// Of kijken of de ingelogde gebruiker hier verplicht aanwezig moet zijn 
						$kolom->verplichteKlasgroepen = $this->classgroup_model->getByColumnId($kolom->id);
						$kolom->verplicht = false;

						$gebruikerKlas = $this->class_model->get($this->authex->getUserInfo()->klasId);
						foreach($kolom->verplichteKlasgroepen as $klasgroep)
						{	
							if($klasgroep = $gebruikerKlas)
								$kolom->verplicht = true;
						}
					}
				}
			}
			
            if($user->typeId = 1){
                $partials = array('template_menu' => 'login-student/template_menu.php', 'template_pagina' => 'planning/planning_home');
            } else if($user->typeId = 2){
                $partials = array('template_menu' => 'login-docent/template_menu.php', 'template_pagina' => 'planning/planning_home');
            } else if($user->typeId = 3){
                $partials = array('template_menu' => 'login-spreker/template_menu.php', 'template_pagina' => 'planning/planning_home');
            }


			$data['verantwoordelijke'] = 'Tom Van den Rul';
			$this->template->load('template/template_master', $partials, $data);
		} else 
		{
			redirect('/home');
			die;
		}
	}

	 /**
     * Laat de student, de docent en de spreker het detailvenster van een activiteit bekijken.
	 * @author Tom Van den Rul
     * @param $columnId is de id van de kolom van waar de gebruiker de details wilt bekijken 
	 * @see Column_model::get
	 * @see Session_model::get
	 * @see Presence_model::getColumnCount
	 * @see Presence_model::isEnrolled
	 * @see Feedback_model::get
	 * @see User_model::get
	 * @see Class_model::get
	 * @see Classgroup_model::getByColumnId
     * @see Authex 
     * @see template.master
     * 
     */
	public function viewColumn($columnId=null)
	{
		if($this->authex->isLoggedIn())
		{
			if($columnId == null) die;

			$this->load->model('column_model');
			$this->load->model('session_model');
			$this->load->model('presence_model');
			$this->load->model('feedback_model');
			$this->load->model('user_model');
			$this->load->model('class_model');
			$this->load->model('classgroup_model');


			$data = array();
			$user = $this->authex->getUserInfo();


			$data['column'] = $this->column_model->get($columnId);
			$data['column']->sessie = $this->session_model->get($data['column']->sessieId);
			

			$data['aantalIngeschreven'] = $this->presence_model->getColumnCount($data['column']->id);

			$data['ingeschreven'] 		= $this->presence_model->isEnrolled( $data['column']->id, $user->id);
	
			
			if($this->authex->isSpreker())
			{
				$this->load->view('planning/planning_ajax_spreker.php', $data);
			}	
			else if($this->authex->isStudent())
			{
				$data['column']->verplichteKlasgroepen = $this->classgroup_model->getByColumnId($data['column']->id);
				$data['column']->verplicht = false;

				$gebruikerKlas = $this->class_model->get($this->authex->getUserInfo()->klasId);
				foreach($data['column']->verplichteKlasgroepen as $klasgroep)
				{	
					if($klasgroep = $gebruikerKlas)
						$data['column']->verplicht = true;
				}


				$data['feedback'] = $this->feedback_model->get($data['column']->sessie->id, $user->id);
				$this->load->view('planning/planning_ajax_student.php', $data);
			} else if($this->authex->isDocent())
			{
				$data['ingeschrevenStudenten'] =array();

				foreach($this->presence_model->getEnrolledStudents($data['column']->id) as $studentId)
				{
					$student = $this->user_model->get($studentId);

					$data['ingeschrevenStudenten'][] = $student->achternaam . " " . $student->voornaam;
				}


				$this->load->view('planning/planning_ajax_docent.php', $data);
			}
		}
	}	 


	 /**
     * Haalt de gegevens van een bepaalde sessie op zoals taal, studiegebied, auteur ... Print vervolgens een JSON object uit. Deze methode dient voor Ajax calls te maken vanuit javascript.
 	 * @author Tom Van den Rul
     * @param $sessionId is de id van de kolom van waar de gebruiker de details wilt bekijken 
	 * @see Session_model::get
	 * @see User_model::get
	 * @see Language_model::get
     * @see Authex 
     * @see template.master
     * 
     */
	public function getSessionInfo($sessionId = null)
	{
		if(!$this->authex->isLoggedIn() || !$this->authex->isBeheerder())
			die;
		

		if($sessionId)
		{
			$sessionId = (int)$sessionId;
			if($sessionId)
			{
				// Alle models laden
				$this->load->model('session_model');
				$this->load->model('user_model');
				$this->load->model('language_model');

				// Sessie zoeken
				$session = $this->session_model->get( $sessionId );
				if(!$session)
					die(json_encode(array()));

				// Taal invullen
				$session->taal = $this->language_model->get( $session->taalId );

				// Gebruiker invullen
				$gebruiker = $this->user_model->get($session->gebruikerId);

				// Wachtwoorden enz niet mee in stdClass mee versturen. Enkel relevante informatie.
				$session->gebruiker = new stdClass();
				$session->gebruiker->voornaam   = $gebruiker->voornaam;
				$session->gebruiker->achternaam = $gebruiker->achternaam;
				

				echo json_encode($session);
			}
		}
	}

	/**
     * Toont een modal voor de hulpfunctie van de planning.
	 * @author Tom Van den Rul
     * @see Authex 
     * @see template.master
     */
	public function help()
	{
		if($this->authex->isLoggedIn())
			$this->load->view('planning/planning_help.php', array());
	}

	/**
     * Toont een modal voor de hulpfunctie van de planning.
	 * @author Tom Van den Rul
	 * @param $status - wanneer deze true is, wordt de database aangepast. Anders wordt er een bevestigingspagina getoond.
     * @see Authex 
     * @see template.master
     */
    public function markAsDefinitive($status = false)
	{
		if($this->authex->isLoggedIn() && $this->authex->isBeheerder())
		{
			if($status)
			{
				$this->load->model('edition_model');
				$edition = $this->edition_model->getLastEdition();

				$this->edition_model->setPlanned($edition->id, true);
			}			
			$this->load->view('planning/planning_ajax_beheerder_definitive.php', array('planned'=>$status));

		}
	}

	/**
     * Via een Ajax /call wordt deze methode opgeroepen. Er wordt een json object meegegeven met daarin de planning.
	 * @author Tom Van den Rul
	 * @see Row_model::getByDate
	 * @see Column_model::getByRowId
	 * @see Column_model::deleteById
	 * @see Classgroup_model::deleteByColumnId
	 * @see Row_model:::deleteByColumnId
	 * @see Presence_model::deleteByColumnId
	 * @see Column_model::insert
     * @see Classgroup_model::insert
     * @see Presence_model::insert
     * @see Authex 
     * @see template.master
     */

	public function editSave()
	{
		$this->load->model('row_model');
		$this->load->model('column_model');
		$this->load->model('edition_model');
		$this->load->model('presence_model');
		$this->load->model('classgroup_model');

		// Ophalen gegevens
		$planning = $this->input->post('planning');
		if(!$planning) die;

		$planning = (array)json_decode($planning, true);

		if(isset($planning['date']))
		{
			$date = $planning['date'];
			$edition = $this->edition_model->getLastEdition();

			// Stap 1: alle rijen/velden etc clearen op deze dag
			// Eerst de rij id's verkregen met deze datum
			// Daarna alle aanwezigheden met deze id's verwijderen
			// Daarna alle mandatory klasgroepen met deze id's verwijderen
			// Daarna de kolom verwijderen
			// Daarna de rij verwijderen 
			$rows = $this->row_model->getByDate($edition, $date );
			foreach($rows as $row)
			{
				$columns = $this->column_model->getByRowId($row->id);

				foreach($columns as $column)
				{
					
					$this->presence_model->deleteByColumnId($column->id);
					$this->classgroup_model->deleteByColumnId($column->id);

					$this->column_model->deleteById($column->id);
				}
				$this->row_model->deleteById($row->id);
			}
			// Stap 2: alle rijen toevoegen in de database

			foreach($planning['rows'] as $row)
			{
				$from = $row['from'];
				$til  = $row['til' ];

				if(trim($from) == '' || $from == '00:00')
					$from = '23:59';
				if(trim($til) == '' || $til == '00:00')
					$til = '23:59';


				$rowAdd = new stdClass();
				$rowAdd->starttijd = "$date $from";
				$rowAdd->eindtijd  = "$date $til";
				$rowAdd->editieId  = $edition->id;

				$rowId = $this->row_model->insert($rowAdd);
				// Rij is nu toegevoegd. Nu alle tiles toevoegen.

				foreach($row['columns'] as $column)
				{
					$columnAdd = new stdClass();
					
					$columnAdd->planningRijId = $rowId;

					if(isset($column['sessionId']) && (int)$column['sessionId'] != 0)
						$columnAdd->sessieId = (int)$column['sessionId'];

					if(isset($column['maxHoeveelheid']))
					{
						$columnAdd->maxHoeveelheid = (int)$column['maxHoeveelheid'];
					}

					if($column['type'] == 'break')
					{
						$columnAdd->pauze = " " . $column['break'] ;
					}


					$columnAdd->id = $this->column_model->insert($columnAdd);


					// Voeg de klasgroepen toe 
					if(isset($column['allowedClasses']))
						foreach($column['allowedClasses'] as $allowedClass)
						{
							$classgroup = new stdClass();
							$classgroup->planningKolomId = $columnAdd->id;
							$classgroup->klasId = $allowedClass;

							$this->classgroup_model->insert($classgroup);
						}

					// Voeg aanwezigen toe 
					if(isset($column['aanwezigheden']))
						foreach($column['aanwezigheden'] as $aanwezigheid)
						{	
						
							$aanwezigheid2 = new stdClass();
							$aanwezigheid2->planningKolomId = $columnAdd->id;
							$aanwezigheid2->gebruikerId = $aanwezigheid['gebruikerId'];
							$aanwezigheid2->surveillant = $aanwezigheid['surveillant'];
							$aanwezigheid2->geselecteerd = $aanwezigheid['geselecteerd'];

							$this->presence_model->insert($aanwezigheid2);

						}
				}
			}
		}
	}
	/**
     * Via deze pagina kan de beheerder de planning bewerken
	 * @author Tom Van den Rul
	 * @param $datum geeft mee welke datum de beheerder wilt aanpassen
	 * @see Row_model::getByDate
	 * @see Edition_model::getLastEdition
	 * @see Row_model::getByEdition
	 * @see Class_model::get
	 * @see Classgroup::getByColumnId
	 * @see Column_model::getByRowId
	 * @see Session_model::get
	 * @see Presence_model::getEnrolledStudents
	 * @see Presence_model::getEnrolledStatus
	 * @see User
     * @see Authex 
     * @see template.master
     */
	public function edit($datum = null)
	{
		if($this->authex->isLoggedIn() && $this->authex->isBeheerder())
		{
			$this->load->model('edition_model');
			$this->load->model('class_model');
			$this->load->model('classgroup_model');
			$this->load->model('row_model');
			$this->load->model('session_model');
			$this->load->model('column_model');
			$this->load->model('user_model');
			$this->load->model('presence_model');


			$data['titel'] = 'International Days';
			$data['editie'] = $this->edition_model->getLastEdition();
			$data['huidigeDatum'] = $data['editie']->startdatum;
			$data['verantwoordelijke'] = 'Tom Van den Rul';

			if($datum)
			{
				$geldigeDatum = explode('-', $datum);
				if(checkdate($geldigeDatum[1], $geldigeDatum[2], $geldigeDatum[0]))
				{
					$data['huidigeDatum'] = $datum;
				}
			}



			// Alle kolommen
			$data['rows'] = $this->row_model->getByEdition( $data['editie'] );


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

						$aanwezigheden = $this->presence_model->getEnrolledStudents($kolom->id);
						$kolom->aanwezigheden = array();
						foreach($aanwezigheden as $aanwezigheid)
						{
							$gebruiker = $this->presence_model->getEnrolledStatus($kolom->id, $aanwezigheid);
							$gebruiker->naam = $this->user_model->get($aanwezigheid)->voornaam . ' ' .  $this->user_model->get($aanwezigheid)->achternaam; 
							$kolom->aanwezigheden[] = $gebruiker;		
						}


						// Voor elke sessie de gebruiker ophalen 
						$kolom->session->gebruiker = $this->user_model->get($kolom->session->gebruikerId);

						$kolom->session->klasgroepen = $this->classgroup_model->getByColumnId($kolom->id);	
						
						foreach($kolom->session->klasgroepen as $klasgroep)
						{
							$klasgroep->klas = $this->class_model->get($klasgroep->klasId);
						}					
					}
				}
				
			}
			
			

			$partials = array('template_menu' => 'login-beheerder/template_menu', 'template_pagina' => 'planning/planning_edit.php');

			$this->template->load('template/template_master', $partials, $data);
			
		} else 
		{
			redirect('/home');
			die;
		}

	}
	/**
     * Via deze methode kan een student/docent zich inschrijven als respectievelijk iemand die lezing bijwoont of als surveillant
	 * @author Tom Van den Rul
	 * @param $columnId geeft mee welke kolom de student/docent zich mee wilt inschrijven
	 * @see Presence_model::isEnrolled
	 * @see Presence_model::enroll
	 * @see User
     * @see Authex 
     * @see template.master
     */
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

				$this->presence_model->enroll($columnId, $user->id, $this->authex->isDocent());
				die("1");
			}
		}
	}
	/**
     * Via deze methode kan een student/docent zich uitschrijven als respectievelijk iemand die lezing bijwoont of als surveillant
	 * @author Tom Van den Rul
	 * @param $columnId geeft mee welke kolom de student/docent zich mee wilt uitschrijven
	 * @see Presence_model::enroll
	 * @see User
     * @see Authex 
     * @see template.master
     */

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
	/**
     * Via deze methode kan een student feedback geven op een lezing
	 * @author Tom Van den Rul
	 * @param $sessionId geeft mee welke sessie de student feedback voor wilt geven
	 * @see Feedback_model::set
	 * @see Feedback_model::clear
	 * @see User
     * @see Authex 
     * @see template.master
     */
	public function feedback($sessionId)
	{
		if($this->authex->isLoggedIn() && $this->authex->isStudent())
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
				} else {
					$this->feedback_model->clear($sessionId, $userId);
				}
			}
		}  
	}
	/**
     * Via deze methode krijgt de beheerder het juiste scherm te zien bij het bewerken van een activiteit. 
	 * @author Tom Van den Rul
	 * @param $isBreak duidt aan of het een pauze is of een activiteit
	 * @param $breakReason duidt aan wat de reden van pauze is, indien van toepassing.
	 * @see Class_model::getAll
	 * @see User
     * @see Authex 
     * @see template.master
     */
	public function editColumn($isBreak=false, $breakReason = "")
	{
		if($this->authex->isLoggedIn() && $this->authex->isBeheerder())
		{
			$data = array();
			$this->load->model('class_model');

			$data['classes'] = 		$this->class_model->getAll();
			$data['breakReason'] =  $breakReason;
			

			if( $isBreak == 'true')
				$this->load->view('planning/planning_ajax_beheerder_break.php', $data);
			else 
				$this->load->view('planning/planning_ajax_beheerder.php', $data);
		}

	}

	public function search($keyword='')
	{
		// Alle models laden
		$this->load->model('session_model');
		$this->load->model('user_model');


		$sessions = $this->session_model->search($keyword, true, array('titel') );
		foreach($sessions as $session)
		{
			$gebruiker = $this->user_model->get($session->gebruikerId);
			$session->gebruiker = new stdClass();
			//var_dump($gebruiker);
			$session->gebruiker->voornaam = $gebruiker->voornaam;
			$session->gebruiker->achternaam = $gebruiker->achternaam;
		}

		echo json_encode($sessions);

		//var_dump($sessions);
	}

}
