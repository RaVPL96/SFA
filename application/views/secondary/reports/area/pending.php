<?php include_once BASEPATH . ('../application/views/template/leftsidebar.php'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Secondary Sales Customers
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
                <form class="form-horizontal" id="" action="<?= base_url('salesreports/pending') ?>" method="post">
                    <div class="col-md-6">                            
                        <div class="form-group">
                            <label class="col-md-2">Area <span class="text-red">*</span></label>
                            <div class="col-md-6">
                                <select id="areaID" name="areaID" class="form-control">
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

                    <!--div class="col-md-6">
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
                            <label class="col-md-2">Range <span class="text-red">*</span></label>
                            <div class="col-md-6">
                                <select id="sbRange" name="rangeID" class="form-control">
                                    <option value="-1"> -- All -- </option>    
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
                            <label class="col-md-2">Billing Type <span class="text-red">*</span></label>
                            <div class="col-md-6">
                                <select id="sbRange" name="billMethod" class="form-control">
                                    <option value="-1"> -- Select One -- </option>    
                                    <option value="B">Booking</option>
                                    <option value="A">Actual</option>
                                </select>
                            </div>
                        </div>
                    </div-->
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
                    <!--
                    <div class="form-group">
                        <label class="col-md-2">Select Sales Channel <span class="text-red">*</span></label> 
                        <div class="col-md-6">
                            <select name="channel[]" id="example28" multiple="multiple" class="form-control" style="display: none;"><option value="multiselect-all"> Select all</option>-->
                            
                    <?php if (!empty($DateRange) && isset($DateRange)) { ?>
                        <div class="form-group">
                            <input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('pendingbill_table', 'PendingBills_<?= $DateRange ?>')" value="Download Excel">
                        </div>
                        <table  id="pendingbill_table" class="table table-hover">	
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
                                foreach ($pending as $o) {
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
                    } elseif (!empty($DateRange) && isset($DateRange)) {
                        ?>
                        <div class="form-group">
                            <input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('pendingbill_table', 'PendingBills_<?= $DateRange ?>')" value="Download Excel">
                        </div>
                        <table  id="pendingbill_table" class="table table-hover">	
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
                                <?php
                                $olddte = $r["date_book"];
                            }
                            ?>
                        </tbody>
                    </table>
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

<!--
?php include_once BASEPATH . ('../application/views/template/leftsidebar.php'); ?>
<-- Content Wrapper. Contains page content --
<div class="content-wrapper">
    <-- Content Header (Page header) --
    <section class="content-header">
        <h1>
            Secondary Sales Late Dilevery Bills
            <small>Maintain Secondary Sales Late Dilevery Bill Details </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Secondary Sales Late Dilevery Bill Data Control Module</li>
        </ol>
    </section>

    <-- Main content --
    <section class="content">
        <div class="row">
            <div class="col-md-12" style="overflow-x: scroll;">
                <div id="successMessage" class="hideDiv">Updated Successfully! </div>
                <div id="errorMessage" class="hideDiv">Invalid Data! Please Try Again. </div>
                <div class="keepgap"></div> 
                <form class="form-horizontal" id="" action="<?= base_url('Salesreports/pending') ?>" method="post">
                    <div class="col-md-12">
                        
                    <div class="col-md-6">                            
                        <div class="form-group">
                            <label class="col-md-2">Area <span class="text-red">*</span></label>
                            <div class="col-md-6">
                                <select id="areaID" name="areaID" class="form-control">
                                    <option value="-1"> -- Select Area -- </option>    
                                    <?php
                                    foreach ($AreaList as $a) {
                                        $select = '';
                                        if (!empty($AreaID) && isset($AreaID) && $a['area_cd'] == $AreaID) {
                                            $select = 'selected';
                                        }
                                        if (!empty($ASE_Area) && isset($ASE_Area) && $sess['grade_id'] == 4) {//ASE LOGIN LIMIT TO ACCESSILE AREAS
                                            foreach ($ASE_Area as $b) {
                                                if ($b['area_id'] == $a['id']) {
                                                    echo '<option ' . $select . ' value="' . $a['area_cd'] . '"> ' . $a['area_name'] . '</option>';
                                                }
                                            }
                                        } else {
                                            echo '<option ' . $select . ' value="' . $a['area_cd'] . '"> ' . $a['area_name'] . '</option>';
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
                                    </div><-- /.input group -->
                                </div><!-- /.form group --	

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
                            <input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('pendingbill_table', 'PendingBills_<?= $DateRange ?>')" value="Download Excel">
                        </div>
                        <table  id="pendingbill_table" class="table table-hover">	
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
                                foreach ($pending as $o) {
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
                    } elseif (!empty($DateRange) && isset($DateRange)) {
                        ?>
                        <div class="form-group">
                            <input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('pendingbill_table', 'PendingBills_<?= $DateRange ?>')" value="Download Excel">
                        </div>
                        <table  id="pendingbill_table" class="table table-hover">	
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
    <-- /.content -->
</div><!-- /.content-wrapper --

<-- jQuery 2.1.4 --
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