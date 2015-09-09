<?php
defined('_JEXEC') or die('Restricted access');
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('dropdown.init');
$ordering = ($this->lists['order'] == 'orders');
?>
<?php if (!empty( $this->sidebar)) : ?>
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
<?php else : ?>
	<div id="j-main-container">
<?php endif;?>
<form id="adminForm" name="adminForm" method="post" action="<?php echo JRoute::_('index.php?option=com_tochuc&view='.$this->data['view']);?>">
<div id="filter-bar" class="btn-toolbar">
	<div class="filter-search btn-group pull-left">
		<input type="text" name="search" id="search" value="<?php echo $this->lists['search'];?>" placeholder="Tìm kiếm"  />
	</div>
	<div class="btn-group pull-left">
		<button type="submit" class="btn hasTooltip" title="<?php echo JHtml::tooltipText('JSEARCH_FILTER_SUBMIT'); ?>"><i class="icon-search"></i></button>
		<button  class="btn hasTooltip" title="<?php echo JHtml::tooltipText('JSEARCH_RESET'); ?>" onclick="document.getElementById('search').value='';this.form.getElementById('filter_type').value='0';this.form.getElementById('filter_logged').value='0';this.form.submit();"><i class="icon-remove"></i></button>
	</div>
	<div class="btn-group pull-right">
		<?php echo $this->lists['status'];?>
	</div>
</div>
<table class="table table-bordered">
<thead>
<tr>
	<th style="text-align: center;vertical-align:middle;" nowrap="nowrap" width="15">
    	<?php echo JText::_('STT'); ?>
	</th>
	<th style="text-align: center;vertical-align:middle;" nowrap="nowrap" width="15">
		<input type="checkbox" name="checkAll-toggle" value="" onclick="Joomla.checkAll(this)" />
	</th>
	<th style="text-align: center;vertical-align:middle;" nowrap="nowrap">
		<?php echo JHTML::_('grid.sort', 'Tên tổ chức', 'name', $this->lists['order_Dir'], $this->lists['order'] ); ?>
	</th>
	<th style="text-align: center;vertical-align:middle;" nowrap="nowrap" width="100">
		<?php echo JHTML::_('grid.sort', 'Sắp xếp', 'type', $this->lists['order_Dir'], $this->lists['order'] ); ?>
	</th>
	<th style="text-align: center;vertical-align:middle;" nowrap="nowrap" width="100">
		Mức độ
	</th>
	<th style="text-align: center;vertical-align:middle;" nowrap="nowrap" width="100">
		Số tháng
	</th>
	<th style="text-align: center;vertical-align:middle;" nowrap="nowrap" width="100">
		Trạng thái
	</th>
	<th style="text-align: center;vertical-align:middle;" nowrap="nowrap" width="100">Thao tác</th>
</tr>
</thead>
<tbody>
<?php
$k = 0; 
for($i=0, $n=count($this->items); $i<$n; $i++){
	$row = &$this->items[$i];
	$link_edit = JRoute::_('index.php?option=com_tochuc&controller='.$this->data['view'].'&task=edit&id='. $row->id );
	$link_remove = JRoute::_('index.php?option=com_tochuc&controller=khenthuongkyluat&controller='.$this->data['view'].'&task=remove&dbtable='.$this->data['table'].'&id='.$row->id);
	$checked = JHTML::_('grid.checkedout', $row, $i );
?>
<tr class="<?php echo "row$k"; ?>">
	<td style="text-align: center;vertical-align:middle;">
		<?php echo $this->pagination->getRowOffset( $i ); ?>
	</td>
	<td style="text-align: center;vertical-align:middle;">
		<?php echo $checked; ?>
	</td>
	<td style="vertical-align:middle;">
		<a  href="<?php echo $link_edit; ?>" title="Chỉnh sửa">
				<?php echo htmlspecialchars($row->name); ?>
			</a>
	</td>
	<td style="text-align: center;vertical-align:middle;">
		<?php if($row->type=="KT")echo "Khen thưởng"; elseif($row->type=="KL") echo "Kỷ luật" ?>
	</td>
	<td style="text-align: center;vertical-align:middle;">
		<?php echo htmlspecialchars($row->lev); ?>
	</td>
	<td style="text-align: center;vertical-align:middle;">
		<?php echo htmlspecialchars($row->months_nangluong); ?>
	</td>
	<td style="text-align: center;vertical-align:middle;">
		<?php 
			if($row->status == '1'){
				$link_status = JRoute::_('index.php?option=com_tochuc&controller='.$this->data['view'].'&task=unpublish&dbtable='.$this->data['table'].'&id='.$row->id);
		?>
		<a href="<?php echo $link_status; ?>" class="btn btn-micro hasTooltip" title="Sử dụng">
			<i class="icon-publish"></i>
		</a>
		<?php
			}else{
				$link_status = JRoute::_('index.php?option=com_tochuc&controller='.$this->data['view'].'&task=publish&dbtable='.$this->data['table'].'&id='.$row->id);
		?>
		<a href="<?php echo $link_status; ?>" class="btn btn-micro hasTooltip" title="Không sử dụng">
			<i class="icon-unpublish"></i>
		</a>
		<?php
			}
		?>
	</td>
	<td style="text-align: center;vertical-align:middle;">
		<div class="btn-group">
			<a class="btn btn-small btn-danger hasTooltip" href="<?php echo $link_remove;?>" title="Xóa">
				<i class="icon-trash"></i>
			</a>
		</div>
	</td>
</tr>
<?php 
	$k = 1 - $k;
} 
?>
</tbody>
<tfoot>
<tr>
	<td colspan="11" style="text-align:right;">
		<div class="btn-group pull-right hidden-phone">
			<label for="limit" class="element-invisible"><?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC'); ?></label>
			<?php echo $this->pagination->getLimitBox(); ?>
		</div>
		<div style="float:left;">
			<?php echo $this->pagination->getListFooter(); ?>
		</div>
	</td>
</tr>
</tfoot>
</table>
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" />
<input type="hidden" name="dbtable" value="<?php echo $this->data['table']; ?>" />
<input type="hidden" name="option" value="com_tochuc" />
<input type="hidden" name="controller" value="khenthuongkyluat" />
<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
<?php echo JHTML::_( 'form.token' ); ?>
</form>