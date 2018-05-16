<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * @class Authex
 * @author Brend Simons
 * 
 * Authex library
 */
class Authex {
    
    private $userInfo = null;
    
    public function __construct(){
        $CI = & get_instance();
        
        $CI->load->model('user_model');
    }
    
    /**
     * Activeerd een gebruiker
     * 
     * @param id Id van de gebruiker die geactiveerd moet worden.
     * @see User_model::activate
     */
    function activate($id){
        // nieuwe gebruiker activeren
        $CI = & get_instance();
        
        $CI->user_model->activate($id);
    }
    
    /**
     * Haalt alle data op van de ingelogde gebruiker
     * 
     * @return Object met data van de ingelogde gebruiker
     */
    function getUserInfo(){
        // geef gebruiker-object als gebruiker aangemeld is
        $CI = & get_instance();
        
        if($this->userInfo != null){
            return $this->userInfo;
        }
        
        if(!$this->isLoggedIn()){
            return null;
        }else{
            $id = $CI->session->userdata('user_id');
            $this->userInfo =  $CI->user_model->get($id);
            return $this->userInfo;
        }
    }
    
    /**
     * Checkt ofdat de gebruiker is ingelogd.
     * 
     * @return Boolean met ofdat de gebruiker is ingelogd of niet.
     */
    function isLoggedIn(){
        // gebruiker is aangemeld als sessievariabele user_id bestaat
        $CI = & get_instance();
        
        if($CI->session->has_userdata('user_id')){
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * Stuur de gebruiker door naar de homepagina wanneer de gebruiker ingelogd is.
     * 
     * @return Boolean met ofdat de gebruiker is ingelogd of niet.
     */
    function checkLoginRedirectToHome(){
        if($this->isLoggedIn()){
            redirect('/home/' . strtolower($this->getUserInfo()->type->naam));
            return false;
        }else{
            return true;
        }
    }
    
    /**
     * Stuur de gebruiker door naar de login pagina of een 404 pagina wanneer de gebruiker niet ingelogd is als de juiste gebruiker.
     * 
     */
    function checkLoginRedirectByType($typeId = NULL){
        if($this->isLoggedIn()){
            if(count(func_get_args()) == 0){
                return true;
            }else{
                if(in_array($this->getUserInfo()->typeId, func_get_args())){
                    return true;
                }else{
                    show_404();
                }
            }
        }else{
            redirect('/login');
        }
    }
    
    /**
     * Probeer de gebruiker in te loggen door middel van een email en wachtwoord.
     * 
     * @param email Email adres van de gebruiker.
     * @param password Wachtwoord van de gebruiker.
     * @see User_model::getUser
     * @see User_model::updateLastLogin
     * @return 1 als de login succesvol is, -1 als de gebruiker niet gevonden is en -2 wanneer de gebruiker nog niet geactiveerd is.
     */
    function login($email, $password){
        // gebruiker aanmelden met opgegeven email en wachtwoord
        $CI = & get_instance();
        
        $user = $CI->user_model->getUser($email, $password);
        
        if($user == null){
            return -1;
        }else if($user->actief == 0){
            return -2;
        }else{
            $CI->user_model->updateLastLogin($user->id);
            $CI->session->set_userdata('user_id', $user->id);
            return 1;
        }
    }
    
    /**
     * Logt de gebruiker uit.
     * 
     */
    function logout(){
        // afmelden, dus sessievariabele wegdoen
        $CI = & get_instance();
        
        $CI->session->unset_userdata('user_id');
    }
    
    /**
     * Check ofdat de gebruiker een student is.
     */
    function isStudent(){
        $CI = & get_instance();
        return $this->getUserInfo()->typeId == 1;
    }
    
    /**
     * Check ofdat de gebruiker een docent is.
     */
    function isDocent(){
        $CI = & get_instance();
        return $this->getUserInfo()->typeId == 2;
    }
    
    /**
     * Check ofdat de gebruiker een spreker is.
     */
    function isSpreker(){
        $CI = & get_instance();
        return $this->getUserInfo()->typeId == 3;
    }
    
    /**
     * Check ofdat de gebruiker een beheerder is.
     */
    function isBeheerder(){
        $CI = & get_instance();
        return $this->getUserInfo()->typeId == 4;
    }
}