<?php

/*
 * This system Licenced to Raigam Marketing Services (Pvt) Ltd. 
 * Developed By: Lakshitha Pradeep Karunarathna  * 
 * Company: Serving Cloud INC in association with MyOffers.lk  * 
 * Date Started:  October 20, 2017  * 
 */

class DistributorReportModule extends CI_Model {

    function __construct() {
        parent::__construct();
        //$this->mssql = $this->load->database('MSSQL', TRUE);         
        $this->load->model('SalesarcustomersModule');
    }

    function getDailyPcTotals($areaID = null, $territoryID = null, $routeID = null, $rangeID = null, $billingType = null, $dateFrom = null, $dateTo = null, $reportType = 'summery', $channel_id = 1, $username = null) {
        if ($reportType == 'summery_area') {//area wise sales summery data
            if ($billingType == 'A') {
                $this->db->select('`tbl_mst_channel`.`id` AS `channel_id`,`tbl_mst_area`.`id` AS `area_id`,`tbl_mst_area`.`area_name`,IF(`tbl_mst_range`.`id`=5,2,`tbl_mst_range`.`id`) AS `range_id`,IF(`tbl_mst_range`.`range_name`=\'T\',\'D\',`tbl_mst_range`.`range_name`) AS `range_name`, `invh`.`date_actual`,COUNT(DISTINCT(`invh`.`invno`)) AS `totBills`,COUNT(DISTINCT(`shop_mst`.`Auto`)) AS `totPC` ,COUNT(DISTINCT(CASE WHEN (tot_c_val>0 AND tot_a_val=0) THEN `shop_mst`.`Auto` END)) AS `totCancelPC`, COUNT(DISTINCT(CASE WHEN (b_a =\'A\' AND tot_a_val <> 0) THEN `shop_mst`.`Auto` END)) AS `totActualPC` ,SUM(`invh`.`tot_b_val`) AS `totBval`,SUM(`invh`.`tot_c_val`) AS `totCval`,SUM(`invh`.`tot_g_val`) AS `totGval`,SUM(`invh`.`tot_m_val`) AS `totMval`,SUM(`invh`.`tot_a_val`) AS `totAval`, SUM(`invh`.`tot_dis`) AS `totDisval`');
            } else {
                $this->db->select('`tbl_mst_channel`.`id` AS `channel_id`,`tbl_mst_area`.`id`,`invh`.`date_book`,COUNT(DISTINCT(`invh`.`invno`)) AS `totBills`,COUNT(DISTINCT(`shop_mst`.`Auto`)) AS `totPC` ,COUNT(DISTINCT(CASE WHEN (tot_c_val>0 AND tot_a_val=0) THEN `shop_mst`.`Auto` END)) AS `totCancelPC`, COUNT(DISTINCT(CASE WHEN (b_a =\'A\' AND tot_a_val <> 0) THEN `shop_mst`.`Auto` END)) AS `totActualPC` ,SUM(`invh`.`tot_b_val`) AS `totBval`,SUM(`invh`.`tot_c_val`) AS `totCval`,SUM(`invh`.`tot_g_val`) AS `totGval`,SUM(`invh`.`tot_m_val`) AS `totMval`,SUM(`invh`.`tot_a_val`) AS `totAval`, SUM(`invh`.`tot_dis`) AS `totDisval`');
            }
        } elseif ($reportType == 'summery') {
            if ($billingType == 'A') {
                $this->db->select('`invh`.`date_actual`,COUNT(DISTINCT(`invh`.`invno`)) AS `totBills`,COUNT(DISTINCT(`shop_mst`.`Auto`)) AS `totPC` ,COUNT(DISTINCT(CASE WHEN (tot_c_val>0 AND tot_a_val=0) THEN `shop_mst`.`Auto` END)) AS `totCancelPC`, COUNT(DISTINCT(CASE WHEN (b_a =\'A\' AND tot_a_val <> 0) THEN `shop_mst`.`Auto` END)) AS `totActualPC` ,SUM(`invh`.`tot_b_val`) AS `totBval`,SUM(`invh`.`tot_c_val`) AS `totCval`,SUM(`invh`.`tot_g_val`) AS `totGval`,SUM(`invh`.`tot_m_val`) AS `totMval`,SUM(`invh`.`tot_a_val`) AS `totAval`, SUM(`invh`.`tot_dis`) AS `totDisval`');
            } else {
                $this->db->select('`invh`.`date_book`,COUNT(DISTINCT(`invh`.`invno`)) AS `totBills`,COUNT(DISTINCT(`shop_mst`.`Auto`)) AS `totPC` ,COUNT(DISTINCT(CASE WHEN (tot_c_val>0 AND tot_a_val=0) THEN `shop_mst`.`Auto` END)) AS `totCancelPC`, COUNT(DISTINCT(CASE WHEN (b_a =\'A\' AND tot_a_val <> 0) THEN `shop_mst`.`Auto` END)) AS `totActualPC` ,SUM(`invh`.`tot_b_val`) AS `totBval`,SUM(`invh`.`tot_c_val`) AS `totCval`,SUM(`invh`.`tot_g_val`) AS `totGval`,SUM(`invh`.`tot_m_val`) AS `totMval`,SUM(`invh`.`tot_a_val`) AS `totAval`, SUM(`invh`.`tot_dis`) AS `totDisval`');
            }
        } elseif ($reportType == 'summery_territory') {
            if ($billingType == 'A') {
                $this->db->select('`tbl_mst_area`.`id` AS `area_id`,`invh`.`date_actual`,`tbl_mst_territory`.`id`,`tbl_mst_territory`.`reference_code`,`tbl_mst_territory`.`territory_name`,IF(`tbl_mst_range`.`id`=5,2,`tbl_mst_range`.`id`) AS `range_id`,IF(`tbl_mst_range`.`range_name`=\'T\',\'D\',`tbl_mst_range`.`range_name`) AS `range_name`,COUNT(DISTINCT(`invh`.`invno`)) AS `totBills`,COUNT(DISTINCT(`shop_mst`.`Auto`)) AS `totPC` ,COUNT(DISTINCT(CASE WHEN (tot_c_val>0 AND tot_a_val=0) THEN `shop_mst`.`Auto` END)) AS `totCancelPC`, COUNT(DISTINCT(CASE WHEN (b_a =\'A\' AND tot_a_val <> 0) THEN `shop_mst`.`Auto` END)) AS `totActualPC` ,SUM(`invh`.`tot_b_val`) AS `totBval`,SUM(`invh`.`tot_c_val`) AS `totCval`,SUM(`invh`.`tot_g_val`) AS `totGval`,SUM(`invh`.`tot_m_val`) AS `totMval`,SUM(`invh`.`tot_a_val`) AS `totAval`, SUM(`invh`.`tot_dis`) AS `totDisval`');
            } else {
                $this->db->select('`invh`.`date_book`,COUNT(DISTINCT(`invh`.`invno`)) AS `totBills`,COUNT(DISTINCT(`shop_mst`.`Auto`)) AS `totPC` ,COUNT(DISTINCT(CASE WHEN (tot_c_val>0 AND tot_a_val=0) THEN `shop_mst`.`Auto` END)) AS `totCancelPC`, COUNT(DISTINCT(CASE WHEN (b_a =\'A\' AND tot_a_val <> 0) THEN `shop_mst`.`Auto` END)) AS `totActualPC` ,SUM(`invh`.`tot_b_val`) AS `totBval`,SUM(`invh`.`tot_c_val`) AS `totCval`,SUM(`invh`.`tot_g_val`) AS `totGval`,SUM(`invh`.`tot_m_val`) AS `totMval`,SUM(`invh`.`tot_a_val`) AS `totAval`, SUM(`invh`.`tot_dis`) AS `totDisval`');
            }
        } else {
            $this->db->select('invno, sh_name,invh.ro_cd as ro,tot_b_val,tot_c_val,tot_m_val,tot_g_val,tot_f_val,tot_dis,tot_a_val,date_book,date_actual');
        }
        $this->db->from('`invh`');
        $this->db->join('`shop_mst`', '`invh`.`ag_cd`=`shop_mst`.`sh_ag_cd` AND `invh`.`ro_cd`=`shop_mst`.`sh_ro_cd` AND `invh`.`sh_cd`=`shop_mst`.`sh_cd`', 'INNER');
        $this->db->join('`tbl_mst_territory`', '`invh`.`ag_cd`=`tbl_mst_territory`.`reference_code`', 'INNER');

        $this->db->join('`tbl_mst_geography`', '`tbl_mst_territory`.`id`=`tbl_mst_geography`.`territory_id`', 'INNER');
        //$this->db->join('`tbl_mst_area_link_territory`', '`tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id`', 'INNER');
        $this->db->join('`tbl_mst_area`', '`tbl_mst_geography`.`area_id`=`tbl_mst_area`.`id`', 'INNER');
        $this->db->join('`tbl_mst_range`', '`invh`.`cd`=`tbl_mst_range`.`range_name`', 'INNER');

        //$this->db->join('`tbl_mst_region_link_area`', '`tbl_mst_area`.`id`=`tbl_mst_region_link_area`.`area_id`', 'INNER');
        $this->db->join('`tbl_mst_region`', '`tbl_mst_geography`.`region_id`=`tbl_mst_region`.`id`', 'INNER');
        $this->db->join('`tbl_mst_channel_region`', '`tbl_mst_region`.`id`=`tbl_mst_channel_region`.`region_id`', 'INNER');
        $this->db->join('`tbl_mst_channel`', '`tbl_mst_channel_region`.`channel_id`=`tbl_mst_channel`.`id`', 'INNER');

        if (!empty($channel_id) && isset($channel_id) && $channel_id != null && $channel_id != 'null') {
            $this->db->where('`tbl_mst_channel`.`id`', $channel_id);
        }
        if (!empty($areaID) && isset($areaID) && $areaID != null && $areaID != -1) {
            $this->db->where('`tbl_mst_area`.`id`', $areaID);
        }
        if (!empty($territoryID) && isset($territoryID) && $territoryID != null && $territoryID != 'null') {
            $this->db->where('`tbl_mst_territory`.`id`', $territoryID);
        }
        //if (!empty($username) && isset($username) && $username != null && $username != 'null') {
        $this->db->where('`tbl_mst_geography`.`agent_username`', $username);
        //}
        $this->db->where('`invh`.`d`!=', 'M'); //without Company Direct
        if ($billingType == 'A') {
            $this->db->where('`invh`.`b_a`', $billingType);
            $this->db->where('`invh`.`date_actual`>=', $dateFrom);
            $this->db->where('`invh`.`date_actual`<=', $dateTo);
            if ($reportType == 'summery_territory') {
                $this->db->group_by('`tbl_mst_territory`.`id`');
            }
            if ($reportType == 'summery_area') {//for area wise summery group them by area id
                $this->db->group_by('`tbl_mst_area`.`id`');
            }
            if (!empty($rangeID) && isset($rangeID) && $rangeID != null) {
                if ($rangeID == 2) {//town operation taken as D range
                    $this->db->where('(`tbl_mst_range`.`id`=2 OR `tbl_mst_range`.`id`=5)');
                } else {
                    $this->db->where('`tbl_mst_range`.`id`', $rangeID);
                }
            } else {
                $this->db->group_by('`tbl_mst_range`.`id`');
            }
            if ($reportType == 'summery_area' || $reportType == 'summery' || $reportType == 'summery_territory') {
                $this->db->group_by('`invh`.`date_actual`');
            }
            //$this->db->order_by('`tbl_mst_territory`.`id`,`invh`.`date_actual`');
        } else {
            $this->db->where('`invh`.`date_book`>=', $dateFrom);
            $this->db->where('`invh`.`date_book`<=', $dateTo);

            if ($reportType == 'summery_territory') {
                $this->db->group_by('`tbl_mst_territory`.`id`');
            }
            if ($reportType == 'summery_area') {//for area wise summery group them by area id
                $this->db->group_by('`tbl_mst_area`.`id`');
            }
            if (!empty($rangeID) && isset($rangeID) && $rangeID != null) {
                if ($rangeID == 2) {//town operation taken as D range
                    $this->db->where('(`tbl_mst_range`.`id`=2 OR `tbl_mst_range`.`id`=5)');
                } else {
                    $this->db->where('`tbl_mst_range`.`id`', $rangeID);
                }
            } else {
                $this->db->group_by('`tbl_mst_range`.`id`');
            }
            if ($reportType == 'summery_area' || $reportType == 'summery' || $reportType == 'summery_territory') {
                $this->db->group_by('`invh`.`date_book`');
            }
        }



        //echo $reportType;
        if ($reportType == 'summery_area') {//for area wise summery group them by area id
            if ($billingType == 'A') {
                $this->db->order_by('`tbl_mst_area`.`id`,`invh`.`date_actual`');
            } else {
                $this->db->order_by('`tbl_mst_area`.`id`,`invh`.`date_book`');
            }
        } elseif ($reportType == 'summery') {
            if ($billingType == 'A') {
                $this->db->order_by('`invh`.`date_actual`');
            } else {
                $this->db->order_by('`invh`.`date_book`');
            }
        } else {
            if ($billingType == 'A') {
                $this->db->order_by('`tbl_mst_territory`.`id`,`invh`.`date_actual`');
            } else {
                $this->db->order_by('`tbl_mst_territory`.`id`,`invh`.`date_book`');
            }
        }
        //$this->db->order_by('`tbl_mst_territory`.`id`,`invh`.`date_book`');
        $queryData = $this->db->get();
        $resultData = $queryData->result_array();
        echo $this->db->last_query() . '<br>';
        return $resultData;
    }

}
?>