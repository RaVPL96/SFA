<?php include_once BASEPATH . ('../application/views/template/leftsidebar.php'); ?>

<div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

        <h1>

            Loading List

            <small>Secondary Sales O/E Transactions </small>

        </h1>

        <ol class="breadcrumb">

            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

            <li class="active">Secondary Sales Order Entry Module</li>

        </ol>

    </section>



    <!-- Main content -->

    <section class="content">

        <div class="row">

            <div class="col-md-12">

                <div id="successMessage" class="hideDiv">Updated Successfully! </div>

                <div id="errorMessage" class="hideDiv">Invalid Data! Please Try Again. </div>

                <div class="keepgap"></div> 

                <div class="row" style="overflow-x: scroll;">
                    <div class="col-md-12">
                        <form class="form-horizontal" id="OrderData" action="<?= base_url('Salesoetransaction/LoadingList') ?>" method="post" novalidate="novalidate">
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
                                            <option value="-1"> -- Select Range -- </option>    
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
                                    <label class="col-md-2">Date Range <span class="text-red">*</span></label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" name="DateRange" class="form-control pull-right active" readonly="" id="reservation" value="<?= $DateRange ?>">
                                        </div><!-- /.input group -->
                                    </div><!-- /.form group -->	
                                    <div class="col-md-4"><input type="submit" class="btn btn-danger" id="excel" name="excel"></div>
                                </div>
                            </div>
                           
                        </form>
                        <div class="form-group">
                            <input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('table-area', 'Outlets')" value="Excel">
                        </div>
                    </div>
                    <?php
                    if (!empty($ordersH) && isset($ordersH)) {
                        $subtotal = 0;
                        $header_discount_value = 0;
                        $total_discount_value = 0;
                        $header_gr_value = 0;
                        $header_mr_value = 0;
                        $header_net_value = 0;

                        $rows = '';
                        $billcount = 0;
                        $travalTime = 0;
                        $lastbillEndTime = '';
                        foreach ($ordersH as $h) {

                            $subtotal = $subtotal + $h['subtotal'];
                            $header_discount_value = $header_discount_value + $h['header_discount_value'];
                            $total_discount_value = $total_discount_value + $h['total_discount_value'];
                            $header_gr_value = $header_gr_value + $h['header_gr_value'];
                            $header_mr_value = $header_mr_value + $h['header_mr_value'];
                            $header_net_value = $header_net_value + $h['header_net_value'];
                            $billcount = $billcount + 1;
                            $rows = $rows . '<tr onclick="view_invoice(\'' . $h['app_inv_no'] . '\')" style="cursor: pointer;">
									<td><a target="_blank" href="https://www.google.com/maps/search/?api=1&query=' . $h['latitude'] . ',' . $h['longitude'] . '">GPS</a></td> 
									<td>' . $h['app_inv_no'] . '</td>
									<td>' . $h['bill_name'] . '</td>
									<td>' . $h['territory_code'] . '</td>
									<td>' . $h['route_code'] . '</td>
									<td>' . $h['outlet_code'] . '</td>
									<td>' . $h['shop_code'] . '</td>
									<td>' . $h['customer_id'] . '</td>
									<td>' . $h['address1'] . '</td>
									<td>' . $h['address2'] . '</td>
									<td>' . $h['address3'] . '</td>
									<td>' . $h['contact_person'] . '</td>
									<td>' . $h['mobile'] . '</td>
									<td>' . $h['subtotal'] . '</td>
									<td>' . $h['header_discount'] . '</td>
									<td>' . $h['header_discount_value'] . '</td>
									<td>' . $h['total_discount_value'] . '</td>
									<td>' . $h['header_gr_value'] . '</td>
									<td>' . $h['header_mr_value'] . '</td>
									<td>' . $h['header_net_value'] . '</td>
									<td>' . $h['invoice_category'] . '</td>
									<td>' . $h['inv_status'] . '</td>
									<td>' . $h['inv_type'] . '</td>
									<td>' . $h['inv_date'] . '</td>
									<td>' . $h['inv_start_time'] . '</td>
									<td>' . $h['inv_time'] . '</td>
									<td>' . intval(abs(strtotime($h['inv_date'] . ' ' . $h['inv_time']) - strtotime($h['inv_date'] . ' ' . $h['inv_start_time'])) / 60) . '</td>
									<td>' . $h['audit_user'] . '</td>
								</tr>';
                        }
                        ?>
                        <div class="col-lg-6 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3><?= $billcount ?></h3>

                                    <p>Total Bills</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-shopping-cart"></i>
                                </div> 
                            </div>
                        </div>	
                        <div class="col-lg-6 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>Rs. <?= number_format($subtotal, 2) ?></h3>

                                    <p>Sub Total Value</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-shopping-cart"></i>
                                </div> 
                            </div>
                        </div>
                        <div class="col-lg-6 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>Rs. <?= number_format($header_discount_value, 2) ?></h3>

                                    <p>Total Discount Value</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-shopping-cart"></i>
                                </div> 
                            </div>
                        </div>
                        <div class="col-lg-6 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>Rs. <?= number_format($header_gr_value, 2) ?></h3>

                                    <p>Good Return Total Value</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-shopping-cart"></i>
                                </div> 
                            </div>
                        </div>
                        <div class="col-lg-6 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>Rs. <?= number_format($header_mr_value, 2) ?></h3>

                                    <p>Market Return Total Value</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-shopping-cart"></i>
                                </div> 
                            </div>
                        </div>
                        <div class="col-lg-6 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>Rs. <?= number_format($header_net_value, 2) ?></h3>

                                    <p>Net Total Value</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-shopping-cart"></i>
                                </div> 
                            </div>
                        </div>		
                        <table id="table-area" class="table table-hover">
                            <thead>
                                <tr>						
                                    <th>GPS</th> 
                                    <th>APP Invoice No</th>
                                    <th>Bill Name</th>
                                    <th>Agency Code</th>
                                    <th>Route Code</th>
                                    <th>Shop Code</th>
                                    <th>Old Sys ID</th>
                                    <th>System Shop ID</th>
                                    <th>Address 1</th>
                                    <th>Address 2</th>
                                    <th>Address 3</th>
                                    <th>Contact Person</th>
                                    <th>Mobile</th>
                                    <th>Subtotal</th>
                                    <th>Header Discount %</th>
                                    <th>Header Discount Rs.</th>
                                    <th>Total Discount</th>
                                    <th>GR Value</th>
                                    <th>MR Value</th>
                                    <th>Net Value</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Booking/Actual</th>
                                    <th>Inv Date</th>
                                    <th>Inv Start Time</th>
                                    <th>Inv End Time</th>
                                    <th>Call Duration (Min)</th> 
                                    <th>Audit User</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?= $rows ?>


                            </tbody>
                            <tfoot>
                                <tr>
                                    <td> </td> 
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td>Total Bills <?= $billcount ?> </td>
                                    <td><?= sprintf('%0.2f', $subtotal) ?></td>
                                    <td> </td>
                                    <td><?= sprintf('%0.2f', $header_discount_value) ?></td>
                                    <td><?= sprintf('%0.2f', $total_discount_value) ?></td>
                                    <td><?= sprintf('%0.2f', $header_gr_value) ?></td>
                                    <td><?= sprintf('%0.2f', $header_mr_value) ?></td>
                                    <td><?= sprintf('%0.2f', $header_net_value) ?></td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                </tr>
                            </tfoot>
                        </table>
                        <?php
                    }
                    ?>
                </div>

            </div>



        </div>
    </section>
    <script>

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
    </script>
    <!-- /.content -->

</div><!-- /.content-wrapper -->

