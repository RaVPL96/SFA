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
        $this->db->select('`id`, `name`, `full_name`, `nic`, `licence_id`,`driver_number`, `is_act`');
        $this->db->from('`pri_tbl_mst_driver`');
        $this->db->where('`is_act`', 1);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function getDepartment() {
        $this->db->select('`id`, `name`, `is_act`');
        $this->db->from('`pri_tbl_mst_department`');
        $this->db->where('`is_act`', 1);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function getVehicle() {
        $this->db->select('`id`, `vehicle_no`, `model`, `type_of_vehicle`, `location`');
        $this->db->from('`pri_tbl_mst_vehicle`');
        $this->db->where('`is_act`', 1);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function createJob($data) {
        $dataSet = $data['post']['user'];
        
        $saveas = $dataSet['saveas'];

        if ($saveas == 'new') {//new job creation
            $values = array(
                
                'department_name' => $dataSet['department'],
                'vehicle_no' => $dataSet['vehicle'],
                'driver_id' => $dataSet['driver'],
                'from_location' => $dataSet['from'],
                'to_location' => $dataSet['to'],
                'request_date' => $dataSet['reqursetdate'],
                'start_mileage' => $dataSet['startmileage'],
                'end_mileage' => $dataSet['endmileage'],
                'system_mileage' => $dataSet['systemmileage'],
                'manual_mileage' => $dataSet['manualmileage'],
                'additional_diesel' => $dataSet['additionaldiesel'],
                'total_cost' => $dataSet['totalcost'],
                
                
            );
            $this->db->insert('pri_tbl_trans_service', $values);
           

            
        }
    }

}
