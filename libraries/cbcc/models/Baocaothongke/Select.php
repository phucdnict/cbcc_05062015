<?php

// CAC FUNCTION CO KY HIEU LJ O CUOI YEU CAU PHAI CO LEFT JOIN TUONG UNG

class Baocaothongke_Model_Select extends JModelLegacy
{
	/**
	 * Lấy tên hình thức, chức vụ config báo cáo
	 * @param integer $id_hìnhthuc|$id_chucv
	 * @return Ambigous <mixed, NULL>
	 */
	function getNameConfig_bc($id = 0){
		$id = (int)$id;
		$db	=	JFactory::getDbo();
		$query	=	"SELECT relation_name FROM config_bc WHERE relation_id = ".$id;
		$db->setQuery($query);
		return $db->loadResult();
	}
	
	/**
	 * Lấy tên hình thức, chức vụ config báo cáo dành cho chức vụ lãnh đạo. (id <> mức độ)
	 * @param integer $id_hìnhthuc|$id_chucv
	 * @return Ambigous <mixed, NULL>
	 */
	function getNameConfig_BcLanhdao($id = 0, $report_group_code = null){
		$id = (int)$id;
		$db	=	JFactory::getDbo();
		$where	=	'';
		if ($report_group_code != null) {
			$where = ' AND report_group_code = "'.$report_group_code.'"';
		}
		
		$query	=	"SELECT relation_name FROM config_bc WHERE relation_id = ".$id. $where ;
		$db->setQuery($query);
		return $db->loadResult();
	}
	
	/**
	 *  Lấy id, tên của cây con fig
	 * @param integer $ins_dept
	 * @param string $report_group_code
	 * @return Ambigous <mixed, NULL>
	 * Phúc dùng
	 */
	function getId_config_donvi_bc($ins_dept, $report_group_code){
		$id		=	(int)$ins_dept;
		$db		=	JFactory::getDbo();
		$query = 'select id, name from config_donvi_bc
				where ins_dept = '.(int)$ins_dept.' AND report_group_code = "'.$report_group_code.'"
				order by lft DESC
				limit 1';
		$db->setQuery($query);
		return $db->loadRow();
	}
	/**
	 * // Lấy name cây ins_dept
	 * @param unknown $ins_dept
	 * @param unknown $report_group_code
	 * @return Ambigous <mixed, NULL>
	 */
	function getIdNameInsdept($ins_dept){
		$id		=	(int)$ins_dept;
		$db		=	JFactory::getDbo();
		$query = 'select id, name from ins_dept
				where id = '.(int)$ins_dept.'
				order by lft DESC
				limit 1';
		$db->setQuery($query);
		return $db->loadRow();
	}
	
	/**
	 * Lấy tổng biên chế theo đơn vị truyền vào theo cây config
	 * @param integer $iddv_config
	 * @return Ambigous <mixed, NULL>
	 */
	function tongbienchegiao($iddv_config){
		$loaitruhinhthucbcsn	=	core::config('baocao/loaitruhinhthucbcsn');
		$where = '';
		if ($loaitruhinhthucbcsn != '') {
			$where	=	' and a.hinhthuc_id NOT IN ('.$loaitruhinhthucbcsn.')';
		}
		$year	=	date("Y");
		$db		=	JFactory::getDbo();
		$query	=	'SELECT SUM(a.bienche) FROM ins_dept_quatrinh_bienche_chitiet a
			INNER JOIN ins_dept_quatrinh_bienche b ON b.id = a.quatrinh_id
			INNER JOIN (
			SELECT node.ins_dept FROM config_donvi_bc AS node, config_donvi_bc AS parent 
			 WHERE node.lft BETWEEN parent.lft AND parent.rgt AND parent.id = '.$iddv_config.'
			) AS dvbc ON b.dept_id = dvbc.ins_dept 
			WHERE b.nam ='. $year . $where;
		$db->setQuery($query);
		return $db->loadResult();
	}
	
	/**
	 * Tính tổng biên chế theo loại hình: 1 là hành chính, 2 sự nghiệp
	 * @param integer $loaihinh
	 * @return string
	 */
	 function numBienche($loaihinh){
		switch ($loaihinh){
			//1 la hanh chinh, 2 la su nghiep
			case 1:
				$query = " count(if(hsht.bienche_hinhthuc_id= 2,1,null)) bienche, ";
				break;
			case 2:
				$query = " count(if(hsht.bienche_hinhthuc_id= 3,1,null)) bienche, ";
				break;	
			case '':
			case 0:
			case 'undefined':
				$query = " count(if(hsht.bienche_hinhthuc_id= 3 or hsht.bienche_hinhthuc_id=2,1,null)) bienche, ";
				break;
		}
				
		return $query;
	} 
	
	//Hop dong khac bao gom HD56,vu viec va cac ho so loi co bienche_code=0
	//Khi tinh bien che bao gio cung can cong them bienche_code=0 de dam bao so ho so day du	
	 function numHopdong(){
		$query = " 
		count(if( hsht.bienche_hinhthuc_id= 4,1,null)) hd68,
		count(if( hsht.bienche_hinhthuc_id= 12,1,null)) hdtrong,
		count(if( hsht.bienche_hinhthuc_id= 13,1,null)) hdngoai,
		count(if( hsht.bienche_hinhthuc_id= 5,1,null)) hd58,
		count(if( hsht.bienche_hinhthuc_id= 11,1,null)) hdvuviec,
		count(if( hsht.bienche_hinhthuc_id=5 or hsht.bienche_hinhthuc_id=11,1,null)) hdkhac,
		count(if( isnull(hsht.bienche_hinhthuc_id),1,null)) hdthuhut,
		 ";		// cuối chưa sửa
		return $query;
	} 
	
	function numNgach(){
		$query = " 
        count(if(hsht.luong_ngachtuongduong=1,1,NULL)) cvcc,
        count(if(hsht.luong_ngachtuongduong=2,1,NULL)) cvc,
        count(if(hsht.luong_ngachtuongduong=3,1,NULL)) cv,
        count(if(hsht.luong_ngachtuongduong=4,1,NULL)) cansu,
		count(if(hsht.luong_ngachtuongduong=5 or luong_ngachtuongduong=6,1,NULL)) nhanvien,
        count(if(hsht.luong_ngachtuongduong>4 or hsht.luong_ngachtuongduong<=0 or hsht.luong_ngachtuongduong is null or hsht.luong_ngachtuongduong='',1,NULL)) ngachkhac,				
		";
		return $query;
	}

	function numNganhNgach(){
		$query = "
		count(if(bacheso.idnganh=16,1,NULL)) nganh_yte,
		count(if(bacheso.idnganh=15,1,NULL)) nganh_giaoduc,
		count(if(bacheso.idnganh=17,1,NULL)) nganh_vhtt,
		count(if(bacheso.idnganh=13,1,NULL)) nganh_khcn,
		";
		return $query;	
	}
	

	function numTrinhdoLJ(){
		$query = " 
        count(if(hsht.chuyenmon_trinhdo_mucdo=1,1,NULL)) tiensi,
        count(if(hsht.chuyenmon_trinhdo_mucdo=2,1,NULL)) thacsi,
        count(if(hsht.chuyenmon_trinhdo_mucdo=3,1,NULL)) daihoc,
        count(if(hsht.chuyenmon_trinhdo_mucdo=4,1,NULL)) caodang,
        count(if(hsht.chuyenmon_trinhdo_mucdo=5,1,NULL)) trungcap,
        count(if(hsht.chuyenmon_trinhdo_mucdo=6,1,NULL)) socap,
		count(if(hsht.chuyenmon_trinhdo_mucdo>5 or hsht.chuyenmon_trinhdo_mucdo=0 or hsht.chuyenmon_trinhdo_mucdo is null,1,NULL)) tdokhac,		
		";	
		return $query;
	}		
	
	function numChinhtriLJ(){
		$query = "
		count(if(hsht.nghiepvu_lyluanchinhtri_code_mucdo=1,1,NULL)) thacsi_ctri,
		count(if(hsht.nghiepvu_lyluanchinhtri_code_mucdo=2,1,NULL)) daihoc_ctri,
		count(if(hsht.nghiepvu_lyluanchinhtri_code_mucdo=3,1,NULL)) caocap_ctri,
		count(if(hsht.nghiepvu_lyluanchinhtri_code_mucdo=4,1,NULL)) trungcap_ctri,
		count(if(hsht.nghiepvu_lyluanchinhtri_code_mucdo=5,1,NULL)) socap_ctri,
		";
		return $query;
	}
	
	function numTinhocCoreLJ(){
		$query = "
		count(if(hsht.nghiepvu_tinhoc_code_mucdo=0,1,NULL)) tiensi_tinhoc,
		count(if(hsht.nghiepvu_tinhoc_code_mucdo=1,1,NULL)) thacsi_tinhoc,
		count(if(hsht.nghiepvu_tinhoc_code_mucdo=2,1,NULL)) daihoc_tinhoc,
		count(if(hsht.nghiepvu_tinhoc_code_mucdo=3,1,NULL)) caodang_tinhoc,
		count(if(hsht.nghiepvu_tinhoc_code_mucdo=4,1,NULL)) trungcap_tinhoc,
		count(if(hsht.nghiepvu_tinhoc_code_mucdo=5,1,NULL)) ktv_tinhoc,
		count(if(hsht.nghiepvu_tinhoc_code_mucdo=6,1,NULL)) c_tinhoc,
		count(if(hsht.nghiepvu_tinhoc_code_mucdo=7,1,NULL)) b_tinhoc,
		count(if(hsht.nghiepvu_tinhoc_code_mucdo=8,1,NULL)) a_tinhoc,
	
		";
		return $query;
	}	
	
	function numTinhocLJ(){
		$query = "
		count(if(hsht.nghiepvu_tinhoc_code_mucdo<=2,1,NULL)) trendaihoc_tinhoc,
		count(if(hsht.nghiepvu_tinhoc_code_mucdo=3 or hsht.nghiepvu_tinhoc_code_mucdo=4,1,NULL)) tccd_tinhoc,
		count(if(hsht.nghiepvu_tinhoc_code_mucdo<=4,1,NULL)) trungcaptrolen_tinhoc,
		count(if(hsht.nghiepvu_tinhoc_code_mucdo>4,1,NULL)) coso_tinhoc,
		";
		return $query;
	}	
	
	function numTienganhCoreLJ(){
		$query = "
		count(if(hsht.nghiepvu_ngoaingu_anh_code_mucdo=0,1,NULL)) tiensi_tienganh,
		count(if(hsht.nghiepvu_ngoaingu_anh_code_mucdo=1,1,NULL)) thacsi_tienganh,
		count(if(hsht.nghiepvu_ngoaingu_anh_code_mucdo=2,1,NULL)) daihoc_tienganh,
		count(if(hsht.nghiepvu_ngoaingu_anh_code_mucdo=3,1,NULL)) caodang_tienganh,
		count(if(hsht.nghiepvu_ngoaingu_anh_code_mucdo=4,1,NULL)) trungcap_tienganh,
		count(if(hsht.nghiepvu_ngoaingu_anh_code_mucdo>=5,1,NULL)) coso_tienganh,		
		
		";
		return $query;
	}
	
	
	function numTienganhLJ(){
		$query = "	
		count(if(hsht.nghiepvu_ngoaingu_anh_code_mucdo<3,1,NULL)) trendaihoc_tienganh,
		count(if(hsht.nghiepvu_ngoaingu_anh_code_mucdo>=5,1,NULL)) coso_tienganh,
		count(if(hsht.nghiepvu_ngoaingu_anh_code_mucdo=3 or nghiepvu_ngoaingu_anh_code_mucdo = 4,1,NULL)) tccd_tienganh,
		";
		return $query;		
	}
	function numQPANLJ(){
		$query = "
		count(if(hsht.nghiepvu_anninhquocphong_code_mucdo=4 or hsht.nghiepvu_anninhquocphong_code_mucdo=5,1,NULL)) dt45,
		count(if(hsht.nghiepvu_anninhquocphong_code_mucdo=1 or hsht.nghiepvu_anninhquocphong_code_mucdo=2,1,NULL)) dt12,
		count(if(hsht.nghiepvu_anninhquocphong_code_mucdo=1,1,NULL )) dt1,
		count(if(hsht.nghiepvu_anninhquocphong_code_mucdo=2,1,NULL )) dt2,
		count(if(hsht.nghiepvu_anninhquocphong_code_mucdo=3,1,NULL )) dt3,
		count(if(hsht.nghiepvu_anninhquocphong_code_mucdo=4,1,NULL )) dt4,
		count(if(hsht.nghiepvu_anninhquocphong_code_mucdo=5,1,NULL )) dt5,
		";
		return $query;
	}
	
	function numNNkhacLJ(){
		$query = "
		count(if(
		hsht.nghiepvu_ngoaingu_phap_code_mucdo<3 or hsht.nghiepvu_ngoaingu_nga_code_mucdo<3 or hsht.nghiepvu_ngoaingu_duc_code_mucdo<3 or hsht.nghiepvu_ngoaingu_trungquoc_code_mucdo<3 or hsht.nghiepvu_ngoaingu_nhatban_code_mucdo<3 or hsht.nghiepvu_ngoaingu_khac_code_mucdo<3 
		or hsht.nghiepvu_ngoaingu_thailan_code_mucdo<3 or hsht.nghiepvu_ngoaingu_italy_code_mucdo<3 or hsht.nghiepvu_ngoaingu_han_code_mucdo<3 ,1,NULL)) trendaihoc_nnkhac,
		count(if(
		hsht.nghiepvu_ngoaingu_phap_code_mucdo=5 or hsht.nghiepvu_ngoaingu_nga_code_mucdo=5 or hsht.nghiepvu_ngoaingu_duc_code_mucdo=5 or hsht.nghiepvu_ngoaingu_trungquoc_code_mucdo=5 or hsht.nghiepvu_ngoaingu_nhatban_code_mucdo=5 or hsht.nghiepvu_ngoaingu_khac_code_mucdo=5 
		or hsht.nghiepvu_ngoaingu_thailan_code_mucdo=5 or hsht.nghiepvu_ngoaingu_italy_code_mucdo=5 or hsht.nghiepvu_ngoaingu_han_code_mucdo=5,1,NULL)) coso_nnkhac,
		count(if(
		hsht.nghiepvu_ngoaingu_phap_code_mucdo=3 or hsht.nghiepvu_ngoaingu_phap_code_mucdo=4 or hsht.nghiepvu_ngoaingu_nga_code_mucdo=3 or hsht.nghiepvu_ngoaingu_nga_code_mucdo=4 or hsht.nghiepvu_ngoaingu_duc_code_mucdo=3 or hsht.nghiepvu_ngoaingu_duc_code_mucdo=4 or 
		hsht.nghiepvu_ngoaingu_trungquoc_code_mucdo=3 or hsht.nghiepvu_ngoaingu_trungquoc_code_mucdo=4 or hsht.nghiepvu_ngoaingu_nhatban_code_mucdo=3 or hsht.nghiepvu_ngoaingu_nhatban_code_mucdo=4 or hsht.nghiepvu_ngoaingu_khac_code_mucdo=3 or 
		hsht.nghiepvu_ngoaingu_khac_code_mucdo=4 or hsht.nghiepvu_ngoaingu_thailan_code_mucdo=3 or hsht.nghiepvu_ngoaingu_thailan_code_mucdo=4 or hsht.nghiepvu_ngoaingu_italy_code_mucdo=3 or hsht.nghiepvu_ngoaingu_italy_code_mucdo=4 or hsht.nghiepvu_ngoaingu_han_code_mucdo=3 or hsht.nghiepvu_ngoaingu_han_code_mucdo=4
		,1,NULL)) tccd_nnkhac,
		";
		return $query;
	}	
	
	function numQLNNLJ(){
		$query = "
		count(if(hsht.nghiepvu_quanlynhanuoc_code_mucdo=0,1,NULL)) qlnn_cvcc,
		count(if(hsht.nghiepvu_quanlynhanuoc_code_mucdo=1,1,NULL)) qlnn_cvc,
		count(if(hsht.nghiepvu_quanlynhanuoc_code_mucdo=2,1,NULL)) qlnn_cv,
		";
		return $query;
	}	
	
	function numDangvien(){
		$query = " count(if(hsht.dang_danhdaudangvien=1,1,NULL)) dangvien,";
		return $query;
	}

	function numFemale(){
		$query = " count(if(hs.sex='Nu',1,NULL)) nu,";
		return $query;
	}
	
	function numTongso(){
		$query = " count(hs.id) tongso, ";
		return $query;
	}
	
	function numDantoc(){
		$query = " count(if(hs.nat_code<>11,1,NULL)) dantoc ,";
		return $query;		
	}
	
	function numTongiao(){
		$query = " count(if(hs.rcs_code<>8 and hs.rcs_code<>-1 and hs.rcs_code <>0,1,NULL)) tongiao ,";
		return $query;		
	} 
	
	function numDotuoi(){
		$tuoi_nh_nam	=	(float)Core::config('cbcc/template/tuoihuunam');
    	$tuoi_nh_nu		=	(float)Core::config('cbcc/template/tuoihuunu');
		$query = "		
		count(if(TIMESTAMPDIFF(YEAR, hsht.ngaysinh, CURDATE()) <= 30,1,NULL)) duoi30,
		count(if(TIMESTAMPDIFF(YEAR, hsht.ngaysinh, CURDATE()) > 30 and TIMESTAMPDIFF(YEAR, hsht.ngaysinh, CURDATE()) <= 40,1,NULL)) tu30den40,
		count(if(TIMESTAMPDIFF(YEAR, hsht.ngaysinh, CURDATE()) > 40 and TIMESTAMPDIFF(YEAR, hsht.ngaysinh, CURDATE()) <= 50,1,NULL)) tu40den50,
		count(if(TIMESTAMPDIFF(YEAR, hsht.ngaysinh, CURDATE()) > 50,1,NULL)) tren50,
		count(if(TIMESTAMPDIFF(YEAR, hsht.ngaysinh, CURDATE()) > 50 and sex = 'Nu',1,NULL)) nutren50,
		count(if(TIMESTAMPDIFF(YEAR, hsht.ngaysinh, CURDATE()) > 55 and sex = 'Nam',1,NULL)) namtren55,
		count(if
		((TIMESTAMPDIFF(YEAR, hsht.ngaysinh, CURDATE()) > $tuoi_nh_nam and sex = 'Nam') or 
		(TIMESTAMPDIFF(YEAR, hsht.ngaysinh, CURDATE()) > $tuoi_nh_nu and sex = 'Nu')
		,1,NULL)) trentuoihuu,
		count(if((
		TIMESTAMPDIFF(YEAR, hsht.ngaysinh, CURDATE()) > 59 and sex = 'Nam') or 
		(TIMESTAMPDIFF(YEAR, hsht.ngaysinh, CURDATE()) > 54 and sex = 'Nu')
		,1,NULL)) ganvehuu,					
		";
		return $query;		
	}
	
	function numDotuoi2(){
		$tuoi_nh_nam	=	(float)Core::config('cbcc/template/tuoihuunam');
		$tuoi_nh_nu		=	(float)Core::config('cbcc/template/tuoihuunu');
		
		$query = "
		count(if(TIMESTAMPDIFF(YEAR, hsht.ngaysinh, CURDATE()) <= 30,1,NULL)) duoi30,
		count(if(TIMESTAMPDIFF(YEAR, hsht.ngaysinh, CURDATE()) > 30 and TIMESTAMPDIFF(YEAR, hsht.ngaysinh, CURDATE()) <= 45,1,NULL)) tu31den45,
		count(if(TIMESTAMPDIFF(YEAR, hsht.ngaysinh, CURDATE()) > 45 and TIMESTAMPDIFF(YEAR, hsht.ngaysinh, CURDATE()) <= 50,1,NULL)) tu46den50,
		count(if(TIMESTAMPDIFF(YEAR, hsht.ngaysinh, CURDATE()) > 50,1,NULL)) tren50,
		count(if(TIMESTAMPDIFF(YEAR, hsht.ngaysinh, CURDATE()) > 50 and sex = 'Nu',1,NULL)) nutren50,
		count(if(TIMESTAMPDIFF(YEAR, hsht.ngaysinh, CURDATE()) > 55 and sex = 'Nam',1,NULL)) namtren55,
		count(if
		((TIMESTAMPDIFF(YEAR, hsht.ngaysinh, CURDATE()) > $tuoi_nh_nam and sex = 'Nam') or 
		(TIMESTAMPDIFF(YEAR, hsht.ngaysinh, CURDATE()) > $tuoi_nh_nu and sex = 'Nu')
		,1,NULL)) trentuoihuu,
		count(if((
		TIMESTAMPDIFF(YEAR, hsht.ngaysinh, CURDATE()) > 59 and sex = 'Nam') or 
		(TIMESTAMPDIFF(YEAR, hsht.ngaysinh, CURDATE()) > 54 and sex = 'Nu')
		,1,NULL)) ganvehuu,
		";
		return $query;
	}
	
	function numCongtacLJ(){
		$query = "
		count(if(floor(datediff(curdate(),qtct.start_date_ct))/365 <= 5,1,NULL)) duoi5,
		count(if(floor(datediff(curdate(),qtct.start_date_ct))/365 > 5 and floor(datediff(curdate(),qtct.start_date_ct))/365<=15,1,NULL)) tu6den15,
		count(if(floor(datediff(curdate(),qtct.start_date_ct))/365 > 15 and floor(datediff(curdate(),qtct.start_date_ct))/365<=30,1,NULL)) tu16den30,
		count(if(floor(datediff(curdate(),qtct.start_date_ct))/365 > 30,1,NULL)) tren30,
		";
		return $query;
	}
	
	function numThamnienLJ(){
		$query = "
		count(if(floor(datediff(curdate(),thamnien.start_date_ct))/365 <= 6,1,NULL)) thamnienduoi6,
		count(if(floor(datediff(curdate(),thamnien.start_date_ct))/365 > 6 and floor(datediff(curdate(),thamnien.start_date_ct))/365<=10,1,NULL)) thamnientu6den10,
		count(if(floor(datediff(curdate(),thamnien.start_date_ct))/365 > 10,1,NULL)) thamnientren10,
		";
		return $query;
	}
	
	function numChucvuDang(){
		$query = " count(if(hsht.dang_chucvudang_id > 0,1,NULL)) chucvudang,";
		return $query;
	}
	
	function numHDND(){
		$query = " count(if(hs.elec_comm>0,1,NULL)) hdndxa,";
		return $query;
	}
/**
 * Đối tượng thu hút
 */
	function dtth_namthuhut(){
		$query = " DATE_FORMAT(qtdt.ngay_botri,'%Y') year_thuhut, ";
		return $query;
	}
	
	function dtth_chucvutuongduong(){
		$query = " count(if(hsht.congtac_chucvutuongduong=1 or hsht.congtac_chucvutuongduong=2,1,NULL)) cttp, 
	        count(if((hsht.congtac_chucvutuongduong=4 or hsht.congtac_chucvutuongduong=5) and dv.ins_cap=3,1,NULL)) ctquan, 
	        count(if(((hsht.congtac_chucvutuongduong=3 or hsht.congtac_chucvutuongduong=4) and (dv.ins_cap=1 or dv.ins_loaihinh=2)),1,NULL)) gdso, 
	        count(if((hsht.congtac_chucvutuongduong=6 or hsht.congtac_chucvutuongduong=7) and dv.ins_cap=3,1,NULL)) tpquan, 
	        count(if(((hsht.congtac_chucvutuongduong=5 or hsht.congtac_chucvutuongduong=6) and (dv.ins_cap=1 or dv.ins_loaihinh=2)),1,NULL)) truongphongso, 
	        count(if(((hsht.congtac_chucvutuongduong=5 or hsht.congtac_chucvutuongduong=6) and (dv.ins_cap=2 or dv.ins_loaihinh=2)),1,NULL)) truongdvso, 
	        count(if(((hsht.congtac_chucvutuongduong=7 or hsht.congtac_chucvutuongduong=8) and (dv.ins_cap=2 or dv.ins_loaihinh=2 or dv.ins_loaihinh=2)),1,NULL)) truongphongdvso, 
	        count(if((hsht.congtac_chucvutuongduong=6 or hsht.congtac_chucvutuongduong=7) and dv.ins_loaihinh=2,1,NULL)) truongdvquan, 
	        count(if((hsht.congtac_chucvutuongduong=8 or hsht.congtac_chucvutuongduong=9) and (dv.ins_loaihinh=2 or dv.ins_loaihinh=2),1,NULL)) truongphongdvquan,  
		";
		return $query;
	}
	
	function dtth_loaidoituong(){
		$query = " COUNT(if(qtdt.loaidoituong_id = 2,1,NULL)) dean,
			COUNT(if(qtdt.loaidoituong_id = 3,1,NULL)) dungdt,
			COUNT(if(qtdt.loaidoituong_id = 4,1,NULL)) vandung,
			COUNT(if(qtdt.loaidoituong_id = 5,1,NULL)) giaoduc, ";
		return $query;
	}
	
	function dtth_nuocdaotao(){
		$query = " COUNT(if(hsht.doituong_nuocdaotao IS NOT NULL AND hsht.doituong_nuocdaotao<>'' AND hsht.doituong_nuocdaotao <>'Việt Nam' ,1,NULL)) nuocngoai, ";
		return $query;
	}
	
	function dtth_qlnhanuoc(){
		$query = " COUNT(if(hsht.nghiepvu_quanlynhanuoc_code IS NOT NULL AND hsht.nghiepvu_quanlynhanuoc_code<>'',1,NULL)) qlnn, ";
		return $query;
	}
	
	function dhth_nghiviec(){
		$query = " COUNT(if(hsht.hoso_trangthai='03',1,NULL)) nghiviec, ";
		return $query;
	}
	
	function dtth_loaihinh(){
		$query = " COUNT(IF(dv.ins_loaihinh=1,1,NULL)) hc,
			COUNT(IF(dv.ins_loaihinh=2,1,NULL)) sn,
			COUNT(IF(dv.ins_loaihinh<1 AND dv.ins_loaihinh>2,1,NULL)) khac,
		";
		return $query;
	}
	
	function dtth_chinhtri(){
		$query = " COUNT(IF(hsht.nghiepvu_lyluanchinhtri_code_mucdo < 4,1,NULL)) caocap, ";
		return $query;
	}
	function dtth_daotaothem(){
		$query = " COUNT(IF(tdo.step_2 < tdo_thuhut.step_2,1,NULL)) daotaothem,	";
		return $query;
	}
	function dtth_trinhdo(){
		$query	= "
			count(if(tdo_thuhut.STEP=3,1,NULL)) th_daihoc,
			count(if(tdo_thuhut.step = 2 ,1,NULL)) th_thacsi,
			count(if(tdo_thuhut.step=1,1,NULL)) th_tiensi,
			count(if(tdo_thuhut.step>3 or hsht.doituong_trinhdo_code IS NULL or hsht.doituong_trinhdo_code='' ,1,NULL)) trinhdo_khac,
		";
		return $query;
	} 
	
# Thống kê nhanh
	function tkn_sumhsht(){
		$query	=	' COUNT(hsht.hosochinh_id) as tongso, SUM(IF((hsht.dang_danhdaudangvien = 1	), 1, 0 ))AS dangvien,
		SUM(IF(( hsht.bienche_hinhthuc_id IN(2, 3, 25)	),	1,	0))AS bienche_roi,
		SUM(IF(( hsht.bienche_hinhthuc_id = 4 ),1,	0)) AS hd_68,
		SUM(IF(	(hsht.bienche_hinhthuc_id = 12	),	1,	0))AS hd_trongchitieu,
		SUM(IF(	( hsht.bienche_hinhthuc_id = 13	),	1,	0))AS hd_ngoaichitieu,
		SUM(IF(	( hsht.bienche_hinhthuc_id = 15	),	1,	0))AS hd_thuhutdean,
		SUM(IF(	( hsht.bienche_hinhthuc_id NOT IN(2, 3, 25, 15, 13, 12, 4)	),	1,	0))AS hd_khac,
		SUM(IF(	( hsht.gioitinh = "Nu"	),	1,	0))AS nu,
		SUM(IF(	( hsht.chuyenmon_trinhdo_mucdo = 1	),	1,	0))AS td_tiensi,
		SUM(IF(	( hsht.chuyenmon_trinhdo_mucdo = 2	),	1,	0))AS td_thacsi,
		SUM(IF(	( hsht.chuyenmon_trinhdo_mucdo = 3	),	1,	0))AS td_daihoc,
		SUM(IF(	( hsht.chuyenmon_trinhdo_mucdo = 4	),	1,	0))AS td_caodang,
		SUM(IF(	( hsht.chuyenmon_trinhdo_mucdo = 5	),	1,	0))AS td_trungcap,
		SUM(IF(	((	hsht.chuyenmon_trinhdo_mucdo = 0 )	OR isnull(hsht.chuyenmon_trinhdo_mucdo)	OR(	hsht.chuyenmon_trinhdo_mucdo = 6)),	1,	0))AS td_khac, ';
		return $query;
	}	
	function tkn_sumngach(){
		$query	=	' SUM(IF((cbng.cap = 1), 1,	0))AS ngach_cvcc,
		SUM(IF(	(cbng.cap = 2),	1,	0))AS ngach_cvc,
		SUM(IF(	(cbng.cap = 3),	1,	0))AS ngach_cv,
		SUM(IF(	(cbng.cap = 4),	1,	0))AS ngach_cs,
		SUM(IF(	((cbng.cap > 4)	OR isnull(cbng.cap)	),	1,	0))AS ngach_khac ';
		return $query;
	}
# end thống kê nhanh
# Tăng giảm biên chế
	function tgbc_sumbienche(){
		$query	=	' COUNT( tbc.hosochinh_id)  AS tongbienche, COUNT(IF(tbc.htbienche = 4,1,0)) AS hd68,
	COUNT(IF(tbc.htbienche = 2 AND qtct.chucvu_id > 0, 1, 0))AS chucvulanhdao,
	COUNT(IF(tbc.htbienche = 2 AND (qtct.chucvu_id is null or qtct.chucvu_id <= 0), 1, 0))AS chucdanhchuyenmon  ';
		return $query;
	}
	function tgbc_sumbienche_donvisn(){
		$query	=	' COUNT( tbc.hosochinh_id)  AS tongbienche,
 		COUNT(bchd.hosochinh_id) AS hd68, COUNT(bchc.hosochinh_id) AS bchanhchinh, COUNT(bcsn.hosochinh_id) AS bcsunghiep ';
		return $query;
	}
# end tăng giảm biên chế

}

