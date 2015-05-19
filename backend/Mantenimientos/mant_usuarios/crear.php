<?php
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
    if (empty($alias)) {
        $aliasError = "Por favor ingrese un alias.";
        $valid = false;
    }

    if (empty($contrasena)) {
        $contrasenaError = "Por favor ingrese su contraseña.";
        $valid = false;
    }

    if (empty($estado)) {
        $estadoError = "Por favor ingrese su estado.";
        $valid = false;
        // insert data
        if ($valid) {
            require("../../bd.php");
            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO usuarios(alias, contrasena, estado) values(?, ?, ?)";
            $stmt = $PDO->prepare($sql);
            $stmt->execute(array($alias, $contrasena, $estado));
            $PDO = null;
            header("Location: usuarios.php");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Mantenimiento | Usuarios</title>
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
                        Crear Usuario</div>
                </div>
                <div class="clearfix">

                </div>
                <div class='row'>
                    <form method='POST'>
                        <div class='form-group <?php print(!empty($aliasError)?"has-error":""); ?>'>
                            <input type='text' name='alias' placeholder='Alias' required='required' id='alias' class='form-control' value='<?php print(!empty($alias)?$alias:""); ?>'>
                            <?php print(!empty($aliasError)?"<span class='help-block'>$aliasError</span>":""); ?>
                        </div>
                        <div class='form-group <?php print(!empty($contrasenaError)?"has-error":""); ?>'>
                            <input type='text' name='contrasena' placeholder='Contraseña' required='required' id='contrasena' class='form-control' value='<?php print(!empty($contrasena)?$contrasena:""); ?>'>
                            <?php print(!empty($contrasenaError)?"<span class='help-block'>$contrasenaError</span>":""); ?>
                        </div>
                        <div class='form-group <?php print(!empty($estadoError)?"has-error":""); ?>'>
                            <input type='text' name='estado' placeholder='Estado' required='required' id='estado' class='form-control' value='<?php print(!empty($estado)?$estado:""); ?>'>
                            <?php print(!empty($estadoError)?"<span class='help-block'>$estadoError</span>":""); ?>
                        </div>
                        <div class='form-actions'>
                            <button type='submit' class='btn btn-success'>Crear</button>
                            <a class='btn btn btn-default' href='usuarios.php'>Regresar</a>
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