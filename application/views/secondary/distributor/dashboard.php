<?php include_once BASEPATH . ('../application/views/template/leftsidebar.php'); ?>
<?php
/*


 * This system Licenced to Raigam Marketing Services (Pvt) Ltd. 

 * Developed By: Lakshitha Pradeep Karunarathna  * 

 * Company: Serving Cloud INC in association with MyOffers.lk  * 

 * Date Started:  October 20, 2017  * 


 */
?>
<div class = "content-wrapper">
    <!--Content Header (Page header) -->
    <section class = "content-header">
        <h1>
            Distributor Dashboard
            <br>&nbsp;<br>
            ආයුබෝවන් !
            <br>
            வரவேற்பு !
            <br>
            <small>Distributor Module</small>
        </h1>
        <ol class = "breadcrumb">
            <li><a href = "#"><i class = "fa fa-dashboard"></i> Home</a></li>
            <li class = "active">Secondary Sales Distributor Module</li>
        </ol>
    </section>

    <!--Main content-->
    <section class = "content">
        <div class = "row">
            <div class = "col-md-12">
                <div id = "successMessage" class = "hideDiv">Updated Successfully!</div>
                <div id = "errorMessage" class = "hideDiv">Invalid Data!Please Try Again. </div>
                <div class = "keepgap"></div>
                <div class = "row">
                    <?php
                    if (!empty($menuIcons) && isset($menuIcons)) {
                        foreach ($menuIcons as $icon) {
                            echo '  <div class="col-md-6 col-sm-6 col-xs-12">
									<a href="' . base_url($icon['url']) . '" target="_self">
                                      <div class="info-box bg-aqua">
                                        <span class="info-box-icon"><i class="' . ($icon['class']) . '"></i></span>
                                        <div class="info-box-content">
                                          <span class="info-box-text">' . ($icon['display_name']) . '</span>
                                          <span class="info-box-number">&nbsp;</span>
                                          <div class="progress">
                                            <div class="progress-bar" style="width: 95%"></div>
                                          </div>
                                          <span class="progress-description">
                                            ' . ($icon['comments']) . '
                                          </span>
                                        </div><!-- /.info-box-content -->
                                      </div><!-- /.info-box -->
                                    </a></div><!-- /.col -->';
                        }
                    }
                    ?>
                </div>


                <div class="col-md-12">
                    <div id="successMessage" class="hideDiv">Updated Successfully! </div>
                    <div id="errorMessage" class="hideDiv">Invalid Data! Please Try Again. </div>
                    <div class="keepgap"></div> 
                    <div class="row">
                        <?php
                        $totPC = 0;
                        $totCancelPC = 0;
                        $totActualPC = 0;
                        $totBval = 0;
                        $totCval = 0;
                        $totGval = 0;
                        $totMval = 0;
                        $totAval = 0;
                        $totDisval = 0;
                        if (!empty($totalCombinedSales) && isset($totalCombinedSales)) {
                            foreach ($totalCombinedSales as $s) {
                                $totPC = $totPC + $s['totPC'];
                                $totCancelPC = $totCancelPC + $s['totCancelPC'];
                                $totActualPC = $totActualPC + $s['totActualPC'];
                                $totBval = $totBval + $s['totBval'];
                                $totCval = $totCval + $s['totCval'];
                                $totGval = $totGval + $s['totGval'];
                                $totMval = $totMval + $s['totMval'];
                                $totAval = $totAval + $s['totAval'];
                                $totDisval = $totDisval + $s['totDisval'];
                            }
                        }
                        ?>
                        <div class="col-md-12">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Productive Calls</span>
                                        <span class="info-box-number"><?= $totPC ?></span>
                                    </div>

                                </div>

                            </div>

                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Actual PC </span>
                                        <span class="info-box-number"><?= $totActualPC ?></span>
                                    </div>

                                </div>

                            </div>

                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Cancel PC (with Part Cancel)</span>
                                        <span class="info-box-number"><?= $totCancelPC ?></span>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-lg-3 col-xs-6">

                                <div class="small-box bg-aqua">
                                    <div class="inner">
                                        <h3>Rs. <?= number_format($totAval) ?></h3>
                                        <p>Actual Sales</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-shopping-cart"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">
                                        <i class="fa fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-3 col-xs-6">

                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3>Rs. <?= number_format($totGval) ?></h3>
                                        <p>Good Return Value</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">
                                        <i class="fa fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-6">

                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3>Rs. <?= number_format($totMval) ?></h3>
                                        <p>Good Return Value</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">
                                        <i class="fa fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-6">

                                <div class="small-box bg-red">
                                    <div class="inner">
                                        <h3>Rs. <?= number_format($totCval) ?></h3>
                                        <p>Cancel Value (with part Cancel)</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-person-add"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">
                                        <i class="fa fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->

