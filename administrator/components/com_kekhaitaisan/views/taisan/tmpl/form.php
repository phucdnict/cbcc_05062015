<?php
defined( '_JEXEC' ) or die( 'Truy cập không hợp lệ' );
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.framework', true);
$model  = Core::model('Kekhaitaisan/KktsTaisan');
$row=$this->row;
?>
<form action="index.php" method="post" name="adminForm" id="adminForm" class="form-horizontal form-validate">
    <fieldset><legend>Chi tiết</legend>
		<div class="control-group">
			<label class="control-label" for="tenloaitaisan"> Tên loại nhà <span style="color: red">(*)</span></label>
			<div class="controls">
				<input type="text" size="32" class="required" value="<?php if(isset($row['tenloaitaisan'])) echo $row['tenloaitaisan'];?>" id="tenloaitaisan" name="tenloaitaisan"  placeholder="Nhập tên tài sản" />
				<span id="name-result"></span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" >Thuộc </label>
			<div class="controls">
				<?php echo $model->getCboLoaitaisan($row['parent_id']);?>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="type">Type </label>
			<div class="controls">
				<select name ="type" id="type">
				<?php
				for ($i=0; $i<=2; $i++){
					if ($i==1) $typetext="Nhà";
					elseif ($i==2) $typetext="Đất";
					elseif ($i==0) $typetext="Tài sản khác";
				?>
					<option value="<?php echo $i?>" <?php if( (isset($row['type'])) && ($row['type']==$i)) echo 'selected="selected"';?> > <?php echo $typetext?></option>
				<?php }?>
				</select>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="orders">Thứ tự </label>
			<div class="controls">
				<input type="text" class="validate-numeric" value="<?php if(isset($row['orders'])) echo $row['orders']; else echo '99';?>" id="orders" name="orders" />
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="status">Trạng thái</label>
			<div class="controls">
				<input type="checkbox" name="status" <?php if(isset($row['status']) && $row['status']==1) echo 'checked';?>>
			</div>
		</div>
    </fieldset>
	<input type="hidden" name="option" value="com_kekhaitaisan" />
	<input type="hidden" id="id" name="id" value="<?php echo $row['id']>0 ? $row['id']:""; ?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="controller" value="taisan" />
 	<?php echo JHTML::_( 'form.token' ); ?> 
</form>
<script>
Joomla.submitbutton = function(task)
{	
        if (task == 'cancel') {
            Joomla.submitform(task, document.getElementById('adminForm'));
        }
        else {
            if (task != 'cancel' && document.formvalidator.isValid(document.id('adminForm')))
                    Joomla.submitform(task, document.getElementById('adminForm'));
        }  
    return false;
}; 
</script>
