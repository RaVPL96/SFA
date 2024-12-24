<?php

/*


 * This system Licenced to Raigam Marketing Services (Pvt) Ltd. 

 * Developed By: Lakshitha Pradeep Karunarathna  * 

 * Company: Serving Cloud INC in association with MyOffers.lk  * 

 * Date Started:  October 20, 2017  * 


 */

class AuditModule extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
    }
    function saveCronStatus($cron_id,$date,$time){
        $arrin=array(
            '`cron_id`'=> $cron_id,
            '`date`'=> $date,
            '`time`' => $time
        );
        $this->db->insert('tbl_trans_cron_log', $arrin);
    }
}
?>