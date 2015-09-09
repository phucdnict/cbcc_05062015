<?php
defined('_JEXEC') or die('Restricted access');
?>
<table id="tblPhuluc1" class="table table-bordered">
<thead>
<tr style="background: #ECECEC;">
	<th class="center" style="vertical-align:middle;" rowspan="3">STT</th>
	<th class="center" style="vertical-align:middle;" rowspan="3">Đơn vị</th>
	<th class="center" style="vertical-align:middle;" rowspan="3">Số lượng Tổ trưởng Tổ dân phố</th>
	<th class="center" style="vertical-align:middle;" colspan="2">Giới tính</th>
	<th class="center" style="vertical-align:middle;" colspan="6">Độ tuổi</th>
	<th class="center" style="vertical-align:middle;" rowspan="3">Đảng viên</th>
	<th class="center" style="vertical-align:middle;" colspan="6">Trình độ</th>
	<th class="center" style="vertical-align:middle;" colspan="5">Nghề nghiệp hiện tại</th>
	<th class="center" style="vertical-align:middle;" colspan="2">BHYT</th>
	<th class="center" style="vertical-align:middle;" colspan="3">Số hộ/TDP</th>
	<th class="center" style="vertical-align:middle;" colspan="3">Số hộ/thôn</th>
	<th class="center" style="vertical-align:middle;" colspan="4">Kiêm nhiệm</th>
	<th class="center" style="vertical-align:middle;" colspan="5">Thời gian công tác</th>
	<th class="center" style="vertical-align:middle;" rowspan="3">Đã nhận bằng khen của Chủ tịch UBND thành phố (thâm niên >= 15 năm)</th>
	<th class="center" style="vertical-align:middle;" rowspan="3">Đã qua đào tạo, bồi dưỡng nghiệp vụ dành cho TT TDP</th>
</tr>
<tr style="background: #ECECEC;">
	<th class="center" style="vertical-align:middle;" rowspan="2">Nam</th>
	<th class="center" style="vertical-align:middle;" rowspan="2">Nữ</th>
	<th class="center" style="vertical-align:middle;" rowspan="2">Dưới 30</th>
	<th class="center" style="vertical-align:middle;" rowspan="2">Từ 30 đến 45</th>
	<th class="center" style="vertical-align:middle;" rowspan="2">Từ 46 đến 60</th>
	<th class="center" style="vertical-align:middle;" rowspan="2">Từ 61 đến dưới 70</th>
	<th class="center" style="vertical-align:middle;" rowspan="2">Từ 70 trở lên</th>
	<th class="center" style="vertical-align:middle;" rowspan="2">Không rõ</th>
	<th class="center" style="vertical-align:middle;" rowspan="2">Sau Đại học</th>
	<th class="center" style="vertical-align:middle;" rowspan="2">Đại học</th>
	<th class="center" style="vertical-align:middle;" rowspan="2">Cao đẳng</th>
	<th class="center" style="vertical-align:middle;" rowspan="2">Trung cấp</th>
	<th class="center" style="vertical-align:middle;" rowspan="2">Sơ cấp</th>
	<th class="center" style="vertical-align:middle;" rowspan="2">Chưa qua đào tạo</th>
	<th class="center" style="vertical-align:middle;" colspan="3">Cán bộ công chức đương chức</th>
	<th class="center" style="vertical-align:middle;" rowspan="2">Nghề tự do</th>
	<th class="center" style="vertical-align:middle;" rowspan="2">Hưu trí</th>
	<th class="center" style="vertical-align:middle;" rowspan="2">BHYT do ngân sách thành phố cấp</th>
	<th class="center" style="vertical-align:middle;" rowspan="2">Diện khác</th>
	<th class="center" style="vertical-align:middle;" rowspan="2">Dưới 30 hộ/TDP</th>
	<th class="center" style="vertical-align:middle;" rowspan="2">Từ 30 - 40 hộ/TDP</th>
	<th class="center" style="vertical-align:middle;" rowspan="2">Trên 40 hộ/TDP</th>
	<th class="center" style="vertical-align:middle;" rowspan="2">Dưới 350 hộ/thôn</th>
	<th class="center" style="vertical-align:middle;" rowspan="2">Từ 350-500 hộ/thôn</th>
	<th class="center" style="vertical-align:middle;" rowspan="2">Trên 500 hộ/thôn</th>
	<th class="center" style="vertical-align:middle;" rowspan="2">Tổng số kiêm nhiệm</th>
	<th class="center" style="vertical-align:middle;" colspan="3">Chức danh kiêm nhiệm</th>
	<th class="center" style="vertical-align:middle;" rowspan="2">Dưới 5 năm</th>
	<th class="center" style="vertical-align:middle;" rowspan="2">Từ 5 đến dưới 10 năm</th>
	<th class="center" style="vertical-align:middle;" rowspan="2">Từ 10 năm đến dưới 15 năm</th>
	<th class="center" style="vertical-align:middle;" rowspan="2">Từ 15 năm trở lên</th>
	<th class="center" style="vertical-align:middle;" rowspan="2">Không rõ</th>
</tr>
<tr style="background: #ECECEC;">
	<th class="center" style="vertical-align:middle;">Cấp thành phố</th>
	<th class="center" style="vertical-align:middle;">Cấp quận, huyện</th>
	<th class="center" style="vertical-align:middle;">Cấp phường, xã</th>
	<th class="center" style="vertical-align:middle;">Bí thư chi bộ</th>
	<th class="center" style="vertical-align:middle;">Phó Bí thư chi bộ</th>
	<th class="center" style="vertical-align:middle;">Chức danh khác</th>
</tr>
</thead>
<tbody id="tbodyPhuluc1">
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
<tr id="tr_phuluc1_<?php echo $ds_donvi['id']; ?>"<?php echo($ds_donvi['kieu'] == '2')?' class="success"':' class="warning"'; ?>>
<script type="text/javascript">
jQuery(document).ready(function($){
	getDataPhuluc1('<?php echo $stt;?>','<?php echo $ds_donvi['id'];?>','<?php echo $ds_donvi['ten'];?>','<?php echo $ds_donvi['kieu'];?>','<?php echo $ds_donvi['lft'];?>','<?php echo $ds_donvi['rgt'];?>');
});
</script>
</tr>
<?php }?>
</tbody>
</table>
