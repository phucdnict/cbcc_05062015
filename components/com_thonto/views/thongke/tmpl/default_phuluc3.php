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
			<a data-original-title="Thêm mới" class="btn btn-small btn-primary" id="btn_hienthithongkemau2" style="margin-right: 5px;" data-toggle="modal" data-target=".modal">
				<i class="icon-search"></i> Hiển thị
			</a>
			<a id="dlink"  style="display:none;"></a>
			<input type="button" class="btn btn-small btn-success" id="btn_excelmau2"  value='Xuất excel'>
        </span>
	</h5>
</div>
<div class="row-fluid">
   	<div class="span4">
   		<div id="caydonvi_mau2" style="overflow:auto"> CÂY ĐƠN VỊ </div>
	    </div>
	    <div class="span8">
   			<h4 class="blue header"><i class="icon-star blue"></i> Phụ lục 3 - Thống kê số lượng, chất lượng người phụ trách theo dõi tổ trưởng tổ dân phố, thôn</h4>
	   		</div>
  		</div>
</div>
	<h5 class="row-fluid header smaller lighter blue">
      	<span>Hiển thị nội dung thống kê</span>
	</h5>
	<div id="kqThongkemau2" ></div>
<script type="text/javascript">
jQuery(document).ready(function($){
	var id;
	$("#caydonvi_mau2").jstree({
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
				if(showlist != '1'){
					if(showlist == 4 || showlist == 5){
					}else{
		 				data.inst.toggle_node(data.rslt.obj);
		 			}
				}else {data.inst.toggle_node(data.rslt.obj);}
			 });
	$('#btn_excelmau2').on('click', function(){
		var checked_ids = []; 
		$("#caydonvi_mau2").jstree("get_checked",null,true).each(function () {
            checked_ids.push($(this).attr('id').replace('node_',''));
    	});
    	if(checked_ids.length>0){
			$.blockUI();
			$('#kqThongkemau2').load('/index.php?option=com_thonto&view=thongke&format=raw&task=getPhuluc3&id='+checked_ids, function(){
				$.unblockUI();
				tableToExcel('tblThongkemau2', 'name', 'Phuluc3_Soluongchatluong.xls');
			});
    	}else alert("Vui lòng chọn đơn vị!");
		
	});
	$('#btn_hienthithongkemau2').on('click', function(){
		var checked_ids = []; 
		$("#caydonvi_mau2").jstree("get_checked",null,true).each(function () {
            checked_ids.push($(this).attr('id').replace('node_',''));
    	});
    	if(checked_ids.length>0){
			$.blockUI();
			$('#kqThongkemau2').load('/index.php?option=com_thonto&view=thongke&format=raw&task=getPhuluc3&id='+checked_ids, function(){
				$.unblockUI();
			});
    	}else alert("Vui lòng chọn đơn vị!");
	});
});
</script>