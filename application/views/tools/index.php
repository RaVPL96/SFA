<?php include_once BASEPATH . ('../application/views/template/leftsidebar.php'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
			SMS List
            <small>Maintain Additional Tools </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Additional Tool Control Module</li>
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
                $locname = '';
                $locadd = '';
                $locphone = '';
                $locemail = '';
                $locweb = '';
                $readLvl = '';
                $lid = 'new';
				$oplid ='';
				$sopaid='';
				$territoryid='';
                $isactval = 'checked="checked"';
				$isdelval = '';
                $btnmsg = 'Load Sales Rep List';
                if (!empty($OpAreaTerritorySalesRepData) && isset($OpAreaTerritorySalesRepData)) {
                    $terrritoryname = $OpAreaTerritorySalesRepData->name;
                    $lid = $OpAreaTerritorySalesRepData->id;
					$oplid = $sop_id;
					$sopaid = $OpAreaTerritorySalesRepData->sopa_id;
					$territoryid= $OpAreaTerritorySalesRepData->territory_id;
					$repUser=$OpAreaTerritorySalesRepData->rep_username;
                    $isact = $OpAreaTerritorySalesRepData->isact;
					$isdel = $OpAreaTerritorySalesRepData->isdel;
                    $readLvl = 'disabled=disabled';
                    $btnmsg = 'Load Sales Rep';
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


                <form id="frmLocation" role="form" action="<?= base_url('index.php/additionaltools/SMSLists') ?>" method="post">
                    <fieldset>
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Territory Sales Rep and SMS Mapping</h3><br>(Select One Sale Operation)  <a class="btn btn-success pull-right btn-sm" href="<?= base_url('index.php/master/sopAreaTerritory/') ?>"><i class="fa fa-plus"></i> New</a>                              
                            </div><!-- /.box-header -->
                            <div class="box-body">
								<div class="form-group">
                                    <select <?php if($oplid!=''){/*echo 'disabled="disabled" ';*/ }?> class="form-control" id="Operation" name="sms[sop_id]">
										<option value="">--Select Sales Operation--</option>
										<?php
										if(!empty($OpData) && isset($OpData)){
											foreach($OpData as $op){
												$select='';
												if($oplid==$op['id']){
													$select='selected="selected"';
												}
												echo '<option '.$select.' value="'.$op['id'].'">'.$op['name'].'</option>';
											}
										}
										?>
									</select>
									<?php if($oplid!=''){/*echo '<input type="hidden" name="sop[sopid]" class="form-control" value="'.$oplid.'">';*/ }?>
                                </div>
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                
                                <button type="submit" class="btn btn-primary pull-right"><?= $btnmsg ?></button>
                            </div>                            
                        </div><!-- /.box -->
						
                    </fieldset>
                </form>
				<form id="frmSMSList" role="form" action="<?= base_url('index.php/additionaltools/SMSListsSave') ?>" method="post">
                    <?php 
						$id='new';
						$isactval = 'checked="checked"';
						$isdelval = '';
						$btnmsg = 'Save SMS List';
						$campName='';
						if(!empty($SMSListData) && isset($SMSListData)){
							$campName=$SMSListData->name;
							$id=$SMSListData->id;
						}
					?>
					<fieldset>
							<div class="box">
								<div class="box-body">
									<div class="form-group"> 
										<input type="text" name="sms[name]" class="form-control" value="<?=$campName?>" placeholder="SMS Campaign Name">  
									</div> 
									<div class="form-group">
									<label>Assign Sales Rep for SMS List</label><br>
											<?php
											//print_r($RepListSMS);
											if (!empty($RepList) && isset($RepList)) {
												foreach ($RepList as $rep) {
													$slelect='';	
													$repUser='';
													if (!empty($RepListSMS) && isset($RepListSMS)) {
														foreach($RepListSMS as $SMSRep){
															//print_r($SMSRep);
															$repUser=$SMSRep['rep_username'];
															if($repUser==$rep['rep_username']){
																$slelect='checked="checked"';
															}
														}		
													}
													echo '<div class="col-md-6"><div class="checkbox icheck" style="padding-left: 20px;"><label><input type="checkbox" '.$slelect.' value="' . $rep['rep_username'] . '" name=sms[repnames][]"> ' . $rep['profname'] . '</label></div></div>';
												}
											}
											?>
											<input type="hidden" name="sms[sop_id]" value="<?php if (!empty($sop_id) && isset($sop_id)) {echo $sop_id;}?>"/>
											<input type="hidden" name="sms[id]" value="<?php
									if (!empty($id) && isset($id)) {
										echo $id;
									} else {
										echo 'new';
									}
									?>">
									</div>
									<div class="clearfix"></div><hr>
									<div class="form-group"> 
									
										<div class="checkbox icheck" style="padding-left: 20px;">
											<label><input type="checkbox" <?= $isactval ?> name="sms[isact]" class="" value="1" placeholder=""> Is Active</label>
										</div>  
									</div> 
									<div class="form-group"> 
										<div class="checkbox icheck" style="padding-left: 20px;">
											<label><input type="checkbox" <?= $isdelval ?> name="sms[isdel]" class="" value="1" placeholder=""> Is Deleted</label>
										</div>  
									</div>
								</div><!-- /.box-body -->
								<div class="box-footer">
									<input type="hidden" name="sms[campaign_id]" value="<?php
									if (!empty($id) && isset($id)) {
										echo $id;
									} else {
										echo 'new';
									}
									?>">
									<button type="submit" class="btn btn-primary pull-right"><?= $btnmsg ?></button>
								</div> 
							</div>
					</fieldset>
                </form>	

            </div>


            <!--Right Side Content-->
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">SMS List</h3> (Click Edit to change details) 
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered" id="example1">
                            <tr>
								<th style="width: 180px">SMS List ID</th>
								<th style="width: 180px">List Name</th>
                                <th style="width: 80px">Status</th>
                                <th style="width: 40px">&nbsp;</th>
                                <th style="width: 40px">&nbsp;</th>
                                
                            </tr>
                            <?php
                            foreach ($SMSList as $loc) {
                                $action = 0;
                                if (!empty($loc) && isset($loc['isact']) && $loc['isact'] == 1) {
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
                                echo '<tr class="info">
										<td>' . $loc['id'] . '</td>
                                        <td>' . $loc['name'] . '</td>
                                        <td><a class="btn btn-xs btn-' . $class . '" onclick="deleteData(\'' . $loc['id'] . '\',\'update\',' . $action . ');">' . $status . '</a></td>
                                        <td><a class="btn btn-primary btn-xs" href="' . base_url('index.php/additionaltools/SMSLists/' . $loc['id']) . '">Edit</a></td>
                                        <td><a class="btn btn-danger btn-xs" onclick="deleteData(\'' . $loc['id'] . '\',\'delete\',1);">Delete</a></td>
                                         </tr>';
                            }
                            ?>                   
                        </table>
                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix">
                       
                    </div>
                </div><!-- /.box -->
				<div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">SMS List</h3> (Click Edit to change details) 
                    </div><!-- /.box-header -->
                    <div class="box-body">
					<a class="btn btn-md btn-success" href="<?=base_url('software/RMIS-SMS-Delivery-Setup.zip')?>">Download RMIS-SMS-Delivery-Setup.zip</a>
					</div><!-- /.box-body -->
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
    $("#frmSMSList").validate({
        rules: {
            "sms[name]": {
                required: true
            },
            "sms[repnames]": {
                required: true
            }
        },
        messages: {
            "sms[name]": 'Please fill this field',
            "sms[repnames]": 'Please Select At Least One Rep'
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
    $('#Operation').change(function() {
		$('#areawrap').empty();
		$('#territoryList').empty();
        var modID = $('#Operation').val();
        //alert(modID);
        $.ajax({
            type: "post",
            url: "<?php echo base_url('index.php/master/getOperationAreasAjax'); ?>",
            data: 'opid=' + modID,
            success: function(feed) {
                $('#uploading').modal('hide');
                //alert(feed);
                $('#areawrap').empty().append(feed);

            },
            error: function(feed) {
                console.log('Ajax request not recieved!' + feed);
                $('#uploading').modal('hide');
            }
        });
        return false;
    });
	$(document).on('change','#areaid',function() {
        var modID = $('#areaid').val();
		$('#territoryList').empty();
        //alert(modID);
        $.ajax({
            type: "post",
            url: "<?php echo base_url('index.php/master/getOperationAreasTerritoryAjax'); ?>",
            data: 'opid=' + modID,
            success: function(feed) {
                $('#uploading').modal('hide');
                //alert(feed);
                $('#territoryList').empty().append(feed);

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