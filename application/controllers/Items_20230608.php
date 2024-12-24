<?php
class Items extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('UsersModel');
        $this->load->model('ItemsModel');
    }
    //ITEM LOCATION CREATIONS
    function itemLocation($id = NULL, $msg = NULL) {
        $functionID = 4;
        $this->UsersModel->authenticateMe($functionID);

        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'Enahsus Software';
        $data['pagetitle'] = 'Locations - Enahsus Software';
        $data['msg'] = $msg;

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();

        $data['loclist'] = $this->ItemsModel->getLocationList();
        if (!empty($id) && !is_null($id) && $id != -1) {
            $data['locationdata'] = $this->ItemsModel->getLocationList($id);
        }

        $this->load->view('template/header', $data);
        $this->load->view('items/location');
        $this->load->view('template/footer');
    }

    function updateLocation() {
        $functionID = 4;
        $this->UsersModel->authenticateMe($functionID);

        $data = $_POST;
        $result = $this->ItemsModel->updateLocationData($data);
        if ($result == 1) {
            header('location:' . base_url('index.php/items/itemLocation/-1/ok'));
        } else {
            header('location:' . base_url('index.php/items/itemLocation/-1/fail'));
        }
    }
    function updateLocData() {
        $functionID = 4;
        $this->UsersModel->authenticateMe($functionID);
        $user=$_POST['id'];
        $reqType=$_POST['reqType'];
        $updateVal=$_POST['upVal'];
        echo $this->ItemsModel->updateLocation($user,$reqType,$updateVal);
    }
	function getItemListPopup($id){
		$data['rowID']=$id;
		$data['itemPriceList']=$this->ItemsModel->getItemPrice();
		$this->load->view('templatepopup/header', $data);
        $this->load->view('items/popup_item_forinv');
        $this->load->view('templatepopup/footer');
	}
}