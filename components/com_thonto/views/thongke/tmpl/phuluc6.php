<?php
/**
 * Author: Phucnh
 * Date created: Aug 17, 2015
 * Company: DNICT
 */
$row=$this->row;
$row_noidunghop = $this->row_noidunghop;
$sl_noidunghop = count($row_noidunghop);
?>
<table class="table table-striped table-bordered" id="tblThongkemau6">
	<thead>
		<tr style="background: #ECECEC;">
			<th rowspan="4" style="vertical-align: middle; text-align: center;">STT</th>
			<th rowspan="4" style="min-width: 200px; text-align: center;">Tên đơn vị</th>
			<th rowspan="4" style="text-align: center;">Lập sổ theo dõi hoạt động của tổ dân phố, thôn</th>
			<th colspan="<?php echo $sl_noidunghop+7;?>" style="text-align: center; height: 21px">Họp giao ban giữa UBND phường, xã và tổ trưởng TDP, trưởng thôn</th>
		</tr>
		<tr style="background: #ECECEC;">
			<th colspan="<?php echo $sl_noidunghop+6;?>" style="vertical-align: middle; text-align: center;">Có</th>
			<th rowspan="3" style="vertical-align: middle; text-align: center;">Không</th>
		</tr>
		<tr style="background: #ECECEC;">
			<th colspan="3" style="vertical-align: middle; text-align: center;">Thành phần tham dự</th>
			<th colspan="<?php echo $sl_noidunghop;?>" style="vertical-align: middle; text-align: center;">Nội dung họp</th>
			<th rowspan="2" style="vertical-align: middle; text-align: center;">Số lượng vắng</th>
			<th colspan="2" style="vertical-align: middle; text-align: center;">Kiến nghị tại cuộc họp</th>
		</tr>
		<tr style="background: #ECECEC;">
			<th style="vertical-align: middle; text-align: center;">Mời Bí thư đảng ủy, Chủ tịch UBMTTQVN phường, xã và Bí thư Chi bộ, Trưởng ban Công tác mặt trận</th>
			<th style="vertical-align: middle; text-align: center;">Mời Bí thư đảng ủy, Chủ tịch UBMTTQVN phường, xã</th>
			<th style="vertical-align: middle; text-align: center;">Mời Bí thư Chi bộ, Trưởng ban Công tác mặt trận</th>
			<?php for($i=0; $i<$sl_noidunghop; $i++){?>
			<th style="vertical-align: middle; text-align: center;"><?php echo $row_noidunghop[$i]->ten?></th>
			<?php }?>
			<th style="vertical-align: middle; text-align: center;">Số lượng</th>
			<th style="vertical-align: middle; text-align: center;">Đã giải quyết</th>
		</tr>
	</thead>
	<tbody id="tbodyPhuluc6">
<?php 
$stt = 0;
for($i = 0, $n = count($this->ds_donvi); $i < $n; $i++){
	$ds_donvi = $this->ds_donvi[$i];
	if($ds_donvi['kieu'] == '2'){
		$stt = 0;
	}else{
		$stt++;
	}
?>
<tr id="tr_phuluc6_<?php echo $ds_donvi['id']; ?>"<?php echo($ds_donvi['kieu'] == '2')?' class="success"':' class="warning"'; ?>>
<script type="text/javascript">
jQuery(document).ready(function($){
	getDataPhuluc6('<?php echo $stt;?>','<?php echo $ds_donvi['id'];?>','<?php echo $ds_donvi['ten'];?>','<?php echo $ds_donvi['kieu'];?>','<?php echo $ds_donvi['lft'];?>','<?php echo $ds_donvi['rgt'];?>');
});
</script>
</tr>
<?php }?>
</tbody>
</table>