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
<form class="form-horizontal row-fluid" name="frmGiaobienche" id="frmGiaobienche" method="post" action="<?php echo JRoute::_('index.php?option=com_tochuc&controller=tochuc&task=savegiaobienche')?>" enctype="multipart/form-data">
<input type="hidden" name="dept_id" value="<?php echo $this->dept_id;?>">
<input type="hidden" name="vanban_id" value="<?php echo $this->item->vanban_id;?>">
<input type="hidden" name="id" value="<?php echo $this->item->id;?>">
<?php echo JHTML::_( 'form.token' ); ?>
	<h3 class="row-fluid header smaller lighter blue">
		<span class="span7">Thông tin biên chế</span>
		<span class="span5">
		<span class="pull-right inline">
				<button class="btn btn-mini btn-success" id="btnResetForm" data-quatrinh-id="<?php echo $this->item->id;?>"><i class="icon-plus"></i> Thêm mới</button>	
				<button id="btnGiaobiencheSubmit" type="button"	class="btn btn-mini btn-primary"><i class="icon-save"></i> Lưu</button>
		
		</span>		
		</span> 

	</h3>
	<div class="row-fluid">
		<div class="control-group">
			<label class="control-label" for="nghiepvu_id">Nghiệp vụ <span class="required">*</span></label>
			<div class="controls">
                <?php
                	echo TochucHelper::selectBox($this->item->nghiepvu_id, array('name'=>'nghiepvu_id','hasEmpty'=>true), 'ins_nghiepvu_bienche', array('id','nghiepvubienche')); 
                ?>
            </div>							
		</div>
		<div class="control-group">
			<label class="control-label" for="nam">Năm <span class="required">*</span></label>
			<div class="controls">
          		 <input type="text" id="nam" name="nam" value="<?php echo $this->item->nam;?>"  class="input-mini input-mask-year" maxlength="4">
            </div>							
		</div>
	</div>		
	<fieldset>	
	<legend>Biên chế hiện có</legend>	
	<?php
	$k=0;
	for ($i = 0; $i < count($this->hinhthuc_bienche); $i++) {
		$htbienche = $this->hinhthuc_bienche[$i];
		if($k==0) echo '<div class="row-fluid">';
		?>
		<div class="control-group span6">
			<label class="control-label"><?php echo $htbienche['name'];?></label>
			<div class="controls">
				<input type="hidden" name="hinhthuc[]" value="<?php echo $htbienche['id'];?>" >
				<input type="text" name="bienche[]" value="<?php echo (int)$htbienche['bienche'] ?>"  class="input-mini" id="spinner-<?php echo $i;?>" >			
			</div>
		</div>
		<?php
		if($k==1) echo '</div>';
		$k = (1-$k); 
	} 
	?>	
	</fieldset>	
	<fieldset>
	<legend>Văn bản kèm theo</legend>
	<div class="row-fluid">
		<div class="control-group">
			<label class="control-label" for="quyetdinh_so">Số quyết định </label>
			<div class="controls">
				<div class="input-append">
                <input class="input-small" type="text" id="quyetdinh_so" name="quyetdinh_so" value="<?php echo $this->item->quyetdinh_so;?>">
                <span class="btn btn-success fileinput-button">
			        <i class="icon-paper-clip"></i>								    
			        <input id="fileupload" type="file" name="files">
			    </span>
                </div>
                <ul id="fileupload_list" class="files unstyled spaced"></ul> 
            </div>							
		</div>
	</div>
	<div class="row-fluid">
		<div class="control-group span6">
			<label class="control-label" for="quyetdinh_ngay">Ngày quyết định </label>  <span class="required">*</span>
			<div class="controls">
               <input type="text" id="quyetdinh_ngay" name="quyetdinh_ngay" class="input-small input-mask-date" value="<?php echo $this->item->quyetdinh_ngay;?>">
            </div>							
		</div>
		<div class="control-group span6">
			<label class="control-label" for="hieuluc_ngay">Hiệu lực ngày </label>
			<div class="controls">
               <input type="text"  id="hieuluc_ngay" name="hieuluc_ngay" class="input-small input-mask-date validNgayHL" value="<?php echo TochucHelper::strDateMySqltoVN($this->item->hieuluc_ngay);?>">
            </div>							
		</div>

	</div>
	<div class="row-fluid">
		<div class="control-group">
			<label class="control-label" for="ghichu">Ghi chú</label>
			<div class="controls">			               
               <textarea name="ghichu" id="ghichu" cols="30" rows="5"  class="mce_editable"><?php echo $this->item->ghichu;?></textarea>               
            </div>							
		</div>
	</div>
	</fieldset>
</form>
<script>
jQuery(document).ready(function($){
	var initPage = function(){
		$('.input-mask-date').mask('99/99/9999');
		//$('.input-mask-year').mask('9999');		
		$('#frmGiaobienche').validate({
			ignore: [],
			  rules: {
				  dept_id:{
					  required: true 
				  },
				  nam:{
					  required: true,
					  min: 1900,
					  number: true
				  },
				  nghiepvu_id:{
					  required: true 
				  },
				  cachthuc_id:{
					  required: true, 
				  },
				  quyetdinh_ngay: {
			    	  required: true,
			    	  dateVN:true
			      },
			  }, 
			  messages: {
					'nam': {
						min: "Phải nhập năm sau {0}.",
					}
			  }
		});
	//Thịnh thêm validate ngày quyết đinh < ngày hiệu lực
		$.validator.addMethod("validNgayHL", function(value, element) {
			var ngayquyetdinh = $('#quyetdinh_ngay');
			var ngayhieuluc = $('#hieuluc_ngay');
			//console.log (ngayquyetdinh.val());
			if(ngayquyetdinh.val() != '' && ngayhieuluc.val() != ''){
				if(Date.parseExact(ngayquyetdinh.val(),'dd/mm/yyyy').compareTo(Date.parseExact(ngayhieuluc.val(),'dd/mm/yyyy')) <= 0 ){
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
		}, "Ngày hiệu lực phải lớn hơn ngày quyết định");
	// end Thịnh
		
		 $('#btnGiaobiencheSubmit').click(function(){
			 tinymce.triggerSave();
			  var flag = $('#frmGiaobienche').valid();
			  if(flag == true){
				  document.frmGiaobienche.submit();
			  }
			  //console.log(flag);
			  return false;
		 });
		 $('#btnResetForm').click(function(){
				jQuery("#form-giaobienche").load('index.php?option=com_tochuc&controller=tochuc&task=editgiaobienche&format=raw&dept_id=<?php echo $this->dept_id;?>&time=<?php echo time();?>',function(){
					$('#tochuc-bienche-manager-collapse-one').collapse('show');
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
					
	};
	initPage();
	<?php if($this->file != null) { ?>
	//console.log(data.file);
	$.ajax({
		url: '<?php echo JUri::root(true)?>/uploader/index.php',
        dataType: 'json',
        data: {"created_by":'<?php echo $user->id;?>',"file":'<?php echo $this->file['code'];?>'},
        success: function (resp) {
//             console.log(resp);	
        	if(typeof resp.file != "undefined"){				      		            
            	$('#fileupload_list').html('<li id="file_'+resp.file.id+'" ><input type="hidden" name="fileupload_id[]" value="'+resp.file.id+'"><a onclick="deleteFileById('+resp.file.id+',\''+resp.file.deleteUrl+'\')" class="btn btn-minier btn-danger" href="javascript:void(0);"><i class="icon-trash"></i></a> <a href="'+resp.file.url+'" target="_blank">'+resp.file.filename+'</a></li>');
        	}
	    }
	});
	<?php } ?>
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