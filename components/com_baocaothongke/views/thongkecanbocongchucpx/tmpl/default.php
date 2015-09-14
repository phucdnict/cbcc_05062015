<?php
/**
 * Author: Phucnh
 * Date created: Apr 15, 2015
 * Company: DNICT
 */
?>
<div>
	<h5 class="header smaller lighter blue">
		<?php echo $this->root_info['root_name']?>
		<span class="pull-right inline">
			
			<span data-original-title="Xóa" class="btn btn-small btn-success" id="btn_excel_thongkecanbocongchucpx" style="margin-right: 5px;" data-placement="top" title="">
					<a id="dlink"  style="display:none;"></a>
					<i class="icon-download"></i> Xuất excel
				</span>
	        </span>
		</h5>
</div>
<div class="row-fluid">
   	<div class="span4">
   		<div id="caydonvi_thongkecanbocongchucpx" style="overflow:auto; height: 200px;"> CÂY ĐƠN VỊ </div>
    </div>
   	<div class="span8">
   		<h4 style="text-align:center;" class="blue header"><i class="icon-star blue"></i> Thống kê chất lượng cán bộ, công chức cấp xã (Mẫu số 02/CL.CBCCX)</h4>
   		<div class="row-fluid">
				<div class="span6 widget-container-span ui-sortable">
					<div class="widget-box transparent">
						<div class="widget-header">
							<h5>Chức danh công chức</h5>
							<div class="widget-toolbar no-border">
								<a data-action="collapse" href="#"> <i class="icon-chevron-up"></i>	</a>
							</div>
						</div>
						<div class="widget-body">
							<div style="display: block;" class="widget-body-inner">
								<div class="widget-main">
									<?php for($i=0; $i<count($this->chucdanh); $i++){ $chucdanh = $this->chucdanh[$i]?>
									<label class="lb_ds">
		                        		<input class="ck_chucdanh" type="checkbox" checked="" value="<?php echo $chucdanh->relation_id;?>" name="congchuc_loaibc[]">
		                        		<span class="lbl"> <?php echo $chucdanh->name;?><br></span>
	                        		</label><label class="lb_ds">
	                        		<?php }?>
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
	<a data-original-title="Thêm mới" class="btn btn-small btn-primary" id="btn_hienthi_thongkecanbocongchucpx" style="margin-right: 5px;" data-toggle="modal" data-target=".modal">
		<i class="icon-search"></i> Hiển thị
	</a>
</h5>
<div id="thongke_ketqua" style="min-height:300px;"></div>
<script type="text/javascript">
var getNull = function(bien, value){
	if (bien == 0 || bien==null) return "";
	else return bien;
}
var getData_thongkecanbocongchucpx = function(index,tencbcc,hosochinh_id, j){
	var dataPost = {option:'com_baocaothongke',controller:'thongkecanbocongchucpx',task:'getData_thongkecanbocongchucpx', hosochinh_id: hosochinh_id};
	jQuery.post('index.php', dataPost, function(data){
		var xhtml = '';
		xhtml+= '<td class="center" style="vertical-align:middle;" nowrap="nowrap">'+index+'</td>';
		xhtml+= '<td style="vertical-align:middle;" nowrap="nowrap">'+tencbcc+'</td>';
		if(data.gioitinh =='Nu') {nam="";nu=data.ngaysinh;} else {nam=data.ngaysinh;nu="";} 
		if (data.ngaybatdau_bhxh!= null) ngaybatdau_bhxh= data.ngaybatdau_bhxh; else ngaybatdau_bhxh="";
		if (data.tongiao!= null) tongiao= data.tongiao; else tongiao="";
		if (data.cm_thacsi+data.cm_daihoc+data.cm_caodang+data.cm_trungcap+data.cm_socap ==0) cm_chuadaotao=1; else cm_chuadaotao="";
		if (data.qlnn_cv+data.qlnn_cv ==0) qlnn_chuadaotao = 1; else qlnn_chuadaotao="";
		xhtml+= '<td class="center" style="vertical-align:middle;">'+nam+'</td>';
		xhtml+= '<td class="center" style="vertical-align:middle;">'+nu+'</td>';
		xhtml+= '<td class="center" style="vertical-align:middle;">'+ngaybatdau_bhxh+'</td>';
		xhtml+= '<td class="center" style="vertical-align:middle;">'+getNull(data.dang_danhdaudangvien)+'</td>';
		xhtml+= '<td class="center" style="vertical-align:middle;">'+data.dantoc+'</td>';
		xhtml+= '<td class="center" style="vertical-align:middle;">'+tongiao+'</td>';
		xhtml+= '<td class="center" style="vertical-align:middle;">'+getNull(data.elec_prov)+'</td>';
		xhtml+= '<td class="center" style="vertical-align:middle;">'+getNull(data.elec_dist)+'</td>';
		xhtml+= '<td class="center" style="vertical-align:middle;">'+getNull(data.elec_comm)+'</td>';
		xhtml+= '<td class="center" style="vertical-align:middle;"></td>';
		xhtml+= '<td class="center" style="vertical-align:middle;">'+getNull(data.tieuhoc)+'</td>';
		xhtml+= '<td class="center" style="vertical-align:middle;">'+getNull(data.thcs)+'</td>';
		xhtml+= '<td class="center" style="vertical-align:middle;">'+getNull(data.phothong)+'</td>';
		xhtml+= '<td class="center" style="vertical-align:middle;">'+cm_chuadaotao+'</td>';
		xhtml+= '<td class="center" style="vertical-align:middle;">'+getNull(data.cm_socap)+'</td>';
		xhtml+= '<td class="center" style="vertical-align:middle;">'+getNull(data.cm_trungcap)+'</td>';
		xhtml+= '<td class="center" style="vertical-align:middle;">'+getNull(data.cm_caodang)+'</td>';
		xhtml+= '<td class="center" style="vertical-align:middle;">'+getNull(data.cm_daihoc)+'</td>';
		xhtml+= '<td class="center" style="vertical-align:middle;">'+getNull(data.cm_thacsi)+'</td>';
		xhtml+= '<td class="center" style="vertical-align:middle;">'+getNull(data.llct_socap)+'</td>';
		xhtml+= '<td class="center" style="vertical-align:middle;">'+getNull(data.llct_trungcap)+'</td>';
		xhtml+= '<td class="center" style="vertical-align:middle;">'+getNull(data.llct_caocap)+'</td>';
		xhtml+= '<td class="center" style="vertical-align:middle;"></td>';
		xhtml+= '<td class="center" style="vertical-align:middle;">'+qlnn_chuadaotao+'</td>';
		xhtml+= '<td class="center" style="vertical-align:middle;">'+getNull(data.qlnn_cv)+'</td>';
		xhtml+= '<td class="center" style="vertical-align:middle;">'+getNull(data.qlnn_cvc)+'</td>';
		xhtml+= '<td class="center" style="vertical-align:middle;">'+getNull(data.th_chungchi)+'</td>';
		xhtml+= '<td class="center" style="vertical-align:middle;">'+getNull(data.th_trungcap)+'</td>';
		xhtml+= '<td class="center" style="vertical-align:middle;">'+getNull(data.th_caodang)+'</td>';
		xhtml+= '<td class="center" style="vertical-align:middle;">'+getNull(data.th_daihoc)+'</td>';
		xhtml+= '<td class="center" style="vertical-align:middle;">'+getNull(data.nn_chungchi)+'</td>';
		xhtml+= '<td class="center" style="vertical-align:middle;">'+getNull(data.nn_trungcap)+'</td>';
		xhtml+= '<td class="center" style="vertical-align:middle;">'+getNull(data.nn_caodang)+'</td>';
		xhtml+= '<td class="center" style="vertical-align:middle;">'+getNull(data.nn_daihoc)+'</td>';
		xhtml+= '<td class="center" style="vertical-align:middle;">'+getNull(data.quocphonganninh)+'</td>';
		xhtml+= '<td class="center" style="vertical-align:middle;">'+getNull(data.duoi30)+'</td>';
		xhtml+= '<td class="center" style="vertical-align:middle;">'+getNull(data.tu30den40)+'</td>';
		xhtml+= '<td class="center" style="vertical-align:middle;">'+getNull(data.tu40den50)+'</td>';
		xhtml+= '<td class="center" style="vertical-align:middle;">'+getNull(data.tu50den60)+'</td>';
		xhtml+= '<td class="center" style="vertical-align:middle;">'+getNull(data.tu50den55)+'</td>';
		xhtml+= '<td class="center" style="vertical-align:middle;">'+getNull(data.tu55den60)+'</td>';
		xhtml+= '<td class="center" style="vertical-align:middle;">'+getNull(data.tren60)+'</td>';
		xhtml+= '<td class="center" style="vertical-align:middle;"></td>';
		xhtml+= '<td class="center" style="vertical-align:middle;"></td>';
		xhtml+= '<td class="center" style="vertical-align:middle;"></td>';
		xhtml+= '<td class="center" style="vertical-align:middle;"></td>';
		xhtml+= '<td class="center" style="vertical-align:middle;"></td>';
		jQuery("#tr_thongkecanbocongchucpx_"+j).append(xhtml);
	});
};
jQuery(document).ready(function($){
	$('#btn_hienthi_thongkecanbocongchucpx').on('click', function(){
		var checked_ids = [];
		var check_chucdanh = [];
		$("input[name='congchuc_loaibc[]']:checked").each( function () {
			check_chucdanh.push(parseInt($(this).val()));
		});
		$("#caydonvi_thongkecanbocongchucpx").jstree("get_checked",null,true).each(function () {
            checked_ids.push((this.id).replace("node_",""));
    	});
    	if(checked_ids.length>0){
        	$('#thongke_ketqua').load('index.php?option=com_baocaothongke&view=thongkecanbocongchucpx&format=raw&task=xuatbaocao&donvi_id='+checked_ids+'&chucdanh='+check_chucdanh,function(){
        	});
    	}else alert("Vui lòng chọn đơn vị!");
	});
	$('#btn_excel_thongkecanbocongchucpx').on('click', function(){
		if ($('#table_thongkecanbochongchucpx').length>0)
			tableToExcel('table_thongkecanbochongchucpx', 'name', 'Thongkecanbochongchucpx.xls');
		else alert('Vui lòng hiển thị báo cáo trước');
	});
	$(document).ajaxStart(function() {
        $.blockUI();
    });

	$(document).ajaxStop(function() {
	    $.unblockUI();
	});
	$("#caydonvi_thongkecanbocongchucpx").jstree({
   		"plugins" : ["themes","json_data","checkbox","types","ui","cookies"],
   		"json_data" : {
		  "ajax" : {
		   "url" : "<?php echo JURI::base(true);?>/index.php",
		   "data" : function (n) {
		    return {
		     "option" : "com_baocaothongke",                            
		     "view" : "treeunit",
		     "task" : "getTree",
		     "report_group_code" : "canbopx",
		     "format" : "raw",                            
		     "root_id" :  <?php echo $this->root_info['root_id'];?>,
		     "id" : n.attr ? n.attr("id").replace("node_","") : + <?php echo $this->root_info['root_id'];?>
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
});
</script>