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
            Debtors List Report - ASE Wise(Direct Sales)
            <small>A/R Transaction Reports</small>
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
                    <form class="form-horizontal" id="debtorData" action="<?= base_url('artransaction/debtorsReportAse') ?>" method="post">
                        
							<label class="col-md-12 label label-default"> - ණයගැති ලැයිස්තු වාර්ථාව - ප්‍රදේශීය විකුණුම් කළමනාකරුට අදාලව - </label>
							<label class="col-md-12 label label-default"> - අනිවාර්යයෙන් පිරවිය යුතු කොටස් තරු (<span class="text-red">*</span>) ලකුණින් ඇත.</label>
						<div class="clearfix"></div>
						<br>
						<div class="form-group">
                            <label class="col-md-2">ASE Name  <span class="text-red">*</span></label>
							<div class="col-md-6">
							<select id="CustomerCode" name="CustomerCode" class="form-control selectpicker" data-show-subtext="true" data-live-search="true"  onchange="setTextField(this)">
                                <?php
                                if (!empty($ASEList) && isset($ASEList)) {
                                    foreach ($ASEList as $ase) {
                                        echo '<option value="' . $ase->EPF . '" data-subtext="' . $ase->EPF . '">' . $ase->Name . '</option>';
                                    }
                                }
                                ?>
                                <!-- <option data-subtext="Rep California" disabled="disabled">Marvin Martinez</option>  https://codepen.io/Rio517/pen/NPLbpP -->
                            </select><br>
                            <span class="help-inline"> Type <code>ASE Code or Name</code>. If Not Listed add ASE name and code to RMIS DB and Update Code in Accpac customer master relevant field with ASE Code.</span>
							</div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2">As At Date <span class="text-red">*</span></label>
							<div class="col-md-6">
							<input id="AsAtDate" type="text" name="AsAtDate" placeholder="As At Date Eg: 20171015" class="form-control">
							<span class="help-inline"> Eg: 20171117 </span>
							</div>
                        </div>
                        <div class="form-group">
							<label class="col-md-2"></label>
							<div class="col-md-6">
							<input id="ASEName" type="hidden" value="" name="ASEName" />
                            <button type="submit" value="1" name="GenerateReport" class="btn btn-md btn-warning float-right"><i class="fa fa-file-pdf-o fa-5x" aria-hidden="true"></i> Generate Report PDF</button>
							<button type="submit" value="2" name="GenerateReport" class="btn btn-md btn-success float-right"><i class="fa fa-file-excel-o fa-5x" aria-hidden="true"></i> Generate Report EXCEL</button>
							</div>
                        </div>
						<script type="text/javascript">
							function setTextField(ddl) {
								document.getElementById('ASEName').value = ddl.options[ddl.selectedIndex].text;
							}
							
								$('#debtorData').validate({
									rules: {
										"CustomerCode": {
											required: true
										},
										"AsAtDate": {
											required: true
										},
										"ASEName": {
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
											url: '<?=base_url('artransaction/generateDebtorReport')?>',
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
