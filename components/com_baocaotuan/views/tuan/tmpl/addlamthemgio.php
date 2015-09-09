<?php
/**
 * Author: Phucnh
 * Date created: Jun 24, 2015
 * Company: DNICT
 */
$user   = JFactory::getUser();
$r = ($this->row);
$row = $r[0];
?>
<form id="form_lamthemgio" method="POST">
		<fieldset>
			<legend>
			Làm thêm giờ
				<span class="pull-right inline">
					<span class="btn btn-small btn-danger" id="btn_cancel_lamthemgio"><i class="icon-remove"></i> Hủy</span>
					<button type="submit" class="btn btn-small btn-success"><i class="icon-save"></i> Lưu</button>
				</span>
			</legend>	
			<div class="row-fluid">
				<div class="control-group">
					<label for="ngaylamthem" class="control-label">Ngày làm thêm(<span style="color:red">*</span>)</label>
					<div class="controls">
						<input type="text" name="ngaylamthem" id="ngaylamthem" class="dp"  value="<?php if (isset($row->ngaylamthem)) echo date('d/m/Y', strtotime($row->ngaylamthem));?>">
						<span id="span_choncongviec"></span>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="control-group span4">
					<label for="congvieclamthem" class="control-label">Tên công việc làm thêm(<span style="color:red">*</span>)</label>
					<div class="controls">
						<textarea type="text" id="congvieclamthem" style="width:800px; height:80px" name="congvieclamthem" value="<?php if (isset($row->congvieclamthem)) echo $row->congvieclamthem;?>"><?php if (isset($row->congvieclamthem)) echo $row->congvieclamthem;?></textarea>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="control-group span2">
					<label for="timebatdau" class="control-label">Thời gian bắt đầu(<span style="color:red">*</span>)</label>
					<div class="controls">
						<input type="text" name="timebatdau" id="timebatdau" class="time" style="width:80px"  value="<?php if (isset($row->timebatdau)) echo $row->timebatdau; else echo "17:30:00"?>">
					</div>
				</div>
				<div class="control-group span2">
					<label for="timeketthuc" class="control-label">Thời gian kết thúc(<span style="color:red">*</span>)</label>
					<div class="controls">
						<input type="text" name="timeketthuc" id="timeketthuc" class="time"  style="width:80px"  value="<?php if (isset($row->timeketthuc)) echo $row->timeketthuc;?>">
					</div>
				</div>
				<div class="control-group span4">
					<label for="thoigian" class="control-label">Tổng thời gian làm thêm giờ</label>
					<div class="controls">
						<input type="text" name="thoigian" id="thoigian"  readonly="readonly" value="<?php if (isset($row->thoigian)) echo $row->thoigian;?>">
						<input type="hidden" name="id" id="id" value="<?php if (isset($row->id)) echo $row->id;?>">
						<input type="hidden" name="user_id" id="user_id" value="<?php if (isset($row->user_id)) echo $row->user_id; else echo $user->id?>">
					</div>
				</div>
			</div>
		</fieldset>
		<?php echo JHTML::_( 'form.token' ); ?>
</form>
<script>
function convertTime(time){
	var arr = time.split(":");
	var hours = arr[0];
	var minutes = arr[1];
	var seconds = arr[2];
	return (hours*3600)+(minutes*60);   
}
function decimalAdjust(type, value, exp) {
    // If the exp is undefined or zero...
    if (typeof exp === 'undefined' || +exp === 0) {
      return Math[type](value);
    }
    value = +value;
    exp = +exp;
    // If the value is not a number or the exp is not an integer...
    if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0)) {
      return 0;
    }
    // Shift
    value = value.toString().split('e');
    value = Math[type](+(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp)));
    // Shift back
    value = value.toString().split('e');
    return +(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp));
  }

  // Decimal round
  if (!Math.round10) {
    Math.round10 = function(value, exp) {
      return decimalAdjust('round', value, exp);
    };
  }
  // Decimal floor
  if (!Math.floor10) {
    Math.floor10 = function(value, exp) {
      return decimalAdjust('floor', value, exp);
    };
  }
  // Decimal ceil
  if (!Math.ceil10) {
    Math.ceil10 = function(value, exp) {
      return decimalAdjust('ceil', value, exp);
    };
}
jQuery(document).ready(function($){
	$('.time').datetimepicker({
		format: 'H:i:00',
		step:15,
		formatTime: 'H:i',
		datepicker:false,
	});
	$('.dp').datepicker({
		format:'dd/mm/yyyy',
		 autoclose: true
		});
	$('#timeketthuc,#timebatdau').on('change', function () {
		 var time1 = convertTime($("#timebatdau").val());
		 var time2 = convertTime($("#timeketthuc").val());
		var t = Math.round10((time2-time1)/3600, -2);
		$("#thoigian").val(t);
	});
// 	$('body').delegate('#ngaylamthem', 'change', function(){
	$('#ngaylamthem').on('change', function () {
		var ngaylamthem = (convertVNDateToMysql($(this).val()));
		$.ajax({
			type: 'GET',
			url: '<?php echo JUri::base(true);?>/index.php?option=com_baocaotuan&controller=tuan&task=gettencongviec&format=raw&ngaylamthem='+ngaylamthem,
			success:function(data){
				$('#span_choncongviec').html(data);
			}
			});
	});
	$('body').delegate('#cbo_tencv', 'change', function(){
		if ($('#cbo_tencv').val() != "")
			$('#congvieclamthem').val($('#cbo_tencv option:selected').text());
		else 
			$('#congvieclamthem').val('');
	});
	$('#form_lamthemgio').validate({
		ignore: [],
		errorPlacement : function(error, element) {},
		  rules: {
		      "congvieclamthem": {
		    	  required: true,
		      },
		      "ngaylamthem": {
		    	  required: true,
		      },
		      "timebatdau": {
		    	  required: true,
		      },
		      "timeketthuc": {
		    	  required: true,
		      },
		},messages:{
			"congvieclamthem": { required : 'Nhập <b>Tên công việc làm thêm</b>' ,
					},
			"ngaylamthem": { required : 'Chọn <b>Ngày làm thêm</b>' ,
					},
			"timebatdau": { required : 'Chọn <b>Thời gian bắt đầu</b>' ,
					},
			"timeketthuc": { required : 'Nhập <b>Thời gian kết thúc</b>'  ,
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
			var form_lamthemgio=$('#form_lamthemgio').serialize();
			$.ajax({
				type: 'POST',
	  			url: '<?php echo JUri::base(true);?>/index.php?option=com_baocaotuan&controller=tuan&task=savelamthemgio&format=raw',
	  			data: {form_lamthemgio : form_lamthemgio},
	  			success:function(data){
		  			if (data == true){
		  				$('#baocaotuan-manager-collapse-three').load('/index.php?option=com_baocaotuan&controller=tuan&task=lamthemgio&format=raw', function(){
		  					loadNoticeBoardSuccess('Thông báo', 'Thao tác thành công!');
		  					$('#div_form').html('');
		  					$('#baocaotuan-manager-collapse-one').collapse('hide');
		  				  	$('#baocaotuan-manager-collapse-two').collapse('hide');
		  				  	$('#baocaotuan-manager-collapse-three').collapse('show');
	  			  	  	});
			  		}
		  			else if(data == false) loadNoticeBoardError('Thông báo', 'Có lỗi xảy ra, vui lòng liên hệ quản trị viên!');
		  			else if(data == 1) loadNoticeBoardError('Thông báo', 'Thời gian trong năm nay đã quá 200h, vui lòng chọn qua năm khác :v!');
		  			else if(data == 2) loadNoticeBoardError('Thông báo', 'Lỗ rồi, tổng thời gian trong tháng sẽ lớn hơn 200h, đổi đê!');
	  			}
	        });
		}
	});
	$('body').delegate('#btn_cancel_lamthemgio', 'click', function(){
		$('#baocaotuan-manager-collapse-one').collapse('hide');
	  	$('#baocaotuan-manager-collapse-two').collapse('hide');
	  	$('#baocaotuan-manager-collapse-three').collapse('show');
	  	$('#div_form').html('');
	});
});
</script>