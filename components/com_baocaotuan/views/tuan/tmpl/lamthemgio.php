<?php
/**
 * Author: Phucnh
 * Date created: May 29, 2015
 * Company: DNICT
 */
?>
<div id="div_lamthemgio">
	<fieldset>
		<legend>
			<span class="pull-right inline">
				<input type="text"  name="lamthemgiobatdau" id="lamthemgiobatdau" class="mask"  style="width:80px"  value="<?php echo date("d/m/Y", mktime( 0, 0, 0, date("m"), 1,   date("Y")));?>">
				<input type="text"  name="lamthemgioketthuc" id="lamthemgioketthuc" class="mask"  style="width:80px"  value="<?php echo date('d/m/Y');?>">
				<span class="btn btn-small btn-success" id="btn_xuatexcel_lamthemgio"><i class="icon-download"></i>Xuất excel</span>
				<span class="btn btn-small btn-danger" id="btn_xoa_lamthemgio"><i class="icon-remove"></i>Xóa</span>
				</span>
		</legend>
		<div id="div_quatrinh_lamthemgio">
		</div>
	</fieldset>
</div>
<script type="text/javascript">
jQuery(document).ready(function($){
	var ngaybatdai = new Date('01/01/2012');
	var TuNgayketthuc = new Date();
	var DenKetthuc = new Date();
	
	DenKetthuc.setDate(DenKetthuc.getDate()+365);
	$('#lamthemgiobatdau').datepicker({
		format:'dd/mm/yyyy',
	    weekStart: 1,
	    startDate: ngaybatdai,
	    endDate: TuNgayketthuc, 
	    autoclose: true
	})
	    .on('changeDate', function(selected){
	    	ngaybatdai = new Date(selected.date.valueOf());
	    	ngaybatdai.setDate(ngaybatdai.getDate(new Date(selected.date.valueOf())));
	        $('#lamthemgioketthuc').datepicker('setStartDate', ngaybatdai);
	    }); 
	$('#lamthemgioketthuc')
	    .datepicker({
		    format:'dd/mm/yyyy',
	        weekStart: 1,
	        startDate: ngaybatdai,
	        endDate: DenKetthuc,
	        autoclose: true
	    })
	    .on('changeDate', function(selected){
	        TuNgayketthuc = new Date(selected.date.valueOf());
	        TuNgayketthuc.setDate(TuNgayketthuc.getDate(new Date(selected.date.valueOf())));
	        $('#lamthemgiobatdau').datepicker('setEndDate', TuNgayketthuc);
	    });
	$('#lamthemgioketthuc,#lamthemgiobatdau').on('change', function () {
		 loadLamthemgio();
	});
	var loadLamthemgio = function(){
		lamthemgiobatdau = convertVNDateToMysql($('#lamthemgiobatdau').val());
		lamthemgioketthuc = convertVNDateToMysql($('#lamthemgioketthuc').val());
		$.ajax({
			type: 'POST',
			url: '<?php echo JURI::base(true);?>/index.php?option=com_baocaotuan&controller=tuan&task=getlamthemgio&format=raw',
			data: {user_id : user_id, lamthemgiobatdau : lamthemgiobatdau, lamthemgioketthuc : lamthemgioketthuc},
			success: function(data){
				$('#div_quatrinh_lamthemgio').html('<table id="quatrinh_lamthemgio" class="table table-striped table-bordered table-hover"></table>');
				$('#quatrinh_lamthemgio').dataTable( {
			        "data": data,
			        "sDom": "<'dataTables_wrapper'<'clear'><'row-fluid'<'span3'f><'span3'<'pull-right'T>><'span6'p>t<'row-fluid'<'span2'l><'span4'i><'span6'p>>>",
			 		"oTableTools": {
			 			"sSwfPath": "<?php echo JUri::base(true);?>/media/cbcc/js/dataTables-1.10.0/swf/copy_csv_xls_pdf.swf",		
			          	"aButtons": [	
								{
									"sExtends": "xls",
									"sButtonText": "Excel",
									"mColumns": [ 0,1,2,3,4,5 ],
									"sFileName": "Lamthemgio.xls",
								},
								{ 	"sExtends":"print",
									"bShowAll": false
								},	 							
			 						]
			 		},
			 		"deferRender":true,
			 		"columnDefs": [{
				   			"targets": [2,5],
				   			"orderable": true
		   				},
		   				{
			   				"targets": [0,1,3,4],
			   				"orderable": false
		   			}],
			        "columns": [
								{"title":"<input type='checkbox' class='center' id='alllamthemgio' style='opacity:1'>", "width": "4%","data": "id" , "render": function (data, type, row, meta) {
								    return "<input class='ck_lamthemgio' type='checkbox' style='opacity:1' value='"+row.id+"'>";
								}},
			                    {"title":"Tên công việc","width": "25%", "data": "congvieclamthem" , "render": function (data, type, row, meta) {
			                        return '<a style="cursor:pointer;" class="btn_view_lamthemgio" lamthemgio_id="'+row.id+'">'+data+'</a>';
			                    }},
			                    {"title":"Ngày làm thêm", "class":"center", "data": "ngaylamthem"  , "render": function (data, type, row, meta) {
				                    if (data == null || data == "0000-00-00" || data == "")
					                    return "";
				                    else
				                        return date(data);
			                    }},
			                    {"title":"Thời gian bắt đầu", "class":"center", "data": "timebatdau" },
			                    {"title":"Thời gian kết thúc", "class":"center", "data": "timeketthuc"},
			                    {"title":"Số giờ làm", "class":"center", "data": "thoigian"},
			                ]
			    }); 
			}
		});
	};
	$('body').delegate('#alllamthemgio', 'click', function(){
		$('.ck_lamthemgio').not(this).prop('checked', this.checked);
	});  
	loadLamthemgio();
	$('#btn_xoa_lamthemgio').on('click', function(){
		var iddel = [];
		$(".ck_lamthemgio:checked").each(function() {
			iddel.push($(this).val());
		});
		if (iddel.length>0){
			if(confirm('BẠN CÓ CHẮC CHẮN XÓA?')){
				$.ajax({
					type: 'POST',
		  			url: '<?php echo JUri::base(true);?>/index.php?option=com_baocaotuan&view=tuan&format=raw&task=dellamthemgio',
		  			data: {iddel : iddel},
		  			success:function(data){
			  			if (data == true){
				  			$.blockUI();
				  			$('#baocaotuan-manager-collapse-three').load('/index.php?option=com_baocaotuan&controller=tuan&task=lamthemgio&format=raw', function(){
					  			$.unblockUI();
				  		  	  	$('#baocaotuan-manager-collapse-two').collapse('show');
					  		  	loadNoticeBoardSuccess('Thông báo', 'Thao tác thành công!');
				  		  	});
				  		}
			  			else loadNoticeBoardError('Thông báo', 'Có lỗi xảy ra, vui lòng liên hệ quản trị viên!');
		  			}
		        });
			}
		}
		else alert("Vui lòng chọn quá trình cần xóa!!");
	});	
});
</script>