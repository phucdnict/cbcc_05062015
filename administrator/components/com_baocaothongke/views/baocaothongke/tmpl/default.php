<script type="text/javascript">
jQuery(document).ready(function($){
	var url="index.php?option=com_baocaohoso&controller=congchuc&task=display&format=raw";
    $.post(url,function(data){
    	 $('#tab_baocaocc').html(data);
    });
});
//     function loading11(){
// 	    var i = 1;
// //	    console.log (i);
// 	    if(i == 1){
//         jQuery.blockUI({
//	        message:'<img src="<?php //echo JURI::base(true)?>/* /components/com_baocaohoso/css/facebox/loading.gif" />Đang tải dữ liệu', */
//             css:{padding:50,}
//         });
//        }
//     }
           
</script>
<?php 
	require_once (JPATH_LIBRARIES.'/cbcc/Core.php');
	$user			=	JFactory::getUser();
?>
<div id="info_container"></div>
<div id="tabs" class="tabbable" style="width: 100%;">
    <ul class="nav nav-tabs" id="myTab">
    	<?php
        	if (core::_checkPerAction($user->id, 'com_baocaohoso', 'congchuc', 'display','site')) {
		?>
        <li class="active">	
        	<a data-toggle="tab"  href="#tab_baocaocc"  onclick='display("#tab_baocaocc","#isOpenBaocaocc","congchuc")'>
            Chất lượng công chức</a>
        </li>
        <?php
        	};
        	if (core::_checkPerAction($user->id, 'com_baocaohoso', 'vienchuc', 'display','site')) {
		?>
        <li>
        	<a class="tab-pane"  data-toggle="tab" href="#tab_baocaovc"  onclick='display("#tab_baocaovc","#isOpenBaocaovc","vienchuc")'>
            Chất lượng viên chức</a>
        </li> 
        <?php 
			};
			if (core::_checkPerAction($user->id, 'com_baocaohoso', 'thongkenhanh', 'display','site')) {
        ?>       
        <li>
        	<a data-toggle="tab" href="#tab_thongkenhanh"  onclick='display("#tab_thongkenhanh","#isOpenThongkenhanh","thongkenhanh")'>       
            Thống kê nhanh</a>
        </li>
        <?php 
			};
			if (core::_checkPerAction($user->id, 'com_baocaohoso', 'sudung', 'display','site')) {
        ?>  
        <li>
        	<a data-toggle="tab" href="#tab_sudung"  onclick='display("#tab_sudung","#isOpenSudung","sudung")'>
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
	    <div class="tab-pane active" id="tab_baocaocc"></div>
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
