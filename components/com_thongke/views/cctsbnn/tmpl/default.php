<?php
/**
 * Author: Phucnh
 * Date created: May 25, 2015
 * Company: DNICT
 */
?>
<div id="div_cctsbnn">
</div>

<script type="text/javascript">
var donvi_id;
jQuery(document).ready(function($){
    $.blockUI();
    $.ajax({
		type: 'POST',
		url: '/index.php?option=com_thongke&view=cctsbnn&format=raw&task=dsach_cctsbnn',
		data:{donvi_id: donvi_id},
		success: function(data){
			var xhtml='<table role="grid" id="tbl_cctsbnn" class="table table-striped table-bordered table-hover dataTable"></table>';
			$('#div_cctsbnn').html(xhtml);
			$('#sl_cctsbnn').html(' ('+data.length+')');
			var table = $('#tbl_cctsbnn').DataTable({
			"data": data,
			"oTableTools": {
				"sSwfPath": "/media/cbcc/js/dataTables-1.10.0/swf/copy_csv_xls_pdf.swf",		
				"aButtons": [
								{
									"sExtends": "xls",
									"sButtonText": "Excel",
									"mColumns": [ 0,1,2,3,4,5,6,7,8 ],
									"sFileName": "Tapsubonhiemngach.xls",
								},
								{ 	"sExtends":"print",
									"bShowAll": false
								},
									
							]
			},
			"deferRender":true,
			"serverSide": false,
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
	                    {"title":"Ngày bắt đầu HĐLĐ", "data": "ngaybatdau1" },
	                    {"title":"Ngày gia hạn", "data": "ngaybatdau2" },
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