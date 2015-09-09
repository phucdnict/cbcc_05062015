<?php
/**
 * Author: Phucnh
 * Date created: Mar 19, 2015
 * Company: DNICT
 */ 
$user   = JFactory::getUser();
?>
<div>
	<h4 class="header lighter blue">
		Báo cáo tuần <i class="icon-double-angle-right"></i><small><span id="tendonvi"></span></small>
				<span class="pull-right inline">
					<span class="btn btn-small btn-info" id="btn_reload"><i class="icon-exchange"></i> Reload</span>
					<span class="btn btn-small btn-info" id="btn_themmoi_baocaotuan"><i class="icon-plus"></i> Thêm mới báo cáo tuần</span>
					<span class="btn btn-small btn-info" id="btn_upload_baocaotuan"><i class="icon-plus"></i> Upload báo cáo tuần</span>
					<span class="btn btn-small btn-info" id="btn_themmoi_lamthemgio"><i class="icon-plus"></i> Thêm mới làm thêm giờ</span>
				</span>
	</h4>
</div>
<div class="accordion" id="baocaotuan-manager-accordion">
	<div class="accordion-group">
	    <div class="accordion-heading">
	      <a class="accordion-toggle" data-toggle="collapse" data-parent="baocaotuan-manager-accordion" href="#baocaotuan-manager-collapse-one">
	       Biểu mẫu
	      </a>
	    </div>
	    <div id="baocaotuan-manager-collapse-one" class="accordion-body">
	      <div class="accordion-inner" id="div_form"></div>
	    </div>
	</div>
	<div class="accordion-group">
	    <div class="accordion-heading">
	      <a class="accordion-toggle" data-toggle="collapse" data-parent="baocaotuan-manager-accordion"  href="#baocaotuan-manager-collapse-two">
	       Danh sách báo cáo theo tuần
	      </a>
	    </div>
	    <div id="baocaotuan-manager-collapse-two" class="accordion-body">
	    </div>
	</div>
	<div class="accordion-group">
	    <div class="accordion-heading">
	      <a class="accordion-toggle" data-toggle="collapse"  data-parent="baocaotuan-manager-accordion"  href="#baocaotuan-manager-collapse-three">
	       Quản lý làm thêm giờ
	      </a>
	    </div>
	    <div id="baocaotuan-manager-collapse-three" class="accordion-body">
	    </div>
	</div>
</div>
<script type="text/javascript">
var convertVNDateToMysql = function(datevn){
	var arr = datevn.split("/");
	var day = arr[0];
	var month = arr[1];
	var year = arr[2];
	return year+'-'+month+'-'+day;   
}
var user_id = <?php echo $user->id?>;
var date = function(dateObject) {
    var d = new Date(dateObject);
    var day = d.getDate();
    var month = d.getMonth() + 1;
    var year = d.getFullYear();
    if (day < 10) {
        day = "0" + day;
    }
    if (month < 10) {
        month = "0" + month;
    }
    var date = day + "/" + month + "/" + year;
    return date;
};

jQuery(document).ready(function($){
	$('#baocaotuan-manager-collapse-one').collapse('hide');
	$(document).ajaxStart(function() {
        $.blockUI();
    });

	$(document).ajaxStop(function() {
	    $.unblockUI();
	});
  	var reload = function(){
  		$('#baocaotuan-manager-collapse-three').load('/index.php?option=com_baocaotuan&controller=tuan&task=lamthemgio&format=raw', function(){
			$('#baocaotuan-manager-collapse-one').collapse('hide');
			$('#baocaotuan-manager-collapse-three').collapse('hide');
		});
		$('#baocaotuan-manager-collapse-two').load('/index.php?option=com_baocaotuan&controller=tuan&task=quatrinh&format=raw', function(){
			$('#baocaotuan-manager-collapse-one').collapse('hide');
		  	$('#baocaotuan-manager-collapse-two').collapse('hide');
  	  	});
  	}
  	reload();
	$('#btn_reload').on('click', function(){
		reload();
	});
	$('#btn_upload_baocaotuan').on('click', function(){
		$('#div_form').load('index.php?option=com_baocaotuan&view=tuan&format=raw&task=addupload', function(){
				$('#baocaotuan-manager-collapse-one').collapse('show');
			  	$('#baocaotuan-manager-collapse-two').collapse('hide');
			  	$('#baocaotuan-manager-collapse-three').collapse('hide');
		});
	});
	$('#btn_themmoi_baocaotuan').on('click', function(){
		$('#div_form').load('index.php?option=com_baocaotuan&view=tuan&format=raw&task=form', function(){
				$('#baocaotuan-manager-collapse-one').collapse('show');
			  	$('#baocaotuan-manager-collapse-two').collapse('hide');
			  	$('#baocaotuan-manager-collapse-three').collapse('hide');
		});
	});
	$('#btn_themmoi_lamthemgio').on('click', function(){
		$('#div_form').load('index.php?option=com_baocaotuan&view=tuan&format=raw&task=addlamthemgio', function(){
				$('#baocaotuan-manager-collapse-one').collapse('show');
				$('#baocaotuan-manager-collapse-two').collapse('hide');
			  	$('#baocaotuan-manager-collapse-three').collapse('hide');
		});
	});
	// quatrinh
	$('body').delegate('.btn_view_thongtin', 'click', function(){
		var id = $(this).attr('quatrinh');
		$('#div_form').load('index.php?option=com_baocaotuan&view=tuan&format=raw&task=form&id='+id, function(){
			$('#baocaotuan-manager-collapse-one').collapse('show');
		  	$('#baocaotuan-manager-collapse-two').collapse('hide');
		  	$('#baocaotuan-manager-collapse-three').collapse('hide');
		});
	});
	$('body').delegate('.btn_view_lamthemgio', 'click', function(){
		var id = $(this).attr('lamthemgio_id');
		$('#div_form').load('index.php?option=com_baocaotuan&view=tuan&format=raw&task=addlamthemgio&id='+id, function(){
			$('#baocaotuan-manager-collapse-one').collapse('show');
		  	$('#baocaotuan-manager-collapse-two').collapse('hide');
		  	$('#baocaotuan-manager-collapse-three').collapse('hide');
		});
	});
	// xuat excel báo cáo tuần
	$('body').delegate('#btn_xuatexcel', 'click', function(){
		var checked_ids = [];
		$(".ck:checked").each(function () {
            checked_ids.push(this.value);
    	});
		if(checked_ids.length>0){
			url= '/index.php?option=com_baocaotuan&view=tuan&format=xls&task=excelbctuan&baocao_id='+checked_ids;
	  		document.location.assign(url);
		}else alert("Vui lòng chọn dữ liệu để xuất báo cáo tuần");
	});
	// xuat excel báo cáo tuần
	$('body').delegate('#btn_xuatexcel_lamthemgio', 'click', function(){
		var checked_ids = [];
		$(".ck_lamthemgio:checked").each(function () {
            checked_ids.push(this.value);
    	});
		if(checked_ids.length>0){
			url= '/index.php?option=com_baocaotuan&view=tuan&format=xls&task=excellamthemgio&lamthemgio_id='+checked_ids;
	  		document.location.assign(url);
		}else alert("Vui lòng chọn dữ liệu để xuất làm thêm giờ");
	});
});
</script>