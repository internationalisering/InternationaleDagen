<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @class Notifications
 * @author Brend Simons
 * 
 * Notifications-klasse voor het weergeven van notificaties
 */
class Notifications{
    
    private $notification = null;
    
    /**
     * Maakt een nieuwe notificatie aan.
     * 
     * @param msg Het bericht dat weergegeven moet worden.
     * @param type De css class die aan die notification gegeven moet worden.
     * @param cookie Boolean moet er een cookie moet aangemaakt worden, of niet.
     */
    public function createNotification($msg, $type = "success", $cookie = true){
        if($cookie){
            set_cookie("notification", json_encode(array("msg" => $msg, "type" => $type)), '3600');
        }else{
            $this->notification = array("msg" => $msg, "type" => $type);
        }
    }
    
    /**
     * Toont al dan niet een notificatie.
     */
    public function buildNotification(){
        $notification = get_cookie("notification");
        
        if($notification != null){
            delete_cookie("notification");
            
            $notification = json_decode($notification);
            
            echo '
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-' . $notification->type . ' alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            ' . html_entity_decode($notification->msg) . '
                        </div>
                    </div>
                </div>
            ';
        }else if($this->notification != null){
            echo '
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-' . $this->notification['type'] . ' alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            ' . html_entity_decode($this->notification['msg']) . '
                        </div>
                    </div>
                </div>
            ';
        }
    }
}