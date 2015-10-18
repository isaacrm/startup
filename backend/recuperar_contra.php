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