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
            Secondary Sales Order Entry
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
                <div class="col-md-12">
                        <div class="form-group">
							<label class="col-md-12 label label-default"> - ඇණවුම් ඉල්ලීම්  </label>
							<label class="col-md-12 label label-default"> - Orders</label>
							<label class="col-md-12 label label-default"> - අනිවාර්යයෙන් පිරවිය යුතු කොටස් තරු (<span class="text-red">*</span>) ලකුණින් ඇත.</label>
						<div class="clearfix"></div>
						<br>
						</div>
						<form class="form-horizontal" id="" action="<?= base_url('salesoetransaction/stockEntry') ?>" method="post">

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
										<input type="text" name="requestDate" class="form-control pull-right" value="<?=date('Y-m-d')?>" readonly id="datepicker"/>
									</div><!-- /.input group -->
								</div><!-- /.form group -->	
							</div>
						</div>
						<div class="col-lg-12">&nbsp;</div>

						<div class="col-md-12">
                        <div class="form-group">
                            <input type="submit" class="btn btn-danger" name="submit" value="Get Items">
                        </div>                                
                    </div>
								</form>
								<div class="col-md-6">
									<form class="form-horizontal" id="" action="<?= base_url('salesoetransaction/Orderentry') ?>" method="post">

							<input type="hidden" value="<?php if(isset($rangeId)){ echo $rangeId; }  ?>" name="rangeId"/>		
							<input type="hidden" value="<?php if(isset($areaID)){ echo $areaID; }  ?>" name="areaId"/>			
							<input type="hidden" value="<?php if(isset($territoryID)){ echo $territoryID; } ?>" name="territoryId"/>
		<input type="hidden" value="<?php  if(isset($requestDate)){ echo $requestDate;} ?>" name="requestDate"/>			
									<!-- <div class="form-group">
										<select <?php 
										//$oplid=''; 
										// if($oplid!=''){echo 'disabled="disabled" '; }?> class="form-control" id="Operation" name="sop[sopid]">
										// 	<option value="">--Select Sales Operation--</option>
										// 	<?php
										// 	if(!empty($OpData) && isset($OpData)){
										// 		foreach($OpData as $op){
										// 			$select='';
										// 			if($oplid==$op['id']){
										// 				$select='selected="selected"';
										// 			}
										// 			echo '<option '.$select.' value="'.$op['id'].'">'.$op['name'].'</option>';
										// 		}
										// 	}
											?>
										</select>
										<?php// if($oplid!=''){echo '<input type="hidden" name="sop[sopid]" class="form-control" value="'.$oplid.'">';}?>
									</div> -->
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
									<!-- <div class="form-group" id="loadCustomerBtn">
										<button type="submit" value="1" name="btnLoadCustomers" class="btn btn-md btn-warning float-right"><i class="fa fa-arrow-down fa-2x" aria-hidden="true"></i> Load Customers</button>
									</div> -->
									</form>
								
								</div>
						<!-- <div class="clearfix"></div> -->
						
							<?php
							
							if(10<$dataSet){
								?>
<form class="form-horizontal" id="OrderData" action="<?= base_url('salesoetransaction/SaveOrderentry') ?>" method="post">	
						<input type="hidden" name="rangeId" value="<?php if(isset($rangeId)){ echo $rangeId; }  ?>">	
						<input type="hidden" name="areaID" value="<?php if(isset($areaID)){ echo $areaID; }?>">	
						<input type="hidden" name="territoryID" value="<?php if(isset($territoryID)){ echo $territoryID; } ?>">	
						<input type="hidden" name="requestDate" value="<?php if(isset($requestDate)){ echo $requestDate; } ?>">	
						<div class="col-md-12" style="width: 100%;   overflow-x: scroll;">
						<?php
						$estimateNet =0;
						?>
                            <table class="table table-bordered table-hover" style="overflow-x: scroll;clear:both;table-layout: fixed;width: 1300px; " >
								<tr style="width: 100px;">
                                    <th style="width: 100px;">#</th>
                                    <th style="width: 100px;">Item Code</th>
                                    <th style="width: 160px;">Item Name</th>
                                    <th style="width: 100px;">Unit</th>
                                    <th style="width: 140px;">Sellable Qty</th>
                                    <th style="width: 140px;">Damage Qty</th>
                                    <th style="width: 140px;">Price</th>
									<th style="width: 100%;">Sub Total</th>
                                </tr>
								
                                <tbody id="appendhere">  							
									<?php
									$count = 0;
                                    $btnText = 'Create Estimate';
                                    if (!empty($estimated) && isset($estimated)) {
                                        $btnText = 'Update Estimate';
                                        foreach ($estimated as $line) {
                                            $count = $line['id'];
                                            $pcode = $line['part_code'];
                                            $pid = $line['part_id'];
                                            $ptype = $line['part_type'];
                                            $pname = $line['part_name'];
                                            $pqty = $line['qty'];
                                            $pprice = $line['price'];
                                            $psubtot = $line['subtot'];

                                            $partBtn = 'info';
                                            $partFunc = '';
                                            if ($ptype == 'part') {
												$partBtn = 'info';
												$partFunc = 'openPartList';
											} elseif ($ptype == 'service') {
												$partBtn = 'warning';
												$partFunc = 'openServiceList';
											}
								?>
									<tr id="line<?= $count ?>">
                                        <td class="col-md-1"><input type="checkbox" name="estimateline" id="estimate<?= $count ?>" value="line<?= $count ?>"><input type="hidden" name="rowid[]" id="rowid" value="<?= $count ?>"></td>
                                        <td class="col-md-3">
                                            <div class="input-group ">
                                                <input class="form-control" type="text" name="estimatepartcode[]" readonly="readonly" id="estimatepartcode<?= $count ?>" value="<?= $pcode ?>">
                                                <span class="input-group-btn">
                                                <button class="btn btn-info btn-flat" type="button" onclick="<?= $partFunc ?>('<?= $count ?>');"><i class="fa fa-plus"></i></button>
                                                </span>
                                            </div>
                                            <input class="form-control" type="hidden" name="estimatepartid[]" id="estimatepartid<?= $count ?>" value="<?= $pid ?>">
                                            <input class="form-control" type="hidden" name="estimateparttype[]" id="estimateparttype<?= $count ?>" value="<?= $ptype ?>">
                                        </td>
                                        <td class="col-md-3"><input class="form-control" name="estimatepartname[]" id="estimatepartname<?= $count ?>" type="text" readonly="readonly" value="<?= $pname ?>"></td>
                                        <!-- <td class="col-md-2"><div class="col-md-12"><input class="form-control text-right" type="text" name="estimatepartpriceUnit[]" id="estimatepartpriceUnit<?= $count ?>" value="<?= $pprice ?>" readonly="readonly"></div></td> -->
                                        <!-- <td class="col-md-2"><div class="col-md-12"><input class="form-control text-right" name="estimatepartqty[]" id="estimatepartqty<?= $count ?>" type="text" value="<?= $pqty ?>"></div></td>
                                        <td class="col-md-2"><div class="col-md-12"><input class="form-control text-right" type="text" name="estimatepartprice[]" id="estimatepartprice<?= $count ?>" value="<?= $pprice ?>" readonly="readonly"></div></td>
                                        <td class="col-md-2"><div class="col-md-12"><input class="form-control text-right" type="text" name="estimatepartsubtotal[]" id="estimatepartsubtotal<?= $count ?>" readonly="readonly" value="<?= $psubtot ?>"></div></td>
                                     -->
									</tr>									
								<?php
                                        }

                                    } else {
                                ?>
                                    <tr id="line1">
                                        <td class=""><input type="checkbox" name="estimateline" id="estimate1" value="line1"><input type="hidden" name="rowid[]" id="rowid" value="1"></td>
                                        <td>
                                            <div class="input-group ">
                                                <input class="form-control" type="text" name="estimatepartcode[]" readonly="readonly" id="estimatepartcode1">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-info btn-flat" type="button" onclick="openItemList('1');"><i class="fa fa-plus"></i></button>
                                                </span>
                                            </div>
                                            <input class="form-control" type="hidden" name="estimatepartid[]" id="estimatepartid1">
                                            <input class="form-control" type="hidden" name="estimatepartPriceCode[]" id="estimatepartPriceCode1" value="part">
										</td>
										<td><input class="form-control" name="estimatepartname[]" id="estimatepartname1" type="text" readonly="readonly"></td>
										<td><input class="form-control text-center" type="text" name="estimatepartpriceUnit[]" id="estimatepartpriceUnit1" value="" readonly="readonly" style="width: 100%;"></td>
										<td><input class="form-control text-right" name="estimatepartqty[]" id="estimatepartqty1" onkeyup="setSubTot(1)" type="text" style="width: 100%;" ></td>
										<td><input class="form-control text-right" name="estimatedamageqty[]" id="estimatedamageqty1" onkeyup="setSubTot(1)" type="text" style="width: 100%;" ></td>
										<td><input class="form-control text-right" type="text" name="estimatepartprice[]" id="estimatepartprice1" value="0.00" readonly="readonly" style="width: 100%;"></td>
                                        <!-- <td class="col-md-3"><div class="col-md-12"><input class="form-control text-right" type="text" name="estimatequantity[]" id="estimatequantity1" value="" ></div></td> -->
                                        <td><input class="form-control text-right" type="text" name="estimatepartsubtotal[]" id="estimatepartsubtotal1" value="0.00" readonly="readonly"></td>
                                    </tr>
									
                                <?php 
									}
                                ?>
									
								</tbody>
								<tbody>
									<?php 
									$x=1;
									
								if(!empty($itemPriceList) && isset($itemPriceList)){
									?>
								<tr style="background-color: #b6ead6;">
										<td colspan="9">
											<a href="#" onclick="addItem();
                                                        return false;" class="btn btn-sm col-md-2 btn-info"><i class="fa fa-wrench"></i> Add Item</a> 
                                               <a href="#" onclick="deleteItem();
                                                        return false;" class="btn btn-sm col-md-2 btn-danger"><i class="fa fa-trash-o"></i> Delete</a>
                                                <div class="clearfix"></div>   
										</td>
									</tr>
									<?php
									foreach($itemPriceList as $items){
										?>
									<tr>
									<td style="text-align: center;"><span><?php echo $x ?></span><input type="hidden" name="rowid[]" id="rowid" value="1"></td>
		
												<td><input type="hidden" value="<?php echo$items['item'] ?>" name="itemCode<?php echo $x; ?>" id="itemCode<?php echo $x; ?>" /><input type="hidden" value="<?php echo$items['des'] ?>" name="itemDes<?php echo $x; ?>" id="itemDes<?php echo $x; ?>" /><input type="hidden" value="<?php echo$items['uom'] ?>" name="itemUom<?php echo $x; ?>" id="itemUom<?php echo $x; ?>" /><?php echo $items['item'] ?></td>
												<td><?php echo $items['des'] ?></td>
												<td><?php echo $items['uom'] ?></td>
												<td><input class="form-control text-right" type="text" id="sellableQty<?php echo $x; ?>" name="sellableQty<?php echo $x; ?>" onkeyup="checkSubTot(<?php echo $x; ?>);"/></td>
												<td><input class="form-control text-right" type="text" id="damageQty<?php echo $x; ?>" name="damageQty<?php echo $x; ?>" onkeyup="checkSubTot(<?php echo $x; ?>);"/></td>
												<td style="text-align:right"><input class="form-control text-right" type="text" value="<?php echo $items['unit_price'] ?>" readonly id="unitPrice<?php echo $x; ?>" name="unitPrice<?php echo $x; ?>"/></td>
												<!-- <td><input type="text"/></td> -->
												<td><input class="form-control text-right" type="text" id="subTotal<?php echo $x; ?>" name="subTotal<?php echo $x; ?>" value="0.00" readonly="readonly"/></td>
											</tr>
										<?php
									$x++;
									}
								}
							
									?>
									<input type="hidden" value="<?php echo $x; ?>" id="rowCount" name="rowCount"/>
								</tbody>
                                <tfoot>
								<!-- <tr>
										<td colspan="6">
											<a href="#" onclick="addItem();
                                                        return false;" class="btn btn-sm col-md-2 btn-info"><i class="fa fa-wrench"></i> Add Item</a> 
                                               <a href="#" onclick="deleteItem();
                                                        return false;" class="btn btn-sm col-md-2 btn-danger"><i class="fa fa-trash-o"></i> Delete</a>
                                                <div class="clearfix"></div>   
										</td>
									</tr> -->
									<tr>
										<th colspan="7"><b class="pull-right">Net Total</b></th>
										<th class="col-md-2"><div class="col-md-12"><input class="form-control text-right" type="hidden" name="estimatecourier" id="estimatecourier"  value="0.00"/><input class="form-control text-right" type="text" name="estimatenet" id="estimatenet" readonly="readonly" value="<?= $estimateNet ?>"/></div> </th>
									</tr>
									<tr style="display: none;">
										<th colspan="7"><b class="pull-right">Payments</b></th>
										<th class="col-md-2"><div class="col-md-12"><input class="form-control text-right pull-right" type="text" name="estimatePayment" id="estimatePayment"  value="0.00"/></div></th>
									</tr>
									<tr style="display: none;">
										<th colspan="7"><b class="pull-right">Balance</b></th>
										<th class="col-md-2"><div class="col-md-12"><input class="form-control text-right pull-right" type="text" readonly name="estimateBalance" id="estimateBalance"  value="0.00"/></div></th>
									</tr>
								</tfoot>
                            </table>
						</div>
																	
						<?php
                                                        $sees = $this->session->userdata('User');
                                                        $user = $sess['username'];
                                                        $date = date('Y-m-d g:i a');
														$estimateAssest='';
                        ?>
                        <div class="col-md-12">
                            <div class="form-group col-md-8">
                                <label class="col-md-3">Receipt Created By</label>
                                <div class="col-md-4">
								<input type="text" class="form-control col-md-4" readonly name="estimateby" value="<?= $user ?>">
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-8">
                                                                <label class="col-md-3">Comments</label>
                                                                <div class="col-md-5">
                                                                    <textarea class="form-control col-md-12" name="estassestment" value=""><?= $estimateAssest ?></textarea>
                                                                </div>
                                                            </div>
                                                            
						<div class="form-group">
						
							<div class="col-md-12">
							<div class="" id="responseData"></div>
							<input id="CompanyName" type="hidden" value="" name="CompanyName" />
							<!-- <button type="submit" value="1" name="GenerateReport" class="btn btn-sm btn-default float-right"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Cancel</button> -->
							<button type="submit" value="2" name="GenerateReport" class="btn btn-sm btn-success float-right"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Save</button>
							</div>
                        </div>
						
                    </form>
								<?php
							}
							?>
                </div>
                 <div class="col-md-12" id="">

                	<!-- <span>sssssssssssssssss</span> -->
                    <?php /* if(!empty($Orders) && isset($Orders)){
						?>
<table id="example1" class="table table-hover">
	<thead>
		<tr>
			<th>Operation</th>
			<th>Area</th>
			<th>Territory</th>
			<th>Route</th>
			<th>Customer</th>
			<th>Mobile</th>
			<th>Date</th>
			<th>Entered By</th>
			<th>Order Amount</th>
			<th>Approved Amount</th>
			<th>Status</th>
			<th>Approved By</th>			
		</tr>	
	</thead>
	<tbody>
		<?php

		foreach($Orders as $ord){ 
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
			<td><?=$ord['opration_name']?></td>
			<td><?=$ord['area_name']?></td>
			<td><?=$ord['territory_name']?></td>
			<td><?=$ord['route_code'].' - '.$ord['route']?></td>
			<td><?=$ord['cus_name']?></td>
			<td><?=$ord['mobile']?></td>
			<td><?=$ord['order_date']?></td>
			<td><?=$ord['audit_user']?></td>
			<td><?=$ord['net_amount']?></td>
			<td><?=$ord['approved_amount']?></td>
			<td><?=$status?></td>
			<td><?=$ord['approved_by']?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>						
						<?php
					}*/?>
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