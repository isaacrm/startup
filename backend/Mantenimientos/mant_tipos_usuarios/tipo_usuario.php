<!DOCTYPE html>
<html lang="es">
<head>
    <title>Winefun | Funciones</title>
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
                        Funciones</div>
                </div>
                <div class="clearfix">
                </div>
                <!-- Form validations -->

                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <div class='container'>
                                <div class='row'>
                                    <p><a class='btn btn-xs btn-success' href='crear.php'>Crear</a></p>
                                    <div class="table-responsive">
                                        <table class='table table-striped table-bordered table-hover'>
                                            <tr class='warning '>
                                                <th>ID</th>
                                                <th>NOMBRE</th>
                                                <th>DESCRIPCION</th>
                                                <th>ACCIÓN</th>
                                            </tr>
                                            <tbody>
                                            <?php
                                            require("../../bd.php");
                                            $sql = "SELECT id_tipo_usuario, nombre, descripcion FROM tipos_usuarios  ORDER BY id_tipo_usuario ASC";
                                            $data = "";
                                            foreach($PDO->query($sql) as $row) {
                                                $data .= "<tr>";
                                                $data .= "<td>$row[id_tipo_usuario]</td>";
                                                $data .= "<td>$row[nombre]</td>";
                                                $data .= "<td>$row[descripcion]</td>";
                                                $data .= "<td>";
                                                $data .= "<a class='btn btn-xs btn-info' href='consultar.php?id_tipo_usuario=$row[id_tipo_usuario]'>Consultar</a>&nbsp;";
                                                $data .= "<a class='btn btn-xs btn-primary' href='actualizar.php?id_tipo_usuario=$row[id_tipo_usuario]'>Actualizar</a>&nbsp;";
                                                $data .= "<a class='btn btn-xs btn-danger' href='eliminar.php?id_tipo_usuario=$row[id_tipo_usuario]'>Eliminar</a>";
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
                        </section>
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
