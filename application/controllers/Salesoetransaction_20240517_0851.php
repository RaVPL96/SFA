<?php

class Salesoetransaction extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('UsersModel');
        $this->load->model('MasterModule');
        $this->load->model('SalesarcustomersModule');
        $this->load->model('SalesoerderentryModule');
        $this->load->model('ItemsModel');
        $this->load->model('CommonModule');
        $this->load->model('SalesreportModule');
        $this->load->model('ItemsModel');

    }

    //Load Icons
    function index($msg = null) {
        $functionID = 46;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 1;
        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'O/E Transactions';
        $data['pagetitle'] = 'O/E Transactions';
        $data['msg'] = $msg;
        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);
        $this->load->view('template/header', $data);
        $this->load->view('secondary/oe/index');
        $this->load->view('template/footer');
    }

    function transactionReports($msg = null) {
        $functionID = 67;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 1;
        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'Reports - O/E Transactions';
        $data['pagetitle'] = 'Reports - O/E Transactions';
        $data['msg'] = $msg;
        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);
        $this->load->view('template/header', $data);
        $this->load->view('secondary/oe/reportindex');
        $this->load->view('template/footer');
    }

    //booking value report
    function invoiceReport($msg = null) {
        $functionID = 67;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 19;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);
        $data['sess'] = $sess = $this->session->userdata('User');
        //print_r($data['sess']);
        $data['title'] = 'Reports - O/E Transactions';
        $data['pagetitle'] = 'Reports - O/E Transactions';
        $data['msg'] = $msg;
        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);
        $FromDate = '';
        $ToDate = '';
        $data['DateRange'] = '';
        $data['ordersH'] = null;
        $channelList = null;
        $data['gps'] = null;
        $data['AreaList'] = $this->MasterModule->getArea(null, '001', 1);
        $data['RangeList'] = $this->MasterModule->getRange();
        //check the login user is an ASE(GRADE ID = 4)
        $data['ASE_Territory'] = null;
        $data['ASE_Area'] = null;
        $data['TimeAttendance'] = null;
        $data['DateRange'] = null;
        $data['AreaID'] = null;
        $data['TerritoryID'] = null;
        $data['RangeID'] = null;
        $area_id = null;
        $territoryID=null;
        if ($sess['grade_id'] == 4) {
            $data['ASE_Area'] = $this->UsersModel->getAllowedAreas($sess['username']);
            //$area_id = $data['ASE_Area']->area_id;
            //$data['ASE_Territory'] = $this->MasterModule->getAreaTerritory(null, '001', $data['ASE_Area']->area_id);
        }
        if (!empty($_POST['DateRange']) && isset($_POST['DateRange'])) {
            //print_r($_POST);
            if (!empty($_POST['channel']) && isset($_POST['channel'])) {
                $channelList = $_POST['channel'];
            }

            $data['DateRange'] = $DateRange = $_POST['DateRange'];
            $RangeArr = explode('-', $DateRange);
            $FromDate = str_replace('/', '-', trim($RangeArr[0]));
            $ToDate = str_replace('/', '-', trim($RangeArr[1]));
            $salesRep = '';

            if (!empty($_POST['areaID']) && isset($_POST['areaID'])) {
                $data['AreaID']=$area_id = $_POST['areaID'];
            }

            if (!empty($_POST['territoryID']) && isset($_POST['territoryID'])) {
                $data['TerritoryID'] =$territoryID= $_POST['territoryID'];
                $data['territory']=$this->MasterModule->getAreaTerritory(null,001,$area_id);
            }

            if (!empty($_POST['rangeID']) && isset($_POST['rangeID'])) {
                $data['RangeID'] = $_POST['rangeID'];
            }
            //OTHER FILTERS FOR USERS EXCEPT SALES REP
            $data['ChannelDataSet'] = $this->MasterModule->getChannel();
            $data['ordersH'] = $this->SalesoerderentryModule->getOrdersH($FromDate, $ToDate, '', $salesRep, $channelList, 'detail', $data['AreaID'], $data['TerritoryID'], $data['RangeID']);
            //$data['gps'] = $this->SalesoerderentryModule->getGps($FromDate, $ToDate, $sess['username']);
            //$data['shopgps'] = $this->SalesoerderentryModule->getShopGps();
            $data['ReportTitle']=$this->CommonModule->getTitle('Area Sales Summery Item-wise',1,$area_id,$territoryID,'','Bookings',$FromDate, $ToDate);
        }

        //die();
        $this->load->view('template/header', $data);
        $this->load->view('secondary/oe/report_oe_inv');
        $this->load->view('template/footer');
    }

    function invoiceView($msg = null) {
        $functionID = 67;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 19;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);
        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'Reports - O/E Transactions';
        $data['pagetitle'] = 'Reports - O/E Transactions';
        $data['msg'] = $msg;
        $data['invData'] = null;
        if (!empty($_POST['idinvoice']) && isset($_POST['idinvoice'])) {
            $invNum = $_POST['idinvoice'];
            $FromDate = '';
            $ToDate = '';
            $data['invDataH'] = $this->SalesoerderentryModule->getOrdersH($FromDate, $ToDate, $invNum);
            $data['invDataD'] = $this->SalesoerderentryModule->getOrdersD($FromDate, $ToDate, $invNum);
        }

        $this->load->view('secondary/oe/inv_preview', $data);
    }

    function callTime($msg = null) {
        $functionID = 67;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 36;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);
        $data['sess'] = $sess = $this->session->userdata('User');
        //print_r($data['sess']);
        $data['title'] = 'Reports - O/E Transactions';
        $data['pagetitle'] = 'Reports - O/E Transactions';
        $data['msg'] = $msg;
        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);
        $FromDate = '';
        $ToDate = '';
        $data['DateRange'] = '';
        $data['ordersH'] = null;
        $channelList = null;
        $data['gps'] = null;
        $data['AreaList'] = $this->MasterModule->getArea(null, '001', 1);
        $data['RangeList'] = $this->MasterModule->getRange();
        //check the login user is an ASE(GRADE ID = 4)
        $data['ASE_Territory'] = null;
        $data['ASE_Area'] = null;
        $data['TimeAttendance'] = null;
        $data['DateRange'] = null;
        $data['AreaID'] = null;
        $data['TerritoryID'] = null;
        $data['RangeID'] = null;
        $area_id = NULL;
        $territoryID=NULL;
        if ($sess['grade_id'] == 4) {
            $data['ASE_Area'] = $this->UsersModel->getAllowedAreas($sess['username']);
            //$area_id = $data['ASE_Area']->area_id;
            //$data['ASE_Territory'] = $this->MasterModule->getAreaTerritory(null, '001', $data['ASE_Area']->area_id);
        }
        if (!empty($_POST['DateRange']) && isset($_POST['DateRange'])) {
            //print_r($_POST);
            if (!empty($_POST['channel']) && isset($_POST['channel'])) {
                $channelList = $_POST['channel'];
            }

            $data['DateRange'] = $DateRange = $_POST['DateRange'];
            $RangeArr = explode('-', $DateRange);
            $FromDate = str_replace('/', '-', trim($RangeArr[0]));
            $ToDate = str_replace('/', '-', trim($RangeArr[1]));
            $salesRep = '';

            if (!empty($_POST['areaID']) && isset($_POST['areaID'])) {
                $data['AreaID']=$area_id = $_POST['areaID'];
            }

            if (!empty($_POST['territoryID']) && isset($_POST['territoryID'])) {
                $data['TerritoryID']=$territoryID = $_POST['territoryID'];                
                $data['territory']=$this->MasterModule->getAreaTerritory(null,001,$area_id);
            }

            if (!empty($_POST['rangeID']) && isset($_POST['rangeID'])) {
                $data['RangeID'] = $_POST['rangeID'];
            }
            //OTHER FILTERS FOR USERS EXCEPT SALES REP
            $data['ChannelDataSet'] = $this->MasterModule->getChannel();
            $data['ordersH'] = $this->SalesoerderentryModule->getOrdersH($FromDate, $ToDate, '', $salesRep, $channelList, 'detail', $data['AreaID'], $data['TerritoryID'], $data['RangeID']);
            //$data['gps'] = $this->SalesoerderentryModule->getGps($FromDate, $ToDate, $sess['username']);
            //$data['shopgps'] = $this->SalesoerderentryModule->getShopGps();
            $data['ReportTitle']=$this->CommonModule->getTitle('Sales Details with Call Time',1,$area_id,$territoryID,'','Bookings',$FromDate, $ToDate);
        }

        //die();
        $this->load->view('template/header', $data);
        if($data['RangeID']==7){
            $this->load->view('secondary/oe/report_oe_inv_call_key');
        }else{
            $this->load->view('secondary/oe/report_oe_inv_call');
        }
        $this->load->view('template/footer');
    }
    
    //MADE CALL REPORT
    function madeCall($msg = null){
        $functionID = 67;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 66;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);
        $data['sess'] = $sess = $this->session->userdata('User');
        //print_r($data['sess']);
        $data['title'] = 'Reports - O/E Transactions';
        $data['pagetitle'] = 'Reports - O/E Transactions';
        $data['msg'] = $msg;
        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);
        $FromDate = '';
        $ToDate = '';
        $data['DateRange'] = '';
        $data['ordersH'] = null;
        $channelList = null;
        $data['gps'] = null;
        $data['AreaList'] = $this->MasterModule->getArea(null, '001', 1);
        $data['RangeList'] = $this->MasterModule->getRange();
        //check the login user is an ASE(GRADE ID = 4)
        $data['ASE_Territory'] = null;
        $data['ASE_Area'] = null;
        $data['TimeAttendance'] = null;
        $data['DateRange'] = null;
        $data['AreaID'] = null;
        $data['TerritoryID'] = null;
        $data['RangeID'] = null;
        $area_id = NULL;
        $territoryID=NULL;
        if ($sess['grade_id'] == 4) {
            $data['ASE_Area'] = $this->UsersModel->getAllowedAreas($sess['username']);
            //$area_id = $data['ASE_Area']->area_id;
            //$data['ASE_Territory'] = $this->MasterModule->getAreaTerritory(null, '001', $data['ASE_Area']->area_id);
        }
        if (!empty($_POST['DateRange']) && isset($_POST['DateRange'])) {
            //print_r($_POST);
            if (!empty($_POST['channel']) && isset($_POST['channel'])) {
                $channelList = $_POST['channel'];
            }

            $data['DateRange'] = $DateRange = $_POST['DateRange'];
            $RangeArr = explode('-', $DateRange);
            $FromDate = str_replace('/', '-', trim($RangeArr[0]));
            $ToDate = str_replace('/', '-', trim($RangeArr[1]));
            $salesRep = '';

            if (!empty($_POST['areaID']) && isset($_POST['areaID'])) {
                $data['AreaID']=$area_id = $_POST['areaID'];
            }

            if (!empty($_POST['territoryID']) && isset($_POST['territoryID'])) {
                $data['TerritoryID']=$territoryID = $_POST['territoryID'];                
                $data['territory']=$this->MasterModule->getAreaTerritory(null,001,$area_id);
            }

            if (!empty($_POST['rangeID']) && isset($_POST['rangeID'])) {
                $data['RangeID'] = $_POST['rangeID'];
            }
            //OTHER FILTERS FOR USERS EXCEPT SALES REP
            $data['ChannelDataSet'] = $this->MasterModule->getChannel();
            $data['ordersH'] = $this->SalesoerderentryModule->getOrdersH($FromDate, $ToDate, '', $salesRep, $channelList, 'detail', $data['AreaID'], $data['TerritoryID'], $data['RangeID']);
            //$data['gps'] = $this->SalesoerderentryModule->getGps($FromDate, $ToDate, $sess['username']);
            //$data['shopgps'] = $this->SalesoerderentryModule->getShopGps();
            $data['ReportTitle']=$this->CommonModule->getTitle('Sales Details with Call Time',1,$area_id,$territoryID,'','Bookings',$FromDate, $ToDate);
        }
        $this->load->view('template/header', $data);
        $this->load->view('secondary/oe/report_oe_made_call');
        $this->load->view('template/footer');
    }

    function Orderentry($id = null, $msg = null) {
        $functionID = 46;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 13;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);
        //die();

        $data['sess'] = $sess = $this->session->userdata('User');
        $location_ID = $sess['location'];

        $data['title'] = 'Secondary Order Entry';
        $data['pagetitle'] = 'Secondary Order Entry';
        $data['msg'] = $msg;

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();

        $data['oplid'] = '';
        $data['sopaid'] = '';
        $data['territoryid'] = '';
        $data['routeid'] = '';

        //$data['OpData'] = $this->MasterModule->getOperations(null, $location_ID);

        if (!empty($_POST) && isset($_POST)) {
            $data['oplid'] = $opid = $_POST['sop']['sopid'];
            $data['sopaid'] = $areaid = $_POST['sop']['areaid'];
            $data['territoryid'] = $territoryid = $_POST['sop']['territoryid'];
            $data['routeid'] = $routeid = $_POST['sop']['routeid'];
            $data['OperationArea'] = $this->MasterModule->getOperationArea(null, $opid, $location_ID);
            $data['OpAreaTerritoryData'] = $this->MasterModule->getOperationAreaTerritory(null, $opid, $areaid, $location_ID);
            $data['OpAreaTerritoryRouteData'] = $this->MasterModule->getOperationAreaTerritorySalesRoute(null, $opid, $location_ID, $areaid, $territoryid);
            $data['Orders'] = $this->SalesoerderentryModule->getOrderData(null, $opid, $areaid, $territoryid, $routeid, null, $location_ID);
            $data['OperationAreaTerritoryCustomers'] = $this->SalesarcustomersModule->getSecondaryCustomers(null, $opid, $location_ID, $areaid, $territoryid, $routeid);
        } else {
            //$data['Orders'] = $this->SalesoerderentryModule->getOrderData(null, null, null, null, null, null, $location_ID);
        }

        $this->load->view('template/header', $data);
        $this->load->view('secondary/oe/orders');
        $this->load->view('template/footer');
    }
    
    function stockEntry($id = null, $msg = null) {
        $functionID = 46;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 13;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);
        //die();

        $data['sess'] = $sess = $this->session->userdata('User');
        $location_ID = $sess['location'];

        $data['title'] = 'Secondary Order Entry';
        $data['pagetitle'] = 'Secondary Order Entry';
        $data['msg'] = $msg;

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();

        $data['oplid'] = '';
        $data['sopaid'] = '';
        $data['territoryid'] = '';
        $data['routeid'] = '';

        $data['AreaList'] = $this->MasterModule->getArea(null, '001', 1);
        $data['RangeList'] = $this->MasterModule->getRange();
        if ($sess['grade_id'] == 4) {
            $data['ASE_Area'] = $this->UsersModel->getAllowedAreas($sess['username']);
            //$area_id = $data['ASE_Area']->area_id;
            //$data['ASE_Territory'] = $this->MasterModule->getAreaTerritory(null, '001', $data['ASE_Area']->area_id);
        }
        if(!empty($_POST['rangeID']) && isset($_POST['rangeID']) && !empty($_POST['areaID']) && isset($_POST['areaID']) && !empty($_POST['territoryID']) && isset($_POST['territoryID'])){

            $data['CategoryList'] = $this->SalesreportModule->getCategoryList(3);
            $data['itemPriceList'] = $this->ItemsModel->getMstItems('D');
    
        }

        

        // if (!empty($_POST) && isset($_POST)) {
        //     $data['oplid'] = $opid = $_POST['sop']['sopid'];
        //     $data['sopaid'] = $areaid = $_POST['sop']['areaid'];
        //     $data['territoryid'] = $territoryid = $_POST['sop']['territoryid'];
        //     $data['routeid'] = $routeid = $_POST['sop']['routeid'];
        //     $data['OperationArea'] = $this->MasterModule->getOperationArea(null, $opid, $location_ID);
        //     $data['OpAreaTerritoryData'] = $this->MasterModule->getOperationAreaTerritory(null, $opid, $areaid, $location_ID);
        //     $data['OpAreaTerritoryRouteData'] = $this->MasterModule->getOperationAreaTerritorySalesRoute(null, $opid, $location_ID, $areaid, $territoryid);
        //     $data['Orders'] = $this->SalesoerderentryModule->getOrderData(null, $opid, $areaid, $territoryid, $routeid, null, $location_ID);
        //     $data['OperationAreaTerritoryCustomers'] = $this->SalesarcustomersModule->getSecondaryCustomers(null, $opid, $location_ID, $areaid, $territoryid, $routeid);
        // } else {
        //     //$data['Orders'] = $this->SalesoerderentryModule->getOrderData(null, null, null, null, null, null, $location_ID);
        // }

        $this->load->view('template/header', $data);
        $this->load->view('secondary/oe/orders');
        $this->load->view('template/footer');
    }

    function InvoiceEntry($msg = null) {
        $functionID = 46;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 15;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);
        $data['sess'] = $sess = $this->session->userdata('User');
        //print_r($data['sess']);
        $data['title'] = 'Reports - O/E Transactions';
        $data['pagetitle'] = 'Reports - O/E Transactions';
        $data['msg'] = $msg;
        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);
        $FromDate = '';
        $ToDate = '';
        $data['DateRange'] = '';
        $data['ordersH'] = null;
        $channelList = null;
        if (!empty($_POST['DateRange']) && isset($_POST['DateRange'])) {
            /* print_r($_POST);
              if(!empty($_POST['channel']) && isset($_POST['channel'])){
              $channelList=$_POST['channel'];
              } */

            $data['DateRange'] = $DateRange = $_POST['DateRange'];
            $RangeArr = explode('-', $DateRange);
            $FromDate = str_replace('/', '', trim($RangeArr[0]));
            $ToDate = str_replace('/', '', trim($RangeArr[1]));
            $salesRep = '';

            //OTHER FILTERS FOR USERS EXCEPT SALES REP
            $data['ChannelDataSet'] = $this->MasterModule->getChannel();

            $data['ordersH'] = $this->SalesoerderentryModule->getOrdersH($FromDate, $ToDate, '', $salesRep, $channelList);
        }
        //$data['gps'] = $this->SalesoerderentryModule->getGps(); 

        $this->load->view('template/header', $data);
        $this->load->view('secondary/oe/oe_inv');
        $this->load->view('template/footer');
    }

    //LOAD BOOKING TO ACTUAL INVOICE FORM
    function bookingToActual($msg = null) {
        $functionID = 46;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 15;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);
        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'Reports - O/E Transactions';
        $data['pagetitle'] = 'Reports - O/E Transactions';
        $data['msg'] = $msg;
        $data['invData'] = null;
        if (!empty($_POST['idinvoice']) && isset($_POST['idinvoice'])) {
            $invNum = $_POST['idinvoice'];
            $FromDate = '';
            $ToDate = '';
            $data['invDataH'] = $this->SalesoerderentryModule->getOrdersH($FromDate, $ToDate, $invNum);
            $data['invDataD'] = $this->SalesoerderentryModule->getOrdersD($FromDate, $ToDate, $invNum);
            $data['itemList'] = $this->SalesoerderentryModule->getItemList($data['invDataH']->range_id); //item list=bill book
            $data['itemPriceList'] = $this->SalesoerderentryModule->getItemList($data['invDataH']->range_id); //item prices
        }
        $this->load->view('secondary/oe/create_invoice', $data);
    }

    //BAKERY CHANNEL
    //special discount report
    function discountReport($msg = null) {
        $functionID = 67;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 20;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);
        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'Reports - O/E Transactions';
        $data['pagetitle'] = 'Reports - O/E Transactions';
        $data['msg'] = $msg;
        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);
        $FromDate = '';
        $ToDate = '';
        $data['DateRange'] = '';
        $data['ordersHD'] = null;
        if (!empty($_POST['DateRange']) && isset($_POST['DateRange'])) {
            $data['DateRange'] = $DateRange = $_POST['DateRange'];
            $RangeArr = explode('-', $DateRange);
            $FromDate = str_replace('/', '', trim($RangeArr[0]));
            $ToDate = str_replace('/', '', trim($RangeArr[1]));
            $data['ordersHD'] = $this->SalesoerderentryModule->getOrdersD_DiscountDetails($FromDate, $ToDate, '', 'Yeast', 1);
        }
        $data['gps'] = $this->SalesoerderentryModule->getGps();
        $this->load->view('template/header', $data);
        $this->load->view('secondary/oe/report_oe_inv_special_discount');
        $this->load->view('template/footer');
    }

    //item wise sales
    function invoiceItem($msg = null) {
        $functionID = 67;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 21;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);
        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'Reports - O/E Transactions';
        $data['pagetitle'] = 'Reports - O/E Transactions';
        $data['msg'] = $msg;
        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);
        $FromDate = '';
        $ToDate = '';
        $data['DateRange'] = '';
        $data['report_type'] = '';
        $data['ordersD'] = null;

        $FromDate = '';
        $ToDate = '';
        $data['DateRange'] = '';
        $data['ordersH'] = null;
        $channelList = null;
        $data['gps'] = null;
        $data['AreaList'] = $this->MasterModule->getArea(null, '001', 1);
        $data['RangeList'] = $this->MasterModule->getRange();
        //check the login user is an ASE(GRADE ID = 4)
        $data['ASE_Territory'] = null;
        $data['ASE_Area'] = null;
        $data['TimeAttendance'] = null;
        $data['DateRange'] = null;
        $data['AreaID'] = null;
        $data['TerritoryID'] = null;
        $data['RangeID'] = null;
        $area_id = null;

        if ($sess['grade_id'] == 4) {
            $data['ASE_Area'] = $this->UsersModel->getAllowedAreas($sess['username']);
        }

        $data['AreaID'] = null;
        $data['TerritoryID'] = null;

        if (!empty($_POST['DateRange']) && isset($_POST['DateRange']) && !empty($_POST['report_type']) && isset($_POST['report_type'])) {
            $data['DateRange'] = $DateRange = $_POST['DateRange'];
            $RangeArr = explode('-', $DateRange);
            $FromDate = str_replace('/', '-', trim($RangeArr[0]));
            $ToDate = str_replace('/', '-', trim($RangeArr[1]));

            if (!empty($_POST['areaID']) && isset($_POST['areaID'])) {
                $data['AreaID']=$area_id = $_POST['areaID'];
            }

            if (!empty($_POST['territoryID']) && isset($_POST['territoryID'])) {
                $data['TerritoryID']=$territoryID = $_POST['territoryID'];
                
                $data['territory']=$this->MasterModule->getAreaTerritory(null,001,$area_id);
            }

            if (!empty($_POST['rangeID']) && isset($_POST['rangeID'])) {
                $data['RangeID'] = $_POST['rangeID'];
            }
            

            $data['report_type'] = $report_type = $_POST['report_type'];
            $data['ordersD'] = $this->SalesoerderentryModule->getOrdersD($FromDate, $ToDate, '', $report_type,'', $data['AreaID'], $data['TerritoryID'],$data['RangeID']);
            $data['ReportTitle']=$this->CommonModule->getTitle('App Invoice Items Summery',1,$area_id,$data['TerritoryID'],$data['RangeID'],'Bookings',$FromDate, $ToDate);
        }
        //$data['gps'] = $this->SalesoerderentryModule->getGps(); 

        $this->load->view('template/header', $data);
        $this->load->view('secondary/oe/report_oe_inv_item');
        $this->load->view('template/footer');
    }

    function areaSummary($msg = null) {
        $functionID = 69;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 1;
        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'Reports - O/E Transactions';
        $data['pagetitle'] = 'Reports - O/E Transactions';
        $data['msg'] = $msg;
        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);
        $this->load->view('template/header', $data);
        $this->load->view('secondary/oe/reportindex_area');
        $this->load->view('template/footer');
    }

    function AreaSummaryData($msg = null) {
        $functionID = 69;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 23;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);
        $data['sess'] = $sess = $this->session->userdata('User');
        //print_r($data['sess']);
        $data['title'] = 'Reports - O/E Transactions';
        $data['pagetitle'] = 'Reports - O/E Transactions';
        $data['msg'] = $msg;
        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);
        $FromDate = '';
        $ToDate = '';


        $data['AreaList'] = $this->MasterModule->getArea(null, '001', 1);
        $data['RangeList'] = $this->MasterModule->getRange();

        $data['DateRange'] = '';
        $data['ordersH'] = null;
        $channelList = null;
        $data['gps'] = null;
        $data['AreaID'] = null;
        $data['TerritoryID'] = null;
        $data['RangeID'] = null;
        if ($sess['grade_id'] == 4) {
            $data['ASE_Area'] = $this->UsersModel->getAllowedAreas($sess['username']);
            //$area_id = $data['ASE_Area']->area_id;
            //$data['ASE_Territory'] = $this->MasterModule->getAreaTerritory(null, '001', $data['ASE_Area']->area_id);
        }
        if (!empty($_POST['DateRange']) && isset($_POST['DateRange'])) {
            //print_r($_POST);
            $areaID = null;
            $territoryID = null;
            $rangeID = null;

            if (!empty($_POST['channel']) && isset($_POST['channel'])) {
                $channelList = $_POST['channel'];
            }
            if (!empty($_POST['areaID']) && isset($_POST['areaID'])) {
                $data['AreaID'] = $areaID = $_POST['areaID'];
            }
            if (!empty($_POST['territoryID']) && isset($_POST['territoryID'])) {
                $data['TerritoryID'] = $territoryID = $_POST['territoryID'];
            }
            if (!empty($_POST['rangeID']) && isset($_POST['rangeID'])) {
                $data['RangeID'] = $rangeID = $_POST['rangeID'];
            }

            $data['DateRange'] = $DateRange = $_POST['DateRange'];
            $RangeArr = explode('-', $DateRange);
            $FromDate = str_replace('/', '-', trim($RangeArr[0]));
            $ToDate = str_replace('/', '-', trim($RangeArr[1]));
            $salesRep = '';

            //OTHER FILTERS FOR USERS EXCEPT SALES REP
            $data['ChannelDataSet'] = $this->MasterModule->getChannel();
            $data['AreaTerritoryDataSet'] = $this->MasterModule->getAreaTerritory(null, $channelList, $areaID, $territoryID);
            $data['ordersH'] = $this->SalesoerderentryModule->getOrdersH($FromDate, $ToDate, '', $salesRep, $channelList, 'area_summery', $areaID, $territoryID, $rangeID);
            //$data['gps'] = $this->SalesoerderentryModule->getGps($FromDate, $ToDate, $sess['username']);
        }

        //die();
        $this->load->view('template/header', $data);
        $this->load->view('secondary/oe/report_oe_inv_area_sum');
        $this->load->view('template/footer');
    }

    //LOADING LIST
    function LoadingList($msg = null) {
        $functionID = 46;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 17;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);
        $data['sess'] = $sess = $this->session->userdata('User');
        //print_r($data['sess']);
        $data['title'] = 'Reports - O/E Transactions';
        $data['pagetitle'] = 'Reports - O/E Transactions';
        $data['msg'] = $msg;
        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);
        $FromDate = '';
        $ToDate = '';
        $data['DateRange'] = '';
        $data['ordersH'] = null;
        $channelList = null;
        $data['AreaList'] = $this->MasterModule->getArea(null, '001', 1);
        $data['RangeList'] = $this->MasterModule->getRange();
        if (!empty($_POST['DateRange']) && isset($_POST['DateRange'])) {
            /* print_r($_POST);
              if(!empty($_POST['channel']) && isset($_POST['channel'])){
              $channelList=$_POST['channel'];
              } */

            $data['DateRange'] = $DateRange = $_POST['DateRange'];
            $RangeArr = explode('-', $DateRange);
            $FromDate = str_replace('/', '', trim($RangeArr[0]));
            $ToDate = str_replace('/', '', trim($RangeArr[1]));
            $salesRep = '';

            //OTHER FILTERS FOR USERS EXCEPT SALES REP
            $data['ChannelDataSet'] = $this->MasterModule->getChannel();

            if (!empty($_POST['areaID']) && isset($_POST['areaID'])) {
                $data['AreaID'] = $areaID = $_POST['areaID'];
            }
            if (!empty($_POST['territoryID']) && isset($_POST['territoryID'])) {
                $data['TerritoryID'] = $territoryID = $_POST['territoryID'];
            }
            if (!empty($_POST['rangeID']) && isset($_POST['rangeID'])) {
                $data['RangeID'] = $rangeID = $_POST['rangeID'];
            }

            $data['ordersH'] = $this->SalesoerderentryModule->getOrdersH($FromDate, $ToDate, '', $salesRep, $channelList, 'detail', $areaID, $territoryID, $rangeID);
        }
        //$data['gps'] = $this->SalesoerderentryModule->getGps(); 

        $this->load->view('template/header', $data);
        $this->load->view('secondary/oe/distributor_loading');
        $this->load->view('template/footer');
    }
     function addCollections($msg = null,$id = null) {
        $functionID = 46; //app_module_function table id
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 16; // app_module_function_sub table id
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);

        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'Cash Collection';
        $data['pagetitle'] = 'Cash Collection';
        $data['msg'] = $msg;

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['DateRange'] = '';
       
        $this->load->view('template/header', $data);
        $this->load->view('secondary/oe/CashCollection');
        $this->load->view('template/footer');
    }

}

?>