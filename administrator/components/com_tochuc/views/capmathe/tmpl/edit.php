<?php
//var_dump($this->row->id);
//JHtml::_('formbehavior.chosen', 'select');
?>
<form class="form-horizontal" action="index.php?option=com_tochuc&controller=capmathe&task=saveedit" method="post" name="frmGoichucvu" id="frmGoichucvu">
<input type="hidden" name="node_id" value="<?php echo $this->node_id; ?>">
<fieldset>
<legend>
Thông tin chi tiết
		<span class="pull-right inline">
			<button type="submit" class="btn btn-primary btn-small"><i class="icon-save"></i> Lưu</button>
		</span>	
</legend>

			<table width="100%" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Chức vụ</th>
						<th>Tên khác</th>
					</tr>
				</thead>
				<tbody id="tbody_chucvu">
				<?php
				for ($i = 0; $i < count($this->arrChucvu); $i++) {
					$chucvu = $this->arrChucvu[$i];
					?>
					<tr id="tr_id_<?php echo $this->row->id;?>_<?php echo $chucvu['pos_system_id'];?>">
						<td><input type="checkbox" checked="checked" name="pos_system[]" value="<?php echo $chucvu['pos_system_id'];?>"></td>
						<td><?php echo $chucvu['pos_name']?></td>
						<td><input type="text" value="<?php echo $chucvu['name']?>" name="pos_name[]"></td>
					</tr>
					<?php 
					
				} 
				?>
				
				</tbody>
			</table>
</fieldset>			
<?php echo JHTML::_( 'form.token' ); ?> 
</form>
<script type="text/javascript">
jQuery(document).ready(function ($){
// 	jQuery('#parent_id').chosen({
// 		disable_search_threshold : 10,
// 		allow_single_deselect : true
// 	});
	$('#frmGoichucvu').validate({
	    rules: {
	      name: {
	   		required: true	        
	      },
	      parent_id: {	        
	        required: true
	      },
	      ins_level_id: {
	    	  required: true
	      }
	    }
	});
	/*
	 $('#tochuc-tree-thuhang').jstree({
		 	"plugins": ["themes", "html_data","ui"]	  		
	}).bind("select_node.jstree", function (event, data) {
            //alert(data.rslt.obj.attr("id"));
     });
	 setTimeout(function () {
		 	$("#tochuc-tree-thuhang").jstree("set_focus"); 
		 	//$.jstree._reference("#c2").open_node("#c2"); 
		 }
	 , 500);
	 //setTimeout(function () { $.jstree._reference("#c1").open_node("#c1"); }, 2500);
	 setTimeout(function () { $.jstree._focused().select_node("#c<?php echo $this->row->thuhang_id;?>"); }, 1000);
	 */
	 $('#tochuc-tree-pos_system').jstree({
		 	"plugins": ["themes", "json_data","ui","types","checkbox"],
	  		"json_data":{
					"data" :<?php echo  json_encode($this->tree_data_pos_system,true); ?>
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
					}
				}
			}
	}).bind("select_node.jstree", function (event, data) {
    	data.inst.toggle_node(data.rslt.obj);
		//$(data.rslt.obj).data('description') 
	}).bind("check_node.jstree", function (event, data) {		
		var xhtml='';
		var node_id = data.rslt.obj.attr('id').replace('node_','');
		var tr_id = 'tr_id_<?php echo $this->row->id;?>_'+node_id;
		xhtml +='<tr id="'+tr_id+'">';
		xhtml +='<td><input type="checkbox" checked="checked" name="pos_system[]" value="'+node_id+'"></td>';
		xhtml +='<td>'+$.trim(data.rslt.obj.children('a').text())+'</td>';
		xhtml +='<td><input type="text" value="" name="pos_name[]"></td>';
		xhtml +='</tr>';
		$('#tbody_chucvu').append(xhtml);		
	}).bind("uncheck_node.jstree", function (event, data) {
		var node_id = data.rslt.obj.attr('id').replace('node_','');
		var tr_id = 'tr_id_<?php echo $this->row->id;?>_'+node_id;		
		//console.log(node_id);
		$('#'+tr_id).remove();

	});
	// check_node 
	 $('#ins_level_id_detail').jstree({
		 	"plugins": ["themes", "json_data","ui","types","checkbox"],
	  		"json_data":{
					"data" :<?php echo  json_encode($this->tree_data_ins_level,true); ?>
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
				        	$('#ins_level_id_detail').jstree('uncheck_all');
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
	}).bind("select_node.jstree", function (event, data) {
		data.inst.toggle_node(data.rslt.obj);
	}).bind("check_node.jstree", function(e, data){
		var node_id = data.rslt.obj.attr('id').replace('node_','');
		$('#ins_level_id').val(node_id);
	}).bind("uncheck_node.jstree", function (event, data) {
		$('#ins_level_id').val('');
	});
		$('#btnXoa').click(function(){
			if(confirm('Bạn có muốn xóa không ?')){
				return true;
			}
			return false;
		});
});
</script>