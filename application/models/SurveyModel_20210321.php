<?php
class SurveyModel extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->database();
        //$this->mssql = $this->load->database('MSSQL', TRUE); 
        $this->load->helper('url');
    }
    
    function getSurveySummery($dateFrom, $dateTo,$areaID=null,$territoryID=null,$rangeID=null) {
                                  
        $this->db->select('`tbl_mst_area`.`area_name`,`tbl_mst_territory`.`territory_name`,`tbl_mst_range`.`range_name`, `tbl_trans_survey_result`.`audit_user`, `tbl_trans_survey_result`.`survey_date`, COUNT(`audit_user`) AS `total_surveys`, COUNT(IF(question_2=\'Male\',unique_id,null)) AS `male_count` , COUNT(IF(question_2=\'Female\',unique_id,null)) AS `female_count` ');
        $this->db->from('`tbl_trans_survey_result`');
        $this->db->join('`tbl_mst_rep_link_territory_agent`','`tbl_trans_survey_result`.`audit_user`=`tbl_mst_rep_link_territory_agent`.`rep_username`','RIGHT');
        $this->db->join('`tbl_mst_territory`','`tbl_mst_rep_link_territory_agent`.`territory_id`=`tbl_mst_territory`.`id`','LEFT');
        $this->db->join('`tbl_mst_area_link_territory`','`tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id`','LEFT');
        $this->db->join('`tbl_mst_area`','`tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id`','LEFT');
        $this->db->join('`tbl_mst_range`','`tbl_mst_rep_link_territory_agent`.`range_id`=`tbl_mst_range`.`id`','INNER');
        
        $this->db->where(array('`survey_date`>=' => $dateFrom, '`survey_date`<=' => $dateTo));
        if(!empty($areaID) && isset($areaID) && $areaID!=null){
            $this->db->where('`tbl_mst_area`.`id`' ,$areaID);
        }
        if(!empty($territoryID) && isset($territoryID) && $territoryID!=null){
            $this->db->where('`tbl_mst_territory`.`id`' ,$territoryID);
        }
        if(!empty($rangeID) && isset($rangeID) && $rangeID!=null){
            $this->db->where('`tbl_mst_range`.`id`' ,$rangeID);
        }                     
        $this->db->group_by('`tbl_mst_area`.`area_name`, `tbl_mst_territory`.`territory_name`, `tbl_mst_range`.`range_name`,`tbl_trans_survey_result`.`audit_user`');
        $this->db->order_by('`tbl_mst_area`.`area_name`,`tbl_mst_range`.`range_name`,`tbl_mst_territory`.`territory_name`');
        $query = $this->db->get();
        $result = $query->result_array();
        //echo $this->db->last_query();
        return $result;
    }
    
    
    function getSurveyAreaList($dateFrom, $dateTo,$areaID=null,$territoryID=null,$rangeID=null) {
        $this->db->select('`tbl_mst_area`.`area_name`,`tbl_mst_territory`.`territory_name`,`tbl_mst_range`.`range_name`, `tbl_mst_rep_link_territory_agent`.`rep_username`');
        $this->db->from('`tbl_mst_rep_link_territory_agent`');
        //$this->db->join('`tbl_mst_rep_link_territory_agent`','`tbl_trans_survey_result`.`audit_user`=`tbl_mst_rep_link_territory_agent`.`rep_username`','RIGHT');
        $this->db->join('`tbl_mst_territory`','`tbl_mst_rep_link_territory_agent`.`territory_id`=`tbl_mst_territory`.`id`','LEFT');
        $this->db->join('`tbl_mst_area_link_territory`','`tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id`','LEFT');
        $this->db->join('`tbl_mst_area`','`tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id`','LEFT');
        $this->db->join('`tbl_mst_range`','`tbl_mst_rep_link_territory_agent`.`range_id`=`tbl_mst_range`.`id`','INNER');
        
        if(!empty($areaID) && isset($areaID) && $areaID!=null){
            $this->db->where('`tbl_mst_area`.`id`' ,$areaID);
        }
        if(!empty($territoryID) && isset($territoryID) && $territoryID!=null){
            $this->db->where('`tbl_mst_territory`.`id`' ,$territoryID);
        }
        if(!empty($rangeID) && isset($rangeID) && $rangeID!=null){
            $this->db->where('`tbl_mst_range`.`id`' ,$rangeID);
        } 
        $this->db->order_by('`tbl_mst_area`.`area_name`,`tbl_mst_range`.`range_name`,`tbl_mst_territory`.`territory_name`');
        $query = $this->db->get();
        $result = $query->result_array();
        //echo $this->db->last_query();
        return $result;
    }
}

