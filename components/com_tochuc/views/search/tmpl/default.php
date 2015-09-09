<?php
//echo 'SEARCH';
//JHtml::_('behavior.formbehavior');
//JHtml::_('formbehavior.ajaxchosen', 'select');
?>
<style>
#frmTochucSearch .control-label{
	width: 130px !important;
}
#frmTochucSearch .controls{
	margin-left: 140px !important;
}
</style>
<form id="frmTochucSearch" name="frmTochucSearch" action="index.php?option=com_tochuc&controller=search&task=dosearch" method="POST" class="form-horizontal">
	<h3 class="row-fluid header smaller lighter blue">
		<span class="span7">Tìm kiếm<small> <i class="icon-double-angle-right"> </i> Tổ chức</small></span>
		<span class="span5">
			<span class="pull-right inline">
				<button class="btn btn-small btn-success" id="btnSearchSubmit" type="button" onclick="appTochucSearch.doSearch(); return false;"><i class="icon-search icon-on-right"></i> Tìm</button>			
			</span>																						
		</span>
	</h3>
<div class="tabbable">
	<ul class="nav nav-tabs" id="myTab">
		<li class="active"><a data-toggle="tab" href="#tochuc-search-info">Thông tin chung</a></li>
		<li><a data-toggle="tab" href="#tochuc-search-infobonus">Thông tin thêm</a></li>
		<li><a data-toggle="tab" href="#tochuc-search-history">Lịch sử</a></li>
		<li><a data-toggle="tab" href="#tochuc-search-ketqua">Kết quả</a></li>
	</ul>
	<div class="tab-content">
		<div id="tochuc-search-info" class="tab-pane active">
		<fieldset>
			<legend>Thông tin tổ chức</legend>
			<div class="row-fluid">			
				<div class="control-group span6">
					<label class="control-label" for="type">Loại</label>
						<div class="controls">
						<?php 
						$options = array();
						$option = array();
						$option[] = array('id'=>'','name'=>'');
						$options = array_merge($option,$this->types);
						echo JHtml::_('select.genericlist',$this->types,'type', array(),'id','name',1);
						?>
						</div>
				</div>
                <div class="control-group span6">
					<label class="control-label" for="ins_loaihinh">Loại hình</label>
						<div class="controls">
						<?php 
						$options = array();
						$option = array();
						$option[] = array('id'=>'','name'=>'');
						$options = array_merge($option,$this->ins_loaihinhs);
						echo JHtml::_('select.genericlist',$options,'ins_loaihinh', array(),'id','name','');
						?>
						</div>
				</div>				
			</div>
			<div class="row-fluid">
				<div class="control-group span6">
					<label class="control-label" for="name">Tên tổ chức</label>
					<div class="controls">
						<input type="text" value="" name="name" id="name">
					</div>
				</div>
				<div class="control-group span6">
					<label class="control-label" for="code">Mã số tổ chức</label>
					<div class="controls">
						<input type="text" value="" id="code" name="code">
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="control-group span6">
					<label class="control-label" for="s_name">Tên viết tắt</label>
					<div class="controls">
						<input type="text" value="" name="s_name" id="s_name">
					</div>
				</div>
				<div class="control-group span6">
					<label class="control-label" for="eng_name">Tên tiếng Anh</label>
					<div class="controls">
						<input type="text" value="" id="eng_name" name="eng_name">
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="control-group span6">
					<label class="control-label" for="masothue">Mã số thuế</label>
					<div class="controls">
						<input type="text" value=""	name="masothue" id="masothue">
					</div>
				</div>
				<div class="control-group span6">
					<label class="control-label" for="masotabmis">Mã số Tabmis</label>
					<div class="controls">
						<input type="text" value="" id="masotabmis" name="masotabmis">
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="control-group span6">
					<label class="control-label" for="diachi">Địa chỉ</label>
					<div class="controls">
						<input type="text" value="" name="diachi" id="diachi">
					</div>
				</div>
				<div class="control-group span6">
					<label class="control-label" for="dienthoai">Điện thoại</label>
					<div class="controls">
						<input type="text" value=""	name="dienthoai" id="dienthoai">
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="control-group span6">
					<label class="control-label" for="email">Email</label>
					<div class="controls">
						<input type="text" value=""	id="email" name="email">
					</div>
				</div>
				<div class="control-group span6">
					<label class="control-label" for="fax">Fax</label>
					<div class="controls">
						<input type="text" value="" id="fax" name="fax">
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="control-group span6">
					<label class="control-label" for="date_created">Ngày thành lập</label>
					<div class="controls">
						<?php echo TochucHelper::selectBoxComparing('GE', array('style'=>'width:50px','name'=>'date_created_start_condition'));?>
						<input class="input-mask-date" name="date_created_start" id="date_created_start" style="width:70px" type="text">	
						<?php echo TochucHelper::selectBoxComparing('LE', array('style'=>'width:50px','name'=>'date_created_end_condition'));?>
						<input class="input-mask-date" name="date_created_end" id="date_created_end" style="width:70px" type="text">
					</div>
				</div>
				<div class="control-group span6">
					<label class="control-label" for="phucapdacthu">Phụ cấp đặc thù</label>
					<div class="controls">
						<input type="text" value="" id="phucapdacthu" name="phucapdacthu">
					</div>
				</div>
			</div>				
		</fieldset>
		<fieldset>
		<legend>Thông tin thành lập</legend>
			<div class="row-fluid">
				<div class="control-group span6">
					<label class="control-label" for="type_created">Cách thức thành lập</label>
						<div class="controls">
						<?php 
						$options = array();
						$option[] = array('id'=>'','name'=>'');
						$options = array_merge($option,$this->type_created);
						echo JHTML::_('select.genericlist',$options,'type_created', array(),'id','name', 1);
						?>
						</div>
				</div>
				<div class="control-group span6">
					<label class="control-label" for="ins_created">Cơ quan chủ quản</label>
					<div class="controls">					  
						<input type="hidden" value="" id="ins_created" name="ins_created" style="width:250px;">		            		
					</div>
				</div>				
			</div>
			<div class="row-fluid">			
				<div class="control-group span6">
					<label class="control-label" for="status">Trạng thái</label>
						<div class="controls">			
						<?php 
						for ($i = 0,$n=count($this->status); $i < $n; $i++) {
							$item = $this->status[$i];
							$checked = (1 == $item['id'])?'checked="checked"':'';
							echo '<label><input '.$checked.' id="status_'.$item['id'].'" name="status[]" type="checkbox" value="'.$item['id'].'"><span class="lbl"> '.$item['name'].'</span></label>';
						}
						?>
						</div>
				</div>
				<div class="control-group span6">				    
					<label class="control-label" for="ins_cap">Cấp đơn vị</label>
					<div class="controls">
					      <div id="div_ins_cap"></div>
						<input type="hidden" value="" id="ins_cap" name="ins_cap">						
					</div>
				</div>
		</fieldset>		
		</div>
		<div id="tochuc-search-infobonus" class="tab-pane">
			<fieldset>
				<legend>Thông tin thêm</legend>
				<div class="row-fluid">	
					<div class="span4" id="div_linhvuc">
						<label>Lĩnh vực</label>
							<?php $linhvuc = $this->linhvuc;
								for($i=0; $i<count($linhvuc); $i++){
									$px = ($linhvuc[$i]->level) * 20;
									echo '<label>
												<input id="inslinhvuc_'.$linhvuc[$i]->id.'" type="checkbox" value="'.$linhvuc[$i]->id.'" name="ins_linhvuc[]">
												<span class="lbl" style="padding-left:'.$px.'px"> '.$linhvuc[$i]->name.'</span>
											</label>';
								}
							?>
					</div>			
					<div class="span8" id="div_goi">
						<div class="row-fluid">	
							<div class="control-group">					
								<label for="goibienche" class="control-label">Gói biên chế</label>
								<div class="controls">
									<?php echo $this->goibienche;?>
								</div>
							</div>		
						</div>
						<div class="row-fluid">	
							<div class="control-group">					
								<label for="goichucvu" class="control-label">Gói chức vụ</label>
								<div class="controls">
									<?php echo $this->goichucvu;?>
								</div>
							</div>		
						</div>
						<div class="row-fluid">	
							<div class="control-group">					
								<label for="goiluong" class="control-label">Gói lương</label>
								<div class="controls">
									<?php echo $this->goiluong;?>
								</div>
							</div>		
						<div class="row-fluid">	
							<div class="control-group">					
								<label for="goidaotao" class="control-label">Gói đào tạo</label>
								<div class="controls">
									<?php echo $this->goidaotao;?>
								</div>
							</div>
						</div>		
						<div class="row-fluid">	
							<div class="control-group">					
								<label for="goihinhthuchuongluong" class="control-label">Gói hình thức hưởng lương</label>
								<div class="controls">
									<?php echo $this->goihinhthuchuongluong;?>
								</div>
							</div>
						</div>
						
					</div		<!-- end  span8 -->
				</div>		<!--  end row-fluid -->
			</div>	
			</fieldset>
		</div>
		<div id="tochuc-search-history" class="tab-pane" style="min-height:500px">
			<fieldset>
				<legend>Lịch sử tổ chức</legend>
				<div class="row-fluid">	
					<div class="span8" id="div_linhvuc">
						<div class="row-fluid">	
							<div class="control-group">					
								<label for="cachthuc_id" class="control-label">Nghiệp vụ</label>
								<div class="controls">
									<?php echo $this->cachthuc_id;?>
								</div>
							</div>
						</div>
						<div class="row-fluid">	
							<div class="control-group">					
								<label for="cachthuc_id" class="control-label">Tên tổ chức theo quyết định</label>
								<div class="controls">
									<input type="text" name="name_history" id="name_history"/>
								</div>
							</div>
						</div>
						<div class="row-fluid">	
							<div class="control-group">					
								<label for="cachthuc_id" class="control-label">Số quyết định</label>
								<div class="controls">
									<input type="text" name="quyetdinh_so" id="quyetdinh_so"/>
								</div>
							</div>
						</div>
						<div class="row-fluid">	
							<div class="control-group">					
								<label for="cachthuc_id" class="control-label">Ngày quyết định</label>
								<div class="controls">
									<?php echo TochucHelper::selectBoxComparing('GE', array('style'=>'width:50px','name'=>'quyetdinh_ngay_start_condition'));?>
									<input class="input-mask-date" name="quyetdinh_ngay_start" id="quyetdinh_ngay_start" style="width:70px" type="text">	
									<?php echo TochucHelper::selectBoxComparing('LE', array('style'=>'width:50px','name'=>'quyetdinh_ngay_end_condition'));?>
									<input class="input-mask-date" name="quyetdinh_ngay_end" id="quyetdinh_ngay_end" style="width:70px" type="text">
								</div>
							</div>
						</div>
						<div class="row-fluid">	
							<div class="control-group">					
								<label for="cachthuc_id" class="control-label">Hiệu lực ngày</label>
								<div class="controls">
									<?php echo TochucHelper::selectBoxComparing('GE', array('style'=>'width:50px','name'=>'hieuluc_ngay_start_condition'));?>
									<input class="input-mask-date" name="hieuluc_ngay_start" id="hieuluc_ngay_start" style="width:70px" type="text">	
									<?php echo TochucHelper::selectBoxComparing('LE', array('style'=>'width:50px','name'=>'hieuluc_ngay_end_condition'));?>
									<input class="input-mask-date" name="hieuluc_ngay_end" id="hieuluc_ngay_end" style="width:70px" type="text">
								</div>
							</div>
						</div>
					</div>
				</div>
			</fieldset>
		</div>
		<div id="tochuc-search-ketqua" class="tab-pane"><div id="ketqua-search"></div></div>
	</div>
</div>
</form>
<div id="thongtin"></div>
<script type="text/javascript">
var type;
jQuery('body').delegate('.btn_view_thongtin','click',function(){
	dept_id = jQuery(this).attr('dept_id');
	jQuery.blockUI();
		jQuery.ajax({
		type: 'POST',
			url: '<?php echo JUri::base(true);?>/index.php?option=com_tochuc&controller=tochuc&task=detail&format=raw&Itemid=&id='+dept_id,
			data: { linhvuc:jQuery(this).val()},
			success:function(data){
					jQuery('#thongtin').html(data);
					jQuery('.widget-toolbar').append('<button style="margin-top:0px;" class="btn_back btn btn-small btn-info">← Quay về</button>');
					jQuery('#div_sapxep').hide();
					jQuery('#div_thaotac').hide();
					jQuery('#frmTochucSearch').hide();
					jQuery.unblockUI();
			}
    });
});
jQuery('body').delegate('.btn_back','click',function(){
	jQuery('#frmTochucSearch').show();
	jQuery('#thongtin').html('');
});
jQuery('.input-mask-date').mask('99/99/9999');
jQuery('#type').on('change',function(){
	if(jQuery(this).val() == 0 || jQuery(this).val() == 2) jQuery('#div_goi').hide();else jQuery('#div_goi').show();
	jQuery.ajax({
		type: 'POST',
			url: '<?php echo JUri::base(true);?>/index.php?option=com_tochuc&controller=search&task=getTypeLinhvuc',
			data: { linhvuc:jQuery(this).val()},
			success:function(linhvuc){
				if(linhvuc.length>0){
					var xhtml="<label>Lĩnh vực</label>";
					for(i=0; i<linhvuc.length; i++){
						px = (linhvuc[i].level) * 20;
						xhtml+='<label>';
						xhtml+='<input id="inslinhvuc" type="checkbox" value="'+linhvuc[i].id+'" name="ins_linhvuc[]">';
						xhtml+='<span class="lbl" style="padding-left:'+px+'px"> '+linhvuc[i].name+'</span>';
						xhtml+='</label>';
					}
					jQuery('#div_linhvuc').html(xhtml);
				}else {jQuery('#div_linhvuc').html(""); }
			}
    });
});
var appTochucSearch = appTochucSearch || {
	init:function(){
		jQuery(".chosen").chosen({
   	   		search_contains: true,
   	   	   	placeholder_text_single:'Hãy chọn...',
   	   		no_results_text: "Không tìm thấy "
 		});
		jQuery('.chosen-container').css('width', '220px');
	    jQuery("#ins_created").select2({
	    	allowClear: true,
	    	placeholder: "Cơ quan chủ quản",
	        ajax: {
    	        url: "api.php?act=tochuc&task=search",
    	        dataType: 'json',
    	        delay: 250,
    	        data: function (term) {
        	        return {
            	        q: term
        	        };
    	        },    	    
    	        results: function (data) {		       
    	            var myResults = [];
    	            jQuery.each(data, function (index, item) {
        	            if(2 == item.type){
        	            	item.name += ' (Vỏ bọc)';   
            	        }      	    
    	                myResults.push({
    	                    'id': item.id,
    	                    'text': item.name
    	                });
    	            });
    	            return {
    	                results: myResults
    	            };
    	        },    	 
    	        cache: true
    	    },
	        minimumInputLength: 3,
	        escapeMarkup: function (m) { return m; },
// 	       templateResult: results.name, // omitted for brevity, see the source of this page
// 	       templateSelection: results.id // omitted for brevity, see the source of this page
	  });
	  jQuery('#div_ins_cap').jstree({
		 "plugins": ["themes","ui","types", "json_data", "checkbox"],
		 "themes": {
		        "theme": "default",
		        "dots": true,
		        "icons": true,
		        "url": "<?php echo JURI::root(true);?>/media/cbcc/js/jstree/themes/default/style.css"
		  },
  		 "json_data":{
				"ajax" : {
					// the URL to fetch the data
					"url" : "/api.php?task=tree&act=CAPTOCHUC",	
					"data" : function(n) {
						return {
							"id" : n.attr ? n.attr("id").replace("node_", "") : 5
						};
					}
				}
			},
		  "checkbox": {
	        	real_checkboxes: true,
	            two_state: false,
	            checked_parent_open: true,
	            override_ui:true
	    }		     
		 });
	},
	doSearch: function(){
		jQuery.blockUI();
		var ins_dept = [],ins_cap= [],ins_goiluong = [],ins_goichucvu = [],ins_linhvuc = [];
	     jQuery("#div_ins_cap").jstree("get_checked",null,true).each(function () {            
	        	ins_cap.push(this.id.replace("node_",""));
	     });
	     jQuery('#ins_cap').val(ins_cap);
// 		console.log(ins_cap);
		jQuery.post("index.php?option=com_tochuc&controller=search&task=dosearch",jQuery('#frmTochucSearch').serialize())
		.done(function(data) {
			jQuery('#myTab a[href="#tochuc-search-ketqua"]').tab('show'); // Select tab by name
            //console.log(data);
             var xhtml='';
             xhtml='<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="table-ketqua-search">';
             xhtml +='</table>';
			 jQuery('#ketqua-search').html(xhtml);
			    jQuery('#table-ketqua-search').dataTable( {
			        "data": data,
			 		"oTableTools": {
			 			"sSwfPath": "<?php echo JUri::base(true);?>/media/cbcc/js/dataTables-1.10.0/swf/copy_csv_xls_pdf.swf",		
			          	"aButtons": [	
			 							"xls",		 							
			 							"print"
			 						]

			 		},
			 		"deferRender":true,
			        "columns": [
			                    {"title":"Tên","width": "25%", "data": "name" , "render": function (data, type, row, meta) {
			                        return '<a style="cursor:pointer;" class="btn_view_thongtin" dept_id="'+row.id+'">'+data+'</a>';
			                    }},
			                    {"title":"Loại hình", "data": "loaihinh_name" },
			                    {"title":"Địa chỉ", "data": "diachi" },
			                    {"title":"Email", "data": "email" },			                   
			                    {"title":"Điện thoại", "data": "dienthoai" },
			                    {"title":"Cơ quan chủ quản", "data": "coquanchuquan_name" },
			                    {"title":"Cấp đơn vị", "data": "capdonvi_name" },
			                ]
			    } ); 
			    jQuery.unblockUI();	   
        });
		//console.log(jQuery('#frmTochucSearch').serializeObject());
		return false;
	}
};
appTochucSearch.init();
</script>