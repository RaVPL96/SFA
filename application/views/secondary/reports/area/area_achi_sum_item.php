<?php include_once BASEPATH . ('../application/views/template/leftsidebar.php'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Secondary Sales Area Item Wise Summery
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
                <form class="form-horizontal" id="" action="<?= base_url('salesreports/areaSummeryItem') ?>" method="post">
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
                    <div class="col-md-6" style="display: none;">
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
                            <label class="col-md-2">Category<span class="text-red">*</span></label>
                            <div class="col-md-6">
                                <select id="cat" name="cat" class="form-control">
                                    <option value="">-- All --</option>    
                                    <?php
                                    foreach ($cat as $c) {
                                        $select = '';
                                        if (!empty($cat) && isset($cat) && $c['cat'] == $cat) {
                                            $select = 'selected';
                                        }
                                        echo '<option ' . $select . ' value="' . $c['cat'] . '"> ' . $c['cat'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" style="">                            
                        <div class="form-group">
                            <label class="col-md-2">Billing Type <span class="text-red">*</span></label>
                            <div class="col-md-6">
                                <select id="sbRange" name="billMethod" class="form-control">
                                    <option selected="selected" value="-1"> -- Select One -- </option>    
                                    <option value="B">Booking</option>
                                    <option value="A">Actual</option>
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
                </form>
                <?php
                if (!empty($SalesData) && isset($SalesData)) {
                    /*  $totBills = 0;
                      $totPCs = 0;
                      $totBValue = 0;
                      $totCancelPC = 0;
                      $totAPCs = 0;
                      $totCValue = 0;
                      $totGValue = 0;
                      $totMValue = 0;
                      $totAValue = 0;
                      $totDValue = 0; */

                    $strTerritorySummery = '';
                    $strTerritory = '';
                    $strTerritoryID = '';
                    $totTerrBills = 0;
                    $totTerrPCs = 0;
                    $totTerrAPCs = 0;
                    $totTerrBValue = 0;
                    $totTerrCancelPC = 0;
                    $totTerrCValue = 0;
                    $totTerrGValue = 0;
                    $totTerrMValue = 0;
                    $totTerrDValue = 0;
                    $totTerrAValue = 0;

                    $item = '';
                    $des = '';
                    $cat = '';
                    $Qty = 0;
                    $Val = 0;


                    $strDaySummery = '';

                    if (!empty($SalesDataTerritory) && isset($SalesDataTerritory)) {


                        $totalRows = count($SalesDataTerritory);
                        $c = 0;

                        $dt = str_replace('/', '-', trim(str_replace(' - ', '~', trim($DateRange))));
                        ?> 
                        <?php
                        foreach ($SalesDataTerritory as $s) {
                            $strTerritorySummery .= '<tr>
                    <td>' . $s['name'] . '</td>
                    <td>' . $s['item'] . '</td>
                    <td>' . $s['des'] . '</td>
                    <td align="right">' . number_format($s['PC']) . '</td>
                    <td align="right">' . number_format($s['a_Qty']) . '</td>
                    <td align="right">' . number_format($s['val']) . '</td>
                </tr>';
                        }
                    }
                    if ($billMethod == 'B') {
                        $totCancelPC = '-';
                        $totCValue = '-';
                        $totAValue = '-';
                    }
                    ?>
                    <div class="clearfix">&nbsp;</div><br>
                    <div class="form-group">
                        <input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('attendance_table', 'Daily_Achievments')" value="Download Excel">
                    </div> 
                    <table id="attendance_table" class="table table-hover">	
                        <thead>
                            <!--
                        <th colspan="17" style="font-size: 20px; text-align: center;"> <?php
                            if (!empty($AreaDetails) && isset($AreaDetails)) {
                                echo $AreaDetails->area_name;
                            } else {
                                echo 'All';
                            }
                            ?> Area Actual Sales Data - <?= $cat_name->cat ?> Category <br>Date From <?= $DateRange ?></th>
                            -->
                             <tr>
                                    <th colspan="17" style="font-size: 20px; text-align: center;"><?= $ReportTitle ?></th>
                                </tr>
                        </thead>
                        <thead>						
                            <tr>	
                                <th colspan="1">Item Code</th>
                                <th colspan="2">Item Name</th> 
                                <th colspan="1">PC</th>
                                <th colspan="1">Quantity</th>
                                <th colspan="1">Value</th> 	
                            </tr>		
                        </thead>
                        <tbody>
                            <?php foreach ($SalesData as $print) { ?>
                                <tr>
                                    <td colspan="1" align="left"><?= $print['item'] ?></td> 
                                    <td colspan="2" align="left"><?= $print['des'] ?></td> 
                                    <td colspan="1" align="right"><?= $print['PC'] ?></td> 
                                    <td colspan="1" align="right"><?= number_format($print['a_Qty']) ?></td>                                 
                                    <td colspan="1" align="right"><?= number_format($print['val']) ?></td>
                                </tr>
                            <?php } ?>    			
                        </tbody> 					
                        <tfoot>
                            <tr>		 
                                <td colspan="6">&nbsp;</td> 
                            </tr>
                        </tfoot>  


                        <thead>						
                            <tr>
                                <th colspan="1">Territory</th>
                                <th colspan="1">Item Code</th>
                                <th colspan="1">Item Name</th> 
                                <th colspan="1">PC</th>
                                <th colspan="1">Quantity</th>
                                <th colspan="1">Value</th>
                            </tr>		
                        </thead>
                        <tbody>
                            <?= $strTerritorySummery ?>
                        </tbody>



                        <?php
                        if (!empty($SalesDataTerritory) && isset($SalesDataTerritory) && !empty($territoryID) && isset($territoryID) && $territoryID != 'null') {
                            ?>


                            <thead>						
                                <tr>	
                                    <th colspan="1">
                                        <?php
                                        if ($billMethod == 'B') {
                                            echo 'Booking';
                                        } elseif ($billMethod == 'A') {
                                            echo 'Actual';
                                        }
                                        ?> Date</th>
                                    <th colspan="1">Territory</th> 
                                    <th colspan="1">Total Bills</th> 
                                    <th colspan="1">Total PC</th> 
                                    <th colspan="1">Total Actual PC</th> 
                                    <th colspan="2">Booking Value (with Discount)</th> 
                                    <th colspan="1">Cancel Value</th>  
                                    <th colspan="1">Good Return</th>  
                                    <th colspan="1">Good Return %</th> 
                                    <th colspan="1">Market Return</th> 
                                    <th colspan="1">Market Return %</th> 
                                    <th colspan="1">Total Return</th> 
                                    <th colspan="1">Total Return %</th> 
                                    <th colspan="1">Total Discount</th> 
                                    <th colspan="2">Total Actual (with Discount)</th> 		
                                </tr>		
                            </thead>		
                            <tbody>	 
                                <?= $strDaySummery ?>        			
                            </tbody> 					


                            <tfoot>
                                <tr>		 
                                    <td colspan="18"></td> 
                                </tr>
                            </tfoot>
                            <?php
                            if (!empty($SalesDataDetails) && isset($SalesDataDetails)) {
                                ?>    
                                <thead>
                                    <tr>
                                        <td align="center">Invoice </td>
                                        <td colspan="5" align="left">Shop Name </td>
                                        <td align="center">Route</td>
                                        <td align="right">Booking </td>
                                        <td align="right">Cancel Value</td>
                                        <td align="right">Market Return</td>
                                        <td align="right">Good Return</td>
                                        <td align="right">Free issue Value</td>
                                        <td align="right">Discount</td>
                                        <td align="right">Bill Value</td>
                                        <td align="center">Booking Date</td>
                                        <td align="center">Actual Date</td>
                                        <td align="center"></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $olddte = '';
                                    foreach ($SalesDataDetails as $r) {
                                        if ($billMethod == 'B') {
                                            if ($olddte != $r['date_book']) {
                                                ?>
                                                <tr style="background-color: cornflowerblue; color: white; height:25px; vertical-align: middle;">
                                                    <td colspan="18" align="left"><?= $r['date_book'] ?></td>
                                                </tr>
                                                <?php
                                            }
                                        } elseif ($billMethod == 'A') {
                                            if ($olddte != $r['date_actual']) {
                                                ?>
                                                <tr style="background-color: cornflowerblue; color: white; height:25px; vertical-align: middle;">
                                                    <td colspan="18" align="left"><?= $r['date_actual'] ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <tr <?php
                                        if ($r['tot_a_val'] == 0) {
                                            echo 'style="background:#ff9898;"';
                                        }
                                        ?> >
                                            <td align="center"><?= $r['invno'] ?></td>
                                            <td colspan="5" align="left"><?= $r['sh_name'] ?></td>
                                            <td align="center"><?= $r['ro'] ?></td>
                                            <td align="right"><?= $r['tot_b_val'] ?></td>
                                            <td align="right"><?= $r['tot_c_val'] ?></td>
                                            <td align="right"><?= $r['tot_m_val'] ?></td>
                                            <td align="right"><?= $r['tot_g_val'] ?></td>
                                            <td align="right"><?= $r['tot_f_val'] ?></td>
                                            <td align="right"><?= $r['tot_dis'] ?></td>
                                            <td align="right"><?= $r['tot_a_val'] ?></td>
                                            <td align="center"><?= $r['date_book'] ?></td>
                                            <td align="center"><?= $r['date_actual'] ?></td>
                                            <td align="center"><a href="#" onclick="view_invoice_old('<?= $r['invno'] ?>'); return false;" style="cursor: pointer;">View</a></td>
                                        </tr>
                                        <?php
                                        if ($billMethod == 'B') {
                                            $olddte = $r["date_book"];
                                        } elseif ($billMethod == 'A') {
                                            $olddte = $r["date_actual"];
                                        }
                                    }
                                    ?>
                                </tbody>

                                <?php
                            }//if end SalesDataDetails
                            ?>
                            <?php
                        }//if end SalesDataDetails
                        ?>
                    </table>

                    <?php
                    if (!empty($SalesDataTerritoryPivot) && isset($SalesDataTerritoryPivot)) {
                        //print_r($SalesDataTerritoryPivot['data']);
                        ?>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <?php
                                    foreach ($SalesDataTerritoryPivot['data_fields'] as $key) {
                                        echo '<th>' . $key . '</th>';
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($SalesDataTerritoryPivot['data'] as $row) {
                                    echo '<tr>';
                                    foreach ($SalesDataTerritoryPivot['data_fields'] as $key) {
                                        echo '<td>' . $row[$key] . '</td>';
                                    }
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php
                    }
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