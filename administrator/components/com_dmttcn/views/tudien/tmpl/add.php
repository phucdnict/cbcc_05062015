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
	<label class="control-label" for="tenbang">Tên bảng (<span style="color: red">*</span>) </label>
	<div class="controls">
		<input type="text" id="tenbang" name="tenbang" class="required" value="<?php echo $item['tenbang']; ?>" />
		<input type="hidden" id="tenbangcu" name="tenbangcu" class="" value="<?php echo $item['tenbang']; ?>" />
	</div>
</div>

<div class="control-group">
	<label class="control-label" for="tentruong">Tên trường dữ liệu (<span style="color: red">*</span>)</label>
	<div class="controls">
		<input type="text" id="tentruong" name="tentruong" class="required" value="<?php echo $item['tentruong']; ?>" />
		<input type="hidden" id="tentruongcu" name="tentruongcu" class="" value="<?php echo $item['tentruong']; ?>" />
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="name">Tên hiển thị</label>
	<div class="controls">
		<input type="text" id="name" name="name" class="" value="<?php echo $item['name']; ?>"  />
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="name_edit">Tên hiển thị trong hiệu chỉnh</label>
	<div class="controls">
		<input type="text" id="name_edit" name="name_edit" class="" value="<?php echo $item['name_edit']; ?>"  />
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="name_detail">Tên hiển thị trong xem chi tiết </label>
	<div class="controls">
		<input type="text" id="name_detail" name="name_detail" class="" value="<?php echo $item['name_detail']; ?>"  />
	</div>
</div>

<div class="control-group">
	<label class="control-label" for="status">Trạng thái</label>
	<div class="controls">
		<input type="hidden" name="status" value="0"/>
		<input type="checkbox" name="status" value="1" <?php if($item['status'] == 1){echo 'checked="checked"';}?> />
	</div>
</div>

</fieldset>
<input type="hidden" name="id" value="<?php echo $item['id']; ?>" />
<input type="hidden" name="task" id="task" value="" />
<input type="hidden" name="dbtable" value="<?php echo $this->data['table']; ?>" />
<input type="hidden" name="view" value="<?php echo $this->data['view']; ?>" />
<input type="hidden" name="option" value="com_dmttcn" />
<input type="hidden" name="controller" value="tudien" />
</form>
<script type="text/javascript">
Joomla.submitbutton = function(task){
	if (task == 'cancel' || document.formvalidator.isValid(document.id('adminForm')))
	{
		Joomla.submitform(task, document.getElementById('adminForm'));
	}
};
</script>