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
                                    <th>Remainig to be done</th> 	
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
                        $total = 0;
                        ?>
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
                                foreach ($TotalSample as $t) {
                                    ?>
                                    <tr>
                                        <td><?= $t['area_name'] ?></td>
                                        <td><?= $t['territory_name'] ?></td>
                                        <td><?= $t['audit_user'] ?></td>
                                        <td><?= $t['samples'] ?></td>
                                    </tr>
                                    <?php
                                    $total = $total + $t['samples'];
                                }
                                ?> 
                            </tbody>
                        </table>
                        <div class="col-lg-6 col-xs-6">

                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3><?= $total ?></h3>
                                    <p>Sample Size</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="#" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>

                </div>
                <div class="col-md-12">
                    <?php
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

                                    <th>Demand Level Sunlight</th> 
                                    <th>Demand Level Diva</th> 
                                    <th>Demand Level Surfexcel</th> 
                                    <th>Demand Level Starlight</th> 
                                    <th>Demand Level Rin</th> 
                                    <th>Demand Level Other</th> 

                                    <th>Demand SKU Sachet (50g- 60g)</th> 
                                    <th>Demand SKU 100g- 125g</th>
                                    <th>Demand SKU 400g- 500g</th>
                                    <th>Demand SKU 600g- 800g</th> 
                                    <th>Demand SKU 1kg</th> 
                                    <th>Demand SKU Other</th> 

                                    <th>Demand Color රෝස/ Pink</th> 
                                    <th>Demand Color කොළ/ Green</th>
                                    <th>Demand Color කහ/ Yellow</th>
                                    <th>Demand Color දම්/ Purple</th> 
                                    <th>Demand Color මෙරූන්/ Maroon</th> 
                                    <th>Demand Color Other</th> 

                                    <th>Stock Sunlight Sachet (50g- 60g)</th> 
                                    <th>Stock Sunlight 100g- 125g</th> 
                                    <th>Stock Sunlight 400g- 500g</th> 
                                    <th>Stock Sunlight 600g- 800g</th> 
                                    <th>Stock Sunlight 1kg</th> 
                                    <th>Stock Sunlight Other</th> 

                                    <th>Stock Diva Sachet (50g- 60g)</th> 
                                    <th>Stock Diva 100g- 125g</th> 
                                    <th>Stock Diva 400g- 500g</th> 
                                    <th>Stock Diva 600g- 800g</th> 
                                    <th>Stock Diva 1kg</th> 
                                    <th>Stock Diva Other</th> 

                                    <th>Stock Surfexcel Sachet (50g- 60g)</th> 
                                    <th>Stock Surfexcel 100g- 125g</th> 
                                    <th>Stock Surfexcel 400g- 500g</th> 
                                    <th>Stock Surfexcel 600g- 800g</th> 
                                    <th>Stock Surfexcel 1kg</th> 
                                    <th>Stock Surfexcel Other</th> 

                                    <th>Stock Starlight Sachet (50g- 60g)</th> 
                                    <th>Stock Starlight 100g- 125g</th> 
                                    <th>Stock Starlight 400g- 500g</th> 
                                    <th>Stock Starlight 600g- 800g</th> 
                                    <th>Stock Starlight 1kg</th> 
                                    <th>Stock Starlight Other</th> 

                                    <th>Stock Rin Sachet (50g- 60g)</th> 
                                    <th>Stock Rin 100g- 125g</th> 
                                    <th>Stock Rin 400g- 500g</th> 
                                    <th>Stock Rin 600g- 800g</th> 
                                    <th>Stock Rin 1kg</th> 
                                    <th>Stock Rin Other</th> 

                                    <th>Stock Other Sachet (50g- 60g)</th> 
                                    <th>Stock Other 100g- 125g</th> 
                                    <th>Stock Other 400g- 500g</th> 
                                    <th>Stock Other 600g- 800g</th> 
                                    <th>Stock Other 1kg</th> 
                                    <th>Stock Other Other</th> 

                                    <th>Other Products</th> 
                                    <th>Demand Increased/Decreased</th> 
                                    <th>DemandIncreased/Decreased Level %</th> 
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
                                    <td><?= $a['question_45'] ?></td> 
                                    <td><?= $a['question_46'] ?></td> 
                                    <td><?= $a['question_47'] ?></td> 
                                    <td><?= $a['question_48'] ?></td> 

                                    <td><?= $a['question_49'] ?></td> 
                                    <td><?= $a['question_50'] ?></td> 
                                    <td><?= $a['question_51'] ?></td> 
                                    <td><?= $a['question_52'] ?></td> 
                                    <td><?= $a['question_53'] ?></td> 
                                    <td><?= $a['question_54'] ?></td> 

                                    <td><?= $a['question_55'] ?></td> 
                                    <td><?= $a['question_56'] ?></td> 
                                    <td><?= $a['question_57'] ?>%</td> 

                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                        <?php
                    }
                    ?>
                </div>
            </div>


        </div>
    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->

