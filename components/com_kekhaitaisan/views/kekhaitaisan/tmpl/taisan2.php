<?php
/**
 * Author: Phucnh
 * Date created: Jul 15, 2015
 * Company: DNICT
 */
?>
<div id="div_quatrinh_taisan">
<script type="text/javascript">
function format ( d ) {
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>Full name:</td>'+
            '<td>'+d.tenloaitaisan+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Extension number:</td>'+
            '<td>Okay</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Extra info:</td>'+
            '<td>And any further details here (images etc)...</td>'+
        '</tr>'+
    '</table>';
}
var table;
jQuery(document).ready(function($){
var loadtaisan = function(){
		$.ajax({
			type: 'POST',
			url: '/index.php?option=com_kekhaitaisan&controller=kekhaitaisan&task=gettaisan&format=raw',
			data: {kekhai_id : kekhai_id},
			success: function(data){
				$('#div_quatrinh_taisan').html('<table id="quatrinh_taisan" class="table table-striped table-bordered table-hover"></table>');
				table= $('#quatrinh_taisan').dataTable( {
			        "data": data,
			        "sDom": "<'dataTables_wrapper'<'clear'><'row-fluid'<'span3'f><'span3'<'pull-right'T>><'span6'p>t<'row-fluid'<'span2'l><'span4'i><'span6'p>>>",
			 		"deferRender":true,
			 		"columnDefs": [
		   				{
			   				"targets": [0,1,2,4,5],
			   				"orderable": false
		   			}],
			        "columns": [
								{"title":"<input type='checkbox' class='center' id='alltaisan' style='opacity:1'/>", "width": "4%","data": "id" , "render": function (data, type, row, meta) {
								    return " <input class='ck_taisan' type='checkbox' style='opacity:1' value='"+row.id+"'>";
								}},
			                    {"title":"Tên loại tài sản","width": "25%", "data": "tenloaitaisan" , "render": function (data, type, row, meta) {
				                    if(row.parent_id >0) pr= row.parent_id; else pr=row.taisan_id;
			                        return '<a style="cursor:pointer;" class="btn_view_taisan" data-toggle="modal" data-target=".modal" pr="'+pr+'" taisan_id="'+row.id+'" type="'+row.type+'">'+data+'</a>';
			                    }},
			                    {"title":"Tên tài sản", "class":"center", "data": "value" },
			                    {"title":"Giá trị", "class":"center", "data": "trigia" },
			                    {"title":"Địa chỉ", "class":"center", "data": "diachi"},
			                    {"title":"Diện tích xây dựng", "class":"center", "data": "dientich"},
			                    {"width": "10%","orderable":      false, "data": "tenloaitaisan" , "render": function (data, type, row, meta) {
				                    if(row.parent_id >0) pr= row.parent_id; else pr=row.taisan_id;
			                        return '<span style="cursor:pointer;" class="btn_view_taisan btn btn-mini btn-info" data-toggle="modal" data-target=".modal" pr="'+pr+'" taisan_id="'+row.id+'" type="'+row.type+'"><i class="icon-edit"></i></span><span title="" data-placement="top" data-rel="tooltip" class="btn btn-mini details-control" data-original-title="Chi tiết"><i class="icon-search"></i></span>';
			                    }},
			                ]
			    }); 
			}
		});
	};
	$('body').delegate('#alltaisan', 'click', function(){
		$('.ck_taisan').not(this).prop('checked', this.checked);
	});  
	loadtaisan();
	$('body').delegate('.details-control','click', function () {
        var tr = $(this).closest('tr');
        var row = table.api().row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );
});
</script>