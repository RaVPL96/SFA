<?php include_once BASEPATH.('../application/views/template/leftsidebar.php'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Users Location Access Permissions 
            <small>Allow/Restrict Staff Users Locations Access</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Users Module</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div id="successMessage" class="hideDiv">Permission Updated Successfully! </div>
                <div id="errorMessage" class="hideDiv">Invalid Data! Please Try Again. </div>
                <div class="keepgap"></div>  
                
                
                <?php      if (!empty($userID) && isset($userID) && $userID!=-1) {?>
                <form role="form" action="<?=  base_url('index.php/users/updateAuthLocation')?>" method="post">
                <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">User Access Table</h3> (Tick the option and save to grant access)
                  <br><br><h3 class="box-title">Account: <?=$userID?> </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered">
                    <tr>
                      <th style="width: 10px">Grant</th>
                      <th>Module</th>
                      <th>Task</th>
                      <th style="width: 40px">Current Status</th>
                    </tr>
                    <?php      
                    if (!empty($locations) && isset($locations)) {                        
                        foreach ($locations as $auth) {
                            $chked = '';
                            $class='';
                            $status='Inactive';
                            if (!empty($authGrant) && isset($authGrant)) {
                                if (in_array($auth['id'], $authGrant)) {
                                   $chked = 'checked';
                                   $class='bg-green';
                                   $status='Active';
                                } else {
                                    $chked = '';
                                    $class='bg-yellow';
                                    $status='Inactive';
                                }
                            }
                            echo '<tr>';
                            echo '<td><div class="checkbox"><label><input type="checkbox" name="authCode[]" value="' . $auth['id'] . '" ' . $chked . '/></label></div></td>';
                            echo '<td>' . $auth['name'] . '</td>';
                            echo '<td>' . $auth['address'] . '</td>';
                            echo '<td><span class="badge '.$class.'">'.$status.'</span></td>';
                            echo '</tr>';
                        }
                    }
         
                    ?>                    
                  </table>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <input type="hidden" name="userid" value="<?php  if (!empty($userID) && isset($userID)) {  echo $userID; } else { echo '-5'; } ?>">
                    <button type="submit" class="btn btn-primary pull-right">Grant Permission</button>
                </div>				<?php 				//print_r($userdata);				if(!empty($userdata) && isset($userdata)){					if($userdata->grade_id==5){//SALES REP																	}				}				?>
                <!--
                <div class="box-footer clearfix">
                  <ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="#">&laquo;</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">&raquo;</a></li>
                  </ul>
                </div>
                -->
              </div><!-- /.box -->
              </form>
                <?php }?>
            </div>
            
                    <!--Right Side Content-->

            <div class="col-md-6">

<div class="box">

    <div class="box-header with-border">

        <h3 class="box-title">Staff User List</h3> (Click Edit to change permissions)

    </div><!-- /.box-header -->

    <div class="box-body">

        <table id="example1" class="table table-bordered">

            <thead>

            <tr>

                <th style="width: 180px">Name</th>

                <th>Email</th>

                <th style="width: 80px">Group</th>

                <th style="width: 80px">&nbsp;</th>

            </tr>

            </thead>

            <tbody>

            <?php
            foreach ($userlist as $user) {
                echo '<tr class="info">
                <td>' . $user['profname'] . '</td>
                <td>' . $user['email'] . '</td>
                    <td>' . $user['name'] . '</td>
                        <td><a href="' . base_url('index.php/users/authLocation/' . $user['username']) . '">Edit</a></td>
            </tr>';
            }
            ?>

            </tbody>

        </table>

    </div><!-- /.box-body -->

    <div class="box-footer clearfix">

        

    </div>

</div><!-- /.box -->

</div>
        </div>
    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->
