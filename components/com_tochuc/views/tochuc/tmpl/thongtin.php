<form class="form-horizontal" id="frmTochuc" method="post">
<div class="profile-user-info profile-user-info-striped">
	<div class="profile-info-row">
		<div class="profile-info-name"> Tên đơn vị </div>
		<div class="profile-info-value">
			<span><?php echo $this->row['name']; ?></span>
		</div>
	</div>
	<div class="profile-info-row">
		<div class="profile-info-name"> Tên viết tắt </div>
		<div class="profile-info-value">
			<span><?php echo ($this->row['s_name'] != null) ? $this->row['s_name'] : '<font style="color:red;"><font style="color:red;">Chưa có dữ liệu</font></font>'; ?></span>
		</div>
	</div>
	<div class="profile-info-row">
		<div class="profile-info-name"> Mã hiệu </div>
		<div class="profile-info-value">
			<span><?php echo $this->row['id']; ?></span>
		</div>
	</div>
	<div class="profile-info-row">
		<div class="profile-info-name"> Đơn vị chủ quản </div>
		<div class="profile-info-value">
			<span><?php echo $this->row['parent_name']; ?></span>
		</div>
	</div>
	<div class="profile-info-row">
		<div class="profile-info-name"> Cấp </div>
		<div class="profile-info-value">
			<span><?php echo ($this->row['type'] == 1)?'Tổ chức':(($this->row['type'] == 0)?'Phòng':'Vỏ chứa'); ?></span>
		</div>
	</div>
	<div class="profile-info-row">
		<div class="profile-info-name"> Cách thức thành lập </div>
		<div class="profile-info-value">
			<span>
			<?php 
				if($this->row['type_created'] == 1){
					echo 'Thành lập mới';
				}else if($this->row['type_created'] == 1){
					echo 'Sát nhập từ tổ chức khác';
				}else if($this->row['type_created'] == 1){
					echo 'Chia tách từ tổ chức khác';
				}else{
					echo 'Hợp nhất các tổ chức';
				}
			?>
			</span>
		</div>
	</div>
	<div class="profile-info-row">
		<div class="profile-info-name"> Địa chỉ </div>
		<div class="profile-info-value">
			<span><?php echo ($this->row['diachi'] != null) ? $this->row['diachi'] : '<font style="color:red;"><font style="color:red;">Chưa có dữ liệu</font></font>'; ?></span>
		</div>
	</div>
	<div class="profile-info-row">
		<div class="profile-info-name"> Điện thoại </div>
		<div class="profile-info-value">
			<span><?php echo ($this->row['dienthoai'] != null) ? $this->row['dienthoai'] : '<font style="color:red;"><font style="color:red;">Chưa có dữ liệu</font></font>'; ?></span>
		</div>
	</div>
	<div class="profile-info-row">
		<div class="profile-info-name"> Email </div>
		<div class="profile-info-value">
			<span><?php echo ($this->row['email'] != null) ? $this->row['email'] : '<font style="color:red;"><font style="color:red;">Chưa có dữ liệu</font></font>'; ?></span>
		</div>
	</div>
	<div class="profile-info-row">
		<div class="profile-info-name"> Ngày thành lập </div>
		<div class="profile-info-value">
			<span><?php echo ($this->row['date_created'] != null) ? $this->row['date_created'] : '<font style="color:red;"><font style="color:red;">Chưa có dữ liệu</font></font>'; ?></span>
		</div>
	</div>
	<div class="profile-info-row">
		<div class="profile-info-name"> Quyết định thành lập </div>
		<div class="profile-info-value">
			<span><?php echo ($this->row['number_created'] != null) ? $this->row['number_created'] : '<font style="color:red;"><font style="color:red;">Chưa có dữ liệu</font></font>'; ?></span>
		</div>
	</div>
	<div class="profile-info-row">
		<div class="profile-info-name"> Cơ quan thành lập </div>
		<div class="profile-info-value">
			<span><?php echo ($this->row['ins_created_name'] != null) ? $this->row['ins_created_name'] : '<font style="color:red;"><font style="color:red;">Chưa có dữ liệu</font></font>'; ?></span>
		</div>
	</div>
	<div class="profile-info-row">
		<div class="profile-info-name"> Ghi chú </div>
		<div class="profile-info-value">
			<span><?php echo ($this->row['ghichu'] != null) ? $this->row['ghichu'] : '<font style="color:red;"><font style="color:red;">Chưa có dữ liệu</font></font>'; ?></span>
		</div>
	</div>
</div>
<div class="form-actions">
	<span class="btn btn-success btn-add">
		<i class="icon-plus bigger-110"></i>
		Thêm mới
	</span>
	<span class="btn btn-primary">
		<i class="icon-pencil bigger-110"></i>
		Chỉnh sửa
	</span>
	<span class="btn btn-danger">
		<i class="icon-trash bigger-110"></i>
		Xóa
	</span>
</div>
</form>