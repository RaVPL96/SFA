<?php

/*
 * This system Licenced to Raigam Marketing Services (Pvt) Ltd.
 * Developed By: Lakshitha Pradeep Karunarathna  *
 * Company: Serving Cloud INC in association with MyOffers.lk  *
 * Date Started:  October 20, 2017  *
 */

class SaleBookingModule extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        //$this->mssql = $this->load->database('MSSQL', TRUE);
    }

    function getCategoryList($purpose_id, $cat_id = null)
    {
        $this->db->select(
            "`tbl_mst_item_category`.`id`, `tbl_mst_item_category`.`name`, `tbl_mst_item_category`.`valid_from`, `tbl_mst_item_category`.`valid_to`, `tbl_mst_item_category`.`isact`,bg_color,font_color,ranges"
        );
        $this->db->from("tbl_mst_item_category");
        $this->db->join(
            "tbl_mst_item_category_purpose_link_category",
            "tbl_mst_item_category.id=tbl_mst_item_category_purpose_link_category.category_id",
            "INNER"
        );
        $this->db->join(
            "tbl_mst_item_category_purpose",
            "tbl_mst_item_category_purpose_link_category.purpose_id=tbl_mst_item_category_purpose.id",
            "INNER"
        );
        $this->db->where("`tbl_mst_item_category_purpose`.`id`", $purpose_id);
        if (!empty($cat_id) && isset($cat_id) && $cat_id != null) {
            $this->db->where("`tbl_mst_item_category`.`id`", $cat_id);
        }
        $queryData = $this->db->get();
        if (!empty($cat_id) && isset($cat_id) && $cat_id != null) {
            $resultData = $queryData->row();
        } else {
            $resultData = $queryData->result_array();
        }
        //echo $this->db->last_query().'<br>';
        //die();
        return $resultData;
    }

    function getCompanyWorkingDays($dateFrom, $dateTo)
    {
        $this->db->select("`company_date`, `is_working`");
        $this->db->from("tbl_mst_calendar");
        $this->db->where("company_date>=", $dateFrom);
        $this->db->where("company_date<=", $dateTo);
        $queryData = $this->db->get();
        $resultData = $queryData->result_array();
        return $resultData;
    }

    function getTotalSalesandPcCategoryNewDemarcation(
        $area = null,
        $range = null,
        $datepickermonth = null,
        $category = null,
        $bookingAct = "A"
    ) {
        $str = "";
        if (!empty($area) && isset($area) && $area != null && $area != -1) {
            $str .= " AND tbl_mst_area.id=" . $area . " ";
        }
        if (!empty($range) && isset($range) && $range != null && $range != -1) {
            if ($range == "D") {
                $str .=
                    ' AND (tbl_mst_range.range_name=\'' .
                    $range .'\' OR tbl_mst_range.range_name=\'S\' OR tbl_mst_range.range_name=\'T\') ';
            } else {
                $str .= ' AND (tbl_mst_range.range_name=\'' . $range . '\' OR tbl_mst_range.range_name=\'S\') ';
            }
        }

        $qtyStri = ' AND tbl_trans_order_h.inv_type=\'' . $bookingAct . '\' ';
        // if ($bookingAct == "B") {
        //     $qtyStri = "";
        // }

        $strBack = "";
        for ($k = 1; $k <= 6; $k++) {
            $monthNumberBack = date(
                "m",
                strtotime($datepickermonth . " -" . $k . " month")
            );
            $monthNameBack = date(
                "F",
                strtotime($datepickermonth . " -" . $k . " month")
            );
            $yearBack = date(
                "Y",
                strtotime($datepickermonth . " -" . $k . " month")
            );
            $strBack .=
                "COUNT(IF(month(a.dates)=" .
                $monthNumberBack .
                " AND year(a.dates)=" .
                $yearBack .
                ", a.dates,null)) as " .
                $monthNameBack .
                "_WD, SUM(IF(month(a.dates)=" .
                $monthNumberBack .
                " AND year(a.dates)=" .
                $yearBack .
                ", a.pc,0)) as " .
                $monthNameBack .
                "_TotPC ,";
        }
        //removed this from bottom before INNER JOIN agency_mst ON invh.ag_cd=agency_mst.ag_cd
        //INNER JOIN shop_mst ON invh.ag_cd=shop_mst.sh_ag_cd AND invh.ro_cd=shop_mst.sh_ro_cd AND invh.sh_cd=shop_mst.sh_cd

        $query =
            'select  
            ' .
            $strBack .
            '
            a.ag_cd
from (SELECT tbl_mst_territory.reference_code AS ag_cd,tbl_trans_order_h.inv_date AS dates, COUNT(DISTINCT tbl_mst_outlet.id) AS pc
FROM tbl_trans_order_h 

INNER JOIN tbl_trans_order_d ON tbl_trans_order_h.app_inv_no = tbl_trans_order_d.app_inv_no
INNER JOIN tbl_mst_item ON tbl_trans_order_d.item_code=tbl_mst_item.item
INNER JOIN tbl_mst_item_category_link_item ON tbl_mst_item.item=tbl_mst_item_category_link_item.item_id
INNER JOIN tbl_mst_item_category ON tbl_mst_item_category_link_item.category_id=tbl_mst_item_category.id
INNER JOIN tbl_mst_item_category_purpose_link_category ON tbl_mst_item_category.id=tbl_mst_item_category_purpose_link_category.category_id
INNER JOIN tbl_mst_item_category_purpose ON tbl_mst_item_category_purpose_link_category.purpose_id=tbl_mst_item_category_purpose.id
INNER JOIN tbl_mst_outlet ON tbl_trans_order_h.customer_id=tbl_mst_outlet.id 

INNER JOIN tbl_mst_territory ON tbl_trans_order_h.territory_id=`tbl_mst_territory`.`id`
INNER JOIN tbl_mst_range ON tbl_trans_order_h.range_id=tbl_mst_range.id
INNER JOIN tbl_mst_geography ON tbl_mst_territory.id=tbl_mst_geography.territory_id AND tbl_mst_geography.range_id=tbl_mst_range.id
INNER JOIN tbl_mst_area ON tbl_mst_geography.area_id=tbl_mst_area.id

WHERE tbl_trans_order_d.actual_qty<>0 AND tbl_mst_item_category_purpose.id=3 AND tbl_mst_item_category.id=' .
            $category .
            ' AND tbl_trans_order_h.inv_date>=\'' .
            date("Y-m-01", strtotime($datepickermonth . " -6 month")) .
            '\' AND tbl_trans_order_h.inv_date<=\'' .
            date("Y-m-t", strtotime($datepickermonth)) .
            '\'' .
            $qtyStri .
            " AND tbl_trans_order_h.header_net_value<>0 " .
            $str .
            '
GROUP BY tbl_mst_territory.reference_code,tbl_trans_order_h.inv_date ) a GROUP BY a.ag_cd';
        //echo $query; die();
        $result = $this->db->query($query)->result_array();
        //echo $this->db->last_query(); die();
        return $result;
    }

    function getTotalSalesandPcNewDemarcation(
        $area = null,
        $range = null,
        $datepickermonth = null,
        $bookingAct = "A"
    ) {
        $str = "";
        $strBack = "";

        for ($k = 1; $k <= 6; $k++) {
            $monthNumberBack = date(
                "m",
                strtotime($datepickermonth . " -" . $k . " month")
            );
            $monthNameBack = date(
                "F",
                strtotime($datepickermonth . " -" . $k . " month")
            );
            $yearBack = date(
                "Y",
                strtotime($datepickermonth . " -" . $k . " month")
            );
            $strBack .=
                "COUNT(IF(month(a.dates)=" .
                $monthNumberBack .
                " AND year(a.dates)=" .
                $yearBack .
                ", a.dates,null)) as " .
                $monthNameBack .
                "_WD, SUM(IF(month(a.dates)=" .
                $monthNumberBack .
                " AND year(a.dates)=" .
                $yearBack .
                ", a.pc,0)) as " .
                $monthNameBack .
                "_TotPC ,";
        }
        if (!empty($area) && isset($area) && $area != null && $area != -1) {
            $str .= " AND tbl_mst_area.id=" . $area . " ";
        }
        if (!empty($range) && isset($range) && $range != null && $range != -1) {
            if ($range == "D") {
                $str .= ' AND (tbl_mst_range.range_name=\'' . $range . '\' OR tbl_mst_range.range_name=\'T\') ';
            } else {
                $str .= ' AND (tbl_mst_range.range_name=\'' . $range . '\') ';
            }
        }

        $qtyStri =
            'tbl_trans_order_h.inv_date>=\'' .
            date("Y-m-01", strtotime($datepickermonth . " -6 month")) .
            '\' AND tbl_trans_order_h.inv_date<=\'' .
            date("Y-m-t", strtotime($datepickermonth)) .
            '\' AND tbl_trans_order_h.inv_type=\'' .
            $bookingAct .
            '\' AND tbl_trans_order_h.header_net_value<>0 ';
        $query =
            'select  
            ' .
            $strBack .
            '
            a.ag_cd
from (SELECT tbl_mst_territory.reference_code AS ag_cd,tbl_trans_order_h.inv_date AS dates, COUNT(DISTINCT tbl_mst_outlet.id) AS pc
FROM  tbl_trans_order_h 
INNER JOIN  tbl_mst_outlet ON tbl_trans_order_h.customer_id=tbl_mst_outlet.id

INNER JOIN tbl_mst_territory ON tbl_trans_order_h.territory_id=`tbl_mst_territory`.`id`
INNER JOIN tbl_mst_range ON tbl_trans_order_h.range_id=tbl_mst_range.id
INNER JOIN tbl_mst_geography ON tbl_mst_territory.id=tbl_mst_geography.territory_id AND tbl_mst_geography.range_id=tbl_mst_range.id
INNER JOIN tbl_mst_area ON tbl_mst_geography.area_id=tbl_mst_area.id

WHERE ' .
            $qtyStri .
            " " .
            $str .
            '
GROUP BY  tbl_mst_territory.reference_code,tbl_trans_order_h.inv_date ) a GROUP BY a.ag_cd';
        if ($bookingAct == "B") {
            $qtyStri =
                'tbl_trans_order_h.inv_date>=\'' .
                date("Y-m-01", strtotime($datepickermonth . " -6 month")) .
                '\' AND tbl_trans_order_h.inv_date<=\'' .
                date("Y-m-t", strtotime($datepickermonth)) .
                '\'';

            $query =
                'select  
            ' .
                $strBack .
                '
            a.ag_cd
from (SELECT tbl_mst_territory.reference_code AS ag_cd,tbl_trans_order_h.inv_date AS dates, COUNT(DISTINCT tbl_mst_outlet.id) AS pc
FROM tbl_trans_order_h 
INNER JOIN  tbl_mst_outlet ON tbl_trans_order_h.customer_id=tbl_mst_outlet.id

INNER JOIN tbl_mst_territory ON tbl_trans_order_h.territory_id=`tbl_mst_territory`.`id`
INNER JOIN tbl_mst_range ON tbl_trans_order_h.range_id=tbl_mst_range.id
INNER JOIN tbl_mst_geography ON tbl_mst_territory.id=tbl_mst_geography.territory_id AND tbl_mst_geography.range_id=tbl_mst_range.id
INNER JOIN tbl_mst_area ON tbl_mst_geography.area_id=tbl_mst_area.id

WHERE ' .
                $qtyStri .
                " " .
                $str .
                '
GROUP BY tbl_mst_territory.reference_code,tbl_trans_order_h.inv_date ) a GROUP BY a.ag_cd';
        }

        //INNER JOIN shop_mst ON invh.ag_cd=shop_mst.sh_ag_cd AND invh.ro_cd=shop_mst.sh_ro_cd AND invh.sh_cd=shop_mst.sh_cd

        $result = $this->db->query($query)->result_array();
        //echo $this->db->last_query();
        return $result;
    }

    function getDailySalesCategoryNewDemarcation(
        $area = null,
        $range = null,
        $datepickermonth = null,
        $category = null,
        $type = "value",
        $bookingAct = null
    ) {
        echo $bookingAct;
        $str = "";
        if (!empty($area) && isset($area) && $area != null && $area != -1) {
            $str .= " AND tbl_mst_area.id=" . $area . " ";
        }
        if (!empty($range) && isset($range) && $range != null && $range != -1) {
            if ($range == "D") {
                $str .=
                    ' AND (tbl_mst_range.range_name=\'' .
                    $range .
                    '\' OR tbl_mst_range.range_name=\'S\' OR tbl_mst_range.range_name=\'T\') ';
            } else {
                $str .= ' AND (tbl_mst_range.range_name=\'' . $range . '\' OR tbl_mst_range.range_name=\'S\') ';
            }
        }

        $strQ = "";
        $monthNumber = date("m", strtotime($datepickermonth));
        $monthName = date("F", strtotime($datepickermonth));
        $year = date("Y", strtotime($datepickermonth));

        $qtyStri =
            ' AND tbl_trans_order_h.header_net_value<>0 AND tbl_trans_order_h.inv_type=\'' .
            $bookingAct .
            '\' AND tbl_trans_order_h.header_net_value<>0 AND tbl_trans_order_h.inv_date>=\'' .
            date("Y-m-01", strtotime($datepickermonth . " -6 month")) .
            '\' AND tbl_trans_order_h.inv_date<=\'' .
            date("Y-m-t", strtotime($datepickermonth)) .
            '\' ';
        if ($bookingAct == "B") {
            $qtyStri =
                ' AND tbl_trans_order_h.inv_date>=\'' .
                date("Y-m-01", strtotime($datepickermonth . " -6 month")) .
                '\' AND tbl_trans_order_h.inv_date<=\'' .
                date("Y-m-t", strtotime($datepickermonth)) .
                '\' ';

            for ($n = 1; $n <= date("t", strtotime($datepickermonth)); $n++) {
                if ($type == "value") {
                    $strQ .=
                        "SUM(IF(month(tbl_trans_order_h.inv_date)=" .
                        $monthNumber .
                        " AND year(tbl_trans_order_h.inv_date)=" .
                        $year .
                        " AND day(tbl_trans_order_h.inv_date)=" .
                        $n .
                        ", ( tbl_trans_order_d.actual_qty*tbl_trans_order_d.unit_price),0)) AS `" .
                        $monthName .
                        "-" .
                        $n .
                        "`,";
                } else {
                    $strQ .=
                        "SUM(IF(month(tbl_trans_order_h.inv_date)=" .
                        $monthNumber .
                        " AND year(tbl_trans_order_h.inv_date)=" .
                        $year .
                        " AND day(tbl_trans_order_h.inv_date)=" .
                        $n .
                        ", ( tbl_trans_order_d.actual_qty*item_mst.pack),0)) AS `" .
                        $monthName .
                        "-" .
                        $n .
                        "`,";
                }
                $strQ .=
                    "COUNT(DISTINCT CASE WHEN (month(tbl_trans_order_h.inv_date)=" .
                    $monthNumber .
                    " AND year(tbl_trans_order_h.inv_date)=" .
                    $year .
                    " AND day(tbl_trans_order_h.inv_date)=" .
                    $n .
                    ") THEN tbl_mst_outlet.id END) AS `" .
                    $monthName .
                    "-" .
                    $n .
                    "-pc`,";
            }
            $strBack = "";
            for ($k = 1; $k <= 6; $k++) {
                $monthNumberBack = date(
                    "m",
                    strtotime($datepickermonth . " -" . $k . " month")
                );
                $monthNameBack = date(
                    "F",
                    strtotime($datepickermonth . " -" . $k . " month")
                );
                $yearBack = date(
                    "Y",
                    strtotime($datepickermonth . " -" . $k . " month")
                );
                if ($type == "value") {
                    $strBack .=
                        " SUM(IF(month(tbl_trans_order_h.inv_date)=" .
                        $monthNumberBack .
                        " AND year(tbl_trans_order_h.inv_date)=" .
                        $yearBack .
                        ", tbl_trans_order_d.actual_qty*tbl_trans_order_d.unit_price,0)) AS `" .
                        $monthNameBack .
                        "-Total`, ";
                } else {
                    $strBack .=
                        " SUM(IF(month(tbl_trans_order_h.inv_date)=" .
                        $monthNumberBack .
                        " AND year(tbl_trans_order_h.inv_date)=" .
                        $yearBack .
                        ", tbl_trans_order_d.actual_qty*item_mst.pack,0)) AS `" .
                        $monthNameBack .
                        "-Total`, ";
                }
            }

            $strK = "";
            if ($type == "value") {
                $strK =
                    "SUM(IF(month(tbl_trans_order_h.inv_date)=" .
                    $monthNumber .
                    " AND year(tbl_trans_order_h.inv_date)=" .
                    $year .
                    ", (tbl_trans_order_d.actual_qty*tbl_trans_order_d.unit_price),0)) AS `" .
                    $monthName .
                    "-Total` ";
            } else {
                $strK =
                    "SUM(IF(month(tbl_trans_order_h.inv_date)=" .
                    $monthNumber .
                    " AND year(tbl_trans_order_h.inv_date)=" .
                    $year .
                    ", (tbl_trans_order_d.actual_qty*item_mst.pack),0)) AS `" .
                    $monthName .
                    "-Total` ";
            }
        } else {
            for ($n = 1; $n <= date("t", strtotime($datepickermonth)); $n++) {
                if ($type == "value") {
                    $strQ .=
                        "SUM(IF(month(tbl_trans_order_h.inv_date)=" .
                        $monthNumber .
                        " AND year(tbl_trans_order_h.inv_date)=" .
                        $year .
                        " AND day(tbl_trans_order_h.inv_date)=" .
                        $n .
                        ", (tbl_trans_order_d.actual_qty*tbl_trans_order_d.unit_price),0)) AS `" .
                        $monthName .
                        "-" .
                        $n .
                        "`,";
                } else {
                    $strQ .=
                        "SUM(IF(month(tbl_trans_order_h.inv_date)=" .
                        $monthNumber .
                        " AND year(tbl_trans_order_h.inv_date)=" .
                        $year .
                        " AND day(tbl_trans_order_h.inv_date)=" .
                        $n .
                        ", (tbl_trans_order_d.actual_qty*item_mst.pack),0)) AS `" .
                        $monthName .
                        "-" .
                        $n .
                        "`,";
                }
                $strQ .=
                    "COUNT(DISTINCT CASE WHEN (month(tbl_trans_order_h.inv_date)=" .
                    $monthNumber .
                    " AND year(tbl_trans_order_h.inv_date)=" .
                    $year .
                    " AND day(tbl_trans_order_h.inv_date)=" .
                    $n .
                    ") THEN tbl_mst_outlet.id END) AS `" .
                    $monthName .
                    "-" .
                    $n .
                    "-pc`,";
            }
            $strBack = "";
            for ($k = 1; $k <= 6; $k++) {
                $monthNumberBack = date(
                    "m",
                    strtotime($datepickermonth . " -" . $k . " month")
                );
                $monthNameBack = date(
                    "F",
                    strtotime($datepickermonth . " -" . $k . " month")
                );
                $yearBack = date(
                    "Y",
                    strtotime($datepickermonth . " -" . $k . " month")
                );
                if ($type == "value") {
                    $strBack .=
                        " SUM(IF(month(tbl_trans_order_h.inv_date)=" .
                        $monthNumberBack .
                        " AND year(tbl_trans_order_h.inv_date)=" .
                        $yearBack .
                        ", tbl_trans_order_d.actual_qty*tbl_trans_order_d.unit_price,0)) AS `" .
                        $monthNameBack .
                        "-Total`, ";
                } else {
                    $strBack .=
                        " SUM(IF(month(tbl_trans_order_h.inv_date)=" .
                        $monthNumberBack .
                        " AND year(tbl_trans_order_h.inv_date)=" .
                        $yearBack .
                        ", tbl_trans_order_d.actual_qty*item_mst.pack,0)) AS `" .
                        $monthNameBack .
                        "-Total`, ";
                }
            }

            $strK = "";
            if ($type == "value") {
                $strK =
                    "SUM(IF(month(tbl_trans_order_h.inv_date)=" .
                    $monthNumber .
                    " AND year(tbl_trans_order_h.inv_date)=" .
                    $year .
                    ", (tbl_trans_order_d.actual_qty*tbl_trans_order_d.unit_price),0)) AS `" .
                    $monthName .
                    "-Total` ";
            } else {
                $strK =
                    "SUM(IF(month(tbl_trans_order_h.inv_date)=" .
                    $monthNumber .
                    " AND year(tbl_trans_order_h.inv_date)=" .
                    $year .
                    ", (tbl_trans_order_d.actual_qty*item_mst.pack),0)) AS `" .
                    $monthName .
                    "-Total` ";
            }
        }

        //INNER JOIN shop_mst ON invh.ag_cd=shop_mst.sh_ag_cd AND invh.ro_cd=shop_mst.sh_ro_cd AND invh.sh_cd=shop_mst.sh_cd

        $q = $this->db->query(
            'SELECT tbl_mst_region.region_name,tbl_mst_area.area_name, tbl_mst_territory.territory_name AS ag_name,tbl_mst_territory.reference_code AS ag_cd,IF(tbl_mst_range.range_name=\'T\',\'D\',tbl_mst_range.range_name) AS cd,
 
' .
                $strQ .
                $strBack .
                $strK .
                ' 

FROM  tbl_trans_order_h  
INNER JOIN tbl_trans_order_d ON tbl_trans_order_h.app_inv_no=tbl_trans_order_d.app_inv_no
INNER JOIN  tbl_mst_item ON tbl_trans_order_d.item_code=tbl_mst_item.item
INNER JOIN tbl_mst_item_category_link_item ON tbl_mst_item.item=tbl_mst_item_category_link_item.item_id
INNER JOIN tbl_mst_item_category ON tbl_mst_item_category_link_item.category_id=tbl_mst_item_category.id
INNER JOIN tbl_mst_item_category_purpose_link_category ON tbl_mst_item_category.id=tbl_mst_item_category_purpose_link_category.category_id
INNER JOIN tbl_mst_item_category_purpose ON tbl_mst_item_category_purpose_link_category.purpose_id=tbl_mst_item_category_purpose.id
INNER JOIN tbl_mst_outlet ON tbl_trans_order_h.customer_id=tbl_mst_outlet.id
INNER JOIN item_mst ON item_mst.item =  tbl_mst_item.item

INNER JOIN tbl_mst_territory ON tbl_trans_order_h.territory_id=`tbl_mst_territory`.`id`
INNER JOIN tbl_mst_range ON tbl_trans_order_h.range_id=tbl_mst_range.id
INNER JOIN tbl_mst_geography ON tbl_mst_territory.id=tbl_mst_geography.territory_id AND tbl_mst_geography.range_id=tbl_mst_range.id 
INNER JOIN tbl_mst_area ON tbl_mst_geography.area_id=tbl_mst_area.id
INNER JOIN tbl_mst_region ON tbl_mst_geography.region_id=tbl_mst_region.id

WHERE  tbl_mst_item_category_purpose.id=3 AND tbl_mst_item_category.id=' .
                $category .
                "" .
                $qtyStri .
                "  " .
                $str .
                '
GROUP BY tbl_mst_area.area_name,tbl_mst_territory.territory_name,tbl_mst_territory.reference_code,tbl_mst_range.range_name,tbl_mst_item_category.id
ORDER BY tbl_mst_region.id,tbl_mst_area.area_name,tbl_mst_territory.territory_name,tbl_mst_territory.reference_code,tbl_mst_range.range_name'
        );
        $result = $q->result_array();
        // echo $this->db->last_query();
        return $result;
    }

    function getTargetNewDemarcation($tyear, $tmonth, $area_cd = null)
    {
        $this->db->select(
            "`tbl_mst_area`.`id` AS `area_cd`, `target_value`.`ag_cd`, `t_year`, `t_mon`, `tbl_mst_area`.`area_name`, `ag_name`, SUM(IF(tbl_mst_geography.range_id=1 OR tbl_mst_geography.range_id=3,`c_target`,0)) AS `c_target`, SUM(IF(tbl_mst_geography.range_id=2 OR tbl_mst_geography.range_id=5 OR tbl_mst_geography.range_id=3,`d_target`,0)) AS `d_target`, `a_target`, SUM(IF(tbl_mst_geography.range_id=4,`b_target`,0)) AS `b_target`, SUM(IF(tbl_mst_geography.range_id=3,`s_target`,0)) AS `s_target`, SUM(IF(tbl_mst_geography.range_id=5,`t_target`,0)) AS `t_target`, SUM(IF(tbl_mst_geography.range_id=6,`r_target`,0)) AS  `r_target`, SUM(IF(tbl_mst_geography.range_id=1,`acs_pc_target`,0)) AS `acs_pc_target`, SUM(IF(tbl_mst_geography.range_id=2,`bd_pc_target`,0)) AS `bd_pc_target`, `wd`, `p_wd`, `auto`"
        );
        $this->db->from("`target_value`");
        $this->db->join(
            "`tbl_mst_territory`",
            "target_value.ag_cd=`tbl_mst_territory`.`reference_code`",
            "INNER"
        );
        $this->db->join(
            "`tbl_mst_geography`",
            "tbl_mst_territory.id=`tbl_mst_geography`.`territory_id`",
            "INNER"
        );
        $this->db->join(
            "`tbl_mst_area`",
            "tbl_mst_geography.area_id=`tbl_mst_area`.`id`",
            "INNER"
        );
        if (
            !empty($area_cd) &&
            isset($area_cd) &&
            $area_cd != null &&
            $area_cd != "-1"
        ) {
            //$this->db->where('area_cd', $area_cd);
            $this->db->where("`tbl_mst_area`.`id`", $area_cd);
        }
        $this->db->where(["t_year" => $tyear, "t_mon" => $tmonth]);
        $this->db->group_by("`tbl_mst_territory`.`reference_code`");
        $queryData = $this->db->get();
        $resultData = $queryData->result_array();
        // echo $this->db->last_query();
        return $resultData;
    }


    function getDailySalesNewDemarcation(
        $area = null,
        $range = null,
        $datepickermonth = null,
        $bookingAct = "A"
    ) {
        $str = "";
        if (!empty($area) && isset($area) && $area != null && $area != -1) {
            $str .= " AND tbl_mst_area.id=" . $area . " ";
        }
        if (!empty($range) && isset($range) && $range != null && $range != -1) {
            /* if ($range == 'D') {
              $str .= ' AND (invh.cd=\'' . $range . '\' OR invh.cd=\'S\' OR invh.cd=\'T\') ';
              } else {
              $str .= ' AND (invh.cd=\'' . $range . '\' OR invh.cd=\'S\') ';
              } */
            //20240218
            /*
              if ($range == 'D') {
              $str .= ' AND (invh.cd=\'' . $range . '\' OR invh.cd=\'T\') ';
              } else {
              $str .= ' AND (invh.cd=\'' . $range . '\' ) ';
              } */

            //FOR S RANGE
            if ($range == "D") {
                $str .=
                    ' AND ( tbl_mst_range.range_name=\'' .
                    $range .
                    '\' OR tbl_mst_range.range_name=\'T\' OR tbl_mst_range.range_name=\'S\') ';
            } else {
                $str .= ' AND (tbl_mst_range.range_name=\'' . $range . '\' OR tbl_mst_range.range_name=\'S\') ';
            }
        }
        $strQ = "";
        $monthNumber = date("m", strtotime($datepickermonth));
        $monthName = date("F", strtotime($datepickermonth));
        $year = date("Y", strtotime($datepickermonth));
        for ($n = 1; $n <= date("t", strtotime($datepickermonth)); $n++) {
            //$strQ .= 'SUM(IF(month(tbl_trans_order_h.inv_date)=' . $monthNumber . ' AND year(tbl_trans_order_h.inv_date)=' . $year . ' AND day(tbl_trans_order_h.inv_date)=' . $n . ', (tbl_trans_order_h.header_net_value+tbl_trans_order_h.total_discount_value),0)) AS `' . $monthName . '-' . $n . '`,';
            //S RANGE SUPPORT
            if ($range == "D") {
                $strQ .=
                    "SUM(CASE WHEN (tbl_mst_geography.range_id!=3 AND month(tbl_trans_order_h.inv_date)=" .
                    $monthNumber .
                    " AND year(tbl_trans_order_h.inv_date)=" .
                    $year .
                    " AND day(tbl_trans_order_h.inv_date)=" .
                    $n .
                    ") THEN ((tbl_trans_order_h.header_net_value+tbl_trans_order_h.total_discount_value)) WHEN (tbl_mst_geography.range_id=3 AND month(tbl_trans_order_h.inv_date)=" .
                    $monthNumber .
                    " AND year(tbl_trans_order_h.inv_date)=" .
                    $year .
                    " AND day(tbl_trans_order_h.inv_date)=" .
                    $n .
                    ") THEN ( (tbl_trans_order_h.header_net_value*`invhapp_cd_ratio`.`d_ratio`+tbl_trans_order_h.total_discount_value*`invhapp_cd_ratio`.`d_ratio` )) END) AS `" .
                    $monthName .
                    "-" .
                    $n .
                    "`,";
            } else {
                $strQ .=
                    "SUM(CASE WHEN (tbl_mst_geography.range_id!=3) THEN (IF(month(tbl_trans_order_h.inv_date)=" .
                    $monthNumber .
                    " AND year(tbl_trans_order_h.inv_date)=" .
                    $year .
                    " AND day(tbl_trans_order_h.inv_date)=" .
                    $n .
                    ", (tbl_trans_order_h.header_net_value+tbl_trans_order_h.total_discount_value),0)) WHEN (tbl_mst_geography.range_id=3) THEN (IF(month(tbl_trans_order_h.inv_date)=" .
                    $monthNumber .
                    " AND year(tbl_trans_order_h.inv_date)=" .
                    $year .
                    " AND day(tbl_trans_order_h.inv_date)=" .
                    $n .
                    ", (tbl_trans_order_h.header_net_value*`invhapp_cd_ratio`.`c_ratio`+tbl_trans_order_h.total_discount_value*`invhapp_cd_ratio`.`c_ratio`),0)) END) AS `" .
                    $monthName .
                    "-" .
                    $n .
                    "`,";
            }
            $strQ .=
                "COUNT(DISTINCT CASE WHEN (month(tbl_trans_order_h.inv_date)=" .
                $monthNumber .
                " AND year(tbl_trans_order_h.inv_date)=" .
                $year .
                " AND day(tbl_trans_order_h.inv_date)=" .
                $n .
                ") THEN tbl_mst_outlet.id END) AS `" .
                $monthName .
                "-" .
                $n .
                "-pc`,";
        }
        $strBack = "";
        for ($k = 1; $k <= 6; $k++) {
            $monthNumberBack = date(
                "m",
                strtotime($datepickermonth . " -" . $k . " month")
            );
            $monthNameBack = date(
                "F",
                strtotime($datepickermonth . " -" . $k . " month")
            );
            $yearBack = date(
                "Y",
                strtotime($datepickermonth . " -" . $k . " month")
            );
            if ($range == "D") {
                $strBack .=
                    " SUM(CASE WHEN (tbl_mst_geography.range_id!=3) THEN IF(month(tbl_trans_order_h.inv_date)=" .
                    $monthNumberBack .
                    " AND year(tbl_trans_order_h.inv_date)=" .
                    $yearBack .
                    ", tbl_trans_order_h.header_net_value+tbl_trans_order_h.total_discount_value,0) ELSE IF(month(tbl_trans_order_h.inv_date)=" .
                    $monthNumberBack .
                    " AND year(tbl_trans_order_h.inv_date)=" .
                    $yearBack .
                    ", tbl_trans_order_h.header_net_value*`invhapp_cd_ratio`.`d_ratio`+tbl_trans_order_h.total_discount_value*`invhapp_cd_ratio`.`d_ratio`,0) END) AS `" .
                    $monthNameBack .
                    "-Total`, ";
            } else {
                $strBack .=
                    " SUM(CASE WHEN (tbl_mst_geography.range_id!=3) THEN IF(month(tbl_trans_order_h.inv_date)=" .
                    $monthNumberBack .
                    " AND year(tbl_trans_order_h.inv_date)=" .
                    $yearBack .
                    ", tbl_trans_order_h.header_net_value+tbl_trans_order_h.total_discount_value,0) ELSE IF(month(tbl_trans_order_h.inv_date)=" .
                    $monthNumberBack .
                    " AND year(tbl_trans_order_h.inv_date)=" .
                    $yearBack .
                    ", tbl_trans_order_h.header_net_value*`invhapp_cd_ratio`.`c_ratio`+tbl_trans_order_h.total_discount_value*`invhapp_cd_ratio`.`c_ratio`,0) END) AS `" .
                    $monthNameBack .
                    "-Total`, ";
            }
        }
        $strp1 = "";
        if ($range == "D") {
            $strp1 =
        'SELECT tbl_mst_region.region_name,tbl_mst_area.area_name, tbl_mst_territory.territory_name AS ag_name, tbl_mst_territory.reference_code AS ag_cd,IF( tbl_mst_range.range_name=\'T\' OR tbl_mst_range.range_name=\'S\' ,\'D\',tbl_mst_range.range_name) AS cd,';
        } else {
            $strp1 =
                'SELECT tbl_mst_region.region_name,tbl_mst_area.area_name,tbl_mst_territory.territory_name AS ag_name, tbl_mst_territory.reference_code AS ag_cd,IF(tbl_mst_range.range_name=\'S\' ,\'C\',tbl_mst_range.range_name) AS cd,';
        }

        $str2 = "";
        if ($range == "D") {
            $str2 =
                "SUM(CASE WHEN (tbl_mst_geography.range_id!=3) THEN IF(month(tbl_trans_order_h.inv_date)=" .
                $monthNumber .
                " AND year(tbl_trans_order_h.inv_date)=" .
                $year .
                ", (tbl_trans_order_h.header_net_value+tbl_trans_order_h.total_discount_value),0) ELSE IF(month(tbl_trans_order_h.inv_date)=" .
                $monthNumber .
                " AND year(tbl_trans_order_h.inv_date)=" .
                $year .
                ", (tbl_trans_order_h.header_net_value*`invhapp_cd_ratio`.`d_ratio`+tbl_trans_order_h.total_discount_value*`invhapp_cd_ratio`.`d_ratio`),0) END) AS `" .
                $monthName .
                "-Total`";
        } else {
            $str2 =
                "SUM(CASE WHEN (tbl_mst_geography.range_id!=3) THEN IF(month(tbl_trans_order_h.inv_date)=" .
                $monthNumber .
                " AND year(tbl_trans_order_h.inv_date)=" .
                $year .
                ", (tbl_trans_order_h.header_net_value+tbl_trans_order_h.total_discount_value),0) ELSE IF(month(tbl_trans_order_h.inv_date)=" .
                $monthNumber .
                " AND year(tbl_trans_order_h.inv_date)=" .
                $year .
                ", (tbl_trans_order_h.header_net_value*`invhapp_cd_ratio`.`c_ratio`+tbl_trans_order_h.total_discount_value*`invhapp_cd_ratio`.`c_ratio`),0) END) AS `" .
                $monthName .
                "-Total`";
        }

        $q = $this->db->query(
            $strp1 .
                $strQ .
                $strBack .
                ' 

 
' .
                $str2 .
                '

FROM  tbl_trans_order_h  

LEFT JOIN `invhapp_cd_ratio` ON `tbl_trans_order_h`.`app_inv_no`=`invhapp_cd_ratio`.`app_inv_no` 

INNER JOIN tbl_mst_outlet ON tbl_trans_order_h.customer_id=tbl_mst_outlet.id 

INNER JOIN tbl_mst_territory ON tbl_trans_order_h.territory_id=`tbl_mst_territory`.`id`
INNER JOIN tbl_mst_geography ON tbl_mst_territory.id=tbl_mst_geography.territory_id
INNER JOIN tbl_mst_range ON tbl_mst_geography.range_id=tbl_mst_range.id AND tbl_trans_order_h.range_id=tbl_mst_range.id
INNER JOIN tbl_mst_area ON tbl_mst_geography.area_id=tbl_mst_area.id
INNER JOIN tbl_mst_region ON tbl_mst_geography.region_id=tbl_mst_region.id

WHERE tbl_trans_order_h.inv_date>=\'' .
                date("Y-m-01", strtotime($datepickermonth . " -6 month")) .
                '\' AND tbl_trans_order_h.inv_date<=\'' .
                date("Y-m-t", strtotime($datepickermonth)) .
                '\' AND tbl_trans_order_h.inv_type=\''. $bookingAct.'\' AND tbl_trans_order_h.header_net_value<>0 ' .
                $str .
                '
GROUP BY tbl_mst_area.area_name,tbl_mst_territory.territory_name,tbl_mst_territory.reference_code,tbl_mst_range.range_name 
ORDER BY tbl_mst_region.id,tbl_mst_area.display_order,tbl_mst_area.area_name,tbl_mst_territory.territory_name,tbl_mst_territory.reference_code,tbl_mst_range.range_name'
        );
        $result = $q->result_array();
        //echo $this->db->last_query();
        return $result;
    }

}

?>
