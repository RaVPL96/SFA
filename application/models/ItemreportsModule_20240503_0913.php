<?php

class ItemreportsModule extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('AuditModule');
    }

    function getItemCategoryShopSaleDaily($area = null, $range = null, $fromDate = null, $toDate = null, $sbValueRange = '>=', $value = 0, $category) {
        $str = '';
        if (!empty($area) && isset($area) && $area != null && $area != -1) {
            $str .= ' AND area_h.area_cd=' . $area . ' ';
        }

        $begin = new DateTime($fromDate);
        $end = new DateTime($toDate);
        $end = $end->modify('+1 day');

        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($begin, $interval, $end);
        $havings = '';
        $headings = '';
        foreach ($daterange as $date) {
            $monthNumber = date('m', strtotime($date->format("Y-m-d")));
            $dayNumber = date('d', strtotime($date->format("Y-m-d")));
            $monthName = date('F', strtotime($date->format("Y-m-d")));
            $year = date('Y', strtotime($date->format("Y-m-d")));

            if ($date->format("Y-m-d") == $toDate) {
                $headings .= 'sum(if(year(invh.date_actual)=' . $year . ' and month(invh.date_actual)=' . $monthNumber . '  AND day(invh.date_actual)=' . $dayNumber . ', (invd.a_Qty*invd.up),0)) AS value_' . $date->format("Y_m_d") . ' ';
                $havings .= 'sum(if(year(invh.date_actual)=' . $year . ' and month(invh.date_actual)=' . $monthNumber . '  AND day(invh.date_actual)=' . $dayNumber . ', (invd.a_Qty*invd.up),0)) ' . $sbValueRange . ' ' . $value . ' ';
            } else {
                $headings .= 'sum(if(year(invh.date_actual)=' . $year . ' and month(invh.date_actual)=' . $monthNumber . '  AND day(invh.date_actual)=' . $dayNumber . ', (invd.a_Qty*invd.up),0)) AS value_' . $date->format("Y_m_d") . ', ';
                $havings .= 'sum(if(year(invh.date_actual)=' . $year . ' and month(invh.date_actual)=' . $monthNumber . '  AND day(invh.date_actual)=' . $dayNumber . ', (invd.a_Qty*invd.up),0)) ' . $sbValueRange . ' ' . $value . ' OR ';
            }
        }

        $q = $this->db->query(''
                . 'SELECT  area_h.area_name,agency_mst.ag_name,invh.ag_cd,shop_mst.sh_ro_cd,shop_mst.sh_cd,shop_mst.sh_name,invh.cd,tbl_mst_item_category.name as cat,
' . $headings . '
FROM invh 
INNER JOIN agency_mst ON invh.ag_cd=agency_mst.ag_cd  
INNER JOIN area_d ON agency_mst.ag_cd=area_d.ag_cd
INNER JOIN area_h on area_d.area_cd=area_h.area_cd
INNER JOIN invd ON invh.invno=invd.invno 
INNER JOIN item_mst ON invd.item=item_mst.item 
INNER JOIN tbl_mst_item_category_link_item ON invd.item=tbl_mst_item_category_link_item.item_id
INNER JOIN tbl_mst_item_category ON tbl_mst_item_category_link_item.category_id=tbl_mst_item_category.id
INNER JOIN tbl_mst_item_category_purpose_link_category ON tbl_mst_item_category.id=tbl_mst_item_category_purpose_link_category.category_id
INNER JOIN tbl_mst_item_category_purpose ON tbl_mst_item_category_purpose_link_category.purpose_id=tbl_mst_item_category_purpose.id
INNER JOIN shop_mst ON invh.ag_cd=shop_mst.sh_ag_cd AND invh.ro_cd=shop_mst.sh_ro_cd AND invh.sh_cd=shop_mst.sh_cd
WHERE invh.date_actual>=\'' . $fromDate . '\' AND invh.date_actual<=\'' . $toDate . '\' AND invh.cd=\'' . $range . '\' AND tbl_mst_item_category.id=' . $category . ' AND tbl_mst_item_category_purpose.id=3 AND invh.b_a=\'A\' AND invh.tot_a_val<>0 ' . $str . ' GROUP BY invh.ag_cd,shop_mst.sh_ro_cd,shop_mst.sh_cd,invh.cd, tbl_mst_item_category.name
HAVING 
' . $havings . ' 
ORDER BY invh.ag_cd,shop_mst.sh_ro_cd,shop_mst.sh_cd,invh.cd, item_mst.cat
');
        $result = $q->result_array();
        //echo $this->db->last_query();
        return $result;
    }

    function getHardCount($area, $range, $fromDate, $toDate) {
        $str = '';
        if (!empty($area) && isset($area) && $area != null && $area != -1) {
            $str .= ' AND area_h.area_cd=' . $area . ' ';
        }
        $q = $this->db->query(''
                . 'SELECT a.area_name,a.ag_name,a.ag_cd,a.cd,a.date_actual, COUNT(a.Auto) AS PC,
COUNT(IF(a.CategoryPerBill=1,a.CategoryPerBill,null)) as category_1,
COUNT(IF(a.CategoryPerBill=2,a.CategoryPerBill,null)) as category_2,
COUNT(IF(a.CategoryPerBill=3,a.CategoryPerBill,null)) as category_3,
COUNT(IF(a.CategoryPerBill=4,a.CategoryPerBill,null)) as category_4,
COUNT(IF(a.CategoryPerBill=5,a.CategoryPerBill,null)) as category_5,
COUNT(IF(a.CategoryPerBill=6,a.CategoryPerBill,null)) as category_6,
COUNT(IF(a.CategoryPerBill=7,a.CategoryPerBill,null)) as category_7,
COUNT(IF(a.CategoryPerBill=8,a.CategoryPerBill,null)) as category_8,
COUNT(IF(a.CategoryPerBill=9,a.CategoryPerBill,null)) as category_9,
COUNT(IF(a.CategoryPerBill=10,a.CategoryPerBill,null)) as category_10,
COUNT(IF(a.CategoryPerBill=11,a.CategoryPerBill,null)) as category_11,
COUNT(IF(a.CategoryPerBill=12,a.CategoryPerBill,null)) as category_12,
COUNT(IF(a.CategoryPerBill=13,a.CategoryPerBill,null)) as category_13,
COUNT(IF(a.CategoryPerBill=14,a.CategoryPerBill,null)) as category_14,
COUNT(IF(a.CategoryPerBill=15,a.CategoryPerBill,null)) as category_15
FROM 
(SELECT area_h.area_name,agency_mst.ag_name,invh.ag_cd,invh.cd,invh.date_actual,shop_mst.Auto,COUNT(DISTINCT(tbl_mst_item_category.name)) AS CategoryPerBill FROM `invh`
INNER JOIN invd ON invh.invno=invd.invno 
INNER JOIN agency_mst ON invh.ag_cd=agency_mst.ag_cd  
INNER JOIN area_d ON agency_mst.ag_cd=area_d.ag_cd
INNER JOIN area_h on area_d.area_cd=area_h.area_cd
 
INNER JOIN tbl_mst_item_category_link_item ON invd.item=tbl_mst_item_category_link_item.item_id
INNER JOIN tbl_mst_item_category ON tbl_mst_item_category_link_item.category_id=tbl_mst_item_category.id
INNER JOIN tbl_mst_item_category_purpose_link_category ON tbl_mst_item_category.id=tbl_mst_item_category_purpose_link_category.category_id
INNER JOIN tbl_mst_item_category_purpose ON tbl_mst_item_category_purpose_link_category.purpose_id=tbl_mst_item_category_purpose.id
INNER JOIN shop_mst ON invh.ag_cd=shop_mst.sh_ag_cd AND invh.ro_cd=shop_mst.sh_ro_cd AND invh.sh_cd=shop_mst.sh_cd
WHERE invh.date_actual>=\'' . $fromDate . '\' AND invh.date_actual<=\'' . $toDate . '\' AND invh.cd=\'' . $range . '\' AND tbl_mst_item_category_purpose.id=4 AND invh.b_a=\'A\' AND invh.tot_a_val<>0 ' . $str . ' 
GROUP BY invh.ag_cd,invh.cd,invh.date_actual,shop_mst.Auto) a GROUP BY  a.area_name,a.ag_name,a.ag_cd,a.cd;
');
        $result = $q->result_array();
        echo $this->db->last_query();
        return $result;
    }

    function getHardCountDaily($area, $range, $fromDate, $toDate) {
        $str = '';
        if (!empty($area) && isset($area) && $area != null && $area != -1) {
            $str .= ' AND area_h.area_cd=' . $area . ' ';
        }
        $sess = $this->session->userdata('User');

        $begin = new DateTime($fromDate);
        $end = new DateTime($toDate);

        $this->db->where(array('user_name' => $sess['username']));
        $this->db->delete('tbl_trans_hardcount_base');

        for ($i = $begin; $i <= $end; $i->modify('+1 day')) {
            $dateToCal = $i->format("Y-m-d");
            $q = $this->db->query(''
                    . 'INSERT INTO `tbl_trans_hardcount_base`(`area_name`, `ag_name`, `ag_cd`, `cd`, `date_actual`, `Auto`, `CategoryPerBill`, `user_name`, `uniques_id`) SELECT area_h.area_name,agency_mst.ag_name,invh.ag_cd,invh.cd,invh.date_actual,shop_mst.Auto,COUNT(DISTINCT(tbl_mst_item_category.name)) AS CategoryPerBill,\'' . $sess['username'] . '\',concat(invh.ag_cd,\'-\',invh.cd,\'-\',invh.date_actual,\'-\',shop_mst.Auto,\'-\',\'' . $sess['username'] . '\') AS uniques_id FROM `invh`
INNER JOIN invd ON invh.invno=invd.invno 
INNER JOIN agency_mst ON invh.ag_cd=agency_mst.ag_cd  
INNER JOIN area_d ON agency_mst.ag_cd=area_d.ag_cd
INNER JOIN area_h on area_d.area_cd=area_h.area_cd
 
INNER JOIN tbl_mst_item_category_link_item ON invd.item=tbl_mst_item_category_link_item.item_id
INNER JOIN tbl_mst_item_category ON tbl_mst_item_category_link_item.category_id=tbl_mst_item_category.id
INNER JOIN tbl_mst_item_category_purpose_link_category ON tbl_mst_item_category.id=tbl_mst_item_category_purpose_link_category.category_id
INNER JOIN tbl_mst_item_category_purpose ON tbl_mst_item_category_purpose_link_category.purpose_id=tbl_mst_item_category_purpose.id
INNER JOIN shop_mst ON invh.ag_cd=shop_mst.sh_ag_cd AND invh.ro_cd=shop_mst.sh_ro_cd AND invh.sh_cd=shop_mst.sh_cd
WHERE invh.date_actual>=\'' . $dateToCal . '\' AND invh.date_actual<=\'' . $dateToCal . '\' AND invh.cd=\'' . $range . '\' AND tbl_mst_item_category_purpose.id=4 AND invh.b_a=\'A\' AND invh.tot_a_val<>0 ' . $str . ' 
GROUP BY invh.ag_cd,invh.cd,invh.date_actual,shop_mst.Auto;
');
            //$result = $q->result_array();
            //echo $this->db->last_query();
        }
        $q = $this->db->query(''
                . 'SELECT a.area_name,a.ag_name,a.ag_cd,a.cd,a.date_actual, COUNT(a.Auto) AS PC,
COUNT(IF(a.CategoryPerBill=1,a.CategoryPerBill,null)) as category_1,
COUNT(IF(a.CategoryPerBill=2,a.CategoryPerBill,null)) as category_2,
COUNT(IF(a.CategoryPerBill=3,a.CategoryPerBill,null)) as category_3,
COUNT(IF(a.CategoryPerBill=4,a.CategoryPerBill,null)) as category_4,
COUNT(IF(a.CategoryPerBill=5,a.CategoryPerBill,null)) as category_5,
COUNT(IF(a.CategoryPerBill=6,a.CategoryPerBill,null)) as category_6,
COUNT(IF(a.CategoryPerBill=7,a.CategoryPerBill,null)) as category_7,
COUNT(IF(a.CategoryPerBill=8,a.CategoryPerBill,null)) as category_8,
COUNT(IF(a.CategoryPerBill=9,a.CategoryPerBill,null)) as category_9,
COUNT(IF(a.CategoryPerBill=10,a.CategoryPerBill,null)) as category_10,
COUNT(IF(a.CategoryPerBill=11,a.CategoryPerBill,null)) as category_11,
COUNT(IF(a.CategoryPerBill=12,a.CategoryPerBill,null)) as category_12,
COUNT(IF(a.CategoryPerBill=13,a.CategoryPerBill,null)) as category_13,
COUNT(IF(a.CategoryPerBill=14,a.CategoryPerBill,null)) as category_14,
COUNT(IF(a.CategoryPerBill=15,a.CategoryPerBill,null)) as category_15
FROM tbl_trans_hardcount_base a WHERE user_name=\'' . $sess['username'] . '\' GROUP BY  a.area_name,a.ag_name,a.ag_cd,a.cd');
        $result = $q->result_array();
        return $result;
    }

    function getDailyItemWiseSale($range, $fromDate, $toDate) {
        
        $sess = $this->session->userdata('User');
        $begin = new DateTime($fromDate);
        $end = new DateTime($toDate);

        $this->db->where(array('user_name' => $sess['username']));
        $this->db->delete('tbl_trans_hardcount_base');

        $q = '`item_mst`.`item`,`item_mst`.`des`,`item_mst`.`uom`,';
        for ($i = $begin; $i <= $end; $i->modify('+1 day')) {
            $year = $i->format("Y");
            $month = $i->format("m");
            $date = $i->format("d");
            $fullDate = $i->format("Y-m-d");
            $q .= 'SUM(if(year(`invh`.`date_actual`)=' . $year . ' AND month(`invh`.`date_actual`)=' . $month . ' AND day(`invh`.`date_actual`)=' . $date . ',`invd`.`a_Qty`,0)) AS date_' . $date . ',';
        }

        $this->db->select($q.' SUM(`invd`.`a_Qty`) AS totQty, SUM(`invd`.`up`*`invd`.`a_Qty`) AS totVal ');
        $this->db->from('`invh`');
        $this->db->join('`invd`', '`invh`.`invno`=`invd`.`invno`', 'INNER');
        $this->db->join('`item_mst`', '`invd`.`item`=`item_mst`.`item`', 'INNER');
        $this->db->join('`tbl_mst_range_item`', '`item_mst`.`item`=`tbl_mst_range_item`.`item`', 'INNER');

        $this->db->where('`invh`.`date_actual` >=', $fromDate);
        $this->db->where('`invh`.`date_actual` <=', $toDate);
        $this->db->where('`invh`.`b_a`', 'A');
        $this->db->where('`invh`.`cd`', $range);
        $this->db->where('`invh`.`tot_a_val` !=', 0);

        $this->db->group_by('`item_mst`.`item`');
        $this->db->group_by('`item_mst`.`des`');

        $this->db->order_by('`tbl_mst_range_item`.`category_sequence`');
        $this->db->order_by('`tbl_mst_range_item`.`item_sequence`');

        $query = $this->db->get();
        $result = $query->result_array();
//        echo $this->db->last_query().'<br>';

        return $result;
    }

}
