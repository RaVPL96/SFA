<?php

class SalesarcustomersModule extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getCustomerMaster() {
        $this->db->select('`tbl_mst_outlet`.`id`, `reference_code`, `tbl_mst_outlet`.`name`, `address_1`, `address_2`, `address_3`, `contact_person`, `telephone`, `mobile`, `tbl_mst_outlet_category`.`name` AS `shop_type_name`, `created_date`, `created_by`, `display_order`, `latitude`, `longitude`, `tbl_mst_outlet`.`is_act`, `is_new`, `image`');
        $this->db->from('`tbl_mst_outlet`');
        $this->db->join('`tbl_mst_outlet_category`', '`tbl_mst_outlet`.`shop_type`=`tbl_mst_outlet_category`.`id`', 'INNER');
        $q = $this->db->get();
        $result = $q->result_array();
        return $result;
    }

    function saveCustomersOrders($data) {
        $IsInserted = 1;
        $route_id = $data['route_id'];
        //print_r($data);
        $count_r = 1;
        $this->db->trans_begin();
        //update old database table
        foreach ($data['shopListRef'] as $r) {
            $arrUp = array('`sh_display_order`' => $count_r);
            $this->db->where('`Auto`', (int) $r);
            $this->db->update('`shop_mst`', $arrUp);
            $count_r += 1;
            //echo $this->db->last_query().'<br>';
        }
        //update new mapping table
        $count_l = 1;
        foreach ($data['shopList'] as $l) {
            $arrUpL = array('`display_order_in_route`' => $count_l);
            $this->db->where('`outlet_id`', trim($l));
            $this->db->where('`route_id`', (int) $route_id);
            $this->db->update('`tbl_mst_route_link_outlet`', $arrUpL);
            $count_l += 1;
            //echo $this->db->last_query().'<br>';
        }
        if ($this->db->trans_status() === FALSE) {
            $IsInserted = 0;
        }
        //echo $IsInserted;
        //die();
        if ($IsInserted == 1) {
            $this->db->trans_commit();
            return 1;
        } else {
            $this->db->trans_rollback();
            return 0;
        }
    }

    function getCustomers($areaid = null, $id = null, $territory_id = null, $route_id = null, $isact = null) {
        if (!empty($id) && isset($id)) {
            $this->db->select('`tbl_mst_outlet`.`id`, `tbl_mst_outlet`.`reference_code`, `tbl_mst_outlet`.`name`, `address_1`, `address_2`, `address_3`, `contact_person`, `telephone`, `mobile`,`tbl_mst_outlet_category`.`id` 
            AS `outlet_category_id`, `tbl_mst_outlet_category`.`name` AS `shop_type_name`, `created_date`, `tbl_mst_outlet`.`created_by`, `tbl_mst_outlet`.`display_order`, `latitude`, `longitude`, `tbl_mst_outlet`.`is_act`, `is_new`, `image`, `image_name`, `image_created`,`tbl_mst_route_link_outlet`.`outlet_code`,`tbl_mst_territory`.`reference_code` AS `territory_reference_code`,`tbl_mst_route`.`reference_code` AS `route_reference_code`');
        } else {
            $this->db->select('`tbl_mst_outlet`.`id`, `tbl_mst_outlet`.`reference_code`, `tbl_mst_outlet`.`name`, `address_1`, `address_2`, `address_3`, `contact_person`, `telephone`, `mobile`,`tbl_mst_outlet_category`.`id` AS `outlet_category_id`, `tbl_mst_outlet_category`.`name` AS `shop_type_name`, `created_date`, `tbl_mst_outlet`.`created_by`, `tbl_mst_outlet`.`display_order`, `latitude`, `longitude`, `tbl_mst_outlet`.`is_act`,`tbl_mst_route_link_outlet`.`is_act` AS `is_allowed`, `is_new`, \'aa\' AS `image`,`tbl_mst_route_link_outlet`.`outlet_code`,`tbl_mst_territory`.`reference_code` AS `territory_reference_code`,`tbl_mst_route`.`reference_code` AS `route_reference_code`,`tbl_mst_route_link_outlet`.`display_order_in_route`');
        }
        $this->db->from('`tbl_mst_outlet`');
        $this->db->join('`tbl_mst_outlet_category`', '`tbl_mst_outlet`.`shop_type`=`tbl_mst_outlet_category`.`id`', 'INNER');
        $this->db->join('`tbl_mst_route_link_outlet`', '`tbl_mst_outlet`.`id`=`tbl_mst_route_link_outlet`.`outlet_id`', 'INNER');
        $this->db->join('`tbl_mst_route`', '`tbl_mst_route_link_outlet`.`route_id`=`tbl_mst_route`.`id`', 'INNER');
        $this->db->join('`tbl_mst_territory_link_route`', '`tbl_mst_route`.`id`=`tbl_mst_territory_link_route`.`route_id`', 'INNER');
        $this->db->join('`tbl_mst_territory`', '`tbl_mst_territory_link_route`.`territory_id`=`tbl_mst_territory`.`id`', 'INNER');
        $this->db->join('`tbl_mst_area_link_territory`', '`tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id`', 'INNER');
        $this->db->join('`tbl_mst_area`', '`tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id`', 'INNER');
        if (!empty($areaid) && isset($areaid)) {
            $this->db->where('`tbl_mst_area`.`id`', $areaid);
        }
        if (!empty($id) && isset($id)) {
            $this->db->where('`tbl_mst_outlet`.`id`', $id);
        }
        if (!empty($territory_id) && isset($territory_id)) {
            $this->db->where('`tbl_mst_territory`.`id`', $territory_id);
        }
        if (!empty($route_id) && isset($route_id)) {
            $this->db->where('`tbl_mst_route`.`id`', $route_id);
        }
        if (!empty($isact) && isset($isact)) {
            $this->db->where('`tbl_mst_route_link_outlet`.`is_act`', $isact);
            $this->db->where('`tbl_mst_outlet`.`is_act`', $isact);
        }
        $this->db->order_by('`tbl_mst_area`.`id`,`tbl_mst_territory`.`id`,`tbl_mst_route`.`display_order`,`tbl_mst_route_link_outlet`.`display_order_in_route`');
        $q = $this->db->get();
        //echo $this->db->last_query();
        if (!empty($id) && isset($id)) {
            $result = $q->row();
        } else {
            $result = $q->result_array();
        }
        return $result;
    }

    //GET SHOPS ALLOWED TO REP RANGE
    function getOutletRange($territory_id, $range_id) {
        $this->db->select('`tbl_mst_outlet`.`id`, `tbl_mst_outlet`.`reference_code`, `name`, `address_1`, `address_2`, `address_3`, `contact_person`, `telephone`, `mobile`, `shop_type`, `created_date`, `created_by`, `tbl_mst_outlet`.`display_order`, `latitude`, `longitude`, `tbl_mst_outlet`.`is_act`,`tbl_mst_route_link_outlet`.`id` AS `trid`,`tbl_mst_route_link_outlet`.`route_id`,`tbl_mst_route_link_outlet`.`is_act` AS `tris_act`,`tbl_mst_route_link_outlet`.`is_del` AS `tris_del`,\'aa\' AS `image`,`tbl_mst_route_link_outlet`.`outlet_code` AS `outlet_code`,tbl_mst_route_link_outlet.display_order_in_route');
        $this->db->from('`tbl_mst_outlet`');
        $this->db->join('`tbl_mst_route_link_outlet`', '`tbl_mst_outlet`.`id`=`tbl_mst_route_link_outlet`.`outlet_id`', 'INNER');
        $this->db->join('`tbl_mst_route`', '`tbl_mst_route_link_outlet`.`route_id`=`tbl_mst_route`.`id`', 'INNER');
        $this->db->join('`tbl_mst_territory_link_route`', '`tbl_mst_route`.`id`=`tbl_mst_territory_link_route`.`route_id`', 'INNER');
        $this->db->join('`tbl_mst_outlet_range`', '`tbl_mst_outlet`.`id`=`tbl_mst_outlet_range`.`outlet_id`', 'INNER');
        $this->db->where('`tbl_mst_territory_link_route`.`territory_id`', $territory_id);
        $this->db->where('`tbl_mst_outlet`.`is_act`', 1);
        $this->db->where('`tbl_mst_outlet_range`.`is_closed`', 0);
        $this->db->where('`tbl_mst_outlet_range`.`is_allowed`', 1);
        $this->db->where('`tbl_mst_outlet_range`.`range_id`', $range_id);
        $this->db->where('`tbl_mst_territory_link_route`.`is_act`', 1);
        $this->db->order_by('`tbl_mst_route`.`display_order`,`tbl_mst_route_link_outlet`.`display_order_in_route`', 'ASC');
        $queryShopInfo = $this->db->get();
        $resultShopInfo = $queryShopInfo->result_array();
//echo $this->db->last_query();

        return $resultShopInfo;
    }

    function getCustomersNearBy($orig_lat, $orig_lon, $distance) {
        $this->db->select('`tbl_mst_outlet`.`id`, `tbl_mst_outlet`.`reference_code`, `tbl_mst_outlet`.`name`, `address_1`, `address_2`, `address_3`, `contact_person`, `telephone`, `mobile`,`tbl_mst_outlet_category`.`id` AS `outlet_category_id`, `tbl_mst_outlet_category`.`name` AS `shop_type_name`, `created_date`, `tbl_mst_outlet`.`created_by`, `tbl_mst_outlet`.`display_order`, `latitude`, `longitude`, `tbl_mst_outlet`.`is_act`, `is_new`, `image`, `image_name`, `image_created`,`tbl_mst_route_link_outlet`.`outlet_code`,`tbl_mst_territory`.`reference_code` AS `territory_reference_code`,`tbl_mst_route`.`reference_code` AS `route_reference_code`, 3956*2*ASIN(SQRT(POWER(SIN((' . $orig_lat . '-abs(tbl_mst_outlet.latitude))*pi()/180/2),2)+COS(' . $orig_lat . '*pi()/180)*COS(abs(tbl_mst_outlet.latitude)*pi()/180)*POWER(SIN((' . $orig_lon . '-tbl_mst_outlet.longitude)*pi()/180/2),2))) as `distance`,`tbl_mst_outlet`.`duplicate_of`');
        $this->db->from('`tbl_mst_outlet`');
        $this->db->join('`tbl_mst_outlet_category`', '`tbl_mst_outlet`.`shop_type`=`tbl_mst_outlet_category`.`id`', 'INNER');
        $this->db->join('`tbl_mst_route_link_outlet`', '`tbl_mst_outlet`.`id`=`tbl_mst_route_link_outlet`.`outlet_id`', 'INNER');
        $this->db->join('`tbl_mst_route`', '`tbl_mst_route_link_outlet`.`route_id`=`tbl_mst_route`.`id`', 'INNER');
        $this->db->join('`tbl_mst_territory_link_route`', '`tbl_mst_route`.`id`=`tbl_mst_territory_link_route`.`route_id`', 'INNER');
        $this->db->join('`tbl_mst_territory`', '`tbl_mst_territory_link_route`.`territory_id`=`tbl_mst_territory`.`id`', 'INNER');
        $this->db->join('`tbl_mst_area_link_territory`', '`tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id`', 'INNER');
        $this->db->join('`tbl_mst_area`', '`tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id`', 'INNER');
        $this->db->having('distance <' . $distance);
        $this->db->order_by('distance', 'ASC');
        $this->db->limit(10);
        $q = $this->db->get();
        $result = $q->result_array();
        return $result;
    }

    //UPDATE CUSTOMERS OUTLET
    function updateOutletData($data) {
        $IsInserted = 1;
        $data = $data['outlet'];
        $id = $data['id'];
        $name = $data['name'];
        $address_1 = $data['address_1'];
        $address_2 = $data['address_2'];
        $address_3 = $data['address_3'];
        $contact_person = $data['contact_person'];
        $telephone = $data['telephone'];
        $mobile = $data['mobile'];
        $category = $data['category'];
        $dealercode = $data['dealercode'];
        $isact = 0;
        if (!empty($data['isact']) && isset($data['isact'])) {
            $isact = $data['isact'];
        }
        $is_new = 1;
        if (!empty($data['is_new']) && isset($data['is_new']) && $data['is_new'] == 1) {
            $is_new = 0;
        }
        $updateArr = array(
            'name' => $name,
            'address_1' => $address_1,
            'address_2' => $address_2,
            'address_3' => $address_3,
            'contact_person' => $contact_person,
            'telephone' => $telephone,
            'mobile' => $mobile,
            'shop_type' => $category,
            'is_act' => $isact,
            'is_new' => $is_new
        );
        $this->db->trans_begin();
        $this->db->where('id', $id);
        $this->db->update('`tbl_mst_outlet`', $updateArr);
        if ($this->db->trans_status() === FALSE) {
            $IsInserted = 0;
        }
        //update Dealer code
        $updateArrDealerCode = array(
            'outlet_code' => $dealercode
        );
        $this->db->where('outlet_id', $id);
        $this->db->update('`tbl_mst_route_link_outlet`', $updateArrDealerCode);
        if ($this->db->trans_status() === FALSE) {
            $IsInserted = 0;
        }
        if ($IsInserted == 1) {
            $this->db->trans_commit();
            return 1;
        } else {
            $this->db->trans_rollback();
            return 0;
        }
    }

    function getNewCustomers($areaid = null, $fromdate = null, $todate = null, $territory_id = null, $route_id = null, $rpt_type = 'territory_wise') {
        $str = '';
        $date1 = $fromdate;
        $date2 = $todate;
        //$output = [];
        $time = strtotime($date1);
        $last = date('M-Y', strtotime($date2));
        do {
            $month = date('M-Y', $time);
            $total = date('t', $time);
            //$output[] = $month;
            $str .= ', COUNT(DISTINCT  IF(month(`tbl_mst_outlet`.`created_date`)=' . date('m', $time) . ' and year(`tbl_mst_outlet`.`created_date`)=' . date('Y', $time) . ', `tbl_mst_outlet`.`id`,null)) AS `' . date('Y', $time) . '-' . date('M', $time) . '` ';
            $time = strtotime('+1 month', $time);
        } while ($month != $last);
        $str .= ', COUNT(DISTINCT IF(`tbl_mst_outlet`.`created_date`>=' . $fromdate . ' AND `tbl_mst_outlet`.`created_date`<=' . $todate . ', `tbl_mst_outlet`.`id`,null)) AS `Total New Shops` ';
        /*
          while (date('m', strtotime($var1)) != date('m', strtotime($var2))) {
          //$result .= date('MY',(strtotime('next month',strtotime($var1)))).",";
          //$var1 = date('Y-m-d',(strtotime('next month',strtotime($var1))));
          $str.=', COUNT(DISTINCT  IF(month(`tbl_mst_outlet`.`created_date`)='.date('mm',(strtotime('next month',strtotime($var1)))).' and year(`tbl_mst_outlet`.`created_date`)='.date('Y',(strtotime('next month',strtotime($var1)))).', `tbl_mst_outlet`.`id`,null)) AS `'.date('Y',(strtotime('next month',strtotime($var1)))).'-'.date('M',(strtotime('next month',strtotime($var1)))).'`';
          } */
        //echo $str;
        //die();
        if ($rpt_type == 'route_wise') {
            $str .= ', `tbl_mst_route`.`route_name` ';
            $this->db->group_by('`tbl_mst_area`.`id`, `tbl_mst_territory`.`id`,`tbl_mst_route`.`id`');
        } else {
            $this->db->group_by('`tbl_mst_area`.`id`, `tbl_mst_territory`.`id`');
        }
        $this->db->select('`tbl_mst_area`.`area_name`,`tbl_mst_territory`.`territory_name`' . $str . ',COUNT(DISTINCT `tbl_mst_outlet`.`id`) AS `TOTAL_SHOPS`');
        $this->db->from('`tbl_mst_outlet`');
        $this->db->join('`tbl_mst_outlet_category`', '`tbl_mst_outlet`.`shop_type`=`tbl_mst_outlet_category`.`id`', 'INNER');
        $this->db->join('`tbl_mst_route_link_outlet`', '`tbl_mst_outlet`.`id`=`tbl_mst_route_link_outlet`.`outlet_id`', 'INNER');
        $this->db->join('`tbl_mst_route`', '`tbl_mst_route_link_outlet`.`route_id`=`tbl_mst_route`.`id`', 'INNER');
        $this->db->join('`tbl_mst_territory_link_route`', '`tbl_mst_route`.`id`=`tbl_mst_territory_link_route`.`route_id`', 'INNER');
        $this->db->join('`tbl_mst_territory`', '`tbl_mst_territory_link_route`.`territory_id`=`tbl_mst_territory`.`id`', 'INNER');
        $this->db->join('`tbl_mst_area_link_territory`', '`tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id`', 'INNER');
        $this->db->join('`tbl_mst_area`', '`tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id`', 'INNER');
        if (!empty($areaid) && isset($areaid) and $areaid != -1) {
            $this->db->where('`tbl_mst_area`.`id`', $areaid);
        }
        if (!empty($territory_id) && isset($territory_id)) {
            $this->db->where('`tbl_mst_territory`.`id`', $territory_id);
        }
        if (!empty($route_id) && isset($route_id)) {
            $this->db->where('`tbl_mst_route`.`id`', $route_id);
        }
        /* if (!empty($fromdate) && isset($fromdate) && !empty($todate) && isset($todate)) {
          $this->db->where('`tbl_mst_outlet`.`created_date`>=', $fromdate);
          $this->db->where('`tbl_mst_outlet`.`created_date`<=', $todate);
          } */
        $this->db->where('`tbl_mst_outlet`.`is_act`', 1);
        $this->db->where('`tbl_mst_route_link_outlet`.`is_act`', 1);
        $this->db->where('`tbl_mst_route`.`is_act`', 1);
        $this->db->where('`tbl_mst_territory_link_route`.`is_act`', 1);
        $this->db->group_by('`tbl_mst_area`.`id`, `tbl_mst_territory`.`id`');
        $this->db->order_by('`tbl_mst_area`.`id`,`tbl_mst_territory`.`id`,`tbl_mst_route`.`display_order`,`tbl_mst_route`.`id`');
        $q = $this->db->get();
        //echo $this->db->last_query();
        if (!empty($id) && isset($id)) {
            $result = $q->row();
        } else {
            $result = $q->result_array();
        }
        return $result;
    }

    function getNewCustomersDetails($areaid = null, $fromdate = null, $todate = null, $territory_id = null, $route_id = null, $rpt_type = 'territory_wise') {
        $str = '';
        $date1 = $fromdate;
        $date2 = $todate;
        //$output = [];
        $time = strtotime($date1);
        $last = date('M-Y', strtotime($date2));
        do {
            $month = date('M-Y', $time);
            $total = date('t', $time);
            //$output[] = $month;
            $str .= ', COUNT(DISTINCT  IF(month(`tbl_mst_outlet`.`created_date`)=' . date('m', $time) . ' and year(`tbl_mst_outlet`.`created_date`)=' . date('Y', $time) . ', `tbl_mst_outlet`.`id`,null)) AS `' . date('Y', $time) . '-' . date('M', $time) . '`';
            $time = strtotime('+1 month', $time);
        } while ($month != $last);

        $str .= ', COUNT(DISTINCT IF(`tbl_mst_outlet`.`created_date`>=' . $fromdate . ' AND `tbl_mst_outlet`.`created_date`<=' . $todate . ', `tbl_mst_outlet`.`id`,null)) AS `rep_new_total` ';

        if ($rpt_type == 'route_wise') {
            $str .= ', `tbl_mst_route`.`route_name` ';
            $this->db->group_by('`tbl_mst_area`.`id`, `tbl_mst_territory`.`id`,`tbl_mst_route`.`id`, `tbl_mst_outlet`.`created_by`');
        } else {
            $this->db->group_by('`tbl_mst_area`.`id`, `tbl_mst_territory`.`id`, `tbl_mst_outlet`.`created_by`');
        }
        $this->db->select('`tbl_mst_area`.`area_name`,`tbl_mst_territory`.`territory_name`, `tbl_mst_outlet`.`created_by`, ' . $str . ',COUNT(DISTINCT `tbl_mst_outlet`.`id`) AS `TOTAL_SHOPS`');
        $this->db->from('`tbl_mst_outlet`');
        $this->db->join('`tbl_mst_outlet_category`', '`tbl_mst_outlet`.`shop_type`=`tbl_mst_outlet_category`.`id`', 'INNER');
        $this->db->join('`tbl_mst_route_link_outlet`', '`tbl_mst_outlet`.`id`=`tbl_mst_route_link_outlet`.`outlet_id`', 'INNER');
        $this->db->join('`tbl_mst_route`', '`tbl_mst_route_link_outlet`.`route_id`=`tbl_mst_route`.`id`', 'INNER');
        $this->db->join('`tbl_mst_territory_link_route`', '`tbl_mst_route`.`id`=`tbl_mst_territory_link_route`.`route_id`', 'INNER');
        $this->db->join('`tbl_mst_territory`', '`tbl_mst_territory_link_route`.`territory_id`=`tbl_mst_territory`.`id`', 'INNER');
        $this->db->join('`tbl_mst_area_link_territory`', '`tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id`', 'INNER');
        $this->db->join('`tbl_mst_area`', '`tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id`', 'INNER');
        if (!empty($areaid) && isset($areaid) and $areaid != -1) {
            $this->db->where('`tbl_mst_area`.`id`', $areaid);
        }
        if (!empty($territory_id) && isset($territory_id)) {
            $this->db->where('`tbl_mst_territory`.`id`', $territory_id);
        }
        if (!empty($route_id) && isset($route_id)) {
            $this->db->where('`tbl_mst_route`.`id`', $route_id);
        }
        $this->db->where('`tbl_mst_outlet`.`is_act`', 1);
        $this->db->where('`tbl_mst_route_link_outlet`.`is_act`', 1);
        $this->db->where('`tbl_mst_route`.`is_act`', 1);
        $this->db->group_by('`tbl_mst_area`.`id`, `tbl_mst_territory`.`id`, `tbl_mst_outlet`.`created_by`');
        $this->db->order_by('`tbl_mst_area`.`id`,`tbl_mst_territory`.`id`,`tbl_mst_route`.`display_order`,`tbl_mst_route`.`id`');
        $q = $this->db->get();
        //echo $this->db->last_query();
        if (!empty($id) && isset($id)) {
            $result = $q->row();
        } else {
            $result = $q->result_array();
        }
        return $result;
    }

    function getRoutes($areaid = null, $territory_id = null) {
        $this->db->select('`tbl_mst_area`.`area_name`, `tbl_mst_route`.`id`,`tbl_mst_route`.`route_name`,`tbl_mst_route`.`reference_code`,`tbl_mst_territory_link_route`.`is_act`');
        $this->db->from('`tbl_mst_route`');
        $this->db->join('`tbl_mst_territory_link_route`', '`tbl_mst_route`.`id`=`tbl_mst_territory_link_route`.`route_id`', 'INNER');
        $this->db->join('`tbl_mst_territory`', '`tbl_mst_territory_link_route`.`territory_id`=`tbl_mst_territory`.`id`', 'INNER');
        $this->db->join('`tbl_mst_area_link_territory`', '`tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id`', 'INNER');
        $this->db->join('`tbl_mst_area`', '`tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id`', 'INNER');
        //$this->db->where('`tbl_mst_route`.`is_act`', 1);
        //$this->db->group_by('`tbl_mst_area`.`id`, `tbl_mst_territory`.`id`, `tbl_mst_outlet`.`created_by`');
        $this->db->order_by('`tbl_mst_area`.`id`,`tbl_mst_territory`.`id`');
        if (!empty($areaid) && isset($areaid) and $areaid != -1) {
            $this->db->where('`tbl_mst_area`.`id`', $areaid);
        }
        if (!empty($territory_id) && isset($territory_id)) {
            $this->db->where('`tbl_mst_territory`.`id`', $territory_id);
        }
        $q = $this->db->get();
        //echo $this->db->last_query();
        $result = $q->result_array();
        return $result;
    }

    function updateRoutes($data) {
        //print_r($data);
        $IsInserted = 1;
        if (!empty($data) && isset($data)) {
            $this->db->trans_begin();
            foreach ($data['route_id'] as $a) {
                //echo $a;
                //remove from territory link route table
                $this->db->where('`tbl_mst_territory_link_route`.`route_id`', $a);
                $this->db->update('`tbl_mst_territory_link_route`', array('`is_act`' => 0));
            }
            if ($this->db->trans_status() === FALSE) {
                $IsInserted = 0;
            }
            if ($IsInserted == 1) {
                $this->db->trans_commit();
                return 1;
            } else {
                $this->db->trans_rollback();
                return 0;
            }
        } else {
            return 0;
        }
    }


    // 2024-02-05 NEW SHOP UPDATE PROCESS
    function getUpdateCustomers($areaid = null, $id = null, $territory_id = null, $route_id = null, $isact = null, $rpt_type = 'details', $rangeid = null,$filter=null) {
        $filter_query = null;

        $today = date('Y-m-d'); 
        $yesterday = date('Y-m-d', strtotime('-1 day'));
        $daybeforeyesterday = date('Y-m-d', strtotime('-2 day'));

        // echo $yesterday.'----'.$daybeforeyesterday;

        if ($rpt_type == 'details') {
            if (!empty($id) && isset($id)) {
                $this->db->select('`tbl_trans_shop_update`.`unique_id`,`tbl_trans_shop_update`.`is_updated`,`tbl_trans_shop_update`.`is_closed`,
                  `tbl_mst_outlet_range`.`is_allowed` AS `closed_count`,
                `tbl_trans_shop_update`.`address_1` AS `address_1_up`, `tbl_trans_shop_update`.`address_2` AS `address_2_up`, `tbl_trans_shop_update`.`address_3` AS `address_3_up`, `tbl_trans_shop_update`.`contact_person` AS `contact_person_up`, `tbl_trans_shop_update`.`telephone` AS `telephone_up`, `tbl_trans_shop_update`.`shop_type` AS `shop_type_up`, `tbl_trans_shop_update`.`image` AS `image_up`, `tbl_trans_shop_update`.`image_name` AS `image_name_up`, `tbl_trans_shop_update`.`image_created` AS `image_created_up`, `tbl_trans_shop_update`.`latitude` AS `latitude_up`, `tbl_trans_shop_update`.`longitude` AS `longitude_up`, `tbl_trans_shop_update`.`updated_by`, `tbl_trans_shop_update`.`updated_date`, `tbl_trans_shop_update`.`updated_time`, `tbl_trans_shop_update`.`is_approved`, `tbl_trans_shop_update`.`approved_by`, `tbl_trans_shop_update`.`approved_date`,`tbl_mst_outlet`.`id`, `tbl_mst_outlet`.`reference_code`, `tbl_mst_outlet`.`name`, `tbl_mst_outlet`.`address_1`, `tbl_mst_outlet`.`address_2`, `tbl_mst_outlet`.`address_3`, `tbl_mst_outlet`.`contact_person`, `tbl_mst_outlet`.`telephone`, `tbl_mst_outlet`.`mobile`,`tbl_mst_outlet_category`.`id` AS `outlet_category_id`, `tbl_mst_outlet_category`.`name` AS `shop_type_name`, `created_date`, `tbl_mst_outlet`.`created_by`, `tbl_mst_outlet`.`display_order`, `tbl_mst_outlet`.`latitude`, `tbl_mst_outlet`.`longitude`, `tbl_mst_outlet`.`is_act`, `tbl_mst_outlet`.`is_new`, `tbl_mst_outlet`.`allowed_to`,`tbl_mst_outlet`.`duplicate_of`, `tbl_mst_outlet`.`image`,`tbl_mst_route_link_outlet`.`outlet_code`,`tbl_mst_territory`.`reference_code` AS `territory_reference_code`,`tbl_mst_route`.`reference_code` AS `route_reference_code`');
            } else {
                $this->db->select('`tbl_trans_shop_update`.`unique_id`,
                                    `tbl_trans_shop_update`.`is_updated`,
                                    `tbl_trans_shop_update`.`is_closed`,
                                     `tbl_mst_outlet_range`.`is_allowed` AS `closed_count`,
                                      `tbl_trans_shop_update`.`address_1` AS `address_1_up`,
                                      `tbl_trans_shop_update`.`address_2` AS `address_2_up`,
                                      `tbl_trans_shop_update`.`address_3` AS `address_3_up`,
                                      `tbl_trans_shop_update`.`contact_person` AS `contact_person_up`,
                                      `tbl_trans_shop_update`.`telephone` AS `telephone_up`,
                                      `tbl_trans_shop_update`.`shop_type` AS `shop_type_up`,
                                      `tbl_trans_shop_update`.`image` AS `image_up`,
                                      `tbl_trans_shop_update`.`image_name` AS `image_name_up`, 
                                      `tbl_trans_shop_update`.`image_created` AS `image_created_up`,
                                      `tbl_trans_shop_update`.`latitude` AS `latitude_up`,
                                      `tbl_trans_shop_update`.`longitude` AS `longitude_up`,
                                      `tbl_trans_shop_update`.`updated_by`,
                                      `tbl_trans_shop_update`.`updated_date`, 
                                      `tbl_trans_shop_update`.`updated_time`, 
                                      `tbl_trans_shop_update`.`is_approved`, 
                                      `tbl_trans_shop_update`.`approved_by`,
                                      `tbl_trans_shop_update`.`approved_date`,
                                      `tbl_mst_outlet`.`id`, 
                                      `tbl_mst_outlet`.`reference_code`,
                                      `tbl_mst_outlet`.`name`, 
                                      `tbl_mst_outlet`.`address_1`,
                                      `tbl_mst_outlet`.`address_2`,
                                      `tbl_mst_outlet`.`address_3`,
                                      `tbl_mst_outlet`.`contact_person`, 
                                      `tbl_mst_outlet`.`telephone`,
                                      `tbl_mst_outlet`.`mobile`,
                                      `tbl_mst_outlet_category`.`id` AS `outlet_category_id`, 
                                      `tbl_mst_outlet_category`.`name` AS `shop_type_name`,
                                      `created_date`, `tbl_mst_outlet`.`created_by`, 
                                      `tbl_mst_outlet`.`display_order`,
                                      `tbl_mst_outlet`.`latitude`,
                                      `tbl_mst_outlet`.`longitude`,
                                      `tbl_mst_outlet`.`is_act`,
                                      `tbl_mst_outlet`.`is_new`, 
                                      `tbl_mst_outlet`.`allowed_to`,
                                      `tbl_mst_outlet`.`duplicate_of`,
                                      \'aa\' AS `image`,
                                      `tbl_mst_route_link_outlet`.`outlet_code`,
                                      `tbl_mst_territory`.`reference_code` AS `territory_reference_code`,
                                      `tbl_mst_route`.`reference_code` AS `route_reference_code`,
                                      `tbl_mst_route_link_outlet`.`display_order_in_route`,
                                      `tbl_mst_rep_link_territory_agent`.`range_id`,
                                      `tbl_mst_rep_link_territory_agent`.`range_name`');
            }
        } else { // summary of progress
    $this->db->select('`tbl_mst_area`.`area_name`,`tbl_mst_territory`.`territory_name`, 
        COUNT(`tbl_mst_outlet_range`.`outlet_id` AND `tbl_mst_route`.`is_act` = 1 ) AS TOTAL,
        
        
        
         COUNT(IF(`tbl_mst_outlet_range`.`is_closed` = 0, 0, NULL))
        -  COUNT(IF(`tbl_trans_shop_update`.`is_updated`=1 AND `tbl_mst_outlet_range`.`is_closed` = 0, `tbl_trans_shop_update`.`outlet_id`,null)) AS PENDING_TO_COMPLETE,
        
        COUNT(IF(`tbl_trans_shop_update`.`is_updated`=1 AND `tbl_mst_outlet_range`.`is_closed` = 0, `tbl_trans_shop_update`.`outlet_id`,null)) AS COMPLETED ,
        
        COUNT(IF(`tbl_trans_shop_update`.`is_approved`=1,`tbl_trans_shop_update`.`outlet_id`,null)) AS APPROVED, 
         
        COUNT(IF(`tbl_trans_shop_update`.`is_approved`=0 AND `tbl_trans_shop_update`.`is_updated`=1,`tbl_trans_shop_update`.`outlet_id`,null)) AS PENDINGTO_APPROVED,
        
        COUNT(IF(`tbl_trans_shop_update`.`is_updated`=1 AND `tbl_mst_rep_link_territory_agent`.`range_name`=\'C\',`tbl_trans_shop_update`.`outlet_id`,null)) AS `C`,
        COUNT(IF(`tbl_trans_shop_update`.`is_updated`=1 AND `tbl_mst_rep_link_territory_agent`.`range_name`=\'D\',`tbl_trans_shop_update`.`outlet_id`,null)) AS `D`,
        COUNT(IF(`tbl_trans_shop_update`.`is_updated`=1 AND `tbl_mst_rep_link_territory_agent`.`range_name`=\'B\',`tbl_trans_shop_update`.`outlet_id`,null)) AS `B`,
        COUNT(IF(`tbl_trans_shop_update`.`is_updated`=1 AND `tbl_mst_rep_link_territory_agent`.`range_name`=\'R\',`tbl_trans_shop_update`.`outlet_id`,null)) AS `R`,
        COUNT(IF(`tbl_trans_shop_update`.`is_updated`=1 AND `tbl_mst_rep_link_territory_agent`.`range_name`=\'S\',`tbl_trans_shop_update`.`outlet_id`,null)) AS `S`,
        COUNT(IF(tbl_trans_shop_update.approved_date=\''.$daybeforeyesterday.'\' AND tbl_trans_shop_update.is_updated=0,tbl_trans_shop_update.outlet_id,null)) AS `day_before_yesterday`,
        COUNT(IF(tbl_trans_shop_update.approved_date=\''.$yesterday.'\' AND tbl_trans_shop_update.is_updated=0,tbl_trans_shop_update.outlet_id,null)) AS `yesterday`,
        
          COUNT(IF(`tbl_mst_outlet_range`.`is_closed` = 1, 0, NULL)) AS `closed_count`,
               COUNT(IF(`tbl_mst_outlet_range`.`is_closed` = 0, 0, NULL)) AS `Active_count`,'
          
         );
        
    $this->db->group_by('`tbl_mst_area`.`id`,`tbl_mst_territory`.`id`');
}


        $this->db->from('`tbl_mst_outlet`');
        $this->db->join('`tbl_mst_outlet_range`', '`tbl_mst_outlet`.`id`=`tbl_mst_outlet_range`.`outlet_id`', 'INNER');
        $this->db->join('`tbl_mst_route_link_outlet`', '`tbl_mst_outlet`.`id`=`tbl_mst_route_link_outlet`.`outlet_id`', 'INNER');
        $this->db->join('`tbl_mst_route`', '`tbl_mst_route_link_outlet`.`route_id`=`tbl_mst_route`.`id`', 'INNER');
        $this->db->join('`tbl_mst_territory_link_route`', '`tbl_mst_territory_link_route`.`route_id`=`tbl_mst_route`.`id`', 'INNER');
        $this->db->join('`tbl_mst_territory`', '`tbl_mst_territory_link_route`.`territory_id`=`tbl_mst_territory`.`id`', 'INNER');
        $this->db->join('`tbl_mst_geography`', '`tbl_mst_territory`.`id`=`tbl_mst_geography`.`territory_id`', 'INNER');
        $this->db->join('`tbl_mst_outlet_category`', '`tbl_mst_outlet`.`shop_type`=`tbl_mst_outlet_category`.`id`', 'INNER');
        $this->db->join('`tbl_mst_range`', '`tbl_mst_geography`.`range_id`=`tbl_mst_range`.`id`', 'INNER');
        $this->db->join('`tbl_mst_area`', '`tbl_mst_geography`.`area_id`=`tbl_mst_area`.`id`', 'INNER');
        $this->db->join('`tbl_mst_region`', '`tbl_mst_geography`.`region_id`=`tbl_mst_region`.`id`', 'INNER');
        $this->db->join('`tbl_trans_shop_update`', '`tbl_mst_outlet_range`.`unique_id`=`tbl_trans_shop_update`.`unique_id`', 'LEFT');
        $this->db->join('`tbl_mst_rep_link_territory_agent`', '`tbl_trans_shop_update`.`updated_by`=`tbl_mst_rep_link_territory_agent`.`rep_username`', 'LEFT');

        if($filter==0){
        $this->db->where('`tbl_trans_shop_update`.`is_updated`', 1);
        $this->db->where('`tbl_trans_shop_update`.`is_approved`', 0);
    
         

        }else if($filter==2){
        $this->db->where('`tbl_trans_shop_update`.`is_updated`', 0);
        // $this->db->where('`tbl_trans_shop_update`.`is_approved`', 1);
        $this->db->where('`tbl_mst_outlet_range`.`is_closed`',0);
        }

        $this->db->where('`tbl_mst_range`.`id`', $rangeid);
        $this->db->where('`tbl_mst_geography`.`range_id`', $rangeid);
        $this->db->where('`tbl_trans_shop_update`.`range_id`', $rangeid);
        $this->db->where('`tbl_mst_outlet_range`.`range_id`', $rangeid);
        
    //   $this->db->where('`tbl_mst_outlet_range`.`is_allowed`', 1);
    //   $this->db->where('`tbl_mst_outlet_range`.`is_closed`', 0);
       
      //$this->db->where('`tbl_mst_outlet`.`is_act`', 0);
    
       $this->db->where('`tbl_mst_territory_link_route`.`is_act`', 1);
      // $this->db->where('`tbl_mst_territory_link_route`.`is_del`', 0);
       //$this->db->where('`tbl_mst_route`.`is_act`', 1);
      //$this->db->where('`tbl_mst_territory`.`is_act`', 1);
    
     //$this->db->where('`tbl_mst_outlet_range`.`is_allowed`', 1);
     //$this->db->where('`tbl_mst_outlet_range`.`is_closed`', 0);

        if (!empty($areaid) && isset($areaid)) {
            $this->db->where('`tbl_mst_area`.`id`', $areaid);
        }
        if (!empty($id) && isset($id)) {
            $this->db->where('`tbl_mst_outlet`.`id`', $id);
        }
        if (!empty($territory_id) && isset($territory_id)) {
            $this->db->where('`tbl_mst_territory`.`id`', $territory_id);
        }
        if (!empty($route_id) && isset($route_id)) {
            $this->db->where('`tbl_mst_route`.`id`', $route_id);
        }
        if (!empty($isact) && isset($isact)) {
            //$this->db->where('`tbl_mst_route_link_outlet`.`is_act`', $isact);
           // $this->db->where('`tbl_mst_outlet`.`is_act`', $isact);
        }
        //$this->db->limit(10);
        $this->db->order_by('`tbl_mst_area`.`id`,`tbl_mst_territory`.`id`,`tbl_trans_shop_update`.`is_updated`,`tbl_mst_route`.`display_order`,`tbl_mst_route_link_outlet`.`display_order_in_route`');
        $q = $this->db->get();
        // echo $this->db->last_query();
        //die();
        if (!empty($id) && isset($id)) {
            $result = $q->row();
        } else {
            $result = $q->result_array();
        }
        return $result;
    }

    function processShopUpdate($data) {
        $IsInserted = 1;
        $this->db->trans_begin();
        //print_r($data);die();
        foreach ($data['approve'] as $key => $value) {
            //echo $key . $value . '<br>';
            if ($value == 1) {//Approved
                $this->db->select('`unique_id`, `range_id`, `range_name`, `allowed_to`, `outlet_id`, `is_updated`, `address_1`, `address_2`, `address_3`, `contact_person`, `telephone`, `shop_type`, `image`, `image_name`, `image_created`, `latitude`, `longitude`, `is_closed`, `updated_by`, `updated_date`, `updated_time`, `is_approved`, `approved_by`, `approved_date`');
                $this->db->from('tbl_trans_shop_update');
                $this->db->where('unique_id', $key);
                $this->db->where('is_updated', 1);
                $q = $this->db->get();
                $result = $q->row();
                //Now update tbl_mst_outlet if not closed
                if ($result->is_closed == 0) {
                    $upOutlet = array(
                        'address_1' => $result->address_1,
                        'address_2' => $result->address_2,
                        'address_3' => $result->address_3,
                        'mobile' => $result->telephone,
                        'shop_type' => $result->shop_type,
                        'image' => $result->image,
                        'image_name' => $result->image_name,
                        'image_created' => $result->image_created,
                        'latitude' => $result->latitude,
                        'longitude' => $result->longitude
                    );
                    $this->db->where('id', $result->outlet_id);
                    $this->db->update('tbl_mst_outlet', $upOutlet);
                    if ($this->db->trans_status() === FALSE) {
                        $IsInserted = 0;
                    }
                    //get old system shop auto
                    $this->db->select('reference_code');
                    $this->db->from('tbl_mst_outlet');
                    $this->db->where('id', $result->outlet_id);
                    $qref = $this->db->get();
                    $rRef = $qref->row();
                    if (!empty($rRef->reference_code) && isset($rRef->reference_code)) {//update old shop table
                        $arrUpOld = array(
                            '`add1`' => $result->address_1,
                            '`add2`' => $result->address_2,
                            '`add3`' => $result->address_3,
                            '`sh_tno`' => $result->telephone
                        );
                        $this->db->where('`Auto`', $rRef->reference_code);
                        $this->db->update('`shop_mst`', $arrUpOld);
                        if ($this->db->trans_status() === FALSE) {
                            $IsInserted = 0;
                        }
                    }
                } else {//outlet is closed
                    $upOutletRange = array(
                        '`is_allowed`' => 0,
                        '`is_closed`' => 1,
                    );
                    $this->db->where('unique_id', $result->unique_id);
                    $this->db->update('tbl_mst_outlet_range', $upOutletRange);
                    if ($this->db->trans_status() === FALSE) {
                        $IsInserted = 0;
                    }
                }
                //NOW UPDATE SHOP UPDATE TABLE AS APPROVED ONE
                $data['sess'] = $sess = $this->session->userdata('User');
                $uname = $sess['username'];
                $arrUpdateRequest = array(
                    '`is_approved`' => 1,
                    '`approved_by`' => $uname,
                    '`approved_date`' => date('Y-m-d')
                );
                $this->db->where('unique_id', $key);
                $this->db->where('is_updated', 1);
                $this->db->update('tbl_trans_shop_update', $arrUpdateRequest);
            }elseif ($value == 2) {//Approved without image -image need to recapture
                $this->db->select('`unique_id`, `range_id`, `range_name`, `allowed_to`, `outlet_id`, `is_updated`, `address_1`, `address_2`, `address_3`, `contact_person`, `telephone`, `shop_type`, `image`, `image_name`, `image_created`, `latitude`, `longitude`, `is_closed`, `updated_by`, `updated_date`, `updated_time`, `is_approved`, `approved_by`, `approved_date`');
                $this->db->from('tbl_trans_shop_update');
                $this->db->where('unique_id', $key);
                $this->db->where('is_updated', 1);
                $q = $this->db->get();
                $result = $q->row();
                //Now update tbl_mst_outlet if not closed
                if ($result->is_closed == 0) {
                    $upOutlet = array(
                        'address_1' => $result->address_1,
                        'address_2' => $result->address_2,
                        'address_3' => $result->address_3,
                        'mobile' => $result->telephone,
                        'shop_type' => $result->shop_type,
                        //'image' => $result->image,
                        //'image_name' => $result->image_name,
                        //'image_created' => $result->image_created,
                        'latitude' => $result->latitude,
                        'longitude' => $result->longitude
                    );
                    $this->db->where('id', $result->outlet_id);
                    $this->db->update('tbl_mst_outlet', $upOutlet);
                    if ($this->db->trans_status() === FALSE) {
                        $IsInserted = 0;
                    }
                    //get old system shop auto
                    $this->db->select('reference_code');
                    $this->db->from('tbl_mst_outlet');
                    $this->db->where('id', $result->outlet_id);
                    $qref = $this->db->get();
                    $rRef = $qref->row();
                    if (!empty($rRef->reference_code) && isset($rRef->reference_code)) {//update old shop table
                        $arrUpOld = array(
                            '`add1`' => $result->address_1,
                            '`add2`' => $result->address_2,
                            '`add3`' => $result->address_3,
                            '`sh_tno`' => $result->telephone
                        );
                        $this->db->where('`Auto`', $rRef->reference_code);
                        $this->db->update('`shop_mst`', $arrUpOld);
                        if ($this->db->trans_status() === FALSE) {
                            $IsInserted = 0;
                        }
                    }
                } else {//outlet is closed
                    $upOutletRange = array(
                        '`is_allowed`' => 0,
                        '`is_closed`' => 1,
                    );
                    $this->db->where('unique_id', $result->unique_id);
                    $this->db->update('tbl_mst_outlet_range', $upOutletRange);
                    if ($this->db->trans_status() === FALSE) {
                        $IsInserted = 0;
                    }
                }
                //NOW UPDATE SHOP UPDATE TABLE AS APPROVED ONE
                $data['sess'] = $sess = $this->session->userdata('User');
                $uname = $sess['username'];
                $arrUpdateRequest = array(
                    '`is_updated`' => 0,
                    '`is_approved`' => 0,
                    '`approved_by`' => $uname,
                    '`approved_date`' => date('Y-m-d')
                );
                $this->db->where('unique_id', $key);
                $this->db->where('is_updated', 1);
                $this->db->update('tbl_trans_shop_update', $arrUpdateRequest);
            } else {//rejected
                //NOW UPDATE SHOP UPDATE TABLE AS REJECTED ONE
                $data['sess'] = $sess = $this->session->userdata('User');
                $uname = $sess['username'];
                $arrUpdateRequest = array(
                    '`is_updated`' => 0,
                    '`is_approved`' => 0,
                    '`approved_by`' => $uname,
                    '`approved_date`' => date('Y-m-d')
                );
                $this->db->where('unique_id', $key);
                $this->db->where('is_updated', 1);
                $this->db->update('tbl_trans_shop_update', $arrUpdateRequest);
            }
        }
        if ($IsInserted == 0) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
        return $IsInserted;
    }

    //save and approve or reject data and update outlet details 
    function saveShopUpdate($data) {
        $dataSet = $data['outlet'];
        $IsInserted = 1;

        $add1 = '';
        $add2 = '';
        $add3 = '';
        $mobile = '';
        $allowed_to = '';
        $shop_type = '';
        $image = '';
        $shop_id = $duplicate_id = $dataSet['id'];
        $approve = 0;
        $latitude = 0;
        $longitude = 0;

        if (!empty($dataSet['address_1']) && isset($dataSet['address_1'])) {
            $add1 = $dataSet['address_1'];
        } else {
            $IsInserted = 0;
        }
        if (!empty($dataSet['address_2']) && isset($dataSet['address_2'])) {
            $add2 = $dataSet['address_2'];
        } else {
            $IsInserted = 0;
        }
        if (!empty($dataSet['address_3']) && isset($dataSet['address_3'])) {
            $add3 = $dataSet['address_3'];
        } else {
            $IsInserted = 0;
        }
        if (!empty($dataSet['mobile']) && isset($dataSet['mobile'])) {
            $mobile = $dataSet['mobile'];
        } else {
            $IsInserted = 0;
        }

        if (!empty($dataSet['latitude']) && isset($dataSet['latitude'])) {
            $latitude = $dataSet['latitude'];
        } else {
            $IsInserted = 0;
        }
        if (!empty($dataSet['longitude']) && isset($dataSet['longitude'])) {
            $longitude = $dataSet['longitude'];
        } else {
            $IsInserted = 0;
        }

        if (!empty($dataSet['category']) && isset($dataSet['category'])) {//shop type
            $shop_type = $dataSet['category'];
        } else {
            $IsInserted = 0;
        }
        if (!empty($dataSet['range']) && isset($dataSet['range'])) {//c,d or cd
            $allowed_to = $dataSet['range'];
        } else {
            $IsInserted = 0;
        }
        if (!empty($dataSet['approve']) && isset($dataSet['approve'])) {
            if ($dataSet['approve'] == 1) {
                $approve = $dataSet['approve'];
            } else {
                $approve = 0;
            }
        } else {
            $IsInserted = 0;
        }
        if (!empty($dataSet['duplicate_of']) && isset($dataSet['duplicate_of']) && $dataSet['duplicate_of'] != '-') {
            $duplicate_id = $dataSet['duplicate_of'];
        }
        if (!empty($dataSet['image_up']) && isset($dataSet['image_up']) && $dataSet['image_up'] != 'aa') {
            $image = $dataSet['image_up'];
        } else {
            $IsInserted = 0;
        }
        //echo $IsInserted;
        //die();
        if ($IsInserted == 1) {
            if ($approve == 1) {//approve to update
                $arrUpdate = array(
                    '`address_1`' => $add1,
                    '`address_2`' => $add2,
                    '`address_3`' => $add3,
                    '`mobile`' => $mobile,
                    '`allowed_to`' => $allowed_to,
                    '`shop_type`' => $shop_type,
                    '`image`' => $image,
                    '`duplicate_of`' => $duplicate_id,
                    '`latitude`' => $latitude,
                    '`longitude`' => $longitude
                );
                $this->db->trans_begin();
                $this->db->where('id', $shop_id);
                $this->db->update('tbl_mst_outlet', $arrUpdate);
                //echo $this->db->last_query();
                //UPDATE OLD TABLE

                $arrUpOld = array(
                    '`add1`' => $add1,
                    '`add2`' => $add2,
                    '`add3`' => $add3,
                    '`sh_tno`' => $mobile,
                    '`sh_range`' => $allowed_to
                );
                $this->db->where('`Auto`', $shop_id);
                $this->db->update('`shop_mst`', $arrUpOld);

                $data['sess'] = $sess = $this->session->userdata('User');
                $uname = $sess['username'];
                $arrUpdateRequest = array(
                    '`is_approved`' => 1,
                    '`approved_by`' => $uname,
                    '`approved_date`' => date('Y-m-d')
                );
                $this->db->where('outlet_id', $shop_id);
                $this->db->update('tbl_trans_outlet_update', $arrUpdateRequest);

                if ($this->db->trans_status() === FALSE) {
                    $IsInserted = 0;
                    $this->db->trans_rollback();
                } else {
                    $IsInserted = 1;
                    $this->db->trans_commit();
                }
            } else {// reject data and need to reset as is_updated
                $arr = array(
                    'is_updated' => 0
                );
                $this->db->trans_begin();
                $this->db->where('outlet_id', $shop_id);
                $this->db->update('tbl_trans_outlet_update', $arr);
                //echo $this->db->last_query();

                if ($this->db->trans_status() === FALSE) {
                    $IsInserted = 0;
                    $this->db->trans_rollback();
                } else {
                    $IsInserted = 1;
                    $this->db->trans_commit();
                }
            }
        }
        return $IsInserted;
    }

    //RATASAVARI 
    function getCustomersPromotions($areaid = null, $id = null, $territory_id = null, $route_id = null, $range_id = null, $AcceptStatus = null, $isact = null) {
        if (!empty($id) && isset($id)) {
            $this->db->select('`tbl_mst_outlet`.`id`, `tbl_mst_outlet`.`reference_code`, `tbl_mst_outlet`.`name`, `address_1`, `address_2`, `address_3`, `contact_person`, `telephone`, `mobile`,`tbl_mst_outlet_category`.`id` AS `outlet_category_id`, `tbl_mst_outlet_category`.`name` AS `shop_type_name`, `created_date`, `tbl_mst_outlet`.`created_by`, `tbl_mst_outlet`.`display_order`, `latitude`, `longitude`, `tbl_mst_outlet`.`is_act`, `is_new`, `image`,`tbl_mst_route_link_outlet`.`outlet_code`,`tbl_mst_territory`.`reference_code` AS `territory_reference_code`,`tbl_mst_route`.`reference_code` AS `route_reference_code`');
        } else {
            $this->db->select('`tbl_mst_outlet`.`id`, `tbl_mst_outlet`.`reference_code`, `tbl_mst_outlet`.`name`, `address_1`, `address_2`, `address_3`, `contact_person`, `telephone`, `mobile`,`tbl_mst_outlet_category`.`id` AS `outlet_category_id`, `tbl_mst_outlet_category`.`name` AS `shop_type_name`, `created_date`, `tbl_mst_outlet`.`created_by`, `tbl_mst_outlet`.`display_order`, `latitude`, `longitude`, `tbl_mst_outlet`.`is_act`, `is_new`, \'aa\' AS `image`,`tbl_mst_route_link_outlet`.`outlet_code`,`tbl_mst_territory`.`reference_code` AS `territory_reference_code`,`tbl_mst_route`.`reference_code` AS `route_reference_code`,`tbl_mst_route_link_outlet`.`display_order_in_route`,`a`.`range_id`,`a`.`range_name`, `a`.`scheme_id`, `a`.`slab_id`, `a`.`sale_value`, `a`.`is_accepted`,`b`.`min_range`,`b`.`max_range`, `a`.`condition`, `a`.`status`, `a`.`audit_user`, `a`.`audit_date`, `a`.`audit_time`, `a`.`target_1`, `a`.`target_2`, `a`.`target_3`, `a`.`target_4`, `a`.`target_5`, `a`.`target_1_status`, `a`.`target_2_status`, `a`.`target_3_status`, `a`.`target_4_status`, `a`.`target_5_status`,`tbl_promo_sch`.`name` AS `scheme_name`');
        }
        //$this->db->select('`a`.`id`, `a`.`sale_value`,`a`.`outlet_id`, `a`.`channel_id`, `a`.`range_id`, `a`.`range_name`, `a`.`scheme_id`, `a`.`slab_id`, `a`.`is_accepted`,`b`.`min_range`,`b`.`max_range`');

        $this->db->from('`tbl_mst_outlet`');

        $this->db->join('`tbl_promo_sch_trans_outlet_slabs` AS `a`', '`a`.`outlet_id`=`tbl_mst_outlet`.`reference_code`', 'RIGHT');
        $this->db->join('`tbl_promo_sch_slab` AS `b`', '`a`.`scheme_id`=`b`.`scheme_id` AND `a`.`slab_id`=`b`.`id` AND `a`.`range_id`=`b`.`range_id`', 'INNER');
        $this->db->join('`tbl_promo_sch`', '`a`.`scheme_id`=`tbl_promo_sch`.`id`', 'INNER');

        $this->db->join('`tbl_mst_outlet_category`', '`tbl_mst_outlet`.`shop_type`=`tbl_mst_outlet_category`.`id`', 'INNER');
        $this->db->join('`tbl_mst_route_link_outlet`', '`tbl_mst_outlet`.`id`=`tbl_mst_route_link_outlet`.`outlet_id`', 'INNER');
        $this->db->join('`tbl_mst_route`', '`tbl_mst_route_link_outlet`.`route_id`=`tbl_mst_route`.`id`', 'INNER');
        $this->db->join('`tbl_mst_territory_link_route`', '`tbl_mst_route`.`id`=`tbl_mst_territory_link_route`.`route_id`', 'INNER');
        $this->db->join('`tbl_mst_territory`', '`tbl_mst_territory_link_route`.`territory_id`=`tbl_mst_territory`.`id`', 'INNER');
        $this->db->join('`tbl_mst_area_link_territory`', '`tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id`', 'INNER');
        $this->db->join('`tbl_mst_area`', '`tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id`', 'INNER');
        if (!empty($areaid) && isset($areaid)) {
            $this->db->where('`tbl_mst_area`.`id`', $areaid);
        }
        if (!empty($id) && isset($id)) {
            $this->db->where('`tbl_mst_outlet`.`id`', $id);
        }
        if (!empty($territory_id) && isset($territory_id)) {
            $this->db->where('`tbl_mst_territory`.`id`', $territory_id);
        }
        if (!empty($route_id) && isset($route_id)) {
            $this->db->where('`tbl_mst_route`.`id`', $route_id);
        }
        if (!empty($range_id) && isset($range_id)) {
            $this->db->where('`a`.`range_id`', $range_id);
        }
        if (!empty($isact) && isset($isact)) {
            $this->db->where('`tbl_mst_route_link_outlet`.`is_act`', $isact);
            $this->db->where('`tbl_mst_outlet`.`is_act`', $isact);
        }
        if (!empty($AcceptStatus) && isset($AcceptStatus) && $AcceptStatus != NULL) {
            $this->db->where('`a`.`is_accepted`', $AcceptStatus);
        }

        $this->db->order_by('`tbl_mst_area`.`id`,`tbl_mst_territory`.`id`,`tbl_mst_route`.`display_order`,`tbl_mst_route_link_outlet`.`outlet_id`');
        $q = $this->db->get();
        //echo $this->db->last_query();
        if (!empty($id) && isset($id)) {
            $result = $q->row();
        } else {
            $result = $q->result_array();
        }
        return $result;
    }

    //GET OUTLET VISIT FOR A GIVEN PERIOD
    function getCustomersVisits($area_id, $aa, $territoryID) {
        /*
         * SELECT *
          FROM shop_mst
          LEFT JOIN  (SELECT DISTINCT(shop_mst.Auto)
          FROM `invh`
          INNER JOIN shop_mst ON invh.ag_cd=shop_mst.sh_ag_cd AND invh.ro_cd=shop_mst.sh_ro_cd AND invh.sh_cd=shop_mst.sh_cd
          WHERE invh.date_actual>='2022-11-01' AND invh.date_actual<='2023-01-30' AND invh.b_a='A' AND invh.tot_a_val!=0 ) bill_shop ON shop_mst.Auto=bill_shop.Auto
          WHERE bill_shop.Auto IS  NULL AND shop_mst.sh_stat=0
         */
        $this->db->select('`tbl_mst_outlet`.*,tbl_mst_territory.reference_code AS territory_reference_code,shop_mst.sh_ro_cd AS route_reference_code,`shop_mst`.sh_cd as `outlet_code`,\'\' AS shop_type_name');
        $this->db->from('`shop_mst`');
        $this->db->join('`tbl_mst_outlet`', 'tbl_mst_outlet.reference_code=shop_mst.Auto');
        $this->db->join('(SELECT DISTINCT(shop_mst.Auto)
FROM `invh`
INNER JOIN shop_mst ON invh.ag_cd=shop_mst.sh_ag_cd AND invh.ro_cd=shop_mst.sh_ro_cd AND invh.sh_cd=shop_mst.sh_cd
WHERE invh.date_actual>=\'2022-11-01\' AND invh.date_actual<=\'2023-02-30\' AND invh.b_a=\'A\' AND invh.tot_a_val!=0 ) bill_shop', 'shop_mst.Auto=bill_shop.Auto', 'LEFT');
        $this->db->join('tbl_mst_territory', 'shop_mst.sh_ag_cd=tbl_mst_territory.reference_code', 'INNER');
        $this->db->join('area_d', 'shop_mst.sh_ag_cd=area_d.ag_cd', 'INNER');
        $this->db->where(array(
            'shop_mst.sh_stat' => 0,
            'bill_shop.Auto' => NULL,
            'tbl_mst_territory.id' => $territoryID,
            'area_d.area_cd' => $area_id
        ));
        $q = $this->db->get();
        $result = $q->result_array();
        //print_r($result);
        //echo $this->db->last_query();
        return $result;
    }

}

?>