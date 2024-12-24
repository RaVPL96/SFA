<?php

class Old_Master extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('UsersModel');
        $this->load->model('Old_masterModule');     
    }
	//SALES OPERATION DATA
	function salesArea($id=null, $msg=null){
		$functionID = 49;
        $this->UsersModel->authenticateMe($functionID);
        $data['userlist'] = $this->UsersModel->getUserList();
        $data['sess'] = $sess = $this->session->userdata('User');
        $location_ID=$sess['location'];
				
		$data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);	
		
		//GET SECONDARY
		$data['areaList'] = $this->Old_masterModule->getAreaH();
		if(!empty($id) && isset($id) && $id!='-1' && $id!=-1){
			$data['areaData'] = $this->Old_masterModule->getAreaH($id);
		}

        $data['title'] = 'Sales Area Names';
        $data['pagetitle'] = COMPANY;
        $data['msg'] = $msg;

        $this->load->view('template/header', $data);
        $this->load->view('old_master/sop_areas.php');
        $this->load->view('template/footer');
	}
	function updateSalesArea(){
		$functionID = 49;
        $this->UsersModel->authenticateMe($functionID);
        $data= $_POST;
		$result=$this->Old_masterModule->saveAreaData($data);
		if ($result == 1) {//Inerted 
			header('Location:' . base_url('index.php/old_master/salesArea/-1/ok'));
		} else {
			header('Location:' . base_url('index.php/old_master/salesArea/-1/fail'));
		}
	}
	
	//AGENCY DATA
	function salesAgency($id=null, $msg=null){
		$functionID = 50;
        $this->UsersModel->authenticateMe($functionID);
        $data['userlist'] = $this->UsersModel->getUserList();
        $data['sess'] = $sess = $this->session->userdata('User');
        $location_ID=$sess['location'];
				
		$data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);	
		
		//GET SECONDARY
		$data['areaList'] = $this->Old_masterModule->getAgency();
		if(!empty($id) && isset($id) && $id!='-1' && $id!=-1){
			$data['areaData'] = $this->Old_masterModule->getAreaH($id);
		}

        $data['title'] = 'Sales Area Names';
        $data['pagetitle'] = COMPANY;
        $data['msg'] = $msg;

        $this->load->view('template/header', $data);
        $this->load->view('old_master/sop_agency.php');
        $this->load->view('template/footer');
	}
	
	//ITEMS MASTER
	function itemsData($id=null, $msg=null){
		$functionID = 51;
		$this->UsersModel->authenticateMe($functionID);
        $data['userlist'] = $this->UsersModel->getUserList();
        $data['sess'] = $sess = $this->session->userdata('User');
        $location_ID=$sess['location'];
				
		$data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);	
		
		//GET SECONDARY
		$data['areaList'] = $this->Old_masterModule->getAgency();
		if(!empty($id) && isset($id) && $id!='-1' && $id!=-1){
			$data['areaData'] = $this->Old_masterModule->getAreaH($id);
		}

        $data['title'] = 'Sales Items Names';
        $data['pagetitle'] = COMPANY;
        $data['msg'] = $msg;

        $this->load->view('template/header', $data);
        $this->load->view('old_master/sop_items.php');
        $this->load->view('template/footer');
	}
}