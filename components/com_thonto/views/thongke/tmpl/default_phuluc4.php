<?php
/**
 * Author: Phucnh
 * Date created: Jan 23, 2015
 * Company: DNICT
 */ 
$thongke = $this->thongke;
?>
<div>
	<h5 class="header smaller lighter blue">
		<?php echo $this->root_info['root_name']?>
		<span class="pull-right inline">
			<a data-original-title="Thêm mới" class="btn btn-small btn-primary" id="btn_hienthithongkemau4" style="margin-right: 5px;" data-toggle="modal" data-target=".modal">
				<i class="icon-search"></i> Hiển thị
			</a>
			<a id="dlink"  style="display:none;"></a>
			<input type="button" class="btn btn-small btn-success" id="btn_excelmau4"  value='Xuất excel'>
        </span>
	</h5>
</div>
<div class="row-fluid">
   	<div class="span4">
   		<div id="caydonvi_mau4" style="overflow:auto"> CÂY ĐƠN VỊ </div>
    </div>
    <div class="span8">
   			<h4 class="blue header"><i class="icon-star blue"></i> Phụ lục 4 - Thống kê số lượng người hoạt động không chuyên trách dưới phường, xã
   			</h4>
	</div>
</div>
	<h5 class="row-fluid header smaller lighter blue">
      	<span>Hiển thị nội dung thống kê</span>
	</h5>
	<div id="kqThongkemau4" ></div>
<script type="text/javascript">
var getDataPhuluc4 =  function(index,donvi_id,donvi_ten,donvi_kieu,lft,rgt){
	var dataPost = {option:'com_thonto',controller:'thongke',task:'getDulieuPhuluc4',lft:lft,rgt:rgt};
	jQuery.post('index.php', dataPost, function(data){
		var xhtml='';
		if (donvi_kieu==2){
			xhtml +="<td style='vertical-align: middle; text-align: left;' colspan='15'><b><i>"+donvi_ten+"</i></b></td>";
		}else{
			xhtml +="<td>"+donvi_ten+"</td>";
			xhtml +="<td style='vertical-align: middle; text-align: center;'>"+data[0].tongtochuc+"</td>";				
			xhtml +="<td style='vertical-align: middle; text-align: center;'>"+data[0].thonto_truong+"</td>";				
			xhtml +="<td style='vertical-align: middle; text-align: center;'>"+data[0].thonto_pho+"</td>";				
			xhtml +="<td style='vertical-align: middle; text-align: center;'>"+data[0].chibo_bithu+"</td>";				
			xhtml +="<td style='vertical-align: middle; text-align: center;'>"+data[0].chibo_phobithu+"</td>";
			xhtml +="<td style='vertical-align: middle; text-align: center;'>"+data[0].bancongtac_truongban+"</td>";
			xhtml +="<td style='vertical-align: middle; text-align: center;'>"+data[0].bancongtac_phoban+"</td>";
			xhtml +="<td style='vertical-align: middle; text-align: center;'>"+data[0].chihoiphunu+"</td>";
			xhtml +="<td style='vertical-align: middle; text-align: center;'>"+data[0].chihoicuuchienbinh+"</td>";				
			xhtml +="<td style='vertical-align: middle; text-align: center;'>"+data[0].bithudoantn+"</td>";
			xhtml +="<td style='vertical-align: middle; text-align: center;'>"+data[0].chihoinongdan+"</td>";
			xhtml +="<td style='vertical-align: middle; text-align: center;'>"+data[0].todanvan+"</td>";
			xhtml +="<td style='vertical-align: middle; text-align: center;'>"+data[0].baovedanpho+"</td>";
			xhtml +="<td style='vertical-align: middle; text-align: center;'>"+data[0].conganvien+"</td>";
		}
		jQuery("#tr_phuluc4_"+donvi_id).append(xhtml);
	});
}
jQuery(document).ready(function($){
	$('#btn_excelmau4').on('click', function(){
		if ($('#tblThongkemau4').length>0)
			tableToExcel('tblThongkemau4', 'name', 'Phuluc4_Soluongkhongchuyentrach.xls');
		else alert('Vui lòng hiển thị báo cáo trước');
	});
	$('#btn_hienthithongkemau4').on('click', function(){
		var checked_ids = []; 
		jQuery("#caydonvi_mau4").jstree("get_checked",null,true).each(function () {
	        checked_ids.push(jQuery(this).attr('id').replace('node_',''));
		});
		if(checked_ids.length>0){
			jQuery('#kqThongkemau4').load('/index.php?option=com_thonto&view=thongke&format=raw&task=getPhuluc4&id='+checked_ids, function(){
			});
		}else alert("Vui lòng chọn đơn vị!");
	});
	$("#caydonvi_mau4").jstree({
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
		     "task" : "treeQuanhuyen",
		     "format" : "raw",                            
		     "id" : n.attr ? n.attr("id").replace("node_","") : + <?php echo $this->root_info['root_id'];?>
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
				if(showlist != '1'){
					if(showlist == 4|| showlist == 5){
					}else{
		 				data.inst.toggle_node(data.rslt.obj);
		 			}
				}else {data.inst.toggle_node(data.rslt.obj);}
			 });
});
</script>