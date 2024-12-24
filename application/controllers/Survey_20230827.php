<?php
class Survey extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('UsersModel');
        $this->load->model('ItemsModel');
        $this->load->model('SurveyModel');
        $this->load->model('MasterModule');
        $this->load->model('HrModule');
    }
    //Load Icons
    function index($msg = null) {
        $functionID = 71;
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
        $this->load->view('secondary/survey/index');
        $this->load->view('template/footer');
    }
    
    function surveymonitor($msg = null){
        $functionID = 71;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 26;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);

        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'Review Market Research Status';
        $data['pagetitle'] = 'Review Market Research Status';
        $data['msg'] = $msg;

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();

        $data['AreaList'] = $this->MasterModule->getArea(null,'001',1);
        $data['RangeList']  = $this->MasterModule->getRange();
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
            //$area_id = $data['ASE_Area']->area_id;
            //$data['ASE_Territory'] = $this->MasterModule->getAreaTerritory(null, '001', $data['ASE_Area']->area_id);
        }
        //nenaposha - 2
        //coffee - 3
        //washin powder - 4
        //nenaposha - october - 5
        if (!empty($_POST['DateRange']) && isset($_POST['DateRange'])) {
            //print_r($_POST);
            $areaID=null;
            $territoryID=null;
            $rangeID=null;
            
            if (!empty($_POST['channel']) && isset($_POST['channel'])) {
                $channelList = $_POST['channel'];
            }
            if (!empty($_POST['areaID']) && isset($_POST['areaID'])) {
                if($_POST['areaID']=='-1'){
                    $_POST['areaID']=null;
                }
                $data['AreaID']=$areaID = $_POST['areaID'];
            }
            if (!empty($_POST['territoryID']) && isset($_POST['territoryID'])) {
                $data['TerritoryID']=$territoryID = $_POST['territoryID'];
            }
            if (!empty($_POST['rangeID']) && isset($_POST['rangeID'])) {
                $data['RangeID']=$rangeID = $_POST['rangeID'];
            }
            $data['DateRange'] = $DateRange = $_POST['DateRange'];
            $RangeArr = explode('-', $DateRange);
            $data['FromDate']=$FromDate = str_replace('/', '', trim($RangeArr[0]));
            $data['ToDate']=$ToDate = str_replace('/', '', trim($RangeArr[1]));
            $salesRep = '';
            $data['area_list']=$this->SurveyModel->getSurveyAreaList($FromDate, $ToDate,$areaID,$territoryID,$rangeID);
            //$data['BillCount']=$this->HrModule->getBillCount(null,$FromDate,$ToDate);     
            //$data['TimeAttendance'] = $this->HrModule->getTimeAttendance(null,$FromDate,$ToDate); 
            $data['TimeAttendance'] = $this->SurveyModel->getSurveySummery($FromDate, $ToDate,$areaID,$territoryID,$rangeID,12);
        }
        $data['TotalSample']= $this->SurveyModel->getTotal(12);
        $data['TotalSampleDetails']= $this->SurveyModel->getSurveyDetails(null, null,  null,  null, null,12);

        $this->load->view('template/header', $data);
        //$this->load->view('secondary/survey/monitor_nenaposha_october');
        //$this->load->view('secondary/survey/detergent_survey');
        //$this->load->view('secondary/survey/radio_survey');
        //$this->load->view('secondary/survey/monitor_telees');
        //$this->load->view('secondary/survey/monitor_coffee_april_2023');
        //$this->load->view('secondary/survey/monitor_pasta_may_2023');
        $this->load->view('secondary/survey/monitor_noodles_may_2023');
        $this->load->view('template/footer');
    }
}
