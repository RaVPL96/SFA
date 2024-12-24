<?php

/*


 * This system Licenced to Raigam Marketing Services (Pvt) Ltd. 

 * Developed By: Lakshitha Pradeep Karunarathna  * 

 * Company: Serving Cloud INC in association with MyOffers.lk  * 

 * Date Started:  October 20, 2017  * 


 */

class GpsModule extends CI_Model {

    function __construct() {
        parent::__construct();
        //$this->mssql = $this->load->database('MSSQL', TRUE); 
    }

    function getGpsTimeLog($user, $gp_date) {
        $arrSearch = array(
            '`user_name`' => $user,
            '`gps_date`' => $gp_date,
            '`gps_time`<=' => '21:30:00'
        );
        $this->db->select('DISTINCT(time_format(`gps_time`,\'%H:%i\')) AS `gp_time`');
        $this->db->from('`tbl_trans_gps_log`');
        $this->db->where($arrSearch);
        $this->db->order_by('`gps_date`,`gps_time`');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

}