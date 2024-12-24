<?php include_once BASEPATH . ('../application/views/template/leftsidebar.php'); ?>



<!-- Content Wrapper. Contains page content -->






<div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

        <h1>

            Create Service Job 

            <small></small>

        </h1>

        <ol class="breadcrumb">

            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

            <li class="active">Users Module</li>

        </ol>

    </section>



    <!-- Main content -->

    <section class="content">

        <div class="row">

            <div class="col-md-4">



                <div class="register-box-body">

                    <div id="successMessage" class="hideDiv"> Created Successfully! </div>

                    <div id="errorMessage" class="hideDiv">Invalid Data! Please Try Again. </div>

                    <div class="keepgap"></div>  

                    <?php
                    $name = '';
                    $vehiID = '';
                    $driverid = '';
                    $mobile = '';

                    $username = '';

                    $email = '';

                    $pass = '';

                    $repass = '';

                    $gradeid = '';

                    $areaid = '';

                    $readonly = '';

                    $msgt = 'Create a Job';

                    $btnmsg = 'Create';

                    $status = '';

                    $ischannelval = '';

                    $isoperationval = '';

                    $israngeval = '';

                    $isterritoryval = '';

                    $id = 'new';

                    $utype = '';

                    $prppic = $ppic = 'avatar5.png';

                    $custid = '';

                    $requestername = '';

                    $from = '';

                    $to = '';

                    $requrestdate = '';

                    $fromtime = '';

                    $todate = '';

                    $totime = '';

                    $rate = '';

                    $startmileage = '';

                    $endmileage = '';

                    $systemmileage = '';

                    $manualmileage = '';

                    $additionaldiesel = '';

                    $costname = '';

                    $cost = '';

                    $totalcost = '';

                    if (!empty($service) && isset($service)) {

                        $id = $service->id;
                        $utype = $service->department_id;
                        $driverid = $service->driver_id;
                        $requestername = $service->requester_name;
                        $vehiID = $service->vehicle_id;
                        $from = $service->from_location;

                        $to = $service->to_location;

                        $requrestdate = $service->request_date;

                        $fromtime = $service->from_time;

                        $todate = $service->to_date;

                        $totime = $service->to_time;

                        $rate = $service->rate;

                        $startmileage = $service->start_mileage;

                        $endmileage = $service->end_mileage;

                        $systemmileage = $service->system_mileage;

                        $manualmileage = $service->manual_mileage;

                        $additionaldiesel = $service->additional_diesel;

                        $totalcost = $service->total_cost;

                        //$ischannelval = $userdata->channel;
                        //$isoperationval = $userdata->operation;
                        //$israngeval = $userdata->range;
                        //$isterritoryval = $userdata->territory;
                        //$areaid=$userdata->area_id;


                        if ($service->status == 1) {
                            $status = 'checked="checked"';
                        }

                        $msgt = 'complete Job';

                        $btnmsg = 'Update';

                        $ppic = '<img style="width:80px;" src="' . base_url(PROFILEPICPATH . $prppic) . '"/>';
                    }
                    ?>

                    <p class="login-box-msg"><?= $msgt ?></p>                    

                    <form id="openacc" name="addem" novalidate="novalidate" action="<?= base_url('index.php/Logistics/saveService') ?>" method="post" enctype="multipart/form-data">

                        <div class="form-group has-feedback">

                            <select class="form-control" id="Department" name="post[user][department]" required >
                                <option value="">-- Select Department --</option>
                                <?php
                                foreach ($departmentList as $userType) {
                                    $select = '';
                                    if ($utype == $userType['id']) {
                                        $select = 'selected="selected"';
                                    }
                                    echo '<option ' . $select . ' value="' . $userType['id'] . '">' . $userType['name'] . '</option>';
                                }
                                ?>

                            </select>

                        </div>

                        <div class="form-group has-feedback">
                            <input type="text" name="post[user][requestername]" class="form-control" id="ReuesterName" placeholder="Requester Name" value="<?= $requestername ?>" required/>
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>  

                        <div class="form-group has-feedback">
                            <input type="text" name="post[user][from]" class="form-control" id="From" placeholder="From" value="<?= $from ?>" required/>
                            <span class="glyphicon glyphicon-map-marker form-control-feedback"></span>
                        </div>

                        <div class="form-group has-feedback">
                            <input type="text" name="post[user][to]" class="form-control" id="To" placeholder="To" value="<?= $to ?>" required/>
                            <span class="glyphicon glyphicon-map-marker form-control-feedback"></span>
                        </div>


                        <br>

                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar" align ="right"></i>
                            </div>
                            <input type="text" name="post[user][reqursetdate]" class="form-control pull-right" placeholder="Requrset Date" id="datepicker" value="<?= $requrestdate ?>" required > 
                        </div><br>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <input type="text" name="post[user][fromtime]" class="form-control timepicker" placeholder="Time" id="FromTime" value="<?= $fromtime ?>" required >

                        </div>
                        <br>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar" align ="right"></i>
                            </div>
                            <input type="text" name="post[user][todate]" class="form-control pull-right" placeholder="To Date"id="datepickerto" value="<?= $todate ?>" required >
                        </div>

                        <br>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <input type="text" name="post[user][totime]" class="form-control timepicker" placeholder="Time" id="ToTime" value="<?= $totime ?>" required >

                        </div>

                        <br>

                        <div class="form-group has-feedback">

                            <select class="form-control" id="Vehicle" name="post[user][vehicle]" required >

                                <option value="">-- Select Vehicle Number --</option>
                                <?php
                                foreach ($VehicleList as $dep) {

                                    $select = '';

                                    if ($vehiID == $dep['id']) {

                                        $select = 'selected="selected"';
                                    }

                                    echo '<option ' . $select . ' value="' . $dep['id'] . '">' . $dep['vehicle_no'] . '-' . $dep['type_of_vehicle'] . '</option>';
                                }
                                ?>

                            </select>

                        </div>
                        <div class="form-group has-feedback">

                            <select class="form-control" id="Driver" name="post[user][driver]" onchange="changeStatus()" required>

                                <option value="">-- Driver Select --</option>

                                <?php
                                foreach ($driverList as $dep) {

                                    $select = '';

                                    if ($driverid == $dep['id']) {

                                        $select = 'selected="selected"';
                                    }

                                    echo '<option ' . $select . ' value="' . $dep['id'] . '">' . $dep['name'] . '</option>';
                                }
                                ?>

                            </select>

                        </div>


                        <div class="form-group has-feedback">

                            <input type="text" <?= $readonly ?> name="post[user][rate]" class="form-control" id="rateVehi" placeholder="Vehicle Rate" value="<?= $rate ?> " onkeypress="return isNumberKey(this, event);"  required readonly />
                            <span class="glyphicon glyphicon-usd form-control-feedback"></span>


                        </div> 


                        <div class="form-group has-feedback">

                            <input type="text" name="post[user][startmileage]" class="form-control " id="StartMileage" placeholder="Start Mileage" value="<?= $startmileage ?>" onkeypress="return isNumberKey(this, event);"  />

                            <span class="glyphicon glyphicon-option-horizontal form-control-feedback"></span>

                        </div>

                        <div class="form-group has-feedback">

                            <input type="text" name="post[user][endmileage]" class="form-control" id="EndMileage" placeholder="End Mileage" value="<?= $endmileage ?>" onkeypress="return isNumberKey(this, event);"   />
                            <span class="glyphicon glyphicon-option-horizontal form-control-feedback"></span>


                        </div>



                        <div class="form-group has-feedback">

                            <input type="text" <?= $readonly ?> name="post[user][systemmileage]" class="form-control" id="SystemMileage" placeholder="System Mileage" value="<?= $systemmileage ?>"  readonly />



                        </div>

                        <div class="form-group has-feedback">

                            <input type="text" <?= $readonly ?> name="post[user][manualmileage]" class="form-control" id="ManualMileage" placeholder="ManualMileage" value="<?= $manualmileage ?>" onkeypress="return isNumberKey(this, event);"  readonly />



                        </div>

                        <div class="form-group has-feedback">

                            <input type="text" <?= $readonly ?> name="post[user][additionaldiesel]" class="form-control" id="AdditionalDiesel" placeholder="Additional Diesel Cost" value="<?= $additionaldiesel ?>" onkeypress="return isNumberKey(this, event);"  />
                            <span class="glyphicon glyphicon-usd form-control-feedback"></span>


                        </div>

                        <?php
                        if (!empty($serviceOther) && isset($serviceOther)) {
                            foreach ($serviceOther as $s) {
                                ?>
                                <div class="form-group has-feedback">

                                    <input type="text" <?= $readonly ?> name="post[user][costname]" class="form-control" id="CostName" placeholder="Other driver Cost Name" value="<?= $s['service_name'] ?>" />
                                    <span class="glyphicon glyphicon-option-horizontal form-control-feedback"></span>


                                </div>

                                <div class="form-group has-feedback">

                                    <input type="text" <?= $readonly ?> name="post[user][cost]" class="form-control" id="Cost" placeholder="Cost" value="<?= $s['cost'] ?>" onkeypress="return isNumberKey(this, event);"  />
                                    <span class="glyphicon glyphicon-usd form-control-feedback"></span>


                                </div> 
                                <?php
                            }
                        } else {
                            ?>
                            <div class="form-group has-feedback">

                                <input type="text" <?= $readonly ?> name="post[user][costname]" class="form-control" id="CostName" placeholder="Other driver Cost Name" value="" />
                                <span class="glyphicon glyphicon-option-horizontal form-control-feedback"></span>


                            </div>

                            <div class="form-group has-feedback">

                                <input type="text" <?= $readonly ?> name="post[user][cost]" class="form-control" id="Cost" placeholder="Cost" value="" onkeypress="return isNumberKey(this, event);"  />
                                <span class="glyphicon glyphicon-usd form-control-feedback"></span>


                            </div> 
                            <?php
                        }
                        ?>

                        <div class="form-group has-feedback">

                            <input type="text" <?= $readonly ?> name="post[user][totalcost]" class="form-control" id="TotalCost" placeholder="Total Cost" value="<?= $totalcost ?>" onkeypress="return isNumberKey(this, event);"  />
                            <span class="glyphicon glyphicon-usd form-control-feedback"></span>


                        </div> 
                        <div class="form-group has-feedback">    

                            <div class="checkbox icheck">

                                <label>

                                    <input type="checkbox" <?= $status ?> value="1" name="post[user][status]"> Mark As Completed Job

                                </label>

                            </div>                        

                        </div>




                        <div class="row form-group has-feedback ">                            

                            <div class="col-xs-4">



                                <input type="hidden" name="post[user][saveas]" class="form-control" value="<?= $id ?>"/>

                                <button type="submit" class="btn btn-primary btn-block btn-flat"><?= $btnmsg ?></button>

                            </div><!-- /.col -->

                        </div>

                    </form> 



                    <!--<a href="login.html" class="text-center">I already have a membership</a>-->

                </div><!-- /.form-box -->

            </div>
            <div class="col-md-12" style="overflow-x: scroll;">
                <div class="box">
                    <div class=" box-header with-border ">   

                        <h3>

                            Service Details 

                            <small></small>

                        </h3>
                    </div>
                    <div class="box-body">

                        <?php
                        echo "<table class=\"table table-dark table-striped\" id=\"example1\">";
                        echo "<thead>";
                        echo "<tr>"
                        . "<th>Service Id</th>"
                        . "<th>Department Name</th>"
                        . "<th>Driver ID</th>"
                        . "<th>vehicle No</th>"
                        /* . "<th>From</th>"
                          . "<th>To</th>" */
                        . "<th>From Date</th>"
                        . "<th>To Date</th>"
                        /* . "<th>Start_mileage</th>"
                          . "<th>End Mileage</th>" */
                        . "<th>System Mileage</th>"
                        /* . "<th>Manualt_mileage</th>"
                          . "<th>Additional Diesel</th>" */
                        . "<th>Total cost</th>"
                        . "<th>Status</th>"
                        . "<th></th>"
                        . "<th>Print Service</th>"
                        . "</tr>"
                        . "</thead>";

                        echo "<tbody>";

                        foreach ($ServiceList as $list) {
                            $str = '<span class="label label-warning">Booking</span>';
                            if ($list['status'] == 0) {
                                $str = '<span class="label label-warning">Booking</span>';
                            } elseif ($list['status'] == 1) {
                                $str = '<span class="label label-success">Completed</span>';
                            }
                            echo "<tr onclick=\"view_Service('" . $list['id'] . "')\" style=\"cursor: pointer;\">"
                            . "<td> " . $list['id'] . " </td>"
                            . "<td>" . $list['name'] . " </td>"
                            . "<td>" . $list['nic'] . "</td>"
                            . "<td>" . $list['vehicle_no'] . "</td>"
                            /* . "<td>" . $list['from_location'] . "</td>"
                              . "<td>" . $list['to_location'] . "</td>" */
                            . "<td>" . $list['request_date'] . "</td>"
                            . "<td>" . $list['to_date'] . "</td>"
                            /* . "<td>" . $list['start_mileage'] . "</td>"
                              . "<td>" . $list['end_mileage'] . "</td>" */
                            . "<td>" . $list['system_mileage'] . "</td>"
                            /* . "<td>" . $list['manual_mileage'] . "</td>"
                              . "<td>" . $list['additional_diesel'] . "</td>" */
                            . "<td>" . $list['total_cost'] . "</td>"
                            . "<td>" . $str . "</td>"
                            . "<td> <a class=\"btn btn-primary btn-xs\" href=\"" . base_url("index.php/logistics/service/null/" . $list['id']) . "\">Edit</a></td>"
                            . "<td><button type=\"Submit\" class=\"btn btn-xs btn-success\">Print</button> </td>"
                            . "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                        ?>



                    </div>
                </div>
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



                                $("#openacc").validate({

                                    rules: {

                                        "post[user][type]": {

                                            required: true

                                        },

                                        "job[cusname]": {

                                            required: true

                                        },

                                        "job[cusid]": {

                                            required: true

                                        },

                                        "post[user][profname]": {

                                            required: true

                                        },

                                        "post[user][umobile]": {

                                            required: true

                                        },

                                        "post[user][email]": {

                                            required: true,

                                            email: true

                                        },

                                        "post[user][uname]": {

                                            required: true

                                        },

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

    var jq = jQuery().noConflict();

</script>   



<!-- Custom Error Messages -->

<script src="<?= base_url('adminlte/custom.js') ?>" type="text/javascript"></script>

<script type="text/javascript">
<?php if (!empty($msg) && isset($msg)) { ?>
        callMessage('<?= $msg ?>', '');
<?php } ?>
</script>


<script>
    $('#EndMileage').on('keyup change', function () {
        CalMileage();
    });
    $('#StartMileage').on('keyup change', function () {
        CalMileage();
    });
    function CalMileage() {
        var StartMileage = 0;
        var EndMileage = 0;
        if ($('#StartMileage').val() !== '') {
            //alert('a');
            StartMileage = parseFloat($('#StartMileage').val());
        }
        if ($('#EndMileage').val() !== '') {
            //alert('b');
            EndMileage = parseFloat($('#EndMileage').val());
        }

        var result = EndMileage - StartMileage;
        $('#SystemMileage').val(result.toFixed(2));
        calTotal();
    }
</script>

<script type="text/javascript">
    function isNumberKey(txt, evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode == 46) {
            //Check if the text already contains the . character
            if (txt.value.indexOf('.') === -1) {
                return true;
            } else {
                return false;
            }
        } else {
            if (charCode > 31 &&
                    (charCode < 48 || charCode > 57))
                return false;
        }
        return true;
    }
</script>
<script>
    $('#Cost').on('keyup change', function () {
        calTotal();

    });
    $('#rateVehi').on('keyup change', function () {
        calTotal();

    });

    $('#AdditionalDiesel').on('keyup change', function () {
        calTotal();

    });
    function calTotal() {
        var SystemMileage = 0;
        var AdditionalDiesel = 0;
        var rateVehi = 0;
        var Cost = 0;


        if ($('#SystemMileage').val() !== '') {
            //alert('b');
            SystemMileage = parseFloat($('#SystemMileage').val());
        }
        if ($('#AdditionalDiesel').val() !== '') {
            //alert('z');
            AdditionalDiesel = parseFloat($('#AdditionalDiesel').val());
        }
        if ($('#Cost').val() !== '') {
            //alert('z');
            Cost = parseFloat($('#Cost').val());
        }


        rateVehi = parseFloat($('#rateVehi').val());

        if ($('#Cost').val() !== '') {
            // alert('z');
            Cost = parseFloat($('#Cost').val());
        }



        var total = (SystemMileage * rateVehi) + AdditionalDiesel + Cost;
        $('#TotalCost').val(total.toFixed(2));
    }

</script>














