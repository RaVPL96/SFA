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
            <div class="col-md-12">
                <div id="successMessage" class="hideDiv">Updated Successfully! </div>
                <div id="errorMessage" class="hideDiv">Invalid Data! Please Try Again. </div>
                <div class="keepgap"></div> 
                <form class="form-horizontal" id="" action="<?= base_url('salesreports/getFreeIssueRecon') ?>" method="post">
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
                            <label class="col-md-2">Report Type <span class="text-red">*</span></label>
                            <div class="col-md-6">
                                <select id="sbRange" name="rptMethod" class="form-control">
                                    <option value="-1"> -- Select One -- </option>    
                                    <option value="I">Item-wise</option>
                                    <option value="C">Free Issue Catgory - wise</option>
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
            </div>
            <div class="col-md-12" style="overflow-x: scroll;">
                <?php
                if (!empty($ItemData) && isset($ItemData) && $rptMethod == 'I') {
                    $CurrentItem = '';
                    $CurrentItemCode = '';
                    $CurrentItemDes = '';
                    $strTable = '';
                    $count = 1;
                    foreach ($ItemData as $i) {//go items list line by line
                        if ($CurrentItem == '') {
                            $CurrentItem = $i['item'];
                            $CurrentItemCode = $i['item_code'];
                            $CurrentItemDes = $i['des'];
                        }
                        $CurrentItem = $i['item'];
                        $CurrentItemCode = $i['item_code'];
                        $CurrentItemDes = $i['des'];
                        $totActualQty = 0;
                        $totFreeQtyNotInPromotion = 0;
                        $totFreeValNotInPromotion = 0;
                        $totFreeQtyInPromotion = 0;
                        $totFreeValInPromotion = 0;
                        foreach ($SalesData as $s) {//get current item sales data                            
                            if ($CurrentItem == $s['item']) {
                                $totActualQty = $totActualQty + floatval($s['a_Qty']);
                                $inPromo = 0;
                                foreach ($FreeRange as $f) {//check item in promo date
                                    if ($CurrentItem == $f['item'] && $s['date_book'] >= $f['date_from'] && $s['date_book'] <= $f['date_to']) {//check item in promo date
                                        $inPromo = 1;
                                    }
                                }
                                if ($inPromo == 1) {
                                    $totFreeQtyInPromotion = $totFreeQtyInPromotion + floatval($s['f_qty']);
                                    $totFreeValInPromotion = $totFreeValInPromotion + floatval($s['f_qty'] * $s['up']);
                                } else {
                                    $totFreeQtyNotInPromotion = $totFreeQtyNotInPromotion + floatval($s['f_qty']);
                                    $totFreeValNotInPromotion = $totFreeValNotInPromotion + floatval($s['f_qty'] * $s['up']);
                                }
                            }
                        }//all item read in sales data - lets print
                        $strTable .= '<tr>'
                                . '<td>' . $CurrentItem . '</td>'
                                . '<td>' . $CurrentItemCode . '</td>'
                                . '<td>' . $CurrentItemDes . '</td>'
                                . '<td align="right">' . $totFreeQtyInPromotion . '</td>'
                                . '<td align="right">' . number_format($totFreeValInPromotion, 2) . '</td>'
                                . '<td align="right">' . $totFreeQtyNotInPromotion . '</td>'
                                . '<td align="right">' . number_format($totFreeValNotInPromotion, 2) . '</td>'
                                . '<td align="right">' . ($totFreeQtyInPromotion + $totFreeQtyNotInPromotion) . '</td>'
                                . '<td align="right">' . number_format(($totFreeValInPromotion + $totFreeValNotInPromotion), 2) . '</td>'
                                . '<td align="right">' . $totActualQty . '</td>'
                                . '</tr>';
                        if ($count == 1) {
                            //break;
                        }
                        $count += 1;
                    }
                    ?>
                    <div class="form-group">
                        <input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('attendance_table', 'Daily_Achievments')" value="Download Excel">
                    </div> 
                    <table id="attendance_table" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>ERP Code</th>
                                <th>Name</th> 
                                <th>Free Issue Qty in Promo</th>
                                <th>Free Issue Value in Promo</th>
                                <th>Normal Free Issue Qty</th>
                                <th>Normal Free Issue Value</th>
                                <th>Total Free Qty</th>
                                <th>Total Free Value</th>
                                <th>Total Actual Qty</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?= $strTable ?>
                        </tbody>
                    </table> 

                    <?php
                }
                ?>


                <?php
                if (!empty($FreeCategoryData) && isset($FreeCategoryData) && $rptMethod == 'C') {
                    $CurrentItem = '';
                    $CurrentItemCode = '';
                    $CurrentItemDes = '';
                    $strTable = '';
                    $count = 1;

                    $RM = 0;
                    $DLS = 0;
                    $WS = 0;
                    $WC = 0;

                    foreach ($FreeCategoryData as $i) {//go items list line by line
                        if ($CurrentItem == '') {
                            $CurrentItem = $i['free_cat'];
                            $CurrentItemCode = $i['free_cat'];
                            $CurrentItemDes = $i['free_cat'];
                        }
                        $CurrentItem = trim($i['free_cat']);
                        //echo '<br>';
                        $CurrentItemCode = trim($i['free_cat']);
                        $CurrentItemDes = trim($i['free_cat']);
                        $totActualQty = 0;
                        $totActualQtyInPromo = 0;
                        $totActualQtyNotInPromo = 0;
                        $totFreeQtyNotInPromotion = 0;
                        $totFreeValNotInPromotion = 0;
                        $totFreeQtyInPromotion = 0;
                        $totFreeValInPromotion = 0;
                        foreach ($SalesData as $s) {//get current item sales data   
                            //echo $s['free_cat'];echo '<br>-----';
                            if ($CurrentItem == trim($s['free_cat'])) {                                
                                $totActualQty = $totActualQty + floatval($s['ActualValue']);
                                $inPromo = 0;
                                //echo $s['date_book'].'-'.$CurrentItem .'-'.$f['free_cat'].'<br>';
                                foreach ($FreeRange as $f) {//check item in promo date   
                                    
                                    if ($CurrentItem == trim($f['free_cat'])) {                                         
                                        if ($s['date_book'] >= $f['date_from'] && $s['date_book'] <= $f['date_to']) {//check item in promo date
                                            $inPromo = 1;
                                        }
                                    } else {
                                        //echo $s['date_book'].'-'.$f['date_from'].'<br>';
                                    }
                                }

                                if ($inPromo == 1) {
                                    $totActualQtyInPromo = $totActualQtyInPromo + floatval($s['a_Qty']);
                                    $totFreeQtyInPromotion = $totFreeQtyInPromotion + floatval($s['f_qty']);
                                    $totFreeValInPromotion = $totFreeValInPromotion + floatval($s['FreeValue']);
                                } else {
                                    $totActualQtyNotInPromo = $totActualQtyNotInPromo + floatval($s['a_Qty']);
                                    $totFreeQtyNotInPromotion = $totFreeQtyNotInPromotion + floatval($s['f_qty']);
                                    $totFreeValNotInPromotion = $totFreeValNotInPromotion + floatval($s['FreeValue']);
                                }

                                if ($i['company'] == 'RM') {
                                    $RM = $RM + floatval($s['FreeValue']);
                                } elseif ($i['company'] == 'DLS') {
                                    $DLS = $DLS + floatval($s['FreeValue']);
                                } elseif ($i['company'] == 'WS') {
                                    $WS = $WS + floatval($s['FreeValue']);
                                } elseif ($i['company'] == 'WC') {
                                    $WC = $WC + floatval($s['FreeValue']);
                                }
                            }
                        }//all item read in sales data - lets print
                        $strTable .= '<tr>'
                                . '<td style="display:none;">' . $CurrentItem . '</td>'
                                . '<td style="display:none;">' . $CurrentItemCode . '</td>'
                                . '<td>' . $CurrentItemDes . '</td>'
                                . '<td align="right">' . $totActualQtyInPromo . '</td>'
                                . '<td align="right">' . $totFreeQtyInPromotion . '</td>'
                                . '<td align="right">' . number_format($totFreeValInPromotion, 2) . '</td>'
                                . '<td align="right">' . $totActualQtyNotInPromo . '</td>'
                                . '<td align="right">' . $totFreeQtyNotInPromotion . '</td>'
                                . '<td align="right">' . number_format($totFreeValNotInPromotion, 2) . '</td>'
                                . '<td align="right">' . ($totFreeQtyInPromotion + $totFreeQtyNotInPromotion) . '</td>'
                                . '<td align="right">' . number_format(($totFreeValInPromotion + $totFreeValNotInPromotion), 2) . '</td>'
                                . '<td align="right">' . $totActualQty . '</td>'
                                . '</tr>';
                        if ($count == 1) {
                            //break;
                        }
                        $count += 1;
                    }
                    ?>
                    <div class="form-group">
                        <input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('attendance_table', 'Daily_Achievments')" value="Download Excel">
                    </div> 
                    <table id="attendance_table" class="table table-hover">
                        <thead>
                            <tr>
                                <th style="display:none;">Item</th>
                                <th style="display:none;">ERP Code</th>
                                <th>Name</th>  
                                <th>Actual Qty in Promo</th>
                                <th>Free Issue Qty in Promo</th>
                                <th>Free Issue Value in Promo</th>
                                <th>Normal Actual Qty</th>
                                <th>Normal Free Issue Qty</th>
                                <th>Normal Free Issue Value</th>
                                <th>Total Free Qty</th>
                                <th>Total Free Value</th>
                                <th>Total Actual Qty</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?= $strTable ?>
                        </tbody>
                        <tfoot style="font-size: 20px; font-weight: bold;">
                            <tr>
                                <td colspan="9">Raigam</td>
                                <td colspan="1" class="text-right"><?= number_format($RM, 2) ?></td> 
                            </tr>
                            <tr>
                                <td colspan="9">WS</td>
                                <td colspan="1" class="text-right"><?= number_format($WS, 2) ?></td>
                            </tr>
                            <tr>                                 
                                <td colspan="9">DLS</td>
                                <td colspan="1" class="text-right"><?= number_format($DLS, 2) ?></td>
                            </tr>
                            <tr>                                 
                                <td colspan="9">WC</td>
                                <td colspan="1" class="text-right"><?= number_format($WC, 2) ?></td>
                            </tr>
                            <tr>
                                <td colspan="9">Total</td>
                                <td colspan="1" class="text-right"><?= number_format($RM + $WS + $DLS + $WC, 2) ?></td> 
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