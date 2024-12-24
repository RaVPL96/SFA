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
            $this->db->trans_begin();

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
                        'date_work' => $dateF,
                        'row_unique' => $rr['rep_username'] . '_' . $dateF
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
                    //MADE CALLS 2023-11-27
                    $first_madecall_time = '00:00:00';
                    $last_madecall_time = '00:00:00';
                    $resultMadeCallTime = $this->getFirstLastMadeCall('ASC', $r['gps_date'], $r['gps_date'], $r['user_name']);
                    if (!empty($resultMadeCallTime) && isset($resultMadeCallTime)) {
                        $first_madecall_time = $resultMadeCallTime->visit_time;
                    }
                    $resultMadeCallTime = $this->getFirstLastMadeCall('DESC', $r['gps_date'], $r['gps_date'], $r['user_name']);
                    if (!empty($resultMadeCallTime) && isset($resultMadeCallTime)) {
                        $last_madecall_time = $resultMadeCallTime->visit_time;
                    }
                    
                    $totMadeCalls=0;
                    $totPCalls=0;
                    $totUPCalls=0;
                    
                    $resultMadeCallSummery = $this->getMadeCallSummery( $r['gps_date'], $r['gps_date'], $r['user_name']);
                    if (!empty($resultMadeCallSummery) && isset($resultMadeCallSummery)) {
                        $totMadeCalls = $resultMadeCallSummery->made_call_count;
                        $totPCalls = $resultMadeCallSummery->PC;
                        $totUPCalls = $resultMadeCallSummery->UPC;
                    }

                    if ($resultCount->c >= 1) {//found only updatea						
                        if ($r['day_status'] == 1) {
                            $arrset = array(
                                'check_in' => $r['check_in'],
                                'check_in_distance' => $r['distance'],
                                'checkin_longitude' => $r['g_longitude'],
                                'checkin_latitude' => $r['g_latitude'],
                                'warehouse_latitude' => $r['w_latitude'],
                                'warehouse_longitude' => $r['w_longitude'],
                                'total_bills' => $totBills,
                                'first_madecall_time' => $first_madecall_time,
                                'last_madecall_time' => $last_madecall_time,
                                'first_bill_time' => $first_bill_time,
                                'last_bill_time' => $last_bill_time,
                                'total_sale' => $totalSale,
                                'made_calls'=>$totMadeCalls,
                                'productive_calls'=>$totPCalls,
                                'unproductive_calls'=>$totUPCalls
                                
                            );
                        } elseif ($r['day_status'] == 3) {
                            $arrset = array(
                                'check_out' => $r['check_out'],
                                'check_out_distance' => $r['distance'],
                                'checkout_longitude' => $r['g_longitude'],
                                'checkout_latitude' => $r['g_latitude'],
                                'warehouse_latitude' => $r['w_latitude'],
                                'warehouse_longitude' => $r['w_longitude'],
                                'total_bills' => $totBills,
                                'first_madecall_time' => $first_madecall_time,
                                'last_madecall_time' => $last_madecall_time,
                                'first_bill_time' => $first_bill_time,
                                'last_bill_time' => $last_bill_time,
                                'total_sale' => $totalSale,
                                'made_calls'=>$totMadeCalls,
                                'productive_calls'=>$totPCalls,
                                'unproductive_calls'=>$totUPCalls
                            );
                        } else {
                            $arrset = array(
                                /*
                                  'check_out' => $r['check_out'],
                                  'check_out_distance' => $r['distance'], */
                                'total_bills' => $totBills,
                                'first_madecall_time' => $first_madecall_time,
                                'last_madecall_time' => $last_madecall_time,
                                'first_bill_time' => $first_bill_time,
                                'last_bill_time' => $last_bill_time,
                                'total_sale' => $totalSale,
                                'made_calls'=>$totMadeCalls,
                                'productive_calls'=>$totPCalls,
                                'unproductive_calls'=>$totUPCalls
                            );
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
                            array_merge($arrin, array('check_in' => $r['check_in'], 'check_in_distance' => $r['distance'], 'checkin_longitude' => $r['g_longitude'], 'checkin_latitude' => $r['g_latitude'], 'warehouse_latitude' => $r['w_latitude'], 'warehouse_longitude' => $r['w_longitude']));
                        }
                        if ($r['day_status'] == 3) {
                            array_merge($arrin, array('check_out' => $r['check_out'], 'check_out_distance' => $r['distance'], 'checkout_longitude' => $r['g_longitude'], 'checkout_latitude' => $r['g_latitude'], 'warehouse_latitude' => $r['w_latitude'], 'warehouse_longitude' => $r['w_longitude']));
                        }
                        $this->db->insert('tbl_trans_hr_attendance', $arrin);
                    }
                }
            }
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
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
                $arrUpdate = array();
                if ($sess['grade_id'] == 9) {//RSM ONLY
                    if (!empty($d['comment_rsm'][$user][$userDate]) && isset($d['comment_rsm'][$user][$userDate])) {
                        $attenCommentRSM = $d['comment_rsm'][$user][$userDate];
                    } else {
                        $attenCommentRSM = '';
                    }
                    $arrUpdate = array(
                        '`comment_rsm`' => $attenCommentRSM,
                        '`review_date_rsm`' => date('Y-m-d'),
                        '`review_time_rsm`' => date('H:i:s')
                    );
                } elseif ($sess['grade_id'] == 4) {//ASM ONLY
                    $attenType = $d['type'][$user][$userDate];
                    $attenTypeEvening = $d['type_evening'][$user][$userDate];
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
                        '`attendance_type_evening`' => $attenTypeEvening,
                        '`comment`' => $attenComment,
                        '`trainee_name`' => $trname,
                        '`attendance_type_trainee`' => $attenTypeTrainee,
                        '`review_date`' => date('Y-m-d'),
                        '`review_time`' => date('H:i:s')
                    );
                }

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

    function getAttendanceFinal($dateFrom = null, $dateTo = null, $areaID = null, $territoryID = null, $rangeID = null, $row_id = null) {
        $this->db->select('`tbl_mst_area`.`area_name`,`tbl_mst_territory`.`territory_name`,`tbl_mst_range`.`range_name`,`tbl_trans_hr_attendance`.`id`, `tbl_trans_hr_attendance`.`user_name`, `tbl_trans_hr_attendance`.`date_work`, `check_in`, `check_out`, `check_in_distance`, `check_out_distance`, `total_bills`, `first_madecall_time`, `last_madecall_time`, `first_bill_time`, `last_bill_time`,`expected_first_bill_time`,`is_live`, `total_sale`,`total_shops`, `made_calls`, `productive_calls`, `unproductive_calls`, `reporting_person`, `attendance_type`, `attendance_type_evening`, `comment`, `comment_rsm`, `reporting_person_rsm`, `review_date_rsm`, `review_time_rsm`,`attendance_type_trainee`,`trainee_name`, `review_date`, `review_time`,`checkin_longitude`, `checkin_latitude`, `checkout_longitude`, `checkout_latitude`,`warehouse_longitude`,`warehouse_latitude`');
        $this->db->from('`tbl_trans_hr_attendance`');
        $this->db->join('`tbl_mst_rep_link_territory_agent`', '`tbl_trans_hr_attendance`.`user_name`=`tbl_mst_rep_link_territory_agent`.`rep_username`', 'RIGHT');
        $this->db->join('`tbl_mst_distributor_warehouse`', '`tbl_mst_rep_link_territory_agent`.`agency_stlocation_id`=`tbl_mst_distributor_warehouse`.`id`', 'RIGHT');
        $this->db->join('`tbl_mst_territory`', '`tbl_mst_rep_link_territory_agent`.`territory_id`=`tbl_mst_territory`.`id`', 'LEFT');
        //New demarcation
        //$this->db->join('`tbl_mst_area_link_territory`', '`tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id`', 'LEFT');
        $this->db->join('`tbl_mst_geography`', '`tbl_mst_territory`.`id`=`tbl_mst_geography`.`territory_id` AND `tbl_mst_rep_link_territory_agent`.`range_id`=`tbl_mst_geography`.`range_id`', 'LEFT');
        $this->db->join('`tbl_mst_area`', '`tbl_mst_geography`.`area_id`=`tbl_mst_area`.`id`', 'LEFT');
        $this->db->join('`tbl_mst_range`', '`tbl_mst_rep_link_territory_agent`.`range_id`=`tbl_mst_range`.`id`', 'INNER');
        if ((!empty($dateFrom) && isset($dateFrom) && $dateFrom != null) && (!empty($dateTo) && isset($dateTo) && $dateTo != null)) {
            $this->db->where(array('`date_work`>=' => $dateFrom, '`date_work`<=' => $dateTo));
        }
        if (!empty($areaID) && isset($areaID) && $areaID != null) {
            $this->db->where('`tbl_mst_area`.`id`', $areaID);
        }
        if (!empty($territoryID) && isset($territoryID) && $territoryID != null) {
            $this->db->where('`tbl_mst_territory`.`id`', $territoryID);
        }
        if (!empty($rangeID) && isset($rangeID) && $rangeID != null) {
            $this->db->where('`tbl_mst_range`.`id`', $rangeID);
        }
        if (!empty($row_id) && isset($row_id) && $row_id != null) {
            $this->db->where('`tbl_trans_hr_attendance`.`id`', $row_id);
        }
        $this->db->order_by('`tbl_mst_area`.`area_name`,`tbl_mst_range`.`range_name`,`tbl_mst_territory`.`territory_name`');
        $query = $this->db->get();
        $result = $query->result_array();
        //echo $this->db->last_query();
        return $result;
    }
    
    function getAttendanceFinalSummery($dateFrom = null, $dateTo = null, $areaID = null, $territoryID = null, $rangeID = null, $row_id = null) {
        $this->db->select('`tbl_mst_area`.`area_name`, `tbl_mst_territory`.`territory_name`, `tbl_mst_range`.`range_name`, `tbl_trans_hr_attendance`.`user_name`, COUNT(DISTINCT(tbl_trans_hr_attendance.id)) AS WD,SEC_TO_TIME(SUM(IF(`check_in`>\'08:00:00\', (TIME_TO_SEC(`check_in`)-TIME_TO_SEC("08:00:00")), 0))) AS check_in_delay, SEC_TO_TIME(SUM(IF(`last_bill_time`<\'16:00:00\', (TIME_TO_SEC("16:00:00")-TIME_TO_SEC(`last_bill_time`)), 0))) AS last_bill_delay,  SUM(`total_bills`) as total_bills,  SUM(`total_sale`) AS total_sale');
        $this->db->from('`tbl_trans_hr_attendance`');
        $this->db->join('`tbl_mst_rep_link_territory_agent`', '`tbl_trans_hr_attendance`.`user_name`=`tbl_mst_rep_link_territory_agent`.`rep_username`', 'RIGHT');
        $this->db->join('`tbl_mst_distributor_warehouse`', '`tbl_mst_rep_link_territory_agent`.`agency_stlocation_id`=`tbl_mst_distributor_warehouse`.`id`', 'RIGHT');
        $this->db->join('`tbl_mst_territory`', '`tbl_mst_rep_link_territory_agent`.`territory_id`=`tbl_mst_territory`.`id`', 'LEFT');
        //New demarcation
        //$this->db->join('`tbl_mst_area_link_territory`', '`tbl_mst_territory`.`id`=`tbl_mst_area_link_territory`.`territory_id`', 'LEFT');
        $this->db->join('`tbl_mst_geography`', '`tbl_mst_territory`.`id`=`tbl_mst_geography`.`territory_id` AND `tbl_mst_rep_link_territory_agent`.`range_id`=`tbl_mst_geography`.`range_id`', 'LEFT');
        $this->db->join('`tbl_mst_area`', '`tbl_mst_geography`.`area_id`=`tbl_mst_area`.`id`', 'LEFT');
        $this->db->join('`tbl_mst_range`', '`tbl_mst_rep_link_territory_agent`.`range_id`=`tbl_mst_range`.`id`', 'INNER');
        if ((!empty($dateFrom) && isset($dateFrom) && $dateFrom != null) && (!empty($dateTo) && isset($dateTo) && $dateTo != null)) {
            $this->db->where(array('`date_work`>=' => $dateFrom, '`date_work`<=' => $dateTo));
        }
        if (!empty($areaID) && isset($areaID) && $areaID != null) {
            $this->db->where('`tbl_mst_area`.`id`', $areaID);
        }
        if (!empty($territoryID) && isset($territoryID) && $territoryID != null) {
            $this->db->where('`tbl_mst_territory`.`id`', $territoryID);
        }
        if (!empty($rangeID) && isset($rangeID) && $rangeID != null) {
            $this->db->where('`tbl_mst_range`.`id`', $rangeID);
        }
        if (!empty($row_id) && isset($row_id) && $row_id != null) {
            $this->db->where('`tbl_trans_hr_attendance`.`id`', $row_id);
        }
        $this->db->where(array(
            '`check_in`<>'=>'00:00:00',
            '`last_bill_time` <>' =>  '00:00:00'));
        $this->db->group_by('`tbl_mst_area`.`area_name`, `tbl_mst_territory`.`territory_name`, `tbl_mst_range`.`range_name`, `tbl_trans_hr_attendance`.`user_name`');
        $this->db->order_by('`tbl_mst_area`.`area_name`,`tbl_mst_range`.`range_name`,`tbl_mst_territory`.`territory_name`');
        $query = $this->db->get();
        $result = $query->result_array();
        //echo $this->db->last_query();
        return $result;
    }

    function getTimeAttendance($areaID = null, $dateFrom = null, $dateTo = null) {
        $this->db->select('user_name,gps_date,gps_time,day_status,if(day_status=1,gps_time,\'-\') AS `check_in`,if(day_status=3,gps_time,\'-\') AS `check_out`,battery_level,(6371*acos(cos(radians(tbl_mst_distributor_warehouse.latitude))*cos(radians(tbl_trans_gps_log.latitude))*cos(radians(tbl_trans_gps_log.longitude)-radians(tbl_mst_distributor_warehouse.longitude))+sin(radians(tbl_mst_distributor_warehouse.latitude))*sin(radians(tbl_trans_gps_log.latitude))))as distances, 3956*2*ASIN(SQRT(POWER(SIN((tbl_mst_distributor_warehouse.latitude-abs(tbl_trans_gps_log.latitude))*pi()/180/2),2)+COS(tbl_mst_distributor_warehouse.latitude*pi()/180)*COS(abs(tbl_trans_gps_log.latitude)*pi()/180)*POWER(SIN((tbl_mst_distributor_warehouse.longitude-tbl_trans_gps_log.longitude)*pi()/180/2),2))) as distance,tbl_trans_gps_log.longitude AS g_longitude,tbl_trans_gps_log.latitude AS g_latitude,tbl_mst_distributor_warehouse.latitude AS w_latitude,tbl_mst_distributor_warehouse.longitude AS w_longitude');
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
    
    function getFirstLastMadeCall($isFirst = 'ASC', $dateFrom = null, $dateTo = null, $user) {
        $this->db->select('`user_id`,`visit_date`,`visit_time`');
        $this->db->from('`tbl_trans_visit_log`');
        $this->db->where(array('`visit_date`>=' => $dateFrom, '`visit_date`<=' => $dateTo, '`user_id`' => $user));
        $this->db->order_by('`user_id`,`visit_date`,`visit_time`', $isFirst);
        $this->db->limit(1);
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }

    //MADE CALL SUMMERY
    function getMadeCallSummery($dateFrom = null, $dateTo = null, $user){
        $query=$this->db->query('SELECT T.user_id, T.visit_date, COUNT(T.made_calls) AS made_call_count,COUNT(T.productive_outlets) AS PC,COUNT(T.unproductive_outlets) AS UPC  FROM (SELECT m.user_id, m.visit_date, m.outlet_id AS made_calls,p.productive_outlets,u.unproductive_outlets,m.app_inv_no
FROM `tbl_trans_visit_log` m 
LEFT JOIN (SELECT user_id, visit_date, outlet_id AS productive_outlets FROM `tbl_trans_visit_log`  WHERE  is_productive=1 GROUP BY user_id, visit_date, outlet_id) p ON m.outlet_id=p.productive_outlets AND m.visit_date=p.visit_date AND m.user_id=p.user_id
LEFT JOIN (SELECT user_id, visit_date, outlet_id AS unproductive_outlets FROM `tbl_trans_visit_log` WHERE  is_productive=0 AND (user_id, outlet_id ,visit_date) NOT IN (SELECT user_id, outlet_id, visit_date FROM `tbl_trans_visit_log` WHERE is_productive=1 GROUP BY user_id, visit_date, outlet_id) GROUP BY user_id, visit_date, outlet_id) u ON m.outlet_id=u.unproductive_outlets AND m.visit_date=u.visit_date AND m.user_id=u.user_id GROUP BY m.user_id, m.visit_date, m.outlet_id) T WHERE T.visit_date>=\''.$dateFrom.'\' AND T.visit_date<=\''.$dateTo.'\' AND T.user_id=\''.$user.'\' GROUP BY T.user_id, T.visit_date');
         
        $result = $query->row();
        return $result;
    }
    //GPS DATA TAKING
    function getGpsPath($data) {
        $arrWhere = array(
            '`gps_date`=' => $data['date'],
            '`gps_time`<=' => $data['time2'] . ':99',
            '`gps_time`>=' => $data['time1'] . ':00',
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

    //GET REPORT 
    function calActualWorkings($fromDate, $toDate) {
        $isInserted = 1;

        //REMOVE OLD DATA
        $arrDel = array(
            'calendarDate>=' => $fromDate,
            'calendarDate<=' => $toDate
        );
        $this->db->where($arrDel);
        $this->db->delete('`tbl_mst_rep_calendar`');

        $this->db->select('invh`.`ag_cd`,`invh`.`cd`,`invh`.`date_actual`');
        $this->db->from('`invh`');
        //$this->db->join('`invh`', '`invd`.`invno`=`invh`.`invno`', 'INNER');
        $arr = array(
            'invh.tot_a_val<>' => 0,
            'invh.b_a' => 'A',
            'invh.date_actual>=' => $fromDate,
            'invh.date_actual<=' => $toDate
        );
        $this->db->where($arr);
        $this->db->group_by('invh.ag_cd,invh.cd,invh.date_actual');
        $this->db->order_by('invh.ag_cd,invh.cd,invh.date_actual');
        $q = $this->db->get();
        $result = $q->result_array();
        if (!empty($result) && isset($result)) {
            $this->db->trans_begin();
            foreach ($result as $a) {
                $this->db->select('`id`,`unique_ref`, `ag_code`, `range_name`, `calendarDate`, `is_working`, `working_count`, `is_finalized`');
                $this->db->from('`tbl_mst_rep_calendar`');
                $arrW = array(
                    'ag_code' => $a['ag_cd'],
                    'range_name' => $a['cd'],
                    'calendarDate' => $a['date_actual']
                );
                $this->db->where($arrW);
                $this->db->limit(1);
                $qrep = $this->db->get();
                $result_rep = $qrep->row();
                $unique_ref = $a['ag_cd'] . '_' . $a['cd'] . '_' . $a['date_actual'];

                if (!empty($result_rep) && isset($result_rep) && $result_rep->unique_ref == $unique_ref) {//records created for this rep for actual working days
                    //check finalized or not if not is finalized update 
                    if ($result_rep->is_finalized != 1) {
                        $update = array(
                            'is_working' => 1,
                            'working_count' => 1
                        );
                        $this->db->where($arrW);
                        $this->db->update('`tbl_mst_rep_calendar`', $update);
                    }
                } else {//no record so create new one
                    $insert = array(
                        '`unique_ref`' => $unique_ref,
                        '`ag_code`' => $a['ag_cd'],
                        '`range_name`' => $a['cd'],
                        '`calendarDate`' => $a['date_actual'],
                        '`is_working`' => 1,
                        '`working_count`' => 1,
                        '`is_finalized`' => 0
                    );
                    $this->db->insert('`tbl_mst_rep_calendar`', $insert);
                }
            }
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $isInserted = 0;
            } else {
                $this->db->trans_commit();
            }
        }
        return $isInserted;
    }

    function getRepActualDayCount($from, $to) {
        $arrWhere = array(
            '`calendarDate`>=' => $from,
            '`calendarDate`<=' => $to,
        );
        $this->db->select('`ag_code`, `range_name`, SUM(`working_count`) AS `actual_working_count`');
        $this->db->from('`tbl_mst_rep_calendar`');
        $this->db->where($arrWhere);
        $this->db->group_by('`ag_code`,`range_name`');
        $this->db->order_by('`ag_code`, `range_name`');
        $query = $this->db->get();
        $result = $query->result_array();
        //echo $this->db->last_query();
        return $result;
    }

    //cron cal selected promotion slab for a shop depend on sale 
    function calSchemaSlab($territory_id, $range_id, $scheme_id) {
        //read sales base from tbl_promo_sch_trans_outlet_base
        $this->db->select('`tbl_promo_sch_trans_outlet_base`.`id`, `tbl_promo_sch_trans_outlet_base`.`outlet_id`, `channel_id`, `range_id`, `range_name`, `outlet_id_range_name`, `outlet_sale_value`');
        $this->db->from('`tbl_promo_sch_trans_outlet_base`');
        $this->db->join('`tbl_mst_outlet`', '`tbl_promo_sch_trans_outlet_base`.`outlet_id`=`tbl_mst_outlet`.`reference_code`', 'INNER');
        $this->db->join('`tbl_mst_route_link_outlet`', '`tbl_mst_outlet`.`id`=`tbl_mst_route_link_outlet`.`outlet_id`', 'INNER');
        $this->db->join('`tbl_mst_route`', '`tbl_mst_route_link_outlet`.`route_id`=`tbl_mst_route`.`id`', 'INNER');
        $this->db->join('`tbl_mst_territory_link_route`', '`tbl_mst_route`.`id`=`tbl_mst_territory_link_route`.`route_id`', 'INNER');
        $this->db->where('`tbl_mst_territory_link_route`.`territory_id`', $territory_id);
        $this->db->where('range_id', $range_id);
        //$this->db->limit(1000);
        $this->db->order_by('`outlet_sale_value`');
        $query = $this->db->get();
        $result = $query->result_array();
        echo $this->db->last_query();
        //$this->db->trans_begin();
        $isInserted = 1;
        foreach ($result as $r) {
            $this->db->select('`tbl_promo_sch`.`id`,`tbl_promo_sch`.`name`,`tbl_promo_sch_operations`.`channel_id`,`tbl_promo_sch_operations`.`range_id`,`tbl_promo_sch_slab`.`id` AS `slab_id`,`tbl_promo_sch_slab`.`min_range`,`tbl_promo_sch_slab`.`max_range`');
            $this->db->from('`tbl_promo_sch`');
            $this->db->join('`tbl_promo_sch_operations`', '`tbl_promo_sch`.`id`=`tbl_promo_sch_operations`.`scheme_id`', 'INNER');
            $this->db->join('`tbl_promo_sch_slab`', '`tbl_promo_sch_operations`.`range_id`=`tbl_promo_sch_slab`.`range_id` AND `tbl_promo_sch_operations`.`scheme_id`= `tbl_promo_sch_slab`.`scheme_id`');
            $arrW = array(
                '`tbl_promo_sch_operations`.`channel_id`' => $r['channel_id'],
                '`tbl_promo_sch`.`id`' => $scheme_id,
                '`tbl_promo_sch_operations`.`range_id`' => $range_id,
                '`tbl_promo_sch_slab`.`min_range`<' => $r['outlet_sale_value'],
                '`tbl_promo_sch_slab`.`max_range`>=' => $r['outlet_sale_value']
            );
            $this->db->where($arrW);
            $this->db->order_by('`tbl_promo_sch_operations`.`channel_id`,`tbl_promo_sch_operations`.`range_id`, `tbl_promo_sch`.`id`,`tbl_promo_sch_slab`.`min_range`,`tbl_promo_sch_slab`.`max_range`');
            $query_schemas_slab = $this->db->get();
            $result_schemas_slab = $query_schemas_slab->result_array();
            //echo $this->db->last_query();
            foreach ($result_schemas_slab as $s) {
                if ($r['range_id'] == $s['range_id'] && $r['outlet_sale_value'] >= $s['min_range'] && $r['outlet_sale_value'] <= $s['max_range']) {//range and value in the slab so add to table tbl_promo_sch_trans_outlet_slabs
                    $arrIn = array(
                        '`outlet_id`' => $r['outlet_id'],
                        '`range_id`' => $r['range_id'],
                        '`range_name`' => $r['range_name'],
                        '`scheme_id`' => $s['id'],
                        '`slab_id`' => $s['slab_id'],
                        '`sale_value`' => $r['outlet_sale_value'],
                        '`is_accepted`' => 0
                    );
                    //check same value exists with out outlet owner not accepted scheme
                    $arrInWhere = array(
                        '`outlet_id`' => $r['outlet_id'],
                        '`range_id`' => $r['range_id'],
                        '`range_name`' => $r['range_name'],
                        '`scheme_id`' => $s['id'],
                        '`slab_id`' => $s['slab_id']
                    );
                    $this->db->select('COUNT(id) AS total');
                    $this->db->from('tbl_promo_sch_trans_outlet_slabs');
                    $this->db->where($arrInWhere);
                    $query_schemas_slab_count = $this->db->get();
                    $re = $query_schemas_slab_count->row();
                    //echo $this->db->last_query();
                    if ($re->total >= 1) {//record already exists
                        //noneed to insert
                    } else {
                        $this->db->insert('`tbl_promo_sch_trans_outlet_slabs`', $arrIn);
                        if ($this->db->trans_status() === FALSE) {
                            //$this->db->trans_rollback();
                            $isInserted = 0;
                        }
                    }
                    //break; //break no need to run inner loop
                }
            }
        }
        if ($isInserted == 0) {
            $this->db->trans_rollback();
            $isInserted = 0;
        } else {
            $this->db->trans_commit();
        }
        return $isInserted;
    }

    //calcualte target data
    //for rata sawari - C range
    function calPromoTarget($territory_id, $scheme_id, $range_id) {
        $this->db->select('`a`.`id`, `a`.`sale_value`,`a`.`outlet_id`, `a`.`channel_id`, `a`.`range_id`, `a`.`range_name`, `a`.`scheme_id`, `a`.`slab_id`, `a`.`is_accepted`,`b`.`min_range`,`b`.`max_range`');
        $this->db->from('`tbl_promo_sch_trans_outlet_slabs` AS `a`');
        $this->db->join('`tbl_promo_sch_slab` AS `b`', '`a`.`scheme_id`=`b`.`scheme_id` AND `a`.`slab_id`=`b`.`id` AND `a`.`range_id`=`b`.`range_id`', 'INNER');
        //$this->db->join('`tbl_promo_sch_trans_outlet_base` AS `c`','`a`.`outlet_id`=`c`.`outlet_id` AND `a`.`range_id`=`c`.`range_id`','INNER');
        $this->db->join('`tbl_mst_outlet`', '`a`.`outlet_id`=`tbl_mst_outlet`.`reference_code`', 'INNER');
        $this->db->join('`tbl_mst_route_link_outlet`', '`tbl_mst_outlet`.`id`=`tbl_mst_route_link_outlet`.`outlet_id`', 'INNER');
        $this->db->join('`tbl_mst_route`', '`tbl_mst_route_link_outlet`.`route_id`=`tbl_mst_route`.`id`', 'INNER');
        $this->db->join('`tbl_mst_territory_link_route`', '`tbl_mst_route`.`id`=`tbl_mst_territory_link_route`.`route_id`', 'INNER');
        $this->db->where('`tbl_mst_territory_link_route`.`territory_id`', $territory_id);

        $this->db->where('`a`.`scheme_id`', $scheme_id);
        $this->db->where('`a`.`range_id`', $range_id);
        $query = $this->db->get();
        $result = $query->result_array();
        //echo $this->db->last_query();
        //die();

        foreach ($result as $r) {
            $totalTarget = 0;
            $four_month_target = 0;
            $march_target = 0;
            $decTarget = 0;
            $febTarget = 0;
            $marchTarget = 0;
            $str = 'Base Sale:     Rs. ' . number_format($r['sale_value']) . ' \n ';
            if ($range_id == 1) {//C OPERATION
                if ($scheme_id == 1) {//RATA SAWARI
                    if ($r['sale_value'] <= 0) {//sale less than 0= new shops
                        $four_month_target = 1000000 * 4;
                        $march_target = 1000000;
                        $totalTarget = 5000000;
                    } else if ($r['min_range'] == 1 and $r['max_range'] == 249999) {//sale less than 249,999
                        // 4 month target           * 1%
                        $four_month_target = ($r['sale_value'] * 4) * 1;
                        $march_target = 1500000;

                        if ($four_month_target < 3500000) {
                            $four_month_target = 3500000;
                        }
                    } else if ($r['min_range'] == 250000 and $r['max_range'] == 999999) {//sale 250,000 – Rs.999,999
                        // 4 month target           * 50%
                        $four_month_target = ($r['sale_value'] * 4) * 1.5;
                        $march_target = ($four_month_target / 2) * 0.75;
                        if ($march_target < 1500000) {
                            $march_target = 1500000;
                        }
                        if ($four_month_target < 4000000) {
                            $four_month_target = 4000000;
                        }
                    } else if ($r['min_range'] == 1000000 and $r['max_range'] == 1249999) {//sale Rs.1,000,000 – Rs.1,249,999
                        // 4 month target           * 45%
                        $four_month_target = ($r['sale_value'] * 4) * 1.45;
                        $march_target = ($four_month_target / 2) * 0.75;
                        if ($march_target < 1687500) {
                            $march_target = 1687500;
                        }
                        if ($four_month_target < 4500000) {
                            $four_month_target = 4500000;
                        }
                    } else if ($r['min_range'] == 1250000 and $r['max_range'] == 1499999) {//sale Rs.1,250,000 – Rs.1,499,999
                        // 4 month target           * 40%
                        $four_month_target = ($r['sale_value'] * 4) * 1.40;
                        $march_target = ($four_month_target / 2) * 0.75;
                        if ($march_target < 1875000) {
                            $march_target = 1875000;
                        }
                        if ($four_month_target < 5000000) {
                            $four_month_target = 5000000;
                        }
                    } else if ($r['min_range'] == 1500000 and $r['max_range'] == 1749999) {//sale Rs.1,500,000 – Rs.1,749,999
                        // 4 month target           * 35%
                        $four_month_target = ($r['sale_value'] * 4) * 1.35;
                        $march_target = ($four_month_target / 2) * 0.75;
                        if ($march_target < 2250000) {
                            $march_target = 2250000;
                        }
                        if ($four_month_target < 6000000) {
                            $four_month_target = 6000000;
                        }
                    } else if ($r['min_range'] == 1750000 and $r['max_range'] == 1999999) {//sale Rs.1,750,000 – Rs.1,999,999
                        // 4 month target           * 25%
                        $four_month_target = ($r['sale_value'] * 4) * 1.25;
                        $march_target = ($four_month_target / 2) * 0.75;
                        if ($march_target < 2625000) {
                            $march_target = 2625000;
                        }
                        if ($four_month_target < 7000000) {
                            $four_month_target = 7000000;
                        }
                    } else if ($r['min_range'] == 2000000 and $r['max_range'] == 999000000) {//sale Above Rs.2,000,000
                        // 4 month target           * 20%
                        $four_month_target = ($r['sale_value'] * 4) * 1.20;
                        $march_target = ($four_month_target / 2) * 0.75;
                        if ($march_target < 3000000) {
                            $march_target = 3000000;
                        }
                        if ($four_month_target < 8000000) {
                            $four_month_target = 8000000;
                        }
                    }
                } else if ($scheme_id == 2) { //RAKSHANAWARANAYA
                    if ($r['sale_value'] <= 49999) {//sale Below Rs.49,999
                        $four_month_target = 400000;
                        $march_target = 150000;
                        $totalTarget = 550000;
                    } else if ($r['min_range'] == 50000 and $r['max_range'] == 99999) {//Rs.50,000 - Rs.99,999
                        $four_month_target = ($r['sale_value'] * 4) * 1.6;
                        $march_target = ($four_month_target / 2) * 0.75;
                        if ($march_target < 187500) {
                            $march_target = 187500;
                        }
                        if ($four_month_target < 500000) {
                            $four_month_target = 500000;
                        }
                    } else if ($r['min_range'] == 100000 and $r['max_range'] == 249999) {//Rs.100,000 - Rs. 249,999
                        $four_month_target = ($r['sale_value'] * 4) * 1.5;
                        $march_target = ($four_month_target / 2) * 0.75;
                        if ($march_target < 262500) {
                            $march_target = 262500;
                        }
                        if ($four_month_target < 700000) {
                            $four_month_target = 700000;
                        }
                    } else if ($r['min_range'] == 250000 and $r['max_range'] == 999000000) {//Above Rs. 250,000
                        $four_month_target = ($r['sale_value'] * 4) * 1.4;
                        $march_target = ($four_month_target / 2) * 0.75;
                        if ($march_target < 375000) {
                            $march_target = 375000;
                        }
                        if ($four_month_target < 1000000) {
                            $four_month_target = 1000000;
                        }
                    }
                }

                $totalTarget = $march_target + $four_month_target;
                $decTarget = $totalTarget * 0.3;
                $febTarget = $totalTarget * 0.6;
                $marchTarget = $totalTarget * 1;
                $str .= 'Total Target             :Rs. ' . number_format($totalTarget) . ' \n ';
                $str .= 'by December 31st Target (30%)  :Rs. ' . number_format($decTarget) . ' \n ';
                $str .= 'by Feb 28th Target (60%)      :Rs. ' . number_format($febTarget) . ' \n ';
                $str .= 'by March 31st Target (100%)    :Rs. ' . number_format($marchTarget) . ' \n ';

                $str .= '* Other Conditions  \n ';
                $str .= '- Total target should be achieved  \n ';
                $str .= '- Soya, Devani Betha and Nenaposha should be 50% of total target and minimum 6 categories included to the achievement  \n ';
                $str .= '- Market Return allowed only 1.25%  \n ';
            } else if ($range_id == 2) { //D OPERATION
                if ($scheme_id == 1) {//RATA SAWARI
                    if ($r['sale_value'] <= 0) {//sale less than 0= new shops
                        $four_month_target = 1000000 * 4;
                        $march_target = 1000000;
                        $totalTarget = 5000000;
                    } else if ($r['min_range'] == 1 and $r['max_range'] == 249999) {
                        // 4 month target           * 1%
                        $four_month_target = ($r['sale_value'] * 4) * 1;
                        $march_target = 1000000;

                        if ($four_month_target < 3000000) {
                            $four_month_target = 3000000;
                        }
                    } else if ($r['min_range'] == 250000 and $r['max_range'] == 999999) {//sale 250,000 – Rs.999,999
                        // 4 month target           * 50%
                        $four_month_target = ($r['sale_value'] * 4) * 1.5;
                        $march_target = ($four_month_target / 2) * 0.75;
                        if ($march_target < 1000000) {
                            $march_target = 1000000;
                        }
                        if ($four_month_target < 3500000) {
                            $four_month_target = 3500000;
                        }
                    } else if ($r['min_range'] == 1000000 and $r['max_range'] == 1249999) {//sale Rs.1,000,000 – Rs.1,249,999
                        // 4 month target           * 45%
                        $four_month_target = ($r['sale_value'] * 4) * 1.45;
                        $march_target = ($four_month_target / 2) * 0.75;
                        if ($march_target < 1200000) {
                            $march_target = 1200000;
                        }
                        if ($four_month_target < 4000000) {
                            $four_month_target = 4000000;
                        }
                    } else if ($r['min_range'] == 1250000 and $r['max_range'] == 1499999) {//sale Rs.1,250,000 – Rs.1,499,999
                        // 4 month target           * 40%
                        $four_month_target = ($r['sale_value'] * 4) * 1.40;
                        $march_target = ($four_month_target / 2) * 0.75;
                        if ($march_target < 1500000) {
                            $march_target = 1500000;
                        }
                        if ($four_month_target < 5000000) {
                            $four_month_target = 5000000;
                        }
                    } else if ($r['min_range'] == 1500000 and $r['max_range'] == 1749999) {//sale Rs.1,500,000 – Rs.1,749,999
                        // 4 month target           * 35%
                        $four_month_target = ($r['sale_value'] * 4) * 1.35;
                        $march_target = ($four_month_target / 2) * 0.75;
                        if ($march_target < 1800000) {
                            $march_target = 1800000;
                        }
                        if ($four_month_target < 6000000) {
                            $four_month_target = 6000000;
                        }
                    } else if ($r['min_range'] == 1750000 and $r['max_range'] == 1999999) {//sale Rs.1,750,000 – Rs.1,999,999
                        // 4 month target           * 25%
                        $four_month_target = ($r['sale_value'] * 4) * 1.25;
                        $march_target = ($four_month_target / 2) * 0.75;
                        if ($march_target < 2100000) {
                            $march_target = 2100000;
                        }
                        if ($four_month_target < 7000000) {
                            $four_month_target = 7000000;
                        }
                    } else if ($r['min_range'] == 2000000 and $r['max_range'] == 999000000) {//sale Above Rs.2,000,000
                        // 4 month target           * 20%
                        $four_month_target = ($r['sale_value'] * 4) * 1.20;
                        $march_target = ($four_month_target / 2) * 0.75;
                        if ($march_target < 2400000) {
                            $march_target = 2400000;
                        }
                        if ($four_month_target < 8000000) {
                            $four_month_target = 8000000;
                        }
                    }
                } else if ($scheme_id == 2) { //RAKSHANAWARANAYA
                    if ($r['sale_value'] <= 49999) {//sale Below Rs.49,999
                        $four_month_target = 400000;
                        $march_target = 120000;
                        $totalTarget = 520000;
                    } else if ($r['min_range'] == 50000 and $r['max_range'] == 99999) {//Rs.50,000 - Rs.99,999
                        $four_month_target = ($r['sale_value'] * 4) * 1.5;
                        $march_target = ($four_month_target / 2) * 0.75;
                        if ($march_target < 150000) {
                            $march_target = 150000;
                        }
                        if ($four_month_target < 500000) {
                            $four_month_target = 500000;
                        }
                    } else if ($r['min_range'] == 100000 and $r['max_range'] == 249999) {//Rs.100,000 - Rs. 249,999
                        $four_month_target = ($r['sale_value'] * 4) * 1.4;
                        $march_target = ($four_month_target / 2) * 0.75;
                        if ($march_target < 210000) {
                            $march_target = 210000;
                        }
                        if ($four_month_target < 700000) {
                            $four_month_target = 700000;
                        }
                    } else if ($r['min_range'] == 250000 and $r['max_range'] == 999000000) {//Above Rs. 250,000
                        $four_month_target = ($r['sale_value'] * 4) * 1.3;
                        $march_target = ($four_month_target / 2) * 0.75;
                        if ($march_target < 300000) {
                            $march_target = 300000;
                        }
                        if ($four_month_target < 1000000) {
                            $four_month_target = 1000000;
                        }
                    }
                }
                $totalTarget = $march_target + $four_month_target;
                $decTarget = $totalTarget * 0.3;
                $febTarget = $totalTarget * 0.6;
                $marchTarget = $totalTarget * 1;
                $str .= 'Total Target             :Rs. ' . number_format($totalTarget) . ' \n ';
                $str .= 'by December 31st Target (30%)  :Rs. ' . number_format($decTarget) . ' \n ';
                $str .= 'by Feb 28th Target (60%)      :Rs. ' . number_format($febTarget) . ' \n ';
                $str .= 'by March 31st Target (100%)    :Rs. ' . number_format($marchTarget) . ' \n ';

                $str .= '* Other Conditions  \n ';
                $str .= '- Total target should be achieved  \n ';
                $str .= '- Minimum 3 categories included to the achievement  \n ';
                $str .= '- Market Return allowed only 1.25%  \n ';
            } else if ($range_id == 4) { //BAKERY OPERATION
                $totalTarget = 7000000; //$march_target + $four_month_target;
                $decTarget = $totalTarget * 0.3;
                $febTarget = $totalTarget * 0.6;
                $marchTarget = $totalTarget * 1;
                $str .= 'Total Target             :Rs. ' . number_format($totalTarget) . ' \n ';
                $str .= 'by December 31st Target (30%)  :Rs. ' . number_format($decTarget) . ' \n ';
                $str .= 'by Feb 28th Target (60%)      :Rs. ' . number_format($febTarget) . ' \n ';
                $str .= 'by March 31st Target (100%)    :Rs. ' . number_format($marchTarget) . ' \n ';
            }


            $arrUp = array(
                'condition' => $str,
                'target_1' => $totalTarget,
                'target_2' => $decTarget,
                'target_3' => $febTarget,
                'target_4' => $marchTarget
            );
            $this->db->where('`id`', $r['id']);
            $this->db->update('`tbl_promo_sch_trans_outlet_slabs`', $arrUp);
            echo $this->db->last_query();
            //die();
        }
        echo 'ok';
    }

}

?>