<?php
/**
 * Author: Phucnh
 * Date created: Jan 23, 2015
 * Company: DNICT
 */
$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0); /* chon sheet active la sheet 1 */
$activeSheet = $objPHPExcel->getActiveSheet(); /* get sheet active */
$objPHPExcel->getDefaultStyle()->getFont()->setName('Times New Roman');
$border_th = array(
		'font' => array(
				'bold' => true
		),
		'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
		),
		'borders' => array(
				'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
				)
		)
);
$font = array(
		'font' => array(
				'bold' => true,
				'name'  => 'times'
		));
$mauxanh = array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => '92D050')
        )
    );
$mauvang = array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'FFFF00')
        )
    );
$indam = array('font' => array(
				'bold' => true
				)
			);
$canhgiua = array('alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
		));
$canhtrai = array('alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
		));
$gachdit = array(
		'font' => array(
				'underline' => PHPExcel_Style_Font::UNDERLINE_SINGLE
		),
);
$innghieng = array(
		'font' => array(
				'italic' => true
		),
);
$activeSheet->getStyle('B1:Q50')->getAlignment()->setWrapText(true);
$activeSheet->getStyle('E4:O5')->applyFromArray($border_th);
$activeSheet->getStyle('B7:Q8')->applyFromArray($border_th);
$activeSheet->getStyle('B7:Q8')->applyFromArray($mauxanh);

$activeSheet->getStyle('E4:O5')->applyFromArray($mauxanh);
$activeSheet->getStyle('F5:O5')->applyFromArray($mauvang);
$activeSheet->getStyle('D2:O2')->applyFromArray($canhgiua);
$activeSheet->getStyle('D2:O2')->applyFromArray($indam);


$activeSheet->setCellValue('D2', 'NHẬT KÝ CÔNG VIỆC TRONG TUẦN'); 
$activeSheet->mergeCells('D2:O2');

$activeSheet->setCellValue('E4', 'Khối lượng công việc');
$activeSheet->mergeCells('E4:E5');
$activeSheet->setCellValue('F4', 'Tổng số');
$activeSheet->setCellValue('G4', 'Đã HT');
$activeSheet->setCellValue('H4', 'Chưa HT');
$activeSheet->setCellValue('I4', 'Phức tạp');
$activeSheet->setCellValue('J4', 'Hai');
$activeSheet->setCellValue('K4', 'Ba');
$activeSheet->setCellValue('L4', 'Tư');
$activeSheet->setCellValue('M4', 'Năm');
$activeSheet->setCellValue('N4', 'Sáu');
$activeSheet->setCellValue('O4', 'Bảy');

$activeSheet->setCellValue('B7', 'HỌ TÊN');
$activeSheet->mergeCells('B7:B8');
$activeSheet->setCellValue('C7', 'STT');
$activeSheet->mergeCells('C7:C8');
$activeSheet->setCellValue('D7', 'CÔNG VIỆC');
$activeSheet->mergeCells('D7:D8');
$activeSheet->setCellValue('E7', 'MÃ DỰ ÁN');
$activeSheet->mergeCells('E7:E8');
$activeSheet->setCellValue('F7', 'PHỨC TẠP');
$activeSheet->mergeCells('F7:F8');
$activeSheet->setCellValue('G7', 'THỜI GIAN DỰ KIẾN');
$activeSheet->mergeCells('G7:H7');
$activeSheet->setCellValue('G8', 'BẮT ĐẦU');
$activeSheet->setCellValue('H8', 'KẾT THÚC');
$activeSheet->setCellValue('I7', 'HOÀN THÀNH');
$activeSheet->mergeCells('I7:I8');
$activeSheet->setCellValue('J7', 'THỨ TRONG TUẦN');
$activeSheet->mergeCells('J7:O7');
$activeSheet->setCellValue('J8', 'HAI');
$activeSheet->setCellValue('K8', 'BA');
$activeSheet->setCellValue('L8', 'TƯ');
$activeSheet->setCellValue('M8', 'NĂM');
$activeSheet->setCellValue('N8', 'SÁU');
$activeSheet->setCellValue('O8', 'BẢY');
$activeSheet->setCellValue('P7', 'Ý KIẾN/ ĐỀ XUẤT');
$activeSheet->mergeCells('P7:P8');
$activeSheet->setCellValue('Q7', 'TRƯỞNG PHÒNG ĐÁNH GIÁ');
$activeSheet->mergeCells('Q7:Q8');
	
$activeSheet->getColumnDimension('A')->setWidth(2);
$activeSheet->getColumnDimension('B')->setWidth(30);
$activeSheet->getColumnDimension('C')->setWidth(5);
$activeSheet->getColumnDimension('D')->setWidth(40);
$activeSheet->getColumnDimension('E')->setWidth(22);
$activeSheet->getColumnDimension('F')->setWidth(10);
$activeSheet->getColumnDimension('G')->setWidth(13);
$activeSheet->getColumnDimension('H')->setWidth(13);
$activeSheet->getColumnDimension('I')->setWidth(10);
$activeSheet->getColumnDimension('J')->setWidth(7);
$activeSheet->getColumnDimension('K')->setWidth(7);
$activeSheet->getColumnDimension('L')->setWidth(7);
$activeSheet->getColumnDimension('M')->setWidth(7);
$activeSheet->getColumnDimension('N')->setWidth(7);
$activeSheet->getColumnDimension('O')->setWidth(7);
$activeSheet->getColumnDimension('P')->setWidth(18);
$activeSheet->getColumnDimension('Q')->setWidth(20);

$arr= $this->rows;
$num = 9; // cột số 1,2,3 trong excel
$stt=1;
$counthoanthanh = 0;
$countphuctap = 0;
$count2 = 0;
$count3 = 0;
$count4 = 0;
$count5 = 0;
$count6 = 0;
$count7 = 0;
$count = count($arr);
$activeSheet->setTitle($arr[0]->tennhanvien);
for($i=0; $i<count($arr);$i++)
{
		$activeSheet->setCellValue('B9', $arr[$i]->tennhanvien);
		$activeSheet->setCellValue('C'.$num, $stt);
		$activeSheet->setCellValue('D'.$num, $arr[$i]->congviec);
		$activeSheet->setCellValue('E'.$num, $arr[$i]->tenduan);
		$phuctap = $arr[$i]->dophuctap == 1 ? 'X':'';
		$activeSheet->setCellValue('F'.$num, $phuctap);
		if ($arr[$i]->batdau===null  || $arr[$i]->batdau ==='0000-00-00' || $arr[$i]->batdau ==='')
			$batdau = "";
		else $batdau = date('d/m/Y', strtotime($arr[$i]->batdau));
		$activeSheet->setCellValue('G'.$num, $batdau);
		if ($arr[$i]->ketthuc===null  || $arr[$i]->ketthuc ==='0000-00-00' || $arr[$i]->ketthuc ==='')
			$ketthuc = "";
		else $ketthuc = date('d/m/Y', strtotime($arr[$i]->ketthuc));
		$activeSheet->setCellValue('H'.$num, $ketthuc);
		$activeSheet->setCellValue('I'.$num, $arr[$i]->hoanthanh.'%');
		if ($arr[$i]->hai == 1) {$hai = "X"; $count2 +=1;} else $hai ="";
		$activeSheet->setCellValue('J'.$num, $hai);
		if ($arr[$i]->ba == 1) {$ba = "X"; $count3 +=1;} else $ba ="";
		$activeSheet->setCellValue('K'.$num, $ba);
		if ($arr[$i]->tu == 1) {$tu = "X"; $count4 +=1;} else $tu ="";
		$activeSheet->setCellValue('L'.$num, $tu);
		if ($arr[$i]->nam == 1) {$nam = "X"; $count5 +=1;} else $nam ="";
		$activeSheet->setCellValue('M'.$num, $nam);
		if ($arr[$i]->sau == 1) {$sau = "X"; $count6 +=1;} else $sau ="";
		$activeSheet->setCellValue('N'.$num, $sau);
		if ($arr[$i]->bay == 1) {$bay = "X"; $count7 +=1;} else $bay ="";
		$activeSheet->setCellValue('O'.$num, $bay);
		$activeSheet->setCellValue('P'.$num, $arr[$i]->ykiendexuat);
		if ($arr[$i]->hoanthanh==100) $counthoanthanh +=1;
		if ($phuctap=="X") $countphuctap +=1;
		$activeSheet->getStyle(
				'B'.$num.':Q'.$num
		)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$num++;
	$stt++;
}
$activeSheet->setCellValue('F5', ($stt-1));
$activeSheet->setCellValue('G5', $counthoanthanh);
$activeSheet->setCellValue('H5', $stt-$counthoanthanh-1);
$activeSheet->setCellValue('I5', $countphuctap);
$activeSheet->setCellValue('J5', $count2);
$activeSheet->setCellValue('K5', $count3);
$activeSheet->setCellValue('L5', $count4);
$activeSheet->setCellValue('M5', $count5);
$activeSheet->setCellValue('N5', $count6);
$activeSheet->setCellValue('O5', $count7);
$activeSheet->mergeCells('B9:B'.($num-1));
$activeSheet->getStyle('B9:B'.($num-1))->applyFromArray($canhgiua);
$activeSheet->getStyle('B9:B'.($num-1))->applyFromArray($indam);
$activeSheet->getStyle('C9:C'.(count($arr)+9))->applyFromArray($canhgiua);
for ($i='E'; $i<='O'; $i++)
$activeSheet->getStyle($i.'9:'.$i.(count($arr)+9))->applyFromArray($canhgiua);
$activeSheet->getStyle('D9:D'.(count($arr)+9))->applyFromArray($canhtrai);
$activeSheet->getStyle('P9:P'.(count($arr)+9))->applyFromArray($canhtrai);
$activeSheet->getStyle('Q9:Q'.(count($arr)+9))->applyFromArray($canhtrai);
$phpColor = new PHPExcel_Style_Color();
$phpColor->setRGB('FF0000');

$activeSheet->setCellValue('D'.($count+9+6), 'Ghi chú:');
$activeSheet->getStyle('D'.($count+9+6))->applyFromArray($gachdit);
$activeSheet->getStyle('D'.($count+9+6))->applyFromArray($innghieng);
$activeSheet->getStyle('D'.($count+9+6))->applyFromArray($indam);
$activeSheet->getStyle('D'.($count+9+6))->getFont()->setColor( $phpColor );
$objRichText = new PHPExcel_RichText();
$objBold = $objRichText->createTextRun('CÔNG VIỆC:');
$objBold->getFont()->setBold(true);
$objRichText->createText(' Ghi tên công việc mà mình làm thực tế.');
$activeSheet->setCellValue('D'.($count+9+7), $objRichText);
$activeSheet->mergeCells('D'.($count+9+7).':O'.($count+9+7));
unset($objBold);
$objRichText = new PHPExcel_RichText();
$objBold = $objRichText->createTextRun('MÃ DỰ ÁN:');
$objBold->getFont()->setBold(true);
$objRichText->createText(' Ghi mã dự án nếu có');
$activeSheet->setCellValue('D'.($count+9+8), $objRichText);
$activeSheet->mergeCells('D'.($count+9+8).':O'.($count+9+8));
unset($objBold);
$objRichText = new PHPExcel_RichText();
$objBold = $objRichText->createTextRun('PHỨC TẠP:');
$objRichText->createText(' Đánh dấu X nếu công việc đó cảm thấy phức tạp đối với mình (công việc khó hoặc tốn nhiều thời gian)');
$objBold->getFont()->setBold(true);

$activeSheet->setCellValue('D'.($count+9+9), $objRichText);
$activeSheet->mergeCells('D'.($count+9+9).':O'.($count+9+9));
unset($objBold);
$objRichText = new PHPExcel_RichText();
$objBold = $objRichText->createTextRun('THỜI GIAN DỰ KIẾN:');
$objBold->getFont()->setBold(true);
$objRichText->createText(' Ghi thời gian dự kiến hoàn thành công việc đó');
$activeSheet->setCellValue('D'.($count+9+10), $objRichText);
$activeSheet->mergeCells('D'.($count+9+10).':O'.($count+9+10));
unset($objBold);
$objRichText = new PHPExcel_RichText();
$objBold = $objRichText->createTextRun('HOÀN THÀNH:');
$objBold->getFont()->setBold(true);
$objRichText->createText(' Ghi ước lượng bao nhiêu phần trăm mức độ hoàn thành công việc tại thời điểm viết báo cáo');
$activeSheet->setCellValue('D'.($count+9+11), $objRichText);
$activeSheet->mergeCells('D'.($count+9+11).':O'.($count+9+11));
unset($objBold);
$objRichText = new PHPExcel_RichText();
$objBold = $objRichText->createTextRun('THỨ TRONG TUẦN:');
$objBold->getFont()->setBold(true);
$objRichText->createText(' Đánh dấu X vào ngày làm thực công việc đó');
$activeSheet->setCellValue('D'.($count+9+11), $objRichText);
$activeSheet->mergeCells('D'.($count+9+11).':O'.($count+9+11));
unset($objBold);
$objRichText = new PHPExcel_RichText();
$objBold = $objRichText->createTextRun('Ý KIẾN/ĐỀ XUẤT:');
$objBold->getFont()->setBold(true);
$objRichText->createText(' Ghi ý kiến đề xuất giải quyết công việc nếu có');
$activeSheet->setCellValue('D'.($count+9+12), $objRichText);
$activeSheet->mergeCells('D'.($count+9+12).':O'.($count+9+12));
unset($objBold);
$objRichText = new PHPExcel_RichText();
$objBold = $objRichText->createTextRun('TRƯỞNG PHÒNG ĐÁNH GIÁ:');
$objBold->getFont()->setBold(true);
$objRichText->createText(' Dành cho Lãnh đạo phòng Ghi nội dung đánh giá công việc');
$activeSheet->setCellValue('D'.($count+9+13), $objRichText);
$activeSheet->mergeCells('D'.($count+9+13).':O'.($count+9+13));


/**
 * start export
*/
ob_end_clean();
$str =$arr[0]->tennhanvien;
$arr = explode(' ', $str);
$tennv=$arr[count($arr)-1];
for($i=0; $i<=(count($arr)-2); $i++){
		$tennv .= $arr[$i][0];
}
$excelFileName = 'Báo cáo công việc tuần - '.$tennv.'_'.date('dmY');
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $excelFileName .'.xlsx"');
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1');
header ('Expires: Mon, 20 Jan 2015 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$objWriter->save('php://output');
exit();
?>