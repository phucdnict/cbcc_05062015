<?php
//var_dump($this->row->id);
//JHtml::_('formbehavior.chosen', 'select');
?>
<form class="form-horizontal" action="index.php?option=com_tochuc&controller=loaihinh&task=saveedit" method="post" name="frmTochucLoaihinh" id="frmTochucLoaihinh">
<fieldset>
<legend>
Thông tin chi tiết [<small><?php echo (($this->row->id == 0)?'Thêm mới':'Hiệu chỉnh');?></small>]
		<span class="pull-right inline">
			<button type="submit" class="btn btn-primary btn-small"><i class="icon-save"></i> Lưu</button>
			<?php
			if((int)$this->row->id > 0){
				?>
				<button type="button" id="btnXoa" data-loaihinh-id="<?php echo $this->row->id; ?>" class="btn btn-danger btn-small"><i class="icon-trash"></i> Xóa</button>
				<?php			
				} 
			?>
			
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
     <?php echo AdminTochucHelper::getNameById($this->row->parent_id, 'ins_dept_loaihinh'); ?>     
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="name">Tên</label>
    <div class="controls">
      <input type="text" id="name" placeholder="Nhập tên cấp" name="name" value="<?php echo $this->row->name;?>">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="code">Mã</label>
    <div class="controls">
      <input type="text" id="code" placeholder="Nhập mã" name="code" value="<?php echo $this->row->code;?>">
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
	$('#frmTochucLoaihinh').validate({
	    rules: {
	      name: {
	   		required: true	        
	      },
	      parent_id: {	        
	        required: true
	      }
	    }
	});
	$('#btnXoa').click(function(){
		var id = $(this).attr('data-loaihinh-id');		
		if(typeof id == 'undefined'){
			alert('Bạn chưa chọn dữ liệu đễ xóa');
		}else{			
			if(confirm('Bạn có muốn xóa không ?')){
				window.location.href='index.php?option=com_tochuc&controller=loaihinh&task=delete&id='+id;
			}
		}
		
	});
});
</script>