<?php
class Old_masterModule extends CI_Model{
	function __construct() {
        parent::__construct();
        //$this->mssql = $this->load->database('MSSQL', TRUE); 
    }
	function getAreaH($id=null){
		$this->db->select('`area_cd`, `area_name`, `area_ase`, `area_asm`, `ch_head`');
		$this->db->from('`area_h`');
		if(!empty($id) && isset($id)){
			$this->db->where('`area_cd`',$id);	
		}
		$query=$this->db->get();
		if(!empty($id) && isset($id)){
			$result=$query->row();
		}else{
			$result=$query->result_array();			
		}
		return $result;
	}
	
	//save area data
	function saveAreaData($data){
		$IsInserted = 1;
		$datas=$data['sop'];
		
		$id=$datas['id'];
		$lid=$datas['lid'];
		$name=$datas['name'];
		$ase=$datas['ase'];
		$asm=$datas['asm'];
		$chead=$datas['chead'];
		
		$this->db->trans_begin();
		
		if($id=='new'){
			$arrin=array(
				'`area_cd`'=>$lid,
				'`area_name`'=>$name,
				'`area_ase`'=>$ase,
				'`area_asm`'=>$asm, 
				'`ch_head`'=>$chead
			);
			$this->db->insert('`area_h`',$arrin);
			if ($this->db->trans_status() === FALSE) {
                $IsInserted = 0;
            }			
		}else{//update
			$arrin=array(
				'`area_name`'=>$name,
				'`area_ase`'=>$ase,
				'`area_asm`'=>$asm, 
				'`ch_head`'=>$chead
			);
			$this->db->where('`area_cd`',$lid);
			$this->db->update('`area_h`',$arrin);
			if ($this->db->trans_status() === FALSE) {
                $IsInserted = 0;
            }
		}
		
		if ($IsInserted == 1) {
			$this->db->trans_commit();
            return 1;
        } else {
			$this->db->trans_rollback();
            return 0;
        }		
	}
	
	//GET AGENCY
	function getAgency($id=null){
		$this->db->select('`ag_cd`, `ag_name`, `ag_add1`, `ag_add2`, `ag_add3`, `ag_distributor_name`, `ag_tno`, `ag_asm`, `ag_ase`, `ag_c_rep`, `ag_d_rep`, `ag_c_tno`, `ag_d_tno`, `ag_ase_tno`, `ag_asm_tno`, `operation`, `ag_active`, `ag_inv_seq`, `ag_st_seq`, `ag_adj_seq`, `ag_ret_seq`, `post_flg`, `ag_union`, `stock`, `value`');
		$this->db->from('`agency_mst`');
		if(!empty($id) && isset($id)){
			$this->db->where('`ag_cd`',$id);	
		}
		$query=$this->db->get();
		if(!empty($id) && isset($id)){
			$result=$query->row();
		}else{
			$result=$query->result_array();			
		}
		return $result;
	}
	
}
?>