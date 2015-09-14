<?php
class Baocaothongke_Model_Left extends JModelLegacy
{
	/**
	 *  Ánh xạ iddv_config => ins_dept để so sánh trong bảng hồ sơ chính
	 * @param integer id_donvi
	 * @return select
	 */
	function config_donvi($iddv_config){
		$query = " INNER JOIN (
			SELECT node.ins_dept FROM config_donvi_bc AS node, config_donvi_bc AS parent 
			 WHERE node.lft BETWEEN parent.lft AND parent.rgt AND parent.id = $iddv_config
			) AS dvbc ON hsht.congtac_donvi_id = dvbc.ins_dept "	;
		return $query;
	}
	function config_donvi_dept($iddv_config){
		$query = " INNER JOIN (
		SELECT node.ins_dept FROM config_donvi_bc AS node 
		WHERE node.id = $iddv_config
		) AS dvbc ON hsht.congtac_phong_id = dvbc.ins_dept "	;
		return $query;
	}
	/**
	 *  Ánh xạ iddv_config => ins_dept để so sánh trong bảng hồ sơ chính lấy dữ liệu đến cấp fog
	 * @param integer id_donvi
	 * @return select
	 */
	
// 	function config_donvi_dept($iddv_config){
// 		$query = " INNER JOIN (
// 		SELECT node.ins_dept , IF (node.type = 0, node.type, node.ins_dept) as phongcongtac, node.type
// 		FROM config_donvi_bc AS node, config_donvi_bc AS parent
// 		WHERE node.lft BETWEEN parent.lft AND parent.rgt AND parent.id = $iddv_config
// 		) AS dvbc ON hsht.congtac_donvi_id = dvbc.ins_dept or (hsht.congtac_phong_id = dvbc.phongcongtac and dvbc.type <> 0)";
// 		return $query;
// 	}
	
	function getInsdept($donvi_id){
		$query = " INNER JOIN (
		SELECT node.id FROM ins_dept AS node, ins_dept AS parent
		WHERE node.lft BETWEEN parent.lft AND parent.rgt AND parent.id = $donvi_id
		) AS dvbc ON hsht.congtac_donvi_id = dvbc.id "	;
		return $query;
	}

	function hosochinh_quatrinhhientai(){
		$query = " inner join hosochinh_quatrinhhientai as hsht ON hs.id = hsht.hosochinh_id ";
		return $query;
	}
	function donvi(){
		$query = " left join ins_dept dv ON hsht.congtac_donvi_id = dv.id ";				
		return $query;
	}
	function kiemnhiem(){
		$query = " LEFT JOIN ct_kiemnhiembietphai as kn on kn.emp_id_knbp = hs.id  ";
		return $query;
	}
	function trinhdo(){
		$query = " left join cla_sca_code td on hsht.sca_code=td.code and td.tosc_code=2 ";
		return $query;
	}
	
	function chinhtri(){
		$query = " left join cla_sca_code ctri on hsht.nghiepvu_lyluanchinhtri_code = ctri.code and ctri.tosc_code=3 ";
		return $query;
	}	
	
	function qlnn(){
		$query = " left join cla_sca_code qlnn on hsht.nghiepvu_quanlynhanuoc_code = qlnn.code and qlnn.tosc_code=5 ";
		return $query;
	}	

	function tinhoc(){
		$query = " left join cla_sca_code tinhoc on hsht.it_code=tinhoc.code and tinhoc.tosc_code=7 ";
		return $query;
	}	
	
	function tienganh(){
		$query = " left join cla_sca_code tienganh on hsht.eng_code=tienganh.code and tienganh.tosc_code=6 ";
		return $query;
	}	
	
// 	function nnkhac(){
// 		$query = " left join cla_sca_code phap on hs.phap_code=phap.code and phap.tosc_code=6 ";
// 		$query .= " left join cla_sca_code nga on hs.nga_code=nga.code and nga.tosc_code=6 ";
// 		$query .= " left join cla_sca_code duc on hs.duc_code=duc.code and duc.tosc_code=6 ";
// 		$query .= " left join cla_sca_code trungquoc on hs.trungquoc_code=trungquoc.code and trungquoc.tosc_code=6 ";
// 		$query .= " left join cla_sca_code nhatban on hs.nhatban_code=nhatban.code and nhatban.tosc_code=6 ";
// 		$query .= " left join cla_sca_code nnkhac on hs.ngoaingukhac=nnkhac.code and nnkhac.tosc_code=6 ";
// 		$query .= " left join cla_sca_code thailan on hs.thailan_code=thailan.code and thailan.tosc_code=6 ";
// 		$query .= " left join cla_sca_code italy on hs.italy_code=italy.code and italy.tosc_code=6 ";
// 		$query .= " left join cla_sca_code han on hs.han_code=han.code and han.tosc_code=6 ";
// 		return $query;
// 	}
	
	function nganhNgach(){
		$query = " left join cb_bac_heso bacheso on hsht.luong_mangach=bacheso.mangach ";
		return $query;
	}
	
	function congtac(){
		$query = " left join quatrinhcongtac as qtct on
		(
			hs.id=qtct.emp_id_ct and
			qtct.start_date_ct = (select min(start_date_ct) from quatrinhcongtac where emp_id_ct=hs.id  )
		)
		";
		return $query;
	}
	
	/**
	 * Dựa vào chức vụ truyền vào lấy ra thâm niên
	 * @param unknown $pos_sys
	 * @return string
	 */
	function thamnien($pos_sys){
		$pos = explode("=",str_replace(")","",trim($pos_sys)));
	
		$query = " left join quatrinhcongtac as thamnien on
		(
		hs.id=thamnien.emp_id_ct and
		thamnien.start_date_ct = (select min(start_date_ct) from quatrinhcongtac where quatrinhcongtac.emp_id_ct=hs.id and quatrinhcongtac.pos_sys_fk = '$pos[1]' )
		)
		";
		return $query;
	}
	/**
	 * Dựa vào năm và chức vụ lấy ra quá trình ctác
	 * @param integer $namlv
	 * @param String $chucvu
	 * @return string
	 */
	function quatrinhcongtac($namlv, $chucvu){
		$query = '';
		if ($chucvu != '') {
// 			$query	=	'INNER JOIN (
// 			select DISTINCT emp_id_ct  from quatrinhcongtac as ct
// 			INNER JOIN cb_goichucvu_chucvu AS gcv ON gcv.pos_system_id = ct.pos_sys_fk 
// 			INNER JOIN pos_system as ps on ps.id = ct.pos_sys_fk
// 			WHERE 
// 			(YEAR(start_date_ct) BETWEEN ('.$namlv.' - (gcv.thoihanbonhiem/12)) AND '.$namlv.') 
// 			and ps.muctuongduong in ('.$chucvu.')
// 			) qtct ON qtct.emp_id_ct = hs.id';

// 			end_date_ct is null and start_date_ct < '2015-12-31') or end_date_ct BETWEEN '2015-01-01' AND '2015-21-31
			
			$query	=	'INNER JOIN (
			select DISTINCT emp_id_ct  from quatrinhcongtac as ct
			
			INNER JOIN pos_system as ps on ps.id = ct.pos_sys_fk
			WHERE
			( YEAR(start_date_ct) <= '.$namlv.') and (end_date_ct is null or YEAR(end_date_ct) >= '.$namlv.')
			and ps.muctuongduong in ('.$chucvu.')
			) qtct ON qtct.emp_id_ct = hs.id';
		}
		return $query;
	}
	function dtth_cla_sca_code(){
		$query = "  LEFT JOIN cla_sca_code  tdo ON hsht.chuyenmon_trinhdo_code=tdo.code AND tdo.tosc_code=2
       		LEFT JOIN cla_sca_code tdo_thuhut ON hsht.doituong_trinhdo_code=tdo_thuhut.code AND tdo_thuhut.tosc_code=2 ";
		return $query;
	}
	function quatrinhdoituong(){
		$query = " INNER JOIN dtdb_quatrinhdoituong as qtdt ON qtdt.emp_id_dtdb = hs.id  ";
		return $query;
	}
	
	function loaidoituong(){
		$query = " INNER JOIN dtdb_doituongloai as ldt ON ldt.id = qtdt.loaidoituong_id	  ";
		return $query;
	}
	function dtth_donvi(){
		$query = " inner join ins_dept as dv on dvbc.ins_dept = dv.id ";
		return  $query;
	}
	function dtth_phong(){
		$query = " inner join ins_dept as dv on hsht.congtac_phong_id = dv.id ";
		return  $query;
	}
	
# Thống kê nhanh
	function tkn_ngach(){
		$query	=	' LEFT JOIN cb_bac_heso as cbhs ON	cbhs.mangach = hsht.luong_mangach';
		return $query;
	}
	function tkn_nhomngach(){
		$query	=	' LEFT JOIN cb_nhomngach as cbng ON cbhs.manhom = cbng.id';
		return $query;
	}
#end thống kê nhanh
# Tăng giảm biên chế
	
	function tgbc_tongquatrinh_cc($ngaybc){
		$query = " INNER JOIN ( SELECT MAX(bc.ngaybatdau) as ngaybatdau, hsht.hosochinh_id, bc.hinhthuc_id as htbienche  from hosochinh_quatrinhhientai as hsht
		INNER JOIN bc_quatrinhbienche  as bc ON bc.emp_id_bc = hsht.hosochinh_id
		WHERE bc.hinhthuc_id IN (2, 4) and ((
	  bc.ngaybatdau <= STR_TO_DATE('$ngaybc','%d/%m/%Y')
	  AND bc.ngayketthuc IS NULL )
	 OR( bc.ngaybatdau <= STR_TO_DATE('$ngaybc','%d/%m/%Y')
	  AND bc.ngayketthuc >= STR_TO_DATE('$ngaybc','%d/%m/%Y')))
		GROUP BY bc.emp_id_bc) AS tbc ON hsht.hosochinh_id = tbc.hosochinh_id  ";
		return $query;
	}
	function tgbc_quatrinhcongtac($ngaybc){
		$query = " LEFT JOIN (SELECT 
		MAX(ct.start_date_ct) as ngaybatdau, hsht.hosochinh_id, ct.pos_sys_fk as chucvu_id  from hosochinh_quatrinhhientai as hsht
		INNER JOIN quatrinhcongtac  as ct ON ct.emp_id_ct = hsht.hosochinh_id
		WHERE  ( ct.start_date_ct <= STR_TO_DATE('$ngaybc','%d/%m/%Y')  AND ct.end_date_ct IS NULL )
		OR( ct.start_date_ct <= STR_TO_DATE('$ngaybc','%d/%m/%Y')  AND ct.end_date_ct >= STR_TO_DATE('$ngaybc','%d/%m/%Y'))
		GROUP BY ct.emp_id_ct
		ORDER BY hsht.hosochinh_id
		) AS qtct ON hsht.hosochinh_id = qtct.hosochinh_id  ";
		return $query;
	}
	
	function tgbc_tongquatrinh($ngaybc){
		$query = " INNER JOIN ( SELECT MAX(bc.ngaybatdau) as ngaybatdau, hsht.hosochinh_id  from hosochinh_quatrinhhientai as hsht
		INNER JOIN bc_quatrinhbienche  as bc ON bc.emp_id_bc = hsht.hosochinh_id
		WHERE bc.hinhthuc_id IN (2, 3, 4, 25) and bc.ngaybatdau <= STR_TO_DATE('$ngaybc','%d/%m/%Y')
		GROUP BY bc.emp_id_bc) AS tbc ON hsht.hosochinh_id = tbc.hosochinh_id  ";
		return $query;
	}
	function tgbc_hd68($ngaybc){
		$query = " LEFT JOIN ( SELECT MAX(bc.ngaybatdau) as ngaybatdau, hsht.hosochinh_id  from hosochinh_quatrinhhientai as hsht
		INNER JOIN bc_quatrinhbienche  as bc ON bc.emp_id_bc = hsht.hosochinh_id
		WHERE bc.hinhthuc_id = 4 and bc.ngaybatdau <= STR_TO_DATE('$ngaybc','%d/%m/%Y')
		GROUP BY bc.emp_id_bc) AS bchd ON hsht.hosochinh_id = bchd.hosochinh_id  ";
		return $query;
	}
	function tgbc_hanhchinh($ngaybc){
		$query = " LEFT JOIN ( SELECT MAX(bc.ngaybatdau) as ngaybatdau, hsht.hosochinh_id  from hosochinh_quatrinhhientai as hsht
		INNER JOIN bc_quatrinhbienche  as bc ON bc.emp_id_bc = hsht.hosochinh_id
		WHERE bc.hinhthuc_id = 2 and bc.ngaybatdau <= STR_TO_DATE('$ngaybc','%d/%m/%Y') 
		GROUP BY bc.emp_id_bc) AS bchc ON hsht.hosochinh_id = bchc.hosochinh_id ";
		//and bchc.ngaybatdau <= STR_TO_DATE('$ngaybc','%d/%m/%Y') 
		return $query;
	}
	function tgbc_sunghiep($ngaybc){
		$query = " LEFT JOIN ( SELECT MAX(bc.ngaybatdau) as ngaybatdau, hsht.hosochinh_id  from hosochinh_quatrinhhientai as hsht
		INNER JOIN bc_quatrinhbienche  as bc ON bc.emp_id_bc = hsht.hosochinh_id
		WHERE bc.hinhthuc_id IN (3, 25) and bc.ngaybatdau <= STR_TO_DATE('$ngaybc','%d/%m/%Y') 
		GROUP BY bc.emp_id_bc) AS bcsn ON hsht.hosochinh_id = bcsn.hosochinh_id ";
		//and bcsn.ngaybatdau <= STR_TO_DATE('$ngaybc','%d/%m/%Y') 
		return $query;
	}
# end tăng giảm biên chế
}


