<?php

/*
 * This system Licenced to Raigam Marketing Services (Pvt) Ltd. 
 * Developed By: Lakshitha Pradeep Karunarathna  * 
 * Company: Serving Cloud INC in association with MyOffers.lk  * 
 * Date Started:  October 20, 2017  * 
 */

class Cron extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('UsersModel');
        $this->load->model('CronModule');
        $this->load->model('MasterModule');
        $this->load->model('HrModule');
    }

    //add opening stock to agency wherehouse 
    function addOpenStock($ag_cd, $date_posted, $range_name) {//pass old agency code
        echo $this->CronModule->updateOpeningStock($ag_cd, $date_posted, $range_name);
    }

    //add good return stock sent back to head office
    function addGoodReturn($ag_cd, $date_posted) {//pass old agency code
        echo $this->CronModule->updateGoodReturn($ag_cd, $date_posted);
    }

    //add market return stock sent back to head office
    function addMarketReturn($ag_cd, $date_posted) {//pass old agency code
        echo $this->CronModule->updateMarketReturn($ag_cd, $date_posted);
    }

    //add total sales after stock taking
    function addSalesGiven($ag_cd, $date_posted) {//pass old agency code
        echo $this->CronModule->updateSalesStock($ag_cd, $date_posted);
    }

    //add total receieved from PO head office 
    function addGrnReceive($ag_cd, $date_posted) {//pass old agency code
        echo $this->CronModule->updateHeadOfficeInvoiceStock($ag_cd, $date_posted);
    }

    //add total pending to receive from PO head office 
    function addGrnPendingReceive($ag_cd, $date_posted) {//pass old agency code
        echo $this->CronModule->updateHeadOfficeInvoiceStockPending($ag_cd, $date_posted);
    }

    //this is for cron job of stock recalculation
    function cronRecalStock() {
        $this->CronModule->getAgencyStocktoRecal();
    }

    //AUTO BACKUP DATABASE
    function autoBak(){
        $emailaddress = "lakshitha@raigam.lk";
        $host = "localhost"; // database host
        $dbuser = "raigam_2022"; // database user name
        $dbpswd = "Sui_KE_5cr^f"; // database password
        $mysqldb = "raigam_db"; // name of database 
        $path = "/home/raigam/public_html/dbbackup"; // full server path to the directory where you want the backup files (no trailing slash)
// modify the above values to fit your environment
        $filename = $path . "/backup" . date("Y_m_d_H_i_s") . ".sql.gz";
        if (file_exists($filename))
            unlink($filename);
        echo $filename;
        //system("mysqldump --user=$dbuser --password=$dbpswd --host=$host $mysqldb > $filename", $result);
        
        system( "mysqldump --user=$dbuser --password=$dbpswd --host=$host $mysqldb | gzip > $filename",$result); 
        $size = 000; //filesize(dir($path)."/backup" . date("d") . ".sql");
        switch ($size) {
            case ($size >= 1048576): $size = round($size / 1048576) . " MB";
                break;
            case ($size >= 1024): $size = round($size / 1024) . " KB";
                break;
            default: $size = $size . " bytes";
                break;
        }
        $message = "The database backup for " . $mysqldb . " has been run.\n\n";
        $message .= "The return code was: " . $result . "\n\n";
        $message .= "The file path is: " . $filename . "\n\n";
        $message .= "Size of the backup: " . $size . "\n\n";
        $message .= "Server time of the backup: " . date(" F d h:ia") . "\n\n";
        mail($emailaddress, "Database Backup Message", $message, "From: Website <>");
    }
    
    //create image in outlet table
    function cronGenImage(){
        echo date("Y_m_d_H_i_s");
        echo $this->CronModule->createImage();
    }
    //create image in outlet table
    function cronGenImageShopUpdate(){
        echo date("Y_m_d_H_i_s");
        echo $this->CronModule->createImageShopUpdate();
    }
    //reset blob in shop update table
    function cronResetImageBlobShopUpdate(){
        echo date("Y_m_d_H_i_s");
        echo $this->CronModule->resetBlobShopUpdate();
    }
    //create default invoice for all agency - other wise area will get lost from the dashboard
    function cronCreateDefaultInvoice(){
        echo $this->CronModule->updateDefaultInvoice();
    }
    
    //borella maligawatta sales
    function totalSalesBorellaMaligawatta(){
        echo $this->CronModule->cronBorellaMaligawatta();
    }
}

?>