<?php 
// 	require_once (JPATH_LIBRARIES.'/cbcc/Core.php');
	$user			=	JFactory::getUser();
?>
<div id="info_container"></div>
<div id="tabs" class="tabbable" style="width: 100%;">
    <ul class="nav nav-tabs" id="myTab">
    	<?php
//         	if (core::_checkPerAction($user->id, 'com_baocaothongke', 'congchucpx', 'display','site')) {
		?>
        <li>	
        	<a data-toggle="tab" href="#tab_baocaothongkepx"  data-tab-url="<?php echo JUri::root(true);?>/index.php?option=com_baocaothongke&controller=thongkecanbocongchucpx&task=default&format=raw">
            Chất lượng công chức phường, xã</a>
        </li>
		 <?php
// 		 	};
?>
    </ul>
    
    <div class="tab-content">
	    <div class="tab-pane" id="tab_baocaothongkepx"></div>
	    <input type="hidden" value="0" id="isOpenBaocaocc">
	    <div class="tab-pane" id="tab_baocaocbpx"></div>
	    <input type="hidden" value="0" id="isOpenBaocaocbpx">
	    <div class="tab-pane" id="tab_baocaokctpx" ></div>
	    <input type="hidden" value="0" id="isOpenBaocaokctpx">
	</div>
</div>
<script type="text/javascript">
var tableToExcel = (function () {
    var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function (s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function (s, c) { return s.replace(/{(\w+)}/g, function (m, p) { return c[p]; }) }
    return function (table, name, filename) {
        if (!table.nodeType) table = document.getElementById(table)
        var ctx = { worksheet: name || 'Worksheet', table: table.innerHTML }
        document.getElementById("dlink").href = uri + base64(format(template, ctx));
        document.getElementById("dlink").download = filename;
        document.getElementById("dlink").click();
    }
})()
jQuery(document).ready(function($){
	if(! $('a[data-toggle="tab"]').parent().hasClass('active')){
		$('#myTab a:first').tab('show');
	}
});
</script>




