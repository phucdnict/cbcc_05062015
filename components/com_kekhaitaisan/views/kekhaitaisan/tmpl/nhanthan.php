<?php
/**
 * Author: Phucnh
 * Date created: Jul 15, 2015
 * Company: DNICT
 */
?>
<div id="div_quatrinh_nhanthan">
<script type="text/javascript">
jQuery(document).ready(function($){
var loadnhanthan = function(){
		$.ajax({
			type: 'POST',
			url: '/index.php?option=com_kekhaitaisan&controller=kekhaitaisan&task=getnhanthan&format=raw',
			data: {kekhai_id : kekhai_id},
			success: function(data){
				$('#div_quatrinh_nhanthan').html('<table id="quatrinh_nhanthan" class="table table-striped table-bordered table-hover"></table>');
				$('#quatrinh_nhanthan').dataTable( {
			        "data": data,
			        "sDom": "<'dataTables_wrapper'<'clear'><'row-fluid'<'span3'f><'span3'<'pull-right'T>><'span6'p>t<'row-fluid'<'span2'l><'span4'i><'span6'p>>>",
			 		"deferRender":true,
			 		"columnDefs": [
		   				{
			   				"targets": [0,1,2,3,4],
			   				"orderable": false
		   			}],
			        "columns": [
								{"title":"<input type='checkbox' class='center' id='allnhanthan' style='opacity:1'/>", "width": "4%","data": "id" , "render": function (data, type, row, meta) {
								    return " <input class='ck_nhanthan' type='checkbox' style='opacity:1' value='"+row.id+"'>";
								}},
			                    {"title":"Họ và tên","width": "25%", "data": "hoten" , "render": function (data, type, row, meta) {
			                        return '<a style="cursor:pointer;" class="btn_view_nhanthan" data-toggle="modal" data-target=".modal" nhanthan_id="'+row.id+'">'+data+'</a>';
			                    }},
			                    {"title":"Quan hệ", "class":"center", "data": "quanhe" },
			                    {"title":"Năm sinh", "class":"center", "data": "namsinh" },
			                    {"title":"Chỗ ở hiện tại", "class":"center", "data": "choohientai"},
			                ]
			    }); 
			}
		});
	};
	$('body').delegate('#allnhanthan', 'click', function(){
		$('.ck_nhanthan').not(this).prop('checked', this.checked);
	});  
	loadnhanthan();
});
</script>