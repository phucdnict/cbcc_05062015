<?php
defined('_JEXEC') or die('Restricted access');
?>
<div id="div_list_hoso">
	<h3 class="row-fluid header smaller lighter blue">
		<span>	Quản lý hồ sơ
			<small> 
				<span id="tenphuongxa"></span>
				<span id="tenthonto"></span>
			</small>
		</span>
	</h3>
	<div class="row-fluid">
		<div id="main-right" class="tabbable">
			<ul class="nav nav-tabs" id="tabs-hoso-default">
				<li class="active">
					<a href="#tabtrichngang" data-toggle="tab"
					data-url="<?php echo JURI::base(true);?>/index.php?option=com_thonto&view=thonto&format=raw&task=viewdanhsach">
						Danh sách trích ngang
					</a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tabtrichngang">
					<table style="margin-bottom:10px;">
					<tr>
						<td style="vertical-align:middle;">
						<?php if(Core::_checkPerAction($this->idUser, 'com_thonto', 'thonto', 'hoso_add')){ ?>
							<span class="btn btn-small btn-success" id="btn_add_hoso"
								data-rel="tooltip" data-placement="top" title="Thêm mới">
								<i class="icon-plus"></i> Thêm mới
							</span>
						<?php }?>
						<?php if(Core::_checkPerAction($this->idUser, 'com_thonto', 'thonto', 'hoso_del')){ ?>
							<span class="btn btn-small btn-danger" id="btn_del_hoso">
								<i class="icon-trash"></i> Xóa
							</span>
						<?php }?>
						</td>
					</tr>
					</table>
					<div id="trichngang">
					
					</div>
				</div>
			</div>
			<input type="hidden" id="id_donvi" name="id_donvi" value="" />
			<input type="hidden" id="loai_donvi" name="loai_donvi" value="" />
		</div>
	</div>
</div>
<div id="div_detail_hoso"></div>
<div id="modal-form" class="modal hide" tabindex="-1" style="width:900px;left:35%;">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="blue bigger" id="modal-title"></h4>
	</div>
	<div class="modal-body overflow-visible">
		<div id="modal-content" class="slim-scroll" data-height="400">
		
		</div>
	</div>
	<div class="modal-footer">
		
	</div>
</div>
<style>
#main-content-tree{
 height: 280px;
 overflow: auto;
}
</style>
<script type="text/javascript">
var id= '';
jQuery(document).ready(function($){
	$('.slim-scroll').each(function () {
		var $this = $(this);
		$this.slimScroll({
			height: $this.data('height') || 100,
			railVisible:true
		});
	});
	var root_id = '<?php echo $this->id_donvi['rootId']; ?>';
	createTreeviewInMenuBar('Cây hồ sơ đơn vị');
	$("#main-content-tree").jstree({
		"plugins" : [
			"themes","json_data","ui","cookies","types"
		],
		"json_data" : {
			"data" : [{	"attr" : { "id" : "node_<?php echo $this->id_donvi['rootId']; ?>",
									"showlist" : "<?php echo $this->id_donvi['rootType']; ?>",
									"donvihanhchinh" : "<?php echo $this->id_donvi['rootDonvihanhchinh']; ?>"
								},
				"state" : "closed",
				"data" : {
						"title" : "<?php echo $this->id_donvi['rootName']; ?>",
						"attr" : { "href" : "#" }
					}
			}],
			"ajax" : {
				"url" : "index.php",
				"data" : function (n) {
					return {
						"option" : "com_thonto",
						"view" : "treeview",
						"task" : "treeview",
						"format" : "raw",
						"id" : n.attr ? n.attr("id").replace("node_","") : root_id
					};
				}
			}
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
	}).bind("select_node.jstree", function (event, data) {
		/*
			showlist = 1 => Vỏ chứa
			showlist = 2 => Quận huyện
			showlist = 3 => Phường xã
			showlist = 4 => Tổ dân phố
			showlist = 5 => Thôn
		*/
		showlist = data.rslt.obj.attr("showlist");
		$.blockUI();
		$('#div_list_hoso').show();
		$('#div_detail_hoso').html('');
		id = data.rslt.obj.attr("id").replace("node_","");
		if(showlist == '1' || showlist == '2'){
			$('#tenphuongxa').html('<i class="icon-double-angle-right"></i>'+$('.jstree-clicked').text());
			$('#tenthonto').html('');
			
		}else if(showlist == '3'){
			$('#tenphuongxa').html('<i class="icon-double-angle-right"></i>'+$('.jstree-clicked').text());
			$('#tenthonto').html('');
			
		}else if(showlist == '4' || showlist == '5'){
			nodeParent = data.inst._get_parent(data.rslt.obj);
			$('#tenphuongxa').html('<i class="icon-double-angle-right"></i>'+nodeParent.find('a').first().text());
			$('#tenthonto').html('<i class="icon-double-angle-right"></i>'+$('.jstree-clicked').text());
			idParent = nodeParent.attr("id").replace("node_","");
			
		}
		$('#id_donvi').val(id);
		$('#loai_donvi').val(showlist);
		$('#tabs-hoso-default li.active').each(function(){
			var div_load = $(this).find('a').attr('href');
			var url = $(this).find('a').data('url');
			url+= '&id_donvi='+id;
			if(div_load == '#tabtrichngang'){
				$('#trichngang').load(url, function(){
					$.unblockUI();
				});
			}
		});
	}).delegate("a", "click", function (event, data) { event.preventDefault(); });
	$('#tabs-hoso-default li').on('click', function(){
		if(!$(this).hasClass('active')){
			$.blockUI();
			var div_load = $(this).find('a').attr('href');
			var url = $(this).find('a').data('url');
			if(div_load == '#tabtrichngang'){
				url+= '&id_donvi='+id;
			}

			if(id != ''){
				if(div_load == '#tabtrichngang'){
					$('#trichngang').load(url, function(){
						$.unblockUI();
					});
				}
			}else{
				$.unblockUI();
			}
		}
	});
	$('#btn_add_hoso').on('click', function(){
		if($('#loai_donvi').val() != '1' || $('#loai_donvi').val() != '2'){
			$.blockUI();
			$('#modal-title').html('Thêm mới hồ sơ cán bộ');
			$('.modal-footer').html('<button class="btn btn-small btn_remove_hoso_add" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_hoso_add">Lưu</button>');
			$('#modal-content').load('index.php?option=com_thonto&view=thonto&format=raw&task=hoso_add&id_donvi='+$('#id_donvi').val(),function(){
				$('#modal-form').modal('show');
				$.unblockUI();
			});
		}else{
			loadNoticeBoardError('Thông báo', 'Vui lòng chọn phường xã hoặc thôn, tổ dân phố cần thêm mới hồ sơ.');
		}
	});
	$('body').delegate('.btn_save_hoso_add', 'click', function(){
		$.blockUI();
		if($('#HosoAddFrm').valid() == false){
			$.unblockUI();
			return false;
		}else{
			$.post('index.php',{option:'com_thonto',controller:'thonto',task:'kiemtraCoChucvu',donvi_id:$('#id_donvi').val(),chucvu_id:$('#hoso_add_congtac_chucvu_id').val()},function(data){
				if(data == '1'){
					loadNoticeBoardError('Thông báo', 'Chức vụ bạn chọn đã có. Vui lòng chọn chức vụ khác hoặc liên hệ quản trị viên!');
					$.unblockUI();
				}else{
					var url = 'index.php?option=com_thonto&controller=thonto&task=themmoiHoso';
					$.post(url, $('#HosoAddFrm').serialize(), function(data){
						if(data == '1'){
							loadNoticeBoardSuccess('Thông báo', 'Xử lý thành công!');
							$('#modal-form').modal('hide');
							$('#modal-content').html('');
							$('#trichngang').load('index.php?option=com_thonto&view=thonto&format=raw&task=viewdanhsach&id_donvi='+$('#id_donvi').val(),function(){
								$.unblockUI();
							});
						}else{
							loadNoticeBoardError('Thông báo', 'Xử lý không thành công');
							$.unblockUI();
						}
					});
				}
			});
		}
	});
	$('body').delegate('.btn_edit_hoso', 'click', function(){
		idHoso = $(this).attr('idHoso');
		$.blockUI();
		if(idHoso == ''){
			loadNoticeBoardError('Thông báo','Có lỗi xảy ra. Vui lòng liên hệ quản trị viên!');
			$.unblockUI();
		}else{
			$.blockUI();
			$('#div_list_hoso').hide();
			$('#div_detail_hoso').load('index.php?option=com_thonto&view=thonto&format=raw&task=hoso_edit&idHoso='+idHoso,function(){
				$.unblockUI();
			});
		}
		return false;
	});
	$('#btn_del_hoso').on('click', function(){
		$.blockUI();
		$.post('index.php?task=xoaHoso', $('#frmHosoDanhsach').serialize(), function(data){
			if(data == '1'){
				$('#trichngang').load('index.php?option=com_thonto&view=thonto&format=raw&task=viewdanhsach&id_donvi='+$('#id_donvi').val(),function(){
					loadNoticeBoardSuccess('Thông báo', 'Xử lý thành công!');
					$.unblockUI();
				});
			}else{
				loadNoticeBoardError('Thông báo', 'Xử lý không thành công');
				$.unblockUI();
			}
		});
	});
	/* ------------------------------------------- Công tác -------------------------------------------------- */
	$('body').delegate('#btn_add_congtac', 'click', function(){
		$.blockUI();
		$('#modal-title').html('Thêm mới quá trình công tác');
		$('.modal-footer').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_congtac">Lưu</button>');
		$('#modal-content').load('index.php?option=com_thonto&view=congtac&format=raw&task=add_congtac&idHoso='+$('#hoso_edit_idHoso').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_edit_congtac', 'click', function(){
		$.blockUI();
		var id_quatrinh = $(this).attr('id_quatrinh');
		$('#modal-title').html('Điều chỉnh quá trình công tác');
		$('.modal-footer').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_congtac ">Lưu</button>');
		$('#modal-content').load('index.php?option=com_thonto&view=congtac&format=raw&task=edit_congtac&id_quatrinh='+id_quatrinh+'&idHoso='+$('#hoso_edit_idHoso').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('#btn_remove_congtac', 'click', function(){
		if($('input[name="id_ct[]"]:checked').length > 0){
			if(confirm('Bạn có chắc chắn muốn xóa các quá trình đã chọn?')){
				blockMyUI('Tiến trình đang xử lý...');
				var idsQuatrinhCT = [];
				$('input[name="id_ct[]"]:checked').each(function(){
					var row_index = $('input[name="id_ct[]"]').index($(this));
					idsQuatrinhCT.push($(this).val());
					$('.tr_congtac').eq(row_index).remove();
				});
				if(idsQuatrinhCT.length > 0){
					var url = 'index.php?option=com_thonto&controller=thonto&task=removeQuatrinh&typeRemove=quatrinhcongtac&idHoso='+$('#hoso_edit_idHoso').val()+'&idsQuatrinh='+idsQuatrinhCT.join(',');
					$.post(url, function(data){
						if(data == 'Xóa dữ liệu thành công.'){
							loadNoticeBoardSuccess('Thông báo',data);
						}else{
							loadNoticeBoardError('Thông báo',data);
						}
					});
				}
				$.unblockUI();
			}
		}else{
			alert('Vui lòng chọn quá trình để xóa.');
		}
	});
	$('body').delegate('.btn_save_congtac', 'click', function(){
		$.blockUI();
		if($('#CongtacFrm').valid() == false){
			$.unblockUI();
			return false;
		}else{
			var url = 'index.php?option=com_thonto&controller=thonto&task=saveCongtac';
			$.post(url, $('#CongtacFrm').serialize(), function(data){
				if(data == '1'){
					loadNoticeBoardSuccess('Thông báo', 'Xử lý thành công!');
					$('#modal-form').modal('hide');
					$('#modal-content').html('');
					$('#div-quatrinhcongtac').load('index.php?option=com_thonto&view=congtac&format=raw&task=quatrinhcongtac&idHoso='+$('#hoso_edit_idHoso').val(),function(){
						$.unblockUI();
					});
				}else{
					loadNoticeBoardError('Thông báo', 'Xử lý không thành công');
					$.unblockUI();
				}
			});
		}
	});
	/* ------------------------------------------- Khen thưởng -------------------------------------------------- */
	$('body').delegate('#btn_add_khenthuong', 'click', function(){
		$.blockUI();
		$('#modal-title').html('Thêm mới quá trình khen thưởng');
		$('.modal-footer').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_khenthuong">Lưu</button>');
		$('#modal-content').load('index.php?option=com_thonto&view=khenthuongkyluat&format=raw&task=add_khenthuong&idHoso='+$('#hoso_edit_idHoso').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_edit_khenthuong', 'click', function(){
		$.blockUI();
		var id_quatrinh = $(this).attr('id_quatrinh');
		$('#modal-title').html('Điều chỉnh quá trình khen thưởng');
		$('.modal-footer').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_khenthuong ">Lưu</button>');
		$('#modal-content').load('index.php?option=com_thonto&view=khenthuongkyluat&format=raw&task=edit_khenthuong&id_quatrinh='+id_quatrinh+'&idHoso='+$('#hoso_edit_idHoso').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('#btn_remove_khenthuong', 'click', function(){
		if($('input[name="id_kt[]"]:checked').length > 0){
			if(confirm('Bạn có chắc chắn muốn xóa các quá trình đã chọn?')){
				blockMyUI('Tiến trình đang xử lý...');
				var idsQuatrinhKT = [];
				$('input[name="id_kt[]"]:checked').each(function(){
					var row_index = $('input[name="id_kt[]"]').index($(this));
					idsQuatrinhKT.push($(this).val());
					$('.tr_khenthuong').eq(row_index).remove();
				});
				if(idsQuatrinhCT.length > 0){
					var url = 'index.php?option=com_thonto&controller=thonto&task=removeQuatrinh&typeRemove=quatrinhkhenthuong&idHoso='+$('#hoso_edit_idHoso').val()+'&idsQuatrinh='+idsQuatrinhKT.join(',');
					$.post(url, function(data){
						if(data == 'Xóa dữ liệu thành công.'){
							loadNoticeBoardSuccess('Thông báo',data);
						}else{
							loadNoticeBoardError('Thông báo',data);
						}
					});
				}
				$.unblockUI();
			}
		}else{
			alert('Vui lòng chọn quá trình để xóa.');
		}
	});
	$('body').delegate('.btn_save_khenthuong', 'click', function(){
		$.blockUI();
		if($('#KhenthuongFrm').valid() == false){
			$.unblockUI();
			return false;
		}else{
			var url = 'index.php?option=com_thonto&controller=thonto&task=saveKhenthuong';
			$.post(url, $('#KhenthuongFrm').serialize(), function(data){
				if(data == '1'){
					loadNoticeBoardSuccess('Thông báo', 'Xử lý thành công!');
					$('#modal-form').modal('hide');
					$('#modal-content').html('');
					$('#div-quatrinhkhenthuong').load('index.php?option=com_thonto&view=khenthuongkyluat&format=raw&task=quatrinhkhenthuong&idHoso='+$('#hoso_edit_idHoso').val(),function(){
						$.unblockUI();
					});
				}else{
					loadNoticeBoardError('Thông báo', 'Xử lý không thành công');
					$.unblockUI();
				}
			});
		}
	});
	/* ------------------------------------------- Kỷ luật -------------------------------------------------- */
	$('body').delegate('#btn_add_kyluat', 'click', function(){
		$.blockUI();
		$('#modal-title').html('Thêm mới quá trình kỷ luật');
		$('.modal-footer').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_kyluat">Lưu</button>');
		$('#modal-content').load('index.php?option=com_thonto&view=khenthuongkyluat&format=raw&task=add_kyluat&idHoso='+$('#hoso_edit_idHoso').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('.btn_edit_kyluat', 'click', function(){
		$.blockUI();
		var id_quatrinh = $(this).attr('id_quatrinh');
		$('#modal-title').html('Điều chỉnh quá trình kỷ luật');
		$('.modal-footer').html('<button class="btn btn-small btn_remove_quatrinh" data-dismiss="modal">Hủy bỏ</button><button index="-1" class="btn btn-small btn-primary btn_save_kyluat ">Lưu</button>');
		$('#modal-content').load('index.php?option=com_thonto&view=khenthuongkyluat&format=raw&task=edit_kyluat&id_quatrinh='+id_quatrinh+'&idHoso='+$('#hoso_edit_idHoso').val(),function(){
			$.unblockUI();
		});
	});
	$('body').delegate('#btn_remove_kyluat', 'click', function(){
		if($('input[name="id_kl[]"]:checked').length > 0){
			if(confirm('Bạn có chắc chắn muốn xóa các quá trình đã chọn?')){
				blockMyUI('Tiến trình đang xử lý...');
				var idsQuatrinhKL = [];
				$('input[name="id_kl[]"]:checked').each(function(){
					var row_index = $('input[name="id_kl[]"]').index($(this));
					idsQuatrinhKL.push($(this).val());
					$('.tr_kyluat').eq(row_index).remove();
				});
				if(idsQuatrinhCT.length > 0){
					var url = 'index.php?option=com_thonto&controller=thonto&task=removeQuatrinh&typeRemove=quatrinhkyluat&idHoso='+$('#hoso_edit_idHoso').val()+'&idsQuatrinh='+idsQuatrinhKL.join(',');
					$.post(url, function(data){
						if(data == 'Xóa dữ liệu thành công.'){
							loadNoticeBoardSuccess('Thông báo',data);
						}else{
							loadNoticeBoardError('Thông báo',data);
						}
					});
				}
				$.unblockUI();
			}
		}else{
			alert('Vui lòng chọn quá trình để xóa.');
		}
	});
	$('body').delegate('.btn_save_kyluat', 'click', function(){
		$.blockUI();
		if($('#KyluatFrm').valid() == false){
			$.unblockUI();
			return false;
		}else{
			var url = 'index.php?option=com_thonto&controller=thonto&task=saveKyluat';
			$.post(url, $('#KyluatFrm').serialize(), function(data){
				if(data == '1'){
					loadNoticeBoardSuccess('Thông báo', 'Xử lý thành công!');
					$('#modal-form').modal('hide');
					$('#modal-content').html('');
					$('#div-quatrinhkyluat').load('index.php?option=com_thonto&view=khenthuongkyluat&format=raw&task=quatrinhkyluat&idHoso='+$('#hoso_edit_idHoso').val(),function(){
						$.unblockUI();
					});
				}else{
					loadNoticeBoardError('Thông báo', 'Xử lý không thành công');
					$.unblockUI();
				}
			});
		}
	});
});
</script>