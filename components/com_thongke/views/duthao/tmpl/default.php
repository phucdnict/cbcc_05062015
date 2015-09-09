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
		<div class="btn-group">
			<button class="btn btn-success btn-small dropdown-toggle"data-toggle="dropdown">
				Xuất Dự thảo<span class="caret"></span>
			</button>
			<ul class="dropdown-menu dropdown-success dropdown-menu-right">
				<li><a href="#" id="btn_export_duthao_nltx">Nâng lương thường xuyên</a></li>
				<li><a href="#" id="btn_export_duthao_nlthh">Nâng lương trước thời hạn</a></li>
				<li><a href="#" id="btn_export_duthao_bnvnvc">Bổ nhiệm vào ngạch viên chức</a></li>
				<li><a href="#" id="btn_export_duthao_dd">Điều động</a></li>
				<li><a href="#" id="btn_export_duthao_bn">Bổ nhiệm</a></li>
				<li><a href="#" id="btn_export_duthao_cxnl">Chuyển xếp ngạch lương</a></li>
				<li><a href="#" id="btn_export_duthao_dttn">Đào tạo trong nước</a></li>
				<li><a href="#" id="btn_export_duthao_ctnn">Công tác nước ngoài</a></li>
				<li><a href="#" id="btn_export_duthao_gqtv">Thôi việc</a></li>
				<li><a href="#" id="btn_export_duthao_kt">Khen thưởng</a></li>
				<li><a href="#" id="btn_export_duthao_kl">Kỷ luật</a></li>
			</ul>
		</div>
</div>
<div id="div_xemchitiet"></div>
<script type="text/javascript">
var idHoso;
jQuery(document).ready(function($){
	$('#btn_export_duthao_nltx').on('click', function(){
		idHoso = $('#idHoso').val();
		url= '<?php echo JUri::base(true);?>/index.php?option=com_thongke&view=duthao&format=raw&task=word_duthao_nltx&idHoso='+idHoso;
  		document.location.assign(url);
		return false;
	});
	$('#btn_export_duthao_nlthh').on('click', function(){
		idHoso = $('#idHoso').val();
		url= '<?php echo JUri::base(true);?>/index.php?option=com_thongke&view=duthao&format=raw&task=word_duthao_nltth&idHoso='+idHoso;
  		document.location.assign(url);
		return false;
	});
	$('#btn_export_duthao_bnvnvc').on('click', function(){
		idHoso = $('#idHoso').val();
		url= '<?php echo JUri::base(true);?>/index.php?option=com_thongke&view=duthao&format=raw&task=word_duthao_bnvnvc&idHoso='+idHoso;
  		document.location.assign(url);
		return false;
	});
	$('#btn_export_duthao_dd').on('click', function(){
		idHoso = $('#idHoso').val();
		url= '<?php echo JUri::base(true);?>/index.php?option=com_thongke&view=duthao&format=raw&task=word_duthao_dd&idHoso='+idHoso;
  		document.location.assign(url);
		return false;
	});
	$('#btn_export_duthao_bn').on('click', function(){
		idHoso = $('#idHoso').val();
		url= '<?php echo JUri::base(true);?>/index.php?option=com_thongke&view=duthao&format=raw&task=word_duthao_bn&idHoso='+idHoso;
  		document.location.assign(url);
		return false;
	});
	$('#btn_export_duthao_cxnl').on('click', function(){
		idHoso = $('#idHoso').val();
		url= '<?php echo JUri::base(true);?>/index.php?option=com_thongke&view=duthao&format=raw&task=word_duthao_cxnl&idHoso='+idHoso;
  		document.location.assign(url);
		return false;
	});
	$('#btn_export_duthao_dttn').on('click', function(){
		idHoso = $('#idHoso').val();
		url= '<?php echo JUri::base(true);?>/index.php?option=com_thongke&view=duthao&format=raw&task=word_duthao_dttn&idHoso='+idHoso;
  		document.location.assign(url);
		return false;
	});
	$('#btn_export_duthao_ctnn').on('click', function(){
		idHoso = $('#idHoso').val();
		url= '<?php echo JUri::base(true);?>/index.php?option=com_thongke&view=duthao&format=raw&task=word_duthao_ctnn&idHoso='+idHoso;
  		document.location.assign(url);
		return false;
	});
	$('#btn_export_duthao_gqtv').on('click', function(){
		idHoso = $('#idHoso').val();
		url= '<?php echo JUri::base(true);?>/index.php?option=com_thongke&view=duthao&format=raw&task=word_duthao_gqtv&idHoso='+idHoso;
  		document.location.assign(url);
		return false;
	});
	$('#btn_export_duthao_kt').on('click', function(){
		idHoso = $('#idHoso').val();
		url= '<?php echo JUri::base(true);?>/index.php?option=com_thongke&view=duthao&format=raw&task=word_duthao_kt&idHoso='+idHoso;
  		document.location.assign(url);
		return false;
	});
	$('#btn_export_duthao_kl').on('click', function(){
		idHoso = $('#idHoso').val();
		url= '<?php echo JUri::base(true);?>/index.php?option=com_thongke&view=duthao&format=raw&task=word_duthao_kl&idHoso='+idHoso;
  		document.location.assign(url);
		return false;
	});
});
</script>
