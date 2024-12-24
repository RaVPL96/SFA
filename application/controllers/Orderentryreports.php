<?php
class Orderentryreports extends CI_Controller{
    function __construct() {
        parent::__construct();        
        $this->load->model('UsersModel');
        $this->load->model('OrderentryModule');
		$this->load->model('ItemsModel');     
    }
	//Load Icons
    function index($msg=null){
        $functionID = 36;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 3;
        //$this->UsersModel->authenticateMeSubFunction($functionSubID);
        //die();
        
        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'O/E Reports';
        $data['pagetitle'] = 'O/E Report';
        $data['msg'] = $msg;

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);
        
        if (!empty($id) && !is_null($id) && $id != -1) {
            
        }

        $this->load->view('template/header', $data);
        $this->load->view('oe/reports/index');
        $this->load->view('template/footer');
    }
	//PENDING ORDER QUANTITY DETAILREPORT ITEMWISE
	function ItemOrderDataDetail($msg=null){
		$functionID = 36;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 3;
        $this->UsersModel->authenticateMeSubFunction($functionID,$functionSubID);
        
        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        
        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'Pending Order Quantity Item-wise';
        $data['pagetitle'] = 'Pending Order Quantity Item-wise';
        $data['msg'] = $msg;
        
		$data['location']=$this->ItemsModel->getLocationList();
        //GET ASE LIST FROM RMIS DATABASE
        //$data['ASEList'] =$this->AccountreceivableModule->getASEList();
        //print_r($data['ASEList']);
              
        $this->load->view('template/header', $data);
        $this->load->view('oe/reports/ordqty');
        $this->load->view('template/footer');    
	}
	function generateItemOrdDetail($SaveAs=1){
		if(!empty($_POST) && isset($_POST)){
			$data['parameter']=$_POST;
			$_POST['GenerateReport'];
            $this->OrderentryModule->executeItemOrdDetailReport($data['parameter'],$_POST['GenerateReport']);            
        }  
	}
	function getErpInvoiceData($msg=null){
		$functionID = 36;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 5;
        $this->UsersModel->authenticateMeSubFunction($functionID,$functionSubID);
		$data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        
        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'OE Invoice Detail/Summery Reports';
        $data['pagetitle'] = 'OE Invoice Detail/Summery Reports';
        $data['msg'] = $msg;
        
		$data['location']=$this->ItemsModel->getLocationList();
        //GET ASE LIST FROM RMIS DATABASE
        //$data['ASEList'] =$this->AccountreceivableModule->getASEList();
        //print_r($data['ASEList']);
              
        $this->load->view('template/header', $data);
        $this->load->view('oe/reports/invRpt');
        $this->load->view('template/footer');  
	}
	function genErpInvoiceData(){
		if(!empty($_POST) && isset($_POST)){
			$data['parameter']=$_POST;
			$_POST['GenerateReport'];
            $this->OrderentryModule->executeItemInvDetailReport($data['parameter'],$_POST['GenerateReport']);            
        }
	}
	function salesHistorySummery($msg=null){
		$functionID = 36;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 7;
        $this->UsersModel->authenticateMeSubFunction($functionID,$functionSubID);
		$data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        
        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'OE Sales History Reports';
        $data['pagetitle'] = 'OE Sales History  Reports';
        $data['msg'] = $msg;
        
		$data['location']=$this->ItemsModel->getLocationList();
        //GET ASE LIST FROM RMIS DATABASE
        //$data['ASEList'] =$this->AccountreceivableModule->getASEList();
        //print_r($data['ASEList']);
              
        $this->load->view('template/header', $data);
        $this->load->view('oe/reports/oe_saleshistory');
        $this->load->view('template/footer');  
	}
	function genErpSalesHistoryData(){
		if(!empty($_POST) && isset($_POST)){
			$data['parameter']=$_POST;
			$_POST['GenerateReport'];
            $this->OrderentryModule->executeItemSalesHistoryReport($data['parameter'],$_POST['GenerateReport']);            
        }
	}
	//ORDERS NOT YET INVOICES
	function getNotInvoiced($msg=null){
		$functionID = 36;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 9;
        $this->UsersModel->authenticateMeSubFunction($functionID,$functionSubID);
		$data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        
        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'O/E Orders NOT Invoiced';
        $data['pagetitle'] = 'O/E Orders NOT Invoiced';
        $data['msg'] = $msg;
        
		$data['location']=$this->ItemsModel->getLocationList();
		
              
        $this->load->view('template/header', $data);
        $this->load->view('oe/reports/oe_ordnotinv');
        $this->load->view('template/footer');  
	}
	function getNotInvoicedData(){
		if(!empty($_POST) && isset($_POST)){
			$data['parameter']=$_POST;
			$_POST['GenerateReport'];
            $this->OrderentryModule->executeNotInvoicedReport($data['parameter'],$_POST['GenerateReport']);            
        }
	}
}
?>