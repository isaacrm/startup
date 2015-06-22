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
            <form action="validarusuario.php" class="form-horizontal" method="post">
                <div class="form-body pal">
                    <form method='POST'>
                        <div class='form-group '>
                            <input type='email' name='correo' placeholder='Dirección E-Mail' required='required' id='correo' class='form-control' autocomplete="off" maxlength="75">
                        </div>
                        <div class='form-group'>
                            <input type='text' name='alias' placeholder='Alias' required='required' id='alias' class='form-control' autocomplete="off" maxlength="15">
                        </div>
                        <div class='form-actions'>
                            <button type='submit' class='btn btn-success'>Recuperar</button>
                            <a class='btn btn btn-default' href='Login.php'>Atrás</a>
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