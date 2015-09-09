<?php
//var_dump($this->row->id);
//JHtml::_('formbehavior.chosen', 'select');
?>
<form class="form-horizontal" action="index.php?option=com_tochuc&controller=luong&task=saveedit" method="post" name="frmTochucCap" id="frmTochucCap">
<fieldset>
<legend>Thông tin chi tiết [<small><?php echo (($this->row->ID == 0)?'Thêm mới':'Hiệu chỉnh');?></small>]</legend>
  	<div class="control-group">
		<label class="control-label" for="ID">ID</label>
		<div class="controls">
			<input type="text" id="ID" name="ID" value="<?php echo $this->row->ID;?>" readonly>
		</div>
	</div>
  <div class="control-group">
    <label class="control-label" for="PARENTID">Cấp cha</label>
    <div class="controls">
    	<input type="hidden" id="PARENTID" name="PARENTID" value="<?php echo (int)$this->row->PARENTID;?>">
     <?php echo AdminTochucHelper::getNameById($this->row->PARENTID, 'cb_goiluong','NAME','ID'); ?>     
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="NAME">Tên</label>
    <div class="controls">
      <input type="text" id="NAME" placeholder="Nhập tên cấp" name="NAME" value="<?php echo $this->row->NAME;?>">
    </div>
  </div>  
  <div class="control-group">
    <div class="controls">
        <label class="checkbox">
	        <input type="hidden" value="0" name="STATUS">
        	<input type="checkbox" value="1" name="STATUS" <?php echo (($this->row->STATUS == 1)?'checked = "checked"':'');?>> Trạng thái
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