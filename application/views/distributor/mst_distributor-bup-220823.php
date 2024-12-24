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
				$agency_code='';
                $agency_name = '';
                $address_1 ='';
				$address_2='';
				$address_3='';
				$address_4='';
				$city='';
				$distributor_name='';
				$telephone_1='';
				$telephone_2='';
				$fax_1='';
				$fax_2='';
				
				$lid = 'new';
                $isactval = 'checked="checked"';
				$isdelval = '';
                $btnmsg = 'Create Distributor';
                if (!empty($DistributorData) && isset($DistributorData)) {
                    $agency_code=$DistributorData->agency_code;
					$agency_name=$DistributorData->agency_name;
					$address_1=$DistributorData->address_1;
					$address_2=$DistributorData->address_2;
					$address_3=$DistributorData->address_3;
					$address_4=$DistributorData->address_4;
					$city=$DistributorData->city;
					$distributor_name=$DistributorData->distributor_name;
					$telephone_1=$DistributorData->telephone_1;
					$telephone_2=$DistributorData->telephone_2;
					$fax_1=$DistributorData->fax_1;
					$fax_2=$DistributorData->fax_2;
					
                    $lid = $DistributorData->id;
					
                    $isact = $DistributorData->is_act;
					$isdel = $DistributorData->is_del;
                    $readLvl = 'disabled=disabled';
                    $btnmsg = 'Update Distributor';
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


                <form id="frmLocation" role="form" action="<?= base_url('index.php/distributor/saveDistributor') ?>" method="post">
                    <fieldset>
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Distributor </h3> (Enter Distributor Details)  <a class="btn btn-success pull-right btn-sm" href="<?= base_url('index.php/distributor/createDistributor/') ?>"><i class="fa fa-plus"></i> New</a>                              
                            </div><!-- /.box-header -->
                            <div class="box-body">
								
                                <div class="form-group">
                                    <input type="text" name="sop[agency_code]" class="form-control" value="<?= $agency_code ?>" placeholder="Enter Code of Distributor">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="sop[agency_name]" class="form-control" value="<?= $agency_name ?>" placeholder="Enter Name of Distributor">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="sop[address_1]" class="form-control" value="<?= $address_1 ?>" placeholder="Enter address 1">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="sop[address_2]" class="form-control" value="<?= $address_2 ?>" placeholder="Enter address 2">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="sop[address_3]" class="form-control" value="<?= $address_3 ?>" placeholder="Enter address 3">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="sop[address_4]" class="form-control" value="<?= $address_4 ?>" placeholder="Enter address 4">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="sop[city]" class="form-control" value="<?= $city ?>" placeholder="Enter city">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="sop[distributor_name]" class="form-control" value="<?= $distributor_name ?>" placeholder="Enter distributor name">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="sop[telephone_1]" class="form-control" value="<?= $telephone_1 ?>" placeholder="Enter telephone 1">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="sop[telephone_2]" class="form-control" value="<?= $telephone_2 ?>" placeholder="Enter telephone 2">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="sop[fax_1]" class="form-control" value="<?= $fax_1 ?>" placeholder="Enter fax 1">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="sop[fax_2]" class="form-control" value="<?= $fax_2 ?>" placeholder="Enter fax 2">
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
			<div class="col-md-6">
				<form id="frmLocation" role="form" action="<?= base_url('index.php/distributor/saveDistributorWarehouse') ?>" method="post">
                    <fieldset>
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Distributor Warehouse</h3> (Enter Distributor Warehouse Details)  <a class="btn btn-success pull-right btn-sm" href="<?= base_url('index.php/distributor/createDistributorWarehouse/') ?>"><i class="fa fa-plus"></i> New</a>                              
                            </div><!-- /.box-header -->
							<?php
							
							$wharehouse_code='';
							$wharehouse_name='';
							$whid = 'new';
							$isWhactval = 'checked="checked"';
							$isWhdelval = '';
							$btnmsgWh = 'Create Warehouse';
							$readLvl ='';
							if(!empty($DistributorWarehouse) && isset($DistributorWarehouse)){
								$wharehouse_code=$DistributorWarehouse->location_code;
								$wharehouse_name=$DistributorWarehouse->location_name;
								$whid=$DistributorWarehouse->distributor_id;
								$isact = $DistributorWarehouse->is_act;
								$isdel = $DistributorWarehouse->is_del;
								$readLvl = 'disabled=disabled';
								$btnmsg = 'Update Distributor';
								if ($isact == 1) {
									$isWhactval = 'checked="checked"';
								} else {
									$isWhactval = '';
								}
								if ($isdel == 1) {
									$isWhdelval = 'checked="checked"';
								} else {
									$isWhdelval = '';
								}
								$readLvl = 'disabled=disabled';
								$btnmsgWh ='Update Warehouse';
							}
							?>
                            <div class="box-body">
								<div class="form-group">
                                    <input type="text" <?=$readLvl?> name="sop[agency_warehouse_code]" class="form-control" value="<?= $wharehouse_code ?>" placeholder="Enter Code of Warehouse">
                                </div>
								<div class="form-group">
                                    <input type="text" name="sop[agency_warehouse_name]" class="form-control" value="<?= $wharehouse_name ?>" placeholder="Enter Name of Warehouse">
                                </div>
								<div class="form-group"> 
                                    <div class="checkbox icheck" style="padding-left: 20px;">
                                        <label><input type="checkbox" <?= $isWhactval ?> name="sop[agency_warehouse_isact]" class="" value="1" placeholder="is active or not"> Is Active</label>
                                    </div>  
                                </div> 
								<div class="form-group"> 
                                    <div class="checkbox icheck" style="padding-left: 20px;">
                                        <label><input type="checkbox" <?= $isWhdelval ?> name="sop[agency_warehouse_isdel]" class="" value="1" placeholder="is deleted or not"> Is Deleted</label>
                                    </div>  
                                </div>
							</div>
							<div class="box-footer">
                                <input type="hidden" name="sop[agency_warehouse_id]" value="<?php
                                if (!empty($whid) && isset($whid)) {
                                    echo $whid;
                                } else {
                                    echo 'new';
                                }
                                ?>">
								<input type="hidden" name="sop[distributor_id]" value="<?=$lid?>">
                                <button type="submit" class="btn btn-primary pull-right"><?= $btnmsgWh ?></button>
                            </div>         
						</div>	
						
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title">Distributor Warehouse List</h3> (Click Edit to change details)
							</div><!-- /.box-header -->
							<div class="box-body" >
								<table class="table table-bordered" id="example1">
									<thead>
										<tr>
											<th style="width: 180px">System ID</th>
											<th style="width: 180px">Warehouse Code</th>
											<th style="width: 180px">Warehouse Name</th>
											<th style="width: 80px">Status</th>
											<th style="width: 40px">&nbsp;</th>										
										</tr>
									</thead>
									<tbody>
										<?php
										if(!empty($DistributorWarehouseData) && isset($DistributorWarehouseData)){
											foreach($DistributorWarehouseData as $w){
												$action = 0;
												if (!empty($w) && isset($w['is_act']) && $w['is_act'] == 1) {
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
												
												if (!empty($w) && isset($w['is_del']) && $w['is_del'] == 1) {
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
												echo '<tr>';
												echo '<td>'.$w['id'].'</td>';
												echo '<td>'.$w['location_code'].'</td>';
												echo '<td>'.$w['location_name'].'</td>';
												echo '<td><a class="btn btn-xs btn-' . $class . '" onclick="deleteData(\'' . $w['id'] . '\',\'update\',' . $action . ');">' . $status . '</a></td>';
												echo '<td><a class="btn btn-primary btn-xs" href="' . base_url('index.php/distributor/createDistributor/' . $w['distributor_id'].'/null/'.$w['id']) . '">Edit</a></td>';
												echo '</tr>';
											}
										}
										?>
									</tbody>
								</table>
							</div>	
						</div>	
					</fieldset>
				</form>			
			</div>
            <!--Right Side Content-->
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sales Distributor List</h3> (Click Edit to change details)
                    </div><!-- /.box-header -->
                    <div class="box-body" ng-app="Distributor" ng-controller="distributorController">
                        <table class="table table-bordered" id="example1">
						<thead>
                            <tr>
                                <th style="width: 180px">System ID</th>
                                <th style="width: 180px">Agency Code</th>
                                <th style="width: 180px">Agency Name</th>
                                <th style="width: 180px">Address 1</th>
                                <th style="width: 180px">Address 2</th>
                                <th style="width: 180px">Address 3</th>
                                <th style="width: 180px">Address 4</th>
                                <th style="width: 180px">City</th>
                                <th style="width: 180px">Distributor Name</th>
                                <th style="width: 180px">Telephone 1</th>
                                <th style="width: 180px">Telephone 2</th>
                                <th style="width: 180px">Fax 1</th>
                                <th style="width: 180px">Fax 2</th>
                                <th style="width: 80px">Status</th>
                                <th style="width: 40px">&nbsp;</th>
                                <th style="width: 40px">&nbsp;</th>
                                
                            </tr>
							</thead>
							<tbody>
							
							<tr ng-repeat="d in distributorList">
								<td>{{d.id}}</td>
								<td>{{d.agency_code}}</td>
								<td>{{d.agency_name}}</td>
								<td>{{d.address_1}}</td>
								<td>{{d.address_2}}</td>
								<td>{{d.address_3}}</td>
								<td>{{d.address_4}}</td>
								<td>{{d.city}}</td>
								<td>{{d.distributor_name}}</td>
								<td>{{d.telephone_1}}</td>
								<td>{{d.telephone_2}}</td>
								<td>{{d.fax_1}}</td>
								<td>{{d.fax_2}}</td>
								<td> </td>
								<td><a class="btn btn-primary btn-xs" href="<?=base_url('index.php/distributor/createDistributor/{{d.id}}')?>">Edit</a></td>
								<td> </td>
							</tr>
							
                            <?php
							/*
							if(!empty($DistributorDataSet) && isset($DistributorDataSet)){
								foreach ($DistributorDataSet as $loc) {
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
											<td>' . $loc['id'] . '</td>
											<td>' . $loc['agency_code'] . '</td>
											<td>' . $loc['agency_name'] . '</td>
											<td>' . $loc['address_1'] . '</td>
											<td>' . $loc['address_2'] . '</td>
											<td>' . $loc['address_3'] . '</td>
											<td>' . $loc['address_4'] . '</td>
											<td>' . $loc['city'] . '</td>
											<td>' . $loc['distributor_name'] . '</td>
											<td>' . $loc['telephone_1'] . '</td>
											<td>' . $loc['telephone_2'] . '</td>
											<td>' . $loc['fax_1'] . '</td>
											<td>' . $loc['fax_2'] . '</td>
											<td><a class="btn btn-xs btn-' . $class . '" onclick="deleteData(\'' . $loc['id'] . '\',\'update\',' . $action . ');">' . $status . '</a></td>
											<td><a class="btn btn-primary btn-xs" href="' . base_url('index.php/distributor/createDistributor/' . $loc['id']) . '">Edit</a></td>
											<td><a class="btn btn-danger btn-xs" onclick="deleteData(\'' . $loc['id'] . '\',\'delete\','.$delAction.');">Delete</a></td>
											 </tr>';
								}
							}*/
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
		$http.get('<?=base_url('distributor/getDistributor/')?>').then(function(mydata){
			console.log(mydata);
			$scope.distributorList = mydata.data; 
		});
	});
</script>