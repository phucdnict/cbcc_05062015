<?php
/*
 * Thông tin tổ chức
 */
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
					<a id="btnOrderUp" href="index.php?option=com_tochuc&controller=tochuc&task=orderup&id=<?php echo $this->row->id;?>">
						Lên
					</a>
				</li>
				<li>
					<a id="btnOrderDown" href="index.php?option=com_tochuc&controller=tochuc&task=orderdown&id=<?php echo $this->row->id;?>">
						Xuống
					</a>
				</li>
			</ul>
		</div>
		<div class="btn-group" id="div_thaotac">
			<button class="btn btn-small bigger btn-primary dropdown-toggle" data-toggle="dropdown">
				Quản lý tổ chức
				<i class="icon-angle-down icon-on-right"></i>
			</button>
			<ul class="dropdown-menu pull-right dropdown-caret dropdown-close">
			<?php if($this->row->type != 2){?>
				<?php if(Core::_checkPerAction($user->id, 'com_tochuc','tochuc','quatrinh','site',$this->row->id)){ ?>
				<li>
					<a id="bntQuaTrinh" href="index.php?option=com_tochuc&task=quatrinh&format=raw&Itemid=<?php echo $this->Itemid;?>&id=<?php echo $this->row->id;?>">
						Lịch sử tổ chức
					</a>
				</li>
				<?php } ?>
				<?php if(Core::_checkPerAction($user->id, 'com_tochuc','tochuc','giaobienche','site',$this->row->id)){ ?>
				<li>
					<a id="bntGiaobienche"	href="index.php?option=com_tochuc&task=giaobienche&format=raw&Itemid=<?php echo $this->Itemid;?>&id=<?php echo $this->row->id;?>">
						Quá trình biên chế
					</a>
				</li>
				<?php } ?>
				<?php if(Core::_checkPerAction($user->id, 'com_tochuc','tochuc','khenthuongkyluat','site',$this->row->id)){ ?>
				<li>
					<a id="bntKhenthuongkyluat"	href="index.php?option=com_tochuc&task=khenthuongkyluat&format=raw&Itemid=<?php echo $this->Itemid;?>&id=<?php echo $this->row->id;?>">
						Quá trình khen thưởng kỷ luật
					</a>
				</li>
				<?php } ?>
			<?php } ?>
				<?php if(Core::_checkPerAction($user->id, 'com_tochuc','tochuc','thanhlap','site',$this->row->id)){ ?>
				<li><a href="index.php?option=com_tochuc&task=thanhlap&Itemid=<?php echo $this->Itemid;?>&id=<?php echo $this->row->id;?>">Hiệu chỉnh</a></li>
				<?php } ?>
				<?php if(Core::_checkPerAction($user->id, 'com_tochuc','tochuc','giaithe','site',$this->row->id)){?>
				<!-- li>
					<a id="btnGiaithe" href="index.php?option=com_tochuc&task=giaithe&id=<?php echo $this->row->id;?>">
						Giải thể
					</a>
				</li -->
				<?php }	?>
				<?php if(Core::_checkPerAction($user->id, 'com_tochuc','tochuc','deletedept','site',$this->row->id)){ ?>
				<li><a id="btnXoa">Xóa</a></li>
				<?php }?>
			</ul>
		</div>
	</div>
</div>
	<div class="widget-body">
		<div class="widget-main padding-6 no-padding-left no-padding-right">
<div class="tabbable" id="tabs">
	<ul class="nav nav-tabs" id="myTab4">
		<li class="active"><a data-toggle="tab" href="#info">Thông tin chung</a></li>
		<?php
		if($this->row->type != 2){ 
		?>
		<?php if(Core::_checkPerAction($user->id, 'com_tochuc','tochuc','quatrinh','site',$this->row->id)){ ?>
			<li><a data-toggle="tab" href="#tochuc-quatrinh">Lịch sử tổ chức</a></li>
		<?php } ?>
		<?php if(Core::_checkPerAction($user->id, 'com_tochuc','tochuc','giaobienche','site',$this->row->id)){ ?>
			<li><a data-toggle="tab" href="#tochuc-bienche">Quá trình giao biên chế</a></li>
		<?php } ?>
		<?php if(Core::_checkPerAction($user->id, 'com_tochuc','tochuc','khenthuongkyluat','site',$this->row->id)){ ?>
			<li><a data-toggle="tab" href="#tochuc-khenthuongkyluat">Quá trình khen thưởng kỷ luật</a></li>
		<?php } ?>
		<?php
		 }
		?>
		</ul>
	<div class="tab-content">
		<div id="info" class="tab-pane active">
		<table width="100%">
				<tbody>
					<tr>
						<th align="left" valign="top" nowrap="nowrap">Thuộc cây đơn vị</th>
						<td width="40%"><?php echo Core::loadResult('ins_dept', array('name'), array('id='=>(int)$this->row->parent_id));?></td>
						<th align="left" valign="top" nowrap="nowrap">Loại</th>
						<td  width="40%"><span class="label label-warning arrowed arrowed-right"><?php echo Core::loadResult('ins_type', array('name'), array('id='=>(int)$this->row->type));?></span></td>
					</tr>
				</tbody>
		</table>
		<?php
			if ($this->row->type == 1 || $this->row->type == 3) {
				?>
				<fieldset>
				<legend>Thông tin chung</legend>				
				<table width="100%">
				<tbody>
					<tr>
						<th align="left" valign="top" nowrap="nowrap" >Tên</th>
						<td width="40%"><?php echo $this->row->name; ?></td>
						<th align="left" valign="top" nowrap="nowrap" >Mã</th>
						<td  width="40%"><?php echo $this->row->code; ?></td>
					</tr>
					<tr>
						<th align="left" valign="top" nowrap="nowrap">Tên viết tắt</th>
						<td><?php echo $this->row->s_name; ?></td>
						<th align="left" valign="top" nowrap="nowrap" >Tên tiếng anh</th>
						<td><?php echo $this->row->eng_name; ?></td>
					</tr>
					<tr>
						<th align="left" valign="top" nowrap="nowrap">Mã số thuế</th>
						<td><?php echo $this->row->masothue; ?></td>
						<th align="left" valign="top" nowrap="nowrap">Mã số Tabmis</th>
						<td><?php echo $this->row->masotabmis; ?></td>
					</tr>
					<tr>
						<th align="left" valign="top" nowrap="nowrap">Địa chỉ</th>
						<td><?php echo $this->row->diachi; ?></td>
						<th align="left" valign="top" nowrap="nowrap">Điện thoại</th>
						<td><?php echo $this->row->dienthoai; ?></td>
					</tr>
					<tr>
						<th align="left" valign="top" nowrap="nowrap">Email</th>
						<td><?php echo $this->row->email; ?></td>
						<th align="left" valign="top" nowrap="nowrap">Fax</th>
						<td><?php echo $this->row->fax; ?></td>
					</tr>
					<tr>
						<th align="left" valign="top" nowrap="nowrap">Ngày thành lập</th>
						<td><?php echo $this->row->date_created; ?></td>
						<th align="left" valign="top" nowrap="nowrap">Phụ cấp đặc thù</th>
						<td><?php echo $this->row->phucapdacthu; ?></td>
					</tr>	
					<tr>
						<th align="left" valign="top" nowrap="nowrap">Chức năng nhiệm vụ</th>
						<td><?php echo $this->row->chucnang; ?></td>
						<th align="left" valign="top" nowrap="nowrap"></th>
						<td></td>
					</tr>
				</tbody>
			</table>
			</fieldset>
			<fieldset>
			<legend>Thông tin thành lập</legend>
			<table width="100%">
				<tbody>
					<tr>
						<th align="left" valign="top" nowrap="nowrap">Cách thức thành lập</th>
						<td  width="40%"><?php echo TochucHelper::getNameById($this->row->type_created, 'ins_dept_cachthuc'); ?></td>
						<th align="left" valign="top" nowrap="nowrap" >Số Quyết định</th>
						<td  width="40%"><?php echo $this->row->number_created; ?></td>
					</tr>
					<tr>
						<th align="left" valign="top" nowrap="nowrap">Ngày ban hành</th>
						<td><?php echo $this->row->date_created; ?></td>
						<th align="left" valign="top" nowrap="nowrap" >Cơ quan ban hành</th>
						<td><?php echo $this->vanban_created['coquan_banhanh']; ?></td>
					</tr>
					<tr>
						<th align="left" valign="top" nowrap="nowrap">Cơ quan chủ quản</th>
						<td><?php echo Core::loadResult('ins_dept', array('name'), array('id='=>(int)$this->row->ins_created)); ?></td>
						<th align="left" valign="top" nowrap="nowrap">Loại hình đơn vị</th>
						<td><?php echo Core::loadResult('ins_dept_loaihinh', array('name'), array('id='=>(int)$this->row->ins_loaihinh)); ?></td>
					</tr>
					<tr>
						<th align="left" valign="top" nowrap="nowrap">Cấp</th>
						<td><?php echo Core::loadResult('ins_cap', array('name'), array('id='=>(int)$this->row->ins_cap)); ?></td>
						<th align="left" valign="top" nowrap="nowrap">Hạng</th>
						<td><?php echo Core::loadResult('ins_level', array('name'), array('id='=>(int)$this->row->ins_level)); ?></td>
					</tr>
					<tr>
					<th align="left" valign="top" nowrap="nowrap">Lĩnh vực</th>
						<td>
						<?php echo Core::loadResult('cb_type_linhvuc', array('name'), array('id = '=>(int)$this->row->ins_linhvuc)); ?>
						</td>
						<th align="left" valign="top" nowrap="nowrap">Gói biên chế</th>
						<td><?php						
							echo Core::loadResult('bc_goibienche', array('name'), array('id = '=>(int)$this->row->goibienche));
						?></td>
					</tr>
					<tr>
						<th align="left" valign="top" nowrap="nowrap">Gói chức vụ</th>
						<td>
						<?php echo Core::loadResult('cb_goichucvu', array('name'), array('id='=>(int)$this->row->goichucvu)); ?>
						</td>
						<th align="left" valign="top" nowrap="nowrap">Gói lương</th>
						<td>
						<?php echo Core::loadResult('cb_goiluong', array('name'), array('id='=>(int)$this->row->goiluong)); ?>
						</td>
					</tr>
					<tr>					
				</tbody>
			</table>
			</fieldset>
			<fieldset>
			<legend>Trạng thái</legend>
				<table width="100%">
				<tbody>
					<tr>
						<th align="left" valign="top" nowrap="nowrap">Biên chế giao <?php echo date("Y");?>:</th>
						<td  width="40%"><?php echo $this->sumBienchegiao; ?></td>
						<th align="left" valign="top" nowrap="nowrap" >Tổng biên chế hiện có: </th>
						<td  width="40%"><?php echo  $this->sumBienchehienco; ?></td>
					</tr>
					<tr>
						<th align="left" valign="top" nowrap="nowrap">Trạng thái</th>
						<td  width="40%"><span class="label label-success arrowed-in arrowed-in-right"><?php echo Core::loadResult('ins_status', array('name'), array('id='=>(int)$this->row->active)); ?></span></td>
						<th align="left" valign="top" nowrap="nowrap" >Ghi chú</th>
						<td  width="40%"><?php echo  nl2br($this->row->ghichu); ?></td>
					</tr>
					<?php
					if ($this->vanban_active != null) {
						?>
						<tr>
						<th align="left" valign="top" nowrap="nowrap">Số Quyết định</th>
						<td>
						<?php echo $this->vanban_active['mahieu']; ?>
						</td>
						<th align="left" valign="top" nowrap="nowrap">Ngày ban hành</th>
						<td>
						<?php echo $this->vanban_active['ngaybanhanh']; ?>
						</td>
						</tr>
						<tr>
						<th align="left" valign="top" nowrap="nowrap">Cơ quan ban hanh</th>
						<td colspan="3">
						<?php echo $this->vanban_active['coquan_banhanh']; ?>
						</td>						
						</tr>
						<?php 
					} 
					?>
				</tbody>
				</table>
			</fieldset>				
				<?php 
			}else if ($this->row->type == 2) {		
				?>						
			<table width="100%">
				<tbody>
					<tr>
						<th align="left" valign="top" nowrap="nowrap" >Tên</th>
						<td width="40%"><?php echo $this->row->name; ?></td>
						<th align="left" valign="top" nowrap="nowrap" >Tên viết tắt</th>
						<td  width="40%"><?php echo $this->row->s_name; ?></td>
					</tr>					
				</tbody>
			</table>
			
			<fieldset>
			<legend>Trạng thái</legend>
				<table width="100%">
				<tbody>
					<tr>
						<th align="left" valign="top" nowrap="nowrap">Trạng thái</th>
						<td  width="40%"><span class="label label-success arrowed-in arrowed-in-right"><?php echo Core::loadResult('ins_status', array('name'), array('id='=>(int)$this->row->active)); ?></span></td>
						<th align="left" valign="top" nowrap="nowrap" >Ghi chú</th>
						<td  width="40%"><?php echo  nl2br($this->row->ghichu); ?></td>
					</tr>
					<?php
					if ($this->vanban_active != null) {
						?>
						<tr>
						<th align="left" valign="top" nowrap="nowrap">Số Quyết định</th>
						<td>
						<?php echo $this->vanban_active['mahieu']; ?>
						</td>
						<th align="left" valign="top" nowrap="nowrap">Ngày ban hành</th>
						<td>
						<?php echo $this->vanban_active['ngaybanhanh']; ?>
						</td>
						</tr>
						<tr>
						<th align="left" valign="top" nowrap="nowrap">Cơ quan ban hanh</th>
						<td colspan="3">
						<?php echo $this->vanban_active['coquan_banhanh']; ?>
						</td>						
						</tr>
						<?php 
					} 
					?>
				</tbody>
				</table>
			</fieldset>
				<?php 
			}else{
				?>
					<fieldset>
				<legend>Thông tin chung</legend>				
				<table width="100%">
				<tbody>
					<tr>
						<th align="left" valign="top" nowrap="nowrap" >Tên</th>
						<td width="40%"><?php echo $this->row->name; ?></td>
						<th align="left" valign="top" nowrap="nowrap" >Mã</th>
						<td  width="40%"><?php echo $this->row->code; ?></td>
					</tr>
					<tr>
						<th align="left" valign="top" nowrap="nowrap">Tên viết tắt</th>
						<td colspan="3"><?php echo $this->row->s_name; ?></td>						
					</tr>
				</tbody>
			</table>
			</fieldset>
			<fieldset>
			<legend>Thông tin thành lập</legend>
			<table width="100%">
				<tbody>
					<tr>
						<th align="left" valign="top" nowrap="nowrap">Cách thức thành lập</th>
						<td  width="40%"><?php echo TochucHelper::getNameById($this->row->type_created, 'ins_dept_cachthuc'); ?></td>
						<th align="left" valign="top" nowrap="nowrap" >Số Quyết định</th>
						<td  width="40%"><?php echo $this->row->number_created; ?></td>
					</tr>
					<tr>
						<th align="left" valign="top" nowrap="nowrap">Ngày ban hành</th>
						<td><?php echo $this->row->date_created; ?></td>
						<th align="left" valign="top" nowrap="nowrap" >Cơ quan ban hành</th>
						<td><?php echo $this->vanban_created['coquan_banhanh']; ?></td>
					</tr>
					<tr>
						<th align="left" valign="top" nowrap="nowrap">Cơ quan chủ quản</th>
						<td colspan="3"><?php echo Core::loadResult('ins_dept', array('name'), array('id='=>(int)$this->row->ins_created)); ?></td>						
					</tr>					
					<tr>
					<th align="left" valign="top" nowrap="nowrap">Lĩnh vực</th>
						<td colspan="3">
						<?php echo Core::loadResult('cb_type_linhvuc', array('name'), array('id = '=>(int)$this->row->ins_linhvuc)); ?>
						</td>						
					</tr>					
					<tr>					
				</tbody>
			</table>
			</fieldset>
			<fieldset>
			<legend>Trạng thái</legend>
				<table width="100%">
				<tbody>
					<tr>
						<th align="left" valign="top" nowrap="nowrap">Trạng thái</th>
						<td  width="40%"><span class="label label-success arrowed-in arrowed-in-right"><?php echo Core::loadResult('ins_status', array('name'), array('id='=>(int)$this->row->active)); ?></span></td>
						<th align="left" valign="top" nowrap="nowrap" >Ghi chú</th>
						<td  width="40%"><?php echo  nl2br($this->row->ghichu); ?></td>
					</tr>
					<?php
					if ($this->vanban_active != null) {
						?>
						<tr>
						<th align="left" valign="top" nowrap="nowrap">Số Quyết định</th>
						<td>
						<?php echo $this->vanban_active['mahieu']; ?>
						</td>
						<th align="left" valign="top" nowrap="nowrap">Ngày ban hành</th>
						<td>
						<?php echo $this->vanban_active['ngaybanhanh']; ?>
						</td>
						</tr>
						<tr>
						<th align="left" valign="top" nowrap="nowrap">Cơ quan ban hanh</th>
						<td colspan="3">
						<?php echo $this->vanban_active['coquan_banhanh']; ?>
						</td>						
						</tr>
						<?php 
					} 
					?>
				</tbody>
				</table>
			</fieldset>
				<?php 
			} 
		?>
						
		</div>
		<div id="tochuc-quatrinh" class="tab-pane">
		<span class="pull-right"><a class="btn btn-success btn-mini" id="btn_export_lichsu" href="/index.php?option=com_tochuc&view=tochuc&format=xls&donvi_id=<?php echo $this->row->id;?>"><i class="icon-download"></i>Xuất excel</a	></span>
		<table id ="lichsu" class="table table-striped table-bordered table-hover dataTable">
			<thead>
				<tr>					
					<th>#</th>
					<th>Ngày quyết định</th>
					<th>Ngày hiệu lực</th>
					<th>Cách thức</th>
					<th>Quyết định</th>					
					<th>Chi tiết</th>					
					<th>Ghi chú</th>
				</tr>					
			</thead>
			<tbody>
				<?php
				for ($i = 0; $i < count($this->quatrinh); $i++) {
					$item = $this->quatrinh[$i];
					$vanban = TochucHelper::getVanBanById($item['vanban_id']);
					if ($vanban != null) {
						if (Core::loadResult('core_attachment', 'COUNT(*)', array('object_id='=>$vanban['id'],'type_id='=>1))> 0 ) {
							$vanban['mahieu'] = '<a href="'.JUri::root(true).'/uploader/index.php?download=1&type_id=1&object_id='.$vanban['id'].'" target="_blank">'.$vanban['mahieu'].'</a>';
						}
					}else{
						$vanban = array();
					}
					?>
					<tr>
						<td><?php echo ($i+1)?></td>			
						<td><?php echo $item['quyetdinh_ngay'];?></td>					
						<td><?php echo ($nhl =$item['hieuluc_ngay']=='0000-00-00' ? "":date('d/m/Y', strtotime($item['hieuluc_ngay'])));?></td>
						<td><?php echo TochucHelper::getNameById($item['cachthuc_id'], 'ins_dept_cachthuc');?></td>
						<td><?php echo $vanban['mahieu'];?></td>					
						<td><?php echo $item['chitiet'];?></td>			
						<td><?php echo $item['ghichu'];?></td>
					</tr>
					<?php 
				} 
				?>
			</tbody>
		</table>
		</div>

		<div id="tochuc-bienche" class="tab-pane">
			<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>#</th>					
					<th>Năm</th>
					<th>Nghiệp vụ</th>				
					<th>Quyết định</th>
					<th>Chi tiết</th>										
					<th width="90%">Ghi chú</th>					
				</tr>					
			</thead>
			<tbody>
				<?php
				for ($i = 0; $i < count($this->quatrinh_bienche); $i++) {
					$row = $this->quatrinh_bienche[$i];
					$vanban = TochucHelper::getVanBanById($row['vanban_id']);
					if ($vanban != null) {
							if (Core::loadResult('core_attachment', 'COUNT(*)', array('object_id='=>$vanban['id'],'type_id='=>1))> 0 ) {
								$vanban['mahieu'] = '<a href="'.JUri::root(true).'/uploader/index.php?download=1&type_id=1&object_id='.$vanban['id'].'" target="_blank">'.$vanban['mahieu'].'</a>';
							}
						//$vanban['mahieu'] = '<a href="index.php?option=com_tochuc&controller=tochuc&task=download&id='.$vanban['id'].'" target="_blank">'.$vanban['mahieu'].', ngày '.$vanban['ngaybanhanh'].'</a>';
					}else{
						$vanban = array();
					}	
					?>
					<tr>
						<td><?php echo ($i+1)?></td>
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
					</tr>
					<?php 
				} 
				?>
			</tbody>
		</table>
		</div>
		<div id="tochuc-khenthuongkyluat" class="tab-pane">
				<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>					
					<th>#</th>
					<th>Từ ngày</th>					
					<th>Đến ngày</th>			
					<th>KT/KL</th>			
					<th>Hình thức</th>
					<th>Lý do</th>
					<th>Số QĐ</th>
					<th>Cơ quan QĐ</th>
					<th>Người ký</th>
					<th>Ngày ký</th>
				</tr>					
			</thead>
			<tbody>
				<?php
				for ($i = 0; $i < count($this->khenthuongkyluat); $i++) {
					$item = $this->khenthuongkyluat[$i];
					?>
					<tr>
						<td><?php echo ($i+1)?></td>			
						<td><?php echo date('d/m/Y',strtotime($item->start_date_kt));?></td>			
						<td><?php if ((isset($item->end_date_kt)) && ($item->end_date_kt!=null) && ($item->end_date_kt!='0000-00-00')) echo date('d/m/Y',strtotime($item->end_date_kt));?></td>			
						<td><?php if($item->ktkl=="KT") echo "Khen thưởng"; elseif($item->ktkl=="KL") echo "Kỷ luật";?></td>			
						<td><?php echo $item->hinhthuc;?></td>			
						<td><?php echo $item->reason_kt;?></td>			
						<td><?php echo $item->approv_number_kt;?></td>			
						<td><?php echo $item->approv_unit_kt;?></td>			
						<td><?php echo $item->approv_per_kt;?></td>			
						<td><?php if ((isset($item->approv_date_kt)) && ($item->approv_date_kt!= null) && ($item->approv_date_kt!='0000-00-00')) echo date('d/m/Y',strtotime($item->approv_date_kt));?></td>
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
	</div>
</div>

<script>
jQuery(document).ready(function($){
	$('#bntGiaobienche').click(function(){
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
	$('#btnXoa').click(function(){
		if(confirm("Bạn có muốn xóa không?")){
			if(confirm("Bạn có muốn xóa Tổ chức này không?")){
				var urlCheckHoso = '<?php echo JUri::base(true);?>/index.php?option=com_hoso&controller=hoso&task=checkSoluongHosoByDonvi';
				$.get(urlCheckHoso, { id_donvi : '<?php echo $this->row->id; ?>' }, function(data){
					if(data > 0){
						alert('Tổ chức này còn tồn tại hồ sơ. Không thể xóa tổ chức!');
					}else{
						window.location.href="index.php?option=com_tochuc&controller=tochuc&task=deletedept&Itemid=<?php echo $this->Itemid;?>&id=<?php echo $this->row->id;?>";
					}
				});
			}	
		}
		return false;
	});

	$('#bntQuaTrinh').click(function(){
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
	$('#bntKhenthuongkyluat').click(function(){
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
	$('#btn_export_lichsu').on('click',function(){
  		document.location.assign(this.href);
		return false;
	});	
});

</script>