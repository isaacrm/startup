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
    $id = $_GET['id_equipo'];
}
if($id == null) {
    header("Location: equipos.php");
}
require("../../bd.php");
if(!empty($_POST)) {
    // validation errors
    $nombreError = null;
    $apellidoError = null;
    $cargoError = null;
    $fraseError = null;
    $twitterError = null;
    $facebookError = null;
    // post values
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $cargo = $_POST['cargo'];
    $frase = $_POST['frase'];
    $twitter = $_POST['twitter'];
    $facebook = $_POST['facebook'];

    // validate input
    $valid = true;
    if(empty($nombre)) {
        $nombreError = "Por favor ingrese un nombre.";
        $valid = false;
    }

    if(empty($apellido)) {
        $apellidoError = "Por favor ingrese un apellido.";
        $valid = false;
    }

    if(empty($cargo)) {
        $cargoError = "Por favor ingrese el cargo.";
        $valid = false;
    }

    if(empty($frase)) {
        $fraseError = "Por favor ingrese la frase.";
        $valid = false;
    }

    if(empty($twitter)) {
        $twitterError = "Por favor ingrese el twitter.";
        $valid = false;
    }

    if(empty($facebook)) {
        $facebookError = "Por favor ingrese el facebook.";
        $valid = false;
    }

    // update data
    if($valid) {
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE equipos SET nombre = ?, apellido = ?, cargo = ?, frase = ?, twitter = ?, facebook = ? WHERE id_equipo = ?";
        $stmt = $PDO->prepare($sql);
        $stmt->execute(array($nombre, $apellido, $cargo));
        $PDO = null;
        header("Location: equipos.php");
    }
}
else {
    // read data
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT nombre, apellido, cargo, frase, twitter, facebook FROM equipos WHERE id_equipo = ?";
    $stmt = $PDO->prepare($sql);
    $stmt->execute(array($id_equipo));
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $PDO = null;
    if(empty($data)) {
        header("Location: equipos.php");
    }
    $nombre = $data['nombre'];
    $apellido= $data['apellido'];
    $cargo = $data['cargo'];
    $frase = $data['frase'];
    $twitter = $data['twitter'];
    $facebook = $data['facebook'];
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
                        Modificar Equipo</div>
                </div>
                <div class="clearfix">
                </div>

                <form method='POST'>
                    <div class='form-group <?php print(!empty($nombreError)?"has-error":""); ?>'>
                        <label for='nombre'>Nombre</label>
                        <input type='text' name='nombre' placeholder='Nombre' required='required' id='nombre' class='form-control' value='<?php print($nombre); ?>'>
                        <?php print(!empty($nombreError)?"<span class='help-block'>$nombreError</span>":""); ?>
                    </div>
                    <div class='form-group <?php print(!empty($apellidoError)?"has-error":""); ?>'>
                        <label for='apellido'>Descripción</label>
                        <input type='text' name='descripcion' placeholder='Apellido' required='required' id='apellido' class='form-control' value='<?php print($apellido); ?>'>
                        <?php print(!empty($apellidoError)?"<span class='help-block'>$apellidoError</span>":""); ?>
                    </div>
                    <div class='form-group <?php print(!empty($cargoError)?"has-error":""); ?>'>
                        <label for='cargo'>Cargo</label>
                        <input type='text' name='cargo' placeholder='Cargo' required='required' id='cargo' class='form-control' value='<?php print($cargo); ?>'>
                        <?php print(!empty($cargoError)?"<span class='help-block'>$cargoError</span>":""); ?>
                    </div>
                    <div class='form-group <?php print(!empty($fraseError)?"has-error":""); ?>'>
                        <label for='frase'>Frase</label>
                        <input type='text' name='frase' placeholder='Frase' required='required' id='frase' class='form-control' value='<?php print($frase); ?>'>
                        <?php print(!empty($fraseError)?"<span class='help-block'>$fraseError</span>":""); ?>
                    </div>
                    <div class='form-group <?php print(!empty($twitterError)?"has-error":""); ?>'>
                        <label for='twitters'>Twitter</label>
                        <input type='text' name='twitter' placeholder='Twitter' required='required' id='twitter' class='form-control' value='<?php print($twitter); ?>'>
                        <?php print(!empty($twitterError)?"<span class='help-block'>$twitterError</span>":""); ?>
                    </div>
                    <div class='form-group <?php print(!empty($facebookError)?"has-error":""); ?>'>
                        <label for='facebook'>Facebook</label>
                        <input type='text' name='facebook' placeholder='Facebook' required='required' id='facebook' class='form-control' value='<?php print($facebook); ?>'>
                        <?php print(!empty($facebookError)?"<span class='help-block'>$facebookError</span>":""); ?>
                    </div>
                    <div class='form-actions'>
                        <button type='submit' class='btn btn-primary'>Actualizar</button>
                        <a class='btn btn btn-default' href='equipos.php'>Regresar</a>
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
