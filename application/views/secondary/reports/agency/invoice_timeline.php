<?php include_once BASEPATH . ('../application/views/template/leftsidebar.php'); ?>
<style>
    .tableFixHead          {
        overflow-y: auto;
        height: 300px;
    }
    .tableFixHead .thead2 tr {
        position: sticky;
        top: 0;
        z-index: 1;
        background: #c8f1eb;
    }
    .tableFixHead tbody th {
        position: sticky;
        left: 0;
    }


    .view {
        margin: auto;
    }
    thead tr th{
        background: #0070c0 !important;
        color:#ffffff;
    }
    .wrappers {
        position: relative;
        /*overflow: auto;*/
        /*border: 1px solid black;*/
        white-space: normal;
    }

    .sticky-col {
        position: -webkit-sticky;
        position: sticky;
        background-color: white;
    }
    .first-col {
        width: 100px;
        min-width: 100px;
        /*max-width: 100px;*/
        left: 0px;
        z-index: 5;
    }



    .presentation {
        position: relative;
        border-collapse: separate;
        border-spacing: 0;
    }

    .presentation th,
    .presentation td {
        width: 50px;
        padding: 5px;
        background-color: white;
    }

    .presentation tbody {
        height: 90px;
    }

    .presentation th {
        text-align: center;
        position: sticky;
        top: 0;
        z-index: 2;
    }
    .presentation th.fix {
        text-align: center;
        position: sticky;
        top: 0;
        z-index: 2;
    }
    .presentation th:nth-child(1) {
        left: 0;
        z-index: 3;
    }

    .presentation td {
        text-align: center;
        white-space: pre;
    }

    .presentation tbody tr td:nth-child(1) {
        position: sticky;
        left: 0;
        z-index: 1;
    }
    .headcol{
        position: -webkit-sticky;
        position: sticky;
        background-color: white;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Invoice Timeline
            <small>Control Panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content" style="overflow:hidden;">


        <div class="row">
            <div class="col-md-12">  
                <form class="form-horizontal" id="myForm" action="<?= base_url('salesreports/invoiceTimeline') ?>" method="post">

                    <div class="col-md-4">                            
                        <div class="form-group">
                            <label class="col-md-4">Invoice <span class="text-red">*</span></label>
                            <div class="col-md-6">
                                <input type="text"  name="invoice_number" class="form-control" id="Invoice" placeholder="Invoice" value=""  >  

                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-5">
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="category" name="category" value="">
                            <input type="submit" class="btn btn-danger" name="btnsubmit" value="Get Report">
                        </div>                                
                    </div>
                </form>
            </div>


            <div class="col-md-12">
                <div class="form-group">



                    <ul class="timeline">

                        <?php
                        if (!empty($InvoiceTimmeline) && isset($InvoiceTimmeline)) {
                            ?>



                            <?php
                            foreach ($InvoiceTimmeline as $d) {
                                ?> <li class="time-label">
                                    <span class="bg-red">
                                        <?= $d['audit_date'].' '; ?>
                                        <?= $d['audit_time']; ?>
                                    </span>
                                </li>  

                                <li>
                                    <i class="fa fa-envelope bg-blue"></i>
                                    <div class="timeline-item">

                                        <h3 class="timeline-header"><a href="#">-</a> -</h3>
                                        <div class="timeline-body">

                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Agency Code</th>
                                                        <th>Route Code</th>
                                                        <th>Shop Code</th>
                                                        <th>Shop Name</th>
                                                        <th>Invoice No</th>
                                                        <th>Total Booking val</th>
                                                        <th>Total Cancle val</th>
                                                        <th>Total Market-R val</th>
                                                        <th>Total good-R val</th>
                                                        <th>Total Free Issue val</th>
                                                        <th>Total Actual val</th>
                                                        <th>Total Discount</th>
                                                        <th>Discount Per (%)</th>
                                                        <th>Booking Date</th>
                                                        <th>Actual Date</th>
                                                        <th>Date Save</th>
                                                        <th>Time Save</th>
                                                        <th>Audit Date</th>
                                                        <th>Audit Time</th>
                                                        <th>Range</th>
                                                        <th>Booking OR Actual</th>                                                        
                                                        <th>Invoice Type</th>
                                                        <th>App Invoice No</th>

                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <tr>
                                                        <td><?= $d['ag_cd'] ?></td>
                                                        <td><?= $d['ro_cd'] ?></td>
                                                        <td><?= $d['sh_cd'] ?></td>
                                                        <td><?= $d['cname'] ?></td>
                                                        <td><?= $d['invno'] ?></td>
                                                        <td><?= $d['tot_b_val'] ?></td>
                                                        <td><?= $d['tot_c_val'] ?></td>
                                                        <td><?= $d['tot_m_val'] ?></td>
                                                        <td><?= $d['tot_g_val'] ?></td>
                                                        <td><?= $d['tot_f_val'] ?></td>
                                                        <td><?= $d['tot_a_val'] ?></td>
                                                        <th><?= $d['tot_dis'] ?></th>
                                                        <th><?= $d['dis_per'] ?></th>
                                                        <th><?= $d['date_book'] ?></th>
                                                        <th><?= $d['date_actual'] ?></th>
                                                        <th><?= $d['date_save'] ?></th>
                                                        <th><?= $d['time_save'] ?></th>
                                                        <th><?= $d['audit_date'] ?></th>
                                                        <th><?= $d['audit_time'] ?></th>
                                                        <th><?= $d['cd'] ?></th>
                                                        <th><?= $d['b_a'] ?></th>                                                        
                                                        <th><?= $d['d'] ?></th>
                                                        <th><?= $d['app_inv_no'] ?></th>
                                                    </tr>


                                                </tbody>
                                            </table>

                                            <div>
                                                <center> <h2>Invoice Item View</h2> </center>>
                                                <br>
                                            </div>

                                            <div>
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Item</th>
                                                            <th>Item Name</th>
                                                            <th>Unit Price</th>
                                                            <th>Booking Qty</th>
                                                            <th>Cancle Qty</th>
                                                            <th>M-Return Qty</th>
                                                            <th>G-Return Qty</th>
                                                            <th>Free Issue Qty</th>
                                                            <th>Line Discount</th>
                                                            <th>Actual Qty </th>                                                                       
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php
                                                        foreach ($InvoiceTimmelineView as $S) {

                                                            if ($d['auto'] == $S['invh_log_auto']) {
                                                                ?>

                                                                <tr>
                                                                    <td><?= $S['item'] ?></td>
                                                                    <td><?= $S['des'] ?></td>
                                                                    <td><?= $S['unit_price'] ?></td>
                                                                    <td><?= $S['b_qty'] ?></td>
                                                                    <td><?= $S['c_qty'] ?></td>
                                                                    <td><?= $S['m_qty'] ?></td>
                                                                    <td><?= $S['g_qty'] ?></td>
                                                                    <td><?= $S['f_qty'] ?></td>
                                                                    <td><?= $S['dis_per'] ?></td>
                                                                    <td><?= $S['a_qty'] ?></td>

                                                                </tr>

                                                                <?php
                                                            }
                                                            ?>


                                                            <?php
                                                        }
                                                        ?>
                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>



                                    </div>
                                </li>

                                <?php
                            }
                        }
                        ?>

                    </ul>

                </div>                                
            </div>
        </div>





</div>
<div class="col-md-12" style="overflow-x: scroll; overflow-y: scroll; max-height: 700px;">

</div>




</section>
</div>

<!-- /.content -->
</div><!-- /.content-wrapper -->
<script type="text/javascript" src="https://adminlte.io/themes/AdminLTE/bower_components/raphael/raphael.min.js"></script>
<script type="text/javascript" src="https://adminlte.io/themes/AdminLTE/bower_components/morris.js/morris.min.js"></script>

<script>
    $('#sbRange').on('change', function (e) {
        // If you just need "value" (which's like having "key" of an associative-array).
        var selectedValue = this.value;
        $('.cat-box:not(.' + selectedValue + ')').hide(500);
        $('.' + selectedValue).show(500);
        // Else.
        //var $selectedOptionElement = $("option:selected", this);
        //var selectedValue = $selectedOptionElement.val();
        //var selectedText = $selectedOptionElement.text();

    });
    $("#sbRange").trigger("change");

    function setCategory(id) {
        $('#category').val(id);
        document.getElementById("myForm").submit();
    }



    const tables = document.querySelectorAll('table');
    for (let table of tables) {
        let headerCell = null;
        for (let row of table.rows) {
            const firstCell = row.cells[0];
            firstCell.style.backgroundColor = "yellow";
            firstCell.style.verticalAlign = "middle";
            firstCell.style.fontSize = "20px";
            firstCell.style.fontWeight = "bold";

            if (headerCell === null || firstCell.innerText !== headerCell.innerText) {
                headerCell = firstCell;
            } else {
                headerCell.rowSpan++;
                firstCell.remove();
            }
        }
    }
    // LINE CHART
    var line = new Morris.Line({
        element: 'line-chart',
        resize: true,
        data: [
            {y: '2011 Q1', item1: 2666, item2: 2323},
            {y: '2011 Q2', item1: 2778, item2: 2323},
            {y: '2011 Q3', item1: 4912, item2: 2323},
            {y: '2011 Q4', item1: 3767, item2: 2323},
            {y: '2012 Q1', item1: 6810, item2: 2323},
            {y: '2012 Q2', item1: 5670, item2: 2323},
            {y: '2012 Q3', item1: 4820, item2: 2323},
            {y: '2012 Q4', item1: 15073, item2: 2323},
            {y: '2013 Q1', item1: 10687, item2: 2323},
            {y: '2013 Q2', item1: 8432, item2: 2323}
        ],
        xkey: 'y',
        ykeys: ['item1', 'item2'],
        labels: ['Ítem1', 'Ítem2'],
        lineColors: ['#3c8dbc'],
        hideHover: 'auto'
    });

    // LINE CHART
    var line = new Morris.Line({
        element: 'line-charta',
        resize: true,
        data: [
<?php
$yKey = '';
/*
  for ($k = 1; $k <= 6; $k++) {
  $monthNumberBack = date('m', strtotime($datepickermonth . ' -' . $k . ' month'));
  $monthNameBack = date('F', strtotime($datepickermonth . ' -' . $k . ' month'));
  $YearNameBack = date('Y', strtotime($datepickermonth . ' -' . $k . ' month'));
  $line = '{y: \'' . $YearNameBack . ' ' . $monthNameBack . '\' ';
  if (!empty($getTotalSalesandPc) && isset($getTotalSalesandPc)) {
  foreach ($DailySales as $v) {
  $yKey .= '\'' . $v['ag_name'] . '\',';
  foreach ($getTotalSalesandPc as $p) {
  if ($v['ag_cd'] === $p['ag_cd']) {
  $line .= ' ,\'' . $v['ag_name'] . '\': ' . number_format($p[$monthNameBack . '_TotPC'] / $p[$monthNameBack . '_WD'], 1) . ',';
  }
  }
  }
  $line .= '},';
  }
  //echo $line;
  }
 */
?>
            /*{y: '2011 Q1', item1: 2666},
             {y: '2011 Q2', item1: 2778},
             {y: '2011 Q3', item1: 4912},
             {y: '2011 Q4', item1: 3767},
             {y: '2012 Q1', item1: 6810},
             {y: '2012 Q2', item1: 5670},
             {y: '2012 Q3', item1: 4820},
             {y: '2012 Q4', item1: 15073},
             {y: '2013 Q1', item1: 10687},
             {y: '2013 Q2', item1: 8432}*/
        ],
        xkey: 'y',
        ykeys: [<?= $yKey ?>],
        labels: [<?= $yKey ?>],
        lineColors: ['#3c8dbc'],
        hideHover: 'auto'
    });

</script>





