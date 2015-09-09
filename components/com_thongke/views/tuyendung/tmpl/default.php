<?php
/**
 * Author: Phucnh
 * Date created: May 29, 2015
 * Company: DNICT
 */
?>
<div id="div_tuyendung">
</div>

<script type="text/javascript">
var donvi_id;
jQuery(document).ready(function($){
    $.blockUI();
	$.ajax({
		type: 'POST',
		url: '<?php echo JUri::base(true)?>/index.php?option=com_thongke&view=tuyendung&format=raw&task=dsach_tuyendung',
		data:{donvi_id: donvi_id},
		success: function(data){
			var xhtml='<table role="grid" id="tbl_tuyendung" class="table table-striped table-bordered table-hover dataTable"></table>';
			$('#div_tuyendung').html(xhtml);
			$('#sl_tuyendung').html(' ('+data.length+')');
			var table = $('#tbl_tuyendung').DataTable({
			"data": data,
			"oTableTools": {
				"sSwfPath": "/media/cbcc/js/dataTables-1.10.0/swf/copy_csv_xls_pdf.swf",		
				"aButtons": [
								{
									"sExtends": "xls",
									"sButtonText": "Excel",
									"mColumns": [ 0,1,2,3,4,5,6,7 ],
									"sFileName": "Danhsachtuyendung.xls",
								},
								{ 	"sExtends":"print",
									"bShowAll": false
								},
									
							]
			},
			"deferRender":true,
	        "columns": [
	                    {"title":"Tên","width": "20%", "data": "e_name" , "render": function (data, type, row, meta) {
	                        return '<a style="cursor:pointer;" class="btn_edit_hoso" idhoso="'+row.id+'">'+data+'</a>';
	                    }},
	                    {"title":"Ngày sinh", "data": "ngaysinh", "render": function(data, type, row, meta){
		                    if (row.danhdaunamsinh == 1) return year(data);
		                    else return date(data);
		                 }},
	                    {"title":"Chức vụ", "data": "congtac_chucvu" },
	                    {"title":"Phòng công tác", "data": "congtac_phong" },			                   
	                    {"title":"Ngày tuyển dụng", "data": "luong_ngaybatdau", "render": function(data, type, row, meta){
		                     return date(data);
		                 }},
	                    {"title":"Tên ngạch", "data": "luong_tenngach" },
	                    {"title":"Bậc", "data": "luong_bac" },
	                    {"title":"Hệ số", "data": "luong_heso" },
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
});
</script>