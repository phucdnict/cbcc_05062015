<?php
$user = JFactory::getUser();
$item = $this->item[0];
?>
<form class="form-horizontal row-fluid" name="frmKhenthuong" id="frmKhenthuong" method="post" enctype="multipart/form-data">
<input type="hidden" name="dept_id" value="<?php echo $this->dept_id;?>">
<input type="hidden" name="id_kt" value="<?php echo $item->id_kt;?>">
<input type="hidden" name="id" value="<?php echo $this->id;?>">
<?php echo JHTML::_( 'form.token' ); ?>	
	<h3 class="row-fluid header smaller lighter blue">
		<span class="span7">Thông tin quá trình khen thưởng</span>
		<span class="span5">
		<span class="pull-right inline">
				<button class="btn btn-mini btn-success" id="btnResetForm" data-quatrinh-id="<?php echo $item->id_kt;?>"><i class="icon-plus"></i> Thêm mới</button>	
				<button type="submit" class="btn btn-mini btn-primary"><i class="icon-save"></i> Lưu</button>
		</span>		
		</span> 
	</h3>
	<div class="row-fluid">
		<div class="control-group span6">
			<label class="control-label" for="start_date_kt">Từ ngày <span class="required">*</span></label>
			<div class="controls">
          		 <div class="row-fluid input-append">
					<input type="text" value="<?php if(isset($item) && $item->start_date_kt!= null) echo date('d/m/Y', strtotime($item->start_date_kt));?>" class="input-small date-picker input-mask-date" name="start_date_kt" id="start_date_kt">
					<span class="add-on">
						<i class="icon-calendar"></i>
					</span>
				</div>
            </div>							
		</div>
		<div class="control-group span6">
			<label class="control-label" for="end_date_kt">Đến ngày</label>
			<div class="controls">
          		 <div class="row-fluid input-append">
					<input type="text" value="<?php if(isset($item) && $item->end_date_kt!= null) echo date('d/m/Y', strtotime($item->end_date_kt));?>" class="input-small date-picker input-mask-date" name="end_date_kt" id="end_date_kt">
					<span class="add-on">
						<i class="icon-calendar"></i>
					</span>
				</div>
            </div>							
		</div>
	</div>
	<div class="row-fluid">
		<div class="control-group span6">
			<label class="control-label" for="rew_code_kt">Hình thức <span class="required">*</span></label>
			<div class="controls">
                <?php
                	echo TochucHelper::selectBox($item->rew_code_kt, array('name'=>'rew_code_kt','hasEmpty'=>true), 'ins_dmkhenthuongkyluat', array('id','name'), array('status = 1','type="KT"')); 
                ?>
            </div>							
		</div>
		<div class="control-group span6">
			<label class="control-label" for="reason_kt">Lý do <span class="required">*</span></label>
			<div class="controls">
          		 <input type="text" id="reason_kt" name="reason_kt" value="<?php echo $item->reason_kt;?>" class="required">
            </div>							
		</div>
	</div>
	<div class="row-fluid">
		<div class="control-group span6">
			<label class="control-label" for="approv_date_kt">Ngày ký quyết định <span class="required">*</span></label>
			<div class="controls">
          		 <div class="row-fluid input-append">
					<input type="text" value="<?php if(isset($item) && $item->approv_date_kt!= null) echo date('d/m/Y', strtotime($item->approv_date_kt));?>" class="input-small date-picker input-mask-date" name="approv_date_kt" id="approv_date_kt">
					<span class="add-on">
						<i class="icon-calendar"></i>
					</span>
				</div>
            </div>							
		</div>
		<div class="control-group span6">
			<label class="control-label" for="approv_number_kt">Số quyết định <span class="required">*</span></label>
			<div class="controls">
          		 <input type="text" id="approv_number_kt" name="approv_number_kt" value="<?php echo $item->approv_number_kt;?>" class="required">
            </div>							
		</div>
	</div>
	<div class="row-fluid">
		<div class="control-group span6">
			<label class="control-label" for="approv_unit_kt">Cơ quan ra quyết định <span class="required">*</span></label>
			<div class="controls">
          		 <input type="text" id="approv_unit_kt" name="approv_unit_kt" value="<?php echo $item->approv_unit_kt;?>" class="required">
            </div>							
		</div>
		<div class="control-group span6">
			<label class="control-label" for="approv_per_kt">Người ký <span class="required">*</span></label>
			<div class="controls">
          		 <input type="text" id="approv_per_kt" name="approv_per_kt" value="<?php echo $item->approv_per_kt;?>" class="required">
            </div>							
		</div>
	</div>	
	</div>		
</form>
<script>
jQuery(document).ready(function($){
	var initPage = function(){
		$('.date-picker').datepicker( {format: 'dd/mm/yyyy', autoClose:true}).on('changeDate', function (ev) {
		    $(this).datepicker('hide');
		});
		function convertDateVN(datevn){
			var arr = datevn.split("/");
			var day = arr[0];
			var month = arr[1];
			var year = arr[2];
			return year+'-'+month+'-'+day;   
		}
		$('.input-mask-date').mask('99/99/9999');
		$.validator.addMethod(
			    "greaterThan",
			    function(value, element, params) {
				    if ($(params).val() == undefined || $(params).val() == '__/__/____' || $(params).val() == '' || $(params).val()==null){
				    	var target = '2099-12-31';
				    }
				    else{
			        	var target = convertDateVN($(params).val());
				    }
			        if (value == undefined || value == '__/__/____' || value == '' || value==null )
				        var value = "2099-12-31";
			        else{
			        	var value = convertDateVN(value);
			        }
			        var isValueNumeric = !isNaN(parseFloat(value)) && isFinite(value);
			        var isTargetNumeric = !isNaN(parseFloat(target)) && isFinite(target);
			        if (isValueNumeric && isTargetNumeric) {
			            return Number(value) >= Number(target);
			        }
			        if (!/Invalid|NaN/.test(new Date(value))) {
			            return new Date(value) >= new Date(target);
			        }
			        return false;
			    });
		$('#frmKhenthuong').validate({
			ignore: [],
			errorPlacement : function(error, element) {},
			  rules: {
				  "ht":{
					  required: true 
				  },
				  "start_date_kt":{
					  required: true 
				  },
				  "end_date_kt":{
					  greaterThan: "#start_date_kt"
				  },
				 "rew_code_kt":{
					  required: true, 
				  },
				  "reason_kt": {
			    	  required: true,
			      },
			      "approv_date_kt": {
			    	  required: true,
			      },
			      "approv_number_kt": {
			    	  required: true,
			      },
			      "approv_unit_kt": {
			    	  required: true,
			      },
			      "approv_per_kt": {
			    	  required: true,
			      },
		},messages:{
			"start_date_kt": { required : 'Nhập <b>Ngày bắt đầu</b>' },
			"end_date_kt": { greaterThan : '<b>Ngày kết thúc</b> phải lớn hơn <b>Ngày bắt đầu</b>' },
			"rew_code_kt": { required : 'Nhập <b>Hình thức</b>' },
			"reason_kt": { required : 'Nhập <b>Lý do</b>' },
			"approv_date_kt": { required : 'Nhập <b>Ngày quyết định</b>' },
			"approv_number_kt": { required : 'Nhập <b>Số quyết định</b>' },
			"approv_unit_kt": { required : 'Nhập <b>Cơ quan ra quyết định</b>' },
			"approv_per_kt": { required : 'Nhập <b>Người ký quyết định</b>' },
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
			var frmKhenthuong=$('#frmKhenthuong').serialize();
			$.ajax({
				type: 'POST',
	  			url: '<?php echo JUri::base(true);?>/index.php?option=com_tochuc&controller=tochuc&task=savekhenthuong&format=raw',
	  			data: {frmKhenthuong : frmKhenthuong},
	  			success:function(data){
		  			if (data == true){
		  				loadNoticeBoardSuccess('Thông báo', 'Thao tác thành công!');
		  				$.blockUI();
		  				$('#tochuc-bienche-manager-collapse-one').html('');
		  				jQuery.ajax({
			  				  type: "GET",
			  				  url: 'index.php?option=com_tochuc&task=khenthuongkyluat&format=raw&Itemid=<?php echo $this->Itemid;?>&id=<?php echo $this->dept_id;?>',	
				  				success: function (data,textStatus,jqXHR){
					  				  $.unblockUI();
					  				  $('#com_tochuc_viewdetail').html(data);
					  			  }
					  		});
			  		}
		  			else loadNoticeBoardError('Thông báo', 'Có lỗi xảy ra, vui lòng liên hệ quản trị viên!');
	  			}
	        });
		}
	});
		
		 $('#btnResetForm').click(function(){
				jQuery("#form-khenthuongkyluat").load('index.php?option=com_tochuc&controller=tochuc&task=editkhenthuong&format=raw&dept_id=<?php echo $this->dept_id;?>&time=<?php echo time();?>',function(){
				});
				return false;
		 });
	};
	initPage();
});
</script>