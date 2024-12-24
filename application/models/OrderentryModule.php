<?php
class OrderentryModule extends CI_Model {

    function __construct() {
        parent::__construct();
          $this->mssql = $this->load->database('MSSQL', TRUE); 
    }
	function executeItemOrdDetailReport($parameters,$SaveAs) { 
		
		$sessData = $this->session->userdata('User');
		if (empty($sessData['username']) && !isset($sessData['username'])) {
			$sessData['username'] = 'guest';
		}
		$user = $sessData['username'];
		$fileName=$user.'_'.time();
						
        //GET ORDER DATA
        $sp = "RMIS.Reports.AccpacOrderQty_Item_Detail_Web ?,?,?,? "; //No exec or call needed
		//No @ needed.  Codeigniter gets it right either way
		
		$DateRange=$parameters['DateRange'];
		$RangeArr=explode('-',$DateRange);
		$FromDate=str_replace('/','',trim($RangeArr[0]));
		$ToDate=str_replace('/','',trim($RangeArr[1]));
		
					
        $params = array(
            'PARAM_1' => $parameters['CompanyCode'],
            'PARAM_2' => $FromDate,
			'PARAM_3' => $ToDate,
			'PARAM_4' => $fileName
			);

        $result = $this->mssql->query($sp, $params);
		
		$this->createReport($parameters,$SaveAs,$fileName);
    }
	/****
	**
	$SaveAs=1 = pdf only
	$SaveAs=2 = excel only
	$SaveAs=3 = pddf and excel only
	*/
	function executeItemInvDetailReport($parameters,$SaveAs) { 
		
		$sessData = $this->session->userdata('User');
		if (empty($sessData['username']) && !isset($sessData['username'])) {
			$sessData['username'] = 'guest';
		}
		$user = $sessData['username'];
		$fileName=$user.'_'.time();
						
        //print_r($parameters);
		$strSqlFilter='';
		$strSqlFilterDisplayText='';
		
		//ITEM CODE LIST
		$itemCodeArr = array_values(array_filter(explode(PHP_EOL, $parameters['ItemCode'])));
		//print_r($itemCodeArr);
		if($strSqlFilter==''){
			$strSqlItemCode=' ';
			foreach($itemCodeArr as $loc){
				if($strSqlItemCode==' '){
					$strSqlItemCode = $strSqlItemCode .'("OEINVD"."ITEM"=\'\''.trim($loc).'\'\'';
					$strSqlFilterDisplayText=$strSqlFilterDisplayText.' Item Code is equal to \''.trim($loc).'\'';
				}else{
					$strSqlItemCode = $strSqlItemCode .' OR "OEINVD"."ITEM"=\'\''.trim($loc).'\'\'';
					$strSqlFilterDisplayText=$strSqlFilterDisplayText.' Or \''.trim($loc).'\'';
				}
			}
			if($strSqlItemCode==' '){
				$strSqlItemCode='';
			}else{
				$strSqlItemCode=$strSqlItemCode.')';
			}
		}else{
			$strSqlItemCode=' AND ';
			foreach($itemCodeArr as $loc){
				if($strSqlItemCode==' AND '){
					$strSqlItemCode = $strSqlItemCode .'("OEINVD"."ITEM"=\''.trim($loc).'\'';
					$strSqlFilterDisplayText=$strSqlFilterDisplayText.' AND Item Code is equal to \''.trim($loc).'\'';
				}else{
					$strSqlItemCode = $strSqlItemCode .' OR "OEINVD"."ITEM"=\''.trim($loc).'\'';
					$strSqlFilterDisplayText=$strSqlFilterDisplayText.' Or \''.trim($loc).'\'';
				}
			}
			if($strSqlItemCode==' AND '){
				$strSqlItemCode='';
			}else{
				$strSqlItemCode=$strSqlItemCode.')';
			}
		}
		$strSqlFilter=$strSqlFilter.$strSqlItemCode;
		
		//ITEM DESCRIPTION
		$itemDescArr = array_values(array_filter(explode(PHP_EOL, $parameters['ItemName'])));
		//print_r($itemCodeArr);
		if($strSqlFilter==''){
			$strSqlitemDesc=' ';
			foreach($itemDescArr as $loc){
				if($strSqlitemDesc==' '){
					$strSqlitemDesc = $strSqlitemDesc .'("OEINVD"."DESC" LIKE \'\'%'.trim($loc).'%\'\'';
					$strSqlFilterDisplayText=$strSqlFilterDisplayText.' Item Name contain \''.trim($loc).'\'';
				}else{
					$strSqlitemDesc = $strSqlitemDesc .' OR "OEINVD"."DESC" LIKE \'\'%'.trim($loc).'%\'\'';
					$strSqlFilterDisplayText=$strSqlFilterDisplayText.' Or \''.trim($loc).'\'';
				}
			}
			if($strSqlitemDesc==' '){
				$strSqlitemDesc='';
			}else{
				$strSqlitemDesc=$strSqlitemDesc.')';
			}
		}else{
			$strSqlitemDesc=' AND ';
			foreach($itemDescArr as $loc){
				if($strSqlitemDesc==' AND '){
					$strSqlitemDesc = $strSqlitemDesc .'("OEINVD"."DESC" LIKE \'\'%'.trim($loc).'%\'\'';
					$strSqlFilterDisplayText=$strSqlFilterDisplayText.' AND Item Name contain \''.trim($loc).'\'';
				}else{
					$strSqlitemDesc = $strSqlitemDesc .' OR "OEINVD"."DESC" LIKE \'\'%'.trim($loc).'%\'\'';
					$strSqlFilterDisplayText=$strSqlFilterDisplayText.' Or \''.trim($loc).'\'';
				}
			}
			if($strSqlitemDesc==' AND '){
				$strSqlitemDesc='';
			}else{
				$strSqlitemDesc=$strSqlitemDesc.')';
			}
		}
		$strSqlFilter=$strSqlFilter.$strSqlitemDesc;
		
		//DATE RANGE FILTER COMMAND
		$DateRange=$parameters['DateRange'];
		$RangeArr=explode('-',$DateRange);
		$FromDate=str_replace('/','',trim($RangeArr[0]));
		$ToDate=str_replace('/','',trim($RangeArr[1]));
		
		if($strSqlFilter==''){
			$strSqlDateRange='("OEINVH"."INVDATE">='.$FromDate.' AND "OEINVH"."INVDATE"<='.$ToDate.')';
			$strSqlFilterDisplayText=$strSqlFilterDisplayText.' Invoice Date Between '.trim($FromDate).' to '.$ToDate;
		}else{
			$strSqlDateRange=' AND ("OEINVH"."INVDATE">='.$FromDate.' AND "OEINVH"."INVDATE"<='.$ToDate.')';
			$strSqlFilterDisplayText=$strSqlFilterDisplayText.' AND Invoice Date Between '.trim($FromDate).' to '.$ToDate;
		}
		$strSqlFilter=$strSqlFilter.$strSqlDateRange;
		
		//LOCATION
		if($strSqlFilter==''){
			$strSqlLocation=' ';
			foreach($parameters['locationCode'] as $loc){
				if($strSqlLocation==' '){
					$strSqlLocation = $strSqlLocation .'("OEINVD"."LOCATION"=\'\''.trim($loc).'\'\'';
					$strSqlFilterDisplayText=$strSqlFilterDisplayText.' Location \''.trim($loc).'\'';
				}else{
					$strSqlLocation = $strSqlLocation .' OR "OEINVD"."LOCATION"=\'\''.trim($loc).'\'\'';
					$strSqlFilterDisplayText=$strSqlFilterDisplayText.' Or  \''.trim($loc).'\'';
				}
			}
			if($strSqlLocation==' '){
				$strSqlLocation='';
			}else{
				$strSqlLocation=$strSqlLocation.')';
			}
		}else{
			$strSqlLocation=' AND ';
			foreach($parameters['locationCode'] as $loc){
				if($strSqlLocation==' AND '){
					$strSqlLocation = $strSqlLocation .'("OEINVD"."LOCATION"=\'\''.trim($loc).'\'\'';
					$strSqlFilterDisplayText=$strSqlFilterDisplayText.' AND Location \''.trim($loc).'\'';
				}else{
					$strSqlLocation = $strSqlLocation .' OR "OEINVD"."LOCATION"=\'\''.trim($loc).'\'\'';
					$strSqlFilterDisplayText=$strSqlFilterDisplayText.' Or \''.trim($loc).'\'';
				}
			}
			if($strSqlLocation==' AND '){
				$strSqlLocation='';
			}else{
				$strSqlLocation=$strSqlLocation.')';
			}
		}
		$strSqlFilter=$strSqlFilter.$strSqlLocation;
		
		//CUSTOMER CODE
		//Customer Code data array
		$CustomerCodeArr = array_values(array_filter(explode(PHP_EOL, $parameters['CustomerCode'])));
		if($strSqlFilter==''){
			$strSqlCustomerCode=' ';
			foreach($CustomerCodeArr as $loc){
				if($strSqlCustomerCode==' '){
					$strSqlCustomerCode = $strSqlCustomerCode .'("OEINVH"."CUSTOMER"=\'\''.trim($loc).'\'\'';
					$strSqlFilterDisplayText=$strSqlFilterDisplayText.' Customer ID Equal to \''.trim($loc).'\'';
				}else{
					$strSqlCustomerCode = $strSqlCustomerCode .' OR "OEINVH"."CUSTOMER"=\'\''.trim($loc).'\'\'';
					$strSqlFilterDisplayText=$strSqlFilterDisplayText.' Or  \''.trim($loc).'\'';
				}
			}
			if($strSqlCustomerCode==' '){
				$strSqlCustomerCode='';
			}else{
				$strSqlCustomerCode=$strSqlCustomerCode.')';
			}
		}else{
			$strSqlCustomerCode=' AND ';
			foreach($CustomerCodeArr as $loc){
				if($strSqlCustomerCode==' AND '){
					$strSqlCustomerCode = $strSqlCustomerCode .'("OEINVH"."CUSTOMER"=\'\''.trim($loc).'\'\'';
					$strSqlFilterDisplayText=$strSqlFilterDisplayText.' AND Customer ID Equal to \''.trim($loc).'\'';
				}else{
					$strSqlCustomerCode = $strSqlCustomerCode .' OR "OEINVH"."CUSTOMER"=\'\''.trim($loc).'\'\'';
					$strSqlFilterDisplayText=$strSqlFilterDisplayText.' Or \''.trim($loc).'\'';
				}
			}
			if($strSqlCustomerCode==' AND '){
				$strSqlCustomerCode='';
			}else{
				$strSqlCustomerCode=$strSqlCustomerCode.')';
			}
		}
		$strSqlFilter=$strSqlFilter.$strSqlCustomerCode;
		
		
		//CUSTOMER NAME
		$CustomerCodeArr = array_values(array_filter(explode(PHP_EOL, $parameters['CustomerName'])));
		if($strSqlFilter==''){
			$strSqlCustomer=' ';
			foreach($CustomerCodeArr as $loc){
				if($strSqlCustomer==' '){
					$strSqlCustomer = $strSqlCustomer .'("OEINVH"."BILNAME" LIKE \'\'%'.trim($loc).'%\'\'';
					$strSqlFilterDisplayText=$strSqlFilterDisplayText.' Customer Name contain \''.trim($loc).'\'';
				}else{
					$strSqlCustomer = $strSqlCustomer .' OR "OEINVH"."BILNAME" LIKE \'\'%'.trim($loc).'%\'\'';
					$strSqlFilterDisplayText=$strSqlFilterDisplayText.' Or \''.trim($loc).'\'';
				}
			}
			if($strSqlCustomer==' '){
				$strSqlCustomer='';
			}else{
				$strSqlCustomer=$strSqlCustomer.')';
			}
		}else{
			$strSqlCustomer=' AND ';
			foreach($CustomerCodeArr as $loc){
				if($strSqlCustomer==' AND '){
					$strSqlCustomer = $strSqlCustomer .'("OEINVH"."BILNAME" LIKE \'\'%'.trim($loc).'%\'\'';
					$strSqlFilterDisplayText=$strSqlFilterDisplayText.' AND Customer Name contain \''.trim($loc).'\'';
				}else{
					$strSqlCustomer = $strSqlCustomer .' OR "OEINVH"."BILNAME" LIKE \'\'%'.trim($loc).'%\'\'';
					$strSqlFilterDisplayText=$strSqlFilterDisplayText.' Or \''.trim($loc).'\'';
				}
			}
			if($strSqlCustomer==' AND '){
				$strSqlCustomer='';
			}else{
				$strSqlCustomer=$strSqlCustomer.')';
			}
		}
		$strSqlFilter=$strSqlFilter.$strSqlCustomer;
		
		
		
		$parameters['strSqlFilterText']=$strSqlFilterDisplayText;
		$RptName='inv-detail';
		
		
		//+++++++++++++++++++++++++++++++++++++++++
						
        //GET ORDER DATA
        $sp = "RMIS.Reports.Web_InvoiceDetails ?,?"; //No exec or call needed
		//No @ needed.  Codeigniter gets it right either way
		
		$DateRange=$parameters['DateRange'];
		$RangeArr=explode('-',$DateRange);
		$FromDate=str_replace('/','',trim($RangeArr[0]));
		$ToDate=str_replace('/','',trim($RangeArr[1]));
		
		
		$params = array(
            'PARAM_1' => $parameters['CompanyCode'],
            'PARAM_2' => $strSqlFilter
		);

        $result = $this->mssql->query($sp, $params);
		
		$this->createReport($parameters,$SaveAs,$fileName,$RptName);
    }
	function executeItemSalesHistoryReport($parameters,$SaveAs){
		$sessData = $this->session->userdata('User');
		if (empty($sessData['username']) && !isset($sessData['username'])) {
			$sessData['username'] = 'guest';
		}
		$user = $sessData['username'];
		$fileName=$user.'_'.time();
						
        
		
		$this->createReport($parameters,$SaveAs,$fileName,'sales-history');
	}
	
	function executeNotInvoicedReport($parameters,$SaveAs){
		$sessData = $this->session->userdata('User');
		if (empty($sessData['username']) && !isset($sessData['username'])) {
			$sessData['username'] = 'guest';
		}
		$user = $sessData['username'];
		$fileName=$user.'_'.time();
						
        
		
		$this->createReport($parameters,$SaveAs,$fileName,'ord-notInv');
	}
	
	
	function createReport($parameters,$SaveAs,$fileName,$RptName='ord-detail'){
					//START CRYSTAL REPORT 
                    if (!empty($parameters) && isset($parameters)) {
						
						if($RptName=='ord-detail'){
							$my_pdfPath = '\OE_Pending_Order_Item_Detail_'.$fileName.'.pdf'; // RPT export to pdf file
							$my_excelPath = '\OE_Pending_Order_Item_Detail_'.$fileName.'.xls'; // Excel export to pdf file
							if($parameters['group']==2){
								$my_reportPath = '\OE_Pending_Order_Item_Details_NoGroup.rpt'; //rpt source file 
							}else{
								$my_reportPath = '\OE_Pending_Order_Item_Details.rpt'; //rpt source file 
							}
						}elseif($RptName=='inv-detail'){
							$my_pdfPath = '\OE_Inv_Details_'.$fileName.'.pdf'; // RPT export to pdf file
							$my_excelPath = '\OE_Inv_Details_'.$fileName.'.xls'; // Excel export to pdf file
							$my_reportPath = '\\'.$parameters['reportType'].'.rpt'; //rpt source file
						}elseif($RptName=='sales-history'){
							$my_pdfPath = '\OE_Sales_History_'.$fileName.'.pdf'; // RPT export to pdf file
							$my_excelPath = '\OE_Sales_History_'.$fileName.'.xls'; // Excel export to pdf file
							$my_reportPath = '\OE_SalesHistory_Summery.rpt'; //rpt source file							
						}elseif($RptName=='ord-notInv'){
							$my_pdfPath = '\OE_Ord_Not_Inv_'.$fileName.'.pdf'; // RPT export to pdf file
							$my_excelPath = '\OE_Ord_Not_Inv_'.$fileName.'.xls'; // Excel export to pdf file
							$my_reportPath = '\OE_OrdInv_Details.rpt'; //rpt source file							
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
						if($RptName=='ord-detail'){
							//- field prompt or else report will hang – to get through
							$creport->EnableParameterPrompting = 0;

							//- DiscardSavedData – to refresh then read records
							$creport->DiscardSavedData;
							$creport->ReadRecords();
							
							$DateRange=$parameters['DateRange'];
							$RangeArr=explode('-',$DateRange);
							$FromDate=str_replace('/','',trim($RangeArr[0]));
							$ToDate=str_replace('/','',trim($RangeArr[1]));
							$CompanyCode=$parameters['CompanyCode'];
						
							
							//$creport->FormulaFields->Item(1)->Text = ("'My Report Title'");
							$creport->ParameterFields(1)->SetCurrentValue($fileName); // <-- param 2
							$creport->ParameterFields(2)->SetCurrentValue((int)$FromDate);   // <-- param 1
							$creport->ParameterFields(3)->SetCurrentValue((int)$ToDate);   // <-- param 1
							$creport->ParameterFields(4)->SetCurrentValue($CompanyCode);   // <-- param 1
							
						}elseif($RptName=='inv-detail'){
							//- field prompt or else report will hang – to get through
							$creport->EnableParameterPrompting = 0;

							//- DiscardSavedData – to refresh then read records
							$creport->DiscardSavedData;
							$creport->ReadRecords();

							
							$CompanyCode=$parameters['CompanyCode'];
						
							$creport->ParameterFields(1)->SetCurrentValue($CompanyCode);   // <-- param 1
							$creport->ParameterFields(2)->SetCurrentValue($parameters['strSqlFilterText']); // <-- param 2							
						}elseif($RptName=='sales-history'){
							
							$CompanyCode=$parameters['CompanyCode'];
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
							$creport->ReadRecords();							
						}elseif($RptName=='ord-notInv'){
							
							$CompanyCode=$parameters['CompanyCode'];
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
}
?>