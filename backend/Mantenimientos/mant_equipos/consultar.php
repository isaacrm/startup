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

<?php
$id = null;
if(!empty($_GET['id_equipo'])) {
    $id = base64_decode ($_GET['id_equipo']);
}
if($id == null) {
    header("Location: equipos.php");
}
else {
    // read data
    require("../../bd.php");
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT nombre, apellido, cargo, frase, twitter, facebook, foto FROM equipos where id_equipo = ?";
    $stmt = $PDO->prepare($sql);
    $stmt->execute(array($id));
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $PDO = null;
    if(empty($data)) {
        header("Location: equipos.php");
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Winefun | Equipos</title>
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
                        Consultar Equipo</div>
                </div>
                <div class="clearfix">
                </div>

                <div class="container">
                    <div class="col-sm-12">
                        <div class="form-group col-sm-12">
                            <label class="col-sm-2 control-label">Nombre:</label>
                            <div class="col-sm-10">
                                <p class="form-control-static"><?php print($data['nombre']); ?></p>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="col-sm-2 control-label">Apellido</label>
                            <div class="col-sm-10">
                                <p class="form-control-static"><?php print($data['apellido']); ?></p>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="col-sm-2 control-label">Cargo</label>
                            <div class="col-sm-10">
                                <p class="form-control-static"><?php print($data['cargo']); ?></p>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="col-sm-2 control-label">Frase</label>
                            <div class="col-sm-10">
                                <p class="form-control-static"><?php print($data['frase']); ?></p>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="col-sm-2 control-label">Twitter</label>
                            <div class="col-sm-10">
                                <p class="form-control-static"><?php print($data['twitter']); ?></p>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="col-sm-2 control-label">Facebook</label>
                            <div class="col-sm-10">
                                <p class="form-control-static"><?php print($data['facebook']); ?></p>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="col-sm-2 control-label">Foto</label>
                            <div class="col-sm-10">
                                <?php print "<img src='../".$data['foto']."'border='0' width='150' height='200'>";?>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <a class="btn btn btn-default" href="equipos.php">Regresar</a>
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
