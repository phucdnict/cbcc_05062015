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
							<label class="control-label" for="name">Tên<span class="required">*</span></label>
							<div class="controls">
							<input type="text" value="<?php echo $this->row->ten;?>"name="ten" id="ten">
							</div>
						</div>
						<div class="control-group span6">
							<label class="control-label" for="s_name">Tên viết tắt <span class="required">*</span></label>
							<div class="controls">
								<input type="text" value="<?php echo $this->row->tenviettat; ?>" name="tenviettat" id="tenviettat">
							</div>
						</div>	
					</div>
					<div class="row-fluid">
						<div class="control-group span6">
							<label class="control-label" for="soquyetdinhthanhlap">Số quyết định thành lập </label>
							<div class="controls">
								<input type="text" value="<?php echo $this->row->soquyetdinhthanhlap; ?>" name="soquyetdinhthanhlap" id="soquyetdinhthanhlap">
							</div>
						</div>	
						<div class="control-group span6">
							<label class="control-label" for="ngayquyetdinhthanhlap">Ngày quyết định thành lập </label>
							<div class="controls">
								<input type="text" class="dp" value="<?php if($this->row->ngayquyetdinhthanhlap!=null) echo date('d/m/Y', strtotime($this->row->ngayquyetdinhthanhlap)); ?>" name="ngayquyetdinhthanhlap" id="ngayquyetdinhthanhlap">
							</div>
						</div>	
					</div>
					<div class="row-fluid">
						<div class="control-group span6">
							<label class="control-label" for="chibo_id">Chi bộ quản lý </label>
							<div class="controls" id="div_chibo">
								<?php echo $this->cboChibo;?>
							</div>
						</div>	
						<div class="control-group span6">
							<label class="control-label" for="dientichtunhien">Diện tích tự nhiên </label>
							<div class="controls">
								<input type="text" value="<?php echo $this->row->dientichtunhien; ?>" name="dientichtunhien" id="dientichtunhien">
							</div>
						</div>	
					</div>
					<div class="row-fluid">
						<div class="control-group span6">
							<label class="control-label" for="tongsodan">Tổng số dân </label>
							<div class="controls">
								<input type="text" value="<?php echo $this->row->tongsodan; ?>" name="tongsodan" id="tongsodan">
							</div>
						</div>	
						<div class="control-group span6">
							<label class="control-label" for="tongsoho">Tổng số hộ gia đình </label>
							<div class="controls">
								<input type="text" value="<?php echo $this->row->tongsoho; ?>" name="tongsoho" id="tongsoho">
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
					</div>					
			</div>
		</div>
	</div>
	<input type='hidden' name='hosochinh_id' id='hosochinh_id_tochuc' value='<?php echo $this->row->hosochinh_id;?>'>
	<input type='hidden' name='donvi_id' id='donvi_id_tochuc' value='<?php echo $this->row->donvi_id;?>'>
	<input type="hidden" name="action_name" id="action_name" value="">
	<input type="hidden" name="is_valid_name" id="is_valid_name" value="">
	<?php echo JHTML::_( 'form.token' ); ?> 	
</div>
<script type="text/javascript">
jQuery(document).ready(function($){
	$('.dp').datepicker({
		format:'dd/mm/yyyy',
		 autoclose: true
		}).next().on(ace.click_event, function(){
			$(this).prev().focus();
		});
}); // end document.ready
</script>