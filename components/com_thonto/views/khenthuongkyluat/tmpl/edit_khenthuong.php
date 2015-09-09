<?php
defined ( '_JEXEC' ) or die ( 'Restricted access' );
$item = $this->item;
?>
<div style="clear: both;"></div>
<form id="KhenthuongFrm" name="KhenthuongFrm" method="post" class="form-horizontal" enctype="multipart/form-data" action="index.php">
<div style="float:left;width:800px;">
	<div class="control-group">
		<label class="control-label" for="khenthuong_hinhthuc_id">Hình thức (<span style="color:red;">*</span>)</label>
		<div class="controls">
			<input type="hidden" id="khenthuong_hinhthuc" name="khenthuong[hinhthuc]" value="<?php echo $item['hinhthuc'];?>" />
			<?php echo ThontoHelper::selectBoxAndAttr($item['hinhthuc_id'],
					array('name'=>'khenthuong[hinhthuc_id]','id'=>'khenthuong_hinhthuc_id'),
					'thonto_hinhthuckhenthuongkyluat',array('id','ten'),array("loai = 0 AND trangthai = 1")); ?>
		</div>
	</div>
</div>
<div style="clear: both;"></div>
<div style="float:left;width:400px;">
	<div class="control-group">
		<label class="control-label" for="khenthuong_ngayquyetdinh">Ngày ký quyết định (<span style="color:red;">*</span>)</label>
		<div class="controls">
			<div class="row-fluid input-append">
				<input type="text" id="khenthuong_ngayquyetdinh" name="khenthuong[ngayquyetdinh]" class="input-small date-picker input-mask-date"
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
		<label class="control-label" for="khenthuong_soquyetdinh">Số quyết định (<span style="color:red;">*</span>)</label>
		<div class="controls">
			<input type="text" id="khenthuong_soquyetdinh" name="khenthuong[soquyetdinh]" class="input-medium" value="<?php echo $item['soquyetdinh'];?>" />
		</div>
	</div>
</div>
<div style="float:left;width:400px;">
	<div class="control-group">
		<label class="control-label" for="khenthuong_coquanquyetdinh">Cơ quan quyết định (<span style="color:red;">*</span>)</label>
		<div class="controls">
			<input type="text" id="khenthuong_coquanquyetdinh" name="khenthuong[coquanquyetdinh]" value="<?php echo $item['coquanquyetdinh'];?>" />
		</div>
	</div>
</div>
<div style="float:left;width:400px;">
	<div class="control-group">
		<label class="control-label" for="khenthuong_nguoiky">Người ký quyết định (<span style="color:red;">*</span>)</label>
		<div class="controls">
			<input type="text" id="khenthuong_nguoiky" name="khenthuong[nguoiky]" value="<?php echo $item['nguoiky'];?>" />
		</div>
	</div>
</div>
<input type="hidden" id="khenthuong_id_quatrinh" name="khenthuong[id_quatrinh]" value="<?php echo $item['id']; ?>" />
<input type="hidden" id="khenthuong_hosocanbo_id" name="khenthuong[hosocanbo_id]" value="<?php echo JRequest::getInt('idHoso',null); ?>" />
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
	$('#khenthuong_hinhthuc_id').on('change', function(){
		$('#khenthuong_hinhthuc').val($(this).find('option:selected').text());
	});
	$('#KhenthuongFrm').validate({
		ignore:true,
		errorPlacement : function(error, element) {
		
		},
		rules: {
			'khenthuong[hinhthuc_id]' : { required : true },
			'khenthuong[soquyetdinh]' : { required : true },
			'khenthuong[coquanquyetdinh]' : { required : true },
			'khenthuong[nguoiky]' : { required : true },
			'khenthuong[ngayquyetdinh]' : { required : true, dateVN : true },
		},
		messages: {
			'khenthuong[hinhthuc_id]' : { required : 'Chọn hình thức khen thưởng' },
			'khenthuong[soquyetdinh]' : { required : 'Nhập số quyết định' },
			'khenthuong[coquanquyetdinh]' : { required : 'Nhập cơ quan ra quyết định' },
			'khenthuong[nguoiky]' : { required : 'Nhập người ký quyết định' },
			'khenthuong[ngayquyetdinh]' : { required : 'Nhâp ngày ký quyết định', dateVN : 'Nhập đúng định dạng ngày ký quyết định' }
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