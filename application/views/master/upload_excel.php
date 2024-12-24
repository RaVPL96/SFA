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
            Upload Category Wise Target Sale
            <small>Upload Excel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Master / Target Sale</li>
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
						<form class="form-horizontal" id="" action="<?= base_url('config/uploadExcel') ?>" method="post" enctype="multipart/form-data">

					<div class="col-md-5">                            
                        <div class="form-group">
                            <label class="col-md-2">Upload Excel File <span class="text-red">*</span></label>
                            <div class="col-md-6">
                                <input type="file" class="form-control" name="excel_file" accept=".xlsx, .xls" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">                            
                        <div class="form-group">
                            <label class="col-md-2">Range<span class="text-red">*</span></label>
                            <div class="col-md-6">
                                <select class="form-control" name="range" required>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
							
							<div class="form-group">
								<label class="col-md-2">Upload Date <span class="text-red">*</span></label>
								<div class="col-md-6">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input type="text" name="requestDate" class="form-control pull-right" value="<?=date('Y-m-d')?>" readonly id="datepicker" required/>
									</div><!-- /.input group -->
								</div><!-- /.form group -->	
							</div>
						</div>
                        
					<div class="col-lg-12">&nbsp;</div>
                    
					
						<div class="col-lg-12">&nbsp;</div>

						<div class="col-md-12">
                        <div class="form-group">
                            <input type="submit" class="btn btn-danger" name="submit" value="Upload">
                        </div>                                
                    </div>
								</form>
								
						<!-- <div class="clearfix"></div> -->
						
							
                </div>
                 
            </div>
        </div>

    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->

<script type="text/javascript">

        function totalNet(){

            var total = 0;

        	var upRow = document.getElementById('rowid').value;

        	for (let t = 1; t <= upRow; t++) {
        		if(document.getElementById('estimatepartsubtotal'+t).value != ''){

                        total= total+parseFloat(document.getElementById('estimatepartsubtotal'+t).value);
                    }
        	}


            var row = document.getElementById('rowCount').value;
            
            for (let i = 1; i < row; i++) {
                    if(document.getElementById('subTotal'+i).value != ''){

                        total= total+parseFloat(document.getElementById('subTotal'+i).value);
                    }
                }
                // alert(total)
            document.getElementById('estimatenet').value = total.toFixed(2);
            var payments = document.getElementById('estimatePayment').value;
            document.getElementById('estimateBalance').value = (total-payments).toFixed(2);;

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

	function checkSubTot(id){
		var qty = parseFloat(document.getElementById('sellableQty'+id).value);
		var dam = parseFloat(document.getElementById('damageQty'+id).value);
		var price = parseFloat(document.getElementById('unitPrice'+id).value);
		console.info(dam);
		if(isNaN(qty)){qty=0;}
		if(isNaN(dam)){dam=0;}
		var totVal = (qty+dam)*price;
		
		document.getElementById('subTotal'+id).value = totVal.toFixed(2);
        totalNet();
	}
	function setSubTot(id){

		var qty = parseFloat(document.getElementById('estimatepartqty'+id).value);
		var dam = parseFloat(document.getElementById('estimatedamageqty'+id).value);
		var price = parseFloat(document.getElementById('estimatepartprice'+id).value);

		if(isNaN(qty)){qty=0;}
		if(isNaN(dam)){dam=0;}

		var totVal = (qty+dam)*price;
		
		document.getElementById('estimatepartsubtotal'+id).value = totVal.toFixed(2);

        totalNet();

	}
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