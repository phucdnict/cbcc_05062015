<?php
defined('_JEXEC') or die('Restricted access');
JHTML::_('behavior.formvalidation');
JHTML::_('behavior.tooltip');
$item = $this->item;
$fk = $this->fk;
$kiennghi = $this->kiennghi;
$fk_noidunghop = $this->fk_noidunghop;
$noidunghop = $this->noidunghop;
?>
<form id="adminForm" name="adminForm" class="form-horizontal form-validate" method="post" >
<div class="control-group">
		<div class="controls">
			<h3>Đợt đánh giá: <?php echo $item["tendot"];?></h3>
		</div>
	</div>
<fieldset>

<legend>Thiết lập kiến nghị cho đợt báo cáo</legend>
	<div class="control-group">
		<div class="controls">
			<input type='checkbox' id='ck_all'>Chọn tất cả
		</div>
	</div>
	<?php for ($i=0; $i<count($kiennghi); $i++){?>
	<div class="control-group">
		<div class="controls">
			<input type='checkbox' class="ck" name='kiennghi[]' <?php for($j=0;$j<count($fk);$j++) if (in_array($kiennghi[$i]['id'], $fk[$j])) echo 'checked="checked"'; ?> value='<?php echo $kiennghi[$i]['id'];?>'> <?php echo $kiennghi[$i]['ten'];?>
		</div>
	</div>
	<?php }?>
	<legend>Thiết lập nội dung họp cho đợt báo cáo</legend>
	<div class="control-group">
		<div class="controls">
			<input type='checkbox' id='ck_ndhall'>Chọn tất cả
		</div>
	</div>
	<?php for ($i=0; $i<count($noidunghop); $i++){?>
	<div class="control-group">
		<div class="controls">
			<input type='checkbox' class="ck_ndh" name='noidunghop[]' <?php for($j=0;$j<count($fk_noidunghop);$j++) if (in_array($noidunghop[$i]['id'], $fk_noidunghop[$j])) echo 'checked="checked"'; ?> value='<?php echo $noidunghop[$i]['id'];?>'> <?php echo $noidunghop[$i]['ten'];?>
		</div>
	</div>
	<?php }?>
	
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
	jQuery('#ck_all').on('click', function(){
		jQuery('.ck').not(this).prop('checked', this.checked);
	});  
	jQuery('#ck_ndhall').on('click', function(){
		jQuery('.ck_ndh').not(this).prop('checked', this.checked);
	});  
</script>