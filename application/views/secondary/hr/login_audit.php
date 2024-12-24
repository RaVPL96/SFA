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
            Secondary Sales HR Module - Login Attempt Audit Report
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
                <form class="form-horizontal" id="" action="<?= base_url('hr/loginAuditReport') ?>" method="post">
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
                        <!--
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
                        -->
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
                        <!--
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
                        -->
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
                    if (!empty($LoginAttempt) && isset($LoginAttempt)) {
                        /*
                          $t = '<option value="-">--Select One--</option>';
                          foreach ($AttenType as $g) {
                          $t = $t . '<option value="' . $g['type_name'] . '">' . $g['type_name'] . '</option>';
                          }
                          $t = $t . '</select>';
                         */
                        ?>
                        <div class="form-group">
                            <input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('example', 'Attendance_<?= $DateRange ?>')" value="Download Excel">
                        </div>
                        <table  id="example" class="table table-hover">	
                            <thead>						
                                <tr>
                                    <th>Name</th>
                                    <th>Grade</th>
                                    <th>Login Date</th>
                                    <th>Time</th> 
                                </tr>		
                            </thead>		
                            <tbody>			
                                <?php
                                foreach ($LoginAttempt as $o) {
                                    $colorSet = '';
                                    if ($o['grade_name'] != 'Sales Rep') {
                                        ?>
                                        <tr <?= $colorSet ?> >	
                                            <td><?= $o['profname'] ?></td> 
                                            <td><?= $o['grade_name'] ?></td> 
                                            <td><?= $o['date'] ?></td> 
                                            <td><?= $o['login_time'] ?></td>  
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>                    			
                            </tbody> 					
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

