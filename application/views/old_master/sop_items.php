<?php include_once BASEPATH . ('../application/views/template/leftsidebar.php'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Sales Item Names
            <small>Maintain Secondary Sales Item Details </small>
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
                $locname = '';
                $locadd = '';
                $asm = '';
                $ase = '';
                $chead = '';
                $readLvl = '';
				$id='';
                $lid = 'new';
				$readLvl='';
				$oplid ='';                
                $btnmsg = 'Create Sales Area';
                if (!empty($areaData) && isset($areaData)) {
                    $id=$lid = $areaData->area_cd;
					$locname = $areaData->area_name;
                    $ase = $areaData->area_ase;
                    $asm = $areaData->area_asm;
                    $chead = $areaData->ch_head;
                    $readLvl = 'readonly';
                    $btnmsg = 'Update Sales Area';                    
                }
                ?>


                <form id="frmLocation" role="form" action="<?= base_url('index.php/old_master/updateSalesArea') ?>" method="post">
                    <fieldset>
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Sales Area Details</h3> (Enter Sales Area Details)  <a class="btn btn-success pull-right btn-sm" href="<?= base_url('index.php/old_master/salesArea/') ?>"><i class="fa fa-plus"></i> New</a>                              
                            </div><!-- /.box-header -->
                            <div class="box-body">
								<div class="form-group">                                    
									<input type="text" name="sop[lid]" class="form-control" <?=$readLvl?> value="<?= $id ?>" placeholder="Enter Area Number (Number)">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="sop[name]" class="form-control" value="<?= $locname ?>" placeholder="Enter Name for the Area">
                                </div>
                                <div class="form-group"> 
                                    <input type="text" name="sop[ase]" class="form-control" value="<?= $ase ?>" placeholder="Enter ASE Name">                                   
                                </div> 
								<div class="form-group"> 
                                    <input type="text" name="sop[asm]" class="form-control" value="<?= $asm ?>" placeholder="Enter ASE Name">                                   
                                </div> 
								<div class="form-group"> 
                                    <input type="text" name="sop[chead]" class="form-control" value="<?= $chead ?>" placeholder="Enter Name of Channel Head"> 
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
                        <h3 class="box-title">Sales Area List</h3> (Click Edit to change details)
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered" id="example1">
                            <tr>
                                <th style="width: 180px">Sales Code </th>
                                <th style="width: 180px">Sales Area</th>
                                <th style="width: 80px">ASE</th>
                                <th style="width: 40px">ASM</th>
                                <th style="width: 40px">Head</th>
                                <th style="width: 40px">&nbsp;</th>
                                
                            </tr>
                            <?php
                            foreach ($areaList as $loc) {
                                $class='info';
                                echo '<tr class="info">
                                        <td>' . $loc['area_cd'] . '</td>
                                        <td>' . $loc['area_name'] . '</td>
										<td>' . $loc['area_ase'] . '</td>
										<td>' . $loc['area_asm'] . '</td>
										<td>' . $loc['ch_head'] . '</td>
										<td><a class="btn btn-xs btn-' . $class . '" href="'.base_url('old_master/salesArea/'.$loc['area_cd']).'">Edit</a></td>
                                        </tr>';
                            }
                            ?>                   
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