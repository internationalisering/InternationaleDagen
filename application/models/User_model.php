<?php
/**
 * @class User_model
 * Model-klasse voor alle users (gebruikers)
 */
class User_model extends CI_Model {
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
    }
    /**
     * Geeft terug de gebruiker met id=$id uit de tabel gebruiker
     * @param $id Het opgegeven id
     * @return De opgevraagde gebruiker
     */
    function get($id){
        // geef gebruiker-object met opgegeven $id   
        $this->db->where('id', $id);
        $query = $this->db->get('gebruiker');
        $user = $query->row();
        
        if(isset($user->typeId)){
            $this->load->model("gebruikertype_model");
            
            $user->type = $this->gebruikertype_model->get($user->typeId);
        }
        
        return $user;
    }
    
    function getAllUsers(){
        $this->load->model("gebruikertype_model");
        
        $this->db->where('actief', 1);
        $query = $this->db->get('gebruiker');
        $result = $query->result();
        
        foreach ($result as $r){
            $r->type = $this->gebruikertype_model->get($r->typeId);
        }
        
        return $result;
    }

    function getUser($email, $password){
        // geef gebruiker-object met $email en $wachtwoord EN actief = 1
        $this->db->where('email', $email);
        $this->db->where('actief', 1);
        $query = $this->db->get('gebruiker');
        
        if($query->num_rows() == 1){
            $user = $query->row();
            // controleren of het wachtwoord overeenkomt
            if(password_verify($password, $user->wachtwoord)){
                return $user;
            }else{
                return null;
            }
        }else{
            return null;
        }
    }

    function updateLastLogin($id){
        // pas tijd laatstAangemeld aan
        $user = new stdClass();
        $user->laatsteLogin = date("Y-m-d H-i-s");
        $this->db->where('id', $id);
        $this->db->update('gebruiker', $user);
    }
    
    function insert($user){
        if($user->email == "" || $user->voornaam == "" || $user->achternaam == ""){
            return -1;
        }else if($this->getUserFromEmail($user->email) != null){
            return -2;
        }
        
        $this->db->insert('gebruiker', $user);
        return $this->db->insert_id();
    }
    
    function update($user){
        $check = $this->getUserFromEmail($user->email);
        
        if($user->email == "" || $user->voornaam == "" || $user->achternaam == ""){
            return -1;
        }else if($check != null && $check->id != $user->id){
            return -2;
        }
        
        $this->db->where('id', $user->id);
        $this->db->update('gebruiker', $user);
        return 1;
    }
    /**
     * @author Quinten Van Casteren
     * 
     * Geeft terug de gebruiker met email=$email uit de tabel gebruiker
     * @param $email Het opgegeven email
     * @return De opgevraagde user
     */
    function getUserFromEmail($email){
        $this->db->where('email', $email);
           
        $query = $this->db->get('gebruiker');
        
        if($query->num_rows() == 1){
            $user = $query->row();
            return $user;
        }else{
            return null;
        }
    }
    /**
     * @author Quinten Van Casteren
     * 
     * Geeft terug de gebruiker met pwdCode=$code uit de tabel gebruiker
     * @param $email Het opgegeven pwdCode
     * @return De opgevraagde user
     */
    function getUserFromPwdCode($code){
        $this->db->where('pwdCode', $code);
           
        $query = $this->db->get('gebruiker');
        
        if($query->num_rows() == 1){
            $user = $query->row();
            return $user;
        }else{
            return null;
        }
    }
	
	/**
     * @author Quinten Van Casteren
     * 
     * Geeft alle gebruikers terug gesorteerd op naam
     * @return alle users, gesorteerd op naam
     */
    function getAllUsersSortByName(){
        $this->load->model("gebruikertype_model");
        
        $this->db->order_by('achternaam', 'asc');
        $this->db->where('actief', 1);
        $query = $this->db->get('gebruiker');
        $result = $query->result();
        
        foreach ($result as $r){
            $r->type = $this->gebruikertype_model->get($r->typeId);
        }
        
        return $result;
    }
    
    /**
     * @author Quinten Van Casteren
     * 
     * Geeft terug de gebruikers met gebruikertype=$gebruikertype uit de tabel gebruiker
     * @param $gebruikertype Het opgegeven gebruikertype
     * @return De opgevraagde users
     */
    function getAllUsersFromType($gebruikertype){
        $this->db->where('typeId', $gebruikertype);
        $this->db->where('actief', 1);
        $query = $this->db->get('gebruiker');
        $result = $query->result();
        
        return $result;
    }
    
    function search($text, $previousEditions, $columns){
        $this->db->from('gebruiker');
        
        $first = true;
        
        foreach($columns as $column){
            if($first){
                $first = false;
                
                $this->db->like($column, $text);
            }else{
                $this->db->or_like($column, $text);
            }
        }
        
        $query = $this->db->get();
        return $query->result();
    }
}
?>