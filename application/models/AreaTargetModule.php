<?php

/*
 * This system Licenced to Raigam Marketing Services (Pvt) Ltd. 
 * Developed By: Lakshitha Pradeep Karunarathna  * 
 * Company: Serving Cloud INC in association with MyOffers.lk  * 
 * Date Started:  October 20, 2017  * 
 */

class AreaTargetModule extends CI_Model {

    function __construct() {
        parent::__construct();
        //$this->mssql = $this->load->database('MSSQL', TRUE); 
    }


    function getTargetNewDemarcation1($tyear, $tmonth, $area_cd = NULL,$checkVariable=null) {

        $month_year = $tyear."-".$tmonth;
        
        $this->db->select('`tbl_mst_area`.`id` AS `area_cd`, `target_value`.`ag_cd`, `t_year`, `t_mon`, `tbl_mst_area`.`area_name`, `ag_name`, SUM(IF(tbl_mst_geography.range_id=1 OR tbl_mst_geography.range_id=3,`c_target`,0)) AS `c_target`, SUM(IF(tbl_mst_geography.range_id=2 OR tbl_mst_geography.range_id=5 OR tbl_mst_geography.range_id=3,`d_target`,0)) AS `d_target`, `a_target`, SUM(IF(tbl_mst_geography.range_id=4,`b_target`,0)) AS `b_target`, SUM(IF(tbl_mst_geography.range_id=3,`s_target`,0)) AS `s_target`, SUM(IF(tbl_mst_geography.range_id=5,`t_target`,0)) AS `t_target`, SUM(IF(tbl_mst_geography.range_id=6,`r_target`,0)) AS  `r_target`, SUM(IF(tbl_mst_geography.range_id=1,`acs_pc_target`,0)) AS `acs_pc_target`, SUM(IF(tbl_mst_geography.range_id=2,`bd_pc_target`,0)) AS `bd_pc_target`, `wd`, `p_wd`, `auto`');
        $this->db->from('`target_value`');
        $this->db->join('`tbl_mst_territory`', 'target_value.ag_cd=`tbl_mst_territory`.`reference_code`', 'INNER');
        $this->db->join('`tbl_mst_geography`', 'tbl_mst_territory.id=`tbl_mst_geography`.`territory_id`', 'INNER');
        $this->db->join('`tbl_mst_area`', 'tbl_mst_geography.area_id=`tbl_mst_area`.`id`', 'INNER');
        $this->db->join('`tbl_mst_target_value`', '`target_value`.`ag_cd`=`tbl_mst_target_value`.`itemCode`', 'INNER');
        if (!empty($area_cd) && isset($area_cd) && $area_cd != NULL && $area_cd != '-1') {
            //$this->db->where('area_cd', $area_cd);
            $this->db->where('`tbl_mst_area`.`id`', $area_cd);
        }
        $this->db->where(array('t_year' => $tyear, 't_mon' => $tmonth));
        $this->db->where('`tbl_mst_target_value`.`upload_month`', $month_year);
        $this->db->group_by('`tbl_mst_territory`.`reference_code`');
        $queryData = $this->db->get();
        $resultData = $queryData->result_array();
        echo $this->db->last_query();
        die();
        return $resultData;
    }

    }

