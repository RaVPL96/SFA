<?php
/*


 * This system Licenced to Raigam Marketing Services (Pvt) Ltd. 

 * Developed By: Lakshitha Pradeep Karunarathna  * 

 * Company: Serving Cloud INC in association with MyOffers.lk  * 

 * Date Started:  October 20, 2017  * 


 */
?>
<?php include_once BASEPATH . ('../application/views/template/leftsidebar.php'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Secondary Sales HR Module
            <small>Maintain Secondary Sales HR Module Details </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Secondary Sales HR Data Control Module</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12" style="overflow-x: scroll;">
                <div id="successMessage" class="hideDiv">Updated Successfully! </div>
                <div id="errorMessage" class="hideDiv">Invalid Data! Please Try Again. </div>
                <div class="keepgap"></div> 
                <form class="form-horizontal" id="" action="<?= base_url('Salesreports/nonMovingReport') ?>" method="post">
                    <div class="col-md-12">
                        
                    <div class="col-md-6">                            
                            <div class="form-group">
                                <label class="col-md-2">Location <span class="text-red">*</span></label>
                                <div class="col-md-6">
                                    <select id="LocationList" name="locationID" class="form-control">
                                        <option value="-1"> -- Select Location -- </option>    
                                        <?php
                                        foreach ($LocationList as $l) {
                                            $select = '';
                                            if (!empty($locationID) && isset($locationID) && $l['id'] == $locationID) {
                                                $select = 'selected';
                                            }
                                            echo '<option ' . $select . ' value="' . $l['id'] . '"> ' . $l['code'] . '</option>';
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
                    </div>
                </form>
                <div class="col-md-12">

                    <?php if (!empty($DateRange) && isset($DateRange)) { ?>
                        <div class="form-group">
                            <input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('nonmovings_table', 'NonMovings_<?= $DateRange ?>')" value="Download Excel">
                        </div>
                        <table  id="nonmovings_table" class="table table-hover">	
                            <thead>						
                                <tr>
                                    <th>Item</th>
                                    <th>Description</th>
                                    <th>Actual Quantity</th>
                                    <th>Actual Value</th>                                  		
                                </tr>		
                            </thead>		
                            <tbody>			
                                <?php
                                foreach ($NonMovingItems as $o) {
                                    ?>
                                    <tr>	
                                        <td><?= $o['item'] ?></td> 
                                        <td><?= $o['des'] ?></td> 
                                        <td><?= $o['Actual_Qty'] ?></td> 
                                        <td><?= $o['Actual_Val'] ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>                    			
                            </tbody> 					
                        </table>					
                        <?php
                    }
                    ?>

                </div>

            </div>


        </div>
    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->