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
    function index ($msg = null) {
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
    function service($msg = null) {
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
        $data['RangeList'] = $this->MasterModule->getRange();
        $data['ASE_Territory'] = null;
        $data['ASE_Area'] = null;

        


        $this->load->view('template/header', $data);
        $this->load->view('primary/logistics/service');
        $this->load->view('template/footer');
    }
    
}