<?php include_once BASEPATH . ('../application/views/template/leftsidebar.php'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Sales Geography - Map Range, Area, Territory, Current Territory, Agency ID Architecture
            <small>Maintain Secondary Map  Details </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Master Data Control Module</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div id="successMessage" class="hideDiv">Updated Successfully! </div>
                <div id="errorMessage" class="hideDiv">Invalid Data! Please Try Again. </div>
                <div class="keepgap"></div>  
                <?php
                $territory_id = '';
                $area_id = '';
                $lid = 'new';
                $isactval = 'checked="checked"';
                $isdelval = '';
                $btnmsg = 'Create Area-Territory Mapping';
                if (!empty($GeoDataLine) && isset($GeoDataLine)) {
                    $lid = $GeoDataLine->id;
                    $region_id = $GeoDataLine->region_id;
                    $area_id = $GeoDataLine->area_id;
                    $territory_id = $GeoDataLine->territory_id;
                    $current_territory_id = $GeoDataLine->current_territory_id;
                    $range_id = $GeoDataLine->range_id;
                    $agency_id = $GeoDataLine->agency_id;
                    $btnmsg = 'Update Area-Territory Mapping';
                }
                ?>


                <form id="frmLocation" role="form" action="<?= base_url('index.php/master/saveGeographyMapping') ?>" method="post">
                    <fieldset>
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Map Area-Territory Geography Layers</h3> (Enter Details)  <a class="btn btn-success pull-right btn-sm" href="<?= base_url('index.php/master/saveGeographyMapping/') ?>"><i class="fa fa-plus"></i> New</a>                              
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-md-12">Region <span class="text-red">*</span></label>
                                    <?php
                                    if (!empty($RegionDataSet) && isset($RegionDataSet)) {
                                        ?>
                                        <select name="sop[region_id]" class="form-control">
                                            <option value="">-- Select Region --</option> 
                                            <?php
                                            foreach ($RegionDataSet as $r) {
                                                $select = '';
                                                if ($region_id == $r['id']) {
                                                    $select = 'selected="selected"';
                                                }
                                                ?>
                                                <option <?= $select ?> value="<?= $r['id'] ?>"><?= $r['region_name'] ?></option> 
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <?php
                                    }
                                    ?>
                                </div>    
                                <div class="form-group">
                                    <label class="col-md-12">Area <span class="text-red">*</span></label>
                                    <?php
                                    if (!empty($AreaDataSet) && isset($AreaDataSet)) {
                                        ?>
                                        <select name="sop[area_id]" class="form-control">
                                            <option value="">-- Select Area --</option> 
                                            <?php
                                            foreach ($AreaDataSet as $r) {
                                                $select = '';
                                                if ($area_id == $r['id']) {
                                                    $select = 'selected="selected"';
                                                }
                                                ?>
                                                <option <?= $select ?> value="<?= $r['id'] ?>"><?= $r['area_name'] ?></option> 
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Territory <span class="text-red">*</span></label>
                                    <?php
                                    if (!empty($TerritoryDataSet) && isset($TerritoryDataSet)) {
                                        ?>
                                        <select name="sop[territory_id]" class="form-control">
                                            <option value="">-- Select Territory --</option> 
                                            <?php
                                            foreach ($TerritoryDataSet as $a) {
                                                $select = '';
                                                if ($territory_id == $a['id']) {
                                                    $select = 'selected="selected"';
                                                }
                                                ?>
                                                <option <?= $select ?> value="<?= $a['id'] ?>"><?= $a['territory_name'] ?></option> 
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Current Territory <span class="text-red">*</span></label>
                                    <?php
                                    if (!empty($TerritoryDataSet) && isset($TerritoryDataSet)) {
                                        ?>
                                        <select name="sop[current_territory_id]" class="form-control">
                                            <option value="">-- Current Territory --</option> 
                                            <?php
                                            foreach ($TerritoryDataSet as $a) {
                                                $select = '';
                                                if ($current_territory_id == $a['id']) {
                                                    $select = 'selected="selected"';
                                                }
                                                ?>
                                                <option <?= $select ?> value="<?= $a['id'] ?>"><?= $a['territory_name'] ?></option> 
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Range <span class="text-red">*</span></label> 
                                    <select id="sbRange" name="sop[range_id]" class="form-control">
                                        <option value="-1"> -- Select Range -- </option>    
                                        <?php
                                        foreach ($RangeList as $a) {
                                            $select = '';
                                            if ($range_id == $a['id']) {
                                                $select = 'selected="selected"';
                                            }
                                            echo '<option ' . $select . ' value="' . $a['id'] . '"> ' . $a['range_name'] . '</option>';
                                        }
                                        ?>
                                    </select> 
                                </div> 
                                <div class="form-group">
                                    <label class="col-md-12">Distributor Name <span class="text-red">*</span></label> 
                                    <select id="sbRange" name="sop[distributor_id]" class="form-control">
                                        <option value="-1"> -- Select Distributor -- </option>    
                                        <?php
                                        foreach ($DistributorDataSet as $a) {
                                            $select = '';
                                            if ($agency_id == $a['id']) {
                                                $select = 'selected="selected"';
                                            }
                                            echo '<option ' . $select . ' value="' . $a['id'] . '"> ' . $a['agency_name'] . ' - ' . $a['agency_code'] . ' </option>';
                                        }
                                        ?>
                                    </select> 
                                </div> 
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <input type="hidden" name="sop[id]" value="<?php
                                        if (!empty($lid) && isset($lid)) {
                                            echo $lid;
                                        } else {
                                            echo 'new';
                                        }
                                        ?>">
                                <button type="submit" class="btn btn-primary pull-right"><?= $btnmsg ?></button>
                            </div>                            
                        </div><!-- /.box -->
                    </fieldset>
                </form>

            </div>


            <!--Right Side Content-->
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sales Area-Territory Mapping List</h3> (Click Edit to change details)
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered" id="example1">
                            <thead>
                                <tr>
                                    <th style="width: 180px">ID</th>
                                    <th style="width: 180px">Range</th>
                                    <th style="width: 180px">Region</th>
                                    <th style="width: 180px">Region Code</th>
                                    <th style="width: 180px">Area</th>
                                    <th style="width: 180px">Area Code</th>
                                    <th style="width: 180px">Territory</th>
                                    <th style="width: 180px">Territory Code</th>
                                    <th style="width: 80px">Current Territory</th>
                                    <th style="width: 40px">Current Territory Code</th>
                                    <th style="width: 40px">Agency</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($GeoDataSet) && isset($GeoDataSet)) {
                                    foreach ($GeoDataSet as $loc) {
                                        $action = 0;

                                        echo '<tr class="info">
											<td><a href="' . base_url('master/finalGeographyMapping/' . $loc['id']) . '">' . $loc['id'] . '</a></td>
											<td>' . $loc['range_name'] . '</td>
											<td>' . $loc['region_name'] . '</td>
											<td>' . $loc['region_code'] . '</td>
											<td>' . $loc['area_name'] . '</td>
											<td>' . $loc['area_id'] . '</td>
											<td>' . $loc['territory_name'] . '</td>
											<td>' . $loc['territory_reference_code'] . '</td>
											<td>' . $loc['current_territory_name'] . '</td>
											<td>' . $loc['current_territory_reference_code'] . '</td>
											<td>' . $loc['agency_name'] . '</td>'
                                        . '</tr>';
                                    }
                                }
                                ?>   
                            </tbody>							
                        </table>
                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix">

                    </div>
                </div><!-- /.box -->
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
    $('#module').change(function () {
        var modID = $('#module').val();
        //alert(modID);
        $.ajax({
            type: "post",
            url: "<?php echo base_url('index.php/users/getFunctions'); ?>",
            data: 'mid=' + modID,
            success: function (feed) {
                $('#uploading').modal('hide');
                //alert(feed);
                $('#fwrap').empty().append(feed);

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