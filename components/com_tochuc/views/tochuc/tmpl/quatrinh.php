<?php
$user = JFactory::getUser();
?>
<script type="text/javascript" src="<?php echo JUri::root(true)?>/media/editors/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
					tinymce.init({
						// General
						directionality: "ltr",
						selector: "textarea.mce_editable",
						language : "vi",
						mode : "specific_textareas",
						autosave_restore_when_empty: false,
						skin : "lightgray",
						theme : "modern",
						schema: "html5",
						menubar: false,
						toolbar1: "bold italics underline strikethrough | undo redo | bullist numlist",
						// Cleanup/Output
						inline_styles : true,
						gecko_spellcheck : true,
						entity_encoding : "raw",
						force_br_newlines : false, force_p_newlines : true, forced_root_block : 'p',
						toolbar_items_size: "small",
						// URL
						relative_urls : true,
						remove_script_host : false,
						// Layout
						content_css : "<?php echo JUri::root(true);?>/templates/system/css/editor.css",
						document_base_url : "<?php echo JUri::root();?>"
					});
</script>
<h3 class="row-fluid header smaller lighter green">
	<span class="span6">Lịch sử tổ chức </span>
	<span class="span6">
		<span class="pull-right inline">
			<a id="btnBack" class="btn btn-mini btn-info" href="index.php?option=com_tochuc&controller=tochuc&task=detail&format=raw&Itemid=<?php echo $this->Itemid;?>&id=<?php echo $this->item->id;?>">← Quay về</a>		
		</span>										
	</span>
</h3>
<div class="accordion" id="tochuc-quatrinh-manager-accordion">
	<div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="tochuc-quatrinh-manager-accordion" href="#tochuc-quatrinh-manager-collapse-one">
        Nghiệp vụ
      </a>
    </div>
    <div id="tochuc-quatrinh-manager-collapse-one" class="accordion-body collapse">
      <div class="accordion-inner">
			<form class="form-horizontal" class="row-fluid" name="frmQuaTrinh" id="frmQuaTrinh" method="post" action="<?php echo JRoute::_('index.php?option=com_tochuc&controller=tochuc&task=savequatrinh')?>" enctype="multipart/form-data">
			<?php echo JHTML::_( 'form.token' ); ?> 
			<input type="hidden" name="dept_id" value="<?php echo $this->item->id; ?>">
			<input type="hidden" name="id" value="" id="quatrinh_id">
			<input type="hidden" name="vanban_id" value="" id="vanban_id">
			<h3 class="row-fluid header smaller lighter blue">
				<span class="span7">Thông tin quá trình</span>
				<span class="span5">
					<span class="pull-right inline">
						<button class="btn btn-mini btn-success" id="btnResetForm"><i class="icon-plus"></i> Thêm mới</button>
						<button class="btn btn-mini btn-primary" id="btnAddQuaTrinh"><i class="icon-save"></i> Lưu</button>												
					</span>																						
				</span>
			</h3>
				<div class="row-fluid">
					<div class="control-group">
						<label class="control-label" for="cachthuc_id">Nghiệp vụ <span class="required">*</span></label>
						<div class="controls">
			                <?php
			                	echo TochucHelper::selectBox('', array('name'=>'cachthuc_id','hasEmpty'=>true), 'ins_dept_cachthuc', array('id','name')); 
			                ?>
			            </div>							
					</div>
					<div class="control-group">
						<label class="control-label" for="chitiet">Tên tổ chức theo quyết định là</label>
						<div class="controls">			               
			                <input type="text" id="name" name="name" value="<?php echo $this->item->name; ?>">
			                <input type="hidden" name="is_changename" value="0">
			                <label><input type="checkbox" name="is_changename" value="1"><span class="lbl"> Sử dụng làm tên chính thức</span></label>
			            </div>							
					</div>	
					<div class="control-group">
						<label class="control-label" for="quyetdinh_so">Số quyết định</label>
						<div class="controls">
							<div class="input-append">
			               	<input type="text" id="quyetdinh_so" name="quyetdinh_so" value="" class="input-small">
			               	<span class="btn btn-success fileinput-button">
						       <i class="icon-paper-clip"></i>							    
						        <input id="fileupload"  type="file" name="files">
						    </span>	
			               	</div>			               								   
						    <ul id="fileupload_list" class="files unstyled spaced"></ul>
			            </div>							
					</div>
					</div>
					<div class="row-fluid">
					<div class="control-group span6">
						<label class="control-label" for="quyetdinh_ngay">Ngày quyết định</label>
						<div class="controls">
			               <input type="text" id="quyetdinh_ngay" name="quyetdinh_ngay" class="input-small input-mask-date" value="">
			            </div>							
					</div>
			
					<div class="control-group span6">
						<label class="control-label" for="hieuluc_ngay">Hiệu lực ngày</label>
						<div class="controls">
			               <input type="text"  id="hieuluc_ngay" name="hieuluc_ngay" class="input-small input-mask-date validNgayHL" value="">
			            </div>							
					</div>
				</div>
				<div class="row-fluid">
					<div class="control-group">
						<label class="control-label" for="chitiet">Nội dung chi tiết</label>
						<div class="controls">
			               <textarea name="chitiet" id="chitiet" cols="30" rows="5"  class="mce_editable"></textarea>               
			            </div>							
					</div>					
					<div class="control-group">
						<label class="control-label" for="ghichu">Ghi chú</label>
						<div class="controls">			               
			               <textarea name="ghichu" id="ghichu" cols="30" rows="5"  class="mce_editable"></textarea>               
			            </div>							
					</div>
				</div>
			</form>
      </div>
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
					$vanban = TochucHelper::getVanBanById($row['vanban_id']);
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
						<td><?php echo TochucHelper::getNameById($row['cachthuc_id'], 'ins_dept_cachthuc');?></td>
						<td><?php echo $vanban['mahieu'];?></td>						
						<td><?php echo $row['chitiet'];?></td>
						<td><?php echo $row['ghichu'];?></td>						
						<td nowrap="nowrap">
							<button class="btn btn-mini btn-info btnEditQuatrinh" data-quatrinh-id="<?php echo $row['id'] ?>"><i class="icon-pencil"></i></button>				
							<a class="btn btn-mini btn-danger btnDeleteQuatrinh" href="index.php?option=com_tochuc&controller=tochuc&task=delquatrinh&id=<?php echo $row['id'] ?>"><i class="icon-trash"></i></a>							
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
	$('#btnBack').click(function(){	
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
	//$.validator.setDefaults({ ignore: '' });
//     var toggleCNNV = function(checked){
//         //console.log(checked);
//       	if(checked == true){
//       		$(".isCheckedCNNV").hide();
//       		$(".notCheckedCNNV").show();
//         }else{
//         	$(".isCheckedCNNV").show();
//         	$(".notCheckedCNNV").hide();
//         }
// 	};
// 	var intChachThuc = function(cachthuc_id){		
// 		$('.isThanhlap,.notThanhLap').hide();
// 		if(cachthuc_id == 1){
// 			$('.isThanhlap').show();
// 		}
// 		else if(cachthuc_id > 1){
// 			$('.notThanhLap').show();
// 		}
// 	};
// 	$('#isCheckedCNNV').click(function () {
// 	    //$("#thanhlap-theoten").toggle(!this.checked);
// 		//$('#hasDoiten:checked').length
// 		toggleCNNV($('#isCheckedCNNV:checked').length);
// 	});
// 	$('#cachthuc_id').change(function(){
// 		intChachThuc($(this).val());
// 	});
	var resetForm = function(){
		$('#frmQuaTrinh #quatrinh_id').val('');
		$('#frmQuaTrinh #vanban_id').val('');
		$('#frmQuaTrinh #name').val('<?php echo $this->item->name; ?>');
		$('#frmQuaTrinh #cachthuc_id').val('');
		$('#frmQuaTrinh #quyetdinh_so').val('');
		$('#frmQuaTrinh #quyetdinh_ngay').val('');
		$('#frmQuaTrinh #hieuluc_ngay').val('');
		//$('#frmQuaTrinh #name').val('');
		$('#fileupload_list').empty();
		tinymce.editors.chitiet.setContent('');
		tinymce.editors.ghichu.setContent('');
		return false;
	};
	var initPage = function(){
		$('.chzn-select').chosen({
			allow_single_deselect: true,
            no_results_text: 'Không tìm thấy'
        });
		$('.input-mask-date').mask('99/99/9999');
// 		intChachThuc($('#cachthuc_id').val());
// 		toggleCNNV($('#isCheckedCNNV:checked').length);

		$('#frmQuaTrinh').validate({
			ignore: [],
			  rules: {
				  cachthuc_id:{
					  required: true, 
				  },
			      quyetdinh_ngay: {
				  	  required: true,
				  	  dateVN:true
				  }
// 		  ,			
// 				  hieuluc_ngay: {	    
// 					  required: true,
// 					  dateVN:true
// 			      },

// 			      quyetdinh_so: {		    	  
// 					  required: true
// 			      }	
			  }
		});		
		 $('#btnResetForm').click(function(){			 
			  resetForm();
			  tinymce.triggerSave();
			  return false;
		 });
		 $('#btnAddQuaTrinh').click(function(){
			 tinymce.triggerSave();
			  var flag = $('#frmQuaTrinh').valid();
			  if(flag == true){
				  document.frmQuaTrinh.submit();
			  }
			  //console.log(flag);
			  return false;
		 });
		 $('.btnDeleteQuatrinh').click(function(){	
			 return confirm('Bạn có muốn xóa không?');
		 });
		 
		 $('.btnEditQuatrinh').click(function(){
			var url = '<?php echo JUri::root(true)?>/index.php?option=com_tochuc&controller=tochuc&format=raw&task=readquatrinh';
			$.blockUI();
			$.get(url,{id:$(this).attr('data-quatrinh-id')},function(data){
				$.unblockUI();
				//console.log(data.hieuluc_ngay);
				if(data.name == null)data.name = '';
				if(data.id == null)data.id = 0;				
				if(data.cachthuc_id == null)data.cachthuc_id = '';
				if(data.quyetdinh_so == null)data.quyetdinh_so = '';
				if(data.quyetdinh_ngay == null)data.quyetdinh_ngay = '';
				if(data.hieuluc_ngay == null)data.hieuluc_ngay = '';
				if(data.chitiet == null)data.chitiet = '';
				if(data.ghichu == null)data.ghichu = '';
				if(data.dept_name == null)data.dept_name = '';
				$('#frmQuaTrinh #quatrinh_id').val(data.id);
				$('#frmQuaTrinh #vanban_id').val(data.vanban_id);
				$('#frmQuaTrinh #name').val(data.name);
				$('#frmQuaTrinh #cachthuc_id').val(data.cachthuc_id);
				$('#frmQuaTrinh #quyetdinh_so').val(data.quyetdinh_so);
				$('#frmQuaTrinh #quyetdinh_ngay').val(data.quyetdinh_ngay);
				$('#frmQuaTrinh #hieuluc_ngay').val(data.hieuluc_ngay);
				$('#frmQuaTrinh #name').val(data.dept_name);
				if(data.file != null){
					//console.log(data.file);
					$.ajax({
						url: '<?php echo JUri::root(true)?>/uploader/index.php',
				        dataType: 'json',
				        data: {"file":data.file.code},
				        success: function (resp) {	
				        	if(typeof resp.file.id != "undefined"){				      		            
				            	$('#fileupload_list').html('<li id="file_'+resp.file.id+'" ><input type="hidden" name="fileupload_id[]" value="'+resp.file.id+'"><a onclick="deleteFileById('+resp.file.id+',\''+resp.file.deleteUrl+'\')" class="btn btn-minier btn-danger" href="javascript:void(0);"><i class="icon-trash"></i></a> <a href="'+resp.file.url+'" target="_blank">'+resp.file.filename+'</a></li>');
				        	}
					    }
					});
				}				
				tinymce.editors.chitiet.setContent(data.chitiet);
				tinymce.editors.ghichu.setContent(data.ghichu);
				$('#tochuc-quatrinh-manager-collapse-one').collapse('show');
						//jQuery('#myTab3 a:last').tab('show');
			});
			
			  return false;
		 });		   
		    $('#fileupload').fileupload({
		        url: '<?php echo JUri::root(true)?>/uploader/index.php',
		        dataType: 'json',
		        formData: {created_by: '<?php echo $user->id;?>'},
		        done: function (e, data) {
		            $.each(data.result.files, function (index, file) {
		                $('#fileupload_list').html('<li id="file_'+file.id+'" ><input type="hidden" name="fileupload_id[]" value="'+file.id+'"><a onclick="deleteFileById('+file.id+',\''+file.deleteUrl+'\')" class="btn btn-minier btn-danger" href="javascript:void(0);"><i class="icon-trash"></i></a> <a href="'+file.url+'" target="_blank">'+file.filename+'</a></li>');
		               // $('#fileupload_list').html();
		            });
		        }
		    });
 //Thịnh thêm validate ngày quyết đinh < ngày hiệu lực
			$.validator.addMethod("validNgayHL", function(value, element) {
				var ngayquyetdinh = $('#quyetdinh_ngay'); 
				var ngayhieuluc = $('#hieuluc_ngay');  
				if(ngayquyetdinh.val() != '' && ngayhieuluc.val() != ''){
					if(Date.parseExact(ngayquyetdinh.val(),'dd/mm/yyyy').compareTo(Date.parseExact(ngayhieuluc.val(),'dd/mm/yyyy')) <= 0){
						ngayquyetdinh.addClass('valid').removeClass('error');
						ngayhieuluc.addClass('valid').removeClass('error');
						return true;
					}else{
						ngayquyetdinh.addClass('error').removeClass('valid');
						ngayhieuluc.addClass('error').removeClass('valid');
						return false;
					}
				}else{
					ngayquyetdinh.addClass('valid').removeClass('error');
					ngayhieuluc.addClass('valid').removeClass('error');
					return true;
				}
			}, "Ngày ban hành lớn hơn ngày thành lập");
// end Thịnh    
					
	};
	initPage();
});
function deleteFileById(id,url){
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