<!DOCTYPE html>
<html lang="es">
<head>
    <title>Winefun | Preguntas</title>
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
                                <p><a class='btn btn-xs btn-success' href='preguntas.php'>Crear</a></p>
                                <div class="table-responsive">
                                    <table class='table table-striped table-bordered table-hover'>
                                        <tr class='warning '>
                                            <th>ID</th>
                                            <th>PREGUNTA</th>
                                            <th>RESPUESTA</th>
                                            <th>ID</th>
                                        </tr>
                                        <tbody>
                                        <?php
                                        require("../../bd.php");
                                        $sql = "SELECT id_pregunta, pregunta, respuesta, id_pagina FROM preguntas ORDER BY id_preguntaa ASC";
                                        $data = "";
                                        foreach($PDO->query($sql) as $row) {
                                            $data .= "<tr>";
                                            $data .= "<td>$row[id_pregunta]</td>";
                                            $data .= "<td>$row[pregunta]</td>";
                                            $data .= "<td>$row[respuesta]</td>";
                                            $data .= "<td>$row[id_pagina]</td>";
                                            $data .= "<td>";
                                            $data .= "<a class='btn btn-xs btn-info' href='../mant_noticias/consultar.php?id_pregunta=$row[id_pregunta]'>Consultar</a>&nbsp;";
                                            $data .= "<a class='btn btn-xs btn-primary' href='../mant_noticias/actualizar.php?id_pregunta=$row[id_pregunta]'>Actualizar</a>&nbsp;";
                                            $data .= "<a class='btn btn-xs btn-danger' href='../mant_noticias/eliminar.php?id_pregunta=$row[id_pregunta]'>Eliminar</a>";
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
 * Time: 01:19 AM
 */