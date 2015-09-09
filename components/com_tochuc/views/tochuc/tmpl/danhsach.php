<?php
defined('_JEXEC') or die('Restricted access');
?>
<div class="row-fluid">
	<div class="widget-box span4">
		<div class="widget-header header-color-blue">
			<h4 class="lighter smaller">Cây đơn vị</h4>
		</div>
		<div class="widget-body">
			<div class="widget-main padding-8">
				<div id="caydonvi"></div>
			</div>
		</div>
	</div>
	<div class="widget-box span8">
		<div class="widget-header header-color-blue">
			<h4 class="lighter smaller">Thông tin chi tiết</h4>
		</div>
		<div class="widget-body">
			<div class="widget-main padding-8">
				<div id="thongtintochuc"></div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
jQuery(document).ready(function($){
	var root_id = <?php echo $this->nodeRoot['id']; ?>;
	var idTreeSelected = null;
	$("#caydonvi").jstree({
		"plugins" : [
			"themes","json_data","ui","dnd","cookies"
		],
		"json_data" : {
			"ajax" : {
				"url" : Core.rootUrl + "/index.php",
				"data" : function (n) {
					return {
						"option" : "com_tochuc",
						"controller" : "tochuc",
						"view" : "tochuc",
						"task" : "getCaydonvi",
						"format" : "raw",
						"id" : n.attr ? n.attr("id").replace("node_","") : root_id
					};
				}
			}
		},
		"dnd" : {
			"drop_finish" : function () { 
				alert("DROP"); 
			},
			"drag_check" : function (data) {
				return { 
					after : false, 
					before : false, 
					inside : true 
				};
			},
			"drag_finish" : function (data) { 
				alert("DRAG OK"); 
			}
		}
	}).bind("select_node.jstree", function (event, data) {
		var id = data.rslt.obj.attr("id").replace("node_","");
		idTreeSelected = id;
		$('#thongtintochuc').load(Core.rootUrl + '/index.php?option=com_tochuc&task=thongtin&format=raw&id='+id);
	}).bind("move_node.jstree", function (e, data) {			
		data.rslt.o.each(function (i) {
			$.ajax({
				async : false,
				type: 'POST',
				url: Core.rootUrl + "/index.php",
				data : {
					"option" : "com_tochuc",
                    "controller" : "tochuc",
                    "view" : "tochuc",
                    "task" : "moveNode",
                    "format" : "raw",
					"id" : $(this).attr("id").replace("node_",""), 
					"ref" : data.rslt.cr === -1 ? 1 : data.rslt.np.attr("id").replace("node_",""), 
					"position" : data.rslt.cp + i,
					"title" : data.rslt.name,
					"copy" : data.rslt.cy ? 1 : 0
				},
				success : function (r) {				
					if(r.errCode != 0 || typeof r.errCode == 'undefined') {
						$.jstree.rollback(data.rlbk);
						console.log('rollback');
					}
					else {
						$(data.rslt.oc).attr("id", "node_" + r.id);
						if(data.rslt.cy && $(data.rslt.oc).children("UL").length) {
							data.inst.refresh(data.inst._get_parent(data.rslt.oc));
						}
					}						
					$("#caydonvi").jstree("deselect_all");
					$('#thongtintochuc').empty();
				}
			});
		});
	});
});
</script>