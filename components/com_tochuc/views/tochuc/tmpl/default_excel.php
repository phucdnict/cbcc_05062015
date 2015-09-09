<?php
/**
 * Author: Phucnh
 * Date created: Jan 23, 2015
 * Company: DNICT
 */
$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0); /* chon sheet active la sheet 1 */
$activeSheet = $objPHPExcel->getActiveSheet(); /* get sheet active */
$styleArray = array(
		'font' => array(
				'bold' => true
		),
		'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		),
		'borders' => array(
				'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
				)
		)
);
$border = array(
		'borders' => array(
				'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
				)
		)
);
$activeSheet->getStyle('A1:F1')->applyFromArray($styleArray); /* apply style cho column từ A1 -> AB4 */
$activeSheet->setCellValue('A1', 'STT'); /* set value cho A1 */
$activeSheet->setCellValue('B1', 'Ngày hiệu lực');
$activeSheet->setCellValue('C1', 'Cách thức');
$activeSheet->setCellValue('D1', 'Quyết định');
$activeSheet->setCellValue('E1', 'Chi tiết');
$activeSheet->setCellValue('F1', 'Ghi chú');
$activeSheet->getColumnDimension('A')->setWidth(5);
$activeSheet->getColumnDimension('B')->setWidth(15);
$activeSheet->getColumnDimension('C')->setWidth(40);
$activeSheet->getColumnDimension('D')->setWidth(30);
$activeSheet->getColumnDimension('E')->setWidth(40);
$activeSheet->getColumnDimension('F')->setWidth(40);
$arr= $this->rows;
$num = 2; // cột số 1,2,3 trong excel
$stt=1;
for($i=0; $i<count($arr);$i++)
{
		$activeSheet->setCellValue('A'.$num, $stt);
		if ($arr[$i]->hieuluc_ngay===null  || $arr[$i]->hieuluc_ngay ==='0000-00-00' || $arr[$i]->hieuluc_ngay ==='')  
		 $ngayhieuluc = ""; 
		else $ngayhieuluc = date('d/m/Y', strtotime($arr[$i]->hieuluc_ngay));
		$activeSheet->setCellValue('B'.$num, $ngayhieuluc);
		$activeSheet->setCellValue('C'.$num, $arr[$i]->cachthuc_name);
		$activeSheet->setCellValue('D'.$num, $arr[$i]->quyetdinh_so);
		$activeSheet->setCellValue('E'.$num, $arr[$i]->chitiet);
		$activeSheet->setCellValue('F'.$num, $arr[$i]->ghichu);
		$activeSheet->getStyle(
				'A'.$num.':F'.$num
		)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$num++;
	$stt++;
}
/**
 * start export
*/
ob_end_clean();
$excelFileName = 'Lichsutochuc';
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