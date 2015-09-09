<?php
/**
 * Author: Phucnh
 * Date created: Apr 25, 2015
 * Company: DNICT
 * Dự thảo khen thưởng
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
	font-size:13.0pt;
	font-family:"Times New Roman","serif";}
p.MsoHeader, li.MsoHeader, div.MsoHeader
	{margin:0cm;
	margin-bottom:.0001pt;
	font-size:14.0pt;
	font-family:"Times New Roman","serif";}
p.MsoFooter, li.MsoFooter, div.MsoFooter
	{margin:0cm;
	margin-bottom:.0001pt;
	font-size:14.0pt;
	font-family:"Times New Roman","serif";}
p.MsoBodyTextIndent, li.MsoBodyTextIndent, div.MsoBodyTextIndent
	{margin:0cm;
	margin-bottom:.0001pt;
	text-align:justify;
	text-indent:42.0pt;
	font-size:15.0pt;
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
	line-height:140%;
	font-size:14.0pt;
	font-family:"Arial","sans-serif";}
p.Char, li.Char, div.Char
	{mso-style-name:" Char";
	margin-top:6.0pt;
	margin-right:0cm;
	margin-bottom:6.0pt;
	margin-left:0cm;
	line-height:140%;
	font-size:14.0pt;
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
$hoten					=	$data->hoten;
$gioitinh				=	$data->gioitinh == 'Nam' ? 'ông':'bà';
$congtac_chucvu	=	$data->congtac_chucvu;
$congtac_donvi			=	$data->congtac_donvi ==null ? '...............':$data->congtac_donvi;

$str="<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=634
 style='width:475.35pt;margin-left:5.4pt;border-collapse:collapse'>
 <tr><td colspan='2'>
 <table>
  <tr>
  <td colspan='3' style='width:35%'>
  <p class=MsoNormal align=center style='text-align:center'><b>ỦY BAN NHÂN DÂN</b></p>
  </td>
  <td width=385 colspan='6' style='width:65%' valign=top>
  <p class=MsoNormal align=center style='text-align:center'><b>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</b></p>
  </td>
 </tr>
  <tr>
  <td width=249 valign=top  style='width:35%'  colspan='3'>
  <p class=MsoNormal align=center style='text-align:center'><b><span>THÀNH PHỐ CẦN THƠ</span></b></p>
  </td>
  <td width=385 valign=top colspan='6' style='width:65%'>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:14.0pt'>Độc lập - tự do - Hạnh phúc</span></b></p>
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
  <p class=MsoNormal align=center style='text-align:center'>Số: &nbsp;&nbsp;&nbsp;&nbsp;/QĐ-UBND</p>
  </td>
  <td width=385 valign=top style='width:288.55pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><i>Cần Thơ,  ngày       tháng       năm 201…</i></p>
  </td>
 </tr>
 <tr style='height:10px;'>
  <td>
  <p>&nbsp;</p>
  </td>
  <td>&nbsp;</p>
  </td>
 </tr>
 <tr>
  <td width=249 valign=top style='width:186.8pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoBodyTextIndent align=center style='margin-top:6.0pt;text-align:
  center;text-indent:0in;line-height:140%'><table style='	border-style: solid;border-width: 1px;'><tr><td><span style='font-size:14.0pt'>&nbsp;DỰ THẢO&nbsp;</span></td></tr></table></p>
  </td>
  <td width=385 valign=top style='width:288.55pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'></p>
  </td>
 </tr>
</table>

<p class=MsoNormal align=center style='margin-top:6.0pt;text-align:center'></p>

<p class=MsoNormal align=center style='margin-top:6.0pt;text-align:center'><b><span
style='font-size:14.0pt'>QUYẾT ĐỊNH</span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b><span
style='font-size:13.0pt'>V/v tặng Bằng khen của Chủ tịch UBND thành phố cho</span></b></p>
<p class=MsoNormal align=center style='text-align:center'><b>$gioitinh $hoten</b></p>
<p class=MsoNormal align=center style='text-align:center'>
	<table cellpadding=0 cellspacing=0 align=left>
	 <tr>
	  <td width=251 height=5></td>
	 </tr>
	 <tr>
	  <td></td>
	  <td><hr style='width=251'/></td>
	 </tr>
	</table>
</p>

<br clear=ALL>

<p class=MsoNormal align=center style='margin-top:0.0pt;text-align:center'><b><span
style='font-size:14.0pt'>CHỦ TỊCH ỦY BAN NHÂN DÂN THÀNH PHỐ CẦN THƠ</span></b></p>

<p class=MsoNormal style='text-align:justify'><b><span style='font-size:14.0pt'>&nbsp;</span></b></p>

<p class=MsoNormal style='margin-top:6.0pt;text-align:justify; text-indent:55'><span style='font-size:14.0pt'>Căn cứ Luật tổ chức HĐND và UBND ngày 26 tháng 11 năm 2003;</span></p>

<p class=MsoNormal style='margin-top:6.0pt;text-align:justify; text-indent:55'><span
style='font-size:14.0pt'>Căn cứ Luật Thi đua, Khen thưởng ngày 26 tháng 11 năm 2003; Luật sửa đổi, bổ sung một số điều của Luật Thi đua, Khen thưởng ngày 14 tháng 6 năm 2005 và Luật sửa đổi, bổ sung một số điều của Luật Thi đua, Khen thưởng ngày 16 tháng 11 năm 2013;</span></p>

<p class=MsoNormal style='margin-top:6.0pt;text-align:justify; text-indent:55'><span
style='font-size:14.0pt'>Căn cứ các văn bản hướng dẫn thi hành Luật Thi đua, Khen thưởng:</span></p>

<p class=MsoNormal style='margin-top:6.0pt;text-align:justify; text-indent:55'><span
style='font-size:14.0pt'>Theo đề nghị của Giám đốc Sở Nội vụ,</span></p>

<p class=MsoNormal align=center style='margin-top:14.0pt;text-align:center;
line-height:150%'><b><span style='font-size:14.0pt;line-height:150%'>QUYẾT ĐỊNH:</span></b></p>

<p class=MsoNormal style='margin-top:6.0pt;text-align:justify; text-indent:55'><span
style='font-size:14.0pt'><b>Điều 1. </b>Tặng Bằng khen của Chủ tịch UBND thành phố cho $gioitinh $hoten kèm theo tiền thưởng …………….. cho ……………….. (chi tiết theo danh sách đính kèm).</span></p>
<p class=MsoNormal style='margin-top:6.0pt;text-align:justify; text-indent:55'><span style='font-size:14.0pt'><b><i>Đã có thành tích thi đua hoàn thành xuất sắc nhiệm vụ năm 2014.</i></b></span></p>	
<p class=MsoNormal style='margin-top:6.0pt;text-align:justify; text-indent:100'><span style='font-size:14.0pt'>(Kinh phí khen thưởng: Trích quỹ thưởng của đơn vị).</span></p>

<p class=MsoNormal style='margin-top:6.0pt;text-align:justify; text-indent:55'><b><span
style='font-size:14.0pt'>Điều 2. </b><span style='font-size:14.0pt'>Chánh Văn phòng Ủy ban nhân dân thành phố, Giám đốc Sở Nội vụ, tập thể và cá nhân có tên tại Điều 1 chịu trách nhiệm thi hành Quyết định này kể từ ngày ký./.</span></p>

<p class=MsoNormal style='margin-top:6.0pt;text-align:justify;text-indent:.5in'><span
style='font-size:14.0pt'>&nbsp;</span></p>

<div align=center>

<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=615
 style='width:461.5pt;margin-left:-18.7pt;border-collapse:collapse'>
 <tr>
  <td width=320 valign=top style='width:240.1pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><i><span style='font-size:12.0pt'>N&#417;i nh&#7853;n:</span></i></b><b><i><br>
  </i></b><span style='font-size:12.0pt'>- Nh&#432; Điều 2;<br>
  - L&#432;u: VT, TH.  </span></p>
  </td>
  <td width=295 valign=top style='width:221.4pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:14.0pt'>CHỦ TỊCH<br>
  <br>
  </span></b></p>
  <p class=MsoNormal align=center style='text-align:center'><i><span
  style='font-size:14.0pt'>&nbsp;</span></i></p>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:14.0pt'></span></b></p>
  </td>
 </tr>
</table>

</div>

<p class=MsoNormal><span style='font-size:12.0pt'>&nbsp;</span></p>

</div>";
echo $str;
?>
</body>

</html>
