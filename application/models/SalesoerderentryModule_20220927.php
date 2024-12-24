<?php

class SalesoerderentryModule extends CI_Model {

    function __construct() {
        parent::__construct();
        //$this->mssql = $this->load->database('MSSQL', TRUE); 
    }

    //Get item bill book data
    function getItemList($range_id) {
        //LOAD ITEM LIST
        $this->db->select('`tbl_mst_item`.`item`, `ln`, `description`,`tbl_mst_item`.`uom` , `tbl_mst_item`.`is_act` ');
        $this->db->from('`tbl_mst_item`');
        $this->db->join('`tbl_mst_range_item`', '`tbl_mst_item`.`item`=`tbl_mst_range_item`.`item`', 'INNER');
        $this->db->where('`tbl_mst_range_item`.`range_id`', $range_id);
        $this->db->where('`tbl_mst_range_item`.`is_act`', 1);
        $this->db->order_by('`category_sequence`, `item_sequence`');
        $queryItemList = $this->db->get();
        $resultItemList = $queryItemList->result_array();
        return $resultItemList;
    }

    function getItemPriceList($range_id) {
        //LOAD ITEM PRICE LIST
        $this->db->select('`id`, `range_id`, `item`, `uom`, `wholesale_price`, `retail_price`, `date_start`, `date_end` ');
        $this->db->from('`tbl_mst_item_price`');
        $this->db->where('`tbl_mst_item_price`.`range_id`', $range_id);
        $this->db->where('`tbl_mst_item_price`.`date_start`<=', date('Y-m-d'));
        $this->db->where('`tbl_mst_item_price`.`date_end`>=', date('Y-m-d'));
        $this->db->order_by('`item`, `date_start`');
        $queryItemPriceList = $this->db->get();
        $resultItemPriceList = $queryItemPriceList->result_array();
        return $resultItemPriceList;
    }

    function getOrdersH($FromDate = '', $ToDate = '', $invNum = '', $audit_user = '', $channelList = null, $report_type = 'detail', $areaID = null, $territoryID = null, $rangeID = null) {
        $sess = $this->session->userdata('User');
        if ($sess['grade_id'] == 5) {//SALES REP LOAD ONLY HIS DATA
            $audit_user = $salesRep = $sess['username'];
        }

        $result = null;
        if ($report_type == 'detail') {
            $this->db->select('`tbl_trans_order_h`.`id`, `bill_name`, `customer_id`, `address1`, `address2`, `address3`, `tbl_trans_order_h`.`contact_person`, `tbl_trans_order_h`.`mobile`, `tbl_trans_order_h`.`area_id`, `tbl_trans_order_h`.`territory_id`, `tbl_trans_order_h`.`route_id`, `subtotal`, `header_discount`, `header_discount_value`, `total_discount_value`, `header_cancel_value`, `header_gr_value`, `header_mr_value`, `header_net_value`, `invoice_category`, `inv_status`, `inv_type`, `inv_date`, `inv_time`, `audit_user`, `is_synced`, `tbl_trans_order_h`.`latitude`, `tbl_trans_order_h`.`longitude`, `distributor_id`, `distributor_stock_id`, `tbl_trans_order_h`.`channel_id`, `tbl_trans_order_h`.`operation_id`, `tbl_trans_order_h`.`range_id`, `app_inv_no`,`tbl_mst_territory`.`reference_code` AS `territory_code`,`tbl_mst_route`.`reference_code` AS `route_code`,`tbl_mst_outlet`.`reference_code` AS `shop_code`,`inv_start_date`,`inv_start_time`,`tbl_mst_route_link_outlet`.`outlet_code`');
        } elseif ($report_type == 'area_summery') {
            $this->db->select('`tbl_trans_order_h`.`channel_id`, `tbl_trans_order_h`.`operation_id`,`tbl_mst_area`.`id` AS `area_id`, `tbl_mst_territory`.`id` AS `territory_id`, `tbl_trans_order_h`.`range_id`,`tbl_mst_area`.`area_name`,`tbl_mst_range`.`range_name`,`tbl_mst_territory`.`territory_name`,COUNT(DISTINCT(customer_id)) AS `tot_pc`, SUM(`subtotal`) AS `tot_subtotal`, SUM(`header_discount`) AS `tot_header_discount`, SUM(`header_discount_value`) AS `tot_header_discount_value`, SUM(`total_discount_value`) AS `tot_total_discount_value`, SUM(`header_cancel_value`) AS `tot_header_cancel_value`, SUM(`header_gr_value`) AS `tot_header_gr_value`, SUM(`header_mr_value`) AS `tot_header_mr_value`, SUM(`header_net_value`) AS `tot_header_net_value`');
        }
        $this->db->from('`tbl_mst_rep_link_territory_agent`');
        $this->db->join('`tbl_trans_order_h`', '`tbl_mst_rep_link_territory_agent`.`rep_username`=`tbl_trans_order_h`.`audit_user`', 'LEFT');
        $this->db->join('`tbl_mst_route`', 'tbl_trans_order_h.route_id=tbl_mst_route.id', 'INNER');
        $this->db->join('`tbl_mst_territory`', 'tbl_trans_order_h.territory_id=tbl_mst_territory.id', 'INNER');
        $this->db->join('`tbl_mst_area_link_territory`', '`tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id`', 'INNER');
        $this->db->join('`tbl_mst_area`', '`tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id`', 'INNER');
        $this->db->join('`tbl_mst_range`', '`tbl_trans_order_h`.`range_id`=`tbl_mst_range`.`id`', 'INNER');
        $this->db->join('`tbl_mst_region_link_area`', '`tbl_mst_area`.`id`=`tbl_mst_region_link_area`.`area_id`', 'INNER');
        $this->db->join('`tbl_mst_region`', '`tbl_mst_region_link_area`.`region_id`=`tbl_mst_region`.`id`', 'INNER');
        $this->db->join('`tbl_mst_channel_region`', '`tbl_mst_region`.`id`=`tbl_mst_channel_region`.`region_id`', 'INNER');
        if ($report_type == 'detail') {
            $this->db->join('tbl_mst_outlet', 'tbl_trans_order_h.customer_id=tbl_mst_outlet.id', 'INNER');
            $this->db->join('tbl_mst_route_link_outlet', 'tbl_trans_order_h.route_id=tbl_mst_route_link_outlet.route_id AND tbl_trans_order_h.customer_id=tbl_mst_route_link_outlet.outlet_id', 'INNER');
            $this->db->order_by('`area_id`, `territory_id`,`inv_date`, `inv_time`');
        } elseif ($report_type == 'area_summery') {
            $this->db->group_by('`channel_id`,`operation_id`,`area_id`,`territory_id`,`range_id`');
            $this->db->order_by('`area_id`, `territory_id`');
        }

        if ($FromDate != '') {
            $this->db->where('`inv_date`>=', $FromDate);
        }
        if ($ToDate != '') {
            $this->db->where('`inv_date`<=', $ToDate);
        }
        if ($audit_user != '') {//if sales rep load only his data
            $this->db->where('`audit_user`', $audit_user);
        }
        if (!empty($areaID) && isset($areaID) && $areaID != null) {
            $this->db->where('`tbl_mst_area`.`id`', $areaID);
        }
        if (!empty($territoryID) && isset($territoryID) && $territoryID != null) {
            $this->db->where('`tbl_mst_territory`.`id`', $territoryID);
        }
        if (!empty($rangeID) && isset($rangeID) && $rangeID != null) {
            $this->db->where('`tbl_mst_range`.`id`', $rangeID);
        }


        if (!empty($channelList) && isset($channelList)) {
            $co = 1;
            $wherecond = '';
            foreach ($channelList as $c) {
                if ($co == 1) {
                    $wherecond = $wherecond . " (tbl_mst_channel_region.channel_id =" . $c . " ";
                } else {
                    $wherecond = $wherecond . "OR tbl_mst_channel_region.channel_id=" . $c . " ";
                }
                $co = $co + 1;
            }
            $wherecond = $wherecond . " ) ";
            //echo $wherecond;
            $this->db->where($wherecond);
        }


        if ($invNum != '' && !empty($invNum) && isset($invNum)) {
            $this->db->where('`app_inv_no`', $invNum);
            $q = $this->db->get();
            $result = $q->row();
        } else {
            $q = $this->db->get();
            $result = $q->result_array();
        }
        //echo $this->db->last_query();
        //die();
        return $result;
    }

    //GET ORDER DETAILS
    function getOrdersD($FromDate = '', $ToDate = '', $invNum = '', $report_type = 'detail', $audit_user = '', $area_ID = '', $territory_ID = '', $range_ID = '') {
        $sess = $this->session->userdata('User');
        if ($sess['grade_id'] == 5) {//SALES REP LOAD ONLY HIS DATA
            $audit_user = $salesRep = $sess['username'];
        }


        if ($report_type == 'pcsummery') {
            $append_str = '';
            if ($area_ID != '' && $area_ID != '-1') {//if area given
                $append_str = $append_str . ' AND `tbl_mst_area`.`id` = ' . $area_ID;
            }
            if ($territory_ID != '' && $territory_ID != '-1') {//if area given
                $append_str = $append_str . ' AND `tbl_mst_territory`.`id` =' . $territory_ID;
            }
            if ($audit_user != '') {//if sales rep load only his data
                $append_str = $append_str . ' AND `tbl_trans_order_h`.`audit_user` =' . $audit_user;
            }
            
            if ($range_ID != '' && $range_ID != '-1') {//if area given
                $append_str = $append_str .' AND `tbl_mst_range`.`id` =' . $range_ID;
            }
            
            $qu = 'select `item_code`, `item_desc`,`uom`,SUM(`PC`) AS `PC`, SUM(`booking_qty`) AS `booking_qty`, '
                    . 'SUM(`gr_qty`) AS `gr_qty`, SUM(`mr_qty`) AS `mr_qty`, SUM(`fr_qty`) AS `fr_qty`, '
                    . 'SUM(`gr_free_qty`) AS `gr_free_qty`, SUM(`mr_free_qty`) AS `mr_free_qty`, '
                    . 'SUM(`actual_qty`) AS `actual_qty`, SUM(`d_subtotal`) AS `d_subtotal`, SUM(`total`) AS `total`, SUM(`line_discount`) AS `line_discount`, '
                    . 'SUM(`gr_total`) AS `gr_total`, SUM(`mr_total`) AS `mr_total` from '
                    . '(SELECT `tbl_trans_order_h`.`inv_date`,`item_code`, `item_desc`, `tbl_trans_order_d`.`uom`,'
                    . 'COUNT(DISTINCT(IF(`tbl_trans_order_d`.`booking_qty`>0, `tbl_trans_order_h`.`customer_id`,null))) as `PC`, '
                    . 'SUM(`booking_qty`) AS `booking_qty`, SUM(`gr_qty`) AS `gr_qty`, SUM(`mr_qty`) AS `mr_qty`, '
                    . 'SUM(`fr_qty`) AS `fr_qty`, SUM(`gr_free_qty`) AS `gr_free_qty`, SUM(`mr_free_qty`) AS `mr_free_qty`, '
                    . 'SUM(`actual_qty`) AS `actual_qty`, SUM(`tbl_trans_order_d`.`subtotal`) AS `d_subtotal`, '
                    . 'SUM(`actual_qty`*`adjusted_unit_price`) AS `total`, SUM(`dis_value`) AS `line_discount`, '
                    . 'SUM(`gr_qty`*`gr_price`) AS `gr_total`, SUM(`mr_qty`*`mr_price`) AS `mr_total` '
                    . 'FROM `tbl_trans_order_h` '
                    . 'INNER JOIN `tbl_trans_order_d` ON `tbl_trans_order_h`.`app_inv_no`=`tbl_trans_order_d`.`app_inv_no` '
                    . 'INNER JOIN `tbl_mst_item` ON `tbl_trans_order_d`.`item_code`=`tbl_mst_item`.`item` '
                    . 'INNER JOIN `tbl_mst_route` ON `tbl_trans_order_h`.`route_id`=`tbl_mst_route`.`id` '
                    . 'INNER JOIN `tbl_mst_territory` ON `tbl_trans_order_h`.`territory_id`=`tbl_mst_territory`.`id` '
                    . 'INNER JOIN `tbl_mst_outlet` ON `tbl_trans_order_h`.`customer_id`=`tbl_mst_outlet`.`id` '
                    . 'INNER JOIN `tbl_mst_route_link_outlet` ON `tbl_mst_outlet`.`id`=`tbl_mst_route_link_outlet`.`outlet_id` AND `tbl_mst_route`.`id`=`tbl_mst_route_link_outlet`.`route_id` '
                    . 'INNER JOIN `tbl_mst_area_link_territory` ON `tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id` '
                    . 'INNER JOIN `tbl_mst_area` ON `tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id` '
                    . 'INNER JOIN `tbl_mst_range` ON `tbl_trans_order_h`.`range_id`=`tbl_mst_range`.`id` '
                    . 'INNER JOIN `tbl_mst_region_link_area` ON `tbl_mst_area`.`id`=`tbl_mst_region_link_area`.`area_id` '
                    . 'INNER JOIN `tbl_mst_region` ON `tbl_mst_region_link_area`.`region_id`=`tbl_mst_region`.`id` INNER JOIN `tbl_mst_channel_region` ON `tbl_mst_region`.`id`=`tbl_mst_channel_region`.`region_id`'
                    . 'WHERE `inv_date` >= \'' . $FromDate . '\' AND `inv_date` <= \'' . $ToDate . '\' ' . $append_str . ' GROUP BY `tbl_mst_item`.`item`,`tbl_trans_order_h`.`inv_date` ORDER BY `tbl_mst_item`.`item`, `inv_date`, `tbl_trans_order_h`.`app_inv_no`) AS `daily_pc`  GROUP BY `item_code`';
            $q = $this->db->query($qu);
        } else {
            if ($report_type == 'summery') {
                $this->db->select('`item_code`, `item_desc`, tbl_trans_order_d.`uom`, SUM(`booking_qty`) AS `booking_qty`, SUM(`gr_qty`) AS `gr_qty`, SUM(`mr_qty`) AS `mr_qty`, SUM(`fr_qty`) AS `fr_qty`, SUM(`gr_free_qty`) AS `gr_free_qty`, SUM(`mr_free_qty`) AS `mr_free_qty`, SUM(`actual_qty`) AS `actual_qty`, SUM(`tbl_trans_order_d`.`subtotal`) AS `d_subtotal`, SUM(`actual_qty`*`adjusted_unit_price`) AS `total`, SUM(`dis_value`) AS `line_discount`, SUM(`gr_qty`*`gr_price`) AS `gr_total`, SUM(`mr_qty`*`mr_price`) AS `mr_total`');
            } elseif ($report_type == 'pcsummery') {
                $this->db->select('`item_code`, `item_desc`, tbl_trans_order_d.`uom`, COUNT(DISTINCT(IF(`tbl_trans_order_d`.`booking_qty`>0, `tbl_trans_order_h`.`customer_id`,null))) as `PC`, SUM(`booking_qty`) AS `booking_qty`, SUM(`gr_qty`) AS `gr_qty`, SUM(`mr_qty`) AS `mr_qty`, SUM(`fr_qty`) AS `fr_qty`, SUM(`gr_free_qty`) AS `gr_free_qty`, SUM(`mr_free_qty`) AS `mr_free_qty`, SUM(`actual_qty`) AS `actual_qty`, SUM(`tbl_trans_order_d`.`subtotal`) AS `d_subtotal`, SUM(`actual_qty`*`adjusted_unit_price`) AS `total`, SUM(`dis_value`) AS `line_discount`, SUM(`gr_qty`*`gr_price`) AS `gr_total`, SUM(`mr_qty`*`mr_price`) AS `mr_total`');
            } else {
                $this->db->select('`tbl_trans_order_h`.`id`, `bill_name`, `customer_id`, `address1`, `address2`, `address3`, `tbl_trans_order_h`.`contact_person`, `tbl_trans_order_h`.`mobile`, `tbl_mst_area`.`id` AS `area_id`, `tbl_trans_order_h`.`territory_id`, tbl_trans_order_h.`route_id`, `tbl_trans_order_h`.`subtotal`, `header_discount`, `header_discount_value`, `total_discount_value`,`header_cancel_value`, `header_gr_value`, `header_mr_value`, `header_net_value`, `invoice_category`, `inv_status`, `inv_type`, `inv_date`, `inv_time`, `tbl_trans_order_h`.`audit_user`, `tbl_trans_order_h`.`is_synced`, `tbl_trans_order_h`.`latitude`, `tbl_trans_order_h`.`longitude`, `distributor_id`, `distributor_stock_id`, `tbl_trans_order_h`.`channel_id`, `tbl_trans_order_h`.`operation_id`, `tbl_trans_order_h`.`range_id`, `tbl_trans_order_h`.`app_inv_no`,`tbl_mst_territory`.`reference_code` AS `territory_code`,`tbl_mst_route`.`reference_code` AS `route_code`,`tbl_mst_outlet`.`reference_code` AS `shop_code`,
			`tbl_trans_order_d`.`id` AS `did`, `order_h_id`,`item_code`, `item_desc`, tbl_trans_order_d.`uom`, `booking_qty`, `gr_qty`, `mr_qty`, `fr_qty`, `history_qty`, `gr_free_qty`, `mr_free_qty`, `actual_qty`, `tbl_trans_order_d`.`subtotal` AS `d_subtotal`, `unit_price`, `adjusted_unit_price`, `special_discount`, `dis_per`, `dis_value`, `gr_price`, `mr_price`, `gr_unit`, `mr_unit`, `line_date`, `line_time`, `tbl_trans_order_d`.`audit_user` AS `d_audit_user`, `tbl_trans_order_d`.`is_synced` AS `d_is_synced`');
            }
            $this->db->from('tbl_trans_order_h');
            $this->db->join('tbl_trans_order_d', 'tbl_trans_order_h.app_inv_no=tbl_trans_order_d.app_inv_no', 'INNER');
            $this->db->join('tbl_mst_item', 'tbl_trans_order_d.item_code=tbl_mst_item.item', 'INNER');

            $this->db->join('tbl_mst_route', 'tbl_trans_order_h.route_id=tbl_mst_route.id', 'INNER');
            $this->db->join('tbl_mst_territory', 'tbl_trans_order_h.territory_id=tbl_mst_territory.id', 'INNER');
            $this->db->join('tbl_mst_outlet', 'tbl_trans_order_h.customer_id=tbl_mst_outlet.id', 'INNER');
            $this->db->join('tbl_mst_route_link_outlet', 'tbl_mst_outlet.id=tbl_mst_route_link_outlet.outlet_id AND tbl_mst_route.id=tbl_mst_route_link_outlet.route_id', 'INNER');


            $this->db->join('`tbl_mst_area_link_territory`', '`tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id`', 'INNER');
            $this->db->join('`tbl_mst_area`', '`tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id`', 'INNER');
            $this->db->join('`tbl_mst_range`', '`tbl_trans_order_h`.`range_id`=`tbl_mst_range`.`id`', 'INNER');
            $this->db->join('`tbl_mst_region_link_area`', '`tbl_mst_area`.`id`=`tbl_mst_region_link_area`.`area_id`', 'INNER');
            $this->db->join('`tbl_mst_region`', '`tbl_mst_region_link_area`.`region_id`=`tbl_mst_region`.`id`', 'INNER');
            $this->db->join('`tbl_mst_channel_region`', '`tbl_mst_region`.`id`=`tbl_mst_channel_region`.`region_id`', 'INNER');


            $this->db->order_by('tbl_mst_item.item,`inv_date`,tbl_trans_order_h.app_inv_no');
            if ($FromDate != '') {
                $this->db->where('`inv_date`>=', $FromDate);
            }
            if ($ToDate != '') {
                $this->db->where('`inv_date`<=', $ToDate);
            }
            if ($invNum != '' && !empty($invNum) && isset($invNum)) {
                $this->db->where('`tbl_trans_order_h`.`app_inv_no`', $invNum);
            }

            if ($audit_user != '') {//if sales rep load only his data
                $this->db->where('`tbl_trans_order_h`.`audit_user`', $audit_user);
            }

            if ($area_ID != '' && $area_ID != '-1') {//if area given
                $this->db->where('`tbl_mst_area`.`id`', $area_ID);
            }

            if ($territory_ID != '' && $territory_ID != '-1') {//if area given
                $this->db->where('`tbl_mst_territory`.`id`', $territory_ID);
            }
            
            if ($range_ID != '' && $range_ID != '-1') {//if area given
                $this->db->where('`tbl_mst_range`.`id`', $range_ID);
            }

            if ($report_type == 'summery') {
                $this->db->group_by('tbl_mst_item.item');
            }
            $q = $this->db->get();
        }
        
        $result = $q->result_array();
        //echo $this->db->last_query();
        return $result;
    }

    //GET SPECIAL DISCOUNT REPORT
    //GET ORDER DETAILS
    function getOrdersD_DiscountDetails($FromDate = '', $ToDate = '', $invNum = '', $cat = 'Yeast', $is_sepcial_discount = 0, $audit_user = '') {
        $sess = $this->session->userdata('User');
        if ($sess['grade_id'] == 5) {//SALES REP LOAD ONLY HIS DATA
            $audit_user = $salesRep = $sess['username'];
        }

        $this->db->select('`tbl_trans_order_h`.`id`, `bill_name`, `customer_id`, `address1`, `address2`, `address3`, `tbl_trans_order_h`.`contact_person`, `tbl_trans_order_h`.`mobile`, `area_id`, `territory_id`, `tbl_trans_order_h`.`route_id`, `tbl_trans_order_h`.`subtotal`, `header_discount`, `header_discount_value`, `total_discount_value`,`header_cancel_value`, `header_gr_value`, `header_mr_value`, `header_net_value`, `invoice_category`, `inv_status`, `inv_type`, `inv_date`, `inv_time`, `tbl_trans_order_h`.`audit_user`, `tbl_trans_order_h`.`is_synced`, `tbl_trans_order_h`.`latitude`, `tbl_trans_order_h`.`longitude`, `distributor_id`, `distributor_stock_id`, `channel_id`, `operation_id`, `range_id`, `tbl_trans_order_h`.`app_inv_no`,`tbl_mst_territory`.`reference_code` AS `territory_code`,`tbl_mst_route`.`reference_code` AS `route_code`,`tbl_mst_outlet`.`reference_code` AS `shop_ref`,`tbl_mst_route_link_outlet`.`outlet_code` AS `shop_code`,`tbl_mst_item`.`description`,
		`tbl_trans_order_d`.`id` AS `did`, `order_h_id`,`item_code`, `item_desc`, `tbl_trans_order_d`.`uom`, `booking_qty`, `gr_qty`, `mr_qty`, `fr_qty`, `history_qty`, `gr_free_qty`, `mr_free_qty`, `actual_qty`, `tbl_trans_order_d`.`subtotal` AS `d_subtotal`, `unit_price`, `adjusted_unit_price`, `special_discount`, `dis_per`, `dis_value`, `gr_price`, `mr_price`, `gr_unit`, `mr_unit`, `line_date`, `line_time`, `tbl_trans_order_d`.`audit_user` AS `d_audit_user`, `tbl_trans_order_d`.`is_synced` AS `d_is_synced`');
        $this->db->from('tbl_trans_order_h');
        $this->db->join('tbl_trans_order_d', 'tbl_trans_order_h.app_inv_no=tbl_trans_order_d.app_inv_no', 'INNER');
        $this->db->join('tbl_mst_item', 'tbl_trans_order_d.item_code=tbl_mst_item.item', 'INNER');
        $this->db->join('tbl_mst_item_category_link_item', 'tbl_mst_item.item=tbl_mst_item_category_link_item.item_id', 'INNER');
        $this->db->join('tbl_mst_item_category', 'tbl_mst_item_category_link_item.category_id=tbl_mst_item_category.id', 'INNER');
        $this->db->join('tbl_mst_item_category_purpose_link_category', 'tbl_mst_item_category.id=tbl_mst_item_category_purpose_link_category.category_id', 'INNER');
        $this->db->join('tbl_mst_item_category_purpose', 'tbl_mst_item_category_purpose_link_category.purpose_id=tbl_mst_item_category_purpose.id', 'INNER');
        $this->db->join('tbl_mst_route', 'tbl_trans_order_h.route_id=tbl_mst_route.id', 'INNER');
        $this->db->join('tbl_mst_territory', 'tbl_trans_order_h.territory_id=tbl_mst_territory.id', 'INNER');
        $this->db->join('tbl_mst_outlet', 'tbl_trans_order_h.customer_id=tbl_mst_outlet.id', 'INNER');
        $this->db->join('tbl_mst_route_link_outlet', 'tbl_mst_outlet.id=tbl_mst_route_link_outlet.outlet_id AND tbl_mst_route.id=tbl_mst_route_link_outlet.route_id', 'INNER');

        $this->db->order_by('`inv_date`, `inv_time`,tbl_trans_order_h.app_inv_no');
        if ($FromDate != '') {
            $this->db->where('`inv_date`>=', $FromDate);
        }
        if ($ToDate != '') {
            $this->db->where('`inv_date`<=', $ToDate);
        }
        if ($invNum != '' && !empty($invNum) && isset($invNum)) {
            $this->db->where('`tbl_trans_order_h`.`app_inv_no`', $invNum);
        }

        if ($audit_user != '') {//if sales rep load only his data
            $this->db->where('`audit_user`', $audit_user);
        }

        if ($cat != '' && !empty($cat) && isset($cat)) {
            $this->db->where('`tbl_mst_item_category`.`name`', $cat);
        }
        $this->db->where('`tbl_mst_item_category_purpose`.`name`', 'Standard Reporting');
        if ($is_sepcial_discount = 1 && $cat == 'Yeast' && !empty($cat) && isset($cat)) {
            $this->db->where('`tbl_mst_item`.`item`!=', 'RM-BK-500G-IL');
            $this->db->where('`tbl_trans_order_d`.`special_discount`!=', 0);
        }
        $q = $this->db->get();
        $result = $q->result_array();
        //echo $this->db->last_query();
        return $result;
    }

    function getGps($dateFrom, $dateTo, $user) {
        $this->db->select('`id`, `user_name`, `gps_date`, `gps_time`, `longitude`, `latitude`, `battery_level`, `speed`, `day_status`');
        $this->db->from('tbl_trans_gps_log');
        $this->db->where(array('`gps_date`>=' => $dateFrom, '`gps_date`<=' => $dateTo, '`user_name`' => $user));
        $this->db->order_by('gps_date,gps_time', 'ASC');
        $q = $this->db->get();
        $result = $q->result_array();
        /* echo $this->db->last_query(); */
        //echo $this->db->last_query();
        return $result;
    }

    function getShopGps() {
        $this->db->select('`outlet_id`, `is_updated`, `address_1`, `address_2`, `address_3`, `contact_person`, `telephone`, `shop_type`, `image`, `latitude`, `longitude`, `updated_by`, `updated_date`, `updated_time`, `approved_by`, `approved_date`');
        $this->db->from('tbl_trans_outlet_update');
        $this->db->order_by('updated_time', 'ASC');
        $this->db->get();
        $q = $this->db->get();
        $result = $q->result_array();
        /* echo $this->db->last_query(); */
        echo $this->db->last_query();
        return $result;
    }

}
