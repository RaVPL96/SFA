<?php

class SurveyModel extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        //$this->mssql = $this->load->database('MSSQL', TRUE); 
        $this->load->helper('url');
    }

    function getSurveySummery($dateFrom, $dateTo, $areaID = null, $territoryID = null, $rangeID = null,$surveyID=1) {

        $this->db->select('`tbl_mst_area`.`area_name`,`tbl_mst_territory`.`territory_name`,`tbl_mst_range`.`range_name`, `tbl_trans_survey_result`.`audit_user`, `tbl_trans_survey_result`.`survey_date`, COUNT(`audit_user`) AS `total_surveys`, COUNT(IF(question_2=\'Male\',unique_id,null)) AS `male_count` , COUNT(IF(question_2=\'Female\',unique_id,null)) AS `female_count`,`question_7`, `question_8`, `question_9`, `question_10`, `question_11`, `question_12`, `question_13`, `question_14`, `question_15`, `question_16`, `question_17`, `question_18`, `question_19`, `question_20`, `question_21`, `question_22`, `question_23`, `question_24`, `question_25`, `question_26`, `question_27`, `question_28`, `question_29`, `question_30`, `question_31` ');
        $this->db->from('`tbl_trans_survey_result`');
        $this->db->join('`tbl_mst_rep_link_territory_agent`', '`tbl_trans_survey_result`.`audit_user`=`tbl_mst_rep_link_territory_agent`.`rep_username`', 'RIGHT');
        $this->db->join('`tbl_mst_territory`', '`tbl_mst_rep_link_territory_agent`.`territory_id`=`tbl_mst_territory`.`id`', 'LEFT');
        $this->db->join('`tbl_mst_area_link_territory`', '`tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id`', 'LEFT');
        $this->db->join('`tbl_mst_area`', '`tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id`', 'LEFT');
        $this->db->join('`tbl_mst_range`', '`tbl_mst_rep_link_territory_agent`.`range_id`=`tbl_mst_range`.`id`', 'INNER');
        $this->db->where('tbl_trans_survey_result.`survey_id`',$surveyID);
            
        $this->db->where(array('`survey_date`>=' => $dateFrom, '`survey_date`<=' => $dateTo));
        if (!empty($areaID) && isset($areaID) && $areaID != null) {
            $this->db->where('`tbl_mst_area`.`id`', $areaID);
        }
        if (!empty($territoryID) && isset($territoryID) && $territoryID != null) {
            $this->db->where('`tbl_mst_territory`.`id`', $territoryID);
        }
        if (!empty($rangeID) && isset($rangeID) && $rangeID != null) {
            $this->db->where('`tbl_mst_range`.`id`', $rangeID);
        }
        $this->db->group_by('`tbl_mst_area`.`area_name`, `tbl_mst_territory`.`territory_name`, `tbl_mst_range`.`range_name`,`tbl_trans_survey_result`.`audit_user`');
        $this->db->order_by('`tbl_mst_area`.`area_name`,`tbl_mst_range`.`range_name`,`tbl_mst_territory`.`territory_name`');
        $query = $this->db->get();
        $result = $query->result_array();
        //echo $this->db->last_query();
        return $result;
    }

    function getSurveyAreaList($dateFrom, $dateTo, $areaID = null, $territoryID = null, $rangeID = null) {
        $this->db->select('`tbl_mst_area`.`area_name`,`tbl_mst_territory`.`territory_name`,`tbl_mst_range`.`range_name`, `tbl_mst_rep_link_territory_agent`.`rep_username`');
        $this->db->from('`tbl_mst_rep_link_territory_agent`');
        //$this->db->join('`tbl_mst_rep_link_territory_agent`','`tbl_trans_survey_result`.`audit_user`=`tbl_mst_rep_link_territory_agent`.`rep_username`','RIGHT');
        $this->db->join('`tbl_mst_territory`', '`tbl_mst_rep_link_territory_agent`.`territory_id`=`tbl_mst_territory`.`id`', 'LEFT');
        $this->db->join('`tbl_mst_area_link_territory`', '`tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id`', 'LEFT');
        $this->db->join('`tbl_mst_area`', '`tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id`', 'LEFT');
        $this->db->join('`tbl_mst_range`', '`tbl_mst_rep_link_territory_agent`.`range_id`=`tbl_mst_range`.`id`', 'INNER');

        if (!empty($areaID) && isset($areaID) && $areaID != null) {
            $this->db->where('`tbl_mst_area`.`id`', $areaID);
        }
        if (!empty($territoryID) && isset($territoryID) && $territoryID != null) {
            $this->db->where('`tbl_mst_territory`.`id`', $territoryID);
        }
        if (!empty($rangeID) && isset($rangeID) && $rangeID != null) {
            $this->db->where('`tbl_mst_range`.`id`', $rangeID);
        }
        $this->db->order_by('`tbl_mst_area`.`area_name`,`tbl_mst_range`.`range_name`,`tbl_mst_territory`.`territory_name`');
        $query = $this->db->get();
        $result = $query->result_array();
        //echo $this->db->last_query();
        return $result;
    }

    function getTotal($survey_ID=1) {
        $query=$this->db->query('SELECT tbl_mst_area.area_name,tbl_mst_territory.territory_name,audit_user,COUNT(tbl_trans_survey_result.id) as samples FROM `tbl_trans_survey_result` 
INNER JOIN tbl_mst_rep_link_territory_agent ON tbl_trans_survey_result.audit_user=tbl_mst_rep_link_territory_agent.rep_username 
INNER JOIN tbl_mst_territory ON tbl_mst_rep_link_territory_agent.territory_id=tbl_mst_territory.id
INNER JOIN tbl_mst_area_link_territory ON tbl_mst_territory.id=tbl_mst_area_link_territory.territory_id
INNER JOIN tbl_mst_area ON tbl_mst_area_link_territory.area_id=tbl_mst_area.id
WHERE survey_id='.$survey_ID.'
GROUP BY audit_user ORDER by samples desc');
        
        //$query = $this->db->get();
        $result = $query->result_array();
        //echo $this->db->last_query();
        return $result;
    }
    
    
    function getSurveyDetails($dateFrom=null, $dateTo=null, $areaID = null, $territoryID = null, $rangeID = null,$survey_id=1) {

        $this->db->select('`tbl_mst_area`.`area_name`,`tbl_mst_territory`.`territory_name`,`tbl_mst_range`.`range_name`, `tbl_trans_survey_result`.`audit_user`, `tbl_trans_survey_result`.`survey_date`, `tbl_trans_survey_result`.`survey_time`,`question_1`, `question_2`, `question_3`, `question_4`, `question_5`, `question_6`,`question_7`, `question_8`, `question_9`, `question_10`, `question_11`, `question_12`, `question_13`, `question_14`, `question_15`, `question_16`, `question_17`, `question_18`, `question_19`, `question_20`, `question_21`, `question_22`, `question_23`, `question_24`, `question_25`, `question_26`, `question_27`, `question_28`, `question_29`, `question_30`, `question_31`, `question_32`, `question_33` , `question_34`, `question_35`, `question_36`, `question_37`, `question_38`, `question_39`, `question_40`, `question_41`, `question_42`, `question_43`, `question_44`, `question_45`, `question_46`, `question_47`, `question_48`, `question_49`, `question_50`, `question_51`, `question_52`, `question_53`, `question_54`, `question_55`, `question_56`, `question_57`, `question_58`, `question_59`, `question_60`, `question_61`, `question_62`, `question_63`, `question_64`, `question_65`');
        $this->db->from('`tbl_trans_survey_result`');
        $this->db->join('`tbl_mst_rep_link_territory_agent`', '`tbl_trans_survey_result`.`audit_user`=`tbl_mst_rep_link_territory_agent`.`rep_username`', 'RIGHT');
        $this->db->join('`tbl_mst_territory`', '`tbl_mst_rep_link_territory_agent`.`territory_id`=`tbl_mst_territory`.`id`', 'LEFT');
        $this->db->join('`tbl_mst_area_link_territory`', '`tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id`', 'LEFT');
        $this->db->join('`tbl_mst_area`', '`tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id`', 'LEFT');
        $this->db->join('`tbl_mst_range`', '`tbl_mst_rep_link_territory_agent`.`range_id`=`tbl_mst_range`.`id`', 'INNER');
        
        $this->db->where('tbl_trans_survey_result.survey_id',$survey_id);
        /*
        $this->db->where(array('`survey_date`>=' => $dateFrom, '`survey_date`<=' => $dateTo));
        if (!empty($areaID) && isset($areaID) && $areaID != null) {
            $this->db->where('`tbl_mst_area`.`id`', $areaID);
        }
        if (!empty($territoryID) && isset($territoryID) && $territoryID != null) {
            $this->db->where('`tbl_mst_territory`.`id`', $territoryID);
        }
        if (!empty($rangeID) && isset($rangeID) && $rangeID != null) {
            $this->db->where('`tbl_mst_range`.`id`', $rangeID);
        }*/
        //$this->db->group_by('`tbl_mst_area`.`area_name`, `tbl_mst_territory`.`territory_name`, `tbl_mst_range`.`range_name`,`tbl_trans_survey_result`.`audit_user`');
        $this->db->order_by('`tbl_mst_area`.`area_name`,`tbl_mst_range`.`range_name`,`tbl_mst_territory`.`territory_name`');
        $query = $this->db->get();
        $result = $query->result_array();
        //echo $this->db->last_query();
        return $result;
    }

}
