<?php
/**
 * @class my_email_helper
 * @author Brend Simons
 * 
 * Helper die het makkelijker maakt emails te versturen.
 * 
 * @param $to Het email van de ontvanger
 * @param $subject Het onderwerp van de email
 * @param $message Het bericht van de email
 */
function sendEmail($to, $subject, $message){
    $CI =& get_instance();
     
    $config = Array(
        'protocol' => 'smtp',
        'smtp_host' => 'ssl://smtp.googlemail.com',
        'smtp_port' => 465,
        'smtp_user' => 'intdays.noreply@gmail.com',
        'smtp_pass' => 'kombijmij',
        'mailtype' => 'html',
        'charset' => 'iso-8859-1',
        'wordwrap' => TRUE
    );
    
    $CI->load->library('email', $config);
    $CI->email->set_newline("\r\n");
    $CI->email->from('intdays.noreply@gmail.com');
    $CI->email->to($to);
    $CI->email->subject($subject);
    $CI->email->set_mailtype("html");
    $CI->email->message($message);
    
    if(!$CI->email->send()){
        show_error($CI->email->print_debugger());
    }
}
?>