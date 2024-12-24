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
                        <form class="form-horizontal" id="" action="<?= base_url('sms/saveWinner') ?>" method="post">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-2">Raffle Date <span class="text-red">*</span></label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" name="RaffleDate" class="form-control pull-right active" readonly="" id="datepicker" value="<?= $RaffleDate ?>">
                                        </div><!-- /.input group -->
                                    </div><!-- /.form group -->
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-2">Mobile<span class="text-red">*</span></label>
                                    <div class="col-md-6">                                         
                                        <input type="text" readonly="readonly" name="sender" class="form-control pull-right" id="sender" value="<?= $WinnerData->sender ?>">                                 
                                    </div><!-- /.form group -->
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-2">Message<span class="text-red">*</span></label>
                                    <div class="col-md-6">                                         
                                        <input type="text" readonly="readonly" name="message" class="form-control pull-right" id="message" value="<?= $WinnerData->message ?>">                                 
                                    </div><!-- /.form group -->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-2">SMS Date<span class="text-red">*</span></label>
                                    <div class="col-md-6">                                         
                                        <input type="text" readonly="readonly" name="message" class="form-control pull-right" id="message" value="<?= $WinnerData->sms_date ?>">                                 
                                    </div><!-- /.form group -->
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-2">SMS Applied Date<span class="text-red">*</span></label>
                                    <div class="col-md-6">                                         
                                        <input type="text" readonly="readonly" name="applied_date" class="form-control pull-right" id="message" value="<?= $WinnerData->applied_date ?>">                                 
                                    </div><!-- /.form group -->
                                </div>
                            </div>  
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-2">Expected Code<span class="text-red">*</span></label>
                                    <div class="col-md-6">                                         
                                        <input type="text" readonly="readonly" name="expected_code" class="form-control pull-right" id="expected_code" value="<?= $WinnerData->expected_code ?>">                                 
                                    </div><!-- /.form group -->
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php
                                    $finalized_code_readonly = '';
                                    $is_code_final = '';
                                    $is_rejected_checked='';
                                    if ($WinnerData->is_code_finalized == 1) {
                                        $is_code_final = ' checked="checked" ';
                                        $finalized_code_readonly = ' readonly ';
                                    }
                                    if ($WinnerData->is_rejected == 1) {
                                        $is_rejected_checked = ' checked="checked" '; 
                                    }
                                    $is_confirmed='';
                                    if ($WinnerData->is_confirmed == 1) {
                                        $is_confirmed = ' checked="checked" '; 
                                    }
                                    ?>
                                    <label class="col-md-2">Finalized Code<span class="text-red">*</span></label>
                                    <div class="col-md-6">                                         
                                        <input type="text" name="finalized_code" class="form-control pull-right" id="finalized_code" value="<?= $WinnerData->finalized_code ?>">                                 
                                    </div><!-- /.form group -->
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-2">Is Finalized Code<span class="text-red">*</span></label>
                                    <div class="col-md-6">                                         
                                        <input type="checkbox" name="is_code_finalized" <?= $is_code_final ?> class="checkbox" id="is_code_finalized" value="1">                                 
                                    </div><!-- /.form group -->
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-2">Is Rejected<span class="text-red">*</span></label>
                                    <div class="col-md-6">                                         
                                        <input type="checkbox" name="is_rejected" <?= $is_rejected_checked ?> class="checkbox" id="is_rejected" value="1">                                 
                                    </div><!-- /.form group -->
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-2">Is Booking Confirmed<span class="text-red">*</span></label>
                                    <div class="col-md-6">                                         
                                        <input type="checkbox" name="is_confirmed" <?= $is_confirmed ?> class="checkbox" id="is_confirmed" value="1">                                 
                                    </div><!-- /.form group -->
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-2">Comments<span class="text-red">*</span></label>
                                    <div class="col-md-6">                                         
                                        <textarea name="comments" <?= $is_rejected_checked ?> class="form-control" id="is_rejected"><?= $WinnerData->comments ?></textarea>                                 
                                    </div><!-- /.form group -->
                                </div>
                            </div> 
                            
                            <div class="col-md-6">
                                <div class="form-group"> 
                                    <label class="col-md-2">Winner Name<span class="text-red">*</span></label>
                                    <div class="col-md-6">                                         
                                        <input type="text" name="name" class="form-control pull-right" id="name" value="<?= $WinnerData->name ?>">                                 
                                    </div><!-- /.form group -->
                                </div>
                            </div>                            
                            <div class="col-md-6">
                                <div class="form-group"> 
                                    <label class="col-md-2">Film hall Name<span class="text-red">*</span></label>
                                    <div class="col-md-6">                                         
                                        <input type="text" name="hall_name" class="form-control pull-right" id="hall_name" value="<?= $WinnerData->hall_name ?>">                                 
                                    </div><!-- /.form group -->
                                </div>
                            </div>                          
                            <div class="col-md-6">
                                <div class="form-group"> 
                                    <label class="col-md-2">Address<span class="text-red">*</span></label>
                                    <div class="col-md-6">                                         
                                        <input type="text" name="address" class="form-control pull-right" id="address" value="<?= $WinnerData->address ?>">                                 
                                    </div><!-- /.form group -->
                                </div>
                            </div>                        
                            <div class="col-md-6">
                                <div class="form-group"> 
                                    <label class="col-md-2">District<span class="text-red">*</span></label>
                                    <div class="col-md-6">                                         
                                        <input type="text" name="district" class="form-control pull-right" id="district" value="<?= $WinnerData->district ?>">                                 
                                    </div><!-- /.form group -->
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group"> 
                                    <input type="hidden" name="row_id" id="row_id" value="<?= $WinnerData->id ?>">   
                                    <input type="submit" class="btn btn-success" name="submit" value="Save Winner Details">
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
                                    <th>Is Confirmed</th>
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
                                $c = 0;
                                foreach ($Winners as $s) {
                                    $isWinner = '';
                                    if ($s['is_winner'] == 1) {
                                        $isWinner = '<lable class="label label-success">Winner</lable>';
                                    }
                                    $is_confirmed = 'not confirmed yet';
                                    if ($s['is_confirmed'] == 1) {
                                        $is_confirmed = '<lable class="label label-success">Confirmed</lable>';
                                    }
                                    $is_rejected = '';
                                    if ($s['is_rejected'] == 1) {
                                        $is_rejected = '<lable class="label label-warning">Rejected</lable>';
                                    } else {
                                        $c = $c + 1;
                                    }
                                    ?> 
                                    <tr>
                                        <td><?= $c ?></td> 
                                        <td><a  target="_blank" class="btn btn-md btn-info" href="<?= base_url('sms/editWinners/' . $s['id']) ?>"><?= $s['id'] ?></td> 
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