<?php
defined ( '_JEXEC' ) or die ( 'Restricted access' );
$item = $this->item;
?>
<div style="clear: both;"></div>
<form id="KyluatFrm" name="KyluatFrm" method="post" class="form-horizontal" enctype="multipart/form-data" action="index.php">
<div style="float:left;width:800px;">
	<div class="control-group">
		<label class="control-label" for="kyluat_hinhthuc_id">Hình thức (<span style="color:red;">*</span>)</label>
		<div class="controls">
			<input type="hidden" id="kyluat_hinhthuc" name="kyluat[hinhthuc]" value="<?php echo $item['hinhthuc'];?>" />
			<?php echo ThontoHelper::selectBoxAndAttr($item['hinhthuc_id'],
					array('id'=>'kyluat_hinhthuc_id','name'=>'kyluat[hinhthuc_id]'),
					'thonto_hinhthuckhenthuongkyluat', array('id','ten'),array("loai = 1 AND trangthai = 1")); ?>
		</div>
	</div>
</div>
<div style="clear: both;"></div>
<div style="float:left;width:400px;">
	<div class="control-group">
		<label class="control-label" for="kyluat_ngayquyetdinh">Ngày ký quyết định (<span style="color:red;">*</span>)</label>
		<div class="controls">
			<div class="row-fluid input-append">
				<input type="text" id="kyluat_ngayquyetdinh" name="kyluat[ngayquyetdinh]" class="input-small date-picker input-mask-date"
				data-date-format="dd/mm/yyyy" value="<?php echo $item['ngayquyetdinh'];?>" />
				<span class="add-on">
					<i class="icon-calendar"></i>
				</span>
			</div>
		</div>
	</div>
</div>
<div style="float:left;width:400px;">
	<div class="control-group">
		<label class="control-label" for="kyluat_soquyetdinh">Số quyết định (<span style="color:red;">*</span>)</label>
		<div class="controls">
			<input type="text" id="kyluat_soquyetdinh" name="kyluat[soquyetdinh]" class="input-medium" value="<?php echo $item['soquyetdinh'];?>" />
		</div>
	</div>
</div>
<div style="float:left;width:400px;">
	<div class="control-group">
		<label class="control-label" for="kyluat_coquanquyetdinh">Cơ quan quyết định (<span style="color:red;">*</span>)</label>
		<div class="controls">
			<input type="text" id="kyluat_coquanquyetdinh" name="kyluat[coquanquyetdinh]" value="<?php echo $item['coquanquyetdinh'];?>" />
		</div>
	</div>
</div>
<div style="float:left;width:400px;">
	<div class="control-group">
		<label class="control-label" for="kyluat_nguoiky">Người ký quyết định (<span style="color:red;">*</span>)</label>
		<div class="controls">
			<input type="text" id="kyluat_nguoiky" name="kyluat[nguoiky]" value="<?php echo $item['nguoiky'];?>" />
		</div>
	</div>
</div>
<input type="hidden" id="kyluat_id_quatrinh" name="kyluat[id_quatrinh]" value="<?php echo $item['id']; ?>" />
<input type="hidden" id="kyluat_hosocanbo_id" name="kyluat[hosocanbo_id]" value="<?php echo JRequest::getInt('idHoso',null); ?>" />
</form>
<div style="clear: both;"></div>
<script type="text/javascript">
jQuery(document).ready(function($){
	$('.date-picker').datepicker({
        startDate: "01/01/1900",
        endDate: "01/01/3000"
    }).next().on(ace.click_event, function(){
		$(this).prev().focus();
	});
	$('.input-mask-date').mask('39/19/2999');
	$('#kyluat_hinhthuc_id').on('change', function(){
		$('#kyluat_hinhthuc').val($(this).find('option:selected').text());
	});
	$('#KyluatFrm').validate({
		ignore:true,
		errorPlacement : function(error, element) {
		
		},
		rules: {
			'kyluat[hinhthuc_id]' : { required : true },
			'kyluat[soquyetdinh]' : { required : true },
			'kyluat[coquanquyetdinh]' : { required : true },
			'kyluat[nguoiky]' : { required : true },
			'kyluat[ngayquyetdinh]' : { required : true, dateVN : true }
		},
		messages: {
			'kyluat[hinhthuc_id]' : { required : 'Chọn hình thức kỷ luật' },
			'kyluat[soquyetdinh]' : { required : 'Nhập số quyết định' },
			'kyluat[coquanquyetdinh]' : { required : 'Nhập cơ quan ra quyết định' },
			'kyluat[nguoiky]' : { required : 'Nhập người ký quyết định' },
			'kyluat[ngayquyetdinh]' : { required : 'Nhâp ngày ký quyết định', dateVN : 'Nhập đúng định dạng ngày ký quyết định' }
		},
		invalidHandler: function (event, validator) {
			var errors = validator.numberOfInvalids();
			if (errors) {
				var message = errors == 1
				? 'Kiểm tra lỗi sau:<br/>'
				: 'Phát hiện ' + errors + ' lỗi sau:<br/>';
				var errors = "";
				if (validator.errorList.length > 0) {
					for (x=0;x<validator.errorList.length;x++) {
						errors += "<br/>\u25CF " + validator.errorList[x].message;
					}
				}
				loadNoticeBoardError('Thông báo',message + errors);
			}
			validator.focusInvalid();
		}
	});
});
</script>