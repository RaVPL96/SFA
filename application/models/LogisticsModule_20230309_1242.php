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
        $this->db->select('`id`, `vehicle_no`, `model`, `type_of_vehicle`, `owner`');
        $this->db->from('`pri_tbl_mst_vehicle`');
        $this->db->where('`is_act`', 1);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function getServicedetails($id = null) {

        $this->db->select('`pri_tbl_trans_service`.`id`, `pri_tbl_mst_vehicle`.`vehicle_no`, `pri_tbl_mst_driver`.`nic`, `pri_tbl_mst_department`.`name`, `from_location`, `to_location`, `request_date`, `system_mileage`, `start_mileage`, `end_mileage`, `manual_mileage`, `additional_diesel`, `total_cost`,');
        $this->db->from('`pri_tbl_trans_service`');
        $this->db->join('`pri_tbl_mst_vehicle`', '`pri_tbl_trans_service`.`vehicle_no`=`pri_tbl_mst_vehicle`.`id`', 'INNER');
        $this->db->join('`pri_tbl_mst_driver`', '`pri_tbl_trans_service`.`driver_id`=`pri_tbl_mst_driver`.`id`', 'INNER');
        $this->db->join('`pri_tbl_mst_department`', '`pri_tbl_trans_service`.`department_name`=`pri_tbl_mst_department`.`id`', 'INNER');
        $this->db->where('`pri_tbl_trans_service`.`is_act`', 1);
        if (!empty($id) && isset($id) && $id != null) {

            $this->db->where('`pri_tbl_trans_service`.`id`', $id);
        }
        $query = $this->db->get();
        if (!empty($id) && isset($id) && $id != null) {
            $result = $query->row();
        }else{
            $result = $query->result_array();
        }
        
        return $result;
    }
    function getOtherService($id=null){
        $this->db->select('`id`, `service_header_id`, `service_name`, `cost`');
        $this->db->from('pri_tbl_mst_service_details');
        $this->db->where('`is_act`',1);
         if (!empty($id) && isset($id) && $id != null) {

            $this->db->where('`service_header_id`', $id);
        }
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
            $this->db->trans_begin();
            $this->db->insert('pri_tbl_trans_service', $values);
            $insert_id = $this->db->insert_id();

            $serviceData = array(
                'service_header_id' => $insert_id,
                'service_name' => $dataSet['costname'],
                'cost' => $dataSet['cost']
            );

            $this->db->insert('pri_tbl_mst_service_details', $serviceData);

            if ($this->db->trans_status() === FALSE) {
                $IsInserted = 0;
                $this->db->trans_rollback();
            } else {
                $IsInserted = 1;
                $this->db->trans_commit();
            }
        }
    }

}