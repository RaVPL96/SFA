<?php include_once BASEPATH . ('../application/views/template/leftsidebar.php'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard (<?= str_replace(' - ', ' to ', $DateRange) ?>)
            <small>Control Panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <?php
            $chartDataOverall = '';
            $chartData = '';
            if (!empty($SalesData) && isset($SalesData)) {//this is for ase
                $totTarget = 0;
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

                $strTerritorySummery = '';
                $strTerritory = '';
                $territory_reference_code = 0;
                $strRange_id = '';
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

                $totalRows = count($SalesDataTerritory);
                $c = 0;
                foreach ($SalesDataTerritory as $s) {

                    $c = $c + 1;
                    //echo $c . $s['territory_name'] . '<br>';
                    if ($strTerritory == '') {
                        $strTerritory = $s['territory_name'];
                        $territory_reference_code = $s['reference_code'];
                        $strTerritory_id = $s['id'];
                        $strArea_id = $s['area_id'];
                        $strRange_id = $s['range_id'];
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
                    if ($strTerritory != $s['territory_name'] || $c == $totalRows) {

                        $target = 0;
                        if (!empty($targetData) && isset($targetData)) {
                            foreach ($targetData as $t) {
                                if ($t['ag_cd'] == $territory_reference_code) {
                                    $target = $t[strtolower($s['range_name']) . '_target'];
                                    $totTarget = $totTarget + $target;
                                }
                            }
                        }

                        $dt = str_replace('/', '-', trim(str_replace(' - ', '~', trim($DateRange))));

                        $percent = '-';
                        if ($target == 0) {
                            $percent = 'Target Not Set';
                        } else {
                            $percent = number_format(($totTerrAValue / $target) * 100);
                        }
                        if ($totTerrBValue == 0) {
                            $totTerrBValue = 1;
                        }
                        $chartData .= ''
                                . '<div class="col-md-6">
                                    <div class="box box-widget widget-user">
                                        <div class="small-box bg-green">
                                            <div class="inner">
                                                <h3>' . $strTerritory . '</h3>
                                                <h3>' . $percent . '<sup style="font-size: 20px">%</sup><sub style="font-size: 18px">Achieved so far from Rs. ' . number_format($target) . '</sub></h3>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-stats-bars"></i>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-sm-4 border-right">
                                                        <div class="description-block">
                                                            <h5 class="description-header">Rs. ' . number_format($totTerrAValue) . '<br>(' . number_format(($totTerrAValue / $totTerrBValue) * 100, 1) . ' %)</h5>
                                                            <span class="description-text">ACTUAL SALES</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4 border-right">
                                                        <div class="description-block">
                                                            <h5 class="description-header">Rs. ' . number_format($totTerrCValue) . '<br>(' . number_format(($totTerrCValue / $totTerrBValue) * 100, 1) . ' %)</h5>
                                                            <span class="description-text">Cancel Value</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="description-block">
                                                            <h5 class="description-header">Rs. ' . number_format(($totTerrMValue + $totTerrGValue)) . '<br>(' . number_format((($totTerrMValue + $totTerrGValue) / $totTerrAValue) * 100, 1) . '%)</h5>
                                                            <span class="description-text">Return Value</span>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <a target="_blank" href="' . base_url('salesreports/areaSummery/null/' . $strArea_id . '/' . $strRange_id . '/' . $strTerritory_id . '/' . $dt . '/A') . '" class="small-box-footer">
                                                More info <i class="fa fa-arrow-circle-right"></i>
                                            </a>
                                        </div>
                                    </div>

                                </div>';
                        if ($strTerritory != $s['territory_name'] && $c == $totalRows) {//1 last row with differ area territory
                            $strTerritory = $s['territory_name'];
                            $territory_reference_code = $s['reference_code'];
                            $strTerritory_id = $s['id'];
                            $strArea_id = $s['area_id'];
                            $strRange_id = $s['range_id'];

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

                            $target = 0;
                            if (!empty($targetData) && isset($targetData)) {
                                foreach ($targetData as $t) {
                                    if ($t['ag_cd'] == $territory_reference_code) {
                                        $target = $t[strtolower($s['range_name']) . '_target'];
                                        $totTarget = $totTarget + $target;
                                    }
                                }
                            }

                            $dt = str_replace('/', '-', trim(str_replace(' - ', '~', trim($DateRange))));

                            $percent = '-';
                            if ($target == 0) {
                                $percent = 'Target Not Set';
                            } else {
                                $percent = number_format(($totTerrAValue / $target) * 100);
                            }
                            if ($totTerrBValue == 0) {
                                $totTerrBValue = 1;
                            }
                            $chartData .= ''
                                    . '<div class="col-md-6">
                                    <div class="box box-widget widget-user">
                                        <div class="small-box bg-green">
                                            <div class="inner">
                                                <h3>' . $strTerritory . '</h3>
                                                <h3>' . $percent . '<sup style="font-size: 20px">%</sup><sub style="font-size: 18px">Achieved so far from Rs. ' . number_format($target) . '</sub></h3>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-stats-bars"></i>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-sm-4 border-right">
                                                        <div class="description-block">
                                                            <h5 class="description-header">Rs. ' . number_format($totTerrAValue) . '<br>(' . number_format(($totTerrAValue / $totTerrBValue) * 100) . ' %)</h5>
                                                            <span class="description-text">ACTUAL SALES</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4 border-right">
                                                        <div class="description-block">
                                                            <h5 class="description-header">Rs. ' . number_format($totTerrCValue) . '<br>(' . number_format(($totTerrCValue / $totTerrBValue) * 100) . ' %)</h5>
                                                            <span class="description-text">Cancel Value</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="description-block">
                                                            <h5 class="description-header">Rs. ' . number_format(($totTerrMValue + $totTerrGValue)) . '<br>(' . number_format((($totTerrMValue + $totTerrGValue) / $totTerrAValue) * 100) . '%)</h5>
                                                            <span class="description-text">Return Value</span>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <a target="_blank" href="' . base_url('salesreports/areaSummery/null/' . $strArea_id . '/' . $strRange_id . '/' . $strTerritory_id . '/' . $dt . '/A') . '" class="small-box-footer">
                                                More info <i class="fa fa-arrow-circle-right"></i>
                                            </a>
                                        </div>
                                    </div>

                                </div>';
                        }
                        $strTerritory = $s['territory_name'];
                        $territory_reference_code = $s['reference_code'];
                        $strTerritory_id = $s['id'];
                        $strArea_id = $s['area_id'];
                        $strRange_id = $s['range_id'];

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
                    $dateBill = '';
                    if ($billMethod == 'B') {
                        $dateBill = $s['date_book'];
                    } elseif ($billMethod == 'A') {
                        $dateBill = $s['date_actual'];
                    }
                }
                if ($billMethod == 'B') {
                    $totCancelPC = '-';
                    $totCValue = '-';
                    $totAValue = '-';
                }
                $chartDataOverall .= ''
                        . '<div class="col-md-12">
                                    <div class="box box-widget widget-user">
                                        <div class="small-box bg-navy">
                                            <div class="inner">
                                                <h3>Summery</h3>
                                                <h3>' . number_format(($totAValue / $totTarget) * 100) . '<sup style="font-size: 20px">%</sup><sub style="font-size: 18px">Achieved so far from Rs. ' . number_format($totTarget) . '</sub></h3>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-stats-bars"></i>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-sm-4 border-right">
                                                        <div class="description-block">
                                                            <h5 class="description-header">Rs. ' . number_format($totAValue) . '<br>(' . number_format(($totAValue / $totBValue) * 100) . ' %)</h5>
                                                            <span class="description-text">ACTUAL SALES</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4 border-right">
                                                        <div class="description-block">
                                                            <h5 class="description-header">Rs. ' . number_format($totCValue) . '<br>(' . number_format(($totCValue / $totBValue) * 100) . ' %)</h5>
                                                            <span class="description-text">Cancel Value</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="description-block">
                                                            <h5 class="description-header">Rs. ' . number_format(($totMValue + $totGValue)) . '<br>(' . number_format((($totMValue + $totGValue) / $totAValue) * 100) . '%)</h5>
                                                            <span class="description-text">Return Value</span>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <a target="_blank" href="' . base_url('salesreports/areaSummery/null/' . $strArea_id . '/' . $strRange_id . '/null/' . $dt . '/A') . '" class="small-box-footer">
                                                More info <i class="fa fa-arrow-circle-right"></i>
                                            </a>
                                        </div>
                                    </div>

                                </div>';
            }
            ?>
            <?= $chartDataOverall ?>
            <?= $chartData ?>

            <!-- DASHBOARD FOR OTHER USERS-->
            <?php
            $areaChartData = '';
            $areaChartOverall = '<div class="col-md-12 bg-blue"><h3>C Range</h3></div>';

            $range_totBills = 0;
            $range_totPCs = 0;
            $range_totBValue = 0;
            $range_totCancelPC = 0;
            $range_totAPCs = 0;
            $range_totCValue = 0;
            $range_totGValue = 0;
            $range_totMValue = 0;
            $range_totAValue = 0;
            $range_totDValue = 0;
            $range_totTarget = 0;

            if (!empty($SalesData_Area_Summery) && isset($SalesData_Area_Summery)) {
                $strArea = '';
                $area_code = '';

                $area_totBills = 0;
                $area_totPCs = 0;
                $area_totBValue = 0;
                $area_totCancelPC = 0;
                $area_totAPCs = 0;
                $area_totCValue = 0;
                $area_totGValue = 0;
                $area_totMValue = 0;
                $area_totAValue = 0;
                $area_totDValue = 0;

                $totAreaBills = 0;
                $totAreaPCs = 0;
                $totAreaAPCs = 0;
                $totAreaBValue = 0;
                $totAreaCancelPC = 0;
                $totAreaCValue = 0;
                $totAreaGValue = 0;
                $totAreaMValue = 0;
                $totAreaDValue = 0;
                $totAreaAValue = 0;


                $totalARows = count($SalesData_Area_Summery);
                $ca = 0;
                foreach ($SalesData_Area_Summery as $s) {
                    $ca = $ca + 1;
                    if ($strArea == '') {
                        $strArea = $s['area_name'];
                        $area_code = $s['area_id'];
                    }
                    if ($strArea == $s['area_name']) {//add totals to same territory figures
                        $totAreaBills = $totAreaBills + $s['totBills'];
                        $totAreaPCs = $totAreaPCs + $s['totPC'];
                        $totAreaAPCs = $totAreaAPCs + $s['totActualPC'];
                        $totAreaBValue = $totAreaBValue + $s['totBval'] + $s['totDisval'];
                        $totAreaCancelPC = $totAreaCancelPC + $s['totCancelPC'];
                        $totAreaCValue = $totAreaCValue + $s['totCval'];
                        $totAreaGValue = $totAreaGValue + $s['totGval'];
                        $totAreaMValue = $totAreaMValue + $s['totMval'];
                        $totAreaDValue = $totAreaDValue + $s['totDisval'];
                        $totAreaAValue = $totAreaAValue + $s['totAval'] + $s['totDisval'];

                        //RANGE TOTAL
                        /* $range_totBills = $range_totBills + $s['totBills'];
                          $range_totPCs = $range_totPCs + $s['totPC'];
                          $range_totBValue = $range_totBValue + $s['totBval'] + $s['totDisval'];
                          $range_totCancelPC = $range_totCancelPC + $s['totCancelPC'];
                          $range_totAPCs = $range_totAPCs + $s['totActualPC'];
                          $range_totCValue = $range_totCValue + $s['totCval'];
                          $range_totGValue = $range_totGValue + $s['totGval'];
                          $range_totMValue = $range_totMValue + $s['totMval'];
                          $range_totAValue = $range_totAValue + $s['totAval'] + $s['totDisval'];
                          $range_totDValue = $range_totDValue + $s['totDisval']; */
                    }
                    if ($strArea != $s['area_name'] || $ca == $totalARows) {
                        $dt = str_replace('/', '-', trim(str_replace(' - ', '~', trim($DateRange))));
                        $targetA = 0;
                        if (!empty($targetData) && isset($targetData)) {
                            foreach ($targetData as $t) {
                                if ($t['area_cd'] == $area_code) {
                                    $targetA = $targetA + $t[strtolower($s['range_name']) . '_target'];
                                    //$range_totTarget = $range_totTarget + $t[strtolower($s['range_name']) . '_target'];
                                }
                            }
                        }
                        $percentA = '-';
                        if ($targetA == 0) {
                            $percentA = 'Target Not Set';
                        } else {
                            $percentA = number_format(($totAreaAValue / $targetA) * 100);
                        }
                        if ($totAreaBValue == 0) {
                            $totAreaBValue = 1;
                        }
                        
                        $range_totTarget = $range_totTarget + $targetA;
                        
                        $areaChartData .= ''
                                . '<div class="col-md-6">
                                    <div class="box box-widget widget-user">
                                        <div class="small-box bg-blue">
                                            <div class="inner">
                                                <h3>' . $strArea . '</h3>
                                                <h3>' . $percentA . '<sup style="font-size: 20px">%</sup><sub style="font-size: 18px">Achieved so far from Rs. ' . number_format($targetA) . '</sub></h3>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-stats-bars"></i>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-sm-4 border-right">
                                                        <div class="description-block">
                                                            <h5 class="description-header">Rs. ' . number_format($totAreaAValue) . '<br>(' . number_format(($totAreaAValue / $totAreaBValue) * 100) . ' %)</h5>
                                                            <span class="description-text">ACTUAL SALES</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4 border-right">
                                                        <div class="description-block">
                                                            <h5 class="description-header">Rs. ' . number_format($totAreaCValue) . '<br>(' . number_format(($totAreaCValue / $totAreaBValue) * 100) . ' %)</h5>
                                                            <span class="description-text">Cancel Value</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="description-block">
                                                            <h5 class="description-header">Rs. ' . number_format(($totAreaMValue + $totAreaGValue)) . '<br>(' . number_format((($totAreaMValue + $totAreaGValue) / $totAreaAValue) * 100) . '%)</h5>
                                                            <span class="description-text">Return Value</span>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <a target="_blank" href="' . base_url('salesreports/areaSummery/null/' . $area_code . '/' . $s['range_id'] . '/null/' . $dt . '/A') . '" class="small-box-footer">
                                                More info <i class="fa fa-arrow-circle-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>';

                        if ($strArea != $s['area_name'] && $ca == $totalARows) { //found last row with differ area and its the last record 
                            $strArea = $s['area_name'];
                            $area_code = $s['area_id'];
                            $totAreaBills = 0;
                            $totAreaPCs = 0;
                            $totAreaAPCs = 0;
                            $totAreaBValue = 0;
                            $totAreaCancelPC = 0;
                            $totAreaCValue = 0;
                            $totAreaGValue = 0;
                            $totAreaMValue = 0;
                            $totAreaDValue = 0;
                            $totAreaAValue = 0;
                            $totAreaBills = $totAreaBills + $s['totBills'];
                            $totAreaPCs = $totAreaPCs + $s['totPC'];
                            $totAreaAPCs = $totAreaAPCs + $s['totActualPC'];
                            $totAreaBValue = $totAreaBValue + $s['totBval'] + $s['totDisval'];
                            $totAreaCancelPC = $totAreaCancelPC + $s['totCancelPC'];
                            $totAreaCValue = $totAreaCValue + $s['totCval'];
                            $totAreaGValue = $totAreaGValue + $s['totGval'];
                            $totAreaMValue = $totAreaMValue + $s['totMval'];
                            $totAreaDValue = $totAreaDValue + $s['totDisval'];
                            $totAreaAValue = $totAreaAValue + $s['totAval'] + $s['totDisval'];

                            //RANGE TOTAL
                            
                            $range_totBills = $range_totBills + $totAreaBills;
                            $range_totPCs = $range_totPCs + $totAreaPCs;
                            $range_totBValue = $range_totBValue + $totAreaBValue;
                            $range_totCancelPC = $range_totCancelPC + $totAreaCancelPC;
                            $range_totAPCs = $range_totAPCs + $totAreaAPCs;
                            $range_totCValue = $range_totCValue + $totAreaCValue;
                            $range_totGValue = $range_totGValue + $totAreaGValue;
                            $range_totMValue = $range_totMValue + $totAreaMValue;
                            $range_totAValue = $range_totAValue + $totAreaAValue;
                            $range_totDValue = $range_totDValue + $totAreaDValue;

                            $targetA = 0;
                            if (!empty($targetData) && isset($targetData)) {
                                foreach ($targetData as $t) {
                                    if ($t['area_cd'] == $area_code) {
                                        $targetA = $targetA + $t[strtolower($s['range_name']) . '_target'];
                                        //$range_totTarget = $range_totTarget + $t[strtolower($s['range_name']) . '_target'];
                                    }
                                }
                            }
                            $percentA = '-';
                            if ($targetA == 0) {
                                $percentA = 'Target Not Set';
                            } else {
                                $percentA = number_format(($totAreaAValue / $targetA) * 100);
                            }
                            if ($totAreaBValue == 0) {
                                $totAreaBValue = 1;
                            }
                            
                             
                            
                            $areaChartData .= ''
                                    . '<div class="col-md-6">
                                    <div class="box box-widget widget-user">
                                        <div class="small-box bg-blue">
                                            <div class="inner">
                                                <h3>' . $strArea . '</h3>
                                                <h3>' . $percentA . '<sup style="font-size: 20px">%</sup><sub style="font-size: 18px">Achieved so far from Rs. ' . number_format($targetA) . '</sub></h3>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-stats-bars"></i>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-sm-4 border-right">
                                                        <div class="description-block">
                                                            <h5 class="description-header">Rs. ' . number_format($totAreaAValue) . '<br>(' . number_format(($totAreaAValue / $totAreaBValue) * 100) . ' %)</h5>
                                                            <span class="description-text">ACTUAL SALES</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4 border-right">
                                                        <div class="description-block">
                                                            <h5 class="description-header">Rs. ' . number_format($totAreaCValue) . '<br>(' . number_format(($totAreaCValue / $totAreaBValue) * 100) . ' %)</h5>
                                                            <span class="description-text">Cancel Value</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="description-block">
                                                            <h5 class="description-header">Rs. ' . number_format(($totAreaMValue + $totAreaGValue)) . '<br>(' . number_format((($totAreaMValue + $totAreaGValue) / $totAreaAValue) * 100) . '%)</h5>
                                                            <span class="description-text">Return Value</span>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <a target="_blank" href="' . base_url('salesreports/areaSummery/null/' . $area_code . '/' . $s['range_id'] . '/null/' . $dt . '/A') . '" class="small-box-footer">
                                                More info <i class="fa fa-arrow-circle-right"></i>
                                            </a>
                                        </div>
                                    </div>

                                </div>';
                        }
                        
                        //first add current final area values to total range value
                        //RANGE TOTAL
                        $range_totBills = $range_totBills + $totAreaBills;
                        $range_totPCs = $range_totPCs + $totAreaPCs;
                        $range_totBValue = $range_totBValue + $totAreaBValue;
                        $range_totCancelPC = $range_totCancelPC + $totAreaCancelPC;
                        $range_totAPCs = $range_totAPCs + $totAreaAPCs;
                        $range_totCValue = $range_totCValue + $totAreaCValue;
                        $range_totGValue = $range_totGValue + $totAreaGValue;
                        $range_totMValue = $range_totMValue + $totAreaMValue;
                        $range_totAValue = $range_totAValue + $totAreaAValue;
                        $range_totDValue = $range_totDValue + $totAreaDValue;
                        //now reset and count back

                        $strArea = $s['area_name'];
                        $area_code = $s['area_id'];
                        $totAreaBills = 0;
                        $totAreaPCs = 0;
                        $totAreaAPCs = 0;
                        $totAreaBValue = 0;
                        $totAreaCancelPC = 0;
                        $totAreaCValue = 0;
                        $totAreaGValue = 0;
                        $totAreaMValue = 0;
                        $totAreaDValue = 0;
                        $totAreaAValue = 0;
                        $totAreaBills = $totAreaBills + $s['totBills'];
                        $totAreaPCs = $totAreaPCs + $s['totPC'];
                        $totAreaAPCs = $totAreaAPCs + $s['totActualPC'];
                        $totAreaBValue = $totAreaBValue + $s['totBval'] + $s['totDisval'];
                        $totAreaCancelPC = $totAreaCancelPC + $s['totCancelPC'];
                        $totAreaCValue = $totAreaCValue + $s['totCval'];
                        $totAreaGValue = $totAreaGValue + $s['totGval'];
                        $totAreaMValue = $totAreaMValue + $s['totMval'];
                        $totAreaDValue = $totAreaDValue + $s['totDisval'];
                        $totAreaAValue = $totAreaAValue + $s['totAval'] + $s['totDisval'];

                        
                    }
                }


                $areaChartOverall .= ''
                        . '<div class="col-md-12">
                                    <div class="box box-widget widget-user">
                                        <div class="small-box bg-navy">
                                            <div class="inner">
                                                <h3>C Range Summery</h3>
                                                <h3>' . number_format(($range_totAValue / $range_totTarget) * 100) . '<sup style="font-size: 20px">%</sup><sub style="font-size: 18px">Achieved so far from Rs. ' . number_format($range_totTarget) . '</sub></h3>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-stats-bars"></i>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-sm-4 border-right">
                                                        <div class="description-block">
                                                            <h5 class="description-header">Rs. ' . number_format($range_totAValue) . '<br>(' . number_format(($range_totAValue / $range_totBValue) * 100) . ' %)</h5>
                                                            <span class="description-text">ACTUAL SALES</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4 border-right">
                                                        <div class="description-block">
                                                            <h5 class="description-header">Rs. ' . number_format($range_totCValue) . '<br>(' . number_format(($range_totCValue / $range_totBValue) * 100) . ' %)</h5>
                                                            <span class="description-text">Cancel Value</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="description-block">
                                                            <h5 class="description-header">Rs. ' . number_format(($range_totMValue + $range_totGValue)) . '<br>(' . number_format((($range_totMValue + $range_totGValue) / $range_totAValue) * 100) . '%)</h5>
                                                            <span class="description-text">Return Value</span>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <a target="_blank" href="" class="small-box-footer">
                                                More info <i class="fa fa-arrow-circle-right"></i>
                                            </a>
                                        </div>
                                    </div>

                                </div>';
            }
            echo $areaChartOverall;
            echo $areaChartData;
            ?>




            <?php
            $areaChartData = '<div class="col-md-12 bg-purple"><h3>D Range</h3></div>';
            if (!empty($SalesData_Area_Summery_2) && isset($SalesData_Area_Summery_2)) {
                $strArea = '';
                $area_code = '';

                $area_totBills = 0;
                $area_totPCs = 0;
                $area_totBValue = 0;
                $area_totCancelPC = 0;
                $area_totAPCs = 0;
                $area_totCValue = 0;
                $area_totGValue = 0;
                $area_totMValue = 0;
                $area_totAValue = 0;
                $area_totDValue = 0;

                $totAreaBills = 0;
                $totAreaPCs = 0;
                $totAreaAPCs = 0;
                $totAreaBValue = 0;
                $totAreaCancelPC = 0;
                $totAreaCValue = 0;
                $totAreaGValue = 0;
                $totAreaMValue = 0;
                $totAreaDValue = 0;
                $totAreaAValue = 0;

                $totalARows = count($SalesData_Area_Summery_2);
                $ca = 0;
                foreach ($SalesData_Area_Summery_2 as $s) {
                    if ($strArea == '') {
                        $strArea = $s['area_name'];
                        $area_code = $s['area_id'];
                    }
                    if ($strArea == $s['area_name']) {//add totals to same territory figures
                        $totAreaBills = $totAreaBills + $s['totBills'];
                        $totAreaPCs = $totAreaPCs + $s['totPC'];
                        $totAreaAPCs = $totAreaAPCs + $s['totActualPC'];
                        $totAreaBValue = $totAreaBValue + $s['totBval'] + $s['totDisval'];
                        $totAreaCancelPC = $totAreaCancelPC + $s['totCancelPC'];
                        $totAreaCValue = $totAreaCValue + $s['totCval'];
                        $totAreaGValue = $totAreaGValue + $s['totGval'];
                        $totAreaMValue = $totAreaMValue + $s['totMval'];
                        $totAreaDValue = $totAreaDValue + $s['totDisval'];
                        $totAreaAValue = $totAreaAValue + $s['totAval'] + $s['totDisval'];
                    }
                    if ($strArea != $s['area_name'] || $ca == $totalARows - 1) {
                        $targetA = 0;
                        //print_r($targetData);die();
                        if (!empty($targetData) && isset($targetData)) {
                            foreach ($targetData as $t) {
                                if ($t['area_cd'] == $area_code) {
                                    $targetA = $targetA + $t[strtolower($s['range_name']) . '_target'];
                                }
                            }
                        }

                        $dt = str_replace('/', '-', trim(str_replace(' - ', '~', trim($DateRange))));

                        $percentA = '-';
                        if ($targetA == 0) {
                            $percentA = 'Target Not Set';
                        } else {
                            $percentA = number_format(($totAreaAValue / $targetA) * 100);
                        }
                        if ($totAreaBValue == 0) {
                            $totAreaBValue = 1;
                        }
                        $dt = str_replace('/', '-', trim(str_replace(' - ', '~', trim($DateRange))));
                        $areaChartData .= ''
                                . '<div class="col-md-6">
                                    <div class="box box-widget widget-user">
                                        <div class="small-box bg-purple">
                                            <div class="inner">
                                                <h3>' . $strArea . '</h3>
                                                <h3>' . $percentA . '<sup style="font-size: 20px">%</sup><sub style="font-size: 18px">Achieved so far from Rs. ' . number_format($targetA) . '</sub></h3>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-stats-bars"></i>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-sm-4 border-right">
                                                        <div class="description-block">
                                                            <h5 class="description-header">Rs. ' . number_format($totAreaAValue) . '<br>(' . number_format(($totAreaAValue / $totAreaBValue) * 100) . ' %)</h5>
                                                            <span class="description-text">ACTUAL SALES</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4 border-right">
                                                        <div class="description-block">
                                                            <h5 class="description-header">Rs. ' . number_format($totAreaCValue) . '<br>(' . number_format(($totAreaCValue / $totAreaBValue) * 100) . ' %)</h5>
                                                            <span class="description-text">Cancel Value</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="description-block">
                                                            <h5 class="description-header">Rs. ' . number_format(($totAreaMValue + $totAreaGValue)) . '<br>(' . number_format((($totAreaMValue + $totAreaGValue) / $totAreaAValue) * 100) . '%)</h5>
                                                            <span class="description-text">Return Value</span>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <a target="_blank" href="' . base_url('salesreports/areaSummery/null/' . $area_code . '/' . $s['range_id'] . '/null/' . $dt . '/A') . '" class="small-box-footer">
                                                More info <i class="fa fa-arrow-circle-right"></i>
                                            </a>
                                        </div>
                                    </div>

                                </div>';


                        $strArea = $s['area_name'];
                        $area_code = $s['area_id'];
                        $totAreaBills = 0;
                        $totAreaPCs = 0;
                        $totAreaAPCs = 0;
                        $totAreaBValue = 0;
                        $totAreaCancelPC = 0;
                        $totAreaCValue = 0;
                        $totAreaGValue = 0;
                        $totAreaMValue = 0;
                        $totAreaDValue = 0;
                        $totAreaAValue = 0;
                        $totAreaBills = $totAreaBills + $s['totBills'];
                        $totAreaPCs = $totAreaPCs + $s['totPC'];
                        $totAreaAPCs = $totAreaAPCs + $s['totActualPC'];
                        $totAreaBValue = $totAreaBValue + $s['totBval'] + $s['totDisval'];
                        $totAreaCancelPC = $totAreaCancelPC + $s['totCancelPC'];
                        $totAreaCValue = $totAreaCValue + $s['totCval'];
                        $totAreaGValue = $totAreaGValue + $s['totGval'];
                        $totAreaMValue = $totAreaMValue + $s['totMval'];
                        $totAreaDValue = $totAreaDValue + $s['totDisval'];
                        $totAreaAValue = $totAreaAValue + $s['totAval'] + $s['totDisval'];
                    }
                    $ca = $ca + 1;
                }
            }
            echo $areaChartData;
            ?>

        </div>


        <div class="box box-default collapsed-box">
            <div class="box-header with-border">
                <h3 class="box-title">Supportive Tools / ආධාරක සම්පත්</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                    </button>
                </div>

            </div>

            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <a href="<?= base_url('androidapp/SFA_20220420_0900_V2_9_2.apk') ?>" target="_blank">
                            <!--SFA_20220228_0800.apk,SFA_20220225_1800_V2_9_1.apk,SFA_20220202_0900_V2_9.apk,SFA_20220122_1000_V2_8.apk,SFA_20211231_1051.apk(Stable),SFA_20211113_0900_V2_6.apk,SFA_20211113_0600_V2_5.apk,SFA_20211101_0800_V2_4.apk,SFA_20211030_1400_V2_4.apk,SFA_20211004_1400.apk,SFA_20210928_0130,SFA_20210918_0800.apk, SFA_20210917_0842.apk,SFA_20210909_1700.apk,SFA_20210819_1045.apk-->
                            <div class="info-box bg-aqua">
                                <span class="info-box-icon">
                                    <i class="fa fa-cart-arrow-down"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text"><h3>Download Android App</h3></span>
                                    <span class="info-box-number">&nbsp;</span>
                                    <div class="progress">
                                        <div class="progress-bar" style="width: 100%"></div>
                                    </div> 
                                    <span class="progress-description"> Click to Download Latest V2.9.2 App </span> 
                                </div>
                                <!-- /.info-box-content -->  
                            </div>
                        </a>
                    </div>	
                    <div class="col-md-6">
                        <a href="<?= base_url('androidapp/SFA_DESKTOP APPLICATION.zip') ?>" target="_blank">
                            <!--SFA_20210918_0800.apk, SFA_20210917_0842.apk,SFA_20210909_1700.apk,SFA_20210819_1045.apk-->	
                            <div class="info-box bg-aqua">      
                                <span class="info-box-icon"><i class="fa fa-cart-arrow-down"></i></span>  
                                <div class="info-box-content">    
                                    <span class="info-box-text"><h3>Download Desktop Software</h3></span>     
                                    <span class="info-box-number">&nbsp;</span>      
                                    <div class="progress">           
                                        <div class="progress-bar" style="width: 100%"></div>    
                                    </div>                     
                                    <span class="progress-description"> Click to Download Latest Desktop Software </span> 
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </a>	
                    </div>	
                    <div class="col-md-6">	
                        <a href="https://download.anydesk.com/AnyDesk.exe?_ga=2.147984948.2057996531.1632879125-896486140.1625118500" target="_blank">
                            <!--SFA_20210918_0800.apk, SFA_20210917_0842.apk,SFA_20210909_1700.apk,SFA_20210819_1045.apk-->
                            <div class="info-box bg-aqua">          
                                <span class="info-box-icon"><i class="fa fa-cart-arrow-down"></i></span>    
                                <div class="info-box-content">         
                                    <span class="info-box-text"><h3>Download ANYDESK Software</h3></span>     
                                    <span class="info-box-number">&nbsp;</span>         
                                    <div class="progress">                        
                                        <div class="progress-bar" style="width: 100%"></div>    
                                    </div>                                        
                                    <span class="progress-description"> Click to Download Latest ANYDESK Software </span> 
                                </div>
                                <!-- /.info-box-content --> 
                            </div>
                        </a>	
                    </div>
                    <div class="col-md-6">
                        <a href="<?= base_url('androidapp/anydesk.apk') ?>" target="_blank">
                            <!--SFA_20210918_0800.apk, SFA_20210917_0842.apk,SFA_20210909_1700.apk,SFA_20210819_1045.apk-->	
                            <div class="info-box bg-aqua">      
                                <span class="info-box-icon"><i class="fa fa-cart-arrow-down"></i></span>  
                                <div class="info-box-content">    
                                    <span class="info-box-text"><h3>Download Anydesk APK File</h3></span>     
                                    <span class="info-box-number">&nbsp;</span>      
                                    <div class="progress">           
                                        <div class="progress-bar" style="width: 100%"></div>    
                                    </div>                     
                                    <span class="progress-description"> Click to Download Latest Anydesk APK </span> 
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </a>	
                    </div>
                    <div class="col-md-6">
                        <a href="https://drive.google.com/file/d/1_Blq9F1PB7d0fkxEkLnUBetNPWBPYZx6/view?usp=sharing" target="_blank">
                            <!--SFA_20210918_0800.apk, SFA_20210917_0842.apk,SFA_20210909_1700.apk,SFA_20210819_1045.apk-->	
                            <div class="info-box bg-aqua">      
                                <span class="info-box-icon"><i class="fa fa-cart-arrow-down"></i></span>  
                                <div class="info-box-content">    
                                    <span class="info-box-text"><h3>Google Drive Link</h3></span>     
                                    <span class="info-box-number">&nbsp;</span>      
                                    <div class="progress">           
                                        <div class="progress-bar" style="width: 100%"></div>    
                                    </div>                     
                                    <span class="progress-description"> Click to Download Latest SFA Application via Google Drive </span> 
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </a>	
                    </div>
                    <div class="col-md-6">
                        <a href="<?= base_url('androidapp/RSP_NEW.jar') ?>" target="_blank">
                            <!--SFA_20210918_0800.apk, SFA_20210917_0842.apk,SFA_20210909_1700.apk,SFA_20210819_1045.apk-->	
                            <div class="info-box bg-aqua">      
                                <span class="info-box-icon"><i class="fa fa-cart-arrow-down"></i></span>  
                                <div class="info-box-content">    
                                    <span class="info-box-text"><h3>Download RSP NEW and Code</h3></span>     
                                    <span class="info-box-number">&nbsp;</span>      
                                    <div class="progress">           
                                        <div class="progress-bar" style="width: 100%"></div>    
                                    </div>                     
                                    <span class="progress-description"> Click to Download Latest RSP V2.8 Only</span> 
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </a>
                        <a href="<?= base_url('androidapp/aa.txt') ?>" target="_blank">Sql Code</a><br>
                        <a href="<?= base_url('androidapp/SFA_DATACLEAR.apk') ?>" target="_blank">GPS Clear APP</a>
                    </div>
                    <!--  <div class="box">				
                          <div class="box-header"> <a href="<?= base_url('androidapp/SFA_20210813_1411.apk') ?>" target="_blank"><h2>Download App</h2></a><br>
                              <h3 class="box-title">Welcome</h3>
                          </div>								             
                      </div>			-->
                    <div class="box-body">
                        <div class="row">


                            <div class="col-md-12">
                                <div class="box box-solid">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Sales Force Autoation System</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                            <ol class="carousel-indicators">
                                                <li data-target="#carousel-example-generic" data-slide-to="0" class=""></li>
                                                <li data-target="#carousel-example-generic" data-slide-to="1" class="active"></li>
                                                <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                                            </ol>
                                            <div class="carousel-inner">
                                                <div class="item">
                                                    <img src="http://placehold.it/900x500/39CCCC/ffffff&amp;text=High+Performance" alt="First slide">

                                                    <div class="carousel-caption">
                                                        Process Data in Milliseconds
                                                    </div>
                                                </div>
                                                <div class="item active">
                                                    <img src="http://placehold.it/900x500/3c8dbc/ffffff&amp;text=MIS+Division+Project" alt="Second slide">

                                                    <div class="carousel-caption">
                                                        Developed by : Lakshitha Pradeep (Manager - System Admin)</br>Call : (+94) 70 7061 772
                                                    </div>
                                                </div>
                                                <div class="item">
                                                    <img src="http://placehold.it/900x500/f39c12/ffffff&amp;text=High+Security" alt="Third slide">

                                                    <div class="carousel-caption">
                                                        Encrypted Data with SHA256 Algorithms
                                                    </div>
                                                </div>
                                            </div>
                                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                                <span class="fa fa-angle-left"></span>
                                            </a>
                                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                                <span class="fa fa-angle-right"></span>
                                            </a>

                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <!-- /.box -->
                            </div> 

                        </div>

                    </div><!-- /.box-body -->
                    <!--
        <div class="col-xs-12">                
            <div class="form-group col-xs-2 pull-right">
                <button class="btn btn-block btn-warning btn-md col-xs-2"><i class="fa fa-refresh"></i> Reload Data</button>
            </div>
            <div class="form-group col-xs-2 pull-right">
                <a class="btn btn-block btn-info btn-md col-xs-2" href="<?= base_url('index.php/jobs/newJob') ?>"><i class="fa fa-briefcase"></i> New Job</a>
            </div>
        </div>
                    -->
                    <?php
////- Variables – for your RPT and PDF
//echo "Print Report Test";
//$my_report = "D:\\Raigam\\CreditNoteListing.rpt"; //rpt source file
//$my_pdf = "D:\\Raigam\\CreditNoteListing.xls"; // RPT export to pdf file
////-Create new COM object-depends on your Crystal Report version
//$ObjectFactory= new COM("CrystalReports11.ObjectFactory.1") or die ("Error on load"); // call COM port
//$crapp = $ObjectFactory-> CreateObject("CrystalDesignRunTime.Application"); // create an instance for Crystal
//$creport = $crapp->OpenReport($my_report, 1); // call rpt report
//// to refresh data before
////- Set database logon info – must have
//$creport->Database->Tables(1)->SetLogOnInfo("RMIS", "RMIS", "sa", "sa");
////- field prompt or else report will hang – to get through
//$creport->EnableParameterPrompting = 0;
////- DiscardSavedData – to refresh then read records
//$creport->DiscardSavedData;
//$creport->ReadRecords();
//------ Pass formula fields --------
// $creport->FormulaFields->Item(1)->Text = ("'My Report Title'");
//$creport->ParameterFields(1)->AddCurrentValue ("Hello World");   // <-- param 1
//$creport->ParameterFields(2)->AddCurrentValue (123); // <-- param 2
//export to PDF process
//$creport->ExportOptions->DiskFileName=$my_pdf; //export to pdf
//$creport->ExportOptions->PDFExportAllPages=true;
//$creport->ExportOptions->DestinationType=1; // export to file
////$creport->ExportOptions->FormatType=31; // PDF type
//$creport->ExportOptions->FormatType=27; // PDF type
//$creport->Export(true);
//—— Release the variables ——
//$creport = null;
//$crapp = null;
//$ObjectFactory = null;
//—— Embed the report in the webpage ——
//print ""
                    ?>
                </div><!-- /.box -->
            </div>

        </div>


    </section>
</div>

<!-- /.content -->
</div><!-- /.content-wrapper -->
