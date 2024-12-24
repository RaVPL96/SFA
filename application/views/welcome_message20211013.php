<?php include_once BASEPATH . ('../application/views/template/leftsidebar.php'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control Panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">		<div class="col-md-6">		<a href="<?=base_url('androidapp/SFA_20211004_1400.apk')?>" target="_blank"> <!--SFA_20210928_0130,SFA_20210918_0800.apk, SFA_20210917_0842.apk,SFA_20210909_1700.apk,SFA_20210819_1045.apk-->									<div class="info-box bg-aqua">                                        <span class="info-box-icon"><i class="fa fa-cart-arrow-down"></i></span>                                        <div class="info-box-content">                                          <span class="info-box-text"><h3>Download Android App</h3></span>                                          <span class="info-box-number">&nbsp;</span>                                          <div class="progress">                                            <div class="progress-bar" style="width: 100%"></div>                                          </div>                                          <span class="progress-description">                                           Click to Download Latest App                                          </span>                                        </div><!-- /.info-box-content -->                                      </div>		</a>		</div>				<div class="col-md-6">		<a href="<?=base_url('androidapp/RSP_NEW.jar')?>" target="_blank"> <!--SFA_20210918_0800.apk, SFA_20210917_0842.apk,SFA_20210909_1700.apk,SFA_20210819_1045.apk-->									<div class="info-box bg-aqua">                                        <span class="info-box-icon"><i class="fa fa-cart-arrow-down"></i></span>                                        <div class="info-box-content">                                          <span class="info-box-text"><h3>Download Desktop Software</h3></span>                                          <span class="info-box-number">&nbsp;</span>                                          <div class="progress">                                            <div class="progress-bar" style="width: 100%"></div>                                          </div>                                          <span class="progress-description">                                           Click to Download Latest Desktop Software                                          </span>                                        </div><!-- /.info-box-content -->                                      </div>		</a>		</div>				<div class="col-md-6">		<a href="https://download.anydesk.com/AnyDesk.exe?_ga=2.147984948.2057996531.1632879125-896486140.1625118500" target="_blank"> <!--SFA_20210918_0800.apk, SFA_20210917_0842.apk,SFA_20210909_1700.apk,SFA_20210819_1045.apk-->									<div class="info-box bg-aqua">                                        <span class="info-box-icon"><i class="fa fa-cart-arrow-down"></i></span>                                        <div class="info-box-content">                                          <span class="info-box-text"><h3>Download ANYDESK Software</h3></span>                                          <span class="info-box-number">&nbsp;</span>                                          <div class="progress">                                            <div class="progress-bar" style="width: 100%"></div>                                          </div>                                          <span class="progress-description">                                           Click to Download Latest ANYDESK Software                                          </span>                                        </div><!-- /.info-box-content -->                                      </div>		</a>		</div>
          <!--  <div class="box">				
                <div class="box-header">					<a href="<?=base_url('androidapp/SFA_20210813_1411.apk')?>" target="_blank"><h2>Download App</h2></a><br>
                    <h3 class="box-title">Welcome</h3>
                </div>								             
            </div>			-->
            <div class="box-body">
                <div class="row">
        

		<div class="col-md-6">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Management Information System</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carousel-example-generic" data-slide-to="0" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="1" class="active"></li>
                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                </ol>
                <div class="carousel-inner">
                  <div class="item">
                    <img src="http://placehold.it/900x500/39CCCC/ffffff&amp;text=High+Performance" alt="First slide">

                    <div class="carousel-caption">
                      Process Data in Milliseconds
                    </div>
                  </div>
                  <div class="item active">
                    <img src="http://placehold.it/900x500/3c8dbc/ffffff&amp;text=MIS+Division+Project" alt="Second slide">

                    <div class="carousel-caption">
                      For Technical Support Call :(+94)77 1061 772 [Lakshitha]
                    </div>
                  </div>
                  <div class="item">
                    <img src="http://placehold.it/900x500/f39c12/ffffff&amp;text=High+Security" alt="Third slide">

                    <div class="carousel-caption">
                      Encrypted Data with SHA256 Algorithms
                    </div>
                  </div>
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                  <span class="fa fa-angle-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                  <span class="fa fa-angle-right"></span>
                </a>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div> 
			
                </div>
                
            </div><!-- /.box-body -->
			<!--
            <div class="col-xs-12">                
                <div class="form-group col-xs-2 pull-right">
                    <button class="btn btn-block btn-warning btn-md col-xs-2"><i class="fa fa-refresh"></i> Reload Data</button>
                </div>
                <div class="form-group col-xs-2 pull-right">
                    <a class="btn btn-block btn-info btn-md col-xs-2" href="<?= base_url('index.php/jobs/newJob') ?>"><i class="fa fa-briefcase"></i> New Job</a>
                </div>
            </div>
			-->
			<?php
////- Variables – for your RPT and PDF
//echo "Print Report Test";
//$my_report = "D:\\Raigam\\CreditNoteListing.rpt"; //rpt source file
//$my_pdf = "D:\\Raigam\\CreditNoteListing.xls"; // RPT export to pdf file
////-Create new COM object-depends on your Crystal Report version
//$ObjectFactory= new COM("CrystalReports11.ObjectFactory.1") or die ("Error on load"); // call COM port
//$crapp = $ObjectFactory-> CreateObject("CrystalDesignRunTime.Application"); // create an instance for Crystal
//$creport = $crapp->OpenReport($my_report, 1); // call rpt report

//// to refresh data before

////- Set database logon info – must have
//$creport->Database->Tables(1)->SetLogOnInfo("RMIS", "RMIS", "sa", "sa");

////- field prompt or else report will hang – to get through
//$creport->EnableParameterPrompting = 0;

////- DiscardSavedData – to refresh then read records
//$creport->DiscardSavedData;
//$creport->ReadRecords();

//------ Pass formula fields --------
// $creport->FormulaFields->Item(1)->Text = ("'My Report Title'");
//$creport->ParameterFields(1)->AddCurrentValue ("Hello World");   // <-- param 1
//$creport->ParameterFields(2)->AddCurrentValue (123); // <-- param 2

//export to PDF process
//$creport->ExportOptions->DiskFileName=$my_pdf; //export to pdf
//$creport->ExportOptions->PDFExportAllPages=true;
//$creport->ExportOptions->DestinationType=1; // export to file
////$creport->ExportOptions->FormatType=31; // PDF type
//$creport->ExportOptions->FormatType=27; // PDF type
//$creport->Export(true);

//—— Release the variables ——
//$creport = null;
//$crapp = null;
//$ObjectFactory = null;

//—— Embed the report in the webpage ——
//print ""
?>
        </div><!-- /.box -->
</div>
</section>
<!-- /.content -->
</div><!-- /.content-wrapper -->
