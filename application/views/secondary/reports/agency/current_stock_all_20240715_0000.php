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
<!-- Content Wrapper. Contains page content -->




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
                        Secondary Sales Customers
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
                <form class="form-horizontal" id="myForm" action="<?= base_url('salesreports/currentStockAll') ?>" method="post">
                    <div class="col-md-6">                            
                        <div class="form-group">
                            <label class="col-md-2">Area <span class="text-red">*</span></label>
                            <div class="col-md-6">
                                <select id="aaareaID" name="areaID" class="form-control">
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
                    <div class="col-md-6">                            
                        <div class="form-group">
                            <label class="col-md-2">Range <span class="text-red">*</span></label>
                            <div class="col-md-6">
                                <select id="RangeRepStock" name="rangeID" class="form-control">
                                    <option value="-1"> -- All -- </option>    
                                    <?php
                                    foreach ($RangeList as $a) {
                                        $select = '';
                                        if (!empty($RangeID) && isset($RangeID) && $a['id'] == $RangeID) {
                                            $select = 'selected';
                                        }
                                        echo '<option ' . $select . ' value="' . $a['range_name'] . '"> ' . $a['range_name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>  
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-2">Distributor <span class="text-red">*</span></label>
                            <div class="col-md-6">
                                <select id="sbTerritory" name="territoryID" class="form-control">
                                    <option value=""> -- Select Territory -- </option>    
                                    <?php
                                    foreach ($distributors as $t) {
                                        $select = '';
                                        if (!empty($territoryID) && isset($territoryID) && $territoryID == $t['common_warehouse_id']) {
                                            $select = 'selected';
                                        }
                                        echo '<option ' . $select . ' value="' . $t['common_warehouse_id'] . '"> ' . $t['agency_name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>                            
                    </div>    

                    <div class="col-md-12">
                        <?php
                        if (!empty($CategoryList) && isset($CategoryList)) {
                            foreach ($CategoryList as $cat) {
                                echo '<a onclick="setCategory(' . $cat['id'] . ');return false;" class="link" style="cursor: pointer;"><div class="col-md-3 cat-box ' . $cat['ranges'] . '">
                                    <div class="small-box" style="text-align:center;background:' . $cat['bg_color'] . ';color:' . $cat['font_color'] . ';">
                                        <div class="inner">
                                        <h4>' . $cat['name'] . '</h4> 
                                        </div>

                                        
                                        More details <i class="fa fa-arrow-circle-right"></i>
                                        
                                    </div>
                                </div></a>';
                            }
                        }
                        ?>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="hidden" readonly class="form-control" id="category" name="category" value="<?= $categoryID ?>">
                            <input type="submit" id="submit" class="btn btn-danger" name="submit" value="Get Report">
                        </div>                                
                    </div> 
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
                if (!empty($StockDataSum) && isset($StockDataSum)) {
                    $strDaySummery = '';
                    $strDaySummeryFoot = '';

                    $opSellableTot = 0;
                    $opDamageTot = 0;
                    $invActualQty = 0;
                    $invFreeQty = 0;
                    $invGretQty = 0;
                    $invGretFreeQty = 0;
                    $invMretQty = 0;
                    $invMretFreeQty = 0;
                    $invHFGretQty = 0;
                    $invHFMretQty = 0;
                    $invHFInvQty = 0;
                    $invHFPendingInvQty = 0;

                    $closingSellableTot = 0;
                    $closingSellableWithPendingTot = 0;
                    $closingDamageTot = 0;

                    $closingSellableTot_up = 0;
                    $closingSellableWithPendingTot_up = 0;
                    $closingDamageTot_up = 0;
                    ?>
                    <div class="form-group col-md-12">
                        <input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('attendance_table', 'Current Stock Summery - <?= date('Y-m-d H:i:s') ?>')" value="Download Summery Excel">
                    </div>
                    <table id="attendance_table" class="table table-hover">	
                        <?php
                        foreach ($StockDataSum as $s) {
                            //issued
                            $issued_bill = $s['invoice_a_qty'] + $s['invoice_g_qty'] + $s['invoice_m_qty']; //total issued qty without free issue
                            $issued_free_issue = $s['invoice_f_qty'];
                            $issued_gret = $s['good_return_qty']; //gret send to head office
                            $issued_mret = $s['market_return_qty']; //mret send to head office - damaged
                            ////issued Values
                            $issued_bill_up = $s['invoice_a_qty_up'] + $s['invoice_g_qty_up'] + $s['invoice_m_qty_up']; //total issued qty without free issue
                            $issued_free_issue_up = $s['invoice_f_qty_up'];
                            $issued_gret_up = $s['good_return_qty_up']; //gret send to head office
                            $issued_mret_up = $s['market_return_qty_up']; //mret send to head office - damaged
                            //received
                            $receive_gret = $s['invoice_g_qty'] + $s['invoice_g_free_qty'];
                            $receive_mret = $s['invoice_m_qty'] + $s['invoice_m_free_qty']; //damaged stock
                            $receive_from_office = $s['head_office_inv_qty'];
                            //received-values
                            $receive_gret_up = $s['invoice_g_qty_up'] + $s['invoice_g_free_qty_up'];
                            $receive_mret_up = $s['invoice_m_qty_up'] + $s['invoice_m_free_qty_up']; //damaged stock
                            $receive_from_office_up = $s['head_office_inv_qty_up'];

                            $closing_sellable = ($s['op_sellable'] + $receive_gret + $receive_from_office) - ($issued_bill + $issued_free_issue + $issued_gret);
                            //value
                            $closing_sellable_up = ($s['op_sellable_up'] + $receive_gret_up + $receive_from_office_up) - ($issued_bill_up + $issued_free_issue_up + $issued_gret_up);
                            //$closing_sellable = ($s['op_sellable'] + $receive_gret + $receive_from_office) - ($issued_bill + $issued_free_issue );
                            $closing_damaged = $s['op_damage'] + $receive_mret - $issued_mret;
                            //Value Damage
                            $closing_damaged_up = $s['op_damage_up'] + $receive_mret_up - $issued_mret_up;

                            $closingSellableWithPendingInv = $s['head_office_inv_qty_pending_accept'] + $closing_sellable;
                            //Values
                            $closingSellableWithPendingInv_up = $s['head_office_inv_qty_pending_accept_up'] + $closing_sellable_up;

                            $opSellableTot = $opSellableTot + $s['op_sellable'];
                            $opDamageTot = $opDamageTot + $s['op_damage'];
                            $invActualQty = $invActualQty + $s['invoice_a_qty'];
                            $invFreeQty = $invFreeQty + $s['invoice_f_qty'];
                            $invGretQty = $invGretQty + $s['invoice_g_qty'];
                            $invGretFreeQty = $invGretFreeQty + $s['invoice_g_free_qty'];
                            $invMretQty = $invMretQty + $s['invoice_m_qty'];
                            $invMretFreeQty = $invMretFreeQty + $s['invoice_m_free_qty'];
                            $invHFGretQty = $invHFGretQty + $s['good_return_qty'];
                            $invHFMretQty = $invHFMretQty + $s['market_return_qty'];
                            $invHFInvQty = $invHFInvQty + $s['head_office_inv_qty'];
                            $invHFPendingInvQty = $invHFPendingInvQty + $s['head_office_inv_qty_pending_accept'];

                            $closingSellableTot = $closingSellableTot + $closing_sellable;
                            $closingSellableWithPendingTot = $closingSellableWithPendingTot + $closingSellableWithPendingInv;
                            $closingDamageTot = $closingDamageTot + $closing_damaged;

                            $closingSellableTot_up = $closingSellableTot_up + $closing_sellable_up;
                            $closingSellableWithPendingTot_up = $closingSellableWithPendingTot_up + $closingSellableWithPendingInv_up;
                            $closingDamageTot_up = $closingDamageTot_up + $closing_damaged_up;

                            $strDaySummery .= '<tr>'
                                    . '<!-- <td colspan="1" style="text-align:right">Summery</td> -->'
                                    . '<td colspan="1" class="sticky-col first-col " >' . $s['description'] . '</td>'
                                    . '<td colspan="1">' . $s['uom'] . '</td>'
                                    . '<td colspan="1" style="text-align:right;">' . number_format($s['op_sellable']) . '</td>'
                                    . '<td colspan="1" style="text-align:right;">' . number_format($s['op_damage']) . '</td>'
                                    . '<td colspan="1" style="text-align:right;">' . number_format($s['invoice_a_qty']) . '</td>'
                                    . '<td colspan="1" class="not-required" style="text-align:right;">' . number_format($s['invoice_f_qty']) . '</td>'
                                    . '<td colspan="1" class="not-required" style="text-align:right;">' . number_format($s['invoice_g_qty']) . '</td>'
                                    . '<td colspan="1" class="not-required" style="text-align:right;">' . number_format($s['invoice_g_free_qty']) . '</td>'
                                    . '<td colspan="1" class="not-required" style="text-align:right;">' . number_format($s['invoice_m_qty']) . '</td>'
                                    . '<td colspan="1" class="not-required" style="text-align:right;">' . number_format($s['invoice_m_free_qty']) . '</td>'
                                    . '<td colspan="1" class="not-required" style="text-align:right;">' . number_format($s['good_return_qty']) . '</td>'
                                    . '<td colspan="1" class="not-required" style="text-align:right;">' . number_format($s['market_return_qty']) . '</td>'
                                    . '<td colspan="1" style="text-align:right;">' . number_format($s['head_office_inv_qty']) . '</td>'
                                    . '<td colspan="1" style="text-align:right;">' . number_format($s['head_office_inv_qty_pending_accept']) . '</td>'
                                    . '<td colspan="1" style="background: #00cc00;text-align:right; font-weight:bold;">' . number_format($closing_sellable) . '</td>'
                                    . '<td colspan="1" style="background: #fdff62;text-align:right;">' . number_format($closingSellableWithPendingInv) . '</td>'
                                    . '<td colspan="1" style="background: #ffadad;text-align:right;">' . number_format($closing_damaged) . '</td>'
                                    . '<td colspan="1" style="background: #00cc00;text-align:right; font-weight:bold;">' . number_format($closing_sellable_up) . '</td>'
                                    . '<td colspan="1" style="background: #fdff62;text-align:right;">' . number_format($closingSellableWithPendingInv_up) . '</td>'
                                    . '<td colspan="1" style="background: #ffadad;text-align:right;">' . number_format($closing_damaged_up) . '</td>'
                                    . '</tr>';
                        }
                        $strDaySummeryFoot = '<tr>'
                                . '<!-- <td>&nbsp;</td> -->'
                                . '<td colspan="2">Total Summery</td>'
                                . '<td colspan="1" style="text-align:right;">' . number_format($opSellableTot) . '</td>'
                                . '<td colspan="1" style="text-align:right;">' . number_format($opDamageTot) . '</td>'
                                . '<td colspan="1" style="text-align:right;">' . number_format($invActualQty) . '</td>'
                                . '<td colspan="1" class="not-required" style="text-align:right;">' . number_format($invFreeQty) . '</td>'
                                . '<td colspan="1" class="not-required" style="text-align:right;">' . number_format($invGretQty) . '</td>'
                                . '<td colspan="1" class="not-required" style="text-align:right;">' . number_format($invGretFreeQty) . '</td>'
                                . '<td colspan="1" class="not-required" style="text-align:right;">' . number_format($invMretQty) . '</td>'
                                . '<td colspan="1" class="not-required" style="text-align:right;">' . number_format($invMretFreeQty) . '</td>'
                                . '<td colspan="1" class="not-required" style="text-align:right;">' . number_format($invHFGretQty) . '</td>'
                                . '<td colspan="1" class="not-required" style="text-align:right;">' . number_format($invHFMretQty) . '</td>'
                                . '<td colspan="1" style="text-align:right;">' . number_format($invHFInvQty) . '</td>'
                                . '<td colspan="1" style="text-align:right;">' . number_format($invHFPendingInvQty) . '</td>'
                                . '<td colspan="1" style="background: #00cc00; font-weight:bold;text-align:right;">' . number_format($closingSellableTot, 0) . '</td>'
                                . '<td colspan="1" style="background: #fdff62; text-align:right;">' . number_format($closingSellableWithPendingTot, 0) . '</td>'
                                . '<td colspan="1" style="background: #ffadad; text-align:right;">' . number_format($closingDamageTot, 0) . '</td>'
                                . '<td colspan="1" style="background: #00cc00; font-weight:bold;text-align:right;">' . number_format($closingSellableTot_up, 0) . '</td>'
                                . '<td colspan="1" style="background: #fdff62; text-align:right;">' . number_format($closingSellableWithPendingTot_up, 0) . '</td>'
                                . '<td colspan="1" style="background: #ffadad; text-align:right;">' . number_format($closingDamageTot_up, 0) . '</td>'
                                . '</tr>';
                        ?>

                        <thead>						
                            <tr>	
                                <!-- <th >Agency Name</th> -->
                                <th class="sticky-col first-col " colspan="1">Item</th>
                                <th colspan="1">UOM</th> 
                                <th colspan="1">Opening (Sellable)</th>
                                <th colspan="1">Opening (Damaged)</th>
                                <th colspan="1">Invoice - Actual</th> 	
                                <th colspan="1" class="not-required" >Invoice - Free Issue</th> 
                                <th colspan="1" class="not-required" >Invoice - Good Return</th> 
                                <th colspan="1" class="not-required" >Invoice - Good Return Free</th> 
                                <th colspan="1" class="not-required" >Invoice - Mkt Return</th> 
                                <th colspan="1" class="not-required" >Invoice - Mkt Return Free</th> 	
                                <th colspan="1" class="not-required" >To Head Office - Good Return</th> 
                                <th colspan="1" class="not-required" >To Head Office - Mkt Return</th> 
                                <th colspan="1">Company Invoice Accepted</th> 	
                                <th colspan="1">Company Invoice Pending</th> 
                                <th colspan="1" style="background: #00cc00;">Current Stock Qty(Sellable)</th>
                                <th colspan="1" style="background: #fdff62;">Current Stock Qty(Sellable+Pending)</th>
                                <th colspan="1" style="background: #ffadad;">Current Stock Qty(Damaged)</th>
                                <th colspan="1" style="background: #00cc00;">Current Stock Value (Sellable)</th>
                                <th colspan="1" style="background: #fdff62;">Current Stock Value (Sellable+Pending)</th>
                                <th colspan="1" style="background: #ffadad;">Current Stock Value (Damaged)</th>	
                            </tr>		
                        </thead>
                        <tbody>	 
                            <?= $strDaySummery ?>               			
                        </tbody>
                        <tfoot style="font-weight: bold;font-size: 14px;">
                            <?= $strDaySummeryFoot ?>
                        </tfoot>
                    </table>
                    <?php
                }
                ?>
                <?php
                if (!empty($StockData) && isset($StockData)) {
                    $strDaySummeryDetail = '';

                    $closingSellableTot_up = 0;
                    $closingSellableWithPendingTot_up = 0;
                    $closingDamageTot_up = 0;
                    ?>

                    <div class="form-group col-md-12" style="z-index: 100;">
                        <input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('attendance_table_d', 'Current Stock Detail - <?= date('Y-m-d H:i:s') ?>')" value="Download Excel">
                    </div>
                    <div class="wrappers">
                        <table id="attendance_table_d" class="table table-hover presentation">	
                            <?php
                            foreach ($StockData as $s) {
                                //issued
                                $issued_bill = $s['invoice_a_qty'] + $s['invoice_g_qty'] + $s['invoice_m_qty']; //total issued qty without free issue
                                $issued_free_issue = $s['invoice_f_qty'];
                                $issued_gret = $s['good_return_qty']; //gret send to head office
                                $issued_mret = $s['market_return_qty']; //mret send to head office - damaged
                                //
                                //issued values
                                $issued_bill_up = $s['invoice_a_qty_up'] + $s['invoice_g_qty_up'] + $s['invoice_m_qty_up']; //total issued qty without free issue
                                $issued_free_issue_up = $s['invoice_f_qty_up'];
                                $issued_gret_up = $s['good_return_qty_up']; //gret send to head office
                                $issued_mret_up = $s['market_return_qty_up']; //mret send to head office - damaged
                                //
                                //
                                //received
                                $receive_gret = $s['invoice_g_qty'] + $s['invoice_g_free_qty'];
                                $receive_mret = $s['invoice_m_qty'] + $s['invoice_m_free_qty']; //damaged stock
                                $receive_from_office = $s['head_office_inv_qty'];
                                //received Values
                                $receive_gret_up = $s['invoice_g_qty_up'] + $s['invoice_g_free_qty_up'];
                                $receive_mret_up = $s['invoice_m_qty_up'] + $s['invoice_m_free_qty_up']; //damaged stock
                                $receive_from_office_up = $s['head_office_inv_qty_up'];

                                $closing_sellable = ($s['op_sellable'] + $receive_gret + $receive_from_office) - ($issued_bill + $issued_free_issue + $issued_gret);
                                //values
                                $closing_sellable_up = ($s['op_sellable_up'] + $receive_gret_up + $receive_from_office_up) - ($issued_bill_up + $issued_free_issue_up + $issued_gret_up);

                                $closing_sellablewithPending = $closing_sellable + $s['head_office_inv_qty_pending_accept'];
                                //values
                                $closing_sellablewithPending_up = $closing_sellable_up + $s['head_office_inv_qty_pending_accept_up'];
                                //$closing_sellable = ($s['op_sellable'] + $receive_gret + $receive_from_office) - ($issued_bill + $issued_free_issue );
                                $closing_damaged = $s['op_damage'] + $receive_mret - $issued_mret;
                                ///values
                                $closing_damaged_up = $s['op_damage_up'] + $receive_mret_up - $issued_mret_up;

                                $closingSellableTot_up = $closingSellableTot_up + $closing_sellable_up;
                                $closingSellableWithPendingTot_up = $closingSellableWithPendingTot_up + $closing_sellablewithPending_up;
                                $closingDamageTot_up = $closingDamageTot_up + $closing_damaged_up;

                                if (!empty($AreaID) && isset($AreaID)) {
                                    $strDaySummeryDetail .= '<tr>'
                                            //. '<!-- <td colspan="1"><a target="_blank" href="' . base_url('salesreports/stockLog/' . $s['location_code'] . '/' . $RangeID . '/' . $s['item']) . '">' . $s['agency_name'] . ' (' . $s['agency_code'] . ')</a></td> -->'
                                            . '<td colspan="1" style="text-align:left;" class="sticky-col first-col " ><a target="_blank" href="">' . $s['description'] . '</a></td>'
                                            . '<td colspan="1" style="text-align:left;" >' . $s['agency_name'] . ' (' . $s['agency_code'] . ')</td>'
                                            . '<td colspan="1" style="text-align:left;">' . $s['uom'] . '</td>'
                                            . '<td colspan="1" style="text-align:right;">' . number_format($s['op_sellable']) . '</td>'
                                            . '<td colspan="1" style="text-align:right;">' . number_format($s['op_damage']) . '</td>'
                                            . '<td colspan="1" style="text-align:right;">' . number_format($s['invoice_a_qty']) . '</td>'
                                            . '<td colspan="1" class="not-required" style="text-align:right;">' . number_format($s['invoice_f_qty']) . '</td>'
                                            . '<td colspan="1" class="not-required" style="text-align:right;">' . number_format($s['invoice_g_qty']) . '</td>'
                                            . '<td colspan="1" class="not-required" style="text-align:right;">' . number_format($s['invoice_g_free_qty']) . '</td>'
                                            . '<td colspan="1" class="not-required" style="text-align:right;">' . number_format($s['invoice_m_qty']) . '</td>'
                                            . '<td colspan="1" class="not-required" style="text-align:right;">' . number_format($s['invoice_m_free_qty']) . '</td>'
                                            . '<td colspan="1" class="not-required" style="text-align:right;">' . number_format($s['good_return_qty']) . '</td>'
                                            . '<td colspan="1" class="not-required" style="text-align:right;">' . number_format($s['market_return_qty']) . '</td>'
                                            . '<td colspan="1" style="text-align:right;">' . number_format($s['head_office_inv_qty']) . '</td>'
                                            . '<td colspan="1" style="text-align:right;">' . number_format($s['head_office_inv_qty_pending_accept']) . '</td>'
                                            . '<td colspan="1" style="background: #00cc00; font-weight:bold;text-align:right;">' . number_format($closing_sellable, 0) . '</td>'
                                            . '<td colspan="1" style="background: #fdff62;text-align:right;">' . number_format($closing_sellablewithPending, 0) . '</td>'
                                            . '<td colspan="1" style="background: #ffadad;text-align:right;">' . number_format($closing_damaged, 0) . '</td>'
                                            . '<td colspan="1" style="background: #00cc00; font-weight:bold;text-align:right;">' . number_format($closing_sellable_up, 0) . '</td>'
                                            . '<td colspan="1" style="background: #fdff62;text-align:right;">' . number_format($closing_sellablewithPending_up, 0) . '</td>'
                                            . '<td colspan="1" style="background: #ffadad;text-align:right;">' . number_format($closing_damaged_up, 0) . '</td>'
                                            . '</tr>';
                                } else {
                                    $strDaySummeryDetail .= '<tr>'
                                            . '<!-- <td colspan="1"><a target="_blank" href="' . base_url('salesreports/stockLog/' . $s['location_code'] . '/' . $RangeID . '/' . $s['item']) . '">' . $s['agency_name'] . ' (' . $s['agency_code'] . ')</a></td> -->'
                                            . '<td colspan="1" class="sticky-col first-col " ><a target="_blank" href="' . base_url('salesreports/stockLog/' . $s['location_code'] . '/' . $RangeID . '/' . $s['item']) . '">' . $s['description'] . '</a></td>'
                                            . '<td colspan="1">' . $s['agency_name'] . ' (' . $s['agency_code'] . ')</td>'
                                            . '<td colspan="1">' . $s['uom'] . '</td>'
                                            . '<td colspan="1" style="text-align:right;">' . number_format($s['op_sellable']) . '</td>'
                                            . '<td colspan="1" style="text-align:right;">' . number_format($s['op_damage']) . '</td>'
                                            . '<td colspan="1" style="text-align:right;">' . number_format($s['invoice_a_qty']) . '</td>'
                                            . '<td colspan="1" class="not-required" style="text-align:right;">' . number_format($s['invoice_f_qty']) . '</td>'
                                            . '<td colspan="1" class="not-required" style="text-align:right;">' . number_format($s['invoice_g_qty']) . '</td>'
                                            . '<td colspan="1" class="not-required" style="text-align:right;">' . number_format($s['invoice_g_free_qty']) . '</td>'
                                            . '<td colspan="1" class="not-required" style="text-align:right;">' . number_format($s['invoice_m_qty']) . '</td>'
                                            . '<td colspan="1" class="not-required" style="text-align:right;">' . number_format($s['invoice_m_free_qty']) . '</td>'
                                            . '<td colspan="1" class="not-required" style="text-align:right;">' . number_format($s['good_return_qty']) . '</td>'
                                            . '<td colspan="1" class="not-required" style="text-align:right;">' . number_format($s['market_return_qty']) . '</td>'
                                            . '<td colspan="1" style="text-align:right;">' . number_format($s['head_office_inv_qty']) . '</td>'
                                            . '<td colspan="1" style="text-align:right;">' . number_format($s['head_office_inv_qty_pending_accept']) . '</td>'
                                            . '<td colspan="1" style="background: #00cc00; font-weight:bold;text-align:right;">' . number_format($closing_sellable, 0) . '</td>'
                                            . '<td colspan="1" style="background: #fdff62;text-align:right;">' . number_format($closing_sellablewithPending, 0) . '</td>'
                                            . '<td colspan="1" style="background: #ffadad;text-align:right;">' . number_format($closing_damaged, 0) . '</td>'
                                            . '<td colspan="1" style="background: #00cc00; font-weight:bold;text-align:right;">' . number_format($closing_sellable_up, 0) . '</td>'
                                            . '<td colspan="1" style="background: #fdff62;text-align:right;">' . number_format($closing_sellablewithPending_up, 0) . '</td>'
                                            . '<td colspan="1" style="background: #ffadad;text-align:right;">' . number_format($closing_damaged_up, 0) . '</td>'
                                            . '</tr>';
                                }
                            }
                            ?> 

                            <thead>						
                                <tr>	
                                    <!-- <th>Agency Name</th> -->
                                    <th class="sticky-col first-col text-left" colspan="1">Item</th>
                                    <?php
                                    if (!empty($AreaID) && isset($AreaID)) {
                                        ?>
                                        <th>Agency Name</th>
                                        <?php
                                    } else {
                                        ?>
                                        <th>Agency Name</th>
                                    <?php } ?>
                                    <th colspan="1">UOM</th> 
                                    <th colspan="1">Opening (Sellable)</th>
                                    <th colspan="1">Opening (Damaged)</th>
                                    <th colspan="1">Invoice - Actual</th> 	
                                    <th colspan="1" class="not-required" >Invoice - Free Issue</th> 
                                    <th colspan="1" class="not-required" >Invoice - Good Return</th> 
                                    <th colspan="1" class="not-required" >Invoice - Good Return Free</th> 
                                    <th colspan="1" class="not-required" >Invoice - Mkt Return</th> 
                                    <th colspan="1" class="not-required" >Invoice - Mkt Return Free</th> 	
                                    <th colspan="1" class="not-required" >To Head Office - Good Return</th> 
                                    <th colspan="1" class="not-required" >To Head Office - Mkt Return</th> 
                                    <th colspan="1">Company Invoice Accepted</th> 	
                                    <th colspan="1">Company Invoice Pending</th> 
                                    <th colspan="1" style="background: #00cc00;">Current Stock Qty (Sellable)</th>
                                    <th colspan="1" style="background: #fdff62;">Current Stock Qty (Sellable+Pending)</th>
                                    <th colspan="1" style="background: #ffadad;">Current Stock Qty (Damaged)</th>
                                    <th colspan="1" style="background: #00cc00;">Current Stock Value (Sellable)</th>
                                    <th colspan="1" style="background: #fdff62;">Current Stock Value (Sellable+Pending)</th>
                                    <th colspan="1" style="background: #ffadad;">Current Stock Value (Damaged)</th>	
                                </tr>		
                            </thead>
                            <tbody>	 
                                <?= $strDaySummeryDetail ?>               			
                            </tbody> 					
                            <tfoot>
                                <tr style="font-size: 14px; font-weight: bold;">
                                    <?php
                                    if (!empty($AreaID) && isset($AreaID)) {
                                        ?>
                                        <td colspan="18" style="text-align:right;">Total Value</td> 
                                        <?php
                                    } else {
                                        ?>
                                        <td colspan="18" style="text-align:right;">Total Value</td> 
                                        <?php
                                    }
                                    ?>

                                    <td colspan="1" style="text-align:right;"><?= number_format($closingSellableTot_up, 0) ?></td> 
                                    <td colspan="1" style="text-align:right;"><?= number_format($closingSellableWithPendingTot_up, 0) ?></td> 
                                    <td colspan="1" style="text-align:right;"><?= number_format($closingDamageTot_up, 0) ?></td> 
                                </tr>
                            </tfoot>  


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

                            var hide = 0;
                            function hideTableColomns() {
                                if (hide === 0) {
                                    $(".not-required").css('display', 'none');
                                    $("#colomnStatus").val('Show all columns');
                                    $("#totalTextField").attr('colspan', 10);
                                    hide = 1;
                                } else {
                                    $(".not-required").show();
                                    $("#colomnStatus").val('Show only important columns');
                                    $("#totalTextField").attr('colspan', 17);
                                    hide = 0;
                                }
                            }
                            hideTableColomns();


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

<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="  crossorigin="anonymous"></script>
<script>
                            $('#RangeRepStock').on('change', function (e) {

                                // If you just need "value" (which's like having "key" of an associative-array).
                                var selectedValue = this.value;
                                $('.cat-box:not(.' + selectedValue + ')').hide(500);
                                $('.' + selectedValue).show(500);
                                // Else.
                                //var $selectedOptionElement = $("option:selected", this);
                                //var selectedValue = $selectedOptionElement.val();
                                //var selectedText = $selectedOptionElement.text();
                            });
                            $("#RangeRepStock").trigger("change");
                            function setCategory(id) {
                                $('#category').val(id);
                                document.getElementById('submit').click();
                                //document.getElementById("myForm").submit();
                            }
</script>