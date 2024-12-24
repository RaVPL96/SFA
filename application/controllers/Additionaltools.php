<?php 
class Additionaltools extends CI_Controller{
	function __construct() {
        parent::__construct();
        $this->load->model('UsersModel');		
        $this->load->model('UsersModel');
        $this->load->model('MasterModule');
		$this->load->model('AdditionaltoolsModule');	
	}
	function SMSLists($id=null,$msg=null){
		$functionID = 42;
        $this->UsersModel->authenticateMe($functionID);
        //$data['userlist'] = $this->UsersModel->getUserList();
		$data['sop_id']='';
        if (!empty($_POST['sms']['sop_id']) && isset($_POST['sms']['sop_id']) && !is_null($_POST['sms']['sop_id']) && $_POST['sms']['sop_id']!=-1) {
			$data['sop_id']=$_POST['sms']['sop_id'];
			$data['RepList'] = $this->MasterModule->getOperationAreaTerritorySalesRep(null,$_POST['sms']['sop_id']);
		}        
		if (!empty($id) && isset($id) && !is_null($id) && $id!=-1) {
			$data['RepListSMS'] = $this->AdditionaltoolsModule->getOperationAreaTerritorySalesRepSMS($id);
			//print_r($data['RepListSMS']);
			$data['SMSListData']=$this->AdditionaltoolsModule->getSMSList($id);
			$data['RepList'] = $this->MasterModule->getOperationAreaTerritorySalesRep(null,$data['SMSListData']->sales_operation_id);
		} 
		$data['OpData'] = $this->MasterModule->getOperations();
		
		$data['SMSList']=$this->AdditionaltoolsModule->getSMSList();
		//print_r($data['SMSList']);
		//$data['OperationAreaTerritoryRepSMS']=$this->AdditionaltoolsModule->getOperationAreaTerritorySalesRepSMS();
		//$data['RepList'] = $this->UsersModel->getUserList(NULL, NULL, null, REPGRADEID );
		
        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
		
		//GET SECONDARY

        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'Sales Operation Area - Territory Rep';
        $data['pagetitle'] = 'Sales Operation Area - Territory Rep';
        $data['msg'] = $msg;

        $this->load->view('template/header', $data);
        $this->load->view('tools/index');
        $this->load->view('template/footer');
	}
	function SMSListsSave(){
		$functionID = 42;
        $this->UsersModel->authenticateMe($functionID);
		$data=$_POST;
		$result=$this->AdditionaltoolsModule->saveSMSList($data);
		if ($result == 1) {//Inerted 
            header('Location:' . base_url('index.php/additionaltools/SMSLists/-1/ok'));
        } else {
            header('Location:' . base_url('index.php/additionaltools/SMSLists/-1/fail'));
        }
	}
	function SendSMS(){
		$date=$_POST['AsAt'];
		$result=$this->AdditionaltoolsModule->deliverSMS($date);
	}
}

?>