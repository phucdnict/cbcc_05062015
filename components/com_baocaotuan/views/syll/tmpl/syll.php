<?php
/**
 * Author: Phucnh
 * Date created: Apr 25, 2015
 * Company: DNICT
 */
defined ( '_JEXEC' ) or die ( 'Truy cập không hợp lệ' );
?>
<div id="tab_danhsach">
	ID hồ sơ: <input id="idHoso" name="idHoso" />
	<div class="btn-group">
			<button class="btn btn-success btn-small dropdown-toggle"data-toggle="dropdown">
				Xuất SYLL<span class="caret"></span>
			</button>
			<ul class="dropdown-menu dropdown-success dropdown-menu-right">
				<li><a href="#" id="btn_export_syll_2c">2c Viên chức</a></li>
			</ul>
		</div>
</div>
<div id="div_xemchitiet"></div>
<script type="text/javascript">
var idHoso;
jQuery(document).ready(function($){
	$('#btn_export_syll_2c').on('click', function(){
		idHoso = $('#idHoso').val();
		url= '<?php echo JUri::base(true);?>/index.php?option=com_baocaotuan&view=syll&format=raw&task=word_syll_vc2c&idHoso='+idHoso;
  		document.location.assign(url);
		return false;
	});
});
</script>