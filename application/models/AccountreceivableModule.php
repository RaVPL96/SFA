<?php

/*
 * This system Licenced to Raigam Marketing Services (Pvt) Ltd. 
 * Developed By: Lakshitha Pradeep Karunarathna  * 
 * Company: Serving Cloud INC in association with MyOffers.lk  * 
 * Date Started:  October 20, 2017  * 
 */

class AccountreceivableModule extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->mssql = $this->load->database('MSSQL', TRUE); 
    }

    function getASEList() {
        $this->mssql->select('EPF,Name');
        $this->mssql->from('RMIS.Ach.MstASETeam');
		$this->mssql->where('IsActive',1);
		$this->mssql->order_by('EPF ASC');
        $query = $this->mssql->get();
        $res = $query->result();
        return $res;
    }

    function executeDebtorListASEWise($AsAtDate = NULL, $CusCode=null,$parameters,$SaveAs) {
        //DELETE OLD REPORT GENERATED DATA
        $spDelete='RMIS.Reports.AccpacAgedDebtorsList_ASEDirectSale_D';
		
		//Here's the magic...
		//sqlsrv_configure('WarningsReturnAsErrors', 0);
 
        $result = $this->mssql->query($spDelete);
        
        //GET DEBTOR DATA
        $sp = "RMIS.Reports.AccpacDebtorsList_ASEDirectSale_OneCus ?,? "; //No exec or call needed
		//No @ needed.  Codeigniter gets it right either way
        $params = array(
            'PARAM_1' => $AsAtDate,
            'PARAM_2' => $CusCode);

        $result = $this->mssql->query($sp, $params);
        //echo 'Report OK..';
		//Generate SaveAs
		$this->createReport($parameters,$SaveAs);
    }
	/****
	**
	$SaveAs=1 = pdf only
	$SaveAs=2 = excel only
	$SaveAs=2 = pddf and excel only
	*/
	
	function createReport($parameters,$SaveAs,$RptName='debtor-ase'){
				//START CRYSTAL REPORT 
                    if (!empty($parameters) && isset($parameters)) {
						$sessData = $this->session->userdata('User');
						if (empty($sessData['username']) && !isset($sessData['username'])) {
							$sessData['username'] = 'guest';
						}
						$user = $sessData['username'];
						$fileName=$user.'_'.time();
						//print_r($RptName);
						if($RptName=='debtor-ase'){
							if($SaveAs==1){
								$my_pdf = BASEPATH . ('..\crystal_reports\DebtorsList_Detail_OneCus_'.$fileName.'.pdf'); // RPT export to pdf file
							}elseif($SaveAs==2){
								$my_pdf = BASEPATH . ('..\crystal_reports\DebtorsList_Detail_OneCus_'.$fileName.'.pdf'); // RPT export to pdf file
								$my_excel = BASEPATH . ('..\crystal_reports\DebtorsList_Detail_OneCus_'.$fileName.'.xls'); // Excel export to pdf file
							}elseif($SaveAs==3){							
								$my_pdf = BASEPATH . ('..\crystal_reports\DebtorsList_Detail_OneCus_'.$fileName.'.pdf'); // RPT export to pdf file	
								$my_excel = BASEPATH . ('..\crystal_reports\DebtorsList_Detail_OneCus_'.$fileName.'.xls'); // Excel export to pdf file							
							}												  
							$my_report = BASEPATH . ('..\crystal_reports\DebtorsList_Detail_OneCus.rpt'); //rpt source file  
						}elseif($RptName=='invoice-entry'){
							//print_r($parameters);
							if($SaveAs==1){
								$my_pdf = BASEPATH . ('..\crystal_reports\AR_InvoiceEntry_Details_'.$fileName.'.pdf'); // RPT export to pdf file
							}elseif($SaveAs==2){
								$my_pdf = BASEPATH . ('..\crystal_reports\AR_InvoiceEntry_Details_'.$fileName.'.pdf'); // RPT export to pdf file
								$my_excel = BASEPATH . ('..\crystal_reports\AR_InvoiceEntry_Details_'.$fileName.'.xls'); // Excel export to pdf file
							}elseif($SaveAs==3){							
								$my_pdf = BASEPATH . ('..\crystal_reports\AR_InvoiceEntry_Details_'.$fileName.'.pdf'); // RPT export to pdf file	
								$my_excel = BASEPATH . ('..\crystal_reports\AR_InvoiceEntry_Details_'.$fileName.'.xls'); // Excel export to pdf file							
							}												  
							$my_report = BASEPATH . ('..\crystal_reports\AR_Invoice_Entry_Details.rpt');//rpt source file  
						}elseif($RptName=='invoice-payments'){
							//print_r($parameters);die();
							if($SaveAs==1){
								$my_pdf = BASEPATH . ('..\crystal_reports\AR_InvoicePayments_Details_'.$fileName.'.pdf'); // RPT export to pdf file
							}elseif($SaveAs==2){
								$my_pdf = BASEPATH . ('..\crystal_reports\AR_InvoicePayments_Details_'.$fileName.'.pdf'); // RPT export to pdf file
								$my_excel = BASEPATH . ('..\crystal_reports\AR_InvoicePayments_Details_'.$fileName.'.xls'); // Excel export to pdf file
							}elseif($SaveAs==3){							
								$my_pdf = BASEPATH . ('..\crystal_reports\AR_InvoicePayments_Details_'.$fileName.'.pdf'); // RPT export to pdf file	
								$my_excel = BASEPATH . ('..\crystal_reports\AR_InvoicePayments_Details_'.$fileName.'.xls'); // Excel export to pdf file							
							}												  
							$my_report = BASEPATH . ('..\crystal_reports\AR_Invoice_Payment_Entry_Details.rpt');//rpt source file  
						}
						//-Create new COM object-depends on your Crystal Report version
						if($RptName=='invoice-payments'){
							$ObjectFactory=new com('CrystalReports11.ObjectFactory.1') or die("Error on load"); // call COM port
						}else{
							$ObjectFactory=new com('CrystalReports11.ObjectFactory.1') or die("Error on load"); // call COM port
						}
                        
                        // Register the typelibrary.
						com_load_typelib("CrystalDesignRunTime.Application");
						$crapp = $ObjectFactory->CreateObject('CrystalDesignRunTime.Application'); // create an instance for Crystal
                        $creport = $crapp->OpenReport($my_report, 1); // call rpt report

                        // to refresh data before
                        //- Set database logon info – must have
                        $creport->Database->Tables(1)->SetLogOnInfo("RMIS", "RMIS", "sa", "sa");
						
						
                        
         	       
                        

						
                        ////------ Pass formula fields --------
                        //$creport->FormulaFields->Item(1)->Text = ("'My Report Title'");
						if($RptName=='debtor-ase'){
							//- field prompt or else report will hang – to get through
							$creport->EnableParameterPrompting = 0;
							
							$creport->DiscardSavedData;
							$creport->ReadRecords();
							$creport->ParameterFields(1)->SetCurrentValue($parameters['AsAtDate']); // <-- param 2
							$creport->ParameterFields(2)->SetCurrentValue(substr($parameters['CustomerCode'], 2, 6));   // <-- param 1
							$creport->ParameterFields(3)->SetCurrentValue($parameters['ASEName']);   // <-- param 1
							//- DiscardSavedData – to refresh then read records
							
						}elseif($RptName=='invoice-entry'){							
							$DateRange=$parameters['DateRange'];
							$RangeArr=explode('-',$DateRange);
							$FromDate=str_replace('/','',trim($RangeArr[0]));
							$ToDate=str_replace('/','',trim($RangeArr[1]));
							$CompanyCode=$parameters['CompanyCode']; //die();
							$creport->EnableParameterPrompting = 0;
							$creport->DiscardSavedData;
							$creport->ReadRecords();
							$creport->ParameterFields(1)->AddCurrentValue($CompanyCode); // <-- param 2
							$creport->ParameterFields(2)->AddCurrentValue((int)$FromDate);   // <-- param 1
							$creport->ParameterFields(3)->AddCurrentValue((int)$ToDate);   // <-- param 1								
                        }elseif($RptName=='invoice-payments'){							
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
						if($RptName=='debtor-ase'){							
							if($SaveAs!=1){
								echo  '<a class="btn btn-sm btn-success" href="'.base_url('crystal_reports\DebtorsList_Detail_OneCus_'.$fileName.'.xls').'"><i class="fa fa-file-excel-o fa-2x" aria-hidden="true"></i> Start Automatic Download of EXCEL!</a><iframe style="width:100%; height:600px;" src="'.base_url('crystal_reports\DebtorsList_Detail_OneCus_'.$fileName.'.pdf').'"></iframe>';
							}else{
								echo  '<iframe style="width:100%; height:600px;" src="'.base_url('crystal_reports\DebtorsList_Detail_OneCus_'.$fileName.'.pdf').'"></iframe>';
							}
                        }elseif($RptName=='invoice-entry'){
							if($SaveAs!=1){
								echo  '<a class="btn btn-sm btn-success" href="'.base_url('crystal_reports\AR_InvoiceEntry_Details_'.$fileName.'.xls').'"><i class="fa fa-file-excel-o fa-2x" aria-hidden="true"></i> Start Automatic Download of EXCEL!</a><iframe style="width:100%; height:600px;" src="'.base_url('crystal_reports\AR_InvoiceEntry_Details_'.$fileName.'.pdf').'"></iframe>';
							}else{
								echo  '<iframe style="width:100%; height:600px;" src="'.base_url('crystal_reports\AR_InvoiceEntry_Details_'.$fileName.'.pdf').'"></iframe>';
							}
						}elseif($RptName=='invoice-payments'){
							if($SaveAs!=1){
								echo  '<a class="btn btn-sm btn-success" href="'.base_url('crystal_reports\AR_InvoicePayments_Details_'.$fileName.'.xls').'"><i class="fa fa-file-excel-o fa-2x" aria-hidden="true"></i> Start Automatic Download of EXCEL!</a><iframe style="width:100%; height:600px;" src="'.base_url('crystal_reports\AR_InvoicePayments_Details_'.$fileName.'.pdf').'"></iframe>';
							}else{
								echo  '<iframe style="width:100%; height:600px;" src="'.base_url('crystal_reports\AR_InvoicePayments_Details_'.$fileName.'.pdf').'"></iframe>';
							}
						}
                    }
	}
	
	//AR TRANSACTION INVOICE ENTRY REPORT DETAIL
	function executeInvoiceEntryRpt($parameters,$SaveAs) {
        //DELETE OLD REPORT GENERATED DATA
        //$spDelete='RMIS.Reports.Accpac_AR_InvoiceBatch_Details_Web_D';
		
		//Here's the magic...
		//sqlsrv_configure('WarningsReturnAsErrors', 0);
 
        //$result = $this->mssql->query($spDelete);
        
        //GET DEBTOR DATA
        //print_r($parameters);die();
		$sp = "RMIS.Reports.Accpac_AR_InvoiceBatch_Details_Web ?,?,?"; //No exec or call needed
		//No @ needed.  Codeigniter gets it right either way
		$DateRange=$parameters['DateRange']; 
		$RangeArr=explode('-',$DateRange);
		$FromDate=str_replace('/','',trim($RangeArr[0]));
		$ToDate=str_replace('/','',trim($RangeArr[1]));
		
        $params = array(
            'CompanyCode' => $parameters['CompanyCode'],
            'FromDate' => (int)$FromDate,
			'ToDate' => (int)$ToDate
		);

        $result = $this->mssql->query($sp, $params);
		$this->mssql->last_query();
        //echo 'Report OK..'; die();
		//Generate SaveAs
		$this->createReport($parameters,$SaveAs,'invoice-entry');
    }
	
	//get invoice related payments
	function executeInvoicePaymentRpt($parameters,$SaveAs) {
        //DELETE OLD REPORT GENERATED DATA
        //$spDelete='RMIS.Reports.Accpac_AR_InvoiceBatch_Details_Web_D';
		
		//Here's the magic...
		//sqlsrv_configure('WarningsReturnAsErrors', 0);
 
        //$result = $this->mssql->query($spDelete);
        
        //GET DEBTOR DATA
        //print_r($parameters);die();
		//$sp = "RMIS.Reports.Accpac_AR_InvoiceBatch_Details_Web ?,?,?"; //No exec or call needed
		//No @ needed.  Codeigniter gets it right either way
		//$DateRange=$parameters['DateRange']; 
		//$RangeArr=explode('-',$DateRange);
		//$FromDate=str_replace('/','',trim($RangeArr[0]));
		//$ToDate=str_replace('/','',trim($RangeArr[1]));
		
        //$params = array(
        //    'CompanyCode' => $parameters['CompanyCode'],
        //   'FromDate' => (int)$FromDate,
		//	'ToDate' => (int)$ToDate
		//);

        //$result = $this->mssql->query($sp, $params);
		//$this->mssql->last_query();
        //echo 'Report OK..'; die();
		//Generate SaveAs
		$this->createReport($parameters,$SaveAs,'invoice-payments');
    }
}
