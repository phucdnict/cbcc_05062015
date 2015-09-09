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
	<label class="control-label" for="tendot">Tên đợt báo cáo<span style="color: red">(*)</span></label>
	<div class="controls">
		<input type="text" id="tendot" name="tendot" class="required" value="<?php echo $item['tendot']; ?>" placeholder="Nhập tên" />
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="nam">Năm báo cáo</span></label>
	<div class="controls">
		<input type="text" id="nam" name="nam" class="number" value="<?php if (isset($item['nam'])) echo $item['nam'];else echo date('Y'); ?>" placeholder="Nhập tên" />
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="status">Trạng thái</label>
	<div class="controls">
		<input type="hidden" name="trangthai" value="0"/>
		<input type="checkbox" name="trangthai" value="1" <?php if($item['trangthai'] == 1){echo 'checked="checked"';}?> />
	</div>
</div>
<?php if ($item['id']==0){?>
<div class="control-group">
	<label class="control-label">Thừa kế lại cấu hình kiến nghị của đợt</label>
	<div class="controls">
		<?php echo AdminThontoHelper::selectBox('', array('name'=>'thuake_dot'), 'thonto_dotbaocao', array('id','tendot'));?>
	</div>
</div>
<div class="control-group">
	<label class="control-label">Thừa kế lại cấu hình nội dung họp của đợt</label>
	<div class="controls">
		<?php echo AdminThontoHelper::selectBox('', array('name'=>'thuake_noidunghop'), 'thonto_dotbaocao', array('id','tendot'));?>
	</div>
</div>
<?php }?>
</fieldset>
<input type="hidden" name="id" value="<?php echo $item['id']; ?>" />
<input type="hidden" name="task" id="task" value="" />
<input type="hidden" name="dbtable" value="<?php echo $this->data['table']; ?>" />
<input type="hidden" name="view" value="<?php echo $this->data['view']; ?>" />
<input type="hidden" name="option" value="com_thonto" />
<input type="hidden" name="controller" value="dotbaocao" />
</form>
<script type="text/javascript">
Joomla.submitbutton = function(task){
	if (task == 'cancel' || document.formvalidator.isValid(document.id('adminForm')))
	{
		Joomla.submitform(task, document.getElementById('adminForm'));
	}
};
</script>