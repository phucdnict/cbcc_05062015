<?php
/**
 * Author: Phucnh
 * Date created: Mar 19, 2015
 * Company: DNICT
 */ 
$idUser = JFactory::getUser()->id;
?>
<ul class="nav nav-tabs" role="tablist" id="tabs_bcdaotao">
	<?php if (core::_checkPerAction($idUser, 'com_thongke', 'treeview', 'treebcdaotaocc','site')) { ?>
        	<li> 
            	<a data-toggle="tab" href="#bc_daotaoboiduong_congchuc"  data-tab-url="/index.php?option=com_thongke&controller=bcdaotaocc&task=default&format=raw">
            				Báo cáo đào tạo công chức
            	</a>
        	</li>
        	<?php }?>
        	<?php if (core::_checkPerAction($idUser, 'com_thongke', 'treeview', 'treebcdaotaovc','site')) { ?>
        	<li> 
            	<a data-toggle="tab" href="#bc_daotaoboiduong_vienchuc" data-tab-url="/index.php?option=com_thongke&controller=bcdaotaovc&task=default&format=raw" >
            				Báo cáo đào tạo viên chức
            	</a>
        	</li>
        	<?php }?>
</ul>
<!-- Tab panes -->
<div class="tab-content">
	<?php if (core::_checkPerAction($idUser, 'com_thongke', 'treeview', 'treebcdaotaocc','site')) { ?>
	<div class="tab-pane" id="bc_daotaoboiduong_congchuc"></div>
	<?php }?>
	<?php if (core::_checkPerAction($idUser, 'com_thongke', 'treeview', 'treebcdaotaovc','site')) { ?>
	<div class="tab-pane"  id="bc_daotaoboiduong_vienchuc"></div>
	<?php }?>
</div>
<script type="text/javascript">
jQuery(document).ready(function($){
	if(! $('a[data-toggle="tab"]').parent().hasClass('active')){
		$('#tabs_bcdaotao a:first').tab('show');
	}
});
</script>