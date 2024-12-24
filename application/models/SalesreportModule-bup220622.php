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
    
    function getChanneltoAreaMap($channel_id=1){
        //$this->db->select('`tbl_mst_channel`.`id` AS `channel_id`, `tbl_mst_channel`.`channel_name`,`tbl_mst_region`.`id` AS `region_id`,`tbl_mst_region`.`region_name`,`tbl_mst_area`.`id` AS `area_id`,`tbl_mst_area`.`area_name`');
        //$this->db->select('`tbl_mst_channel`.`id` AS `channel_id`, `tbl_mst_channel`.`channel_name`,`tbl_mst_region`.`id` AS `region_id`,`tbl_mst_region`.`region_name`');
        $this->db->select('`tbl_mst_channel`.`id` AS `channel_id`, `tbl_mst_channel`.`channel_name` ');
        $this->db->from('`tbl_mst_channel`');
        //$this->db->join('`tbl_mst_channel_region`','`tbl_mst_channel`.`id`=`tbl_mst_channel_region`.`channel_id`','INNER');
        //$this->db->join('`tbl_mst_region`','`tbl_mst_channel_region`.`region_id`=`tbl_mst_region`.`id`','INNER');
        //$this->db->join('`tbl_mst_region_link_area`','`tbl_mst_region`.`id`=`tbl_mst_region_link_area`.`region_id`','INNER');
        //$this->db->join('`tbl_mst_area`','`tbl_mst_region_link_area`.`area_id`=`tbl_mst_area`.`id`','INNER');
        $this->db->where('`tbl_mst_channel`.`id`',$channel_id);
        $queryData = $this->db->get();
        $resultData = $queryData->result_array();
        //echo $this->db->last_query().'<br>';
        return $resultData;
    }
    
    function getRangeList($channel_id=null){
        $this->db->select('`tbl_mst_channel`.`id` AS `channel_id`, `tbl_mst_channel`.`channel_name`,`tbl_mst_operation`.`id` AS `operation_id`,`tbl_mst_operation`.`operation_name`,`tbl_mst_range`.`id` AS `range_id`,`tbl_mst_range`.`range_name`');
        $this->db->from('`tbl_mst_channel`');
        $this->db->join('`tbl_mst_channel_operation`','`tbl_mst_channel`.`id`=`tbl_mst_channel_operation`.`channel_id`','INNER');
        $this->db->join('`tbl_mst_operation`','`tbl_mst_channel_operation`.`operation_id`=`tbl_mst_operation`.`id`','INNER'); 
        $this->db->join('`tbl_mst_operation_range`','`tbl_mst_operation`.`id`=`tbl_mst_operation_range`.`operation_id`','INNER'); 
        $this->db->join('`tbl_mst_range`','`tbl_mst_operation_range`.`range_id`=`tbl_mst_range`.`id`','INNER');
        $this->db->where('`tbl_mst_channel`.`id`',$channel_id);
        $queryData = $this->db->get();
        $resultData = $queryData->result_array();
        //echo $this->db->last_query().'<br>';
        return $resultData;
    }
    
            
    function getDailyPcTotals($areaID = null, $territoryID = null, $routeID = null, $rangeID = null, $billingType = null, $dateFrom = null, $dateTo = null, $reportType = 'summery',$channel_id=1) {
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
         
        $this->db->join('`tbl_mst_region_link_area`','`tbl_mst_area`.`id`=`tbl_mst_region_link_area`.`area_id`','INNER');
        $this->db->join('`tbl_mst_region`','`tbl_mst_region_link_area`.`region_id`=`tbl_mst_region`.`id`','INNER');
        $this->db->join('`tbl_mst_channel_region`','`tbl_mst_region`.`id`=`tbl_mst_channel_region`.`region_id`','INNER');
        $this->db->join('`tbl_mst_channel`','`tbl_mst_channel_region`.`channel_id`=`tbl_mst_channel`.`id`','INNER');
        
        
        
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
        $this->db->where(array('t_year'=>$tyear,'t_mon'=>$tmonth));
        $queryData = $this->db->get();
        $resultData = $queryData->result_array();
        return $resultData;
    }
    
    //GET OTHER RETURN MATERIALS DATA
    function getReturnOther($retNo=null, $dateBookFrom=null, $dateBookTo=null,$territoryID=null){
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
}

?>