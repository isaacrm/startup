
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
        <?php include 'Mantenimientos/topbar.php';?>
        <div id="wrapper">
            <?php include 'Mantenimientos/sidebar.php';?>
            <!--BEGIN PAGE WRAPPER-->
            <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left">
                        <div class="page-title">
                            Inicio</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="mant_funciones/funcion.php">Inicio</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="hidden"><a href="#">Inicio</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Inicio</li>
                    </ol>
                    <div class="clearfix">
                    </div>
                    <!-- Form validations -->
                </div>
                <!--END TITLE & BREADCRUMB PAGE-->
                <!--BEGIN CONTENT-->
                <div class="page-content"></div>
                <!--END CONTENT-->
            </div>
            <!--END PAGE WRAPPER-->
        </div>
</div>
    <?php include 'Mantenimientos/funciones.php';?>
</body>
</html>