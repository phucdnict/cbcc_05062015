<?php
$user = JFactory::getUser();
?>
<form class="form-horizontal row-fluid" name="frmThanhLap"	id="frmThanhLap" method="post"	action="<?php echo JRoute::_('index.php?option=com_tochuc&controller=tochuc&task=savethanhlap')?>" enctype="multipart/form-data">
<input type="hidden" value="<?php echo $this->row->id; ?>" name="id" id="id">
<input type="hidden" value="<?php echo $this->row->type; ?>" name="type" id="type">
<input type="hidden" value="<?php echo $this->row->parent_id; ?>" name="parent_id" id="parent_id">	
<label for="parent_id" style="display:none;">Cây đơn vị <span class="required">*</span> </label>
<label for="type" style="display:none;">Loại <span class="required">*</span></label>
<div class="tabbable">
		<ul class="nav nav-tabs" id="myTab3">
			<li class="active"><a data-toggle="tab"	href="#COM_TOCHUC_THANHLAP_TAB1">Thông tin chung</a></li>
			<li><a data-toggle="tab" href="#COM_TOCHUC_THANHLAP_TAB3">Cấu hình cây báo cáo</a></li>
		</ul>
		<div class="tab-content">
			<div id="COM_TOCHUC_THANHLAP_TAB1" class="tab-pane active">
				<fieldset>
					<legend>Thông tin chung</legend>
					<div class="row-fluid">
						<div class="control-group span6">
							<label class="control-label" for="name">Tên <span class="required">*</span></label>
							<div class="controls">
							
							<input type="text" value="<?php echo $this->row->name;?>"name="name" id="name" class="validNameVochua">
							</div>
						</div>
						<div class="control-group span6">
							<label class="control-label" for="s_name">Tên viết tắt <span
								class="required">*</span></label>
							<div class="controls">
								<input type="text" value="<?php echo $this->row->s_name; ?>" name="s_name" id="s_name">
							</div>
						</div>	
					</div>
					<div class="row-fluid">	
						<div class="control-group span6">
								<label class="control-label" for="ghichu">Ghi chú</label>
								<div class="controls">
									<textarea rows="5" cols="30" id="ghichu" name="ghichu"><?php echo $this->row->ghichu;?></textarea>
								</div>
							</div>	
					</div>					
</fieldset>					
</div>
			<div id="COM_TOCHUC_THANHLAP_TAB3" class="tab-pane">
				<fieldset>
					<legend>Bổ sung đơn vị vừa tạo vào cấu hình cây báo cáo</legend>
					<?php 
					$caybaocao = $this->caybaocao;
					for ($i = 0; $i < count($caybaocao); $i++) {
					?>
					<div class="row-fluid">	
						<div class="control-group">
							<div class="controls">
								<!-- <input type="hidden" name="chkrep_hc_name" value="0"> -->
								<label>
									<input type="checkbox" name="report_group_code[]" <?php if ($caybaocao[$i]['report_group_code']=='thongkenhanh'){ echo 'checked = "checked"';}?> class="report_group_code" value="<?php echo $caybaocao[$i]['report_group_code']?>"><span class="lbl">&nbsp;&nbsp; <?php echo $caybaocao[$i]['name']?></span>
								</label>
							</div>
						</div>
					</div>
					<?php } ?>
				</fieldset>
			</div>
</div>
</div>
<input type="hidden" name="action_name" id="action_name" value="">
<input type="hidden" name="active" id="active" value="<?php echo $this->row->active;?>">
<input type="hidden" name="is_valid_name" id="is_valid_name" value="">
<?php echo JHTML::_( 'form.token' ); ?> 	
</form>
<script type="text/javascript">
jQuery(document).ready(function($){
	var initPage = function(){
		$('.chzn-select').chosen({allow_single_deselect: true});
		$('.input-mask-date').mask('99/99/9999');
		$('#btnThanhlapSubmitAndClose').unbind('click');
		$('#btnThanhlapSubmitAndNew').unbind('click');
	};
	initPage();
	var getTextTab = function(elem){
		//$("#frmThanhLap .tab-pane");
		var el = $(elem).parents('.tab-pane');
		$('#frmThanhLap a[href="#'+el.attr("id")+'"]').css("color","red");
	};
	var getTextLabel = function(id){
		return $('#frmThanhLap label[for="'+id+'"]').text();
	};
	$(".chzn-select").chosen().change(function() {
		$('#frmThanhLap').validate().element(this);
    });
    $('#name').on('blur', function(){
    	var name_tc = $(this).val();
		var parent_id = $('#parent_id_content').val();
		if(parent_id != '' && name_tc != '' && name_tc.length > 5){
			var urlCheckTochuc = '<?php echo JUri::base(true);?>/index.php?option=com_tochuc&controller=tochuc&task=checkTochucTrung';
			$.get(urlCheckTochuc, { name_tc : name_tc, parent_id : parent_id }, function(data){
				if(data > 1){
					$('#is_valid_name').val(0);
				}else{
					$('#is_valid_name').val(1);
				}
			});
		}
    });
	$.validator.setDefaults({ ignore: '' });
	$.validator.addMethod("required2", function(value, element) {
	    var isTochuc = $("#type").val() === "1";
	    var val = value.replace(/^\s+|\s+$/g,"");//trim	 	
	    if(isTochuc && (eval(val.length) == 0)){
	    	 return false;
		}else{
			return true;
		}
	}, "Trường này là bắt buộc");
		$('#frmThanhLap').validate({
			invalidHandler: function(form, validator) {
				  var errors = validator.numberOfInvalids();
				  $('#frmThanhLap a[data-toggle="tab"]').css("color","");
	               if (errors) {
	                 var message = errors == 1
	                   ? 'Xin vui lòng sửa các lỗi sau đây:\n'
	                   : 'Xin vui lòng sửa ' + errors + ' lỗi sau đây .\n';
	                 var errors = "<ol>";
	                 if (validator.errorList.length > 0) {		                 
	                     for (x=0;x<validator.errorList.length;x++) {
		                     //console.log(getTextLabel($(validator.errorList[x].element).attr("id")));
	                    	 errors += "<li class='text-info'>";
	                         errors += "" + getTextLabel($(validator.errorList[x].element).attr("id")) + validator.errorList[x].message;
	                         errors += "</li>";
	                         getTextTab($(validator.errorList[x].element));
	                     }
	                 }
	                 errors += "</ol>";
	                // alert(message + errors);
	                 $.gritter.add({
							title: message,
							text: errors,
							class_name: 'gritter-error' + ' gritter-light'
					 });		                 
	               }
	               validator.focusInvalid();
	        },		 
		  	errorPlacement: function(error, element) {		  		
	  
		    },
			  rules: {
				  "name": {	    
					  required: true
			      },
			      "s_name": {	    
					  required: true
			      },
			      "type":{
			    	  required: true
				  },
			      "parent_id": {	    
					  required: true
			      }
			  }
			 });
		 $('#btnThanhlapSubmitAndClose').click(function(){
				//console.log($('#frmThanhLap').serialize());
				 $('#action_name').val('SAVEANDCLOSE');
				 $('#parent_id').val($('#parent_id_content').val());
				  var flag = $('#frmThanhLap').valid();
				  if(flag == true){
					  document.frmThanhLap.submit();
				  }
				  //console.log(flag);
				  return false;
			 });
		$('#btnThanhlapSubmitAndNew').click(function(){
					//console.log($('#frmThanhLap').serialize());
				 	$('#action_name').val('SAVEANDNEW');
				 	$('#parent_id').val($('#parent_id_content').val());
					  var flag = $('#frmThanhLap').valid();
					  if(flag == true){
						  document.frmThanhLap.submit();
					  }
					  //console.log(flag);
					  return false;
			});
		$.validator.addMethod('validNameVochua', function(value, element){
			if($('#is_valid_name').val() == '0'){
				return false;
			}else{
				return true;
			}
		}, 'Tên vỏ chứa bạn nhập đã có trong nhánh cây đơn vị.');

}); // end document.ready
</script>