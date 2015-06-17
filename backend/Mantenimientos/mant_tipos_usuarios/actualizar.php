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
    $id = $_GET['id_tipo_usuario'];
}
if($id == null) {
    header("Location: tipo_usuario.php");
}
require("../../bd.php");
if(!empty($_POST)) {
    // validation errors
    $nombresError = null;
    $descripcionError = null;
    // post values
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $agregar = $_POST['agregar'] == "agregar";
    $modificar = $_POST['modificar']== "modificar";
    $eliminar = $_POST['eliminar']=="eliminar";
    $consultar = $_POST['consultar']=="consultar";

    // validate input
    $valid = true;
    if(empty($nombre)) {
        $nombresError = "Por favor ingrese el nombre.";
        $valid = false;
    }

    if(empty($descripcion)) {
        $descripcionError = "Por favor ingrese la descripcion.";
        $valid = false;
    }

    // update data
    if($valid) {
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE tipos_usuarios SET nombre = ?, descripcion = ?, agregar=?, modificar=?, eliminar=?, consultar=? WHERE id_tipo_usuario = ?";
        $stmt = $PDO->prepare($sql);
        $stmt->execute(array($nombre, $descripcion, $agregar, $modificar, $eliminar, $consultar, $id));
        $PDO = null;
        header("Location: tipo_usuario.php");
    }
}
else {
    // read data
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT nombre, descripcion, agregar, modificar, eliminar, consultar FROM tipos_usuarios WHERE id_tipo_usuario = ?";
    $stmt = $PDO->prepare($sql);
    $stmt->execute(array($id));
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $PDO = null;
    if(empty($data)) {
        header("Location: tipo_usuario.php");
    }
    $nombre = $data['nombre'];
    $descripcion= $data['descripcion'];
    $agregar = $data['agregar'];
    $modificar= $data['modificar'];
    $eliminar= $data['eliminar'];
    $consultar= $data['consultar'];
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
                        Modificar Tipos de Usuarios</div>
                </div>
                <div class="clearfix">
                </div>

                <form method='POST'>
                    <div class='form-group <?php print(!empty($nombresError)?"has-error":""); ?>'>
                        <label for='nombres'>Nombre</label>
                        <input type='text' name='nombre' placeholder='Nombre' required='required' id='nombre' class='form-control' value='<?php print($nombre); ?>'>
                        <?php print(!empty($nombresError)?"<span class='help-block'>$nombresError</span>":""); ?>
                    </div>
                    <div class='form-group <?php print(!empty($descripcionError)?"has-error":""); ?>'>
                        <label for='nombres'>Descripción</label>
                        <input type='text' name='descripcion' placeholder='Descripción' required='required' id='descripcion' class='form-control' value='<?php print($descripcion); ?>'>
                        <?php print(!empty($descripcionError)?"<span class='help-block'>$descripcionError</span>":""); ?>
                    </div>
                    <div class="form-group">
                        <label><input type="checkbox" value="agregar" <?php if($agregar) echo 'checked="checked"' ?> name="agregar" id="agregar">Agregar</label>
                        <label><input type="checkbox" value="modificar" <?php if($modificar) echo 'checked="checked"' ?>  name="modificar" id="modificar">Modificar</label>
                        <label><input type="checkbox" value="eliminar" <?php if($eliminar) echo 'checked="checked"' ?>  name="eliminar" id="eliminar">Eliminar</label>
                        <label><input type="checkbox" value="consultar" <?php if($consultar) echo 'checked="checked"' ?>  name="consultar" id="consultar">Consultar</label>
                    </div>
                    <div class='form-actions'>
                        <button type='submit' class='btn btn-primary'>Actualizar</button>
                        <a class='btn btn btn-default' href='tipo_usuario.php'>Regresar</a>
                    </div>
                </form>

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
