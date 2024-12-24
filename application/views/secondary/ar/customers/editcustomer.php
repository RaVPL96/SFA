<?php include_once BASEPATH . ('../application/views/template/leftsidebar.php'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Secondary Sales Customers
            <small>Maintain Secondary Sales Details </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Master Data Control Module</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12" style="overflow-x: scroll;">
                <div id="successMessage" class="hideDiv">Updated Successfully! </div>
                <div id="errorMessage" class="hideDiv">Invalid Data! Please Try Again. </div>
                <div class="keepgap"></div> 
                <?php
                $id = '';
                $name = '';
                $address4 = $address3 = $address2 = $address = '';
                $contact_person = '';
                $telephone = '';
                $mobile = '';
                $outlet_category_id = '';

                $dealercode = '';
                $territory_reference_code = '';
                $route_reference_code = '';
                $isact = '';
                $isapprove = '';
                $image = '';
                if (!empty($outlets) && isset($outlets)) {
                    $id = $outlets->id;
                    $name = $outlets->name;
                    $address = $outlets->address_1;
                    $address2 = $outlets->address_2;
                    $address3 = $outlets->address_3;
                    $contact_person = $outlets->contact_person;
                    $telephone = $outlets->telephone;
                    $mobile = $outlets->mobile;
                    if ($outlets->is_act == 1) {
                        $isact = 'checked';
                    }
                    $dealercode = $outlets->outlet_code;
                    $territory_reference_code = $outlets->territory_reference_code;
                    $outlet_category_id = $outlets->outlet_category_id;
                    $route_reference_code = $outlets->route_reference_code;
                    if ($outlets->is_new == 0) {
                        $isapprove = 'checked';
                    }
                    $image = $outlets->image;
                    $image_created = $outlets->image_created;
                    $image_name = $outlets->image_name;
                }
                ?>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <form class="form-horizontal" id="" action="<?= base_url('salesarcustomers/updateOutlet') ?>" method="post">

                            <h4>Update <?= ucwords($name) ?> Details (<?= $territory_reference_code . '/' . $route_reference_code . '/' . $dealercode ?>)</h4>
                            <div class="form-group"> 
                                <label class="form-label">Outlet Name</label>
                                <input class="form-control" type="text" name="outlet[name]" value="<?= ucwords($name) ?>">
                                <input type="hidden" name="outlet[id]" value="<?= $id ?>">

                            </div> 
                            <div class="form-group">
                                <label class="form-label">Outlet Address 1</label>
                                <input class="form-control" type="text" name="outlet[address_1]" value="<?= $address ?>">

                            </div>
                            <div class="form-group">
                                <label class="form-label">Outlet Address 2</label>
                                <input class="form-control" type="text" name="outlet[address_2]" value="<?= $address2 ?>">

                            </div>
                            <div class="form-group">
                                <label class="form-label">Outlet Address 3</label>
                                <input class="form-control" type="text" name="outlet[address_3]" value="<?= $address3 ?>">

                            </div> 
                            <div class="form-group">
                                <label class="form-label">Contact Person</label>
                                <input class="form-control" type="text" name="outlet[contact_person]" value="<?= $contact_person ?>">

                            </div> 

                            <div class="form-group">
                                <label class="form-label">Telephone</label>
                                <input class="form-control" type="text" name="outlet[telephone]" value="<?= $telephone ?>">

                            </div>  

                            <div class="form-group">
                                <label class="form-label">Mobile</label>
                                <input class="form-control" type="text" name="outlet[mobile]" value="<?= $mobile ?>">

                            </div>

                            <div class="form-group">
                                <label class="form-label">Outlet Category</label>
                                <select name="outlet[category]" class="form-control">
                                    <?php
                                    foreach ($OutletCategory as $c) {
                                        $select = '';
                                        if ($c['id'] == $outlet_category_id) {
                                            $select = ' selected ';
                                        }
                                        echo '<option ' . $select . ' value="' . $c['id'] . '">' . $c['name'] . '</option>';
                                    }
                                    ?>
                                </select>		
                            </div>
                            <div class="form-group">
                                <label class="form-label">Outlet Code</label>
                                <?= $territory_reference_code . '/' . $route_reference_code . '/' ?><input class="form-control" type="text" name="outlet[dealercode]" value="<?= $dealercode ?>">
                            </div> 
                            <div class="form-group">
                                <label class="form-label">Outlet Range</label>
                                <select name="outlet[range]" class="form-control">
                                    <?php
                                    echo '<option  value=" ">C</option>';
                                    echo '<option  value=" ">D</option>';
                                    echo '<option  value=" ">CD</option>';
                                    ?>
                                </select>		
                            </div>
                            <div class="form-group">
                                <label class="form-label">Is Active Open Shop</label>
                                <input  <?= $isact ?> type="checkbox" name="outlet[isact]" value="1">                             
                            </div> 
                            <div class="form-group">
                                <label class="form-label">Is Approved Shop</label>
                                <input  <?= $isapprove ?> type="checkbox" name="outlet[is_new]" value="1">                             
                            </div> 
                            <div class="form-group">
                                <input class="btn btn-info" type="submit" name="Save" value="Save">

                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <?php
                        if ($image_created == 1) {
                            $haystack = $image_name;
                            $needle = '_';

                            if (strpos($haystack, $needle)!== false) {
                                ?>
                                <img style="width:450px;" src="<?= base_url('../dbbackup/update_image/' . $image_name) ?>"/>
                                <?php
                            } else {
                                ?>
                                <img style="width:450px;" src="<?= base_url('../dbbackup/images/' . $image_name) ?>"/>
                                <?php
                            }
                        } else {
                            ?>
                            <img style="width:450px;" src="data:image/jpeg;base64,<?= $image ?>"/>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <?php if (!empty($outlets) && isset($outlets)) { ?>

                        <table  id="example1" class="table table-hover">	
                            <thead>						
                                <tr>	
                                    <th>Distance</th>
                                    <th>ID</th>
                                    <th>Reference Code</th> 
                                    <th>Name</th> 		
                                    <th>Address 1</th> 	
                                    <th>Address 2</th> 	
                                    <th>Address 3</th> 	
                                    <th>Contact Person</th> 
                                    <th>Telephone</th> 	
                                    <th>Mobile</th> 	
                                    <th>Shop Type</th> 	
                                    <th>Created Date</th> 	
                                    <th>Created By</th> 	
                                    <th>Display Order</th> 	
                                    <th>Latitude</th> 	
                                    <th>Longitude</th> 	
                                    <th>Active</th> 	
                                    <th>New</th> 		
                                    <th>Image</th> 		
                                </tr>		
                            </thead>		
                            <tbody>			
                                <?php foreach ($outletsNearby as $o) { ?>
                                    <tr>	
                                        <td><?= (int) ($o['distance'] * 1000) ?> m</td> 	
                                        <td><a href="<?= base_url('salesarcustomers/editCustomers/' . $o['id']) ?>"><?= $o['territory_reference_code'] . '/' . $o['route_reference_code'] . '/' . $o['outlet_code'] ?></a></td> 
                                        <td><?= $o['reference_code'] ?></td> 
                                        <td><?= $o['name'] ?></td> 		
                                        <td><?= $o['address_1'] ?></td> 	
                                        <td><?= $o['address_2'] ?></td> 	
                                        <td><?= $o['address_3'] ?></td> 	
                                        <td><?= $o['contact_person'] ?></td> 	
                                        <td><?= $o['telephone'] ?></td> 	
                                        <td><?= $o['mobile'] ?></td> 		
                                        <td><?= $o['shop_type_name'] ?></td> 	
                                        <td><?= $o['created_date'] ?></td> 	
                                        <td><?= $o['created_by'] ?></td> 	
                                        <td><?= $o['display_order'] ?></td> 	
                                        <td><?= $o['latitude'] ?></td> 		
                                        <td><?= $o['longitude'] ?></td> 	
                                        <td><?= $o['is_act'] ?></td> 		
                                        <td><?= $o['is_new'] ?></td> 		
                                        <td><?php if ($o['image_created'] == 1) { ?><img style="width:150px;" src="<?= base_url('../dbbackup/images/' . $o['image_name']) ?>"/><?php } else { ?><img style="width:150px;" src="data:image/jpeg;base64,<?= $o['image'] ?>"/><?php } ?></td> 
                                    </tr>						
                                    <?php
                                }
                                ?>                    			
                            </tbody> 					
                        </table>					
                        <?php
                    }
                    ?> 

                </div>	
            </div>

            <div class="col-md-12">
                <div id="map" style="width:90%;height:600px;"></div> 
                <script src="https://www.gstatic.com/external_hosted/jquery2.min.js"></script>
                <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=geometry&key=AIzaSyDL5TFORfvAKrvixbuRLQWhqfNGLL8sFCY"></script> 
                <script type="text/javascript">
                    var center_lat = 0;
                    var center_lang = 0;
                    var locations = [
<?php
$str1 = '';
$str2 = '';
if (!empty($outletsNearby) && isset($outletsNearby)) {
    foreach ($outletsNearby as $h) {
        if ((int) $h['distance'] == 0) {
            $str1 = 'center_lat=' . $h['latitude'] . ';';
            $str2 = 'center_lang=' . $h['longitude'] . ';';
        }
        echo '[\'' . $h['name'] . '-' . ((int) ($h['distance'] * 1000)) . ' m\', ' . $h['latitude'] . ', ' . $h['longitude'] . ', 12],';
    }
}
?>
                    ];
<?php
echo $str1;
echo $str2;
?>
                    /*var locations = [
                     ['Bondi Beach', -33.890542, 151.274856, 4],
                     ['Coogee Beach', -33.923036, 151.259052, 5],
                     ['Cronulla Beach', -34.028249, 151.157507, 3],
                     ['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
                     ['Maroubra Beach', -33.950198, 151.259302, 1]
                     ];*/

                    var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 15,
                        center: new google.maps.LatLng(center_lat, center_lang),
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    });

                    var infowindow = new google.maps.InfoWindow();

                    var marker, i;
<?php echo 'var icon_url=\'' . base_url('adminlte/dist/img/special_map_marker.png') . '\';'; ?>
                    for (i = 0; i < locations.length; i++) {
                        if (locations[i][1] ==<?= $outlets->latitude ?> && locations[i][2] ==<?= $outlets->longitude ?>) {
                            marker = new google.maps.Marker({
                                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                                map: map,
                                icon: icon_url
                            });
                        } else {
                            marker = new google.maps.Marker({
                                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                                map: map
                            });
                        }


                        google.maps.event.addListener(marker, 'click', (function (marker, i) {
                            return function () {
                                infowindow.setContent(locations[i][0]);
                                infowindow.open(map, marker);
                            }
                        })(marker, i));
                    }
                </script>


            </div>
    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->


