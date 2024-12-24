<?php include_once BASEPATH . ('../application/views/template/leftsidebar.php'); ?>
<style>
    /* (A) LIST STYLES */
    .slist {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .slist li {
        margin: 10px;
        padding: 15px;
        border: 1px solid #dfdfdf;
        background: #f5f5f5;
    }

    /* (B) DRAG-AND-DROP HINT */
    .slist li.hint {
        border: 1px solid #ffc49a;
        background: #feffb4;
    }
    .slist li.active {
        border: 1px solid #ffa5a5;
        background: #ffe7e7;
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Display Order Secondary Sales Customers
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
                <form class="form-horizontal" id="" action="<?= base_url('salesarcustomers/shopOrder') ?>" method="post">
                    <div class="col-md-6">                            
                        <div class="form-group">
                            <label class="col-md-2">Area <span class="text-red">*</span></label>
                            <div class="col-md-6">
                                <select id="areaID" name="areaID" class="form-control">
                                    <option value="-1"> -- Select Area -- </option>    
                                    <?php
                                    foreach ($AreaList as $a) {
                                        $select = '';
                                        if (!empty($AreaID) && isset($AreaID) && $a['id'] == $AreaID) {
                                            $select = 'selected';
                                        }
                                        if (!empty($ASE_Area) && isset($ASE_Area) && $sess['grade_id'] == 4) {//ASE LOGIN LIMIT TO ACCESSILE AREAS
                                            foreach ($ASE_Area as $b) {
                                                if ($b['area_id'] == $a['id']) {
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
                                    foreach ($territory as $t) {
                                        $select = '';
                                        if (!empty($TerritoryID) && isset($TerritoryID) && $TerritoryID == $t['id']) {
                                            $select = 'selected';
                                        }
                                        echo '<option ' . $select . ' value="' . $t['id'] . '"> ' . $t['territory_name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>                            
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-2">Route <span class="text-red">*</span></label>
                            <div class="col-md-6">
                                <select id="routeID" name="routeID" class="form-control">
                                    <option value=""> -- Select Route -- </option>                                       
                                </select>
                            </div>
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
                            <select name="channel[]" id="example28" multiple="multiple" class="form-control" style="display: none;"><option value="multiselect-all"> Select all</option>
                    <?php
                    foreach ($ChannelDataSet as $ch) {
                        echo '<option value="' . $ch['id'] . '"> ' . $ch['channel_name'] . '</option>';
                    }
                    ?>
                            </select>
                            <div class="btn-group open"> 
                            </div>			
                        </div>				
                    </div>
                    -->
                </form>
                <?php if (!empty($outlets) && isset($outlets)) { ?>
                    <div class="box box-info col-md-12">
                        <div class="box-header"><h3><?php echo $areaData->area_name .' - ' . $territoryData->territory_name .' - ' . $routeData->route_name .'('.$routeData->reference_code.')' ?></h3>Drag and drop to setup display order</div>
                        <div class="box-body">
                            <form class="form-horizontal" id="" action="<?= base_url('salesarcustomers/shopOrderSave') ?>" method="post">
                                <input type="hidden" name="area_id" value="<?= $area_id ?>">
                                <input type="hidden" name="territory_id" value="<?= $territory_id ?>">
                                <input type="hidden" name="route_id" value="<?= $route_id ?>">
                                <ul id="sortlist" >


                                    <?php
                                    foreach ($outlets as $o) {
                                        $shop_stat = 'Close';
                                        if ($o['is_act'] == 1) {
                                            $shop_stat = 'Open';
                                        }
                                        $shop_new = '';
                                        if ($o['is_new'] == 1) {
                                            $shop_new = 'New';
                                        }
                                        ?>
                                        <li>  <a target="_blank" href="#"><?= $o['territory_reference_code'] . '/' . $o['route_reference_code'] . '/' . $o['outlet_code'] ?></a></td> 
                                            - <strong><?= $o['name'] ?></strong></td> 

                                            [<?= $o['address_1'] ?>,	
                                            <?= $o['address_2'] ?>,
                                            <?= $o['address_3'] ?>]
                                            - <?= $o['contact_person'] ?> 	
                                            - <?= $o['mobile'] ?> 		
                                            - <?= $o['shop_type_name'] ?> 
                                            -  <?= $o['created_date'] ?>  	
                                            - <?= $o['created_by'] ?> 	
                                            - <strong><?= $o['display_order_in_route'] ?></strong> 	
											<!--
                                            - <?= $shop_stat ?> 		
                                            - <?= $o['id'] ?>  -->	
											<input type="hidden" name="shopListRef[]" value="<?= $o['reference_code'] ?> ">	
                                            <input type="hidden" name="shopList[]" value="<?= $o['id'] ?> ">
                                        </li>
                                        <?php
                                    }
                                    ?>                    			

                                </ul>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-danger" name="submit" value="Save Display Order">
                                    </div>                                
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                }
                ?>



            </div>


        </div>
    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->




<!-- jQuery 2.1.4 -->
<script src="<?= base_url('adminlte/plugins/jQuery/jQuery-2.1.4.min.js') ?>"></script>        
<script src="<?= base_url('adminlte/dist/js/validate/jquery.validate.min.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('adminlte/dist/js/validate/placeholders.min.js') ?>" type="text/javascript"></script>

<script>
    window.addEventListener("DOMContentLoaded", () => {
        slist(document.getElementById("sortlist"));
    });
    function slist(target) {
        // (A) SET CSS + GET ALL LIST ITEMS
        target.classList.add("slist");
        let items = target.getElementsByTagName("li"), current = null;

        // (B) MAKE ITEMS DRAGGABLE + SORTABLE
        for (let i of items) {
            // (B1) ATTACH DRAGGABLE
            i.draggable = true;
            // (B2) DRAG START - YELLOW HIGHLIGHT DROPZONES
            i.ondragstart = (ev) => {
                current = i;
                for (let it of items) {
                    if (it != current) {
                        it.classList.add("hint"); }
                }
            };

            // (B3) DRAG ENTER - RED HIGHLIGHT DROPZONE
            i.ondragenter = (ev) => {
                if (i != current) {
                    i.classList.add("active");
                }
            };

            // (B4) DRAG LEAVE - REMOVE RED HIGHLIGHT
            i.ondragleave = () => {
                i.classList.remove("active");
            };

            // (B5) DRAG END - REMOVE ALL HIGHLIGHTS
            i.ondragend = () => {
                for (let it of items) {
                    it.classList.remove("hint");
                    it.classList.remove("active");
                }
            };

            // (B6) DRAG OVER - PREVENT THE DEFAULT "DROP", SO WE CAN DO OUR OWN
            i.ondragover = (evt) => {
                evt.preventDefault();
            };

            // (B7) ON DROP - DO SOMETHING
            i.ondrop = (evt) => {
                evt.preventDefault();
                if (i != current) {
                    let currentpos = 0, droppedpos = 0;
                    for (let it = 0; it < items.length; it++) {
                        if (current == items[it]) {
                            currentpos = it;
                        }
                        if (i == items[it]) {
                            droppedpos = it;
                        }
                    }
                    if (currentpos < droppedpos) {
                        i.parentNode.insertBefore(current, i.nextSibling);
                    } else {
                        i.parentNode.insertBefore(current, i);
                    }
                }
            };
        }
    }
</script>
<script type="text/javascript">
    $("#frmLocation").validate({
        rules: {
            "location[name]": {
                required: true
            },
            "location[address]": {
                required: true
            },
            "location[phone]": {
                required: true
            },
            "location[email]": {
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
</script>


<script type="text/javascript">
    $('#Operation').change(function () {
        $('#areawrap').empty();
        $('#territoryList').empty();
        var modID = $('#Operation').val();
        //alert(modID);
        $.ajax({
            type: "post",
            url: "<?php echo base_url('index.php/master/getOperationAreasAjax'); ?>",
            data: 'opid=' + modID,
            success: function (feed) {
                $('#uploading').modal('hide');
                //alert(feed);
                $('#areawrap').empty().append(feed);

            },
            error: function (feed) {
                console.log('Ajax request not recieved!' + feed);
                $('#uploading').modal('hide');
            }
        });
        return false;
    });
    $(document).on('change', '#areaid', function () {
        var modID = $('#areaid').val();
        $('#territoryList').empty();
        //alert(modID);
        $.ajax({
            type: "post",
            url: "<?php echo base_url('index.php/master/getOperationAreasTerritoryAjax'); ?>",
            data: 'opid=' + modID,
            success: function (feed) {
                $('#uploading').modal('hide');
                //alert(feed);
                $('#territoryList').empty().append(feed);

            },
            error: function (feed) {
                console.log('Ajax request not recieved!' + feed);
                $('#uploading').modal('hide');
            }
        });
        return false;
    });

    $(document).on('change', '#territoryid', function () {
        var modID = $('#territoryid').val();
        $('#routeList').empty();
        //alert(modID);
        $.ajax({
            type: "post",
            url: "<?php echo base_url('index.php/master/getOperationAreasTerritoryRouteAjax'); ?>",
            data: 'opid=' + modID,
            success: function (feed) {
                $('#uploading').modal('hide');
                //alert(feed);
                $('#routeList').empty().append(feed);

            },
            error: function (feed) {
                console.log('Ajax request not recieved!' + feed);
                $('#uploading').modal('hide');
            }
        });
        return false;
    });

</script>    


<script type="text/javascript">
    function deleteData(uid, reqType, upval) {
        if (reqType == 'update') {
            $.ajax({
                type: "post",
                url: "<?php echo base_url('index.php/items/updateLocData'); ?>",
                data: 'id=' + uid + '&reqType=' + reqType + '&upVal=' + upval,
                success: function (feed) {
                    if (feed.trim() == '1') {
                        //swal("Updated!", "Your data is now updated.", "success");
                        window.location.reload();
                    } else {
                        swal("Error!", "Unable to process your request", "error");
                    }
                },
                error: function (feed) {
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
                    function () {
                        $.ajax({
                            type: "post",
                            url: "<?php echo base_url('index.php/items/updateLocData'); ?>",
                            data: 'id=' + uid + '&reqType=' + reqType + '&upVal=' + upval,
                            success: function (feed) {
                                if (feed.trim() == '1') {
                                    swal("Updated!", "Your data is now updated.", "success");
                                    window.location.reload();
                                } else {
                                    swal("Error!", "Unable to process your request", "error");
                                }
                            },
                            error: function (feed) {
                                swal("Error!", "Unable to process your request", "error");
                            }
                        });
                    });
        }
    }
</script>