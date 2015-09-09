<?php
/**
 * Author: Phucnh
 * Date created: Aug 27, 2015
 * Company: DNICT
 */
$row = $this->row;
?>
<form class="form-horizontal" id="frm_soluongkhongchuyentrach">
<h3 class="row-fluid header smaller lighter green">
	<span class="span6">SỐ LƯỢNG NGƯỜI HOẠT ĐỘNG KHÔNG CHUYÊN TRÁCH PHƯỜNG, XÃ</span>
	<span class="span6">
		<span class="pull-right inline">
			<button type='submit' class="btn btn-mini btn-primary"><i class="icon-save"></i> Lưu</button>		
			<a class="btn btn-mini btn-info" id="btnBack_soluongkhongchuyentrach">← Quay về</a>		
		</span>										
	</span>	 
</h3>
<div class="row-fluid">
	<div class="span5">
		<div class="control-group">
			<label class="control-label" for='thonto_id'>Đơn vị (<span style="color: red;">*</span>)</label>
			<div class="controls">
				<input type="text" name="tendonvi" id='tendonvi' disabled/>
				<input type="hidden" name="thonto_id" id='thonto_id' value="<?php echo $row->thonto_id; ?>" />
				<input type="hidden" name="id" id='id' value="<?php echo $row->id; ?>" />
			</div>
		</div>
	</div>
</div>
<div class="row-fluid">
	<div class="span5">
		<div class="control-group">
			<label class="control-label">Tổ trưởng/ trưởng thôn(<span style="color: red;">*</span>)</label>
			<div class="controls">
				<input type="text" name="thonto_truong" id='thonto_truong' value="<?php echo $row->thonto_truong; ?>" /><small>(Đơn vị tính: Số lượng)</small>
			</div>
		</div>
	</div>
	<div class="span5">
		<div class="control-group">
			<label class="control-label">Phó thôn(đối với xã)(<span style="color: red;">*</span>)</label>
			<div class="controls">
				<input type="text" name="thonto_pho" id='thonto_pho' value="<?php echo $row->thonto_pho; ?>" /><small>(Đơn vị tính: Số lượng)</small>
			</div>
		</div>
	</div>
</div>
<div class="row-fluid">
	<div class="span5">
		<div class="control-group">
			<label class="control-label">Bí thư(<span style="color: red;">*</span>)</label>
			<div class="controls">
				<input type="text" name="chibo_bithu" id='chibo_bithu' value="<?php echo $row->chibo_bithu; ?>" /><small>(Đơn vị tính: Số lượng)</small>
			</div>
		</div>
	</div>
	<div class="span5">
		<div class="control-group">
			<label class="control-label">Phó bí thư (<span style="color: red;">*</span>)</label>
			<div class="controls">
				<input type="text" name="chibo_phobithu" id='chibo_phobithu' value="<?php echo $row->chibo_phobithu; ?>" /><small>(Đơn vị tính: Số lượng)</small>
			</div>
		</div>
	</div>
</div>
<div class="row-fluid">
	<div class="span5">
		<div class="control-group">
			<label class="control-label">Trưởng ban (<span style="color: red;">*</span>)</label>
			<div class="controls">
				<input type="text" name="bancongtac_truongban" id='bancongtac_truongban' value="<?php echo $row->bancongtac_truongban; ?>" /><small>(Đơn vị tính: Số lượng)</small>
			</div>
		</div>
	</div>
	<div class="span5">
		<div class="control-group">
			<label class="control-label">Phó ban (<span style="color: red;">*</span>)</label>
			<div class="controls">
				<input type="text" name="bancongtac_phoban" id='bancongtac_phoban' value="<?php echo $row->bancongtac_phoban; ?>" /><small>(Đơn vị tính: Số lượng)</small>
			</div>
		</div>
	</div>
</div>
<div class="row-fluid">
	<div class="span5">
		<div class="control-group">
			<label class="control-label">Chi hội Phụ nữ (<span style="color: red;">*</span>)</label>
			<div class="controls">
				<input type="text" name="chihoiphunu" id='chihoiphunu' value="<?php echo $row->chihoiphunu; ?>" /><small>(Đơn vị tính: Số lượng)</small>
			</div>
		</div>
	</div>
	<div class="span5">
		<div class="control-group">
			<label class="control-label">Chi hội Cựu chiến binh (<span style="color: red;">*</span>)</label>
			<div class="controls">
				<input type="text" name="chihoicuuchienbinh" id='chihoicuuchienbinh' value="<?php echo $row->chihoicuuchienbinh; ?>" /><small>(Đơn vị tính: Số lượng)</small>
			</div>
		</div>
	</div>
</div>
<div class="row-fluid">
	<div class="span5">
		<div class="control-group">
			<label class="control-label">Bí thư Chi đoàn TNCSHCM (<span style="color: red;">*</span>)</label>
			<div class="controls">
				<input type="text" name="bithudoantn" id='bithudoantn' value="<?php echo $row->bithudoantn; ?>" /><small>(Đơn vị tính: Số lượng)</small>
			</div>
		</div>
	</div>
	<div class="span5">
		<div class="control-group">
			<label class="control-label">Chi hội Nông dân (<span style="color: red;">*</span>)</label>
			<div class="controls">
				<input type="text" name="chihoinongdan" id='chihoinongdan' value="<?php echo $row->chihoinongdan; ?>" /><small>(Đơn vị tính: Số lượng)</small>
			</div>
		</div>
	</div>
</div>
<div class="row-fluid">
	<div class="span5">
		<div class="control-group">
			<label class="control-label">Tổ dân vận (<span style="color: red;">*</span>)</label>
			<div class="controls">
				<input type="text" name="todanvan" id='todanvan' value="<?php echo $row->todanvan; ?>" /><small>(Đơn vị tính: Số lượng)</small>
			</div>
		</div>
	</div>
	<div class="span5">
		<div class="control-group">
			<label class="control-label"> Bảo vệ Dân phố (<span style="color: red;">*</span>)</label>
			<div class="controls">
				<input type="text" name="baovedanpho" id='baovedanpho' value="<?php echo $row->baovedanpho; ?>" /><small>(Đơn vị tính: Số lượng)</small>
			</div>
		</div>
	</div>
</div>
<div class="row-fluid">
	<div class="span5">
		<div class="control-group">
			<label class="control-label">Công an viên (<span style="color: red;">*</span>)</label>
			<div class="controls">
				<input type="text" name="conganvien" id='conganvien' value="<?php echo $row->conganvien; ?>" /><small>(Đơn vị tính: Số lượng)</small>
			</div>
		</div>
	</div>
</div>
</form>
<script type="text/javascript">
jQuery(document).ready(function($){
	$('#frm_soluongkhongchuyentrach').validate({
		ignore: [],
		errorPlacement : function(error, element) {},
		  rules: {
		      "chibo_bithu": {	required: true, min:0},
		      "chibo_phobithu": {	required: true, min:0},
		      "bancongtac_truongban": {	required: true, min:0},
		      "bancongtac_phoban": {	required: true, min:0},
		      "chihoiphunu": {	required: true, min:0},
		      "chihoicuuchienbinh": {	required: true, min:0},
		      "bithudoantn": {	required: true, min:0},
		      "chihoinongdan": {	required: true, min:0},
		      "todanvan": {	required: true, min:0},
		      "baovedanpho": {	required: true, min:0},
		      "conganvien": {	required: true, min:0},
		      "thonto_truong": {	required: true, min:0},
		      "thonto_pho": {	required: true, min:0},
		},messages:{
			"chibo_bithu": { required : 'Nhập <b>Số lượng Bí thư</b>' , min:'<b>Số lượng bí thư</b> phải là số nguyên dương'},
			"chibo_phobithu": { required : 'Nhập <b>Số lượng Phó bí thư</b>' , min:'<b>Số lượng phó bí thư</b> phải là số nguyên dương'},
			"bancongtac_truongban": { required : 'Nhập <b>Số lượng Trưởng ban</b>' ,min:'<b>Số lượng trưởng ban</b> phải là số nguyên dương'},
			"bancongtac_phoban": { required : 'Nhập <b>Số lượng Phó ban</b>' ,min:'<b>Số lượng phó ban</b> phải là số nguyên dương'},
			"chihoiphunu": { required : 'Nhập <b>Số lượng Chi hội phụ nữ</b>' ,min:'<b>Số lượng Chi hội phụ nữ</b> phải là số nguyên dương'},
			"chihoicuuchienbinh": { required : 'Nhập <b>Số lượng Chi hội cựu chiến binh</b>' ,min:'<b>Số lượng Chi hội cựu chiến binh</b> phải là số nguyên dương'},
			"bithudoantn": { required : 'Nhập <b>Số lượng Bí thư đoàn Thanh niên</b>' ,min:'<b>Số lượng bí thư đoàn Thanh niên</b> phải là số nguyên dương'},
			"chihoinongdan": { required : 'Nhập <b>Số lượng Chi hội nông dân</b>' ,min:'<b>Số lượng Chi hội nông dân</b> phải là số nguyên dương'},
			"todanvan": { required : 'Nhập <b>Số lượng Tổ dân vận</b>' ,min:'<b>Số lượng Tổ dân vận</b> phải là số nguyên dương'},
			"baovedanpho": { required : 'Nhập <b>Số lượng Bảo vệ dân phố</b>' ,min:'<b>Số lượng Bảo vệ dân phố</b> phải là số nguyên dương'},
			"conganvien": { required : 'Nhập <b>Số lượng Công an viên</b>' ,min:'<b>Số lượng Công an viên</b> phải là số nguyên dương'},
			"thonto_truong": { required : 'Nhập <b>Số lượng Tổ trưởng/trưởng thôn</b>' ,min:'<b>Số lượng Tổ trưởng/trưởng thôn</b> phải là số nguyên dương'},
			"thonto_pho": { required : 'Nhập <b>Số lượng Phó thôn</b>' ,min:'<b>Số lượng Phó thôn</b> phải là số nguyên dương'},
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
			var frm_soluongkhongchuyentrach=$('#frm_soluongkhongchuyentrach').serialize();
// 			$.blockUI();
			$.ajax({
				type: 'POST',
	  			url: '/index.php?option=com_thonto&controller=tochuc&task=luusoluongkhongchuyentrach&format=raw',
	  			data: {frm_soluongkhongchuyentrach : frm_soluongkhongchuyentrach},
	  			success:function(data){
		  			if (data == true){
			  			$.unblockUI();
			  			loadNoticeBoardSuccess('Thông báo', 'Xử lý thành công.');
			  			$('#com_thonto_viewdetail').show();
			  			$('#div_soluongkhongchuyentrach').hide();
			  			_initViewDetailPage(id);
			  		}
		  			else {
		  				$.unblockUI();
			  			loadNoticeBoardError('Thông báo', 'Có lỗi xảy ra, vui lòng liên hệ quản trị viên!');
		  			}
	  			}
	        });
		}
	});
	$('#btnBack_soluongkhongchuyentrach').on('click', function(){
		$('#com_thonto_viewdetail').show();
		$('#div_soluongkhongchuyentrach').hide();
	});
});
</script>