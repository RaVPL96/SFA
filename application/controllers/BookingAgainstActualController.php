<?php

defined("BASEPATH") or exit("No direct script access allowed");

class BookingAgainstActualController extends CI_Controller
{
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -
     *      http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
        $this->load->model("UsersModel");
        $this->load->model("ItemsModel");
        $this->load->model("SurveyModel");
        $this->load->model("MasterModule");
        $this->load->model("HrModule");
        $this->load->model("BookingAgainstActualModule");
        $this->load->model("AreaTargetModule");
    }

    function bookingAgainstActual($msg = null)
    {
        $data["msg"] = $msg;
        $data["sess"] = $sess = $this->session->userdata("User");
        $data["pagetitle"] = "LMA Logins";
        $data["title"] = "LMA";
        $data["AreaID"] = null;
        $data["RangeID"] = null;
        if ($sess["grade_id"] == 4) {
            //ASE
            $data["ASE_Area"] = $this->UsersModel->getAllowedAreas(
                $sess["username"]
            );
            foreach ($data["ASE_Area"] as $area) {
                $areaIDPassed = $area["area_id"];
                $rangeIDPassed = $area["range_id"];
            }
            //$area_id = $data['ASE_Area']->area_id;
            //$data['ASE_Territory'] = $this->MasterModule->getAreaTerritory(null, '001', $data['ASE_Area']->area_id);
        }
        $monthNumber = date("m");
        $monthName = date("F");
        $data["datepickermonth"] = date("Y-m");
        $data["RangeName"] = "";
        $data["categoryID"] = "";
        $data["categoryData"] = null;
        $data["categoryLineData"] = null;
        $data["targetData"] = null;
        $data["saleType"] = "A";

        if (
            !empty($data["sess"]) &&
            isset($data["sess"]) &&
            $data["sess"]["logged_in"]
        ) {
            $data["title"] = COMPANY;
            $data["modules"] = $this->UsersModel->getMainModule();
            $data["menu"] = $this->UsersModel->getMenuList();
            $data["UserList"] = $this->UsersModel->getUserList(null, 1, null);

            $data["AreaList"] = $this->MasterModule->getArea(null, "001", 1);
            $data["RangeList"] = $this->MasterModule->getRange();

            if (!empty($_POST["areaID"]) && isset($_POST["areaID"])) {
                $data["AreaID"] = $_POST["areaID"];
            }
            if (
                !empty($_POST["datepickermonth"]) &&
                isset($_POST["datepickermonth"])
            ) {
                $data["datepickermonth"] = $_POST["datepickermonth"];
            }
            if (!empty($_POST["rangeID"]) && isset($_POST["rangeID"])) {
                $data["RangeID"] = $_POST["rangeID"];
                $data["RangeName"] = $data["RangeID"]; // $this->MasterModule->getRange($data['RangeID'] );
            }
            if (!empty($_POST["saleType"]) && isset($_POST["saleType"])) {
                $data["saleType"] = $_POST["saleType"];
            }
            $data["CategoryList"] = $this->BookingAgainstActualModule->getCategoryList(
                3
            );
            //$data['DailySales'] = $this->BookingAgainstActualModule->getDailySales($data['AreaID'], $data['RangeID']);
            if (
                !empty($data["RangeID"]) &&
                isset($data["RangeID"]) &&
                $data["RangeID"] != null &&
                $data["RangeID"] != -1
            ) {
                $FromDate = date("Y-m-01", strtotime($data["datepickermonth"]));
                if ($data["datepickermonth"] === date("Y-m")) {
                    //this is current month
                    $ToDate = date("Y-m-d");
                } else {
                    $ToDate = date(
                        "Y-m-t",
                        strtotime($data["datepickermonth"])
                    );
                }
                $data[
                    "WorkingDates"
                ] = $this->BookingAgainstActualModule->getCompanyWorkingDays(
                    $FromDate,
                    $ToDate
                );
                $data[
                    "ActualWorkingDates"
                ] = $this->HrModule->getRepActualDayCount($FromDate, $ToDate);

                if ($data["RangeID"] == "D") {
                    if (
                        !empty($_POST["category"]) &&
                        isset($_POST["category"])
                    ) {
                        //category sales requested
                        $data["categoryID"] = $_POST["category"];
                        $data[
                            "categoryLineData"
                        ] = $this->BookingAgainstActualModule->getCategoryList(
                            3,
                            $data["categoryID"]
                        );
                        $data[
                            "getTotalSalesandPc"
                        ] = $this->BookingAgainstActualModule->getTotalSalesandPcCategoryNewDemarcation(
                            $data["AreaID"],
                            $data["RangeID"],
                            $data["datepickermonth"],
                            $data["categoryID"],
                            $data["saleType"]
                        );
                        $data[
                            "getTotalSalesandPcFull"
                        ] = $this->BookingAgainstActualModule->getTotalSalesandPcNewDemarcation(
                            $data["AreaID"],
                            $data["RangeID"],
                            $data["datepickermonth"],
                            $data["saleType"]
                        );
                        $data[
                            "DailySales"
                        ] = $this->BookingAgainstActualModule->getDailySalesCategoryNewDemarcation(
                            $data["AreaID"],
                            $data["RangeID"],
                            $data["datepickermonth"],
                            $data["categoryID"],
                            "value",
                            $data["saleType"]
                        );
                        $data[
                            "DailySalesQty"
                        ] = $this->BookingAgainstActualModule->getDailySalesCategoryNewDemarcation(
                            $data["AreaID"],
                            $data["RangeID"],
                            $data["datepickermonth"],
                            $data["categoryID"],
                            "quantity",
                            $data["saleType"]
                        );
                    } else {
                        //total sale requested
                        // $checkVariable = null;
                        // if(!empty($_POST['variable1']) && isset($_POST['variable1'])){
                        //    $checkVariable = $_POST['variable1'];

                        // $data['targetData'] = $this->AreaTargetModule->getTargetNewDemarcation1(date('Y', strtotime($data['datepickermonth'])), date('m', strtotime($data['datepickermonth'])), $data['AreaID'],$checkVariable);
                        // }else{
                        $data[
                            "targetData"
                        ] = $this->BookingAgainstActualModule->getTargetNewDemarcation(
                            date("Y", strtotime($data["datepickermonth"])),
                            date("m", strtotime($data["datepickermonth"])),
                            $data["AreaID"]
                        );

                        // }
                        $data[
                            "getTotalSalesandPc"
                        ] = $this->BookingAgainstActualModule->getTotalSalesandPcNewDemarcation(
                            $data["AreaID"],
                            $data["RangeID"],
                            $data["datepickermonth"],
                            $data["saleType"]
                        );
                        $data[
                            "DailySales"
                        ] = $this->BookingAgainstActualModule->getDailySalesNewDemarcation(
                            $data["AreaID"],
                            $data["RangeID"],
                            $data["datepickermonth"],
                            $data["saleType"]
                        );
                    }
                    //$data['DailySalesD'] = $this->BookingAgainstActualModule->getDItemSales($data['AreaID']);
                } else {
                    // C Range

                    if (
                        !empty($_POST["category"]) &&
                        isset($_POST["category"])
                    ) {
                        //category sales requested

                        $data["categoryID"] = $_POST["category"];
                        $data[
                            "categoryLineData"
                        ] = $this->BookingAgainstActualModule->getCategoryList(
                            3,
                            $data["categoryID"]
                        );
                        $data[
                            "getTotalSalesandPc"
                        ] = $this->BookingAgainstActualModule->getTotalSalesandPcCategoryNewDemarcation(
                            $data["AreaID"],
                            $data["RangeID"],
                            $data["datepickermonth"],
                            $data["categoryID"],
                            $data["saleType"]
                        );
                        $data[
                            "getTotalSalesandPcFull"
                        ] = $this->BookingAgainstActualModule->getTotalSalesandPcNewDemarcation(
                            $data["AreaID"],
                            $data["RangeID"],
                            $data["datepickermonth"],
                            $data["saleType"]
                        );
                        $data[
                            "DailySales"
                        ] = $this->BookingAgainstActualModule->getDailySalesCategoryNewDemarcation(
                            $data["AreaID"],
                            $data["RangeID"],
                            $data["datepickermonth"],
                            $data["categoryID"],
                            "value",
                            $data["saleType"]
                        );
                        $data[
                            "DailySalesQty"
                        ] = $this->BookingAgainstActualModule->getDailySalesCategoryNewDemarcation(
                            $data["AreaID"],
                            $data["RangeID"],
                            $data["datepickermonth"],
                            $data["categoryID"],
                            "quantity",
                            $data["saleType"]
                        );

                    } else {
                        // $checkVariable = null;
                        // if(!empty($_POST['variable1']) && isset($_POST['variable1'])){
                        //    $checkVariable = $_POST['variable1'];

                        // $data['targetData'] = $this->AreaTargetModule->getTargetNewDemarcation1(date('Y', strtotime($data['datepickermonth'])), date('m', strtotime($data['datepickermonth'])), $data['AreaID'],$checkVariable);
                        // }else{
                        $data[
                            "targetData"
                        ] = $this->BookingAgainstActualModule->getTargetNewDemarcation(
                            date("Y", strtotime($data["datepickermonth"])),
                            date("m", strtotime($data["datepickermonth"])),
                            $data["AreaID"]
                        );

                        // }

                        // $data['targetData'] = $this->BookingAgainstActualModule->getTargetNewDemarcation(date('Y', strtotime($data['datepickermonth'])), date('m', strtotime($data['datepickermonth'])), $data['AreaID']);
                        $data[
                            "getTotalSalesandPc"
                        ] = $this->BookingAgainstActualModule->getTotalSalesandPcNewDemarcation(
                            $data["AreaID"],
                            $data["RangeID"],
                            $data["datepickermonth"],
                            $data["saleType"]
                        );
                        $data[
                            "DailySales"
                        ] = $this->BookingAgainstActualModule->getDailySalesNewDemarcation(
                            $data["AreaID"],
                            $data["RangeID"],
                            $data["datepickermonth"],
                            $data["saleType"]
                        );

                        
                    } //$data['DailySalesNenaposha'] = $this->BookingAgainstActualModule->getNenaposhaItemSales($data['AreaID']);
                    //$data['DailySalesDB'] = $this->BookingAgainstActualModule->getDbItemSales($data['AreaID']);
                    //$data['DailySalesSoya'] = $this->BookingAgainstActualModule->getSoyaItemSales($data['AreaID']);
                }
            } else {
                /* $data['DailySalesD'] = $this->BookingAgainstActualModule->getDItemSales($data['AreaID']);

                  $data['DailySalesNenaposha'] = $this->BookingAgainstActualModule->getNenaposhaItemSales($data['AreaID']);
                  $data['DailySalesDB'] = $this->BookingAgainstActualModule->getDbItemSales($data['AreaID']);
                  $data['DailySalesSoya'] = $this->BookingAgainstActualModule->getSoyaItemSales($data['AreaID']); */
            }
            $this->load->view("template/header", $data);
            $this->load->view("bookingAgainstActual");
            $this->load->view("template/footer");
        } else {
            header("location:" . base_url("index.php/users/index"));
        }
    }
}

?>
