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
if(!empty($_GET['id_usuario'])) {
    $id = $_GET['id_usuario'];
}
if($id == null) {
    header("Location: usuario.php");
}
require("../../bd.php");
if(!empty($_POST)) {
    // validation errors
    $aliasError = null;
    $contrasenaError = null;
    $estadoError = null;
    // post values
    $alias = $_POST['alias'];
    $contrasena = $_POST['contrasena'];
    $estado = $_POST['estado'];

    // validate input
    $valid = true;
    if(empty($alias)) {
        $aliasError = "Por favor ingrese su alias.";
        $valid = false;
    }

    if(empty($contrasena)) {
        $contrasenaError = "Por favor ingrese su contraseña.";
        $valid = false;
    }
    if(empty($estado)) {
        $estadoError = "Por favor ingrese su estado.";
        $valid = false;
    }

    // update data
    if($valid) {
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE usuarios SET alias = ?, contrasena = ?, estado =? WHERE id_usuario = ?";
        $stmt = $PDO->prepare($sql);
        $stmt->execute(array($alias, $contrasena, $estado, $id));
        $PDO = null;
        header("Location: usuario.php");
    }
}
else {
    // read data
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT alias, contrasena, estado FROM usuarios WHERE id_usuario = ?";
    $stmt = $PDO->prepare($sql);
    $stmt->execute(array($id));
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $PDO = null;
    if(empty($data)) {
        header("Location: usuarios.php");
    }
    $alias = $data['alias'];
    $contrasena = $data['contrasena'];
    $estado = $data['estado'];
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
                        Modificar Usuarios</div>
                </div>
                <div class="clearfix">
                </div>
s
                <form method='POST'>
                    <div class='form-group <?php print(!empty($aliasError)?"has-error":""); ?>'>
                        <label for='alias'>Alias</label>
                        <input type='text' name='alias' placeholder='Alias' required='required' id='alias' class='form-control' value='<?php print($alias); ?>'>
                        <?php print(!empty($aliasError)?"<span class='help-block'>$aliasError</span>":""); ?>
                    </div>
                    <div class='form-group <?php print(!empty($contrasenaError)?"has-error":""); ?>'>
                        <label for='alias'>Contraseña</label>
                        <input type='text' name='contrasena' placeholder='Contraseña' required='required' id='contrasena' class='form-control' value='<?php print($contrasena); ?>'>
                        <?php print(!empty($contrasenaError)?"<span class='help-block'>$contrasenaError</span>":""); ?>
                    </div>
                    <div class='form-group <?php print(!empty($estadoError)?"has-error":""); ?>'>
                        <label for='alias'>Estado</label>
                        <input type='text' name='estado' placeholder='Estado' required='required' id='estado' class='form-control' value='<?php print($estado); ?>'>
                        <?php print(!empty($estadoError)?"<span class='help-block'>$estadoError</span>":""); ?>
                    </div>
                    <div class='form-actions'>
                        <button type='submit' class='btn btn-primary'>Actualizar</button>
                        <a class='btn btn btn-default' href='usuario.php'>Regresar</a>
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
