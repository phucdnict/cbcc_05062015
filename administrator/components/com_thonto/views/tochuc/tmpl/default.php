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
<div class="row-fluid">
<div class="span6">
<h3 class="row-fluid smaller lighter">
	<span class="span7">Cây đơn vị</span>
	<span class="span5">
		<span class="pull-right inline">
			<a id="btnReset" class="btn btn-small btn-success" href="index.php?option=com_thonto&controller=tochuc&task=rebuild"><i class="icon-plus"></i> Reset</a>
			<a href="#" onclick="appAdminTochuc.orderUp()" class="btn btn-small">Up</a>
			<a href="#" onclick="appAdminTochuc.orderDown()" class="btn btn-small">Down</a>						
		</span>																						
	</span>
</h3>
	<div id="tochuc-goichucvu-tree"></div>
</div>
<div class="span6">
<div id="form-content" class="row-fluid"></div>
</div>
</div>
</div>
</div>
<script type="text/javascript">
var appAdminTochuc = {
	orderUp:function(){				
		var id =  jQuery('#tochuc-goichucvu-tree').jstree('get_selected').attr('id').replace("node_","");
		var url='index.php?option=com_thonto&controller=tochuc&task=orderup';
		jQuery.post(url,{id:id},function(data){
			jQuery('#tochuc-goichucvu-tree').jstree("refresh");
		});		
		//console.log(id);
		return false;
	},
	orderDown:function(){
		//console.log('aa');		
		var id =  jQuery('#tochuc-goichucvu-tree').jstree('get_selected').attr('id').replace("node_","");
		var url='index.php?option=com_thonto&controller=tochuc&task=orderdown';
		jQuery.post(url,{id:id},function(data){
			jQuery('#tochuc-goichucvu-tree').jstree("refresh");
		});		
		//console.log(id);
		return false;
	}
}
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
		$.get('index.php?option=com_thonto&controller=tochuc&task=edit&format=raw',{"id":id},function(response){
			$('#form-content').html(response);
		});
	};
	var _initNewPage = function(parent_id){
		$.get('index.php?option=com_thonto&controller=tochuc&task=edit&format=raw',{"parent_id":parent_id},function(response){
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
				window.location.href='index.php?option=com_thonto&controller=tochuc&task=delete&id='+node_id;
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
		  			   "url" : "<?php echo JURI::root(true);?>/index.php",
		  			   "data" : function (n) {
		  			    return {
		  			     "option" : "com_thonto",                            
		  			     "view" : "treeview",
		  			     "task" : "treeThonto",
		  			     "format" : "raw",                            
		  			     "id" : n.attr ? n.attr("id").replace("node_","") : 1
		  			    };
		  			   }
		  			  }
				}      
	}).bind("open_node.jstree", function (e, data) {		
	}).bind("loaded.jstree", function (event, data) {
    }).bind("select_node.jstree", function (event, data) {    
		 var id = data.rslt.obj.attr("id").replace("node_","");
	}).bind("move_node.jstree", function (e, data) {
		data.rslt.o.each(function (i) {
			$.ajax({
				async : false,
				type: 'POST',
				url: "index.php?option=com_thonto&controller=tochuc",
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
				}
			});
		});
	});
	 _initPage();
}); // end document.ready
</script>