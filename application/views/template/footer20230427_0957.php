 
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 2.0
    </div>
    <strong>Copyright &copy; <?= date('Y') ?> <a href="http://www.raigam.lk"><?= COMPANY ?></a>.</strong> All rights reserved.
</footer>
<div class="modal" id="uploading">
    <div class="modal-dialog">
        <div class="modal-content">      
            <div class="modal-body">
                Processing Your Request...
                <div style="width:100%;margin:0 auto;text-align:center;"><img src="<?= base_url('adminlte/dist/img/uploading.gif') ?>" style="width:100px;height:80px; text-align:center;margin-top:10%;" /></div>
            </div>      
        </div>
    </div>
</div>
<!-- Control Sidebar -->      
<aside class="control-sidebar control-sidebar-dark">                
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class='control-sidebar-menu'>
                <li>
                    <a href='javascript::;'>
                        <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                            <p>Will be 23 on April 24th</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href='javascript::;'>
                        <i class="menu-icon fa fa-user bg-yellow"></i>
                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                            <p>New phone +1(800)555-1234</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href='javascript::;'>
                        <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                            <p>nora@example.com</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href='javascript::;'>
                        <i class="menu-icon fa fa-file-code-o bg-green"></i>
                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                            <p>Execution time 5 seconds</p>
                        </div>
                    </a>
                </li>
            </ul><!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3> 
            <ul class='control-sidebar-menu'>
                <li>
                    <a href='javascript::;'>               
                        <h4 class="control-sidebar-subheading">
                            Custom Template Design
                            <span class="label label-danger pull-right">70%</span>
                        </h4>
                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                        </div>                                    
                    </a>
                </li> 
                <li>
                    <a href='javascript::;'>               
                        <h4 class="control-sidebar-subheading">
                            Update Resume
                            <span class="label label-success pull-right">95%</span>
                        </h4>
                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                        </div>                                    
                    </a>
                </li> 
                <li>
                    <a href='javascript::;'>               
                        <h4 class="control-sidebar-subheading">
                            Laravel Integration
                            <span class="label label-waring pull-right">50%</span>
                        </h4>
                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                        </div>                                    
                    </a>
                </li> 
                <li>
                    <a href='javascript::;'>               
                        <h4 class="control-sidebar-subheading">
                            Back End Framework
                            <span class="label label-primary pull-right">68%</span>
                        </h4>
                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                        </div>                                    
                    </a>
                </li>               
            </ul><!-- /.control-sidebar-menu -->         

        </div><!-- /.tab-pane -->
        <!-- Stats tab content -->
        <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">            
            <form method="post">
                <h3 class="control-sidebar-heading">General Settings</h3>
                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Report panel usage
                        <input type="checkbox" class="pull-right" checked />
                    </label>
                    <p>
                        Some information about this general settings option
                    </p>
                </div><!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Allow mail redirect
                        <input type="checkbox" class="pull-right" checked />
                    </label>
                    <p>
                        Other sets of options are available
                    </p>
                </div><!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Expose author name in posts
                        <input type="checkbox" class="pull-right" checked />
                    </label>
                    <p>
                        Allow the user to show his name in blog posts
                    </p>
                </div><!-- /.form-group -->

                <h3 class="control-sidebar-heading">Chat Settings</h3>

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Show me as online
                        <input type="checkbox" class="pull-right" checked />
                    </label>                
                </div><!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Turn off notifications
                        <input type="checkbox" class="pull-right" />
                    </label>                
                </div><!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Delete chat history
                        <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                    </label>                
                </div><!-- /.form-group -->
            </form>
        </div><!-- /.tab-pane -->
    </div>
</aside><!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class='control-sidebar-bg'></div>
</div><!-- ./wrapper -->

<!-- jQuery UI 1.11.2 -->
<script src="<?= base_url('adminlte/dist/js/jquery-ui.min.js') ?>" type="text/javascript"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.2 JS -->
<script src="<?= base_url('adminlte/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>    
<!-- Morris.js charts -->
<script src="<?= base_url('adminlte/dist/js/raphael-min.js') ?>"></script>
<script src="<?= base_url('adminlte/plugins/morris/morris.min.js') ?>" type="text/javascript"></script>
<!-- Sparkline -->
<script src="<?= base_url('adminlte/plugins/sparkline/jquery.sparkline.min.js') ?>" type="text/javascript"></script>
<!-- jvectormap -->
<script src="<?= base_url('adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') ?>" type="text/javascript"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url('adminlte/plugins/knob/jquery.knob.js') ?>" type="text/javascript"></script>

<!-- daterangepicker -->
<script src="<?= base_url('adminlte/dist/js/moment.min.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('adminlte/plugins/daterangepicker/daterangepicker.js') ?>" type="text/javascript"></script>
<!-- datepicker -->
<script src="<?= base_url('adminlte/plugins/datepicker/bootstrap-datepicker.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('adminlte/plugins/timepicker/bootstrap-timepicker.min.js') ?>"></script>

<!-- Bootstrap WYSIHTML5 -->
<!--
<script src="<?= base_url('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') ?>" type="text/javascript"></script>
-->
<!-- DATA TABES SCRIPT -->
<script src="<?= base_url('adminlte/plugins/datatables/jquery.dataTables.min.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('adminlte/plugins/datatables/dataTables.bootstrap.min.js') ?>" type="text/javascript"></script>


<!-- Slimscroll -->
<script src="<?= base_url('adminlte/plugins/slimScroll/jquery.slimscroll.min.js') ?>" type="text/javascript"></script>
<!-- FastClick -->
<script src='<?= base_url('adminlte/plugins/fastclick/fastclick.min.js') ?>'></script>
<!-- AdminLTE App -->
<script src="<?= base_url('adminlte/dist/js/app.min.js') ?>" type="text/javascript"></script>    

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<?= base_url('adminlte/dist/js/pages/dashboard.js') ?>" type="text/javascript"></script>     -->

<!-- AdminLTE for demo purposes -->
<!--
<script src="<?= base_url('adminlte/dist/js/demo.js') ?>" type="text/javascript"></script>
-->
<!-- ALERTS -->
<script src="<?= base_url('adminlte/dist/js/alert/sweetalert.min.js') ?>" type="text/javascript"></script>
<!-- POPUP -->
<script src="<?= base_url('adminlte/dist/js/jquery.colorbox.js') ?>" type="text/javascript"></script>
<!-- SELECT LIST WITH SEARCH -->
<script src="<?= base_url('adminlte/plugins/lakshitha/select-list-search/bootstrap-select.min.js') ?>"></script>


<!-- MULTI SELECT DROP DOWN -->
<script type="text/javascript" src="<?= base_url('adminlte/dist/js/bootstrap-multiselect.js') ?>"></script>
<script>
// Add options for example 28.


    $('#example28').multiselect({
        includeSelectAllOption: true,
        enableFiltering: true,
        maxHeight: 150
    });
</script>

<!-- page script -->
<script type="text/javascript">
    //jQuery().noConflict();
    $("#example1").dataTable({
        "order": [[0, "desc"]]
    });
    $("#example2").dataTable({
        "order": [[0, "asc"]]
    });
    //Data Tables
    $("#example7").dataTable({
        "order": [[0, "desc"]]
    });
    $("#example4").dataTable(
            {
                "order": [[0, "desc"]],
                "columnDefs": [{
                        orderable: false,
                        className: 'select-checkbox',
                        targets: 0
                    }]
            }
    );
    /* $(function() {
     $("#example1").dataTable();
     $('#example2').dataTable({
     "bPaginate": true,
     "bLengthChange": false,
     "bFilter": false,
     "bSort": true,
     "bInfo": true,
     "bAutoWidth": false
     });
     });*/
</script>

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

<!--REPORT MODULE RELATED ONLY-->
<script type="text/javascript">
//Date range picker
    $('#reservation').daterangepicker({format: 'YYYY/MM/DD'});
    //Date picker
    $('#datepicker').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
    });
    $('#datepickerto').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
    });
    //Timepicker
    $('.timepicker').timepicker({
        showInputs: false
    });
</script>


<script type="text/javascript">
    //DELETE OPTIONS


    //
//Print Page
    /*function printdiv(printpage)
     {
     var headstr = '<html' + '><head' + '><title' + '></title' + '><' + '/head><' + 'body>';
     var footstr1 = "</";
     var footstr2 = "body>";
     var footerstr = footstr1 + footstr2;
     var newstr = document.all.item(printpage).innerHTML;
     //var oldstr = document.body.innerHTML;
     //alert(oldstr);
     document.body.innerHTML = headstr + newstr + footerstr;
     window.open().print();
     //document.body.innerHTML = oldstr;
     return false;
     }*/

    function printdiv(elem) {
        Popup($('#' + elem).html());
    }

    function Popup(data) {
        var myWindow = window.open('', 'my div', 'height=400px,width=600px');
        myWindow.document.write('<html><head><title>Report</title><link href="<?= base_url('adminlte/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" media="print" type="text/css" /><style>@media print {     html, body {        border: 1px solid white;        height: auto;        page-break-after: avoid;        page-break-before: avoid;     } html, body { height: auto; }} @media print {    body {   font-size:12px !important;     display: none;    }} body.printing {    display: block;} @page { size: auto;  margin: 0mm; }</style>');
        /*optional stylesheet*/ //myWindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
        myWindow.document.write('</head><body >');
        myWindow.document.write(data);
        myWindow.document.write('</body></html>');
        myWindow.document.close(); // necessary for IE >= 10

        myWindow.onload = function () { // necessary if the div contain images

            myWindow.focus(); // necessary for IE >= 10
            myWindow.print();
            myWindow.close();
        };
    }
</script>
<!-- Export to excel -->
<script>
    function ExportExcel(table_id, title, rc_array) {
        if (document.getElementById(table_id).nodeName == "TABLE") {
            var dom = $('#' + table_id).clone().get(0);
            var rc_array = (rc_array == undefined) ? [] : rc_array;
            for (var i = 0; i < rc_array.length; i++) {
                dom.tHead.rows[0].deleteCell((rc_array[i] - i));
                for (var j = 0; j < dom.tBodies[0].rows.length; j++) {
                    dom.tBodies[0].rows[j].deleteCell((rc_array[i] - i));
                }
            }

            var a = document.createElement('a');
            var tit = ['<table><tr><td></td><td></td></tr><tr><td></td><td><font size="5">', title, '</font></td></tr><tr><td></td><td></td></tr></table>'];
            a.href = 'data:application/vnd.ms-excel,' + encodeURIComponent(tit.join('') + dom.outerHTML);
            a.setAttribute('download', 'Raigam_Marketing_(Pvt)_Ltd_' + title + '_' + new Date().toLocaleString() + '.xls');
            a.click();
        } else {
            alert('Not a table');
        }
    }
//INVOICE VIEW OPTION
    function view_invoice(idinvoice) {

//    var discounts = discountss;
//        alert(discounts);
        //alert(idinvoice);
        $("#div_invoice").html('');
//    alert('aaa');
        $.ajax({
            type: 'post',
            url: "<?= base_url('Salesoetransaction/invoiceView') ?>",
            data: {
                idinvoice: idinvoice
            },
            success: function (data) {
                //alert(data);
                $.colorbox({
                    html: "<table style='width:900px; height:633px' ><tr><td>" + data + "</td></tr></table>",
                    opacity: 1
                });
//            $("#div_invoice").html(data);
//            func();
            }
        });
    }
    function view_Service(idinvoice) {

//    var discounts = discountss;
//        alert(discounts);
        //alert(idinvoice);
        $("#div_invoice").html('');
//    alert('aaa');
        $.ajax({
            type: 'post',
            url: "<?= base_url('logistics/invoiceView') ?>",
            data: {
                idinvoice: idinvoice
            },
            success: function (data) {
                //alert(data);
                $.colorbox({
                    html: "<table style='width:900px; height:633px' ><tr><td>" + data + "</td></tr></table>",
                    opacity: 1
                });
//            $("#div_invoice").html(data);
//            func();
            }
        });
    }
    //INVOICE VIEW OPTION
    function view_invoice_old(idinvoice) {

//    var discounts = discountss;
//        alert(discounts);
        //alert(idinvoice);
        $("#div_invoice").html('');
//    alert('aaa');
        $.ajax({
            type: 'post',
            url: "<?= base_url('Salesreports/invoiceViewOldSys') ?>",
            data: {
                idinvoice: idinvoice
            },
            success: function (data) {
                //alert(data);
                $.colorbox({
                    html: "<table style='width:900px; height:633px' ><tr><td>" + data + "</td></tr></table>",
                    opacity: 1
                });
//            $("#div_invoice").html(data);
//            func();
            }
        });
    }
//get relavant territory
//
// 
    $('#areaID').on('change', function () {
        $('#uploading').modal('show');
        $('#sbTerritory').empty();
        $('#sbRangeRep').val(-1);
        $('#sbRep').empty();
        $('#sbFrom').empty();
        $('#sbTo').empty();
        var selectVal = $(this).val();
        $.ajax({
            type: 'get',
            url: "<?= base_url('master/getTerritoryListAjax') ?>",
            data: {
                areaid: selectVal
            },
            success: function (data) {
                $('#sbTerritory').empty().append(data);
                $('#uploading').modal('hide');
            }
        });
    });
//get relavant route
//
// 
    $('#sbTerritory').on('change', function () {
        //alert($('#areaID').val());
        //alert($(this).val());
        $('#sbRangeRep').val(-1);
        $('#sbRep').empty();
        $('#sbFrom').empty();
        $('#sbTo').empty();
        $('#uploading').modal('show');
        var selectVal = $(this).val();
        $.ajax({
            type: 'get',
            url: "<?= base_url('master/getRouteListAjax') ?>",
            data: {
                areaid: $('#areaID').val(),
                territoryID: selectVal
            },
            success: function (data) {
                $('#routeID').empty().append(data);
                $('#uploading').modal('hide');
            }
        });
    });


    //GET SALES REP DATA
    $('#sbRangeRep').on('change', function () {
        $('#uploading').modal('show');
        $('#sbFrom').empty();
        $('#sbTo').empty();
        var selectAreaVal = $('#areaID').val();
        var selectTerritoryVal = $('#sbTerritory').val();
        var selectRangeVal = $(this).val();
        $.ajax({
            type: 'get',
            url: "<?= base_url('master/getRepListAjax') ?>",
            data: {
                areaid: selectAreaVal,
                territoryID: selectTerritoryVal,
                rangeID: selectRangeVal
            },
            success: function (data) {
                $('#sbRep').empty().append(data);
                $('#uploading').modal('hide');
            }
        });
    });
    //GET GPS TIME LIST FOR SEARCH
    $('#sbRep').on('change', function () {
        $('#uploading').modal('show');
        var selectUserVal = $('#sbRep').val();
        var selectTraceDateVal = $('#datepicker').val();
        $.ajax({
            type: 'get',
            url: "<?= base_url('gps/getGpsTimeList') ?>",
            data: {
                gp_date: selectTraceDateVal,
                user: selectUserVal
            },
            success: function (data) {
                $('#sbFrom').empty().append(data);
                $('#sbTo').empty().append(data);
                $('#uploading').modal('hide');
            }
        });
    });
    //
//Make actual INVOICE OPTION
    function create_actual(idinvoice) {

//    var discounts = discountss;
//        alert(discounts);
        //alert(idinvoice);
        $("#div_invoice").html('');
//    alert('aaa');
        $.ajax({
            type: 'post',
            url: "<?= base_url('Salesoetransaction/bookingToActual') ?>",
            data: {
                idinvoice: idinvoice
            },
            success: function (data) {
                //alert(data);
                $.colorbox({
                    html: "<table style='width:1300px; height:633px' ><tr><td>" + data + "</td></tr></table>",
                    opacity: 1
                });
//            $("#div_invoice").html(data);
//            func();
            }
        });
    }

//CALL ON TERRITORY CHNAGE 
    $('#sbTerritory').change(function () {
        var data = "";
        $.ajax({
            type: "POST",
            url: "<?= base_url('salesarcustomers/getTerritoryRouteAjax') ?>",
            data: "territory_id=" + $(this).val(),
            async: false,
            success: function (response) {
                data = response;
                return response;
            },
            error: function () {
                alert('Error occured');
            }
        });
    });
</script>
<script>
    $('#datepickerto').on('change', function () {
        var fromD = $("#datepicker").val();
        var toD = $("#datepickerto").val();
        if (fromD !== '' && toD !== '') {
            getAvailableVehicles();
        }
    });
    $('#datepicker').on('change', function () {
        var fromD = $("#datepicker").val();
        var toD = $("#datepickerto").val();
        if (fromD !== '' && toD !== '') {
            getAvailableVehicles();
        }
    });
    function getAvailableVehicles() {
        $("#Vehicle").html('');
        $('#uploading').modal('show');
        var fromD = $("#datepicker").val();
        var toD = $("#datepickerto").val();
        //alert(fromD);
        $.ajax({
            type: 'post',
            url: "<?= base_url('logistics/getAjaxAvailableVehicle') ?>",
            data: {
                fromDate: fromD,
                toDate: toD
            },
            success: function (data) {
                //alert(data);
                $("#Vehicle").empty().append(data);
            }
        });

        $('#uploading').modal('hide');
    }
    $('#Vehicle').on('change', function () {
        $("#rateVehi").val();
         getAvailableRate();
    });
    function getAvailableRate() {
        $('#uploading').modal('show');
        var vid = $("#Vehicle").val(); 
        //alert(fromD);
        $.ajax({
            type: 'post',
            url: "<?= base_url('logistics/getAjaxGetRate') ?>",
            data: {
                vehicleID: vid
            },
            success: function (data) {
                //alert(data);
                $("#rateVehi").val(data);
            }
        });

        $('#uploading').modal('hide');
    }
</script>


<script>
    function dropPins(allPoints, map) {
        var infowindow = new google.maps.InfoWindow();
        for (var i = 0; i < allPoints.length; i++) {
            var myLatlng = new google.maps.LatLng(allPoints[i].latitude, allPoints[i].longitude);
            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                animation: google.maps.Animation.DROP
            });
            google.maps.event.addListener(marker, 'click', (function (marker, i) {
                return function () {
                    infowindow.setContent("<ul><li>Latitude " + allPoints[i].latitude + "</li><li>Longitude " + allPoints[i].longitude + "</li></ul>");
                    infowindow.open(map, marker);
                };
            })(marker, i));
        }
    }
</script>




</body>
</html>