<?php
class Survey extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('UsersModel');
        $this->load->model('ItemsModel');
        $this->load->model('RouteModel');
        $this->load->model('SurveyModel');
    }

    /*function listAll($lat, $lang, $user, $battery) {
        $data['lat'] = $lat;
        $data['lang'] = $lang;
        $data['user'] = $user;
        $data['battery'] = $battery;
        $this->load->view('template/header', $data);
        $this->load->view('survey/index_telees');
        $this->load->view('template/footer');
    }

    function save() {
        $data = $_GET;
        $result = $this->UsersModel->saveSurvey($data);
        $data['SaveData']=$data;
        if ($result == 1) {
            $this->load->view('template/header', $data);
            $this->load->view('survey/ok');
            $this->load->view('template/footer');
        } else {
            $this->load->view('template/header', $data);
            $this->load->view('survey/fail');
            $this->load->view('template/footer');
        }
    }*/
    //nenaposha
    /*function listAll($lat, $lang, $user, $battery) {
        $data['lat'] = $lat;
        $data['lang'] = $lang;
        $data['user'] = $user;
        $data['battery'] = $battery;
        $this->load->view('template/header', $data);
        $this->load->view('survey/index_nenaposha');
        $this->load->view('template/footer');
    }*/
    //nenaposha 2 october 5
    /*function listAll($lat, $lang, $user, $battery) {
        $data['lat'] = $lat;
        $data['lang'] = $lang;
        $data['user'] = $user;
        $data['battery'] = $battery;
        $this->load->view('template/header', $data);
        $this->load->view('survey/index_nenaposha_october');
        $this->load->view('template/footer');
    }*/
    /*
    //washing powder
    function listAll($lat, $lang, $user, $battery) {
        $data['lat'] = $lat;
        $data['lang'] = $lang;
        $data['user'] = $user;
        $data['battery'] = $battery;
        $this->load->view('template/header', $data);
        $this->load->view('survey/index_washing_powder');
        $this->load->view('template/footer');
    }
    */
    /*
     * //Detergent size survey-2023 01 17
    function listAll($lat, $lang, $user, $battery) {
        $data['lat'] = $lat;
        $data['lang'] = $lang;
        $data['user'] = $user;
        $data['battery'] = $battery;
        $this->load->view('template/header', $data);
        $this->load->view('survey/index_detergent_size');
        $this->load->view('template/footer');
    }
    */
    
    //Radio Channel Survey-2023 02 17
    /*function listAll($lat, $lang, $user, $battery) {
        $data['lat'] = $lat;
        $data['lang'] = $lang;
        $data['user'] = $user;
        $data['battery'] = $battery;
        $this->load->view('template/header', $data);
        $this->load->view('survey/index_radio');
        $this->load->view('template/footer');
    }*/
    /*
    //Raigam telees 2023  202302245-20230324
    function listAll($lat, $lang, $user, $battery) {
        $data['lat'] = $lat;
        $data['lang'] = $lang;
        $data['user'] = $user;
        $data['battery'] = $battery;
        $this->load->view('template/header', $data);
        //$this->load->view('survey/index_telees_2023');
        
        if(substr($user, -1)=='c'){
            $this->load->view('survey/index_nenaposha_march_2023');
        }else{
            //$this->load->view('survey/index_telees_2023');
        }
        
        $this->load->view('template/footer');
    }
    */
    /*function save() {//telees 2023
        $data = $_GET;
        $result = $this->UsersModel->saveSurvey($data);
        $data['SaveData']=$data;
        if ($result == 1) {
            $this->load->view('template/header', $data);
            $this->load->view('survey/ok');
            $this->load->view('template/footer');
        } else {
            $this->load->view('template/header', $data);
            $this->load->view('survey/fail');
            $this->load->view('template/footer');
        }
    }
    
    function save() {
        $data = $_GET;
        $result = $this->UsersModel->saveSurvey_nenaposha($data);
        $data['SaveData']=$data;
        if ($result == 1) {
            $this->load->view('template/header', $data);
            $this->load->view('survey/ok');
            $this->load->view('template/footer');
        } else {
            $this->load->view('template/header', $data);
            $this->load->view('survey/fail');
            $this->load->view('template/footer');
        }
    }
     */
    /*
    function listAll($lat, $lang, $user, $battery) {
        $data['lat'] = $lat;
        $data['lang'] = $lang;
        $data['user'] = $user;
        $data['battery'] = $battery;
        $this->load->view('template/header', $data);
        //$this->load->view('survey/index_telees_2023');
         
        $this->load->view('survey/index_coffee_april_2023');
        $this->load->view('template/footer');
    }*/
    //pasta survey 2023 
    /*function listAll($lat, $lang, $user, $battery) {
        $data['lat'] = $lat;
        $data['lang'] = $lang;
        $data['user'] = $user;
        $data['battery'] = $battery;
        $this->load->view('template/header', $data);
        //$this->load->view('survey/index_telees_2023');
        $this->load->view('survey/index_pasta_may_2023');
        $this->load->view('template/footer');
    }*/
    
    /*
    function save() {
        $data = $_GET;
        //print_r($data);die();
        $result = $this->UsersModel->saveSurvey($data);
        $data['SaveData']=$data;
        if ($result == 1) {
            $this->load->view('template/header', $data);
            $this->load->view('survey/ok');
            $this->load->view('template/footer');
        } else {
            $this->load->view('template/header', $data);
            $this->load->view('survey/fail');
            $this->load->view('template/footer');
        }
    }
    function listAll($lat, $lang, $user, $battery) {
        $data['lat'] = $lat;
        $data['lang'] = $lang;
        $data['user'] = $user;
        $data['battery'] = $battery;
        $this->load->view('template/header', $data);
        //$this->load->view('survey/index_telees_2023');
        $this->load->view('survey/index_noodles_may_2023');
        $this->load->view('template/footer');
    }
    */
    function listAll($lat, $lang, $user, $battery) {
        $data['lat'] = $lat;
        $data['lang'] = $lang;
        $data['user'] = $user;
        $data['battery'] = $battery;
        $data['routeList'] = $this->RouteModel->getRouteList($user);
        $data['shopList'] = $this->RouteModel->getRouteShopList($user);
        $this->load->view('template/header', $data); 
        if(substr($user, -1)=='c' || $user=='gampaha'){
            $this->load->view('survey/index_nenaposha_sep_2023');
        }else{
            $this->load->view('survey/index_aaryaplus_aug_2023');
        }
        
        $this->load->view('template/footer');
    }
    function save_ap(){
        $data = $_GET;
        //print_r($data);die();
        $result = $this->SurveyModel->saveSurvey($data);
        $data['SaveData']=$data;
        if ($result == 1) {
            $this->load->view('template/header', $data);
            $this->load->view('survey/ok');
            $this->load->view('template/footer');
        } else {
            $this->load->view('template/header', $data);
            $this->load->view('survey/fail');
            $this->load->view('template/footer');
        }
    }
    function saveSurveyNP(){
        $data = $_GET;
        //print_r($data);die();
        $result = $this->SurveyModel->saveSurveyNP($data);
        $data['SaveData']=$data;
        if ($result == 1) {
            $this->load->view('template/header', $data);
            $this->load->view('survey/ok');
            $this->load->view('template/footer');
        } else {
            $this->load->view('template/header', $data);
            $this->load->view('survey/fail');
            $this->load->view('template/footer');
        }
    }
}
