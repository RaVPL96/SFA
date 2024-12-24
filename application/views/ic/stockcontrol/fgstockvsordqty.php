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
            FG Stock Vs Order Quantity - RM, WS, TEST, TNC
            <small>I/C Stock Control Reports</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Account Receivable Module</li>
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
                    <form class="form-horizontal" id="StockData" action="<?= base_url('#') ?>" method="post">
						<label class="col-md-12 label label-default"> -  නිමි භාණ්ඩ තොග ප්‍රමාණයන් සහ ප්‍රවාහනයට ඇති අද දින සහ දින 3ක් ඇතුලත සක්‍රියව ඇති ඇණවුම් ප්‍රමාණ වාර්ථාව</label>
						<label class="col-md-12 label label-default"> - FG Stock Level and Active Orders(within 3 days including today) Quantity Report </label>
						<div class="form-group">
							<div class="col-md-6">
							<button type="submit" value="1" name="GenerateReport" class="btn btn-md btn-warning float-right"><i class="fa fa-file-pdf-o fa-5x" aria-hidden="true"></i> Generate Report PDF</button>
							<button type="submit" value="2" name="GenerateReport" class="btn btn-md btn-success float-right"><i class="fa fa-file-excel-o fa-5x" aria-hidden="true"></i> Generate Report EXCEL</button>
							</div>
                        </div>
						<script type="text/javascript">
							
							
								$('#StockData').validate({
									rules: {
										
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
											url: '<?=base_url('icstockcontrolreports/generateStockReport')?>',
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
					<hr>
					<h3>
            FG Stock Vs Order Quantity - TNC Special Report
            <small>I/C Stock Control Reports</small>
        </h3>
					<form class="form-horizontal" id="StockDataTNC" action="<?= base_url('#') ?>" method="post">
						<label class="col-md-12 label label-default"> -  TNC නිමි භාණ්ඩ තොග ප්‍රමාණයන් සහ ප්‍රවාහනයට ඇති අද දින සහ දින XXක් ඇතුලත සක්‍රියව ඇති ඇණවුම් ප්‍රමාණ වාර්ථාව</label>
						<label class="col-md-12 label label-default"> - TNC FG Stock Level and Active Orders(within XX days including today) Quantity Report </label>
						<div class="clearfix"></div>
						<br><br>
						<div class="form-group">
							<label class="col-md-4" >Consider Active Orders Older Than in Days<br><span="small-text"> (ආපසු සලකා බැලිය යුතු සක්‍රීය ඇනවුම් දින ගණන)</span></label>
							<div class="col-md-6">
							<input type="text" value="" class="form-control " name="DaysGap" placeholder="Enter Nummber of Days Need to Concider for Orders">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6">
							<button type="submit" value="1" name="GenerateReport" class="btn btn-md btn-warning float-right"><i class="fa fa-file-pdf-o fa-5x" aria-hidden="true"></i> Generate Report PDF</button>
							<button type="submit" value="2" name="GenerateReport" class="btn btn-md btn-success float-right"><i class="fa fa-file-excel-o fa-5x" aria-hidden="true"></i> Generate Report EXCEL</button>
							</div>
                        </div>
						<script type="text/javascript">
							
							
								$('#StockDataTNC').validate({
									rules: {
									"DaysGap":{required:true}
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
											url: '<?=base_url('icstockcontrolreports/executeTNCFGStockReport')?>',
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
					
					
					
					<hr>
					<h3>
            Raw Materials Stock Quantity - TNC Special Report
            <small>I/C Stock Control Reports</small>
        </h3>
					<form class="form-horizontal" id="RMStockDataTNC" action="<?= base_url('#') ?>" method="post">
						<label class="col-md-12 label label-default"> -  TNC නිමි භාණ්ඩ තොග ප්‍රමාණයන් සහ ප්‍රවාහනයට ඇති අද දින සහ දින XXක් ඇතුලත සක්‍රියව ඇති ඇණවුම් ප්‍රමාණ වාර්ථාව</label>
						<label class="col-md-12 label label-default"> - TNC FG Stock Level and Active Orders(within XX days including today) Quantity Report </label>
						<div class="clearfix"></div>
						<br><br>
						<div class="form-group">
							<div class="col-md-6">
							<button type="submit" value="1" name="GenerateReport" class="btn btn-md btn-warning float-right"><i class="fa fa-file-pdf-o fa-5x" aria-hidden="true"></i> Generate Report PDF</button>
							<button type="submit" value="2" name="GenerateReport" class="btn btn-md btn-success float-right"><i class="fa fa-file-excel-o fa-5x" aria-hidden="true"></i> Generate Report EXCEL</button>
							</div>
                        </div>
						<script type="text/javascript">
							
							
								$('#RMStockDataTNC').validate({
									rules: {
									
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
											url: '<?=base_url('icstockcontrolreports/executeTNCRMStockReport')?>',
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
