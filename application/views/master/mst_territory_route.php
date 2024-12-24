<?php include_once BASEPATH . ('../application/views/template/leftsidebar.php'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Sales Geography - Map Territory and Route Architecture
            <small>Maintain Secondary Map Territory and Route Details </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Master Data Control Module</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-5">
                <div id="successMessage" class="hideDiv">Updated Successfully! </div>
                <div id="errorMessage" class="hideDiv">Invalid Data! Please Try Again. </div>
                <div class="keepgap"></div>  
                <?php
                $territory_id = '';
                $route_id = '';
                $lid = 'new';
                $isactval = 'checked="checked"';
				$isdelval = '';
                $btnmsg = 'Create Territory-Route Mapping';
                if (!empty($TerritoryRouteData) && isset($TerritoryRouteData)) {
                    $lid = $TerritoryRouteData->id;
					$territory_id = $TerritoryRouteData->territory_id;
                    $route_id = $TerritoryRouteData->route_id;
                    $isact = $TerritoryRouteData->is_act;
					$isdel = $TerritoryRouteData->is_del;
                    $readLvl = 'disabled=disabled';
                    $btnmsg = 'Update Territory-Route Mapping';
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


                <form id="frmLocation" role="form" action="<?= base_url('index.php/master/saveTerritoryRoute') ?>" method="post">
                    <fieldset>
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Map Territory-Area Geography Layers</h3> (Enter Details)  <a class="btn btn-success pull-right btn-sm" href="<?= base_url('index.php/master/mapTerritoryRoute/') ?>"><i class="fa fa-plus"></i> New</a>                              
                            </div><!-- /.box-header -->
                            <div class="box-body">
								
                                <div class="form-group">
                                    <?php
									if(!empty($TerritoryDataSet) && isset($TerritoryDataSet)){
										?>
										<select name="sop[territory_id]" class="form-control">
										<option value="">-- Select Territory --</option> 
										<?php
										foreach($TerritoryDataSet as $r){
											$select='';
											if($territory_id==$r['id']){$select='selected="selected"';}
											?>
											<option <?=$select?> value="<?=$r['id']?>"><?=$r['territory_name']?></option> 
											<?php
										}
										?>
										</select>
										<?php
									}
									?>
                                </div>
                                <div class="form-group">
                                    <?php
									if(!empty($RouteDataSet) && isset($RouteDataSet)){
										?>
										<select name="sop[route_id]" class="form-control">
										<option value="">-- Select Route --</option> 
										<?php
										foreach($RouteDataSet as $a){
											$select='';
											if($route_id==$a['id']){$select='selected="selected"';}
											?>
											<option <?=$select?> value="<?=$a['id']?>"><?=$a['route_name']?></option> 
											<?php
										}
										?>
										</select>
										<?php
									}
									?>
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
            <div class="col-md-7">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sales Area-Territory Mapping List</h3> (Click Edit to change details)
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered" id="example1">
							<thead>
                            <tr>
                                <th style="width: 180px">Region</th>
                                <th style="width: 180px">Region Code</th>
                                <th style="width: 180px">Area</th>
                                <th style="width: 180px">Area Code</th>
                                <th style="width: 180px">Territory</th>
                                <th style="width: 180px">Territory Code</th>
                                <th style="width: 180px">Route</th>
                                <th style="width: 180px">Route Code</th>
                                <th style="width: 80px">Status</th>
                                <th style="width: 40px">&nbsp;</th>
                                <th style="width: 40px">&nbsp;</th>
                                
                            </tr>
							</thead>
							<tbody>
                            <?php
							if(!empty($TerritoryRouteDataSet) && isset($TerritoryRouteDataSet)){
								foreach ($TerritoryRouteDataSet as $loc) {
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
											<td>' . $loc['region_name'] . '</td>
											<td>' . $loc['region_id'] . '</td>
											<td>' . $loc['area_name'] . '</td>
											<td>' . $loc['area_id'] . '</td>
											<td>' . $loc['territory_name'] . '</td>
											<td>' . $loc['reference_code'] . '</td>
											<td>' . $loc['route_name'] . '</td>
											<td>' . $loc['route_reference_code'] . '</td>
											<td><a class="btn btn-xs btn-' . $class . '" onclick="deleteData(\'' . $loc['id'] . '\',\'update\',' . $action . ');">' . $status . '</a></td>
											<td><a class="btn btn-primary btn-xs" href="' . base_url('index.php/master/mapTerritoryRoute/' . $loc['id']) . '">Edit</a></td>
											<td><a class="btn btn-danger btn-xs" onclick="deleteData(\'' . $loc['id'] . '\',\'delete\','.$delAction.');">Delete</a></td>
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




<!-- jQuery 2.1.4 -->
<script src="<?= base_url('adminlte/plugins/jQuery/jQuery-2.1.4.min.js') ?>"></script>        
<script src="<?= base_url('adminlte/dist/js/validate/jquery.validate.min.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('adminlte/dist/js/validate/placeholders.min.js') ?>" type="text/javascript"></script>

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