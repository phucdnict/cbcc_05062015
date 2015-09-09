<?php
defined('_JEXEC') or die('Restricted access');
//JHtml::_('formbehavior.chosen');
?>
<?php if (!empty( $this->sidebar)) : ?>
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
<?php else : ?>
	<div id="j-main-container">
<?php endif;?>
	<div class="span4">
	<fieldset>
	<legend>Gói Đào tạo bồi dưỡng
		<span class="pull-right inline">
			<button id="btnThemmoi" class="btn btn-success btn-small"><i class="icon-plus"></i> Thêm mới</button>						
		</span>	
	</legend>
	<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th nowrap="nowrap">#</th>
					<th width="80%">Tên</th>
					<th nowrap="nowrap">Trạng thái</th>
					<th></th>
				</tr>			
			</thead>
			<tbody>
			<?php
			for ($i = 0; $i < count($this->items); $i++) {
				$item = $this->items[$i];
				?>
				<tr>
					<td nowrap="nowrap"><?php echo ($i+1);?></td>
					<td><a href="javascript:void(0)" class="btnEdit" data-id="<?php echo $item['id'];?>"><?php echo $item['name'];?></a></td>
					<td nowrap="nowrap" align="center"><?php echo (($item['status'] == 1)?'<i class="icon-publish"></i>':'<i class="icon-unpublish"></i>');?></td>
					<td nowrap="nowrap">						
						<a href="index.php?option=com_tochuc&controller=goidaotao&task=delete&id=<?php echo $item['id'];?>" class="btn btn-danger btn-mini"><i class="icon-trash"></i></a>
					</td>
				</tr>
				<?php 
			} 
			?>
			</tbody>
		</table>
	</fieldset>
	</div>
	<div class="span8" id="form-content">
	
	</div>
</div>

<script type="text/javascript">
jQuery(document).ready(function($){
	var _initEditPage = function(id){
		$.get('index.php?option=com_tochuc&controller=goidaotao&task=edit&format=raw',{"id":id},function(response){
			$('#form-content').html(response);
		});
	};

	$('#btnThemmoi').click(function(){
		_initEditPage(0);		
	});
	$('.btnEdit').click(function(){
		_initEditPage($(this).attr('data-id'));
		return false;
	});
}); // end document.ready
</script>