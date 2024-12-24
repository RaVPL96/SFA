<?php

/*


 * This system Licenced to Raigam Marketing Services (Pvt) Ltd. 

 * Developed By: Lakshitha Pradeep Karunarathna  * 

 * Company: Serving Cloud INC in association with MyOffers.lk  * 

 * Date Started:  October 20, 2017  * 


 */

class HrModule extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('AuditModule');
    }

    //get Attendance type master data
    function getAttendanceType() {
        $this->db->select('`id`, `type_name`, `is_act`');
        $this->db->from('`tbl_mst_hr_attendance_type`');
        $this->db->where('`is_act`', 1);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function setAttendance($dateFrom = null, $dateTo = null) {

        $begin = new DateTime($dateFrom);
        $end = new DateTime($dateTo);

        for ($i = $begin; $i <= $end; $i->modify('+1 day')) {
            $dateF = $dateT = $i->format("Y-m-d");
            $resultRep = $this->getSalesRepList();
            $result = $this->getTimeAttendance(null, $dateF, $dateT);
            $resultBillCount = $this->getBillCount(null, $dateF, $dateT);
            foreach ($resultRep as $rr) {
                $this->db->select('COUNT(id) as c'); //get count and check already exits else create and insert
                $this->db->from('`tbl_trans_hr_attendance`');
                $arrWhere = array('user_name' => $rr['rep_username'], 'date_work' => $dateF);
                $this->db->where($arrWhere);
                $query = $this->db->get();
                $resultCount = $query->row();
                /* if ($resultCount->c >1){
                  $this->db->where($arrWhere);
                  $this->db->delete('tbl_trans_hr_attendance');
                  } */
                if ($resultCount->c < 1) {//not found only add	
                    $arrinR = array(
                        'user_name' => $rr['rep_username'],
                        'date_work' => $dateF
                    );
                    $this->db->insert('tbl_trans_hr_attendance', $arrinR);
                }
            }
            foreach ($result as $r) {
                $totBills = 0;
                $totalSale = 0;
                if ($r['user_name'] != 'testc') {
                    foreach ($resultBillCount as $value) {
                        if ($r['user_name'] == $value['audit_user'] && $r['gps_date'] == $value['inv_date']) {
                            $totBills = $value['bill_count'];
                            $totalSale = $value['net_value'] + $value['net_discount_value'];
                        }
                    }

                    $this->db->select('COUNT(id) as c'); //get count and check already exits else create and insert
                    $this->db->from('`tbl_trans_hr_attendance`');
                    $arrWhere = array('user_name' => $r['user_name'], 'date_work' => $r['gps_date']);
                    $this->db->where($arrWhere);
                    $query = $this->db->get();
                    $resultCount = $query->row();

                    $first_bill_time = '00:00:00';
                    $last_bill_time = '00:00:00';
                    $resultBillTime = $this->getFirstLastBill('ASC', $r['gps_date'], $r['gps_date'], $r['user_name']);
                    if (!empty($resultBillTime) && isset($resultBillTime)) {
                        $first_bill_time = $resultBillTime->inv_time;
                    }
                    $resultBillTime = $this->getFirstLastBill('DESC', $r['gps_date'], $r['gps_date'], $r['user_name']);
                    if (!empty($resultBillTime) && isset($resultBillTime)) {
                        $last_bill_time = $resultBillTime->inv_time;
                    }

                    if ($resultCount->c >= 1) {//found only updatea						
                        if ($r['day_status'] == 1) {
                            $arrset = array('check_in' => $r['check_in'], 'check_in_distance' => $r['distance'], 'total_bills' => $totBills, 'first_bill_time' => $first_bill_time, 'last_bill_time' => $last_bill_time, 'total_sale' => $totalSale);
                        }
                        if ($r['day_status'] == 3) {
                            $arrset = array('check_out' => $r['check_out'], 'check_out_distance' => $r['distance'], 'total_bills' => $totBills, 'first_bill_time' => $first_bill_time, 'last_bill_time' => $last_bill_time, 'total_sale' => $totalSale);
                        }
                        $this->db->set($arrset);
                        $this->db->where($arrWhere);
                        $this->db->update('tbl_trans_hr_attendance', $arrset);
                    } else {//insert as new
                        $arrin = array(
                            'user_name' => $r['user_name'],
                            'date_work' => $r['gps_date'],
                            'total_bills' => $totBills,
                            'first_bill_time' => $first_bill_time,
                            'last_bill_time' => $last_bill_time,
                            'total_sale' => $totalSale
                        );
                        if ($r['day_status'] == 1) {
                            array_merge($arrin, array('check_in' => $r['check_in'], 'check_in_distance' => $r['distance']));
                        }
                        if ($r['day_status'] == 3) {
                            array_merge($arrin, array('check_out' => $r['check_out'], 'check_out_distance' => $r['distance']));
                        }
                        $this->db->insert('tbl_trans_hr_attendance', $arrin);
                    }
                }
            }
        }
        $this->AuditModule->saveCronStatus('hr_attendance', date('Y-m-d'), date('H:i:s'));
        return 1;
    }

    //SAVE ASE COMMENTS
    function saveAttendanceComment($data) {
        $d = $data['hr']['ASE'];
        $dataTerritory = $d['territory'];
        $IsInserted = 1;
        $sess = $this->session->userdata('User');
        $aseName = $sess['username'];

        $this->db->trans_begin();
        foreach ($dataTerritory as $a) {
            $user = $a;
            $userDates = $d[$a]['date'];
            foreach ($userDates as $dt) {
                $userDate = $dt;
                $attenType = $d['type'][$user][$userDate];
                $attenTypeTrainee = $d['trainee_type'][$user][$userDate];
                $attenComment = '';
                $trname = '';
                if (!empty($d['comment'][$user][$userDate]) && isset($d['comment'][$user][$userDate])) {
                    $attenComment = $d['comment'][$user][$userDate];
                } else {
                    $attenComment = '';
                }
                $arrUpdate = array(
                    '`reporting_person`' => $aseName,
                    '`attendance_type`' => $attenType,
                    '`comment`' => $attenComment,
                    '`trainee_name`' => $trname,
                    '`attendance_type_trainee`' => $attenTypeTrainee,
                    '`review_date`' => date('Y-m-d'),
                    '`review_time`' => date('H:i:s')
                );
                $arrWhere = array(
                    '`user_name`' => $user,
                    '`date_work`' => $userDate
                );
                $this->db->where($arrWhere);
                $this->db->update('`tbl_trans_hr_attendance`', $arrUpdate);
                //echo $this->db->last_query();echo '<br>';
                if ($this->db->trans_status() === FALSE) {
                    $IsInserted = 0;
                }
            }
        }
        //echo $IsInserted;

        if ($IsInserted == 0) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
        //echo $IsInserted;
        //die();
        return $IsInserted;
    }

    function getSalesRepList() {
        $this->db->select('`id`, `rep_username`, `territory_id`, `territory_ref_code`, `agency_id`, `agency_stlocation_id`, `channel_id`, `operation_id`, `range_id`, `range_name`, `delivery_method`, `allow_manual_entry`, `is_live`, `is_act`, `is_del`');
        $this->db->from('`tbl_mst_rep_link_territory_agent`');
        $this->db->where('`tbl_mst_rep_link_territory_agent`.is_del', 0);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function getAttendanceFinal($dateFrom, $dateTo, $areaID = null, $territoryID = null, $rangeID = null) {
        $this->db->select('`tbl_mst_area`.`area_name`,`tbl_mst_territory`.`territory_name`,`tbl_mst_range`.`range_name`,`tbl_trans_hr_attendance`.`id`, `tbl_trans_hr_attendance`.`user_name`, `tbl_trans_hr_attendance`.`date_work`, `check_in`, `check_out`, `check_in_distance`, `check_out_distance`, `total_bills`, `first_bill_time`, `last_bill_time`,`expected_first_bill_time`,`is_live`,`total_sale`, `reporting_person`, `attendance_type`, `comment`,`attendance_type_trainee`,`trainee_name`, `review_date`, `review_time`');
        $this->db->from('`tbl_trans_hr_attendance`');
        $this->db->join('`tbl_mst_rep_link_territory_agent`', '`tbl_trans_hr_attendance`.`user_name`=`tbl_mst_rep_link_territory_agent`.`rep_username`', 'RIGHT');
        $this->db->join('`tbl_mst_territory`', '`tbl_mst_rep_link_territory_agent`.`territory_id`=`tbl_mst_territory`.`id`', 'LEFT');
        $this->db->join('`tbl_mst_area_link_territory`', '`tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id`', 'LEFT');
        $this->db->join('`tbl_mst_area`', '`tbl_mst_area_link_territory`.`area_id`=`tbl_mst_area`.`id`', 'LEFT');
        $this->db->join('`tbl_mst_range`', '`tbl_mst_rep_link_territory_agent`.`range_id`=`tbl_mst_range`.`id`', 'INNER');
        $this->db->where(array('`date_work`>=' => $dateFrom, '`date_work`<=' => $dateTo));
        if (!empty($areaID) && isset($areaID) && $areaID != null) {
            $this->db->where('`tbl_mst_area`.`id`', $areaID);
        }
        if (!empty($territoryID) && isset($territoryID) && $territoryID != null) {
            $this->db->where('`tbl_mst_territory`.`id`', $territoryID);
        }
        if (!empty($rangeID) && isset($rangeID) && $rangeID != null) {
            $this->db->where('`tbl_mst_range`.`id`', $rangeID);
        }
        $this->db->order_by('`tbl_mst_area`.`area_name`,`tbl_mst_range`.`range_name`,`tbl_mst_territory`.`territory_name`');
        $query = $this->db->get();
        $result = $query->result_array();
        //echo $this->db->last_query();
        return $result;
    }

    function getTimeAttendance($areaID = null, $dateFrom = null, $dateTo = null) {
        $this->db->select('user_name,gps_date,gps_time,day_status,if(day_status=1,gps_time,\'-\') AS `check_in`,if(day_status=3,gps_time,\'-\') AS `check_out`,battery_level,(6371*acos(cos(radians(tbl_mst_distributor_warehouse.latitude))*cos(radians(tbl_trans_gps_log.latitude))*cos(radians(tbl_trans_gps_log.longitude)-radians(tbl_mst_distributor_warehouse.longitude))+sin(radians(tbl_mst_distributor_warehouse.latitude))*sin(radians(tbl_trans_gps_log.latitude))))as distances, 3956*2*ASIN(SQRT(POWER(SIN((tbl_mst_distributor_warehouse.latitude-abs(tbl_trans_gps_log.latitude))*pi()/180/2),2)+COS(tbl_mst_distributor_warehouse.latitude*pi()/180)*COS(abs(tbl_trans_gps_log.latitude)*pi()/180)*POWER(SIN((tbl_mst_distributor_warehouse.longitude-tbl_trans_gps_log.longitude)*pi()/180/2),2))) as distance');
        $this->db->from('`tbl_mst_calendar`');
        $this->db->join('`tbl_trans_gps_log`', 'tbl_trans_gps_log.gps_date = tbl_mst_calendar.company_date', 'INNER');
        $this->db->join('`tbl_mst_rep_link_territory_agent`', '`tbl_trans_gps_log`.`user_name` = `tbl_mst_rep_link_territory_agent`.`rep_username`', 'INNER');
        $this->db->join('`tbl_mst_distributor_warehouse`', '`tbl_mst_distributor_warehouse`.`id` = `tbl_mst_rep_link_territory_agent`.`agency_stlocation_id`', 'INNER');
        //$arrayIn=array();
        $this->db->where('((day_status = 1 OR day_status = 3) OR day_status IS null) AND ((tbl_mst_calendar.company_date BETWEEN \'' . $dateFrom . '\' AND \'' . $dateTo . '\'))');
        $this->db->order_by('user_name,gps_date,gps_time', 'ASC');
        $query = $this->db->get();
        $result = $query->result_array();
        //echo $this->db->last_query();
        return $result;
    }

    function getBillCount($areaID = null, $dateFrom = null, $dateTo = null) {
        $this->db->select('`audit_user`,`inv_date`,COUNT(DISTINCT(`customer_id`)) AS `bill_count`,SUM(`header_net_value`) as `net_value`,SUM(`total_discount_value`) as `net_discount_value`');
        $this->db->from('`tbl_trans_order_h`');
        $this->db->where(array('`inv_date`>=' => $dateFrom, '`inv_date`<=' => $dateTo));
        $this->db->group_by('`audit_user`,`inv_date`');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function getFirstLastBill($isFirst = 'ASC', $dateFrom = null, $dateTo = null, $user) {
        $this->db->select('`audit_user`,`inv_date`,`inv_time`');
        $this->db->from('`tbl_trans_order_h`');
        $this->db->where(array('`inv_date`>=' => $dateFrom, '`inv_date`<=' => $dateTo, '`audit_user`' => $user));
        $this->db->order_by('`audit_user`,`inv_date`,`inv_time`', $isFirst);
        $this->db->limit(1);
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }

    //GPS DATA TAKING
    function getGpsPath($data) {
        $arrWhere = array(
            '`gps_date`=' => $data['date'], 
            '`gps_time`<=' => $data['time2'].':99',
            '`gps_time`>=' => $data['time1'].':00',
            '`user_name`' => $data['user']
        );
        $this->db->select('`gps_time` AS `time`, `longitude` AS `lon`, `latitude` AS `lat`');
        $this->db->from('`tbl_trans_gps_log`');
        $this->db->where($arrWhere);
        $this->db->order_by('`gps_date`,`gps_time`');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

}

?>