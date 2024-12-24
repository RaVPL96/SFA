<?php include_once BASEPATH . ('../application/views/template/leftsidebar.php'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Secondary Sales Non Moving Items
            <small>Maintain Secondary Sales Non Moving Item Details </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Secondary Sales Non Moving Item Data Control Module</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12" style="overflow-x: scroll;">
                <div id="successMessage" class="hideDiv">Updated Successfully! </div>
                <div id="errorMessage" class="hideDiv">Invalid Data! Please Try Again. </div>
                <div class="keepgap"></div> 
                <form class="form-horizontal" id="" action="<?= base_url('Salesreports/distDirect') ?>" method="post">
                    <div class="col-md-12">
                        
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
                    <div class="col-md-6">                            
                            <div class="form-group">
                                <label class="col-md-2">Direct Type <span class="text-red">*</span></label>
                                <div class="col-md-6">
                                    <select id="DirectList" name="directID" class="form-control">
                                        <option value=""> -- Select Direct Type -- </option>
                                        <?php
                                        foreach ($DirectList as $l) {
                                            $select = '';
                                            if (!empty($directID) && isset($directID) && $l['d'] == $directID) {
                                                $select = 'selected';
                                            }
                                            echo '<option ' . $select . ' value="' . $l['d'] . '"> ' . $l['d'] . '</option>';
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

                    <?php if (!empty($DateRange) && isset($DateRange)) { ?>
                        <div class="form-group">
                            <input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('directbills_table', 'directbills_<?= $DateRange ?>')" value="Download Excel">
                        </div>
                        <table  id="directbills_table" class="table table-hover">	
                            <thead>						
                                <tr>
                                    <th>Agency</th>
                                    <th>Invoice Number</th>
                                    <th>Route Number</th>
                                    <th>Booking Value</th>
                                    <th>Market Retun</th>
                                    <th>Good Return</th>
                                    <th>Free Issue</th>
                                    <th>Discount</th>
                                    <th>Actual Value</th>
                                    <th>Booking Date</th>
                                    <th>Actual Date</th>
                                </tr>		
                            </thead>		
                            <tbody>		
                                <?php
                                foreach ($directbills as $o) {
                                    ?>
                                    <tr>
                                        <td><?= $o['ag_name'] ?></td> 
                                        <td><?= $o['invno'] ?></td> 
                                        <td><?= $o['ro_cd'] ?></td> 
                                        <td><?= $o['tot_b_val'] ?></td>
                                        <td><?= $o['tot_m_val'] ?></td>
                                        <td><?= $o['tot_g_val'] ?></td>
                                        <td><?= $o['tot_f_val'] ?></td>
                                        <td><?= $o['tot_dis'] ?></td>
                                        <td><?= $o['tot_a_val'] ?></td>
                                        <td><?= $o['date_book'] ?></td>
                                        <td><?= $o['date_actual'] ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>                    			
                            </tbody> 					
                        </table>					
                        <?php
                    } else {
                        ?>
                        <div class="form-group">
                            <input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('nonmovings_table', 'NonMovings_<?= $DateRange ?>')" value="Download Excel">
                        </div>
                        <table  id="nonmovings_table" class="table table-hover">	
                            <thead>						
                                <tr>
                                    <th>Agency</th>
                                    <th>Invoice Number</th>
                                    <th>Route Number</th>
                                    <th>Booking Value</th>
                                    <th>Market Retun</th>
                                    <th>Good Return</th>
                                    <th>Free Issue</th>
                                    <th>Discount</th>
                                    <th>Actual Value</th>
                                    <th>Booking Date</th>
                                    <th>Actual Date</th>
                                </tr>		
                            </thead>		
                            <tbody>
                        <tr>
                            <td colspan='4'><?= 'No Data Found!' ?></td>
                        </tr>
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