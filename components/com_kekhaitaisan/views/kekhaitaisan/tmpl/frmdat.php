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
			<?php echo $this->cbodat;?>
		</div>
	</div>
</div>
<div class="row-fluid">
	<div class="span8">
		<div class="control-group">
			<label class="control-label" for="value">Tên tài sản (<span style="color:red;">*</span>)</label>
			<div class="controls">
				<input type="text" style="width:606px" name="value" id="value" value="<?php echo $row->value;?>">
			</div>
		</div>
	</div>
</div>
<div class="row-fluid">
	<div class="span5">
		<div class="control-group">
			<label class="control-label">Địa chỉ (<span style="color:red;">*</span>)</label>
			<div class="controls">
				<input type="text"style="width:606px"  id="diachi" class="" name="diachi" value="<?php echo $row->diachi; ?>" placeholder="Nhập địa chỉ" />
			</div>
		</div>
	</div>
</div>
<div class="row-fluid">
<div class="span6">
	<div class="control-group" for="dientich">
		<label class="control-label">Diện tích xây dựng (<span style="color:red;">*</span>)</label>
		<div class="controls">
			<input type="text" id="dientich" class="" name="dientich" value="<?php echo $row->dientich; ?>" placeholder="Nhập diện tích" />
		</div>
	</div>
</div>
<div class="span5">
	<div class="control-group">
		<label class="control-label" for="giatri">Giá trị (<span style="color:red;">*</span>)</label>
		<div class="controls">
			<input type="text" id="giatri" name="giatri" style="text-align:right" value="<?php echo $row->trigia; ?>" placeholder="Nhập giá trị" />
		</div>
	</div>
</div>
</div>
<div class="row-fluid">
	<div class="control-group">
		<label class="control-label" for="giaychungnhan">GCN quyền sở hữu (<span style="color:red;">*</span>)</label>
		<div class="controls">
			<input type="text" id="giaychungnhan" style="width:606px" name="giaychungnhan" value="<?php echo $row->giaychungnhan; ?>" placeholder="Nhập giấy chứng nhận quyền sở hữu" />
		</div>
	</div>
</div>
<div class="row-fluid">
	<div class="control-group">
		<label class="control-label">Thông tin khác (Nếu có)</label>
		<div class="controls">
			<input type="text" id="thongtinkhac" style="width:606px" name="thongtinkhac" class="width_max" value="<?php echo $row->thongtinkhac; ?>" placeholder="Nhập thông tin khác" />
		</div>
	</div>
</div>
<input type="hidden" id="type" name="type" value="2"/>