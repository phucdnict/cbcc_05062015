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
<h3 class="row-fluid header smaller lighter blue">
	<span class="span6" id="thonto_current">Quản lý tổ chức<small><i class="icon-double-angle-right"></i> </small></span>
	<span class="span6">
		<span class="pull-right inline">			
				<a class="btn btn-small btn-success" href="index.php?option=com_thonto&controller=tochuc&task=thanhlap">Thêm mới</a>
		</span>
	</span>
</h3>
<div class="row-fluid" id="com_thonto_viewdetail"></div>
<div id='div_soluongkhongchuyentrach'></div>
<script type="text/javascript">
var id;
var donvi_id;
var showlist;
var _initViewDetailPage = function(id){
	jQuery.ajax({
		  type: "GET",
		  url: 'index.php?option=com_thonto&controller=tochuc&task=detail&format=raw',
		  data:{"id":id},
		  beforeSend: function(){
			  jQuery.blockUI();
			  jQuery('#com_thonto_viewdetail').empty();			
			},
		  success: function (data,textStatus,jqXHR){
				jQuery.unblockUI();
				jQuery('#com_thonto_viewdetail').show();
				jQuery('#div_soluongkhongchuyentrach').hide();
				jQuery('#com_thonto_viewdetail').html(data);
		  }
	});	
};
jQuery(document).ready(function($){
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
		     "task" : "treeThonto",
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
			 _initViewDetailPage(id);
			 dept_id = id;		
			data.inst.toggle_node(data.rslt.obj);
		 });
});
</script>