<?php
$user = JFactory::getUser();
?>
<form class="form-horizontal row-fluid" name="frmThanhLap"	id="frmThanhLap" method="post"	action="<?php echo JRoute::_('index.php?option=com_tochuc&controller=tochuc&task=savethanhlap')?>" enctype="multipart/form-data">
<label for="parent_id" style="display:none;">Cây đơn vị <span class="required">*</span></label>
<label for="type" style="display:none;">Loại <span class="required">*</span></label>	
<input type="hidden" value="<?php echo $this->row->id; ?>" name="id" id="id">								
<input type="hidden" value="<?php echo $this->row->parent_id; ?>" name="parent_id" id="parent_id">
<input type="hidden" value="<?php echo $this->row->type; ?>" name="type" id="type">	
<div class="tabbable">
		<ul class="nav nav-tabs" id="myTab3">
			<li class="active"><a data-toggle="tab"
				href="#COM_TOCHUC_THANHLAP_TAB1">Thông tin chung</a></li>
			<li><a data-toggle="tab" href="#COM_TOCHUC_THANHLAP_TAB2">Thông tin thêm</a></li>
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
							
							<input type="text" value="<?php echo $this->row->name;?>"name="name" id="name" class="validNamePhong">
							</div>
						</div>
						<div class="control-group span6">
							<label class="control-label" for="code">Mã hiệu</label>
							<div class="controls">
								<input type="text" value="<?php echo $this->row->code; ?>" id="code" name="code">
							</div>
						</div>
					</div>
					<div class="row-fluid">
						<div class="control-group span6">
							<label class="control-label" for="s_name">Tên viết tắt <span
								class="required">*</span></label>
							<div class="controls">
								<input type="text" value="<?php echo $this->row->s_name; ?>" name="s_name" id="s_name">
							</div>
						</div>	
					</div>
</fieldset>					
<fieldset>
<legend>Thông tin thành lập</legend>
					<div class="row-fluid">
						<div class="control-group span6">
							<label class="control-label" for="type_created">Cách thức thành lập <span class="required">*</span></label>
								<div class="controls">			
								<select id="type_created" name="type_created">
									<option value="1">Thành lập mới</option>
									<option value="2">Sáp nhập từ tổ chức khác</option>
									<option value="3">Chia tách từ tổ chức khác</option>
									<option value="4">Hợp nhất các tổ chức</option>										
								</select>
								</div>
						</div>
						<div class="control-group span6">
							<label class="control-label" for="vanban_created_coquan_banhanh">Cơ quan ban hành</label>
								<div class="controls">
								<input type="hidden" name="vanban_created[id]" id="vanban_created_id" value="<?php echo $this->vanban_created['id'];?>">
								<?php
								echo JHTML::_('select.genericlist',$this->arr_ins_created,'vanban_created[coquan_banhanh_id]', array('class'=>'chzn-select','data-placeholder'=>"Hãy chọn..."),'value','text',$this->vanban_created['coquan_banhanh_id']);
								?>
								  <a data-target="#coquan_banhanh_detail" role="button" class="btn btn-mini" data-toggle="collapse"> ... </a>
								<div id="coquan_banhanh_detail" class="collapse">
								    <div id="thanhlap-tochuc-coquan_banhanh" class="tree"></div>
								</div>								
							</div>
						</div>	
					</div>
					<div class="row-fluid">
						<div class="control-group span6">
							<label class="control-label" for="vanban_created_mahieu">Số Quyết định</label>
							<div class="controls">
								<input type="text" value="<?php echo $this->vanban_created['mahieu']; ?>" name="vanban_created[mahieu]" id="vanban_created_mahieu">							
								<ul class="files unstyled spaced">
								<?php for($i = 0, $n = count($this->file_created); $i < $n; $i++){?>
									<li id="li_<?php echo $this->file_created[$i]['code'] ?>">
										<span class="btn btn-minier btn-danger btn_remove_soqd" data-code="<?php echo $this->file_created[$i]['code'] ?>">
											<i class="icon-trash"></i>
										</span>
										<a href="<?php echo JUri::root(true)?>/index.php?option=com_core&controller=attachment&task=download&code=<?php echo $this->file_created[$i]['code'] ?>" 
											target="_blank"><?php echo $this->file_created[$i]['filename'] ?></a>
									</li>
								<?php } ?>
								</ul>
								<?php echo Core::inputAttachment('tochuc-attachment', 0, 1, '2015', -1);?>
							</div>
						</div>
						<div class="control-group span6">							
							<label class="control-label" for="vanban_created_ngaybanhanh">Ngày ban hành</label>
							<div class="controls">
								<div class="input-append">
								<input type="text" value="<?php echo $this->vanban_created['ngaybanhanh']; ?>" class="input-mask-date input-small" id="vanban_created_ngaybanhanh" name="vanban_created[ngaybanhanh]">
								<span class="add-on">
									<i class="icon-calendar"></i>
								</span>
								</div>
							</div>							
						</div>
					</div>
					<div class="row-fluid">			
						<div class="control-group span6">
							<label class="control-label" for="ins_created">Cơ quan chủ quản <span class="required">*</span></label>
							<div class="controls">
								<?php
								echo JHTML::_('select.genericlist',$this->arr_ins_created,'ins_created', array('class'=>'chzn-select','data-placeholder'=>"Hãy chọn..."),'value','text',$this->row->ins_created);
								?>								    
                				<a data-target="#ins_created_detail" role="button" class="btn btn-mini" data-toggle="collapse"> ... </a>
								<div id="ins_created_detail" class="collapse">
								    <div id="thanhlap-tochuc-ins_created" class="tree"></div>
								</div>						
			            	</div>
						</div>
					</div>

</fieldset>
<fieldset>
<legend>Trạng thái</legend>
					<div class="row-fluid">
						<div class="span6">
							<div class="control-group">
								<label class="control-label" for="active">Trạng thái <span class="required">*</span></label>
								<div class="controls">
	            <?php
	            	echo TochucHelper::selectBox($this->row->active, array('name'=>'active'), 'ins_status', array('id','name')); 
	            ?>
	            				</div>
							</div>
							<div class="control-group trangthai">
								<label class="control-label" for="trangthaicoquan_banhanh_id">Cơ quan ban hành Quyết định <span class="required">*</span></label>
								<div class="controls">
								<input type="hidden" name="trangthai[id]"  value="<?php echo $this->trangthai['id'];?>">
								<?php
								echo JHTML::_('select.genericlist',$this->arr_ins_created,'trangthai[coquan_banhanh_id]', array('class'=>'chzn-select','data-placeholder'=>"Hãy chọn..."),'value','text',$this->trangthai['coquan_banhanh_id']);
								?>								
								  <a data-target="#trangthai-coquan_banhanh_detail" role="button" class="btn btn-mini" data-toggle="collapse"> ... </a>
									<div id="trangthai-coquan_banhanh_detail" class="collapse">
									    <div id="thanhlap-trangthai-coquan_banhanh" class="tree"></div>
									</div>								
								</div>							
								</div>
							</div>
							<div class="control-group trangthai">
								<label class="control-label" for="trangthai_ngaybanhanh">Ngày Quyết định <span class="required">*</span></label>
								<div class="controls">
									<div class="input-append">
									<input type="text" class="input-mask-date input-small" id="trangthai_ngaybanhanh" name="trangthai[ngaybanhanh]" value="<?php echo $this->trangthai['ngaybanhanh'];?>">
									<span class="add-on">
										<i class="icon-calendar"></i>
									</span>
									</div>
								</div>
							</div>	
							<div class="control-group trangthai">
								<label class="control-label" for="trangthaimahieu">Số Quyết định <span class="required">*</span></label>
								<div class="controls">
								<input type="hidden" name="trangthai[id]"  value="<?php echo $this->trangthai['id'];?>">
									<input type="text" id="trangthaimahieu" name="trangthai[mahieu]"  value="<?php echo $this->trangthai['mahieu'];?>"><span class="btn btn-success fileinput-button">
								    <ul class="files unstyled spaced">
									<?php for($i = 0, $n = count($this->file_trangthai); $i < $n; $i++){?>
										<li id="li_<?php echo $this->file_trangthai[$i]['code'] ?>">
											<span class="btn btn-minier btn-danger btn_remove_soqd" data-code="<?php echo $this->file_trangthai[$i]['code'] ?>">
												<i class="icon-trash"></i>
											</span>
											<a href="<?php echo JUri::root(true)?>/index.php?option=com_core&controller=attachment&task=download&code=<?php echo $this->file_trangthai[$i]['code'] ?>" 
												target="_blank"><?php echo $this->file_trangthai[$i]['filename'] ?></a>
										</li>
									<?php } ?>
									</ul>
								<?php echo Core::inputAttachment('trangthai-attachment', 0, 1, '2015', -1);?>														
								</div>
							</div>										
						<div class="control-group span6">
								<label class="control-label" for="ghichu">Ghi chú</label>
								<div class="controls">
									<textarea rows="5" cols="30" name="ghichu"><?php echo $this->row->ghichu;?></textarea>
								</div>
							</div>	
					</div>					
				</fieldset>
				<div style="height: 250px"></div>	
			</div>
			<div id="COM_TOCHUC_THANHLAP_TAB2" class="tab-pane">
			<fieldset class="input-tochuc">
			<legend>Thông tin thêm</legend>
				<div class="row-fluid">
					<div class="span4">							
								<div class="row-fluid">	
								<label>Lĩnh vực</label>
								<?php
									$inArray = Core::loadAssocList('cb_type_linhvuc', array('id AS value','name AS text','level'),array('type='=>1),'lft');
									//var_dump($inArray);
									echo TochucHelper::createChk('ins_linhvuc[]', $inArray,$this->linhvuc); 
								?>	
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
<input type="hidden" name="is_valid_name" id="is_valid_name" value="">
<?php echo JHTML::_( 'form.token' ); ?> 	
</form>
<script type="text/javascript">
jQuery(document).ready(function($){
	// xu ly loai hinh
	//fun khi change cbx ins loai hinh
	//jQuery('.required label').append('aaa');
    var toggleInputTrangthai = function(val){
    	if(val == 1){			
			$(".trangthai").hide();
		}		
    	else{
			$(".trangthai").show();
    	}		
	};
// 	$('#TYPE').change(function(){
// 		toggleInputTochuc(this);
// 	});
	$('#active').change(function(){
		toggleInputTrangthai(this.value);
	});
	var initPage = function(){
		$('.chzn-select').chosen({allow_single_deselect: true,search_contains: true,width:"220px"});
		$('.input-mask-date').mask('99/99/9999');
		$('#type_created').val('<?php echo $this->row->type_created;?>');
		//$('#type_created').val('2');		
		//toggleInputTochuc($('#TYPE'));
		toggleInputTrangthai($('#active').val());
// 		$('#frmThanhLap').unbind('submit');
		$('#btnThanhlapSubmitAndClose').unbind('click');
		$('#btnThanhlapSubmitAndNew').unbind('click');

	};
	initPage();	
		
		var tree_data_ins_dept = <?php echo $this->tree_data_ins_dept; ?>;	
		var treeDataDept = new DataSourceTree({data: tree_data_ins_dept});
		$('#thanhlap-tochuc-ins_created').ace_tree({
			dataSource: treeDataDept,
			multiSelect:false,
			loadingHTML:'<div class="tree-loading"><i class="icon-refresh icon-spin blue"></i></div>',
			'open-icon' : 'icon-minus',
			'close-icon' : 'icon-plus',
			'selectable' : true,
			'selected-icon' : 'icon-ok',
			'unselected-icon' : 'icon-remove'
		});
		$('#thanhlap-tochuc-ins_created').on('selected', function (evt, data) {			
			if(typeof data.info[0] != "undefined"){
				 //$('#ins_created_name').val(data.info[0].name);
				 $('#ins_created').val(data.info[0].id);
				 $("#ins_created").trigger("chosen:updated");
			}
		});
		$('#thanhlap-tochuc-ins_created').on('unselected', function (evt, data) {
			//$('#ins_created_name').val('');
			$('#ins_created').val('');
			$("#ins_created").trigger("chosen:updated");
		});
		$('#thanhlap-tochuc-coquan_banhanh').ace_tree({
			dataSource: treeDataDept,
			multiSelect:false,
			loadingHTML:'<div class="tree-loading"><i class="icon-refresh icon-spin blue"></i></div>',
			'open-icon' : 'icon-minus',
			'close-icon' : 'icon-plus',
			'selectable' : true,
			'selected-icon' : 'icon-ok',
			'unselected-icon' : 'icon-remove'
		});
		$('#thanhlap-tochuc-coquan_banhanh').on('selected', function (evt, data) {			
			if(typeof data.info[0] != "undefined"){
				 $('#vanban_createdcoquan_banhanh_id').val(data.info[0].id);
				 $("#vanban_createdcoquan_banhanh_id").trigger("chosen:updated");				
			}
		});
		$('#thanhlap-tochuc-coquan_banhanh').on('unselected', function (evt, data) {
			$('#vanban_createdcoquan_banhanh_id').val('');
			$("#vanban_createdcoquan_banhanh_id").trigger("chosen:updated");			
		});
		$('#thanhlap-trangthai-coquan_banhanh').ace_tree({
			dataSource: treeDataDept,
			multiSelect:false,
			loadingHTML:'<div class="tree-loading"><i class="icon-refresh icon-spin blue"></i></div>',
			'open-icon' : 'icon-minus',
			'close-icon' : 'icon-plus',
			'selectable' : true,
			'selected-icon' : 'icon-ok',
			'unselected-icon' : 'icon-remove'
		});
		$('#thanhlap-trangthai-coquan_banhanh').on('selected', function (evt, data) {			
			if(typeof data.info[0] != "undefined"){
				 $('#trangthaicoquan_banhanh_id').val(data.info[0].id);
				 $("#trangthaicoquan_banhanh_id").trigger("chosen:updated");
			}
		});
		$('#thanhlap-trangthai-coquan_banhanh').on('unselected', function (evt, data) {			
			$('#trangthaicoquan_banhanh_id').val('');
			$("#trangthaicoquan_banhanh_id").trigger("chosen:updated");
		});
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
			var isTochuc = $("#active").val() !== "1";
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
			      },
			      "type_created": {	    
					  required: true
			      },			        
				  "ins_created": {	    
					  required: true
			      },		
			      "trangthai[coquan_banhanh_id]": {	    
					  required2: true
			      },
			      "trangthai[ngaybanhanh]": {	    
					  required2: true
			      },
			      "trangthai[mahieu]": {	    
					  required2: true
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
		$.validator.addMethod('validNamePhong', function(value, element){
			if($('#is_valid_name').val() == '0'){
				return false;
			}else{
				return true;
			}
		}, 'Tên phòng bạn nhập đã có trong nhánh cây đơn vị.');
		$('.btn_remove_soqd').on('click', function(){
			if(!confirm('Bạn có chắc chắn xóa tập tin này?')){
				return false;
			}else{
				var idFile = $(this).data('code');
				$.ajax({
		            type: "POST",
		            url: "<?php echo JUri::root(true)?>/index.php?option=com_tochuc&controller=tochuc&task=deletefilevanban",			  
		            data:{idFile:idFile},
		            beforeSend: function(){
		            	$.blockUI();	
		            },
		            success: function (data){
		                if(data == '1'){
		                	loadNoticeBoardSuccess('Thông báo','Xử lý thành công.');
		                	$('#li_'+idFile).remove();
		                }else{
		                	loadNoticeBoardError('Thông báo','Xử lý không thành công. Vui lòng liên hệ quản trị viên!');
		                }
		            	$.unblockUI();
		            }
				});
			}
		});

}); // end document.ready
</script>