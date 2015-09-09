<?php
/**
 * Autdor: Phucnh
 * Date created: Jul 15, 2015
 * Company: DNICT
 */
$row = $this->taisan;
$taisancha = $this->taisancha;
// var_dump($row);
// echo '<hr/>';
// var_dump($taisancha);
?>
<div id="div_quatrinh_taisan">
<table class="table table-striped table-bordered table-hover">
	<tr>
		<th style='width:4%'  ><input type='checkbox' class='center' id='alltaisan' style='opacity:1'/></th>
		<th>Tên tài sản</th>
		<th>Giá trị</th>
		<th style='width:10%'>Thao tác</th>
	</tr>
	<?php	$o=0;for ($i=0; $i<count($taisancha);$i++){ 	?>
		<?php for($k=0; $k<count($row); $k++){
			$check=0;
			if ($row[$k]->parent_id == $taisancha[$i]->id ||$row[$k]->taisan_id == $taisancha[$i]->id) $check = 1;
			else $check =0;
			if ($check==1) { $o++;
		?>
		<tr class='success'><td colspan='6' ><b><?php echo $o.'. '.$taisancha[$i]->tenloaitaisan;?></b></td></tr>
		<?php break; }}?>
		
		<?php for($j=0;$j<count($row);$j++){?>
		<?php if($row[$j]->parent_id == $taisancha[$i]->id || $row[$j]->taisan_id == $taisancha[$i]->id){?>
		<tr  class="warning">
			<td><input class='ck_taisan' type='checkbox' style='opacity:1' value='<?php echo $row[$j]->id;?>'></td>
			<td><?php echo $row[$j]->value?></td>
			<td><?php echo $row[$j]->trigia?></td>
			<?php if($row[$j]->parent_id >0) $pr= $row[$j]->parent_id; else $pr=$row[$j]->taisan_id;?>
			<td>
				<span style="cursor:pointer;" class="btn_view_taisan btn btn-mini btn-info" data-toggle="modal" data-target=".modal" pr="<?php echo $pr;?>" taisan_id="<?php echo $row[$j]->id;?>" type="<?php echo $row[$j]->type;?>"><i class="icon-edit"></i></span>
				<span title="" data-placement="top" data-rel="tooltip" class="btn btn-mini xemchitiet" id_ts='<?php echo $row[$j]->id;?>' data-original-title="Chi tiết"><i class="icon-search"></i></span>
			</td>
		</tr>
		<tr style="display:none;" id="row_<?php  echo $row[$j]->id;?>">
			<?php if($row[$j]->type==1){ //nhà?>
			<td colspan='4' style="vertical-align: middle;">
				<div style="clear: both;"></div>
				<div class="row-fluid">
					<div class="span5">
						<div class="control-group">
							<label for="" class="control-label">Loại tài sản</label>
							<div class="controls">
								<div style="padding-top:5px;" class="row-fluid">
									<b class="text-info"><?php echo $row[$j]->tenloaitaisan; ?></b>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span5">
						<div class="control-group">
							<label for="" class="control-label">Loại nhà</label>
							<div class="controls">
								<div style="padding-top:5px;" class="row-fluid">
									<b class="text-info"><?php echo $row[$j]->loainha_name; ?></b>
								</div>
							</div>
						</div>
					</div>
					<div class="span5">
						<div class="control-group">
							<label for="" class="control-label">Cấp công trình</label>
							<div class="controls">
								<div style="padding-top:5px;" class="row-fluid">
									<b class="text-info"><?php echo $row[$j]->capcongtrinh_name; ?></b>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span5">
						<div class="control-group">
							<label for="" class="control-label">Diện tích xây dựng</label>
							<div class="controls">
								<div style="padding-top:5px;" class="row-fluid">
									<b class="text-info"><?php echo $row[$j]->dientich; ?></b>
								</div>
							</div>
						</div>
					</div>
					<div class="span5">
						<div class="control-group">
							<label for="" class="control-label">GCN quyền sở hữu</label>
							<div class="controls">
								<div style="padding-top:5px;" class="row-fluid">
									<b class="text-info"><?php echo $row[$j]->giaychungnhan; ?></b>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span10">
						<div class="control-group">
							<label for="" class="control-label">Thông tin khác</label>
							<div class="controls">
								<div style="padding-top:5px;" class="row-fluid">
									<b class="text-info"><?php echo $row[$j]->thongtinkhac; ?></b>
								</div>
							</div>
						</div>
					</div>
				</div>
			</td>
			<?php }else if($row[$j]->type==2){ //đất?>
			<td colspan='4' style="vertical-align: middle;">
				<div style="clear: both;"></div>
				<div class="row-fluid">
					<div class="span5">
						<div class="control-group">
							<label for="" class="control-label">Loại tài sản</label>
							<div class="controls">
								<div style="padding-top:5px;" class="row-fluid">
									<b class="text-info"><?php echo $row[$j]->tenloaitaisan; ?></b>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span5">
						<div class="control-group">
							<label for="" class="control-label">Diện tích xây dựng</label>
							<div class="controls">
								<div style="padding-top:5px;" class="row-fluid">
									<b class="text-info"><?php echo $row[$j]->dientich; ?></b>
								</div>
							</div>
						</div>
					</div>
					<div class="span5">
						<div class="control-group">
							<label for="" class="control-label">GCN quyền sở hữu</label>
							<div class="controls">
								<div style="padding-top:5px;" class="row-fluid">
									<b class="text-info"><?php echo $row[$j]->giaychungnhan; ?></b>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span5">
						<div class="control-group">
							<label for="" class="control-label">Địa chỉ</label>
							<div class="controls">
								<div style="padding-top:5px;" class="row-fluid">
									<b class="text-info"><?php echo $row[$j]->diachi; ?></b>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span10">
						<div class="control-group">
							<label for="" class="control-label">Thông tin khác</label>
							<div class="controls">
								<div style="padding-top:5px;" class="row-fluid">
									<b class="text-info"><?php echo $row[$j]->thongtinkhac; ?></b>
								</div>
							</div>
						</div>
					</div>
				</div>
			</td>
			<?php }else if($row[$j]->type==0){ //khác ?>
			<td colspan='4' style="vertical-align: middle;">
				<div style="clear: both;"></div>
				<div class="row-fluid">
					<div class="span10">
						<div class="control-group">
							<label for="" class="control-label">Loại tài sản</label>
							<div class="controls">
								<div style="padding-top:5px;" class="row-fluid">
									<b class="text-info"><?php echo $row[$j]->tenloaitaisan; ?></b>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span5">
						<div class="control-group">
							<label for="" class="control-label">Tên tài sản</label>
							<div class="controls">
								<div style="padding-top:5px;" class="row-fluid">
									<b class="text-info"><?php echo $row[$j]->value; ?></b>
								</div>
							</div>
						</div>
					</div>
					<div class="span5">
						<div class="control-group">
							<label for="" class="control-label">Trị giá</label>
							<div class="controls">
								<div style="padding-top:5px;" class="row-fluid">
									<b class="text-info"><?php echo $row[$j]->trigia; ?></b>
								</div>
							</div>
						</div>
					</div>
				</div>
			</td>
			<?php }?>
		</tr>
		<?php }}?>
	<?php } ?>
</table>
</div>
<script type="text/javascript">
jQuery(document).ready(function($){
	$('body').delegate('#alltaisan', 'click', function(){
		$('.ck_taisan').not(this).prop('checked', this.checked);
	});  
	$('.xemchitiet').on('click', function(){
		var id_ts = $(this).attr('id_ts');
		$('#row_'+id_ts).toggle();
	});
});
</script>