<?php

class Salesarcustomers extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('UsersModel');
        $this->load->model('MasterModule');
        $this->load->model('SalesarcustomersModule');
    }

    function secondaryCustomers($msg = null) {
        $functionID = 45;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 1;
        //$this->UsersModel->authenticateMeSubFunction($functionSubID);
        //die();
        $data['sess'] = $sess = $this->session->userdata('User');

        $data['title'] = 'Secondary A/R Customers';
        $data['pagetitle'] = 'Secondary A/R Customers';
        $data['msg'] = $msg;

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);


        if (!empty($id) && !is_null($id) && $id != -1) {
            
        }
        //$data['outlets'] = $this->SalesarcustomersModule->getCustomers();

        $this->load->view('template/header', $data);
        $this->load->view('secondary/ar/customers/index');
        $this->load->view('template/footer');
    }

    //ADD AND MAINTAIN CUSTOMERS
    function customers($id = null, $msg = null) {
        $functionID = 45;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 12;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);
        //die();

        $data['sess'] = $sess = $this->session->userdata('User');
        $location_ID = $sess['location'];
        //print_r($sess);

        $data['title'] = 'Secondary A/R Customers Data';
        $data['pagetitle'] = 'Secondary A/R Customers Data';
        $data['msg'] = $msg;

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        /*
          $data['OpData'] = $this->MasterModule->getOperations(null,$location_ID);
          $data['OperationAreaTerritoryCustomers']= $this->SalesarcustomersModule->getSecondaryCustomers(null, null, $location_ID);
         */
        //check the login user is an ASE(GRADE ID = 4)
        $data['ASE_Territory'] = null;
        $data['ASE_Area'] = null;
        $data['DateRange'] = null;
        $data['RouteList'] = NULL;
        $area_id = null;
        $data['RangeList'] = $this->MasterModule->getRange();
        $data['AreaList'] = $this->MasterModule->getArea(null, '001', 1);
        //$data['TerritoryDataSet']=$this->MasterModule->getTerritory();
        if ($sess['grade_id'] == 4) {
            $data['ASE_Area'] = $this->UsersModel->getAllowedAreas($sess['username']);
            //$area_id = $data['ASE_Area']->area_id;
            //$data['ASE_Territory'] = $this->MasterModule->getAreaTerritory(null, '001', $data['ASE_Area']->area_id);
        }
        $territoryID = null;
        $routeID = null;
        if (!empty($_POST['areaID']) && isset($_POST['areaID'])) {
            $area_id = $_POST['areaID'];
            if (!empty($_POST['territoryID']) && isset($_POST['territoryID'])) {
                $territoryID = $_POST['territoryID'];
            }
            if (!empty($_POST['routeID']) && isset($_POST['routeID'])) {
                $routeID = $_POST['routeID'];
            }
            if ($routeID == NULL && !empty($_POST['territoryID']) && isset($_POST['territoryID'])) {
                $data['RouteList'] = $this->SalesarcustomersModule->getRoutes($area_id, $territoryID);
            }
            $area_id=null;
            $data['outlets'] = $this->SalesarcustomersModule->getCustomers($area_id, null, $territoryID, $routeID);
        }

        $this->load->view('template/header', $data);
        $this->load->view('secondary/ar/customers/customers');
        $this->load->view('template/footer');
    }

    function routeUpdate() {
        $data = $_POST;
        $result = $this->SalesarcustomersModule->updateRoutes($data);
        if ($result == 1) {//Inerted 
            header('Location:' . base_url('index.php/salesarcustomers/customers/null/ok'));
        } else {
            header('Location:' . base_url('index.php/salesarcustomers/customers/null/fail'));
        }
    }

    function getTerritoryRouteAjax() {
        $data['sess'] = $sess = $this->session->userdata('User');
        if ($sess['grade_id'] == 4) {
            $data['area'] = $this->UsersModel->getAllowedAreas($sess['username']);
            $data['territory'] = $this->MasterModule->getAreaTerritory(null, '001', $data['area']->area_id);
            $data['territory'] = $this->MasterModule->getTerritoryRoute(null, '001', $data['area']->area_id, $territory);
        }
    }

    function editCustomers($id, $msg = null) {
        $functionID = 45;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 12;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);
        //die();

        $data['sess'] = $sess = $this->session->userdata('User');
        $location_ID = $sess['location'];
        //print_r($sess);

        $data['title'] = 'Secondary A/R Customers Data';
        $data['pagetitle'] = 'Secondary A/R Customers Data';
        $data['msg'] = $msg;

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();


        $area_id = null;
        if ($sess['grade_id'] == 4) {
            $data['ASE_Area'] = $this->UsersModel->getAllowedAreas($sess['username']);
            $area_id = $data['ASE_Area']->area_id;
            $data['ASE_Territory'] = $this->MasterModule->getAreaTerritory(null, '001', $area_id);
        }
        $data['OutletCategory'] = $this->MasterModule->getOutletCategory();

        $data['outlets'] = $this->SalesarcustomersModule->getCustomers($area_id, $id);
        $data['outletsNearby'] = $this->SalesarcustomersModule->getCustomersNearBy($data['outlets']->latitude, $data['outlets']->longitude, 1); //shops with in 1 km

        $this->load->view('template/header', $data);
        $this->load->view('secondary/ar/customers/editcustomer');
        $this->load->view('template/footer');
    }

    function updateOutlet() {
        $functionID = 45;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 12;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);

        $data = $_POST;
        $result = $this->SalesarcustomersModule->updateOutletData($data);
        if ($result == 1) {//Inerted 
            header('Location:' . base_url('index.php/salesarcustomers/editCustomers/' . $data['outlet']['id'] . '/ok'));
        } else {
            header('Location:' . base_url('index.php/salesarcustomers/editCustomers/' . $data['outlet']['id'] . '/fail'));
        }
    }

    function updateCustomer() {
        $functionID = 45;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 12;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);

        $data = $_POST;
        $result = $this->SalesarcustomersModule->saveCustomers($data);
        if ($result == 1) {//Inerted 
            header('Location:' . base_url('index.php/salesarcustomers/customers/-1/ok'));
        } else {
            header('Location:' . base_url('index.php/salesarcustomers/customers/-1/fail'));
        }
    }

    function secondaryCustomersPopup($id = null, $msg = null) {
        $functionID = 45;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 12;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);
        //die();

        $data['sess'] = $sess = $this->session->userdata('User');
        $location_ID = $sess['location'];

        $data['title'] = 'Secondary A/R Customers Data';
        $data['pagetitle'] = 'Secondary A/R Customers Data';
        $data['msg'] = $msg;

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();

        $data['OpData'] = $this->MasterModule->getOperations(null, $location_ID);
        $data['OperationAreaTerritoryCustomers'] = $this->SalesarcustomersModule->getSecondaryCustomers(null, null, $location_ID);


        $this->load->view('templatepopup/header', $data);
        $this->load->view('secondary/ar/customers/customers');
        $this->load->view('templatepopup/footer');
    }

    //REPORT DATA
    function newCustomerReport($msg = null) {
        $functionID = 45;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 24;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);
        //die();

        $data['sess'] = $sess = $this->session->userdata('User');
        $location_ID = $sess['location'];
        //print_r($sess);

        $data['title'] = 'Secondary A/R Customers Data';
        $data['pagetitle'] = 'Secondary A/R Customers Data';
        $data['msg'] = $msg;

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        /*
          $data['OpData'] = $this->MasterModule->getOperations(null,$location_ID);
          $data['OperationAreaTerritoryCustomers']= $this->SalesarcustomersModule->getSecondaryCustomers(null, null, $location_ID);
         */
        //check the login user is an ASE(GRADE ID = 4)
        $data['ASE_Territory'] = null;
        $data['ASE_Area'] = null;
        $data['DateRange'] = null;
        $area_id = null;
        $data['AreaList'] = $this->MasterModule->getArea(null, '001', 1);
        //sandun
        $data['TerritoryList'] = $this->MasterModule->getTerritory(null, '001', 1);
        //sandun
        //$data['TerritoryDataSet']=$this->MasterModule->getTerritory();
        if ($sess['grade_id'] == 4) {
            $data['ASE_Area'] = $this->UsersModel->getAllowedAreas($sess['username']);
            //$area_id = $data['ASE_Area']->area_id;
            //$data['ASE_Territory'] = $this->MasterModule->getAreaTerritory(null, '001', $data['ASE_Area']->area_id);
        }
        $territoryID = null;
        $routeID = null;
        $data['rpt_type'] = '';
        if (!empty($_POST['DateRange']) && isset($_POST['DateRange'])) {
            if (!empty($_POST['areaID']) && isset($_POST['areaID'])) {
                $area_id = $_POST['areaID'];
            }
            if (!empty($_POST['territoryID']) && isset($_POST['territoryID'])) {
                $territoryID = $_POST['territoryID'];
            }
            if (!empty($_POST['routeID']) && isset($_POST['routeID'])) {
                $routeID = $_POST['routeID'];
            }
            $data['DateRange'] = $DateRange = $_POST['DateRange'];
            $RangeArr = explode('-', $DateRange);
            $data['FromDate'] = $FromDate = str_replace('/', '', trim($RangeArr[0]));
            $data['ToDate'] = $ToDate = str_replace('/', '', trim($RangeArr[1]));
            $data['rpt_type'] = $rpt_type = $_POST['rpt_type'];
            $data['outlets'] = $this->SalesarcustomersModule->getNewCustomers($area_id, $FromDate, $ToDate, $territoryID, $routeID, $rpt_type);
            $data['outletsDetails'] = $this->SalesarcustomersModule->getNewCustomersDetails($area_id, $FromDate, $ToDate, $territoryID, $routeID, $rpt_type);
            //print_r($data['outlets']);
        }

        $this->load->view('template/header', $data);
        $this->load->view('secondary/ar/customers/rpt_new_customers');
        $this->load->view('template/footer');
    }

    //SETUP DISPLAY ORDER IN ROUTE
    function shopOrder($id = null, $msg = null) {
        $functionID = 45;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 34;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);
        //die();

        $data['sess'] = $sess = $this->session->userdata('User');
        $location_ID = $sess['location'];
        //print_r($sess);

        $data['title'] = 'Display Order Secondary A/R Customers Data';
        $data['pagetitle'] = 'Display Order Secondary A/R Customers Data';
        $data['msg'] = $msg;

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        /*
          $data['OpData'] = $this->MasterModule->getOperations(null,$location_ID);
          $data['OperationAreaTerritoryCustomers']= $this->SalesarcustomersModule->getSecondaryCustomers(null, null, $location_ID);
         */
        //check the login user is an ASE(GRADE ID = 4)
        $data['ASE_Territory'] = null;
        $data['ASE_Area'] = null;
        $data['DateRange'] = null;
        $area_id = null;
        $data['AreaList'] = $this->MasterModule->getArea(null, '001', 1);
        //$data['TerritoryDataSet']=$this->MasterModule->getTerritory();
        if ($sess['grade_id'] == 4) {
            $data['ASE_Area'] = $this->UsersModel->getAllowedAreas($sess['username']);
            //$area_id = $data['ASE_Area']->area_id;
            //$data['ASE_Territory'] = $this->MasterModule->getAreaTerritory(null, '001', $data['ASE_Area']->area_id);
        }
        $territoryID = null;
        $routeID = null;
        if ((!empty($_POST['areaID']) && isset($_POST['areaID'])) && (!empty($_POST['territoryID']) && isset($_POST['territoryID'])) && (!empty($_POST['routeID']) && isset($_POST['routeID']))) {
            $area_id = $_POST['areaID'];
            if (!empty($_POST['territoryID']) && isset($_POST['territoryID'])) {
                $territoryID = $_POST['territoryID'];
            }
            if (!empty($_POST['routeID']) && isset($_POST['routeID'])) {
                $routeID = $_POST['routeID'];
            }
            $data['area_id'] = $area_id;
            $data['territory_id'] = $territoryID;
            $data['route_id'] = $routeID;

            $data['areaData'] = $this->MasterModule->getArea($area_id);
            $data['territoryData'] = $this->MasterModule->getTerritory($territoryID);
            $data['routeData'] = $this->MasterModule->getRoute($routeID);

            $data['outlets'] = $this->SalesarcustomersModule->getCustomers($area_id, null, $territoryID, $routeID, 1);
        }

        $this->load->view('template/header', $data);
        $this->load->view('secondary/ar/customers/customers_order');
        $this->load->view('template/footer');
    }

    function shopOrderSave() {
        $functionID = 45;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 34;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);
        $data = $_POST;
        $result = $this->SalesarcustomersModule->saveCustomersOrders($data);
        if ($result == 1) {//Inerted 
            header('Location:' . base_url('index.php/salesarcustomers/shopOrder/-1/ok'));
        } else {
            header('Location:' . base_url('index.php/salesarcustomers/shopOrder/-1/fail'));
        }
    }

    //SHOP UPDATE PROCESS
    /*
    function outletUpdate($msg = null) {
        $functionID = 45;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 41;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);
        $data['sess'] = $sess = $this->session->userdata('User');
        $location_ID = $sess['location'];

        $data['title'] = 'Secondary A/R Customers Data';
        $data['pagetitle'] = 'Secondary A/R Customers Data';
        $data['msg'] = $msg;

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();

        $data['ASE_Territory'] = null;
        $data['ASE_Area'] = null;
        $data['DateRange'] = null;
        $data['RouteList'] = NULL;
        $area_id = null;
        $data['AreaList'] = $this->MasterModule->getArea(null, '001', 1);
        //$data['TerritoryDataSet']=$this->MasterModule->getTerritory();
        if ($sess['grade_id'] == 4) {
            $data['ASE_Area'] = $this->UsersModel->getAllowedAreas($sess['username']);
            //$area_id = $data['ASE_Area']->area_id;
            //$data['ASE_Territory'] = $this->MasterModule->getAreaTerritory(null, '001', $data['ASE_Area']->area_id);
        }
        $territoryID = null;
        $routeID = null;
        if (!empty($_POST['areaID']) && isset($_POST['areaID'])) {
            $area_id = $_POST['areaID'];
            if (!empty($_POST['territoryID']) && isset($_POST['territoryID'])) {
                $territoryID = $_POST['territoryID'];
            }
            if (!empty($_POST['routeID']) && isset($_POST['routeID'])) {
                $routeID = $_POST['routeID'];
            }
            if ((!empty($_POST['territoryID']) && isset($_POST['territoryID'])) || $routeID != NULL) {
                //$data['RouteList'] = $this->SalesarcustomersModule->getRoutes($area_id, $territoryID);
                $data['outlets'] = $this->SalesarcustomersModule->getUpdateCustomers($area_id, null, $territoryID, $routeID, 1);
            }
            $data['outletsUpdateProgress'] = $this->SalesarcustomersModule->getUpdateCustomers($area_id, null, $territoryID, $routeID, 1, 'summery');
        }
        $this->load->view('template/header', $data);
        $this->load->view('secondary/ar/customers/update_customers');
        $this->load->view('template/footer');
    }
    */
    //2024 02 05 new shop update process
    function outletUpdate($msg = null) {
        $functionID = 45;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 41;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);
        $data['sess'] = $sess = $this->session->userdata('User');
        $location_ID = $sess['location'];

        $data['title'] = 'Secondary A/R Customers Data';
        $data['pagetitle'] = 'Secondary A/R Customers Data';
        $data['msg'] = $msg;

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();

        $data['ASE_Territory'] = null;
        $data['ASE_Area'] = null;
        $data['DateRange'] = null;
        $data['RouteList'] = NULL;
        $data['Area_ID'] = $area_id = null;
        $data['RangeList'] = $this->MasterModule->getRange();
        $data['AreaList'] = $this->MasterModule->getArea(null, '001', 1);
        //$data['TerritoryDataSet']=$this->MasterModule->getTerritory();
        if ($sess['grade_id'] == 4) {
            $data['ASE_Area'] = $this->UsersModel->getAllowedAreas($sess['username']);
            //$area_id = $data['ASE_Area']->area_id;
            //$data['ASE_Territory'] = $this->MasterModule->getAreaTerritory(null, '001', $data['ASE_Area']->area_id);
        }
        $territoryID = null;
        $routeID = null;
        $rangeid = null;
        $filter = null;

        $data['territoryID'] = null;
        $data['routeID'] = null;
        $data['rangeid'] = null;
        $data['filter'] = null;
        
        if (!empty($_POST['filter']) && isset($_POST['filter'])) {
            $filter = $_POST['filter'];
            $data['filter'] = $_POST['filter'];
        }
        if (!empty($_POST['areaID']) && isset($_POST['areaID'])) {
            $data['Area_ID'] = $area_id = $_POST['areaID'];
            if (!empty($_POST['territoryID']) && isset($_POST['territoryID'])) {
                $territoryID = $_POST['territoryID'];
                $data['territoryID'] = $_POST['territoryID'];
            }
            if (!empty($_POST['routeID']) && isset($_POST['routeID'])) {
                $routeID = $_POST['routeID'];
                $data['routeID'] = $_POST['routeID'];
            }            
            if (!empty($_POST['rangeID']) && isset($_POST['rangeID'])) {
                $rangeid = $_POST['rangeID'];
                $data['rangeid'] = $_POST['rangeID'];
            }
            if ((!empty($_POST['territoryID']) && isset($_POST['territoryID'])) || $routeID != NULL) {
                //$data['RouteList'] = $this->SalesarcustomersModule->getRoutes($area_id, $territoryID);
                $data['outlets'] = $this->SalesarcustomersModule->getUpdateCustomers($area_id, null, $territoryID, $routeID, 1,'details',$rangeid,$filter);
            }
            if($area_id==-1){
                $area_id=null;
            }
            $data['outletsUpdateProgress'] = $this->SalesarcustomersModule->getUpdateCustomers($area_id, null, $territoryID, $routeID, 1, 'summery',$rangeid,5);
        }
        $this->load->view('template/header', $data);
        $this->load->view('secondary/ar/customers/update_customers');
        $this->load->view('template/footer');
    }
    function outletUpdateSave(){
        $functionID = 45;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 41;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);
        $data['sess'] = $sess = $this->session->userdata('User');
        $location_ID = $sess['location'];
        $data=$_POST;
        $result =$this->SalesarcustomersModule->processShopUpdate($data);
        if ($result == 1) {//Inerted 
            header('Location:' . base_url('index.php/salesarcustomers/outletUpdate/ok'));
        } else {
            header('Location:' . base_url('index.php/salesarcustomers/outletUpdate/fail'));
        }
    }
    function getUpdatedCustomer($id, $msg = null) {
        $functionID = 45;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 41;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);
        //die();

        $data['sess'] = $sess = $this->session->userdata('User');
        $location_ID = $sess['location'];
        //print_r($sess);

        $data['title'] = 'Secondary A/R Customers Data';
        $data['pagetitle'] = 'Secondary A/R Customers Data';
        $data['msg'] = $msg;

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();


        $area_id = null;
        if ($sess['grade_id'] == 4) {
            $data['ASE_Area'] = $this->UsersModel->getAllowedAreas($sess['username']);
            $area_id = 0;
            foreach ($data['ASE_Area'] as $a) {
                $area_id = $a['area_id'];
            }
            $data['ASE_Territory'] = $this->MasterModule->getAreaTerritory(null, '001', $area_id);
        }
        $data['OutletCategory'] = $this->MasterModule->getOutletCategory();
        if ($id != '-1' && $id != NULL) {
            $data['outlets'] = $this->SalesarcustomersModule->getUpdateCustomers($area_id, $id);
            $data['outletsNearby'] = $this->SalesarcustomersModule->getCustomersNearBy($data['outlets']->latitude_up, $data['outlets']->longitude_up, 0.5); //shops with in 1 km
        }
        $this->load->view('template/header', $data);
        $this->load->view('secondary/ar/customers/updatecustomer');
        $this->load->view('template/footer');
    }

    function saveUpdatedOutlet() {
        $functionID = 45;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 41;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);
        //die();
        $data = $_POST;
        $result = $this->SalesarcustomersModule->saveShopUpdate($data);
        $sid = $data['outlet']['id'];
        if ($result == 1) {//Inerted 
            header('Location:' . base_url('index.php/salesarcustomers/getUpdatedCustomer/' . $sid . '/ok'));
        } else {
            header('Location:' . base_url('index.php/salesarcustomers/getUpdatedCustomer/' . $sid . '/fail'));
        }
    }
    
    //RATASAVARI
    function promoStatus($msg = null,$id=null){
        $functionID = 45;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 42;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);
        //die();

        $data['sess'] = $sess = $this->session->userdata('User');
        $location_ID = $sess['location'];
        //print_r($sess);

        $data['title'] = 'Secondary A/R Customers Data';
        $data['pagetitle'] = 'Secondary A/R Customers Data';
        $data['msg'] = $msg;

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();


        //check the login user is an ASE(GRADE ID = 4)
        $data['ASE_Territory'] = null;
        $data['ASE_Area'] = null;
        $data['DateRange'] = null;
        $data['RouteList'] = NULL;
        $data['RangeID'] = null;
        $area_id = null;
        $data['AreaList'] = $this->MasterModule->getArea(null, '001', 1);
        $data['RangeList'] = $this->MasterModule->getRange();
        //$data['TerritoryDataSet']=$this->MasterModule->getTerritory();
        if ($sess['grade_id'] == 4) {
            $data['ASE_Area'] = $this->UsersModel->getAllowedAreas($sess['username']);
            //$area_id = $data['ASE_Area']->area_id;
            //$data['ASE_Territory'] = $this->MasterModule->getAreaTerritory(null, '001', $data['ASE_Area']->area_id);
        }
        $territoryID = null;
        $routeID = null;
        $AcceptStatus=NULL;
        if (!empty($_POST['areaID']) && isset($_POST['areaID'])) {
            $area_id = $_POST['areaID'];
            if (!empty($_POST['territoryID']) && isset($_POST['territoryID'])) {
                $territoryID = $_POST['territoryID'];
            }
            if (!empty($_POST['routeID']) && isset($_POST['routeID'])) {
                $routeID = $_POST['routeID'];
            }
            if ($routeID == NULL && !empty($_POST['territoryID']) && isset($_POST['territoryID'])) {
                //$data['RouteList'] = $this->SalesarcustomersModule->getRoutes($area_id, $territoryID);
            }
            if (!empty($_POST['rangeID']) && isset($_POST['rangeID'])) {
                $data['RangeID'] = $rangeID = $_POST['rangeID'];
            }
            if (!empty($_POST['AcceptStatus']) && isset($_POST['AcceptStatus'])) {
                $data['AcceptStatus'] = $AcceptStatus = $_POST['AcceptStatus'];
            }
            
            $data['outlets'] = $this->SalesarcustomersModule->getCustomersPromotions($area_id, null, $territoryID, $routeID,$rangeID,$AcceptStatus);
        }

        $this->load->view('template/header', $data);
        $this->load->view('secondary/ar/customers/customers_promotion');
        $this->load->view('template/footer');
    }

    //GET VISIT COUNT TO A SHOP FOR A GIVEN PERIOD
    function visitStatus($msg=null){
        $functionID = 45;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 46;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);
        //die();

        $data['sess'] = $sess = $this->session->userdata('User');
        $location_ID = $sess['location'];
        //print_r($sess);

        $data['title'] = 'Secondary A/R Customers Data';
        $data['pagetitle'] = 'Secondary A/R Customers Data';
        $data['msg'] = $msg;

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        
        $data['ASE_Territory'] = null;
        $data['ASE_Area'] = null;
        $data['DateRange'] = null;
        $data['RouteList'] = NULL;
        $area_id = null;
        $data['AreaList'] = $this->MasterModule->getArea(null, '001', 1);
        //$data['TerritoryDataSet']=$this->MasterModule->getTerritory();
        if ($sess['grade_id'] == 4) {
            $data['ASE_Area'] = $this->UsersModel->getAllowedAreas($sess['username']);
            //$area_id = $data['ASE_Area']->area_id;
            //$data['ASE_Territory'] = $this->MasterModule->getAreaTerritory(null, '001', $data['ASE_Area']->area_id);
        }
        $territoryID = null;
        $routeID = null;
        
        if (!empty($_POST['areaID']) && isset($_POST['areaID'])) {
            $area_id = $_POST['areaID'];
            if (!empty($_POST['territoryID']) && isset($_POST['territoryID'])) {
                $territoryID = $_POST['territoryID'];
            }
            if (!empty($_POST['routeID']) && isset($_POST['routeID'])) {
                $routeID = $_POST['routeID'];
            }
            if ($routeID == NULL && !empty($_POST['territoryID']) && isset($_POST['territoryID'])) {
                $data['RouteList'] = $this->SalesarcustomersModule->getRoutes($area_id, $territoryID);
            }
            $data['outlets'] = $this->SalesarcustomersModule->getCustomersVisits($area_id, null, $territoryID, $routeID);
        }
        
        $this->load->view('template/header', $data);
        $this->load->view('secondary/ar/customers/customer_visits');
        $this->load->view('template/footer');
    }
     function shopList($id = null, $msg = null) {
        $functionID = 45;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 12;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);
        //die();

        $data['sess'] = $sess = $this->session->userdata('User');
        $location_ID = $sess['location'];
        //print_r($sess);

        $data['title'] = 'Secondary A/R Customers Data';
        $data['pagetitle'] = 'Secondary A/R Customers Data';
        $data['msg'] = $msg;

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        /*
          $data['OpData'] = $this->MasterModule->getOperations(null,$location_ID);
          $data['OperationAreaTerritoryCustomers']= $this->SalesarcustomersModule->getSecondaryCustomers(null, null, $location_ID);
         */
        //check the login user is an ASE(GRADE ID = 4)
        $data['ASE_Territory'] = null;
        $data['ASE_Area'] = null;
        $data['DateRange'] = null;
        $data['RouteList'] = NULL;
        $area_id = null;
        $data['AreaList'] = $this->MasterModule->getArea(null, '001', 1);
        //$data['TerritoryDataSet']=$this->MasterModule->getTerritory();
        if ($sess['grade_id'] == 4) {
            $data['ASE_Area'] = $this->UsersModel->getAllowedAreas($sess['username']);
            //$area_id = $data['ASE_Area']->area_id;
            //$data['ASE_Territory'] = $this->MasterModule->getAreaTerritory(null, '001', $data['ASE_Area']->area_id);
        }
        $territoryID = null;
        $routeID = null;
        if (!empty($_POST['areaID']) && isset($_POST['areaID'])) {
            $area_id = $_POST['areaID'];
            if (!empty($_POST['territoryID']) && isset($_POST['territoryID'])) {
                $territoryID = $_POST['territoryID'];
            }
            if (!empty($_POST['routeID']) && isset($_POST['routeID'])) {
                $routeID = $_POST['routeID'];
            }
            if ($routeID == NULL && !empty($_POST['territoryID']) && isset($_POST['territoryID'])) {
                $data['RouteList'] = $this->SalesarcustomersModule->getRoutes($area_id, $territoryID);
            }
            $data['outlets'] = $this->SalesarcustomersModule->getCustomers($area_id, null, $territoryID, $routeID);
        }

        $this->load->view('template/header', $data);
        $this->load->view('secondary/ar/customers/shop_list');
        $this->load->view('template/footer');
    }
    
}

?>