<?php
require("bd2.php");
//Numero de filas de empleados
$sql = "SELECT * FROM empleados";
$result = mysql_query($sql);
$numero = mysql_num_rows($result);
//Numero de filas de usuarios
$sql2 = "SELECT * FROM usuarios";
$result2 = mysql_query($sql2);
$numero2 = mysql_num_rows($result2);
//Numero de filas de tipos de usuarios
$sql3 = "SELECT * FROM tipos_usuarios";
$result3 = mysql_query($sql3);
$numero3 = mysql_num_rows($result3);

if ($numero!=0 && $numero2!=0 && $numero3!=0) {
    header("Location: Login.php");
}

?>