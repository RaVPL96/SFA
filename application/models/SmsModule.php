<?php

require_once 'mobitel/ESMSWS.php';

class SmsModule extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function getSmstoDatabase() {
        $session = createSession('', 'esmsusr_68vsnCdV', 'R2AqUhOk', '');
        //print_r(serviceTest('', 'esmsusr_68vsnCdV', 'R2AqUhOk', ''));
        //echo '<br>';
        //echo isSession($session) . '<br>';
        $smsArray = getMessagesFromLongNumber($session, "94707062062");
        print_r($smsArray);
        //echo '<br>';
        ///echo 'count($smsArray)' . count($smsArray);

        if (!empty($smsArray) && isset($smsArray)) {
            if (count($smsArray) > 1) {
                foreach ($smsArray as $s) {
                    /*
                      echo $s->message;
                      echo '<br>';
                      echo $s->messageId;
                      echo '<br>';
                      echo $s->recipients;
                      echo '<br>';
                      echo $s->retries;
                      echo '<br>';
                      echo $s->sender;
                      echo '<br>';
                      echo $s->sequenceNum;
                      echo '<br>';
                      echo $s->status;
                      echo '<br>';
                      echo $s->time;
                      echo '<br>';
                      echo $s->messageType;
                      echo '<br>';
                      echo date('Y-m-d', strtotime('2023-06-12T10:41:29+05:30'));
                      echo date('H:i:s', strtotime('2023-06-12T10:41:29+05:30'));
                     */
                    $arr = array(
                        '`recipients`' => $s->recipients,
                        '`sender`' => $s->sender,
                        '`message`' => $s->message,
                        '`messageId`' => $s->messageId,
                        '`retries`' => $s->retries,
                        '`sequenceNum`' => $s->sequenceNum,
                        '`status`' => $s->status,
                        '`time`' => $s->time,
                        '`messageType`' => $s->messageType,
                        '`sms_date`' => date('Y-m-d', strtotime($s->time)),
                        '`sms_time`' => date('H:i:s', strtotime($s->time))
                    );
                    $this->db->insert('`tbl_trans_sms_receive_log`', $arr);
                }
            } else {
                $s = $smsArray;
                /*
                  echo $s->message;
                  echo '<br>';
                  echo $s->messageId;
                  echo '<br>';
                  echo $s->recipients;
                  echo '<br>';
                  echo $s->retries;
                  echo '<br>';
                  echo $s->sender;
                  echo '<br>';
                  echo $s->sequenceNum;
                  echo '<br>';
                  echo $s->status;
                  echo '<br>';
                  echo $s->time;
                  echo '<br>';
                  echo $s->messageType;
                  echo '<br>';
                  echo date('Y-m-d', strtotime($s->time));
                  echo date('H:i:s', strtotime($s->time)); */

                $arr = array(
                    '`recipients`' => $s->recipients,
                    '`sender`' => $s->sender,
                    '`message`' => $s->message,
                    '`messageId`' => $s->messageId,
                    '`retries`' => $s->retries,
                    '`sequenceNum`' => $s->sequenceNum,
                    '`status`' => $s->status,
                    '`time`' => $s->time,
                    '`messageType`' => $s->messageType,
                    '`sms_date`' => date('Y-m-d', strtotime($s->time)),
                    '`sms_time`' => date('H:i:s', strtotime($s->time))
                );
                $this->db->insert('`tbl_trans_sms_receive_log`', $arr);
            }
        }
        echo 'Data Collected';
        closeSession($session);
    }

    function validateSmstoDatabase() {
        $this->db->select('`id`, `recipients`, `sender`, `message`, `messageId`, `retries`, `sequenceNum`, `status`, `time`, `messageType`, `sms_date`, `sms_time`');
        $this->db->from('tbl_trans_sms_receive_log');
        $this->db->where('is_processed', 0);
        $q = $this->db->get();
        $result = $q->result_array();
        foreach ($result as $r) {
            $msg1 = strtoupper(trim($r['message']));
            $arrUpdateLog = null;
            $msg = str_replace(array('NO', '.', ' ', '(', ')', '_', ',', '@'), '', $msg1);
            if (substr($msg, 0, 3) === 'KDR' && is_numeric(substr($msg, -6)) === true) {
                $unique_id = $r['sender'] . substr($msg, -7);
                //check already exists 
                $this->db->select('id,COUNT(id) as c'); //get count and check already exits else create and insert
                $this->db->from('`tbl_trans_sms_valid`');
                $arrWhere = array('unique_id' => $unique_id);
                $this->db->where($arrWhere);
                $query = $this->db->get();
                $resultCount = $query->row();

                if ($resultCount->c < 1) {//not found only add	   
                    if (strlen($msg) == 10 || strlen($msg) == 9) {//accurate length is 10 = KDRN0A600728
                        //KDRA540101                         
                        //KDR540101 
                        //KDR540101 
                        $strCode = '';
                        $strExpectedCode = '';
                        $strExpectedCodes = '';
                        $strFinalCode = '';
                        $is_code_finalized = 0;
                        $is_Valid_Code = 0;
                        $numberPart = substr($msg, -6);
                        if (strlen($msg) == 10) {// no issues, customer sent english letter with the code
                            $strFinalCode = $strCode = substr($msg, -7);
                            $is_code_finalized = 1;
                            if ($numberPart >= 540101 && $numberPart <= 640101) {//A Range
                                $strExpectedCode = 'A' . $numberPart;
                                $strExpectedCodes .= $strExpectedCode . ' /';
                                if ($strExpectedCode == $strFinalCode) {
                                    $is_Valid_Code = 1;
                                }
                            }
                            if ($numberPart >= 732131 && $numberPart <= 832131) {//B Range
                                $strExpectedCode = 'B' . $numberPart;
                                $strExpectedCodes .= $strExpectedCode . ' /';
                                if ($strExpectedCode == $strFinalCode) {
                                    $is_Valid_Code = 1;
                                }
                            }
                            if ($numberPart >= 421461 && $numberPart <= 521461) {//C Range
                                $strExpectedCode = 'C' . $numberPart;
                                $strExpectedCodes .= $strExpectedCode . ' /';
                                if ($strExpectedCode == $strFinalCode) {
                                    $is_Valid_Code = 1;
                                }
                            }
                            if ($numberPart >= 861451 && $numberPart <= 961451) {//D Range
                                $strExpectedCode = 'D' . $numberPart;
                                $strExpectedCodes .= $strExpectedCode . ' /';
                                if ($strExpectedCode == $strFinalCode) {
                                    $is_Valid_Code = 1;
                                }
                            }
                            if ($numberPart >= 251651 && $numberPart <= 351651) {//E Range
                                $strExpectedCode = 'E' . $numberPart;
                                $strExpectedCodes .= $strExpectedCode . ' /';
                                if ($strExpectedCode == $strFinalCode) {
                                    $is_Valid_Code = 1;
                                }
                            }
                            if ($numberPart >= 781551 && $numberPart <= 881551) {//F Range
                                $strExpectedCode = 'F' . $numberPart;
                                $strExpectedCodes .= $strExpectedCode . ' /';
                                if ($strExpectedCode == $strFinalCode) {
                                    $is_Valid_Code = 1;
                                }
                            }
                            /////////////////////////////////////////////////////////                            
                            if ($numberPart >= 100102 && $numberPart <= 200102) {//G Range
                                $strExpectedCode = 'G' . $numberPart;
                                $strExpectedCodes .= $strExpectedCode . ' /';
                                if ($strExpectedCode == $strFinalCode) {
                                    $is_Valid_Code = 1;
                                }
                            }

                            if ($numberPart >= 200103 && $numberPart <= 250103) {//H Range
                                $strExpectedCode = 'H' . $numberPart;
                                $strExpectedCodes .= $strExpectedCode . ' /';
                                if ($strExpectedCode == $strFinalCode) {
                                    $is_Valid_Code = 1;
                                }
                            }
                            if ($numberPart >= 961452 && $numberPart <= 999904) {//H Range
                                $strExpectedCode = 'H' . $numberPart;
                                $strExpectedCodes .= $strExpectedCode . ' /';
                                if ($strExpectedCode == $strFinalCode) {
                                    $is_Valid_Code = 1;
                                }
                            }
                            if ($numberPart >= 240102 && $numberPart <= 251650) {//H Range
                                $strExpectedCode = 'H' . $numberPart;
                                $strExpectedCodes .= $strExpectedCode . ' /';
                                if ($strExpectedCode == $strFinalCode) {
                                    $is_Valid_Code = 1;
                                }
                            }

                            if ($numberPart >= 651781 && $numberPart <= 751781) {//N Range
                                $strExpectedCode = 'N' . $numberPart;
                                $strExpectedCodes .= $strExpectedCode . ' /';
                                if ($strExpectedCode == $strFinalCode) {
                                    $is_Valid_Code = 1;
                                }
                            }
                            if ($numberPart >= 351641 && $numberPart <= 451641) {//K Range
                                $strExpectedCode = 'K' . $numberPart;
                                $strExpectedCodes .= $strExpectedCode . ' /';
                                if ($strExpectedCode == $strFinalCode) {
                                    $is_Valid_Code = 1;
                                }
                            }
                        } else {//need to suggest valid letter to verify
                            $is_Valid_Code = 1; //temporary take as a valid code until customer care team validate it
                            if ($numberPart >= 540101 && $numberPart <= 640101) {//A Range
                                $strCode .= 'A' . $numberPart . ' / ';
                            }
                            if ($numberPart >= 732131 && $numberPart <= 832131) {//B Range
                                $strCode .= 'B' . $numberPart . ' / ';
                            }
                            if ($numberPart >= 421461 && $numberPart <= 521461) {//C Range
                                $strCode .= 'C' . $numberPart . ' / ';
                            }
                            if ($numberPart >= 861451 && $numberPart <= 961451) {//D Range
                                $strCode .= 'D' . $numberPart . ' / ';
                            }
                            if ($numberPart >= 251651 && $numberPart <= 351651) {//E Range
                                $strCode .= 'E' . $numberPart . ' / ';
                            }
                            if ($numberPart >= 781551 && $numberPart <= 881551) {//F Range
                                $strCode .= 'F' . $numberPart . ' / ';
                            }
                            /////////////////////////////////////////////////////////                            
                            if ($numberPart >= 100102 && $numberPart <= 200102) {//G Range
                                $strCode .= 'G' . $numberPart . ' / ';
                            }

                            if ($numberPart >= 200103 && $numberPart <= 250103) {//H Range
                                $strCode .= 'H' . $numberPart . ' / ';
                            }
                            if ($numberPart >= 961452 && $numberPart <= 999904) {//H Range
                                $strCode .= 'H' . $numberPart . ' / ';
                            }
                            if ($numberPart >= 240102 && $numberPart <= 251650) {//H Range
                                $strCode .= 'H' . $numberPart . ' / ';
                            }

                            if ($numberPart >= 651781 && $numberPart <= 751781) {//N Range
                                $strCode .= 'N' . $numberPart . ' / ';
                            }
                            if ($numberPart >= 351641 && $numberPart <= 451641) {//K Range
                                $strCode .= 'K' . $numberPart . ' / ';
                            }
                        }
                        if ((strlen($msg) === 10 && $is_Valid_Code === 1) || (strlen($msg) < 10 && $is_Valid_Code === 1)) {
                            $arr = null;
                            if ($r['sms_date'] >= '2023-08-03') {//get same date and time as applied date and time
                                $arr = array(
                                    '`log_id`' => $r['id'],
                                    '`unique_id`' => $unique_id,
                                    '`recipients`' => $r['recipients'],
                                    '`sender`' => $r['sender'],
                                    '`message`' => $r['message'],
                                    '`messageId`' => $r['messageId'],
                                    '`retries`' => $r['retries'],
                                    '`sequenceNum`' => $r['sequenceNum'],
                                    '`status`' => $r['status'],
                                    '`time`' => $r['time'],
                                    '`messageType`' => $r['messageType'],
                                    '`sms_date`' => $r['sms_date'],
                                    '`sms_time`' => $r['sms_time'],
                                    '`applied_date`' => $r['sms_date'],
                                    '`applied_time`' => $r['sms_time'],
                                    '`expected_code`' => $strCode,
                                    '`finalized_code`' => $strFinalCode,
                                    '`is_code_finalized`' => $is_code_finalized,
                                    '`is_winner`' => 0,
                                    '`is_confirmed`' => 0,
                                    '`is_rejected`' => 0
                                        //'`comments`'=>$r['']
                                );
                            } else {
                                $arr = array(
                                    '`log_id`' => $r['id'],
                                    '`unique_id`' => $unique_id,
                                    '`recipients`' => $r['recipients'],
                                    '`sender`' => $r['sender'],
                                    '`message`' => $r['message'],
                                    '`messageId`' => $r['messageId'],
                                    '`retries`' => $r['retries'],
                                    '`sequenceNum`' => $r['sequenceNum'],
                                    '`status`' => $r['status'],
                                    '`time`' => $r['time'],
                                    '`messageType`' => $r['messageType'],
                                    '`sms_date`' => $r['sms_date'],
                                    '`sms_time`' => $r['sms_time'],
                                    '`applied_date`' => '2000-01-01',
                                    '`applied_time`' => '00:00:01',
                                    '`expected_code`' => $strCode,
                                    '`finalized_code`' => $strFinalCode,
                                    '`is_code_finalized`' => $is_code_finalized,
                                    '`is_winner`' => 0,
                                    '`is_confirmed`' => 0,
                                    '`is_rejected`' => 0
                                );
                            }
                            $this->db->insert('`tbl_trans_sms_valid`', $arr);
                            $arrUpdateLog = array('is_processed' => 1);
                        } else {//rejected message
                            if (!(strlen($msg) == 10 && $is_Valid_Code == 1)) {
                                $arrUpdateLog = array('is_processed' => 1, 'is_reject' => 1, '`reject_reason`' => 'CODE IS WRONG FROMAT-' . $strFinalCode . '(' . $strExpectedCodes . ')');
                            } else {
                                $arrUpdateLog = array('is_processed' => 1, 'is_reject' => 1, '`reject_reason`' => 'CODE NUMBER IS WRONG FROMAT-' . $strFinalCode . '(' . $strExpectedCodes . ')');
                            }
                        }
                    } else {
                        $arrUpdateLog = array('is_processed' => 1, 'is_reject' => 1, '`reject_reason`' => 'Invalid character length-' . $msg);
                    }
                } else {
                    $arrUpdateLog = array('is_processed' => 1, 'is_reject' => 1, '`reject_reason`' => 'Already mixed with row id -' . $resultCount->id);
                }
            } else {
                $arrUpdateLog = array('is_processed' => 1, 'is_reject' => 1, '`reject_reason`' => 'Invalid message -KDR part=' . substr($msg, 0, 3) . ' (' . $msg . ') Last 6 Digits' . (substr($msg, -6)) . '  is Number: ' . is_numeric(substr($msg, -6)));
            }
            $this->db->where('id', $r['id']);
            $this->db->update('tbl_trans_sms_receive_log', $arrUpdateLog);
        }
        echo 'completed validation process';
    }

    function getSmsFromDatabase() {
        $this->db->select('`id`, `recipients`, `sender`, `message`, `messageId`, `retries`, `sequenceNum`, `status`, `time`, `messageType`, `sms_date`, `sms_time`,`is_processed`,`is_reject`, `reject_reason`');
        $this->db->from('tbl_trans_sms_receive_log');
        $q = $this->db->get();
        $result = $q->result_array();
        //print_r($result);
        return $result;
    }

    function getValidSmsFromDatabase($isRaffelProcessed = 3, $fromDate = null) {
        $this->db->select('`id`, `log_id`, `unique_id`, `recipients`, `sender`, `message`, `messageId`, `retries`, `sequenceNum`, `status`, `time`, `messageType`, `sms_date`, `sms_time`, `applied_date`, `applied_time`,`is_draw_processed`, `expected_code`, `finalized_code`, `is_code_finalized`, `is_winner`, `is_confirmed`, `is_rejected`, `comments`, `name`, `hall_name`, `address`, `district`');
        $this->db->from('tbl_trans_sms_valid');
        if ($isRaffelProcessed == 0) {
            $this->db->where('`is_draw_processed`', $isRaffelProcessed);
        }
        if (!empty($fromDate) && isset($fromDate) && $fromDate != null) {
            $this->db->where('`applied_date`', $fromDate);
        }
        $this->db->order_by('id');
        $q = $this->db->get();
        $result = $q->result_array();
        //print_r($result);
        return $result;
    }
    /*
    function setSMSforRaffleandDraw($fromDate = null, $unallocatedSMSCount = 0) {
        $isRaffelProcessed = 0;
        //first get number of unallocated sms are set or not 
        if ($unallocatedSMSCount > 0) {
            $this->db->select('COUNT(`id`) AS sms_unallocated');
            $this->db->from('tbl_trans_sms_valid');
            if (!empty($fromDate) && isset($fromDate) && $fromDate != null) {
                $this->db->where('`applied_date`', $fromDate);
            }
            if (!empty($fromDate) && isset($fromDate) && $fromDate != null) {
                $this->db->where('`sms_date`<>', $fromDate);
            }
            $this->db->order_by('id');
            $q = $this->db->get();
            $result = $q->row();
            //check already allocated sms from unallocated sms set are equal or less than seleced sms
            if ($result->sms_unallocated < $unallocatedSMSCount) {//start allocation of remain sms to that requested date
                echo $neededSmsCount = $unallocatedSMSCount - $result->sms_unallocated;
                $arrWhere = array(
                    'applied_date' => '2000-01-01'
                );
                $this->db->order_by('id');
                $this->db->limit($neededSmsCount);
                $arrSet = array('applied_date' => $fromDate);
                $this->db->update('tbl_trans_sms_valid', $arrSet);
            }
        }
        //echo 'update unallocated<br>';
        //now get number of winners for the day
        $this->db->select('COUNT(`id`) AS winners');
        $this->db->from('tbl_trans_sms_valid');
        $arr = array(
            '`applied_date`' => $fromDate,
            'is_winner' => 1,
            'is_rejected' => 0,
        );
        $this->db->where($arr);
        $this->db->order_by('id');
        $q = $this->db->get();
        $resultset = $q->row();
        //echo $this->db->last_query();
        if ($resultset->winners < 12) {//number of winners to select is 12 per day
            //needed winners
            echo $neededWinners = 12 - $resultset->winners;
            //get allowed and selected users ids
            $this->db->select('`id`');
            $this->db->from('tbl_trans_sms_valid');
            $arr = array(
                '`applied_date`' => $fromDate,
                'is_winner' => 0,
                'is_rejected' => 0,
            );
            $this->db->where($arr);
            $this->db->order_by('id');
            $q = $this->db->get();
            $r = $q->result_array();
            if ($neededWinners >= count($r)) {//arry to be selecte winners from database is lower thant expected
                $neededWinners = count($r);
            }
            for ($x = 1; $x <= $neededWinners; $x++) {
                $arrayLength = count($r);  //echo '--';
                $rand = rand(0, $arrayLength - 1);  //              echo '--<br>';
                $updateArr = array('is_winner' => 1);
                $this->db->where('`id`', $r[$rand]['id']);
                //echo '--<br>--id-';echo ($r[$rand]['id']);

                $this->db->update('tbl_trans_sms_valid', $updateArr);

                //REMOVE ALREADY SELECTED ONE from the array
                unset($r[$rand]);
                $r = array_values($r);

                //echo "The number is: $x - $r[$rand]['id'] <br>";
            }
        }
        //update entire day as a processed batch
        $updateArr = array('is_draw_processed' => 1);
        $this->db->where('`applied_date`', $fromDate);
        $this->db->update('tbl_trans_sms_valid', $updateArr);
    }
    */
    function setSMSforRaffleandDraw($fromDate = null, $unallocatedSMSCount = 0) {
        $isRaffelProcessed = 0;
        //first get number of unallocated sms are set or not 
        if ($unallocatedSMSCount > 0) {
            $this->db->select('COUNT(`id`) AS sms_unallocated');
            $this->db->from('tbl_trans_sms_valid');
            if (!empty($fromDate) && isset($fromDate) && $fromDate != null) {
                $this->db->where('`applied_date`', $fromDate);
            }
            if (!empty($fromDate) && isset($fromDate) && $fromDate != null) {
                $this->db->where('`sms_date`<>', $fromDate);
            }
            $this->db->order_by('id');
            $q = $this->db->get();
            $result = $q->row();
            //check already allocated sms from unallocated sms set are equal or less than seleced sms
            if ($result->sms_unallocated < $unallocatedSMSCount) {//start allocation of remain sms to that requested date
                echo $neededSmsCount = $unallocatedSMSCount - $result->sms_unallocated;
                $arrWhere = array(
                    'applied_date' => '2000-01-01'
                );
                $this->db->order_by('id');
                $this->db->limit($neededSmsCount);
                $arrSet = array('applied_date' => $fromDate);
                $this->db->update('tbl_trans_sms_valid', $arrSet);
            }
        }
        //echo 'update unallocated<br>';
        //now get number of winners for the day
        $this->db->select('COUNT(`id`) AS winners');
        $this->db->from('tbl_trans_sms_valid');
        $arr = array(
            '`applied_date`' => $fromDate,
            'is_winner' => 1,
            'is_rejected' => 0,
        );
        $this->db->where($arr);
        $this->db->order_by('id');
        $q = $this->db->get();
        $resultset = $q->row();
        //echo $this->db->last_query();
        if ($resultset->winners < 12) {//number of winners to select is 12 per day
            //needed winners
            echo $neededWinners = 12 - $resultset->winners;
            //get allowed and selected users ids
            $this->db->select('`id`');
            $this->db->from('tbl_trans_sms_valid');
            $arr = array(
                '`applied_date`' => $fromDate, 
                'is_winner' => 0,
                'is_rejected' => 0,
            );
            $this->db->where('`finalized_code`!=','');
            $this->db->where($arr);
            $this->db->order_by('id');
            $q = $this->db->get();
            $r = $q->result_array();
            if ($neededWinners >= count($r)) {//arry to be selecte winners from database is lower thant expected
                $neededWinners = count($r);
            }
            for ($x = 1; $x <= $neededWinners; $x++) {
                $arrayLength = count($r);  //echo '--';
                $rand = rand(0, $arrayLength - 1);  //              echo '--<br>';
                $updateArr = array('is_winner' => 1);
                $this->db->where('`id`', $r[$rand]['id']);
                //echo '--<br>--id-';echo ($r[$rand]['id']);

                $this->db->update('tbl_trans_sms_valid', $updateArr);

                //REMOVE ALREADY SELECTED ONE from the array
                unset($r[$rand]);
                $r = array_values($r);

                //echo "The number is: $x - $r[$rand]['id'] <br>";
            }
        }
        //update entire day as a processed batch
        $updateArr = array('is_draw_processed' => 1);
        $this->db->where('`applied_date`', $fromDate);
        $this->db->update('tbl_trans_sms_valid', $updateArr);
    }
    
    function getWinners($fromDate, $isWinner = 1, $id = null) {
        $this->db->select('`id`, `log_id`, `unique_id`, `recipients`, `sender`, `message`, `messageId`, `retries`, `sequenceNum`, `status`, `time`, `messageType`, `sms_date`, `sms_time`, `applied_date`, `applied_time`,`is_draw_processed`, `expected_code`, `finalized_code`, `is_code_finalized`, `is_winner`, `is_confirmed`, `is_rejected`, `comments`, `name`, `hall_name`, `address`, `district`');
        $this->db->from('tbl_trans_sms_valid');
        $this->db->where('`is_winner`', $isWinner);
        if (!empty($id) && isset($id) && $id != null) {
            $this->db->where('`id`', $id);
        }
        if (!empty($fromDate) && isset($fromDate) && $fromDate != null) {
            $this->db->where('`applied_date`', $fromDate);
        }
        $this->db->order_by('id,is_winner,is_rejected');
        $q = $this->db->get();
        if (!empty($id) && isset($id) && $id != null) {
            $result = $q->row();
        } else {
            $result = $q->result_array();
        }
        //print_r($result);
        return $result;
    }

    function updateWinners($data) {
        $rowID = $data['row_id'];
        $finalized_code = '';
        $IsInserted = 1;
        //print_r($data);
        if (!empty($data['finalized_code']) && isset($data['finalized_code'])) {
            $finalized_code = $data['finalized_code'];
        }
        $is_code_finalized = 0;
        if (!empty($data['is_code_finalized']) && isset($data['is_code_finalized'])) {
            $is_code_finalized = $data['is_code_finalized'];
        }
        $is_rejected = 0;
        if (!empty($data['is_rejected']) && isset($data['is_rejected'])) {
            $is_rejected = $data['is_rejected'];
        }
        $is_confirmed=0;
        if (!empty($data['is_confirmed']) && isset($data['is_confirmed'])) {
            $is_confirmed = $data['is_confirmed'];
        }

        $comments = '';
        if (!empty($data['comments']) && isset($data['comments'])) {
            $comments = $data['comments'];
        }

        $name = '';
        if (!empty($data['name']) && isset($data['name'])) {
            $name = $data['name'];
        }
        $hall_name = '';
        if (!empty($data['hall_name']) && isset($data['hall_name'])) {
            $hall_name = $data['hall_name'];
        }
        $address = '';
        if (!empty($data['address']) && isset($data['address'])) {
            $address = $data['address'];
        }
        $district = '';
        if (!empty($data['district']) && isset($data['district'])) {
            $district = $data['district'];
        }

        $updateArr = array(
            'finalized_code' => $finalized_code,
            'is_code_finalized' => $is_code_finalized,
            'is_rejected' => $is_rejected,
            'is_confirmed'=> $is_confirmed,
            'comments' => $comments,
            'name' => $name,
            'hall_name' => $hall_name,
            'address' => $address,
            'district' => $district,
        );
        //print_r($updateArr);die();
        $this->db->trans_begin();
        $this->db->where('id', $rowID);
        $this->db->update('tbl_trans_sms_valid', $updateArr);
        if ($this->db->trans_status() === FALSE) {
            $IsInserted = 0;
            $this->db->trans_rollback();
        } else {
            $IsInserted = 1;
            $this->db->trans_commit();
        }
        return $IsInserted;
    }

}
