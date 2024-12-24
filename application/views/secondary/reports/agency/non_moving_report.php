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
                <form class="form-horizontal" id="" action="<?= base_url('salesreports/nonMovingReport') ?>" method="post">
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-2">Category <span class="text-red">*</span></label>
                            <div class="col-md-6">
                                <select id="cat" name="cat" class="form-control">
                                    <option value=""> -- Select Category -- </option>    
                                    <?php
                                    foreach ($cat as $c) {
                                        $select = '';
                                        if (!empty($cat) && isset($cat) && $cat == $c['cat']) {
                                            $select = 'selected';
                                        }
                                        echo '<option ' . $select . ' value="' . $c['cat'] . '"> ' . $c['cat'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>                            
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-2">Item <span class="text-red">*</span></label>
                            <div class="col-md-6">
                                <select id="des" name="des" class="form-control">
                                    <option value="">-- Select Item --</option>
                                    <?php
                                    foreach ($des as $i) {
                                        $select = '';
                                        if (!empty($des) && isset($des) && $des == $i['des']) {
                                            $select = 'selected';
                                        }
                                        echo '<option ' . $select . ' value="' . $i['des'] . '"> ' . $i['des'] . '</option>';
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
                </form>
                <?php
                if (!empty($SalesData) && isset($SalesData)) {
                    $item = 0;
                    $des = 0;
                    $actualQty = 0;
                    $actualVal = 0;
                /* $totAPCs = 0;
                    $totCValue=0;
                    $totGValue=0;
                    $totMValue=0;
                    $totAValue = 0;
                    $totDValue = 0;
                    $strDaySummery = ''; */
                    foreach ($SalesData as $s) {
                        $item = $s['item'];
                        $des = $s['des'];
                        $actualQty = $s['actualQty'];
                        $actualVal = $s['actualVal'];
                        /* $totCancelPC = $totCancelPC + $s['totCancelPC'];
                        $totCValue= $totCValue + $s['totCval'];
                        $totGValue= $totGValue + $s['totGval'];
                        $totMValue= $totMValue + $s['totMval'];
                        $totDValue=$totDValue+ $s['totDisval'];
                        $totAValue= $totAValue + $s['totAval'] + $s['totDisval'];
                        $dateBill=''; 
                        if($billMethod=='B'){
                            $dateBill=$s['date_book'];                          
                        }elseif($billMethod=='A'){
                            $dateBill=$s['date_actual'];  */                        
                        }
                        $strDaySummery .= '<tr>'
                               /* . '<td  colspan="2">' . $dateBill . '</td>' */
                                . '<td colspan="1">' . $s['item'] . '</td>'
                                . '<td colspan="1">' . $s['des'] . '</td>'
                                . '<td colspan="1">' . $s['actualQty'] . '</td>'
                                . '<td colspan="2">' . $s['actualVal'] . '</td>'
                            /*    . '<td colspan="1">' . $s['totCval'] . '</td>'
                                . '<td colspan="1">' . $s['totGval'] . '</td>'
                                . '<td colspan="1">' . $s['totMval'] . '</td>'
                                . '<td colspan="1">' . $s['totDisval'] . '</td>'
                                . '<td colspan="2">' .($s['totAval']+$s['totDisval']) . '</td>' */
                                . '</tr>';
                    }
                    /* if($billMethod=='B'){
                        $totCancelPC='-';
                        $totCValue='-';
                        $totAValue='-';
                    } */
                    ?>
                    <div class="form-group">
                        <input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('achievement_sum', 'achievement_sum')" value="Download Excel">
                    </div> 
                    <table id="attendance_table" class="table table-hover">	
                        <thead>						
                            <tr>	
                                <th colspan="2">Item Code</th>
                                <th colspan="1">Item Description</th> 
                                <th colspan="1">Actual Quantity</th>
                                <th colspan="2">Actual Value</th>
                                <!-- <th colspan="1">Total Cancel PC</th> 	
                                <th colspan="1">Total Cancel Value</th> 
                                <th colspan="1">Total Good Return Value</th> 
                                <th colspan="1">Total Market Return Value</th> 
                                <th colspan="1">Total Discount Value</th> 
                                <th colspan="2">Total Actual Value (with Discount)</th> -->	
                            </tr>		
                        </thead>		
                        <tbody>
                        <?php foreach($SalesData as $print) { ?>
                                    <tr>
                                    <td colspan="1"><?= $item ?></td> 
                                <td colspan="1"><?= $des ?></td> 
                                <td colspan="1"><?= $actualQty ?></td> 
                                <td colspan="1"><?= $actualVal ?></td>  
                                </tr>
                                    <?php } ?>	 
                            <tr>		 
                              <!--  <td colspan="2"><?= $item ?></td> 
                                <td colspan="1"><?= $des ?></td> 
                                <td colspan="1"><?= $actualQty ?></td> 
                                <td colspan="2"><?= $actualVal ?></td>                                 
                                <td colspan="1"><?= $totCancelPC ?></td>
                                <td colspan="1"><?= $totCValue ?></td>
                                <td colspan="1"><?= $totGValue ?></td>
                                <td colspan="1"><?= $totMValue ?></td>
                                <td colspan="1"><?= $totDValue ?></td>
                                <td colspan="2"><?= $totAValue ?></td> 	 -->
                            </tr>          			
                        </tbody> 					
                        <tfoot>
                            <tr>		 
                                <td colspan="13">&nbsp;</td> 
                            </tr>
                        </tfoot>  
                        
                       <!-- <thead>						
                            <tr>	
                                <th colspan="2"><?php if($billMethod=='B'){echo 'Booking';}elseif($billMethod=='A'){echo 'Actual';}?> Date</th>
                                <th colspan="1">Total Bills</th> 
                                <th colspan="1">Total PC</th> 
                                <th colspan="1">Total Actual PC</th> 
                                <th colspan="2">Booking Value</th> 
                                <th colspan="1">Cancel Value</th>  
                                <th colspan="1">Good Return</th> 
                                <th colspan="1">Market Return</th> 
                                <th colspan="1">Total Discount</th> 
                                <th colspan="2">Total Actual (with Discount)</th> 		
                            </tr>		
                        </thead>		
                        <tbody>	 
                            <?= $strDaySummery ?>        			
                        </tbody> 					
                     
                        				
                        <tfoot>
                            <tr>		 
                                <td colspan="13"></td> 
                            </tr>
                        </tfoot> 
                        
                        <thead>
                            <tr>
                                <td align="center">Invoice </td>
                                <td align="left">Shop Name </td>
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
                                if ($olddte != $r['date_book']) {
                                    ?>
                                    <tr style="background-color: cornflowerblue; color: white; height:25px; vertical-align: middle;">
                                        <td colspan="13" align="left"><?= $r['date_book'] ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                    <tr <?php if($r['tot_a_val']==0){echo 'style="background:#ff9898;"';} ?> >
                                    <td align="center"><?= $r['invno'] ?></td>
                                    <td align="left"><?= $r['sh_name'] ?></td>
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
                                $olddte = $r["date_book"];
                            }
                            ?>
                        </tbody> -->
                    </table>

                    <!--?php
                }
                ?-->



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