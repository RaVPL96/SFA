<?php
class Distributor extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('UsersModel');
        $this->load->model('ItemsModel');
        $this->load->model('MasterModule');
        $this->load->model('DistributorModule');
    } 
    //============================================
    //====AGENCY MASTER===================
    //============================================
    //CRETATE SALES AGENCY
    function createDistributor($id = null, $msg = null, $warehuse_id = null) {
        $functionID = 64;
        $this->UsersModel->authenticateMe($functionID);
        $data['userlist'] = $this->UsersModel->getUserList();
        $data['sess'] = $sess = $this->session->userdata('User');
        $location_ID = $sess['location'];

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);

        $data['title'] = 'Sales Distributor';
        $data['pagetitle'] = COMPANY;
        $data['msg'] = $msg;

        $data['DistributorWarehouseData'] = null;
        //$data['DistributorDataSet']=$this->DistributorModule->getDistributor();
        if (!empty($id) && isset($id) && $id != null) {
            $data['DistributorData'] = $this->DistributorModule->getDistributor($id);
            //GET DISTRIBUTOR WAREHOUSE
            $data['DistributorWarehouseData'] = $this->DistributorModule->getDistributorWarehouse(null, null, $id);
        }
        $data['DistributorWarehouse'] = null;
        if (!empty($warehuse_id) && isset($warehuse_id) && $warehuse_id != null) {
            //GET DISTRIBUTOR WAREHOUSE
            $data['DistributorWarehouse'] = $this->DistributorModule->getDistributorWarehouse($warehuse_id, null, null);
            $data['DistributorData'] = $this->DistributorModule->getDistributor($data['DistributorWarehouse']->distributor_id);
        }

        //print_r($data['ChannelDataSet']);
        $this->load->view('template/header', $data);
        $this->load->view('distributor/mst_distributor');
        $this->load->view('template/footer');
    }

    //ANGULAR REQUEST
    function getDistributor($id = null, $msg = null) {
        $functionID = 64;
        $this->UsersModel->authenticateMe($functionID);
        $data['DistributorDataSet'] = $this->DistributorModule->getDistributor();
        echo json_encode($data['DistributorDataSet']);
    }

    //SAVE SALES AGENCY
    function saveDistributor() {
        $functionID = 64;
        $this->UsersModel->authenticateMe($functionID);
        $data = $_POST;
        $result = $this->DistributorModule->saveDistributor($data);
        if ($result == 1) {//Inerted 
            header('Location:' . base_url('index.php/distributor/createDistributor/-1/ok'));
        } else {
            header('Location:' . base_url('index.php/distributor/createDistributor/-1/fail'));
        }
    }

    //SAVE DISTRIBUTOR WAREHOUSE
    function saveDistributorWarehouse() {
        $functionID = 64;
        $this->UsersModel->authenticateMe($functionID);
        $data = $_POST;
        $result = $this->DistributorModule->saveDistributorWarehouse($data);
        if ($result == 1) {//Inerted 
            header('Location:' . base_url('index.php/distributor/createDistributor/-1/ok'));
        } else {
            header('Location:' . base_url('index.php/distributor/createDistributor/-1/fail'));
        }
    }

    //CRETATE DISTRIBUTOR AND HIS WAREHOUSE MAPPING WITH ERP COMPANY CODE
    function createDistributorErpMap($id = null, $msg = null, $warehuse_id = null) {
        $functionID = 65;
        $this->UsersModel->authenticateMe($functionID);
        $data['userlist'] = $this->UsersModel->getUserList();
        $data['sess'] = $sess = $this->session->userdata('User');
        $location_ID = $sess['location'];

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);

        $data['title'] = 'Sales Distributor ERP Company Mapping';
        $data['pagetitle'] = COMPANY;
        $data['msg'] = $msg;

        $data['DistributorWarehouseData'] = $this->DistributorModule->getDistributorWarehouse();
        if (!empty($id) && isset($id) && $id != null) {
            $data['DistributorWarehouseERP'] = $this->DistributorModule->getDistributorWarehouseERPLink($id);
        }
        $data['location'] = $this->ItemsModel->getLocationList();

        //print_r($data['ChannelDataSet']);
        $this->load->view('template/header', $data);
        $this->load->view('distributor/mst_distributor_warehouse_erp');
        $this->load->view('template/footer');
    }

    function getDistributorERPLink() {
        $functionID = 65;
        $this->UsersModel->authenticateMe($functionID);
        $data['getDistributorWarehouseERPLink'] = $this->DistributorModule->getDistributorWarehouseERPLink();
        echo json_encode($data['getDistributorWarehouseERPLink']);
    }

    //SAVE DISTRIBUTOR WAREHOUSE
    function saveDistributorErpMap() {
        $functionID = 65;
        $this->UsersModel->authenticateMe($functionID);
        $data = $_POST;
        $result = $this->DistributorModule->saveDistributorErpMap($data);
        if ($result == 1) {//Inerted 
            header('Location:' . base_url('index.php/distributor/createDistributorErpMap/-1/ok'));
        } else {
            header('Location:' . base_url('index.php/distributor/createDistributorErpMap/-1/fail'));
        }
    }

    //============================================
    //====END AGENCY MASTER===================
    //============================================
    //*********************************
    //AGENCY STOCK LEVEL RE CALCULATION - Required if 
    //*********************************
    function stockRecalculate($msg=null) {
        $functionID = 75;
        $this->UsersModel->authenticateMe($functionID);
        $data['userlist'] = $this->UsersModel->getUserList();
        $data['sess'] = $sess = $this->session->userdata('User');
        $location_ID = $sess['location'];

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);

        $data['title'] = 'Sales Distributor ERP Company Mapping';
        $data['pagetitle'] = COMPANY;
        $data['msg'] = $msg;
        
        $data['DateRange'] = NULL;
        $area_id = null;
        if ($sess['grade_id'] == 4) {
            $data['ASE_Area'] = $this->UsersModel->getAllowedAreas($sess['username']);
            $area_id = $data['ASE_Area']->area_id;
            $data['ASE_Territory'] = $this->MasterModule->getAreaTerritory(null, '001', $area_id);
        }else{
            $data['AreaList'] = $this->MasterModule->getArea(null,'001',1);
        }
        $this->load->view('template/header', $data);
        $this->load->view('distributor/stock_recal');
        $this->load->view('template/footer');
    }
    //DISTRIBUTOR RELATED TRANSACTION
    function Transactions($msg=null){
        $functionID = 76;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 22;
        $data['sess'] = $sess = $this->session->userdata('User');
        $data['title'] = 'Time Attendance';
        $data['pagetitle'] = 'Time Attendance';
        $data['msg'] = $msg;
        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();
        $data['menuIcons'] = $this->UsersModel->getMenuSubIconList($functionID);
        $this->load->view('template/header', $data);
        $this->load->view('distributor/index');
        $this->load->view('template/footer');
    }
    
    function openingStock($msg=null){
        $functionID = 76;
        $this->UsersModel->authenticateMe($functionID);
        $functionSubID = 54;
        $this->UsersModel->authenticateMeSubFunction($functionID, $functionSubID);
        //die();

        $data['sess'] = $sess = $this->session->userdata('User');
        $location_ID = $sess['location'];

        $data['title'] = 'Secondary Opening Stock Entry';
        $data['pagetitle'] = 'Secondary Opening Stock Entry';
        $data['msg'] = $msg;

        $data['modules'] = $this->UsersModel->getMainModule();
        $data['menu'] = $this->UsersModel->getMenuList();

        $data['oplid'] = '';
        $data['sopaid'] = '';
        $data['territoryid'] = '';
        $data['routeid'] = '';
        $data['RangeList'] = $this->MasterModule->getRange();
        //$data['OpData'] = $this->MasterModule->getOperations(null, $location_ID);

        if (!empty($_POST) && isset($_POST)) {
            $data['oplid'] = $opid = $_POST['sop']['sopid'];
            $data['sopaid'] = $areaid = $_POST['sop']['areaid'];
            $data['territoryid'] = $territoryid = $_POST['sop']['territoryid'];
            $data['routeid'] = $routeid = $_POST['sop']['routeid'];
            $data['OperationArea'] = $this->MasterModule->getOperationArea(null, $opid, $location_ID);
            $data['OpAreaTerritoryData'] = $this->MasterModule->getOperationAreaTerritory(null, $opid, $areaid, $location_ID);
            $data['OpAreaTerritoryRouteData'] = $this->MasterModule->getOperationAreaTerritorySalesRoute(null, $opid, $location_ID, $areaid, $territoryid);
            $data['Orders'] = $this->SalesoerderentryModule->getOrderData(null, $opid, $areaid, $territoryid, $routeid, null, $location_ID);
            $data['OperationAreaTerritoryCustomers'] = $this->SalesarcustomersModule->getSecondaryCustomers(null, $opid, $location_ID, $areaid, $territoryid, $routeid);
        } else {
            //$data['Orders'] = $this->SalesoerderentryModule->getOrderData(null, null, null, null, null, null, $location_ID);
        }

        $this->load->view('template/header', $data);
        $this->load->view('distributor/open_stock_entry');
        $this->load->view('template/footer');
    }
    
    
    //this is to recal stock directly
    function recalStock($ag_cd){
        $this->DistributorModule->recalStockLevel($ag_cd);
    }
    //this is for cron job of stock recalculation
    function cronRecalStock(){
        $this->DistributorModule->getAgencyStocktoRecal();        
    }
    
    
    //////////////////////////////////////////
    /////////////////////////////////////////
    /*
     * AGENCT DASHBOARD DATA
     *      */
    function homeReport($msg=null){
        $data['msg'] = $msg;
        $data['sess'] = $sess = $this->session->userdata('User');
        if($sess['grade_id']==8 || $sess['urole']==3){//admin or agent
            $this->load->view('template/header', $data);
            $this->load->view('secondary/distributor/dashboard');
            $this->load->view('template/footer');
        }else{
            header('Location:' . base_url('index.php/users/index/fail'));
        }
    }
}
?>