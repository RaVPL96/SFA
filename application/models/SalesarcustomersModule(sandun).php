<?php

class SalesarcustomersModule extends CI_Model {

    function __construct() {
        parent::__construct();
        //$this->mssql = $this->load->database('MSSQL', TRUE); 
    }

    function getCustomerMaster() {
        $this->db->select('`tbl_mst_outlet`.`id`, `reference_code`, `tbl_mst_outlet`.`name`, `address_1`, `address_2`, `address_3`, `contact_person`, `telephone`, `mobile`, `tbl_mst_outlet_category`.`name` AS `shop_type_name`, `created_date`, `created_by`, `display_order`, `latitude`, `longitude`, `tbl_mst_outlet`.`is_act`, `is_new`, `image`');
        $this->db->from('`tbl_mst_outlet`');
        $this->db->join('`tbl_mst_outlet_category`', '`tbl_mst_outlet`.`shop_type`=`tbl_mst_outlet_category`.`id`', 'INNER');
        $q = $this->db->get();
        $result = $q->result_array();
        return $result;
    }

    function getCustomers($areaid = null, $id = null, $territory_id = null, $route_id = null) {
        if (!empty($id) && isset($id)) {
            $this->db->select('`tbl_mst_outlet`.`id`, `tbl_mst_outlet`.`reference_code`, `tbl_mst_outlet`.`name`, `address_1`, `address_2`, `address_3`, `contact_person`, `telephone`, `mobile`,`tbl_mst_outlet_category`.`id` AS `outlet_category_id`, `tbl_mst_outlet_category`.`name` AS `shop_type_name`, `created_date`, `tbl_mst_outlet`.`created_by`, `tbl_mst_outlet`.`display_order`, `latitude`, `longitude`, `tbl_mst_outlet`.`is_act`, `is_new`, `image`,`tbl_mst_route_link_outlet`.`outlet_code`,`tbl_mst_territory`.`reference_code` AS `territory_reference_code`,`tbl_mst_route`.`reference_code` AS `route_reference_code`');
        }else{
            $this->db->select('`tbl_mst_outlet`.`id`, `tbl_mst_outlet`.`reference_code`, `tbl_mst_outlet`.`name`, `address_1`, `address_2`, `address_3`, `contact_person`, `telephone`, `mobile`,`tbl_mst_outlet_category`.`id` AS `outlet_category_id`, `tbl_mst_outlet_category`.`name` AS `shop_type_name`, `created_date`, `tbl_mst_outlet`.`created_by`, `tbl_mst_outlet`.`display_order`, `latitude`, `longitude`, `tbl_mst_outlet`.`is_act`, `is_new`, \'aa\' AS `image`,`tbl_mst_route_link_outlet`.`outlet_code`,`tbl_mst_territory`.`reference_code` AS `territory_reference_code`,`tbl_mst_route`.`reference_code` AS `route_reference_code`');
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
            $this->db->WHERE('`tbl_mst_area`.`id`', $areaid);
        }
        if (!empty($id) && isset($id)) {
            $this->db->WHERE('`tbl_mst_outlet`.`id`', $id);
        }
        if (!empty($territory_id) && isset($territory_id)) {
            $this->db->WHERE('`tbl_mst_territory`.`id`', $territory_id);
        }
        if (!empty($route_id) && isset($route_id)) {
            $this->db->WHERE('`tbl_mst_route`.`id`', $route_id);
        }
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

    function getCustomersNearBy($orig_lat, $orig_lon, $distance) {
        $this->db->select('`tbl_mst_outlet`.`id`, `tbl_mst_outlet`.`reference_code`, `tbl_mst_outlet`.`name`, `address_1`, `address_2`, `address_3`, `contact_person`, `telephone`, `mobile`,`tbl_mst_outlet_category`.`id` AS `outlet_category_id`, `tbl_mst_outlet_category`.`name` AS `shop_type_name`, `created_date`, `tbl_mst_outlet`.`created_by`, `tbl_mst_outlet`.`display_order`, `latitude`, `longitude`, `tbl_mst_outlet`.`is_act`, `is_new`, `image`,`tbl_mst_route_link_outlet`.`outlet_code`,`tbl_mst_territory`.`reference_code` AS `territory_reference_code`,`tbl_mst_route`.`reference_code` AS `route_reference_code`, 3956*2*ASIN(SQRT(POWER(SIN((' . $orig_lat . '-abs(tbl_mst_outlet.latitude))*pi()/180/2),2)+COS(' . $orig_lat . '*pi()/180)*COS(abs(tbl_mst_outlet.latitude)*pi()/180)*POWER(SIN((' . $orig_lon . '-tbl_mst_outlet.longitude)*pi()/180/2),2))) as `distance`');
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

    //MAINTAIN CUSTOMERS
    function saveCustomers($data) {
        $IsInserted = 1;
        $data = $data['sop'];

        $id = $data['id'];
        $sopid = $data['sopid'];
        $areaid = $data['areaid'];
        $territoryid = $data['territoryid'];
        $routeid = $data['routeid'];

        if (!empty($data['isact']) && isset($data['isact'])) {
            $isact = $data['isact'];
        } else {
            $isact = 0;
        }
        if (!empty($data['isdel']) && isset($data['isdel'])) {
            $isdel = $data['isdel'];
        } else {
            $isdel = 0;
        }

        $name = $data['name'];
        $mobile = $data['mobile'];
        $shopcode = $data['shopcode'];
        $shoperpcode = $data['shoperpcode'];
        $outstanding = $data['outstanding'];
        $address = $data['address'];

        $this->db->trans_begin();

        ////REOVE OLD ENTRIES OF SALES REPS TERRITORY
        //$arrUp=array(
        //	'`isact`'=>$isact,
        //	'`isdel`'=>$isdel
        //);
        //
		//$this->db->where(array('`rep_username`'=>$name));
        //$this->db->update('`sales_operations_area_territory_rep`',$arrUp);
        //if ($this->db->trans_status() === FALSE) {
        //   $IsInserted = 0;
        //}

        if ($id == 'new') {
            $arr = array(
                '`sales_operation_id`' => $sopid,
                '`sales_operation_area_id`' => $areaid,
                '`territory_id`' => $territoryid,
                '`route_id`' => $routeid,
                '`route_code`' => '-',
                '`name`' => $name,
                '`address`' => $address,
                '`mobile`' => $mobile,
                '`shop_code`' => $shopcode,
                '`shop_erp_code`' => $shoperpcode,
                '`outstanding`' => $outstanding,
                '`isact`' => $isact,
                '`isdel`' => $isdel
            );
            $this->db->insert('`sales_operations_customers`', $arr);
            if ($this->db->trans_status() === FALSE) {
                $IsInserted = 0;
            }
        } else {
            $arr = array(
                '`sales_operation_id`' => $sopid,
                '`sales_operation_area_id`' => $areaid,
                '`territory_id`' => $territoryid,
                '`route_id`' => $routeid,
                '`route_code`' => '-',
                '`name`' => $name,
                '`address`' => $address,
                '`mobile`' => $mobile,
                '`shop_code`' => $shopcode,
                '`shop_erp_code`' => $shoperpcode,
                '`outstanding`' => $outstanding,
                '`isact`' => $isact,
                '`isdel`' => $isdel
            );
            $this->db->where('`id`', $id);
            $this->db->update('`sales_operations_customers`', $arr);
            if ($this->db->trans_status() === FALSE) {
                $IsInserted = 0;
            }
        }

        if ($IsInserted == 1) {
            $this->db->trans_commit();
            return 1;
        } else {
            $this->db->trans_rollback();
            return 0;
        }
    }

    function getSecondaryCustomers($id = null, $opid = null, $company_code = 'RM', $area_id = null, $territory_id = null, $route_id = null) {
        $this->db->select('`sales_operations_customers`.`id` AS `cusSYSID`,`sales_operations_customers`.`name` AS `cus_name`,`sales_operations_customers`.`mobile`,`sales_operations_customers`.`shop_code`,`sales_operations_customers`.`shop_erp_code`,`sales_operations_customers`.`outstanding`,`sales_operations_area_territory_route`.`route`,`sales_operations_area_territory_route`.`route_code`,`sales_operations_area_territory_route`.`id`,`sales_operations_area_territory_route`.`territory_id`, `sales_operations_area_territory`.`name`, `sales_operations_area_territory`.`sales_operation_id`, `sales_operations_area_territory`.`sales_operation_area_id`, `sales_operations_area_territory_route`.`isact`, `sales_operations_area_territory_route`.`isdel`,`sales_operations_area`.`id` AS `sopa_id`, `sales_operations_area`.`name` AS `sopa_name`, `sales_operations_area`.`sales_operation_id` AS `sopa_sales_operation_id`, `sales_operations_area`.`isact` AS `sopa_isact`, `sales_operations_area`.`isdel` AS `soap_isdel`,`sales_operations`.`id` AS `op_id`, `sales_operations`.`name` AS `op_name`, `sales_operations`.`isact` AS `op_isact`, `sales_operations`.`isdel` AS `op_isdel`');
        $this->db->from('`sales_operations_customers`');
        $this->db->join('`sales_operations_area_territory_route`', '`sales_operations_customers`.`route_id`=`sales_operations_area_territory_route`.`id`', 'LEFT');
        $this->db->join('`sales_operations_area_territory`', '`sales_operations_area_territory_route`.`territory_id`=`sales_operations_area_territory`.`id`', 'LEFT');
        $this->db->join('`sales_operations_area`', '`sales_operations_area_territory`.`sales_operation_area_id`=`sales_operations_area`.`id`', 'LEFT');
        $this->db->join('`sales_operations`', '`sales_operations_area`.`sales_operation_id`=`sales_operations`.`id`', 'LEFT');
        if (!empty($id) && isset($id)) {
            $this->db->where('`sales_operations_area_territory_route`.`id`', $id);
        }
        if (!empty($opid) && isset($opid)) {
            $this->db->where('`sales_operations`.`id`', $opid);
        }

        if (!empty($area_id) && isset($area_id)) {
            $this->db->where('`sales_operations_area`.`id`', $area_id);
        }
        if (!empty($territory_id) && isset($territory_id)) {
            $this->db->where('`sales_operations_area_territory`.`id`', $territory_id);
        }
        if (!empty($route_id) && isset($route_id)) {
            $this->db->where('`sales_operations_area_territory_route`.`id`', $route_id);
        }

        $this->db->where('`sales_operations_area_territory_route`.`isdel`', 0);
        $this->db->where('`sales_operations`.`company_code`', $company_code);
        $query = $this->db->get();
        if (!empty($id) && isset($id)) {
            $result = $query->row();
        } else {
            $result = $query->result_array();
        }
        //echo $this->db->last_query();
        return $result;
    }

    function getNewCustomers($areaid = null, $territoryid = null, $fromdate = null, $todate = null,$territoryid= null,$route_id= null) {

        $str = '';
        $str1 = '';

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
        //sandn
        do {
            
          //$output[] = $month;  
        $str1 .= ', COUNT(DISTINCT  IF(area(`tbl_mst_area_link_territory`.`area_id`)=' . $areaid . ' and territory(`tbl_mst_area_link_territory`.`territory_id`)=' . $territoryid . ', `tbl_mst_area_link_territory`.`id`,null)) AS `' . $areaid . '=' . $territoryid . '`';
            //$time = strtotime('+1 month', $time);
        } while (null);
        //sandn

        /*
          while (date('m', strtotime($var1)) != date('m', strtotime($var2))) {
          //$result .= date('MY',(strtotime('next month',strtotime($var1)))).",";
          //$var1 = date('Y-m-d',(strtotime('next month',strtotime($var1))));
          $str.=', COUNT(DISTINCT  IF(month(`tbl_mst_outlet`.`created_date`)='.date('mm',(strtotime('next month',strtotime($var1)))).' and year(`tbl_mst_outlet`.`created_date`)='.date('Y',(strtotime('next month',strtotime($var1)))).', `tbl_mst_outlet`.`id`,null)) AS `'.date('Y',(strtotime('next month',strtotime($var1)))).'-'.date('M',(strtotime('next month',strtotime($var1)))).'`';
          } */
        //echo $str;
        //die();
        $this->db->select('`tbl_mst_area`.`area_name`,`tbl_mst_territory`.`territory_name`' . $str . ',COUNT(DISTINCT `tbl_mst_outlet`.`id`) AS `TOTAL_SHOPS`' . $str1 . ',COUNT(DISTINCT `tbl_mst_area_link_territory`.`territory_id`) AS `TOTAL_TERRITORIES`');
        $this->db->from('`tbl_mst_outlet`');
        $this->db->join('`tbl_mst_outlet_category`', '`tbl_mst_outlet`.`shop_type`=`tbl_mst_outlet_category`.`id`', 'INNER');
        $this->db->join('`tbl_mst_route_link_outlet`', '`tbl_mst_outlet`.`id`=`tbl_mst_route_link_outlet`.`outlet_id`', 'INNER');
        $this->db->join('`tbl_mst_route`', '`tbl_mst_route_link_outlet`.`route_id`=`tbl_mst_route`.`id`', 'INNER');
        $this->db->join('`tbl_mst_territory_link_route`', '`tbl_mst_route`.`id`=`tbl_mst_territory_link_route`.`route_id`', 'INNER');
        $this->db->join('`tbl_mst_territory`', '`tbl_mst_territory_link_route`.`territory_id`=`tbl_mst_territory`.`id`', 'INNER');
        $this->db->join('`tbl_mst_area_link_territory`', '`tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id`', 'INNER');
        $this->db->join('`tbl_mst_area`', '`tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id`', 'INNER');
        if (!empty($areaid) && isset($areaid) and $areaid!=-1) {
            $this->db->WHERE('`tbl_mst_area`.`id`', $areaid);
        }
        if (!empty($territory_id) && isset($territory_id)) {
            $this->db->WHERE('`tbl_mst_territory`.`id`', $territory_id);
        }
        if (!empty($route_id) && isset($route_id)) {
            $this->db->WHERE('`tbl_mst_route`.`id`', $route_id);
        }
        /*if (!empty($fromdate) && isset($fromdate) && !empty($todate) && isset($todate)) {
            $this->db->WHERE('`tbl_mst_outlet`.`created_date`>=', $fromdate);
            $this->db->WHERE('`tbl_mst_outlet`.`created_date`<=', $todate);
        }*/
        $this->db->WHERE('`tbl_mst_outlet`.`is_act`', 1);
        //$this->db->WHERE('`tbl_mst_route_link_outlet`.`is_act`', 1);
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

    function getNewCustomersDetails($areaid = null, $territoryid = null, $fromdate = null, $todate = null, $territory_id= null,$route_id= null) {

        $str = '';
        $str1 = '';

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
        //sandn
        do {
            
          //$output[] = $month;  
        $str1 .= ', COUNT(DISTINCT  IF(area(`tbl_mst_area_link_territory`.`area_id`)=' . $areaid . ' and territory(`tbl_mst_area_link_territory`.`territory_id`)=' . $territoryid . ', `tbl_mst_area_link_territory`.`id`,null)) AS `' . $areaid . '=' . $territoryid . '`';
            //$time = strtotime('+1 month', $time);
        } while (null);
        //sandn

        /*
          while (date('m', strtotime($var1)) != date('m', strtotime($var2))) {
          //$result .= date('MY',(strtotime('next month',strtotime($var1)))).",";
          //$var1 = date('Y-m-d',(strtotime('next month',strtotime($var1))));
          $str.=', COUNT(DISTINCT  IF(month(`tbl_mst_outlet`.`created_date`)='.date('mm',(strtotime('next month',strtotime($var1)))).' and year(`tbl_mst_outlet`.`created_date`)='.date('Y',(strtotime('next month',strtotime($var1)))).', `tbl_mst_outlet`.`id`,null)) AS `'.date('Y',(strtotime('next month',strtotime($var1)))).'-'.date('M',(strtotime('next month',strtotime($var1)))).'`';
          } */
        //echo $str;
        //die();
        $this->db->select('`tbl_mst_area`.`area_name`,`tbl_mst_territory`.`territory_name`, `tbl_mst_outlet`.`created_by`' . $str . ',COUNT(DISTINCT `tbl_mst_outlet`.`id`) AS `TOTAL_SHOPS`' . $str1 . ',COUNT(DISTINCT `tbl_mst_area_link_territory`.`territory_id`) AS `TOTAL_TERRITORIES`');
        $this->db->from('`tbl_mst_outlet`');
        $this->db->join('`tbl_mst_outlet_category`', '`tbl_mst_outlet`.`shop_type`=`tbl_mst_outlet_category`.`id`', 'INNER');
        $this->db->join('`tbl_mst_route_link_outlet`', '`tbl_mst_outlet`.`id`=`tbl_mst_route_link_outlet`.`outlet_id`', 'INNER');
        $this->db->join('`tbl_mst_route`', '`tbl_mst_route_link_outlet`.`route_id`=`tbl_mst_route`.`id`', 'INNER');
        $this->db->join('`tbl_mst_territory_link_route`', '`tbl_mst_route`.`id`=`tbl_mst_territory_link_route`.`route_id`', 'INNER');
        $this->db->join('`tbl_mst_territory`', '`tbl_mst_territory_link_route`.`territory_id`=`tbl_mst_territory`.`id`', 'INNER');
        $this->db->join('`tbl_mst_area_link_territory`', '`tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id`', 'INNER');
        $this->db->join('`tbl_mst_area`', '`tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id`', 'INNER');
        if (!empty($areaid) && isset($areaid) and $areaid!=-1) {
            $this->db->WHERE('`tbl_mst_area`.`id`', $areaid);
        }
        if (!empty($territory_id) && isset($territory_id)) {
            $this->db->WHERE('`tbl_mst_territory`.`id`', $territory_id);
        }
        if (!empty($route_id) && isset($route_id)) {
            $this->db->WHERE('`tbl_mst_route`.`id`', $route_id);
        }
        /*if (!empty($fromdate) && isset($fromdate) && !empty($todate) && isset($todate)) {
            $this->db->WHERE('`tbl_mst_outlet`.`created_date`>=', $fromdate);
            $this->db->WHERE('`tbl_mst_outlet`.`created_date`<=', $todate);
        }*/
        $this->db->WHERE('`tbl_mst_outlet`.`is_act`', 1);
        //$this->db->WHERE('`tbl_mst_route_link_outlet`.`is_act`', 1);
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
}

?>