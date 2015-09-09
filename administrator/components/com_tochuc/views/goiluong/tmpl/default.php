<?php
/*
 * @Package Softpin Order Manager
 * Create by : dunghoduy@gmail.com
 */
defined('_JEXEC') or die('Restricted access');
//JHtml::_('formbehavior.chosen');
?>
<?php if (!empty( $this->sidebar)) : ?>
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
<?php else : ?>
	<div id="j-main-container">
<?php endif;?>
<div class="span4">
<fieldset>
<legend>Gói lương
			<span class="pull-right inline">
			<a id="btnReset" class="btn btn-info btn-small" href="index.php?option=com_tochuc&controller=goiluong&task=rebuild"><i class="icon-refresh"></i> Thiết lập lại</a>
			<button id="btnThemmoi" class="btn btn-success btn-small"><i class="icon-plus"></i> Thêm mới</button>			
		</span>	
</legend>

	<div id="tochuc-goiluong-tree"></div>
	</fieldset>
</div>
<div class="span8">
<div id="form-content"></div>
</div>
</div>
<script type="text/javascript">
jQuery(document).ready(function($){
	var _initPage = function(){
		
	};
	var _initEditPage = function(id){
		$.get('index.php?option=com_tochuc&controller=goiluong&task=edit&format=raw',{"id":id},function(response){
			$('#form-content').html(response);
		});
	};
	var _initNewPage = function(parent_id){
		$.get('index.php?option=com_tochuc&controller=goiluong&task=edit&format=raw',{"parent_id":parent_id},function(response){
			$('#form-content').html(response);
		});
	};
	$('#btnThemmoi').click(function(){
		var node_id = $('#tochuc-goiluong-tree').jstree('get_selected').attr('id');
		if(typeof node_id == 'undefined'){			
			node_id = 0;
		}else{
			node_id = node_id.replace("node_", "");
		}
		_initNewPage(node_id);
		
	});
	 $('#tochuc-goiluong-tree').jstree({
		 	"plugins": ["themes", "json_data","crrm", "ui","types","dnd"],
	  		"json_data":{
					"ajax" : {
						// the URL to fetch the data
						"url" : "<?php echo JUri::root(true);?>/api.php?&task=tree&act=GOILUONG",	
						"data" : function(n) {
							return {
								"id" : n.attr ? n.attr("id").replace("node_", "") : 0
							};
						}
					}
				}
	}).bind("move_node.jstree", function (e, data) {
		data.rslt.o.each(function (i) {
			$.ajax({
				async : false,
				type: 'POST',
				url: "index.php?option=com_tochuc&controller=goiluong",
				data : { 
					"task" : "movenode", 
					"id" : $(this).attr("id").replace("node_",""), 
					"ref" : data.rslt.cr === -1 ? 1 : data.rslt.np.attr("id").replace("node_",""), 
					"position" : data.rslt.cp + i,
					"title" : data.rslt.name,
					"copy" : data.rslt.cy ? 1 : 0
				},
				success : function (r) {
					if(!r.status) {
						$.jstree.rollback(data.rlbk);
					}
					else {
						$(data.rslt.oc).attr("id", "node_" + r.id);
						if(data.rslt.cy && $(data.rslt.oc).children("UL").length) {
							data.inst.refresh(data.inst._get_parent(data.rslt.oc));
						}
					}
					//$("#analyze").click();
				}
			});
		});
	}).bind("select_node.jstree", function (event, data) {    	
		// data.inst.select_node("#node_11", true);
		 var id = data.rslt.obj.attr("id").replace("node_","");
		 //console.log(data.rslt.obj.attr("id").replace("node_",""));
		 _initEditPage(id);
	});
	 _initPage();
// 		jQuery('#parent_id').chosen({
// 	 		disable_search_threshold : 10,
// 	 		allow_single_deselect : true
// 	 	}); 		
}); // end document.ready
</script>