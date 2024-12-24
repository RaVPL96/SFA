<?php
/*


 * This system Licenced to Raigam Marketing Services (Pvt) Ltd.

 * Developed By: Lakshitha Pradeep Karunarathna  *

 * Company: Serving Cloud INC in association with MyOffers.lk  *

 * Date Started:  October 20, 2017  *


 */
?>
<style>
    .tableFixHead          {
        overflow-y: auto;
        height: 300px;
    }
    .tableFixHead .thead2 tr {
        position: sticky;
        top: 0;
        z-index: 1;
        background: #c8f1eb;
    }
    .tableFixHead tbody th {
        position: sticky;
        left: 0;
    }


    .view {
        margin: auto;
    }
    thead tr th{
        background: #0070c0 !important;
        color:#ffffff;
    }
    .wrappers {
        position: relative;
        /*overflow: auto;*/
        /*border: 1px solid black;*/
        white-space: normal;
    }

    .sticky-col {
        position: -webkit-sticky;
        position: sticky;
        background-color: white;
    }
    .first-col {
        width: 100px;
        min-width: 100px;
        /*max-width: 100px;*/
        left: 0px;
        z-index: 5;
    }



    .presentation {
        position: relative;
        border-collapse: separate;
        border-spacing: 0;
    }

    .presentation th,
    .presentation td {
        width: 50px;
        padding: 5px;
        background-color: white;
    }

    .presentation tbody {
        height: 90px;
    }

    .presentation th {
        text-align: center;
        position: sticky;
        top: 0;
        z-index: 2;
    }
    .presentation th.fix {
        text-align: center;
        position: sticky;
        top: 0;
        z-index: 2;
    }
    .presentation th:nth-child(1) {
        left: 0;
        z-index: 3;
    }

    .presentation td {
        text-align: center;
        /*white-space: pre;*/
    }

    .presentation tbody tr td:nth-child(1) {
        position: sticky;
        left: 0;
        /*z-index: 1;*/
    }
    .headcol{
        position: -webkit-sticky;
        position: sticky;
        background-color: white;
    }
</style>
<?php include_once BASEPATH . ('../application/views/template/leftsidebar.php'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Secondary Sales HR Module - Key Accounts
            <small>Maintain Secondary Sales HR Module Details </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Secondary Sales HR Data Control Module</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12" style="overflow-x: scroll;">
                <div id="successMessage" class="hideDiv">Updated Successfully! </div>
                <div id="errorMessage" class="hideDiv">Invalid Data! Please Try Again. </div>
                <div class="keepgap"></div>
                <form class="form-horizontal" id="" action="<?= base_url('hr/timeAttendance') ?>" method="post">
                    <div class="col-md-12">

                        <!--
<div class="col-md-6">
    <div class="form-group">
        <select id="sbArea" class="form-control">
            <option value=""> -- Select Area -- </option>
                        <?php
                        foreach ($territory as $t) {
                            echo '<option value="' . $t['territory_name'] . '"> ' . $t['territory_name'] . '</option>';
                        }
                        ?>
        </select>
    </div>
</div>
                        -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-2">Area <span class="text-red">*</span></label>
                                <div class="col-md-6">
                                    <select id="sbArea" name="areaID" class="form-control">
                                        <option value="-1"> -- Select Area -- </option>
                                        <?php
                                        foreach ($AreaList as $a) {
                                            $select = '';
                                            if (!empty($AreaID) && isset($AreaID) && $a['id'] == $AreaID) {
                                                $select = 'selected';
                                            }
                                            if ($sess['grade_id'] == 4) {
                                                foreach ($ASE_Area as $ase) {
                                                    if ($ase['area_id'] == $a['id']) {
                                                        echo '<option ' . $select . ' value="' . $a['id'] . '"> ' . $a['area_name'] . '</option>';
                                                    }
                                                }
                                            } else {
                                                echo '<option ' . $select . ' value="' . $a['id'] . '"> ' . $a['area_name'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!--
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-2">Territory <span class="text-red">*</span></label>
                                <div class="col-md-6">
                                    <select id="sbTerritory" name="territoryID" class="form-control">
                                        <option value=""> -- Select Territory -- </option>
                        <?php
                        foreach ($territory as $t) {
                            $select = '';
                            if (!empty($TerritoryID) && isset($TerritoryID) && $TerritoryID == $t['id']) {
                                $select = 'selected';
                            }
                            echo '<option ' . $select . ' value="' . $t['id'] . '"> ' . $t['territory_name'] . '</option>';
                        }
                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-2">Range <span class="text-red">*</span></label>
                                <div class="col-md-6">
                                    <select id="sbRange" name="rangeID" class="form-control">
                                        <option value="-1"> -- Select Range -- </option>
                                        <?php
                                        foreach ($RangeList as $a) {
                                            $select = '';
                                            if (!empty($RangeID) && isset($RangeID) && $a['id'] == $RangeID) {
                                                $select = 'selected';
                                            }

                                            if ($sess['grade_id'] == 4) {
                                                foreach ($ASE_Area as $ase) {
                                                    if ($ase['range_id'] == $a['id']) {
                                                        echo '<option ' . $select . ' value="' . $a['id'] . '"> ' . $a['range_name'] . '</option>';
                                                    }
                                                }
                                            } else {
                                                echo '<option ' . $select . ' value="' . $a['id'] . '"> ' . $a['range_name'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-2">Date Range <span class="text-red">*</span></label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="DateRange" class="form-control pull-right active" readonly="" id="reservation" value="<?= $DateRange ?>">
                                    </div><!-- /.input group -->
                                </div><!-- /.form group -->

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="submit" class="btn btn-danger" name="submit" value="Get Report">
                            </div>
                        </div>
                    </div>
                </form>
                <div class="col-md-12" style="overflow-x: scroll; overflow-y: scroll; max-height:600px;">
                    <form class="form-horizontal" id="" action="<?= base_url('hr/timeAttendanceComment') ?>" method="post">
                        <?php
                        if (!empty($TimeAttendance) && isset($TimeAttendance)) {
                            /*
                              $t = '<option value="-">--Select One--</option>';
                              foreach ($AttenType as $g) {
                              $t = $t . '<option value="' . $g['type_name'] . '">' . $g['type_name'] . '</option>';
                              }
                              $t = $t . '</select>';
                             */
                            ?>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('attendance_table', 'Attendance_<?= $DateRange ?>')" value="Download Excel">
                                    <br>
                                    You can mark attendance on Saturday and Sunday only on Monday and on all other days you can mark attendance on that day only.<br>සදුදා දිනයට පමණක් ඔබට සෙනසුරාදා සහ ඉරිදා පැමිණීම සලකුණු කල හැකි අතර අනෙක් සෑම දිනකම අදාල දිනයට පමණක් පැමිණීම සලකුණු කලහැක. </div>
                            </div>
                            <table  id="attendance_table" class="table table-hover presentation">
                                <thead>
                                    <tr>
                                        <th>Area</th>
                                        <th class="sticky-col first-col">Territory</th>
                                        <th>Range</th>
                                        <th>Sales Rep</th>
                                        <th>Date</th>
                                        <!--
                                        <th>Time Check In</th>
                                        <th>Check In Distance (m)</th> 
                                        -->
                                        <th>First Made Call Time</th> 
                                        <!-- <th>First PC Time</th> -->
                                        <th>Time Gap</th>
                                        <!-- <th>Last PC Time</th> -->
                                        
                                        <th>Last Made Call Time</th>
                                        
                                        <!-- <th>Time Check Out</th> -->
                                        <!-- <th style="max-width: 50px;">Time Gap</th> -->
                                        <!-- <th>Check Out Distance (m)</th> -->
                                        <!-- <th>Bill Count</th>   -->
                                        <th>Made Calls</th>
                                        <th>PC</th>
                                        <th>UPC</th>
                                        <!-- <th>Total Booking Value</th> -->
                                        <th>Morning Status</th>
                                        <th>Evening Status</th>
                                        <th>ASE/ASM Comments</th>
                                        <th>RSM Comments</th>
                                        <th>Trainee Rep Name</th>
                                        <th>Trainee Rep Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($TimeAttendance as $o) {
                                        $colorSet = '';
                                        $colorSet2 = 'style="max-width: 170px;text-wrap: wrap;"';
                                        $colorCode = '';
                                        if ($o['check_in'] == '00:00:00') {
                                            $colorSet = 'style="background: #ffb6b6;"';
                                            $colorSet2 = 'style="background: #ffb6b6;max-width: 170px;text-wrap: wrap;"';
                                            $colorCode = 'background: #ffb6b6;';
                                            $o['first_madecall_time']='00:00';
                                            $o['last_madecall_time']='00:00';
                                        } elseif ($o['check_in'] > '08:00:00') {
                                            $colorSet = 'style="background: #FFD700;"';
                                            $colorSet2 = 'style="background: #FFD700;max-width: 170px;text-wrap: wrap;"';
                                            $colorCode = 'background: #FFD700;';
                                        }
                                        $firstCall='00:00';
                                        if($o['first_madecall_time']!='00:00:00'){
                                            $firstCall= date('H:i', strtotime($o['first_madecall_time']));                                             
                                        } 
                                        $lastCall='00:00';
                                        if($o['last_madecall_time']!='00:00:00'){
                                            $lastCall= date('H:i', strtotime($o['last_madecall_time']));                                             
                                        } 
                                        ?>
                                        <tr <?= $colorSet ?> >
                                            <td class="sticky-col first-col" <?= $colorSet ?>><?= $o['area_name'] ?></td>
                                            <td class="sticky-col first-col" <?= $colorSet ?>><?= $o['territory_name'] ?></td>
                                            <td <?= $colorSet ?>><?= $o['range_name'] ?></td>
                                            <td <?= $colorSet ?>><a target="_blank" href="<?= base_url('hr/timeAttendanceViewMap/null/' . $o['id']) ?>"><?= $o['user_name'] ?></a></td>
                                            <td <?= $colorSet ?>><?= $o['date_work'] ?></td>
                                            <!--
                                            <td style="<?= $colorCode ?> text-align: right;"><?= date('H:i', strtotime($o['check_in'])) ?></td>
                                            <td style="<?= $colorCode ?> text-align: right;"><?= number_format((int) ($o['check_in_distance'] * 1000)) ?></td>
                                            -->
                                            <td style="<?= $colorCode ?> text-align: right;"><?=$firstCall ?></td>
                                            <!-- <td style="<?= $colorCode ?> text-align: right;"><?= date('H:i', strtotime($o['first_bill_time'])) ?></td> -->
                                            <td style="<?= $colorCode ?> text-align: right;"><?php
                                                if ($o['first_bill_time'] != '00:00:00') {
                                                    echo $hourdiff = round((strtotime($o['first_bill_time']) - strtotime($o['expected_first_bill_time'])) / 3600, 1) * 60 . ' min';
                                                } else {
                                                    echo '-';
                                                }
                                                ?>
                                            </td>
                                            <!-- <td style="<?= $colorCode ?> text-align: right;"><?= date('H:i', strtotime($o['last_bill_time'])) ?></td> -->
                                            <td style="<?= $colorCode ?> text-align: right;"><?= $lastCall/*date('H:i', strtotime($o['last_madecall_time']))*/ ?></td>
                                            <!-- <td style="<?= $colorCode ?> text-align: right;"><?= date('H:i', strtotime($o['check_out'])) ?></td> -->
                                            <!-- <td style="<?= $colorCode ?> max-width: 50px;  text-align: right;"><?php
                                                if ($o['check_out'] != '00:00:00') {
                                                    echo $hourdiff = round((strtotime($o['check_out']) - strtotime($o['last_bill_time'])) / 3600, 1) * 60 . ' min';
                                                } else {
                                                    echo '-';
                                                }
                                                ?>
                                            </td>
                                            -->
                                            <!-- <td style="<?= $colorCode ?> text-align: right;"><?= number_format((int) ($o['check_out_distance'] * 1000)) ?></td> -->
                                            <!-- <td style="text-align: right;"><?= $o['total_bills'] ?></td>  -->
                                            <td style="<?= $colorCode ?> text-align: right;"><?= $o['made_calls'] ?></td>
                                            <td style="<?= $colorCode ?> text-align: right;"><?= $o['productive_calls'] ?></td>
                                            <td style="<?= $colorCode ?> text-align: right;"><?= $o['unproductive_calls'] ?></td>
                                            <!-- <td style="<?= $colorCode ?> text-align: right;"><?= number_format($o['total_sale']) ?></td> -->


                                            <td <?= $colorSet2 ?>>
                                                <?php
                                                if ($sess['grade_id'] == 4 && ((date('Y-m-d') >= $o['date_work']))) {
                                                    /* if ($sess['grade_id'] == 4 && (($o['date_work'] == date('Y-m-d', strtotime("-1 days"))) || (date('Y-m-d') == $o['date_work']) || ((date('D') === 'Mon') && ($o['date_work'] >= date('Y-m-d', strtotime("-2 days")))) )) { */
                                                    $t = '<option value="-">--Select One--</option>';
                                                    $select = '';
                                                    foreach ($AttenType as $g) {
                                                        $select = '';
                                                        if ($g['type_name'] == $o['attendance_type']) {
                                                            $select = ' selected="selected" ';
                                                        }
                                                        $t = $t . '<option ' . $select . ' value="' . $g['type_name'] . '">' . $g['type_name'] . '</option>';
                                                    }
                                                    $t = $t . '</select>';

                                                    $readonly = '';
                                                    if (($o['date_work'] == date('Y-m-d', strtotime("-1 days")))) {
                                                        $readonly = ' readonly="readonly" ';
                                                    }
                                                    ?>
                                                    <?= '<select ' . $readonly . ' class="form-control" name="hr[ASE][type][' . $o['user_name'] . '][' . $o['date_work'] . ']" style="min-width: 100px;">' . $t ?>
                                                    <input type="hidden" name="hr[ASE][territory][]" value="<?= $o['user_name'] ?>">
                                                    <input type="hidden" name="hr[ASE][<?= $o['user_name'] ?>][date][]" value="<?= $o['date_work'] ?>">
                                                    <?php
                                                } elseif ($sess['grade_id'] == 9 && ((date('Y-m-d') == $o['date_work']) || ((date('D') === 'Mon') && ($o['date_work'] >= date('Y-m-d', strtotime("-2 days")))) )) {//RSM COMMENTS
                                                    ?>
                                                    <input type="hidden" name="hr[ASE][territory][]" value="<?= $o['user_name'] ?>">
                                                    <input type="hidden" name="hr[ASE][<?= $o['user_name'] ?>][date][]" value="<?= $o['date_work'] ?>">

                                                    <?php
                                                    echo $o['attendance_type'];
                                                } else {
                                                    ?>
                                                    <input type="hidden" name="hr[ASE][territory][]" value="<?= $o['user_name'] ?>">
                                                    <input type="hidden" name="hr[ASE][<?= $o['user_name'] ?>][date][]" value="<?= $o['date_work'] ?>">
                                                    <?php
                                                    echo $o['attendance_type'];
                                                }
                                                ?>
                                            </td>
                                            <td <?= $colorSet2 ?>>
                                                <!-- EVENING STATUS-->
                                                <?php
                                                if ($sess['grade_id'] == 4 && ((date('Y-m-d') >= $o['date_work']))) {
                                                    /* if ($sess['grade_id'] == 4 && (($o['date_work'] == date('Y-m-d', strtotime("-1 days"))) || (date('Y-m-d') == $o['date_work']) || ((date('D') === 'Mon') && ($o['date_work'] >= date('Y-m-d', strtotime("-2 days")))) )) { */
                                                    $t = '<option value="-">--Select One--</option>';
                                                    $select = '';
                                                    foreach ($AttenType as $g) {
                                                        $select = '';
                                                        if ($g['type_name'] == $o['attendance_type_evening']) {
                                                            $select = ' selected="selected" ';
                                                        }
                                                        $t = $t . '<option ' . $select . ' value="' . $g['type_name'] . '">' . $g['type_name'] . '</option>';
                                                    }
                                                    $t = $t . '</select>';
                                                    ?>
                                                    <?= '<select class="form-control" name="hr[ASE][type_evening][' . $o['user_name'] . '][' . $o['date_work'] . ']" style="min-width: 100px;">' . $t ?>
                                                    <?php
                                                } else {
                                                    echo $o['attendance_type_evening'];
                                                }
                                                ?>

                                            </td>
                                            <td <?= $colorSet2 ?>>
                                                <?php
                                                if ($sess['grade_id'] == 4 && date('Y-m-d') >= $o['date_work']) {
                                                    /* if ($sess['grade_id'] == 4 && (($o['date_work'] == date('Y-m-d', strtotime("-1 days"))) || (date('Y-m-d') == $o['date_work']) || ((date('D') === 'Mon') && ($o['date_work'] >= date('Y-m-d', strtotime("-2 days")))) )) { */
                                                    ?>
                                                    <?= '<textarea class="form-control" name="hr[ASE][comment][' . $o['user_name'] . '][' . $o['date_work'] . ']" style="min-width: 300px;">' . $o['comment'] . '</textarea>' ?>
                                                    <?php
                                                } else {
                                                    if ($o['comment'] == '-' || $o['comment'] == NULL) {
                                                        echo $o['comment'];
                                                    } else {
                                                        echo $o['comment'] . '(' . $o['review_date'] . ' ' . $o['review_time'] . ' - ' . $o['reporting_person'] . ')';
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td <?= $colorSet2 ?>>
                                                <!-- RSM COMMENTs -->
                                                <?php
                                                /* if ($sess['grade_id'] == 9 && date('Y-m-d') >= $o['date_work']) { */
                                                if ($sess['grade_id'] == 9 && (($o['date_work'] == date('Y-m-d', strtotime("-1 days"))) || (date('Y-m-d') == $o['date_work']) || ((date('D') === 'Mon') && ($o['date_work'] >= date('Y-m-d', strtotime("-2 days")))) )) {
                                                    ?>
                                                    <?= '<textarea class="form-control" name="hr[ASE][comment_rsm][' . $o['user_name'] . '][' . $o['date_work'] . ']" style="min-width: 300px;">' . $o['comment_rsm'] . '</textarea>' ?>
                                                    <?php
                                                } else {
                                                    if ($o['comment_rsm'] == '-' || $o['comment_rsm'] == NULL) {
                                                        echo $o['comment_rsm'];
                                                    } else {
                                                        echo $o['comment_rsm'] . '(' . $o['review_date_rsm'] . ' ' . $o['review_time_rsm'] . ' - ' . $o['reporting_person_rsm'] . ')';
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td <?= $colorSet2 ?>>

                                            </td>
                                            <td <?= $colorSet2 ?>>
                                                <?php
                                                if ($sess['grade_id'] == 4 && date('Y-m-d') >= $o['date_work']) {
                                                    /* if($sess['grade_id'] == 4 && ((date('Y-m-d') == $o['date_work']) || ((date('D') === 'Mon') && ($o['date_work'] >= date('Y-m-d', strtotime("-2 days")))) )) { */
                                                    $t = '<option value="-">--Select One--</option>';
                                                    $select = '';
                                                    foreach ($AttenType as $g) {
                                                        $select = '';
                                                        if ($g['type_name'] == $o['attendance_type_trainee']) {
                                                            $select = ' selected="selected" ';
                                                        }
                                                        $t = $t . '<option ' . $select . ' value="' . $g['type_name'] . '">' . $g['type_name'] . '</option>';
                                                    }
                                                    $t = $t . '</select>';
                                                    ?>
                                                    <?= '<select class="form-control" name="hr[ASE][trainee_type][' . $o['user_name'] . '][' . $o['date_work'] . ']" style="min-width: 100px;">' . $t ?>
                                                                                   <!-- <input type="hidden" name="hr[ASE][territory][]" value="<?= $o['user_name'] ?>">
                                                                                    <input type="hidden" name="hr[ASE][<?= $o['user_name'] ?>][date][]" value="<?= $o['date_work'] ?>"> -->
                                                    <?php
                                                } else {
                                                    echo $o['attendance_type_trainee'];
                                                }
                                                ?>
                                            </td>

                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <?php
                            if ($sess['grade_id'] == 4 || $sess['grade_id'] == 9) {
                                ?>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-danger" name="submit" value="Save Attendance">
                                    </div>
                                </div>
                                <?php
                            }
                        }

                        if (!empty($TimeAttendanceSummery) && isset($TimeAttendanceSummery)) {
                            ?>
                            <input type="button" class="btn btn-success" id="excel2" name="excel2" onclick="ExportExcel('attendance_table2', 'Attendance <?= $DateRange ?> Summery')" value="Download Summery Excel">
                            <h2>Below Report is Under Development</h2>
                            <table  id="attendance_table2" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th colspan="9" style="font-size: 16px; font-weight: bold;">Attendance Summery Report</th>
                                    </tr>
                                    <tr>
                                        <th>Area</th>
                                        <th>Territory</th>
                                        <th>Range</th>
                                        <th>Sales Rep</th>
                                        <th>Working Days</th>
                                        <th>Late Check-in Total(h:m)</th>
                                        <th>Avg Late Check-in (h:m)</th>
                                        <th>Late Last Bill Total(h:m)</th>
                                        <th>Total Bills</th>
                                        <th>Total Sale (Rs.)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    function calAvg($totaltime) {
                                        // Hours is obtained by dividing
                                        // totaltime with 3600
                                        $h = intval($totaltime / 3600);
                                        $totaltime = $totaltime - ($h * 3600);
                                        // Minutes is obtained by dividing
                                        // remaining total time with 60
                                        $m = intval($totaltime / 60);
                                        // Remaining value is seconds
                                        $s = $totaltime - ($m * 60);
                                        // Printing the result
                                        return ("$h:$m:$s");
                                    }

                                    foreach ($TimeAttendanceSummery as $s) {

                                        // Converting the time into seconds
                                        $timeinsec = strtotime($s['check_in_delay']);
                                        $AvgCheckiInDelay = calAvg($timeinsec / $s['WD']);
                                        ?>
                                        <tr>
                                            <td><?= $s['area_name'] ?></td>
                                            <td><?= $s['territory_name'] ?></td>
                                            <td><?= $s['range_name'] ?></td>
                                            <td><?= $s['user_name'] ?></td>
                                            <td style="text-align: right;"><?= $s['WD'] ?></td>
                                            <td style="text-align: right;"><?= substr($s['check_in_delay'], 0, 5)/* date('H:i', strtotime($s['check_in_delay'])) */ ?></td>
                                            <td><?= $AvgCheckiInDelay ?></td>
                                            <td style="text-align: right;"><?= substr($s['last_bill_delay'], 0, 5)/* date('H:i', strtotime($s['last_bill_delay'])) */ ?></td>
                                            <td style="text-align: right;"><?= number_format($s['total_bills']) ?></td>
                                            <td style="text-align: right;"><?= number_format($s['total_sale'], 0) ?></td>
                                        </tr>

                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <script>
                                const tables = document.querySelectorAll('table');
                                for (let table of tables) {
                                    let headerCell = null;
                                    let headerCell2 = null;
                                    let i = 1;
                                    for (let row of table.rows) {
                                        const firstCell = row.cells[0];
                                        let firstCell2 = row.cells[1];

                                        firstCell.style.backgroundColor = "#ffff64";
                                        firstCell.style.verticalAlign = "middle";
                                        firstCell.style.fontSize = "20px";
                                        firstCell.style.fontWeight = "bold";


                                        if (headerCell === null || firstCell.innerText !== headerCell.innerText) {
                                            firstCell2 = row.cells[1];
                                            headerCell = firstCell;
                                        } else {
                                            headerCell.rowSpan++;
                                            firstCell.remove();
                                            firstCell2 = row.cells[0];
                                        }



                                        /*
                                         if (i === 3) {
                                         firstCell2 = row.cells[1];
                                         } else {
                                         firstCell2 = row.cells[0];
                                         }*/
                                        /*firstCell2.style.backgroundColor = "#00ff95";
                                        firstCell2.style.verticalAlign = "middle";
                                        firstCell2.style.fontSize = "20px";
                                        firstCell2.style.fontWeight = "bold";
                                        //alert(firstCell2.innerText+i);
                                        if (headerCell2 === null || firstCell2.innerText !== headerCell2.innerText) {
                                            headerCell2 = firstCell2;
                                        } else {
                                            headerCell2.rowSpan++;
                                            firstCell2.remove();
                                        }*/
                                        i += 1;
                                    }
                                }
                            </script>
                            <?php
                        }
                        ?>

                </div>

            </div>


        </div>
    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->

