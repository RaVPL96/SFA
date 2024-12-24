<?php
class CashbookModule extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	function getChequeData($data){
		$dbName = 'P:\\ACCPAC\DATA\VCTDAT\VCTDAT.mdb';//$_SERVER["DOCUMENT_ROOT"] . "products\products.mdb";
		$db = new PDO("odbc:DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=$dbName; Uid=; Pwd=;");		
		if (!file_exists($dbName)) {
			die("Could not find database file.");
		}
		$sql  = "SELECT `Batch ID` FROM `Batch Detail` ORDER BY `Batch ID` ASC";
		if(!empty($data['ponumber']) && isset($data['ponumber'])){
			$po=str_replace(array('PO NO: ',' ','NO', ':', 'PO' ), '', $data['ponumber']);
			$sql .= " WHERE Comments LIKE '%" . $po . "%'";
		}
		$result = $db->query($sql);
		//echo $sql;die();
		return $result;
	}
}