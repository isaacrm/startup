<!DOCTYPE html>
<html lang="es">
<head>
    <title>Winefun | Imagenes</title>
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
                        Preguntas</div>
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
                                            <th>URL</th>
                                            <th>TITULO</th>
                                            <th>DESCRIPCION</th>
                                            <th>ID</th>
                                        </tr>
                                        <tbody>
                                        <?php
                                        require("bd.php");
                                        $sql = "SELECT id_imagen_servicio, url, titulo, descripcion, id_servicio FROM imagenes_servicios ORDER BY id_imagen_servicio ASC";
                                        $data = "";
                                        foreach($PDO->query($sql) as $row) {
                                            $data .= "<tr>";
                                            $data .= "<td>$row[id_imagen_servicio]</td>";
                                            $data .= "<td>$row[url]</td>";
                                            $data .= "<td>$row[titulo]</td>";
                                            $data .= "<td>$row[descripcion]</td>";
                                            $data .= "<td>$row[id_servicio]</td>";
                                            $data .= "<td>";
                                            $data .= "<a class='btn btn-xs btn-info' href='../mant_imagenes_servicios/consultar.php?id_imagen_servicio=$row[id_imagen_servicio]'>Consultar</a>&nbsp;";
                                            $data .= "<a class='btn btn-xs btn-primary' href='../mant_imagenes_servicios/actualizar.php?id_imagen_servicio=$row[id_imagen_servicio]'>Actualizar</a>&nbsp;";
                                            $data .= "<a class='btn btn-xs btn-danger' href='../mant_imagenes_servicios/eliminar.php?id_imagen_servicio=$row[id_imagen_servicio]'>Eliminar</a>";
                                            $data .= "</td>";
                                            $data .= "</tr>";
                                        }
                                        print($data);
                                        $PDO = null;
                                        ?>
                                        </tbody>
                                    </table>
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
<?php
/**
 * Created by PhpStorm.
 * User: Karen
 * Date: 17/05/2015
 * Time: 11:31 PM
 */