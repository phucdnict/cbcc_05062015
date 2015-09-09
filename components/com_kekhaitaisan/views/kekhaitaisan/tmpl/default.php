<?php
$model			=	Core::model('Kekhaitaisan/Kekhaitaisan');
$hosochinh_id	=	$this->hosochinh_id;
$nguoikekhai= $this->nguoikekhai;
if (isset($_REQUEST['dotkekhai']))
	$dotkekhai_id 	= $_REQUEST['dotkekhai'];
$dotkekhai	=	$model->getCbo('kkts_dotkekhai','id, name', array('status = 1'), 'id asc', '0', '--Chọn đợt--', 'id', 'name', $dotkekhai_id, 'dot_kekhai');
// 
?>
<fieldset>
<legend>Kê khai tài sản, thu nhập
	<span class="pull-right inline">
		<?php echo $dotkekhai;?>
	</span>
</legend>

<div id="accordion2" class="accordion form-horizontal" >
	<div class="accordion-group">
		<div class="accordion-heading">
			<a href="#collapseOne" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle collapsed">
				I. Thông tin chung
			</a>
		</div>
		<div class="accordion-body collapse" id="collapseOne">
			<div class="accordion-inner">
				<h4 class="row-fluid header smaller lighter blue">Thông tin cá nhân</h4>
				<div class="span9">
				</div>
				<div class="span4">
					<div class="control-group">
						<label class="control-label">Họ tên </label>
						<div class="controls">
							<input type="text" disabled="disabled" value="<?php echo $nguoikekhai[0]->hoten; ?>"/>
						</div>
					</div>
				</div>
				<div class="span4">
					<div class="control-group">
						<label class="control-label">Năm sinh </label>
						<div class="controls">
							<input type="text" class="input-small" disabled="disabled" value="<?php echo date("Y", strtotime($nguoikekhai[0]->ngaysinh)) ; ?>"/>
						</div>
					</div>
				</div>
				<div class="span4">
					<div class="control-group">
						<label class="control-label">Chức vụ </label>
						<div class="controls">
							<input type="text" disabled="disabled" value="<?php echo $nguoikekhai[0]->congtac_chucvu; ?>"/>
						</div>
					</div>
				</div>
				<div class="span8">
					<div class="control-group">
						<label class="control-label">Đơn vị công tác </label>
						<div class="controls">
							<input type="text" style="width:606px" disabled="disabled" value="<?php echo $nguoikekhai[0]->congtac_donvi; ?>"/>
						</div>
					</div>
				</div>
				<div class="span8">
					<div class="control-group">
						<label class="control-label">Hộ khẩu thường trú </label>
						<div class="controls">
							<input style="width:606px" type="text"  disabled="disabled" value="<?php echo $nguoikekhai[0]->comm_peraddress.' '.$nguoikekhai[0]->dist_peraddress.' '.$nguoikekhai[0]->city_peraddress; ?>"/>
						</div>
					</div>
				</div>
				<div class="span8">
					<div class="control-group">
						<label class="control-label">Chỗ ở hiện tại </label>
						<div class="controls">
							<input style="width:606px" type="text"  disabled="disabled" value="<?php echo $nguoikekhai[0]->per_residence; ?>"/>
						</div>
					</div>
				</div>
				<div style="clear:both"></div>
				<h4 class="row-fluid header smaller lighter blue">Thông tin nhân thân 
					<span class="pull-right inline">
				       	<span type="button" class="btn btn-small btn-success" id="btn_add_nhanthan" data-toggle="modal" data-target=".modal"><i class="icon-plus"></i>Thêm mới</span>
				        <span type="button" class="btn btn-small btn-danger" id="btn_del_nhanthan"><i class="icon-remove"></i>Xóa</span>
			        </span>
			    </h4>
				<div class="span10" id="div_nhanthan" style="margin-left:0px">
				</div>
			</div>
		</div>
	</div>
	<div class="accordion-group">
		<div class="accordion-heading">
			<a href="#collapseTwo" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle collapsed">
				II. Thông tin mô tả về tài sản
			</a>
		</div>
		<div class="accordion-body in collapse" id="collapseTwo">
			<div class="accordion-inner">
				<h4 class="row-fluid header smaller lighter blue">Thông tin tài sản
					<span class="pull-right inline">
				       	<span type="button" class="btn btn-small btn-success" id="btn_add_taisan" data-toggle="modal" data-target=".modal"><i class="icon-plus"></i>Thêm mới</span>
				        <span type="button" class="btn btn-small btn-danger" id="btn_del_taisan"><i class="icon-remove"></i>Xóa</span>
			        </span>
				</h4>
				<div class="span10" id="div_taisan" style="margin-left:0px">
				</div>
			</div>
		</div>
	</div>
	
<!-- 	<div class="accordion-group"> -->
<!-- 		<div class="accordion-heading"> -->
<!-- 			<a href="#collapseThree" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle collapsed"> -->
<!-- 				III. Giải trình về sự biến động của tài sản -->
<!-- 			</a> -->
<!-- 		</div> -->

<!-- 		<div class="accordion-body collapse" id="collapseThree"> -->
<!-- 			<div class="accordion-inner"> -->
<!-- 			textarea rows="10" style="width:98%"></textarea> -->
<!-- 			</div> -->
<!-- 		</div> -->
<!-- 	</div> -->
</fieldset>
</div>
<input type="hidden" id="hosochinh_id" name="hosochinh_id" value="<?php echo $nguoikekhai[0]->hosochinh_id; ?>" />
<input type="hidden" name="task" id="task" value="" />
<input type="hidden" name="kekhai_id" id="kekhai_id" value="<?php echo $this->kekhai_id;?>" />
<input type="hidden" name="option" value="com_kekhaitaisan" />
<input type="hidden" name="controller" value="kekhaitaisan" />
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"  style="width: 900px; left: 35%; display: block;">
		<div id="div_modal">
		</div>
</div>
<script type="text/javascript">
var idHoso = <?php if(isset($hosochinh_id)) echo $hosochinh_id; else echo 'null'?>;
var kekhai_id = <?php if(isset($this->kekhai_id)) echo $this->kekhai_id; else echo 'null'?>;
var chosen = function(){
   		jQuery(".chosen").chosen({
   	   		search_contains: true,
   	   		no_results_text: "Không tìm thấy "
 		});
 	};
jQuery(document).ready(function($){
	chosen();
	$('#dot_kekhai').on('change', function(){
		idHoso = $('#hosochinh_id').val();
		dot 		=	$(this).val();
		$.ajax({
			type: 'POST',
			url: '/index.php?option=com_kekhaitaisan&view=kekhaitaisan&format=raw&task=getkekhaiid',
			data:{ idHoso : idHoso, dot : dot},
			success: function(data){
				window.location.href = '/index.php?option=com_kekhaitaisan&controller=kekhaitaisan&task=kekhai&dotkekhai='+dot;
			}
		});
 	});
	if($('#dot_kekhai').val()==0) $('.accordion-group').hide(); 
	else {
		$('.accordion-group').show();
		$('#div_nhanthan').load('/index.php?option=com_kekhaitaisan&controller=kekhaitaisan&task=nhanthan&format=raw', function(){
		});
		$('#div_taisan').load('/index.php?option=com_kekhaitaisan&controller=kekhaitaisan&task=taisan&format=raw&kekhai_id='+kekhai_id, function(){
		});
	};
	// Nhân thân
	$('#btn_del_nhanthan').on('click', function(){
		var iddel = [];
		$(".ck_nhanthan:checked").each(function() {
			iddel.push($(this).val());
		});
		if (iddel.length>0){
			if(confirm('BẠN CÓ CHẮC CHẮN XÓA?')){
				$.ajax({
					type: 'POST',
		  			url: '/index.php?option=com_kekhaitaisan&view=kekhaitaisan&format=raw&task=xoanhanthan',
		  			data: {iddel : iddel},
		  			success:function(data){
			  			if (data == true){
				  			$.blockUI();
				  			$('#div_nhanthan').load('/index.php?option=com_kekhaitaisan&controller=kekhaitaisan&task=nhanthan&format=raw', function(){
				  				$.unblockUI();
				  				loadNoticeBoardSuccess('Thông báo', 'Thao tác thành công!');
				  			});
				  		}
			  			else loadNoticeBoardError('Thông báo', 'Có lỗi xảy ra, vui lòng liên hệ quản trị viên!');
		  			}
		        });
			}
		}
		else alert("Vui lòng chọn mục cần xóa!!");
	});	
	$('body').delegate('#hokhau_tinhthanh','change',function(){
		var hokhau_tinhthanh = $('option:selected', this).val();
		if (hokhau_tinhthanh!=null)
		$.ajax({
			type: 'POST',
			url: '<?php echo JUri::base(true);?>/index.php?option=com_kekhaitaisan&view=kekhaitaisan&format=raw&task=getdist',
			data: { hokhau_tinhthanh : hokhau_tinhthanh},
			success:function(data){
				$('#div_hokhau_quanhuyen').html(data);
				$('#div_hokhau_phuongxa').html('<select class="chosen"><option>--Chọn phường/xã--</option></select>');
				chosen();
			}
		});
   	});
   	$('body').delegate('#hokhau_quanhuyen','change',function(){
		var hokhau_quanhuyen = $('option:selected', this).val();
		if (hokhau_quanhuyen!=null)
		$.ajax({
			type: 'POST',
			url: '<?php echo JUri::base(true);?>/index.php?option=com_kekhaitaisan&view=kekhaitaisan&format=raw&task=getcomm',
			data: { hokhau_quanhuyen : hokhau_quanhuyen},
			success:function(data){
				$('#div_hokhau_phuongxa').html(data);
				chosen();
			}
		});
   	});
	$('#btn_add_nhanthan').on('click', function(){
		$.blockUI();
		$('#div_modal').load('/index.php?option=com_kekhaitaisan&view=kekhaitaisan&format=raw&task=frmnhanthan',function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_view_nhanthan', 'click', function(){
		var  nhanthan_id = $(this).attr('nhanthan_id');
		$.blockUI();
		$('#div_modal').load('/index.php?option=com_kekhaitaisan&view=kekhaitaisan&format=raw&task=frmnhanthan&nhanthan_id='+nhanthan_id,function(){
			$.unblockUI();
		});
	});
	// end Nhân thân
	// Tài sản
	$('#btn_add_taisan').on('click', function(){
		$.blockUI();
		$('#div_modal').load('/index.php?option=com_kekhaitaisan&view=kekhaitaisan&format=raw&task=frmtaisan',function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_view_taisan', 'click', function(){
		$.blockUI();
		var  taisan_id = $(this).attr('taisan_id'); //id của tài sản
		var loaitaisan_id = $(this).attr('pr'); //id của loai tài sản
		var  type = $(this).attr('type'); // loại tài sản
		$('#div_modal').load('/index.php?option=com_kekhaitaisan&view=kekhaitaisan&format=raw&task=frmtaisan&id='+taisan_id,function(){
			if (type==0) $('#frmts').load('/index.php?option=com_kekhaitaisan&view=kekhaitaisan&format=raw&task=frmkhac&loaitaisan_id='+loaitaisan_id+'&id='+taisan_id,function(){
				$.unblockUI();
			});
			else if (type==1) $('#frmts').load('/index.php?option=com_kekhaitaisan&view=kekhaitaisan&format=raw&task=frmnha&id='+taisan_id,function(){
				$.unblockUI();
			});
			else if (type==2) $('#frmts').load('/index.php?option=com_kekhaitaisan&view=kekhaitaisan&format=raw&task=frmdat&id='+taisan_id,function(){
				$.unblockUI();
			});
		});
	});
	$('#btn_del_taisan').on('click', function(){
		var iddel = [];
		$(".ck_taisan:checked").each(function() {
			iddel.push($(this).val());
		});
		if (iddel.length>0){
			if(confirm('BẠN CÓ CHẮC CHẮN XÓA?')){
				$.ajax({
					type: 'POST',
		  			url: '/index.php?option=com_kekhaitaisan&view=kekhaitaisan&format=raw&task=xoataisan',
		  			data: {iddel : iddel},
		  			success:function(data){
			  			if (data == true){
				  			$.blockUI();
				  			$('#div_taisan').load('/index.php?option=com_kekhaitaisan&controller=kekhaitaisan&task=taisan&format=raw&kekhai_id='+kekhai_id, function(){
				  				$.unblockUI();
				  				loadNoticeBoardSuccess('Thông báo', 'Thao tác thành công!');
				  			});
				  		}
			  			else loadNoticeBoardError('Thông báo', 'Có lỗi xảy ra, vui lòng liên hệ quản trị viên!');
		  			}
		        });
			}
		}
		else alert("Vui lòng chọn mục cần xóa!!");
	});	
	// form tài sản
	$('body').delegate('#loaitaisan_id', 'change', function(){
		var type_loaitaisan_id = $('option:selected', this).attr('type');
		var loaitaisan_id = $('option:selected', this).val();
		$.blockUI();
		if (type_loaitaisan_id==0) $('#frmts').load('/index.php?option=com_kekhaitaisan&view=kekhaitaisan&format=raw&task=frmkhac&loaitaisan_id='+loaitaisan_id,function(){
			$.unblockUI();
		});
		else if (type_loaitaisan_id==1) $('#frmts').load('/index.php?option=com_kekhaitaisan&view=kekhaitaisan&format=raw&task=frmnha',function(){
			$.unblockUI();
		});
		else if (type_loaitaisan_id==2) $('#frmts').load('/index.php?option=com_kekhaitaisan&view=kekhaitaisan&format=raw&task=frmdat',function(){
			$.unblockUI();
		});
		else {$('#frmts').html('');$.unblockUI();}
	});
});
</script>