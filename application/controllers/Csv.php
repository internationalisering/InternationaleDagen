<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Csv extends CI_Controller {
    
	public function __construct(){
        parent::__construct();
        $this->load->model('csv_model');
        $this->load->library('csvimport');
    }



    public function importcsv() {
    	$data['error'] = '';
        $type = $this->input->post('type');
    	$config['upload_path'] = ('./uploads/');
    	$config['allowed_types'] = 'csv';
    	$config['max_size'] = '1000';

    	$this->load->library('upload', $config);

    	//Als upload failt, toon error
        if (!$this->upload->do_upload()) {
            $data['error'] = $this->upload->display_errors();
 
            $this->load->view('/login-beheerder/beheerder_gebruiker_import_error', $data);
        } else {
            $file_data = $this->upload->data();
            $file_path =  './uploads/'.$file_data['file_name'];
 
            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                foreach ($csv_array as $row) {

                    $insert_data = array(

                        /*Kolommen sql*/

                        'voornaam'=>$row["'voornaam'"],
                        'achternaam'=>$row["'achternaam'"],
                        'email'=>$row["'email'"],
                        'gender'=>$row["'gender'"],
                        'klasId'=>$row["'klasId'"],
                        'titel'=>$row["'titel'"],
                        'institutie'=>$row["'institutie'"],
                        'mobiel'=>$row["'mobiel'"],
                        'biografie'=>$row["'biografie'"],
                        'positie'=>$row["'positie'"],
                        'tmContact'=>$row["'tmContact'"],
                        'studieGebied'=>$row["'studieGebied'"],
                        'land'=>$row["'land'"],
                        'typeId'=>$type,
                        'wachtwoord'=>$code

                    );
                    print_r($row);


                    $this->csv_model->insert_csv($insert_data);

                }
                $this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
                redirect('/gebruiker');
            } else 
                $data['error'] = "Error occured";
                $this->load->view('/login-beheerder/beheerder_gebruiker_import_error', $data);
            }
 
        } 
    }


    