<?php
/**
 * Author: Phucnh
 * Date created: Mar 19, 2015
 * Company: DNICT
 */ 
$idUser = JFactory::getUser()->id;
?>
<ul class="nav nav-tabs" role="tablist" id="tabs_bcdaotao">
        	<li> 
            	<a data-toggle="tab" href="#phuluc1"  data-tab-url="/index.php?option=com_thonto&controller=thongke&task=default_phuluc1&format=raw">
            				Số lượng, chất lượng tổ trưởng
            	</a>
        	</li>
        	<li> 
            	<a data-toggle="tab" href="#phuluc3"  data-tab-url="/index.php?option=com_thonto&controller=thongke&task=_default_phuluc3&format=raw">
            				Số lượng, chất lượng phụ trách
            	</a>
        	</li>
        	<li> 
            	<a data-toggle="tab" href="#phuluc4" data-tab-url="/index.php?option=com_thonto&controller=thongke&task=_default_phuluc4&format=raw" >
            				Số lượng không chuyên trách
            	</a>
        	</li>
        	<li> 
            	<a data-toggle="tab" href="#phuluc5" data-tab-url="/index.php?option=com_thonto&controller=thongke&task=_default_phuluc5&format=raw" >
            				Tình hình hoạt động
            	</a>
        	</li>
        	<li> 
            	<a data-toggle="tab" href="#phuluc6" data-tab-url="/index.php?option=com_thonto&controller=thongke&task=_default_phuluc6&format=raw" >
            				Tình hình quản lý
            	</a>
        	</li>
</ul>
<!-- Tab panes -->
<div class="tab-content">
	<div class="tab-pane" id="phuluc1"></div>
	<div class="tab-pane" id="phuluc3"></div>
	<div class="tab-pane" id="phuluc4"></div>
	<div class="tab-pane" id="phuluc5"></div>
	<div class="tab-pane" id="phuluc6"></div>
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
	$(document).ajaxStart(function() {
        $.blockUI();
    });

	$(document).ajaxStop(function() {
	    $.unblockUI();
	});
	if(! $('a[data-toggle="tab"]').parent().hasClass('active')){
		$('#tabs_bcdaotao a:first').tab('show');
	}
});
</script>