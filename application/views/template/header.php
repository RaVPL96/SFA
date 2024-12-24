<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?= $title ?> | Dashboard</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.4 -->
        <link href="<?= base_url('adminlte/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />    
        <!-- FontAwesome 4.3.0 -->

        <!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" /> -->
		<link href="<?= base_url('adminlte/css/font-awesome.min.css')?>" rel="stylesheet" type="text/css" />
		
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->
		<!-- <link href="<?= base_url('adminlte/css/font-awesome.min.4.4.css')?>" rel="stylesheet" type="text/css" /> -->
		
        <!-- Ionicons 2.0.0 -->
        <!-- <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />    -->
		<link href="<?= base_url('adminlte/ionicons.min.css')?>" rel="stylesheet" type="text/css" />

        <!-- DATA TABLES -->
        <link href="<?= base_url('adminlte/plugins/datatables/dataTables.bootstrap.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?= base_url('adminlte/dist/css/AdminLTE.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- AdminLTE Skins. Choose a skin from the css/skins 
             folder instead of downloading all of them to reduce the load. -->
        <link href="<?= base_url('adminlte/dist/css/skins/_all-skins.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- iCheck -->
        <link href="<?= base_url('adminlte/plugins/iCheck/flat/blue.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="<?= base_url('adminlte/plugins/morris/morris.css') ?>" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="<?= base_url('adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Date Picker -->
        <link href="<?= base_url('adminlte/plugins/datepicker/datepicker3.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="<?= base_url('adminlte/plugins/daterangepicker/daterangepicker-bs3.css') ?>" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="<?= base_url('adminlte/plugins/timepicker/bootstrap-timepicker.min.css') ?>">
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="<?= base_url('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') ?>" rel="stylesheet" type="text/css" />

        <!-- My Error Messages -->
        <link href="<?= base_url('adminlte/custom.css') ?>" rel="stylesheet" type="text/css" />
        
        <!-- ALERTS -->
        <link href="<?= base_url('adminlte/dist/css/alert/sweetalert.css') ?>" rel="stylesheet" type="text/css" />
        <!-- colorbox -->        <link rel="stylesheet" type="text/css" href="<?= base_url('adminlte/plugins/lakshitha/colorbox/colorbox.css')?>" />
        <!-- SELECT LIST WITH SEARCH -->
        <link rel="stylesheet" href="<?= base_url('adminlte/plugins/lakshitha/select-list-search/bootstrap-select.min.css') ?>" />
		<!-- MULTI SELECT DROP DOWN https://www.jqueryscript.net/form/jQuery-Multiple-Select-Plugin-For-Bootstrap-Bootstrap-Multiselect.html-->		<link rel="stylesheet" href="<?= base_url('adminlte/dist/css/bootstrap-multiselect.css') ?>" type="text/css">		<style>		.dropdown-item.multiselect-all, .btn-group.open, .multiselect-option{			width:100%;		}		.form-check-input{ 				margin: 0 5px 0 5px !important;		}		.dropdown-item.multiselect-all, .multiselect-option {			text-align:left;		}		</style>
        <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>-->


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->


        <!-- jQuery 2.1.4 -->
        <script src="<?= base_url('adminlte/plugins/jQuery/jQuery-2.1.4.min.js') ?>"></script>
		<!-- jQuery 2.1.4 -->
		<!-- <script src="<?= base_url('adminlte/plugins/jQuery/jQuery-2.1.4.min.js') ?>"></script> -->       
		<script src="<?= base_url('adminlte/dist/js/validate/jquery.validate.min.js') ?>" type="text/javascript"></script>
		<script src="<?= base_url('adminlte/dist/js/validate/placeholders.min.js') ?>" type="text/javascript"></script>
		


    </head>
    <body class="skin-blue sidebar-mini">
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><?= $pagetitle ?></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><?=PROGRAMNAME?></span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <label class="" style="padding: 15px; background-color: #de0000; color: #ffffff"><?php
                        $sessLoc = $this->session->userdata('Location');
                        if (!empty($sessLoc) && isset($sessLoc)) {
                            echo 'Company: ' . $sessLoc;
                        }
                        ?></label>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">

                            <!-- Notifications: style can be found in dropdown.less -->
                            <li class="dropdown notifications-menu">
                                <?php
                                $strPartStkblowZero = 0;
                                $strPartStkblowReorder = 0;

                                $strAccStkblowZero = 0;
                                $strAccStkblowReorder = 0;

                                $msgsNotify = '';
                                $countNotify = 0;
                                $rptStockMessageData=$this->session->userdata('StockMsg');
                                if (!empty($rptStockMessageData) && isset($rptStockMessageData) && !empty($rptStockMessageData[0]) &&!empty($rptStockMessageData[1])) {
                                    foreach ($rptStockMessageData[0] as $job) {
                                        if(!empty($job['stock']) && isset($job['stock'])){
                                        if (sprintf('%0.2f', $job['stock']) <= 0) {
                                            //$strPartStkblowZero +=1;
                                            //$countNotify +=1;
                                        }
                                        if (sprintf('%0.2f', $job['stock']) <= $job['reorder_lvl']) {
                                            $strPartStkblowReorder +=1;
                                            $countNotify +=1;
                                        }
                                        }
                                    }
                                    foreach ($rptStockMessageData[1] as $job) {
                                        if(!empty($job['stock']) && isset($job['stock'])){
                                        if (sprintf('%0.2f', $job['stock']) <= 0) {
                                           // $strAccStkblowZero +=1;
                                            ///$countNotify +=1;
                                        }
                                        if (sprintf('%0.2f', $job['stock']) <= $job['reorder_lvl']) {
                                            $strAccStkblowReorder +=1;
                                            $countNotify +=1;
                                        }
                                        }
                                    }
/*
                                    if ($strPartStkblowZero != 0) {
                                        $msgsNotify .= '<li>
                                                        <a href="'.base_url('index.php/items/stockMessages').'">
                                                          <i class="fa fa-warning text-red"></i> ' . $strPartStkblowZero . ' Part(s) Stock is 0 or Negative
                                                        </a>
                                                      </li>';
                                    }*/
                                    /*if ($strAccStkblowZero != 0) {
                                        $msgsNotify .= '<li>
                                                        <a href="'.base_url('index.php/items/stockMessages').'">
                                                          <i class="fa fa-warning text-red"></i> ' . $strAccStkblowZero . ' Accessory(s) Stock is 0 or Negative
                                                        </a>
                                                      </li>';
                                    }*/
                                    if ($strPartStkblowReorder != 0) {
                                        $msgsNotify .= '<li>
                                                        <a href="'.base_url('index.php/items/stockMessages').'">
                                                          <i class="fa fa-warning text-yellow"></i> ' . $strPartStkblowReorder . ' Part(s) Level Below Reorder Level
                                                        </a>
                                                      </li>';
                                    }

                                    if ($strAccStkblowReorder != 0) {
                                        $msgsNotify .= '<li>
                                                        <a href="'.base_url('index.php/items/stockMessages').'">
                                                          <i class="fa fa-warning text-yellow"></i> ' . $strAccStkblowReorder . ' Accessory(s) Level Below Reorder Level
                                                        </a>
                                                      </li>';
                                    }
                                }
                                ?> 
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-bell-o"></i>
                                    <span class="label label-warning"><?= $countNotify ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">You have <?= $countNotify ?> notifications</li>
                                    <li>
                                        <!-- inner menu: contains the actual data -->
                                        <ul class="menu">
                                            <?= $msgsNotify ?>        
                                        </ul>
                                    </li>
                                    <li class="footer"><a href="<?=  base_url('index.php/items/stockMessages')?>">View all</a></li>
                                </ul>
                            </li>
                            <!-- Tasks: style can be found in dropdown.less -->
                            <!--
                            <li class="dropdown tasks-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-flag-o"></i>
                                    <span class="label label-danger"></span>
                                </a>                
                            </li>
                            -->
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?= base_url('adminlte/dist/img') . '/' . $sess['pic'] ?>" class="user-image" alt="User Image"/>
                                    <span class="hidden-xs"><?= $sess['profname'] ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="<?= base_url('adminlte/dist/img') . '/' . $sess['pic'] ?>" class="img-circle" alt="User Image" />
                                        <p>
                                            <?= $sess['username'] ?> - <?= $sess['urolename'] ?>
                                            <small>Employee since <?= date('M d, Y', strtotime($sess['since'])) ?></small>
                                        </p>
                                    </li>
                                    <!-- Menu Body -->
                                    <!--
                                    <li class="user-body">
                                      <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                      </div>
                                      <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                      </div>
                                      <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                      </div>
                                    </li>
                                    -->
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <!-- <a href="#" class="btn btn-default btn-flat">Profile</a> -->
                                        </div>
                                        <div class="pull-right">
                                            <a href="<?= base_url('index.php/users/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- Control Sidebar Toggle Button -->
                            <!--
                            <li>
                                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                            </li>
                            -->
                        </ul>
                    </div>
                </nav>
            </header>
