<?php
defined ( '_JEXEC' ) or die ( 'Restricted access' );
$item = $this->item;
$donvi = Core::loadAssoc('thonto_tochuc', array('*'), 'id = "'.JRequest::getInt('id_donvi').'"');
?>
<div style="clear: both;"></div>
<form id="HosoAddFrm" name="HosoAddFrm" method="post" class="form-horizontal" enctype="multipart/form-data" action="index.php">
<div style="float:left;width:800px;">
	<div class="control-group">
		<label class="control-label" for="hoso_add_hosochinh_id">Tải hồ sơ từ hệ thống CBCCVC</label>
		<div class="controls">
			<input class="input-xxlarge" id="hoso_add_hosochinh_id" name="hoso_add[hosochinh_id]" value="" />
		</div>
	</div>
</div>
<div style="float:left;width:400px;">
	<div class="control-group">
		<label class="control-label" for="hoso_add_hoten">Họ và tên (<span style="color:red;">*</span>)</label>
		<div class="controls">
			<input type="text" id="hoso_add_hoten" name="hoso_add[hoten]" value="" />
		</div>
	</div>
</div>
<div style="float:left;width:400px;">
	<div class="control-group">
		<label class="control-label" for="hoso_add_ngaysinh">Ngày sinh (<span style="color:red;">*</span>)</label>
		<div class="controls">
			<div class="row-fluid input-append">
				<input type="text" id="hoso_add_ngaysinh" name="hoso_add[ngaysinh]" class="input-small date-picker input-mask-date"
				data-date-format="dd/mm/yyyy" value="" />
				<span class="add-on">
					<i class="icon-calendar"></i>
				</span>
			</div>
		</div>
	</div>
</div>
<div style="float:left;width:400px;">
	<div class="control-group">
		<label class="control-label" for="hoso_add_gioitinh">Giới tính (<span style="color:red;">*</span>)</label>
		<div class="controls">
			<?php echo ThontoHelper::selectBoxAndAttr('',array('id'=>'hoso_add_gioitinh','name'=>'hoso_add[gioitinh]'),'sex_code',array('id','name'),array('status = 1')); ?>
		</div>
	</div>
</div>
<div style="float:left;width:400px;">
	<div class="control-group">
		<label class="control-label" for="hoso_add_dienthoailienhe">Điện thoại liên hệ (<span style="color:red;">*</span>)</label>
		<div class="controls">
			<input type="text" id="hoso_add_dienthoailienhe" name="hoso_add[dienthoailienhe]" value="" />
		</div>
	</div>
</div>
<div style="float:left;width:400px;">
	<div class="control-group">
		<label class="control-label" for="hoso_add_email">Email</label>
		<div class="controls">
			<input type="text" id="hoso_add_email" name="hoso_add[email]" value="" />
		</div>
	</div>
</div>
<div style="float:left;width:400px;">
	<div class="control-group">
		<label class="control-label" for="hoso_add_danhdaudangvien">Đảng viên (<span style="color:red;">*</span>)</label>
		<div class="controls">
			<select id="hoso_add_danhdaudangvien" name="hoso_add[danhdaudangvien]">
				<option value=""></option>
				<option value="0">Không</option>
				<option value="1">Có</option>
			</select>
		</div>
	</div>
</div>
<div style="float:left;width:400px;display:none;" class="hoso_add_dangvien">
	<div class="control-group">
		<label class="control-label" for="hoso_add_ngayvaodang">Ngày vào Đảng (<span style="color:red;">*</span>)</label>
		<div class="controls">
			<div class="row-fluid input-append">
				<input type="text" id="hoso_add_ngayvaodang" name="hoso_add[ngayvaodang]" class="input-small date-picker input-mask-date"
				data-date-format="dd/mm/yyyy" value="" />
				<span class="add-on">
					<i class="icon-calendar"></i>
				</span>
			</div>
		</div>
	</div>
</div>
<div style="float:left;width:400px;display:none;" class="hoso_add_dangvien">
	<div class="control-group">
		<label class="control-label" for="hoso_add_ngaychinhthuc">Ngày chính thức</label>
		<div class="controls">
			<div class="row-fluid input-append">
				<input type="text" id="hoso_add_ngaychinhthuc" name="hoso_add[ngaychinhthuc]" class="input-small date-picker input-mask-date"
				data-date-format="dd/mm/yyyy" value="" />
				<span class="add-on">
					<i class="icon-calendar"></i>
				</span>
			</div>
		</div>
	</div>
</div>
<hr class="span12">
<div style="float:left;width:400px;">
	<div class="control-group">
		<label class="control-label" for="hoso_add_congtac_phuongxa_id">Phường xã (<span style="color:red;">*</span>)</label>
		<div class="controls">
			<input type="hidden" id="hoso_add_phuongxa_donvi" name="hoso_add[congtac_phuongxa]" value="" />
			<?php echo ThontoHelper::selectBoxAndAttr($donvi['id'],
					array('id'=>'hoso_add_congtac_phuongxa_id','name'=>'hoso_add[congtac_phuongxa_id]'),
					'thonto_tochuc',array('id','ten','kieu'),array('trangthai_id = 1 AND kieu = 3')); ?>
		</div>
	</div>
</div>
<div style="float:left;width:400px;">
	<div class="control-group">
		<label class="control-label" for="hoso_add_congtac_thonto_id">Thôn, tổ dân phố (<span style="color:red;">*</span>)</label>
		<div class="controls">
			<input type="hidden" id="hoso_add_congtac_thonto" name="hoso_add[congtac_thonto]" value="" />
			<?php echo ThontoHelper::selectBoxAndAttr($donvi['id'],
					array('id'=>'hoso_add_congtac_thonto_id','name'=>'hoso_add[congtac_thonto_id]'),
					'thonto_tochuc',array('id','ten','kieu'),array('trangthai_id = 1 AND kieu IN (4,5) AND donvi_id = "'.$donvi['donvi_id'].'"')); ?>
		</div>
	</div>
</div>
<div style="float:left;width:400px;">
	<div class="control-group">
		<label class="control-label" for="hoso_add_congtac_chucvu_id">Chức vụ (<span style="color:red;">*</span>)</label>
		<div class="controls">
			<input type="hidden" id="hoso_add_congtac_chucvu" name="hoso_add[congtac_chucvu]" value="" />
			<?php echo ThontoHelper::selectBoxAndAttr('',array('id'=>'hoso_add_congtac_chucvu_id','name'=>'hoso_add[congtac_chucvu_id]'),
					'thonto_chucvu',array('id','ten'),array('trangthai = 1 AND loaihinhtochuc_id = "'.$donvi['kieu'].'"')); ?>
		</div>
	</div>
</div>
<div style="float:left;width:400px;">
	<div class="control-group">
		<label class="control-label" for="hoso_add_congtac_ngaybatdau">Ngày bổ nhiệm (<span style="color:red;">*</span>)</label>
		<div class="controls">
			<div class="row-fluid input-append">
				<input type="text" id="hoso_add_congtac_ngaybatdau" name="hoso_add[congtac_ngaybatdau]" class="input-small date-picker input-mask-date"
				data-date-format="dd/mm/yyyy" value="" />
				<span class="add-on">
					<i class="icon-calendar"></i>
				</span>
			</div>
		</div>
	</div>
</div>
<div style="float:left;width:400px;">
	<div class="control-group">
		<label class="control-label" for="hoso_add_nghenghiephientai">Nghề nghiệp hiện tại (<span style="color:red;">*</span>)</label>
		<div class="controls">
			<?php echo ThontoHelper::selectBoxAndAttr('',array('id'=>'hoso_add_nghenghiephientai','name'=>'hoso_add[nghenghiephientai]'),
					'thonto_nghenghiephientai',array('id','ten','caphanhchinh_id','cokiemnhiem')); ?>
		</div>
	</div>
</div>
<hr class="span12">
<div style="float:left;width:400px;">
	<div class="control-group">
		<label class="control-label" for="hoso_add_chuyenmon_trinhdo_code">Trình độ chuyên môn (<span style="color:red;">*</span>)</label>
		<div class="controls">
			<input type="hidden" id="hoso_add_chuyenmon_trinhdo_mucdo" name="hoso_add[chuyenmon_trinhdo_mucdo]" value="" />
			<?php echo ThontoHelper::selectBoxAndAttr('',array('id'=>'hoso_add_chuyenmon_trinhdo_code','name'=>'hoso_add[chuyenmon_trinhdo_code]'),
					'cla_sca_code',array('code','name','step'),array('tosc_code = 2')); ?>
		</div>
	</div>
</div>
<div style="float:left;width:400px;display:none;" class="hoso_add_chuyenmon">
	<div class="control-group">
		<label class="control-label" for="hoso_add_chuyenmon_truong">Trường (<span style="color:red;">*</span>)</label>
		<div class="controls">
			<div class="row-fluid input-append">
				<input type="text" id="hoso_add_chuyenmon_truong" name="hoso_add[chuyenmon_truong]" class="suggest" value=""/>
				<span class="btn btn-small btn-info" id="expand_hoso_add_chuyenmon_truong"><i class="caret"></i></span>
				<input type="hidden" id="hoso_add_chuyenmon_truong_id" name="hoso_add[chuyenmon_truong_id]" value="" />
			</div>
		</div>
	</div>
</div>
<div style="float:left;width:400px;display:none;" class="hoso_add_chuyenmon">
	<div class="control-group">
		<label class="control-label" for="hoso_add_chuyenmon_chuyennganh">Chuyên ngành (<span style="color:red;">*</span>)</label>
		<div class="controls">
			<div class="row-fluid input-append">
				<input type="text" id="hoso_add_chuyenmon_chuyennganh" name="hoso_add[chuyenmon_chuyennganh]" class="suggest" value=""/>
				<span class="btn btn-small btn-info" id="expand_hoso_add_chuyenmon_chuyennganh"><i class="caret"></i></span>
				<input type="hidden" id="hoso_add_chuyenmon_chuyennganh_id" name="hoso_add[chuyenmon_chuyennganh_id]" value="" />
			</div>
		</div>
	</div>
</div>
<div style="float:left;width:400px;display:none;" class="hoso_add_chuyenmon">
	<div class="control-group">
		<label class="control-label" for="hoso_add_chuyenmon_namtotnghiep">Năm tốt nghiệp (<span style="color:red;">*</span>)</label>
		<div class="controls">
			<input type="text" id="hoso_add_chuyenmon_namtotnghiep" name="hoso_add[chuyenmon_namtotnghiep]" value="" class="input-mini"/>
		</div>
	</div>
</div>
<div style="float:left;width:400px;display:none;" class="hoso_add_chuyenmon">
	<div class="control-group">
		<label class="control-label" for="hoso_add_chuyenmon_hinhthucdaotao_id">Hình thức đào tạo (<span style="color:red;">*</span>)</label>
		<div class="controls">
			<?php echo ThontoHelper::selectBoxAndAttr('',array('id'=>'hoso_add_chuyenmon_hinhthucdaotao_id','name'=>'hoso_add[chuyenmon_hinhthucdaotao_id]'),
					'edu_form',array('id','name'),array('status = 1')); ?>
		</div>
	</div>
</div>
<div style="float:left;width:400px;display:none;" class="hoso_add_chuyenmon">
	<div class="control-group">
		<label class="control-label" for="hoso_add_chuyenmon_loaitotnghiep_id">Loại tốt nghiệp</label>
		<div class="controls">
			<?php echo ThontoHelper::selectBoxAndAttr('',array('id'=>'hoso_add_chuyenmon_loaitotnghiep_id','name'=>'hoso_add[chuyenmon_loaitotnghiep_id]'),
					'degree_code',array('id','name'),array('status = 1')); ?>
		</div>
	</div>
</div>
<div style="float:left;width:400px;display:none;" class="hoso_add_chuyenmon">
	<div class="control-group">
		<label class="control-label" for="hoso_add_chuyenmon_nuocdaotao">Nước đào tạo (<span style="color:red;">*</span>)</label>
		<div class="controls">
			<?php echo ThontoHelper::selectBoxAndAttr('189',array('id'=>'hoso_add_chuyenmon_nuocdaotao','name'=>'hoso_add[chuyenmon_nuocdaotao]'),
					'country_code',array('code','name')); ?>
		</div>
	</div>
</div>
<div style="float:left;width:400px;">
	<div class="control-group">
		<label class="control-label" for="hoso_add_dadaotaonghiepvu">Đã đào tạo nghiệp vụ (<span style="color:red;">*</span>)</label>
		<div class="controls">
			<select id="hoso_add_dadaotaonghiepvu" name="hoso_add[dadaotaonghiepvu]">
				<option value=""></option>
				<option value="0">Không</option>
				<option value="1">Có</option>
			</select>
		</div>
	</div>
</div>
<div style="float:left;width:400px;">
	<div class="control-group">
		<label class="control-label" for="hoso_add_loaibaohiemyte_id">Loại bảo hiểm y tế (<span style="color:red;">*</span>)</label>
		<div class="controls">
			<?php echo ThontoHelper::selectBoxAndAttr('',array('id'=>'hoso_add_loaibaohiemyte_id','name'=>'hoso_add[loaibaohiemyte_id]'),
					'thonto_loaibaohiemyte',array('id','ten'),array('trangthai = 1')); ?>
		</div>
	</div>
</div>
<div style="float:left;width:400px;display:none;" class="hoso_add_kiemnhiem">
	<div class="control-group">
		<label class="control-label" for="hoso_add_congtac_chucvu_kiemnhiem">Chức danh phường xã kiêm nhiệm</label>
		<div class="controls">
			<input type="hidden" id="hoso_add_congtac_chucvu_kiemnhiem_id" name="hoso_add[congtac_chucvu_kiemnhiem_id]" value="" />
			<input type="text" id="hoso_add_congtac_chucvu_kiemnhiem" name="hoso_add[congtac_chucvu_kiemnhiem]" value="" />
		</div>
	</div>
</div>
<div style="float:left;width:400px;">
	<div class="control-group">
		<label class="control-label" for="hoso_add_chucdanhchibo_id">Chức danh chi bộ</label>
		<div class="controls">
			<select id="hoso_add_chucdanhchibo_id" name="hoso_add[chucdanhchibo_id]">
				<option value=""></option>
				<option value="1">Bí thư</option>
				<option value="2">Phó bí thư</option>
				<option value="3">Chức danh khác</option>
			</select>
		</div>
	</div>
</div>
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
	$("#hoso_add_hosochinh_id").select2({
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
					$('#hoso_add_hoten').val(data['hoten']);
				}
				if(data['ngaysinh'] != '' && data['ngaysinh'] != null){
					$('#hoso_add_ngaysinh').val(data['ngaysinh']);
				}
				if(data['gioitinh'] != '' && data['gioitinh'] != null){
					$('#hoso_add_gioitinh').val(data['gioitinh']);
				}

				if(data['thongtinlienhe'] != '' && data['thongtinlienhe'] != null){
					var thongtinlienhe = $.parseJSON(data['thongtinlienhe']);
					if(thongtinlienhe.lienhe_sodienthoai != '' && thongtinlienhe.lienhe_sodienthoai != null){
						$('#hoso_add_dienthoailienhe').val(thongtinlienhe.lienhe_sodienthoai);
					}
				}
				if(data['email'] != '' && data['email'] != null){
					$('#hoso_add_email').val(data['email']);
				}
				if(data['dang_danhdaudangvien'] != '' && data['dang_danhdaudangvien'] != null){
					$('#hoso_add_danhdaudangvien').val(data['dang_danhdaudangvien']);
					if(data['dang_danhdaudangvien'] == '1'){
						$('.hoso_add_dangvien').show();
					}else{
						$('.hoso_add_dangvien').hide();
					}
				}
				if(data['party_j_date'] != '' && data['party_j_date'] != null){
					$('#hoso_add_ngayvaodang').val(data['party_j_date']);
				}
				if(data['party_date'] != '' && data['party_date'] != null){
					$('#hoso_add_ngaychinhthuc').val(data['party_date']);
				}
				if(data['hoso_trangthai'] == '02'){
					$('#hoso_add_nghenghiephientai').val('8');
				}else if(data['ins_cap'] != '' && data['ins_cap'] != null){
					$('#hoso_add_nghenghiephientai').val($('#hoso_add_nghenghiephientai').find('option[data-caphanhchinh_id="'+data['ins_cap']+'"]').val());
					if($('#hoso_add_nghenghiephientai').find('option[data-caphanhchinh_id="'+data['ins_cap']+'"]').data('cokiemnhiem') == '1'){
						$('#hoso_add_congtac_chucvu_kiemnhiem_id').val(data['congtac_chucvu_id']);
						$('#hoso_add_congtac_chucvu_kiemnhiem').val(data['congtac_chucvu']);
						$('.hoso_add_kiemnhiem').show();
					}
				}
				if(data['chuyenmon_trinhdo_code'] != '' && data['chuyenmon_trinhdo_code'] != null){
					$('.hoso_add_chuyenmon').show();
					$('#hoso_add_chuyenmon_trinhdo_code').val(data['chuyenmon_trinhdo_code']);
					if(data['chuyenmon_trinhdo_mucdo'] != '' && data['chuyenmon_trinhdo_mucdo'] != null){
						$('#hoso_add_chuyenmon_trinhdo_mucdo').val(data['chuyenmon_trinhdo_mucdo']);
					}
					if(data['chuyenmon_chuyennganh_id'] != '' && data['chuyenmon_chuyennganh_id'] != null){
						$('#hoso_add_chuyenmon_chuyennganh_id').val(data['chuyenmon_chuyennganh_id']);
					}
					if(data['chuyenmon_chuyennganh'] != '' && data['chuyenmon_chuyennganh'] != null){
						$('#hoso_add_chuyenmon_chuyennganh').val(data['chuyenmon_chuyennganh']);
					}
					if(data['chuyenmon_truong_id'] != '' && data['chuyenmon_truong_id'] != null){
						$('#hoso_add_chuyenmon_truong_id').val(data['chuyenmon_truong_id']);
					}
					if(data['chuyenmon_truong'] != '' && data['chuyenmon_truong'] != null){
						$('#hoso_add_chuyenmon_truong').val(data['chuyenmon_truong']);
					}
					if(data['chuyenmon_namtotnghiep'] != '' && data['chuyenmon_namtotnghiep'] != null){
						$('#hoso_add_chuyenmon_namtotnghiep').val(data['chuyenmon_namtotnghiep']);
					}
					if(data['chuyenmon_hinhthucdaotao_id'] != '' && data['chuyenmon_hinhthucdaotao_id'] != null){
						$('#hoso_add_chuyenmon_hinhthucdaotao_id').val(data['chuyenmon_hinhthucdaotao_id']);
					}
					if(data['chuyenmon_loaitotnghiep_id'] != '' && data['chuyenmon_loaitotnghiep_id'] != null){
						$('#hoso_add_chuyenmon_loaitotnghiep_id').val(data['chuyenmon_loaitotnghiep_id']);
					}
					if(data['chuyenmon_nuocdaotao'] != '' && data['chuyenmon_nuocdaotao'] != null){
						$('#hoso_add_chuyenmon_nuocdaotao').val($('#hoso_add_chuyenmon_nuocdaotao').find('option:contains("'+data['chuyenmon_nuocdaotao']+'")').val());
					}
				}else{
					$('.hoso_add_chuyenmon').hide();
				}
				$.unblockUI();
			});
		}
	});
	$('#hoso_add_danhdaudangvien').on('change', function(){
		if($(this).val() == '1'){
			$('.hoso_add_dangvien').show();
		}else{
			$('.hoso_add_dangvien').hide();
		}
	});
	$('#hoso_add_congtac_phuongxa_id').on('change', function(){
		$('#hoso_add_congtac_phuongxa').val($(this).find('option:selected').text());
		var phuongxa_id = $(this).val();
		$.post('index.php',{option:'com_thonto',controller:'thonto',task:'getThonto',donvi_id:phuongxa_id}, function(data){
			var str = '<option value="" data-kieu=""></option>';
			$.each(data,function(i,v){
				str+= '<option value="' + v.id + '" data-kieu="' + v.kieu + '">' + v.ten + '</option>';
			});
			$('#hoso_add_congtac_thonto_id').html(str);
			$('#hoso_add_congtac_thonto_id').change();
		});
	});
	$('#hoso_add_congtac_thonto_id').on('change', function(){
		$('#hoso_add_congtac_thonto').val($(this).find('option:selected').text());
		var loaihinhtochuc_id = $(this).find('option:selected').data('kieu');
		$.post('index.php',{option:'com_thonto',controller:'thonto',task:'getChucvu',loaihinhtochuc_id:loaihinhtochuc_id}, function(data){
			var str = '<option value=""></option>';
			$.each(data,function(i,v){
				str+= '<option value="' + v.id + '">' + v.ten + '</option>';
			});
			$('#hoso_add_congtac_chucvu_id').html(str);
			$('#hoso_add_congtac_chucvu_id').change();
		});
	});
	$('#hoso_add_congtac_chucvu_id').on('change', function(){
		$('#hoso_add_congtac_chucvu').val($(this).find('option:selected').text());
	});
	$('#hoso_add_nghenghiephientai').on('change', function(){
		if($(this).find('option:selected').data('cokiemnhiem') == '1'){
			$('.hoso_add_kiemnhiem').show();
		}else{
			$('.hoso_add_kiemnhiem').hide();
		}
	});
	$('#hoso_add_chuyenmon_trinhdo_code').on('change', function(){
		if($(this).val() == ''){
			$('.hoso_add_chuyenmon').hide();
		}else{
			$('.hoso_add_chuyenmon').show();
		}
	});
	var truong_text = '';
	var truong_id = '';
	$("#hoso_add_chuyenmon_truong").autoComplete({
		ajax: '<?php echo JUri::root(true);?>/api.php?task=COLLECT&collect=PLACETRAINING',
		minChars: 2,
		onSelect: function(event, ui){
			truong_text = ui.data.value;
			truong_id = ui.data.id;
		}
	});
	$("#hoso_add_chuyenmon_truong").on("blur.autoComplete",function(){
		if($(this).val() == ''){
			$('#hoso_add_chuyenmon_truong_id').val('');
		}else if($(this).val() == truong_text){
			$('#hoso_add_chuyenmon_truong_id').val(truong_id);
		}else{
			$('#hoso_add_chuyenmon_truong_id').val(-1);
		}
	});
	$('#expand_hoso_add_chuyenmon_truong').click(function(){
		$('#hoso_add_chuyenmon_truong').autoComplete('button.ajax');
	});
	var chuyennganh_text = '';
	var chuyennganh_id = '';
	$("#hoso_add_chuyenmon_chuyennganh").autoComplete({
		ajax: '<?php echo JUri::root(true);?>/api.php?task=COLLECT&collect=LSCODE',
		minChars: 2,
		onSelect: function(event, ui){
			chuyennganh_text = ui.data.value;
			chuyennganh_id = ui.data.id;
		}
	});
	$("#hoso_add_chuyenmon_chuyennganh").on("blur.autoComplete",function(){
		if($(this).val() == ''){
			$('#hoso_add_chuyenmon_chuyennganh_id').val('');
		}else if($(this).val() == chuyennganh_text){
			$('#hoso_add_chuyenmon_chuyennganh_id').val(chuyennganh_id);
		}else{
			$('#hoso_add_chuyenmon_chuyennganh_id').val(-1);
		}
	});
	$('#expand_hoso_add_chuyenmon_chuyennganh').click(function(){
		$('#hoso_add_chuyenmon_chuyennganh').autoComplete('button.ajax');
	});
	$('#hoso_add_congtac_thonto_id').change();
	$('#HosoAddFrm').validate({
		ignore:true,
		errorPlacement : function(error, element) {
		
		},
		rules: {
			'hoso_add[hoten]' : { required : true },
			'hoso_add[ngaysinh]' : { 
				required : true,
				dateVN : true
			},
			'hoso_add[gioitinh]' : { required : true },
			'hoso_add[dienthoailienhe]' : { required : true },
			'hoso_add[danhdaudangvien]' : { required : true },
			'hoso_add[ngayvaodang]' : { 
				required : function(){
					if($('#hoso_add_danhdaudangvien').val() == '1'){
						return true;
					}else{
						return false;
					}
				},
				dateVN : true
			},
			'hoso_add[congtac_thonto_id]' : { required : true },
			'hoso_add[congtac_chucvu_id]' : { required : true },
			'hoso_add[congtac_ngaybatdau]' : { 
				required : true,
				dateVN : true
			},
			'hoso_add[congtac_chucvu_kiemnhiem]' : { 
				required : function(){
					if($('#hoso_add_nghenghiephientai').find('option:selected').data('cokiemnhiem') == '1'){
						return true;
					}else{
						return false;
					}
				} 
			},
			'hoso_add[nghenghiephientai]' : { required : true },
			'hoso_add[chuyenmon_chuyennganh]' : { 
				required : function(){
					if($('#hoso_add_chuyenmon_trinhdo_code').val() != ''){
						return true;
					}else{
						return false;
					}
				} 
			},
			'hoso_add[chuyenmon_truong]' : { 
				required : function(){
					if($('#hoso_add_chuyenmon_trinhdo_code').val() != ''){
						return true;
					}else{
						return false;
					}
				} 
			},
			'hoso_add[chuyenmon_namtotnghiep]' : { 
				required : function(){
					if($('#hoso_add_chuyenmon_trinhdo_code').val() != ''){
						return true;
					}else{
						return false;
					}
				} 
			},
			'hoso_add[chuyenmon_hinhthucdaotao_id]' : { 
				required : function(){
					if($('#hoso_add_chuyenmon_trinhdo_code').val() != ''){
						return true;
					}else{
						return false;
					}
				} 
			},
			'hoso_add[chuyenmon_nuocdaotao]' : { 
				required : function(){
					if($('#hoso_add_chuyenmon_trinhdo_code').val() != ''){
						return true;
					}else{
						return false;
					}
				} 
			},
			'hoso_add[loaibaohiemyte_id]' : { required : true }
		},
		messages: {
			'hoso_add[hoten]' : { required : 'Nhập họ tên.' },
			'hoso_add[ngaysinh]' : { 
				required : 'Nhập ngày sinh.',
				dateVN : 'Nhập đúng định dạng ngày sinh.'
			},
			'hoso_add[gioitinh]' : { required : 'Chọn giới tính.' },
			'hoso_add[dienthoailienhe]' : { required : 'Nhập số điện thoại liên hệ.' },
			'hoso_add[danhdaudangvien]' : { required : 'Chọn Đảng viên.' },
			'hoso_add[ngayvaodang]' : { 
				required : 'Nhập ngày vào Đảng.',
				dateVN : 'Nhập đúng định dạng ngày vào Đảng.'
			},
			'hoso_add[congtac_thonto_id]' : { required : 'Chọn thôn, tổ dân phố.' },
			'hoso_add[congtac_chucvu_id]' : { required : 'Chọn chức vụ.' },
			'hoso_add[congtac_ngaybatdau]' : { 
				required : 'Nhập ngày bổ nhiệm.',
				dateVN : 'Nhập đúng định dạng ngày bổ nhiệm.'
			},
			'hoso_add[congtac_chucvu_kiemnhiem]' : { required : 'Nhập chức vụ phường xã kiêm nhiệm.' },
			'hoso_add[nghenghiephientai]' : { required : 'Chọn nghề nghiệp hiện tại.' },
			'hoso_add[chuyenmon_chuyennganh]' : { required : 'Nhập hoặc chọn chuyên ngành.' },
			'hoso_add[chuyenmon_truong]' : { required : 'Nhập hoặc chọn trường.' },
			'hoso_add[chuyenmon_namtotnghiep]' : { required : 'Nhập năm tốt nghiệp.' },
			'hoso_add[chuyenmon_hinhthucdaotao_id]' : { required : 'Chọn hình thức đào tạo.' },
			'hoso_add[chuyenmon_nuocdaotao]' : { required : 'Chọn nước đào tạo.' },
			'hoso_add[loaibaohiemyte_id]' : { required : 'Chọn loại bảo hiểm y tế.' }
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
});
</script>