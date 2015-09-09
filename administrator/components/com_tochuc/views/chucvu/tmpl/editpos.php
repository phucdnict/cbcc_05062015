<div class="modal fade" id="myModal">
<form class="form-horizontal" action="index.php?option=com_tochuc&controller=chucvu&task=savepos" method="post" name="frmChucvuAdd" id="frmChucvuAdd">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h3>Thêm chức vụ</h3>
</div>
<div class="modal-body">
<div class="control-group">
<label class="control-label" for="name">Tên chức vụ</label>
<div class="controls">
<input type="hidden" id="idcap" name="idcap" value="<?php echo $this->item->idcap;?>">
<input type="hidden" id="idcap" name="idchucvu" value="<?php echo $this->item->idchucvu;?>">
<input type="text" id="tencap" placeholder="Nhập tên" name="tencap"	value="<?php echo $this->item->tencap;?>">
</div>
</div>
<div class="control-group">
<label class="control-label" for="heso">Hệ số</label>
<div class="controls">
<input type="text" id="heso" name="heso" value="<?php echo $this->item->heso;?>" readonly>
</div>
</div>
<div class="control-group">
<label class="control-label" for="mangach">Mã ngạch</label>
<div class="controls">
	<input type="hidden" id="mangach" name="mangach" value="<?php echo $this->item->mangach;?>">
	<span><?php echo AdminTochucHelper::getNameById($this->item->mangach, 'pos_system')?></span>
	<div id="tochuc-goichucvu-tree"></div>
</div>
</div>
</div>
<div class="modal-footer">
<a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Close</a>
<input type="submit" class="btn btn-primary" value="Lưu" name="btnSubmit">
</div>
<?php echo JHTML::_( 'form.token' ); ?>
</form>  
</div>
<script type="text/javascript">
jQuery(document).ready(function ($){
// 	jQuery('#parent_id').chosen({
// 		disable_search_threshold : 10,
// 		allow_single_deselect : true
// 	});
	$('#myModal').modal('show');
	$('#frmChucvuAdd').validate({
	    rules: {
	      name: {
	   		required: true	        
	      },
	      mangach: {
		   		required: true	        
		  }
	    }
	});
	$('#tochuc-goichucvu-tree').jstree({
	 	"plugins": ["themes", "json_data","ui","types"],
  		"json_data":{
				"ajax" : {
					// the URL to fetch the data
					"url" : <?php echo JUri::root(true);?>"/api.php?&task=tree&act=GOICHUCVU",	
					"data" : function(n) {
						return {
							"id" : n.attr ? n.attr("id").replace("node_", "") : 0
						};
					}
				}
			},
 "types" : {
		// the default type
		"default" : {
			"max_children"	: -1,
			"max_depth"		: -1,
			"valid_children": "all"
		},
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
			      
}).bind("open_node.jstree", function (e, data) {
	//console.log( $('#frmChucvuAdd #mangach').val());		
	 data.inst.select_node("#node_"+$('#frmChucvuAdd #mangach').val(), true);
	// console.log($('#frmChucvuAdd #mangach').val());
}).bind("loaded.jstree", function (event, data) {
	data.inst.select_node("#node_"+$('#frmChucvuAdd #mangach').val(), true);
	//console.log($('#frmChucvuAdd #mangach').val());
	 //data.inst.check_node("#node_11", true);
}).bind("select_node.jstree", function (event, data) {
	//$('#btnXoa').show();
	// data.inst.select_node("#node_11", true);
	 var id = data.rslt.obj.attr("coef");
	 //console.log();
	 $('#frmChucvuAdd #heso').val(id);
	 $('#frmChucvuAdd #mangach').val(id);

	 //console.log(data.rslt.obj.attr("id").replace("node_",""));
	// _initEditPage(id);
});
});	
</script>