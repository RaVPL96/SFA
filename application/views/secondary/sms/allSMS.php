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
            Secondary Sales - Customer Care
            <small>Secondary Sales  A/R Customer Details </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Secondary Sales SMS Module</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div id="successMessage" class="hideDiv">Updated Successfully! </div>
                <div id="errorMessage" class="hideDiv">Invalid Data! Please Try Again. </div>
                <div class="keepgap"></div> 
                <div class="row">
                    <?php
                    if (!empty($SMSSet) && isset($SMSSet)) {
                        ?>
                        <table id="attendance_table" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Recipients</th>
                                    <th>Sender</th>
                                    <th>Message</th>
                                    <th>Message ID</th>
                                    <th>Retries</th>
                                    <th>Sequence Number</th>
                                    <th>Status</th>
                                    <th>Time</th>
                                    <th>Message Type</th>
                                    <th>SMS Date</th>
                                    <th>SMS Time</th>
                                    <th>Processed</th>
                                    <th>Rejected</th>
                                    <th>Reject Reason</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($SMSSet as $s) {
                                    $isprocessed='no';
                                    if($s['is_processed']==1){
                                        $isprocessed='yes';
                                    }
                                    $isreject='no';
                                    if($s['is_reject']==1){
                                        $isreject='yes';
                                    }
                                    ?> 
                                    <tr>
                                        <td><?= $s['id'] ?></td>
                                        <td><?= $s['recipients'] ?></td>
                                        <td><?= $s['sender'] ?></td>
                                        <td><?= $s['message'] ?></td>
                                        <td><?= $s['messageId'] ?></td>
                                        <td><?= $s['retries'] ?></td>
                                        <td><?= $s['sequenceNum'] ?></td>
                                        <td><?= $s['status'] ?></td>
                                        <td><?= $s['time'] ?></td>
                                        <td><?= $s['messageType'] ?></td>
                                        <td><?= $s['sms_date'] ?></td>
                                        <td><?= $s['sms_time'] ?></td>
                                        <td><?= $isprocessed ?></td>
                                        <td><?= $isreject ?></td>
                                        <td><?= $s['reject_reason'] ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php
                    }
                    ?> 
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->