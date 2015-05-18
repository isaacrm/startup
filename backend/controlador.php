<?php
require("bd2.php");
$sql = "SELECT * FROM empleados";  // sentencia sql
$result = mysql_query($sql);
$numero = mysql_num_rows($result); // obtenemos el número de filas
require("bd2.php");
$sql2 = "SELECT * FROM usuarios";  // sentencia sql
$result2 = mysql_query($sql2);
$numero2 = mysql_num_rows($result2); // obtenemos el número de filas
require("bd2.php");
$sql3 = "SELECT * FROM tipos_usuarios";  // sentencia sql
$result3 = mysql_query($sql3);
$numero3 = mysql_num_rows($result3); // obtenemos el número de filas

if ($numero!=0 && $numero2!=0 && $numero3!=0) {
    header("Location: Login.php");
}

?>