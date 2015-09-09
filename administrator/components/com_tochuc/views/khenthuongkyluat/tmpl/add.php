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
	<label class="control-label" for="name">Tên  <span style="color: red">(*)</span></label>
	<div class="controls">
		<input type="text" id="name" name="name" class="required" value="<?php echo $item['name']; ?>" placeholder="Nhập tên" />
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="type">Hình thức</label>
	<div class="controls">
		<select id="type" name="type" class="required">
			<option value="KL" <?php if($item['type']="KL") echo "selected" ?>>Kỷ luật</option>
			<option value="KT" <?php if($item['type']="KT") echo "selected" ?>>Khen thưởng</option>
		</select>
	</div>
</div>

<div class="control-group">
	<label class="control-label" for="lev">Mức độ khen thưởng kỷ luật </label>
	<div class="controls">
		<input type="text" id="lev" name="lev" class="validate-numeric" value="<?php echo $item['lev']; ?>" size="4" style="width:35px;"/>
	</div>
</div>

<div class="control-group">
	<label class="control-label" for="months_nangluong">Số tháng nâng lương </label>
	<div class="controls">
		<input type="text" id="months_nangluong" name="months_nangluong" class="validate-numeric" value="<?php echo $item['months_nangluong']; ?>" size="4" style="width:35px;"/>
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
<input type="hidden" name="option" value="com_tochuc" />
<input type="hidden" name="controller" value="khenthuongkyluat" />
</form>
<script type="text/javascript">
Joomla.submitbutton = function(task){
	if (task == 'cancel' || document.formvalidator.isValid(document.id('adminForm')))
	{
		Joomla.submitform(task, document.getElementById('adminForm'));
	}
};
</script>