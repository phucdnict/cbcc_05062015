<?php
defined('_JEXEC') or die('Restricted access');
?>
		<div>
			<h5 class="header smaller lighter blue">
				<?php echo $this->id_donvi['rootName']?>
				<span class="pull-right inline">
					<a data-original-title="Thêm mới" class="btn btn-small btn-primary" id="btn_hienthi_phuluc1" style="margin-right: 5px;" data-toggle="modal" data-target=".modal">
						<i class="icon-search"></i> Hiển thị
					</a>
					<span data-original-title="Xóa" class="btn btn-small btn-success" id="btn_excel_phuluc1" style="margin-right: 5px;" data-placement="top" title="">
						<a id="dlink"  style="display:none;"></a>
						<i class="icon-download"></i> Xuất excel
					</span>
		        </span>
			</h5>
		</div>
		<div class="row-fluid">
		   	<div class="span4">
		   		<div id="caydonvi_moi" style="overflow:auto"> CÂY ĐƠN VỊ </div>
		    </div>
		     <div class="span8">
   			<h4 class="blue header"><i class="icon-star blue"></i> Phụ lục 1 - Thống kê số lượng, chất lượng tổ trưởng	tổ dân phố, trưởng thôn
   			</h4>
	</div>
	</div>
	<h5 class="row-fluid header smaller lighter blue">
      	<span>Hiển thị nội dung báo cáo</span>
	</h5>
	<div id="ketquabaocao" ></div>
<script type="text/javascript">
var getDataPhuluc1 = function(index,donvi_id,donvi_ten,donvi_kieu,lft,rgt){
	var dataPost = {option:'com_thonto',controller:'thongke',task:'getDulieuPhuluc1',lft:lft,rgt:rgt};
	jQuery.post('index.php', dataPost, function(data){
		var xhtml = '';
		if(donvi_kieu == '2'){
			xhtml+= '<td class="center" style="vertical-align:middle;" colspan="2" nowrap="nowrap"><b>'+donvi_ten+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.soluong_totruong+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.nam+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.nu+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.tuoiduoi30+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.tuoitu31den45+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.tuoitu46den60+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.tuoitu61den70+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.tuoitren70+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.tuoikhongro+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.dangvien+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.trinhdo_saudaihoc+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.trinhdo_daihoc+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.trinhdo_caodang+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.trinhdo_trungcap+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.trinhdo_socap+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.trinhdo_chuadaotao+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.canbo_capthanhpho+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.canbo_capquanhuyen+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.canbo_capphuongxa+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.canbo_nghetudo+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.canbo_huutri+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.bhyt_ngansach+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.bhyt_dienkhac+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.to_duoi30+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.to_tu30den40+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.to_tren40+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.thon_duoi350+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.thon_tu350den500+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.to_tren500+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.kiemnhiem_tongso+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.kiemnhiem_bithu+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.kiemnhiem_phobithu+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.kiemnhiem_chucdanhkhac+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.congtac_duoi5+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.congtac_tu5den10+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.congtac_tu10den15+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.congtac_tren15+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>0</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.bangkhenchutich+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.dadaotaonghiepvu+'</b></td>';
				
		}else{
			xhtml+= '<td class="center" style="vertical-align:middle;">'+index+'</td>';
			xhtml+= '<td style="vertical-align:middle;" nowrap="nowrap">'+donvi_ten+'</td>';
			xhtml+= '<td class="center" style="vertical-align:middle;">'+data.soluong_totruong+'</td>';
			xhtml+= '<td class="center" style="vertical-align:middle;">'+data.nam+'</td>';
			xhtml+= '<td class="center" style="vertical-align:middle;">'+data.nu+'</td>';
			xhtml+= '<td class="center" style="vertical-align:middle;">'+data.tuoiduoi30+'</td>';
			xhtml+= '<td class="center" style="vertical-align:middle;">'+data.tuoitu31den45+'</td>';
			xhtml+= '<td class="center" style="vertical-align:middle;">'+data.tuoitu46den60+'</td>';
			xhtml+= '<td class="center" style="vertical-align:middle;">'+data.tuoitu61den70+'</td>';
			xhtml+= '<td class="center" style="vertical-align:middle;">'+data.tuoitren70+'</td>';
			xhtml+= '<td class="center" style="vertical-align:middle;">'+data.tuoikhongro+'</td>';
			xhtml+= '<td class="center" style="vertical-align:middle;">'+data.dangvien+'</td>';
			xhtml+= '<td class="center" style="vertical-align:middle;">'+data.trinhdo_saudaihoc+'</td>';
			xhtml+= '<td class="center" style="vertical-align:middle;">'+data.trinhdo_daihoc+'</td>';
			xhtml+= '<td class="center" style="vertical-align:middle;">'+data.trinhdo_caodang+'</td>';
			xhtml+= '<td class="center" style="vertical-align:middle;">'+data.trinhdo_trungcap+'</td>';
			xhtml+= '<td class="center" style="vertical-align:middle;">'+data.trinhdo_socap+'</td>';
			xhtml+= '<td class="center" style="vertical-align:middle;">'+data.trinhdo_chuadaotao+'</td>';
			xhtml+= '<td class="center" style="vertical-align:middle;">'+data.canbo_capthanhpho+'</td>';
			xhtml+= '<td class="center" style="vertical-align:middle;">'+data.canbo_capquanhuyen+'</td>';
			xhtml+= '<td class="center" style="vertical-align:middle;">'+data.canbo_capphuongxa+'</td>';
			xhtml+= '<td class="center" style="vertical-align:middle;">'+data.canbo_nghetudo+'</td>';
			xhtml+= '<td class="center" style="vertical-align:middle;">'+data.canbo_huutri+'</td>';
			xhtml+= '<td class="center" style="vertical-align:middle;">'+data.bhyt_ngansach+'</td>';
			xhtml+= '<td class="center" style="vertical-align:middle;">'+data.bhyt_dienkhac+'</td>';
			xhtml+= '<td class="center" style="vertical-align:middle;">'+data.to_duoi30+'</td>';
			xhtml+= '<td class="center" style="vertical-align:middle;">'+data.to_tu30den40+'</td>';
			xhtml+= '<td class="center" style="vertical-align:middle;">'+data.to_tren40+'</td>';
			xhtml+= '<td class="center" style="vertical-align:middle;">'+data.thon_duoi350+'</td>';
			xhtml+= '<td class="center" style="vertical-align:middle;">'+data.thon_tu350den500+'</td>';
			xhtml+= '<td class="center" style="vertical-align:middle;">'+data.to_tren500+'</td>';
			xhtml+= '<td class="center" style="vertical-align:middle;">'+data.kiemnhiem_tongso+'</td>';
			xhtml+= '<td class="center" style="vertical-align:middle;">'+data.kiemnhiem_bithu+'</td>';
			xhtml+= '<td class="center" style="vertical-align:middle;">'+data.kiemnhiem_phobithu+'</td>';
			xhtml+= '<td class="center" style="vertical-align:middle;">'+data.kiemnhiem_chucdanhkhac+'</td>';
			xhtml+= '<td class="center" style="vertical-align:middle;">'+data.congtac_duoi5+'</td>';
			xhtml+= '<td class="center" style="vertical-align:middle;">'+data.congtac_tu5den10+'</td>';
			xhtml+= '<td class="center" style="vertical-align:middle;">'+data.congtac_tu10den15+'</td>';
			xhtml+= '<td class="center" style="vertical-align:middle;">'+data.congtac_tren15+'</td>';
			xhtml+= '<td class="center" style="vertical-align:middle;">0</td>';
			xhtml+= '<td class="center" style="vertical-align:middle;">'+data.bangkhenchutich+'</td>';
			xhtml+= '<td class="center" style="vertical-align:middle;">'+data.dadaotaonghiepvu+'</td>';
				
		}
		jQuery("#tr_phuluc1_"+donvi_id).append(xhtml);
	});
};
jQuery(document).ready(function($){
	var id;
	$("#caydonvi_moi").jstree({
		   		"plugins" : ["themes","json_data","checkbox","types","ui","cookies"],
		   		"json_data" : {
		  		"data" : [{ "attr" : { "id" : "<?php echo $this->id_donvi['rootId'];?>", "showlist":"<?php echo $this->id_donvi['rootType'];?>"},
		     	"state" : "closed",
		     	"data" : {
		       	"title" : "<?php echo $this->id_donvi['rootName'];?>",
		       	"attr" : { "href" : "#" }
		      }
		  }],
		  "ajax" : {
		   "url" : "<?php echo JURI::base(true);?>/index.php",
		   "data" : function (n) {
		    return {
		     "option" : "com_thonto",                            
		     "view" : "treeview",
		     "task" : "treeview",
		     "format" : "raw",                            
		     "id" : n.attr ? n.attr("id").replace("node_","") : + root_id
		    };
		   }
		  }
		  },
		  "checkbox": {
              two_state: true,
              override_ui: false,
              real_checkboxes:false,
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
		     "valid_children" : [ "default" ]
		    }
		   }
		  }  
		 }).bind("select_node.jstree", function (e, data) {
				id = data.rslt.obj.attr("id").replace("node_","");
				showlist = data.rslt.obj.attr('showlist');
				if(showlist != '2'){
					if(showlist == 1 || showlist == 3 || showlist == 0){
					}else{
		 				data.inst.toggle_node(data.rslt.obj);
		 			}
				}else {data.inst.toggle_node(data.rslt.obj);}
			 });
	$('#btn_excel_phuluc1').on('click', function(){
		if ($('#tblPhuluc1').length>0){
			tableToExcel('tblPhuluc1', 'name', 'Phuluc1_SoluongTotruong.xls');
		}else alert('Vui lòng hiển thị báo cáo trước');
	});
	$('#btn_hienthi_phuluc1').on('click', function(){
		var checked_ids = []; 
		$("#caydonvi_moi").jstree("get_checked",null,true).each(function () {
            checked_ids.push(this.id.replace("node_",""));
    	});
    	if(checked_ids.length>0){
        	$('#ketquabaocao').load('index.php?option=com_thonto&view=thongke&format=raw&task=getPhuluc1&donvi_id='+checked_ids,function(){
        	});
    	}else alert("Vui lòng chọn đơn vị!");
	});
	
});
</script>