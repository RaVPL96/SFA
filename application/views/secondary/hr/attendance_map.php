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
            Secondary Sales HR Module
            <small>Maintain Secondary Sales HR Module Details </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Secondary Sales HR Data Control Module</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12" style="overflow-x: scroll;">
                <div id="successMessage" class="hideDiv">Updated Successfully! </div>
                <div id="errorMessage" class="hideDiv">Invalid Data! Please Try Again. </div>
                <div class="keepgap"></div> 
                <div class="col-md-12">
                    <div id="map_canvas" class="col-md-12" style="height: 500px"></div>
                    <script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDL5TFORfvAKrvixbuRLQWhqfNGLL8sFCY" ></script>     

                    <script type="text/javascript">
                        /*
                         var markers = [];
                         var map;
                         var labels = 'ABCD';
                         var labelIndex = 0;
                         
                         function initialize() {
<?php
$cLat = 0;
$cLong = 0;
if (!empty($TimeAttendance) && isset($TimeAttendance)) {
    foreach ($TimeAttendance as $t) {
        $cLat = $t['warehouse_latitude'];
        $cLong = $t['warehouse_longitude'];
    }
}
?> 
                         map = new google.maps.Map(
                         document.getElementById("map_canvas"), {
                         center: new google.maps.LatLng(<?= $cLat ?>, <?= $cLong ?>),
                         zoom: 11,
                         mapTypeId: google.maps.MapTypeId.ROADMAP
                         });
<?php
$cLat = 0;
$cLong = 0;
if (!empty($TimeAttendance) && isset($TimeAttendance)) {
    foreach ($TimeAttendance as $t) {
        $cLat = $t['warehouse_latitude'];
        $cLong = $t['warehouse_longitude'];
        echo 'addMarker({
                                lat: ' . $t['warehouse_latitude'] . ',
                                lng: ' . $t['warehouse_longitude'] . '
                            }, "red","Agency");';

        echo 'addMarker({
                                lat: ' . $t['checkin_latitude'] . ',
                                lng: ' . $t['checkin_longitude'] . '
                            }, "green","In");';

        echo 'addMarker({
                                lat: ' . $t['checkout_latitude'] . ',
                                lng: ' . $t['checkout_longitude'] . '
                            }, "orange","Out");';
        
         
    }
}
?> 
                         
                         
                         // New York, NY, USA (40.7127837, -74.0059413)
                         // Newark, NJ, USA (40.735657, -74.1723667)
                         // Jersey City, NJ, USA (40.72815749999999, -74.07764170000002)
                         // Bayonne, NJ, USA (40.6687141, -74.11430910000001)
                         
                         }
                         google.maps.event.addDomListener(window, "load", initialize);
                         
                         
                         function addMarker(location, color,lable_name) {
                         var marker = new google.maps.Marker({
                         position: location,
                         label: lable_name,//labels[labelIndex++ % labels.length],
                         icon: {
                         url: 'http://maps.google.com/mapfiles/ms/icons/' + color + '.png',
                         labelOrigin: new google.maps.Point(15, 10),
                         scaledSize: new google.maps.Size(50, 50) // size
                         },
                         map: map
                         });
                         google.maps.event.addListener(marker, 'click', (function(marker, i) {
                         return function() {
                         infowindow.setContent(member_locations[i][0]);
                         infowindow.open(map, marker);
                         };
                         })(marker, i));
                         markers.push(marker);
                         }
                         
                         
                         */

                        function map_initialize() {
                            var member_locations = [
                                <?php
$cLat = 0;
$cLong = 0;
if (!empty($TimeAttendance) && isset($TimeAttendance)) {
    foreach ($TimeAttendance as $t) {
        $cLat = $t['warehouse_latitude'];
        $cLong = $t['warehouse_longitude'];
        echo '["Agency Location", new google.maps.LatLng('.$t['warehouse_latitude'].', '.$t['warehouse_longitude'].'), 1],';
        if($t['checkin_latitude']!=0){
        echo '["Check-In @'.$t['check_in'].'", new google.maps.LatLng('.$t['checkin_latitude'].', '.$t['checkin_longitude'].'), 2],';
        }
        if($t['checkout_latitude']!=0){
        echo '["Check-Out @'.$t['check_out'].'", new google.maps.LatLng('.$t['checkout_latitude'].', '.$t['checkout_longitude'].'), 3],';
        }
    }
}
?> 
                                 
                            ];
                            var map = new google.maps.Map(document.getElementById("map_canvas"), {
                                center: new google.maps.LatLng(0, 0),
                                zoom: 0,
                                mapTypeId: google.maps.MapTypeId.ROADMAP
                            });

                            for (var i = 0; i < member_locations.length; i++) {
                                let marker = new google.maps.Marker({
                                    position: member_locations[i][1],
                                    map: map,
                                    title: member_locations[i][0],
                                    label:  {  
text: member_locations[i][0],  
color: 'black',  
fontWeight: "bold",  
fontSize: "14px"  
}
                                });
                                google.maps.event.addListener(marker, 'click', (function (marker, i) {
                                    return function () {
                                        infowindow.setContent(member_locations[i][0]);
                                        infowindow.open(map, marker);
                                    }
                                })(marker, i));
                            }

                            var infowindow = new google.maps.InfoWindow();
                            var marker, i;

                            var latlngbounds = new google.maps.LatLngBounds();
                            for (var i = 0; i < member_locations.length; i++) {
                                latlngbounds.extend(member_locations[i][1]);
                            }
                            map.fitBounds(latlngbounds);

                            new google.maps.Rectangle({
                                bounds: latlngbounds,
                                map: map,
                                fillColor: "#000000",
                                fillOpacity: 0.2,
                                strokeWeight: 0
                            });
                        }
                        google.maps.event.addDomListener(window, 'load', map_initialize);
                    </script>

                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->

