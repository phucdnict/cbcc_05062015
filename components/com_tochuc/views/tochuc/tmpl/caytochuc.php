<?php
defined('_JEXEC') or die('Restricted access');
?>
<div class="row-fluid">
<div class="widget-container-span">
	<div class="widget-box span4">
		<div class="widget-header">
			<h4 class="lighter smaller"><?php echo $this->nodeRoot['name'];?></h4>
			<div class="widget-toolbar">
				<a class="btn btn-mini btn-info" id="btn-themmoi"><i class="icon-plus"></i> Thêm mới</a>
				<a href="#myModalSaochep" role="button" class="btn btn-mini btn-success" data-toggle="modal">
					<i class="icon-copy"></i> Sao chép
				</a>
			</div>
		</div>
		<div class="widget-body">
			<div class="widget-main padding-8">
				<div id="tochucCaydonvi"></div>
			</div>
		</div>
	</div>
	<div class="widget-box span8">
		<div class="widget-header">
			<h4 class="lighter smaller">Thông tin cây tổ chức</h4>
		</div>
		<div class="widget-body">
			<div class="widget-main padding-8">
				<div id="formCaydonvi"></div>
			</div>
		</div>
	</div>
</div>
</div>
<!-- Modal chọn đơn vị cha -->
<div id="myModalCaydonvi" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabelCaydonvi" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabelCaydonvi">Chọn đơn vị cha</h3>
	</div>
	<div class="modal-body">
		<div id="editCaydonvi"></div>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Đóng</button>
		<button class="btn btn-primary" id="selectEditCaydonvi" data-dismiss="modal" aria-hidden="true">Chọn</button>
	</div>
</div>
<!-- Modal chọn tổ chức sao chép -->
<div id="myModalSaochep" class="modal hide fade" tabindex="-2" role="dialog" aria-labelledby="myModalLabelSaochep" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabelSaochep">Chọn tổ chức sao chép</h3>
	</div>
	<div class="modal-body" style="height:300px;">
	<form class="form-horizontal" id="frmSaochep" method="post">
		<div class="control-group">
			<label class="control-label required" for="tochuc_saochep">Tổ chức</label>
			<div class="controls">
				<select name="tochuc_saochep" class="chzn-select" id="tochuc_saochep" data-placeholder="Chọn tổ chức">
					<option value=""></option>
					<?php echo JHtml::_('select.options',$this->cboTochuc,'id','name',''); ?>
				</select>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label required" for="tochuc_cha">Thuộc cây tổ chức</label>
			<div class="controls">
				<select name="tochuc_cha" class="chzn-select" id="tochuc_cha" data-placeholder="Chọn cây tổ chức">
					<option value=""></option>
					<?php echo JHtml::_('select.options',$this->cboCaytochuc,'id','name',''); ?>
				</select>
				<!-- input type="hidden" id="tochuc_cha" name="tochuc_cha" value="0" /-->
			</div>
		</div>
	</form>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Đóng</button>
		<button class="btn btn-primary" id="selectTochucSaochep" data-dismiss="modal" aria-hidden="true">Chọn</button>
	</div>
</div>
<script type="text/javascript">
jQuery(document).ready(function($){
	var root_id = <?php echo $this->nodeRoot['id']; ?>;
	var idTreeSelected = null;
	$("#tochucCaydonvi").jstree({
		"plugins" : [
			"themes","json_data","ui","dnd","cookies"
		],
		"json_data" : {
			"ajax" : {
				"url" : Core.rootUrl + "/index.php",
				"data" : function (n) {
					return {
						"option" : "com_tochuc",
						"controller" : "tochuc",
						"view" : "tochuc",
						"task" : "getChildren",
						"format" : "raw",
						"id" : n.attr ? n.attr("id").replace("node_","") : root_id
					};
				}
			}
		},
		"dnd" : {
			"drop_finish" : function () {
				alert("DROP"); 
			},
			"drag_check" : function (data) {
				/*
				if(data.r.attr("id") == "phtml_1") {
					return false;
				}
				*/
				return { 
					after : false, 
					before : false, 
					inside : true 
				};
			},
			"drag_finish" : function (data) { 
				alert("DRAG OK"); 
			}
		}
	}).bind("select_node.jstree", function (event, data) {
		var nodeId = data.rslt.obj.attr("id");
		var id = nodeId.replace("node_","");
		idTreeSelected = id;
		$('#tochuc_cha').val(id);
		$('#formCaydonvi').load(Core.rootUrl + '/index.php?option=com_tochuc&task=edit_caytochuc&format=raw&id='+id);
	}).bind("move_node.jstree", function (e, data) {
		data.rslt.o.each(function (i) {
		/*
		formData = {					
			"id" : $(this).attr("id").replace("node_",""), 
			"ref" : data.rslt.cr === -1 ? 1 : data.rslt.np.attr("id").replace("node_",""), 
			"position" : data.rslt.cp + i,
			"title" : data.rslt.name,
			"copy" : data.rslt.cy ? 1 : 0
		};
		console.log(formData);
		*/
		$.ajax({
			async : false,
			type: 'POST',
			url: Core.rootUrl + "/index.php",
			data : {
				"option" : "com_tochuc",
				"controller" : "tochuc",
				"view" : "tochuc",
				"task" : "moveNodeCaytochuc",
				"format" : "raw",
				"id" : $(this).attr("id").replace("node_",""), 
				"ref" : data.rslt.cr === -1 ? 1 : data.rslt.np.attr("id").replace("node_",""), 
				"position" : data.rslt.cp + i,
				"title" : data.rslt.name,
				"copy" : data.rslt.cy ? 1 : 0
			},
			success : function (r) {				
				if(r.errCode != 0 || typeof r.errCode == 'undefined') {
					$.jstree.rollback(data.rlbk);
					console.log('rollback');
				}else{
					$(data.rslt.oc).attr("id", "node_" + r.id);
					if(data.rslt.cy && $(data.rslt.oc).children("UL").length) {
						data.inst.refresh(data.inst._get_parent(data.rslt.oc));
					}
				}						
				//$("#tochucCaydonvi").jstree("refresh");
				//deselect_all 
				$("#tochucCaydonvi").jstree("deselect_all");
				$('#formCaydonvi').empty();
				//$("#tochucCaydonvi").trigger("select_node.jstree");
				//$("#analyze").click();
				}
			});
		});
	});
    
	var saveSelected = function(){
		var el = $('input[name="form-field-radio"]:checked');
		//console.log(code);
		$('#name_tochuc_hoso').val(el.data('text'));
		$('#code_tochuc_hoso').val(el.val());
		$('#myModal').modal('toggle');
	};
	var saveTochuc = function(){
		//var formData = $('#frmTochuc').serialize();
		//console.log($('#frmTochuc').serialize());
		$.post(Core.rootUrl + '/index.php?option=com_tochuc&task=savecaytochuc',$('#frmTochuc').serialize(),function(response){
			if(response.errCode == 0){
				//console.log(response.errCode);
				//$("#tochucCaydonvi").jstree("refresh");
				//$.jstree._reference($("#tochucCaydonvi")).refresh(-1);
				//console.log('aa');
				$("#tochucCaydonvi").trigger("loaded.jstree");
			}
		});
	};
    $('#btn-themmoi').click(function(){
		//console.log('Them moi');
		//$('#tochucCaydonvi').jstree('get_selected').attr('id');
		var nodeId = $('#tochucCaydonvi').jstree('get_selected').attr('id');
		var selected = null;
		var xUrl =  Core.rootUrl + '/index.php?option=com_tochuc&task=edit_caytochuc&format=raw&t=' + new Date().getTime();
		if(typeof nodeId != 'undefined'){
			selected = nodeId.replace("node_","");
			xUrl += '&selected='+selected;
		}	   	
		$('#formCaydonvi').load(xUrl);
	});
	$('#selectTochucSaochep').click(function(){
		
		var nodeId = $('#tochucCaydonvi').jstree('get_selected').attr('id');
		if(typeof nodeId != 'undefined'){
			$('#tochuc_cha').val(nodeId.replace("node_",""));
			//alert($('#tochuc_cha').val());
		}
		$.post(Core.rootUrl + '/index.php?option=com_tochuc&task=copycaytochuc',$('#frmSaochep').serialize(),function(response){
			if(response.errCode == 0){
				$("#tochucCaydonvi").jstree("refresh");
			}
		});
	});
	$("#editCaydonvi").jstree({
		"plugins" : [
			"themes","json_data","ui"
		],
		"json_data" : {
			"ajax" : {
				"url" : Core.rootUrl + "/index.php",
				"data" : function (n) {
					return {
						"option" : "com_tochuc",
						"controller" : "tochuc",
						"view" : "tochuc",
						"task" : "getChildren",
						"format" : "raw",
						"id" : n.attr ? n.attr("id").replace("node_","") : 1
					};
				}
			}
		}
	});
	var _initPage = function(){
		$(".chzn-select").chosen({allow_single_deselect: true });
		$('#frmSaochep').find('.chzn-container').each(function(){
			$('#frmSaochep').find('a:first-child').css('width' , '210px');
			$('#frmSaochep').find('.chzn-drop').css('width' , '220px');
			$('#frmSaochep').find('.chzn-search input').css('width' , '210px');
		});
	};
	_initPage();
});    
</script>