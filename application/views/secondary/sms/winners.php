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
                        <div class="col-lg-3 col-xs-12">
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3><?= count($SMSSet) ?> - Total SMS</h3>
                                    <p> </p> 
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="#" class="small-box-footer">Click here <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xs-12">
                            <div class="small-box bg-light-blue">
                                <div class="inner">
                                    <h3><?= count($SMSSetUnallocated) ?> - Unallocated SMS</h3>
                                    <p> </p> 
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="#" class="small-box-footer">Click here <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <?php if (!empty($SMSSetAllocated) && isset($SMSSetAllocated)) { ?>
                            <div class="col-lg-3 col-xs-12">
                                <div class="small-box bg-light-blue">
                                    <div class="inner">
                                        <h3><?= count($SMSSetAllocated) ?> - Allocated SMS</h3>
                                        <p> </p> 
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-bag"></i>
                                    </div>
                                    <a href="#" class="small-box-footer"><?= $RaffleDate ?><i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <?php
                    }
                    ?>
                    <div class="col-md-12">
                        <div class="keepgap"></div>&nbsp;<br>&nbsp;
                        <form class="form-horizontal" id="" action="<?= base_url('sms/SelectWinners') ?>" method="post">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-2">Raffle Date <span class="text-red">*</span></label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" name="RaffleDate" class="form-control pull-right active" readonly="" id="datepicker" value="<?=$RaffleDate?>">
                                        </div><!-- /.input group -->
                                    </div><!-- /.form group -->
                                </div>
                            </div>
                             
                             
                        </form>
                    </div>
                </div>    
                <div class="keepgap"></div> 
                <div class="row">
                    <?php
                    if (!empty($Winners) && isset($Winners)) {
                        ?>

                        <table id="attendance_table" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th> 
                                    <th>ID</th> 
                                    <th>Sender</th>
                                    <th>Message</th>  
                                    <th>Time</th> 
                                    <th>SMS Date</th>
                                    <th>SMS Time</th>
                                    <th>Applied Date</th>
                                    <th>Applied Time</th>
                                    <th>Expected Code</th>
                                    <th>Finalized Code</th>
                                    <th>Is Winner</th>
                                    <th>Is Finalized</th>
                                    <th>Is Rejected</th>
                                    <th>Comments</th>
                                    <th>Name</th>
                                    <th>Hall Name</th>
                                    <th>Address</th>
                                    <th>District</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $c=0;
                                foreach ($Winners as $s) {
                                    $isWinner='';
                                    if($s['is_winner']==1){                                        
                                        $isWinner='<lable class="label label-success">Winner</lable>'; 
                                    }
                                    $is_confirmed='not confirmed yet';
                                    if($s['is_confirmed']==1){                                        
                                        $is_confirmed='<lable class="label label-success">Confirmed</lable>';
                                    }
                                    $is_rejected='';
                                    if($s['is_rejected']==1){                                        
                                        $is_rejected='<lable class="label label-warning">Rejected</lable>';
                                    }else{
                                        $c=$c+1;
                                    }
                                    ?> 
                                    <tr>
                                        <td><?= $c ?></td> 
                                        <td><a  target="_blank" class="btn btn-md btn-info" href="<?= base_url('sms/editWinners/'.$s['id'].'/'.$s['applied_date'])?>"><?= $s['id'] ?></td> 
                                        <td><?= $s['sender'] ?></td>
                                        <td><?= $s['message'] ?></td>  
                                        <td><?= $s['time'] ?></td> 
                                        <td><?= $s['sms_date'] ?></td>
                                        <td><?= $s['sms_time'] ?></td>
                                        <td><?= $s['applied_date'] ?></td>
                                        <td><?= $s['applied_time'] ?></td>
                                        <td><?= $s['expected_code'] ?></td>
                                        <td><?= $s['finalized_code'] ?></td>
                                        
                                        <td><?= $isWinner ?></td>
                                        <td><?= $is_confirmed ?></td>
                                        <td><?= $is_rejected ?></td>
                                        <td><?= $s['comments'] ?></td>
                                        <td><?= $s['name'] ?></td>
                                        <td><?= $s['hall_name'] ?></td>
                                        <td><?= $s['address'] ?></td>
                                        <td><?= $s['district'] ?></td>
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