<form class="form-horizontal" action="index.php?option=com_tochuc&controller=goidaotao&task=saveedit" method="post" name="frmGoihinhthuchuongluong" id="frmGoihinhthuchuongluong">
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
					<input type="text" name="id" value="<?php echo $this->row['id'];?>" readonly>
				</div>
			</div>
		</div>
		<div class="row-fluid">
		<div class="control-group">
			<label class="control-label" for="name">Tên</label>
			<div class="controls">
				<input type="text" id="name" placeholder="Nhập tên" name="name" value="<?php echo $this->row['name'];?>">
			</div>
		</div>
		</div>
		<div class="row-fluid">		
		<div class="control-group">
			<div class="controls">
				<label class="checkbox"> <input type="hidden" value="0"	name="status"> 
				<input type="checkbox" value="1" name="status" <?php echo (($this->row['status'] == 1)?'checked = "checked"':'');?>>
					Trạng thái
				</label>				
			</div>
		</div>
		</div>
		<div class="row-fluid">	
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>Loại trình độ</th>
					</tr>
				</thead>
				<tbody>
				<?php
				for ($i = 0; $i < count($this->loaitrinhdo); $i++) {
					$item = $this->loaitrinhdo[$i];
					//var_dump($item);
					$checked = '';
					//var_dump( count($this->loaitrinhdoSelect));
					for($k=0;$k < count($this->loaitrinhdoSelect);$k++){
						
						//var_dump(($this->loaitrinhdoSelect[$k]['type_sca_code_id']));
						if($this->loaitrinhdoSelect[$k]['type_sca_code_id'] == $item->code){
							$checked = 'checked="checked"';
							unset($this->loadtrinhdoSelect[$k]);
						}	
					}
// 					$item['hinhthucdieudong_id']  = explode(',', $item['hinhthucdieudong_id']);
				?>
					<tr>
						<td>
						<label class="checkbox">
					<input type="checkbox" value="<?php echo $item->code;?>" name="type_sca_code_id[]" <?php echo $checked; ?>>
						<?php echo $item->name;?>
					</label></td>
					</tr>		
				<?php
				} 
				?>
		
				</tbody>
			</table>		
		
		</div>		
	</fieldset>
<?php echo JHTML::_( 'form.token' ); ?> 
</form>
<script type="text/javascript">
jQuery(document).ready(function ($){
	$('#frmGoihinhthuchuongluong').validate({
	    rules: {
	      name: {
	   		required: true	        
	      }	     
	    }
	});
});
</script>