<?php
/**
 * Author: Phucnh
 * Date created: Sep 14, 2015
 * Company: DNICT
 */
?>
<form class="form-horizontal" class="row-fluid" name="frmQuaTrinh" id="frmQuaTrinh" method="post" action="<?php echo JRoute::_('index.php?option=com_thonto&controller=tochuc&task=savequatrinh')?>" enctype="multipart/form-data">
	<?php echo JHTML::_( 'form.token' ); ?> 
	<input type="hidden" name="dept_id" value="<?php echo $this->item->id; ?>">
	<input type="hidden" name="id" value="" id="quatrinh_id">
	<input type="hidden" name="vanban_id" value="" id="vanban_id">
	<h3 class="row-fluid header smaller lighter blue">
		<span class="span7">Thông tin quá trình</span>
		<span class="span5">
			<span class="pull-right inline">
				<button class="btn btn-mini btn-primary" type="submit" id="btnAddQuaTrinh"><i class="icon-save"></i> Lưu</button>												
			</span>																						
		</span>
	</h3>
	<div class="row-fluid">
		<div class="control-group">
			<label class="control-label" for="cachthuc_id">Nghiệp vụ <span class="required">*</span></label>
			<div class="controls">
            </div>							
		</div>
		<div class="control-group">
			<label class="control-label" for="chitiet">Tên tổ chức theo quyết định là</label>
			<div class="controls">			               
                <input type="text" id="name" name="name" value="<?php echo $this->item->name; ?>">
            </div>
		</div>
		<div class="control-group">
			<label class="control-label" for="quyetdinh_so">Số quyết định</label>
			<div class="controls">
				<div class="input-append">
               		<input type="text" id="quyetdinh_so" name="quyetdinh_so" value="" class="input-small">
               	</div>			               								   
            </div>							
		</div>
		</div>
		<div class="row-fluid">
		<div class="control-group span6">
			<label class="control-label" for="quyetdinh_ngay">Ngày quyết định</label>
			<div class="controls">
               <input type="text" id="quyetdinh_ngay" name="quyetdinh_ngay" class="input-small input-mask-date" value="">
            </div>							
		</div>

		<div class="control-group span6">
			<label class="control-label" for="hieuluc_ngay">Hiệu lực ngày</label>
			<div class="controls">
               <input type="text"  id="hieuluc_ngay" name="hieuluc_ngay" class="input-small input-mask-date validNgayHL" value="">
            </div>							
		</div>
	</div>
	<div class="row-fluid">
		<div class="control-group span12">
			<label class="control-label" for="chitiet">Nội dung chi tiết</label>
			<div class="controls">
               <textarea name="chitiet" id="chitiet" cols="60" rows="5"></textarea>               
            </div>							
		</div>					
		<div class="control-group">
			<label class="control-label" for="ghichu">Ghi chú</label>
			<div class="controls">			               
               <textarea name="ghichu" id="ghichu" cols="30" rows="5"></textarea>               
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
			  			$('#div_lichsu').hide();
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
	
});
</script>