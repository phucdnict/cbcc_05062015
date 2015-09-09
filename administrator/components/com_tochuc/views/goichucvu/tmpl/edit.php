<?php 
	$model_pl		=	Core::model('Danhmuc/PosLevel');
	$data_poslv		=	$model_pl->selectCb();
	
	$data_poslv_obj	=	json_encode($model_pl->selectObj());
	
	$assigned = array();
	$assigned[]		= array('id'=>'','position'=>'-- Chọn cấp bổ nhiệm -- ');
	$assigned 		= array_merge($assigned, $data_poslv);
?>

<style>
ins.jstree-checkbox {
    display:none;
}
li[class~="jstree-leaf"] > a > ins.jstree-checkbox {
    display: inline-block;
} 

</style>
<form class="form-horizontal" action="index.php?option=com_tochuc&controller=goichucvu&task=saveedit" method="post" name="frmGoichucvu" id="frmGoichucvu">
	<fieldset>
<legend>
Thông tin chi tiết [<small><?php echo (($this->row->id == 0)?'Thêm mới':'Hiệu chỉnh');?></small>]
		<span class="pull-right inline">
			<button type="submit" class="btn btn-primary btn-small"><i class="icon-save"></i> Lưu</button>
			<?php
			if((int)$this->row->id > 0){
				?>
				<a id="btnXoa" href="index.php?option=com_tochuc&controller=goichucvu&task=delete&id=<?php echo $this->row->id; ?>" class="btn btn-danger btn-small"><i class="icon-trash"></i> Xóa</a>
				<?php			
				} 
			?>
			
		</span>	
</legend>

		<div class="control-group">
			<label class="control-label" for="di">ID</label>
			<div class="controls">
				<input type="text" id="id" name="id" value="<?php echo $this->row->id;?>" readonly>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="parent_id">Cha</label>
			<div class="controls">
				<input type="hidden" id="parent_id" name="parent_id" value="<?php echo $this->row->parent_id;?>">
				<span><?php echo  AdminTochucHelper::getNameById( $this->row->parent_id, 'cb_goichucvu','name'); ?></span>
		
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="name">Tên</label>
			<div class="controls">
				<input type="text" id="name" placeholder="Nhập tên" name="name"	value="<?php echo $this->row->name;?>">
			</div>
		</div>		
		<div class="control-group">
			<label class="control-label" for="ins_level_id">Thứ hạng đơn vị</label>
			<div class="controls">
				<input type="hidden" id="ins_level_id" name="ins_level_id" value="<?php echo $this->row->ins_level_id;?>">
				<div id="ins_level_id_detail"></div>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<label class="checkbox"> 
				<input type="hidden" value="0"	name="status"> 
				<input type="checkbox" value="1" name="status" <?php echo (($this->row->status == 1)?'checked = "checked"':'');?>> Trạng thái
				</label> 
			</div>
		</div>
		<div class="control-group">			
			<table width="100%" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Chức vụ</th>
						<th nowrap="nowrap">Hệ số</th>
						<th nowrap="nowrap">Mức TĐ</th>
<!-- 						<th>Tên mức TĐ</th> -->
						<th colspan="">Tên khác</th>
						<th colspan="1">Thời hạn BN(tháng)</th>
						<th colspan="1">Cấp bổ nhiệm</th>
						<th></th>
					</tr>
				</thead>
				<tbody id="tbody_chucvu">
				<?php
				for ($i = 0; $i < count($this->arrChucvu); $i++) {
					$chucvu = $this->arrChucvu[$i];
					?>
					<tr id="tr_id_<?php echo $this->row->id;?>_<?php echo $chucvu['pos_system_id'];?>" class="chucvu">
						<td><input type="checkbox" checked="checked" name="pos_system[]" value="<?php echo $chucvu['pos_system_id'];?>"></td>
						<td><?php echo $chucvu['pos_name']?></td>
						<td><?php echo $chucvu['coef'];?></td>
						<td><?php echo $chucvu['muctuongduong'];?></td>
						<td><input type="text" value="<?php echo $chucvu['name']?>" name="pos_name[]"></td>
						<td><input type="text" value="<?php echo $chucvu['thoihanbonhiem'];?>" name="thoihanbonhiem[]" style="width:40px;"></td>
						<td><?php echo JHTML::_('select.genericlist',$assigned,'capbonhiem[]','class="form-control required" size="1" style="width:140px;"','id','position',$chucvu['capbonhiem']);?></td>
						<td><span class="btn btn-danger btn-xoa-chucvu icon-trash bigger-200 btn-small" ></span></td>
					</tr>
					<?php 
					
				} 
				?>
				
				</tbody>
			</table>
		</div>		
		<div class="control-group">
			<div>
				<a class="btn collapse-data-btn" data-toggle="collapse" href="#pos_system_detail">Chọn chức vụ</a>
				<span id = "addChucvu" class="btn btn-small btn-success"><i class="icon-plus"></i> Thêm chức vụ</span>
			</div>
			<div id="pos_system_detail" class="collapse">
				<div class="tree" id="tochuc-tree-pos_system"></div>
			</div>
		</div>
	</fieldset>
<?php echo JHTML::_( 'form.token' ); ?> 
</form>
<script type="text/javascript">
jQuery(document).ready(function ($){
	var arr = [];
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
// 		var xhtml='';
// 		var node_id = data.rslt.obj.attr('id').replace('node_','');
//		var tr_id = 'tr_id_<?php //echo $this->row->id;?>//_'+node_id;
// 		xhtml +='<tr id="'+tr_id+'">';
// 		xhtml +='<td><input type="checkbox" checked="checked" name="pos_system[]" value="'+node_id+'"></td>';
// 		xhtml +='<td>'+$.trim(data.rslt.obj.children('a').text())+'</td>';
// 		xhtml +='<td><input type="text" value="" name="pos_name[]"></td>';
// 		xhtml +='</tr>';
		//$('#tbody_chucvu').append(xhtml);		
	}).bind("uncheck_node.jstree", function (event, data) {
// 		var node_id = data.rslt.obj.attr('id').replace('node_','');
//		var tr_id = 'tr_id_<?php //echo $this->row->id;?>//_'+node_id;		
// 		$('#'+tr_id).remove();

	});
	// Thịnh thêm add chức vụ
	$('#addChucvu').click(function(event){
		event.preventDefault();		
        $("#tochuc-tree-pos_system").jstree("get_checked",null,true).each(function () { 
        	var xhtml='';
        	var hs = '';
        	var data_poslv_obj	=	<?php echo $data_poslv_obj?>;
//         	var str = '';
    		var node_id = this.id.replace('node_','');//data.rslt.obj.attr('id').replace('node_','');
    		var node_text = $(this).find('a').text();
    		var tr_id = 'tr_id_<?php echo $this->row->id;?>_'+node_id;
	       	 $.ajax({
	      		  type: "POST",
	      		  url: "<?php echo JURI::base(true);?>/index.php?option=com_tochuc&controller=goichucvu&format=raw&task=coef",
	      		  data: {node_id : node_id},
	      		  success:function(data){
		      		  var capbonhiem = data.capbonhiem;
		      			xhtml +='<tr id="'+tr_id+'" class="chucvu">';
		        		xhtml +='<td><input type="checkbox" checked="checked" name="pos_system[]" value="'+node_id+'"></td>';
		        		xhtml +='<td>'+node_text+'</td>';
		        		xhtml +='<td>'+data.coef+'</td>';
		        		if (data.muctuongduong == null){
		        			xhtml +='<td>'+' '+'</td>';
		        		}else{xhtml +='<td>'+data.muctuongduong+'</td>';}
		        		xhtml +='<td><input type="text" value="" name="pos_name[]"></td>';
		        		xhtml +='<td><input type="text" value="'+data.thoihanbonhiem+'" name="thoihanbonhiem[]" style="width:40px;"></td>';

		        		xhtml += '<td><select id="capbonhiem" name="capbonhiem[]" size="1" style="width:140px;">';
							
					    jQuery.each(data_poslv_obj,function(i,val){
					    	xhtml+= '<option value="' + val.id + '"';
						     if(capbonhiem.indexOf(val.id) > -1 ){ //val.id == thoihan_id
						    	 xhtml += ' selected="selected" ';
						     }
						     xhtml += '>' + val.position + '</option>';
					    });
					    xhtml += '</select></td>';
		        		
// 		        		xhtml +='<td><input type="text" value="" name="capbonhiem[]" style="width:140px;"></td>';
		        		xhtml +='<td><span class="btn btn-danger btn-xoa-chucvu icon-trash bigger-200 btn-small" ></span></td>';
		        		xhtml +='</tr>';
		        		$('#tbody_chucvu').append(xhtml);
	      		  }
	       	 })
    		
        });
	});
	$("body").delegate(".btn-xoa-chucvu", "click", function(event){
       	event.preventDefault();    
           if(confirm('Bạn có chắc muốn xóa chức vụ đang chọn?')){
   			//var el = $(this);
   			$(this).parentsUntil("span", ".chucvu").remove();
   			//console.log($(this).parentsUntil("div").html());
   			//el.parentsUntil('div.row1').remove();
   			return false;
           }else{
               return false;
           }
   	});
	// # end
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