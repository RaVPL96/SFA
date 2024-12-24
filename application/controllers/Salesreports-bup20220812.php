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
        $territoryID=null;
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
            if ($rptMethod == 'I') {
                $data['SalesData'] = $this->SalesreportModule->getOrdersDOld(NULL, null, null, 'details_line_free', $territoryID, $FromDate, $ToDate);
                $data['ItemData'] = $this->SalesreportModule->getOrdersDOld(NULL, null, null, 'details_line_free_items', $territoryID, $FromDate, $ToDate);
            }elseif($rptMethod == 'C'){//category wise data
                $data['SalesData'] = $this->SalesreportModule->getOrdersDOld(NULL, null, null, 'details_line_free_category', $territoryID, $FromDate, $ToDate);
                $data['FreeCategoryData'] = $this->SalesreportModule->getOrdersDOld(NULL, null, null, 'details_line_free_category_list', $territoryID, $FromDate, $ToDate);
            }
        }

        $this->load->view('template/header', $data);
        $this->load->view('secondary/reports/agency/free_issue_reconsiliation');
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

    function areaSummery($msg = null,$areaIDPassed=null,$rangeIDPassed=null,$territoryIDPassed=null,$dateRangePassed=null,$billingMethodPass=null,$dateBilled=null) {
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

        $data['AreaList'] = $this->MasterModule->getArea(null, '001', 1);
        if ($sess['grade_id'] == 4) {//ASE
            $data['ASE_Area'] = $this->UsersModel->getAllowedAreas($sess['username']);
            //$area_id = $data['ASE_Area']->area_id;
            //$data['ASE_Territory'] = $this->MasterModule->getAreaTerritory(null, '001', $data['ASE_Area']->area_id);
        }
        $data['RangeList'] = $this->MasterModule->getRange();

        $data['billMethod'] = null;
        if(!empty($areaIDPassed) && isset($areaIDPassed)){
            $_POST['areaID']=$areaIDPassed;
        }
        if(!empty($rangeIDPassed) && isset($rangeIDPassed)){
            $_POST['rangeID']=$rangeIDPassed;
        }
        if(!empty($territoryIDPassed) && isset($territoryIDPassed)){
            $_POST['territoryID']=$territoryIDPassed;
        }
        if(!empty($billingMethodPass) && isset($billingMethodPass)){
            $_POST['billMethod']=$billingMethodPass;
        }
        if(!empty($dateRangePassed) && isset($dateRangePassed)){
            $dateRangePassed=str_replace('~', ' - ',str_replace('-','/', trim($dateRangePassed)));
            $_POST['DateRange']=$dateRangePassed;
        }
        if (!empty($_POST['areaID']) && isset($_POST['areaID'])) {
            $routeID = null;
            $billMethod = null;
            $territoryID = null;
            $data['AreaID']=$area_id = $_POST['areaID'];
            $data['AreaDetails'] = $this->MasterModule->getArea($area_id);
            if (!empty($_POST['rangeID']) && isset($_POST['rangeID'])) {
                $data['RangeID']=$rangeID = $_POST['rangeID'];
                $data['RangeName'] = $this->MasterModule->getRange($rangeID);
            }
            if (!empty($_POST['billMethod']) && isset($_POST['billMethod'])) {
                $data['billMethod'] = $billMethod = $_POST['billMethod'];
            }
            $data['DateRange'] = $DateRange = $_POST['DateRange'];
            $RangeArr = explode('-', $DateRange);
            $FromDate = str_replace('/', '-', trim($RangeArr[0]));
            $ToDate = str_replace('/', '-', trim($RangeArr[1]));
            if(!empty($territoryIDPassed) && isset($territoryIDPassed)){
                $data['territoryID']=$territoryID=$territoryIDPassed;                
            }
			
			$data['FromDate']=$FromDate;   
            $data['targetData'] = $this->SalesreportModule->getTarget(date('Y', strtotime($FromDate)), date('m', strtotime($FromDate)));
			
			
            $data['SalesData'] = $this->SalesreportModule->getDailyPcTotals($area_id, $territoryID, $routeID, $rangeID, $billMethod, $FromDate, $ToDate, 'summery');
            $data['SalesDataTerritory'] = $this->SalesreportModule->getDailyPcTotals($area_id, $territoryID, $routeID, $rangeID, $billMethod, $FromDate, $ToDate, 'summery_territory');
            if(!empty($territoryIDPassed) && isset($territoryIDPassed)){
                //$territoryID=$territoryIDPassed;
                if(!empty($dateBilled) && isset($dateBilled)){
                    $FromDate=$dateBilled;
                    $ToDate=$dateBilled;
                    $data['SalesDataDetails'] = $this->SalesreportModule->getDailyPcTotals($area_id, $territoryID, $routeID, $rangeID, $billMethod, $FromDate, $ToDate, 'details');
                }
                
            }
        }
        $this->load->view('template/header', $data);
        $this->load->view('secondary/reports/area/area_achievment_summery');
        $this->load->view('template/footer');
    }

    /*Reusable Item Retrun report from agency*/
    function returnOther($msg = null){
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
            $data['OtherReturn']=$this->SalesreportModule->getReturnOther(null, $FromDate, $ToDate);
            
        }
        
        $this->load->view('template/header', $data);
        $this->load->view('secondary/reports/area/area_return_other');
        $this->load->view('template/footer');
    }
    
    /*-----------------------------------------------------Sandun-----------------------------------------------------*/
    /*--------------------------------------Area Summery Item Wise--------------------------------------*/
    function areaSummeryItem($msg = null,$areaIDPassed=null,$categoryIDPassed=null,$territoryIDPassed=null,$dateRangePassed=null,$billingMethodPass=null,$dateBilled=null) {
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
        $data['CategoryID'] = null;
        $data['categoryID'] = null;
        $data['routeID'] = null;

        $data['AreaList'] = $this->MasterModule->getArea(null, '001', 1);
        if ($sess['grade_id'] == 4) {//ASE
            $data['ASE_Area'] = $this->UsersModel->getAllowedAreas($sess['username']);
            //$area_id = $data['ASE_Area']->area_id;
            //$data['ASE_Territory'] = $this->MasterModule->getAreaTerritory(null, '001', $data['ASE_Area']->area_id);
        }
        $data['CategoryList'] = $this->MasterModule->getCategoryList();

        $data['billMethod'] = null;
        if(!empty($areaIDPassed) && isset($areaIDPassed)){
            $_POST['areaID']=$areaIDPassed;
        }
        if(!empty($categoryIDPassed) && isset($categoryIDPassed)){
            $_POST['categoryID']=$categoryIDPassed;
        }
        if(!empty($territoryIDPassed) && isset($territoryIDPassed)){
            $_POST['territoryID']=$territoryIDPassed;
        }
        if(!empty($billingMethodPass) && isset($billingMethodPass)){
            $_POST['billMethod']=$billingMethodPass;
        }
        if(!empty($dateRangePassed) && isset($dateRangePassed)){
            $dateRangePassed=str_replace('~', ' - ',str_replace('-','/', trim($dateRangePassed)));
            $_POST['DateRange']=$dateRangePassed;
        }
        if (!empty($_POST['areaID']) && isset($_POST['areaID'])) {
            $routeID = null;
            $billMethod = null;
            $territoryID = null;
            $categoryID = null;
            $data['AreaID']=$area_id = $_POST['areaID'];
            $data['AreaDetails'] = $this->MasterModule->getArea($area_id);
            /*if (!empty($_POST['cat']) && isset($_POST['cat'])) {
                $data['cat']=$cat = $_POST['cat'];
                $data['cat'] = $this->MasterModule->getCategoryList($cat);
            }*/
            if (!empty($_POST['categoryID']) && isset($_POST['categoryID'])) {
                $data['categoryID']= $categoryID = $_POST['categoryID'];
                $data['categoryID'] = $this->MasterModule->getCategoryList($categoryID);
            }
            if (!empty($_POST['billMethod']) && isset($_POST['billMethod'])) {
                $data['billMethod'] = $billMethod = $_POST['billMethod'];
            }
            $data['DateRange'] = $DateRange = $_POST['DateRange'];
            $RangeArr = explode('-', $DateRange);
            $FromDate = str_replace('/', '-', trim($RangeArr[0]));
            $ToDate = str_replace('/', '-', trim($RangeArr[1]));
            if(!empty($territoryIDPassed) && isset($territoryIDPassed)){
                $data['territoryID']=$territoryID=$territoryIDPassed;                
            }
            $data['SalesData'] = $this->SalesreportModule->getItemsPcTotals($area_id, $territoryID, $routeID, $categoryID, $billMethod, $FromDate, $ToDate, 'summery');
            $data['SalesDataTerritory'] = $this->SalesreportModule->getItemsPcTotals($area_id, $territoryID, $routeID, $categoryID, $billMethod, $FromDate, $ToDate, 'summery_territory');
            if(!empty($territoryIDPassed) && isset($territoryIDPassed)){
                //$territoryID=$territoryIDPassed;
                if(!empty($dateBilled) && isset($dateBilled)){
                    $FromDate=$dateBilled;
                    $ToDate=$dateBilled;
                    $data['SalesDataDetails'] = $this->SalesreportModule->getItemsPcTotals($area_id, $territoryID, $routeID, $categoryID, $billMethod, $FromDate, $ToDate, 'details');
                }
                
            }
        }
        $this->load->view('template/header', $data);
        $this->load->view('secondary/reports/area/area_achi_sum_item');
        $this->load->view('template/footer');
    }    
    /*--------------------------------------Area Summery Item Wise--------------------------------------*/

    /*non moving*/
    function nonMovingReport($msg = null) {
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

        //check the login user is an ASE(GRADE ID = 4)
        $data['category_name'] = null;
        $data['ItemID'] = null;
        $data['DateRange'] = null;
        /*$data['RangeID'] = null;
        $data['routeID'] = null;*/

        $data['category'] = $this->MasterModule->getCategoryList();
        //$data['RangeList'] = $this->MasterModule->getRange();

        //$data['billMethod'] = null;
        if (!empty($_POST['categoryID']) && isset($_POST['categoryID'])) {
            $routeID = null;
            $billMethod = null;
            $area_id = $_POST['categoryID'];
            if (!empty($_POST['ItemID']) && isset($_POST['ItemID'])) {
                $territoryID = $_POST['ItemID'];
            }
            /*if (!empty($_POST['routeID']) && isset($_POST['routeID'])) {
                $routeID = $_POST['routeID'];
            }

            if (!empty($_POST['rangeID']) && isset($_POST['rangeID'])) {
                $rangeID = $_POST['rangeID'];
            }

            if (!empty($_POST['billMethod']) && isset($_POST['billMethod'])) {
                $data['billMethod'] = $billMethod = $_POST['billMethod'];
            }*/
            $data['DateRange'] = $DateRange = $_POST['DateRange'];
            $RangeArr = explode('-', $DateRange);
            $FromDate = str_replace('/', '-', trim($RangeArr[0]));
            $ToDate = str_replace('/', '-', trim($RangeArr[1]));

            $data['SalesData'] = $this->NonMovingReportModule->getNonMovings($area_id, $territoryID, $routeID, $rangeID, $billMethod, $FromDate, $ToDate);
        }

        $this->load->view('template/header', $data);
        $this->load->view('secondary/reports/agency/non_moving_report');
        $this->load->view('template/footer');
    } 
    /*non moving*/
    /*-----------------------------------------------------Sandun-----------------------------------------------------*/

}
