<?php
$user = JFactory::getUser();
// echo Core::getManageUnit($user->id);
?>
	<h3 class="row-fluid header smaller lighter blue">
		<span class="span5">Tổ chức 
		<?php
		if ((int)$this->row->id == 0) {
			?>
			<small><i class="icon-double-angle-right"></i> Thành lập mới</small>
			<?php 
		}
		else{
			?>
			<small><i class="icon-double-angle-right"></i> Hiệu chỉnh <?php echo $this->row->name; ?></small>
			<?php 
		} 
		?>
			
		</span> <span class="span7"> <span class="pull-right inline">
				<button id="btnThanhlapSubmitAndNew" type="button" class="btn btn-small btn-primary">
					<i class="icon-save"></i> Lưu và Thêm mới
				</button> 
				<button id="btnThanhlapSubmitAndClose" type="button" class="btn btn-small btn-success">
					<i class="icon-save"></i> Lưu và đóng
				</button> <a class="btn btn-small btn-info"
				href="<?php echo '/index.php?option=com_tochuc&controller=tochuc&task=default&Itemid='.$this->Itemid; ?>">←
					Quay về</a>
		</span>
		</span>
	</h3>
	<div class="row-fluid form-horizontal">
	<div class="control-group span6">
		<label class="control-label" for="parent_id">Cây đơn vị <span class="required">*</span></label>
		<div class="controls">							
		<input type="hidden" value="<?php echo $this->row->parent_id; ?>" name="parent_id_content" id="parent_id_content">							
		<div class="input-append">
		<input type="text" class="input-xlarge" value="<?php echo Core::loadResult('ins_dept', array('name'), array('id = '=>$this->row->parent_id)); ?>" name="parent_name" id="parent_name" readonly="readonly">
		  <a data-target="#tochuc-parent-tree_detail" role="button" class="btn" data-toggle="collapse">...</a>					  
		</div>	
			<div id="tochuc-parent-tree_detail" class="collapse">									
				<div id="tochuc-parent-tree"></div>			
		</div>							
		</div>
	
	</div>
	<div class="control-group span6">
		<label class="control-label" for="type">Loại <span class="required">*</span></label>
		<div class="controls">
		  <?php                
	      echo TochucHelper::selectBox($this->row->type, array('name'=>'type_content'), 'ins_type', array('id','name')); 
	      ?>
			</div>
		</div>
	</div>
<div id="content_form"></div>
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
		$('#tochuc-parent-tree').jstree({
		 	"plugins": ["themes", "json_data","checkbox", "ui","types"],
	  		"json_data":{
	  				"data":<?php echo TochucHelper::getOneNodeJsTree((int) Core::getManageUnit($user->id));?>,
					"ajax" : {
						// the URL to fetch the data
						"url" : "<?php echo JUri::root(true);?>/api.php?&task=tree&act=TOCHUC",	
						"data" : function(n) {
							return {
								"id" : n.attr ? n.attr("id").replace("node_", "") : <?php echo (int) Core::getManageUnit($user->id);?>
							};
						}
					}
				},
			"checkbox":{
				"override_ui":false,
				"two_state":true
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
						},
						"disabled" : { // Defining new type 'disabled'
					          "check_node" : false, 
					          "uncheck_node" : false 
					     },
					     "default" : { // Override default functionality
					          "check_node" : function (node) {
					        	$('#tochuc-parent-tree').jstree('uncheck_all');
					            //$(node).children('ul').children('li').children('a').children('.jstree-checkbox').click();
					            return true;
					          },
					          "uncheck_node" : function (node) {
					            //$(node).children('ul').children('li').children('a').children('.jstree-checkbox').click();
					            return true;
					          }
					      } 
					}
				}
		}).bind("loaded.jstree", function (event, data) {
			var curr_id = $('#parent_id_content').val();
		 	$.jstree._focused().check_node("#node_"+curr_id);
		 	//$('#myModal').modal('hide');
		})
		.bind("select_node.jstree", function (event, data) {
			// selected node object: data.inst.get_json()[0];
           // selected node text: data.inst.get_json()[0].data
	           //console.log(data.inst.get_json()[0]);
			data.inst.toggle_node(data.rslt.obj);
			/*			
	        var parent_id = data.inst.get_json()[0].attr.id;
			if(typeof parent_id != "undefined"){
				parent_id = parent_id.replace("node_","");
				$('#parent_id').val(parent_id);
				$('#parent_name').val(data.inst.get_json()[0].data);				
			}
			*/
		}).bind("check_node.jstree", function(e, data){
			var node_id = data.rslt.obj.attr('id').replace('node_','');		
			$('#parent_id_content').val(node_id);
  		    $('#parent_name').val($.trim(data.rslt.obj.children('a').text()));
			if($('#type_content').val() == '0'){
	  	   		 $('#ins_created').val(node_id);
	 			 $("#ins_created").trigger("chosen:updated");
			}		
		}).bind("uncheck_node.jstree", function (event, data) {
			$('#parent_id_content').val('');
  		    $('#parent_name').val('');
		});
		var buildForm = function(type_id){
			var url = 'index.php?option=com_tochuc&controller=tochuc&task=edittochuc&format=raw';
			var htmlLoading = '<i class="icon-spinner icon-spin blue bigger-125"></i>';
			if(type_id == '1'){
				url='<?php echo JUri::root(true)?>/index.php?option=com_tochuc&controller=tochuc&task=edittochuc&format=raw&type='+type_id;	
			}else if(type_id == '0'){
				url='<?php echo JUri::root(true)?>/index.php?option=com_tochuc&controller=tochuc&task=editphong&format=raw&type='+type_id;	
			}
			else if(type_id == '2'){
				url='<?php echo JUri::root(true)?>/index.php?option=com_tochuc&controller=tochuc&task=editvochua&format=raw&type='+type_id;	
			}
			else{
				url='<?php echo JUri::root(true)?>/index.php?option=com_tochuc&controller=tochuc&task=edittochuc&format=raw&type='+type_id;	
			}
			jQuery.ajax({
				  type: "GET",
				  url: url,
				  data:{"id":<?php echo (int)$this->id;?>},
				  beforeSend: function(){
					  $.blockUI();
					  $('#content_form').empty();
					},
				  success: function (data,textStatus,jqXHR){
					  $.unblockUI();
					  $('#content_form').html(data);
				  }
			});	
		}
		$('#type_content').change(function(event){
			event.preventDefault();
			var that = $(this);
			//console.log(that.val());
			buildForm(that.val());
		});
		buildForm($('#type_content').val());

}); // end document.ready
</script>