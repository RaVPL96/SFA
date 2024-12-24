<?php include_once BASEPATH . ('../application/views/template/leftsidebar.php'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Sales Geography - Map Range, Outlet Architecture
            <small>Maintain Secondary Allowed Outlet Details </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Master Data Control Module</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!--Right Side Content-->
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sales Territory - Outlet and Range Mapping List</h3> (Click Allocate to allow outlets)
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered" id="example1">
                            <thead>
                                <tr>
                                    <th style="width: 180px">ID</th>
                                    <th style="width: 180px">Range</th>
                                    <th style="width: 180px">Region</th>
                                    <th style="width: 180px">Region Code</th>
                                    <th style="width: 180px">Area</th>
                                    <th style="width: 180px">Area Code</th>
                                    <th style="width: 180px">Territory</th>
                                    <th style="width: 180px">Territory Code</th>
                                    <th style="width: 80px">Current Territory</th>
                                    <th style="width: 40px">Current Territory Code</th>
                                    <th style="width: 40px">Agency</th>
                                    <th style="width: 40px">Assign Outlets</th>
                                    <th style="width: 40px">Add for Outlet Update</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($GeoDataSet) && isset($GeoDataSet)) {
                                    foreach ($GeoDataSet as $loc) {
                                        $action = 0;
                                        echo '<tr class="info">
											<td>' . $loc['id'] . '</a></td>
											<td>' . $loc['range_name'] . '</td>
											<td>' . $loc['region_name'] . '</td>
											<td>' . $loc['region_code'] . '</td>
											<td>' . $loc['area_name'] . '</td>
											<td>' . $loc['area_id'] . '</td>
											<td>' . $loc['territory_name'] . '</td>
											<td>' . $loc['territory_reference_code'] . '</td>
											<td>' . $loc['current_territory_name'] . '</td>
											<td>' . $loc['current_territory_reference_code'] . '</td>
											<td>' . $loc['agency_name'] . '</td>
                                                                                        <td><a target="_blank" href="' . base_url('master/saveOutletRange/' . $loc['range_id'] . '/' . $loc['range_name'] . '/' . $loc['territory_id']) . '">Assign Outlets</td>
                                                                                        <td><a target="_blank" href="' . base_url('master/addToOutletUpdate/' . $loc['range_id'] . '/' . $loc['range_name'] . '/' . $loc['territory_id']) . '">Add to Outlets Update</td>'
                                                
                                        . '</tr>';
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
        highlight: function (element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function (error, element) {
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
    $('#module').change(function () {
        var modID = $('#module').val();
        //alert(modID);
        $.ajax({
            type: "post",
            url: "<?php echo base_url('index.php/users/getFunctions'); ?>",
            data: 'mid=' + modID,
            success: function (feed) {
                $('#uploading').modal('hide');
                //alert(feed);
                $('#fwrap').empty().append(feed);

            },
            error: function (feed) {
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
                success: function (feed) {
                    if (feed.trim() == '1') {
                        //swal("Updated!", "Your data is now updated.", "success");
                        window.location.reload();
                    } else {
                        swal("Error!", "Unable to process your request", "error");
                    }
                },
                error: function (feed) {
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
                    function () {
                        $.ajax({
                            type: "post",
                            url: "<?php echo base_url('index.php/items/updateLocData'); ?>",
                            data: 'id=' + uid + '&reqType=' + reqType + '&upVal=' + upval,
                            success: function (feed) {
                                if (feed.trim() == '1') {
                                    swal("Updated!", "Your data is now updated.", "success");
                                    window.location.reload();
                                } else {
                                    swal("Error!", "Unable to process your request", "error");
                                }
                            },
                            error: function (feed) {
                                swal("Error!", "Unable to process your request", "error");
                            }
                        });
                    });
        }
    }
</script>