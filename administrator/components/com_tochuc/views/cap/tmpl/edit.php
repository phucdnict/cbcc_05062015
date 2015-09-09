<?php
//var_dump($this->row->id);
//JHtml::_('formbehavior.chosen', 'select');
?>
<form class="form-horizontal row-fluid" action="index.php?option=com_tochuc&controller=cap&task=saveedit" method="post" name="frmTochucCap" id="frmTochucCap">
<fieldset class="row-fluid">
	<legend>
			Thông tin chi tiết [<small><?php echo (($this->row->id == 0)?'Thêm mới':'Hiệu chỉnh');?></small>]
				<span class="pull-right inline">
					<button id="btnXoa" class="btn btn-danger"><i class="icon-trash"></i> Xóa</button>					
				</span>	
		</legend>
  	<div class="control-group">
		<label class="control-label" for="id">ID</label>
		<div class="controls">
			<input type="text" id="di" name="id" value="<?php echo $this->row->id;?>" readonly>
		</div>
	</div>
  <div class="control-group">
    <label class="control-label" for="parent_id">Cấp cha</label>
    <div class="controls">
    	<input type="hidden" id="parent_id" name="parent_id" value="<?php echo $this->row->parent_id;?>">
     <?php echo AdminTochucHelper::getNameById($this->row->parent_id, 'ins_cap'); ?>     
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="name">Tên</label>
    <div class="controls">
      <input type="text" id="name" placeholder="Nhập tên cấp" name="name" value="<?php echo $this->row->name;?>">
    </div>
  </div>  
  <div class="control-group">
    <div class="controls">
        <label class="checkbox">
	        <input type="hidden" value="0" name="status">
        	<input type="checkbox" value="1" name="status" <?php echo (($this->row->status == 1)?'checked = "checked"':'');?>> Trạng thái
      	</label>
      <input type="submit" class="btn" value="Lưu" name="btnSubmit">
    </div>
  </div>
</fieldset>
<?php echo JHTML::_( 'form.token' ); ?> 
</form>
<script type="text/javascript">
jQuery(document).ready(function ($){
// 	jQuery('#parent_id').chosen({
// 		disable_search_threshold : 10,
// 		allow_single_deselect : true
// 	});
	$('#frmTochucCap').validate({
	    rules: {
	      name: {
	   		required: true	        
	      },
	      parent_id: {	        
	        required: true
	      }
	    }
	});
});
</script>