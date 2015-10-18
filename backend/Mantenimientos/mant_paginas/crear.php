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
    $encabezadoError = null;
    $fraseError = null;
    // post values
    $encabezado = strip_tags($_POST['encabezado']);
    $frase = strip_tags($_POST['frase']);

    // validate input
    $valid = true;
    if(empty($encabezado)) {
        $encabezadoError = "Por favor ingrese un encabezado.";
        $valid = false;
    }

    if(empty($frase)) {
        $fraseError = "Por favor ingrese una frase.";
        $valid = false;
    }
    // insert data

    if($valid) {
        try {
        if (ctype_space($encabezado) || ctype_space($frase) ) {
            echo"<script type=\"text/javascript\">alert('No se puede dejar datos en blanco');</script>";
        }
        else if (strlen(trim($encabezado, ' ')) <= 5)
        {
            echo"<script type=\"text/javascript\">alert('El encabezado debe de tener al menos 6 caracteres');</script>";
        }
        else if (strlen(trim($frase, ' ')) <= 5)
        {
            echo"<script type=\"text/javascript\">alert('La frase debe de tener al menos 6 caracteres');</script>";
        }
        else if(!preg_match('/^([a-z A-Z ñáéíóú ÑÁÉÍÓÚ Üü ]{2,60})$/i',$encabezado)){
            echo"<script type=\"text/javascript\">alert('El encabezado no debe tener números');</script>";
        }
        else {
            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO paginas(encabezado, frase, estado) values(?, ?, ?)";
            $stmt = $PDO->prepare($sql);
            $stmt->execute(array($encabezado, $frase, 1));
            $PDO = null;
            header("Location: paginas.php");
        }
        } catch (Exception $e) {
            echo"<script type=\"text/javascript\">alert('Esta página ya existe');</script>";
        }
    }

}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Mantenimiento | Paginas</title>
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
                        Crear Pagina</div>
                </div>
                <div class="clearfix">

                </div>
                <div class='row'>
                    <form method='POST'>
                        <div class='form-group <?php print(!empty($encabezadoError)?"has-error":""); ?>'>
                            <input type='text' name='encabezado' placeholder='Encabezado' required='required' id='encabezado' class='form-control' autocomplete="off" maxlength="25" value='<?php print(!empty($encabezado)?$encabezado:""); ?>'>
                            <?php print(!empty($encabezadoError)?"<span class='help-block'>$encabezadoError</span>":""); ?>
                        </div>
                        <div class='form-group <?php print(!empty($fraseError)?"has-error":""); ?>'>
                            <input type='text' name='frase' placeholder='Frase' required='required' id='frase' class='form-control' autocomplete="off" maxlength="250" value='<?php print(!empty($frase)?$frase:""); ?>'>
                            <?php print(!empty($fraseError)?"<span class='help-block'>$fraseError</span>":""); ?>
                        </div>
                        <div class='form-actions'>
                            <button type='submit' class='btn btn-success'>Crear</button>
                            <a class='btn btn btn-default' href='paginas.php'>Regresar</a>
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