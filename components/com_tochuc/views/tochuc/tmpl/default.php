<?php
defined('_JEXEC') or die('Restricted access');
//$editor =& JEditor::getInstance();
$user = JFactory::getUser();
//var_dump(TochucHelper::getOneNodeJsTree((int) Core::getManageUnit($user->id)));exit;
?>
<style>
#main-content-tree{
	height: 280px;
	/*width:180px;*/	
	/*-height: 200px;*/
	overflow: auto;
}
</style>
<h3 class="row-fluid header smaller lighter blue">
	<span class="span6" id="tochuc_current">Quản lý tổ chức <small><i class="icon-double-angle-right"></i> </small></span>
	<span class="span6">
		<span class="pull-right inline">			
			<?php
			if(Core::_checkPerAction($user->id, 'com_tochuc','tochuc','thanhlap','site',$this->row->id)){
				?>
				<a class="btn btn-small btn-success" href="index.php?option=com_tochuc&controller=tochuc&task=thanhlap&Itemid=<?php echo $this->Itemid;?>">Thêm mới</a>
				<?php 
			} 
			?>
									
		</span>
	</span>
</h3>
<div class="row-fluid" id="com_tochuc_viewdetail"></div>
<script type="text/javascript">
jQuery(document).ready(function($){
// 	$('#main-tree').html('<h4><i class="icon-sitemap"></i> Cây đơn vị</h4><div id="main-content-tree"></div>');
	createTreeviewInMenuBar('Cây đơn vị');
	var dept_id = null;
	var _initViewDetailPage = function(id){
		var htmlLoading = '<i class="icon-spinner icon-spin blue bigger-125"></i>';
		jQuery.ajax({
			  type: "GET",
			  url: 'index.php?option=com_tochuc&controller=tochuc&task=detail&format=raw&Itemid=<?php echo $this->Itemid;?>',
			  data:{"id":id},
			  beforeSend: function(){
				  $.blockUI();
				  $('#com_tochuc_viewdetail').empty();				  
				},
			  success: function (data,textStatus,jqXHR){
				  $.unblockUI();
				  $('#com_tochuc_viewdetail').html(data);
			  }
		});	
	};
	var com_jstree = $('#main-content-tree').jstree({
	  		"json_data":{		  		
		  			"data":<?php echo TochucHelper::getOneNodeJsTree((int) Core::getManageUnit($user->id, 'com_tochuc', 'tochuc', 'default'));?>,				  			
					"ajax" : {
						// the URL to fetch the data
						"url" : "api.php?task=tree&act=tochuc",	
						"data" : function(n) {
							return {
								"id" : n.attr ? n.attr("id").replace("node_", "") : <?php echo (int) Core::getManageUnit($user->id, 'com_tochuc', 'tochuc', 'default');?>
							};
						}
					}
				},
				// Configuring the search plugin
				"search" : {
					// As this has been a common question - async search
					// Same as above - the `ajax` config option is actually jQuery's AJAX object
					"ajax" : {
						"url" : "api.php?task=tree&act=SEARCHTOCHUC",
						// You get the search string as a parameter
						"data" : function (str) {
							return {
								"search_str" : str 
							}; 
						}
					}
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
			},
	         "plugins": ["themes", "json_data", "ui","types","cookies"] 
	}).bind("open_node.jstree", function (e, data) {		
		 //data.inst.check_node("#node_11", true);		 
	}).bind("loaded.jstree", function (event, data) {
		 //data.inst.check_node("#node_11", true);
  }).bind("select_node.jstree", function (event, data) {
		 //data.inst.check_node("#node_11", true);		 
		 var id = data.rslt.obj.attr("id").replace("node_","");
		 _initViewDetailPage(id);
		 dept_id = id;		
			  // data.inst is the tree object, and data.rslt.obj is the node
		data.inst.toggle_node(data.rslt.obj);
		$('#tochuc_current').html('Quản lý tổ chức <small><i class="icon-double-angle-right"></i> '+$.trim(data.rslt.obj.children('a').text())+'</small>');		
  });	
});
</script>