<?php

class MobileModule extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        // $this->load->model('UsersModel');
    }

    function getStatus() {
        // $arr = array(
        // 	'isact'=>1,
        // 	'status_name'=>'abc'
        // );
        $this->db->select(' `id`, `status_name`, `isact`');
        $this->db->from('`tbl_mst_mob_status`');
        $this->db->where('`isact`', 1);
        $query = $this->db->get();
        // $query->row()// one row
        $result = $query->result_array();
        // echo $this->db->last_query();
        return $result;
    }

    function getModels() {
        $this->db->select('`id`,`model_name`,`isact`');
        $this->db->from('`tbl_trans_mob_phon_models`');
        $this->db->where('`isact`', 1);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function getMobileRecords($id = null) {
        // $arr = array(
        // 	'isact'=>1,
        // 	'status_name'=>'abc'
        // );
        // $this->db->select('`tbl_trans_mob_registry`.`id`,`territory_name`,`rep_name`,`nic`,`phone_no`,`imei1`,`imei2`,`model`,`sim_sn`,`comment`,`tbl_mst_mob_status.status_name`,`tbl_mst_mob_status`.`id` as `tt`');

        $this->db->select('`tbl_mst_territory`.`id` As `territory_id`,`territory_name`,`rep_name`,`nic`,`phone_no`,`imei1`,`imei2`,`model`,`sim_sn`,`comment`,`tbl_mst_mob_status.status_name`,`tbl_trans_mob_phon_models`.`id As model_id`,`tbl_trans_mob_phon_models.model_name`,`tbl_mst_mob_status.id` As `status_id`,`tbl_trans_mob_registry`.`id` As `main_id`');
        $this->db->from('`tbl_trans_mob_registry`');
        $this->db->join('`tbl_mst_territory`', 'tbl_trans_mob_registry.territory_id=tbl_mst_territory.id', 'inner');
        $this->db->join('`tbl_mst_mob_status`', 'tbl_trans_mob_registry.status=tbl_mst_mob_status.id', 'inner');
        $this->db->join('`tbl_trans_mob_phon_models`', 'tbl_trans_mob_registry.model=tbl_trans_mob_phon_models.id', 'inner');
        if (!empty($id) && isset($id)) {
            $this->db->where('`tbl_trans_mob_registry.id`', $id);
        }
        $this->db->where('`tbl_trans_mob_registry.isact`', 1);

        $query = $this->db->get();
        if (!empty($id) && isset($id)) {
            $result = $query->row();
        } else {

            $result = $query->result_array();
        }
        return $result;
    }

    function saveMobileRecords($data) {
        $IsInserted = 1;
        $data['sess'] = $sess = $this->session->userdata('User');

        $arr = array(
            '`territory_id`' => $data['inputTerritory'],
            '`rep_name`' => $data['salesRepName'],
            '`nic`' => $data['nicNo'],
            '`phone_no`' => $data['phoneNo'],
            '`imei1`' => $data['imei1'],
            '`imei2`' => $data['imei2'],
            '`model`' => $data['phoneModel'],
            '`sim_sn`' => $data['simSn'],
            '`status`' => $data['status'],
            '`comment`' => $data['comment'],
            '`save_date`' => date('Y-m-d'),
            '`save_time`' => time('HH:mm:ss'),
            '`audit_user`' => $sess['username'],
            '`isact`' => 1
        );

        $this->db->trans_begin();
        $mainId = $data['main_id'];
        if ($mainId == 'new') {

            $this->db->insert('tbl_trans_mob_registry', $arr);
        } else {
            $this->db->where('tbl_trans_mob_registry.id', $mainId);
            $this->db->update('tbl_trans_mob_registry', $arr);
        }
        if ($this->db->trans_status() === FALSE) {
            $IsInserted = 0;
        }

        if ($IsInserted == 1) {
            $this->db->trans_commit();
            // echo $this->db->last_query();die();
            return 1;
        } else {
            $this->db->trans_rollback();
            return 0;
        }
    }

}
