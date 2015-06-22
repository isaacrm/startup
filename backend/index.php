<?php
//creamos la sesion
session_start();
//validamos si se ha hecho o no el inicio de sesion correctamente
//si no se ha hecho la sesion nos regresará a login.php
if(!isset($_SESSION['alias']))
{

    header('Location: Login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Dashboard | Dashboard</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'Mantenimientos/estilos.php';?>
</head>
<body>
    <div>
        <!--BEGIN THEME SETTING--><!--END THEME SETTING-->
        <!--BEGIN BACK TO TOP-->
        <a id="totop" href="#"><i class="fa fa-angle-up"></i></a>
        <!--END BACK TO TOP-->
        <?php include 'Mantenimientos/topbar2.php';?>
        <div id="wrapper">
            <?php include 'Mantenimientos/sidebar2.php';?>
            <!--BEGIN PAGE WRAPPER-->
            <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left">
                        <div class="page-title">
                            Inicio</div>
                    </div>
                    <div class="clearfix">
                    </div>
                </div>
             <div class="page-content">
                <h1 class="text-center">BIENVENIDOS AL SITIO ADMNISTRATIVO DE WINEFUN</h1>
                <img class="img-responsive" src="img_page/fondo.jpg">
             </div>
                <!--BEGIN CONTENT-->

            <!--END PAGE WRAPPER-->
        </div>
</div>
    <?php include 'Mantenimientos/funciones.php';?>
</body>
</html>
