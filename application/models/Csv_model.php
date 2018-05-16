<?php
/**
 * @class Csv_model
 * Model-klasse voor CSV-bestanden te importeren
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Csv_model extends CI_Model
{
    function __construct() {
        parent::__construct();
    }

    /**
     * Haalt all gebruikers op
     * @author Vincent Duchateau
     * @return Alle gebruikers
     */
    function get_gebruikers() {
    	$query = $this->db->get('gebruiker');
    	if ($query->num_rows() > 0) {
    		return $query->result_array();
    	} else {
    		return FALSE;
    	}
    }

    /**
     * Voegt all rijen toe van de CSV aan de tabel gebruiker
     * @author Vincent Duchateau
     * @param $data is de inhoud die wordt toegevoegd aan de kolom gebruiker
     * @return Toevoeging van rijen van het CSV-bestand aan de tabel gebruiker
     */
    function insert_csv($data) {
    	$this->db->insert('gebruiker', $data);
    }
}