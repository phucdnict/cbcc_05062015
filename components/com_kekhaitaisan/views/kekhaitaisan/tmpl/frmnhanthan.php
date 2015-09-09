<?php
/**
 * Author: Phucnh
 * Date created: Jul 14, 2015
 * Company: DNICT
 */ 
$model			=	Core::model('Kekhaitaisan/Kekhaitaisan');
$tmp		=	$this->nhanthan;
?>
<style>
.chosen-container
{
    width: 100% !important;
}
</style>
<form class="form-horizontal" id="form_nhanthan">
<div style="clear:both"></div>
<div class="modal-header">
		<button data-dismiss="modal" class="close" type="button">×</button>
		<h4 id="title_quatrinh" class="blue bigger">Thêm mới quan hệ gia đình</h4>
</div>
<div class="modal-body overflow-visible">
		<div class="span4">
			<div class="control-group">
				<label class="control-label">Họ tên (<span style="color:red;">*</span>)</label>
				<div class="controls">
					<input type="text" name="hoten" value="<?php echo $tmp[0]->hoten; ?>"/>
				</div>
			</div>
		</div>
		<div class="span4">
			<div class="control-group">
				<label class="control-label">Năm sinh (<span style="color:red;">*</span>)</label>
				<div class="controls">
					<input type="text" name="namsinh" max-length="4" class="input-small" value="<?php if (isset($tmp[0]->namsinh)) echo $tmp[0]->namsinh ; ?>"/>
				</div>
			</div>
		</div>
		<div class="span4">
			<div class="control-group">
				<label class="control-label">Quan hệ</label>
				<div class="controls">
					<?php  echo $this->relative_code_id; ?>
				</div>
			</div>
		</div>
		<div class="span4">
			<div class="control-group">
				<label class="control-label">Chức vụ </label>
				<div class="controls">
					<input type="text" name="chucvu" value="<?php echo $tmp[0]->chucvu; ?>"/>
				</div>
			</div>
		</div>
		<div class="span8">
			<div class="control-group">
				<label class="control-label">Đơn vị công tác </label>
				<div class="controls">
					<input type="text" name="coquan" style="width:606px" value="<?php echo $tmp[0]->coquan; ?>"/>
				</div>
			</div>
		</div>
		<div class="span8">
			<div class="control-group">
				<label class="control-label">Hộ khẩu thường trú </label>
				<div class="controls">
				<?php $hokhau_tinhthanh = $tmp[0]->hokhau_tinhthanh == null ? '0':$tmp[0]->hokhau_tinhthanh;
				$hokhau_quanhuyen = $tmp[0]->hokhau_quanhuyen == null ? '0':$tmp[0]->hokhau_quanhuyen;
				$hokhau_phuongxa= $tmp[0]->hokhau_phuongxa == null ? '0':$tmp[0]->hokhau_phuongxa;
				?>
					<div style="float: left;"><?php echo $model->getCbo('city_code', 'code, name', ' status =1', 'name asc' ,'', '--Chọn tỉnh thành--', 'code', 'name' ,$hokhau_tinhthanh ,'hokhau_tinhthanh','chosen', '');?></div>
					<div style="float: left;" id="div_hokhau_quanhuyen"><?php echo $model->getCbo('dist_code', 'code, name','status=1 and cadc_code = '.$hokhau_tinhthanh, 'name asc', '','--Chọn quận huyện--','code', 'name', $hokhau_quanhuyen, 'hokhau_quanhuyen','chosen','');?></div>
					<div style="float: left;" id="div_hokhau_phuongxa"><?php echo $model->getCbo('comm_code', 'code, name','status=1 and dc_code = '.$hokhau_quanhuyen, 'name asc', '','--Chọn phường xã--','code', 'name', $hokhau_phuongxa, 'hokhau_phuongxa','chosen','');?></div>
				</div>
			</div>
		</div>
		<div class="span8">
			<div class="control-group">
				<label class="control-label">Chỗ ở hiện tại </label>
				<div class="controls">
					<input style="width:606px" name="choohientai" type="text"  value="<?php echo $tmp[0]->choohientai; ?>"/>
				</div>
			</div>
		</div>
</div>
<input  name="id" type="hidden"  value="<?php echo $tmp[0]->id; ?>"/>
<div style="clear:both"></div>
<div id="button_quatrinh" class="modal-footer">
	<button data-dismiss="modal" class="btn btn-small ">Hủy bỏ</button>
	<button class="btn btn-small btn-primary btn_save_banthan" index="-1">Lưu</button>
</div>
</form>
<script type="text/javascript">
var kekhai_id;
jQuery(document).ready(function($){
	chosen();
	$('#form_nhanthan').validate({
		ignore: [],
		errorPlacement : function(error, element) {},
		  rules: {
		      "hoten": {
		    	  required: true,
		      },
		      "namsinh": {
		    	  required: true,
		      },
		},messages:{
			"hoten": { required : 'Nhập <b>Họ và tên</b>' ,
					},
			"namsinh": { required : 'Nhập <b>Năm sinh</b>' ,
					},
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
			var form_nhanthan=$('#form_nhanthan').serialize();
			$.blockUI();
			$.ajax({
				type: 'POST',
	  			url: '/index.php?option=com_kekhaitaisan&controller=kekhaitaisan&task=luunhanthan&format=raw',
	  			data: {form_nhanthan : form_nhanthan, kekhai_id : kekhai_id, idHoso : idHoso},
	  			success:function(data){
		  			if (data == true){
			  			$.unblockUI();
		  				$(".modal").modal('hide');
		  				$('#div_nhanthan').load('/index.php?option=com_kekhaitaisan&controller=kekhaitaisan&task=nhanthan&format=raw', function(){
		  					loadNoticeBoardSuccess('Thông báo', 'Thao tác thành công!');
	  			  	  	});
			  		}
		  			else loadNoticeBoardError('Thông báo', 'Có lỗi xảy ra, vui lòng liên hệ quản trị viên!');
	  			}
	        });
		}
	});
});
</script>