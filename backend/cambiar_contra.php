<?php
//creamos la sesion
session_start();
//validamos si se ha hecho o no el inicio de sesion correctamente
//si no se ha hecho la sesion nos regresará a login.php
if(!isset($_SESSION['alias']))
{
    header('Location: Login.php');
    exit();
}
?>
<?php
require("bd.php");
if(!empty($_POST)) {
    $actual = $_POST['actual'];
    $nueva = $_POST['nueva'];
    $confirmar = $_POST['confirmar'];
    $valid = true;
    if (empty($actual)) {
        $valid = false;
    }
    if (empty($nueva)) {
        $valid = false;
    }
    if (empty($confirmar)) {
        $valid = false;
    }
    if ($valid) {
        /*SELECCIONAR LA CONTRASEÑA ACTUAL DEL USUARIO LOGUEADO*/
        $sql2 = "SELECT contrasena FROM usuarios  WHERE alias='" . $_SESSION['alias'] . "'";
        foreach ($PDO->query($sql2) as $row2) {
            $contra = "$row2[contrasena]";
        }
        if (ctype_space($actual) || ctype_space($nueva) || ctype_space($confirmar)) {
            echo "<script type=\"text/javascript\">alert('No se puede dejar datos en blanco');</script>";
            $actual=null;
            $nueva=null;
            $confirmar=null;
        }else if (sha1($actual)!=$contra) {
            echo "<script type=\"text/javascript\">alert('Esa no es su contraseña actual');</script>";
            $actual=null;
            $nueva=null;
            $confirmar=null;
        }else if ($nueva != $confirmar) {
            echo "<script type=\"text/javascript\">alert('Las contraseñas no coinciden');</script>";
            $nueva=null;
            $confirmar=null;
        }
        else if (!preg_match('/^.*(?=.{4,15})(?=.*\d)(?=.*[A-Z])(?=.*[a-z]).*$/', $nueva)) {
            echo "<script type=\"text/javascript\">alert('La contraseña nueva debe tener una minúscula, una mayúscula , un número y debe de ser de 4 a 15 caracteres');</script>";
            $nueva=null;
            $confirmar=null;
        }
        else{
                    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "UPDATE usuarios SET contrasena=? WHERE alias='" . $_SESSION['alias'] . "' ";
                    $stmt = $PDO->prepare($sql);
                    $stmt->execute(array(sha1($nueva)));
                    $PDO = null;
                    header("Location: logout.php");
            }
        }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Winefun | Cambiar Contraseña</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'Mantenimientos/estilos.php';?>
</head>
<body>
<div>
    <!--BEGIN THEME SETTING--><!--END THEME SETTING-->
    <!--BEGIN BACK TO TOP-->
    <a id="totop" href="#"><i class="fa fa-angle-up"></i></a>
    <!--END BACK TO TOP-->
    <?php include 'Mantenimientos/topbar2.php';?>
    <div id="wrapper">
        <?php include 'Mantenimientos/sidebar2.php';?>
        <!--BEGIN PAGE WRAPPER-->
        <div id="page-wrapper">
            <!--BEGIN TITLE & BREADCRUMB PAGE-->
            <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">
                        Cambiar Contraseña</div>
                </div>
                <div class="clearfix">
                </div>

                <form method='POST'>
                    <div class='form-group '>
                        <input type='password' name='actual' placeholder='Contraseña Actual' required='required' id='actual' class='form-control' autocomplete="off" maxlength="15" value='<?php print(!empty($actual)?$actual:""); ?>' >
                        <?php print(!empty($tipoError)?"<span class='help-block'>$tipoError</span>":""); ?>
                    </div>
                    <div class='form-group'>
                        <input type='password' name='nueva' placeholder='Nueva Contraseña' required='required' id='nueva' class='form-control' autocomplete="off" maxlength="15" value='<?php print(!empty($nueva)?$nueva:""); ?>' >
                        <?php print(!empty($descripcionError)?"<span class='help-block'>$descripcionError</span>":""); ?>
                    </div>
                    <div class='form-group'>
                        <input type='password' name='confirmar' placeholder='Confirmar Nueva Contraseña' required='required' id='confirmar' class='form-control' autocomplete="off" maxlength="15" value='<?php print(!empty($confirmar)?$confirmar:""); ?>' >
                        <?php print(!empty($precioError)?"<span class='help-block'>$precioError</span>":""); ?>
                    </div>
                    <div class='form-actions'>
                        <button type='submit' class='btn btn-success'>Cambiar Contraseña</button>
                        <a class='btn btn btn-default' href='index.php'>Cancelar</a>
                    </div>
                </form>
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
<?php include 'Mantenimientos/funciones.php';?>
</body>
</html>