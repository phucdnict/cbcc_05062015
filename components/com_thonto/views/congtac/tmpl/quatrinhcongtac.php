<?php
defined ( '_JEXEC' ) or die ( 'Restricted access' );
?>
<div style="clear:both"></div>
<h3 class="header smaller lighter blue">
	Quá trình công tác
	<span class="btn btn-mini btn-danger pull-right inline" id="btn_remove_congtac" style="margin-right: 5px;" 
		data-rel="tooltip" data-placement="top" title="Xóa">
		<i class="icon-trash"></i> Xóa
	</span>
	<a class="btn btn-mini btn-success pull-right inline" id="btn_add_congtac" style="margin-right: 5px;" 
		data-rel="tooltip" data-placement="top" title="Thêm mới"
		 role="button" href="#modal-form" data-toggle="modal">
		<i class="icon-plus"></i> Thêm mới
	</a>
</h3>
<table id="tblcongtac" class="table table-striped table-bordered table-hover" style="margin-top:5px;">
<thead>
<tr>
	<th style="text-align: center;vertical-align: middle;">#</th>
	<th style="text-align: center;vertical-align: middle;">Từ ngày</th>
	<th style="text-align: center;vertical-align: middle;">Đến ngày</th>
	<th style="text-align: center;vertical-align: middle;">Phường xã</th>
	<th style="text-align: center;vertical-align: middle;">Thôn, tổ dân phố</th>
	<th style="text-align: center;vertical-align: middle;">Chức vụ</th>
	<th style="text-align: center;vertical-align: middle;">Thao tác</th>
</tr>
</thead>
<tbody>
<?php 
for($i = 0, $n = count($this->items); $i < $n; $i++){
	$item = $this->items[$i];
?>
<tr class="tr_congtac">
	<td style="text-align: center;vertical-align: middle;">
		<?php if($i == 0){?>
		<input type="hidden" name="id_ct[]"	value="<?php echo $item['id']?>">
		<?php }else{?>
		<input type="checkbox" name="id_ct[]"	value="<?php echo $item['id']?>"><span class="lbl"></span>
		<?php }?>
	</td>
	<td style="text-align: center;vertical-align: middle;">
		<?php echo ($item['ngaybatdau']);?>
	</td>
	<td style="text-align: center;vertical-align: middle;">
		<?php echo ($item['ngayketthuc']);?>
	</td>
	<td style="vertical-align: middle;">
		<?php echo $item['phuongxa'];?>
	</td>
	<td style="vertical-align: middle;">
		<?php echo $item['thonto'];?>
	</td>
	<td style="vertical-align: middle;">
		<?php echo $item['chucvu'];?>
	</td>
	<td style="text-align: center;vertical-align: middle;">
		<div class="btn-group">
			<span class="btn btn-mini btn-info btn_edit_congtac" id_quatrinh="<?php echo $item['id']; ?>" data-rel="tooltip" data-placement="top"
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