<?php include_once BASEPATH . ('../application/views/template/leftsidebar.php'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Sales Distributor 
            <small>Maintain Secondary Sales Distributor Details </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Distributor Data Control Module</li>
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
				$agency_warehouse_id='';
				$erp_id='';
				
				$agency_warehouse_erp_code=''; 
				$agency_warehouse_erp_shipto_code='';
				
				$lid = 'new';
                $isactval = 'checked="checked"';
				$isdelval = '';
                $btnmsg = 'Create Distributor ERP Link';
                if (!empty($DistributorWarehouseERP) && isset($DistributorWarehouseERP)) {
                    
					
                    $lid = $DistributorWarehouseERP->id;
					$agency_warehouse_id=$DistributorWarehouseERP->distributor_warehouse_id;
					$erp_id=$DistributorWarehouseERP->erp_company_id;
					$agency_warehouse_erp_code=$DistributorWarehouseERP->erp_customer_code;
					
                    $isact = $DistributorWarehouseERP->is_act;
					$isdel = $DistributorWarehouseERP->is_del;
                    $readLvl = 'disabled=disabled';
                    $btnmsg = 'Update Distributor ERP Link';
                    if ($isact == 1) {
                        $isactval = 'checked="checked"';
                    } else {
                        $isactval = '';
                    }
					if ($isdel == 1) {
                        $isdelval = 'checked="checked"';
                    } else {
                        $isdelval = '';
                    }
                }
                ?>


                <form id="frmLocation" role="form" action="<?= base_url('index.php/distributor/saveDistributorErpMap') ?>" method="post">
                    <fieldset>
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Distributor Warehouse ERP Link</h3> (Enter Distributor Details)  <a class="btn btn-success pull-right btn-sm" href="<?= base_url('index.php/distributor/createDistributorErpMap/') ?>"><i class="fa fa-plus"></i> New</a>                              
                            </div><!-- /.box-header -->
                            <div class="box-body">								
                                <div class="form-group">
									
                                    <select type="text" name="sop[agency_warehouse_id]" class="form-control"  placeholder="Select Warehouse">
										<option value="">-- Select Warehouse --</option>
										<?php
										if(!empty($DistributorWarehouseData) && isset($DistributorWarehouseData)){
											foreach($DistributorWarehouseData as $d){
												$select='';
												if($agency_warehouse_id==$d['id']){$select='selected="selected"';}
												echo '<option '.$select.' value="'.$d['id'].'">'.$d['agency_name'].'-'.$d['location_name'].'</option>';
											}
										}
										?>
										
									</select>
                                </div>
                                <div class="form-group">
                                    <select type="text" name="sop[erp_id]" class="form-control" placeholder="Select ERP">
										<option value="">-- Select ERP Company --</option>
										<?php
										if(!empty($location) && isset($location)){
											foreach($location as $l){
												$select='';
												if($erp_id==$l['id']){$select='selected="selected"';}
												echo '<option '.$select.' value="'.$l['id'].'">'.$l['code'].'-'.$l['name'].'</option>';
											}
										}
										?>
									</select>
                                </div>
								<div class="form-group">
                                    <input type="text" name="sop[agency_warehouse_erp_code]" class="form-control" value="<?= $agency_warehouse_erp_code ?>" placeholder="Enter Agency Warehouse ERP Code">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="sop[agency_warehouse_erp_shipto_code]" class="form-control" value="<?= $agency_warehouse_erp_shipto_code ?>" placeholder="Enter Agency Warehouse ERP Ship to Code">
                                </div>
                                <div class="form-group"> 
                                    <div class="checkbox icheck" style="padding-left: 20px;">
                                        <label><input type="checkbox" <?= $isactval ?> name="sop[isact]" class="" value="1" placeholder="is active or not"> Is Active</label>
                                    </div>  
                                </div> 
								<div class="form-group"> 
                                    <div class="checkbox icheck" style="padding-left: 20px;">
                                        <label><input type="checkbox" <?= $isdelval ?> name="sop[isdel]" class="" value="1" placeholder="is deleted or not"> Is Deleted</label>
                                    </div>  
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
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sales Distributor Warehouse Head Office ERP List</h3> (Click Edit to change details)
                    </div><!-- /.box-header -->
                    <div class="box-body" ng-app="Distributor" ng-controller="distributorController">
                        <table class="table table-bordered" id="example1">
						<thead>
                            <tr>
                                <th style="width: 180px">System ID</th>
                                <th style="width: 180px">Agency Code</th>
                                <th style="width: 180px">Agency Name</th>
                                <th style="width: 180px">Warehouse ID</th>
                                <th style="width: 180px">Warehouse Code</th>
                                <th style="width: 180px">Warehouse Name</th>
                                <th style="width: 180px">ERP Company</th>
                                <th style="width: 180px">ERP Company Code</th>
                                <th style="width: 180px">ERP Company Ship-To Code</th>
                                <th style="width: 80px">Status</th>
                                <th style="width: 40px">&nbsp;</th>
                                <th style="width: 40px">&nbsp;</th>
                                
                            </tr>
							</thead>
							<tbody>
							
							<tr ng-repeat="d in distributorList">
								<td>{{d.d_id}}</td>
								<td>{{d.agency_code}}</td>
								<td>{{d.agency_name}}</td>
								<td>{{d.id}}</td>
								<td>{{d.location_code}}</td>
								<td>{{d.location_name}}</td>
								<td>{{d.code}}</td>
								<td>{{d.erp_customer_code}}</td>
								<td>{{d.erp_customer_shipto_code}}</td>
								<td> </td>
								<td><a class="btn btn-primary btn-xs" href="<?=base_url('index.php/distributor/createDistributorErpMap/{{d.d_erp_link_id}}')?>">Edit</a></td>
								<td> </td>
							</tr>
							
                             
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




<!-- jQuery 2.1.4 -->
<script src="<?= base_url('adminlte/plugins/jQuery/jQuery-2.1.4.min.js') ?>"></script>        
<script src="<?= base_url('adminlte/dist/js/validate/jquery.validate.min.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('adminlte/dist/js/validate/placeholders.min.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('adminlte/dist/js/angular.js') ?>" type="text/javascript"></script>

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
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
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
    $('#module').change(function() {
        var modID = $('#module').val();
        //alert(modID);
        $.ajax({
            type: "post",
            url: "<?php echo base_url('index.php/users/getFunctions'); ?>",
            data: 'mid=' + modID,
            success: function(feed) {
                $('#uploading').modal('hide');
                //alert(feed);
                $('#fwrap').empty().append(feed);

            },
            error: function(feed) {
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
                success: function(feed) {
                     if (feed.trim() == '1') {
                        //swal("Updated!", "Your data is now updated.", "success");
                        window.location.reload();
                    } else {
                        swal("Error!", "Unable to process your request", "error");
                    }
                },
                error: function(feed) {
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
            function() {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('index.php/items/updateLocData'); ?>",
                    data: 'id=' + uid + '&reqType=' + reqType + '&upVal=' + upval,
                    success: function(feed) {
                        if (feed.trim() == '1') {
                            swal("Updated!", "Your data is now updated.", "success");
                            window.location.reload();
                        } else {
                            swal("Error!", "Unable to process your request", "error");
                        }
                    },
                    error: function(feed) {
                        swal("Error!", "Unable to process your request", "error");
                    }
                });
            });
        }
    }
</script>

<script !src="">
	var app = angular.module('Distributor',[]);
	
	app.controller('distributorController',function($scope,$http){
		console.log('success');
		$http.get('<?=base_url('distributor/getDistributorERPLink/')?>').then(function(mydata){
			console.log(mydata);
			$scope.distributorList = mydata.data; 
		});
	});
</script>