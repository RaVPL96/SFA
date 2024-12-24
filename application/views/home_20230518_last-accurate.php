<?php include_once BASEPATH . ('../application/views/template/leftsidebar.php'); ?>
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
        white-space: pre;
    }

    .presentation tbody tr td:nth-child(1) {
        position: sticky;
        left: 0;
        z-index: 1;
    }
    .headcol{
        position: -webkit-sticky;
        position: sticky;
        background-color: white;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboards  
            <small>Control Panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content" style="overflow:hidden;">
        <div class="row">
            <div class="col-lg-3 col-xs-12">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>Total Sales</h3>
                        <p>Click to view sales Dashboard</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="<?= base_url('welcome/index') ?>" class="small-box-footer">Click here <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">  
                <form class="form-horizontal" id="myForm" action="<?= base_url('welcome/home') ?>" method="post">
                    <div class="col-md-5">                            
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
                    <div class="col-md-4">                            
                        <div class="form-group">
                            <label class="col-md-4">Range <span class="text-red">*</span></label>
                            <div class="col-md-6">
                                <select id="sbRange" name="rangeID" class="form-control">
                                    <option value="-1"> -- Select Range -- </option>    
                                    <?php
                                    foreach ($RangeList as $a) {
                                        $select = '';
                                        if (!empty($RangeID) && isset($RangeID) && $a['range_name'] == $RangeID) {
                                            $select = 'selected';
                                        }

                                        if ($sess['grade_id'] == 4) {
                                            foreach ($ASE_Area as $ase) {
                                                if ($ase['range_id'] == $a['id']) {
                                                    echo '<option ' . $select . ' value="' . $a['range_name'] . '"> ' . $a['range_name'] . '</option>';
                                                }
                                            }
                                        } else {
                                            echo '<option ' . $select . ' value="' . $a['range_name'] . '"> ' . $a['range_name'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">                            
                        <div class="form-group">
                            <label class="col-md-4">Month Period:</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" name="datepickermonth" id="datepickermonth" value="<?= $datepickermonth ?>">
                            </div>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <?php
                        if (!empty($CategoryList) && isset($CategoryList)) {
                            foreach ($CategoryList as $cat) {
                                echo '<div class="col-md-3">
                                    <div class="small-box" style="text-align:center;background:' . $cat['bg_color'] . ';color:' . $cat['font_color'] . ';">
                                        <div class="inner">
                                        <h4>' . $cat['name'] . '</h4> 
                                        </div>

                                        <a href="" onClick="setCategory(' . $cat['id'] . ');return false;" class="small-box-footer">
                                        More details <i class="fa fa-arrow-circle-right"></i>
                                        </a>
                                    </div>
                                </div>';
                            }
                        }
                        ?>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="category" name="category" value="<?= $categoryID ?>">
                            <input type="submit" class="btn btn-danger" name="btnsubmit" value="Get Report">
                        </div>                                
                    </div>
                </form>
            </div>

        </div>
        <div class="col-md-12" style="overflow-x: scroll; overflow-y: scroll; max-height: 700px;">
            <div class="row">
                <div class="col-lg-12 col-xs-12">
                    <?php
                    if (!empty($DailySales) && isset($DailySales)) {
                        $totWorkingDays = 0;
                        if (!empty($targetData) && isset($targetData)) {
                            foreach ($targetData as $t) {
                                $totWorkingDays = $t['wd'];
                            }
                        }
                        $totExpectedWorkingDays = 0; // total need to complated as at date
                        if (!empty($WorkingDates) && isset($WorkingDates)) {
                            foreach ($WorkingDates as $d) {
                                if ($d['is_working'] == 1) {
                                    $totExpectedWorkingDays += 1;
                                }
                            }
                        }

                        if (date('Y-m', strtotime($datepickermonth)) === date('Y-m')) {//if this is calender current month ignore today
                            $totExpectedWorkingDays = $totExpectedWorkingDays - 1;
                        }
                        $tot01 = 0;
                        $tot02 = 0;
                        $tot03 = 0;
                        $tot04 = 0;
                        $tot05 = 0;
                        $tot06 = 0;
                        $tot07 = 0;
                        $tot08 = 0;
                        $tot09 = 0;
                        $tot10 = 0;
                        $tot11 = 0;
                        $tot12 = 0;
                        $tot13 = 0;
                        $tot14 = 0;
                        $tot15 = 0;
                        $tot16 = 0;
                        $tot17 = 0;
                        $tot18 = 0;
                        $tot19 = 0;
                        $tot20 = 0;
                        $tot21 = 0;
                        $tot22 = 0;
                        $tot23 = 0;
                        $tot24 = 0;
                        $tot25 = 0;
                        $tot26 = 0;
                        $tot27 = 0;
                        $tot28 = 0;
                        $tot29 = 0;
                        $tot30 = 0;
                        $tot31 = 0;

                        $tot01_pc = 0;
                        $tot02_pc = 0;
                        $tot03_pc = 0;
                        $tot04_pc = 0;
                        $tot05_pc = 0;
                        $tot06_pc = 0;
                        $tot07_pc = 0;
                        $tot08_pc = 0;
                        $tot09_pc = 0;
                        $tot10_pc = 0;
                        $tot11_pc = 0;
                        $tot12_pc = 0;
                        $tot13_pc = 0;
                        $tot14_pc = 0;
                        $tot15_pc = 0;
                        $tot16_pc = 0;
                        $tot17_pc = 0;
                        $tot18_pc = 0;
                        $tot19_pc = 0;
                        $tot20_pc = 0;
                        $tot21_pc = 0;
                        $tot22_pc = 0;
                        $tot23_pc = 0;
                        $tot24_pc = 0;
                        $tot25_pc = 0;
                        $tot26_pc = 0;
                        $tot27_pc = 0;
                        $tot28_pc = 0;
                        $tot29_pc = 0;
                        $tot30_pc = 0;
                        $tot31_pc = 0;

                        $rowTotPc = 0;

                        $totF = 0;
                        $totPcF = 0;

                        $monthNumber = date('m', strtotime($datepickermonth));
                        $monthName = date('F', strtotime($datepickermonth));
                        $year = date('Y', strtotime($datepickermonth));
                        $strDayCol = '';
                        $strDayColWithPC = '';
                        $strDayColValPC = '';
                        for ($n = 1; $n <= date('t', strtotime($datepickermonth)); $n++) {
                            $strDayCol .= '<th>' . $monthName . '-' . sprintf("%02d", $n) . '</th>';
                            $strDayColWithPC .= '<th class="fix" colspan="2">' . $monthName . '-' . sprintf("%02d", $n) . '</th>';
                            $strDayColValPC .= '<th>Value</th><th style="background: #efebb9;">PC</th>';
                        }
                        //echo $strDayCol;
                        $strBack = '';
                        for ($k = 1; $k <= 6; $k++) {
                            $monthNumberBack = date('m', strtotime($datepickermonth . ' -' . $k . ' month'));
                            $monthNameBack = date('F', strtotime($datepickermonth . ' -' . $k . ' month'));
                            $strBack .= '<th style="background: #000000 !important; color: #fff; text-align: center;">' . $monthNameBack . '-Total</th><th>' . $monthNameBack . '- Avg PC</th>';
                            ${'totF' . $k} = 0;
                        }
                        ?>
                        <h2>Total Actual Achievement Value with PC <?php if (!empty($categoryLineData) && isset($categoryLineData)) {
                        echo ' - ' . $categoryLineData->name;
                    } ?></h2>
                        <h3>Total Working Days: <?= $totWorkingDays ?> / Expected Working Days As at: <?= $totExpectedWorkingDays ?></h3>
                        <small>Today is ignored from expected working day count.</small>
                        <input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('attendance_table', 'Daily Sales <?= $monthName ?>')" value="Download Excel"><br>
                        <table id="attendance_table" class="table table-hover presentation">
                            <thead>
                                <tr>
                                    <th class="fix"></th> 
                                    <th class="fix"></th> 
                                    <th class="fix"></th> 
                                    <th class="fix"></th> 
    <?= $strDayColWithPC ?> 
                                    <th class="fix" colspan="8" style="text-align: center;"><?= $monthName ?>-Total</th>
                                    <th class="fix" colspan="12" style="background: #000000 !important; color: #fff; text-align: center;">Past Figures</th>
                                </tr>
                                <tr>
                                    <th>Area</th>
                                    <th>Territory</th>
                                    <th>Territory Code</th>
                                    <th>Range</th>
    <?= $strDayColValPC ?> 
                                    <th>Target</th>
                                    <th><?= $monthName ?>-Total</th> 
                                    <th>Variance - Cum Target vs</th> 
                                    <th><!-- Target vs  Cum With Dir. -->Sale (%)</th> 
                                    <th>WD Variance</th> 
                                    <th>Avg (With Direct)</th> 
                                    <th>Avg PC<!-- per day--></th> 
                                    <th style="background: #efebb9;"><?= $monthName ?>-Total-PC</th>
    <?= $strBack ?> 
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $totCurrentWorkingDays = 0;
                                $totWorkingDayVarience = 0;
                                $totTarget = 0;
                                $totVarienceValue = 0;
                                foreach ($DailySales as $v) {
                                    $rowTotPc = 0;

                                    $strRow = '';
                                    $strRowWithPc = '';
                                    $strRowFoot = '';
                                    $strRowFootWithPC = '';
                                    $max = 0;
                                    for ($n = 1; $n <= date('t', strtotime($datepickermonth)); $n++) {
                                        $territoryWithSaleCount = 0;
                                        $max = $n;
                                        ${'tot' . sprintf("%02d", $n)} = ${'tot' . sprintf("%02d", $n)} + $v[$monthName . '-' . $n];
                                        ${'tot' . sprintf("%02d", $n) . '_pc'} = ${'tot' . sprintf("%02d", $n) . '_pc'} + $v[$monthName . '-' . $n . '-pc'];
                                        $strRow .= '<td class="text-right">' . number_format($v[$monthName . '-' . $n]) . '</td>';
                                        if ($v[$monthName . '-' . $n] != 0) {
                                            $strRowWithPc .= '<td class="text-right">' . number_format($v[$monthName . '-' . $n]) . '</td>'
                                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($v[$monthName . '-' . $n . '-pc']) . '</td>';
                                        } else {
                                            $strRowWithPc .= '<td class="text-right">-</td>'
                                                    . '<td class="text-right" style="background: #efebb9;">-</td>';
                                        }
                                        $strRowFoot .= '<td class="text-right">' . number_format(${'tot' . sprintf("%02d", $n)}) . '</td>';

                                        $strRowFootWithPC .= '<td class="text-right">' . number_format(${'tot' . sprintf("%02d", $n)}) . '</td>'
                                                . '<td class="text-right" style="background: #efebb9;">' . number_format(${'tot' . sprintf("%02d", $n) . '_pc'}) . '</td>';
                                    }
                                    $targetVal = 0;
                                    $totWorkingDays = 0;
                                    $expectedTargetUptoDate = 0;
                                    $persentage = 0;
                                    $workingDayVarience = 0;
                                    $avgSale = 0;
                                    $avgPCperDay = 0;
                                    $varienceValue = 0;
                                    if (!empty($targetData) && isset($targetData)) {
                                        foreach ($targetData as $t) {
                                            if ($t['ag_cd'] == $v['ag_cd']) {
                                                $targetVal = $t[strtolower($RangeName) . '_target'];
                                                $totWorkingDays = $t['wd'];
                                            }
                                        }
                                    }
                                    $totExpectedWorkingDays = 0; // total need to complated as at date


                                    if (!empty($WorkingDates) && isset($WorkingDates)) {
                                        foreach ($WorkingDates as $d) {
                                            if ($d['is_working'] == 1) {
                                                $totExpectedWorkingDays += 1;
                                            }
                                        }
                                    }
                                    if (date('Y-m', strtotime($datepickermonth)) === date('Y-m')) {//if this is calender current month ignore today
                                        $totExpectedWorkingDays = $totExpectedWorkingDays - 1;
                                    }
                                    $actual_working_count = 0; // rep actually working days count as at date
                                    if (!empty($ActualWorkingDates) && isset($ActualWorkingDates)) {
                                        foreach ($ActualWorkingDates as $a) {
                                            if ($a['ag_code'] == $v['ag_cd'] && $v['cd'] == $a['range_name']) {
                                                $actual_working_count = $a['actual_working_count'];
                                            }
                                        }
                                    }
                                    $totCurrentWorkingDays = $totCurrentWorkingDays + $actual_working_count;
                                    $expectedTargetUptoDate = 0;
                                    if ($totWorkingDays == 0) {
                                        $expectedTargetUptoDate = 'NA';
                                    } else {
                                        $expectedTargetUptoDate = ($targetVal / $totWorkingDays) * $totExpectedWorkingDays;
                                    }
                                    $persentage = 0;
                                    if ($targetVal == 0) {
                                        $persentage = 'NA';
                                    } else {
                                        $persentage = number_format(($v[$monthName . '-Total'] / $targetVal) * 100);
                                    }

                                    $workingDayVarience = $actual_working_count - $totExpectedWorkingDays;
                                    $totWorkingDayVarience = $totWorkingDayVarience + $workingDayVarience;
                                    $avgSale = 0;
                                    if ($actual_working_count == 0) {
                                        $avgSale = 'NA';
                                    } else {
                                        $avgSale = number_format($v[$monthName . '-Total'] / $actual_working_count);
                                    }

                                    $totTarget = $totTarget + $targetVal;

                                    $strBackValues = '';
                                    $strBackFoot = '';
                                    for ($k = 1; $k <= 6; $k++) {
                                        $monthNumberBack = date('m', strtotime($datepickermonth . ' -' . $k . ' month'));
                                        $monthNameBack = date('F', strtotime($datepickermonth . ' -' . $k . ' month'));
                                        $strBackValues .= '<td class="text-right" style="background: #fff473;">' . number_format($v[$monthNameBack . '-Total']) . '</td>';
                                        $OldMonthAvgPC = '<td></td>';
                                        if (!empty($categoryID) && isset($categoryID) && $categoryID != null) {//category pc requested need to get working days including categor bill dates and not billed dates 
                                            if (!empty($getTotalSalesandPc) && isset($getTotalSalesandPc)) {
                                                foreach ($getTotalSalesandPc as $p) {
                                                    if ($v['ag_cd'] === $p['ag_cd']) {
                                                        $totWDdays = 0;
                                                        if (!empty($getTotalSalesandPcFull) && isset($getTotalSalesandPcFull)) {
                                                            foreach ($getTotalSalesandPcFull as $pcFull) {
                                                                if ($p['ag_cd'] == $pcFull['ag_cd']) {
                                                                    $totWDdays = $pcFull[$monthNameBack . '_WD'];
                                                                }
                                                            }
                                                        }
                                                        if ($totWDdays == 0) {
                                                            $OldMonthAvgPC = '<td>NA</td>';
                                                        } else {
                                                            $OldMonthAvgPC = '<td>' . number_format($p[$monthNameBack . '_TotPC'] / $totWDdays, 1) . '</td>';
                                                        }
                                                    }
                                                }
                                            }
                                        } else {
                                            if (!empty($getTotalSalesandPc) && isset($getTotalSalesandPc)) {
                                                foreach ($getTotalSalesandPc as $p) {
                                                    if ($v['ag_cd'] === $p['ag_cd']) {
                                                        if ($p[$monthNameBack . '_WD'] == 0) {
                                                            $OldMonthAvgPC = '<td>NA</td>';
                                                        } else {
                                                            $OldMonthAvgPC = '<td>' . number_format($p[$monthNameBack . '_TotPC'] / $p[$monthNameBack . '_WD'], 1) . '</td>';
                                                        }
                                                    }
                                                }
                                            }
                                        }



                                        $strBackValues .= $OldMonthAvgPC;
                                        ${'totF' . $k} = ${'totF' . $k} + $v[$monthNameBack . '-Total'];
                                        $strBackFoot .= '<td class="text-right">' . number_format(${'totF' . $k}) . '</td><td> </td>';
                                    }

                                    //$totF = $totF + $v[$monthName . '-Total'];

                                    if ($max == 28) {
                                        $rowTotPc = $v[$monthName . '-1-pc'] + $v[$monthName . '-2-pc'] + $v[$monthName . '-3-pc'] + $v[$monthName . '-4-pc'] + $v[$monthName . '-5-pc'] + $v[$monthName . '-6-pc'] + $v[$monthName . '-7-pc'] + $v[$monthName . '-8-pc'] + $v[$monthName . '-9-pc'] + $v[$monthName . '-10-pc'] + $v[$monthName . '-11-pc'] + $v[$monthName . '-12-pc'] + $v[$monthName . '-13-pc'] + $v[$monthName . '-14-pc'] + $v[$monthName . '-15-pc'] + $v[$monthName . '-16-pc'] + $v[$monthName . '-17-pc'] + $v[$monthName . '-18-pc'] + $v[$monthName . '-19-pc'] + $v[$monthName . '-20-pc'] + $v[$monthName . '-21-pc'] + $v[$monthName . '-22-pc'] + $v[$monthName . '-23-pc'] + $v[$monthName . '-24-pc'] + $v[$monthName . '-25-pc'] + $v[$monthName . '-26-pc'] + $v[$monthName . '-27-pc'] + $v[$monthName . '-28-pc'];
                                    } elseif ($max == 29) {
                                        $rowTotPc = $v[$monthName . '-1-pc'] + $v[$monthName . '-2-pc'] + $v[$monthName . '-3-pc'] + $v[$monthName . '-4-pc'] + $v[$monthName . '-5-pc'] + $v[$monthName . '-6-pc'] + $v[$monthName . '-7-pc'] + $v[$monthName . '-8-pc'] + $v[$monthName . '-9-pc'] + $v[$monthName . '-10-pc'] + $v[$monthName . '-11-pc'] + $v[$monthName . '-12-pc'] + $v[$monthName . '-13-pc'] + $v[$monthName . '-14-pc'] + $v[$monthName . '-15-pc'] + $v[$monthName . '-16-pc'] + $v[$monthName . '-17-pc'] + $v[$monthName . '-18-pc'] + $v[$monthName . '-19-pc'] + $v[$monthName . '-20-pc'] + $v[$monthName . '-21-pc'] + $v[$monthName . '-22-pc'] + $v[$monthName . '-23-pc'] + $v[$monthName . '-24-pc'] + $v[$monthName . '-25-pc'] + $v[$monthName . '-26-pc'] + $v[$monthName . '-27-pc'] + $v[$monthName . '-28-pc'] + $v[$monthName . '-29-pc'];
                                    } elseif ($max == 30) {
                                        $rowTotPc = $v[$monthName . '-1-pc'] + $v[$monthName . '-2-pc'] + $v[$monthName . '-3-pc'] + $v[$monthName . '-4-pc'] + $v[$monthName . '-5-pc'] + $v[$monthName . '-6-pc'] + $v[$monthName . '-7-pc'] + $v[$monthName . '-8-pc'] + $v[$monthName . '-9-pc'] + $v[$monthName . '-10-pc'] + $v[$monthName . '-11-pc'] + $v[$monthName . '-12-pc'] + $v[$monthName . '-13-pc'] + $v[$monthName . '-14-pc'] + $v[$monthName . '-15-pc'] + $v[$monthName . '-16-pc'] + $v[$monthName . '-17-pc'] + $v[$monthName . '-18-pc'] + $v[$monthName . '-19-pc'] + $v[$monthName . '-20-pc'] + $v[$monthName . '-21-pc'] + $v[$monthName . '-22-pc'] + $v[$monthName . '-23-pc'] + $v[$monthName . '-24-pc'] + $v[$monthName . '-25-pc'] + $v[$monthName . '-26-pc'] + $v[$monthName . '-27-pc'] + $v[$monthName . '-28-pc'] + $v[$monthName . '-29-pc'] + $v[$monthName . '-30-pc'];
                                    } elseif ($max == 31) {
                                        $rowTotPc = $v[$monthName . '-1-pc'] + $v[$monthName . '-2-pc'] + $v[$monthName . '-3-pc'] + $v[$monthName . '-4-pc'] + $v[$monthName . '-5-pc'] + $v[$monthName . '-6-pc'] + $v[$monthName . '-7-pc'] + $v[$monthName . '-8-pc'] + $v[$monthName . '-9-pc'] + $v[$monthName . '-10-pc'] + $v[$monthName . '-11-pc'] + $v[$monthName . '-12-pc'] + $v[$monthName . '-13-pc'] + $v[$monthName . '-14-pc'] + $v[$monthName . '-15-pc'] + $v[$monthName . '-16-pc'] + $v[$monthName . '-17-pc'] + $v[$monthName . '-18-pc'] + $v[$monthName . '-19-pc'] + $v[$monthName . '-20-pc'] + $v[$monthName . '-21-pc'] + $v[$monthName . '-22-pc'] + $v[$monthName . '-23-pc'] + $v[$monthName . '-24-pc'] + $v[$monthName . '-25-pc'] + $v[$monthName . '-26-pc'] + $v[$monthName . '-27-pc'] + $v[$monthName . '-28-pc'] + $v[$monthName . '-29-pc'] + $v[$monthName . '-30-pc'] + $v[$monthName . '-31-pc'];
                                    }
                                    $avgPCperDay = 0;
                                    if ($actual_working_count == 0) {
                                        $avgPCperDay = 'NA';
                                    } else {
                                        $avgPCperDay = number_format($rowTotPc / $actual_working_count, 1);
                                    }

                                    $varienceValue = $v[$monthName . '-Total'] - $expectedTargetUptoDate;
                                    $totVarienceValue = $totVarienceValue + $varienceValue;

                                    $totF = $totF + $v[$monthName . '-Total'];
                                    $totPcF = $totPcF + $rowTotPc;
                                    echo '<tr>'
                                    . '<td class="sticky-col first-col" >' . $v['area_name'] . '</td>'
                                    . '<td class="sticky-col first-col" >' . $v['ag_name'] . '</td>'
                                    . '<td>' . $v['ag_cd'] . '</td>'
                                    . '<td>' . $v['cd'] . '</td>'
                                    . $strRowWithPc
                                    . '<td class="text-right" style="font-weight:bold;">' . number_format($targetVal) . '</td>'
                                    . '<td class="text-right" style="font-weight:bold;">' . number_format($v[$monthName . '-Total']) . '</td>'
                                    . '<td>' . (($varienceValue) < 0 ? "(" . number_format(abs($varienceValue)) . ")" : number_format($varienceValue)) . '</td>'
                                    . '<td>' . ($persentage) . '%</td>'
                                    . '<td>' . ((($workingDayVarience) < 0 ? "(" . number_format(abs($workingDayVarience)) . ")" : number_format($workingDayVarience))) . '</td>'
                                    . '<td>' . ($avgSale) . '</td>'
                                    . '<td>' . ($avgPCperDay) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;font-weight:bold;">' . number_format($rowTotPc) . '</td>'
                                    . $strBackValues
                                    . '</tr>';
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <?php
                                $PP = 'target not set';
                                if ($totTarget != 0) {
                                    $PP = number_format(($totF / $totTarget) * 100);
                                }
                                echo '<tr style="font-weight:bold;">'
                                . '<td colspan="4">Total</td>'
                                . $strRowFootWithPC
                                . '<td>' . number_format($totTarget) . '</td>'
                                . '<td class="text-right" style="font-weight:bold;">' . number_format($totF) . '</td>'
                                . '<td>' . ((($totVarienceValue) < 0 ? "(" . number_format(abs($totVarienceValue)) . ")" : number_format($totVarienceValue))) . '</td>'
                                . '<td>' . ($PP) . '%</td>'
                                . '<td>' . ((($totWorkingDayVarience) < 0 ? "(" . number_format(abs($totWorkingDayVarience)) . ")" : number_format($totWorkingDayVarience))) . '</td>'
                                . '<td>' . number_format($totF / $totCurrentWorkingDays) . '</td>'
                                . '<td>' . number_format($totPcF / $totCurrentWorkingDays, 1) . '</td>'
                                . '<td class="text-right" style="background: #efebb9;font-weight:bold;">' . number_format($totPcF) . '</td>'
                                . $strBackFoot
                                . '</tr>';
                                ?>
                            </tfoot>
                        </table>

                        <div class="box-body chart-responsive">
                            <div class="chart" id="line-chart" style="height: 300px;"></div>
                        </div>

                        <?php
                    }
                    ?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-xs-12">
                    <?php
                    if (!empty($DailySalesQty) && isset($DailySalesQty)) {
                        $totWorkingDays = 0;
                        if (!empty($targetData) && isset($targetData)) {
                            foreach ($targetData as $t) {
                                $totWorkingDays = $t['wd'];
                            }
                        }
                        $totExpectedWorkingDays = 0; // total need to complated as at date
                        if (!empty($WorkingDates) && isset($WorkingDates)) {
                            foreach ($WorkingDates as $d) {
                                if ($d['is_working'] == 1) {
                                    $totExpectedWorkingDays += 1;
                                }
                            }
                        }

                        if (date('Y-m', strtotime($datepickermonth)) === date('Y-m')) {//if this is calender current month ignore today
                            $totExpectedWorkingDays = $totExpectedWorkingDays - 1;
                        }
                        $tot01 = 0;
                        $tot02 = 0;
                        $tot03 = 0;
                        $tot04 = 0;
                        $tot05 = 0;
                        $tot06 = 0;
                        $tot07 = 0;
                        $tot08 = 0;
                        $tot09 = 0;
                        $tot10 = 0;
                        $tot11 = 0;
                        $tot12 = 0;
                        $tot13 = 0;
                        $tot14 = 0;
                        $tot15 = 0;
                        $tot16 = 0;
                        $tot17 = 0;
                        $tot18 = 0;
                        $tot19 = 0;
                        $tot20 = 0;
                        $tot21 = 0;
                        $tot22 = 0;
                        $tot23 = 0;
                        $tot24 = 0;
                        $tot25 = 0;
                        $tot26 = 0;
                        $tot27 = 0;
                        $tot28 = 0;
                        $tot29 = 0;
                        $tot30 = 0;
                        $tot31 = 0;

                        $tot01_pc = 0;
                        $tot02_pc = 0;
                        $tot03_pc = 0;
                        $tot04_pc = 0;
                        $tot05_pc = 0;
                        $tot06_pc = 0;
                        $tot07_pc = 0;
                        $tot08_pc = 0;
                        $tot09_pc = 0;
                        $tot10_pc = 0;
                        $tot11_pc = 0;
                        $tot12_pc = 0;
                        $tot13_pc = 0;
                        $tot14_pc = 0;
                        $tot15_pc = 0;
                        $tot16_pc = 0;
                        $tot17_pc = 0;
                        $tot18_pc = 0;
                        $tot19_pc = 0;
                        $tot20_pc = 0;
                        $tot21_pc = 0;
                        $tot22_pc = 0;
                        $tot23_pc = 0;
                        $tot24_pc = 0;
                        $tot25_pc = 0;
                        $tot26_pc = 0;
                        $tot27_pc = 0;
                        $tot28_pc = 0;
                        $tot29_pc = 0;
                        $tot30_pc = 0;
                        $tot31_pc = 0;

                        $rowTotPc = 0;

                        $totF = 0;
                        $totPcF = 0;

                        $monthNumber = date('m', strtotime($datepickermonth));
                        $monthName = date('F', strtotime($datepickermonth));
                        $year = date('Y', strtotime($datepickermonth));
                        $strDayCol = '';
                        $strDayColWithPC = '';
                        $strDayColValPC = '';
                        for ($n = 1; $n <= date('t', strtotime($datepickermonth)); $n++) {
                            $strDayCol .= '<th>' . $monthName . '-' . sprintf("%02d", $n) . '</th>';
                            $strDayColWithPC .= '<th colspan="2">' . $monthName . '-' . sprintf("%02d", $n) . '</th>';
                            $strDayColValPC .= '<th>Quantity</th><th style="background: #efebb9;">PC</th>';
                        }
                        //echo $strDayCol;
                        $strBack = '';
                        for ($k = 1; $k <= 6; $k++) {
                            $monthNumberBack = date('m', strtotime($datepickermonth . ' -' . $k . ' month'));
                            $monthNameBack = date('F', strtotime($datepickermonth . ' -' . $k . ' month'));
                            $strBack .= '<th style="background: #000000 !important; color: #fff; text-align: center;">' . $monthNameBack . '-Total Qty</th><th>' . $monthNameBack . '- Avg PC</th>';
                            ${'totF' . $k} = 0;
                        }
                        ?>
                        <h2>Total Actual Achievement Quantity with PC <?php if (!empty($categoryLineData) && isset($categoryLineData)) {
                        echo ' - ' . $categoryLineData->name;
                    } ?></h2>
                        <h3>Total Working Days: <?= $totWorkingDays ?> / Expected Working Days As at: <?= $totExpectedWorkingDays ?></h3>
                        <small>Today is ignored from expected working day count.</small>
                        <input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('attendance_table2', 'Daily Sales <?= $monthName ?>')" value="Download Excel"><br>
                        <table id="attendance_table2" class="table table-hover presentation">
                            <thead>
                                <tr>
                                    <th colspan="4"></th> 
                                    <?= $strDayColWithPC ?> 
                                    <th colspan="8" style="text-align: center;"><?= $monthName ?>-Total</th>
                                    <th colspan="12" style="background: #000000 !important; color: #fff; text-align: center;">Past Figures</th>
                                </tr>
                                <tr>
                                    <th>Area</th>
                                    <th>Territory</th>
                                    <th>Territory Code</th>
                                    <th>Range</th>
                                    <?= $strDayColValPC ?> 
                                    <th>Target</th>
                                    <th><?= $monthName ?>-Total</th> 
                                    <th>Variance - Cum Target vs</th> 
                                    <th><!-- Target vs  Cum with Dir. -->Sales (%)</th> 
                                    <th>WD Variance</th> 
                                    <th>Avg (With Direct)</th> 
                                    <th>Avg PC<!-- per day--></th> 
                                    <th style="background: #efebb9;"><?= $monthName ?>-Total-PC</th>
                                    <?= $strBack ?> 
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $totCurrentWorkingDays = 0;
                                $totWorkingDayVarience = 0;
                                $totTarget = 0;
                                $totVarienceValue = 0;
                                foreach ($DailySalesQty as $v) {
                                    $rowTotPc = 0;

                                    $strRow = '';
                                    $strRowWithPc = '';
                                    $strRowFoot = '';
                                    $strRowFootWithPC = '';
                                    $max = 0;
                                    for ($n = 1; $n <= date('t', strtotime($datepickermonth)); $n++) {
                                        $territoryWithSaleCount = 0;
                                        $max = $n;
                                        ${'tot' . sprintf("%02d", $n)} = ${'tot' . sprintf("%02d", $n)} + $v[$monthName . '-' . $n];
                                        ${'tot' . sprintf("%02d", $n) . '_pc'} = ${'tot' . sprintf("%02d", $n) . '_pc'} + $v[$monthName . '-' . $n . '-pc'];
                                        $strRow .= '<td class="text-right">' . number_format($v[$monthName . '-' . $n]) . '</td>';
                                        if ($v[$monthName . '-' . $n] != 0) {
                                            $strRowWithPc .= '<td class="text-right">' . number_format($v[$monthName . '-' . $n]) . '</td>'
                                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($v[$monthName . '-' . $n . '-pc']) . '</td>';
                                        } else {
                                            $strRowWithPc .= '<td class="text-right">-</td>'
                                                    . '<td class="text-right" style="background: #efebb9;">-</td>';
                                        }
                                        $strRowFoot .= '<td class="text-right">' . number_format(${'tot' . sprintf("%02d", $n)}) . '</td>';

                                        $strRowFootWithPC .= '<td class="text-right">' . number_format(${'tot' . sprintf("%02d", $n)}) . '</td>'
                                                . '<td class="text-right" style="background: #efebb9;">' . number_format(${'tot' . sprintf("%02d", $n) . '_pc'}) . '</td>';
                                    }
                                    $targetVal = 0;
                                    $totWorkingDays = 0;
                                    $expectedTargetUptoDate = 0;
                                    $persentage = 0;
                                    $workingDayVarience = 0;
                                    $avgSale = 0;
                                    $avgPCperDay = 0;
                                    $varienceValue = 0;
                                    if (!empty($targetData) && isset($targetData)) {
                                        foreach ($targetData as $t) {
                                            if ($t['ag_cd'] == $v['ag_cd']) {
                                                $targetVal = $t[strtolower($RangeName) . '_target'];
                                                $totWorkingDays = $t['wd'];
                                            }
                                        }
                                    }
                                    $totExpectedWorkingDays = 0; // total need to complated as at date


                                    if (!empty($WorkingDates) && isset($WorkingDates)) {
                                        foreach ($WorkingDates as $d) {
                                            if ($d['is_working'] == 1) {
                                                $totExpectedWorkingDays += 1;
                                            }
                                        }
                                    }
                                    if (date('Y-m', strtotime($datepickermonth)) === date('Y-m')) {//if this is calender current month ignore today
                                        $totExpectedWorkingDays = $totExpectedWorkingDays - 1;
                                    }
                                    $actual_working_count = 0; // rep actually working days count as at date
                                    if (!empty($ActualWorkingDates) && isset($ActualWorkingDates)) {
                                        foreach ($ActualWorkingDates as $a) {
                                            if ($a['ag_code'] == $v['ag_cd'] && $v['cd'] == $a['range_name']) {
                                                $actual_working_count = $a['actual_working_count'];
                                            }
                                        }
                                    }
                                    $totCurrentWorkingDays = $totCurrentWorkingDays + $actual_working_count;
                                    $expectedTargetUptoDate = 0;
                                    if ($totWorkingDays == 0) {
                                        $expectedTargetUptoDate = 'NA';
                                    } else {
                                        $expectedTargetUptoDate = ($targetVal / $totWorkingDays) * $totExpectedWorkingDays;
                                    }
                                    $persentage = 0;
                                    if ($targetVal == 0) {
                                        $persentage = 'NA';
                                    } else {
                                        $persentage = number_format(($v[$monthName . '-Total'] / $targetVal) * 100);
                                    }

                                    $workingDayVarience = $actual_working_count - $totExpectedWorkingDays;
                                    $totWorkingDayVarience = $totWorkingDayVarience + $workingDayVarience;
                                    $avgSale = 0;
                                    if ($actual_working_count == 0) {
                                        $avgSale = 'NA';
                                    } else {
                                        $avgSale = number_format($v[$monthName . '-Total'] / $actual_working_count);
                                    }

                                    $totTarget = $totTarget + $targetVal;

                                    $strBackValues = '';
                                    $strBackFoot = '';
                                    for ($k = 1; $k <= 6; $k++) {
                                        $monthNumberBack = date('m', strtotime($datepickermonth . ' -' . $k . ' month'));
                                        $monthNameBack = date('F', strtotime($datepickermonth . ' -' . $k . ' month'));
                                        $strBackValues .= '<td class="text-right" style="background: #fff473;">' . number_format($v[$monthNameBack . '-Total']) . '</td>';
                                        $OldMonthAvgPC = '<td></td>';
                                        
                                        /*
                                        if (!empty($getTotalSalesandPc) && isset($getTotalSalesandPc)) {
                                            foreach ($getTotalSalesandPc as $p) {
                                                if ($v['ag_cd'] === $p['ag_cd']) {
                                                    if ($p[$monthNameBack . '_WD'] == 0) {
                                                        $OldMonthAvgPC = '<td>NA</td>';
                                                    } else {
                                                        $OldMonthAvgPC = '<td>' . number_format($p[$monthNameBack . '_TotPC'] / $p[$monthNameBack . '_WD'], 1) . '</td>';
                                                    }
                                                }
                                            }
                                        }
                                        */
                                        
                                        if (!empty($categoryID) && isset($categoryID) && $categoryID != null) {//category pc requested need to get working days including categor bill dates and not billed dates 
                                            if (!empty($getTotalSalesandPc) && isset($getTotalSalesandPc)) {
                                                foreach ($getTotalSalesandPc as $p) {
                                                    if ($v['ag_cd'] === $p['ag_cd']) {
                                                        $totWDdays = 0;
                                                        if (!empty($getTotalSalesandPcFull) && isset($getTotalSalesandPcFull)) {
                                                            foreach ($getTotalSalesandPcFull as $pcFull) {
                                                                if ($p['ag_cd'] == $pcFull['ag_cd']) {
                                                                    $totWDdays = $pcFull[$monthNameBack . '_WD'];
                                                                }
                                                            }
                                                        }
                                                        if ($totWDdays == 0) {
                                                            $OldMonthAvgPC = '<td>NA</td>';
                                                        } else {
                                                            $OldMonthAvgPC = '<td>' . number_format($p[$monthNameBack . '_TotPC'] / $totWDdays, 1) . '</td>';
                                                        }
                                                    }
                                                }
                                            }
                                        } else {
                                            if (!empty($getTotalSalesandPc) && isset($getTotalSalesandPc)) {
                                                foreach ($getTotalSalesandPc as $p) {
                                                    if ($v['ag_cd'] === $p['ag_cd']) {
                                                        if ($p[$monthNameBack . '_WD'] == 0) {
                                                            $OldMonthAvgPC = '<td>NA</td>';
                                                        } else {
                                                            $OldMonthAvgPC = '<td>' . number_format($p[$monthNameBack . '_TotPC'] / $p[$monthNameBack . '_WD'], 1) . '</td>';
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                        
                                        $strBackValues .= $OldMonthAvgPC;
                                        ${'totF' . $k} = ${'totF' . $k} + $v[$monthNameBack . '-Total'];
                                        $strBackFoot .= '<td class="text-right">' . number_format(${'totF' . $k}) . '</td><td> </td>';
                                    }

                                    //$totF = $totF + $v[$monthName . '-Total'];

                                    if ($max == 28) {
                                        $rowTotPc = $v[$monthName . '-1-pc'] + $v[$monthName . '-2-pc'] + $v[$monthName . '-3-pc'] + $v[$monthName . '-4-pc'] + $v[$monthName . '-5-pc'] + $v[$monthName . '-6-pc'] + $v[$monthName . '-7-pc'] + $v[$monthName . '-8-pc'] + $v[$monthName . '-9-pc'] + $v[$monthName . '-10-pc'] + $v[$monthName . '-11-pc'] + $v[$monthName . '-12-pc'] + $v[$monthName . '-13-pc'] + $v[$monthName . '-14-pc'] + $v[$monthName . '-15-pc'] + $v[$monthName . '-16-pc'] + $v[$monthName . '-17-pc'] + $v[$monthName . '-18-pc'] + $v[$monthName . '-19-pc'] + $v[$monthName . '-20-pc'] + $v[$monthName . '-21-pc'] + $v[$monthName . '-22-pc'] + $v[$monthName . '-23-pc'] + $v[$monthName . '-24-pc'] + $v[$monthName . '-25-pc'] + $v[$monthName . '-26-pc'] + $v[$monthName . '-27-pc'] + $v[$monthName . '-28-pc'];
                                    } elseif ($max == 29) {
                                        $rowTotPc = $v[$monthName . '-1-pc'] + $v[$monthName . '-2-pc'] + $v[$monthName . '-3-pc'] + $v[$monthName . '-4-pc'] + $v[$monthName . '-5-pc'] + $v[$monthName . '-6-pc'] + $v[$monthName . '-7-pc'] + $v[$monthName . '-8-pc'] + $v[$monthName . '-9-pc'] + $v[$monthName . '-10-pc'] + $v[$monthName . '-11-pc'] + $v[$monthName . '-12-pc'] + $v[$monthName . '-13-pc'] + $v[$monthName . '-14-pc'] + $v[$monthName . '-15-pc'] + $v[$monthName . '-16-pc'] + $v[$monthName . '-17-pc'] + $v[$monthName . '-18-pc'] + $v[$monthName . '-19-pc'] + $v[$monthName . '-20-pc'] + $v[$monthName . '-21-pc'] + $v[$monthName . '-22-pc'] + $v[$monthName . '-23-pc'] + $v[$monthName . '-24-pc'] + $v[$monthName . '-25-pc'] + $v[$monthName . '-26-pc'] + $v[$monthName . '-27-pc'] + $v[$monthName . '-28-pc'] + $v[$monthName . '-29-pc'];
                                    } elseif ($max == 30) {
                                        $rowTotPc = $v[$monthName . '-1-pc'] + $v[$monthName . '-2-pc'] + $v[$monthName . '-3-pc'] + $v[$monthName . '-4-pc'] + $v[$monthName . '-5-pc'] + $v[$monthName . '-6-pc'] + $v[$monthName . '-7-pc'] + $v[$monthName . '-8-pc'] + $v[$monthName . '-9-pc'] + $v[$monthName . '-10-pc'] + $v[$monthName . '-11-pc'] + $v[$monthName . '-12-pc'] + $v[$monthName . '-13-pc'] + $v[$monthName . '-14-pc'] + $v[$monthName . '-15-pc'] + $v[$monthName . '-16-pc'] + $v[$monthName . '-17-pc'] + $v[$monthName . '-18-pc'] + $v[$monthName . '-19-pc'] + $v[$monthName . '-20-pc'] + $v[$monthName . '-21-pc'] + $v[$monthName . '-22-pc'] + $v[$monthName . '-23-pc'] + $v[$monthName . '-24-pc'] + $v[$monthName . '-25-pc'] + $v[$monthName . '-26-pc'] + $v[$monthName . '-27-pc'] + $v[$monthName . '-28-pc'] + $v[$monthName . '-29-pc'] + $v[$monthName . '-30-pc'];
                                    } elseif ($max == 31) {
                                        $rowTotPc = $v[$monthName . '-1-pc'] + $v[$monthName . '-2-pc'] + $v[$monthName . '-3-pc'] + $v[$monthName . '-4-pc'] + $v[$monthName . '-5-pc'] + $v[$monthName . '-6-pc'] + $v[$monthName . '-7-pc'] + $v[$monthName . '-8-pc'] + $v[$monthName . '-9-pc'] + $v[$monthName . '-10-pc'] + $v[$monthName . '-11-pc'] + $v[$monthName . '-12-pc'] + $v[$monthName . '-13-pc'] + $v[$monthName . '-14-pc'] + $v[$monthName . '-15-pc'] + $v[$monthName . '-16-pc'] + $v[$monthName . '-17-pc'] + $v[$monthName . '-18-pc'] + $v[$monthName . '-19-pc'] + $v[$monthName . '-20-pc'] + $v[$monthName . '-21-pc'] + $v[$monthName . '-22-pc'] + $v[$monthName . '-23-pc'] + $v[$monthName . '-24-pc'] + $v[$monthName . '-25-pc'] + $v[$monthName . '-26-pc'] + $v[$monthName . '-27-pc'] + $v[$monthName . '-28-pc'] + $v[$monthName . '-29-pc'] + $v[$monthName . '-30-pc'] + $v[$monthName . '-31-pc'];
                                    }
                                    $avgPCperDay = 0;
                                    if ($actual_working_count == 0) {
                                        $avgPCperDay = 'NA';
                                    } else {
                                        $avgPCperDay = number_format($rowTotPc / $actual_working_count, 1);
                                    }

                                    $varienceValue = $v[$monthName . '-Total'] - $expectedTargetUptoDate;
                                    $totVarienceValue = $totVarienceValue + $varienceValue;

                                    $totF = $totF + $v[$monthName . '-Total'];
                                    $totPcF = $totPcF + $rowTotPc;
                                    echo '<tr>'
                                    . '<td class="sticky-col first-col" >' . $v['area_name'] . '</td>'
                                    . '<td class="sticky-col first-col" >' . $v['ag_name'] . '</td>'
                                    . '<td>' . $v['ag_cd'] . '</td>'
                                    . '<td>' . $v['cd'] . '</td>'
                                    . $strRowWithPc
                                    . '<td class="text-right" style="font-weight:bold;">' . number_format($targetVal) . '</td>'
                                    . '<td class="text-right" style="font-weight:bold;">' . number_format($v[$monthName . '-Total']) . '</td>'
                                    . '<td>' . (($varienceValue) < 0 ? "(" . number_format(abs($varienceValue)) . ")" : number_format($varienceValue)) . '</td>'
                                    . '<td>' . ($persentage) . '%</td>'
                                    . '<td>' . ((($workingDayVarience) < 0 ? "(" . number_format(abs($workingDayVarience)) . ")" : number_format($workingDayVarience))) . '</td>'
                                    . '<td>' . ($avgSale) . '</td>'
                                    . '<td>' . ($avgPCperDay) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;font-weight:bold;">' . number_format($rowTotPc) . '</td>'
                                    . $strBackValues
                                    . '</tr>';
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <?php
                                $PP = 'target not set';
                                if ($totTarget != 0) {
                                    $PP = number_format(($totF / $totTarget) * 100);
                                }
                                echo '<tr style="font-weight:bold;">'
                                . '<td colspan="4">Total</td>'
                                . $strRowFootWithPC
                                . '<td>' . number_format($totTarget) . '</td>'
                                . '<td class="text-right" style="font-weight:bold;">' . number_format($totF) . '</td>'
                                . '<td>' . ((($totVarienceValue) < 0 ? "(" . number_format(abs($totVarienceValue)) . ")" : number_format($totVarienceValue))) . '</td>'
                                . '<td>' . ($PP) . '%</td>'
                                . '<td>' . ((($totWorkingDayVarience) < 0 ? "(" . number_format(abs($totWorkingDayVarience)) . ")" : number_format($totWorkingDayVarience))) . '</td>'
                                . '<td>' . number_format($totF / $totCurrentWorkingDays) . '</td>'
                                . '<td>' . number_format($totPcF / $totCurrentWorkingDays, 1) . '</td>'
                                . '<td class="text-right" style="background: #efebb9;font-weight:bold;">' . number_format($totPcF) . '</td>'
                                . $strBackFoot
                                . '</tr>';
                                ?>
                            </tfoot>
                        </table>

                        <div class="box-body chart-responsive">
                            <div class="chart" id="line-chart" style="height: 300px;"></div>
                        </div>

                        <?php
                    }
                    ?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-xs-12">
                    <?php
                    if (!empty($DailySalesD) && isset($DailySalesD)) {
                        $tot01 = 0;
                        $tot02 = 0;
                        $tot03 = 0;
                        $tot04 = 0;
                        $tot05 = 0;
                        $tot06 = 0;
                        $tot07 = 0;
                        $tot08 = 0;
                        $tot09 = 0;
                        $tot10 = 0;
                        $tot11 = 0;
                        $tot12 = 0;
                        $tot13 = 0;
                        $tot14 = 0;
                        $tot15 = 0;
                        $tot16 = 0;
                        $tot17 = 0;
                        $tot18 = 0;
                        $tot19 = 0;
                        $tot20 = 0;
                        $tot21 = 0;
                        $tot22 = 0;
                        $tot23 = 0;
                        $tot24 = 0;
                        $tot25 = 0;
                        $tot26 = 0;
                        $tot27 = 0;
                        $tot28 = 0;
                        $tot29 = 0;
                        $tot30 = 0;
                        $totF = 0;
                        ?>
                        <h2>D Range Aarya Pads Achievement</h2>
                        <input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('attendance_table2', 'Aarya Pads Daily Sales April')" value="Download Excel"><br>
                        <table id="attendance_table2" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Area</th>
                                    <th>Territory</th>
                                    <th>Territory Code</th>
                                    <th>Range</th>
                                    <th>April-01-Aarya-Pads</th>
                                    <th>April-02-Aarya-Pads</th>
                                    <th>April-03-Aarya-Pads</th>
                                    <th>April-04-Aarya-Pads</th>
                                    <th>April-05-Aarya-Pads</th>
                                    <th>April-06-Aarya-Pads</th>
                                    <th>April-07-Aarya-Pads</th>
                                    <th>April-08-Aarya-Pads</th>
                                    <th>April-09-Aarya-Pads</th>
                                    <th>April-10-Aarya-Pads</th>
                                    <th>April-11-Aarya-Pads</th>
                                    <th>April-12-Aarya-Pads</th>
                                    <th>April-13-Aarya-Pads</th>
                                    <th>April-14-Aarya-Pads</th>
                                    <th>April-15-Aarya-Pads</th>
                                    <th>April-16-Aarya-Pads</th>
                                    <th>April-17-Aarya-Pads</th>
                                    <th>April-18-Aarya-Pads</th>
                                    <th>April-19-Aarya-Pads</th>
                                    <th>April-20-Aarya-Pads</th>
                                    <th>April-21-Aarya-Pads</th>
                                    <th>April-22-Aarya-Pads</th>
                                    <th>April-23-Aarya-Pads</th>
                                    <th>April-24-Aarya-Pads</th>
                                    <th>April-25-Aarya-Pads</th>
                                    <th>April-26-Aarya-Pads</th>
                                    <th>April-27-Aarya-Pads</th>
                                    <th>April-28-Aarya-Pads</th>
                                    <th>April-29-Aarya-Pads</th>
                                    <th>April-30-Aarya-Pads</th>
                                    <th>April-Total-Aarya-Pads</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($DailySalesD as $v) {
                                    $tot01 = $tot01 + $v['April-01-Aarya-Pads'];
                                    $tot02 = $tot02 + $v['April-02-Aarya-Pads'];
                                    $tot03 = $tot03 + $v['April-03-Aarya-Pads'];
                                    $tot04 = $tot04 + $v['April-04-Aarya-Pads'];
                                    $tot05 = $tot05 + $v['April-05-Aarya-Pads'];
                                    $tot06 = $tot06 + $v['April-06-Aarya-Pads'];
                                    $tot07 = $tot07 + $v['April-07-Aarya-Pads'];
                                    $tot08 = $tot08 + $v['April-08-Aarya-Pads'];
                                    $tot09 = $tot09 + $v['April-09-Aarya-Pads'];
                                    $tot10 = $tot10 + $v['April-10-Aarya-Pads'];
                                    $tot11 = $tot11 + $v['April-11-Aarya-Pads'];
                                    $tot12 = $tot12 + $v['April-12-Aarya-Pads'];
                                    $tot13 = $tot13 + $v['April-13-Aarya-Pads'];
                                    $tot14 = $tot14 + $v['April-14-Aarya-Pads'];
                                    $tot15 = $tot15 + $v['April-15-Aarya-Pads'];
                                    $tot16 = $tot16 + $v['April-16-Aarya-Pads'];
                                    $tot17 = $tot17 + $v['April-17-Aarya-Pads'];
                                    $tot18 = $tot18 + $v['April-18-Aarya-Pads'];
                                    $tot19 = $tot19 + $v['April-19-Aarya-Pads'];
                                    $tot20 = $tot20 + $v['April-20-Aarya-Pads'];
                                    $tot21 = $tot21 + $v['April-21-Aarya-Pads'];
                                    $tot22 = $tot22 + $v['April-22-Aarya-Pads'];
                                    $tot23 = $tot23 + $v['April-23-Aarya-Pads'];
                                    $tot24 = $tot24 + $v['April-24-Aarya-Pads'];
                                    $tot25 = $tot25 + $v['April-25-Aarya-Pads'];
                                    $tot26 = $tot26 + $v['April-26-Aarya-Pads'];
                                    $tot27 = $tot27 + $v['April-27-Aarya-Pads'];
                                    $tot28 = $tot28 + $v['April-28-Aarya-Pads'];
                                    $tot29 = $tot29 + $v['April-29-Aarya-Pads'];
                                    $tot30 = $tot30 + $v['April-30-Aarya-Pads'];
                                    $totF = $totF + $v['April-Total-Aarya-Pads'];
                                    echo '<tr>'
                                    . '<td>' . $v['area_name'] . '</td>'
                                    . '<td>' . $v['ag_name'] . '</td>'
                                    . '<td>' . $v['ag_cd'] . '</td>'
                                    . '<td>' . $v['cd'] . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-01-Aarya-Pads']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-02-Aarya-Pads']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-03-Aarya-Pads']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-04-Aarya-Pads']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-05-Aarya-Pads']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-06-Aarya-Pads']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-07-Aarya-Pads']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-08-Aarya-Pads']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-09-Aarya-Pads']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-10-Aarya-Pads']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-11-Aarya-Pads']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-12-Aarya-Pads']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-13-Aarya-Pads']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-14-Aarya-Pads']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-15-Aarya-Pads']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-16-Aarya-Pads']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-17-Aarya-Pads']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-18-Aarya-Pads']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-19-Aarya-Pads']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-20-Aarya-Pads']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-21-Aarya-Pads']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-22-Aarya-Pads']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-23-Aarya-Pads']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-24-Aarya-Pads']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-25-Aarya-Pads']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-26-Aarya-Pads']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-27-Aarya-Pads']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-28-Aarya-Pads']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-29-Aarya-Pads']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-30-Aarya-Pads']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-Total-Aarya-Pads']) . '</td>'
                                    . '</tr>';
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <?php
                                echo '<tr style="font-weight:bold;">'
                                . '<td colspan="4">Total</td>'
                                . '<td class="text-right">' . number_format($tot01) . '</td>'
                                . '<td class="text-right">' . number_format($tot02) . '</td>'
                                . '<td class="text-right">' . number_format($tot03) . '</td>'
                                . '<td class="text-right">' . number_format($tot04) . '</td>'
                                . '<td class="text-right">' . number_format($tot05) . '</td>'
                                . '<td class="text-right">' . number_format($tot06) . '</td>'
                                . '<td class="text-right">' . number_format($tot07) . '</td>'
                                . '<td class="text-right">' . number_format($tot08) . '</td>'
                                . '<td class="text-right">' . number_format($tot09) . '</td>'
                                . '<td class="text-right">' . number_format($tot10) . '</td>'
                                . '<td class="text-right">' . number_format($tot11) . '</td>'
                                . '<td class="text-right">' . number_format($tot12) . '</td>'
                                . '<td class="text-right">' . number_format($tot13) . '</td>'
                                . '<td class="text-right">' . number_format($tot14) . '</td>'
                                . '<td class="text-right">' . number_format($tot15) . '</td>'
                                . '<td class="text-right">' . number_format($tot16) . '</td>'
                                . '<td class="text-right">' . number_format($tot17) . '</td>'
                                . '<td class="text-right">' . number_format($tot18) . '</td>'
                                . '<td class="text-right">' . number_format($tot19) . '</td>'
                                . '<td class="text-right">' . number_format($tot20) . '</td>'
                                . '<td class="text-right">' . number_format($tot21) . '</td>'
                                . '<td class="text-right">' . number_format($tot22) . '</td>'
                                . '<td class="text-right">' . number_format($tot23) . '</td>'
                                . '<td class="text-right">' . number_format($tot24) . '</td>'
                                . '<td class="text-right">' . number_format($tot25) . '</td>'
                                . '<td class="text-right">' . number_format($tot26) . '</td>'
                                . '<td class="text-right">' . number_format($tot27) . '</td>'
                                . '<td class="text-right">' . number_format($tot28) . '</td>'
                                . '<td class="text-right">' . number_format($tot29) . '</td>'
                                . '<td class="text-right">' . number_format($tot30) . '</td>'
                                . '<td class="text-right">' . number_format($totF) . '</td>'
                                . '</tr>';
                                ?>
                            </tfoot>
                        </table>
                        <?php
                    }
                    ?>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12 col-xs-12">
                    <?php
                    if (!empty($DailySalesSoya) && isset($DailySalesSoya)) {
                        $tot01 = 0;
                        $tot02 = 0;
                        $tot03 = 0;
                        $tot04 = 0;
                        $tot05 = 0;
                        $tot06 = 0;
                        $tot07 = 0;
                        $tot08 = 0;
                        $tot09 = 0;
                        $tot10 = 0;
                        $tot11 = 0;
                        $tot12 = 0;
                        $tot13 = 0;
                        $tot14 = 0;
                        $tot15 = 0;
                        $tot16 = 0;
                        $tot17 = 0;
                        $tot18 = 0;
                        $tot19 = 0;
                        $tot20 = 0;
                        $tot21 = 0;
                        $tot22 = 0;
                        $tot23 = 0;
                        $tot24 = 0;
                        $tot25 = 0;
                        $tot26 = 0;
                        $tot27 = 0;
                        $tot28 = 0;
                        $tot29 = 0;
                        $tot30 = 0;
                        $totF = 0;
                        ?>
                        <h2>C Range Soya Packet Achievement</h2>
                        <input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('attendance_table3', 'Soya Packets Daily Sales April')" value="Download Excel"><br>
                        <table id="attendance_table3" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Area</th>
                                    <th>Territory</th>
                                    <th>Territory Code</th>
                                    <th>Range</th>
                                    <th>April-01-Soya</th>
                                    <th>April-02-Soya</th>
                                    <th>April-03-Soya</th>
                                    <th>April-04-Soya</th>
                                    <th>April-05-Soya</th>
                                    <th>April-06-Soya</th>
                                    <th>April-07-Soya</th>
                                    <th>April-08-Soya</th>
                                    <th>April-09-Soya</th>
                                    <th>April-10-Soya</th>
                                    <th>April-11-Soya</th>
                                    <th>April-12-Soya</th>
                                    <th>April-13-Soya</th>
                                    <th>April-14-Soya</th>
                                    <th>April-15-Soya</th>
                                    <th>April-16-Soya</th>
                                    <th>April-17-Soya</th>
                                    <th>April-18-Soya</th>
                                    <th>April-19-Soya</th>
                                    <th>April-20-Soya</th>
                                    <th>April-21-Soya</th>
                                    <th>April-22-Soya</th>
                                    <th>April-23-Soya</th>
                                    <th>April-24-Soya</th>
                                    <th>April-25-Soya</th>
                                    <th>April-26-Soya</th>
                                    <th>April-27-Soya</th>
                                    <th>April-28-Soya</th>
                                    <th>April-29-Soya</th>
                                    <th>April-30-Soya</th>
                                    <th>April-Total-Soya</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($DailySalesSoya as $v) {
                                    $tot01 = $tot01 + $v['April-01-Soya'];
                                    $tot02 = $tot02 + $v['April-02-Soya'];
                                    $tot03 = $tot03 + $v['April-03-Soya'];
                                    $tot04 = $tot04 + $v['April-04-Soya'];
                                    $tot05 = $tot05 + $v['April-05-Soya'];
                                    $tot06 = $tot06 + $v['April-06-Soya'];
                                    $tot07 = $tot07 + $v['April-07-Soya'];
                                    $tot08 = $tot08 + $v['April-08-Soya'];
                                    $tot09 = $tot09 + $v['April-09-Soya'];
                                    $tot10 = $tot10 + $v['April-10-Soya'];
                                    $tot11 = $tot11 + $v['April-11-Soya'];
                                    $tot12 = $tot12 + $v['April-12-Soya'];
                                    $tot13 = $tot13 + $v['April-13-Soya'];
                                    $tot14 = $tot14 + $v['April-14-Soya'];
                                    $tot15 = $tot15 + $v['April-15-Soya'];
                                    $tot16 = $tot16 + $v['April-16-Soya'];
                                    $tot17 = $tot17 + $v['April-17-Soya'];
                                    $tot18 = $tot18 + $v['April-18-Soya'];
                                    $tot19 = $tot19 + $v['April-19-Soya'];
                                    $tot20 = $tot20 + $v['April-20-Soya'];
                                    $tot21 = $tot21 + $v['April-21-Soya'];
                                    $tot22 = $tot22 + $v['April-22-Soya'];
                                    $tot23 = $tot23 + $v['April-23-Soya'];
                                    $tot24 = $tot24 + $v['April-24-Soya'];
                                    $tot25 = $tot25 + $v['April-25-Soya'];
                                    $tot26 = $tot26 + $v['April-26-Soya'];
                                    $tot27 = $tot27 + $v['April-27-Soya'];
                                    $tot28 = $tot28 + $v['April-28-Soya'];
                                    $tot29 = $tot29 + $v['April-29-Soya'];
                                    $tot30 = $tot30 + $v['April-30-Soya'];
                                    $totF = $totF + $v['April-Total-Soya'];
                                    echo '<tr>'
                                    . '<td>' . $v['area_name'] . '</td>'
                                    . '<td>' . $v['ag_name'] . '</td>'
                                    . '<td>' . $v['ag_cd'] . '</td>'
                                    . '<td>' . $v['cd'] . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-01-Soya']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-02-Soya']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-03-Soya']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-04-Soya']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-05-Soya']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-06-Soya']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-07-Soya']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-08-Soya']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-09-Soya']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-10-Soya']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-11-Soya']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-12-Soya']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-13-Soya']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-14-Soya']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-15-Soya']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-16-Soya']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-17-Soya']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-18-Soya']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-19-Soya']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-20-Soya']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-21-Soya']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-22-Soya']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-23-Soya']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-24-Soya']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-25-Soya']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-26-Soya']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-27-Soya']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-28-Soya']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-29-Soya']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-30-Soya']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-Total-Soya']) . '</td>'
                                    . '</tr>';
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <?php
                                echo '<tr style="font-weight:bold;">'
                                . '<td colspan="4">Total</td>'
                                . '<td class="text-right">' . number_format($tot01) . '</td>'
                                . '<td class="text-right">' . number_format($tot02) . '</td>'
                                . '<td class="text-right">' . number_format($tot03) . '</td>'
                                . '<td class="text-right">' . number_format($tot04) . '</td>'
                                . '<td class="text-right">' . number_format($tot05) . '</td>'
                                . '<td class="text-right">' . number_format($tot06) . '</td>'
                                . '<td class="text-right">' . number_format($tot07) . '</td>'
                                . '<td class="text-right">' . number_format($tot08) . '</td>'
                                . '<td class="text-right">' . number_format($tot09) . '</td>'
                                . '<td class="text-right">' . number_format($tot10) . '</td>'
                                . '<td class="text-right">' . number_format($tot11) . '</td>'
                                . '<td class="text-right">' . number_format($tot12) . '</td>'
                                . '<td class="text-right">' . number_format($tot13) . '</td>'
                                . '<td class="text-right">' . number_format($tot14) . '</td>'
                                . '<td class="text-right">' . number_format($tot15) . '</td>'
                                . '<td class="text-right">' . number_format($tot16) . '</td>'
                                . '<td class="text-right">' . number_format($tot17) . '</td>'
                                . '<td class="text-right">' . number_format($tot18) . '</td>'
                                . '<td class="text-right">' . number_format($tot19) . '</td>'
                                . '<td class="text-right">' . number_format($tot20) . '</td>'
                                . '<td class="text-right">' . number_format($tot21) . '</td>'
                                . '<td class="text-right">' . number_format($tot22) . '</td>'
                                . '<td class="text-right">' . number_format($tot23) . '</td>'
                                . '<td class="text-right">' . number_format($tot24) . '</td>'
                                . '<td class="text-right">' . number_format($tot25) . '</td>'
                                . '<td class="text-right">' . number_format($tot26) . '</td>'
                                . '<td class="text-right">' . number_format($tot27) . '</td>'
                                . '<td class="text-right">' . number_format($tot28) . '</td>'
                                . '<td class="text-right">' . number_format($tot29) . '</td>'
                                . '<td class="text-right">' . number_format($tot30) . '</td>'
                                . '<td class="text-right">' . number_format($totF) . '</td>'
                                . '</tr>';
                                ?>
                            </tfoot>
                        </table>
                        <?php
                    }
                    ?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-xs-12">
                    <?php
                    if (!empty($DailySalesNenaposha) && isset($DailySalesNenaposha)) {
                        $tot01 = 0;
                        $tot02 = 0;
                        $tot03 = 0;
                        $tot04 = 0;
                        $tot05 = 0;
                        $tot06 = 0;
                        $tot07 = 0;
                        $tot08 = 0;
                        $tot09 = 0;
                        $tot10 = 0;
                        $tot11 = 0;
                        $tot12 = 0;
                        $tot13 = 0;
                        $tot14 = 0;
                        $tot15 = 0;
                        $tot16 = 0;
                        $tot17 = 0;
                        $tot18 = 0;
                        $tot19 = 0;
                        $tot20 = 0;
                        $tot21 = 0;
                        $tot22 = 0;
                        $tot23 = 0;
                        $tot24 = 0;
                        $tot25 = 0;
                        $tot26 = 0;
                        $tot27 = 0;
                        $tot28 = 0;
                        $tot29 = 0;
                        $tot30 = 0;
                        $totF = 0;
                        ?>
                        <h2>C Range Nenaposha Packet Achievement</h2>
                        <input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('attendance_table4', 'Nenaposha Packets Daily Sales April')" value="Download Excel"><br>
                        <table id="attendance_table4" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Area</th>
                                    <th>Territory</th>
                                    <th>Territory Code</th>
                                    <th>Range</th>
                                    <th>April-01-Nenaposha</th>
                                    <th>April-02-Nenaposha</th>
                                    <th>April-03-Nenaposha</th>
                                    <th>April-04-Nenaposha</th>
                                    <th>April-05-Nenaposha</th>
                                    <th>April-06-Nenaposha</th>
                                    <th>April-07-Nenaposha</th>
                                    <th>April-08-Nenaposha</th>
                                    <th>April-09-Nenaposha</th>
                                    <th>April-10-Nenaposha</th>
                                    <th>April-11-Nenaposha</th>
                                    <th>April-12-Nenaposha</th>
                                    <th>April-13-Nenaposha</th>
                                    <th>April-14-Nenaposha</th>
                                    <th>April-15-Nenaposha</th>
                                    <th>April-16-Nenaposha</th>
                                    <th>April-17-Nenaposha</th>
                                    <th>April-18-Nenaposha</th>
                                    <th>April-19-Nenaposha</th>
                                    <th>April-20-Nenaposha</th>
                                    <th>April-21-Nenaposha</th>
                                    <th>April-22-Nenaposha</th>
                                    <th>April-23-Nenaposha</th>
                                    <th>April-24-Nenaposha</th>
                                    <th>April-25-Nenaposha</th>
                                    <th>April-26-Nenaposha</th>
                                    <th>April-27-Nenaposha</th>
                                    <th>April-28-Nenaposha</th>
                                    <th>April-29-Nenaposha</th>
                                    <th>April-30-Nenaposha</th>
                                    <th>April-Total-Nenaposha</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($DailySalesNenaposha as $v) {
                                    $tot01 = $tot01 + $v['April-01-Nenaposha'];
                                    $tot02 = $tot02 + $v['April-02-Nenaposha'];
                                    $tot03 = $tot03 + $v['April-03-Nenaposha'];
                                    $tot04 = $tot04 + $v['April-04-Nenaposha'];
                                    $tot05 = $tot05 + $v['April-05-Nenaposha'];
                                    $tot06 = $tot06 + $v['April-06-Nenaposha'];
                                    $tot07 = $tot07 + $v['April-07-Nenaposha'];
                                    $tot08 = $tot08 + $v['April-08-Nenaposha'];
                                    $tot09 = $tot09 + $v['April-09-Nenaposha'];
                                    $tot10 = $tot10 + $v['April-10-Nenaposha'];
                                    $tot11 = $tot11 + $v['April-11-Nenaposha'];
                                    $tot12 = $tot12 + $v['April-12-Nenaposha'];
                                    $tot13 = $tot13 + $v['April-13-Nenaposha'];
                                    $tot14 = $tot14 + $v['April-14-Nenaposha'];
                                    $tot15 = $tot15 + $v['April-15-Nenaposha'];
                                    $tot16 = $tot16 + $v['April-16-Nenaposha'];
                                    $tot17 = $tot17 + $v['April-17-Nenaposha'];
                                    $tot18 = $tot18 + $v['April-18-Nenaposha'];
                                    $tot19 = $tot19 + $v['April-19-Nenaposha'];
                                    $tot20 = $tot20 + $v['April-20-Nenaposha'];
                                    $tot21 = $tot21 + $v['April-21-Nenaposha'];
                                    $tot22 = $tot22 + $v['April-22-Nenaposha'];
                                    $tot23 = $tot23 + $v['April-23-Nenaposha'];
                                    $tot24 = $tot24 + $v['April-24-Nenaposha'];
                                    $tot25 = $tot25 + $v['April-25-Nenaposha'];
                                    $tot26 = $tot26 + $v['April-26-Nenaposha'];
                                    $tot27 = $tot27 + $v['April-27-Nenaposha'];
                                    $tot28 = $tot28 + $v['April-28-Nenaposha'];
                                    $tot29 = $tot29 + $v['April-29-Nenaposha'];
                                    $tot30 = $tot30 + $v['April-30-Nenaposha'];
                                    $totF = $totF + $v['April-Total-Nenaposha'];
                                    echo '<tr>'
                                    . '<td>' . $v['area_name'] . '</td>'
                                    . '<td>' . $v['ag_name'] . '</td>'
                                    . '<td>' . $v['ag_cd'] . '</td>'
                                    . '<td>' . $v['cd'] . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-01-Nenaposha']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-02-Nenaposha']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-03-Nenaposha']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-04-Nenaposha']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-05-Nenaposha']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-06-Nenaposha']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-07-Nenaposha']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-08-Nenaposha']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-09-Nenaposha']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-10-Nenaposha']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-11-Nenaposha']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-12-Nenaposha']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-13-Nenaposha']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-14-Nenaposha']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-15-Nenaposha']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-16-Nenaposha']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-17-Nenaposha']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-18-Nenaposha']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-19-Nenaposha']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-20-Nenaposha']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-21-Nenaposha']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-22-Nenaposha']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-23-Nenaposha']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-24-Nenaposha']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-25-Nenaposha']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-26-Nenaposha']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-27-Nenaposha']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-28-Nenaposha']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-29-Nenaposha']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-30-Nenaposha']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-Total-Nenaposha']) . '</td>'
                                    . '</tr>';
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <?php
                                echo '<tr style="font-weight:bold;">'
                                . '<td colspan="4">Total</td>'
                                . '<td class="text-right">' . number_format($tot01) . '</td>'
                                . '<td class="text-right">' . number_format($tot02) . '</td>'
                                . '<td class="text-right">' . number_format($tot03) . '</td>'
                                . '<td class="text-right">' . number_format($tot04) . '</td>'
                                . '<td class="text-right">' . number_format($tot05) . '</td>'
                                . '<td class="text-right">' . number_format($tot06) . '</td>'
                                . '<td class="text-right">' . number_format($tot07) . '</td>'
                                . '<td class="text-right">' . number_format($tot08) . '</td>'
                                . '<td class="text-right">' . number_format($tot09) . '</td>'
                                . '<td class="text-right">' . number_format($tot10) . '</td>'
                                . '<td class="text-right">' . number_format($tot11) . '</td>'
                                . '<td class="text-right">' . number_format($tot12) . '</td>'
                                . '<td class="text-right">' . number_format($tot13) . '</td>'
                                . '<td class="text-right">' . number_format($tot14) . '</td>'
                                . '<td class="text-right">' . number_format($tot15) . '</td>'
                                . '<td class="text-right">' . number_format($tot16) . '</td>'
                                . '<td class="text-right">' . number_format($tot17) . '</td>'
                                . '<td class="text-right">' . number_format($tot18) . '</td>'
                                . '<td class="text-right">' . number_format($tot19) . '</td>'
                                . '<td class="text-right">' . number_format($tot20) . '</td>'
                                . '<td class="text-right">' . number_format($tot21) . '</td>'
                                . '<td class="text-right">' . number_format($tot22) . '</td>'
                                . '<td class="text-right">' . number_format($tot23) . '</td>'
                                . '<td class="text-right">' . number_format($tot24) . '</td>'
                                . '<td class="text-right">' . number_format($tot25) . '</td>'
                                . '<td class="text-right">' . number_format($tot26) . '</td>'
                                . '<td class="text-right">' . number_format($tot27) . '</td>'
                                . '<td class="text-right">' . number_format($tot28) . '</td>'
                                . '<td class="text-right">' . number_format($tot29) . '</td>'
                                . '<td class="text-right">' . number_format($tot30) . '</td>'
                                . '<td class="text-right">' . number_format($totF) . '</td>'
                                . '</tr>';
                                ?>
                            </tfoot>
                        </table>
                        <?php
                    }
                    ?>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12 col-xs-12">
                    <?php
                    if (!empty($DailySalesDB) && isset($DailySalesDB)) {
                        $tot01 = 0;
                        $tot02 = 0;
                        $tot03 = 0;
                        $tot04 = 0;
                        $tot05 = 0;
                        $tot06 = 0;
                        $tot07 = 0;
                        $tot08 = 0;
                        $tot09 = 0;
                        $tot10 = 0;
                        $tot11 = 0;
                        $tot12 = 0;
                        $tot13 = 0;
                        $tot14 = 0;
                        $tot15 = 0;
                        $tot16 = 0;
                        $tot17 = 0;
                        $tot18 = 0;
                        $tot19 = 0;
                        $tot20 = 0;
                        $tot21 = 0;
                        $tot22 = 0;
                        $tot23 = 0;
                        $tot24 = 0;
                        $tot25 = 0;
                        $tot26 = 0;
                        $tot27 = 0;
                        $tot28 = 0;
                        $tot29 = 0;
                        $tot30 = 0;
                        $totF = 0;
                        ?>
                        <h2>C Range Devani Batha Packet Achievement</h2>
                        <input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('attendance_table5', 'Devani Batha Packets Daily Sales April')" value="Download Excel"><br>
                        <table id="attendance_table5" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Area</th>
                                    <th>Territory</th>
                                    <th>Territory Code</th>
                                    <th>Range</th>
                                    <th>April-01-DB</th>
                                    <th>April-02-DB</th>
                                    <th>April-03-DB</th>
                                    <th>April-04-DB</th>
                                    <th>April-05-DB</th>
                                    <th>April-06-DB</th>
                                    <th>April-07-DB</th>
                                    <th>April-08-DB</th>
                                    <th>April-09-DB</th>
                                    <th>April-10-DB</th>
                                    <th>April-11-DB</th>
                                    <th>April-12-DB</th>
                                    <th>April-13-DB</th>
                                    <th>April-14-DB</th>
                                    <th>April-15-DB</th>
                                    <th>April-16-DB</th>
                                    <th>April-17-DB</th>
                                    <th>April-18-DB</th>
                                    <th>April-19-DB</th>
                                    <th>April-20-DB</th>
                                    <th>April-21-DB</th>
                                    <th>April-22-DB</th>
                                    <th>April-23-DB</th>
                                    <th>April-24-DB</th>
                                    <th>April-25-DB</th>
                                    <th>April-26-DB</th>
                                    <th>April-27-DB</th>
                                    <th>April-28-DB</th>
                                    <th>April-29-DB</th>
                                    <th>April-30-DB</th>
                                    <th>April-Total-DB</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($DailySalesDB as $v) {
                                    $tot01 = $tot01 + $v['April-01-db'];
                                    $tot02 = $tot02 + $v['April-02-db'];
                                    $tot03 = $tot03 + $v['April-03-db'];
                                    $tot04 = $tot04 + $v['April-04-db'];
                                    $tot05 = $tot05 + $v['April-05-db'];
                                    $tot06 = $tot06 + $v['April-06-db'];
                                    $tot07 = $tot07 + $v['April-07-db'];
                                    $tot08 = $tot08 + $v['April-08-db'];
                                    $tot09 = $tot09 + $v['April-09-db'];
                                    $tot10 = $tot10 + $v['April-10-db'];
                                    $tot11 = $tot11 + $v['April-11-db'];
                                    $tot12 = $tot12 + $v['April-12-db'];
                                    $tot13 = $tot13 + $v['April-13-db'];
                                    $tot14 = $tot14 + $v['April-14-db'];
                                    $tot15 = $tot15 + $v['April-15-db'];
                                    $tot16 = $tot16 + $v['April-16-db'];
                                    $tot17 = $tot17 + $v['April-17-db'];
                                    $tot18 = $tot18 + $v['April-18-db'];
                                    $tot19 = $tot19 + $v['April-19-db'];
                                    $tot20 = $tot20 + $v['April-20-db'];
                                    $tot21 = $tot21 + $v['April-21-db'];
                                    $tot22 = $tot22 + $v['April-22-db'];
                                    $tot23 = $tot23 + $v['April-23-db'];
                                    $tot24 = $tot24 + $v['April-24-db'];
                                    $tot25 = $tot25 + $v['April-25-db'];
                                    $tot26 = $tot26 + $v['April-26-db'];
                                    $tot27 = $tot27 + $v['April-27-db'];
                                    $tot28 = $tot28 + $v['April-28-db'];
                                    $tot29 = $tot29 + $v['April-29-db'];
                                    $tot30 = $tot30 + $v['April-30-db'];
                                    $totF = $totF + $v['April-Total-db'];
                                    echo '<tr>'
                                    . '<td>' . $v['area_name'] . '</td>'
                                    . '<td>' . $v['ag_name'] . '</td>'
                                    . '<td>' . $v['ag_cd'] . '</td>'
                                    . '<td>' . $v['cd'] . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-01-db']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-02-db']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-03-db']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-04-db']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-05-db']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-06-db']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-07-db']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-08-db']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-09-db']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-10-db']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-11-db']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-12-db']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-13-db']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-14-db']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-15-db']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-16-db']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-17-db']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-18-db']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-19-db']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-20-db']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-21-db']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-22-db']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-23-db']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-24-db']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-25-db']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-26-db']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-27-db']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-28-db']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-29-db']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-30-db']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-Total-db']) . '</td>'
                                    . '</tr>';
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <?php
                                echo '<tr style="font-weight:bold;">'
                                . '<td colspan="4">Total</td>'
                                . '<td class="text-right">' . number_format($tot01) . '</td>'
                                . '<td class="text-right">' . number_format($tot02) . '</td>'
                                . '<td class="text-right">' . number_format($tot03) . '</td>'
                                . '<td class="text-right">' . number_format($tot04) . '</td>'
                                . '<td class="text-right">' . number_format($tot05) . '</td>'
                                . '<td class="text-right">' . number_format($tot06) . '</td>'
                                . '<td class="text-right">' . number_format($tot07) . '</td>'
                                . '<td class="text-right">' . number_format($tot08) . '</td>'
                                . '<td class="text-right">' . number_format($tot09) . '</td>'
                                . '<td class="text-right">' . number_format($tot10) . '</td>'
                                . '<td class="text-right">' . number_format($tot11) . '</td>'
                                . '<td class="text-right">' . number_format($tot12) . '</td>'
                                . '<td class="text-right">' . number_format($tot13) . '</td>'
                                . '<td class="text-right">' . number_format($tot14) . '</td>'
                                . '<td class="text-right">' . number_format($tot15) . '</td>'
                                . '<td class="text-right">' . number_format($tot16) . '</td>'
                                . '<td class="text-right">' . number_format($tot17) . '</td>'
                                . '<td class="text-right">' . number_format($tot18) . '</td>'
                                . '<td class="text-right">' . number_format($tot19) . '</td>'
                                . '<td class="text-right">' . number_format($tot20) . '</td>'
                                . '<td class="text-right">' . number_format($tot21) . '</td>'
                                . '<td class="text-right">' . number_format($tot22) . '</td>'
                                . '<td class="text-right">' . number_format($tot23) . '</td>'
                                . '<td class="text-right">' . number_format($tot24) . '</td>'
                                . '<td class="text-right">' . number_format($tot25) . '</td>'
                                . '<td class="text-right">' . number_format($tot26) . '</td>'
                                . '<td class="text-right">' . number_format($tot27) . '</td>'
                                . '<td class="text-right">' . number_format($tot28) . '</td>'
                                . '<td class="text-right">' . number_format($tot29) . '</td>'
                                . '<td class="text-right">' . number_format($tot30) . '</td>'
                                . '<td class="text-right">' . number_format($totF) . '</td>'
                                . '</tr>';
                                ?>
                            </tfoot>
                        </table>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>



    </section>
</div>

<!-- /.content -->
</div><!-- /.content-wrapper -->
<script type="text/javascript" src="https://adminlte.io/themes/AdminLTE/bower_components/raphael/raphael.min.js"></script>
<script type="text/javascript" src="https://adminlte.io/themes/AdminLTE/bower_components/morris.js/morris.min.js"></script>

<script>
                        function setCategory(id) {
                            $('#category').val(id);
                            document.getElementById("myForm").submit();
                        }



                        const tables = document.querySelectorAll('table');
                        for (let table of tables) {
                            let headerCell = null;
                            for (let row of table.rows) {
                                const firstCell = row.cells[0];
                                firstCell.style.backgroundColor = "yellow";
                                firstCell.style.verticalAlign = "middle";
                                firstCell.style.fontSize = "20px";
                                firstCell.style.fontWeight = "bold";

                                if (headerCell === null || firstCell.innerText !== headerCell.innerText) {
                                    headerCell = firstCell;
                                } else {
                                    headerCell.rowSpan++;
                                    firstCell.remove();
                                }
                            }
                        }
// LINE CHART
                        var line = new Morris.Line({
                            element: 'line-chart',
                            resize: true,
                            data: [
                                {y: '2011 Q1', item1: 2666, item2: 2323},
                                {y: '2011 Q2', item1: 2778, item2: 2323},
                                {y: '2011 Q3', item1: 4912, item2: 2323},
                                {y: '2011 Q4', item1: 3767, item2: 2323},
                                {y: '2012 Q1', item1: 6810, item2: 2323},
                                {y: '2012 Q2', item1: 5670, item2: 2323},
                                {y: '2012 Q3', item1: 4820, item2: 2323},
                                {y: '2012 Q4', item1: 15073, item2: 2323},
                                {y: '2013 Q1', item1: 10687, item2: 2323},
                                {y: '2013 Q2', item1: 8432, item2: 2323}
                            ],
                            xkey: 'y',
                            ykeys: ['item1', 'item2'],
                            labels: ['Ítem1', 'Ítem2'],
                            lineColors: ['#3c8dbc'],
                            hideHover: 'auto'
                        });

                        // LINE CHART
                        var line = new Morris.Line({
                            element: 'line-charta',
                            resize: true,
                            data: [
<?php
$yKey = '';
/*
  for ($k = 1; $k <= 6; $k++) {
  $monthNumberBack = date('m', strtotime($datepickermonth . ' -' . $k . ' month'));
  $monthNameBack = date('F', strtotime($datepickermonth . ' -' . $k . ' month'));
  $YearNameBack = date('Y', strtotime($datepickermonth . ' -' . $k . ' month'));
  $line = '{y: \'' . $YearNameBack . ' ' . $monthNameBack . '\' ';
  if (!empty($getTotalSalesandPc) && isset($getTotalSalesandPc)) {
  foreach ($DailySales as $v) {
  $yKey .= '\'' . $v['ag_name'] . '\',';
  foreach ($getTotalSalesandPc as $p) {
  if ($v['ag_cd'] === $p['ag_cd']) {
  $line .= ' ,\'' . $v['ag_name'] . '\': ' . number_format($p[$monthNameBack . '_TotPC'] / $p[$monthNameBack . '_WD'], 1) . ',';
  }
  }
  }
  $line .= '},';
  }
  //echo $line;
  }
 */
?>
                                /*{y: '2011 Q1', item1: 2666},
                                 {y: '2011 Q2', item1: 2778},
                                 {y: '2011 Q3', item1: 4912},
                                 {y: '2011 Q4', item1: 3767},
                                 {y: '2012 Q1', item1: 6810},
                                 {y: '2012 Q2', item1: 5670},
                                 {y: '2012 Q3', item1: 4820},
                                 {y: '2012 Q4', item1: 15073},
                                 {y: '2013 Q1', item1: 10687},
                                 {y: '2013 Q2', item1: 8432}*/
                            ],
                            xkey: 'y',
                            ykeys: [<?= $yKey ?>],
                            labels: [<?= $yKey ?>],
                            lineColors: ['#3c8dbc'],
                            hideHover: 'auto'
                        });

</script>