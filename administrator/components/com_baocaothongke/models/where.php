<?php
jimport( 'joomla.application.component.model' );

class BaocaohosoModelWhere extends JModelList
{
	function donvi($iddv){
		$query = " 
		 (hs.inst_code = $iddv or inst_lev0 = $iddv or inst_lev1 = $iddv or inst_lev2 = $iddv or inst_lev3 = $iddv  
		or inst_lev4 = $iddv or inst_lev5 = $iddv or inst_lev6 = $iddv or inst_lev7 = $iddv    
		) 			
		 ";		
		return $query;
	}
	
	function dvhanhchinh(){
		$query = " dv.ins_loaihinh = 1 ";
		return $query;
	}
	
	function dvsunghiep(){
		$query = "  dv.ins_loaihinh = 2 ";
		return $query;
	}	
	
	//bc_hinhthuc_id thay cho loaihinh_code còn cái bienche_code bỏ
	function hinhthuc($hinhthuc_id){
		$query = " (hs.bc_hinhthuc_id = $hinhthuc_id) ";
		return $query;
	}
	function hinhthuc_hdk($hinhthuc_id){
		$query = '( hs.bc_hinhthuc_id IN ('.$hinhthuc_id.') )';
		return $query;
	}
	
	function bchanhchinh(){
		$query = " hs.bc_hinhthuc_id= 2 ";
// 		$query = " (hs.loaihinh_code= 2 and hs.bienche_code=1) ";
		return $query;
	}
	
	function bcsunghiep(){
		$query = " hs.bc_hinhthuc_id= 3 ";
// 		$query = " (hs.loaihinh_code= 3 and hs.bienche_code=1) ";
		return $query;
	}	
	
	function hdtrong(){
		$query = "  hs.bc_hinhthuc_id= 12	";
// 		$query = " (hs.bienche_code=2 and hs.loaihinh_code= 12)	";
		return $query;
	}
	function thuhut(){
		$query = " isnull(hs.bc_hinhthuc_id)";
// 		$query = " hs.bienche_code=3	";
		return $query;
	}	
	function hd68(){
		$query = " hs.bc_hinhthuc_id= 4 ";
// 		$query = " (hs.bienche_code=1 and hs.loaihinh_code= 4) ";
		return $query;		
	}	
	function hdngoai(){
		$query = " hs.bc_hinhthuc_id= 13 ";
// 		$query = " (hs.bienche_code=2 and hs.loaihinh_code= 13) ";
		return $query;		
	}
	function hd58(){
		$query = " hs.bc_hinhthuc_id= 5 ";
// 		$query = " (hs.bienche_code=1 and hs.loaihinh_code= 5) ";
		return $query;		
	}
	function hdvuviec(){
		$query = "  hs.bc_hinhthuc_id= 11 ";
// 		$query = " (hs.bienche_code=2 and hs.loaihinh_code= 11) ";
		return $query;
	}
	function biencheloi(){
		$query = "  ";
// 		$query = " (hs.bienche_code= 0) ";
		return $query;		
	}	

	//Cong chuc phuong xa
	function truongcongan(){
		$query = " (hs.pos_sys_fk=151355) ";
		return $query;
	}
	function chihuytruong(){
		$query = " (hs.pos_sys_fk=151356) ";
		return $query;
	}
	function vptk(){
		$query = " (hs.pos_sys_fk=151357) ";
		return $query;
	}
	function dcxd(){
		$query = " (hs.pos_sys_fk=151358) ";
		return $query;
	}
	function tckt(){
		$query = " (hs.pos_sys_fk=151359) ";
		return $query;
	}
	function tpht(){
		$query = " (hs.pos_sys_fk=151360) ";
		return $query;
	}
	function vhxh(){
		$query = " (hs.pos_sys_fk=151361) ";
		return $query;
	}
	//	 Can bo phuong xa
	
	//Cong chuc phuong xa
	
	function none(){
		$query = " (hs.pos_sys_fk=9999999) ";
		return $query;
	}
	
	function chucvu($pos_id){
		$query = " (hs.pos_sys_fk=$pos_id) ";
		return $query;
	}
	
	
}

