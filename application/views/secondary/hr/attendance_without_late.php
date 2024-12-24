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
                                            echo '<option ' . $select . ' value="' . $a['id'] . '"> ' . $a['range_name'] . '</option>';
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
                                <input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('attendance_table', 'Attendance_<?= $DateRange ?>')" value="Download Excel">
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
                                        <th>Check In Distance(meters)</th> 
                                        <th>First Bill Time</th> 
                                        <th>Time Gap</th> 
                                        <th>Last Bill Time</th> 
                                        <th>Time Check Out</th> 
                                        <th>Time Gap</th> 
                                        <th>Check Out Distance (meters)</th> 		
                                        <th>Bill Count</th>   
                                        <th>Total Booking Value</th>    
                                        <th>Final Status</th>   
                                        <th>ASE/ASM Comments</th> 
                                    </tr>		
                                </thead>		
                                <tbody>			
                                    <?php
                                    foreach ($TimeAttendance as $o) {
                                        $colorSet = '';
                                        if ($o['check_in'] == '00:00:00') {
                                            $colorSet = 'style="background: #ffb6b6;"';
                                        }
                                        ?>
                                        <tr <?= $colorSet ?> >	
                                            <td><?= $o['area_name'] ?></td> 
                                            <td><?= $o['territory_name'] ?></td> 
                                            <td><?= $o['range_name'] ?></td> 
                                            <td><?= $o['user_name'] ?></td> 
                                            <td><?= $o['date_work'] ?></td> 		
                                            <td><?= $o['check_in'] ?></td> 	
                                            <td><?= (int) ($o['check_in_distance'] * 1000) ?></td> 	
                                            <td><?= $o['first_bill_time'] ?></td> 
                                            <td><?php
                                                if ($o['first_bill_time'] != '00:00:00') {
                                                    echo $hourdiff = round((strtotime($o['first_bill_time']) - strtotime($o['expected_first_bill_time'])) / 3600, 1) * 60 . ' min';
                                                } else {
                                                    echo '-';
                                                }
                                                ?></td>
                                            <td><?= $o['last_bill_time'] ?></td> 
                                            <td><?= $o['check_out'] ?></td>	 
                                            <td><?php
                                                if ($o['check_out'] != '00:00:00') {
                                                    echo $hourdiff = round((strtotime($o['check_out']) - strtotime($o['last_bill_time'])) / 3600, 1) * 60 . ' min';
                                                } else {
                                                    echo '-';
                                                }
                                                ?></td>
                                            <td><?= (int) ($o['check_out_distance'] * 1000) ?></td>  
                                            <td><?= $o['total_bills'] ?></td>  
                                            <td><?= $o['total_sale'] ?></td>


                                            <td>
                                                <?php
                                                if ($sess['grade_id'] == 4 && date('Y-m-d') == $o['date_work']) {
                                                    $t = '<option value="-">--Select One--</option>';
                                                    $select='';
                                                    foreach ($AttenType as $g) {
                                                        if($g['type_name']==$o['attendance_type']){
                                                            $select=' select="select" ';
                                                        }
                                                        $t = $t . '<option '.$select.' value="' . $g['type_name'] . '">' . $g['type_name'] . '</option>';
                                                    }
                                                    $t = $t . '</select>';
                                                    ?>
                                                    <?= '<select class="form-control" name="hr[ASE][type][' . $o['user_name'] . '][' . $o['date_work'] . ']" style="min-width: 100px;">' . $t ?> 
                                                    <input type="hidden" name="hr[ASE][territory][]" value="<?= $o['user_name'] ?>">
                                                    <input type="hidden" name="hr[ASE][<?= $o['user_name'] ?>][date][]" value="<?= $o['date_work'] ?>">
                                                    <?php
                                                } else {
                                                    echo $o['attendance_type'];
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php if ($sess['grade_id'] == 4 && date('Y-m-d') == $o['date_work']) { ?>
                                                    <?= '<textarea class="form-control" name="hr[ASE][comment][' . $o['user_name'] . '][' . $o['date_work'] . ']" style="min-width: 300px;">' . $o['comment'] . '</textarea>' ?>
                                                    <?php
                                                } else {
                                                    if($o['comment']=='-' || $o['comment']==NULL){
                                                        echo $o['comment'];
                                                    }else{    
                                                        echo $o['comment'] . '(' . $o['review_date'] . ' ' . $o['review_time'] . ' - '.$o['reporting_person'].')';
                                                    }
                                                }
                                                ?>
                                            </td>

                                        </tr>
        <?php
    }
    ?>                    			
                                </tbody> 					
                            </table>	
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-danger" name="submit" value="Save Attendance">
                                </div>                                
                            </div>
    <?php
}
?>

                </div>

            </div>


        </div>
    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->

