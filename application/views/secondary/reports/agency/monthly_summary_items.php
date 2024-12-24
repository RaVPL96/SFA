<?php include_once BASEPATH . ('../application/views/template/leftsidebar.php'); ?>
<div class="content-wrapper">    <!-- Content Header (Page header) -->    
    <section class="content-header">       
        <h1>            Monthly Summary Report (Items)          <small>Review O/E Transactions </small>        </h1>  
        <ol class="breadcrumb">       
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>  
            <li class="active">Secondary Sales Order Entry Module</li>        
        </ol> 
    </section>    <!-- Main content -->    
    <section class="content">        
        <div class="row">            
            <div class="col-md-12">               
                <div id="successMessage" class="hideDiv">Updated Successfully! </div>             
                <div id="errorMessage" class="hideDiv">Invalid Data! Please Try Again. </div>   
                <div class="keepgap"></div>              
                <div class="row" style="overflow-x: scroll;">   
                    <div class="col-md-12">                 
                        <form class="form-horizontal" id="OrderData" action="<?= base_url('salesreports/monthlySummary') ?>" method="post" novalidate="novalidate">             
                            <div class="col-md-6">       
                                <div class="form-group">  
                                    <label class="col-md-2">Area <span class="text-red">*</span></label>
                                    <div class="col-md-6"> 
                                        <select id="areaID" name="areaID" class="form-control">   
                                            <option value="-1"> -- Select Area -- </option>                                                <?php
                                            foreach ($AreaList as $a) {
                                                $select = '';
                                                if (!empty($AreaID) && isset($AreaID) && $a['id'] == $AreaID) {
                                                    $select = 'selected';
                                                }
                                                if ($sess['grade_id'] == 4) {
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
                            <div class="col-md-6">    
                                <div class="form-group">      
                                    <label class="col-md-2">Territory <span class="text-red">*</span></label>
                                    <div class="col-md-6">                                     
                                        <select id="sbTerritory" name="territoryID" class="form-control">  
                                            <option value=""> -- Select Territory -- </option>     
                                            <?php
                                            if (!empty($territory) && isset($territory)) {
                                                foreach ($territory as $t) {
                                                    $select = '';
                                                    if (!empty($TerritoryID) && isset($TerritoryID) && $TerritoryID == $t['territory_id']) {
                                                        $select = 'selected';
                                                    } echo '<option ' . $select . ' value="' . $t['territory_id'] . '"> ' . $t['territory_name'] . '</option>';
                                                }
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                            </div>         
                            <!--                            <div class="col-md-6">
                            <div class="form-group">                            
                            <label class="col-md-2">Territory <span class="text-red">*</span></label> 
                            <div class="col-md-6">                                 
                            <select id="sbTerritory" name="territoryID" class="form-control">  
                            <option value=""> -- Select Territory -- </option>
                            <?php
                            if (!empty($territory) && isset($territory)) {
                                foreach ($territory as $t) {
                                    $select = '';
                                    if (!empty($TerritoryID) && isset($TerritoryID) && $TerritoryID == $t['id']) {
                                        $select = 'selected';
                                    } echo '<option ' . $select . ' value="' . $t['id'] . '"> ' . $t['territory_name'] . '</option>';
                                }
                            }
                            ?>     
                            
                            
                            </select>   
                            
                            </div>                                </div>            
                            </div>                            -->        
                            <div class="col-md-6">             
                                <div class="form-group">         
                                    <label class="col-md-2">Range <span class="text-red">*</span></label>    
                                    <div class="col-md-6">                                        
                                        <select id="sbRange" name="rangeID" class="form-control">
                                            <option value="-1"> -- Select Range -- </option> 
                                            <?php
                                            foreach ($RangeList as $a) {
                                                $select = '';
                                                if (!empty($RangeID) && isset($RangeID) && $a['id'] == $RangeID) {
                                                    $select = 'selected';
                                                } echo '<option ' . $select . ' value="' . $a['id'] . '"> ' . $a['range_name'] . '</option>';
                                            }
                                            ?>                                   
                                        </select>     
                                    </div>            
                                </div>                 
                            </div>                     
                            <div class="col-md-6">     
                                <div class="form-group">     
                                    <label class="col-md-2">Date Range <span class="text-red">*</span></label>                                  
                                    <div class="col-md-6">                                     
                                        <div class="input-group">                                  
                                            <div class="input-group-addon">                              
                                                <i class="fa fa-calendar"></i>                       
                                            </div>                                       
                                            <input type="text" name="DateRange" class="form-control pull-right active" readonly="" id="reservation" value="<?= $DateRange ?>"> 
                                        </div><!-- /.input group -->                       
                                    </div><!-- /.form group -->	                             
                                    <div class="col-md-4"><input type="submit" class="btn btn-danger" id="excel" name="excel"></div>     
                                </div>               
                            </div>                 
                            <div class="col-md-6">                 
                                <div class="form-group">         
                                    <label class="col-md-2">Select Sales Channel <span class="text-red">*</span></label>  
                                    <div class="col-md-6"> 
                                        <select name="channel[]" id="example28" multiple="multiple" class="form-control" style="display: none;">
                                            <option value="multiselect-all"> Select all</option> 


                                            <?php
                                            if (!empty($ChannelDataSet) && isset($ChannelDataSet)) {
                                                foreach ($ChannelDataSet as $ch) {
                                                    echo '<option value="' . $ch['id'] . '"> ' . $ch['channel_name'] . '</option>';
                                                }
                                            }
                                            ?>                             
                                        </select>                    
                                        <div class="btn-group open">  
                                        </div>			      
                                    </div>				
                                </div>                   
                            </div>         
                        </form>        
                        <div class="form-group">
                            <input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('table-area', 'Outlets')" value="Excel">      
                        </div>        
                    </div>
                    <div class="row">
                        <table id="attendance_table" class="table table-hover">
                            <thead>
                            <!-- <th colspan="17" style="font-size: 20px; text-align: center;"> <?= $AreaDetails->area_name ?> Area Actual Sales Data - <?= $RangeName->range_name ?> Range<br>Date From <?= $DateRange ?></th> -->
                                <tr>
                                    <th colspan="17" style="font-size: 20px; text-align: center;"><?= $ReportTitle ?></th>
                                </tr>
                            </thead>
                            </table>
                    </div>
                        
                          
                    
                    <div class="col-md-10">
                        <?php
                        if (!empty($dataInfo) && isset($dataInfo)) {
                            //print_r($dataInfo);
                            ?>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Item Code </th>
                                        <th>Item Name</th>
                                        <th>Quantity</th>
                                        <th>Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($dataInfo As $row) {
                                        ?>
                                        <tr>
                                            <td> <?= $row['item'] ?></td>
                                            <td> <?= ($row['name']) ?></td>
                                            <td> <?= number_format($row['Actual_qty'], 2) ?></td>
                                            <td> <?= number_format($row['sub_total'], 2) ?></td>
                                        </tr>
                                    <?php }
                                    ?>
                                </tbody>
                            </table>

                        <?php } ?> 
                        
                            


                    </div>
                </div>           
            </div>       
            <!-- jQuery 2.1.4 -->           
            <script src="<?= base_url('adminlte/plugins/jQuery/jQuery-2.1.4.min.js') ?>"></script> 
            <script src="<?= base_url('adminlte/dist/js/validate/jquery.validate.min.js') ?>" type="text/javascript"></script>  
            <script src="<?= base_url('adminlte/dist/js/validate/placeholders.min.js') ?>" type="text/javascript"></script>   
            <script>
                                                    /*                                 $(document).on('change', '#areaid', function (){ 
                                                     * 
                                                     */
                                                    var modID = $('#areaid').val();
                                                    $('#territoryList').empty();
                                                    //alert(modID);     
                                                    //$.ajax({        
                                                    //                                                     type: "post",       
                                                    //                                                                       
                                                    //                                                                                       url: "<?php echo base_url('index.php/master/getOperationAreasTerritoryAjax'); ?>",   
                                                    //                                                                                                                     data: 'opid=' + modID,                               
                                                    //                                                                                                                       success: function (feed) {                              
                                                    //                                                                                                                        $('#uploading').modal('hide'); 
                                                    //                                                                                                                                                        //alert(feed);    
                                                    //                                                                                                                                                        
                                                    //                                                                                                                                                                                     $('#territoryList').empty().append(feed);      
                                                    //                                                                                                                                                                                                                                                 },                                 error: function (feed) {    
                                                    //                                                                                                                                                                                                                                                                              console.log('Ajax request not recieved!' + feed);  
                                                    //                                                                                                                                                                                                                                                                                 
                                                    //                                                                                                                                                                                                                                                                             $('#uploading').modal('hide'); 
                                                    //                                                                                                                                                                                                                                                                                                             } 
                                                    //                                                                                                                                                                                                                                                                                                                                             }); 
                                                    //                                                                                                                                                                                                                                                                                                                                                                             return false;
                                                    //                                                                                                                                                                                                                                                                                                                                                                             
                                                    // 
                                                    //                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           });                                                                  */
            </script>      
            <div class="col-md-12">  
                <script src="https://www.gstatic.com/external_hosted/jquery2.min.js"></script>             
                <style>
                    #map {
                        height: 700px;
                        width: 90%
                    }
                    #mapP {
                        display: none;
                        height: 500px;
                        width: 90%
                    }
                </style> 
                <div id="map"></div> 
                <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>      
                <!-- Async script executes immediately and must be after any DOM elements used in callback. -->  

                <script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDL5TFORfvAKrvixbuRLQWhqfNGLL8sFCY" ></script>     
                <script type="text/javascript">
                                                    var locations = [
<?php
if (!empty($gps) && isset($gps)) {
    $c = 0;
    $x = 0;
    $y = 0;
    foreach ($gps as $g) {

        if (round(count($gps) / 2) == $c) {
            $x = $g['latitude'];
            $y = $g['longitude'];
        }
        $c += 1;
        echo '["' . $g['id'] . '", ' . $g['latitude'] . ', ' . $g['longitude'] . ', ' . $c . '],';
    }
}
?>
                                                    ];
                                                    var map = new google.maps.Map(document.getElementById('map'), {
                                                        zoom: 15,
                                                        center: new google.maps.LatLng(<?= $x ?>, <?= $y ?>),
                                                        mapTypeId: google.maps.MapTypeId.ROADMAP
                                                    });
                                                    var infowindow = new google.maps.InfoWindow();
                                                    var marker, i;
                                                    for (i = 0; i < locations.length; i++) {

                                                        marker = new google.maps.Marker({
                                                            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                                                            map: map,
                                                            icon: 'https://chart.googleapis.com/chart?chst=d_map_pin_letter_withshadow&chld=' + (i + 1) + '|F00000|FFF',
                                                            title: locations[i][0]
                                                        });
                                                        google.maps.event.addListener(marker, 'click', (function (marker, i) {
                                                            return function () {
                                                                infowindow.setContent(locations[i][0]);
                                                                infowindow.open(map, marker);
                                                            }
                                                        })(marker, i));
                                                    }
                </script>  
                <div id="mapP" style="border: 2px solid #3872ac;"></div>  
                <script>
                    /*                
                     * //var MapPoints = '[]';
                     * var MY_MAPTYPE_ID = 'custom_style';
                     * function initialize() {
                     *     if (jQuery('#mapP').length > 0) {    
                     *         var locations = jQuery.parseJSON(MapPoints);
                     *         window.map = new google.maps.Map(document.getElementById('mapP'), {
                     *         mapTypeId: google.maps.MapTypeId.ROADMAP, 
                     *         scrollwheel: false 
                     *         });
                     *         
                     *          var infowindow = new google.maps.InfoWindow(); 
                     *          var flightPlanCoordinates = []; 
                     *          var bounds = new google.maps.LatLngBounds();
                     *          for (i = 0; i < locations.length; i++) {
                     *              marker = new google.maps.Marker({
                     *              position: new google.maps.LatLng(locations[i].address.lat, locations[i].address.lng),
                     *              map: map
                     *           });
                     *           flightPlanCoordinates.push(marker.getPosition());
                     *           bounds.extend(marker.position);
                     *           google.maps.event.addListener(marker, 'click', (function (marker, i) {
                     *           return function () {
                     *                            
                     *                                              
                     *                                                infowindow.setContent(locations[i]['title']);                    infowindow.open(map, marker);                }            })(marker, i));            }            map.fitBounds(bounds);            var flightPath = new google.maps.Polyline({                map: map,                path: flightPlanCoordinates,                strokeColor: "#FF0000",                strokeOpacity: 1.0,                strokeWeight: 2            });        }    }    google.maps.event.addDomListener(window, 'load', initialize);                */
                    var map;
                    var pathCoordinates = Array();
                    function initMap() {
                        var countryLength
                        var mapLayer = document.getElementById("map-layer");
                        var centerCoordinates = new google.maps.LatLng(8.6, 80.665);
                        var defaultOptions = {
                            center: centerCoordinates,
                            zoom: 4
                        }
                        map = new google.maps.Map(mapLayer, defaultOptions);
                        geocoder = new google.maps.Geocoder();
<?php
if (!empty($gps)) {
    ?>
                            countryLength = <?php echo count($gps); ?>;
    <?php
    foreach ($gps as $v) {
        ?>
                                geocoder.geocode({
                                    'address': '<?php echo $v["id"]; ?>'
                                },
                                        function (LocationResult, status) {
                                            if (status == google.maps.GeocoderStatus.OK) {
                                                var latitude = <?= $v["latitude"] ?>;
                                                var longitude = <?= $v["longitude"] ?>;
                                                pathCoordinates.push({
                                                    lat: latitude,
                                                    lng: longitude
                                                });
                                                new google.maps.Marker({position: new google.maps.LatLng(latitude, longitude), map: map, title: "<?php echo $v["id"]; ?>"});
                                                if (countryLength == pathCoordinates.length) {
                                                    drawPath();
                                                }
                                            }
                                        });

        <?php
    }
}
?>
                    }
                    function drawPath() {
                        new google.maps.Polyline({path: pathCoordinates, geodesic: true, strokeColor: '#FF0000', strokeOpacity: 1, strokeWeight: 4, map: mapP});
                    }
                </script>   
            </div>
        </div>    
    </section>   
    <!-- /.content -->
</div>

<!-- /.content-wrapper -->




