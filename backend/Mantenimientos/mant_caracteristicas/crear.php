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
require("../../bd.php");
if(!empty($_POST)) {
    // validation errors
    $tituloError = null;
    // post values
    $titulo = $_POST['titulo'];
    $descripcion= $_POST['descripcion'];
    // validate input
    $valid = true;
    if(empty($titulo)) {
        $tituloError = "Por favor ingrese un titulo.";
        $valid = false;
    }
    // insert data
    if($valid) {
        try {
            if (ctype_space($titulo) || ctype_space($descripcion)) {
                echo "<script type=\"text/javascript\">alert('No se puede dejar datos en blanco');</script>";
            } else if (strlen(trim($titulo, ' ')) <= 3) {
                echo "<script type=\"text/javascript\">alert('El titulo debe de tener al menos 4 caracteres');</script>";
            } else if (strlen(trim($descripcion, ' ')) <= 5) {
                echo "<script type=\"text/javascript\">alert('La frase debe de tener al menos 6 caracteres');</script>";
            } else if (!preg_match('/^([a-z A-Z ñáéíóú ÑÁÉÍÓÚ Üü ]{2,60})$/i', $titulo)) {
                echo "<script type=\"text/javascript\">alert('El titulo no debe tener números');</script>";
            } else {
                $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "INSERT INTO caracteristicas(titulo, descripcion) values(?,?)";
                $stmt = $PDO->prepare($sql);
                $stmt->execute(array($titulo, $descripcion));
                $PDO = null;
                header("Location: caracteristicas.php");
            }
        } catch (Exception $e) {
            echo "<script type=\"text/javascript\">alert('Esta característica ya existe');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Mantenimiento | Caracteristicas</title>
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
                        Crear Caracteristica</div>
                </div>
                <div class="clearfix">

                </div>
                <div class='row'>
                    <form method='POST'>
                        <div class='form-group <?php print(!empty($tituloError)?"has-error":""); ?>'>
                            <input type='text' name='titulo' placeholder='Titulo' required='required' id='titulo' class='form-control' autocomplete="off" maxlength="8" value='<?php print(!empty($titulo)?$titulo:""); ?>'>
                            <?php print(!empty($tituloError)?"<span class='help-block'>$tituloError</span>":""); ?>
                        </div>
                        <div class='form-group' >
                            <input type='text' name='descripcion' placeholder='Descripción' required='required' id='descripcion' class='form-control' autocomplete="off" maxlength="250" value='<?php print(!empty($descripcion)?$descripcion:""); ?>'>
                        </div>
                        <div class='form-actions'>
                            <button type='submit' class='btn btn-success'>Crear</button>
                            <a class='btn btn btn-default' href='caracteristicas.php'>Regresar</a>
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