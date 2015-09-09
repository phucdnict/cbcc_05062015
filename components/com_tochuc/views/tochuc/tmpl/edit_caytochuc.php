<fieldset>
<legend><?php echo ($this->isNew == true)?'Thêm mới':'Hiệu chỉnh'; ?> cây tổ chức</legend>
<form class="form-horizontal" id="frmTochuc" method="post">
<input name="id" type="hidden" value="<?php echo $this->row['id']; ?>" >
	<div class="control-group">
		<label class="control-label required" for="name">Tên</label>
		<div class="controls">
			<input type="text" value="<?php echo $this->row['name']; ?>" name="name" id="name" minlength="3" maxlength="200" required="true">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label required" for="code">Mã</label>
		<div class="controls">
			<input type="text" value="<?php echo $this->row['code']; ?>" name="code" id="code" maxlength="20">
		</div>
	</div>        
	<div class="control-group">
		<label class="control-label required" for="name_parent">Đơn vị cha</label>
		<div class="controls">
			<div class="input-append">
				<input name="name_parent" id="name_parent" type="text" value="<?php echo $this->row['name_parent']; ?>" >
				<input name="id_parent" id="id_parent" type="hidden" value="<?php echo $this->row['id_parent']; ?>" >				 
				<a href="#myModalCaydonvi" role="button" class="btn" data-toggle="modal">Chọn</a>
			</div>               
		</div>
	</div>
	<div class="control-group">
		<label class="control-label required" for="code_tochuc_hoso">Tổ chức</label>
		<div class="controls">
			<select name="code_tochuc_hoso" class="chzn-select" id="code_tochuc_hoso" data-placeholder="Chọn tổ chức">
				<option value=""></option>
				<?php echo JHtml::_('select.options',$this->cboTochuc,'id','name',$this->row['code_tochuc_hoso']); ?>
			</select>
		</div>
	</div>
	<div class="control-group"><label class="control-label required" for="status">Trạng thái</label>
		<div class="controls">
			<input name="status" type="hidden" value="0" >
			<input name="status" id="status" type="checkbox" value="1" <?php echo ((int)$this->row['status'] == 1)?"checked='true'":""; ?>>
			<span class="lbl"></span>
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			<button class="btn btn-small btn-primary" type="button" id="saveTochuc"><i class="icon-save"></i> Lưu</button>
			<button class="btn btn-small btn-danger" type="button" id="removeTochuc"><i class="icon-trash"></i> Xóa</button>
		</div>
	</div>    
</form>
</fieldset>
<script type="text/javascript">
jQuery(document).ready(function($){
	$('#selectEditCaydonvi').click(function(){
		var nodeId = $('#editCaydonvi').jstree('get_selected').attr('id');
// 		console.log(nodeId);
		var selected = null;
		if(typeof nodeId != 'undefined'){
			selected = nodeId.replace("node_","");
			$('#frmTochuc #id_parent').val(selected);
			$('#frmTochuc #name_parent').val($.trim($('#editCaydonvi').jstree('get_selected').text()));        		
		}	
	});
	$('#saveTochuc').click(function(){
		$.post(Core.rootUrl + '/index.php?option=com_tochuc&task=savecaytochuc',$('#frmTochuc').serialize(),function(response){
			if(response.errCode == 0){
// 				console.log(response.errCode);
// 				$("#tochucCaydonvi").jstree("refresh");
// 				$.jstree._reference($("#tochucCaydonvi")).refresh(-1);
// 				console.log('aa');
				$("#tochucCaydonvi").jstree("refresh");
				$("#editCaydonvi").jstree("refresh");
			}
		});
	});
	$('#removeTochuc').click(function(){
		$.post(Core.rootUrl + '/index.php?option=com_tochuc&task=removecaytochuc',$('#frmTochuc').serialize(),function(response){
			if(response.errCode == 0){
				$("#tochucCaydonvi").jstree("refresh");
				$("#editCaydonvi").jstree("refresh");
			}
			window.location.reload(true);
		});
	});
	var _initPage = function(){
		$(".chzn-select").chosen({allow_single_deselect: true });
		$('#frmTochuc').find('.chzn-container').each(function(){
			$('#frmTochuc').find('a:first-child').css('width' , '210px');
			$('#frmTochuc').find('.chzn-drop').css('width' , '220px');
			$('#frmTochuc').find('.chzn-search input').css('width' , '210px');
		});
	};
	_initPage();
});
</script>