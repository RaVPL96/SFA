<?php
/*
 * This system Licenced to Raigam Marketing Services (Pvt) Ltd. 
 * Developed By: Lakshitha Pradeep Karunarathna  * 
 * Company: Serving Cloud INC in association with MyOffers.lk  * 
 * Date Started:  October 20, 2017  * 
 */
class Hr extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('UsersModel');
        $this->load->model('MasterModule');
        $this->load->model('HrModule');
    }

    function index($msg = null) {
        $functionID = 68;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 22;
        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'Time Attendance';
        $data['pagetitle'] = 'Time Attendance';
        $data['msg'] = $msg;
        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);
        $this->load->view('template/header', $data);
        $this->load->view('secondary/hr/index');
        $this->load->view('template/footer');
    }

    function timeAttendance($msg = null) {
        $functionID = 68;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 22;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);

        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'Time Attendance';
        $data['pagetitle'] = 'Time Attendance';
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
            $FromDate = str_replace('/', '', trim($RangeArr[0]));
            $ToDate = str_replace('/', '', trim($RangeArr[1]));
            $salesRep = '';
           // $this->HrModule->setAttendance($FromDate, $ToDate);
            $data['AttenType']=$this->HrModule->getAttendanceType();
            //$data['BillCount']=$this->HrModule->getBillCount(null,$FromDate,$ToDate);     
            //$data['TimeAttendance'] = $this->HrModule->getTimeAttendance(null,$FromDate,$ToDate); 
            $data['TimeAttendance'] = $this->HrModule->getAttendanceFinal($FromDate, $ToDate,$areaID,$territoryID,$rangeID);
        }
        $this->load->view('template/header', $data);
        $this->load->view('secondary/hr/attendance');
        $this->load->view('template/footer');
    }

    function timeAttendanceComment(){
        $data=$_POST;
        $result = $this->HrModule->saveAttendanceComment($data);
        if($result==1){
            header('Location:'.base_url('index.php/hr/timeAttendance/ok/'));
        }else{
            header('Location:'.base_url('index.php/hr/timeAttendance/fail/'));
        }
    }
}

?>