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
if(!empty($_GET['id_tipo_usuario'])) {
    $id = base64_decode ($_GET['id_tipo_usuario']);
}
if($id == null) {
    header("Location: tipo_usuario.php");
}
else {
    // read data
    require("../../bd.php");
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT nombre, descripcion, agregar, modificar, eliminar, consultar FROM tipos_usuarios where id_tipo_usuario = ?";
    $stmt = $PDO->prepare($sql);
    $stmt->execute(array($id));
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $PDO = null;
    if(empty($data)) {
        header("Location: tipo_usuario.php");
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Winefun | Tipos de Usuario</title>
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
                        Consultar Tipos de Usuario</div>
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
                            <label class="col-sm-2 control-label">Descripción</label>
                            <div class="col-sm-10">
                                <p class="form-control-static"><?php print($data['descripcion']); ?></p>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="col-sm-2 control-label">Agregar</label>
                            <div class="col-sm-10">
                               <p> <input type="checkbox" value="agregar" <?php if($data['agregar']==1) echo 'checked="checked"' ?> name="agregar" id="agregar" disabled></p>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="col-sm-2 control-label">Modificar</label>
                            <div class="col-sm-10">
                                <p> <input type="checkbox" value="agregar" <?php if($data['modificar']==1) echo 'checked="checked"' ?> name="agregar" id="agregar" disabled></p>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="col-sm-2 control-label">Eliminar</label>
                            <div class="col-sm-10">
                                <p> <input type="checkbox" value="agregar" <?php if($data['eliminar']==1) echo 'checked="checked"' ?> name="agregar" id="agregar" disabled></p>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="col-sm-2 control-label">Consultar</label>
                            <div class="col-sm-10">
                                <p> <input type="checkbox" value="agregar" <?php if($data['consultar']==1) echo 'checked="checked"' ?> name="agregar" id="agregar" disabled></p>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <a class="btn btn btn-default" href="tipo_usuario.php">Regresar</a>
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
