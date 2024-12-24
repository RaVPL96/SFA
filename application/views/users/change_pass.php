<?php include_once BASEPATH . ('../application/views/template/leftsidebar.php'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            User Account Password Change
            <small>Maintain Your Content Access</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Users Module</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <form id="openacc" novalidate="novalidate" action="<?= base_url('index.php/users/updateAccPass') ?>" method="post" enctype="multipart/form-data">

                <div class="col-md-5">
                    <div class="register-box-body">
                        <div id="successMessage" class="hideDiv">Account Created Successfully! </div>
                        <div id="errorMessage" class="hideDiv">Invalid Data! Please Try Again. </div>
                        <div class="keepgap"></div>  
                        <?php
                        $name = '';
                        $mobile = '';
                        $username = '';
                        $email = '';
                        $pass = '';
                        $repass = '';
                        $readonly = '';
                        $msgt = 'Register a new Staff User';
                        $btnmsg = 'Register';
                        $isactval = 'checked="checked"';
                        $id = 'update';
                        $utype = '';
                        $custid = '';
                        if (!empty($userdata) && isset($userdata)) {
                            $name = $userdata->profname;
                            $mobile = $userdata->mobile;
                            $username = $userdata->username;
                            $email = $userdata->email;
                            $ppic = $userdata->profilepic;
                            $isact = $userdata->active;
                            $utype = $userdata->role;

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
                            $msgt = 'Modify Password data (leave password field blank if you do not want to change)';
                            $btnmsg = 'Update';
                        }
                        ?>
                        <p class="login-box-msg"><?= $msgt ?></p>    
                        <div class="form-group has-feedback">
                            <input type="password" name="post[user][oldpass]" class="form-control" id="pass" placeholder="Current Password" autocomplete="off"/>
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="password" name="post[user][pass]" class="form-control" id="pass" placeholder="Password" autocomplete="off"/>
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="password" name="post[user][repass]" class="form-control" placeholder="Retype password" autocomplete="off"/>
                            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                        </div>
                        <div class="row form-group has-feedback ">                            
                            <div class="col-xs-4">
                                <input type="hidden" name="post[user][saveas]" class="form-control" value="<?= $id ?>"/>
                                <input class="form-control" name="job[cusid]" id="cusid" type="hidden" value="<?= $custid ?>">
                                <button type="submit" class="btn btn-primary btn-block btn-flat"><?= $btnmsg ?></button>
                            </div><!-- /.col -->
                        </div>


                        <!--<a href="login.html" class="text-center">I already have a membership</a>-->
                    </div><!-- /.form-box -->
                </div>

                <!--Right Side Content-->
                <div class="col-md-7">
                    <table class="table table-hover">
                        <tr class="info">
                            <td>Employment Category</td>
                            <td><?php
                        foreach ($userTypes as $userType) {
                            $select = '';
                            if ($utype == $userType['id']) {
                                $select = 'selected="selected"';
                                echo '<label>' . $userType['name'] . '</label>';
                            }
                        }
                        ?></td>
                        </tr>
                        <tr class="warning">
                            <td>User ID</td>
                            <td><label><?= $username ?></label></td>
                        </tr>
                        <tr class="success">
                            <td>Name</td>
                            <td><label><?= $name ?></label></td>
                        </tr>
                        <tr class="info">
                            <td>Mobile</td>
                            <td><label><?= $mobile ?></label></td>
                        </tr>
                        <tr class="info">
                            <td>Email</td>
                            <td><label><?= $email ?></label></td>
                        </tr>
                        <tr class="info">
                            <td>Profile Picture</td>
                            <td> <img src="<?= base_url(PROFILEPICPATH . $ppic) ?>" /></td>
                        </tr>
                    </table>
                    
                             
                            
                      

                    <div class="form-group has-feedback">
                       
                    </div>
                    <div class="form-group has-feedback">
                        
                    </div>

                </div>
            </form> 
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

    $('#userType').on('change', function() {
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
                    url: "<?php echo base_url('index.php/users/updateUserData'); ?>",
                    data: 'userid=' + uid + '&reqType=' + reqType + '&upVal=' + upval,
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




