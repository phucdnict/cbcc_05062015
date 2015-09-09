<?php
$deps = TochucHelper::collect('ins_dept', array('id AS value','name AS text'),array('TYPE = 1','ACTIVE = 1'),array('lft ASC'));
$option[] = array("value"=>'',"text"=>'');
$option[] = array("value"=>'150000',"text"=>'UBND Thành phố đà nẵng');
$deps = array_merge($option, $deps);
//array_unshift($deps, $option);
?>
<!-- begin form -->
<form class="form-horizontal" class="row-fluid" name="frmThanhLapPhong"	id="frmThanhLapPhong" method="post"	action="<?php echo JRoute::_('index.php?option=com_tochuc&controller=tochuc&task=savethanhlapphong')?>"  enctype="multipart/form-data">
	<h3 class="row-fluid header smaller lighter blue">
		<span class="span7">Tổ chức <small> <i class="icon-double-angle-right">
			</i> Thành lập mới phòng
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
			<li><a data-toggle="tab" href="#COM_TOCHUC_THANHLAP_TAB3">Cấu hình</a></li>

		</ul>
		<div class="tab-content">
			<div id="COM_TOCHUC_THANHLAP_TAB1" class="tab-pane active">
				<fieldset>
					<legend>Thông tin phòng</legend>
					<div class="row-fluid">
						<div class="control-group span6">
							<label class="control-label" for="name">Tên phòng <span class="required">*</span></label>
							<div class="controls">
							<input type="hidden" name="type" value="0" id="type" >
							<input type="text" value="<?php echo $this->row->name;?>"name="name" id="name">
							</div>
						</div>
						<div class="control-group span6">
							<label class="control-label" for="code">Mã số phòng</label>
							<div class="controls">
								<input type="text" value="<?php echo $this->row->code; ?>"
									id="code" name="code">
							</div>
						</div>
					</div>
					<div class="row-fluid">
						<div class="control-group span6">
							<label class="control-label" for="name">Tên viết tắt <span
								class="required">*</span></label>
							<div class="controls">
								<input type="text" value="<?php echo $this->row->name; ?>"
									name="s_name" id="s_name">
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
								<select id="TYPE_CREATED" name="TYPE_CREATED">
									<option value="1">Thành lập mới</option>
									<option value="2">Sáp nhập từ phòng khác</option>
									<option value="3">Chia tách từ phòng khác</option>
									<option value="4">Hợp nhất các phòng</option>										
								</select>
								</div>
						</div>
						<div class="control-group span6">
							<label class="control-label" for="ngay_hieuluc">Cơ quan ban hành <span class="required">*</span></label>
							<div class="controls">
								<?php echo JHTML::_('select.genericlist',$deps,'coquan_banhanh', array('style'=>'width:300px;','class'=>'chzn-select',"data-placeholder"=>"Chọn đơn vị ..."),'value','text','');?>
							</div>
						</div>	
					</div>
					<div class="row-fluid">
						<div class="control-group span6">							
							<label class="control-label" for="DATE_CREATED">Ngày ban hành <span class="required">*</span></label>
							<div class="controls">
								<input type="text" value="" class="input-mask-date" id="DATE_CREATED" name="DATE_CREATED">
							</div>							
						</div>
						<div class="control-group span6">
							<label class="control-label" for="NUMBER_CREATED">Số QĐ <span class="required">*</span></label>
							<div class="controls">
								<input type="text" value="" name="NUMBER_CREATED" id="NUMBER_CREATED">								
							</div>
						</div>					
					</div>
					<div class="row-fluid">
						<div class="control-group span6">							
							<label class="control-label" for="NAME_CREATED">Tên phòng theo quyết định <span class="required">*</span></label>
							<div class="controls">
								<input type="text" value="" id="NAME_CREATED" name="NAME_CREATED">
							</div>							
						</div>
						<div class="control-group span6">
							<label class="control-label">Văn bản đính kèm <span class="required">*</span></label>
							<div class="controls">								
								<input type="file" name="file_upload">
							</div>
						</div>					
					</div>
					<div class="row-fluid">			
						<div class="control-group span6">
							<label class="control-label" for="PARENT_ID">Cơ quan chủ quản <span	class="required">*</span></label>
							<div class="controls">                
                			<?php echo JHTML::_('select.genericlist',$deps,'parent_id', array('style'=>'width:300px;','class'=>'chzn-select',"data-placeholder"=>"Chọn đơn vị ..."),'value','text','');?>
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
	            	echo TochucHelper::selectBox(1, array('name'=>'ACTIVE'), 'ins_status', array('id','name')); 
	            ?>
	            				</div>
							</div>
							<div class="control-group trangthai">
								<label class="control-label" for="name">Cơ quan ban hành QĐ <span class="required">*</span></label>
								<div class="controls">
									<?php echo JHTML::_('select.genericlist',$deps,'trangthai[coquan_banhanh]', array('style'=>'width:300px;','class'=>'chzn-select',"data-placeholder"=>"Chọn đơn vị ..."),'value','text','');?>									
								</div>
							</div>
							<div class="control-group trangthai">
								<label class="control-label" for="name">Ngày QĐ <span class="required">*</span></label>
								<div class="controls">
									<input type="text" class="input-mask-date" name="trangthai[quyetdinh_ngay]" value="">
									
								</div>
							</div>	
							<div class="control-group trangthai">
								<label class="control-label" for="name">Số QĐ<span class="required">*</span></label>
								<div class="controls">
									<input type="text" name="trangthai[quyetdinh_so]"  value="">
									<input type="file" name="trangthai_file_upload">
								</div>
							</div>											
						</div>
		
						<div class="control-group span6">
								<label class="control-label" for="GHICHU">Ghi chú</label>
								<div class="controls">
								<?php
								$editor = &JFactory::getEditor();							
								echo $editor->display("GHICHU", '', "300", "100", "150", "10", 1, null, null, null, array('mode' => 'simple'));
								?>
									
								</div>
							</div>	
					</div>					
				</fieldset>
			</div>
			<div id="COM_TOCHUC_THANHLAP_TAB2" class="tab-pane">
			<fieldset class="input-tochuc">
			<legend>Thông tin thêm</legend>
				<div class="row-fluid">
					<div class="control-group span6">
								<label class="control-label" for="active">Lĩnh vực phòng</label>
								<div class="controls">
	               	<?php
					$linhvuc = array();
					TochucHelper::treeLinhvucPhong(0,0,&$linhvuc);
					//var_dump($linhvuc);
					for ($i = 0; $i < count($linhvuc); $i++) {
						?>
						<label class="checkbox" style="padding-left:<?php echo ($linhvuc[$i]['level'] * 20);?>px">
							<input type="checkbox" name="INS_LV[]"	value="<?php echo $linhvuc[$i]['id'];?>"><span class="lbl"> <?php echo $linhvuc[$i]['name'];?></span>
						</label>
						<?php 
					}
					?>	
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
								<input type="hidden" name="chkREP_HC_NAME" value="0">
								<label>
									<input type="checkbox" checked="checked" name="chkREP_HC_NAME" id="chkREP_HC_NAME" value="1"><span class="lbl">Dùng tên phòng</span>
								</label>									
								<input type="text" name="REP_HC_NAME" id="REP_HC_NAME" value="">
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
								<input type="hidden" name="chkREP_SN_NAME" value="0">
								<label>
									<input type="checkbox" checked="checked" name="chkREP_SN_NAME" value="1" id="chkREP_SN_NAME"><span class="lbl">Dùng tên phòng</span>
								</label>									
								<input type="text" name="REP_SN_NAME" id="REP_SN_NAME" value="">
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
								<input type="hidden" name="chkREP_BC_NAME" value="0">
								<label>
									<input type="checkbox" checked="checked" name="chkREP_BC_NAME" value="1" id="chkREP_BC_NAME"><span class="lbl">Dùng tên phòng</span>
								</label>								
								<input type="text" name="REP_BC_NAME" id="REP_BC_NAME" value="">								
							</div>
						</div>
						</div>
				</fieldset>	
			</div>
		</div>
	</div>
<?php echo JHTML::_( 'form.token' ); ?> 	
</form>
<script type="text/javascript">
jQuery(document).ready(function($){
	$.validator.setDefaults({ ignore: '' });
	$.validator.addMethod("required2", function(value, element) {
	    var isTochuc = $("#TYPE").val() === "1";
	    var val = value.replace(/^\s+|\s+$/g,"");//trim	 	
	    if(isTochuc && (eval(val.length) == 0)){
	    	 return false;
		}else{
			return true;
		}
	}, "Trường này là bắt buộc");
	$('#frmThanhLapPhong').validate({
		  rules: {
			  NAME: {	    
				  required: true
		      },
		      S_NAME: {	    
				  required: true
		      },
		      TYPE:{
		    	  required: true
			  },
		      parent_id: {	    
				  required: true
		      },
		      TYPE_CREATED: {	    
				  required: true
		      },
		      NUMBER_CREATED: {	    
				  required: true
		      },
		      DATE_CREATED: {	    
				  required: true,
				  dateVN:true
		      }
		  }
		 });
	 $('#btnThanhlapSubmit').click(function(){
		 tinymce.triggerSave();
		  var flag = $('#frmThanhLapPhong').valid();
		  if(flag == true){
			  document.frmThanhLapPhong.submit();
		  }
		  //console.log(flag);
		  return false;
	 });
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
	$('#ACTIVE').change(function(){
		toggleInputTrangthai(this.value);
	});
	var initPage = function(){
		$('.chzn-select').chosen({allow_single_deselect: true});
		$('.input-mask-date').mask('99/99/9999');
		//toggleInputTochuc($('#TYPE'));
		$('#chkREP_SN_NAME').click(function(){
			//console.log(this.checked);
			if(this.checked){
				$('#REP_SN_NAME').hide();
			}else{
				$('#REP_SN_NAME').show();
			}			
		});
		$('#chkREP_BC_NAME').click(function(){
			//console.log(this.checked);
			if(this.checked){
				$('#REP_BC_NAME').hide();
			}else{
				$('#REP_BC_NAME').show();
			}			
		});
		$('#chkREP_HC_NAME').click(function(){
			//console.log(this.checked);
			if(this.checked){
				$('#REP_HC_NAME').hide();
			}else{
				$('#REP_HC_NAME').show();
			}			
		});
		$('#REP_SN_NAME').hide();
		$('#REP_HC_NAME').hide();
		$('#REP_BC_NAME').hide();
		toggleInputTrangthai($('#ACTIVE').val());
	};
	initPage();
	 //form validate
	 
	 $('#thanhlap-tochuc-goichucvu').jstree({
		 "plugins": ["themes", "json_data", "ui","types"], 
  		"json_data":{
				"ajax" : {
					// the URL to fetch the data
					"url" : "api.php?task=tree&act=GOICHUCVU",	
					"data" : function(n) {
						return {
							"id" : n.attr ? n.attr("id").replace("node_", "") : 0
						};
					}
				}
			}
	 }).bind("select_node.jstree", function (event, data) {
		    
			// data.inst.select_node("#node_11", true);
			 var id = data.rslt.obj.attr("id").replace("node_","");
			 $('#CAPTOCHUC').val(id);
			 //console.log(data.rslt.obj.attr("id").replace("node_",""));			 
	});
	 $('#thanhlap-tochuc-goiluong').jstree({
		 "plugins": ["themes", "json_data", "ui","types"], 
  		"json_data":{
				"ajax" : {
					// the URL to fetch the data
					"url" : "api.php?task=tree&act=GOILUONG",	
					"data" : function(n) {
						return {
							"id" : n.attr ? n.attr("id").replace("node_", "") : 0
						};
					}
				}
			}
	 }).bind("select_node.jstree", function (event, data) {
		    
			// data.inst.select_node("#node_11", true);
			 var id = data.rslt.obj.attr("id").replace("node_","");
			 $('#GOILUONG').val(id);
			 //console.log(data.rslt.obj.attr("id").replace("node_",""));			 
	});
	 $('#thanhlap-cap-tochuc').jstree({
		 "plugins": ["themes", "json_data", "ui","types"], 
  		"json_data":{
				"ajax" : {
					// the URL to fetch the data
					"url" : "api.php?task=tree&act=CAPTOCHUC",	
					"data" : function(n) {
						return {
							"id" : n.attr ? n.attr("id").replace("node_", "") : 5
						};
					}
				}
			}
	 }).bind("select_node.jstree", function (event, data) {	    
			// data.inst.select_node("#node_11", true);
			 var id = data.rslt.obj.attr("id").replace("node_","");
			 $('#INS_CAP').val(id);
			 //console.log(data.rslt.obj.attr("id").replace("node_",""));			 
	});
	 $('#thanhlap-tochuc-loaihinh').jstree({
		 "plugins": ["themes", "json_data", "ui","types"], 
  		"json_data":{
				"ajax" : {
					// the URL to fetch the data
					"url" : "api.php?task=tree&act=LOAIHINHDONVI",	
					"data" : function(n) {
						return {
							"id" : n.attr ? n.attr("id").replace("node_", "") : 3
						};
					}
				}
			}
	 }).bind("select_node.jstree", function (event, data) {	    
			// data.inst.select_node("#node_11", true);
			 var id = data.rslt.obj.attr("id").replace("node_","");
			 $('#INS_LOAIHINH').val(id);
			 //console.log(data.rslt.obj.attr("id").replace("node_",""));			 
	});
	 $('#thuhang-donvi').jstree({
		 "plugins": ["themes", "json_data", "ui","types"], 
  		"json_data":{
				"ajax" : {
					// the URL to fetch the data
					"url" : "api.php?task=tree&act=THUHANG",	
					"data" : function(n) {
						return {
							"id" : n.attr ? n.attr("id").replace("node_", "") : 1
						};
					}
				}
			}
	 }).bind("select_node.jstree", function (event, data) {	    
			// data.inst.select_node("#node_11", true);
			 var id = data.rslt.obj.attr("id").replace("node_","");
			 $('#HANGDONVI').val(id);
			 //console.log(data.rslt.obj.attr("id").replace("node_",""));			 
	});
}); // end document.ready
</script>