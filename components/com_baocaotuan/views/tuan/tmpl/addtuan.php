<?php
/**
 * Author: Phucnh
 * Date created: May 26, 2015
 * Company: DNICT
 */
$user   = JFactory::getUser();
$r = ($this->row);
$row = $r[0];
?>
<form id="form_baocaotuan" method="POST" enctype="multipart/form-data">
		<fieldset>
			<legend>
			Báo cáo tuần
				<span class="pull-right inline">
					<span class="btn btn-small btn-danger" id="btn_cancel"><i class="icon-remove"></i> Hủy</span>
					<button type="submit" class="btn btn-small btn-success"><i class="icon-save"></i> Lưu</button>
				</span>
			</legend>	
			<div class="row-fluid">
				<div class="control-group span4">
					<label for="congviec" class="control-label">Tên công việc (<span style="color:red">*</span>)</label>
					<div class="controls">
						<textarea type="text" id="congviec" style="width:800px; height:80px" name="congviec" value="<?php if (isset($row->congviec)) echo $row->congviec;?>"><?php if (isset($row->congviec)) echo $row->congviec;?></textarea>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="control-group span4">
					<label for="maduan" class="control-label">Mã dự án (<span style="color:red">*</span>)</label>
					<div class="controls">
						<?php echo $this->maduan;?>
					</div>
				</div>
				<div class="control-group span4">
					<label for="trangthai" class="control-label">Độ phức tạp</label>
					<div class="controls">
						<input type="checkbox" class="checkbox"  data-on-color="success"  data-on-text="<i class='icon-ok'></i>" data-off-text='<i class="icon-remove"></i>' data-off-color='danger'  name="dophuctap" id="dophuctap" <?php if ($row->dophuctap == 1) echo "checked";?>>
					</div>
				</div>
				<div class="control-group span2">
					<label for="hoanthanh" class="control-label">Tỉ lệ hoàn thành (<span style="color:red">*</span>)</label>
					<div class="controls">
						<input type="text" name="hoanthanh" id="hoanthanh" style="width:30px" value="<?php  if (isset($row->hoanthanh)) echo $row->hoanthanh;?>">%
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="control-group span1">
					<label for="batdau" class="control-label">Thời gian bắt đầu</label>
					<div class="controls">
						<input type="text" contenteditable="false" name="batdau" id="batdau" class="mask"  style="width:80px"  value="<?php if (isset($row->batdau)) echo date('d/m/Y', strtotime($row->batdau));?>">
					</div>
				</div>
				<div class="control-group span1">
					<label for="ketthuc" class="control-label">Thời gian kết thúc</label>
					<div class="controls">
						<input type="text" contenteditable="false" name="ketthuc" id="ketthuc" class="mask" style="width:80px"  value="<?php if (isset($row->ketthuc)) echo date('d/m/Y', strtotime($row->ketthuc));?>">
					</div>
				</div>
				<div class="control-group span2">
				</div>
				<div class="control-group span4">
					<label class="control-label">Thứ trong tuần</label>
					<div class="controls">
					<table>
					<tr><td class="center">Hai</td><td class="center">Ba</td><td class="center">Tư</td><td class="center">Năm</td><td class="center">Sáu</td><td class="center">Bảy</td></tr>
					<tr>
						<td><input  type="checkbox" class="checkdate"  name="hai"  id="hai"  value="<?php if (isset($row->hai)) echo $row->hai;?>" <?php  if ($row->hai==1) echo "checked";?>></td>
						<td><input  type="checkbox" class="checkdate"  name="ba"  id="ba" value="<?php if (isset($row->ba)) echo $row->ba;?>" <?php  if ($row->ba==1) echo "checked";?>></td>
						<td><input  type="checkbox" class="checkdate"  name="tu" id="tu" value="<?php if (isset($row->tu)) echo $row->tu;?>" <?php  if ($row->tu==1) echo "checked";?>></td>
						<td><input  type="checkbox" class="checkdate"  name="nam" id="nam" value="<?php if (isset($row->nam)) echo $row->nam;?>" <?php  if ($row->nam==1) echo "checked";?>></td>
						<td><input  type="checkbox" class="checkdate"  name="sau" id="sau"  value="<?php if (isset($row->sau)) echo $row->sau;?>" <?php  if ($row->sau==1) echo "checked";?>></td>
						<td><input  type="checkbox" class="checkdate"  name="bay" id="bay"  value="<?php if (isset($row->bay)) echo $row->bay;?>" <?php  if ($row->bay==1) echo "checked";?>></td></tr>
					</table>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="control-group span4">
					<label for="trangthai" class="control-label">Trạng thái</label>
					<div class="controls">
						<input type="checkbox" class="checkbox"   data-on-color="success"  data-on-text="<i class='icon-ok'></i>" data-off-text='<i class="icon-remove"></i>' data-off-color='danger'  name="trangthai" id="trangthai" <?php if ($row->trangthai == 1) echo "checked";?>>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="control-group span4">
					<label for="ykiendexuat" class="control-label">Ý kiến/ Đề xuất</label>
					<div class="controls">
					<textarea type="text" id="ykiendexuat" style="width:800px; height:80px" name="ykiendexuat" value="<?php if (isset($row->ykiendexuat)) echo $row->ykiendexuat;?>"><?php if (isset($row->ykiendexuat)) echo $row->ykiendexuat;?></textarea>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="control-group span1">
					<div class="controls">
						<input type="hidden" name="id" id="id" value="<?php if (isset($row->id)) echo $row->id;?>">
						<input type="hidden" name="user_id" id="user_id" value="<?php if (isset($row->user_id)) echo $row->user_id; else echo $user->id?>">
						<input type="hidden" name="tenduan" id="tenduan" value="<?php if (isset($row->tenduan)) echo $row->tenduan;?>">
					</div>
				</div>
			</div>
		</fieldset>
</form>
<script>
jQuery(document).ready(function($){
		var startDate = new Date('01/01/2012');
		var FromEndDate = new Date();
		var ToEndDate = new Date();
		ToEndDate.setDate(ToEndDate.getDate()+365);
		$('#batdau').datepicker({
			format:'dd/mm/yyyy',
		    weekStart: 1,
		    startDate: startDate,
		    endDate: FromEndDate, 
		    autoclose: true
		})
		    .on('changeDate', function(selected){
		        startDate = new Date(selected.date.valueOf());
		        startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
		        $('#ketthuc').datepicker('setStartDate', startDate);
		    }); 
		$('#ketthuc')
		    .datepicker({
			    format:'dd/mm/yyyy',
		        weekStart: 1,
		        startDate: startDate,
		        endDate: ToEndDate,
		        autoclose: true
		    })
		    .on('changeDate', function(selected){
		        FromEndDate = new Date(selected.date.valueOf());
		        FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));
		        $('#batdau').datepicker('setEndDate', FromEndDate);
		    });
	$('#ketthuc,#batdau').on('change', function () {
		 var date1 = new Date(convertVNDateToMysql($("#batdau").val()));
		 var date2 = new Date(convertVNDateToMysql($("#ketthuc").val()));
		 var day = 1000*60*60*24;
		    var diff = (date2.getTime()- date1.getTime())/day;
		    var arr = [];
		    for(var i=0;i<=diff; i++)
		    {
		       var xx = date1.getTime()+day*i;
		       var yy = new Date(xx);
		       var thu = yy.getDay();
		      arr.push(thu);
		    }
		    if (arr.contains(1)) $('#hai').prop("checked", true); else $('#hai').prop("checked", false);  
		    if (arr.contains(2)) $('#ba').prop("checked", true); else $('#ba').prop("checked", false);  
		    if (arr.contains(3)) $('#tu').prop("checked", true); else $('#tu').prop("checked", false);  
		    if (arr.contains(4)) $('#nam').prop("checked", true); else $('#nam').prop("checked", false);  
		    if (arr.contains(5)) $('#sau').prop("checked", true); else $('#sau').prop("checked", false);  
		    if (arr.contains(6)) $('#bay').prop("checked", true); else $('#bay').prop("checked", false);  
	});
	$('body').delegate('#maduan', 'change', function(){
		$('#tenduan').val($('#maduan option:selected').text());
	});
	$('body').delegate('#btn_cancel', 'click', function(){
		$('#baocaotuan-manager-collapse-one').collapse('hide');
	  	$('#baocaotuan-manager-collapse-two').collapse('show');
	  	$('#baocaotuan-manager-collapse-three').collapse('hide');
	  	$('#div_form').html('');
	});
	$('.checkbox').bootstrapSwitch();
	$('.checkdate').labelauty({
		checked_label:'',
		unchecked_label:'',
		label: true,
	});
    $('.date').datepicker({
        format:  'dd/mm/yyyy', 
    }).next().on(ace.click_event, function(){
		$(this).prev().focus();
	});
	$('.mask').mask('99/99/9999');
	$('#form_baocaotuan').validate({
		ignore: [],
		errorPlacement : function(error, element) {},
		  rules: {
		      "congviec": {
		    	  required: true,
		      },
		      "maduan": {
		    	  required: true,
		      },
		      "tenduan": {
		    	  required: true,
		      },
		      "hoanthanh": {
		    	  required: true,
		    	  min: 0,
		    	  max: 100,
		      },
		},messages:{
			"congviec": { required : 'Nhập <b>Tên công việc</b>' ,
					},
			"maduan": { required : 'Chọn <b>Mã dự án</b>' ,
					},
			"tenduan": { required : 'Chọn <b>Mã dự án</b>' ,
					},
			"hoanthanh": { required : 'Nhập <b>Tỉ lệ hoàn thành</b>'  ,
				min: '<b>Tỉ lệ hoàn thành</b> tối thiểu là 0',
				max: '<b>Tỉ lệ hoàn thành</b> tối đa là 100',
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
			var form_baocaotuan=$('#form_baocaotuan').serialize();
			$.ajax({
				type: 'POST',
	  			url: '<?php echo JUri::base(true);?>/index.php?option=com_baocaotuan&controller=tuan&task=savequatrinh&format=raw',
	  			data: {form_baocaotuan : form_baocaotuan},
	  			success:function(data){
		  			if (data == true){
		  				$('#baocaotuan-manager-collapse-two').load('/index.php?option=com_baocaotuan&controller=tuan&task=quatrinh&format=raw', function(){
		  					loadNoticeBoardSuccess('Thông báo', 'Thao tác thành công!');
		  					$('#baocaotuan-manager-collapse-one').collapse('hide');
		  				  	$('#baocaotuan-manager-collapse-two').collapse('show');
	  			  	  	});
			  		}
		  			else loadNoticeBoardError('Thông báo', 'Có lỗi xảy ra, vui lòng liên hệ quản trị viên!');
	  			}
	        });
		}
	});
});
</script>