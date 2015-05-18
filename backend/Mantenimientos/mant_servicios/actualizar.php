<?php
$id = null;
if(!empty($_GET['id_servicio'])) {
    $id = $_GET['id_servicio'];
}
if($id == null) {
    header("Location: servicios.php");
}
require("../../bd.php");
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

    // update data
    if($valid) {
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE servicios SET tipo = ?, descripcion = ?, precio = ? WHERE id_servicio = ?";
        $stmt = $PDO->prepare($sql);
        $stmt->execute(array($tipo, $descripcion, $precio, $id));
        $PDO = null;
        header("Location: servicios.php");
    }
}
else {
    // read data
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT tipo, descripcion, precio FROM servicios WHERE id_servicio = ?";
    $stmt = $PDO->prepare($sql);
    $stmt->execute(array($id_servicio));
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $PDO = null;
    if(empty($data)) {
        header("Location: servicios.php");
    }
    $tipo = $data['tipo'];
    $descripcion= $data['descripcion'];
    $precio = $data['precio'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Winefun | Servicios</title>
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
                        Modificar Servicio</div>
                </div>
                <div class="clearfix">
                </div>

                <form method='POST'>
                    <div class='form-group <?php print(!empty($tipoError)?"has-error":""); ?>'>
                        <label for='tipo'>Tipo</label>
                        <input type='text' name='tipo' placeholder='Tipo' required='required' id='tipo' class='form-control' value='<?php print($tipo); ?>'>
                        <?php print(!empty($tipoError)?"<span class='help-block'>$tipoError</span>":""); ?>
                    </div>
                    <div class='form-group <?php print(!empty($descripcionError)?"has-error":""); ?>'>
                        <label for='descripcion'>Descripción</label>
                        <input type='text' name='descripcion' placeholder='Descripción' required='required' id='descripcion' class='form-control' value='<?php print($descripcion); ?>'>
                        <?php print(!empty($descripcionError)?"<span class='help-block'>$descripcionError</span>":""); ?>
                    </div>
                    <div class='form-group <?php print(!empty($precioError)?"has-error":""); ?>'>
                        <label for='precio'>Precio</label>
                        <input type='text' name='precio' placeholder='Precio' required='required' id='precio' class='form-control' value='<?php print($precio); ?>'>
                        <?php print(!empty($precioError)?"<span class='help-block'>$precioError</span>":""); ?>
                    </div>
                    <div class='form-actions'>
                        <button type='submit' class='btn btn-primary'>Actualizar</button>
                        <a class='btn btn btn-default' href='servicios.php'>Regresar</a>
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
