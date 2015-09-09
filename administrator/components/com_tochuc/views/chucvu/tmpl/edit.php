<?php
//var_dump($this->row->id);
//JHtml::_('formbehavior.chosen', 'select');
?>
<form class="form-horizontal" action="index.php?option=com_tochuc&controller=chucvu&task=saveedit" method="post" name="frmChucvu" id="frmChucvu">
	<fieldset>
		<legend>
			Thông tin chi tiết [<small><?php echo (($this->row->id == 0)?'Thêm mới':'Hiệu chỉnh');?></small>]
		</legend>
		<div class="control-group">
			<label class="control-label" for="id">ID</label>
			<div class="controls">
				<input type="text" id="id" name="id" value="<?php echo $this->row->id;?>" readonly>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="parent">Cha</label>
			<div class="controls">
				<input type="hidden" id="parentid" name="parentid" value="<?php echo $this->row->parentid;?>">
				<span><?php echo AdminTochucHelper::getNameById( $this->row->parentid, 'cb_captochuc','name'); ?></span>		
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="name">Tên chức vụ lãnh đạo</label>
			<div class="controls">
				<input type="text" id="name" placeholder="Nhập tên" name="name"	value="<?php echo $this->row->name;?>">
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<label class="checkbox"> <input type="hidden" value="0" name="status"> <input type="checkbox" value="1" name="status" <?php echo (($this->row->status == 1)?'checked = "checked"':'');?>>
					Trạng thái
				</label>
			</div>
		</div>
		<?php
		if ($this->row->id > 0) {
		?>
		<div class="control-group">
		<h3>
			<span class="span7">Danh sách các chức vụ</span>
			<span class="span5">
				<span class="pull-right inline">
					<button id="btnThemmoiChucvu" class="btn btn-success btn-small"><i class="icon-plus"></i></button>										
				</span>																						
			</span>
		</h3>
		<table class="table table-striped">
			<thead>
				<tr>					
					<th>Ngạch</th>
					<th>Tên</th>
					<th>Hệ số</th>
					<th>#</th>					
				</tr>
			</thead>
				<tbody>
				<?php
					for ($i = 0; $i < count($this->items); $i++) {
						$item = $this->items[$i];
						?>
						<tr>						
						<td><?php echo AdminTochucHelper::getNameById((int) $item->mangach, 'pos_system','NAME','ID'); ?></td>
						<td><?php echo $item->tencap; ?></td>
						<td><?php echo $item->heso; ?></td>		
						<td>
							<div class="btn-group">
								<a href="index.php?option=com_tochuc&controller=chucvu&task=editpos&format=raw&id=<?php echo $item->idchucvu;?>" class="btnEditChucvu btn btn-success btn-mini"><i class="icon-pencil"></i></a>
								<a href="index.php?option=com_tochuc&controller=chucvu&task=deletepos&id=<?php echo $item->idchucvu;?>" class="btn btn-danger btn-mini"><i class="icon-trash"></i></a>
							</div>
							</td>
						</tr>
						<?php 
					} 
				?>
				
				</tbody>
			</table>
		</div>
		<?php
			} 
		?>
		<div class="control-group">
			<div class="controls">
				<input type="submit" class="btn btn-primary" value="Lưu" name="btnSubmit">
			</div>
		</div>
	</fieldset>	
<?php echo JHTML::_( 'form.token' ); ?> 
</form>
<div id="content-addpos"></div>
<script type="text/javascript">
jQuery(document).ready(function ($){
// 	jQuery('#parent_id').chosen({
// 		disable_search_threshold : 10,
// 		allow_single_deselect : true
// 	});
	$('#frmChucvu').validate({
	    rules: {
	      name: {
	   		required: true	        
	      },
	      parent: {	        
	        number: true
	      }
	    }
	});
	$('#btnThemmoiChucvu').click(function(){
		$('#content-addpos').empty();
		$('#content-addpos').load('index.php?option=com_tochuc&controller=chucvu&task=editpos&format=raw&idcap=<?php echo $this->row->id; ?>');
		return false;
	});
	$('.btnEditChucvu').click(function(){
		$('#content-addpos').empty();
		$('#content-addpos').load(this.href);
		return false;
	});	
});
</script>