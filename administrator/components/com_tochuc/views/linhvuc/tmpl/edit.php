<?php
// var_dump($this->row);
// JHtml::_('formbehavior.chosen', 'select');
?>
<form class="form-horizontal row-fluid" action="index.php?option=com_tochuc&controller=linhvuc&task=saveedit" method="post" name="frmLinhVucAdd" id="frmLinhVucAdd">
<fieldset class="row-fluid">
	<legend>
			Thông tin chi tiết [<small><?php echo (($this->row->id == 0)?'Thêm mới':'Hiệu chỉnh');?></small>]
				<span class="pull-right inline">
					<button id="btnXoa" class="btn btn-danger"><i class="icon-trash"></i> Xóa</button>		
					<input type="submit" class="btn btn-success" value="Lưu" name="btnSubmit">			
				</span>	
		</legend>
  	<div class="control-group">
		<label class="control-label" for="id">ID</label>
		<div class="controls">
			<input type="text" id="id" name="id" value="<?php echo $this->row->id;?>" readonly>
		</div>
	</div>
  <div class="control-group">
    <label class="control-label" for="parent_id">Cấp cha</label>
    <div class="controls">
    	<input type="hidden" id="parent_id" name="parent_id" value="<?php echo $this->row->parent_id;?>">
     <?php echo AdminTochucHelper::getNameById($this->row->parent_id, 'cb_type_linhvuc'); ?>     
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="name">Tên</label>
    <div class="controls">
      <input type="text" id="name" placeholder="Nhập tên cấp" name="name" value="<?php echo $this->row->name;?>">
    </div>
  </div>  
  <div class="control-group">
   <label class="control-label" for="type">Loại</label>
    <div class="controls">
   	<?php $type =  (($this->row->id == 0)? AdminTochucHelper::getTypeById($this->row->parent_id, 'cb_type_linhvuc') : $this->row->type);
   	 echo JHTML::_('select.genericlist',array(array('value'=>'','text'=>''),array('value'=>'1','text'=>'Phòng'),array('value'=>'2','text'=>'Tổ chức')),'type', array(),'value','text',$type);?>
  
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
	$('#btnXoa').click(function(){
		var node_id = $('#frmLinhVucAdd input[name="id"]').val();
		//sconsole.log(node_id);
		if(confirm('Bạn có muốn xóa ?')){
			window.location.href='index.php?option=com_tochuc&controller=linhvuc&task=delete&id='+node_id;
		}		
		return false;
	});
	$('#frmLinhVucAdd').validate({
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