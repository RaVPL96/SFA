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

                    $isactval = 'checked="checked"';

                    $ischannelval = '';

                    $isoperationval = '';

                    $israngeval = '';

                    $isterritoryval = '';

                    $id = 'new';

                    $utype = '';

                    $prppic = $ppic = 'avatar5.png';

                    $custid = '';

                    $from = '';

                    $to = '';

                    $requrestdate = '';

                    $startmileage = '';

                    $endmileage = '';

                    $systemmileage = '';

                    $manualmileage = '';

                    $additionaldiesel = '';

                    $costname = '';

                    $cost = '';

                    $totalcost = '';

                    if (!empty($userdata) && isset($userdata)) {

                        $from = $userdata->from;

                        $to = $userdata->to;

                        $requrestdate = $userdata->requrestdate;

                        $startmileage = $userdata->startmileage;

                        $endmileage = $userdata->endmileage;

                        $systemmileage = $userdata->systemmileage;

                        $manualmileage = $userdata->manualmileage;

                        $additionaldiesel = $userdata->additionaldiesel;

                        $costname = $userdata->costname;

                        $cost = $userdata->cost;

                        $totalcost = $userdata->totalcost;

                        $isact = $userdata->active;

                        //$ischannelval = $userdata->channel;
                        //$isoperationval = $userdata->operation;
                        //$israngeval = $userdata->range;
                        //$isterritoryval = $userdata->territory;
                        //$areaid=$userdata->area_id;

                        $utype = $userdata->role;

                        $departmentID = $userdata->departmentID;

                        $gradeid = $userdata->grade_id;

                        $custid = $userdata->cus_id;

                        if ($isact == 1) {

                            $isactval = 'checked="checked"';
                        } else {

                            $isactval = '';
                        }

                        $readonly = 'readonly="readonly"'; //set username readonly

                        $id = $username;

                        $pass = '';

                        $repass = '';

                        $msgt = 'Modify User data (leave password field blank if you do not want to change)';

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

                                    /* if ($utype == $userType['id']) {

                                      $select = 'selected="selected"';

                                      } */

                                    echo '<option ' . $select . ' value="' . $userType['id'] . '">' . $userType['name'] . '</option>';
                                }
                                ?>

                            </select>

                        </div>


                        <div class="form-group has-feedback">

                            <select class="form-control" id="Vehicle" name="post[user][vehicle]" required >

                                <option value="">-- Select Vehicle Number --</option>

                                <?php
                                foreach ($VehicleList as $dep) {

                                    $select = '';

                                    /* if ($departmentID == $dep['id']) {

                                      $select = 'selected="selected"';

                                      } */

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

                                    /* if ($gradeid == $dep['grade_id']) {

                                      $select = 'selected="selected"';

                                      } */

                                    echo '<option ' . $select . ' value="' . $dep['id'] . '">' . $dep['name'] . '</option>';
                                }
                                ?>

                            </select>

                        </div>



                        <div class="form-group has-feedback">

                        </div>

                        <div class="form-group has-feedback">

                            <input type="text" name="post[user][from]" class="form-control" id="From" placeholder="From" value="<?= $from ?>" required/>



                        </div>

                        <div class="form-group has-feedback">

                            <input type="text" name="post[user][to]" class="form-control" id="To" placeholder="To" value="<?= $to ?>" required/>



                        </div>

                        <div class="form-group has-feedback">

                            <input type="text" name="post[user][reqursetdate]" class="form-control" id="ReqursetDate" placeholder="Requrset Date" value="<?= $requrestdate ?>" required />



                        </div>

                        <div class="form-group has-feedback">

                            <input type="text" name="post[user][startmileage]" class="form-control" id="StartMileage" placeholder="Start Mileage" value="<?= $startmileage ?>" onkeypress="return isNumberKey(this, event);"  required/>



                        </div>

                        <div class="form-group has-feedback">

                            <input type="text" name="post[user][endmileage]" class="form-control" id="EndMileage" placeholder="End Mileage" value="<?= $endmileage ?>" onkeypress="return isNumberKey(this, event);"  required />



                        </div>



                        <div class="form-group has-feedback">

                            <input type="text" <?= $readonly ?> name="post[user][systemmileage]" class="form-control" id="SystemMileage" placeholder="System Mileage" value="<?= $systemmileage ?>" required readonly />



                        </div>

                        <div class="form-group has-feedback">

                            <input type="text" <?= $readonly ?> name="post[user][manualmileage]" class="form-control" id="ManualMileage" placeholder="ManualMileage" value="<?= $manualmileage ?>" onkeypress="return isNumberKey(this, event);"  />



                        </div>

                        <div class="form-group has-feedback">

                            <input type="text" <?= $readonly ?> name="post[user][additionaldiesel]" class="form-control" id="AdditionalDiesel" placeholder="Additional Diesel Cost" value="<?= $additionaldiesel ?>" onkeypress="return isNumberKey(this, event);"  />



                        </div>

                        <div class="form-group has-feedback">

                            <input type="text" <?= $readonly ?> name="post[user][costname]" class="form-control" id="CostName" placeholder="Other driver Cost Name" value="<?= $costname ?>" />



                        </div>

                        <div class="form-group has-feedback">

                            <input type="text" <?= $readonly ?> name="post[user][cost]" class="form-control" id="Cost" placeholder="Cost" value="<?= $cost ?>" onkeypress="return isNumberKey(this, event);"  />



                        </div> 

                        <div class="form-group has-feedback">

                            <input type="text" <?= $readonly ?> name="post[user][totalcost]" class="form-control" id="TotalCost" placeholder="Total Cost" value="<?= $totalcost ?>" onkeypress="return isNumberKey(this, event);"  required />



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
            <div class="col-md-8">
                <div class="box">
                    <div class=" box-header with-border ">   

                        <h3>

                            Print Details 

                            <small></small>

                        </h3>

                        <?php
                        echo "<table class=\"table\">";
                        echo "<tr>"
                        . "<th>Service Id</th>"
                        . "<th>Department Name</th>"
                        . "<th>Driver ID</th>"
                        . "<th>vehicle No</th>"
                        . "<th>From</th>"
                        . "<th>To</th>"
                        . "<th>Date</th>"
                        /* . "<th>Start_mileage</th>"
                          . "<th>End Mileage</th>" */
                        . "<th>System Mileage</th>"
                        /* . "<th>Manualt_mileage</th>"
                          . "<th>Additional Diesel</th>" */
                        . "<th>Total cost</th>"
                        . "<th>Print Service</th>"
                        . "</tr>";
                        foreach ($ServiceList as $list) {

                            echo "<tr onclick=\"view_Service('" . $list['id'] . "')\" style=\"cursor: pointer;\">"
                            . "<td> " . $list['id'] . " </td>"
                            . "<td>" . $list['name'] . " </td>"
                            . "<td>" . $list['nic'] . "</td>"
                            . "<td>" . $list['vehicle_no'] . "</td>"
                            . "<td>" . $list['from_location'] . "</td>"
                            . "<td>" . $list['to_location'] . "</td>"
                            . "<td>" . $list['request_date'] . "</td>"
                            /* . "<td>" . $list['start_mileage'] . "</td>"
                              . "<td>" . $list['end_mileage'] . "</td>" */
                            . "<td>" . $list['system_mileage'] . "</td>"
                            /* . "<td>" . $list['manual_mileage'] . "</td>"
                              . "<td>" . $list['additional_diesel'] . "</td>" */
                            . "<td>" . $list['total_cost'] . "</td>"
                            . "<td><button type=\"Submit\" class=\"btn btn-primary btn-block btn-flat\">Print</button> </td>"
                            . "</tr>";
                        }
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

    callMessage('<?= $msg ?>', '');

</script>

<script type="text/javascript">

<?php
if ($utype == DLRUSERTYPEID) {

    echo '$(\'#customerdata\').show();';
} else {

    echo '$(\'#customerdata\').hide();';
}
?>



    $('#userType').on('change', function () {

        if (this.value ==<?= DLRUSERTYPEID ?>) {

            $('#customerdata').show(200);

        } else {

            $('#customerdata').hide();

        }

    });



    function createCustomer()

    {    // open popup window and pass field id

        window.open('<?= base_url('index.php/customers/newCustomerPopup') ?>', 'popuppage', 'width=400,toolbar=1,resizable=1,scrollbars=yes,height=650,top=10,left=500');

    }



    function selectValue()

    {    // open popup window and pass field id

        window.open('<?= base_url('index.php/customers/CustomerListPopup') ?>', 'popuppage', 'width=650,toolbar=1,resizable=1,scrollbars=yes,height=600,top=100,left=100');

    }



    function updateValue(id, value)

    {

        // this gets called from the popup window and updates the field with a new value

        document.getElementById('cusname').value = value;

        document.getElementById('profname').value = value;

        document.getElementById('cusid').value = id;

    }



    function deleteUser(uid, reqType, upval) {

        if (reqType == 'update') {

            $.ajax({

                type: "post",

                url: "<?php echo base_url('index.php/users/updateUserData'); ?>",

                data: 'userid=' + uid + '&reqType=' + reqType + '&upVal=' + upval,

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

                            url: "<?php echo base_url('index.php/users/updateUserData'); ?>",

                            data: 'userid=' + uid + '&reqType=' + reqType + '&upVal=' + upval,

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



    $('#newpic').hide();



    function changePic() {

        $('#picupdate').val('delete');

        $('#oldpic').hide(200);

        $('#newpic').show(200);

    }

</script>
<script>
    $('#EndMileage').keyup(function () {
        var StartMileage;
        var EndMileage;
        StartMileage = parseFloat($('#StartMileage').val());
        EndMileage = parseFloat($('#EndMileage').val());
        var result = EndMileage - StartMileage;
        $('#SystemMileage').val(result.toFixed(2));
    });
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









