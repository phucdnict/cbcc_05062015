<?php
/**
 * Author: Phucnh
 * Date created: Aug 14, 2015
 * Company: DNICT
 */
$row = $this->row;
$noidunghop = $this->noidunghop;
?>
<form class="form-horizontal" id="form_tinhhinhquanly">
<div class="row-fluid pull right">
	<div class="control-group">
		<div class="controls">
			<span class="pull-right inline">
				<button type='submit' class="btn btn-small btn-info"><i class="icon-save"></i> Lưu</button>
			</span>
		</div>
	</div>
</div>
<ul class="nav nav-tabs" id="tabs-tinhhinhquanly">
	<li class="active"><a data-toggle="tab" href="#tabthongtinchung">Tình hình quản lý</a></li>
	<li><a data-toggle="tab" href="#tabnoidunghop">Nội dung họp</a></li>
</ul>
<div class="tab-content">
	<div id="tabthongtinchung" class="tab-pane active">
		<div class="row-fluid">
			<div class="span5">
				<div class="control-group">
					<label class="control-label" for='thonto_id'>Đơn vị (<span style="color: red;">*</span>)</label>
					<div class="controls">
						<input type="text" name="tendonvi" id='tendonvi' disabled/>
					</div>
				</div>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span5">
				<div class="control-group">
					<label class="control-label">Lập sổ theo dõi hoạt động của tổ dân phố, thôn (<span style="color: red;">*</span>)</label>
					<div class="controls">
						<select name="lapsotheodoihoatdong" class='input-small'>
							<option value='1' <?php if($row->lapsotheodoihoatdong==1) echo 'selected';?>>Có</option>
							<option value='0' <?php if($row->lapsotheodoihoatdong==0) echo 'selected';?>>Không</option>
						</select>
					</div>
				</div>
			</div>
			<div class="span5">
				<div class="control-group">
					<label class="control-label">Mời Bí thư đảng ủy, Chủ tịch UBMTTQVN phường, xã và Bí thư Chi bộ, Trưởng ban Công tác mặt trận (<span style="color: red;">*</span>)</label>
					<div class="controls">
						<select name="thanhphan_soluong1" class='input-small'>
							<option value='1' <?php if($row->thanhphan_soluong1==1) echo 'selected';?>>Có</option>
							<option value='0' <?php if($row->thanhphan_soluong1==0) echo 'selected';?>>Không</option>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span5">
				<div class="control-group">
					<label class="control-label">Mời Bí thư đảng ủy, Chủ tịch UBMTTQVN phường, xã (<span style="color: red;">*</span>)</label>
					<div class="controls">
						<select name="thanhphan_soluong2" class='input-small'>
							<option value='1' <?php if($row->thanhphan_soluong2==1) echo 'selected';?>>Có</option>
							<option value='0' <?php if($row->thanhphan_soluong2==0) echo 'selected';?>>Không</option>
						</select>
					</div>
				</div>
			</div>
			<div class="span5">
				<div class="control-group">
					<label class="control-label">Mời Bí thư Chi bộ, Trưởng ban Công tác mặt trận(<span style="color: red;">*</span>)</label>
					<div class="controls">
						<select name="thanhphan_soluong3" class='input-small'>
							<option value='1' <?php if($row->thanhphan_soluong3==1) echo 'selected';?>>Có</option>
							<option value='0' <?php if($row->thanhphan_soluong3==0) echo 'selected';?>>Không</option>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span5">
				<div class="control-group">
					<label class="control-label">Số lượng vắng(<span style="color: red;">*</span>)</label>
					<div class="controls">
						<input type="text" name="soluongvang" value="<?php echo $row->soluongvang?>">
					</div>
				</div>
			</div>
			<div class="span5">
				<div class="control-group">
					<label class="control-label">Số lượng kiến nghị tại cuộc họp(<span style="color: red;">*</span>)</label>
					<div class="controls">
						<input type="text" name="kiennghi_soluong" value="<?php echo $row->kiennghi_soluong?>">
					</div>
				</div>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span5">
				<div class="control-group">
					<label class="control-label">Số lượng kiến nghị đã giải quyết tại cuộc họp  (<span style="color: red;">*</span>)</label>
					<div class="controls">
						<input type="text" name="kiennghi_dagiaiquyet" value="<?php echo $row->kiennghi_dagiaiquyet?>">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="tabnoidunghop" class="tab-pane">
		<legend>Nội dung họp
					<span class="pull-right inline">			
							<span  id="btn_add_noidunghop" class="btn btn-small btn-success">Thêm nội dung họp</span>
					</span>
		</legend>
		<div>
			<!-- xcv -->
			<table class='table table-striped table-bordered' id='div_noidunghop'>
				<tr>
					<th style="vertical-align: middle; text-align: center;">Nội dung họp</th>
					<th style="vertical-align: middle; text-align: center;">Có thực hiện hay không</th>
					<th style="vertical-align: middle; text-align: center;">Thao tác</th>
				</tr>
			<?php for($i=0; $i<count($noidunghop); $i++){?>
				<tr class='ye'>
					<td style="vertical-align: middle; text-align: center;">
					<?php echo ThontoHelper::selectBoxAndAttr($noidunghop[$i]->noidunghop_id,array('name'=>'noidunghop_id[]'),'thonto_danhmucnoidunghop', array('id','ten'), '', 'ten asc');?>
					</td>
					<td style="vertical-align: middle; text-align: center;">
						<select name="co_thuchien[]" class='input-small'>
							<option value='1' <?php if($noidunghop[$i]->co_thuchien==1) echo 'selected';?>>Có</option>
							<option value='0' <?php if($noidunghop[$i]->co_thuchien==0) echo 'selected';?>>Không</option>
						</select>
					</td>
					<td style="vertical-align: middle; text-align: center;">
						<span class="btn btn-mini btn-danger btn_xoa_noidunghop">Xóa</span>
					</td>
				</tr>
			<?php }?>
			</table>
			<!-- xcv -->
		</div>
	</div>
<input name="id" type="hidden" value="<?php echo $row->id; ?>" />
<input type="hidden" name="thonto_id" id='thonto_id' value="<?php echo $row->thonto_id; ?>" />
<input type="hidden" name="dotbaocao_id" id='dotbaocao_id' value="<?php echo $row->dotbaocao_id; ?>" />
</form>
<script type="text/javascript">
jQuery(document).ready(function($){
	$('#form_tinhhinhquanly').validate({
		ignore: [],
		errorPlacement : function(error, element) {},
		  rules: {
		      "thonto_id": { required: true, },
		      "noidunghop_id[]": { required: true, },
		      "soluongvang": { required: true, min:0},
		      "kiennghi_soluong": { required: true, min:0},
		      "kiennghi_dagiaiquyet": { required: true, min:0},
		},messages:{
			"thonto_id": { required : 'Chọn <b>Đơn vị</b>' ,},
			"noidunghop_id[]": { required : 'Chọn <b>Nội dung họp</b>' ,},
			"soluongvang": { required : 'Nhập <b>Số lượng vắng</b>' ,min: '<b>Số lượng vắng</b> phải là số nguyên dương'},
			"kiennghi_soluong": { required : 'Nhập <b>Số lượng kiến nghị</b>' ,min: '<b>Số lượng kiến nghị</b> phải là số nguyên dương'},
			"kiennghi_dagiaiquyet": { required : 'Nhập <b>Số kiến nghị đã giải quyết</b>' , min: '<b>Số kiến nghị đã giải quyết</b> phải là số nguyên dương'},
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
			var form_tinhhinhquanly=$('#form_tinhhinhquanly').serialize();
			$.blockUI();
			$.ajax({
				type: 'POST',
	  			url: '/index.php?option=com_thonto&controller=tinhhinhquanly&task=luutinhhinhquanly&format=raw',
	  			data: {form_tinhhinhquanly : form_tinhhinhquanly},
	  			success:function(data){
		  			if (data == true){
			  			$.unblockUI();
			  			_initViewDetailPage(id);
			  			loadNoticeBoardSuccess('Thông báo', 'Xử lý thành công.');
			  		}
		  			else {$.unblockUI();loadNoticeBoardError('Thông báo', 'Có lỗi xảy ra, vui lòng liên hệ quản trị viên!');}
	  			}
	        });
		}
	});
	$('#btn_add_noidunghop').on('click', function(){
		var xhtml = '<tr class="ye">';
			xhtml+= '<td style="vertical-align: middle; text-align: center;">';
			xhtml+= '<?php echo ThontoHelper::selectBoxAndAttr('',array('name'=>'noidunghop_id[]'),'thonto_danhmucnoidunghop', array('id','ten'), '', 'ten asc');?>';
			xhtml+= '</td>';
			xhtml+= '<td style="vertical-align: middle; text-align: center;">';
			xhtml+= "<select name='co_thuchien[]' class='input-small'>			<option value='1'>Có</option>			<option value='0'>Không</option>		</select>";
			xhtml+= '</td>';
			xhtml+= '<td style="vertical-align: middle; text-align: center;">';
			xhtml+= '<span class="btn btn-mini btn-danger btn_xoa_noidunghop">Xóa</span>';
			xhtml+= '</td>';
			xhtml+= '</tr>';
		$('#div_noidunghop').append(xhtml);
	});
});
</script>