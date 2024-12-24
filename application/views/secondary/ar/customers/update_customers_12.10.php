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
        z-index: 5;
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
    .presentation th.fix {
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
        /*white-space: pre;*/
    }

    .presentation tbody tr td:nth-child(1) {
        position: sticky;
        left: 0;
        /*z-index: 1;*/
    }
    .headcol{
        position: -webkit-sticky;
        position: sticky;
        background-color: white;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Update Secondary Sales Customers
            <small>Maintain Secondary Sales Details </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Master Data Control Module</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12" style="overflow-x: scroll;">
                <div id="successMessage" class="hideDiv">Updated Successfully! </div>
                <div id="errorMessage" class="hideDiv">Invalid Data! Please Try Again. </div>
                <div class="keepgap"></div>
                <form class="form-horizontal" id="" action="<?= base_url('salesarcustomers/outletUpdate') ?>" method="post">
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
                                        if (!empty($ASE_Area) && isset($ASE_Area) && 
                                        // (1==2)
                                         $sess['grade_id'] == 4 
                                        
                                        
                                        ) {//ASE LOGIN LIMIT TO ACCESSILE AREAS
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
                                <select id="RangeRep" name="rangeID" class="form-control">
                                    <option value="-1"> -- Select Range -- </option>
                                    <?php
                                    foreach ($RangeList as $a) {
                                        $select = '';
                                        if (!empty($RangeID) && isset($RangeID) && $a['id'] == $RangeID) {
                                            $select = 'selected';
                                        }

                                        if ($sess['grade_id'] == 4)
                                        
                                        //   if ($sess)
                                        
                                        {
                                            foreach ($ASE_Area as $ase) {
                                                if ($ase['range_id'] == $a['id']) {
                                                    if ($rangeid == $a['id']) {
                                                        echo '<option selected value="' . $a['id'] . '"> ' . $a['range_name'] . '</option>';
                                                    } else {

                                                        echo '<option ' . $select . ' value="' . $a['id'] . '"> ' . $a['range_name'] . '</option>';
                                                    }
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-2">Route <span class="text-red">*</span></label>
                            <div class="col-md-6">
                                <select id="routeID" name="routeID" class="form-control">
                                    <option value=""> -- Select Route -- </option>                                       
                                </select>
                            </div>
                        </div>                            
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-2">Get Only <span class="text-red">*</span></label>
                            <div class="col-md-6">
                                <select id="filter" name="filter" class="form-control">
                                    <option value="-1"> -- All Shops -- </option>  
                                    <option value="0"> -- ASE/ASM Pending Approval -- </option>    
                                    <option value="2"> -- Sales Rep Pending -- </option>    
                                </select>
                            </div>
                        </div>                            
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="submit" class="btn btn-danger" name="submit" value="Get Update List">
                        </div>
                    </div>
                    <div class="col-md-12">
                    <div class="form-group">
                    <input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('attendance_table', 'Daily Shop-wise Sales ')"
                     value="Download Excel">
                     </div>
                     </div>
                    <!--
                    <div class="form-group">
                        <label class="col-md-2">Select Sales Channel <span class="text-red">*</span></label>
                        <div class="col-md-6">
                            <select name="channel[]" id="example28" multiple="multiple" class="form-control" style="display: none;"><option value="multiselect-all"> Select all</option>
                    <?php
                    foreach ($ChannelDataSet as $ch) {
                        echo '<option value="' . $ch['id'] . '"> ' . $ch['channel_name'] . '</option>';
                    }
                    ?>
                            </select>
                            <div class="btn-group open">
                            </div>
                        </div>
                    </div>
                    -->
                </form>

                <div class="col-md-12">
                    <p class="text-center">
                    <h3>Goal Completion</h3>
                    </p>
<?php
if (!empty($outletsUpdateProgress) && isset($outletsUpdateProgress)) {
    ?>
    <table id="attendance_table" class="table table-hover presentation">
        <thead>
            <tr>
                <?php
                $yesterday = date('Y-m-d', strtotime('-1 day'));
                $daybeforeyesterday = date('Y-m-d', strtotime('-2 day'));

                if (!empty($Area_ID) && isset($Area_ID)) {
                    echo '<th>Area</th>';
                }
                ?>
                <th>Territory</th>
                <th>Total Outlets</th>
                <th>Active outlets</th>
                <th>Closed outlets 
                (Permanently)</th>
                <th>S. Rep Completed</th>
                <th>S. Rep Completed %</th>
                <th>S. Rep Pending to Update</th>
                <th>ASE Approvals Pending</th>
                <!-- New Column for Closed Count -->
                <th>Progress</th>
                <th>ASE Approvals ON <?php echo $daybeforeyesterday ?></th>
                <th>ASE Approvals ON <?php echo $yesterday ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($outletsUpdateProgress as $p) {
                ?> 
                <tr>
                    <?php
                    if (!empty($Area_ID) && isset($Area_ID)) {
                        echo '<td class="sticky-col first-col" >' . $p['area_name'] . '</td>';
                    }
                    ?>
                    <td><span class="progress-text"><?= $p['territory_name'] ?></span></td>
                    <td><span class="progress-text"><?= $p['TOTAL'] ?></span></td>
                    <td><span class="progress-text"><?= $p[ 'Active_count'] ?>  </span></td>
                                                            <!-- New Column Data for Closed Count -->
                    <td><span class="progress-text"><?= $p['closed_count'] ?></span></td>
                    <td><span class="progress-text"><?= $p['COMPLETED'] ?></span></td>
                    <td>
                        <?php
                        if ($p['Active_count'] > 0) {
                            echo number_format(($p['COMPLETED'] / $p['Active_count']) * 100) . '%';
                        } else {
                            echo 'N/A'; // Or any default message/value you'd like to show
                        }
                        ?>
                    </td>

                  
                        <!--<td><span class="progress-text"><?= $p['Active_count']  - $p['COMPLETED']  ?></span></td>-->
                        
                        
                    <td><span class="progress-text"><?= $p['PENDING_TO_COMPLETE'] ?></span></td>
                    
                    <td><span class="progress-text"><?= $p['PENDINGTO_APPROVED'] ?></span></td>
                    <td style="background: #c3c3c3;">
                        <div class="progress sm">
                            <div class="progress-bar progress-bar-aqua" style="width: <?= number_format((  $p['COMPLETED'] / ($p['Active_count'] ) ) * 100) ?>%"></div>
                        </div>
                    </td>
                    <td><span class="progress-text"><?= $p['day_before_yesterday'] ?></span></td>
                    <td><span class="progress-text"><?= $p['yesterday'] ?></span></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <?php
}
?>
  <div class="form-group">
                    <input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('shop_table', 'Daily Shop-wise Sales ')"
                     value="Download shop">
                     </div>


                </div>
<?php if (!empty($outlets) && isset($outlets)) { ?>
    <form class="form-horizontal" id="" action="<?= base_url('salesarcustomers/outletUpdateSave') ?>" method="post">
        <table id="shop_table" class="table table-hover">
            <thead>
                <tr>
                    <th>Number</th> <!-- New Column Header -->
                <th> </th>
                                    <th> </th>
                                    <th> </th>
                                    <th>ID</th>
                                    <th>Status</th>
                    <!-- <th>Reference Code</th> -->
                    <th>Name</th>
                    <th>Address 1</th>
                    <th>Address 2</th>
                    <th>Address 3</th> 
                    <!-- <th>Telephone</th> -->
                    <th>Mobile</th>
                    <th>Shop Type</th>
                    <th>Image</th>
                    <th>Created Date</th>
                    <th>Created By</th>
                    <th>Display Order</th> 
                    <th>Active</th>
                    <th>System ID</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = 1; // Initialize counter for row numbering
                foreach ($outlets as $o) {
                    $shop_stat = 'Close';
                    if ($o['is_act'] == 1) {
                        $shop_stat = 'Open';
                    }
                    $is_closed = '';
                    if ($o['is_closed'] == 1) {
                        $is_closed = ' style="background:red;color:#fff;" ';
                    }
                    $read = '';
                    $shop_new = '';
                    if ($o['is_updated'] == 1 && $o['is_approved'] == 0) {
                        $read = '';
                        $shop_new = '<label class="label label-warning">Pending Approval</label>';
                    } elseif ($o['is_updated'] == 1 && $o['is_approved'] == 1) {
                        $read = ' disabled ';
                        $shop_new = '<label class="label label-success">Approved</label>';
                    } elseif ($o['is_updated'] == 0) {
                        $read = ' disabled ';
                        $shop_new = '<label class="label label-default">Sales Rep Pending</label>';
                    }
                    //$sess['grade_id'] == 4
                    if (1==2) {
                        if ($o['is_updated'] == 1 && $o['is_approved'] == 0) {
                            $ok = '';
                            foreach ($ASE_Area as $ase) {
                                if ($ase['range_id'] == $o['range_id']) {
                                    $ok = 'ok';
                                }
                            }

                                            if ($ok == 'ok') {
                                                ?>
                                                <tr <?= "$is_closed" ?> >
                                                    <td><label><input <?= $read ?> type="radio" name="approve[<?= $o['unique_id'] ?>]" value="1"> Approve</label></td>
                                                    <td><label><input <?= $read ?> type="radio" name="approve[<?= $o['unique_id'] ?>]" value="2"> Approve without Image</label></td>
                                                    <td><label><input <?= $read ?> type="radio" name="approve[<?= $o['unique_id'] ?>]" value="0"> Reject</label></td>
                                                    <td><a target="_blank" href="<?= base_url('salesarcustomers/getUpdatedCustomer/' . $o['id']) ?>"><?= $o['territory_reference_code'] . '/' . $o['route_reference_code'] . '/' . $o['outlet_code'] ?></a></td>
                                                    <td><?= $shop_new ?></td>
                                                    <!-- <td><?= $o['reference_code'] ?></td> -->
                                                    <td><?= $o['name'] ?></td>

                                                    <td><?= $o['address_1_up'] . '<br><span class="text-muted">(' . $o['address_1'] . ')</span>' ?></td>
                                                    <td><?= $o['address_2_up'] . '<br><span class="text-muted">(' . $o['address_2'] . ')</span>' ?></td>
                                                    <td><?= $o['address_3_up'] . '<br><span class="text-muted">(' . $o['address_3'] . ')</span>' ?></td>
                                                     <!-- <td><?= $o['telephone'] ?></td> -->
                                                    <td><?= $o['telephone_up'] . '<br><span class="text-muted">(' . $o['telephone'] . ')</span>' ?></td>
                                                    <td><?= $o['shop_type_name'] ?></td>
                                                    <td><?php if ($o['image_created_up'] == 1) { ?><img style="width:150px;" src="<?= base_url('../dbbackup/update_image/' . $o['image_name_up']) ?>"/><?php } else { ?><img style="width:150px;" src="data:image/jpeg;base64,<?= $o['image_up'] ?>"/><?php } ?></td>
                                                    <td><?= $o['created_date'] ?></td>
                                                    <td><?= $o['created_by'] ?></td>
                                                    <td><?= $o['display_order'] ?></td> 
                                                    <td><?= $shop_stat ?></td>
                                                    <td><?= $o['id'] ?></td>
                                                </tr>
                                                <?php
                                            }
                        }
                    } else {
                        ?>
                        <tr <?= "$is_closed" ?> >
                            <td><?= $counter++ ?></td> <!-- Display and increment counter -->
                            <td><label><input <?= $read ?> type="radio" name="approve[<?= $o['unique_id'] ?>]" value="1"> Approve</label></td>
                            <td><label><input <?= $read ?> type="radio" name="approve[<?= $o['unique_id'] ?>]" value="2"> Approve without Image</label></td>
                                                                        <td><label><input <?= $read ?> type="radio" name="approve[<?= $o['unique_id'] ?>]" value="0"> Reject</label></td>

                            <td><!-- <a target="_blank" href="<?= base_url('salesarcustomers/getUpdatedCustomer/' . $o['id']) ?>"> --><?= $o['territory_reference_code'] . '/' . $o['route_reference_code'] . '/' . $o['outlet_code'] ?><!-- </a> --></td>
                            <td><?= $shop_new ?></td>
                            <!-- <td><?= $o['reference_code'] ?></td> -->
                            <td><?= $o['name'] ?></td>
                            <td><?= $o['address_1_up'] . '<br><span class="text-muted">(' . $o['address_1'] . ')</span>' ?></td>
                            <td><?= $o['address_2_up'] . '<br><span class="text-muted">(' . $o['address_2'] . ')</span>' ?></td>
                            <td><?= $o['address_3_up'] . '<br><span class="text-muted">(' . $o['address_3'] . ')</span>' ?></td>
                            <!-- <td><?= $o['telephone'] ?></td> -->
                            <td><?= $o['telephone_up'] . '<br><span class="text-muted">(' . $o['telephone'] . ')</span>' ?></td>
                            <td><?= $o['shop_type_name'] ?></td>
                            <td><?php if ($o['image_created_up'] == 1) { ?><img style="width:150px;" src="<?= base_url('../dbbackup/update_image/' . $o['image_name_up']) ?>"/><?php } else { ?><img style="width:150px;" src="data:image/jpeg;base64,<?= $o['image_up'] ?>"/><?php } ?></td>
                            <td><?= $o['created_date'] ?></td>
                            <td><?= $o['created_by'] ?></td>
                            <td><?= $o['display_order'] ?></td> 
                            <td><?= $shop_stat ?></td>
                            <td><?= $o['id'] ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
        <div class="col-md-12">
            <div class="form-group">
                <input type="submit" class="btn btn-danger" name="submit" value="Approve Data">
            </div>
        </div>
    </form>
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
<script>
    /*const tables = document.querySelectorAll('table');
    for (let table of tables) {
        let headerCell = null;
        let headerCell2 = null;
        let i = 1;
        for (let row of table.rows) {
            const firstCell = row.cells[0];
            let firstCell2 = row.cells[1];

            firstCell.style.backgroundColor = "#ffff64";
            firstCell.style.verticalAlign = "middle";
            firstCell.style.fontSize = "20px";
            firstCell.style.fontWeight = "bold";


            if (headerCell === null || firstCell.innerText !== headerCell.innerText) {
                firstCell2 = row.cells[1];
                headerCell = firstCell;
            } else {
                headerCell.rowSpan++;
                firstCell.remove();
                firstCell2 = row.cells[0];
            }
 
            i += 1;
        }
    }*/
</script>