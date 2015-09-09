<?php
defined('_JEXEC') or die( 'Restricted access' );
class Thongke_Model_Bcdaotaoboiduong extends JModelLegacy{
// 	private function laytatcahoso($donvi_id){
// 		$db = JFactory::getDbo();
// 		$query = $db->getQuery(true);
// 		$query->select('*')
// 		->from('hosochinh_quatrinhhientai hsht')
// 		->join('INNER', 'daotao_lophoc_hocvien lhhv ON lhhv.hocvien_id=hsht.hosochinh_id')
// 		->join('INNER', ' ins_dept dv ON hsht.congtac_donvi_id = dv.id AND dv.lft BETWEEN (SELECT lft FROM ins_dept WHERE id = '.$db->quote($donvi_id).') AND (SELECT rgt FROM ins_dept WHERE id = '.$db->quote($donvi_id).')');
// 	} 
	function hienthiBaocao($donvi_id, $target, $condition,$tungay, $denngay){
		$db = JFactory::getDbo();
		if($target==1){
				if ($condition == 1) {$chucvu='11012,11016';}
				elseif ($condition == 2) {$chucvu='11020,11024';}
				elseif ($condition == 3) {$chucvu='11111,11114';}
				elseif ($condition == 4) {$chucvu='11028,11032,11120,11117';}
				$json = $this->countBaocao($donvi_id,null ,$tungay,$denngay,  "INNER JOIN quatrinhcongtac ct ON hv.hocvien_id = ct.emp_id_ct AND ct.pos_sys_fk IN $db->quote($chucvu) AND lh.ngaybatdau >= ct.start_date_ct AND (lh.ngaybatdau <= ct.end_date_ct OR ct.end_date_ct IS NULL)");
		}elseif ($target==2){
				if ($condition==1) $con_luong='01001';
				elseif ($condition==2) $con_luong='01002';
				elseif ($condition==3) $con_luong='01003';
				elseif ($condition==4) $con_luong='01004';
				$json = $this->countBaocao($donvi_id,null ,$tungay,$denngay,  "INNER JOIN 
									(	select DISTINCT(sal.emp_id_sal) from quatrinhluong sal, daotao_lophoc_hocvien hv, daotao_lophoc lh
										where hv.hocvien_id = sal.emp_id_sal AND  lh.ngaybatdau >=sal.start_date_sal AND (lh.ngaybatdau <= sal.end_date_sal OR sal.end_date_sal IS NULL) 
										AND sal.sta_code_sal = $db->quoteName($con_luong)
									) as qtl ON qtl.emp_id_sal = c.hosochinh_id
						INNER JOIN (SELECT distinct(ct.emp_id_ct) FROM quatrinhcongtac ct, daotao_lophoc_hocvien hv, daotao_lophoc lh  
												where hv.hocvien_id = ct.emp_id_ct  
												AND ct.pos_sys_fk IS NULL  
												AND lh.ngaybatdau >= ct.start_date_ct 
												AND (lh.ngaybatdau <= ct.end_date_ct OR ct.end_date_ct IS NULL) order by ct.start_date_ct) 
						as congtac ON congtac.emp_id_ct = c.hosochinh_id"); 
		}elseif ($target ==4){
				if ($condition==1) $con_daibieu=' and b.elec_prov = 1';
				elseif($condition==2) $con_daibieu='and b.elec_dist = 1';
				elseif($condition==3) $con_daibieu='and b.elec_comm = 1';
				$json = $this->countBaocao($donvi_id, $con_daibieu, $tungay, $denngay);
		}elseif($target==5 || $target==6){
				if ($condition==1) $con_px='canbopx';
				elseif($condition==2) $con_px='congchucpx';
				elseif($condition==3) $con_px='kctpx';
				$json = $this->countBaocao($donvi_id, null,$tungay,$denngay,"INNER JOIN quatrinhcongtac ct ON hv.hocvien_id = ct.emp_id_ct AND lh.ngaybatdau >= ct.start_date_ct AND (lh.ngaybatdau <= ct.end_date_ct OR ct.end_date_ct IS NULL) AND ct.pos_sys_fk IN(select relation_id from config_bc where report_group_code like '$db->quote($con_px)')");
	}elseif($target==0)
				$json = $this->countBaocao($donvi_id,'',$tungay,$denngay);
		return $json;									
	}
	/**
	 * Tính báo cáo đào tạo bồi dưỡng cán bộ, công chức, viên chức
	 * @param int $donvi_id
	 * @param string $where
	 * @param string $tungay
	 * @param string $denngay
	 * @param string $join
	 * @return Ambigous <mixed, NULL>
	 */
	function countBaocao($donvi_id, $where=null, $tungay=null, $denngay=null, $join=null){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query="SELECT
		 count(IF(b.sex = 'Nu', 1, NULL)) nu,
		 count(IF(b.nat_code != 11, 1, NULL)) thieuso,
		 count(b.id) tongso,
		 -- lý luận chính trị
		 count(IF(ctri.step < 3, 1, NULL))caocap_ctri,
		 count(IF(ctri.step = 4, 1, NULL))trungcap_ctri,
		 count(IF(ctri.step = 5, 1, NULL))socap_ctri,
		 count(IF(ctri.step > 5, 1, NULL))cunhan_ctri,
		 -- quản lý nhà nước
		 count(IF(qlnn.step = 0, 1, NULL))qlnn_cvcc,
		 count(IF(qlnn.step = 1, 1, NULL))qlnn_cvc,
		 count(IF(qlnn.step = 2, 1, NULL))qlnn_cv,
		 count(IF(qlnn.step = 3, 1, NULL))qlnn_cansu,
		 -- Chuyên môn
		 count(IF(td.step = 1, 1, NULL))cm_tiensi,
		 count(IF(td.step = 2, 1, NULL))cm_thacsi,
		 count(IF(td.step = 3, 1, NULL))cm_daihoc,
		 count(IF(td.step = 4, 1, NULL))cm_caodang,
		 count(IF(td.step = 5, 1, NULL))cm_trungcap,
		 count(IF(td.step >= 6, 1, NULL))cm_socap,
		 -- tin học
		 count(IF(tinhoc.step >= 0, 1, NULL))tong_tinhoc,
		 -- ngoại ngữ
		 count(IF(ngoaingu.step >= 0, 1, NULL))tong_ngoaingu,
		 -- quốc phòng an ninh
		 count(IF(qphong.step > 0, 1, NULL))qphong_tong,
		 -- bồi dưỡng 
		 count(IF(boiduong.code = 1, 1, NULL))quanly,
		 count(IF(boiduong.code = 2, 1, NULL))chuyenmon,
		 count(IF(boiduong.code = 3, 1, NULL))tiengdantoc,
		 count(IF(boiduong.code = 4, 1, NULL))khac 
		FROM
		 daotao_lophoc lh
		INNER JOIN daotao_lophoc_hocvien hv ON lh.id = hv.lophoc_id 
		INNER JOIN hosochinh b ON hv.hocvien_id = b.id
		INNER JOIN hosochinh_quatrinhhientai c ON hv.hocvien_id = c.hosochinh_id
		$join
		INNER JOIN ins_dept dv ON hv.donvi_id = dv.id
		AND dv.lft BETWEEN (SELECT lft FROM ins_dept WHERE id = $donvi_id) AND (SELECT rgt FROM ins_dept WHERE id = $donvi_id)
		LEFT JOIN cla_sca_code tinhoc ON lh.loaitrinhdo_id = tinhoc.tosc_code AND tinhoc.tosc_code = 7 AND lh.trinhdo_id = tinhoc.`code`
		LEFT JOIN cla_sca_code ctri ON lh.loaitrinhdo_id = ctri.tosc_code AND ctri.tosc_code = 3 AND lh.trinhdo_id = ctri.`code`
		LEFT JOIN cla_sca_code boiduong ON lh.loaitrinhdo_id = boiduong.tosc_code	AND boiduong.tosc_code = 18 AND lh.trinhdo_id = boiduong.`code`
		LEFT JOIN cla_sca_code td ON lh.loaitrinhdo_id = td.tosc_code AND td.tosc_code = 2 AND lh.trinhdo_id = td.`code`
		LEFT JOIN cla_sca_code qphong ON lh.loaitrinhdo_id = qphong.tosc_code AND qphong.tosc_code = 17 AND lh.trinhdo_id = qphong.`code`
		LEFT JOIN cla_sca_code qlnn ON lh.loaitrinhdo_id = qlnn.tosc_code AND qlnn.tosc_code = 5 AND lh.trinhdo_id = qlnn.`code`
		LEFT JOIN cla_sca_code ngoaingu ON lh.loaitrinhdo_id = ngoaingu.tosc_code AND ngoaingu.tosc_code = 6 AND lh.trinhdo_id = ngoaingu.`code`
  		WHERE lh.status = 3
		AND lh.ngaybatdau >= STR_TO_DATE('$tungay', '%d/%m/%Y')
		AND lh.ngayketthuc <= STR_TO_DATE('$denngay', '%d/%m/%Y')";
		if($where!="" || $where!=null) $query .= $where;
		$donviloaitru = Core::getUnManageDonvi(JFactory::getUser()->id, 'com_thongke', 'treeview' ,'treebcdaotaoboiduong');
		if($donviloaitru!='')
			$query.=' and (dv.id NOT IN ('.$donviloaitru.') AND c.congtac_phong_id NOT IN ('.$donviloaitru.'))';
// 		echo $query;exit;
		$db->setQuery($query);
		return $db->loadObject();
	}
	/**
	 * Hàm lấy thông tin bảng, dựa theo các field, table, table join, where và order
	 * @param array $field
	 * @param string $table
	 * @param array $arrJoin
	 * @param array $where
	 * @param string $order
	 * @return Ambigous <mixed, NULL, multitype:unknown mixed >
	 */
	function getThongtin($field, $table, $arrJoin=null, $where=null, $order=null){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select($field)
		->from($table);
		if (count($arrJoin)>0)
			foreach ($arrJoin as $key=>$val){
				$query->join($key, $val);
			}
		for($i=0;$i<count($where);$i++)
			if ($where[$i]!='')
				$query->where($where);
		if($order!=null) $query->order($order);
		$db->setQuery($query);
		return $db->loadObjectList();
	}
}