<?php

class ItemsModel extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
    }

    function getLocationList($id = null) {
        $this->db->select('`id`,`code`, `name`,`address`,`phone`,`email`,`website`, `isact`');
        $this->db->from('`ic_locations`');
        if (!is_null($id)) {
            $this->db->where('`id`', $id);
        }
        $this->db->where('`isdel`', 0);
        $this->db->order_by('`id` ASC');
        $query = $this->db->get();
        if (!is_null($id)) {
            $result = $query->row();
        } else {
            $result = $query->result_array();
        }
        return $result;
    }

    //GET DEPARTMENT
    function getDepartments($id = null) {
        $this->db->select('`id`,`name`,`isact`,`isdel`');
        $this->db->from('`ic_locations_department`');
        if (!is_null($id)) {
            $this->db->where('`id`', $id);
        }
        $this->db->where('`isdel`', 0);
        $this->db->order_by('`id` ASC');
        $query = $this->db->get();
        if (!is_null($id)) {
            $result = $query->row();
        } else {
            $result = $query->result_array();
        }
        return $result;
    }

    //UPDATE LOCATION DATA
    function updateLocationData($data) {
        $IsInserted = 0;
        $location = $data['location'];
        $act = 0;
        $id = $location['id'];

        if (!empty($location['name']) && isset($location['name']) && !empty($location['address']) && isset($location['address']) && !empty($location['phone']) && isset($location['phone'])) {
            $name = $location['name'];
            $address = $location['address'];
            $phone = $location['phone'];
            $email = $location['email'];
            $web = $location['website'];

            if (!empty($location['isact'])) {
                $act = $location['isact'];
            } else {
                $act = 0;
            }

            if ($id == 'new') {
                $inarr = array(
                    'name' => $name,
                    'address' => $address,
                    'phone' => $phone,
                    'email' => $email,
                    'website' => $web,
                    'isact' => $act
                );
                $this->db->trans_begin();
                $this->db->insert('ic_locations', $inarr);
                if ($this->db->trans_status() === FALSE) {
                    $IsInserted = 0;
                    $this->db->trans_rollback();
                } else {
                    $IsInserted = 1;
                    $this->db->trans_commit();
                }
            } else {//update
                $inarr = array(
                    'name' => $name,
                    'address' => $address,
                    'phone' => $phone,
                    'email' => $email,
                    'website' => $web,
                    'isact' => $act
                );
                $this->db->trans_begin();
                $this->db->where('`id`', $id);
                $this->db->update('ic_locations', $inarr);
                if ($this->db->trans_status() === FALSE) {
                    $IsInserted = 0;
                    $this->db->trans_rollback();
                } else {
                    $IsInserted = 1;
                    $this->db->trans_commit();
                }
            }
        } else {
            $IsInserted = 0;
        }
        return $IsInserted;
    }

    function updateLocation($uname, $type, $updateVal) {
        $IsInserted = 1;
        $this->db->trans_begin();
        if ($type == 'delete') {
            $updateArr = array('isdel' => $updateVal);
        } elseif ($type == 'update') {
            $updateArr = array('isact' => $updateVal);
        }
        $this->db->where('id', $uname);
        $this->db->update('ic_locations', $updateArr);
        if ($this->db->trans_status() === FALSE) {
            $IsInserted = 0;
            $this->db->trans_rollback();
        } else {
            $IsInserted = 1;
            $this->db->trans_commit();
        }
        return $IsInserted;
    }

    function saveStockDetail($rowCount=null,$sellable=null,$damageQty=null,$unitPrice=null,$subTotal=null,$netTotal=null,$payments=null,$balance=null,$upRowCount=null,$up_itemCode=null,$up_itemName=null,$up_sellable=null,$up_damageQty=null,$up_unitPrice=null,$up_subTotal=null,$rangeId=null,$areaID=null,$territoryID=null,$requestDate=null,$itemCode=null,$itemName=null,$comments=null,$rangeName=null,$up_unitOfMess=null,$itemUom=null){
        
        $IsInserted = 1;

        $data['sess'] = $sess = $this->session->userdata('User');

        $this->db->trans_begin();
        $arrIn = array(
            'stock_in_date'=> $requestDate,
            'area_id'      => $areaID,
            'range_id'     => $rangeId,
            'range_name'   => $rangeName,
            'territory_id' => $territoryID,
            'net_total'    => $netTotal,
            'payments'     => 0.00,
            'balance'      => 0.00,
            'comments'     => $comments,
            'date'         => date('Y-m-d'),
            'time'         => date('H:i:s'),
            'user'         => $sess['username']
        );

        $this->db->insert('trans_stock_h', $arrIn);
        // echo $this->db->last_query();
        // die();

        if ($this->db->trans_status() === FALSE) {
            $IsInserted = 0;
        }


        $last_id = $this->db->insert_id();
        // echo $this->db->last_query();

             

        for ($x = 0; $x < $upRowCount; $x++) {

            if(!empty($up_sellable[$x])){

            $arrIn = array(
                'main_id'      => $last_id,
                'item_code'    => $up_itemCode[$x],
                'uom'          => $up_unitOfMess[$x],
                'item_name'    => $up_itemName[$x],
                'sellable_qty' => $up_sellable[$x],
                'damage_qty'   => $up_damageQty[$x],
                'price'        => $up_unitPrice[$x],
                'sub_total'    => $up_subTotal[$x]
            );
            $this->db->insert('trans_stock_d', $arrIn);
        // echo $this->db->last_query();
            
            if ($this->db->trans_status() === FALSE) {
                $IsInserted = 0;
            }
            
            }

}

        for ($y = 1; $y < $rowCount; $y++) {

            if(!empty($sellable[$y])){
            $arrIn = array(
                'main_id'      => $last_id,
                'item_code'    => $itemCode[$y],
                'uom'          => $itemUom[$x],
                'item_name'    => $itemName[$y],
                'sellable_qty' => $sellable[$y],
                'damage_qty'   => $damageQty[$y],
                'price'        => $unitPrice[$y],
                'sub_total'    => $subTotal[$y]
            );
            $this->db->insert('trans_stock_d', $arrIn);
            if ($this->db->trans_status() === FALSE) {
                $IsInserted = 0;
            }
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
    
    function getMaindetail($invNum=null){
        $this->db->select('`trans_stock_h`.`stock_in_date`,`trans_stock_h`.`range_name`,`tbl_mst_area`.`area_name`,`tbl_mst_territory`.`territory_name`,`trans_stock_h`.`comments`');
        $this->db->from('`trans_stock_h`');
        $this->db->join('`trans_stock_d`','`trans_stock_h`.`id` = `trans_stock_d`.`main_id`', 'INNER');
        $this->db->join('`tbl_mst_area`','`trans_stock_h`.`area_id` = `tbl_mst_area`.`id`', 'INNER');
        $this->db->join('`tbl_mst_territory`','`trans_stock_h`.`territory_id` = `tbl_mst_territory`.`id`', 'INNER');
        $this->db->where('`trans_stock_h`.`id`',$invNum);
        $this->db->group_by('`trans_stock_h`.`id`');
        $query = $this->db->get();
        // echo $this->db->last_query();
        // die();
        $result = $query->result_array();
        return $result;

    }
    function getFulldetail($invNum=null){

        $this->db->select('`trans_stock_h`.`stock_in_date`,`trans_stock_h`.`range_name`,`trans_stock_h`.`net_total`, `trans_stock_h`.`comments`,`trans_stock_h`.`id`,`trans_stock_d`.`item_code`,`trans_stock_d`.`item_name`,`trans_stock_d`.`sellable_qty`,`trans_stock_d`.`damage_qty`,`trans_stock_d`.`price`,`trans_stock_d`.`sub_total`,`tbl_mst_area`.`area_name`,`tbl_mst_territory`.`territory_name`,`trans_stock_d`.`uom`');
        $this->db->from('`trans_stock_h`');
        $this->db->join('`trans_stock_d`','`trans_stock_h`.`id` = `trans_stock_d`.`main_id`', 'INNER');
        $this->db->join('`tbl_mst_area`','`trans_stock_h`.`area_id` = `tbl_mst_area`.`id`', 'INNER');
        $this->db->join('`tbl_mst_territory`','`trans_stock_h`.`territory_id` = `tbl_mst_territory`.`id`', 'INNER');
        $this->db->where('`trans_stock_h`.`id`',$invNum);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;

    }
    
    function getStockDetail($rangeId= null,$rangeName= null,$areaID= null,$territoryID= null,$fromDate= null,$toDate= null){

        $this->db->select('`trans_stock_h`.`stock_in_date`,`trans_stock_h`.`range_name`,`trans_stock_h`.`net_total`, `trans_stock_h`.`comments`,`trans_stock_h`.`id`');
        $this->db->from('`trans_stock_h`');
        $this->db->where('`trans_stock_h`.`stock_in_date` <=', $fromDate);
        $this->db->where('`trans_stock_h`.`stock_in_date` >=', $toDate);
        $this->db->where('`trans_stock_h`.`range_id`', $rangeId);
        $this->db->where('`trans_stock_h`.`area_id`', $areaID);
        $this->db->where('`trans_stock_h`.`territory_id`', $territoryID);
        $this->db->order_by('`trans_stock_h`.`id` DESC');  
        $query = $this->db->get();
        
            $result = $query->result_array();
        return $result;
    }
    //ITEM LIST PRICES
    function getItemPrice($id = null, $range_id = null) {
        /* $this->db->select('`sales_operations_item`.`erp_code`, `sales_operations_item`.`erp_fmcode`, `sales_operations_item`.`item_name`, `sales_operations_item`.`category_code`, `sales_operations_item`.`structure_code`, `sales_operations_item`.`isact`, `sales_operations_item`.`isdel`,`price_list_code`, `base_price`, `base_unit`, `valid_from`, `valid_to`');
          $this->db->from('`sales_operations_item`');
          $this->db->join('`sales_operations_item_price`', '`sales_operations_item`.`erp_code`=`sales_operations_item_price`.`erp_code`', 'LEFT');
          if (!is_null($id)) {
          $this->db->where('`sales_operations_item`.`erp_code`', $id);
          }
          $this->db->where('`sales_operations_item`.`isdel`', 0);
          $this->db->where('`sales_operations_item_price`.`price_list_code` IS NOT NULL');
          $this->db->order_by('`sales_operations_item`.`erp_code` ASC'); */
        $this->db->select('tbl_mst_item.item,tbl_mst_item.description,tbl_mst_item_price.date_start, tbl_mst_item_price.wholesale_price,tbl_mst_item_price.uom');
        $this->db->from('`tbl_mst_item_price`');
        $this->db->join('`tbl_mst_item`', '`tbl_mst_item_price`.`item`=`tbl_mst_item`.`item`', 'INNER');
        if (!empty($range_id) && isset($range_id) && !is_null($range_id) && $range_id!='-1') {
            $this->db->where('`tbl_mst_item_price`.`range_id`', $range_id);
        }
        $this->db->order_by('`tbl_mst_item`.`description` ASC');  
        $query = $this->db->get();
        if (!is_null($id)) {
            $result = $query->row();
        } else {
            $result = $query->result_array();
        }
        //echo $this->db->last_query();
        return $result;
    }

    function getMstItems($range_id = null){
        $this->db->select('`item_mst`.`item`,`item_mst`.`des`,`item_mst`.`uom`,`item_mst`.`unit_price`');
        $this->db->from('`item_mst`');
        $this->db->join('`tbl_mst_range_item`','`item_mst`.`item`=`tbl_mst_range_item`.`item`','INNER');
        $this->db->where('`tbl_mst_range_item`.`range_name`',$range_id);
        $query = $this->db->get();
        
            $result = $query->result_array();
        
        //echo $this->db->last_query();
        return $result;

    }

}

?>