<?php include_once BASEPATH . ('../application/views/template/leftsidebar.php'); ?>

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
                <form class="form-horizontal" id="" action="<?= base_url('welcome/home') ?>" method="post">
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
                            <label class="col-md-2">Range <span class="text-red">*</span></label>
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
                            <input type="submit" class="btn btn-danger" name="submit" value="Get Report">
                        </div>                                
                    </div>
                </form>
            </div>

        </div>
        <div class="col-md-12" style="overflow-x: scroll;">
            <div class="row">
                <div class="col-lg-12 col-xs-12">
                    <?php
                    if (!empty($DailySales) && isset($DailySales)) {
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
                        $totF = 0;
                        ?>
                        <h2>Total Actual Achievement</h2>
                        <input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('attendance_table', 'Daily Sales April')" value="Download Excel"><br>
                        <table id="attendance_table" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Area</th>
                                    <th>Territory</th>
                                    <th>Territory Code</th>
                                    <th>Range</th>
                                    <th>April-01</th>
                                    <th>April-02</th>
                                    <th>April-03</th>
                                    <th>April-04</th>
                                    <th>April-05</th>
                                    <th>April-06</th>
                                    <th>April-07</th>
                                    <th>April-08</th>
                                    <th>April-09</th>
                                    <th>April-10</th>
                                    <th>April-11</th>
                                    <th>April-12</th>
                                    <th>April-13</th>
                                    <th>April-14</th>
                                    <th>April-15</th>
                                    <th>April-16</th>
                                    <th>April-17</th>
                                    <th>April-18</th>
                                    <th>April-19</th>
                                    <th>April-20</th>
                                    <th>April-Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($DailySales as $v) {
                                    $tot01 = $tot01+ $v['April-01'];
                                    $tot02 = $tot02+$v['April-02'];
                                    $tot03 = $tot03+$v['April-03'];
                                    $tot04 = $tot04+$v['April-04'];
                                    $tot05 = $tot05+$v['April-05'];
                                    $tot06 = $tot06+$v['April-06'];
                                    $tot07 = $tot07+$v['April-07'];
                                    $tot08 = $tot08+$v['April-08'];
                                    $tot09 = $tot09+$v['April-09'];
                                    $tot10 = $tot10+$v['April-10'];
                                    $tot11 = $tot11+$v['April-11'];
                                    $tot12 = $tot12+$v['April-12'];
                                    $tot13 = $tot13+$v['April-13'];
                                    $tot14 = $tot14+$v['April-14'];
                                    $tot15 = $tot15+$v['April-15'];
                                    $tot16 = $tot16+$v['April-16'];
                                    $tot17 = $tot17+$v['April-17'];
                                    $tot18 = $tot18+$v['April-18'];
                                    $tot19 = $tot19+$v['April-19'];
                                    $tot20 = $tot20+$v['April-20'];
                                    $totF = $totF+$v['April-Total'];
                                    echo '<tr>'
                                    . '<td>' . $v['area_name'] . '</td>'
                                    . '<td>' . $v['ag_name'] . '</td>'
                                    . '<td>' . $v['ag_cd'] . '</td>'
                                    . '<td>' . $v['cd'] . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-01']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-02']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-03']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-04']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-05']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-06']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-07']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-08']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-09']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-10']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-11']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-12']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-13']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-14']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-15']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-16']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-17']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-18']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-19']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-20']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-Total']) . '</td>'
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
                                    <th>April-Total-Aarya-Pads</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($DailySalesD as $v) {
                                    $tot01 = $tot01+ $v['April-01-Aarya-Pads'];
                                    $tot02 = $tot02+$v['April-02-Aarya-Pads'];
                                    $tot03 = $tot03+$v['April-03-Aarya-Pads'];
                                    $tot04 = $tot04+$v['April-04-Aarya-Pads'];
                                    $tot05 = $tot05+$v['April-05-Aarya-Pads'];
                                    $tot06 = $tot06+$v['April-06-Aarya-Pads'];
                                    $tot07 = $tot07+$v['April-07-Aarya-Pads'];
                                    $tot08 = $tot08+$v['April-08-Aarya-Pads'];
                                    $tot09 = $tot09+$v['April-09-Aarya-Pads'];
                                    $tot10 = $tot10+$v['April-10-Aarya-Pads'];
                                    $tot11 = $tot11+$v['April-11-Aarya-Pads'];
                                    $tot12 = $tot12+$v['April-12-Aarya-Pads'];
                                    $tot13 = $tot13+$v['April-13-Aarya-Pads'];
                                    $tot14 = $tot14+$v['April-14-Aarya-Pads'];
                                    $tot15 = $tot15+$v['April-15-Aarya-Pads'];
                                    $tot16 = $tot16+$v['April-16-Aarya-Pads'];
                                    $tot17 = $tot17+$v['April-17-Aarya-Pads'];
                                    $tot18 = $tot18+$v['April-18-Aarya-Pads'];
                                    $tot19 = $tot19+$v['April-19-Aarya-Pads'];
                                    $tot20 = $tot20+$v['April-20-Aarya-Pads'];
                                    $totF = $totF+$v['April-Total-Aarya-Pads'];
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
                                    <th>April-Total-Soya</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($DailySalesSoya as $v) {
                                    $tot01 = $tot01+ $v['April-01-Soya'];
                                    $tot02 = $tot02+$v['April-02-Soya'];
                                    $tot03 = $tot03+$v['April-03-Soya'];
                                    $tot04 = $tot04+$v['April-04-Soya'];
                                    $tot05 = $tot05+$v['April-05-Soya'];
                                    $tot06 = $tot06+$v['April-06-Soya'];
                                    $tot07 = $tot07+$v['April-07-Soya'];
                                    $tot08 = $tot08+$v['April-08-Soya'];
                                    $tot09 = $tot09+$v['April-09-Soya'];
                                    $tot10 = $tot10+$v['April-10-Soya'];
                                    $tot11 = $tot11+$v['April-11-Soya'];
                                    $tot12 = $tot12+$v['April-12-Soya'];
                                    $tot13 = $tot13+$v['April-13-Soya'];
                                    $tot14 = $tot14+$v['April-14-Soya'];
                                    $tot15 = $tot15+$v['April-15-Soya'];
                                    $tot16 = $tot16+$v['April-16-Soya'];
                                    $tot17 = $tot17+$v['April-17-Soya'];
                                    $tot18 = $tot18+$v['April-18-Soya'];
                                    $tot19 = $tot19+$v['April-19-Soya'];
                                    $tot20 = $tot20+$v['April-20-Soya'];
                                    $totF = $totF+$v['April-Total-Soya'];
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
                                    <th>April-Total-Nenaposha</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($DailySalesNenaposha as $v) {
                                    $tot01 = $tot01+ $v['April-01-Nenaposha'];
                                    $tot02 = $tot02+$v['April-02-Nenaposha'];
                                    $tot03 = $tot03+$v['April-03-Nenaposha'];
                                    $tot04 = $tot04+$v['April-04-Nenaposha'];
                                    $tot05 = $tot05+$v['April-05-Nenaposha'];
                                    $tot06 = $tot06+$v['April-06-Nenaposha'];
                                    $tot07 = $tot07+$v['April-07-Nenaposha'];
                                    $tot08 = $tot08+$v['April-08-Nenaposha'];
                                    $tot09 = $tot09+$v['April-09-Nenaposha'];
                                    $tot10 = $tot10+$v['April-10-Nenaposha'];
                                    $tot11 = $tot11+$v['April-11-Nenaposha'];
                                    $tot12 = $tot12+$v['April-12-Nenaposha'];
                                    $tot13 = $tot13+$v['April-13-Nenaposha'];
                                    $tot14 = $tot14+$v['April-14-Nenaposha'];
                                    $tot15 = $tot15+$v['April-15-Nenaposha'];
                                    $tot16 = $tot16+$v['April-16-Nenaposha'];
                                    $tot17 = $tot17+$v['April-17-Nenaposha'];
                                    $tot18 = $tot18+$v['April-18-Nenaposha'];
                                    $tot19 = $tot19+$v['April-19-Nenaposha'];
                                    $tot20 = $tot20+$v['April-20-Nenaposha'];
                                    $totF = $totF+$v['April-Total-Nenaposha'];
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
                                    <th>April-Total-DB</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($DailySalesDB as $v) {
                                    $tot01 = $tot01+$v['April-01-db'];
                                    $tot02 = $tot02+$v['April-02-db'];
                                    $tot03 = $tot03+$v['April-03-db'];
                                    $tot04 = $tot04+$v['April-04-db'];
                                    $tot05 = $tot05+$v['April-05-db'];
                                    $tot06 = $tot06+$v['April-06-db'];
                                    $tot07 = $tot07+$v['April-07-db'];
                                    $tot08 = $tot08+$v['April-08-db'];
                                    $tot09 = $tot09+$v['April-09-db'];
                                    $tot10 = $tot10+$v['April-10-db'];
                                    $tot11 = $tot11+$v['April-11-db'];
                                    $tot12 = $tot12+$v['April-12-db'];
                                    $tot13 = $tot13+$v['April-13-db'];
                                    $tot14 = $tot14+$v['April-14-db'];
                                    $tot15 = $tot15+$v['April-15-db'];
                                    $tot16 = $tot16+$v['April-16-db'];
                                    $tot17 = $tot17+$v['April-17-db'];
                                    $tot18 = $tot18+$v['April-18-db'];
                                    $tot19 = $tot19+$v['April-19-db'];
                                    $tot20 = $tot20+$v['April-20-db'];
                                    $totF = $totF+$v['April-Total-db'];
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
