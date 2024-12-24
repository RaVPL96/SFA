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
                                    <th>April-21</th>
                                    <th>April-22</th>
                                    <th>April-23</th>
                                    <th>April-24</th>
                                    <th>April-25</th>
                                    <th>April-26</th>
                                    <th>April-27</th>
                                    <th>April-28</th>
                                    <th>April-29</th>
                                    <th>April-30</th>
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
                                    $tot21 = $tot21+$v['April-21'];
                                    $tot22 = $tot22+$v['April-22'];
                                    $tot23 = $tot23+$v['April-23'];
                                    $tot24 = $tot24+$v['April-24'];
                                    $tot25 = $tot25+$v['April-25'];
                                    $tot26 = $tot26+$v['April-26'];
                                    $tot27 = $tot27+$v['April-27'];
                                    $tot28 = $tot28+$v['April-28'];
                                    $tot29 = $tot29+$v['April-29'];
                                    $tot30 = $tot30+$v['April-30'];
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
                                    . '<td class="text-right">' . number_format($v['April-21']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-22']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-23']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-24']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-25']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-26']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-27']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-28']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-29']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-30']) . '</td>'
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
                        
                        $rowTotPc=0;
                        
                        $totF = 0;
                        $totPcF=0;
                        ?>
                        <h2>Total Actual Achievement with PC</h2>
                        <input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('attendance_table', 'Daily Sales April')" value="Download Excel"><br>
                        <table id="attendance_table" class="table table-hover">
                            <thead>
                                <tr>
                                    <th colspan="4"></th>
                                     
                                     
                                     
                                    <th colspan="2">April-01</th>
                                    
                                    <th colspan="2">April-02</th>
                                    <th colspan="2">April-03</th>
                                    <th colspan="2">April-04</th>
                                    <th colspan="2">April-05</th>
                                    <th colspan="2">April-06</th>
                                    <th colspan="2">April-07</th>
                                    <th colspan="2">April-08</th>
                                    <th colspan="2">April-09</th>
                                    <th colspan="2">April-10</th>
                                    <th colspan="2">April-11</th>
                                    <th colspan="2">April-12</th>
                                    <th colspan="2">April-13</th>
                                    <th colspan="2">April-14</th>
                                    <th colspan="2">April-15</th>
                                    <th colspan="2">April-16</th>
                                    <th colspan="2">April-17</th>
                                    <th colspan="2">April-18</th>
                                    <th colspan="2">April-19</th>
                                    <th colspan="2">April-20</th>
                                    <th colspan="2">April-21</th>
                                    <th colspan="2">April-22</th>
                                    <th colspan="2">April-23</th>
                                    <th colspan="2">April-24</th>
                                    <th colspan="2">April-25</th>
                                    <th colspan="2">April-26</th>
                                    <th colspan="2">April-27</th>
                                    <th colspan="2">April-28</th>
                                    <th colspan="2">April-29</th>
                                    <th colspan="2">April-30</th> 
                                    <th colspan="2">April-Total</th> 
                                </tr>
                                <tr>
                                    <th>Area</th>
                                    <th>Territory</th>
                                    <th>Territory Code</th>
                                    <th>Range</th>
                                    <th>Value</th>
                                    <th style="background: #efebb9;">PC</th>
                                    <th>Value</th>
                                    <th style="background: #efebb9;">PC</th>
                                    <th>Value</th>
                                    <th style="background: #efebb9;">PC</th>
                                    <th>Value</th>
                                    <th style="background: #efebb9;">PC</th>
                                    <th>Value</th>
                                    <th style="background: #efebb9;">PC</th>
                                    <th>Value</th>
                                    <th style="background: #efebb9;">PC</th>
                                    <th>Value</th>
                                    <th style="background: #efebb9;">PC</th>
                                    <th>Value</th>
                                    <th style="background: #efebb9;">PC</th>
                                    <th>Value</th>
                                    <th style="background: #efebb9;">PC</th>
                                    <th>Value</th>
                                    <th style="background: #efebb9;">PC</th>
                                    <th>Value</th>
                                    <th style="background: #efebb9;">PC</th>
                                    <th>Value</th>
                                    <th style="background: #efebb9;">PC</th>
                                    <th>Value</th>
                                    <th style="background: #efebb9;">PC</th>
                                    <th>Value</th>
                                    <th style="background: #efebb9;">PC</th>
                                    <th>Value</th>
                                    <th style="background: #efebb9;">PC</th>
                                    <th>Value</th>
                                    <th style="background: #efebb9;">PC</th>
                                    <th>Value</th>
                                    <th style="background: #efebb9;">PC</th>
                                    <th>Value</th>
                                    <th style="background: #efebb9;">PC</th>
                                    <th>Value</th>
                                    <th style="background: #efebb9;">PC</th>
                                    <th>Value</th>
                                    <th style="background: #efebb9;">PC</th>
                                    <th>Value</th>
                                    <th style="background: #efebb9;">PC</th>
                                    <th>Value</th>
                                    <th style="background: #efebb9;">PC</th>
                                    <th>Value</th>
                                    <th style="background: #efebb9;">PC</th>
                                    <th>Value</th>
                                    <th style="background: #efebb9;">PC</th>
                                    <th>Value</th>
                                    <th style="background: #efebb9;">PC</th>
                                    <th>Value</th>
                                    <th style="background: #efebb9;">PC</th>
                                    <th>Value</th>
                                    <th style="background: #efebb9;">PC</th>
                                    <th>Value</th>
                                    <th style="background: #efebb9;">PC</th>
                                    <th>Value</th>
                                    <th style="background: #efebb9;">PC</th>
                                    <th>Value</th>
                                    <th style="background: #efebb9;">PC</th>
                                    <th>April-Total</th> 
                                    <th style="background: #efebb9;">April-Total-PC</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($DailySales as $v) {
                                    $rowTotPc=0;
                                    $tot01 = $tot01+$v['April-01'];
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
                                    $tot21 = $tot21+$v['April-21'];
                                    $tot22 = $tot22+$v['April-22'];
                                    $tot23 = $tot23+$v['April-23'];
                                    $tot24 = $tot24+$v['April-24'];
                                    $tot25 = $tot25+$v['April-25'];
                                    $tot26 = $tot26+$v['April-26'];
                                    $tot27 = $tot27+$v['April-27'];
                                    $tot28 = $tot28+$v['April-28'];
                                    $tot29 = $tot29+$v['April-29'];
                                    $tot30 = $tot30+$v['April-30'];
                                    
                                    
                                    $tot01_pc = $tot01_pc+$v['April-01-pc'];
                                    $tot02_pc = $tot02_pc+$v['April-02-pc'];
                                    $tot03_pc = $tot03_pc+$v['April-03-pc'];
                                    $tot04_pc = $tot04_pc+$v['April-04-pc'];
                                    $tot05_pc = $tot05_pc+$v['April-05-pc'];
                                    $tot06_pc = $tot06_pc+$v['April-06-pc'];
                                    $tot07_pc = $tot07_pc+$v['April-07-pc'];
                                    $tot08_pc = $tot08_pc+$v['April-08-pc'];
                                    $tot09_pc = $tot09_pc+$v['April-09-pc'];
                                    $tot10_pc = $tot10_pc+$v['April-10-pc'];
                                    $tot11_pc = $tot11_pc+$v['April-11-pc'];
                                    $tot12_pc = $tot12_pc+$v['April-12-pc'];
                                    $tot13_pc = $tot13_pc+$v['April-13-pc'];
                                    $tot14_pc = $tot14_pc+$v['April-14-pc'];
                                    $tot15_pc = $tot15_pc+$v['April-15-pc'];
                                    $tot16_pc = $tot16_pc+$v['April-16-pc'];
                                    $tot17_pc = $tot17_pc+$v['April-17-pc'];
                                    $tot18_pc = $tot18_pc+$v['April-18-pc'];
                                    $tot19_pc = $tot19_pc+$v['April-19-pc'];
                                    $tot20_pc = $tot20_pc+$v['April-20-pc'];
                                    $tot21_pc = $tot21_pc+$v['April-21-pc'];
                                    $tot22_pc = $tot22_pc+$v['April-22-pc'];
                                    $tot23_pc = $tot23_pc+$v['April-23-pc'];
                                    $tot24_pc = $tot24_pc+$v['April-24-pc'];
                                    $tot25_pc = $tot25_pc+$v['April-25-pc'];
                                    $tot26_pc = $tot26_pc+$v['April-26-pc'];
                                    $tot27_pc = $tot27_pc+$v['April-27-pc'];
                                    $tot28_pc = $tot28_pc+$v['April-28-pc'];
                                    $tot29_pc = $tot29_pc+$v['April-29-pc'];
                                    $tot30_pc = $tot30_pc+$v['April-30-pc'];
                                    
                                    $rowTotPc=$v['April-01-pc']
                                    +$v['April-02-pc']
                                    +$v['April-03-pc']
                                    +$v['April-04-pc']
                                    +$v['April-05-pc']
                                    +$v['April-06-pc']
                                    +$v['April-07-pc']
                                    +$v['April-08-pc']
                                    +$v['April-09-pc']
                                    +$v['April-10-pc']
                                    +$v['April-11-pc']
                                    +$v['April-12-pc']
                                    +$v['April-13-pc']
                                    +$v['April-14-pc']
                                    +$v['April-15-pc']
                                    +$v['April-16-pc']
                                    +$v['April-17-pc']
                                    +$v['April-18-pc']
                                    +$v['April-19-pc']
                                    +$v['April-20-pc']
                                    +$v['April-21-pc']
                                    +$v['April-22-pc']
                                    +$v['April-23-pc']
                                    +$v['April-24-pc']
                                    +$v['April-25-pc']
                                    +$v['April-26-pc']
                                    +$v['April-27-pc']
                                    +$v['April-28-pc']
                                    +$v['April-29-pc']
                                    +$v['April-30-pc'];
                                    
                                    $totF = $totF+$v['April-Total'];
                                    $totPcF=$totPcF+$rowTotPc;
                                    echo '<tr>'
                                    . '<td>' . $v['area_name'] . '</td>'
                                    . '<td>' . $v['ag_name'] . '</td>'
                                    . '<td>' . $v['ag_cd'] . '</td>'
                                    . '<td>' . $v['cd'] . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-01']) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($v['April-01-pc']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-02']) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($v['April-02-pc']) . '</td>'        
                                    . '<td class="text-right">' . number_format($v['April-03']) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($v['April-03-pc']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-04']) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($v['April-04-pc']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-05']) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($v['April-05-pc']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-06']) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($v['April-06-pc']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-07']) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($v['April-07-pc']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-08']) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($v['April-08-pc']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-09']) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($v['April-09-pc']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-10']) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($v['April-10-pc']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-11']) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($v['April-11-pc']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-12']) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($v['April-12-pc']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-13']) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($v['April-13-pc']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-14']) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($v['April-14-pc']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-15']) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($v['April-15-pc']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-16']) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($v['April-16-pc']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-17']) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($v['April-17-pc']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-18']) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($v['April-18-pc']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-19']) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($v['April-19-pc']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-20']) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($v['April-20-pc']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-21']) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($v['April-21-pc']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-22']) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($v['April-22-pc']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-23']) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($v['April-23-pc']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-24']) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($v['April-24-pc']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-25']) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($v['April-25-pc']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-26']) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($v['April-26-pc']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-27']) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($v['April-27-pc']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-28']) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($v['April-28-pc']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-29']) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($v['April-29-pc']) . '</td>'
                                    . '<td class="text-right">' . number_format($v['April-30']) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($v['April-30-pc']) . '</td>'
                                    . '<td class="text-right" style="font-weight:bold;">' . number_format($v['April-Total']) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;font-weight:bold;">' . number_format($rowTotPc) . '</td>'
                                    . '</tr>';
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <?php
                                echo '<tr style="font-weight:bold;">'
                                    . '<td colspan="4">Total</td>' 
                                    . '<td class="text-right">' . number_format($tot01) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($tot01_pc) . '</td>'
                                    . '<td class="text-right">' . number_format($tot02) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($tot02_pc) . '</td>'
                                    . '<td class="text-right">' . number_format($tot03) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($tot03_pc) . '</td>'
                                    . '<td class="text-right">' . number_format($tot04) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($tot04_pc) . '</td>'
                                    . '<td class="text-right">' . number_format($tot05) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($tot05_pc) . '</td>'
                                    . '<td class="text-right">' . number_format($tot06) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($tot06_pc) . '</td>'
                                    . '<td class="text-right">' . number_format($tot07) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($tot07_pc) . '</td>'
                                    . '<td class="text-right">' . number_format($tot08) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($tot08_pc) . '</td>'
                                    . '<td class="text-right">' . number_format($tot09) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($tot09_pc) . '</td>'
                                    . '<td class="text-right">' . number_format($tot10) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($tot10_pc) . '</td>'
                                    . '<td class="text-right">' . number_format($tot11) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($tot11_pc) . '</td>'
                                    . '<td class="text-right">' . number_format($tot12) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($tot12_pc) . '</td>'
                                    . '<td class="text-right">' . number_format($tot13) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($tot13_pc) . '</td>'
                                    . '<td class="text-right">' . number_format($tot14) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($tot14_pc) . '</td>'
                                    . '<td class="text-right">' . number_format($tot15) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($tot15_pc) . '</td>'
                                    . '<td class="text-right">' . number_format($tot16) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($tot16_pc) . '</td>'
                                    . '<td class="text-right">' . number_format($tot17) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($tot17_pc) . '</td>'
                                    . '<td class="text-right">' . number_format($tot18) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($tot18_pc) . '</td>'
                                    . '<td class="text-right">' . number_format($tot19) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($tot19_pc) . '</td>'
                                    . '<td class="text-right">' . number_format($tot20) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($tot20_pc) . '</td>'
                                    . '<td class="text-right">' . number_format($tot21) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($tot21_pc) . '</td>'
                                    . '<td class="text-right">' . number_format($tot22) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($tot22_pc) . '</td>'
                                    . '<td class="text-right">' . number_format($tot23) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($tot23_pc) . '</td>'
                                    . '<td class="text-right">' . number_format($tot24) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($tot24_pc) . '</td>'
                                    . '<td class="text-right">' . number_format($tot25) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($tot25_pc) . '</td>'
                                    . '<td class="text-right">' . number_format($tot26) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($tot26_pc) . '</td>'
                                    . '<td class="text-right">' . number_format($tot27) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($tot27_pc) . '</td>'
                                    . '<td class="text-right">' . number_format($tot28) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($tot28_pc) . '</td>'
                                    . '<td class="text-right">' . number_format($tot29) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($tot29_pc) . '</td>'
                                    . '<td class="text-right">' . number_format($tot30) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;">' . number_format($tot30_pc) . '</td>'
                                    . '<td class="text-right" style="font-weight:bold;">' . number_format($totF) . '</td>'
                                    . '<td class="text-right" style="background: #efebb9;font-weight:bold;">' . number_format($totPcF). '</td>'    
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
                                    $tot21 = $tot21+$v['April-21-Aarya-Pads'];
                                    $tot22 = $tot22+$v['April-22-Aarya-Pads'];
                                    $tot23 = $tot23+$v['April-23-Aarya-Pads'];
                                    $tot24 = $tot24+$v['April-24-Aarya-Pads'];
                                    $tot25 = $tot25+$v['April-25-Aarya-Pads'];
                                    $tot26 = $tot26+$v['April-26-Aarya-Pads'];
                                    $tot27 = $tot27+$v['April-27-Aarya-Pads'];
                                    $tot28 = $tot28+$v['April-28-Aarya-Pads'];
                                    $tot29 = $tot29+$v['April-29-Aarya-Pads'];
                                    $tot30 = $tot30+$v['April-30-Aarya-Pads'];
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
                                    $tot21 = $tot21+$v['April-21-Soya'];
                                    $tot22 = $tot22+$v['April-22-Soya'];
                                    $tot23 = $tot23+$v['April-23-Soya'];
                                    $tot24 = $tot24+$v['April-24-Soya'];
                                    $tot25 = $tot25+$v['April-25-Soya'];
                                    $tot26 = $tot26+$v['April-26-Soya'];
                                    $tot27 = $tot27+$v['April-27-Soya'];
                                    $tot28 = $tot28+$v['April-28-Soya'];
                                    $tot29 = $tot29+$v['April-29-Soya'];
                                    $tot30 = $tot30+$v['April-30-Soya'];
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
                                    $tot21 = $tot21+$v['April-21-Nenaposha'];
                                    $tot22 = $tot22+$v['April-22-Nenaposha'];
                                    $tot23 = $tot23+$v['April-23-Nenaposha'];
                                    $tot24 = $tot24+$v['April-24-Nenaposha'];
                                    $tot25 = $tot25+$v['April-25-Nenaposha'];
                                    $tot26 = $tot26+$v['April-26-Nenaposha'];
                                    $tot27 = $tot27+$v['April-27-Nenaposha'];
                                    $tot28 = $tot28+$v['April-28-Nenaposha'];
                                    $tot29 = $tot29+$v['April-29-Nenaposha'];
                                    $tot30 = $tot30+$v['April-30-Nenaposha'];
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
                                    $tot21 = $tot21+$v['April-21-db'];
                                    $tot22 = $tot22+$v['April-22-db'];
                                    $tot23 = $tot23+$v['April-23-db'];
                                    $tot24 = $tot24+$v['April-24-db'];
                                    $tot25 = $tot25+$v['April-25-db'];
                                    $tot26 = $tot26+$v['April-26-db'];
                                    $tot27 = $tot27+$v['April-27-db'];
                                    $tot28 = $tot28+$v['April-28-db'];
                                    $tot29 = $tot29+$v['April-29-db'];
                                    $tot30 = $tot30+$v['April-30-db'];
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
