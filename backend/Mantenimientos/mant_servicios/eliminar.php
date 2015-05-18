<?php
$id = null;
if(!empty($_GET['id_servicio'])) {
    $id = $_GET['id_servicio'];
}
if($id == null) {
    header("Location: servicios.php");
}

// Delete Data
if(!empty($_POST)) {
    require("bd.php");
    $id = $_POST['id_servicio'];
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM servicios WHERE id_servicio = ?";
    $stmt = $PDO->prepare($sql);
    $stmt->execute(array($id_servicio));
    $PDO = null;
    header("Location: servicios.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Winefun | Servicios</title>
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
                        Eliminar Servicio</div>
                </div>
                <div class="clearfix">
                </div>
                <div class='container'>
                <div class='row'>
                    <form method='POST'>
                        <input type='hidden' name='id_tipo_usuario' value='<?php print($id); ?>'>
                        <p class='alert bg-danger'>¿Borrar datos?</p>
                        <div class='form-actions'>
                            <button type='submit' class='btn btn-danger'>Si</button>
                            <a class='btn btn btn-default' href='servicios.php'>No</a>
                        </div>
                    </form>
                </div> <!-- /row -->
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
