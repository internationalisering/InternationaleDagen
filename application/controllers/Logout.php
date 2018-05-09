<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @class Logout
 * @author Brend Simons
 * 
 * Controller-klasse voor het uitloggen
 */
class Logout extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
    }
	
	/**
     * De gebruiker wordt uitgelogd. De gebruiker wordt doorgestuurd naar de homepagina.
     * 
     * @see Authex::logout
     * @see Authex
     * @see template.master.php
     */
	public function index(){
		$this->authex->logout();
		
		redirect('/');
	}
}