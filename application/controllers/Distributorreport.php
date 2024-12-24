<?php

class Distributorreport extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('UsersModel');
        $this->load->model('ItemsModel');
        $this->load->model('MasterModule');
        $this->load->model('DistributorReportModule');
    }

    /*
     * AGENCT DASHBOARD DATA
     *      */

    //INDEX PAGE
    function salesReport($msg = null) {
        $functionID = 87;
        $this->UsersModel->authenticateMe($functionID);
        $data['msg'] = $msg;
        $data['sess'] = $sess = $this->session->userdata('User');
        $data['pagetitle'] = 'Raigam Agent Dashboard';
        $data['title'] = 'Raigam SFA';

        if ($sess['grade_id'] == 8 || $sess['urole'] == 3) {
            //admin or agent
            $data['modules'] = $this->UsersModel->getMainModule();
            $data['menu'] = $this->UsersModel->getMenuList();
            $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);
            $this->load->view('template/header', $data);
            $this->load->view('secondary/distributor/report/sales/index');
            $this->load->view('template/footer');
        } else {
            header('Location:' . base_url('index.php/users/index/fail'));
        }
    }

    function combinedSales() {
        $functionID = 87;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 73;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);
        $data['sess'] = $sess = $this->session->userdata('User');
        if ($sess['grade_id'] == 8 || $sess['urole'] == 3) {
            $data['pagetitle'] = 'Raigam Agent Dashboard';
            $data['title'] = 'Raigam SFA';
            //admin or agent
            $data['modules'] = $this->UsersModel->getMainModule();
            $data['menu'] = $this->UsersModel->getMenuList();
            $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);
            $dateFrom = date('Y-m-01');
            $dateTo = date('Y-m-d');
            $data['totalCombinedSales'] = $this->DistributorReportModule->getDailyPcTotals(null, null, null, null, null, $dateFrom, $dateTo, 'summery_territory', $channel_id = 1, $sess['username']);

            $this->load->view('template/header', $data);
            $this->load->view('secondary/distributor/report/sales/combinedSales');
            $this->load->view('template/footer');
        } else {
            header('Location:' . base_url('index.php/users/index/fail'));
        }
    }

    function inventryReports() {
        $functionID = 88;
        $this->UsersModel->authenticateMe($functionID);
        //$functionSubID = 73;
        //$this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);
        $data['sess'] = $sess = $this->session->userdata('User');
        if ($sess['grade_id'] == 8 || $sess['urole'] == 3) {
            $data['pagetitle'] = 'Raigam Agent Dashboard';
            $data['title'] = 'Raigam SFA';
            //admin or agent
            $data['modules'] = $this->UsersModel->getMainModule();
            $data['menu'] = $this->UsersModel->getMenuList();
            $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);
            $dateFrom = date('Y-m-01');
            $dateTo = date('Y-m-d');
            if (!empty($_POST['rangeID']) && isset($_POST['rangeID'])) {
                if (!empty($_POST['category']) && isset($_POST['category'])) {
                    $data['categoryID'] = $category = $_POST['category'];
                }
                if ($category > 0) {
                    $data['StockData'] = $this->DistributorReportModule->getStockDataCommonCategory($area_id, $territoryID, $rangeID, $FromDate, $ToDate, 'detail', $category);
                    $data['StockDataSum'] = $this->DistributorReportModule->getStockDataCommonCategory($area_id, $territoryID, $rangeID, $FromDate, $ToDate, 'summery', $category);
                } else {
                    $data['StockData'] = $this->DistributorReportModule->getStockDataCommon($area_id, $territoryID, $rangeID, $FromDate, $ToDate, 'summery');
                }
            }
            $this->load->view('template/header', $data);
            $this->load->view('secondary/distributor/report/sales/current_stock_all');
            $this->load->view('template/footer');
        } else {
            header('Location:' . base_url('index.php/users/index/fail'));
        }
    }

}
