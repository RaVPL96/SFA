<?php

/*
 * This system Licenced to Raigam Marketing Services (Pvt) Ltd. 
 * Developed By: Lakshitha Pradeep Karunarathna  * 
 * Company: Serving Cloud INC in association with MyOffers.lk  * 
 * Date Started:  October 20, 2017  * 
 */

class GeneralledgerModule extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->mssql = $this->load->database('MSSQL', TRUE); 
    }
	//get journal entry data
	function executeInvoicePaymentRpt($parameters,$SaveAs) {        
		$this->createReport($parameters,$SaveAs,'journal-entry');
    }
	/****
	**
	$SaveAs=1 = pdf only
	$SaveAs=2 = excel only
	$SaveAs=2 = pddf and excel only
	*/
	
	function createReport($parameters,$SaveAs,$RptName='journal-entry'){
				//START CRYSTAL REPORT 
                    if (!empty($parameters) && isset($parameters)) {
						$sessData = $this->session->userdata('User');
						if (empty($sessData['username']) && !isset($sessData['username'])) {
							$sessData['username'] = 'guest';
						}
						$user = $sessData['username'];
						$fileName=$user.'_'.time();
						//print_r($parameters);die();
						if($RptName=='journal-entry'){
							if($SaveAs==1){
								$my_pdf = BASEPATH . ('..\crystal_reports\GL_JournalEntry_'.$fileName.'.pdf'); // RPT export to pdf file
							}elseif($SaveAs==2){
								$my_pdf = BASEPATH . ('..\crystal_reports\GL_JournalEntry_'.$fileName.'.pdf'); // RPT export to pdf file
								$my_excel = BASEPATH . ('..\crystal_reports\GL_JournalEntry_'.$fileName.'.xls'); // Excel export to pdf file
							}elseif($SaveAs==3){							
								$my_pdf = BASEPATH . ('..\crystal_reports\GL_JournalEntry_'.$fileName.'.pdf'); // RPT export to pdf file	
								$my_excel = BASEPATH . ('..\crystal_reports\GL_JournalEntry_'.$fileName.'.xls'); // Excel export to pdf file							
							}												  
							$my_report = BASEPATH . ('..\crystal_reports\GL_Journal_Entry_Details.rpt'); //rpt source file  
						}
						$ObjectFactory=new com('CrystalReports11.ObjectFactory.1') or die("Error on load"); // call COM port
						// Register the typelibrary.
						com_load_typelib("CrystalDesignRunTime.Application");
						$crapp = $ObjectFactory->CreateObject('CrystalDesignRunTime.Application'); // create an instance for Crystal
                        $creport = $crapp->OpenReport($my_report, 1); // call rpt report

                        // to refresh data before
                        //- Set database logon info – must have
                        $creport->Database->Tables(1)->SetLogOnInfo("RMIS", "RMIS", "sa", "sa");
						
						if($RptName=='journal-entry'){							
							$DateRange=$parameters['DateRange'];
							$RangeArr=explode('-',$DateRange);
							$FromDate=str_replace('/','',trim($RangeArr[0]));
							$ToDate=str_replace('/','',trim($RangeArr[1]));
							$CompanyCode=$parameters['CompanyCode']; //die();
							$creport->EnableParameterPrompting = 0;
							$creport->DiscardSavedData;
							$creport->ParameterFields(1)->AddCurrentValue(trim($CompanyCode)); // <-- param 2
							$creport->ParameterFields(2)->AddCurrentValue((int)trim($FromDate));   // <-- param 1
							$creport->ParameterFields(3)->AddCurrentValue((int)trim($ToDate));   // <-- param 1	
							$creport->ReadRecords();	
                        }
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
						if($RptName=='journal-entry'){							
							if($SaveAs!=1){
								echo  '<a class="btn btn-sm btn-success" href="'.base_url('crystal_reports\GL_JournalEntry_'.$fileName.'.xls').'"><i class="fa fa-file-excel-o fa-2x" aria-hidden="true"></i> Start Automatic Download of EXCEL!</a><iframe style="width:100%; height:600px;" src="'.base_url('crystal_reports\GL_JournalEntry_'.$fileName.'.pdf').'"></iframe>';
							}else{
								echo  '<iframe style="width:100%; height:600px;" src="'.base_url('crystal_reports\GL_JournalEntry_'.$fileName.'.pdf').'"></iframe>';
							}
                        }
					}
	}
}
?>