<?php
$user = JFactory::getUser();
?>
<!-- begin form -->
<form class="form-horizontal row-fluid" name="frmThanhLap"	id="frmThanhLap" method="post"	action="<?php echo JRoute::_('index.php?option=com_tochuc&controller=tochuc&task=savethanhlap')?>" enctype="multipart/form-data">
	<h3 class="row-fluid header smaller lighter blue">
		<span class="span7">Tổ chức <small> <i class="icon-double-angle-right">
			</i> Thành lập mới tổ chức
		</small></span> <span class="span5"> <span class="pull-right inline">
				<button id="btnThanhlapSubmit" type="button" class="btn btn-small btn-success">
					<i class="icon-save"></i> Lưu
				</button> <a class="btn btn-small btn-info"
				href="<?php echo JRoute::_('index.php?option=com_tochuc&layout=default&Itemid='.$this->Itemid); ?>">←
					Quay về</a>
		</span>
		</span>
	</h3>
	<div class="error"></div>
	<div class="tabbable">
		<ul class="nav nav-tabs" id="myTab3">
			<li class="active"><a data-toggle="tab"
				href="#COM_TOCHUC_THANHLAP_TAB1">Thông tin chung</a></li>
			<li><a data-toggle="tab" href="#COM_TOCHUC_THANHLAP_TAB2">Thông tin thêm</a></li>
			<!-- li><a data-toggle="tab" href="#COM_TOCHUC_THANHLAP_TAB3">Cấu hình</a></li -->

		</ul>
		<div class="tab-content">
			<div id="COM_TOCHUC_THANHLAP_TAB1" class="tab-pane active">
				<fieldset>
					<legend>Thông tin tổ chức</legend>
					<div class="row-fluid">
						<div class="control-group span6">
							<label class="control-label" for="name">Cây đơn vị <span class="required">*</span></label>
							<div class="controls">							
							<input type="hidden" value="<?php echo $this->row->parent_id; ?>" name="parent_id" id="parent_id">							
							<div class="input-append">
							<input type="text" class="input-xlarge" value="<?php echo Core::loadResult('ins_dept', array('name'), array('id = '=>$this->row->parent_id)); ?>" name="parent_name" id="parent_name" readonly="readonly">
							  <a href="#myModal" role="button" class="btn" data-toggle="modal">...</a>					  
							</div>							
							</div>
						</div>
						<div class="control-group span6">
							<label class="control-label" for="type">Loại <span class="required">*</span></label>
							<div class="controls">
							  <?php                
			                	echo TochucHelper::selectBox($this->row->type, array('name'=>'type','hasEmpty'=>true), 'ins_type', array('id','name')); 
			                	?>
							</div>
						</div>
					</div>
					<div class="row-fluid">
						<div class="control-group span6">
							<label class="control-label" for="name">Tên tổ chức <span class="required">*</span></label>
							<div class="controls">
							
							<input type="text" value="<?php echo $this->row->name;?>"name="name" id="name">
							</div>
						</div>
						<div class="control-group span6">
							<label class="control-label" for="code">Mã số tổ chức</label>
							<div class="controls">
								<input type="text" value="<?php echo $this->row->code; ?>" id="code" name="code">
							</div>
						</div>
					</div>
					<div class="row-fluid">
						<div class="control-group span6">
							<label class="control-label" for="name">Tên viết tắt <span
								class="required">*</span></label>
							<div class="controls">
								<input type="text" value="<?php echo $this->row->s_name; ?>" name="s_name" id="s_name">
							</div>
						</div>
						<div class="control-group span6">
							<label class="control-label" for="code">Tên tiếng Anh</label>
							<div class="controls">
								<input type="text" value="<?php echo $this->row->eng_name; ?>" id="eng_name" name="eng_name">
							</div>
						</div>
					</div>
					<div class="row-fluid">
						<div class="control-group span6">
							<label class="control-label" for="masothue">Mã số thế</label>
							<div class="controls">
								<input type="text" value="<?php echo $this->row->masothue; ?>"	name="masothue" id="masothue">
							</div>
						</div>
						<div class="control-group span6">
							<label class="control-label" for="masotabmis">Mã số Tabmis</label>
							<div class="controls">
								<input type="text" value="<?php echo $this->row->masotabmis; ?>" id="masotabmis" name="masotabmis">
							</div>
						</div>
					</div>
					<div class="row-fluid">
						<div class="control-group span6">
							<label class="control-label" for="diachi">Địa chỉ <span class="required">*</span></label>
							<div class="controls">
								<input type="text" value="<?php echo $this->row->diachi; ?>" name="diachi" id="diachi">
							</div>
						</div>
						<div class="control-group span6">
							<label class="control-label" for="dienthoai">Điện thoại</label>
							<div class="controls">
								<input type="text" value="<?php echo $this->row->dienthoai; ?>"	name="dienthoai" id="dienthoai">
							</div>
						</div>
					</div>
					<div class="row-fluid">
						<div class="control-group span6">
							<label class="control-label" for="email">Email</label>
							<div class="controls">
								<input type="text" value="<?php echo $this->row->email; ?>"	id="email" name="email">
							</div>
						</div>
						<div class="control-group span6">
							<label class="control-label" for="fax">Fax</label>
							<div class="controls">
								<input type="text" value="<?php echo $this->row->fax; ?>" id="fax" name="fax">
							</div>
						</div>
					</div>
					<div class="row-fluid">
						<div class="control-group span6">
							<label class="control-label" for="date_created">Ngày thành lập</label>
							<div class="controls">
								<input type="text" value="<?php echo $this->row->date_created; ?>"	class="input-mask-date" id="date_created" name="date_created">
							</div>
						</div>
						<div class="control-group span6">
							<label class="control-label" for="phucapdacthu">Phụ cấp đặc thù</label>
							<div class="controls">
								<input type="text" value="<?php echo $this->row->phucapdacthu; ?>" id="phucapdacthu" name="phucapdacthu">
							</div>
						</div>
					</div>
</fieldset>					
<fieldset>
<legend>Thông tin thành lập</legend>
					<div class="row-fluid">
						<div class="control-group span6">
							<label class="control-label" for="ngaybanhanh">Cách thức thành lập <span class="required">*</span></label>
								<div class="controls">			
								<select id="type_created" name="type_created">
									<option value="1">Thành lập mới</option>
									<option value="2">Sáp nhập từ tổ chức khác</option>
									<option value="3">Chia tách từ tổ chức khác</option>
									<option value="4">Hợp nhất các tổ chức</option>										
								</select>
								</div>
						</div>
						<div class="control-group span6">
							<label class="control-label" for="vanban_created_coquan_banhanh">Cơ quan ban hành <span class="required">*</span></label>
							<div class="controls">
								<input type="hidden" name="vanban_created[id]" id="vanban_created_id" value="<?php echo $this->vanban_created['id'];?>">
								<input type="hidden" name="vanban_created[coquan_banhanh_id]" id="vanban_created_coquan_banhanh_id" value="<?php echo $this->vanban_created['coquan_banhanh_id'];?>">
								<div class="input-append">
								<input type="text" class="input-xlarge" value="<?php echo $this->vanban_created['coquan_banhanh'];?>" name="vanban_created[coquan_banhanh]" id="vanban_created_coquan_banhanh" readonly="readonly">
								  <a href="#modalCoquanbanhanh" role="button" class="btn" data-toggle="modal">...</a>					  
								</div>							
							</div>
						</div>	
					</div>
					<div class="row-fluid">
						<div class="control-group span6">							
							<label class="control-label" for="vanban_created_ngaybanhanh">Ngày ban hành <span class="required">*</span></label>
							<div class="controls">
								<input type="text" value="<?php echo $this->vanban_created['ngaybanhanh']; ?>" class="input-mask-date" id="vanban_created_ngaybanhanh" name="vanban_created[ngaybanhanh]">
							</div>							
						</div>
						<div class="control-group span6">
							<label class="control-label" for="vanban_created_mahieu">Số QĐ <span class="required">*</span></label>
							<div class="controls">
								<div class="input-append">
								<input type="text" value="<?php echo $this->vanban_created['mahieu']; ?>" name="vanban_created[mahieu]" id="vanban_created_mahieu">							
								    <span class="btn btn-success fileinput-button">
								        <i class="icon icon-plus"></i>
								        <span>Chọn tập tin</span>
								        <!-- The file input field used as target for the file upload widget -->
								        <input id="fileupload" type="file" name="files">
								    </span>
								</div>
								<ul id="fileupload_list" class="files unstyled spaced"></ul>
							</div>
						</div>					
					</div>
					<div class="row-fluid">			
						<div class="control-group span6">
							<label class="control-label" for="ins_created">Cơ quan chủ quản <span class="required">*</span></label>
							<div class="controls">        
								<input type="hidden" value="<?php echo $this->row->ins_created; ?>" name="ins_created" id="ins_created">        
                				<div class="input-append">
								<input type="text" class="input-xlarge" value="<?php echo Core::loadResult('ins_dept', array('name'), array('id = '=>$this->row->ins_created)); ?>" name="ins_created_name" id="ins_created_name" readonly="readonly">
								  <a href="#modalCoquanchuquan" role="button" class="btn" data-toggle="modal">...</a>					  
								</div>
			            	</div>
						</div>
						<div class="control-group span6">
							<label class="control-label" for="ins_level">Hạng đơn vị <span class="required">*</span></label>
							<div class="controls">
									<input type="hidden" name="ins_level" id="ins_level" value="<?php echo $this->row->ins_level; ?>">
									<div class="input-append">
									<input type="text" id="ins_level_name" name="ins_level_name"  value="<?php echo Core::loadResult('ins_level', array('name'), array('id = '=>(int)$this->row->ins_level))?>" readonly="readonly">
									<a class="btn collapse-data-btn" data-toggle="collapse" href="#ins_level_detail">...</a>
								    </div>
									<div id="ins_level_detail" class="collapse">
									    <div id="thanhlap-tochuc-ins_level" class="tree"></div>
									</div>
				            </div>
						</div>	
					</div>	
					<div class="row-fluid">
						<div class="control-group span6">
							<label class="control-label" for="ins_loaihinh">Loại hình đơn vị <span class="required">*</span></label>
							<div class="controls">
									<input type="hidden" name="ins_loaihinh" id="ins_loaihinh" value="<?php echo $this->row->ins_loaihinh; ?>">
									<div class="input-append">
									<input type="text" id="ins_loaihinh_name" name="ins_loaihinh_name"  value="<?php echo Core::loadResult('ins_dept_loaihinh', array('name'), array('id = '=>(int)$this->row->ins_loaihinh))?>" readonly="readonly">
									<a class="btn collapse-data-btn" data-toggle="collapse" href="#ins_loaihinh_detail">...</a>
								    </div>
									<div id="ins_loaihinh_detail" class="collapse">
									    <div id="thanhlap-tochuc-ins_loaihinh" class="tree"></div>
									</div>
							</div>
						</div>
						<div class="control-group span6">
							<label class="control-label" for="name">Cấp đơn vị <span class="required">*</span></label>
							<div class="controls">
									<input type="hidden" name="ins_cap" id="ins_cap" value="<?php echo $this->row->ins_cap; ?>">
									<div class="input-append">
									<input type="text" id="ins_cap_name" name="ins_cap_name"  value="<?php echo Core::loadResult('ins_cap', array('name'), array('id = '=>(int)$this->row->ins_cap))?>" readonly="readonly">
									<a class="btn collapse-data-btn" data-toggle="collapse" href="#ins_cap_detail">...</a>
								    </div>
									<div id="ins_cap_detail" class="collapse">
									    <div id="thanhlap-tochuc-ins_cap" class="tree"></div>
									</div>
							</div>
						</div>			
					</div>
</fieldset>
<fieldset>
<legend>Trạng thái</legend>
					<div class="row-fluid">
						<div class="span6">
							<div class="control-group">
								<label class="control-label" for="active">Trạng thái <span class="required">*</span></label>
								<div class="controls">
	            <?php
	            	echo TochucHelper::selectBox(1, array('name'=>'active'), 'ins_status', array('id','name')); 
	            ?>
	            				</div>
							</div>
							<div class="control-group trangthai">
								<label class="control-label" for="trangthai_coquan_banhanh">Cơ quan ban hành QĐ <span class="required">*</span></label>
								<div class="controls">
								<div class="input-append">
								<input type="hidden" name="trangthai[coquan_banhanh_id]" id="trangthai_coquan_banhanh_id" value="<?php echo $this->trangthai['coquan_banhanh_id'];?>">
								<input type="text" class="input-xlarge" value="<?php echo $this->trangthai['coquan_banhanh'];?>" name="trangthai[coquan_banhanh]" id="trangthai_coquan_banhanh" readonly="readonly">
								  <a href="#modalTrangthaiCoquanbanhanh" role="button" class="btn" data-toggle="modal">...</a>					  
								</div>								
								</div>
							</div>
							<div class="control-group trangthai">
								<label class="control-label" for="trangthai_ngaybanhanh">Ngày QĐ <span class="required">*</span></label>
								<div class="controls">
									<input type="text" class="input-mask-date" name="trangthai[ngaybanhanh]" value="<?php echo $this->trangthai['ngaybanhanh'];?>">
									
								</div>
							</div>	
							<div class="control-group trangthai">
								<label class="control-label" for="name">Số QĐ<span class="required">*</span></label>
								<div class="controls">
									<div class="input-append">
									<input type="text" name="trangthai[mahieu]"  value="<?php echo $this->trangthai['mahieu'];?>"><span class="btn btn-success fileinput-button">
								        <i class="icon icon-plus"></i>
								        <span>Chọn tập tin</span>								    
								        <input id="trangthai_fileupload"  type="file" name="files">
								    </span>	
								    </div>
								    <ul id="trangthai_fileupload_list" class="files unstyled spaced"></ul>															
								</div>
								
							</div>											
						</div>
		
						<div class="control-group span6">
								<label class="control-label" for="ghichu">Ghi chú</label>
								<div class="controls">
									<textarea rows="5" cols="30" name="ghichu"></textarea>
								</div>
							</div>	
					</div>					
				</fieldset>
			</div>
			<div id="COM_TOCHUC_THANHLAP_TAB2" class="tab-pane">
			<fieldset class="input-tochuc">
			<legend>Thông tin thêm</legend>
				<div class="row-fluid">
					<div class="span4">							
								<div class="row-fluid">	
								<label>Lĩnh vực tổ chức</label>
									<input type="hidden" name="ins_linhvuc" id="ins_linhvuc" value="<?php echo $this->row->ins_linhvuc; ?>">
									<div class="input-append">
									<input type="text" id="ins_linhvuc_name" name="ins_linhvuc_name"  value="<?php echo Core::loadResult('cb_type_linhvuc', array('name'), array('id = '=>(int)$this->row->ins_linhvuc))?>" readonly="readonly">
									<a class="btn collapse-data-btn" data-toggle="collapse" href="#ins_linhvuc_detail">...</a>
								    </div>
									<div id="ins_linhvuc_detail" class="collapse">
									    <div id="thanhlap-tochuc-ins_linhvuc" class="tree"></div>
									</div>
	            			</div>
	            	</div>					
					<div class="span8">
					<div class="row-fluid">				
						<div class="control-group">
							<label class="control-label" for="goibienche">Gói biên chế <span class="required">*</span></label>
							<div class="controls">
			                <?php
			                	//var_dump($this->row->goibienche);    
			                	echo TochucHelper::selectBox($this->row->goibienche, array('name'=>'goibienche','hasEmpty'=>true), 'bc_goibienche', array('id','name'),array('active = 1')); 
			                ?>
			            </div>
						</div>
					</div>
						<div class="row-fluid">
							<div class="control-group">							
								<label class="control-label" for="goichucvu">Gói chức vụ <span class="required">*</span></label>
								<div class="controls">
									<input type="hidden" name="goichucvu" id="goichucvu" value="<?php $this->row->goichucvu?>">
									<div class="input-append">
									<input type="text" id="goichucvu_name" name="goichucvu_name"  value="<?php echo Core::loadResult('pos_system', array('name'), array('id = '=>(int)$this->row->goichucvu))?>" readonly="readonly">
									<a class="btn collapse-data-btn" data-toggle="collapse" href="#goichucvu_detail">...</a>
								    </div>
									<div id="goichucvu_detail" class="collapse">
									   <div id="thanhlap-tochuc-goichucvu" class="tree"></div>
									</div>
								</div>
							</div>
						</div>
					<div class="row-fluid">	
						<div class="control-group">					
								<label class="control-label" for="goiluong">Gói lương <span class="required">*</span></label>
								<div class="controls">
									<input type="hidden" name="goiluong" id="goiluong" value="<?php $this->row->goiluong?>">
									<div class="input-append">
									<input type="text" id="goiluong_name" name="goiluong_name"  value="<?php echo Core::loadResult('cb_goiluong', array('name'), array('id = '=>(int)$this->row->goiluong))?>" readonly="readonly">
									<a class="btn collapse-data-btn" data-toggle="collapse" href="#goiluong_detail">...</a>
								    </div>
									<div id="goiluong_detail" class="collapse">
									   <div id="thanhlap-tochuc-goiluong" class="tree"></div>
									</div>								
							</div>
						</div>				
					</div>
				</div>
				</div>
			</fieldset>					
			</div>
			<div id="COM_TOCHUC_THANHLAP_TAB3" class="tab-pane">
<fieldset>
					<legend>Báo cáo khối hành chính</legend>
						<div class="row-fluid">	
						<div class="control-group">
							<label  class="control-label" for="">Tên hiển thị trong báo cáo <span class="required">*</span></label>							
							<div class="controls">
								<input type="hidden" name="chkrep_hc_name" value="0">
								<label>
									<input type="checkbox" data-toggle="collapse" data-target="#chkrep_hc_name_detail" checked="checked" name="chkrep_hc_name" id="chkrep_hc_name" value="1"><span class="lbl"> Dùng tên tổ chức</span>
								</label>
								<div id="chkrep_hc_name_detail" class="collapse">
									   <input type="text" name="rep_hc_name" id="rep_hc_name" value="<?php echo $this->row->rep_hc_name; ?>">
								</div>										
								
							</div>
						</div>
						</div>
				</fieldset>
				<fieldset>
					<legend>Báo cáo khối sự nghiệp</legend>
						<div class="row-fluid">	
						<div class="control-group">
							<label  class="control-label" for="">Tên hiển thị trong báo cáo <span class="required">*</span></label>							
							<div class="controls">								
								<input type="hidden" name="chkrep_sn_name" value="0">
								<label>
									<input type="checkbox" checked="checked" data-toggle="collapse" data-target="#chkrep_sn_name_detail" name="chkrep_sn_name" value="1" id="chkrep_sn_name"><span class="lbl"> Dùng tên tổ chức</span>
								</label>
								<div id="chkrep_sn_name_detail" class="collapse">									
								<input type="text" name="rep_sn_name" id="rep_sn_name" value="<?php echo $this->row->rep_sn_name; ?>">
								</div>
							</div>
						</div>
						</div>
				</fieldset>
				<fieldset>
					<legend>Báo cáo chung cả 2 khối</legend>
						<div class="row-fluid">	
						<div class="control-group">
							<label  class="control-label" for="">Tên hiển thị trong báo cáo <span class="required">*</span></label>							
							<div class="controls">	
								<input type="hidden" name="chkrep_bc_name" value="0">
								<label>
									<input type="checkbox" checked="checked" data-toggle="collapse" data-target="#chkrep_bc_name_detail"  name="chkrep_bc_name" value="1" id="chkrep_bc_name"><span class="lbl"> Dùng tên tổ chức</span>
								</label>
								<div id="chkrep_bc_name_detail" class="collapse">									
									<input type="text" name="rep_bc_name" id="rep_bc_name" value="<?php echo $this->row->rep_bc_name; ?>">	
								</div>								
															
							</div>
						</div>
						</div>
				</fieldset>	
			</div>
		</div>
	</div>
<?php echo JHTML::_( 'form.token' ); ?> 	
</form>
<div class="modal hide fade" id="modalCoquanchuquan">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Chọn đơn vị</h3>
  </div>
  <div class="modal-body">
   <div id="tochuc-coquanchuquan-tree" class="tree"></div>
  </div>
  <div class="modal-footer">    
    <a href="#" class="btn btn-primary btn-small" id="btnSaveCoquanchuquan">Lưu</a>
  </div>
</div>
<div class="modal hide fade" id="modalCoquanbanhanh">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Chọn đơn vị</h3>
  </div>
  <div class="modal-body">
   <div id="tochuc-coquanbanhanh-tree" class="tree"></div>
  </div>
  <div class="modal-footer">    
    <a href="#" class="btn btn-primary btn-small" id="btnSaveCoquanbanhanh">Lưu</a>
  </div>
</div>
<div class="modal hide fade" id="modalTrangthaiCoquanbanhanh">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Chọn đơn vị</h3>
  </div>
  <div class="modal-body">
   <div id="tochuc-trangthai-coquanbanhanh-tree" class="tree"></div>
  </div>
  <div class="modal-footer">    
    <a href="#" class="btn btn-primary btn-small" id="btnSaveTrangthaiCoquanbanhanh">Lưu</a>
  </div>
</div>
<div class="modal hide fade" id="myModal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Cây đơn vị</h3>
  </div>
  <div class="modal-body">
   <div id="tochuc-parent-tree"></div>
  </div>
  <div class="modal-footer">    
    <a href="#" class="btn btn-primary btn-small" id="btnSaveCayDonVi">Lưu</a>
  </div>
</div>
<script type="text/javascript">
jQuery(document).ready(function($){
	// xu ly loai hinh
	//fun khi change cbx ins loai hinh
	//jQuery('.required label').append('aaa');
    var toggleInputTochuc = function(element){
    	if(element.value == 1){
			$(".input-tochuc").show();
			$(".input-phong").hide();
		}		
		else if(element.value == 0){
			$(".input-phong").show();
			$(".input-tochuc").hide();
		}else{
    		$(".input-phong,.input-tochuc").hide();
		}
	};
    var toggleInputTrangthai = function(val){
    	if(val == 1){			
			$(".trangthai").hide();
		}		
    	else{
			$(".trangthai").show();
    	}		
	};
// 	$('#TYPE').change(function(){
// 		toggleInputTochuc(this);
// 	});
	$('#active').change(function(){
		toggleInputTrangthai(this.value);
	});

	var initPage = function(){
		$('.chzn-select').chosen({allow_single_deselect: true});
		$('.input-mask-date').mask('99/99/9999');
		$('#type_created').val('<?php echo $this->row->type_created;?>');
		//$('#type_created').val('2');		
		//toggleInputTochuc($('#TYPE'));
		toggleInputTrangthai($('#active').val());
		$('#btnSaveCayDonVi').click(function(event){
			event.preventDefault();
			//var parent_id = $('#tochuc-parent-tree').jstree('get_selected').attr('id').replace("node_","");
			
			var parent_id = $('#tochuc-parent-tree').jstree('get_selected').attr('id');
			//console.log($.trim($('#tochuc-parent-tree').jstree('get_selected').children("a").text()));
			if(typeof parent_id != "undefined"){
				parent_id = parent_id.replace("node_","");
				$('#parent_id').val(parent_id);
				$('#parent_name').val($.trim($('#tochuc-parent-tree').jstree('get_selected').children("a").text()));
				$('#myModal').modal('hide');
			}

		});
		$('#btnSaveCoquanchuquan').click(function(event){
			event.preventDefault();
			//var parent_id = $('#tochuc-parent-tree').jstree('get_selected').attr('id').replace("node_","");
			var node = $('#tochuc-coquanchuquan-tree').tree('selectedItems');
			if(typeof node[0] != "undefined"){
				 $('#ins_created_name').val(node[0].name);
				 $('#ins_created').val(node[0].id);
			}
			$('#modalCoquanchuquan').modal('hide');

		});
		$('#btnSaveCoquanbanhanh').click(function(event){
			event.preventDefault();
			//var parent_id = $('#tochuc-parent-tree').jstree('get_selected').attr('id').replace("node_","");
			var node = $('#tochuc-coquanbanhanh-tree').tree('selectedItems');
			if(typeof node[0] != "undefined"){
				 $('#vanban_created_coquan_banhanh').val(node[0].name);
				 $('#vanban_created_coquan_banhanh_id').val(node[0].id);
			}
			$('#modalCoquanbanhanh').modal('hide');

		});
		$('#btnSaveTrangthaiCoquanbanhanh').click(function(event){
			event.preventDefault();
			//var parent_id = $('#tochuc-parent-tree').jstree('get_selected').attr('id').replace("node_","");
			var node = $('#tochuc-trangthai-coquanbanhanh-tree').tree('selectedItems');
			if(typeof node[0] != "undefined"){
				 $('#trangthai_coquan_banhanh').val(node[0].name);
				 $('#trangthai_coquan_banhanh_id').val(node[0].id);
			}
			$('#modalTrangthaiCoquanbanhanh').modal('hide');

		});
	};
	initPage();
	 //form validate

	 var DataSourceTree = function(options) {
			this._data 	= options.data;
			this._delay = options.delay;
		}

		DataSourceTree.prototype.data = function(options, callback) {
			var self = this;
			var $data = null;

			if(!("name" in options) && !("type" in options)){
				$data = this._data;//the root tree
				callback({ data: $data });
				return;
			}
			else if("type" in options && options.type == "folder") {
				if("additionalParameters" in options && "children" in options.additionalParameters)
					$data = options.additionalParameters.children;
				else $data = {}//no data
			}
			
			if($data != null)//this setTimeout is only for mimicking some random delay
				setTimeout(function(){callback({ data: $data });} , parseInt(Math.random() * 500) + 200);
			//if($data != null) callback({ data: $data });

			//we have used static data here
			//but you can retrieve your data dynamically from a server using ajax call
			//checkout examples/treeview.html and examples/treeview.js for more info
		};

		var tree_data_ins_cap = <?php echo $this->tree_data_ins_cap; ?>;
		var tree_data_ins_level = <?php echo $this->tree_data_ins_level; ?>;
		var tree_data_ins_goichucvu = <?php echo $this->tree_data_ins_goichucvu; ?>;
		var tree_data_ins_goiluong = <?php echo $this->tree_data_ins_goiluong; ?>;
		var tree_data_ins_linhvuc = <?php echo $this->tree_data_ins_linhvuc; ?>;
		var tree_data_ins_loaihinh = <?php echo $this->tree_data_ins_loaihinh; ?>;
		var tree_data_ins_dept = <?php echo $this->tree_data_ins_dept; ?>;
		//var treeDataSource2 = new DataSourceTree({data: tree_data_2});
		var treeDataCapDonvi = new DataSourceTree({data: tree_data_ins_cap});
		var treeDataLevelDonvi = new DataSourceTree({data: tree_data_ins_level});
		var treeDataGoiChucvu = new DataSourceTree({data: tree_data_ins_goichucvu});
		var treeDataGoiLuong = new DataSourceTree({data: tree_data_ins_goiluong});
		var treeDataLinhvuc = new DataSourceTree({data: tree_data_ins_linhvuc});
		var treeDataLoaihinh = new DataSourceTree({data: tree_data_ins_loaihinh});
		var treeDataDept = new DataSourceTree({data: tree_data_ins_dept});
	
		$('#tochuc-coquanchuquan-tree').ace_tree({
			dataSource: treeDataDept,
			multiSelect:false,
			loadingHTML:'<div class="tree-loading"><i class="icon-refresh icon-spin blue"></i></div>',
			'open-icon' : 'icon-minus',
			'close-icon' : 'icon-plus',
			'selectable' : true,
			'selected-icon' : 'icon-ok',
			'unselected-icon' : 'icon-remove'
		});
		$('#tochuc-coquanbanhanh-tree').ace_tree({
			dataSource: treeDataDept,
			multiSelect:false,
			loadingHTML:'<div class="tree-loading"><i class="icon-refresh icon-spin blue"></i></div>',
			'open-icon' : 'icon-minus',
			'close-icon' : 'icon-plus',
			'selectable' : true,
			'selected-icon' : 'icon-ok',
			'unselected-icon' : 'icon-remove'
		});
		$('#tochuc-trangthai-coquanbanhanh-tree').ace_tree({
			dataSource: treeDataDept,
			multiSelect:false,
			loadingHTML:'<div class="tree-loading"><i class="icon-refresh icon-spin blue"></i></div>',
			'open-icon' : 'icon-minus',
			'close-icon' : 'icon-plus',
			'selectable' : true,
			'selected-icon' : 'icon-ok',
			'unselected-icon' : 'icon-remove'
		});
		$('#thanhlap-tochuc-ins_cap').ace_tree({
			dataSource: treeDataCapDonvi,
			multiSelect:false,
			loadingHTML:'<div class="tree-loading"><i class="icon-refresh icon-spin blue"></i></div>',
			'open-icon' : 'icon-minus',
			'close-icon' : 'icon-plus',
			'selectable' : true,
			'selected-icon' : 'icon-ok',
			'unselected-icon' : 'icon-remove'
		});
		$('#thanhlap-tochuc-ins_cap').on('selected', function (evt, data) {
			//var ins_loaihinh = data.info;
			if(typeof data.info[0] != "undefined"){
				 $('#ins_cap').val(data.info[0].id);
				 $('#ins_cap_name').val(data.info[0].name);
			}
		});
		$('#thanhlap-tochuc-ins_level').ace_tree({
			dataSource: treeDataLevelDonvi,
			multiSelect:false,
			loadingHTML:'<div class="tree-loading"><i class="icon-refresh icon-spin blue"></i></div>',
			'open-icon' : 'icon-minus',
			'close-icon' : 'icon-plus',
			'selectable' : true,
			'selected-icon' : 'icon-ok',
			'unselected-icon' : 'icon-remove'
		});
		$('#thanhlap-tochuc-ins_level').on('selected', function (evt, data) {		
			if(typeof data.info[0] != "undefined"){
				 $('#ins_level').val(data.info[0].id);
				 $('#ins_level_name').val(data.info[0].name);
			}
// 			console.log(data.info);
// 				$.each(data.info,function(i,v){
// 					console.log(i,v.id);
// 				});
		});
		$('#thanhlap-tochuc-goichucvu').ace_tree({
			dataSource: treeDataGoiChucvu,
			multiSelect:false,
			loadingHTML:'<div class="tree-loading"><i class="icon-refresh icon-spin blue"></i></div>',
			'open-icon' : 'icon-minus',
			'close-icon' : 'icon-plus',
			'selectable' : true,
			'selected-icon' : 'icon-ok',
			'unselected-icon' : 'icon-remove'
		});
		$('#thanhlap-tochuc-goichucvu').on('selected', function (evt, data) {
			//var ins_loaihinh = data.info;
			if(typeof data.info[0] != "undefined"){
				 $('#goichucvu').val(data.info[0].id);
				 $('#goichucvu_name').val(data.info[0].name);
			}
		});
		$('#thanhlap-tochuc-goiluong').ace_tree({
			dataSource: treeDataGoiLuong,
			multiSelect:false,
			loadingHTML:'<div class="tree-loading"><i class="icon-refresh icon-spin blue"></i></div>',
			'open-icon' : 'icon-minus',
			'close-icon' : 'icon-plus',
			'selectable' : true,
			'selected-icon' : 'icon-ok',
			'unselected-icon' : 'icon-remove'
		});
		$('#thanhlap-tochuc-goiluong').on('selected', function (evt, data) {
			//var ins_loaihinh = data.info;
			if(typeof data.info[0] != "undefined"){
				 $('#goiluong').val(data.info[0].id);
				 $('#goiluong_name').val(data.info[0].name);
			}
		});
		$('#thanhlap-tochuc-ins_linhvuc').ace_tree({
			dataSource: treeDataLinhvuc,
			multiSelect:false,
			loadingHTML:'<div class="tree-loading"><i class="icon-refresh icon-spin blue"></i></div>',
			'open-icon' : 'icon-minus',
			'close-icon' : 'icon-plus',
			'selectable' : true,
			'selected-icon' : 'icon-ok',
			'unselected-icon' : 'icon-remove'
		});
		$('#thanhlap-tochuc-ins_linhvuc').on('selected', function (evt, data) {
			//var ins_loaihinh = data.info;
			if(typeof data.info[0] != "undefined"){
				 $('#ins_linhvuc').val(data.info[0].id);
				 $('#ins_linhvuc_name').val(data.info[0].name);
			}
		});
		$('#thanhlap-tochuc-ins_loaihinh').ace_tree({
			dataSource: treeDataLoaihinh,
			multiSelect:false,
			loadingHTML:'<div class="tree-loading"><i class="icon-refresh icon-spin blue"></i></div>',
			'open-icon' : 'icon-minus',
			'close-icon' : 'icon-plus',
			'selectable' : true,
			'selected-icon' : 'icon-ok',
			'unselected-icon' : 'icon-remove'
		});
		$('#thanhlap-tochuc-ins_loaihinh').on('selected', function (evt, data) {
			//var ins_loaihinh = data.info;
			if(typeof data.info[0] != "undefined"){
				 $('#ins_loaihinh').val(data.info[0].id);
				 $('#ins_loaihinh_name').val(data.info[0].name);
			}
		});

// 		$('#tree1').ace_tree({
// 			dataSource: treeDataSource2 ,
// 			multiSelect:false,
// 			loadingHTML:'<div class="tree-loading"><i class="icon-refresh icon-spin blue"></i></div>',
// 			'open-icon' : 'icon-minus',
// 			'close-icon' : 'icon-plus',
// 			'selectable' : true,
// 			'selected-icon' : 'icon-ok',
// 			'unselected-icon' : 'icon-remove'
// 		});



		/**
		$('#tree1').on('loaded', function (evt, data) {
		});

		$('#tree1').on('opened', function (evt, data) {
		});

		$('#tree1').on('closed', function (evt, data) {
		});
		*/
// 		$('#tree1').on('selected', function (evt, data) {
// 			console.log(data.info);
// // 			$.each(data.info,function(i,v){
// // 				console.log(i,v.id);
// // 			});
// 		});
		$('#tochuc-parent-tree').jstree({
		 	"plugins": ["themes", "json_data","crrm", "ui","types"],
	  		"json_data":{
					"ajax" : {
						// the URL to fetch the data
						"url" : "<?php echo JUri::root(true);?>/api.php?&task=tree&act=VOBOC",	
						"data" : function(n) {
							return {
								"id" : n.attr ? n.attr("id").replace("node_", "") : 0
							};
						}
					}
				}
		}).bind("loaded.jstree", function (event, data) {
			var curr_id = $('#parent_id').val();
		 	$.jstree._focused().select_node("#node_"+curr_id);
		});
		$.validator.setDefaults({ ignore: '' });
		$.validator.addMethod("required2", function(value, element) {
		    var isTochuc = $("#type").val() === "1";
		    var val = value.replace(/^\s+|\s+$/g,"");//trim	 	
		    if(isTochuc && (eval(val.length) == 0)){
		    	 return false;
			}else{
				return true;
			}
		}, "Trường này là bắt buộc");
		$('#frmThanhLap').validate({
			  rules: {
				  "name": {	    
					  required: true
			      },
			      "s_name": {	    
					  required: true
			      },
			      "type":{
			    	  required: true
				  },
			      "parent_id": {	    
					  required: true
			      },
			      "type_created": {	    
					  required: true
			      },
			      "number_created": {	    
					  required: true
			      },
			      "date_created": {	    
					  required: true,
					  dateVN:true
			      },
			      "diachi":{
			    	  required:true   
				  },
				  "goibienche":{
			    	  required:true   
				  },
				  "ins_created": {	    
					  required: true
			      },
				  "ins_cap": {	    
					  required: true
			      },
				  "ins_level": {	    
					  required: true
			      },
			      "ins_loaihinh": {	    
					  required: true
			      },
			      "goichucvu": {	    
					  required: true
			      },
			      "goiluong": {	    
					  required: true
			      }
			  }
			 });
		 $('#btnThanhlapSubmit').click(function(){
			//console.log($('#frmThanhLap').serialize());
			  var flag = $('#frmThanhLap').valid();
			  if(flag == true){
				  document.frmThanhLap.submit();
			  }
			  //console.log(flag);
			  return false;
		 });

}); // end document.ready
jQuery(function ($) {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = '<?php echo JUri::root(true)?>/uploader/index.php';
    <?php 
    if($this->file_created != null){
    	?>
        $.ajax({
            url: url,
            dataType: 'json',
            data: {"file": '<?php echo $this->file_created['code'];?>'},
            success: function (file) {               
            	$('#fileupload_list').html('<li id="file_'+file.id+'" ><input type="hidden" name="fileupload_id[]" value="'+file.id+'"><a onclick="deleteFileById('+file.id+',\''+file.deleteUrl+'\')" class="btn btn-minier btn-danger" href="javascript:void(0);"><i class="icon-trash"></i></a> <a href="'+file.url+'" target="_blank">'+file.filename+'</a></li>');
            }
        });
    	<?php 
    }
    ?>
    <?php 
   	if($this->file_trangthai != null){
    	    	?>
    	        $.ajax({
    	            url: url,
    	            dataType: 'json',
    	            data: {"file": '<?php echo $this->file_created['code'];?>'},
    	            success: function (file) {               
   	            	 $('#trangthai_fileupload_list').html('<li id="file_'+file.id+'" ><input type="hidden" name="trangthai_fileupload_id[]" value="'+file.id+'"><a onclick="deleteFileById('+file.id+',\''+file.deleteUrl+'\')" class="btn btn-minier btn-danger" href="javascript:void(0);"><i class="icon-trash"></i></a> <a href="'+file.url+'" target="_blank">'+file.filename+'</a></li>');
    	            }
    	        });
    	    	<?php 
    	    }
    	    ?>
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        formData: {created_by: '<?php echo $user->id;?>'},
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('#fileupload_list').html('<li id="file_'+file.id+'" ><input type="hidden" name="fileupload_id[]" value="'+file.id+'"><a onclick="deleteFileById('+file.id+',\''+file.deleteUrl+'\')" class="btn btn-minier btn-danger" href="javascript:void(0);"><i class="icon-trash"></i></a> <a href="'+file.url+'" target="_blank">'+file.filename+'</a></li>');
               // $('#fileupload_list').html();
            });
        }
    });
    $('#trangthai_fileupload').fileupload({
        url: url,
        dataType: 'json',
        formData: {created_by: '<?php echo $user->id;?>'},
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('#trangthai_fileupload_list').html('<li id="file_'+file.id+'" ><input type="hidden" name="trangthai_fileupload_id[]" value="'+file.id+'"><a onclick="deleteFileById('+file.id+',\''+file.deleteUrl+'\')" class="btn btn-minier btn-danger" href="javascript:void(0);"><i class="icon-trash"></i></a> <a href="'+file.url+'" target="_blank">'+file.filename+'</a></li>');
            });
        }
    });

});
function deleteFileById(id,url){
	//console.log(id);
	//document.getElementById('file_'+id);
	//var url = this.href;
	//console.log(url);
	if(confirm('Bạn có muốn xóa không?')){
		jQuery.ajax({
			  type: "DELETE",
			  url: url,
			  success: function (data,textStatus,jqXHR){
					var element = document.getElementById('file_'+id);
					element.parentNode.removeChild(element);
					//console.log(data);
			  }
		});
	}
	return false;
}
</script>