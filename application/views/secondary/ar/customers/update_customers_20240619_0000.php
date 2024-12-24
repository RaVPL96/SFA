<?php include_once BASEPATH . ('../application/views/template/leftsidebar.php'); ?>
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
                                        if (!empty($ASE_Area) && isset($ASE_Area) && $sess['grade_id'] == 4) {//ASE LOGIN LIMIT TO ACCESSILE AREAS
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

                                        if ($sess['grade_id'] == 4) {
                                            foreach ($ASE_Area as $ase) {
                                                if ($ase['range_id'] == $a['id']) {
                                                    if($rangeid==$a['id']){
                                                echo '<option selected value="' . $a['id'] . '"> ' . $a['range_name'] . '</option>';
                                                    }else{

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
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Territory</th>
                                    <th>Total Outlets</th>
                                    <th>S. Rep Completed</th>
                                    <th>S. Rep Completed %</th>
                                    <!--
                                    <th>C</th>
                                    <th>D</th>
                                    <th>S</th>
                                    <th>R</th>
                                    -->
                                    <th>S. Rep Pending to Update</th>
                                    <th>ASE Approvals Pending</th>
                                    <th>Progress</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($outletsUpdateProgress as $p) {
                                    ?>
                                    <!--
                                    <div class="progress-group">
                                        <span class="progress-text"><?= $p['territory_name'] ?></span>
                                        <span class="progress-number"><b><?= $p['COMPLETED'] ?></b>/<?= $p['TOTAL'] ?></span>
                                        <span class="progress-text"><?= $p['PENDING_TO_COMPLETE'] ?></span>
                                        <div class="progress sm">
                                            <div class="progress-bar progress-bar-aqua" style="width: <?= number_format(($p['COMPLETED'] / $p['TOTAL']) * 100) ?>%"></div>
                                        </div>
                                    </div>
                                    -->
                                    <tr>
                                        <td><span class="progress-text"><?= $p['territory_name'] ?></span></td>
                                        <td><span class="progress-text"><?= $p['TOTAL'] ?></span></td>
                                        <td><span class="progress-text"><?= $p['COMPLETED'] ?></span></td>
                                        <td><?= number_format(($p['COMPLETED'] / $p['TOTAL']) * 100) ?>%</td>
                                        <!--
                                        <td><?= $p['C'] ?></td>
                                        <td><?= $p['D'] ?></td>
                                        <td><?= $p['S'] ?></td>
                                        <td><?= $p['R'] ?></td>
                                        -->
                                        <td><span class="progress-text"><?= $p['PENDING_TO_COMPLETE'] ?></span></td>
                                        <td><span class="progress-text"><?= $p['PENDINGTO_APPROVED'] ?></span></td>
                                        <td style="background: #c3c3c3;">
                                            <div class="progress sm">
                                                <div class="progress-bar progress-bar-aqua" style="width: <?= number_format(($p['COMPLETED'] / $p['TOTAL']) * 100) ?>%"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php
                    }
                    ?>
                </div>
                <?php if (!empty($outlets) && isset($outlets)) { ?>
                    <form class="form-horizontal" id="" action="<?= base_url('salesarcustomers/outletUpdateSave') ?>" method="post">
                    <table id="" class="table table-hover">
                        <thead>
                            <tr>
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

                                if ($sess['grade_id'] == 4) {
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
                                        <td><label><input <?= $read ?> type="radio" name="approve[<?= $o['unique_id'] ?>]" value="1"> Approve</label></td>
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

<script type="text/javascript">
    $("#frmLocation").validate({
        rules: {
            "location[name]": {
                required: true
            },
            "location[address]": {
                required: true
            },
            "location[phone]": {
                required: true
            },
            "location[email]": {
                required: true
            }
        },
        messages: {
            "email": 'Please fill this field',
            "pass": 'Please fill this field'
        },
        highlight: function (element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function (error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
        /*submitHandler: function(form) {
         return true;
         }*/
    });
</script>


<script type="text/javascript">
    $('#Operation').change(function () {
        $('#areawrap').empty();
        $('#territoryList').empty();
        var modID = $('#Operation').val();
        //alert(modID);
        $.ajax({
            type: "post",
            url: "<?php echo base_url('index.php/master/getOperationAreasAjax'); ?>",
            data: 'opid=' + modID,
            success: function (feed) {
                $('#uploading').modal('hide');
                //alert(feed);
                $('#areawrap').empty().append(feed);

            },
            error: function (feed) {
                console.log('Ajax request not recieved!' + feed);
                $('#uploading').modal('hide');
            }
        });
        return false;
    });
    $(document).on('change', '#areaid', function () {
        var modID = $('#areaid').val();
        $('#territoryList').empty();
        //alert(modID);
        $.ajax({
            type: "post",
            url: "<?php echo base_url('index.php/master/getOperationAreasTerritoryAjax'); ?>",
            data: 'opid=' + modID,
            success: function (feed) {
                $('#uploading').modal('hide');
                //alert(feed);
                $('#territoryList').empty().append(feed);

            },
            error: function (feed) {
                console.log('Ajax request not recieved!' + feed);
                $('#uploading').modal('hide');
            }
        });
        return false;
    });

    $(document).on('change', '#territoryid', function () {
        var modID = $('#territoryid').val();
        $('#routeList').empty();
        //alert(modID);
        $.ajax({
            type: "post",
            url: "<?php echo base_url('index.php/master/getOperationAreasTerritoryRouteAjax'); ?>",
            data: 'opid=' + modID,
            success: function (feed) {
                $('#uploading').modal('hide');
                //alert(feed);
                $('#routeList').empty().append(feed);

            },
            error: function (feed) {
                console.log('Ajax request not recieved!' + feed);
                $('#uploading').modal('hide');
            }
        });
        return false;
    });

</script>


<script type="text/javascript">
    function deleteData(uid, reqType, upval) {
        if (reqType == 'update') {
            $.ajax({
                type: "post",
                url: "<?php echo base_url('index.php/items/updateLocData'); ?>",
                data: 'id=' + uid + '&reqType=' + reqType + '&upVal=' + upval,
                success: function (feed) {
                    if (feed.trim() == '1') {
                        //swal("Updated!", "Your data is now updated.", "success");
                        window.location.reload();
                    } else {
                        swal("Error!", "Unable to process your request", "error");
                    }
                },
                error: function (feed) {
                    swal("Error!", "Unable to process your request", "error");
                }
            });
        } else {
            swal({
                title: "Are you sure?",
                text: "Are you sure want to update this record?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Update it!",
                closeOnConfirm: false
            },
                    function () {
                        $.ajax({
                            type: "post",
                            url: "<?php echo base_url('index.php/items/updateLocData'); ?>",
                            data: 'id=' + uid + '&reqType=' + reqType + '&upVal=' + upval,
                            success: function (feed) {
                                if (feed.trim() == '1') {
                                    swal("Updated!", "Your data is now updated.", "success");
                                    window.location.reload();
                                } else {
                                    swal("Error!", "Unable to process your request", "error");
                                }
                            },
                            error: function (feed) {
                                swal("Error!", "Unable to process your request", "error");
                            }
                        });
                    });
        }
    }
</script>