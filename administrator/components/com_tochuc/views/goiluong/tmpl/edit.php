<?php
//var_dump($this->row->id);
//JHtml::_('formbehavior.chosen', 'select');
?>
<form class="form-horizontal" action="index.php?option=com_tochuc&controller=goiluong&task=saveedit" method="post" name="frmTochucCap" id="frmTochucCap">
<fieldset>
<legend>Thông tin chi tiết [<small><?php echo (($this->row->id == 0)?'Thêm mới':'Hiệu chỉnh');?></small>]
		<span class="pull-right inline">
			<button type="submit" class="btn btn-primary btn-small"><i class="icon-save"></i> Lưu</button>
			<?php
			if((int)$this->row->id > 0){
				?>
				<button id="btnXoa" class="btn btn-danger btn-small " data-goiluong-id="<?php echo $this->row->id;?>"><i class="icon-trash"></i> Xóa</button>
				<?php			
				} 
			?>			
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
    	<input type="hidden" id="parent_id" name="parent_id" value="<?php echo (int)$this->row->parent_id;?>">
     <?php echo AdminTochucHelper::getNameById($this->row->parent_id, 'cb_goiluong','name','id'); ?>     
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
    <div class="control-group">
	    <div class="controls">
			    <div class="accordion" id="accordion2">
	    	<?php
	    	if (count($this->ngachs) > 0 ) {
	    		foreach ($this->ngachs as $key => $value) {
	    			?>
	    			<div class="accordion-group">
	    			 <div class="accordion-heading">
    			 	 
				      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse_<?php echo $value['id'];?>">				      
				        <?php echo $value['name'];?>
				      </a>
				    </div>
				    <div id="collapse_<?php echo $value['id'];?>" class="accordion-body collapse">
					      <div class="accordion-inner">
					      	<label>
					      		<input type="checkbox" name="nhom_ngach[]" class="checkAllNgach" id="chk_<?php echo $value['id'];?>" value="<?php echo $value['id'];?>" > <?php echo $value['name'];?>
					      	</label>
					      	
	    			<?php 
	    			if (count($this->bacs[$key]) > 0 ) {
						//var_dump($v);
						foreach ($this->bacs[$key] as $v) {
						//var_dump($v);
	    				?>	    			
						<label style="padding-left:20px;">
	    					<input type="checkbox" class="chk_<?php echo $value['id'];?>"  name="ngach[]" id="ngach_'<?php echo $v['mangach'];?>" value="<?php echo $v['mangach'];?>" <?php echo (($v['checked'] != null)?'checked="checked"':'');?>> <?php echo $v['name'];?>
	    				</label>
	    				<?php
	    				} 
	    			}
	    			?>
	    			      </div>
					    </div>	    			
	    			</div>
	    			<?php 
	    		}
	    	} 
	    	?>
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
	$('.checkAllNgach').click(function(){
		$('.chk_'+this.value).attr('checked',this.checked);
	});
	$('#btnXoa').click(function(){
		var node_id = $(this).attr('data-goiluong-id');	
		if(typeof node_id == 'undefined'){
			alert('Bạn chưa chọn dữ liệu đễ xóa');
		}else{
			node_id = node_id.replace("node_", "");
			if(confirm('Bạn có muốn xóa '+ $('#tochuc-goiluong-tree').jstree('get_selected').text()+' ?')){
				window.location.href='index.php?option=com_tochuc&controller=goiluong&task=delete&id='+node_id;
			}
		}
		
	});
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