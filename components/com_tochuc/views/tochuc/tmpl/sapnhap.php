<?php
?>
<form class="form-horizontal row-fluid" name="frmSapnhap"
	id="frmSapnhap" method="post"
	action="<?php echo JRoute::_('index.php?option=com_tochuc&controller=tochuc&task=savesapnhap')?>">
	<h3 class="row-fluid header smaller lighter blue">
		<span class="span7">Tổ chức <small> <i class="icon-double-angle-right">
			</i> Sáp nhập 2 tổ chức
		</small></span> <span class="span5"> <span class="pull-right inline">
				<button id="btnSapnhapSubmit" type="button"
					class="btn btn-small btn-success">
					<i class="icon-save"></i> Lưu
				</button> <a class="btn btn-small btn-info"
				href="<?php echo JRoute::_('index.php?option=com_tochuc&layout=default&Itemid='.$this->Itemid); ?>">←
					Quay về</a>
		</span>
		</span>
	</h3>
	<fieldset>
		<legend>Thông tin sáp nhập 2 tổ chức</legend>
		<div class="row-fluid">
			<div class="span4">
				<div class="row-fluid">
					<label>Tổ chức chính<span class="required">*</span></label> <input
						type="hidden" value="" name="dept_chinh_id" id="dept_chinh_id">
					<div id="sapnhap-tree-tochuc"></div>
				</div>
				<div class="row-fluid">
					<label for="name">Tổ chức phụ<span class="required">*</span></label>
					<input type="hidden" value="" name="dept_phu_id" id="dept_phu_id">
					<div id="sapnhap-tree-tochuc2"></div>
				</div>
			</div>
			<div class="span8">
				<div class="control-group">
					<label class="control-label">Tên tổ chức chính <span class="required">*</span></label>
					<div class="controls">
						<input type="hidden" name="hasChangeName" value="0">
						<label><input type="checkbox" name="hasChangeName" id="hasChangeName" value="1"> <span class="lbl"> Đổi tên tổ chức chính</span></label>						 
						<input type="text" name="name_chinh" id="name_chinh" value="" readonly>						
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="name_phu">Tên tổ chức phụ <span class="required">*</span></label>
					<div class="controls">
						<input type="text" value="" name="name_phu" id="name_phu" readonly>
					</div>
				</div>				
				<div class="control-group">
					<label class="control-label" for="quyetdinh_so">Số QĐ <span class="required">*</span></label>
					<div class="controls">
						<input type="text" value="" name="quyetdinh_so" id="quyetdinh_so">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="quyetdinh_ngay">Ngày QĐ <span class="required">*</span></label>
					<div class="controls">
						<input type="text" value="" class="input-mask-date" id="quyetdinh_ngay" name="quyetdinh_ngay">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="ngay_hieuluc">Hiệu lực ngày <span class="required">*</span></label>
					<div class="controls">
						<input type="text" value="" class="input-mask-date" id="hieuluc_ngay" name="hieuluc_ngay">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="chitiet">Chi tiết</label>
					<div class="controls">
					<?php
					$editor = &JFactory::getEditor();								
					echo $editor->display("chitiet", '', "400", "100", "150", "10", 1, null, null, null, array('mode' => 'simple'));
					?>
					</div>
				</div>
			</div>
		</div>
	</fieldset>
</form>
<script type="text/javascript">
jQuery(document).ready(function($){
	$.validator.setDefaults({ ignore: '' });

	$('#frmSapnhap').validate({
		  rules: {
			  name_chinh:{
				  required: true 
			  },
			  name_phu:{
				  required: true 
			  },
			  dept_chinh_id:{
				  required: true, 
			  },
			  dept_phu_id:{
				  required: true, 
			  },
			  hieuluc_ngay: {	    
				  required: true,
				  dateVN:true
		      },
		      quyetdinh_ngay: {
		    	  required: true,
		    	  dateVN:true
		      },
		      quyetdinh_so: {		    	  
				  required: true
		      }	  
		  }
	});
	 $('#btnSapnhapSubmit').click(function(){
		  var flag = $('#frmSapnhap').valid();
		  if(flag == true){
			  document.frmSapnhap.submit();
		  }
		  //console.log(flag);
		  return false;
	 });
    var toggleChangeName = function(checked){
        //console.log(checked);
      	if(checked == true){
      		$('#name_chinh').removeAttr('readonly');
        }else{	
        	$('#name_chinh').attr('readonly','true');
        }
	};
	var initPage = function(){
		$('.chzn-select').chosen({allow_single_deselect: true});
		$('.input-mask-date').mask('99/99/9999');
		$('#hasChangeName').click(function(){
			toggleChangeName($('#hasChangeName:checked').length);				
		});
		toggleChangeName($('#hasChangeName:checked').length);
	};
	initPage();
	 //form validate
var jstreeTochuc = $('#sapnhap-tree-tochuc').jstree({
						 "plugins": ["themes", "json_data", "ui","types"], 
				  		"json_data":{
								"ajax" : {
									// the URL to fetch the data
									"url" : "api.php?task=tree&act=TOCHUC",	
									"data" : function(n) {
										return {
											"id" : n.attr ? n.attr("id").replace("node_", "") : 0
										};
									}
								}
							},
						"types" : {
							"valid_children" : [ "root" ],
							"types" : {
								"file" : {
									"icon" : { 
										"image" : "<?php echo JUri::root(true);?>/media/cbcc/js/jstree/file.png" 
									}            					
								},
								"folder" : {
									"icon" : { 
										"image" : "<?php echo JUri::root(true);?>/media/cbcc/js/jstree/folder.png" 
									}            					
								},
								"default" : {
									"valid_children" : [ "default" ]
								}
							}
						}
					 }).bind("select_node.jstree", function (event, data) {	    
							// data.inst.select_node("#node_11", true);
							 var id = data.rslt.obj.attr("id").replace("node_","");
							 $('#dept_chinh_id').val(id);
							 $('#name_chinh').val(jQuery.trim(data.rslt.obj.text()));							 
							 
							// $('#INS_CAP').val(id);
							 //console.log(data.rslt.obj.attr("id").replace("node_",""));			 
					});
var jstreeTochuc2 = $('#sapnhap-tree-tochuc2').jstree({
	 "plugins": ["themes", "json_data", "ui","types"], 
		"json_data":{
			"ajax" : {
				// the URL to fetch the data
				"url" : "api.php?task=tree&act=TOCHUC",	
				"data" : function(n) {
					return {
						"id" : n.attr ? n.attr("id").replace("node_", "") : 0
					};
				}
			}
		},
   		"types" : {
			"valid_children" : [ "root" ],
			"types" : {
				"file" : {
					"icon" : { 
						"image" : "<?php echo JUri::root(true);?>/media/cbcc/js/jstree/file.png" 
					}            					
				},
				"folder" : {
					"icon" : { 
						"image" : "<?php echo JUri::root(true);?>/media/cbcc/js/jstree/folder.png" 
					}            					
				},
				"default" : {
					"valid_children" : [ "default" ]
				}
			}
		}
		}).bind("select_node.jstree", function (event, data) {	    
				// data.inst.select_node("#node_11", true);
				 var id = data.rslt.obj.attr("id").replace("node_","");
				 $('#dept_phu_id').val(id);
				 $('#name_phu').val(jQuery.trim(data.rslt.obj.text()));
				 //console.log(jQuery.trim(data.rslt.obj.text()));
				// $('#INS_CAP').val(id);
				 //console.log(data.rslt.obj.attr("id").replace("node_",""));			 
		});
}); // end document.ready
</script>