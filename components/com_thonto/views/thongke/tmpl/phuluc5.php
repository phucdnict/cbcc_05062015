<?php
/**
 * Author: Phucnh
 * Date created: Aug 17, 2015
 * Company: DNICT
 */
$row_kiennghi = $this->row_kiennghi;
$sl_kiennghi = count($row_kiennghi);
$ds_donvi = $this->ds_donvi;
?>
<table class="table table-striped table-bordered" id="tblThongkemau5">
	<thead>
		<tr style="background: #ECECEC;">
			<th rowspan="2" style="vertical-align: center; text-align: center;">STT</th>
			<th rowspan="2" style="min-width: 200px; text-align: center;">Đơn vị</th>
			<th colspan="2" style="text-align: center; height: 21px">Số lần họp TDP, thôn</th>
			<th colspan="2" style="vertical-align: center; text-align: center;">Thành phần tham dự</th>
			<th colspan="2" style="vertical-align: center; text-align: center;">Số lượng đại diện hộ gia đình tham gia</th>
			<th colspan="<?php echo $sl_kiennghi;?>" style="text-align: center; height: 21px">Số lượng kiến nghị tại cuộc họp</th>
			<th colspan="3" style="vertical-align: center; text-align: center;">Số lượng kiến nghị đã giải quyết</th>
			<th rowspan="2" style="vertical-align: center; text-align: center;">Họp giao ban quân, dân chính</th>
			<th rowspan="2" style="vertical-align: center; text-align: center;">Số lượng tổ trưởng TDP, trưởng thôn nghỉ trên 30 ngày được UBND phường bố trí người thay thế</th>
			<th colspan="2" style="vertical-align: center; text-align: center;">Đánh giá thực hiện 04 nhiệm vụ trọng tâm</th>
		</tr>
		<tr style="background: #ECECEC;">
			<th style="vertical-align: center; text-align: center;">Định kỳ</th>
			<th style="vertical-align: center; text-align: center;">Đột xuất</th>
			<th style="vertical-align: center; text-align: center;">Đầy đủ thành phần theo quy định</th>
			<th style="vertical-align: center; text-align: center;">Không đầy đủ</th>
			<th style="vertical-align: center; text-align: center;">Số lượng</th>
			<th style="vertical-align: center; text-align: center;">Tỉ lệ (%)</th>
			<?php for($i=0; $i<$sl_kiennghi; $i++){?>
			<th style="vertical-align: center; text-align: center;"><?php echo $row_kiennghi[$i]->ten?></th>
			<?php }?>
			<th style="vertical-align: center; text-align: center;">TDP, thôn giải quyết</th>
			<th style="vertical-align: center; text-align: center;">UBND phường, xã giải quyết</th>
			<th style="vertical-align: center; text-align: center;">UBND quận, huyện trở lên</th>
			<th style="vertical-align: center; text-align: center;">Đạt</th>
			<th style="vertical-align: center; text-align: center;">Không đạt</th>
		</tr>
	</thead>
	<tbody id="tbody_thongkemau5">
		<?php 
			$stt = 0;
			for($i = 0, $n = count($this->ds_donvi); $i < $n; $i++){
				$ds_donvi = $this->ds_donvi[$i];
				if($ds_donvi['kieu'] == '2'){
					$stt = 0;
				}else if($ds_donvi['kieu'] == '4' || $ds_donvi['kieu'] == '5'){
				}else{
					$stt++;
				}
			?>
			<tr id="tr_phuluc5_<?php echo $ds_donvi['id']; ?>"<?php echo($ds_donvi['kieu'] == '2')?' class="success"':' class="warning"'; ?>>
			<script type="text/javascript">
			jQuery(document).ready(function($){
				getDataPhuluc5('<?php echo $stt;?>','<?php echo $ds_donvi['id'];?>','<?php echo $ds_donvi['ten'];?>','<?php echo $ds_donvi['kieu'];?>','<?php echo $ds_donvi['lft'];?>','<?php echo $ds_donvi['rgt'];?>');
			});
			</script>
			</tr>
			<?php }?>
	</tbody>
</table>