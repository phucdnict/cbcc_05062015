<?php
/**
 * Author: Phucnh
 * Date created: Mar 19, 2015
 * Company: DNICT
 */ 
$user   = JFactory::getUser();
?>
<style>
#main-content-tree{
 height: 280px;
 overflow: auto;
}
table.dataTable thead .sorting, 
table.dataTable thead .sorting_asc, 
table.dataTable thead .sorting_desc {
    background : none;
}
</style>
<div>
	<h4 class="header lighter blue">
		Danh sách công chức <i class="icon-double-angle-right"></i><small><span id="tendonvi"></span></small>
	</h4>
</div>
<div id="tab_danhsach" role="tabpanel">
		<!-- Nav tabs -->
		
</div>
<div id="div_xemchitiet"></div>
<script type="text/javascript">
var donvi_id;
var showlist;
var date = function(dateObject) {
    var d = new Date(dateObject);
    var day = d.getDate();
    var month = d.getMonth() + 1;
    var year = d.getFullYear();
    if (day < 10) {
        day = "0" + day;
    }
    if (month < 10) {
        month = "0" + month;
    }
    var date = day + "/" + month + "/" + year;

    return date;
};
var year = function(dateObject) {
    var d = new Date(dateObject);
    var year = d.getFullYear();
    return year;
};
var refresh = function(){
	jQuery.blockUI();
	jQuery('#tab_danhsach').load('index.php?option=com_thongke&view=thongke&format=raw&task=reload', function(){
		jQuery.unblockUI();
	});
}
jQuery(document).ready(function($){
	createTreeviewInMenuBar('Cây đơn vị');
	$('body').delegate('.btn_edit_hoso', 'click', function(){
		idhoso = $(this).attr('idhoso');
		$.blockUI();
		$.ajax({
			type: 'GET',
			url: '<?php echo JURI::base(true);?>/index.php?option=com_hoso&view=hoso&format=raw&task=hoso_detail',
			data: {idHoso : idhoso},
			success: function(data){
				$('#tab_danhsach').hide();
				$('#div_xemchitiet').html(data);
				$.unblockUI();
			}
		});
	});
	$('body').delegate('#btn_back_detail', 'click', function(){
		$('#div_xemchitiet').html('');
		$('#tab_danhsach').show();
	});
	var root_id = <?php echo $this->root_info['root_id'];?>;
	$("#main-content-tree").jstree({
		   "plugins" : ["themes","json_data","types","ui","cookies"],
		   "json_data" : {
			 "data" : [{ "attr" : { "id" : "<?php echo $this->root_info['root_id'];?>", "showlist":"<?php echo $this->root_info['root_showlist'];?>"},
		     "state" : "closed",
		     "data" : {
		       "title" : "<?php echo $this->root_info['root_name'];?>",
		       "attr" : { "href" : "#" }
		      }
		  }],
		  "ajax" : {
		   "url" : "<?php echo JURI::base(true);?>/index.php",
		   "data" : function (n) {
		    return {
		     "option" : "com_thongke",                            
		     "view" : "treeview",
		     "task" : "treeThongke",
		     "format" : "raw",                            
		     "id" : n.attr ? n.attr("id").replace("node_","") : root_id
		    };
		   }
		  }
		  },
		  "checkbox":{
		   "two_state": true,
//		    real_checkboxes: true,
		   "override_ui": false
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
		 }).bind("select_node.jstree", function (e, data) {
			donvi_id = data.rslt.obj.attr("id").replace("node_","");
			showlist = data.rslt.obj.attr('showlist');
			/*
			showlist = 0 => Phòng
			showlist = 1 => Tổ chức
			showlist = 2 => Vỏ chứa
			showlist = 3 => Tổ chức hoạt động như phòng
		*/
			if(showlist != '2'){
				if(showlist == 1 || showlist == 3 || showlist == 0){
					refresh();
				}else{
	 				data.inst.toggle_node(data.rslt.obj);
	 			}
			}else data.inst.toggle_node(data.rslt.obj);
		 });
});
</script>