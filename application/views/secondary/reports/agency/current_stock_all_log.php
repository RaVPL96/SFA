<?php include_once BASEPATH . ('../application/views/template/leftsidebar.php'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Stock Detail Log
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

                <h4>Stock Details</h4>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Agency Name</th>
                            <th>Stock Number</th>
                            <th>Stock Date</th>
                            <th>Posted Date</th>
                            <th>Sellable</th>
                            <th>Damage</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($stock_data) && isset($stock_data)) {
                            foreach ($stock_data as $a) {
                                if ($item == $a['item']) {
                                    ?>
                                    <tr>
                                        <td><?= $a['des'] ?></td>
                                        <td><?= $a['ag_name'] ?></td>
                                        <td><?= $a['st_no'] ?></td>
                                        <td><?= $a['st_date'] ?></td>
                                        <td><?= $a['post_date'] ?></td>
                                        <td><?= $a['sellable'] ?></td>
                                        <td><?= $a['damage'] ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <h4>Invoice Details</h4>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Agency Name</th>
                            <th>Invoice Number</th>
                            <th>Actual Date</th>
                            <th>Booking Date</th>
                            <th>Shop name</th>
                            <th>Dealer Code</th>
                            <th>Booking Qty</th>
                            <th>Cancel</th>
                            <th>G Ret.</th>
                            <th>G Ret. Free</th>
                            <th>M Ret.</th>
                            <th>M Ret. Free</th>
                            <th>Free</th>
                            <th>Issued Qty</th>
                            <th>Collected Qty</th>
                            <th>M Ret. Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($invoice_data) && isset($invoice_data)) {
                            $totIssue = 0;
                            $totCollected = 0;
                            $totMRet = 0;
                            foreach ($invoice_data as $a) {
                                if ($item == $a['item']) {
                                    $totIssue = $totIssue+ ($a['b_qty'] - $a['c_qty']) + $a['f_qty'];
                                    $totCollected = $totCollected + $a['g_qty'] + $a['grf_qty'];
                                    $totMRet = $totMRet + $a['m_qty'] + $a['mrf_qty'];
                                    ?>
                                    <tr>
                                        <td><?= $a['des'] ?></td>
                                        <td><?= $a['ag_name'] ?></td>
                                        <td><?= $a['invno'] ?></td>
                                        <td><?= $a['date_actual'] ?></td>
                                        <td><?= $a['date_book'] ?></td>
                                        <td><?= $a['sh_name'] ?></td>
                                        <td><?= $a['sh_ag_cd'] . '/' . $a['sh_ro_cd'] . '/' . $a['sh_cd'] ?></td>
                                        <td><?= $a['b_qty'] ?></td>
                                        <td><?= $a['c_qty'] ?></td>
                                        <td><?= $a['g_qty'] ?></td>
                                        <td><?= $a['grf_qty'] ?></td>
                                        <td><?= $a['m_qty'] ?></td>
                                        <td><?= $a['mrf_qty'] ?></td>
                                        <td><?= $a['f_qty'] ?></td>
                                        <td><?= ($a['b_qty'] - $a['c_qty']) + $a['f_qty'] ?></td>
                                        <td><?= $a['g_qty'] + $a['grf_qty'] ?></td>
                                        <td><?= $a['m_qty'] + $a['mrf_qty'] ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                            <tr>
                                <td colspan="14">Summery</td> 
                                <td><?= $totIssue ?></td>
                                <td><?= $totCollected ?></td>
                                <td><?= $totMRet ?></td>
                            </tr>
                            <tr style="font-weight: bold;">
                                <td colspan="14">Sold Qty</td> 
                                <td><?= ($totIssue-$totCollected)*-1 ?></td>
                                <td> </td>
                                <td><?= $totMRet ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
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

<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="  crossorigin="anonymous"></script>
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
</script>