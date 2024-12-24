<?php

class Master extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('UsersModel');
        $this->load->model('MasterModule');
    }

    //function to set Zone Architecture
    //ZONE ARCHITECTURE AND ITS MAPPINGS
    function createZone($id = null, $msg = null) {
        $functionID = 52;
        $this->UsersModel->authenticateMe($functionID);
        $data['userlist'] = $this->UsersModel->getUserList();
        $data['sess'] = $sess = $this->session->userdata('User');
        $location_ID = $sess['location'];

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);

        $data['title'] = 'Sales Zone Architecture';
        $data['pagetitle'] = COMPANY;
        $data['msg'] = $msg;

        $data['ZoneDataSet'] = $this->MasterModule->getZone();
        if (!empty($id) && isset($id) && $id != null) {
            $data['ZoneData'] = $this->MasterModule->getZone($id);
        }

        $this->load->view('template/header', $data);
        $this->load->view('master/mst_zone');
        $this->load->view('template/footer');
    }

    function saveZone() {
        $functionID = 52;
        $this->UsersModel->authenticateMe($functionID);
        $data = $_POST;
        $result = $this->MasterModule->saveZone($data);
        if ($result == 1) {//Inerted 
            header('Location:' . base_url('index.php/master/createZone/-1/ok'));
        } else {
            header('Location:' . base_url('index.php/master/createZone/-1/fail'));
        }
    }

    //CRETATE ZONE MAPPINGS
    function createZoneMapping($id = null, $msg = null) {
        $functionID = 53;
        $this->UsersModel->authenticateMe($functionID);
        $data['userlist'] = $this->UsersModel->getUserList();
        $data['sess'] = $sess = $this->session->userdata('User');
        $location_ID = $sess['location'];

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);

        $data['title'] = 'Sales Zone Mappings';
        $data['pagetitle'] = COMPANY;
        $data['msg'] = $msg;

        $data['ZoneDataSet'] = $this->MasterModule->getZone();
        $data['ZoneMapDataSet'] = $this->MasterModule->getZoneMap();
        if (!empty($id) && isset($id) && $id != null) {
            $data['ZoneData'] = $this->MasterModule->getZone($id);
        }

        $this->load->view('template/header', $data);
        $this->load->view('master/mst_zone_map');
        $this->load->view('template/footer');
    }

    function saveZoneMapping() {
        $functionID = 53;
        $this->UsersModel->authenticateMe($functionID);
        $data = $_POST;
        $result = $this->MasterModule->saveZoneMapping($data);
        if ($result == 1) {//Inerted 
            header('Location:' . base_url('index.php/master/createZoneMapping/-1/ok'));
        } else {
            header('Location:' . base_url('index.php/master/createZoneMapping/-1/fail'));
        }
    }

    //CRETATE SALES CHANNELS
    function createChannel($id = null, $msg = null) {
        $functionID = 54;
        $this->UsersModel->authenticateMe($functionID);
        $data['userlist'] = $this->UsersModel->getUserList();
        $data['sess'] = $sess = $this->session->userdata('User');
        $location_ID = $sess['location'];

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);

        $data['title'] = 'Sales Channel Architecture';
        $data['pagetitle'] = COMPANY;
        $data['msg'] = $msg;

        $data['ChannelDataSet'] = $this->MasterModule->getChannel();
        if (!empty($id) && isset($id) && $id != null) {
            $data['ChannelData'] = $this->MasterModule->getChannel($id);
        }
        //print_r($data['ChannelDataSet']);
        $this->load->view('template/header', $data);
        $this->load->view('master/mst_channel');
        $this->load->view('template/footer');
    }

    //SAVE SALES CHANNELS
    function saveChannel() {
        $functionID = 54;
        $this->UsersModel->authenticateMe($functionID);
        $data = $_POST;
        $result = $this->MasterModule->saveChannel($data);
        if ($result == 1) {//Inerted 
            header('Location:' . base_url('index.php/master/createChannel/-1/ok'));
        } else {
            header('Location:' . base_url('index.php/master/createChannel/-1/fail'));
        }
    }

    //CRETATE SALES OPERATIONS UNDER CHANNELS
    function createOperation($id = null, $msg = null) {
        $functionID = 55;
        $this->UsersModel->authenticateMe($functionID);
        $data['userlist'] = $this->UsersModel->getUserList();
        $data['sess'] = $sess = $this->session->userdata('User');
        $location_ID = $sess['location'];

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);

        $data['title'] = 'Sales Channel Architecture';
        $data['pagetitle'] = COMPANY;
        $data['msg'] = $msg;

        $data['OperationDataSet'] = $this->MasterModule->getOperation();
        if (!empty($id) && isset($id) && $id != null) {
            $data['OperationData'] = $this->MasterModule->getOperation($id);
        }
        //print_r($data['ChannelDataSet']);
        $this->load->view('template/header', $data);
        $this->load->view('master/mst_operation');
        $this->load->view('template/footer');
    }

    //SAVE SALES OPERATIONS UNDER CHANNELS
    function saveOperation() {
        $functionID = 55;
        $this->UsersModel->authenticateMe($functionID);
        $data = $_POST;
        $result = $this->MasterModule->saveOperation($data);
        if ($result == 1) {//Inerted 
            header('Location:' . base_url('index.php/master/createOperation/-1/ok'));
        } else {
            header('Location:' . base_url('index.php/master/createOperation/-1/fail'));
        }
    }

    //CRETATE SALES ITEM RANGE UNDER OPERATION = BILL BOOK
    function createRange($id = null, $msg = null) {
        $functionID = 56;
        $this->UsersModel->authenticateMe($functionID);
        $data['userlist'] = $this->UsersModel->getUserList();
        $data['sess'] = $sess = $this->session->userdata('User');
        $location_ID = $sess['location'];

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);

        $data['title'] = 'Sales Item Range Architecture';
        $data['pagetitle'] = COMPANY;
        $data['msg'] = $msg;

        $data['RangeDataSet'] = $this->MasterModule->getRange();
        if (!empty($id) && isset($id) && $id != null) {
            $data['RangeData'] = $this->MasterModule->getRange($id);
        }
        //print_r($data['ChannelDataSet']);
        $this->load->view('template/header', $data);
        $this->load->view('master/mst_range');
        $this->load->view('template/footer');
    }

    //SAVE SALES ITEM RANGE UNDER OPERATION = BILL BOOK
    function saveRange() {
        $functionID = 56;
        $this->UsersModel->authenticateMe($functionID);
        $data = $_POST;
        $result = $this->MasterModule->saveRange($data);
        if ($result == 1) {//Inerted 
            header('Location:' . base_url('index.php/master/createRange/-1/ok'));
        } else {
            header('Location:' . base_url('index.php/master/createRange/-1/fail'));
        }
    }

    //============================================
    //====GEOGRAPHY DEMARCATION===================
    //============================================
    //CRETATE SALES REGION
    function createRegion($id = null, $msg = null) {
        $functionID = 57;
        $this->UsersModel->authenticateMe($functionID);
        $data['userlist'] = $this->UsersModel->getUserList();
        $data['sess'] = $sess = $this->session->userdata('User');
        $location_ID = $sess['location'];

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);

        $data['title'] = 'Sales Item Range Architecture';
        $data['pagetitle'] = COMPANY;
        $data['msg'] = $msg;

        $data['RegionDataSet'] = $this->MasterModule->getRegion();
        if (!empty($id) && isset($id) && $id != null) {
            $data['RegionData'] = $this->MasterModule->getRegion($id);
        }
        //print_r($data['ChannelDataSet']);
        $this->load->view('template/header', $data);
        $this->load->view('master/mst_region');
        $this->load->view('template/footer');
    }

    //SAVE SALES REGION
    function saveRegion() {
        $functionID = 57;
        $this->UsersModel->authenticateMe($functionID);
        $data = $_POST;
        $result = $this->MasterModule->saveRegion($data);
        if ($result == 1) {//Inerted 
            header('Location:' . base_url('index.php/master/createRegion/-1/ok'));
        } else {
            header('Location:' . base_url('index.php/master/createRegion/-1/fail'));
        }
    }

    //CRETATE SALES AREA
    function createArea($id = null, $msg = null) {
        $functionID = 58;
        $this->UsersModel->authenticateMe($functionID);
        $data['userlist'] = $this->UsersModel->getUserList();
        $data['sess'] = $sess = $this->session->userdata('User');
        $location_ID = $sess['location'];

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);

        $data['title'] = 'Sales Area Architecture';
        $data['pagetitle'] = COMPANY;
        $data['msg'] = $msg;

        $data['AreaDataSet'] = $this->MasterModule->getArea();
        if (!empty($id) && isset($id) && $id != null) {
            $data['AreaData'] = $this->MasterModule->getArea($id);
        }
        //print_r($data['ChannelDataSet']);
        $this->load->view('template/header', $data);
        $this->load->view('master/mst_area');
        $this->load->view('template/footer');
    }

    //SAVE SALES AREA
    function saveArea() {
        $functionID = 58;
        $this->UsersModel->authenticateMe($functionID);
        $data = $_POST;
        $result = $this->MasterModule->saveArea($data);
        if ($result == 1) {//Inerted 
            header('Location:' . base_url('index.php/master/createArea/-1/ok'));
        } else {
            header('Location:' . base_url('index.php/master/createArea/-1/fail'));
        }
    }

    //CRETATE SALES REGION-AREA MAPPING
    function mapRegionArea($id = null, $msg = null) {
        $functionID = 59;
        $this->UsersModel->authenticateMe($functionID);
        $data['userlist'] = $this->UsersModel->getUserList();
        $data['sess'] = $sess = $this->session->userdata('User');
        $location_ID = $sess['location'];

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);

        $data['title'] = 'Sales Region Area Mapping Architecture';
        $data['pagetitle'] = COMPANY;
        $data['msg'] = $msg;

        $data['RegionDataSet'] = $this->MasterModule->getRegion();
        $data['AreaDataSet'] = $this->MasterModule->getArea();
        $data['RegionAreaDataSet'] = $this->MasterModule->getRegionArea();

        if (!empty($id) && isset($id) && $id != null) {
            $data['RegionAreaData'] = $this->MasterModule->getRegionArea($id);
        }
        //print_r($data['ChannelDataSet']);
        $this->load->view('template/header', $data);
        $this->load->view('master/mst_region_area');
        $this->load->view('template/footer');
    }

    //SAVE SALES REGION-AREA MAPPING
    function saveRegionArea() {
        $functionID = 59;
        $this->UsersModel->authenticateMe($functionID);
        $data = $_POST;
        $result = $this->MasterModule->saveRegionArea($data);
        if ($result == 1) {//Inerted 
            header('Location:' . base_url('index.php/master/mapRegionArea/-1/ok'));
        } else {
            header('Location:' . base_url('index.php/master/mapRegionArea/-1/fail'));
        }
    }

    //CRETATE SALES TERRITORY
    function createTerritory($id = null, $msg = null) {
        $functionID = 60;
        $this->UsersModel->authenticateMe($functionID);
        $data['userlist'] = $this->UsersModel->getUserList();
        $data['sess'] = $sess = $this->session->userdata('User');
        $location_ID = $sess['location'];

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);

        $data['title'] = 'Sales Territory Architecture';
        $data['pagetitle'] = COMPANY;
        $data['msg'] = $msg;

        $data['TerritoryDataSet'] = $this->MasterModule->getTerritory();
        if (!empty($id) && isset($id) && $id != null) {
            $data['TerritoryData'] = $this->MasterModule->getTerritory($id);
        }
        //print_r($data['ChannelDataSet']);
        $this->load->view('template/header', $data);
        $this->load->view('master/mst_territory');
        $this->load->view('template/footer');
    }

    //SAVE SALES TERRITORY
    function saveTerritory() {
        $functionID = 60;
        $this->UsersModel->authenticateMe($functionID);
        $data = $_POST;
        $result = $this->MasterModule->saveTerritory($data);
        if ($result == 1) {//Inerted 
            header('Location:' . base_url('index.php/master/createTerritory/-1/ok'));
        } else {
            header('Location:' . base_url('index.php/master/createTerritory/-1/fail'));
        }
    }

    //CRETATE SALES AREA-TERRITORY MAPPING
    function mapAreaTerritory($id = null, $msg = null) {
        $functionID = 61;
        $this->UsersModel->authenticateMe($functionID);
        $data['userlist'] = $this->UsersModel->getUserList();
        $data['sess'] = $sess = $this->session->userdata('User');
        $location_ID = $sess['location'];

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);

        $data['title'] = 'Sales Area Territory Mapping Architecture';
        $data['pagetitle'] = COMPANY;
        $data['msg'] = $msg;

        //$data['RegionDataSet']=$this->MasterModule->getRegion();
        $data['AreaDataSet'] = $this->MasterModule->getArea();
        $data['TerritoryDataSet'] = $this->MasterModule->getTerritory();
        $data['AreaTerritoryDataSet'] = $this->MasterModule->getAreaTerritory();

        if (!empty($id) && isset($id) && $id != null) {
            $data['AreaTerritoryData'] = $this->MasterModule->getAreaTerritory($id);
        }
        //print_r($data['ChannelDataSet']);
        $this->load->view('template/header', $data);
        $this->load->view('master/mst_area_territory');
        $this->load->view('template/footer');
    }

    //SAVE SALES AREA-TERRITORY MAPPING
    function saveAreaTerritory() {
        $functionID = 61;
        $this->UsersModel->authenticateMe($functionID);
        $data = $_POST;
        $result = $this->MasterModule->saveAreaTerritory($data);
        if ($result == 1) {//Inerted 
            header('Location:' . base_url('index.php/master/mapAreaTerritory/-1/ok'));
        } else {
            header('Location:' . base_url('index.php/master/mapAreaTerritory/-1/fail'));
        }
    }
    
    //Get territory and area mapping on ajax request
    function getTerritoryListAjax(){
        $str='<option value=""> -- Select Territory -- </option>';
        if (!empty($_GET['areaid']) && isset($_GET['areaid']) && $_GET['areaid'] != null) {
            $areaid=$_GET['areaid'];
            $AreaTerritoryData = $this->MasterModule->getAreaTerritory(null,'001',$areaid);
            if(!empty($AreaTerritoryData) && isset($AreaTerritoryData)){
                foreach ($AreaTerritoryData as $v) {
                    $str=$str. '<option value="'.$v['territory_id'].'">'.$v['territory_name'].'</option>';
                }
            }
        }
        echo $str;
    }

    //CRETATE SALES ROUTE
    function createRoute($id = null, $msg = null) {
        $functionID = 62;
        $this->UsersModel->authenticateMe($functionID);
        $data['userlist'] = $this->UsersModel->getUserList();
        $data['sess'] = $sess = $this->session->userdata('User');
        $location_ID = $sess['location'];

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);

        $data['title'] = 'Sales Route Architecture';
        $data['pagetitle'] = COMPANY;
        $data['msg'] = $msg;

        $data['RouteDataSet'] = $this->MasterModule->getRoute();
        if (!empty($id) && isset($id) && $id != null) {
            $data['RouteData'] = $this->MasterModule->getRoute($id);
        }
        //print_r($data['ChannelDataSet']);
        $this->load->view('template/header', $data);
        $this->load->view('master/mst_route');
        $this->load->view('template/footer');
    }

    //SAVE SALES Route
    function saveRoute() {
        $functionID = 62;
        $this->UsersModel->authenticateMe($functionID);
        $data = $_POST;
        $result = $this->MasterModule->saveRoute($data);
        if ($result == 1) {//Inerted 
            header('Location:' . base_url('index.php/master/createRoute/-1/ok'));
        } else {
            header('Location:' . base_url('index.php/master/createRoute/-1/fail'));
        }
    }

    //CRETATE SALES TERRITORY ROUTE MAPPING
    function mapTerritoryRoute($id = null, $msg = null) {
        $functionID = 63;
        $this->UsersModel->authenticateMe($functionID);
        $data['userlist'] = $this->UsersModel->getUserList();
        $data['sess'] = $sess = $this->session->userdata('User');
        $location_ID = $sess['location'];

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);

        $data['title'] = 'Sales Area Territory Mapping Architecture';
        $data['pagetitle'] = COMPANY;
        $data['msg'] = $msg;

        //$data['RegionDataSet']=$this->MasterModule->getRegion();
        //$data['AreaDataSet']=$this->MasterModule->getArea();
        $data['TerritoryDataSet'] = $this->MasterModule->getTerritory();
        $data['RouteDataSet'] = $this->MasterModule->getRoute();
        $data['TerritoryRouteDataSet'] = $this->MasterModule->getTerritoryRoute();

        if (!empty($id) && isset($id) && $id != null) {
            $data['TerritoryRouteData'] = $this->MasterModule->getTerritoryRoute($id);
        }
        //print_r($data['ChannelDataSet']);
        $this->load->view('template/header', $data);
        $this->load->view('master/mst_territory_route');
        $this->load->view('template/footer');
    }

    //SAVE SALES  TERRITORY ROUTE MAPPING
    function saveTerritoryRoute() {
        $functionID = 63;
        $this->UsersModel->authenticateMe($functionID);
        $data = $_POST;
        $result = $this->MasterModule->saveTerritoryRoute($data);
        if ($result == 1) {//Inerted 
            header('Location:' . base_url('index.php/master/mapTerritoryRoute/-1/ok'));
        } else {
            header('Location:' . base_url('index.php/master/mapTerritoryRoute/-1/fail'));
        }
    }
    //GET Territory related route 
    function getRouteListAjax(){
        $str='<option value=""> -- Select Route -- </option>';
        if ((!empty($_GET['areaid']) && isset($_GET['areaid']) && $_GET['areaid'] != null) && !empty($_GET['territoryID']) && isset($_GET['territoryID']) && $_GET['territoryID'] != null) {
            $areaid=$_GET['areaid'];
            $territoryID=$_GET['territoryID'];
            $AreaTerritoryRouteData = $this->MasterModule->getTerritoryRoute(null,'001',$areaid,$territoryID);
            if(!empty($AreaTerritoryRouteData) && isset($AreaTerritoryRouteData)){
                foreach ($AreaTerritoryRouteData as $v) {
                    $str=$str. '<option value="'.$v['route_id'].'">'.$v['route_reference_code'].' - '.$v['route_name'].'</option>';
                }
            }
        }
        echo $str;
    }
}
