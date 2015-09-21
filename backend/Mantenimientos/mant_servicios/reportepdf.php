
<?php
 date_default_timezone_set("America/El_Salvador");
require_once("../../dompdf/dompdf/dompdf_config.inc.php");
$conn = mysql_connect("localhost", "root") or die("error");
mysql_select_db("winefun", $conn) or die("error 2 ");



$codigohtml='



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
</head>


<body>
<div align="center">
<center><img src="WineFun.jpeg"></center>
<center><font face="Arial, Helvetica, sans-serif"><strong>Wine Fun</strong></font></center>
<center><h3>Reporte Servicios</h3></center>

<?php 
  	echo "fecha:".date("d/m/y");
	echo "<br>";
	echo "hora:".date("h:i:a");
	
?>
<table width="600" border="0">
<tr>
	
    <td bgcolor="#0099FF">CODIGO</td>
    <td bgcolor="#0099FF">TIPO</td>
    <td bgcolor="#0099FF">DESCRIPCION</td>
    <td bgcolor="#0099FF">PRECIO</td>
  </tr>';
  
  $sql=mysql_query("select * from servicios");
  while($res=mysql_fetch_array($sql))
  {
  $codigohtml.='
  <tr>
  	<td>'.$res['id_servicio'].'</td>
	<td>'.$res['tipò'].'</td>
	<td>'.$res['descripcion'].'</td>
  <td>'.$res['precio'].'</td>
  </tr>';
  
  }
  
  $codigohtml.='
 
</table>
</div>
</body>
</html>';
$codigohtml=utf8_encode($codigohtml);
$dompdf=new DOMPDF();
$dompdf->load_html($codigohtml);
ini_set("memory_limit","128M");
$dompdf->render();
$dompdf->stream("Reporte_tabla_servicios.pdf");
header("location:servicios.php")
?>
 