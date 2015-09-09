<script type="text/javascript">
var showbienche = function(){
	var bc_hinhthuc_id = jQuery('#bc_hinhthuc_id').val();
	jQuery('#bc_ngaybatdau').removeClass('required dateVN validNgayBCHD').closest('.control-group').removeClass('error');
	jQuery('#bc_ngayketthuc').removeClass('required dateVN validNgayBCHD').closest('.control-group').removeClass('error');
	jQuery('#bc_soquyetdinh').removeClass('required dateVN validNgayBCHD').closest('.control-group').removeClass('error');
	jQuery('#bc_coquanquyetdinh').removeClass('required dateVN validNgayBCHD').closest('.control-group').removeClass('error');
	jQuery('#bc_ngaybanhanh').removeClass('required dateVN validNgayBCHD').closest('.control-group').removeClass('error');
	if(bc_hinhthuc_id == null || bc_hinhthuc_id == ''){
		jQuery('#bienche_code').val('');
		jQuery('.div_ngaybatdau').hide();
		jQuery('.div_thoihan').hide();
		jQuery('.div_hinhthuctuyendung').hide();
		jQuery('.div_ngayketthuc').hide();
		jQuery('.div_soqd').hide();
		jQuery('.div_coquanqd').hide();
		jQuery('.div_ngaybanhanh').hide();
	}else{
		jQuery('#bienche_code').val(jQuery('#bc_hinhthuc_id').find('option:selected').data('loaihinh_id'));
		jQuery.ajax({
			type: "POST",
			url: "index.php?option=com_hoso&amp;view=congtac&amp;task=getHinhthucInfo&amp;format=raw",
			data: {bc_hinhthuc_id:bc_hinhthuc_id},
			success:function(data){
				if(data != undefined &amp;&amp; data.is_hinhthuctuyendung != null &amp;&amp; data.is_hinhthuctuyendung != '' ){
					jQuery.ajax({
						type: "POST",
						url: "index.php?option=com_hoso&amp;view=congtac&amp;task=getHinhthucTuyendung&amp;format=raw",
						data: {bc_hinhthuc_id:bc_hinhthuc_id},
						success:function(data_hinhthuctuyendung){
							var xhtml = '&lt;option value=""&gt;&lt;/option&gt;';
							if(data_hinhthuctuyendung !== undefined &amp;&amp; data_hinhthuctuyendung.length &gt; 0 ){
								jQuery.each(data_hinhthuctuyendung, function(i,v){
									xhtml += '&lt;option value="' + v.id + '"&gt;' + v.name + '&lt;/option&gt;';
								});
								jQuery('#bc_hinhthuctuyendung_id').html(xhtml);
								jQuery('#bc_hinhthuctuyendung_id').addClass('required');
								jQuery('.div_hinhthuctuyendung').show();
							}else{
								jQuery('#bc_hinhthuctuyendung_id').html(xhtml);
								jQuery('#bc_hinhthuctuyendung_id').removeClass('required');
								jQuery('.div_hinhthuctuyendung').hide();
							}
						}
					});
				}else{
					jQuery('#bc_hinhthuctuyendung_id').removeClass('required');
					jQuery('.div_hinhthuctuyendung').hide();
					jQuery('#bc_hinhthuctuyendung_id').val('');
				}
				if(data != undefined &amp;&amp; data.text_ngaybatdau != null &amp;&amp; data.text_ngaybatdau != '' ){
					if(data.valid_ngaybatdau == 'required'){
						jQuery('#lbl_ngaybatdau').html(data.text_ngaybatdau + ' (&lt;span style="color:red;"&gt;*&lt;/span&gt;)');
					}else{
						jQuery('#lbl_ngaybatdau').html(data.text_ngaybatdau);
					}
					jQuery('.div_ngaybatdau').show();
					jQuery('#bc_ngaybatdau').addClass(data.valid_ngaybatdau);
				}else{
					jQuery('#bc_ngaybatdau').val('');
					jQuery('.div_ngaybatdau').hide();
				}
				if(data != undefined &amp;&amp; data.is_thietlapthoihan != null &amp;&amp; data.is_thietlapthoihan != '' ){
					jQuery.ajax({
						type: "POST",
						url: "index.php?option=com_hoso&amp;view=congtac&amp;task=getThoihan&amp;format=raw",
						data: {bc_hinhthuc_id:bc_hinhthuc_id},
						success:function(data){
							var xhtml = '&lt;option value="" month="0"&gt;&lt;/option&gt;';
							if(data !== undefined &amp;&amp; data.length &gt; 0 ){
								jQuery.each(data,function(i,v){
									xhtml += '&lt;option value="' + v.id + '" month="' + v.month + '"&gt;' + v.name + '&lt;/option&gt;';
								});
								jQuery('#bc_thoihanbienchehopdong_id').html(xhtml);
								jQuery('#bc_thoihanbienchehopdong_id').addClass('required');
								jQuery('.div_thoihan').show();
								jQuery('#bc_ngayketthuc').attr('readonly','readonly');
								jQuery('#bc_thoihanbienchehopdong_id').on('change',function(){
									var month = jQuery(this).find('option:selected').attr('month');
									if(month &lt; 0){
										jQuery('#bc_ngayketthuc').removeAttr('readonly');
										jQuery('#bc_ngayketthuc').val('');
									}else{
										if(jQuery('#bc_ngaybatdau').val() != ''){
											var arrBegin = jQuery('#bc_ngaybatdau').val().split("/");
											if(arrBegin.length == 3){
												total_month = (parseInt(arrBegin[1]) + parseInt(month));
												if(parseInt(total_month%12) == 0){
													monthEnd = '01';
												}else if(parseInt(total_month%12) &lt; 10){
													monthEnd = '0' + total_month%12;
												}else{
													monthEnd = total_month%12
												}
												yearEnd = parseInt(total_month/12) + parseInt(arrBegin[2]);
												dateEnd = arrBegin[0] + '/' + monthEnd + '/' + yearEnd;
												jQuery('#bc_ngayketthuc').val(dateEnd);
											}
										}
										jQuery('#bc_ngayketthuc').attr('readonly','readonly');
									}
								});
							}else{
								jQuery('#bc_thoihanbienchehopdong_id').html(xhtml);
								jQuery('#bc_thoihanbienchehopdong_id').removeClass('required');
								jQuery('.div_thoihan').hide();
								jQuery('#bc_ngayketthuc').removeAttr('readonly');
								jQuery('#bc_ngayketthuc').val('');
							}
						}
					});
				}else{
					jQuery('#bc_thoihanbienchehopdong_id').removeClass('required');
					jQuery('.div_thoihan').hide();
					jQuery('#bc_thoihanbienchehopdong_id').val('');
				}
				if(data != undefined &amp;&amp; data.text_ngayketthuc != null &amp;&amp; data.text_ngayketthuc != '' ){
					if(data.valid_ngayketthuc == 'required'){
						jQuery('#lbl_ngayketthuc').html(data.text_ngayketthuc + ' (&lt;span style="color:red;"&gt;*&lt;/span&gt;)');
					}else{
						jQuery('#lbl_ngayketthuc').html(data.text_ngayketthuc);
					}
					jQuery('.div_ngayketthuc').show();
					jQuery('#bc_ngayketthuc').addClass(data.valid_ngayketthuc);
				}else{
					jQuery('#bc_ngayketthuc').val('');
					jQuery('.div_ngayketthuc').hide();
				}
				if(data != undefined &amp;&amp; data.text_soquyetdinh != null &amp;&amp; data.text_soquyetdinh != '' ){
					if(data.valid_soquyetdinh == 'required'){
						jQuery('#lbl_soqd').html(data.text_soquyetdinh + ' (&lt;span style="color:red;"&gt;*&lt;/span&gt;)');
					}else{
						jQuery('#lbl_soqd').html(data.text_soquyetdinh);
					}
					jQuery('.div_soqd').show();
					jQuery('#bc_soquyetdinh').addClass(data.valid_soquyetdinh);
				}else{
					jQuery('#bc_soquyetdinh').val('');
					jQuery('.div_soqd').hide();
				}
				if(data != undefined &amp;&amp; data.text_coquanraquyetdinh != null &amp;&amp; data.text_coquanraquyetdinh != '' ){
					if(data.valid_coquanraquyetdinh == 'required'){
						jQuery('#lbl_coquanqd').html(data.text_coquanraquyetdinh + ' (&lt;span style="color:red;"&gt;*&lt;/span&gt;)');
					}else{
						jQuery('#lbl_coquanqd').html(data.text_coquanraquyetdinh);
					}
					jQuery('.div_coquanqd').show();
					jQuery('#bc_coquanquyetdinh').addClass(data.valid_coquanraquyetdinh);
				}else{
					jQuery('#bc_coquanquyetdinh').val('');
					jQuery('.div_coquanqd').hide();
				}
				if(data != undefined &amp;&amp; data.text_ngaybanhanh != null &amp;&amp; data.text_ngaybanhanh != '' ){
					if(data.valid_ngaybanhanh == 'required'){
						jQuery('#lbl_ngaybanhanh').html(data.text_ngaybanhanh + ' (&lt;span style="color:red;"&gt;*&lt;/span&gt;)');
					}else{
						jQuery('#lbl_ngaybanhanh').html(data.text_ngaybanhanh);
					}
					jQuery('.div_ngaybanhanh').show();
					jQuery('#bc_ngaybanhanh').addClass(data.valid_ngaybanhanh);
				}else{
					jQuery('#bc_ngaybanhanh').val('');
					jQuery('.div_ngaybanhanh').hide();
				}
			}
		});
	}
};
var showDoituongDaotao = function(){
	var check47 = 0;
	var check393 = 0;
	jQuery('input[name="check_doituong[]"]').each(function(i){
		if(jQuery(this).is(':checked') &amp;&amp; jQuery('input[name="doituong_id[]"]').eq(i).val() == '1' &amp;&amp; jQuery('.cbxLoaiDT').eq(i).val() == '1'){
			check47 = 1;
		}
		if(jQuery(this).is(':checked') &amp;&amp; jQuery('input[name="doituong_id[]"]').eq(i).val() == '1' &amp;&amp; jQuery('.cbxLoaiDT').eq(i).val() == '2'){
			check393 = 1;
		}
	});
	if(check393 == 1){
		if(jQuery('input[name="check_doituong[]"]:checked').length &gt; 2){
			jQuery('#check_doituong_dt').removeAttr('disabled');
			jQuery('#lbl_check_doituong').html('');
			jQuery('#doituong_id_dt').val('');
			jQuery('#loaidoituong_id_dt').val('');
			jQuery('#div_check_doituong').hide();
		}else{
			jQuery('#check_doituong_dt').attr('disabled','disabled');
			jQuery('#lbl_check_doituong').html(' Trình độ trên là trình độ theo Đề án 922 bậc sau ĐH (393,56)');
			jQuery('#doituong_id_dt').val('1');
			jQuery('#loaidoituong_id_dt').val('2');
			jQuery('#div_check_doituong').show();
		}
	}else{
		if(jQuery('input[name="check_doituong[]"]:checked').length == '1'){
			var row_index =  jQuery('input[name="check_doituong[]"]').index(jQuery('input[name="check_doituong[]"]:checked'));
			jQuery('#check_doituong_dt').removeAttr('disabled');
			jQuery('#lbl_check_doituong').html(' Trình độ trên là trình độ theo '+jQuery('input[name="check_doituong[]"]:checked').next().text());
			jQuery('#doituong_id_dt').val(jQuery('input[name="doituong_id[]"]').eq(row_index).val());
			jQuery('#loaidoituong_id_dt').val(jQuery('.cbxLoaiDT').eq(row_index).val());
			jQuery('#div_check_doituong').show();
		}else{
			jQuery('#check_doituong_dt').removeAttr('disabled');
			jQuery('#lbl_check_doituong').html('');
			jQuery('#doituong_id_dt').val('');
			jQuery('#loaidoituong_id_dt').val('');
			jQuery('#div_check_doituong').hide();
		}
	}
};
var validHoso = function(){
	var url = '/index.php?option=com_hoso&amp;view=thongtinchung&amp;format=raw&amp;task=checkHosoTrung';
		url+= '&amp;id_donvi='+jQuery('#inst_code').val();
		url+= '&amp;hoten='+jQuery('#e_name').val();
	if(jQuery('#is_only_year').val() == '0'){
		url+= '&amp;ngaysinh='+jQuery('#birth_date').val();
	}else{
		url+= '&amp;ngaysinh=31/12/'+jQuery('#birth_date').val();
	}
	jQuery.post(url,function(data){
		if(data == 'hoso_trung'){
			loadNoticeBoardError('Thông báo','Hồ sơ này đã tồn tại tại đơn vị, đề nghị cập nhật hồ sơ hiện có');
			jQuery.unblockUI();
			return false;
		}else if(data == 'choxacnhan'){
			loadNoticeBoardError('Thông báo','Hồ sơ này đang được điều động đến đơn vị và chờ cấp có thẩm quyền xác nhận, đề nghị không nhập hồ sơ mới và chờ đến khi hồ sơ được điều động thành công đến đơn vị');
			jQuery.unblockUI();
			return false;
		}else if(data == 'chotiepnhan'){
			loadNoticeBoardError('Thông báo','Hồ sơ này đã được điều động đến đơn vị và chờ tiếp nhận, đề nghị vào thẻ điều động để tiếp nhận hồ sơ');
			jQuery.unblockUI();
			return false;
		}else if(data == 'error'){
			loadNoticeBoardError('Thông báo','Có lỗi xảy ra. Vui lòng liên hệ quản trị viên!');
			jQuery.unblockUI();
			return false;
		}else{
			var url_ngaycongtac = '/index.php?option=com_hoso&amp;controller=hoso&amp;task=checkNgaycongtac';
			var ngaycongtac = jQuery('#rpos_date').val();
			jQuery.post(url_ngaycongtac, { ngaycongtac : ngaycongtac },function(data){
				if(data == '0'){
					loadNoticeBoardError('Thông báo','Ngày bắt đầu vị trí tại phòng phải nhỏ hơn hoặc bằng ngày hiện tại.');
					jQuery.unblockUI();
					return false;
				}else{
					document.frmHosoAdd.submit();
				}
			});
		}
	});
}
jQuery(document).ready(function($){
	/* ********************************* Thông tin chung ********************************* */
	$('.date-picker').datepicker({
        startDate: "01/01/1900",
        endDate: "01/01/3000"
    }).next().on(ace.click_event, function(){
		$(this).prev().focus();
	});
	$('.input-mask-date').mask('39/19/2999');
	$('#is_only_year').on('click', function(){
		var str_birthdate =  '';
		if($(this).is(':checked')){
			$(this).val('1');
			str_birthdate+= '&lt;input class="input-mini" type="text" name="birth_date" id="birth_date" value="" /&gt;';
			$('.div_birth_date').html(str_birthdate);
		}else{
			$(this).val('0');
			str_birthdate+= '&lt;input class="input-small date-picker input-mask-date" type="text" name="birth_date" id="birth_date" value="" data-date-format="dd/mm/yyyy"/&gt;';
			str_birthdate+= '&lt;span class="add-on"&gt;';
			str_birthdate+= '&lt;i class="icon-calendar"&gt;&lt;/i&gt;';
			str_birthdate+= '&lt;/span&gt;';
			$('.div_birth_date').html(str_birthdate);
			$('.date-picker').datepicker({
		        startDate: "01/01/1900",
		        endDate: "01/01/3000"
		    }).next().on(ace.click_event, function(){
				$(this).prev().focus();
			});
			$('.input-mask-date').mask('39/19/2999');
		}
	});
	$('#inst_code').chosen({width:'500px',search_contains: true}).on('change', function(){
		var id_donvi = $(this).val();
		$.ajax({
			type: "POST",
			url: "index.php?option=com_hoso&amp;view=congtac&amp;format=raw",
			data: {id_donvi:id_donvi,task:'getOptHinhthucBienche'},
			success:function(data){
				var strPos = '&lt;option value=""&gt;&lt;/option&gt;';
				if(data !== undefined || data.length &gt; 0){
					$.each(data,function(i,v){
						strPos+= "&lt;option value='"+v.id+"'&gt;"+v.name+"&lt;/option&gt;";
					});
				}
				$('#bc_hinhthuc_id').html(strPos);
			}
		});
		$.ajax({
			type: "POST",
			url: "index.php?option=com_hoso&amp;view=luong&amp;format=raw",
			data: {id_donvi:id_donvi,task:'getOptHinhthucHuongluong'},
			success:function(data){
				var strPos = '&lt;option value=""&gt;&lt;/option&gt;';
				if(data !== undefined || data.length &gt; 0){
					$.each(data,function(i,v){
						strPos+= "&lt;option value='"+v.id+"'&gt;"+v.name+"&lt;/option&gt;";
					});
				}
				$('#whois_sal').html(strPos);
			}
		});
		$.ajax({
			type: "POST",
			url: "index.php?option=com_hoso&amp;view=congtac&amp;format=raw",
			data: {id_donvi:id_donvi,task:'getOptPhong'},
			success:function(data){
				var strDept = '&lt;option value=""&gt;&lt;/option&gt;';
				if(data !== undefined &amp;&amp; data.length &gt; 0){
					$.each(data,function(i,v){
						strDept+= "&lt;option value='"+v.id+"'&gt;"+v.name+"&lt;/option&gt;";
					});
					$('#dept_code').closest('.span5').show();
				}else{
					$('#dept_code').closest('.span5').hide();
				}
				$('#dept_code').html(strDept);
			}
		});
		$.ajax({
			type: "POST",
			url: "index.php?option=com_hoso&amp;view=congtac&amp;format=raw",
			data: {id_donvi:id_donvi,task:'getOptChucvu'},
			success:function(data){
				var strPos = '&lt;option value=""&gt;Không chức vụ&lt;/option&gt;';
				if(data !== undefined || data.length &gt; 0){
					$.each(data,function(i,v){
						strPos+= "&lt;option value='"+v.mangach+"'&gt;"+v.tencap+"&lt;/option&gt;";
					});
				}
				$('#pos_sys_fk').html(strPos);
			}
		});
		$('#inst_name').val($(this).find('option:selected').text());
	});
	$('#inst_name').val($('#inst_code').find('option:selected').text());
	$("#dangvien").on('change',function(){
		var dangvien = $(this).val();
		if(dangvien == 1){
			$(".dangvien").show();
			$("#party_j_date").addClass('dateVN').attr('title','Nhập đúng định dạng ngày kết nạp Đảng trong thẻ "Thông tin chung"');
		}else{
			$(".dangvien").hide();
			$("#party_j_date").val('');
			$("#party_j_date").removeClass('dateVN').removeAttr('title');
			$("#party_date").val('');
			$("#committ_pos_code").val('');
		}
	});
	$('#committ_pos_code').on('change', function(){
		if($(this).val() == ''){
			$('.qtdangvien').hide();
			$('#start_date_ctd').val('');
			$('#donvidang_ctd').val('');
		}else{
			$('.qtdangvien').show();
		}
	});
	/* ********************************* Biên chế; Chức vụ; Ngạch, bậc ********************************* */
	$('input[name="check_doituong[]"]').on('click', function(){
		var row_index = $('input[name="check_doituong[]"]').index($(this));
		if($(this).is(':checked')){
			if($('input[name="doituong_id[]"]').eq(row_index).val() == '1'){
				$('.td_doituong').eq(row_index).find('.span3').show();
			}else{
				if($('.td_doituong').eq(row_index).find('.span6').length &gt; 0){
					$('.td_doituong').eq(row_index).find('.span6').show();
				}else{
					$('.td_doituong').eq(row_index).find('.span3').show();
				}
			}
			$('input[name="doituong_selected[]"]').eq(row_index).val('1');
		}else{
			if($('input[name="doituong_id[]"]').eq(row_index).val() == '1'){
				$('.td_doituong').eq(row_index).find('.span3').hide();
			}else{
				if($('.td_doituong').eq(row_index).find('.span6').length &gt; 0){
					$('.cbxLoaiDT').eq(row_index).val('');
					$('.cbxLoaiDT').eq(row_index).change();
					$('.td_doituong').eq(row_index).find('.span6').hide();
				}else{
					$('.td_doituong').eq(row_index).find('.span3').hide();
				}
			}
			$('input[name="doituong_selected[]"]').eq(row_index).val('0');
		}
		showDoituongDaotao();
	});
	$('.cbxLoaiDT').on('change', function(){
		var row_index = $('.cbxLoaiDT').index($(this));
		var text_soqd_cudihoc = $(this).find('option:selected').data('text_soqd_cudihoc');
		if(text_soqd_cudihoc != ''){
			var valid_soqd_cudihoc = $(this).find('option:selected').data('valid_soqd_cudihoc');
			if(valid_soqd_cudihoc == 'required'){
				str_valid_soqd_cudihoc = ' (&lt;span style="color:red;"&gt;*&lt;/span&gt;)';
			}else{
				str_valid_soqd_cudihoc = '';
			}
			$('label[for="soqd_cudihoc[]"]').eq(row_index).closest('.span3').show();
			$('label[for="soqd_cudihoc[]"]').eq(row_index).html(text_soqd_cudihoc + str_valid_soqd_cudihoc);
		}else{
			$('label[for="soqd_cudihoc[]"]').eq(row_index).closest('.span3').hide();
		}
		var text_ngay_cudihoc = $(this).find('option:selected').data('text_ngay_cudihoc');
		if(text_ngay_cudihoc != ''){
			var valid_ngay_cudihoc = $(this).find('option:selected').data('valid_ngay_cudihoc');
			if(valid_ngay_cudihoc == 'required'){
				str_valid_ngay_cudihoc = ' (&lt;span style="color:red;"&gt;*&lt;/span&gt;)';
			}else{
				str_valid_ngay_cudihoc = '';
			}
			$('label[for="ngay_cudihoc[]"]').eq(row_index).closest('.span3').show();
			$('label[for="ngay_cudihoc[]"]').eq(row_index).html(text_ngay_cudihoc + str_valid_ngay_cudihoc);
		}else{
			$('label[for="ngay_cudihoc[]"]').eq(row_index).closest('.span3').hide();
		}
		var text_soqd_botri = $(this).find('option:selected').data('text_soqd_botri');
		if(text_soqd_botri != ''){
			var valid_soqd_botri = $(this).find('option:selected').data('valid_soqd_botri');
			if(valid_soqd_botri == 'required'){
				str_valid_soqd_botri = ' (&lt;span style="color:red;"&gt;*&lt;/span&gt;)';
			}else{
				str_valid_soqd_botri = '';
			}
			$('label[for="soqd_botri[]"]').eq(row_index).closest('.span3').show();
			$('label[for="soqd_botri[]"]').eq(row_index).html(text_soqd_botri + str_valid_soqd_botri);
		}else{
			$('label[for="soqd_botri[]"]').eq(row_index).closest('.span3').hide();
		}
		var text_ngay_botri = $(this).find('option:selected').data('text_ngay_botri');
		if(text_ngay_botri != ''){
			var valid_ngay_botri = $(this).find('option:selected').data('valid_ngay_botri');
			if(valid_ngay_botri == 'required'){
				str_valid_ngay_botri = ' (&lt;span style="color:red;"&gt;*&lt;/span&gt;)';
			}else{
				str_valid_ngay_botri = '';
			}
			$('label[for="ngay_botri[]"]').eq(row_index).closest('.span3').show();
			$('label[for="ngay_botri[]"]').eq(row_index).html(text_ngay_botri + str_valid_ngay_botri);
		}else{
			$('label[for="ngay_botri[]"]').eq(row_index).closest('.span3').hide();
		}
	});
	$('#money_sal_show').on('blur', function(e){
		$('#money_sal').val($(this).val().replace(/\./g,'').replace(/\,/g,'.'));
	});
	$('.chzn-select').chosen({width:'220px',search_contains: true});
	var ktraVK = function(){
		var mangach = $("#sta_code").val();
		var bac = $("#sl_code").val();
		if(mangach != ''){
			$.ajax({
				type: "POST",
				url: "index.php?option=com_hoso&amp;view=congtac&amp;task=ktraVK&amp;format=raw",
				data: {mangach:mangach, bac:bac},
				success:function(data){
					if(data == 1){
						$('.vk').show();
					}else{
						$('.vk').hide();
					}
				}
			});
		}
	};
	showbienche();
	$('#bc_hinhthuc_id').on('change',function(){
		showbienche();
	});
	$('#bc_ngaybatdau').on('blur',function(){
		var month = $('#bc_thoihanbienchehopdong_id').find('option:selected').attr('month');
		if($(this).val() != '' &amp;&amp; month &gt; 0){
			var arrBegin = $(this).val().split("/");
			if(arrBegin.length == 3){
				total_month = (parseInt(arrBegin[1]) + parseInt(month));
				if(parseInt(total_month%12) == 0){
					monthEnd = '01';
				}else if(parseInt(total_month%12) &lt; 10){
					monthEnd = '0' + total_month%12;
				}else{
					monthEnd = total_month%12
				}
				yearEnd = parseInt(total_month/12) + parseInt(arrBegin[2]);
				dateEnd = arrBegin[0] + '/' + monthEnd + '/' + yearEnd;
				$('#bc_ngayketthuc').val(dateEnd);
			}
		}
	});
	$.validator.addMethod("validNgayBCHD", function(value, element) {
		var tungay = $('#bc_ngaybatdau');
		var denngay = $('#bc_ngayketthuc');
		if(tungay.val() != '' &amp;&amp; denngay.val() != ''){
			if(compareDate(tungay.val(),denngay.val()) == -1){
				tungay.addClass('valid').removeClass('error');
				denngay.addClass('valid').removeClass('error');
				return true;
			}else{
				tungay.addClass('error').removeClass('valid');
				denngay.addClass('error').removeClass('valid');
				return false;
			}
		}else{
			tungay.addClass('valid').removeClass('error');
			denngay.addClass('valid').removeClass('error');
			return true;
		}
	}, 'Ngày kết thúc biên chế, hợp đồng phải lớn hơn ngày bắt đầu trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"');
	$('#sta_code').on('change', function(){
		$('#sta_name').val($(this).find('option:selected').text());
		var mangach = $('#sta_code').val();
		var str_bac = '&lt;option value="" heso=""&gt;&lt;/option&gt;';
		if(mangach == ''){
			$('#sl_code').html(str_bac);
		}else{
			$.ajax({
				type: "POST",
				url: "index.php?option=com_hoso&amp;view=congtac&amp;task=getBac&amp;format=raw",
				data: {mangach:mangach},
				success:function(data){
					if(data !== undefined &amp;&amp; data.length &gt; 0 ){
						$.each(data,function(i,v){
							str_bac += '&lt;option value="' + v.idbac + '" heso="' + v.heso + '"&gt;' + v.idbac + '&lt;/option&gt;';
						});
					}
					$('#sl_code').html(str_bac);
				}
			});
		}
		$('#hs').html('');
		$('#coef_code').val('');
		ktraVK();
	});
	$('#sl_code').on('change', function(){
		$('#hs').html($(this).find('option:selected').attr('heso'));
		$('#coef_code').val($(this).find('option:selected').attr('heso'));
		ktraVK();
	});
	if($("#dept_code option").length &gt;1){
		$("#dvphong").html('Phòng công tác (&lt;span style="color:red;"&gt;*&lt;/span&gt;)');
	}else{
		$("#dvphong").html('Phòng công tác');
	}
	$('#dept_code').on('change', function(){
		$('#dept_name').val($(this).find('option:selected').text());
	});
	$("#pos_sys_fk").on('change', function(){
		var position = $("#pos_sys_fk option:selected").text();
		var pos_td = $("#pos_sys_fk option:selected").data('pos_td');
		var pos_heso = $("#pos_sys_fk option:selected").data('pos_heso');
		var pos_thoihanbonhiem = $("#pos_sys_fk option:selected").data('pos_thoihanbonhiem');
		var pos_fk = $(this).val();
		$('#rpos_date').val('');
		$('#rpos_date_congbo').val('');
		if(pos_fk != ''){
			$("#divPos").html("Ngày bắt đầu giữ chức vụ (&lt;span style='color:red;'&gt;*&lt;/span&gt;)");
			$("#position").val(position);
			$('#div_ngaycongbo').show();
			$("label[for='whois_pos_mgr_id']").html("Hình thức bổ nhiệm (&lt;span style='color:red;'&gt;*&lt;/span&gt;)");
			$('#div_bonhiem_dieudong').html('&lt;select name="whois_pos_mgr_id" &gt;&lt;option value=""&gt;&lt;/option&gt;&lt;option value="1"&gt;Bổ nhiệm mới&lt;/option&gt;&lt;option value="2"&gt;Bổ nhiệm lại&lt;/option&gt;&lt;option value="3"&gt;Điều động và bổ nhiệm&lt;/option&gt;&lt;option value="4"&gt;Miễn nhiệm&lt;/option&gt;&lt;option value="11"&gt;Kéo dài thời gian đến tuổi nghỉ hưu&lt;/option&gt;&lt;option value="12"&gt;Từ chức&lt;/option&gt;&lt;option value="13"&gt;Phân công nhiệm vụ&lt;/option&gt;&lt;/select&gt;');
			$('#div_cachthuc_bonhiem').show();
			$('#pos_td').val(pos_td);
			$('#pos_heso').val(pos_heso);
			$('#pos_thoihanbonhiem').val(pos_thoihanbonhiem);
			$('#rpos_date_congbo').addClass("dateVN").attr('title','Nhập đúng định dạng ngày công bố chức vụ trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"');
		}else{
			$('#div_ngaycongbo').hide();
			$("label[for='whois_pos_mgr_id']").html("Hình thức phân công (&lt;span style='color:red;'&gt;*&lt;/span&gt;)");
			$('#div_bonhiem_dieudong').html('&lt;select name="whois_pos_mgr_id" &gt;&lt;option value=""&gt;&lt;/option&gt;&lt;option value="5"&gt;Điều động theo nhiệm vụ&lt;/option&gt;&lt;option value="6"&gt;Chuyển đổi vị trí NĐ158&lt;/option&gt;&lt;option value="10"&gt;Phân công lần đầu&lt;/option&gt;&lt;/select&gt;');
			$('#div_cachthuc_bonhiem').hide();
			$('#cachthucbonhiem_id').val('');
			$("#divPos").html("Ngày bắt đầu vị trí tại Phòng (&lt;span style='color:red;'&gt;*&lt;/span&gt;)");
			$("#position").val('');
			$('#pos_td').val('99');
			$('#pos_heso').val('');
			$('#pos_thoihanbonhiem').val('0');
			$('#rpos_date_congbo').removeClass("dateVN").removeAttr('title');
		}
	});
	$("#whois_sal").on('change', function(){
		var sotien = $(this).find('option:selected').data('sotien');
		var nangluong = $(this).find('option:selected').data('nangluong');
		var ngaynangluong = $(this).find('option:selected').data('ngaynangluong');
		var phantramsotien = $(this).find('option:selected').data('phantramsotien');
		$('#is_nangluong').val(nangluong);
		$('#percent').val(phantramsotien);
		$('.dvnongach').show();
		if(sotien == '1'){
			$('.luong_sotien').show();
			$('.dvnongach').hide();
			$('#sta_code').val('');
			$('#sta_code').change();
		}else{
			$('.luong_sotien').hide();
			$('#money_sal_show').val('');
			$('#money_sal').val('');
		}
		if(ngaynangluong == '1'){
			$('.luong_ngaynangluong').show();
		}else{
			$('.luong_ngaynangluong').hide();
			$('#real_start_date_sal').val('');
		}
	});
	var checkKiemnhiem = function(){
		if($('#type_knbp').val() != ''){
			$('.div_knbp').show();
			if($('#type_knbp').val() == '2'){
				$('.div_knbp_chucvu').hide();
				$('#pos_sys_knbp').val('');
				$('#pos_name_knbp').val('');
			}
			$('#start_date_knbp').addClass('dateVN').attr('title','Nhập đúng định dạng ngày bắt đầu kiêm nhiệm, biệt phái trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"');
		}else{
			$('.div_knbp').hide();
			$('#start_date_knbp').removeClass('dateVN').removeAttr('title');
		}
	};
	checkKiemnhiem();
	$('#type_knbp').on('change',function(){
		checkKiemnhiem();
	});
	$('#inst_code_knbp').on('change',function(){
		var id_donvi = $(this).val();
		$.ajax({
			type: "POST",
			url: "index.php?option=com_hoso&amp;view=congtac&amp;format=raw",
			data: {id_donvi:id_donvi,task:'getOptPhong'},
			success:function(data){
				var strDept = '';
				if(data !== undefined &amp;&amp; data.length &gt; 0){
					strDept+= '&lt;option value=""&gt;&lt;/option&gt;';
					$.each(data,function(i,v){
						strDept+= "&lt;option value='"+v.id+"'&gt;"+v.name+"&lt;/option&gt;";
					});
					$('.div_knbp_phongban').show();
				}else{
					$('.div_knbp_phongban').hide();
				}
				$('#dept_code_knbp').html(strDept);
			}
		});
		$.ajax({
			type: "POST",
			url: "index.php?option=com_hoso&amp;view=congtac&amp;format=raw",
			data: {id_donvi:id_donvi,task:'getOptChucvu'},
			success:function(data){
				var strPos = '&lt;option value=""&gt;&lt;/option&gt;';
				if(data !== undefined || data.length &gt; 0){
					$.each(data,function(i,v){
						strPos+= "&lt;option value='"+v.mangach+"'&gt;"+v.tencap+"&lt;/option&gt;";
					});
				}
				$('#pos_sys_knbp').html(strPos);
				$('#pos_name_knbp').val('');
			}
		});
		$('#inst_name_knbp').val($(this).find('option:selected').text());
	});
	$('#inst_name_knbp').val($(this).find('option:selected').text());
	$('#dept_code_knbp').on('change', function(){
		$('#dept_name_knbp').val($(this).find('option:selected').text());
	});
	$('#pos_sys_knbp').on('change', function(){
		$('#pos_name_knbp').val($(this).find('option:selected').text());
	});
	
	/* ********************************* Trình độ, đào tạo ********************************* */
	var viewNgonnguKhac = function(){
		if($('#ngKhac').val() == '0'){
			$(".tenNg").hide();
			$(".diemkhac").hide();
			$("#ngonngu1").val('');
			$("#trinhdo1").val('');
			$("#diemkhac").val('');
		}else{
			$(".tenNg").show();
		}
	};
	var viewTrinhdoChuyenmon = function(){
		if($('#sca_code').val() == '' || jQuery('#sca_code').val() == '0'){
			$('.dvNoDT').hide();
		}else{
			$('.dvNoDT').show();
		}
	};
	var viewTrinhdoBoiduong = function(row_index){
		if($('.loaiBoiduong').eq(row_index).val() == '0'){
			$('.CNBoiduong').eq(row_index).closest('.span5').hide();
			$('.CNBoiduong').eq(row_index).val('');
			$('.TDBoiduong').eq(row_index).closest('.span5').hide();
			$('.TDBoiduong').eq(row_index).val('');
			$('.diemBoiduong').eq(row_index).closest('.span5').hide();
			$('.diemBoiduong').eq(row_index).val('');
		}else{
			$('.CNBoiduong').eq(row_index).closest('.span5').show();
			$('.TDBoiduong').eq(row_index).closest('.span5').show();
		}
	};
	viewTrinhdoChuyenmon();
	$('.loaiBoiduong').each(function(){
		var row_index = $('.loaiBoiduong').index($(this));
		viewTrinhdoBoiduong(row_index);
	});
	$('.loaiBoiduong').on('change', function(){
		var row_index = $('.loaiBoiduong').index($(this));
		viewTrinhdoBoiduong(row_index);
	});
	$('.bdnv_code').on('change', function(){
		var row_index = $('.bdnv_code').index($(this));
		$('.bdnv_step').eq(row_index).val($(this).find('option:selected').data('step'));
	});
	$('.CNBoiduong').on('change', function(){
		var row_index = $('.CNBoiduong').index($(this));
		var ngoaingu = $(this).val();
		$.ajax({
			type: "POST",
			url: "index.php?option=com_hoso&amp;view=daotao&amp;format=raw",
			data: { ngoaingu : ngoaingu, task : 'getOptTrinhdoNV' },
			success:function(data){
				var str = '&lt;option value="" data-istext=""&gt;&lt;/option&gt;';
				if(data !== undefined || data.length &gt; 0){
					$.each(data,function(i,v){
						str+= '&lt;option value="'+v.code+'" data-istext="'+v.istext+'"&gt;'+v.name+'&lt;/option&gt;';
					});
				}
				$('.TDBoiduong').eq(row_index).html(str);
			}
		});
		//$('#name_ngonngu1').val($(this).find('option:selected').text());
	});
	$('.TDBoiduong').on('change', function(){
		var row_index = $('.TDBoiduong').index($(this));
		if($(this).find('option:selected').data('istext') == '1'){
			$('.diemBoiduong').eq(row_index).closest('.span5').show();
		}else{
			$('.diemBoiduong').eq(row_index).closest('.span5').hide();
			$('.diemBoiduong').eq(row_index).val('');
		}
	});
	$("#ngonngu1").on('change', function(){
		var ngoaingu = $(this).val();
		$.ajax({
			type: "POST",
			url: "index.php?option=com_hoso&amp;view=daotao&amp;format=raw",
			data: { ngoaingu : ngoaingu, task : 'getOptTrinhdoNV' },
			success:function(data){
				var str = '&lt;option value="" data-istext=""&gt;&lt;/option&gt;';
				if(data !== undefined || data.length &gt; 0){
					$.each(data,function(i,v){
						str+= '&lt;option value="'+v.code+'" data-istext="'+v.istext+'"&gt;'+v.name+'&lt;/option&gt;';
					});
				}
				$("#trinhdo1").html(str);
			}
		});
		$('#name_ngonngu1').val($(this).find('option:selected').text());
	});
	$('#sca_code').on('change',function(){
		viewTrinhdoChuyenmon();
		$('#sca_step').val($(this).find('option:selected').data('step'));
		if($(this).val() == '1'){
			$('label[for="loaitotnghiep"]').html('Tốt nghiệp loại (&lt;span style="color:red;"&gt;*&lt;/span&gt;)');
		}else{
			$('label[for="loaitotnghiep"]').html('Tốt nghiệp loại');
		}
	});
	$('#eng_code').on('change', function(){
		if($(this).find('option:selected').data('istext') == '1'){
			$('.dvdiem').show();
		}else{
			$('.dvdiem').hide();
			$('#diem').val('');
		}
	});
	viewNgonnguKhac();
	$('#ngKhac').on('change',function(){
		viewNgonnguKhac();
	});
	$('#trinhdo1').on('change', function(){
		if($(this).find('option:selected').data('istext') == '1'){
			$('.diemkhac').show();
		}else{
			$('.diemkhac').hide();
		}
	});
	$("#country_code").change(function(){
		$('#nuocdaotao').val(jQuery('#country_code option:selected').text());
	});
	var truong_text = '';
	var truong_id = 0;
	$("#truong").autoComplete({
		ajax: '/api.php?task=COLLECT&amp;collect=PLACETRAINING',
		minChars: 2,
		onSelect: function(event, ui){
// 			$('#id_truong').val(ui.data.id);
			truong_text = ui.data.value;
			truong_id = ui.data.id;
		}
	});
	$("#truong").on("blur.autoComplete",function(){
		if($(this).val() == ''){
			$('#id_truong').val('');
		}else if($(this).val() == truong_text){
			$('#id_truong').val(truong_id);
		}else{
			$('#id_truong').val(-1);
		}
	});
	$('#expand_truong').click(function(){
		$('#truong').autoComplete('button.ajax');
	});
	var chuyennganh_text = '';
	var chuyennganh_id = 0;
	$("#lim_name").autoComplete({
		ajax: '/api.php?task=COLLECT&amp;collect=LSCODE',
		minChars: 2,
		onSelect: function(event, ui){
			chuyennganh_text = ui.data.value;
			chuyennganh_id = ui.data.id;
		}
	});
	$("#lim_name").on("blur.autoComplete",function(){
		if($(this).val() == ''){
			$('#lim_code').val('');
		}else if($(this).val() == chuyennganh_text){
			$('#lim_code').val(chuyennganh_id);
		}else{
			$('#lim_code').val(-1);
		}
	});
	$('#expand_chuyennganh').click(function(){
		$('#lim_name').autoComplete('button.ajax');
	});
	
	/* ********************************* Validate And Action ********************************* */
	$('#frmHosoAdd').validate({
		ignore:true,
		errorPlacement : function(error, element) {
		
		},
		rules:{
			"inst_code": { required : true },
			"e_name": { required : true },
			"sex": { required : true },
			"birth_date": { 
				required : true,
				dateVN : {
					depends : function(element){
						if($('#is_only_year').is(':checked')){
							return false;
						}else{
							return true;
						}
					}
				},
				number : {
					depends : function(element){
						return $('#is_only_year').is(':checked');
					}
				}
			},
			"nat_code": { required : true },
			"married_fk": { required : true },
			"per_residence": { required : true },
			"cadc_code": { required : true },
			"nguyenquan_khac": { 
				required : function(){
					if($('#cadc_code').val() == -2){
						return true;
					}else{
						return false;
					}
				}
			},
			"dangvien": { required : true },
			"party_j_date": { 
				required : function(){
					if($('#dangvien').val() == '1'){
						return true;
					}else{
						return false;
					}
				}
			},
			"start_date_ctd" : {
				required : function(){
					if($('#committ_pos_code').val() != ''){
						return true;
					}else{
						return false;
					}
				}
			},
			"donvidang_ctd" : {
				required : function(){
					if($('#committ_pos_code').val() != ''){
						return true;
					}else{
						return false;
					}
				}
			},
			bc_hinhthuc_id : { required : true },
			bc_ngaybatdau : {
				dateVN : {
					depends : function(element){
						if($(element).val() == ''){
							return false;
						}else{
							return true;
						}
					}
				}
			},
			bc_ngayketthuc : {
				dateVN : {
					depends : function(element){
						if($(element).val() == ''){
							return false;
						}else{
							return true;
						}
					}
				}
			},
			bc_ngaybanhanh : {
				dateVN : {
					depends : function(element){
						if($(element).val() == ''){
							return false;
						}else{
							return true;
						}
					}
				}
			},
			"qd_botri_47" : { 
				required : function(){
					if($("#dt_47").is(":checked")){
						return true;
					}else{
						return false;
					}
				}
			},
			"qd_botri_47_date" : { 
				required : function(){
					if($("#dt_47").is(":checked")){
						return true;
					}else{
						return false;
					}
				}
			},
			"qd_botri_393" : { 
				required : function(){
					if($("#dt_393").is(":checked")){
						return true;
					}else{
						return false;
					}
				}
			},
			"qd_botri_393_date" : { 
				required : function(){
					if($("#dt_393").is(":checked")){
						return true;
					}else{
						return false;
					}
				}
			},
			"thuhut" : { 
				required : function(){
					if($("#dt_thuhut").is(":checked")){
						return true;
					}else{
						return false;
					}
				}
			},
			"qd_thuhut" : { 
				required : function(){
					if($("#dt_thuhut").is(":checked")){
						return true;
					}else{
						return false;
					}
				}
			},
			"date_thuhut" : { 
				required : function(){
					if($("#dt_thuhut").is(":checked")){
						return true;
					}else{
						return false;
					}
				}
			},
			"whois_sal" : { required : true },
			"money_sal" : {
				required : function(){
					if($('#whois_sal').find('option:selected').data('sotien') == '1'){
						return true;
					}else{
						return false;
					}
				},
				number : true
			},
			"real_start_date_sal" : {
				required : function(){
					if($('#whois_sal').find('option:selected').data('ngaynangluong') == '1'){
						return true;
					}else{
						return false;
					}
				}
			},
			"sta_code" : { 
				required : function(){
					if($('#whois_sal').find('option:selected').data('sotien') == '0'){
						return true;
					}else{
						return false;
					}
				} 
			},
			"sl_code" : {  
				required : function(){
					if($('#whois_sal').find('option:selected').data('sotien') == '0'){
						return true;
					}else{
						return false;
					}
				} 
			},
			"sal_step_date" : { required : true, dateVN : true},
			"rpos_date" : { required : true, dateVN : true},
			"rpos_date_congbo" : { 
				required : function(){
					if($("#pos_sys_fk").val() == ''){
						return false;
					}else{
						return true;
					}
				}
			},
			"dept_code" : { 
				required : function(){
					if($("#dept_code option").length &gt; 1){
						return true;
					}else{
						return false;
					}
				}
			},
			"whois_pos_mgr_id" : { required : true },
			"cachthucbonhiem_id" : {
				required : function(){
					if($("#pos_sys_fk").val() != ''){
						return true;
					}else{
						return false;
					}
				}
			},
			"inst_code_knbp" : {
				required : function(){
					if($('#type_knbp').val() != ''){
						return true;
					}else{
						return false;
					}
				}
			},
			"dept_code_knbp" : {
				required : function(){
					if($('#type_knbp').val() != ''){
						if($('#dept_code_knbp').find('option').length &gt; 0){
							return true;
						}else{
							return false;
						}
					}else{
						return false;
					}
				}
			},
			"pos_sys_knbp" : {
				required : function(){
					if($('#type_knbp').val() == '1'){
						return true;
					}else{
						return false;
					}
				}
			},
			"start_date_knbp" : {
				required : function(){
					if($('#type_knbp').val() != ''){
						return true;
					}else{
						return false;
					}
				}
			},
			"sca_code" : { required : true },
			"truong" : {
				required : function(){
					if($('#sca_code').val() != '' &amp;&amp; $('#sca_code').val() != '0'){
						return true;
					}else{
						return false;
					}
				}
			},
			"lim_code" : {
				required : function(){
					if($('#sca_code').val() != '' &amp;&amp; $('#sca_code').val() != '0'){
						return true;
					}else{
						return false;
					}
				}
			},
			"gra_year" : {
				required : function(){
					if($('#sca_code').val() != '' &amp;&amp; $('#sca_code').val() != '0'){
						return true;
					}else{
						return false;
					}
				}
			},
			"htdaotao" : {
				required : function(){
					if($('#sca_code').val() != '' &amp;&amp; $('#sca_code').val() != '0'){
						return true;
					}else{
						return false;
					}
				}
			},
			"loaitotnghiep" : {
				required : function(){
					if($('#sca_code').val() == '1'){
						return true;
					}else{
						return false;
					}
				}
			},
			"country_code" : {
				required : function(){
					if($('#sca_code').val() != '' &amp;&amp; $('#sca_code').val() != '0'){
						return true;
					}else{
						return false;
					}
				}
			}
		},
		messages:{
			"inst_code": { required : 'Chọn đơn vị công tác trong thẻ "Thông tin chung"' },
			"e_name": { required : 'Nhập họ và tên trong thẻ "Thông tin chung"' },
			"sex": { required : 'Chọn giới tính trong thẻ "Thông tin chung"' },
			"birth_date": { 
				required : 'Nhập ngày sinh trong thẻ "Thông tin chung"',
				dateVN : 'Nhập đúng định dạng ngày tháng năm sinh trong thẻ "Thông tin chung"',
				number : 'Nhập đúng định dạng năm sinh trong thẻ "Thông tin chung"'
			},
			"nat_code": { required : 'Chọn dân tộc trong thẻ "Thông tin chung"' },
			"married_fk": { required : 'Chọn tình trạng hôn nhân trong thẻ "Thông tin chung"' },
			"per_residence": { required : 'Nhập địa chỉ thường trú trong thẻ "Thông tin chung"' },
			"cadc_code": { required : 'Chọn nguyên quán (tỉnh thành) trong thẻ "Thông tin chung"' },
			"nguyenquan_khac": { required : 'Nhập nội dung nguyên quán trong thẻ "Thông tin chung"' },
			"dangvien": { required : 'Chọn đảng viên trong thẻ "Thông tin chung"' },
			"party_j_date": { required : 'Nhập ngày kết nạp Đảng trong thẻ "Thông tin chung"' },
			"start_date_ctd": { required : 'Nhập ngày bắt đầu nhận chức vụ Đảng trong thẻ "Thông tin chung"' },
			"donvidang_ctd": { required : 'Nhập tổ chức Đảng trong thẻ "Thông tin chung"' },
			bc_hinhthuc_id : { required : 'Chọn loại hình biên chế, HĐ trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			bc_hinhthuctuyendung_id : { required : 'Chọn hình thức tuyển dụng trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			bc_ngaybatdau : { 
				required : 'Nhập ngày bắt đầu biên chế HĐ trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"', 
				dateVN : 'Nhập đúng định dạng ngày bắt đầu biên chế HĐ trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' 
			},
			bc_thoihanbienchehopdong_id : { required : 'Chọn thời hạn biên chế, HĐ trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			bc_ngayketthuc : { 
				required : 'Nhập ngày kết thúc trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"', 
				dateVN : 'Nhập đúng định dạng ngày kết thúc trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' 
			},
			bc_soquyetdinh : { required : 'Nhập số quyết định trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			bc_coquanquyetdinh : { required : 'Nhập cơ quan ra quyết định trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			bc_ngaybanhanh : { 
				required : 'Nhập ngày ban hành trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"', 
				dateVN : 'Nhập đúng định dạng ngày ban hành trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' 
			},
			"qd_botri_47" : { required : 'Nhập số QĐ bố trí 922 bậc ĐH (47,32) trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			"qd_botri_47_date" : { required : 'Nhập ngày QĐ bố trí 922 bậc ĐH (47,32) trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			"qd_botri_393" : { required : 'Nhập số QĐ bố trí 922 bậc sau ĐH (393,56) trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			"qd_botri_393_date" : { required : 'Nhập ngày QĐ bố trí 922 bậc sau ĐH (393,56) trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			"thuhut" : { required : 'Chọn loại đối tượng thu hút trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			"qd_thuhut" : { required : 'Nhập số QĐ/TB thu hút của cơ quan có thẩm quyền trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			"date_thuhut" : { required : 'Nhập ngày QĐ/TB thu hút của cơ quan có thẩm quyền trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			"whois_sal" : { required : 'Chọn hình thức hưởng lương/ngạch trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			"money_sal" : { required : 'Nhập số tiền được hưởng trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"',number : 'Số tiền hưởng phải là số' },
			"real_start_date_sal" : { required : 'Nhập thời điểm nâng lương lần sau trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			"sta_code" : { required : 'Chọn ngạch trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			"sl_code" : { required : 'Chọn bậc trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			"sal_step_date" : { 
				required : 'Nhập ngày hưởng lương,bậc trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"',
				dateVN : 'Nhập đúng định dạng ngày hưởng lương,bậc trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"'
			},
			"rpos_date" : { 
				required : 'Nhập ngày bắt đầu vị trí/chức vụ tại phòng trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"',
				dateVN : 'Nhập đúng định dạng ngày bắt đầu vị trí/chức vụ tại phòng trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"'
			},
			"rpos_date_congbo" : { 
				required : 'Nhập ngày công bố chức vụ trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"'
			},
			"dept_code" : { required : 'Chọn phòng công tác trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			"whois_pos_mgr_id" : { required : 'Chọn hình thức phân công/bổ nhiệm trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			"cachthucbonhiem_id" : { required : 'Chọn cách thức bổ nhiệm trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			"inst_code_knbp" : { required : 'Chọn đơn vị kiêm nhiệm, biệt phái trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			"dept_code_knbp" : { required : 'Chọn phòng kiêm nhiệm, biệt phái trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			"pos_sys_knbp" : { required : 'Chọn chức vụ kiêm nhiệm, biệt phái trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			"start_date_knbp" : { required : 'Nhập ngày bắt đầu kiêm nhiệm, biệt phái trong thẻ "Biên chế; Chức vụ; Ngạch, bậc"' },
			"sca_code" : { required : 'Chọn trình độ cao nhất trong thẻ "Trình độ, đào tạo"' },
			"truong" : { required : 'Nhập trường đào tạo trong thẻ "Trình độ, đào tạo"' },
			"lim_code" : { required : 'Chọn chuyên ngành đào tạo trong thẻ "Trình độ, đào tạo"' },
			"gra_year" : { required : 'Chọn năm tốt nghiệp trong thẻ "Trình độ, đào tạo"' },
			"htdaotao" : { required : 'Chọn hình thức đào tạo trong thẻ "Trình độ, đào tạo"' },
			"loaitotnghiep" : { required : 'Chọn loại tốt nghiệp trong thẻ "Trình độ, đào tạo"' },
			"country_code" : { required : 'Chọn nước đào tạo trong thẻ "Trình độ, đào tạo"' }
		},
		invalidHandler: function(form, validator) {
			var errors = validator.numberOfInvalids();
			if (errors) {
				var message = errors == 1
				? 'Kiểm tra lỗi sau:&lt;br/&gt;'
				: 'Phát hiện ' + errors + ' lỗi sau:&lt;br/&gt;';
				var errors = "";
				if (validator.errorList.length &gt; 0) {
					for (x=0;x&lt;validator.errorList.length;x++) {
						errors += "&lt;br/&gt;\u25CF " + validator.errorList[x].message;
					}
				}
				loadNoticeBoardError('Thông báo',message + errors);
			}
			validator.focusInvalid();
		}
	});
	$('#btn-save-ngachkhac').on('click', function(){
		var val_ngachkhac = $('#sta_code_khac').val();
		if(val_ngachkhac == ''){
			alert('Vui lòng chọn ngạch!!!');
		}else{
			var text_ngachkhac = $('#sta_code_khac').find("option:selected").text();
			$('#sta_code').append('&lt;option value="'+val_ngachkhac+'"&gt;'+text_ngachkhac+'&lt;/option&gt;');
			$('#modal-form').modal('hide');
			$('#sta_code').val(val_ngachkhac);
			$('#sta_code').change();
		}
	});
	$('#btn_save_new_add').on('click', function(){
		$.blockUI();
		$('#typeSave').val('new');
		var flag = $('#frmHosoAdd').valid();
		if(flag == true){
			validHoso();
		}
		$.unblockUI();
		return false;
	});
	$('#btn_save_close_add').on('click', function(){
		$.blockUI();
		$('#typeSave').val('close');
		var flag = $('#frmHosoAdd').valid();
		if(flag == true){
			validHoso();
		}
		$.unblockUI();
		return false;
	});
	$('#btn_save_update_add').on('click', function(){
		$('#typeSave').val('update');
		var flag = $('#frmHosoAdd').valid();
		if(flag == true){
			validHoso();
		}
		$.unblockUI();
		return false;
	});
	$('#btn_back_add').on('click',function(){
		window.location.href = '/index.php?option=com_hoso&amp;controller=hoso&amp;task=default';
	});
});
</script>