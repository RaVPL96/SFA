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
            Pending Bill Report 
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
                <form class="form-horizontal" id="myForm" action="<?= base_url('salesreports/notBillOutletList') ?>" method="post">
                    <div class="col-md-4">                            
                        <div class="form-group">
                            <label class="col-md-4">Area <span class="text-red">*</span></label>
                            <div class="col-md-6">
                                <select id="sbArea" name="areaID" class="form-control">
                                    <option value="-1"> -- Select Area -- </option>    
                                    <?php
                                    foreach ($AreaList as $a) {
                                        $select = '';
                                        if (!empty($AreaID) && isset($AreaID) && $a['id'] == $AreaID) {
                                            $select = 'selected';
                                        }
                                        if ($sess['grade_id'] == 4) {
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
                    <div class="col-md-4">                            
                        <div class="form-group">
                            <label class="col-md-4">Range <span class="text-red">*</span></label>
                            <div class="col-md-6">
                                <select id="sbRange" name="rangeID" class="form-control">
                                    <option value="-1"> -- Select Range -- </option>    
                                    <?php
                                    foreach ($RangeList as $a) {
                                        $select = '';
                                        if (!empty($RangeID) && isset($RangeID) && $a['range_name'] == $RangeID) {
                                            $select = 'selected';
                                        }

                                        if ($sess['grade_id'] == 4) {
                                            foreach ($ASE_Area as $ase) {
                                                if ($ase['range_id'] == $a['id']) {
                                                    echo '<option ' . $select . ' value="' . $a['range_name'] . '"> ' . $a['range_name'] . '</option>';
                                                }
                                            }
                                        } else {
                                            echo '<option ' . $select . ' value="' . $a['range_name'] . '"> ' . $a['range_name'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">                            
                        <div class="form-group">
                            <label class="col-md-4">Date Range <span class="text-red">*</span></label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="DateRange" class="form-control pull-right active" readonly="" id="reservation" value="<?= $DateRange ?>">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
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


        </div>
        <div class="col-md-12" style="overflow-x: scroll; overflow-y: scroll; max-height: 700px;">
            <?php
            if (!empty($NotBillOutlet) && isset($NotBillOutlet)) {
                ?>
                <h2>Not Bill Outlet Report
                </h2>

                <input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('attendance_table', 'Daily Shop-wise Sales')" value="Download Excel"><br>
                <table id="attendance_table" class="table table-hover presentation">
                    <thead>
                        <tr>
                            <th>Area_name</th> 
                            <th>Territory</th>
                            <th>Shop Agency Code</th>
                            <th>Shop Rout Code</th>
                            <th>shop Code</th>
                            <th>Shop Name</th>
                            
                            <th>Address 01</th>
                            <th>Address 02</th>
                            <th>Address 03</th>
                            <th>Shop T_Number</th>
                        </tr>

                    </thead>
                    <?php
                    foreach ($NotBillOutlet as $d) {



                        echo '<tr>'
                        . '<td>' . $d['area_name'] . '</td>'
                        . '<td>' . $d['ag_name'] . '</td>'
                        . '<td>' . $d['sh_ag_cd'] . '</td>'
                        . '<td>' . $d['sh_ro_cd'] . '</td>'
                        . '<td>' . $d['sh_cd'] . '</td>'
                        . '<td>' . $d['sh_name'] . '</td>'
                        . '<td>' . $d['add1'] . '</td>'
                        . '<td>' . $d['add2'] . '</td>'
                        . '<td>' . $d['add3'] . '</td>'
                        . '<td>' . $d['sh_tno'] . '</td>'
                        
                        . '</tr>';
                    }
                    ?>
                </table>
                <?php
            }
            ?>
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




