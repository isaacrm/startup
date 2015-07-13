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