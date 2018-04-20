<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Csv_model extends CI_Model
{
    function __construct() {
        parent::__construct();
    }

    function get_gebruikers() {
    	$query = $this->db->get('gebruiker');
    	if ($query->num_rows() > 0) {
    		return $query->result_array();
    	} else {
    		return FALSE;
    	}
    }

    function insert_csv($data) {
    	$this->db->insert('gebruiker', $data);
    }
}