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
if(!empty($_GET['id_funcion'])) {
    $id = $_GET['id_funcion'];
}
if($id == null) {
    header("Location: funcion.php");
}
require("../../bd.php");
if(!empty($_POST)) {
    // validation errors
    $nombresError = null;
    $descripcionError = null;
    // post values
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    // validate input
    $valid = true;
    if(empty($nombre)) {
        $nombresError = "Por favor ingrese los nombres.";
        $valid = false;
    }

    if(empty($descripcion)) {
        $descripcionError = "Por favor ingrese la descripcion.";
        $valid = false;
    }

    // update data
    if($valid) {
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE funciones SET nombre = ?, descripcion = ? WHERE id_funcion = ?";
        $stmt = $PDO->prepare($sql);
        $stmt->execute(array($nombre, $descripcion, $id));
        $PDO = null;
        header("Location: funcion.php");
    }
}
else {
    // read data
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT nombre, descripcion FROM funciones WHERE id_funcion = ?";
    $stmt = $PDO->prepare($sql);
    $stmt->execute(array($id));
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $PDO = null;
    if(empty($data)) {
        header("Location: funcion.php");
    }
    $nombre = $data['nombre'];
    $descripcion= $data['descripcion'];
}
?>
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
                        Modificar Funciones</div>
                </div>
                <div class="clearfix">
                </div>
s
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
                    <div class='form-actions'>
                        <button type='submit' class='btn btn-primary'>Actualizar</button>
                        <a class='btn btn btn-default' href='funcion.php'>Regresar</a>
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
