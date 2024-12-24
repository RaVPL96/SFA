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
            Cheque Payment Report
            <small>C/B Reports</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Cashbook Module</li>
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
                    <form class="form-horizontal" id="OrderData" action="<?= base_url('cashbook/getAdvancePay') ?>" method="post">
                        <div class="form-group">
							<label class="col-md-12 label label-default"> - මිලදී ගැනීමේ ඇනවුමක් සදහා වන පූර්ව චෙක්පත් ගෙවීම් වාර්ථාව </label>
							<label class="col-md-12 label label-default"> - Advance payment data for payments</label>
							<label class="col-md-12 label label-default"> - අනිවාර්යයෙන් පිරවිය යුතු කොටස් තරු (<span class="text-red">*</span>) ලකුණින් ඇත.</label>
						<div class="clearfix"></div>
						<br>
						<label class="col-md-2">Company <span class="text-red">*</span></label>
							<div class="col-md-6">
								<select id="CompanyCode" name="rptData[CompanyCode]" class="form-control selectpicker" data-show-subtext="true" data-live-search="true"  onchange="setTextField(this)">
									<?php									
									if(!empty($location) && isset($location)){
										foreach ($location as $loc){
											echo '<option value="'.$loc['code'].'" data-subtext="' . $loc['code']. '">'.$loc['name'].'</option>';
										}
									}
									?>
									<!-- <option data-subtext="Rep California" disabled="disabled">Marvin Martinez</option>  https://codepen.io/Rio517/pen/NPLbpP -->
								</select><br>
								<span class="help-inline">Type <code>Company Name</code>. If Not Listed add Company name and code to RMIS DB. Contact System Developer Lakshitha 0771061772</span>								
							</div>
						</div>
						<!-- Date range -->
						<div class="form-group">
							<label class="col-md-2">PO Number<span class="text-red">*</span></label>
							<div class="col-md-6">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-cube"></i>
									</div>
									<input type="text" name="rptData[ponumber]" class="form-control pull-right" />
								</div><!-- /.input group -->
							</div><!-- /.form group -->	
						</div>
						<!-- Date range -->
						<div class="form-group">
							<label class="col-md-2">Date Range <span class="text-red">*</span></label>
							<div class="col-md-6">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" name="rptData[DateRange]" class="form-control pull-right" readonly id="reservation"/>
								</div><!-- /.input group -->
							</div><!-- /.form group -->	
						</div>
						<!-- Date range -->
						<div class="form-group">
							<div class="col-md-6">
								<div class="input-group">
									<input type="submit" name="GetData" class="form-control pull-right" value="Get Report"/>
								</div><!-- /.input group -->
							</div><!-- /.form group -->	
						</div>
                    </form>
                </div>
                <div class="col-md-12" id="responseData">
                    <?php 
					if(!empty($data['POResult']) && isset($data['POResult'])){
						$result=$data['POResult'];
						while ($row = $result->fetch()) {
							echo $productName= $row["Batch ID"] .'<br>';
						}
					}
					?>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->
<script type="text/javascript">
/*
							function setTextField(ddl) {
								document.getElementById('CompanyName').value = ddl.options[ddl.selectedIndex].text;
							}
							
								$('#OrderData').validate({
									rules: {
										"DateRange":{
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
											url: '<?=base_url('glreports/generateJournalEntryRpt')?>',
											type: 'POST',
											data: $(form).serialize(),
											success: function(response) {
												//alert(response);
												$('#responseData').empty().html(response);
											}            
										});
									}
								});
							
							*/
						</script>