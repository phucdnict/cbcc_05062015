<?php
/**
 * Author: Phucnh
 * Date created: Aug 13, 2015
 * Company: DNICT
 */
class Thonto_Model_Thongke{
	/**
	 * Hàm lấy thông tin từ 1 table, có thể join thêm bảng và điều kiện, trả về 1 list đối tượng
	 * @param array $field
	 * @param string $table
	 * @param array $arrJoin array(key => value)
	 * @param array $where array(where1, where2)
	 * @param string $order
	 * @return objectlist
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
// 	phụ lục 1
	public function getDulieuPhuluc1(){
		$formData = JRequest::get('post');
		$db = JFactory::getDbo();
		$query = '	SELECT 	COUNT(a.id) AS soluong_totruong,
							COUNT(IF(a.gioitinh = "Nam",1,NULL)) AS nam,
							COUNT(IF(a.gioitinh = "Nu",1,NULL)) AS nu,
							COUNT(IF(TIMESTAMPDIFF(YEAR,a.ngaysinh,CURDATE()) <= 30,1,NULL)) tuoiduoi30,
							COUNT(IF(TIMESTAMPDIFF(YEAR,a.ngaysinh,CURDATE()) > 30 AND TIMESTAMPDIFF(YEAR,a.ngaysinh,CURDATE()) <= 45,1,NULL)) tuoitu31den45,
							COUNT(IF(TIMESTAMPDIFF(YEAR,a.ngaysinh,CURDATE()) > 45 AND TIMESTAMPDIFF(YEAR,a.ngaysinh,CURDATE()) <= 60,1,NULL)) tuoitu46den60,
							COUNT(IF(TIMESTAMPDIFF(YEAR,a.ngaysinh,CURDATE()) > 60 AND TIMESTAMPDIFF(YEAR,a.ngaysinh,CURDATE()) <= 70,1,NULL)) tuoitu61den70,
							COUNT(IF(TIMESTAMPDIFF(YEAR,a.ngaysinh,CURDATE()) > 70,1,NULL)) tuoitren70,
							COUNT(IF(a.ngaysinh IS NULL,1,NULL)) AS tuoikhongro,
							COUNT(IF(a.danhdaudangvien = 1,1,NULL)) AS dangvien,
							COUNT(IF(a.chuyenmon_trinhdo_mucdo < 3,1,NULL)) AS trinhdo_saudaihoc,
							COUNT(IF(a.chuyenmon_trinhdo_mucdo = 3,1,NULL)) AS trinhdo_daihoc,
							COUNT(IF(a.chuyenmon_trinhdo_mucdo = 4,1,NULL)) AS trinhdo_caodang,
							COUNT(IF(a.chuyenmon_trinhdo_mucdo = 5,1,NULL)) AS trinhdo_trungcap,
							COUNT(IF(a.chuyenmon_trinhdo_mucdo = 6,1,NULL)) AS trinhdo_socap,
							COUNT(IF(a.chuyenmon_trinhdo_mucdo IS NULL,1,NULL)) AS trinhdo_chuadaotao,
							COUNT(IF(a.nghenghiephientai = 1,1,NULL)) AS canbo_capthanhpho,
							COUNT(IF(a.nghenghiephientai IN (3,4),1,NULL)) AS canbo_capquanhuyen,
							COUNT(IF(a.nghenghiephientai IN (5,6),1,NULL)) AS canbo_capphuongxa,
							COUNT(IF(a.nghenghiephientai = 7,1,NULL)) AS canbo_nghetudo,
							COUNT(IF(a.nghenghiephientai = 8,1,NULL)) AS canbo_huutri,
							COUNT(IF(a.loaibaohiemyte_id = 1,1,NULL)) AS bhyt_ngansach,
							COUNT(IF(a.loaibaohiemyte_id = 2,1,NULL)) AS bhyt_dienkhac,
							COUNT(IF(a.chucdanhchibo_id IS NOT NULL,1,NULL)) AS kiemnhiem_tongso,
							COUNT(IF(a.chucdanhchibo_id = 1,1,NULL)) AS kiemnhiem_bithu,
							COUNT(IF(a.chucdanhchibo_id = 2,1,NULL)) AS kiemnhiem_phobithu,
							COUNT(IF(a.chucdanhchibo_id = 3,1,NULL)) AS kiemnhiem_chucdanhkhac,
							COUNT(IF(c.sonamcongtac < 5,1,NULL)) AS congtac_duoi5,
							COUNT(IF(c.sonamcongtac >= 5 AND c.sonamcongtac < 10,1,NULL)) AS congtac_tu5den10,
							COUNT(IF(c.sonamcongtac >= 10 AND c.sonamcongtac < 15,1,NULL)) AS congtac_tu10den15,
							COUNT(IF(c.sonamcongtac >= 15,1,NULL)) AS congtac_tren15,
							COUNT(IF(d.hinhthuc_id = 1,1,NULL)) AS bangkhenchutich,
							COUNT(IF(a.dadaotaonghiepvu = 1,1,NULL)) AS dadaotaonghiepvu
					FROM thonto_hosocanbo AS a
					INNER JOIN thonto_tochuc AS b ON a.congtac_thonto_id = b.id
					INNER JOIN (SELECT 	hosocanbo_id,
										SUM(IF(ngayketthuc IS NULL,
													TIMESTAMPDIFF(YEAR,DATE_SUB(ngaybatdau,INTERVAL 1 DAY),CURDATE()),
													TIMESTAMPDIFF(YEAR,DATE_SUB(ngaybatdau,INTERVAL 1 DAY),ngayketthuc))) AS sonamcongtac
							FROM thonto_quatrinhcongtac
							GROUP BY hosocanbo_id) AS c ON a.id = c.hosocanbo_id
					LEFT JOIN thonto_quatrinhkhenthuong AS d ON a.id = d.hosocanbo_id AND d.hinhthuc_id = 1
					WHERE a.trangthai = 1
						AND b.lft >= '.$db->quote($formData['lft']).'
						AND b.rgt <= '.$db->quote($formData['rgt']).'
						';
		$db->setQuery($query);
		$infoCanbo = $db->loadAssoc();
		$query = '	SELECT 	COUNT(IF(a.tongsoho < 30 AND a.kieu = 4,1,NULL)) AS to_duoi30,
							COUNT(IF(a.tongsoho >= 30 AND a.tongsoho < 40 AND a.kieu = 4,1,NULL)) AS to_tu30den40,
							COUNT(IF(a.tongsoho >= 40 AND a.kieu = 4,1,NULL)) AS to_tren40,
							COUNT(IF(a.tongsoho < 350 AND a.kieu = 5,1,NULL)) AS thon_duoi350,
							COUNT(IF(a.tongsoho >= 350 AND a.tongsoho < 500 AND a.kieu = 5,1,NULL)) AS thon_tu350den500,
							COUNT(IF(a.tongsoho >= 500 AND a.kieu = 5,1,NULL)) AS to_tren500
						FROM thonto_tochuc AS a
						WHERE a.trangthai_id = 1
							AND a.lft >= '.$db->quote($formData['lft']).'
							AND a.rgt <= '.$db->quote($formData['rgt']);
		$db->setQuery($query);
		$infoTochuc = $db->loadAssoc();
		$result = array_merge($infoCanbo,$infoTochuc);
		return $result;
	}
// 	phụ lục 4
	function bc_mau4(){
		$formData = JRequest::get('post');
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query = 'select
		count(b.id) as tongtochuc,
		if(sum(cb.thonto_truong)>0, sum(cb.thonto_truong), 0) as thonto_truong,
		if(sum(cb.thonto_pho)>0, sum(cb.thonto_pho), 0) as thonto_pho,
		if(sum(cb.chibo_bithu)>0, sum(cb.chibo_bithu), 0) as chibo_bithu,
		if(sum(cb.chibo_phobithu)>0, sum(cb.chibo_phobithu), 0) as chibo_phobithu,
		if(sum(cb.bancongtac_truongban)>0, sum(cb.bancongtac_truongban), 0) as bancongtac_truongban,
		if(sum(cb.bancongtac_phoban)>0, sum(cb.bancongtac_phoban), 0) as bancongtac_phoban,
		if(sum(cb.chihoiphunu)>0, sum(cb.chihoiphunu), 0) as chihoiphunu,
		if(sum(cb.chihoicuuchienbinh)>0, sum(cb.chihoicuuchienbinh), 0) as chihoicuuchienbinh,
		if(sum(cb.bithudoantn)>0, sum(cb.bithudoantn), 0) as bithudoantn,
		if(sum(cb.chihoinongdan)>0, sum(cb.chihoinongdan), 0) as chihoinongdan,
		if(sum(cb.todanvan)>0, sum(cb.todanvan), 0) as todanvan,
		if(sum(cb.baovedanpho)>0, sum(cb.baovedanpho), 0) as baovedanpho,
		if(sum(cb.conganvien)>0, sum(cb.conganvien), 0) as conganvien
		from
		thonto_canbochuyentrach cb
		inner join thonto_tochuc b ON b.id = cb.thonto_id
		WHERE b.trangthai_id = 1
							AND b.lft >= '.$db->quote($formData['lft']).'
							AND b.rgt <= '.$db->quote($formData['rgt']);
		$db->setQuery($query);
		return $db->loadObjectList();
	}
	// phụ lục 6
	function soluongnoidunghop($lft,$rgt,$noidunghop_id,$dotbaocao_id){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query = "select if(sum(if(xl.noidunghop_id=$db->quote($noidunghop_id),xl.co_thuchien,0))>0,sum(if(xl.noidunghop_id=$db->quote($noidunghop_id),xl.co_thuchien,0)),0) as co_thuchien
		from thonto_tinhhinhquanly th
		inner join thonto_dotbaocao bc ON bc.id = th.dotbaocao_id AND th.dotbaocao_id = $dotbaocao_id
		inner join thonto_tochuc tc ON tc.id = th.thonto_id
		inner join thonto_thongtinhopgiaoban xl ON xl.tinhhinhquanly_id = th.id
		WHERE tc.lft >= ".$db->quote($lft)."
		AND tc.rgt <= ".$db->quote($rgt);
		$db->setQuery($query);
		return $db->loadResult();
	}
	function mau6($lft, $rgt, $dotbaocao_id){
	$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query = "select
		if(sum(ql.lapsotheodoihoatdong)>0, sum(ql.lapsotheodoihoatdong),0) as lapsotheodoihoatdong,
					if(sum(ql.thanhphan_soluong1)>0, sum(ql.thanhphan_soluong1),0) as thanhphan_soluong1,
					if(sum(ql.thanhphan_soluong2)>0, sum(ql.thanhphan_soluong2),0) as thanhphan_soluong2,
					if(sum(ql.thanhphan_soluong3)>0, sum(ql.thanhphan_soluong3),0) as thanhphan_soluong3,
					if(sum(ql.soluongvang)>0, sum(ql.soluongvang),0) as soluongvang,
					if(sum(ql.kiennghi_soluong)>0, sum(ql.kiennghi_soluong),0) as kiennghi_soluong,
					if(sum(ql.kiennghi_dagiaiquyet)>0, sum(ql.kiennghi_dagiaiquyet),0)  as kiennghi_dagiaiquyet
					from thonto_tinhhinhquanly ql
				inner join thonto_dotbaocao bc ON bc.id = ql.dotbaocao_id AND ql.dotbaocao_id = $dotbaocao_id
				inner join thonto_tochuc b ON b.id = ql.thonto_id
				where
					b.lft >= ".$db->quote($lft)."
						AND b.rgt <= ".$db->quote($rgt);
		$db->setQuery($query);
									return $db->loadObject();
	}
	function getmau6(){
		$data = JRequest::get('post');
		$row_noidunghop = $this->getThongtin('id, ten', 'thonto_danhmucnoidunghop', null, 'trangthai=1','id asc');
		$arr = $this->mau6($data['lft'], $data['rgt'], $data['dot_phuluc6']);
		$sum = array_sum((array)$arr);
		$ttt= array();
		for($j=0; $j<count($row_noidunghop); $j++){
			$ttt[$j] = $this->soluongnoidunghop($data['lft'], $data['rgt'],$row_noidunghop[$j]->id, $data['dot_phuluc6']);
			$sum+=$ttt[$j];
		}
		$arr->thongtinthem = $ttt;
		$arr->khong = $sum == 0 ?'X':'';
		return $arr;
	}
// 	phụ lục 5
	function getmau5($data){
// 		var_dump($data);die;
		$row_kiennghi = $this->getThongtin('id, ten', 'thonto_danhmuckiennghi', null, 'trangthai=1','id asc');
		$arr = $this->mau5($data['lft'], $data['rgt'], $data['dot_phuluc5']);
		$ttt= array();
		for($i=0;$i<count($row_kiennghi);$i++){
				$ttt[$i] = $this->soluongkiennghi($data['lft'], $data['rgt'],$row_kiennghi[$i]->id,$data['dot_phuluc5']);
		}
		$arr->thongtinthem = $ttt;
		return $arr;
	}
	function soluongkiennghi($lft, $rgt,$kiennghi_id,$dot_phuluc5){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query = "select if(sum(if(xl.kiennghi_id=$kiennghi_id,xl.soluongkiennghi,0))>0,sum(if(xl.kiennghi_id=$kiennghi_id,xl.soluongkiennghi,0)),0) as soluongkiennghi
						from thonto_tinhhinhhoatdong th
						INNER JOIN thonto_dotbaocao bc ON bc.id = th.dotbaocao_id and th.dotbaocao_id = $dot_phuluc5
						INNER JOIN thonto_tochuc tc ON tc.id = th.thonto_id
						INNER JOIN thonto_xulykiennghi xl ON xl.tinhhinhhoatdong_id = th.id
						WHERE tc.lft >= ".$db->quote($lft)."
						AND tc.rgt <= ".$db->quote($rgt);
		$db->setQuery($query);
		return $db->loadResult();
	}
	function mau5($lft, $rgt, $dot_phuluc5){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$node = $this->getCountForTile($lft, $rgt, $dot_phuluc5);
		$query = "select 
						if(sum(th.dinhky_solan)>0,sum(th.dinhky_solan),0) as dinhky_solan,
						if(sum(th.dotxuat_solan)>0,sum(th.dotxuat_solan),0) as dotxuat_solan,
						if(sum(th.thanhphan_daydu)>0,sum(th.thanhphan_daydu),0) as thanhphan_daydu,
						if(sum(th.thanhphan_khongdaydu)>0,sum(th.thanhphan_khongdaydu),0) as thanhphan_khongdaydu,
						if(sum(th.sohothamgia)>0,sum(th.sohothamgia),0) as sohothamgia,
						if(sum(th.tyle)>0,sum(th.tyle),0)/$node as tyle,
						if(sum(th.hopquandanchinh_solan)>0,sum(th.hopquandanchinh_solan),0) as hopquandanchinh_solan,
						if(sum(th.thaythetotruong_soluong)>0,sum(th.thaythetotruong_soluong),0) as thaythetotruong_soluong,
						if(sum(if(th.nhiemvutrongtam=1,1,0)) >0,sum(if(th.nhiemvutrongtam=1,1,0)) ,0) as nhiemvutrongtam_ok,
						if(sum(if(th.nhiemvutrongtam=0,1,0)) >0,sum(if(th.nhiemvutrongtam=0,1,0)) ,0) as nhiemvutrongtam_no
						from thonto_tinhhinhhoatdong th
						INNER JOIN thonto_dotbaocao bc ON bc.id = th.dotbaocao_id
						INNER JOIN thonto_tochuc tc ON tc.id = th.thonto_id
						WHERE tc.lft >= ".$db->quote($lft)."
						AND tc.rgt <= ".$db->quote($rgt)."
								AND th.dotbaocao_id = $dot_phuluc5";
		$db->setQuery($query);
		$arr1 = $db->loadObject();
		$query = "select
		if(sum(xl.dagiaiquyet_thonto)>0,sum(xl.dagiaiquyet_thonto),0) as dagiaiquyet_thonto,
		if(sum(xl.dagiaiquyet_phuongxa)>0,sum(xl.dagiaiquyet_phuongxa),0) as dagiaiquyet_phuongxa,
		if(sum(xl.dagiaiquyet_quanhuyentrolen)>0,sum(xl.dagiaiquyet_quanhuyentrolen),0) as dagiaiquyet_quanhuyentrolen
		from thonto_tinhhinhhoatdong th
		INNER JOIN thonto_dotbaocao bc ON bc.id = th.dotbaocao_id
		INNER JOIN thonto_tochuc tc ON tc.id = th.thonto_id
		INNER JOIN thonto_xulykiennghi xl ON xl.tinhhinhhoatdong_id = th.id
		WHERE tc.lft >= ".$db->quote($lft)."
		AND tc.rgt <= ".$db->quote($rgt)."
		AND th.dotbaocao_id = $dot_phuluc5";
		$db->setQuery($query);
				$arr2 = $db->loadObject();
		$arr =(object) array_merge((array)$arr1, (array)$arr2);
		return $arr;
	}
	function getCountForTile($lft, $rgt,$dot_phuluc5){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query = "select if(count(DISTINCT(tc.id))=0,1,count(DISTINCT(tc.id))) as node
			from thonto_tinhhinhhoatdong th
			INNER JOIN thonto_dotbaocao bc ON bc.id = th.dotbaocao_id
			INNER JOIN thonto_tochuc tc ON tc.id= th.thonto_id
			WHERE tc.lft >= ".$db->quote($lft)."
						AND tc.rgt <= ".$db->quote($rgt)."
								AND th.dotbaocao_id = $db->quote($dot_phuluc5)";
		$db->setQuery($query);
		return $db->loadResult();
	}
	// phụ lục 3
	function getmau3($data){
		$data = explode(',', $data);
		$arr = array();
		for($i=0; $i<count($data); $i++){
			$arr[$i]->donvi = $data[$i];
			$arr[$i]->tendonvi = $this->layTen($data[$i]);
			$arr[$i]->thongtin = $this->mau3($data[$i]);
		}
		return $arr;
	}
	function mau3($id){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query = 'select
					DISTINCT(hsht.hoten),if(hsht.chuyenmon_trinhdo_mucdo =1, "X","") as saudaihoc,
					if(hsht.chuyenmon_trinhdo_mucdo =2, "X","") as daihoc,
					if(hsht.chuyenmon_trinhdo_mucdo =3, "X","") as caodang,
					if(hsht.chuyenmon_trinhdo_mucdo =4, "X","") as trungcap,
					if(hsht.chuyenmon_trinhdo_mucdo =5, "X","") as socap,
					if(hsht.gioitinh="Nam", YEAR(hsht.ngaysinh),"") as nam,
					if(hsht.gioitinh="Nu", YEAR(hsht.ngaysinh),"") as nu,
					if(hsht.congtac_chucvu_id>0 ,hsht.congtac_chucvu,"") as congtac_chucvu,
					if(hsc.phone!=null ,hsc.phone,"") as phone,
					if(hsc.email!=null ,hsc.email,"") as email,
					if(hsc.ghichu!=null ,hsc.ghichu,"") as ghichu,
					hsht.congtac_donvi
					from thonto_tochuc tc
					INNER JOIN(SELECT distinct(node.id) FROM thonto_tochuc AS node, thonto_tochuc AS parent
					  WHERE node.lft BETWEEN parent.lft AND parent.rgt AND  parent.id ='.$id.') as dvc ON dvc.id = tc.id  
					inner join hosochinh_quatrinhhientai hsht ON hsht.congtac_donvi_id = tc.donvi_id and hsht.hosochinh_id = tc.hosochinh_id
					inner join hosochinh hsc ON hsc.id=hsht.hosochinh_id
					where tc.hosochinh_id >0';
		$db->setQuery($query);
		return $db->loadObjectList();
	}
	function layTen($id){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query = ' SELECT ten FROM thonto_tochuc where id ='.$id;
		$db->setQuery($query);
		return $db->loadResult();
	}
	// dùng chung
	public function getDonviBaocao($ids_donvi,$kieu){
		$db = JFactory::getDbo();
		$array_donvi = explode(',', $ids_donvi);
		foreach($array_donvi AS $key=>$val){
			$query = 'SELECT lft,rgt
						FROM thonto_tochuc
						WHERE id = '.$db->quote($val);
			$db->setQuery($query);
			$node = $db->loadAssoc();
				
			$query = 'SELECT id
						FROM thonto_tochuc
						WHERE lft >= '.$db->quote($node['lft']).'
							AND rgt <= '.$db->quote($node['rgt']);
			$db->setQuery($query);
			$result[] = implode(',', $db->loadColumn());
		}
		$query = 'SELECT id,ten,kieu,lft,rgt,level
					FROM thonto_tochuc
					WHERE id IN ('.implode(',', $result).')
						AND kieu IN ('.$kieu.')
						AND trangthai_id = 1
					ORDER BY lft';
		$db->setQuery($query);
		return $db->loadAssocList();
	}
}