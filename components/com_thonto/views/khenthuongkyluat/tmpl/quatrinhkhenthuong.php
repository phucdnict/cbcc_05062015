<?php
defined('_JEXEC') or die('Restricted access');
?>
<div style="clear: both;"></div>
<h3 class="header smaller lighter blue">
	Quá trình khen thưởng
	<span class="btn btn-mini btn-danger pull-right inline" id="btn_remove_khenthuong" style="margin-right: 5px;" 
		data-rel="tooltip" data-placement="top" title="Xóa">
		<i class="icon-trash"></i> Xóa
	</span>
	<a class="btn btn-mini btn-success pull-right inline" id="btn_add_khenthuong" style="margin-right: 5px;" 
		data-rel="tooltip" data-placement="top" title="Thêm mới"
		 role="button" href="#modal-form" data-toggle="modal">
		<i class="icon-plus"></i> Thêm mới
	</a>
</h3>
<table id="tblKhenthuong" class="table table-striped table-bordered table-hover">
<thead>
<tr>
	<th class="center" style="vertical-align:middle;">#</th>
	<th class="center" style="vertical-align:middle;">Ngày quyết định</th>
	<th class="center" style="vertical-align:middle;">Hình thức</th>
	<th class="center" style="vertical-align:middle;">Số quyết định</th>
	<th class="center" style="vertical-align:middle;">Cơ quan quyết định</th>
	<th class="center" style="vertical-align:middle;">Người ký quyết định</th>
	<th class="center" style="vertical-align:middle;">Thao tác</th>
</tr>
</thead>
<tbody>
<?php 
for($i = 0, $n = count($this->items); $i < $n; $i++){
	$item = $this->items[$i];
?>
<tr class="tr_khenthuong">
	<td style="text-align: center;vertical-align: middle;">
		<input type="checkbox" name="id_kt[]" value="<?php echo $item['id']?>"><span class="lbl"></span>
	</td>
	<td style="text-align: center;vertical-align: middle;">
		<?php echo $item['ngayquyetdinh'];?>
	</td>
	<td style="text-align: center;vertical-align: middle;">
		<?php echo $item['hinhthuc'];?>
	</td>
	<td style="text-align: left;vertical-align: middle;">
		<?php echo $item['soquyetdinh'];?>
	</td>
	<td style="text-align: left;vertical-align: middle;">
		<?php echo $item['coquanquyetdinh'];?>
	</td>
	<td style="text-align: left;vertical-align: middle;">
		<?php echo $item['nguoiky'];?>
	</td>
	<td style="text-align: center;vertical-align: middle;">
		<div class="btn-group">
			<span class="btn btn-mini btn-info btn_edit_khenthuong" id_quatrinh="<?php echo $item['id']; ?>" data-rel="tooltip" data-placement="top"
			 title="Điều chỉnh" role="button" href="#modal-form" data-toggle="modal">
				<i class="icon-edit"></i>
			</span>
		</div>
	</td>
</tr>
<?php 
}
?>
</tbody>
</table>
<script type="text/javascript">
jQuery(document).ready(function($){
	$('[data-rel=tooltip]').tooltip();
});
</script>