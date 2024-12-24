<?php

/* 


 * This system Licenced to Raigam Marketing Services (Pvt) Ltd. 

 * Developed By: Lakshitha Pradeep Karunarathna  * 

 * Company: Serving Cloud INC in association with MyOffers.lk  * 

 * Date Started:  October 20, 2017  * 


 */ 
class CommonModule extends CI_Model {

    function __construct() {
        parent::__construct(); 
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('UsersModel');
        $this->load->model('ItemsModel');
        $this->load->model('SurveyModel');
        $this->load->model('MasterModule');
        $this->load->model('HrModule');
        $this->load->model('SalesreportModule');
    }
    function getTitle($reportName,$channelID=NULL,$areaID=NULL,$territoryID=NULL,$rangeID=NULL,$billingType=NULL,$FromDate=NULL, $ToDate=NULL){
        $str='<h3>'.$reportName.'</h3>';
        if(!empty($channelID) && isset($channelID) && $channelID!=NULL){
            $r=$this->MasterModule->getChannel($channelID);
            if(!empty($r) && isset($r)){
                $str .= ' '.$r->channel_name;
            }
        } 
        if(!empty($areaID) && isset($areaID) && $areaID!=NULL){
            $r=$this->MasterModule->getArea($areaID);
            if(!empty($r) && isset($r)){
                $str .= ' - '.$r->area_name. ' Area ';
            }
        }else{
            $str .= ' - All Area ';
        }
        
        if(!empty($territoryID) && isset($territoryID) && $territoryID!=NULL){
            $r=$this->MasterModule->getTerritory($territoryID);
            if(!empty($r) && isset($r)){
                $str .= ' - '.$r->territory_name. ' Territory ';
            }
        }else{
            $str .= ' - All Territory ';
        }
        
        if(!empty($rangeID) && isset($rangeID) && $rangeID!=NULL){
            $r=$this->MasterModule->getRange($rangeID);
            if(!empty($r) && isset($r)){
                $str .= ' - '.$r->range_name. ' Range ';
            }
        }else{
            $str .= ' - All Range ';
        }
        
        if(!empty($billingType) && isset($billingType) && $billingType!=NULL){
            $str .= ' - '.$billingType. ' Sales ';             
        }else{
            $str .= ' - All Sales ';
        }
        
        if(!empty($FromDate) && isset($FromDate) && $FromDate!=NULL){
            $str .= '<br>Date: '.$FromDate. ' ';             
        }else{
            $str .= ' ';
        }
        if(!empty($ToDate) && isset($ToDate) && $ToDate!=NULL){
            $str .= ' to '.$ToDate. ' ';             
        }else{
            $str .= ' ';
        }
        return $str;
    }
}
