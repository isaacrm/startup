<?php
//creamos la sesion
session_start();
//validamos si se ha hecho o no el inicio de sesion correctamente
//si no se ha hecho la sesion nos regresará a login.php
if(isset($_SESSION['alias']))
{
    header('Location: index.php');
    exit();
}
?>
<?php
error_reporting(E_ALL ^ E_NOTICE);
require("bd.php");
if(!empty($_POST)) {
    $correo = $_POST['correo'];
    $alias = $_POST['alias'];
    $correo = trim($correo);
    $alias = trim($alias);
    $valid = true;
    if (empty($correo)) {
        $valid = false;
    }
    if (empty($alias)) {
        $valid = false;
    }
    if ($valid) {
        /*SELECCIONAR EL ID QUE CORRESPONDE AL USUARIO DEL CORREO*/
        $sql = "SELECT id_empleado FROM empleados  WHERE correo='" . $correo . "'";
        foreach ($PDO->query($sql) as $row) {
            $id_empleado1 = "$row[id_empleado]";
        }
        /*SELECCIONAR EL ID QUE CORRESPONDE AL USUARIO DEL ALIAS*/
        $sql1 = "SELECT id_empleado FROM usuarios  WHERE alias='" . $alias . "'";
        foreach ($PDO->query($sql1) as $row1) {
            $comprobar = "$row1[id_empleado]";
        }
        if ($id_empleado1 != $comprobar) {
            echo "<script type=\"text/javascript\">alert('El alias no tiene relación con el correo ingresado.');</script>";
            $correo = null;
            $alias = null;
        } else if (ctype_space($correo) || ctype_space($alias)) {
            echo "<script type=\"text/javascript\">alert('No se puede dejar datos en blanco');</script>";
            $correo = null;
            $alias = null;
        } else if ($id_empleado1 == "") {
            echo "<script type=\"text/javascript\">alert('Ese correo electrónico no está en el sistema');</script>";
            $correo = null;
            $alias = null;
        } else {
            $num_caracteres = "10"; // asignamos el número de caracteres que va a tener la nueva contraseña
            $nueva_clave = substr(sha1(rand()),0,$num_caracteres); // generamos una nueva contraseña de forma aleatoria
            $usuario_clave = $nueva_clave; // la nueva contraseña que se enviará por correo al usuario
            $usuario_clave2 = sha1($usuario_clave); // encriptamos la nueva contraseña para guardarla en la BD

            //Enviamos por correo
            include("libs/class.phpmailer.php");
            include("libs/class.smtp.php");
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "ssl";
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 465;
            $mail->Username = "winefunofficial@gmail.com";
            $mail->Password = "winefun123";
            $mail->From = "winefunofficial@gmail.com";
            $mail->FromName = "WINEFUN";
            $mail->Subject = "Recuperación de Contraseña";
            $mail->AltBody = "Hola, su contraseña se ha generado con éxito. \nSe  recomienda cambiar la contraseña cuando inicie sesión:.";
            $mail->MsgHTML("Nueva Contraseña:<b>".$nueva_clave."</b>");
            $mail->AddAddress($correo, "Destinatario");
            $mail->IsHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Send();
             // actualizamos los datos (contraseña) del usuario que solicitó su contraseña
            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE usuarios SET contrasena=? WHERE id_empleado='" . $id_empleado1 . "' ";
            $stmt = $PDO->prepare($sql);
            $stmt->execute(array($usuario_clave2));
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
                                    <div class="col-lg-9 ">
                                        <button type='submit' class='btn btn-success'>Recuperar</button>
                                        <a class='btn btn btn-default' href='Login.php'>Atrás</a>
                                    </div>
                                </div>
                            </div>
                        </div>
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