<?php
$user = JFactory::getUser();
$model = Core::model('Thonto/Tochuc');
?>
<form class="form-horizontal row-fluid" name="frmThanhLap"	id="frmThanhLap" method="post"	action="/index.php?option=com_thonto&controller=tochuc&task=savethanhlap"enctype="multipart/form-data">
	<h3 class="row-fluid header smaller lighter blue">
		<span class="span5">Tổ dân phố/Thôn
		<?php	if ((int)$this->row->id == 0) {?>
			<small><i class="icon-double-angle-right"></i> Thành lập mới</small>
			<?php 	}
				else{?>
			<small><i class="icon-double-angle-right"></i> Hiệu chỉnh <?php echo $this->row->ten; ?></small>
			<?php 	}	?>
		</span> <span class="span7"> <span class="pull-right inline">
				<span id="btnThanhlapSubmitAndNew"  class="btn btn-small btn-primary">
					<i class="icon-save"></i> Lưu và Thêm mới
				</span> 
				<span id="btnThanhlapSubmitAndClose"  class="btn btn-small btn-primary">
					<i class="icon-save"></i> Lưu và Quay lại
				</span> 
				<a class="btn btn-small btn-info" href="<?php echo '/index.php?option=com_thonto&controller=tochuc&task=default';?>">←Quay về</a>
		</span>
		</span>
	</h3>
	<div class="row-fluid form-horizontal">
	<div class="control-group span6">
		<label class="control-label" for="parent_id">Cây đơn vị <span class="required">*</span></label>
		<div class="controls">							
		<input type="hidden" value="<?php echo $this->row->parent_id; ?>" name="parent_id_content" id="parent_id_content">							
		<div class="input-append">
		<input type="text" class="input-xlarge" value="<?php echo Core::loadResult('thonto_tochuc', array('ten'), array('id = '=>$this->row->parent_id)); ?>" name="cha_name" id="cha_name" readonly="readonly">
		  <a data-target="#tochuc-parent-tree_detail" role="button" class="btn" data-toggle="collapse">...</a>					  
		</div>	
			<div id="tochuc-parent-tree_detail" class="collapse">									
				<div id="tochuc-parent-tree"></div>			
			</div>							
		</div>
	</div>
	<div class="control-group span6">
		<label class="control-label" for="type">Loại <span class="required">*</span></label>
		<div class="controls">
			<?php echo $model->selectBox($this->row->kieu, array('name'=>'type_content'), 'thonto_loaihinhtochuc', array('id','ten'));?>
		</div>
	</div>
</div>
<input type='hidden' name='typeSave' id='typeSave'>
<div id="content_form"></div>
</form>
<script type="text/javascript">
var validHoso = function(){
	document.frmThanhLap.submit();
}
var px_id;
jQuery(document).ready(function($){	
	var subm = function(){
		var loaihinhtochuc =$('#type_content option:checked').val();
		if (loaihinhtochuc==1 && px_id >0){
			loadNoticeBoardError('Thông báo','Nhập sai cấu trúc! Vui lòng nhập lại.');
			return false;
		}else{
			$.blockUI();
			var flag = $('#frmThanhLap').valid();
			if(flag == true){
				validHoso();
			}
			$.unblockUI();
			return false;
		}
	};
	$('#btnThanhlapSubmitAndNew').on('click', function(){
		$('#typeSave').val('savenew');
		subm();
	});
	$('#btnThanhlapSubmitAndClose').on('click', function(){
		$('#typeSave').val('saveclose');
		subm();
	});
		$('#tochuc-parent-tree').jstree({
		 	"plugins": ["themes", "json_data","checkbox", "ui","types"],
		 	 "json_data" : {
				 "data" : [{ "attr" : { "id" : "<?php echo $this->root_info['root_id'];?>", "showlist":"<?php echo $this->root_info['root_showlist'];?>"},
			     "state" : "closed",
			     "data" : {
			       "title" : "<?php echo $this->root_info['root_name'];?>",
			       "attr" : { "href" : "#" }
			      }
			  }],
			  "ajax" : {
			   "url" : "<?php echo JURI::base(true);?>/index.php",
			   "data" : function (n) {
			    return {
			     "option" : "com_thonto",                            
			     "view" : "treeview",
			     "task" : "treeThonto",
			     "format" : "raw",                            
			     "id" : n.attr ? n.attr("id").replace("node_","") : <?php echo $this->root_info['root_id'];?>
			    };
			   }
			  }
			  },
			"checkbox":{
				"override_ui":false,
				"two_state":true
				},
				"types" : {
					"valid_children" : [ "root" ],
					"types" : {
						"file" : {
							"icon" : { 
								"image" : "<?php echo JUri::root(true);?>/media/cbcc/js/jstree/file.png" 
							}            					
						},
						"folder" : {
							"icon" : { 
								"image" : "<?php echo JUri::root(true);?>/media/cbcc/js/jstree/folder.png" 
							}            					
						},
						"default" : {
							"valid_children" : [ "default" ]
						},
						"disabled" : { // Defining new type 'disabled'
					          "check_node" : false, 
					          "uncheck_node" : false 
					     },
					     "default" : { // Override default functionality
					          "check_node" : function (node) {
					        	$('#tochuc-parent-tree').jstree('uncheck_all');
					            return true;
					          },
					          "uncheck_node" : function (node) {
					            return true;
					          }
					      } 
					}
				}
		}).bind("loaded.jstree", function (event, data) {
			var curr_id = $('#parent_id_content').val();
		 	$.jstree._focused().check_node("#node_"+curr_id);
		})
		.bind("select_node.jstree", function (event, data) {
			data.inst.toggle_node(data.rslt.obj);
		}).bind("check_node.jstree", function(e, data){
			var node_id = data.rslt.obj.attr('id').replace('node_','');		
			px_id = data.rslt.obj.attr('px_id');
	        
			// của mục cây Đơn vị
			$('#parent_id_content').val(node_id);
  		    $('#cha_name').val($.trim(data.rslt.obj.children('a').text()));
  		    //---------- THÔN TỔ
			$('#donvi_id_tochuc').val(px_id); 
  		    // tích chọn cây, lấy hososochinh
  	  		    	// cập nhật select mã hồ sơ quản lý
	    		  $.ajax({
	    	  			type: 'GET',
	    	    			url: '<?php echo JUri::base(true);?>/index.php?option=com_thonto&controller=tochuc&task=gethosoquanly&format=raw&px_id='+px_id,
	    	    			success:function(data){
	    	    	  			$('#hosochinh_id_tochuc').val(data);
	    	    			}
	    		  });   
  	  				// cập nhật select chi bộ
    		  if($('#type_content option:selected').val()==4 || $('#type_content option:selected').val()==5){
	    		  $.ajax({
	  				type: 'GET',
	  	  			url: '<?php echo JUri::base(true);?>/index.php?option=com_thonto&controller=tochuc&task=getchibo&format=raw&px='+px_id,
	  	  			success:function(data){
	  	  	  			$('#div_chibo').html(data);
	  	  			}
	  	      	  });
    		  }
		}).bind("uncheck_node.jstree", function (event, data) {
			px_id=null;
			$('#donvi_id_tochuc').val('');
			$('#parent_id_content').val('');
  		    $('#cha_name').val('');
		});
		var buildForm = function(type_id){
			if(type_id == '1' || type_id == '2'){
				url='<?php echo JUri::root(true)?>/index.php?option=com_thonto&controller=tochuc&task=editvochua&format=raw&type='+type_id;	
			}else if(type_id=='3'){
				url='<?php echo JUri::root(true)?>/index.php?option=com_thonto&controller=tochuc&task=editphuongxa&format=raw&type='+type_id;	
			}else if(type_id=='4' || type_id=='5' ){
				url='<?php echo JUri::root(true)?>/index.php?option=com_thonto&controller=tochuc&task=editthonto&format=raw&type='+type_id;	
			}
			
			jQuery.ajax({
				  type: "GET",
				  url: url,
				  data:{"id":<?php echo (int)$this->row->id;?>},
				  beforeSend: function(){
					  $.blockUI();
					  $('#content_form').empty();
					},
				  success: function (data,textStatus,jqXHR){
					  $.unblockUI();
					  $('#content_form').html(data);
				  }
			});	
		}
		
		$('#type_content').change(function(event){
			event.preventDefault();
			var that = $(this);
			buildForm(that.val());
		});
		buildForm($('#type_content').val());
		////
		$('#frmThanhLap').validate({
			ignore: [],
			errorPlacement : function(error, element) {},
			  rules: {
			      "ten": {
			    	  required: true,
			      },
			      "tenviettat": {
			    	  required: true,
			      },
			      "parent_id_content": {
			    	  required: true,
			      },
		},messages:{
			"ten": { required : 'Vui lòng nhập <b>Tên</b>' ,},
			"tenviettat": { required : 'Vui lòng nhập <b>Tên viết tắt</b>'  ,},
			"parent_id_content": { required : 'Vui lòng chọn <b>Đơn vị</b>',},
		},invalidHandler: function(form, validator) {
			var errors = validator.numberOfInvalids();
			if (errors) {
				var message = errors == 1 ? 'Kiểm tra lỗi sau:<br/>' : 'Phát hiện ' + errors + ' lỗi sau:<br/>';
				var errors = "";
				if (validator.errorList.length > 0) {
					for (x=0;x<validator.errorList.length;x++) {
						errors += "<br/>\u25CF " + validator.errorList[x].message;
					}
				}
				loadNoticeBoardError('Thông báo',message + errors);
			}
			validator.focusInvalid();
		}
	});
}); // end document.ready
</script>