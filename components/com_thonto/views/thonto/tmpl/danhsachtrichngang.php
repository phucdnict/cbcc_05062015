<?php
defined('_JEXEC') or die('Restricted access');
?>
<form id="frmHosoDanhsach" name="frmHosoDanhsach" method="post" action="index.php?option=com_thonto&controller=thonto">
<table id="table_thongtinchung" class="table table-bordered">
<thead>
<tr style="background: #ECECEC;">
	<th class="center" style="vertical-align:middle;" rowspan="2">
		<input type="checkbox" class="ace-checkbox-2" id="chkAllDSTN"/>
		<span class="lbl"></span>
	</th>
	<th class="center" style="vertical-align:middle;" colspan="5">Thông tin chung</th>
	<th class="center" style="vertical-align:middle;" colspan="2">Đào tạo, nghiệp vụ</th>
	<th class="center" style="vertical-align:middle;" colspan="3">Công tác hiện tại</th>
	<th class="center" style="vertical-align:middle;" colspan="2">Thông tin Đảng viên</th>
	<th class="center" style="vertical-align:middle;" rowspan="2">Loại BHYT</th>
</tr>
<tr style="background: #ECECEC;">
	<th class="center" style="min-width: 110px">Họ và tên</th>
	<th class="center" style="vertical-align:middle;">Ngày sinh</th>
	<th class="center" style="vertical-align:middle;">Giới tính</th>
	<th class="center" style="vertical-align:middle;">Điện thoại</th>
	<th class="center" style="vertical-align:middle;">Email</th>
	<th class="center" style="vertical-align:middle;">Trình độ</th>
	<th class="center" style="vertical-align:middle;">Nghiệp vụ</th>
	<th class="center" style="vertical-align:middle;">Thôn, tổ</th>
	<th class="center" style="vertical-align:middle;">Chức vụ</th>
	<th class="center" style="vertical-align:middle;">Nghề nghiệp hiện tại</th>
	<th class="center" style="vertical-align:middle;">Ngày vào Đảng</th>
	<th class="center" style="vertical-align:middle;">Ngày chính thức</th>
	
</tr>
</thead>
</table>
<input type="hidden" name="option" value="com_thonto" />
<input type="hidden" name="controller" value="thonto" />
<input type="hidden" name="view" value="thonto" />
</form>
<script type="text/javascript">
jQuery(document).ready(function($){
	var oTable1 = $('#table_thongtinchung').DataTable( {
		"ajax": {
			"url":"<?php echo JUri::base(true);?>/index.php?option=com_thonto&controller=thonto&task=dataTrichngang&id_donvi="+$('#id_donvi').val(),
			"type":"POST"
		},
		"oLanguage": {
            "sUrl": "<?php echo JUri::base(true);?>/media/cbcc/js/dataTables.vietnam.txt"
        },
        "sDom": "<'dataTables_wrapper'C<'clear'><'row-fluid'<'span3'f><'span3'<'pull-right'rT>><'span6'p>t<'row-fluid'<'span2'l><'span4'i><'span6'p>>>",
 		"oTableTools": {
 			"sSwfPath": "<?php echo JUri::base(true);?>/media/cbcc/js/dataTables-1.10.0/swf/copy_csv_xls_pdf.swf",		
          	"aButtons": [
				{
					"sExtends":    "text",
					"sButtonText": "Excel All",
					"fnClick": function ( nButton, oConfig, oFlash ) {
						window.location.href = '<?php echo JURI::base(true);?>/index.php?option=com_thonto&controller=thonto&format=raw&task=exportDSTrichngang&id_donvi='+$('#id_donvi').val();
						return ;
					}
				},
				{
					"sExtends": "xls",
					"sButtonText": "Excel",
					"mColumns": [ 1,2,3,4,5,6,7,8,9,10,11,12,13 ],
					"sFileName": "Danhsachtrichngang.xls"
				},
				"print"
			]
 		},
  	  	"columnDefs": [
			{
				"targets": 0,
				"searchable": false,
				"orderable": false,
				"render": function(data, type, full, meta){
					return '<input type="checkbox" class="ace-checkbox-2" name="idHoso[]" value="' + data +'" /><span class="lbl"></span>';
				}
			},
			{
				"targets": 1,
				"searchable": true,
				"orderData": false,
				"render": function(data, type, full, meta){
					return '<a class="btn_edit_hoso" href="#edit" idHoso="' + full[0] + '">' + data + '</a>';
				}
			},
			{
				"targets": 2,
				"searchable": false,
				"orderable": false,
				"render": function(data, type, full, meta){
					if(data != null && data != '' && data != undefined){
						return $.datepicker.formatDate('dd/mm/yy',$.datepicker.parseDate( "yy-mm-dd", data));
					}else{
						return '';
					}
				}
			},
			{
				"targets": 11,
				"searchable": false,
				"orderable": false,
				"render": function(data, type, full, meta){
					if(data != null && data != '' && data != undefined){
						return $.datepicker.formatDate('dd/mm/yy',$.datepicker.parseDate( "yy-mm-dd", data));
					}else{
						return '';
					}
				}
			},
			{
				"targets": 12,
				"searchable": false,
				"orderable": false,
				"render": function(data, type, full, meta){
					if(data != null && data != '' && data != undefined){
						return $.datepicker.formatDate('dd/mm/yy',$.datepicker.parseDate( "yy-mm-dd", data));
					}else{
						return '';
					}
				}
			},
			{
				"targets": [ 0,1,3,4,5,6,7,8,9,10,13],
				"orderable": false
			},
			{
				"targets": [0,2,3,4,6,7,11,12],
			    "createdCell": function(td, cellData, rowData, row, col){
					$(td).attr('style', 'vertical-align:middle;text-align:center;');
				}
			},
			{
				"targets": [1,3,5,8,9,10,13],
			    "createdCell": function(td, cellData, rowData, row, col){
			    	$(td).attr('style', 'vertical-align:middle;');
				}
			}
			
		],
		"searchDelay": "1500",
    	"serverSide": true,
	    "stateSave": true
	}).on( 'processing.dt', function ( e, settings, processing ) {		
        if(processing){
        	$.blockUI();    
        }else{
        	$.unblockUI();
        }
    });
	$('body').delegate('#chkAllDSTN', 'click', function(){
		var checked_status = this.checked;
		$("input[name='idHoso[]']").each(function(){
			this.checked = checked_status;
		});
	});
});
</script>