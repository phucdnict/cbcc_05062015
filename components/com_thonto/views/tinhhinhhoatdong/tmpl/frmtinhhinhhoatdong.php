<?php
/**
 * Author: Phucnh
 * Date created: Aug 14, 2015
 * Company: DNICT
 */
$row = $this->row;
$kiennghi = $this->kiennghi;
$model = Core::model('Thonto/Tinhhinhhoatdong');
?>
<form class="form-horizontal" id="form_tinhhinhhoatdong">
<div class="row-fluid pull right">
	<div class="control-group">
		<div class="controls">
			<span class="pull-right inline">
				<button type='submit' class="btn btn-small btn-info"><i class="icon-save"></i> Lưu</button>
			</span>
		</div>
	</div>
</div>
<ul class="nav nav-tabs" id="tabs-tinhhinhhoatdong">
	<li class="active"><a data-toggle="tab" href="#tabthongtinchung">Tình hình hoạt động</a></li>
	<li><a data-toggle="tab" href="#tabkiennghi">Kiến nghị</a></li>
</ul>
<div class="tab-content">
	<div id="tabthongtinchung" class="tab-pane active">
		<div class="row-fluid">
			<div class="span5">
				<div class="control-group">
					<label class="control-label" for='thonto_id'>Đơn vị (<span style="color: red;">*</span>)</label>
					<div class="controls">
						<input type="text" name="tendonvi" id='tendonvi' disabled/>
						<input type="hidden" name="thonto_id" id='thonto_id' value="<?php echo $row->thonto_id; ?>" />
						<input type="hidden" name="dotbaocao_id" id='dotbaocao_id'/>
						<input type="hidden" name="id" id='id' value="<?php echo $row->id; ?>" />
					</div>
				</div>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span5">
				<div class="control-group">
					<label class="control-label">Số lần họp TDP, thôn định kỳ (<span style="color: red;">*</span>)</label>
					<div class="controls">
						<input type="text" name="dinhky_solan" id='dinhky_solan' value="<?php echo $row->dinhky_solan; ?>" /><small>(Đơn vị tính: Số lần)</small>
					</div>
				</div>
			</div>
			<div class="span5">
				<div class="control-group">
					<label class="control-label">Số lần họp TDP, thôn đột xuất (<span style="color: red;">*</span>)</label>
					<div class="controls">
						<input type="text" name="dotxuat_solan" id='dotxuat_solan' value="<?php echo $row->dotxuat_solan; ?>" /><small>(Đơn vị tính: Số lần)</small>
					</div>
				</div>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span5">
				<div class="control-group">
					<label class="control-label">Số lần họp có đầy đủ thành phần theo quy định (<span style="color: red;">*</span>)</label>
					<div class="controls">
						<input type="text" name="thanhphan_daydu" id='thanhphan_daydu' value="<?php echo $row->thanhphan_daydu; ?>" /><small>(Đơn vị tính: Số lần)</small>
					</div>
				</div>
			</div>
			<div class="span5">
				<div class="control-group">
					<label class="control-label">Số lần họp không đầy đủ thành phần theo quy định(<span style="color: red;">*</span>)</label>
					<div class="controls">
						<input type="text" name="thanhphan_khongdaydu" id='thanhphan_khongdaydu' value="<?php echo $row->thanhphan_khongdaydu; ?>" /><small>(Đơn vị tính: Số lần)</small>
					</div>
				</div>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span5">
				<div class="control-group">
					<label class="control-label">Số lượng đại diện hộ gia đình tham gia (<span style="color: red;">*</span>)</label>
					<div class="controls">
						<input type="text" name="sohothamgia" id='sohothamgia' value="<?php echo $row->sohothamgia; ?>" /><small>(Đơn vị tính: Số hộ)</small>
					</div>
				</div>
			</div>
			<div class="span5">
				<div class="control-group">
					<label class="control-label">Tỉ lệ (<span style="color: red;">*</span>)</label>
					<div class="controls">
						<input type="text" name="tyle" id='tyle' value="<?php echo $row->tyle; ?>" /><small>(Đơn vị tính: %)</small>
					</div>
				</div>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span5">
				<div class="control-group">
					<label class="control-label">Họp giao ban quân, dân chính (<span style="color: red;">*</span>)</label>
					<div class="controls">
						<input type="text" name="hopquandanchinh_solan" id='hopquandanchinh_solan' value="<?php echo $row->hopquandanchinh_solan; ?>" /><small>(Đơn vị tính: Số lần)</small>
					</div>
				</div>
			</div>
			<div class="span5">
				<div class="control-group">
					<label class="control-label">Số lượng tổ trưởng TDP, trưởng thôn nghỉ trên 30 ngày được UBND phường bố trí người thay thế (<span style="color: red;">*</span>)</label>
					<div class="controls">
						<input type="text" name="thaythetotruong_soluong" id='thaythetotruong_soluong' value="<?php echo $row->thaythetotruong_soluong; ?>" /><small>(Đơn vị tính: Số người)</small>
					</div>
				</div>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span5">
				<div class="control-group">
					<label class="control-label">Đánh giá thực hiện 04 nhiệm vụ trọng tâm (<span style="color: red;">*</span>)</label>
					<div class="controls">
							<select name='nhiemvutrongtam'>
								<option value='1' <?php if($row->nhiemvutrongtam==1) echo 'selected'; ?>>Đạt</option>
								<option value='2' <?php if($row->nhiemvutrongtam==2) echo 'selected'; ?>>Không đạt</option>
							</select>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="tabkiennghi" class="tab-pane">
		<legend>Số lượng kiến nghị
					<span class="pull-right inline">			
							<span  id="btn_add_kiennghi" class="btn btn-small btn-success">Thêm kiến nghị</span>
					</span>
		</legend>
		<div id=''>
			<!-- xcv -->
			<table class='table table-striped table-bordered' id='div_kiennghi'>
				<tr>
					<th rowspan='2' style="vertical-align: middle; text-align: center;">Kiến nghị</th>
					<th rowspan='2' style="vertical-align: middle; text-align: center;">Số lượng kiến nghị tại cuộc họp</th>
					<th colspan='3' style="vertical-align: middle; text-align: center;">Số lượng kiến nghị đã được giải quyết bởi</th>
					<th rowspan='2' style="vertical-align: middle; text-align: center;">Thao tác</th>
				</tr>
				<tr>
					<th style="vertical-align: middle; text-align: center;">Thôn, tổ dân phố</th>
					<th style="vertical-align: middle; text-align: center;">Phường xã</th>
					<th style="vertical-align: middle; text-align: center;">Quận huyện trở lên</th>
				</tr>
			<?php for($i=0; $i<count($kiennghi); $i++){?>
				<tr class='ye'>
					<td style="vertical-align: middle; text-align: center;">
					<?php echo ThontoHelper::selectBoxAndAttr($kiennghi[$i]->kiennghi_id,array('name'=>'kiennghi_id[]'),'thonto_danhmuckiennghi', array('id','ten'), '', 'ten asc');?>
					</td>
					<td style="vertical-align: middle; text-align: center;">
						<input type="text" name="soluongkiennghi[]" style="width:72px;text-align:right;" value="<?php echo $kiennghi[$i]->soluongkiennghi; ?>" />
					</td>
					<td style="vertical-align: middle; text-align: center;">
						<input type="text" name="dagiaiquyet_thonto[]" style="width:72px;text-align:right;" value="<?php echo $kiennghi[$i]->dagiaiquyet_thonto; ?>" />
					</td>
					<td style="vertical-align: middle; text-align: center;">
						<input type="text" name="dagiaiquyet_phuongxa[]" style="width:72px;text-align:right;" value="<?php echo $kiennghi[$i]->dagiaiquyet_phuongxa; ?>" />
					</td>
					<td style="vertical-align: middle; text-align: center;">
						<input type="text" name="dagiaiquyet_quanhuyentrolen[]" style="width:72px;text-align:right;" value="<?php echo $kiennghi[$i]->dagiaiquyet_quanhuyentrolen; ?>" />
					</td>
					<td style="vertical-align: middle; text-align: center;">
						<span class="btn btn-mini btn-danger btn_xoa_kiennghi">Xóa</span>
					</td>
				</tr>
			<?php }?>
			</table>
			<!-- xcv -->
		</div>
	</div>
	<input name="id" type="hidden" value="<?php echo $row->id; ?>" />
</form>
<script type="text/javascript">
jQuery(document).ready(function($){
	$('#form_tinhhinhhoatdong').validate({
		ignore: [],
		errorPlacement : function(error, element) {},
		  rules: {
		      "thonto_id": { required: true, },
		      "dinhky_solan": {	required: true, min:0},
		      "dotxuat_solan": {	required: true, min:0},
		      "thanhphan_daydu": {	required: true, min:0},
		      "thanhphan_khongdaydu": {	required: true, min:0},
		      "sohothamgia": {	required: true, min:0},
		      "tyle": {	required: true, min:0, max:100},
		      "hopquandanchinh_solan": {	required: true, min:0},
		      "thaythetotruong_soluong": {	required: true, min:0},
		      "nhiemvutrongtam": {	required: true},
		      "kiennghi_id[]": {	required: true, },
		      "soluongkiennghi[]": {	required: true, min:0},
		      "dagiaiquyet_thonto[]": {	required: true, min:0},
		      "dagiaiquyet_phuongxa[]": {	required: true, min:0},
		      "dagiaiquyet_quanhuyentrolen[]": {	required: true, min:0},
		},messages:{
			"thonto_id": { required : 'Chọn <b>Đơn vị</b>' ,},
			"dinhky_solan": { required : 'Nhập <b>Số lần họp TDP, thôn	 định kỳ</b>' , min:'<b>Số lần họp định kỳ</b> phải là số nguyên'},
			"dotxuat_solan": { required : 'Nhập <b>Số lần họp TDP, thôn đột xuất</b>' , min:'<b>Số lần hợp đột xuất</b> phải là số nguyên'},
			"thanhphan_daydu": { required : 'Nhập <b>Số lần có đầy đủ thành phần tham dự</b>' ,min:'<b>Số lần đầy đủ thành phần</b> phải là số nguyên'},
			"thanhphan_khongdaydu": { required : 'Nhập <b>Số lần không đầy đủ thành phần tham dự</b>' ,min:'<b>Số lần không đầy đủ thành phần</b> phải là số nguyên'},
			"sohothamgia": { required : 'Nhập <b>Số lượng đại diện hộ gia đình tham gia</b>' ,min:'<b>Số hộ đại diện</b> phải là số nguyên'},
			"tyle": { required : 'Nhập <b>Tỷ lệ</b>' ,min:'<b>Tỷ lệ</b> phải là số dương', max:'<b>Tỷ lệ</b> tối đa là 100',},
			"hopquandanchinh_solan": { required : 'Nhập <b>Họp giao ban quân, dân chính</b>' ,min:'<b>Số lần họp giao ban quân, dân chính</b> phải là số nguyên'},
			"thaythetotruong_soluong": { required : 'Nhập <b>Số lượng tổ trưởng TDP, trưởng thôn nghỉ trên 30 ngày được UBND phường bố trí người thay thế</b>' ,min:'<b>Số lượng tổ trưởng TDP, trưởng thôn</b> phải là số nguyên'},
			"nhiemvutrongtam": { required : 'Chọn <b>Nhiệm vụ trong năm</b>' ,},
			"kiennghi_id[]": { required : 'Chọn <b>Kiến nghị</b>' ,},
			"soluongkiennghi[]": { required : 'Nhập <b>Số lượng kiến nghị tại cuộc họp</b>' ,min:'<b>Số lượng kiến nghị</b> phải là số nguyên'},
			"dagiaiquyet_thonto[]": { required : 'Nhập <b>Số lượng kiến nghị được TDP, thôn giải quyết</b>' ,min:'<b>Số lần Thôn tổ giải quyết</b> phải là số nguyên'},
			"dagiaiquyet_phuongxa[]": { required : 'Nhập <b>Số lượng kiến nghị được UBND phường, xã giải quyết</b>' ,min:'<b>Số lần Phường xã giải quyết</b> phải là số nguyên'},
			"dagiaiquyet_quanhuyentrolen[]": { required : 'Nhập <b>Số lượng kiến nghị được UBND quận, huyện trở lên giải quyết</b>' ,min:'<b>Số lần Quận huyện giải quyết</b> phải là số nguyên'},
		},invalidHandler: function(form, validator) {
			var errors = validator.numberOfInvalids();
			if (errors) {
				var message = errors == 1 ? 'Kiểm tra lỗi sau:<br/>' : 'Phát hiện ' + errors + ' lỗi sau:<br/>';
				var errors = "";
				if (validator.errorList.length > 0) {
					for (x=0;x<validator.errorList.length;x++) {
						errors += "<br/>\u25CF " + validator.errorList[x].message;
					}
				}
				loadNoticeBoardError('Thông báo',message + errors);
			}
			validator.focusInvalid();
		},submitHandler: function(){
			var form_tinhhinhhoatdong=$('#form_tinhhinhhoatdong').serialize();
			$.blockUI();
			$.ajax({
				type: 'POST',
	  			url: '/index.php?option=com_thonto&controller=tinhhinhhoatdong&task=luutinhhinhhoatdong&format=raw',
	  			data: {form_tinhhinhhoatdong : form_tinhhinhhoatdong},
	  			success:function(data){
		  			if (data == true){
			  			$.unblockUI();
// 			  			window.location.href ='index.php?option=com_thonto&controller=tinhhinhhoatdong&task=default&dot='+dot;
			  			_initViewDetailPage(id);
			  			loadNoticeBoardSuccess('Thông báo', 'Xử lý thành công.');
			  		}
		  			else loadNoticeBoardError('Thông báo', 'Có lỗi xảy ra, vui lòng liên hệ quản trị viên!');
	  			}
	        });
		}
	});
	$('#btn_add_kiennghi').on('click', function(){
		var xhtml = '<tr class="ye">';
			xhtml+= '<td style="vertical-align: middle; text-align: center;">';
			xhtml+= '<?php echo ThontoHelper::selectBoxAndAttr('',array('name'=>'kiennghi_id[]'),'thonto_danhmuckiennghi', array('id','ten'), '', 'ten asc');?>';
			xhtml+= '</td>';
			xhtml+= '<td style="vertical-align: middle; text-align: center;">';
			xhtml+= '<input type="text" name="soluongkiennghi[]" style="width:72px;text-align:right;" value="" />';
			xhtml+= '</td>';
			xhtml+= '<td style="vertical-align: middle; text-align: center;">';
			xhtml+= '<input type="text" name="dagiaiquyet_thonto[]" style="width:72px;text-align:right;" value="" />';
			xhtml+= '</td>';
			xhtml+= '<td style="vertical-align: middle; text-align: center;">';
			xhtml+= '<input type="text" name="dagiaiquyet_phuongxa[]" style="width:72px;text-align:right;" value="" />';
			xhtml+= '</td>';
			xhtml+= '<td style="vertical-align: middle; text-align: center;">';
			xhtml+= '<input type="text" name="dagiaiquyet_quanhuyentrolen[]" style="width:72px;text-align:right;" value="" />';
			xhtml+= '</td>';
			xhtml+= '<td style="vertical-align: middle; text-align: center;">';
			xhtml+= '<span class="btn btn-mini btn-danger btn_xoa_kiennghi">Xóa</span>';
			xhtml+= '</td>';
			xhtml+= '</tr>';
		$('#div_kiennghi').append(xhtml);
	});
});
</script>