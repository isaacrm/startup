<?php
if(!empty($_POST)) {
    // validation errors
    $tipoError = null;
    $descripcionError = null;
    $precioError = null;
    // post values
    $tipo = $_POST['tipo'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

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
        require("../../bd.php");
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO servicios(tipo, descripcion, precio) values(?, ?, ?)";
        $stmt = $PDO->prepare($sql);
        $stmt->execute(array($tipo , $descripcion, $precio));
        $PDO = null;
        header("Location: servicios.php");
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
                            <input type='text' name='tipo' placeholder='Tipo' required='required' id='tipo' class='form-control' value='<?php print(!empty($tipo)?$tipo:""); ?>'>
                            <?php print(!empty($tipoError)?"<span class='help-block'>$tipoError</span>":""); ?>
                        </div>
                        <div class='form-group <?php print(!empty($descripcionError)?"has-error":""); ?>'>
                            <input type='text' name='descripcion' placeholder='Descripción' required='required' id='descripcion' class='form-control' value='<?php print(!empty($descripcion)?$descripcion:""); ?>'>
                            <?php print(!empty($descripcionError)?"<span class='help-block'>$descripcionError</span>":""); ?>
                        </div>
                        <div class='form-group <?php print(!empty($precioError)?"has-error":""); ?>'>
                            <input type='text' name='precio' placeholder='Precio' required='required' id='precio' class='form-control' value='<?php print(!empty($precio)?$precio:""); ?>'>
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