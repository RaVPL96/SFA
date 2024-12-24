<?php
/*


 * This system Licenced to Raigam Marketing Services (Pvt) Ltd. 

 * Developed By: Lakshitha Pradeep Karunarathna  * 

 * Company: Serving Cloud INC in association with MyOffers.lk  * 

 * Date Started:  October 20, 2017  * 


 */
?>
<?php include_once BASEPATH . ('../application/views/template/leftsidebar.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


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
                <form class="form-horizontal" id="" action="<?= base_url('survey/surveySoyamonitor') ?>" method="post">
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
                        <div class="col-md-6" style="display: none;">                            
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
                        <div class="col-md-6" style="display: none;">                            
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
                        <div class="col-md-6" style="display: none;">
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
                        <div class="col-md-6">                            
                            <div class="form-group">
                                <label class="col-md-2">Category <span class="text-red">*</span></label>
                                <div class="col-md-6">
                                    <select id="category" name="category" class="form-control">
                                        <option value="1"> Laundry Soap </option>    
                                        <option value="2"> Beauty Soap </option>    
                                        <option value="3"> Baby Soap </option>    
                                        <option value="4"> Bath Soap </option>    
                                        <option value="5"> Aurvedic Soap </option>    
                                        <option value="6"> Bar Soap </option>    
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="hidden" id="survey_id" name="survey_id" value="18">
                                <input type="submit" class="btn btn-danger" name="submit" value="Get Report" >
                            </div>                                
                        </div>
                    </div>
                </form>
                <div class="col-md-12">
                    <h3 style="text-align: center;font-weight: bold;font-size: 34px;">Beauty Soap Survey Result</h3>
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
                                    $totalSample=0;    
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
                                            $totalSamples=$totalSamples+$totalSample;
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
                                $tot=0;
                                foreach ($TotalSample as $t) {
                                    $tot=$t['samples']+$tot;
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
                                <th><?=$tot?></th>
                            </tfoot>
                        </table>
                        <?php
                    } 
                    ?>

                </div>
                <div style="margin-top: 2%;">
                    
                
                <h1 style="text-align: center;font-weight: bold;">Beauty Soap Survey Result Area Totals</h1> 

                <table  id="attendance_table" class="table table-hover">    
                            <thead>                     
                                <tr>
                                    <th>Area</th>
                                    <th>Total</th>                                  
                                </tr>       
                            </thead>        
                            <tbody> 
                                <?php 
                                $totSam = 0;
                             foreach ($paraGraphData as $paras) {
                                $totSam =  $totSam+$paras['samples'];
                            ?>
                            <tr>
                                <td><?php echo $paras['area_name'] ?></td>
                                <td><?php echo $paras['samples'] ?></td>
                            </tr>
                            <?php
                             }

                                ?>
                            </tbody>
                            <tfoot>
                            <th colspan="1">Total</th>
                                <th><?=$totSam?></th>
                            </tfoot>
                        </table>
                
                <canvas id="myBarChart" width="400" height="200"></canvas>

                <?php

                $labels = array();
                $totals = array();
                foreach ($paraGraphData as $para =>$value) {
                    $labels[$para]= $value['area_name'];
                    $totals[$para]= $value['samples'];
                    // $totals.= $para['area_name'].",";
                }

// print_r($labels);
                    $data = [
                        'labels' => $labels,
                        'datasets' => [
                            [
                                'label' => 'Survey Result Area Wise',
                                'backgroundColor' => 'rgba(44, 193, 139, 0.8)',
                                'borderColor' => 'rgba(44, 193, 139, 0.8)',
                                'borderWidth' => 1,
                                'data' => $totals
                            ]
                        ]
                    ];
                ?>
                
                <script>
    window.onload = function() {
        var ctx = document.getElementById('myBarChart').getContext('2d');
        var chartData = <?php echo json_encode($data); ?>;
        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: chartData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    };
</script>

</div>
                
                <div class="col-md-12">
                    <?php
                    //$TotalSampleDetails=null;
                    if ($sess['username']=='rohan' || $sess['username']=='lakshitha'){
                    
                    if (!empty($TotalSampleDetails) && isset($TotalSampleDetails)) {
                        ?>

                <h1 style="text-align: center;font-weight: bold;">Beauty Soap Survey Detail Result</h1> 


                        <div class="form-group">
                            <input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('survey_table', 'survey_<?= $DateRange ?>')" value="Download Excel">
                        </div>
                        <table id="survey_table" class="table table-hover">
                            <thead>
                                <tr>
                                    <td colspan="6"></td>
                                     <?php
                           // foreach ($TotalSampleDetails as $a) {
                                ?>
                                    <td colspan="4" style="font-weight: bold;text-align: center;font-size: 19px;">Calin</td>
                                    <td colspan="4" style="font-weight: bold;text-align: center;font-size: 19px;">Velvet</td>
                                    <td colspan="4" style="font-weight: bold;text-align: center;font-size: 19px;">Lux</td>
                                    <td colspan="4" style="font-weight: bold;text-align: center;font-size: 19px;">Rani</td>
                                    <td colspan="4" style="font-weight: bold;text-align: center;font-size: 19px;">Khomba</td>
                                    <td colspan="4" style="font-weight: bold;text-align: center;font-size: 19px;">Dove</td>
                                    <!-- <td colspan="3" style="font-weight: bold;text-align: center;font-size: 19px;">Dash</td> -->
                                    <?php
                           // }
                            ?>
                                </tr>
                                <tr>
                                    <th width="10%">Area</th>
                                    <th width="10%">Territory</th>
                                    <th width="10%">Range</th>
                                    <th width="10%">Sales Rep</th>
                                    <th width="10%">Date</th> 
                                    <th width="10%">Time</th> 
                                    
                                    <!-- <th>Item Name</th> -->
                                    
                                    <!-- <th>MRP</th> -->
                                    <th>Size (g)</th>
                                    <th>Available Stock</th>
                                    <th>Free Issue</th>
                                    <th>Value Discount</th>
                                    
                                    <!-- <th>MRP</th> -->
                                    <th>Size (g)</th>
                                    <th>Available Stock</th>
                                    <th>Free Issue</th>
                                    <th>Value Discount</th>
                                    
                                    <!-- <th>MRP</th> -->
                                    <th>Size (g)</th>
                                    <th>Available Stock</th>
                                    <th>Free Issue</th>
                                    <th>Value Discount</th>
                                    
                                    <!-- <th>MRP</th> -->
                                    <th>Size (g)</th>
                                    <th>Available Stock</th>
                                    <th>Free Issue</th>
                                    <th>Value Discount</th>
                                    
                                    <!-- <th>MRP</th> -->
                                    <th>Size (g)</th>
                                    <th>Available Stock</th>
                                    <th>Free Issue</th>
                                    <th>Value Discount</th>
                                    
                                    <!-- <th>MRP</th> -->
                                    <th>Size (g)</th>
                                    <th>Available Stock</th>
                                    <th>Free Issue</th>
                                    <th>Value Discount</th>
                                    
                                    

                                </tr>
                            </thead>
                            <?php
//                    print_r($TotalSampleDetails);
                            $Calin_available = 0;
                            $Velvet_available = 0;
                            $Lux_available = 0;
                            $Rani_available = 0;
                            $Khomba_available = 0;
                            $Dove_available = 0; 
                            foreach ($TotalSampleDetails as $a) {
                            $Calin_available = $Calin_available+$a['Calin_available'];
                            $Velvet_available = $Velvet_available+$a['Velvet_available'];
                            $Lux_available = $Lux_available+$a['Lux_available'];
                            $Rani_available = $Rani_available+$a['Rani_available'];
                            $Khomba_available = $Khomba_available+$a['Khomba_available'];
                            $Dove_available = $Dove_available+$a['Dove_available']; 
                                ?>
                                <tr>
                                    <td><?= $a['area_name'] ?></td> 
                                    <td><?= $a['territory_name'] ?></td> 
                                    <td><?= $a['range_name'] ?></td> 
                                    <td><?= $a['audit_user'] ?></td> 
                                    <td><?= $a['survey_date'] ?></td> 
                                    <td><?= $a['survey_time'] ?></td>


                                    <!-- <td><?= $a['itemName'] ?></td>  -->


                                    <td><?= $a['Calin_size'] ?></td> 
                                    <td><?= $a['Calin_available'] ?></td> 
                                    <td><?= $a['Calin_free_issue'] ?></td> 
                                    <td><?= $a['Calin_discount'] ?></td> 
                                    
                                    <td><?= $a['Velvet_size'] ?></td> 
                                    <td><?= $a['Velvet_available'] ?></td> 
                                    <td><?= $a['Velvet_free_issue'] ?></td> 
                                    <td><?= $a['Velvet_discount'] ?></td> 
                                     
                                    <td><?= $a['Lux_size'] ?></td> 
                                    <td><?= $a['Lux_available'] ?></td> 
                                    <td><?= $a['Lux_free_issue'] ?></td> 
                                    <td><?= $a['Lux_discount'] ?></td> 
                                    
                                    <td><?= $a['Rani_size'] ?></td> 
                                    <td><?= $a['Rani_available'] ?></td> 
                                    <td><?= $a['Rani_free_issue'] ?></td> 
                                    <td><?= $a['Rani_discount'] ?></td> 
                                    
                                    <td><?= $a['Khomba_size'] ?></td> 
                                    <td><?= $a['Khomba_available'] ?></td> 
                                    <td><?= $a['Khomba_free_issue'] ?></td> 
                                    <td><?= $a['Khomba_discount'] ?></td>

                                    <td><?= $a['Dove_size'] ?></td> 
                                    <td><?= $a['Dove_available'] ?></td> 
                                    <td><?= $a['Dove_free_issue'] ?></td> 
                                    <td><?= $a['Dove_discount'] ?></td>  

                                    
                                    

                                </tr>
                                <?php
                            }
                            ?>
                            <tr>
                                <td colspan="6" style="font-weight: bold;font-size: 18px;text-align: center;color: black;">Total</td>

                                <td>&nbsp;</td> 
                                <td style="font-weight: bold;font-size: 15px;text-align: center;color: black;"><?= $Calin_available ?></td> 
                                <td>&nbsp;</td> 
                                <td>&nbsp;</td> 

                                <td>&nbsp;</td> 
                                <td style="font-weight: bold;font-size: 15px;text-align: center;color: black;"><?= $Velvet_available ?></td> 
                                <td>&nbsp;</td> 
                                <td>&nbsp;</td> 

                                <td>&nbsp;</td> 
                                <td style="font-weight: bold;font-size: 15px;text-align: center;color: black;"><?= $Lux_available ?></td> 
                                <td>&nbsp;</td> 
                                <td>&nbsp;</td> 

                                <td>&nbsp;</td> 
                                <td style="font-weight: bold;font-size: 15px;text-align: center;color: black;"><?= $Rani_available ?></td> 
                                <td>&nbsp;</td> 
                                <td>&nbsp;</td> 

                                <td>&nbsp;</td> 
                                <td style="font-weight: bold;font-size: 15px;text-align: center;color: black;"><?= $Khomba_available ?></td> 
                                <td>&nbsp;</td> 
                                <td>&nbsp;</td> 

                                <td>&nbsp;</td> 
                                <td style="font-weight: bold;font-size: 15px;text-align: center;color: black;"><?= $Dove_available ?></td> 
                                <td>&nbsp;</td> 
                                <td>&nbsp;</td> 

                                 

                            </tr>

                             <tr style="background-color: #c1f2e7;">
                                    <td colspan="6"></td>
                                     <?php
                           // foreach ($TotalSampleDetails as $a) {
                                ?>
                                    <td colspan="4" style="font-weight: bold;text-align: center;font-size: 19px;">Calin</td>
                                    <td colspan="4" style="font-weight: bold;text-align: center;font-size: 19px;">Velvet</td>
                                    <td colspan="4" style="font-weight: bold;text-align: center;font-size: 19px;">Lux</td>
                                    <td colspan="4" style="font-weight: bold;text-align: center;font-size: 19px;">Rani</td>
                                    <td colspan="4" style="font-weight: bold;text-align: center;font-size: 19px;">Khomba</td>
                                    <td colspan="4" style="font-weight: bold;text-align: center;font-size: 19px;">Dove</td>
                                    <?php
                           // }
                            ?>
                                </tr>
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

