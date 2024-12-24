<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?= $title ?> | Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.4 -->
        <link href="<?= base_url('adminlte/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" /> -->
        <link href="<?= base_url('adminlte/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css" />

        <!-- Theme style -->
        <link href="<?= base_url('adminlte/dist/css/AdminLTE.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- iCheck -->
        <link href="<?= base_url('adminlte/plugins/iCheck/square/blue.css') ?>" rel="stylesheet" type="text/css" />
<!-- ALERTS -->
        <link href="<?= base_url('adminlte/dist/css/alert/sweetalert.css') ?>" rel="stylesheet" type="text/css" />
        
        <!-- particles-->
        <link href="<?= base_url('adminlte/dist/css/style.css') ?>" rel="stylesheet" type="text/css" />
        <!-- My Error Messages -->
        <link href="<?= base_url('adminlte/custom.css') ?>" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style>
            /*.login-page{
                    background: #000000;
            }*/
            .login-box{
                position: absolute;
                top: 3em;
                left: 0;
                right: 0;
                margin-left: auto;
                margin-right: auto;
                border: 1px solid #e80008d1;
                border-radius: 6px;
                background: #000000cf;
            }
        </style>
    </head>
    <body class="login-page">
        <div id="particles-js"></div>
        <div class="login-box">
            <div class="login-logo">
                <img src="<?= base_url('adminlte/dist/img/logo.png') ?>" alt="Raigam Maeketing Services Logo" /><br>
                <a href=""><?= $pagetitle ?></a>
            </div><!-- /.login-logo -->
            <div class="login-box-body">
                <div id="successMessage" class="hideDiv">Login Successfully! </div>
                <div id="errorMessage" class="hideDiv">Invalid User ID or Password! Please Try Again. </div>
                <div class="keepgap"></div>  

                <p class="login-box-msg" style="font-size: 15px;color: #fff;">Sign in to start your session</p>
                <form id="login" action="<?= base_url('index.php/users/login') ?>" method="post">
                    <div class="form-group has-feedback">
                        <select class="form-control" name="location">
                            <option value="">-- Select Location --</option>                            
                            <?php
                            if (!empty($location) && isset($location)) {
                                foreach ($location as $loc) {
                                    echo '<option value="' . $loc['id'] . '">' . $loc['name'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" name="email" class="form-control" placeholder="User Name"/>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" name="pass" class="form-control" placeholder="Password"/>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8" style="display: none;">    
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox"> Remember Me
                                </label>
                            </div>                        
                        </div><!-- /.col -->
                        <div class="col-xs-4 pull-right">
                            <button type="submit" class="btn btn-primary btn-block btn-flat pull-right">Sign In</button>
                        </div><!-- /.col -->
                    </div>
                </form>

                <!--    
                <a href="#">I forgot my password</a><br>
                <a href="register.html" class="text-center">Register a new membership</a>
                -->    
            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->

        <!-- jQuery 2.1.4 -->
        <script src="<?= base_url('adminlte/plugins/jQuery/jQuery-2.1.4.min.js') ?>"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="<?= base_url('adminlte/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="<?= base_url('adminlte/plugins/iCheck/icheck.min.js') ?>" type="text/javascript"></script>

        <script src="<?= base_url('adminlte/plugins/jQuery/jQuery-2.1.4.min.js') ?>"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="<?= base_url('adminlte/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="<?= base_url('adminlte/plugins/iCheck/icheck.min.js') ?>" type="text/javascript"></script>
        <script>
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        </script>
<!-- ALERTS -->
<script src="<?= base_url('adminlte/dist/js/alert/sweetalert.min.js') ?>" type="text/javascript"></script>

        <!-- Custom Error Messages -->
        <!-- <script src="<?= base_url('adminlte/custom.js') ?>" type="text/javascript"></script> -->
        <script type="text/javascript">
            //callMessage('<?= $msg ?>', '');
            var m = '<?= $msg ?>';
            if (m === 'ok') {
                swal("Updated!", "Your data is now updated.", "success");
            } else if (m === 'fail') {
                swal("Error!", "Unable to process your request", "error");
            }
        </script>
        <!-- VALIDATE -->
        <script src="<?= base_url('adminlte/dist/js/validate/jquery.validate.min.js') ?>" type="text/javascript"></script>
        <script src="<?= base_url('adminlte/dist/js/validate/placeholders.min.js') ?>" type="text/javascript"></script>
        <!-- Particles -->
        <script src="<?= base_url('adminlte/dist/js/particles.js') ?>" type="text/javascript"></script>
        <script src="<?= base_url('adminlte/dist/js/app-particles.js') ?>" type="text/javascript"></script>

        <script type="text/javascript">
    $("#login").validate({
        rules: {
            "location": {
                required: true
            },
            "email": {
                required: true
            },
            "pass": {
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


    $('.login-page').animate({
        'opacity': '1'
    }, 600, function () { });

        </script>
    </body>
</html>