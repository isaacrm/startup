<?php
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
    // insert data
    if($valid) {
        require("../../bd.php");
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO funciones(nombre, descripcion) values(?, ?)";
        $stmt = $PDO->prepare($sql);
        $stmt->execute(array($nombre , $descripcion));
        $PDO = null;
        header("Location: index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Dashboard | Dashboard</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../estilos.php';?>
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
                        Crear Funciones</div>
                </div>
                <div class="clearfix">

                </div>
                <div class='row'>
                    <div class='row'>
                        <h2>Crear funciones de tipos de usuario</h2>
                    </div>
                    <form method='POST'>
                        <div class='form-group <?php print(!empty($nombresError)?"has-error":""); ?>'>
                            <label for='nombres'>Nombre</label>
                            <input type='text' name='nombre' placeholder='Nombre' required='required' id='nombre' class='form-control' value='<?php print(!empty($nombre)?$nombre:""); ?>'>
                            <?php print(!empty($nombresError)?"<span class='help-block'>$nombresError</span>":""); ?>
                        </div>
                        <div class='form-group <?php print(!empty($descripcionError)?"has-error":""); ?>'>
                            <label for='descripcion'>Descripción</label>
                            <input type='text' name='descripcion' placeholder='Descripción' required='required' id='descripcion' class='form-control' value='<?php print(!empty($descripcion)?$descripcion:""); ?>'>
                            <?php print(!empty($descripcionError)?"<span class='help-block'>$descripcionError</span>":""); ?>
                        </div>
                        <div class='form-actions'>
                            <button type='submit' class='btn btn-success'>Crear</button>
                            <a class='btn btn btn-default' href='../form_validation.php'>Regresar</a>
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
<?php include '../funciones.php';?>
</body>
</html>