<?php
class LogisticsModule extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('AuditModule');
    }



    //get Attendance type master data

    function getDrivers($id = null) {

        $this->db->select('`id`, `name`, `full_name`, `nic`, `licence_id`,`driver_number`, `is_act`');

        $this->db->from('`pri_tbl_mst_driver`');

        $this->db->where('`is_act`', 1);

        if (!empty($id) && isset($id)) {

            $this->db->where('`pri_tbl_mst_driver`.`id`', $id);

        }



        $query = $this->db->get();

        $result = $query->result_array();

        if (!empty($id) && isset($id)) {



            $result = $query->row();

        } else {

            $result = $query->result_array();

        }

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

    

    function getCompany() {

        $this->db->select('`id`, `name`, `is_act`');

        $this->db->from('`pri_tbl_mst_company`');

        $this->db->where('`is_act`', 1);

        $query = $this->db->get();

        $result = $query->result_array();

        return $result;

    }



    function getVehicle($id = null) {

        $this->db->select('`id`, `vehicle_no`, `model`, `type_of_vehicle`, `owner`');

        $this->db->from('`pri_tbl_mst_vehicle`');

        $this->db->where('`is_act`', 1);

        if (!empty($id) && isset($id)) {

            $this->db->where('`pri_tbl_mst_vehicle`.`id`', $id);

        }

        $query = $this->db->get();

        $result = $query->result_array();

        if (!empty($id) && isset($id)) {



            $result = $query->row();

        } else {

            $result = $query->result_array();

        }

        return $result;

    }



    function getAvailableVehicles($FromDate, $ToDate) {

        $query_in= $this->db->query('SELECT vehicle_no FROM `pri_tbl_trans_service`  WHERE (request_date BETWEEN \'' . $FromDate . '\' AND \'' . $ToDate . '\') OR (to_date BETWEEN \'' . $FromDate . '\' AND \'' . $ToDate . '\')');

        $data_in=$query_in->result_array();

        //print_r($data_in);

        echo $this->db->last_query();

        $vehicles=[];

        foreach ($data_in as $a){

            $vehicles[]=$a['vehicle_no'];

        }

        

        $this->db->select('`id`, `vehicle_no`, `model`, `type_of_vehicle`, `owner`');

        $this->db->from('`pri_tbl_mst_vehicle`');

        $this->db->where('`is_act`', 1);

        if(!empty($vehicles) && isset($vehicles)){

            $this->db->where_not_in('`pri_tbl_mst_vehicle`.`id`', $vehicles);

        }

        $query = $this->db->get();

        echo $this->db->last_query();

        $result = $query->result_array(); 

        return $result;

    }



    function getServicedetails($id = null) {



        $this->db->select('`pri_tbl_trans_service`.`id`,`pri_tbl_mst_company`.`name` as c_name,`pri_tbl_mst_vehicle`.`id` as vehicle_id,pri_tbl_mst_driver.id as driver_id,pri_tbl_trans_service.reason, `pri_tbl_mst_vehicle`.`vehicle_no`,`pri_tbl_trans_service`.`requester_name`,`pri_tbl_trans_service`.`from_time`,`pri_tbl_trans_service`.`to_time`, `pri_tbl_mst_driver`.`nic`,`pri_tbl_mst_driver`.`name` as driver_name, `pri_tbl_trans_service`.`rate`,`pri_tbl_mst_department`.`id` as `department_id`,`pri_tbl_mst_department`.`name`,`pri_tbl_mst_driver`.`full_name`,`pri_tbl_mst_driver`.`driver_number`, `from_location`, `to_location`, `request_date`,`to_date`, `system_mileage`, `start_mileage`, `end_mileage`, `manual_mileage`, `additional_diesel`,`pri_tbl_trans_service`.`requester_name`, `total_cost`,`pri_tbl_trans_service`.`reason`,pri_tbl_trans_service.status,`pri_tbl_trans_service`.`company_name`');

        $this->db->from('`pri_tbl_trans_service`');

        $this->db->join('`pri_tbl_mst_vehicle`', '`pri_tbl_trans_service`.`vehicle_no`=`pri_tbl_mst_vehicle`.`id`', 'INNER');

        $this->db->join('`pri_tbl_mst_driver`', '`pri_tbl_trans_service`.`driver_id`=`pri_tbl_mst_driver`.`id`', 'INNER');

        $this->db->join('`pri_tbl_mst_department`', '`pri_tbl_trans_service`.`department_name`=`pri_tbl_mst_department`.`id`', 'INNER');

        $this->db->join('`pri_tbl_mst_company`','`pri_tbl_trans_service`.`company_name`=`pri_tbl_mst_company`.`id`','INNER');

        $this->db->where('`pri_tbl_trans_service`.`is_act`', 1);

        if (!empty($id) && isset($id) && $id != null) {

            $this->db->where('`pri_tbl_trans_service`.`id`', $id);

        }

        $query = $this->db->get();

        if (!empty($id) && isset($id) && $id != null) {

            $result = $query->row();

        } else {

            $result = $query->result_array();

        }



        return $result;

    }



    function getOtherService($id = null) {

        $this->db->select('`id`, `service_header_id`, `service_name`, `cost`');

        $this->db->from('pri_tbl_mst_service_details');

        $this->db->where('`is_act`', 1);

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

        $status=0;

        if(!empty($dataSet['status']) && isset($dataSet['status'])){

            $status=$dataSet['status'];

        }

        if ($saveas == 'new') {//new job creation

            $values = array(

                'company_name' => $dataSet['company'],

                'department_name' => $dataSet['department'],

                'requester_name' => $dataSet['requestername'],

                'vehicle_no' => $dataSet['vehicle'],

                'driver_id' => $dataSet['driver'],

                'from_location' => $dataSet['from'],

                'to_location' => $dataSet['to'],

                'request_date' => $dataSet['reqursetdate'],

                'from_time'=>$dataSet['fromtime'],

                'to_date' => $dataSet['todate'],

                'to_time'=>$dataSet['totime'],

                'reason' => $dataSet['reason'],

                'rate'=>$dataSet['rate'],

                'start_mileage' => $dataSet['startmileage'],

                'end_mileage' => $dataSet['endmileage'],

                'system_mileage' => $dataSet['systemmileage'],

                'manual_mileage' => $dataSet['manualmileage'],

                'additional_diesel' => $dataSet['additionaldiesel'],

                'total_cost' => $dataSet['totalcost'],

                'status'=>$status

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

            } else {

            $values = array(

                'company_name' => $dataSet['company'],

                'department_name' => $dataSet['department'],

                'requester_name' => $dataSet['requestername'],

                'vehicle_no' => $dataSet['vehicle'],

                'driver_id' => $dataSet['driver'],

                'from_location' => $dataSet['from'],

                'to_location' => $dataSet['to'],

                'request_date' => $dataSet['reqursetdate'],

                'from_time'=>$dataSet['fromtime'],

                'to_date' => $dataSet['todate'],

                'to_time'=>$dataSet['totime'],

                'reason' => $dataSet['reason'],

                'start_mileage' => $dataSet['startmileage'],

                'end_mileage' => $dataSet['endmileage'],

                'rate'=>$dataSet['rate'],

                'system_mileage' => $dataSet['systemmileage'],

                'manual_mileage' => $dataSet['manualmileage'],

                'additional_diesel' => $dataSet['additionaldiesel'],

                'total_cost' => $dataSet['totalcost'],

                'status'=>$status

            );

            $this->db->trans_begin();

            $this->db->where('`pri_tbl_trans_service`.`id`', $dataSet['saveas']);

            $this->db->update('pri_tbl_trans_service', $values);

            

            $serviceData = array(

                'service_header_id' => $dataSet['saveas'],

                'service_name' => $dataSet['costname'],

                'cost' => $dataSet['cost']

            );

            

            $this->db->delete('`pri_tbl_mst_service_details`',array('service_header_id' => $dataSet['saveas']));

            $this->db->insert('pri_tbl_mst_service_details', $serviceData);



            if ($this->db->trans_status() === FALSE) {

                $IsInserted = 0;

                $this->db->trans_rollback();

            } else {

                $IsInserted = 1;

                $this->db->trans_commit();

            }

        

            

            

        }

        return $IsInserted;

    }



    function createVehicle($data) {

        $dataSet = $data['post']['user'];



        $saveas = $dataSet['saveas'];



        if ($saveas == 'new') {//new job creation

            $values = array(

                'vehicle_no' => $dataSet['vehicleno'],

                'model' => $dataSet['model'],

                'type_of_vehicle' => $dataSet['typeofvehicle'],

                'owner' => $dataSet['owner'],

            );

            $this->db->trans_begin();

            $this->db->insert('pri_tbl_mst_vehicle', $values);



            if ($this->db->trans_status() === FALSE) {

                $IsInserted = 0;

                $this->db->trans_rollback();

            } else {

                $IsInserted = 1;

                $this->db->trans_commit();

            }

        } else {

            $values = array(

                'vehicle_no' => $dataSet['vehicleno'],

                'model' => $dataSet['model'],

                'type_of_vehicle' => $dataSet['typeofvehicle'],

                'owner' => $dataSet['owner'],

            );

            $this->db->trans_begin();

            $this->db->where('`pri_tbl_mst_vehicle`.`id`', $dataSet['saveas']);

            $this->db->update('pri_tbl_mst_vehicle', $values);



            if ($this->db->trans_status() === FALSE) {

                $IsInserted = 0;

                $this->db->trans_rollback();

            } else {

                $IsInserted = 1;

                $this->db->trans_commit();

            }

        }

        return $IsInserted;

    }



    function createDriver($data) {

        $dataSet = $data['post']['user'];



        $saveas = $dataSet['saveas'];



        if ($saveas == 'new') {//new job creation

            $values = array(

                'name' => $dataSet['firstname'],

                'full_name' => $dataSet['lastname'],

                'nic' => $dataSet['nic'],

                'licence_id' => $dataSet['licenceid'],

                'driver_number' => $dataSet['drivernumber'],

            );

            $this->db->trans_begin();

            $this->db->insert('pri_tbl_mst_driver', $values);



            if ($this->db->trans_status() === FALSE) {

                $IsInserted = 0;

                $this->db->trans_rollback();

            } else {

                $IsInserted = 1;

                $this->db->trans_commit();

            }

        } else {

            $values = array(

                'name' => $dataSet['firstname'],

                'full_name' => $dataSet['lastname'],

                'nic' => $dataSet['nic'],

                'licence_id' => $dataSet['licenceid'],

                'driver_number' => $dataSet['drivernumber'],

            );

            $this->db->trans_begin();

            $this->db->where('`pri_tbl_mst_driver`.`id`', $dataSet['saveas']);

            $this->db->update('pri_tbl_mst_driver', $values);



            if ($this->db->trans_status() === FALSE) {

                $IsInserted = 0;

                $this->db->trans_rollback();

            } else {

                $IsInserted = 1;

                $this->db->trans_commit();

            }

        }

        return $IsInserted;

    }

    function getRate($id = null,$vehicleid=null) {

        $this->db->select('`pri_tbl_mst_rate`.`rate`' );

        $this->db->from('`pri_tbl_mst_rate`');

        $this->db->join('`pri_tbl_mst_vehicle`', '`pri_tbl_mst_rate`.`vehicle_id`=`pri_tbl_mst_vehicle`.`id`', 'INNER');

        

        $this->db->where('`pri_tbl_mst_rate`.`is_act`', 1);

        if (!empty($id) && isset($id) && $id != null) {

            $this->db->where('`pri_tbl_mst_rate`.`id`',$vehicleid);

        }

        if (!empty($vehicleid) && isset($vehicleid) && $vehicleid != null) {

            $this->db->where('`pri_tbl_mst_vehicle`.`id`',$vehicleid);

        }

        $query = $this->db->get();

        if ((!empty($id) && isset($id) && $id != null) || (!empty($vehicleid) && isset($vehicleid) && $vehicleid != null)) {

            $result = $query->row();

        } else {

            $result = $query->result_array();

        }



        return $result;

    }

    

     function getDriverBookingDetails($id = null) {
        echo ($id.'sanda');
        $this->db->select('`pri_tbl_mst_driver_booking`.`id`,`pri_tbl_mst_company`.`name` as company_name,pri_tbl_mst_driver_booking.reason,`pri_tbl_mst_driver_booking`.`requester_name`,`pri_tbl_mst_driver_booking`.`from_time`,`pri_tbl_mst_driver_booking`.`to_time`,`pri_tbl_mst_driver_booking`.`driver_cost`, `pri_tbl_mst_driver`.`nic`,`pri_tbl_mst_driver`.`name` as driver_name,`pri_tbl_mst_department`.`id` as `department_id`,`pri_tbl_mst_department`.`name`,`pri_tbl_mst_driver`.`full_name`,`pri_tbl_mst_driver`.`driver_number`, `from_location`, `to_location`, `request_date`,`to_date`,`pri_tbl_mst_driver_booking`.`requester_name`, `total_cost`,`pri_tbl_mst_driver_booking`.`reason`,pri_tbl_mst_driver_booking.status,`pri_tbl_mst_driver_booking`.`company_id`');
        $this->db->from('`pri_tbl_mst_driver_booking`');
        $this->db->join('`pri_tbl_mst_driver`', '`pri_tbl_mst_driver_booking`.`driver_id`=`pri_tbl_mst_driver`.`id`', 'INNER');
        $this->db->join('`pri_tbl_mst_department`', '`pri_tbl_mst_driver_booking`.`department_id`=`pri_tbl_mst_department`.`id`', 'INNER');
        $this->db->join('`pri_tbl_mst_company`','`pri_tbl_mst_driver_booking`.`company_id`=`pri_tbl_mst_company`.`id`','INNER');
        $this->db->where('`pri_tbl_mst_driver_booking`.`is_act`', 1);
        if (!empty($id) && isset($id) && $id != null) {
            $this->db->where('`pri_tbl_mst_driver_booking`.`id`', $id);
        }
        $query = $this->db->get();
        if (!empty($id) && isset($id) && $id != null) {
            $result = $query->row();
        } else {
            $result = $query->result_array();  
        }
       echo $this->db->last_query();   
        return $result;
    }



    function getDriverBookingOtherService($id = null) {

        $this->db->select('`id`, `service_driver_booking_header_id`, `service_name`, `cost`');

        $this->db->from('pri_tbl_mst_driver_booking_other_details');

        $this->db->where('`is_act`', 1);

        if (!empty($id) && isset($id) && $id != null) {

            $this->db->where('`service_driver_booking_header_id`', $id);

        }

        $query = $this->db->get();

        $result = $query->result_array();

        return $result;

    }

    

    function createDriverBooking($data) {

        $dataSet = $data['post']['user'];

        $saveas = $dataSet['saveas'];

        $status=0;

        if(!empty($dataSet['status']) && isset($dataSet['status'])){

            $status=$dataSet['status'];

        }

        if ($saveas == 'new') {//new job creation

            $values = array(

                'company_id' => $dataSet['company'],

                'department_id' => $dataSet['department'],

                'requester_name' => $dataSet['requestername'],

                /*'vehicle_no' => $dataSet['vehicle'], */

                'driver_id' => $dataSet['driver'],

                'from_location' => $dataSet['from'],

                'to_location' => $dataSet['to'],

                'request_date' => $dataSet['reqursetdate'],

                'from_time'=>$dataSet['fromtime'],

                'to_date' => $dataSet['todate'],

                'to_time'=>$dataSet['totime'],

                'reason' => $dataSet['reason'],

                'driver_cost'=>$dataSet['drivercost'],

                /*'start_mileage' => $dataSet['startmileage'],

                'end_mileage' => $dataSet['endmileage'],

                'system_mileage' => $dataSet['systemmileage'],

                'manual_mileage' => $dataSet['manualmileage'],

                'additional_diesel' => $dataSet['additionaldiesel'],*/

                'total_cost' => $dataSet['totalcost'],

                'status'=>$status

            );

            $this->db->trans_begin();

            $this->db->insert('pri_tbl_mst_driver_booking', $values);

            $insert_id = $this->db->insert_id();



            $serviceData = array(

                'service_driver_booking_header_id' => $insert_id,

                'service_name' => $dataSet['costname'],

                'cost' => $dataSet['cost']

            );



            $this->db->insert('pri_tbl_mst_driver_booking_other_details', $serviceData);



            if ($this->db->trans_status() === FALSE) {

                $IsInserted = 0;

                $this->db->trans_rollback();

            } else {

                $IsInserted = 1;

                $this->db->trans_commit();

            }

            } else {

            $values = array(

                'company_id' => $dataSet['company'],

                'department_id' => $dataSet['department'],

                'requester_name' => $dataSet['requestername'],

                /*'vehicle_no' => $dataSet['vehicle'], */

                'driver_id' => $dataSet['driver'],

                'from_location' => $dataSet['from'],

                'to_location' => $dataSet['to'],

                'request_date' => $dataSet['reqursetdate'],

                'from_time'=>$dataSet['fromtime'],

                'to_date' => $dataSet['todate'],

                'to_time'=>$dataSet['totime'],

                'reason' => $dataSet['reason'],

               /* 'start_mileage' => $dataSet['startmileage'],

                'end_mileage' => $dataSet['endmileage'], */

                

               /* 'system_mileage' => $dataSet['systemmileage'],

                'manual_mileage' => $dataSet['manualmileage'],

                'additional_diesel' => $dataSet['additionaldiesel'], */

                'total_cost' => $dataSet['totalcost'],

                'status'=>$status

            );

            $this->db->trans_begin();

            $this->db->where('`pri_tbl_mst_driver_booking`.`id`', $dataSet['saveas']);

            $this->db->update('pri_tbl_mst_driver_booking', $values);

            

            $serviceData = array(

                'service_driver_booking_header_id' => $dataSet['saveas'],

                'service_name' => $dataSet['costname'],

                'cost' => $dataSet['cost']

            );

            

            $this->db->delete('`pri_tbl_mst_driver_booking_other_details`',array('service_driver_booking_header_id' => $dataSet['saveas']));

            $this->db->insert('pri_tbl_mst_driver_booking_other_details', $serviceData);



            if ($this->db->trans_status() === FALSE) {

                $IsInserted = 0;

                $this->db->trans_rollback();

            } else {

                $IsInserted = 1;

                $this->db->trans_commit();

            }

        

            

            

        }

        return $IsInserted;

    }



}

?>