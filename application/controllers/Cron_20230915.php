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
    function addOpenStock($ag_cd,$date_posted,$range_name){//pass old agency code
        echo $this->CronModule->updateOpeningStock($ag_cd,$date_posted,$range_name);
    }
    //add good return stock sent back to head office
    function addGoodReturn($ag_cd,$date_posted){//pass old agency code
        echo $this->CronModule->updateGoodReturn($ag_cd,$date_posted);
    }
    //add market return stock sent back to head office
    function addMarketReturn($ag_cd,$date_posted){//pass old agency code
        echo $this->CronModule->updateMarketReturn($ag_cd,$date_posted);
    }
    //add total sales after stock taking
    function addSalesGiven($ag_cd,$date_posted){//pass old agency code
        echo $this->CronModule->updateSalesStock($ag_cd,$date_posted);
    }
    //add total receieved from PO head office 
    function addGrnReceive($ag_cd,$date_posted){//pass old agency code
        echo $this->CronModule->updateHeadOfficeInvoiceStock($ag_cd,$date_posted);
    }
    //add total pending to receive from PO head office 
    function addGrnPendingReceive($ag_cd,$date_posted){//pass old agency code
        echo $this->CronModule->updateHeadOfficeInvoiceStockPending($ag_cd,$date_posted);
    }
    
    
    //this is for cron job of stock recalculation
    function cronRecalStock(){
        $this->CronModule->getAgencyStocktoRecal();        
    }
}
 ?>