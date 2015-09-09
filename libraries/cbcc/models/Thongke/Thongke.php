<?php
defined('_JEXEC') or die( 'Restricted access' );
class Thongke_Model_Thongke extends JModelLegacy{
	/**
	 * 
	 * @param array|string $field
	 * @param string $table
	 * @param array $arrJoin ar(key, val)
	 * @param array $where arr(val, val)
	 * @param string $order
	 * @return Object
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
		if($order!=null)$query->order($order);
		$db->setQuery($query);
		return $db->loadObjectList();
	}
	
	public function getDanhsach($donvi_id, $hinhthuc, $bienche_id){
	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
	$query= 'select distinct(hsc.id), hsc.e_name,
			date_format(qtbienche_first.ngaybatdau, "%d/%m/%Y") as ngaybatdau1,
			date_format(qtbienche_second.ngaybatdau, "%d/%m/%Y") ngaybatdau2, 
			qthientai.ngaysinh, qthientai.danhdaunamsinh, 
			qthientai.luong_tenngach, qthientai.luong_bac, qthientai.luong_heso, 
			qthientai.congtac_chucvu, qthientai.congtac_phong_id, ins.name congtac_phong   
			from hosochinh hsc
			join bc_quatrinhbienche qtbienche_first on qtbienche_first.emp_id_bc = hsc.id
			join bc_quatrinhbienche qtbienche_second on qtbienche_second.emp_id_bc = hsc.id
			join hosochinh_quatrinhhientai  qthientai on qthientai.hosochinh_id= hsc.id 
			left join ins_dept ins on qthientai.congtac_phong_id = ins.id
			where
			qthientai.congtac_donvi_id ='.$donvi_id.'
					AND qtbienche_second.ngaybatdau >= qtbienche_first.ngaybatdau
				AND qtbienche_first.hinhthuc_id IN ('.$hinhthuc.')
						and qtbienche_second.hinhthuc_id in ('.$bienche_id.')
						and qtbienche_second.id = ( 
								-- lấy ra id của hình thức ngay sau hình thức tập sự
					select id from bc_quatrinhbienche c
					where c.emp_id_bc= hsc.id and qthientai.hoso_trangthai="00"
					AND c.ngaybatdau>= qtbienche_first.ngaybatdau
					order by (c.hinhthuc_id IN ('.$hinhthuc.')) desc ,c.ngaybatdau asc
					limit 1,1
					)';
		$db->setQuery($query);
			return $db->loadObjectList();
	}
	public function getGiahanhdld($donvi_id, $hinhthuc){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query= 'select distinct(hsc.id), hsc.e_name,
			date_format(qtbienche_first.ngaybatdau, "%d/%m/%Y") as ngaybatdau1,
			date_format(qtbienche_second.ngaybatdau, "%d/%m/%Y") ngaybatdau2,
			qthientai.ngaysinh, qthientai.danhdaunamsinh,
			qthientai.luong_tenngach, qthientai.luong_bac, qthientai.luong_heso,
			qthientai.congtac_chucvu, qthientai.congtac_phong_id, ins.name congtac_phong
			from hosochinh hsc
			join bc_quatrinhbienche qtbienche_first on qtbienche_first.emp_id_bc = hsc.id
			join bc_quatrinhbienche qtbienche_second on qtbienche_second.emp_id_bc = hsc.id
			join hosochinh_quatrinhhientai  qthientai on qthientai.hosochinh_id= hsc.id
			left join ins_dept ins on qthientai.congtac_phong_id = ins.id
			where
			qthientai.congtac_donvi_id ='.$donvi_id.'
					AND qtbienche_second.ngaybatdau >= qtbienche_first.ngaybatdau
				AND qtbienche_first.hinhthuc_id IN ('.$hinhthuc.')
						and qtbienche_second.hinhthuc_id in ('.$hinhthuc.')
						and qtbienche_second.id = (
								-- lấy ra id của hình thức ngay sau hình thức tập sự
					select id from bc_quatrinhbienche c
					where c.emp_id_bc= hsc.id and qthientai.hoso_trangthai="00"
					AND c.ngaybatdau>= qtbienche_first.ngaybatdau
					order by c.ngaybatdau asc
					limit 1,1
					)';
		$db->setQuery($query);
		return $db->loadObjectList();
	}
}