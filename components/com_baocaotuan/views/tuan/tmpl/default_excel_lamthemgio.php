<?php
/**
 * Author: Phucnh
 * Date created: Jan 23, 2015
 * Company: DNICT
 */

$border_th = array(
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
$objPHPExcel = new PHPExcel();
$objPHPExcel->getDefaultStyle()->getFont()->setName('Times New Roman')->setSize(13);
$row = $this->rows;
$sheet = 1;
foreach ($row as $key => $val)
{
	$tennv = $val[0]->tennhanvien;
	$objWorkSheet=$objPHPExcel->createSheet($key);
	$objPHPExcel->setActiveSheetIndex($sheet);
	$activeSheet = $objPHPExcel->getActiveSheet(); /* get sheet active */
	$activeSheet->getStyle('B1:G50')->getAlignment()->setWrapText(true);
	$activeSheet->getStyle('A10:G11')->applyFromArray($border_th);
	$activeSheet->setCellValue('A1', 'TRUNG TÂM CÔNG NGHỆ THÔNG TIN VÀ TRUYỂN THÔNG')
	->setCellValue('C1', 'CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM')
	->setCellValue('C2', 'Độc lập - Tự do - Hạnh phúc')
	->setCellValue('A2', 'PHÒNG PHÁT TRIỂN PHẦN MỀM');
	$activeSheet->mergeCells('A1:B1');
	$activeSheet->getStyle('A1:B1')->applyFromArray($canhgiua)->applyFromArray($indam);
	$activeSheet->getStyle('A2:B2')->applyFromArray($gachdit);
	$activeSheet->getStyle('C2:G2')->applyFromArray($gachdit);
	$activeSheet->mergeCells('A2:B2');
	$activeSheet->getStyle('A2:B2')->applyFromArray($canhgiua)->applyFromArray($indam);
	$activeSheet->mergeCells('C1:G1');
	$activeSheet->getStyle('C1:G1')->applyFromArray($canhgiua)->applyFromArray($indam);
	$activeSheet->mergeCells('C2:G2');
	$activeSheet->getStyle('C2:G2')->applyFromArray($canhgiua)->applyFromArray($indam);
	$a_date = $val[0]->namlamthem."-".$key."-01";
	$tu= date("01/m/Y", strtotime($a_date));
	$den= date("t/m/Y", strtotime($a_date));
	
	$objRichText = new PHPExcel_RichText();
	$objRichText->createText('Tháng '.$key.': ');
	$objBold = $objRichText->createTextRun($tu.' - '.$den);
	$objBold->getFont()->setItalic(true)->setName('Times New Roman')->setSize(13);
	$activeSheet->setCellValue('B5', $objRichText);
	unset($objBold);
	$activeSheet->setCellValue('B4', 'GIẤY BÁO LÀM THÊM GIỜ');
	$activeSheet->mergeCells('B4:F4')->mergeCells('B5:F5');
	$activeSheet->getStyle('B4:F4')->applyFromArray($canhgiua)->applyFromArray($indam);
	$activeSheet->getStyle('B5:F5')->applyFromArray($canhgiua);
	
	$objRichText = new PHPExcel_RichText();
	$objRichText->createText('Họ và tên: ');
	$objBold = $objRichText->createTextRun($val[0]->tennhanvien);
	$objBold->getFont()->setBold(true)->setSize(13);
	$activeSheet->setCellValue('A7', $objRichText);
	unset($objBold);
	
	$activeSheet->setCellValue('A8', "Bộ phận công tác: Nhân viên phòng Phòng Phát triển phần mềm");
	$activeSheet->setCellValue('A10', 'Ngày, tháng')->setCellValue('B10', "Những công việc đã làm")->setCellValue('C10', "Những công việc đã làm")
	->setCellValue('C11', 'Từ giờ')->setCellValue('D11', 'Đến giờ')->setCellValue('E11', 'Tổng giờ')->setCellValue('F11', 'Đơn giá')->setCellValue('G11', 'Thành tiền');
	$activeSheet->mergeCells('A10:A11')->mergeCells('B10:B11')->mergeCells('C10:G10');
	$activeSheet->getStyle('A10:A11')->applyFromArray($canhgiua)->applyFromArray($indam);
	$activeSheet->getStyle('B10:B11')->applyFromArray($canhgiua)->applyFromArray($indam);
	$activeSheet->getStyle('C10:G10')->applyFromArray($canhgiua)->applyFromArray($indam);
	$activeSheet->getStyle('C11:G11')->applyFromArray($canhgiua);
	$tongthoigian=0;
	for($i=0; $i<count($val); $i++){
		$stt = 12+$i;
		$activeSheet->setCellValue('A'.$stt, $val[$i]->ngaylamthem)->setCellValue('B'.$stt, $val[$i]->congvieclamthem)->setCellValue('C'.$stt, $val[$i]->timebatdau)
		->setCellValue('D'.$stt, $val[$i]->timeketthuc)->setCellValue('E'.$stt, $val[$i]->thoigian);
		$tongthoigian += $val[$i]->thoigian;
		$activeSheet->getStyle('A'.$stt.':G'.$stt)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$activeSheet->getStyle('A'.$stt.':'.'A'.$stt)->applyFromArray($canhgiua);
		$activeSheet->getStyle('B'.$stt.':'.'B'.$stt)->applyFromArray($canhtrai);
		$activeSheet->getStyle('C'.$stt.':'.'C'.$stt)->applyFromArray($canhgiua);
		$activeSheet->getStyle('D'.$stt.':'.'D'.$stt)->applyFromArray($canhgiua);
		$activeSheet->getStyle('E'.$stt.':'.'E'.$stt)->applyFromArray($canhgiua);
	}
	$activeSheet->setCellValue('A'.($stt+1), 'Tổng giờ')->setCellValue('E'.($stt+1), $tongthoigian);
	$activeSheet->mergeCells('A'.($stt+1).':D'.($stt+1));
	$activeSheet->getStyle('A'.($stt+1).':G'.($stt+1))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$activeSheet->getStyle('A'.($stt+1).':'.'G'.($stt+1))->applyFromArray($indam)->applyFromArray($canhgiua);
	$stt = $stt+3;
	$activeSheet->setCellValue('A'.$stt, 'Người báo làm thêm giờ');
	$activeSheet->mergeCells('A'.$stt.':B'.$stt);
	$activeSheet->setCellValue('C'.$stt, 'Trưởng phòng');
	$activeSheet->mergeCells('C'.$stt.':G'.$stt);
	$activeSheet->getStyle('A'.$stt.':'.'G'.$stt)->applyFromArray($indam)->applyFromArray($canhgiua);
	$activeSheet->getColumnDimension('A')->setWidth(15);
	$activeSheet->getColumnDimension('B')->setWidth(50);
	$activeSheet->getColumnDimension('C')->setWidth(8);
	$activeSheet->getColumnDimension('D')->setWidth(8);
	$activeSheet->getColumnDimension('E')->setWidth(8);
	$activeSheet->getColumnDimension('F')->setWidth(8);
	$activeSheet->getColumnDimension('G')->setWidth(15);
	$objWorkSheet->setTitle("T$key");
	$sheet++;
}
$objPHPExcel->removeSheetByIndex(0);
/**
 * start export
*/
ob_end_clean();
$excelFileName = 'Làm thêm giờ - '.$tennv;
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