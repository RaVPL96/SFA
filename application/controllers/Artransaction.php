<?php
class Artransaction extends CI_Controller{
    function __construct() {
        parent::__construct();        
        $this->load->model('UsersModel');
        $this->load->model('AccountreceivableModule');
		$this->load->model('ItemsModel');  
    }
    //Load Icons
    function index($msg=null){
        $functionID = 34;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 1;
        //$this->UsersModel->authenticateMeSubFunction($functionSubID);
        //die();
        
        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'A/R Transaction Reports';
        $data['pagetitle'] = 'A/R Transaction Reports';
        $data['msg'] = $msg;

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);
        
        if (!empty($id) && !is_null($id) && $id != -1) {
            
        }

        $this->load->view('template/header', $data);
        $this->load->view('ar/index');
        $this->load->view('template/footer');
    }
    
    /*

     * GET DIRECT SALES RELATED TO A ASE -ALL COMPANY DATABASES
     * 
     *      */
    function debtorsReportAse($msg=null){
        //Check Main Module and SUB  Access
        $functionID = 34;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 1;
        $this->UsersModel->authenticateMeSubFunction($functionID,$functionSubID);
        
        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        
        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'Debtors List Report - ASE Wise(Direct Sales)';
        $data['pagetitle'] = 'Debtors List Report - ASE Wise(Direct Sales)';
        $data['msg'] = $msg;
        
        //GET ASE LIST FROM RMIS DATABASE
        $data['ASEList'] =$this->AccountreceivableModule->getASEList();
        //print_r($data['ASEList']);
              
        $this->load->view('template/header', $data);
        $this->load->view('ar/debtorsReportAse');
        $this->load->view('template/footer');        
    }
	function generateDebtorReport($SaveAs=1){
		if(!empty($_POST) && isset($_POST)){
			$data['parameter']=$_POST;
			//echo $_POST['GenerateReport']; die();
            $this->AccountreceivableModule->executeDebtorListASEWise($_POST['AsAtDate'],  substr($_POST['CustomerCode'], 2, 6),$data['parameter'],$_POST['GenerateReport']);            
        }  
	}
	
	/*

     * GET A/R Invoice Entry data -ALL COMPANY DATABASES
     * 
     *      */
    function invoiceEntryReport($msg=null){
        //Check Main Module and SUB  Access
        $functionID = 34;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 4;
        $this->UsersModel->authenticateMeSubFunction($functionID,$functionSubID);
        
        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        
        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'A/R Invoice Entry Report';
        $data['pagetitle'] = 'A/R Invoice Entry Report';
        $data['msg'] = $msg;
        
		$data['location']=$this->ItemsModel->getLocationList();
        //GET ASE LIST FROM RMIS DATABASE
        $data['ASEList'] =$this->AccountreceivableModule->getASEList();
        //print_r($data['ASEList']);
              
        $this->load->view('template/header', $data);
        $this->load->view('ar/invoiceEntryReport');
        $this->load->view('template/footer');        
    }
	function generateInvoiceEntryRpt($SaveAs=1){
		if(!empty($_POST) && isset($_POST)){
			$data['parameter']=$_POST;
			//print_r($data['parameter']); die();
            $this->AccountreceivableModule->executeInvoiceEntryRpt($data['parameter'],$_POST['GenerateReport']);            
        }  
	}
	
	//get invoice related payments
	function getinvoicePayment($msg=null){
		//Check Main Module and SUB  Access
        $functionID = 34;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 6;
        $this->UsersModel->authenticateMeSubFunction($functionID,$functionSubID);
        
        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        
        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'A/R Invoice Payments Report';
        $data['pagetitle'] = 'A/R Invoice Payments Report';
        $data['msg'] = $msg;
        
		$data['location']=$this->ItemsModel->getLocationList();
        //GET ASE LIST FROM RMIS DATABASE
        //$data['ASEList'] =$this->AccountreceivableModule->getASEList();
        //print_r($data['ASEList']);
              
        $this->load->view('template/header', $data);
        $this->load->view('ar/invoicePaymentReport');
        $this->load->view('template/footer');
	}
	function generateInvoicePaymentRpt($SaveAs=1){
		if(!empty($_POST) && isset($_POST)){
			$data['parameter']=$_POST;
			//print_r($data['parameter']); die();
            $this->AccountreceivableModule->executeInvoicePaymentRpt($data['parameter'],$_POST['GenerateReport']);            
        }  
	}
}

?>