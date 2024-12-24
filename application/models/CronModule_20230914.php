<?php

/*
 * This system Licenced to Raigam Marketing Services (Pvt) Ltd. 
 * Developed By: Lakshitha Pradeep Karunarathna  * 
 * Company: Serving Cloud INC in association with MyOffers.lk  * 
 * Date Started:  October 20, 2017  * 
 */

class CronModule extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        //$this->load->model('AuditModule');
    }

    //update warehouse stock with agency opening stock
    function updateOpeningStock($ag_cd, $date_posted, $range_name) {//old agency code,applicable date
        $IsInserted = 1;
        $sql = "DELETE tbl_trans_distributor_warehouse_stock FROM `tbl_trans_distributor_warehouse_stock` "
                . "INNER JOIN `tbl_mst_range_item` ON `tbl_trans_distributor_warehouse_stock`.`item`=`tbl_mst_range_item`.`item` "
                . "INNER JOIN `tbl_mst_distributor_warehouse` ON `tbl_trans_distributor_warehouse_stock`.`location_code`=`tbl_mst_distributor_warehouse`.`id` "
                . "INNER JOIN `tbl_mst_distributor` ON `tbl_mst_distributor_warehouse`.`distributor_id`=`tbl_mst_distributor`.`id` "
                . "WHERE `tbl_mst_distributor`.`agency_code`=$ag_cd AND `tbl_mst_range_item`.`range_name`='$range_name'";
        $this->db->query($sql);
        /*
         * $this->db->select();
          $this->db->from('`tbl_mst_range_item`');
          $this->db->where('range_name', $range_name);
          $q = $this->db->get();
          $r = $q->result_array();
          foreach ($r as $k) {
          $sql = "DELETE tbl_trans_distributor_warehouse_stock FROM `tbl_trans_distributor_warehouse_stock` "
          . "INNER JOIN `tbl_mst_range_item` ON `tbl_trans_distributor_warehouse_stock`.`item`=`tbl_mst_range_item`.`item` "
          . "INNER JOIN `tbl_mst_distributor_warehouse` ON `tbl_trans_distributor_warehouse_stock`.`location_code`=`tbl_mst_distributor_warehouse`.`id` "
          . "INNER JOIN `tbl_mst_distributor` ON `tbl_mst_distributor_warehouse`.`distributor_id`=`tbl_mst_distributor`.`id` "
          . "WHERE `tbl_mst_distributor`.`agency_code`=$ag_cd AND `tbl_mst_range_item`.`range_name`='$range_name'";
          $this->db->query($sql);
          } */

        $this->db->select('`tbl_mst_distributor_warehouse`.`id` AS `stock_location_id`,`stock_d`.`item`,`stock_h`.`st_date`,`stock_d`.`up`,`stock_d`.`sellable`,`stock_d`.`damage`');
        $this->db->from('`tbl_mst_distributor_warehouse`');
        $this->db->join('`tbl_mst_distributor`', '`tbl_mst_distributor_warehouse`.`distributor_id`=`tbl_mst_distributor`.`id`', 'INNER');
        $this->db->join('`stock_h`', '`tbl_mst_distributor`.`agency_code`=`stock_h`.`ag_cd`', 'INNER');
        $this->db->join('`stock_d`', '`stock_h`.`st_no`=`stock_d`.`st_no`', 'INNER');
        $this->db->where(array(
            '`tbl_mst_distributor`.`agency_code`' => $ag_cd,
            '`tbl_mst_distributor`.`is_act`' => 1,
            '`stock_h`.`st_date`' => $date_posted,
            '`stock_h`.`post`' => 'P',
            '`stock_h`.`cd`' => $range_name
        ));
        $query = $this->db->get();
        $result = $query->result_array();
        $this->db->trans_begin();
        if (!empty($result) && isset($result)) {
            foreach ($result as $r) {
                //get stock record for the item in warehouse
                $this->db->select('`id`, `distributor_id`, `location_code`, `item`, `stock_post_date`, `unit_price`, `op_sellable`, `op_damage`, `invoice_a_qty`, `invoice_f_qty`, `invoice_g_qty`, `invoice_g_free_qty`, `invoice_m_qty`, `invoice_m_free_qty`, `good_return_qty`, `market_return_qty`, `head_office_inv_qty`, `head_office_inv_qty_pending_accept`');
                $this->db->from('`tbl_trans_distributor_warehouse_stock`');
                $this->db->where('`location_code`', $r['stock_location_id']);
                $this->db->where('`item`', $r['item']);
                $this->db->where('`unit_price`', $r['up']);
                $queryN = $this->db->get();
                $resultN = $queryN->row();
                if (!empty($resultN) && isset($resultN)) {//records have need to update
                    $arrUpdate = array(
                        '`op_sellable`' => $r['sellable'],
                        '`op_damage`' => $r['damage'],
                        '`invoice_a_qty`' => 0,
                        '`invoice_f_qty`' => 0,
                        '`invoice_g_qty`' => 0,
                        '`invoice_g_free_qty`' => 0,
                        '`invoice_m_qty`' => 0,
                        '`invoice_m_free_qty`' => 0,
                        '`good_return_qty`' => 0,
                        '`market_return_qty`' => 0,
                        '`head_office_inv_qty`' => 0,
                        '`head_office_inv_qty_pending_accept`' => 0,
                    );
                    $this->db->where('`location_code`', $r['stock_location_id']);
                    $this->db->where('`item`', $r['item']);
                    $this->db->where('`unit_price`', $r['up']);
                    $this->db->update('`tbl_trans_distributor_warehouse_stock`', $arrUpdate);
                    if ($this->db->trans_status() === FALSE) {
                        $IsInserted = 0;
                    }
                } else {//no records have need to add as a new record
                    $arrIn = array(
                        '`location_code`' => $r['stock_location_id'],
                        '`item`' => $r['item'],
                        '`unit_price`' => $r['up'],
                        '`op_sellable`' => $r['sellable'],
                        '`op_damage`' => $r['damage'],
                        '`invoice_a_qty`' => 0,
                        '`invoice_f_qty`' => 0,
                        '`invoice_g_qty`' => 0,
                        '`invoice_g_free_qty`' => 0,
                        '`invoice_m_qty`' => 0,
                        '`invoice_m_free_qty`' => 0,
                        '`good_return_qty`' => 0,
                        '`market_return_qty`' => 0,
                        '`head_office_inv_qty`' => 0,
                        '`head_office_inv_qty_pending_accept`' => 0,
                    );
                    $this->db->insert('`tbl_trans_distributor_warehouse_stock`', $arrIn);
                    if ($this->db->trans_status() === FALSE) {
                        $IsInserted = 0;
                    }
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

    //update good return send to head office
    function updateGoodReturn($ag_cd, $date_posted) {
        $IsInserted = 1;
        //get good return posted after stock taking
        $this->db->select('`tbl_mst_distributor_warehouse`.`id` AS `stock_location_id`,`return_d`.`item_code` as `item`,`return_d`.`unit_price`,sum(`return_d`.`return_qty`) AS return_qty');
        $this->db->from('`tbl_mst_distributor_warehouse`');
        $this->db->join('`tbl_mst_distributor`', '`tbl_mst_distributor_warehouse`.`distributor_id`=`tbl_mst_distributor`.`id`', 'INNER');
        $this->db->join('`return_h`', '`tbl_mst_distributor`.`agency_code`=`return_h`.`ag_cd`', 'INNER');
        $this->db->join('`return_d`', '`return_h`.`return_no`=`return_d`.`return_no`', 'INNER');
        $this->db->where(array(
            '`tbl_mst_distributor`.`agency_code`' => $ag_cd,
            '`tbl_mst_distributor`.`is_act`' => 1,
            '`return_h`.`return_type`' => 'G',
            '`return_h`.`return_date`>' => $date_posted,
            '`return_h`.`active`' => 1
        ));
        $this->db->group_by('`tbl_mst_distributor_warehouse`.`id`,`return_d`.`item_code`,`return_d`.`unit_price`');
        $query = $this->db->get();
        $result = $query->result_array();
        $this->db->trans_begin();
        if (!empty($result) && isset($result)) {
            foreach ($result as $r) {
                //get stock record for the item in warehouse
                $this->db->select('`id`, `distributor_id`, `location_code`, `item`, `stock_post_date`, `unit_price`, `op_sellable`, `op_damage`, `invoice_a_qty`, `invoice_f_qty`, `invoice_g_qty`, `invoice_g_free_qty`, `invoice_m_qty`, `invoice_m_free_qty`, `good_return_qty`, `market_return_qty`, `head_office_inv_qty`, `head_office_inv_qty_pending_accept`');
                $this->db->from('`tbl_trans_distributor_warehouse_stock`');
                $this->db->where('`location_code`', $r['stock_location_id']);
                $this->db->where('`item`', $r['item']);
                $this->db->where('`unit_price`', $r['unit_price']);
                $queryN = $this->db->get();
                $resultN = $queryN->row();
                if (!empty($resultN) && isset($resultN)) {//records have need to update
                    $arrUpdate = array(
                        '`good_return_qty`' => $r['return_qty']
                    );
                    $this->db->where('`location_code`', $r['stock_location_id']);
                    $this->db->where('`item`', $r['item']);
                    $this->db->where('`unit_price`', $r['unit_price']);
                    $this->db->update('`tbl_trans_distributor_warehouse_stock`', $arrUpdate);
                    if ($this->db->trans_status() === FALSE) {
                        $IsInserted = 0;
                    }
                } else {//no records have need to add as a new record
                    $arrIn = array(
                        '`location_code`' => $r['stock_location_id'],
                        '`item`' => $r['item'],
                        '`unit_price`' => $r['unit_price'],
                        '`op_sellable`' => 0,
                        '`op_damage`' => 0,
                        '`invoice_a_qty`' => 0,
                        '`invoice_f_qty`' => 0,
                        '`invoice_g_qty`' => 0,
                        '`invoice_g_free_qty`' => 0,
                        '`invoice_m_qty`' => 0,
                        '`invoice_m_free_qty`' => 0,
                        '`good_return_qty`' => $r['return_qty']
                    );
                    $this->db->insert('`tbl_trans_distributor_warehouse_stock`', $arrIn);
                    if ($this->db->trans_status() === FALSE) {
                        $IsInserted = 0;
                    }
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

    //update good return send to head office
    function updateMarketReturn($ag_cd, $date_posted) {
        $IsInserted = 1;
        //get good return posted after stock taking
        $this->db->select('`tbl_mst_distributor_warehouse`.`id` AS `stock_location_id`,`return_d_new`.`item_code` as `item`,`return_d_new`.`unit_price`,SUM(`return_d_new`.`return_qty`) as `return_qty`');
        $this->db->from('`tbl_mst_distributor_warehouse`');
        $this->db->join('`tbl_mst_distributor`', '`tbl_mst_distributor_warehouse`.`distributor_id`=`tbl_mst_distributor`.`id`', 'INNER');
        $this->db->join('`return_h_new`', '`tbl_mst_distributor`.`agency_code`=`return_h_new`.`ag_cd`', 'INNER');
        $this->db->join('`return_d_new`', '`return_h_new`.`return_no`=`return_d_new`.`return_no`', 'INNER');
        $this->db->where(array(
            '`tbl_mst_distributor`.`agency_code`' => $ag_cd,
            '`tbl_mst_distributor`.`is_act`' => 1,
            '`return_h_new`.`return_type`' => 'M',
            '`return_h_new`.`return_date`>' => $date_posted,
            '`return_h_new`.`active`' => 1
        ));
        $this->db->group_by('`tbl_mst_distributor_warehouse`.`id`,`return_d_new`.`item_code`,`return_d_new`.`unit_price`');
        $query = $this->db->get();
        $result = $query->result_array();
        $this->db->trans_begin();
        if (!empty($result) && isset($result)) {
            foreach ($result as $r) {
                //get stock record for the item in warehouse
                $this->db->select('`id`, `distributor_id`, `location_code`, `item`, `stock_post_date`, `unit_price`, `op_sellable`, `op_damage`, `invoice_a_qty`, `invoice_f_qty`, `invoice_g_qty`, `invoice_g_free_qty`, `invoice_m_qty`, `invoice_m_free_qty`, `good_return_qty`, `market_return_qty`, `head_office_inv_qty`, `head_office_inv_qty_pending_accept`');
                $this->db->from('`tbl_trans_distributor_warehouse_stock`');
                $this->db->where('`location_code`', $r['stock_location_id']);
                $this->db->where('`item`', $r['item']);
                $this->db->where('`unit_price`', $r['unit_price']);
                $queryN = $this->db->get();
                $resultN = $queryN->row();
                if (!empty($resultN) && isset($resultN)) {//records have need to update
                    $arrUpdate = array(
                        '`market_return_qty`' => $r['return_qty']
                    );
                    $this->db->where('`location_code`', $r['stock_location_id']);
                    $this->db->where('`item`', $r['item']);
                    $this->db->where('`unit_price`', $r['unit_price']);
                    $this->db->update('`tbl_trans_distributor_warehouse_stock`', $arrUpdate);
                    if ($this->db->trans_status() === FALSE) {
                        $IsInserted = 0;
                    }
                } else {//no records have need to add as a new record
                    $arrIn = array(
                        '`location_code`' => $r['stock_location_id'],
                        '`item`' => $r['item'],
                        '`unit_price`' => $r['unit_price'],
                        '`op_sellable`' => 0,
                        '`op_damage`' => 0,
                        '`invoice_a_qty`' => 0,
                        '`invoice_f_qty`' => 0,
                        '`invoice_g_qty`' => 0,
                        '`invoice_g_free_qty`' => 0,
                        '`invoice_m_qty`' => 0,
                        '`invoice_m_free_qty`' => 0,
                        '`market_return_qty`' => $r['return_qty']
                    );
                    $this->db->insert('`tbl_trans_distributor_warehouse_stock`', $arrIn);
                    if ($this->db->trans_status() === FALSE) {
                        $IsInserted = 0;
                    }
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

    //update current month sale in agency warehouse stock
    function updateSalesStock($ag_cd, $date_posted) {//old agency code,applicable date
        $IsInserted = 1;
        $this->db->select('`tbl_mst_distributor_warehouse`.`id` AS `stock_location_id`,invh.ag_cd,invd.item,invd.up,SUM(invd.a_Qty) AS a_qty, SUM(invd.f_qty) AS f_qty, SUM(invd.g_qty) AS g_qty, SUM(invd.grf_qty) AS gf_qty, SUM(invd.m_qty) AS m_qty, SUM(invd.mrf_qty) AS mf_qty');
        $this->db->from('`tbl_mst_distributor_warehouse`');
        $this->db->join('`tbl_mst_distributor`', '`tbl_mst_distributor_warehouse`.`distributor_id`=`tbl_mst_distributor`.`id`', 'INNER');
        $this->db->join('invh', '`tbl_mst_distributor`.`agency_code`=`invh`.`ag_cd`', 'INNER');
        $this->db->join('invd', '`invh`.`invno`=`invd`.`invno`', 'INNER');
        $this->db->where(array(
            'invh.ag_cd' => $ag_cd,
            'invh.date_actual>' => $date_posted,
            'invh.tot_a_val<>' => 0,
            'invh.b_a' => 'A',
            'invh.d!=' => 'M'
        ));
        $this->db->group_by('invh.ag_cd,invd.item,invd.up');
        $query = $this->db->get();
        $result = $query->result_array();
        $this->db->trans_begin();
        if (!empty($result) && isset($result)) {
            foreach ($result as $r) {
                //get stock record for the item in warehouse
                $this->db->select('`id`, `distributor_id`, `location_code`, `item`, `stock_post_date`, `unit_price`, `op_sellable`, `op_damage`, `invoice_a_qty`, `invoice_f_qty`, `invoice_g_qty`, `invoice_g_free_qty`, `invoice_m_qty`, `invoice_m_free_qty`, `good_return_qty`, `market_return_qty`, `head_office_inv_qty`, `head_office_inv_qty_pending_accept`');
                $this->db->from('`tbl_trans_distributor_warehouse_stock`');
                $this->db->where('`location_code`', $r['stock_location_id']);
                $this->db->where('`item`', $r['item']);
                $this->db->where('`unit_price`', $r['up']);
                $queryN = $this->db->get();
                $resultN = $queryN->row();
                if (!empty($resultN) && isset($resultN)) {//records have need to update
                    $arrUpdate = array(
                        '`invoice_a_qty`' => $r['a_qty'],
                        '`invoice_f_qty`' => $r['f_qty'],
                        '`invoice_g_qty`' => $r['g_qty'],
                        '`invoice_g_free_qty`' => $r['gf_qty'],
                        '`invoice_m_qty`' => $r['m_qty'],
                        '`invoice_m_free_qty`' => $r['mf_qty']
                    );
                    $this->db->where('`location_code`', $r['stock_location_id']);
                    $this->db->where('`item`', $r['item']);
                    $this->db->where('`unit_price`', $r['up']);
                    $this->db->update('`tbl_trans_distributor_warehouse_stock`', $arrUpdate);
                    if ($this->db->trans_status() === FALSE) {
                        $IsInserted = 0;
                    }
                } else {//no records have need to add as a new record
                    $arrIn = array(
                        '`location_code`' => $r['stock_location_id'],
                        '`item`' => $r['item'],
                        '`unit_price`' => $r['up'],
                        '`invoice_a_qty`' => $r['a_qty'],
                        '`invoice_f_qty`' => $r['f_qty'],
                        '`invoice_g_qty`' => $r['g_qty'],
                        '`invoice_g_free_qty`' => $r['gf_qty'],
                        '`invoice_m_qty`' => $r['m_qty'],
                        '`invoice_m_free_qty`' => $r['mf_qty']
                    );
                    $this->db->insert('`tbl_trans_distributor_warehouse_stock`', $arrIn);
                    if ($this->db->trans_status() === FALSE) {
                        $IsInserted = 0;
                    }
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

    //GET COMPANY INVOICE ACCEPTED 
    function updateHeadOfficeInvoiceStock($ag_cd, $date_posted) {
        $IsInserted = 1;
        //get good return posted after stock taking
        $this->db->select('`tbl_mst_distributor_warehouse`.`id` AS `stock_location_id`,`tbl_mst_item_erp_codes`.`item_code` as `item`, `c_incd`.`up` AS `unit_price`,SUM(`c_incd`.`received_qty`) AS received_qty');
        $this->db->from('`tbl_mst_distributor_warehouse`');
        $this->db->join('`tbl_mst_distributor`', '`tbl_mst_distributor_warehouse`.`distributor_id`=`tbl_mst_distributor`.`id`', 'INNER');
        $this->db->join('`c_invh`', '`tbl_mst_distributor`.`agency_code`=`c_invh`.`ag_cd`', 'INNER');
        $this->db->join('`c_incd`', '`c_invh`.`c_invno`=`c_incd`.`c_invno`', 'INNER');
        $this->db->join('`tbl_mst_item_erp_codes`', '`c_incd`.`item_code`=`tbl_mst_item_erp_codes`.`erp_item_code`', 'INNER');
        $this->db->where(array(
            '`tbl_mst_distributor`.`agency_code`' => $ag_cd,
            '`tbl_mst_distributor`.`is_act`' => 1,
            '`c_invh`.`ag_date`>' => $date_posted,
            '`c_invh`.`ag_accept`' => 1
        ));
        $this->db->group_by('`tbl_mst_distributor_warehouse`.`id`,`tbl_mst_item_erp_codes`.`item_code`, `c_incd`.`up`');
        $query = $this->db->get();
        $result = $query->result_array();
        $this->db->trans_begin();
        if (!empty($result) && isset($result)) {
            foreach ($result as $r) {
                //get stock record for the item in warehouse
                $this->db->select('`id`, `distributor_id`, `location_code`, `item`, `stock_post_date`, `unit_price`, `op_sellable`, `op_damage`, `invoice_a_qty`, `invoice_f_qty`, `invoice_g_qty`, `invoice_g_free_qty`, `invoice_m_qty`, `invoice_m_free_qty`, `good_return_qty`, `market_return_qty`, `head_office_inv_qty`, `head_office_inv_qty_pending_accept`');
                $this->db->from('`tbl_trans_distributor_warehouse_stock`');
                $this->db->where('`location_code`', $r['stock_location_id']);
                $this->db->where('`item`', $r['item']);
                $this->db->where('`unit_price`', $r['unit_price']);
                $queryN = $this->db->get();
                $resultN = $queryN->row();
                if (!empty($resultN) && isset($resultN)) {//records have need to update
                    $arrUpdate = array(
                        '`head_office_inv_qty`' => $r['received_qty']
                    );
                    $this->db->where('`location_code`', $r['stock_location_id']);
                    $this->db->where('`item`', $r['item']);
                    $this->db->where('`unit_price`', $r['unit_price']);
                    $this->db->update('`tbl_trans_distributor_warehouse_stock`', $arrUpdate);
                    if ($this->db->trans_status() === FALSE) {
                        $IsInserted = 0;
                    }
                } else {//no records have need to add as a new record
                    $arrIn = array(
                        '`location_code`' => $r['stock_location_id'],
                        '`item`' => $r['item'],
                        '`unit_price`' => $r['unit_price'],
                        '`head_office_inv_qty`' => $r['received_qty']
                    );
                    $this->db->insert('`tbl_trans_distributor_warehouse_stock`', $arrIn);
                    if ($this->db->trans_status() === FALSE) {
                        $IsInserted = 0;
                    }
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

    //GET COMPANY INVOICE PENDING TO ACCEPT
    function updateHeadOfficeInvoiceStockPending($ag_cd, $date_posted) {
        $IsInserted = 1;
        //get good return posted after stock taking
        $this->db->select('`tbl_mst_distributor_warehouse`.`id` AS `stock_location_id`,`tbl_mst_item_erp_codes`.`item_code` as `item`,`c_invh`.`ag_date`,`c_incd`.`up` AS `unit_price`,`c_incd`.`qty` AS `received_qty`');
        $this->db->from('`tbl_mst_distributor_warehouse`');
        $this->db->join('`tbl_mst_distributor`', '`tbl_mst_distributor_warehouse`.`distributor_id`=`tbl_mst_distributor`.`id`', 'INNER');
        $this->db->join('`c_invh`', '`tbl_mst_distributor`.`agency_code`=`c_invh`.`ag_cd`', 'INNER');
        $this->db->join('`c_incd`', '`c_invh`.`c_invno`=`c_incd`.`c_invno`', 'INNER');
        $this->db->join('`tbl_mst_item_erp_codes`', '`c_incd`.`item_code`=`tbl_mst_item_erp_codes`.`erp_item_code`', 'INNER');
        $this->db->where(array(
            '`tbl_mst_distributor`.`agency_code`' => $ag_cd,
            '`tbl_mst_distributor`.`is_act`' => 1,
            '`c_invh`.`c_inv_date`>' => $date_posted,
            '`c_invh`.`ag_accept`' => 0
        ));
        $query = $this->db->get();
        $result = $query->result_array();
        echo $this->db->last_query();
        $this->db->trans_begin();
        if (!empty($result) && isset($result)) {
            foreach ($result as $r) {
                //get stock record for the item in warehouse
                $this->db->select('`id`, `distributor_id`, `location_code`, `item`, `stock_post_date`, `unit_price`, `op_sellable`, `op_damage`, `invoice_a_qty`, `invoice_f_qty`, `invoice_g_qty`, `invoice_g_free_qty`, `invoice_m_qty`, `invoice_m_free_qty`, `good_return_qty`, `market_return_qty`, `head_office_inv_qty`, `head_office_inv_qty_pending_accept`');
                $this->db->from('`tbl_trans_distributor_warehouse_stock`');
                $this->db->where('`location_code`', $r['stock_location_id']);
                $this->db->where('`item`', $r['item']);
                $this->db->where('`unit_price`', $r['unit_price']);
                $queryN = $this->db->get();
                $resultN = $queryN->row();
                if (!empty($resultN) && isset($resultN)) {//records have need to update
                    $arrUpdate = array(
                        '`head_office_inv_qty_pending_accept`' => $r['received_qty']
                    );
                    $this->db->where('`location_code`', $r['stock_location_id']);
                    $this->db->where('`item`', $r['item']);
                    $this->db->where('`unit_price`', $r['unit_price']);
                    $this->db->update('`tbl_trans_distributor_warehouse_stock`', $arrUpdate);
                    if ($this->db->trans_status() === FALSE) {
                        $IsInserted = 0;
                    }
                } else {//no records have need to add as a new record
                    $arrIn = array(
                        '`location_code`' => $r['stock_location_id'],
                        '`item`' => $r['item'],
                        '`unit_price`' => $r['unit_price'],
                        '`head_office_inv_qty_pending_accept`' => $r['received_qty']
                    );
                    $this->db->insert('`tbl_trans_distributor_warehouse_stock`', $arrIn);
                    if ($this->db->trans_status() === FALSE) {
                        $IsInserted = 0;
                    }
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

    //GET AGENCY DISTRIBUTOR STOCK LOCATION ID
    function getSettings($data) {
        $ag_cd = $data['ag_cd'];
        $this->db->select('`tbl_mst_distributor_warehouse`.`id`');
        $this->db->from('`tbl_mst_distributor_warehouse`');
        $this->db->join('`tbl_mst_distributor`', '`tbl_mst_distributor_warehouse`.`distributor_id`=`tbl_mst_distributor`.`id`', 'INNER');
        $this->db->where(array(
            '`tbl_mst_distributor`.`agency_code`' => $ag_cd,
            '`tbl_mst_distributor`.`is_act`' => 1
        ));
        $this->db->limit(1);
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }

    //STOCK RECAL LAST PROCESS TIME LOG
    function getAgencyStocktoRecal() {
        $this->db->select('`ad_code`, `refer_code`, `range_name`, `stock_date`, `last_process_time`, `is_processed`');
        $this->db->from('tbl_trans_distributor_warehouse_stock_process_log');
        $this->db->where(array(
            'is_processed' => 0
        ));
        //$this->db->limit(1);
        $this->db->order_by('refer_code');
        $querys = $this->db->get();
        //$results = $querys->row();
        $results = $querys->result_array();
        if (!empty($results) && isset($results)) {// we have a agency to recal stock - call stock re calculation
            foreach ($results as $r) {
                //$this->recalStockLevel($results->ad_code);
                //https://raigam.lk/raigamsfa/cron/addOpenStock/87/2023-01-31
                echo '<br>updateOpeningStock-Done' . $this->updateOpeningStock($r['ad_code'], $r['stock_date'], $r['range_name']);
                //https://raigam.lk/raigamsfa/cron/addGoodReturn/87/2023-01-31
                echo '<br>addGoodReturn-Done' . $this->updateGoodReturn($r['ad_code'], $r['stock_date']);
                //https://raigam.lk/raigamsfa/cron/addMarketReturn/87/2023-01-31
                echo '<br>addMarketReturn-Done' . $this->updateMarketReturn($r['ad_code'], $r['stock_date']);
                //https://raigam.lk/raigamsfa/cron/addSalesGiven/87/2023-01-31
                echo '<br>addSalesGiven-Done' . $this->updateSalesStock($r['ad_code'], $r['stock_date']);
                //https://raigam.lk/raigamsfa/cron/addGrnReceive/87/2023-01-31
                echo '<br>addSalesGiven-Done' . $this->updateHeadOfficeInvoiceStock($r['ad_code'], $r['stock_date']);
                //https://raigam.lk/raigamsfa/cron/addGrnPendingReceive/87/2023-01-31
                echo '<br>addSalesGiven-Done' . $this->updateHeadOfficeInvoiceStockPending($r['ad_code'], $r['stock_date']);
                echo 'All Done-' . $r['ad_code'].'<br>----------------<br>';
                //UPDATE STOCK PROCESS TABLE AGENCY as processed one

                $this->db->where(array(
                    'range_name' => $r['range_name'],
                    'ad_code' => $r['ad_code']
                ));
                $this->db->update('tbl_trans_distributor_warehouse_stock_process_log', array('is_processed' => 1, '`last_process_time`' => date('Y-m-d H:i:s')));
            }
            /*
              //$this->recalStockLevel($results->ad_code);
              //https://raigam.lk/raigamsfa/cron/addOpenStock/87/2023-01-31
              echo '<br>updateOpeningStock-Done'.$this->updateOpeningStock($results->ad_code,$results->stock_date,$results->range_name);
              //https://raigam.lk/raigamsfa/cron/addGoodReturn/87/2023-01-31
              echo '<br>addGoodReturn-Done'.$this->updateGoodReturn($results->ad_code, $results->stock_date);
              //https://raigam.lk/raigamsfa/cron/addMarketReturn/87/2023-01-31
              echo '<br>addMarketReturn-Done'.$this->updateMarketReturn($results->ad_code, $results->stock_date);
              //https://raigam.lk/raigamsfa/cron/addSalesGiven/87/2023-01-31
              echo '<br>addSalesGiven-Done'.$this->updateSalesStock($results->ad_code, $results->stock_date);
              //https://raigam.lk/raigamsfa/cron/addGrnReceive/87/2023-01-31
              echo '<br>addSalesGiven-Done'.$this->updateHeadOfficeInvoiceStock($results->ad_code, $results->stock_date);
              //https://raigam.lk/raigamsfa/cron/addGrnPendingReceive/87/2023-01-31
              echo '<br>addSalesGiven-Done'.$this->updateHeadOfficeInvoiceStockPending($results->ad_code, $results->stock_date);
              echo 'All Done-' . $results->ad_code;
              //UPDATE STOCK PROCESS TABLE AGENCY as processed one

              $this->db->where(array(
              'range_name' => $results->range_name,
              'ad_code' => $results->ad_code
              ));
              $this->db->update('tbl_trans_distributor_warehouse_stock_process_log', array('is_processed' => 1,'`last_process_time`' => date('Y-m-d H:i:s')));
             */
        } else {//no agency to stock recal - recreate recal process table
            $this->createRecalTable();
            echo 'Stock Recal Table re-created';
        }
    }

    //RECREATE STOCK RECAL PROCESS TABLE LOG
    function createRecalTable() {
        $this->db->select('tbl_mst_distributor_warehouse_common.common_warehouse_id,ag_cd,cd,st_no, max(st_date) as st_date');
        $this->db->from('stock_h');
        $this->db->join('tbl_mst_distributor','stock_h.ag_cd=tbl_mst_distributor.agency_code','INNER');
        $this->db->join('tbl_mst_distributor_warehouse','tbl_mst_distributor.id=tbl_mst_distributor_warehouse.distributor_id','INNER');
        $this->db->join('tbl_mst_distributor_warehouse_common','tbl_mst_distributor_warehouse.id=tbl_mst_distributor_warehouse_common.warehouse_id','INNER');
        $this->db->where(array(
            'st_date>=' => date('Y-m-d', strtotime("-35 days")),
            'post' => 'P'
        ));
        $this->db->group_by('ag_cd,cd');       
        $query = $this->db->get();
        $result = $query->result_array();
        foreach ($result as $a) {
            //GET OTHER AGENCY LIST HE HANDLLED IN ONE LOCATION
            $this->db->select('agency_code');
            $this->db->from('tbl_mst_distributor');
            $this->db->join('tbl_mst_distributor_warehouse','tbl_mst_distributor.id=tbl_mst_distributor_warehouse.distributor_id','INNER');
            $this->db->join('tbl_mst_distributor_warehouse_common','tbl_mst_distributor_warehouse.id=tbl_mst_distributor_warehouse_common.warehouse_id','INNER');
            $this->db->where('tbl_mst_distributor_warehouse_common.common_warehouse_id',$a['common_warehouse_id']);
            $query = $this->db->get();
            $resultb = $query->result_array();
            foreach ($resultb as $b){//iterate and all agency handle by this agent
                //check stock process log table is updated or not
                $this->db->select('`ad_code`, `refer_code`, `range_name`, `stock_date`, `last_process_time`, `is_processed`');
                $this->db->from('tbl_trans_distributor_warehouse_stock_process_log');
                $this->db->where(array(
                    'range_name' => $a['cd'],
                    'ad_code' => $b['agency_code']
                ));
                $this->db->limit(1);
                $querys = $this->db->get();
                $results = $querys->row();
                if (!empty($results) && isset($results) && $results->refer_code == $b['agency_code'] . '_' . $a['cd']) {
                    $this->db->where('refer_code', $b['agency_code'] . '_' . $a['cd']);
                    $this->db->update('tbl_trans_distributor_warehouse_stock_process_log', array('`is_processed`' => 0));
                } else {//insert as new
                    $arrIn = array(
                        '`refer_code`' => $b['agency_code'] . '_' . $a['cd'],
                        '`ad_code`' => $b['agency_code'],
                        '`range_name`' => $a['cd'],
                        '`stock_date`' => $a['st_date'],
                        '`last_process_time`' => '0000-00-00 00:00:00',
                        '`is_processed`' => 0
                    );
                    $this->db->insert('tbl_trans_distributor_warehouse_stock_process_log', $arrIn);
                }
            }
            
        }
    }

}

?>
