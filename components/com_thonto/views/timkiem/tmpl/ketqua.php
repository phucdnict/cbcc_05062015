<?php
defined('_JEXEC') or die('Restricted access');
?>
<form id="frmTimkiemKetqua" name="frmTimkiemKetqua" method="post" action="index.php?option=com_thonto&controller=thonto">
<table id="table_ketqua" class="table table-bordered">
<thead>
<tr style="background: #ECECEC;">
	<th class="center" style="vertical-align:middle;" rowspan="2">STT</th>
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
<tbody>
<?php for($i = 0, $n = count($this->items); $i < $n; $i++){?>
<?php $item = $this->items[$i];?>
<tr>
	<td class="center" style="vertical-align:middle;"><?php echo $i+1; ?></td>
	<td class="center" style="vertical-align:middle;"><?php echo $item['hoten']; ?></td>
	<td class="center" style="vertical-align:middle;"><?php echo $item['ngaysinh']; ?></td>
	<td class="center" style="vertical-align:middle;"><?php echo $item['gioitinh']; ?></td>
	<td class="center" style="vertical-align:middle;"><?php echo $item['dienthoailienhe']; ?></td>
	<td class="center" style="vertical-align:middle;"><?php echo $item['email']; ?></td>
	<td class="center" style="vertical-align:middle;"><?php echo $item['chuyenmon_trinhdo']; ?></td>
	<td class="center" style="vertical-align:middle;"><?php echo $item['dadaotaonghiepvu']; ?></td>
	<td class="center" style="vertical-align:middle;"><?php echo $item['congtac_donvi']; ?></td>
	<td class="center" style="vertical-align:middle;"><?php echo $item['congtac_chucvu']; ?></td>
	<td class="center" style="vertical-align:middle;"><?php echo $item['nghenghiephientai']; ?></td>
	<td class="center" style="vertical-align:middle;"><?php echo $item['ngayvaodang']; ?></td>
	<td class="center" style="vertical-align:middle;"><?php echo $item['ngaychinhthuc']; ?></td>
	<td class="center" style="vertical-align:middle;"><?php echo $item['loaibaohiemyte']; ?></td>
</tr>
<?php }?>
</tbody>
</table>
<input type="hidden" name="option" value="com_thonto" />
<input type="hidden" name="controller" value="thonto" />
<input type="hidden" name="view" value="thonto" />
</form>
<script type="text/javascript">
jQuery(document).ready(function($){
	var oTable1 = $('#table_ketqua').DataTable( {
		"oLanguage": {
            "sUrl": "<?php echo JUri::base(true);?>/media/cbcc/js/dataTables.vietnam.txt"
        },
        "sDom": "<'dataTables_wrapper'C<'clear'><'row-fluid'<'span3'f><'span3'<'pull-right'rT>><'span6'p>t<'row-fluid'<'span2'l><'span4'i><'span6'p>>>",
 		"oTableTools": {
 			"sSwfPath": "<?php echo JUri::base(true);?>/media/cbcc/js/dataTables-1.10.0/swf/copy_csv_xls_pdf.swf",		
          	"aButtons": [
				{
					"sExtends": "xls",
					"sButtonText": "Excel",
					"mColumns": [ 1,2,3,4,5,6,7,8,9,10,11,12,13 ],
					"sFileName": "Ketquatimkiem.xls"
				},
				"print"
			]
 		},
  	  	"columnDefs": [
			{
				"targets": 0,
				"searchable": false,
				"orderable": false
			},
			{
				"targets": 1,
				"searchable": true,
				"orderData": false
			},
			{
				"targets": 2,
				"searchable": false,
				"orderable": false
			},
			{
				"targets": 11,
				"searchable": false,
				"orderable": false
			},
			{
				"targets": 12,
				"searchable": false,
				"orderable": false
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
	    "stateSave": true
	}).on( 'processing.dt', function ( e, settings, processing ) {		
        if(processing){
        	$.blockUI();    
        }else{
        	$.unblockUI();
        }
    });
});
</script>