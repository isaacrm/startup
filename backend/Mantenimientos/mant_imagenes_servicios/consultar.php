<?php
$id = null;
if(!empty($_GET['id_imagen_servicio'])) {
    $id = $_GET['id_imagen_servicio'];
}
if($id == null) {
    header("Location: imagenes_servicios.php");
}
else {
    // read data
    require("../../bd.php");
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT url, titulo, descripcion FROM imagenes_servicios where id_imagen_servicio = ?";
    $stmt = $PDO->prepare($sql);
    $stmt->execute(array($id_imagen_servicio));
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $PDO = null;
    if(empty($data)) {
        header("Location: imagenes_servicios.php");
    }
}
?>
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
                        Consultar Imagen</div>
                </div>
                <div class="clearfix">
                </div>

                <div class="container">
                    <div class="col-sm-12">
                        <div class="form-group col-sm-12">
                            <label class="col-sm-2 control-label">Url:</label>
                            <div class="col-sm-10">
                                <p class="form-control-static"><?php print($data['url']); ?></p>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="col-sm-2 control-label">Titulo:</label>
                            <div class="col-sm-10">
                                <p class="form-control-static"><?php print($data['titulo']); ?></p>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="col-sm-2 control-label">Descripción</label>
                            <div class="col-sm-10">
                                <p class="form-control-static"><?php print($data['descripcion']); ?></p>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <a class="btn btn btn-default" href="imagenes_servicios.php">Regresar</a>
                        </div>
                    </div> <!-- /row -->
                </div> <!-- /container -->

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
