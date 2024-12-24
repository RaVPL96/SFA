<?php
/*


 * This system Licenced to Raigam Marketing Services (Pvt) Ltd. 

 * Developed By: Lakshitha Pradeep Karunarathna  * 

 * Company: Serving Cloud INC in association with MyOffers.lk  * 

 * Date Started:  October 20, 2017  * 


 */
?>
<?php include_once BASEPATH . ('../application/views/template/leftsidebar.php'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Manual Bill Quota Add 
            <small>Agency Rep Wise Manual Bill Quota Adding  </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Secondary Sales Manual Bill Quota Adding Data Control Module</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12" style="overflow-x: scroll;">
                <h4></h4>
                <div id="successMessage" class="hideDiv">Updated Successfully! </div>
                <div id="errorMessage" class="hideDiv">Invalid Data! Please Try Again. </div>
                <div class="keepgap"></div> 
                <form class="form-horizontal" id="" action="<?= base_url('hr/manual_bill_quota') ?>" method="post">
                    
                     <div class="col-md-3">       
                        <div class="form-group">  
                            <label class="col-md-12">Sales Rep  <span class="text-red">*</span></label>
                            <div class="col-md-12"> 
                                <select id="areaID" name="areaID" class="form-control">   
                                    <option value="-1"> -- Select Area -- </option>                                                <?php
                                    foreach ($AreaList as $a) {
                                        $select = '';
                                        if (!empty($AreaID) && isset($AreaID) && $a['id'] == $AreaID) {
                                            $select = 'selected';
                                        } if ($sess['grade_id'] == 4) {
                                            foreach ($ASE_Area as $ase) {
                                                if ($ase['area_id'] == $a['id']) {
                                                    echo '<option ' . $select . ' value="' . $a['id'] . '"> ' . $a['area_name'] . '</option>';
                                                }
                                            }
                                        } else {
                                            echo '<option ' . $select . ' value="' . $a['id'] . '"> ' . $a['area_name'] . '</option>';
                                        }
                                    }
                                    ?>                                        
                                </select>              
                            </div>                     
                        </div>          
                    </div> 
                    
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Created Date:</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="post[user][datepicker1]" class="form-control pull-right" id="datepicker" value="<?= date('Y-m-d') ?>">
                            </div>
                        </div>
                    </div>
                    
                    
                   
                    <div class="col-md-3">    
                        <div class="form-group">      
                            <label class="col-md-12">Territory id<span class="text-red">*</span></label>
                            <div class="col-md-12">    
                                <input type="text" name="post[user][territory]" class="form-control" id="territoryid"  value="" readonly >
                                  
                            </div>                     
                        </div>                                          
                    </div>   
                    
                    <div class="col-md-3">    
                        <div class="form-group">      
                            <label class="col-md-12">Territory Rep Code<span class="text-red">*</span></label>
                            <div class="col-md-12">    
                                 <input type="text" name="post[user][territoryrepcode]" class="form-control" id="territoryrepcode"  value="" readonly >
                                  
                            </div>                     
                        </div>                                          
                    </div> 
                    
                    <div class="col-md-3">    
                        <div class="form-group">      
                            <label class="col-md-12">Range ID <span class="text-red">*</span></label>
                            <div class="col-md-12">    
                                 <input type="text" name="post[user][rangeid]" class="form-control" id="rangeid"  value="" readonly >
                                  
                            </div>                     
                        </div>                                          
                    </div> 
                    
                    <div class="col-md-3">    
                        <div class="form-group">      
                            <label class="col-md-12">Range Name <span class="text-red">*</span></label>
                            <div class="col-md-12">    
                                 <input type="text" name="post[user][rangename]" class="form-control" id="rangename"  value="" readonly >
                                  
                            </div>                     
                        </div>                                          
                    </div> 
                    
                    <div class="col-md-3">    
                        <div class="form-group">      
                            <label class="col-md-12"> Quota <span class="text-red">*</span></label>
                            <div class="col-md-12">    
                                 <input type="text" name="post[user][quota]" class="form-control" id="quota"  value=""  >
                                  
                            </div>                     
                        </div>                                          
                    </div> 
                    
                    <div class="col-md-3">    
                        <div class="form-group">      
                            <label class="col-md-12"> Used Quota <span class="text-red">*</span></label>
                            <div class="col-md-12">    
                                 <input type="text" name="post[user][usedquota]" class="form-control" id="usedquota"  value=""  >
                                  
                            </div>                     
                        </div>                                          
                    </div>
                    
                    <div class="form-group">
                                <div class="col-md-12">
                                    <input type="submit" class="btn btn-danger" name="submit" value="Add Quota">
                                    
                                     </div>
                            </div>
                           
                   
                </form>
                

            </div>


        </div>
    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->
<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDL5TFORfvAKrvixbuRLQWhqfNGLL8sFCY" ></script>     

<script>

                                                            $('#PauseBtn').hide();
                                                            $('#ResumeBtn').hide();

                                                            /**
                                                             * @author Dinithi & Tharaniya
                                                             * @contact damitha01@gmail.com
                                                             */

//  src="http://maps.google.lk/maps/api/js?sensor=true&key";

// map main global varibles
                                                            var _map, _path, _service, _poly, _animate_marker
                                                                    , _km_layer = 0, _point_start, _point_end,
                                                                    _sales_markers, _map_polyn, int_car = 21;

                                                            var car_spped = 250;
                                                            var ikk = 0;
                                                            var i_interval = 0;
                                                            var break_exsist = 1;
                                                            var timeee;
                                                            var down = 0;
                                                            var sss = 0;
//var total_out=0;
//var product_out=0;
//var unprodut_out=0;
//var missed_out=0;
                                                            var prev_k = -1;
                                                            /*
                                                             * 
                                                             * start and end points
                                                             */
                                                            var start_marker;
                                                            var end_marker;


// map global arrays
                                                            var time = new Array();
                                                            var _gl_sales_markers = [];
                                                            var _gl_outlet_markers = [];
                                                            var _gl_markers = [];
                                                            var _gl_polyn = [];

//routes_length, lat_lng, routes_
                                                            var mroutes_length = 0;
                                                            var mlat_lng = new Array();
                                                            var mroutes_;

                                                            var map;
                                                            var rep, date;
                                                            var bounds = [];
                                                            var drawIndex;
//check box
                                                            var nearDealers = [];
                                                            var productives = [];
                                                            var unproductives = [];
                                                            var distance;
                                                            var duration;
                                                            var startAddrs;
                                                            var _mapOptions;
                                                            var resume_k = true;

                                                            $(document).ready(function () {
                                                                //draw_agency();
                                                            });

//draw invoices map in tab2
                                                            function load_invoices_map() {
                                                                if ($('#routes').length) {
                                                                    Load_Map2();
                                                                }
                                                                $.ajax({
                                                                    type: 'post',
                                                                    url: URL + 'gmapsRoute/loadInvoicesMap',
                                                                    data: '',
                                                                    success: function (data) {
                                                                        $('#tabs-2').html(data);
                                                                        //load area details to map
                                                                        loadAreaTOinvoice();

                                                                        invmap = new GMaps({
                                                                            div: '#map_invoices',
                                                                            zoom: 8,
                                                                            lat: 7.88448800,
                                                                            lng: 80.63745900
                                                                        });
                                                                        $('#teritory_label').hide();
                                                                        $('#teritory_outlet').hide();
                                                                        $('#psa_label').hide();
                                                                        $('#psa_outlet').hide();
                                                                        $('#psazone_label').hide();
                                                                        $('#psazone_outlet').hide();

                                                                    }
                                                                });
                                                            }

                                                            function Clear_invoice() {
                                                                $('#area_outlet').val('');

//       document.getElementById("date").valueAsDate = new Date();
                                                                var today = new Date().toISOString().slice(0, 10);

                                                                $("#date").val(today);
                                                                loadAreaTOinvoice();

                                                                invmap = new GMaps({
                                                                    div: '#map_invoices',
                                                                    zoom: 8,
                                                                    lat: 7.88448800,
                                                                    lng: 80.63745900
                                                                });
                                                                $('#teritory_label').hide();
                                                                $('#teritory_outlet').hide();
                                                                $('#psa_label').hide();
                                                                $('#psa_outlet').hide();
                                                                $('#psazone_label').hide();
                                                                $('#psazone_outlet').hide();
                                                                $('#totalOutlet').val('');
                                                                $('#productOut').val('');
                                                                $('#unproductout').val('');
                                                                $('#missedout').val('');
                                                                $('#totalAmount').val('');
                                                                $('#totalDistance').val('');
                                                                $('#totalDuration').val('');
                                                            }



                                                            function Load_Map2() {


                                                                /*******************************LOAD MAP*********************************************/
                                                                _mapOptions = {
                                                                    center: new google.maps.LatLng(7.88448800, 80.63745900),
                                                                    zoom: 8,
                                                                    mapTypeId: google.maps.MapTypeId.ROADMAP
                                                                };
                                                                _map = new google.maps.Map(document.getElementById("routes"), _mapOptions);

                                                                /********************PAUSE THE MAP***********************/
                                                                resume_k = false;

                                                                /********************clear the icons on the map*************/

                                                                clearInterval(i_interval);
                                                                i_interval = 0;
                                                                time = new Array();
                                                                ikk = 0;
                                                                _km_layer = 0;
                                                                prev_k = -1;
                                                                resume_k = true;

                                                                $('#invarea_outlet').val('');
                                                                loadAreainv();
                                                                $('#invteritory_label').hide();
                                                                $('#invteritory_outlet').hide();
                                                                $('#PauseBtn').hide();
                                                                $('#ResumeBtn').hide();
                                                                $('#invpsa_label').hide();
                                                                $('#invpsa_outlet').hide();
                                                                $('#invpsazone_label').hide();
                                                                $('#invpsazone_outlet').hide();
                                                                $('#time1_label').hide();
                                                                $('#time1').hide();
                                                                $('#time2_label').hide();
                                                                $('#time2').hide();

                                                                var today = new Date().toISOString().slice(0, 10);
                                                                $("#invdate").val(today);

                                                            }


                                                            function load_path_map() {
//    alert('load_path_map');
                                                                $.ajax({
                                                                    type: 'post',
                                                                    url: URL + 'gmapsRoute/loadpathMap',
                                                                    data: '',
                                                                    success: function (data) {
                                                                        $('#tabs-5').html(data);
                                                                        //load area details to map
//            loadAreainv();
                                                                        //draw map
//            map_path = new GMaps({
//                div: '#map_path',
//                zoom: 8,
//                lat: 7.28445900,
//                lng: 80.63745900
//            });
//            $('#invteritory_label').hide();
//            $('#invteritory_outlet').hide();
//            $('#invpsa_label').hide();
//            $('#invpsa_outlet').hide();
//            $('#invpsazone_label').hide();
//            $('#invpsazone_outlet').hide();
                                                                    }
                                                                });
                                                            }

                                                            function load_route_map() {
                                                                $.ajax({
                                                                    type: 'post',
                                                                    url: URL + 'gmapsRoute/loadroute',
                                                                    data: '',
                                                                    success: function (data) {
                                                                        $('#tabs-4').html(data);
                                                                        //load area details to map
                                                                        loadAreainv();

                                                                        _mapOptions = {
                                                                            center: new google.maps.LatLng(7.88448800, 80.63745900),
                                                                            zoom: 8,
                                                                            mapTypeId: google.maps.MapTypeId.ROADMAP
                                                                        };
                                                                        _map = new google.maps.Map(document.getElementById("routes"), _mapOptions);
                                                                        $('#invteritory_label').hide();
                                                                        $('#invteritory_outlet').hide();
                                                                        $('#PauseBtn').hide();
                                                                        $('#ResumeBtn').hide();
                                                                        $('#invpsa_label').hide();
                                                                        $('#invpsa_outlet').hide();
                                                                        $('#invpsazone_label').hide();
                                                                        $('#invpsazone_outlet').hide();
                                                                        $('#time1_label').hide();
                                                                        $('#time1').hide();
                                                                        $('#time2_label').hide();
                                                                        $('#time2').hide();
                                                                    }
                                                                });
                                                            }

                                                            $(document).on('change', 'input[name="car_range"]', function (e) {
                                                                volatile_car(e);
                                                            });

                                                            function volatile_car(e) {
                                                                var v_car = parseInt($('#car_range').val());
                                                                car_spped = parseInt((int_car - v_car)) * 50;
                                                                break_exsist = 0;
//    console.log(car_spped);
                                                            }

                                                            function load_outlets_map() {
                                                                if ($('#routes').length) {
                                                                    Load_Map2();
                                                                }
//loadArea();
                                                                $.ajax({
                                                                    type: 'post',
                                                                    url: URL + 'gmapsRoute/loadOutlets',
                                                                    data: '',
                                                                    success: function (data) {
                                                                        $('#tabs-3').html(data);
                                                                        //load area details to map
                                                                        loadArea();
                                                                        //draw map
                                                                        map = new GMaps({
                                                                            div: '#map',
                                                                            zoom: 8,
                                                                            lat: 7.88448800,
                                                                            lng: 80.63745900
                                                                        });
                                                                        draw_outlets();
                                                                        $('#outteritory_label').hide();
                                                                        $('#outteritory_outlet').hide();
                                                                        $('#outpsa_label').hide();
                                                                        $('#outpsa_outlet').hide();
                                                                        $('#outpsazone_label').hide();
                                                                        $('#outpsazone_outlet').hide();
                                                                    }
                                                                });
                                                            }

                                                            function Clear_outlet() {
                                                                $('#outarea_outlet').val('');
                                                                $('#total_outlets').val('');
                                                                loadArea();

                                                                map = new GMaps({
                                                                    div: '#map',
                                                                    zoom: 8,
                                                                    lat: 7.88448800,
                                                                    lng: 80.63745900
                                                                });
                                                                draw_outlets();
                                                                $('#outteritory_label').hide();
                                                                $('#outteritory_outlet').hide();
                                                                $('#outpsa_label').hide();
                                                                $('#outpsa_outlet').hide();
                                                                $('#outpsazone_label').hide();
                                                                $('#outpsazone_outlet').hide();
                                                            }

                                                            function draw_live_route() {
//      _map.cleanRoute();
//    alert("gggg");
                                                                _mapOptions = {
                                                                    center: new google.maps.LatLng(7.88448800, 80.63745900),
                                                                    zoom: 8,
                                                                    mapTypeId: google.maps.MapTypeId.ROADMAP
                                                                };


                                                                _map = new google.maps.Map(document.getElementById("routes"), _mapOptions);

                                                                clearInterval(i_interval);
                                                                i_interval = 0;
                                                                time = new Array();
                                                                ikk = 0;
                                                                _km_layer = 0;
                                                                prev_k = -1;
                                                                resume_k = true;
                                                                $('#ResumeBtn').hide();
                                                                var zoneId;
                                                                var date;
                                                                /*      date = $('#invdate').val();
                                                                 var time1 = $('#time1').val();
                                                                 var time2 = $('#time2').val();
                                                                 //     $("#win").text('');
                                                                 
                                                                 var district = $('#invarea_outlet').val();
                                                                 var ag_area = $('#invteritory_outlet').val();
                                                                 //    var rep_area = $('#invpsa_outlet').val();
                                                                 var zonecount = $('#invzoneCount').val();
                                                                 if (zonecount == 2) {
                                                                 zoneId = $('#invteritory_outlet').val();
                                                                 } else if (zonecount == 3) {
                                                                 zoneId = $('#invpsa_outlet').val();
                                                                 } else if (zonecount == 4) {
                                                                 zoneId = $('#invpsazone_outlet').val();
                                                                 }*/


                                                                date = $('#datepicker').val();
                                                                var time1 = $('#sbFrom').val();
                                                                var time2 = $('#sbTo').val();
                                                                var user = $('#sbRep').val();
                                                                var district = 2;
                                                                var ag_area = 4;
                                                                if (date == null || date == "") {
                                                                    alert("Select Date");
                                                                } else if (district !== 0 && ag_area !== 0) {
//        alert("ikkk");
                                                                    ikk = 0;
                                                                    mroutes_length = 0;
                                                                    m_lating_push = '';
                                                                    mroutes_ = '';
                                                                    clearInterval(i_interval);
                                                                    $.ajax({
                                                                        type: 'post',
                                                                        url: '<?= base_url('hr/drawRoute') ?>',
                                                                        data: {
                                                                            date: date,
                                                                            time2: time2,
                                                                            time1: time1,
                                                                            user: user
                                                                        },
                                                                        success: function (data) {
//                alert(data);
                                                                            _point_start = '';
                                                                            _point_end = '';
                                                                            _km_layer = 0;


                                                                            var _lating_push = new Array();

                                                                            var routes_ = JSON.parse(data);

                                                                            if (typeof routes_.length != "undefined" && routes_.length > 0) {
                                                                                $('#PauseBtn').show();

                                                                                // get json array lenth
                                                                                var routes_length = routes_.length;

//                    alert('routes_length--->'+routes_length);
                                                                                //change default location first lat and lon
                                                                                _mapOptions = {
                                                                                    center: new google.maps.LatLng(routes_[0].lat, routes_[0].lon),
                                                                                    zoom: 18,
                                                                                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                                                                                    draggable: true
                                                                                };
//                    alert("2");
                                                                                // change default location set map with new options
                                                                                // _map = new google.maps.Map(document.getElementById("map"), _mapOptions);
                                                                                _map.setOptions(_mapOptions);
//                    alert("1");
                                                                                // set first marker on the map give first json object
                                                                                _animate_marker = new google.maps.Marker({position: new google.maps.LatLng(routes_[0].lat, routes_[0].lon)
                                                                                    , map: _map,
                                                                                    icon: '<?= base_url('adminlte/dist/img/gps/bike.png') ?>'
                                                                                });

                                                                                for (var i = 0; i < routes_length; i++) {

                                                                                    _lating_push.push(new google.maps.LatLng(routes_[i].lat, routes_[i].lon));
                                                                                    time.push(routes_[i].time);
//                         alert(routes_[i].time);

                                                                                }
                                                                                var l = time.length;
//                    alert('l---->'+l);
                                                                                mroutes_length = routes_length;
                                                                                m_lating_push = _lating_push;
                                                                                mroutes_ = routes_;
//                    alert('len----->'+m_lating_push.length);
                                                                                addrouteWithTimeout();
                                                                            } else {
                                                                                alert('DATA NOT FOUND');
                                                                            }

                                                                        }
                                                                    });
                                                                }
                                                            }

                                                            function kzonec44() {

                                                                $('#ResumeBtn').hide();
                                                                $('#PauseBtn').show();

                                                                resume_k = true;
                                                                ikk = prev_k;
                                                                addrouteWithTimeout();

//        show_Pause();
                                                            }
                                                            function kzonec33() {

                                                                resume_k = false;
                                                                $('#PauseBtn').hide();
                                                                $('#ResumeBtn').show();
                                                            }


                                                            function addrouteWithTimeout() {
                                                                if (resume_k == true) {

                                                                    i_interval = window.setTimeout(addrouteWithTimeout, car_spped);

                                                                    if ((ikk + 1) <= m_lating_push.length) {

                                                                        $("#win").text(time[ikk]);

                                                                        //create new lating points

                                                                        _point_start = (m_lating_push[ikk]);
//        _point_end = (m_lating_push[ikk + 1]);
                                                                        if (m_lating_push[ikk + 1]) {
                                                                            _point_end = (m_lating_push[ikk + 1]);
                                                                        } else {
                                                                            _point_end = (m_lating_push[ikk]);
                                                                        }


                                                                        //set new lating pont to Polyline
                                                                        var map_polyn = new google.maps.Polyline({
                                                                            path: [_point_start,
                                                                                _point_end],
                                                                            map: _map,
                                                                            strokeColor: "red",
                                                                            strokeWeight: 4
                                                                        });

//                    _gl_polyn.push(map_polyn);
//
                                                                        _animate_marker.setPosition(_point_end);
//      alert(_point_end);
                                                                        _map.panTo(_point_end);
                                                                        _map.setOptions({zoom: 17});
//
                                                                        _km_layer += (google.maps.geometry.spherical.computeDistanceBetween(_point_start, _point_end) / 1000);
                                                                        $('#km_ly').text(_km_layer.toFixed(2) + ' km');


                                                                    }
                                                                    prev_k = ikk;
                                                                    ikk++;
                                                                }
                                                            }

                                                            function clear_draw_polyn() {
                                                                // _gl_polyn

                                                                _km_layer = 0;
                                                                var cl_pol = '';
                                                                if (typeof _animate_marker != 'undefined') {
                                                                    _animate_marker.setMap(null);
                                                                }

                                                                $.each(_lating_push, function (index, value) {
                                                                    cl_pol = value;
                                                                    cl_pol.setMap(null);
                                                                });

                                                                $.each(map_polyn, function (index, value) {
                                                                    cl_pol = value;
                                                                    cl_pol.setMap(null);
                                                                });

                                                                clearInterval(i_interval);
                                                                i_interval = 0;
                                                                ikk = 0;
                                                                _km_layer = 0;
//        car_spped = 500;
//        deg = 0;
//        lowcg = base_url + 'public/css/images/lorry/green.png';
//        lowcgstrok = "#008BFF";
                                                                resume_k = true;
                                                                prev_k = -1;
//        extkzone = false;


                                                            }

//$("#myValues").myfunc({divFact: 10, eventListenerType: 'keyup'});

                                                            function draw_outlets() {

                                                                map.removeMarkers();
                                                                $.ajax({
                                                                    type: 'post',
                                                                    url: URL + 'gmapsRoute/get_outlets',
                                                                    data: '',
                                                                    success: function (data) {
                                                                        var outlets = JSON.parse(data);
                                                                        var totaloutletCount = outlets.length;
                                                                        $('#total_outlets').val(totaloutletCount);
                                                                        setOutletMarker(outlets);
                                                                    }
                                                                });
                                                            }

                                                            function draw_agency() {
                                                                $.ajax({
                                                                    type: 'post',
                                                                    url: URL + 'gmapsRoute/display_agency',
                                                                    data: '',
                                                                    success: function (data) {

//            console.log(data);
                                                                        repmap = new GMaps({
                                                                            div: '#repmap',
                                                                            zoom: 8,
                                                                            lat: 7.28445900,
                                                                            lng: 80.63745900
                                                                        });
                                                                        var agency = JSON.parse(data);
//            console.log(agency);

                                                                        setAgencyMarker(agency);
                                                                    }
                                                                });
                                                            }


//set queried outlet geocodes to map
                                                            function setOutletMarker(outlets) {
                                                                map.removeMarkers();
                                                                var arrr = [];
                                                                if (outlets) {
                                                                    for (var x = 0; x < outlets.length; x++) {

                                                                        arrr.push({
                                                                            lat: outlets[x].lat,
                                                                            lng: outlets[x].lon,
                                                                            icon: URL + 'public/images/Pink-icon.png',
                                                                            show_token: 0,
                                                                            infoWindow: {
                                                                                content: '<table>'
                                                                                        + '<tr>'
                                                                                        + '<td>Outlet Name</td>'
                                                                                        + '<td>:</td>'
                                                                                        + '<td>' + outlets[x].o_name + '</td>'
                                                                                        + '</tr>'
                                                                                        + '<tr>'
                                                                                        + '<td>Address</td>'
                                                                                        + '<td>:</td>'
                                                                                        + '<td>' + outlets[x].o_address + '</td>'
                                                                                        + '</tr>'
                                                                                        + '<tr>'
                                                                                        + '<td>Owner Name</td>'
                                                                                        + '<td>:</td>'
                                                                                        + '<td>' + outlets[x].o_person_name + '</td>'
                                                                                        + '</tr>'
                                                                                        + '<tr>'
                                                                                        + '<td>Contact No</td>'
                                                                                        + '<td>:</td>'
                                                                                        + '<td>' + outlets[x].o_mobile + '</td>'
                                                                                        + '</tr>'
                                                                                        + '<tr>'
                                                                                        + '<td>DOB</td>'
                                                                                        + '<td>:</td>'
                                                                                        + '<td>' + outlets[x].o_ownerDob + '</td>'
                                                                                        + '</tr>'
                                                                                        + '<tr>'
                                                                                        + '<td>Assistant Name</td>'
                                                                                        + '<td>:</td>'
                                                                                        + '<td>' + outlets[x].o_assistntName + '</td>'
                                                                                        + '</tr>'
                                                                                        + '<tr>'
                                                                                        + '<td></td>'
                                                                                        + '<td>:</td>'
                                                                                        + '<td>' + '<img src="' + URL + '/view/img-outlets-unproductive/' + outlets[x].o_photograph_url + '" width="200px" height="150px"></td>'
                                                                                        + '</tr>'
                                                                                        + '</table>'
                                                                            },
                                                                            mouseclick: function (e) {
                                                                                this.infoWindow.open(this.map, this);
                                                                            }

                                                                        });
                                                                    }
                                                                    map.addMarkers(arrr);
                                                                } else {
                                                                    alert("no outlet found");
                                                                }
                                                            }
                                                            /*Show agency and his details*/
                                                            function setAgencyMarker(agency) {

                                                                repmap.removeMarkers();
                                                                var arrr = [];
                                                                var count = 0;
                                                                if (agency) {
                                                                    for (var x = 0; x < agency.length; x++) {
                                                                        count++;

                                                                        arrr.push({
                                                                            lat: agency[x].lat,
                                                                            lng: agency[x].lon,
                                                                            animation: google.maps.Animation.DROP,
                                                                            icon: URL + 'public/images/gmap/gmap-marker.png',
                                                                            show_token: 0,
                                                                            infoWindow: {
                                                                                content: '<table>'

                                                                                        + '<tr>'
                                                                                        + '<td>Agency Name</td>'
                                                                                        + '<td>:</td>'
                                                                                        + '<td>' + agency[x].u_first_name + '</td>'
                                                                                        + '</tr>'
                                                                                        + '<tr>'
                                                                                        + '<td>Contact No</td>'
                                                                                        + '<td>:</td>'
                                                                                        + '<td>' + agency[x].cn_number + '</td>'
                                                                                        + '</tr>'
                                                                                        + '<tr>'
                                                                                        + '<td>Address</td>'
                                                                                        + '<td>:</td>'
                                                                                        + '<td>' + agency[x].u_postal_address + '</td>'
                                                                                        + '</tr>'
                                                                                        + '<tr>'
                                                                                        + '<tr>'
                                                                                        + '<td>' + '<input type="button" onclick="rep_current_position(' + agency[x].id_position + ');" value="Show Rep"/></td>' + '</tr>'
                                                                                        + '</table>    <div id="dd"></div>'
                                                                            },
                                                                            mouseclick: function (e) {
                                                                                this.infoWindow.open(this.map, rep_current_position(agency[x].id_position));
                                                                                // alert("hiiiii");
                                                                            }
                                                                        });
                                                                    }
                                                                    repmap.addMarkers(arrr);
                                                                } else {
                                                                    alert("no agency found");
                                                                }
                                                            }

                                                            /*call the controller function for rep_current position*/
                                                            function rep_current_position(id_position) {
                                                                var infowindow = new google.maps.InfoWindow();
                                                                $.ajax({
                                                                    type: 'post',
                                                                    url: URL + 'gmapsRoute/get_rep_current_position',
                                                                    data: {'idposition': id_position},
                                                                    success: function (data) {
                                                                        var rep = JSON.parse(data);
                                                                        if (rep == "") {
                                                                            infowindow.close();
                                                                            alert('Agency hasn\'t any Active Routing');
//                draw_rep_route
                                                                        } else {
//                console.log(data);
                                                                            setRepMarker(rep);
                                                                        }
                                                                    }
                                                                });
                                                            }

                                                            /*set rep current position*/
                                                            function setRepMarker(rep) {
//    alert(rep);
                                                                repmap.removeMarkers();
                                                                var arrr = [];
                                                                var count = 0;
                                                                if (rep != null) {
                                                                    for (var x = 0; x < rep.length; x++) {
                                                                        count++;
                                                                        arrr.push({
                                                                            lat: rep[x].lat,
                                                                            lng: rep[x].lon,
                                                                            zoom: 4,
                                                                            animation: google.maps.Animation.BOUNCE,
                                                                            icon: URL + 'public/images/gmap/blue-icon.png',
                                                                            show_token: 0,
                                                                            infoWindow: {
                                                                                content: '<table>'
                                                                                        + '<tr>'
                                                                                        + '<td>Rep Name</td>'
                                                                                        + '<td>:</td>'
                                                                                        + '<td>' + rep[x].u_first_name + '</td>'
                                                                                        + '</tr>'
                                                                                        + '<tr>'
                                                                                        + '<td>Address</td>'
                                                                                        + '<td>:</td>'
                                                                                        + '<td>' + rep[x].u_postal_address + '</td>'
                                                                                        + '</tr>'
                                                                                        + '<tr>'
                                                                                        + '<td>Photo</td>'
                                                                                        + '<td>:</td>'
                                                                                        + '<td>' + rep[x].u_photograph + '</td>'
                                                                                        + '</tr>'
//                            + '<tr>'
//                            + '<td>' + '<input type="button" onclick=" draw_rep_route(' + rep[x].idPosition + ',' + rep[x].idposition_parent + ');" value="Draw Route"/></td>'
//                            + '</tr>'
                                                                                        + '</table>    <div id="dd"></div>'
                                                                            },
                                                                            mouseclick: function (e) {
                                                                                this.infoWindow.open(this.map, draw_rep_route(rep[x].idPosition, rep[x].idposition_parent));

                                                                            }

                                                                        });
                                                                        var idPosition = rep[x].idPosition;
                                                                        var idposition_parent = rep[x].idposition_parent;
                                                                        draw_rep_route(idPosition, idposition_parent);
                                                                        //alert( idPosition);
                                                                    }
//        alert(arrr);
                                                                    repmap.addMarkers(arrr);
                                                                } else {
                                                                    alert("no rep found");

                                                                }
                                                            }
//set queried invoices geocodes to map
                                                            function setInvoiceMarker(invoices) {
//alert('setInvoiceMarker');
                                                                var arrr = [];
                                                                var count = 0;
                                                                var totalamt = 0;
                                                                if (invoices) {
                                                                    for (var x = 0; x < invoices.length; x++) {
                                                                        count++;
                                                                        var image = "public/images/number_pink/" + count + ".png";
                                                                        var invNetTot = (parseInt(invoices[x].invTot[0].invItemPrice) - (parseInt(invoices[x].invReturn[0].invreturn)));
                                                                        var amt = invoices[x].pm_amount;
                                                                        var amt = invNetTot;
                                                                        totalamt += parseInt(amt);// + parseInt(totalamt);
//            alert(totalamt);
//            alert(image)
//alert(invoices[x].invTot[0].invId);
                                                                        arrr.push({
                                                                            lat: invoices[x].lat,
                                                                            lng: invoices[x].lon,
                                                                            icon: URL + image,
//                shadow: icon,
                                                                            infoWindow: {
                                                                                content: '<table>'
                                                                                        + '<tr>'
                                                                                        + '<td>Order Sequence</td>'
                                                                                        + '<td>:</td>'
                                                                                        + '<td>' + count + '</td>'
                                                                                        + '</tr>'
                                                                                        + '<tr>'
                                                                                        + '<td>Rep Name</td>'
                                                                                        + '<td>:</td>'
                                                                                        + '<td>' + invoices[x].u_first_name + '</td>'
                                                                                        + '</tr>'
                                                                                        + '<tr>'
                                                                                        + '<td>Outlet Name</td>'
                                                                                        + '<td>:</td>'
                                                                                        + '<td>' + invoices[x].o_name + '</td>'
                                                                                        + '</tr>'
                                                                                        + '<tr>'
                                                                                        + '<td>Address</td>'
                                                                                        + '<td>:</td>'
                                                                                        + '<td>' + invoices[x].o_address + '</td>'
                                                                                        + '</tr>'
                                                                                        + '<tr>'
                                                                                        + '<td>Invoice Date</td>'
                                                                                        + '<td>:</td>'
                                                                                        + '<td>' + invoices[x].i_date + '</td>'
                                                                                        + '</tr>'
                                                                                        + '<tr>'
                                                                                        + '<td>Invoice Time</td>'
                                                                                        + '<td>:</td>'
                                                                                        + '<td>' + invoices[x].i_time + '</td>'
                                                                                        + '</tr>'
                                                                                        + '<tr>'
                                                                                        + '<td>Invoice No</td>'
                                                                                        + '<td>:</td>'
                                                                                        + '<td>' + invoices[x].i_code + '</td>'
                                                                                        + '</tr>'
                                                                                        + '<tr hidden>'
                                                                                        + '<td>Invoice Total Kg</td>'
                                                                                        + '<td>:</td>'
                                                                                        + '<td>' + invoices[x].invtotKg[0].invItemTotkg + " " + 'Kg' + '</td>'
                                                                                        + '</tr>'
                                                                                        + '<tr>'
                                                                                        + '<td>Invoice Gross Total</td>'
                                                                                        + '<td>:</td>'
                                                                                        + '<td>' + number_format(invoices[x].invTot[0].invItemPrice, 2) + '</td>'
                                                                                        + '</tr>'
                                                                                        + '<tr>'
                                                                                        + '<td>Invoice Return</td>'
                                                                                        + '<td>:</td>'
                                                                                        + '<td>' + invoices[x].invReturn[0].invreturn + '</td>'
                                                                                        + '</tr>'
                                                                                        + '<tr>'
                                                                                        + '<td>Invoice Net Total</td>'
                                                                                        + '<td>:</td>'
                                                                                        + '<td>' + number_format(invNetTot, 2) + '</td>'
                                                                                        + '</tr>'
                                                                                        + '<td>' + '<input type="button" onclick="view_invoice(' + invoices[x].idinvoice1 + ');" value="View Invoice"/></td>'
                                                                                        + '</table><div id="dd"></div>'
                                                                            },
                                                                            mouseclick: function (e) {
                                                                                this.infoWindow.open(this.map, view_invoice(invoices[x].idinvoice));
                                                                            }
                                                                        });
                                                                        invmap.addMarkers(arrr);
//                setntInvoiceMap();
//            }
                                                                    }
                                                                    $('#totalAmount').val("Rs." + " " + number_format(totalamt, 2));
                                                                } else {
                                                                    alert("no invoices found");
                                                                }
                                                            }



// outlet load area
                                                            function loadArea() {
//    alert('loadArea');
                                                                $.ajax({
                                                                    type: 'POST',
                                                                    url: URL + 'gmapsRoute/getArea',
                                                                    data: {},
                                                                    success: function (data) {
//            alert(data);

                                                                        var areas = JSON.parse(data);
                                                                        for (var i = 0; i < areas.length; i++) {
                                                                            $('#outarea_outlet').append("<option id=\"" + areas[i].idzone + "\" value=\"" + areas[i].idzone + "\">" + areas[i].z_name + "</option>");
                                                                        }
                                                                    }

                                                                });
                                                            }

//auto load area
                                                            function loadAreainv() {

                                                                $.ajax({
                                                                    type: 'POST',
                                                                    url: URL + 'gmapsRoute/getArea',
                                                                    data: {},
                                                                    success: function (data) {
//            alert(data);

                                                                        var areas = JSON.parse(data);
                                                                        for (var i = 0; i < areas.length; i++) {
                                                                            $('#invarea_outlet').append("<option id=\"" + areas[i].idzone + "\" value=\"" + areas[i].idzone + "\">" + areas[i].z_name + "</option>");
                                                                        }
                                                                    }

                                                                });
                                                            }

//auto load area for invoice map
                                                            function loadAreaTOinvoice() {
//alert('mekmdk');
                                                                $.ajax({
                                                                    type: 'POST',
                                                                    url: URL + 'gmapsRoute/getArea',
                                                                    data: {},
                                                                    success: function (data) {
//            alert(data);

                                                                        var areas = JSON.parse(data);
                                                                        for (var i = 0; i < areas.length; i++) {
                                                                            $('#area_outlet').append("<option id=\"" + areas[i].idzone + "\" value=\"" + areas[i].idzone + "\">" + areas[i].z_name + "</option>");
                                                                        }
                                                                    }

                                                                });
                                                            }

//outlet load by teritory search
                                                            function getTeritory() {
                                                                $('#outzoneCount').val(1); //for query purpose

                                                                var areaId = $('#outarea_outlet').val();
                                                                $('#outteritory_outlet').html("");
                                                                $('#outpsa_outlet').hide();
                                                                $('#outpsa_label').hide();
                                                                // $('#route_outlet').hide();
                                                                //$('#route_label').hide();
                                                                $('#outpsa_outlet').append("");
                                                                $.ajax({
                                                                    type: 'POST',
                                                                    url: URL + 'gmapsRoute/getTeritory',
                                                                    data: {areaId: areaId},
                                                                    success: function (data) {
                                                                        // $('#route_outlet').hide();
                                                                        //$('#route_label').hide();

                                                                        $('#outteritory_label').show();
                                                                        $('#outteritory_outlet').show();
                                                                        var teritory = JSON.parse(data);
                                                                        $('#outteritory_outlet').append("<option id=\"teritory_0\" value=\"0\">Select Teritory</option>");
                                                                        for (var i = 0; i < teritory.length; i++) {
                                                                            $('#outteritory_outlet').append("<option id=\"" + teritory[i].idzone + "\" value=\"" + teritory[i].idzone + "\">" + teritory[i].z_name + "</option>");
                                                                        }
                                                                    }
                                                                });
                                                            }

//path load by teritory search
                                                            function getTeritoryinv() {
                                                                $('#invzoneCount').val(1); //for query purpose

                                                                var areaId = $('#invarea_outlet').val();
                                                                $('#invteritory_outlet').html("");
                                                                $('#invpsa_outlet').hide();
                                                                $('#invpsa_label').hide();
                                                                $('#invpsa_outlet').append("");
                                                                //alert(areaId);
                                                                $.ajax({
                                                                    type: 'POST',
                                                                    url: URL + 'gmapsRoute/getTeritory',
                                                                    data: {areaId: areaId},
                                                                    success: function (data) {

                                                                        $('#invteritory_label').show();
                                                                        $('#invteritory_outlet').show();
                                                                        var teritory = JSON.parse(data);
                                                                        //alert(teritory)
                                                                        $('#invteritory_outlet').append("<option id=\"invteritory_0\" value=\"0\">Select Teritory</option>");
                                                                        for (var i = 0; i < teritory.length; i++) {
                                                                            $('#invteritory_outlet').append("<option id=\"" + teritory[i].idzone + "\" value=\"" + teritory[i].idzone + "\">" + teritory[i].z_name + "</option>");
                                                                        }
                                                                    }

                                                                });
                                                            }
//invoice load by teritory search
                                                            function InvgetTeritory() {
                                                                $('#zoneCount').val(1); //for query purpose

                                                                var areaId = $('#area_outlet').val();
                                                                $('#teritory_outlet').html("");
                                                                $('#psa_outlet').hide();
                                                                $('#psa_label').hide();
                                                                $('#psa_outlet').append("");
                                                                //alert(areaId);
                                                                $.ajax({
                                                                    type: 'POST',
                                                                    url: URL + 'gmapsRoute/getTeritory',
                                                                    data: {areaId: areaId},
                                                                    success: function (data) {

                                                                        $('#teritory_label').show();
                                                                        $('#teritory_outlet').show();
                                                                        var teritory = JSON.parse(data);
                                                                        //alert(teritory)
                                                                        $('#teritory_outlet').append("<option id=\"invteritory_0\" value=\"0\">Select Teritory</option>");
                                                                        for (var i = 0; i < teritory.length; i++) {
                                                                            $('#teritory_outlet').append("<option id=\"" + teritory[i].idzone + "\" value=\"" + teritory[i].idzone + "\">" + teritory[i].z_name + "</option>");
                                                                        }
                                                                    }

                                                                });
                                                            }
//route load by psa search
                                                            function getPSA() {

                                                                var teritoryId = $('#outteritory_outlet').val();
                                                                if (teritoryId !== 'teritory_0') {
                                                                    $('#outzoneCount').val(2); //for query purpose
                                                                } else {
                                                                    $('#outzoneCount').val(1);
                                                                }


                                                                $('#outpsa_outlet').html("");
                                                                // $('#route_outlet').hide();
                                                                //$('#route_label').hide();
                                                                // $('#route_outlet').append("");
                                                                $.ajax({
                                                                    type: 'POST',
                                                                    url: URL + 'gmapsRoute/getPSA',
                                                                    data: {teritoryId: teritoryId},
                                                                    success: function (data) {

                                                                        $('#outpsa_label').show();
                                                                        $('#outpsa_outlet').show();
                                                                        var psa = JSON.parse(data);
                                                                        $('#outpsa_outlet').append("<option id=\"psa_0\" value=\"0\">Select PSA</option>");
                                                                        for (var i = 0; i < psa.length; i++) {
                                                                            $('#outpsa_outlet').append("<option id=\"" + psa[i].idzone + "\" value=\"" + psa[i].idzone + "\">" + psa[i].z_name + "</option>");
                                                                        }
                                                                    }

                                                                });
                                                            }

//outlet load by psa search
                                                            function outgetPSA() {

                                                                var teritoryId = $('#outteritory_outlet').val();
                                                                if (teritoryId !== 'teritory_0') {
                                                                    $('#outzoneCount').val(2); //for query purpose
                                                                } else {
                                                                    $('#outzoneCount').val(1);
                                                                }


                                                                $('#outpsa_outlet').html("");
                                                                // $('#route_outlet').hide();
                                                                //$('#route_label').hide();
                                                                // $('#route_outlet').append("");
                                                                $.ajax({
                                                                    type: 'POST',
                                                                    url: URL + 'gmapsRoute/getPSA',
                                                                    data: {teritoryId: teritoryId},
                                                                    success: function (data) {

                                                                        $('#psa_label').show();
                                                                        $('#outpsa_outlet').show();
                                                                        var psa = JSON.parse(data);
                                                                        $('#outpsa_outlet').append("<option id=\"psa_0\" value=\"0\">Select PSA</option>");
                                                                        for (var i = 0; i < psa.length; i++) {
                                                                            $('#outpsa_outlet').append("<option id=\"" + psa[i].idzone + "\" value=\"" + psa[i].idzone + "\">" + psa[i].z_name + "</option>");
                                                                        }
                                                                    }

                                                                });
                                                            }
                                                            function getPSAInv() {
                                                                var teritoryId = $('#invteritory_outlet').val();
                                                                if (teritoryId !== 'invteritory_0') {
                                                                    $('#invzoneCount').val(2); //for query purpose
                                                                } else {
                                                                    $('#invzoneCount').val(1);
                                                                }


                                                                $('#invpsa_outlet').html("");
                                                                $.ajax({
                                                                    type: 'POST',
                                                                    url: URL + 'gmapsRoute/getPSA',
                                                                    data: {teritoryId: teritoryId},
                                                                    success: function (data) {

                                                                        $('#invpsa_label').show();
                                                                        $('#invpsa_outlet').show();
                                                                        var psa = JSON.parse(data);
                                                                        $('#invpsa_outlet').append("<option id=\"invpsa_0\" value=\"0\">Select PSA</option>");
                                                                        for (var i = 0; i < psa.length; i++) {
                                                                            $('#invpsa_outlet').append("<option id=\"" + psa[i].idzone + "\" value=\"" + psa[i].idzone + "\">" + psa[i].z_name + "</option>");
                                                                        }
                                                                    }

                                                                });
                                                                getTime();
                                                            }

                                                            function IngetPSA() {
                                                                var teritoryId = $('#teritory_outlet').val();
                                                                if (teritoryId !== 'invteritory_0') {
                                                                    $('#zoneCount').val(2); //for query purpose
                                                                } else {
                                                                    $('#zoneCount').val(1);
                                                                }


                                                                $('#psa_outlet').html("");
                                                                $.ajax({
                                                                    type: 'POST',
                                                                    url: URL + 'gmapsRoute/getPSA',
                                                                    data: {teritoryId: teritoryId},
                                                                    success: function (data) {

                                                                        $('#psa_label').show();
                                                                        $('#psa_outlet').show();
                                                                        var psa = JSON.parse(data);
                                                                        $('#psa_outlet').append("<option id=\"invpsa_0\" value=\"0\">Select PSA</option>");
                                                                        for (var i = 0; i < psa.length; i++) {
                                                                            $('#psa_outlet').append("<option id=\"" + psa[i].idzone + "\" value=\"" + psa[i].idzone + "\">" + psa[i].z_name + "</option>");
                                                                        }
                                                                    }

                                                                });
//    getTime();
                                                            }

                                                            function getTime() {
                                                                var teritoryId = $('#invteritory_outlet').val();
                                                                var date = $('#invdate').val();

                                                                $('#time1').html("");
                                                                $('#time2').html("");
                                                                $.ajax({
                                                                    type: 'POST',
                                                                    url: URL + 'gmapsRoute/getTime',
                                                                    data: {teritoryId: teritoryId,
                                                                        date: date},
                                                                    success: function (data) {
//            alert(data);
                                                                        console.log(data);

                                                                        var time1 = JSON.parse(data);
                                                                        var datacount = time1.length;
                                                                        if (datacount > 0) {
                                                                            $('#time1_label').show();
                                                                            $('#time1').show();
                                                                            $('#time2_label').show();
                                                                            $('#time2').show();
                                                                            $('#time1').append("<option id=\"time1_0\" value=\"0\">Select Time</option>");
                                                                            $('#time2').append("<option id=\"time2_0\" value=\"0\">Select Time</option>");
                                                                            for (var i = 0; i < time1.length; i++) {
                                                                                $('#time1').append("<option id=\"" + time1[i].time + "\" value=\"" + time1[i].time + "\">" + time1[i].time + "</option>");
                                                                                $('#time2').append("<option id=\"" + time1[i].time + "\" value=\"" + time1[i].time + "\">" + time1[i].time + "</option>");
                                                                            }

                                                                        } else {
                                                                            alert('DATA NOT FOUND');
                                                                        }

                                                                    }

                                                                });
                                                            }


                                                            function setPSA() {

                                                                var psaId = $('#outpsa_outlet').val();
//    alert(psaId);

                                                                if (psaId !== 'psa_0') {
                                                                    $('#outzoneCount').val(3); //for query purpose

                                                                    $('#outpsazone_outlet').html("");
                                                                    $.ajax({
                                                                        type: 'POST',
                                                                        url: URL + 'gmapsRoute/getPSAzone',
                                                                        data: {psaId: psaId},
                                                                        success: function (data) {

                                                                            $('#outpsazone_label').show();
                                                                            $('#outpsazone_outlet').show();
                                                                            var psazone = JSON.parse(data);
                                                                            $('#outpsazone_outlet').append("<option id=\"psazone_0\" value=\"0\">Select PSA Zone</option>");
                                                                            for (var i = 0; i < psazone.length; i++) {
                                                                                $('#outpsazone_outlet').append("<option id=\"" + psazone[i].idzone + "\" value=\"" + psazone[i].idzone + "\">" + psazone[i].z_name + "</option>");
                                                                            }
                                                                        }

                                                                    });
                                                                } else {
                                                                    $('#outzoneCount').val(2);
                                                                    $('#outpsazone_label').hide();
                                                                    $('#outpsazone_outlet').hide();
                                                                }
                                                            }

                                                            function setPSAinv() {

//    var psaId = $('#invpsa_outlet').val();
//    if (psaId !== 'invpsa_0') {
//        $('#invzoneCount').val(3); //for query purpose
//    } else {
//        $('#invzoneCount').val(2);
//    }
                                                                var psaId = $('#invpsa_outlet').val();
//    alert(psaId);

                                                                if (psaId !== 'psa_0') {
                                                                    $('#invzoneCount').val(3); //for query purpose

                                                                    $('#psazone_outlet').html("");
                                                                    $.ajax({
                                                                        type: 'POST',
                                                                        url: URL + 'gmapsRoute/getPSAzone',
                                                                        data: {psaId: psaId},
                                                                        success: function (data) {

                                                                            $('#invpsazone_label').show();
                                                                            $('#invpsazone_outlet').show();
                                                                            var psazone = JSON.parse(data);
                                                                            $('#invpsazone_outlet').append("<option id=\"invpsazone_0\" value=\"invpsazone_0\">Select PSA Zone</option>");
                                                                            for (var i = 0; i < psazone.length; i++) {
                                                                                $('#invpsazone_outlet').append("<option id=\"" + psazone[i].idzone + "\" value=\"" + psazone[i].idzone + "\">" + psazone[i].z_name + "</option>");
                                                                            }
                                                                        }
                                                                    });
                                                                } else {
                                                                    $('#invzoneCount').val(2);
                                                                    $('#invpsazone_label').hide();
                                                                    $('#invpsazone_outlet').hide();
                                                                }
                                                            }

                                                            function InsetPSA() {

//    var psaId = $('#invpsa_outlet').val();
//    if (psaId !== 'invpsa_0') {
//        $('#invzoneCount').val(3); //for query purpose
//    } else {
//        $('#invzoneCount').val(2);
//    }
                                                                var psaId = $('#psa_outlet').val();
//    alert(psaId);

                                                                if (psaId !== 'psa_0') {
                                                                    $('#zoneCount').val(3); //for query purpose

                                                                    $('#psazone_outlet').html("");
                                                                    $.ajax({
                                                                        type: 'POST',
                                                                        url: URL + 'gmapsRoute/getPSAzone',
                                                                        data: {psaId: psaId},
                                                                        success: function (data) {
//                   alert(data);
                                                                            $('#psazone_label').show();
                                                                            $('#psazone_outlet').show();
                                                                            var psazone = JSON.parse(data);
                                                                            $('#psazone_outlet').append("<option id=\"invpsazone_0\" value=\"invpsazone_0\">Select PSA Zone</option>");
                                                                            for (var i = 0; i < psazone.length; i++) {
                                                                                $('#psazone_outlet').append("<option id=\"" + psazone[i].idzone + "\" value=\"" + psazone[i].idzone + "\">" + psazone[i].z_name + "</option>");
                                                                            }
                                                                        }
                                                                    });
                                                                } else {
                                                                    $('#zoneCount').val(2);
                                                                    $('#psazone_label').hide();
                                                                    $('#psazone_outlet').hide();
                                                                }
                                                            }

                                                            function routeset() {

                                                                var psazoneId = $('#outpsazone_outlet').val();
//    alert(psaId);

                                                                if (psazoneId !== 'psazone_0') {
                                                                    $('#outzoneCount').val(4); //for query purpose

                                                                } else {
                                                                    $('#outzoneCount').val(3);
                                                                }
                                                            }

                                                            function routesetinv() {
                                                                var psazoneId = $('#invpsazone_outlet').val();
//    alert(psaId);

                                                                if (psazoneId !== 'invpsazone_0') {
                                                                    $('#invzoneCount').val(4); //for query purpose

                                                                } else {
                                                                    $('#invzoneCount').val(3);
                                                                }


                                                            }

                                                            function Inrouteset() {
                                                                var psazoneId = $('#psazone_outlet').val();
//    alert(psaId);

                                                                if (psazoneId !== 'invpsazone_0') {
                                                                    $('#zoneCount').val(4); //for query purpose

                                                                } else {
                                                                    $('#zoneCount').val(3);
                                                                }


                                                            }

                                                            function setOutletMap() {

                                                                map.removeMarkers();
                                                                map.cleanRoute();
                                                                $('#total_outlets').val('');
                                                                //var agencyId = $('#area_outlet').val();
                                                                var zoneId;
//    alert('zoneId'+zoneId);
                                                                var zonecount = $('#outzoneCount').val();
                                                                if (zonecount == 1) {
                                                                    zoneId = $('#outarea_outlet').val();
                                                                } else if (zonecount == 2) {
                                                                    zoneId = $('#outteritory_outlet').val();
                                                                } else if (zonecount == 3) {
                                                                    zoneId = $('#outpsa_outlet').val();
                                                                } else if (zonecount == 4) {
                                                                    zoneId = $('#outpsazone_outlet').val();
                                                                }

                                                                $.ajax({
                                                                    type: 'post',
                                                                    url: URL + 'gmapsRoute/search_outlets',
                                                                    data: {zoneId: zoneId, count: zonecount},
                                                                    success: function (data) {
//            alert(data);
                                                                        var outlets = JSON.parse(data);
                                                                        var totaloutletCount = outlets.length;
                                                                        $('#total_outlets').val(totaloutletCount);
                                                                        setOutletMarker(outlets);
//            draw_route();
                                                                        //setAgencyMarker(agency);

                                                                    }
                                                                });
                                                            }


                                                            function setInvoiceMap() {
//    alert("eeee");
                                                                var invoiceDate = $('#date').val();
//    alert(invoiceDate);
                                                                invmap.removeMarkers();
                                                                invmap.cleanRoute();
                                                                var zoneId;
                                                                var zonecount = $('#zoneCount').val();
                                                                if (zonecount == 1) {
                                                                    zoneId = $('#area_outlet').val();
                                                                } else if (zonecount == 2) {
                                                                    zoneId = $('#teritory_outlet').val();
                                                                } else if (zonecount == 3) {
                                                                    zoneId = $('#psa_outlet').val();
                                                                } else if (zonecount == 4) {
                                                                    zoneId = $('#psazone_outlet').val();
                                                                }
                                                                if (invoiceDate != "") {
//        alert('zoneId'+zoneId);
//        alert('zonecount'+zonecount);

                                                                    $.ajax({
                                                                        type: 'post',
                                                                        url: URL + 'gmapsRoute/search_invoices',
                                                                        data: {
                                                                            zoneId: zoneId,
                                                                            count: zonecount,
                                                                            invoiceDate: invoiceDate
                                                                        },

                                                                        success: function (data) {
//                console.log(data);
//                alert('invoice'+data);
                                                                            var arr = JSON.parse(data);

                                                                            $('#totalOutlet').val(arr['outletcount']);
                                                                            $('#productOut').val(arr['productive']);
                                                                            var invoices = arr['data'];
                                                                            var productive = arr['productive'];
                                                                            var outletcount = arr['outletcount'];

                                                                            getUnproductive(productive, outletcount);//draw unproductives *************
                                                                            setInvoiceMarker(invoices);
                                                                            //draw_route();
                                                                        }
                                                                    });
                                                                } else {
                                                                    alert("Please select invoice date..!");
                                                                }
                                                            }

                                                            function setmissedout() {
                                                                var invoiceDate = $('#invdate').val();
//    invmap.removeMarkers();
//    invmap.cleanRoute();
                                                                var zoneId;
                                                                var zonecount = $('#invzoneCount').val();
                                                                if (zonecount == 1) {
                                                                    zoneId = $('#invarea_outlet').val();
                                                                } else if (zonecount == 2) {
                                                                    zoneId = $('#invteritory_outlet').val();
                                                                } else if (zonecount == 3) {
                                                                    zoneId = $('#invpsa_outlet').val();
                                                                } else if (zonecount == 4) {
                                                                    zoneId = $('#invpsazone_outlet').val();
                                                                }
                                                                if (invoiceDate != "") {
                                                                    $.ajax({
                                                                        type: 'post',
                                                                        url: URL + 'gmapsRoute/route_outlet',
                                                                        data: {
                                                                            zoneId: zoneId,
                                                                            count: zonecount,
                                                                            invoiceDate: invoiceDate
                                                                        },
                                                                        success: function (data) {
//               console.log(data);
                                                                            var arr = JSON.parse(data);
                                                                            setNtInvoiceMarker(arr);
                                                                        }
                                                                    });
                                                                } else {
                                                                    alert("Please select invoice date..!");
                                                                }
                                                            }

                                                            function setNtInvoiceMarker(ntinvoices) {
//     
//    invmap.cleanRoute();
//   
                                                                var arrr = [];
                                                                if (ntinvoices != null) {
                                                                    for (var x = 0; x < ntinvoices.length; x++) {

                                                                        arrr.push({
                                                                            lat: ntinvoices[x].lat,
                                                                            lng: ntinvoices[x].lon,
                                                                            icon: URL + 'public/images/gmap/gmap_marker.png',
                                                                            show_token: 0,
                                                                            infoWindow: {
                                                                                content: '<table>'
                                                                                        + '<tr>'
                                                                                        + '<td>Outlet Name</td>'
                                                                                        + '<td>:</td>'
                                                                                        + '<td>' + ntinvoices[x].o_name + '</td>'
                                                                                        + '</tr>'
                                                                                        + '<tr>'
                                                                                        + '<td>Address</td>'
                                                                                        + '<td>:</td>'
                                                                                        + '<td>' + ntinvoices[x].o_address + '</td>'
                                                                                        + '</tr>'
                                                                                        + '<tr>'
                                                                                        + '<td>Owner Name</td>'
                                                                                        + '<td>:</td>'
                                                                                        + '<td>' + ntinvoices[x].o_person_name + '</td>'
                                                                                        + '</tr>'
                                                                                        + '<tr>'
                                                                                        + '<td>Contact No</td>'
                                                                                        + '<td>:</td>'
                                                                                        + '<td>' + ntinvoices[x].o_mobile + '</td>'
                                                                                        + '</tr>'
                                                                                        + '<tr>'
                                                                                        + '<td>DOB</td>'
                                                                                        + '<td>:</td>'
                                                                                        + '<td>' + ntinvoices[x].o_ownerDob + '</td>'
                                                                                        + '</tr>'
                                                                                        + '<tr>'
                                                                                        + '<td>Assistant Name</td>'
                                                                                        + '<td>:</td>'
                                                                                        + '<td>' + ntinvoices[x].o_assistntName + '</td>'
                                                                                        + '</tr>'
                                                                                        + '<tr>'
                                                                                        + '<td></td>'
                                                                                        + '<td>:</td>'
                                                                                        + '<td>' + '<img src="' + URL + '/view/img-outlets-unproductive/' + ntinvoices[x].o_photograph_url + '" width="200px" height="150px"></td>'
                                                                                        + '</tr>'
                                                                                        + '</table>'
                                                                            },
                                                                            mouseclick: function (e) {
                                                                                this.infoWindow.open(this.map, this);
                                                                            }

                                                                        });
                                                                    }
                                                                    invmap.addMarkers(arrr);
                                                                } else {
                                                                    alert("no unproductive outlet found");
                                                                }

                                                            }

                                                            function setMap() {
                                                                /**
                                                                 * clear prevoius things
                                                                 */
                                                                map.removeMarkers();
                                                                map.cleanRoute();
                                                                drawIndex = 0;
                                                                bounds = [];
                                                                nearDealers = [];
                                                                productives = [];
                                                                unproductives = [];
                                                                distance = 0;
                                                                duration = 0;
                                                                startAddrs = '';
                                                                $.getJSON(URL + 'gmapsRoute/getTruckGeoCodes', {rep: rep.val()}, function (marks) {
                                                                    _.each(marks, function (mark) {
                                                                        bounds.push(new google.maps.LatLng(mark.lat, mark.lng));
                                                                    });
                                                                    drawRoute();
                                                                    //setStartMarker();
                                                                    //  setLastPositionMarker();
                                                                    map.fitLatLngBounds(bounds);
                                                                });
                                                                $.getJSON(URL + 'gmapsRoute/getNearDealerGeoCodes', {rep: rep.val()}, function (markers) {
                                                                    _.each(markers, function (element) {
                                                                        var mark = map.createMarker({
                                                                            lat: element.lat,
                                                                            lng: element.lng,
                                                                            icon: URL + "public/images/gmap/blue-icon.png"
                                                                        });
                                                                        nearDealers.push(mark);
                                                                    });
                                                                    dealersHandle();
                                                                });
                                                                $.getJSON(URL + 'gmapsRoute/getProductiveGeoCodes', {rep: rep.val(), date: date.val()}, function (markers) {
                                                                    _.each(markers, function (element) {
                                                                        var mark = map.createMarker({
                                                                            lat: element.lat,
                                                                            lng: element.lng,
                                                                            icon: URL + "public/images/gmap/green-icon.png",
                                                                            details: {
                                                                                iid: element.idinvoice
                                                                            },
                                                                            click: function (e) {
                                                                                view_invoice(e.details.iid);
                                                                            }
                                                                        });
                                                                        productives.push(mark);
                                                                    });
                                                                    productiveHandle();
                                                                });
                                                                $.getJSON(URL + 'gmapsRoute/getUnproductiveGeoCodes', {rep: rep.val()}, function (markers) {
                                                                    _.each(markers, function (element) {
                                                                        var mark = map.createMarker({
                                                                            lat: element.lat,
                                                                            lng: element.lng,
                                                                            icon: URL + "public/images/gmap/pink-icon.png"
                                                                        });
                                                                        unproductives.push(mark);
                                                                    });
                                                                    unproductiveHandle();
                                                                });
                                                            }

                                                            function dealersHandle() {
                                                                if ($('#dealersHandle')[0].checked) {
                                                                    map.addMarkers(nearDealers);
                                                                } else {
                                                                    map.removeMarkers(nearDealers);
                                                                }
                                                            }

                                                            function productiveHandle() {
                                                                if ($('#productiveHandle')[0].checked) {
                                                                    map.addMarkers(productives);
                                                                } else {
                                                                    map.removeMarkers(productives);
                                                                }
                                                            }

                                                            function unproductiveHandle() {
                                                                if ($('#unproductiveHandle')[0].checked) {
                                                                    map.addMarkers(unproductives);
                                                                } else {
                                                                    map.removeMarkers(unproductives);
                                                                }
                                                            }

                                                            function drawRoute() {
                                                                var df = [];
                                                                for (var i = 0; i < (bounds.length - 1); i++) {
                                                                    df[i] = $.Deferred();
                                                                    (function (i) {
                                                                        map.drawRoute({
                                                                            origin: [bounds[i].lat(), bounds[i].lng()],
                                                                            destination: [bounds[i + 1].lat(), bounds[i + 1].lng()],
                                                                            travelMode: 'driving',
                                                                            strokeColor: '#131540',
                                                                            strokeOpacity: 0.8,
                                                                            strokeWeight: 6,
                                                                            callback: function (e) {
                                                                                df[i].resolve();
                                                                                distance += e.legs[0].distance.value;
                                                                                duration += e.legs[0].duration.value;
                                                                                if (i === 0) {
                                                                                    startAddrs = e.legs[0].start_address;
                                                                                }
                                                                            }
                                                                        });
                                                                    })(i);
                                                                }

                                                                $.when.apply($, df).done(function () {
                                                                    $('#distance').text(number_format(distance / 1000, 3) + ' Km');
                                                                    $('#duration').text(number_format(duration / 60, 2) + ' min');
                                                                });
                                                            }


                                                            function setStartMarker() {
                                                                map.addMarker({
                                                                    lat: bounds[0].lat(),
                                                                    lng: bounds[0].lng(),
                                                                    icon: URL + "public/images/flag.png",
                                                                    details: {
                                                                        vanId: 100
                                                                    },
                                                                    click: function (e) {
//            $.getJSON(URL + 'unproductive/getOutletData', {olt: e.details.vanId}, function(data) {
//                url = URL + 'library/timthumb.php?src=' + URL + 'view/img-outlets-unproductive/' + e.details.url;
//                $.colorbox({
//                    html: template({olt: data[0], url: url}),
//                    height: "35%",
//                    width: "30%",
//                    opacity: 0.50
//                });
//            });
                                                                    }
                                                                });
                                                            }

                                                            function setLastPositionMarker() {
                                                                map.addMarker({
                                                                    lat: bounds[bounds.length - 1].lat(),
                                                                    lng: bounds[bounds.length - 1].lng(),
                                                                    icon: URL + "public/images/Pink-icon.png",
                                                                    details: {
                                                                        vanId: 100
                                                                    },
                                                                    click: function (e) {
                                                                        $.getJSON(URL + 'unproductive/getOutletData', {olt: e.details.vanId}, function (data) {
                                                                            url = URL + 'library/timthumb.php?src=' + URL + 'view/img-outlets-unproductive/' + e.details.url;
                                                                            $.colorbox({
                                                                                html: template({olt: data[0], url: url}),
                                                                                height: "35%",
                                                                                width: "30%",
                                                                                opacity: 0.50
                                                                            });
                                                                        });
                                                                    }
                                                                });
                                                            }

//////////////////////////////

                                                            function  setfakeolts() {

                                                                map.addMarker({
                                                                    lat: 7.281653,
                                                                    lng: 80.688186,
                                                                    icon: URL + "public/images/gmap/green-icon.png",
                                                                    infoWindow: {
                                                                        content: '<p>Outlet Name : test dealer1</p><p>Bill Amount : Rs 20,000.00</p><p>Battery Level : 14%</p><p>Time : 2014-06-16 11:04</p>'
                                                                    }
                                                                });
                                                                map.addMarker({
                                                                    lat: 7.281653,
                                                                    lng: 80.689900,
                                                                    icon: URL + "public/images/gmap/blue-icon.png",
                                                                    infoWindow: {
                                                                        content: '<img src="' + URL + '/library/timthumb?src=' + URL + '/public/images/21083924.jpg"><p>Outlet Name : test dealer1</p><p>Address : No. 30,Kandy.</p><p>Contact : 0772189584</p>'
                                                                    }
                                                                });
                                                                map.addMarker({
                                                                    lat: 7.283025,
                                                                    lng: 80.69772,
                                                                    icon: URL + "public/images/gmap/Pink-icon.png",
                                                                    infoWindow: {
                                                                        content: '<img src="' + URL + '/library/timthumb?src=' + URL + '/public/images/8056364580.jpg"/><p>Outlet Name : test dealer1</p><p>Reason : Shop closed</p>'
                                                                    }
                                                                });
                                                            }


                                                            function load_invoice() {
//    alert('draw_route');
                                                                var zoneId;
                                                                var date;
                                                                date = $('#date').val();
//    zoneId = $('#invpsa_outlet').val();
//        date = "2015-10-07";
//        zoneId = 26;
                                                                $('#totalOutlet').val('');
                                                                $('#productOut').val('');
                                                                $('#unproductout').val('');
                                                                $('#missedout').val('');
                                                                $('#totalAmount').val('');
                                                                $('#totalDistance').val('');
                                                                $('#totalDuration').val('');
                                                                var district = $('#area_outlet').val();
                                                                var ag_area = $('#teritory_outlet').val();
//    var rep_area = $('#invpsa_outlet').val();
                                                                var zonecount = $('#zoneCount').val();
                                                                if (zonecount == 2) {
                                                                    zoneId = $('#teritory_outlet').val();
                                                                } else if (zonecount == 3) {
                                                                    zoneId = $('#psa_outlet').val();
                                                                } else if (zonecount == 4) {
                                                                    zoneId = $('#psazone_outlet').val();
                                                                }

                                                                if (date == null || date == "") {
                                                                    alert("Select Date");
                                                                } else if (district == 0) {
                                                                    alert('Select District')
                                                                } else if (ag_area == 0) {
                                                                    alert('Select Agency Area');
////    } else if (rep_area == 0) {
////        alert('Select Rep Area');
                                                                } else if (district !== 0 && ag_area !== 0) {

//        var lineSymbol = {
//            path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW
//        };

                                                                    invmap.removeMarkers();
                                                                    invmap.cleanRoute();
                                                                    setInvoiceMap(); // draw invoices ***********
//        setmissedout(); //draw unproductives *************
                                                                    setduration();//set duration on textbox **************
//        getUnproductive();//draw unproductives *************
                                                                    setdistance();//set distance***************

//        $.ajax({
//            type: 'post',
//            url: URL + 'gmapsRoute/load_invoice',
//            data: {
//                zoneId: zoneId,
//                date: date,
//                count: zonecount
//            },
//            success: function (data) {
//                  alert(data);
//                var arr = JSON.parse(data);
//                var path = [];
//                for (var i in arr) {
//                    path.push([arr[i]['lat'], arr[i]['lon']]);
//                }
////                console.log(path);
////            alert(path);
//                var i = 2;
//                for (i; i < 100; i++) {
//                    invmap.drawPolyline({
//                        path: path,
//                        icons: [{
//                                icon: lineSymbol,
//                                offset: i + '%'
//
//                            }]
////                    path: avlMarkers,
////                    strokeColor: '#FF1493',
////                    strokeOpacity: 0.6,
////                    strokeWeight: 7
//                    });
//                }

//            }
//        }
//        );
                                                                }
                                                            }

                                                            function setduration() {

                                                                var invoiceDate = $('#date').val();
                                                                var zoneId;
                                                                var zonecount = $('#zoneCount').val();
//    if (zonecount == 1) {
//        zoneId = $('#area_outlet').val();
//    } else if (zonecount == 2) {
                                                                zoneId = $('#teritory_outlet').val();
//    } else if (zonecount == 3) {
//        zoneId = $('#psa_outlet').val();
//    } else if (zonecount == 4) {
//        zoneId = $('#psazone_outlet').val();
//    }
                                                                if (invoiceDate != "") {
//        alert("#invzoneCount");

                                                                    $.ajax({
                                                                        type: 'post',
                                                                        url: URL + 'gmapsRoute/get_duration',
                                                                        data: {
                                                                            zoneId: zoneId,
                                                                            count: zonecount,
                                                                            date: invoiceDate
                                                                        },
                                                                        success: function (data) {
//                console.log(data);
//                alert('duration'+data);
                                                                            var arr = JSON.parse(data);
                                                                            var durations = arr[0].duration;

                                                                            $('#totalDuration').val(durations);
                                                                        }
                                                                    });
                                                                } else {
                                                                    alert("Please select invoice date..!");
                                                                }
                                                            }
                                                            function setdistance() {
//alert();
                                                                var invoiceDate = $('#date').val();
                                                                var zoneId;
                                                                var zonecount = $('#zoneCount').val();
//    if (zonecount == 1) {
//        zoneId = $('#area_outlet').val();
//    } else if (zonecount == 2) {
                                                                zoneId = $('#teritory_outlet').val();
//    } else if (zonecount == 3) {
//        zoneId = $('#psa_outlet').val();
//    } else if (zonecount == 4) {
//        zoneId = $('#psazone_outlet').val();
//    }
                                                                if (invoiceDate != "") {
//        alert("#invzoneCount");

                                                                    $.ajax({
                                                                        type: 'post',
                                                                        url: URL + 'gmapsRoute/get_distance',
                                                                        data: {
                                                                            zoneId: zoneId,
                                                                            count: zonecount,
                                                                            date: invoiceDate
                                                                        },
                                                                        success: function (data) {
//                alert('distance'+data);
                                                                            console.log(data);
                                                                            var arr = JSON.parse(data);
//                var durations = arr[0].duration;
//
                                                                            $('#totalDistance').val(number_format(data / 1000, 3) + ' Km');
                                                                            ;
                                                                        }
                                                                    });
                                                                } else {
                                                                    alert("Please select invoice date..!");
                                                                }
                                                            }

                                                            function getUnproductive(productive, outletcount) {
//    var total_out=0;
//var product_out=0;
//var unprodut_out=0;
                                                                var missed_out = 0;
                                                                var invoiceDate = $('#date').val();
                                                                invmap.removeMarkers();
                                                                invmap.cleanRoute();
                                                                var zoneId;
                                                                var zonecount = $('#zoneCount').val();
                                                                if (zonecount == 1) {
                                                                    zoneId = $('#area_outlet').val();
                                                                } else if (zonecount == 2) {
                                                                    zoneId = $('#teritory_outlet').val();
                                                                } else if (zonecount == 3) {
                                                                    zoneId = $('#psa_outlet').val();
                                                                } else if (zonecount == 4) {
                                                                    zoneId = $('#psazone_outlet').val();
                                                                }
                                                                if (invoiceDate != "") {
                                                                    $.ajax({
                                                                        type: 'post',
                                                                        url: URL + 'gmapsRoute/getUnproductives',
                                                                        data: {
                                                                            zoneId: zoneId,
                                                                            count: zonecount,
                                                                            date: invoiceDate
                                                                        },
                                                                        success: function (data) {
//                console.log(data);
                                                                            var arr = JSON.parse(data);
                                                                            $('#unproductout').val(arr['unproductive']);
                                                                            var unprodut_out = arr['unproductive'];
//                 product_out =$('#productOut').val();
//                 total_out =$('#totalOutlet').val();
//                alert('unprodut_out'+unprodut_out+'||product_out'+productive+'||total_out'+outletcount);  
//                alert();  
//                alert();  
                                                                            missed_out = (parseInt(outletcount) - ((parseInt(unprodut_out)) + parseInt(productive)));
//               alert('missed_out'+missed_out);
                                                                            $('#missedout').val(parseInt(missed_out));
                                                                            var unproductive = arr['data'];
                                                                            setUnproductMarker(unproductive);
                                                                        }
                                                                    });
                                                                }
                                                            }

                                                            function setUnproductMarker(unproductive) {
                                                                console.log(unproductive);
                                                                var arrr = [];
                                                                if (unproductive) {
                                                                    for (var x = 0; x < unproductive.length; x++) {
                                                                        arrr.push({
                                                                            lat: unproductive[x].gpslat,
                                                                            lng: unproductive[x].gpslon,
                                                                            icon: URL + '/public/images/gmap/red_icon.png',
                                                                            infoWindow: {
                                                                                content: '<table>'
                                                                                        + '<tr>'
                                                                                        + '<td>Rep Name</td>'
                                                                                        + '<td>:</td>'
                                                                                        + '<td>' + unproductive[x].u_first_name + '</td>'
                                                                                        + '</tr>'
                                                                                        + '<tr>'
                                                                                        + '<td>Outlet Name</td>'
                                                                                        + '<td>:</td>'
                                                                                        + '<td>' + unproductive[x].o_name + '</td>'
                                                                                        + '</tr>'
                                                                                        + '<tr>'
                                                                                        + '<td>Address</td>'
                                                                                        + '<td>:</td>'
                                                                                        + '<td>' + unproductive[x].o_address + '</td>'
                                                                                        + '</tr>'
                                                                                        + '<tr>'
                                                                                        + '<td>Reason</td>'
                                                                                        + '<td>:</td>'
                                                                                        + '<td>' + unproductive[x].remarks + '</td>'
                                                                                        + '</tr>'
                                                                                        + '<tr>'
                                                                                        + '<td>Date</td>'
                                                                                        + '<td>:</td>'
                                                                                        + '<td>' + unproductive[x].date + '</td>'
                                                                                        + '</tr>'
                                                                                        + '<tr>'
                                                                                        + '<td>Time</td>'
                                                                                        + '<td>:</td>'
                                                                                        + '<td>' + unproductive[x].time + '</td>'
                                                                                        + '</tr>'
                                                                                        + '</table>    <div id="dd"></div>'
                                                                            },
                                                                            mouseclick: function (e) {
                                                                                this.infoWindow.open(this.map);
                                                                            }

                                                                        });
                                                                        invmap.addMarkers(arrr);
                                                                    }
                                                                } else {
                                                                    alert("Unproductive Outlets Not Found");
                                                                }
                                                            }

                                                            function draw_rep_route(idPosition, idposition_parent) {
                                                                var lineSymbol = {
                                                                    path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW
                                                                };

                                                                var idpos = idposition_parent;
//    repmap.removeMarkers();
                                                                repmap.cleanRoute();
                                                                $.ajax({
                                                                    type: 'post',
                                                                    url: URL + 'gmapsRoute/draw_rep_route',
                                                                    data: {
                                                                        idPosition: idPosition
                                                                    },
                                                                    success: function (data) {
//            alert(data);
                                                                        var arr = JSON.parse(data);
                                                                        //alert(arr);
                                                                        var path = [];
                                                                        for (var i in arr) {
                                                                            path.push([arr[i]['lat'], arr[i]['lon']]);
                                                                        }
//            console.log(path);
//            alert(path)
//            repmap.drawPolyline({
//                path: path,
//                strokeColor: '#FF1493',
//                strokeOpacity: 0.6,
//                strokeWeight: 7
//            });
                                                                        var i = 2;
                                                                        for (i; i < 100; i++) {
                                                                            repmap.drawPolyline({
                                                                                path: path,
                                                                                icons: [{
                                                                                        icon: lineSymbol,
                                                                                        offset: i + '%'
                                                                                    }]
                                                                            });
                                                                        }
                                                                        rep_start_position(idpos);
                                                                    }
                                                                }
                                                                );
                                                                // }
                                                            }

                                                            function rep_start_position(idpos) {
                                                                $.ajax({
                                                                    type: 'post',
                                                                    url: URL + 'gmapsRoute/rep_start_position',
                                                                    data: {'idposition': idpos},
                                                                    success: function (data) {

//            console.log(data);
                                                                        var repstart = JSON.parse(data);
                                                                        setRepstartMarker(repstart);
                                                                    }
                                                                });
                                                            }

                                                            /*set rep start position*/
                                                            function setRepstartMarker(repstart) {
                                                                var arrr = [];
                                                                var lat = [];
                                                                var lng = [];
                                                                var adderss = "";
                                                                var count = 0;
                                                                if (repstart != null) {
                                                                    for (var x = 0; x < repstart.length; x++) {
                                                                        count++;
                                                                        arrr.push({
//                lat: repstart[x].lat,
//                lng: rep[x].lon,
                                                                            lat: repstart[x].latMin,
                                                                            lng: repstart[x].lonMin,
                                                                            icon: URL + 'public/images/Pink-icon.png',
                                                                            animation: google.maps.Animation.DROP,
                                                                            show_token: 0,
                                                                            infoWindow: {
                                                                                content: '<table>'
                                                                                        + '<tr>'
                                                                                        + '<td>Rep Name</td>'
                                                                                        + '<td>:</td>'
                                                                                        + '<td>' + repstart[x].u_first_name + '</td>'
                                                                                        + '</tr>'
                                                                                        + '<tr>'
                                                                                        + '<td>Address</td>'
                                                                                        + '<td>:</td>'
                                                                                        + '<td>' + repstart[x].u_postal_address + '</td>'
                                                                                        + '</tr>'
                                                                                        + '<tr>'
                                                                                        + '<td>Photo</td>'
                                                                                        + '<td>:</td>'
                                                                                        + '<td>' + repstart[x].u_photograph + '</td>'
                                                                                        + '</tr>' + '<tr>'
                                                                                        + '<td>latmin</td>'
                                                                                        + '<td>:</td>'
                                                                                        + '<td>' + repstart[x].startTime + '</td>'
                                                                                        + '</tr>'
                                                                                        + '<tr>'
                                                                                        + '<td>Address</td>'
                                                                                        + '<td>:</td>'
                                                                                        + '<td>' + adderss + '</td>'
                                                                                        + '</tr>'
//                            + '<tr>'
//                            + '<td>' + '<input type="button" onclick="rep_current_position(' + repstart[x].id_position + ');" value="rep current position"/></td>'
//                            + '</tr>'
                                                                                        + '</table>    <div id="dd"></div>'
                                                                            },
                                                                            mouseclick: function (e) {
                                                                                this.infoWindow.open(this.map);
                                                                            }
                                                                        });


                                                                        lat = repstart[x].latMin;
                                                                        lng = repstart[x].lonMin;
                                                                        lat = repstart[x].lat;
                                                                        lng = repstart[x].lon;
                                                                        var name = repstart[0].u_first_name;
                                                                        // get address >>>

                                                                        var latlng = new google.maps.LatLng(lat, lng);
                                                                        var geocoder = geocoder = new google.maps.Geocoder();
                                                                        geocoder.geocode({'latLng': latlng}, function (results, status) {
                                                                            if (status == google.maps.GeocoderStatus.OK) {
                                                                                if (results[1]) {
                                                                                    $.colorbox({
                                                                                        html: "<table><tr><td></td><td></td><td></td></tr>\n\
                            <tr><td><b>" + name + " Current Position Address : </b></td><td>:</td><td style='color :#5991C5'><font size='3'>" + results[1].formatted_address + "</font></td></tr>\n\
                            <tr><td><b>" + name + " Start Address  </b></td><td>:</td><td style='color :#e83cd1'><font size='3'>" + results[2].formatted_address + "</font></td></tr>\n\
                            </table>",
                                                                                        height: "20%",
                                                                                        width: "30%",
                                                                                        opacity: 0.50
                                                                                    });
                                                                                }
                                                                            }
                                                                        });
                                                                        // get address ended

                                                                    }
//        alert(arrr);
                                                                    repmap.addMarkers(arrr);
                                                                } else {
                                                                    alert("no rep found");

                                                                }
                                                            }
                                                            function GetAddress(lat, lng) {
                                                                var adderss;
                                                                var latlng = new google.maps.LatLng(lat, lng);
                                                                var geocoder = geocoder = new google.maps.Geocoder();
                                                                geocoder.geocode({'latLng': latlng}, function (results, status) {
                                                                    if (status == google.maps.GeocoderStatus.OK) {
                                                                        if (results[1]) {
                                                                            adderss = results[1].formatted_address;
                                                                        }
                                                                    }
                                                                });
                                                                return adderss;
                                                            }

                                                            function draw_routeaaaa() {

                                                                invmap.removeMarkers();
                                                                invmap.cleanRoute();
                                                                var zoneId;
                                                                var date;
                                                                date = $('#invdate').val();
                                                                zoneId = $('#invpsa_outlet').val();
                                                                $.ajax({
                                                                    type: 'post',
                                                                    url: URL + 'gmapsRoute/draw_route',
                                                                    data: {
                                                                        zoneId: zoneId,
                                                                        date: date
                                                                    },
                                                                    success: function (data) {
                                                                        var arr = JSON.parse(data);
                                                                        var path = [];
                                                                        var countarr = arr.length;
                                                                        countarr++; //last row index
                                                                        for (var i in arr) {
                                                                            path.push([arr[i]['lat'] + ',' + arr[i]['lon']]);

                                                                        }
                                                                    }
                                                                }
                                                                );
                                                            }
                                                            function view_invoice(idinvoice) {
                                                                $.ajax({
                                                                    type: 'post',
                                                                    url: URL + 'gmapsRoute/view_Invoice',
                                                                    data: {
                                                                        'idinvoice': idinvoice
                                                                    },
                                                                    success: function (data) {
//            console.log(data);
                                                                        $.colorbox({
                                                                            html: "<table style='width:500px; height:250px' ><tr><td>" + data + "</td></tr></table>",
                                                                            opacity: 0.50
                                                                        });
                                                                    }
                                                                });
                                                            }

</script>