<?php
	$data			=	$this->data;
	$e_code			=	$data['canhan']->e_code;
	$e_name			=	mb_strtoupper($data['canhan']->e_name,'UTF-8'); 
	$sex			=	$data['canhan']->sex;
	$is_only_year	=	$data['canhan']->is_only_year;
	$ar_birth_date	=	explode('-', $data['canhan']->birth_date);
	if ($is_only_year==0){
		$birth_date		=	$ar_birth_date[2].' tháng '.$ar_birth_date[1].' năm '.$ar_birth_date[0];
	}else {
		$birth_date	=	' năm '.$ar_birth_date[0];
	}
	
	$birth_place	=	$data['canhan']->birth_place 		== null ? '.................' : $data['canhan']->birth_place;
	$qq_tt			=	$data['canhan']->qq_tt;
	$qq_qh			=	$data['canhan']->qq_qh;
	$qq_px			=	$data['canhan']->qq_px;
	$quequan = '';
	if ($data['canhan']->macity == -2) {
		$quequan	=	$data['canhan']->nguyenquan_khac;
	}else {
		if ($qq_px != '') $quequan .= $qq_px.', ';
		if ($qq_qh != '') $quequan .= $qq_qh.', ';
		if ($qq_tt != '') $quequan .= $qq_tt;
		$quequan		=	$qq_px.', '.$qq_qh.', '.$qq_tt;
	}
	
	$thuongtru		=	$data['canhan']->tt_px.' - '. $data['canhan']->tt_qh.' - '. $data['canhan']->tt_tt;
	$tongiao		=	$data['canhan']->tongiao == null ? '.................' : $data["canhan"]->tongiao;
	$dantoc			=	$data['canhan']->dantoc == null ? '.................' : $data["canhan"]->dantoc;
	$per_residence	=	$data['canhan']->per_residence == null ? '.................' : $data["canhan"]->per_residence;; // chỗ ở hiện nay
	$party_j_date	=	$data['canhan']->party_j_date 		== null ? '.................' : date('d/m/Y', strtotime($data['canhan']->party_j_date));
	$party_date		=	$data['canhan']->party_date 		== null ? '.................' : date('d/m/Y', strtotime($data['canhan']->party_date));
	$mil_date		=	$data['canhan']->mil_date 			== null ? '.................' : date('d/m/Y', strtotime($data['canhan']->mil_date));
	$exp_mil_date	=	$data["canhan"]->exp_mil_date 		== null ? '.................' : date('d/m/Y', strtotime($data['canhan']->exp_mil_date));
	$quanham		=	$data["canhan"]->quanham			== null ? '.................' : $data["canhan"]->quanham;
	$ac_name		=	$data["canhan"]->ac_name			== null ? '.................' : $data["canhan"]->ac_name;
	$hea_fk			=	$data["canhan"]->hea_fk				== null ? '.......' : $data["canhan"]->hea_fk;
	$hea_hig		=	$data["canhan"]->hea_hig			== null ? '.......' : $data["canhan"]->hea_hig;
	$hea_wei		=	$data["canhan"]->hea_wei			== null ? '.......' : $data["canhan"]->hea_wei;
	$blood_type		=	$data["canhan"]->blood_type			== null ? '.......' : $data["canhan"]->blood_type;
	$inv_fk			=	$data["canhan"]->inv_fk				== null ? '.......' : $data["canhan"]->inv_fk;
	$ousc_code		=	$data["canhan"]->ousc_code			== null ? '.......' : $data["canhan"]->ousc_code;
	$id_card		=	$data["canhan"]->id_card			== null ? '.................' : $data["canhan"]->id_card;		
	$id_card_date	=	$data["canhan"]->id_card_date 		== null ? '.................' : date('d/m/Y', strtotime($data['canhan']->id_card_date));
	$maso_bhxh		=	$data["canhan"]->maso_bhxh			== null ? '.......' : $data["canhan"]->maso_bhxh;
 	$pos_name_ct	=	$data["canhan"]->congtac_chucvu == null ? $data["canhan"]->luong_tenngach:$data["canhan"]->congtac_chucvu;
	$cyu_date		=	$data['canhan']->cyu_date 			== null ? '..................................' : date('d/m/Y', strtotime($data['canhan']->cyu_date)).' kết nạp vào Đoàn  thanh niên Cộng sản Hồ Chí Minh';
	
	$work_expe		=	$data['canhan']->work_expe				== null ? '.................' : $data['canhan']->work_expe;
	$congtac_ngayvaocoquanhiennay	=	$data['canhan']->congtac_ngayvaocoquanhiennay 	== null ? '.................' : date('d/m/Y', strtotime($data['canhan']->congtac_ngayvaocoquanhiennay));
	$ngaytuyendung	=	$data['canhan']->ngaytuyendung 	== null ? '.................' : date('d/m/Y', strtotime($data['canhan']->ngaytuyendung));
	$congtac_donvi    =	$data['canhan']->congtac_donvi			== null ? '.................' : $data['canhan']->congtac_donvi;
	$donvichuquan 		=	$data['canhan']->donvichuquan			== null ? '.................' : $data['canhan']->donvichuquan;
	$coquantuyendung=	$data['canhan']->coquantuyendung			== null ? '.................' : $data['canhan']->coquantuyendung;
	
	$tenngach		=	$data['canhan']->luong_tenngach			== null ? '.......' : $data["canhan"]->luong_tenngach;
	$mangach		=	$data['canhan']->luong_mangach			== null ? '.......' : $data["canhan"]->luong_mangach;
	$vuotkhung		=	$data['canhan']->luong_vuotkhung			== null ? '' : 'Vượt khung: '.$data["canhan"]->luong_vuotkhung.'%';
	$bac			=	$data['canhan']->luong_bac				== null ? '.......' : $data["canhan"]->luong_bac;
	$heso			=	$data['canhan']->luong_heso				== null ? '.......' : $data["canhan"]->luong_heso;
	$ngayhuong		=	$data['canhan']->luong_ngaybatdau		== null ? '.......' : date('d/m/Y', strtotime($data['canhan']->luong_ngaybatdau));
	$ability_name	=	$data['canhan']->ability_name == null ? '.................' : $data["canhan"]->ability_name;
	$luong_phucap_chucvu	=	$data['canhan']->luong_phucap_chucvu == null ? '.......' : $data['canhan']->luong_phucap_chucvu;
	$congtac_chucvu_heso	=	$data['canhan']->congtac_chucvu_heso == null ? '.......' : $data['canhan']->congtac_chucvu_heso;
	$cm_caonhat		=	$data['canhan']->tdcm_name		== null ? '.......' : $data["canhan"]->tdcm_name;
	$lyluan_ct		=	$data['canhan']->tdllct_name	== null ? '.......' : $data["canhan"]->tdllct_name;
	$quanly_nn		=	$data['canhan']->tdqlnn_name	== null ? '.......' : $data["canhan"]->tdqlnn_name;
	$ngoaingu		=	$data['canhan']->tdnn_name		== null ? '.......' : "Tiếng Anh(".$data["canhan"]->tdnn_name.")";
	$tinhoc			=	$data['canhan']->tdth_name		== null ? '.......' : $data["canhan"]->tdth_name;
	$kl				=	$data['canhan']->kyluat					== null ? ' Không' : $data['canhan']->kyluat_hinhthuc.' năm '.date('Y', strtotime($data['canhan']->kyluat_ngayquyetdinh));
	$canhan     	=	$data['canhan'];
	$khenthuong_ngaybatdau = $canhan->khenthuong_ngaybatdau == null ?'':date('Y',strtotime($canhan->khenthuong_ngaybatdau));
	$khenthuong_ngayketthuc = $canhan->khenthuong_ngayketthuc == null ?'':'-'.date('Y',strtotime($canhan->khenthuong_ngayketthuc));
	if (date('Y',strtotime($canhan->khenthuong_ngaybatdau)) == date('Y',strtotime($canhan->khenthuong_ngayketthuc))) $khenthuong_ngayketthuc='';
	$kt = $canhan->khenthuong_hinhthuc== null ?"Không":$canhan->khenthuong_hinhthuc.' '.$khenthuong_ngaybatdau.$khenthuong_ngayketthuc.' của '.$canhan->khenthuong_coquanquyetdinh;
	$quatrinh 		=	$data['3quatrinhcongtac'];
	// quá trình công tác, đảng, nước ngoài
	if (count($quatrinh)>0){
		for($i=0; $i<count($quatrinh); $i++){
			$ct_tungay 		= $quatrinh[$i]->ngaybatdau == null ? "":date('m/Y',strtotime($quatrinh[$i]->ngaybatdau));
			$ct_toingay 		= $quatrinh[$i]->ngayketthuc == null ? "":date('m/Y',strtotime($quatrinh[$i]->ngayketthuc));
			$ct_chucdanh 	= $quatrinh[$i]->chucdanh;
			$ct_donvi 		= $quatrinh[$i]->donvicongtac;
			$ct_phong 		= $quatrinh[$i]->phongcongtac;
			$ct_loaict			=	$quatrinh[$i]->qtct;
			$tu = ""; $den="";
			if ($ct_tungay != "" && $ct_toingay == "") {$tu = 'Từ '; $den='';}
			if ($ct_tungay == "" && $ct_toingay != "") {$tu = ''; $den='Đến ';}
			if ($ct_tungay != "" && $ct_toingay != "") {$tu = 'Từ '; $den=' đến ';}
			if ($ct_tungay == "" && $ct_toingay == "") {$tu = ''; $den='';}
			$ct_thoigian = $tu.$ct_tungay.$den.$ct_toingay;
			if ($ct_loaict =="qtct" ||$ct_loaict =="qtd"){ 
				if ($ct_chucdanh == null || $ct_chucdanh == "")
					$ct_chucdanh = "Nhân viên";
				$ct_thongtin = $ct_chucdanh.' '.$ct_phong.' '.$ct_donvi;
			}
			elseif ($ct_loaict =="qtnn") $ct_thongtin = $ct_chucdanh.' tại '.$ct_donvi;
			$qtct .= "<tr><td>$ct_thoigian</td><td>$ct_thongtin</td></tr>";
		}
	}else $qtct = "<tr><td height='20'></td><td></td></tr>";
	// quá trình lương
	$qtluong = $data['qtluong'];
	if(count($qtluong)>0){
		for($i=0; $i<count($qtluong); $i++){
			$qtl_tungay 	= $qtluong[$i]->start_date_sal==null ? "":date('m/Y',strtotime($qtluong[$i]->start_date_sal));
			$qtl_toingay 	= $qtluong[$i]->end_date_sal == null ?"":date('m/Y',strtotime($qtluong[$i]->end_date_sal));
			$tu = ""; $den="";
			if ($qtl_tungay != "" && $qtl_toingay == "") {$tu = 'Từ '; $den='';}
			if ($qtl_tungay == "" && $qtl_toingay != "") {$tu = ''; $den='Đến ';}
			if ($qtl_tungay != "" && $qtl_toingay != "") {$tu = 'Từ '; $den=' đến ';}
			if ($qtl_tungay == "" && $qtl_toingay == "") {$tu = ''; $den='';}
			$qtl_thoigian 	=$tu.$qtl_tungay.$den.$qtl_toingay;
			$qtl_bac 		= $qtluong[$i]->sl_code_sal;
			$qtl_mangach 	= $qtluong[$i]->sta_code_sal;
			$qtl_tenngach 	= $qtluong[$i]->sta_name_sal;
			$qtl_heso 		= $qtluong[$i]->coef_sal;
			$ext_coef_per_sal 	= $qtluong[$i]->ext_coef_per_sal==null ? '': ' (VK: '.$qtluong[$i]->ext_coef_per_sal.'%)';
			$luong 			.=	"<tr><td align='center'>$qtl_thoigian</td><td align='center'>$qtl_mangach</td><td align='center'>$qtl_tenngach</td><td align='center'>$qtl_bac</td><td align='center'>$qtl_heso$ext_coef_per_sal</td></tr>";
		}
	}
	else $luong = "<tr><td height='20'></td><td></td><td></td><td></td><td></td></tr>";
	// quá trình đào tạo
	$qtdtao = $data['qtdtao'];
	if (count($qtdtao) > 0) {
		for ($i = 0; $i < count($qtdtao); $i++) {
			if ($qtdtao[$i]->ngaybatdau!="" || $qtdtao[$i]->ngaybatdau!= null ){
				if($qtdtao[$i]->type!="nganhan"){
					$qtdtao_tu		= date('Y',strtotime($qtdtao[$i]->ngaybatdau));
				} else $qtdtao_tu= date('d/m/Y',strtotime($qtdtao[$i]->ngaybatdau)); 
			}else $qtdtao_tu="";
			if ($qtdtao[$i]->ngayketthuc!="" || $qtdtao[$i]->ngayketthuc!= null ) 	
				if($qtdtao[$i]->type!="nganhan"){
					$qtdtao_den	 	= date('Y',strtotime($qtdtao[$i]->ngayketthuc)); 
				} else $qtdtao_den= date('d/m/Y',strtotime($qtdtao[$i]->ngayketthuc)); 
			else $qtdtao_den="";
			$qtdtao_truong 		= $qtdtao[$i]->truong;
			$qtdtao_tencn 		= $qtdtao[$i]->tenchuyennganh == null ? "":$qtdtao[$i]->tenchuyennganh;
			$qtdtao_trinhdo 	= $qtdtao[$i]->trinhdo == null ? "":$qtdtao[$i]->trinhdo;
			$qtdtao_hinhthuc 	= $qtdtao[$i]->hinhthuc == null ? "":$qtdtao[$i]->hinhthuc;
			$tu = ""; $den="";
			if ($qtdtao_tu != "" && $qtdtao_den == "") {$tu = 'Từ '; $den='';}
			if ($qtdtao_tu == "" && $qtdtao_den != "") {$tu = ''; $den='Đến ';}
			if ($qtdtao_tu != "" && $qtdtao_den != "") {$tu = 'Từ '; $den='<br/>đến';}
			if ($qtdtao_tu == "" && $qtdtao_den == "") {$tu = ''; $den='';}
			$qtdtao_thoigian 	= $tu.$qtdtao_tu.$den.$qtdtao_den;
			$dtao .= "<tr><td align='center'>$qtdtao_truong</td><td>$qtdtao_tencn</td><td>$qtdtao_thoigian</td><td>$qtdtao_hinhthuc</td><td>$qtdtao_trinhdo</td></tr>";
		}
	}else {
		$dtao = "<tr><td height='20'></td><td></td><td></td><td></td><td></td></tr>";
	}
	$word = "
<table width='650'>
	<tr><td><i>Mẫu số 2 - Mẫu SYLLVC ban hành kèm theo Thông tư số 12/2012/TT-BNV  ngày 06/10/2008 của Bộ trưởng Bộ Nội vụ</i></td></tr>
	<tr><td>
	<p>Cơ  quan, đơn vị có thẩm quyền quản lý viên chức: $donvichuquan<br />
	  Cơ  quan, đơn vị sử dụng viên chức: $congtac_donvi<br />
	  Số hiệu viên chức: $e_code</p>
	<table border='0' cellspacing='0' cellpadding='2' width='97%'>
	  <tr>
	    <td width='140' rowspan='2' valign='top'>
	    	<p align='center'>&nbsp;</p>
	        <p align='center'>Ảnh màu<br/>(4 x 6 cm)</p>
	      </td>
	    <td width='501' valign='top'><p align='center'><strong>SƠ YẾU LÝ LỊCH VIÊN CHỨC</strong></p>
	        <p>1. Họ    và tên khai sinh: <strong>$e_name</strong><br />
	          2.    Tên gọi khác: Không<br />
	          3.    Sinh ngày:  $birth_date  Giới tính: $sex<br/>
	          4.    Nơi sinh: $birth_place<br />
		      5.    Quê quán:  $quequan </td>
	  </tr>
	</table>
	<table cellspacing='0' cellpadding='0' style='word-wrap: break-word'>
		<tr>
			<td style='width:50%' valign='top'>6. Dân tộc: $dantoc</td>
			<td style='width:50%' valign='top'>7. Tôn giáo: $tongiao </td>
		</tr>
		<tr>
			<td colspan='2' valign='top'>8. Nơi  đăng ký hộ khẩu thường trú: $thuongtru</td>
		</tr>
		<tr>
			<td colspan='2' valign='top'>9. Nơi  ở hiện nay: $per_residence</td>
		</tr>
		<tr>
			<td colspan='2' valign='top'>10. Nghề nghiệp khi được tuyển dụng: $work_expe</td>
		</tr>
		<tr>
			<td valign='top'>11. Ngày tuyển dụng:  $ngaytuyendung</td>
			<td valign='top'>Cơ quan  tuyển dụng: $coquantuyendung</td>
		</tr>
		<tr>
			<td colspan='2' valign='top'>12.  Chức vụ (chức danh) hiện tại: $pos_name_ct</td>
		</tr>
		<tr>
			<td colspan='2' valign='top'>13.  Công việc chính được giao: ..............................</td>
		</tr>
		<tr>
			<td colspan='2' valign='top'>14.  Chức danh nghề nghiệp viên chức: $tenngach<br/>Mã ngạch: $mangach</td>
		</tr>
		<tr>
			<td valign='top'>Bậc  lương: $bac     Hệ số: $heso	&nbsp;&nbsp;&nbsp; $vuotkhung   </td>
			<td valign='top'>Ngày hưởng $ngayhuong</td>
		</tr>
		<tr>
			<td valign='top'>Phụ cấp  chức vụ: $congtac_chucvu_heso</td>
			<td valign='top'>Phụ cấp khác: ............</td>
		</tr>
		<tr>
			<td  valign='top' colspan='2'>15.1.  Trình độ giáo dục phổ thông (đã tốt nghiệp lớp mấy/ thuộc hệ nào): 12/12</td>
		</tr>
		<tr>
			<td  valign='top' colspan='2'>15.2.  Trình độ chuyên môn cao nhất: $cm_caonhat</td>
		</tr>
		<tr>
			<td valign='top'>15.3.  Lý luận chính trị: $lyluan_ct</td>
			<td valign='top'>15.4. Quản lý nhà nước: $quanly_nn</td>
		</tr>
		<tr>
			<td valign='top'>15.5.  Ngoại ngữ: $ngoaingu</td>
			<td valign='top'>15.6.  Tin học: $tinhoc</td>
		</tr>
		<tr>
			<td valign='top'>16.  Ngày vào Đảng cộng sản Việt Nam: $party_j_date</td>
			<td valign='top'>Ngày chính thức: $party_date</td>
		</tr>
		<tr>
			<td valign='top' colspan='2'>17.  Ngày tham gia tổ chức chính trị - xã hội: $cyu_date </td>
		</tr>
		<tr>
			<td valign='top' colspan='2'>18.  Ngày nhập ngũ: $mil_date , Ngày xuất ngũ: $exp_mil_date , Quân hàm cao nhất: $quanham </td>
		</tr>
		<tr>
			<td valign='top' colspan='2'>19.  Danh hiệu được phong tặng cao nhất: $ac_name</td>
		</tr>
		<tr>
			<td valign='top' colspan='2'>20. Sở trường công tác: $ability_name</td>
		</tr>
		<tr>
			<td valign='top' colspan='2'>21.  Khen thưởng: $kt</td>
		</tr>
		<tr>
			<td valign='top' colspan='2'>22. Kỷ luật: $kl</td>
		</tr>
		<tr>
			<td valign='top' colspan='2'>23.  Tình trạng sức khỏe: $hea_fk , Chiều cao: $hea_hig cm, Cân nặng: $hea_wei kg, Nhóm máu: $blood_type</td>
		</tr>
		<tr>
			<td valign='top'>24. Là  thương binh hạng: $inv_fk</td>
			<td valign='top'>Là con gia đình chính sách: $ousc_code</td>
		</tr>
		<tr>
			<td valign='top'>25. Số  chứng minh nhân dân: $id_card</td>
			<td valign='top'>Ngày cấp: $id_card_date</td>
		</tr>
		<tr>
			<td valign='top' colspan='2'>26. Số sổ BHXH: $maso_bhxh</td>
		</tr>
		<tr>
			<td valign='top' colspan='2'>27. ĐÀO  TẠO, BỒI DƯỠNG VỀ CHUYÊN MÔN, NGHIỆP VỤ, LÝ LUẬN CHÍNH TRỊ, NGOẠI NGỮ, TIN HỌC</td>
		</tr>
	</table>
	<table border='1' style='border-collapse: collapse' cellspacing='0' cellpadding='2' width='97%'>
	  <tr>
	    <td width='119'><p align='center'>Tên trường </p></td>
	    <td width='119'><p align='center'>Chuyên ngành đào tạo, bồi dưỡng </p></td>
	    <td width='138'><p align='center'>Năm</p></td>
	    <td width='100'><p align='center'>Hình thức đào    tạo </p></td>
	    <td width='119'><p align='center'>Văn bằng, chứng chỉ, trình độ gì </p></td>
	  </tr>
	  $dtao
	</table>
	<p>28. TÓM TẮT QUÁ TRÌNH CÔNG TÁC</p>
	<table border='1' style='border-collapse: collapse' cellspacing='0' cellpadding='2' width='97%'>
	  <tr>
	    <td width='200'>
	      Tháng/Năm</td>
	    <td width='390'><p>Chức danh, chức vụ, đơn vị công tác (đảng, chính quyền, đoàn thể, tổ chức xã hội), kể cả thời gian được đào tạo, bồi dưỡng về chuyên môn, nghiệp vụ,…</p></td>
	  </tr>
	  $qtct
	</table>
	<p>29.  DIỄN BIẾN QUÁ TRÌNH LƯƠNG CỦA VIÊN CHỨC</p>
	<table border='1' style='border-collapse: collapse' cellspacing='0' cellpadding='2' width='97%'>
	  <tr>
	    <td width='150' valign='top' align='center'>Tháng/Năm</td>
	    <td width='100' valign='top' align='center'><p>Mã ngạch</p></td>
	    <td width='190' valign='top' align='center'><p>Tên ngạch</p></td>
	    <td width='50' valign='top' align='center'><p>Bậc</p></td>
	    <td width='100' valign='top' align='center'><p>Hệ số lương</p></td>
	  </tr>
	  $luong
	</table>
	<p>30. NHẬN  XÉT, ĐÁNH GIÁ CỦA CƠ QUAN, ĐƠN VỊ QUẢN LÝ VÀ SỬ DỤNG VIÊN CHỨC<br /></p>
	<p class='center'>
............................................................................................................................................................... <br />
............................................................................................................................................................... <br />
............................................................................................................................................................... <br />
............................................................................................................................................................... <br />
............................................................................................................................................................... <br />
............................................................................................................................................................... </p>
	<table border='0' cellspacing='0' cellpadding='0' width='97%'>
	  <tr>
	    <td width='300' valign='top' align='center'><br />
	        <strong>Người khai</strong><br />
	      Tôi    xin cam đoan những<br />
	      lời khai trên đây là đúng sự thật
	      <p align='center'>&nbsp;</p>
	      <p align='center'><strong>$e_name</strong></p></td>
	    <td width='300' valign='top'><p align='center'><em>................, Ngày…… tháng…… năm .......</em><br />
	      <b>Thủ    trưởng cơ quan, đơn vị quản lý và sử dụng viên chức</b><br />
	      (Ký    tên, đóng dấu)</p></td>
	  </tr>
	</table></td></tr></table>";
	echo $word;
?>		