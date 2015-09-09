<?php
/**
 * Author: Phucnh
 * Date created: May 25, 2015
 * Company: DNICT
 */
$user   = JFactory::getUser();
?>
<ul class="nav nav-tabs" role="tablist" id="tabs-thongke">
			<?php if (core::_checkPerAction($user->id, 'com_thongke', 'thongke', 'tab_cctsbnn','site')) { ?>
        	<li class='active'> 
            	<a data-toggle="tab" href="#congchuc_tapsu_bonhiemngach"  data-tab-url="/index.php?option=com_thongke&controller=cctsbnn&task=default&format=raw">
            				Công chức Tập sự được bổ nhiệm ngạch biên chế<span id="sl_cctsbnn"></span>
            	</a>
        	</li>
        	<?php }?>
        	<?php if (core::_checkPerAction($user->id, 'com_thongke', 'thongke', 'tab_hdchuyenccvc','site')) { ?>
        	<li> 
            	<a data-toggle="tab" href="#hdchuyenccvc" data-tab-url="/index.php?option=com_thongke&controller=hdchuyenccvc&task=default&format=raw" >
            				LĐHĐ chuyển ngạch biên chế<span id="sl_hdchuyenccvc"></span>
            	</a>
        	</li>
        	<?php }?>
        	<?php if (core::_checkPerAction($user->id, 'com_thongke', 'thongke', 'tab_giahanhdld','site')) { ?>
        	<li> 
            	<a data-toggle="tab" href="#giahanhdld" data-tab-url="/index.php?option=com_thongke&controller=giahanhdld&task=default&format=raw" >
            				Gia hạn HĐLĐ<span id="sl_giahanhdld"></span>
            	</a>
        	</li>
        	<?php }?>
        	<?php if (core::_checkPerAction($user->id, 'com_thongke', 'thongke', 'tab_tuyendung','site')) { ?>
        	<li> 
            	<a data-toggle="tab" href="#tuyendung" data-tab-url="/index.php?option=com_thongke&controller=tuyendung&task=default&format=raw" >
            				Tuyển dụng<span id="sl_tuyendung"></span>
            	</a>
        	</li>
        	<?php }?>
		</ul>
		<!-- Tab panes -->
		<div class="tab-content">
			<?php if (core::_checkPerAction($user->id, 'com_thongke', 'thongke', 'tab_cctsbnn','site')) { ?>
			<div class="tab-pane fade in active" id="congchuc_tapsu_bonhiemngach"></div>
			<?php }?>
			<?php if (core::_checkPerAction($user->id, 'com_thongke', 'thongke', 'tab_hdchuyenccvc','site')) { ?>
			<div class="tab-pane"  id="hdchuyenccvc"></div>
			<?php }?>
			<?php if (core::_checkPerAction($user->id, 'com_thongke', 'thongke', 'tab_giahanhdld','site')) { ?>
			<div class="tab-pane"  id="giahanhdld"></div>
			<?php }?>
			<?php if (core::_checkPerAction($user->id, 'com_thongke', 'thongke', 'tab_tuyendung','site')) { ?>
			<div class="tab-pane"  id="tuyendung"></div>
			<?php }?>
		</div>
<script type="text/javascript">
jQuery(document).ready(function($){
// 	$('#tabs-thongke li').on('click', function(){
// 		var div_load = $(this).find('a').attr('href');
// 		if($(this).children().hasClass('loaded')) console.log('á đù');
// 		var class1 = $(this).children().attr("class");
// 		 console.log(class1);
// 		var url = $(this).find('a').data('tab-url');
// 		if(showlist != '2'){
// 			if(showlist == 1 || showlist == 3 || showlist == 0){
// 				if(!$(this).hasClass('active')){
// 		   			$.blockUI();
// 					$(div_load).load(url, function(){
// 						$.unblockUI();
// 			   		});
// 		   		}
// 			}else{
//  			}
// 		}
// 	});
// 	if(! $('a[data-toggle="tab"]').parent().hasClass('active')){
// 		$('#tabs-thongke a:first').tab('show');
// 	}
});
</script>