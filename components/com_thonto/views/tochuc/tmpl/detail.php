<?php
$user = JFactory::getUser(); 
?>
<div class="widget-box transparent">
	<div class="widget-header">
		<h5>Thông tin tổ chức</h5>
		<div class="widget-toolbar no-border">
			<div class="btn-group" id="div_sapxep">
				<button class="btn btn-small bigger btn-purple dropdown-toggle" data-toggle="dropdown">
					Sắp xếp
					<i class="icon-angle-down icon-on-right"></i>
				</button>
				<ul class="dropdown-menu pull-right dropdown-caret dropdown-close">
					<li>
						<a id="btnOrderUp" href="index.php?option=com_thonto&controller=tochuc&task=orderup&id=<?php echo $this->row->id;?>">
							Lên
						</a>
					</li>
					<li>
						<a id="btnOrderDown" href="index.php?option=com_thonto&controller=tochuc&task=orderdown&id=<?php echo $this->row->id;?>">
							Xuống
						</a>
					</li>
				</ul>
			</div>
			<div class="btn-group" id="div_thaotac">
				<button class="btn btn-small bigger btn-primary dropdown-toggle" data-toggle="dropdown">
					Nghiệp vụ quản lý
					<i class="icon-angle-down icon-on-right"></i>
				</button>
				<ul class="dropdown-menu pull-right dropdown-caret dropdown-close">
					<li><a href="index.php?option=com_thonto&controller=tochuc&task=thanhlap&id=<?php echo $this->row->id;?>">Hiệu chỉnh</a></li>
					<?php  if ($this->row->kieu == 4 || $this->row->kieu ==5){?>
					<li><a id="btn_nghiepvu_lichsu">Lịch sử</a></li>
					<?php }?>
					<?php  if ($this->row->kieu == 3){?>
					<li><a id="btn_nghievu_soluongkhongchuyentrach">Số lượng không chuyên trách</a></li>
					<?php }?>
					<li><a id="btnXoaThonto">Xóa</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="widget-body">
		<div class="widget-main padding-6 no-padding-left no-padding-right">
			<div class="tabbable" id="tabs">
				<ul class="nav nav-tabs" id="myTab4">
					<li class="active"><a data-toggle="tab" href="#info">Thông tin chung</a></li>
					<?php  if ($this->row->kieu == 3){?>
					<li><a data-toggle="tab" href="#khongchuyentrach">Số lượng người hoạt động không chuyên trách</a></li>
					<?}?>
					<?php  if ($this->row->kieu == 4 || $this->row->kieu ==5){?>
					<li><a data-toggle="tab" href="#lichsu">Lịch sử</a></li>
					<?}?>
				</ul>
				<div class="tab-content">
					<div id="info" class="tab-pane active">
					<?php if ($this->row->kieu == 4 || $this->row->kieu == 5) {// 4,5 Thôn tổ?>
						<fieldset>
						<legend>Thông tin chung</legend>				
						<table width="100%">
						<tbody>
							<tr>
								<th align="left" valign="top" nowrap="nowrap" >Tên </th>
								<td width="40%"><b><?php echo $this->row->ten; ?></b></td>
								<th align="left" valign="top" nowrap="nowrap">Tên viết tắt </th>
								<td><?php echo $this->row->tenviettat; ?></td>
							</tr>
							<tr>
								<th align="left" valign="top" nowrap="nowrap">Phường/xã quản lý </th>
								<td><?php echo $this->row->tenpx; ?></td>
								<th align="left" valign="top" nowrap="nowrap" >Chi bộ quản lý </th>
								<td><?php echo $this->row->tenchibo; ?></td>
							</tr>
							<tr>
								<th align="left" valign="top" nowrap="nowrap" >Số Quyết định thành lập </th>
								<td  width="40%"><?php echo $this->row->soquyetdinhthanhlap; ?></td>
								<th align="left" valign="top" nowrap="nowrap">Ngày Quyết định thành lập </th>
								<td><?php  if($this->row->ngayquyetdinhthanhlap!=null) echo date('d/m/Y', strtotime($this->row->ngayquyetdinhthanhlap));?></td>
							</tr>
							<tr>
								
								<th align="left" valign="top" nowrap="nowrap" >Tổng số dân </th>
								<td><?php echo $this->row->tongsodan; ?></td>
								<th align="left" valign="top" nowrap="nowrap">Tổng số hộ </th>
								<td><?php echo $this->row->tongsoho; ?></td>
							</tr>
							<tr>
								
								<th align="left" valign="top" nowrap="nowrap">Diện tích tự nhiên </th>
								<td><?php echo $this->row->dientichtunhien; ?></td>
							</tr>
						</tbody>
					</table>
					</fieldset>
					<fieldset>
					<legend>Trạng thái</legend>
						<table width="100%">
						<tbody>
							<tr>
								<th align="left" valign="top" nowrap="nowrap">Trạng thái </th>
								<td  width="40%"><span class="label label-success arrowed-in arrowed-in-right"><?php if ($this->row->trangthai_id==1) echo 'Đang hoạt động'; else echo'Ngưng hoạt động'?></span></td>
								<th align="left" valign="top" nowrap="nowrap" >Ghi chú </th>
								<td  width="40%"><?php echo  ($this->row->ghichu); ?></td>
							</tr>
						</tbody>
						</table>
					</fieldset>				
						<?php 
					}else if ($this->row->kieu == 3) {		// 3 Phường?>						
						<legend>Thông tin chung</legend>			
						<table width="100%">
							<tbody>
								<tr>
									<th align="left" valign="top" nowrap="nowrap" >Tên </th>
									<td width="40%"><b><?php echo $this->row->ten; ?></b></td>
									<th align="left" valign="top" nowrap="nowrap" >Tên viết tắt </th>
									<td  width="40%"><?php echo $this->row->tenviettat; ?></td>
								</tr>					
								<tr>
									<th align="left" valign="top" nowrap="nowrap" >Cán bộ quản lý </th>
									<td width="40%"><?php echo  ($this->row->tencanbo); ?></td>
								</tr>					
							</tbody>
						</table>
						<fieldset>
						<legend>Trạng thái</legend>
							<table width="100%">
							<tbody>
								<tr>
									<th align="left" valign="top" nowrap="nowrap">Trạng thái</th>
									<td  width="40%"><span class="label label-success arrowed-in arrowed-in-right"><?php if ($this->row->trangthai_id==1) echo 'Đang hoạt động'; else echo'Ngưng hoạt động'?></span></td>
									<th align="left" valign="top" nowrap="nowrap" >Ghi chú</th>
									<td  width="40%"><?php echo  ($this->row->ghichu); ?></td>
								</tr>
							</tbody>
							</table>
						</fieldset>
						<?php }
						else if ($this->row->kieu == 1 || $this->row->kieu == 2) {// 12 Vỏ chứa, quận huyện?>
						<legend>Thông tin chung</legend>			
						<table width="100%">
							<tbody>
								<tr>
									<th align="left" valign="top" nowrap="nowrap" >Tên </th>
									<td width="40%"><b><?php echo $this->row->ten; ?></b></td>
									<th align="left" valign="top" nowrap="nowrap" >Tên viết tắt </th>
									<td  width="40%"><?php echo $this->row->tenviettat; ?></td>
								</tr>					
							</tbody>
						</table>
						<fieldset>
						<legend>Trạng thái</legend>
							<table width="100%">
							<tbody>
								<tr>
									<th align="left" valign="top" nowrap="nowrap">Trạng thái</th>
									<td  width="40%"><span class="label label-success arrowed-in arrowed-in-right"><?php if ($this->row->trangthai_id==1) echo 'Đang hoạt động'; else echo'Ngưng hoạt động'?></span></td>
									<th align="left" valign="top" nowrap="nowrap" >Ghi chú</th>
									<td  width="40%"><?php echo  ($this->row->ghichu); ?></td>
								</tr>
							</tbody>
							</table>
						</fieldset>
					<?php }?>
					</div>
					<!--  -->
					<div id="khongchuyentrach" class="tab-pane">
						<table width="100%">
							<tbody>
								<tr>
									<th align="left" valign="top" nowrap="nowrap" >Tổ trưởng/trưởng thôn</th>
									<td width="40%"><?php if(isset($this->row_soluongkhongchuyentrach)) echo $this->row_soluongkhongchuyentrach->thonto_truong; else echo '0';?></td>
									<th align="left" valign="top" nowrap="nowrap">Phó thôn(đối với xã)</th>
									<td width="40%"><?php if(isset($this->row_soluongkhongchuyentrach)) echo $this->row_soluongkhongchuyentrach->thonto_pho;  else echo '0';?></td>
								</tr>
								<tr>
									<th align="left" valign="top" nowrap="nowrap" >Bí thư</th>
									<td><?php if(isset($this->row_soluongkhongchuyentrach)) echo $this->row_soluongkhongchuyentrach->chibo_bithu;  else echo '0';?></td>
									<th align="left" valign="top" nowrap="nowrap">Phó bí thư </th>
									<td><?php if(isset($this->row_soluongkhongchuyentrach)) echo $this->row_soluongkhongchuyentrach->chibo_phobithu;  else echo '0';?></td>
								</tr>
								<tr>
									<th align="left" valign="top" nowrap="nowrap" >Trưởng ban</th>
									<td width="40%"><?php if(isset($this->row_soluongkhongchuyentrach)) echo $this->row_soluongkhongchuyentrach->bancongtac_truongban;  else echo '0';?></td>
									<th align="left" valign="top" nowrap="nowrap">Phó ban </th>
									<td><?php if(isset($this->row_soluongkhongchuyentrach)) echo $this->row_soluongkhongchuyentrach->bancongtac_phoban; else echo '0'; ?></td>
								</tr>
								<tr>
									<th align="left" valign="top" nowrap="nowrap" >Chi hội Phụ nữ </th>
									<td width="40%"><?php if(isset($this->row_soluongkhongchuyentrach)) echo $this->row_soluongkhongchuyentrach->chihoiphunu; else echo '0'; ?></td>
									<th align="left" valign="top" nowrap="nowrap">Chi hội Cựu chiến binh </th>
									<td><?php if(isset($this->row_soluongkhongchuyentrach)) echo $this->row_soluongkhongchuyentrach->chihoicuuchienbinh;  else echo '0';?></td>
								</tr>
								<tr>
									<th align="left" valign="top" nowrap="nowrap" >Bí thư Chi đoàn TNCSHCM  </th>
									<td width="40%"><?php if(isset($this->row_soluongkhongchuyentrach)) echo $this->row_soluongkhongchuyentrach->bithudoantn; else echo '0'; ?></td>
									<th align="left" valign="top" nowrap="nowrap">Chi hội Nông dân </th>
									<td><?php if(isset($this->row_soluongkhongchuyentrach)) echo $this->row_soluongkhongchuyentrach->chihoinongdan;  else echo '0';?></td>
								</tr>
								<tr>
									<th align="left" valign="top" nowrap="nowrap" >Tổ dân vận</th>
									<td width="40%"><?php if(isset($this->row_soluongkhongchuyentrach)) echo $this->row_soluongkhongchuyentrach->todanvan;  else echo '0';?></td>
									<th align="left" valign="top" nowrap="nowrap">Bảo vệ Dân phố </th>
									<td><?php if(isset($this->row_soluongkhongchuyentrach)) echo $this->row_soluongkhongchuyentrach->baovedanpho; else echo '0'; ?></td>
								</tr>
								<tr>
									<th align="left" valign="top" nowrap="nowrap" >Công an viên  </th>
									<td width="40%"><?php if(isset($this->row_soluongkhongchuyentrach)) echo $this->row_soluongkhongchuyentrach->conganvien;  else echo '0';?></td>
								</tr>
							</tbody>
						</table>
					</div> <!-- end tab Không chuyên trách -->
					<div id="lichsu" class="tab-pane">
						âsdasd
					</div> <!-- end tab lịch sử -->
				</div>  <!-- tab-content -->
			</div>
		</div>
	</div>
</div>
<script>
jQuery(document).ready(function($){
	$('#btnXoaThonto').on('click',function(){
		if(confirm("Bạn có muốn xóa không?")){
			if(confirm("Bạn có muốn xóa mục này không?")){
		  				jQuery.ajax({
			  				  type: "GET",
			  				  url: 'index.php?option=com_thonto&view=tochuc&task=checkhoso&format=raw&id='+<?php echo $this->row->id;?>,	
				  				success: function (data){
					  				  $.unblockUI();
					  				  if(data == true)
						  				window.location.href="index.php?option=com_thonto&controller=tochuc&task=xoathonto&id=<?php echo $this->row->id;?>";
					  				  else loadNoticeBoardError('Thông báo', 'Đơn vị còn tồn tại hồ sơ, bạn không thể xóa!');
					  			  }
					  		});
			}	
		}
		return false;
	});
	$('#btn_nghievu_soluongkhongchuyentrach').on('click', function(){
		$('#com_thonto_viewdetail').hide();
		$('#div_soluongkhongchuyentrach').show();
		$('#div_soluongkhongchuyentrach').load('index.php?option=com_thonto&view=tochuc&task=soluongkhongchuyentrach&format=raw&id='+<?php echo $this->row->id;?>, function(){
		 	$('#tendonvi').val($('.jstree-clicked').text());
		  	$('#thonto_id').val(id);
		});
	});
	
	$('#btn_nghiepvu_lichsu').on('click', function(){
		$('#com_thonto_viewdetail').hide();
		$('#div_lichsu').show();
		$('#div_lichsu').load('index.php?option=com_thonto&view=tochuc&task=lichsu&format=raw&id='+<?php echo $this->row->id;?>, function(){
			$('#tendonvi').val($('.jstree-clicked').text());
			$('#thonto_id').val(id);
		});

	});
});
</script>