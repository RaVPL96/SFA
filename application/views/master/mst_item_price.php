<?php include_once BASEPATH . ('../application/views/template/leftsidebar.php'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Item Price Maintain 
            <small>Maintain Secondary Item Price Details </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Master Data Control Module</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div id="successMessage" class="hideDiv">Updated Successfully! </div>
                <div id="errorMessage" class="hideDiv">Invalid Data! Please Try Again. </div>
                <div class="keepgap"></div>  
                <?php
                $itemName = '';
                $itemUnit = '';
                $lid = 'new';
                $isactval = '';
                $isdelval = '';
                $isact = 0;
                $isdel = 0;
                $btnmsg = 'Create Price';
                if (!empty($ItemData) && isset($ItemData)) {
                    $itemName = $ItemData->description;
                    $itemUnit = $ItemData->uom;
                    $lid = $ItemData->item;
                    $isact = $ItemData->is_act;
                    if ($isact == 1) {
                        $isactval = 'checked="checked"';
                    } else {
                        $isactval = '';
                    }
                }
                ?>


                <form id="frmLocation" role="form" action="<?= base_url('index.php/master/saveRange') ?>" method="post">
                    <fieldset>
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Item Price</h3> (Enter Price Details)  <a class="btn btn-success pull-right btn-sm" href="<?= base_url('index.php/master/itemPrice/') ?>"><i class="fa fa-plus"></i> New</a>                              
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Item Code</label>
                                    <input type="text" name="sop[item]" class="form-control" value="<?= $lid ?>" readonly="readonly" >
                                </div>
                                <div class="form-group">
                                    <label>Item Name</label>
                                    <input type="text" name="sop[itemName]" class="form-control" value="<?= $itemName ?>" readonly="readonly" >
                                </div>
                                <div class="form-group">
                                    <label>Unit</label>
                                    <input type="text" name="sop[itemUnit]" class="form-control" value="<?= $itemUnit ?>" readonly="readonly" >
                                </div>
                                <div class="form-group"> 
                                    <label>Date Effective From</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="startDate" class="form-control pull-right active" readonly="" id="datepicker" value="">
                                    </div>
                                </div>  
                                <div class="form-group"> 
                                    <label>Date Effective From</label>
                                    <input type="text" name="sop[endDate]" class="form-control" value="2222-01-01" readonly="readonly" >
                                </div> 
                                <div class="form-group"> 
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Range</th>
                                                <th>Wholesale Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!empty($ItemRanges) && isset($ItemRanges)) {
                                                foreach ($ItemRanges as $r) {
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?= $r['range_name'] ?>
                                                            <input type="hidden" name="range_id[]" value="<?= $r['range_id'] ?>">
                                                        </td>
                                                        <td>
                                                            <input type="number" name="range_price[<?= $r['range_id'] ?>]" value="" class="form-control" min="0.00">
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <input type="hidden" name="sop[id]" value="<?php
                                if (!empty($lid) && isset($lid)) {
                                    echo $lid;
                                } else {
                                    echo 'new';
                                }
                                ?>">
                                <button type="submit" class="btn btn-primary pull-right"><?= $btnmsg ?></button>
                            </div>                            
                        </div><!-- /.box -->
                    </fieldset>
                </form>

            </div>


            <!--Right Side Content-->
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Item Price List</h3> (Click Edit to change details)
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered" id="example1">
                            <thead>
                                <tr>
                                    <th style="width: 180px">Code</th>
                                    <th style="width: 80px">Name</th>
                                    <th style="width: 80px">Unit of Measure</th>
                                    <th style="width: 40px">&nbsp;</th> 
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($ItemDataSet) && isset($ItemDataSet)) {
                                    foreach ($ItemDataSet as $loc) {
                                        $action = 0;
                                        if (!empty($loc) && isset($loc['is_act']) && $loc['is_act'] == 1) {
                                            $chked = 'checked';
                                            $class = 'success';
                                            $status = 'Active';
                                            $action = 0;
                                        } else {
                                            $chked = '';
                                            $class = 'warning';
                                            $status = 'Inactive';
                                            $action = 1;
                                        }
                                        if (!empty($loc) && isset($loc['is_del']) && $loc['is_del'] == 1) {
                                            $chked = 'checked';
                                            $class = 'danger';
                                            $status = 'Deleted';
                                            $delAction = 0;
                                        } else {
                                            $chked = '';
                                            //$class = 'warning';
                                            //$status = 'Inactive';
                                            $delAction = 1;
                                        }

                                        echo '<tr class="info">
											<td>' . $loc['item'] . '</td>
											<td>' . $loc['description'] . '</td>
											<td>' . $loc['uom'] . '</td>
											<td><a class="btn btn-primary btn-xs" href="' . base_url('index.php/master/itemPrice/null/' . $loc['item']) . '">Edit</a></td> 
											 </tr>';
                                    }
                                }
                                ?>   
                            </tbody>		
                        </table>
                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix">

                    </div>
                </div><!-- /.box -->
            </div>
            <!--Right Side Content-->
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Item Price</h3> (Click Edit to change details)
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered" id="example1">
                            <thead>
                                <tr>
                                    <th style="width: 180px">Date Start</th>
                                    <th style="width: 80px">Range</th>
                                    <th style="width: 80px">Unit of Measure</th>
                                    <th style="width: 40px">Price</th> 
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($ItemPrices) && isset($ItemPrices)) {
                                    foreach ($ItemPrices as $p) {
                                        $action = 0;

                                        echo '<tr class="info">
											<td>' . $p['date_start'] . '</td>
											<td>' . $p['range_name'] . '</td>
											<td>' . $p['uom'] . '</td>
											<td>' . $p['wholesale_price'] . '</td> 
											 </tr>';
                                    }
                                }
                                ?>   
                            </tbody>		
                        </table>
                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix">

                    </div>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->



