<?php
$config = array();
$config["sql_host"] = "localhost";
$config["sql_user"] = "winefun";
$config["sql_pass"] = "startup2015";
$config["sql_database"] = "winefun";
$sql_link = mysql_connect($config['sql_host'], $config['sql_user'], $config['sql_pass']) or die(mysql_error($sql_link));
mysql_select_db($config['sql_database'],$sql_link);
?>