<?php include_once BASEPATH . ('../application/views/template/leftsidebar.php'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Organization Structure
            <small>Allow/Restrict Staff Organization Structure</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Users Module</li>
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
                $gpname = '';
                $displayOrder = '';
                $gpid = 'new';
				$isactval='';
                $btnmsg = 'Create Grade';
				$hidModule='<input type="hidden" name="grade[id]" value="new">';
                if (!empty($GradeData) && isset($GradeData)) {
                    $gpname = $GradeData->grade_name;
                    $gpid = $GradeData->grade_id;
                    $displayOrder = $GradeData->display_order;
					$isact = $GradeData->isact;
					if ($isact == 1) {
                            $isactval = 'checked="checked"';
                        } else {
                            $isactval = '';
                        }
                    $readLvl = 'disabled=disabled';
                    $hidModule = '<input type="hidden" name="grade[id]" value="' . $gpid . '">';
                    $btnmsg = 'Update Group';
                }
                ?>

                    <form role="form" id="frmGrp" action="<?= base_url('index.php/users/updateOrgStructure') ?>" method="post">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">User Group Access Table</h3> (Tick the option and save to grant access in a group)  <a class="btn btn-success pull-right btn-sm" href="<?= base_url('index.php/users/createGrp') ?>"><i class="fa fa-plus"></i> New</a>                              
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="form-group">
                                    <input type="text" name="grade[name]" class="form-control" value="<?= $gpname ?>" placeholder="Enter Name for the Grade">
                                </div>
                                <div class="form-group">
									<div class="box box-info">
									<div class="box-header">Report To</div>
									<div class="box-body">
                                    <?php 
									if (!empty($Structure) && isset($Structure)) {
										foreach ($Structure as $stru) {
											$check='';
											if (!empty($ReportToData) && isset($ReportToData)) {
												foreach($ReportToData as $AlreadyReportTo){
													if($stru['grade_id']==$AlreadyReportTo['report_to_grade_id']){
														$check='checked="checked"';
													}
												}
											}
											echo '<label class="col-md-6"><input type="checkbox" '.$check.' name="grade[reportTo][]" value="'.$stru['grade_id'].'" /> '.$stru['grade_name'].'</label>';
										}
									}									
									?>
									</div>
									</div>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="grade[display]" class="form-control" value="<?= $displayOrder ?>" placeholder="Display Order">
                                </div>
								<div class="form-group has-feedback">    
									<div class="checkbox icheck">
										<label>
											<input type="checkbox" <?= $isactval ?> value="1" name="post[user][active]"> Is Active
										</label>
									</div>                        
								</div><!-- /.col -->
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <?=$hidModule?>
                                <button type="submit" name="submit" class="btn btn-primary pull-right"><?= $btnmsg ?></button>
                            </div>
                            <!--
                            <div class="box-footer clearfix">
                              <ul class="pagination pagination-sm no-margin pull-right">
                                <li><a href="#">&laquo;</a></li>
                                <li><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">&raquo;</a></li>
                              </ul>
                            </div>
                            -->
                        </div><!-- /.box -->
                    </form>
            </div>


            <!--Right Side Content-->
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Structure List</h3> (Click Edit to change)
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 180px">Grade ID</th>
                                <th>Grade Name </th>
                                <th style="width: 80px">Status</th>
                                <th style="width: 40px">&nbsp;</th>
                                <th style="width: 40px">&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($Structure as $grp) {
                                $action = 0;
                                if (!empty($grp) && isset($grp['isact']) && $grp['isact'] == 1) {
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
                <td>' . $grp['grade_id'] . '</td>
                <td>' . $grp['grade_name'] . '</td>
                   <td><a class="btn btn-xs btn-' . $class . '" onclick="deleteData(\'' . $grp['grade_id'] . '\',\'update\',' . $action . ');">' . $status . '</a></td>
                        <td><a class="btn btn-primary btn-xs" href="' . base_url('index.php/users/orgStructure/' . $grp['grade_id']) . '">Edit</a></td>
                            <td><a class="btn btn-danger btn-xs" onclick="deleteData(\'' . $grp['grade_id'] . '\',\'delete\',1);">Delete</a></td>
            </tr>';
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


<script type="text/javascript">

    $("#frmGrp").validate({
        rules: {
            "group[name]": {
                required: true
            },
            "group[module]": {
                required: true
            },
            "group[auth][]": {
                required: true
            }
        },
        messages: {
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
    });
</script>

<script type="text/javascript">
    var jq = jQuery().noConflict();
</script>   


<script type="text/javascript">
    function deleteData(uid, reqType, upval) {
        if (reqType == 'update') {
            $.ajax({
                type: "post",
                url: "<?php echo base_url('index.php/users/updateGrpData'); ?>",
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
                    url: "<?php echo base_url('index.php/users/updateGrpData'); ?>",
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
    }
    );



</script>

