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
            <div class="col-md-12">
                <form action="<?= base_url('welcome/index')?>" method="post" class="form-horizontal">
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
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 ">
                <h4 class="text-info">                
                <div class="col-md-1"><img src="https://icon-library.com/images/new-icon-gif/new-icon-gif-13.jpg" style="width: 80px;height: auto;"></div>
                <div class="col-md-11"><marquee>GPS and Call Time Report is ready. Go to "Booking and Actual Module"-&gt;"Booking/ Actual Report"-&gt;"Booking Call Time Report"<br>GPS සහ බිල්පත් කාලය සම්බන්ධ වාර්තාව සූදානම්. මෙම මෙනුවට පිවිසෙන්න = "Booking and Actual Module"-&gt;"Booking/ Actual Report"-&gt;"Booking Call Time Report"</marquee></div>
            </h4>
                <h4 class="text-info">                
                <div class="col-md-1"><img src="https://icon-library.com/images/new-icon-gif/new-icon-gif-13.jpg" style="width: 80px;height: auto;"></div>
                <div class="col-md-11"><marquee>Area Summery Item Category wise report is ready. Go to "Sales Report"-&gt;"Sales Area Summery"-&gt;"Area Sales Summery Itemwise"<br> ප්‍රදේශ විකුණුම් සාරාංශ - අයිතම කාණ්ඩය අනුව වාර්තාව සූදානම්. මෙම මෙනුවට පිවිසෙන්න = "Sales Report"-&gt;"Sales Area Summery"-&gt;"Area Sales Summery Itemwise"</marquee></div>
            </h4>
            </div>
            <div class="clearfix"></div>
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
                    ${'area_chart_1'} = array();
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
                                            <a target="_blank" href="' . base_url('salesreports/areaSummery/null/' . $strArea_id . '/' . $strRange_id . '/' . $strTerritory_id . '/' . str_replace(' ', '', $dt) . '/A') . '" class="small-box-footer">
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


                //for chart purpose 
                $beginDt = $FromDate;
                $endDt = date("Y-m-t", strtotime($beginDt));

                $currentWorkdaysCount = 0;
                $totalWorkdaysCount = 0;
                $cumalativeActual = 0;
                $realLastActualDays = 0;
                for ($i = $beginDt; $i <= $endDt; $i = date('Y-m-d', strtotime($i . ' +1 day'))) {
                    //echo $i;
                    if (date('l', strtotime($i)) != 'Sunday') {
                        $totalWorkdaysCount += 1;
                    }
                }
                for ($i = $beginDt; $i <= $endDt; $i = date('Y-m-d', strtotime($i . ' +1 day'))) {
                    //echo $i->format("Y-m-d");
                    $totChartActual = 0;
                    $totChartTarget = 0;
                    foreach ($SalesDataTerritory as $s) {
                        if ($i == $s['date_actual']) {
                            $totChartActual = $totChartActual + $s['totAval'] + $s['totDisval'];
                        }
                    }
                    $cumalativeActual = $cumalativeActual + $totChartActual;
                    if (date('l', strtotime($i)) == 'Sunday') {
                        
                    } else {
                        if ($i <= date('Y-m-d')) {//date is a future date forecase needed
                            $currentWorkdaysCount += 1;
                            $realLastActualDays = $currentWorkdaysCount;
                        } else {
                            $currentWorkdaysCount += 1;
                        }
                    }
                    $d = cal_days_in_month(CAL_GREGORIAN, date('m', strtotime($i)), date('Y', strtotime($i)));
                    $cumalativeTarget = number_format(($totTarget / $totalWorkdaysCount) * $currentWorkdaysCount);
                    $forcastedActual = 0;

                    if ($i > date('Y-m-d')) {//date is a future date forecase needed so just add 3%
                        //echo '-'.$realLastActualDays . '-' . $currentWorkdaysCount . '-' . $cumalativeActual . '<br>';
                        $forcastedActual = number_format(($cumalativeActual / $realLastActualDays) * $currentWorkdaysCount * 1.03);
                    } else {
                        $forcastedActual = number_format(($cumalativeActual / $realLastActualDays) * $currentWorkdaysCount * 1.10);
                    }
                    //if ($r['range_id'] == 1) {
                    //echo date('d', strtotime($i)) .' - '. $cumalativeActual.' - '. $cumalativeTarget.'-'.$currentWorkdaysCount.'-'.$totalWorkdaysCount.'<br> ';                                
                    array_push(${'area_chart_1'}, array($s['id'], date('Y-m-d', strtotime($i)), $cumalativeActual, $cumalativeTarget, $forcastedActual));
                    //}
                    //$range_chart_array_all=$range_chart_array_all.'{'.$r['range_id'].','.$i.','.$totChartActual.','.$cumalativeTarget.'}';
                }
                //chart purpose end




                $chartDataOverall .= ''
                        . '<div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"> - Target Vs Achivement</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>

                    <div class="box-body no-padding">
                        <div class="row">
                            <div class="col-md-12 col-sm-12" style="background: #000;">
                                <div class="pad">
                                    <div class="box-body chart-responsive">
                                        <div class="chart" id="line-chart-1" style="height: 300px;"></div>
                                    </div>
                                </div>
                            </div>

                             

                        </div>

                    </div>

                </div>
                '
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
                                            <a target="_blank" href="' . base_url('salesreports/areaSummery/null/' . $strArea_id . '/' . $strRange_id . '/null/' . str_replace(' ', '', $dt) . '/A') . '" class="small-box-footer">
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
            $range_chart_array_all = array();
            if (!empty($ChannelMapping) && isset($ChannelMapping)) {
                foreach ($ChannelMapping as $c) {

                    $channel_totBills = 0;
                    $channel_totPCs = 0;
                    $channel_totBValue = 0;
                    $channel_totCancelPC = 0;
                    $channel_totAPCs = 0;
                    $channel_totCValue = 0;
                    $channel_totGValue = 0;
                    $channel_totMValue = 0;
                    $channel_totAValue = 0;
                    $channel_totDValue = 0;
                    $channel_totTarget = 0;

                    $per_day_Channel_figure = ''; //'{y: \'2011 Q1\', actual: 2666, target: 2666}';
                    $per_day_Channel_figure_Actual = 0;
                    $per_day_Channel_figure_Target = 0;

                    foreach ($RangeList as $r) {
                        $SalesData_Area_Summery = ${'SalesData_Area_Summery_' . $c['channel_id'] . '_' . $r['range_id']};
                        ${'range_chart_array_all_' . $c['channel_id'] . '_' . $r['range_id']} = array();
                        $range_name = $r['range_name'];

                        $areaChartData = '';
                        $areaChartOverall = ''; //'<div class="col-md-12 bg-blue"><h3>' . $range_name . ' Range</h3></div>';

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
                                            <a target="_blank" href="' . base_url('salesreports/areaSummery/null/' . $area_code . '/' . $s['range_id'] . '/null/' . str_replace(' ','',$dt) . '/A') . '" class="small-box-footer">
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
                                            <a target="_blank" href="' . base_url('salesreports/areaSummery/null/' . $area_code . '/' . $s['range_id'] . '/null/' . str_replace(' ','',$dt) . '/A') . '" class="small-box-footer">
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

                            $achivePercent = 'Target Not Set';
                            if ($range_totTarget != 0) {
                                //echo $range_totTarget;
                                $achivePercent = number_format(($range_totAValue / $range_totTarget) * 100);
                            }
                            $areaChartOverall .= ''
                                    . '<div class="col-md-12">
                                    <div class="box box-widget widget-user">
                                        <div class="small-box bg-navy">
                                            <div class="inner">
                                                <h3>' . $range_name . ' Range Summery</h3>
                                                <h3>' . $achivePercent . '<sup style="font-size: 20px">%</sup><sub style="font-size: 18px">Achieved so far from Rs. ' . number_format($range_totTarget) . '</sub></h3>
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
                                            <a class="small-box-footer">
                                                More info <i class="fa fa-arrow-circle-right"></i>
                                            </a> 
                                        </div>
                                    </div>

                                </div>';

                            //for chart purpose 
                            $beginDt = $FromDate;
                            $endDt = date("Y-m-t", strtotime($beginDt));

                            $currentWorkdaysCount = 0;
                            $totalWorkdaysCount = 0;
                            $cumalativeActual = 0;
                            $realLastActualDays = 0;
                            for ($i = $beginDt; $i <= $endDt; $i = date('Y-m-d', strtotime($i . ' +1 day'))) {
                                //echo $i;
                                if (date('l', strtotime($i)) != 'Sunday') {
                                    $totalWorkdaysCount += 1;
                                }
                            }
                            for ($i = $beginDt; $i <= $endDt; $i = date('Y-m-d', strtotime($i . ' +1 day'))) {
                                //echo $i->format("Y-m-d");
                                $totChartActual = 0;
                                $totChartTarget = 0;
                                foreach ($SalesData_Area_Summery as $s) {
                                    if ($i == $s['date_actual'] && $r['range_id'] == $s['range_id']) {
                                        $totChartActual = $totChartActual + $s['totAval'] + $s['totDisval'];
                                    }
                                }
                                $cumalativeActual = $cumalativeActual + $totChartActual;
                                if (date('l', strtotime($i)) == 'Sunday') {
                                    
                                } else {
                                    if ($i <= date('Y-m-d')) {//date is a future date forecase needed
                                        $currentWorkdaysCount += 1;
                                        $realLastActualDays = $currentWorkdaysCount;
                                    } else {
                                        $currentWorkdaysCount += 1;
                                    }
                                }
                                $d = cal_days_in_month(CAL_GREGORIAN, date('m', strtotime($i)), date('Y', strtotime($i)));
                                $cumalativeTarget = number_format(($range_totTarget / $totalWorkdaysCount) * $currentWorkdaysCount);
                                $forcastedActual = 0;

                                if ($i > date('Y-m-d')) {//date is a future date forecase needed so just add 3%
                                    //echo '-'.$realLastActualDays . '-' . $currentWorkdaysCount . '-' . $cumalativeActual . '<br>';
                                    $forcastedActual = number_format(($cumalativeActual / $realLastActualDays) * $currentWorkdaysCount * 1.03);
                                } else {
                                    $forcastedActual = number_format(($cumalativeActual / $realLastActualDays) * $currentWorkdaysCount * 1.10);
                                }
                                //if ($r['range_id'] == 1) {
                                //echo date('d', strtotime($i)) .' - '. $cumalativeActual.' - '. $cumalativeTarget.'-'.$currentWorkdaysCount.'-'.$totalWorkdaysCount.'<br> ';                                
                                array_push(${'range_chart_array_all_' . $c['channel_id'] . '_' . $r['range_id']}, array($r['range_id'], date('Y-m-d', strtotime($i)), $cumalativeActual, $cumalativeTarget, $forcastedActual));
                                //}
                                //$range_chart_array_all=$range_chart_array_all.'{'.$r['range_id'].','.$i.','.$totChartActual.','.$cumalativeTarget.'}';
                            }
                            //chart purpose end
                            //print_r($range_chart_array);
                        }

                        //ADD CHANNEL TOTALS
                        $channel_totTarget = $channel_totTarget + $range_totTarget;
                        $channel_totAValue = $channel_totAValue + $range_totAValue;


                        if ($areaChartOverall != '') {
                            echo '
                            
<div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">' . $c['channel_name'] . ' ' . $r['range_name'] . ' Range - Target Vs Achivement - Real time update</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>

                    <div class="box-body no-padding">
                        <div class="row">
                            <div class="col-md-12 col-sm-12" style="background: #000;">
                                <div class="pad">
                                    <div class="box-body chart-responsive">
                                        <div class="chart" id="line-chart-' . $c['channel_id'] . '-' . $r['range_id'] . '" style="height: 300px;"></div>
                                    </div>
                                </div>
                            </div>

                             

                        </div>

                    </div>

                </div>
                



<div class="box box-default collapsed-box">
            <div class="box-header with-border">
            
 
                ' . $areaChartOverall . '
                    




                <div class="box-tools pull-right" style="right: 28px !important;top: 12px;">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus fa-2x"></i>
                    </button>
                </div>
              

                 

 


            </div>            
            <div class="box-body">
            







            ' . $areaChartData . '
            </div>
            </div>';
                        }
                        //echo $areaChartOverall;
                        //echo $areaChartData;
                    }




                    //////////////////////////////////////////////////////////
                    /*
                     * 
                     * 
                     * 
                     * CHANNEL SUMMERY CHART
                     * 
                     * 
                     * 
                     */
                    ////////////////////////////////////////////////////////////
                    if (!empty($ChannelMapping) && isset($ChannelMapping)) {
                        foreach ($ChannelMapping as $c) {
                            $totalWorkdaysCount = 0;
                            $realLastActualDays = 0;
                            $currentWorkdaysCount = 0;
                            ${'chan_daily_array_' . $c['channel_id']} = array();
                            $chan_dayActualTotal = 0;
                            $beginDt = $FromDate;
                            $endDt = date("Y-m-t", strtotime($beginDt));
                            for ($i = $beginDt; $i <= $endDt; $i = date('Y-m-d', strtotime($i . ' +1 day'))) {
                                if (date('l', strtotime($i)) != 'Sunday') {
                                    $totalWorkdaysCount += 1;
                                }
                            }
                            for ($i = $beginDt; $i <= $endDt; $i = date('Y-m-d', strtotime($i . ' +1 day'))) {
                                foreach ($RangeList as $r) {
                                    $range_totAValue = 0;
                                    $SalesData_Area_Summery = ${'SalesData_Area_Summery_' . $c['channel_id'] . '_' . $r['range_id']};
                                    if (!empty($SalesData_Area_Summery) && isset($SalesData_Area_Summery)) {
                                        $strArea = '';
                                        $area_code = '';
                                        $totalARows = count($SalesData_Area_Summery);
                                        $ca = 0;
                                        foreach ($SalesData_Area_Summery as $s) {
                                            //GET AREA TARGET AND CUMALTE
                                            $ca = $ca + 1;
                                            if ($strArea == '') {
                                                $strArea = $s['area_name'];
                                                $area_code = $s['area_id'];
                                            }
                                            if ($strArea == $s['area_name']) {//add totals to same territory figures
                                                if ($i == $s['date_actual']) {//get relavant date sale
                                                    $chan_dayActualTotal = $chan_dayActualTotal + $s['totAval'] + $s['totDisval'];
                                                }
                                            }
                                            if ($strArea != $s['area_name'] || $ca == $totalARows) {
                                                if ($strArea != $s['area_name'] && $ca == $totalARows) {
                                                    $targetA = 0;
                                                    $totAreaAValue = 0;
                                                    if ($i == $s['date_actual']) {//get relavant date sale
                                                        $chan_dayActualTotal = $chan_dayActualTotal + $s['totAval'] + $s['totDisval'];
                                                    }
                                                }
                                            }

                                            $strArea = $s['area_name'];
                                            $area_code = $s['area_id'];
                                        }
                                    }
                                }

                                if (date('l', strtotime($i)) != 'Sunday') {
                                    if ($i <= date('Y-m-d')) {//date is a future date forecase needed
                                        $currentWorkdaysCount += 1;
                                        $realLastActualDays = $currentWorkdaysCount;
                                    } else {
                                        $currentWorkdaysCount += 1;
                                    }
                                }
                                array_push(${'chan_daily_array_' . $c['channel_id']}, array($i, $chan_dayActualTotal, $realLastActualDays, $currentWorkdaysCount, $totalWorkdaysCount, $channel_totTarget));
                            }
                        }
                    }
                    //////////////////////////////////////////////////////////
                    /*
                     *   
                     * CHANNEL SUMMERY CHART END 
                     * /                     *                      */
                    ////////////////////////////////////////////////////////////
                    ?>
                    <?php
                    if($channel_totTarget==0){
                        $channel_totTarget=1;
                    }
                    ?>
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?= $c['channel_name'] ?> Report - Real time update</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>

                        <div class="box-body no-padding">
                            <div class="row">
                                <div class="col-md-9 col-sm-8" style="background: #000;">
                                    <div class="pad">
                                        <div class="box-body chart-responsive">
                                            <div class="chart" id="line-chart" style="height: 300px;"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-4">
                                    <div class="pad box-pane-right bg-green" style="min-height: 280px">
                                        <div class="description-block margin-bottom">
                                            <icon class="fa fa-fighter-jet fa-2x"></icon>
                                            <h3 class=""><?= number_format($channel_totTarget) ?></h3>
                                            <span class="description-text">Total Target</span>
                                        </div>

                                        <div class="description-block margin-bottom">
                                            <icon class="fa fa-money fa-2x"></icon>
                                            <h3 class=""><?= number_format($channel_totAValue) ?></h3>
                                            <span class="description-text">Actual Sales</span>
                                        </div>

                                        <div class="description-block margin-bottom">
                                            <div class="sparkbar pad" data-color="#fff"><canvas width="34" height="30" style="display: inline-block; width: 34px; height: 30px; vertical-align: top;"></canvas></div>
                                            <h3 class=""><?= number_format(($channel_totAValue / $channel_totTarget) * 100) ?> %</h3>
                                            <span class="description-text">Achieved so far</span>
                                        </div>

                                        <div class="description-block">
                                            <div class="sparkbar pad" data-color="#fff"><canvas width="34" height="30" style="display: inline-block; width: 34px; height: 30px; vertical-align: top;"></canvas></div>
                                            <h3 class=""><?= $totalWorkdaysCount ?></h3>
                                            <span class="description-text">Working Days</span>
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                    <?php
                }
            }
            ?>




            <?php
            /*
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
              echo $areaChartData; */
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
                                                    <!-- <img src="http://placehold.it/900x500/39CCCC/ffffff&amp;text=High+Performance" alt="First slide"> -->

                                                    <div class="carousel-caption">
                                                        Process Data in Milliseconds
                                                    </div>
                                                </div>
                                                <div class="item active">
                                                    <!-- <img src="" alt="Second slide"> -->

                                                    <div class="carousel-caption">
                                                        Developed by : Lakshitha Pradeep (Manager - System Admin)</br>Call : (+94) 70 7061 772
                                                    </div>
                                                </div>
                                                <div class="item">
                                                    <!-- <img src="http://placehold.it/900x500/f39c12/ffffff&amp;text=High+Security" alt="Third slide"> -->

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


<script type="text/javascript" src="https://adminlte.io/themes/AdminLTE/bower_components/morris.js/morris.min.js"></script>

<script>
    $(function () {
        "use strict";
        /*
         // AREA CHART
         var area = new Morris.Area({
         element: 'revenue-chart',
         resize: true,
         data: [
         {y: '2011 Q1', item1: 2666, item2: 2666},
         {y: '2011 Q2', item1: 2778, item2: 2294},
         {y: '2011 Q3', item1: 4912, item2: 1969},
         {y: '2011 Q4', item1: 3767, item2: 3597},
         {y: '2012 Q1', item1: 6810, item2: 1914},
         {y: '2012 Q2', item1: 5670, item2: 4293},
         {y: '2012 Q3', item1: 4820, item2: 3795},
         {y: '2012 Q4', item1: 15073, item2: 5967},
         {y: '2013 Q1', item1: 10687, item2: 4460},
         {y: '2013 Q2', item1: 8432, item2: 5713}
         ],
         xkey: 'y',
         ykeys: ['item1', 'item2'],
         labels: ['Item 1', 'Item 2'],
         lineColors: ['#a0d0e0', '#3c8dbc'],
         hideHover: 'auto'
         });
         */

<?php
if (!empty(${'area_chart_1'}) && isset(${'area_chart_1'})) {
    ?>
            var line_area_chart_1 = new Morris.Line({
                element: 'line-chart-1',
                resize: true,
                data: [
    <?php
    foreach (${'area_chart_1'} as $r) {
        if ($r[1] <= date('Y-m-d')) {
            echo '{y: \'' . date('Y-m-d', strtotime($r[1])) . '\',Actual: ' . str_replace(',', '', ($r[2])) . ',Target: ' . str_replace(',', '', $r[3]) . ',Forecasted: ' . str_replace(',', '', $r[4]) . '},';
        } else {//cannot have actual sales for future dates
            echo '{y: \'' . date('Y-m-d', strtotime($r[1])) . '\',Actual:  null,Target: ' . str_replace(',', '', ($r[3])) . ',Forecasted: ' . str_replace(',', '', $r[4]) . '},';
        }
    }
    ?>
                ],
                xkey: 'y',
                ykeys: ['Actual', 'Target', 'Forecasted'],
                labels: ['Actual', 'Target', 'Forecasted'],
                lineColors: ['#3c8dbc', '#f00', '#fbbc05'],
                hideHover: 'auto'
            },
                    );
    <?php
}
?>

<?php
if (!empty($ChannelMapping) && isset($ChannelMapping)) {
    foreach ($ChannelMapping as $c) {
        foreach ($RangeList as $r) {
            if (!empty(${'range_chart_array_all_' . $c['channel_id'] . '_' . $r['range_id']}) && isset(${'range_chart_array_all_' . $c['channel_id'] . '_' . $r['range_id']})) {
                ?>
                        var line<?= $c['channel_id'] . '_' . $r['range_id'] ?> = new Morris.Line({
                            element: 'line-chart-<?= $c['channel_id'] . '-' . $r['range_id'] ?>',
                            resize: true,
                            data: [
                <?php
                foreach (${'range_chart_array_all_' . $c['channel_id'] . '_' . $r['range_id']} as $r) {
                    if ($r[1] <= date('Y-m-d')) {
                        echo '{y: \'' . date('Y-m-d', strtotime($r[1])) . '\',Actual: ' . str_replace(',', '', ($r[2])) . ',Target: ' . str_replace(',', '', $r[3]) . ',Forecasted: ' . str_replace(',', '', $r[4]) . '},';
                    } else {//cannot have actual sales for future dates
                        echo '{y: \'' . date('Y-m-d', strtotime($r[1])) . '\',Actual:  null,Target: ' . str_replace(',', '', ($r[3])) . ',Forecasted: ' . str_replace(',', '', $r[4]) . '},';
                    }
                }
                ?>
                            ],
                            xkey: 'y',
                            ykeys: ['Actual', 'Target', 'Forecasted'],
                            labels: ['Actual', 'Target', 'Forecasted'],
                            lineColors: ['#3c8dbc', '#f00', '#fbbc05'],
                            hideHover: 'auto'
                        },
                                );
                <?php
            }
        }
    }
}
?>



<?php
if (!empty($ChannelMapping) && isset($ChannelMapping)) {
    foreach ($ChannelMapping as $c) {
        if (!empty(${'chan_daily_array_' . $c['channel_id']}) && isset(${'chan_daily_array_' . $c['channel_id']})) {
            ?>
                    var line = new Morris.Line({
                        element: 'line-chart',
                        resize: true,
                        data: [

            <?php
            foreach (${'chan_daily_array_' . $c['channel_id']} as $r) {
                if ($r[0] <= date('Y-m-d')) {
                    echo '{y: \'' . date('Y-m-d', strtotime($r[0])) . '\',Actual: ' . str_replace(',', '', number_format($r[1])) . ',Target: ' . str_replace(',', '', number_format(($r[5] / $r[4]) * $r[3])) . ',Forecasted: ' . str_replace(',', '', number_format((($r[1] / $r[2]) * $r[3]) * 1.1)) . '},';
                } else {//cannot have actual sales for future dates
                    echo '{y: \'' . date('Y-m-d', strtotime($r[0])) . '\',Actual:  null,Target: ' . str_replace(',', '', number_format(($r[5] / $r[4]) * $r[3])) . ',Forecasted: ' . str_replace(',', '', number_format((($r[1] / $r[2]) * $r[3]) * 1.1)) . '},';
                }
            }
            ?>
                        ],
                        xkey: 'y',
                        ykeys: ['Actual', 'Target', 'Forecasted'],
                        labels: ['Actual', 'Target', 'Forecasted'],
                        lineColors: ['#3c8dbc', '#f00', '#fbbc05'],
                        hideHover: 'auto'
                    },
                            );
            <?php
        }
    }
}
?>

        // LINE CHART
        /*
         var line = new Morris.Line({
         element: 'line-chart',
         resize: true,
         data: [
         
         {y: '2011 Q1', item1: 2666},
         {y: '2011 Q2', item1: 2778},
         {y: '2011 Q3', item1: 4912},
         {y: '2011 Q4', item1: 3767},
         {y: '2012 Q1', item1: 6810},
         {y: '2012 Q2', item1: 5670},
         {y: '2012 Q3', item1: 4820},
         {y: '2012 Q4', item1: 15073},
         {y: '2013 Q1', item1: 10687},
         {y: '2013 Q2', item1: 8432}
         
<?php
/* if (!empty($range_chart_array_all) && isset($range_chart_array_all)) {
  foreach ($range_chart_array_all as $r) {
  if ($r[1] <= date('Y-m-d')) {
  echo '{y: \'' . date('Y-m-d', strtotime($r[1])) . '\',Actual: ' . str_replace(',', '', ($r[2])) . ',Target: ' . str_replace(',', '', $r[3]) . ',Forecasted: ' . str_replace(',', '', $r[4]) . '},';
  } else {//cannot have actual sales for future dates
  echo '{y: \'' . date('Y-m-d', strtotime($r[1])) . '\',Actual:  null,Target: ' . str_replace(',', '', ($r[3])) . ',Forecasted: ' . str_replace(',', '', $r[4]) . '},';
  }
  }
  } */
?>
         ],
         xkey: 'y',
         ykeys: ['Actual', 'Target', 'Forecasted'],
         labels: ['Actual', 'Target', 'Forecasted'],
         lineColors: ['#3c8dbc', '#f00', '#fbbc05'],
         hideHover: 'auto'
         },
         );
         */


        /*
         //DONUT CHART
         var donut = new Morris.Donut({
         element: 'sales-chart',
         resize: true,
         colors: ["#3c8dbc", "#f56954", "#00a65a"],
         data: [
         {label: "Download Sales", value: 12},
         {label: "In-Store Sales", value: 30},
         {label: "Mail-Order Sales", value: 20}
         ],
         hideHover: 'auto'
         });
         //BAR CHART
         var bar = new Morris.Bar({
         element: 'bar-chart',
         resize: true,
         data: [
         {y: '2006', a: 100, b: 90},
         {y: '2007', a: 75, b: 65},
         {y: '2008', a: 50, b: 40},
         {y: '2009', a: 75, b: 65},
         {y: '2010', a: 50, b: 40},
         {y: '2011', a: 75, b: 65},
         {y: '2012', a: 100, b: 90}
         ],
         barColors: ['#00a65a', '#f56954'],
         xkey: 'y',
         ykeys: ['a', 'b'],
         labels: ['CPU', 'DISK'],
         hideHover: 'auto'
         });
         */
    });
</script>