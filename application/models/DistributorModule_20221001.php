<?php

class DistributorModule extends CI_Model {

    function __construct() {
        parent::__construct();
        //$this->mssql = $this->load->database('MSSQL', TRUE);
    }

    //============================================
    //====DISTRIBUTOR MASTER===================
    //============================================
    //GET DISTRIBUTOR
    function getDistributor($id = null, $company_code = '001') {
        $this->db->select('`id`, `agency_code`, `agency_name`, `address_1`, `address_2`, `address_3`, `address_4`, `city`, `distributor_name`, `telephone_1`, `telephone_2`, `fax_1`, `fax_2`, `is_act`, `is_del`');
        $this->db->from('`tbl_mst_distributor`');
        //$this->db->where('`sales_operations`.`company_code`',$company_code);
        if (!empty($id) && isset($id)) {
            $this->db->where('`id`', $id);
        }
        $query = $this->db->get();
        if (!empty($id) && isset($id)) {
            $result = $query->row();
        } else {
            $result = $query->result_array();
        }
        return $result;
    }

    //SAVE DISTRIBUTOR
    function saveDistributor($data) {
        $IsInserted = 1;
        $data = $data['sop'];
        $id = $data['id'];
        $agency_code = '';
        $agency_name = '';
        $address_1 = '';
        $address_2 = '';
        $address_3 = '';
        $address_4 = '';
        $city = '';
        $distributor_name = '';
        $telephone_1 = '';
        $telephone_2 = '';
        $fax_1 = '';
        $fax_2 = '';

        if (!empty($data['agency_code']) && isset($data['agency_code'])) {
            $agency_code = $data['agency_code'];
        } else {
            $agency_code = '';
        }
        if (!empty($data['agency_name']) && isset($data['agency_name'])) {
            $agency_name = $data['agency_name'];
        } else {
            $agency_name = '';
        }
        if (!empty($data['address_1']) && isset($data['address_1'])) {
            $address_1 = $data['address_1'];
        } else {
            $address_1 = '';
        }
        if (!empty($data['address_2']) && isset($data['address_2'])) {
            $address_2 = $data['address_2'];
        } else {
            $address_2 = '';
        }
        if (!empty($data['address_3']) && isset($data['address_3'])) {
            $address_3 = $data['address_3'];
        } else {
            $address_3 = '';
        }
        if (!empty($data['address_4']) && isset($data['address_4'])) {
            $address_4 = $data['address_4'];
        } else {
            $address_4 = '';
        }
        if (!empty($data['city']) && isset($data['city'])) {
            $city = $data['city'];
        } else {
            $city = '';
        }
        if (!empty($data['distributor_name']) && isset($data['distributor_name'])) {
            $distributor_name = $data['distributor_name'];
        } else {
            $distributor_name = '';
        }
        if (!empty($data['telephone_1']) && isset($data['telephone_1'])) {
            $telephone_1 = $data['telephone_1'];
        } else {
            $telephone_1 = '';
        }
        if (!empty($data['telephone_2']) && isset($data['telephone_2'])) {
            $telephone_2 = $data['telephone_2'];
        } else {
            $telephone_2 = '';
        }
        if (!empty($data['fax_1']) && isset($data['fax_1'])) {
            $fax_1 = $data['fax_1'];
        } else {
            $fax_1 = '';
        }
        if (!empty($data['fax_2']) && isset($data['fax_2'])) {
            $fax_2 = $data['fax_2'];
        } else {
            $fax_2 = '';
        }


        $act = 1;

        if (!empty($data['isact']) && isset($data['isact'])) {
            $act = $data['isact'];
        } else {
            $act = 0;
        }
        $del = 0;
        if (!empty($data['isdel']) && isset($data['isdel'])) {
            $del = $data['isdel'];
        } else {
            $del = 0;
        }
        $arrIn = array(
            '`agency_code`' => $agency_code,
            '`agency_name`' => $agency_name,
            '`address_1`' => $address_1,
            '`address_2`' => $address_2,
            '`address_3`' => $address_3,
            '`address_4`' => $address_4,
            '`city`' => $city,
            '`distributor_name`' => $distributor_name,
            '`telephone_1`' => $telephone_1,
            '`telephone_2`' => $telephone_2,
            '`fax_1`' => $fax_1,
            '`fax_2`' => $fax_2,
            '`is_act`' => $act,
            '`is_del`' => $del
        );
        $this->db->trans_begin();
        if ($id == 'new') {
            $this->db->insert('`tbl_mst_distributor`', $arrIn);
            if ($this->db->trans_status() === FALSE) {
                $IsInserted = 0;
            }
        } else {//update record
            $this->db->where('`id`', $id);
            $this->db->update('`tbl_mst_distributor`', $arrIn);
            if ($this->db->trans_status() === FALSE) {
                $IsInserted = 0;
            }
        }
        //die();
        if ($IsInserted == 1) {
            $this->db->trans_commit();
        } else {
            $this->db->trans_rollback();
        }
        //die();
        return $IsInserted;
    }

    //GET DISTRIBUTOR WAREHOUSE
    function getDistributorWarehouse($id = null, $company_code = '001', $distributor_id = null) {
        $this->db->select(' `tbl_mst_distributor_warehouse`.`id`, `distributor_id`, `location_code`, `latitude`, `longitude`, `location_name`, `tbl_mst_distributor`.`id` AS `d_id`,`tbl_mst_distributor`.`agency_code` AS `agency_code`,`tbl_mst_distributor`.`agency_name`,`tbl_mst_distributor_warehouse`.`is_act`, `tbl_mst_distributor_warehouse`.`is_del`');
        $this->db->from('`tbl_mst_distributor_warehouse`');
        $this->db->join('`tbl_mst_distributor`', '`tbl_mst_distributor_warehouse`.`distributor_id`=`tbl_mst_distributor`.`id`', 'INNER');
        //$this->db->where('`sales_operations`.`company_code`',$company_code);
        if (!empty($id) && isset($id)) {
            $this->db->where('`tbl_mst_distributor_warehouse`.`id`', $id);
        }
        if (!empty($distributor_id) && isset($distributor_id)) {
            $this->db->where('`tbl_mst_distributor_warehouse`.`distributor_id`', $distributor_id);
        }
        $query = $this->db->get();
        if (!empty($id) && isset($id)) {
            $result = $query->row();
        } else {
            $result = $query->result_array();
        }
        return $result;
    }

    //SAVE DISTRIBUTOR WAREHOUSE
    function saveDistributorWarehouse($data) {
        $data = $data['sop'];
        $act = 1;
        $agency_warehouse_code = '';
        $agency_warehouse_name = '';
        $distributor_id = '';
        $del = 0;
        $IsInserted = 1;
        $agency_warehouse_id = $data['agency_warehouse_id'];


        $wharehouse_name_lat = 0;
        $wharehouse_name_long = 0;

        if (!empty($data['distributor_id']) && isset($data['distributor_id'])) {
            $distributor_id = $data['distributor_id'];
        } else {
            $distributor_id = '';
            $IsInserted = 0;
        }
        if (!empty($data['agency_warehouse_name']) && isset($data['agency_warehouse_name'])) {
            $agency_warehouse_name = $data['agency_warehouse_name'];
        } else {
            $agency_warehouse_name = '';
        }
        if (!empty($data['agency_warehouse_code']) && isset($data['agency_warehouse_code'])) {
            $agency_warehouse_code = $data['agency_warehouse_code'];
        } else {
            $agency_warehouse_code = '';
        }

        if (!empty($data['agency_warehouse_isact']) && isset($data['agency_warehouse_isact'])) {
            $act = $data['agency_warehouse_isact'];
        } else {
            $act = 0;
        }
        if (!empty($data['agency_warehouse_isdel']) && isset($data['agency_warehouse_isdel'])) {
            $del = $data['agency_warehouse_isdel'];
        } else {
            $del = 0;
        }

        if (!empty($data['agency_warehouse_lat']) && isset($data['agency_warehouse_lat'])) {
            $wharehouse_name_lat = $data['agency_warehouse_lat'];
        }
        if (!empty($data['agency_warehouse_long']) && isset($data['agency_warehouse_long'])) {
            $wharehouse_name_long = $data['agency_warehouse_long'];
        }

        $this->db->trans_begin();
        if ($agency_warehouse_id == 'new') {
            $arrIn = array(
                '`distributor_id`' => $distributor_id,
                '`location_code`' => $agency_warehouse_code,
                '`location_name`' => $agency_warehouse_name,
                '`longitude`' => $wharehouse_name_long,
                '`latitude`' => $wharehouse_name_lat,
                '`is_act`' => $act,
                '`is_del`' => $del
            );
            $this->db->insert('`tbl_mst_distributor_warehouse`', $arrIn);
        } else {//update record
            $arrIn = array(
                //'`distributor_id`'=>$distributor_id,
                //'`location_code`'=>$agency_warehouse_code,
                '`location_name`' => $agency_warehouse_name,
                '`longitude`' => $wharehouse_name_long,
                '`latitude`' => $wharehouse_name_lat,
                '`is_act`' => $act,
                '`is_del`' => $del
            );
            $this->db->where('`id`', $agency_warehouse_id);
            $this->db->update('`tbl_mst_distributor_warehouse`', $arrIn);
        }
        if ($this->db->trans_status() === FALSE) {
            $IsInserted = 0;
        }

        //echo $this->db->last_query();
        //die();
        if ($IsInserted == 1) {
            $this->db->trans_commit();
        } else {
            $this->db->trans_rollback();
        }
        return $IsInserted;
    }

    //GET DISTRIBUTOR WAREHOUSE ERP COMPANY LINK FOR INVOICES IN
    function getDistributorWarehouseERPLink($id = null, $company_code = '001', $distributor_id = null) {
        $this->db->select(' `tbl_mst_distributor_warehouse`.`id`, `distributor_id`, `location_code`, `location_name`, `tbl_mst_distributor`.`id` AS `d_id`,`tbl_mst_distributor`.`agency_code` AS `agency_code`,`tbl_mst_distributor`.`agency_name`,`tbl_mst_distributor_warehouse`.`is_act`, `tbl_mst_distributor_warehouse`.`is_del`,`ic_locations`.`code`,`ic_locations`.`name`,`tbl_mst_distributor_warehouse_erp_sell_points`.`erp_customer_code`,`tbl_mst_distributor_warehouse_erp_sell_points`.`erp_customer_shipto_code`,`tbl_mst_distributor_warehouse_erp_sell_points`.`id` AS `d_erp_link_id`,`tbl_mst_distributor_warehouse_erp_sell_points`.`distributor_warehouse_id`,`tbl_mst_distributor_warehouse_erp_sell_points`.`erp_company_id`');
        $this->db->from('`tbl_mst_distributor_warehouse_erp_sell_points`');
        $this->db->join('`tbl_mst_distributor_warehouse`', '`tbl_mst_distributor_warehouse_erp_sell_points`.`distributor_warehouse_id`=`tbl_mst_distributor_warehouse`.`id`', 'INNER');
        $this->db->join('`tbl_mst_distributor`', '`tbl_mst_distributor_warehouse`.`distributor_id`=`tbl_mst_distributor`.`id`', 'INNER');
        $this->db->join('`ic_locations`', '`tbl_mst_distributor_warehouse_erp_sell_points`.`erp_company_id`=`ic_locations`.`id`', 'INNER');
        //$this->db->where('`sales_operations`.`company_code`',$company_code);
        if (!empty($id) && isset($id)) {
            $this->db->where('`tbl_mst_distributor_warehouse`.`id`', $id);
        }
        if (!empty($distributor_id) && isset($distributor_id)) {
            $this->db->where('`tbl_mst_distributor_warehouse`.`distributor_id`', $distributor_id);
        }
        $query = $this->db->get();
        if (!empty($id) && isset($id)) {
            $result = $query->row();
        } else {
            $result = $query->result_array();
        }
        return $result;
    }

    //SAVE DISTRIBUTOR WAREHOUSE ERP COMPANY LINK FOR INVOICES IN
    function saveDistributorErpMap($data) {
        $data = $data['sop'];
        $act = 1;
        $agency_warehouse_id = '';
        $erp_id = '';
        $agency_warehouse_erp_code = '';
        $agency_warehouse_erp_shipto_code = '';
        $del = 0;
        $IsInserted = 1;
        $agency_warehouse_erp_id = '';
        if (!empty($data['id']) && isset($data['id'])) {
            $agency_warehouse_erp_id = $data['id'];
        } else {
            $agency_warehouse_erp_id = 'new';
            //$IsInserted=0;
        }

        if (!empty($data['agency_warehouse_id']) && isset($data['agency_warehouse_id'])) {
            $agency_warehouse_id = $data['agency_warehouse_id'];
        } else {
            $agency_warehouse_id = '';
            $IsInserted = 0;
        }

        if (!empty($data['erp_id']) && isset($data['erp_id'])) {
            $erp_id = $data['erp_id'];
        } else {
            $erp_id = '';
            $IsInserted = 0;
        }

        if (!empty($data['agency_warehouse_erp_code']) && isset($data['agency_warehouse_erp_code'])) {
            $agency_warehouse_erp_code = $data['agency_warehouse_erp_code'];
        } else {
            $agency_warehouse_erp_code = '';
            $IsInserted = 0;
        }

        if (!empty($data['agency_warehouse_erp_shipto_code']) && isset($data['agency_warehouse_erp_shipto_code'])) {
            $agency_warehouse_erp_shipto_code = $data['agency_warehouse_erp_shipto_code'];
        } else {
            $agency_warehouse_erp_shipto_code = '';
            $IsInserted = 0;
        }



        if (!empty($data['isact']) && isset($data['isact'])) {
            $act = $data['isact'];
        } else {
            $act = 0;
        }
        if (!empty($data['isdel']) && isset($data['isdel'])) {
            $del = $data['isdel'];
        } else {
            $del = 0;
        }


        $this->db->trans_begin();
        if ($agency_warehouse_erp_id == 'new') {
            $arrIn = array(
                '`distributor_warehouse_id`' => $agency_warehouse_id,
                '`erp_company_id`' => $erp_id,
                '`erp_customer_code`' => $agency_warehouse_erp_code,
                '`erp_customer_shipto_code`' => $agency_warehouse_erp_shipto_code,
                '`is_act`' => $act,
                '`is_del`' => $del
            );
            $this->db->insert('`tbl_mst_distributor_warehouse_erp_sell_points`', $arrIn);
        } else {//update record
            $arrIn = array(
                //'`distributor_id`'=>$distributor_id,
                //'`location_code`'=>$agency_warehouse_code,
                '`erp_company_id`' => $erp_id,
                '`erp_customer_code`' => $agency_warehouse_erp_code,
                '`erp_customer_shipto_code`' => $agency_warehouse_erp_shipto_code,
                '`is_act`' => $act,
                '`is_del`' => $del
            );
            $this->db->where('`id`', $agency_warehouse_erp_id);
            $this->db->update('`tbl_mst_distributor_warehouse_erp_sell_points`', $arrIn);
        }
        if ($this->db->trans_status() === FALSE) {
            $IsInserted = 0;
        }
        if ($IsInserted == 1) {
            $this->db->trans_commit();
        } else {
            $this->db->trans_rollback();
        }
        //die();
        return $IsInserted;
    }

    //STOCK RECAL PROCESS
    function recalStockLevel() {
        //GET AGENCY WITH LATEST STOCK DETAIL ENTRED LIST 
        $this->db->select('ag_cd,cd,st_no, max(st_date) as st_date');
        $this->db->from('stock_h');
        $this->db->where(array(
            'st_date>=' => '2022-07-25',
            'post' => 'P'
        ));
        $this->db->group_by('ag_cd,cd');
        $query = $this->db->get();
        $result = $query->result_array();

        //GET LOCATION CODE FOR RELAVENT AGENCY
        $this->db->select('tbl_mst_distributor.id,tbl_mst_distributor.agency_code,tbl_mst_distributor_warehouse.id AS location_id');
        $this->db->from('`tbl_mst_distributor`');
        $this->db->join('tbl_mst_distributor_warehouse', 'tbl_mst_distributor.id=tbl_mst_distributor_warehouse.distributor_id', 'INNER');
        $this->db->order_by('agency_code', 'ASC');
        $queryLoc = $this->db->get();
        $resultLoc = $queryLoc->result_array();


        foreach ($result as $r) {
            $location_id = 0;

            //GET RANGE ITEMS
            $range_code = $r['cd']; //range code C or D
            $this->db->select('item,range_name');
            $this->db->from('`tbl_mst_range_item`');
            $this->db->where('range_name', $range_code);
            $queryItems = $this->db->get();
            $resultItems = $queryItems->result_array();
            foreach ($resultLoc as $L) {
                if ($r['ag_cd'] == $L['agency_code']) {
                    echo $location_id = $L['location_id'];
                }
            }
            //NOW WE FOUND STOCK LOCATION ID
            //01.GET RANGE AND ITS ITEM CLEAR HISTORY IN tbl_trans_distributor_warehouse_stock,tbl_trans_distributor_warehouse_stock_log
            if ($location_id != 0) {

                foreach ($resultItems as $I) {//DELETE ITEM FROM STOCK
                    $this->db->where(array(
                        'location_code' => $location_id,
                        'item' => $I['item']
                    ));
                    $this->db->delete('tbl_trans_distributor_warehouse_stock');
                }
                //GET LAST STOCK ITEM DATA
                $this->db->select('stock_d.item,stock_d.up,stock_d.sellable,stock_d.damage');
                $this->db->from('stock_h');
                $this->db->join('stock_d', 'stock_h.st_no=stock_d.st_no', 'INNER');
                $this->db->where('stock_h.st_no', $r['st_no']);
                $QueryStockItems = $this->db->get();
                $dataStocks = $QueryStockItems->result_array();
                //INSERT STOCK DATA
                foreach ($dataStocks as $s) {
                    $arrIn = array(
                        '`distributor_id`' => 0,
                        '`location_code`' => $location_id,
                        '`item`' => $I['item'],
                        '`stock_post_date`' => $r['st_date'],
                        '`unit_price`' => $s['up'],
                        '`op_sellable`' => $s['sellable'],
                        '`op_damage`' => $s['damage'],
                        '`invoice_a_qty`' => 0,
                        '`invoice_f_qty`' => 0,
                        '`invoice_g_qty`' => 0,
                        '`invoice_g_free_qty`' => 0,
                        '`invoice_m_qty`' => 0,
                        '`invoice_m_free_qty`' => 0,
                        '`good_return_qty`' => 0,
                        '`market_return_qty`' => 0,
                        '`head_office_inv_qty`' => 0,
                        '`head_office_inv_qty_pending_accept`' => 0
                    );
                    $this->db->insert('tbl_trans_distributor_warehouse_stock', $arrIn);
                }
            }
        }
    }

}

?>