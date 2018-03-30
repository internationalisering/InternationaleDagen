<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Import extends CI_Controller {
	public function index()
	{
		$this->load->view('csvToMySQL');
	}
	public function upload_file(){
		$csvMimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
	    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$csvMimes)){
	        if(is_uploaded_file($_FILES['file']['tmp_name'])){

	            //open uploaded csv file with read only mode
	            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');

	            // skip first line
	            // if your csv file have no heading, just comment the next line
	            fgetcsv($csvFile);

	            //parse data from csv file line by line
	            while(($line = fgetcsv($csvFile)) !== FALSE){
	                //check whether member already exists in database with same email
	                $result = $this->db->get_where("member", array("email"=>$line[1]))->result();
	                if(count($result) > 0){
	                    //update member data
	                    $this->db->update("member", array(
												"name"=>$line[0],
												"phone"=>$line[2],
												"created"=>$line[3],
												"status"=>$line[4]), array("email"=>$line[1]));
	                }else{
	                    //insert member data into database
	                    $this->db->insert("member", array("name"=>$line[0], "email"=>$line[1], "phone"=>$line[2], "created"=>$line[3], "status"=>$line[4]));
	                }
	            }

	            //close opened csv file
	            fclose($csvFile);
	            $qstring["status"] = 'Success';
	        }else{
	            $qstring["status"] = 'Error';
	        }
	    }else{
	        $qstring["status"] = 'Invalid file';
	    }
	    $this->load->view('csvToMySQL',$qstring);
	}
}
