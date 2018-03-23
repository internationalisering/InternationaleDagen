<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Authex {
    
    private $userInfo = null;
    
    public function __construct(){
        $CI = & get_instance();
        
        $CI->load->model('user_model');
    }

    function activate($id){
        // nieuwe gebruiker activeren
        $CI = & get_instance();
        
        $CI->user_model->activate($id);
    }

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
    
    function isLoggedIn(){
        // gebruiker is aangemeld als sessievariabele user_id bestaat
        $CI = & get_instance();
        
        if($CI->session->has_userdata('user_id')){
            return true;
        }else{
            return false;
        }
    }
    
    function checkLoginRedirectToHome(){
        if($this->isLoggedIn()){
            redirect('/home/' . strtolower($this->getUserInfo()->type->naam));
            return false;
        }else{
            return true;
        }
    }
    
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
    
    function logout(){
        // afmelden, dus sessievariabele wegdoen
        $CI = & get_instance();
        
        $CI->session->unset_userdata('user_id');
    }
}