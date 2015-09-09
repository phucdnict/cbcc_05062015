<?php
/**
 * Author: Phucnh
 * Date created: Jan 23, 2015
 * Company: DNICT
 */ 
$thongke = $this->thongke;
?>
<style>
table.dataTable thead .sorting, 
table.dataTable thead .sorting_asc, 
table.dataTable thead .sorting_desc {
    background : none;
}
</style>
<div>
	<h5 class="header smaller lighter blue">
		<?php echo $this->root_info['root_name']?>
		<span class="pull-right inline">
			<a data-original-title="Thêm mới" class="btn btn-small btn-primary" id="btn_hienthithongkemau6" style="margin-right: 5px;" data-toggle="modal" data-target=".modal">
				<i class="icon-search"></i> Hiển thị
			</a>
			<a id="dlink"  style="display:none;"></a>
			<input type="button" class="btn btn-small btn-success" id="btn_excelmau6"  value='Xuất excel'>
        </span>
	</h5>
</div>
<div class="row-fluid">
   	<div class="span4">
   		<div id="caydonvi_mau6" style="overflow:auto"> CÂY ĐƠN VỊ </div>
    </div>
    <div class="span8">
   			<h4 class="blue header"><i class="icon-star blue"></i> Phụ lục 6 - Theo dõi tình hình quản lý tổ dân phố, thôn tại UBND phường xã
   			</h4>
   			Đợt báo cáo: <?php echo ThontoHelper::selectBox_notdefautl(null,array('name'=>'dot_phuluc6'),'thonto_dotbaocao',array('id','tendot'), 'trangthai =1', 'nam desc, id desc');?>
	</div>
</div>
	<h5 class="row-fluid header smaller lighter blue">
      	<span>Hiển thị nội dung thống kê</span>
	</h5>
	<div id="kqThongkemau6" ></div>
<script type="text/javascript">
var dot_phuluc6;
var getDataPhuluc6 = function(index,donvi_id,donvi_ten,donvi_kieu,lft,rgt){
	dot_phuluc6 = jQuery('#dot_phuluc6 option:selected').val();
	var dataPost = {option:'com_thonto',controller:'thongke',task:'getDulieuPhuluc6',lft:lft,rgt:rgt, dot_phuluc6:dot_phuluc6};
	jQuery.post('index.php', dataPost, function(data){
		var xhtml = '';
		var a =data.thongtinthem;
		if(donvi_kieu == '2'){
			xhtml+= '<td style="vertical-align:middle;" colspan="'+(10+a)+'" nowrap="nowrap"><b><i>'+donvi_ten+'</i></b></td>';
		}else{
			xhtml+= '<td class="center" style="vertical-align:middle;" nowrap="nowrap"><b>'+index+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;" nowrap="nowrap"><b>'+donvi_ten+'</b></td>';
		
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.lapsotheodoihoatdong+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.thanhphan_soluong1+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.thanhphan_soluong2+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.thanhphan_soluong3+'</b></td>';
			for(j=0; j<(a).length;j++){
				xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+a[j]+'</b></td>';
			}
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.soluongvang+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.kiennghi_soluong+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.kiennghi_dagiaiquyet+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.khong+'</b></td>';
		}
		jQuery("#tr_phuluc6_"+donvi_id).append(xhtml);
	});
};
jQuery(document).ready(function($){
	$("#caydonvi_mau6").jstree({
		   		"plugins" : ["themes","json_data","checkbox","types","ui","cookies"],
		   		"json_data" : {
		  		"data" : [{ "attr" : { "id" : "<?php echo $this->root_info['root_id'];?>", "showlist":"<?php echo $this->root_info['root_showlist'];?>"},
		     	"state" : "closed",
		     	"data" : {
		       	"title" : "<?php echo $this->root_info['root_name'];?>",
		       	"attr" : { "href" : "#" }
		      }
		  }],
		  "ajax" : {
		   "url" : "<?php echo JURI::base(true);?>/index.php",
		   "data" : function (n) {
		    return {
		     "option" : "com_thonto",                            
		     "view" : "treeview",
		     "task" : "treePhuongxa",
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
				showlist = data.rslt.obj.attr('showlist');
				if(showlist == 4 || showlist == 5){
				}else{
	 				data.inst.toggle_node(data.rslt.obj);
	 			}
		 });
	$('#btn_excelmau6').on('click', function(){
		if ($('#tblThongkemau6').length>0)
			tableToExcel('tblThongkemau6', 'name', 'Phuluc6_Tinhhinhquanly.xls');
		else alert('Vui lòng hiển thị báo cáo trước');
	});
	$('#btn_hienthithongkemau6').on('click', function(){
		var checked_ids = []; 
		$("#caydonvi_mau6").jstree("get_checked",null,true).each(function () {
            checked_ids.push($(this).attr('id').replace('node_',''));
    	});
    	if(checked_ids.length>0){
			$('#kqThongkemau6').load('/index.php?option=com_thonto&view=thongke&format=raw&task=getPhuluc6&id='+checked_ids, function(){
			});
    	}else alert("Vui lòng chọn đơn vị!");
	});
});
</script>