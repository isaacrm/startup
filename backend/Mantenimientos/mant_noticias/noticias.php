<?php
//creamos la sesion
session_start();
//validamos si se ha hecho o no el inicio de sesion correctamente
//si no se ha hecho la sesion nos regresará a login.php
if(!isset($_SESSION['alias']))
{
    header('Location: ../../Login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Winefun | Noticias</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../estilos2.php';?>
</head>
<body>
<div>
    <!--BEGIN THEME SETTING--><!--END THEME SETTING-->
    <!--BEGIN BACK TO TOP-->
    <a id="totop" href="#"><i class="fa fa-angle-up"></i></a>
    <!--END BACK TO TOP-->
    <?php include '../topbar.php';?>
    <div id="wrapper">
        <?php include '../sidebar.php';?>
        <!--BEGIN PAGE WRAPPER-->
        <div id="page-wrapper">
            <!--BEGIN TITLE & BREADCRUMB PAGE-->
            <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">
                        Noticias</div>
                </div>
                <div class="clearfix">
                </div>
                <!-- Form validations -->

                <div class="row">
                    <div class="col-lg-12">

                        <div class='container col-lg-12'>
                            <div class='row'>
                                <p><a class='btn btn-xs btn-success' href='crear.php'>Crear</a></p>
                                <div class="table-responsive">
                                    <table class='table table-striped table-bordered table-hover'>
                                        <tr class='warning '>
                                            <th>ID</th>
                                            <th>TITULO</th>
                                            <th>SUBTITULO</th>
                                            <th>LEYENDA</th>
                                            <th>ACCION</th>
                                        </tr>
                                        <tbody>
                                        <?php
                                        error_reporting(E_ALL ^ E_NOTICE);
                                        require("../../bd.php");
                                        /*Se llama la libreria de paginacion*/
                                        require_once("../../libs/Zebra_Pagination.php");
                                        /*Aqui obtenemos el total de registros*/
                                        $sql0 = "SELECT COUNT(*) as total_datos FROM noticias";
                                        foreach ($PDO->query($sql0) as $row0) {
                                            $totaldatos = "$row0[total_datos]";
                                        }
                                        /*Numero de registros que se quiere por tabla*/
                                        $filas = 10;
                                        /*Aqui instanciamos la clase*/
                                        $paginacion = new Zebra_Pagination();
                                        /*Definimos el numero de registros que se quieren mostrar en las tablas*/
                                        $paginacion->records($totaldatos);
                                        $paginacion->records_per_page($filas);
                                        $paginacion->padding(false);
                                        $sql = "SELECT id_noticia, titulo, subtitulo, leyenda, foto FROM noticias ORDER BY id_noticia ASC LIMIT " . (($paginacion->get_page() - 1) * $filas) . ', ' . $filas;
                                        $data = "";
                                        foreach($PDO->query($sql) as $row) {
                                            $data .= "<tr>";
                                            $data .= "<td>$row[id_noticia]</td>";
                                            $data .= "<td>$row[titulo]</td>";
                                            $data .= "<td>$row[subtitulo]</td>";
                                            $data .= "<td>$row[leyenda]</td>";
                                            $data .= "<td>";
                                            $data .= "<a class='btn btn-xs btn-info' href='consultar.php?id_noticia=$row[id_noticia]'>Consultar</a>&nbsp;";
                                            $data .= "<a class='btn btn-xs btn-primary' href='actualizar.php?id_noticia=$row[id_noticia]'>Actualizar</a>&nbsp;";
                                            $data .= "<a class='btn btn-xs btn-danger' href='eliminar.php?id_noticia=$row[id_noticia]'>Eliminar</a>";
                                            $data .= "</td>";
                                            $data .= "</tr>";
                                        }
                                        print($data);
                                        $PDO = null;
                                        ?>
                                        </tbody>
                                    </table>
                                    <!-- Aqui se imprime la paginacion-->
                                    <div>
                                        <?php $paginacion->render();?>
                                    </div>
                                </div>
                            </div> <!-- /row -->

                        </div>
                    </div>
                </div>
                <!--END TITLE & BREADCRUMB PAGE-->
                <!--BEGIN CONTENT-->
                <div class="page-content"></div>
                <!--END CONTENT-->
            </div>
            <!--END PAGE WRAPPER-->
        </div>
    </div>
    <?php include '../funciones2.php';?>
</body>
</html>

/**
 * Created by PhpStorm.
 * User: Karen
 * Date: 16/05/2015
 * Time: 09:38 PM
 */