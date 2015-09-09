<?php
defined('_JEXEC') or die('Restricted access');
?>
<h3 class="header smaller lighter blue">
	Tìm kiếm
	<span class="pull-right inline">
		<a class="btn btn-small btn-primary" id="btn_timkiem" style="margin-right: 5px;">
			<i class="icon-search"></i> Tìm kiếm
		</a>
	</span>
</h3>
<form id="timkiemForm" name="timkiemForm" class="form-horizontal" action="index.php">
<div style="float:left;width:800px;">
	<div class="control-group">
		<label class="control-label" for="timkiem_hoten">Họ và tên</label>
		<div class="controls">
			<input type="text" id="timkiem_hoten" name="timkiem[hoten]" value="" />
		</div>
	</div>
</div>
<div style="float:left;width:800px;">
	<div class="control-group">
		<label class="control-label" for="timkiem_congtac_chucvu_id">Chức vụ</label>
		<div class="controls">
			<?php echo ThontoHelper::selectBoxAndAttr('',
					array('id'=>'timkiem_congtac_chucvu_id','name'=>'timkiem[congtac_chucvu_id][]','data-placeholder'=>'Chọn chức vụ...','multiple'=>'multiple'),
					'thonto_chucvu',array('id','ten'),array('trangthai = 1')); ?>
		</div>
	</div>
</div>
<div style="float:left;width:800px;">
	<div class="control-group">
		<label class="control-label" for="timkiem_phuongxa">Phường, xã</label>
		<div class="controls">
			<input type="hidden" id="timkiem_phuongxa_id" name="timkiem[phuongxa_id]" value="" />
			<?php echo ThontoHelper::selectBoxAndAttr('',
					array('id'=>'timkiem_phuongxa','name'=>'timkiem[phuongxa][]','data-placeholder'=>'Chọn phường xã...','multiple'=>'multiple'),
					'thonto_tochuc',array('id','ten','donvi_id'),array('trangthai_id = 1 AND kieu = 3')); ?>
		</div>
	</div>
</div>
<div style="float:left;width:800px;">
	<div class="control-group">
		<label class="control-label" for="timkiem_congtac_donvi_id">Thôn, tổ dân phố</label>
		<div class="controls">
			<select id="timkiem_congtac_donvi_id" name="timkiem[congtac_donvi_id][]" data-placeholder="Chọn thôn, tổ dân phố..." multiple="multiple">
				<option value=""></option>
			</select>
		</div>
	</div>
</div>
<div style="float:left;width:800px;">
	<div class="control-group">
		<label class="control-label" for="timkiem_nghenghiephientai">Nghề nghiệp hiện tại</label>
		<div class="controls">
			<?php echo ThontoHelper::selectBoxAndAttr('',
					array('id'=>'timkiem_nghenghiephientai','name'=>'timkiem[nghenghiephientai][]','data-placeholder'=>'Chọn phường xã...','multiple'=>'multiple'),
					'thonto_nghenghiephientai',array('id','ten')); ?>
		</div>
	</div>
</div>
<input type="hidden" name="option" value="com_thonto" />
<input type="hidden" name="controller" value="timkiem" />
<input type="hidden" name="view" value="timkiem" />
<input type="hidden" name="format" value="raw" />
<input type="hidden" name="task" value="ketqua" />
</form>
<div style="clear: both;"></div>
<div id="div_result"></div>
<script type="text/javascript">
jQuery(document).ready(function($){
	$('#timkiem_congtac_chucvu_id').chosen({width: '400px', allow_single_deselect: true, search_contains: true});
	$('#timkiem_phuongxa').chosen({
		width: '400px', 
		allow_single_deselect: true, 
		search_contains: true
	}).on('change', function(){
		var phuongxa_ids = $(this).val();
		$('#timkiem_phuongxa_id').val($(this).val().join(','));
		$.post('index.php',{option:'com_thonto',controller:'timkiem',task:'getThonto',phuongxa_ids:phuongxa_ids}, function(data){
			var xhtml = '<option value=""></option>';
			$.each(data, function(i,v){
				xhtml+= '<option value="'+v.id+'">'+v.ten+'</option>';
			});
			$('#timkiem_congtac_donvi_id').html(xhtml);
			$('#timkiem_congtac_donvi_id').trigger('chosen:updated');
		});
	});
	$('#timkiem_congtac_donvi_id').chosen({width: '400px', allow_single_deselect: true, search_contains: true});
	$('#timkiem_nghenghiephientai').chosen({width: '400px', allow_single_deselect: true, search_contains: true});
	$('#btn_timkiem').on('click', function(){
		$.blockUI();
		$('#div_result').load('index.php', $('#timkiemForm').serialize(), function(){
			$.unblockUI();
		});
	});
});
</script>