<?php
/**
 * @class Mailtype_model
 * Model-klasse voor alle Mailtypes (templates van emails)
 */
class Mailtype_model extends CI_Model {
    
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * * @author Brend Simons
     * 
     * Geeft terug het template met id=$id uit de tabel mailtype
     * @param $id Het opgegeven id
     * @return Het opgevraagde template.
     */
    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('mailtype');
        return $query->row();
    }
    
    /**
     * * @author Quinten Van Casteren
     * 
     * Geeft alle templates terug uit de tabel mailtype
     * @return Alle templates.
     */
    function getAllTemplates() {
        $query = $this->db->get('mailtype');
        $result = $query->result();
        return $result;
    }
    
    /**
     * @author Quinten Van Casteren
     * 
     * Voegt het template $template toe aan de tabel mailtype.
     * @param $template Het opgegeven template
     * @return Een True signaal
     */
    function insert($template){
        $this->db->insert('mailtype', $template);
        return 1;
    }
    
    /**
     * @author Quinten Van Casteren
     * 
     * Verandert het template waar id=$template->id in de tabel mailtype.
     * @param $template Het opgegeven template
     * @return Een True signaal
     */
    function update($template){
        $this->db->where('id', $template->id);
        $this->db->update('mailtype', $template);
        return 1;
    }
    
    /**
     * @author Quinten Van Casteren
     * 
     * Verwijdert het template waar id=$id in de tabel mailtype.
     * @param $id Het id van het te verwijderen template.
     * @return Een True signaal
     */
    function remove($id){
        $this->db->where('id', $id);
        $this->db->delete('mailtype');
        return 1;
    }
}
?>