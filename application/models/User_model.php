<?php
class User_model extends CI_Model {
    
    function __construct(){
        parent::__construct();
    }

    function get($id){
        // geef gebruiker-object met opgegeven $id   
        $this->db->where('id', $id);
        $query = $this->db->get('User');
        $user = $query->row();
        
        $this->load->model("type_model");
        
        $user->type = $this->type_model->get($user->typeId);
        
        return $user;
    }

    function getUser($email, $password){
        // geef gebruiker-object met $email en $wachtwoord EN geactiveerd = 1
        $this->db->where('email', $email);
        $query = $this->db->get('User');
        
        if($query->num_rows() == 1){
            $user = $query->row();
            // controleren of het wachtwoord overeenkomt
            if(password_verify($password, $user->password)){
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
        $user->lastLogin = date("Y-m-d H-i-s");
        $this->db->where('id', $id);
        $this->db->update('User', $user);
    }
}
?>