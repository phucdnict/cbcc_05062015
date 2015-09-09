<?php
/**
 * Author: Phucnh
 * Date created: Mar 19, 2015
 * Company: DNICT
 */ 
$user   = JFactory::getUser();
$dot = $_REQUEST['dot']==null?0:$_REQUEST['dot']	;
?>
<style>
#main-content-tree{
 height: 280px;
 overflow: auto;
}
</style>
<h3 class="row-fluid header smaller lighter blue">
	Tình hình quản lý <small><span id='tentochuc'></span> </small>
	<span class="pull-right inline">
		<?php echo ThontoHelper::selectBox_notdefautl($dot,array('name'=>'dot'),'thonto_dotbaocao', array('id', 'tendot'),'trangthai=1', 'nam desc');?>
	</span>
</h3>
<div class="row-fluid" id="com_thonto_viewdetail"></div>
<script type="text/javascript">
var id;
var showlist;
var px_id;
var dot;
var _initViewDetailPage = function(id){
	dot = jQuery('#dot option:selected').val();
	jQuery.ajax({
		  type: "GET",
		  url: 'index.php?option=com_thonto&controller=tinhhinhquanly&task=frmtinhhinhquanly&format=raw&thonto_id='+id+'&dot='+dot,
		  beforeSend: function(){
			  jQuery.blockUI();
			  jQuery('#com_thonto_viewdetail').empty();				  
			},
		  success: function (data,textStatus,jqXHR){
			  jQuery('#com_thonto_viewdetail').html(data);
			  jQuery('#tendonvi').val(jQuery('.jstree-clicked').text());
			  jQuery('#thonto_id').val(id);
			  jQuery('#dotbaocao_id').val(jQuery('#dot option:checked').val());
			  jQuery.unblockUI();
		  }
	});	
};
jQuery(document).ready(function($){
	$('#dot').on('change', function(){
		_initViewDetailPage(id); 
	});
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
		     "task" : "treePhuongxa",
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
			 showlist = data.rslt.obj.attr("showlist");
			 px_id = data.rslt.obj.attr("px_id");
			 $('#tentochuc').html('<i class="icon-double-angle-right"></i>'+$('.jstree-clicked').text());
// 			 1	Vỏ chứa
// 			 2	Quận huyện
// 			 3	Phường xã
// 			 4	Tổ dân phố
// 			 5	Thôn
			if (showlist == 3){
			 	_initViewDetailPage(id);
			}
			data.inst.toggle_node(data.rslt.obj);
		 });
	$('body').delegate('.btn_xoa_noidunghop','click', function(){
		$(this).closest('tr').remove();
	});
});
</script>