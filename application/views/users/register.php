<?php include_once BASEPATH . ('../application/views/template/leftsidebar.php'); ?>



<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

        <h1>

            User Account Create/Modify 

            <small>Maintain Staff Users Content Access</small>

        </h1>

        <ol class="breadcrumb">

            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

            <li class="active">Users Module</li>

        </ol>

    </section>



    <!-- Main content -->

    <section class="content">

        <div class="row">

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

                    $gradeid = '';

                    $areaid = '';

                    $readonly = '';

                    $msgt = 'Register a new Staff User';

                    $btnmsg = 'Register';

                    $isactval = 'checked="checked"';

                    $ischannelval = '';

                    $isoperationval = '';

                    $israngeval = '';

                    $isterritoryval = '';

                    $id = 'new';

                    $utype = '';

                    $prppic=$ppic='avatar5.png';

                    $custid = '';

                    if (!empty($userdata) && isset($userdata)) {

                        $name = $userdata->profname;

                        $mobile = $userdata->mobile;

                        $username = $userdata->username;

                        $prppic = $userdata->profilepic;

                        $email = $userdata->email;

                        $isact = $userdata->active;

                        //$ischannelval = $userdata->channel;

                        //$isoperationval = $userdata->operation;

                        //$israngeval = $userdata->range;

                        //$isterritoryval = $userdata->territory;

                        //$areaid=$userdata->area_id;

                        $utype = $userdata->role;

						$departmentID = $userdata->departmentID;

						$gradeid=$userdata->grade_id;

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

                        $ppic='<img style="width:80px;" src="'.base_url(PROFILEPICPATH.$prppic).'"/>';

                    }

                    ?>

                    <p class="login-box-msg"><?= $msgt ?></p>                    

                    <form id="openacc" novalidate="novalidate" action="<?= base_url('index.php/users/openAcc') ?>" method="post" enctype="multipart/form-data">

                        <div class="form-group has-feedback">

                            <select class="form-control" id="userType" name="post[user][type]">

                                <option value="">-- Select Employee Category --</option>

                                <?php

                                foreach ($userTypes as $userType) {

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

                            <select class="form-control" id="department" name="post[user][department]">

                                <option value="">-- Select Department --</option>

                                <?php

                                foreach ($Departments as $dep) {

                                    $select = '';

                                    if ($departmentID == $dep['id']) {

                                        $select = 'selected="selected"';

                                    }

                                    echo '<option ' . $select . ' value="' . $dep['id'] . '">' . $dep['name'] . '</option>';

                                }

                                ?>

                            </select>

                        </div>

						<div class="form-group has-feedback">

                            <select class="form-control" id="grade" name="post[user][grade]" onchange="changeStatus()">

                                <option value="">-- Select Grade --</option>

                                <?php

                                foreach ($Grade as $dep) {

                                    $select = '';

                                    if ($gradeid == $dep['grade_id']) {

                                        $select = 'selected="selected"';

                                    }

                                    echo '<option ' . $select . ' value="' . $dep['grade_id'] . '">' . $dep['grade_name'] . '</option>';

                                }

                                ?>

                            </select>

                        </div>

                        <div class="form-group" id="customerdata">

                            <div class="input-group">

                                <input class="form-control" name="job[cusname]" id="cusname" type="text" value="<?= $name ?>" placeholder="Customer Name">

                                <span class="input-group-btn">

                                    <button class="btn btn-info btn-flat" onclick="selectValue()" type="button"><i class="fa fa-plus"></i></button>

                                </span>

                                <input class="form-control" name="job[cusid]" id="cusid" type="hidden" value="<?= $custid ?>">

                            </div>

                        </div>

                    <table id="$dep['grade_id']" class="grades" style="display:none">
                        <tr>
                            <th>Channel</th>
                            <td>
                        <?php
                        foreach ($ChannelDataSet as $c){
                            echo '<div class="col-md-12"><input type="checkbox"  value="'.$c['id'].'" name="post[user][channel][]"> '.$c['channel_name'].'</div>';
                        }?>
                        </td>
                        </tr>

                        <tr> <td colspna="2"> &nbsp; </td> </tr>

                        <tr>
                            <th>Operation</th>
                            <td>
                        <?php
                        foreach ($OperationDataSet as $c){
                            echo '<div class="col-md-12"><input type="checkbox"  value="'.$c['id'].'" name="post[user][operation][]"> '.$c['operation_name'].'</div>';
                        }?>
                        </td>
                        </tr>

                        <tr> <td colspna="2"> &nbsp; </td> </tr>

                        <tr>
                            <th>Item Range</th>                            
                            <td>
                        <?php
                        foreach ($RangeDataSet as $c){
                            echo '<div class="col-md-12"><input type="checkbox"  value="'.$c['id'].'" name="post[user][range][]"> '.$c['range_name'].'</div>';
                        }?>
                        </td>
                        </tr>

                        <tr> <td colspna="2"> &nbsp; </td> </tr>

                        <tr>
                            <th>Area</th>
                            <td> <select>
                            <?php
                        foreach ($AreaDataSet as $c){
                            echo '  <option value="'.$c['id'].'" name="post[user][area][]"> '.$c['area_name'].'</option> ';
                        }?>
                        </select>
                            </td>
                        </tr>
                        
                        <tr> <td colspna="2"> &nbsp; </td> </tr>

                        <tr>
                            <th>Territory</th>
                            <td>
                        <?php
                        foreach ($TerritoryDataSet as $c){
                            echo '<div class="col-md-12"><input type="checkbox"  value="'.$c['id'].'" name="post[user][territory][]"> '.$c['territory_name'].'</div>';
                        }?>
                        </td>
                        </tr>
                    </table>
                    
                    <div class="form-group has-feedback">

                    </div>

                        <div class="form-group has-feedback">

                            <input type="text" name="post[user][profname]" class="form-control" id="profname" placeholder="Full name" value="<?= $name ?>"/>

                            <span class="glyphicon glyphicon-user form-control-feedback"></span>

                        </div>

                        <div class="form-group has-feedback">

                            <input type="text" name="post[user][umobile]" class="form-control" placeholder="Mobile" value="<?= $mobile ?>"/>

                            <span class="glyphicon glyphicon-phone form-control-feedback"></span>

                        </div>

                        <div class="form-group has-feedback">

                            <input type="email" name="post[user][email]" class="form-control" id="email" placeholder="Email" value="<?= $email ?>" />

                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                        </div>

                        <div class="form-group has-feedback">

                            <div class="col-md-4 pull-left" id="oldpic"><?=$ppic?><a class="btn btn-sm btn-danger" onclick="changePic();return false;">Change</a></div>

                            <div class="col-md-8 pull-right" id="newpic">

                            <input type="file" name="profilepic" class="" id="file" placeholder="Profile Picture" value="" />

                            <span class="glyphicon glyphicon-picture form-control-feedback"></span>

                            </div>

                        </div>

                        <div class="clearfix"></div><br>

                        <div class="form-group has-feedback">

                            <input type="text" <?= $readonly ?> name="post[user][uname]" class="form-control" id="uname" placeholder="username" value="<?= $username ?>" />

                            <span class="glyphicon glyphicon-user form-control-feedback"></span>

                        </div>

                        <div class="form-group has-feedback">

                            <input type="password" name="post[user][pass]" class="form-control" id="pass" placeholder="Password" autocomplete="off"/>

                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                        </div>

                        <div class="form-group has-feedback">

                            <input type="password" name="post[user][repass]" class="form-control" placeholder="Retype password" autocomplete="off"/>

                            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>

                        </div>

                        <div class="form-group has-feedback">    

                            <div class="checkbox icheck">

                                <label>

                                    <input type="checkbox" <?= $isactval ?> value="1" name="post[user][active]"> Is Active

                                </label>

                            </div>                        

                        </div><!-- /.col -->

                        <div class="row form-group has-feedback ">                            

                            <div class="col-xs-4">

                                <input type="hidden" id="picupdate" name="post[user][pic]" class="form-control" value="<?= $prppic ?>"/>

                                <input type="hidden" name="post[user][saveas]" class="form-control" value="<?= $id ?>"/>

                                <button type="submit" class="btn btn-primary btn-block btn-flat"><?= $btnmsg ?></button>

                            </div><!-- /.col -->

                        </div>

                    </form> 



                    <!--<a href="login.html" class="text-center">I already have a membership</a>-->

                </div><!-- /.form-box -->

            </div>



            <!--Right Side Content-->

            <div class="col-md-7">

                <div class="box">

                    <div class="box-header with-border">

                        <h3 class="box-title">Staff User List</h3> (Click Edit to change permissions)

                    </div><!-- /.box-header -->

                    <div class="box-body">

                        <table id="example1" class="table table-bordered">

                            <thead>

                            <tr>

                                <th style="width: 180px">Name</th>

                                <th>Email</th>

                                <th style="width: 80px">Group</th>

                                <th style="width: 80px">Status</th>

                                <th style="width: 40px">&nbsp;</th>

                                <th style="width: 40px">&nbsp;</th>

                            </tr>

                            </thead>

                            <tbody>

                            <?php

                            foreach ($userlist as $user) {

                                $chked = '';

                                $class = '';

                                $status = 'Inactive';

                                $action = 0;

                                if ($user['active'] == 1) {

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

                <td>' . $user['profname'] . '</td>

                <td>' . $user['email'] . '</td>

                    <td>' . $user['name'] . '</td>

                        <td><a class="btn btn-xs btn-' . $class . '" onclick="deleteUser(\'' . $user['username'] . '\',\'update\',' . $action . ');">' . $status . '</a></td>

                        <td><a class="btn btn-primary btn-xs" href="' . base_url('index.php/users/createAcc/null/' . $user['username']) . '">Edit</a></td>

                            <td><a class="btn btn-danger btn-xs" onclick="deleteUser(\'' . $user['username'] . '\',\'delete\',1);">Delete</a></td>

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

    

    $('#newpic').hide();

	

    function changePic(){

		$('#picupdate').val('delete');

		$('#oldpic').hide(200);

		$('#newpic').show(200);    

    }

</script>









