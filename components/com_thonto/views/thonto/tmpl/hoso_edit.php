<?php
defined ( '_JEXEC' ) or die ( 'Restricted access' );
$item = $this->item;
?>
<div style="clear: both;"></div>
<form id="HosoEditFrm" name="HosoEditFrm" method="post" class="form-horizontal" enctype="multipart/form-data" action="index.php">
<h3 class="header smaller lighter blue">
	Hồ sơ cán bộ - <?php echo $item['hoten']; ?>
	<span class="btn btn-small btn-danger pull-right inline" id="btn_back_hoso_edit" style="margin-right: 5px;">
		<i class="icon-mail-reply"></i> Quay về
	</span>
	<span class="btn btn-small btn-success pull-right inline" id="btn_save_close_hoso_edit" style="margin-right: 5px;">
		<i class="icon-check"></i> Lưu và đóng
	</span>
	<span class="btn btn-small btn-success pull-right inline" id="btn_save_continue_hoso_edit" style="margin-right: 5px;">
		<i class="icon-check"></i> Lưu và tiếp tục
	</span>
</h3>
<ul class="nav nav-tabs" id="tabs-hoso-edit">
	<li class="active"><a data-toggle="tab" href="#tabthongtinchung">Thông tin chung</a></li>
	<li><a data-toggle="tab" href="#tabcongtac" id="clickCongtac">Quá trình công tác</a></li>
	<li><a data-toggle="tab" href="#tabktkl" id="clickKTKL">Quá trình khen thưởng kỷ luật</a></li>
</ul>
<div class="tab-content">
	<div id="tabthongtinchung" class="tab-pane active">
	<table>
	<tr>
		<td colspan="2">
		<div style="float:left;width:800px;">
			<div class="control-group">
				<label class="control-label" for="hoso_edit_hosochinh_id">Tải hồ sơ từ hệ thống CBCCVC</label>
				<div class="controls">
					<input class="input-xxlarge" id="hoso_edit_hosochinh_id" name="hoso_edit[hosochinh_id]" value="<?php echo $item['hosochinh_id']; ?>" />
				</div>
			</div>
		</div>
		</td>
	</tr>
	<tr>
		<td style="width:50%">
		<div style="float:left;width:400px;">
			<div class="control-group">
				<label class="control-label" for="hoso_edit_hoten">Họ và tên (<span style="color:red;">*</span>)</label>
				<div class="controls">
					<input type="text" id="hoso_edit_hoten" name="hoso_edit[hoten]" value="<?php echo $item['hoten']; ?>" />
				</div>
			</div>
		</div>
		</td>
		<td style="width:50%">
		<div style="float:left;width:400px;">
			<div class="control-group">
				<label class="control-label" for="hoso_edit_ngaysinh">Ngày sinh (<span style="color:red;">*</span>)</label>
				<div class="controls">
					<div class="row-fluid input-append">
						<input type="text" id="hoso_edit_ngaysinh" name="hoso_edit[ngaysinh]" class="input-small date-picker input-mask-date"
						data-date-format="dd/mm/yyyy" value="<?php echo $item['ngaysinh']; ?>" />
						<span class="add-on">
							<i class="icon-calendar"></i>
						</span>
					</div>
				</div>
			</div>
		</div>
		</td>
	</tr>
	<tr>
		<td>
		<div style="float:left;width:400px;">
			<div class="control-group">
				<label class="control-label" for="hoso_edit_gioitinh">Giới tính (<span style="color:red;">*</span>)</label>
				<div class="controls">
					<?php echo ThontoHelper::selectBoxAndAttr($item['gioitinh'],
							array('id'=>'hoso_edit_gioitinh','name'=>'hoso_edit[gioitinh]'),'sex_code',array('id','name'),array('status = 1')); ?>
				</div>
			</div>
		</div>
		</td>
		<td>
		<div style="float:left;width:400px;">
			<div class="control-group">
				<label class="control-label" for="hoso_edit_dienthoailienhe">Điện thoại liên hệ (<span style="color:red;">*</span>)</label>
				<div class="controls">
					<input type="text" id="hoso_edit_dienthoailienhe" name="hoso_edit[dienthoailienhe]" value="<?php echo $item['dienthoailienhe']; ?>" />
				</div>
			</div>
		</div>
		</td>
	</tr>
	<tr>
		<td>
		<div style="float:left;width:400px;">
			<div class="control-group">
				<label class="control-label" for="hoso_edit_email">Email</label>
				<div class="controls">
					<input type="text" id="hoso_edit_email" name="hoso_edit[email]" value="<?php echo $item['email']; ?>" />
				</div>
			</div>
		</div>
		</td>
		<td>
		<div style="float:left;width:400px;">
			<div class="control-group">
				<label class="control-label" for="hoso_edit_danhdaudangvien">Đảng viên (<span style="color:red;">*</span>)</label>
				<div class="controls">
					<select id="hoso_edit_danhdaudangvien" name="hoso_edit[danhdaudangvien]">
						<option value=""></option>
						<option value="0" <?php echo ($item['danhdaudangvien'] == '0')?'selected="selected"':''; ?>>Không</option>
						<option value="1" <?php echo ($item['danhdaudangvien'] == '1')?'selected="selected"':''; ?>>Có</option>
					</select>
				</div>
			</div>
		</div>
		</td>
	</tr>
	<tr>
		<td>
		<div style="float:left;width:400px;<?php echo ($item['danhdaudangvien'] == '0')?'display:none;':''; ?>" class="hoso_edit_dangvien">
			<div class="control-group">
				<label class="control-label" for="hoso_edit_ngayvaodang">Ngày vào Đảng (<span style="color:red;">*</span>)</label>
				<div class="controls">
					<div class="row-fluid input-append">
						<input type="text" id="hoso_edit_ngayvaodang" name="hoso_edit[ngayvaodang]" class="input-small date-picker input-mask-date"
						data-date-format="dd/mm/yyyy" value="<?php echo $item['ngayvaodang']; ?>" />
						<span class="add-on">
							<i class="icon-calendar"></i>
						</span>
					</div>
				</div>
			</div>
		</div>
		</td>
		<td>
		<div style="float:left;width:400px;<?php echo ($item['danhdaudangvien'] == '0')?'display:none;':''; ?>" class="hoso_edit_dangvien">
			<div class="control-group">
				<label class="control-label" for="hoso_edit_ngaychinhthuc">Ngày chính thức</label>
				<div class="controls">
					<div class="row-fluid input-append">
						<input type="text" id="hoso_edit_ngaychinhthuc" name="hoso_edit[ngaychinhthuc]" class="input-small date-picker input-mask-date"
						data-date-format="dd/mm/yyyy" value="<?php echo $item['ngaychinhthuc']; ?>" />
						<span class="add-on">
							<i class="icon-calendar"></i>
						</span>
					</div>
				</div>
			</div>
		</div>
		</td>
	</tr>
	<tr>
		<td colspan="2">
		<hr class="span10">
		<div style="float:left;width:400px;">
			<div class="control-group">
				<label class="control-label" for="hoso_edit_nghenghiephientai">Nghề nghiệp hiện tại (<span style="color:red;">*</span>)</label>
				<div class="controls">
					<?php echo ThontoHelper::selectBoxAndAttr($item['nghenghiephientai'],array('id'=>'hoso_edit_nghenghiephientai','name'=>'hoso_edit[nghenghiephientai]'),
							'thonto_nghenghiephientai',array('id','ten','caphanhchinh_id','cokiemnhiem')); ?>
				</div>
			</div>
		</div>
		</td>
	</tr>
	<tr>
		<td colspan="2">
		<hr class="span10">
		</td>
	</tr>
	<tr>
		<td>
		<div style="float:left;width:400px;">
			<div class="control-group">
				<label class="control-label" for="hoso_edit_chuyenmon_trinhdo_code">Trình độ chuyên môn (<span style="color:red;">*</span>)</label>
				<div class="controls">
					<input type="hidden" id="hoso_edit_chuyenmon_trinhdo_mucdo" name="hoso_edit[chuyenmon_trinhdo_mucdo]" value="<?php echo $item['chuyenmon_trinhdo_mucdo']; ?>" />
					<?php echo ThontoHelper::selectBoxAndAttr($item['chuyenmon_trinhdo_code'],
							array('id'=>'hoso_edit_chuyenmon_trinhdo_code','name'=>'hoso_edit[chuyenmon_trinhdo_code]'),
							'cla_sca_code',array('code','name','step'),array('tosc_code = 2')); ?>
				</div>
			</div>
		</div>
		</td>
		<td>
		<div style="float:left;width:400px;<?php echo ($item['chuyenmon_trinhdo_code'] == '')?'display:none;':''; ?>" class="hoso_edit_chuyenmon">
			<div class="control-group">
				<label class="control-label" for="hoso_edit_chuyenmon_truong">Trường (<span style="color:red;">*</span>)</label>
				<div class="controls">
					<div class="row-fluid input-append">
						<input type="text" id="hoso_edit_chuyenmon_truong" name="hoso_edit[chuyenmon_truong]" class="suggest" value="<?php echo $item['chuyenmon_truong']; ?>"/>
						<span class="btn btn-small btn-info" id="expand_hoso_edit_chuyenmon_truong"><i class="caret"></i></span>
						<input type="hidden" id="hoso_edit_chuyenmon_truong_id" name="hoso_edit[chuyenmon_truong_id]" value="<?php echo $item['chuyenmon_truong_id']; ?>" />
					</div>
				</div>
			</div>
		</div>
		</td>
	</tr>
	<tr>
		<td>
		<div style="float:left;width:400px;<?php echo ($item['chuyenmon_trinhdo_code'] == '')?'display:none;':''; ?>" class="hoso_edit_chuyenmon">
			<div class="control-group">
				<label class="control-label" for="hoso_edit_chuyenmon_chuyennganh">Chuyên ngành (<span style="color:red;">*</span>)</label>
				<div class="controls">
					<div class="row-fluid input-append">
						<input type="text" id="hoso_edit_chuyenmon_chuyennganh" name="hoso_edit[chuyenmon_chuyennganh]" class="suggest" value="<?php echo $item['chuyenmon_chuyennganh']; ?>"/>
						<span class="btn btn-small btn-info" id="expand_hoso_edit_chuyenmon_chuyennganh"><i class="caret"></i></span>
						<input type="hidden" id="hoso_edit_chuyenmon_chuyennganh_id" name="hoso_edit[chuyenmon_chuyennganh_id]" value="<?php echo $item['chuyenmon_chuyennganh_id']; ?>" />
					</div>
				</div>
			</div>
		</div>
		</td>
		<td>
		<div style="float:left;width:400px;<?php echo ($item['chuyenmon_trinhdo_code'] == '')?'display:none;':''; ?>" class="hoso_edit_chuyenmon">
			<div class="control-group">
				<label class="control-label" for="hoso_edit_chuyenmon_namtotnghiep">Năm tốt nghiệp (<span style="color:red;">*</span>)</label>
				<div class="controls">
					<input type="text" id="hoso_edit_chuyenmon_namtotnghiep" name="hoso_edit[chuyenmon_namtotnghiep]" value="<?php echo $item['chuyenmon_namtotnghiep']; ?>" class="input-mini"/>
				</div>
			</div>
		</div>
		</td>
	</tr>
	<tr>
		<td>
		<div style="float:left;width:400px;<?php echo ($item['chuyenmon_trinhdo_code'] == '')?'display:none;':''; ?>" class="hoso_edit_chuyenmon">
			<div class="control-group">
				<label class="control-label" for="hoso_edit_chuyenmon_hinhthucdaotao_id">Hình thức đào tạo (<span style="color:red;">*</span>)</label>
				<div class="controls">
					<?php echo ThontoHelper::selectBoxAndAttr($item['chuyenmon_hinhthucdaotao_id'],
							array('id'=>'hoso_edit_chuyenmon_hinhthucdaotao_id','name'=>'hoso_edit[chuyenmon_hinhthucdaotao_id]'),
							'edu_form',array('id','name'),array('status = 1')); ?>
				</div>
			</div>
		</div>
		</td>
		<td>
		<div style="float:left;width:400px;<?php echo ($item['chuyenmon_trinhdo_code'] == '')?'display:none;':''; ?>" class="hoso_edit_chuyenmon">
			<div class="control-group">
				<label class="control-label" for="hoso_edit_chuyenmon_loaitotnghiep_id">Loại tốt nghiệp</label>
				<div class="controls">
					<?php echo ThontoHelper::selectBoxAndAttr($item['chuyenmon_loaitotnghiep_id'],
							array('id'=>'hoso_edit_chuyenmon_loaitotnghiep_id','name'=>'hoso_edit[chuyenmon_loaitotnghiep_id]'),
							'degree_code',array('id','name'),array('status = 1')); ?>
				</div>
			</div>
		</div>
		</td>
	</tr>
	<tr>
		<td>
		<div style="float:left;width:400px;<?php echo ($item['chuyenmon_trinhdo_code'] == '')?'display:none;':''; ?>" class="hoso_edit_chuyenmon">
			<div class="control-group">
				<label class="control-label" for="hoso_edit_chuyenmon_nuocdaotao">Nước đào tạo (<span style="color:red;">*</span>)</label>
				<div class="controls">
					<?php echo ThontoHelper::selectBoxAndAttr($item['chuyenmon_nuocdaotao'],
							array('id'=>'hoso_edit_chuyenmon_nuocdaotao','name'=>'hoso_edit[chuyenmon_nuocdaotao]'),
							'country_code',array('code','name')); ?>
				</div>
			</div>
		</div>
		</td>
		<td>
		<div style="float:left;width:400px;">
			<div class="control-group">
				<label class="control-label" for="hoso_edit_dadaotaonghiepvu">Đã đào tạo nghiệp vụ (<span style="color:red;">*</span>)</label>
				<div class="controls">
					<select id="hoso_edit_dadaotaonghiepvu" name="hoso_edit[dadaotaonghiepvu]">
						<option value=""></option>
						<option value="0" <?php echo ($item['danhdaudangvien'] == '0')?'selected="selected"':''; ?>>Không</option>
						<option value="1" <?php echo ($item['danhdaudangvien'] == '1')?'selected="selected"':''; ?>>Có</option>
					</select>
				</div>
			</div>
		</div>
		</td>
	</tr>
	<tr>
		<td>
		<div style="float:left;width:400px;">
			<div class="control-group">
				<label class="control-label" for="hoso_edit_loaibaohiemyte_id">Loại bảo hiểm y tế (<span style="color:red;">*</span>)</label>
				<div class="controls">
					<?php echo ThontoHelper::selectBoxAndAttr($item['loaibaohiemyte_id'],
							array('id'=>'hoso_edit_loaibaohiemyte_id','name'=>'hoso_edit[loaibaohiemyte_id]'),
							'thonto_loaibaohiemyte',array('id','ten'),array('trangthai = 1')); ?>
				</div>
			</div>
		</div>
		</td>
		<td>
		<div style="float:left;width:400px;" class="hoso_edit_kiemnhiem">
			<div class="control-group">
				<label class="control-label" for="hoso_edit_congtac_chucvu_kiemnhiem">Chức danh phường xã kiêm nhiệm</label>
				<div class="controls">
					<input type="hidden" id="hoso_edit_congtac_chucvu_kiemnhiem_id" name="hoso_edit[congtac_chucvu_kiemnhiem_id]" value="<?php echo $item['congtac_chucvu_kiemnhiem_id']; ?>" />
					<input type="text" id="hoso_edit_congtac_chucvu_kiemnhiem" name="hoso_edit[congtac_chucvu_kiemnhiem]" value="<?php echo $item['congtac_chucvu_kiemnhiem']; ?>" />
				</div>
			</div>
		</div>
		</td>
	</tr>
	<tr>
		<td>
		<div style="float:left;width:400px;">
			<div class="control-group">
				<label class="control-label" for="hoso_edit_chucdanhchibo_id">Chức danh chi bộ</label>
				<div class="controls">
					<select id="hoso_edit_chucdanhchibo_id" name="hoso_edit[chucdanhchibo_id]">
						<option value=""></option>
						<option value="1" <?php echo ($item['chucdanhchibo_id'] == '1')?'selected="selected"':''; ?>>Bí thư</option>
						<option value="2" <?php echo ($item['chucdanhchibo_id'] == '2')?'selected="selected"':''; ?>>Phó bí thư</option>
						<option value="3" <?php echo ($item['chucdanhchibo_id'] == '3')?'selected="selected"':''; ?>>Chức danh khác</option>
					</select>
				</div>
			</div>
		</div>
		</td>
		<td></td>
	</tr>
	</table>
	</div>
	<div class="tab-pane" id="tabcongtac">
		<!-- ----------------------------Quá trình công tác------------------------------ -->
		<div id="div-quatrinhcongtac"></div>
	</div>
	<div class="tab-pane" id="tabktkl">
		<!-- ----------------------------Quá trình khen thưởng------------------------------ -->
		<div id="div-quatrinhkhenthuong"></div>
		<!-- ----------------------------Quá trình kỷ luật------------------------------ -->
		<div id="div-quatrinhkyluat"></div>
	</div>
</div>
<input type="hidden" id="hoso_edit_idHoso" name="hoso_edit[idHoso]" value="<?php echo $item['id'] ?>" />
</form>
<div style="clear: both;"></div>
<script type="text/javascript">
var dataFormatSelection = function(data) {
   return data.hoten;  
}
var dataFormatResult = function(data) {
    var markup = "<table class='movie-result'><tr>";
    markup += "<td class='movie-image'>";
    if (data.hinhthe !== undefined && data.hinhthe !== null) {
    	markup +="<img src='<?php echo JUri::root(true)?>/timthumb.php?w=60&h=80&base64=1&src=" + data.hinhthe + "'/>";
    }else{
    	markup +="<img style='width:60px;height:80px;' src='<?php echo JUri::root(true)?>/media/cbcc/img/anhthe.png'/>";
    }
    markup += "</td>";
    markup += "<td class='movie-info'><div class='movie-title'>" + data.hoten + "</div>";
    if (data.ngaysinh !== undefined) {
        markup += "<div class='movie-synopsis'>" + data.ngaysinh + "</div>";
    }
    if (data.donvi !== undefined) {
        markup += "<div class='movie-synopsis'>" + data.donvi + "</div>";
    }
    if (data.trangthai !== undefined) {
        markup += "<div class='movie-synopsis'>" + data.trangthai + "</div>";
    }
    markup += "</td></tr></table>";
    return markup;
}
jQuery(document).ready(function($){
	$('.date-picker').datepicker({
        startDate: "01/01/1900",
        endDate: "01/01/3000"
    }).next().on(ace.click_event, function(){
		$(this).prev().focus();
	});
	$('.input-mask-date').mask('39/19/2999');
	var clickCongtac = 0, clickKTKL = 0;
	$('#clickCongtac').on('click', function(){
		if(clickCongtac == 0){
			$.blockUI();
			$('#div-quatrinhcongtac').load('<?php echo JURI::base(true);?>/index.php?option=com_thonto&view=congtac&format=raw&task=quatrinhcongtac&idHoso=<?php echo JRequest::getInt('idHoso',null); ?>&id_donvi='+jQuery('#id_donvi').val(),function(){
				$.unblockUI();
			});
			clickCongtac++;
		}
	});
	$('#clickKTKL').on('click', function(){
		if(clickKTKL == 0){
			$.blockUI();
			$('#div-quatrinhkhenthuong').load('<?php echo JURI::base(true);?>/index.php?option=com_thonto&view=khenthuongkyluat&format=raw&task=quatrinhkhenthuong&idHoso=<?php echo JRequest::getInt('idHoso',null); ?>',function(){
				$('#div-quatrinhkyluat').load('<?php echo JURI::base(true);?>/index.php?option=com_thonto&view=khenthuongkyluat&format=raw&task=quatrinhkyluat&idHoso=<?php echo JRequest::getInt('idHoso',null); ?>',function(){
					$.unblockUI();
				});
			});
			clickKTKL++;
		}
	});
	$("#hoso_edit_hosochinh_id").select2({
		allowClear: true,
	    placeholder: "Nhập họ và tên",
	    minimumInputLength: 3,
	    ajax: { 
	        url: "<?php echo JUri::root(true)?>/api.php?task=HOSO&act=HOSOCANBO",
	        dataType: 'jsonp',
	        data: function (term, page) {
	            return {
	                q: term,
	                page_limit: 30
	            };
	        },
	        results: function (data, page) { 
	            return {results: data};
	        }
	    },
	    initSelection: function(element, callback) {
	        var id= $(element).val();
	        if (id!=="") {
	            $.ajax('<?php echo JUri::root(true)?>/api.php?task=HOSO&act=HOSOCANBO', {
	                data: {
	                    user_id: id
	                }
	            }).done(function(data) { callback(data[0]); });
	        }
	    },
	    formatResult: dataFormatResult,
	    formatSelection: dataFormatSelection,
		dropdownCssClass: "bigdrop",
	    escapeMarkup: function (m) { return m; }
	}).on('change', function(){
		if($(this).val() != ''){
			$.blockUI();
			var hosochinh_id = $(this).val();
			$.post('index.php',{option:'com_hoso',controller:'hoso',task:'getInfoForThonto',hosochinh_id:hosochinh_id},function(data){
				if(data['hoten'] != '' && data['hoten'] != null){
					$('#hoso_edit_hoten').val(data['hoten']);
				}
				if(data['ngaysinh'] != '' && data['ngaysinh'] != null){
					$('#hoso_edit_ngaysinh').val(data['ngaysinh']);
				}
				if(data['gioitinh'] != '' && data['gioitinh'] != null){
					$('#hoso_edit_gioitinh').val(data['gioitinh']);
				}

				if(data['thongtinlienhe'] != '' && data['thongtinlienhe'] != null){
					var thongtinlienhe = $.parseJSON(data['thongtinlienhe']);
					if(thongtinlienhe.lienhe_sodienthoai != '' && thongtinlienhe.lienhe_sodienthoai != null){
						$('#hoso_edit_dienthoailienhe').val(thongtinlienhe.lienhe_sodienthoai);
					}
				}
				if(data['email'] != '' && data['email'] != null){
					$('#hoso_edit_email').val(data['email']);
				}
				if(data['dang_danhdaudangvien'] != '' && data['dang_danhdaudangvien'] != null){
					$('#hoso_edit_danhdaudangvien').val(data['dang_danhdaudangvien']);
					if(data['dang_danhdaudangvien'] == '1'){
						$('.hoso_edit_dangvien').show();
					}else{
						$('.hoso_edit_dangvien').hide();
					}
				}
				if(data['party_j_date'] != '' && data['party_j_date'] != null){
					$('#hoso_edit_ngayvaodang').val(data['party_j_date']);
				}
				if(data['party_date'] != '' && data['party_date'] != null){
					$('#hoso_edit_ngaychinhthuc').val(data['party_date']);
				}
				if(data['hoso_trangthai'] == '02'){
					$('#hoso_edit_nghenghiephientai').val('8');
				}else if(data['ins_cap'] != '' && data['ins_cap'] != null){
					$('#hoso_edit_nghenghiephientai').val($('#hoso_edit_nghenghiephientai').find('option[data-caphanhchinh_id="'+data['ins_cap']+'"]').val());
					if($('#hoso_edit_nghenghiephientai').find('option[data-caphanhchinh_id="'+data['ins_cap']+'"]').data('cokiemnhiem') == '1'){
						$('#hoso_edit_congtac_chucvu_kiemnhiem_id').val(data['congtac_chucvu_id']);
						$('#hoso_edit_congtac_chucvu_kiemnhiem').val(data['congtac_chucvu']);
						$('.hoso_edit_kiemnhiem').show();
					}
				}
				if(data['chuyenmon_trinhdo_code'] != '' && data['chuyenmon_trinhdo_code'] != null){
					$('.hoso_edit_chuyenmon').show();
					$('#hoso_edit_chuyenmon_trinhdo_code').val(data['chuyenmon_trinhdo_code']);
					if(data['chuyenmon_trinhdo_mucdo'] != '' && data['chuyenmon_trinhdo_mucdo'] != null){
						$('#hoso_edit_chuyenmon_trinhdo_mucdo').val(data['chuyenmon_trinhdo_mucdo']);
					}
					if(data['chuyenmon_chuyennganh_id'] != '' && data['chuyenmon_chuyennganh_id'] != null){
						$('#hoso_edit_chuyenmon_chuyennganh_id').val(data['chuyenmon_chuyennganh_id']);
					}
					if(data['chuyenmon_chuyennganh'] != '' && data['chuyenmon_chuyennganh'] != null){
						$('#hoso_edit_chuyenmon_chuyennganh').val(data['chuyenmon_chuyennganh']);
					}
					if(data['chuyenmon_truong_id'] != '' && data['chuyenmon_truong_id'] != null){
						$('#hoso_edit_chuyenmon_truong_id').val(data['chuyenmon_truong_id']);
					}
					if(data['chuyenmon_truong'] != '' && data['chuyenmon_truong'] != null){
						$('#hoso_edit_chuyenmon_truong').val(data['chuyenmon_truong']);
					}
					if(data['chuyenmon_namtotnghiep'] != '' && data['chuyenmon_namtotnghiep'] != null){
						$('#hoso_edit_chuyenmon_namtotnghiep').val(data['chuyenmon_namtotnghiep']);
					}
					if(data['chuyenmon_hinhthucdaotao_id'] != '' && data['chuyenmon_hinhthucdaotao_id'] != null){
						$('#hoso_edit_chuyenmon_hinhthucdaotao_id').val(data['chuyenmon_hinhthucdaotao_id']);
					}
					if(data['chuyenmon_loaitotnghiep_id'] != '' && data['chuyenmon_loaitotnghiep_id'] != null){
						$('#hoso_edit_chuyenmon_loaitotnghiep_id').val(data['chuyenmon_loaitotnghiep_id']);
					}
					if(data['chuyenmon_nuocdaotao'] != '' && data['chuyenmon_nuocdaotao'] != null){
						$('#hoso_edit_chuyenmon_nuocdaotao').val($('#hoso_edit_chuyenmon_nuocdaotao').find('option:contains("'+data['chuyenmon_nuocdaotao']+'")').val());
					}
				}else{
					$('.hoso_edit_chuyenmon').hide();
				}
				$.unblockUI();
			});
		}
	});
	$('#hoso_edit_danhdaudangvien').on('change', function(){
		if($(this).val() == '1'){
			$('.hoso_edit_dangvien').show();
		}else{
			$('.hoso_edit_dangvien').hide();
		}
	});
	$('#hoso_edit_congtac_donvi_id').on('change', function(){
		$('#hoso_edit_congtac_donvi').val($(this).find('option:selected').text());
		var loaihinhtochuc_id = $(this).find('option:selected').data('kieu');
		$.post('index.php',{option:'com_thonto',controller:'thonto',task:'getChucvu',loaihinhtochuc_id:loaihinhtochuc_id}, function(data){
			var str = '<option value=""></option>';
			$.each(data,function(i,v){
				str+= '<option value="' + v.id + '">' + v.ten + '</option>';
			});
			$('#hoso_edit_congtac_chucvu_id').html(str);
			$('#hoso_edit_congtac_chucvu_id').change();
		});
	});
	$('#hoso_edit_congtac_chucvu_id').on('change', function(){
		$('#hoso_edit_congtac_chucvu').val($(this).find('option:selected').text());
	});
	$('#hoso_edit_nghenghiephientai').on('change', function(){
		if($(this).find('option:selected').data('cokiemnhiem') == '1'){
			$('.hoso_edit_kiemnhiem').show();
		}else{
			$('.hoso_edit_kiemnhiem').hide();
		}
	});
	$('#hoso_edit_nghenghiephientai').change();
	$('#hoso_edit_chuyenmon_trinhdo_code').on('change', function(){
		if($(this).val() == ''){
			$('.hoso_edit_chuyenmon').hide();
		}else{
			$('.hoso_edit_chuyenmon').show();
		}
	});
	var truong_text = '';
	var truong_id = '';
	$("#hoso_edit_chuyenmon_truong").autoComplete({
		ajax: '<?php echo JUri::root(true);?>/api.php?task=COLLECT&collect=PLACETRAINING',
		minChars: 2,
		onSelect: function(event, ui){
			truong_text = ui.data.value;
			truong_id = ui.data.id;
		}
	});
	$("#hoso_edit_chuyenmon_truong").on("blur.autoComplete",function(){
		if($(this).val() == ''){
			$('#hoso_edit_chuyenmon_truong_id').val('');
		}else if($(this).val() == truong_text){
			$('#hoso_edit_chuyenmon_truong_id').val(truong_id);
		}else{
			$('#hoso_edit_chuyenmon_truong_id').val(-1);
		}
	});
	$('#expand_hoso_edit_chuyenmon_truong').click(function(){
		$('#hoso_edit_chuyenmon_truong').autoComplete('button.ajax');
	});
	var chuyennganh_text = '';
	var chuyennganh_id = '';
	$("#hoso_edit_chuyenmon_chuyennganh").autoComplete({
		ajax: '<?php echo JUri::root(true);?>/api.php?task=COLLECT&collect=LSCODE',
		minChars: 2,
		onSelect: function(event, ui){
			chuyennganh_text = ui.data.value;
			chuyennganh_id = ui.data.id;
		}
	});
	$("#hoso_edit_chuyenmon_chuyennganh").on("blur.autoComplete",function(){
		if($(this).val() == ''){
			$('#hoso_edit_chuyenmon_chuyennganh_id').val('');
		}else if($(this).val() == chuyennganh_text){
			$('#hoso_edit_chuyenmon_chuyennganh_id').val(chuyennganh_id);
		}else{
			$('#hoso_edit_chuyenmon_chuyennganh_id').val(-1);
		}
	});
	$('#expand_hoso_edit_chuyenmon_chuyennganh').click(function(){
		$('#hoso_edit_chuyenmon_chuyennganh').autoComplete('button.ajax');
	});
	$('#hoso_edit_congtac_donvi_id').change();
	$('#HosoEditFrm').validate({
		ignore:true,
		errorPlacement : function(error, element) {
		
		},
		rules: {
			'hoso_edit[hoten]' : { required : true },
			'hoso_edit[ngaysinh]' : { 
				required : true,
				dateVN : true
			},
			'hoso_edit[gioitinh]' : { required : true },
			'hoso_edit[dienthoailienhe]' : { required : true },
			'hoso_edit[danhdaudangvien]' : { required : true },
			'hoso_edit[ngayvaodang]' : { 
				required : function(){
					if($('#hoso_edit_danhdaudangvien').val() == '1'){
						return true;
					}else{
						return false;
					}
				},
				dateVN : true
			},
			'hoso_edit[congtac_donvi_id]' : { required : true },
			'hoso_edit[congtac_chucvu_id]' : { required : true },
			'hoso_edit[congtac_ngaybatdau]' : { 
				required : true,
				dateVN : true
			},
			'hoso_edit[congtac_chucvu_kiemnhiem]' : { 
				required : function(){
					if($('#hoso_edit_nghenghiephientai').find('option:selected').data('cokiemnhiem') == '1'){
						return true;
					}else{
						return false;
					}
				} 
			},
			'hoso_edit[nghenghiephientai]' : { required : true },
			'hoso_edit[chuyenmon_chuyennganh]' : { 
				required : function(){
					if($('#hoso_edit_chuyenmon_trinhdo_code').val() != ''){
						return true;
					}else{
						return false;
					}
				} 
			},
			'hoso_edit[chuyenmon_truong]' : { 
				required : function(){
					if($('#hoso_edit_chuyenmon_trinhdo_code').val() != ''){
						return true;
					}else{
						return false;
					}
				} 
			},
			'hoso_edit[chuyenmon_namtotnghiep]' : { 
				required : function(){
					if($('#hoso_edit_chuyenmon_trinhdo_code').val() != ''){
						return true;
					}else{
						return false;
					}
				} 
			},
			'hoso_edit[chuyenmon_hinhthucdaotao_id]' : { 
				required : function(){
					if($('#hoso_edit_chuyenmon_trinhdo_code').val() != ''){
						return true;
					}else{
						return false;
					}
				} 
			},
			'hoso_edit[chuyenmon_nuocdaotao]' : { 
				required : function(){
					if($('#hoso_edit_chuyenmon_trinhdo_code').val() != ''){
						return true;
					}else{
						return false;
					}
				} 
			},
			'hoso_edit[loaibaohiemyte_id]' : { required : true }
		},
		messages: {
			'hoso_edit[hoten]' : { required : 'Nhập họ tên.' },
			'hoso_edit[ngaysinh]' : { 
				required : 'Nhập ngày sinh.',
				dateVN : 'Nhập đúng định dạng ngày sinh.'
			},
			'hoso_edit[gioitinh]' : { required : 'Chọn giới tính.' },
			'hoso_edit[dienthoailienhe]' : { required : 'Nhập số điện thoại liên hệ.' },
			'hoso_edit[danhdaudangvien]' : { required : 'Chọn Đảng viên.' },
			'hoso_edit[ngayvaodang]' : { 
				required : 'Nhập ngày vào Đảng.',
				dateVN : 'Nhập đúng định dạng ngày vào Đảng.'
			},
			'hoso_edit[congtac_donvi_id]' : { required : 'Chọn thôn, tổ dân phố.' },
			'hoso_edit[congtac_chucvu_id]' : { required : 'Chọn chức vụ.' },
			'hoso_edit[congtac_ngaybatdau]' : { 
				required : 'Nhập ngày bổ nhiệm.',
				dateVN : 'Nhập đúng định dạng ngày bổ nhiệm.'
			},
			'hoso_edit[congtac_chucvu_kiemnhiem]' : { required : 'Nhập chức vụ phường xã kiêm nhiệm.' },
			'hoso_edit[nghenghiephientai]' : { required : 'Chọn nghề nghiệp hiện tại.' },
			'hoso_edit[chuyenmon_chuyennganh]' : { required : 'Nhập hoặc chọn chuyên ngành.' },
			'hoso_edit[chuyenmon_truong]' : { required : 'Nhập hoặc chọn trường.' },
			'hoso_edit[chuyenmon_namtotnghiep]' : { required : 'Nhập năm tốt nghiệp.' },
			'hoso_edit[chuyenmon_hinhthucdaotao_id]' : { required : 'Chọn hình thức đào tạo.' },
			'hoso_edit[chuyenmon_nuocdaotao]' : { required : 'Chọn nước đào tạo.' },
			'hoso_edit[loaibaohiemyte_id]' : { required : 'Chọn loại bảo hiểm y tế.' }
		},
		invalidHandler: function (event, validator) {
			var errors = validator.numberOfInvalids();
			if (errors) {
				var message = errors == 1
				? 'Kiểm tra lỗi sau:<br/>'
				: 'Phát hiện ' + errors + ' lỗi sau:<br/>';
				var errors = "";
				if (validator.errorList.length > 0) {
					for (x=0;x<validator.errorList.length;x++) {
						errors += "<br/>\u25CF " + validator.errorList[x].message;
					}
				}
				loadNoticeBoardError('Thông báo',message + errors);
			}
			validator.focusInvalid();
		}
	});
	/********************** Lưu tổng ************************/
	$('#btn_save_continue_hoso_edit').on('click', function(){
		var flag = $('#HosoEditFrm').valid();
		if(flag == false){
			return flag;
		}else{
			$.blockUI();
			var url = '<?php echo JURI::base(true);?>/index.php?option=com_thonto&controller=thonto&task=capnhatHoso';
			$.post(url,$("#HosoEditFrm").serialize(),function(data){
				if(data == '1'){
					$('#trichngang').load('index.php?option=com_thonto&view=thonto&format=raw&task=viewdanhsach&id_donvi='+$('#id_donvi').val(), function(){
						loadNoticeBoardSuccess('Thông báo','Cập nhật dữ liệu thành công.');
						$.unblockUI();
					});
					$.unblockUI();
				}else{
					loadNoticeBoardError('Thông báo','Có lỗi xảy ra!!! Vui lòng liên hệ quản trị viên.');
					$.unblockUI();
				}
			});
		}
	});
	$('#btn_save_close_hoso_edit').on('click', function(){
		var flag = $('#HosoEditFrm').valid();
		if(flag == false){
			return flag;
		}else{
			$.blockUI();
			var url = '<?php echo JURI::base(true);?>/index.php?option=com_thonto&controller=thonto&task=capnhatHoso';
			$.post(url,$("#HosoEditFrm").serialize(),function(data){
				if(data == '1'){
					$('#trichngang').load('index.php?option=com_thonto&view=thonto&format=raw&task=viewdanhsach&id_donvi='+$('#id_donvi').val(), function(){
						loadNoticeBoardSuccess('Thông báo','Cập nhật dữ liệu thành công.');
						$('#div_list_hoso').show();
						$('#div_detail_hoso').html('');
						$.unblockUI();
					});
				}else{
					loadNoticeBoardError('Thông báo','Có lỗi xảy ra!!! Vui lòng liên hệ quản trị viên.');
					$.unblockUI();
				}
			});
		}
	});
	$('#btn_back_hoso_edit').on('click', function(){
		$('#div_list_hoso').show();
		$('#div_detail_hoso').html('');
	});
});
</script>