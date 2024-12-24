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
                        <form class="form-horizontal" id="OrderData" action="<?= base_url('Salesoetransaction/invoiceItem') ?>" method="post" novalidate="novalidate">
                            <div class="col-md-6">       
                                <div class="form-group">  
                                    <label class="col-md-2">Area <span class="text-red">*</span></label>
                                    <div class="col-md-6"> 
                                        <select id="areaID" name="areaID" class="form-control">   
                                            <option value="-1"> -- Select Area -- </option>                                                <?php
                                            foreach ($AreaList as $a) {
                                                $select = '';
                                                if (!empty($AreaID) && isset($AreaID) && $a['id'] == $AreaID) {
                                                    $select = 'selected';
                                                } if ($sess['grade_id'] == 4) {
                                                    foreach ($ASE_Area as $ase) {
                                                        if ($ase['area_id'] == $a['id']) {
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
                                            if (!empty($territory) && isset($territory)) {
                                                foreach ($territory as $t) {
                                                    $select = '';
                                                    if (!empty($TerritoryID) && isset($TerritoryID) && $TerritoryID == $t['territory_id']) {
                                                        $select = 'selected';
                                                    } echo '<option ' . $select . ' value="' . $t['territory_id'] . '"> ' . $t['territory_name'] . '</option>';
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
                                            <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                                            <input type="text" name="DateRange" class="form-control pull-right active" readonly="" id="reservation" value="<?= $DateRange ?>"> </div>
                                        <!-- /.input group -->
                                    </div>
                                    <!-- /.form group -->
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

                                                if ($sess['grade_id'] == 4) {
                                                    foreach ($ASE_Area as $ase) {
                                                        if ($ase['range_id'] == $a['id']) {
                                                            echo '<option ' . $select . ' value="' . $a['id'] . '"> ' . $a['range_name'] . '</option>';
                                                        }
                                                    }
                                                } else {
                                                    echo '<option ' . $select . ' value="' . $a['id'] . '"> ' . $a['range_name'] . '</option>';
                                                }
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
                                        <select name="report_type" class="form-control">
                                            <option <?php
                                            if ($report_type == 'detail') {
                                                echo 'selected';
                                            }
                                            ?> value="detail">Item wise - Detail</option>
                                            <option <?php
                                            if ($report_type == 'summery') {
                                                echo 'selected';
                                            }
                                            ?> value="summery">Item wise - Summery</option>
                                            <option <?php
                                            if ($report_type == 'pcsummery') {
                                                echo 'selected';
                                            }
                                            ?> value="pcsummery">Item wise - Summery with PC</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">    
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <input type="submit" class="btn btn-danger" id="excel" name="excel"> </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php
                    if (!empty($ordersD) && isset($ordersD) && !empty($report_type) && isset($report_type)) {
                        if ($report_type == 'detail') {
                            $subtotal = 0;
                            $header_discount_value = 0;
                            $total_discount_value = 0;
                            $header_gr_value = 0;
                            $header_mr_value = 0;
                            $header_net_value = 0;
                            ?>


                            <div class="form-group">
                                <input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('attendance_table', '<?= $report_type.'-'. $DateRange ?>')" value="Download Excel">
                            </div>
                            <table id="attendance_table" class="table table-hover">
                                <thead>
                                       
                                <tr>
                                    <th colspan="26" style="font-size: 20px; text-align: center;"><?= $ReportTitle ?></th>
                                </tr>
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
                                    foreach ($ordersD as $h) {
                                        $subtotal = $subtotal + $h['subtotal'];
                                        $header_discount_value = $header_discount_value + $h['header_discount_value'];
                                        $total_discount_value = $total_discount_value + $h['total_discount_value'];
                                        $header_gr_value = $header_gr_value + $h['header_gr_value'];
                                        $header_mr_value = $header_mr_value + $h['header_mr_value'];
                                        $header_net_value = $header_net_value + $h['header_net_value'];
                                        ?>
                                        <tr onclick="view_invoice('<?= $h['app_inv_no'] ?>')" style="cursor: pointer;">
                                            <td><a target="_blank" href="https://www.google.com/maps/search/?api=1&query=<?= $h['latitude'] ?>,<?= $h['longitude'] ?>">GPS</a></td>
                                            <td>
                                                <?= $h['inv_date'] ?>
                                            </td>
                                            <!-- <td><?= $h['inv_time'] ?></td> -->
                                            <td>
                                                <?= $h['app_inv_no'] ?>
                                            </td>
                                            <!-- <td><?= $h['bill_name'] ?></td> -->
                                            <td>
                                                <?= $h['territory_code'] ?>
                                            </td>
                                            <td>
                                                <?= $h['route_code'] ?>
                                            </td>
                                            <td>
                                                <?= $h['shop_code'] ?>
                                            </td>
                                            <!-- <td><?= $h['customer_id'] ?></td> -->
                                            <!-- <td><?= $h['address1'] ?></td> -->
                                            <!-- <td><?= $h['address2'] ?></td> -->
                                            <!-- <td><?= $h['address3'] ?></td> -->
                                            <!-- <td><?= $h['contact_person'] ?></td> -->
                                            <!-- <td><?= $h['mobile'] ?></td> -->
                                            <td>
                                                <?= $h['item_code'] ?>
                                            </td>
                                            <td>
                                                <?= $h['item_desc'] ?>
                                            </td>
                                            <td>
                                                <?= $h['uom'] ?>
                                            </td>
                                            <td>
                                                <?= $h['unit_price'] ?>
                                            </td>
                                            <td>
                                                <?= $h['adjusted_unit_price'] ?>
                                            </td>
                                            <td>
                                                <?= $h['booking_qty'] ?>
                                            </td>
                                            <td>
                                                <?= $h['gr_qty'] ?>
                                            </td>
                                            <td>
                                                <?= $h['gr_free_qty'] ?>
                                            </td>
                                            <td>
                                                <?= $h['mr_qty'] ?>
                                            </td>
                                            <td>
                                                <?= $h['mr_free_qty'] ?>
                                            </td>
                                            <td>
                                                <?= $h['fr_qty'] ?>
                                            </td>
                                            <td>
                                                <?= $h['actual_qty'] ?>
                                            </td>
                                            <td>
                                                <?= $h['gr_price'] ?>
                                            </td>
                                            <td>
                                                <?= $h['mr_price'] ?>
                                            </td>
                                            <td>
                                                <?= $h['special_discount'] ?>
                                            </td>
                                            <td>
                                                <?= $h['dis_per'] ?>
                                            </td>
                                            <td>
                                                <?= $h['dis_value'] ?>
                                            </td>
                                            <td>
                                                <?= $h['invoice_category'] ?>
                                            </td>
                                            <td>
                                                <?= $h['inv_status'] ?>
                                            </td>
                                            <td>
                                                <?= $h['inv_type'] ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot> </tfoot>
                            </table>
                        <?php } elseif ($report_type == 'summery') { ?>

                            <div class="form-group">
                                <input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('attendance_table', 'Attendance_<?= $DateRange ?>')" value="Download Excel">
                            </div>
                            <table id="attendance_table" class="table table-hover">
                                <thead>
                                    
                                <tr>
                                    <th colspan="15" style="font-size: 20px; text-align: center;"><?= $ReportTitle ?></th>
                                </tr>
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
                                    foreach ($ordersD as $h) {
                                        $grTot = $grTot + $h['gr_total'];
                                        $mrTot = $mrTot + $h['mr_total'];
                                        $subtot = $subtot + $h['d_subtotal'];
                                        $distot = $distot + $h['line_discount'];
                                        $netTot = $netTot + $h['total'];
                                        ?>
                                        <tr style="cursor: pointer;">
                                            <td>
                                                <?= $h['item_code'] ?>
                                            </td>
                                            <td>
                                                <?= $h['item_desc'] ?>
                                            </td>
                                            <td>
                                                <?= $h['uom'] ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?= $h['booking_qty'] ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?= $h['gr_qty'] ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?= $h['gr_free_qty'] ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?= $h['mr_qty'] ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?= $h['mr_free_qty'] ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?= $h['fr_qty'] ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?= $h['actual_qty'] ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?= sprintf('%0.2f', $h['gr_total']) ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?= sprintf('%0.2f', $h['mr_total']) ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?= sprintf('%0.2f', $h['d_subtotal']) ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?= sprintf('%0.2f', $h['line_discount']) ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?= sprintf('%0.2f', $h['total']) ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="10">Totals</th>
                                        <th style="text-align:right;">
                                            <?= number_format($grTot, 2, '.', ',') ?>
                                        </th>
                                        <th style="text-align:right;">
                                            <?= number_format($mrTot, 2, '.', ',') ?>
                                        </th>
                                        <th style="text-align:right;">
                                            <?= number_format($subtot, 2, '.', ',') ?>
                                        </th>
                                        <th style="text-align:right;">
                                            <?= number_format($distot, 2, '.', ',') ?>
                                        </th>
                                        <th style="text-align:right;">
                                            <?= number_format($netTot, 2, '.', ',') ?>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                            <?php
                        } elseif ($report_type == 'pcsummery') {
                            ?>

                            <div class="form-group">
                                <input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('attendance_table', 'Attendance_<?= $DateRange ?>')" value="Download Excel">
                            </div>
                            <table id="attendance_table" class="table table-hover">
                                <thead>
                                    
                                <tr>
                                    <th colspan="16" style="font-size: 20px; text-align: center;"><?= $ReportTitle ?></th>
                                </tr>
                                    <tr>
                                        <th>Item Code</th>
                                        <th>Item Name</th>
                                        <th>UOM</th>
                                        <th>PC</th>
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
                                    foreach ($ordersD as $h) {
                                        $grTot = $grTot + $h['gr_total'];
                                        $mrTot = $mrTot + $h['mr_total'];
                                        $subtot = $subtot + $h['d_subtotal'];
                                        $distot = $distot + $h['line_discount'];
                                        $netTot = $netTot + $h['total'];
                                        ?>
                                        <tr style="cursor: pointer;">
                                            <td>
                                                <?= $h['item_code'] ?>
                                            </td>
                                            <td>
                                                <?= $h['item_desc'] ?>
                                            </td>
                                            <td>
                                                <?= $h['uom'] ?>
                                            </td>
                                            <td>
                                                <?= $h['PC'] ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?= $h['booking_qty'] ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?= $h['gr_qty'] ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?= $h['gr_free_qty'] ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?= $h['mr_qty'] ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?= $h['mr_free_qty'] ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?= $h['fr_qty'] ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?= $h['actual_qty'] ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?= sprintf('%0.2f', $h['gr_total']) ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?= sprintf('%0.2f', $h['mr_total']) ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?= sprintf('%0.2f', $h['d_subtotal']) ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?= sprintf('%0.2f', $h['line_discount']) ?>
                                            </td>
                                            <td style="text-align:right;">
                                                <?= sprintf('%0.2f', $h['total']) ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="11">Totals</th>
                                        <th style="text-align:right;">
                                            <?= number_format($grTot, 2, '.', ',') ?>
                                        </th>
                                        <th style="text-align:right;">
                                            <?= number_format($mrTot, 2, '.', ',') ?>
                                        </th>
                                        <th style="text-align:right;">
                                            <?= number_format($subtot, 2, '.', ',') ?>
                                        </th>
                                        <th style="text-align:right;">
                                            <?= number_format($distot, 2, '.', ',') ?>
                                        </th>
                                        <th style="text-align:right;">
                                            <?= number_format($netTot, 2, '.', ',') ?>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <!--			<div class="col-md-12">			 <script src="https://www.gstatic.com/external_hosted/jquery2.min.js"></script>			<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=geometry&key=AIzaSyDL5TFORfvAKrvixbuRLQWhqfNGLL8sFCY"></script>     <script>var line;var map;var pointDistances;function initialize() {  var mapOptions = {    center: new google.maps.LatLng(2.881766, 101.626877),    zoom: 20,    mapTypeId: google.maps.MapTypeId.ROADMAP  };  map = new google.maps.Map(document.getElementById('map'), mapOptions);  var lineCoordinates = [  <?php
            if (!empty($gps) && isset($gps)) {
                foreach ($gps as $g) {
                    echo 'new google.maps.LatLng(' . $g['latitude'] . ', ' . $g['longitude'] . '),';
                }
            }
            ?>    /*new google.maps.LatLng(2.86085, 101.6437),    new google.maps.LatLng(2.87165, 101.6362),    new google.maps.LatLng(2.880783, 101.6273),    new google.maps.LatLng(2.891517, 101.6201),    new google.maps.LatLng(2.8991, 101.6162),    new google.maps.LatLng(2.915067, 101.6079)*/  ];  map.setCenter(lineCoordinates[0]);  /* point distances from beginning in % */  var sphericalLib = google.maps.geometry.spherical;  pointDistances = [];  var pointZero = lineCoordinates[0];  var wholeDist = sphericalLib.computeDistanceBetween(    pointZero,    lineCoordinates[lineCoordinates.length - 1]);  for (var i = 0; i < lineCoordinates.length; i++) {    pointDistances[i] = 100 * sphericalLib.computeDistanceBetween(      lineCoordinates[i], pointZero) / wholeDist;    console.log('pointDistances[' + i + ']: ' + pointDistances[i]);  }  /* define polyline */  var lineSymbol = {    path: google.maps.SymbolPath.CIRCLE,    scale: 6,    strokeColor: '#393'  };  line = new google.maps.Polyline({    path: lineCoordinates,    strokeColor: '#FF0000',    strokeOpacity: 2.0,    strokeWeight: 5,    icons: [{      icon: lineSymbol,      offset: '100%'    }],    map: map  });  animateCircle();    drawBlueLine(map, lineSymbol);}var id;function animateCircle() {  var count = 0;  var offset;  var sentiel = -1;  id = window.setInterval(function() {    count = (count + 1) % 200;    offset = count / 2;    for (var i = pointDistances.length - 1; i > sentiel; i--) {      if (offset > pointDistances[i]) {        console.log('create marker');        var marker = new google.maps.Marker({          icon: {            url: "https://maps.gstatic.com/intl/en_us/mapfiles/markers2/measle_blue.png",            size: new google.maps.Size(7, 7),            anchor: new google.maps.Point(4, 4)          },          position: line.getPath().getAt(i),          title: line.getPath().getAt(i).toUrlValue(6),          map: map        });        sentiel++;        break;      }    }    /* we have only one icon */    var icons = line.get('icons');    icons[0].offset = (offset) + '%';    line.set('icons', icons);    if (line.get('icons')[0].offset == "99.5%") {      icons[0].offset = '100%';      line.set('icons', icons);      window.clearInterval(id);    }  }, 20);}function drawBlueLine(map, lineSymbol) {  console.log();  var startBlue = new google.maps.LatLng(2.852888, 101.651970);  var endBlue = new google.maps.LatLng(2.915067, 101.6079);  var blueLine = new google.maps.Polyline({    path: [startBlue, endBlue],    strokeColor: '#0000ff',    strokeOpacity: 2.0,    strokeWeight: 5,    icons: [{      icon: lineSymbol,      offset: '100%'    }],    map: map  });    new google.maps.Marker({    position: startBlue,    map: map  });    new google.maps.Marker({    position: endBlue,    map: map  });}google.maps.event.addDomListener(window, 'load', initialize);    </script> <style>#map {  height: 500px;  width: 90%}</style> <div id='map'></div>			</div>						--></div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->