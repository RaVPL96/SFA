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
            OE Invoice Detail/Summery Reports
            <small>O/E Order Entry Reports</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Order Entry Module</li>
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
                    <form class="form-horizontal" id="OrderData" action="<?= base_url('orderentryreports/genErpInvoiceData') ?>" method="post">
                        <label class="col-md-12 label label-default"> -  ඉන්වොයිසි වාර්ථාව - සවිස්තරාත්මක/සාරාංශය - </label>
						<label class="col-md-12 label label-default"> - කිහිපයක් එක වර සොයා ගැනීමට 'Enter' Key භාවිත කර නව රූලකින් ඇතුලත් කරන්න.  අනිවාර්යයෙන් පිරවිය යුතු කොටස් තරු (<span class="text-red">*</span>) ලකුණින් ඇත.</label>
						<div class="clearfix"></div>
						<br>
						<div class="form-group">
							<label class="col-md-2">Company <span class="text-red">*</span></label>
							<div class="col-md-6">
								<select id="CompanyCode" name="CompanyCode" class="form-control selectpicker" data-show-subtext="true" data-live-search="true"  onchange="setTextField(this)">
									<?php									
									if(!empty($location) && isset($location)){
										foreach ($location as $loc){
											echo '<option value="'.$loc['code'].'" data-subtext="' . $loc['code']. '">'.$loc['name'].'</option>';
										}
									}
									?>
									<!-- <option data-subtext="Rep California" disabled="disabled">Marvin Martinez</option>  https://codepen.io/Rio517/pen/NPLbpP -->
								</select><br>
								<span class="help-inline">Type <code>Company Name</code>. If Not Listed add Comapny name and code to RMIS DB. Contact System Developer Lakshitha 0776937555</span>								
							</div>
						</div>
						<div class="form-group">						
							<label class="col-md-2">Item(s)</label>
							<div class="col-md-5">
								Code is Like
								<textarea class="form-control" id="ItemCode" name="ItemCode" value=""></textarea>
							</div>
							<div class="col-md-5">
								Name is Like
								<textarea class="form-control" id="ItemName" name="ItemName" value=""></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2">Customers(s)</label>
							<div class="col-md-5">
								Code is Like
								<textarea class="form-control" id="CustomerCode" name="CustomerCode" value=""></textarea>
							</div>
							<div class="col-md-5">
								Name is Like
								<textarea class="form-control" id="CustomerName" name="CustomerName" value=""></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2">Location(s) <span class="text-red">*</span></label>
							<div class="col-md-5">
								<select class="form-control" name="locationCode[]" id="locationCodes" MULTIPLE size="8">
								   <option value="FG">FG</option>
								   <option value="PU">PU</option>
								   <option value="DLSK">DLSK</option>
								   <option value="DLS">DLS</option>
								</select>
								<br />
								<input type="button" id="select_all" name="select_all" value="Select All">
								<script>
								  $('#select_all').click( function() {
										$('#locationCode option').prop('selected', true);
									});
								</script>
							</div>
						</div>
						<!-- Date range -->
						<div class="form-group">
							<label class="col-md-2">Date Range <span class="text-red">*</span></label>
							<div class="col-md-6">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" name="DateRange" class="form-control pull-right" readonly id="reservation"/>
								</div><!-- /.input group -->
							</div><!-- /.form group -->	
						</div>
						<div class="form-group">
							<label class="col-md-2">Report Type<span class="text-red">*</span></label>
							<div class="col-md-8">
								<div class="input-group">
									<label class="col-md-6"><input type="radio" value="OE_Inv_Details" name="reportType" /> Item-wise Group Report</label>
									<label class="col-md-6"><input type="radio" value="OE_Inv_Details_Item_Customer_Wise" name="reportType" /> Item, Customer-wise Group Report</label>
									<label class="col-md-6"><input type="radio" value="OE_Inv_Details_Customer_Item_Wise" name="reportType" /> Customer, Item-wise Report</label>
								</div><!-- /.input group -->
							</div><!-- /.form group -->	
						</div>
						<div class="form-group">
							<div class="col-md-6">
							<button type="submit" value="1" name="GenerateReport" class="btn btn-md btn-warning float-right"><i class="fa fa-file-pdf-o fa-5x" aria-hidden="true"></i> Generate Report PDF</button>
							<button type="submit" value="2" name="GenerateReport" class="btn btn-md btn-success float-right"><i class="fa fa-file-excel-o fa-5x" aria-hidden="true"></i> Generate Report EXCEL</button>
							</div>
                        </div>
						<script type="text/javascript">
							
							
								$('#OrderData').validate({
									rules: {
										"CompanyCode":{
											required: true
										},
										"locationCode[]":{
											required: true
										},
										"DateRange":{
											required: true
										},
										"reportType":{
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
									},
									submitHandler: function(form) {
										$('#responseData').empty().html('<img src="<?=base_url('adminlte/dist/img/uploading.gif')?>" class="img-responsive progress">');
										$.ajax({											
											url: '<?=base_url('orderentryreports/genErpInvoiceData')?>',
											type: 'POST',
											data: $(form).serialize(),
											success: function(response) {
												//alert(response);
												$('#responseData').empty().html(response);
											}            
										});
									}
								});
							
							
						</script>
                    </form>
                </div>
                <div class="col-md-12" id="responseData">
                    
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->