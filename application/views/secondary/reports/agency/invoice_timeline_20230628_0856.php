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
                    
                    <h2>Invoice Timeline </h2>

                    <ul class="timeline">

                        <?php
                        if (!empty($InvoiceTimmeline) && isset($InvoiceTimmeline)) {
                            ?>
                            


                            <?php
                            foreach ($InvoiceTimmeline as $d) {
                                ?> <li class="time-label">
                                    <span class="bg-red">
                                        <?= $d['audit_date']; ?>
                                    </span>
                                </li>  

                                <li>
                                    <i class="fa fa-envelope bg-blue"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>
                                        <h3 class="timeline-header"><a href="#">-</a> -</h3>
                                        <div class="timeline-body">

                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>ag_cd</th>
                                                        <th>ro_cd</th>
                                                        <th>sh_cd</th>
                                                        <th>cname</th>
                                                        <th>invno</th>
                                                        <th>tot_b_val</th>
                                                        <th>tot_c_val</th>
                                                        <th>tot_m_val</th>
                                                        <th>tot_g_val</th>
                                                        <th>tot_f_val</th>
                                                        <th>tot_a_val</th>

                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <tr>
                                                        <td><?= $d['ag_cd']?></td>
                                                        <td>ro_cd</td>
                                                        <td>sh_cd</td>
                                                        <td>cname</td>
                                                        <td>invno</td>
                                                        <td>tot_b_val</td>
                                                        <td>tot_c_val</td>
                                                        <td>tot_m_val</td>
                                                        <td>tot_g_val</td>
                                                        <td>tot_f_val</td>
                                                        <td>tot_a_val</td>
                                                    </tr>


                                                </tbody>
                                            </table>

                                        </div>
                                        <div class="timeline-footer">
                                            <a class="btn btn-primary btn-xs"> view </a>

                                        </div>
                                    </div>
                                </li>

                                <?php
                            }
                        }
                        ?>



                        <li>
                            <i class="fa fa-envelope bg-blue"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>
                                <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>
                                <div class="timeline-body">
                                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                    weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                    jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                    quora plaxo ideeli hulu weebly balihoo...
                                </div>
                                <div class="timeline-footer">
                                    <a class="btn btn-primary btn-xs">Read more</a>
                                    <a class="btn btn-danger btn-xs">Delete</a>
                                </div>
                            </div>
                        </li>

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





