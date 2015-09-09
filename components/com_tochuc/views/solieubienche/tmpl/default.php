<?php
/**
 * Author: Phucnh
 * Date created: Mar 19, 2015
 * Company: DNICT
 */ 
defined('_JEXEC') or die('Restricted access');
$user   = JFactory::getUser();
?>
<style>
#main-content-tree{
 height: 280px;
 overflow: auto;
}
table.dataTable thead .sorting, 
table.dataTable thead .sorting_asc, 
table.dataTable thead .sorting_desc {
    background : none;
}
</style>
<div>
	<h4 class="header lighter blue">
		Số lượng <i class="icon-double-angle-right"></i><small><span id="tendonvi"></span></small>
	</h4>
</div>
<div id="noidung" >
</div>
<script type="text/javascript">
var donvi_id;
var showlist;
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
var year = function(dateObject) {
    var d = new Date(dateObject);
    var year = d.getFullYear();
    return year;
};
var refresh = function(){
	jQuery.blockUI();
	jQuery('#noidung').load('index.php?option=com_tochuc&view=solieubienche&format=raw&task=frmsolieu&donvi_id='+donvi_id, function(){
		jQuery.unblockUI();
		});
}
jQuery(document).ready(function($){
	createTreeviewInMenuBar('Cây đơn vị');
	var root_id = '150000';
	$("#main-content-tree").jstree({
		   "plugins" : ["themes","json_data","types","ui","cookies"],
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
		     "option" : "com_tochuc",                            
		     "view" : "treeview",
		     "task" : "treetochuc",
		     "format" : "raw",                            
		     "id" : n.attr ? n.attr("id").replace("node_","") : root_id,
		    };
		   }
		  }
		  },
		  "checkbox":{
		   "two_state": true,
//		    real_checkboxes: true,
		   "override_ui": false
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
			donvi_id = data.rslt.obj.attr("id").replace("node_","");
			$('#tendonvi').html($('.jstree-clicked').text());
			showlist = data.rslt.obj.attr('showlist');
			/*
			showlist = 0 => Phòng
			showlist = 1 => Tổ chức
			showlist = 2 => Vỏ chứa
			showlist = 3 => Tổ chức hoạt động như phòng
		*/
			if(showlist != '2'){
				if(showlist == 1 || showlist == 3 || showlist == 0){
					refresh();
				}else{
	 				data.inst.toggle_node(data.rslt.obj);
	 			}
			}else data.inst.toggle_node(data.rslt.obj);
		 });
});
</script>