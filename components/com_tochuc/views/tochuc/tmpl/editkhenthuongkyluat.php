<?php
$user = JFactory::getUser();
$item = $this->item[0];
?>
<form class="form-horizontal row-fluid" name="frmKhenthuongkyluat" id="frmKhenthuongkyluat" method="post" enctype="multipart/form-data">
<input type="hidden" name="dept_id" value="<?php echo $this->dept_id;?>">
<input type="hidden" name="id_ktkl" value="<?php echo $item->id_ktkl;?>">
<input type="hidden" name="ht_old" value="<?php echo $this->ht;?>">
<input type="hidden" name="id" value="<?php echo $this->id;?>">
<input type="text" name="tbl" value="<?php echo $this->tbl;?>">
<?php echo JHTML::_( 'form.token' ); ?>	
	<h3 class="row-fluid header smaller lighter blue">
		<span class="span7">Thông tin khen thưởng, kỷ luật</span>
		<span class="span5">
		<span class="pull-right inline">
				<button class="btn btn-mini btn-success" id="btnResetForm" data-quatrinh-id="<?php echo $item->id_ktkl;?>"><i class="icon-plus"></i> Thêm mới</button>	
				<button type="submit" class="btn btn-mini btn-primary"><i class="icon-save"></i> Lưu</button>
		</span>		
		</span> 

	</h3>
	<div class="row-fluid">
		<div class="control-group span6">
			<label class="control-label" for="ht">Loại hình <span class="required">*</span></label>
			<div class="controls">
                <select name="ht" id="ht">
                	<option value="1" <?php if ($this->ht==1) echo 'selected'?>>Khen thưởng</option>
                	<option value="2" <?php if ($this->ht==2) echo 'selected'?>>Kỷ luật</option>
                </select>
            </div>							
		</div>
	</div>
	<div class="row-fluid">
		<div class="control-group span6">
			<label class="control-label" for="start_date_ktkl">Từ ngày <span class="required">*</span></label>
			<div class="controls">
          		 <div class="row-fluid input-append">
					<input type="text" value="<?php if(isset($item) && $item->start_date_ktkl!= null) echo date('d/m/Y', strtotime($item->start_date_ktkl));?>" class="input-small date-picker input-mask-date" name="start_date_ktkl" id="start_date_ktkl">
					<span class="add-on">
						<i class="icon-calendar"></i>
					</span>
				</div>
            </div>							
		</div>
		<div class="control-group span6">
			<label class="control-label" for="end_date_ktkl">Đến ngày</label>
			<div class="controls">
          		 <div class="row-fluid input-append">
					<input type="text" value="<?php if(isset($item) && $item->end_date_ktkl!= null) echo date('d/m/Y', strtotime($item->end_date_ktkl));?>" class="input-small date-picker input-mask-date" name="end_date_ktkl" id="end_date_ktkl">
					<span class="add-on">
						<i class="icon-calendar"></i>
					</span>
				</div>
            </div>							
		</div>
	</div>
	<div class="row-fluid">
		<div class="control-group span6">
			<label class="control-label" for="rew_code_ktkl">Hình thức <span class="required">*</span></label>
			<div class="controls">
                <?php
                	echo TochucHelper::selectBox($item->rew_code_ktkl, array('name'=>'rew_code_ktkl','hasEmpty'=>true), 'ins_dmkhenthuongkyluat', array('id','name')); 
                ?>
            </div>							
		</div>
		<div class="control-group span6">
			<label class="control-label" for="reason_ktkl">Lý do <span class="required">*</span></label>
			<div class="controls">
          		 <input type="text" id="reason_ktkl" name="reason_ktkl" value="<?php echo $item->reason_ktkl;?>" class="required">
            </div>							
		</div>
	</div>
	<div class="row-fluid">
		<div class="control-group span6">
			<label class="control-label" for="approv_date_ktkl">Ngày ký quyết định <span class="required">*</span></label>
			<div class="controls">
          		 <div class="row-fluid input-append">
					<input type="text" value="<?php if(isset($item) && $item->approv_date_ktkl!= null) echo date('d/m/Y', strtotime($item->approv_date_ktkl));?>" class="input-small date-picker input-mask-date" name="approv_date_ktkl" id="approv_date_ktkl">
					<span class="add-on">
						<i class="icon-calendar"></i>
					</span>
				</div>
            </div>							
		</div>
		<div class="control-group span6">
			<label class="control-label" for="approv_number_ktkl">Số quyết định <span class="required">*</span></label>
			<div class="controls">
          		 <input type="text" id="approv_number_ktkl" name="approv_number_ktkl" value="<?php echo $item->approv_number_ktkl;?>" class="required">
            </div>							
		</div>
	</div>
	<div class="row-fluid">
		<div class="control-group span6">
			<label class="control-label" for="approv_unit_ktkl">Cơ quan ra quyết định <span class="required">*</span></label>
			<div class="controls">
          		 <input type="text" id="approv_unit_ktkl" name="approv_unit_ktkl" value="<?php echo $item->approv_unit_ktkl;?>" class="required">
            </div>							
		</div>
		<div class="control-group span6">
			<label class="control-label" for="approv_per_ktkl">Người ký <span class="required">*</span></label>
			<div class="controls">
          		 <input type="text" id="approv_per_ktkl" name="approv_per_ktkl" value="<?php echo $item->approv_per_ktkl;?>" class="required">
            </div>							
		</div>
	</div>	
	</div>		
</form>
<script>
jQuery(document).ready(function($){
	var initPage = function(){
		$('.date-picker').datepicker( {format: 'dd/mm/yyyy', autoClose:true});
		$('.input-mask-date').mask('99/99/9999');
		
		$('#frmKhenthuongkyluat').validate({
			ignore: [],
			errorPlacement : function(error, element) {},
			  rules: {
				  "ht":{
					  required: true 
				  },
				  "start_date_ktkl":{
					  required: true 
				  },
				 "rew_code_ktkl":{
					  required: true, 
				  },
				  "reason_ktkl": {
			    	  required: true,
			      },
			      "approv_date_ktkl": {
			    	  required: true,
			      },
			      "approv_number_ktkl": {
			    	  required: true,
			      },
			      "approv_unit_ktkl": {
			    	  required: true,
			      },
			      "approv_per_ktkl": {
			    	  required: true,
			      },
		},messages:{
			"start_date_ktkl": { required : 'Nhập <b>Ngày bắt đầu</b>' },
			"rew_code_ktkl": { required : 'Nhập <b>Hình thức</b>' },
			"reason_ktkl": { required : 'Nhập <b>Lý do</b>' },
			"approv_date_ktkl": { required : 'Nhập <b>Ngày quyết định</b>' },
			"approv_number_ktkl": { required : 'Nhập <b>Số quyết định</b>' },
			"approv_unit_ktkl": { required : 'Nhập <b>Cơ quan ra quyết định</b>' },
			"approv_per_ktkl": { required : 'Nhập <b>Người ký quyết định</b>' },
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
			var frmKhenthuongkyluat=$('#frmKhenthuongkyluat').serialize();
			$.ajax({
				type: 'POST',
	  			url: '<?php echo JUri::base(true);?>/index.php?option=com_tochuc&controller=tochuc&task=savekhenthuongkyluat&format=raw',
	  			data: {frmKhenthuongkyluat : frmKhenthuongkyluat},
	  			success:function(data){
	  				jQuery.ajax({
		  				  type: "GET",
		  				  url: 'index.php?option=com_tochuc&task=khenthuongkyluat&format=raw&Itemid=<?php echo $this->Itemid;?>&id=<?php echo $this->dept_id;?>',	
			  				success: function (data,textStatus,jqXHR){
				  				  $.unblockUI();
				  				  $('#com_tochuc_viewdetail').html(data);
				  			  }
				  		});
	  			}
	        });
		}
	});
		
		 $('#btnResetForm').click(function(){
			// var quatrinh_id = '<?php echo $this->item->id;?>';
				jQuery("#form-khenthuongkyluat").load('index.php?option=com_tochuc&controller=tochuc&task=editkhenthuongkyluat&format=raw&dept_id=<?php echo $this->dept_id;?>&time=<?php echo time();?>',function(){
					$('#tochuc-bienche-manager-collapse-one').collapse('show');
				});
				return false;
		 });
	};
	initPage();
});
function deleteFileById(id,url){
	if(confirm('Bạn có muốn xóa không?')){
		jQuery.ajax({
			  type: "DELETE",
			  url: url,
			  success: function (data,textStatus,jqXHR){
					var element = document.getElementById('file_'+id);
					element.parentNode.removeChild(element);
					//console.log(data);
			  }
		});
	}
	return false;
}
</script>