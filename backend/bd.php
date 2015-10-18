<?php
$host = 'localhost';
$user = 'winefun';
$pass = 'startup2015';
$dbname = 'winefun';
try
{
    $PDO = new PDO("mysql:host=".$host."; "."dbname=".$dbname, $user, $pass);
}
catch(PDOException $e)
{
    die($e->getMessage());
}
?>