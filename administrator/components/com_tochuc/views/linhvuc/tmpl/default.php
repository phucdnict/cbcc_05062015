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
<legend>Lĩnh vực
			<span class="pull-right inline">
			<a id="btnReset" class="btn btn-info btn-small" href="index.php?option=com_tochuc&controller=linhvuc&task=rebuild"><i class="icon-refresh"></i> Thiết lập lại</a>
			<button id="btnThemmoi" class="btn btn-success btn-small"><i class="icon-plus"></i> Thêm mới</button>		
			</span>	
</legend>
<div>
<?php
$assigned = array();
$assigned 		= Core::loadAssocList('cb_type_linhvuc', array('id','name'),'id IN (1,2,3)');
echo JHTML::_('select.genericlist',$assigned,'root_id','class="form-control required inputbox1" size="1"','id','name', 1);
?>
</div>
<div id="tochuc-cap-tree"></div>
</fieldset>
</div>
<div class="span8 row-fluid" id="form-content">
</div>
</div>
<script type="text/javascript">
jQuery(document).ready(function($){
	var _initPage = function(){
		$('#btnXoa').hide();	
	};
	var _initEditPage = function(id){
		$.get('index.php?option=com_tochuc&controller=linhvuc&task=edit&format=raw',{"id":id},function(response){
			$('#form-content').html(response);
		});
	};
	var _initNewPage = function(parent_id){
		$.get('index.php?option=com_tochuc&controller=linhvuc&task=edit&format=raw',{"parent_id":parent_id},function(response){
			$('#form-content').html(response);
		});
	};
	$('#btnThemmoi').click(function(){
		var node_id = $('#tochuc-cap-tree').jstree('get_selected').attr('id');
		if(typeof node_id == 'undefined'){			
			node_id = 0;
		}else{
			node_id = node_id.replace("node_", "");
		}
		_initNewPage(node_id);
		
	});
	 $('#tochuc-cap-tree').jstree({
		 	"plugins": ["themes", "json_data","crrm", "ui","types","dnd","cookies"],
	  		"json_data":{
					"ajax" : {
						// the URL to fetch the data
						"url" : "<?php echo JUri::root(true);?>/api.php?&task=tree&act=LINHVUC",	
						"data" : function(n) {
							return {
								"id" : n.attr ? n.attr("id").replace("node_", "") : $('select[name="root_id"]').val()
							};
						}
					}
				}
	}).bind("move_node.jstree", function (e, data) {
		data.rslt.o.each(function (i) {
			$.ajax({
				async : false,
				type: 'POST',
				url: "index.php?option=com_tochuc&controller=linhvuc",
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
    	$('#btnXoa').show();
		// data.inst.select_node("#node_11", true);
		 var id = data.rslt.obj.attr("id").replace("node_","");
		 //console.log(data.rslt.obj.attr("id").replace("node_",""));
		 _initEditPage(id);
	});
	$('select[name="root_id"]').change(function(){
		 $('#tochuc-cap-tree').jstree('refresh');	
	});
	 _initPage();
// 		jQuery('#parent_id').chosen({
// 	 		disable_search_threshold : 10,
// 	 		allow_single_deselect : true
// 	 	}); 		
}); // end document.ready
</script>