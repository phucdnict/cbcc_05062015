<?php
defined ( '_JEXEC' ) or die ( 'Restricted access' );
$item = $this->item;
$donvi = Core::loadAssoc('thonto_tochuc', array('*'), 'id = "'.$item['tochuc_id'].'"');
?>
<div style="clear: both;"></div>
<form id="CongtacFrm" name="CongtacFrm" method="post" class="form-horizontal" enctype="multipart/form-data" action="index.php?option=com_thonto&controller=thonto&task=saveCongtac">
<div style="float:left;width:400px;">
	<div class="control-group">
		<label class="control-label" for="congtac_phuongxa_id">Phường xã (<span style="color:red;">*</span>)</label>
		<div class="controls">
			<input type="hidden" id="congtac_phuongxa" name="congtac[phuongxa]" value="<?php echo $item['phuongxa']; ?>" />
			<?php echo ThontoHelper::selectBoxAndAttr($item['phuongxa_id'],
					array('id'=>'congtac_phuongxa_id','name'=>'congtac[phuongxa_id]'),
					'thonto_tochuc',array('id','ten','kieu'),array('trangthai_id = 1 AND kieu = 3')); ?>
		</div>
	</div>
</div>
<div style="float:left;width:400px;">
	<div class="control-group">
		<label class="control-label" for="congtac_thonto_id">Thôn, tổ dân phố (<span style="color:red;">*</span>)</label>
		<div class="controls">
			<input type="hidden" id="congtac_thonto" name="congtac[thonto]" value="<?php echo $item['thonto']; ?>" />
			<?php echo ThontoHelper::selectBoxAndAttr($item['thonto_id'],
					array('id'=>'congtac_thonto_id','name'=>'congtac[thonto_id]'),
					'thonto_tochuc',array('id','ten','kieu'),array('trangthai_id = 1 AND kieu IN (4,5) AND parent_id = "'.$item['phuongxa_id'].'"')); ?>
		</div>
	</div>
</div>
<div style="float:left;width:400px;">
	<div class="control-group">
		<label class="control-label" for="congtac_chucvu_id">Chức vụ (<span style="color:red;">*</span>)</label>
		<div class="controls">
			<input type="hidden" id="congtac_chucvu" name="congtac[chucvu]" value="<?php echo $item['chucvu']; ?>" />
			<?php echo ThontoHelper::selectBoxAndAttr($item['chucvu_id'],array('id'=>'congtac_chucvu_id','name'=>'congtac[chucvu_id]'),
					'thonto_chucvu',array('id','ten'),array('trangthai = 1 AND loaihinhtochuc_id IN (4,5)')); ?>
		</div>
	</div>
</div>
<div style="float:left;width:400px;">
	<div class="control-group">
		<label class="control-label" for="congtac_ngaybatdau">Ngày bắt đầu (<span style="color:red;">*</span>)</label>
		<div class="controls">
			<div class="row-fluid input-append">
				<input type="text" id="congtac_ngaybatdau" name="congtac[ngaybatdau]" class="input-small date-picker input-mask-date"
				data-date-format="dd/mm/yyyy" value="<?php echo $item['ngaybatdau']; ?>" />
				<span class="add-on">
					<i class="icon-calendar"></i>
				</span>
			</div>
		</div>
	</div>
</div>
<div style="float:left;width:400px;">
	<div class="control-group">
		<label class="control-label" for="congtac_ngayketthuc">Ngày kết thúc (<span style="color:red;">*</span>)</label>
		<div class="controls">
			<div class="row-fluid input-append">
				<input type="text" id="congtac_ngayketthuc" name="congtac[ngayketthuc]" class="input-small date-picker input-mask-date validNgayCT"
				data-date-format="dd/mm/yyyy" value="<?php echo $item['ngayketthuc']; ?>" />
				<span class="add-on">
					<i class="icon-calendar"></i>
				</span>
			</div>
		</div>
	</div>
</div>
<input type="hidden" id="congtac_id_quatrinh" name="congtac[id_quatrinh]" value="<?php echo $item['id']; ?>" />
<input type="hidden" id="congtac_hosocanbo_id" name="congtac[hosocanbo_id]" value="<?php echo JRequest::getInt('idHoso',null); ?>" />
</form>
<div style="clear: both;"></div>
<script type="text/javascript">
var loadfirst = 1;
jQuery(document).ready(function($){
	$('.date-picker').datepicker({
        startDate: "01/01/1900",
        endDate: "01/01/3000"
    }).next().on(ace.click_event, function(){
		$(this).prev().focus();
	});
	$('.input-mask-date').mask('39/19/2999');
	$('#congtac_phuongxa_id').on('change', function(){
		$('#congtac_phuongxa').val($(this).find('option:selected').text());
		var phuongxa_id = $(this).val();
		$.post('index.php',{option:'com_thonto',controller:'thonto',task:'getThonto',donvi_id:phuongxa_id}, function(data){
			var str = '<option value="" data-kieu=""></option>';
			$.each(data,function(i,v){
				str+= '<option value="' + v.id + '" data-kieu="' + v.kieu + '">' + v.ten + '</option>';
			});
			$('#congtac_thonto_id').html(str);
			$('#congtac_thonto_id').change();
		});
	});
	$('#congtac_thonto_id').on('change', function(){
		$('#congtac_thonto').val($(this).find('option:selected').text());
		var loaihinhtochuc_id = $(this).find('option:selected').data('kieu');
		$.post('index.php',{option:'com_thonto',controller:'thonto',task:'getChucvu',loaihinhtochuc_id:loaihinhtochuc_id}, function(data){
			var str = '<option value=""></option>';
			$.each(data,function(i,v){
				str+= '<option value="' + v.id + '">' + v.ten + '</option>';
			});
			$('#congtac_chucvu_id').html(str);
			if(loadfirst == 1){
				$('#congtac_chucvu_id').val('<?php echo $item['chucvu_id']; ?>');
				$('#congtac_chucvu').val('<?php echo $item['chucvu']; ?>');
				loadfirst = 0;
			}else{
				$('#congtac_chucvu_id').change();
			}
		});
	});
	$('#congtac_thonto_id').change();
	$('#congtac_chucvu_id').on('change', function(){
		$('#congtac_chucvu').val($(this).find('option:selected').text());
	});
	$('#CongtacFrm').validate({
		ignore:true,
		errorPlacement : function(error, element) {
		
		},
		rules: {
			'congtac[thonto_id]' : { required : true },
			'congtac[chucvu_id]' : { required : true },
			'congtac[ngaybatdau]' : { required : true }
		},
		messages: {
			'congtac[thonto_id]' : { required : 'Chọn thôn, tổ dân phố.' },
			'congtac[chucvu_id]' : { required : 'Chọn chức vụ.' },
			'congtac[ngaybatdau]' : { required : 'Nhập ngày bắt đầu.' }
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
	$.validator.addMethod("validNgayCT", function(value, element) {
		var tungay = $('#congtac_ngaybatdau');
		var denngay = $('#congtac_ngayketthuc');
		if(tungay.val() != '' && denngay.val() != ''){
			if(compareDate(tungay.val(),denngay.val()) == -1){
				tungay.addClass('valid').removeClass('error');
				denngay.addClass('valid').removeClass('error');
				return true;
			}else{
				tungay.addClass('error').removeClass('valid');
				denngay.addClass('error').removeClass('valid');
				return false;
			}
		}else{
			tungay.addClass('valid').removeClass('error');
			denngay.addClass('valid').removeClass('error');
			return true;
		}
	}, "Ngày kết thúc phải lớn hơn ngày bắt đầu");
});
</script>