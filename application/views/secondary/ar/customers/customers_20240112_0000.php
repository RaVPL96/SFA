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
                <form class="form-horizontal" id="" action="<?= base_url('salesarcustomers/customers') ?>" method="post">
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

                <?php
                if (!empty($RouteList) && isset($RouteList)) {
                    ?>
                <form method="post"  class="form-horizontal" action="<?= base_url('salesarcustomers/routeUpdate') ?>">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Route Name</th>
                                    <th>Active</th>        
                                    <th>Close</th>  
                                </tr>
                            </thead>
                            <?php
                            foreach ($RouteList as $h) {
                                $chk = '';
                                $active = 'Active';
                                if ($h['is_act'] == 0) {
                                    $chk = ' checked ';
                                    $active = '<lable class="lable-warning">Close</lable>';
                                } else {
                                    $active = '<lable class="lable-success">Active</lable>';
                                }
                                echo '<tr><td>' . $h['reference_code'] . '-'. $h['route_name'] . '</td>';
                                echo '<td>' . $active . '</td>';
                                echo '<td><input ' . $chk . ' type="checkbox" name="route_id[]" value="' . $h['id'] . '"></td></tr>';
                            }
                            ?>
                        </table>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="submit" class="btn btn-danger" name="submit" value="Update Route List">
                            </div>                                
                        </div>
                    </form>
                    <?php
                }
                ?>
                <?php if (!empty($outlets) && isset($outlets)) { ?>

                    <table  id="example1" class="table table-hover">	
                        <thead>						
                            <tr>	
                                <th>ID</th>
                                <th>New</th> 
    <!-- <th>Reference Code</th> -->
                                <th>Name</th> 		
                                <th>Address 1</th> 	
                                <th>Address 2</th> 	
                                <th>Address 3</th> 	
                                <th>Contact Person</th> 
                                <!-- <th>Telephone</th> -->	
                                <th>Mobile</th> 	
                                <th>Shop Type</th> 	
                                <th>Created Date</th> 	
                                <th>Created By</th> 	
                                <th>Display Order</th> 	
                                <th>Latitude</th> 	
                                <th>Longitude</th> 	
                                <th>Active</th> 	
                                <th>System ID</th>		
                                <!-- <th>Image</th> 	-->	
                            </tr>		
                        </thead>		
                        <tbody>			
                            <?php
                            foreach ($outlets as $o) {
                                $shop_stat = 'Close';
                                if ($o['is_act'] == 1) {
                                    $shop_stat = 'Open';
                                }
                                $shop_new = '';
                                if ($o['is_new'] == 1) {
                                    $shop_new = 'New';
                                }
                                ?>
                                <tr>		
                                    <td><a target="_blank" href="<?= base_url('salesarcustomers/editCustomers/' . $o['id']) ?>"><?= $o['territory_reference_code'] . '/' . sprintf('%02d', $o['route_reference_code']) . '/' . sprintf('%03d',$o['outlet_code']) ?></a></td> 
                                    <td><?= $shop_new ?></td> 		                                    
                                    <!-- <td><?= $o['reference_code'] ?></td> -->
                                    <td><?= $o['name'] ?></td> 

                                    <td><?= $o['address_1'] ?></td> 	
                                    <td><?= $o['address_2'] ?></td> 	
                                    <td><?= $o['address_3'] ?></td> 	
                                    <td><?= $o['contact_person'] ?></td> 	
                                    <!-- <td><?= $o['telephone'] ?></td> -->	
                                    <td><?= $o['mobile'] ?></td> 		
                                    <td><?= $o['shop_type_name'] ?></td> 	
                                    <td><?= $o['created_date'] ?></td> 	
                                    <td><?= $o['created_by'] ?></td> 	
                                    <td><?= $o['display_order'] ?></td> 	
                                    <td><?= $o['latitude'] ?></td> 		
                                    <td><?= $o['longitude'] ?></td> 	                                    
                                    <td><?= $shop_stat ?></td> 		
                                    <td><?= $o['id'] ?></td> 	
                                    <!-- <td><img style="width:150px;" src="data:image/jpeg;base64,<?= ($o['image']) ?>"/></td>  -->
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