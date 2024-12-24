<?php
class Icstockcontrolreports extends CI_Controller{
    function __construct() {
        parent::__construct();        
        $this->load->model('UsersModel');
		$this->load->model('ItemsModel');    
        $this->load->model('InventrycontrolModule');
    }
    //Load Icons
    function index($msg=null){
        $functionID = 35;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 2;
        //$this->UsersModel->authenticateMeSubFunction($functionSubID);
        //die();
        
        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'I/C Stock Control Reports';
        $data['pagetitle'] = 'I/C Stock Control Report';
        $data['msg'] = $msg;

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);
        
        if (!empty($id) && !is_null($id) && $id != -1) {
            
        }

        $this->load->view('template/header', $data);
        $this->load->view('ic/stockcontrol/index');
        $this->load->view('template/footer');
    }
	function fgStockVsOrdQty($msg=null){
		$functionID = 35;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 2;
        $this->UsersModel->authenticateMeSubFunction($functionID,$functionSubID);
        
        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        
        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'FG Stock Vs Order Quantity';
        $data['pagetitle'] = 'FG Stock Vs Order Quantity';
        $data['msg'] = $msg;
        
        //GET ASE LIST FROM RMIS DATABASE
        //$data['ASEList'] =$this->AccountreceivableModule->getASEList();
        //print_r($data['ASEList']);
              
        $this->load->view('template/header', $data);
        $this->load->view('ic/stockcontrol/fgstockvsordqty');
        $this->load->view('template/footer');    
	}
	function generateStockReport($SaveAs=1){
		if(!empty($_POST) && isset($_POST)){
			$data['parameter']=$_POST;
			//echo $_POST['GenerateReport']; die();
            $this->InventrycontrolModule->executeFGStockReport($data['parameter'],$_POST['GenerateReport']);            
        }  
	}
	function executeTNCFGStockReport($SaveAs=1){
		if(!empty($_POST) && isset($_POST)){
			$data['parameter']=$_POST;
			//echo $_POST['GenerateReport']; die();
            $this->InventrycontrolModule->executeTNCFGStockReport($data['parameter'],$_POST['GenerateReport']);            
        }  
	}
	function executeTNCRMStockReport($SaveAs=1){
		if(!empty($_POST) && isset($_POST)){
			$data['parameter']=$_POST;
			//echo $_POST['GenerateReport']; die();
            $this->InventrycontrolModule->executeRMStockReport($data['parameter'],$_POST['GenerateReport']);            
        }  
	}
	
	//IC SHIPMENTS Report
	function getShipments($msg=null){	
		$functionID = 35;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 10;
        $this->UsersModel->authenticateMeSubFunction($functionID,$functionSubID);
		$data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        
        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'I/C Shipments Details Report';
        $data['pagetitle'] = 'I/C Shipments Details Report';
        $data['msg'] = $msg;
        
		$data['location']=$this->ItemsModel->getLocationList();
		
              
        $this->load->view('template/header', $data);
        $this->load->view('ic/stockcontrol/shipments');
        $this->load->view('template/footer');  
	}
	function getShipmentsData($SaveAs=1){
		if(!empty($_POST) && isset($_POST)){
			$data['parameter']=$_POST;
			//echo $_POST['GenerateReport']; die();
            $this->InventrycontrolModule->executeShipmentsReport($data['parameter'],$_POST['GenerateReport']);            
        }  
	}
	//RECEIPTS
	function getReceipts($msg=null){	
		$functionID = 35;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 11;
        $this->UsersModel->authenticateMeSubFunction($functionID,$functionSubID);
		$data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        
        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'I/C Receipts Details Report';
        $data['pagetitle'] = 'I/C Receipts Details Report';
        $data['msg'] = $msg;
        
		$data['location']=$this->ItemsModel->getLocationList();
		
              
        $this->load->view('template/header', $data);
        $this->load->view('ic/stockcontrol/receipts');
        $this->load->view('template/footer');  
	}
	function getReceiptsData($SaveAs=1){
		if(!empty($_POST) && isset($_POST)){
			$data['parameter']=$_POST;
			//echo $_POST['GenerateReport']; die();
            $this->InventrycontrolModule->executeReceiptReport($data['parameter'],$_POST['GenerateReport']);            
        }  
	}
}
?>