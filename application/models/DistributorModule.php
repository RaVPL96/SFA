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
        $this->db->order_by('`agency_name`');
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

    //STOCK RECAL LAST PROCESS TIME LOG
    function getAgencyStocktoRecal() {
        $this->db->select('`ad_code`, `refer_code`, `range_name`, `stock_date`, `last_process_time`, `is_processed`');
        $this->db->from('tbl_trans_distributor_warehouse_stock_process_log');
        $this->db->where(array(
            'is_processed' => 0
        ));
        $this->db->limit(1);
        $this->db->order_by('refer_code');
        $querys = $this->db->get();
        $results = $querys->row();
        if (!empty($results) && isset($results)) {// we have a agency to recal stock - call stock re calculation
            $this->recalStockLevel($results->ad_code);
            echo 'Done-' . $results->ad_code;
        } else {//no agency to stock recal - recreate recal process table
            $this->createRecalTable();
            echo 'Stock Recal Table re-created';
        }
    }

    //
    //
    //RECREATE STOCK RECAL PROCESS TABLE LOG
    function createRecalTable() {
        $this->db->select('ag_cd,cd,st_no, max(st_date) as st_date');
        $this->db->from('stock_h');
        $this->db->where(array(
            'st_date>=' => '2022-09-20',
            'post' => 'P'
        ));
        $this->db->group_by('ag_cd,cd');
        $query = $this->db->get();
        $result = $query->result_array();
        foreach ($result as $a) {
            //check stock process log table is updated or not
            $this->db->select('`ad_code`, `refer_code`, `range_name`, `stock_date`, `last_process_time`, `is_processed`');
            $this->db->from('tbl_trans_distributor_warehouse_stock_process_log');
            $this->db->where(array(
                'range_name' => $a['cd'],
                'ad_code' => $a['ag_cd']
            ));
            $this->db->limit(1);
            $querys = $this->db->get();
            $results = $querys->row();
            if (!empty($results) && isset($results) && $results->refer_code == $a['ag_cd'] . '_' . $a['cd']) {
                $this->db->where('refer_code', $a['ag_cd'] . '_' . $a['cd']);
                $this->db->update('tbl_trans_distributor_warehouse_stock_process_log', array('`is_processed`' => 0));
            } else {//insert as new
                $arrIn = array(
                    '`refer_code`' => $a['ag_cd'] . '_' . $a['cd'],
                    '`ad_code`' => $a['ag_cd'],
                    '`range_name`' => $a['cd'],
                    '`stock_date`' => $a['st_date'],
                    '`last_process_time`' => '0000-00-00 00:00:00',
                    '`is_processed`' => 0
                );
                $this->db->insert('tbl_trans_distributor_warehouse_stock_process_log', $arrIn);
            }
        }
    }

    //
    //STOCK RECAL PROCESS
    function recalStockLevel($ag_cd) {
        //GET AGENCY WITH LATEST STOCK DETAIL ENTRED LIST 
        $this->db->select('ag_cd,cd,st_no, max(st_date) as st_date');
        $this->db->from('stock_h');
        $this->db->where(array(
            'st_date>=' => '2022-07-25',
            'post' => 'P',
            'ag_cd' => $ag_cd
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
            $stock_date = $r['st_date'];

            $this->db->select('item,range_name');
            $this->db->from('`tbl_mst_range_item`');
            $this->db->where('range_name', $range_code);
            $queryItems = $this->db->get();
            $resultItems = $queryItems->result_array();
            foreach ($resultLoc as $L) {
                if ($r['ag_cd'] == $L['agency_code']) {
                    $location_id = $L['location_id'];
                }
            }
            //NOW WE FOUND STOCK LOCATION ID
            //01.GET RANGE AND ITS ITEM CLEAR HISTORY IN tbl_trans_distributor_warehouse_stock,tbl_trans_distributor_warehouse_stock_log
            if ($location_id != 0) {
                //DELETE AND RESET
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
                //INSERT STOCK OPENING DATA
                foreach ($dataStocks as $s) {
                    $arrIn = array(
                        '`distributor_id`' => 0,
                        '`location_code`' => $location_id,
                        '`item`' => $s['item'],
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
                //NOW ADD INVOICE DATA
                //GET SELLING DATA AFTER STOCK TAKING -PRICE WISE
                $this->db->select('invd.item,invd.up,
SUM(invd.a_Qty) AS a_Qty,
SUM(invd.f_qty) AS f_qty,
SUM(invd.g_qty) AS g_qty,
SUM(invd.grf_qty) AS grf_qty,
SUM(invd.m_qty) AS m_qty,
SUM(invd.mrf_qty) AS mrf_qty');
                $this->db->from('invh');
                $this->db->join('invd', 'invh.invno=invd.invno ', 'INNER');
                $this->db->where(array(
                    'invh.d !=' => 'M',
                    'invh.b_a' => 'A',
                    'invh.tot_a_val<>' => 0,
                    'invh.cd' => $range_code,
                    'invh.ag_cd' => $r['ag_cd'],
                    'invh.date_actual>' => $r['st_date']//after stock taking date all sales except company direct
                ));
                $this->db->group_by('invh.ag_cd,invh.cd,invd.item,invd.up');
                $sellQuery = $this->db->get();
                $sellResult = $sellQuery->result_array();
                //echo $this->db->last_query();
                if (!empty($sellResult) && isset($sellResult)) {
                    foreach ($sellResult as $t) {
                        //CHECK STOCK RECORD AVAILABLE IN THE STOCK TABLE
                        $this->db->select('`id`, `distributor_id`, `location_code`, `item`, `stock_post_date`, `unit_price`, `op_sellable`, `op_damage`, `invoice_a_qty`, `invoice_f_qty`, `invoice_g_qty`, `invoice_g_free_qty`, `invoice_m_qty`, `invoice_m_free_qty`, `good_return_qty`, `market_return_qty`, `head_office_inv_qty`, `head_office_inv_qty_pending_accept');
                        $this->db->from('tbl_trans_distributor_warehouse_stock');
                        $whereArr = array(
                            'location_code' => $location_id,
                            'item' => $t['item'],
                            'unit_price' => $t['up']
                        );
                        $this->db->where($whereArr);
                        $this->db->limit(1);
                        $Q = $this->db->get();
                        $QResult = $Q->row();
                        if (!empty($QResult) && isset($QResult)) {//record fund so update
                            $updateArr = array(
                                '`invoice_a_qty`' => $t['a_Qty'],
                                '`invoice_f_qty`' => $t['f_qty'],
                                '`invoice_g_qty`' => $t['g_qty'],
                                '`invoice_g_free_qty`' => $t['grf_qty'],
                                '`invoice_m_qty`' => $t['m_qty'],
                                '`invoice_m_free_qty`' => $t['mrf_qty']
                            );
                            $this->db->where($whereArr);
                            $this->db->update('tbl_trans_distributor_warehouse_stock', $updateArr);
                        } else {
                            //No record in stock table add as a new record
                            $arrIn = array(
                                '`distributor_id`' => 0,
                                '`location_code`' => $location_id,
                                '`item`' => $t['item'],
                                '`unit_price`' => $t['up'],
                                '`op_sellable`' => 0,
                                '`op_damage`' => 0,
                                '`invoice_a_qty`' => $t['a_Qty'],
                                '`invoice_f_qty`' => $t['f_qty'],
                                '`invoice_g_qty`' => $t['g_qty'],
                                '`invoice_g_free_qty`' => $t['grf_qty'],
                                '`invoice_m_qty`' => $t['m_qty'],
                                '`invoice_m_free_qty`' => $t['mrf_qty'],
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
            //UPDATE STOCK PROCESS TABLE AGENCY as processed one

            $this->db->where(array(
                'range_name' => $r['cd'],
                'ad_code' => $r['ag_cd']
            ));
            $this->db->update('tbl_trans_distributor_warehouse_stock_process_log', array('is_processed' => 1,'`last_process_time`' => date('Y-m-d H:i:s')));
        }
    }

}

?>