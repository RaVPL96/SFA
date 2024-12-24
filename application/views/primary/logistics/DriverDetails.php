<?php include_once BASEPATH . ('../application/views/template/leftsidebar.php'); ?>



<!-- Content Wrapper. Contains page content -->






<div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

        <h1>

            Driver Details Maintain 

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

                    $msgt = 'Add Driver';

                    $btnmsg = 'Add';

                    $isactval = 'checked="checked"';

                    $ischannelval = '';

                    $isoperationval = '';

                    $israngeval = '';

                    $isterritoryval = '';

                    $id = 'new';

                    $utype = '';

                    $prppic = $ppic = 'avatar5.png';

                    $custid = '';

                    $firstname = '';

                    $lastname = '';

                    $nic = '';

                    $licenceid = '';

                    $drivernumber = '';

                    if (!empty($Driver) && isset($Driver)) {

                        $id = $Driver->id;

                        $firstname = $Driver->name;

                        $lastname = $Driver->full_name;

                        $nic = $Driver->nic;

                        $licenceid = $Driver->licence_id;

                        $drivernumber = $Driver->driver_number;

                        //$ischannelval = $userdata->channel;
                        //$isoperationval = $userdata->operation;
                        //$israngeval = $userdata->range;
                        //$isterritoryval = $userdata->territory;
                        //$areaid=$userdata->area_id;










                        $msgt = 'Update Driver Details';

                        $btnmsg = 'Update';
                    }
                    ?>

                    <p class="login-box-msg"><?= $msgt ?></p>                    

                    <form id="openacc" name="addem" novalidate="novalidate" action="<?= base_url('index.php/Logistics/saveDriver') ?>" method="post" enctype="multipart/form-data">



                        <div class="form-group has-feedback">

                            <input type="text" name="post[user][firstname]" class="form-control" id="FirstName" placeholder="First Name " value="<?= $firstname ?>" required/>
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>


                        </div>

                        <div class="form-group has-feedback">

                            <input type="text" name="post[user][lastname]" class="form-control" id="LastName" placeholder="Last Name" value="<?= $lastname ?>" required/>
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>



                        </div>

                        <div class="form-group has-feedback">

                            <input type="text" name="post[user][nic]" class="form-control" id="Nic" placeholder="Nic" value="<?= $nic ?>" required />

                            <span class="glyphicon glyphicon-credit-card form-control-feedback"></span>


                        </div>

                        <div class="form-group has-feedback">

                            <input type="text" name="post[user][licenceid]" class="form-control" id="LicenceId" placeholder="Licence Id" value="<?= $licenceid ?>"  required/>
                            <span class="glyphicon glyphicon-credit-card form-control-feedback"></span>


                        </div>

                        <div class="form-group has-feedback">

                            <input type="text" name="post[user][drivernumber]" class="form-control" id="DriverNumber" placeholder="Driver Number " value="<?= $drivernumber ?>"  required/>
                            <span class="glyphicon glyphicon-phone form-control-feedback"></span>


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

                            Driver Details 

                            <small></small>

                        </h3>

                        <?php
                        echo "<table class=\"table table-dark table-striped\" id=\"example1\">";
                        echo "<thead>";
                        echo "<tr>"
                        . "<th>Id</th>"
                        . "<th>First Name</th>"
                        . "<th>Last Name</th>"
                        . "<th>Nic Number</th>"
                        . "<th>Licence Id</th>"
                        . "<th>Driver Number</th>"
                        . "<th></th>"
                        . "<th></th>"
                        . "</tr>"
                        . "</thead>";

                        echo "<tbody>";
                        foreach ($DriverList as $list) {

                            echo "<tr style=\"cursor: pointer;\">"
                            . "<td> " . $list['id'] . " </td>"
                            . "<td>" . $list['name'] . " </td>"
                            . "<td>" . $list['full_name'] . "</td>"
                            . "<td>" . $list['nic'] . "</td>"
                            . "<td>" . $list['licence_id'] . "</td>"
                            . "<td>" . $list['driver_number'] . "</td>"
                            . "<td>" . "</td>"
                            . "<td><a class=\"btn btn-primary btn-xs\" href=\"" . base_url("index.php/logistics/DriverDetails/null/" . $list['id']) . "\">Edit</a></td>"
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

    callMessage('<?= $msg ?>', '');

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















