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
<div class="span3">
	<fieldset>
	<legend>
				<span class="pull-right inline">
				<a id="btnReset" class="btn btn-small btn-info" href="index.php?option=com_tochuc&controller=goichucvu&task=rebuild">
					<i class="icon-refresh"></i> Thiết lập lại
				</a>
				<button id="btnThemmoi" class="btn btn-small btn-success"><i class="icon-plus"></i> Thêm mới</button>						
			</span>	
	</legend>
	<div id="tochuc-goichucvu-tree"></div>
	</fieldset>
</div>
<div class="span9">
<div id="form-content" class="row-fluid"></div>
</div>
</div>
<script type="text/javascript">
var DataSourceTree = function(options) {
	this._data 	= options.data;
	this._delay = options.delay;
}
DataSourceTree.prototype.data = function(options, callback) {
	var self = this;
	var $data = null;

	if(!("name" in options) && !("type" in options)){
		$data = this._data;//the root tree
		callback({ data: $data });
		return;
	}
	else if("type" in options && options.type == "folder") {
		if("additionalParameters" in options && "children" in options.additionalParameters)
			$data = options.additionalParameters.children;
		else $data = {}//no data
	}
	
	if($data != null)//this setTimeout is only for mimicking some random delay
		setTimeout(function(){callback({ data: $data });} , parseInt(Math.random() * 500) + 200);
	//if($data != null) callback({ data: $data });
};
jQuery(document).ready(function($){
	  jQuery.validator.setDefaults({
		    errorPlacement: function(error, element) {
		      // if the input has a prepend or append element, put the validation msg after the parent div
		      if(element.parent().hasClass('input-prepend') || element.parent().hasClass('input-append')) {
		        error.insertAfter(element.parent());		
		      // else just place the validation message immediatly after the input
		      } else {
		        error.insertAfter(element);
		      }
		    },
		    errorElement: "small", // contain the error msg in a small tag
		    wrapper: "div", // wrap the error message and small tag in a div
		    highlight: function(element) {
		      $(element).closest('.control-group').addClass('error'); // add the Bootstrap error class to the control group
		    },
		    success: function(element) {
		      $(element).closest('.control-group').removeClass('error'); // remove the Boostrap error class from the control group
		    }
		  });
	var _initPage = function(){
		$('#btnXoa').hide();	
	};
	var _initEditPage = function(id){
		$.get('index.php?option=com_tochuc&controller=goichucvu&task=edit&format=raw',{"id":id},function(response){
			$('#form-content').html(response);
		});
	};
	var _initNewPage = function(parent_id){
		$.get('index.php?option=com_tochuc&controller=goichucvu&task=edit&format=raw',{"parent_id":parent_id},function(response){
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
				window.location.href='index.php?option=com_tochuc&controller=goichucvu&task=delete&id='+node_id;
			}
		}
	});
	$('#btnThemmoi').click(function(){
		var node_id = $('#tochuc-goichucvu-tree').jstree('get_selected').attr('id');
		if(typeof node_id == 'undefined'){			
			node_id = 0;
		}else{
			node_id = node_id.replace("node_", "");
		}
		_initNewPage(node_id);
	});
	
	 $('#tochuc-goichucvu-tree').jstree({
		 	"plugins": ["themes", "json_data","crrm", "ui","types","dnd","cookies"],
	  		"json_data":{
					"ajax" : {
						// the URL to fetch the data
						"url" : "<?php echo JUri::root(true);?>/api.php?&task=tree&act=GOICHUCVU",	
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
		// data.inst.select_node("#node_11", true);
		 var id = data.rslt.obj.attr("id").replace("node_","");
		 //console.log(data.rslt.obj.attr("id").replace("node_",""));
		 _initEditPage(id);
	}).bind("move_node.jstree", function (e, data) {
		data.rslt.o.each(function (i) {
			$.ajax({
				async : false,
				type: 'POST',
				url: "index.php?option=com_tochuc&controller=goichucvu",
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