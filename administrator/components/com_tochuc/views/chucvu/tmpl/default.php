<?php
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
<div class="span6">
	<h3>Tổ chức chức vụ</h3>
	<div id="tochuc-chucvu-tree"></div>
</div>
<div class="span6">
<h3 class="row-fluid smaller lighter">
	<span class="span7">Chức vụ tổ chức</span>
	<span class="span5">
		<span class="pull-right inline">
			<button id="btnThemmoi" class="btn btn-success"><i class="icon-plus"></i> Thêm mới</button>
			<button id="btnXoa" class="btn btn-danger"><i class="icon-trash"></i> Xóa</button>
		</span>																						
	</span>
</h3>
<hr>
<div id="form-content"></div>
</div>
</div>
<script type="text/javascript">
jQuery(document).ready(function($){
	var _initPage = function(){
		$('#btnXoa').hide();	
	};
	var _initEditPage = function(id){
		$.get('index.php?option=com_tochuc&controller=chucvu&task=edit&format=raw',{"id":id},function(response){
			$('#form-content').html(response);
		});
	};
	var _initNewPage = function(parent_id){
		$.get('index.php?option=com_tochuc&controller=chucvu&task=edit&format=raw',{"parent_id":parent_id},function(response){
			$('#form-content').html(response);
		});
	};
	$('#btnXoa').click(function(){
		var node_id = $('#tochuc-goichucvu-tree').jstree('get_selected').attr('id');		
		if(typeof node_id == 'undefined'){
			alert('Bạn chưa chọn dữ liệu đễ xóa');
		}else{
			node_id = node_id.replace("node_", "");
			if(confirm('Bạn có muốn xóa '+ $('#tochuc-goichucvu-tree').jstree('get_selected').text()+' ?')){
				window.location.href='index.php?option=com_tochuc&controller=chucvu&task=delete&id='+node_id;
			}
		}
		
	});
	$('#btnThemmoi').click(function(){
		var node_id = $('#tochuc-chucvu-tree').jstree('get_selected').attr('id');
		if(typeof node_id == 'undefined'){			
			node_id = 0;
		}else{
			node_id = node_id.replace("node_", "");
		}
		_initNewPage(node_id);
		
	});
	 $('#tochuc-chucvu-tree').jstree({
		 	"plugins": ["themes", "json_data","crrm", "ui","types","dnd","cookies"],
	  		"json_data":{
					"ajax" : {
						// the URL to fetch the data
						"url" : "<?php echo JUri::root(true);?>/api.php?&task=tree&act=CHUCVUTOCHUC",	
						"data" : function(n) {
							return {
								"id" : n.attr ? n.attr("id").replace("node_", "") : 0
							};
						}
					}
				}      
	}).bind("open_node.jstree", function (e, data) {		
		 //data.inst.check_node("#node_11", true);		 
	}).bind("loaded.jstree", function (event, data) {
		 //data.inst.check_node("#node_11", true);
    }).bind("select_node.jstree", function (event, data) {
    	$('#btnXoa').show();
		// data.inst.select_node("#node_11", true);
		 var id = data.rslt.obj.attr("id").replace("node_","");
		 //console.log(data.rslt.obj.attr("id").replace("node_",""));
		 _initEditPage(id);
	}).bind("move_node.jstree", function (e, data) {
		data.rslt.o.each(function (i) {
			$.ajax({
				async : false,
				type: 'POST',
				url: "index.php?option=com_tochuc&controller=chucvu",
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
	});
    
	 _initPage();
// 		jQuery('#parent_id').chosen({
// 	 		disable_search_threshold : 10,
// 	 		allow_single_deselect : true
// 	 	}); 		
}); // end document.ready
</script>