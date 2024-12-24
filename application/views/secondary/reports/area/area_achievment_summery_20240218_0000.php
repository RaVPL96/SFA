<?php include_once BASEPATH . ('../application/views/template/leftsidebar.php'); ?>
<!-- Content Wrapper. Contains page content -->
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

    .presentation th:nth-child(1) {
        left: 0;
        z-index: 3;
    }

    .presentation td {
        text-align: center;
        white-space: pre;
    }

    .presentation tbody tr td:nth-child(1) {
        position: sticky;
        left: 0;
        z-index: 1;
    }

</style>
<div class="content-wrapper tableFixHead">
    <!-- Content Header (Page header) -->
    <div class="col-md-12 box box-success">
        <div class="box-header with-border">
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="box-body no-padding">
            <div class="col-md-12">
                <section class="content-header">
                    <h1>
                        Secondary Sales Area Summery
                        <small>Maintain Secondary Sales Details </small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Master Data Control Module</li>
                    </ol>
                </section>

                <div id="successMessage" class="hideDiv">Updated Successfully! </div>
                <div id="errorMessage" class="hideDiv">Invalid Data! Please Try Again. </div>
                <div class="keepgap"></div>
                <form class="form-horizontal" id="" action="<?= base_url('salesreports/areaSummery') ?>" method="post">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="col-md-12">Area <span class="text-red">*</span></label>
                            <div class="col-md-12">
                                <select id="areaID" name="areaID" class="form-control">
                                    <option value="-1"> -- Select Area -- </option>
                                    <?php
                                    foreach ($AreaList as $a) {
                                        $select = '';
                                        if (!empty($AreaID) && isset($AreaID) && $a['id'] == $AreaID) {
                                            $select = 'selected';
                                        }
                                        if (!empty($ASE_Area) && isset($ASE_Area) && $sess['grade_id'] == 4) {//ASE LOGIN LIMIT TO ACCESSILE AREAS
                                            foreach ($ASE_Area as $b) {
                                                if ($b['area_id'] == $a['id']) {
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

                    <div class="col-md-4" style="display: none;">
                        <div class="form-group">
                            <label class="col-md-2">Territory <span class="text-red">*</span></label>
                            <div class="col-md-6">
                                <select id="sbTerritory" name="territoryID" class="form-control">
                                    <option value=""> -- Select Territory -- </option>
                                    <?php
                                    if (!empty($territory) && isset($territory)) {
                                        foreach ($territory as $t) {
                                            $select = '';
                                            if (!empty($TerritoryID) && isset($TerritoryID) && $TerritoryID == $t['id']) {
                                                $select = 'selected';
                                            }
                                            echo '<option ' . $select . ' value="' . $t['id'] . '"> ' . $t['territory_name'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" style="display: none;">
                        <div class="form-group">
                            <label class="col-md-2">Route <span class="text-red">*</span></label>
                            <div class="col-md-6">
                                <select id="routeID" name="routeID" class="form-control">
                                    <option value=""> -- Select Route -- </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="col-md-12">Range <span class="text-red">*</span></label>
                            <div class="col-md-12">
                                <select id="sbRange" name="rangeID" class="form-control">
                                    <option value="-1"> -- All -- </option>
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
                    <div class="col-md-3" style="">
                        <div class="form-group">
                            <label class="col-md-12">Billing Type <span class="text-red">*</span></label>
                            <div class="col-md-12">
                                <select id="sbRange" name="billMethod" class="form-control">
                                    <!-- <option value="-1"> -- Select One -- </option>
                                     <option value="B">Booking</option> -->
                                    <option selected="selected" value="A">Actual</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="col-md-12">Date Range <span class="text-red">*</span></label>
                            <div class="col-md-12">
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
                    <!--
                    <div class="form-group">
                        <label class="col-md-2">Select Sales Channel <span class="text-red">*</span></label>
                        <div class="col-md-6">
                            <select name="channel[]" id="example28" multiple="multiple" class="form-control" style="display: none;"><option value="multiselect-all"> Select all</option>
                    <?php
                    /* foreach ($ChannelDataSet as $ch) {
                      echo '<option value="' . $ch['id'] . '"> ' . $ch['channel_name'] . '</option>';
                      } */
                    ?>
                            </select>
                            <div class="btn-group open">
                            </div>
                        </div>
                    </div>
                    -->
                </form>

            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content" style="font-size: 17px !important;">
        <div class="row">
            <div class="col-md-12" style="">
                <style>
                    .headcol{
                        position: -webkit-sticky;
                        position: sticky;
                        background-color: white;
                    }

                </style>
                <?php
                $total_working_days = 0;
                $expected_working_days = 0;
                $actual_working_days = 0;

                $total_working_day_varience = 0;
                $total_actual_working_days = 0;

                if (!empty($SalesData) && isset($SalesData)) {
                    $totBills = 0;
                    $totPCs = 0;
                    $totBValue = 0;
                    $totCancelPC = 0;
                    $totAPCs = 0;
                    $totCValue = 0;
                    $totGValue = 0;
                    $totMValue = 0;
                    $totAValue = 0;
                    $totDValue = 0;
                    $totTargetValue = 0;

                    $strTerritorySummery = '';
                    $strTerritory = '';
                    $strTerritoryID = '';
                    $totTerrBills = 0;
                    $totTerrPCs = 0;
                    $totTerrAPCs = 0;
                    $totTerrBValue = 0;
                    $totTerrCancelPC = 0;
                    $totTerrCValue = 0;
                    $totTerrGValue = 0;
                    $totTerrMValue = 0;
                    $totTerrDValue = 0;
                    $totTerrAValue = 0;

                    $strDaySummery = '';
                    $territory_list_array = array();

                    $totalRows = count($SalesDataTerritory);
                    $c = 0;

                    $dt = str_replace('/', '-', trim(str_replace(' - ', '~', trim($DateRange))));

                    if (!empty($WorkingDates) && isset($WorkingDates)) {
                        foreach ($WorkingDates as $d) {
                            if ($d['is_working'] == 1) {
                                $expected_working_days = $expected_working_days + 1;
                            }
                        }
                    }

                    foreach ($SalesDataTerritory as $s) {
                        $targetV = 0;
                        $actualWD = 0; //ACTUAL WORKING DAYS TOTAL

                        if ($strTerritory == '') {
                            $strTerritory = $s['territory_name'];
                            $strTerritoryID = $s['id'];
                            $strTerritoryRefCode = $s['reference_code'];
                            $strRangeName = $s['range_name'];
                        }
                        if ($strTerritory == $s['territory_name']) {//add totals to same territory figures
                            $totTerrBills = $totTerrBills + $s['totBills'];
                            $totTerrPCs = $totTerrPCs + $s['totPC'];
                            $totTerrAPCs = $totTerrAPCs + $s['totActualPC'];
                            $totTerrBValue = $totTerrBValue + $s['totBval'] + $s['totDisval'];
                            $totTerrCancelPC = $totTerrCancelPC + $s['totCancelPC'];
                            $totTerrCValue = $totTerrCValue + $s['totCval'];
                            $totTerrGValue = $totTerrGValue + $s['totGval'];
                            $totTerrMValue = $totTerrMValue + $s['totMval'];
                            $totTerrDValue = $totTerrDValue + $s['totDisval'];
                            $totTerrAValue = $totTerrAValue + $s['totAval'] + $s['totDisval'];
                        }

                        if ($strTerritory != $s['territory_name'] || $c == $totalRows - 1) {

                            foreach ($targetData as $target) {
                                if ($strTerritoryRefCode == $target['ag_cd']) {
                                    $targetV = $target[strtolower($strRangeName) . '_target'];
                                    $total_working_days = $actualWD = $target['wd'];
                                    array_push($territory_list_array, $target['ag_cd']);
                                }
                            }

                            foreach ($ActualWorkingDates as $awd) {
                                if ($strTerritoryRefCode == $awd['ag_code'] && $strRangeName == $awd['range_name']) {
                                    $actual_working_days = $awd['actual_working_count'];
                                }
                            }
                            if ($actualWD == 0) {
                                $foo = ($totTerrAValue);
                            } else {
                                $foo = ($totTerrAValue - (($targetV / $actualWD) * $expected_working_days));
                            }
                            $fooawd = $actual_working_days - $expected_working_days;
                            $total_working_day_varience = $total_working_day_varience + $fooawd;
                            $total_actual_working_days = $total_actual_working_days + $actual_working_days;
                            if ($targetV == 0) {
                                $targetV = 1;
                            }
                            if ($actual_working_days == 0) {
                                $actual_working_days = 1;
                            }
                            $strTerritorySummery .= '<tr>'
                                    . '<td class="sticky-col first-col " colspan="2"><a target="_blank" href="' . base_url('salesreports/areaSummery/null/' . $AreaID . '/' . $RangeID . '/' . $strTerritoryID . '/' . $dt . '/' . $billMethod) . '">' . str_replace(' DLS', '', trim($strTerritory)) . '</td>'
                                    . '<td colspan="1" style="background: #e9ffe2;" align="right">' . number_format($targetV) . '</td>'
                                    . '<td colspan="1" style="background: #ffffc7;" align="right">' . number_format($totTerrAValue) . '</td>'
                                    . '<td colspan="1" align="right">' . (($foo < 0 ? "(" . number_format(abs($foo)) . ")" : number_format($foo))) . '</td>'//'<td colspan="1">' . $totTerrBills . '</td>'
                                    . '<td colspan="1" align="right">' . number_format(($totTerrAValue / $targetV) * 100) . '%</td>' //'<td colspan="1">' . $totTerrPCs . '</td>'
                                    . '<td colspan="1" align="right">' . (($fooawd < 0 ? "(" . number_format(abs($fooawd)) . ")" : number_format($fooawd))) . '</td>'
                                    . '<td colspan="1" align="right">' . number_format($totTerrAValue / $actual_working_days) /* $totTerrAPCs */ . '</td>'
                                    . '<td colspan="2" align="right">' . number_format($totTerrAPCs / $actual_working_days/* $totTerrBValue */, 1) . '</td>'
                                    //. '<td colspan="1" align="right">' . number_format($totTerrGValue) . '</td>' 
                                    . '<td colspan="1" align="right">' . number_format(($totTerrGValue / $totTerrAValue) * 100, 2, '.', '') . ' %</td>'
                                    . '<td colspan="1" align="right">' . number_format(($totTerrMValue / $totTerrAValue) * 100, 2, '.', '') . ' %</td>'
                                    . '<td colspan="1" align="right">' . number_format($totTerrMValue) . '</td>'
                                    . '<td colspan="1" align="right">' . number_format($totTerrCValue) . '</td>'
                                    //. '<td colspan="1" align="right">' . number_format(($totTerrMValue + $totTerrGValue)) . '</td>'
                                    . '<td colspan="1" align="right">' . number_format((($totTerrCValue) / $totTerrBValue) * 100, 2, '.', '') . ' %</td>'
                                    . '<td colspan="1" align="right">' . number_format($totTerrDValue) . '</td>'
                                    . '</tr>';

                            $totTerrBills = 0;
                            $totTerrPCs = 0;
                            $totTerrAPCs = 0;
                            $totTerrBValue = 0;
                            $totTerrCancelPC = 0;
                            $totTerrCValue = 0;
                            $totTerrGValue = 0;
                            $totTerrMValue = 0;
                            $totTerrDValue = 0;
                            $totTerrAValue = 0;
                            $totTerrBills = $totTerrBills + $s['totBills'];
                            $totTerrPCs = $totTerrPCs + $s['totPC'];
                            $totTerrAPCs = $totTerrAPCs + $s['totActualPC'];
                            $totTerrBValue = $totTerrBValue + $s['totBval'] + $s['totDisval'];
                            $totTerrCancelPC = $totTerrCancelPC + $s['totCancelPC'];
                            $totTerrCValue = $totTerrCValue + $s['totCval'];
                            $totTerrGValue = $totTerrGValue + $s['totGval'];
                            $totTerrMValue = $totTerrMValue + $s['totMval'];
                            $totTerrDValue = $totTerrDValue + $s['totDisval'];
                            $totTerrAValue = $totTerrAValue + $s['totAval'] + $s['totDisval'];

                            if ($strTerritory != $s['territory_name'] && $c == $totalRows - 1) {//last row new territory and need to display
                                $strTerritory = $s['territory_name'];
                                $strTerritoryRefCode = $s['reference_code'];
                                foreach ($targetData as $target) {
                                    if ($strTerritoryRefCode == $target['ag_cd']) {
                                        $targetV = $target[strtolower($strRangeName) . '_target'];
                                        $total_working_days = $actualWD = $target['wd'];
                                        array_push($territory_list_array, $target['ag_cd']);
                                    }
                                }
                                $foo = ($totTerrAValue - (($targetV / $actualWD) * $expected_working_days));
                                $fooawd = $actual_working_days - $expected_working_days;
                                $total_working_day_varience = $total_working_day_varience + $fooawd;
                                $total_actual_working_days = $total_actual_working_days + $actual_working_days;

                                array_push($territory_list_array, $s['reference_code']);

                                $strTerritorySummery .= '<tr>'
                                        . '<td  class="sticky-col first-col "  colspan="2"><a target="_blank" href="' . base_url('salesreports/areaSummery/null/' . $AreaID . '/' . $RangeID . '/' . $s['id'] . '/' . $dt . '/' . $billMethod) . '">' . str_replace(' DLS', '', trim($strTerritory)) . '</td>'
                                        . '<td colspan="1"  style="background: #e9ffe2;" align="right">' . number_format($targetV) . '</td>'
                                        . '<td colspan="1"  style="background: #ffffc7;" align="right">' . number_format($totTerrAValue) . '</td>'
                                        . '<td colspan="1" align="right">' . (($foo < 0 ? "(" . number_format(abs($foo)) . ")" : number_format($foo))) . '</td>'//'<td colspan="1">' . $totTerrBills . '</td>'
                                        . '<td colspan="1" align="right">' . number_format(($totTerrAValue / $targetV) * 100) . '%</td>' //'<td colspan="1">' . $totTerrPCs . '</td>'
                                        . '<td colspan="1" align="right">' . ((($fooawd < 0 ? "(" . number_format(abs($fooawd)) . ")" : number_format($fooawd)))) . '</td>'
                                        . '<td colspan="1" align="right">' . number_format($totTerrAValue / $actual_working_days)/* $totTerrAPCs */ . '</td>'
                                        . '<td colspan="2" align="right">' . number_format($totTerrAPCs / $actual_working_days/* $totTerrBValue */, 1) . '</td>'
                                        //. '<td colspan="1" align="right">' . number_format($totTerrGValue) . '</td>'
                                        . '<td colspan="1" align="right">' . number_format(($totTerrGValue / $totTerrAValue) * 100, 2, '.', '') . ' %</td>'
                                        . '<td colspan="1" align="right">' . number_format(($totTerrMValue / $totTerrAValue) * 100, 2, '.', '') . ' %</td>'
                                        . '<td colspan="1" align="right">' . number_format($totTerrMValue) . '</td>'
                                        . '<td colspan="1" align="right">' . number_format($totTerrCValue) . '</td>'
                                        //. '<td colspan="1" align="right">' . number_format(($totTerrMValue + $totTerrGValue)) . '</td>'
                                        . '<td colspan="1" align="right">' . number_format((($totTerrCValue) / $totTerrBValue) * 100, 2, '.', '') . ' %</td>'
                                        . '<td colspan="1" align="right">' . number_format($totTerrDValue) . '</td>'
                                        . '</tr>';
                            }
                            $strTerritory = $s['territory_name'];
                            $strTerritoryID = $s['id'];
                            $strTerritoryRefCode = $s['reference_code'];
                            $strRangeName = $s['range_name'];
                        }


                        $totBills = $totBills + $s['totBills'];
                        $totPCs = $totPCs + $s['totPC'];
                        $totAPCs = $totAPCs + $s['totActualPC'];
                        $totBValue = $totBValue + $s['totBval'] + $s['totDisval'];
                        $totCancelPC = $totCancelPC + $s['totCancelPC'];
                        $totCValue = $totCValue + $s['totCval'];
                        $totGValue = $totGValue + $s['totGval'];
                        $totMValue = $totMValue + $s['totMval'];
                        $totDValue = $totDValue + $s['totDisval'];
                        $totAValue = $totAValue + $s['totAval'] + $s['totDisval'];
                        $totTargetValue = $totTargetValue + $targetV;

                        $c = $c + 1;
                        $dateBill = '';
                        if ($channelID == 1) {
                            if ($billMethod == 'B') {
                                $dateBill = $s['date_book'];
                            } elseif ($billMethod == 'A') {
                                $dateBill = $s['date_actual'];
                            }
                        } else {
                            $dateBill = $s['date_actual'];
                        }



                        $totalActual = $s['totAval'] + $s['totDisval'];
                        if ($totalActual == 0) {
                            $totalActual = 0.01;
                        }

                        $strDaySummery .= '<tr>'
                                . '<td  colspan="1"><a href="' . base_url('salesreports/areaSummery/null/' . $AreaID . '/' . $RangeID . '/' . $s['id'] . '/' . $dt . '/' . $billMethod . '/' . $dateBill) . '">' . $dateBill . '</a></td>'
                                . '<td  colspan="1">' . $s['territory_name'] . '</td>'
                                . '<td colspan="1" align="right">' . $s['totBills'] . '</td>'
                                . '<td colspan="1" align="right">' . $s['totPC'] . '</td>'
                                . '<td colspan="1" align="right">' . $s['totActualPC'] . '</td>'
                                . '<td colspan="2" align="right">' . number_format($s['totBval'] + $s['totDisval']) . '</td>'
                                . '<td colspan="1" align="right">' . number_format($s['totCval']) . '</td>'
                                . '<td colspan="1" align="right">' . number_format($s['totGval']) . '</td>'
                                . '<td colspan="1" align="right">' . number_format(($s['totGval'] / ($totalActual)) * 100, 2, '.', '') . ' %</td>'
                                . '<td colspan="1" align="right">' . number_format($s['totMval']) . '</td>'
                                . '<td colspan="1" align="right">' . number_format(($s['totMval'] / ($totalActual)) * 100, 2, '.', '') . ' %</td>'
                                . '<td colspan="1" align="right">' . number_format($s['totGval'] + $s['totMval']) . '</td>'
                                . '<td colspan="1" align="right">' . number_format((($s['totGval'] + $s['totMval']) / ($totalActual) * 100), 2, '.', '') . ' %</td>'
                                . '<td colspan="1" align="right">' . number_format($s['totDisval']) . '</td>'
                                . '<td colspan="2" align="right">' . number_format(($s['totAval'] + $s['totDisval'])) . '</td>'
                                . '</tr>';
                    }
                    $totTargetValue = 0;
                    //print_r($territory_list_array);

                    foreach ($targetData as $target) {
                        $targetV = $target[strtolower($strRangeName) . '_target'];
                        $totTargetValue = $totTargetValue + $targetV;
                        $total_working_days = $actualWD = $target['wd'];
                        if ($targetV != 0 && !in_array($target['ag_cd'], $territory_list_array)) {//IF NOT IN ARRAY CREATE A EMPTY SUMMERY LINE WITH 0 TARGET SUMMERY
                            $foo = 0 - (($targetV / $actualWD) * $expected_working_days);
                            $fooawd = $actual_working_days - $expected_working_days;
                            $total_working_day_varience = $total_working_day_varience + $fooawd;
                            $total_actual_working_days = $total_actual_working_days + $actual_working_days;
                            if (!(!empty($SalesDataTerritory) && isset($SalesDataTerritory) && !empty($territoryID) && isset($territoryID) && $territoryID != 'null')) {
                                $strTerritorySummery .= '<tr>'
                                        . '<td  class="sticky-col first-col "  colspan="2"><a target="_blank" href="#">' . str_replace(' DLS', '', trim($target['ag_name'])) . '</td>'
                                        . '<td colspan="1" style="background: #e9ffe2;" align="right">' . number_format($targetV) . '</td>'
                                        . '<td colspan="1" style="background: #ffffc7;" align="right">' . number_format(0) . '</td>'
                                        . '<td colspan="1" align="right">' . (($foo < 0 ? "(" . number_format(abs($foo)) . ")" : number_format($foo))) . '</td>'
                                        . '<td colspan="1" align="right">' . 0 . '%</td>'
                                        . '<td colspan="1" align="right">' . (($fooawd < 0 ? "(" . number_format(abs($fooawd)) . ")" : number_format($fooawd))) . '</td>'
                                        . '<td colspan="1" align="right">' . 0 . '</td>'
                                        . '<td colspan="2" align="right">' . number_format(0) . '</td>'
                                        . '<td colspan="1" align="right">' . number_format(0) . '</td>'
                                        //. '<td colspan="1" align="right">' . number_format(0) . '</td>'
                                        . '<td colspan="1" align="right">' . number_format((0) * 100, 2, '.', '') . ' %</td>'
                                        . '<td colspan="1" align="right">' . number_format(0) . '</td>'
                                        . '<td colspan="1" align="right">' . number_format((0) * 100, 2, '.', '') . ' %</td>'
                                        //. '<td colspan="1" align="right">' . number_format((0)) . '</td>'
                                        . '<td colspan="1" align="right">' . number_format(0 * 100, 2, '.', '') . ' %</td>'
                                        . '<td colspan="1" align="right">' . number_format(0) . '</td>'
                                        . '</tr>';
                            }
                        }
                    }

                    if ($billMethod == 'B') {
                        $totCancelPC = '-';
                        $totCValue = '-';
                        $totAValue = '-';
                    }
                    ?>
                    <div class="clearfix">&nbsp;</div> 
                    <div class="form-group">
                        <input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('attendance_table', 'Daily_Achievments')" value="Download Excel">
                    </div>
                    <div class="row">
                        <table id="attendance_table" class="table table-hover">
                            <thead>
                            <!-- <th colspan="17" style="font-size: 20px; text-align: center;"> <?= $AreaDetails->area_name ?> Area Actual Sales Data - <?= $RangeName->range_name ?> Range<br>Date From <?= $DateRange ?></th> -->
                                <tr>
                                    <th colspan="17" style="font-size: 20px; text-align: center;"><?= $ReportTitle ?></th>
                                </tr>
                            </thead>
                            <thead>
                                <tr>
                                    <th colspan="2" align="center"></th>
                                    <th colspan="1" align="center">Target</th>
                                    <th colspan="1" align="center">Total Actual Value (with Direct)</th>
                                    <th colspan="1" align="center">Variance - Cum Target vs </th><!-- <th colspan="1">Total Bill(s)</th> -->
                                    <th colspan="1" align="center">Target vs  Cum Sale With Dir. (%)</th><!-- <th colspan="1">Total PC</th> -->
                                    <th colspan="1" align="center">Total WD Varience</th>
                                    <!-- <th colspan="1" align="center">Total Actual PC</th>-->
                                    <th colspan="1" align="center">Avg (With Direct)</th>
                                    <th colspan="1" align="center" style="background: #000000 !important;">Avg PC per day</th>
                                    <!-- <th colspan="2" align="center">Total Booking Value (with Discount)</th> -->
                                    <th colspan="1" align="center">Total Cancel PC</th>
                                    <th colspan="1" align="center">Total Cancel Value</th>
                                    <th colspan="1" align="center">Cancel %</th>
                                    <!-- <th colspan="1" align="center">Good Return Value</th> -->
                                    <th colspan="1" align="center">Good Return %</th>
                                    <!-- <th colspan="1" align="center">Market Return Value</th> -->
                                    <th colspan="1" align="center">Market Return %</th>
                                    <!-- <th colspan="1" align="center">Return Value</th> -->
                                    <!-- <th colspan="1" align="center">Return %</th> -->
                                    <th colspan="1" align="center">Discount Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="2" align="right" style="background: #e9ffe2;"><?= $AreaDetails->area_name ?> Total</td>
                                    <td colspan="1" align="right" style="background: #e9ffe2;"><?= number_format($totTargetValue) ?></td>
                                    <td colspan="1" align="right" style="background: #ffffc7;"><?= number_format($totAValue) ?></td>
                                    <td colspan="1" align="right"><?php
                                        if ($total_working_days == 0) {
                                            $total_working_days = 0.00001;
                                        }
                                        if ($totTargetValue == 0) {
                                            $totTargetValue = 0.000001;
                                        }
                                        $foo = ($totAValue - (($totTargetValue / $total_working_days) * $expected_working_days));
                                        echo (($foo < 0 ? "(" . number_format(abs($foo)) . ")" : number_format($foo)))/* $totBills */
                                        ?></td>
                                    <td colspan="1" align="right"><?= number_format(($totAValue / $totTargetValue) * 100) . '%'/*                                     * $totPCs */ ?></td>
                                    <th colspan="1" align="center"><?= (($total_working_day_varience < 0 ? "(" . number_format(abs($total_working_day_varience)) . ")" : number_format($total_working_day_varience))) ?></th>
                                    <!-- <td colspan="1" align="right"><?= $totAPCs ?></td> -->
                                    <td colspan="1" align="right"><?= number_format($totAValue / $total_actual_working_days) ?></td>
                                    <td colspan="1" align="right"><?= number_format($totAPCs / $total_actual_working_days) ?></td>
                                    <!-- <td colspan="2" align="right"><?= number_format($totBValue) ?></td> -->
                                    <td colspan="1" align="right"><?= $totCancelPC ?></td>
                                    <td colspan="1" align="right"><?= number_format($totCValue) ?></td>
                                    <td colspan="1" align="right"><?= number_format(($totCValue / $totBValue) * 100, 2, '.', '') ?> %</td>
                                    <!-- <td colspan="1" align="right"><?= number_format($totGValue) ?></td> -->
                                    <td colspan="1" align="right"><?= number_format(($totGValue / $totAValue) * 100, 2, '.', '') ?> %</td>
                                    <!-- <td colspan="1" align="right"><?= number_format($totMValue) ?></td> -->
                                    <td colspan="1" align="right"><?= number_format(($totMValue / $totAValue) * 100, 2, '.', '') ?> %</td>
                                    <!-- <td colspan="1" align="right"><?= number_format(($totMValue + $totGValue)) ?></td> -->
                                    <!-- <td colspan="1" align="right"><?= number_format((($totMValue + $totGValue) / $totAValue) * 100, 2, '.', '') ?> %</td> -->
                                    <td colspan="1" align="right"><?= number_format($totDValue) ?></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="17">&nbsp;</td>
                                </tr>
                            </tfoot> 
                        </table>
                        <div class="view">
                            <div class="wrappers">
                                <table class="table table-hover presentation">
                                    <thead>
                                        <tr>
                                            <th colspan="2" align="center" class="sticky-col first-col ">Territory</th>
                                            <th colspan="1" align="center">Target</th>
                                            <th colspan="1" align="center">Total Actual (with Direct)</th>
                                            <th colspan="1" align="center">Variance - Cum Target vs </th><!-- <th colspan="1">Total Bills</th> -->
                                            <th colspan="1" align="center">Target vs Cum-Sale(with Dir)(%)</th><!-- <th colspan="1">Total PC</th> -->
                                            <th colspan="1" align="center">WD Variance </th>
                                            <th colspan="1" align="center">Avg (With Direct)</th><!-- <th colspan="1" align="center">Total Actual PC</th> -->
                                            <th colspan="2" align="center" style="background: #000000 !important;">Avg PC per day</th><!-- <th colspan="2" align="center">Booking Value (with Discount)</th> -->
                                            <!-- <th colspan="1">Good Return</th> -->
                                            <th colspan="1" align="center">Good Return %</th>
                                            <th colspan="1" align="center">Market Return %</th>
                                            <th colspan="1" align="center">Market Return</th>
                                            <th colspan="1" align="center">Cancel Value</th>
                                            <!-- <th colspan="1" align="center">Return Value</th> -->
                                            <th colspan="1" align="center">Cancel %</th>
                                            <th colspan="1" align="center">Total Discount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?= $strTerritorySummery ?>
                                    </tbody>  
                                </table>
                            </div>
                        </div>
                        <table class="table">
                            <?php
                            if (!empty($SalesDataTerritory) && isset($SalesDataTerritory) && !empty($territoryID) && isset($territoryID) && $territoryID != 'null') {
                                ?>


                                <thead>
                                    <tr>
                                        <th colspan="1">
                                            <?php
                                            if ($billMethod == 'B') {
                                                echo 'Booking';
                                            } elseif ($billMethod == 'A') {
                                                echo 'Actual';
                                            }
                                            ?> Date</th>
                                        <th colspan="1" align="center">Territory</th>
                                        <th colspan="1" align="center">Total Bills</th>
                                        <th colspan="1" align="center">Total PC</th>
                                        <th colspan="1" align="center">Total Actual PC</th>
                                        <th colspan="2" align="center">Booking Value (with Discount)</th>
                                        <th colspan="1" align="center">Cancel Value</th>
                                        <th colspan="1" align="center">Good Return</th>
                                        <th colspan="1" align="center">Good Return %</th>
                                        <th colspan="1" align="center">Market Return</th>
                                        <th colspan="1" align="center">Market Return %</th>
                                        <th colspan="1" align="center">Total Return</th>
                                        <th colspan="1" align="center">Total Return %</th>
                                        <th colspan="1" align="center">Total Discount</th>
                                        <th colspan="2" align="center">Total Actual (with Discount)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?= $strDaySummery ?>
                                </tbody>


                                <tfoot>
                                    <tr>
                                        <td colspan="18"></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <table class="table">
                                <?php
                                if (!empty($SalesDataDetails) && isset($SalesDataDetails)) {
                                    ?>
                                    <thead>
                                        <tr>
                                            <td align="center">Invoice </td>
                                            <td colspan="5" align="left">Shop Name </td>
                                            <td align="center">Route</td>
                                            <td align="center">Booking </td>
                                            <td align="center">Cancel Value</td>
                                            <td align="center">Market Return</td>
                                            <td align="center">Good Return</td>
                                            <td align="center">Free issue Value</td>
                                            <td align="center">Discount</td>
                                            <td align="center">Bill Value</td>
                                            <td align="center">Booking Date</td>
                                            <td align="center">Actual Date</td>
                                            <td align="center"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $olddte = '';
                                        foreach ($SalesDataDetails as $r) {
                                            if ($billMethod == 'B') {
                                                if ($olddte != $r['date_book']) {
                                                    ?>
                                                    <tr style="background-color: cornflowerblue; color: white; height:25px; vertical-align: middle;">
                                                        <td colspan="18" align="left"><?= $r['date_book'] ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            } elseif ($billMethod == 'A') {
                                                if ($olddte != $r['date_actual']) {
                                                    ?>
                                                    <tr style="background-color: cornflowerblue; color: white; height:25px; vertical-align: middle;">
                                                        <td colspan="18" align="left"><?= $r['date_actual'] ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <tr <?php
                                            if ($r['tot_a_val'] == 0) {
                                                echo 'style="background:#ff9898;"';
                                            }
                                            ?> >
                                                <td align="center"><?= $r['invno'] ?></td>
                                                <td colspan="5" align="left"><?= $r['sh_name'] ?></td>
                                                <td align="center"><?= $r['ro'] ?></td>
                                                <td align="right"><?= $r['tot_b_val'] ?></td>
                                                <td align="right"><?= $r['tot_c_val'] ?></td>
                                                <td align="right"><?= $r['tot_m_val'] ?></td>
                                                <td align="right"><?= $r['tot_g_val'] ?></td>
                                                <td align="right"><?= $r['tot_f_val'] ?></td>
                                                <td align="right"><?= $r['tot_dis'] ?></td>
                                                <td align="right"><?= $r['tot_a_val'] ?></td>
                                                <td align="center"><?= $r['date_book'] ?></td>
                                                <td align="center"><?= $r['date_actual'] ?></td>
                                                <td align="center"><a href="#" onclick="view_invoice_old('<?= $r['invno'] ?>'); return false;" style="cursor: pointer;">View</a></td>
                                            </tr>
                                            <?php
                                            if ($billMethod == 'B') {
                                                $olddte = $r["date_book"];
                                            } elseif ($billMethod == 'A') {
                                                $olddte = $r["date_actual"];
                                            }
                                        }
                                        ?>
                                    </tbody>

                                    <?php
                                }//if end SalesDataDetails
                                ?>
                                <?php
                            }//if end SalesDataDetails
                            ?>
                        </table>
                    </div>
                    <?php
                }
                ?>



            </div>


        </div>
    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->




<!-- jQuery 2.1.4 -->
<script src="<?= base_url('adminlte/plugins/jQuery/jQuery-2.1.4.min.js') ?>"></script>
<script src="<?= base_url('adminlte/dist/js/validate/jquery.validate.min.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('adminlte/dist/js/validate/placeholders.min.js') ?>" type="text/javascript"></script>

<script type="text/javascript">
                                                    $("#frmLocation").validate({
                                                        rules: {
                                                            "location[name]": {
                                                                required: true
                                                            },
                                                            "location[address]": {
                                                                required: true
                                                            },
                                                            "location[phone]": {
                                                                required: true
                                                            },
                                                            "location[email]": {
                                                                required: true
                                                            }
                                                        },
                                                        messages: {
                                                            "email": 'Please fill this field',
                                                            "pass": 'Please fill this field'
                                                        },
                                                        highlight: function (element) {
                                                            $(element).closest('.form-group').addClass('has-error');
                                                        },
                                                        unhighlight: function (element) {
                                                            $(element).closest('.form-group').removeClass('has-error');
                                                        },
                                                        errorElement: 'span',
                                                        errorClass: 'help-block',
                                                        errorPlacement: function (error, element) {
                                                            if (element.parent('.input-group').length) {
                                                                error.insertAfter(element.parent());
                                                            } else {
                                                                error.insertAfter(element);
                                                            }
                                                        },
                                                        /*submitHandler: function(form) {
                                                         return true;
                                                         }*/
                                                    });
</script>


<script type="text/javascript">
    $('#Operation').change(function () {
        $('#areawrap').empty();
        $('#territoryList').empty();
        var modID = $('#Operation').val();
        //alert(modID);
        $.ajax({
            type: "post",
            url: "<?php echo base_url('index.php/master/getOperationAreasAjax'); ?>",
            data: 'opid=' + modID,
            success: function (feed) {
                $('#uploading').modal('hide');
                //alert(feed);
                $('#areawrap').empty().append(feed);

            },
            error: function (feed) {
                console.log('Ajax request not recieved!' + feed);
                $('#uploading').modal('hide');
            }
        });
        return false;
    });
    $(document).on('change', '#areaid', function () {
        var modID = $('#areaid').val();
        $('#territoryList').empty();
        //alert(modID);
        $.ajax({
            type: "post",
            url: "<?php echo base_url('index.php/master/getOperationAreasTerritoryAjax'); ?>",
            data: 'opid=' + modID,
            success: function (feed) {
                $('#uploading').modal('hide');
                //alert(feed);
                $('#territoryList').empty().append(feed);

            },
            error: function (feed) {
                console.log('Ajax request not recieved!' + feed);
                $('#uploading').modal('hide');
            }
        });
        return false;
    });

    $(document).on('change', '#territoryid', function () {
        var modID = $('#territoryid').val();
        $('#routeList').empty();
        //alert(modID);
        $.ajax({
            type: "post",
            url: "<?php echo base_url('index.php/master/getOperationAreasTerritoryRouteAjax'); ?>",
            data: 'opid=' + modID,
            success: function (feed) {
                $('#uploading').modal('hide');
                //alert(feed);
                $('#routeList').empty().append(feed);

            },
            error: function (feed) {
                console.log('Ajax request not recieved!' + feed);
                $('#uploading').modal('hide');
            }
        });
        return false;
    });

</script>


<script type="text/javascript">
    function deleteData(uid, reqType, upval) {
        if (reqType == 'update') {
            $.ajax({
                type: "post",
                url: "<?php echo base_url('index.php/items/updateLocData'); ?>",
                data: 'id=' + uid + '&reqType=' + reqType + '&upVal=' + upval,
                success: function (feed) {
                    if (feed.trim() == '1') {
                        //swal("Updated!", "Your data is now updated.", "success");
                        window.location.reload();
                    } else {
                        swal("Error!", "Unable to process your request", "error");
                    }
                },
                error: function (feed) {
                    swal("Error!", "Unable to process your request", "error");
                }
            });
        } else {
            swal({
                title: "Are you sure?",
                text: "Are you sure want to update this record?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Update it!",
                closeOnConfirm: false
            },
                    function () {
                        $.ajax({
                            type: "post",
                            url: "<?php echo base_url('index.php/items/updateLocData'); ?>",
                            data: 'id=' + uid + '&reqType=' + reqType + '&upVal=' + upval,
                            success: function (feed) {
                                if (feed.trim() == '1') {
                                    swal("Updated!", "Your data is now updated.", "success");
                                    window.location.reload();
                                } else {
                                    swal("Error!", "Unable to process your request", "error");
                                }
                            },
                            error: function (feed) {
                                swal("Error!", "Unable to process your request", "error");
                            }
                        });
                    });
        }
    }
</script>