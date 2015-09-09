<?php
defined('_JEXEC') or die('Restricted access');
?>
<div class="row-fluid">
	<ul class="nav nav-pills">
		<li class="dropdown"><a class="dropdown-toggle" id="drop4"
			role="button" data-toggle="dropdown" href="#">Thành lập <b
				class="caret"></b></a>
			<ul id="menu1" class="dropdown-menu" role="menu"
				aria-labelledby="drop4">
				<li role="presentation"><a role="menuitem" tabindex="-1"
					href="index.php?option=com_tochuc&task=thanhlap">Tổ chức</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1"
					href="index.php?option=com_tochuc&task=thanhlapphong">Phòng</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something
						else here</a></li>
				<li role="presentation" class="divider"></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated
						link</a></li>
			</ul></li>
		<li><a href="#">Regular link</a></li>
	</ul>
</div>
<div id="com_tochuc_tree"></div>
<table id="sample-table-1"
	class="table table-striped table-bordered table-hover">
	<thead>
		<tr>			
			<th>ID</th>
			<th>NAME</th>
		</tr>
	</thead>
</table>

<script type="text/javascript">
jQuery(document).ready(function($){	
	 $('#com_tochuc_tree').jstree({
	  		"json_data":{
					"ajax" : {
						// the URL to fetch the data
						"url" : "api.php?task=tree&act=tochuc",	
						"data" : function(n) {
							return {
								"id" : n.attr ? n.attr("id").replace("node_", "") : 0
							};
						}
					}
				},
				// Configuring the search plugin
				"search" : {
					// As this has been a common question - async search
					// Same as above - the `ajax` config option is actually jQuery's AJAX object
					"ajax" : {
						"url" : "api.php?task=tree&act=SEARCHTOCHUC",
						// You get the search string as a parameter
						"data" : function (str) {
							return {
								"search_str" : str 
							}; 
						}
					}
				},
	   		"types" : {
				"valid_children" : [ "root" ],
				"types" : {
					"file" : {
						"icon" : { 
							"image" : "/media/cbcc/js/jstree/file.png" 
						}            					
					},
					"folder" : {
						"icon" : { 
							"image" : "/media/cbcc/js/jstree/folder.png" 
						}            					
					},
					"default" : {
						"valid_children" : [ "default" ]
					}
				}
			},
	         "plugins": ["themes", "json_data", "ui","types"] 
	}).bind("open_node.jstree", function (e, data) {		
		 //data.inst.check_node("#node_11", true);		 
	}).bind("loaded.jstree", function (event, data) {
		 //data.inst.check_node("#node_11", true);
  });
	
	$('#sample-table-1').dataTable( {
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "index.php?option=com_tochuc&controller=tochuc&task=list&format=raw",
		"fnServerData": function( sUrl, aoData, fnCallback, oSettings ) {
			oSettings.jqXHR = $.ajax( {
				"url": sUrl,
				"data": aoData,
				"success": fnCallback,
				"dataType": "jsonp",
				"cache": false
			} );
		}
	} );
// 	$('#sample-table-1').dataTable( {
// 		"bProcessing": true,
// 		"bServerSide": true,
// 		"sAjaxSource": "index.php?option=com_tochuc&controller=tochuc&task=list&format=raw"
// 	} );	
});
</script>