<!-- My Error Messages -->
<link href="<?= base_url('adminlte/custom.css') ?>" rel="stylesheet" type="text/css" />
<!-- colorbox -->
<link rel="stylesheet" type="text/css" href="<?=base_url('adminlte/plugins/lakshitha/colorbox/colorbox.css')?>" />
<div id="colorbox" class="" role="dialog" tabindex="-1" > <div style="clear: left;"> 
<div id="cboxContent" style="width: 900px; overflow-y: scroll; height: 633px;">
<div id="cboxLoadedContent" style="width: 900px; overflow: auto; height: 633px;">
<?php 

if(!empty($invDataH) && isset($invDataH)){
$freeLines='';	
$grLines='';
$grFreeLines='';
$mrLines='';
$mrFreeLines='';
$specialdiscount=0;
?>

<table style="width:900px; height:633px">
	<tbody>
	<tr>
		<td>
			<table style="width:820px;">
			<tbody><tr align="right"><td><input type="button" id="print_inv_btn" onclick="$('#div_view_invoice').print();" value="Print" style="border-radius: 7px; "></td></tr>      
			</tbody>
			</table>
			<div id="div_view_invoice" align="center">
			<table class="sub-table" style="width:820px;">
				<tbody><tr><td class="sub-table-title">View Invoice</td>
			</tr></tbody></table>

			<?php

			foreach($invDataMain as $m){

			?>
			<table class="sub-table-grey" style="width:820px;">
                <tbody>
				<tr>
					<td style="width: 100px; font-weight:bold;" class="sub-table-content">Date</td>
					<td style="width: 1px" class="sub-table-content">:</td>
					<td class="sub-table-content"><?=$m['stock_in_date']?> </td>
					<td class="sub-table-content"></td>
					<td style="width: 100px; font-weight:bold;" class="sub-table-content">Area</td>
					<td style="width: 1px" class="sub-table-content">:</td>
					<td class="sub-table-content"><?=$m['area_name']?></td>
				</tr>
				<tr>
					<td style="width: 100px; font-weight:bold;" class="sub-table-content">Range</td>
					<td style="width: 1px" class="sub-table-content">:</td>
					<td class="sub-table-content"> <?=$m['range_name']?></td>
					<td class="sub-table-content"></td>
		<!--            <td style="width: 100px; font-weight:bold;" class="sub-table-content">Zone Name</td>
					<td style="width: 1px" class="sub-table-content">:</td>
					<td class="sub-table-content">Agalawatta Baduraliya</td>-->
					<td style="width: 100px; font-weight:bold;" class="sub-table-content">Territory</td>
					<td style="width: 1px" class="sub-table-content">:</td>
					<td class="sub-table-content"><?=$m['territory_name']?></td>
					
				</tr>
				<tr>
					<td style="width: 200px; font-weight:bold;" class="sub-table-content">Comment</td>
					<td style="width: 1px" class="sub-table-content">:</td>
					<td class="sub-table-content"> <?=$m['comments']?></td>
					<td class="sub-table-content"></td>

					
				</tr>
				</tbody>
				<?php 
			}
				?>
			</table>
			<table style="width:820px">
			<tbody>
				<tr>
				<td>
					<table style="width: 820px;" cellpadding="5" cellspacing="5">
						<tbody>
							<tr>
								<td colspan="3">
									<table width="825px" border="0" class="std-Table-view" cellpadding="0" cellspacing="0">
										<thead>
										</thead>
										<tbody>
											<tr>
												<th width="15px"></th>
												<th width="470px">Product Name</th>
												<th width="300px">Item Code</th> 
												<th style="text-align: center;width:55px">UOM</th> 
												<th style="text-align: center;width:55px">Sellable Qty</th>
												<th style="text-align: center;width:55px">Damage Qty</th>
												<th style="text-align: center;width:78px">Unit Price (Rs)</th>
												<th style="text-align: center">Amount (Rs)</th>
											</tr>
											<?php 
											if(!empty($invDataH) && isset($invDataH)){
												$subTot=0;
												$sellable=0;
												$damage=0;
												$countR=1;
												foreach($invDataH as $d){
												$subTot   = $subTot+$d['sub_total'];	
												$sellable = $sellable+($d['sellable_qty']*$d['price']);	
												$damage   = $damage+($d['damage_qty']*$d['price']);	
											?>
														<tr id="row_1">
															<td><?=$countR?></td>
															<td><?=$d['item_name']?></td>
															<td><?=$d['item_code']?></td> 
															<td style="text-align: right"><?=$d['uom']?></td>  
															<td style="text-align: right"><?=$d['sellable_qty']?></td>  
															<td style="text-align: right"><?=$d['damage_qty']?></td>  
															<td style="text-align: right"><?=number_format($d['price'],'2','.',',')?></td>
															<td style="text-align: right"><?=number_format($d['sub_total'],'2','.',',')?></td>  
															
														</tr>
														<?php 
														$countR++;
													}
												}
														 ?>
										</tbody>
										<tfoot>
											<tr>
												<td colspan="7" style="text-align: right;font-weight: bold;color: black;font-size: 13px;">Total</td> 
												<td style="text-align: right;font-weight: bold;color: black;font-size: 13px;"><?=number_format($subTot,'2','.',',')?></td>
											</tr>
										</tfoot>
									</table>
								</td>
							</tr>

						

							<tr>
								<td colspan="3">
									<table border="0">
										<thead>
											<tr>
												<td style=" padding: 5px;"></td>
												<td style=" padding: 5px;"></td>
												<td style=" padding: 5px;"></td>
											</tr>
											
											<tr>
												<td style=" padding: 5px;">Sellable Qty Value</td>
												<td style=" padding: 5px;">:<font style="font-size: 13px"> Rs. </font></td>
												<td style=" padding: 5px;"><input disabled="disabled" id="invoice_discount_amount" name="invoice_discount_amount" style="text-align: right" type="text" value="<?=number_format($sellable,'2','.',',')?>"></td>
											</tr>             
											   
											<tr>
												<td style=" padding: 5px;">Damage Qty Value</td>
												<td style=" padding: 5px;">:<font style="font-size: 13px"> Rs. </font></td>
												<td style=" padding: 5px;"><input disabled="disabled" id="invoice_discount_amount" name="invoice_discount_amount" style="text-align: right" type="text" value="<?=number_format($damage,'2','.',',')?>"></td>
											</tr> 
											 <tr>
												<td style=" padding: 5px;">Net Total</td>
												<td style=" padding: 5px;">: <font style="font-size: 13px"> Rs. </font></td>
												<td style=" padding: 5px;"><input disabled="disabled" id="sub_total_amount" name="invoice_return_total_amount" style="text-align: right" type="text" value="<?=number_format($subTot,'2','.',',')?>">
												</td>
												
											</tr>
											   
											
											
											<!--
											<tr>
												<td colspan="3" style=" padding: 5px;">
													<table class="CSSTableGenerator" style="width: 100%; background-color: #F5F5F5">
														<thead>
															<tr id="CSSTableGenerator_title">
																<th colspan="6"> Payment Details </th>
															</tr>
															<tr>
																<th> Payment Type </th>
																<th> Payment Date </th>
																<th> Amount (Rs)  </th>
																<th> Cheque Date  </th>
																<th> Cheque No    </th>
																<th> Cheque Amount (Rs)</th>
															</tr>
														</thead>
														<tbody>
																								<tr>
																	<td colspan="3"> <span class="error"> No Payments Found ! </span> </td>
																</tr>
														</tbody>
													</table>

												</td>
											</tr>
											<tr>
												<td style=" padding: 5px;">Paid Amount</td>
												<td style=" padding: 5px;">:</td>
												<td style=" padding: 5px;">Rs.0.00</td>
											</tr>
											<tr>
												<td style=" padding: 5px;">Balance to be Paid</td>
												<td style=" padding: 5px;">:</td>
												<td style=" padding: 5px;">Rs.40,749.25</td>
										    
											</tr>
											-->
										</thead>
										<tbody style="background-color: #F1F1F1; padding: 5px;">

										</tbody>
									</table>
								</td>
							</tr>

						</tbody>
					</table>
				</td>
				</tr>
			</tbody>
			</table>
			</div>
		</td>
	</tr>
	</tbody>
</table>
<?php 
}
?>
</div>
</div>
</div>