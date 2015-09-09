<?php
$user = JFactory::getUser();
?>
<div class="form-horizontal">
<input type="hidden" value="<?php echo $this->row->id; ?>" name="id" id="id">
<input type="hidden" value="<?php echo $this->row->kieu; ?>" name="kieu" id="kieu">
<input type="hidden" value="<?php echo $this->row->parent_id; ?>" name="parent_id" id="parent_id">
<label for="parent_id" style="display:none;">Cây đơn vị <span class="required">*</span> </label>
<label for="type" style="display:none;">Loại <span class="required">*</span></label>
<div class="tabbable">
		<ul class="nav nav-tabs" id="myTab3">
			<li class="active"><a data-toggle="tab"	href="#COM_THONTO_THANHLAP_TAB1">Thông tin chung</a></li>
		</ul>
		<div class="tab-content">
			<div id="COM_THONTO_THANHLAP_TAB1" class="tab-pane active">
				<fieldset>
					<legend>Thông tin chung</legend>
					<div class="row-fluid">
						<div class="control-group span6">
							<label class="control-label" for="name">Tên <span class="required">*</span></label>
							<div class="controls">
							
							<input type="text" value="<?php echo $this->row->ten;?>"name="ten" id="ten">
							</div>
						</div>
						<div class="control-group span6">
							<label class="control-label" for="s_name">Tên viết tắt <span
								class="required">*</span></label>
							<div class="controls">
								<input type="text" value="<?php echo $this->row->tenviettat; ?>" name="tenviettat" id="tenviettat">
							</div>
						</div>	
					</div>
					<div class="row-fluid">	
						<div class="control-group span6">
								<label class="control-label" for="ghichu">Ghi chú</label>
								<div class="controls">
									<textarea rows="5" cols="30" id="ghichu" name="ghichu"><?php echo $this->row->ghichu;?></textarea>
								</div>
						</div>	
						<div class="control-group span6">
								<label class="control-label" for="ghichu">Là Phường/xã</label>
								<div class="controls">
									<?php echo $this->cboPhuongxa;?>
								</div>
								<label class="control-label">Cán bộ quản lý Phường/xã</label>
								<div class="controls" id='div_hosochinh'>
									<?php echo $this->cboHosochinh_id;?>
								</div>
						</div>	
					</div>					
				</fieldset>					
			</div>
		</div>
	</div>
	<input type="hidden" name="action_name" id="action_name" value="">
	<input type="hidden" name="is_valid_name" id="is_valid_name" value="">
	<?php echo JHTML::_( 'form.token' ); ?> 	
</div>
<script type="text/javascript">
jQuery(document).ready(function($){
	$('#donvi_id').on('change', function(){
		var text=$('#donvi_id option:checked').text();
		var donvi =$('#donvi_id option:checked').val();
		if (donvi>0) $('#ten').val(text); else $('#ten').val(''); 
		$.ajax({
			type: 'GET',
  			url: '<?php echo JUri::base(true);?>/index.php?option=com_thonto&controller=tochuc&task=gethoso&format=raw&px_id='+donvi,
  			success:function(data){
  	  			$('#div_hosochinh').html(data);
  			}
        });
	});
}); // end document.ready
</script>