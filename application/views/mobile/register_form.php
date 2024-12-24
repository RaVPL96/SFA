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
            Device Handover
            <small>Register / Edit Records<all>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Device Handover</li>
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
                                    <div class="col-lg-12">
                                        <form method="POST" action="<?= base_url('mobile/saveMobData') ?>">
                                            <?php
                                            $main_id = 'new';
                                            $tera_id = '';
                                            $tera_name = '';
                                            $rep_name = '';
                                            $nic = '';
                                            $phone_no = '';
                                            $emei1 = '';
                                            $emei2 = '';
                                            $model = '';
                                            $model_id = '';
                                            $model_name = '';
                                            $sim_sn = '';
                                            $status_id = '';
                                            $status_name = '';
                                            $comment = '';
                                            if (!empty($mobileRecordEdit) && isset($mobileRecordEdit)) {
                                                $main_id = $mobileRecordEdit->main_id;
                                                $tera_id = $mobileRecordEdit->territory_id;
                                                $tera_name = $mobileRecordEdit->territory_name;
                                                $rep_name = $mobileRecordEdit->rep_name;
                                                $nic = $mobileRecordEdit->nic;
                                                $phone_no = $mobileRecordEdit->phone_no;
                                                $emei1 = $mobileRecordEdit->imei1;
                                                $emei2 = $mobileRecordEdit->imei2;
                                                $model = $mobileRecordEdit->model;
                                                $model_id = $mobileRecordEdit->model_id;
                                                $model_name = $mobileRecordEdit->model_name;
                                                $sim_sn = $mobileRecordEdit->sim_sn;
                                                $status_id = $mobileRecordEdit->status_id;
                                                $status_name = $mobileRecordEdit->status_name;
                                                $comment = $mobileRecordEdit->comment;
                                            }
                                            ?>
                                            <div class="form-group col-md-4">
                                                <label for="inputState">Select Territory</label>
                                                <select id="inputTerritory" name="inputTerritory" class="form-control">
                                                    <option>Please Select..	</option>
                                                    <?php
                                                    foreach ($TerritoryDataSet as $abc) {
                                                        if (!empty($tera_id) && isset($tera_id) && $abc['id'] == $tera_id) {
                                                            ?>
                                                            <option selected value="<?php echo $abc['id'] ?>"><?php echo $abc['territory_name'] ?></option>
                                                            <?php
                                                        } else {

                                                            echo '<option value="' . $abc['id'] . '">' . $abc['territory_name'] . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>


                                            <!-- <div class="form-group col-md-4">
                                              <label for="inputEmail4">Territory</label>
                                              <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                                            </div> -->

                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Sales Rep-Name</label>
                                                <input type="text" class="form-control" id="salesRepName" value="<?php echo $rep_name; ?>" name="salesRepName" placeholder="Sales Rep-Name">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">NIC No</label>
                                                <input type="text" class="form-control" id="nicNo" name="nicNo" value="<?php echo $nic; ?>" placeholder="NIC No">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Phone No</label>
                                                <input type="text" class="form-control" id="phoneNo" name="phoneNo" value="<?php echo $phone_no; ?>" placeholder="Phone No">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Phone IMEI 1</label>
                                                <input type="text" class="form-control" id="imei1" name="imei1" value="<?php echo $emei1 ?>" placeholder="Phone IMEI 1">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Phone IMEI 2</label>
                                                <input type="text" class="form-control" id="imei2" name="imei2" value="<?php echo $emei2 ?>" placeholder="Phone IMEI 2">
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="inputState">Phone Model</label>
                                                <select id="phoneModel" name="phoneModel" class="form-control">
                                                    <option >Please Select..</option>


                                                    <?php
                                                    foreach ($phoneModels as $abc) {
                                                        if (!empty($model_id) && isset($model_id) && $abc['id'] == $model_id) {
                                                            ?>
                                                            <option selected value="<?php echo $abc['id'] ?>"><?php echo $abc['model_name'] ?></option>
                                                            <?php
                                                        } else {

                                                            echo '<option value="' . $abc['id'] . '">' . $abc['model_name'] . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">SIM S/N</label>
                                                <input type="text" class="form-control" id="simSn" name="simSn" value="<?php echo $sim_sn ?>" placeholder="Phone IMEI 2">
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="inputState">Status</label>
                                                <select id="status" name="status" class="form-control">
                                                    <option>Please Select..</option>
                                                    <?php
                                                    foreach ($status as $stat) {
                                                        if (!empty($status_id) && isset($status_id) && $stat['id'] == $status_id) {
                                                            ?>
                                                            <option selected value="<?php echo $stat['id'] ?>"><?php echo $stat['status_name'] ?></option>
                                                            <?php
                                                        } else {

                                                            echo '<option value="' . $stat['id'] . '">' . $stat['status_name'] . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="exampleFormControlTextarea1">Special Comment</label>
                                                <textarea class="form-control" id="comment" name="comment" rows="3"><?php echo $comment ?></textarea>
                                            </div>

                                            <div class="form-group col-md-12">
                                                <button type="submit" class="btn btn-primary" style="float: right">Submit</button>
                                                <input type="hidden" name="main_id" value="<?php echo $main_id ?>">
                                            </div>

                                        </form>
                                    </div>
                                    <div class="col-lg-12">
                                        <table id="example1" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Teritory</th>
                                                    <th scope="col">Sales Rep-Name</th>
                                                    <th scope="col">NIC</th>
                                                    <th scope="col">Phone No</th>
                                                    <th scope="col">IMEI 1</th>
                                                    <th scope="col">IMEI 2</th>
                                                    <th scope="col">Phone Model</th>
                                                    <th scope="col">SIM S/n</th>
                                                    <th scope="col">status</th>
                                                    <th scope="col">Special Comment</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($mobileRecords as $data) {
                                                    echo '<tr>
						  		<td><a href="' . base_url() . 'mobile/reg/null/' . $data['main_id'] . '">' . $data['main_id'] . '</a></td>
						  		<td>' . $data['territory_name'] . '</td>
						  		<td>' . $data['rep_name'] . '</td>
						  		<td>' . $data['nic'] . '</td>
						  		<td>' . $data['phone_no'] . '</td>
						  		<td>' . $data['imei1'] . '</td>
						  		<td>' . $data['imei2'] . '</td>
						  		<td>' . $data['model_name'] . '</td>
						  		<td>' . $data['sim_sn'] . '</td>
						  		<td>' . $data['status_name'] . '</td>
						  		<td>' . $data['comment'] . '</td>
						  	</tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- /.content -->
                    </div><!-- /.content-wrapper -->