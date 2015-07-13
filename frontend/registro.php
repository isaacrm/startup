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
<!--[if lt IE 7]>      <html lang="es" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html lang="es" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html lang="es" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="es" class="no-js"> <!--<![endif]-->
<head>
    <?php include "maestros/link_meta_script_iniciales.php" ?>
</head>
<body id="body">
<?php include "maestros/link_meta_script_iniciales.php" ?>
<section id="registro" class="registro">
    <div class="container">
        <div class="row">
            <div class="sec-title text-center wow fadeInUp animated" data-wow-duration="700ms">
                <h2>Registrarse</h2>
                <div class="devider"><i class="fa fa-trophy fa-lg"></i></div>
            </div>

            <div class="sec-sub-title text-center wow fadeInRight animated" data-wow-duration="500ms">
                <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                    <form role="form">
                        <h2 class="register">Registrese <small>Es gratis y siempre lo será.</small></h2>
                        <hr class="colorgraph">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="text" name="nombres" id="nombres" class="form-control input-lg" placeholder="Nombres" tabindex="1">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="text" name="apellidos" id="apellidos" class="form-control input-lg" placeholder="Apellidos" tabindex="2">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" name="display_name" id="display_name" class="form-control input-lg" placeholder="Nombre de Usuario" tabindex="3">
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email " tabindex="4">
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="contraseña" name="contraseña" id="contraseña" class="form-control input-lg" placeholder="Contraseña" tabindex="5">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="contraseña" name="confirmar" id="confirmar" class="form-control input-lg" placeholder="Confirmar Contraseña" tabindex="6">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                                Cuando des click en <strong class="label label-primary">Registrarse</strong>, estarás de acuerdo con nuestras <a href="#politicas" class="terminos">Políticas de empresa</a> establecido por este sitio, incluyendo el uso de cookies.
                            </div>
                        </div>

                        <hr class="colorgraph">
                        <div class="row">
                            <div ><input type="submit" action="registro.php" value="Registrarse" class="btn btn-primary btn-block btn-lg" tabindex="7"></div>
                    </form>
                </div>
            </div>
            <div class="modal fade" id="t_and_c_m" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">Terminos y Condiciones</h4>
                        </div>
                        <div class="modal-body">
                            <p>Los métodos de pago deben de realizarse en PayPal, Depósito Bancario o Modalidad Presencial</p>
                            <p>No exigimos un límite en la cantidad de invitados, tú lo decides</p>
                            <p>El local lo pones tú, nosotros nos encargamos de la decoración.</p>
                            <p>Nuestros servicios son exclusivamente para el territorio salvadoreño.</p>

                        <div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Estoy de Acuerdo</button>
                        </div>
                    </div>
                </div>
            </div>
            </div>
</section>
</body>
</html>