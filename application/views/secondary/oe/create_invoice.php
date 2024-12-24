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
				<tbody><tr><td class="sub-table-title">Convert to Actual</td>
			</tr></tbody></table>

			<table class="sub-table-grey" style="width:820px;">
                <tbody>
				<tr>
					<td style="width: 100px; font-weight:bold;" class="sub-table-content">Date</td>
					<td style="width: 1px" class="sub-table-content">:</td>
					<td class="sub-table-content"><?=$invDataH->inv_date?></td>
					<td class="sub-table-content"></td>
					<td style="width: 100px; font-weight:bold;" class="sub-table-content">Time</td>
					<td style="width: 1px" class="sub-table-content">:</td>
					<td class="sub-table-content"><?=$invDataH->inv_time?></td>
				</tr>
				<tr>
					<td style="width: 100px; font-weight:bold;" class="sub-table-content">Outlet Name</td>
					<td style="width: 1px" class="sub-table-content">:</td>
					<td class="sub-table-content"><?=$invDataH->bill_name?></td>
					<td class="sub-table-content"></td>
		<!--            <td style="width: 100px; font-weight:bold;" class="sub-table-content">Zone Name</td>
					<td style="width: 1px" class="sub-table-content">:</td>
					<td class="sub-table-content">Agalawatta Baduraliya</td>-->
					<td style="width: 100px; font-weight:bold;" class="sub-table-content">Invoice ID</td>
					<td style="width: 1px" class="sub-table-content">:</td>
					<td class="sub-table-content"><?=$invDataH->app_inv_no?></td>
					
				</tr>
				</tbody>
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
												<th width="300px">Code</th>  												 
												<th style="text-align: center;width:55px">UOM</th> 
												<th style="text-align: center;width:78px">Unit Price (Rs)</th>
												<th style="text-align: center;width:55px">B_Qty</th>
												<th style="text-align: center;width:63px">Line Dis.%</th>
												<th style="text-align: center;width:55px">Cancel Qty</th>
												<th style="text-align: center;width:55px">Free Qty</th>
												<th style="text-align: center;width:55px">Gr Qty</th>
												<th style="text-align: center;width:55px">Gr Free Qty</th>
												<th style="text-align: center;width:55px">Mr Qty</th>
												<th style="text-align: center;width:55px">Mr Free Qty</th> 
												<th style="text-align: center">Actual Qty</th>
												<th style="text-align: center">Discounted Amount (Rs)</th>
											</tr>
											<?php 
											$countR=1;
											foreach($itemList as $i){
												$b_qty='';
												$dis_per='';
												$f_qty='';
												$g_qty='';
												$gf_qty='';
												$m_qty='';
												$mf_qty='';
												$actual_qty='';
												$actual_value='';
												if(!empty($invDataD) && isset($invDataD)){
													$netWithoutDis=0;
													$netWithDis=0;
													foreach($invDataD as $d){
														$netWithoutDis=$netWithoutDis+$d['adjusted_unit_price']*$d['booking_qty'];
														$netWithDis=$d['d_subtotal']+($d['special_discount']*$d['booking_qty'])+($d['gr_qty']*$d['gr_price'])+($d['mr_qty']*$d['mr_price'])+$netWithDis;
														
														if(($d['item_code']==$i['item']) && ($d['booking_qty']>0 || $d['fr_qty'] || $d['gr_qty'] || $d['mr_qty'])){
															$b_qty=$d['booking_qty'];
															$dis_per=$d['dis_per'];
															$f_qty=$d['fr_qty'];
															$g_qty=$d['gr_qty'];
															$gf_qty=$d['gr_free_qty'];
															$m_qty=$d['mr_qty'];
															$mf_qty=$d['mr_free_qty'];
															$actual_qty=$d['actual_qty'];
															$actual_value=$d['subtotal'];
														}
													}
												}
											?>
												<tr>
													<th width="15px"><?=$countR?><input type="hidden" name="item[code][]" value="<?=$i['item']?>"></th>
													<th width="470px"><input type="hidden" name="item[<?=$i['item']?>][name]" value="<?=$i['description']?>"><?=$i['description']?></th>
													<th width="300px"><?=$i['item']?></th>  
													<th style="text-align: center;width:55px"><input style="text-align: center;width:55px" type="hidden" name="item[<?=$i['item']?>][name]" value="<?=$i['uom']?>"><?=$i['uom']?></th> 
													<th style="text-align: center;width:78px"><select style="text-align: center;width:55px"  name="item[<?=$i['item']?>][price]"></select></th>											 
													<th style="text-align: center;width:55px"><input style="text-align: center;width:55px" type="text" readonly name="item[<?=$i['item']?>][b_qty]" value="<?=$b_qty?>"></th>
													<th style="text-align: center;width:63px"><input style="text-align: center;width:55px" type="text" name="item[<?=$i['item']?>][line_dis]" value="<?=$dis_per?>"></th>
													<th style="text-align: center;width:55px"><input style="text-align: center;width:55px" type="text" name="item[<?=$i['item']?>][c_qty]" value=""></th>
													<th style="text-align: center;width:55px"><input style="text-align: center;width:55px" type="text" name="item[<?=$i['item']?>][f_qty]" value="<?=$f_qty?>"></th>
													<th style="text-align: center;width:55px"><input style="text-align: center;width:55px" type="text" name="item[<?=$i['item']?>][g_qty]" value="<?=$g_qty?>"></th>
													<th style="text-align: center;width:55px"><input style="text-align: center;width:55px" type="text" name="item[<?=$i['item']?>][gf_qty]" value="<?=$gf_qty?>"></th>
													<th style="text-align: center;width:55px"><input style="text-align: center;width:55px" type="text" name="item[<?=$i['item']?>][m_qty]" value="<?=$m_qty?>"></th>
													<th style="text-align: center;width:55px"><input style="text-align: center;width:55px" type="text" name="item[<?=$i['item']?>][mf_qty]" value="<?=$mf_qty?>"></th> 
													<th style="text-align: center"><input type="text" style="text-align: center;width:55px" name="item[<?=$i['item']?>][a_qty]" value="<?=$actual_qty?>"></th>
													<th style="text-align: center"><input type="text" style="text-align: center;width:55px" name="item[<?=$i['item']?>][subtoal]" value="<?=$actual_value?>"></th>
												</tr>
											<?php 
											$countR+=1;
											} 
											?>		
										</tbody>
										<tfoot>
											<tr>
												<td colspan="8" style="text-align: right">Total</td> 
												<td style="text-align: right"><?=$netWithoutDis?></td>
												<td style="text-align: right"><?=$netWithDis?></td>
											</tr>
										</tfoot>
									</table>
								</td>
							</tr>

							<?php
							if($freeLines!=''){
							?>
							<tr>
								<td colspan="3" id="free_issue">  
		<!--                            <input id="tbl_row_count" value="1" type="hidden" />-->
									<table style="width:100%; border: 1px solid #D1D1D1;" width="100%" border="0" cellpadding="5" cellspacing="5">
										<thead>
											<tr>
												<th style="text-align: left; width: 800px" class="sub-table-title">Free Issues</th>
											</tr>
										</thead>
										<tbody>
										<tr>
											<td>
												<table width="800px" border="0" class="std-Table-view" cellpadding="0" cellspacing="0" id="tbl_free_issue">
													<thead>
													</thead>
													<tbody>
														<tr>
															<th width="470px">Product Name</th>
															<th width="200px">Item Code</th>
															<th width="78px">Price (Rs)</th>
															<th width="55px">Units</th>
															<th>Amount (Rs)</th>
														</tr>
														
														<?=$freeLines?>
											
													</tbody>
												</table>
											</td>
										</tr>
										</tbody>
									</table>
								</td>
							</tr>
							<?php
							}
							?>
			
							<?php
							if($grLines!=''){
							?>
							<tr>
								<td colspan="3" id="free_issue">  
		<!--                            <input id="tbl_row_count" value="1" type="hidden" />-->
									<table style="width:100%; border: 1px solid #D1D1D1;" width="100%" border="0" cellpadding="5" cellspacing="5">
										<thead>
											<tr>
												<th style="text-align: left; width: 800px" class="sub-table-title">Good Returns</th>
											</tr>
										</thead>
										<tbody>
										<tr>
											<td>
												<table width="800px" border="0" class="std-Table-view" cellpadding="0" cellspacing="0" id="tbl_free_issue">
													<thead>
													</thead>
													<tbody>
														<tr>
															<th width="470px">Product Name</th>
															<th width="200px">Item Code</th>
															<th width="78px">Price (Rs)</th>
															<th width="55px">Units</th>
															<th>Amount (Rs)</th>
														</tr>
														
														<?=$grLines?>
											
													</tbody>
												</table>
											</td>
										</tr>
										</tbody>
									</table>
								</td>
							</tr>
							<?php
							}
							?>
							
							
							<?php
							if($mrLines!=''){
							?>
							<tr>
								<td colspan="3" id="free_issue">  
		<!--                            <input id="tbl_row_count" value="1" type="hidden" />-->
									<table style="width:100%; border: 1px solid #D1D1D1;" width="100%" border="0" cellpadding="5" cellspacing="5">
										<thead>
											<tr>
												<th style="text-align: left; width: 800px" class="sub-table-title">Market Returns</th>
											</tr>
										</thead>
										<tbody>
										<tr>
											<td>
												<table width="800px" border="0" class="std-Table-view" cellpadding="0" cellspacing="0" id="tbl_free_issue">
													<thead>
													</thead>
													<tbody>
														<tr>
															<th width="470px">Product Name</th>
															<th width="200px">Item Code</th>
															<th width="78px">Price (Rs)</th>
															<th width="55px">Units</th>
															<th>Amount (Rs)</th>
														</tr>
														
														<?=$mrLines?>
											
													</tbody>
												</table>
											</td>
										</tr>
										</tbody>
									</table>
								</td>
							</tr>
							<?php
							}
							?>
							

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
												<td style=" padding: 5px;">Sub Total</td>
												<td style=" padding: 5px;">: <font style="font-size: 13px"> Rs. </font></td>
												<td style=" padding: 5px;"><input disabled="disabled" id="sub_total_amount" name="invoice_return_total_amount" style="text-align: right" type="text" value="<?=($invDataH->subtotal)+($invDataH->header_gr_value+$invDataH->header_mr_value)?>">
												</td>
												<!-- <?=($invDataH->subtotal)+(/*$invDataH->total_discount_value)+*/($invDataH->header_gr_value+$invDataH->header_mr_value))?>">-->
												<!--<td style=" padding: 5px;"><input disabled="disabled" id="sub_total_amount" name="invoice_return_total_amount" style="text-align: right" type="text" value="40,749.25" /></td>-->
										   <!--number_format(($tot_amount - (($ret_amount - $rep_amount) + $emp_amount + $discount)), 2, ".", ",");-->
											</tr>
											   
											<tr>
												<td style=" padding: 5px;">Special Discount</td>
												<td style=" padding: 5px;">:<font style="font-size: 13px"> Rs. </font></td>
												<td style=" padding: 5px;"><input disabled="disabled" id="invoice_discount_amount" name="invoice_discount_amount" style="text-align: right" type="text" value="<?=$specialdiscount?>"></td>
											</tr>             
											   
											<tr>
												<td style=" padding: 5px;">Header Discount (<?=$invDataH->header_discount?>%)</td>
												<td style=" padding: 5px;">:<font style="font-size: 13px"> Rs. </font></td>
												<td style=" padding: 5px;"><input disabled="disabled" id="invoice_discount_amount" name="invoice_discount_amount" style="text-align: right" type="text" value="<?=$invDataH->header_discount_value?>"></td>
											</tr> 							  
											<tr>
												<td style=" padding: 5px;">Total Discount </td>
												<td style=" padding: 5px;">: <font style="font-size: 13px"> Rs. </font></td>
												<td style=" padding: 5px;"><input disabled="disabled" id="invoice_discount_amount" name="invoice_discount_amount" style="text-align: right" type="text" value="<?=$invDataH->total_discount_value?>"></td>
											</tr>
											
										   
											<tr>
												<td style=" padding: 5px;">Market Return / Good Return Value </td>
												<td style=" padding: 5px;">:<font style="font-size: 13px"> Rs. </font></td>
												<td style=" padding: 5px;"><input disabled="disabled" id="invoice_return_total_amount" name="invoice_return_total_amount" style="text-align: right" type="text" value="<?=($invDataH->header_gr_value+$invDataH->header_mr_value)?>"></td>
											</tr>
							<!--                <tr>
												<td style=" padding: 5px;">Empty Items total Amount</td>
												<td style=" padding: 5px;">:</td>
												<td style=" padding: 5px;"><input disabled="disabled" id="invoice_empty_total_amount" name="invoice_empty_total_amount" style="text-align: right" type="text" value="0.00" /></td>
											</tr>-->
										   
											<tr>
												<td style=" padding: 5px;">Net Total</td>
												<td style=" padding: 5px; ">: <font style="font-size: 13px"> Rs. </font></td>
												<td style=" padding: 5px;"><input disabled="disabled" id="invoice_total_amount" name="invoice_total_amount" style="text-align: right" type="text" value="<?=$invDataH->header_net_value?>"></td>
												<!--<td style=" padding: 5px;"><input disabled="disabled" id="invoice_total_amount" name="invoice_total_amount" style="text-align: right" type="text" value="42,525.00" /></td>-->
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