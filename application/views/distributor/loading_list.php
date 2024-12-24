<?php
/*
 * This system Licenced to Raigam Marketing Services (Pvt) Ltd. 
 * Developed By: Lakshitha Pradeep Karunarathna  * 
 * Company: Serving Cloud INC in association with MyOffers.lk  * 
 * Date Started: October 20, 2017  * 
 */
?>
<?php include_once BASEPATH . ('../application/views/template/leftsidebar.php'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Secondary Sales O/E Transactions
            <small>Review O/E Transactions </small>
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
                            <div class="form-group">
                                <label class="col-md-2">Territory<span class="text-red">*</span></label>
                                <div class="col-md-6">
                                    <select name="territory" class="form-control">
                                        <?php
                                        foreach ($TerritoryDataSet as $c) {
                                            echo '<option value="' . $c['id'] . '" name="post[user][territory][]"> ' . $c['territory_name'] . '</option> ';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2">Range<span class="text-red">*</span></label>
                                <div class="col-md-6">
                                    <?php
                                    foreach ($RangeDataSet as $c) {
                                        echo '<div class="col-md-12"><input type="checkbox"  value="' . $c['id'] . '" name="post[user][range][]"> ' . $c['range_name'] . '</div>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2">Option<span class="text-red">*</span></label>
                                <div class="col-md-6">
                                    <div class="col-md-6">
                                        <input type="checkbox" name="post[user][option][]" value="B"> B
                                        <br>
                                        <input type="checkbox" name="post[user][option][]" value="A"> A
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-4"><input type="submit" class="btn btn-danger" name="submit"></div>
                            </div>						
                        </form>						
                        <div class="form-group">							
                            <input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('table-area', 'Outlets')" value="Excel">				
                        </div>
                    </div>

                    <?php
                    if (!empty($Range) && isset($Range)) {

                        foreach ($Range as $ran) {

                            $check = '';

                            if (!empty($ReportToData) && isset($ReportToData)) {

                                foreach ($ReportToData as $AlreadyReportTo) {

                                    if ($ran['id'] == $AlreadyReportTo['report_to_id']) {

                                        $check = 'checked="checked"';
                                    }
                                }
                            }

                            echo '<label class="col-md-6"><input type="checkbox" ' . $check . ' name="range[reportTo][]" value="' . $ran['id'] . '" /> ' . $ran['range_name'] . '</label>';
                        }
                    }
                    ?>
                    <?php
                    if (!empty($Option) && isset($Option)) {

                        foreach ($Option as $opt) {

                            $check = '';

                            if (!empty($ReportToData) && isset($ReportToData)) {

                                foreach ($ReportToData as $AlreadyReportTo) {

                                    if ($opt['inv_type'] == $AlreadyReportTo['report_to_inv_type']) {

                                        $check = 'checked="checked"';
                                    }
                                }
                            }

                            echo '<label class="col-md-6"><input type="checkbox" ' . $check . ' name="option[reportTo][]" value="' . $opt['id'] . '" /> ' . $opt['inv_type'] . '</label>';
                        }
                    }
                    ?>
                    

                    <!--?php
                    $option ='option';
                    $a ='a';
                    $option = " inv_type LIKE ";
                    for ($a = 0; a < count($_POST['option']); $a++) {
                        if (isset($_POST['option'][$a])) {

                            $option .= ($option == "") ? "" : " OR option LIKE";
                            $option .= "'%" . $_POST['option'][$a] . "%'";
                        }
                    }

                    $query = mysql_query("SELECT * FROM tbl_trans_order_h WHERE $option ");
                    while ($fetch = mysql_fetch_assoc($query)) {
                        //fetch a schools data
                    }
                    ?-->

                    <!--?php
                    if (!empty($Option) && isset($Option)) {

                        foreach ($Option as $opt) {

                            $check = '';

                            if (!empty($ReportToData) && isset($ReportToData)) {

                                foreach ($ReportToData as $AlreadyReportTo) {

                                    if ($opt['id'] == $AlreadyReportTo['report_to_id']) {

                                        $check = 'checked="checked"';
                                    }
                                }
                            }

                            echo '<label class="col-md-6"><input type="checkbox" ' . $check . ' name="option[reportTo][]" value="' . $opt['id'] . '" /> ' . $opt['range_name'] . '</label>';
                        }
                    }
                    ?-->

<?php
$report_type = 'summery';
if (!empty($LoadingList) && isset($LoadingList) && !empty($report_type) && isset($report_type)) {
    if ($report_type == 'detail') {
        $subtotal = 0;
        $header_discount_value = 0;
        $total_discount_value = 0;
        $header_gr_value = 0;
        $header_mr_value = 0;
        $header_net_value = 0;
        ?>
                            <table id="table-area" class="table table-hover">
                                <thead>
                                    <tr>						
                                        <th>GPS</th> 
                                        <th>Inv Date</th>
                                        <!-- <th>Inv Time</th> -->
                                        <th>APP Invoice No</th>
                                        <!-- <th>Bill Name</th> -->
                                        <th>Agency Code</th>
                                        <th>Route Code</th>
                                        <th>Shop Code</th>
                                        <!-- <th>System Shop ID</th> -->
                                        <!-- <th>Address 1</th> -->
                                        <!-- <th>Address 2</th> -->
                                        <!-- <th>Address 3</th> -->
                                        <!-- <th>Contact Person</th> -->
                                        <!-- <th>Mobile</th> -->
                                        <th>Item Code</th>
                                        <th>Item Name</th>
                                        <th>UOM</th>
                                        <th>Price</th>
                                        <th>Adjusted Price</th>
                                        <th>Booking Qty</th>
                                        <th>GR Qty</th>
                                        <th>GR Free Qty</th>
                                        <th>MR Qty</th>
                                        <th>MR Free Qty</th>
                                        <th>Free Qty</th>
                                        <th>Actual Qty</th>
                                        <th>GR Price</th>
                                        <th>MR Price</th>
                                        <th>Special Discount (Per Unit Rs.)</th>
                                        <th>Line Discount (%)</th>
                                        <th>Line Discount (Rs.)</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Booking/Actual</th>
                                    </tr>
                                </thead>
                                <tbody>
        <?php
        foreach ($LoadingList as $h) {
            $subtotal = $subtotal + $h['subtotal'];
            $header_discount_value = $header_discount_value + $h['header_discount_value'];
            $total_discount_value = $total_discount_value + $h['total_discount_value'];
            $header_gr_value = $header_gr_value + $h['header_gr_value'];
            $header_mr_value = $header_mr_value + $h['header_mr_value'];
            $header_net_value = $header_net_value + $h['header_net_value'];
            ?>

                                        <tr onclick="view_invoice('<?= $h['app_inv_no'] ?>')" style="cursor: pointer;">
                                            <td><a target="_blank" href="https://www.google.com/maps/search/?api=1&query=<?= $h['latitude'] ?>,<?= $h['longitude'] ?>">GPS</a></td> 
                                            <td><?= $h['inv_date'] ?></td>
                                            <!-- <td><?= $h['inv_time'] ?></td> -->
                                            <td><?= $h['app_inv_no'] ?></td>
                                            <!-- <td><?= $h['bill_name'] ?></td> -->
                                            <td><?= $h['territory_code'] ?></td>
                                            <td><?= $h['route_code'] ?></td>
                                            <td><?= $h['shop_code'] ?></td>
                                            <!-- <td><?= $h['customer_id'] ?></td> -->
                                            <!-- <td><?= $h['address1'] ?></td> -->
                                            <!-- <td><?= $h['address2'] ?></td> -->
                                            <!-- <td><?= $h['address3'] ?></td> -->
                                            <!-- <td><?= $h['contact_person'] ?></td> -->
                                            <!-- <td><?= $h['mobile'] ?></td> -->
                                            <td><?= $h['item_code'] ?></td>
                                            <td><?= $h['item_desc'] ?></td>
                                            <td><?= $h['uom'] ?></td>
                                            <td><?= $h['unit_price'] ?></td>
                                            <td><?= $h['adjusted_unit_price'] ?></td>
                                            <td><?= $h['booking_qty'] ?></td>
                                            <td><?= $h['gr_qty'] ?></td>
                                            <td><?= $h['gr_free_qty'] ?></td>
                                            <td><?= $h['mr_qty'] ?></td>
                                            <td><?= $h['mr_free_qty'] ?></td>
                                            <td><?= $h['fr_qty'] ?></td>
                                            <td><?= $h['actual_qty'] ?></td>
                                            <td><?= $h['gr_price'] ?></td>
                                            <td><?= $h['mr_price'] ?></td>
                                            <td><?= $h['special_discount'] ?></td>
                                            <td><?= $h['dis_per'] ?></td>
                                            <td><?= $h['dis_value'] ?></td>
                                            <td><?= $h['invoice_category'] ?></td>
                                            <td><?= $h['inv_status'] ?></td>
                                            <td><?= $h['inv_type'] ?></td>
                                        </tr>
            <?php
        }
        ?>
                                </tbody>
                                <tfoot> 

                                </tfoot>
                            </table>
        <?php
    } elseif ($report_type == 'summery') {
        ?>
                            <table id="table-area" class="table table-hover">
                                <thead>
                                    <tr> 
                                        <th>Item Code</th>
                                        <th>Item Name</th>
                                        <th>UOM</th>
                                        <th>Booking Qty</th>
                                        <th>GR Qty</th>
                                        <th>GR Free Qty</th>
                                        <th>MR Qty</th>
                                        <th>MR Free Qty</th>
                                        <th>Free Qty</th>
                                        <th>Actual Qty</th>
                                        <th>GR Value</th>
                                        <th>MR Value</th>
                                        <th>Subtotal</th>
                                        <th>Line Discount (Rs.)</th>
                                        <th>Net Value</th>										
                                    </tr>
                                </thead>
                                <tbody>
        <?php
        $grTot = 0;
        $mrTot = 0;
        $subtot = 0;
        $distot = 0;
        $netTot = 0;
        foreach ($LoadingList as $h) {
            $grTot = $grTot + $h['gr_total'];
            $mrTot = $mrTot + $h['mr_total'];
            $subtot = $subtot + $h['d_subtotal'];
            $distot = $distot + $h['line_discount'];
            $netTot = $netTot + $h['total'];
            ?>

                                        <tr style="cursor: pointer;">

                                            <td><?= $h['item_code'] ?></td>
                                            <td><?= $h['item_desc'] ?></td>
                                            <td><?= $h['uom'] ?></td>
                                            <td style="text-align:right;"><?= $h['booking_qty'] ?></td>
                                            <td style="text-align:right;"><?= $h['gr_qty'] ?></td>
                                            <td style="text-align:right;"><?= $h['gr_free_qty'] ?></td>
                                            <td style="text-align:right;"><?= $h['mr_qty'] ?></td>
                                            <td style="text-align:right;"><?= $h['mr_free_qty'] ?></td>
                                            <td style="text-align:right;"><?= $h['fr_qty'] ?></td>													
                                            <td style="text-align:right;"><?= $h['actual_qty'] ?></td>
                                            <td style="text-align:right;"><?= sprintf('%0.2f', $h['gr_total']) ?></td>
                                            <td style="text-align:right;"><?= sprintf('%0.2f', $h['mr_total']) ?></td>
                                            <td style="text-align:right;"><?= sprintf('%0.2f', $h['d_subtotal']) ?></td>
                                            <td style="text-align:right;"><?= sprintf('%0.2f', $h['line_discount']) ?></td>
                                            <td style="text-align:right;"><?= sprintf('%0.2f', $h['total']) ?></td>


                                        </tr>
            <?php
        }
        ?>
                                </tbody>
                                <tfoot> 
                                    <tr> 
                                        <th colspan="10">Totals</th> 
                                        <th style="text-align:right;"><?= number_format($grTot, 2, '.', ',') ?></th>
                                        <th style="text-align:right;"><?= number_format($mrTot, 2, '.', ',') ?></th>
                                        <th style="text-align:right;"><?= number_format($subtot, 2, '.', ',') ?></th>
                                        <th style="text-align:right;"><?= number_format($distot, 2, '.', ',') ?></th>
                                        <th style="text-align:right;"><?= number_format($netTot, 2, '.', ',') ?></th>										
                                    </tr>
                                </tfoot>
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