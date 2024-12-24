<?php

/*
 * This system Licenced to Raigam Marketing Services (Pvt) Ltd. 
 * Developed By: Lakshitha Pradeep Karunarathna  * 
 * Company: Serving Cloud INC in association with MyOffers.lk  * 
 * Date Started:  October 20, 2017  * 
 */

class InventrycontrolModule extends CI_Model {

    function __construct() {
        parent::__construct();
          $this->mssql = $this->load->database('MSSQL', TRUE); 
    }

    

    function executeFGStockReport($parameters,$SaveAs) {
        $parameters['reportname']='fg_stock';
		$this->createReport($parameters,$SaveAs);
    }
	function executeTNCFGStockReport($parameters,$SaveAs) {        
		$this->createReportTNC($parameters,$SaveAs);
    }
	//TNC RM STOCK
	function executeRMStockReport($parameters,$SaveAs) {
        $parameters['reportname']='tnc_rm_stock';
		$this->createReport($parameters,$SaveAs);
    }
	/****
	**
	$SaveAs=1 = pdf only
	$SaveAs=2 = excel only
	$SaveAs=3 = pddf and excel only
	*/
	
	function createReport($parameters,$SaveAs){
				//START CRYSTAL REPORT 
                    if (!empty($parameters) && isset($parameters)) {
						$sessData = $this->session->userdata('User');
						if (empty($sessData['username']) && !isset($sessData['username'])) {
							$sessData['username'] = 'guest';
						}
						$user = $sessData['username'];
						$fileName=$user.'_'.time();
						
						if($parameters['reportname']=='fg_stock'){
							if($SaveAs==1){
								$my_pdf = BASEPATH . ('..\crystal_reports\FGInventory_OrdQty_'.$fileName.'.pdf'); // RPT export to pdf file
							}elseif($SaveAs==2){
								$my_pdf = BASEPATH . ('..\crystal_reports\FGInventory_OrdQty_'.$fileName.'.pdf'); // RPT export to pdf file
								$my_excel = BASEPATH . ('..\crystal_reports\FGInventory_OrdQty_'.$fileName.'.xls'); // Excel export to pdf file
							}elseif($SaveAs==3){							
								$my_pdf = BASEPATH . ('..\crystal_reports\FGInventory_OrdQty_'.$fileName.'.pdf'); // RPT export to pdf file	
								$my_excel = BASEPATH . ('..\crystal_reports\FGInventory_OrdQty_'.$fileName.'.xls'); // Excel export to pdf file							
							}
												  
							$my_report = BASEPATH . ('..\crystal_reports\FGInventory_OrdQty.rpt'); //rpt source file  
						}elseif($parameters['reportname']=='tnc_rm_stock'){
							if($SaveAs==1){
								$my_pdf = BASEPATH . ('..\crystal_reports\TNCRMInventory_OrdQty_'.$fileName.'.pdf'); // RPT export to pdf file
							}elseif($SaveAs==2){
								$my_pdf = BASEPATH . ('..\crystal_reports\TNCRMInventory_OrdQty_'.$fileName.'.pdf'); // RPT export to pdf file
								$my_excel = BASEPATH . ('..\crystal_reports\TNCRMInventory_OrdQty_'.$fileName.'.xls'); // Excel export to pdf file
							}elseif($SaveAs==3){							
								$my_pdf = BASEPATH . ('..\crystal_reports\TNCRMInventory_OrdQty_'.$fileName.'.pdf'); // RPT export to pdf file	
								$my_excel = BASEPATH . ('..\crystal_reports\TNCRMInventory_OrdQty_'.$fileName.'.xls'); // Excel export to pdf file							
							}
												  
							$my_report = BASEPATH . ('..\crystal_reports\FGInventory_OrdQty_RawMaterials_TNC.rpt'); //rpt source file  

						}
						
						
                        
						
						//-Create new COM object-depends on your Crystal Report version
                        $ObjectFactory=new com('CrystalReports11.ObjectFactory.1') or die("Error on load"); // call COM port
                        // Register the typelibrary.
						com_load_typelib("CrystalDesignRunTime.Application");
						$crapp = $ObjectFactory->CreateObject('CrystalDesignRunTime.Application'); // create an instance for Crystal
                        $creport = $crapp->OpenReport($my_report, 1); // call rpt report
						
                        // to refresh data before
                        //- Set database logon info – must have
                        $creport->Database->Tables(1)->SetLogOnInfo("RMIS", "RMIS", "sa", "sa");

                        //- field prompt or else report will hang – to get through
                        $creport->EnableParameterPrompting = 0;

                        //- DiscardSavedData – to refresh then read records
                        $creport->DiscardSavedData;
                        $creport->ReadRecords();

                        ////------ Pass formula fields --------
                        //$creport->FormulaFields->Item(1)->Text = ("'My Report Title'");
                        //$creport->ParameterFields(1)->SetCurrentValue($parameters['AsAtDate']); // <-- param 2
                        //$creport->ParameterFields(2)->SetCurrentValue(substr($parameters['CustomerCode'], 2, 6));   // <-- param 1
                        //$creport->ParameterFields(3)->SetCurrentValue($parameters['ASEName']);   // <-- param 1
						
                        
                        //$creport->ExportOptions->FormatType = 27; // EXCEL type
						
						if($SaveAs==1){
							//export to PDF process
							$creport->ExportOptions->DiskFileName = $my_pdf; //export to pdf
							$creport->ExportOptions->PDFExportAllPages = true;
							$creport->ExportOptions->DestinationType = 1; // export to file
							$creport->ExportOptions->FormatType=31; // PDF type
							$creport->Export(false); //RPT export to pdf file
						}elseif($SaveAs==2){
							//export to PDF process
							$creport->ExportOptions->DiskFileName = $my_pdf; //export to pdf
							$creport->ExportOptions->PDFExportAllPages = true;
							$creport->ExportOptions->DestinationType = 1; // export to file
							$creport->ExportOptions->FormatType=31; // PDF type
							$creport->Export(false); //RPT export to pdf file
							
							//EXCEL EXPORT
							//export to PDF process
							$creport->ExportOptions->DiskFileName = $my_excel; //export to excel
							$creport->ExportOptions->PDFExportAllPages = true;
							$creport->ExportOptions->DestinationType = 1; // export to file
							$creport->ExportOptions->FormatType=36; // excel type
							$creport->Export(false); //RPT export to excel file
							
						}elseif($SaveAs==3){
							//export to PDF process
							$creport->ExportOptions->DiskFileName = $my_pdf; //export to pdf
							$creport->ExportOptions->PDFExportAllPages = true;
							$creport->ExportOptions->DestinationType = 1; // export to file
							$creport->ExportOptions->FormatType=31; // PDF type
							$creport->Export(false); //RPT export to pdf file
							
							//EXCEL EXPORT
							//export to PDF process
							$creport->ExportOptions->DiskFileName = $my_excel; //export to excel
							$creport->ExportOptions->PDFExportAllPages = true;
							$creport->ExportOptions->DestinationType = 1; // export to file
							$creport->ExportOptions->FormatType=27; // excel type
							$creport->Export(true); //RPT export to excel file
						}
						
                        

                        //—— Release the variables ——
                        $creport = null;
                        $crapp = null;
                        $ObjectFactory = null;

                        //—— Embed the report in the webpage ——
						if($parameters['reportname']=='fg_stock'){
							if($SaveAs!=1){
								echo  '<a class="btn btn-sm btn-success" href="'.base_url('crystal_reports\FGInventory_OrdQty_'.$fileName.'.xls').'"><i class="fa fa-file-excel-o fa-2x" aria-hidden="true"></i> Start Automatic Download of EXCEL!</a><iframe style="width:100%; height:600px;" src="'.base_url('crystal_reports\FGInventory_OrdQty_'.$fileName.'.pdf').'"></iframe>';
							}else{
								echo  '<iframe style="width:100%; height:600px;" src="'.base_url('crystal_reports\FGInventory_OrdQty_'.$fileName.'.pdf').'"></iframe>';
							}

						}elseif($parameters['reportname']=='tnc_rm_stock'){
							if($SaveAs!=1){
								echo  '<a class="btn btn-sm btn-success" href="'.base_url('crystal_reports\TNCRMInventory_OrdQty_'.$fileName.'.xls').'"><i class="fa fa-file-excel-o fa-2x" aria-hidden="true"></i> Start Automatic Download of EXCEL!</a><iframe style="width:100%; height:600px;" src="'.base_url('crystal_reports\FGInventory_OrdQty_'.$fileName.'.pdf').'"></iframe>';
							}else{
								echo  '<iframe style="width:100%; height:600px;" src="'.base_url('crystal_reports\TNCRMInventory_OrdQty_'.$fileName.'.pdf').'"></iframe>';
							}
						}
                        
                    }
	}
	
	function executeShipmentsReport($parameters,$SaveAs){
		$sessData = $this->session->userdata('User');
		if (empty($sessData['username']) && !isset($sessData['username'])) {
			$sessData['username'] = 'guest';
		}
		$user = $sessData['username'];
		$fileName=$user.'_'.time();
		
		$this->generateReport($parameters,$SaveAs,$fileName,'shipments');
	}
	function executeReceiptReport($parameters,$SaveAs){
		$sessData = $this->session->userdata('User');
		if (empty($sessData['username']) && !isset($sessData['username'])) {
			$sessData['username'] = 'guest';
		}
		$user = $sessData['username'];
		$fileName=$user.'_'.time();
		
		$this->generateReport($parameters,$SaveAs,$fileName,'receipt');
	}
	function generateReport($parameters,$SaveAs,$fileName,$RptName='shipments'){
					//START CRYSTAL REPORT 
                    if (!empty($parameters) && isset($parameters)) {
						
						if($RptName=='shipments'){
							$my_pdfPath = '\IC_Shipments_'.$fileName.'.pdf'; // RPT export to pdf file
							$my_excelPath = '\IC_Shipments_'.$fileName.'.xls'; // Excel export to pdf file
							$my_reportPath = '\IC_Shipment_Details.rpt'; //rpt source file							
						}elseif($RptName=='receipt'){
							$my_pdfPath = '\IC_Receipts_'.$fileName.'.pdf'; // RPT export to pdf file
							$my_excelPath = '\IC_Receipts_'.$fileName.'.xls'; // Excel export to pdf file
							$my_reportPath = '\IC_Receipt_Details.rpt'; //rpt source file							
						}
						
						if($SaveAs==1){
							$my_pdf = BASEPATH . ('..\crystal_reports'.$my_pdfPath); // RPT export to pdf file
						}elseif($SaveAs==2){
							$my_pdf = BASEPATH . ('..\crystal_reports'.$my_pdfPath); // RPT export to pdf file
							$my_excel = BASEPATH . ('..\crystal_reports'.$my_excelPath); // Excel export to pdf file
						}elseif($SaveAs==3){							
							$my_pdf = BASEPATH . ('..\crystal_reports'.$my_pdfPath); // RPT export to pdf file
							$my_excel = BASEPATH . ('..\crystal_reports'.$my_excelPath); // Excel export to pdf file
						}
						$my_report = BASEPATH . ('..\crystal_reports'.$my_reportPath); //rpt source file  
							
						//-Create new COM object-depends on your Crystal Report version
                        $ObjectFactory=new com('CrystalReports11.ObjectFactory.1') or die("Error on load"); // call COM port
                        // Register the typelibrary.
						com_load_typelib("CrystalDesignRunTime.Application");
						$crapp = $ObjectFactory->CreateObject('CrystalDesignRunTime.Application'); // create an instance for Crystal
                        $creport = $crapp->OpenReport($my_report, 1); // call rpt report
						
                        //echo $CompanyCode=$parameters['CompanyCode']; print_r($parameters);die();						  
						//To refresh data before
                        //-Set database logon info – must have
                        $creport->Database->Tables(1)->SetLogOnInfo("RMIS", "RMIS", "sa", "sa");

                        
						
                        ////------ Pass formula fields --------
						if($RptName=='shipments'){							
							$CompanyCode=$parameters['CompanyCode'];
							$StockLocation=$parameters['StockLocationCode'];
							$DateRange=$parameters['DateRange'];
							$RangeArr=explode('-',$DateRange);
							$FromDate=str_replace('/','',trim($RangeArr[0]));
							$ToDate=str_replace('/','',trim($RangeArr[1]));
							
							//- field prompt or else report will hang – to get through
							$creport->EnableParameterPrompting =0;
							$creport->DiscardSavedData;
							$creport->ParameterFields(1)->AddCurrentValue(trim($CompanyCode)); // <-- param 2
							$creport->ParameterFields(2)->AddCurrentValue((int)trim($FromDate));   // <-- param 1
							$creport->ParameterFields(3)->AddCurrentValue((int)trim($ToDate));   // <-- param 1	
							$creport->ParameterFields(4)->AddCurrentValue(trim($StockLocation));   // <-- param 1	
							$creport->ReadRecords();							
						}elseif($RptName=='receipt'){							
							$CompanyCode=$parameters['CompanyCode'];
							$StockLocation=$parameters['StockLocationCode'];
							$DateRange=$parameters['DateRange'];
							$RangeArr=explode('-',$DateRange);
							$FromDate=str_replace('/','',trim($RangeArr[0]));
							$ToDate=str_replace('/','',trim($RangeArr[1]));
							
							//- field prompt or else report will hang – to get through
							$creport->EnableParameterPrompting =0;
							$creport->DiscardSavedData;
							$creport->ParameterFields(1)->AddCurrentValue(trim($CompanyCode)); // <-- param 2
							$creport->ParameterFields(2)->AddCurrentValue((int)trim($FromDate));   // <-- param 1
							$creport->ParameterFields(3)->AddCurrentValue((int)trim($ToDate));   // <-- param 1	
							$creport->ParameterFields(4)->AddCurrentValue(trim($StockLocation));   // <-- param 1	
							$creport->ReadRecords();							
						}
						
                        
                        //$creport->ExportOptions->FormatType = 27; // EXCEL type
						
						if($SaveAs==1){
							//export to PDF process
							$creport->ExportOptions->DiskFileName = $my_pdf; //export to pdf
							$creport->ExportOptions->PDFExportAllPages = true;
							$creport->ExportOptions->DestinationType = 1; // export to file
							$creport->ExportOptions->FormatType=31; // PDF type
							$creport->Export(false); //RPT export to pdf file
						}elseif($SaveAs==2){
							//export to PDF process
							$creport->ExportOptions->DiskFileName = $my_pdf; //export to pdf
							$creport->ExportOptions->PDFExportAllPages = true;
							$creport->ExportOptions->DestinationType = 1; // export to file
							$creport->ExportOptions->FormatType=31; // PDF type
							$creport->Export(false); //RPT export to pdf file
							
							//EXCEL EXPORT
							//export to PDF process
							$creport->ExportOptions->DiskFileName = $my_excel; //export to excel
							$creport->ExportOptions->PDFExportAllPages = true;
							$creport->ExportOptions->DestinationType = 1; // export to file
							$creport->ExportOptions->FormatType=28; // excel type
							$creport->Export(false); //RPT export to excel file
							
						}elseif($SaveAs==3){
							//export to PDF process
							$creport->ExportOptions->DiskFileName = $my_pdf; //export to pdf
							$creport->ExportOptions->PDFExportAllPages = true;
							$creport->ExportOptions->DestinationType = 1; // export to file
							$creport->ExportOptions->FormatType=31; // PDF type
							$creport->Export(false); //RPT export to pdf file
							
							//EXCEL EXPORT
							//export to PDF process
							$creport->ExportOptions->DiskFileName = $my_excel; //export to excel
							$creport->ExportOptions->PDFExportAllPages = true;
							$creport->ExportOptions->DestinationType = 1; // export to file
							$creport->ExportOptions->FormatType=28; // excel type
							$creport->Export(true); //RPT export to excel file
						}
						
                        

                        //—— Release the variables ——
                        $creport = null;
                        $crapp = null;
                        $ObjectFactory = null;

                        //—— Embed the report in the webpage ——
						if($SaveAs!=1){
							echo  '<a class="btn btn-sm btn-success" href="'.base_url('crystal_reports'.$my_excelPath).'"><i class="fa fa-file-excel-o fa-2x" aria-hidden="true"></i> Start Automatic Download of EXCEL!</a><iframe style="width:100%; height:600px;" src="'.base_url('crystal_reports'.$my_pdfPath).'"></iframe>';
						}else{
							echo  '<iframe style="width:100%; height:600px;" src="'.base_url('crystal_reports'.$my_pdfPath).'"></iframe>';
						}
                        
                    }
	}
	
	function createReportTNC($parameters,$SaveAs){
				//START CRYSTAL REPORT 
                    if (!empty($parameters) && isset($parameters)) {
						$sessData = $this->session->userdata('User');
						if (empty($sessData['username']) && !isset($sessData['username'])) {
							$sessData['username'] = 'guest';
						}
						$user = $sessData['username'];
						$fileName=$user.'_'.time();
						if($SaveAs==1){
							$my_pdf = BASEPATH . ('..\crystal_reports\FGInventory_OrdQty_'.$fileName.'.pdf'); // RPT export to pdf file
						}elseif($SaveAs==2){
							$my_pdf = BASEPATH . ('..\crystal_reports\FGInventory_OrdQty_'.$fileName.'.pdf'); // RPT export to pdf file
							$my_excel = BASEPATH . ('..\crystal_reports\FGInventory_OrdQty_'.$fileName.'.xls'); // Excel export to pdf file
						}elseif($SaveAs==3){							
							$my_pdf = BASEPATH . ('..\crystal_reports\FGInventory_OrdQty_'.$fileName.'.pdf'); // RPT export to pdf file	
							$my_excel = BASEPATH . ('..\crystal_reports\FGInventory_OrdQty_'.$fileName.'.xls'); // Excel export to pdf file							
						}
                                              
						$my_report = BASEPATH . ('..\crystal_reports\FGInventory_OrdQty_TNC.rpt'); //rpt source file  
                        
						
						//-Create new COM object-depends on your Crystal Report version
                        $ObjectFactory=new com('CrystalReports11.ObjectFactory.1') or die("Error on load"); // call COM port
                        // Register the typelibrary.
						com_load_typelib("CrystalDesignRunTime.Application");
						$crapp = $ObjectFactory->CreateObject('CrystalDesignRunTime.Application'); // create an instance for Crystal
                        $creport = $crapp->OpenReport($my_report, 1); // call rpt report
						
                        // to refresh data before
                        //- Set database logon info – must have
                        $creport->Database->Tables(1)->SetLogOnInfo("RMIS", "RMIS", "sa", "sa");

                        //- field prompt or else report will hang – to get through
                        $creport->EnableParameterPrompting = 0;

                        //- DiscardSavedData – to refresh then read records
                        $creport->DiscardSavedData;
                        $creport->ReadRecords();

                        ////------ Pass formula fields --------
                        //$creport->FormulaFields->Item(1)->Text = ("'My Report Title'");
                        $creport->ParameterFields(1)->SetCurrentValue((int)$parameters['DaysGap']); // <-- param 2
                        //$creport->ParameterFields(2)->SetCurrentValue(substr($parameters['CustomerCode'], 2, 6));   // <-- param 1
                        //$creport->ParameterFields(3)->SetCurrentValue($parameters['ASEName']);   // <-- param 1
						
                        
                        //$creport->ExportOptions->FormatType = 27; // EXCEL type
						
						if($SaveAs==1){
							//export to PDF process
							$creport->ExportOptions->DiskFileName = $my_pdf; //export to pdf
							$creport->ExportOptions->PDFExportAllPages = true;
							$creport->ExportOptions->DestinationType = 1; // export to file
							$creport->ExportOptions->FormatType=31; // PDF type
							$creport->Export(false); //RPT export to pdf file
						}elseif($SaveAs==2){
							//export to PDF process
							$creport->ExportOptions->DiskFileName = $my_pdf; //export to pdf
							$creport->ExportOptions->PDFExportAllPages = true;
							$creport->ExportOptions->DestinationType = 1; // export to file
							$creport->ExportOptions->FormatType=31; // PDF type
							$creport->Export(false); //RPT export to pdf file
							
							//EXCEL EXPORT
							//export to PDF process
							$creport->ExportOptions->DiskFileName = $my_excel; //export to excel
							$creport->ExportOptions->PDFExportAllPages = true;
							$creport->ExportOptions->DestinationType = 1; // export to file
							$creport->ExportOptions->FormatType=36; // excel type
							$creport->Export(false); //RPT export to excel file
							
						}elseif($SaveAs==3){
							//export to PDF process
							$creport->ExportOptions->DiskFileName = $my_pdf; //export to pdf
							$creport->ExportOptions->PDFExportAllPages = true;
							$creport->ExportOptions->DestinationType = 1; // export to file
							$creport->ExportOptions->FormatType=31; // PDF type
							$creport->Export(false); //RPT export to pdf file
							
							//EXCEL EXPORT
							//export to PDF process
							$creport->ExportOptions->DiskFileName = $my_excel; //export to excel
							$creport->ExportOptions->PDFExportAllPages = true;
							$creport->ExportOptions->DestinationType = 1; // export to file
							$creport->ExportOptions->FormatType=27; // excel type
							$creport->Export(true); //RPT export to excel file
						}
						
                        

                        //—— Release the variables ——
                        $creport = null;
                        $crapp = null;
                        $ObjectFactory = null;

                        //—— Embed the report in the webpage ——
						if($SaveAs!=1){
							echo  '<a class="btn btn-sm btn-success" href="'.base_url('crystal_reports\FGInventory_OrdQty_'.$fileName.'.xls').'"><i class="fa fa-file-excel-o fa-2x" aria-hidden="true"></i> Start Automatic Download of EXCEL!</a><iframe style="width:100%; height:600px;" src="'.base_url('crystal_reports\FGInventory_OrdQty_'.$fileName.'.pdf').'"></iframe>';
						}else{
							echo  '<iframe style="width:100%; height:600px;" src="'.base_url('crystal_reports\FGInventory_OrdQty_'.$fileName.'.pdf').'"></iframe>';
						}
                        
                    }
	}
}
