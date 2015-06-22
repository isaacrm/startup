<?php
require("bd.php");
if(!empty($_POST)) {
    $correo = $_POST['correo'];
    $alias= $_POST['alias'];
    $correo = trim($correo);
    $alias= trim($alias);
    $valid = true;
    if (empty($correo)) {
        $valid = false;
    }
    if (empty($alias)) {
        $valid = false;
    }
    if ($valid) {
        /*SELECCIONAR EL ID QUE CORRESPONDE AL USUARIO DEL CORREO*/
        $sql1 = "SELECT id_empleado FROM empleados  WHERE correo='" . $correo. "'";
        foreach ($PDO->query($sql1) as $row1) {
            $id_empleado_correo = "$row1[id_empleado]";
        }
        /*SELECCIONAR EL ID QUE CORRESPONDE AL USUARIO DEL ALIAS*/
        $sql2 = "SELECT id_empleado FROM usuarios  WHERE alias='" . $alias. "'";
        foreach ($PDO->query($sql2) as $row2) {
            $id_empleado_alias = "$row2[id_empleado]";
        }
        if (ctype_space($actual) || ctype_space($nueva) || ctype_space($confirmar)) {
            echo "<script type=\"text/javascript\">alert('No se puede dejar datos en blanco');</script>";
            $correo=null;
            $alias=null;
        }
        else if ($id_empleado_correo!=$id_empleado_alias){
            echo "<script type=\"text/javascript\">alert('El alias no tiene relación con el correo ingresado.');</script>";
            $correo=null;
            $alias=null;
        }
        else{
            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE usuarios SET contrasena=? WHERE alias='" . $_SESSION['alias'] . "' ";
            $stmt = $PDO->prepare($sql);
            $stmt->execute(array(sha1($nueva)));
            $PDO = null;
            header("Location: Login.php");
        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,800italic,400,700,800">
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700,300">
    <link type="text/css" rel="stylesheet" href="Mantenimientos/styles/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="Mantenimientos/styles/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="Mantenimientos/styles/main.css">
    <link type="text/css" rel="stylesheet" href="Mantenimientos/styles/style-responsive.css">
</head>
<body class="img-responsive" style="background: url('Mantenimientos/images/bg/bg.jpg') center center fixed;">
<div class="page-form">
    <div class="panel panel-blue">
        <div class="panel-body pan">
            <form action="recuperar_contra.php" class="form-horizontal" method="post">
                <div class="form-body pal">
                    <form method='POST' >
                        <div class='form-group '>
                            <input type='email' name='correo' placeholder='Dirección E-Mail' required='required' id='correo' class='form-control' autocomplete="off" maxlength="75">
                        </div>
                        <div class='form-group'>
                            <input type='text' name='alias' placeholder='Alias' required='required' id='alias' class='form-control' autocomplete="off" maxlength="15">
                        </div>
                        <div class="form-group mbn">
                            <div class="col-lg-12" align="right">
                                <div class="form-group mbn">
                                    <div class="col-lg-3">
                                        &nbsp;
                                    </div>
                                    <div class="col-lg-9">
                                        <button type='submit' class='btn btn-success'>Recuperar</button>
                                        <a class='btn btn btn-default' href='Login.php'>Atrás</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
            </form>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-12 text-center">
        <p>&nbsp;</p>
    </div>
</div>
</body>
</html>