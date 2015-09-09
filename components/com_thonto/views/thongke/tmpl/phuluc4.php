<?php
/**
 * Author: Phucnh
 * Date created: Aug 17, 2015
 * Company: DNICT
 */
$ds_donvi = $this->ds_donvi;
?>
<style>
.table tbody tr.success > td {
    background-color: #dff0d8;
}
</style>
<table class="table table-striped table-bordered" id="tblThongkemau4">
	<thead>
		<tr style="background: #ECECEC;">
			<th rowspan="2" style="min-width: 200px; text-align: center;">Đơn vị</th>
			<th rowspan="2" style="text-align: center; height: 21px">Tổng số tổ chức</th>
			<th colspan="2" style="vertical-align: middle; text-align: center;">Tổ dân phố / thôn	</th>
			<th colspan="2" style="vertical-align: middle; text-align: center;">Chi bộ</th>
			<th colspan="2" style="vertical-align: middle; text-align: center;">Ban công tác Mặt trận</th>
			<th rowspan="2" style="vertical-align: middle; text-align: center;">Chi hội Phụ nữ</th>
			<th rowspan="2" style="vertical-align: middle; text-align: center;">Chi hội cựu chiến binh</th>
			<th rowspan="2" style="vertical-align: middle; text-align: center;">Bí thư Chi đoàn TNCSHCM</th>
			<th rowspan="2" style="vertical-align: middle; text-align: center;">Chi hội Nông dân</th>
			<th rowspan="2" style="vertical-align: middle; text-align: center;">Tổ dân vận</th>
			<th rowspan="2" style="vertical-align: middle; text-align: center;"> Bảo vệ Dân phố</th>
			<th rowspan="2" style="vertical-align: middle; text-align: center;">Công an viên</th>
		</tr>
		<tr style="background: #ECECEC;">
			<th style="vertical-align: middle; text-align: center;">Tổ trưởng / Trưởng thôn</th>
			<th style="vertical-align: middle; text-align: center;">Phó thôn (đối với xã)</th>
			<th style="vertical-align: middle; text-align: center;">Bí thư</th>
			<th style="vertical-align: middle; text-align: center;">Phó Bí thư</th>
			<th style="vertical-align: middle; text-align: center;">Trưởng ban</th>
			<th style="vertical-align: middle; text-align: center;">Phó ban</th>
		</tr>
		<tr>
		<th style="vertical-align: middle; text-align: center;">[1]</th>
		<th style="vertical-align: middle; text-align: center;">[2]</th>
		<th style="vertical-align: middle; text-align: center;">[3]</th>
		<th style="vertical-align: middle; text-align: center;">[4]</th>
		<th style="vertical-align: middle; text-align: center;">[5]</th>
		<th style="vertical-align: middle; text-align: center;">[6]</th>
		<th style="vertical-align: middle; text-align: center;">[7]</th>
		<th style="vertical-align: middle; text-align: center;">[8]</th>
		<th style="vertical-align: middle; text-align: center;">[9]</th>
		<th style="vertical-align: middle; text-align: center;">[10]</th>
		<th style="vertical-align: middle; text-align: center;">[11]</th>
		<th style="vertical-align: middle; text-align: center;">[12]</th>
		<th style="vertical-align: middle; text-align: center;">[13]</th>
		<th style="vertical-align: middle; text-align: center;">[14]</th>
		<th style="vertical-align: middle; text-align: center;">[15]</th>
		</tr>
	</thead>
	<tbody>
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
<tr id="tr_phuluc4_<?php echo $ds_donvi['id']; ?>"<?php echo($ds_donvi['kieu'] == '2')?' class="success"':' class="warning"'; ?>>
<script type="text/javascript">
jQuery(document).ready(function($){
	getDataPhuluc4('<?php echo $stt;?>','<?php echo $ds_donvi['id'];?>','<?php echo $ds_donvi['ten'];?>','<?php echo $ds_donvi['kieu'];?>','<?php echo $ds_donvi['lft'];?>','<?php echo $ds_donvi['rgt'];?>');
});
</script>
</tr>
<?php }?>
	</tbody>
</table>