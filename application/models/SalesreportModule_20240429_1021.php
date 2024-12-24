<?php

/*
 * This system Licenced to Raigam Marketing Services (Pvt) Ltd. 
 * Developed By: Lakshitha Pradeep Karunarathna  * 
 * Company: Serving Cloud INC in association with MyOffers.lk  * 
 * Date Started:  October 20, 2017  * 
 */

class SalesreportModule extends CI_Model {

    function __construct() {
        parent::__construct();
        //$this->mssql = $this->load->database('MSSQL', TRUE); 
    }

    function getChanneltoAreaMap($channel_id = 1) {
        //$this->db->select('`tbl_mst_channel`.`id` AS `channel_id`, `tbl_mst_channel`.`channel_name`,`tbl_mst_region`.`id` AS `region_id`,`tbl_mst_region`.`region_name`,`tbl_mst_area`.`id` AS `area_id`,`tbl_mst_area`.`area_name`');
        //$this->db->select('`tbl_mst_channel`.`id` AS `channel_id`, `tbl_mst_channel`.`channel_name`,`tbl_mst_region`.`id` AS `region_id`,`tbl_mst_region`.`region_name`');
        $this->db->select('`tbl_mst_channel`.`id` AS `channel_id`, `tbl_mst_channel`.`channel_name` ');
        $this->db->from('`tbl_mst_channel`');
        //$this->db->join('`tbl_mst_channel_region`','`tbl_mst_channel`.`id`=`tbl_mst_channel_region`.`channel_id`','INNER');
        //$this->db->join('`tbl_mst_region`','`tbl_mst_channel_region`.`region_id`=`tbl_mst_region`.`id`','INNER');
        //$this->db->join('`tbl_mst_region_link_area`','`tbl_mst_region`.`id`=`tbl_mst_region_link_area`.`region_id`','INNER');
        //$this->db->join('`tbl_mst_area`','`tbl_mst_region_link_area`.`area_id`=`tbl_mst_area`.`id`','INNER');
        $this->db->where('`tbl_mst_channel`.`id`', $channel_id);
        $queryData = $this->db->get();
        $resultData = $queryData->result_array();
        //echo $this->db->last_query().'<br>';
        return $resultData;
    }

    function getRangeList($channel_id = null) {
        $this->db->select('`tbl_mst_channel`.`id` AS `channel_id`, `tbl_mst_channel`.`channel_name`,`tbl_mst_operation`.`id` AS `operation_id`,`tbl_mst_operation`.`operation_name`,`tbl_mst_range`.`id` AS `range_id`,`tbl_mst_range`.`range_name`');
        $this->db->from('`tbl_mst_channel`');
        $this->db->join('`tbl_mst_channel_operation`', '`tbl_mst_channel`.`id`=`tbl_mst_channel_operation`.`channel_id`', 'INNER');
        $this->db->join('`tbl_mst_operation`', '`tbl_mst_channel_operation`.`operation_id`=`tbl_mst_operation`.`id`', 'INNER');
        $this->db->join('`tbl_mst_operation_range`', '`tbl_mst_operation`.`id`=`tbl_mst_operation_range`.`operation_id`', 'INNER');
        $this->db->join('`tbl_mst_range`', '`tbl_mst_operation_range`.`range_id`=`tbl_mst_range`.`id`', 'INNER');
        $this->db->where('`tbl_mst_channel`.`id`', $channel_id);
        $queryData = $this->db->get();
        $resultData = $queryData->result_array();
        //echo $this->db->last_query().'<br>';
        return $resultData;
    }

    function getDailyPcTotals($areaID = null, $territoryID = null, $routeID = null, $rangeID = null, $billingType = null, $dateFrom = null, $dateTo = null, $reportType = 'summery', $channel_id = 1) {
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
        $this->db->join('`tbl_mst_area_link_territory`', '`tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id`', 'INNER');
        $this->db->join('`tbl_mst_area`', '`tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id`', 'INNER');
        $this->db->join('`tbl_mst_range`', '`invh`.`cd`=`tbl_mst_range`.`range_name`', 'INNER');

        $this->db->join('`tbl_mst_region_link_area`', '`tbl_mst_area`.`id`=`tbl_mst_region_link_area`.`area_id`', 'INNER');
        $this->db->join('`tbl_mst_region`', '`tbl_mst_region_link_area`.`region_id`=`tbl_mst_region`.`id`', 'INNER');
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
        //echo $this->db->last_query().'<br>';
        return $resultData;
    }

    function getDailyPcTotalsNew($areaID = null, $territoryID = null, $routeID = null, $rangeID = null, $billingType = null, $dateFrom = null, $dateTo = null, $reportType = 'summery', $channel_id = 1) {
        if ($reportType == 'summery_area') {//area wise sales summery data
            if ($billingType == 'A') {
                $this->db->select('`tbl_mst_channel`.`id` AS `channel_id`,`tbl_mst_area`.`id` AS `area_id`,`tbl_mst_area`.`area_name`,IF(`tbl_mst_range`.`id`=5,2,`tbl_mst_range`.`id`) AS `range_id`,IF(`tbl_mst_range`.`range_name`=\'T\',\'D\',`tbl_mst_range`.`range_name`) AS `range_name`, `tbl_trans_order_h`.`inv_date` AS `date_actual`,COUNT(DISTINCT(`tbl_trans_order_h`.`app_inv_no`)) AS `totBills`,COUNT(DISTINCT(`tbl_mst_outlet`.`id`)) AS `totPC` ,COUNT(DISTINCT(CASE WHEN (header_cancel_value>0 AND header_net_value=0) THEN `tbl_mst_outlet`.`id` END)) AS `totCancelPC`, COUNT(DISTINCT(CASE WHEN (inv_type =\'A\' AND header_net_value <> 0) THEN `tbl_mst_outlet`.`id` END)) AS `totActualPC` ,SUM(`tbl_trans_order_h`.`header_net_value`) AS `totBval`,SUM(`tbl_trans_order_h`.`header_cancel_value`) AS `totCval`,SUM(`tbl_trans_order_h`.`header_gr_value`) AS `totGval`,SUM(`tbl_trans_order_h`.`header_mr_value`) AS `totMval`,SUM(`tbl_trans_order_h`.`header_net_value`) AS `totAval`, SUM(`tbl_trans_order_h`.`total_discount_value`) AS `totDisval`');
            } else {
                $this->db->select('`tbl_mst_channel`.`id` AS `channel_id`,`tbl_mst_area`.`id`,`tbl_trans_order_h`.`inv_date` AS `date_actual`,COUNT(DISTINCT(`tbl_trans_order_h`.`app_inv_no`)) AS `totBills`,COUNT(DISTINCT(`tbl_mst_outlet`.`id`)) AS `totPC` ,COUNT(DISTINCT(CASE WHEN (header_cancel_value>0 AND header_net_value=0) THEN `tbl_mst_outlet`.`id` END)) AS `totCancelPC`, COUNT(DISTINCT(CASE WHEN (inv_type =\'A\' AND header_net_value <> 0) THEN `tbl_mst_outlet`.`id` END)) AS `totActualPC` ,SUM(`tbl_trans_order_h`.`header_net_value`) AS `totBval`,SUM(`tbl_trans_order_h`.`header_cancel_value`) AS `totCval`,SUM(`tbl_trans_order_h`.`header_gr_value`) AS `totGval`,SUM(`tbl_trans_order_h`.`header_mr_value`) AS `totMval`,SUM(`tbl_trans_order_h`.`header_net_value`) AS `totAval`, SUM(`tbl_trans_order_h`.`total_discount_value`) AS `totDisval`');
            }
        } elseif ($reportType == 'summery') {
            if ($billingType == 'A') {
                $this->db->select('`tbl_trans_order_h`.`inv_date` AS `date_actual`,COUNT(DISTINCT(`tbl_trans_order_h`.`app_inv_no`)) AS `totBills`,COUNT(DISTINCT(`tbl_mst_outlet`.`id`)) AS `totPC` ,COUNT(DISTINCT(CASE WHEN (header_cancel_value>0 AND header_net_value=0) THEN `tbl_mst_outlet`.`id` END)) AS `totCancelPC`, COUNT(DISTINCT(CASE WHEN (inv_type =\'A\' AND header_net_value <> 0) THEN `tbl_mst_outlet`.`id` END)) AS `totActualPC` ,SUM(`tbl_trans_order_h`.`header_net_value`) AS `totBval`,SUM(`tbl_trans_order_h`.`header_cancel_value`) AS `totCval`,SUM(`tbl_trans_order_h`.`header_gr_value`) AS `totGval`,SUM(`tbl_trans_order_h`.`header_mr_value`) AS `totMval`,SUM(`tbl_trans_order_h`.`header_net_value`) AS `totAval`, SUM(`tbl_trans_order_h`.`total_discount_value`) AS `totDisval`');
            } else {
                $this->db->select('`tbl_trans_order_h`.`inv_date` AS `date_actual`,COUNT(DISTINCT(`tbl_trans_order_h`.`app_inv_no`)) AS `totBills`,COUNT(DISTINCT(`tbl_mst_outlet`.`id`)) AS `totPC` ,COUNT(DISTINCT(CASE WHEN (header_cancel_value>0 AND header_net_value=0) THEN `tbl_mst_outlet`.`id` END)) AS `totCancelPC`, COUNT(DISTINCT(CASE WHEN (inv_type =\'A\' AND header_net_value <> 0) THEN `tbl_mst_outlet`.`id` END)) AS `totActualPC` ,SUM(`tbl_trans_order_h`.`header_net_value`) AS `totBval`,SUM(`tbl_trans_order_h`.`header_cancel_value`) AS `totCval`,SUM(`tbl_trans_order_h`.`header_gr_value`) AS `totGval`,SUM(`tbl_trans_order_h`.`header_mr_value`) AS `totMval`,SUM(`tbl_trans_order_h`.`header_net_value`) AS `totAval`, SUM(`tbl_trans_order_h`.`total_discount_value`) AS `totDisval`');
            }
        } elseif ($reportType == 'summery_territory') {
            if ($billingType == 'A') {
                $this->db->select('`tbl_mst_area`.`id` AS `area_id`,`tbl_trans_order_h`.`inv_date` AS `date_actual`,`tbl_mst_territory`.`id`,`tbl_mst_territory`.`reference_code`,`tbl_mst_territory`.`territory_name`,IF(`tbl_mst_range`.`id`=5,2,`tbl_mst_range`.`id`) AS `range_id`,IF(`tbl_mst_range`.`range_name`=\'T\',\'D\',`tbl_mst_range`.`range_name`) AS `range_name`,COUNT(DISTINCT(`tbl_trans_order_h`.`app_inv_no`)) AS `totBills`,COUNT(DISTINCT(`tbl_mst_outlet`.`id`)) AS `totPC` ,COUNT(DISTINCT(CASE WHEN (header_cancel_value>0 AND header_net_value=0) THEN `tbl_mst_outlet`.`id` END)) AS `totCancelPC`, COUNT(DISTINCT(CASE WHEN (inv_type =\'A\' AND header_net_value <> 0) THEN `tbl_mst_outlet`.`id` END)) AS `totActualPC` ,SUM(`tbl_trans_order_h`.`header_net_value`) AS `totBval`,SUM(`tbl_trans_order_h`.`header_cancel_value`) AS `totCval`,SUM(`tbl_trans_order_h`.`header_gr_value`) AS `totGval`,SUM(`tbl_trans_order_h`.`header_mr_value`) AS `totMval`,SUM(`tbl_trans_order_h`.`header_net_value`) AS `totAval`, SUM(`tbl_trans_order_h`.`total_discount_value`) AS `totDisval`');
            } else {
                $this->db->select('`tbl_trans_order_h`.`inv_date` AS `date_actual`,COUNT(DISTINCT(`tbl_trans_order_h`.`app_inv_no`)) AS `totBills`,COUNT(DISTINCT(`tbl_mst_outlet`.`id`)) AS `totPC` ,COUNT(DISTINCT(CASE WHEN (header_cancel_value>0 AND header_net_value=0) THEN `tbl_mst_outlet`.`id` END)) AS `totCancelPC`, COUNT(DISTINCT(CASE WHEN (inv_type =\'A\' AND header_net_value <> 0) THEN `tbl_mst_outlet`.`id` END)) AS `totActualPC` ,SUM(`tbl_trans_order_h`.`header_net_value`) AS `totBval`,SUM(`tbl_trans_order_h`.`header_cancel_value`) AS `totCval`,SUM(`tbl_trans_order_h`.`header_gr_value`) AS `totGval`,SUM(`tbl_trans_order_h`.`header_mr_value`) AS `totMval`,SUM(`tbl_trans_order_h`.`header_net_value`) AS `totAval`, SUM(`tbl_trans_order_h`.`total_discount_value`) AS `totDisval`');
            }
        } else {
            $this->db->select('app_inv_no, bill_name,tbl_mst_territory.reference_code as ro,header_net_value,header_cancel_value,header_mr_value,header_gr_value,0 AS tot_f_val,total_discount_value,header_net_value,inv_date AS `date_actual`,inv_date AS `date_actual`');
        }
        $this->db->from('`tbl_trans_order_h`');
        $this->db->join('`tbl_mst_outlet`', '`tbl_trans_order_h`.`customer_id`=`tbl_mst_outlet`.`id`', 'INNER');
        $this->db->join('`tbl_mst_territory`', '`tbl_trans_order_h`.`territory_id`=`tbl_mst_territory`.`id`', 'INNER');
        $this->db->join('`tbl_mst_area_link_territory`', '`tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id`', 'INNER');
        $this->db->join('`tbl_mst_area`', '`tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id`', 'INNER');
        $this->db->join('`tbl_mst_range`', '`tbl_trans_order_h`.`range_id`=`tbl_mst_range`.`id`', 'INNER');

        $this->db->join('`tbl_mst_region_link_area`', '`tbl_mst_area`.`id`=`tbl_mst_region_link_area`.`area_id`', 'INNER');
        $this->db->join('`tbl_mst_region`', '`tbl_mst_region_link_area`.`region_id`=`tbl_mst_region`.`id`', 'INNER');
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

        if ($billingType == 'A') {
            if ($channel_id == 1) {
                $this->db->where('`tbl_trans_order_h`.`inv_type`', $billingType);
            } else {
                $this->db->where('`tbl_trans_order_h`.`inv_type`', 'B');
            }
            $this->db->where('`tbl_trans_order_h`.`inv_date`>=', $dateFrom);
            $this->db->where('`tbl_trans_order_h`.`inv_date`<=', $dateTo);
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
                $this->db->group_by('`tbl_trans_order_h`.`inv_date`');
            }
            //$this->db->order_by('`tbl_mst_territory`.`id`,`invh`.`date_actual`');
        } else {
            $this->db->where('`tbl_trans_order_h`.`inv_date`>=', $dateFrom);
            $this->db->where('`tbl_trans_order_h`.`inv_date`<=', $dateTo);

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
                $this->db->group_by('`tbl_trans_order_h`.`inv_date`');
            }
        }



        //echo $reportType;
        if ($reportType == 'summery_area') {//for area wise summery group them by area id
            if ($billingType == 'A') {
                $this->db->order_by('`tbl_mst_area`.`id`,`tbl_trans_order_h`.`inv_date`');
            } else {
                $this->db->order_by('`tbl_mst_area`.`id`,`tbl_trans_order_h`.`inv_date`');
            }
        } elseif ($reportType == 'summery') {
            if ($billingType == 'A') {
                $this->db->order_by('`tbl_trans_order_h`.`inv_date`');
            } else {
                $this->db->order_by('`tbl_trans_order_h`.`inv_date`');
            }
        } else {
            if ($billingType == 'A') {
                $this->db->order_by('`tbl_mst_territory`.`id`,`tbl_trans_order_h`.`inv_date`');
            } else {
                $this->db->order_by('`tbl_mst_territory`.`id`,`tbl_trans_order_h`.`inv_date`');
            }
        }
        //$this->db->order_by('`tbl_mst_territory`.`id`,`invh`.`date_book`');
        $queryData = $this->db->get();
        $resultData = $queryData->result_array();
        //echo $this->db->last_query().'<br>';
        return $resultData;
    }

    //GET ORDER DATA OLD SYSTEM
    function getOrdersHOld($invNo) {
        $this->db->select('invh.invno,shop_mst.sh_name as bill_name,invh.ro_cd as ro,tot_b_val, `tot_c_val`,tot_m_val as header_mr_value,tot_g_val as header_gr_value,tot_f_val,tot_dis as header_discount_value,tot_dis as total_discount_value,tot_a_val as header_net_value,date_book,date_actual,(`tot_b_val`-`tot_c_val`) as subtotal');
        $this->db->from('`invh`');
        $this->db->join('`shop_mst`', '`invh`.`ag_cd`=`shop_mst`.`sh_ag_cd` AND `invh`.`ro_cd`=`shop_mst`.`sh_ro_cd` AND `invh`.`sh_cd`=`shop_mst`.`sh_cd`', 'INNER');
        $this->db->join('`tbl_mst_territory`', '`invh`.`ag_cd`=`tbl_mst_territory`.`reference_code`', 'INNER');
        $this->db->join('`tbl_mst_area_link_territory`', '`tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id`', 'INNER');
        $this->db->join('`tbl_mst_area`', '`tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id`', 'INNER');
        $this->db->join('`tbl_mst_range`', '`invh`.`cd`=`tbl_mst_range`.`range_name`', 'INNER');

        $this->db->where('`invh`.`invno`', $invNo);

        $this->db->order_by('`invh`.`date_book`');
        $queryData = $this->db->get();
        $resultData = $queryData->row();
        //echo $this->db->last_query();
        return $resultData;
    }

    //GET ORDER DATA OLD SYSTEM
    function getOrdersDOld($invNo = null, $dateBookFrom = null, $dateBookTo = null, $rptType = 'details', $territoryID = null, $dateActualFrom = null, $dateActualTo = null) {
        if ($rptType == 'details_line_free') {
            $this->db->select('invh.ag_cd,invd.item,date_book,date_actual,invd.f_qty,a_Qty,up');
            $this->db->where('invh.b_a', 'A');
            $this->db->where('invh.d <>', 'M');
            $this->db->where('invh.tot_a_val <>', 0);
            $this->db->where('invd.f_qty>', 0);
            $this->db->order_by('`invh`.`date_book`');
        } elseif ($rptType == 'details_line_free_items') {
            $this->db->select('DISTINCT(invd.item) AS item,`item_mst`.`item_code`,`item_mst`.`des`');
            $this->db->where('invh.b_a', 'A');
            $this->db->where('invh.d <>', 'M');
            $this->db->where('invh.tot_a_val <>', 0);
            $this->db->where('invd.f_qty>', 0);
        } elseif ($rptType == 'details_line_free_category') {
            $this->db->select('invh.ag_cd,invh.invno,item_mst.free_cat,date_book,date_actual,SUM(invd.f_qty) AS f_qty,SUM(a_Qty) AS a_Qty ,SUM(invd.f_qty) AS totf_qty,SUM(a_Qty) AS tota_Qty,SUM(up*f_qty) as FreeValue,SUM(up*a_Qty) as ActualValue');
            $this->db->where('invh.b_a', 'A');
            $this->db->where('invh.d <>', 'M');
            //$this->db->where('item_mst.free_cat', 'Isi Salt');//lakshitha test
            $this->db->where('invh.tot_a_val <>', 0);
            //$this->db->where('invd.f_qty <>', 0); 
            $this->db->having('tota_Qty>totf_qty'); 
            $this->db->group_by('invh.invno,item_mst.free_cat');
            $this->db->having('SUM(invd.f_qty)>', 0);
            //$this->db->having('SUM(invd.a_Qty)>',0);
            //$this->db->order_by('`invh`.`date_book`');
        } elseif ($rptType == 'details_line_free_category_list') {
            $this->db->select('DISTINCT(item_mst.free_cat) AS free_cat, company');
            $this->db->where('invh.b_a', 'A');
            $this->db->where('invh.d <>', 'M');
            $this->db->where('invh.tot_a_val <>', 0);
            //$this->db->where('invd.f_qty<>', 0);
            //
            //$this->db->where('item_mst.free_cat', 'isi salt');//lakshitha test
            $this->db->group_by('item_mst.free_cat');
            $this->db->order_by('`item_mst`.`company`,item_mst.free_cat');
        } else {
            //$this->db->select('invh.invno,invh.ro_cd as ro,tot_b_val,tot_m_val,tot_g_val,tot_f_val,tot_dis,tot_a_val,date_book,date_actual');
            $this->db->select('`invd`.`item` AS `item_code`, `item_mst`.`des` AS `item_desc`, `item_mst`.`uom`, `invd`.`ln`, `up` AS adjusted_unit_price, `b_qty` as booking_qty, `c_qty`, `m_qty` AS `mr_qty`, `g_qty` AS `gr_qty`, `f_qty` AS `fr_qty`, `a_Qty`, `ret_up` AS `gr_price`, `ret_up` AS `mr_price`,(up*(b_qty-c_qty)) AS d_subtotal, `invd`.`dis_per`, 0 AS `special_discount`, `invd`.`Auto`, `gr_up`, `mrf_qty` AS `mr_free_qty`, `grf_qty` AS `gr_free_qty`, `invd`.`distributor_stock_id`');
            $this->db->order_by('`invh`.`date_book`');
        }
        $this->db->from('`invh`');
        $this->db->join('`invd`', '`invh`.`invno`=`invd`.`invno`', 'INNER');
        $this->db->join('`item_mst`', '`invd`.`ln`=`item_mst`.`ln`', 'INNER');
        $this->db->join('`shop_mst`', '`invh`.`ag_cd`=`shop_mst`.`sh_ag_cd` AND `invh`.`ro_cd`=`shop_mst`.`sh_ro_cd` AND `invh`.`sh_cd`=`shop_mst`.`sh_cd`', 'INNER');
        //if ($rptType != 'details_line_free_category_list' && $rptType != 'details_line_free_category') {
        $this->db->join('`tbl_mst_territory`', '`invh`.`ag_cd`=`tbl_mst_territory`.`reference_code`', 'INNER');
        $this->db->join('`tbl_mst_area_link_territory`', '`tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id`', 'INNER');
        $this->db->join('`tbl_mst_area`', '`tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id`', 'INNER');
        //}
        $this->db->join('`tbl_mst_range`', '`invh`.`cd`=`tbl_mst_range`.`range_name`', 'INNER');

        if (!empty($invNo) && isset($invNo) && $invNo != NULL) {
            $this->db->where('`invh`.`invno`', $invNo);
        }
        if (!empty($dateBookFrom) && isset($dateBookFrom) && $dateBookFrom != NULL && !empty($dateBookTo) && isset($dateBookTo) && $dateBookTo != NULL) {
            $this->db->where('`invh`.`date_book`>=', $dateBookFrom);
            $this->db->where('`invh`.`date_book`<=', $dateBookTo);
        }
        if (!empty($dateActualFrom) && isset($dateActualFrom) && $dateActualFrom != NULL && !empty($dateActualTo) && isset($dateActualTo) && $dateActualTo != NULL) {
            $this->db->where('`invh`.`date_actual`>=', $dateActualFrom);
            $this->db->where('`invh`.`date_actual`<=', $dateActualTo);
        }
        if (!empty($territoryID) && isset($territoryID) && $territoryID != null) {
            $this->db->where('`tbl_mst_territory`.`id`', $territoryID);
        }

        //$this->db->order_by('`invh`.`date_book`');
        $queryData = $this->db->get();
        $resultData = $queryData->result_array();
        //echo $this->db->last_query(); //die();
        return $resultData;
    }

    //AGENCY FREE ISSUE RECONSILE
    function getFreeIssueData($year, $month, $dateFrom, $dateTo, $rptMethod = 'I') {//GET FREE ISSUE DATE AND ITEM
        if ($rptMethod == 'I') {
            $this->db->select('item_mst.item,free_issue_sch.date_from,free_issue_sch.date_to');
            $this->db->join('item_mst', 'free_issue_sch.free_cat=item_mst.free_cat', 'INNER');
        } elseif ($rptMethod == 'C') {
            $this->db->select('free_issue_sch.`free_cat`,free_issue_sch.date_from,free_issue_sch.date_to');
        }
        $this->db->from('`free_issue_sch`');
        $this->db->where(array('year' => $year, 'month' => $month, 'date_from<>' => $dateFrom, 'date_to<>' => $dateTo));
        $this->db->order_by('free_issue_sch.auto');

        $queryData = $this->db->get();
        $resultData = $queryData->result_array();
        //echo $this->db->last_query();
        return $resultData;
    }

    //GET AGENCY REP RELATED TARGET FROM TARGET VALUE TABLE OLD TABLE
    function getTarget($tyear, $tmonth, $area_cd = NULL) {
        $this->db->select('`area_cd`, `ag_cd`, `t_year`, `t_mon`, `area_name`, `ag_name`, `c_target`, `d_target`, `a_target`, `b_target`, `s_target`, `t_target`, `r_target`, `acs_pc_target`, `bd_pc_target`, `wd`, `p_wd`, `auto`');
        $this->db->from('`target_value`');
        if (!empty($area_cd) && isset($area_cd) && $area_cd != NULL && $area_cd != '-1') {
            $this->db->where('area_cd', $area_cd);
        }
        $this->db->where(array('t_year' => $tyear, 't_mon' => $tmonth));
        $queryData = $this->db->get();
        $resultData = $queryData->result_array();
        return $resultData;
    }

    function getCompanyWorkingDays($dateFrom, $dateTo) {
        $this->db->select('`company_date`, `is_working`');
        $this->db->from('tbl_mst_calendar');
        $this->db->where('company_date>=', $dateFrom);
        $this->db->where('company_date<=', $dateTo);
        $queryData = $this->db->get();
        $resultData = $queryData->result_array();
        return $resultData;
    }

    //GET OTHER RETURN MATERIALS DATA
    function getReturnOther($retNo = null, $dateBookFrom = null, $dateBookTo = null, $territoryID = null) {
        $this->db->select('`tbl_mst_area`.`id` AS `area_id`,`tbl_mst_area`.`area_name`,`tbl_mst_territory`.`reference_code`, `tbl_mst_territory`.`territory_name`,`tbl_mst_range`.`id` AS `range_id`,`tbl_mst_range`.`range_name`,tbl_mst_territory`.`id`,`return_other_h`.`return_no`, `ag_cd`, `return_type`, `return_date`, `return_other_h`.`active`, `cn_no`, `cn_date`, `stock`, `cd`,`return_other_d`.`item`, `return_other_d`.`item_code`, `return_other_d`.`unit_price`, `item_mst`.`des`, `return_qty`, `item_remove`');
        $this->db->from('`return_other_h`');
        $this->db->join('`return_other_d`', '`return_other_h`.`return_no`=`return_other_d`.`return_no`', 'INNER');
        $this->db->join('`item_mst`', '`return_other_d`.`item_code`=`item_mst`.`item`', 'INNER');
        $this->db->join('`tbl_mst_territory`', '`return_other_h`.`ag_cd`=`tbl_mst_territory`.`reference_code`', 'INNER');
        $this->db->join('`tbl_mst_area_link_territory`', '`tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id`', 'INNER');
        $this->db->join('`tbl_mst_area`', '`tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id`', 'INNER');
        $this->db->join('`tbl_mst_range`', '`return_other_h`.`cd`=`tbl_mst_range`.`range_name`', 'INNER');
        if (!empty($invNo) && isset($invNo) && $invNo != NULL) {
            $this->db->where('`return_other_h`.`return_no`', $retNo);
        }
        if (!empty($dateBookFrom) && isset($dateBookFrom) && $dateBookFrom != NULL && !empty($dateBookTo) && isset($dateBookTo) && $dateBookTo != NULL) {
            $this->db->where('`return_other_h`.`return_date`>=', $dateBookFrom);
            $this->db->where('`return_other_h`.`return_date`<=', $dateBookTo);
        }
        if (!empty($territoryID) && isset($territoryID) && $territoryID != null) {
            $this->db->where('`tbl_mst_territory`.`id`', $territoryID);
        }
        $this->db->order_by('`tbl_mst_area`.`id`,tbl_mst_territory`.`id`,`tbl_mst_range`.`id`,`item_mst`.`item`', $territoryID);
        $queryData = $this->db->get();
        $resultData = $queryData->result_array();
        //echo $this->db->last_query();
        return $resultData;
    }

    //GET CURRENT STOCK DATA
    function getStockData($area_id = null, $territoryID = null, $rangeID = null, $FromDate = null, $ToDate = null, $rpt_type = 'summery') {
        $this->db->select('tbl_trans_distributor_warehouse_stock.`distributor_id`, tbl_trans_distributor_warehouse_stock.`location_code`, tbl_trans_distributor_warehouse_stock.`item`,`tbl_mst_item`.`description`,`tbl_mst_item`.`uom`, SUM(`op_sellable`) AS op_sellable, SUM(`op_damage`) AS op_damage, SUM(`invoice_a_qty`) AS invoice_a_qty, SUM(`invoice_f_qty`) AS invoice_f_qty, SUM(`invoice_g_qty`) AS invoice_g_qty, SUM(`invoice_g_free_qty`) AS invoice_g_free_qty, SUM(`invoice_m_qty`) AS invoice_m_qty, SUM(`invoice_m_free_qty`) AS invoice_m_free_qty, SUM(`good_return_qty`) AS good_return_qty, SUM(`market_return_qty`) AS market_return_qty, SUM(`head_office_inv_qty`) AS head_office_inv_qty, SUM(`head_office_inv_qty_pending_accept`) AS head_office_inv_qty_pending_accept');
        $this->db->from('tbl_trans_distributor_warehouse_stock');
        $this->db->join('`tbl_mst_item`', 'tbl_trans_distributor_warehouse_stock.item=tbl_mst_item.item', 'INNER');
        $this->db->join('`tbl_mst_range_item`', 'tbl_mst_item.item=tbl_mst_range_item.item', 'INNER');
        $this->db->join('`tbl_mst_distributor_warehouse`', 'tbl_trans_distributor_warehouse_stock.location_code=tbl_mst_distributor_warehouse.id', 'INNER');
        $this->db->join('`tbl_mst_distributor`', 'tbl_mst_distributor_warehouse.distributor_id=tbl_mst_distributor.id', 'INNER');
        $this->db->join('`tbl_mst_territory`', '`tbl_mst_distributor`.`agency_code`=`tbl_mst_territory`.`reference_code`', 'INNER');
        $this->db->join('`tbl_mst_territory`', '`tbl_mst_distributor`.`agency_code`=`tbl_mst_territory`.`reference_code`', 'INNER');
        $this->db->join('`tbl_mst_area_link_territory`', '`tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id`', 'INNER');
        $this->db->join('`tbl_mst_area`', '`tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id`', 'INNER');
        if (!empty($areaID) && isset($areaID) && $areaID != null && $areaID != -1) {
            $this->db->where('`tbl_mst_area`.`id`', $areaID);
        }
        if (!empty($territoryID) && isset($territoryID) && $territoryID != null && $territoryID != 'null') {
            $this->db->where('`tbl_mst_territory`.`id`', $territoryID);
        }

        if (!empty($rangeID) && isset($rangeID) && $rangeID != null && $rangeID != 'null') {
            $this->db->where('`tbl_mst_range_item`.`range_id`', $rangeID);
        }

        if (!(!empty($areaID) && isset($areaID) && $areaID != null && $areaID != -1)) {
            $this->db->group_by('`item`');
        } else {
            $this->db->group_by('tbl_trans_distributor_warehouse_stock.`distributor_id`, `location_code`, `item`');
        }

        $queryData = $this->db->get();
        $resultData = $queryData->result_array();
        echo $this->db->last_query();
        return $resultData;
    }

    //GET CURRENT STOCK DATA AGENCY WISE
    /*
      function getStockDataCommon($areaID = null, $warehouseCommonId = null, $rangeID = null, $FromDate = null, $ToDate = null, $rpt_type = 'summery') {
      $this->db->select('`tbl_mst_distributor`.`agency_name`,tbl_trans_distributor_warehouse_stock.`distributor_id`, tbl_trans_distributor_warehouse_stock.`location_code`, tbl_trans_distributor_warehouse_stock.`item`,`tbl_mst_item`.`description`,`tbl_mst_item`.`uom`, SUM(`op_sellable`) AS op_sellable, SUM(`op_damage`) AS op_damage, SUM(`invoice_a_qty`) AS invoice_a_qty, SUM(`invoice_f_qty`) AS invoice_f_qty, SUM(`invoice_g_qty`) AS invoice_g_qty, SUM(`invoice_g_free_qty`) AS invoice_g_free_qty, SUM(`invoice_m_qty`) AS invoice_m_qty, SUM(`invoice_m_free_qty`) AS invoice_m_free_qty, SUM(`good_return_qty`) AS good_return_qty, SUM(`market_return_qty`) AS market_return_qty, SUM(`head_office_inv_qty`) AS head_office_inv_qty, SUM(`head_office_inv_qty_pending_accept`) AS head_office_inv_qty_pending_accept');
      $this->db->from('tbl_trans_distributor_warehouse_stock');
      $this->db->join('`tbl_mst_item`', 'tbl_trans_distributor_warehouse_stock.item=tbl_mst_item.item', 'INNER');
      $this->db->join('`tbl_mst_range_item`', 'tbl_mst_item.item=tbl_mst_range_item.item', 'INNER');
      $this->db->join('`tbl_mst_distributor_warehouse`', 'tbl_trans_distributor_warehouse_stock.location_code=tbl_mst_distributor_warehouse.id', 'INNER');
      $this->db->join('`tbl_mst_distributor`', 'tbl_mst_distributor_warehouse.distributor_id=tbl_mst_distributor.id', 'INNER');
      $this->db->join('`tbl_mst_distributor_warehouse_common`', '`tbl_mst_distributor_warehouse`.`id`=`tbl_mst_distributor_warehouse_common`.`warehouse_id`', 'INNER');
      $this->db->join('`tbl_mst_territory`', '`tbl_mst_distributor`.`agency_code`=`tbl_mst_territory`.`reference_code`', 'INNER');
      $this->db->join('`tbl_mst_area_link_territory`', '`tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id`', 'INNER');
      $this->db->join('`tbl_mst_area`', '`tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id`', 'INNER');
      if (!empty($areaID) && isset($areaID) && $areaID != null && $areaID != -1) {
      $this->db->where('`tbl_mst_area`.`id`', $areaID);
      }
      if (!empty($warehouseCommonId) && isset($warehouseCommonId) && $warehouseCommonId != null && $warehouseCommonId != 'null') {
      $this->db->where('`tbl_mst_distributor_warehouse_common`.`common_warehouse_id`', $warehouseCommonId);
      }

      if (!empty($rangeID) && isset($rangeID) && $rangeID != null && $rangeID != 'null') {
      $this->db->where('`tbl_mst_range_item`.`range_name`', $rangeID);
      }

      if (!(!empty($areaID) && isset($areaID) && $areaID != null && $areaID != -1)) {
      $this->db->group_by('`item`');
      } else {
      $this->db->group_by('tbl_mst_distributor_warehouse_common.`common_warehouse_id`, `item`');
      }

      $queryData = $this->db->get();
      $resultData = $queryData->result_array();
      echo $this->db->last_query();
      return $resultData;
      }
     */
    //GET CURRENT STOCK DATA AGENCY WISE
    function getStockDataCommon($areaID = null, $warehouseCommonId = null, $rangeID = null, $FromDate = null, $ToDate = null, $rpt_type = 'summery') {
        //$this->db->select('`tbl_mst_distributor`.`agency_name`,`tbl_mst_distributor`.`agency_code`,tbl_trans_distributor_warehouse_stock.`distributor_id`, tbl_trans_distributor_warehouse_stock.`location_code`, tbl_trans_distributor_warehouse_stock.`item`,`tbl_mst_item`.`description`,`tbl_mst_item`.`uom`, SUM(`op_sellable`) AS op_sellable, SUM(`op_damage`) AS op_damage, SUM(`invoice_a_qty`) AS invoice_a_qty, SUM(`invoice_f_qty`) AS invoice_f_qty, SUM(`invoice_g_qty`) AS invoice_g_qty, SUM(`invoice_g_free_qty`) AS invoice_g_free_qty, SUM(`invoice_m_qty`) AS invoice_m_qty, SUM(`invoice_m_free_qty`) AS invoice_m_free_qty, SUM(`good_return_qty`) AS good_return_qty, SUM(`market_return_qty`) AS market_return_qty, SUM(`head_office_inv_qty`) AS head_office_inv_qty, SUM(`head_office_inv_qty_pending_accept`) AS head_office_inv_qty_pending_accept');
        //without prices
//$this->db->select('`d`.`agency_name`, `d`.`agency_code`, `w`.`distributor_id`, `w`.id AS `location_code`, `tbl_trans_distributor_warehouse_stock`.`item`, `tbl_mst_item`.`description`, `tbl_mst_item`.`uom`, SUM(`op_sellable`) AS op_sellable, SUM(`op_damage`) AS op_damage, SUM(`invoice_a_qty`) AS invoice_a_qty, SUM(`invoice_f_qty`) AS invoice_f_qty, SUM(`invoice_g_qty`) AS invoice_g_qty, SUM(`invoice_g_free_qty`) AS invoice_g_free_qty, SUM(`invoice_m_qty`) AS invoice_m_qty, SUM(`invoice_m_free_qty`) AS invoice_m_free_qty, SUM(`good_return_qty`) AS good_return_qty, SUM(`market_return_qty`) AS market_return_qty, SUM(`head_office_inv_qty`) AS head_office_inv_qty, SUM(`head_office_inv_qty_pending_accept`) AS head_office_inv_qty_pending_accept');
        //with price
        $this->db->select('`d`.`agency_name`, `d`.`agency_code`, `w`.`distributor_id`, `w`.id AS `location_code`, `tbl_trans_distributor_warehouse_stock`.`item`, `tbl_mst_item`.`description`, `tbl_mst_item`.`uom`, SUM(`op_sellable`) AS op_sellable, SUM(`op_damage`) AS op_damage, SUM(`invoice_a_qty`) AS invoice_a_qty, SUM(`invoice_f_qty`) AS invoice_f_qty, SUM(`invoice_g_qty`) AS invoice_g_qty, SUM(`invoice_g_free_qty`) AS invoice_g_free_qty, SUM(`invoice_m_qty`) AS invoice_m_qty, SUM(`invoice_m_free_qty`) AS invoice_m_free_qty, SUM(`good_return_qty`) AS good_return_qty, SUM(`market_return_qty`) AS market_return_qty, SUM(`head_office_inv_qty`) AS head_office_inv_qty, SUM(`head_office_inv_qty_pending_accept`) AS head_office_inv_qty_pending_accept,SUM(`op_sellable`*`unit_price`) AS op_sellable_up, SUM(`op_damage`*`unit_price`) AS op_damage_up, SUM(`invoice_a_qty`*`unit_price`) AS invoice_a_qty_up, SUM(`invoice_f_qty`*0) AS invoice_f_qty_up, SUM(`invoice_g_qty`*`unit_price`) AS invoice_g_qty_up, SUM(`invoice_g_free_qty`*0) AS invoice_g_free_qty_up, SUM(`invoice_m_qty`*`unit_price`) AS invoice_m_qty_up, SUM(`invoice_m_free_qty`*0) AS invoice_m_free_qty_up, SUM(`good_return_qty`*`unit_price`) AS good_return_qty_up, SUM(`market_return_qty`*`unit_price`) AS market_return_qty_up, SUM(`head_office_inv_qty`*`unit_price`) AS head_office_inv_qty_up, SUM(`head_office_inv_qty_pending_accept`*`unit_price`) AS head_office_inv_qty_pending_accept_up');
        $this->db->from('tbl_trans_distributor_warehouse_stock');
        $this->db->join('`tbl_mst_item`', 'tbl_trans_distributor_warehouse_stock.item=tbl_mst_item.item', 'INNER');
        $this->db->join('`tbl_mst_range_item`', 'tbl_mst_item.item=tbl_mst_range_item.item', 'INNER');
        $this->db->join('`tbl_mst_distributor_warehouse`', 'tbl_trans_distributor_warehouse_stock.location_code=tbl_mst_distributor_warehouse.id', 'INNER');
        $this->db->join('`tbl_mst_distributor`', 'tbl_mst_distributor_warehouse.distributor_id=tbl_mst_distributor.id', 'INNER');
        $this->db->join('`tbl_mst_distributor_warehouse_common`', '`tbl_mst_distributor_warehouse`.`id`=`tbl_mst_distributor_warehouse_common`.`warehouse_id`', 'INNER');
        //$this->db->join('`tbl_mst_territory`', '`tbl_mst_distributor`.`agency_code`=`tbl_mst_territory`.`reference_code`', 'INNER');
        //$this->db->join('`tbl_mst_area_link_territory`', '`tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id`', 'INNER');
        //$this->db->join('`tbl_mst_area`', '`tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id`', 'INNER');
        //if (!empty($areaID) && isset($areaID) && $areaID != null && $areaID != -1) {
        //    $this->db->where('`tbl_mst_area`.`id`', $areaID);
        //}
        $this->db->join('tbl_mst_distributor_warehouse w', 'tbl_mst_distributor_warehouse_common.common_warehouse_id=w.id', 'INNER');
        $this->db->join('`tbl_mst_distributor` d', 'w.distributor_id=d.id', 'INNER');
        if (!empty($warehouseCommonId) && isset($warehouseCommonId) && $warehouseCommonId != null && $warehouseCommonId != 'null') {
            $this->db->where('`tbl_mst_distributor_warehouse_common`.`common_warehouse_id`', $warehouseCommonId);
        }

        if (!empty($rangeID) && isset($rangeID) && $rangeID != null && $rangeID != 'null') {
            $this->db->where('`tbl_mst_range_item`.`range_name`', $rangeID);
        }

        if (!(!empty($areaID) && isset($areaID) && $areaID != null && $areaID != -1)) {
            $this->db->group_by('`item`');
        } else {
            $this->db->group_by('tbl_mst_distributor_warehouse_common.`common_warehouse_id`, `item`');
        }
        $this->db->order_by('`d`.`agency_name`, `d`.`agency_code`, `tbl_mst_range_item`.`item`,`tbl_mst_range_item`.`category_sequence`, `tbl_mst_range_item`.`item_sequence`');
        $queryData = $this->db->get();
        $resultData = $queryData->result_array();
        echo $this->db->last_query();
        return $resultData;
    }

    //GET CURRENT STOCK DATA AGENCY WISE
    /*
      function getStockDataCommonCategory($areaID = null, $warehouseCommonId = null, $rangeID = null, $FromDate = null, $ToDate = null, $rpt_type = 'summery', $category = null) {
      if ($rpt_type == 'detail') {
      $this->db->select('`tbl_mst_distributor`.`agency_name`,`tbl_mst_distributor`.`agency_code`,`stock_post_date`,tbl_trans_distributor_warehouse_stock.`distributor_id`, tbl_trans_distributor_warehouse_stock.`location_code`, tbl_trans_distributor_warehouse_stock.`item`,`tbl_mst_item`.`description`,`tbl_mst_item`.`uom`, SUM(`op_sellable`) AS op_sellable, SUM(`op_damage`) AS op_damage, SUM(`invoice_a_qty`) AS invoice_a_qty, SUM(`invoice_f_qty`) AS invoice_f_qty, SUM(`invoice_g_qty`) AS invoice_g_qty, SUM(`invoice_g_free_qty`) AS invoice_g_free_qty, SUM(`invoice_m_qty`) AS invoice_m_qty, SUM(`invoice_m_free_qty`) AS invoice_m_free_qty, SUM(`good_return_qty`) AS good_return_qty, SUM(`market_return_qty`) AS market_return_qty, SUM(`head_office_inv_qty`) AS head_office_inv_qty, SUM(`head_office_inv_qty_pending_accept`) AS head_office_inv_qty_pending_accept');
      } else {
      $this->db->select('tbl_trans_distributor_warehouse_stock.`item`,`tbl_mst_item`.`description`,`tbl_mst_item`.`uom`, SUM(`op_sellable`) AS op_sellable, SUM(`op_damage`) AS op_damage, SUM(`invoice_a_qty`) AS invoice_a_qty, SUM(`invoice_f_qty`) AS invoice_f_qty, SUM(`invoice_g_qty`) AS invoice_g_qty, SUM(`invoice_g_free_qty`) AS invoice_g_free_qty, SUM(`invoice_m_qty`) AS invoice_m_qty, SUM(`invoice_m_free_qty`) AS invoice_m_free_qty, SUM(`good_return_qty`) AS good_return_qty, SUM(`market_return_qty`) AS market_return_qty, SUM(`head_office_inv_qty`) AS head_office_inv_qty, SUM(`head_office_inv_qty_pending_accept`) AS head_office_inv_qty_pending_accept');
      }

      $this->db->from('tbl_trans_distributor_warehouse_stock');
      $this->db->join('`tbl_mst_item`', 'tbl_trans_distributor_warehouse_stock.item=tbl_mst_item.item', 'INNER');
      $this->db->join('`tbl_mst_item_category_link_item`', 'tbl_mst_item.item=tbl_mst_item_category_link_item.item_id', 'INNER');
      $this->db->join('`tbl_mst_range_item`', 'tbl_mst_item.item=tbl_mst_range_item.item', 'INNER');
      $this->db->join('`tbl_mst_distributor_warehouse`', 'tbl_trans_distributor_warehouse_stock.location_code=tbl_mst_distributor_warehouse.id', 'INNER');
      $this->db->join('`tbl_mst_distributor`', 'tbl_mst_distributor_warehouse.distributor_id=tbl_mst_distributor.id', 'INNER');
      $this->db->join('`tbl_mst_distributor_warehouse_common`', '`tbl_mst_distributor_warehouse`.`id`=`tbl_mst_distributor_warehouse_common`.`warehouse_id`', 'INNER');
      $this->db->join('`tbl_mst_territory`', '`tbl_mst_distributor`.`agency_code`=`tbl_mst_territory`.`reference_code`', 'INNER');
      $this->db->join('`tbl_mst_area_link_territory`', '`tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id`', 'INNER');
      $this->db->join('`tbl_mst_area`', '`tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id`', 'INNER');
      if (!empty($areaID) && isset($areaID) && $areaID != null && $areaID != -1) {
      $this->db->where('`tbl_mst_area`.`id`', $areaID);
      }
      if (!empty($warehouseCommonId) && isset($warehouseCommonId) && $warehouseCommonId != null && $warehouseCommonId != 'null') {
      $this->db->where('`tbl_mst_distributor_warehouse_common`.`common_warehouse_id`', $warehouseCommonId);
      }
      if (!empty($category) && isset($category) && $category != null && $category != -1) {
      $this->db->where('`tbl_mst_item_category_link_item`.`category_id`', $category);
      }
      if (!empty($rangeID) && isset($rangeID) && $rangeID != null && $rangeID != 'null') {
      $this->db->where('`tbl_mst_range_item`.`range_name`', $rangeID);
      }


      if ($rpt_type == 'detail') {
      $this->db->group_by('tbl_mst_distributor_warehouse_common.`common_warehouse_id`, `item`');
      } else {
      $this->db->group_by('`item`');
      }
      $queryData = $this->db->get();
      $resultData = $queryData->result_array();
      //echo $this->db->last_query();
      return $resultData;
      }
     */
    //GET CURRENT STOCK DATA AGENCY WISE
    function getStockDataCommonCategory($areaID = null, $warehouseCommonId = null, $rangeID = null, $FromDate = null, $ToDate = null, $rpt_type = 'summery', $category = null) {
        if ($rpt_type == 'detail') {
            //$this->db->select('`tbl_mst_distributor`.`agency_name`,`tbl_mst_distributor`.`agency_code`,`stock_post_date`,tbl_trans_distributor_warehouse_stock.`distributor_id`, tbl_trans_distributor_warehouse_stock.`location_code`, tbl_trans_distributor_warehouse_stock.`item`,`tbl_mst_item`.`description`,`tbl_mst_item`.`uom`, SUM(`op_sellable`) AS op_sellable, SUM(`op_damage`) AS op_damage, SUM(`invoice_a_qty`) AS invoice_a_qty, SUM(`invoice_f_qty`) AS invoice_f_qty, SUM(`invoice_g_qty`) AS invoice_g_qty, SUM(`invoice_g_free_qty`) AS invoice_g_free_qty, SUM(`invoice_m_qty`) AS invoice_m_qty, SUM(`invoice_m_free_qty`) AS invoice_m_free_qty, SUM(`good_return_qty`) AS good_return_qty, SUM(`market_return_qty`) AS market_return_qty, SUM(`head_office_inv_qty`) AS head_office_inv_qty, SUM(`head_office_inv_qty_pending_accept`) AS head_office_inv_qty_pending_accept');
            //$this->db->select('`d`.`agency_name`, `d`.`agency_code`, `w`.`distributor_id`, `w`.id AS `location_code`, `tbl_trans_distributor_warehouse_stock`.`item`, `tbl_mst_item`.`description`, `tbl_mst_item`.`uom`, SUM(`op_sellable`) AS op_sellable, SUM(`op_damage`) AS op_damage, SUM(`invoice_a_qty`) AS invoice_a_qty, SUM(`invoice_f_qty`) AS invoice_f_qty, SUM(`invoice_g_qty`) AS invoice_g_qty, SUM(`invoice_g_free_qty`) AS invoice_g_free_qty, SUM(`invoice_m_qty`) AS invoice_m_qty, SUM(`invoice_m_free_qty`) AS invoice_m_free_qty, SUM(`good_return_qty`) AS good_return_qty, SUM(`market_return_qty`) AS market_return_qty, SUM(`head_office_inv_qty`) AS head_office_inv_qty, SUM(`head_office_inv_qty_pending_accept`) AS head_office_inv_qty_pending_accept');
            $this->db->select('`d`.`agency_name`, `d`.`agency_code`, `w`.`distributor_id`, `w`.id AS `location_code`, `tbl_trans_distributor_warehouse_stock`.`item`, `tbl_mst_item`.`description`, `tbl_mst_item`.`uom`,  SUM(`op_sellable`) AS op_sellable, SUM(`op_damage`) AS op_damage, SUM(`invoice_a_qty`) AS invoice_a_qty, SUM(`invoice_f_qty`) AS invoice_f_qty, SUM(`invoice_g_qty`) AS invoice_g_qty, SUM(`invoice_g_free_qty`) AS invoice_g_free_qty, SUM(`invoice_m_qty`) AS invoice_m_qty, SUM(`invoice_m_free_qty`) AS invoice_m_free_qty, SUM(`good_return_qty`) AS good_return_qty, SUM(`market_return_qty`) AS market_return_qty, SUM(`head_office_inv_qty`) AS head_office_inv_qty, SUM(`head_office_inv_qty_pending_accept`) AS head_office_inv_qty_pending_accept, SUM(`op_sellable`*`unit_price`) AS op_sellable_up, SUM(`op_damage`*`unit_price`) AS op_damage_up, SUM(`invoice_a_qty`*`unit_price`) AS invoice_a_qty_up, SUM(`invoice_f_qty`*0) AS invoice_f_qty_up, SUM(`invoice_g_qty`*`unit_price`) AS invoice_g_qty_up, SUM(`invoice_g_free_qty`*0) AS invoice_g_free_qty_up, SUM(`invoice_m_qty`*`unit_price`) AS invoice_m_qty_up, SUM(`invoice_m_free_qty`*0) AS invoice_m_free_qty_up, SUM(`good_return_qty`*`unit_price`) AS good_return_qty_up, SUM(`market_return_qty`*`unit_price`) AS market_return_qty_up, SUM(`head_office_inv_qty`*`unit_price`) AS head_office_inv_qty_up, SUM(`head_office_inv_qty_pending_accept`*`unit_price`) AS head_office_inv_qty_pending_accept_up');
        } else {
            //$this->db->select('tbl_trans_distributor_warehouse_stock.`item`,`tbl_mst_item`.`description`,`tbl_mst_item`.`uom`, SUM(`op_sellable`) AS op_sellable, SUM(`op_damage`) AS op_damage, SUM(`invoice_a_qty`) AS invoice_a_qty, SUM(`invoice_f_qty`) AS invoice_f_qty, SUM(`invoice_g_qty`) AS invoice_g_qty, SUM(`invoice_g_free_qty`) AS invoice_g_free_qty, SUM(`invoice_m_qty`) AS invoice_m_qty, SUM(`invoice_m_free_qty`) AS invoice_m_free_qty, SUM(`good_return_qty`) AS good_return_qty, SUM(`market_return_qty`) AS market_return_qty, SUM(`head_office_inv_qty`) AS head_office_inv_qty, SUM(`head_office_inv_qty_pending_accept`) AS head_office_inv_qty_pending_accept');
            $this->db->select('tbl_trans_distributor_warehouse_stock.`item`,`tbl_mst_item`.`description`,`tbl_mst_item`.`uom`,SUM(`op_sellable`) AS op_sellable, SUM(`op_damage`) AS op_damage, SUM(`invoice_a_qty`) AS invoice_a_qty, SUM(`invoice_f_qty`) AS invoice_f_qty, SUM(`invoice_g_qty`) AS invoice_g_qty, SUM(`invoice_g_free_qty`) AS invoice_g_free_qty, SUM(`invoice_m_qty`) AS invoice_m_qty, SUM(`invoice_m_free_qty`) AS invoice_m_free_qty, SUM(`good_return_qty`) AS good_return_qty, SUM(`market_return_qty`) AS market_return_qty, SUM(`head_office_inv_qty`) AS head_office_inv_qty, SUM(`head_office_inv_qty_pending_accept`) AS head_office_inv_qty_pending_accept, SUM(`op_sellable`*`unit_price`) AS op_sellable_up, SUM(`op_damage`*`unit_price`) AS op_damage_up, SUM(`invoice_a_qty`*`unit_price`) AS invoice_a_qty_up, SUM(`invoice_f_qty`*0) AS invoice_f_qty_up, SUM(`invoice_g_qty`*`unit_price`) AS invoice_g_qty_up, SUM(`invoice_g_free_qty`*0) AS invoice_g_free_qty_up, SUM(`invoice_m_qty`*`unit_price`) AS invoice_m_qty_up, SUM(`invoice_m_free_qty`*0) AS invoice_m_free_qty_up, SUM(`good_return_qty`*`unit_price`) AS good_return_qty_up, SUM(`market_return_qty`*`unit_price`) AS market_return_qty_up, SUM(`head_office_inv_qty`*`unit_price`) AS head_office_inv_qty_up, SUM(`head_office_inv_qty_pending_accept`*`unit_price`) AS head_office_inv_qty_pending_accept_up');
        }

        $this->db->from('tbl_trans_distributor_warehouse_stock');
        $this->db->join('`tbl_mst_item`', 'tbl_trans_distributor_warehouse_stock.item=tbl_mst_item.item', 'INNER');
        $this->db->join('`tbl_mst_item_category_link_item`', 'tbl_mst_item.item=tbl_mst_item_category_link_item.item_id', 'INNER');
        $this->db->join('`tbl_mst_range_item`', 'tbl_mst_item.item=tbl_mst_range_item.item', 'INNER');
        $this->db->join('`tbl_mst_distributor_warehouse`', 'tbl_trans_distributor_warehouse_stock.location_code=tbl_mst_distributor_warehouse.id', 'INNER');
        $this->db->join('`tbl_mst_distributor`', 'tbl_mst_distributor_warehouse.distributor_id=tbl_mst_distributor.id', 'INNER');
        $this->db->join('`tbl_mst_distributor_warehouse_common`', '`tbl_mst_distributor_warehouse`.`id`=`tbl_mst_distributor_warehouse_common`.`warehouse_id`', 'INNER');
        //$this->db->join('`tbl_mst_territory`', '`tbl_mst_distributor`.`agency_code`=`tbl_mst_territory`.`reference_code`', 'INNER');
        //$this->db->join('`tbl_mst_area_link_territory`', '`tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id`', 'INNER');
        //$this->db->join('`tbl_mst_area`', '`tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id`', 'INNER');
        //if (!empty($areaID) && isset($areaID) && $areaID != null && $areaID != -1) {
        //    $this->db->where('`tbl_mst_area`.`id`', $areaID);
        //}
        //AREA FILTER IF STOCK WRONG REMOVE THIS
        $this->db->join('tbl_mst_distributor_warehouse w', 'tbl_mst_distributor_warehouse_common.common_warehouse_id=w.id', 'INNER');
        $this->db->join('`tbl_mst_distributor` d', 'w.distributor_id=d.id', 'INNER');

        $this->db->join('`tbl_mst_territory`', '`d`.`agency_code`=`tbl_mst_territory`.`reference_code`', 'INNER');
        $this->db->join('`tbl_mst_area_link_territory`', '`tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id`', 'INNER');
        $this->db->join('`tbl_mst_area`', '`tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id`', 'INNER');
        if (!empty($areaID) && isset($areaID) && $areaID != null && $areaID != -1) {
            $this->db->where('`tbl_mst_area`.`id`', $areaID);
        }
        //AREA FILTER END


        if (!empty($warehouseCommonId) && isset($warehouseCommonId) && $warehouseCommonId != null && $warehouseCommonId != 'null') {
            $this->db->where('`tbl_mst_distributor_warehouse_common`.`common_warehouse_id`', $warehouseCommonId);
        }
        if (!empty($category) && isset($category) && $category != null && $category != -1) {
            $this->db->where('`tbl_mst_item_category_link_item`.`category_id`', $category);
        }
        if (!empty($rangeID) && isset($rangeID) && $rangeID != null && $rangeID != 'null') {
            $this->db->where('`tbl_mst_range_item`.`range_name`', $rangeID);
        }

        if ($rpt_type == 'detail') {
            $this->db->group_by('tbl_mst_distributor_warehouse_common.`common_warehouse_id`, `item`');
        } else {
            $this->db->group_by('`item`');
        }
        $queryData = $this->db->get();
        $resultData = $queryData->result_array();
        //echo $this->db->last_query();
        return $resultData;
    }

    function getCommonlocationStock($commonWarehouseCode, $range) {
        //  get last stock date
        $this->db->select('(`stock_h`.`st_no`) as st_no, (stock_h.st_date) as st_date');
        $this->db->from('stock_h');
        $this->db->join('tbl_mst_distributor', 'tbl_mst_distributor.agency_code=stock_h.ag_cd', 'INNER');
        $this->db->join('tbl_mst_distributor_warehouse', 'tbl_mst_distributor.id=tbl_mst_distributor_warehouse.distributor_id', 'INNER');
        $this->db->join('tbl_mst_distributor_warehouse_common', 'tbl_mst_distributor_warehouse.id=tbl_mst_distributor_warehouse_common.warehouse_id', 'INNER');
        $this->db->where('stock_h.post', 'P');
        $this->db->where('stock_h.cd', $range);
        $this->db->where('tbl_mst_distributor_warehouse_common.common_warehouse_id', $commonWarehouseCode);
        $this->db->order_by('stock_h.st_date', 'DESC');
        $q = $this->db->get();
        //echo $this->db->last_query();
        $r = $q->row();

        $this->db->select('agency_code,stock_h.ag_name,stock_h.st_no,stock_h.st_date,stock_h.post_date,stock_h.srv_time,stock_d.item,item_mst.des,sellable,damage');
        $this->db->from('stock_h');
        $this->db->join('stock_d', 'stock_h.st_no=stock_d.st_no', 'INNER');
        $this->db->join('item_mst', 'stock_d.item=item_mst.item', 'INNER');
        $this->db->join('tbl_mst_distributor', 'tbl_mst_distributor.agency_code=stock_h.ag_cd', 'INNER');
        $this->db->join('tbl_mst_distributor_warehouse', 'tbl_mst_distributor.id=tbl_mst_distributor_warehouse.distributor_id', 'INNER');
        $this->db->join('tbl_mst_distributor_warehouse_common', 'tbl_mst_distributor_warehouse.id=tbl_mst_distributor_warehouse_common.warehouse_id', 'INNER');
        $this->db->where('tbl_mst_distributor_warehouse_common.common_warehouse_id', $commonWarehouseCode);
        $this->db->where('stock_h.post', 'P');
        $this->db->where('stock_h.cd', $range);
        $this->db->where('stock_h.st_no', $r->st_no);
        $query = $this->db->get();

        //echo $this->db->last_query();
        $resultb = $query->result_array();
        return $resultb;
    }

    function invoiceTransactionLog($commonWarehouseCode, $item, $range) {

        //  get last stock date
        $this->db->select('max(`stock_h`.`st_no`) as st_no, max(stock_h.st_date) as st_date');
        $this->db->from('stock_h');
        $this->db->join('tbl_mst_distributor', 'tbl_mst_distributor.agency_code=stock_h.ag_cd', 'INNER');
        $this->db->join('tbl_mst_distributor_warehouse', 'tbl_mst_distributor.id=tbl_mst_distributor_warehouse.distributor_id', 'INNER');
        $this->db->join('tbl_mst_distributor_warehouse_common', 'tbl_mst_distributor_warehouse.id=tbl_mst_distributor_warehouse_common.warehouse_id', 'INNER');
        $this->db->where('stock_h.post', 'P');
        $this->db->where('stock_h.cd', $range);
        $this->db->where('tbl_mst_distributor_warehouse_common.common_warehouse_id', $commonWarehouseCode);
        $q = $this->db->get();
        //echo $this->db->last_query();
        $r = $q->row();
        $fromDate = $r->st_date;
        $arr = array(
            'invh.cd' => $range,
            'invh.d <>' => 'M',
            'invh.tot_a_val <>' => 0,
            'invh.b_a' => 'A',
            'invh.date_actual>' => $fromDate
        );
        $this->db->select('agency_mst.ag_name,item_mst.item,item_mst.des,shop_mst.sh_ag_cd,shop_mst.sh_ro_cd, shop_mst.sh_cd, shop_mst.sh_name, invh.invno, invh.date_actual, invh.date_book, invd.b_qty, invd.c_qty, invd.g_qty, invd.grf_qty, invd.m_qty, invd.mrf_qty, invd.f_qty, invd.a_Qty');
        $this->db->from('invh');
        $this->db->join('invd', '`invh`.`invno`=`invd`.`invno`', 'INNER');
        $this->db->join('agency_mst', '`invh`.`ag_cd`=`agency_mst`.`ag_cd`', 'INNER');
        $this->db->join('item_mst', '`invd`.`item`=`item_mst`.`item`', 'INNER');
        $this->db->join('shop_mst', 'invh.ag_cd=shop_mst.sh_ag_cd AND invh.ro_cd=shop_mst.sh_ro_cd AND invh.sh_cd=shop_mst.sh_cd', 'INNER');
        $this->db->where('item_mst.item', $item);
        $this->db->where('invh.ag_cd IN (SELECT tbl_mst_distributor.agency_code FROM tbl_mst_distributor 
INNER JOIN tbl_mst_distributor_warehouse ON tbl_mst_distributor.id=tbl_mst_distributor_warehouse.distributor_id
INNER JOIN tbl_mst_distributor_warehouse_common ON tbl_mst_distributor_warehouse.id=tbl_mst_distributor_warehouse_common.warehouse_id
WHERE tbl_mst_distributor_warehouse_common.common_warehouse_id=' . $commonWarehouseCode . ')');
        $this->db->where($arr);
        $this->db->order_by('agency_mst.ag_name,invh.date_actual,invh.invno');
        $query = $this->db->get();
        //echo $this->db->last_query();
        $resultb = $query->result_array();
        return $resultb;
    }

    /////////////////////////////
    /* sandun */
    function getItemsPcTotals($areaID = null, $territoryID = null, $routeID = null, $categoryID = null, $billingType = null, $dateFrom = null, $dateTo = null, $reportType = 'summery', $channel_id = 1) {
        $qu = '';
        if ($reportType == 'pivot') {
            $this->db->trans_start();
            $qu = 'SET @sql=null;';
            $this->db->query($qu);
            $q_area = '';
            if (!empty($areaID) && isset($areaID) && $areaID != null && $areaID != -1) {
                $q_area = ' AND `tbl_mst_area`.`id`=' . $areaID;
            }
            $qu = 'SELECT
  GROUP_CONCAT(DISTINCT
    CONCAT(\'sum(case WHEN name= "\', name ,  \'" THEN `PC` ELSE 0 END) AS `\',  area_name,name, \' PC`\' ) 
  )  
INTO @sql
FROM  
(SELECT `area_name` ,`name`,`item`,`des`,SUM(`PC`) AS `PC`,SUM(`a_Qty`) AS `a_Qty`,SUM(`val`) AS `val` FROM 
(SELECT `tbl_mst_area`.`area_name` AS `area_name`,`tbl_mst_territory`.`territory_name` AS `name`,`invd`.`item` AS `item`, `item_mst`.`des` AS `des`,`invh`.`date_actual`,COUNT(DISTINCT(if(`invd`.`a_Qty`>0, `shop_mst`.`Auto`,null))) AS `PC`, SUM(`invd`.`a_Qty`) AS `a_Qty`,SUM(`invd`.`a_Qty`*`invd`.`up`) AS `val` FROM `invh` INNER JOIN `invd` ON `invh`.`invno`=`invd`.`invno` INNER JOIN `item_mst` ON `invd`.`item`=`item_mst`.`item` INNER JOIN `shop_mst` ON `invh`.`ag_cd`=`shop_mst`.`sh_ag_cd` AND `invh`.`ro_cd`=`shop_mst`.`sh_ro_cd` AND `invh`.`sh_cd`=`shop_mst`.`sh_cd` INNER JOIN `tbl_mst_territory` ON `invh`.`ag_cd`=`tbl_mst_territory`.`reference_code` INNER JOIN `tbl_mst_area_link_territory` ON `tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id` INNER JOIN `tbl_mst_area` ON `tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id` INNER JOIN `tbl_mst_range` ON `invh`.`cd`=`tbl_mst_range`.`range_name` WHERE `invh`.`date_actual` >=\'' . $dateFrom . '\' AND `invh`.`date_actual` <=\'' . $dateTo . '\' ' . $q_area . ' AND `item_mst`.`cat`=\'' . $categoryID . '\' AND `invh`.`tot_a_val`<>0 AND `invh`.`b_a`=\'A\' GROUP BY `tbl_mst_territory`.`territory_name`,`invd`.`item` ,`invh`.`date_actual`) a GROUP BY `area_name`,`name`,`item` ORDER BY `area_name`,`name`,`item`) a ORDER BY `area_name`,`name`,`item`;
';
            $this->db->query($qu);
            //echo $this->db->last_query() . '<br>';         
            $qu = '
SET @sql= CONCAT(\'SELECT  `item` AS `Item`,`des` AS `Description`, \',@sql ,\' FROM 
(SELECT `tbl_mst_area`.`area_name` AS `area_name`,`tbl_mst_territory`.`territory_name` AS `name`,`invd`.`item` AS `item`, `item_mst`.`des` AS `des`,`invh`.`date_actual`,COUNT(DISTINCT(if(`invd`.`a_Qty`>0, `shop_mst`.`Auto`,null))) AS `PC`, SUM(`invd`.`a_Qty`) AS `a_Qty`,SUM(`invd`.`a_Qty`*`invd`.`up`) AS `val` FROM `invh` INNER JOIN `invd` ON `invh`.`invno`=`invd`.`invno` INNER JOIN `item_mst` ON `invd`.`item`=`item_mst`.`item` INNER JOIN `shop_mst` ON `invh`.`ag_cd`=`shop_mst`.`sh_ag_cd` AND `invh`.`ro_cd`=`shop_mst`.`sh_ro_cd` AND `invh`.`sh_cd`=`shop_mst`.`sh_cd` INNER JOIN `tbl_mst_territory` ON `invh`.`ag_cd`=`tbl_mst_territory`.`reference_code` INNER JOIN `tbl_mst_area_link_territory` ON `tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id` INNER JOIN `tbl_mst_area` ON `tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id` INNER JOIN `tbl_mst_range` ON `invh`.`cd`=`tbl_mst_range`.`range_name` WHERE `invh`.`date_actual` >=\\\'' . $dateFrom . '\\\' AND `invh`.`date_actual` <=\\\'' . $dateTo . '\\\' ' . $q_area . ' AND `item_mst`.`cat`=\\\'' . $categoryID . '\\\' AND `invh`.`tot_a_val`<>0 AND `invh`.`b_a`=\\\'A\\\' GROUP BY `tbl_mst_territory`.`territory_name`,`invd`.`item` ,`invh`.`date_actual` ORDER BY `tbl_mst_area`.`area_name`,`tbl_mst_territory`.`territory_name`,`invd`.`item` ,`invh`.`date_actual`) a GROUP BY  `item` ORDER BY area_name,`name`,`item`\');
';
            $this->db->query($qu);
            //echo $this->db->last_query() . '<br>';
            $qu = 'PREPARE stmt FROM @sql;';
            $this->db->query($qu);
            $qu = 'EXECUTE stmt;';
            $this->db->query($qu);
            //$qu = 'DEALLOCATE PREPARE stmt;';
            //$this->db->query($qu);
            $queryData = $this->db->query($qu);
            //echo $this->db->last_query() . '<br>';
            $resultData['data'] = $queryData->result_array();
            $resultData['data_fields'] = $queryData->list_fields();
            $this->db->trans_complete();
            return $resultData;
        } else {
            $qu_grp = '';
            $append = '';
            if (!empty($areaID) && isset($areaID) && $areaID != null && $areaID != -1) {
                $append = $append . ' AND `tbl_mst_area`.`id`=' . $areaID;
            }
            if (!empty($territoryID) && isset($territoryID) && $territoryID != null && $territoryID != 'null') {
                $append = $append . ' AND `tbl_mst_territory`.`id`=' . $territoryID;
            }
            if (!empty($categoryID) && isset($categoryID) && $categoryID != null && $categoryID != 'null') {
                $append = $append . ' AND `item_mst`.`cat`=\'' . $categoryID . '\' ';
            }
            $append = $append . ' AND `invh`.`tot_a_val`<>0'; //not cancel bills  
            $append = $append . ' AND `invh`.`b_a`=\'A\''; //only actual bills
            if ($reportType == 'pcsummery') {
                $qu = 'SELECT `item`,`des`,SUM(`PC`) AS `PC`,SUM(`a_Qty`) AS `a_Qty`,SUM(`val`) AS `val` FROM (SELECT `invd`.`item` AS `item`, `item_mst`.`des` AS `des`,`invh`.`date_actual`,'
                        . 'COUNT(DISTINCT(if(`invd`.`a_Qty`>0, `shop_mst`.`Auto`,null))) AS `PC`, SUM(`invd`.`a_Qty`) AS `a_Qty`,SUM(`invd`.`a_Qty`*`invd`.`up`) AS `val` ';

                $qu_grp = 'GROUP BY `invd`.`item` ,`invh`.`date_actual`) a GROUP BY `item` ORDER BY `item`';
            } elseif ($reportType == 'pcsummery_territory') {

                $qu = 'SELECT `name`,`item`,`des`,SUM(`PC`) AS `PC`,SUM(`a_Qty`) AS `a_Qty`,SUM(`val`) AS `val` FROM (SELECT `tbl_mst_territory`.`territory_name` AS `name`,`invd`.`item` AS `item`, `item_mst`.`des` AS `des`,`invh`.`date_actual`,'
                        . 'COUNT(DISTINCT(if(`invd`.`a_Qty`>0, `shop_mst`.`Auto`,null))) AS `PC`, SUM(`invd`.`a_Qty`) AS `a_Qty`,SUM(`invd`.`a_Qty`*`invd`.`up`) AS `val` ';
                $qu_grp = 'GROUP BY `tbl_mst_territory`.`territory_name`,`invd`.`item` ,`invh`.`date_actual`) a GROUP BY `name`,`item`  ORDER BY `name`,`item`';
                /* $this->db->select('`invd`.`item` AS `item`, `item_mst`.`des` AS `des`, SUM(`invd`.`a_Qty`) AS `a_Qty`');
                  $this->db->from('`invh`');
                  $this->db->join('`invd`', '`invh`.`invno`=`invd`.`invno`', 'INNER');
                  $this->db->join('`item_mst`', '`invd`.`item`=`item_mst`.`item`', 'INNER');
                  $this->db->join('`shop_mst`', '`invh`.`ag_cd`=`shop_mst`.`sh_ag_cd` AND `invh`.`ro_cd`=`shop_mst`.`sh_ro_cd` AND `invh`.`sh_cd`=`shop_mst`.`sh_cd`', 'INNER');
                  $this->db->join('`tbl_mst_territory`', '`invh`.`ag_cd`=`tbl_mst_territory`.`reference_code`', 'INNER');
                  $this->db->join('`tbl_mst_area_link_territory`', '`tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id`', 'INNER');
                  $this->db->join('`tbl_mst_area`', '`tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id`', 'INNER');
                  $this->db->join('`tbl_mst_range`', '`invh`.`cd`=`tbl_mst_range`.`range_name`', 'INNER');
                  if (!empty($areaID) && isset($areaID) && $areaID != null && $areaID != -1) {
                  $this->db->where('`tbl_mst_area`.`id`', $areaID);
                  }
                  if (!empty($territoryID) && isset($territoryID) && $territoryID != null && $territoryID != 'null') {
                  $this->db->where('`tbl_mst_territory`.`id`', $territoryID);
                  }
                  if (!empty($categoryID) && isset($categoryID) && $categoryID != null && $categoryID != 'null') {
                  $this->db->where('`item_mst`.`cat`', $categoryID);
                  }

                  $this->db->where('`invh`.`date_actual`>=', $dateFrom);
                  $this->db->where('`invh`.`date_actual`<=', $dateTo);
                  $queryData = $this->db->get(); */
            }

            $qu .= 'FROM `invh` '
                    . 'INNER JOIN `invd` ON `invh`.`invno`=`invd`.`invno` '
                    . 'INNER JOIN `item_mst` ON `invd`.`item`=`item_mst`.`item` '
                    . 'INNER JOIN `shop_mst` ON `invh`.`ag_cd`=`shop_mst`.`sh_ag_cd` AND `invh`.`ro_cd`=`shop_mst`.`sh_ro_cd` AND `invh`.`sh_cd`=`shop_mst`.`sh_cd` '
                    . 'INNER JOIN `tbl_mst_territory` ON `invh`.`ag_cd`=`tbl_mst_territory`.`reference_code` '
                    . 'INNER JOIN `tbl_mst_area_link_territory` ON `tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id` '
                    . 'INNER JOIN `tbl_mst_area` ON `tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id` '
                    . 'INNER JOIN `tbl_mst_range` ON `invh`.`cd`=`tbl_mst_range`.`range_name` '
                    . 'WHERE `invh`.`date_actual` >= \'' . $dateFrom . '\' AND `invh`.`date_actual` <= \'' . $dateTo . '\' ' . $append . ' '
                    . $qu_grp;

            /*
              if ($reportType == 'summery_area') {//area wise sales summery data
              if ($billingType == 'A') {
              $this->db->select('`item_mst`.`item`, `item_mst`.`des`, `item_mst`.`cat`, sum(`invd`.`a_Qty`) as Qty, round(sum(`invd`.`a_Qty`*`invd`.`up`), 2) as Val');
              } else {
              $this->db->select('`item_mst`.`item`, `item_mst`.`des`, `item_mst`.`cat`, sum(`invd`.`a_Qty`) as Qty, round(sum(`invd`.`a_Qty`*`invd`.`up`), 2) as Val');
              }
              } elseif ($reportType == 'summery') {
              if ($billingType == 'A') {
              $this->db->select('`item_mst`.`item`, `item_mst`.`des`, `item_mst`.`cat`, sum(`invd`.`a_Qty`) as Qty, round(sum(`invd`.`a_Qty`*`invd`.`up`), 2) as Val');
              } else {
              $this->db->select('`item_mst`.`item`, `item_mst`.`des`, `item_mst`.`cat`, sum(`invd`.`a_Qty`) as Qty, round(sum(`invd`.`a_Qty`*`invd`.`up`), 2) as Val');
              }
              } elseif ($reportType == 'summery_territory') {
              if ($billingType == 'A') {
              $this->db->select('`item_mst`.`item`, `item_mst`.`des`, `item_mst`.`cat`, sum(`invd`.`a_Qty`) as Qty, round(sum(`invd`.`a_Qty`*`invd`.`up`), 2) as Val');
              } else {
              $this->db->select('`item_mst`.`item`, `item_mst`.`des`, `item_mst`.`cat`, sum(`invd`.`a_Qty`) as Qty, round(sum(`invd`.`a_Qty`*`invd`.`up`), 2) as Val');
              }
              } else {
              $this->db->select('`item_mst`.`item`, `item_mst`.`des`, `item_mst`.`cat`, sum(`invd`.`a_Qty`) as Qty, round(sum(`invd`.`a_Qty`*`invd`.`up`), 2) as Val');
              }
              $this->db->from('`area_h`');
              $this->db->join('`area_d`', 'area_h.area_cd=area_d.area_cd', 'INNER');
              $this->db->join('`invh`', 'area_d.ag_cd=invh.ag_cd', 'INNER');
              $this->db->join('`invd`', 'invh.invno=invd.invno', 'INNER');
              $this->db->join('`item_mst`', 'invd.item=item_mst.item', 'INNER');

              if (!empty($areaID) && isset($areaID) && $areaID != null && $areaID != -1) {
              $this->db->where('`area_h`.`area_cd`', $areaID);
              }

              if ($billingType == 'A') {
              $this->db->where('`invh`.`b_a`', $billingType);
              $this->db->where('`invh`.`date_actual`>=', $dateFrom);
              $this->db->where('`invh`.`date_actual`<=', $dateTo);
              if ($reportType == 'summery_territory') {
              $this->db->group_by('item_mst.des');
              }
              if ($reportType == 'summery_area') {//for area wise summery group them by area id
              $this->db->group_by('item_mst.des');
              }
              if (!empty($categoryID) && isset($categoryID) && $categoryID != null && $categoryID != 'null') {
              $this->db->where('`item_mst`.`cat`', $categoryID);
              } else {
              $this->db->group_by('`item_mst`.`des`');
              }
              if ($reportType == 'summery_area' || $reportType == 'summery' || $reportType == 'summery_territory') {
              $this->db->group_by('`item_mst`.`des`');
              }
              //$this->db->order_by('`tbl_mst_territory`.`id`,`invh`.`date_actual`');
              } else {
              $this->db->where('`invh`.`date_book`>=', $dateFrom);
              $this->db->where('`invh`.`date_book`<=', $dateTo);

              if ($reportType == 'summery_area' || $reportType == 'summery' || $reportType == 'summery_territory') {
              $this->db->group_by('`item_mst`.`des`');
              }
              }
             */
            $queryData = $this->db->query($qu);
            $resultData = $queryData->result_array();
            //echo $this->db->last_query() . '<br>';
            return $resultData;
        }
    }

    //AGENCY NON MOVING ITEMS
    function getNonMovings($locationID, $FromDate, $ToDate) {
        $query = '';
        if ($locationID == 'RM') {
            $query = "SELECT item_mst.item,	item_mst.des, SUM(invd.a_Qty) as Actual_Qty, SUM(invd.up*invd.a_Qty) as Actual_Val "
                    . "from `item_mst`
          INNER JOIN invd on item_mst.item=invd.item 									
          INNER JOIN invh on invd.invno=invh.invno          
          WHERE (									
          item_mst.item='RMSOWF60CU' or item_mst.item='RMSOWF60CH' or item_mst.item='RMSOWF60PR' or item_mst.item='RMSOWF60CF' or item_mst.item='RMSOW60GCR' or item_mst.item='RMSOW60GCH' or item_mst.item='RMSOW60GPR' or item_mst.item='RMSOW60GCF' or item_mst.item='RM-SO-P-161' or item_mst.item='RM-SO-P-162' or item_mst.item='RM-SO-P-163' or item_mst.item='RMSO070GCO' or item_mst.item='RMSO070GMS' or item_mst.item='RMSO070GCM' or item_mst.item='RMSO070GMB' or item_mst.item='RMSO01ISCH' or item_mst.item='RMSO04ISFI' or item_mst.item='RMSO03ISCF' or item_mst.item='RMSO02ISPR' or item_mst.item='VC-RS-090G-MK' or item_mst.item='VC-RS-090G-CF' or item_mst.item='VC-RS-090G-VC' or item_mst.item='VC-RS-090G-PC' or item_mst.item='VC-RS-090G-CC' or item_mst.item='VC-RS-090G-PR' or item_mst.item='VC-RS-090G-RC' or item_mst.item='VC-RS-050G-YC' or item_mst.item='VC-RS-250G-CH' or item_mst.item='VC-RS-010G-CO' or item_mst.item='VC-RS-050G-CO' or item_mst.item='VC-RS-400G-WF' or item_mst.item='VC-RS-050G-OR' or item_mst.item='VC-RS-050G-MA' or item_mst.item='VC-RS-050G-MF' or item_mst.item='RMSO060GCF' or item_mst.item='RMSO060GCR' or item_mst.item='VC-RS-380G-WH' or item_mst.item='VC-RS-380G-RE' or item_mst.item='RMSC015GSC' or item_mst.item='RMSC005GSC' or item_mst.item='RMIR006GIR' or item_mst.item='RMRC080GBC' or item_mst.item='RMRC080GBM' or item_mst.item='RMRC080GBC' or item_mst.item='RMRC080GBK' or item_mst.item='RMRC080GBD' or item_mst.item='RMRC080GBD' or item_mst.item='RMRC085GBS' or item_mst.item='RMSO060GCF' or item_mst.item='RMSOW65GCF' or item_mst.item='RMSOW65GCH' or item_mst.item='RMSOW65GNC' or item_mst.item='RMSOW65GPR' or item_mst.item='VC-RS-020G-MA' or item_mst.item='VC-RS-020G-MA' or item_mst.item='VC-RS-020G-MF' or item_mst.item='VC-RS-020G-OR' or item_mst.item='VC-RS-050G-MA' or item_mst.item='VC-RS-050G-MF' or item_mst.item='VC-RS-050G-OR' or item_mst.item='VS-RS-020G-MD' or item_mst.item='RMSO060GPR' or item_mst.item='RMSO090GHE' or item_mst.item='RMRC080GBH' or item_mst.item='RMSO090GHE' or item_mst.item='RMSO090GSS' or item_mst.item='HOSO250GCH'
          ) AND invh.date_actual>= '$FromDate' AND invh.date_actual<= '$ToDate' AND invh.b_a='a' and invh.tot_a_val<>0									
          GROUP by item_mst.item";
        } elseif ($locationID == 'DC') {
            $query = "SELECT item_mst.item,	item_mst.des, SUM(invd.a_Qty) as Actual_Qty, SUM(invd.up*invd.a_Qty) as Actual_Val "
                    . "from `item_mst`
          INNER JOIN invd on item_mst.item=invd.item
          INNER JOIN invh on invd.invno=invh.invno
          WHERE (									
            item_mst.item='RMCM48HASM' or item_mst.item='RMCM48HAME' or item_mst.item='RMCM48HALA' or item_mst.item='RMCM48HAXL' or item_mst.item='RMCM2PCSSM' or item_mst.item='RMCM2PCSME' or item_mst.item='RMCM2PCSLA' or item_mst.item='RMCM2PCSXL' or item_mst.item='RMCM4PCSSM' or item_mst.item='RMCM4PCSME' or	item_mst.item='RMCM4PCSLA' or item_mst.item='RMCM4PCSXL' or item_mst.item='DCHW030MCO' or item_mst.item='DCHW100MCO' or item_mst.item='DCCM012GDC' or item_mst.item='DCCM020GDC' or item_mst.item='DCCM012GNC' or item_mst.item='RMCM48HASM' or item_mst.item='RMCM48HAME' or item_mst.item='RMCM48HALA' or item_mst.item='RMCM48HAXL' or item_mst.item='RMCM2PCSSM' or item_mst.item='RMCM2PCSME' or item_mst.item='RMCM2PCSLA' or item_mst.item='RMCM2PCSXL' or item_mst.item='RMCM4PCSSM' or item_mst.item='RMCM4PCSME' or item_mst.item='RMCM4PCSLA' or item_mst.item='RMCM4PCSXL' or item_mst.item='DCHW030MCO' or item_mst.item='DCHW100MCO' or item_mst.item='DCCM012GDC' or item_mst.item='DCCM020GDC' or item_mst.item='DCCM020GNC' or item_mst.item='RMCM48HASM' or item_mst.item='RMCM48HAME' or item_mst.item='RMCM48HALA' or item_mst.item='RMCM48HAXL' or item_mst.item='RMCM2PCSSM' or item_mst.item='RMCM2PCSME' or item_mst.item='RMCM2PCSLA' or item_mst.item='RMCM2PCSXL' or item_mst.item='RMCM4PCSSM' or item_mst.item='RMCM4PCSME' or item_mst.item='RMCM4PCSLA' or item_mst.item='RMCM4PCSXL' or item_mst.item='DCHW030MCO' or item_mst.item='DCHW100MCO' or item_mst.item='DCCM012GDC' or item_mst.item='DCCM020GDC' or	item_mst.item='DCCM012GSD' or item_mst.item='DCCM020GSD' or item_mst.item='DCCM060GSD' or item_mst.item='DCCM012GSF' or item_mst.item='DCCM020GSF' or item_mst.item='DCCM060GSF' or item_mst.item='RMSW090MCL' or item_mst.item='DCSW090MTO' or item_mst.item='RMSW045GSC' or item_mst.item='DCCM130MBW' or	item_mst.item='RMYO01PDSI' or item_mst.item='RMYO02PDDO' or item_mst.item='RMYO10PDSU' or item_mst.item='DCYOSINGWI' or item_mst.item='DCYODOUBWI' or item_mst.item='RMYO10PDWI' or item_mst.item='DCCM1219BH' or item_mst.item='DCCM1220BH' or item_mst.item='DCCM1221BH' or item_mst.item='DCCM1222BH' or	item_mst.item='DCCM010GKO' or item_mst.item='DCCMN10GKO' or item_mst.item='DCCMN10GAT' or item_mst.item='DCCMS10GAT' or item_mst.item='DCCM10MLRH' or item_mst.item='DCCM15MLRH' or item_mst.item='DCCM25MLRH' or item_mst.item='DCDZ001DDC' or item_mst.item='DCDZ002DDS' or item_mst.item='DC-AS-10PD-DW' or item_mst.item='DC-AS-SING-DW' or item_mst.item='DC-PC-02PD-DW' or item_mst.item='DCPS10PDCF' or item_mst.item='RMSO090GHE' or item_mst.item='RMRC080GBH'
          ) AND invh.date_actual>= '$FromDate' AND invh.date_actual<= '$ToDate' AND invh.b_a='a' and invh.tot_a_val<>0									
          GROUP by item_mst.item";
        }
        $query = $this->db->query($query);
        $result = $query->result_array();
        return $result;
    }

    /* sandun */

    /* ------sandamal----- */

    /* ------getCancellationgetCancellation---- */

    function getCancellation($dateFrom, $dateTo, $agencyCode = 'a', $reportType = 'cancel-summery', $areaId, $rangeID = '-1', $territoryID = null) {
        if ($reportType == 'cancel-summery') {
            $this->db->select('SUM(CASE WHEN invh.tot_a_val=0 THEN 1 ELSE 0 END) As total_count,sum(tot_b_val) As total_booking_value,sum(tot_c_val) As total_cancel_value');
        } elseif ($reportType == 'cancel-territory_summery') {
            $this->db->select('SUM(CASE WHEN invh.tot_a_val=0 THEN 1 ELSE 0 END) As total_count,sum(tot_b_val) As total_booking_value,sum(tot_c_val) As total_cancel_value,tbl_mst_territory.territory_name As territory_name');
            $this->db->group_by('`tbl_mst_territory`.`territory_name`');
        } elseif ($reportType == 'cancel-territory_detail') {
            $this->db->select('`invh`.`invno`,`invh`.`date_book`,`invh`.`date_actual`,`invh`.`tot_b_val`,`invh`.`tot_c_val`,`invh`.`tot_a_val`,`tbl_mst_outlet`.`name`,`invh`.`ag_cd`,`invh`.`ro_cd`,`invh`.`sh_cd`');
        } elseif ($reportType == 'monthly-items-summery') {

            $this->db->select('`item_mst`.`item` As item,`item_mst`.`des` As name,sum(invd.a_Qty*invd.up) As sub_total,sum(invd.a_Qty) As Actual_qty');
        }

        $this->db->from('invh');
        if ($reportType == 'monthly-items-summery') {
            $this->db->join('`invd`', '`invh`.`invno`=`invd`.`invno`', 'INNER');
            $this->db->join('item_mst', '`invd`.`item`=`item_mst`.`item`', 'INNER');
        }
        $this->db->join('`shop_mst`', '`invh`.`ag_cd`=`shop_mst`.`sh_ag_cd` AND `invh`.`ro_cd`=`shop_mst`.`sh_ro_cd` AND `invh`.`sh_cd`=`shop_mst`.`sh_cd`', 'INNER');
        $this->db->join('`tbl_mst_outlet`', '`shop_mst`.`Auto`=`tbl_mst_outlet`.`reference_code`', 'INNER');
        $this->db->join('`tbl_mst_range`', '`invh`.`cd`=`tbl_mst_range`.`range_name`', 'INNER');
        $this->db->join('`tbl_mst_territory`', '`invh`.`ag_cd`=`tbl_mst_territory`.`reference_code`', 'INNER');
        $this->db->join('`tbl_mst_area_link_territory`', '`tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id`', 'INNER');
        $this->db->join('`tbl_mst_area`', '`tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id`', 'INNER');

        if (!empty($agencyCode) && isset($agencyCode) && $agencyCode != 'a') {

            $this->db->where('`tbl_mst_territory`.`id`', $agencyCode);
        }
        if ($areaId != -1) {

            $this->db->where('`tbl_mst_area`.`id`', $areaId);
        }
        if ($rangeID != -1) {
            $this->db->where('`tbl_mst_range`.`id`', $rangeID);
        }
        $check = array(
            '`invh`.`date_actual`>=' => $dateFrom,
            '`invh`.`date_actual`<=' => $dateTo,
            '`invh`.`b_a`' => 'A'
        );
        $this->db->where($check);
        if ($reportType == 'cancel-summery' || $reportType == 'cancel-territory_summery' || $reportType == 'cancel-territory_detail') {
            $this->db->where('(`invh`.`tot_a_val` = 0 OR (`invh`.`tot_a_val`!=0 AND `invh`.`tot_c_val`!=0))');
        }
        if ($reportType == 'monthly-items-summery') {
            $this->db->group_by('`item_mst`.`item`');
        }

        $this->db->order_by('`invh`.`date_actual`');
        $queryData = $this->db->get();
        $resultData = $queryData->result_array();
        //$resultData = $queryData->row();
        //echo $this->db->last_query();
        //print_r($resultData);
        //die();
        return $resultData;
    }

    function notInvoiceShops($dateFrom, $dateTo, $agencyCode = 'a', $reportType = 'summery', $areaId, $rangeID = '-1') {

        $this->db->select('`shop_mst`.`Auto`', '`inv`_`shop.Auto`');
        $this->db->FROM('shop_mst');
        $this->db->join('(SELECT DISTINCT shop_mst.Auto
        FROM `invh`
        RIGHT JOIN shop_mst ON invh.ag_cd=shop_mst.sh_ag_cd AND invh.ro_cd=shop_mst.sh_ro_cd AND invh.sh_cd=shop_mst.sh_cd
        INNER JOIN agency_mst on invh.ag_cd=agency_mst.ag_cd
        INNER JOIN area_d ON agency_mst.ag_cd=area_d.ag_cd
        INNER JOIN area_h ON area_d.area_cd=area_h.area_cd
        INNER JOIN `tbl_mst_range` ON `invh`.`cd`=`tbl_mst_range`.`range_name` 
        INNER JOIN `tbl_mst_territory` ON `invh`.`ag_cd`=`tbl_mst_territory`.`reference_code` 
        INNER JOIN `tbl_mst_area_link_territory` ON `tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id` 
        INNER JOIN `tbl_mst_area` ON `tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id` 
        WHERE invh.date_actual>=\'2021-09-01\' AND invh.date_actual<=\'2022-12-27\' AND invh.b_a=\'A\' AND invh.tot_a_val!=0 
        ORDER BY area_h.area_name,agency_mst.ag_name) inv_shop', 'shop_mst.Auto=inv_shop.Auto', 'left');
        $this->db->join('`tbl_mst_outlet`', '`shop_mst`.`Auto`=`tbl_mst_outlet`.`reference_code`', 'INNER');
        $this->db->join('`tbl_mst_route_link_outlet`', '`tbl_mst_outlet`.`id`=`tbl_mst_route_link_outlet`.`outlet_id`', 'INNER');
        $this->db->join('`tbl_mst_route`', '`tbl_mst_route_link_outlet`.`route_id`=`tbl_mst_route`.`id`', 'INNER');
        $this->db->join('`tbl_mst_territory_link_route`', '`tbl_mst_route`.`id`=`tbl_mst_territory_link_route`.`route_id`', 'INNER');
        $this->db->join('`tbl_mst_territory`', '`tbl_mst_territory_link_route`.`territory_id`=`tbl_mst_territory`.`id`', 'INNER');
        //$this->db->join('`tbl_mst_range`', '`invh`.`cd`=`tbl_mst_range`.`range_name`');
        //$this->db->join('`tbl_mst_territory`', '`invh`.`ag_cd`=`tbl_mst_territory`.`reference_code`', 'INNER');
        $this->db->join('`tbl_mst_area_link_territory`', '`tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id`', 'INNER');
        $this->db->join('`tbl_mst_area`', '`tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id`', 'INNER');
        $this->db->where('inv_shop.Auto IS NULL');

        //$this->db->where('(`invh`.`tot_a_val` = 0 OR (`invh`.`tot_a_val`!=0 AND `invh`.`tot_c_val`!=0))');
        $queryData = $this->db->get();
        $resultData = $queryData->result_array();
        //$resultData = $queryData->row();
        //echo $this->db->last_query();
        //print_r($resultData);
        //die();
        return $resultData;
    }

    //get Daily sales
    function getDailySales($area = null, $range = null, $datepickermonth = null) {
        $str = '';
        if (!empty($area) && isset($area) && $area != null && $area != -1) {
            $str .= ' AND area_h.area_cd=' . $area . ' ';
        }
        if (!empty($range) && isset($range) && $range != null && $range != -1) {

            /* if ($range == 'D') {
              $str .= ' AND (invh.cd=\'' . $range . '\' OR invh.cd=\'S\' OR invh.cd=\'T\') ';
              } else {
              $str .= ' AND (invh.cd=\'' . $range . '\' OR invh.cd=\'S\') ';
              } */

            if ($range == 'D') {
                $str .= ' AND (invh.cd=\'' . $range . '\' OR invh.cd=\'T\') ';
            } else {
                $str .= ' AND (invh.cd=\'' . $range . '\' ) ';
            }
        }
        $strQ = '';
        $monthNumber = date('m', strtotime($datepickermonth));
        $monthName = date('F', strtotime($datepickermonth));
        $year = date('Y', strtotime($datepickermonth));
        for ($n = 1; $n <= date('t', strtotime($datepickermonth)); $n++) {
            $strQ .= 'SUM(IF(month(invh.date_actual)=' . $monthNumber . ' AND year(invh.date_actual)=' . $year . ' AND day(invh.date_actual)=' . $n . ', (invh.tot_a_val+invh.tot_dis),0)) AS `' . $monthName . '-' . $n . '`,';
            $strQ .= 'COUNT(DISTINCT CASE WHEN (month(invh.date_actual)=' . $monthNumber . ' AND year(invh.date_actual)=' . $year . ' AND day(invh.date_actual)=' . $n . ') THEN shop_mst.Auto END) AS `' . $monthName . '-' . $n . '-pc`,';
        }
        $strBack = '';
        for ($k = 1; $k <= 6; $k++) {
            $monthNumberBack = date('m', strtotime($datepickermonth . ' -' . $k . ' month'));
            $monthNameBack = date('F', strtotime($datepickermonth . ' -' . $k . ' month'));
            $yearBack = date('Y', strtotime($datepickermonth . ' -' . $k . ' month'));
            $strBack .= ' SUM(IF(month(invh.date_actual)=' . $monthNumberBack . ' AND year(invh.date_actual)=' . $yearBack . ', invh.tot_a_val+invh.tot_dis,0)) AS `' . $monthNameBack . '-Total`, ';
        }
        $q = $this->db->query('SELECT tbl_mst_region.region_name,area_h.area_name,agency_mst.ag_name,invh.ag_cd,IF(invh.cd=\'T\',\'D\',invh.cd) AS cd,
 
' . $strQ . $strBack . ' 

SUM(IF(month(invh.date_actual)=' . $monthNumber . ' AND year(invh.date_actual)=' . $year . ', (invh.tot_a_val+invh.tot_dis),0)) AS `' . $monthName . '-Total` 


FROM invh  
INNER JOIN shop_mst ON invh.ag_cd=shop_mst.sh_ag_cd AND invh.ro_cd=shop_mst.sh_ro_cd AND invh.sh_cd=shop_mst.sh_cd 
INNER JOIN agency_mst ON invh.ag_cd=agency_mst.ag_cd 
INNER JOIN area_d ON agency_mst.ag_cd=area_d.ag_cd
INNER JOIN area_h ON area_d.area_cd=area_h.area_cd
INNER JOIN tbl_mst_region_link_area on area_h.area_cd=tbl_mst_region_link_area.area_id
INNER JOIN tbl_mst_region ON tbl_mst_region_link_area.region_id=tbl_mst_region.id
WHERE invh.date_actual>=\'' . date('Y-m-01', strtotime($datepickermonth . ' -6 month')) . '\' AND invh.date_actual<=\'' . date('Y-m-t', strtotime($datepickermonth)) . '\' AND invh.b_a=\'A\' AND invh.tot_a_val<>0 ' . $str . '
GROUP BY area_h.area_name,agency_mst.ag_name,invh.ag_cd,invh.cd
ORDER BY tbl_mst_region.id,area_h.area_name,agency_mst.ag_name,invh.ag_cd,cd');
        $result = $q->result_array();
        //echo $this->db->last_query();
        return $result;
    }

    function getTotalSalesandPc($area = null, $range = null, $datepickermonth = null) {
        $str = '';
        if (!empty($area) && isset($area) && $area != null && $area != -1) {
            $str .= ' AND area_h.area_cd=' . $area . ' ';
        }
        if (!empty($range) && isset($range) && $range != null && $range != -1) {

            /* if ($range == 'D') {
              $str .= ' AND (invh.cd=\'' . $range . '\' OR invh.cd=\'S\' OR invh.cd=\'T\') ';
              } else {
              $str .= ' AND (invh.cd=\'' . $range . '\' OR invh.cd=\'S\') ';
              } */

            if ($range == 'D') {
                $str .= ' AND (invh.cd=\'' . $range . '\' OR invh.cd=\'T\') ';
            } else {
                $str .= ' AND (invh.cd=\'' . $range . '\') ';
            }
        }
        $strBack = '';
        for ($k = 1; $k <= 6; $k++) {
            $monthNumberBack = date('m', strtotime($datepickermonth . ' -' . $k . ' month'));
            $monthNameBack = date('F', strtotime($datepickermonth . ' -' . $k . ' month'));
            $yearBack = date('Y', strtotime($datepickermonth . ' -' . $k . ' month'));
            $strBack .= 'COUNT(IF(month(a.dates)=' . $monthNumberBack . ' AND year(a.dates)=' . $yearBack . ', a.dates,null)) as ' . $monthNameBack . '_WD, SUM(IF(month(a.dates)=' . $monthNumberBack . ' AND year(a.dates)=' . $yearBack . ', a.pc,0)) as ' . $monthNameBack . '_TotPC ,';
        }
        $query = 'select  
            ' . $strBack . '
            a.ag_cd
from (SELECT invh.ag_cd AS ag_cd,invh.date_actual AS dates, COUNT(DISTINCT shop_mst.Auto) AS pc
FROM invh 
INNER JOIN shop_mst ON invh.ag_cd=shop_mst.sh_ag_cd AND invh.ro_cd=shop_mst.sh_ro_cd AND invh.sh_cd=shop_mst.sh_cd 
INNER JOIN agency_mst ON invh.ag_cd=agency_mst.ag_cd 
INNER JOIN area_d ON agency_mst.ag_cd=area_d.ag_cd
INNER JOIN area_h ON area_d.area_cd=area_h.area_cd
WHERE invh.date_actual>=\'' . date('Y-m-01', strtotime($datepickermonth . ' -6 month')) . '\' AND invh.date_actual<=\'' . date('Y-m-t', strtotime($datepickermonth)) . '\' AND invh.b_a=\'A\' AND invh.tot_a_val<>0 ' . $str . '
GROUP BY invh.ag_cd,invh.date_actual ) a GROUP BY a.ag_cd';
        $result = $this->db->query($query)->result_array();
        //echo $this->db->last_query();
        return $result;
    }

    //GET CATEGORY WISE REPORT
    function getCategoryList($purpose_id, $cat_id = null) {
        $this->db->select('`tbl_mst_item_category`.`id`, `tbl_mst_item_category`.`name`, `tbl_mst_item_category`.`valid_from`, `tbl_mst_item_category`.`valid_to`, `tbl_mst_item_category`.`isact`,bg_color,font_color,ranges');
        $this->db->from('tbl_mst_item_category');
        $this->db->join('tbl_mst_item_category_purpose_link_category', 'tbl_mst_item_category.id=tbl_mst_item_category_purpose_link_category.category_id', 'INNER');
        $this->db->join('tbl_mst_item_category_purpose', 'tbl_mst_item_category_purpose_link_category.purpose_id=tbl_mst_item_category_purpose.id', 'INNER');
        $this->db->where('`tbl_mst_item_category_purpose`.`id`', $purpose_id);
        if (!empty($cat_id) && isset($cat_id) && $cat_id != null) {
            $this->db->where('`tbl_mst_item_category`.`id`', $cat_id);
        }
        $queryData = $this->db->get();
        if (!empty($cat_id) && isset($cat_id) && $cat_id != null) {
            $resultData = $queryData->row();
        } else {
            $resultData = $queryData->result_array();
        }
        //echo $this->db->last_query().'<br>';
        //die();
        return $resultData;
    }

    function getDailySalesCategory($area = null, $range = null, $datepickermonth = null, $category = null, $type = 'value') {
        $str = '';
        if (!empty($area) && isset($area) && $area != null && $area != -1) {
            $str .= ' AND area_h.area_cd=' . $area . ' ';
        }
        if (!empty($range) && isset($range) && $range != null && $range != -1) {
            if ($range == 'D') {
                $str .= ' AND (invh.cd=\'' . $range . '\' OR invh.cd=\'S\' OR invh.cd=\'T\') ';
            } else {
                $str .= ' AND (invh.cd=\'' . $range . '\' OR invh.cd=\'S\') ';
            }
        }
        $strQ = '';
        $monthNumber = date('m', strtotime($datepickermonth));
        $monthName = date('F', strtotime($datepickermonth));
        $year = date('Y', strtotime($datepickermonth));
        for ($n = 1; $n <= date('t', strtotime($datepickermonth)); $n++) {
            if ($type == 'value') {
                $strQ .= 'SUM(IF(month(invh.date_actual)=' . $monthNumber . ' AND year(invh.date_actual)=' . $year . ' AND day(invh.date_actual)=' . $n . ', (invd.a_Qty*invd.up),0)) AS `' . $monthName . '-' . $n . '`,';
            } else {
                $strQ .= 'SUM(IF(month(invh.date_actual)=' . $monthNumber . ' AND year(invh.date_actual)=' . $year . ' AND day(invh.date_actual)=' . $n . ', (invd.a_Qty*item_mst.pack),0)) AS `' . $monthName . '-' . $n . '`,';
            }
            $strQ .= 'COUNT(DISTINCT CASE WHEN (month(invh.date_actual)=' . $monthNumber . ' AND year(invh.date_actual)=' . $year . ' AND day(invh.date_actual)=' . $n . ') THEN shop_mst.Auto END) AS `' . $monthName . '-' . $n . '-pc`,';
        }
        $strBack = '';
        for ($k = 1; $k <= 6; $k++) {
            $monthNumberBack = date('m', strtotime($datepickermonth . ' -' . $k . ' month'));
            $monthNameBack = date('F', strtotime($datepickermonth . ' -' . $k . ' month'));
            $yearBack = date('Y', strtotime($datepickermonth . ' -' . $k . ' month'));
            if ($type == 'value') {
                $strBack .= ' SUM(IF(month(invh.date_actual)=' . $monthNumberBack . ' AND year(invh.date_actual)=' . $yearBack . ', invd.a_Qty*invd.up,0)) AS `' . $monthNameBack . '-Total`, ';
            } else {
                $strBack .= ' SUM(IF(month(invh.date_actual)=' . $monthNumberBack . ' AND year(invh.date_actual)=' . $yearBack . ', invd.a_Qty*item_mst.pack,0)) AS `' . $monthNameBack . '-Total`, ';
            }
        }
        $strK = '';
        if ($type == 'value') {
            $strK = 'SUM(IF(month(invh.date_actual)=' . $monthNumber . ' AND year(invh.date_actual)=' . $year . ', (invd.a_Qty*invd.up),0)) AS `' . $monthName . '-Total` ';
        } else {
            $strK = 'SUM(IF(month(invh.date_actual)=' . $monthNumber . ' AND year(invh.date_actual)=' . $year . ', (invd.a_Qty*item_mst.pack),0)) AS `' . $monthName . '-Total` ';
        }
        $q = $this->db->query('SELECT tbl_mst_region.region_name,area_h.area_name,agency_mst.ag_name,invh.ag_cd,IF(invh.cd=\'T\',\'D\',invh.cd) AS cd,
 
' . $strQ . $strBack . $strK . ' 

FROM invh  
INNER JOIN invd ON invh.invno=invd.invno
INNER JOIN item_mst ON invd.item=item_mst.item
INNER JOIN tbl_mst_item_category_link_item ON invd.item=tbl_mst_item_category_link_item.item_id
INNER JOIN tbl_mst_item_category ON tbl_mst_item_category_link_item.category_id=tbl_mst_item_category.id
INNER JOIN tbl_mst_item_category_purpose_link_category ON tbl_mst_item_category.id=tbl_mst_item_category_purpose_link_category.category_id
INNER JOIN tbl_mst_item_category_purpose ON tbl_mst_item_category_purpose_link_category.purpose_id=tbl_mst_item_category_purpose.id
INNER JOIN shop_mst ON invh.ag_cd=shop_mst.sh_ag_cd AND invh.ro_cd=shop_mst.sh_ro_cd AND invh.sh_cd=shop_mst.sh_cd 
INNER JOIN agency_mst ON invh.ag_cd=agency_mst.ag_cd 
INNER JOIN area_d ON agency_mst.ag_cd=area_d.ag_cd
INNER JOIN area_h ON area_d.area_cd=area_h.area_cd
INNER JOIN tbl_mst_region_link_area on area_h.area_cd=tbl_mst_region_link_area.area_id
INNER JOIN tbl_mst_region ON tbl_mst_region_link_area.region_id=tbl_mst_region.id
WHERE invd.a_Qty<>0 AND tbl_mst_item_category_purpose.id=3 AND tbl_mst_item_category.id=' . $category . ' AND invh.date_actual>=\'' . date('Y-m-01', strtotime($datepickermonth . ' -6 month')) . '\' AND invh.date_actual<=\'' . date('Y-m-t', strtotime($datepickermonth)) . '\' AND invh.b_a=\'A\' AND invh.tot_a_val<>0 ' . $str . '
GROUP BY area_h.area_name,agency_mst.ag_name,invh.ag_cd,invh.cd,tbl_mst_item_category.id
ORDER BY tbl_mst_region.id,area_h.area_name,agency_mst.ag_name,invh.ag_cd,cd');
        $result = $q->result_array();
        //echo $this->db->last_query();
        return $result;
    }

    function getTotalSalesandPcCategory($area = null, $range = null, $datepickermonth = null, $category = null) {
        $str = '';
        if (!empty($area) && isset($area) && $area != null && $area != -1) {
            $str .= ' AND area_h.area_cd=' . $area . ' ';
        }
        if (!empty($range) && isset($range) && $range != null && $range != -1) {
            if ($range == 'D') {
                $str .= ' AND (invh.cd=\'' . $range . '\' OR invh.cd=\'S\' OR invh.cd=\'T\') ';
            } else {
                $str .= ' AND (invh.cd=\'' . $range . '\' OR invh.cd=\'S\') ';
            }
        }
        $strBack = '';
        for ($k = 1; $k <= 6; $k++) {
            $monthNumberBack = date('m', strtotime($datepickermonth . ' -' . $k . ' month'));
            $monthNameBack = date('F', strtotime($datepickermonth . ' -' . $k . ' month'));
            $yearBack = date('Y', strtotime($datepickermonth . ' -' . $k . ' month'));
            $strBack .= 'COUNT(IF(month(a.dates)=' . $monthNumberBack . ' AND year(a.dates)=' . $yearBack . ', a.dates,null)) as ' . $monthNameBack . '_WD, SUM(IF(month(a.dates)=' . $monthNumberBack . ' AND year(a.dates)=' . $yearBack . ', a.pc,0)) as ' . $monthNameBack . '_TotPC ,';
        }
        $query = 'select  
            ' . $strBack . '
            a.ag_cd
from (SELECT invh.ag_cd AS ag_cd,invh.date_actual AS dates, COUNT(DISTINCT shop_mst.Auto) AS pc
FROM invh 
INNER JOIN invd ON invh.invno=invd.invno
INNER JOIN tbl_mst_item ON invd.ln=tbl_mst_item.ln
INNER JOIN tbl_mst_item_category_link_item ON tbl_mst_item.item=tbl_mst_item_category_link_item.item_id
INNER JOIN tbl_mst_item_category ON tbl_mst_item_category_link_item.category_id=tbl_mst_item_category.id
INNER JOIN tbl_mst_item_category_purpose_link_category ON tbl_mst_item_category.id=tbl_mst_item_category_purpose_link_category.category_id
INNER JOIN tbl_mst_item_category_purpose ON tbl_mst_item_category_purpose_link_category.purpose_id=tbl_mst_item_category_purpose.id
INNER JOIN shop_mst ON invh.ag_cd=shop_mst.sh_ag_cd AND invh.ro_cd=shop_mst.sh_ro_cd AND invh.sh_cd=shop_mst.sh_cd 
INNER JOIN agency_mst ON invh.ag_cd=agency_mst.ag_cd 
INNER JOIN area_d ON agency_mst.ag_cd=area_d.ag_cd
INNER JOIN area_h ON area_d.area_cd=area_h.area_cd
WHERE invd.a_Qty>0 AND tbl_mst_item_category_purpose.id=3 AND tbl_mst_item_category.id=' . $category . ' AND invh.date_actual>=\'' . date('Y-m-01', strtotime($datepickermonth . ' -6 month')) . '\' AND invh.date_actual<=\'' . date('Y-m-t', strtotime($datepickermonth)) . '\' AND invh.b_a=\'A\' AND invh.tot_a_val<>0 ' . $str . '
GROUP BY invh.ag_cd,invh.date_actual ) a GROUP BY a.ag_cd';
        $result = $this->db->query($query)->result_array();
        echo $this->db->last_query();
        return $result;
    }

    /*
     * ANDROID APP SALE DATA
     *
     *
     */

    function getTotalSalesandPcCategoryMobile($area = null, $range = null, $datepickermonth = null, $category = null) {
        $str = '';
        if (!empty($area) && isset($area) && $area != null && $area != -1) {
            $str .= ' AND area_h.area_cd=' . $area . ' ';
        }
        if (!empty($range) && isset($range) && $range != null && $range != -1) {
            if ($range == 'D') {
                $str .= ' AND (invh.cd=\'' . $range . '\' OR invh.cd=\'S\' OR invh.cd=\'T\') ';
            } else {
                $str .= ' AND (invh.cd=\'' . $range . '\' OR invh.cd=\'S\') ';
            }
        }
        $strBack = '';
        for ($k = 1; $k <= 6; $k++) {
            $monthNumberBack = date('m', strtotime($datepickermonth . ' -' . $k . ' month'));
            $monthNameBack = date('F', strtotime($datepickermonth . ' -' . $k . ' month'));
            $yearBack = date('Y', strtotime($datepickermonth . ' -' . $k . ' month'));
            $strBack .= 'COUNT(IF(month(a.dates)=' . $monthNumberBack . ' AND year(a.dates)=' . $yearBack . ', a.dates,null)) as ' . $monthNameBack . '_WD, SUM(IF(month(a.dates)=' . $monthNumberBack . ' AND year(a.dates)=' . $yearBack . ', a.pc,0)) as ' . $monthNameBack . '_TotPC ,';
        }
        $query = 'select  
            ' . $strBack . '
            a.ag_cd
from (SELECT invh.ag_cd AS ag_cd,invh.date_actual AS dates, COUNT(DISTINCT shop_mst.Auto) AS pc
FROM invh 
INNER JOIN invd ON invh.invno=invd.invno
INNER JOIN tbl_mst_item_category_link_item ON invd.item=tbl_mst_item_category_link_item.item_id
INNER JOIN tbl_mst_item_category ON tbl_mst_item_category_link_item.category_id=tbl_mst_item_category.id
INNER JOIN tbl_mst_item_category_purpose_link_category ON tbl_mst_item_category.id=tbl_mst_item_category_purpose_link_category.category_id
INNER JOIN tbl_mst_item_category_purpose ON tbl_mst_item_category_purpose_link_category.purpose_id=tbl_mst_item_category_purpose.id
INNER JOIN shop_mst ON invh.ag_cd=shop_mst.sh_ag_cd AND invh.ro_cd=shop_mst.sh_ro_cd AND invh.sh_cd=shop_mst.sh_cd 
INNER JOIN agency_mst ON invh.ag_cd=agency_mst.ag_cd 
INNER JOIN area_d ON agency_mst.ag_cd=area_d.ag_cd
INNER JOIN area_h ON area_d.area_cd=area_h.area_cd
WHERE invd.a_Qty>0 AND tbl_mst_item_category_purpose.id=3 AND tbl_mst_item_category.id=' . $category . ' AND invh.date_actual>=\'' . date('Y-m-01', strtotime($datepickermonth . ' -6 month')) . '\' AND invh.date_actual<=\'' . date('Y-m-t', strtotime($datepickermonth)) . '\' AND invh.b_a=\'A\' AND invh.tot_a_val<>0 ' . $str . '
GROUP BY invh.ag_cd,invh.date_actual ) a GROUP BY a.ag_cd';
        $result = $this->db->query($query)->result_array();
        //echo $this->db->last_query();
        return $result;
    }

    function getDItemSales($area = null) {
        $str = '';
        if (!empty($area) && isset($area) && $area != null && $area != -1) {
            $str .= ' AND area_h.area_cd=' . $area . ' ';
        }
        $q = $this->db->query('SELECT area_h.area_name,agency_mst.ag_name,invh.ag_cd,IF(invh.cd=\'T\',\'D\',invh.cd) AS cd,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=1 AND item_mst.cat_main LIKE \'%Aarya%\', (invd.a_Qty*item_mst.pack),0)) AS `April-01-Aarya-Pads`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=2 AND item_mst.cat_main LIKE \'%Aarya%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-02-Aarya-Pads`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=3 AND item_mst.cat_main LIKE \'%Aarya%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-03-Aarya-Pads`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=4 AND item_mst.cat_main LIKE \'%Aarya%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-04-Aarya-Pads`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=5 AND item_mst.cat_main LIKE \'%Aarya%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-05-Aarya-Pads`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=6 AND item_mst.cat_main LIKE \'%Aarya%\', (invd.a_Qty*item_mst.pack),0)) AS `April-06-Aarya-Pads`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=7 AND item_mst.cat_main LIKE \'%Aarya%\', (invd.a_Qty*item_mst.pack),0)) AS `April-07-Aarya-Pads`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=8 AND item_mst.cat_main LIKE \'%Aarya%\', (invd.a_Qty*item_mst.pack),0)) AS `April-08-Aarya-Pads`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=9 AND item_mst.cat_main LIKE \'%Aarya%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-09-Aarya-Pads`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=10 AND item_mst.cat_main LIKE \'%Aarya%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-10-Aarya-Pads`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=11 AND item_mst.cat_main LIKE \'%Aarya%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-11-Aarya-Pads`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=12 AND item_mst.cat_main LIKE \'%Aarya%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-12-Aarya-Pads`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=13 AND item_mst.cat_main LIKE \'%Aarya%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-13-Aarya-Pads`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=14 AND item_mst.cat_main LIKE \'%Aarya%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-14-Aarya-Pads`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=15 AND item_mst.cat_main LIKE \'%Aarya%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-15-Aarya-Pads`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=16 AND item_mst.cat_main LIKE \'%Aarya%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-16-Aarya-Pads`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=17 AND item_mst.cat_main LIKE \'%Aarya%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-17-Aarya-Pads`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=18 AND item_mst.cat_main LIKE \'%Aarya%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-18-Aarya-Pads`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=19 AND item_mst.cat_main LIKE \'%Aarya%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-19-Aarya-Pads`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=20 AND item_mst.cat_main LIKE \'%Aarya%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-20-Aarya-Pads`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=21 AND item_mst.cat_main LIKE \'%Aarya%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-21-Aarya-Pads`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=22 AND item_mst.cat_main LIKE \'%Aarya%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-22-Aarya-Pads`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=23 AND item_mst.cat_main LIKE \'%Aarya%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-23-Aarya-Pads`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=24 AND item_mst.cat_main LIKE \'%Aarya%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-24-Aarya-Pads`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=25 AND item_mst.cat_main LIKE \'%Aarya%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-25-Aarya-Pads`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=26 AND item_mst.cat_main LIKE \'%Aarya%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-26-Aarya-Pads`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=27 AND item_mst.cat_main LIKE \'%Aarya%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-27-Aarya-Pads`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=28 AND item_mst.cat_main LIKE \'%Aarya%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-28-Aarya-Pads`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=29 AND item_mst.cat_main LIKE \'%Aarya%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-29-Aarya-Pads`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=30 AND item_mst.cat_main LIKE \'%Aarya%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-30-Aarya-Pads`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND item_mst.cat_main LIKE \'%Aarya%\', (invd.a_Qty*item_mst.pack),0)) AS `April-Total-Aarya-Pads` 
FROM invh  
INNER JOIN invd ON invh.invno=invd.invno
INNER JOIN item_mst ON invd.item=item_mst.item
INNER JOIN agency_mst ON invh.ag_cd=agency_mst.ag_cd 
INNER JOIN area_d ON agency_mst.ag_cd=area_d.ag_cd
INNER JOIN area_h ON area_d.area_cd=area_h.area_cd
WHERE invh.date_actual>=\'2023-04-01\' AND invh.date_actual<=\'2023-04-30\' AND invh.b_a=\'A\' AND invh.tot_a_val<>0 AND (invh.cd=\'D\' OR invh.cd=\'T\' OR invh.cd=\'S\') ' . $str . '
GROUP BY area_h.area_name,agency_mst.ag_name,invh.ag_cd,invh.cd
ORDER BY cd,area_h.area_name,agency_mst.ag_name,invh.ag_cd');
        $result = $q->result_array();
        return $result;
    }

    function getNenaposhaItemSales($area = null) {
        $str = '';
        if (!empty($area) && isset($area) && $area != null && $area != -1) {
            $str .= ' AND area_h.area_cd=' . $area . ' ';
        }
        $q = $this->db->query('SELECT area_h.area_name,agency_mst.ag_name,invh.ag_cd,IF(invh.cd=\'T\',\'D\',invh.cd) AS cd,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=1 AND item_mst.cat_main LIKE \'%Nenaposha%\', (invd.a_Qty*item_mst.pack),0)) AS `April-01-Nenaposha`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=2 AND item_mst.cat_main LIKE \'%Nenaposha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-02-Nenaposha`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=3 AND item_mst.cat_main LIKE \'%Nenaposha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-03-Nenaposha`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=4 AND item_mst.cat_main LIKE \'%Nenaposha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-04-Nenaposha`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=5 AND item_mst.cat_main LIKE \'%Nenaposha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-05-Nenaposha`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=6 AND item_mst.cat_main LIKE \'%Nenaposha%\', (invd.a_Qty*item_mst.pack),0)) AS `April-06-Nenaposha`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=7 AND item_mst.cat_main LIKE \'%Nenaposha%\', (invd.a_Qty*item_mst.pack),0)) AS `April-07-Nenaposha`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=8 AND item_mst.cat_main LIKE \'%Nenaposha%\', (invd.a_Qty*item_mst.pack),0)) AS `April-08-Nenaposha`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=9 AND item_mst.cat_main LIKE \'%Nenaposha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-09-Nenaposha`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=10 AND item_mst.cat_main LIKE \'%Nenaposha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-10-Nenaposha`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=11 AND item_mst.cat_main LIKE \'%Nenaposha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-11-Nenaposha`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=12 AND item_mst.cat_main LIKE \'%Nenaposha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-12-Nenaposha`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=13 AND item_mst.cat_main LIKE \'%Nenaposha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-13-Nenaposha`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=14 AND item_mst.cat_main LIKE \'%Nenaposha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-14-Nenaposha`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=15 AND item_mst.cat_main LIKE \'%Nenaposha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-15-Nenaposha`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=16 AND item_mst.cat_main LIKE \'%Nenaposha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-16-Nenaposha`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=17 AND item_mst.cat_main LIKE \'%Nenaposha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-17-Nenaposha`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=18 AND item_mst.cat_main LIKE \'%Nenaposha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-18-Nenaposha`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=19 AND item_mst.cat_main LIKE \'%Nenaposha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-19-Nenaposha`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=20 AND item_mst.cat_main LIKE \'%Nenaposha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-20-Nenaposha`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=21 AND item_mst.cat_main LIKE \'%Nenaposha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-21-Nenaposha`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=22 AND item_mst.cat_main LIKE \'%Nenaposha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-22-Nenaposha`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=23 AND item_mst.cat_main LIKE \'%Nenaposha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-23-Nenaposha`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=24 AND item_mst.cat_main LIKE \'%Nenaposha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-24-Nenaposha`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=25 AND item_mst.cat_main LIKE \'%Nenaposha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-25-Nenaposha`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=26 AND item_mst.cat_main LIKE \'%Nenaposha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-26-Nenaposha`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=27 AND item_mst.cat_main LIKE \'%Nenaposha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-27-Nenaposha`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=28 AND item_mst.cat_main LIKE \'%Nenaposha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-28-Nenaposha`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=29 AND item_mst.cat_main LIKE \'%Nenaposha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-29-Nenaposha`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=30 AND item_mst.cat_main LIKE \'%Nenaposha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-30-Nenaposha`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND item_mst.cat_main LIKE \'%Nenaposha%\', (invd.a_Qty*item_mst.pack),0)) AS `April-Total-Nenaposha` 
FROM invh  
INNER JOIN invd ON invh.invno=invd.invno
INNER JOIN item_mst ON invd.item=item_mst.item
INNER JOIN agency_mst ON invh.ag_cd=agency_mst.ag_cd 
INNER JOIN area_d ON agency_mst.ag_cd=area_d.ag_cd
INNER JOIN area_h ON area_d.area_cd=area_h.area_cd
WHERE invh.date_actual>=\'2023-04-01\' AND invh.date_actual<=\'2023-04-30\' AND invh.b_a=\'A\' AND invh.tot_a_val<>0 AND (invh.cd=\'C\' OR invh.cd=\'S\') ' . $str . '
GROUP BY area_h.area_name,agency_mst.ag_name,invh.ag_cd,invh.cd
ORDER BY cd,area_h.area_name,agency_mst.ag_name,invh.ag_cd');
        $result = $q->result_array();
        return $result;
    }

    function getDbItemSales($area = null) {
        $str = '';
        if (!empty($area) && isset($area) && $area != null && $area != -1) {
            $str .= ' AND area_h.area_cd=' . $area . ' ';
        }
        $q = $this->db->query('SELECT area_h.area_name,agency_mst.ag_name,invh.ag_cd,IF(invh.cd=\'T\',\'D\',invh.cd) AS cd,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=1 AND item_mst.cat_main LIKE \'%Deveni Batha%\', (invd.a_Qty*item_mst.pack),0)) AS `April-01-db`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=2 AND item_mst.cat_main LIKE \'%Deveni Batha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-02-db`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=3 AND item_mst.cat_main LIKE \'%Deveni Batha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-03-db`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=4 AND item_mst.cat_main LIKE \'%Deveni Batha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-04-db`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=5 AND item_mst.cat_main LIKE \'%Deveni Batha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-05-db`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=6 AND item_mst.cat_main LIKE \'%Deveni Batha%\', (invd.a_Qty*item_mst.pack),0)) AS `April-06-db`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=7 AND item_mst.cat_main LIKE \'%Deveni Batha%\', (invd.a_Qty*item_mst.pack),0)) AS `April-07-db`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=8 AND item_mst.cat_main LIKE \'%Deveni Batha%\', (invd.a_Qty*item_mst.pack),0)) AS `April-08-db`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=9 AND item_mst.cat_main LIKE \'%Deveni Batha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-09-db`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=10 AND item_mst.cat_main LIKE \'%Deveni Batha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-10-db`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=11 AND item_mst.cat_main LIKE \'%Deveni Batha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-11-db`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=12 AND item_mst.cat_main LIKE \'%Deveni Batha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-12-db`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=13 AND item_mst.cat_main LIKE \'%Deveni Batha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-13-db`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=14 AND item_mst.cat_main LIKE \'%Deveni Batha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-14-db`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=15 AND item_mst.cat_main LIKE \'%Deveni Batha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-15-db`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=16 AND item_mst.cat_main LIKE \'%Deveni Batha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-16-db`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=17 AND item_mst.cat_main LIKE \'%Deveni Batha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-17-db`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=18 AND item_mst.cat_main LIKE \'%Deveni Batha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-18-db`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=19 AND item_mst.cat_main LIKE \'%Deveni Batha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-19-db`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=20 AND item_mst.cat_main LIKE \'%Deveni Batha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-20-db`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=21 AND item_mst.cat_main LIKE \'%Deveni Batha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-21-db`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=22 AND item_mst.cat_main LIKE \'%Deveni Batha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-22-db`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=23 AND item_mst.cat_main LIKE \'%Deveni Batha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-23-db`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=24 AND item_mst.cat_main LIKE \'%Deveni Batha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-24-db`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=25 AND item_mst.cat_main LIKE \'%Deveni Batha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-25-db`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=26 AND item_mst.cat_main LIKE \'%Deveni Batha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-26-db`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=27 AND item_mst.cat_main LIKE \'%Deveni Batha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-27-db`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=28 AND item_mst.cat_main LIKE \'%Deveni Batha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-28-db`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=29 AND item_mst.cat_main LIKE \'%Deveni Batha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-29-db`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=30 AND item_mst.cat_main LIKE \'%Deveni Batha%\',  (invd.a_Qty*item_mst.pack),0)) AS `April-30-db`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND item_mst.cat_main LIKE \'%Deveni Batha%\', (invd.a_Qty*item_mst.pack),0)) AS `April-Total-db` 
FROM invh  
INNER JOIN invd ON invh.invno=invd.invno
INNER JOIN item_mst ON invd.item=item_mst.item
INNER JOIN agency_mst ON invh.ag_cd=agency_mst.ag_cd 
INNER JOIN area_d ON agency_mst.ag_cd=area_d.ag_cd
INNER JOIN area_h ON area_d.area_cd=area_h.area_cd
WHERE invh.date_actual>=\'2023-04-01\' AND invh.date_actual<=\'2023-04-30\' AND invh.b_a=\'A\' AND invh.tot_a_val<>0 AND (invh.cd=\'C\' OR invh.cd=\'S\') AND item_mst.sub_category!=\'Bandy full\' ' . $str . '
GROUP BY area_h.area_name,agency_mst.ag_name,invh.ag_cd,invh.cd
ORDER BY cd,area_h.area_name,agency_mst.ag_name,invh.ag_cd');
        $result = $q->result_array();
        return $result;
    }

    function getSoyaItemSales($area = null) {
        $str = '';
        if (!empty($area) && isset($area) && $area != null && $area != -1) {
            $str .= ' AND area_h.area_cd=' . $area . ' ';
        }
        $q = $this->db->query('SELECT area_h.area_name,agency_mst.ag_name,invh.ag_cd,IF(invh.cd=\'T\',\'D\',invh.cd) AS cd,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=1 AND item_mst.cat_main LIKE \'Soya\', (invd.a_Qty*item_mst.pack),0)) AS `April-01-Soya`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=2 AND item_mst.cat_main LIKE \'Soya\',  (invd.a_Qty*item_mst.pack),0)) AS `April-02-Soya`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=3 AND item_mst.cat_main LIKE \'Soya\',  (invd.a_Qty*item_mst.pack),0)) AS `April-03-Soya`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=4 AND item_mst.cat_main LIKE \'Soya\',  (invd.a_Qty*item_mst.pack),0)) AS `April-04-Soya`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=5 AND item_mst.cat_main LIKE \'Soya\',  (invd.a_Qty*item_mst.pack),0)) AS `April-05-Soya`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=6 AND item_mst.cat_main LIKE \'Soya\', (invd.a_Qty*item_mst.pack),0)) AS `April-06-Soya`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=7 AND item_mst.cat_main LIKE \'Soya\', (invd.a_Qty*item_mst.pack),0)) AS `April-07-Soya`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=8 AND item_mst.cat_main LIKE \'Soya\', (invd.a_Qty*item_mst.pack),0)) AS `April-08-Soya`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=9 AND item_mst.cat_main LIKE \'Soya\',  (invd.a_Qty*item_mst.pack),0)) AS `April-09-Soya`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=10 AND item_mst.cat_main LIKE \'Soya\',  (invd.a_Qty*item_mst.pack),0)) AS `April-10-Soya`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=11 AND item_mst.cat_main LIKE \'Soya\',  (invd.a_Qty*item_mst.pack),0)) AS `April-11-Soya`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=12 AND item_mst.cat_main LIKE \'Soya\',  (invd.a_Qty*item_mst.pack),0)) AS `April-12-Soya`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=13 AND item_mst.cat_main LIKE \'Soya\',  (invd.a_Qty*item_mst.pack),0)) AS `April-13-Soya`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=14 AND item_mst.cat_main LIKE \'Soya\',  (invd.a_Qty*item_mst.pack),0)) AS `April-14-Soya`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=15 AND item_mst.cat_main LIKE \'Soya\',  (invd.a_Qty*item_mst.pack),0)) AS `April-15-Soya`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=16 AND item_mst.cat_main LIKE \'Soya\',  (invd.a_Qty*item_mst.pack),0)) AS `April-16-Soya`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=17 AND item_mst.cat_main LIKE \'Soya\',  (invd.a_Qty*item_mst.pack),0)) AS `April-17-Soya`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=18 AND item_mst.cat_main LIKE \'Soya\',  (invd.a_Qty*item_mst.pack),0)) AS `April-18-Soya`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=19 AND item_mst.cat_main LIKE \'Soya\',  (invd.a_Qty*item_mst.pack),0)) AS `April-19-Soya`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=20 AND item_mst.cat_main LIKE \'Soya\',  (invd.a_Qty*item_mst.pack),0)) AS `April-20-Soya`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=21 AND item_mst.cat_main LIKE \'Soya\',  (invd.a_Qty*item_mst.pack),0)) AS `April-21-Soya`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=22 AND item_mst.cat_main LIKE \'Soya\',  (invd.a_Qty*item_mst.pack),0)) AS `April-22-Soya`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=23 AND item_mst.cat_main LIKE \'Soya\',  (invd.a_Qty*item_mst.pack),0)) AS `April-23-Soya`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=24 AND item_mst.cat_main LIKE \'Soya\',  (invd.a_Qty*item_mst.pack),0)) AS `April-24-Soya`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=25 AND item_mst.cat_main LIKE \'Soya\',  (invd.a_Qty*item_mst.pack),0)) AS `April-25-Soya`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=26 AND item_mst.cat_main LIKE \'Soya\',  (invd.a_Qty*item_mst.pack),0)) AS `April-26-Soya`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=27 AND item_mst.cat_main LIKE \'Soya\',  (invd.a_Qty*item_mst.pack),0)) AS `April-27-Soya`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=28 AND item_mst.cat_main LIKE \'Soya\',  (invd.a_Qty*item_mst.pack),0)) AS `April-28-Soya`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=29 AND item_mst.cat_main LIKE \'Soya\',  (invd.a_Qty*item_mst.pack),0)) AS `April-29-Soya`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND day(invh.date_actual)=30 AND item_mst.cat_main LIKE \'Soya\',  (invd.a_Qty*item_mst.pack),0)) AS `April-30-Soya`,
SUM(IF(month(invh.date_actual)=4 AND year(invh.date_actual)=2023 AND item_mst.cat_main LIKE \'Soya\', (invd.a_Qty*item_mst.pack),0)) AS `April-Total-Soya` 
FROM invh  
INNER JOIN invd ON invh.invno=invd.invno
INNER JOIN item_mst ON invd.item=item_mst.item
INNER JOIN agency_mst ON invh.ag_cd=agency_mst.ag_cd 
INNER JOIN area_d ON agency_mst.ag_cd=area_d.ag_cd
INNER JOIN area_h ON area_d.area_cd=area_h.area_cd
WHERE invh.date_actual>=\'2023-04-01\' AND invh.date_actual<=\'2023-04-30\' AND invh.b_a=\'A\' AND invh.tot_a_val<>0 AND (invh.cd=\'C\' OR invh.cd=\'S\') ' . $str . '
GROUP BY area_h.area_name,agency_mst.ag_name,invh.ag_cd,invh.cd
ORDER BY cd,area_h.area_name,agency_mst.ag_name,invh.ag_cd');
        $result = $q->result_array();
        return $result;
    }

    function getPendingBill($area = null, $range = null, $dateBookFrom = null, $dateBookTo = null) {
        $str = '';

        if (!empty($dateBookFrom) && isset($dateBookFrom) && $dateBookFrom != NULL && !empty($dateBookTo) && isset($dateBookTo) && $dateBookTo != NULL) {

            $str .= ' invh.date_book>=\'' . $dateBookFrom . '\' AND invh.date_book<=\'' . $dateBookTo . '\'';
        }

        if (!empty($area) && isset($area) && $area != null && $area != -1) {
            $str .= ' AND area_h.area_cd=' . $area . ' ';
        }
        if (!empty($range) && isset($range) && $range != null && $range != -1) {
            if ($range == 'D') {
                $str .= ' AND (invh.cd=\'' . $range . '\' OR invh.cd=\'S\' OR invh.cd=\'T\') ';
            } else {
                $str .= ' AND (invh.cd=\'' . $range . '\' OR invh.cd=\'S\') ';
            }
        }



        $q = $this->db->query('SELECT area_h.area_cd, agency_mst.ag_cd, area_h.area_name, agency_mst.ag_name,invh.cd, invh.date_book, '
                . 'COUNT(shop_mst.Auto) AS `Bills`, '
                . 'COUNT(DISTINCT(shop_mst.Auto)) AS `PC`, '
                . 'COUNT(IF(invh.b_a = \'B\',shop_mst.Auto,null)) AS Pending, COUNT(IF(invh.b_a = \'A\' AND invh.tot_a_val <>0,shop_mst.Auto,null)) AS `Actual`,'
                . 'COUNT(IF(invh.b_a = \'A\' AND invh.tot_a_val =0,shop_mst.Auto,null)) AS `Cancel`,'
                . 'SUM(invh.tot_a_val) AS `BillValue`,'
                . 'SUM(IF(invh.b_a = \'B\',invh.tot_a_val,0)) AS `PendingValue`,'
                . 'SUM(IF(invh.b_a = \'A\' AND invh.tot_a_val <>0,invh.tot_a_val,0)) AS `ActualValue`,
                   SUM(IF(invh.b_a = \'A\' AND invh.tot_a_val =0,invh.tot_c_val,0)) AS `CancelValue`
FROM invh
INNER JOIN agency_mst ON invh.ag_cd = agency_mst.ag_cd
INNER JOIN area_d ON agency_mst.ag_cd = area_d.ag_cd
INNER JOIN area_h ON area_d.area_cd = area_h.area_cd
INNER JOIN shop_mst ON invh.ag_cd = shop_mst.sh_ag_cd AND invh.ro_cd= shop_mst.sh_ro_cd AND shop_mst.sh_cd= invh.sh_cd
WHERE  ' . $str . ' 
GROUP BY area_h.area_cd, agency_mst.ag_cd, invh.cd, invh.date_book
ORDER BY area_h.area_name, shop_mst.sh_ag_cd, invh.date_book;

');
        $result = $q->result_array();
        return $result;
    }

    function getNotBillOutlet($area = null, $range = null, $dateBookFrom = null, $dateBookTo = null) {
        $str = '';

        if (!empty($dateBookFrom) && isset($dateBookFrom) && $dateBookFrom != NULL && !empty($dateBookTo) && isset($dateBookTo) && $dateBookTo != NULL) {

            $str .= ' invh.date_book>=\'' . $dateBookFrom . '\' AND invh.date_book<=\'' . $dateBookTo . '\'';
        }


        if (!empty($area) && isset($area) && $area != null && $area != -1) {
            $str .= ' AND area_h.area_cd=' . $area . ' ';
        }
        if (!empty($range) && isset($range) && $range != null && $range != -1) {
            if ($range == 'D') {
                $str .= ' AND (invh.cd=\'' . $range . '\' OR invh.cd=\'S\' OR invh.cd=\'T\') ';
            } else {
                $str .= ' AND (invh.cd=\'' . $range . '\' OR invh.cd=\'S\') ';
            }
        }




        $q = $this->db->query('SELECT area_h.area_name,agency_mst.ag_name,shop_mst.Auto,inv_shop.Auto,shop_mst.sh_ag_cd,shop_mst.sh_ro_cd, shop_mst.sh_cd, shop_mst.sh_name,shop_mst.add1,shop_mst.add2,shop_mst.add3,shop_mst.sh_tno
FROM shop_mst
INNER JOIN agency_mst ON shop_mst.sh_ag_cd=agency_mst.ag_cd
INNER JOIN area_d ON agency_mst.ag_cd=area_d.ag_cd
INNER JOIN area_h ON area_d.area_cd=area_h.area_cd
LEFT JOIN (SELECT DISTINCT shop_mst.Auto
FROM `invh`
INNER JOIN shop_mst ON invh.ag_cd=shop_mst.sh_ag_cd AND invh.ro_cd=shop_mst.sh_ro_cd AND invh.sh_cd=shop_mst.sh_cd
INNER JOIN agency_mst ON shop_mst.sh_ag_cd=agency_mst.ag_cd
INNER JOIN area_d ON agency_mst.ag_cd=area_d.ag_cd
INNER JOIN area_h ON area_d.area_cd=area_h.area_cd          
WHERE ' . $str . ' AND invh.b_a=\'A\' AND invh.tot_a_val!=0 ) inv_shop ON shop_mst.Auto=inv_shop.Auto 
WHERE  inv_shop.Auto IS NULL AND shop_mst.sh_stat=0;');

        $result = $q->result_array();
        echo $this->db->last_query();

        return $result;
    }

    function getInvoiceTimmeline($invoice_number) {
        $str = '';

        $this->db->select('`ag_cd`, `ro_cd`, `sh_cd`, `cname`, `invno`, `tot_b_val`, `tot_c_val`, `tot_m_val`, `tot_g_val`, `tot_f_val`, `tot_a_val`, `tot_dis`, `dis_per`, `date_book`, `date_actual`, `date_save`, `time_save`, `audit_date`, `audit_time`, `cd`, `b_a`, `uid`, `post`, `d`, `auto`, `app_inv_no`, `distributor_stock_id` ');
        $this->db->from('`tbl_trans_invh_log`');
        $this->db->where('`tbl_trans_invh_log`.`invno`', $invoice_number);

        $q = $this->db->get();

        $result = $q->result_array();
        return $result;
    }

    function getInvoiceDeatils($invoice_number) {
        $str = '';

        $this->db->select('`tbl_trans_invh_log`.`invno`,`item_mst`.`item`,`item_mst`.`des`,`tbl_trans_invd_log`.`up` as unit_price,`tbl_trans_invh_log`.`auto`,`tbl_trans_invd_log`.`invh_log_auto`,`tbl_trans_invd_log`.`b_qty`,`tbl_trans_invd_log`.`c_qty`,`tbl_trans_invd_log`.`m_qty`,`tbl_trans_invd_log`.`g_qty`,`tbl_trans_invd_log`.`a_qty`,`tbl_trans_invd_log`.`f_qty`,`agency_mst`.`ag_name`, `shop_mst`.`sh_ag_cd`, `shop_mst`.`sh_ro_cd`, `shop_mst`.`sh_name`, `shop_mst`.`add1`, `shop_mst`.`add2`, `shop_mst`.`sh_tno`, `tbl_trans_invh_log`.`tot_a_val`, `tbl_trans_invh_log`.`date_book`, `tbl_trans_invh_log`.`date_actual`,`tbl_trans_invh_log`.`tot_dis`,`tbl_trans_invh_log`.`dis_per`');
        $this->db->from('`tbl_trans_invd_log`');
        $this->db->join('`tbl_trans_invh_log`', '`tbl_trans_invd_log`.`invh_log_auto`=`tbl_trans_invh_log`.`auto`', 'INNER');
        $this->db->join('`shop_mst`', '`tbl_trans_invh_log`.`ag_cd`=`shop_mst`.`sh_ag_cd` AND `tbl_trans_invh_log`.`ro_cd`=`shop_mst`.`sh_ro_cd` AND `tbl_trans_invh_log`.`sh_cd`=`shop_mst`.`sh_cd`', 'INNER');
        $this->db->join('item_mst', '`tbl_trans_invd_log`.`item`=`item_mst`.`item`', 'INNER');
        $this->db->join('agency_mst', '`tbl_trans_invh_log`.`ag_cd`=`agency_mst`.`ag_cd`', 'INNER');
        $this->db->join('area_d', '`agency_mst`.`ag_cd`=`area_d`.`ag_cd`', 'INNER');
        $this->db->join('area_h', '`area_d`.`area_cd`=`area_h`.`area_cd`', 'INNER');
        $this->db->where('`tbl_trans_invh_log`.`invno`', $invoice_number);
        $this->db->order_by('`tbl_trans_invh_log`.`auto`,`item_mst`.`item`');

        $q = $this->db->get();

        $result = $q->result_array();

        return $result;
    }

    //////////////////////////////////////
    //GET NEW MAPPING AND REPORT
    /////////////////////////////////////
    //get Daily sales
    function getDailySalesNewDemarcation($area = null, $range = null, $datepickermonth = null) {
        $str = '';
        if (!empty($area) && isset($area) && $area != null && $area != -1) {
            $str .= ' AND tbl_mst_area.id=' . $area . ' ';
        }
        if (!empty($range) && isset($range) && $range != null && $range != -1) {

            /* if ($range == 'D') {
              $str .= ' AND (invh.cd=\'' . $range . '\' OR invh.cd=\'S\' OR invh.cd=\'T\') ';
              } else {
              $str .= ' AND (invh.cd=\'' . $range . '\' OR invh.cd=\'S\') ';
              } */
            //20240218
            /*
              if ($range == 'D') {
              $str .= ' AND (invh.cd=\'' . $range . '\' OR invh.cd=\'T\') ';
              } else {
              $str .= ' AND (invh.cd=\'' . $range . '\' ) ';
              } */

            //FOR S RANGE
            if ($range == 'D') {
                $str .= ' AND (invh.cd=\'' . $range . '\' OR invh.cd=\'T\' OR invh.cd=\'S\') ';
            } else {
                $str .= ' AND (invh.cd=\'' . $range . '\' OR invh.cd=\'S\') ';
            }
        }
        $strQ = '';
        $monthNumber = date('m', strtotime($datepickermonth));
        $monthName = date('F', strtotime($datepickermonth));
        $year = date('Y', strtotime($datepickermonth));
        for ($n = 1; $n <= date('t', strtotime($datepickermonth)); $n++) {
            //$strQ .= 'SUM(IF(month(invh.date_actual)=' . $monthNumber . ' AND year(invh.date_actual)=' . $year . ' AND day(invh.date_actual)=' . $n . ', (invh.tot_a_val+invh.tot_dis),0)) AS `' . $monthName . '-' . $n . '`,';
            //S RANGE SUPPORT
            if ($range == 'D') {
                $strQ .= 'SUM(CASE WHEN (tbl_mst_geography.range_id!=3 AND month(invh.date_actual)=' . $monthNumber . ' AND year(invh.date_actual)=' . $year . ' AND day(invh.date_actual)=' . $n . ') THEN ((invh.tot_a_val+invh.tot_dis)) WHEN (tbl_mst_geography.range_id=3 AND month(invh.date_actual)=' . $monthNumber . ' AND year(invh.date_actual)=' . $year . ' AND day(invh.date_actual)=' . $n . ') THEN ( (invh.tot_a_val*`invh_cd_ratio`.`d_ratio`+invh.tot_dis*`invh_cd_ratio`.`d_ratio` )) END) AS `' . $monthName . '-' . $n . '`,';
            } else {
                $strQ .= 'SUM(CASE WHEN (tbl_mst_geography.range_id!=3) THEN (IF(month(invh.date_actual)=' . $monthNumber . ' AND year(invh.date_actual)=' . $year . ' AND day(invh.date_actual)=' . $n . ', (invh.tot_a_val+invh.tot_dis),0)) WHEN (tbl_mst_geography.range_id=3) THEN (IF(month(invh.date_actual)=' . $monthNumber . ' AND year(invh.date_actual)=' . $year . ' AND day(invh.date_actual)=' . $n . ', (invh.tot_a_val*`invh_cd_ratio`.`c_ratio`+invh.tot_dis*`invh_cd_ratio`.`c_ratio`),0)) END) AS `' . $monthName . '-' . $n . '`,';
            }
            $strQ .= 'COUNT(DISTINCT CASE WHEN (month(invh.date_actual)=' . $monthNumber . ' AND year(invh.date_actual)=' . $year . ' AND day(invh.date_actual)=' . $n . ') THEN shop_mst.Auto END) AS `' . $monthName . '-' . $n . '-pc`,';
        }
        $strBack = '';
        for ($k = 1; $k <= 6; $k++) {
            $monthNumberBack = date('m', strtotime($datepickermonth . ' -' . $k . ' month'));
            $monthNameBack = date('F', strtotime($datepickermonth . ' -' . $k . ' month'));
            $yearBack = date('Y', strtotime($datepickermonth . ' -' . $k . ' month'));
            if ($range == 'D') {
                $strBack .= ' SUM(CASE WHEN (tbl_mst_geography.range_id!=3) THEN IF(month(invh.date_actual)=' . $monthNumberBack . ' AND year(invh.date_actual)=' . $yearBack . ', invh.tot_a_val+invh.tot_dis,0) ELSE IF(month(invh.date_actual)=' . $monthNumberBack . ' AND year(invh.date_actual)=' . $yearBack . ', invh.tot_a_val*`invh_cd_ratio`.`d_ratio`+invh.tot_dis*`invh_cd_ratio`.`d_ratio`,0) END) AS `' . $monthNameBack . '-Total`, ';
            } else {
                $strBack .= ' SUM(CASE WHEN (tbl_mst_geography.range_id!=3) THEN IF(month(invh.date_actual)=' . $monthNumberBack . ' AND year(invh.date_actual)=' . $yearBack . ', invh.tot_a_val+invh.tot_dis,0) ELSE IF(month(invh.date_actual)=' . $monthNumberBack . ' AND year(invh.date_actual)=' . $yearBack . ', invh.tot_a_val*`invh_cd_ratio`.`c_ratio`+invh.tot_dis*`invh_cd_ratio`.`c_ratio`,0) END) AS `' . $monthNameBack . '-Total`, ';
            }
        }
        $strp1 = '';
        if ($range == 'D') {
            $strp1 = 'SELECT tbl_mst_region.region_name,tbl_mst_area.area_name,agency_mst.ag_name,invh.ag_cd,IF(invh.cd=\'T\' OR invh.cd=\'S\' ,\'D\',invh.cd) AS cd,';
        } else {
            $strp1 = 'SELECT tbl_mst_region.region_name,tbl_mst_area.area_name,agency_mst.ag_name,invh.ag_cd,IF(invh.cd=\'S\' ,\'C\',invh.cd) AS cd,';
        }

        $str2 = '';
        if ($range == 'D') {
            $str2 = 'SUM(CASE WHEN (tbl_mst_geography.range_id!=3) THEN IF(month(invh.date_actual)=' . $monthNumber . ' AND year(invh.date_actual)=' . $year . ', (invh.tot_a_val+invh.tot_dis),0) ELSE IF(month(invh.date_actual)=' . $monthNumber . ' AND year(invh.date_actual)=' . $year . ', (invh.tot_a_val*`invh_cd_ratio`.`d_ratio`+invh.tot_dis*`invh_cd_ratio`.`d_ratio`),0) END) AS `' . $monthName . '-Total`';
        } else {
            $str2 = 'SUM(CASE WHEN (tbl_mst_geography.range_id!=3) THEN IF(month(invh.date_actual)=' . $monthNumber . ' AND year(invh.date_actual)=' . $year . ', (invh.tot_a_val+invh.tot_dis),0) ELSE IF(month(invh.date_actual)=' . $monthNumber . ' AND year(invh.date_actual)=' . $year . ', (invh.tot_a_val*`invh_cd_ratio`.`c_ratio`+invh.tot_dis*`invh_cd_ratio`.`c_ratio`),0) END) AS `' . $monthName . '-Total`';
        }

        $q = $this->db->query($strp1 . $strQ . $strBack . ' 

 
' . $str2 . '

FROM invh  

LEFT JOIN `invh_cd_ratio` ON `invh`.`invno`=`invh_cd_ratio`.`invno` 

INNER JOIN shop_mst ON invh.ag_cd=shop_mst.sh_ag_cd AND invh.ro_cd=shop_mst.sh_ro_cd AND invh.sh_cd=shop_mst.sh_cd 
INNER JOIN agency_mst ON invh.ag_cd=agency_mst.ag_cd 

INNER JOIN tbl_mst_territory ON agency_mst.ag_cd=`tbl_mst_territory`.`reference_code`
INNER JOIN tbl_mst_geography ON tbl_mst_territory.id=tbl_mst_geography.territory_id
INNER JOIN tbl_mst_range ON tbl_mst_geography.range_id=tbl_mst_range.id AND invh.cd=tbl_mst_range.range_name
INNER JOIN tbl_mst_area ON tbl_mst_geography.area_id=tbl_mst_area.id
INNER JOIN tbl_mst_region ON tbl_mst_geography.region_id=tbl_mst_region.id

WHERE invh.date_actual>=\'' . date('Y-m-01', strtotime($datepickermonth . ' -6 month')) . '\' AND invh.date_actual<=\'' . date('Y-m-t', strtotime($datepickermonth)) . '\' AND invh.b_a=\'A\' AND invh.tot_a_val<>0 ' . $str . '
GROUP BY tbl_mst_area.area_name,agency_mst.ag_name,invh.ag_cd,invh.cd
ORDER BY tbl_mst_region.id,tbl_mst_area.area_name,agency_mst.ag_name,invh.ag_cd,cd');
        $result = $q->result_array();
        //echo $this->db->last_query();
        return $result;
    }

    //GET AGENCY REP RELATED TARGET FROM TARGET VALUE TABLE OLD TABLE
    function getTargetNewDemarcation($tyear, $tmonth, $area_cd = NULL) {
        $this->db->select('`tbl_mst_area`.`id` AS `area_cd`, `target_value`.`ag_cd`, `t_year`, `t_mon`, `tbl_mst_area`.`area_name`, `ag_name`, SUM(IF(tbl_mst_geography.range_id=1 OR tbl_mst_geography.range_id=3,`c_target`,0)) AS `c_target`, SUM(IF(tbl_mst_geography.range_id=2 OR tbl_mst_geography.range_id=5 OR tbl_mst_geography.range_id=3,`d_target`,0)) AS `d_target`, `a_target`, SUM(IF(tbl_mst_geography.range_id=4,`b_target`,0)) AS `b_target`, SUM(IF(tbl_mst_geography.range_id=3,`s_target`,0)) AS `s_target`, SUM(IF(tbl_mst_geography.range_id=5,`t_target`,0)) AS `t_target`, SUM(IF(tbl_mst_geography.range_id=6,`r_target`,0)) AS  `r_target`, SUM(IF(tbl_mst_geography.range_id=1,`acs_pc_target`,0)) AS `acs_pc_target`, SUM(IF(tbl_mst_geography.range_id=2,`bd_pc_target`,0)) AS `bd_pc_target`, `wd`, `p_wd`, `auto`');
        $this->db->from('`target_value`');
        $this->db->join('`tbl_mst_territory`', 'target_value.ag_cd=`tbl_mst_territory`.`reference_code`', 'INNER');
        $this->db->join('`tbl_mst_geography`', 'tbl_mst_territory.id=`tbl_mst_geography`.`territory_id`', 'INNER');
        $this->db->join('`tbl_mst_area`', 'tbl_mst_geography.area_id=`tbl_mst_area`.`id`', 'INNER');
        if (!empty($area_cd) && isset($area_cd) && $area_cd != NULL && $area_cd != '-1') {
            //$this->db->where('area_cd', $area_cd);
            $this->db->where('`tbl_mst_area`.`id`', $area_cd);
        }
        $this->db->where(array('t_year' => $tyear, 't_mon' => $tmonth));
        $this->db->group_by('`tbl_mst_territory`.`reference_code`');
        $queryData = $this->db->get();
        $resultData = $queryData->result_array();
        echo $this->db->last_query();
        return $resultData;
    }

    function getDailySalesCategoryNewDemarcation($area = null, $range = null, $datepickermonth = null, $category = null, $type = 'value') {
        $str = '';
        if (!empty($area) && isset($area) && $area != null && $area != -1) {
            $str .= ' AND tbl_mst_area.id=' . $area . ' ';
        }
        if (!empty($range) && isset($range) && $range != null && $range != -1) {
            if ($range == 'D') {
                $str .= ' AND (invh.cd=\'' . $range . '\' OR invh.cd=\'S\' OR invh.cd=\'T\') ';
            } else {
                $str .= ' AND (invh.cd=\'' . $range . '\' OR invh.cd=\'S\') ';
            }
        }
        $strQ = '';
        $monthNumber = date('m', strtotime($datepickermonth));
        $monthName = date('F', strtotime($datepickermonth));
        $year = date('Y', strtotime($datepickermonth));
        for ($n = 1; $n <= date('t', strtotime($datepickermonth)); $n++) {
            if ($type == 'value') {
                $strQ .= 'SUM(IF(month(invh.date_actual)=' . $monthNumber . ' AND year(invh.date_actual)=' . $year . ' AND day(invh.date_actual)=' . $n . ', (invd.a_Qty*invd.up),0)) AS `' . $monthName . '-' . $n . '`,';
            } else {
                $strQ .= 'SUM(IF(month(invh.date_actual)=' . $monthNumber . ' AND year(invh.date_actual)=' . $year . ' AND day(invh.date_actual)=' . $n . ', (invd.a_Qty*item_mst.pack),0)) AS `' . $monthName . '-' . $n . '`,';
            }
            $strQ .= 'COUNT(DISTINCT CASE WHEN (month(invh.date_actual)=' . $monthNumber . ' AND year(invh.date_actual)=' . $year . ' AND day(invh.date_actual)=' . $n . ') THEN shop_mst.Auto END) AS `' . $monthName . '-' . $n . '-pc`,';
        }
        $strBack = '';
        for ($k = 1; $k <= 6; $k++) {
            $monthNumberBack = date('m', strtotime($datepickermonth . ' -' . $k . ' month'));
            $monthNameBack = date('F', strtotime($datepickermonth . ' -' . $k . ' month'));
            $yearBack = date('Y', strtotime($datepickermonth . ' -' . $k . ' month'));
            if ($type == 'value') {
                $strBack .= ' SUM(IF(month(invh.date_actual)=' . $monthNumberBack . ' AND year(invh.date_actual)=' . $yearBack . ', invd.a_Qty*invd.up,0)) AS `' . $monthNameBack . '-Total`, ';
            } else {
                $strBack .= ' SUM(IF(month(invh.date_actual)=' . $monthNumberBack . ' AND year(invh.date_actual)=' . $yearBack . ', invd.a_Qty*item_mst.pack,0)) AS `' . $monthNameBack . '-Total`, ';
            }
        }
        $strK = '';
        if ($type == 'value') {
            $strK = 'SUM(IF(month(invh.date_actual)=' . $monthNumber . ' AND year(invh.date_actual)=' . $year . ', (invd.a_Qty*invd.up),0)) AS `' . $monthName . '-Total` ';
        } else {
            $strK = 'SUM(IF(month(invh.date_actual)=' . $monthNumber . ' AND year(invh.date_actual)=' . $year . ', (invd.a_Qty*item_mst.pack),0)) AS `' . $monthName . '-Total` ';
        }
        //INNER JOIN shop_mst ON invh.ag_cd=shop_mst.sh_ag_cd AND invh.ro_cd=shop_mst.sh_ro_cd AND invh.sh_cd=shop_mst.sh_cd 

        $q = $this->db->query('SELECT tbl_mst_region.region_name,tbl_mst_area.area_name,agency_mst.ag_name,invh.ag_cd,IF(invh.cd=\'T\',\'D\',invh.cd) AS cd,
 
' . $strQ . $strBack . $strK . ' 

FROM invh  
INNER JOIN invd ON invh.invno=invd.invno
INNER JOIN item_mst ON invd.item=item_mst.item
INNER JOIN tbl_mst_item_category_link_item ON invd.item=tbl_mst_item_category_link_item.item_id
INNER JOIN tbl_mst_item_category ON tbl_mst_item_category_link_item.category_id=tbl_mst_item_category.id
INNER JOIN tbl_mst_item_category_purpose_link_category ON tbl_mst_item_category.id=tbl_mst_item_category_purpose_link_category.category_id
INNER JOIN tbl_mst_item_category_purpose ON tbl_mst_item_category_purpose_link_category.purpose_id=tbl_mst_item_category_purpose.id
INNER JOIN shop_mst ON invh.ag_cd=shop_mst.sh_ag_cd AND invh.ro_cd=shop_mst.sh_ro_cd AND invh.sh_cd=shop_mst.sh_cd
INNER JOIN agency_mst ON invh.ag_cd=agency_mst.ag_cd 


INNER JOIN tbl_mst_territory ON agency_mst.ag_cd=`tbl_mst_territory`.`reference_code`
INNER JOIN tbl_mst_range ON invh.cd=tbl_mst_range.range_name
INNER JOIN tbl_mst_geography ON tbl_mst_territory.id=tbl_mst_geography.territory_id AND tbl_mst_geography.range_id=tbl_mst_range.id 
INNER JOIN tbl_mst_area ON tbl_mst_geography.area_id=tbl_mst_area.id
INNER JOIN tbl_mst_region ON tbl_mst_geography.region_id=tbl_mst_region.id

WHERE invd.a_Qty<>0 AND tbl_mst_item_category_purpose.id=3 AND tbl_mst_item_category.id=' . $category . ' AND invh.date_actual>=\'' . date('Y-m-01', strtotime($datepickermonth . ' -6 month')) . '\' AND invh.date_actual<=\'' . date('Y-m-t', strtotime($datepickermonth)) . '\' AND invh.b_a=\'A\' AND invh.tot_a_val<>0 ' . $str . '
GROUP BY tbl_mst_area.area_name,agency_mst.ag_name,invh.ag_cd,invh.cd,tbl_mst_item_category.id
ORDER BY tbl_mst_region.id,tbl_mst_area.area_name,agency_mst.ag_name,invh.ag_cd,cd');
        $result = $q->result_array();
        //echo $this->db->last_query();
        return $result;
    }

    function getTotalSalesandPcNewDemarcation($area = null, $range = null, $datepickermonth = null) {
        $str = '';
        if (!empty($area) && isset($area) && $area != null && $area != -1) {
            $str .= ' AND tbl_mst_area.id=' . $area . ' ';
        }
        if (!empty($range) && isset($range) && $range != null && $range != -1) {

            /* if ($range == 'D') {
              $str .= ' AND (invh.cd=\'' . $range . '\' OR invh.cd=\'S\' OR invh.cd=\'T\') ';
              } else {
              $str .= ' AND (invh.cd=\'' . $range . '\' OR invh.cd=\'S\') ';
              } */

            if ($range == 'D') {
                $str .= ' AND (invh.cd=\'' . $range . '\' OR invh.cd=\'T\') ';
            } else {
                $str .= ' AND (invh.cd=\'' . $range . '\') ';
            }
        }
        $strBack = '';
        for ($k = 1; $k <= 6; $k++) {
            $monthNumberBack = date('m', strtotime($datepickermonth . ' -' . $k . ' month'));
            $monthNameBack = date('F', strtotime($datepickermonth . ' -' . $k . ' month'));
            $yearBack = date('Y', strtotime($datepickermonth . ' -' . $k . ' month'));
            $strBack .= 'COUNT(IF(month(a.dates)=' . $monthNumberBack . ' AND year(a.dates)=' . $yearBack . ', a.dates,null)) as ' . $monthNameBack . '_WD, SUM(IF(month(a.dates)=' . $monthNumberBack . ' AND year(a.dates)=' . $yearBack . ', a.pc,0)) as ' . $monthNameBack . '_TotPC ,';
        }
        //INNER JOIN shop_mst ON invh.ag_cd=shop_mst.sh_ag_cd AND invh.ro_cd=shop_mst.sh_ro_cd AND invh.sh_cd=shop_mst.sh_cd 

        $query = 'select  
            ' . $strBack . '
            a.ag_cd
from (SELECT invh.ag_cd AS ag_cd,invh.date_actual AS dates, COUNT(DISTINCT shop_mst.Auto) AS pc
FROM invh 
INNER JOIN shop_mst ON invh.ag_cd=shop_mst.sh_ag_cd AND invh.ro_cd=shop_mst.sh_ro_cd AND invh.sh_cd=shop_mst.sh_cd 
INNER JOIN agency_mst ON invh.ag_cd=agency_mst.ag_cd 

INNER JOIN tbl_mst_territory ON agency_mst.ag_cd=`tbl_mst_territory`.`reference_code`
INNER JOIN tbl_mst_range ON invh.cd=tbl_mst_range.range_name
INNER JOIN tbl_mst_geography ON tbl_mst_territory.id=tbl_mst_geography.territory_id AND tbl_mst_geography.range_id=tbl_mst_range.id
INNER JOIN tbl_mst_area ON tbl_mst_geography.area_id=tbl_mst_area.id

WHERE invh.date_actual>=\'' . date('Y-m-01', strtotime($datepickermonth . ' -6 month')) . '\' AND invh.date_actual<=\'' . date('Y-m-t', strtotime($datepickermonth)) . '\' AND invh.b_a=\'A\' AND invh.tot_a_val<>0 ' . $str . '
GROUP BY invh.ag_cd,invh.date_actual ) a GROUP BY a.ag_cd';
        $result = $this->db->query($query)->result_array();
        //echo $this->db->last_query();
        return $result;
    }

    function getTotalSalesandPcCategoryNewDemarcation($area = null, $range = null, $datepickermonth = null, $category = null) {
        $str = '';
        if (!empty($area) && isset($area) && $area != null && $area != -1) {
            $str .= ' AND tbl_mst_area.id=' . $area . ' ';
        }
        if (!empty($range) && isset($range) && $range != null && $range != -1) {
            if ($range == 'D') {
                $str .= ' AND (invh.cd=\'' . $range . '\' OR invh.cd=\'S\' OR invh.cd=\'T\') ';
            } else {
                $str .= ' AND (invh.cd=\'' . $range . '\' OR invh.cd=\'S\') ';
            }
        }
        $strBack = '';
        for ($k = 1; $k <= 6; $k++) {
            $monthNumberBack = date('m', strtotime($datepickermonth . ' -' . $k . ' month'));
            $monthNameBack = date('F', strtotime($datepickermonth . ' -' . $k . ' month'));
            $yearBack = date('Y', strtotime($datepickermonth . ' -' . $k . ' month'));
            $strBack .= 'COUNT(IF(month(a.dates)=' . $monthNumberBack . ' AND year(a.dates)=' . $yearBack . ', a.dates,null)) as ' . $monthNameBack . '_WD, SUM(IF(month(a.dates)=' . $monthNumberBack . ' AND year(a.dates)=' . $yearBack . ', a.pc,0)) as ' . $monthNameBack . '_TotPC ,';
        }
        //removed this from bottom before INNER JOIN agency_mst ON invh.ag_cd=agency_mst.ag_cd 
        //INNER JOIN shop_mst ON invh.ag_cd=shop_mst.sh_ag_cd AND invh.ro_cd=shop_mst.sh_ro_cd AND invh.sh_cd=shop_mst.sh_cd 

        $query = 'select  
            ' . $strBack . '
            a.ag_cd
from (SELECT invh.ag_cd AS ag_cd,invh.date_actual AS dates, COUNT(DISTINCT shop_mst.Auto) AS pc
FROM invh 
INNER JOIN invd ON invh.invno=invd.invno
INNER JOIN tbl_mst_item ON invd.ln=tbl_mst_item.ln
INNER JOIN tbl_mst_item_category_link_item ON tbl_mst_item.item=tbl_mst_item_category_link_item.item_id
INNER JOIN tbl_mst_item_category ON tbl_mst_item_category_link_item.category_id=tbl_mst_item_category.id
INNER JOIN tbl_mst_item_category_purpose_link_category ON tbl_mst_item_category.id=tbl_mst_item_category_purpose_link_category.category_id
INNER JOIN tbl_mst_item_category_purpose ON tbl_mst_item_category_purpose_link_category.purpose_id=tbl_mst_item_category_purpose.id
INNER JOIN shop_mst ON invh.ag_cd=shop_mst.sh_ag_cd AND invh.ro_cd=shop_mst.sh_ro_cd AND invh.sh_cd=shop_mst.sh_cd 
INNER JOIN agency_mst ON invh.ag_cd=agency_mst.ag_cd 

INNER JOIN tbl_mst_territory ON agency_mst.ag_cd=`tbl_mst_territory`.`reference_code`
INNER JOIN tbl_mst_range ON invh.cd=tbl_mst_range.range_name
INNER JOIN tbl_mst_geography ON tbl_mst_territory.id=tbl_mst_geography.territory_id AND tbl_mst_geography.range_id=tbl_mst_range.id
INNER JOIN tbl_mst_area ON tbl_mst_geography.area_id=tbl_mst_area.id

WHERE invd.a_Qty<>0 AND tbl_mst_item_category_purpose.id=3 AND tbl_mst_item_category.id=' . $category . ' AND invh.date_actual>=\'' . date('Y-m-01', strtotime($datepickermonth . ' -6 month')) . '\' AND invh.date_actual<=\'' . date('Y-m-t', strtotime($datepickermonth)) . '\' AND invh.b_a=\'A\' AND invh.tot_a_val<>0 ' . $str . '
GROUP BY invh.ag_cd,invh.date_actual ) a GROUP BY a.ag_cd';
        //echo $query; die();
        $result = $this->db->query($query)->result_array();
        //echo $this->db->last_query(); die();
        return $result;
    }

    function getDailyPcTotalsNewDemarcation($areaID = null, $territoryID = null, $routeID = null, $rangeID = null, $billingType = null, $dateFrom = null, $dateTo = null, $reportType = 'summery', $channel_id = 1) {
        if ($reportType == 'summery_area') {//area wise sales summery data
            if ($billingType == 'A') {
                if ($rangeID == 2) {//D OPERATION
                    $this->db->select('`tbl_mst_channel`.`id` AS `channel_id`,`tbl_mst_area`.`id` AS `area_id`,`tbl_mst_area`.`area_name`,IF(`tbl_mst_range`.`id`=5 OR `tbl_mst_range`.`id`=3,2,`tbl_mst_range`.`id`) AS `range_id`,IF(`tbl_mst_range`.`range_name`=\'T\' OR `tbl_mst_range`.`range_name`=\'S\',\'D\',`tbl_mst_range`.`range_name`) AS `range_name`, `invh`.`date_actual`,COUNT(DISTINCT(`invh`.`invno`)) AS `totBills`,COUNT(DISTINCT(`shop_mst`.`Auto`)) AS `totPC` ,COUNT(DISTINCT(CASE WHEN (tot_c_val>0 AND tot_a_val=0) THEN `shop_mst`.`Auto` END)) AS `totCancelPC`, COUNT(DISTINCT(CASE WHEN (b_a =\'A\' AND tot_a_val <> 0) THEN `shop_mst`.`Auto` END)) AS `totActualPC` ,SUM(`invh`.`tot_b_val`) AS `totBval`,SUM(`invh`.`tot_c_val`) AS `totCval`,SUM(`invh`.`tot_g_val`) AS `totGval`,SUM(`invh`.`tot_m_val`) AS `totMval`,SUM(IF(`tbl_mst_range`.`id`=3,(`invh`.`tot_a_val`*`invh_cd_ratio`.`d_ratio`),`invh`.`tot_a_val`)) AS `totAval`, SUM(IF(`tbl_mst_range`.`id`=3,(`invh`.`tot_dis`*`invh_cd_ratio`.`d_ratio`),`invh`.`tot_dis`)) AS `totDisval`');
                } elseif ($rangeID == 1) {//C OPERATION
                    //$this->db->select('`tbl_mst_channel`.`id` AS `channel_id`,`tbl_mst_area`.`id` AS `area_id`,`tbl_mst_area`.`area_name`,IF(`tbl_mst_range`.`id`=3,1,`tbl_mst_range`.`id`) AS `range_id`,IF(`tbl_mst_range`.`range_name`=\'S\',\'C\',`tbl_mst_range`.`range_name`) AS `range_name`, `invh`.`date_actual`,COUNT(DISTINCT(`invh`.`invno`)) AS `totBills`,COUNT(DISTINCT(`shop_mst`.`Auto`)) AS `totPC` ,COUNT(DISTINCT(CASE WHEN (`tot_c_val`>0 AND `tot_a_val`=0) THEN `shop_mst`.`Auto` END)) AS `totCancelPC`, COUNT(DISTINCT(CASE WHEN (`b_a` =\'A\' AND `tot_a_val` <> 0) THEN `shop_mst`.`Auto` END)) AS `totActualPC` ,SUM(`invh`.`tot_b_val`) AS `totBval`,SUM(`invh`.`tot_c_val`) AS `totCval`,SUM(`invh`.`tot_g_val`) AS `totGval`,SUM(`invh`.`tot_m_val`) AS `totMval`, SUM(IF(`tbl_mst_range`.`id`=3,`invh`.`tot_a_val`*`invh_cd_ratio`.`c_ratio`,`invh`.`tot_a_val`)) AS `totAval`, SUM(IF(`tbl_mst_range`.`id`=3,`invh`.`tot_dis`*`invh_cd_ratio`.`c_ratio`,`invh`.`tot_dis`)) AS `totDisval`');
                    $this->db->select('`tbl_mst_channel`.`id` AS `channel_id`, `tbl_mst_area`.`id` AS `area_id`, `tbl_mst_area`.`area_name`, IF(`tbl_mst_range`.`id`=3, 1, `tbl_mst_range`.`id`) AS `range_id`, IF(`tbl_mst_range`.`range_name`=\'S\', \'C\', `tbl_mst_range`.`range_name`) AS `range_name`, `invh`.`date_actual`, COUNT(DISTINCT(`invh`.`invno`)) AS `totBills`, COUNT(DISTINCT(`shop_mst`.`Auto`)) AS `totPC`, COUNT(DISTINCT(CASE WHEN (`tot_c_val`>0 AND `tot_a_val`=0) THEN `shop_mst`.`Auto` END)) AS `totCancelPC`, COUNT(DISTINCT(CASE WHEN (`b_a` =\'A\' AND `tot_a_val` <> 0) THEN `shop_mst`.`Auto` END)) AS `totActualPC`, SUM(`invh`.`tot_b_val`) AS `totBval`, SUM(`invh`.`tot_c_val`) AS `totCval`, SUM(`invh`.`tot_g_val`) AS `totGval`, SUM(`invh`.`tot_m_val`) AS `totMval`, SUM(IF(`tbl_mst_range`.`id`=3, (`invh`.`tot_a_val`*`invh_cd_ratio`.`c_ratio`), `invh`.`tot_a_val`)) AS `totAval`, SUM(IF(`tbl_mst_range`.`id`=3, (`invh`.`tot_dis`*`invh_cd_ratio`.`c_ratio`), `invh`.`tot_dis`)) AS `totDisval`');
                } else {
                    $this->db->select('`tbl_mst_channel`.`id` AS `channel_id`,`tbl_mst_area`.`id` AS `area_id`,`tbl_mst_area`.`area_name`,IF(`tbl_mst_range`.`id`=5,2,`tbl_mst_range`.`id`) AS `range_id`,IF(`tbl_mst_range`.`range_name`=\'T\',\'D\',`tbl_mst_range`.`range_name`) AS `range_name`, `invh`.`date_actual`,COUNT(DISTINCT(`invh`.`invno`)) AS `totBills`,COUNT(DISTINCT(`shop_mst`.`Auto`)) AS `totPC` ,COUNT(DISTINCT(CASE WHEN (`tot_c_val`>0 AND tot_a_val=0) THEN `shop_mst`.`Auto` END)) AS `totCancelPC`, COUNT(DISTINCT(CASE WHEN (b_a =\'A\' AND tot_a_val <> 0) THEN `shop_mst`.`Auto` END)) AS `totActualPC` ,SUM(`invh`.`tot_b_val`) AS `totBval`,SUM(`invh`.`tot_c_val`) AS `totCval`,SUM(`invh`.`tot_g_val`) AS `totGval`,SUM(`invh`.`tot_m_val`) AS `totMval`,SUM(`invh`.`tot_a_val`) AS `totAval`, SUM(`invh`.`tot_dis`) AS `totDisval`');
                }
            } else {
                $this->db->select('`tbl_mst_channel`.`id` AS `channel_id`,`tbl_mst_area`.`id`,`invh`.`date_book`,COUNT(DISTINCT(`invh`.`invno`)) AS `totBills`,COUNT(DISTINCT(`shop_mst`.`Auto`)) AS `totPC` ,COUNT(DISTINCT(CASE WHEN (tot_c_val>0 AND tot_a_val=0) THEN `shop_mst`.`Auto` END)) AS `totCancelPC`, COUNT(DISTINCT(CASE WHEN (b_a =\'A\' AND tot_a_val <> 0) THEN `shop_mst`.`Auto` END)) AS `totActualPC` ,SUM(`invh`.`tot_b_val`) AS `totBval`,SUM(`invh`.`tot_c_val`) AS `totCval`,SUM(`invh`.`tot_g_val`) AS `totGval`,SUM(`invh`.`tot_m_val`) AS `totMval`,SUM(`invh`.`tot_a_val`) AS `totAval`, SUM(`invh`.`tot_dis`) AS `totDisval`');
            }
        } elseif ($reportType == 'summery') {
            if ($billingType == 'A') {
                if ($rangeID == 2) {//D OPERATION
                    $this->db->select('`invh`.`date_actual`,COUNT(DISTINCT(`invh`.`invno`)) AS `totBills`,COUNT(DISTINCT(`shop_mst`.`Auto`)) AS `totPC` ,COUNT(DISTINCT(CASE WHEN (tot_c_val>0 AND tot_a_val=0) THEN `shop_mst`.`Auto` END)) AS `totCancelPC`, COUNT(DISTINCT(CASE WHEN (b_a =\'A\' AND tot_a_val <> 0) THEN `shop_mst`.`Auto` END)) AS `totActualPC` ,SUM(`invh`.`tot_b_val`) AS `totBval`,SUM(`invh`.`tot_c_val`) AS `totCval`,SUM(`invh`.`tot_g_val`) AS `totGval`,SUM(`invh`.`tot_m_val`) AS `totMval`,SUM(IF(`tbl_mst_range`.`id`=3,(`invh`.`tot_a_val`*`invh_cd_ratio`.`d_ratio`),`invh`.`tot_a_val`)) AS `totAval`, SUM(IF(`tbl_mst_range`.`id`=3,(`invh`.`tot_dis`*`invh_cd_ratio`.`d_ratio`) ,`invh`.`tot_dis`)) AS `totDisval`');
                } elseif ($rangeID == 1) {//C OPERATION
                    $this->db->select('`invh`.`date_actual`,COUNT(DISTINCT(`invh`.`invno`)) AS `totBills`,COUNT(DISTINCT(`shop_mst`.`Auto`)) AS `totPC` ,COUNT(DISTINCT(CASE WHEN (tot_c_val>0 AND tot_a_val=0) THEN `shop_mst`.`Auto` END)) AS `totCancelPC`, COUNT(DISTINCT(CASE WHEN (b_a =\'A\' AND tot_a_val <> 0) THEN `shop_mst`.`Auto` END)) AS `totActualPC` ,SUM(`invh`.`tot_b_val`) AS `totBval`,SUM(`invh`.`tot_c_val`) AS `totCval`,SUM(`invh`.`tot_g_val`) AS `totGval`,SUM(`invh`.`tot_m_val`) AS `totMval`,SUM(IF(`tbl_mst_range`.`id`=3,(`invh`.`tot_a_val`*`invh_cd_ratio`.`c_ratio`),`invh`.`tot_a_val`)) AS `totAval`, SUM(IF(`tbl_mst_range`.`id`=3,(`invh`.`tot_dis`*`invh_cd_ratio`.`c_ratio`) ,`invh`.`tot_dis`)) AS `totDisval`');
                } else {
                    $this->db->select('`invh`.`date_actual`,COUNT(DISTINCT(`invh`.`invno`)) AS `totBills`,COUNT(DISTINCT(`shop_mst`.`Auto`)) AS `totPC` ,COUNT(DISTINCT(CASE WHEN (tot_c_val>0 AND tot_a_val=0) THEN `shop_mst`.`Auto` END)) AS `totCancelPC`, COUNT(DISTINCT(CASE WHEN (b_a =\'A\' AND tot_a_val <> 0) THEN `shop_mst`.`Auto` END)) AS `totActualPC` ,SUM(`invh`.`tot_b_val`) AS `totBval`,SUM(`invh`.`tot_c_val`) AS `totCval`,SUM(`invh`.`tot_g_val`) AS `totGval`,SUM(`invh`.`tot_m_val`) AS `totMval`,SUM(`invh`.`tot_a_val`) AS `totAval`, SUM(`invh`.`tot_dis`) AS `totDisval`');
                }
            } else {
                $this->db->select('`invh`.`date_book`,COUNT(DISTINCT(`invh`.`invno`)) AS `totBills`,COUNT(DISTINCT(`shop_mst`.`Auto`)) AS `totPC` ,COUNT(DISTINCT(CASE WHEN (tot_c_val>0 AND tot_a_val=0) THEN `shop_mst`.`Auto` END)) AS `totCancelPC`, COUNT(DISTINCT(CASE WHEN (b_a =\'A\' AND tot_a_val <> 0) THEN `shop_mst`.`Auto` END)) AS `totActualPC` ,SUM(`invh`.`tot_b_val`) AS `totBval`,SUM(`invh`.`tot_c_val`) AS `totCval`,SUM(`invh`.`tot_g_val`) AS `totGval`,SUM(`invh`.`tot_m_val`) AS `totMval`,SUM(`invh`.`tot_a_val`) AS `totAval`, SUM(`invh`.`tot_dis`) AS `totDisval`');
            }
        } elseif ($reportType == 'summery_territory') {
            if ($billingType == 'A') {
                if ($rangeID == 2) {//D OPERATION
                    //$this->db->select('`tbl_mst_area`.`id` AS `area_id`,`invh`.`date_actual`,`tbl_mst_territory`.`id`,`tbl_mst_territory`.`reference_code`,`tbl_mst_territory`.`territory_name`,IF(`tbl_mst_range`.`id`=5,2,`tbl_mst_range`.`id`) AS `range_id`,IF(`tbl_mst_range`.`range_name`=\'T\',\'D\',`tbl_mst_range`.`range_name`) AS `range_name`,COUNT(DISTINCT(`invh`.`invno`)) AS `totBills`,COUNT(DISTINCT(`shop_mst`.`Auto`)) AS `totPC` ,COUNT(DISTINCT(CASE WHEN (tot_c_val>0 AND tot_a_val=0) THEN `shop_mst`.`Auto` END)) AS `totCancelPC`, COUNT(DISTINCT(CASE WHEN (b_a =\'A\' AND tot_a_val <> 0) THEN `shop_mst`.`Auto` END)) AS `totActualPC` ,SUM(`invh`.`tot_b_val`) AS `totBval`,SUM(`invh`.`tot_c_val`) AS `totCval`,SUM(`invh`.`tot_g_val`) AS `totGval`,SUM(`invh`.`tot_m_val`) AS `totMval`,SUM(`invh`.`tot_a_val`) AS `totAval`, SUM(`invh`.`tot_dis`) AS `totDisval`');
                    $this->db->select('`tbl_mst_area`.`id` AS `area_id`,`invh`.`date_actual`,`tbl_mst_territory`.`id`,`tbl_mst_territory`.`reference_code`,`tbl_mst_territory`.`territory_name`,IF(`tbl_mst_range`.`id`=5,2,`tbl_mst_range`.`id`) AS `range_id`,IF(`tbl_mst_range`.`range_name`=\'T\',\'D\',`tbl_mst_range`.`range_name`) AS `range_name`,COUNT(DISTINCT(`invh`.`invno`)) AS `totBills`,COUNT(DISTINCT(`shop_mst`.`Auto`)) AS `totPC` ,COUNT(DISTINCT(CASE WHEN (tot_c_val>0 AND tot_a_val=0) THEN `shop_mst`.`Auto` END)) AS `totCancelPC`, COUNT(DISTINCT(CASE WHEN (b_a =\'A\' AND tot_a_val <> 0) THEN `shop_mst`.`Auto` END)) AS `totActualPC` ,SUM(`invh`.`tot_b_val`) AS `totBval`,SUM(`invh`.`tot_c_val`) AS `totCval`,SUM(`invh`.`tot_g_val`) AS `totGval`,SUM(`invh`.`tot_m_val`) AS `totMval`,SUM(IF(`tbl_mst_range`.`id`=3,(`invh`.`tot_a_val`*`invh_cd_ratio`.`d_ratio`),`invh`.`tot_a_val`)) AS `totAval`, SUM(IF(`tbl_mst_range`.`id`=3,(`invh`.`tot_dis`*`invh_cd_ratio`.`d_ratio`),`invh`.`tot_dis`)) AS `totDisval`');
                } elseif ($rangeID == 1) {//C OPERATION
                    //$this->db->select('`tbl_mst_area`.`id` AS `area_id`,`invh`.`date_actual`,`tbl_mst_territory`.`id`,`tbl_mst_territory`.`reference_code`,`tbl_mst_territory`.`territory_name`,IF(`tbl_mst_range`.`id`=5,2,`tbl_mst_range`.`id`) AS `range_id`,IF(`tbl_mst_range`.`range_name`=\'T\',\'D\',`tbl_mst_range`.`range_name`) AS `range_name`,COUNT(DISTINCT(`invh`.`invno`)) AS `totBills`,COUNT(DISTINCT(`shop_mst`.`Auto`)) AS `totPC` ,COUNT(DISTINCT(CASE WHEN (tot_c_val>0 AND tot_a_val=0) THEN `shop_mst`.`Auto` END)) AS `totCancelPC`, COUNT(DISTINCT(CASE WHEN (b_a =\'A\' AND tot_a_val <> 0) THEN `shop_mst`.`Auto` END)) AS `totActualPC` ,SUM(`invh`.`tot_b_val`) AS `totBval`,SUM(`invh`.`tot_c_val`) AS `totCval`,SUM(`invh`.`tot_g_val`) AS `totGval`,SUM(`invh`.`tot_m_val`) AS `totMval`,SUM(`invh`.`tot_a_val`) AS `totAval`, SUM(`invh`.`tot_dis`) AS `totDisval`');
                    $this->db->select('`tbl_mst_area`.`id` AS `area_id`,`invh`.`date_actual`,`tbl_mst_territory`.`id`,`tbl_mst_territory`.`reference_code`,`tbl_mst_territory`.`territory_name`,IF(`tbl_mst_range`.`id`=5,2,`tbl_mst_range`.`id`) AS `range_id`,IF(`tbl_mst_range`.`range_name`=\'T\',\'D\',`tbl_mst_range`.`range_name`) AS `range_name`,COUNT(DISTINCT(`invh`.`invno`)) AS `totBills`,COUNT(DISTINCT(`shop_mst`.`Auto`)) AS `totPC` ,COUNT(DISTINCT(CASE WHEN (tot_c_val>0 AND tot_a_val=0) THEN `shop_mst`.`Auto` END)) AS `totCancelPC`, COUNT(DISTINCT(CASE WHEN (b_a =\'A\' AND tot_a_val <> 0) THEN `shop_mst`.`Auto` END)) AS `totActualPC` ,SUM(`invh`.`tot_b_val`) AS `totBval`,SUM(`invh`.`tot_c_val`) AS `totCval`,SUM(`invh`.`tot_g_val`) AS `totGval`,SUM(`invh`.`tot_m_val`) AS `totMval`,SUM(IF(`tbl_mst_range`.`id`=3,(`invh`.`tot_a_val`*`invh_cd_ratio`.`c_ratio`),`invh`.`tot_a_val`)) AS `totAval`, SUM(IF(`tbl_mst_range`.`id`=3,(`invh`.`tot_dis`*`invh_cd_ratio`.`c_ratio`),`invh`.`tot_dis`)) AS `totDisval`');
                } else {
                    $this->db->select('`tbl_mst_area`.`id` AS `area_id`,`invh`.`date_actual`,`tbl_mst_territory`.`id`,`tbl_mst_territory`.`reference_code`,`tbl_mst_territory`.`territory_name`,IF(`tbl_mst_range`.`id`=5,2,`tbl_mst_range`.`id`) AS `range_id`,IF(`tbl_mst_range`.`range_name`=\'T\',\'D\',`tbl_mst_range`.`range_name`) AS `range_name`,COUNT(DISTINCT(`invh`.`invno`)) AS `totBills`,COUNT(DISTINCT(`shop_mst`.`Auto`)) AS `totPC` ,COUNT(DISTINCT(CASE WHEN (tot_c_val>0 AND tot_a_val=0) THEN `shop_mst`.`Auto` END)) AS `totCancelPC`, COUNT(DISTINCT(CASE WHEN (b_a =\'A\' AND tot_a_val <> 0) THEN `shop_mst`.`Auto` END)) AS `totActualPC` ,SUM(`invh`.`tot_b_val`) AS `totBval`,SUM(`invh`.`tot_c_val`) AS `totCval`,SUM(`invh`.`tot_g_val`) AS `totGval`,SUM(`invh`.`tot_m_val`) AS `totMval`,SUM(`invh`.`tot_a_val`) AS `totAval`, SUM(`invh`.`tot_dis`) AS `totDisval`');
                }
            } else {
                $this->db->select('`invh`.`date_book`,COUNT(DISTINCT(`invh`.`invno`)) AS `totBills`,COUNT(DISTINCT(`shop_mst`.`Auto`)) AS `totPC` ,COUNT(DISTINCT(CASE WHEN (tot_c_val>0 AND tot_a_val=0) THEN `shop_mst`.`Auto` END)) AS `totCancelPC`, COUNT(DISTINCT(CASE WHEN (b_a =\'A\' AND tot_a_val <> 0) THEN `shop_mst`.`Auto` END)) AS `totActualPC` ,SUM(`invh`.`tot_b_val`) AS `totBval`,SUM(`invh`.`tot_c_val`) AS `totCval`,SUM(`invh`.`tot_g_val`) AS `totGval`,SUM(`invh`.`tot_m_val`) AS `totMval`,SUM(`invh`.`tot_a_val`) AS `totAval`, SUM(`invh`.`tot_dis`) AS `totDisval`');
            }
        } else {
            $this->db->select('invh.invno, sh_name,invh.ro_cd as ro,tot_b_val,tot_c_val,tot_m_val,tot_g_val,tot_f_val,tot_dis,tot_a_val,date_book,date_actual');
        }
        $this->db->from('`invh`');
        //S RANGE SUPPORT
        $this->db->join('`invh_cd_ratio`', '`invh`.`invno`=`invh_cd_ratio`.`invno`', 'LEFT');

        $this->db->join('`shop_mst`', '`invh`.`ag_cd`=`shop_mst`.`sh_ag_cd` AND `invh`.`ro_cd`=`shop_mst`.`sh_ro_cd` AND `invh`.`sh_cd`=`shop_mst`.`sh_cd`', 'INNER');
        $this->db->join('`tbl_mst_territory`', '`invh`.`ag_cd`=`tbl_mst_territory`.`reference_code`', 'INNER');

        //$this->db->join('`tbl_mst_area_link_territory`', '`tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id`', 'INNER');
        //$this->db->join('`tbl_mst_area`', '`tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id`', 'INNER');
        $this->db->join('`tbl_mst_range`', '`invh`.`cd`=`tbl_mst_range`.`range_name`', 'INNER');

        //$this->db->join('`tbl_mst_region_link_area`', '`tbl_mst_area`.`id`=`tbl_mst_region_link_area`.`area_id`', 'INNER');
        //$this->db->join('`tbl_mst_region`', '`tbl_mst_region_link_area`.`region_id`=`tbl_mst_region`.`id`', 'INNER');
        //$this->db->join('`tbl_mst_channel_region`', '`tbl_mst_region`.`id`=`tbl_mst_channel_region`.`region_id`', 'INNER');
        //$this->db->join('`tbl_mst_channel`', '`tbl_mst_channel_region`.`channel_id`=`tbl_mst_channel`.`id`', 'INNER');
        $this->db->join('`tbl_mst_geography`', 'tbl_mst_geography.territory_id=tbl_mst_territory.id AND tbl_mst_geography.range_id=tbl_mst_range.id', 'LEFT');
        $this->db->join('`tbl_mst_area`', 'tbl_mst_geography.area_id=tbl_mst_area.id', 'INNER');
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
                    //$this->db->where('(`tbl_mst_range`.`id`=2 OR `tbl_mst_range`.`id`=5)');
                    $this->db->where('(`tbl_mst_range`.`id`=2 OR `tbl_mst_range`.`id`=3 OR `tbl_mst_range`.`id`=5)');
                } elseif ($rangeID == 1) {//town operation taken as D range
                    //$this->db->where('(`tbl_mst_range`.`id`=2 OR `tbl_mst_range`.`id`=5)');
                    $this->db->where('(`tbl_mst_range`.`id`=1 OR `tbl_mst_range`.`id`=3)');
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
                    //$this->db->where('(`tbl_mst_range`.`id`=2 OR `tbl_mst_range`.`id`=5)');
                    //S OPERATION INTO D range
                    $this->db->where('(`tbl_mst_range`.`id`=2 OR `tbl_mst_range`.`id`=3 OR `tbl_mst_range`.`id`=5)');
                } else if ($rangeID == 1) {//S operation taken as C range
                    //S OPERATION INTO D range
                    $this->db->where('(`tbl_mst_range`.`id`=1 OR `tbl_mst_range`.`id`=3)');
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
        //echo $this->db->last_query() . '<br>';
        return $resultData;
    }

    function getDailyPcTotalsNewNewDemarcation($areaID = null, $territoryID = null, $routeID = null, $rangeID = null, $billingType = null, $dateFrom = null, $dateTo = null, $reportType = 'summery', $channel_id = 1) {
        if ($reportType == 'summery_area') {//area wise sales summery data
            if ($billingType == 'A') {
                $this->db->select('`tbl_mst_channel`.`id` AS `channel_id`,`tbl_mst_area`.`id` AS `area_id`,`tbl_mst_area`.`area_name`,IF(`tbl_mst_range`.`id`=5,2,`tbl_mst_range`.`id`) AS `range_id`,IF(`tbl_mst_range`.`range_name`=\'T\',\'D\',`tbl_mst_range`.`range_name`) AS `range_name`, `tbl_trans_order_h`.`inv_date` AS `date_actual`,COUNT(DISTINCT(`tbl_trans_order_h`.`app_inv_no`)) AS `totBills`,COUNT(DISTINCT(`tbl_mst_outlet`.`id`)) AS `totPC` ,COUNT(DISTINCT(CASE WHEN (header_cancel_value>0 AND header_net_value=0) THEN `tbl_mst_outlet`.`id` END)) AS `totCancelPC`, COUNT(DISTINCT(CASE WHEN (inv_type =\'A\' AND header_net_value <> 0) THEN `tbl_mst_outlet`.`id` END)) AS `totActualPC` ,SUM(`tbl_trans_order_h`.`header_net_value`) AS `totBval`,SUM(`tbl_trans_order_h`.`header_cancel_value`) AS `totCval`,SUM(`tbl_trans_order_h`.`header_gr_value`) AS `totGval`,SUM(`tbl_trans_order_h`.`header_mr_value`) AS `totMval`,SUM(`tbl_trans_order_h`.`header_net_value`) AS `totAval`, SUM(`tbl_trans_order_h`.`total_discount_value`) AS `totDisval`');
            } else {
                $this->db->select('`tbl_mst_channel`.`id` AS `channel_id`,`tbl_mst_area`.`id`,`tbl_trans_order_h`.`inv_date` AS `date_actual`,COUNT(DISTINCT(`tbl_trans_order_h`.`app_inv_no`)) AS `totBills`,COUNT(DISTINCT(`tbl_mst_outlet`.`id`)) AS `totPC` ,COUNT(DISTINCT(CASE WHEN (header_cancel_value>0 AND header_net_value=0) THEN `tbl_mst_outlet`.`id` END)) AS `totCancelPC`, COUNT(DISTINCT(CASE WHEN (inv_type =\'A\' AND header_net_value <> 0) THEN `tbl_mst_outlet`.`id` END)) AS `totActualPC` ,SUM(`tbl_trans_order_h`.`header_net_value`) AS `totBval`,SUM(`tbl_trans_order_h`.`header_cancel_value`) AS `totCval`,SUM(`tbl_trans_order_h`.`header_gr_value`) AS `totGval`,SUM(`tbl_trans_order_h`.`header_mr_value`) AS `totMval`,SUM(`tbl_trans_order_h`.`header_net_value`) AS `totAval`, SUM(`tbl_trans_order_h`.`total_discount_value`) AS `totDisval`');
            }
        } elseif ($reportType == 'summery') {
            if ($billingType == 'A') {
                $this->db->select('`tbl_trans_order_h`.`inv_date` AS `date_actual`,COUNT(DISTINCT(`tbl_trans_order_h`.`app_inv_no`)) AS `totBills`,COUNT(DISTINCT(`tbl_mst_outlet`.`id`)) AS `totPC` ,COUNT(DISTINCT(CASE WHEN (header_cancel_value>0 AND header_net_value=0) THEN `tbl_mst_outlet`.`id` END)) AS `totCancelPC`, COUNT(DISTINCT(CASE WHEN (inv_type =\'A\' AND header_net_value <> 0) THEN `tbl_mst_outlet`.`id` END)) AS `totActualPC` ,SUM(`tbl_trans_order_h`.`header_net_value`) AS `totBval`,SUM(`tbl_trans_order_h`.`header_cancel_value`) AS `totCval`,SUM(`tbl_trans_order_h`.`header_gr_value`) AS `totGval`,SUM(`tbl_trans_order_h`.`header_mr_value`) AS `totMval`,SUM(`tbl_trans_order_h`.`header_net_value`) AS `totAval`, SUM(`tbl_trans_order_h`.`total_discount_value`) AS `totDisval`');
            } else {
                $this->db->select('`tbl_trans_order_h`.`inv_date` AS `date_actual`,COUNT(DISTINCT(`tbl_trans_order_h`.`app_inv_no`)) AS `totBills`,COUNT(DISTINCT(`tbl_mst_outlet`.`id`)) AS `totPC` ,COUNT(DISTINCT(CASE WHEN (header_cancel_value>0 AND header_net_value=0) THEN `tbl_mst_outlet`.`id` END)) AS `totCancelPC`, COUNT(DISTINCT(CASE WHEN (inv_type =\'A\' AND header_net_value <> 0) THEN `tbl_mst_outlet`.`id` END)) AS `totActualPC` ,SUM(`tbl_trans_order_h`.`header_net_value`) AS `totBval`,SUM(`tbl_trans_order_h`.`header_cancel_value`) AS `totCval`,SUM(`tbl_trans_order_h`.`header_gr_value`) AS `totGval`,SUM(`tbl_trans_order_h`.`header_mr_value`) AS `totMval`,SUM(`tbl_trans_order_h`.`header_net_value`) AS `totAval`, SUM(`tbl_trans_order_h`.`total_discount_value`) AS `totDisval`');
            }
        } elseif ($reportType == 'summery_territory') {
            if ($billingType == 'A') {
                $this->db->select('`tbl_mst_area`.`id` AS `area_id`,`tbl_trans_order_h`.`inv_date` AS `date_actual`,`tbl_mst_territory`.`id`,`tbl_mst_territory`.`reference_code`,`tbl_mst_territory`.`territory_name`,IF(`tbl_mst_range`.`id`=5,2,`tbl_mst_range`.`id`) AS `range_id`,IF(`tbl_mst_range`.`range_name`=\'T\',\'D\',`tbl_mst_range`.`range_name`) AS `range_name`,COUNT(DISTINCT(`tbl_trans_order_h`.`app_inv_no`)) AS `totBills`,COUNT(DISTINCT(`tbl_mst_outlet`.`id`)) AS `totPC` ,COUNT(DISTINCT(CASE WHEN (header_cancel_value>0 AND header_net_value=0) THEN `tbl_mst_outlet`.`id` END)) AS `totCancelPC`, COUNT(DISTINCT(CASE WHEN (inv_type =\'A\' AND header_net_value <> 0) THEN `tbl_mst_outlet`.`id` END)) AS `totActualPC` ,SUM(`tbl_trans_order_h`.`header_net_value`) AS `totBval`,SUM(`tbl_trans_order_h`.`header_cancel_value`) AS `totCval`,SUM(`tbl_trans_order_h`.`header_gr_value`) AS `totGval`,SUM(`tbl_trans_order_h`.`header_mr_value`) AS `totMval`,SUM(`tbl_trans_order_h`.`header_net_value`) AS `totAval`, SUM(`tbl_trans_order_h`.`total_discount_value`) AS `totDisval`');
            } else {
                $this->db->select('`tbl_trans_order_h`.`inv_date` AS `date_actual`,COUNT(DISTINCT(`tbl_trans_order_h`.`app_inv_no`)) AS `totBills`,COUNT(DISTINCT(`tbl_mst_outlet`.`id`)) AS `totPC` ,COUNT(DISTINCT(CASE WHEN (header_cancel_value>0 AND header_net_value=0) THEN `tbl_mst_outlet`.`id` END)) AS `totCancelPC`, COUNT(DISTINCT(CASE WHEN (inv_type =\'A\' AND header_net_value <> 0) THEN `tbl_mst_outlet`.`id` END)) AS `totActualPC` ,SUM(`tbl_trans_order_h`.`header_net_value`) AS `totBval`,SUM(`tbl_trans_order_h`.`header_cancel_value`) AS `totCval`,SUM(`tbl_trans_order_h`.`header_gr_value`) AS `totGval`,SUM(`tbl_trans_order_h`.`header_mr_value`) AS `totMval`,SUM(`tbl_trans_order_h`.`header_net_value`) AS `totAval`, SUM(`tbl_trans_order_h`.`total_discount_value`) AS `totDisval`');
            }
        } else {
            $this->db->select('app_inv_no, bill_name,tbl_mst_territory.reference_code as ro,header_net_value,header_cancel_value,header_mr_value,header_gr_value,0 AS tot_f_val,total_discount_value,header_net_value,inv_date AS `date_actual`,inv_date AS `date_actual`');
        }
        $this->db->from('`tbl_trans_order_h`');
        $this->db->join('`tbl_mst_outlet`', '`tbl_trans_order_h`.`customer_id`=`tbl_mst_outlet`.`id`', 'INNER');
        $this->db->join('`tbl_mst_territory`', '`tbl_trans_order_h`.`territory_id`=`tbl_mst_territory`.`id`', 'INNER');
        //$this->db->join('`tbl_mst_area_link_territory`', '`tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id`', 'INNER');
        //$this->db->join('`tbl_mst_area`', '`tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id`', 'INNER');
        $this->db->join('`tbl_mst_range`', '`tbl_trans_order_h`.`range_id`=`tbl_mst_range`.`id`', 'INNER');

        //$this->db->join('`tbl_mst_region_link_area`', '`tbl_mst_area`.`id`=`tbl_mst_region_link_area`.`area_id`', 'INNER');
        //$this->db->join('`tbl_mst_region`', '`tbl_mst_region_link_area`.`region_id`=`tbl_mst_region`.`id`', 'INNER');
        //$this->db->join('`tbl_mst_channel_region`', '`tbl_mst_region`.`id`=`tbl_mst_channel_region`.`region_id`', 'INNER');
        //$this->db->join('`tbl_mst_channel`', '`tbl_mst_channel_region`.`channel_id`=`tbl_mst_channel`.`id`', 'INNER');

        $this->db->join('`tbl_mst_geography`', 'tbl_mst_geography.territory_id=tbl_mst_territory.id AND tbl_mst_geography.range_id=tbl_mst_range.id', 'LEFT');
        $this->db->join('`tbl_mst_area`', 'tbl_mst_geography.area_id=tbl_mst_area.id', 'INNER');
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

        if ($billingType == 'A') {
            if ($channel_id == 1) {
                $this->db->where('`tbl_trans_order_h`.`inv_type`', $billingType);
            } else {
                $this->db->where('`tbl_trans_order_h`.`inv_type`', 'B');
            }
            $this->db->where('`tbl_trans_order_h`.`inv_date`>=', $dateFrom);
            $this->db->where('`tbl_trans_order_h`.`inv_date`<=', $dateTo);
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
                $this->db->group_by('`tbl_trans_order_h`.`inv_date`');
            }
            //$this->db->order_by('`tbl_mst_territory`.`id`,`invh`.`date_actual`');
        } else {
            $this->db->where('`tbl_trans_order_h`.`inv_date`>=', $dateFrom);
            $this->db->where('`tbl_trans_order_h`.`inv_date`<=', $dateTo);

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
                $this->db->group_by('`tbl_trans_order_h`.`inv_date`');
            }
        }



        //echo $reportType;
        if ($reportType == 'summery_area') {//for area wise summery group them by area id
            if ($billingType == 'A') {
                $this->db->order_by('`tbl_mst_area`.`id`,`tbl_trans_order_h`.`inv_date`');
            } else {
                $this->db->order_by('`tbl_mst_area`.`id`,`tbl_trans_order_h`.`inv_date`');
            }
        } elseif ($reportType == 'summery') {
            if ($billingType == 'A') {
                $this->db->order_by('`tbl_trans_order_h`.`inv_date`');
            } else {
                $this->db->order_by('`tbl_trans_order_h`.`inv_date`');
            }
        } else {
            if ($billingType == 'A') {
                $this->db->order_by('`tbl_mst_territory`.`id`,`tbl_trans_order_h`.`inv_date`');
            } else {
                $this->db->order_by('`tbl_mst_territory`.`id`,`tbl_trans_order_h`.`inv_date`');
            }
        }
        //$this->db->order_by('`tbl_mst_territory`.`id`,`invh`.`date_book`');
        $queryData = $this->db->get();
        $resultData = $queryData->result_array();
        //echo $this->db->last_query().'<br>';
        return $resultData;
    }

}

?>