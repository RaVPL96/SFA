<?php
/*
 * This system Licenced to Raigam Marketing Services (Pvt) Ltd. 
 * Developed By: Lakshitha Pradeep Karunarathna  * 
 * Company: Serving Cloud INC in association with MyOffers.lk  * 
 * Date Started: October 20, 2017  * 
 */
?>
<?php include_once BASEPATH . ('../application/views/template/leftsidebar.php'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Agency Stock 
            <small>View List</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">View List</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div id="successMessage" class="hideDiv">Updated Successfully! </div>
                <div id="errorMessage" class="hideDiv">Invalid Data! Please Try Again. </div>
                <div class="keepgap"></div> 
                <div class="col-md-12">
                        <!-- <div class="form-group">
							<label class="col-md-12 label label-default"> - ඇණවුම් ඉල්ලීම්  </label>
							<label class="col-md-12 label label-default"> - Orders</label>
							<label class="col-md-12 label label-default"> - අනිවාර්යයෙන් පිරවිය යුතු කොටස් තරු (<span class="text-red">*</span>) ලකුණින් ඇත.</label>
						<div class="clearfix"></div>
						<br>
						</div> -->
						<form class="form-horizontal" id="" action="<?= base_url('salesoetransaction/getViewList') ?>" method="post">

						<div class="col-md-6">                            
                        <div class="form-group">
                            <label class="col-md-2">Area <span class="text-red">*</span></label>
                            <div class="col-md-6">
                                <select id="aaareaID" name="areaID" class="form-control">
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
                            <label class="col-md-2">Range <span class="text-red">*</span></label>
                            <div class="col-md-6">
                                <select id="RangeRep" name="rangeID" class="form-control">
                                    <option value="-1"> -- Select Range -- </option>
                                    <?php
                                    foreach ($RangeList as $a) {
                                        $select = '';
                                        if (!empty($RangeID) && isset($RangeID) && $a['id'] == $RangeID) {
                                            $select = 'selected';
                                        }

                                        if ($sess['grade_id'] == 4) {
                                            foreach ($ASE_Area as $ase) {
                                                if ($ase['range_id'] == $a['id']) {
                                                    echo '<option ' . $select . ' value="' . $a['id'] . '~' . $a['range_name'] . '"> ' . $a['range_name'] . '</option>';
                                                }
                                            }
                                        } else {
                                            echo '<option ' . $select . ' value="' . $a['id'] . '~' . $a['range_name'] . '"> ' . $a['range_name'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>    
					<div class="col-lg-12">&nbsp;</div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-2">Territory</label>
                            <div class="col-md-6">
                                <select id="sbTerritory" name="territoryID" class="form-control">
                                    <option value=""> -- Select Territory -- </option>    
                                    <?php
                                    if (!empty($territory) && isset($territory)) {
                                        foreach ($territory as $t) {
                                            $select = '';
                                            if (!empty($TerritoryID) && isset($TerritoryID) && $TerritoryID == $t['id']) {
                                                $select = 'selected';
                                            }
                                            echo '<option ' . $select . ' value="' . $t['id'] . '"> ' . $t['territory_name'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>                            
                    </div>
					<div class="col-md-6">
							
							<div class="form-group">
								<label class="col-md-2">Stock Date <span class="text-red">*</span></label>
								<div class="col-md-6">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input type="text" name="requestDate" class="form-control pull-right" value="<?=date('Y-m-d')?> - <?=date('Y-m-d')?>" readonly id="reservation"/>
									</div><!-- /.input group -->
								</div><!-- /.form group -->	
							</div>
						</div>
						<div class="col-lg-12">&nbsp;</div>

						<div class="col-md-12">
                        <div class="form-group">
                            <input type="submit" class="btn btn-danger" name="submit" value="Get List">
                        </div>                                
                    </div>
								</form>
								<div class="col-md-6">
									
									<?php 

									if(isset($dataList)){
										?>

				<table class="table table-bordered table-hover" id="example1" style="overflow-x: scroll;clear:both;table-layout: fixed;width: 700px; "  >
					<thead>
						
				<tr >
                    <th width="50px">#</th>
                    <th width="100px">Stock In Date</th>
                    <th width="100px">Range</th>
                    <th width="100px">Total (Rs)</th>
                    <th width="400px">Comments</th>
                </tr>
					</thead>
					<tbody>
										<?php
								$r=1;
							foreach ($dataList as $key) {
							?>
						<tr onclick="view_stock_invoice('<?php echo $key['id']; ?>')" style="cursor: pointer;">
							<td><?php echo $r; ?></td>
							<td><?php echo $key['stock_in_date']; ?></td>
							<td><?php echo $key['range_name']; ?></td>
							<td style="text-align: right;"><?php echo number_format($key['net_total'],'2','.',','); ?></td>
							<td><?php echo $key['comments']; ?></td>
						</tr>


							<?php

								$r++;
							}
							?>
					</tbody>
					<?php

									}
									?>
						
					</table>			
								</div>
						
                </div>
                 <div class="col-md-12" id="">

                	
                </div>
            </div>
        </div>
        <div id="div_invoice"></div>
    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->

<script type="text/javascript">

  function view_stock_invoice(idinvoice) {

//    var discounts = discountss;
//        alert(discounts);
        //alert(idinvoice);
        $("#div_invoice").html('');
//    alert('aaa');
        $.ajax({
            type: 'post',
            url: "<?= base_url('Salesoetransaction/stockInvoiceView') ?>",
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

    $('#Operation').change(function() {
		$('#areawrap').empty();
		$('#territoryList').empty();
        var modID = $('#Operation').val();
        //alert(modID);
        $.ajax({
            type: "post",
            url: "<?php echo base_url('index.php/master/getOperationAreasAjax'); ?>",
            data: 'opid=' + modID,
            success: function(feed) {
                $('#uploading').modal('hide');
                //alert(feed);
                $('#areawrap').empty().append(feed);

            },
            error: function(feed) {
                console.log('Ajax request not recieved!' + feed);
                $('#uploading').modal('hide');
            }
        });
        return false;
    });
	$(document).on('change','#areaid',function() {
        var modID = $('#areaid').val();
		$('#territoryList').empty();
        //alert(modID);
        $.ajax({
            type: "post",
            url: "<?php echo base_url('index.php/master/getOperationAreasTerritoryAjax'); ?>",
            data: 'opid=' + modID,
            success: function(feed) {
                $('#uploading').modal('hide');
                //alert(feed);
                $('#territoryList').empty().append(feed);

            },
            error: function(feed) {
                console.log('Ajax request not recieved!' + feed);
                $('#uploading').modal('hide');
            }
        });
        return false;
    });
	
	$(document).on('change','#territoryid',function() {
        var modID = $('#territoryid').val();
		$('#routeList').empty();
        //alert(modID);
        $.ajax({
            type: "post",
            url: "<?php echo base_url('index.php/master/getOperationAreasTerritoryRouteAjax'); ?>",
            data: 'opid=' + modID,
            success: function(feed) {
                $('#uploading').modal('hide');
                //alert(feed);
                $('#routeList').empty().append(feed);

            },
            error: function(feed) {
                console.log('Ajax request not recieved!' + feed);
                $('#uploading').modal('hide');
            }
        });
        return false;
    });
	
</script>    
<script type="text/javascript">


	function addCustomerPopup(){
		window.open('<?= base_url('index.php/salesarcustomers/secondaryCustomersPopup/') ?>', 'popuppage', 'width=650,toolbar=1,resizable=1,scrollbars=yes,height=600,top=100,left=100');
	}
	
	function openItemList(id)//item list
    {    // open popup window and pass field id        
        var itemRow = id;
        window.open('<?= base_url('index.php/items/getItemListPopup/') ?>'+'/'+id, 'popuppage', 'width=650,toolbar=1,resizable=1,scrollbars=yes,height=600,top=100,left=100');
    }
	function updateRowFeedValue(feed)
    {
        // this gets called from the popup window and updates the field with a new value
        //alert(feed);
        var trmFeed = feed.trim();
        if ((trmFeed == '')) {

        } else {
            var arr = feed.split('~');
            //alert(arr[0]);
            var estimatepartcode = 'estimatepartcode' + arr[0];
            var estimatepartid = 'estimatepartid' + arr[0];
            var estimatepartname = 'estimatepartname' + arr[0];
			var estimatepartPriceCode='estimatepartPriceCode'+ arr[0];
            var estimatepartprice = 'estimatepartprice' + arr[0];
            var estimatepartpriceUnit = 'estimatepartpriceUnit' + arr[0];
			
            var estimatepartsubtot = 'estimatepartsubtotal' + arr[0];
            var estimatepartqty = 'estimatepartqty' + arr[0];

            
            document.getElementById(estimatepartcode).value = arr[2];
            document.getElementById(estimatepartid).value = arr[1];
			document.getElementById(estimatepartPriceCode).value = arr[4];
			document.getElementById(estimatepartpriceUnit).value = arr[6];
            document.getElementById(estimatepartname).value = arr[3];
            document.getElementById(estimatepartprice).value = arr[5];
			//var Subtot = parseFloat(document.getElementById(estimatepartqty).value) * parseFloat(arr[5]);
//alert(Subtot);
            // document.getElementById(estimatepartsubtot).value = 00.toFixed(2);
            sumThemUp();
        }

    }
	
	function sumThemUp() {
        var sum = 0;
        $("input[type='hidden'][name^='rowid']").each(function() {
            var rid = parseInt($(this).val());
            var estimatepartprice = 'estimatepartprice' + rid;
            var estimatepartsubtot = 'estimatepartsubtotal' + rid;
            var estimatepartqty = 'estimatepartqty' + rid;
            var Subtot = parseFloat(document.getElementById(estimatepartqty).value) * parseFloat(document.getElementById(estimatepartprice).value);
            // document.getElementById(estimatepartsubtot).value = 00.toFixed(2);
            sum = sum + Subtot;
        });
/*
        if ($('#estimatecourier').val() != 'undefined' && $('#estimatecourier').val().length != 0 && $('#estimatecourier').val() != '') {
            sum = sum + parseFloat($('#estimatecourier').val());
        }*/
        //alert($('#estimatecourier').val());

        // document.getElementById('estimatenet').value = sum.toFixed(2);
		// var estimatePayment =document.getElementById('estimatePayment').value;
		// var estimateBalance=parseFloat(sum)-parseFloat(estimatePayment);
		// document.getElementById('estimateBalance').value=estimateBalance.toFixed(2);
        //$('#estimatenet').val(sum.toFixed(2));
    }
	
	var lineCount = <?= $count + 1 ?>;
	
	function addItem() {
        lineCount = lineCount + 1;
        var btnClass = 'info';
        var func = 'openItemList';

        var htmlTxt = '<tr id="line' + lineCount + '">' +
                '<td class=""><input type="checkbox" name="estimateline" id="estimate1" value="line' + lineCount + '"><input type="hidden" name="rowid[]" id="rowid" value="' + lineCount + '"></td>' +
                '<td class="col-md-2">' +
                '<div class="input-group ">' +
                '<input class="form-control" type="text" name="estimatepartcode[]" readonly="readonly" id="estimatepartcode' + lineCount + '">' +
                '<span class="input-group-btn">' +
                '<button class="btn btn-' + btnClass + ' btn-flat" type="button" onclick="' + func + '(\'' + lineCount + '\');"><i class="fa fa-plus"></i></button>' +
                '</span>' +
                '</div>' +
                '<input class="form-control" type="hidden" name="estimatepartid[]" id="estimatepartid' + lineCount + '">' +
				'<input class="form-control" type="hidden" name="estimatepartPriceCode[]" id="estimatepartPriceCode' + lineCount + '" value="part">'+
                '</td>' +
                '<td class="col-md-3"><input class="form-control" name="estimatepartname[]" id="estimatepartname' + lineCount + '" type="text" readonly="readonly"></td>' +
				'<td class="col-md-1"><input style="width: 58px;" class="form-control text-center" type="text" name="estimatepartpriceUnit[]"  id="estimatepartpriceUnit' + lineCount + '" value="" readonly="readonly"></td>'+
                '<td class="col-md-2"><div class="col-md-12"><input class="form-control text-right" name="estimatepartqty[]" onkeyup="setSubTot(' + lineCount + ')" id="estimatepartqty' + lineCount + '" type="text" value=""></div></td>' +
                '<td class="col-md-2"><div class="col-md-12"><input class="form-control text-right" name="estimatedamageqty[]" onkeyup="setSubTot(' + lineCount + ')" id="estimatedamageqty' + lineCount + '" type="text" value=""></div></td>' +
                '<td class="col-md-2"><input style="width: 89px;"  class="form-control text-right" type="text" name="estimatepartprice[]" id="estimatepartprice' + lineCount + '" value="0.00" readonly="readonly"></td>' +
                '<td class="col-md-3"><div class="col-md-12"><input class="form-control text-right" type="text" name="estimatepartsubtotal[]" id="estimatepartsubtotal' + lineCount + '" readonly="readonly" value="0.00"></div></td>' +
                '</tr>';
				
				
				
        $('#appendhere').append(htmlTxt);
    }

    function deleteItem() {
        //var selected = new Array();
        $("input:checkbox[name=estimateline]:checked").each(function() {
            //selected.push($(this).val());
            var rID = '#' + $(this).val();
            $(rID).remove();
            sumThemUp();
        });
    }
	$("input[type='text'][name^='estimatepartqty']").on('keyup', function() {
        sumThemUp();
    });


    $(document).on('change', "input[type='text'][name^='estimatepartqty']", function() {
        sumThemUp();
    });
	$("input[type='text'][name^='estimatePayment']").on('keyup', function() {
        // sumThemUp();
        totalNet();
    });
</script>
<script type="text/javascript">
							function setTextField(ddl) {
								document.getElementById('CompanyName').value = ddl.options[ddl.selectedIndex].text;
							}
							
								$('#OrderData').validate({
									rules: {
										"customerID":{
											required: true
										},
										"amount":{
											required: true
										},
										"datepicker":{
											required: true
										}
									},
									messages: {
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
									}
								});
							
							
						</script>