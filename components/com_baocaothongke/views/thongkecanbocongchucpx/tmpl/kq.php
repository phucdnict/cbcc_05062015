<?php
/**
 * Author: Phucnh
 * Date created: Sep 10, 2015
 * Company: DNICT
 */
$row_canbo = $this->array_canbo;
$row_chucdanh = $this->array_chucdanh;
?>
<table class="table table-bordered" id="table_thongkecanbochongchucpx">
	<th class="center" style="vertical-align:middle;"ead>
		<tr style="background: #ECECEC;">
		  <th class="center" style="vertical-align:middle;" rowspan="3">STT</th>
		  <th class="center" style="vertical-align:middle;" rowspan="3">Họ và tên</th>
		  <th class="center" style="vertical-align:middle;" rowspan="2" colspan="2">Ngày, tháng, năm sinh</th>
		  <th class="center" style="vertical-align:middle;" rowspan="3">Tháng, năm bắt đầu tham gia BHXH</th>
		  <th class="center" style="vertical-align:middle;" rowspan="3">Đảng viên</th>
		  <th class="center" style="vertical-align:middle;" rowspan="3">Dân tộc</th>
		  <th class="center" style="vertical-align:middle;" rowspan="3">Tôn giáo</th>
		  <th class="center" style="vertical-align:middle;" colspan="3">Đại biểu HĐND</th>
		  <th class="center" style="vertical-align:middle;" rowspan="3">Tham gia cấp uỷ cấp xã</th>
		  <th class="center" style="vertical-align:middle;" rowspan="2" colspan="3">Trình độ văn hoá</th>
		  <th class="center" style="vertical-align:middle;" rowspan="2" colspan="6">Trình độ chuyên môn</th>
		  <th class="center" style="vertical-align:middle;" rowspan="2" colspan="4">Trình độ lý luận chính trị</th>
		  <th class="center" style="vertical-align:middle;" rowspan="2" colspan="3">Trình độ quản lý nhà nước</th>
		  <th class="center" style="vertical-align:middle;" rowspan="2" colspan="4">Trình độ tin học</th>
		  <th class="center" style="vertical-align:middle;" rowspan="2" colspan="4">Trình độ ngoại ngữ</th>
		  <th class="center" style="vertical-align:middle;"  rowspan="3">Tr.độ an ninh, quốc phòng</th>
		  <th class="center" style="vertical-align:middle;" colspan="7">Chia theo độ tuổi</th>
		  <th class="center" style="vertical-align:middle;" rowspan="2" colspan="4">Thời gian công tác có tham gia BHXH</th>
		  <th class="center" style="vertical-align:middle;" rowspan="3">Ghi chú</th>
		</tr>
		<tr style="background: #ECECEC;">
		  <th class="center" style="vertical-align:middle;" rowspan="2">Xã</th>
		  <th class="center" style="vertical-align:middle;" rowspan="2">Huyện</th>
		  <th class="center" style="vertical-align:middle;" rowspan="2">Tỉnh</th>
		  <th class="center" style="vertical-align:middle;"  rowspan="2">Từ 30 trở xuống</th>
		  <th class="center" style="vertical-align:middle;"  rowspan="2">Từ 31 đến 40</th>
		  <th class="center" style="vertical-align:middle;"  rowspan="2">Từ 41 đến 50</th>
		  <th class="center" style="vertical-align:middle;"  colspan="3">Từ 51 đến 60</th>
		  <th class="center" style="vertical-align:middle;"  rowspan="2">Trên 60 tuổi</th>
	 </tr>
	 <tr style="background: #ECECEC;">
		  <th class="center" style="vertical-align:middle;">Nam</th>
		  <th class="center" style="vertical-align:middle;">Nữ</th>
		  <th class="center" style="vertical-align:middle;">Tiểu  học</th>
		  <th class="center" style="vertical-align:middle;">THCS</th>
		  <th class="center" style="vertical-align:middle;">THPT</th>
		  <th class="center" style="vertical-align:middle;">Chưa qua ĐT</th>
		  <th class="center" style="vertical-align:middle;">SC</th>
		  <th class="center" style="vertical-align:middle;">TC</th>
		  <th class="center" style="vertical-align:middle;">CĐ</th>
		  <th class="center" style="vertical-align:middle;">ĐH</th>
		  <th class="center" style="vertical-align:middle;">Thạc sỹ, tiến sỹ</th>
		  <th class="center" style="vertical-align:middle;">SC</th>
		  <th class="center" style="vertical-align:middle;">TC</th>
		  <th class="center" style="vertical-align:middle;">CC</th>
		  <th class="center" style="vertical-align:middle;">CN</th>
		  <th class="center" style="vertical-align:middle;">Chưa qua đào tạo</th>
		  <th class="center" style="vertical-align:middle;">Chuyên viên và tuơng đương</th>
		  <th class="center" style="vertical-align:middle;">Chuyên viên chính và tương đương</th>
		  <th class="center" style="vertical-align:middle;">Chứng chỉ (A, B, C)</th>
		  <th class="center" style="vertical-align:middle;">TC</th>
		  <th class="center" style="vertical-align:middle;">CĐ</th>
		  <th class="center" style="vertical-align:middle;">ĐH</th>
		  <th class="center" style="vertical-align:middle;">Chứng chỉ (A, B, C)</th>
		  <th class="center" style="vertical-align:middle;">TC</th>
		  <th class="center" style="vertical-align:middle;">CĐ</th>
		  <th class="center" style="vertical-align:middle;">ĐH</th>
		  <th class="center" style="vertical-align:middle;" >Tổng số</th>
		  <th class="center" style="vertical-align:middle;" >Nữ từ 51 đến 55</th>
		  <th class="center" style="vertical-align:middle;">Nam từ 56 đến 60</th>
		  <th class="center" style="vertical-align:middle;"><15 năm</th>
		  <th class="center" style="vertical-align:middle;">15-20 năm</th>
		  <th class="center" style="vertical-align:middle;">21-30 năm</th>
		  <th class="center" style="vertical-align:middle;">>30 năm</th>
	 </tr>
	 <tr style="background: #ECECEC;">
		  <th class="center" style="vertical-align:middle;">A</th>
		  <?php for($i=1;$i<=48;$i++){?>
		  <th class="center" style="vertical-align:middle;"><?php echo $i?></th>
		  <?php }?>
	 </tr>
	</thead>
	<tbody>
		<?php  for($i=0; $i<count($row_chucdanh); $i++){ 
			$chucdanh = $row_chucdanh[$i];
		?>
		<tr>
			<td colspan='48'><b><i><?php echo $chucdanh->relation_name;?></i></b></td>
		</tr>
		<?php $k =1;
			for($j=0; $j<count($row_canbo);$j++){?>
			<?php if($row_canbo[$j]->congtac_chucvu_id == $chucdanh->relation_id) {?>
			<tr id="tr_thongkecanbocongchucpx_<?php echo $j; ?>">
				<script type="text/javascript">
				jQuery(document).ready(function($){
					getData_thongkecanbocongchucpx('<?php echo $k;?>','<?php echo $row_canbo[$j]->hoten;?>','<?php echo $row_canbo[$j]->hosochinh_id;?>','<?php echo $j?>');
				});
				</script>
			</tr>
			<?php $k++;}?>
		<?php }?>
		<?php }?>
	</tbody>
</table>