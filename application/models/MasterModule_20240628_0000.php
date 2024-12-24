<?php

class MasterModule extends CI_Model {

    function __construct() {
        parent::__construct();
        //$this->mssql = $this->load->database('MSSQL', TRUE);         
        $this->load->model('SalesarcustomersModule');
    }

    //SAVE ZONE
    function getZone($id = null, $company_code = '001') {
        $this->db->select('`id`, `zone_name`, `is_active`, `is_deleted`');
        $this->db->from('`tbl_zone`');
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

    //SAVE ZONE MAPPING
    function saveZone($data) {
        $IsInserted = 1;
        $data = $data['sop'];
        $id = $data['id'];
        $name = $data['zoneName'];
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
            'zone_name' => $name,
            'is_active' => $act,
            'is_deleted' => $del
        );
        $this->db->trans_begin();
        if ($id == 'new') {
            $this->db->insert('`tbl_zone`', $arrIn);
            if ($this->db->trans_status() === FALSE) {
                $IsInserted = 0;
            }
        } else {//update record
            $this->db->where('`id`', $id);
            $this->db->update('`tbl_zone`', $arrIn);
            if ($this->db->trans_status() === FALSE) {
                $IsInserted = 0;
            }
        }
        //die();
        if ($IsInserted == 1) {
            $this->db->trans_commit();
            return 1;
        } else {
            $this->db->trans_rollback();
            return 0;
        }
    }

    //SAVE ZONE MAPPING
    function saveZoneMapping($data) {
        $IsInserted = 1;
        $data = $data['sop'];
        $id = $data['id'];
        $parent = $data['parent'];
        $child = $data['child'];
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
            'zone_id' => $child,
            'parent_zone_id' => $parent,
            'is_active' => $act,
            'is_deleted' => $del
        );
        $this->db->trans_begin();
        if ($id == 'new') {
            $this->db->insert('`tbl_zone_mapping`', $arrIn);
        } else {//update record
            $this->db->where('`id`', $id);
            $this->db->update('`tbl_zone_mapping`', $arrIn);
        }
        if ($this->db->trans_status() === FALSE) {
            $IsInserted = 0;
        }
        //die();
        if ($IsInserted == 1) {
            $this->db->trans_commit();
            return 1;
        } else {
            $this->db->trans_rollback();
            return 0;
        }
    }

    //GET ZONE MAPPING DATA
    function getZoneMap($id = null) {
        $this->db->select('`tbl_zone_mapping`.`id`,`tz1`.`id` as `parent_id`,`tz2`.`id` as `child_id`, `tz1`.`zone_name` AS `parent_name`,`tz2`.`zone_name` AS `child_name`, `tbl_zone_mapping`.`is_active`, `tbl_zone_mapping`.`is_deleted`');
        $this->db->from('`tbl_zone_mapping`');
        $this->db->join('`tbl_zone` `tz1`', '`tbl_zone_mapping`.`parent_zone_id`=`tz1`.`id`', 'INNER');
        $this->db->join('`tbl_zone` `tz2`', '`tbl_zone_mapping`.`zone_id`=`tz2`.`id`', 'INNER'); //$this->db->where('`sales_operations`.`company_code`',$company_code);
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

    //GET CHANNEL
    function getChannel($id = null, $company_code = '001') {
        $this->db->select('`id`, `channel_name`, `is_act`, `is_del`');
        $this->db->from('`tbl_mst_channel`');
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

    //SAVE CHANNEL
    function saveChannel($data) {
        $IsInserted = 1;
        $data = $data['sop'];
        $id = $data['id'];
        $name = $data['channelName'];
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
            'channel_name' => $name,
            'is_act' => $act,
            'is_del' => $del
        );
        $this->db->trans_begin();
        if ($id == 'new') {
            $this->db->insert('`tbl_mst_channel`', $arrIn);
        } else {//update record
            $this->db->where('`id`', $id);
            $this->db->update('`tbl_mst_channel`', $arrIn);
        }
        if ($this->db->trans_status() === FALSE) {
            $IsInserted = 0;
        }
        //die();
        if ($IsInserted == 1) {
            $this->db->trans_commit();
            return 1;
        } else {
            $this->db->trans_rollback();
            return 0;
        }
    }

    //GET OPERATION
    function getOperation($id = null, $company_code = '001') {
        $this->db->select('`id`, `operation_name`, `is_act`, `is_del`');
        $this->db->from('`tbl_mst_operation`');
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

    //SAVE OPERATION
    function saveOperation($data) {
        $IsInserted = 1;
        $data = $data['sop'];
        $id = $data['id'];
        $name = $data['operationName'];
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
            'operation_name' => $name,
            'is_act' => $act,
            'is_del' => $del
        );
        $this->db->trans_begin();
        if ($id == 'new') {
            $this->db->insert('`tbl_mst_operation`', $arrIn);
        } else {//update record
            $this->db->where('`id`', $id);
            $this->db->update('`tbl_mst_operation`', $arrIn);
        }
        if ($this->db->trans_status() === FALSE) {
            $IsInserted = 0;
        }
        //die();
        if ($IsInserted == 1) {
            $this->db->trans_commit();
            return 1;
        } else {
            $this->db->trans_rollback();
            return 0;
        }
    }

    //GET RANGE
    function getRange($id = null, $company_code = '001') {
        $this->db->select('`id`, `range_name`, `is_act`, `is_del`');
        $this->db->from('`tbl_mst_range`');
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

    //GET DIRECT LIST
    function getDirectList($id = null, $company_code = '001') {
        $this->db->select('DISTINCT(d)');
        $this->db->from('invh');
        //$this->db->where('`sales_operations`.`company_code`',$company_code);
        if (!empty($id) && isset($id)) {
            $this->db->where('d', $id);
        }
        $query = $this->db->get();
        if (!empty($id) && isset($id)) {
            $result = $query->row();
        } else {
            $result = $query->result_array();
        }
        return $result;
    }

    //SAVE RANGE
    function saveRange($data) {
        $IsInserted = 1;
        $data = $data['sop'];
        $id = $data['id'];
        $name = $data['rangeName'];
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
            'range_name' => $name,
            'is_act' => $act,
            'is_del' => $del
        );
        $this->db->trans_begin();
        if ($id == 'new') {
            $this->db->insert('`tbl_mst_range`', $arrIn);
        } else {//update record
            $this->db->where('`id`', $id);
            $this->db->update('`tbl_mst_range`', $arrIn);
        }
        if ($this->db->trans_status() === FALSE) {
            $IsInserted = 0;
        }
        //die();
        if ($IsInserted == 1) {
            $this->db->trans_commit();
            return 1;
        } else {
            $this->db->trans_rollback();
            return 0;
        }
    }

    //============================================
    //====GEOGRAPHY DEMARCATION===================
    //============================================
    //GET REGION
    function getRegion($id = null, $company_code = '001') {
        $this->db->select('`id`, `region_name`, `reference_code`, `is_act`, `is_del`');
        $this->db->from('`tbl_mst_region`');
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

    //SAVE RANGE
    function saveRegion($data) {
        $IsInserted = 1;
        $data = $data['sop'];
        $id = $data['id'];
        $name = $data['regionName'];
        $refCode = $data['regionCode'];
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
            'region_name' => $name,
            'reference_code' => $refCode,
            'is_act' => $act,
            'is_del' => $del
        );
        $this->db->trans_begin();
        if ($id == 'new') {
            $this->db->insert('`tbl_mst_region`', $arrIn);
        } else {//update record
            $this->db->where('`id`', $id);
            $this->db->update('`tbl_mst_region`', $arrIn);
        }
        if ($this->db->trans_status() === FALSE) {
            $IsInserted = 0;
        }
        //die();
        if ($IsInserted == 1) {
            $this->db->trans_commit();
            return 1;
        } else {
            $this->db->trans_rollback();
            return 0;
        }
    }

    //GET AREA
    function getArea($id = null, $company_code = '001', $isact = null) {
        $this->db->select('`id`, `area_name`, `reference_code`, `is_act`, `is_del`');
        $this->db->from('`tbl_mst_area`');
        if (!empty($isact) && isset($isact)) {
            $this->db->where('`tbl_mst_area`.`is_act`', 1);
        }
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

    //SAVE Area
    function saveArea($data) {
        $IsInserted = 1;
        $data = $data['sop'];
        $id = $data['id'];
        $name = $data['areaName'];
        $refCode = $data['areaCode'];
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
            'area_name' => $name,
            'reference_code' => $refCode,
            'is_act' => $act,
            'is_del' => $del
        );
        $this->db->trans_begin();
        if ($id == 'new') {
            $this->db->insert('`tbl_mst_area`', $arrIn);
        } else {//update record
            $this->db->where('`id`', $id);
            $this->db->update('`tbl_mst_area`', $arrIn);
        }
        if ($this->db->trans_status() === FALSE) {
            $IsInserted = 0;
        }
        //die();
        if ($IsInserted == 1) {
            $this->db->trans_commit();
            return 1;
        } else {
            $this->db->trans_rollback();
            return 0;
        }
    }

    //GET REGION AREA MAPPING
    function getRegionArea($id = null, $company_code = '001') {
        $this->db->select('`tbl_mst_region_link_area`.`id`, `region_id`, `area_id`, `tbl_mst_region`.`region_name`, `tbl_mst_area`.`area_name`, `tbl_mst_region_link_area`.`is_act`, `tbl_mst_region_link_area`.`is_del`');
        $this->db->from('`tbl_mst_region_link_area`');
        $this->db->join('`tbl_mst_region`', '`tbl_mst_region_link_area`.`region_id`=`tbl_mst_region`.`id`', 'INNER');
        $this->db->join('`tbl_mst_area`', '`tbl_mst_region_link_area`.`area_id`=`tbl_mst_area`.`id`', 'INNER');
        //$this->db->where('`sales_operations`.`company_code`',$company_code);
        if (!empty($id) && isset($id)) {
            $this->db->where('`tbl_mst_region_link_area`.`id`', $id);
        }
        $query = $this->db->get();
        if (!empty($id) && isset($id)) {
            $result = $query->row();
        } else {
            $result = $query->result_array();
        }
        return $result;
    }

    //SAVE REGION AREA MAPPING
    function saveRegionArea($data) {
        $IsInserted = 1;
        $data = $data['sop'];
        $id = $data['id'];
        $areaID = $data['area_id'];
        $regionID = $data['region_id'];
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
            'area_id' => $areaID,
            'region_id' => $regionID,
            'is_act' => $act,
            'is_del' => $del
        );
        $this->db->trans_begin();
        if ($id == 'new') {
            $this->db->insert('`tbl_mst_region_link_area`', $arrIn);
        } else {//update record
            $this->db->where('`id`', $id);
            $this->db->update('`tbl_mst_region_link_area`', $arrIn);
        }
        if ($this->db->trans_status() === FALSE) {
            $IsInserted = 0;
        }
        //die();
        if ($IsInserted == 1) {
            $this->db->trans_commit();
            return 1;
        } else {
            $this->db->trans_rollback();
            return 0;
        }
    }

    //GET TERRITORY
    function getTerritory($id = null, $company_code = '001') {
        $this->db->select('`id`, `territory_name`, `reference_code`, `is_act`, `is_del`');
        $this->db->from('`tbl_mst_territory`');
        //$this->db->where('`sales_operations`.`company_code`',$company_code);
        if (!empty($id) && isset($id)) {
            $this->db->where('`id`', $id);
        }
        $this->db->order_by('territory_name');
        $query = $this->db->get();
        if (!empty($id) && isset($id)) {
            $result = $query->row();
        } else {
            $result = $query->result_array();
        }
        return $result;
    }

    //SAVE Area
    function saveTerritory($data) {
        $IsInserted = 1;
        $data = $data['sop'];
        $id = $data['id'];
        $name = $data['territoryName'];
        $refCode = $data['territoryCode'];
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
            'territory_name' => $name,
            'reference_code' => $refCode,
            'is_act' => $act,
            'is_del' => $del
        );
        $this->db->trans_begin();
        if ($id == 'new') {
            $this->db->insert('`tbl_mst_territory`', $arrIn);
        } else {//update record
            $this->db->where('`id`', $id);
            $this->db->update('`tbl_mst_territory`', $arrIn);
        }
        if ($this->db->trans_status() === FALSE) {
            $IsInserted = 0;
        }
        //die();
        if ($IsInserted == 1) {
            $this->db->trans_commit();
            return 1;
        } else {
            $this->db->trans_rollback();
            return 0;
        }
    }

     
    //GET AREA TERRITORY MAPPING
    function getAreaTerritory($id = null, $company_code = '001', $areaid = null, $territoryID = null) {
        $this->db->select('`tbl_mst_region`.`id` AS `region_id`,`tbl_mst_region`.`region_name`,`tbl_mst_area_link_territory`.`id`, `tbl_mst_area_link_territory`.`area_id`, `territory_id`, `tbl_mst_area`.`area_name`,`tbl_mst_territory`.`reference_code`, `tbl_mst_territory`.`territory_name`, `tbl_mst_area_link_territory`.`is_act`, `tbl_mst_area_link_territory`.`is_del`');
        $this->db->from('`tbl_mst_area_link_territory`');
        $this->db->join('`tbl_mst_area`', '`tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id`', 'INNER');
        $this->db->join('`tbl_mst_territory`', '`tbl_mst_area_link_territory`.`territory_id`=`tbl_mst_territory`.`id`', 'INNER');
        $this->db->join('`tbl_mst_region_link_area`', '`tbl_mst_area`.`id`=`tbl_mst_region_link_area`.`area_id`', 'INNER');
        $this->db->join('`tbl_mst_region`', '`tbl_mst_region_link_area`.`region_id`=`tbl_mst_region`.`id`', 'INNER');
        //$this->db->where('`sales_operations`.`company_code`',$company_code);
        if (!empty($id) && isset($id)) {
            $this->db->where('`tbl_mst_area_link_territory`.`id`', $id);
        }
        if (!empty($areaid) && isset($areaid)) {
            $this->db->where('`tbl_mst_area`.`id`', $areaid);
        }
        $this->db->order_by('`tbl_mst_area`.`area_name`,`tbl_mst_territory`.`territory_name`');
        $query = $this->db->get();
        if (!empty($id) && isset($id)) {
            $result = $query->row();
        } else {
            $result = $query->result_array();
        }
        //echo $this->db->last_query();
        return $result;
    } 
    
    //GET AREA TERRITORY MAPPING NEW DEMARCATION SUPPORT 20240112
    function getAreaTerritoryNewDemarcation($id = null, $company_code = '001', $areaid = null, $territoryID = null, $rangeID = null) {
        $this->db->select('`tbl_mst_region`.`id` AS `region_id`,`tbl_mst_region`.`region_name`,`tbl_mst_geography`.`id`, `tbl_mst_geography`.`area_id`, `territory_id`, `tbl_mst_area`.`area_name`,`tbl_mst_territory`.`reference_code`, `tbl_mst_territory`.`territory_name`');
        $this->db->from('`tbl_mst_geography`');
        //$this->db->join('`tbl_mst_geography`','`tbl_mst_area_link_territory`.`territory_id`=`tbl_mst_geography`.`territory_id`','INNER');
        $this->db->join('`tbl_mst_area`', '`tbl_mst_geography`.`area_id`=`tbl_mst_area`.`id`', 'INNER');
        $this->db->join('`tbl_mst_territory`', '`tbl_mst_geography`.`territory_id`=`tbl_mst_territory`.`id`', 'INNER');
        //$this->db->join('`tbl_mst_region_link_area`', '`tbl_mst_area`.`id`=`tbl_mst_region_link_area`.`area_id`', 'INNER');
        $this->db->join('`tbl_mst_region`', '`tbl_mst_geography`.`region_id`=`tbl_mst_region`.`id`', 'INNER');
        //$this->db->where('`sales_operations`.`company_code`',$company_code);
        if (!empty($id) && isset($id)) {
            $this->db->where('`tbl_mst_geography`.`territory_id`', $id);
        }
        if (!empty($areaid) && isset($areaid)) {
            $this->db->where('`tbl_mst_area`.`id`', $areaid);
        }        
        if (!empty($rangeID) && isset($rangeID)) {
            $this->db->where('`tbl_mst_geography`.`range_id`', $rangeID);
        }
        $this->db->order_by('`tbl_mst_area`.`area_name`,`tbl_mst_territory`.`territory_name`');
        $query = $this->db->get();
        if (!empty($id) && isset($id)) {
            $result = $query->row();
        } else {
            $result = $query->result_array();
        }
        //echo $this->db->last_query();
        return $result;
    }
    

    //GET AREA TERRITORY AGENCY LOCATION COMMON MAPPING
    function getAreaTerritoryCommon($id = null, $company_code = '001', $areaid = null, $territoryID = null, $range_ID=null) {
        /* 2024 06 17
        $this->db->select('`tbl_mst_region`.`id` AS `region_id`,`tbl_mst_region`.`region_name`,`tbl_mst_area_link_territory`.`id`, `tbl_mst_area_link_territory`.`area_id`,`common_warehouse_id`,`tbl_mst_distributor`.`agency_name`, `territory_id`, `tbl_mst_area`.`area_name`,`tbl_mst_territory`.`reference_code`, `tbl_mst_territory`.`territory_name`, `tbl_mst_area_link_territory`.`is_act`, `tbl_mst_area_link_territory`.`is_del`');
        $this->db->from('`tbl_mst_area_link_territory`');
        $this->db->join('`tbl_mst_area`', '`tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id`', 'INNER');
        $this->db->join('`tbl_mst_territory`', '`tbl_mst_area_link_territory`.`territory_id`=`tbl_mst_territory`.`id`', 'INNER');
        $this->db->join('`tbl_mst_distributor`', '`tbl_mst_territory`.`reference_code`=`tbl_mst_distributor`.`agency_code`', 'INNER');
        $this->db->join('`tbl_mst_distributor_warehouse`', '`tbl_mst_distributor`.`id`=`tbl_mst_distributor_warehouse`.`distributor_id`', 'INNER');
        $this->db->join('`tbl_mst_distributor_warehouse_common`', '`tbl_mst_distributor_warehouse`.`id`=`tbl_mst_distributor_warehouse_common`.`common_warehouse_id`', 'INNER');
        $this->db->join('`tbl_mst_region_link_area`', '`tbl_mst_area`.`id`=`tbl_mst_region_link_area`.`area_id`', 'INNER');
        $this->db->join('`tbl_mst_region`', '`tbl_mst_region_link_area`.`region_id`=`tbl_mst_region`.`id`', 'INNER');
        */
        
        $this->db->select('`tbl_mst_region`.`id` AS `region_id`,`tbl_mst_region`.`region_name`,`tbl_mst_geography`.`id`, `tbl_mst_geography`.`area_id`,`common_warehouse_id`,`tbl_mst_distributor`.`agency_name`, `territory_id`, `tbl_mst_area`.`area_name`,`tbl_mst_territory`.`reference_code`, `tbl_mst_territory`.`territory_name`');
        $this->db->from('`tbl_mst_geography`');
        $this->db->join('`tbl_mst_area`', '`tbl_mst_geography`.`area_id`=`tbl_mst_area`.`id`', 'INNER');
        $this->db->join('`tbl_mst_territory`', '`tbl_mst_geography`.`territory_id`=`tbl_mst_territory`.`id`', 'INNER');
        $this->db->join('`tbl_mst_distributor`', '`tbl_mst_territory`.`reference_code`=`tbl_mst_distributor`.`agency_code`', 'INNER');
        $this->db->join('`tbl_mst_distributor_warehouse`', '`tbl_mst_distributor`.`id`=`tbl_mst_distributor_warehouse`.`distributor_id`', 'INNER');
        $this->db->join('`tbl_mst_distributor_warehouse_common`', '`tbl_mst_distributor_warehouse`.`id`=`tbl_mst_distributor_warehouse_common`.`warehouse_id`', 'INNER');
        //$this->db->join('`tbl_mst_region_link_area`', '`tbl_mst_area`.`id`=`tbl_mst_region_link_area`.`area_id`', 'INNER');
        $this->db->join('`tbl_mst_region`', '`tbl_mst_geography`.`region_id`=`tbl_mst_region`.`id`', 'INNER');
        $this->db->join('`tbl_mst_range`', '`tbl_mst_geography`.`range_id`=`tbl_mst_range`.`id`', 'INNER');
        
        if (!empty($id) && isset($id)) {
            $this->db->where('`tbl_mst_geography`.`id`', $id);
        }
        if (!empty($areaid) && isset($areaid)) {
            $this->db->where('`tbl_mst_area`.`id`', $areaid);
        }
        //if (!empty($range_ID) && isset($range_ID)) {
            $this->db->where('`tbl_mst_range`.`range_name`', $range_ID);
        //}
        $this->db->group_by('`tbl_mst_distributor_warehouse_common`.`common_warehouse_id`');
        $this->db->order_by('`tbl_mst_area`.`area_name`,`tbl_mst_territory`.`territory_name`');
        $query = $this->db->get();
        if (!empty($id) && isset($id)) {
            $result = $query->row();
        } else {
            $result = $query->result_array();
        }
        echo $this->db->last_query();
        //die();
        return $result;
    }

    //SAVE AREA TERRITORY MAPPING
    function saveAreaTerritory($data) {
        $IsInserted = 1;
        $data = $data['sop'];
        $id = $data['id'];
        $areaID = $data['area_id'];
        $territoryID = $data['territory_id'];
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
            'area_id' => $areaID,
            'territory_id' => $territoryID,
            'is_act' => $act,
            'is_del' => $del
        );
        $this->db->trans_begin();
        if ($id == 'new') {
            $this->db->insert('`tbl_mst_area_link_territory`', $arrIn);
        } else {//update record
            $this->db->where('`id`', $id);
            $this->db->update('`tbl_mst_area_link_territory`', $arrIn);
        }
        if ($this->db->trans_status() === FALSE) {
            $IsInserted = 0;
        }
        //die();
        if ($IsInserted == 1) {
            $this->db->trans_commit();
            return 1;
        } else {
            $this->db->trans_rollback();
            return 0;
        }
    }

    //GET ROUTE
    function getRoute($id = null, $company_code = '001') {
        $this->db->select('`id`, `route_name`, `reference_code`, `display_order`, `is_act`, `is_del`');
        $this->db->from('`tbl_mst_route`');
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

    //SAVE Route
    function saveRoute($data) {
        $IsInserted = 1;
        $data = $data['sop'];
        $id = $data['id'];
        $name = $data['routeName'];
        $refCode = $data['routeCode'];
        $displayOrder = $data['routeOrder'];
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
            'route_name' => $name,
            'reference_code' => $refCode,
            'display_order' => $displayOrder,
            'is_act' => $act,
            'is_del' => $del
        );
        $this->db->trans_begin();
        if ($id == 'new') {
            $this->db->insert('`tbl_mst_route`', $arrIn);
        } else {//update record
            $this->db->where('`id`', $id);
            $this->db->update('`tbl_mst_route`', $arrIn);
        }
        if ($this->db->trans_status() === FALSE) {
            $IsInserted = 0;
        }
        //die();
        if ($IsInserted == 1) {
            $this->db->trans_commit();
            return 1;
        } else {
            $this->db->trans_rollback();
            return 0;
        }
    }

    //GET TERRITORY ROUTE MAPPING
    function getTerritoryRoute($id = null, $company_code = '001', $areaid = null, $territoryid = null,$rangeID=null) {
        $this->db->select('`tbl_mst_region`.`id` AS `region_id`,`tbl_mst_region`.`region_name`,`tbl_mst_territory_link_route`.`id`, `tbl_mst_area`.`id` AS `area_id`, `tbl_mst_territory`.`id` AS `territory_id`,`tbl_mst_territory_link_route`.`route_id`, `tbl_mst_area`.`area_name`,`tbl_mst_territory`.`reference_code`, `tbl_mst_territory`.`territory_name`, `tbl_mst_route`.`route_name`, `tbl_mst_route`.`display_order`,`tbl_mst_route`.`reference_code` AS `route_reference_code` , `tbl_mst_territory_link_route`.`is_act`, `tbl_mst_territory_link_route`.`is_del`');
        $this->db->from('`tbl_mst_route`');
        $this->db->join('`tbl_mst_territory_link_route`', '`tbl_mst_route`.`id`=`tbl_mst_territory_link_route`.`route_id`', 'INNER');
        $this->db->join('`tbl_mst_territory`', '`tbl_mst_territory_link_route`.`territory_id`=`tbl_mst_territory`.`id`', 'INNER');
        //$this->db->join('`tbl_mst_area_link_territory`', '`tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id`');
        //$this->db->join('`tbl_mst_area`', '`tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id`', 'INNER');
        //$this->db->join('`tbl_mst_region_link_area`', '`tbl_mst_area`.`id`=`tbl_mst_region_link_area`.`area_id`', 'INNER');
        //$this->db->join('`tbl_mst_region`', '`tbl_mst_region_link_area`.`region_id`=`tbl_mst_region`.`id`', 'INNER');
        //$this->db->where('`sales_operations`.`company_code`',$company_code);
        $this->db->join('tbl_mst_geography','tbl_mst_territory.id=tbl_mst_geography.territory_id','INNER');
        $this->db->join('tbl_mst_range','tbl_mst_geography.range_id=tbl_mst_range.id','INNER');
        $this->db->join('tbl_mst_area','tbl_mst_geography.area_id=tbl_mst_area.id','INNER');
        $this->db->join('tbl_mst_region','tbl_mst_geography.region_id=tbl_mst_region.id','INNER');
        
        if (!empty($id) && isset($id)) {
            $this->db->where('`tbl_mst_territory_link_route`.`id`', $id);
        }
        if (!empty($areaid) && isset($areaid)) {
            $this->db->where('`tbl_mst_area`.`id`', $areaid);
        }
        if (!empty($territoryid) && isset($territoryid)) {
            $this->db->where('`tbl_mst_territory`.`id`', $territoryid);
        }
        if (!empty($rangeID) && isset($rangeID)) {
            $this->db->where('`tbl_mst_range`.`id`', $rangeID);
        }
        $this->db->order_by('`tbl_mst_route`.`display_order` ASC');
        $query = $this->db->get();
        if (!empty($id) && isset($id)) {
            $result = $query->row();
        } else {
            $result = $query->result_array();
        }
        //echo $this->db->last_query();
        return $result;
    }

    //SAVE TERRITORY ROUTE MAPPING
    function saveTerritoryRoute($data) {
        $IsInserted = 1;
        $data = $data['sop'];
        $id = $data['id'];
        $routeID = $data['route_id'];
        $territoryID = $data['territory_id'];
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
            'route_id' => $routeID,
            'territory_id' => $territoryID,
            'is_act' => $act,
            'is_del' => $del
        );
        $this->db->trans_begin();
        if ($id == 'new') {
            $this->db->insert('`tbl_mst_territory_link_route`', $arrIn);
        } else {//update record
            $this->db->where('`id`', $id);
            $this->db->update('`tbl_mst_territory_link_route`', $arrIn);
        }
        if ($this->db->trans_status() === FALSE) {
            $IsInserted = 0;
        }
        //die();
        if ($IsInserted == 1) {
            $this->db->trans_commit();
            return 1;
        } else {
            $this->db->trans_rollback();
            return 0;
        }
    }

    //OUTLET CATEGORY
    //GET ROUTE
    function getOutletCategory($id = null) {
        $this->db->select('`id`, `name`, `is_act`');
        $this->db->from('`tbl_mst_outlet_category`');
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

    function getItems($id = null) {
        $this->db->select('`item`, `ln`, `description`, `uom`, `is_act`');
        $this->db->from('`tbl_mst_item`');
        //$this->db->where('`sales_operations`.`company_code`',$company_code);
        if (!empty($id) && isset($id)) {
            $this->db->where('`item`', $id);
        }
        $query = $this->db->get();
        if (!empty($id) && isset($id)) {
            $result = $query->row();
        } else {
            $result = $query->result_array();
        }
        return $result;
    }

    //Get Item allowed ranges data
    function getItemRanges($item = null) {
        $this->db->select('`id`, `item`, `range_id`, `range_name`, `category_sequence`, `item_sequence`, `is_act`');
        $this->db->from('`tbl_mst_range_item`');
        if (!empty($item) && isset($item)) {
            $this->db->where('`item`', $item);
        }
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    //GET ITEM PRICE DATA
    function getItemPrice($item = null) {
        $this->db->select('`tbl_mst_item_price`.`id`, `range_id`, tbl_mst_range.range_name, `item`, `uom`, `wholesale_price`, `min_ret_price`, `retail_price`, `date_start`, `date_end`');
        $this->db->from('`tbl_mst_item_price`');
        $this->db->join('`tbl_mst_range`', 'tbl_mst_item_price.range_id=tbl_mst_range.id', 'INNER');
        if (!empty($item) && isset($item)) {
            $this->db->where('`item`', $item);
        }
        $this->db->order_by('date_start,range_name DESC');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    //GET TERRITORY ROUTE MAPPING
    function getTerritoryRep($id = null, $company_code = '001', $areaid = null, $territoryid = null, $rangeid = null) {
        $this->db->select('`rep_username`,`profname`, `mobile`');
        $this->db->from('`tbl_mst_rep_link_territory_agent`');
        $this->db->join('`useracc`', '`tbl_mst_rep_link_territory_agent`.`rep_username`=`useracc`.`username`', 'INNER');
        $this->db->join('`tbl_mst_range`', '`tbl_mst_rep_link_territory_agent`.`range_id`=`tbl_mst_range`.`id`', 'INNER');
        $this->db->join('`tbl_mst_territory`', '`tbl_mst_rep_link_territory_agent`.`territory_id`=`tbl_mst_territory`.`id`', 'INNER');
        $this->db->join('`tbl_mst_area_link_territory`', '`tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id`');
        $this->db->join('`tbl_mst_area`', '`tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id`', 'INNER');
        $this->db->join('`tbl_mst_region_link_area`', '`tbl_mst_area`.`id`=`tbl_mst_region_link_area`.`area_id`', 'INNER');
        $this->db->join('`tbl_mst_region`', '`tbl_mst_region_link_area`.`region_id`=`tbl_mst_region`.`id`', 'INNER');
        //$this->db->where('`sales_operations`.`company_code`',$company_code);
        if (!empty($id) && isset($id)) {
            $this->db->where('`tbl_mst_rep_link_territory_agent`.`id`', $id);
        }
        if (!empty($areaid) && isset($areaid)) {
            $this->db->where('`tbl_mst_area`.`id`', $areaid);
        }
        if (!empty($territoryid) && isset($territoryid)) {
            $this->db->where('`tbl_mst_territory`.`id`', $territoryid);
        }
        if (!empty($rangeid) && isset($rangeid)) {
            $this->db->where('`tbl_mst_range`.`id`', $rangeid);
        }
        $this->db->order_by('`tbl_mst_rep_link_territory_agent`.`id` ASC');
        $query = $this->db->get();
        if (!empty($id) && isset($id)) {
            $result = $query->row();
        } else {
            $result = $query->result_array();
        }
        //echo $this->db->last_query();
        return $result;
    }

    //ADD GEOGRAPHY FINAL MAPPING
    function saveGeography($data) {
        $data = $data['sop'];
        $IsInserted = 1;
        $region_id = $data['region_id'];
        $area_id = $data['area_id'];
        $territory_id = $data['territory_id'];
        $current_territory_id = $data['current_territory_id'];
        $range_id = $data['range_id'];
        $distributor_id = $data['distributor_id'];
        $id = $data['id'];

        $arr = array(
            '`region_id`' => $region_id,
            '`area_id`' => $area_id,
            '`territory_id`' => $territory_id,
            '`current_territory_id`' => $current_territory_id,
            '`range_id`' => $range_id,
            '`agency_id`' => $distributor_id
        );
        $this->db->trans_begin();
        if ($id == 'new') {
            $this->db->insert('tbl_mst_geography', $arr);
        } else {
            $this->db->where('id', $id);
            $this->db->update('tbl_mst_geography', $arr);
        }

        if ($this->db->trans_status() === FALSE) {
            $IsInserted = 0;
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
        return $IsInserted;
    }

    //get final geography details
    function getGeography($id = null) {
        $this->db->select('`tbl_mst_geography`.`id`, `region_id`, `tbl_mst_region`.`region_name`,`tbl_mst_region`.`reference_code` AS `region_code`, `area_id`,`tbl_mst_area`.`area_name`, `territory_id`,`tbl_mst_territory`.`territory_name`,`tbl_mst_territory`.`reference_code` AS `territory_reference_code`, `current_territory_id,`CT`.`territory_name` AS `current_territory_name`,`CT`.`reference_code` AS `current_territory_reference_code`, `range_id`,`tbl_mst_range`.`range_name`, `agency_id`,`tbl_mst_distributor`.`agency_name`');
        $this->db->from('`tbl_mst_geography`');
        $this->db->join('`tbl_mst_range`', '`tbl_mst_geography`.`range_id`=`tbl_mst_range`.`id`', 'INNER');
        $this->db->join('`tbl_mst_region`', '`tbl_mst_geography`.`region_id`=`tbl_mst_region`.`id`', 'INNER');
        $this->db->join('`tbl_mst_area`', '`tbl_mst_geography`.`area_id`=`tbl_mst_area`.`id`', 'INNER');
        $this->db->join('`tbl_mst_territory`', '`tbl_mst_geography`.`territory_id`=`tbl_mst_territory`.`id`', 'INNER');
        $this->db->join('`tbl_mst_territory` `CT`', '`tbl_mst_geography`.`current_territory_id`=`CT`.`id`', 'INNER');
        $this->db->join('`tbl_mst_distributor`', '`tbl_mst_geography`.`agency_id`=`tbl_mst_distributor`.`id`', 'INNER');
        if (!empty($id) && isset($id)) {
            $this->db->where('`tbl_mst_geography`.`id`', $id);
        }
        $this->db->order_by('`tbl_mst_geography`.`id` DESC');
        $query = $this->db->get();
        if (!empty($id) && isset($id)) {
            $result = $query->row();
        } else {
            $result = $query->result_array();
        }
        return $result;
    }

    //ASSIGN SHOPS TO RANGE 2023 10 17 
    function updateOutletRange($area_id = null, $id = null, $territoryID = null, $routeID = null, $range_id, $range_name) {
        $outlets = $this->SalesarcustomersModule->getCustomers($area_id, $id, $territoryID, $routeID);
        $IsInserted = 1;
        $str = '';
        $this->db->trans_begin();
        $count = 0;
        $error = 0;
        $alreadyAdded = 0;
        $newlyAdded = 0;
        foreach ($outlets as $o) {
            //Look for previous record in range outlet table
            $unique = $o['id'] . '_' . $range_name;
            $this->db->select('unique_id');
            $this->db->from('tbl_mst_outlet_range');
            $this->db->where(array('unique_id' => $unique));
            $queryN = $this->db->get();
            $resultN = $queryN->row();
            $isClosed = 0;
            if ($o['is_act'] == 0) {
                $isClosed = 1;
            }
            if (!empty($resultN) && isset($resultN)) {//records have no need to update      
                $alreadyAdded = $alreadyAdded+1;
            } else {//insert it
                $arr = array(
                    '`outlet_id`' => $o['id'],
                    '`range_id`' => $range_id,
                    '`range_name`' => $range_name,
                    '`unique_id`' => $unique,
                    '`comments`' => '',
                    '`is_allowed`' => $o['is_allowed'],
                    '`is_closed`' => $isClosed
                );
                $this->db->insert('tbl_mst_outlet_range', $arr);
                if ($this->db->trans_status() === FALSE) {
                    $IsInserted = 0;
                    $str = $str . '/n' . $this->db->error();
                    $error = $error + 1;
                }else{
                    $newlyAdded=$newlyAdded+1;
                }
            }
            $count = $count + 1;
        }
        if ($IsInserted == 1) {
            $this->db->trans_commit();
        } else {
            $this->db->trans_rollback();
        }
        echo $IsInserted;
        echo $str;
        echo '<br>Total Shops:' . $count;
        echo '<br>Already Added:'.$alreadyAdded;
        echo '<br>Newly Added:'.$newlyAdded;
        echo '<br>Total Processed:'.($alreadyAdded+$newlyAdded);
        echo '<br>Total Errors:' . $error;
    }

    //ASSIGN SHOPS TO UPDATE PROCESS 2023 10 17 
    function processOutletUpdate($area_id = null, $id = null, $territoryID = null, $routeID = null, $range_id, $range_name) {
        $outlets = $this->SalesarcustomersModule->getCustomers($area_id, $id, $territoryID, $routeID);
        $IsInserted = 1;
        $str = '';
        $count = 0;
        $error = 0;
        $alreadyAdded = 0;
        $newlyAdded = 0;
        $this->db->trans_begin();
        foreach ($outlets as $o) {
            //Look for previous record in tbl_trans_shop_update table
            $unique = $o['id'] . '_' . $range_name;
            $this->db->select('unique_id');
            $this->db->from('tbl_trans_shop_update');
            $this->db->where(array('unique_id' => $unique));
            $queryN = $this->db->get();
            $resultN = $queryN->row();
            $isClosed = 0;
            if ($o['is_act'] == 0) {
                $isClosed = 1;
            }
            if (!empty($resultN) && isset($resultN)) {//records have no need to update                 
                $alreadyAdded = $alreadyAdded+1;
            } else {//insert it
                $arr = array(
                    '`unique_id`' => $o['id'] . '_' . $range_name,
                    '`range_id`' => $range_id,
                    '`range_name`' => $range_name,
                    '`outlet_id`' => $o['id'],
                    '`is_updated`' => 0,
                    '`shop_type`' => 0,
                    '`image`' => 'aa',
                    '`latitude`' => 0,
                    '`longitude`' => 0,
                    '`is_closed`' => 0,
                    '`updated_date`' => '2000-01-01',
                    '`is_approved`' => 0,
                    '`approved_date`' => '2000-01-01'
                );
                $this->db->insert('tbl_trans_shop_update', $arr);
                if ($this->db->trans_status() === FALSE) {
                    $IsInserted = 0;
                    $str = $str . '/n' . $this->db->error();
                    $error = $error + 1;
                }else{
                    $newlyAdded=$newlyAdded+1;
                }
            }
            $count = $count + 1;
        }
        if ($IsInserted == 1) {
            $this->db->trans_commit();
        } else {
            $this->db->trans_rollback();
        }
        echo $IsInserted;
        echo $str;
        echo '<br>Total Shops:' . $count;
        echo '<br>Already Added:'.$alreadyAdded;
        echo '<br>Newly Added:'.$newlyAdded;
        echo '<br>Total Processed:'.($alreadyAdded+$newlyAdded);
        echo '<br>Total Errors:' . $error;
    }

    /* ----------------------------sandun---------------------------- */

    //GET CATEGORY List
    function getCategoryList($cat = null, $company_code = '001') {
        $this->db->select('`cat`');
        $this->db->from('`item_mst`');
        if (!empty($cat) && isset($cat)) {
            $this->db->where('`cat`', $cat);
        }
        $this->db->group_by('`cat`');
        $query = $this->db->get();
        if (!empty($cat) && isset($cat)) {
            $result = $query->row();
        } else {
            $result = $query->result_array();
        }
        return $result;
    }

    //GET LOCATION
    function getLocationList($locationID = null, $company_code = '001') {
        $this->db->select('`code`');
        $this->db->from('`ic_locations`');
        if (!empty($locationID) && isset($locationID)) {
            $this->db->where('`id`', $locationID);
        }
        $query = $this->db->get();
        if (!empty($locationID) && isset($locationID)) {
            $result = $query->row();
        } else {
            $result = $query->result_array();
        }
        return $result;
    }

    //GET Direct Bill Type
    function directDropDown($directID = null, $company_code = '001') {
        $this->db->select('`d`');
        $this->db->from('`invh`');
        if (!empty($directID) && isset($directID)) {
            $this->db->where('`d`', $directID);
        }
        $this->db->group_by('`d`');
        $query = $this->db->get();
        if (!empty($directID) && isset($directID)) {
            $result = $query->row();
        } else {
            $result = $query->result_array();
        }
        return $result;
    }

    //GET Representatives' ranges
    function rangeDropDown($rangeID = null, $company_code = '001') {
        $this->db->select('`cd`');
        $this->db->from('`invh`');
        if (!empty($rangeID) && isset($rangeID)) {
            $this->db->where('`cd`', $rangeID);
        }
        $this->db->group_by('`cd`');
        $query = $this->db->get();
        if (!empty($rangeID) && isset($rangeID)) {
            $result = $query->row();
        } else {
            $result = $query->result_array();
        }
        return $result;
    }

    //GET area list
    function areaDropDown($areaID = null, $company_code = '001') {
        $this->db->select('`area_cd`,`area_name`,`area_ase`,`area_asm`,`ch_head`,`cd`,`region`');
        $this->db->from('`area_h`');
        if (!empty($areaID) && isset($areaID)) {
            $this->db->where('`area_cd`', $areaID);
        }
        $this->db->group_by('`area_cd`');
        $query = $this->db->get();
        if (!empty($areaID) && isset($areaID)) {
            $result = $query->row();
        } else {
            $result = $query->result_array();
        }
        return $result;
    }

    /* ----------------------------sandun---------------------------- */
    //============================================
    //====END GEOGRAPHY DEMARCATION===================
    //============================================
}

?>