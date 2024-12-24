<?php
class Items extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('UsersModel');
        $this->load->model('ItemsModel');
    }
    function getItemListPopup($id=null,$range_id=null) {
        $data['rowID'] = $id;
        $data['itemPriceList'] = $this->ItemsModel->getItemPrice(null,$range_id);
        $this->load->view('templatepopup/header', $data);
        $this->load->view('items/popup_item_forinv');
        $this->load->view('templatepopup/footer');
    }
}