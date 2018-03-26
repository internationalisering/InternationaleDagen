<?php
class User_model extends CI_Model {
    
    function __construct(){
        parent::__construct();
    }

    function get($id){
        // geef gebruiker-object met opgegeven $id   
        $this->db->where('id', $id);
        $query = $this->db->get('gebruiker');
        $user = $query->row();
        
        if(isset($user->typeId)){
            $this->load->model("type_model");
            
            $user->type = $this->type_model->get($user->typeId);
        }
        
        return $user;
    }
    
    function getAllUsers(){
        $this->load->model("type_model");
        
        $this->db->where('actief', 1);
        $query = $this->db->get('gebruiker');
        $result = $query->result();
        
        foreach ($result as $r){
            $r->type = $this->type_model->get($r->typeId);
        }
        
        return $result;
    }

    function getUser($email, $password){
        // geef gebruiker-object met $email en $wachtwoord EN geactiveerd = 1
        $this->db->where('email', $email);
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
        $this->db->insert('gebruiker', $user);
        return $this->db->insert_id();
    }
    
    function update($user){
        $this->db->where('id', $user->id);
        $this->db->update('gebruiker', $user);
    }
    
    function getUserFromEmail($email){
        // geef gebruiker-object met $email 
        $this->db->where('email', $email);
           
        $query = $this->db->get('gebruiker');
        
        if($query->num_rows() == 1){
            $user = $query->row();
            return $user;
        }else{
            return null;
        }
    }
    
    function getUserFromPwdCode($code){
        // geef gebruiker-object met $code
        $this->db->where('pwdCode', $code);
           
        $query = $this->db->get('gebruiker');
        
        if($query->num_rows() == 1){
            $user = $query->row();
            return $user;
        }else{
            return null;
        }
    }
}
?>