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
            G/L Reports
            <small>G/L Reports</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">General Ledger Module</li>
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
                    if (!empty($menuIcons) && isset($menuIcons)) {
                        foreach ($menuIcons as $icon) {
                            echo '  <div class="col-md-6 col-sm-6 col-xs-12">
									<a href="'.  base_url($icon['url']).'" target="_self">
                                      <div class="info-box bg-aqua">
                                        <span class="info-box-icon"><i class="'.  ($icon['class']).'"></i></span>
                                        <div class="info-box-content">
                                          <span class="info-box-text">'.  ($icon['display_name']).'</span>
                                          <span class="info-box-number">&nbsp;</span>
                                          <div class="progress">
                                            <div class="progress-bar" style="width: 95%"></div>
                                          </div>
                                          <span class="progress-description">
                                            '.  ($icon['comments']).'
                                          </span>
                                        </div><!-- /.info-box-content -->
                                      </div><!-- /.info-box -->
                                    </a></div><!-- /.col -->';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->