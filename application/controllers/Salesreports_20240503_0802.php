<?php

/*
 * This system Licenced to Raigam Marketing Services (Pvt) Ltd. 
 * Developed By: Lakshitha Pradeep Karunarathna  * 
 * Company: Serving Cloud INC in association with MyOffers.lk  * 
 * Date Started:  October 20, 2017  * 
 */

class Salesreports extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('UsersModel');
        $this->load->model('ItemsModel');
        $this->load->model('SurveyModel');
        $this->load->model('MasterModule');
        $this->load->model('HrModule');
        $this->load->model('SalesreportModule');
        $this->load->model('CommonModule');
    }

    //Load Icons
    function agencyData($msg = null) {
        $functionID = 72;
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
        $this->load->view('secondary/reports/agency/index');
        $this->load->view('template/footer');
    }

    /*
     * 
     * AGENCY REPORTS//////////////////////////////
     */

    function dailyAchievementSummery($msg = null) {
        $functionID = 72;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 27;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);

        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'Daily Sales Summery';
        $data['pagetitle'] = 'Daily Sales Summery';
        $data['msg'] = $msg;

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();

        //check the login user is an ASE(GRADE ID = 4)
        $data['ASE_Territory'] = null;
        $data['ASE_Area'] = null;
        $data['DateRange'] = null;
        $data['RangeID'] = null;
        $data['routeID'] = null;

        $data['AreaList'] = $this->MasterModule->getArea(null, '001', 1);
        if ($sess['grade_id'] == 4) {
            $data['ASE_Area'] = $this->UsersModel->getAllowedAreas($sess['username']);
            //$area_id = $data['ASE_Area']->area_id;
            //$data['ASE_Territory'] = $this->MasterModule->getAreaTerritory(null, '001', $data['ASE_Area']->area_id);
        }
        $data['RangeList'] = $this->MasterModule->getRange();

        $data['billMethod'] = null;
        if (!empty($_POST['areaID']) && isset($_POST['areaID'])) {
            $routeID = null;
            $billMethod = null;
            $area_id = $_POST['areaID'];
            if (!empty($_POST['territoryID']) && isset($_POST['territoryID'])) {
                $territoryID = $_POST['territoryID'];
            }
            if (!empty($_POST['routeID']) && isset($_POST['routeID'])) {
                $routeID = $_POST['routeID'];
            }

            if (!empty($_POST['rangeID']) && isset($_POST['rangeID'])) {
                $rangeID = $_POST['rangeID'];
            }

            if (!empty($_POST['billMethod']) && isset($_POST['billMethod'])) {
                $data['billMethod'] = $billMethod = $_POST['billMethod'];
            }
            $data['DateRange'] = $DateRange = $_POST['DateRange'];
            $RangeArr = explode('-', $DateRange);
            $FromDate = str_replace('/', '-', trim($RangeArr[0]));
            $ToDate = str_replace('/', '-', trim($RangeArr[1]));

            $data['SalesData'] = $this->SalesreportModule->getDailyPcTotals($area_id, $territoryID, $routeID, $rangeID, $billMethod, $FromDate, $ToDate, 'summery');
            $data['SalesDataDetails'] = $this->SalesreportModule->getDailyPcTotals($area_id, $territoryID, $routeID, $rangeID, $billMethod, $FromDate, $ToDate, 'details');
        }

        $this->load->view('template/header', $data);
        $this->load->view('secondary/reports/agency/daily_achievment_summery');
        $this->load->view('template/footer');
    }

    function dailyAchievementSummeryItem($msg = null) {
        $functionID = 72;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 27;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);

        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'Daily Sales Summery';
        $data['pagetitle'] = 'Daily Sales Summery';
        $data['msg'] = $msg;

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();

        //check the login user is an ASE(GRADE ID = 4)
        $data['ASE_Territory'] = null;
        $data['ASE_Area'] = null;
        $data['DateRange'] = null;
        $data['RangeID'] = null;
        $data['routeID'] = null;
        $data['CategoryList'] = $this->SalesreportModule->getCategoryList(3);
        $data['AreaList'] = $this->MasterModule->getArea(null, '001', 1);
        if ($sess['grade_id'] == 4) {
            $data['ASE_Area'] = $this->UsersModel->getAllowedAreas($sess['username']);
            //$area_id = $data['ASE_Area']->area_id;
            //$data['ASE_Territory'] = $this->MasterModule->getAreaTerritory(null, '001', $data['ASE_Area']->area_id);
        }
        $data['RangeList'] = $this->MasterModule->getRange();

        $data['billMethod'] = null;
        if (!empty($_POST['areaID']) && isset($_POST['areaID'])) {
            $routeID = null;
            $billMethod = null;
            $area_id = $_POST['areaID'];
            if (!empty($_POST['territoryID']) && isset($_POST['territoryID'])) {
                $territoryID = $_POST['territoryID'];
            }
            if (!empty($_POST['routeID']) && isset($_POST['routeID'])) {
                $routeID = $_POST['routeID'];
            }

            if (!empty($_POST['rangeID']) && isset($_POST['rangeID'])) {
                $newRange = explode("~", $_POST['rangeID']);
                $rangeID = $newRange[0];
            }

            if (!empty($_POST['billMethod']) && isset($_POST['billMethod'])) {
                $data['billMethod'] = $billMethod = $_POST['billMethod'];
            }
            if (!empty($_POST['reportType']) && isset($_POST['reportType'])) {
                $data['reportType'] = $reportType = $_POST['reportType'];
            }
            $data['DateRange'] = $DateRange = $_POST['DateRange'];
            $RangeArr = explode('-', $DateRange);
            $FromDate = str_replace('/', '-', trim($RangeArr[0]));
            $ToDate = str_replace('/', '-', trim($RangeArr[1]));

//            $data['SalesData'] = $this->SalesreportModule->getDailyPcTotals($area_id, $territoryID, $routeID, $rangeID, $billMethod, $FromDate, $ToDate, 'summery');
            $data['getAllData'] = $this->SalesreportModule->getItemSalesDetails($area_id, $territoryID, $routeID, $rangeID, $billMethod, $FromDate, $ToDate, 'summery',1,$reportType);
//            $data['SalesDataDetails'] = $this->SalesreportModule->getDailyPcTotals($area_id, $territoryID, $routeID, $rangeID, $billMethod, $FromDate, $ToDate, 'details');
//            $data['SalesDataDetails'] = $this->SalesreportModule->getItemSalesDetails($area_id, $territoryID, $routeID, $rangeID, $billMethod, $FromDate, $ToDate, 'details');
        }

        $this->load->view('template/header', $data);
        $this->load->view('secondary/reports/agency/daily_achievment_summeryItem');
        $this->load->view('template/footer');
    }

    function invoiceViewOldSys($msg = null) {
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
            $data['invDataH'] = $this->SalesreportModule->getOrdersHOld($invNum);
            $data['invDataD'] = $this->SalesreportModule->getOrdersDOld($invNum);
        }
        print_r($data['invDataH']);
        $this->load->view('secondary/reports/inv_preview', $data);
    }

    /*
     * 
     * FREE ISSUE RECONSILE
     */

    function getFreeIssueRecon($msg = null) {
        $functionID = 72;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 29;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);

        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'Free Issue Reconsiliation Summery';
        $data['pagetitle'] = 'Free Issue Reconsiliation Summery';
        $data['msg'] = $msg;

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();

        //check the login user is an ASE(GRADE ID = 4)
        $data['ASE_Territory'] = null;
        $data['ASE_Area'] = null;
        $data['DateRange'] = null;
        $data['RangeID'] = null;
        $data['routeID'] = null;
        $data['rptMethod'] = null;

        $data['AreaList'] = $this->MasterModule->getArea(null, '001', 1);
        if ($sess['grade_id'] == 4) {
            $data['ASE_Area'] = $this->UsersModel->getAllowedAreas($sess['username']);
            //$area_id = $data['ASE_Area']->area_id;
            //$data['ASE_Territory'] = $this->MasterModule->getAreaTerritory(null, '001', $data['ASE_Area']->area_id);
        }
        $territoryID = null;
        if (!empty($_POST['areaID']) && isset($_POST['areaID'])) {
            $area_id = $_POST['areaID'];
            if (!empty($_POST['territoryID']) && isset($_POST['territoryID'])) {
                $territoryID = $_POST['territoryID'];
            }
            if (!empty($_POST['rptMethod']) && isset($_POST['rptMethod'])) {
                $rptMethod = $_POST['rptMethod'];
            }
            $data['rptMethod'] = $rptMethod;
            $data['DateRange'] = $DateRange = $_POST['DateRange'];
            $RangeArr = explode('-', $DateRange);
            $FromDate = str_replace('/', '-', trim($RangeArr[0]));
            $ToDate = str_replace('/', '-', trim($RangeArr[1]));
            $year = date('Y', strtotime($FromDate));
            $month = date('m', strtotime($FromDate));

            $data['FreeRange'] = $this->SalesreportModule->getFreeIssueData($year, $month, $FromDate, $ToDate, $rptMethod);
            //die();    
//print_r($data['FreeRange']);

            if ($rptMethod == 'I') {
                $data['SalesData'] = $this->SalesreportModule->getOrdersDOld(NULL, null, null, 'details_line_free', $territoryID, $FromDate, $ToDate);
                $data['ItemData'] = $this->SalesreportModule->getOrdersDOld(NULL, null, null, 'details_line_free_items', $territoryID, $FromDate, $ToDate);
            } elseif ($rptMethod == 'C') {//category wise data                
                $data['SalesData'] = $this->SalesreportModule->getOrdersDOld(NULL, null, null, 'details_line_free_category', $territoryID, $FromDate, $ToDate);
                ///echo 'a';die();
                $data['FreeCategoryData'] = $this->SalesreportModule->getOrdersDOld(NULL, null, null, 'details_line_free_category_list', $territoryID, $FromDate, $ToDate);
                //print_r($data['FreeCategoryData']);
            }
        }

        $this->load->view('template/header', $data);
        $this->load->view('secondary/reports/agency/free_issue_reconsiliation');
        $this->load->view('template/footer');
    }

    //AGENCY LEVEL STOCK WITOUT CONSIDERING COMMONLY HANDDLE WHEREHOUSE
    function currentStock($msg = null) {
        $functionID = 72;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 40;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);

        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'Daily Sales Summery';
        $data['pagetitle'] = 'Daily Sales Summery';
        $data['msg'] = $msg;

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();

        //check the login user is an ASE(GRADE ID = 4)
        $data['ASE_Territory'] = null;
        $data['ASE_Area'] = null;
        $data['DateRange'] = null;
        $data['RangeID'] = null;
        $data['routeID'] = null;
        $data['territoryID'] = $territoryID = null;
        $data['AreaList'] = $this->MasterModule->getArea(null, '001', 1);
        if ($sess['grade_id'] == 4) {
            $data['ASE_Area'] = $this->UsersModel->getAllowedAreas($sess['username']);
        }
        $data['RangeList'] = $this->MasterModule->getRange();

        if (!empty($_POST['areaID']) && isset($_POST['areaID'])) {
            $routeID = null;
            $billMethod = null;
            $data['AreaID'] = $area_id = $_POST['areaID'];
            if (!empty($_POST['territoryID']) && isset($_POST['territoryID'])) {
                $data['territoryID'] = $territoryID = $_POST['territoryID'];
            }
            if (!empty($_POST['routeID']) && isset($_POST['routeID'])) {
                $data['routeID'] = $routeID = $_POST['routeID'];
            }

            if (!empty($_POST['rangeID']) && isset($_POST['rangeID'])) {
                $data['RangeID'] = $rangeID = $_POST['rangeID'];
            }
            $FromDate = null;
            $ToDate = null;
            //$data['DateRange'] = $DateRange = $_POST['DateRange'];
            //$RangeArr = explode('-', $DateRange);
            //$FromDate = str_replace('/', '-', trim($RangeArr[0]));
            //$ToDate = str_replace('/', '-', trim($RangeArr[1]));

            $data['StockData'] = $this->SalesreportModule->getStockData($area_id, $territoryID, $rangeID, $FromDate, $ToDate, 'summery');
        }

        $this->load->view('template/header', $data);
        $this->load->view('secondary/reports/agency/current_stock');
        $this->load->view('template/footer');
    }

    //AGENCY COMMON WHAREHOUSE CONSIDERED STOCK - ISLANDWIDE AND AREA WISE
    function currentStockAll($msg = null) {
        $functionID = 72;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 61;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);

        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'Daily Sales Summery';
        $data['pagetitle'] = 'Daily Sales Summery';
        $data['msg'] = $msg;

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();

        //check the login user is an ASE(GRADE ID = 4)
        $data['ASE_Territory'] = null;
        $data['ASE_Area'] = null;
        $data['DateRange'] = null;
        $data['RangeID'] = null;
        $data['routeID'] = null;
        $data['territoryID'] = $territoryID = null;
        $data['AreaList'] = $this->MasterModule->getArea(null, '001', 1);
        if ($sess['grade_id'] == 4) {
            $data['ASE_Area'] = $this->UsersModel->getAllowedAreas($sess['username']);
        }
        $data['RangeList'] = $this->MasterModule->getRange();

        $data['CategoryList'] = $this->SalesreportModule->getCategoryList(3);
        $category = 0;
        $data['categoryID'] = null;
        //print_r($_GET); 
        //print_r($_POST); //die();
        if (!empty($_POST['rangeID']) && isset($_POST['rangeID'])) {
            $routeID = null;
            $billMethod = null;
            $data['AreaID'] = $area_id = $_POST['areaID'];
            $data['distributors'] = $this->MasterModule->getAreaTerritoryCommon(null, '001', $area_id);
            if (!empty($_POST['territoryID']) && isset($_POST['territoryID'])) {
                $data['territoryID'] = $territoryID = $_POST['territoryID'];
            }
            if (!empty($_POST['routeID']) && isset($_POST['routeID'])) {
                $data['routeID'] = $routeID = $_POST['routeID'];
            }

            if (!empty($_POST['rangeID']) && isset($_POST['rangeID'])) {
                $data['RangeID'] = $rangeID = $_POST['rangeID'];
            }
            $FromDate = null;
            $ToDate = null;
            if (!empty($_POST['category']) && isset($_POST['category'])) {
                $data['categoryID'] = $category = $_POST['category'];
            }
            if ($category > 0) {
                $data['StockData'] = $this->SalesreportModule->getStockDataCommonCategory($area_id, $territoryID, $rangeID, $FromDate, $ToDate, 'detail', $category);
                $data['StockDataSum'] = $this->SalesreportModule->getStockDataCommonCategory($area_id, $territoryID, $rangeID, $FromDate, $ToDate, 'summery', $category);
            } else {
                $data['StockData'] = $this->SalesreportModule->getStockDataCommon($area_id, $territoryID, $rangeID, $FromDate, $ToDate, 'summery');
            }
        }

        $this->load->view('template/header', $data);
        $this->load->view('secondary/reports/agency/current_stock_all');
        $this->load->view('template/footer');
    }

    function stockLog($ag_cd, $rangeID, $item, $msg = null) {
        $functionID = 72;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 61;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);

        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'Daily Sales Summery';
        $data['pagetitle'] = 'Daily Sales Summery';
        $data['msg'] = $msg;

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();

        $data['item'] = $item;
        $data['stock_data'] = $this->SalesreportModule->getCommonlocationStock($ag_cd, $rangeID);
        $data['invoice_data'] = $this->SalesreportModule->invoiceTransactionLog($ag_cd, $item, $rangeID);

        $this->load->view('template/header', $data);
        $this->load->view('secondary/reports/agency/current_stock_all_log');
        $this->load->view('template/footer');
    }

    /*
     * 
     * AGENCY REPORTS END//////////////////////////////
     */

    /*
     * 
     * 
     * AREA INFO
     * 
     * 
     * 
     */

    function areaIndex($msg = null) {
        $functionID = 73;
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
        $this->load->view('secondary/reports/agency/index');
        $this->load->view('template/footer');
    }

    /*
      function areaSummery($msg = null, $areaIDPassed = null, $rangeIDPassed = null, $territoryIDPassed = null, $dateRangePassed = null, $billingMethodPass = null, $dateBilled = null, $channelID = 1) {
      $functionID = 73;
      $this->UsersModel->authenticateMe($functionID);
      $functionSubID = 28;
      $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);

      $data['sess'] = $sess = $this->session->userdata('User');
      $data['title'] = 'Daily Sales Summery';
      $data['pagetitle'] = 'Daily Sales Summery';
      $data['msg'] = $msg;

      $data['modules'] = $this->UsersModel->getMainModule();
      $data['menu'] = $this->UsersModel->getMenuList();

      //check the login user is an ASE(GRADE ID = 4)
      $data['ASE_Territory'] = null;
      $data['ASE_Area'] = null;
      $data['DateRange'] = null;
      $data['RangeID'] = null;
      $data['routeID'] = null;
      $data['channelID'] = $channelID;
      $data['AreaList'] = $this->MasterModule->getArea(null, $channelID, 1);

      if ($sess['grade_id'] == 4) {//ASE
      $data['ASE_Area'] = $this->UsersModel->getAllowedAreas($sess['username']);
      //$area_id = $data['ASE_Area']->area_id;
      //$data['ASE_Territory'] = $this->MasterModule->getAreaTerritory(null, '001', $data['ASE_Area']->area_id);
      }
      $data['RangeList'] = $this->MasterModule->getRange();

      $data['billMethod'] = null;
      if (!empty($areaIDPassed) && isset($areaIDPassed)) {
      $_POST['areaID'] = $areaIDPassed;
      }
      if (!empty($rangeIDPassed) && isset($rangeIDPassed)) {
      $_POST['rangeID'] = $rangeIDPassed;
      }
      if (!empty($territoryIDPassed) && isset($territoryIDPassed) && $territoryIDPassed != null) {
      $_POST['territoryID'] = $territoryIDPassed;
      }
      if (!empty($billingMethodPass) && isset($billingMethodPass)) {
      $_POST['billMethod'] = $billingMethodPass;
      }
      if (!empty($dateRangePassed) && isset($dateRangePassed)) {
      $dateRangePassed = str_replace('~', ' - ', str_replace('-', '/', trim($dateRangePassed)));
      $_POST['DateRange'] = $dateRangePassed;
      }
      if (!empty($_POST['areaID']) && isset($_POST['areaID'])) {
      $routeID = null;
      $billMethod = null;
      $territoryID = null;
      $data['AreaID'] = $area_id = $_POST['areaID'];
      $data['AreaDetails'] = $this->MasterModule->getArea($area_id);

      if (!empty($_POST['rangeID']) && isset($_POST['rangeID'])) {
      $data['RangeID'] = $rangeID = $_POST['rangeID'];
      $data['RangeName'] = $this->MasterModule->getRange($rangeID);
      }
      if (!empty($_POST['billMethod']) && isset($_POST['billMethod'])) {
      $data['billMethod'] = $billMethod = $_POST['billMethod'];
      }
      $data['DateRange'] = $DateRange = $_POST['DateRange'];
      $RangeArr = explode('-', $DateRange);
      $FromDate = str_replace('/', '-', trim($RangeArr[0]));
      $ToDate = str_replace('/', '-', trim($RangeArr[1]));
      if (!empty($territoryIDPassed) && isset($territoryIDPassed)) {
      $data['territoryID'] = $territoryID = $territoryIDPassed;
      }

      $data['FromDate'] = $FromDate;
      $data['targetData'] = $this->SalesreportModule->getTarget(date('Y', strtotime($FromDate)), date('m', strtotime($FromDate)), $area_id);

      $data['WorkingDates'] = $this->SalesreportModule->getCompanyWorkingDays($FromDate, $ToDate);

      $data['ActualWorkingDates'] = $this->HrModule->getRepActualDayCount($FromDate, $ToDate);
      //print_r($data['targetData']);

      if ($channelID == 1) {
      $data['SalesData'] = $this->SalesreportModule->getDailyPcTotals($area_id, $territoryID, $routeID, $rangeID, $billMethod, $FromDate, $ToDate, 'summery');
      $data['SalesDataTerritory'] = $this->SalesreportModule->getDailyPcTotals($area_id, $territoryID, $routeID, $rangeID, $billMethod, $FromDate, $ToDate, 'summery_territory');
      } else {
      $data['SalesData'] = $this->SalesreportModule->getDailyPcTotalsNew($area_id, $territoryID, $routeID, $rangeID, $billMethod, $FromDate, $ToDate, 'summery', $channelID);
      //print_r($data['SalesData']);
      //die();
      $data['SalesDataTerritory'] = $this->SalesreportModule->getDailyPcTotalsNew($area_id, $territoryID, $routeID, $rangeID, $billMethod, $FromDate, $ToDate, 'summery_territory', $channelID);
      }
      if (!empty($territoryIDPassed) && isset($territoryIDPassed)) {
      //$territoryID=$territoryIDPassed;
      if (!empty($dateBilled) && isset($dateBilled)) {
      $FromDate = $dateBilled;
      $ToDate = $dateBilled;
      if ($channelID == 1) {
      $data['SalesDataDetails'] = $this->SalesreportModule->getDailyPcTotals($area_id, $territoryID, $routeID, $rangeID, $billMethod, $FromDate, $ToDate, 'details');
      } else {
      $data['SalesDataDetails'] = $this->SalesreportModule->getDailyPcTotalsNew($area_id, $territoryID, $routeID, $rangeID, $billMethod, $FromDate, $ToDate, 'details', $channelID);
      //print_r( $data['SalesDataDetails']);
      }
      }
      }
      $data['ReportTitle'] = $this->CommonModule->getTitle('Area Sales Summery', 1, $area_id, $territoryID, $rangeID, 'Actual', $FromDate, $ToDate);
      }
      //die();
      $this->load->view('template/header', $data);
      $this->load->view('secondary/reports/area/area_achievment_summery');
      $this->load->view('template/footer');
      }
     */

    //NEW DEMARCATION UPDATE 2023 11 06
    function areaSummery($msg = null, $areaIDPassed = null, $rangeIDPassed = null, $territoryIDPassed = null, $dateRangePassed = null, $billingMethodPass = null, $dateBilled = null, $channelID = 1) {
        $functionID = 73;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 28;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);

        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'Daily Sales Summery';
        $data['pagetitle'] = 'Daily Sales Summery';
        $data['msg'] = $msg;

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();

        //check the login user is an ASE(GRADE ID = 4)
        $data['ASE_Territory'] = null;
        $data['ASE_Area'] = null;
        $data['DateRange'] = null;
        $data['RangeID'] = null;
        $data['routeID'] = null;
        $data['channelID'] = $channelID;
        $data['AreaList'] = $this->MasterModule->getArea(null, $channelID, 1);

        if ($sess['grade_id'] == 4) {//ASE
            $data['ASE_Area'] = $this->UsersModel->getAllowedAreas($sess['username']);
            //$area_id = $data['ASE_Area']->area_id;
            //$data['ASE_Territory'] = $this->MasterModule->getAreaTerritory(null, '001', $data['ASE_Area']->area_id);
        }
        $data['RangeList'] = $this->MasterModule->getRange();

        $data['billMethod'] = null;
        $data['RangeName'] = '';
        if (!empty($areaIDPassed) && isset($areaIDPassed)) {
            $_POST['areaID'] = $areaIDPassed;
        }
        if (!empty($rangeIDPassed) && isset($rangeIDPassed)) {
            $_POST['rangeID'] = $rangeIDPassed;
            $data['RangeName'] = $this->MasterModule->getRange($rangeIDPassed)->range_name;
        }
        if (!empty($territoryIDPassed) && isset($territoryIDPassed) && $territoryIDPassed != null) {
            $_POST['territoryID'] = $territoryIDPassed;
        }
        if (!empty($billingMethodPass) && isset($billingMethodPass)) {
            $_POST['billMethod'] = $billingMethodPass;
        }
        if (!empty($dateRangePassed) && isset($dateRangePassed)) {
            $dateRangePassed = str_replace('~', ' - ', str_replace('-', '/', trim($dateRangePassed)));
            $_POST['DateRange'] = $dateRangePassed;
        }

        if (!empty($_POST['areaID']) && isset($_POST['areaID'])) {
            $routeID = null;
            $billMethod = null;
            $territoryID = null;
            $data['AreaID'] = $area_id = $_POST['areaID'];
            $data['AreaDetails'] = $this->MasterModule->getArea($area_id);

            if (!empty($_POST['rangeID']) && isset($_POST['rangeID'])) {
                $data['RangeID'] = $rangeID = $_POST['rangeID'];
                $data['RangeName'] = $this->MasterModule->getRange($rangeID)->range_name;
            }
            if (!empty($_POST['billMethod']) && isset($_POST['billMethod'])) {
                $data['billMethod'] = $billMethod = $_POST['billMethod'];
            }
            $data['DateRange'] = $DateRange = $_POST['DateRange'];
            $RangeArr = explode('-', $DateRange);
            $FromDate = str_replace('/', '-', trim($RangeArr[0]));
            $ToDate = str_replace('/', '-', trim($RangeArr[1]));
            if (!empty($territoryIDPassed) && isset($territoryIDPassed)) {
                $data['territoryID'] = $territoryID = $territoryIDPassed;
            }

            $data['FromDate'] = $FromDate;
            $data['targetData'] = $this->SalesreportModule->getTargetNewDemarcation(date('Y', strtotime($FromDate)), date('m', strtotime($FromDate)), $area_id);

            $data['WorkingDates'] = $this->SalesreportModule->getCompanyWorkingDays($FromDate, $ToDate);

            $data['ActualWorkingDates'] = $this->HrModule->getRepActualDayCount($FromDate, $ToDate);
            //print_r($data['targetData']);

            if ($channelID == 1) {
                $data['SalesData'] = $this->SalesreportModule->getDailyPcTotalsNewDemarcation($area_id, $territoryID, $routeID, $rangeID, $billMethod, $FromDate, $ToDate, 'summery');
                $data['SalesDataTerritory'] = $this->SalesreportModule->getDailyPcTotalsNewDemarcation($area_id, $territoryID, $routeID, $rangeID, $billMethod, $FromDate, $ToDate, 'summery_territory');
            } else {
                $data['SalesData'] = $this->SalesreportModule->getDailyPcTotalsNewNewDemarcation($area_id, $territoryID, $routeID, $rangeID, $billMethod, $FromDate, $ToDate, 'summery', $channelID);
                //print_r($data['SalesData']);
                //die();
                $data['SalesDataTerritory'] = $this->SalesreportModule->getDailyPcTotalsNewNewDemarcation($area_id, $territoryID, $routeID, $rangeID, $billMethod, $FromDate, $ToDate, 'summery_territory', $channelID);
            }
            if (!empty($territoryIDPassed) && isset($territoryIDPassed)) {
                //$territoryID=$territoryIDPassed;
                if (!empty($dateBilled) && isset($dateBilled)) {
                    $FromDate = $dateBilled;
                    $ToDate = $dateBilled;
                    if ($channelID == 1) {
                        $data['SalesDataDetails'] = $this->SalesreportModule->getDailyPcTotalsNewDemarcation($area_id, $territoryID, $routeID, $rangeID, $billMethod, $FromDate, $ToDate, 'details');
                    } else {
                        $data['SalesDataDetails'] = $this->SalesreportModule->getDailyPcTotalsNewNewDemarcation($area_id, $territoryID, $routeID, $rangeID, $billMethod, $FromDate, $ToDate, 'details', $channelID);
                        //print_r( $data['SalesDataDetails']);
                    }
                }
            }
            $data['ReportTitle'] = $this->CommonModule->getTitle('Area Sales Summery', 1, $area_id, $territoryID, $rangeID, 'Actual', $FromDate, $ToDate);
        }
        //die();
        $this->load->view('template/header', $data);
        $this->load->view('secondary/reports/area/area_achievment_summery');
        $this->load->view('template/footer');
    }

    /* Reusable Item Retrun report from agency */

    function returnOther($msg = null) {
        $functionID = 73;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 33;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);

        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'Daily Sales Summery';
        $data['pagetitle'] = 'Daily Sales Summery';
        $data['msg'] = $msg;

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();

        //check the login user is an ASE(GRADE ID = 4)
        $data['ASE_Territory'] = null;
        $data['ASE_Area'] = null;
        $data['DateRange'] = null;
        $data['RangeID'] = null;
        $data['routeID'] = null;

        $data['AreaList'] = $this->MasterModule->getArea(null, '001', 1);
        if ($sess['grade_id'] == 4) {//ASE
            $data['ASE_Area'] = $this->UsersModel->getAllowedAreas($sess['username']);
            //$area_id = $data['ASE_Area']->area_id;
            //$data['ASE_Territory'] = $this->MasterModule->getAreaTerritory(null, '001', $data['ASE_Area']->area_id);
        }
        $data['RangeList'] = $this->MasterModule->getRange();

        if (!empty($_POST['DateRange']) && isset($_POST['DateRange'])) {
            $data['DateRange'] = $DateRange = $_POST['DateRange'];
            $RangeArr = explode('-', $DateRange);
            $FromDate = str_replace('/', '-', trim($RangeArr[0]));
            $ToDate = str_replace('/', '-', trim($RangeArr[1]));
            $data['OtherReturn'] = $this->SalesreportModule->getReturnOther(null, $FromDate, $ToDate);
        }

        $this->load->view('template/header', $data);
        $this->load->view('secondary/reports/area/area_return_other');
        $this->load->view('template/footer');
    }

    /* -----------------------------------------------------Sandun----------------------------------------------------- */
    /* --------------------------------------Area Summery Item Wise-------------------------------------- */

    function areaSummeryItem($msg = null, $areaIDPassed = null, $cat = null, $territoryIDPassed = null, $dateRangePassed = null, $billingMethodPass = null, $dateBilled = null) {
        $functionID = 73;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 30;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);

        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'Daily Sales Summery';
        $data['pagetitle'] = 'Daily Sales Summery';
        $data['msg'] = $msg;

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();

        //check the login user is an ASE(GRADE ID = 4)
        $data['ASE_Territory'] = null;
        $data['ASE_Area'] = null;
        $data['DateRange'] = null;
        $data['cat'] = null;
        //$data['categoryID'] = null;
        $data['routeID'] = null;

        $data['AreaList'] = $this->MasterModule->getArea(null, '001', 1);
        if ($sess['grade_id'] == 4) {//ASE
            $data['ASE_Area'] = $this->UsersModel->getAllowedAreas($sess['username']);
            //$area_id = $data['ASE_Area']->area_id;
            //$data['ASE_Territory'] = $this->MasterModule->getAreaTerritory(null, '001', $data['ASE_Area']->area_id);
        }
        $data['cat'] = $this->MasterModule->getCategoryList();

        $data['billMethod'] = null;
        if (!empty($areaIDPassed) && isset($areaIDPassed)) {
            $_POST['areaID'] = $areaIDPassed;
        }
        if (!empty($cat) && isset($cat)) {
            $_POST['cat'] = $cat;
        }
        if (!empty($territoryIDPassed) && isset($territoryIDPassed)) {
            $_POST['territoryID'] = $territoryIDPassed;
        }
        if (!empty($billingMethodPass) && isset($billingMethodPass)) {
            $_POST['billMethod'] = $billingMethodPass;
        }
        if (!empty($dateRangePassed) && isset($dateRangePassed)) {
            $dateRangePassed = str_replace('~', ' - ', str_replace('-', '/', trim($dateRangePassed)));
            $_POST['DateRange'] = $dateRangePassed;
        }
        if (!empty($_POST['areaID']) && isset($_POST['areaID'])) {
            $routeID = null;
            $billMethod = null;
            $territoryID = null;
            $cat = null;
            $data['AreaID'] = $area_id = $_POST['areaID'];
            $data['AreaDetails'] = $this->MasterModule->getArea($area_id);
            /* if (!empty($_POST['cat']) && isset($_POST['cat'])) {
              $data['cat']=$cat = $_POST['cat'];
              $data['cat'] = $this->MasterModule->getCategoryList($cat);
              } */
            if (!empty($_POST['cat']) && isset($_POST['cat'])) {
                $data['cat_id'] = $cat = $_POST['cat'];
                $data['cat_name'] = $this->MasterModule->getCategoryList($cat);
            }
            if (!empty($_POST['billMethod']) && isset($_POST['billMethod'])) {
                $data['billMethod'] = $billMethod = $_POST['billMethod'];
            }
            $data['DateRange'] = $DateRange = $_POST['DateRange'];
            $RangeArr = explode('-', $DateRange);
            $FromDate = str_replace('/', '-', trim($RangeArr[0]));
            $ToDate = str_replace('/', '-', trim($RangeArr[1]));
            if (!empty($territoryIDPassed) && isset($territoryIDPassed)) {
                $data['territoryID'] = $territoryID = $territoryIDPassed;
            }
            $data['SalesData'] = $this->SalesreportModule->getItemsPcTotals($area_id, $territoryID, $routeID, $cat, $billMethod, $FromDate, $ToDate, 'pcsummery');
            $data['SalesDataTerritory'] = $this->SalesreportModule->getItemsPcTotals($area_id, $territoryID, $routeID, $cat, $billMethod, $FromDate, $ToDate, 'pcsummery_territory');
            if (!empty($data['SalesData']) && isset($data['SalesData'])) {
                //$data['SalesDataTerritoryPivot'] = $this->SalesreportModule->getItemsPcTotals($area_id, $territoryID, $routeID, $cat, $billMethod, $FromDate, $ToDate, 'pivot');
            }
            if (!empty($territoryIDPassed) && isset($territoryIDPassed)) {
                //$territoryID=$territoryIDPassed;
                if (!empty($dateBilled) && isset($dateBilled)) {
                    $FromDate = $dateBilled;
                    $ToDate = $dateBilled;
                    //$data['SalesDataDetails'] = $this->SalesreportModule->getItemsPcTotals($area_id, $territoryID, $routeID, $cat, $billMethod, $FromDate, $ToDate, 'details');
                }
            }
            $data['ReportTitle'] = $this->CommonModule->getTitle('Area Sales Summery Item-wise', 1, $area_id, $territoryID, '', 'Actual', $FromDate, $ToDate);
        }
        $this->load->view('template/header', $data);
        $this->load->view('secondary/reports/area/area_achi_sum_item');
        $this->load->view('template/footer');
    }

    /* --------------------------------------Area Summery Item Wise-------------------------------------- */

    /* non moving */

    function nonMovingReport($msg = null, $locationIDPassed = null) {
        $functionID = 72;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 35;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);

        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'Daily Sales Summery';
        $data['pagetitle'] = 'Daily Sales Summery';
        $data['msg'] = $msg;

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();

        $data['LocationList'] = $this->MasterModule->getLocationList();

        $data['DateRange'] = null;
        $data['locationID'] = null;

        if (!empty($locationIDPassed) && isset($locationIDPassed)) {
            $_POST['locationID'] = $locationIDPassed;
        }

        if (!empty($_POST['DateRange']) && isset($_POST['DateRange'])) {

            $locationID = null;
            /* print_r($_POST);
              die; */

            if (!empty($_POST['locationID']) && isset($_POST['locationID'])) {
                $data['locationID'] = $locationID = $_POST['locationID'];
            }

            $data['DateRange'] = $DateRange = $_POST['DateRange'];
            $RangeArr = explode('-', $DateRange);
            $FromDate = str_replace('/', '', trim($RangeArr[0]));
            $ToDate = str_replace('/', '', trim($RangeArr[1]));

            $data['NonMovingItems'] = $this->SalesreportModule->getNonMovings($locationID, $FromDate, $ToDate);
        }
        $this->load->view('template/header', $data);
        $this->load->view('secondary/reports/raigam/non_moving_report');
        $this->load->view('template/footer');
    }

    function distDirect($msg = null, $directIDPassed = null) {
        $functionID = 73;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 31;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);

        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'Daily Sales Summery';
        $data['pagetitle'] = 'Daily Sales Summery';
        $data['msg'] = $msg;

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();

        $data['AreaList'] = $this->MasterModule->getArea(null, '001', 1);
        $data['RangeList'] = $this->MasterModule->rangeDropDown();
        $data['DirectList'] = $this->MasterModule->directDropDown();

        $data['DateRange'] = null;
        $data['AreaID'] = null;
        $data['directID'] = null;
        $data['RangeID'] = null;
        $area_id = null;
        if ($sess['grade_id'] == 4) {
            $data['ASE_Area'] = $this->UsersModel->getAllowedAreas($sess['username']);
            //$area_id = $data['ASE_Area']->area_id;
            //$data['ASE_Territory'] = $this->MasterModule->getAreaTerritory(null, '001', $data['ASE_Area']->area_id);
        }
        if (!empty($directIDPassed) && isset($directIDPassed)) {
            $_POST['directID'] = $directIDPassed;
        }
        if (!empty($dateRangePassed) && isset($dateRangePassed)) {
            $dateRangePassed = str_replace('~', ' - ', str_replace('-', '/', trim($dateRangePassed)));
            $_POST['DateRange'] = $dateRangePassed;
        }
        if (!empty($_POST['DateRange']) && isset($_POST['DateRange'])) {

            $directID = null;

            if (!empty($_POST['areaID']) && isset($_POST['areaID'])) {
                if ($_POST['areaID'] == '-1') {
                    $_POST['areaID'] = null;
                }
                $data['AreaID'] = $areaID = $_POST['areaID'];
            }
            if (!empty($_POST['territoryID']) && isset($_POST['territoryID'])) {
                $data['TerritoryID'] = $territoryID = $_POST['territoryID'];
            }
            if (!empty($_POST['rangeID']) && isset($_POST['rangeID'])) {
                $data['RangeID'] = $rangeID = $_POST['rangeID'];
            }
            if (!empty($_POST['directID']) && isset($_POST['directID'])) {
                $data['directID'] = $directID = $_POST['directID'];
            }

            $data['DateRange'] = $DateRange = $_POST['DateRange'];
            $RangeArr = explode('-', $DateRange);
            $FromDate = str_replace('/', '', trim($RangeArr[0]));
            $ToDate = str_replace('/', '', trim($RangeArr[1]));
            $data['directbills'] = $this->SalesreportModule->getdirectbills($directID, $rangeID, $areaID, $FromDate, $ToDate);
        }
        $this->load->view('template/header', $data);
        $this->load->view('secondary/reports/area/direct_bills');
        $this->load->view('template/footer');
    }

    function pending($msg = null, $directIDPassed = null) {
        $functionID = 73;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 39;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);

        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'Daily Sales Summery';
        $data['pagetitle'] = 'Daily Sales Summery';
        $data['msg'] = $msg;

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();

        $data['AreaList'] = $this->MasterModule->areaDropDown(null, '001', 1);
        $data['RangeList'] = $this->MasterModule->rangeDropDown();
        $data['DirectList'] = $this->MasterModule->directDropDown();

        $data['DateRange'] = null;
        $data['AreaID'] = null;
        $data['directID'] = null;
        $data['RangeID'] = null;
        $area_id = null;
        if ($sess['grade_id'] == 4) {
            $data['ASE_Area'] = $this->UsersModel->getAllowedAreas($sess['username']);
            //$area_id = $data['ASE_Area']->area_id;
            //$data['ASE_Territory'] = $this->MasterModule->getAreaTerritory(null, '001', $data['ASE_Area']->area_id);
        }
        if (!empty($directIDPassed) && isset($directIDPassed)) {
            $_POST['directID'] = $directIDPassed;
        }
        if (!empty($dateRangePassed) && isset($dateRangePassed)) {
            $dateRangePassed = str_replace('~', ' - ', str_replace('-', '/', trim($dateRangePassed)));
            $_POST['DateRange'] = $dateRangePassed;
        }
        if (!empty($_POST['DateRange']) && isset($_POST['DateRange'])) {

            //$directID=null;

            if (!empty($_POST['areaID']) && isset($_POST['areaID'])) {
                if ($_POST['areaID'] == '-1') {
                    $_POST['areaID'] = null;
                }
                $data['AreaID'] = $areaID = $_POST['areaID'];
            }
            if (!empty($_POST['territoryID']) && isset($_POST['territoryID'])) {
                $data['TerritoryID'] = $territoryID = $_POST['territoryID'];
            }
            if (!empty($_POST['rangeID']) && isset($_POST['rangeID'])) {
                $data['RangeID'] = $rangeID = $_POST['rangeID'];
            }
            if (!empty($_POST['directID']) && isset($_POST['directID'])) {
                $data['directID'] = $directID = $_POST['directID'];
            }

            $data['DateRange'] = $DateRange = $_POST['DateRange'];
            $RangeArr = explode('-', $DateRange);
            $FromDate = str_replace('/', '', trim($RangeArr[0]));
            $ToDate = str_replace('/', '', trim($RangeArr[1]));
            $data['pending'] = $this->SalesreportModule->getPendingBills($areaID = null, $FromDate = null, $ToDate = null);
        }
        $this->load->view('template/header', $data);
        $this->load->view('secondary/reports/area/pending');
        $this->load->view('template/footer');
    }

    /* non moving */
    /* -----------------------------------------------------Sandun----------------------------------------------------- */

    /* ------------------------------------------------------Sandamal--------------------------------------------------- */

    /* invoice cancellation report */

    function cancellation($msg = null) {
        $functionID = 72; //app_module_function table id
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 43; // app_module_function_sub table id
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);

        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'Daily Sales Summery';
        $data['pagetitle'] = 'Daily Sales Summery';
        $data['msg'] = $msg;

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['DateRange'] = '';
        $data['AreaList'] = $this->MasterModule->getArea(null, '001', 1);
        $data['RangeList'] = $this->MasterModule->getRange();
        $data['ASE_Territory'] = null;
        $data['ASE_Area'] = null;

        if ($sess['grade_id'] == 4) {
            $data['ASE_Area'] = $this->UsersModel->getAllowedAreas($sess['username']);
            //$area_id = $data['ASE_Area']->area_id;
            //$data['ASE_Territory'] = $this->MasterModule->getAreaTerritory(null, '001', $data['ASE_Area']->area_id);
        }
        $data['sbTerritory'] = 'a';
        if (isset($_POST['DateRange']) && !empty($_POST['DateRange'])) {
            $data['DateRange'] = $_POST['DateRange'];

            if (isset($_POST['areaID']) && !empty($_POST['areaID'])) {
                $data['areaID'] = $_POST['areaID'];
            }

            if (isset($_POST['territoryID']) && !empty($_POST['territoryID'])) {
                $data['sbTerritory'] = $_POST['territoryID'];
            }

            if (isset($_POST['rangeID']) && !empty($_POST['rangeID'])) {
                $data['sbRange'] = $_POST['rangeID'];
            }

            $data['DateRange'] = $DateRange = $_POST['DateRange'];
            $RangeArr = explode('-', $DateRange);
            $FromDate = str_replace('/', '-', trim($RangeArr[0]));
            //die();
            $ToDate = str_replace('/', '-', trim($RangeArr[1]));

            if (!(isset($_POST['territoryID']) && !empty($_POST['territoryID']))) {
                $data['dataInfo'] = $this->SalesreportModule->getCancellation($FromDate, $ToDate, $data['sbTerritory'], 'cancel-summery', $data['areaID'], $data['sbRange']);
            }


            //if(!(isset($_POST['territoryID']) && !empty($_POST['territoryID']))){
            $data['detailInfo'] = $this->SalesreportModule->getCancellation($FromDate, $ToDate, $data['sbTerritory'], 'cancel-territory_detail', $data['areaID'], $data['sbRange']);
            $data['territoryData'] = $this->SalesreportModule->getCancellation($FromDate, $ToDate, $data['sbTerritory'], 'cancel-territory_summery', $data['areaID'], $data['sbRange']);
            //}
        }


        $this->load->view('template/header', $data);
        $this->load->view('secondary/reports/agency/cancellation');
        $this->load->view('template/footer');
    }

    function getNotInvoiceShops() {

        $data['territoryData'] = $this->SalesreportModule->notInvoiceShops();
    }

    /* monthly summary */

    function monthlySummary($msg = null) {
        $functionID = 72; //app_module_function table id
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 44; // app_module_function_sub table id
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);

        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'Daily Sales Summery';
        $data['pagetitle'] = 'Daily Sales Summery';
        $data['msg'] = $msg;

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['DateRange'] = '';
        $data['AreaList'] = $this->MasterModule->getArea(null, '001', 1);
        $data['RangeList'] = $this->MasterModule->getRange();
        $data['ASE_Territory'] = null;
        $data['ASE_Area'] = null;

        if ($sess['grade_id'] == 4) {
            $data['ASE_Area'] = $this->UsersModel->getAllowedAreas($sess['username']);
            //$area_id = $data['ASE_Area']->area_id;
            //$data['ASE_Territory'] = $this->MasterModule->getAreaTerritory(null, '001', $data['ASE_Area']->area_id);
        }
        $data['sbTerritory'] = 'a';

        if (isset($_POST['DateRange']) && !empty($_POST['DateRange'])) {
            $data['DateRange'] = $_POST['DateRange'];

            if (isset($_POST['areaID']) && !empty($_POST['areaID'])) {
                $data['areaID'] = $_POST['areaID'];
                $area_id = $data['areaID'];
            }
            $territoryID = null;
            if (isset($_POST['territoryID']) && !empty($_POST['territoryID'])) {
                $data['sbTerritory'] = $_POST['territoryID'];
                $territoryID = $data['sbTerritory'];
            }

            if (isset($_POST['rangeID']) && !empty($_POST['rangeID'])) {
                $data['sbRange'] = $_POST['rangeID'];
                $rangeID = $data['sbRange'];
            }

            $data['DateRange'] = $DateRange = $_POST['DateRange'];
            $RangeArr = explode('-', $DateRange);
            $FromDate = str_replace('/', '-', trim($RangeArr[0]));
            //die();
            $ToDate = str_replace('/', '-', trim($RangeArr[1]));

            //if(!(isset($_POST['territoryID']) && !empty($_POST['territoryID']))){
            $data['dataInfo'] = $this->SalesreportModule->getCancellation($FromDate, $ToDate, $data['sbTerritory'], 'monthly-items-summery', $data['areaID'], $data['sbRange']);
            //}
            //if(!(isset($_POST['territoryID']) && !empty($_POST['territoryID']))){
            //$data['detailInfo'] = $this->SalesreportModule->getCancellation($FromDate, $ToDate, $data['sbTerritory'], 'monthly-items-territory_detail', $data['areaID'], $data['sbRange']);
            //$data['territoryData'] = $this->SalesreportModule->getCancellation($FromDate, $ToDate, $data['sbTerritory'], 'monthly-items-territory_summery', $data['areaID'], $data['sbRange']);
            //}
            $data['ReportTitle'] = $this->CommonModule->getTitle('Area Sales Summery Items', 1, $area_id, $territoryID, $rangeID, 'Actual', $FromDate, $ToDate);
        }


        $this->load->view('template/header', $data);
        $this->load->view('secondary/reports/agency/monthly_summary_items');
        $this->load->view('template/footer');
    }

    function pendingBillReport($msg = null) {
        $functionID = 72;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 58;
        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'O/E Transactions';
        $data['pagetitle'] = 'O/E Transactions';
        $data['msg'] = $msg;
        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);
        $data['AreaList'] = $this->MasterModule->getArea(null, '001', 1);
        $data['RangeList'] = $this->MasterModule->getRange();

        $data['sbTerritory'] = 'a';
        $data['DateRange'] = '';
        if (isset($_POST['DateRange']) && !empty($_POST['DateRange'])) {
            $data['DateRange'] = $DateRange = $_POST['DateRange'];
            $RangeArr = explode('-', $DateRange);
            $FromDate = str_replace('/', '-', trim($RangeArr[0]));

            $ToDate = str_replace('/', '-', trim($RangeArr[1]));

            if (isset($_POST['areaID']) && !empty($_POST['areaID'])) {
                $data['areaID'] = $_POST['areaID'];
            }

            if (isset($_POST['territoryID']) && !empty($_POST['territoryID'])) {
                $data['sbTerritory'] = $_POST['territoryID'];
            }

            if (isset($_POST['rangeID']) && !empty($_POST['rangeID'])) {
                $data['sbRange'] = $_POST['rangeID'];
            }

            $data['BillReport'] = $this->SalesreportModule->getPendingBill($data['areaID'], $data['sbRange'], $FromDate, $ToDate);
        }



        $this->load->view('template/header', $data);
        $this->load->view('secondary/reports/agency/pending_bill');
        $this->load->view('template/footer');
    }

    function notBillOutletList($msg = null) {
        $functionID = 72;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 59;
        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'O/E Transactions';
        $data['pagetitle'] = 'O/E Transactions';
        $data['msg'] = $msg;
        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);
        $data['AreaList'] = $this->MasterModule->getArea(null, '001', 1);
        $data['RangeList'] = $this->MasterModule->getRange();

        $data['sbTerritory'] = 'a';
        $data['DateRange'] = '';
        if (isset($_POST['DateRange']) && !empty($_POST['DateRange'])) {
            $data['DateRange'] = $DateRange = $_POST['DateRange'];
            $RangeArr = explode('-', $DateRange);
            $FromDate = str_replace('/', '-', trim($RangeArr[0]));

            $ToDate = str_replace('/', '-', trim($RangeArr[1]));

            if (isset($_POST['areaID']) && !empty($_POST['areaID'])) {
                $data['areaID'] = $_POST['areaID'];
            }



            if (isset($_POST['territoryID']) && !empty($_POST['territoryID'])) {
                $data['sbTerritory'] = $_POST['territoryID'];
            }
            if (isset($_POST['rangeID']) && !empty($_POST['rangeID'])) {
                $data['sbRange'] = $_POST['rangeID'];
            }



            $data['NotBillOutlet'] = $this->SalesreportModule->getNotBillOutlet($data['areaID'], $data['sbRange'], $FromDate, $ToDate);
        }



        $this->load->view('template/header', $data);
        $this->load->view('secondary/reports/agency/not_bill_outlet_list');
        $this->load->view('template/footer');
    }

    function invoiceTimeline($msg = null) {
        $functionID = 72;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 60;
        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'O/E Transactions';
        $data['pagetitle'] = 'O/E Transactions';
        $data['msg'] = $msg;
        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);

        $data['invoice_number'] = '';
        if (isset($_POST['invoice_number']) && !empty($_POST['invoice_number'])) {
            $data['invoice_number'] = $_POST['invoice_number'];
            $data['InvoiceTimmeline'] = $this->SalesreportModule->getInvoiceTimmeline($data['invoice_number']);
            $data['InvoiceTimmelineView'] = $this->SalesreportModule->getInvoiceDeatils($data['invoice_number']);
        }

        $this->load->view('template/header', $data);
        $this->load->view('secondary/reports/agency/invoice_timeline');
        $this->load->view('template/footer');
    }

}
