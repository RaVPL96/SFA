<?php
class SalesarcustomersModule extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function getCustomerMaster(){
        $this->db->select('`tbl_mst_outlet`.`id`, `reference_code`, `tbl_mst_outlet`.`name`, `address_1`, `address_2`, `address_3`, `contact_person`, `telephone`, `mobile`, `tbl_mst_outlet_category`.`name` AS `shop_type_name`, `created_date`, `created_by`, `display_order`, `latitude`, `longitude`, `tbl_mst_outlet`.`is_act`, `is_new`, `image`');
        $this->db->from('`tbl_mst_outlet`');
        $this->db->join('`tbl_mst_outlet_category`', '`tbl_mst_outlet`.`shop_type`=`tbl_mst_outlet_category`.`id`', 'INNER');
        $q = $this->db->get();
        $result = $q->result_array();
		return $result;
    }
	function saveCustomersOrders($data){
		$IsInserted=1;
		$route_id=$data['route_id'];
		//print_r($data);
		$count_r=1;
		$this->db->trans_begin();
		//update old database table
		foreach($data['shopListRef'] as $r){
			$arrUp=array('`sh_display_order`'=>$count_r);
			$this->db->where('`Auto`',(int)$r);
			$this->db->update('`shop_mst`',$arrUp);
			$count_r +=1;
			//echo $this->db->last_query().'<br>';
		}	
		//update new mapping table
		$count_l=1;
		foreach($data['shopList'] as $l){
			$arrUpL=array('`display_order_in_route`'=>$count_l);
			$this->db->where('`outlet_id`',trim($l));
			$this->db->where('`route_id`',(int)$route_id);
			$this->db->update('`tbl_mst_route_link_outlet`',$arrUpL);
			$count_l +=1;
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
	
	function getCustomers($areaid = null, $id = null, $territory_id = null, $route_id = null, $isact=null) {
        if (!empty($id) && isset($id)) {
            $this->db->select('`tbl_mst_outlet`.`id`, `tbl_mst_outlet`.`reference_code`, `tbl_mst_outlet`.`name`, `address_1`, `address_2`, `address_3`, `contact_person`, `telephone`, `mobile`,`tbl_mst_outlet_category`.`id` AS `outlet_category_id`, `tbl_mst_outlet_category`.`name` AS `shop_type_name`, `created_date`, `tbl_mst_outlet`.`created_by`, `tbl_mst_outlet`.`display_order`, `latitude`, `longitude`, `tbl_mst_outlet`.`is_act`, `is_new`, `image`,`tbl_mst_route_link_outlet`.`outlet_code`,`tbl_mst_territory`.`reference_code` AS `territory_reference_code`,`tbl_mst_route`.`reference_code` AS `route_reference_code`');
        }else{
            $this->db->select('`tbl_mst_outlet`.`id`, `tbl_mst_outlet`.`reference_code`, `tbl_mst_outlet`.`name`, `address_1`, `address_2`, `address_3`, `contact_person`, `telephone`, `mobile`,`tbl_mst_outlet_category`.`id` AS `outlet_category_id`, `tbl_mst_outlet_category`.`name` AS `shop_type_name`, `created_date`, `tbl_mst_outlet`.`created_by`, `tbl_mst_outlet`.`display_order`, `latitude`, `longitude`, `tbl_mst_outlet`.`is_act`, `is_new`, \'aa\' AS `image`,`tbl_mst_route_link_outlet`.`outlet_code`,`tbl_mst_territory`.`reference_code` AS `territory_reference_code`,`tbl_mst_route`.`reference_code` AS `route_reference_code`,`tbl_mst_route_link_outlet`.`display_order_in_route`');
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
    function getNewCustomers($areaid = null, $fromdate = null, $todate = null,$territory_id= null,$route_id= null) {
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
        /*
          while (date('m', strtotime($var1)) != date('m', strtotime($var2))) {
          //$result .= date('MY',(strtotime('next month',strtotime($var1)))).",";
          //$var1 = date('Y-m-d',(strtotime('next month',strtotime($var1))));
          $str.=', COUNT(DISTINCT  IF(month(`tbl_mst_outlet`.`created_date`)='.date('mm',(strtotime('next month',strtotime($var1)))).' and year(`tbl_mst_outlet`.`created_date`)='.date('Y',(strtotime('next month',strtotime($var1)))).', `tbl_mst_outlet`.`id`,null)) AS `'.date('Y',(strtotime('next month',strtotime($var1)))).'-'.date('M',(strtotime('next month',strtotime($var1)))).'`';
          } */
        //echo $str;
        //die();
        $this->db->select('`tbl_mst_area`.`area_name`,`tbl_mst_territory`.`territory_name`' . $str . ',COUNT(DISTINCT `tbl_mst_outlet`.`id`) AS `TOTAL_SHOPS`');
        $this->db->from('`tbl_mst_outlet`');
        $this->db->join('`tbl_mst_outlet_category`', '`tbl_mst_outlet`.`shop_type`=`tbl_mst_outlet_category`.`id`', 'INNER');
        $this->db->join('`tbl_mst_route_link_outlet`', '`tbl_mst_outlet`.`id`=`tbl_mst_route_link_outlet`.`outlet_id`', 'INNER');
        $this->db->join('`tbl_mst_route`', '`tbl_mst_route_link_outlet`.`route_id`=`tbl_mst_route`.`id`', 'INNER');
        $this->db->join('`tbl_mst_territory_link_route`', '`tbl_mst_route`.`id`=`tbl_mst_territory_link_route`.`route_id`', 'INNER');
        $this->db->join('`tbl_mst_territory`', '`tbl_mst_territory_link_route`.`territory_id`=`tbl_mst_territory`.`id`', 'INNER');
        $this->db->join('`tbl_mst_area_link_territory`', '`tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id`', 'INNER');
        $this->db->join('`tbl_mst_area`', '`tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id`', 'INNER');
        if (!empty($areaid) && isset($areaid) and $areaid!=-1) {
            $this->db->where('`tbl_mst_area`.`id`', $areaid);
        }
        if (!empty($territory_id) && isset($territory_id)) {
            $this->db->where('`tbl_mst_territory`.`id`', $territory_id);
        }
        if (!empty($route_id) && isset($route_id)) {
            $this->db->where('`tbl_mst_route`.`id`', $route_id);
        }
        /*if (!empty($fromdate) && isset($fromdate) && !empty($todate) && isset($todate)) {
            $this->db->where('`tbl_mst_outlet`.`created_date`>=', $fromdate);
            $this->db->where('`tbl_mst_outlet`.`created_date`<=', $todate);
        }*/
        $this->db->where('`tbl_mst_outlet`.`is_act`', 1);
        //$this->db->where('`tbl_mst_route_link_outlet`.`is_act`', 1);
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
	function getNewCustomersDetails($areaid = null, $fromdate = null, $todate = null,$territory_id= null,$route_id= null) {
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
        $this->db->select('`tbl_mst_area`.`area_name`,`tbl_mst_territory`.`territory_name`, `tbl_mst_outlet`.`created_by`, ' . $str . ',COUNT(DISTINCT `tbl_mst_outlet`.`id`) AS `TOTAL_SHOPS`');
        $this->db->from('`tbl_mst_outlet`');
        $this->db->join('`tbl_mst_outlet_category`', '`tbl_mst_outlet`.`shop_type`=`tbl_mst_outlet_category`.`id`', 'INNER');
        $this->db->join('`tbl_mst_route_link_outlet`', '`tbl_mst_outlet`.`id`=`tbl_mst_route_link_outlet`.`outlet_id`', 'INNER');
        $this->db->join('`tbl_mst_route`', '`tbl_mst_route_link_outlet`.`route_id`=`tbl_mst_route`.`id`', 'INNER');
        $this->db->join('`tbl_mst_territory_link_route`', '`tbl_mst_route`.`id`=`tbl_mst_territory_link_route`.`route_id`', 'INNER');
        $this->db->join('`tbl_mst_territory`', '`tbl_mst_territory_link_route`.`territory_id`=`tbl_mst_territory`.`id`', 'INNER');
        $this->db->join('`tbl_mst_area_link_territory`', '`tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id`', 'INNER');
        $this->db->join('`tbl_mst_area`', '`tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id`', 'INNER');
        if (!empty($areaid) && isset($areaid) and $areaid!=-1) {
            $this->db->where('`tbl_mst_area`.`id`', $areaid);
        }
        if (!empty($territory_id) && isset($territory_id)) {
            $this->db->where('`tbl_mst_territory`.`id`', $territory_id);
        }
        if (!empty($route_id) && isset($route_id)) {
            $this->db->where('`tbl_mst_route`.`id`', $route_id);
        }
        $this->db->where('`tbl_mst_outlet`.`is_act`', 1);
        //$this->db->where('`tbl_mst_route_link_outlet`.`is_act`', 1);
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