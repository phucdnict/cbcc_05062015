<?php
/**
 * Author: Phucnh
 * Date created: Aug 14, 2015
 * Company: DNICT
 */
?>
<form class="form-horizontal" id="form_chibo">
	<div style="clear: both"></div>
	<div class="modal-header">
		<button data-dismiss="modal" class="close" type="button">×</button>
		<h4 id="title_quatrinh" class="blue bigger"><?php if ((int)$this->row->id>0) echo 'Hiệu chỉnh'; else echo 'Thêm mới';?> chi bộ</h4>
	</div>
	<div class="modal-body overflow-visible">
		<div class="row-fluid">
			<div class="span6">
				<div class="control-group">
					<label class="control-label">Tên chi bộ (<span style="color: red;">*</span>)</label>
					<div class="controls">
						<input type="text" name="ten" value="<?php echo $this->row->ten; ?>" />
					</div>
				</div>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span6">
				<div class="control-group">
					<label class="control-label">Số lượng thành viên </label>
					<div class="controls">
						<input type="text" name="soluongthanhvien" value="<?php echo $this->row->soluongthanhvien ; ?>" />
					</div>
				</div>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span6">
				<div class="control-group">
					<label class="control-label">Năm thành lập </label>
					<div class="controls">
						<input type="text" name="namthanhlap" value="<?php echo $this->row->namthanhlap ; ?>" />
					</div>
				</div>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span6">
				<div class="control-group">
					<label class="control-label">Ghi chú </label>
					<div class="controls">
						<textarea rows="5" cols="30" id="ghichu" name="ghichu"><?php echo $this->row->ghichu;?></textarea>
					</div>
				</div>
			</div>
		</div>
	</div>
	<input name="id" type="hidden" value="<?php echo $this->row->id; ?>" />
	<input name="donvi_id" type="hidden" value="<?php echo $this->px_id; ?>" />
	<div style="clear: both"></div>
	<div class="modal-footer">
		<button data-dismiss="modal" class="btn btn-small ">Hủy bỏ</button>
		<button class="btn btn-small btn-primary btn_save_chibo" index="-1">Lưu</button>
	</div>
</form>
<script type="text/javascript">
var kekhai_id;
jQuery(document).ready(function($){
	var _initViewDetailPage = function(id){
		jQuery.ajax({
			  type: "GET",
			  url: 'index.php?option=com_thonto&controller=chibo&task=detail&format=raw',
			  data:{"id":id},
			  beforeSend: function(){
				  $.blockUI();
				  $('#com_thonto_viewdetail').empty();				  
				},
			  success: function (data,textStatus,jqXHR){
				  $.unblockUI();
				  $('#com_thonto_viewdetail').html(data);
				  
			  }
		});	
	};
	$('#form_chibo').validate({
		ignore: [],
		errorPlacement : function(error, element) {},
		  rules: {
		      "ten": {
		    	  required: true,
		      },
		},messages:{
			"ten": { required : 'Nhập <b>Tên chi bộ</b>' ,
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
			var form_chibo=$('#form_chibo').serialize();
			$.blockUI();
			$.ajax({
				type: 'POST',
	  			url: '/index.php?option=com_thonto&controller=chibo&task=luuchibo&format=raw',
	  			data: {form_chibo : form_chibo},
	  			success:function(data){
		  			if (data == true){
			  			$.unblockUI();
		  				$(".modal").modal('hide');
		  				 _initViewDetailPage(id);
			  		}
		  			else loadNoticeBoardError('Thông báo', 'Có lỗi xảy ra, vui lòng liên hệ quản trị viên!');
	  			}
	        });
		}
	});
});
</script>