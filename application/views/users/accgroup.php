<?php include_once BASEPATH . ('../application/views/template/leftsidebar.php'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Users Groups
            <small>Allow/Restrict Staff Users Content Access</small>
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
                <div id="successMessage" class="hideDiv">Group Updated Successfully! </div>
                <div id="errorMessage" class="hideDiv">Invalid Data! Please Try Again. </div>
                <div class="keepgap"></div>  
                <?php
                $gpname = '';
                $readLvl = '';
                $gpid = 'new';
                $hidModule = '';
                $btnmsg = 'Create Group';
                if (!empty($grantgrpdata) && isset($grantgrpdata)) {
                    $gpname = $grantgrpdata->name;
                    $gpid = $grantgrpdata->id;
                    $modid = $grantgrpdata->modid;
                    $readLvl = 'disabled=disabled';
                    $hidModule = '<input type="hidden" name="group[module]" value="' . $modid . '">';
                    $btnmsg = 'Update Group';
                }
                ?>

                <?php if (!empty($modules) && isset($modules)) { ?>
                    <form role="form" id="frmGrp" action="<?= base_url('index.php/users/updateGrp') ?>" method="post">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">User Group Access Table</h3> (Tick the option and save to grant access in a group)  <a class="btn btn-success pull-right btn-sm" href="<?= base_url('index.php/users/createGrp') ?>"><i class="fa fa-plus"></i> New</a>                              
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="form-group">
                                    <input type="text" name="group[name]" class="form-control" value="<?= $gpname ?>" placeholder="Enter Name for the access group">
                                </div>
                                <div class="form-group">
                                    <select <?= $readLvl ?> class="form-control" name="group[module]" id="module">
                                        <option value="">-- Select Module --</option>
                                        <?php
                                        if (!empty($modules) && isset($modules)) {
                                            foreach ($modules as $module) {
                                                $sele = '';
                                                if ($modid == $module['id']) {
                                                    $sele = 'selected="selected"';
                                                } else {
                                                    $sele = '';
                                                }
                                                echo '<option ' . $sele . ' value="' . $module['id'] . '">' . $module['name'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <table class="table table-bordered">
                                    <tr>
                                        <th style="width: 10px">Grant</th>
                                        <th>Function Name</th>
                                        <th>Description</th>
                                        <th style="width: 40px">Current Status</th>
                                    </tr>
                                    <tbody id="fwrap"></tbody>
                                    <?php
                                    if (!empty($functions) && isset($functions)) {
                                        $arrGrant = array();
                                        foreach ($grantdata as $grant) {
                                            $arrGrant[] = $grant['module_function_id'];
                                        }
                                        //print_r($arrGrant);
                                        foreach ($functions as $func) {
                                            $chked = '';
                                            $class = '';
                                            $status = 'Inactive';
                                            if (in_array($func['id'], $arrGrant)) {
                                                $chked = 'checked';
                                                $class = 'bg-green';
                                                $status = 'Active';
                                            } else {
                                                $chked = '';
                                                $class = 'bg-yellow';
                                                $status = 'Inactive';
                                            }
                                            echo '<tr>';
                                            echo '<td><div class="checkbox"><label><input type="checkbox" name="group[auth][]" value="' . $func['id'] . '" ' . $chked . '/></label></div></td>';
                                            echo '<td><i class="' . $func['fa_icon'] . '"></i> ' . $func['display_name'] . '</td>';
                                            echo '<td>' . $func['comments'] . '</td>';
                                            echo '<td><span class="badge ' . $class . '">' . $status . '</span></td>';
                                            echo '</tr>';
                                        }
                                    }
                                    ?>                    
                                </table>
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <input type="hidden" name="group[id]" value="<?php
                                if (!empty($gpid) && isset($gpid)) {
                                    echo $gpid;
                                } else {
                                    echo 'new';
                                }
                                ?>">
                                       <?= $hidModule ?>
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
                <?php } ?>
            </div>


            <!--Right Side Content-->
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Staff User List</h3> (Click Edit to change permissions)
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 180px">Group Name</th>
                                <th>Module </th>
                                <th style="width: 80px">Status</th>
                                <th style="width: 40px">&nbsp;</th>
                                <th style="width: 40px">&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($grplist as $grp) {
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
                <td>' . $grp['name'] . '</td>
                <td>' . $grp['modname'] . '</td>
                   <td><a class="btn btn-xs btn-' . $class . '" onclick="deleteData(\'' . $grp['id'] . '\',\'update\',' . $action . ');">' . $status . '</a></td>
                        <td><a class="btn btn-primary btn-xs" href="' . base_url('index.php/users/createGrp/' . $grp['id']) . '">Edit</a></td>
                            <td><a class="btn btn-danger btn-xs" onclick="deleteData(\'' . $grp['id'] . '\',\'delete\',1);">Delete</a></td>
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

<!-- jQuery 2.1.4 -->
<script src="<?= base_url('adminlte/plugins/jQuery/jQuery-2.1.4.min.js') ?>"></script>        
<script src="<?= base_url('adminlte/dist/js/validate/jquery.validate.min.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('adminlte/dist/js/validate/placeholders.min.js') ?>" type="text/javascript"></script>

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

