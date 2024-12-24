<?php
class Users extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('UsersModel');
        $this->load->model('ItemsModel');
    }

    // All Users comes to register
    function index($msg = null) {
        $data['title'] = 'Raigam Marketing Services';
        $data['pagetitle'] = 'Login <b>' . PROGRAMNAME . '</b> System';
        $data['msg'] = $msg;
        $data['location'] = $this->ItemsModel->getLocationList();
        $this->load->view('users/login', $data);
    }

    function login() {
        if (!empty($_POST['email']) && isset($_POST['email']) && !empty($_POST['pass']) && isset($_POST['pass'])) {
            $user = $_POST['email'];
            $pass = $_POST['pass'];
            $location = $_POST['location'];
            $this->UsersModel->logMeIn($user, $pass, $location);
        } else {
            //header('Location:' . base_url('index.php/users/index/fail'));
        }
    }

    function logout() {
        $this->UsersModel->logout();
    }

    //CREATE STAFF ACCOUNT
    function createAcc($msg = NULL, $uname = NULL) {
        $functionID = 1;
        $this->UsersModel->authenticateMe($functionID);
        $data['userlist'] = $this->UsersModel->getUserList();
        if (!empty($uname) && isset($uname) && !is_null($uname)) {
            $data['userdata'] = $this->UsersModel->getUserList(NULL, NULL, $uname);
        }
        $data['userTypes'] = $this->UsersModel->getUserTypes();
        $data['Departments'] = $this->ItemsModel->getDepartments();
        $data['Grade'] = $this->UsersModel->getStructureList();

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();

        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = COMPANY;
        $data['pagetitle'] = COMPANY;
        $data['msg'] = $msg;

        $this->load->view('template/header', $data);
        $this->load->view('users/register');
        $this->load->view('template/footer');
    }
    //CALL CREATE ACCONUT FUNCTIONS
    function openAcc() {
        $functionID = 1; //same id use cos, createAcc  need this func to complete operation
        $this->UsersModel->authenticateMe($functionID);

        $data = $_POST;
        $this->UsersModel->createAcc($data);
    }

    //ADD REAL USER DETAILS TO USER ACCOUNT NAME
    function updateProfile($msg = NULL, $uname = NULL, $id='new'){
        $functionID = 74;
        $this->UsersModel->authenticateMe($functionID);
        $data['userlist'] = $this->UsersModel->getUserList();
        $data['userprofile']=null;
        if (!empty($uname) && isset($uname) && !is_null($uname)) {
            $data['userdata'] = $this->UsersModel->getUserList(NULL, NULL, $uname);
            $data['userprofiles'] = $this->UsersModel->getProfiledata(null,$uname);
            if($id!='new'){
                $data['userprofile'] = $this->UsersModel->getProfiledata($id,$uname);
            }
        }
        $data['userTypes'] = $this->UsersModel->getUserTypes();
        $data['Departments'] = $this->ItemsModel->getDepartments();
        $data['Grade'] = $this->UsersModel->getStructureList();
        
        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();

        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = COMPANY;
        $data['pagetitle'] = COMPANY;
        $data['msg'] = $msg;
        
        $data['id']=$id;

        $this->load->view('template/header', $data);
        $this->load->view('users/register_profile');
        $this->load->view('template/footer');
    }
    function saveProfile(){
        $functionID = 74; //same id use cos, createAcc  need this func to complete operation
        $this->UsersModel->authenticateMe($functionID);

        $data = $_POST;
        $result= $this->UsersModel->createAccProfile($data);
        if($result==1){
            header('Location:' . base_url('index.php/users/updateProfile/ok/null/new'));
        }else{
            header('Location:' . base_url('index.php/users/updateProfile/fail/null/new'));
        }
    }
    
    function updateUserData() {
        $functionID = 1; //same id use cos, createAcc  need this func to complete operation
        $this->UsersModel->authenticateMe($functionID);
        $user = $_POST['userid'];
        $reqType = $_POST['reqType'];
        $updateVal = $_POST['upVal'];
        echo $this->UsersModel->updateAcc($user, $reqType, $updateVal);
    }

    //CHANGE PERSONAL PASSWORD FOR OWN ACCOUNT
    //CALL CREATE ACCONUT FUNCTIONS
    function updatePassAcc($msg = NULL) {
        $functionID = 31;
        $this->UsersModel->authenticateMe($functionID);
        $data['sess'] = $sess = $this->session->userdata('User');
        $uname = $sess['username'];
        if (!empty($uname) && isset($uname) && !is_null($uname)) {
            $data['userdata'] = $this->UsersModel->getUserList(NULL, NULL, $uname);
        }
        $data['userTypes'] = $this->UsersModel->getUserTypes();

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();

        $data['title'] = 'Change Password Serving Cloud';
        $data['pagetitle'] = 'Change Password Serving Cloud';
        $data['msg'] = $msg;

        $this->load->view('template/header', $data);
        $this->load->view('users/change_pass');
        $this->load->view('template/footer');
    }

    function updateAccPass() {
        $functionID = 31; //same id use cos, createAcc  need this func to complete operation
        $this->UsersModel->authenticateMe($functionID);

        $data = $_POST;
        $this->UsersModel->updateAccPass($data);
    }

    //ALLOW ACCESS TO USER GROUPS
    function allowUserAccess($uid = NULL, $msg = NULL) {
        $functionID = 2;
        $this->UsersModel->authenticateMe($functionID);
        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['authList'] = $this->UsersModel->userAuth();
        $data['authGrant'] = $this->UsersModel->userAuthAlreadyGranted($uid);
        $data['userID'] = $uid;
        $data['userlist'] = $this->UsersModel->getUserList();
        $data['sess'] = $sess = $this->session->userdata('User');

        $data['msg'] = $msg;
        $data['title'] = 'Authenticate Users';
        $this->load->view('template/header', $data);
        $this->load->view('users/authenticate');
        $this->load->view('template/footer');
    }

    //ALLOW ACCESS TO GROUP
    function updateAuth() {
        $functionID = 2;
        $this->UsersModel->authenticateMe($functionID);

        $data = $_POST;
        $this->UsersModel->updateAuthData($data);
    }

    //Create Groups
    function createGrp($gpid = NULL, $msg = NULL) {
        $functionID = 3;
        $this->UsersModel->authenticateMe($functionID);
        $data['title'] = 'Create User Groups - Serving Cloud';
        $data['pagetitle'] = 'Create User Groups - Serving Cloud';
        $data['sess'] = $sess = $this->session->userdata('User');
        $data['msg'] = $msg;
        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();


        $data['grplist'] = $this->UsersModel->getUserGroup();
        if (!empty($gpid) && isset($gpid) && !is_null($gpid) && $gpid != -1) {
            $data['grantdata'] = $this->UsersModel->getUserGroupAccessData($gpid);
            $grantgrpdata = $data['grantgrpdata'] = $this->UsersModel->getUserGroup($gpid);
            $data['functions'] = $this->UsersModel->getMainModuleFunctions($grantgrpdata->modid);
        }
        $this->load->view('template/header', $data);
        $this->load->view('users/accgroup');
        $this->load->view('template/footer');
    }

    function updateGrp() {
        $functionID = 3;
        $this->UsersModel->authenticateMe($functionID);

        $data = $_POST;
        $Inserted = $this->UsersModel->saveAccGroup($data);

        if ($Inserted == 1) {//Inerted 
            header('Location:' . base_url('index.php/users/createGrp/-1/ok'));
        } else {
            header('Location:' . base_url('index.php/users/createGrp/-1/fail'));
        }
    }

    function updateGrpData() {
        $functionID = 3;
        $this->UsersModel->authenticateMe($functionID);
        $user = $_POST['id'];
        $reqType = $_POST['reqType'];
        $updateVal = $_POST['upVal'];
        echo $this->UsersModel->updateGroupData($user, $reqType, $updateVal);
    }

    function authLocation($uid = null, $msg = null) {
        $functionID = 7;
        $this->UsersModel->authenticateMe($functionID);
        $data['title'] = 'Create User Groups - Serving Cloud';
        $data['pagetitle'] = 'Create User Groups - Serving Cloud';
        $data['sess'] = $sess = $this->session->userdata('User');
        $data['msg'] = $msg;
        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();

        $data['userlist'] = $this->UsersModel->getUserList();
        $data['userID'] = $uid;
        if (!empty($uid) && isset($uid) && !is_null($uid)) {
            $data['userdata'] = $this->UsersModel->getUserList(NULL, NULL, $uid);
        }
        $data['locations'] = $this->ItemsModel->getLocationList();
        $data['authGrant'] = $this->UsersModel->userAuthAlreadyGrantedLocation($uid);

        $this->load->view('template/header', $data);
        $this->load->view('users/authlocation');
        $this->load->view('template/footer');
    }

    function updateAuthLocation() {
        $functionID = 2;
        $this->UsersModel->authenticateMe($functionID);

        $data = $_POST;
        $result = $this->UsersModel->updateAuthLocationData($data);

        if ($result == 1) {//Inerted 
            header('Location:' . base_url('index.php/users/authLocation/-1/ok'));
        } else {
            header('Location:' . base_url('index.php/users/authLocation/-1/fail'));
        }
    }

    //get function list for a module
    function getFunctions($fid = null) {
        $modid = $_POST['mid'];
        $result = $this->UsersModel->getMainModuleFunctions($modid);

        $chked = '';
        $class = 'bg-yellow';
        $status = 'Inactive';
        $str = '';
        foreach ($result as $func) {
            $str .= '<tr>';
            $str .= '<td><div class="checkbox"><label><input type="checkbox" name="group[auth][]" value="' . $func['id'] . '" ' . $chked . '/></label></div></td>';
            $str .= '<td><i class="' . $func['fa_icon'] . '"></i> ' . $func['display_name'] . '</td>';
            $str .= '<td>' . $func['comments'] . '</td>';
            $str .= '<td><span class="badge ' . $class . '">' . $status . '</span></td>';
            $str .= '</tr>';
        }
        echo $str;
    }

    //ALLOW ACCESS TO MENUS END-------------------------------------------------
    function authError() {
        $data['title'] = 'Serving Cloud';
        $data['pagetitle'] = 'Serving Cloud';
        $data['sess'] = $sess = $this->session->userdata('User');
        $this->load->view('template/header', $data);
        $this->load->view('errors/authErr');
        $this->load->view('template/footer');
    }

    function orgStructure($gradeID = null, $msg = null) {
        $functionID = 37;
        $this->UsersModel->authenticateMe($functionID);
        $data['title'] = 'Organization Structure';
        $data['pagetitle'] = 'Organization Structure - Serving Cloud';
        $data['sess'] = $sess = $this->session->userdata('User');
        $data['msg'] = $msg;
        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();

        $data['Structure'] = $this->UsersModel->getStructureList();
        if (!empty($gradeID) && isset($gradeID) && !is_null($gradeID) && $gradeID != -1) {
            $data['ReportToData'] = $this->UsersModel->getGradeReportToData($gradeID);
            $data['GradeData'] = $this->UsersModel->getStructureList($gradeID);
        }
        $this->load->view('template/header', $data);
        $this->load->view('users/structure');
        $this->load->view('template/footer');
    }

    function updateOrgStructure() {
        $functionID = 37;
        $this->UsersModel->authenticateMe($functionID);

        $data = $_POST;
        $result = $this->UsersModel->updateOrgStructureData($data);

        if ($result == 1) {//Inerted 
            header('Location:' . base_url('index.php/users/orgStructure/-1/ok'));
        } else {
            header('Location:' . base_url('index.php/users/orgStructure/-1/fail'));
        }
    }

}
