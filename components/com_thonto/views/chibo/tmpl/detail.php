<?php
/**
 * Author: Phucnh
 * Date created: Aug 14, 2015
 * Company: DNICT
 */
?>
<h3 class="row-fluid header smaller lighter blue">
	<span id="thonto_current" class="span6">Danh sách chi bộ<small><i class="icon-double-angle-right"></i><span id='tenchibo'></span> </small></span>
	<span class="span6">
		<span class="pull-right inline">			
				<span class="btn btn-small btn-success" id="btn_themmoi_chibo" data-toggle="modal" data-target=".modal">Thêm mới</a>
		</span>
	</span>
</h3>
<div id='div_danhsach_chibo'></div>
<script type="text/javascript">
jQuery(document).ready(function($){
	$('#btn_themmoi_chibo').on('click', function(){
		if (ins_cap == 12 || ins_cap == 13){
			$.blockUI();
			$('#div_modal').load('/index.php?option=com_thonto&view=chibo&format=raw&task=frmchibo&px_id='+id,function(){
				$.unblockUI();
			});
		}
		else {alert('Vui lòng chọn phường xã');return false;}
	});
	$.unblockUI();
	var az = function(){
		$.ajax({
			type: 'POST',
			url: '<?php echo JUri::base(true)?>/index.php?option=com_thonto&view=chibo&format=raw&task=danhsachchibo&px_id='+id,
			data:{id: id},
			success: function(data){
				  var xhtml='<table role="grid" id="tbl_chibo" class="table table-striped table-bordered table-hover dataTable"></table>';
					$('#div_danhsach_chibo').html(xhtml);
					var table = $('#tbl_chibo').DataTable({
					"data": data,
					"oTableTools": {
						"sSwfPath": "/media/cbcc/js/dataTables-1.10.0/swf/copy_csv_xls_pdf.swf",		
						"aButtons": [
										{
											"sExtends": "xls",
											"sButtonText": "Excel",
											"mColumns": [ 0,1,2,3,4,5,6,7 ],
											"sFileName": "Danhsachchibo.xls",
										},
										{ 	"sExtends":"print",
											"bShowAll": false
										},
											
									]
					},
					"deferRender":true,
			    "columns": [
			                {"title":"Tên chi bộ","width": "50%", "data": "ten" , "render": function (data, type, row, meta) {
			                    return '<a style="cursor:pointer;"  data-toggle="modal" data-target=".modal" class="btn_edit_chibo" idchibo="'+row.id+'">'+data+'</a>';
			                }},
			                {"title":"Năm thành lập", "data": "namthanhlap" },
			                {"title":"Số lượng thành viên", "data": "soluongthanhvien" },
			                {"title":"Ghi chú", "data": "ghichu" },
			                {"title":"Thao tác", "data": "id" , "render": function (data, type, row, meta) {
			                    return '<span style="cursor:pointer;"  class="btn_delete_chibo btn btn-small btn-danger" idchibo="'+row.id+'">Xóa</span>';
			                }},
			            ],
					"bSort": true,
				   	"columnDefs": [
							{
								"targets": [0],
								"orderable": false
						}],
					 "stateSave": true,
					});
					$.unblockUI();
			}
		});
	};
	az();
	$('body').delegate('.btn_delete_chibo','click', function(){
// 	$('.btn_delete_chibo').on('click', function(){
		if(confirm("Bạn có chắc chắn xóa chi bộ này không ?")){
			var idchibo = $(this).attr('idchibo');
			$.blockUI();
			$.ajax({
				type: 'POST',
				url: '<?php echo JUri::base(true)?>/index.php?option=com_thonto&controller=chibo&format=raw&task=xoachibo&idchibo='+idchibo,
				success: function(data){
					if (data==true){
						$.unblockUI();
						loadNoticeBoardSuccess('Thông báo','Xử lý thành công!');
						az();
					}
					else{
						$.unblockUI();
						loadNoticeBoardError('Thông báo','Có lỗi bất thường xảy ra. Vui lòng liên hệ quản trị viên!');
					}
				}
			});
		}
	});
	$('#tenchibo').html($('.jstree-clicked').text());
});
</script>