<h3 class="row-fluid header smaller lighter green">
	<span class="span6">Khen thưởng kỷ luật</span>
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
      <div class="accordion-inner" id="form-khenthuongkyluat"></div>
    </div>
	</div>
	<div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#tochuc-quatrinh-manager-accordion" href="#tochuc-quatrinh-manager-collapse-two">
         Thông tin khen thưởng, kỷ luật
      </a>
    </div>
    <div id="tochuc-quatrinh-manager-collapse-two" class="accordion-body collapse in">
      <div class="accordion-inner">
      	<h3 class="row-fluid header smaller lighter blue">
			<span class="span7">Quá trình khen thưởng</span>
			<span class="span5">
			<span class="pull-right inline">
					<button  id="btnAddKhenthuong" class="btn btn-mini btn-success"><i class="icon-plus"></i> Thêm mới</button>	
			</span>		
			</span> 
		</h3>
      	<table class="table table-striped table-bordered">
			<thead>
				<tr>					
					<th style="width:10%" >Từ ngày</th>					
					<th style="width:10%">Đến ngày</th>			
					<th style="width:20%">Hình thức</th>
					<th style="width:20%">Lý do</th>
					<th style="width:10%">Số QĐ</th>
					<th style="width:10%">Cơ quan QĐ</th>
					<th style="width:10%">Người ký</th>
					<th style="width:10%">Ngày ký</th>
					<th>#</th>
				</tr>					
			</thead>
			<tbody>
				<?php
				for ($i = 0; $i < count($this->quatrinh_khenthuong); $i++) {
					$row = $this->quatrinh_khenthuong[$i];
					?>
					<tr>
						<td><?php echo date('d/m/Y',strtotime($row->start_date_kt));?></td>			
						<td><?php if ((isset($row->end_date_kt)) && ($row->end_date_kt!=null) && ($row->end_date_kt!='0000-00-00')) echo date('d/m/Y',strtotime($row->end_date_kt));?></td>			
						<td><?php echo $row->hinhthuc;?></td>			
						<td><?php echo $row->reason_kt;?></td>			
						<td><?php echo $row->approv_number_kt;?></td>			
						<td><?php echo $row->approv_unit_kt;?></td>			
						<td><?php echo $row->approv_per_kt;?></td>			
						<td><?php if ((isset($row->approv_date_kt)) && ($row->approv_date_kt!= null)) echo date('d/m/Y',strtotime($row->approv_date_kt));?></td>			
						<td nowrap="nowrap">
							<a class="btn btn-mini btn-info btnEditQuatrinh" href="index.php?option=com_tochuc&controller=tochuc&task=editkhenthuong&format=raw&id=<?php echo $row->id_kt ?>"><i class="icon-pencil"></i></a>				
							<a class="btn btn-mini btn-danger btnDeleteQuatrinh" task="removekhenthuong" id_qt="<?php echo $row->id_kt ?>"><i class="icon-trash"></i></a>
						</td>
					</tr>
					<?php 
				} 
				?>
			</tbody>
		</table>
		<h3 class="row-fluid header smaller lighter blue">
			<span class="span7">Quá trình kỷ luật</span>
			<span class="span5">
			<span class="pull-right inline">
					<button id="btnAddKyluat" class="btn btn-mini btn-success"><i class="icon-plus"></i> Thêm mới</button>	
			</span>		
			</span> 
		</h3>
		<table class="table table-striped table-bordered">
			<thead>
				<tr>					
					<th style="width:10%" >Từ ngày</th>					
					<th style="width:10%">Đến ngày</th>			
					<th style="width:20%">Hình thức</th>
					<th style="width:20%">Lý do</th>
					<th style="width:10%">Số QĐ</th>
					<th style="width:10%">Cơ quan QĐ</th>
					<th style="width:10%">Người ký</th>
					<th style="width:10%">Ngày ký</th>
					<th>#</th>
				</tr>					
			</thead>
			<tbody>
				<?php
				for ($i = 0; $i < count($this->quatrinh_kyluat); $i++) {
					$row = $this->quatrinh_kyluat[$i];
					?>
					<tr>
						<td><?php echo date('d/m/Y',strtotime($row->start_date_kl));?></td>			
						<td><?php if ((isset($row->end_date_kl)) && ($row->end_date_kl!=null) && ($row->end_date_kl!='0000-00-00')) echo date('d/m/Y',strtotime($row->end_date_kl));?></td>			
						<td><?php echo $row->hinhthuc;?></td>			
						<td><?php echo $row->reason_kl;?></td>
						<td><?php echo $row->approv_number_kl;?></td>			
						<td><?php echo $row->approv_unit_kl;?></td>			
						<td><?php echo $row->approv_per_kl;?></td>			
						<td><?php if ((isset($row->approv_date_kl)) && ($row->approv_date_kl!= null)) echo date('d/m/Y',strtotime($row->approv_date_kl));?></td>			
						<td nowrap="nowrap">
							<a class="btn btn-mini btn-info btnEditQuatrinh" href="index.php?option=com_tochuc&controller=tochuc&task=editkyluat&format=raw&ht=2&id=<?php echo $row->id_kl ?>"><i class="icon-pencil"></i></a>				
							<a class="btn btn-mini btn-danger btnDeleteQuatrinh" task="removekyluat" id_qt="<?php echo $row->id_kl ?>" ><i class="icon-trash"></i></a>
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
	var initPage = function(){
		$(".sidebar").addClass('menu-min');
		$("#module-left").hide();
		$('#btnAddKhenthuong').click(function(){
// 		$('body').delegate('#btnAddKhenthuong', 'click', function(){
			$("#form-khenthuongkyluat").load('index.php?option=com_tochuc&controller=tochuc&task=editkhenthuong&format=raw&dept_id=<?php echo $this->item->id;?>&time=<?php echo time();?>');
			$('#tochuc-bienche-manager-collapse-one').collapse('show');
			$('#tochuc-quatrinh-manager-collapse-two').collapse('hide');	
		});
		$('#btnAddKyluat').click(function(){
// 		$('body').delegate('#btnAddKyluat', 'click', function(){
			$("#form-khenthuongkyluat").load('index.php?option=com_tochuc&controller=tochuc&task=editkyluat&format=raw&dept_id=<?php echo $this->item->id;?>&time=<?php echo time();?>');
			$('#tochuc-bienche-manager-collapse-one').collapse('show');
			$('#tochuc-quatrinh-manager-collapse-two').collapse('hide');	
		});
		 $('.btnDeleteQuatrinh').click(function(){	
			 if (confirm('Bạn có muốn xóa không?')) {
				 var id_qt = $(this).attr('id_qt');
				 var task = $(this).attr('task');
			        $.ajax({
			            url: '<?php echo JUri::base(true);?>/index.php?option=com_tochuc&controller=tochuc&format=raw&task='+task,
			            type: "POST",
			            data:{ id: id_qt},
			            success: function (data) {
			                if (data == true){
			                	loadNoticeBoardSuccess('Thông báo', 'Thao tác thành công!');
			                	$.blockUI();
			                	jQuery.ajax({
					  				  type: "GET",
					  				  url: 'index.php?option=com_tochuc&task=khenthuongkyluat&format=raw&Itemid=<?php echo $this->Itemid;?>&id=<?php echo $this->item->id;?>',	
						  				success: function (data,textStatus,jqXHR){
							  				  $.unblockUI();
							  				  $('#com_tochuc_viewdetail').html(data);
							  			  }
							  		});
			            	}
			                else loadNoticeBoardError('Thông báo', 'Có lỗi xảy ra, vui lòng liên hệ quản trị viên!');
			        }
			        });
			    } return false;
		 });
		$('.btnEditQuatrinh').click(function(){
			jQuery.ajax({
				  type: "GET",
				  url: this.href,	
				  beforeSend: function(){
					  $.blockUI();
					  $('#form-khenthuongkyluat').empty();
					},
				  success: function (data,textStatus,jqXHR){
					  $.unblockUI();
					  $('#form-khenthuongkyluat').html(data);
					  $('#tochuc-bienche-manager-collapse-one').collapse('show');
					  $('#tochuc-quatrinh-manager-collapse-two').collapse('hide');
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