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
        /*z-index: 1;*/
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
            Area Achievement and Category Sales Dashboard
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
                        <h3 style="font-size: 30px;">Total Sales</h3>
                        <p>Click to view Sales Dashboard</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="<?= base_url('welcome/sales') ?>" class="small-box-footer">Click here <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-12">
                <div class="small-box bg-maroon">
                    <div class="inner">
                        <h3 style="font-size: 30px;">Heart Count</h3>
                        <p>Click to view Sales Dashboard</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-heart"></i>
                    </div>
                    <a href="<?= base_url('Itemreports/getHardCount') ?>" class="small-box-footer">Click here <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-12">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3 style="font-size: 30px;">App Bookings</h3>
                        <p>Click to view Sales Dashboard</p>
                    </div>
                    <div class="icon">
                        <i class="ion hand-peace-o"></i>
                    </div>
                    <a href="<?= base_url('BookingSale/homeReport') ?>" class="small-box-footer">Click here <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-12">
                <div class="small-box bg-olive">
                    <div class="inner">
                        <h3 style="font-size: 30px;">Booking Vs Actual</h3>
                        <p>Click to view Sales Dashboard</p>
                    </div>
                    <div class="icon">
                        <i class="ion hand-peace-o"></i>
                    </div>
                    <a href="<?= base_url('bookingAgainstActualController/bookingAgainstActual') ?>" class="small-box-footer">Click here <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">  
                <form class="form-horizontal" id="myForm" action="<?= base_url('welcome/homeReport') ?>" method="post">
                     <?php 

                // if ($sess['username']=='lakshitha'){
                    ?>
                 <!-- <input type="hidden" value="1" name="variable1"/>    -->
                    <?php
                // }else{
                    ?>
                 <!-- <input type="hidden" value="0" name="variable1"/>    -->
                    <?php
                // }

                    ?>
                    <div class="col-md-3">                            
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
                    <div class="col-md-3">                            
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
                     <div class="col-md-3">                            
                        <div class="form-group">
                            <label class="col-md-4">Type <span class="text-red">*</span></label>
                            <div class="col-md-6">
                                <select id="saleType" name="saleType" class="form-control">
                                    <option value="A"> Actual</option>    
                                    <option value="B"> Booking</option>    
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <?php
                        if (!empty($CategoryList) && isset($CategoryList)) {
                            foreach ($CategoryList as $cat) {
                                echo '<div class="col-md-3 cat-box ' . $cat['ranges'] . '">
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
                <h2>This report is under developments</h2>
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
                        //AREA TOTAL
                        $tot01_area = 0;
                        $tot02_area = 0;
                        $tot03_area = 0;
                        $tot04_area = 0;
                        $tot05_area = 0;
                        $tot06_area = 0;
                        $tot07_area = 0;
                        $tot08_area = 0;
                        $tot09_area = 0;
                        $tot10_area = 0;
                        $tot11_area = 0;
                        $tot12_area = 0;
                        $tot13_area = 0;
                        $tot14_area = 0;
                        $tot15_area = 0;
                        $tot16_area = 0;
                        $tot17_area = 0;
                        $tot18_area = 0;
                        $tot19_area = 0;
                        $tot20_area = 0;
                        $tot21_area = 0;
                        $tot22_area = 0;
                        $tot23_area = 0;
                        $tot24_area = 0;
                        $tot25_area = 0;
                        $tot26_area = 0;
                        $tot27_area = 0;
                        $tot28_area = 0;
                        $tot29_area = 0;
                        $tot30_area = 0;
                        $tot31_area = 0;

                        $tot01_pc_area = 0;
                        $tot02_pc_area = 0;
                        $tot03_pc_area = 0;
                        $tot04_pc_area = 0;
                        $tot05_pc_area = 0;
                        $tot06_pc_area = 0;
                        $tot07_pc_area = 0;
                        $tot08_pc_area = 0;
                        $tot09_pc_area = 0;
                        $tot10_pc_area = 0;
                        $tot11_pc_area = 0;
                        $tot12_pc_area = 0;
                        $tot13_pc_area = 0;
                        $tot14_pc_area = 0;
                        $tot15_pc_area = 0;
                        $tot16_pc_area = 0;
                        $tot17_pc_area = 0;
                        $tot18_pc_area = 0;
                        $tot19_pc_area = 0;
                        $tot20_pc_area = 0;
                        $tot21_pc_area = 0;
                        $tot22_pc_area = 0;
                        $tot23_pc_area = 0;
                        $tot24_pc_area = 0;
                        $tot25_pc_area = 0;
                        $tot26_pc_area = 0;
                        $tot27_pc_area = 0;
                        $tot28_pc_area = 0;
                        $tot29_pc_area = 0;
                        $tot30_pc_area = 0;
                        $tot31_pc_area = 0;

                        //REGION TOTALS
                        //AREA TOTAL
                        $tot01_region = 0;
                        $tot02_region = 0;
                        $tot03_region = 0;
                        $tot04_region = 0;
                        $tot05_region = 0;
                        $tot06_region = 0;
                        $tot07_region = 0;
                        $tot08_region = 0;
                        $tot09_region = 0;
                        $tot10_region = 0;
                        $tot11_region = 0;
                        $tot12_region = 0;
                        $tot13_region = 0;
                        $tot14_region = 0;
                        $tot15_region = 0;
                        $tot16_region = 0;
                        $tot17_region = 0;
                        $tot18_region = 0;
                        $tot19_region = 0;
                        $tot20_region = 0;
                        $tot21_region = 0;
                        $tot22_region = 0;
                        $tot23_region = 0;
                        $tot24_region = 0;
                        $tot25_region = 0;
                        $tot26_region = 0;
                        $tot27_region = 0;
                        $tot28_region = 0;
                        $tot29_region = 0;
                        $tot30_region = 0;
                        $tot31_region = 0;

                        $tot01_pc_region = 0;
                        $tot02_pc_region = 0;
                        $tot03_pc_region = 0;
                        $tot04_pc_region = 0;
                        $tot05_pc_region = 0;
                        $tot06_pc_region = 0;
                        $tot07_pc_region = 0;
                        $tot08_pc_region = 0;
                        $tot09_pc_region = 0;
                        $tot10_pc_region = 0;
                        $tot11_pc_region = 0;
                        $tot12_pc_region = 0;
                        $tot13_pc_region = 0;
                        $tot14_pc_region = 0;
                        $tot15_pc_region = 0;
                        $tot16_pc_region = 0;
                        $tot17_pc_region = 0;
                        $tot18_pc_region = 0;
                        $tot19_pc_region = 0;
                        $tot20_pc_region = 0;
                        $tot21_pc_region = 0;
                        $tot22_pc_region = 0;
                        $tot23_pc_region = 0;
                        $tot24_pc_region = 0;
                        $tot25_pc_region = 0;
                        $tot26_pc_region = 0;
                        $tot27_pc_region = 0;
                        $tot28_pc_region = 0;
                        $tot29_pc_region = 0;
                        $tot30_pc_region = 0;
                        $tot31_pc_region = 0;
                        //
                        //Total Full
                        $tot01_v = 0;
                        $tot02_v = 0;
                        $tot03_v = 0;
                        $tot04_v = 0;
                        $tot05_v = 0;
                        $tot06_v = 0;
                        $tot07_v = 0;
                        $tot08_v = 0;
                        $tot09_v = 0;
                        $tot10_v = 0;
                        $tot11_v = 0;
                        $tot12_v = 0;
                        $tot13_v = 0;
                        $tot14_v = 0;
                        $tot15_v = 0;
                        $tot16_v = 0;
                        $tot17_v = 0;
                        $tot18_v = 0;
                        $tot19_v = 0;
                        $tot20_v = 0;
                        $tot21_v = 0;
                        $tot22_v = 0;
                        $tot23_v = 0;
                        $tot24_v = 0;
                        $tot25_v = 0;
                        $tot26_v = 0;
                        $tot27_v = 0;
                        $tot28_v = 0;
                        $tot29_v = 0;
                        $tot30_v = 0;
                        $tot31_v = 0;

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
                            $strDayColValPC .= '<th>' . sprintf("%02d", $n) . ' Value</th><th style="background: #efebb9;">' . sprintf("%02d", $n) . ' PC</th>';
                        }
                        //echo $strDayCol;
                        $strBack = '';
                        for ($k = 1; $k <= 6; $k++) {
                            $monthNumberBack = date('m', strtotime($datepickermonth . ' -' . $k . ' month'));
                            $monthNameBack = date('F', strtotime($datepickermonth . ' -' . $k . ' month'));
                            $strBack .= '<th style="background: #000000 !important; color: #fff; text-align: center;">' . $monthNameBack . '-Total</th><th>' . $monthNameBack . '- Avg PC</th><!-- <th>' . $monthNameBack . '- PC</th> --><th>' . $monthNameBack . '- WD</th>';
                            ${'totF' . $k} = 0;
                            ${'totWD' . $k} = 0;
                            ${'totPC' . $k} = 0;

                            ${'totFArea' . $k} = 0;
                            ${'totWDArea' . $k} = 0;
                            ${'totPCArea' . $k} = 0;
                        }

                        $reportType='Actual';
                        if($saleType=='B'){
                            $reportType='Booking';
                        }
                        ?>
                        <h2>Total <?= $reportType ?> Achievement Value with PC <?php
                            $catN = '';
                            if (!empty($categoryLineData) && isset($categoryLineData)) {
                                echo $catN = ' - ' . $categoryLineData->name;
                            }
                            ?></h2>
                        <h3>Total Working Days: <?= $totWorkingDays ?> / Expected Working Days As at: <?= $totExpectedWorkingDays ?></h3>
                        <small>Today is ignored from expected working day count. </small>
                        <input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('attendance_table', 'Daily Sales <?= $monthName . $catN ?>')" value="Download Excel"><br>
                        <table id="attendance_table" class="table table-hover presentation">
                            <thead>
                                <tr>
                                    <th class="fix"></th> 
                                    <th class="fix"></th> 
                                    <th class="fix"></th> 
                                    <th class="fix"></th> 
                                    <th class="fix"></th> 
                                    <?= $strDayColWithPC ?> 
                                    <th class="fix" colspan="9" style="text-align: center;"><?= $monthName ?>-Total</th>
                                    <th class="fix" colspan="24" style="background: #000000 !important; color: #fff; text-align: center;">Past Figures</th>
                                </tr>
                                <tr>
                                    <th>Region Name</th> 
                                    <th>Area</th>
                                    <th>Territory</th>
                                    <th>Territory Code</th>
                                    <th>Range</th>
                                    <?= $strDayColValPC ?> 
                                    <th>Target</th>
                                    <th><?= $monthName ?>-Total</th> 
                                    <th>Variance - Cum Target vs</th> 
                                    <th><!-- Target vs  Cum With Dir. -->Sale (%)</th> 
                                    <th>WD</th> 
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
                                $totActualWorkingDays = 0;
                                $totTarget = 0;
                                $totVarienceValue = 0;
                                //FOR AREA SUMMERY
                                $areaNameCurrent = '';
                                $currentRow = 0;
                                $areaFinalTotal = 0;
                                $AreaTotal = 0;
                                $AreatotF = 0;
                                $AreatotVarienceValue = 0;
                                $AreatotWorkingDayVarience = 0;
                                $AreatotCurrentWorkingDays = 0;
                                $AreatotPcF = 0;
                                $AreastrRowFootWithPC = '';

                                $strBackFootArea = '';
                                $strBackFootRegion = '';

                                $region_name_current = '';
                                $region_name_to_display = '';
                                $RegionstrRowFootWithPC = '';
                                $RegionTotal = 0; //region total target
                                $RegiontotF = 0;
                                $RegiontotVarienceValue = 0;
                                $RegiontotCurrentWorkingDays = 0;
                                $RegiontotWorkingDayVarience = 0;
                                $RegiontotPcF = 0;
                                $strTest = '';

                                for ($k = 1; $k <= 6; $k++) {
                                    ${'totFRegion' . $k} = 0;
                                    ${'totPCRegion' . $k} = 0;
                                    ${'totWDRegion' . $k} = 0;
                                }

                                $strRowFootWithPC = '';
                                foreach ($DailySales as $v) {
                                    if ($currentRow == 0) {//we are in first row
                                        $areaNameCurrent = $v['area_name'];
                                        $region_name_to_display = $region_name_current = $v['region_name'];
                                    }

                                    $currentRow = $currentRow + 1;

                                    $rowTotPc = 0;
                                    $strRow = '';
                                    $strRowWithPc = '';
                                    $strRowFoot = '';
                                    $max = 0;
                                    for ($n = 1; $n <= date('t', strtotime($datepickermonth)); $n++) {
                                        $territoryWithSaleCount = 0;
                                        $max = $n;

                                        ${'tot' . sprintf("%02d", $n) . '_v'} = ${'tot' . sprintf("%02d", $n) . '_v'} + $v[$monthName . '-' . $n];
                                        ${'tot' . sprintf("%02d", $n) . '_pc'} = ${'tot' . sprintf("%02d", $n) . '_pc'} + $v[$monthName . '-' . $n . '-pc'];

                                        if ($areaNameCurrent == $v['area_name']) {//we are in same area
                                            //AREA TOTAL
                                            ${'tot' . sprintf("%02d", $n) . '_area'} = ${'tot' . sprintf("%02d", $n) . '_area'} + $v[$monthName . '-' . $n];
                                            ${'tot' . sprintf("%02d", $n) . '_pc_area'} = ${'tot' . sprintf("%02d", $n) . '_pc_area'} + $v[$monthName . '-' . $n . '-pc'];
                                        }

                                        if ($region_name_current == $v['region_name']) {
                                            $strTest .= $v['ag_name'];
                                            ${'tot' . sprintf("%02d", $n) . '_region'} = ${'tot' . sprintf("%02d", $n) . '_region'} + $v[$monthName . '-' . $n];
                                            ${'tot' . sprintf("%02d", $n) . '_pc_region'} = ${'tot' . sprintf("%02d", $n) . '_pc_region'} + $v[$monthName . '-' . $n . '-pc'];
                                        }


                                        $strRow .= '<td class="text-right">' . number_format($v[$monthName . '-' . $n]) . '</td>';
                                        if ($v[$monthName . '-' . $n] != 0) {
                                            $strRowWithPc .= '<td class="text-right">' . number_format($v[$monthName . '-' . $n]) . '</td>'
                                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($v[$monthName . '-' . $n . '-pc']) . '</td>';
                                        } else {
                                            $strRowWithPc .= '<td class="text-right">-</td>'
                                                    . '<td class="text-right" style="background: #efebb9;">-</td>';
                                        }
                                        $strRowFoot .= '<td class="text-right">' . number_format(${'tot' . sprintf("%02d", $n) . '_v'}) . '</td>';

                                        //$strRowFootWithPC .= '<td class="text-right">' . number_format(${'tot' . sprintf("%02d", $n)}) . '</td>'
                                        //        . '<td class="text-right" style="background: #efebb9;">' . number_format(${'tot' . sprintf("%02d", $n) . '_pc'}) . '</td>';
                                        //$AreastrRowFootWithPC .= '<td class="text-right">' . number_format(${'tot' . sprintf("%02d", $n . '_area')}) . '</td>'
                                        //        . '<td class="text-right" style="background: #efebb9;">' . number_format(${'tot' . sprintf("%02d", $n) . '_pc' . '_area'}) . '</td>';  //AREA SUMMERY
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
                                    if ($areaNameCurrent == $v['area_name']) {//we are in same area
                                        //AREA TOTAL
                                        $AreatotCurrentWorkingDays = $AreatotCurrentWorkingDays + $actual_working_count; //AREA TOTAL
                                    }
                                    if ($region_name_current == $v['region_name']) {
                                        $RegiontotCurrentWorkingDays = $RegiontotCurrentWorkingDays + $actual_working_count;
                                    }

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
                                    if ($areaNameCurrent == $v['area_name']) {//we are in same area
                                        //AREA TOTAL
                                        $AreatotWorkingDayVarience = $AreatotWorkingDayVarience + $workingDayVarience; //AREA TOTAL
                                    }

                                    if ($region_name_current == $v['region_name']) {
                                        $RegiontotWorkingDayVarience = $RegiontotWorkingDayVarience + $workingDayVarience;
                                    }

                                    $avgSale = 0;
                                    if ($actual_working_count == 0) {
                                        $avgSale = 'NA';
                                    } else {
                                        $avgSale = number_format($v[$monthName . '-Total'] / $actual_working_count);
                                    }

                                    $totTarget = $totTarget + $targetVal;
                                    if ($areaNameCurrent == $v['area_name']) {//we are in same area
                                        //AREA TOTAL
                                        $AreaTotal = $AreaTotal + $targetVal; //area total Target
                                    }
                                    if ($region_name_current == $v['region_name']) {
                                        $RegionTotal = $RegionTotal + $targetVal;
                                    }

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
                                                        /*
                                                          if ($totWDdays == 0) {
                                                          $OldMonthAvgPC = '<td>NA</td><td>' . $p[$monthNameBack . '_TotPC'] . '</td><td>' . $totWDdays . '</td>';
                                                          } else {
                                                          $OldMonthAvgPC = '<td>' . number_format($p[$monthNameBack . '_TotPC'] / $totWDdays, 1) . '</td><td>' . $p[$monthNameBack . '_TotPC'] . '</td><td>' . $totWDdays . '</td>';
                                                          }
                                                         */
                                                        if ($totWDdays == 0) {
                                                            $OldMonthAvgPC = '<td>NA</td><!-- <td>' . $p[$monthNameBack . '_TotPC'] . '</td> --> <td>' . $totWDdays . '</td>';
                                                        } else {
                                                            $OldMonthAvgPC = '<td>' . number_format($p[$monthNameBack . '_TotPC'] / $totWDdays, 1) . '</td><!-- <td>' . $p[$monthNameBack . '_TotPC'] . '</td> --> <td>' . $totWDdays . '</td>';
                                                        }
                                                    }
                                                }
                                            }
                                        } else {
                                            if (!empty($getTotalSalesandPc) && isset($getTotalSalesandPc)) {
                                                foreach ($getTotalSalesandPc as $p) {
                                                    if ($v['ag_cd'] === $p['ag_cd']) {
                                                        if ($p[$monthNameBack . '_WD'] == 0) {
                                                            //$OldMonthAvgPC = '<td>NA</td>  <td>' . $p[$monthNameBack . '_TotPC'] . '</td> <td>' . $p[$monthNameBack . '_WD'] . '</td>';
                                                            $OldMonthAvgPC = '<td>NA</td> <!-- <td>' . $p[$monthNameBack . '_TotPC'] . '</td> --> <td>' . $p[$monthNameBack . '_WD'] . '</td>';
                                                        } else {
                                                            //$OldMonthAvgPC = '<td>' . number_format($p[$monthNameBack . '_TotPC'] / $p[$monthNameBack . '_WD'], 1) . 'zzzzzzzzzzzzzzzzzzzzz</td> <!-- <td>' . $p[$monthNameBack . '_TotPC'] . '</td> --> <td>' . $p[$monthNameBack . '_WD'] . '</td>';
                                                            $OldMonthAvgPC = '<td>' . number_format($p[$monthNameBack . '_TotPC'] / $p[$monthNameBack . '_WD'], 1) . '</td> <!-- <td>' . $p[$monthNameBack . '_TotPC'] . '</td> --> <td>' . $p[$monthNameBack . '_WD'] . '</td>';
                                                        }
                                                        ${'totPC' . $k} = ${'totPC' . $k} + $p[$monthNameBack . '_TotPC'];
                                                        ${'totWD' . $k} = ${'totWD' . $k} + $p[$monthNameBack . '_WD'];
                                                        if ($areaNameCurrent == $v['area_name']) {//we are in same area                                                            
                                                            ${'totWDArea' . $k} = ${'totWDArea' . $k} + $p[$monthNameBack . '_WD'];
                                                            ${'totPCArea' . $k} = ${'totPCArea' . $k} + $p[$monthNameBack . '_TotPC'];
                                                        } else {
                                                            
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                        $strBackValues .= $OldMonthAvgPC;
                                        ${'totF' . $k} = ${'totF' . $k} + $v[$monthNameBack . '-Total'];
                                        //Final Total    
                                        if (${'totWD' . $k} == 0) {
                                            $strBackFoot .= '<td class="text-right">' . number_format(${'totF' . $k}) . '</td><td>NA</td><!-- <td>' . number_format(${'totPC' . $k}) . '</td> --><td>' . number_format(${'totWD' . $k}) . '</td>';
                                        } else {
                                            $strBackFoot .= '<td class="text-right">' . number_format(${'totF' . $k}) . '</td><td>' . number_format(${'totPC' . $k} / ${'totWD' . $k}, 1) . '</td><!-- <td>' . number_format(${'totPC' . $k}) . '</td> --><td>' . number_format(${'totWD' . $k}) . '</td>';
                                        }
                                        if ($areaNameCurrent == $v['area_name']) {//we are in same area
                                            //AREA TOTAL
                                            ${'totFArea' . $k} = ${'totFArea' . $k} + $v[$monthNameBack . '-Total'];
                                        }
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

                                    if ($areaNameCurrent == $v['area_name']) {//we are in same area
                                        //AREA TOTAL
                                        $AreatotVarienceValue = $AreatotVarienceValue + $varienceValue; //AREA TOTAL
                                    }
                                    if ($region_name_current == $v['region_name']) {
                                        $RegiontotVarienceValue = $RegiontotVarienceValue + $varienceValue;
                                    }

                                    $totF = $totF + $v[$monthName . '-Total'];

                                    if ($areaNameCurrent == $v['area_name']) {//we are in same area
                                        //AREA TOTAL
                                        $AreatotF = $AreatotF + $v[$monthName . '-Total'];
                                    }
                                    if ($region_name_current == $v['region_name']) {
                                        $RegiontotF = $RegiontotF + $v[$monthName . '-Total'];
                                    }

                                    $totPcF = $totPcF + $rowTotPc;
                                    if ($areaNameCurrent == $v['area_name']) {//we are in same area
                                        //AREA TOTAL
                                        $AreatotPcF = $AreatotPcF + $rowTotPc; //AREA TOTAL
                                    }
                                    if ($region_name_current == $v['region_name']) {
                                        $RegiontotPcF = $RegiontotPcF + $rowTotPc; //AREA TOTAL
                                    }
//PRINT AREA TOTAL AT THE END
                                    if ($areaNameCurrent == $v['area_name']) {//we are in same area
                                    } else {
                                        if (!empty($AreaID) && isset($AreaID) && $AreaID == '-1') {//all island report requested
                                            for ($n = 1; $n <= date('t', strtotime($datepickermonth)); $n++) {
                                                /*
                                                  $AreastrRowFootWithPC .= '<td class="text-right">' . number_format(${'tot' . sprintf("%02d", $n) . '_area'}) . '</td>'
                                                  . '<td class="text-right" style="background: #efebb9;">' . number_format(${'tot' . sprintf("%02d", $n) . '_pc_area'}) . '</td>';  //AREA SUMMERY
                                                 */
                                                $AreastrRowFootWithPC .= '<td class="text-right">' . number_format(${'tot' . sprintf("%02d", $n) . '_area'}) . '</td>'
                                                        . '<td class="text-right" style="background: #efebb9;">-</td>';  //AREA SUMMERY
                                                ///RESET VALUES OF AREA TO NEW AREA
                                                ${'tot' . sprintf("%02d", $n) . '_area'} = $v[$monthName . '-' . $n];
                                                ${'tot' . sprintf("%02d", $n) . '_pc_area'} = $v[$monthName . '-' . $n . '-pc'];
                                            }
                                            $PP = 'target not set';
                                            if ($AreaTotal != 0) {
                                                $PP = number_format(($AreatotF / $AreaTotal) * 100);
                                            }
                                            $rname = '';
                                            if ($region_name_current != $v['region_name']) {//to print a new region but total lines are in old region
                                                $rname = $region_name_current;
                                            } else {
                                                $rname = $v['region_name'];
                                            }
                                            $avgVal = 0;
                                            $avgPC = 0;
                                            if ($AreatotCurrentWorkingDays != 0) {
                                                $avgVal = number_format($AreatotF / $AreatotCurrentWorkingDays);
                                                $avgPC = number_format($AreatotPcF / $AreatotCurrentWorkingDays, 1);
                                            } else {
                                                $avgPC = $avgVal = 'NA';
                                            }
                                            for ($k = 1; $k <= 6; $k++) {
                                                if (${'totWDArea' . $k} == 0) {
                                                    $strBackFootArea .= '<td class="text-right">' . number_format(${'totFArea' . $k}) . '</td><td>NA</td><!-- <td>' . number_format(${'totPCArea' . $k}) . '</td> --><td>' . number_format(${'totWDArea' . $k}) . '</td>';
                                                } else {
                                                    $strBackFootArea .= '<td class="text-right">' . number_format(${'totFArea' . $k}) . '</td><td>' . number_format(${'totPCArea' . $k} / ${'totWDArea' . $k}, 1) . '</td><!-- <td>' . number_format(${'totPCArea' . $k}) . '</td> --><td>' . number_format(${'totWDArea' . $k}) . '</td>';
                                                }
                                                if ($region_name_current == $v['region_name']) {
                                                    ${'totFRegion' . $k} = ${'totFRegion' . $k} + ${'totFArea' . $k};
                                                    ${'totPCRegion' . $k} = ${'totPCRegion' . $k} + ${'totPCArea' . $k};
                                                    ${'totWDRegion' . $k} = ${'totWDRegion' . $k} + ${'totWDArea' . $k};
                                                }
                                                ${'totFArea' . $k} = 0;
                                            }
                                            echo '<tr style="font-weight:bold;">'
                                            . '<td class="sticky-col first-col" >' . $rname . '</td>'
                                            . '<td class="sticky-col first-col" >' . $areaNameCurrent . '</td>'
                                            . '<td class="sticky-col first-col" >Total</td>'
                                            . '<td></td>'
                                            . '<td></td>'
                                            . $AreastrRowFootWithPC
                                            . '<td>' . number_format($AreaTotal) . '</td>'
                                            . '<td class="text-right" style="font-weight:bold;">' . number_format($AreatotF) . '</td>'
                                            . '<td>' . ((($AreatotVarienceValue) < 0 ? "(" . number_format(abs($AreatotVarienceValue)) . ")" : number_format($AreatotVarienceValue))) . '</td>'
                                            . '<td>' . ($PP) . '%</td>'
                                            . '<td>' . $AreatotCurrentWorkingDays . '</td>'
                                            . '<td>' . ((($AreatotWorkingDayVarience) < 0 ? "(" . number_format(abs($AreatotWorkingDayVarience)) . ")" : number_format($AreatotWorkingDayVarience))) . '</td>'
                                            . '<td>' . $avgVal . '</td>'
                                            . '<td>' . $avgPC . '</td>'
                                            . '<td class="text-right" style="background: #efebb9;font-weight:bold;">' . number_format($AreatotPcF) . '</td>'
                                            . $strBackFootArea
                                            . '</tr>';
                                            $areaNameCurrent = $v['area_name'];
                                            $AreatotF = $v[$monthName . '-Total'];
                                            $AreaTotal = $targetVal; //area total Target
                                            $AreatotPcF = $rowTotPc;
                                            $AreatotVarienceValue = $varienceValue;
                                            $AreastrRowFootWithPC = '';
                                            $AreatotWorkingDayVarience = $workingDayVarience; //AREA TOTAL
                                            $AreatotCurrentWorkingDays = $actual_working_count; //AREA TOTAL

                                            for ($k = 1; $k <= 6; $k++) {
                                                $monthNumberBack = date('m', strtotime($datepickermonth . ' -' . $k . ' month'));
                                                $monthNameBack = date('F', strtotime($datepickermonth . ' -' . $k . ' month'));

                                                if (!empty($categoryID) && isset($categoryID) && $categoryID != null) {//category pc requested need to get working days including categor bill dates and not billed dates 
                                                    if (!empty($getTotalSalesandPc) && isset($getTotalSalesandPc)) {
                                                        foreach ($getTotalSalesandPc as $p) {
                                                            if ($v['ag_cd'] === $p['ag_cd']) {
                                                                if (!empty($getTotalSalesandPcFull) && isset($getTotalSalesandPcFull)) {
                                                                    foreach ($getTotalSalesandPcFull as $pcFull) {
                                                                        if ($p['ag_cd'] == $pcFull['ag_cd']) {
                                                                            
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                } else {
                                                    if (!empty($getTotalSalesandPc) && isset($getTotalSalesandPc)) {
                                                        foreach ($getTotalSalesandPc as $p) {
                                                            if ($v['ag_cd'] === $p['ag_cd']) {
                                                                if ($areaNameCurrent == $v['area_name']) {
                                                                    ${'totPCArea' . $k} = $p[$monthNameBack . '_TotPC'];
                                                                    ${'totWDArea' . $k} = $p[$monthNameBack . '_WD'];
                                                                } else {
                                                                    
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                                if ($areaNameCurrent == $v['area_name']) {
                                                    ${'totFArea' . $k} = $v[$monthNameBack . '-Total'];
                                                } else {
                                                    
                                                }
                                            }
                                            $strBackFootArea = '';

                                            //PRINT REGION TOTALS
                                            if ($region_name_current != $v['region_name']) {//to print a new region but total lines are in old region
                                                for ($n = 1; $n <= date('t', strtotime($datepickermonth)); $n++) {
                                                    /*
                                                      $RegionstrRowFootWithPC .= '<td class="text-right">' . number_format(${'tot' . sprintf("%02d", $n) . '_region'}) . '</td>'
                                                      . '<td class="text-right" style="background: #efebb9;">' . number_format(${'tot' . sprintf("%02d", $n) . '_pc_region'}) . '</td>';  //AREA SUMMERY

                                                     */
                                                    $RegionstrRowFootWithPC .= '<td class="text-right">' . number_format(${'tot' . sprintf("%02d", $n) . '_region'}) . '</td>'
                                                            . '<td class="text-right" style="background: #efebb9;">-</td>';  //AREA SUMMERY
                                                    ///RESET VALUES OF AREA TO NEW AREA
                                                    ${'tot' . sprintf("%02d", $n) . '_region'} = 0; // $v[$monthName . '-' . $n];
                                                    ${'tot' . sprintf("%02d", $n) . '_pc_region'} = 0; // $v[$monthName . '-' . $n . '-pc'];
                                                }
                                                $PP = 'target not set';
                                                if ($RegionTotal != 0) {
                                                    $PP = number_format(($RegiontotF / $RegionTotal) * 100);
                                                }
                                                $avgValR = 0;
                                                $avgPCR = 0;
                                                if ($RegiontotCurrentWorkingDays != 0) {
                                                    $avgValR = number_format($RegiontotF / $RegiontotCurrentWorkingDays);
                                                    $avgPCR = number_format($RegiontotPcF / $RegiontotCurrentWorkingDays, 1);
                                                } else {
                                                    $avgPCR = $avgValR = 'NA';
                                                }

                                                for ($k = 1; $k <= 6; $k++) {
                                                    if (${'totWDRegion' . $k} == 0) {
                                                        $strBackFootRegion .= '<td class="text-right">' . number_format(${'totFRegion' . $k}) . '</td><td>NA</td><!-- <td>' . number_format(${'totPCRegion' . $k}) . '</td> --><td>' . number_format(${'totWDRegion' . $k}) . '</td>';
                                                    } else {
                                                        $strBackFootRegion .= '<td class="text-right">' . number_format(${'totFRegion' . $k}) . '</td><td>' . number_format(${'totPCRegion' . $k} / ${'totWDRegion' . $k}, 1) . '</td><!-- <td>' . number_format(${'totPCRegion' . $k}) . '</td> --><td>' . number_format(${'totWDRegion' . $k}) . '</td>';
                                                    }

                                                    /* ${'totFArea' . $k} = 0;
                                                      if ($region_name_current == $v['region_name']) {
                                                      ${'totFRegion' . $k} = ${'totFRegion' . $k} + ${'totFArea' . $k};
                                                      ${'totPCRegion' . $k} = ${'totPCRegion' . $k} + ${'totPCArea' . $k};
                                                      ${'totWDRegion' . $k} = ${'totWDRegion' . $k}+ ${'totWDArea' . $k};
                                                      } */
                                                }

                                                 echo '<tr style="font-weight:bold;">'
                                                 . '<td class="sticky-col first-col">' . $rname . '</td>'
                                                 . '<td colspan="4" style="z-index: 6;" >' . $rname . ' Total ' . '' . '</td>'
                                                 . $RegionstrRowFootWithPC
                                                 . '<td></td>'
                                                 . '<td>' . number_format($RegionTotal) . '</td>'
                                                 . '<td class="text-right" style="font-weight:bold;">' . number_format($RegiontotF) . '</td>'
                                                 . '<td>' . ((($RegiontotVarienceValue) < 0 ? "(" . number_format(abs($RegiontotVarienceValue)) . ")" : number_format($RegiontotVarienceValue))) . '</td>'
                                                 . '<td>' . ($PP) . '%</td>'
                                                 . '<td>' . $RegiontotCurrentWorkingDays . '</td>'
                                                 . '<td>' . ((($RegiontotWorkingDayVarience) < 0 ? "(" . number_format(abs($RegiontotWorkingDayVarience)) . ")" : number_format($RegiontotWorkingDayVarience))) . '</td>'
                                                 . '<td>' . $avgValR . '</td>'
                                                 . '<td>' . $avgPCR . '</td>'
                                                 . '<td class="text-right" style="background: #efebb9;font-weight:bold;">' . number_format($RegiontotPcF) . '</td>'
                                                 . $strBackFootRegion
                                                 . '</tr>';
                                                $region_name_current = $v['region_name'];
                                                $strTest = $v['ag_name'];
                                                $RegionstrRowFootWithPC = '';
                                                $RegionTotal = $targetVal;
                                                $RegiontotF = $v[$monthName . '-Total'];
                                                $RegiontotVarienceValue = $varienceValue;
                                                $RegiontotCurrentWorkingDays = $actual_working_count;
                                                $RegiontotWorkingDayVarience = $workingDayVarience;
                                                $RegiontotPcF = $rowTotPc; //AREA TOTAL
                                                $strBackFootRegion = '';
                                                for ($n = 1; $n <= date('t', strtotime($datepickermonth)); $n++) {
                                                    if ($region_name_current == $v['region_name']) {
                                                        $strTest .= $v['ag_name'];
                                                        ${'tot' . sprintf("%02d", $n) . '_region'} = ${'tot' . sprintf("%02d", $n) . '_region'} + $v[$monthName . '-' . $n];
                                                        ${'tot' . sprintf("%02d", $n) . '_pc_region'} = ${'tot' . sprintf("%02d", $n) . '_pc_region'} + $v[$monthName . '-' . $n . '-pc'];
                                                    }
                                                }
                                            }
                                        }
                                    }

                                    echo '<tr>'
                                    . '<td class="sticky-col first-col" >' . $v['region_name'] . '</td>'
                                    . '<td class="sticky-col first-col" >' . $v['area_name'] . '</td>'
                                    . '<td class="sticky-col first-col" >' . $v['ag_name'] . '</td>'
                                    . '<td>' . $v['ag_cd'] . '</td>'
                                    . '<td>' . $v['cd'] . '</td>'
                                    . $strRowWithPc
                                    . '<td class="text-right" style="font-weight:bold;">' . number_format($targetVal) . '</td>'
                                    . '<td class="text-right" style="font-weight:bold;">' . number_format($v[$monthName . '-Total']) . '</td>'
                                    . '<td>' . (($varienceValue) < 0 ? "(" . number_format(abs($varienceValue)) . ")" : number_format($varienceValue)) . '</td>'
                                    . '<td>' . ($persentage) . '%</td>'
                                    . '<td>' . $actual_working_count . '</td>'
                                    . '<td>' . ((($workingDayVarience) < 0 ? "(" . number_format(abs($workingDayVarience)) . ")" : number_format($workingDayVarience))) . '</td>'
                                    . '<td>' . ($avgSale) . '</td>'
                                    . '<td>' . ($avgPCperDay) . '</td>'
                                     . '<td class="text-right" style="background: #efebb9;font-weight:bold;">' . number_format($rowTotPc) . '</td>'
                                    . $strBackValues
                                    . '</tr>';

                                    if ($areaNameCurrent == $v['area_name']) {//we are in same area
                                        if (count($DailySales) == $currentRow) {///and we are in the last row 
                                            for ($n = 1; $n <= date('t', strtotime($datepickermonth)); $n++) {
                                                /*
                                                  $AreastrRowFootWithPC .= '<td class="text-right">' . number_format(${'tot' . sprintf("%02d", $n) . '_area'}) . '</td>'
                                                  . '<td class="text-right" style="background: #efebb9;">' . number_format(${'tot' . sprintf("%02d", $n) . '_pc_area'}) . '</td>';
                                                 */
                                                $AreastrRowFootWithPC .= '<td class="text-right">' . number_format(${'tot' . sprintf("%02d", $n) . '_area'}) . '</td>'
                                                        . '<td class="text-right" style="background: #efebb9;">-</td>';
                                                //AREA SUMMERY
                                            }

                                            $PP = 'target not set';
                                            if ($AreaTotal != 0) {
                                                $PP = number_format(($AreatotF / $AreaTotal) * 100);
                                            }
                                            if ($region_name_current != $v['region_name']) {//to print a new region but total lines are in old region
                                                $rname = $region_name_current;
                                            } else {
                                                $rname = $v['region_name'];
                                            }

                                            for ($k = 1; $k <= 6; $k++) {
                                                /*
                                                  if(${'totWDArea' . $k}==0){
                                                  $strBackFootArea .= '<td class="text-right">' . number_format(${'totFArea' . $k}) . '</td><td>NA</td><!-- <td>' . number_format(${'totPCArea' . $k}) . '</td> --><td>' . number_format(${'totWDArea' . $k}) . '</td>';
                                                  }else{
                                                  $strBackFootArea .= '<td class="text-right">' . number_format(${'totFArea' . $k}) . '</td><td>' . number_format(${'totPCArea' . $k} / ${'totWDArea' . $k}, 1) . '</td> <!-- <td>' . number_format(${'totPCArea' . $k}) . '</td> --><td>' . number_format(${'totWDArea' . $k}) . '</td>';
                                                  }
                                                 */
                                                if (${'totWDArea' . $k} == 0) {
                                                    $strBackFootArea .= '<td class="text-right">' . number_format(${'totFArea' . $k}) . '</td><td>NA</td> <td>' . number_format(${'totWDArea' . $k}) . '</td>';
                                                } else {
                                                    $strBackFootArea .= '<td class="text-right">' . number_format(${'totFArea' . $k}) . '</td><td>' . number_format(${'totPCArea' . $k} / ${'totWDArea' . $k}, 1) . '</td> <td>' . number_format(${'totWDArea' . $k}) . '</td>';
                                                }
                                                ${'totFArea' . $k} = 0;
                                            }
                                            $workingDaysDevision = '';
                                            if($AreatotCurrentWorkingDays!=0){
                                               $workingDaysDevision = number_format($AreatotF / $AreatotCurrentWorkingDays); 
                                           }else{
                                            $workingDaysDevision ='NA';
                                           }

                                           $workingDaysDevisionPc = '';
                                           if($AreatotCurrentWorkingDays!=0){
                                              $workingDaysDevisionPc = number_format($AreatotPcF / $AreatotCurrentWorkingDays, 1);
                                           }else{
                                            $workingDaysDevisionPc ='NA';
                                           } 

                                            echo '<tr style="font-weight:bold;">'
                                            . '<td class="sticky-col first-col" >' . $rname . '</td>'
                                            . '<td class="sticky-col first-col" >' . $areaNameCurrent . '</td>'
                                            . '<td class="sticky-col first-col" >Total</td>'
                                            . '<td></td>'
                                            . '<td></td>'
                                            . $AreastrRowFootWithPC
                                            . '<td>' . number_format($AreaTotal) . '</td>'
                                            . '<td class="text-right" style="font-weight:bold;">' . number_format($AreatotF) . '</td>'
                                            . '<td>' . ((($AreatotVarienceValue) < 0 ? "(" . number_format(abs($AreatotVarienceValue)) . ")" : number_format($AreatotVarienceValue))) . '</td>'
                                            . '<td>' . ($PP) . '%</td>'
                                            . '<td>' . $AreatotCurrentWorkingDays . '</td>'
                                            . '<td>' . ((($AreatotWorkingDayVarience) < 0 ? "(" . number_format(abs($AreatotWorkingDayVarience)) . ")" : number_format($AreatotWorkingDayVarience))) . '</td>'
                                            . '<td>' . $workingDaysDevision . '</td>'
                                            . '<td>' .  $workingDaysDevisionPc     . '</td>'
                                            . '<td class="text-right" style="background: #efebb9;font-weight:bold;">' . number_format($AreatotPcF) . '</td>'
                                            . $strBackFootArea
                                            . '</tr>';
                                            $areaNameCurrent = $v['area_name'];
                                            $AreatotF = $v[$monthName . '-Total'];
                                            $AreaTotal = $targetVal; //area total Target                                            
                                            $AreatotPcF = $rowTotPc;
                                            $AreatotVarienceValue = $varienceValue;
                                            $AreatotWorkingDayVarience = $workingDayVarience; //AREA TOTAL
                                            $AreatotCurrentWorkingDays = $actual_working_count; //AREA TOTAL   
                                            //
                                            //
                                            //
                                            //PRINT REGION SUMMERY
                                            for ($n = 1; $n <= date('t', strtotime($datepickermonth)); $n++) {
                                                /*
                                                  $RegionstrRowFootWithPC .= '<td class="text-right">' . number_format(${'tot' . sprintf("%02d", $n) . '_region'}) . '</td>'
                                                  . '<td class="text-right" style="background: #efebb9;">' . number_format(${'tot' . sprintf("%02d", $n) . '_pc_region'}) . '</td>';  //AREA SUMMERY
                                                 */
                                                $RegionstrRowFootWithPC .= '<td class="text-right">' . number_format(${'tot' . sprintf("%02d", $n) . '_region'}) . '</td>'
                                                        . '<td class="text-right" style="background: #efebb9;"></td>';  //AREA SUMMERY
                                                ///RESET VALUES OF AREA TO NEW AREA
                                                //${'tot' . sprintf("%02d", $n) . '_region'} = $v[$monthName . '-' . $n];
                                                //${'tot' . sprintf("%02d", $n) . '_pc_region'} = $v[$monthName . '-' . $n . '-pc'];
                                            }
                                            $PP = 'target not set';
                                            if ($RegionTotal != 0) {
                                                $PP = number_format(($RegiontotF / $RegionTotal) * 100);
                                            }
                                            $avgValR = 0;
                                            $avgPCR = 0;
                                            if ($RegiontotCurrentWorkingDays != 0) {
                                                $avgValR = number_format($RegiontotF / $RegiontotCurrentWorkingDays);
                                                $avgPCR = number_format($RegiontotPcF / $RegiontotCurrentWorkingDays, 1);
                                            } else {
                                                $avgPCR = $avgValR = 'NA';
                                            }
                                            
                                            echo '<tr style="font-weight:bold;">'
                                            . '<td class="sticky-col first-col">' . $rname . '</td>'
                                            . '<td colspan="4" style="z-index: 6;" >' . $rname . ' Total ' . '' . '</td>'
                                            // ---------------------------------------------------------------------------------------last law report------------
                                            
                                             . $RegionstrRowFootWithPC
                                             . '<td>' . number_format($RegionTotal) . '</td>'
                                             . '<td class="text-right" style="font-weight:bold;">' . number_format($RegiontotF) . '</td>'
                                             . '<td>' . ((($RegiontotVarienceValue) < 0 ? "(" . number_format(abs($RegiontotVarienceValue)) . ")" : number_format($RegiontotVarienceValue))) . '</td>'
                                             . '<td>' . ($PP) . '%</td>'
                                             . '<td>' . $RegiontotCurrentWorkingDays . '</td>'
                                             . '<td>' . ((($RegiontotWorkingDayVarience) < 0 ? "(" . number_format(abs($RegiontotWorkingDayVarience)) . ")" : number_format($RegiontotWorkingDayVarience))) . '</td>'
                                             . '<td>' . $avgValR . '</td>'
                                             . '<td>' . $avgPCR . '</td>'
                                             . '<td class="text-right" style="background: #efebb9;font-weight:bold;">' . number_format($RegiontotPcF) . '</td>'
                                             . $strBackFootArea
                                            . '</tr>';
                                            //echo $strTest;
                                        }
                                    } else {
                                        if (!empty($AreaID) && isset($AreaID) && $AreaID == '-1' && count($DailySales) == $currentRow) {//in last row -all island report requested
                                            for ($n = 1; $n <= date('t', strtotime($datepickermonth)); $n++) {
                                                ///RESET VALUES OF AREA TO NEW AREA
                                                //${'tot' . sprintf("%02d", $n) . '_area'} = $v[$monthName . '-' . $n];
                                                //${'tot' . sprintf("%02d", $n) . '_pc_area'} = $v[$monthName . '-' . $n . '-pc'];
                                                $AreastrRowFootWithPC .= '<td class="text-right">' . number_format(${'tot' . sprintf("%02d", $n) . '_area'}) . '</td>'
                                                        . '<td class="text-right" style="background: #efebb9;">' . number_format(${'tot' . sprintf("%02d", $n) . '_pc_area'}) . '</td>';  //AREA SUMMERY
                                            }

                                            $PP = 'target not set';
                                            if ($AreaTotal != 0) {
                                                $PP = number_format(($AreatotF / $AreaTotal) * 100);
                                            }
                                            $rname = '';
                                            if ($region_name_current != $v['region_name']) {//to print a new region but total lines are in old region
                                                $rname = $region_name_current;
                                            } else {
                                                $rname = $v['region_name'];
                                            }

                                            for ($k = 1; $k <= 6; $k++) {
                                                $strBackFootArea .= '<td class="text-right">' . number_format(${'totFArea' . $k}) . '</td><td>' . number_format(${'totPCArea' . $k} / ${'totWDArea' . $k}, 1) . '</td><!-- <td>' . number_format(${'totPCArea' . $k}) . '</td> --><td>' . number_format(${'totWDArea' . $k}) . '</td>';
                                                ${'totFArea' . $k} = 0;
                                            }

                                           

                                            echo '<tr style="font-weight:bold;">'
                                            . '<td class="sticky-col first-col" >' . $rname . '</td>'
                                            . '<td class="sticky-col first-col" >' . $areaNameCurrent . '</td>'
                                            . '<td class="sticky-col first-col" >Total</td>'
                                            . '<td></td>'
                                            . '<td></td>'
                                            . $AreastrRowFootWithPC
                                            . '<td>' . number_format($AreaTotal) . '</td>'
                                            . '<td class="text-right" style="font-weight:bold;">' . number_format($AreatotF) . '</td>'
                                            . '<td>' . ((($AreatotVarienceValue) < 0 ? "(" . number_format(abs($AreatotVarienceValue)) . ")" : number_format($AreatotVarienceValue))) . '</td>'
                                            . '<td>' . ($PP) . '%</td>'
                                            . '<td>' . $AreatotCurrentWorkingDays . '</td>'
                                            . '<td>' . ((($AreatotWorkingDayVarience) < 0 ? "(" . number_format(abs($AreatotWorkingDayVarience)) . ")" : number_format($AreatotWorkingDayVarience))) . '</td>'
                                            . '<td>' . number_format($AreatotF / $AreatotCurrentWorkingDays) . '</td>'
                                            . '<td>' . number_format($AreatotPcF / $AreatotCurrentWorkingDays, 1) . '</td>'
                                            . '<td class="text-right" style="background: #efebb9;font-weight:bold;">' . number_format($AreatotPcF) . '</td>'
                                            . $strBackFootArea
                                            . '</tr>';
                                            $areaNameCurrent = $v['area_name'];
                                            $AreatotF = $v[$monthName . '-Total'];
                                            $AreaTotal = $targetVal; //area total Target
                                            $AreatotPcF = $rowTotPc;
                                            $AreatotVarienceValue = $varienceValue;
                                            $AreatotWorkingDayVarience = $workingDayVarience; //AREA TOTAL
                                            $AreatotCurrentWorkingDays = $actual_working_count; //AREA TOTAL    
                                            //
                                            //
                                            //
                                            //PRINT REGION SUMMERY
                                            for ($n = 1; $n <= date('t', strtotime($datepickermonth)); $n++) {
                                                $RegionstrRowFootWithPC .= '<td class="text-right">' . number_format(${'tot' . sprintf("%02d", $n) . '_region'}) . '</td>'
                                                        . '<td class="text-right" style="background: #efebb9;">' . number_format(${'tot' . sprintf("%02d", $n) . '_pc_region'}) . '</td>';  //AREA SUMMERY
                                                ///RESET VALUES OF AREA TO NEW AREA
                                                //${'tot' . sprintf("%02d", $n) . '_region'} = $v[$monthName . '-' . $n];
                                                //${'tot' . sprintf("%02d", $n) . '_pc_region'} = $v[$monthName . '-' . $n . '-pc'];
                                            }
                                            $PP = 'target not set';
                                            if ($RegionTotal != 0) {
                                                $PP = number_format(($RegiontotF / $RegionTotal) * 100);
                                            }
                                            $avgValR = 0;
                                            $avgPCR = 0;
                                            if ($RegiontotCurrentWorkingDays != 0) {
                                                $avgValR = number_format($RegiontotF / $RegiontotCurrentWorkingDays);
                                                $avgPCR = number_format($RegiontotPcF / $RegiontotCurrentWorkingDays, 1);
                                            } else {
                                                $avgPCR = $avgValR = 'NA';
                                            }
                                            

                                             echo '<tr style="font-weight:bold;">'
                                               . '<td class="sticky-col first-col">' . $rname . '</td>'
                                             . '<td colspan="4" style="z-index: 6;">' . $rname . ' Total</td>'
                                             . $RegionstrRowFootWithPC
                                             . '<td>' . number_format($RegionTotal) . '</td>'
                                             . '<td class="text-right" style="font-weight:bold;">' . number_format($RegiontotF) . '</td>'
                                             . '<td>' . ((($RegiontotVarienceValue) < 0 ? "(" . number_format(abs($RegiontotVarienceValue)) . ")" : number_format($RegiontotVarienceValue))) . '</td>'
                                             . '<td>' . ($PP) . '%</td>'
                                             . '<td>' . $RegiontotCurrentWorkingDays . '</td>'
                                             . '<td>' . ((($RegiontotWorkingDayVarience) < 0 ? "(" . number_format(abs($RegiontotWorkingDayVarience)) . ")" : number_format($RegiontotWorkingDayVarience))) . '</td>'
                                             . '<td>' . $avgValR . '</td>'
                                             . '<td>' . $avgPCR . '</td>'
                                             . '<td class="text-right" style="background: #efebb9;font-weight:bold;">' . number_format($RegiontotPcF) . '</td>'
                                             . $strBackFootArea
                                             . '</tr>';
                                        }
                                    }
                                }


                                for ($n = 1; $n <= date('t', strtotime($datepickermonth)); $n++) {

                                    $strRowFootWithPC .= '<td class="text-right">' . number_format(${'tot' . sprintf("%02d", $n) . '_v' }) . '</td>'
                                            . '<td class="text-right" style="background: #efebb9;">' . number_format(${'tot' . sprintf("%02d", $n) . '_pc'}) . '</td>';
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
                     . '<td colspan="5">Total</td>'
                     . $strRowFootWithPC
                     . '<td>' . number_format($totTarget) . '</td>'
                     . '<td class="text-right" style="font-weight:bold;">' . number_format($totF) . '</td>'
                     . '<td>' . ((($totVarienceValue) < 0 ? "(" . number_format(abs($totVarienceValue)) . ")" : number_format($totVarienceValue))) . '</td>'
                     . '<td>' . ($PP) . '%</td>'
                     . '<td>' . ($totCurrentWorkingDays) . '</td>'
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
// echo '************************************************';
if (!empty($DailySalesQty) && isset($DailySalesQty)) {
// echo 'INSIDE THE IF';
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
// echo $totExpectedWorkingDays.'Working Days';



                        if (date('Y-m', strtotime($datepickermonth)) === date('Y-m')) {//if this is calender current month ignore today
                            $totExpectedWorkingDays = $totExpectedWorkingDays - 1;
                        }
                        //AREA TOTAL
                        $tot01_area = 0;
                        $tot02_area = 0;
                        $tot03_area = 0;
                        $tot04_area = 0;
                        $tot05_area = 0;
                        $tot06_area = 0;
                        $tot07_area = 0;
                        $tot08_area = 0;
                        $tot09_area = 0;
                        $tot10_area = 0;
                        $tot11_area = 0;
                        $tot12_area = 0;
                        $tot13_area = 0;
                        $tot14_area = 0;
                        $tot15_area = 0;
                        $tot16_area = 0;
                        $tot17_area = 0;
                        $tot18_area = 0;
                        $tot19_area = 0;
                        $tot20_area = 0;
                        $tot21_area = 0;
                        $tot22_area = 0;
                        $tot23_area = 0;
                        $tot24_area = 0;
                        $tot25_area = 0;
                        $tot26_area = 0;
                        $tot27_area = 0;
                        $tot28_area = 0;
                        $tot29_area = 0;
                        $tot30_area = 0;
                        $tot31_area = 0;

                        $tot01_pc_area = 0;
                        $tot02_pc_area = 0;
                        $tot03_pc_area = 0;
                        $tot04_pc_area = 0;
                        $tot05_pc_area = 0;
                        $tot06_pc_area = 0;
                        $tot07_pc_area = 0;
                        $tot08_pc_area = 0;
                        $tot09_pc_area = 0;
                        $tot10_pc_area = 0;
                        $tot11_pc_area = 0;
                        $tot12_pc_area = 0;
                        $tot13_pc_area = 0;
                        $tot14_pc_area = 0;
                        $tot15_pc_area = 0;
                        $tot16_pc_area = 0;
                        $tot17_pc_area = 0;
                        $tot18_pc_area = 0;
                        $tot19_pc_area = 0;
                        $tot20_pc_area = 0;
                        $tot21_pc_area = 0;
                        $tot22_pc_area = 0;
                        $tot23_pc_area = 0;
                        $tot24_pc_area = 0;
                        $tot25_pc_area = 0;
                        $tot26_pc_area = 0;
                        $tot27_pc_area = 0;
                        $tot28_pc_area = 0;
                        $tot29_pc_area = 0;
                        $tot30_pc_area = 0;
                        $tot31_pc_area = 0;

                        //REGION TOTALS
                        //AREA TOTAL
                        $tot01_region = 0;
                        $tot02_region = 0;
                        $tot03_region = 0;
                        $tot04_region = 0;
                        $tot05_region = 0;
                        $tot06_region = 0;
                        $tot07_region = 0;
                        $tot08_region = 0;
                        $tot09_region = 0;
                        $tot10_region = 0;
                        $tot11_region = 0;
                        $tot12_region = 0;
                        $tot13_region = 0;
                        $tot14_region = 0;
                        $tot15_region = 0;
                        $tot16_region = 0;
                        $tot17_region = 0;
                        $tot18_region = 0;
                        $tot19_region = 0;
                        $tot20_region = 0;
                        $tot21_region = 0;
                        $tot22_region = 0;
                        $tot23_region = 0;
                        $tot24_region = 0;
                        $tot25_region = 0;
                        $tot26_region = 0;
                        $tot27_region = 0;
                        $tot28_region = 0;
                        $tot29_region = 0;
                        $tot30_region = 0;
                        $tot31_region = 0;

                        $tot01_pc_region = 0;
                        $tot02_pc_region = 0;
                        $tot03_pc_region = 0;
                        $tot04_pc_region = 0;
                        $tot05_pc_region = 0;
                        $tot06_pc_region = 0;
                        $tot07_pc_region = 0;
                        $tot08_pc_region = 0;
                        $tot09_pc_region = 0;
                        $tot10_pc_region = 0;
                        $tot11_pc_region = 0;
                        $tot12_pc_region = 0;
                        $tot13_pc_region = 0;
                        $tot14_pc_region = 0;
                        $tot15_pc_region = 0;
                        $tot16_pc_region = 0;
                        $tot17_pc_region = 0;
                        $tot18_pc_region = 0;
                        $tot19_pc_region = 0;
                        $tot20_pc_region = 0;
                        $tot21_pc_region = 0;
                        $tot22_pc_region = 0;
                        $tot23_pc_region = 0;
                        $tot24_pc_region = 0;
                        $tot25_pc_region = 0;
                        $tot26_pc_region = 0;
                        $tot27_pc_region = 0;
                        $tot28_pc_region = 0;
                        $tot29_pc_region = 0;
                        $tot30_pc_region = 0;
                        $tot31_pc_region = 0;
                        //
                        //Total Full
                        $tot01_v = 0;
                        $tot02_v = 0;
                        $tot03_v = 0;
                        $tot04_v = 0;
                        $tot05_v = 0;
                        $tot06_v = 0;
                        $tot07_v = 0;
                        $tot08_v = 0;
                        $tot09_v = 0;
                        $tot10_v = 0;
                        $tot11_v = 0;
                        $tot12_v = 0;
                        $tot13_v = 0;
                        $tot14_v = 0;
                        $tot15_v = 0;
                        $tot16_v = 0;
                        $tot17_v = 0;
                        $tot18_v = 0;
                        $tot19_v = 0;
                        $tot20_v = 0;
                        $tot21_v = 0;
                        $tot22_v = 0;
                        $tot23_v = 0;
                        $tot24_v = 0;
                        $tot25_v = 0;
                        $tot26_v = 0;
                        $tot27_v = 0;
                        $tot28_v = 0;
                        $tot29_v = 0;
                        $tot30_v = 0;
                        $tot31_v = 0;

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
                            $strDayColValPC .= '<th>' . sprintf("%02d", $n) . ' Qty</th><th style="background: #efebb9;">' . sprintf("%02d", $n) . ' PC</th>';
                        }
                        //echo $strDayCol;
                        $strBack = '';
                        for ($k = 1; $k <= 6; $k++) {
                            $monthNumberBack = date('m', strtotime($datepickermonth . ' -' . $k . ' month'));
                            $monthNameBack = date('F', strtotime($datepickermonth . ' -' . $k . ' month'));
                            $strBack .= '<th style="background: #000000 !important; color: #fff; text-align: center;">' . $monthNameBack . '-Total</th><th>' . $monthNameBack . '- Avg PC</th><!-- <th>' . $monthNameBack . '- PC</th> --><th>' . $monthNameBack . '- WD</th>';
                            ${'totF' . $k} = 0;
                            ${'totWD' . $k} = 0;
                            ${'totPC' . $k} = 0;

                            ${'totFArea' . $k} = 0;
                            ${'totWDArea' . $k} = 0;
                            ${'totPCArea' . $k} = 0;
                        }
                        ?>
                        <h2>Total Actual Achievement Value with PC <?php
                            $catN = '';
                            if (!empty($categoryLineData) && isset($categoryLineData)) {
                                echo $catN = ' - ' . $categoryLineData->name;
                            }

                            // echo $totWorkingDays;
                            ?></h2>
                        <h3>Total Working Days: <?= $totWorkingDays ?> / Expected Working Days As at: <?= $totExpectedWorkingDays ?></h3>
                        <small>Today is ignored from expected working day count. </small>
                        <input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('attendance_table2', 'Daily Sales <?= $monthName . $catN ?>')" value="Download Excel"><br>
                        <table id="attendance_table2" class="table table-hover presentation">
                            <thead>
                                <tr>
                                    <th class="fix"></th> 
                                    <th class="fix"></th> 
                                    <th class="fix"></th> 
                                    <th class="fix"></th> 
                                    <th class="fix"></th> 
                                    <?= $strDayColWithPC ?> 
                                    <th class="fix" colspan="9" style="text-align: center;"><?= $monthName ?>-Total</th>
                                    <th class="fix" colspan="24" style="background: #000000 !important; color: #fff; text-align: center;">Past Figures</th>
                                </tr>
                                <tr>
                                    <th>Region Name</th> 
                                    <th>Area</th>
                                    <th>Territory</th>
                                    <th>Territory Code</th>
                                    <th>Range</th>
                                    <?= $strDayColValPC ?> 
                                    <th>Target</th>
                                    <th><?= $monthName ?>-Total</th> 
                                    <th>Variance - Cum Target vs</th> 
                                    <th><!-- Target vs  Cum With Dir. -->Sale (%)</th> 
                                    <th>WD</th> 
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
                                $totActualWorkingDays = 0;
                                $totTarget = 0;
                                $totVarienceValue = 0;
                                //FOR AREA SUMMERY
                                $areaNameCurrent = '';
                                $currentRow = 0;
                                $areaFinalTotal = 0;
                                $AreaTotal = 0;
                                $AreatotF = 0;
                                $AreatotVarienceValue = 0;
                                $AreatotWorkingDayVarience = 0;
                                $AreatotCurrentWorkingDays = 0;
                                $AreatotPcF = 0;
                                $AreastrRowFootWithPC = '';

                                $strBackFootArea = '';
                                $strBackFootRegion = '';

                                $region_name_current = '';
                                $region_name_to_display = '';
                                $RegionstrRowFootWithPC = '';
                                $RegionTotal = 0; //region total target
                                $RegiontotF = 0;
                                $RegiontotVarienceValue = 0;
                                $RegiontotCurrentWorkingDays = 0;
                                $RegiontotWorkingDayVarience = 0;
                                $RegiontotPcF = 0;
                                $strTest = '';

                                for ($k = 1; $k <= 6; $k++) {
                                    ${'totFRegion' . $k} = 0;
                                    ${'totPCRegion' . $k} = 0;
                                    ${'totWDRegion' . $k} = 0;
                                }

                                $strRowFootWithPC = '';
                                foreach ($DailySalesQty as $v) {
                                    if ($currentRow == 0) {//we are in first row
                                        $areaNameCurrent = $v['area_name'];
                                        $region_name_to_display = $region_name_current = $v['region_name'];
                                    }

                                    $currentRow = $currentRow + 1;

                                    $rowTotPc = 0;
                                    $strRow = '';
                                    $strRowWithPc = '';
                                    $strRowFoot = '';
                                    $max = 0;
                                    for ($n = 1; $n <= date('t', strtotime($datepickermonth)); $n++) {
                                        $territoryWithSaleCount = 0;
                                        $max = $n;

                                        ${'tot' . sprintf("%02d", $n) . '_v'} = ${'tot' . sprintf("%02d", $n) . '_v'} + $v[$monthName . '-' . $n];
                                        ${'tot' . sprintf("%02d", $n) . '_pc'} = ${'tot' . sprintf("%02d", $n) . '_pc'} + $v[$monthName . '-' . $n . '-pc'];

                                        if ($areaNameCurrent == $v['area_name']) {//we are in same area
                                            //AREA TOTAL
                                            ${'tot' . sprintf("%02d", $n) . '_area'} = ${'tot' . sprintf("%02d", $n) . '_area'} + $v[$monthName . '-' . $n];
                                            ${'tot' . sprintf("%02d", $n) . '_pc_area'} = ${'tot' . sprintf("%02d", $n) . '_pc_area'} + $v[$monthName . '-' . $n . '-pc'];
                                        }

                                        if ($region_name_current == $v['region_name']) {
                                            $strTest .= $v['ag_name'];
                                            ${'tot' . sprintf("%02d", $n) . '_region'} = ${'tot' . sprintf("%02d", $n) . '_region'} + $v[$monthName . '-' . $n];
                                            ${'tot' . sprintf("%02d", $n) . '_pc_region'} = ${'tot' . sprintf("%02d", $n) . '_pc_region'} + $v[$monthName . '-' . $n . '-pc'];
                                        }


                                        $strRow .= '<td class="text-right">' . number_format($v[$monthName . '-' . $n]) . '</td>';
                                        if ($v[$monthName . '-' . $n] != 0) {
                                            $strRowWithPc .= '<td class="text-right">' . number_format($v[$monthName . '-' . $n]) . '</td>'
                                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($v[$monthName . '-' . $n . '-pc']) . '</td>';
                                        } else {
                                            $strRowWithPc .= '<td class="text-right">-</td>'
                                                    . '<td class="text-right" style="background: #efebb9;">-</td>';
                                        }
                                        $strRowFoot .= '<td class="text-right">' . number_format(${'tot' . sprintf("%02d", $n) . '_v'}) . '</td>';

                                        //$strRowFootWithPC .= '<td class="text-right">' . number_format(${'tot' . sprintf("%02d", $n)}) . '</td>'
                                        //        . '<td class="text-right" style="background: #efebb9;">' . number_format(${'tot' . sprintf("%02d", $n) . '_pc'}) . '</td>';
                                        //$AreastrRowFootWithPC .= '<td class="text-right">' . number_format(${'tot' . sprintf("%02d", $n . '_area')}) . '</td>'
                                        //        . '<td class="text-right" style="background: #efebb9;">' . number_format(${'tot' . sprintf("%02d", $n) . '_pc' . '_area'}) . '</td>';  //AREA SUMMERY
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
                                    if ($areaNameCurrent == $v['area_name']) {//we are in same area
                                        //AREA TOTAL
                                        $AreatotCurrentWorkingDays = $AreatotCurrentWorkingDays + $actual_working_count; //AREA TOTAL
                                    }
                                    if ($region_name_current == $v['region_name']) {
                                        $RegiontotCurrentWorkingDays = $RegiontotCurrentWorkingDays + $actual_working_count;
                                    }

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
                                    if ($areaNameCurrent == $v['area_name']) {//we are in same area
                                        //AREA TOTAL
                                        $AreatotWorkingDayVarience = $AreatotWorkingDayVarience + $workingDayVarience; //AREA TOTAL
                                    }

                                    if ($region_name_current == $v['region_name']) {
                                        $RegiontotWorkingDayVarience = $RegiontotWorkingDayVarience + $workingDayVarience;
                                    }

                                    $avgSale = 0;
                                    if ($actual_working_count == 0) {
                                        $avgSale = 'NA';
                                    } else {
                                        $avgSale = number_format($v[$monthName . '-Total'] / $actual_working_count);
                                    }

                                    $totTarget = $totTarget + $targetVal;
                                    if ($areaNameCurrent == $v['area_name']) {//we are in same area
                                        //AREA TOTAL
                                        $AreaTotal = $AreaTotal + $targetVal; //area total Target
                                    }
                                    if ($region_name_current == $v['region_name']) {
                                        $RegionTotal = $RegionTotal + $targetVal;
                                    }

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
                                                        /*
                                                          if ($totWDdays == 0) {
                                                          $OldMonthAvgPC = '<td>NA</td><td>' . $p[$monthNameBack . '_TotPC'] . '</td><td>' . $totWDdays . '</td>';
                                                          } else {
                                                          $OldMonthAvgPC = '<td>' . number_format($p[$monthNameBack . '_TotPC'] / $totWDdays, 1) . '</td><td>' . $p[$monthNameBack . '_TotPC'] . '</td><td>' . $totWDdays . '</td>';
                                                          }
                                                         */
                                                        if ($totWDdays == 0) {
                                                            $OldMonthAvgPC = '<td>NA</td><!-- <td>' . $p[$monthNameBack . '_TotPC'] . '</td> --> <td>' . $totWDdays . '</td>';
                                                        } else {
                                                            $OldMonthAvgPC = '<td>' . number_format($p[$monthNameBack . '_TotPC'] / $totWDdays, 1) . '</td><!-- <td>' . $p[$monthNameBack . '_TotPC'] . '</td> --> <td>' . $totWDdays . '</td>';
                                                        }
                                                    }
                                                }
                                            }
                                        } else {
                                            if (!empty($getTotalSalesandPc) && isset($getTotalSalesandPc)) {
                                                foreach ($getTotalSalesandPc as $p) {
                                                    if ($v['ag_cd'] === $p['ag_cd']) {
                                                        if ($p[$monthNameBack . '_WD'] == 0) {
                                                            //$OldMonthAvgPC = '<td>NA</td>  <td>' . $p[$monthNameBack . '_TotPC'] . '</td> <td>' . $p[$monthNameBack . '_WD'] . '</td>';
                                                            $OldMonthAvgPC = '<td>NA</td> <!-- <td>' . $p[$monthNameBack . '_TotPC'] . '</td> --> <td>' . $p[$monthNameBack . '_WD'] . '</td>';
                                                        } else {
                                                            //$OldMonthAvgPC = '<td>' . number_format($p[$monthNameBack . '_TotPC'] / $p[$monthNameBack . '_WD'], 1) . 'zzzzzzzzzzzzzzzzzzzzz</td> <!-- <td>' . $p[$monthNameBack . '_TotPC'] . '</td> --> <td>' . $p[$monthNameBack . '_WD'] . '</td>';
                                                            $OldMonthAvgPC = '<td>' . number_format($p[$monthNameBack . '_TotPC'] / $p[$monthNameBack . '_WD'], 1) . '</td> <!-- <td>' . $p[$monthNameBack . '_TotPC'] . '</td> --> <td>' . $p[$monthNameBack . '_WD'] . '</td>';
                                                        }
                                                        ${'totPC' . $k} = ${'totPC' . $k} + $p[$monthNameBack . '_TotPC'];
                                                        ${'totWD' . $k} = ${'totWD' . $k} + $p[$monthNameBack . '_WD'];
                                                        if ($areaNameCurrent == $v['area_name']) {//we are in same area                                                            
                                                            ${'totWDArea' . $k} = ${'totWDArea' . $k} + $p[$monthNameBack . '_WD'];
                                                            ${'totPCArea' . $k} = ${'totPCArea' . $k} + $p[$monthNameBack . '_TotPC'];
                                                        } else {
                                                            
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                        $strBackValues .= $OldMonthAvgPC;
                                        ${'totF' . $k} = ${'totF' . $k} + $v[$monthNameBack . '-Total'];
                                        //Final Total    
                                        if (${'totWD' . $k} == 0) {
                                            $strBackFoot .= '<td class="text-right">' . number_format(${'totF' . $k}) . '</td><td>NA</td><!-- <td>' . number_format(${'totPC' . $k}) . '</td> --><td>' . number_format(${'totWD' . $k}) . '</td>';
                                        } else {
                                            $strBackFoot .= '<td class="text-right">' . number_format(${'totF' . $k}) . '</td><td>' . number_format(${'totPC' . $k} / ${'totWD' . $k}, 1) . '</td><!-- <td>' . number_format(${'totPC' . $k}) . '</td> --><td>' . number_format(${'totWD' . $k}) . '</td>';
                                        }
                                        if ($areaNameCurrent == $v['area_name']) {//we are in same area
                                            //AREA TOTAL
                                            ${'totFArea' . $k} = ${'totFArea' . $k} + $v[$monthNameBack . '-Total'];
                                        }
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

                                    if ($areaNameCurrent == $v['area_name']) {//we are in same area
                                        //AREA TOTAL
                                        $AreatotVarienceValue = $AreatotVarienceValue + $varienceValue; //AREA TOTAL
                                    }
                                    if ($region_name_current == $v['region_name']) {
                                        $RegiontotVarienceValue = $RegiontotVarienceValue + $varienceValue;
                                    }

                                    $totF = $totF + $v[$monthName . '-Total'];

                                    if ($areaNameCurrent == $v['area_name']) {//we are in same area
                                        //AREA TOTAL
                                        $AreatotF = $AreatotF + $v[$monthName . '-Total'];
                                    }
                                    if ($region_name_current == $v['region_name']) {
                                        $RegiontotF = $RegiontotF + $v[$monthName . '-Total'];
                                    }

                                    $totPcF = $totPcF + $rowTotPc;
                                    if ($areaNameCurrent == $v['area_name']) {//we are in same area
                                        //AREA TOTAL
                                        $AreatotPcF = $AreatotPcF + $rowTotPc; //AREA TOTAL
                                    }
                                    if ($region_name_current == $v['region_name']) {
                                        $RegiontotPcF = $RegiontotPcF + $rowTotPc; //AREA TOTAL
                                    }
//PRINT AREA TOTAL AT THE END
                                    if ($areaNameCurrent == $v['area_name']) {//we are in same area
                                    } else {
                                        if (!empty($AreaID) && isset($AreaID) && $AreaID == '-1') {//all island report requested
                                            for ($n = 1; $n <= date('t', strtotime($datepickermonth)); $n++) {
                                                /*
                                                  $AreastrRowFootWithPC .= '<td class="text-right">' . number_format(${'tot' . sprintf("%02d", $n) . '_area'}) . '</td>'
                                                  . '<td class="text-right" style="background: #efebb9;">' . number_format(${'tot' . sprintf("%02d", $n) . '_pc_area'}) . '</td>';  //AREA SUMMERY
                                                 */
                                                $AreastrRowFootWithPC .= '<td class="text-right">' . number_format(${'tot' . sprintf("%02d", $n) . '_area'}) . '</td>'
                                                        . '<td class="text-right" style="background: #efebb9;">-</td>';  //AREA SUMMERY
                                                ///RESET VALUES OF AREA TO NEW AREA
                                                ${'tot' . sprintf("%02d", $n) . '_area'} = $v[$monthName . '-' . $n];
                                                ${'tot' . sprintf("%02d", $n) . '_pc_area'} = $v[$monthName . '-' . $n . '-pc'];
                                            }
                                            $PP = 'target not set';
                                            if ($AreaTotal != 0) {
                                                $PP = number_format(($AreatotF / $AreaTotal) * 100);
                                            }
                                            $rname = '';
                                            if ($region_name_current != $v['region_name']) {//to print a new region but total lines are in old region
                                                $rname = $region_name_current;
                                            } else {
                                                $rname = $v['region_name'];
                                            }
                                            $avgVal = 0;
                                            $avgPC = 0;
                                            if ($AreatotCurrentWorkingDays != 0) {
                                                $avgVal = number_format($AreatotF / $AreatotCurrentWorkingDays);
                                                $avgPC = number_format($AreatotPcF / $AreatotCurrentWorkingDays, 1);
                                            } else {
                                                $avgPC = $avgVal = 'NA';
                                            }
                                            for ($k = 1; $k <= 6; $k++) {
                                                if (${'totWDArea' . $k} == 0) {
                                                    $strBackFootArea .= '<td class="text-right">' . number_format(${'totFArea' . $k}) . '</td><td>NA</td><!-- <td>' . number_format(${'totPCArea' . $k}) . '</td> --><td>' . number_format(${'totWDArea' . $k}) . '</td>';
                                                } else {
                                                    $strBackFootArea .= '<td class="text-right">' . number_format(${'totFArea' . $k}) . '</td><td>' . number_format(${'totPCArea' . $k} / ${'totWDArea' . $k}, 1) . '</td><!-- <td>' . number_format(${'totPCArea' . $k}) . '</td> --><td>' . number_format(${'totWDArea' . $k}) . '</td>';
                                                }
                                                if ($region_name_current == $v['region_name']) {
                                                    ${'totFRegion' . $k} = ${'totFRegion' . $k} + ${'totFArea' . $k};
                                                    ${'totPCRegion' . $k} = ${'totPCRegion' . $k} + ${'totPCArea' . $k};
                                                    ${'totWDRegion' . $k} = ${'totWDRegion' . $k} + ${'totWDArea' . $k};
                                                }
                                                ${'totFArea' . $k} = 0;
                                            }
                                            echo '<tr style="font-weight:bold;">'
                                            . '<td class="sticky-col first-col" >' . $rname . '</td>'
                                            . '<td class="sticky-col first-col" >' . $areaNameCurrent . '</td>'
                                            . '<td class="sticky-col first-col" >Total</td>'
                                            . '<td></td>'
                                            . '<td></td>'
                                            . $AreastrRowFootWithPC
                                            . '<td>' . number_format($AreaTotal) . '</td>'
                                            . '<td class="text-right" style="font-weight:bold;">' . number_format($AreatotF) . '</td>'
                                            . '<td>' . ((($AreatotVarienceValue) < 0 ? "(" . number_format(abs($AreatotVarienceValue)) . ")" : number_format($AreatotVarienceValue))) . '</td>'
                                            . '<td>' . ($PP) . '%</td>'
                                            . '<td>' . $AreatotCurrentWorkingDays . '</td>'
                                            . '<td>' . ((($AreatotWorkingDayVarience) < 0 ? "(" . number_format(abs($AreatotWorkingDayVarience)) . ")" : number_format($AreatotWorkingDayVarience))) . '</td>'
                                            . '<td>' . $avgVal . '</td>'
                                            . '<td>' . $avgPC . '</td>'
                                            . '<td class="text-right" style="background: #efebb9;font-weight:bold;">' . number_format($AreatotPcF) . '</td>'
                                            . $strBackFootArea
                                            . '</tr>';
                                            $areaNameCurrent = $v['area_name'];
                                            $AreatotF = $v[$monthName . '-Total'];
                                            $AreaTotal = $targetVal; //area total Target
                                            $AreatotPcF = $rowTotPc;
                                            $AreatotVarienceValue = $varienceValue;
                                            $AreastrRowFootWithPC = '';
                                            $AreatotWorkingDayVarience = $workingDayVarience; //AREA TOTAL
                                            $AreatotCurrentWorkingDays = $actual_working_count; //AREA TOTAL

                                            for ($k = 1; $k <= 6; $k++) {
                                                $monthNumberBack = date('m', strtotime($datepickermonth . ' -' . $k . ' month'));
                                                $monthNameBack = date('F', strtotime($datepickermonth . ' -' . $k . ' month'));

                                                if (!empty($categoryID) && isset($categoryID) && $categoryID != null) {//category pc requested need to get working days including categor bill dates and not billed dates 
                                                    if (!empty($getTotalSalesandPc) && isset($getTotalSalesandPc)) {
                                                        foreach ($getTotalSalesandPc as $p) {
                                                            if ($v['ag_cd'] === $p['ag_cd']) {
                                                                if (!empty($getTotalSalesandPcFull) && isset($getTotalSalesandPcFull)) {
                                                                    foreach ($getTotalSalesandPcFull as $pcFull) {
                                                                        if ($p['ag_cd'] == $pcFull['ag_cd']) {
                                                                            
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                } else {
                                                    if (!empty($getTotalSalesandPc) && isset($getTotalSalesandPc)) {
                                                        foreach ($getTotalSalesandPc as $p) {
                                                            if ($v['ag_cd'] === $p['ag_cd']) {
                                                                if ($areaNameCurrent == $v['area_name']) {
                                                                    ${'totPCArea' . $k} = $p[$monthNameBack . '_TotPC'];
                                                                    ${'totWDArea' . $k} = $p[$monthNameBack . '_WD'];
                                                                } else {
                                                                    
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                                if ($areaNameCurrent == $v['area_name']) {
                                                    ${'totFArea' . $k} = $v[$monthNameBack . '-Total'];
                                                } else {
                                                    
                                                }
                                            }
                                            $strBackFootArea = '';

                                            //PRINT REGION TOTALS
                                            if ($region_name_current != $v['region_name']) {//to print a new region but total lines are in old region
                                                for ($n = 1; $n <= date('t', strtotime($datepickermonth)); $n++) {
                                                    /*
                                                      $RegionstrRowFootWithPC .= '<td class="text-right">' . number_format(${'tot' . sprintf("%02d", $n) . '_region'}) . '</td>'
                                                      . '<td class="text-right" style="background: #efebb9;">' . number_format(${'tot' . sprintf("%02d", $n) . '_pc_region'}) . '</td>';  //AREA SUMMERY

                                                     */
                                                    $RegionstrRowFootWithPC .= '<td class="text-right">' . number_format(${'tot' . sprintf("%02d", $n) . '_region'}) . '</td>'
                                                            . '<td class="text-right" style="background: #efebb9;">-</td>';  //AREA SUMMERY
                                                    ///RESET VALUES OF AREA TO NEW AREA
                                                    ${'tot' . sprintf("%02d", $n) . '_region'} = 0; // $v[$monthName . '-' . $n];
                                                    ${'tot' . sprintf("%02d", $n) . '_pc_region'} = 0; // $v[$monthName . '-' . $n . '-pc'];
                                                }
                                                $PP = 'target not set';
                                                if ($RegionTotal != 0) {
                                                    $PP = number_format(($RegiontotF / $RegionTotal) * 100);
                                                }
                                                $avgValR = 0;
                                                $avgPCR = 0;
                                                if ($RegiontotCurrentWorkingDays != 0) {
                                                    $avgValR = number_format($RegiontotF / $RegiontotCurrentWorkingDays);
                                                    $avgPCR = number_format($RegiontotPcF / $RegiontotCurrentWorkingDays, 1);
                                                } else {
                                                    $avgPCR = $avgValR = 'NA';
                                                }

                                                for ($k = 1; $k <= 6; $k++) {
                                                    if (${'totWDRegion' . $k} == 0) {
                                                        $strBackFootRegion .= '<td class="text-right">' . number_format(${'totFRegion' . $k}) . '</td><td>NA</td><!-- <td>' . number_format(${'totPCRegion' . $k}) . '</td> --><td>' . number_format(${'totWDRegion' . $k}) . '</td>';
                                                    } else {
                                                        $strBackFootRegion .= '<td class="text-right">' . number_format(${'totFRegion' . $k}) . '</td><td>' . number_format(${'totPCRegion' . $k} / ${'totWDRegion' . $k}, 1) . '</td><!-- <td>' . number_format(${'totPCRegion' . $k}) . '</td> --><td>' . number_format(${'totWDRegion' . $k}) . '</td>';
                                                    }

                                                    /* ${'totFArea' . $k} = 0;
                                                      if ($region_name_current == $v['region_name']) {
                                                      ${'totFRegion' . $k} = ${'totFRegion' . $k} + ${'totFArea' . $k};
                                                      ${'totPCRegion' . $k} = ${'totPCRegion' . $k} + ${'totPCArea' . $k};
                                                      ${'totWDRegion' . $k} = ${'totWDRegion' . $k}+ ${'totWDArea' . $k};
                                                      } */
                                                }

                                                echo '<tr style="font-weight:bold;">'
                                                . '<td class="sticky-col first-col">' . $rname . '</td>'
                                                . '<td colspan="4" style="z-index: 6;" >' . $rname . ' Total ' . '' . '</td>'
                                                . $RegionstrRowFootWithPC
                                                . '<td>' . number_format($RegionTotal) . '</td>'
                                                . '<td class="text-right" style="font-weight:bold;">' . number_format($RegiontotF) . '</td>'
                                                . '<td>' . ((($RegiontotVarienceValue) < 0 ? "(" . number_format(abs($RegiontotVarienceValue)) . ")" : number_format($RegiontotVarienceValue))) . '</td>'
                                                . '<td>' . ($PP) . '%</td>'
                                                . '<td>' . $RegiontotCurrentWorkingDays . '</td>'
                                                . '<td>' . ((($RegiontotWorkingDayVarience) < 0 ? "(" . number_format(abs($RegiontotWorkingDayVarience)) . ")" : number_format($RegiontotWorkingDayVarience))) . '</td>'
                                                . '<td>' . $avgValR . '</td>'
                                                . '<td>' . $avgPCR . '</td>'
                                                . '<td class="text-right" style="background: #efebb9;font-weight:bold;">' . number_format($RegiontotPcF) . '</td>'
                                                . $strBackFootRegion
                                                . '</tr>';
                                                $region_name_current = $v['region_name'];
                                                $strTest = $v['ag_name'];
                                                $RegionstrRowFootWithPC = '';
                                                $RegionTotal = $targetVal;
                                                $RegiontotF = $v[$monthName . '-Total'];
                                                $RegiontotVarienceValue = $varienceValue;
                                                $RegiontotCurrentWorkingDays = $actual_working_count;
                                                $RegiontotWorkingDayVarience = $workingDayVarience;
                                                $RegiontotPcF = $rowTotPc; //AREA TOTAL
                                                $strBackFootRegion = '';
                                                for ($n = 1; $n <= date('t', strtotime($datepickermonth)); $n++) {
                                                    if ($region_name_current == $v['region_name']) {
                                                        $strTest .= $v['ag_name'];
                                                        ${'tot' . sprintf("%02d", $n) . '_region'} = ${'tot' . sprintf("%02d", $n) . '_region'} + $v[$monthName . '-' . $n];
                                                        ${'tot' . sprintf("%02d", $n) . '_pc_region'} = ${'tot' . sprintf("%02d", $n) . '_pc_region'} + $v[$monthName . '-' . $n . '-pc'];
                                                    }
                                                }
                                            }
                                        }
                                    }

                                    echo '<tr>'
                                    . '<td class="sticky-col first-col" >' . $v['region_name'] . '</td>'
                                    . '<td class="sticky-col first-col" >' . $v['area_name'] . '</td>'
                                    . '<td class="sticky-col first-col" >' . $v['ag_name'] . '</td>'
                                    . '<td>' . $v['ag_cd'] . '</td>'
                                    . '<td>' . $v['cd'] . '</td>'
                                    . $strRowWithPc
                                    . '<td class="text-right" style="font-weight:bold;">' . number_format($targetVal) . '</td>'
                                    . '<td class="text-right" style="font-weight:bold;">' . number_format($v[$monthName . '-Total']) . '</td>'
                                    . '<td>' . (($varienceValue) < 0 ? "(" . number_format(abs($varienceValue)) . ")" : number_format($varienceValue)) . '</td>'
                                    . '<td>' . ($persentage) . '%</td>'
                                    . '<td>' . $actual_working_count . '</td>'
                                    . '<td>' . ((($workingDayVarience) < 0 ? "(" . number_format(abs($workingDayVarience)) . ")" : number_format($workingDayVarience))) . '</td>'
                                    . '<td>' . ($avgSale) . '</td>'
                                    . '<td>' . ($avgPCperDay) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;font-weight:bold;">' . number_format($rowTotPc) . '</td>'
                                    . $strBackValues
                                    . '</tr>';

                                    if ($areaNameCurrent == $v['area_name']) {//we are in same area
                                        if (count($DailySalesQty) == $currentRow) {///and we are in the last row 
                                            for ($n = 1; $n <= date('t', strtotime($datepickermonth)); $n++) {
                                                /*
                                                  $AreastrRowFootWithPC .= '<td class="text-right">' . number_format(${'tot' . sprintf("%02d", $n) . '_area'}) . '</td>'
                                                  . '<td class="text-right" style="background: #efebb9;">' . number_format(${'tot' . sprintf("%02d", $n) . '_pc_area'}) . '</td>';
                                                 */
                                                $AreastrRowFootWithPC .= '<td class="text-right">' . number_format(${'tot' . sprintf("%02d", $n) . '_area'}) . '</td>'
                                                        . '<td class="text-right" style="background: #efebb9;">-</td>';
                                                //AREA SUMMERY
                                            }

                                            $PP = 'target not set';
                                            if ($AreaTotal != 0) {
                                                $PP = number_format(($AreatotF / $AreaTotal) * 100);
                                            }
                                            if ($region_name_current != $v['region_name']) {//to print a new region but total lines are in old region
                                                $rname = $region_name_current;
                                            } else {
                                                $rname = $v['region_name'];
                                            }

                                            for ($k = 1; $k <= 6; $k++) {
                                                /*
                                                  if(${'totWDArea' . $k}==0){
                                                  $strBackFootArea .= '<td class="text-right">' . number_format(${'totFArea' . $k}) . '</td><td>NA</td><!-- <td>' . number_format(${'totPCArea' . $k}) . '</td> --><td>' . number_format(${'totWDArea' . $k}) . '</td>';
                                                  }else{
                                                  $strBackFootArea .= '<td class="text-right">' . number_format(${'totFArea' . $k}) . '</td><td>' . number_format(${'totPCArea' . $k} / ${'totWDArea' . $k}, 1) . '</td> <!-- <td>' . number_format(${'totPCArea' . $k}) . '</td> --><td>' . number_format(${'totWDArea' . $k}) . '</td>';
                                                  }
                                                 */
                                                if (${'totWDArea' . $k} == 0) {
                                                    $strBackFootArea .= '<td class="text-right">' . number_format(${'totFArea' . $k}) . '</td><td>NA</td> <td>' . number_format(${'totWDArea' . $k}) . '</td>';
                                                } else {
                                                    $strBackFootArea .= '<td class="text-right">' . number_format(${'totFArea' . $k}) . '</td><td>' . number_format(${'totPCArea' . $k} / ${'totWDArea' . $k}, 1) . '</td> <td>' . number_format(${'totWDArea' . $k}) . '</td>';
                                                }
                                                ${'totFArea' . $k} = 0;
                                            }
                                            $workingDaysDevision = '';
                                            if($AreatotCurrentWorkingDays!=0){
                                               $workingDaysDevision = number_format($AreatotF / $AreatotCurrentWorkingDays); 
                                           }else{
                                            $workingDaysDevision ='NA';
                                           }

                                           $workingDaysDevisionPc = '';
                                           if($AreatotCurrentWorkingDays!=0){
                                              $workingDaysDevisionPc = number_format($AreatotPcF / $AreatotCurrentWorkingDays, 1);
                                           }else{
                                            $workingDaysDevisionPc ='NA';
                                           } 

                                            echo '<tr style="font-weight:bold;">'
                                            . '<td class="sticky-col first-col" >' . $rname . '</td>'
                                            . '<td class="sticky-col first-col" >' . $areaNameCurrent . '</td>'
                                            . '<td class="sticky-col first-col" >Total</td>'
                                            . '<td></td>'
                                            . '<td></td>'
                                            . $AreastrRowFootWithPC
                                            . '<td>' . number_format($AreaTotal) . '</td>'
                                            . '<td class="text-right" style="font-weight:bold;">' . number_format($AreatotF) . '</td>'
                                            . '<td>' . ((($AreatotVarienceValue) < 0 ? "(" . number_format(abs($AreatotVarienceValue)) . ")" : number_format($AreatotVarienceValue))) . '</td>'
                                            . '<td>' . ($PP) . '%</td>'
                                            . '<td>' . $AreatotCurrentWorkingDays . '</td>'
                                            . '<td>' . ((($AreatotWorkingDayVarience) < 0 ? "(" . number_format(abs($AreatotWorkingDayVarience)) . ")" : number_format($AreatotWorkingDayVarience))) . '</td>'
                                            . '<td>' . $workingDaysDevision . '</td>'
                                            . '<td>' .  $workingDaysDevisionPc     . '</td>'
                                            . '<td class="text-right" style="background: #efebb9;font-weight:bold;">' . number_format($AreatotPcF) . '</td>'
                                            . $strBackFootArea
                                            . '</tr>';
                                            $areaNameCurrent = $v['area_name'];
                                            $AreatotF = $v[$monthName . '-Total'];
                                            $AreaTotal = $targetVal; //area total Target                                            
                                            $AreatotPcF = $rowTotPc;
                                            $AreatotVarienceValue = $varienceValue;
                                            $AreatotWorkingDayVarience = $workingDayVarience; //AREA TOTAL
                                            $AreatotCurrentWorkingDays = $actual_working_count; //AREA TOTAL   
                                            //
                                            //
                                            //
                                            //PRINT REGION SUMMERY
                                            for ($n = 1; $n <= date('t', strtotime($datepickermonth)); $n++) {
                                                /*
                                                  $RegionstrRowFootWithPC .= '<td class="text-right">' . number_format(${'tot' . sprintf("%02d", $n) . '_region'}) . '</td>'
                                                  . '<td class="text-right" style="background: #efebb9;">' . number_format(${'tot' . sprintf("%02d", $n) . '_pc_region'}) . '</td>';  //AREA SUMMERY
                                                 */
                                                $RegionstrRowFootWithPC .= '<td class="text-right">' . number_format(${'tot' . sprintf("%02d", $n) . '_region'}) . '</td>'
                                                        . '<td class="text-right" style="background: #efebb9;"></td>';  //AREA SUMMERY
                                                ///RESET VALUES OF AREA TO NEW AREA
                                                //${'tot' . sprintf("%02d", $n) . '_region'} = $v[$monthName . '-' . $n];
                                                //${'tot' . sprintf("%02d", $n) . '_pc_region'} = $v[$monthName . '-' . $n . '-pc'];
                                            }
                                            $PP = 'target not set';
                                            if ($RegionTotal != 0) {
                                                $PP = number_format(($RegiontotF / $RegionTotal) * 100);
                                            }
                                            $avgValR = 0;
                                            $avgPCR = 0;
                                            if ($RegiontotCurrentWorkingDays != 0) {
                                                $avgValR = number_format($RegiontotF / $RegiontotCurrentWorkingDays);
                                                $avgPCR = number_format($RegiontotPcF / $RegiontotCurrentWorkingDays, 1);
                                            } else {
                                                $avgPCR = $avgValR = 'NA';
                                            }
                                            
                                            echo '<tr style="font-weight:bold;">'
                                            . '<td class="sticky-col first-col">' . $rname . '</td>'
                                            . '<td colspan="4" style="z-index: 6;" >' . $rname . ' Total ' . '' . '</td>'
                                            . $RegionstrRowFootWithPC
                                            // . '<td>' . number_format($RegionTotal) . '</td>'
                                             . '<td></td>'
                                            . '<td class="text-right" style="font-weight:bold;">' . number_format($RegiontotF) . '</td>'
                                            . '<td>' . ((($RegiontotVarienceValue) < 0 ? "(" . number_format(abs($RegiontotVarienceValue)) . ")" : number_format($RegiontotVarienceValue))) . '</td>'
                                            . '<td>' . ($PP) . '%</td>'
                                            . '<td>' . $RegiontotCurrentWorkingDays . '</td>'
                                            . '<td>' . ((($RegiontotWorkingDayVarience) < 0 ? "(" . number_format(abs($RegiontotWorkingDayVarience)) . ")" : number_format($RegiontotWorkingDayVarience))) . '</td>'
                                            . '<td>' . $avgValR . '</td>'
                                            . '<td>' . $avgPCR . '</td>'
                                            . '<td class="text-right" style="background: #efebb9;font-weight:bold;">' . number_format($RegiontotPcF) . '</td>'
                                            . $strBackFootArea
                                            . '</tr>';
                                            //echo $strTest;
                                        }
                                    } else {
                                        if (!empty($AreaID) && isset($AreaID) && $AreaID == '-1' && count($DailySalesQty) == $currentRow) {//in last row -all island report requested
                                            for ($n = 1; $n <= date('t', strtotime($datepickermonth)); $n++) {
                                                ///RESET VALUES OF AREA TO NEW AREA
                                                //${'tot' . sprintf("%02d", $n) . '_area'} = $v[$monthName . '-' . $n];
                                                //${'tot' . sprintf("%02d", $n) . '_pc_area'} = $v[$monthName . '-' . $n . '-pc'];
                                                $AreastrRowFootWithPC .= '<td class="text-right">' . number_format(${'tot' . sprintf("%02d", $n) . '_area'}) . '</td>'
                                                        . '<td class="text-right" style="background: #efebb9;">' . number_format(${'tot' . sprintf("%02d", $n) . '_pc_area'}) . '</td>';  //AREA SUMMERY
                                            }

                                            $PP = 'target not set';
                                            if ($AreaTotal != 0) {
                                                $PP = number_format(($AreatotF / $AreaTotal) * 100);
                                            }
                                            $rname = '';
                                            if ($region_name_current != $v['region_name']) {//to print a new region but total lines are in old region
                                                $rname = $region_name_current;
                                            } else {
                                                $rname = $v['region_name'];
                                            }

                                            for ($k = 1; $k <= 6; $k++) {
                                                $strBackFootArea .= '<td class="text-right">' . number_format(${'totFArea' . $k}) . '</td><td>' . number_format(${'totPCArea' . $k} / ${'totWDArea' . $k}, 1) . '</td><!-- <td>' . number_format(${'totPCArea' . $k}) . '</td> --><td>' . number_format(${'totWDArea' . $k}) . '</td>';
                                                ${'totFArea' . $k} = 0;
                                            }

                                           

                                            echo '<tr style="font-weight:bold;">'
                                            . '<td class="sticky-col first-col" >' . $rname . '</td>'
                                            . '<td class="sticky-col first-col" >' . $areaNameCurrent . '</td>'
                                            . '<td class="sticky-col first-col" >Total</td>'
                                            . '<td></td>'
                                            . '<td></td>'
                                            . $AreastrRowFootWithPC
                                            . '<td>' . number_format($AreaTotal) . '</td>'
                                            . '<td class="text-right" style="font-weight:bold;">' . number_format($AreatotF) . '</td>'
                                            . '<td>' . ((($AreatotVarienceValue) < 0 ? "(" . number_format(abs($AreatotVarienceValue)) . ")" : number_format($AreatotVarienceValue))) . '</td>'
                                            . '<td>' . ($PP) . '%</td>'
                                            . '<td>' . $AreatotCurrentWorkingDays . '</td>'
                                            . '<td>' . ((($AreatotWorkingDayVarience) < 0 ? "(" . number_format(abs($AreatotWorkingDayVarience)) . ")" : number_format($AreatotWorkingDayVarience))) . '</td>'
                                            . '<td>' . number_format($AreatotF / $AreatotCurrentWorkingDays) . '</td>'
                                            . '<td>' . number_format($AreatotPcF / $AreatotCurrentWorkingDays, 1) . '</td>'
                                            . '<td class="text-right" style="background: #efebb9;font-weight:bold;">' . number_format($AreatotPcF) . '</td>'
                                            . $strBackFootArea
                                            . '</tr>';
                                            $areaNameCurrent = $v['area_name'];
                                            $AreatotF = $v[$monthName . '-Total'];
                                            $AreaTotal = $targetVal; //area total Target
                                            $AreatotPcF = $rowTotPc;
                                            $AreatotVarienceValue = $varienceValue;
                                            $AreatotWorkingDayVarience = $workingDayVarience; //AREA TOTAL
                                            $AreatotCurrentWorkingDays = $actual_working_count; //AREA TOTAL    
                                            //
                                            //
                                            //
                                            //PRINT REGION SUMMERY
                                            for ($n = 1; $n <= date('t', strtotime($datepickermonth)); $n++) {
                                                $RegionstrRowFootWithPC .= '<td class="text-right">' . number_format(${'tot' . sprintf("%02d", $n) . '_region'}) . '</td>'
                                                        . '<td class="text-right" style="background: #efebb9;">' . number_format(${'tot' . sprintf("%02d", $n) . '_pc_region'}) . '</td>';  //AREA SUMMERY
                                                ///RESET VALUES OF AREA TO NEW AREA
                                                //${'tot' . sprintf("%02d", $n) . '_region'} = $v[$monthName . '-' . $n];
                                                //${'tot' . sprintf("%02d", $n) . '_pc_region'} = $v[$monthName . '-' . $n . '-pc'];
                                            }
                                            $PP = 'target not set';
                                            if ($RegionTotal != 0) {
                                                $PP = number_format(($RegiontotF / $RegionTotal) * 100);
                                            }
                                            $avgValR = 0;
                                            $avgPCR = 0;
                                            if ($RegiontotCurrentWorkingDays != 0) {
                                                $avgValR = number_format($RegiontotF / $RegiontotCurrentWorkingDays);
                                                $avgPCR = number_format($RegiontotPcF / $RegiontotCurrentWorkingDays, 1);
                                            } else {
                                                $avgPCR = $avgValR = 'NA';
                                            }
                                            

                                            echo '<tr style="font-weight:bold;">'
                                            . '<td class="sticky-col first-col">' . $rname . '</td>'
                                            . '<td colspan="4" style="z-index: 6;">' . $rname . ' Total</td>'
                                            . $RegionstrRowFootWithPC
                                            . '<td>' . number_format($RegionTotal) . '</td>'
                                            . '<td class="text-right" style="font-weight:bold;">' . number_format($RegiontotF) . '</td>'
                                            . '<td>' . ((($RegiontotVarienceValue) < 0 ? "(" . number_format(abs($RegiontotVarienceValue)) . ")" : number_format($RegiontotVarienceValue))) . '</td>'
                                            . '<td>' . ($PP) . '%</td>'
                                            . '<td>' . $RegiontotCurrentWorkingDays . '</td>'
                                            . '<td>' . ((($RegiontotWorkingDayVarience) < 0 ? "(" . number_format(abs($RegiontotWorkingDayVarience)) . ")" : number_format($RegiontotWorkingDayVarience))) . '</td>'
                                            . '<td>' . $avgValR . '</td>'
                                            . '<td>' . $avgPCR . '</td>'
                                            . '<td class="text-right" style="background: #efebb9;font-weight:bold;">' . number_format($RegiontotPcF) . '</td>'
                                            . $strBackFootArea
                                            . '</tr>';
                                        }
                                    }
                                }


                                for ($n = 1; $n <= date('t', strtotime($datepickermonth)); $n++) {

                                    $strRowFootWithPC .= '<td class="text-right">' . number_format(${'tot' . sprintf("%02d", $n) . '_v' }) . '</td>'
                                            . '<td class="text-right" style="background: #efebb9;">' . number_format(${'tot' . sprintf("%02d", $n) . '_pc'}) . '</td>';
                                }
                                ?>
                            </tbody>
                            <tfoot>
    <?php
    $PP = 'target not set';
    if ($totTarget != 0) {
        $PP = number_format(($totF / $totTarget) * 100);
    }




    // echo '<tr style="font-weight:bold;">'
    // . '<td colspan="5">Total</td>'
    // . $strRowFootWithPC
    // // . '<td>' . number_format($totTarget) . '</td>'
    //     . '<td>' . number_format($totTarget) . '</td>'
    // . '<td class="text-right" style="font-weight:bold;">' . number_format($totF) . '</td>'
    // . '<td>' . ((($totVarienceValue) < 0 ? "(" . number_format(abs($totVarienceValue)) . ")" : number_format($totVarienceValue))) . '</td>'
    // . '<td>' . ($PP) . '%</td>'
    // . '<td>' . ($totCurrentWorkingDays) . '</td>'
    // . '<td>' . ((($totWorkingDayVarience) < 0 ? "(" . number_format(abs($totWorkingDayVarience)) . ")" : number_format($totWorkingDayVarience))) . '</td>'
    // . '<td>' . number_format($totF / $totCurrentWorkingDays) . '</td>'
    // . '<td>' . number_format($totPcF / $totCurrentWorkingDays, 1) . '</td>'
    // . '<td class="text-right" style="background: #efebb9;font-weight:bold;">' . number_format($totPcF) . '</td>'
    // . $strBackFoot
    // . '</tr>';
    // ?>
    //                         </tfoot>
                        </table>

                        <div class="box-body chart-responsive">
                            <div class="chart" id="line-chart" style="height: 300px;"></div>
                        </div>

    <?php
}
?>
                </div>
            </div>


        </div>


        <div class="col-md-12">
            <a target="_blank" href="<?= base_url('androidapp/Dongle-Re-Collection.docx') ?>" class="small-box-footer">
                <div class="col-md-6 col-xs-12">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>Dongle Re-collection Document</h3>
                            <p>Click to Download (For Agency Termination)</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-heart"></i>
                        </div> 
                    </div>
                </div>
            </a>
            
            <a target="_blank" href="<?= base_url('androidapp/DONGLE_AGREEMENT.pdf') ?>" class="small-box-footer">
                <div class="col-md-6 col-xs-12">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>Dongle Issuing Document</h3>
                            <p>Click to Download (For Newly Appointed Agency)</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-heart"></i>
                        </div> 
                    </div>
                </div>
            </a>
        </div>
    </section>
</div>

<!-- /.content -->
</div><!-- /.content-wrapper -->
<script type="text/javascript" src="https://adminlte.io/themes/AdminLTE/bower_components/raphael/raphael.min.js"></script>
<script type="text/javascript" src="https://adminlte.io/themes/AdminLTE/bower_components/morris.js/morris.min.js"></script>

<script>
                            $('#sbRange').on('change', function (e) {
                                // If you just need "value" (which's like having "key" of an associative-array).
                                var selectedValue = this.value;
                                $('.cat-box:not(.' + selectedValue + ')').hide(500);
                                $('.' + selectedValue).show(500);
                                // Else.
                                //var $selectedOptionElement = $("option:selected", this);
                                //var selectedValue = $selectedOptionElement.val();
                                //var selectedText = $selectedOptionElement.text();

                            });
                            $("#sbRange").trigger("change");
                            function setCategory(id) {
                                $('#category').val(id);
                                document.getElementById("myForm").submit();
                            }



                            const tables = document.querySelectorAll('table');
                            for (let table of tables) {
                                let headerCell = null;
                                let headerCell2 = null;
                                let i = 1;
                                for (let row of table.rows) {
                                    const firstCell = row.cells[0];
                                    let firstCell2 = row.cells[1];

                                    firstCell.style.backgroundColor = "yellow";
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
                                    firstCell2.style.backgroundColor = "#00ff95";
                                    firstCell2.style.verticalAlign = "middle";
                                    firstCell2.style.fontSize = "20px";
                                    firstCell2.style.fontWeight = "bold";
                                    //alert(firstCell2.innerText+i);
                                    if (headerCell2 === null || firstCell2.innerText !== headerCell2.innerText) {
                                        headerCell2 = firstCell2;
                                    } else {
                                        headerCell2.rowSpan++;
                                        firstCell2.remove();
                                    }
                                    i += 1;
                                }
                            }
                            //Column 2 merge same values
                            /*for (let table of tables) {
                             let headerCell2 = null;
                             for (let row of table.rows) {
                             const firstCell2 = row.cells[1];
                             firstCell2.style.backgroundColor = "red";
                             firstCell2.style.verticalAlign = "middle";
                             firstCell2.style.fontSize = "20px";
                             firstCell2.style.fontWeight = "bold";
                             alert(firstCell2.innerText);
                             if (headerCell2 === null || firstCell2.innerText !== headerCell2.innerText) {
                             headerCell2 = firstCell2;
                             } else {
                             headerCell2.rowSpan++;
                             firstCell2.remove();
                             }
                             }
                             }*/
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