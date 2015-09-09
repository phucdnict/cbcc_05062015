<?php
//var_dump($this->row->id);
//JHtml::_('formbehavior.chosen', 'select');
?>
<form class="form-horizontal" action="index.php?option=com_tochuc&controller=biencheloaihinh&task=saveedit" method="post" name="frmGoibienche" id="frmGoibienche">
	<fieldset>
		<legend>
			Thông tin chi tiết [<small><?php echo (($this->row->id == 0)?'Thêm mới':'Hiệu chỉnh');?></small>]
				<span class="pull-right inline">
					<button type="submit" class="btn btn-primary btn-small"><i class="icon-save"></i> Lưu</button>		
				</span>	
		</legend>
		<div class="row-fluid">
			<div class="control-group">
				<label class="control-label" for="id">ID</label>
				<div class="controls">
					<input type="text" name="id" value="<?php echo $this->row->id;?>" readonly>
				</div>
			</div>
		</div>
		<div class="row-fluid">
		<div class="control-group">
			<label class="control-label" for="name">Tên</label>
			<div class="controls">
				<input type="text" id="name" placeholder="Nhập tên" name="name" value="<?php echo $this->row->name;?>">
			</div>
		</div>
		</div>
		<div class="row-fluid">
		<div class="control-group">
			<label class="control-label" for="s_name">Tên viết tắt</label>
			<div class="controls">
				<input type="text" id="s_name" placeholder="Nhập tên viết tắt" name="s_name" value="<?php echo $this->row->s_name;?>">
			</div>
		</div>
		</div>		
		<div class="row-fluid">		
		<div class="control-group">
			<div class="controls">
				<label class="checkbox"> <input type="hidden" value="0"	name="status"> 
				<input type="checkbox" value="1" name="status" <?php echo (($this->row->status == 1)?'checked = "checked"':'');?>>
					Trạng thái
				</label>				
			</div>
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
	$('#frmGoibienche').validate({
	    rules: {
	      name: {
	   		required: true	        
	      }	     
	    }
	});
});
</script>