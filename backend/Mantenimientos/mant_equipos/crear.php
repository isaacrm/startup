<?php
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
    // insert data
    if($valid) {
        require("../../bd.php");
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO equipos(nombre, apellido, cargo, frase, twitter, facebook) values(?, ?, ?, ?, ?, ?)";
        $stmt = $PDO->prepare($sql);
        $stmt->execute(array($nombre, $apellido, $cargo, $frase, $twitter, $facebook));
        $PDO = null;
        header("Location: equipos.php");
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Mantenimiento | Equipos</title>
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
                        Crear Equipos</div>
                </div>
                <div class="clearfix">

                </div>
                <div class='row'>
                    <form method='POST'>
                        <div class='form-group <?php print(!empty($nombreError)?"has-error":""); ?>'>
                            <input type='text' name='nombre' placeholder='Nombre' required='required' id='nombre' class='form-control' value='<?php print(!empty($nombre)?$nombre:""); ?>'>
                            <?php print(!empty($nombreError)?"<span class='help-block'>$nombreError</span>":""); ?>
                        </div>
                        <div class='form-group <?php print(!empty($apellidoError)?"has-error":""); ?>'>
                            <input type='text' name='apellido' placeholder='Apellido' required='required' id='apellido' class='form-control' value='<?php print(!empty($apellido)?$apellido:""); ?>'>
                            <?php print(!empty($apellidoError)?"<span class='help-block'>$apellidoError</span>":""); ?>
                        </div>
                        <div class='form-group <?php print(!empty($cargoError)?"has-error":""); ?>'>
                            <input type='text' name='cargo' placeholder='Cargo' required='required' id='cargo' class='form-control' value='<?php print(!empty($cargo)?$cargo:""); ?>'>
                            <?php print(!empty($cargoError)?"<span class='help-block'>$cargoError</span>":""); ?>
                        </div>
                        <div class='form-group <?php print(!empty($fraseError)?"has-error":""); ?>'>
                            <input type='text' name='frase' placeholder='Frase' required='required' id='frase' class='form-control' value='<?php print(!empty($facebook)?$frase:""); ?>'>
                            <?php print(!empty($fraseError)?"<span class='help-block'>$fraseError</span>":""); ?>
                        </div>
                        <div class='form-group <?php print(!empty($twitterError)?"has-error":""); ?>'>
                            <input type='text' name='twitter' placeholder='Twitter' required='required' id='twitter' class='form-control' value='<?php print(!empty($twitter)?$twitter:""); ?>'>
                            <?php print(!empty($twitterError)?"<span class='help-block'>$twitterError</span>":""); ?>
                        </div>
                        <div class='form-group <?php print(!empty($facebookError)?"has-error":""); ?>'>
                            <input type='text' name='facebook' placeholder='Facebook' required='required' id='facebook' class='form-control' value='<?php print(!empty($facebook)?$facebook:""); ?>'>
                            <?php print(!empty($facebookError)?"<span class='help-block'>$facebookError</span>":""); ?>
                        </div>
                        <div class='form-actions'>
                            <button type='submit' class='btn btn-success'>Crear</button>
                            <a class='btn btn btn-default' href='equipos.php'>Regresar</a>
                        </div>
                    </form>
                </div> <!-- /row -->
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