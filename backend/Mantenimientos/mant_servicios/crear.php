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
if(!empty($_POST)) {
    // validation errors
    $tipoError = null;
    $descripcionError = null;
    $precioError = null;
    // post values
    $tipo = strip_tags($_POST['tipo']);
    $descripcion = strip_tags($_POST['descripcion']);
    $precio = strip_tags($_POST['precio']);

    // validate input
    $valid = true;
    if(empty($tipo)) {
        $tipoError = "Por favor ingrese el tipo de servicio.";
        $valid = false;
    }

    if(empty($descripcion)) {
        $descripcionError = "Por favor ingrese la descripcion.";
        $valid = false;
    }
    if(empty($precio)) {
        $precioError = "Por favor ingrese el precio del servicio.";
        $valid = false;
    }
    // insert data
    if($valid) {
        try {
            /*Comprueba si hay espacios en blanco*/
            if (ctype_space($tipo)||ctype_space($descripcion)||ctype_space($precio)){
                echo"<script type=\"text/javascript\">alert('No se puede dejar datos en blanco');</script>";
            }
            /*No cuenta un primer espacio ni un ultimo como caracter*/
            else if (strlen(trim($tipo, ' ')) <= 1)
            {
                echo"<script type=\"text/javascript\">alert('El nombre debe de tener al menos dos caracteres');</script>";
            }
            else if (strlen(trim($descripcion, ' ')) <= 4)
            {
                echo"<script type=\"text/javascript\">alert('La descripcion debe de tener al menos cinco caracteres');</script>";
            }
            /*VAlida solo letras */
            else if(!preg_match('/^([a-z A-Z ñáéíóú ÑÁÉÍÓÚ Üü ]{2,60})$/i',$tipo)){
                echo"<script type=\"text/javascript\">alert('El nombre no debe tener números');</script>";
            }
            else if(!preg_match('/^\d+(\.(\d{2}))?$/',$precio)){
                echo"<script type=\"text/javascript\">alert('Formato de precio incorrecto. Debe tener dos decimales. Ej.00.00');</script>";
            }
            else if($precio==0.0){
                echo"<script type=\"text/javascript\">alert('Por favor, no trolear. No se pueden regalar servicios. ');</script>";
            }
            else {
                require("../../bd.php");
                $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "INSERT INTO servicios(tipo, descripcion, precio) values(?, ?, ?)";
                $stmt = $PDO->prepare($sql);
                $stmt->execute(array($tipo, $descripcion, $precio));
                $PDO = null;
                header("Location: servicios.php");
            }
            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Este tipo de usuario ya existe');</script>";
            }

    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Mantenimiento | Servicios</title>
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
                        Crear Servicio</div>
                </div>
                <div class="clearfix">

                </div>
                <div class='row'>
                    <form method='POST'>
                        <div class='form-group <?php print(!empty($tipoError)?"has-error":""); ?>'>
                            <input type='text' name='tipo' placeholder='Tipo' required='required' id='tipo' class='form-control' autocomplete="off" maxlength="20" value='<?php print(!empty($tipo)?$tipo:""); ?>'>
                            <?php print(!empty($tipoError)?"<span class='help-block'>$tipoError</span>":""); ?>
                        </div>
                        <div class='form-group <?php print(!empty($descripcionError)?"has-error":""); ?>'>
                            <input type='text' name='descripcion' placeholder='Descripción' required='required' id='descripcion' class='form-control' autocomplete="off" maxlength="250" value='<?php print(!empty($descripcion)?$descripcion:""); ?>'>
                            <?php print(!empty($descripcionError)?"<span class='help-block'>$descripcionError</span>":""); ?>
                        </div>
                        <div class='form-group <?php print(!empty($precioError)?"has-error":""); ?>'>
                            <input type='text' name='precio' placeholder='Precio' required='required' id='precio' class='form-control' autocomplete="off" maxlength="7" value='<?php print(!empty($precio)?$precio:""); ?>'>
                            <?php print(!empty($precioError)?"<span class='help-block'>$precioError</span>":""); ?>
                        </div>
                        <div class='form-actions'>
                            <button type='submit' class='btn btn-success'>Crear</button>
                            <a class='btn btn btn-default' href='servicios.php'>Regresar</a>
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