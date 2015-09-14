<?php
/**
 * Author: Phucnh
 * Date created: Sep 10, 2015
 * Company: DNICT
 */
$row_canbo = $this->array_canbo;
$row_chucdanh = $this->array_chucdanh;
?>
<table class="table table-bordered">
	<thead>
		<tr style="background: #ECECEC;">
		  <th rowspan="3">STT</th>
		  <th rowspan="3">HỌ VÀ TÊN</th>
		  <th rowspan="2" colspan="2">Ngày, tháng, năm sinh</th>
		  <th rowspan="3">Tháng, năm bắt đầu tham gia BHXH</th>
		  <th rowspan="3">Đảng viên</th>
		  <th rowspan="3">Dân tộc</th>
		  <th rowspan="3">Tôn giáo</th>
		  <th colspan="3">Đại biểu HĐND</th>
		  <th rowspan="3">Tham gia cấp uỷ cấp xã</th>
		  <th rowspan="2" colspan="3">Trình độ văn hoá</th>
		  <th rowspan="2" colspan="6">Trình độ chuyên môn</th>
		  <th rowspan="2" colspan="4">Trình độ lý luận chính trị</th>
		  <th rowspan="2" colspan="3">Trình độ quản lý nhà nước</th>
		  <th rowspan="2" colspan="4">Trình độ tin học</th>
		  <th rowspan="2" colspan="4">Trình độ ngoại ngữ</th>
		  <th  rowspan="3">Tr.độ an ninh</th>
		  <th  rowspan="3">Tr.độ Q. phòng</th>
		  <th colspan="7">Chia theo độ tuổi</th>
		  <th rowspan="2" colspan="4">Thời gian công tác có tham gia BHXH</th>
		  <th rowspan="3">Ghi chú</th>
		</tr>
		<tr style="background: #ECECEC;">
		  <th rowspan="2">Xã</th>
		  <th rowspan="2">Huyện</th>
		  <th rowspan="2">Tỉnh</th>
		  <th  rowspan="2">Từ 30 trở xuống</th>
		  <th  rowspan="2">Từ 31 đến 40</th>
		  <th  rowspan="2">Từ 41 đến 50</th>
		  <th  colspan="3">Từ 51 đến 60</th>
		  <th  rowspan="2">Trên 60 tuổi</th>
	 </tr>
	 <tr style="background: #ECECEC;">
		  <th>Nam</th>
		  <th>Nữ</th>
		  <th>Tiểu  học</th>
		  <th>TH CS</th>
		  <th>THPT</th>
		  <th>Chưa qua ĐT</th>
		  <th>SC</th>
		  <th>TC</th>
		  <th>CĐ</th>
		  <th>ĐH</th>
		  <th>Thạc sỹ, tiến sỹ</th>
		  <th>SC</th>
		  <th>TC</th>
		  <th>CC</th>
		  <th>CN</th>
		  <th>Chưa qua đào tạo</th>
		  <th>Chuyên viên và tuơng đương</th>
		  <th>Chuyên viên chính và tương đương</th>
		  <th>Chứng chỉ (A, B, C)</th>
		  <th>TC</th>
		  <th>CĐ</th>
		  <th>ĐH</th>
		  <th>Chứng chỉ (A, B, C)</th>
		  <th>TC</th>
		  <th>CĐ</th>
		  <th>ĐH</th>
		  <th >Tổng số</th>
		  <th >Nữ từ 51 đến 55</th>
		  <th>Nam từ 56 đến 60</th>
		  <th><15 năm</th>
		  <th>15-20 năm</th>
		  <th>21-30 năm</th>
		  <th>>30 năm</th>
	 </tr>
	 <tr style="background: #ECECEC;">
		  <th>A</th>
		  <?php for($i=1;$i<=49;$i++){?>
		  <th><?php echo $i?></th>
		  <?php }?>
	 </tr>
	</thead>
	<tbody>
		<?php  for($i=0; $i<count($row_chucdanh); $i++){ 
			$chucdanh = $row_chucdanh[$i];
		?>
		<tr>
			<td></td>
			<td colspan='49'><b><i><?php echo $chucdanh->relation_name;?></i></b></td>
		</tr>
		<?php $k =1;for($j=0; $j<count($row_canbo);$j++){?>
			<?php if($row_canbo[$j]->congtac_chucvu_id == $chucdanh->relation_id) {?>
			<tr id="tr_phuluc1_<?php echo $ds_donvi['id']; ?>"<?php echo($ds_donvi['kieu'] == '2')?' class="success"':' class="warning"'; ?>>
			<script type="text/javascript">
			jQuery(document).ready(function($){
				getDataPhuluc1('<?php echo $stt;?>','<?php echo $ds_donvi['id'];?>','<?php echo $ds_donvi['ten'];?>','<?php echo $ds_donvi['kieu'];?>','<?php echo $ds_donvi['lft'];?>','<?php echo $ds_donvi['rgt'];?>');
			});
			</script>
			</tr>
			<tr>
				<td><?php echo ($k).'.'.$row_canbo[$j]->hosochinh_id;;?></td>
				<td><?php echo $row_canbo[$j]->hoten;?></td>
				<td><?php if($row_canbo[$j]->gioitinh == 'Nam') if($row_canbo[$j]->danhdaunamsinh==1) echo date('Y', strtotime($row_canbo[$j]->ngaysinh)); else echo date('d/m/Y', strtotime($row_canbo[$j]->ngaysinh)) ;?></td>
				<td><?php if($row_canbo[$j]->gioitinh == 'Nu') if($row_canbo[$j]->danhdaunamsinh==1) echo date('Y', strtotime($row_canbo[$j]->ngaysinh)); else echo date('d/m/Y', strtotime($row_canbo[$j]->ngaysinh)) ;?></td>
				<td><?php if($row_canbo[$j]->ngaybatdau_bhxh != null) echo date('d/m/Y', strtotime($row_canbo[$j]->ngaybatdau_bhxh));?></td>
				<td><?php if($row_canbo[$j]->dang_danhdaudangvien >0) echo '1';?></td>
				<td><?php echo $row_canbo[$j]->dantoc;?></td>
				<td><?php echo $row_canbo[$j]->tongiao;?></td>
				<td><?php if($row_canbo[$j]->elec_prov >0) echo '1';?></td>
				<td><?php if($row_canbo[$j]->elec_dist >0) echo '1';?></td>
				<td><?php if($row_canbo[$j]->elec_comm >0) echo '1';?></td>
				<td></td>
				<td><?php if($row_canbo[$j]->tieuhoc>0) echo '1';?></td>
				<td><?php if($row_canbo[$j]->thcs>0) echo '1';?></td>
				<td><?php if($row_canbo[$j]->phothong>0) echo '1';?></td>
				<td><?php if(($row_canbo[$j]->cm_thacsi + $row_canbo[$j]->cm_daihoc +$row_canbo[$j]->cm_caodang +$row_canbo[$j]->cm_trungcap+$row_canbo[$j]->cm_socap)==0) echo '1';?></td>
				<td><?php if($row_canbo[$j]->cm_thacsi>0) echo $row_canbo[$j]->cm_thacsi;?></td>
				<td><?php if($row_canbo[$j]->cm_daihoc>0) echo $row_canbo[$j]->cm_daihoc;?></td>
				<td><?php if($row_canbo[$j]->cm_caodang>0) echo $row_canbo[$j]->cm_caodang;?></td>
				<td><?php if($row_canbo[$j]->cm_trungcap>0) echo $row_canbo[$j]->cm_trungcap;?></td>
				<td><?php if($row_canbo[$j]->cm_socap>0) echo $row_canbo[$j]->cm_socap;?></td>
				<td><?php if($row_canbo[$j]->llct_socap>0) echo $row_canbo[$j]->llct_socap;?></td>
				<td><?php if($row_canbo[$j]->llct_trungcap>0) echo $row_canbo[$j]->llct_trungcap;?></td>
				<td><?php if($row_canbo[$j]->llct_caodang>0) echo $row_canbo[$j]->llct_caodang;?></td>
				<td></td>
				<td></td>
				<td><?php if($row_canbo[$j]->qlnn_cv>0) echo $row_canbo[$j]->qlnn_cv;?></td>
				<td><?php if($row_canbo[$j]->qlnn_cvc>0) echo $row_canbo[$j]->qlnn_cvc;?></td>
				<td><?php if($row_canbo[$j]->th_chungchi>0) echo $row_canbo[$j]->th_chungchi;?></td>
				<td><?php if($row_canbo[$j]->th_trungcap>0) echo $row_canbo[$j]->th_trungcap;?></td>
				<td><?php if($row_canbo[$j]->th_caodang>0) echo $row_canbo[$j]->th_caodang;?></td>
				<td><?php if($row_canbo[$j]->th_daihoc>0) echo $row_canbo[$j]->th_daihoc;?></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td><?php if($row_canbo[$j]->duoi30>0) echo $row_canbo[$j]->duoi30;?></td>
				<td><?php if($row_canbo[$j]->tu30den40>0) echo $row_canbo[$j]->tu30den40;?></td>
				<td><?php if($row_canbo[$j]->tu40den50>0) echo $row_canbo[$j]->tu40den50;?></td>
				<td><?php if($row_canbo[$j]->tu50den60>0) echo $row_canbo[$j]->tu50den60;?></td>
				<td><?php if($row_canbo[$j]->tu50den55>0) echo $row_canbo[$j]->tu50den55;?></td>
				<td><?php if($row_canbo[$j]->tu55den60>0) echo $row_canbo[$j]->tu55den60;?></td>
				<td><?php if($row_canbo[$j]->tren60>0) echo $row_canbo[$j]->tren60;?></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<?php $k++;}?>
		<?php }?>
		
		<?php }?>
	</tbody>
</table>