<?php
/**
 * Author: Phucnh
 * Date created: May 23, 2015
 * Company: DNICT
 * Dự thảo kỷ luật
 */ 
?>
<html>
<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<style>
<!--
 /* Font Definitions */
 @font-face
	{font-family:Wingdings;
	panose-1:5 0 0 0 0 0 0 0 0 0;}
@font-face
	{font-family:Wingdings;
	panose-1:5 0 0 0 0 0 0 0 0 0;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{margin:0cm;
	margin-bottom:.0001pt;
	font-size:12.0pt;
	font-family:"Times New Roman","serif";}
p.MsoHeader, li.MsoHeader, div.MsoHeader
	{margin:0cm;
	margin-bottom:.0001pt;
	font-size:12.0pt;
	font-family:"Times New Roman","serif";}
p.MsoFooter, li.MsoFooter, div.MsoFooter
	{margin:0cm;
	margin-bottom:.0001pt;
	font-size:12.0pt;
	font-family:"Times New Roman","serif";}
p.MsoBodyTextIndent, li.MsoBodyTextIndent, div.MsoBodyTextIndent
	{margin:0cm;
	margin-bottom:.0001pt;
	text-align:justify;
	text-indent:42.0pt;
	font-size:14.0pt;
	font-family:"Times New Roman","serif";}
a:link, span.MsoHyperlink
	{color:blue;
	text-decoration:underline;}
a:visited, span.MsoHyperlinkFollowed
	{color:purple;
	text-decoration:underline;}
p.DefaultParagraphFontParaCharCharCharCharChar, li.DefaultParagraphFontParaCharCharCharCharChar, div.DefaultParagraphFontParaCharCharCharCharChar
	{mso-style-name:"Default Paragraph Font Para Char Char Char Char Char";
	margin-top:6.0pt;
	margin-right:0cm;
	margin-bottom:6.0pt;
	margin-left:0cm;
	line-height:130%;
	font-size:13.0pt;
	font-family:"Arial","sans-serif";}
p.Char, li.Char, div.Char
	{mso-style-name:" Char";
	margin-top:6.0pt;
	margin-right:0cm;
	margin-bottom:6.0pt;
	margin-left:0cm;
	line-height:130%;
	font-size:13.0pt;
	font-family:"Arial","sans-serif";}
 /* Page Definitions */
 @page WordSection1
	{size:21.0cm 842.0pt;
	margin:2.0cm 2.0cm 2.0cm 3.0cm;}
div.WordSection1
	{page:WordSection1;}
 /* List Definitions */
 ol
	{margin-bottom:0cm;}
ul
	{margin-bottom:0cm;}
-->
</style>
</head>
<body lang=EN-US>
<div class=WordSection1>
<?php 
$data = $this->data;
if($data->donvichuquan_id <=0) $donvichuquan='......................';
else
$donvichuquan		=	$data->donvichuquan == null ? '......................': mb_strtoupper($data->donvichuquan);
$hoten					=	$data->hoten;
$gioitinh				=	$data->gioitinh == 'Nam' ? 'ông':'bà';
$loaihinh				=	$data->ins_loaihinh;
$congtac_chucvu	=	$data->congtac_chucvu;
$ngaysinh				=	date('d/m/Y', strtotime($data->ngaysinh));
if ($loaihinh == 1){
	$congvienchuc = 'công chức';
}
elseif($loaihinh==2){
	$congvienchuc = 'viên chức';
}

$congtac_donvi			=	$data->congtac_donvi ==null ? '...............':$data->congtac_donvi;
$donviup 						=	mb_strtoupper($congtac_donvi);

$str="<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=634
 style='width:475.35pt;margin-left:5.4pt;border-collapse:collapse'>
 <tr><td colspan='2'>
 <table>
  <tr>
  <td colspan='3' style='width:35%'>
  <p class=MsoNormal align=center style='text-align:center'>$donvichuquan</p>
  </td>
  <td width=385 colspan='6' style='width:65%' valign=top>
  <p class=MsoNormal align=center style='text-align:center'><b>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</b></p>
  </td>
 </tr>
  <tr>
  <td width=249 valign=top  style='width:35%'  colspan='3'>
  <p class=MsoNormal align=center style='text-align:center'><b><span>$donviup</span></b></p>
  </td>
  <td width=385 valign=top colspan='6' style='width:65%'>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:13.0pt'>Độc lập - tự do - Hạnh phúc</span></b></p>
  </td>
 </tr>
 <tr>
 <td style='width:10%'></td><td style='width:15%'><hr/></td><td style='width:10%'></td>
 <td colspan='6' style='width:65%'><hr style='width:180'/></td>
 </tr>
 </table>
 </td></tr>
 </tr>
 </table>
 <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=634 style='width:475.35pt;margin-left:5.4pt;border-collapse:collapse'>
 <tr>
  <td width=249 valign=top style='width:186.8pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'>Số: &nbsp;&nbsp;&nbsp;&nbsp;/QĐ-CQ,ĐV</p>
  </td>
  <td width=385 valign=top style='width:288.55pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><i>Cần Thơ,  ngày       tháng       năm 201…</i></p>
  </td>
 </tr>
 <tr>
  <td width=249 valign=top style='width:186.8pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoBodyTextIndent align=center style='margin-top:6.0pt;text-align:
  center;text-indent:0in;line-height:120%'><span style='font-size:9.0pt;
  line-height:120%'>&nbsp;</span></p>
  </td>
  <td width=385 valign=top style='width:288.55pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><i><span
  style='font-size:9.0pt'>&nbsp;</span></i></p>
  </td>
 </tr>
</table>

<p class=MsoNormal align=center style='margin-top:6.0pt;text-align:center'><b><span
style='font-size:13.0pt'>QUYẾT ĐỊNH</span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b><span
style='font-size:13.0pt'>V/v xử lý kỷ luật $gioitinh <br/>$hoten</span></span></b></p>

<table cellpadding=0 cellspacing=0 align=left>
 <tr>
  <td width=251 height=5></td>
 </tr>
 <tr>
  <td></td>
  <td><hr style='width=151'/></td>
 </tr>
</table>
<br/>
<p align=center style=';margin-top:6.0pt;text-align:center'><b><span
style='font-size:13.0pt'>THỦ TRƯỞNG $donviup</span></b></p>
<p class=MsoNormal style='text-align:justify'><b><span style='font-size:13.0pt'>&nbsp;</span></b></p>

<p class=MsoNormal style='margin-top:6.0pt;text-align:justify; text-indent:55'><b><span
style='font-size:13.0pt'></span></b><span style='font-size:13.0pt'>Căn cứ Nghị định số 34/2011/NĐ-CP ngày 17 tháng 5 năm 2011 của Chính phủ Quy định về xử lý kỷ luật đối với công chức; Nghị định số 27 ngày 06 tháng 4 năm 2012 của Chính phủ quy định về xử lý kỷ luật viên chức và trách nhiệm bồi thường, hoàn trả của viên chức;</span></p>

<p class=MsoNormal style='margin-top:6.0pt;text-align:justify; text-indent:55'><span
style='font-size:13.0pt'>Căn cứ các văn bản hướng dẫn thi hành :</span></p>

<p class=MsoNormal style='margin-top:6.0pt;text-align:justify; text-indent:55'><span
style='font-size:13.0pt'>Xét đề nghị của ……………………………..,</span></span></p>

<p class=MsoNormal align=center style='margin-top:12.0pt;text-align:center;
line-height:150%'><b><span style='font-size:13.0pt;line-height:150%'>QUYẾT ĐỊNH:</span></b></p>

<p class=MsoNormal style='margin-top:6.0pt;text-align:justify; text-indent:55'><span
style='font-size:13.0pt'><b>Điều 1. </b>Nay thi hành kỷ luật $gioitinh $hoten, là $congtac_chucvu $congtac_donvi bằng hình thức ……………………</span></p>
<p class=MsoNormal style='margin-top:6.0pt;text-align:justify; text-indent:55'><span
style='font-size:13.0pt'>Lý do: ……………………………………………….</span></p>

<p class=MsoNormal style='margin-top:6.0pt;text-align:justify; text-indent:55'><b><span
style='font-size:13.0pt'>Điều 2. </b><span style='font-size:13.0pt'>........................................................................... và $gioitinh $hoten có tên tại Điều 1 chịu trách nhiệm thi hành Quyết định này kể từ ngày ký./.</span></p>

<p class=MsoNormal style='margin-top:6.0pt;text-align:justify;text-indent:.5in'><span
style='font-size:13.0pt'>&nbsp;</span></p>

<div align=center>

<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=615
 style='width:461.5pt;margin-left:-18.7pt;border-collapse:collapse'>
 <tr>
  <td width=320 valign=top style='width:240.1pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><i><span style='font-size:11.0pt'>N&#417;i nh&#7853;n:</span></i></b><b><i><br>
  </i></b><span style='font-size:10.0pt'>- Nh&#432; Điều 2;<br>
  - L&#432;u: VT, TH.  </span></p>
  </td>
  <td width=295 valign=top style='width:221.4pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:13.0pt'>GIÁM ĐỐC<br>
  <br>
  </span></b></p>
  <p class=MsoNormal align=center style='text-align:center'><i><span
  style='font-size:13.0pt'>&nbsp;</span></i></p>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:13.0pt'></span></b></p>
  </td>
 </tr>
</table>

</div>

<p class=MsoNormal><span style='font-size:11.0pt'>&nbsp;</span></p>

</div>";
echo $str;
?>
</body>

</html>
