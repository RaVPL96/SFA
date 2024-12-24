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
                $this->db->select('`tbl_mst_channel`.`id` AS `channel_id`,`tbl_mst_area`.`id` AS `area_id`,`tbl_mst_area`.`area_name`,`tbl_mst_range`.`id` AS `range_id`,`tbl_mst_range`.`range_name`, `invh`.`date_actual`,COUNT(DISTINCT(`invh`.`invno`)) AS `totBills`,COUNT(DISTINCT(`shop_mst`.`Auto`)) AS `totPC` ,COUNT(DISTINCT(CASE WHEN (tot_c_val>0 AND tot_a_val=0) THEN `shop_mst`.`Auto` END)) AS `totCancelPC`, COUNT(DISTINCT(CASE WHEN (b_a =\'A\' AND tot_a_val <> 0) THEN `shop_mst`.`Auto` END)) AS `totActualPC` ,SUM(`invh`.`tot_b_val`) AS `totBval`,SUM(`invh`.`tot_c_val`) AS `totCval`,SUM(`invh`.`tot_g_val`) AS `totGval`,SUM(`invh`.`tot_m_val`) AS `totMval`,SUM(`invh`.`tot_a_val`) AS `totAval`, SUM(`invh`.`tot_dis`) AS `totDisval`');
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
                $this->db->select('`tbl_mst_area`.`id` AS `area_id`,`invh`.`date_actual`,`tbl_mst_territory`.`id`,`tbl_mst_territory`.`reference_code`,`tbl_mst_territory`.`territory_name`,`tbl_mst_range`.`id` AS `range_id`,`tbl_mst_range`.`range_name`,COUNT(DISTINCT(`invh`.`invno`)) AS `totBills`,COUNT(DISTINCT(`shop_mst`.`Auto`)) AS `totPC` ,COUNT(DISTINCT(CASE WHEN (tot_c_val>0 AND tot_a_val=0) THEN `shop_mst`.`Auto` END)) AS `totCancelPC`, COUNT(DISTINCT(CASE WHEN (b_a =\'A\' AND tot_a_val <> 0) THEN `shop_mst`.`Auto` END)) AS `totActualPC` ,SUM(`invh`.`tot_b_val`) AS `totBval`,SUM(`invh`.`tot_c_val`) AS `totCval`,SUM(`invh`.`tot_g_val`) AS `totGval`,SUM(`invh`.`tot_m_val`) AS `totMval`,SUM(`invh`.`tot_a_val`) AS `totAval`, SUM(`invh`.`tot_dis`) AS `totDisval`');
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
                $this->db->where('`tbl_mst_range`.`id`', $rangeID);
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
                $this->db->where('`tbl_mst_range`.`id`', $rangeID);
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
            $this->db->select('invh.ag_cd,invh.invno,item_mst.free_cat,date_book,date_actual,SUM(invd.f_qty) AS f_qty,SUM(a_Qty) AS a_Qty,SUM(up*f_qty) as FreeValue,SUM(up*a_Qty) as ActualValue');
            $this->db->where('invh.b_a', 'A');
            $this->db->where('invh.d <>', 'M');
            //$this->db->where('invd.f_qty<>', 0);
            $this->db->where('invh.tot_a_val <>', 0);
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
            $this->db->group_by('item_mst.free_cat');
            $this->db->order_by('`item_mst`.`company`,item_mst.free_cat');
        } else {
            //$this->db->select('invh.invno,invh.ro_cd as ro,tot_b_val,tot_m_val,tot_g_val,tot_f_val,tot_dis,tot_a_val,date_book,date_actual');
            $this->db->select('`invd`.`item` AS `item_code`, `item_mst`.`des` AS `item_desc`, `item_mst`.`uom`, `invd`.`ln`, `up` AS adjusted_unit_price, `b_qty` as booking_qty, `c_qty`, `m_qty` AS `mr_qty`, `g_qty` AS `gr_qty`, `f_qty` AS `fr_qty`, `a_Qty`, `ret_up` AS `gr_price`, `ret_up` AS `mr_price`,(up*(b_qty-c_qty)) AS d_subtotal, `invd`.`dis_per`, 0 AS `special_discount`, `invd`.`Auto`, `gr_up`, `mrf_qty` AS `mr_free_qty`, `grf_qty` AS `gr_free_qty`, `invd`.`distributor_stock_id`');
            $this->db->order_by('`invh`.`date_book`');
        }
        $this->db->from('`invh`');
        $this->db->join('`invd`', '`invh`.`invno`=`invd`.`invno`', 'INNER');
        $this->db->join('`item_mst`', '`invd`.`item`=`item_mst`.`item`', 'INNER');
        $this->db->join('`shop_mst`', '`invh`.`ag_cd`=`shop_mst`.`sh_ag_cd` AND `invh`.`ro_cd`=`shop_mst`.`sh_ro_cd` AND `invh`.`sh_cd`=`shop_mst`.`sh_cd`', 'INNER');
        $this->db->join('`tbl_mst_territory`', '`invh`.`ag_cd`=`tbl_mst_territory`.`reference_code`', 'INNER');
        $this->db->join('`tbl_mst_area_link_territory`', '`tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id`', 'INNER');
        $this->db->join('`tbl_mst_area`', '`tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id`', 'INNER');
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
        //echo $this->db->last_query();die();
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
    function getTarget($tyear, $tmonth) {
        $this->db->select('`area_cd`, `ag_cd`, `t_year`, `t_mon`, `area_name`, `ag_name`, `c_target`, `d_target`, `a_target`, `b_target`, `s_target`, `t_target`, `r_target`, `acs_pc_target`, `bd_pc_target`, `wd`, `p_wd`, `auto`');
        $this->db->from('`target_value`');
        $this->db->where(array('t_year' => $tyear, 't_mon' => $tmonth));
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

    /////////////////////////////
    /* sandun */
    function getItemsPcTotals($areaID = null, $territoryID = null, $routeID = null, $categoryID = null, $billingType = null, $dateFrom = null, $dateTo = null, $reportType = 'summery', $channel_id = 1) {
        $qu = '';
        if ($reportType == 'pivot') {
            $this->db->trans_start();
            $qu = 'SET @sql=null;';
            $this->db->query($qu);
            $q_area=''; 
            if (!empty($areaID) && isset($areaID) && $areaID != null && $areaID != -1) {
                $q_area= ' AND `tbl_mst_area`.`id`=' . $areaID ;
            } 
            $qu = 'SELECT
  GROUP_CONCAT(DISTINCT
    CONCAT(\'sum(case WHEN name= "\', name ,  \'" THEN `PC` ELSE 0 END) AS `\',  area_name,name, \' PC`\' ) 
  )  
INTO @sql
FROM  
(SELECT `area_name` ,`name`,`item`,`des`,SUM(`PC`) AS `PC`,SUM(`a_Qty`) AS `a_Qty`,SUM(`val`) AS `val` FROM 
(SELECT `tbl_mst_area`.`area_name` AS `area_name`,`tbl_mst_territory`.`territory_name` AS `name`,`invd`.`item` AS `item`, `item_mst`.`des` AS `des`,`invh`.`date_actual`,COUNT(DISTINCT(if(`invd`.`a_Qty`>0, `shop_mst`.`Auto`,null))) AS `PC`, SUM(`invd`.`a_Qty`) AS `a_Qty`,SUM(`invd`.`a_Qty`*`invd`.`up`) AS `val` FROM `invh` INNER JOIN `invd` ON `invh`.`invno`=`invd`.`invno` INNER JOIN `item_mst` ON `invd`.`item`=`item_mst`.`item` INNER JOIN `shop_mst` ON `invh`.`ag_cd`=`shop_mst`.`sh_ag_cd` AND `invh`.`ro_cd`=`shop_mst`.`sh_ro_cd` AND `invh`.`sh_cd`=`shop_mst`.`sh_cd` INNER JOIN `tbl_mst_territory` ON `invh`.`ag_cd`=`tbl_mst_territory`.`reference_code` INNER JOIN `tbl_mst_area_link_territory` ON `tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id` INNER JOIN `tbl_mst_area` ON `tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id` INNER JOIN `tbl_mst_range` ON `invh`.`cd`=`tbl_mst_range`.`range_name` WHERE `invh`.`date_actual` >=\'' . $dateFrom . '\' AND `invh`.`date_actual` <=\'' . $dateTo . '\' '.$q_area. ' AND `item_mst`.`cat`=\'' . $categoryID . '\' AND `invh`.`tot_a_val`<>0 AND `invh`.`b_a`=\'A\' GROUP BY `tbl_mst_territory`.`territory_name`,`invd`.`item` ,`invh`.`date_actual`) a GROUP BY `area_name`,`name`,`item` ORDER BY `area_name`,`name`,`item`) a ORDER BY `area_name`,`name`,`item`;
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
    function getNonMovingItems($locationID=null, $FromDate=null, $ToDate=null) {
        $query='';
        if ($locationID == 'RM'){
        $query = "SELECT item_mst.item,	item_mst.des, SUM(invd.a_Qty) as Actual_Qty, SUM(invd.up*invd.a_Qty) as Actual_Val "
          ."from `item_mst`
          INNER JOIN invd on item_mst.item=invd.item 									
          INNER JOIN invh on invd.invno=invh.invno          
          WHERE (									
          item_mst.item='RMSOWF60CU' or item_mst.item='RMSOWF60CH' or item_mst.item='RMSOWF60PR' or item_mst.item='RMSOWF60CF' or item_mst.item='RMSOW60GCR' or item_mst.item='RMSOW60GCH' or item_mst.item='RMSOW60GPR' or item_mst.item='RMSOW60GCF' or item_mst.item='RM-SO-P-161' or item_mst.item='RM-SO-P-162' or item_mst.item='RM-SO-P-163' or item_mst.item='RMSO070GCO' or item_mst.item='RMSO070GMS' or item_mst.item='RMSO070GCM' or item_mst.item='RMSO070GMB' or item_mst.item='RMSO01ISCH' or item_mst.item='RMSO04ISFI' or item_mst.item='RMSO03ISCF' or item_mst.item='RMSO02ISPR' or item_mst.item='VC-RS-090G-MK' or item_mst.item='VC-RS-090G-CF' or item_mst.item='VC-RS-090G-VC' or item_mst.item='VC-RS-090G-PC' or item_mst.item='VC-RS-090G-CC' or item_mst.item='VC-RS-090G-PR' or item_mst.item='VC-RS-090G-RC' or item_mst.item='VC-RS-050G-YC' or item_mst.item='VC-RS-250G-CH' or item_mst.item='VC-RS-010G-CO' or item_mst.item='VC-RS-050G-CO' or item_mst.item='VC-RS-400G-WF' or item_mst.item='VC-RS-050G-OR' or item_mst.item='VC-RS-050G-MA' or item_mst.item='VC-RS-050G-MF' or item_mst.item='RMSO060GCF' or item_mst.item='RMSO060GCR' or item_mst.item='VC-RS-380G-WH' or item_mst.item='VC-RS-380G-RE' or item_mst.item='RMSC015GSC' or item_mst.item='RMSC005GSC' or item_mst.item='RMIR006GIR' or item_mst.item='RMRC080GBC' or item_mst.item='RMRC080GBM' or item_mst.item='RMRC080GBC' or item_mst.item='RMRC080GBK' or item_mst.item='RMRC080GBD' or item_mst.item='RMRC080GBD' or item_mst.item='RMRC085GBS' or item_mst.item='RMSO060GCF' or item_mst.item='RMSOW65GCF' or item_mst.item='RMSOW65GCH' or item_mst.item='RMSOW65GNC' or item_mst.item='RMSOW65GPR' or item_mst.item='VC-RS-020G-MA' or item_mst.item='VC-RS-020G-MA' or item_mst.item='VC-RS-020G-MF' or item_mst.item='VC-RS-020G-OR' or item_mst.item='VC-RS-050G-MA' or item_mst.item='VC-RS-050G-MF' or item_mst.item='VC-RS-050G-OR' or item_mst.item='VS-RS-020G-MD' or item_mst.item='RMSO060GPR'
          ) AND invh.date_actual>= '$FromDate' AND invh.date_actual<= '$ToDate' AND invh.b_a='a' and invh.tot_a_val<>0									
          GROUP by item_mst.item";
          } elseif ($locationID == 'DC') {
            $query = "SELECT item_mst.item,	item_mst.des, SUM(invd.a_Qty) as Actual_Qty, SUM(invd.up*invd.a_Qty) as Actual_Val "
          ."from `item_mst`
          INNER JOIN invd on item_mst.item=invd.item 									
          INNER JOIN invh on invd.invno=invh.invno          
          WHERE (									
            item_mst.item='RMCM48HASM' or item_mst.item='RMCM48HAME' or item_mst.item='RMCM48HALA' or item_mst.item='RMCM48HAXL' or item_mst.item='RMCM2PCSSM' or item_mst.item='RMCM2PCSME' or item_mst.item='RMCM2PCSLA' or item_mst.item='RMCM2PCSXL' or item_mst.item='RMCM4PCSSM' or item_mst.item='RMCM4PCSME' or	item_mst.item='RMCM4PCSLA' or item_mst.item='RMCM4PCSXL' or item_mst.item='DCHW030MCO' or item_mst.item='DCHW100MCO' or item_mst.item='DCCM012GDC' or item_mst.item='DCCM020GDC' or item_mst.item='DCCM012GNC' or item_mst.item='RMCM48HASM' or item_mst.item='RMCM48HAME' or item_mst.item='RMCM48HALA' or item_mst.item='RMCM48HAXL' or item_mst.item='RMCM2PCSSM' or item_mst.item='RMCM2PCSME' or item_mst.item='RMCM2PCSLA' or item_mst.item='RMCM2PCSXL' or item_mst.item='RMCM4PCSSM' or item_mst.item='RMCM4PCSME' or item_mst.item='RMCM4PCSLA' or item_mst.item='RMCM4PCSXL' or item_mst.item='DCHW030MCO' or item_mst.item='DCHW100MCO' or item_mst.item='DCCM012GDC' or item_mst.item='DCCM020GDC' or item_mst.item='DCCM020GNC' or item_mst.item='RMCM48HASM' or item_mst.item='RMCM48HAME' or item_mst.item='RMCM48HALA' or item_mst.item='RMCM48HAXL' or item_mst.item='RMCM2PCSSM' or item_mst.item='RMCM2PCSME' or item_mst.item='RMCM2PCSLA' or item_mst.item='RMCM2PCSXL' or item_mst.item='RMCM4PCSSM' or item_mst.item='RMCM4PCSME' or item_mst.item='RMCM4PCSLA' or item_mst.item='RMCM4PCSXL' or item_mst.item='DCHW030MCO' or item_mst.item='DCHW100MCO' or item_mst.item='DCCM012GDC' or item_mst.item='DCCM020GDC' or	item_mst.item='DCCM012GSD' or item_mst.item='DCCM020GSD' or item_mst.item='DCCM060GSD' or item_mst.item='DCCM012GSF' or item_mst.item='DCCM020GSF' or item_mst.item='DCCM060GSF' or item_mst.item='RMSW090MCL' or item_mst.item='DCSW090MTO' or item_mst.item='RMSW045GSC' or item_mst.item='DCCM130MBW' or	item_mst.item='RMYO01PDSI' or item_mst.item='RMYO02PDDO' or item_mst.item='RMYO10PDSU' or item_mst.item='DCYOSINGWI' or item_mst.item='DCYODOUBWI' or item_mst.item='RMYO10PDWI' or item_mst.item='DCCM1219BH' or item_mst.item='DCCM1220BH' or item_mst.item='DCCM1221BH' or item_mst.item='DCCM1222BH' or	item_mst.item='DCCM010GKO' or item_mst.item='DCCMN10GKO' or item_mst.item='DCCMN10GAT' or item_mst.item='DCCMS10GAT' or item_mst.item='DCCM10MLRH' or item_mst.item='DCCM15MLRH' or item_mst.item='DCCM25MLRH' or item_mst.item='DCDZ001DDC' or item_mst.item='DCDZ002DDS' or item_mst.item='DC-AS-10PD-DW' or item_mst.item='DC-AS-SING-DW' or item_mst.item='DC-PC-02PD-DW' or item_mst.item='DCPS10PDCF'
          ) AND invh.date_actual>= '$FromDate' AND invh.date_actual<= '$ToDate' AND invh.b_a='a' and invh.tot_a_val<>0									
          GROUP by item_mst.item";
          }
        $query  =   $this->db->query($query);
        $result = $query->result_array();
        return $result;
    }

    function getdirectbills($directID=null, $rangeID=null, $areaID=null, $FromDate=null, $ToDate=null){
        $query='';
        if ($directID == ''){
        $query = "SELECT agency_mst.ag_name, invh.invno, route_mst.ro_cd, invh.tot_b_val, invh.tot_m_val, invh.tot_g_val,invh.tot_f_val, invh.tot_dis, invh.tot_a_val, invh.date_book, invh.date_actual "
        ."FROM invh
        INNER JOIN agency_mst on invh.ag_cd=agency_mst.ag_cd
        INNER JOIN route_mst on invh.ro_cd=route_mst.ro_cd
        INNER JOIN area_d on invh.ag_cd=area_d.ag_cd
        INNER JOIN area_h on area_d.area_cd=area_h.area_cd
        WHERE (invh.d='d' OR  invh.d='m') AND invh.cd='$rangeID' AND area_h.area_cd='$areaID' AND invh.date_actual>='$FromDate' AND invh.date_actual<='$ToDate' AND invh.b_a='a' and invh.tot_a_val<>0
        GROUP BY route_mst.ro_cd
        ORDER BY agency_mst.ag_cd";
          } else {
            $query = "SELECT agency_mst.ag_name, invh.invno, route_mst.ro_cd, invh.tot_b_val, invh.tot_m_val, invh.tot_g_val,invh.tot_f_val, invh.tot_dis, invh.tot_a_val, invh.date_book, invh.date_actual "
            ."FROM invh
            INNER JOIN agency_mst on invh.ag_cd=agency_mst.ag_cd
            INNER JOIN route_mst on invh.ro_cd=route_mst.ro_cd
            INNER JOIN area_d on invh.ag_cd=area_d.ag_cd
            INNER JOIN area_h on area_d.area_cd=area_h.area_cd
            WHERE invh.d='$directID' AND invh.cd='$rangeID' AND area_h.area_cd='$areaID' AND invh.date_actual>='$FromDate' AND invh.date_actual<='$ToDate' AND invh.b_a='a' and invh.tot_a_val<>0
            GROUP BY route_mst.ro_cd
            ORDER BY agency_mst.ag_cd";
          }
        $query=$this->db->query($query);
        $result=$query->result_array();
        return $result;
    }

    function getPendingBills($areaID=null, $FromDate=null, $ToDate=null){
        $this->db->select('agency_mst.ag_name,invh.invno, invh.ro_cd, invh.tot_b_val, invh.tot_m_val, invh.tot_g_val, invh.tot_f_val, invh.tot_dis, invh.tot_a_val,invh.date_book, invh.date_actual');
        $this->db->from('`invh`');
        $this->db->join('`agency_mst`', 'invh.ag_cd= agency_mst.ag_cd ', 'INNER');
        $this->db->join('`area_d`', 'agency_mst.ag_cd= area_d.ag_cd ', 'INNER');
        $this->db->join('`area_h`', 'area_d.area_cd= area_h.area_cd ', 'INNER');
        $this->db->where('invh.date_book>=', $FromDate);
        $this->db->where('invh.date_book<=', $ToDate);
        $this->db->where('invh.cname', 'P');
        $this->db->where('area_h.area_cd', $areaID);
        
        /*$query='';
        $query = "select agency_mst.ag_name,invh.invno, invh.ro_cd, invh.tot_b_val, invh.tot_m_val, invh.tot_g_val, invh.tot_f_val, invh.tot_dis, invh.tot_a_val,invh.date_book, invh.date_actual "
        ."from invh 
        inner join agency_mst on invh.ag_cd= agency_mst.ag_cd 
        inner join area_d on agency_mst.ag_cd= area_d.ag_cd 
        inner join area_h on area_d.area_cd= area_h.area_cd 
        where invh.date_book>='$FromDate' and invh.date_book<='$ToDate' and invh.cname='P' and area_h.area_cd='$areaID'";*/
        $queryData = $this->db->get();
        $resultData = $queryData->row();
        //echo $this->db->last_query();
        return $resultData;
    }
    
    /* sandun */
}

?>