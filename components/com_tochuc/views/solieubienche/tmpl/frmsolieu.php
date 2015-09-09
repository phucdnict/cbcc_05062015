<?php
/**
 * Author: Phucnh
 * Date created: May 26, 2015
 * Company: DNICT
 */
$row = $this->row;
?>
<form id="form_solieubienche" method="POST">
<div class="tab-content">
	<div id="info" class="tab-pane active">
		<fieldset>
			<legend>
				Số lượng
				<span class="pull-right inline">
					<button type="submit" class="btn btn-small btn-success"><i class="icon-save"></i> Lưu</button>
				</span>
			</legend>	
			<div class="row-fluid">
				<div class="control-group span4">
					<label for="bchanhchinh" class="control-label">Biên chế hành chính (<span style="color:red">*</span>)</label>
					<div class="controls">
						<input type="text" id="bchanhchinh" style="width:70px" name="bchanhchinh" value="<?php if (isset($row->bchanhchinh)) echo $row->bchanhchinh; else echo '0';?>">
					</div>
				</div>
				<div class="control-group span4">
					<label for="bcsunghiep_nhanuocgiao" class="control-label">Biên chế sự nghiệp nhà nước giao (<span style="color:red">*</span>)</label>
					<div class="controls">
						<input type="text" name="bcsunghiep_nhanuocgiao" style="width:70px" id="bcsunghiep_nhanuocgiao" value="<?php if (isset($row->bcsunghiep_nhanuocgiao)) echo $row->bcsunghiep_nhanuocgiao; else echo '0';?>">
					</div>
				</div>
				<div class="control-group span4">
					<label for="tuhopdong" class="control-label">Tự hợp đồng (<span style="color:red">*</span>)</label>
					<div class="controls">
						<input type="text" id="tuhopdong" style="width:70px" name="tuhopdong" value="<?php if (isset($row->tuhopdong)) echo $row->tuhopdong; else echo '0';?>">
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="control-group span4">
					<label for="bcsunghiep_tudambao" class="control-label">Biên chế sự nghiệp tự đảm bảo (<span style="color:red">*</span>)</label>
					<div class="controls">
						<input type="text" id="bcsunghiep_tudambao" style="width:70px" name="bcsunghiep_tudambao" value="<?php if (isset($row->bcsunghiep_tudambao)) echo $row->bcsunghiep_tudambao; else echo '0';?>">
					</div>
				</div>
				<div class="control-group span4">
					<label for="hopdong68" class="control-label">Hợp đồng 68 (<span style="color:red">*</span>)</label>
					<div class="controls">
						<input type="text" name="hopdong68" style="width:70px" id="hopdong68" value="<?php  if (isset($row->hopdong68)) echo $row->hopdong68; else echo '0';?>">
					</div>
				</div>
				<div class="control-group span4">
					<label for="banchuyentrach" class="control-label">Bán chuyên trách (<span style="color:red">*</span>)</label>
					<div class="controls">
						<input type="text" name="banchuyentrach" style="width:70px" id="banchuyentrach" value="<?php  if (isset($row->banchuyentrach)) echo $row->banchuyentrach; else echo '0';?>">
					</div>
				</div>
				<div class="control-group span4">
					<div class="controls">
						<input type="hidden" name="id_donvi" id="id_donvi" value="<?php if (isset($this->donvi_id)) echo $this->donvi_id;?>">
					</div>
				</div>
			</div>
		</fieldset>
	</div>
</div>
</form>
<script>
jQuery(document).ready(function($){
		$('#form_solieubienche').validate({
			ignore: [],
			errorPlacement : function(error, element) {},
			  rules: {
			      "bchanhchinh": {
			    	  required: true,
			    	  min: 0,
			      },
			      "bcsunghiep_nhanuocgiao": {
			    	  required: true,
			    	  min: 0,
			      },
			      "bcsunghiep_tudambao": {
			    	  required: true,
			    	  min: 0,
			      },
			      "hopdong68": {
			    	  required: true,
			    	  min: 0,
			      },
			      "tuhopdong": {
			    	  required: true,
			    	  min: 0,
			      },
			      "banchuyentrach": {
			    	  required: true,
			    	  min: 0,
			      },
			      "id_donvi": {
			    	  required: true,
			      },
		},messages:{
			"bchanhchinh": { required : 'Vui lòng nhập số lượng <b>Biên chế hành chính</b>' ,
				min: '<b>Biên chế hành chính</b> phải nhập kiểu số và lớn hơn hoặc bằng 0'},
			"bcsunghiep_nhanuocgiao": { required : 'Vui lòng nhập số lượng <b>Biên chế sự nghiệp nhà nước giao</b>'  ,
				min: '<b>Biên chế sự nghiệp nhà nước giao</b> phải nhập kiểu số và lớn hơn hoặc bằng 0'},
			"bcsunghiep_tudambao": { required : 'Vui lòng nhập số lượng <b>Biên chế sự nghiệp tự đảm bảo</b>'  ,
				min: '<b>Biên chế sự nghiệp tự đảm bảo</b> phải nhập kiểu số và lớn hơn hoặc bằng 0'},
			"hopdong68": { required : 'Vui lòng nhập số lượng <b>Biên chế hợp đồng 68</b>'  ,
				min: '<b>Biên chế hợp đồng 68</b> phải nhập kiểu số và lớn hơn hoặc bằng 0'},
			"tuhopdong": { required : 'Vui lòng nhập số lượng <b>Biên chế tự hợp đồng</b>'  ,
				min: '<b>Biên chế tự hợp đồng</b> phải nhập kiểu số và lớn hơn hoặc bằng 0'},
			"banchuyentrach": { required : 'Vui lòng nhập số lượng <b>Bán chuyên trách</b>'  ,
				min: '<b>Bán chuyên trách</b> phải nhập kiểu số và lớn hơn hoặc bằng 0'},
			"id_donvi": { required : 'Xảy ra lỗi bất thường, vui lòng liên hệ quản trị viên' },
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
			var form_solieubienche=$('#form_solieubienche').serialize();
			$.ajax({
				type: 'POST',
	  			url: '<?php echo JUri::base(true);?>/index.php?option=com_tochuc&controller=solieubienche&task=savebienche&format=raw',
	  			data: {form_solieubienche : form_solieubienche},
	  			success:function(data){
		  			if (data == true){
		  				loadNoticeBoardSuccess('Thông báo', 'Thao tác thành công!');
		  				$.blockUI();
		  				jQuery('#noidung').load('index.php?option=com_tochuc&view=solieubienche&format=raw&task=frmsolieu&donvi_id='+<?php echo $this->donvi_id;?>, function(){
			  				$.unblockUI();
		  				});
			  		}
		  			else loadNoticeBoardError('Thông báo', 'Có lỗi xảy ra, vui lòng liên hệ quản trị viên!');
	  			}
	        });
		}
	});
});
</script>