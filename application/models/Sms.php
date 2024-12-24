<?php
class Sms extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('UsersModel');
        $this->load->model('MasterModule');
        $this->load->model('SmsModule'); 
    }
    function getSMStoSystem(){
        echo '11';
        $this->SmsModule->getSmstoDatabase();
    }
    function getValidSMStoSystem(){
        echo '11';
        $this->SmsModule->validateSmstoDatabase();
    }
    function ReceivedSMS($msg=null){
        $functionID = 79;
        $this->UsersModel->authenticateMe($functionID);
        //$functionSubID = 79;
        //$this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);

        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'SMS ';
        $data['pagetitle'] = 'Time Attendance';
        $data['msg'] = $msg;

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        
        $data['SMSSet']=$this->SmsModule->getSmsFromDatabase();
        
        $this->load->view('template/header', $data);
        $this->load->view('secondary/sms/allSMS');
        $this->load->view('template/footer');
    }
    function SelectWinners($msg=null){
        $functionID = 80;
        $this->UsersModel->authenticateMe($functionID);
        //$functionSubID = 79;
        //$this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);

        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'SMS ';
        $data['pagetitle'] = 'Time Attendance';
        $data['msg'] = $msg;

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        
        $data['SMSSet']=$this->SmsModule->getValidSmsFromDatabase();
        
        $this->load->view('template/header', $data);
        $this->load->view('secondary/sms/winnerDraw');
        $this->load->view('template/footer');
    }
}