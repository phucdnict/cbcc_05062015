<?php
//var_dump($this->row->id);
//JHtml::_('formbehavior.chosen', 'select');
?>
<form class="form-horizontal" action="index.php?option=com_tochuc&controller=goibienche&task=saveedit" method="post" name="frmGoibienche" id="frmGoibienche">
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
			<div class="controls">
				<label class="checkbox"> <input type="hidden" value="0"	name="active"> 
				<input type="checkbox" value="1" name="active" <?php echo (($this->row->active == 1)?'checked = "checked"':'');?>>
					Trạng thái
				</label>				
			</div>
		</div>
		</div>
		<div class="row-fluid">	
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>Hình thức</th>
						<th>Điều động</th>
					</tr>
				</thead>
				<tbody>
				<?php
				for ($i = 0; $i < count($this->hinhthuc); $i++) {
					$item = $this->hinhthuc[$i];
					$item['hinhthucdieudong_id']  = explode(',', $item['hinhthucdieudong_id']);
				?>
					<tr>
						<td>
						<label class="checkbox">
					<input type="checkbox" value="<?php echo $item['id'];?>" name="hinhthuc_id[]" <?php echo (($item['checked'] == 1)?'checked = "checked"':'');?>>
						<?php echo $item['name'];?>
					</label></td>
						<td>
						<?php
						for ($j = 0; $j < count($this->hinhthuc); $j++) {
							$dieudong = $this->hinhthuc[$j];
							//var_dump($dieudong['ID'], $item['HINHTHUCDIEUDONG_ID'],in_array($dieudong['ID'], $item['HINHTHUCDIEUDONG_ID']));
							$checked = (in_array($dieudong['id'], $item['hinhthucdieudong_id'])?'checked="checked"':'');							
							?>
							<label class="checkbox">
							<input type="checkbox" value="<?php echo $dieudong['id'];?>" name="hinhthucdieudong_id[<?php echo $item['id'];?>][]" <?php echo  $checked;?>>
								<?php echo $dieudong['name'];?>
							</label>
							<?php 
						}
						?>
						</td>
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