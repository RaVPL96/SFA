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
            Secondary Sales Invoice Entry
            <small>O/E Transactions</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">O/E Transactions Module</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div id="successMessage" class="hideDiv">Updated Successfully! </div>
                <div id="errorMessage" class="hideDiv">Invalid Data! Please Try Again. </div>
                <div class="keepgap"></div> 
                <div class="col-md-7">
                        <form class="form-horizontal" id="" action="<?= base_url('salesoetransaction/InvoiceEntry') ?>" method="post">
						<div class="form-group">
							<label class="col-md-12 label label-default"> - ඇණවුම්  </label>
							<label class="col-md-12 label label-default"> - Invoice Entry</label>
							<label class="col-md-12 label label-default"> - අනිවාර්යයෙන් පිරවිය යුතු කොටස් තරු (<span class="text-red">*</span>) ලකුණින් ඇත.</label>
						<div class="clearfix"></div>
						<br>
						</div>
								<div class="form-group">
                                    <select <?php 
									//$oplid=''; 
									if($oplid!=''){echo 'disabled="disabled" '; }?> class="form-control" id="Operation" name="sop[sopid]">
										<option value="">--Select Sales Operation--</option>
										<?php
										if(!empty($OpData) && isset($OpData)){
											foreach($OpData as $op){
												$select='';
												if($oplid==$op['id']){
													$select='selected="selected"';
												}
												echo '<option '.$select.' value="'.$op['id'].'">'.$op['name'].'</option>';
											}
										}
										?>
									</select>
									<?php if($oplid!=''){echo '<input type="hidden" name="sop[sopid]" class="form-control" value="'.$oplid.'">';}?>
                                </div>
								<div id="areawrap" class="form-group">
								<?php //$sopaid='';
								if(!empty($OperationArea) && isset($OperationArea)){
									$disabled='';
									if($sopaid!=''){
											$disabled='disabled="disabled" ';
									}
									$str='<select '.$disabled.' class="form-control" name="sop[areaid]" id="areaid">';
									foreach($OperationArea as $area){
										$select='';
										if($sopaid==$area['id']){
											$select='selected="selected" ';
										}
										$str .= '<option '.$select.' value="'.$area['id'].'">'.$area['name'].'</option>';
									}
									$str .='</select>';
									echo $str ;
								}
								?>
								<?php if($sopaid!=''){echo '<input type="hidden" name="sop[areaid]" class="form-control" value="'.$sopaid.'">'; }?>
								</div>
                                <div class="form-group" id="territoryList">
									<?php
									//$territoryid='';
								if(!empty($OpAreaTerritoryData) && isset($OpAreaTerritoryData)){
									$disabled='';
									if($territoryid!=''){
											$disabled='disabled="disabled" ';
										}
									$str='<select '.$disabled.' class="form-control" name="sop[territoryid]" id="territoryid">';
									foreach($OpAreaTerritoryData as $area){
										$select='';
										if($territoryid==$area['id']){
											$select='selected="selected" ';
										}
										$str .= '<option '.$select.' value="'.$area['id'].'">'.$area['name'].'</option>';
									}
									$str .='</select>';
									echo $str ;
								}
								?>
                                    <?php if($territoryid!=''){echo '<input type="hidden" name="sop[territoryid]" class="form-control" value="'.$territoryid.'" placeholder="Enter Name for the Territory">'; }?>
                                </div>
								<div class="form-group" id="routeList">
								<?php
									//$routeid='';
								if(!empty($OpAreaTerritoryRouteData) && isset($OpAreaTerritoryRouteData)){
									$disabled='';
									if($routeid!=''){
											$disabled='disabled="disabled" ';
										}
									$str='<select '.$disabled.' class="form-control" name="sop[territoryid]" id="territoryid">';
									foreach($OpAreaTerritoryRouteData as $area){
										$select='';
										if($routeid==$area['id']){
											$select='selected="selected" ';
										}
										$str .= '<option '.$select.' value="'.$area['id'].'">'.$area['route'].'</option>';
									}
									$str .='</select>';
									echo $str ;
								}
								?>
                                    <?php if($routeid!=''){echo '<input type="hidden" name="sop[routeid]" class="form-control" value="'.$routeid.'" placeholder="Enter Name for the Territory">'; }?>
									
								</div>
								<div class="form-group" id="loadCustomerBtn">
									<button type="submit" value="1" name="btnLoadCustomers" class="btn btn-md btn-warning float-right"><i class="fa fa-arrow-down fa-2x" aria-hidden="true"></i> Load Customers</button>
								</div>
								</form>
								</div>
								<div class="col-md-12" id="">
								<div class="box">
								<div class="box-body">
								<h3>Orders to be Invoice</h3>
                    <?php if(!empty($Orders) && isset($Orders)){
						?>
<table id="example1" class="table table-hover">
	<thead>
		<tr>
			<!-- <th>Operation</th>
			<th>Area</th>
			<th>Territory</th> -->
			<th>Route</th>
			<th>Customer</th>
			<th>Mobile</th>
			<th>Date</th>
			<th>Entered By</th>
			<th>Order Amount</th>
			<th>Approved Amount</th>
			<th>Status</th>
			<th>Approved By</th>
			<th>Approved Date</th>
			<th>Action</th>			
		</tr>	
	</thead>
	<tbody>
		<?php foreach($Orders as $ord){ 
			$status='';
			if($ord['is_approved']==0){
				$status='<label class="label label-warning">Pending</label>';
			}elseif($ord['is_approved']==1){
				$status='<label class="label label-success">Approved</label>';
			}elseif($ord['is_approved']==2){
				$status='<label class="label label-danger">Rejected</label>';
			}
		
		?>
		<tr>
			<!-- <td><?=$ord['opration_name']?></td>
			<td><?=$ord['area_name']?></td> 
			<td><?=$ord['territory_name']?></td> -->
			<td><?=$ord['route_code'].' - '.$ord['route']?></td>
			<td><?=$ord['cus_name']?></td>
			<td><?=$ord['mobile']?></td>
			<td><?=$ord['order_date']?></td>
			<td><?=$ord['audit_user']?></td>
			<td><?=$ord['net_amount']?></td>
			<td><?=$ord['approved_amount']?></td>
			<td><?=$status?></td>
			<td><?=$ord['approved_by']?></td>
			<td><?=$ord['approved_date']?></td>
			<td><a class="link link-success" href="<?=base_url('salesoetransaction/InvoiceEntry/'.$ord['id'])?>">Invoice</a></td>
		</tr>
		<?php } ?>
	</tbody>
</table>						
						<?php
					}?>
					</div>
					</div>
                </div>
				<div class="col-md-12" id="">
					<form class="form-horizontal" id="OrderData" action="<?= base_url('salesoetransaction/saveInvoice') ?>" method="post">
						<?php
						$cusid='';
						$orderdate='';
						$amount='';
						$apprveamount='';
						$orderID='';
						$invoiceid='new';
						if(!empty($OrderData) && isset($OrderData)){
							$orderID=$OrderData->id;
							$cusid=$OrderData->customer_id;
							$orderdate=$OrderData->order_date;
							$amount=$OrderData->net_amount;
							$apprveamount=$OrderData->approved_amount;
							$oplid=$OrderData->channel_id;
							$sopaid=$OrderData->area_id;
							$territoryid=$OrderData->territory_id;
							$routeid=$OrderData->route_id;
						}
						?>					
						<div class="form-group">		
						<label class="col-md-4">Customer <span class="text-red">*</span></label>
							<div class="col-md-8">
								<select disabled id="customerID" name="customerID" class="form-control selectpicker" data-show-subtext="true" data-live-search="true"  onchange="setTextField(this)">
									<?php									
									if(!empty($OperationAreaTerritoryCustomers) && isset($OperationAreaTerritoryCustomers)){
										foreach ($OperationAreaTerritoryCustomers as $loc){
											$select='';
											if($loc['cusSYSID']==$cusid){
												$select='selected="selected"';
											}
											echo '<option '.$select.' value="'.$loc['cusSYSID'].'" data-subtext="' . $loc['cusSYSID']. '">'.$loc['cus_name'].'</option>';
										}
									}
									?>
									<!-- <option data-subtext="Rep California" disabled="disabled">Marvin Martinez</option>  https://codepen.io/Rio517/pen/NPLbpP -->
								</select><br>
								<span class="help-inline">Type <code>Customer Name</code>. If Not Listed add Customer name and code to RMIS MYSQL DB. Contact System Developer Lakshitha 0776937555</span>								
								<?php
								if(!empty($OperationAreaTerritoryCustomers) && isset($OperationAreaTerritoryCustomers)){
									echo '<input type="hidden" name="operationID" value="'.$oplid.'"/>';
									echo '<input type="hidden" name="areaID" value="'.$sopaid.'"/>';
									echo '<input type="hidden" name="territoryID" value="'.$territoryid.'"/>';
									echo '<input type="hidden" name="routeID" value="'.$routeid.'"/>';
									echo '<input type="hidden" name="customerID" value="'.$cusid.'"/>';
								}
								
								?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4">System Order Reference<span class="text-red">*</span></label>
							<div class="col-md-8">
								<div class="input-group">
									<div class="input-group-addon">
										ORDS
									</div>
									<input type="text" class="form-control pull-right" readonly name="orderID" value="<?=$orderID?>"/>
								</div>
							</div><!-- /.form group -->	
						</div>
						<!-- Date range -->
						<div class="form-group">
							<label class="col-md-4">Order Date <span class="text-red">*</span></label>
							<div class="col-md-8">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" readonly name="requestDate" class="form-control pull-right" id="" value="<?=$orderdate?>"/>
								</div><!-- /.input group -->
							</div><!-- /.form group -->	
						</div>
						<div class="form-group">
							<label class="col-md-4">Requested Amount <span class="text-red">*</span></label>
							<div class="col-md-8">
								<div class="input-group">
									<div class="input-group-addon">
										Rs.
									</div>
									<input type="text" readonly name="amount" class="form-control pull-right" id="amount" value="<?=$amount?>"/>
								</div><!-- /.input group -->
							</div><!-- /.form group -->	
						</div>
						<div class="form-group">
							<label class="col-md-4">Approved Amount <span class="text-red">*</span></label>
							<div class="col-md-8">
								<div class="input-group">
									<div class="input-group-addon">
										Rs.
									</div>
									<input type="text" readonly name="approveamount" class="form-control pull-right" id="approveamount" value="<?=$apprveamount?>"/>
								</div><!-- /.input group -->
							</div><!-- /.form group -->	
						</div>
						<div class="form-group">
							<label class="col-md-4">ERP Invoice Number<span class="text-red">*</span></label>
							<div class="col-md-8">
								<input type="text" name="ErpInvNum" class="form-control pull-right" id="ErpInvNum" value=""/>
							</div><!-- /.form group -->	
						</div>
						<div class="form-group">
							<label class="col-md-4">Invoice Date<span class="text-red">*</span></label>
							<div class="col-md-8">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" readonly name="InvDate" class="form-control pull-right" id="datepicker" value=""/>
								</div><!-- /.input group -->
							</div><!-- /.form group -->	
						</div>
						<div class="form-group">
							<label class="col-md-4">Invoice Amount<span class="text-red">*</span></label>
							<div class="col-md-8">
								<input type="text" name="InvAmount" class="form-control pull-right" id="InvAmount" value=""/>
							</div><!-- /.form group -->	
						</div>
						<div class="form-group">
						
							<div class="col-md-12">
							<div class="" id="responseData"></div>
							<input type="hidden" name="invoiceID" value="<?=$invoiceid?>"/>
							<button type="reset" value="1" name="GenerateReport" class="btn btn-sm btn-default float-right"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Cancel</button>
							<button type="submit" value="2" name="GenerateReport" class="btn btn-sm btn-success float-right"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Create Invoice</button>
							</div>
                        </div>
						
                    </form>
                </div>
                <div class="col-md-12" id="">
								<div class="box">
								<div class="box-body">
								<h3>Orders Already Invoiced</h3>
                    <?php if(!empty($Invoices) && isset($Invoices)){
						?>
<table id="example1" class="table table-hover">
	<thead>
		<tr>
			<!-- <th>Operation</th>
			<th>Area</th>
			<th>Territory</th> -->
			<th>Route</th>
			<th>Customer</th>
			<th>Mobile</th>
			<th>System Order Number</th>
			<th>Order Date</th>
			<th>Entered By</th>
			<th>Order Amount</th>
			<th>Approved Amount</th>
			<th>Status</th>
			<th>Approved By</th>
			<th>Approved Date</th>
			<th>Invoice Date</th>		
			<th>ERP Invoice Number</th>	
			<th>Invoice Amount</th>	
			<th>Invoiced By</th>							
		</tr>	
	</thead>
	<tbody>
		<?php foreach($Invoices as $ord){ 
			$status='';
			if($ord['is_approved']==0){
				$status='<label class="label label-warning">Pending</label>';
			}elseif($ord['is_approved']==1){
				$status='<label class="label label-success">Approved</label>';
			}elseif($ord['is_approved']==2){
				$status='<label class="label label-danger">Rejected</label>';
			}
		
		?>
		<tr>
			<!-- <td><?=$ord['opration_name']?></td>
			<td><?=$ord['area_name']?></td> 
			<td><?=$ord['territory_name']?></td> -->
			<td><?=$ord['route_code'].' - '.$ord['route']?></td>
			<td><?=$ord['cus_name']?></td>
			<td><?=$ord['mobile']?></td>
			<td>ORDS<?=$ord['system_order_id']?></td>
			<td><?=$ord['order_date']?></td>
			<td><?=$ord['ord_audit_user']?></td>
			<td><?=$ord['net_amount']?></td>
			<td><?=$ord['approved_amount']?></td>
			<td><?=$status?></td>
			<td><?=$ord['approved_by']?></td>
			<td><?=$ord['approved_date']?></td>
			<td><?=$ord['inv_date']?></td>
			<td><?=$ord['erp_inv_number']?></td>
			<td><?=$ord['inv_amount']?></td>
			<td><?=$ord['audit_user']?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>						
						<?php
					}?>
					</div>
					</div>
                </div
            </div>
        </div>
    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->

<script type="text/javascript">
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
										},
										"approveamount":{
											required: true
										},
										"approve":{
											required: true
										},
										"ErpInvNum":{
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