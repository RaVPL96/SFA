<!-- My Error Messages -->
<link href="<?= base_url('adminlte/custom.css') ?>" rel="stylesheet" type="text/css" />
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
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
                                        
                                        <tbody><tr align="right"><td><input type="button" id="print_inv_btn" onclick="printDiv('div_view_invoice');return false;" value="Print" style="border-radius: 7px; "></td></tr>      
                                        </tbody>
                                    </table>
                                    <div id="div_view_invoice" align="center">
                                        <link href="<?= base_url('adminlte/custom.css') ?>" rel="stylesheet" type="text/css" />
                                        <h3 text-align: center;>Raigam Marketing Services (pvt) Ltd</h3>
                                        <h4 text-align: center;>Transport Division</h4>
                                        <!-- colorbox -->


                                        <link rel="stylesheet" type="text/css" href="<?= base_url('adminlte/plugins/lakshitha/colorbox/colorbox.css') ?>" />
                                        <table class="sub-table" style="width:820px;">
                                            <tbody><tr style=" font-size: 14px; font-weight: bold;"><td class="">Memorandum Invoice</td>
                                                </tr></tbody></table>

                                        <table class="sub-table-grey" style="width:820px;">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 100px; font-weight:bold;" class="sub-table-content">Date</td>
                                                    <td style="width: 1px" class="sub-table-content">:</td>
                                                    <td class="sub-table-content"><?= $invDataH->request_date ?> - <?= $invDataH->to_date ?></td>
                                                    <td class="sub-table-content"></td>
                                                    <td style="width: 100px; font-weight:bold;" class="sub-table-content">Service ID</td>
                                                    <td style="width: 1px" class="sub-table-content">:</td>
                                                    <td class="sub-table-content"><?= $invDataH->id ?></td>
                                                </tr>
                                                </tr>
                                                <tr>
                                                    <td style="width: 100px; font-weight:bold;" class="sub-table-content">Company Name</td>
                                                    <td style="width: 1px" class="sub-table-content">:</td>
                                                    <td class="sub-table-content"><?= $invDataH->company_name ?> </td>
                                                    <td class="sub-table-content"></td>
                                                    <td style="width: 100px; font-weight:bold;" class="sub-table-content">Department</td>
                                                    <td style="width: 1px" class="sub-table-content">:</td>
                                                    <td class="sub-table-content"><?= $invDataH->name ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 100px; font-weight:bold;" class="sub-table-content">Requester Name</td>
                                                    <td style="width: 1px" class="sub-table-content">:</td>
                                                    <td class="sub-table-content"><?= $invDataH->requester_name ?></td>
                                                    <td class="sub-table-content"></td>
                                                    <td style="width: 100px; font-weight:bold;" class="sub-table-content">Vehicle_No</td>
                                                    <td style="width: 1px" class="sub-table-content">:</td>
                                                    <td class="sub-table-content"><?= $invDataH->vehicle_no ?></td>
                                                    <td class="sub-table-content"></td>
                            <!--            <td style="width: 100px; font-weight:bold;" class="sub-table-content">Zone Name</td>
                                                    <td style="width: 1px" class="sub-table-content">:</td>
                                                    <td class="sub-table-content">Agalawatta Baduraliya</td>-->
                                                </tr>
                                                <tr>

                                                    <td style="width: 100px; font-weight:bold;" class="sub-table-content">Driver Name</td>
                                                    <td style="width: 1px" class="sub-table-content">:</td>
                                                    <td class="sub-table-content"><?= $invDataH->driver_name ?></td>
                                                    <td class="sub-table-content"></td>
                                                    <td style="width: 100px; font-weight:bold;" class="sub-table-content">Driver Num</td>
                                                    <td style="width: 1px" class="sub-table-content">:</td>
                                                    <td class="sub-table-content"><?= $invDataH->driver_number ?></td>

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
                                                <!--
                                                <tr>
                                                    <td style="width: 100px; font-weight:bold;" class="sub-table-content">Start Mileage (KM)</td>
                                                    <td style="width: 1px" class="sub-table-content">:</td>
                                                    <td class="sub-table-content"><?= $invDataH->start_mileage ?></td>
                                                    <td class="sub-table-content"></td>
                                                    <td style="width: 100px; font-weight:bold;" class="sub-table-content">End Mileage (KM)</td>
                                                    <td style="width: 1px" class="sub-table-content">:</td>
                                                    <td class="sub-table-content"><?= $invDataH->end_mileage ?></td>
                                                </tr> -->
                                                <tr>
                                                    <td style="width: 100px; font-weight:bold;" class="sub-table-content">Reason</td>
                                                    <td style="width: 1px" class="sub-table-content">:</td>
                                                    <td class="sub-table-content"><?= $invDataH->reason ?></td>
                                                    <td class="sub-table-content"></td>
                                                    <td style="width: 100px; font-weight:bold;" class="sub-table-content">System Mileage (KM)</td>
                                                    <td style="width: 1px" class="sub-table-content">:</td>
                                                    <td class="sub-table-content"><?= $invDataH->system_mileage ?> (Rs. <?= $invDataH->rate ?> Per km)</td>

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
                                                                                    <th style=" font-size: 14px; font-weight: bold;" width="200px">Service Name</th>
                                                                                    <th style=" font-size: 14px; font-weight: bold;" width="200px">Cost</th> 
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
                                                                                        <tr id="row_1" style="text-align: left ; font-size: 12px; font-weight:bold;" >
                                                                                            <td><?= $countR ?></td>

                                                                                            <td style="text-align: left ; font-size: 14px; font-weight:bold;" ><?= $d['service_name'] ?></td>
                                                                                            <td style="text-align: left ; font-size: 14px; font-weight:bold;" ><?= $d['cost'] ?></td>


                                                                                        </tr>
                                                                                        <?php
                                                                                        $countR += 1;
                                                                                    }
                                                                                }
                                                                                ?>		
                                                                            </tbody>
                                                                           <!-- <tfoot>
                                                                                <tr>
                                                                                    <td colspan="8" style="text-align: right">Total</td> 

                                                                                </tr>
                                                                            </tfoot> -->
                                                                        </table>
                                                                    </td>
                                                                </tr>



                                                                <tr>
                                                                    <td colspan="3">
                                                                        <table border="0" width="825px" >
                                                                            <thead>
                                                                               <!-- <tr>
                                                                                    <td style=" padding: 5px;"></td>
                                                                                    <td style=" padding: 5px;"></td>
                                                                                    <td style=" padding: 5px;"></td>
                                                                                </tr> -->

                                                                                <tr style="text-align: right;">
                                                                                    <td style=" padding: 20px;">Total Cost</td>
                                                                                    <td style=" padding: 20px;">:</td>
                                                                                    <td style=" padding: 20px;">Rs.<?= $invDataH->total_cost ?></td>

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
                                        <table table width="700px" border="0" class="" cellpadding="0" cellspacing="2" >
                                            <thead>
                                            <tbody>
                                                <tr>

                                                    <td style="width: 300px " >....................</td>
                                                    <td style="width: 300px ">.....................</td> 
                                                    <td style="width: 300px ">.....................</td> 
                                                    <td style="width: 300px ">.....................</td> 
                                                </tr>

                                                <tr>

                                                    <td style="width: 300px ">Prepared by</td>
                                                    <td style="width: 300px ">Checked by</td> 
                                                    <td style="width: 300px ">Confirmed by</td> 
                                                    <td style="width: 300px ">Authorized by</td> 

                                                </tr>

                                            </tbody>
                                            </thead>

                                        </table>
                                    </div>
                                </td>
                            </tr>
                        <script>
                            function printDiv(abc)
                            {

                                var divToPrint = document.getElementById(abc);

                                var newWin = window.open('', 'Print-Window');

                                newWin.document.open();

                                newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');

                                newWin.document.close();

                                setTimeout(function () {
                                    newWin.close();
                                }, 10);

                            }

                        </script>
                        </tbody>
                    </table>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>