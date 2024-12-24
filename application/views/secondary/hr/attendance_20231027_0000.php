<?php
/*


 * This system Licenced to Raigam Marketing Services (Pvt) Ltd. 

 * Developed By: Lakshitha Pradeep Karunarathna  * 

 * Company: Serving Cloud INC in association with MyOffers.lk  * 

 * Date Started:  October 20, 2017  * 


 */
?>
<?php include_once BASEPATH . ('../application/views/template/leftsidebar.php'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Secondary Sales HR Module
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
                <div class="col-md-12">
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
                            <table  id="attendance_table" class="table table-hover">	
                                <thead>						
                                    <tr>
                                        <th>Area</th>
                                        <th>Territory</th>
                                        <th>Range</th>
                                        <th>Sales Rep</th>
                                        <th>Date</th> 
                                        <th>Time Check In</th> 	
                                        <th>Check In Distance (m)</th> 
                                        <th>First Bill Time</th> 
                                        <th>Time Gap</th> 
                                        <th>Last Bill Time</th> 
                                        <th>Time Check Out</th> 
                                        <th>Time Gap</th> 
                                        <th>Check Out Distance (m)</th> 		
                                        <th>Bill Count</th>   
                                        <th>Total Booking Value</th>    
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
                                        if ($o['check_in'] == '00:00:00') {
                                            $colorSet = 'style="background: #ffb6b6;"';
                                        } elseif ($o['check_in'] > '08:00:00') {
                                            $colorSet = 'style="background: #FFD700;"';
                                        }
                                        ?>
                                        <tr <?= $colorSet ?> >	
                                            <td><?= $o['area_name'] ?></td> 
                                            <td><?= $o['territory_name'] ?></td> 
                                            <td><?= $o['range_name'] ?></td> 
                                            <td><a target="_blank" href="<?= base_url('hr/timeAttendanceViewMap/null/'.$o['id'])?>"><?= $o['user_name'] ?></a></td> 
                                            <td><?= $o['date_work'] ?></td> 		
                                            <td style="text-align: right;"><?= date('H:i',strtotime($o['check_in'])) ?></td> 	
                                            <td style="text-align: right;"><?= number_format((int) ($o['check_in_distance'] * 1000)) ?></td> 	
                                            <td style="text-align: right;"><?= date('H:i',strtotime($o['first_bill_time']))?></td> 
                                            <td style="text-align: right;"><?php
                                                if ($o['first_bill_time'] != '00:00:00') {
                                                    echo $hourdiff = round((strtotime($o['first_bill_time']) - strtotime($o['expected_first_bill_time'])) / 3600, 1) * 60 . ' min';
                                                } else {
                                                    echo '-';
                                                }
                                                ?></td>
                                            <td style="text-align: right;"><?= date('H:i', strtotime($o['last_bill_time']))  ?></td> 
                                            <td style="text-align: right;"><?= date('H:i', strtotime($o['check_out'])) ?></td>	 
                                            <td style="text-align: right;"><?php
                                                if ($o['check_out'] != '00:00:00') {
                                                    echo $hourdiff = round((strtotime($o['check_out']) - strtotime($o['last_bill_time'])) / 3600, 1) * 60 . ' min';
                                                } else {
                                                    echo '-';
                                                }
                                                ?></td>
                                            <td style="text-align: right;"><?= number_format((int) ($o['check_out_distance'] * 1000)) ?></td>  
                                            <td style="text-align: right;"><?= $o['total_bills'] ?></td>  
                                            <td style="text-align: right;"><?= number_format($o['total_sale']) ?></td>


                                            <td>
                                                <?php
                                                /*if ($sess['grade_id'] == 4 && ((date('Y-m-d') >= $o['date_work']))) { */
                                                if ($sess['grade_id'] == 4 && (($o['date_work'] ==date('Y-m-d', strtotime("-1 days"))) || (date('Y-m-d') == $o['date_work']) || ((date('D') === 'Mon') && ($o['date_work'] >= date('Y-m-d', strtotime("-2 days")))) )) {
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
                                                    
                                                    $readonly='';
                                                    if(($o['date_work'] ==date('Y-m-d', strtotime("-1 days")))){
                                                        $readonly=' readonly="readonly" ';
                                                    }
                                                    ?>
                                                    <?= '<select '.$readonly.' class="form-control" name="hr[ASE][type][' . $o['user_name'] . '][' . $o['date_work'] . ']" style="min-width: 100px;">' . $t ?> 
                                                    <input type="hidden" name="hr[ASE][territory][]" value="<?= $o['user_name'] ?>">
                                                    <input type="hidden" name="hr[ASE][<?= $o['user_name'] ?>][date][]" value="<?= $o['date_work'] ?>">
                                                    <?php
                                                }elseif ($sess['grade_id'] == 9 && ((date('Y-m-d') == $o['date_work']) || ((date('D') === 'Mon') && ($o['date_work'] >= date('Y-m-d', strtotime("-2 days")))) )) {//RSM COMMENTS
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
                                            <td>
                                                <!-- EVENING STATUS-->
                                                <?php
                                                /*if ($sess['grade_id'] == 4 && ((date('Y-m-d') >= $o['date_work']))) { */
                                                if ($sess['grade_id'] == 4 && (($o['date_work'] ==date('Y-m-d', strtotime("-1 days"))) || (date('Y-m-d') == $o['date_work']) || ((date('D') === 'Mon') && ($o['date_work'] >= date('Y-m-d', strtotime("-2 days")))) )) { 
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
                                            <td>
                                                <?php
                                                /* if ($sess['grade_id'] == 4 && date('Y-m-d') >= $o['date_work']) { */
                                                if ($sess['grade_id'] == 4 && (($o['date_work'] ==date('Y-m-d', strtotime("-1 days"))) || (date('Y-m-d') == $o['date_work']) || ((date('D') === 'Mon') && ($o['date_work'] >= date('Y-m-d', strtotime("-2 days")))) )) { 
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
                                            <td>
                                            <!-- RSM COMMENTs -->        
                                            <?php
                                                /*if ($sess['grade_id'] == 9 && date('Y-m-d') >= $o['date_work']) { */
                                                if ($sess['grade_id'] == 9 && (($o['date_work'] ==date('Y-m-d', strtotime("-1 days"))) || (date('Y-m-d') == $o['date_work']) || ((date('D') === 'Mon') && ($o['date_work'] >= date('Y-m-d', strtotime("-2 days")))) )) { 
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
                                            <td>

                                            </td>
                                            <td>
                                                <?php
                                                if ($sess['grade_id'] == 4 && date('Y-m-d') >= $o['date_work']) {
                                                /*if($sess['grade_id'] == 4 && ((date('Y-m-d') == $o['date_work']) || ((date('D') === 'Mon') && ($o['date_work'] >= date('Y-m-d', strtotime("-2 days")))) )) { */
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
                        ?>

                </div>

            </div>


        </div>
    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->

