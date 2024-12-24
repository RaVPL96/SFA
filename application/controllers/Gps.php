<?php

/*


 * This system Licenced to Raigam Marketing Services (Pvt) Ltd. 

 * Developed By: Lakshitha Pradeep Karunarathna  * 

 * Company: Serving Cloud INC in association with MyOffers.lk  * 

 * Date Started:  October 20, 2017  * 


 */

class Gps extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('UsersModel');
        $this->load->model('MasterModule');
        $this->load->model('GpsModule');
    }

    function getGpsTimeList() {
        $str='<option value=""> -- Select Sales Rep -- </option>';
        if ((!empty($_GET['gp_date']) && isset($_GET['gp_date']) && $_GET['gp_date'] != null) && !empty($_GET['user']) && isset($_GET['user']) && $_GET['user'] != null) {
            $gp_date=$_GET['gp_date'];
            $user=$_GET['user'];
            $TimeList=$this->GpsModule->getGpsTimeLog($user, $gp_date);
            if(!empty($TimeList) && isset($TimeList)){
                foreach ($TimeList as $v) {
                    $str=$str. '<option value="'.$v['gp_time'].'">'.$v['gp_time'].'</option>';
                }
            }
        }
        echo $str;
    }

}
