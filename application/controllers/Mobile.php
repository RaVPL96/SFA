<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mobile extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('UsersModel');
        $this->load->model('MasterModule');
        $this->load->model('MobileModule');
    }

    function reg($msg = null, $id = null) {
        $functionID = 85;
        $this->UsersModel->authenticateMe($functionID);
        // $functionSubID = 52;
        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'O/E Transactions';
        $data['pagetitle'] = 'O/E Transactions';
        $data['msg'] = $msg;
        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);
        $data['TerritoryDataSet'] = $this->MasterModule->getTerritory();
        $data['status'] = $this->MobileModule->getStatus();
        $data['phoneModels'] = $this->MobileModule->getModels();
        if (!empty($id) && isset($id)) {
            $data['mobileRecordEdit'] = $this->MobileModule->getMobileRecords($id);
            // print_r($data['mobileRecordEdit']);
        }
        $data['mobileRecords'] = $this->MobileModule->getMobileRecords();

        // print_r($data['mobileRecords']);
        $this->load->view('template/header', $data);
        $this->load->view('mobile/register_form');
        $this->load->view('template/footer');
    }

    function saveMobData() {
        $data = $_POST;
        $result = $this->MobileModule->saveMobileRecords($data);

        if ($result == 1) {//Inerted 
            header('Location:' . base_url('index.php/mobile/reg/ok'));
        } else {
            header('Location:' . base_url('index.php/mobile/reg/fail'));
        }
    }

}
