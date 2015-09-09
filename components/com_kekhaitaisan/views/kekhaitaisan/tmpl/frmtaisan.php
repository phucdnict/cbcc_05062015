<?php
/**
 * Author: Phucnh
 * Date created: Jul 20, 2015
 * Company: DNICT
 */
$taisan_id_cbo = $this->taisan_id;
$row= $this->row;
?>
<style>
.chosen-container
{
    width: 100% !important;
}
</style>
<form class="form-horizontal" id="form_taisan">
<div style="clear:both"></div>
<div class="modal-header">
		<button data-dismiss="modal" class="close" type="button">×</button>
		<h4 id="title_quatrinh" class="blue bigger">Thêm mới tài sản</h4>
</div>
<div class="modal-body overflow-visible">
		<div class="span8">
			<div class="control-group">
				<label class="control-label">Kiểu loại tài sản (<span style="color:red;">*</span>)</label>
				<div class="controls">
					<input  name="id" type="hidden"  value="<?php echo $row->id; ?>"/>
					<?php echo $taisan_id_cbo;?>
				</div>
			</div>
		</div>
		<div class="span8" id="frmts"></div> 
</div>
<div style="clear:both"></div>
<div id="button_quatrinh" class="modal-footer">
	<button data-dismiss="modal" class="btn btn-small">Hủy bỏ</button>
	<button class="btn btn-small btn-primary btn_save_banthan" index="-1">Lưu</button>
</div>
</form>
<script type="text/javascript">
jQuery(document).ready(function($){
	chosen();
	$('#form_taisan').validate({
		ignore: [],
		errorPlacement : function(error, element) {},
		  rules: {
		      "loaitaisan_id": {
		    	  required: true,
		      },
		      "taisan_id": {
		    	  required: true,
		      },
		      "value": {
		    	  required: true,
		      },
		      "giatri": {
		    	  required: true, min: 0,
		      },
		      "loainha_id": {
		    	  required: true,
		      },
		      "capcongtrinh_id": {
		    	  required: true,
		      },
		      "diachi": {
		    	  required: true,
		      },
		      "dientichxaydung": {
		    	  required: true,
		      },
		      "giaychungnhan": {
		    	  required: true,
		      },
		      "dientich": {
		    	  required: true,
		      },
		},messages:{
			"loaitaisan_id": { required : 'Chọn <b>Kiểu loại tài sản</b>' ,
					},
			"taisan_id": { required : 'Chọn <b>Loại tài sản</b>' ,
					},
			"value": { required : 'Nhập <b>Tên tài sản</b>' ,
					},
			"giatri": { required : 'Nhập <b>Giá trị tài sản</b>' ,	min: '<b>Giá trị</b>Vui lòng nhập số hợp lệ ',
					},
			"loainha_id": { required : 'Chọn <b>Loại nhà ở, công trình</b>' ,
					},
			"capcongtrinh_id": { required : 'Chọn <b>Cấp công trình</b>' ,
					},
			"diachi": { required : 'Nhập <b>Địa chỉ</b>' ,
					},
			"dientichxaydung": { required : 'Nhập <b>Diện tích xây dựng</b>' ,
					},
			"giaychungnhan": { required : 'Nhập <b>Giấy chứng nhận</b>' ,
					},
			"dientich": { required : 'Nhập <b>Diện tích xây dựng</b>' ,
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
			var form_taisan=$('#form_taisan').serialize();
			$.blockUI();
			$.ajax({
				type: 'POST',
	  			url: '/index.php?option=com_kekhaitaisan&controller=kekhaitaisan&task=luutaisan&format=raw',
	  			data: {form_taisan : form_taisan, kekhai_id : kekhai_id},
	  			success:function(data){
		  			if (data == true){
			  			$.unblockUI();
		  				$(".modal").modal('hide');
		  				$('#div_taisan').load('/index.php?option=com_kekhaitaisan&controller=kekhaitaisan&task=taisan&format=raw&kekhai_id='+kekhai_id, function(){
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