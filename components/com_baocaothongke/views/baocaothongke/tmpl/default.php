<?php 
	//require_once (JPATH_LIBRARIES.'/cbcc/Core.php');
	$user			=	JFactory::getUser();
?>
<div id="info_container"></div>
<div id="tabs" class="tabbable" >
    <ul class="nav nav-tabs" id="myTab">
    	<?php
        	if (core::_checkPerAction($user->id, 'com_baocaochatluong', 'congchuc', 'display','site')) {
		?>
        <li>	
        	<a data-toggle="tab" data-tab-url="<?php echo JUri::root(true);?>/index.php?option=com_baocaochatluong&controller=congchuc&task=default&format=raw" href="#tab_baocaocc">
            Chất lượng công chức</a>
        </li>
        <?php
        	};
        	if (core::_checkPerAction($user->id, 'com_baocaochatluong', 'vienchuc', 'display','site')) {
		?>
        <li>
        	<a class="tab-pane"  data-toggle="tab" href="#tab_baocaovc" data-tab-url="<?php echo JUri::root(true);?>/index.php?option=com_baocaochatluong&controller=vienchuc&task=default&format=raw">
            Chất lượng viên chức</a>
        </li> 
        <?php 
			};
			if (core::_checkPerAction($user->id, 'com_baocaochatluong', 'thongkenhanh', 'display','site')) {
        ?>       
        <li>
        	<a data-toggle="tab" href="#tab_thongkenhanh"  data-tab-url="<?php echo JUri::root(true);?>/index.php?option=com_baocaochatluong&controller=thongkenhanh&task=default&format=raw">       
            Thống kê nhanh</a>
        </li>
        <?php 
			};
			if (core::_checkPerAction($user->id, 'com_baocaochatluong', 'sudung', 'display','site')) {
        ?>  
        <li>
        	<a data-toggle="tab" href="#tab_sudung"  data-tab-url="<?php echo JUri::root(true);?>/index.php?option=com_baocaochatluong&controller=sudung&task=default&format=raw">
            Tình hình sử dụng</a>
        </li> 
        <?php } ?> 
		<!--
        <li><a href="#tab_bienchehc"  onclick='display("#tab_bienchehc","#isOpenBiencheHC","bienchehc")'>
            Thông kê BCHC</a>
        </li>   
        <li><a href="#tab_bienchesn"  onclick='display("#tab_bienchesn","#isOpenBiencheSN","bienchesn")'>
            Thống kê BCSN</a>
        </li>                                     
		!-->
    </ul>
    
    <!-- Danh sách các tab với id để Hiển thị báo cáo theo click -->
    <div class="tab-content">
	    <div class="tab-pane" id="tab_baocaocc"></div>
	    <input type="hidden" value="0" id="isOpenBaocaocc">
	    <div class="tab-pane" id="tab_baocaovc"></div>
	    <input type="hidden" value="0" id="isOpenBaocaovc">
	    <div class="tab-pane" id="tab_thongkenhanh" ></div>
	    <input type="hidden" value="0" id="isOpenThongkenhanh">
	    <div class="tab-pane" id="tab_baocaobc"></div>
	    <input type="hidden" value="0" id="isOpenBaocaobc">
	    <div class="tab-pane" id="tab_sudung"></div>
	    <input type="hidden" value="0" id="isOpenSudung">   
<!--<div id="tab_bienchehc"></div>
    <input type="hidden" value="0" id="isOpenBiencheHC">
    <div id="tab_bienchesn"></div>
    <input type="hidden" value="0" id="isOpenBiencheSN">             
-->
	</div>
</div>
<script type="text/javascript">
jQuery(document).ready(function($){
// 	var url="index.php?option=com_baocaochatluong&controller=congchuc&task=display&format=raw";
//     $.post(url,function(data){
//     	 $('#tab_baocaocc').html(data);
//     });
	if(! $('a[data-toggle="tab"]').parent().hasClass('active')){
		$('#myTab a:first').tab('show');
	}
});
</script>