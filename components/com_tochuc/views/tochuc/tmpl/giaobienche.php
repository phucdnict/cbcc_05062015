<h3 class="row-fluid header smaller lighter green">
	<span class="span6">Quá trình biên chế</span>
	<span class="span6">
		<span class="pull-right inline">
			<a id="btnBack" class="btn btn-mini btn-info" href="index.php?option=com_tochuc&controller=tochuc&task=detail&format=raw&Itemid=<?php echo $this->Itemid;?>&id=<?php echo $this->item->id;?>">← Quay về</a>		
		</span>										
	</span>	 
</h3>
<div class="accordion" id="tochuc-bienche-manager-accordion">
	<div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="tochuc-bienche-manager-accordion" href="#tochuc-bienche-manager-collapse-one">
       Nghiệp vụ
      </a>
    </div>
    <div id="tochuc-bienche-manager-collapse-one" class="accordion-body collapse">
      <div class="accordion-inner" id="form-giaobienche"></div>
    </div>
	</div>
	<div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#tochuc-quatrinh-manager-accordion" href="#tochuc-quatrinh-manager-collapse-two">
         Danh sách quá trình
      </a>
    </div>
    <div id="tochuc-quatrinh-manager-collapse-two" class="accordion-body collapse in">
      <div class="accordion-inner">
		<table class="table table-striped table-bordered">
			<thead>
				<tr>					
					<th>Năm</th>
					<th>Nghiệp vụ</th>				
					<th>Quyết định</th>
					<th>Chi tiết</th>										
					<th width="90%">Ghi chú</th>
					<th>#</th>
				</tr>					
			</thead>
			<tbody>
				<?php
				for ($i = 0; $i < count($this->quatrinh_bienche); $i++) {
					$row = $this->quatrinh_bienche[$i];
					$vanban = TochucHelper::getVanBanById($row['vanban_id']);				
					//var_dump($vanban);
					if ($vanban != null) {
						if (Core::loadResult('core_attachment', 'COUNT(*)', array('object_id='=>$vanban['id'],'type_id='=>1))> 0 ) {
							if ($vanban['mahieu'] == '') {
								$vanban['mahieu'] = "Tập tin đính kèm";
							}else {
								$vanban['mahieu'] = $vanban['mahieu'];
							}
							$vanban['mahieu'] = '<a href="'.JUri::root(true).'/uploader/index.php?download=1&type_id=1&object_id='.$vanban['id'].'" target="_blank">'.$vanban['mahieu'].'</a>';
						}
					}else{
						$vanban = array();
					}		
					?>
					<tr>
						<td nowrap="nowrap"><?php echo $row['nam'];?></td>					
						<td nowrap="nowrap"><?php echo TochucHelper::getNameById($row['nghiepvu_id'], 'ins_nghiepvu_bienche','nghiepvubienche','id');?></td>
						<td nowrap="nowrap"><?php echo $vanban['mahieu'];?></td>
						<td nowrap="nowrap">
						<ol>
						<?php
						$bienche = TochucHelper::getQuatrinhBiencheChiTietByQuatrinhId($row['id']);
						for ($j = 0; $j < count($bienche); $j++) {
							?>
							<li><?php echo $bienche[$j]['name']; ?>:<?php echo $bienche[$j]['bienche']; ?></li>
							<?php 
						}
						?>
						</ol>
						</td>
						<td><?php echo $row['ghichu'];?></td>						
						<td nowrap="nowrap">
							<a class="btn btn-mini btn-info btnEditQuatrinh" href="index.php?option=com_tochuc&controller=tochuc&task=editgiaobienche&format=raw&id=<?php echo $row['id'] ?>"><i class="icon-pencil"></i></a>				
							<a class="btn btn-mini btn-danger btnDeleteQuatrinh" href="index.php?option=com_tochuc&controller=tochuc&task=delgiaobienche&id=<?php echo $row['id'] ?>"><i class="icon-trash"></i></a>
						</td>
						
					</tr>
					<?php 
				} 
				?>
			</tbody>
		</table>
      </div>
    </div>
  </div>
</div>

<script>
jQuery(document).ready(function($){	
	//$('#spinner-0').ace_spinner({value:0,min:0,max:200,step:10, btn_up_class:'btn-info' , btn_down_class:'btn-info'});	
	var initPage = function(){
		jQuery("#form-giaobienche").load('index.php?option=com_tochuc&controller=tochuc&task=editgiaobienche&format=raw&dept_id=<?php echo $this->item->id;?>&time=<?php echo time();?>');
		 $('.btnDeleteQuatrinh').click(function(){	
			 return confirm('Bạn có muốn xóa không?');
		 });
		$('.btnEditQuatrinh').click(function(){
			var htmlLoading = '<i class="icon-spinner icon-spin blue bigger-125"></i>';
			jQuery.ajax({
				  type: "GET",
				  url: this.href,	
				  beforeSend: function(){
					  $.blockUI();
					  $('#form-giaobienche').empty();
					},
				  success: function (data,textStatus,jqXHR){
					  $.unblockUI();
					  $('#form-giaobienche').html(data);
					  $('#tochuc-bienche-manager-collapse-one').collapse('show');
				  }
			});			
			return false;	
		});
		$('#btnBack').click(function(){
			var htmlLoading = '<i class="icon-spinner icon-spin blue bigger-125"></i>';
			jQuery.ajax({
				  type: "GET",
				  url: this.href,	
				  beforeSend: function(){
					  $.blockUI();
					  $('#com_tochuc_viewdetail').empty();
					},
				  success: function (data,textStatus,jqXHR){
					  $.unblockUI();
					  $('#com_tochuc_viewdetail').html(data);
				  }
			});
			return false;
		});			
	};
	initPage();
});	
</script>
