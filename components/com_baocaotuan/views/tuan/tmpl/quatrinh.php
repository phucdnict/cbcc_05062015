<?php
/**
 * Author: Phucnh
 * Date created: May 29, 2015
 * Company: DNICT
 */
?>
<div id="quytrinh-baocaotuan">
	<fieldset>
		<legend>
			<span class="pull-right inline">
				<input type="text"  name="bcbatdau" id="bcbatdau" class="mask"  style="width:80px"  value="<?php echo date("d/m/Y", mktime( 0, 0, 0, date("m"), date("d")-6,   date("Y")));?>">
				<input type="text"  name="bcketthuc" id="bcketthuc" class="mask"  style="width:80px"  value="<?php echo date('d/m/Y');?>">
				<span class="btn btn-small btn-success" id="btn_xuatexcel"><i class="icon-download"></i>Xuất excel</span>
				<span class="btn btn-small btn-danger" id="btn_xoaquytrinh"><i class="icon-remove"></i>Xóa</span>
				</span>
		</legend>
		<div id="div_quatrinh_baocaotuan">
		</div>
	</fieldset>
</div>
<script type="text/javascript">
jQuery(document).ready(function($){
	$('.cs').chosen();
	function convertVNDateToMysql(datevn){
		var arr = datevn.split("/");
		var day = arr[0];
		var month = arr[1];
		var year = arr[2];
		return year+'-'+month+'-'+day;   
	}
	var startDate = new Date('01/01/2012');
	var FromEndDate = new Date();
	var ToEndDate = new Date();
	ToEndDate.setDate(ToEndDate.getDate()+365);
	$('#bcbatdau').datepicker({
		format:'dd/mm/yyyy',
	    weekStart: 1,
	    startDate: '01/01/2012',
	    endDate: FromEndDate, 
	    autoclose: true
	}).on('changeDate', function(selected){
	        startDate = new Date(selected.date.valueOf());
	        startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
	        $('#bcketthuc').datepicker('setStartDate', startDate);
	    }); 
	$('#bcketthuc')
	    .datepicker({
		    format:'dd/mm/yyyy',
	        weekStart: 1,
	        startDate: startDate,
	        endDate: ToEndDate,
	        autoclose: true
	    }).on('changeDate', function(selected){
	        FromEndDate = new Date(selected.date.valueOf());
	        FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));
	        $('#bcbatdau').datepicker('setEndDate', FromEndDate);
	    });
	$('#bcketthuc,#bcbatdau').on('change', function () {
		 loadQuytrinh();
	});
	var loadQuytrinh = function(){
		bcbatdau = convertVNDateToMysql($('#bcbatdau').val());
		bcketthuc = convertVNDateToMysql($('#bcketthuc').val());
		$.ajax({
			type: 'POST',
			url: '<?php echo JURI::base(true);?>/index.php?option=com_baocaotuan&controller=tuan&task=getquatrinh&format=raw',
			data: {user_id : user_id, bcbatdau : bcbatdau, bcketthuc : bcketthuc},
			success: function(data){
				$('#div_quatrinh_baocaotuan').html('<table id="quatrinh_baocaotuan" class="table table-striped table-bordered table-hover"></table>');
				$('#quatrinh_baocaotuan').dataTable( {
			        "data": data,
			        "sDom": "<'dataTables_wrapper'<'clear'><'row-fluid'<'span3'f><'span3'<'pull-right'T>><'span6'p>t<'row-fluid'<'span2'l><'span4'i><'span6'p>>>",
			 		"oTableTools": {
			 			"sSwfPath": "<?php echo JUri::base(true);?>/media/cbcc/js/dataTables-1.10.0/swf/copy_csv_xls_pdf.swf",		
			          	"aButtons": [	
			 							"xls",		 							
			 							"print"
			 						]
			 		},
			 		"deferRender":true,
			 		"columnDefs": [{
				   			"targets": [2,3,4,5,6],
				   			"orderable": true
		   				},
		   				{
			   				"targets": [0,1],
			   				"orderable": false
		   			}],
			        "columns": [
								{"title":"<input type='checkbox' id='selecctall' style='opacity:1'>", "width": "4%","data": "id" , "render": function (data, type, row, meta) {
								    return "<input class='ck' type='checkbox' style='opacity:1' value='"+row.id+"'>";
								}},
			                    {"title":"Tên công việc","width": "25%", "data": "congviec" , "render": function (data, type, row, meta) {
			                        return '<a style="cursor:pointer;" class="btn_view_thongtin" quatrinh="'+row.id+'">'+data+'</a>';
			                    }},
			                    {"title":"Tên dự án", "data": "tenduan" },
			                    {"title":"Độ phức tạp", "class":"center", "data": "dophuctap", "render": function (data, type, row, meta) {
				                    if (data == 1)
					                    return "Có";
				                    else
				                        return "Không";
			                    } },			                   
			                    {"title":"Thời gian bắt đầu", "class":"center", "data": "batdau" , "render": function (data, type, row, meta) {
				                    if (data == null || data == "0000-00-00" || data == "")
					                    return "";
				                    else
				                        return date(data);
			                    }},
			                    {"title":"Thời gian kết thúc", "class":"center", "data": "ketthuc" , "render": function (data, type, row, meta) {
				                    if (data == null || data == "0000-00-00" || data == "")
					                    return "";
				                    else
				                        return date(data);
			                    } },
			                    {"title":"Hoàn thành", "class":"center", "data": "hoanthanh", "render":function(data, type, row, meta){
				                    return data+'%';
				                    } },
			                ]
			    }); 
			}
		});
	};
	$('body').delegate('#selecctall', 'click', function(){
		$('.ck').not(this).prop('checked', this.checked);
	});  
	loadQuytrinh();
	$('#btn_xoaquytrinh').on('click', function(){
		var iddel = [];
		$(".ck:checked").each(function() {
			iddel.push($(this).val());
		});
		if (iddel.length>0){
			if(confirm('BẠN CÓ CHẮC CHẮN XÓA?')){
				$.ajax({
					type: 'POST',
		  			url: '<?php echo JUri::base(true);?>/index.php?option=com_baocaotuan&view=tuan&format=raw&task=delquatrinh',
		  			data: {iddel : iddel},
		  			success:function(data){
			  			if (data == true){
				  			$.blockUI();
				  			$('#baocaotuan-manager-collapse-two').load('/index.php?option=com_baocaotuan&controller=tuan&task=quatrinh&format=raw', function(){
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