<?php
class Cashbook extends CI_Controller{
    function __construct() {
        parent::__construct();        
        $this->load->model('UsersModel');
        $this->load->model('CashbookModule');
		$this->load->model('ItemsModel');  
    }
	
	function index($msg=null){
        $functionID = 48;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 1;
        //$this->UsersModel->authenticateMeSubFunction($functionSubID);
        //die();
        
        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'Cashbook Reports';
        $data['pagetitle'] = 'Cashbook Reports';
        $data['msg'] = $msg;

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);
        print_r($data['menuIcons']);
        if (!empty($id) && !is_null($id) && $id != -1) {
            
        }

        $this->load->view('template/header', $data);
        $this->load->view('cb/index');
        $this->load->view('template/footer');
    }
	function getAdvancePay($msg=null){
		//Check Main Module and SUB  Access
        $functionID = 48;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 18;
        $this->UsersModel->authenticateMeSubFunction($functionID,$functionSubID);
        
        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        
        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'Advance Payment - Cashbook Report';
        $data['pagetitle'] = 'Advance Payment - Cashbook Report';
        $data['msg'] = $msg;
        
        $data['location']=$this->ItemsModel->getLocationList();
        //print_r($data['ASEList']);
		$data['POResult']=null;
		if(!empty($_POST['rptData']) && isset($_POST['rptData'])){
			$data=$_POST['rptData'];
			$data['POResult']=$this->CashbookModule->getChequeData($data);
		}
              
        $this->load->view('template/header', $data);
        $this->load->view('cb/advancepay');
        $this->load->view('template/footer');		
	}
}
?>