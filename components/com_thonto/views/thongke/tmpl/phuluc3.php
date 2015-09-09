<?php
/**
 * Author: Phucnh
 * Date created: Aug 17, 2015
 * Company: DNICT
 */
$row=$this->row;
?>
<table class="table table-bordered" id="tblThongkemau2">
	<thead>
		<tr style="background: #ECECEC;">
			<th rowspan="2" style="vertical-align: middle; text-align: center;">STT</th>
			<th rowspan="2" style="text-align: center;">Họ và tên</th>
			<th rowspan="2" style="text-align: center;">Đơn vị</th>
			<th colspan="2" style="text-align: center;">Năm sinh</th>
			<th rowspan="2" style="vertical-align: middle; text-align: center;">Chức danh đảm nhận</th>
			<th rowspan="2" style="vertical-align: middle; text-align: center;">Thời gian công tác tại phường, xã</th>
			<th colspan="5" style="text-align: center;">Trình độ chuyên môn</th>
			<th rowspan="2" style="vertical-align: middle; text-align: center;">Số điện thoại</th>
			<th rowspan="2" style="vertical-align: middle; text-align: center;">Email</th>
			<th rowspan="2" style="vertical-align: middle; text-align: center;">Ghi chú</th>
		</tr>
		<tr style="background: #ECECEC;">
			<th style="vertical-align: middle; text-align: center;">Nam</th>
			<th style="vertical-align: middle; text-align: center;">Nữ</th>
			<th style="vertical-align: middle; text-align: center;">Sau đại học</th>
			<th style="vertical-align: middle; text-align: center;">Đại học</th>
			<th style="vertical-align: middle; text-align: center;">Cao đẳng</th>
			<th style="vertical-align: middle; text-align: center;">Trung cấp</th>
			<th style="vertical-align: middle; text-align: center;">Sơ cấp</th>
		</tr>
		<tr style="background: #ECECEC;">
			<th style="vertical-align: middle; text-align: center;">[1]</th>
			<th style="vertical-align: middle; text-align: center;">[2]</th>
			<th style="vertical-align: middle; text-align: center;">[3]</th>
			<th style="vertical-align: middle; text-align: center;">[4]</th>
			<th style="vertical-align: middle; text-align: center;">[5]</th>
			<th style="vertical-align: middle; text-align: center;">[6]</th>
			<th style="vertical-align: middle; text-align: center;">[7]</th>
			<th style="vertical-align: middle; text-align: center;">[8]</th>
			<th style="vertical-align: middle; text-align: center;">[9]</th>
			<th style="vertical-align: middle; text-align: center;">[10]</th>
			<th style="vertical-align: middle; text-align: center;">[11]</th>
			<th style="vertical-align: middle; text-align: center;">[12]</th>
			<th style="vertical-align: middle; text-align: center;">[13]</th>
			<th style="vertical-align: middle; text-align: center;">[14]</th>
			<th style="vertical-align: middle; text-align: center;">[15]</th>
		</tr>
	</thead>
	<tbody id="tbody_thongkemau2">
		<?php
			 for($i=0; $i< count($row); $i++){$stt=1;?>
			<tr class="success"><td colspan='15' style="vertical-align: middle; text-align: center;"><b><?php echo mb_strtoupper($row[$i]->tendonvi);?></b></td></tr>
			<?php
				$thongtin=$row[$i]->thongtin; 
				for($j=0; $j<count($thongtin); $j++){
				?>
		<tr class="warning">
			<td style="vertical-align: middle; text-align: center;"><?php echo $stt;?></td>
			<td style="vertical-align: middle; text-align: left;"><?php echo $thongtin[$j]->hoten;?></td>
			<td style="vertical-align: middle; text-align: left;"><?php echo $thongtin[$j]->congtac_donvi?></td>
			<td style="vertical-align: middle; text-align: center;"><?php echo $thongtin[$j]->nam;?></td>
			<td style="vertical-align: middle; text-align: center;"><?php echo $thongtin[$j]->nu;?></td>
			<td style="vertical-align: middle; text-align: left;"><?php echo $thongtin[$j]->congtac_chucvu;?></td>
			<td style="vertical-align: middle; text-align: center;"></td>
			<td style="vertical-align: middle; text-align: center;"><?php echo $thongtin[$j]->saudaihoc;?></td>
			<td style="vertical-align: middle; text-align: center;"><?php echo $thongtin[$j]->daihoc;?></td>
			<td style="vertical-align: middle; text-align: center;"><?php echo $thongtin[$j]->caodang;?></td>
			<td style="vertical-align: middle; text-align: center;"><?php echo $thongtin[$j]->trungcap;?></td>
			<td style="vertical-align: middle; text-align: center;"><?php echo $thongtin[$j]->socap;?></td>
			<td style="vertical-align: middle; text-align: center;"><?php echo $thongtin[$j]->phone;?></td>
			<td style="vertical-align: middle; text-align: center;"><?php echo $thongtin[$j]->email;?></td>
			<td style="vertical-align: middle; text-align: left;"><?php echo $thongtin[$j]->ghichu;?></td>
		</tr>
	  	 <?php $stt++;}?>
	  	 <?php }?>
	</tbody>
</table>