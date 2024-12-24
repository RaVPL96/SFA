<?php include_once BASEPATH . ('../application/views/template/leftsidebar.php'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Secondary Sales - New Customers
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
                <form class="form-horizontal" id="" action="<?= base_url('salesarcustomers/newCustomerReport') ?>" method="post">
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
                if (!empty($outlets) && isset($outlets)) {
                    $total_new_shops = 0;
                    ?>
                    <div class="form-group">
                        <input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('table-area', 'Outlets')" value="Download Excel">
                    </div>
                    

                    <table id="table-area" class="table table-hover">	
                        <thead>						
                            <tr>	
                                <th>Area</th>
                                <th>Territory</th> 
                                <!-- <th>Reference Code</th> -->
                                <th>Total Shops</th>
                                <th>Total Tet</th>
                                <?php
                                $date1 = $FromDate;
                                $date2 = $ToDate;
                                //$output = [];
                                $time = strtotime($date1);
                                $last = date('M-Y', strtotime($date2));

                                do {
                                    $month = date('M-Y', $time);
                                    $total = date('t', $time);

                                    //$output[] = $month;
                                    //$str .= ', COUNT(DISTINCT  IF(month(`tbl_mst_outlet`.`created_date`)=' . date('m', $time) . ' and year(`tbl_mst_outlet`.`created_date`)=' . date('Y', $time) . ', `tbl_mst_outlet`.`id`,null)) AS `' . date('Y', $time) . '-' . date('M', $time) . '`';
                                    echo '<th>' . date('Y', $time) . '-' . date('M', $time) . '</td>';
                                    $time = strtotime('+1 month', $time);
                                } while ($month != $last);
                                ?>

                                

            <!-- <th>Image</th> 	-->	
                            </tr>		
                        </thead>		
                        <tbody>			
                            <?php foreach ($outlets as $o) {
                                ?>
                                <tr>		
                                    <td><?= $o['area_name'] ?></td>             
                                    <td><?= $o['territory_name'] ?></td>
                                    <td><?= $o['TOTAL_SHOPS'] ?></td>
                                    <td><?= $o['TOTAL_TERRITORIES'] ?></td>
                                    <?php
                                    $date1 = $FromDate;
                                    $date2 = $ToDate;
                                    //$output = [];
                                    $time = strtotime($date1);
                                    $last = date('M-Y', strtotime($date2));

                                    do {
                                        $month = date('M-Y', $time);
                                        $total = date('t', $time);

                                        //$output[] = $month;
                                        //$str .= ', COUNT(DISTINCT  IF(month(`tbl_mst_outlet`.`created_date`)=' . date('m', $time) . ' and year(`tbl_mst_outlet`.`created_date`)=' . date('Y', $time) . ', `tbl_mst_outlet`.`id`,null)) AS `' . date('Y', $time) . '-' . date('M', $time) . '`';
                                        $created_by_text='<small class="text-muted">';
                                        foreach ($outletsDetails as $a){
                                            if($o['area_name']==$a['area_name'] && $o['territory_name']==$a['territory_name']){
                                                $created_by_text.='<br>'.$a['created_by'].'-'.$a[date('Y', $time) . '-' . date('M', $time)];
                                            }
                                        }
                                        $created_by_text.='</small>';
                                        
                                        echo '<td>' . $o[date('Y', $time) . '-' . date('M', $time)] .$created_by_text. '</td>';
                                        $total_new_shops = $total_new_shops + $o[date('Y', $time) . '-' . date('M', $time)];
                                        $time = strtotime('+1 month', $time);
                                    } while ($month != $last);
                                    ?>
                                </tr>						
                                <?php
                            }
                            ?>                    			
                        </tbody> 
                        <tfoot>

                        </tfoot>
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