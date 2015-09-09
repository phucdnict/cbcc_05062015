<?php
/**
 * Author: Phucnh
 * Date created: Mar 19, 2015
 * Company: DNICT
 */ 
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
<div class="row-fluid" id="com_thonto_viewdetail"></div>
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"  style="width: 450px; left: 60%; display: block;">
		<div id="div_modal">
		</div>
</div>
<script type="text/javascript">
var id;
var showlist;
var ins_cap;
jQuery(document).ready(function($){
	var _initViewDetailPage = function(id){
		jQuery.ajax({
			  type: "GET",
			  url: 'index.php?option=com_thonto&controller=chibo&task=detail&format=raw',
			  data:{"id":id},
			  beforeSend: function(){
				  $.blockUI();
				  $('#com_thonto_viewdetail').empty();				  
				},
			  success: function (data,textStatus,jqXHR){
				  $('#com_thonto_viewdetail').html(data);
			  }
		});	
	};
	createTreeviewInMenuBar('Cây đơn vị');
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
		     "option" : "com_thonto",                            
		     "view" : "treeview",
		     "task" : "treeViewTochuc",
		     "format" : "raw",                            
		     "id" : n.attr ? n.attr("id").replace("node_","") : <?php echo $this->root_info['root_id'];?>
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
			 id = data.rslt.obj.attr("id").replace("node_","");
			ins_cap = data.rslt.obj.attr("ins_cap");
			if (ins_cap == 12 || ins_cap ==13){
			 	_initViewDetailPage(id);
			}
			data.inst.toggle_node(data.rslt.obj);
		 });
	$('body').delegate('.btn_edit_chibo','click', function(){
		var idchibo = $(this).attr('idchibo');
			$.blockUI();
			$('#div_modal').load('/index.php?option=com_thonto&view=chibo&format=raw&task=frmchibo&chibo_id='+idchibo,function(){
				$.unblockUI();
			});
	});
	
});
</script>