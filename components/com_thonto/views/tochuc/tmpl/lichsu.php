<?php
$user = JFactory::getUser();
?>
<h3 class="row-fluid header smaller lighter green">
	<span class="span6">Lịch sử tổ chức </span>
	<span class="span6">
		<span class="pull-right inline">
			<a class="btn btn-mini btn-success" id="btn_add_lichsu"><i class="icon-plus"></i> Thêm mới</a>

			<a id="btnBack_lichsu" class="btn btn-mini btn-info">← Quay về</a>		
		</span>	
	</span>
</h3>
<div class="accordion" id="thonto-quatrinh-manager-accordion">
	<div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="thonto-quatrinh-manager-accordion" href="#thonto-quatrinh-manager-collapse-one">
        Nghiệp vụ
      </a>
    </div>
    <div id="thonto-quatrinh-manager-collapse-one" class="accordion-body collapse">
      <div class="accordion-inner" id="div_frm_lichsu">
			
      </div>
    </div>
  </div>
  	<div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#thonto-quatrinh-manager-accordion" href="#thonto-quatrinh-manager-collapse-two">
         Danh sách quá trình
      </a>
    </div>
    <div id="thonto-quatrinh-manager-collapse-two" class="accordion-body collapse in">
      <div class="accordion-inner">
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Ngày quyết định</th>					
					<th>Ngày hiệu lực</th>					
					<th>Cách thức</th>				
					<th>Quyết định</th>					
					<th>Chi tiết</th>
					<th>Ghi chú</th>
					<th>#</th>
				</tr>					
			</thead>
			<tbody>
				<?php
				for ($i = 0; $i < count($this->rows); $i++) {
					$row = $this->rows[$i];
					$vanban = thontoHelper::getVanBanById($row['vanban_id']);
					//var_dump($vanban['mahieu']);
					if ($vanban != null) {
						if (Core::loadResult('core_attachment', 'COUNT(*)', array('object_id='=>$vanban['id'],'type_id='=>1))> 0 ) {
							$vanban['mahieu'] = '<a href="'.JUri::root(true).'/uploader/index.php?download=1&type_id=1&object_id='.$vanban['id'].'" target="_blank">'.$vanban['mahieu'].'</a>';
						}
					}else{
						$vanban = array();
					}
					?>
					<tr>
						<td><?php echo $row['quyetdinh_ngay'];?></td>					
						<td><?php echo ($nhl =$row['hieuluc_ngay']=='0000-00-00' ? "":date('d/m/Y', strtotime($row['hieuluc_ngay'])));?></td>					
						<td><?php echo thontoHelper::getNameById($row['cachthuc_id'], 'ins_dept_cachthuc');?></td>
						<td><?php echo $vanban['mahieu'];?></td>						
						<td><?php echo $row['chitiet'];?></td>
						<td><?php echo $row['ghichu'];?></td>						
						<td nowrap="nowrap">
							<button class="btn btn-mini btn-info btnEditQuatrinh" data-quatrinh-id="<?php echo $row['id'] ?>"><i class="icon-pencil"></i></button>				
							<a class="btn btn-mini btn-danger btnDeleteQuatrinh" href="index.php?option=com_thonto&controller=thonto&task=delquatrinh&id=<?php echo $row['id'] ?>"><i class="icon-trash"></i></a>							
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

<script type="text/javascript">
jQuery(document).ready(function($){
	$('#btnBack_lichsu').on('click', function(){
		$('#com_thonto_viewdetail').show();
		$('#div_lichsu').hide();
	});
	var initPage = function(){
		$('.chzn-select').chosen({
			allow_single_deselect: true,
            no_results_text: 'Không tìm thấy'
        });
		$('.input-mask-date').mask('99/99/9999');

		$('.btnDeleteQuatrinh').click(function(){	
		 return confirm('Bạn có muốn xóa không?');
		});
		$('#btn_add_lichsu').on('click', function(){
			$('#div_frm_lichsu').load('index.php?option=com_thonto&view=tochuc&task=editlichsu&format=raw', function(){
				$('#thonto-quatrinh-manager-collapse-one').collapse('show');
				$('#thonto-quatrinh-manager-collapse-hide').collapse('hide');
			});
		});
		$('.btnEditQuatrinh').click(function(){
			var url = '<?php echo JUri::root(true)?>/index.php?option=com_thonto&controller=thonto&format=raw&task=readquatrinh';
			$('#thonto-quatrinh-manager-collapse-one').collapse('show');
		});		   
	};
	initPage();
});
</script>