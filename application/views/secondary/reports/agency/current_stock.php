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
                <form class="form-horizontal" id="" action="<?= base_url('salesreports/currentStock') ?>" method="post">
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
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="submit" class="btn btn-danger" name="submit" value="Get Report">
                        </div>                                
                    </div> 
                </form>
                <?php
                if (!empty($StockData) && isset($StockData)) {
                    $strDaySummery=''; 
                    foreach ($StockData as $s) {
                        //issued
                        $issued_bill=$s['invoice_a_qty']+$s['invoice_g_qty']+$s['invoice_m_qty'];//total issued qty without free issue
                        $issued_free_issue=$s['invoice_f_qty'];
                        $issued_gret=$s['good_return_qty'];//gret send to head office
                        $issued_mret=$s['market_return_qty'];//mret send to head office - damaged
                        //received
                        $receive_gret=$s['invoice_g_qty']+$s['invoice_g_free_qty'];
                        $receive_mret=$s['invoice_m_qty']+$s['invoice_m_free_qty'];//damaged stock
                        $receive_from_office=$s['head_office_inv_qty'];
                        
                        $closing_sellable=($s['op_sellable']+$receive_gret+$receive_from_office)-($issued_bill+$issued_free_issue+$issued_gret);
                        $closing_damaged=$s['op_damage']+$receive_mret-$issued_mret;
                        $strDaySummery .= '<tr>' 
                                . '<td colspan="1">' . $s['description'] . '</td>'
                                . '<td colspan="1">' . $s['uom'] . '</td>' 
                                . '<td colspan="1">' . $s['op_sellable'] . '</td>'
                                . '<td colspan="1">' . $s['op_damage'] . '</td>'
                                . '<td colspan="1">' . $s['invoice_a_qty'] . '</td>'
                                . '<td colspan="1">' . $s['invoice_f_qty'] . '</td>'
                                . '<td colspan="1">' . $s['invoice_g_qty'] . '</td>'
                                . '<td colspan="1">' . $s['invoice_g_free_qty'] . '</td>' 
                                . '<td colspan="1">' . $s['invoice_m_qty'] . '</td>' 
                                . '<td colspan="1">' . $s['invoice_m_free_qty'] . '</td>' 
                                . '<td colspan="1">' . $s['good_return_qty'] . '</td>' 
                                . '<td colspan="1">' . $s['market_return_qty'] . '</td>' 
                                . '<td colspan="1">' . $s['head_office_inv_qty'] . '</td>'
                                . '<td colspan="1">' . $s['head_office_inv_qty_pending_accept'] . '</td>'
                                . '<td colspan="1" style="background: #00cc00; font-weight:bold">' . $closing_sellable . '</td>' 
                                . '<td colspan="1">' . $closing_damaged . '</td>'  
                                . '</tr>';
                    } 
                    ?>
                    <div class="form-group col-md-12">
                        <input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('attendance_table', 'Current Stock')" value="Download Excel">
                    </div> 
                    <table id="attendance_table" class="table table-hover">	
                        <thead>						
                            <tr>	
                                <th colspan="1">Item</th>
                                <th colspan="1">UOM</th> 
                                <th colspan="1">Opening (Sellable)</th>
                                <th colspan="1">Opening (Damaged)</th>
                                <th colspan="1">Invoice - Actual</th> 	
                                <th colspan="1">Invoice - Free Issue</th> 
                                <th colspan="1">Invoice - Good Return</th> 
                                <th colspan="1">Invoice - Good Return Free</th> 
                                <th colspan="1">Invoice - Mkt Return</th> 
                                <th colspan="1">Invoice - Mkt Return Free</th> 	
                                <th colspan="1">To Head Office - Good Return</th> 
                                <th colspan="1">To Head Office - Mkt Return</th> 
                                <th colspan="1">Received from Head Office</th> 	
                                <th colspan="1">Pending to Receive from Head Office</th> 
                                <th colspan="1" style="background: #00cc00;">Closing (Sellable)</th>
                                <th colspan="1">Closing (Damaged)</th>	
                            </tr>		
                        </thead>		
                        <tbody>	 
                            <?= $strDaySummery ?>               			
                        </tbody> 					
                        <tfoot>
                            <tr>		 
                                <td colspan="13">&nbsp;</td> 
                            </tr>
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