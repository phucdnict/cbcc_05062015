<?php
/**
 * Author: Phucnh
 * Date created: Jan 23, 2015
 * Company: DNICT
 */ 
$thongke = $this->thongke;
$model = Core::model('Thonto/Thongke');
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
			<a data-original-title="Thêm mới" class="btn btn-small btn-primary" id="btn_hienthithongkemau5" style="margin-right: 5px;">
				<i class="icon-search"></i> Hiển thị
			</a>
			<a id="dlink"  style="display:none;"></a>
			<input type="button" class="btn btn-small btn-success" id="btn_excelmau5"  value='Xuất excel'>
        </span>
	</h5>
</div>
<div class="row-fluid">
   	<div class="span4">
   		<div id="caydonvi_mau5" style="overflow:auto"> CÂY ĐƠN VỊ </div>
    </div>
    <div class="span8">
   			<h4 class="blue header"><i class="icon-star blue"></i> Phụ lục 5 - Bảng theo dõi tình hình hoạt động tại tổ dân phố, thôn
   			</h4>
   			Đợt báo cáo: <?php echo ThontoHelper::selectBox_notdefautl(null,array('name'=>'dot_phuluc5'),'thonto_dotbaocao',array('id','tendot'), 'trangthai =1', 'nam desc, id desc');?>
	</div>
</div>
	<h5 class="row-fluid header smaller lighter blue">
      	<span>Hiển thị nội dung thống kê</span>
	</h5>
	<div id="kqThongkemau5" ></div>
<script type="text/javascript">
var dot_phuluc5;
var getDataPhuluc5 = function(index,donvi_id,donvi_ten,donvi_kieu,lft,rgt){
	dot_phuluc5 = jQuery('#dot_phuluc5 option:selected').val();
	var dataPost = {option:'com_thonto',controller:'thongke',task:'getDulieuPhuluc5',lft:lft,rgt:rgt, dot_phuluc5:dot_phuluc5};
	jQuery.post('index.php', dataPost, function(data){
		var xhtml = '';
		var a =data.thongtinthem;
		if(donvi_kieu == '2'){
			xhtml+= '<td style="vertical-align:middle;" colspan="'+(9+a)+'" nowrap="nowrap"><b><i>'+donvi_ten+'</i></b></td>';
		}else if(donvi_kieu == '3'){
			xhtml+= '<td class="center" style="vertical-align:middle;" nowrap="nowrap"><b>'+index+'</b></td>';
			xhtml+= '<td style="vertical-align:middle;" nowrap="nowrap"><b>'+donvi_ten+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.dinhky_solan+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.dotxuat_solan+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.thanhphan_daydu+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.thanhphan_khongdaydu+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.sohothamgia+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.tyle+'</b></td>';
			for(j=0; j<(a).length;j++){
				xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+a[j]+'</b></td>';
			}
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.dagiaiquyet_thonto+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.dagiaiquyet_phuongxa+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.dagiaiquyet_quanhuyentrolen+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.hopquandanchinh_solan+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.thaythetotruong_soluong+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.nhiemvutrongtam_ok+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.nhiemvutrongtam_no+'</b></td>';
		}else{
			xhtml+= '<td class="center" style="vertical-align:middle;" nowrap="nowrap"><b>+</b></td>';
			xhtml+= '<td style="vertical-align:middle;" nowrap="nowrap"><b>'+donvi_ten+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.dinhky_solan+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.dotxuat_solan+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.thanhphan_daydu+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.thanhphan_khongdaydu+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.sohothamgia+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.tyle+'</b></td>';
			for(j=0; j<(a).length;j++){
				xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+a[j]+'</b></td>';
			}
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.dagiaiquyet_thonto+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.dagiaiquyet_phuongxa+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.dagiaiquyet_quanhuyentrolen+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.hopquandanchinh_solan+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.thaythetotruong_soluong+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.nhiemvutrongtam_ok+'</b></td>';
			xhtml+= '<td class="center" style="vertical-align:middle;"><b>'+data.nhiemvutrongtam_no+'</b></td>';
		}
		jQuery("#tr_phuluc5_"+donvi_id).append(xhtml);
	});
};
jQuery(document).ready(function($){
	$('#btn_hienthithongkemau5').on('click', function(){
		var checked_ids = []; 
		$("#caydonvi_mau5").jstree("get_checked",null,true).each(function () {
            checked_ids.push($(this).attr('id').replace('node_',''));
    	});
    	if(checked_ids.length>0){
			$('#kqThongkemau5').load('/index.php?option=com_thonto&view=thongke&format=raw&task=getPhuluc5&id='+checked_ids, function(){
			});
    	}else alert("Vui lòng chọn đơn vị!");
	});
	$('#btn_excelmau5').on('click', function(){
		if ($('#tblThongkemau5').length>0)
			tableToExcel('tblThongkemau5', 'name', 'Phuluc5_Tinhhinhhoatdong.xls');
		else alert('Vui lòng hiển thị báo cáo trước');
	});
	$("#caydonvi_mau5").jstree({
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
		     "task" : "treeThonto",
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
});
</script>