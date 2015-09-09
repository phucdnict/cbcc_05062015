<?php
/**
 * Author: Phucnh
 * Date created: Jul 20, 2015
 * Company: DNICT
 */
$row = $this->row;
?>
<div class="row-fluid">
	<div class="control-group">
		<label class="control-label">Loại tài sản (<span style="color:red;">*</span>)</label>
		<div class="controls">
			<?php echo $this->cbotaisankhac;?>
		</div>
	</div>
</div>
<div class="row-fluid">
	<div class="span6">
		<div class="control-group">
			<label class="control-label" for="value">Tên tài sản (<span style="color:red;">*</span>)</label>
			<div class="controls">
				<input type="text" name="value" id="value" value="<?php echo $row->value;?>">
			</div>
		</div>
	</div>
	<div class="span6">
	<div class="control-group">
		<label class="control-label" for="giatri">Giá trị (<span style="color:red;">*</span>)</label>
		<div class="controls">
			<input type="text" id="giatri" name="giatri" style="text-align:right" value="<?php echo $row->trigia; ?>" placeholder="Nhập giá trị" />
		</div>
	</div>
</div>
</div>
<input type="hidden" id="type" name="type" value="0"/>
<script type="text/javascript">
</script>