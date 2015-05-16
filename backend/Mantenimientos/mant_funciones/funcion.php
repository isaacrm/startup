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
                            Dashboard</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="funcion.php">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Dashboard</li>
                    </ol>
                    <div class="clearfix">
                    </div>
                    <!-- Form validations -->
                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <div class='container'>
                                    <div class='row'>
                                        <p><a class='btn btn-xs btn-success' href='mant_funciones/create.php'>Crear</a></p>
                                        <table class='table table-striped table-bordered table-hover'>
                                            <tr class='warning'>
                                                <th>ID</th>
                                                <th>NOMBRE</th>
                                                <th>DESCRIPCION</th>
                                                <th>ACCIÓN</th>
                                            </tr>
                                            <tbody>
                                            <?php
                                            require("../../bd.php");
                                            $sql = "SELECT id_funcion, nombre, descripcion FROM funciones ORDER BY id_funcion ASC";
                                            $data = "";
                                            foreach($PDO->query($sql) as $row) {
                                                $data .= "<tr>";
                                                $data .= "<td>$row[id_funcion]</td>";
                                                $data .= "<td>$row[nombre]</td>";
                                                $data .= "<td>$row[descripcion]</td>";
                                                $data .= "<td>";
                                                $data .= "<a class='btn btn-xs btn-info' href='read.php?id=$row[id_funcion]'>Consultar</a>&nbsp;";
                                                $data .= "<a class='btn btn-xs btn-primary' href='update.php?id=$row[id_funcion]'>Actualizar</a>&nbsp;";
                                                $data .= "<a class='btn btn-xs btn-danger' href='delete.php?id=$row[id_funcion]'>Eliminar</a>";
                                                $data .= "</td>";
                                                $data .= "</tr>";
                                            }
                                            print($data);
                                            $PDO = null;
                                            ?>
                                            </tbody>
                                        </table>
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
