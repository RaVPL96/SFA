<?php include_once BASEPATH . ('../application/views/template/leftsidebar.php'); ?><div class="content-wrapper">  
<!-- Content Header (Page header) -->
    <section class="content-header">   
<h1>            
Secondary Sales O/E Transactions            
<small>Review O/E Transactions </small>        
</h1>        
<ol class="breadcrumb">            
<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>            
<li class="active">Secondary Sales Order Entry Module</li>        
</ol>    
</section>    
<!-- Main content -->    
<section class="content">        
<div class="row">            
<div class="col-md-12">                
<div id="successMessage" class="hideDiv">Updated Successfully! </div>                
<div id="errorMessage" class="hideDiv">Invalid Data! Please Try Again. </div>                
<div class="keepgap"></div>                 
<div class="row" style="overflow-x: scroll;">                    
<div class="col-md-12">                        
<form class="form-horizontal" id="OrderData" action="<?= base_url('Salesoetransaction/AreaSummaryData') ?>" method="post" novalidate="novalidate">                            
<div class="col-md-6">                                                            
<div class="form-group">                                    
<label class="col-md-2">Area <span class="text-red">*</span></label>                                    
<div class="col-md-6">                                        
<select id="sbArea" name="areaID" class="form-control">                                            
<option value="-1"> -- Select Area -- </option>                                                
<?php                                            
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
<!--<div class="col-md-6">                                
<div class="form-group">                                    
<label class="col-md-2">Territory <span class="text-red">*</span></label>                                    
<div class="col-md-6">                                        <select id="sbTerritory" name="territoryID" class="form-control">                                            
<option value=""> -- Select Territory -- </option>                                
<!-?php                            
foreach ($territory as $t) {                                
$select = '';                                
if (!empty($TerritoryID) && isset($TerritoryID) && $TerritoryID == $t['id']) {                                    
$select = 'selected';                                
}                                
echo '<option ' . $select . ' value="' . $t['id'] . '"> ' . $t['territory_name'] . '</option>';                            
}                            ?>                                        </select>                                    
</div>                                </div>                                                        
</div>                            -->                            
<div class="col-md-6">                                                            
<div class="form-group">                                    
<label class="col-md-2">Range <span class="text-red">*</span></label>                                    
<div class="col-md-6">                                        
<select id="sbRange" name="rangeID" class="form-control">                                            
<option value="-1"> -- Select Range -- </option>                                               
<?php                                            foreach ($RangeList as $a) {                                           
$select = '';                                                
if (!empty($RangeID) && isset($RangeID) && $a['id'] == $RangeID) {                                                    
$select = 'selected';                                                }                                                
echo '<option ' . $select . ' value="' . $a['id'] . '"> ' . $a['range_name'] . '</option>';    
}                                            ?>                                        
</select>                                    </div>                                </div>                            
</div>                            <div class="col-md-6">                                
<div class="form-group">                                    
<label class="col-md-2">Date Range <span class="text-red">*</span></label>                                    
<div class="col-md-6">                                        <div class="input-group">                                            
<div class="input-group-addon">                                                
<i class="fa fa-calendar"></i>                                            </div>  
<input type="text" name="DateRange" class="form-control pull-right active" readonly="" id="reservation" 
value="<?= $DateRange ?>">
</div><!-- /.input group --> 
</div><!-- /.form group -->	                                
</div>                           
</div>                            
<div class="col-md-12">                               
<div class="form-group">                                   
<input type="submit" class="btn btn-danger" name="submit" value="Get Report"> 
</div>   
</div>                           
<!--                           
<div class="form-group">                               
<label class="col-md-2">Select Sales Channel <span class="text-red">*</span></label>   
<div class="col-md-6">  
<select name="channel[]" id="example28" multiple="multiple" class="form-control" style="display: none;">
  <option value="multiselect-all"> Select all</option>   
<?php                          
foreach ($ChannelDataSet as $ch) {          
echo '<option value="' . $ch['id'] . '"> ' . $ch['channel_name'] . '</option>';  
}                            ?>                                    </select>    
<div class="btn-group open">                                     
  </div>			                         
</div>				                            
</div>                            -->               
</form>     
</div>   
<?php
$allRows = '';       
if (!empty($AreaTerritoryDataSet) && isset($AreaTerritoryDataSet)) 
{       
  $subtotal = 0;                        
  $header_discount_value = 0; 
  $total_discount_value = 0;                        
  $header_gr_value = 0;     
  $header_mr_value = 0;                        
  $header_net_value = 0;         
  $rows = '';                        
  $billcount = 0;                        
  $travalTime = 0;    
  $lastbillEndTime = '';                        
  foreach ($AreaTerritoryDataSet as $List) {   
  $finalRow = '';                      
  if (!empty($ordersH) && isset($ordersH)) {     
  foreach ($ordersH as $h) {        
  if ($h['area_id'] == $List['area_id'] && $h['territory_id'] == $List['territory_id']) {   
  $subtotal = $subtotal + $h['tot_subtotal'];     
  $header_discount_value = $header_discount_value + $h['tot_header_discount_value']; 
  $total_discount_value = $total_discount_value + $h['tot_total_discount_value'];  
  $header_gr_value = $header_gr_value + $h['tot_header_gr_value'];
  $header_mr_value = $header_mr_value + $h['tot_header_mr_value'];  
  $header_net_value = $header_net_value + $h['tot_header_net_value'];
  $billcount = $billcount + $h['tot_pc'];   
/* $rows = $rows . '<tr onclick="">     
<td>' . $h['area_name'] . '</td>      
<td>' . $h['territory_name'] . '</td>     
<td>' . $h['range_name'] . '</td>     
<td>' . $h['tot_pc'] . '</td>    
<td>' . $h['tot_subtotal'] . '</td>     
<td>' . $h['tot_header_discount_value'] . '</td>   
<td>' . $h['tot_total_discount_value'] . '</td>     
<td>' . $h['tot_header_gr_value'] . '</td>   
<td>' . $h['tot_header_mr_value'] . '</td>      
<td>' . $h['tot_header_net_value'] . '</td>     
</tr>'; */      
$finalRow = '<tr onclick="">     
<td>' . $h['area_name'] . '</td>      
<td>' . $h['territory_name'] . '</td>	
<td>' . $h['range_name'] . '</td>    
<td>' . $h['tot_pc'] . '</td>    	
<td>' . $h['tot_subtotal'] . '</td> 	
<td>' . $h['tot_header_discount_value'] . '</td>	
<td>' . $h['tot_total_discount_value'] . '</td>		
<td>' . $h['tot_header_gr_value'] . '</td>
<td>' . $h['tot_header_mr_value'] . '</td>	
<td>' . $h['tot_header_net_value'] . '</td> 	
</tr>';     
break;     
}    
}     
}    
if ($finalRow == '') {    
$finalRow = '<tr onclick="">     
<td>' . $List['area_name'] . '</td>   
<td>' . $List['territory_name'] . '</td>	
<td>-</td>       
<td>-</td>    	
<td>-</td> 			
<td>-</td>		
<td>-</td>	
<td>-</td>	
<td>-</td>			
<td>-</td> 	
</tr>'; 
}    
$allRows = $allRows . $finalRow;    
}                       
?>                        
<div class="col-md-12">                          
<div class="form-group">                              
<input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('table-area', 'Outlets')" value="Download Excel">                         
</div>                            
<table id="table-area" class="table table-hover">                              
<thead>                                    
  <tr>
<th>Agency Name</th>     						                                     
<th>Item Code</th>                                         
<th>Item Name</th>                                       
<th>Category</th>
<th>PC</th>                                         
<th>Quantity</th>                                     
<th>Value</th>                                   
</tr>                                
</thead>                                
<tbody>                                   
<?= $allRows ?>                                
</tbody>                                
<tfoot>                       
<tr>                                        
  <td> </td>                                    
<td> </td>                                        
<td> </td>                                     
<td><?= $billcount ?> </td>                                         
<!--td><= sprintf('%0.2f', $totalpc) ?></td-->                                       
<td><?= sprintf('%0.2f', $subquantity) ?></td>                                   
<td><?= sprintf('%0.2f', $subtotal) ?></td>              
</tr>                               
</tfoot>                           
</table>                        
</div>          
<?php                    }        
?>                   
<?php                
if (!empty($ordersH) && isset($ordersH)) {            
//$totalpc = 0;                       
$subquantity = 0;         
$subtotal = 0;                      
$rows = '';                       
$billcount = 0;                      
$travalTime = 0;                        
$lastbillEndTime = '';                     
foreach ($ordersH as $h) {                     
//$totalpc = $totalpc + $h['tot_totalpc'];    
$subquantity = $subquantity + $h['tot_subquantity'];                          
$subtotal = $subtotal + $h['tot_subtotal'];                         
$billcount = $billcount + $h['tot_pc'];                          
/*$rows = $rows . '<tr onclick="">                                                                    
<td>' . $h['area_name'] . '</td>                                                           
<td>' . $h['territory_name'] . '</td>								
<td>' . $h['range_name'] . '</td>                                                         
<td>' . $h['tot_pc'] . '</td>    									
<td>' . $h['tot_subtotal'] . '</td> 								
<td>' . $h['tot_header_discount_value'] . '</td>					
<td>' . $h['tot_total_discount_value'] . '</td>			
<td>' . $h['tot_header_gr_value'] . '</td>								
<td>' . $h['tot_header_mr_value'] . '</td>								
<td>' . $h['tot_header_net_value'] . '</td> 							
</tr>';*/                        
}                        
?>                      
<div class="col-lg-6 col-xs-6">                         
<!-- small box -->                         
<div class="small-box bg-aqua">                            
<div class="inner">                                  
<h3><?= $billcount ?></h3>                                   
<p>Total PC(s)</p>                             
</div>                                
<div class="icon">                                   
<i class="fa fa-shopping-cart"></i>                            
</div>                             
</div>                      
</div>	                        
<div class="col-lg-6 col-xs-6">  
<!-- small box -->                  
<div class="small-box bg-green">                              
<div class="inner">                                    
<h3>Rs. <?= number_format($subtotal, 2) ?></h3>                                    
<p>Sub Total Value</p>                                
</div>                               
<div class="icon">                                    
  <i class="fa fa-shopping-cart"></i>                            
</div>                             
</div>                        
</div>                     
<div class="col-lg-6 col-xs-6">                            
  <!-- small box -->                           
<div class="small-box bg-aqua">                                
  <div class="inner">                               
<h3> <?= number_format($subquantity, 2) ?></h3>                                   
<p>Total Quantity</p>                                
</div>                              
<div class="icon">                                    
  <i class="fa fa-shopping-cart"></i>            
</div>                             
</div>                        
</div>                      
<div class="col-md-12">                         
<!--							
  <div class="form-group">                           
<input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('table-area', 'Outlets')" value="Excel">                            
</div>							                            
<table id="table-area" class="table table-hover">                                
<thead>                                    
  <tr>						                                        
<th>Area</th>                                         
<th>Territory</th>                                        
<th>Range</th>                                         
<th>PC</th>                                        
<th>Subtotal</th>                                         
<th>Header Discount Rs.</th>                                     
<th>Total Discount</th>                                        
<th>GR Value</th>                                        
<th>MR Value</th>                                        
<th>Net Value</th>                                    
</tr>                                
</thead>                                
<tbody>                                
<?= $rows ?>                                
</tbody>                                
<tfoot> 
<tr>                                        
  <td> </td>          
<td> </td>                                        
<td> </td>   
<td><?= $billcount ?> </td> 
<td><?= sprintf('%0.2f', $subtotal) ?></td> 
<td><?= sprintf('%0.2f', $header_discount_value) ?></td>    
<td><?= sprintf('%0.2f', $total_discount_value) ?></td>  
<td><?= sprintf('%0.2f', $header_gr_value) ?></td>  
<td><?= sprintf('%0.2f', $header_mr_value) ?></td>   
<td><?= sprintf('%0.2f', $header_net_value) ?></td>   
</tr>                                </tfoot>         
</table>							-->   
</div>                        
<?php                    
}
?>                
</div>            
</div>            
<div class="col-md-12">  
<!--               
<script src="https://www.gstatic.com/external_hosted/jquery2.min.js"></script>          
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=geometry&key=AIzaSyDL5TFORfvAKrvixbuRLQWhqfNGLL8sFCY"></script> 
<script type="text/javascript">                    var locations = [                
<?php                
if (!empty($ordersH) && isset($ordersH)) {                    
  foreach ($ordersH as $h) {  
echo '[\'' . $h['bill_name'] . '\', ' . $h['latitude'] . ', ' . $h['longitude'] . ', 12],';                 
}                
}                
?>                    
];                    /*var locations = [          
        ['Bondi Beach', -33.890542, 151.274856, 4],   
          ['Coogee Beach', -33.923036, 151.259052, 5],  
            ['Cronulla Beach', -34.028249, 151.157507, 3],  
            ['Manly Beach', -33.80010128657071, 151.28747820854187, 2],  
              ['Maroubra Beach', -33.950198, 151.259302, 1]                     ];*/  
              var map = new google.maps.Map(document.getElementById('map'), {   
                    zoom: 10,                        center: new google.maps.LatLng(-33.92, 151.25),      
                                      mapTypeId: google.maps.MapTypeId.ROADMAP                    });     
                                                    var infowindow = new google.maps.InfoWindow();  
                                                var marker, i;                   
                                                for (i = 0; i < locations.length; i++) {                    
                                                        marker = new google.maps.Marker({                  
position: new google.maps.LatLng(locations[i][1], locations[i][2]),   
map: map                        });                       
google.maps.event.addListener(marker, 'click', (function (marker, i) {                            
return function () {                                infowindow.setContent(locations[i][0]);                               
infowindow.open(map, marker);                            }                        })(marker, i));                    
}                </script>                                
<script src="https://www.gstatic.com/external_hosted/jquery2.min.js"></script>                
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=geometry&key=AIzaSyDL5TFORfvAKrvixbuRLQWhqfNGLL8sFCY"></script>                 
<script>                                var line;                                var map;                                
var pointDistances;                                function initialize() {                                    
var mapOptions = {                                        center: new google.maps.LatLng(2.881766, 101.626877),     
zoom: 20,                                        
mapTypeId: google.maps.MapTypeId.ROADMAP                                  
};                                   
map = new google.maps.Map(document.getElementById('map'), mapOptions);      
var lineCoordinates = [               
<?php              
if (!empty($gps) && isset($gps)) {    
foreach ($gps as $g) {                        
echo 'new google.maps.LatLng(' . $g['latitude'] . ', ' . $g['longitude'] . '),';                   
}                }                ?>                                      
/*new google.maps.LatLng(2.86085, 101.6437),                                       
new google.maps.LatLng(2.87165, 101.6362),                                       
new google.maps.LatLng(2.880783, 101.6273),                                        
new google.maps.LatLng(2.891517, 101.6201),                                         
new google.maps.LatLng(2.8991, 101.6162),                                        
new google.maps.LatLng(2.915067, 101.6079)*/                                    
];                                    map.setCenter(lineCoordinates[0]);                                  
/* point distances from beginning in % */                                    
var sphericalLib = google.maps.geometry.spherical;                                   
pointDistances = [];                                   
var pointZero = lineCoordinates[0];                                    
var wholeDist = sphericalLib.computeDistanceBetween(                                           
pointZero,                                           
lineCoordinates[lineCoordinates.length - 1]);                                   
for (var i = 0; i < lineCoordinates.length; i++) {                                        
pointDistances[i] = 100 * sphericalLib.computeDistanceBetween(                             
lineCoordinates[i], pointZero) / wholeDist;   
console.log('pointDistances[' + i + ']: ' + pointDistances[i]);                                    
}                                    /* define polyline */                                    
var lineSymbol = {                                        path: google.maps.SymbolPath.CIRCLE,                                        
scale: 6,                                        strokeColor: '#393'                                    
};                                    line = new google.maps.Polyline({                                        
path: lineCoordinates,                                        strokeColor: '#FF0000',                                        
strokeOpacity: 2.0,                                        strokeWeight: 5,                                        
icons: [{                                                icon: lineSymbol,                                                
offset: '100%'                                            }],                                        
map: map                                    });                                    animateCircle();                            
drawBlueLine(map, lineSymbol);                                }                                
var id;                                function animateCircle() {                                    
var count = 0;                                    var offset;                                    
var sentiel = -1;                                    id = window.setInterval(function () {                        
count = (count + 1) % 200;                                        offset = count / 2;          
for (var i = pointDistances.length - 1; i > sentiel; i--) {     
if (offset > pointDistances[i]) {                                                
console.log('create marker');                                                
var marker = new google.maps.Marker({                                                   
icon: {                                                        
url: "https://maps.gstatic.com/intl/en_us/mapfiles/markers2/measle_blue.png",                                            
size: new google.maps.Size(7, 7),                                                        
anchor: new google.maps.Point(4, 4)                                                    
},                                                    position: line.getPath().getAt(i),                        
title: line.getPath().getAt(i).toUrlValue(6),                                      
map: map                                                });          
sentiel++;                     
break;                                            }                                        }                                       
/* we have only one icon */                                        var icons = line.get('icons');                                
icons[0].offset = (offset) + '%';                                        line.set('icons', icons);                      
if (line.get('icons')[0].offset == "99.5%") {                                           
icons[0].offset = '100%';                                            line.set('icons', icons);     
window.clearInterval(id);                                  
}                                    }, 20);                                }                               
function drawBlueLine(map, lineSymbol) {                                    console.log();                                   
var startBlue = new google.maps.LatLng(2.852888, 101.651970);                                  
var endBlue = new google.maps.LatLng(2.915067, 101.6079);                                   
var blueLine = new google.maps.Polyline({                                       
path: [startBlue, endBlue],                                       
strokeColor: '#0000ff',                                        
strokeOpacity: 2.0,                                       
strokeWeight: 5,                                        icons: [{                                              
icon: lineSymbol,                                                offset: '100%'                          
}],                                        map: map                                   
});                                    new google.maps.Marker({                          
position: startBlue,                                        map: map   
});                                  
new google.maps.Marker({               
position: endBlue,                                     
map: map                                   
});                                }                               
google.maps.event.addDomListener(window, 'load', initialize);                
</script>                <style>                    #map {                       
height: 500px;                        width: 90%                    }               
</style>                 -->                <div id='map'></div>            </div>       
</div>    </section>    <!-- /.content --></div><!-- /.content-wrapper -->