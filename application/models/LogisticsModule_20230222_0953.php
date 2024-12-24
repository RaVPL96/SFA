<?php

/* 
 * This system Licenced to Raigam Marketing Services (Pvt) Ltd. 
 * Developed By: Lakshitha Pradeep Karunarathna  * 
 * Company: Serving Cloud INC in association with MyOffers.lk  * 
 * Date Started:  October 20, 2017  * 
 */
class LogisticsModule extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('AuditModule');
    }

    //get Attendance type master data
    function getDrivers() {
        $this->db->select('`id`, `name`, `full_name`, `nic`, `licence_id`, `is_act`');
        $this->db->from('`pri_tbl_mst_driver`');
        $this->db->where('`is_act`', 1);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
}