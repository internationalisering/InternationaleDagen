<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Csv_model extends CI_Model
{
    function __construct() {
        parent::__construct();

    }

    function insert_csv($data) {
        $this->db->insert('gebruiker', $data);
    }
}