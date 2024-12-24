<?php

/*
 * This system Licenced to Raigam Marketing Services (Pvt) Ltd. 
 * Developed By: Lakshitha Pradeep Karunarathna  * 
 * Company: Serving Cloud INC in association with MyOffers.lk  * 
 * Date Started:  October 20, 2017  * 
 */

class Itemreports extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('UsersModel');
        $this->load->model('ItemsModel');
        $this->load->model('SurveyModel');
        $this->load->model('MasterModule');
        $this->load->model('HrModule');
        $this->load->model('ItemreportsModule');
        $this->load->model('CommonModule');
    }

    function categoryReport($msg = null) {
        $functionID = 78;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 52;
        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'O/E Transactions';
        $data['pagetitle'] = 'O/E Transactions';
        $data['msg'] = $msg;
        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);
        $this->load->view('template/header', $data);
        $this->load->view('secondary/reports/category/index');
        $this->load->view('template/footer');
    }

    function shopSale($msg = null) {
        $functionID = 78;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 52;
        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'O/E Transactions';
        $data['pagetitle'] = 'O/E Transactions';
        $data['msg'] = $msg;
        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);

        $areaIDPassed = '';
        $rangeIDPassed = '';
        $data['AreaID'] = '';
        $data['DateRange'] = '';
        $data['FromDate'] = '';
        $FromDate = '';
        $DateRange = '';
        $data['ToDate'] = '';
        $ToDate = '';
        $data['RangeID'] = '';
        $data['RangeName'] = '';
        $data['sbValueRange'] = '>=';
        $data['ValuePoint'] = 0;
        $data['categoryID'] = '';
        if ($sess['grade_id'] == 4) {//ASE
            $data['ASE_Area'] = $this->UsersModel->getAllowedAreas($sess['username']);
            foreach ($data['ASE_Area'] as $area) {
                $areaIDPassed = $area['area_id'];
                $rangeIDPassed = $area['range_id'];
            }
        }
        if (!empty($_POST['areaID']) && isset($_POST['areaID'])) {
            $data['AreaID'] = $_POST['areaID'];
        }
        if (!empty($_POST['rangeID']) && isset($_POST['rangeID'])) {
            $data['RangeID'] = $_POST['rangeID'];
            $data['RangeName'] = $data['RangeID']; // $this->MasterModule->getRange($data['RangeID'] );
        }
        if (!empty($_POST['sbValueRange']) && isset($_POST['sbValueRange'])) {
            $data['sbValueRange'] = $_POST['sbValueRange'];
        }

        if (!empty($_POST['ValuePoint']) && isset($_POST['ValuePoint'])) {
            $data['ValuePoint'] = $_POST['ValuePoint'];
        }
        if (!empty($_POST['category']) && isset($_POST['category'])) {//category sales requested
            $data['categoryID'] = $_POST['category'];
        }

        if (!empty($_POST['DateRange']) && isset($_POST['DateRange'])) {//category sales requested
            $data['DateRange'] = $_POST['DateRange'];
        }


        $data['AreaList'] = $this->MasterModule->getArea(null, '001', 1);
        $data['RangeList'] = $this->MasterModule->getRange();
        $data['CategoryList'] = $this->SalesreportModule->getCategoryList(3);
        if (!empty($_POST['DateRange']) && isset($_POST['DateRange']) && !empty($_POST['category']) && isset($_POST['category'])) {
            $data['DateRange'] = $DateRange = $_POST['DateRange'];
            $RangeArr = explode('-', $DateRange);
            $data['FromDate'] = $FromDate = str_replace('/', '-', trim($RangeArr[0]));
            $data['ToDate'] = $ToDate = str_replace('/', '-', trim($RangeArr[1]));
            if($data['categoryID']=='S'){
                $data['categoryLineData'] = $this->SalesreportModule->getCategoryList(3,'C');
                $data['categoryLineData2'] = $this->SalesreportModule->getCategoryList(3,'D');
                array_push($data['categoryLineData'],$data['categoryLineData2']);
            }else{
                $data['categoryLineData'] = $this->SalesreportModule->getCategoryList(3,$data['categoryID']);
            }
            $data['DataSet'] = $this->ItemreportsModule->getItemCategoryShopSaleDaily($data['AreaID'], $data['RangeID'], $FromDate, $ToDate, $data['sbValueRange'], $data['ValuePoint'],$data['categoryID']);
        }
        $this->load->view('template/header', $data);
        $this->load->view('secondary/reports/category/shopsales');
        $this->load->view('template/footer');
    }

    function getHardCount($msg = null){
        $functionID = 78;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 53;
        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'O/E Transactions';
        $data['pagetitle'] = 'O/E Transactions';
        $data['msg'] = $msg;
        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);

        $areaIDPassed = '';
        $rangeIDPassed = '';
        $data['AreaID'] = '';
        $data['DateRange'] = '';
        $data['FromDate'] = '';
        $FromDate = '';
        $DateRange = '';
        $data['ToDate'] = '';
        $ToDate = '';
        $data['RangeID'] = '';
        $data['RangeName'] = '';
        $data['sbValueRange'] = '>=';
        $data['ValuePoint'] = 0;
        $data['categoryID'] = '';
        if ($sess['grade_id'] == 4) {//ASE
            $data['ASE_Area'] = $this->UsersModel->getAllowedAreas($sess['username']);
            foreach ($data['ASE_Area'] as $area) {
                $areaIDPassed = $area['area_id'];
                $rangeIDPassed = $area['range_id'];
            }
        }
        if (!empty($_POST['areaID']) && isset($_POST['areaID'])) {
            $data['AreaID'] = $_POST['areaID'];
        }
        if (!empty($_POST['rangeID']) && isset($_POST['rangeID'])) {
            $data['RangeID'] = $_POST['rangeID'];
            $data['RangeName'] = $data['RangeID']; // $this->MasterModule->getRange($data['RangeID'] );
        }
         
        if (!empty($_POST['DateRange']) && isset($_POST['DateRange'])) {//category sales requested
            $data['DateRange'] = $_POST['DateRange'];
        }


        $data['AreaList'] = $this->MasterModule->getArea(null, '001', 1);
        $data['RangeList'] = $this->MasterModule->getRange();
        $data['CategoryList'] = $this->SalesreportModule->getCategoryList(4);
        if (!empty($_POST['DateRange']) && isset($_POST['DateRange'])) {
            $data['DateRange'] = $DateRange = $_POST['DateRange'];
            $RangeArr = explode('-', $DateRange);
            $data['FromDate'] = $FromDate = str_replace('/', '-', trim($RangeArr[0]));
            $data['ToDate'] = $ToDate = str_replace('/', '-', trim($RangeArr[1]));
            //$data['categoryLineData'] = $this->SalesreportModule->getCategoryList(3,$data['categoryID']);
            $data['ActualWorkingDates'] = $this->HrModule->getRepActualDayCount($FromDate, $ToDate);
            //$data['DataSet'] = $this->ItemreportsModule->getHardCount($data['AreaID'], $data['RangeID'], $FromDate, $ToDate);
            $data['DataSet'] = $this->ItemreportsModule->getHardCountDaily($data['AreaID'], $data['RangeID'], $FromDate, $ToDate);
        }
        $this->load->view('template/header', $data);
        $this->load->view('secondary/reports/category/hardcount');
        $this->load->view('template/footer');
    }
}
