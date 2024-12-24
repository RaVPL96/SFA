<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
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

    public function index_dashboard($msg = null) {
        $data['msg'] = $msg;
        $data['sess'] = $sess = $this->session->userdata('User');
        $data['pagetitle'] = 'LMA Logins';
        $data['title'] = 'LMA';
        if (!empty($data['sess']) && isset($data['sess']) && $data['sess']['logged_in']) {
            $data['title'] = COMPANY;
            $data['modules'] = $this->UsersModel->getMainModule();
            $data['menu'] = $this->UsersModel->getMenuList();
            $data['UserList'] = $this->UsersModel->getUserList(null, 1, null);

            $areaIDPassed = null;
            $rangeIDPassed = null;
            $dateRangePassed = '2022-06-30';
            $rangeID = null;
            $data['AreaList'] = $this->MasterModule->getArea(null, '001', 1);
            if (!(!empty($dateRangePassed) & isset($dateRangePassed))) {//if date range is not passed
                $dateRangePassed = date('Y-m-01') . '~' . date('Y-m-d');
            }
            //get targets
            $date = date('Y-m-d');
            $year = date('Y', strtotime($date));
            $month = date('m', strtotime($date));

            if ($sess['grade_id'] == 4) {//ASE
                $data['ASE_Area'] = $this->UsersModel->getAllowedAreas($sess['username']);
                foreach ($data['ASE_Area'] as $area) {
                    $areaIDPassed = $area['area_id'];
                    $rangeIDPassed = $area['range_id'];
                }

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
            if (!empty($territoryIDPassed) && isset($territoryIDPassed)) {
                $_POST['territoryID'] = $territoryIDPassed;
            }
            if (!empty($dateRangePassed) && isset($dateRangePassed)) {
                $dateRangePassed = str_replace('~', ' - ', str_replace('-', '/', trim($dateRangePassed)));
                $_POST['DateRange'] = $dateRangePassed;
            }
            $_POST['billMethod'] = 'A';
            $data['DateRange'] = null;
            $routeID = null;
            $billMethod = null;
            $territoryID = null;
            $area_id = null;
            $data['DateRange'] = $DateRange = $_POST['DateRange'];
            $RangeArr = explode('-', $DateRange);
            $data['FromDate'] = $FromDate = str_replace('/', '-', trim($RangeArr[0]));
            $data['ToDate'] = $ToDate = str_replace('/', '-', trim($RangeArr[1]));
            $data['targetData'] = $this->SalesreportModule->getTarget($year, $month);
            if (!empty($_POST['billMethod']) && isset($_POST['billMethod'])) {
                $data['billMethod'] = $billMethod = $_POST['billMethod'];
            }

            if (!empty($_POST['areaID']) && isset($_POST['areaID'])) {
                $data['AreaID'] = $area_id = $_POST['areaID'];
                $data['AreaDetails'] = $this->MasterModule->getArea($area_id);
                if (!empty($_POST['rangeID']) && isset($_POST['rangeID'])) {
                    $data['RangeID'] = $rangeID = $_POST['rangeID'];
                    $data['RangeName'] = $this->MasterModule->getRange($rangeID);
                }






                //echo $area_id.'/'. $territoryID.'/'. $routeID.'/'. $rangeID.'/'. $billMethod.'/'. $FromDate.'/'. $ToDate.'/'. 'summery_territory';
                $data['SalesData'] = $this->SalesreportModule->getDailyPcTotals($area_id, $territoryID, $routeID, $rangeID, $billMethod, $FromDate, $ToDate, 'summery');
                //print_r($data['SalesData']);
                $data['SalesDataTerritory'] = $this->SalesreportModule->getDailyPcTotals($area_id, $territoryID, $routeID, $rangeID, $billMethod, $FromDate, $ToDate, 'summery_territory');
                //print_r($data['SalesDataTerritory']);

                if (!empty($territoryIDPassed) && isset($territoryIDPassed)) {
                    $territoryIDPassed = $territoryID;
                    $data['SalesDataDetails'] = $this->SalesreportModule->getDailyPcTotals($area_id, $territoryID, $routeID, $rangeID, $billMethod, $FromDate, $ToDate, 'details');
                }
            }

            $data['range_chart_array'] = 'a';
            if ($sess['grade_id'] != 5 && $sess['grade_id'] != 4) {//not for sales rep and other users also except ASE
                $data['ChannelMapping'] = $this->SalesreportModule->getChanneltoAreaMap();

                foreach ($data['ChannelMapping'] as $c) {
                    $data['RangeList'] = $this->SalesreportModule->getRangeList($c['channel_id']);
                    foreach ($data['RangeList'] as $r) {
                        //echo "SalesData_Area_Summery_".$c['channel_id']."_".$r['range_id'];
                        if ($r['range_id'] == 5) { // skip town operation and consider that as a D value
                        } else {
                            $data['SalesData_Area_Summery_' . $c['channel_id'] . '_' . $r['range_id']] = $this->SalesreportModule->getDailyPcTotals($area_id, $territoryID, $routeID, $r['range_id'], $billMethod, $FromDate, $ToDate, 'summery_area', $c['channel_id']);
                        }
                    }
                }
                /*
                  $rangeID=1;//Area Summery
                  $data['SalesData_Area_Summery'] = $this->SalesreportModule->getDailyPcTotals($area_id, $territoryID, $routeID, $rangeID, $billMethod, $FromDate, $ToDate, 'summery_area');
                  $rangeID=2;//Area Summery
                  $data['SalesData_Area_Summery_2'] = $this->SalesreportModule->getDailyPcTotals($area_id, $territoryID, $routeID, $rangeID, $billMethod, $FromDate, $ToDate, 'summery_area');
                 */
            }

            $this->load->view('template/header', $data);
            $this->load->view('welcome_message');
            $this->load->view('template/footer');
        } else {
            header('location:' . base_url('index.php/users/index'));
        } /* echo 'post';		print_r($_POST);		echo 'get';		print_r($_GET); */
    }

    public function index($msg = null) {
        $data['msg'] = $msg;
        $data['sess'] = $sess = $this->session->userdata('User');
        $data['pagetitle'] = 'LMA Logins';
        $data['title'] = 'LMA';
        if (!empty($data['sess']) && isset($data['sess']) && $data['sess']['logged_in']) {
            $data['title'] = COMPANY;
            $data['modules'] = $this->UsersModel->getMainModule();
            $data['menu'] = $this->UsersModel->getMenuList();
            $data['UserList'] = $this->UsersModel->getUserList(null, 1, null);
            $areaIDPassed = null;
            $rangeIDPassed = null;
            $dateRangePassed = null; //'2022-06-01~2022-06-30';
            $rangeID = null;
            $data['channelID'] = 1;
            $data['billMethod'] = null;
            $billMethod = null;
            //$data['AreaList'] = $this->MasterModule->getArea(null, '001', 1);
            if (!empty($_POST['DateRange']) && isset($_POST['DateRange'])) {
                $dtr = $_POST['DateRange'];
                $dateRangePassed = str_replace('/', '-', trim(str_replace('-', '~', trim($dtr))));
            }
            if (!empty($_POST['channelID']) && isset($_POST['channelID'])) {
                 $data['channelID'] = $_POST['channelID'];
                 //$data['billMethod'] = 'B';
            }
            $data['AreaList'] = $this->MasterModule->getArea(null, $data['channelID'], 1);
            
            if (!(!empty($dateRangePassed) && isset($dateRangePassed))) {//if date range is not passed
                $dateRangePassed = date('Y-m-01') . '~' . date('Y-m-d');
            }
            //get targets
            $date = date('Y-m-d');
            $year = date('Y', strtotime($date));
            $month = date('m', strtotime($date));

            if ($sess['grade_id'] == 4) {//ASE
                $data['ASE_Area'] = $this->UsersModel->getAllowedAreas($sess['username']);
                foreach ($data['ASE_Area'] as $area) {
                    $areaIDPassed = $area['area_id'];
                    $rangeIDPassed = $area['range_id'];
                }
                //$area_id = $data['ASE_Area']->area_id;
                //$data['ASE_Territory'] = $this->MasterModule->getAreaTerritory(null, '001', $data['ASE_Area']->area_id);
            }

            $data['ChannelList'] = $this->MasterModule->getChannel();
            $data['RangeList'] = $this->MasterModule->getRange();

            
            if (!empty($areaIDPassed) && isset($areaIDPassed)) {
                $_POST['areaID'] = $areaIDPassed;
            }
            if (!empty($rangeIDPassed) && isset($rangeIDPassed)) {
                $_POST['rangeID'] = $rangeIDPassed;
            }
            if (!empty($territoryIDPassed) && isset($territoryIDPassed)) {
                $_POST['territoryID'] = $territoryIDPassed;
            }
            if (!empty($dateRangePassed) && isset($dateRangePassed)) {
                $dateRangePassed = str_replace('~', ' - ', str_replace('-', '/', trim($dateRangePassed)));
                $_POST['DateRange'] = $dateRangePassed;
            }
            $_POST['billMethod'] = 'A';
            $data['DateRange'] = null;
            $routeID = null;
            
            $territoryID = null;
            $area_id = null;
            $data['DateRange'] = $DateRange = $_POST['DateRange'];
            $RangeArr = explode('-', $DateRange);
            $data['FromDate'] = $FromDate = str_replace('/', '-', trim($RangeArr[0]));
            $data['ToDate'] = $ToDate = str_replace('/', '-', trim($RangeArr[1]));
            $data['targetData'] = $this->SalesreportModule->getTarget(date('Y', strtotime($FromDate)), date('m', strtotime($FromDate)), $areaIDPassed);
            //print_r($data['targetData']);
            //    die();
            if (!empty($_POST['billMethod']) && isset($_POST['billMethod'])) {
                $data['billMethod'] = $billMethod = $_POST['billMethod'];
            }

            if (!empty($_POST['areaID']) && isset($_POST['areaID'])) {
                $data['AreaID'] = $area_id = $_POST['areaID'];
                $data['AreaDetails'] = $this->MasterModule->getArea($area_id);
                if (!empty($_POST['rangeID']) && isset($_POST['rangeID'])) {
                    $data['RangeID'] = $rangeID = $_POST['rangeID'];
                    $data['RangeName'] = $this->MasterModule->getRange($rangeID);
                }
                //echo $area_id.'/'. $territoryID.'/'. $routeID.'/'. $rangeID.'/'. $billMethod.'/'. $FromDate.'/'. $ToDate.'/'. 'summery_territory';
                //$data['SalesData'] = $this->SalesreportModule->getDailyPcTotals($area_id, $territoryID, $routeID, $rangeID, $billMethod, $FromDate, $ToDate, 'summery');
                if ($data['channelID'] == 1) {
                    $data['SalesData'] = $this->SalesreportModule->getDailyPcTotals($area_id, $territoryID, $routeID, $rangeID, $billMethod, $FromDate, $ToDate, 'summery');
                } else {
                    $data['SalesData'] = $this->SalesreportModule->getDailyPcTotalsNew($area_id, $territoryID, $routeID, $rangeID, $billMethod, $FromDate, $ToDate, 'summery',$data['channelID']);
                }
//print_r($data['SalesData']);
                //$data['SalesDataTerritory'] = $this->SalesreportModule->getDailyPcTotals($area_id, $territoryID, $routeID, $rangeID, $billMethod, $FromDate, $ToDate, 'summery_territory');
                //print_r($data['SalesDataTerritory']);
                if($data['channelID']==1){
                    $data['SalesDataTerritory'] = $this->SalesreportModule->getDailyPcTotals($area_id, $territoryID, $routeID, $rangeID, $billMethod, $FromDate, $ToDate, 'summery_territory');
                    
                } else {
                    $data['SalesDataTerritory'] = $this->SalesreportModule->getDailyPcTotalsNew($area_id, $territoryID, $routeID, $rangeID, $billMethod, $FromDate, $ToDate, 'summery_territory',$data['channelID']);
                }

                if (!empty($territoryIDPassed) && isset($territoryIDPassed)) {
                    $territoryIDPassed = $territoryID;
                    $data['SalesDataDetails'] = $this->SalesreportModule->getDailyPcTotals($area_id, $territoryID, $routeID, $rangeID, $billMethod, $FromDate, $ToDate, 'details');
                
                    if ($data['channelID']==1){
                        $data['SalesDataDetails'] = $this->SalesreportModule->getDailyPcTotals($area_id, $territoryID, $routeID, $rangeID, $billMethod, $FromDate, $ToDate, 'details');
                    } else {
                        $data['SalesDataDetails'] = $this->SalesreportModule->getDailyPcTotalsNew($area_id, $territoryID, $routeID, $rangeID, $billMethod, $FromDate, $ToDate, 'details',$data['channelID']);
                    }
                }
                
            }
            //echo $billMethod;
            //die();
            $data['range_chart_array'] = 'a';
            if ($sess['grade_id'] != 5 && $sess['grade_id'] != 4) {//not for sales rep and other users also except ASE
                $data['ChannelMapping'] = $this->SalesreportModule->getChanneltoAreaMap($data['channelID']);
                foreach ($data['ChannelMapping'] as $c) {
                    $data['RangeList'] = $this->SalesreportModule->getRangeList($c['channel_id']);
                    foreach ($data['RangeList'] as $r) {
                        //echo "SalesData_Area_Summery_".$c['channel_id']."_".$r['range_id'];
                        if ($data['channelID']==1){
                        $data['SalesData_Area_Summery_' . $c['channel_id'] . '_' . $r['range_id']] = $this->SalesreportModule->getDailyPcTotals($area_id, $territoryID, $routeID, $r['range_id'], $billMethod, $FromDate, $ToDate, 'summery_area', $c['channel_id']);
                        } else {
                            $data['SalesData_Area_Summery_' . $c['channel_id'] . '_' . $r['range_id']] = $this->SalesreportModule->getDailyPcTotalsNew($area_id, $territoryID, $routeID, $r['range_id'], $billMethod, $FromDate, $ToDate, 'summery_area', $c['channel_id']);
                        }
                    }
                }
                /*
                  $rangeID=1;//Area Summery
                  $data['SalesData_Area_Summery'] = $this->SalesreportModule->getDailyPcTotals($area_id, $territoryID, $routeID, $rangeID, $billMethod, $FromDate, $ToDate, 'summery_area');
                  $rangeID=2;//Area Summery
                  $data['SalesData_Area_Summery_2'] = $this->SalesreportModule->getDailyPcTotals($area_id, $territoryID, $routeID, $rangeID, $billMethod, $FromDate, $ToDate, 'summery_area');
                 */
            }

            $this->load->view('template/header', $data);
            $this->load->view('welcome_message_1');
            $this->load->view('template/footer');
        } else {
            header('location:' . base_url('index.php/users/index'));
        } /* echo 'post';		print_r($_POST);		echo 'get';		print_r($_GET); */
    }

}
