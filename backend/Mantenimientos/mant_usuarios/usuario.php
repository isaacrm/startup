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
    <title>Winefun | Usuarios</title>
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
                       Usuarios</div>
                </div>
                <div class="clearfix">
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <div class='container col-lg-12'>
                            <div class='row'>
                                <p><a class='btn btn-xs btn-success' href='crear.php'>Crear</a></p>
                                <div class="table-responsive">
                                    <table class='table table-striped table-bordered table-hover'>
                                        <tr class='warning '>
                                            <th>ID USUARIO</th>
                                            <th>ID EMPLEADO</th>
                                            <th>ID TIPO USUARIO</th>
                                            <th>ACCION</th>
                                        </tr>
                                        <tbody>
                                        <?php
                                        require("../../bd.php");
                                        $sql = "SELECT id_usuario, alias, contrasea, estado, id_empleado, id_tipo_usuario FROM  usuarios ORDER BY id_usuario ASC";
                                        $data = "";
                                        foreach($PDO->query($sql) as $row) {
                                            $data .= "<tr>";
                                            $data .= "<td>$row[id_usuario]</td>";
                                            $data .= "<td>$row[id_empleado]</td>";
                                            $data .= "<td>$row[id_tipo_usuario]</td>";
                                            $data .= "<td>";
                                            $data .= "<a class='btn btn-xs btn-info' href='consultar.php?id_usuario=$row[id_usuario]'>Consultar</a>&nbsp;";
                                            $data .= "<a class='btn btn-xs btn-primary' href='actualizar.php?id_usuario=$row[id_usuario]'>Actualizar</a>&nbsp;";
                                            $data .= "<a class='btn btn-xs btn-danger' href='eliminar.php?id_usuario=$row[id_usuario]'>Eliminar</a>";
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
