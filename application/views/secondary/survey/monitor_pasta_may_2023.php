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
            Secondary Sales Market Research 
            <small>Monior Market Research Details </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Secondary Sales Market Research</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12" style="overflow-x: scroll;">
                <div id="successMessage" class="hideDiv">Updated Successfully! </div>
                <div id="errorMessage" class="hideDiv">Invalid Data! Please Try Again. </div>
                <div class="keepgap"></div> 
                <form class="form-horizontal" id="" action="<?= base_url('survey/surveymonitor') ?>" method="post">
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

                    <?php
                    if (!empty($TimeAttendance) && isset($TimeAttendance)) {
                        $totalSamples = 0;
                        $totalTarget = 0;
                        $maleTotal = 0;
                        $femaleTotal = 0;
                        $days = 0;
                        $total = 0;
                        ?>
                        <div class="form-group">
                            <input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('attendance_table', 'Attendance_<?= $DateRange ?>')" value="Download Excel">
                        </div>

                        <h3>Samples for the selected period</h3>
                        <table  id="attendance_table" class="table table-hover">	
                            <thead>						
                                <tr>
                                    <th>Area</th>
                                    <th>Territory</th>
                                    <th>Range</th>
                                    <th>Sales Rep</th>
                                    <th>Date</th> 
                                    <th>Target</th> 
                                    <th>Total Surveys</th> 
                                    <th>Remaining to be done</th> 	
                                    <th>Male Count</th> 
                                    <th>Female Count</th>                            		
                                </tr>		
                            </thead>		
                            <tbody>			
                                <?php
                                foreach ($area_list as $a) {
                                    $colorSet = 'style="background: #ffb6b6;"';
                                    $from_date = strtotime($FromDate);
                                    $to_date = strtotime($ToDate);
                                    $datediff = $to_date - $from_date;
                                    $remain = (($days + 1) * 10);
                                    $days = round($datediff / (60 * 60 * 24));
                                    $male = 0;
                                    $female = 0;
                                    $totalSample = 0;
                                    $dateperiod = '-';
                                    foreach ($TimeAttendance as $o) {
                                        if ($a['area_name'] == $o['area_name'] && $a['territory_name'] == $o['territory_name'] && $a['range_name'] == $o['range_name'] && $a['rep_username'] == $o['audit_user']) {
                                            if ($o['total_surveys'] < (($days + 1) * 10) && $o['total_surveys'] > 0) {
                                                $colorSet = 'style="background: #f1fb60;"';
                                            } elseif ($o['total_surveys'] <= 0) {
                                                $colorSet = 'style="background: #ffb6b6;"';
                                            } elseif ($o['total_surveys'] >= (($days + 1) * 10)) {
                                                $colorSet = '';
                                            }
                                            $total = $o['total_surveys'];
                                            $totalSample = $totalSample + $total;
                                            $totalSamples = $totalSamples + $totalSample;
                                            $totalTarget = (($days + 1) * 10) + $totalTarget;
                                            $maleTotal = $maleTotal + $o['male_count'];
                                            $femaleTotal = $femaleTotal + $o['female_count'];

                                            $male = $o['male_count'];
                                            $female = $o['female_count'];
                                            $dateperiod = $o['survey_date'];
                                            $remain = (($days + 1) * 10) - $total;
                                            if ($remain <= 0) {
                                                $remain = '-';
                                            }
                                        }
                                    }
                                    if ($datediff == 0) {
                                        $dateperiod = date("Y-m-d", $from_date);
                                    } else {
                                        $dateperiod = ($days + 1) . ' day(s)';
                                    }
                                    ?>
                                    <tr <?= $colorSet ?> >	
                                        <td><?= $a['area_name'] ?></td> 
                                        <td><?= $a['territory_name'] ?></td> 
                                        <td><?= $a['range_name'] ?></td> 
                                        <td><?= $a['rep_username'] ?></td> 
                                        <td><?= $dateperiod ?></td>                                         
                                        <td><?= ($days + 1) * 10 ?></td> 
                                        <td><?= $totalSample ?></td> 
                                        <td><?= $remain ?></td> 		
                                        <td><?= $male ?></td> 
                                        <td><?= $female ?></td>  
                                    </tr>
                                    <?php
                                }
                                /* foreach ($TimeAttendance as $o) {
                                  $colorSet = '';
                                  $from_date = strtotime($FromDate);
                                  $to_date = strtotime($ToDate);
                                  $datediff = $to_date - $from_date;

                                  $days = round($datediff / (60 * 60 * 24));
                                  if ($o['total_surveys'] < ($days + 1) * 10) {
                                  $colorSet = 'style="background: #f1fb60;"';
                                  } elseif ($o['total_surveys'] <= 0) {
                                  $colorSet = 'style="background: #ffb6b6;"';
                                  }
                                  ?>
                                  <tr <?= $colorSet ?> >
                                  <td><?= $a['area_name'] ?></td>
                                  <td><?= $a['territory_name'] ?></td>
                                  <td><?= $a['range_name'] ?></td>
                                  <td><?= $a['rep_username'] ?></td>
                                  <td><?= $dateperiod ?></td>
                                  <td><?= ($days + 1) * 10 ?></td>
                                  <td><?= $total ?></td>
                                  <td><?= $male ?></td>
                                  <td><?= $female ?></td>
                                  </tr>
                                  <?php
                                  } */
                                ?>                    			
                            </tbody> 		
                            <tfoot>
                                <tr <?= $colorSet ?> >	
                                    <td> </td> 
                                    <td> </td> 
                                    <td> </td> 
                                    <td> </td> 
                                    <td> </td>                                         
                                    <td><?= $totalTarget ?></td> 
                                    <td><?= $totalSamples ?></td> 
                                    <td><?= $totalTarget - $totalSamples ?></td> 		
                                    <td><?= $maleTotal ?></td> 
                                    <td><?= $femaleTotal ?></td>  
                                </tr>
                            </tfoot>
                        </table>					
                        <?php
                    }
                    ?>

                </div>
                <div class="col-md-12">
                    <?php
                    if (!empty($TotalSample) && isset($TotalSample)) {
                        ?>
                        <h3>Total Samples</h3>
                        <table id="example1" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Area</th>
                                    <th>Territory</th>
                                    <th>User</th>
                                    <th>Total Samples</th> 
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $tot = 0;
                                foreach ($TotalSample as $t) {
                                    $tot = $t['samples'] + $tot;
                                    ?>
                                    <tr>
                                        <td><?= $t['area_name'] ?></td>
                                        <td><?= $t['territory_name'] ?></td>
                                        <td><?= $t['audit_user'] ?></td>
                                        <td><?= $t['samples'] ?></td>
                                    </tr>
                                    <?php
                                }
                                ?> 
                            </tbody>
                            <tfoot>
                            <th colspan="3">All Total sample size: </th>
                            <th><?= $tot ?></th>
                            </tfoot>
                        </table>
                        <?php
                    }
                    ?>

                </div>


                <div class="col-md-12">
                    <?php
                    //$TotalSampleDetails=null;
                    if ($sess['username'] == 'rohan' || $sess['username'] == 'lakshitha') {

                        if (!empty($TotalSampleDetails) && isset($TotalSampleDetails)) {
                            ?>
                            <div class="form-group">
                                <input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('survey_table', 'survey_<?= $DateRange ?>')" value="Download Excel">
                            </div>
                            <table id="survey_table" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Area</th>
                                        <th>Territory</th>
                                        <th>Range</th>
                                        <th>Sales Rep</th>
                                        <th>Date</th> 
                                        <th>Time</th> 

                                        <th>Pkt Sold</th>
                                        <th>Kg Sold</th>
                                        <th>Highest Demand</th>
                                        <th>Demand for Instant</th>
                                        <th>If Yes Quantity</th>
                                        <th>Weight Rating 200g</th>
                                        <th>Weight Rating 500g</th>
                                        <th>Weight Rating 1kg</th>
                                        <th>Shape Rating Shell</th>
                                        <th>Shape Rating Elbow</th>
                                        <th>Shape Rating Spiral</th>
                                        <th>Shape Rating Sedano</th>
                                        <th>Brand Rating Rosa</th>
                                        <th>Brand Rating Milan</th>
                                        <th>Brand Rating San Remo</th>
                                        <th>Brand Rating Sofia</th>
                                        <th>Brand Rating Melissa</th>
                                        <th>Brand Rating Barilla</th>
                                        <th>Brand Rating Delmage</th>
                                        <th>Brand Rating Other</th>
                                        <th>Rosa 200g</th>
                                        <th>Rosa 500g</th>
                                        <th>Rosa 1kg</th>
                                        <th>Milan 200g</th>
                                        <th>Milan 500g</th>
                                        <th>Milan 1kg</th>
                                        <th>San Remo 200g</th>
                                        <th>San Remo 500g</th>
                                        <th>San Remo 1kg</th>
                                        <th>Sofia 200g</th>
                                        <th>Sofia 500g</th>
                                        <th>Sofia 1kg</th>
                                        <th>Melissa 200g</th>
                                        <th>Melissa 500g</th>
                                        <th>Melissa 1kg</th>
                                        <th>Barilla 200g</th>
                                        <th>Barilla 500g</th>
                                        <th>Barilla 1kg</th>
                                        <th>Delmage 200g</th>
                                        <th>Delmage 500g</th>
                                        <th>Delmage 1kg</th>                                        
                                        <th>Other 200g</th>
                                        <th>Other 500g</th>
                                        <th>Other 1kg</th>






                                    </tr>
                                </thead>
                                <?php
                                foreach ($TotalSampleDetails as $a) {
                                    ?>
                                    <tr>
                                        <td><?= $a['area_name'] ?></td> 
                                        <td><?= $a['territory_name'] ?></td> 
                                        <td><?= $a['range_name'] ?></td> 
                                        <td><?= $a['audit_user'] ?></td> 
                                        <td><?= $a['survey_date'] ?></td> 
                                        <td><?= $a['survey_time'] ?></td>


                                        <td><?= $a['question_1'] ?></td> 
                                        <td><?= $a['question_2'] ?></td>                                        
                                        <td><?= $a['question_3'] ?></td>                                        
                                        <td><?= $a['question_4'] ?></td>                                        
                                        <td><?= $a['question_5'] ?></td>                                        
                                        <td><?= $a['question_6'] ?></td>                                        
                                        <td><?= $a['question_7'] ?></td>                                        
                                        <td><?= $a['question_8'] ?></td>                                        
                                        <td><?= $a['question_9'] ?></td>                                        
                                        <td><?= $a['question_10'] ?></td> 
                                        <td><?= $a['question_11'] ?></td> 
                                        <td><?= $a['question_12'] ?></td>
                                        <td><?= $a['question_13'] ?></td> 
                                        <td><?= $a['question_14'] ?></td> 
                                        <td><?= $a['question_15'] ?></td> 
                                        <td><?= $a['question_16'] ?></td> 
                                        <td><?= $a['question_17'] ?></td> 
                                        <td><?= $a['question_18'] ?></td>
                                        <td><?= $a['question_19'] ?></td> 
                                        <td><?= $a['question_20'] ?></td> 
                                        <td><?= $a['question_21'] ?></td> 
                                        <td><?= $a['question_22'] ?></td> 
                                        <td><?= $a['question_23'] ?></td> 
                                        <td><?= $a['question_24'] ?></td> 
                                        <td><?= $a['question_25'] ?></td> 
                                        <td><?= $a['question_26'] ?></td> 
                                        <td><?= $a['question_27'] ?></td> 
                                        <td><?= $a['question_28'] ?></td> 
                                        <td><?= $a['question_29'] ?></td> 
                                        <td><?= $a['question_30'] ?></td> 
                                        <td><?= $a['question_31'] ?></td> 
                                        <td><?= $a['question_32'] ?></td> 
                                        <td><?= $a['question_33'] ?></td> 
                                        <td><?= $a['question_34'] ?></td> 
                                        <td><?= $a['question_35'] ?></td> 
                                        <td><?= $a['question_36'] ?></td> 
                                        <td><?= $a['question_37'] ?></td> 
                                        <td><?= $a['question_38'] ?></td> 
                                        <td><?= $a['question_39'] ?></td> 
                                        <td><?= $a['question_40'] ?></td> 
                                        <td><?= $a['question_41'] ?></td>
                                        <td><?= $a['question_42'] ?></td> 
                                        <td><?= $a['question_43'] ?></td> 
                                        <td><?= $a['question_44'] ?></td>   

                                    </tr>
                                    <?php
                                }
                                ?>
                            </table>
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
