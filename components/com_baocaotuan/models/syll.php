<?php
/**
 * Author: Phucnh
 * Date created: Jun 10, 2015
 * Company: DNICT
 */
class BaocaotuanModelSyll extends JModelLegacy{
	function exportWord_2c($hosochinh_id){
		$hosochinh_id = (int)$hosochinh_id;
		$data['canhan'] = $this->getCanhan($hosochinh_id);
		$data['qtdtao'] = $this->get4quatrinh($hosochinh_id);
		$data['3quatrinhcongtac'] = $this->get3Quatrinhcongtac($hosochinh_id);
		$data['qtluong'] = $this->getThongtin(array('start_date_sal', 'sta_code_sal','end_date_sal', 'sl_code_sal', 'coef_sal', 'sta_name_sal','ext_coef_per_sal'), 'quatrinhluong', null , array('emp_id_sal='.$hosochinh_id), 'start_date_sal asc');
		$arrCm = $this->getThongtin('qtcm.chuyennganh, cla.name as trinhdo, hsht.chuyenmon_trinhdo_code', 'hosochinh_quatrinhhientai hsht', array('left'=>'quatrinhdaotaochuyenmon qtcm ON qtcm.hosochinh_id = hsht.hosochinh_id and qtcm.hinhthucdaotao_id = 1 and qtcm.tosc_code_dt = 2 and qtcm.trinhdo_code = hsht.chuyenmon_trinhdo_code', 'left '=>'cla_sca_code cla ON cla.code = hsht.chuyenmon_trinhdo_code and cla.tosc_code =2'), ' hsht.hosochinh_id='.$hosochinh_id);
		if (count($arrCm)>0){
			for ($i=0; $i<count($arrCm); $i++)
				$cmcn[$i] = $arrCm[$i]->chuyennganh;
			$chuyenmon_caonhat = $arrCm[0]->chuyenmon_trinhdo_code == null ? null:$arrCm[0]->trinhdo.'('.implode($cmcn,', ').')';
		}
		$data['canhan']->tdcm_name = $chuyenmon_caonhat;
		$bienchehanhchinh_hinhthuc_id =  Core::config('baocao/bienchehanhchinh');
		$bienchesunghiep_hinhthuc_id  = Core::config('baocao/bienchesunghiep');
		$a = array($bienchehanhchinh_hinhthuc_id, $bienchesunghiep_hinhthuc_id);
		$bienche =  implode($a, ',');
		$arrBienche = $this->getThongtin('qt.ngaybatdau, qt.coquanquyetdinh', 'bc_quatrinhbienche qt', null, ' hinhthuc_id IN(-999, '.$bienche.') and emp_id_bc='.$hosochinh_id, 'ngaybatdau DESC ');
		$data['canhan']->coquantuyendung = $arrBienche[0]->coquanquyetdinh;
		$data['canhan']->ngaytuyendung = $arrBienche[0]->ngaybatdau;
		return $data;
	}
	
	public function object_to_array($data)
	{
		if (is_array($data) || is_object($data))
		{
			$result = array();
			foreach ($data as $key => $value)
			{
				$result[$key] = $this->object_to_array($value);
			}
			return $result;
		}
		return $data;
	}
	/**
	 * get thông tin 4 quá trình
	 * @param unknown $hosochinh_id
	 */
	function get4quatrinh($hosochinh_id){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query = "select qt.ngaybatdau, qt.ngayketthuc, qt.truong, cla.name as trinhdo, '' as hinhthuc , sca.name as tenchuyennganh , 'phothong' as type
					from quatrinhdaotaophothong  qt
					inner join cla_sca_code cla on qt.trinhdo_code = cla.code
					inner join type_sca_code sca on qt.tosc_code_dt = sca.code
					where  qt.tosc_code_dt = cla.tosc_code and qt.hosochinh_id = $db->quote($hosochinh_id)
					union
					select qt.ngaybatdau, qt.ngayketthuc, qt.truong, cla.name as trinhdo, edu.name as hinhthuc, qt.chuyennganh as tenchuyennganh, 'chuyenmon' as type
					from quatrinhdaotaochuyenmon qt
					inner join cla_sca_code cla on qt.trinhdo_code = cla.code
					inner join type_sca_code sca on qt.tosc_code_dt = sca.code
					INNER JOIN edu_form edu on edu.id = qt.hinhthucdaotao_id
					where  qt.tosc_code_dt = cla.tosc_code and qt.quatrinhdaotaochuyenmon_id IS NULL  and qt.hosochinh_id = $db->quote($hosochinh_id)
					union
					select qt.ngaybatdau, qt.ngayketthuc, qt.tenlop as truong, '' as trinhdo, '' as hinhthuc, sca.name as tenchuyennganh , 'nganhan' as type
					from quatrinhboiduongnganhan qt
					inner join type_sca_code sca on qt.tosc_code_dt = sca.code
					where  qt.hosochinh_id = $db->quote($hosochinh_id)
					UNION
					select '' as ngaybatdau, qt.ngayketthuc,qt.truong, cla.name as trinhdo, '' as hinhthuc, sca.name as tenchuyennganh   , 'nghiepvu' as type
					from quatrinhboiduongnghiepvu qt
					inner join cla_sca_code cla on qt.trinhdo_code = cla.code
					inner join type_sca_code sca on qt.tosc_code_dt = sca.code
					where hosochinh_id = $db->quote($hosochinh_id) and qt.tosc_code_dt = cla.tosc_code
					order by ngayketthuc asc, ngaybatdau asc";
		$db->setQuery($query);
		return $db->loadObjectList();
	}
	/**
	 * get thông tin các hồ
	 * @param unknown $hosochinh_id
	 */
	function get3Quatrinhcongtac($hosochinh_id){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query = "select pos_name_ct as chucdanh , inst_name_ct as donvicongtac ,dept_name as phongcongtac ,start_date_ct as ngaybatdau, end_date_ct as ngayketthuc, 'qtct'
		from quatrinhcongtac where emp_id_ct=$db->quote($hosochinh_id)
		union
		select ppc.name as chucdanh, '' as donvicongtac, ctd.donvidang_ctd as phongcongtac ,ctd.start_date_ctd as ngaybatdau, ctd.end_date_ctd as ngayketthuc, 'qtd' from ctd_quatrinhcongtacdang ctd
		left join party_pos_code as ppc on ppc.code = ctd.party_pos_code_ctd
		where emp_id_ctd=$db->quote($hosochinh_id)
		union
		select nn.noidung_ctnn as chucdanh, coun.name as donvicongtac, coun.name as phongcongtac, nn.start_date_ctnn as ngaybatdau, nn.end_date_ctnn as ngayketthuc, 'qtnn' from quatrinhcongtacnuocngoai nn
		join country_code coun on coun.`code`= nn.quocgia_ctnn
		where emp_id_ctnn= $db->quote($hosochinh_id) order by ngaybatdau asc, ngayketthuc asc";
		$db->setQuery($query);
		return $db->loadObjectList();
	}
	function getCanhan($hoso_id){
	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
	$query = 'select hsc.e_name, hsht.congtac_ngayvaocoquanhiennay ,sex.name as sex, hsc.birth_date, hsc.is_only_year, hsc.birth_place, hsc.e_code,
     -- quê/nguyên quán
     hsc.cadc_code as macity, qq_city.`name` as qq_tt, qq_dist.`name` as qq_qh, qq_comm.`name` as qq_px, nguyenquan_khac,hsht.congtac_chucvu_heso,
     nat.name as dantoc, rel.name as tongiao,
     -- hộ khẩu thường trú
     hktt_city.`name` as tt_tt, hktt_dist.name as tt_qh, hktt_comm.`name` as tt_px,
     -- chỗ ở hiện nay
     hsc.per_residence as per_residence,
     -- nghề nghiệp khi được tuyển dụng
     hsc.work_expe ,  hsht.congtac_donvi,
     -- bậc, hệ số, ngày hưởng, phụ cấp, phụ cấp khác
     hsht.luong_bac, hsht.luong_ngaybatdau, hsht.congtac_chucvu, hsht.luong_mangach, hsht.luong_tenngach, hsht.luong_heso,hsht.luong_vuotkhung,
     hsc.party_date, hsc.party_j_date, hsc.cyu_date, hsc.mil_date, hsc.exp_mil_date,
     hsc.hea_wei , hsc.hea_hig, hea.name as hea_fk, blood.name as blood_type,
	kt.hinhthuc as khenthuong_hinhthuc, kt.ngaybatdau as khenthuong_ngaybatdau, kt.ngayketthuc as khenthuong_ngayketthuc, kt.coquanquyetdinh as khenthuong_coquanquyetdinh,
	hsht.kyluat_hinhthuc, hsht.kyluat_ngayquyetdinh,
    hsc.id_card,hsc.id_card_date, hsc.maso_bhxh, rank.name as quanham, 
    -- danh hiệu phong tặng
    awa.name as ac_name, abi.name as ability_name, inv.name as inv_fk, ousc.name as ousc_code,
    -- trình độ chuyên môn
    tdllct.name as tdllct_name,tdqlnn.name as tdqlnn_name,tdnn.name as tdnn_name,tdth.name as tdth_name,
    dvcq.name as donvichuquan,hsht.luong_phucap_chucvu
     from hosochinh hsc
    join hosochinh_quatrinhhientai as hsht on hsc.id = hsht.hosochinh_id
    inner join city_code  qq_city   on qq_city.code = hsc.cadc_code
    	LEFT JOIN ins_dept dv ON dv.id = hsht.congtac_donvi_id
	LEFT JOIN ins_dept dvcq ON dv.ins_created = dvcq.id
LEFT JOIN quatrinhkhenthuong kt ON kt.hosochinh_id = hsc.id 
		left join rew_fin_code rew ON rew.id = kt.hinhthuc_id and rew.type="KT"
    left join cla_sca_code  tdllct   on tdllct.code = hsht.nghiepvu_lyluanchinhtri_code and tdllct.tosc_code = 3
    left join cla_sca_code  tdqlnn   on tdqlnn.code = hsht.nghiepvu_quanlynhanuoc_code and tdqlnn.tosc_code = 5
    left join cla_sca_code  tdnn   on tdnn.code = hsht.nghiepvu_ngoaingu_anh_code and tdnn.tosc_code = 6
    left join cla_sca_code  tdth   on tdth.code = hsht.nghiepvu_tinhoc_code and tdth.tosc_code = 7
    left join dist_code  qq_dist  on qq_dist.code = hsc.dist_placebirth
    left join comm_code  qq_comm  on qq_comm.code = hsc.comm_placebirth
    left join city_code  hktt_city  on hktt_city.code = hsc.city_peraddress
    left join dist_code  hktt_dist on hktt_dist.code = hsc.dist_peraddress
    left join comm_code  hktt_comm  on hktt_comm.code = hsc.comm_peraddress
    left join nat_code   nat   on nat.id = hsc.nat_code
    left join sex_code   sex   on sex.id = hsc.sex
    left join rel_code   rel   on rel.id = hsc.nat_code
    left join hea_code   hea   on hea.id = hsc.hea_fk
    left join blood_code  blood  on blood.id = hsc.blood_type
    left join rank_code  rank  on rank.id = hsc.rank_pos_fk
    left join awa_code   awa   on awa.id = hsc.ac_code
    left join ability_code  abi   on abi.id = hsc.ability
    left join inv_code   inv   on inv.id = hsc.inv_fk
    left join ous_code   ousc  on ousc.id = hsc.ousc_code
    where hsc.id='.$db->quote($hoso_id).' order by rew.lev asc, khenthuong_ngayketthuc desc
limit 0,1 ';
			$db->setQuery($query);
			return $db->loadObject();
	}
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
}