<!-- My Error Messages -->
<link href="<?= base_url('adminlte/custom.css') ?>" rel="stylesheet" type="text/css" />
<!-- colorbox -->
<link rel="stylesheet" type="text/css" href="<?= base_url('adminlte/plugins/lakshitha/colorbox/colorbox.css') ?>" />
<div id="colorbox" class="" role="dialog" tabindex="-1" > <div style="clear: left;"> 
        <div id="cboxContent" style="width: 900px; overflow-y: scroll; height: 633px;">
            <div id="cboxLoadedContent" style="width: 900px; overflow: auto; height: 633px;">
                <?php
                if (!empty($invDataH) && isset($invDataH)) {
                    $freeLines = '';
                    $grLines = '';
                    $grFreeLines = '';
                    $mrLines = '';
                    $mrFreeLines = '';
                    $specialdiscount = 0;
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
                                            <tbody><tr><td class="sub-table-title">Service Job</td>
                                                </tr></tbody></table>

                                        <table class="sub-table-grey" style="width:820px;">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 100px; font-weight:bold;" class="sub-table-content">Date</td>
                                                    <td style="width: 1px" class="sub-table-content">:</td>
                                                    <td class="sub-table-content"><?= $invDataH->request_date ?></td>
                                                    <td class="sub-table-content"></td>
                                                    <td style="width: 100px; font-weight:bold;" class="sub-table-content">Department</td>
                                                    <td style="width: 1px" class="sub-table-content">:</td>
                                                    <td class="sub-table-content"><?= $invDataH->name ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 100px; font-weight:bold;" class="sub-table-content">Vehicle_No</td>
                                                    <td style="width: 1px" class="sub-table-content">:</td>
                                                    <td class="sub-table-content"><?= $invDataH->vehicle_no ?></td>
                                                    <td class="sub-table-content"></td>
                            <!--            <td style="width: 100px; font-weight:bold;" class="sub-table-content">Zone Name</td>
                                                    <td style="width: 1px" class="sub-table-content">:</td>
                                                    <td class="sub-table-content">Agalawatta Baduraliya</td>-->
                                                    <td style="width: 100px; font-weight:bold;" class="sub-table-content">Driver Nic</td>
                                                    <td style="width: 1px" class="sub-table-content">:</td>
                                                    <td class="sub-table-content"><?= $invDataH->nic ?></td>

                                                </tr>
                                                 <tr>
                                                    <td style="width: 100px; font-weight:bold;" class="sub-table-content">From</td>
                                                    <td style="width: 1px" class="sub-table-content">:</td>
                                                    <td class="sub-table-content"><?= $invDataH->from_location ?></td>
                                                    <td class="sub-table-content"></td>
                                                    <td style="width: 100px; font-weight:bold;" class="sub-table-content">To</td>
                                                    <td style="width: 1px" class="sub-table-content">:</td>
                                                    <td class="sub-table-content"><?= $invDataH->to_location ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 100px; font-weight:bold;" class="sub-table-content">Start Mileage (KM)</td>
                                                    <td style="width: 1px" class="sub-table-content">:</td>
                                                    <td class="sub-table-content"><?= $invDataH->start_mileage ?></td>
                                                    <td class="sub-table-content"></td>
                                                    <td style="width: 100px; font-weight:bold;" class="sub-table-content">End Mileage (KM)</td>
                                                    <td style="width: 1px" class="sub-table-content">:</td>
                                                    <td class="sub-table-content"><?= $invDataH->end_mileage ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 100px; font-weight:bold;" class="sub-table-content">System Mileage (KM)</td>
                                                    <td style="width: 1px" class="sub-table-content">:</td>
                                                    <td class="sub-table-content"><?= $invDataH->system_mileage ?></td>
                                                    
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
                                                                                    <th width="470px">Service Name</th>
                                                                                    <th width="300px">Cost</th> 
                                                                                    <!--<th style="text-align: center;width:78px">Bundle/Qty Price (W/S Rs)</th>-->
                                                                                    <!--<th style="text-align: center;width:78px">Bundle/Qty Retail Price(Rs)</th>-->
                                                                                    
                                                                                    
                                                                                </tr>
                                                                                <?php
                                                                                if (!empty($invDataD) && isset($invDataD)) {
                                                                                    $netWithoutDis = 0;
                                                                                    $netWithDis = 0;
                                                                                    $countR = 1;
                                                                                    foreach ($invDataD as $d) {
                                                                                        
                                                                                            ?>
                                                                                            <tr id="row_1">
                                                                                                <td><?= $countR ?></td>
                                                                                                
                                                                                                <td style="text-align: right"><?= $d['service_name'] ?></td>
                                                                                                <td style="text-align: right"><?= $d['cost'] ?></td>
                                                                                                
                                                                                                
                                                                                            </tr>
                                                                                            <?php
                                                                                            
                                                                                        
                                                                                        $countR += 1;
                                                                                        

                                                                                        

                                                                                        
                                                                                    }
                                                                                }
                                                                                ?>		
                                                                            </tbody>
                                                                            <tfoot>
                                                                                <tr>
                                                                                    <td colspan="8" style="text-align: right">Total</td> 
                                                                                    
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
                                                                                        <td style=" padding: 5px;">Total Cost</td>
                                                                                        <td style=" padding: 5px;">:</td>
                                                                                        <td style=" padding: 5px;">Rs.<?=$invDataH->total_cost?></td>
                                                                            
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