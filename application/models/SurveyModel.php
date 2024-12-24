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

    function getTotalSoapCategory($catego=null) {
        $query=$this->db->query('SELECT tbl_mst_area.area_name,COUNT(tbl_trans_survey_result.id) as samples FROM `tbl_trans_survey_result` INNER JOIN tbl_mst_rep_link_territory_agent ON tbl_trans_survey_result.audit_user=tbl_mst_rep_link_territory_agent.rep_username INNER JOIN tbl_mst_territory ON tbl_mst_rep_link_territory_agent.territory_id=tbl_mst_territory.id INNER JOIN tbl_mst_area_link_territory ON tbl_mst_territory.id=tbl_mst_area_link_territory.territory_id INNER JOIN tbl_mst_area ON tbl_mst_area_link_territory.area_id=tbl_mst_area.id INNER JOIN tbl_trans_survey_detail ON tbl_trans_survey_result.id = tbl_trans_survey_detail.result_id WHERE survey_id=18 AND tbl_trans_survey_detail.question_1 = '.$catego.' GROUP BY area_name ORDER by samples desc');
        
        //$query = $this->db->get();
        $result = $query->result_array();
        //echo $this->db->last_query();
        return $result;
    }

    function getTotalSoap($survey_ID=18,$catego=null) {

        $query=$this->db->query('SELECT tbl_mst_area.area_name,tbl_mst_territory.territory_name,audit_user,COUNT(tbl_trans_survey_result.id) as samples FROM `tbl_trans_survey_result` 
INNER JOIN tbl_mst_rep_link_territory_agent ON tbl_trans_survey_result.audit_user=tbl_mst_rep_link_territory_agent.rep_username 
INNER JOIN tbl_mst_territory ON tbl_mst_rep_link_territory_agent.territory_id=tbl_mst_territory.id
INNER JOIN tbl_mst_area_link_territory ON tbl_mst_territory.id=tbl_mst_area_link_territory.territory_id
INNER JOIN tbl_mst_area ON tbl_mst_area_link_territory.area_id=tbl_mst_area.id
INNER JOIN tbl_trans_survey_detail ON tbl_trans_survey_result.id = tbl_trans_survey_detail.result_id
WHERE tbl_trans_survey_detail.question_1='.$catego.' AND survey_id='.$survey_ID.'
GROUP BY audit_user ORDER by samples desc');
        
        //$query = $this->db->get();
        $result = $query->result_array();
        //echo $this->db->last_query();
        return $result;
    }
    
    function getCompetitors($catego){
        $this->db->select('`tbl_trans_survay_soap`.`name` AS comp_name,`tbl_trans_survay_soap`.`id` AS comp_id');
        $this->db->from('`tbl_trans_survay_soap`');
        $this->db->where('`tbl_trans_survay_soap`.`soap_cat`',$catego);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    function getSoapSurveyDetails($dateFrom=null, $dateTo=null, $areaID = null, $territoryID = null, $rangeID = null,$survey_id=18,$catego = null) {
        if($catego==null){
            $catego = 1;
        }
        $q1 = '`tbl_mst_area`.`area_name`,`tbl_mst_territory`.`territory_name`,`tbl_mst_range`.`range_name`, `tbl_trans_survey_result`.`audit_user`, `tbl_trans_survey_result`.`survey_date`, '
                . '`tbl_trans_survey_result`.`survey_time`,`tbl_trans_survey_result`.`question_1`, `tbl_trans_survey_result`.`question_2`,'
                . ' `tbl_trans_survey_result`.`question_3`, `tbl_trans_survey_result`.`question_4`, `tbl_trans_survey_result`.`question_5`, '
                . '`tbl_trans_survey_result`.`question_6`,';
        
        $competitors = $this->getCompetitors($catego);
        foreach ($competitors as $a){
        $q1.=' case ';
//         
            $q1 .='when tbl_trans_survey_detail.competitor=\''.$a['comp_id'].'\' then `tbl_trans_survey_detail`.`question_1`';
            
        $q1.=' end AS '.$a['comp_name'].'_mrp,';
        
        $q1.=' case ';
//         
            $q1 .='when tbl_trans_survey_detail.competitor=\''.$a['comp_id'].'\' then `tbl_trans_survey_detail`.`question_2`';
            
        $q1.=' end AS '.$a['comp_name'].'_retail_price,';
        
        $q1.=' case ';
//         
            $q1 .='when tbl_trans_survey_detail.competitor=\''.$a['comp_id'].'\' then `tbl_trans_survey_detail`.`question_3`';
            
        $q1.=' end AS '.$a['comp_name'].'_size,';
        
        $q1.=' case ';
//         
            $q1 .='when tbl_trans_survey_detail.competitor=\''.$a['comp_id'].'\' then `tbl_trans_survey_detail`.`question_10`';
            
        $q1.=' end AS '.$a['comp_name'].'_free_issue,';
        
        $q1.=' case ';
//         
            $q1 .='when tbl_trans_survey_detail.competitor=\''.$a['comp_id'].'\' then `tbl_trans_survey_detail`.`question_5`';
            
        $q1.=' end AS '.$a['comp_name'].'_available,';
        
        $q1.=' case ';
//         
            $q1 .='when tbl_trans_survey_detail.competitor=\''.$a['comp_id'].'\' then `tbl_trans_survey_detail`.`question_6`';
            
        $q1.=' end AS '.$a['comp_name'].'_discount,';
        }
                
        $this->db->select($q1. '`tbl_trans_survey_detail`.`itemName`');
        $this->db->from('`tbl_trans_survey_result`');
        $this->db->join('`tbl_trans_survey_detail`', '`tbl_trans_survey_detail`.`result_id`=`tbl_trans_survey_result`.`id`', 'RIGHT');
        $this->db->join('`tbl_mst_rep_link_territory_agent`', '`tbl_trans_survey_result`.`audit_user`=`tbl_mst_rep_link_territory_agent`.`rep_username`', 'RIGHT');
        $this->db->join('`tbl_mst_territory`', '`tbl_mst_rep_link_territory_agent`.`territory_id`=`tbl_mst_territory`.`id`', 'LEFT');
        $this->db->join('`tbl_mst_area_link_territory`', '`tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id`', 'LEFT');
        $this->db->join('`tbl_mst_area`', '`tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id`', 'LEFT');
        $this->db->join('`tbl_mst_range`', '`tbl_mst_rep_link_territory_agent`.`range_id`=`tbl_mst_range`.`id`', 'INNER');
        
        $this->db->where('tbl_trans_survey_result.survey_id',$survey_id);
        $this->db->where(' tbl_trans_survey_detail.question_1',$catego);
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
        $this->db->group_by('`tbl_trans_survey_result`.`id`, `tbl_trans_survey_result`.`question_2`, `tbl_trans_survey_detail`.`itemCode`');
        $this->db->order_by('`tbl_mst_area`.`area_name`,`tbl_mst_range`.`range_name`,`tbl_mst_territory`.`territory_name`');
        $query = $this->db->get();
        $result = $query->result_array();

        // echo $this->db->last_query();
        // die();

        return $result;
    }
    function getSurveyDetails($dateFrom=null, $dateTo=null, $areaID = null, $territoryID = null, $rangeID = null,$survey_id=17) {

        $q1 = '`tbl_mst_area`.`area_name`,`tbl_mst_territory`.`territory_name`,`tbl_mst_range`.`range_name`, `tbl_trans_survey_result`.`audit_user`, `tbl_trans_survey_result`.`survey_date`, '
                . '`tbl_trans_survey_result`.`survey_time`,`tbl_trans_survey_result`.`question_1`, `tbl_trans_survey_result`.`question_2`,'
                . ' `tbl_trans_survey_result`.`question_3`, `tbl_trans_survey_result`.`question_4`, `tbl_trans_survey_result`.`question_5`, '
                . '`tbl_trans_survey_result`.`question_6`,';
        
        $competitors = $this->getCompetitors($catego);
        foreach ($competitors as $a){
        $q1.=' case ';
//         
            $q1 .='when tbl_trans_survey_detail.competitor=\''.$a['comp_id'].'\' then `tbl_trans_survey_detail`.`question_1`';
            
        $q1.=' end AS '.$a['comp_name'].'_mrp,';
        
        $q1.=' case ';
//         
            $q1 .='when tbl_trans_survey_detail.competitor=\''.$a['comp_id'].'\' then `tbl_trans_survey_detail`.`question_2`';
            
        $q1.=' end AS '.$a['comp_name'].'_retail_price,';
        
        $q1.=' case ';
//         
            $q1 .='when tbl_trans_survey_detail.competitor=\''.$a['comp_id'].'\' then `tbl_trans_survey_detail`.`question_3`';
            
        $q1.=' end AS '.$a['comp_name'].'_wholesale_price,';
        
        $q1.=' case ';
//         
            $q1 .='when tbl_trans_survey_detail.competitor=\''.$a['comp_id'].'\' then `tbl_trans_survey_detail`.`question_4`';
            
        $q1.=' end AS '.$a['comp_name'].'_free_issue,';
        
        $q1.=' case ';
//         
            $q1 .='when tbl_trans_survey_detail.competitor=\''.$a['comp_id'].'\' then `tbl_trans_survey_detail`.`question_5`';
            
        $q1.=' end AS '.$a['comp_name'].'_discount,';
        
        $q1.=' case ';
//         
            $q1 .='when tbl_trans_survey_detail.competitor=\''.$a['comp_id'].'\' then `tbl_trans_survey_detail`.`question_6`';
            
        $q1.=' end AS '.$a['comp_name'].'_commit,';
        }
                
        $this->db->select($q1. '`tbl_trans_survey_detail`.`itemName`');
        $this->db->from('`tbl_trans_survey_result`');
        $this->db->join('`tbl_trans_survey_detail`', '`tbl_trans_survey_detail`.`result_id`=`tbl_trans_survey_result`.`id`', 'RIGHT');
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
        $this->db->group_by('`tbl_trans_survey_result`.`id`, `tbl_trans_survey_result`.`question_2`, `tbl_trans_survey_detail`.`itemCode`');
        $this->db->order_by('`tbl_mst_area`.`area_name`,`tbl_mst_range`.`range_name`,`tbl_mst_territory`.`territory_name`');
        $query = $this->db->get();
        $result = $query->result_array();
//        echo $this->db->last_query();
//        die();
        return $result;
    }

}
