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
        $data['SMSSetAllocated']=null;
        //GET Unallocated SMS DATA    
        $fromDate='2000-01-01';//applied date is 2000-01-01 means un allocated sms received before the raffle start
        $isRaffelProcessed=0;//to get un allocated sms data
        $data['RaffleDate']='';
        $data['SMSSetUnallocated']=$this->SmsModule->getValidSmsFromDatabase($isRaffelProcessed,$fromDate);
        $data['RaffleDate']='';
        $data['unallocatedQty']=0;
        if(!empty($_POST['RaffleDate']) && isset($_POST['RaffleDate'])){
            $data['RaffleDate']=$_POST['RaffleDate'];
            $fromDate=$data['RaffleDate'];//applied date is 2000-01-01 means un allocated sms received before the raffle start
            $isRaffelProcessed=0;//to get allocated sms data
            $data['unallocatedQty']=$_POST['unallocatedQty'];
            $data['SMSSetAllocated']=$this->SmsModule->getValidSmsFromDatabase($isRaffelProcessed,$fromDate);//set already allocated sms received with in the selected date
            //set sms from unallocated to selected date
            $this->SmsModule->setSMSforRaffleandDraw($fromDate,$data['unallocatedQty']);
        }
        
        $this->load->view('template/header', $data);
        $this->load->view('secondary/sms/winnerDraw');
        $this->load->view('template/footer');
    }
    function viewWinners($fromDate=null,$msg=null){
        $functionID = 80;
        $this->UsersModel->authenticateMe($functionID);
        //$functionSubID = 79;
        //$this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);

        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'SMS ';
        $data['pagetitle'] = 'Time Attendance';
        $data['msg'] = $msg;
        
        $data['RaffleDate']=$fromDate;
        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['Winners']=$this->SmsModule->getWinners($fromDate,1);//set already allocated sms received with in the selected date
            
        $this->load->view('template/header', $data);
        $this->load->view('secondary/sms/winners');
        $this->load->view('template/footer');
    }
    
    function editWinners($id=null,$fromDate=null,$msg=null){
        $functionID = 80;
        $this->UsersModel->authenticateMe($functionID);
        //$functionSubID = 79;
        //$this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);

        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'SMS ';
        $data['pagetitle'] = 'Time Attendance';
        $data['msg'] = $msg;
        
        $data['RaffleDate']=$fromDate;
        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['Winners']=$this->SmsModule->getWinners($fromDate,1);//set already allocated sms received with in the selected date
        $data['WinnerData']=$this->SmsModule->getWinners($fromDate,1,$id);//set already allocated sms received with in the selected date
            
        $this->load->view('template/header', $data);
        $this->load->view('secondary/sms/winners_edit');
        $this->load->view('template/footer');
    }
    function saveWinner(){
        $functionID = 80;
        $this->UsersModel->authenticateMe($functionID);
        $dateFrom=$_POST['applied_date'];
        $id=$_POST['row_id'];
        $dateFrom=$_POST['applied_date'];
        $result=$this->SmsModule->updateWinners($_POST);
        if ($result == 1) {//Inserted 
            header('Location:' . base_url('index.php/sms/editWinners/'.$id.'/'.$dateFrom.'/ok'));
        } else {
            header('Location:' . base_url('index.php/sms/editWinners/'.$id.'/'.$dateFrom.'/fail'));
        }
    }
}