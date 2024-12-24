<?php
class Glreports extends CI_Controller{
	function __construct() {
        parent::__construct();        
        $this->load->model('UsersModel');
        $this->load->model('AccountreceivableModule');
		$this->load->model('GeneralledgerModule');
		$this->load->model('ItemsModel');  
    }
	//Load Icons
    function index($msg=null){
        $functionID = 43;
        $this->UsersModel->authenticateMe($functionID);
        //$functionSubID = 1;
        //$this->UsersModel->authenticateMeSubFunction($functionSubID);
        //die();
        
        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'G/L Reports';
        $data['pagetitle'] = 'G/L Reports';
        $data['msg'] = $msg;

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);
        
        $this->load->view('template/header', $data);
        $this->load->view('gl/index');
        $this->load->view('template/footer');
    }
	function journalentrydetails($msg=null){
		//Check Main Module and SUB  Access
        $functionID = 43;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 8;
        $this->UsersModel->authenticateMeSubFunction($functionID,$functionSubID);
        
        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        
        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'G/L Reports - Journal Entry Report';
        $data['pagetitle'] = 'G/L Reports - Journal Entry Report';
        $data['msg'] = $msg;
        
        $data['location']=$this->ItemsModel->getLocationList();
        //print_r($data['ASEList']);
              
        $this->load->view('template/header', $data);
        $this->load->view('gl/journalentry');
        $this->load->view('template/footer');		
	}
	function generateJournalEntryRpt(){
		if(!empty($_POST) && isset($_POST)){
			$data['parameter']=$_POST;
			//print_r($data['parameter']); die();
            $this->GeneralledgerModule->executeInvoicePaymentRpt($data['parameter'],$_POST['GenerateReport']);            
        }
	}
}
?>