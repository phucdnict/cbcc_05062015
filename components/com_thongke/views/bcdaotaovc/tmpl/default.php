<?php
/**
 * Author: Phucnh
 * Date created: Aug 1, 2015
 * Company: DNICT
 */
?>
<div id="tab_bcdaotaovc" class="tab-pane active">
	<div>
		<h5 class="header smaller lighter blue">
			<?php echo $this->root_info['root_name']?>
			<span class="pull-right inline">
				<a data-original-title="Thêm mới" class="btn btn-small btn-primary" id="btn_bcdaotaovc" style="margin-right: 5px;" data-toggle="modal" data-target=".modal">
					<i class="icon-search"></i> Hiển thị
				</a>
				<span data-original-title="Xóa" class="btn btn-small btn-success" id="btn_exel_bcdaotaovc" style="margin-right: 5px;" data-placement="top" title="">
					<i class="icon-download"></i> Xuất excel
				</span>
	        </span>
		</h5>
	</div>
	<div class="row-fluid">
	   	<div class="span4">
	   		<div id="caydonvi_bcdaotaovc" style="overflow:auto; height: 200px;"> CÂY ĐƠN VỊ </div>
	    </div>
	   	<div class="span8">
	   		<h4 style="text-align:center;" class="blue header"><i class="icon-star blue"></i> Báo cáo đào tạo bồi dưỡng viên chức</h4>
	   		<div class="row-fluid">
	   			<div class="span6 widget-container-span">
					<div class="widget-box transparent">
						<div class="widget-header">
							<h5 class="smaller">Thời gian</h5>
						</div>
						<div class="widget-body">
							<div class="widget-main padding-6">
								<div>
									<h5>
										Từ <input style="width:85px" name="tungay_bcdaotaovc" value="<?php echo date("d/m/Y")?>" id="tungay_bcdaotaovc" class="date mask"> 
										đến <input style="width:85px" name="denngay_bcdaotaovc" value="<?php echo date("d/m/Y")?>" id="denngay_bcdaotaovc" class="date mask">
									</h5>
								</div>
							</div>
						</div>
					</div>
				</div>
		   	</div>
	   	</div>
  	</div>
</div>
<h5 class="row-fluid header smaller lighter blue">
	<span>Hiển thị nội dung thống kê</span>
</h5>
<div id="ketqua_bcdaotaovc" style="min-height:300px;"></div>
<script type="text/javascript">
var text = function(txt, data){
	var dt= txt+'<td style="text-align:center;">'+data.cunhan_ctri+'</td><td style="text-align:center;">'+data.caocap_ctri+'</td><td style="text-align:center;">'+data.trungcap_ctri+'</td><td style="text-align:center;">'+data.socap_ctri+'</td><td style="text-align:center;">'+data.qlnn_cvcc+'</td>';
	dt +='<td style="text-align:center;">'+data.qlnn_cvc+'</td><td style="text-align:center;">'+data.qlnn_cv+'</td><td style="text-align:center;">'+data.qlnn_cansu+'</td><td style="text-align:center;">'+data.cm_tiensi+'</td><td style="text-align:center;">'+data.cm_thacsi+'</td>';
	dt +='<td style="text-align:center;">'+data.cm_daihoc+'</td><td style="text-align:center;">'+data.cm_caodang+'</td><td style="text-align:center;">'+data.cm_trungcap+'</td><td style="text-align:center;">'+data.cm_socap+'</td>';
	dt +='<td style="text-align:center;">'+data.chuyenmon+'</td><td style="text-align:center;">'+data.quanly+'</td><td style="text-align:center;">'+data.tiengdantoc+'</td><td style="text-align:center;">'+data.khac+'</td>';
	dt +='<td style="text-align:center;">'+data.qphong_tong+'</td>';
	dt +='<td style="text-align:center;">'+data.tong_ngoaingu+'</td><td style="text-align:center;">'+data.tong_tinhoc+'</td><td style="text-align:center;">'+data.tongso+'</td><td style="text-align:center;">'+data.thieuso+'</td>';
	dt +='<td style="text-align:center;">'+data.nu+'</td>';
	return dt;
}
jQuery(document).ready(function($){
	$(document).ajaxStart(function() {
        $.blockUI();
    });

	$(document).ajaxStop(function() {
	    $.unblockUI();
	});
	var id;
	$('.date').datepicker({
		format: 'dd/mm/yyyy', 
        "autoclose": true
    });
    $('.mask').mask('39/19/2999');
	$("#caydonvi_bcdaotaovc").jstree({
		   		"plugins" : ["themes","json_data","checkbox","types","ui","cookies"],
		   		"json_data" : {
		   			"data" : [{ "attr" : { "id" : "<?php echo $this->root_info['root_id'];?>", "showlist":"<?php echo $this->root_info['root_showlist'];?>"},
		     	"state" : "closed",
		     	"data" : {
		       	"title" : "<?php echo $this->root_info['root_name'];?>",
		       	"attr" : { "href" : "#" }
		      }
		  }],
		  "ui": {
	            "select_limit": 3,
	        },
		  "ajax" : {
		   "url" : "<?php echo JURI::base(true);?>/index.php",
		   "data" : function (n) {
		    return {
		     "option" : "com_thongke",                            
		     "view" : "treeview",
		     "task" : "treeDaotaoboiduong",
		     "format" : "raw",                            
		     "id" : n.attr ? n.attr("id").replace("node_","") : + root_id
		    };
		   }
		  }
		  },
		  "checkbox": {
              two_state: true,
              override_ui: false,
              real_checkboxes:true,
          },
		  "types" : {
		   "valid_children" : [ "root" ],
		   "types" : {
		    "file" : {
		     "icon" : { 
		      "image" : "<?php echo JUri::root(true);?>/media/cbcc/js/jstree/file.png" 
		     }                 
		    },
		    "folder" : {
		     "icon" : { 
		      "image" : "<?php echo JUri::root(true);?>/media/cbcc/js/jstree/folder.png" 
		     }
		    },
		    "default" : {
		    	"check_node" : function (node) {
		        	$('#caydonvi_bcdaotaovc').jstree('uncheck_all');
		            return true;
		          },
		          "uncheck_node" : function (node) {
		            return true;
		          }
		    }
		   }
		  }  
		 }).bind("select_node.jstree", function (e, data) {
				id = data.rslt.obj.attr("id").replace("node_","");
				showlist = data.rslt.obj.attr('showlist');
				/*
				showlist = 0 => Phòng
				showlist = 1 => Tổ chức
				showlist = 2 => Vỏ chứa
				showlist = 3 => Tổ chức hoạt động như phòng
			*/
				if(showlist != '2'){
					if(showlist == 1 || showlist == 3 || showlist == 0){
						return false;
					}else{
		 				data.inst.toggle_node(data.rslt.obj);
		 			}
				}else data.inst.toggle_node(data.rslt.obj);
			 });
	$('#tungay_bcdaotaovc').on('change', function(){
		var a_arr 		= ($("#denngay_bcdaotaovc").val()).split('/');
        var b_arr 		= ($(this).val()).split('/');
        var start 	= a_arr[2]+a_arr[1]+a_arr[0];
	     var end	= b_arr[2]+b_arr[1]+b_arr[0];
	     var tmp = start - end;
	     if(($("#denngay_bcdaotaovc").val()!="")  && $(this).val()!=""){
		     if (tmp>=0) {}
		     else {alert('Thời gian không hợp lệ'); $(this).val("");}
	     } 
	});
	$('#denngay_bcdaotaovc').on('change', function(){
		var a_arr 		= ($("#tungay_bcdaotaovc").val()).split('/');
        var b_arr 		= ($(this).val()).split('/');
        var start 	= a_arr[2]+a_arr[1]+a_arr[0];
	     var end	= b_arr[2]+b_arr[1]+b_arr[0];
	     var tmp = start - end;
	     if(($("#tungay_bcdaotaovc").val()!="")  && $(this).val()!=""){
		     if (tmp<=0) {}
		     else {alert('Thời gian không hợp lệ'); $(this).val("");}
	     }  
	});
	$('#sidebar').addClass('menu-min');
	$('#module-left').hide();
	$('#btn_bcdaotaovc').on('click', function(){
		var donvi_id_checked;
		$("#caydonvi_bcdaotaovc").jstree("get_checked",null,true).each(function () {
			donvi_id_checked= this.id.replace("node_","");
    	});
    	if(donvi_id_checked>0){
			var tungay_bcdaotaovc = $('#tungay_bcdaotaovc').val();
			var denngay_bcdaotaovc = $('#denngay_bcdaotaovc').val();
			if (tungay_bcdaotaovc!=null || tungay_bcdaotaovc!="" || denngay_bcdaotaovc!=null || denngay_bcdaotaovc!=""){
				var str='';
				str +='<table class="table table-striped table-bordered dataTable tblDaotaoboiduong" id="tblDaotaoboiduong">';
				str +='<thead>';
				str +='<tr style="background: #ECECEC;">';
				str +='<th rowspan="3">TT</th>';
				str +='<th style="min-width:200px; text-align:center;" rowspan="3" colspan="2">Đối tượng</th>';
				str +='</tr>';
				str +='<tr style="background: #ECECEC;">';
				str +='<th style="text-align:center;" colspan="4">Lý luận chính trị</th>'; 
				str +='<th style="text-align:center;" colspan="4">Quản lý nhà nước</th>'; 
				str +='<th style="text-align:center;" colspan="6">Chuyên môn</th>';
				str +='<th style="text-align:center;" colspan="4">Bồi dưỡng ngắn hạn</th>'; 
				str +='<th style="text-align:center;" rowspan="2">QP-AN</th>';
				str +='<th style="text-align:center;" rowspan="2">Ngoại ngữ</th>';
				str +='<th style="text-align:center;" rowspan="2">Tin học</th>';
				str +='<th style="text-align:center;" rowspan="2">Tổng số</th>';
				str +='<th style="text-align:center;" colspan="2">Trong đó	</th>';
				str +='</tr>';
				str +='<tr style="background: #ECECEC;">';
				str +='<th>Cử nhân</th><th>Cao cấp</th><th>Trung cấp</th><th>Sơ cấp</th>';
				str +='<th>CV cao cấp</th><th>CV chính</th><th>Chuyên viên</th><th>Cán sự</tH>';
				str +='<th>Tiến sĩ</th><th>Thạc sĩ</th><th>Đại học</th><th>Cao đẳng</th><th>Trung cấp</th><th>Sơ cấp</th>'; 
				str +='<th>Kiến thức, kỹ năng chuyên ngành</th><th>Kỹ năng lãnh đạo, quản lý</th>';
				str +='<th>Tiếng dân tộc</th><th>Khác</th>';
				str +='<th>Người dân tộc thiểu số</th><th>Nữ</th>';
				str +='</tr>';
				str +='</thead>';
				str +='<tbody>';
				str +='<tr id="dt1a_vc"></tr>';
				str +='<tr id="dt1b_vc"></tr>';
				str +='<tr id="dt1c_vc"></tr>';
				str +='<tr id="dt2a_vc"></tr>';
				str +='<tr id="dt2b_vc"></tr>';
				str +='<tr id="dt2c_vc"></tr>';
				str +='<tr id="dt2d_vc"></tr>';
				str +='<tr id="dt3a_vc"></tr>';
				str +='<tr id="dt3b_vc"></tr>';
				str +='<tr id="dt3c_vc"></tr>';
				str +='<tr id="dt3d_vc"></tr>';
				str +='<tr id="dtall_vc"></tr>';
				str +='</tbody>';
				str +='</table>';
				$('#ketqua_bcdaotaovc').html(str);
		        $.ajax({
					type: 'POST',
		  			url: '<?php echo JUri::base(true);?>/index.php?option=com_thongke&view=bcdaotaovc&format=raw&task=doituong',
		  			data: { donvi_id : donvi_id_checked, tungay_bcdaotaovc:tungay_bcdaotaovc, denngay_bcdaotaovc:denngay_bcdaotaovc, target:1 ,condition:1},
		  			success:function(data){
		  				dt = text('<td rowspan="3"  style="vertical-align:middle">1</td><td rowspan="3" width="20%"  style="vertical-align:middle">Viên chức lãnh đạo, quản lý</td><td style="text-align:left;">Đơn vị sự nghiệp thuộc UBND tỉnh</td>',data);
		  				$('#dt1a_vc').html(dt);
		  			}
		        });
		        $.ajax({
					type: 'POST',
		  			url: '<?php echo JUri::base(true);?>/index.php?option=com_thongke&view=bcdaotaovc&format=raw&task=doituong',
		  			data: { donvi_id : donvi_id_checked, tungay_bcdaotaovc:tungay_bcdaotaovc, denngay_bcdaotaovc:denngay_bcdaotaovc, target:1 ,condition:2},
		  			success:function(data){
		  				dt = text('<td style="text-align:left;">Đơn vị sự nghiệp thuộc sở, ngành tỉnh và Ủy ban nhân dân cấp huyện</td>',data);
		  				$('#dt1b_vc').html(dt);
		  			}
		        });
		        $.ajax({
					type: 'POST',
		  			url: '<?php echo JUri::base(true);?>/index.php?option=com_thongke&view=bcdaotaovc&format=raw&task=doituong',
		  			data: { donvi_id : donvi_id_checked, tungay_bcdaotaovc:tungay_bcdaotaovc, denngay_bcdaotaovc:denngay_bcdaotaovc, target:1 ,condition:3},
		  			success:function(data){
		  				dt = text('<td style="text-align:left;">Cấp phòng và tương đương</td>',data);
		  				$('#dt1c_vc').html(dt);
		  			}
		        });
		        $.ajax({
					type: 'POST',
		  			url: '<?php echo JUri::base(true);?>/index.php?option=com_thongke&view=bcdaotaovc&format=raw&task=doituong',
		  			data: { donvi_id : donvi_id_checked, tungay_bcdaotaovc:tungay_bcdaotaovc, denngay_bcdaotaovc:denngay_bcdaotaovc, target:2 ,condition:1},
		  			success:function(data){
		  				dt = text('<td rowspan="4" style="vertical-align:middle">2</td><td rowspan="4" width="20%"  style="vertical-align:middle">Viên chức hành chính</td><td style="text-align:left;">Hạng I</td>',data);
		  				$('#dt2a_vc').html(dt);
		  			}
		        });
		        $.ajax({
					type: 'POST',
		  			url: '<?php echo JUri::base(true);?>/index.php?option=com_thongke&view=bcdaotaovc&format=raw&task=doituong',
		  			data: { donvi_id : donvi_id_checked, tungay_bcdaotaovc:tungay_bcdaotaovc, denngay_bcdaotaovc:denngay_bcdaotaovc, target:2 ,condition:2},
		  			success:function(data){
		  				dt= text('<td style="text-align:left;">Hạng II</td>',data);
		  				$('#dt2b_vc').html(dt);
		  			}
		        });
		        $.ajax({
					type: 'POST',
		  			url: '<?php echo JUri::base(true);?>/index.php?option=com_thongke&view=bcdaotaovc&format=raw&task=doituong',
		  			data: { donvi_id : donvi_id_checked, tungay_bcdaotaovc:tungay_bcdaotaovc, denngay_bcdaotaovc:denngay_bcdaotaovc, target:2 ,condition:3},
		  			success:function(data){
		  				dt= text('<td style="text-align:left;">Hạng III</td>',data);
		  				$('#dt2c_vc').html(dt);
		  			}
		        });
		        $.ajax({
					type: 'POST',
		  			url: '<?php echo JUri::base(true);?>/index.php?option=com_thongke&view=bcdaotaovc&format=raw&task=doituong',
		  			data: { donvi_id : donvi_id_checked, tungay_bcdaotaovc:tungay_bcdaotaovc, denngay_bcdaotaovc:denngay_bcdaotaovc, target:2 ,condition:4},
		  			success:function(data){
		  				dt= text('<td style="text-align:left;">Hạng IV</td>',data);
		  				$('#dt2d_vc').html(dt);
		  			}
		        });
		        $.ajax({
					type: 'POST',
		  			url: '<?php echo JUri::base(true);?>/index.php?option=com_thongke&view=bcdaotaovc&format=raw&task=doituong',
		  			data: { donvi_id : donvi_id_checked, tungay_bcdaotaovc:tungay_bcdaotaovc, denngay_bcdaotaovc:denngay_bcdaotaovc, target:4 ,condition:1},
		  			success:function(data){
		  				dt= text('<td rowspan="4"  style="vertical-align:middle">4</td><td rowspan="4" width="20%"  style="vertical-align:middle">Viên chức chuyên môn</td><td style="text-align:left;">Hạng I</td>',data);
		  				$('#dt3a_vc').html(dt);
		  			}
		        });
		        $.ajax({
					type: 'POST',
		  			url: '<?php echo JUri::base(true);?>/index.php?option=com_thongke&view=bcdaotaovc&format=raw&task=doituong',
		  			data: { donvi_id : donvi_id_checked, tungay_bcdaotaovc:tungay_bcdaotaovc, denngay_bcdaotaovc:denngay_bcdaotaovc, target:4 ,condition:2},
		  			success:function(data){
		  				dt= text('<td style="text-align:left;">Hạng II</td>',data);
		  				$('#dt3b_vc').html(dt);
		  			}
		        });
		        $.ajax({
					type: 'POST',
		  			url: '<?php echo JUri::base(true);?>/index.php?option=com_thongke&view=bcdaotaovc&format=raw&task=doituong',
		  			data: { donvi_id : donvi_id_checked, tungay_bcdaotaovc:tungay_bcdaotaovc, denngay_bcdaotaovc:denngay_bcdaotaovc, target:4 ,condition:3},
		  			success:function(data){
		  				dt= text('<td style="text-align:left;">Hạng III</td>',data);
		  				$('#dt3c_vc').html(dt);
		  			}
		        });
		        $.ajax({
					type: 'POST',
		  			url: '<?php echo JUri::base(true);?>/index.php?option=com_thongke&view=bcdaotaovc&format=raw&task=doituong',
		  			data: { donvi_id : donvi_id_checked, tungay_bcdaotaovc:tungay_bcdaotaovc, denngay_bcdaotaovc:denngay_bcdaotaovc, target:5 ,condition:1},
		  			success:function(data){
		  				dt= text('<td style="text-align:left;">Hạng IV</td>',data);
		  				$('#dt3d_vc').html(dt);
		  			}
		        });
		        $.ajax({
					type: 'POST',
		  			url: '<?php echo JUri::base(true);?>/index.php?option=com_thongke&view=bcdaotaovc&format=raw&task=doituong',
		  			data: { donvi_id : donvi_id_checked, tungay_bcdaotaovc:tungay_bcdaotaovc, denngay_bcdaotaovc:denngay_bcdaotaovc,target:0 },
		  			success:function(data){
		  				dt = text('<td  style="vertical-align:middle"></td><td colspan="2"  style="vertical-align:middle"><b>Cộng</b></td>', data);
		  				$('#dtall_vc').html(dt);
		  			}
		        });
			}else { alert("Vui lòng chọn ngày tháng!");}
    	}else alert("Vui lòng chọn đơn vị!");
	});
	$('#btn_exel_bcdaotaovc').on('click', function(){
		var checked_ids = [];
		$("#caydonvi_bcdaotaovc").jstree("get_checked",null,true).each(function () {
            checked_ids.push(this.id.replace("node_",""));
    	});
		if(checked_ids.length>0){
			var tungay_bcdaotaovc = $('#tungay_bcdaotaovc').val();
			var denngay_bcdaotaovc = $('#denngay_bcdaotaovc').val();
			url= '<?php echo JUri::base(true);?>/index.php?option=com_thongke&view=bcdaotaovc&format=xls&donvi_id='+checked_ids+'&tungay_bcdaotaovc='+tungay_bcdaotaovc+'&denngay_bcdaotaovc='+denngay_bcdaotaovc;
	  		document.location.assign(url);
		}else alert("Vui lòng chọn đơn vị");
	});
});
</script>