<?php
//creamos la sesion
session_start();
//validamos si se ha hecho o no el inicio de sesion correctamente
//si no se ha hecho la sesion nos regresará a login.php
if(!isset($_SESSION['alias']))
{
    header('Location: ../../login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Winefun | Tipos de Usuario</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/zebra_pagination.css" type="text/css">
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
                        Tipos de Usuario</div>
                </div>
                <div class="clearfix">
                </div>
                <!-- Form validations -->

                <div class="row">
                    <div class="col-lg-12">
                            <div class='container col-lg-12'>
                                <div class='row'>
                                    <p><a class='btn btn-xs btn-success' href='crear.php'>Crear</a></p>
                                    <form method='POST' action="buscar.php">
                                        <input  class="col-lg-9" name="buscar" placeholder="Buscar por Nombre" type="text" id='buscar' autocomplete="off" maxlength="60"/>
                                        <input class="col-lg-3" type="submit" name="submit" value="Buscar">
                                    </form>
                                        <div class="table-responsive">
                                        <table class='table table-striped table-bordered table-hover'>
                                            <tr class='warning '>
                                                <th>ID</th>
                                                <th>NOMBRE</th>
                                                <th>DESCRIPCION</th>
                                                <th>ACCION</th>
                                            </tr>
                                            <tbody>
                                            <?php
                                            /*Esta pequeña  linea quita errores molestos que muestra php*/
                                            error_reporting(E_ALL ^ E_NOTICE);
                                            require("../../bd.php");
                                                /*Se llama la libreria de paginacion*/
                                                require_once("../../libs/Zebra_Pagination.php");
                                                /*Aqui obtenemos el total de registros*/
                                                $sql0 = "SELECT COUNT(*) as total_datos FROM tipos_usuarios";
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
                                                $sql = "SELECT id_tipo_usuario, nombre, descripcion FROM tipos_usuarios WHERE nombre!='Administrador' ORDER BY id_tipo_usuario ASC LIMIT " . (($paginacion->get_page() - 1) * $filas) . ', ' . $filas;
                                                $data = "";
                                                foreach ($PDO->query($sql) as $row) {
                                                    $id_c = base64_encode($row['id_tipo_usuario']);
                                                    $data .= "<tr>";
                                                    $data .= "<td>$row[id_tipo_usuario]</td>";
                                                    $data .= "<td>$row[nombre]</td>";
                                                    $data .= "<td>$row[descripcion]</td>";
                                                    $data .= "<td>";
                                                    $data .= "<a class='btn btn-xs btn-info' href='consultar.php?id_tipo_usuario=$id_c'>Consultar</a>&nbsp;";
                                                    $data .= "<a class='btn btn-xs btn-primary' href='actualizar.php?id_tipo_usuario=$id_c'>Actualizar</a>&nbsp;";
                                                    $data .= "<a class='btn btn-xs btn-danger' href='eliminar.php?id_tipo_usuario=$id_c'>Eliminar</a>";
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
