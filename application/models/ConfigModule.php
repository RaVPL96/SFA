<?php

class ConfigModule extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
    }

    function getTera($allData = null,$row=null,$col=null){

        foreach ($allData as $sheetName => $data) {
            $a=1;
            foreach ($data as $values) {
                $b=1;
                foreach ($values as $secd) {

                    if($a==$row && $b==$col){
                    // return $a."-".$row."|".$b."-".$col;
                        return $secd;
                    }
                    $b++;
                }
                $a++;
            }
        }
    }

    function saveExcel($allData = null,$uploadDate=null,$range=null) {

        $itemCode    = null;
        $itemName    = null;
        $uom         = null;
        $iscat       = null;
        $teraCode    = null;
        $targetValue = null;

        $IsInserted = 1;

        $this->db->trans_begin();

        $dateArr = explode('-', $uploadDate);

        $dateMonth = $dateArr[0]."-".$dateArr[1];
        $this->db->where('`upload_month`', $dateMonth);

        $this->db->where('`target_range`', $range);

        $this->db->delete('tbl_mst_target_value');

        foreach ($allData as $sheetName => $data) {



            //////////////////////////////////////////////////////////////////////////////////////

            $a=1;
            foreach ($data as $values) {
                $b=1;
                
                foreach ($values as $secd) {

                    $teraVal = $this->getTera($allData,3,$b);


                    if($a>=6){
                        if($b==1){
                          $iscat = $secd;  
                      }
                      if($b==2){
                          $itemCode = $secd;  
                      }
                      if($b==3){
                          $itemName = $secd;  
                      }
                      if($b==4){
                          $uom = $secd;  
                      }
                      if($b==$b){
                          $targetValue = $secd;  
                      }
                      if($teraVal!=$sheetName){

                        $teraCode = $teraVal;
                    }

                    if($itemCode!="" && $teraCode!="" && $b!=1){
                        // echo $a."][".$b."] ".$sheetName." - ".$iscat." - ".$itemCode." - ".$itemName." - ".$uom." - ".$targetValue." - ".$teraCode." - <br>";


                        // $dateArr = explode('-', $uploadDate);

                        // $dateMonth = $dateArr[0]."-".$dateArr[1];
                        // $this->db->where('`upload_month`', $dateMonth);

                        // $this->db->where('`target_range`', $range);

                        // $this->db->delete('tbl_mst_target_value');



                        $data['sess'] = $sess = $this->session->userdata('User');

                        if($range=='C'){
                        $arrIn = array(
                            'upload_month'   => $dateMonth,
                            'sheetName'      => $sheetName,
                            'itemCode'       => $itemCode,
                            'itemName'       => $itemName,
                            'uom'            => $uom,
                            'iscat'          => $iscat,
                            'target_range'   => $range,
                            'teraCode'       => $teraCode,
                            'targetValue_c'  => $targetValue,
                            'user'           => $sess['username'],
                            'date'           => date('Y-m-d'),
                            'time'           => date('H:i:s')
                        );

                    }else if($range=='D'){
                        $arrIn = array(
                            'upload_month'   => $dateMonth,
                            'sheetName'      => $sheetName,
                            'itemCode'       => $itemCode,
                            'itemName'       => $itemName,
                            'uom'            => $uom,
                            'iscat'          => $iscat,
                            'target_range'   => $range,
                            'teraCode'       => $teraCode,
                            'targetValue_d'  => $targetValue,
                            'user'           => $sess['username'],
                            'date'           => date('Y-m-d'),
                            'time'           => date('H:i:s')
                        );
                    }
                        $this->db->insert('tbl_mst_target_value', $arrIn);
                            // echo $this->db->last_query();

                        if ($this->db->trans_status() === FALSE) {
                            $IsInserted = 0;
                            $this->db->trans_rollback();
                        } else {
                            $IsInserted = 1;
                            $this->db->trans_commit();
                        }


                    }
                }

                $b++;
            }
            $a++;
        }


    }


    return $IsInserted;
}



}

?>