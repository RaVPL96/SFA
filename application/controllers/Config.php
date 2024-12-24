<?php

/*
 * This system Licenced to Raigam Marketing Services (Pvt) Ltd. 
 * Developed By: Lakshitha Pradeep Karunarathna  * 
 * Company: Serving Cloud INC in association with MyOffers.lk  * 
 * Date Started:  October 20, 2017  * 
 */
use PhpOffice\PhpSpreadsheet\IOFactory;

class Config extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('UsersModel');
        $this->load->model('ConfigModule');
    }

    //Load Icons
    function uploadExcel($msg = null) {
        require 'vendor/autoload.php';
        $functionID = 86;
        $this->UsersModel->authenticateMe($functionID);
       // $functionSubID = 1;
        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'Category wise sales Target';
        $data['pagetitle'] = 'Upload Excel';
        $data['msg'] = $msg;
        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);


        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["excel_file"])) {
            $file = $_FILES["excel_file"];

    // Check if the file is an Excel file
            $fileInfo = pathinfo($file["name"]);
            if ($fileInfo["extension"] != "xlsx") {
                echo "Only .xlsx files are allowed.";
                exit();
            }

    // Move the uploaded file to a location on your server
            $targetDir = "excelFiles/";
            $targetFile = $targetDir . basename($file["name"]);

            if (move_uploaded_file($file["tmp_name"], $targetFile)) {
        // Read the Excel file
                $spreadsheet = IOFactory::load($targetFile);

        // Get all sheet names
                $sheetNames = $spreadsheet->getSheetNames();

        // Iterate through each sheet
                $allData = [];
                foreach ($sheetNames as $sheetName) {
                    $sheet = $spreadsheet->getSheetByName($sheetName);

                // Iterate through rows and columns
                    $sheetData = [];
                    foreach ($sheet->getRowIterator() as $row) {
                        $rowData = [];
                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(FALSE);
                        foreach ($cellIterator as $cell) {
                            $rowData[] = $cell->getValue();
                        }
                        $sheetData[] = $rowData;
                    }
                    $allData[$sheetName] = $sheetData;
                }

                $uploadDate = $_POST['requestDate'];
                $range      = $_POST['range'];

                $result = $this->ConfigModule->saveExcel($allData,$uploadDate,$range);

                if ($result == 1) {//Inerted 
            header('Location:' . base_url('config/uploadExcel/ok/-1'));
        } else {
            header('Location:' . base_url('config/uploadExcel/fail/-1'));
        }

        
            } else {
                echo "Failed to upload file.";
            }
        }


        $this->load->view('template/header', $data);
        $this->load->view('master/upload_excel');
        $this->load->view('template/footer');
    }



}