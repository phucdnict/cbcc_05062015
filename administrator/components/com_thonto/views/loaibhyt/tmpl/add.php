<?php
defined('_JEXEC') or die('Restricted access');
JHTML::_('behavior.formvalidation');
JHTML::_('behavior.tooltip');
$item = $this->item;
?>
<form id="adminForm" name="adminForm" class="form-horizontal form-validate" method="post" action="index.php">
<fieldset>
<legend>Thông tin chi tiết</legend>

<div class="control-group">
	<label class="control-label" for="ten">Tên loại bảo hiểm y tế<span style="color: red">(*)</span></label>
	<div class="controls">
		<input type="text" id="ten" name="ten" class="required" value="<?php echo $item['ten']; ?>" placeholder="Nhập tên" />
	</div>
</div>

<div class="control-group">
	<label class="control-label" for="status">Trạng thái</label>
	<div class="controls">
		<input type="hidden" name="trangthai" value="0"/>
		<input type="checkbox" name="trangthai" value="1" <?php if($item['trangthai'] == 1){echo 'checked="checked"';}?> />
	</div>
</div>

</fieldset>
<input type="hidden" name="id" value="<?php echo $item['id']; ?>" />
<input type="hidden" name="task" id="task" value="" />
<input type="hidden" name="dbtable" value="<?php echo $this->data['table']; ?>" />
<input type="hidden" name="view" value="<?php echo $this->data['view']; ?>" />
<input type="hidden" name="option" value="com_thonto" />
<input type="hidden" name="controller" value="loaibhyt" />
</form>
<script type="text/javascript">
Joomla.submitbutton = function(task){
	if (task == 'cancel' || document.formvalidator.isValid(document.id('adminForm')))
	{
		Joomla.submitform(task, document.getElementById('adminForm'));
	}
};
</script>