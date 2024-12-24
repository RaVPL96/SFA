<?php

/*
 * This system Licenced to Raigam Marketing Services (Pvt) Ltd. 
 * Developed By: Lakshitha Pradeep Karunarathna  * 
 * Company: Serving Cloud INC in association with MyOffers.lk  * 
 * Date Started:  October 20, 2017  * 
 */

class Logistics extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('UsersModel');
        $this->load->model('ItemsModel');
        $this->load->model('SurveyModel');
        $this->load->model('MasterModule');
        $this->load->model('HrModule');
        $this->load->model('LogisticsModule');
        $this->load->model('CommonModule');
    }

    function index($msg = null) {
        $functionID = 77;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 1;
        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'O/E Transactions';
        $data['pagetitle'] = 'O/E Transactions';
        $data['msg'] = $msg;
        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);
        $this->load->view('template/header', $data);
        $this->load->view('primary/logistics/index');
        $this->load->view('template/footer');
    }

    function service($msg = null, $id = null) {
        $functionID = 77; //app_module_function table id
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 48; // app_module_function_sub table id
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);

        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'Daily Sales Summery';
        $data['pagetitle'] = 'Daily Sales Summery';
        $data['msg'] = $msg;

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['DateRange'] = '';
        $data['driverList'] = $this->LogisticsModule->getDrivers();
        $data['departmentList'] = $this->LogisticsModule->getDepartment();
        $data['companyList'] = $this->LogisticsModule->getCompany();
        $data['VehicleList'] = $this->LogisticsModule->getVehicle();
        $data['ServiceList'] = $this->LogisticsModule->getServicedetails();
        if (!empty($id) && isset($id)) {
            $data['service'] = $this->LogisticsModule->getServicedetails($id);
            $data['serviceOther'] = $this->LogisticsModule->getOtherService($id);
        }
        $this->load->view('template/header', $data);
        $this->load->view('primary/logistics/service');
        $this->load->view('template/footer');
    }

    function saveService() {
        $functionID = 77; //same id use cos, createAcc  need this func to complete operation
        //$this->UsersModel->authenticateMe($functionID);
       // $data = $_POST;
        //print_r($data);
        die();
        $result = $this->LogisticsModule->createJob($data);
        if ($result == 1) {
            header('Location:' . base_url('index.php/logistics/service/ok'));
        } else {
            header('Location:' . base_url('index.php/logistics/service/fail'));
        }
    }

    function getAjaxAvailableVehicle() {
        $fromDate = $_POST['fromDate'];
        $toDate = $_POST['toDate'];
        $result = $this->LogisticsModule->getAvailableVehicles($fromDate, $toDate);
        $rs = '<option value="">-- Select One --<option>';
        if (!empty($result) && isset($result)) {
            foreach ($result as $r) {
                $rs = $rs . '<option value="' . $r['id'] . '">' . $r['vehicle_no'] . '</option>';
            }
        }
        echo $rs;
    }

    function getAjaxGetRate() {
        $vehiID = $_POST['vehicleID'];
        $result = $this->LogisticsModule->getRate(null, $vehiID);
        echo $result->rate;
    }

    function invoiceView($msg = null) {
        $functionID = 77;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 48;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);
        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'Reports - O/E Transactions';
        $data['pagetitle'] = 'Reports - O/E Transactions';
        $data['msg'] = $msg;
        $data['invData'] = null;
        if (!empty($_POST['idinvoice']) && isset($_POST['idinvoice'])) {
            $invNum = $_POST['idinvoice'];
            $FromDate = '';
            $ToDate = '';
            $data['invDataH'] = $this->LogisticsModule->getServicedetails($invNum);
            $data['invDataD'] = $this->LogisticsModule->getOtherService($invNum);
        }

        $this->load->view('primary/logistics/ServicePrint', $data);
    }

    function CarDetails($msg = null, $id = null) {
        $functionID = 77; //app_module_function table id
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 49; // app_module_function_sub table id
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);

        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'Daily Sales Summery';
        $data['pagetitle'] = 'Daily Sales Summery';
        $data['msg'] = $msg;

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['DateRange'] = '';

        $data['VehicleList'] = $this->LogisticsModule->getVehicle();
        if (!empty($id) && isset($id)) {
            $data['vehicle'] = $this->LogisticsModule->getVehicle($id);
        }
        $data['ASE_Territory'] = null;
        $data['ASE_Area'] = null;
        $this->load->view('template/header', $data);
        $this->load->view('primary/logistics/CarDetails');
        $this->load->view('template/footer');
    }

    function saveVehicle() {
        $functionID = 77; //same id use cos, createAcc  need this func to complete operation
        //$this->UsersModel->authenticateMe($functionID);
        $data = $_POST;
        //print_r($data);
        //die();
        $result = $this->LogisticsModule->createVehicle($data);
        if ($result == 1) {
            header('Location:' . base_url('index.php/logistics/CarDetails/ok'));
        } else {
            header('Location:' . base_url('index.php/logistics/CarDetails/fail'));
        }
    }

    function DriverDetails($msg = null, $id = null) {
        $functionID = 77; //app_module_function table id
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 50; // app_module_function_sub table id
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);

        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'Daily Sales Summery';
        $data['pagetitle'] = 'Daily Sales Summery';
        $data['msg'] = $msg;

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['DateRange'] = '';

        $data['DriverList'] = $this->LogisticsModule->getDrivers();
        if (!empty($id) && isset($id)) {
            $data['Driver'] = $this->LogisticsModule->getDrivers($id);
        }
        $data['ASE_Territory'] = null;
        $data['ASE_Area'] = null;
        $this->load->view('template/header', $data);
        $this->load->view('primary/logistics/DriverDetails');
        $this->load->view('template/footer');
    }

    function saveDriver() {
        $functionID = 77; //same id use cos, createAcc  need this func to complete operation
        //$this->UsersModel->authenticateMe($functionID);
        $data = $_POST;
        //print_r($data);
        //die();
        $result = $this->LogisticsModule->createDriver($data);

        if ($result == 1) {
            header('Location:' . base_url('index.php/logistics/DriverDetails/ok'));
        } else {
            header('Location:' . base_url('index.php/logistics/DriverDetails/fail'));
        }
    }

    function driverBook($msg = null, $id = null) {
        $functionID = 77; //app_module_function table id
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 51; // app_module_function_sub table id
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);

        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'Driver Booking';
        $data['pagetitle'] = 'Driver Booking';
        $data['msg'] = $msg;

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['DateRange'] = '';
        $data['driverList'] = $this->LogisticsModule->getDrivers();
        $data['departmentList'] = $this->LogisticsModule->getDepartment();
        $data['companyList'] = $this->LogisticsModule->getCompany();
        $data['VehicleList'] = $this->LogisticsModule->getVehicle();
        $data['ServiceList'] = $this->LogisticsModule->getDriverBookingDetails();
        if (!empty($id) && isset($id)) {
            //echo ($id);
            $data['service'] = $this->LogisticsModule->getDriverBookingDetails($id);
            //print_r ($data);
            //die();
            $data['serviceOther'] = $this->LogisticsModule->getDriverBookingOtherService($id);
        }
        $this->load->view('template/header', $data);
        $this->load->view('primary/logistics/DriverBooking');
        $this->load->view('template/footer');
    }

    function saveDriverBook() {
        $functionID = 77; //same id use cos, createAcc  need this func to complete operation
        //$this->UsersModel->authenticateMe($functionID);
        $data = $_POST;
        //print_r($data);
        //die();
        $result = $this->LogisticsModule->createDriverBooking($data);
        if ($result == 1) {
            header('Location:' . base_url('index.php/logistics/driverBook/ok'));
        } else {
            header('Location:' . base_url('index.php/logistics/driverBook/fail'));
        }
    }

}
