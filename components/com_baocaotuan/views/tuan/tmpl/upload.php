<?php
/**
 * Author: Phucnh
 * Date created: Aug 3, 2015
 * Company: DNICT
 */
?>
<div>
	Chọn tệp tin để upload: 
	<input type="file" id="fileupload" name="fileupload"/>
</div>
<div>
	<a data-original-title="Import" class="btn btn-small btn-primary" id="btn_import_fileupload" style="margin-right: 5px;">
			<i class="icon-upload"></i> Import
	</a>
</div>
	<div id="ketqua">
</div>
<script type="text/javascript">
jQuery(document).ready(function($){
$('#btn_import_fileupload').on('click',function(){
	var filefullname = $('#fileupload').val();
	var file_data = $('#fileupload').prop('files')[0];
	var form_data = new FormData();
	form_data.append('file', file_data);
	if (filefullname=="")
	{alert('Vui lòng chọn tệp tin');}
	else{
		if ((isExcel(filefullname)) && ((filefullname.split(".").length - 1)==1)){
			$.blockUI();
			$.ajax({
				type: 'POST',
				url: '<?php echo JUri::base(true);?>/index.php?option=com_baocaotuan&controller=tuan&format=raw&task=uploadtuan',
				data: form_data,
				dataType: 'text',
				cache: false,
				contentType: false,
				processData: false,
				success:function(data){
					$('#ketqua').html(data);
					$.unblockUI();
// 					$('#fileupload').val('');
				}
			});
		}
		else alert('Tập tin không hợp lệ!\n Các loại tập tin được hỗ trợ: xls, xlsx, csv.\n Vui lòng chọn lại file!!!');
	}
});

	function getExtension(filename) {
		var parts = filename.split('.');
		return parts[parts.length - 1];
	}

	function isExcel(filename) {
		var ext = getExtension(filename);
		switch (ext.toLowerCase()) {
			case 'xls':
			case 'xlsx':
			case 'csv':
				return true;
		}
		return false;
	}
});
</script>